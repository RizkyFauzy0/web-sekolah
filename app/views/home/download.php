<?php require_once '../app/views/layouts/header.php'; ?>

<div class="container mx-auto px-4 py-12">
    <!-- Page Header -->
    <div class="bg-gradient-to-r from-green-600 to-teal-600 rounded-lg shadow-lg p-8 mb-8 text-white">
        <h1 class="text-4xl font-bold mb-2">Download</h1>
        <p class="text-lg">Unduh dokumen dan file penting</p>
    </div>

    <!-- Downloads List -->
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Nama File</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Kategori</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Tipe</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Download</th>
                        <th class="px-6 py-4 text-center text-sm font-semibold text-gray-700">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    <?php if (!empty($downloads)): ?>
                        <?php foreach ($downloads as $download): ?>
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4">
                                    <div class="flex items-center">
                                        <i class="fas fa-file-<?= strtolower($download['file_type']) ?> text-2xl mr-3 text-blue-600"></i>
                                        <div>
                                            <p class="font-semibold text-gray-800"><?= htmlspecialchars($download['title']) ?></p>
                                            <?php if ($download['description']): ?>
                                                <p class="text-sm text-gray-500"><?= htmlspecialchars($download['description']) ?></p>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="px-3 py-1 rounded-full text-sm bg-blue-100 text-blue-800">
                                        <?= htmlspecialchars($download['category']) ?: 'Umum' ?>
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="text-sm text-gray-600 uppercase"><?= htmlspecialchars($download['file_type']) ?></span>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="text-sm text-gray-500">
                                        <i class="fas fa-download mr-1"></i><?= $download['download_count'] ?> kali
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <a href="<?= BASE_URL ?>home/downloadFile/<?= $download['id'] ?>" 
                                       class="inline-flex items-center bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg transition">
                                        <i class="fas fa-download mr-2"></i>Download
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center">
                                <i class="fas fa-folder-open text-gray-300 text-6xl mb-4"></i>
                                <p class="text-gray-500 text-lg">Belum ada file tersedia</p>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php require_once '../app/views/layouts/footer.php'; ?>
