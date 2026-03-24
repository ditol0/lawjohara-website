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

            // Form validation
            const form = document.querySelector('.contact-form');
            if (form) {
                form.addEventListener('submit', function(e) {
                    const requiredFields = form.querySelectorAll('[required]');
                    let isValid = true;
                    
                    requiredFields.forEach(field => {
                        if (!field.value.trim()) {
                            isValid = false;
                            field.style.borderColor = '#ef4444';
                        } else {
                            field.style.borderColor = '#ddd';
                        }
                    });
                    
                    if (!isValid) {
                        e.preventDefault();
                        alert('يرجى ملء جميع الحقول المطلوبة');
                    }
                });
            }
        });
