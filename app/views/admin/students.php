<?php require_once '../app/views/layouts/admin_header.php'; ?>

<div class="bg-white rounded-lg shadow-md p-6">
    <h2 class="text-2xl font-bold mb-6">Data Siswa</h2>

    <form id="studentsForm" class="max-w-2xl">
        <input type="hidden" name="id" value="<?= $studentStats['id'] ?? '' ?>">

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Total Siswa</label>
                <input type="number" name="total_students" value="<?= $studentStats['total_students'] ?? 0 ?>" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Tahun Ajaran</label>
                <input type="text" value="<?= $studentStats['year'] ?? date('Y') ?>" disabled
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg bg-gray-100">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Siswa Laki-laki</label>
                <input type="number" name="male_students" value="<?= $studentStats['male_students'] ?? 0 ?>" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Siswa Perempuan</label>
                <input type="number" name="female_students" value="<?= $studentStats['female_students'] ?? 0 ?>" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
            </div>
        </div>

        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg transition">
            <i class="fas fa-save mr-2"></i>Simpan Data
        </button>
    </form>

    <!-- Statistics Preview -->
    <div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-4">
        <div class="bg-blue-100 rounded-lg p-6">
            <div class="text-center">
                <i class="fas fa-users text-blue-600 text-4xl mb-2"></i>
                <p class="text-sm text-gray-600 mb-1">Total Siswa</p>
                <p class="text-3xl font-bold text-blue-600"><?= $studentStats['total_students'] ?? 0 ?></p>
            </div>
        </div>
        <div class="bg-green-100 rounded-lg p-6">
            <div class="text-center">
                <i class="fas fa-male text-green-600 text-4xl mb-2"></i>
                <p class="text-sm text-gray-600 mb-1">Laki-laki</p>
                <p class="text-3xl font-bold text-green-600"><?= $studentStats['male_students'] ?? 0 ?></p>
            </div>
        </div>
        <div class="bg-pink-100 rounded-lg p-6">
            <div class="text-center">
                <i class="fas fa-female text-pink-600 text-4xl mb-2"></i>
                <p class="text-sm text-gray-600 mb-1">Perempuan</p>
                <p class="text-3xl font-bold text-pink-600"><?= $studentStats['female_students'] ?? 0 ?></p>
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById('studentsForm').addEventListener('submit', async function(e) {
    e.preventDefault();
    
    const formData = new FormData(this);
    
    try {
        const response = await fetch('<?= BASE_URL ?>admin/updateStudents', {
            method: 'POST',
            body: formData
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
});
</script>

<?php require_once '../app/views/layouts/admin_footer.php'; ?>
