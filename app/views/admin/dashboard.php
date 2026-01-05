<?php require_once '../app/views/layouts/admin_header.php'; ?>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
    <!-- Total News Card -->
    <div class="bg-white rounded-lg shadow-md p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm">Total Berita</p>
                <p class="text-3xl font-bold text-blue-600"><?= $totalNews ?? 0 ?></p>
            </div>
            <div class="bg-blue-100 p-3 rounded-full">
                <i class="fas fa-newspaper text-blue-600 text-2xl"></i>
            </div>
        </div>
    </div>

    <!-- Total Teachers Card -->
    <div class="bg-white rounded-lg shadow-md p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm">Total Guru</p>
                <p class="text-3xl font-bold text-green-600"><?= $totalTeachers ?? 0 ?></p>
            </div>
            <div class="bg-green-100 p-3 rounded-full">
                <i class="fas fa-chalkboard-teacher text-green-600 text-2xl"></i>
            </div>
        </div>
    </div>

    <!-- Total Students Card -->
    <div class="bg-white rounded-lg shadow-md p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm">Total Siswa</p>
                <p class="text-3xl font-bold text-purple-600"><?= $studentStats['total_students'] ?? 0 ?></p>
            </div>
            <div class="bg-purple-100 p-3 rounded-full">
                <i class="fas fa-user-graduate text-purple-600 text-2xl"></i>
            </div>
        </div>
    </div>

    <!-- Male Students Card -->
    <div class="bg-white rounded-lg shadow-md p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm">Siswa Laki-laki</p>
                <p class="text-3xl font-bold text-indigo-600"><?= $studentStats['male_students'] ?? 0 ?></p>
            </div>
            <div class="bg-indigo-100 p-3 rounded-full">
                <i class="fas fa-male text-indigo-600 text-2xl"></i>
            </div>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    <!-- Quick Actions -->
    <div class="bg-white rounded-lg shadow-md p-6">
        <h3 class="text-xl font-bold mb-4">Aksi Cepat</h3>
        <div class="grid grid-cols-2 gap-4">
            <a href="<?= BASE_URL ?>admin/news" class="bg-blue-500 hover:bg-blue-600 text-white p-4 rounded-lg text-center transition">
                <i class="fas fa-plus mb-2 text-2xl"></i>
                <p>Tambah Berita</p>
            </a>
            <a href="<?= BASE_URL ?>admin/slider" class="bg-green-500 hover:bg-green-600 text-white p-4 rounded-lg text-center transition">
                <i class="fas fa-image mb-2 text-2xl"></i>
                <p>Kelola Slider</p>
            </a>
            <a href="<?= BASE_URL ?>admin/galleryPhotos" class="bg-purple-500 hover:bg-purple-600 text-white p-4 rounded-lg text-center transition">
                <i class="fas fa-camera mb-2 text-2xl"></i>
                <p>Upload Foto</p>
            </a>
            <a href="<?= BASE_URL ?>admin/settings" class="bg-orange-500 hover:bg-orange-600 text-white p-4 rounded-lg text-center transition">
                <i class="fas fa-cog mb-2 text-2xl"></i>
                <p>Pengaturan</p>
            </a>
        </div>
    </div>

    <!-- Welcome Message -->
    <div class="bg-gradient-to-br from-blue-500 to-purple-600 rounded-lg shadow-md p-6 text-white">
        <h3 class="text-2xl font-bold mb-2">Selamat Datang, <?= $_SESSION['admin_name'] ?? 'Administrator' ?>!</h3>
        <p class="mb-4">Kelola konten website sekolah dengan mudah melalui panel admin ini.</p>
        <a href="<?= BASE_URL ?>" target="_blank" class="inline-block bg-white text-blue-600 px-6 py-2 rounded-lg hover:bg-gray-100 transition">
            Lihat Website
        </a>
    </div>
</div>

<?php require_once '../app/views/layouts/admin_footer.php'; ?>
