<?php require_once '../app/views/layouts/admin_header.php'; ?>

<div class="bg-white rounded-lg shadow-md p-6">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold">Galeri Foto</h2>
        <button onclick="openCreateModal()" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition">
            <i class="fas fa-plus mr-2"></i>Upload Foto
        </button>
    </div>

    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
        <?php if (!empty($photos)): ?>
            <?php foreach ($photos as $photo): ?>
                <div class="relative group">
                    <img src="<?= BASE_URL . $photo['image'] ?>" alt="<?= htmlspecialchars($photo['title']) ?>" 
                         class="w-full h-48 object-cover rounded-lg">
                    <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-60 transition rounded-lg flex items-center justify-center">
                        <div class="opacity-0 group-hover:opacity-100 transition space-x-2">
                            <button onclick="viewPhoto(<?= $photo['id'] ?>)" class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-2 rounded">
                                <i class="fas fa-eye"></i>
                            </button>
                            <button onclick="editPhoto(<?= $photo['id'] ?>)" class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-2 rounded">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button onclick="deletePhoto(<?= $photo['id'] ?>)" class="bg-red-500 hover:bg-red-600 text-white px-3 py-2 rounded">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </div>
                    <p class="mt-2 text-sm font-semibold truncate"><?= htmlspecialchars($photo['title']) ?></p>
                    <?php if ($photo['category']): ?>
                        <span class="inline-block px-2 py-1 text-xs bg-blue-100 text-blue-800 rounded mt-1">
                            <?= htmlspecialchars($photo['category']) ?>
                        </span>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="col-span-4 text-center py-12 text-gray-500">
                <i class="fas fa-image text-6xl mb-4"></i>
                <p>Belum ada foto. Upload foto pertama Anda!</p>
            </div>
        <?php endif; ?>
    </div>
</div>

<!-- Create/Edit Modal -->
<div id="photoModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-lg p-8 max-w-2xl w-full mx-4 max-h-[90vh] overflow-y-auto">
        <div class="flex justify-between items-center mb-6">
            <h3 id="modalTitle" class="text-2xl font-bold">Upload Foto</h3>
            <button onclick="closeModal()" class="text-gray-500 hover:text-gray-700">
                <i class="fas fa-times text-2xl"></i>
            </button>
        </div>

        <form id="photoForm" enctype="multipart/form-data">
            <input type="hidden" id="photoId" name="id">

            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Judul Foto *</label>
                    <input type="text" id="title" name="title" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Gambar *</label>
                    <input type="file" id="image" name="image" accept="image/*"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                    <p class="text-sm text-gray-500 mt-1">Kosongkan jika edit dan tidak ingin mengubah gambar</p>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Kategori</label>
                    <input type="text" id="category" name="category"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500"
                        placeholder="Contoh: Kegiatan, Lomba, dll">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Keterangan</label>
                    <textarea id="caption" name="caption" rows="3"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500"></textarea>
                </div>
            </div>

            <div class="flex space-x-4 mt-6">
                <button type="submit" class="flex-1 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition">
                    <i class="fas fa-save mr-2"></i>Simpan
                </button>
                <button type="button" onclick="closeModal()" class="flex-1 bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded-lg transition">
                    Batal
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function openCreateModal() {
    document.getElementById('modalTitle').textContent = 'Upload Foto';
    document.getElementById('photoForm').reset();
    document.getElementById('photoId').value = '';
    document.getElementById('photoModal').classList.remove('hidden');
    document.getElementById('photoModal').classList.add('flex');
}

function closeModal() {
    document.getElementById('photoModal').classList.add('hidden');
    document.getElementById('photoModal').classList.remove('flex');
}

function viewPhoto(id) {
    fetch(`<?= BASE_URL ?>admin/getPhoto/${id}`)
        .then(response => response.json())
        .then(photo => {
            alert(`Judul: ${photo.title}\nKategori: ${photo.category || '-'}\nKeterangan: ${photo.caption || '-'}`);
        });
}

async function editPhoto(id) {
    try {
        const response = await fetch(`<?= BASE_URL ?>admin/getPhoto/${id}`);
        const photo = await response.json();
        
        document.getElementById('modalTitle').textContent = 'Edit Foto';
        document.getElementById('photoId').value = photo.id;
        document.getElementById('title').value = photo.title;
        document.getElementById('category').value = photo.category || '';
        document.getElementById('caption').value = photo.caption || '';
        
        document.getElementById('photoModal').classList.remove('hidden');
        document.getElementById('photoModal').classList.add('flex');
    } catch (error) {
        showAlert('Gagal mengambil data foto', 'error');
    }
}

document.getElementById('photoForm').addEventListener('submit', async function(e) {
    e.preventDefault();
    
    const formData = new FormData(this);
    const id = document.getElementById('photoId').value;
    const url = id ? '<?= BASE_URL ?>admin/updatePhoto' : '<?= BASE_URL ?>admin/createPhoto';
    
    try {
        const response = await fetch(url, {
            method: 'POST',
            body: formData
        });
        
        const result = await response.json();
        
        if (result.success) {
            showAlert(result.message, 'success');
            closeModal();
            setTimeout(() => location.reload(), 1000);
        } else {
            showAlert(result.message, 'error');
        }
    } catch (error) {
        showAlert('Terjadi kesalahan', 'error');
    }
});

async function deletePhoto(id) {
    if (!confirm('Apakah Anda yakin ingin menghapus foto ini?')) return;
    
    try {
        const response = await fetch(`<?= BASE_URL ?>admin/deletePhoto/${id}`, {
            method: 'POST'
        });
        
        const result = await response.json();
        
        if (result.success) {
            showAlert(result.message, 'success');
            setTimeout(() => location.reload(), 1000);
        } else {
            showAlert(result.message, 'error');
        }
    } catch (error) {
        showAlert('Terjadi kesalahan', 'error');
    }
}
</script>

<?php require_once '../app/views/layouts/admin_footer.php'; ?>
