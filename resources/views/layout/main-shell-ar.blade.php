<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'مكتب الجوهرة للمحاماة والاستشارات القانونية' }}</title>
    <meta name="description" content="{{ $description ?? 'حلول قانونية متكاملة للأفراد والمنشآت في المملكة العربية السعودية.' }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Almarai:wght@300;400;700;800&family=Tajawal:wght@300;400;500;700&family=El+Messiri:wght@400;500;600;700&family=Noto+Naskh+Arabic:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="{{ asset('images/logo.png') }}">
    <link rel="canonical" href="{{ url()->current() }}">
    <link rel="alternate" hreflang="ar" href="{{ route('mine') }}">
    <link rel="alternate" hreflang="en" href="{{ route('en.mine') }}">
    <link rel="stylesheet" href="{{ asset('css/main-page.css') }}?v={{ config('assets.version') }}">
    @stack('head')
</head>
<body class="{{ $bodyClass ?? '' }}">
    @include('layout.partials.main-sidebar', ['page' => $page ?? 'home'])
    <div class="site-overlay" id="siteOverlay"></div>

    @include('layout.partials.main-header', ['page' => $page ?? 'home'])

    <main class="site-main">
        @yield('content')
    </main>

    @include('layout.partials.main-footer')

    <a href="https://wa.me/+966533461460" class="floating-whatsapp" target="_blank" rel="noopener" aria-label="تواصل معنا عبر واتساب">
        <i class="fab fa-whatsapp"></i>
    </a>

    <script src="{{ asset('js/main-page.js') }}?v={{ config('assets.version') }}"></script>
    @stack('scripts')
</body>
</html>