<?php require_once '../app/views/layouts/header.php'; ?>

<!-- Hero Slider Section -->
<section class="relative h-[500px] overflow-hidden">
    <?php if (!empty($sliders)): ?>
        <div class="slider-container relative w-full h-full">
            <?php foreach ($sliders as $index => $slider): ?>
                <div class="slider-item <?= $index === 0 ? 'active' : '' ?> absolute inset-0 transition-opacity duration-1000 <?= $index === 0 ? 'opacity-100' : 'opacity-0' ?>">
                    <img src="<?= BASE_URL . $slider['image'] ?>" alt="<?= htmlspecialchars($slider['title']) ?>" 
                         class="w-full h-full object-cover">
                    <div class="absolute inset-0 bg-black bg-opacity-40 flex items-center justify-center">
                        <div class="text-center text-white px-4">
                            <h2 class="text-4xl md:text-5xl font-bold mb-4 animate-fade-in"><?= htmlspecialchars($slider['title']) ?></h2>
                            <?php if ($slider['description']): ?>
                                <p class="text-xl md:text-2xl animate-fade-in"><?= htmlspecialchars($slider['description']) ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- Slider Controls -->
        <button onclick="prevSlide()" class="absolute left-4 top-1/2 transform -translate-y-1/2 bg-white bg-opacity-50 hover:bg-opacity-75 text-gray-800 rounded-full p-3 transition">
            <i class="fas fa-chevron-left"></i>
        </button>
        <button onclick="nextSlide()" class="absolute right-4 top-1/2 transform -translate-y-1/2 bg-white bg-opacity-50 hover:bg-opacity-75 text-gray-800 rounded-full p-3 transition">
            <i class="fas fa-chevron-right"></i>
        </button>

        <!-- Slider Indicators -->
        <div class="absolute bottom-4 left-1/2 transform -translate-x-1/2 flex space-x-2">
            <?php foreach ($sliders as $index => $slider): ?>
                <button onclick="goToSlide(<?= $index ?>)" class="slider-indicator w-3 h-3 rounded-full <?= $index === 0 ? 'bg-white' : 'bg-white bg-opacity-50' ?> transition"></button>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <div class="w-full h-full bg-gradient-to-r from-blue-500 to-purple-600 flex items-center justify-center">
            <div class="text-center text-white">
                <h2 class="text-5xl font-bold mb-4"><?= $settings['school_name'] ?? 'Selamat Datang' ?></h2>
                <p class="text-2xl">Website Resmi Sekolah</p>
            </div>
        </div>
    <?php endif; ?>
</section>

<!-- Statistics Section -->
<section class="container mx-auto px-4 py-12">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-gradient-to-br from-blue-500 to-blue-600 text-white rounded-lg shadow-lg p-8 text-center transform hover:scale-105 transition">
            <i class="fas fa-user-graduate text-5xl mb-4"></i>
            <h3 class="text-4xl font-bold counter" data-target="<?= $studentStats['total_students'] ?? 0 ?>">0</h3>
            <p class="text-xl mt-2">Total Siswa</p>
        </div>
        <div class="bg-gradient-to-br from-green-500 to-green-600 text-white rounded-lg shadow-lg p-8 text-center transform hover:scale-105 transition">
            <i class="fas fa-chalkboard-teacher text-5xl mb-4"></i>
            <h3 class="text-4xl font-bold counter" data-target="<?= count($teachers) ?>">0</h3>
            <p class="text-xl mt-2">Guru Berpengalaman</p>
        </div>
        <div class="bg-gradient-to-br from-purple-500 to-purple-600 text-white rounded-lg shadow-lg p-8 text-center transform hover:scale-105 transition">
            <i class="fas fa-trophy text-5xl mb-4"></i>
            <h3 class="text-4xl font-bold counter" data-target="100">0</h3>
            <p class="text-xl mt-2">Prestasi</p>
        </div>
    </div>
</section>

<!-- Latest News Section -->
<section class="bg-white py-12">
    <div class="container mx-auto px-4">
        <h2 class="text-3xl font-bold text-center mb-8">Berita Terbaru</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <?php if (!empty($latestNews)): ?>
                <?php foreach ($latestNews as $news): ?>
                    <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition transform hover:-translate-y-2">
                        <?php if ($news['image']): ?>
                            <img src="<?= BASE_URL . $news['image'] ?>" alt="<?= htmlspecialchars($news['title']) ?>" 
                                 class="w-full h-48 object-cover">
                        <?php else: ?>
                            <div class="w-full h-48 bg-gradient-to-br from-blue-400 to-purple-500 flex items-center justify-center">
                                <i class="fas fa-newspaper text-white text-5xl"></i>
                            </div>
                        <?php endif; ?>
                        <div class="p-6">
                            <p class="text-sm text-gray-500 mb-2">
                                <i class="far fa-calendar mr-2"></i><?= date('d M Y', strtotime($news['publish_date'])) ?>
                            </p>
                            <h3 class="text-xl font-bold mb-2 line-clamp-2"><?= htmlspecialchars($news['title']) ?></h3>
                            <p class="text-gray-600 mb-4 line-clamp-3"><?= strip_tags(substr($news['content'], 0, 150)) ?>...</p>
                            <a href="<?= BASE_URL ?>home/berita/<?= $news['slug'] ?>" 
                               class="text-blue-600 hover:text-blue-800 font-semibold">
                                Baca Selengkapnya <i class="fas fa-arrow-right ml-1"></i>
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-span-3 text-center text-gray-500 py-8">
                    <i class="fas fa-newspaper text-5xl mb-4"></i>
                    <p>Belum ada berita</p>
                </div>
            <?php endif; ?>
        </div>
        <div class="text-center mt-8">
            <a href="<?= BASE_URL ?>home/berita" 
               class="inline-block bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-lg transition transform hover:scale-105">
                Lihat Semua Berita
            </a>
        </div>
    </div>
</section>

<!-- Teachers Section -->
<section class="bg-gray-100 py-12">
    <div class="container mx-auto px-4">
        <h2 class="text-3xl font-bold text-center mb-8">Guru & Tenaga Pendidik</h2>
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
            <?php if (!empty($teachers)): ?>
                <?php foreach (array_slice($teachers, 0, 8) as $teacher): ?>
                    <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition transform hover:-translate-y-2">
                        <?php if ($teacher['photo']): ?>
                            <img src="<?= BASE_URL . $teacher['photo'] ?>" alt="<?= htmlspecialchars($teacher['name']) ?>" 
                                 class="w-full h-48 object-cover">
                        <?php else: ?>
                            <div class="w-full h-48 bg-gradient-to-br from-gray-300 to-gray-400 flex items-center justify-center">
                                <i class="fas fa-user text-white text-5xl"></i>
                            </div>
                        <?php endif; ?>
                        <div class="p-4 text-center">
                            <h3 class="text-lg font-bold mb-1"><?= htmlspecialchars($teacher['name']) ?></h3>
                            <p class="text-blue-600 text-sm"><?= htmlspecialchars($teacher['subject']) ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- Contact Section -->
<section class="bg-blue-600 text-white py-12">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div>
                <h2 class="text-3xl font-bold mb-6">Hubungi Kami</h2>
                <div class="space-y-4">
                    <div class="flex items-start">
                        <i class="fas fa-map-marker-alt text-2xl mr-4 mt-1"></i>
                        <div>
                            <h3 class="font-bold mb-1">Alamat</h3>
                            <p><?= $contact['address'] ?? $settings['address'] ?? '' ?></p>
                        </div>
                    </div>
                    <div class="flex items-start">
                        <i class="fas fa-phone text-2xl mr-4 mt-1"></i>
                        <div>
                            <h3 class="font-bold mb-1">Telepon</h3>
                            <p><?= $contact['phone'] ?? $settings['phone'] ?? '' ?></p>
                        </div>
                    </div>
                    <div class="flex items-start">
                        <i class="fas fa-envelope text-2xl mr-4 mt-1"></i>
                        <div>
                            <h3 class="font-bold mb-1">Email</h3>
                            <p><?= $contact['email'] ?? $settings['email'] ?? '' ?></p>
                        </div>
                    </div>
                </div>
            </div>
            <div>
                <?php if ($contact['maps_embed'] ?? ''): ?>
                    <div class="aspect-video rounded-lg overflow-hidden shadow-lg">
                        <iframe src="<?= $contact['maps_embed'] ?>" 
                                class="w-full h-full" 
                                style="border:0;" 
                                allowfullscreen="" 
                                loading="lazy"></iframe>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<script>
let currentSlide = 0;
const slides = document.querySelectorAll('.slider-item');
const indicators = document.querySelectorAll('.slider-indicator');

function showSlide(index) {
    slides.forEach((slide, i) => {
        slide.classList.toggle('opacity-100', i === index);
        slide.classList.toggle('opacity-0', i !== index);
    });
    indicators.forEach((indicator, i) => {
        indicator.classList.toggle('bg-white', i === index);
        indicator.classList.toggle('bg-opacity-50', i !== index);
        indicator.classList.toggle('bg-opacity-100', i === index);
    });
}

function nextSlide() {
    currentSlide = (currentSlide + 1) % slides.length;
    showSlide(currentSlide);
}

function prevSlide() {
    currentSlide = (currentSlide - 1 + slides.length) % slides.length;
    showSlide(currentSlide);
}

function goToSlide(index) {
    currentSlide = index;
    showSlide(currentSlide);
}

// Auto-advance slides
if (slides.length > 1) {
    setInterval(nextSlide, 5000);
}
</script>

<?php require_once '../app/views/layouts/footer.php'; ?>
