<?php require_once '../app/views/layouts/header.php'; ?>

<div class="container mx-auto px-4 py-12">
    <!-- Page Header -->
    <div class="bg-gradient-to-r from-blue-600 to-purple-600 rounded-lg shadow-lg p-8 mb-8 text-white">
        <h1 class="text-4xl font-bold mb-2">Galeri <?= $type === 'video' ? 'Video' : 'Foto' ?></h1>
        <p class="text-lg">Dokumentasi kegiatan sekolah</p>
    </div>

    <!-- Tab Navigation -->
    <div class="flex justify-center mb-8">
        <div class="bg-white rounded-lg shadow-md inline-flex">
            <a href="<?= BASE_URL ?>home/galeri/foto" 
               class="px-8 py-3 rounded-l-lg transition <?= $type === 'foto' ? 'bg-blue-600 text-white' : 'text-gray-600 hover:bg-gray-100' ?>">
                <i class="fas fa-camera mr-2"></i>Foto
            </a>
            <a href="<?= BASE_URL ?>home/galeri/video" 
               class="px-8 py-3 rounded-r-lg transition <?= $type === 'video' ? 'bg-blue-600 text-white' : 'text-gray-600 hover:bg-gray-100' ?>">
                <i class="fas fa-video mr-2"></i>Video
            </a>
        </div>
    </div>

    <?php if ($type === 'foto'): ?>
        <!-- Photo Gallery -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <?php if (!empty($photos)): ?>
                <?php foreach ($photos as $photo): ?>
                    <div class="group relative overflow-hidden rounded-lg shadow-md hover:shadow-xl transition cursor-pointer"
                         onclick="openLightbox('<?= BASE_URL . $photo['image'] ?>', '<?= htmlspecialchars($photo['title']) ?>')">
                        <img src="<?= BASE_URL . $photo['image'] ?>" 
                             alt="<?= htmlspecialchars($photo['title']) ?>" 
                             class="w-full h-64 object-cover transform group-hover:scale-110 transition duration-300">
                        <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-60 transition flex items-center justify-center">
                            <div class="text-white opacity-0 group-hover:opacity-100 transition text-center p-4">
                                <i class="fas fa-search-plus text-3xl mb-2"></i>
                                <p class="font-bold"><?= htmlspecialchars($photo['title']) ?></p>
                                <?php if ($photo['caption']): ?>
                                    <p class="text-sm mt-1"><?= htmlspecialchars($photo['caption']) ?></p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-span-4 text-center py-12">
                    <i class="fas fa-image text-gray-300 text-6xl mb-4"></i>
                    <p class="text-gray-500 text-lg">Belum ada foto tersedia</p>
                </div>
            <?php endif; ?>
        </div>

    <?php else: ?>
        <!-- Video Gallery -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <?php if (!empty($videos)): ?>
                <?php foreach ($videos as $video): ?>
                    <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition">
                        <div class="aspect-video">
                            <?php
                            // Extract YouTube video ID
                            preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/i', $video['video_url'], $matches);
                            $videoId = $matches[1] ?? '';
                            ?>
                            <?php if ($videoId): ?>
                                <iframe class="w-full h-full" 
                                        src="https://www.youtube.com/embed/<?= $videoId ?>" 
                                        frameborder="0" 
                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                                        allowfullscreen></iframe>
                            <?php else: ?>
                                <div class="w-full h-full bg-gray-200 flex items-center justify-center">
                                    <i class="fas fa-video text-gray-400 text-5xl"></i>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="p-4">
                            <h3 class="font-bold text-lg mb-2"><?= htmlspecialchars($video['title']) ?></h3>
                            <?php if ($video['description']): ?>
                                <p class="text-gray-600 text-sm"><?= htmlspecialchars($video['description']) ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-span-3 text-center py-12">
                    <i class="fas fa-video text-gray-300 text-6xl mb-4"></i>
                    <p class="text-gray-500 text-lg">Belum ada video tersedia</p>
                </div>
            <?php endif; ?>
        </div>
    <?php endif; ?>
</div>

<!-- Lightbox Modal for Photos -->
<div id="lightbox" class="fixed inset-0 bg-black bg-opacity-90 z-50 hidden items-center justify-center p-4">
    <button onclick="closeLightbox()" class="absolute top-4 right-4 text-white text-4xl hover:text-gray-300">
        <i class="fas fa-times"></i>
    </button>
    <div class="max-w-5xl w-full">
        <img id="lightboxImage" src="" alt="" class="w-full h-auto rounded-lg">
        <p id="lightboxCaption" class="text-white text-center mt-4 text-xl"></p>
    </div>
</div>

<script>
function openLightbox(imageSrc, caption) {
    document.getElementById('lightboxImage').src = imageSrc;
    document.getElementById('lightboxCaption').textContent = caption;
    document.getElementById('lightbox').classList.remove('hidden');
    document.getElementById('lightbox').classList.add('flex');
}

function closeLightbox() {
    document.getElementById('lightbox').classList.add('hidden');
    document.getElementById('lightbox').classList.remove('flex');
}

// Close lightbox on escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeLightbox();
    }
});
</script>

<?php require_once '../app/views/layouts/footer.php'; ?>
