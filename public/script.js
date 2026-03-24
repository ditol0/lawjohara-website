// DOM Elements
const hamburger = document.getElementById('hamburger');
const sidebar = document.getElementById('sidebar');
const closeSidebar = document.getElementById('closeSidebar');
const overlay = document.getElementById('overlay');
const navLinks = document.querySelectorAll('.main-nav a, .nav-link');
const faqQuestions = document.querySelectorAll('.faq-question');

// Sidebar Toggle
hamburger.addEventListener('click', () => {
    sidebar.classList.add('open');
    overlay.classList.add('active');
    document.body.style.overflow = 'hidden';
});

closeSidebar.addEventListener('click', () => {
    sidebar.classList.remove('open');
    overlay.classList.remove('active');
    document.body.style.overflow = 'auto';
});

overlay.addEventListener('click', () => {
    sidebar.classList.remove('open');
    overlay.classList.remove('active');
    document.body.style.overflow = 'auto';
});

// Smooth Scrolling for Navigation Links
navLinks.forEach(link => {
    link.addEventListener('click', function(e) {
        // For sidebar links
        if (this.classList.contains('nav-link')) {
            sidebar.classList.remove('open');
            overlay.classList.remove('active');
            document.body.style.overflow = 'auto';
        }

        // Get target section
        const targetId = this.getAttribute('href');
        if (targetId.startsWith('#')) {
            e.preventDefault();
            const targetSection = document.querySelector(targetId);
            if (targetSection) {
                const headerHeight = document.querySelector('.header').offsetHeight;
                const targetPosition = targetSection.offsetTop - headerHeight;

                window.scrollTo({
                    top: targetPosition,
                    behavior: 'smooth'
                });

                // Update active nav link
                updateActiveNavLink(targetId);
            }
        }
    });
});

// Update Active Navigation Link
function updateActiveNavLink(targetId) {
    // Update main nav
    document.querySelectorAll('.main-nav a').forEach(link => {
        link.classList.remove('active');
        if (link.getAttribute('href') === targetId) {
            link.classList.add('active');
        }
    });

    // Update sidebar nav
    document.querySelectorAll('.nav-link').forEach(link => {
        link.classList.remove('active');
        if (link.getAttribute('href') === targetId) {
            link.classList.add('active');
        }
    });
}

// FAQ Toggle Functionality
faqQuestions.forEach(question => {
    question.addEventListener('click', () => {
        const faqItem = question.parentElement;
        const answer = question.nextElementSibling;

        // Close other open FAQs
        document.querySelectorAll('.faq-item.active').forEach(item => {
            if (item !== faqItem) {
                item.classList.remove('active');
                item.querySelector('.faq-answer').classList.remove('active');
            }
        });

        // Toggle current FAQ
        faqItem.classList.toggle('active');
        answer.classList.toggle('active');
    });
});

// Header Scroll Effect
window.addEventListener('scroll', () => {
    const header = document.querySelector('.header');
    const scrollPosition = window.scrollY;

    if (scrollPosition > 100) {
        header.style.boxShadow = '0 5px 20px rgba(0, 0, 0, 0.1)';
    } else {
        header.style.boxShadow = '0 5px 15px rgba(0, 0, 0, 0.08)';
    }

    // Update active nav link based on scroll
    const sections = document.querySelectorAll('section');
    let currentSection = '';

    sections.forEach(section => {
        const sectionTop = section.offsetTop;
        const sectionHeight = section.clientHeight;
        const headerHeight = document.querySelector('.header').offsetHeight;

        if (scrollPosition >= (sectionTop - headerHeight - 100)) {
            currentSection = '#' + section.getAttribute('id');
        }
    });

    if (currentSection) {
        updateActiveNavLink(currentSection);
    }
});

// Partners Slider Animation
const partnersSlider = document.querySelector('.partners-slider');
if (partnersSlider) {
    const logos = partnersSlider.querySelectorAll('.partner-logo');

    // Animate logos one by one
    logos.forEach((logo, index) => {
        logo.style.opacity = '0';
        logo.style.transform = 'translateY(20px)';

        setTimeout(() => {
            logo.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
            logo.style.opacity = '1';
            logo.style.transform = 'translateY(0)';
        }, index * 200);
    });
}

// Initialize when page loads
document.addEventListener('DOMContentLoaded', () => {
    // Set current year in footer
    const yearElement = document.querySelector('.copyright');
    if (yearElement) {
        const currentYear = new Date().getFullYear();
        yearElement.textContent = yearElement.textContent.replace('2025', currentYear);
    }

    // Add loading animation to service cards
    const serviceCards = document.querySelectorAll('.service-card');
    serviceCards.forEach((card, index) => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(20px)';

        setTimeout(() => {
            card.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
            card.style.opacity = '1';
            card.style.transform = 'translateY(0)';
        }, index * 100 + 500);
    });
});
