@php
    $isHome = ($page ?? 'home') === 'home';
@endphp

<aside class="sidebar" id="sidebar" aria-label="Sidebar menu">
    <div class="sidebar-header">
        <h2>Menu</h2>
        <button class="close-btn" id="closeSidebar" type="button" aria-label="Close menu">&times;</button>
    </div>

    <nav class="sidebar-nav">
        <a href="{{ $isHome ? '#home' : route('en.mine') }}" class="sidebar-link {{ $isHome ? 'active' : '' }}">Home</a>
        <a href="{{ $isHome ? '#about' : route('en.mine').'#about' }}" class="sidebar-link">About</a>
        <a href="{{ $isHome ? '#services' : route('en.mine').'#services' }}" class="sidebar-link">Services</a>
        <a href="{{ $isHome ? '#faq' : route('en.mine').'#faq' }}" class="sidebar-link">FAQ</a>
        <a href="{{ route('news.en') }}" class="sidebar-link {{ ($page ?? '') === 'news' ? 'active' : '' }}">News</a>
        <a href="{{ route('contact.en') }}" class="sidebar-link {{ ($page ?? '') === 'contact' ? 'active' : '' }}">Contact</a>
        <a href="{{ route('mine') }}" class="sidebar-link">العربية</a>
    </nav>
</aside>