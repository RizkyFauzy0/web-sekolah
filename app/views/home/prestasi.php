<?php require_once '../app/views/layouts/header.php'; ?>

<div class="container mx-auto px-4 py-12">
    <!-- Page Header -->
    <div class="bg-gradient-to-r from-yellow-500 to-orange-500 rounded-lg shadow-lg p-8 mb-8 text-white">
        <h1 class="text-4xl font-bold mb-2">Prestasi</h1>
        <p class="text-lg">Pencapaian membanggakan siswa, guru, dan sekolah</p>
    </div>

    <!-- Filter Tabs -->
    <div class="flex justify-center mb-8">
        <div class="bg-white rounded-lg shadow-md inline-flex flex-wrap">
            <a href="<?= BASE_URL ?>home/prestasi/all" 
               class="px-6 py-3 transition <?= $type === 'all' ? 'bg-yellow-500 text-white' : 'text-gray-600 hover:bg-gray-100' ?>">
                Semua
            </a>
            <a href="<?= BASE_URL ?>home/prestasi/siswa" 
               class="px-6 py-3 transition <?= $type === 'siswa' ? 'bg-yellow-500 text-white' : 'text-gray-600 hover:bg-gray-100' ?>">
                Siswa
            </a>
            <a href="<?= BASE_URL ?>home/prestasi/guru" 
               class="px-6 py-3 transition <?= $type === 'guru' ? 'bg-yellow-500 text-white' : 'text-gray-600 hover:bg-gray-100' ?>">
                Guru
            </a>
            <a href="<?= BASE_URL ?>home/prestasi/sekolah" 
               class="px-6 py-3 transition <?= $type === 'sekolah' ? 'bg-yellow-500 text-white' : 'text-gray-600 hover:bg-gray-100' ?>">
                Sekolah
            </a>
        </div>
    </div>

    <!-- Achievements Grid -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <?php if (!empty($achievements)): ?>
            <?php foreach ($achievements as $achievement): ?>
                <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition transform hover:-translate-y-2">
                    <?php if ($achievement['image']): ?>
                        <img src="<?= BASE_URL . $achievement['image'] ?>" 
                             alt="<?= htmlspecialchars($achievement['title']) ?>" 
                             class="w-full h-48 object-cover">
                    <?php else: ?>
                        <div class="w-full h-48 bg-gradient-to-br from-yellow-400 to-orange-500 flex items-center justify-center">
                            <i class="fas fa-trophy text-white text-5xl"></i>
                        </div>
                    <?php endif; ?>
                    
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-3">
                            <span class="px-3 py-1 rounded-full text-sm font-semibold
                                <?php 
                                    if ($achievement['type'] === 'siswa') echo 'bg-blue-100 text-blue-800';
                                    elseif ($achievement['type'] === 'guru') echo 'bg-green-100 text-green-800';
                                    else echo 'bg-purple-100 text-purple-800';
                                ?>">
                                <?= ucfirst($achievement['type']) ?>
                            </span>
                            <span class="text-gray-500 text-sm">
                                <i class="far fa-calendar mr-1"></i><?= $achievement['year'] ?>
                            </span>
                        </div>
                        
                        <h3 class="text-xl font-bold mb-3"><?= htmlspecialchars($achievement['title']) ?></h3>
                        
                        <?php if ($achievement['description']): ?>
                            <p class="text-gray-600"><?= htmlspecialchars($achievement['description']) ?></p>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="col-span-3 text-center py-12">
                <i class="fas fa-trophy text-gray-300 text-6xl mb-4"></i>
                <p class="text-gray-500 text-lg">Belum ada prestasi tersedia</p>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php require_once '../app/views/layouts/footer.php'; ?>
