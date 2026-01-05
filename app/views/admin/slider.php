<?php require_once '../app/views/layouts/admin_header.php'; ?>

<div class="bg-white rounded-lg shadow-md p-6">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold">Manajemen Slider</h2>
        <button onclick="openCreateModal()" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition">
            <i class="fas fa-plus mr-2"></i>Tambah Slider
        </button>
    </div>

    <div class="overflow-x-auto">
        <table id="sliderTable" class="w-full">
            <thead>
                <tr class="bg-gray-100">
                    <th class="p-3 text-left">ID</th>
                    <th class="p-3 text-left">Gambar</th>
                    <th class="p-3 text-left">Judul</th>
                    <th class="p-3 text-left">Urutan</th>
                    <th class="p-3 text-left">Status</th>
                    <th class="p-3 text-left">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($sliders)): ?>
                    <?php foreach ($sliders as $slider): ?>
                        <tr class="border-b hover:bg-gray-50">
                            <td class="p-3"><?= $slider['id'] ?></td>
                            <td class="p-3">
                                <?php if ($slider['image']): ?>
                                    <img src="<?= BASE_URL . $slider['image'] ?>" alt="Slider" class="w-20 h-12 object-cover rounded">
                                <?php else: ?>
                                    <span class="text-gray-400">No image</span>
                                <?php endif; ?>
                            </td>
                            <td class="p-3"><?= htmlspecialchars($slider['title']) ?></td>
                            <td class="p-3"><?= $slider['sort_order'] ?></td>
                            <td class="p-3">
                                <span class="px-2 py-1 rounded text-sm <?= $slider['is_active'] ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' ?>">
                                    <?= $slider['is_active'] ? 'Aktif' : 'Nonaktif' ?>
                                </span>
                            </td>
                            <td class="p-3">
                                <button onclick="editSlider(<?= $slider['id'] ?>)" class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded mr-2 transition">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button onclick="deleteSlider(<?= $slider['id'] ?>)" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded transition">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Create/Edit Modal -->
<div id="sliderModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-lg p-8 max-w-2xl w-full mx-4 max-h-[90vh] overflow-y-auto">
        <div class="flex justify-between items-center mb-6">
            <h3 id="modalTitle" class="text-2xl font-bold">Tambah Slider</h3>
            <button onclick="closeModal()" class="text-gray-500 hover:text-gray-700">
                <i class="fas fa-times text-2xl"></i>
            </button>
        </div>

        <form id="sliderForm" enctype="multipart/form-data">
            <input type="hidden" id="sliderId" name="id">

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Judul</label>
                <input type="text" id="title" name="title" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Deskripsi</label>
                <textarea id="description" name="description" rows="3"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500"></textarea>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Gambar</label>
                <input type="file" id="image" name="image" accept="image/*"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                <p class="text-sm text-gray-500 mt-1">Kosongkan jika tidak ingin mengubah gambar</p>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Urutan</label>
                <input type="number" id="sort_order" name="sort_order" value="0"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
            </div>

            <div class="mb-6">
                <label class="flex items-center">
                    <input type="checkbox" id="is_active" name="is_active" value="1" checked
                        class="mr-2 h-4 w-4 text-blue-600">
                    <span class="text-sm font-medium text-gray-700">Aktif</span>
                </label>
            </div>

            <div class="flex space-x-4">
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
$(document).ready(function() {
    $('#sliderTable').DataTable({
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.13.7/i18n/id.json"
        }
    });
});

function openCreateModal() {
    document.getElementById('modalTitle').textContent = 'Tambah Slider';
    document.getElementById('sliderForm').reset();
    document.getElementById('sliderId').value = '';
    document.getElementById('sliderModal').classList.remove('hidden');
    document.getElementById('sliderModal').classList.add('flex');
}

function closeModal() {
    document.getElementById('sliderModal').classList.add('hidden');
    document.getElementById('sliderModal').classList.remove('flex');
}

async function editSlider(id) {
    try {
        const response = await fetch(`<?= BASE_URL ?>admin/getSlider/${id}`);
        const slider = await response.json();
        
        document.getElementById('modalTitle').textContent = 'Edit Slider';
        document.getElementById('sliderId').value = slider.id;
        document.getElementById('title').value = slider.title;
        document.getElementById('description').value = slider.description;
        document.getElementById('sort_order').value = slider.sort_order;
        document.getElementById('is_active').checked = slider.is_active == 1;
        
        document.getElementById('sliderModal').classList.remove('hidden');
        document.getElementById('sliderModal').classList.add('flex');
    } catch (error) {
        showAlert('Gagal mengambil data slider', 'error');
    }
}

document.getElementById('sliderForm').addEventListener('submit', async function(e) {
    e.preventDefault();
    
    const formData = new FormData(this);
    const id = document.getElementById('sliderId').value;
    const url = id ? '<?= BASE_URL ?>admin/updateSlider' : '<?= BASE_URL ?>admin/createSlider';
    
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

async function deleteSlider(id) {
    if (!confirm('Apakah Anda yakin ingin menghapus slider ini?')) return;
    
    try {
        const response = await fetch(`<?= BASE_URL ?>admin/deleteSlider/${id}`, {
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
