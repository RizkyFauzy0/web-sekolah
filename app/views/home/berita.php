<?php require_once '../app/views/layouts/header.php'; ?>

<div class="container mx-auto px-4 py-12">
    <!-- Page Header -->
    <div class="bg-gradient-to-r from-blue-600 to-purple-600 rounded-lg shadow-lg p-8 mb-8 text-white">
        <h1 class="text-4xl font-bold mb-2">Berita Sekolah</h1>
        <p class="text-lg">Informasi terkini seputar kegiatan sekolah</p>
    </div>

    <!-- News Grid -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <?php if (!empty($newsList)): ?>
            <?php foreach ($newsList as $news): ?>
                <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition transform hover:-translate-y-2 animate-fade-in">
                    <?php if ($news['image']): ?>
                        <img src="<?= BASE_URL . $news['image'] ?>" alt="<?= htmlspecialchars($news['title']) ?>" 
                             class="w-full h-48 object-cover">
                    <?php else: ?>
                        <div class="w-full h-48 bg-gradient-to-br from-blue-400 to-purple-500 flex items-center justify-center">
                            <i class="fas fa-newspaper text-white text-5xl"></i>
                        </div>
                    <?php endif; ?>
                    
                    <div class="p-6">
                        <div class="flex items-center text-sm text-gray-500 mb-3">
                            <i class="far fa-calendar mr-2"></i>
                            <span><?= date('d F Y', strtotime($news['publish_date'])) ?></span>
                            <span class="mx-2">•</span>
                            <i class="far fa-eye mr-2"></i>
                            <span><?= $news['views'] ?> views</span>
                        </div>
                        
                        <h3 class="text-xl font-bold mb-3 line-clamp-2 hover:text-blue-600 transition">
                            <a href="<?= BASE_URL ?>home/berita/<?= $news['slug'] ?>">
                                <?= htmlspecialchars($news['title']) ?>
                            </a>
                        </h3>
                        
                        <p class="text-gray-600 mb-4 line-clamp-3">
                            <?= strip_tags(substr($news['content'], 0, 150)) ?>...
                        </p>
                        
                        <a href="<?= BASE_URL ?>home/berita/<?= $news['slug'] ?>" 
                           class="inline-flex items-center text-blue-600 hover:text-blue-800 font-semibold transition">
                            Baca Selengkapnya <i class="fas fa-arrow-right ml-2"></i>
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="col-span-3 text-center py-12">
                <i class="fas fa-newspaper text-gray-300 text-6xl mb-4"></i>
                <p class="text-gray-500 text-lg">Belum ada berita tersedia</p>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php require_once '../app/views/layouts/footer.php'; ?>
