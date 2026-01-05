<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Dashboard' ?> - Admin Panel</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>
<body class="bg-gray-100">
    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        <aside id="sidebar" class="bg-gray-800 text-white w-64 flex-shrink-0 hidden md:flex flex-col transition-all duration-300">
            <div class="p-4 border-b border-gray-700">
                <h2 class="text-xl font-bold">Admin Panel</h2>
                <p class="text-sm text-gray-400"><?= $_SESSION['admin_name'] ?? 'Administrator' ?></p>
            </div>
            
            <nav class="flex-1 overflow-y-auto p-4">
                <ul class="space-y-2">
                    <li>
                        <a href="<?= BASE_URL ?>admin" class="flex items-center p-3 rounded hover:bg-gray-700 transition">
                            <i class="fas fa-home mr-3"></i> Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="<?= BASE_URL ?>admin/settings" class="flex items-center p-3 rounded hover:bg-gray-700 transition">
                            <i class="fas fa-cog mr-3"></i> Pengaturan Sekolah
                        </a>
                    </li>
                    <li>
                        <a href="<?= BASE_URL ?>admin/slider" class="flex items-center p-3 rounded hover:bg-gray-700 transition">
                            <i class="fas fa-images mr-3"></i> Slider
                        </a>
                    </li>
                    <li>
                        <a href="<?= BASE_URL ?>admin/news" class="flex items-center p-3 rounded hover:bg-gray-700 transition">
                            <i class="fas fa-newspaper mr-3"></i> Berita
                        </a>
                    </li>
                    <li>
                        <a href="<?= BASE_URL ?>admin/teachers" class="flex items-center p-3 rounded hover:bg-gray-700 transition">
                            <i class="fas fa-chalkboard-teacher mr-3"></i> Data Guru
                        </a>
                    </li>
                    <li>
                        <a href="<?= BASE_URL ?>admin/students" class="flex items-center p-3 rounded hover:bg-gray-700 transition">
                            <i class="fas fa-user-graduate mr-3"></i> Data Siswa
                        </a>
                    </li>
                    <li>
                        <a href="<?= BASE_URL ?>admin/profile" class="flex items-center p-3 rounded hover:bg-gray-700 transition">
                            <i class="fas fa-school mr-3"></i> Profil Sekolah
                        </a>
                    </li>
                    <li>
                        <a href="<?= BASE_URL ?>admin/galleryPhotos" class="flex items-center p-3 rounded hover:bg-gray-700 transition">
                            <i class="fas fa-camera mr-3"></i> Galeri Foto
                        </a>
                    </li>
                    <li>
                        <a href="<?= BASE_URL ?>admin/galleryVideos" class="flex items-center p-3 rounded hover:bg-gray-700 transition">
                            <i class="fas fa-video mr-3"></i> Galeri Video
                        </a>
                    </li>
                    <li>
                        <a href="<?= BASE_URL ?>admin/achievements" class="flex items-center p-3 rounded hover:bg-gray-700 transition">
                            <i class="fas fa-trophy mr-3"></i> Prestasi
                        </a>
                    </li>
                    <li>
                        <a href="<?= BASE_URL ?>admin/downloads" class="flex items-center p-3 rounded hover:bg-gray-700 transition">
                            <i class="fas fa-download mr-3"></i> Download
                        </a>
                    </li>
                    <li>
                        <a href="<?= BASE_URL ?>admin/appLinks" class="flex items-center p-3 rounded hover:bg-gray-700 transition">
                            <i class="fas fa-link mr-3"></i> Link Aplikasi
                        </a>
                    </li>
                    <li>
                        <a href="<?= BASE_URL ?>admin/contact" class="flex items-center p-3 rounded hover:bg-gray-700 transition">
                            <i class="fas fa-envelope mr-3"></i> Kontak
                        </a>
                    </li>
                </ul>
            </nav>
            
            <div class="p-4 border-t border-gray-700">
                <a href="<?= BASE_URL ?>admin/logout" class="flex items-center p-3 rounded hover:bg-red-600 transition">
                    <i class="fas fa-sign-out-alt mr-3"></i> Logout
                </a>
            </div>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Top Bar -->
            <header class="bg-white shadow-md p-4 flex items-center justify-between">
                <button id="sidebarToggle" class="md:hidden text-gray-600 hover:text-gray-800">
                    <i class="fas fa-bars text-2xl"></i>
                </button>
                <h1 class="text-2xl font-bold text-gray-800"><?= $title ?? 'Dashboard' ?></h1>
                <div class="flex items-center space-x-4">
                    <a href="<?= BASE_URL ?>" target="_blank" class="text-blue-600 hover:text-blue-800">
                        <i class="fas fa-external-link-alt mr-2"></i>Lihat Website
                    </a>
                </div>
            </header>

            <!-- Content Area -->
            <main class="flex-1 overflow-y-auto p-6">
