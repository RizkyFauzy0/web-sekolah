<?php require_once '../app/views/layouts/header.php'; ?>

<div class="container mx-auto px-4 py-12">
    <article class="max-w-4xl mx-auto">
        <!-- Article Header -->
        <div class="mb-8">
            <a href="<?= BASE_URL ?>home/berita" class="text-blue-600 hover:text-blue-800 mb-4 inline-block">
                <i class="fas fa-arrow-left mr-2"></i>Kembali ke Berita
            </a>
            
            <h1 class="text-4xl font-bold mb-4"><?= htmlspecialchars($news['title']) ?></h1>
            
            <div class="flex items-center text-gray-600 mb-6">
                <i class="far fa-calendar mr-2"></i>
                <span><?= date('d F Y', strtotime($news['publish_date'])) ?></span>
                <span class="mx-3">•</span>
                <i class="far fa-user mr-2"></i>
                <span><?= htmlspecialchars($news['author']) ?></span>
                <span class="mx-3">•</span>
                <i class="far fa-eye mr-2"></i>
                <span><?= $news['views'] ?> views</span>
            </div>
        </div>

        <!-- Featured Image -->
        <?php if ($news['image']): ?>
            <div class="mb-8 rounded-lg overflow-hidden shadow-lg">
                <img src="<?= BASE_URL . $news['image'] ?>" alt="<?= htmlspecialchars($news['title']) ?>" 
                     class="w-full h-auto">
            </div>
        <?php endif; ?>

        <!-- Article Content -->
        <div class="prose prose-lg max-w-none mb-12">
            <?= nl2br($news['content']) ?>
        </div>

        <!-- Share Buttons -->
        <div class="border-t border-gray-200 pt-8 mb-8">
            <h3 class="text-lg font-bold mb-4">Bagikan Berita</h3>
            <div class="flex space-x-4">
                <a href="https://www.facebook.com/sharer/sharer.php?u=<?= urlencode(BASE_URL . 'home/berita/' . $news['slug']) ?>" 
                   target="_blank"
                   class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition">
                    <i class="fab fa-facebook-f mr-2"></i>Facebook
                </a>
                <a href="https://twitter.com/intent/tweet?url=<?= urlencode(BASE_URL . 'home/berita/' . $news['slug']) ?>&text=<?= urlencode($news['title']) ?>" 
                   target="_blank"
                   class="bg-blue-400 hover:bg-blue-500 text-white px-4 py-2 rounded-lg transition">
                    <i class="fab fa-twitter mr-2"></i>Twitter
                </a>
                <a href="https://wa.me/?text=<?= urlencode($news['title'] . ' - ' . BASE_URL . 'home/berita/' . $news['slug']) ?>" 
                   target="_blank"
                   class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg transition">
                    <i class="fab fa-whatsapp mr-2"></i>WhatsApp
                </a>
            </div>
        </div>

        <!-- Related News -->
        <?php if (!empty($latestNews)): ?>
            <div class="border-t border-gray-200 pt-8">
                <h3 class="text-2xl font-bold mb-6">Berita Terbaru Lainnya</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <?php foreach ($latestNews as $relatedNews): ?>
                        <?php if ($relatedNews['id'] != $news['id']): ?>
                            <a href="<?= BASE_URL ?>home/berita/<?= $relatedNews['slug'] ?>" 
                               class="group">
                                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition">
                                    <?php if ($relatedNews['image']): ?>
                                        <img src="<?= BASE_URL . $relatedNews['image'] ?>" 
                                             alt="<?= htmlspecialchars($relatedNews['title']) ?>" 
                                             class="w-full h-32 object-cover">
                                    <?php endif; ?>
                                    <div class="p-4">
                                        <h4 class="font-bold line-clamp-2 group-hover:text-blue-600 transition">
                                            <?= htmlspecialchars($relatedNews['title']) ?>
                                        </h4>
                                        <p class="text-sm text-gray-500 mt-2">
                                            <?= date('d M Y', strtotime($relatedNews['publish_date'])) ?>
                                        </p>
                                    </div>
                                </div>
                            </a>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endif; ?>
    </article>
</div>

<?php require_once '../app/views/layouts/footer.php'; ?>
