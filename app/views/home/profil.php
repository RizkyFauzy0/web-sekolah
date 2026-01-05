<?php require_once '../app/views/layouts/header.php'; ?>

<div class="container mx-auto px-4 py-12">
    <!-- Page Header -->
    <div class="bg-gradient-to-r from-blue-600 to-purple-600 rounded-lg shadow-lg p-8 mb-8 text-white">
        <h1 class="text-4xl font-bold mb-2">Profil Sekolah</h1>
        <p class="text-lg">Mengenal lebih dekat <?= $settings['school_name'] ?? 'Sekolah' ?></p>
    </div>

    <!-- Tab Navigation -->
    <div class="bg-white rounded-lg shadow-md mb-8">
        <div class="flex flex-wrap border-b">
            <a href="<?= BASE_URL ?>home/profil/visi-misi" 
               class="px-6 py-4 text-center hover:bg-gray-50 transition <?= $page === 'visi-misi' ? 'border-b-2 border-blue-600 text-blue-600 font-bold' : 'text-gray-600' ?>">
                Visi & Misi
            </a>
            <a href="<?= BASE_URL ?>home/profil/sejarah" 
               class="px-6 py-4 text-center hover:bg-gray-50 transition <?= $page === 'sejarah' ? 'border-b-2 border-blue-600 text-blue-600 font-bold' : 'text-gray-600' ?>">
                Sejarah
            </a>
            <a href="<?= BASE_URL ?>home/profil/struktur" 
               class="px-6 py-4 text-center hover:bg-gray-50 transition <?= $page === 'struktur' ? 'border-b-2 border-blue-600 text-blue-600 font-bold' : 'text-gray-600' ?>">
                Struktur Organisasi
            </a>
            <a href="<?= BASE_URL ?>home/profil/keunggulan" 
               class="px-6 py-4 text-center hover:bg-gray-50 transition <?= $page === 'keunggulan' ? 'border-b-2 border-blue-600 text-blue-600 font-bold' : 'text-gray-600' ?>">
                Keunggulan
            </a>
        </div>
    </div>

    <!-- Content -->
    <div class="bg-white rounded-lg shadow-md p-8">
        <?php if ($page === 'visi-misi'): ?>
            <!-- Visi Misi -->
            <div class="space-y-8">
                <div>
                    <h2 class="text-3xl font-bold mb-4 text-blue-600">Visi</h2>
                    <p class="text-lg text-gray-700 leading-relaxed">
                        <?= nl2br(htmlspecialchars($profile['vision'] ?? 'Belum diatur')) ?>
                    </p>
                </div>
                <div>
                    <h2 class="text-3xl font-bold mb-4 text-blue-600">Misi</h2>
                    <div class="text-lg text-gray-700 leading-relaxed">
                        <?= nl2br(htmlspecialchars($profile['mission'] ?? 'Belum diatur')) ?>
                    </div>
                </div>
            </div>

        <?php elseif ($page === 'sejarah'): ?>
            <!-- Sejarah -->
            <div>
                <h2 class="text-3xl font-bold mb-6 text-blue-600">Sejarah Singkat</h2>
                <div class="text-lg text-gray-700 leading-relaxed">
                    <?= nl2br(htmlspecialchars($profile['history'] ?? 'Belum diatur')) ?>
                </div>
            </div>

        <?php elseif ($page === 'struktur'): ?>
            <!-- Struktur Organisasi -->
            <div>
                <h2 class="text-3xl font-bold mb-6 text-blue-600">Struktur Organisasi</h2>
                <?php if ($profile['organizational_structure'] ?? ''): ?>
                    <div class="flex justify-center">
                        <img src="<?= BASE_URL . $profile['organizational_structure'] ?>" 
                             alt="Struktur Organisasi" 
                             class="max-w-full h-auto rounded-lg shadow-lg">
                    </div>
                <?php else: ?>
                    <p class="text-gray-500 text-center py-8">Struktur organisasi belum tersedia</p>
                <?php endif; ?>
            </div>

        <?php elseif ($page === 'keunggulan'): ?>
            <!-- Keunggulan -->
            <div>
                <h2 class="text-3xl font-bold mb-6 text-blue-600">Keunggulan Sekolah</h2>
                <div class="text-lg text-gray-700 leading-relaxed">
                    <?= nl2br(htmlspecialchars($profile['advantages'] ?? 'Belum diatur')) ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php require_once '../app/views/layouts/footer.php'; ?>
