        // Sidebar Toggle
        document.addEventListener('DOMContentLoaded', function() {
            const hamburger = document.getElementById('hamburger');
            const sidebar = document.getElementById('sidebar');
            const closeSidebar = document.getElementById('closeSidebar');
            const overlay = document.getElementById('overlay');
            const navLinks = document.querySelectorAll('.nav-link');

            function toggleSidebar() {
                hamburger.classList.toggle('active');
                sidebar.classList.toggle('open');
                overlay.classList.toggle('active');
                document.body.style.overflow = sidebar.classList.contains('open') ? 'hidden' : '';
            }

            function closeSidebarFunc() {
                hamburger.classList.remove('active');
                sidebar.classList.remove('open');
                overlay.classList.remove('active');
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

            // News card hover effects
            const newsCards = document.querySelectorAll('.news-card');
            newsCards.forEach(card => {
                card.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-10px)';
                });
                
                card.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0)';
                });
            });

            // Pagination styling
            const paginationLinks = document.querySelectorAll('.pagination a');
            paginationLinks.forEach(link => {
                // Add page numbers
                if (link.textContent.trim() === '&laquo; Previous') {
                    link.textContent = 'السابق';
                    link.innerHTML = '<i class="fas fa-arrow-right" style="margin-right: 5px;"></i>' + link.textContent;
                } else if (link.textContent.trim() === 'Next &raquo;') {
                    link.textContent = 'التالي';
                    link.innerHTML = link.textContent + '<i class="fas fa-arrow-left" style="margin-left: 5px;"></i>';
                }
            });
        });
