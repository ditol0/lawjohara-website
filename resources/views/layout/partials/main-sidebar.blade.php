@php
    $isHome = ($page ?? 'home') === 'home';
@endphp

<aside class="sidebar" id="sidebar" aria-label="القائمة الجانبية">
    <div class="sidebar-header">
        <h2>القائمة</h2>
        <button class="close-btn" id="closeSidebar" type="button" aria-label="إغلاق القائمة">&times;</button>
    </div>

    <nav class="sidebar-nav">
        <a href="{{ $isHome ? '#home' : route('mine') }}" class="sidebar-link {{ $isHome ? 'active' : '' }}">الرئيسية</a>
        <a href="{{ $isHome ? '#about' : route('mine').'#about' }}" class="sidebar-link">من نحن</a>
        <a href="{{ $isHome ? '#services' : route('mine').'#services' }}" class="sidebar-link">الخدمات</a>
        <a href="{{ $isHome ? '#faq' : route('mine').'#faq' }}" class="sidebar-link">الأسئلة الشائعة</a>
        <a href="{{ route('news') }}" class="sidebar-link {{ ($page ?? '') === 'news' ? 'active' : '' }}">الأخبار</a>
        <a href="{{ route('contact') }}" class="sidebar-link {{ ($page ?? '') === 'contact' ? 'active' : '' }}">اتصل بنا</a>
        <a href="{{ route('en.mine') }}" class="sidebar-link">English</a>
    </nav>
</aside>
