<?php require_once '../app/views/layouts/header.php'; ?>

<div class="container mx-auto px-4 py-12">
    <!-- Page Header -->
    <div class="bg-gradient-to-r from-blue-600 to-indigo-600 rounded-lg shadow-lg p-8 mb-8 text-white">
        <h1 class="text-4xl font-bold mb-2">Hubungi Kami</h1>
        <p class="text-lg">Silakan hubungi kami untuk informasi lebih lanjut</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Contact Information -->
        <div>
            <div class="bg-white rounded-lg shadow-md p-8 mb-6">
                <h2 class="text-2xl font-bold mb-6">Informasi Kontak</h2>
                
                <div class="space-y-6">
                    <div class="flex items-start">
                        <div class="bg-blue-100 p-3 rounded-full mr-4">
                            <i class="fas fa-map-marker-alt text-blue-600 text-xl"></i>
                        </div>
                        <div>
                            <h3 class="font-bold text-lg mb-1">Alamat</h3>
                            <p class="text-gray-600"><?= htmlspecialchars($contact['address'] ?? $settings['address'] ?? '') ?></p>
                        </div>
                    </div>

                    <div class="flex items-start">
                        <div class="bg-green-100 p-3 rounded-full mr-4">
                            <i class="fas fa-phone text-green-600 text-xl"></i>
                        </div>
                        <div>
                            <h3 class="font-bold text-lg mb-1">Telepon</h3>
                            <p class="text-gray-600"><?= htmlspecialchars($contact['phone'] ?? $settings['phone'] ?? '') ?></p>
                        </div>
                    </div>

                    <div class="flex items-start">
                        <div class="bg-purple-100 p-3 rounded-full mr-4">
                            <i class="fas fa-envelope text-purple-600 text-xl"></i>
                        </div>
                        <div>
                            <h3 class="font-bold text-lg mb-1">Email</h3>
                            <p class="text-gray-600"><?= htmlspecialchars($contact['email'] ?? $settings['email'] ?? '') ?></p>
                        </div>
                    </div>

                    <?php if ($contact['whatsapp'] ?? ''): ?>
                        <div class="flex items-start">
                            <div class="bg-green-100 p-3 rounded-full mr-4">
                                <i class="fab fa-whatsapp text-green-600 text-xl"></i>
                            </div>
                            <div>
                                <h3 class="font-bold text-lg mb-1">WhatsApp</h3>
                                <a href="https://wa.me/<?= $contact['whatsapp'] ?>" 
                                   target="_blank"
                                   class="text-green-600 hover:underline"><?= htmlspecialchars($contact['whatsapp']) ?></a>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Social Media -->
            <div class="bg-white rounded-lg shadow-md p-8">
                <h2 class="text-2xl font-bold mb-6">Media Sosial</h2>
                <div class="grid grid-cols-2 gap-4">
                    <?php if ($contact['facebook'] ?? ''): ?>
                        <a href="<?= htmlspecialchars($contact['facebook']) ?>" 
                           target="_blank"
                           class="flex items-center justify-center bg-blue-600 hover:bg-blue-700 text-white p-4 rounded-lg transition">
                            <i class="fab fa-facebook-f text-2xl mr-3"></i>
                            <span class="font-semibold">Facebook</span>
                        </a>
                    <?php endif; ?>

                    <?php if ($contact['instagram'] ?? ''): ?>
                        <a href="<?= htmlspecialchars($contact['instagram']) ?>" 
                           target="_blank"
                           class="flex items-center justify-center bg-gradient-to-br from-purple-600 to-pink-500 hover:from-purple-700 hover:to-pink-600 text-white p-4 rounded-lg transition">
                            <i class="fab fa-instagram text-2xl mr-3"></i>
                            <span class="font-semibold">Instagram</span>
                        </a>
                    <?php endif; ?>

                    <?php if ($contact['twitter'] ?? ''): ?>
                        <a href="<?= htmlspecialchars($contact['twitter']) ?>" 
                           target="_blank"
                           class="flex items-center justify-center bg-blue-400 hover:bg-blue-500 text-white p-4 rounded-lg transition">
                            <i class="fab fa-twitter text-2xl mr-3"></i>
                            <span class="font-semibold">Twitter</span>
                        </a>
                    <?php endif; ?>

                    <?php if ($contact['youtube'] ?? ''): ?>
                        <a href="<?= htmlspecialchars($contact['youtube']) ?>" 
                           target="_blank"
                           class="flex items-center justify-center bg-red-600 hover:bg-red-700 text-white p-4 rounded-lg transition">
                            <i class="fab fa-youtube text-2xl mr-3"></i>
                            <span class="font-semibold">YouTube</span>
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Map -->
        <div>
            <div class="bg-white rounded-lg shadow-md overflow-hidden" style="height: 600px;">
                <?php if ($contact['maps_embed'] ?? ''): ?>
                    <iframe src="<?= htmlspecialchars($contact['maps_embed']) ?>" 
                            class="w-full h-full" 
                            style="border:0;" 
                            allowfullscreen="" 
                            loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"></iframe>
                <?php else: ?>
                    <div class="w-full h-full flex items-center justify-center bg-gray-100">
                        <div class="text-center text-gray-500">
                            <i class="fas fa-map-marked-alt text-6xl mb-4"></i>
                            <p class="text-lg">Google Maps belum tersedia</p>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php require_once '../app/views/layouts/footer.php'; ?>
