
        // Sidebar Toggle
        document.addEventListener('DOMContentLoaded', function() {
            const hamburger = document.getElementById('hamburger');
            const sidebar = document.getElementById('sidebar');
            const closeSidebar = document.getElementById('closeSidebar');
            const overlay = document.getElementById('overlay');
            const navLinks = document.querySelectorAll('.nav-link');

            function toggleSidebar() {
                const isOpen = sidebar.classList.contains('open');
                hamburger.classList.toggle('active');
                sidebar.classList.toggle('open');
                overlay.classList.toggle('active');
                hamburger.setAttribute('aria-expanded', !isOpen);
                document.body.style.overflow = !isOpen ? 'hidden' : '';
            }

            function closeSidebarFunc() {
                hamburger.classList.remove('active');
                sidebar.classList.remove('open');
                overlay.classList.remove('active');
                hamburger.setAttribute('aria-expanded', 'false');
                document.body.style.overflow = '';
            }

            hamburger.addEventListener('click', toggleSidebar);
            closeSidebar.addEventListener('click', closeSidebarFunc);
            overlay.addEventListener('click', closeSidebarFunc);

            // Close sidebar when clicking on a link
            navLinks.forEach(link => {
                link.addEventListener('click', closeSidebarFunc);
            });

            // Header scroll effect
            window.addEventListener('scroll', function() {
                const header = document.querySelector('.header');
                if (window.scrollY > 50) {
                    header.classList.add('scrolled');
                } else {
                    header.classList.remove('scrolled');
                }
            });

            // Share buttons
            const shareButtons = document.querySelectorAll('.share-button');
            shareButtons.forEach(button => {
                button.addEventListener('click', function(e) {
                    if (this.classList.contains('whatsapp') || this.classList.contains('twitter') || 
                        this.classList.contains('facebook') || this.classList.contains('linkedin')) {
                        return;
                    }
                });
            });

            // Format dates if needed
            const newsDates = document.querySelectorAll('.news-meta-item span');
            newsDates.forEach(dateSpan => {
                const dateText = dateSpan.textContent;
                if (dateText.match(/\d{4}-\d{2}-\d{2}/)) {
                    const date = new Date(dateText);
                    const options = { year: 'numeric', month: 'long', day: 'numeric' };
                    dateSpan.textContent = date.toLocaleDateString('ar-SA', options);
                }
            });

            // Add smooth scrolling for anchor links
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function (e) {
                    e.preventDefault();
                    const targetId = this.getAttribute('href');
                    if (targetId === '#') return;
                    
                    const targetElement = document.querySelector(targetId);
                    if (targetElement) {
                        window.scrollTo({
                            top: targetElement.offsetTop - 100,
                            behavior: 'smooth'
                        });
                    }
                });
            });

            // Improve content images
            const contentImages = document.querySelectorAll('.news-content img');
            contentImages.forEach(img => {
                img.style.maxWidth = '100%';
                img.style.height = 'auto';
                img.style.display = 'block';
                img.style.margin = '20px auto';
                img.style.borderRadius = 'var(--border-radius)';
            });
        });
 