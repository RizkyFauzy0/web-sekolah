<?php require_once '../app/views/layouts/header.php'; ?>

<div class="container mx-auto px-4 py-12">
    <!-- Page Header -->
    <div class="bg-gradient-to-r from-purple-600 to-pink-600 rounded-lg shadow-lg p-8 mb-8 text-white">
        <h1 class="text-4xl font-bold mb-2">Link Aplikasi</h1>
        <p class="text-lg">Akses cepat ke aplikasi dan layanan sekolah</p>
    </div>

    <!-- App Links Grid -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <?php if (!empty($appLinks)): ?>
            <?php foreach ($appLinks as $link): ?>
                <a href="<?= htmlspecialchars($link['url']) ?>" 
                   target="_blank"
                   class="bg-white rounded-lg shadow-lg p-8 hover:shadow-xl transition transform hover:-translate-y-2 group">
                    <div class="text-center">
                        <?php if ($link['icon']): ?>
                            <img src="<?= BASE_URL . $link['icon'] ?>" 
                                 alt="<?= htmlspecialchars($link['name']) ?>" 
                                 class="w-24 h-24 mx-auto mb-4 object-contain">
                        <?php else: ?>
                            <div class="w-24 h-24 mx-auto mb-4 bg-gradient-to-br from-purple-400 to-pink-500 rounded-full flex items-center justify-center">
                                <i class="fas fa-link text-white text-4xl"></i>
                            </div>
                        <?php endif; ?>
                        
                        <h3 class="text-xl font-bold mb-2 group-hover:text-purple-600 transition">
                            <?= htmlspecialchars($link['name']) ?>
                        </h3>
                        
                        <?php if ($link['description']): ?>
                            <p class="text-gray-600 text-sm mb-4"><?= htmlspecialchars($link['description']) ?></p>
                        <?php endif; ?>
                        
                        <div class="inline-flex items-center text-purple-600 font-semibold">
                            Buka Aplikasi <i class="fas fa-external-link-alt ml-2"></i>
                        </div>
                    </div>
                </a>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="col-span-3 text-center py-12">
                <i class="fas fa-link text-gray-300 text-6xl mb-4"></i>
                <p class="text-gray-500 text-lg">Belum ada link aplikasi tersedia</p>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php require_once '../app/views/layouts/footer.php'; ?>
