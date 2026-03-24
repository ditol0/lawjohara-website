const body = document.body;
const header = document.getElementById('header');
const sidebar = document.getElementById('sidebar');
const overlay = document.getElementById('siteOverlay');
const menuToggle = document.getElementById('hamburger');
const closeSidebar = document.getElementById('closeSidebar');
const faqButtons = document.querySelectorAll('.faq-question');
const counterItems = document.querySelectorAll('.counter');
const quickForm = document.getElementById('quickConsultationForm');
const submitButton = document.getElementById('quickSubmitButton');
const navLinks = document.querySelectorAll('.main-nav .nav-link, .sidebar-nav .sidebar-link');

function setSidebarState(open) {
    if (!sidebar || !overlay || !menuToggle) return;
    sidebar.classList.toggle('open', open);
    overlay.classList.toggle('active', open);
    menuToggle.classList.toggle('active', open);
    menuToggle.setAttribute('aria-expanded', open ? 'true' : 'false');
    body.classList.toggle('sidebar-open', open);
}

function initSidebar() {
    if (!sidebar || !overlay || !menuToggle || !closeSidebar) return;
    menuToggle.addEventListener('click', () => setSidebarState(!sidebar.classList.contains('open')));
    closeSidebar.addEventListener('click', () => setSidebarState(false));
    overlay.addEventListener('click', () => setSidebarState(false));
    sidebar.querySelectorAll('a').forEach((link) => link.addEventListener('click', () => setSidebarState(false)));
    document.addEventListener('keydown', (event) => {
        if (event.key === 'Escape') setSidebarState(false);
    });
}

function initHeaderState() {
    if (!header) return;
    const onScroll = () => header.classList.toggle('scrolled', window.scrollY > 50);
    onScroll();
    window.addEventListener('scroll', onScroll, { passive: true });
}

function initFaq() {
    faqButtons.forEach((button) => {
        button.addEventListener('click', () => {
            const item = button.closest('.faq-item');
            const isOpen = item?.classList.contains('is-open');

            document.querySelectorAll('.faq-item.is-open').forEach((openItem) => {
                openItem.classList.remove('is-open');
                openItem.querySelector('.faq-question')?.setAttribute('aria-expanded', 'false');
            });

            if (item && !isOpen) {
                item.classList.add('is-open');
                button.setAttribute('aria-expanded', 'true');
            }
        });
    });
}

function initReveal() {
    const revealItems = document.querySelectorAll('.reveal');
    if (!revealItems.length) return;

    const setVisible = (item) => {
        if (item.classList.contains('is-visible')) return;
        item.classList.add('is-visible');
    };

    const isInViewport = (item) => {
        const rect = item.getBoundingClientRect();
        return rect.top < (window.innerHeight - 40) && rect.bottom > 0;
    };

    revealItems.forEach((item) => {
        if (isInViewport(item)) setVisible(item);
    });

    if (!('IntersectionObserver' in window)) {
        revealItems.forEach((item) => setVisible(item));
        return;
    }

    const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                setVisible(entry.target);
                observer.unobserve(entry.target);
            }
        });
    }, {
        threshold: 0.08,
        rootMargin: '0px 0px -12% 0px'
    });

    revealItems.forEach((item) => observer.observe(item));
}

function animateCounter(counter) {
    const target = Number(counter.dataset.target || 0);
    const duration = 1400;
    const start = performance.now();

    const step = (timestamp) => {
        const progress = Math.min((timestamp - start) / duration, 1);
        counter.textContent = String(Math.floor(progress * target));
        if (progress < 1) requestAnimationFrame(step);
        else counter.textContent = String(target);
    };

    requestAnimationFrame(step);
}

function initCounters() {
    if (!counterItems.length) return;
    if (!('IntersectionObserver' in window)) {
        counterItems.forEach(animateCounter);
        return;
    }

    const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                animateCounter(entry.target);
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.5 });

    counterItems.forEach((counter) => observer.observe(counter));
}

function setCurrentYear() {
    const yearElement = document.getElementById('currentYear');
    if (yearElement) yearElement.textContent = String(new Date().getFullYear());
}

function getLinkHash(link) {
    if (!link) return '';
    if (link.dataset.section) return `#${link.dataset.section}`;

    const href = link.getAttribute('href') || '';
    const hashIndex = href.indexOf('#');
    return hashIndex === -1 ? '' : href.slice(hashIndex);
}

function updateActiveSection() {
    const sections = document.querySelectorAll('main section[id], header[id]');
    if (!sections.length || !navLinks.length) return;

    let currentId = '';
    const hashId = window.location.hash;

    if (hashId && document.querySelector(hashId)) {
        currentId = hashId;
    } else {
        const scrollPosition = window.scrollY + (header?.offsetHeight || 0) + 80;

        sections.forEach((section) => {
            if (scrollPosition >= section.offsetTop) currentId = `#${section.id}`;
        });
    }

    if (!currentId) return;

    navLinks.forEach((link) => {
        link.classList.toggle('active', getLinkHash(link) === currentId);
    });
}

function initScrollSpy() {
    if (!navLinks.length) return;

    updateActiveSection();
    window.addEventListener('scroll', updateActiveSection, { passive: true });
    window.addEventListener('hashchange', updateActiveSection);
    window.addEventListener('resize', updateActiveSection);
}

function getErrorElement(id) {
    return document.querySelector(`.field-error[data-for="${id}"]`);
}

function setFieldState(field, valid, message = '') {
    const wrapper = field.closest('.form-field');
    const errorElement = getErrorElement(field.id);
    if (!wrapper || !errorElement) return valid;

    wrapper.classList.remove('is-valid', 'is-invalid');

    if (valid) {
        wrapper.classList.add('is-valid');
        errorElement.textContent = '';
    } else {
        wrapper.classList.add('is-invalid');
        errorElement.textContent = message;
    }

    return valid;
}

function validateField(field) {
    const value = field.value.trim();
    const formLang = quickForm?.querySelector('input[name="lang"]')?.value || 'ar';
    const isEn = formLang === 'en';

    if (field.hasAttribute('required') && !value) {
        return setFieldState(field, false, isEn ? 'This field is required' : 'هذا الحقل مطلوب');
    }

    if (field.id === 'quick_email') {
        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailPattern.test(value)) {
            return setFieldState(field, false, isEn ? 'Please enter a valid email address' : 'يرجى إدخال بريد إلكتروني صحيح');
        }
    }

    if (field.id === 'quick_phone') {
        const normalized = value.replace(/\s+/g, '');
        const phonePattern = /^(05\d{8}|5\d{8}|\+9665\d{8}|009665\d{8})$/;
        if (!phonePattern.test(normalized)) {
            return setFieldState(field, false, isEn ? 'Please enter a valid Saudi mobile number' : 'يرجى إدخال رقم جوال سعودي صحيح');
        }
    }

    if (field.id === 'quick_details' && value.length < 15) {
        return setFieldState(field, false, isEn ? 'Please provide clearer case details' : 'يرجى كتابة تفاصيل أوضح للحالة');
    }

    return setFieldState(field, true);
}

function initQuickForm() {
    if (!quickForm || !submitButton) return;
    const fields = quickForm.querySelectorAll('input, select, textarea');

    fields.forEach((field) => {
        field.addEventListener('blur', () => validateField(field));
        field.addEventListener('input', () => {
            if (field.closest('.form-field')?.classList.contains('is-invalid')) {
                validateField(field);
            }
        });
    });

    quickForm.addEventListener('submit', (event) => {
        let valid = true;
        fields.forEach((field) => {
            if (!validateField(field)) valid = false;
        });

        if (!valid) {
            event.preventDefault();
            quickForm.querySelector('.form-field.is-invalid input, .form-field.is-invalid select, .form-field.is-invalid textarea')?.focus();
            return;
        }

        submitButton.classList.add('is-loading');
        const formLang = quickForm.querySelector('input[name="lang"]')?.value || 'ar';
        submitButton.textContent = formLang === 'en' ? 'Sending...' : 'جاري الإرسال...';
    });
}

document.addEventListener('DOMContentLoaded', () => {
    initSidebar();
    initHeaderState();
    initFaq();
    initReveal();
    initCounters();
    initScrollSpy();
    initQuickForm();
    setCurrentYear();
});
