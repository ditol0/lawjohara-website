@php
    $isHome = ($page ?? 'home') === 'home';
@endphp

<header class="header" id="header">
    <div class="container">
        <div class="header-content">
            <div class="logo">
                <a href="{{ route('en.mine') }}" class="logo-link" aria-label="Back to homepage">
                    <div class="logo-icon">
                        <img src="{{ asset('images/logo.png') }}" alt="Al Jawhara Law Firm logo">
                    </div>
                    <div class="logo-text">
                        <span class="logo-main">Al Jawhara Law</span>
                        <span class="logo-sub">Legal Consultancy</span>
                    </div>
                </a>
            </div>

            <nav class="main-nav" aria-label="Main navigation">
                <a href="{{ $isHome ? '#home' : route('en.mine') }}" class="nav-link section-link" data-section="home">Home</a>
                <a href="{{ $isHome ? '#about' : route('en.mine').'#about' }}" class="nav-link section-link" data-section="about">About</a>
                <a href="{{ $isHome ? '#services' : route('en.mine').'#services' }}" class="nav-link section-link" data-section="services">Services</a>
                <a href="{{ $isHome ? '#faq' : route('en.mine').'#faq' }}" class="nav-link section-link" data-section="faq">FAQ</a>
                <a href="{{ route('news.en') }}" class="nav-link {{ ($page ?? '') === 'news' ? 'nav-cta' : '' }}">News</a>
                <a href="{{ route('contact.en') }}" class="nav-link {{ ($page ?? '') === 'contact' ? 'nav-cta' : '' }}">Contact</a>
                <a href="{{ route('mine') }}" class="nav-link">العربية</a>
            </nav>

            <button class="hamburger" id="hamburger" type="button" aria-label="Open menu" aria-expanded="false" aria-controls="sidebar">
                <span></span>
                <span></span>
                <span></span>
            </button>
        </div>
    </div>
</header>