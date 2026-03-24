@php
    $isHome = ($page ?? 'home') === 'home';
@endphp

<header class="header" id="header">
    <div class="container">
        <div class="header-content">
            <div class="logo">
                <a href="{{ route('mine') }}" class="logo-link" aria-label="العودة إلى الصفحة الرئيسية">
                    <div class="logo-icon">
                        <img src="{{ asset('images/logo.png') }}" alt="شعار مكتب الجوهرة">
                    </div>
                    <div class="logo-text">
                        <span class="logo-main">مكتب الجوهرة</span>
                        <span class="logo-sub">للمحاماة والاستشارات القانونية</span>
                    </div>
                </a>
            </div>

            <nav class="main-nav" aria-label="التنقل الرئيسي">
                <a href="{{ $isHome ? '#home' : route('mine') }}" class="nav-link section-link" data-section="home">الرئيسية</a>
                <a href="{{ $isHome ? '#about' : route('mine').'#about' }}" class="nav-link section-link" data-section="about">من نحن</a>
                <a href="{{ $isHome ? '#services' : route('mine').'#services' }}" class="nav-link section-link" data-section="services">الخدمات</a>
                <a href="{{ $isHome ? '#faq' : route('mine').'#faq' }}" class="nav-link section-link" data-section="faq">الأسئلة الشائعة</a>
                <a href="{{ route('news') }}" class="nav-link {{ ($page ?? '') === 'news' ? 'nav-cta' : '' }}">الأخبار</a>
                <a href="{{ route('contact') }}" class="nav-link   {{ ($page ?? '') === 'contact' ? 'nav-cta' : '' }}">اتصل بنا</a>
                <a href="{{ route('en.mine') }}" class="nav-link">English</a>
            </nav>

            <button class="hamburger" id="hamburger" type="button" aria-label="فتح القائمة" aria-expanded="false" aria-controls="sidebar">
                <span></span>
                <span></span>
                <span></span>
            </button>
        </div>
    </div>
</header>
