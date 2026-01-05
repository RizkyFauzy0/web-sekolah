<?php require_once '../app/views/layouts/admin_header.php'; ?>

<div class="bg-white rounded-lg shadow-md p-6">
    <h2 class="text-2xl font-bold mb-6">Manajemen Kontak</h2>

    <form id="contactForm" class="space-y-6">
        <input type="hidden" name="id" value="<?= $contact['id'] ?? '' ?>">

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-2">Alamat Lengkap *</label>
                <textarea name="address" rows="3" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500"><?= htmlspecialchars($contact['address'] ?? '') ?></textarea>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Telepon</label>
                <input type="text" name="phone" value="<?= htmlspecialchars($contact['phone'] ?? '') ?>"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                <input type="email" name="email" value="<?= htmlspecialchars($contact['email'] ?? '') ?>"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">WhatsApp (62xxx)</label>
                <input type="text" name="whatsapp" value="<?= htmlspecialchars($contact['whatsapp'] ?? '') ?>"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500"
                    placeholder="628123456789">
            </div>
        </div>

        <div class="border-t pt-6">
            <h3 class="text-lg font-bold mb-4">Media Sosial</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fab fa-facebook text-blue-600 mr-2"></i>Facebook URL
                    </label>
                    <input type="url" name="facebook" value="<?= htmlspecialchars($contact['facebook'] ?? '') ?>"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500"
                        placeholder="https://facebook.com/yourpage">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fab fa-instagram text-pink-600 mr-2"></i>Instagram URL
                    </label>
                    <input type="url" name="instagram" value="<?= htmlspecialchars($contact['instagram'] ?? '') ?>"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500"
                        placeholder="https://instagram.com/yourpage">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fab fa-twitter text-blue-400 mr-2"></i>Twitter URL
                    </label>
                    <input type="url" name="twitter" value="<?= htmlspecialchars($contact['twitter'] ?? '') ?>"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500"
                        placeholder="https://twitter.com/yourpage">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fab fa-youtube text-red-600 mr-2"></i>YouTube URL
                    </label>
                    <input type="url" name="youtube" value="<?= htmlspecialchars($contact['youtube'] ?? '') ?>"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500"
                        placeholder="https://youtube.com/yourchannel">
                </div>
            </div>
        </div>

        <div class="border-t pt-6">
            <h3 class="text-lg font-bold mb-4">Google Maps</h3>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Google Maps Embed Code</label>
                <textarea name="maps_embed" rows="4"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500"
                    placeholder="Paste Google Maps embed URL here..."><?= htmlspecialchars($contact['maps_embed'] ?? '') ?></textarea>
                <p class="text-sm text-gray-500 mt-1">
                    Buka Google Maps → Share → Embed a map → Copy HTML → Paste src URL di sini
                </p>
            </div>
        </div>

        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg transition">
            <i class="fas fa-save mr-2"></i>Simpan Kontak
        </button>
    </form>
</div>

<script>
document.getElementById('contactForm').addEventListener('submit', async function(e) {
    e.preventDefault();
    
    const formData = new FormData(this);
    
    try {
        const response = await fetch('<?= BASE_URL ?>admin/updateContact', {
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
