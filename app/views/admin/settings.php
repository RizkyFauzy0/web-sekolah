<?php require_once '../app/views/layouts/admin_header.php'; ?>

<div class="bg-white rounded-lg shadow-md p-6">
    <h2 class="text-2xl font-bold mb-6">Pengaturan Sekolah</h2>

    <form id="settingsForm" enctype="multipart/form-data" class="space-y-6">
        <input type="hidden" name="id" value="<?= $settings['id'] ?? '' ?>">

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-2">Nama Sekolah *</label>
                <input type="text" name="school_name" value="<?= htmlspecialchars($settings['school_name'] ?? '') ?>" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
            </div>

            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-2">Alamat *</label>
                <textarea name="address" rows="3" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500"><?= htmlspecialchars($settings['address'] ?? '') ?></textarea>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Telepon</label>
                <input type="text" name="phone" value="<?= htmlspecialchars($settings['phone'] ?? '') ?>"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                <input type="email" name="email" value="<?= htmlspecialchars($settings['email'] ?? '') ?>"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Website</label>
                <input type="text" name="website" value="<?= htmlspecialchars($settings['website'] ?? '') ?>"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Logo</label>
                <input type="file" name="logo" accept="image/*"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                <?php if ($settings['logo'] ?? ''): ?>
                    <img src="<?= BASE_URL . $settings['logo'] ?>" alt="Logo" class="mt-2 h-16">
                <?php endif; ?>
            </div>
        </div>

        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg transition">
            <i class="fas fa-save mr-2"></i>Simpan Pengaturan
        </button>
    </form>
</div>

<script>
document.getElementById('settingsForm').addEventListener('submit', async function(e) {
    e.preventDefault();
    
    const formData = new FormData(this);
    
    try {
        const response = await fetch('<?= BASE_URL ?>admin/updateSettings', {
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
