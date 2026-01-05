<?php require_once '../app/views/layouts/admin_header.php'; ?>

<div class="bg-white rounded-lg shadow-md p-6">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold">Manajemen Guru</h2>
        <button onclick="openCreateModal()" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition">
            <i class="fas fa-plus mr-2"></i>Tambah Guru
        </button>
    </div>

    <div class="overflow-x-auto">
        <table id="teachersTable" class="w-full">
            <thead>
                <tr class="bg-gray-100">
                    <th class="p-3 text-left">Foto</th>
                    <th class="p-3 text-left">Nama</th>
                    <th class="p-3 text-left">Mata Pelajaran</th>
                    <th class="p-3 text-left">Email</th>
                    <th class="p-3 text-left">Telepon</th>
                    <th class="p-3 text-left">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($teachers)): ?>
                    <?php foreach ($teachers as $teacher): ?>
                        <tr class="border-b hover:bg-gray-50">
                            <td class="p-3">
                                <?php if ($teacher['photo']): ?>
                                    <img src="<?= BASE_URL . $teacher['photo'] ?>" alt="Teacher" class="w-12 h-12 rounded-full object-cover">
                                <?php else: ?>
                                    <div class="w-12 h-12 rounded-full bg-gray-300 flex items-center justify-center">
                                        <i class="fas fa-user text-gray-600"></i>
                                    </div>
                                <?php endif; ?>
                            </td>
                            <td class="p-3"><?= htmlspecialchars($teacher['name']) ?></td>
                            <td class="p-3"><?= htmlspecialchars($teacher['subject']) ?></td>
                            <td class="p-3"><?= htmlspecialchars($teacher['email']) ?></td>
                            <td class="p-3"><?= htmlspecialchars($teacher['phone']) ?></td>
                            <td class="p-3">
                                <button onclick="editTeacher(<?= $teacher['id'] ?>)" class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded mr-2 transition">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button onclick="deleteTeacher(<?= $teacher['id'] ?>)" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded transition">
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
<div id="teacherModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-lg p-8 max-w-2xl w-full mx-4 max-h-[90vh] overflow-y-auto">
        <div class="flex justify-between items-center mb-6">
            <h3 id="modalTitle" class="text-2xl font-bold">Tambah Guru</h3>
            <button onclick="closeModal()" class="text-gray-500 hover:text-gray-700">
                <i class="fas fa-times text-2xl"></i>
            </button>
        </div>

        <form id="teacherForm" enctype="multipart/form-data">
            <input type="hidden" id="teacherId" name="id">

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Foto</label>
                    <input type="file" id="photo" name="photo" accept="image/*"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap *</label>
                    <input type="text" id="name" name="name" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Mata Pelajaran *</label>
                    <input type="text" id="subject" name="subject" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                    <input type="email" id="email" name="email"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Telepon</label>
                    <input type="text" id="phone" name="phone"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Urutan</label>
                    <input type="number" id="sort_order" name="sort_order" value="0"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                </div>

                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Deskripsi</label>
                    <textarea id="description" name="description" rows="3"
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
$(document).ready(function() {
    $('#teachersTable').DataTable({
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.13.7/i18n/id.json"
        }
    });
});

function openCreateModal() {
    document.getElementById('modalTitle').textContent = 'Tambah Guru';
    document.getElementById('teacherForm').reset();
    document.getElementById('teacherId').value = '';
    document.getElementById('teacherModal').classList.remove('hidden');
    document.getElementById('teacherModal').classList.add('flex');
}

function closeModal() {
    document.getElementById('teacherModal').classList.add('hidden');
    document.getElementById('teacherModal').classList.remove('flex');
}

async function editTeacher(id) {
    try {
        const response = await fetch(`<?= BASE_URL ?>admin/getTeacher/${id}`);
        const teacher = await response.json();
        
        document.getElementById('modalTitle').textContent = 'Edit Guru';
        document.getElementById('teacherId').value = teacher.id;
        document.getElementById('name').value = teacher.name;
        document.getElementById('subject').value = teacher.subject;
        document.getElementById('email').value = teacher.email || '';
        document.getElementById('phone').value = teacher.phone || '';
        document.getElementById('sort_order').value = teacher.sort_order;
        document.getElementById('description').value = teacher.description || '';
        
        document.getElementById('teacherModal').classList.remove('hidden');
        document.getElementById('teacherModal').classList.add('flex');
    } catch (error) {
        showAlert('Gagal mengambil data guru', 'error');
    }
}

document.getElementById('teacherForm').addEventListener('submit', async function(e) {
    e.preventDefault();
    
    const formData = new FormData(this);
    const id = document.getElementById('teacherId').value;
    const url = id ? '<?= BASE_URL ?>admin/updateTeacher' : '<?= BASE_URL ?>admin/createTeacher';
    
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

async function deleteTeacher(id) {
    if (!confirm('Apakah Anda yakin ingin menghapus data guru ini?')) return;
    
    try {
        const response = await fetch(`<?= BASE_URL ?>admin/deleteTeacher/${id}`, {
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
