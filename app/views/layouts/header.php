<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Home' ?> - <?= $settings['school_name'] ?? 'Website Sekolah' ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in {
            animation: fadeIn 0.6s ease-out;
        }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Header/Navbar -->
    <nav class="bg-white shadow-lg sticky top-0 z-50">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center py-4">
                <div class="flex items-center space-x-4">
                    <?php if ($settings['logo']): ?>
                        <img src="<?= BASE_URL . $settings['logo'] ?>" alt="Logo" class="h-12">
                    <?php endif; ?>
                    <div>
                        <h1 class="text-xl font-bold text-gray-800"><?= $settings['school_name'] ?? 'SMA Negeri' ?></h1>
                        <p class="text-sm text-gray-600"><?= $settings['website'] ?? '' ?></p>
                    </div>
                </div>
                
                <button id="mobileMenuBtn" class="md:hidden text-gray-700">
                    <i class="fas fa-bars text-2xl"></i>
                </button>

                <ul id="navMenu" class="hidden md:flex space-x-6">
                    <li><a href="<?= BASE_URL ?>" class="text-gray-700 hover:text-blue-600 transition">Dashboard</a></li>
                    <li class="relative group">
                        <a href="#" class="text-gray-700 hover:text-blue-600 transition">Profil <i class="fas fa-chevron-down text-xs"></i></a>
                        <ul class="absolute hidden group-hover:block bg-white shadow-lg rounded-lg py-2 w-48">
                            <li><a href="<?= BASE_URL ?>home/profil/visi-misi" class="block px-4 py-2 hover:bg-gray-100">Visi Misi</a></li>
                            <li><a href="<?= BASE_URL ?>home/profil/sejarah" class="block px-4 py-2 hover:bg-gray-100">Sejarah</a></li>
                            <li><a href="<?= BASE_URL ?>home/profil/struktur" class="block px-4 py-2 hover:bg-gray-100">Struktur Organisasi</a></li>
                            <li><a href="<?= BASE_URL ?>home/profil/keunggulan" class="block px-4 py-2 hover:bg-gray-100">Keunggulan</a></li>
                        </ul>
                    </li>
                    <li><a href="<?= BASE_URL ?>home/berita" class="text-gray-700 hover:text-blue-600 transition">Berita</a></li>
                    <li class="relative group">
                        <a href="#" class="text-gray-700 hover:text-blue-600 transition">Galeri <i class="fas fa-chevron-down text-xs"></i></a>
                        <ul class="absolute hidden group-hover:block bg-white shadow-lg rounded-lg py-2 w-40">
                            <li><a href="<?= BASE_URL ?>home/galeri/foto" class="block px-4 py-2 hover:bg-gray-100">Foto</a></li>
                            <li><a href="<?= BASE_URL ?>home/galeri/video" class="block px-4 py-2 hover:bg-gray-100">Video</a></li>
                        </ul>
                    </li>
                    <li><a href="<?= BASE_URL ?>home/prestasi" class="text-gray-700 hover:text-blue-600 transition">Prestasi</a></li>
                    <li><a href="<?= BASE_URL ?>home/download" class="text-gray-700 hover:text-blue-600 transition">Download</a></li>
                    <li><a href="<?= BASE_URL ?>home/aplikasi" class="text-gray-700 hover:text-blue-600 transition">Link Aplikasi</a></li>
                    <li><a href="<?= BASE_URL ?>home/kontak" class="text-gray-700 hover:text-blue-600 transition">Kontak</a></li>
                </ul>
            </div>
        </div>
    </nav>
