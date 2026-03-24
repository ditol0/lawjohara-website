
        // DOM Elements
        const hamburger = document.getElementById('hamburger');
        const sidebar = document.getElementById('sidebar');
        const closeSidebar = document.getElementById('closeSidebar');
        const overlay = document.getElementById('overlay');
        const navLinks = document.querySelectorAll('.main-nav a, .nav-link');
        const faqQuestions = document.querySelectorAll('.faq-question');
        const header = document.getElementById('header');
        const currentYearSpan = document.getElementById('currentYear');

        // ================ تهيئة الصفحة ================
        document.addEventListener('DOMContentLoaded', function() {
            // تعيين السنة الحالية في الفوتر
            if (currentYearSpan) {
                currentYearSpan.textContent = new Date().getFullYear();
            }
            
            // إخفاء العناصر التي تحتوي على class reveal
            document.querySelectorAll('.reveal').forEach(el => {
                el.style.opacity = '0';
                el.style.transform = 'translateY(30px)';
            });
            
            // تهيئة الـ Scroll Reveal
            initScrollReveal();
            
            // تحديث حالة الهيدر
            updateHeader();
            
            // التحقق من العناصر المرئية عند التحميل
            checkInitialReveal();
            
            // إضافة تأثير تأخير للعناصر حسب موقعها
            addStaggeredDelay();
        });

        // ================ Scroll Reveal مع IntersectionObserver ================
        function initScrollReveal() {
            const revealElements = document.querySelectorAll('.reveal');
            
            if (revealElements.length === 0) return;
            
            // التحقق من دعم IntersectionObserver
            if (!('IntersectionObserver' in window)) {
                // إذا لم يكن مدعوماً، نظهر كل العناصر مباشرة
                revealElements.forEach(el => {
                    el.classList.add('show');
                    el.style.opacity = '1';
                    el.style.transform = 'translateY(0)';
                });
                return;
            }

            // إعداد خيارات الـ Observer
            const observerOptions = {
                root: null,
                rootMargin: '50px', // بدء الأنيميشن قبل دخول العنصر بـ 50px
                threshold: 0.1 // بدء الأنيميشن عندما يكون 10% من العنصر مرئياً
            };

            // إنشاء الـ Observer
            const revealObserver = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        // إضافة class "show" للعنصر عند الظهور
                        entry.target.classList.add('show');
                        entry.target.style.opacity = '1';
                        entry.target.style.transform = 'translateY(0)';
                        
                        // إضافة تأخير للعناصر الفرعية
                        const childReveals = entry.target.querySelectorAll('.reveal:not(.show)');
                        childReveals.forEach((child, index) => {
                            setTimeout(() => {
                                child.classList.add('show');
                                child.style.opacity = '1';
                                child.style.transform = 'translateY(0)';
                            }, index * 150);
                        });
                        
                        // نوقف مراقبة العنصر بعد ظهوره لتقليل الحمل
                        revealObserver.unobserve(entry.target);
                    }
                });
            }, observerOptions);

            // مراقبة جميع العناصر التي تحتوي class "reveal"
            revealElements.forEach(el => {
                revealObserver.observe(el);
            });
        }

        // ================ Sidebar Toggle ================
        hamburger.addEventListener('click', () => {
            sidebar.classList.toggle('open');
            overlay.classList.toggle('active');
            hamburger.classList.toggle('active');
            hamburger.setAttribute('aria-expanded', 
                hamburger.getAttribute('aria-expanded') === 'true' ? 'false' : 'true'
            );
            document.body.style.overflow = sidebar.classList.contains('open') ? 'hidden' : 'auto';
        });

        closeSidebar.addEventListener('click', () => {
            sidebar.classList.remove('open');
            overlay.classList.remove('active');
            hamburger.classList.remove('active');
            hamburger.setAttribute('aria-expanded', 'false');
            document.body.style.overflow = 'auto';
        });

        overlay.addEventListener('click', () => {
            sidebar.classList.remove('open');
            overlay.classList.remove('active');
            hamburger.classList.remove('active');
            hamburger.setAttribute('aria-expanded', 'false');
            document.body.style.overflow = 'auto';
        });

        // ================ Smooth Scrolling ================
        navLinks.forEach(link => {
            link.addEventListener('click', function(e) {
                const targetId = this.getAttribute('href');
                
                if (targetId.startsWith('#')) {
                    e.preventDefault();
                    
                    // إغلاق السايدبار إذا كان مفتوحاً
                    if (sidebar.classList.contains('open')) {
                        sidebar.classList.remove('open');
                        overlay.classList.remove('active');
                        hamburger.classList.remove('active');
                        hamburger.setAttribute('aria-expanded', 'false');
                        document.body.style.overflow = 'auto';
                    }
                    
                    // الانتقال للنقطة المستهدفة
                    const targetSection = document.querySelector(targetId);
                    if (targetSection) {
                        const headerHeight = header.offsetHeight;
                        const targetPosition = targetSection.offsetTop - headerHeight;
                        
                        window.scrollTo({
                            top: targetPosition,
                            behavior: 'smooth'
                        });
                        
                        // تحديث الرابط النشط
                        updateActiveNavLink(targetId);
                    }
                }
            });
        });

        // ================ Update Active Navigation Link ================
        function updateActiveNavLink(targetId) {
            // تحديث القائمة الرئيسية
            document.querySelectorAll('.main-nav a').forEach(link => {
                link.classList.remove('active');
                if (link.getAttribute('href') === targetId) {
                    link.classList.add('active');
                }
            });
            
            // تحديث القائمة الجانبية
            document.querySelectorAll('.nav-link').forEach(link => {
                link.classList.remove('active');
                if (link.getAttribute('href') === targetId) {
                    link.classList.add('active');
                }
            });
        }

        // ================ FAQ Toggle ================
        faqQuestions.forEach(question => {
            question.addEventListener('click', () => {
                const faqItem = question.parentElement;
                const answer = question.nextElementSibling;
                
                // إغلاق الأسئلة الأخرى المفتوحة
                document.querySelectorAll('.faq-item.active').forEach(item => {
                    if (item !== faqItem) {
                        item.classList.remove('active');
                        item.querySelector('.faq-answer').classList.remove('active');
                    }
                });
                
                // تبديل الحالة للعنصر الحالي
                faqItem.classList.toggle('active');
                answer.classList.toggle('active');
            });
        });

        // ================ Header Scroll Effect ================
        function updateHeader() {
            const scrollPosition = window.scrollY;
            
            if (scrollPosition > 100) {
                header.classList.add('scrolled');
            } else {
                header.classList.remove('scrolled');
            }
            
            // تحديث الرابط النشط بناءً على التمرير
            const sections = document.querySelectorAll('section');
            let currentSection = '';
            
            sections.forEach(section => {
                const sectionTop = section.offsetTop;
                const sectionHeight = section.clientHeight;
                const headerHeight = header.offsetHeight;
                
                if (scrollPosition >= (sectionTop - headerHeight - 100)) {
                    currentSection = '#' + section.getAttribute('id');
                }
            });
            
            if (currentSection) {
                updateActiveNavLink(currentSection);
            }
        }

        // ================ check initial reveal ================
        function checkInitialReveal() {
            // التحقق من العناصر المرئية عند التحميل
            const initialRevealElements = document.querySelectorAll('.reveal:not(.show)');
            
            initialRevealElements.forEach(el => {
                const rect = el.getBoundingClientRect();
                const isVisible = rect.top < window.innerHeight && rect.bottom >= 0;
                
                if (isVisible) {
                    setTimeout(() => {
                        el.classList.add('show');
                        el.style.opacity = '1';
                        el.style.transform = 'translateY(0)';
                    }, 300);
                }
            });
        }

        // ================ إضافة تأخير متدرج للعناصر ================
        function addStaggeredDelay() {
            // تحديد العناصر حسب الأقسام
            const sections = document.querySelectorAll('section');
            
            sections.forEach((section, sectionIndex) => {
                const revealsInSection = section.querySelectorAll('.reveal');
                
                revealsInSection.forEach((reveal, index) => {
                    // إضافة تأخير بناءً على ترتيب العنصر في القسم
                    reveal.style.transitionDelay = `${(index * 100) + (sectionIndex * 50)}ms`;
                });
            });
        }

        // ================ تحديث reveal عند التمرير ================
        function updateRevealOnScroll() {
            const revealElements = document.querySelectorAll('.reveal:not(.show)');
            
            revealElements.forEach(el => {
                const elementTop = el.getBoundingClientRect().top;
                const elementVisible = 150; // مسافة ظهور العنصر
                
                if (elementTop < window.innerHeight - elementVisible) {
                    setTimeout(() => {
                        el.classList.add('show');
                        el.style.opacity = '1';
                        el.style.transform = 'translateY(0)';
                    }, 200);
                }
            });
        }

        // ================ معالجة التمرير ================
        let ticking = false;
        window.addEventListener('scroll', () => {
            if (!ticking) {
                window.requestAnimationFrame(() => {
                    updateHeader();
                    updateRevealOnScroll();
                    ticking = false;
                });
                ticking = true;
            }
        });

        // تشغيل مرة واحدة عند التحميل
        setTimeout(updateRevealOnScroll, 500);

        // ================ إضافة تأثير النقر للأزرار ================
        document.querySelectorAll('.btn-primary, .social-link, .nav-link').forEach(button => {
            button.addEventListener('mousedown', function() {
                this.style.transform = 'scale(0.95)';
            });
            
            button.addEventListener('mouseup', function() {
                this.style.transform = '';
            });
            
            button.addEventListener('mouseleave', function() {
                this.style.transform = '';
            });
        });

        // ================ معالجة تحميل الصور للشركاء ================
        const partnerImages = document.querySelectorAll('.partner-image');
        partnerImages.forEach(img => {
            // إضافة مؤشر تحميل للصور
            img.addEventListener('load', function() {
                this.style.opacity = '1';
            });
            
            // معالجة الأخطاء في تحميل الصور
            img.addEventListener('error', function() {
                console.warn('فشل تحميل صورة الشريك:', this.src);
                // يمكنك إضافة صورة بديلة هنا إذا لزم الأمر
            });
        });
