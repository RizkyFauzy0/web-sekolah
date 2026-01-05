<?php require_once '../app/views/layouts/admin_header.php'; ?>

<div class="bg-white rounded-lg shadow-md p-6">
    <h2 class="text-2xl font-bold mb-6">Profil Sekolah</h2>

    <form id="profileForm" enctype="multipart/form-data" class="space-y-6">
        <input type="hidden" name="id" value="<?= $profile['id'] ?? '' ?>">

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Visi</label>
            <textarea name="vision" rows="4" required
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500"><?= htmlspecialchars($profile['vision'] ?? '') ?></textarea>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Misi</label>
            <textarea name="mission" rows="6" required
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500"><?= htmlspecialchars($profile['mission'] ?? '') ?></textarea>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Sejarah Singkat</label>
            <textarea name="history" rows="6" required
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500"><?= htmlspecialchars($profile['history'] ?? '') ?></textarea>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Struktur Organisasi (Gambar)</label>
            <input type="file" name="organizational_structure" accept="image/*"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
            <?php if ($profile['organizational_structure'] ?? ''): ?>
                <img src="<?= BASE_URL . $profile['organizational_structure'] ?>" alt="Struktur" class="mt-2 max-w-md">
            <?php endif; ?>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Keunggulan</label>
            <textarea name="advantages" rows="6" required
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500"><?= htmlspecialchars($profile['advantages'] ?? '') ?></textarea>
        </div>

        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg transition">
            <i class="fas fa-save mr-2"></i>Simpan Profil
        </button>
    </form>
</div>

<script>
document.getElementById('profileForm').addEventListener('submit', async function(e) {
    e.preventDefault();
    
    const formData = new FormData(this);
    
    try {
        const response = await fetch('<?= BASE_URL ?>admin/updateProfile', {
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
