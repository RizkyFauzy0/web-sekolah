<?php require_once '../app/views/layouts/admin_header.php'; ?>

<div class="bg-white rounded-lg shadow-md p-6">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold">Manajemen Berita</h2>
        <button onclick="openCreateModal()" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition">
            <i class="fas fa-plus mr-2"></i>Tambah Berita
        </button>
    </div>

    <div class="overflow-x-auto">
        <table id="newsTable" class="w-full">
            <thead>
                <tr class="bg-gray-100">
                    <th class="p-3 text-left">ID</th>
                    <th class="p-3 text-left">Gambar</th>
                    <th class="p-3 text-left">Judul</th>
                    <th class="p-3 text-left">Penulis</th>
                    <th class="p-3 text-left">Tanggal</th>
                    <th class="p-3 text-left">Views</th>
                    <th class="p-3 text-left">Status</th>
                    <th class="p-3 text-left">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($newsList)): ?>
                    <?php foreach ($newsList as $news): ?>
                        <tr class="border-b hover:bg-gray-50">
                            <td class="p-3"><?= $news['id'] ?></td>
                            <td class="p-3">
                                <?php if ($news['image']): ?>
                                    <img src="<?= BASE_URL . $news['image'] ?>" alt="News" class="w-20 h-12 object-cover rounded">
                                <?php else: ?>
                                    <span class="text-gray-400">No image</span>
                                <?php endif; ?>
                            </td>
                            <td class="p-3 max-w-xs truncate"><?= htmlspecialchars($news['title']) ?></td>
                            <td class="p-3"><?= htmlspecialchars($news['author']) ?></td>
                            <td class="p-3"><?= date('d/m/Y', strtotime($news['publish_date'])) ?></td>
                            <td class="p-3"><?= $news['views'] ?></td>
                            <td class="p-3">
                                <span class="px-2 py-1 rounded text-sm <?= $news['is_published'] ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' ?>">
                                    <?= $news['is_published'] ? 'Published' : 'Draft' ?>
                                </span>
                            </td>
                            <td class="p-3">
                                <button onclick="editNews(<?= $news['id'] ?>)" class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded mr-2 transition">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button onclick="deleteNews(<?= $news['id'] ?>)" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded transition">
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
<div id="newsModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-lg p-8 max-w-4xl w-full mx-4 max-h-[90vh] overflow-y-auto">
        <div class="flex justify-between items-center mb-6">
            <h3 id="modalTitle" class="text-2xl font-bold">Tambah Berita</h3>
            <button onclick="closeModal()" class="text-gray-500 hover:text-gray-700">
                <i class="fas fa-times text-2xl"></i>
            </button>
        </div>

        <form id="newsForm" enctype="multipart/form-data">
            <input type="hidden" id="newsId" name="id">

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Judul Berita *</label>
                    <input type="text" id="title" name="title" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                </div>

                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Konten Berita *</label>
                    <textarea id="content" name="content" rows="8" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500"></textarea>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Gambar</label>
                    <input type="file" id="image" name="image" accept="image/*"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                    <p class="text-sm text-gray-500 mt-1">Kosongkan jika tidak ingin mengubah gambar</p>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Penulis</label>
                    <input type="text" id="author" name="author" value="<?= $_SESSION['admin_name'] ?>"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Publish *</label>
                    <input type="date" id="publish_date" name="publish_date" value="<?= date('Y-m-d') ?>" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                </div>

                <div class="flex items-center">
                    <label class="flex items-center cursor-pointer">
                        <input type="checkbox" id="is_published" name="is_published" value="1" checked
                            class="mr-2 h-4 w-4 text-blue-600">
                        <span class="text-sm font-medium text-gray-700">Publish Sekarang</span>
                    </label>
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
$(document).ready(function() {
    $('#newsTable').DataTable({
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.13.7/i18n/id.json"
        },
        "order": [[4, "desc"]]
    });
});

function openCreateModal() {
    document.getElementById('modalTitle').textContent = 'Tambah Berita';
    document.getElementById('newsForm').reset();
    document.getElementById('newsId').value = '';
    document.getElementById('publish_date').value = '<?= date('Y-m-d') ?>';
    document.getElementById('author').value = '<?= $_SESSION['admin_name'] ?>';
    document.getElementById('newsModal').classList.remove('hidden');
    document.getElementById('newsModal').classList.add('flex');
}

function closeModal() {
    document.getElementById('newsModal').classList.add('hidden');
    document.getElementById('newsModal').classList.remove('flex');
}

async function editNews(id) {
    try {
        const response = await fetch(`<?= BASE_URL ?>admin/getNews/${id}`);
        const news = await response.json();
        
        document.getElementById('modalTitle').textContent = 'Edit Berita';
        document.getElementById('newsId').value = news.id;
        document.getElementById('title').value = news.title;
        document.getElementById('content').value = news.content;
        document.getElementById('author').value = news.author;
        document.getElementById('publish_date').value = news.publish_date;
        document.getElementById('is_published').checked = news.is_published == 1;
        
        document.getElementById('newsModal').classList.remove('hidden');
        document.getElementById('newsModal').classList.add('flex');
    } catch (error) {
        showAlert('Gagal mengambil data berita', 'error');
    }
}

document.getElementById('newsForm').addEventListener('submit', async function(e) {
    e.preventDefault();
    
    const formData = new FormData(this);
    const id = document.getElementById('newsId').value;
    const url = id ? '<?= BASE_URL ?>admin/updateNews' : '<?= BASE_URL ?>admin/createNews';
    
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

async function deleteNews(id) {
    if (!confirm('Apakah Anda yakin ingin menghapus berita ini?')) return;
    
    try {
        const response = await fetch(`<?= BASE_URL ?>admin/deleteNews/${id}`, {
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
