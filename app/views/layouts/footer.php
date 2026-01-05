    <!-- Footer -->
    <footer class="bg-gray-800 text-white mt-12">
        <div class="container mx-auto px-4 py-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div>
                    <h3 class="text-xl font-bold mb-4"><?= $settings['school_name'] ?? 'Sekolah' ?></h3>
                    <p class="text-gray-400"><?= $settings['address'] ?? '' ?></p>
                </div>
                <div>
                    <h3 class="text-xl font-bold mb-4">Kontak</h3>
                    <ul class="space-y-2 text-gray-400">
                        <li><i class="fas fa-phone mr-2"></i><?= $settings['phone'] ?? '' ?></li>
                        <li><i class="fas fa-envelope mr-2"></i><?= $settings['email'] ?? '' ?></li>
                        <li><i class="fas fa-globe mr-2"></i><?= $settings['website'] ?? '' ?></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-xl font-bold mb-4">Media Sosial</h3>
                    <div class="flex space-x-4">
                        <?php if ($contact['facebook'] ?? ''): ?>
                            <a href="<?= $contact['facebook'] ?>" target="_blank" class="text-2xl hover:text-blue-500 transition">
                                <i class="fab fa-facebook"></i>
                            </a>
                        <?php endif; ?>
                        <?php if ($contact['instagram'] ?? ''): ?>
                            <a href="<?= $contact['instagram'] ?>" target="_blank" class="text-2xl hover:text-pink-500 transition">
                                <i class="fab fa-instagram"></i>
                            </a>
                        <?php endif; ?>
                        <?php if ($contact['twitter'] ?? ''): ?>
                            <a href="<?= $contact['twitter'] ?>" target="_blank" class="text-2xl hover:text-blue-400 transition">
                                <i class="fab fa-twitter"></i>
                            </a>
                        <?php endif; ?>
                        <?php if ($contact['youtube'] ?? ''): ?>
                            <a href="<?= $contact['youtube'] ?>" target="_blank" class="text-2xl hover:text-red-500 transition">
                                <i class="fab fa-youtube"></i>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="border-t border-gray-700 mt-8 pt-8 text-center text-gray-400">
                <p>&copy; <?= date('Y') ?> <?= $settings['school_name'] ?? 'Sekolah' ?>. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- WhatsApp Floating Button -->
    <?php if ($contact['whatsapp'] ?? ''): ?>
        <a href="https://wa.me/<?= $contact['whatsapp'] ?>" target="_blank" 
           class="fixed bottom-6 right-6 bg-green-500 hover:bg-green-600 text-white rounded-full p-4 shadow-lg transition transform hover:scale-110 z-50">
            <i class="fab fa-whatsapp text-3xl"></i>
        </a>
    <?php endif; ?>

    <script>
        // Mobile menu toggle
        const mobileMenuBtn = document.getElementById('mobileMenuBtn');
        const navMenu = document.getElementById('navMenu');

        mobileMenuBtn?.addEventListener('click', () => {
            navMenu.classList.toggle('hidden');
            navMenu.classList.toggle('flex');
            navMenu.classList.toggle('flex-col');
            navMenu.classList.toggle('absolute');
            navMenu.classList.toggle('top-full');
            navMenu.classList.toggle('left-0');
            navMenu.classList.toggle('w-full');
            navMenu.classList.toggle('bg-white');
            navMenu.classList.toggle('shadow-lg');
            navMenu.classList.toggle('p-4');
            navMenu.classList.toggle('space-y-4');
        });

        // Counter animation
        function animateCounter(element, target) {
            let current = 0;
            const increment = target / 100;
            const timer = setInterval(() => {
                current += increment;
                if (current >= target) {
                    element.textContent = target;
                    clearInterval(timer);
                } else {
                    element.textContent = Math.floor(current);
                }
            }, 20);
        }

        // Initialize counters on scroll
        const observerOptions = {
            threshold: 0.5,
            rootMargin: '0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const counter = entry.target;
                    const target = parseInt(counter.getAttribute('data-target'));
                    animateCounter(counter, target);
                    observer.unobserve(counter);
                }
            });
        }, observerOptions);

        document.querySelectorAll('.counter').forEach(counter => {
            observer.observe(counter);
        });
    </script>

    <!-- Main JavaScript -->
    <script src="<?= BASE_URL ?>js/main.js"></script>
</body>
</html>
