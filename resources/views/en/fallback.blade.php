@extends('layout.main-shell-en', [
    'title' => 'Page Not Found | Al Jawhara Law Firm',
    'description' => 'Sorry, the requested page is unavailable. You can return to the homepage or contact us.',
    'page' => 'fallback',
    'bodyClass' => 'fallback-page',
])

@push('head')
<style>
.fallback-wrap {
    min-height: calc(100vh - 220px);
    display: grid;
    place-items: center;
    padding: 150px 0 80px;
    background:
        radial-gradient(circle at 15% 15%, rgba(212, 175, 55, 0.14), rgba(212, 175, 55, 0) 36%),
        radial-gradient(circle at 85% 10%, rgba(26, 54, 93, 0.12), rgba(26, 54, 93, 0) 32%),
        linear-gradient(180deg, #f7f9fc 0%, #eef3fa 100%);
}
.fallback-card {
    width: min(760px, 100%);
    margin-inline: auto;
    text-align: center;
    background: rgba(255, 255, 255, 0.95);
    border: 1px solid rgba(26, 54, 93, 0.08);
    border-radius: 28px;
    box-shadow: 0 24px 65px rgba(26, 54, 93, 0.12);
    padding: 44px 34px;
}
.fallback-code {
    display: inline-block;
    font-size: clamp(3.4rem, 8vw, 6rem);
    line-height: 1;
    font-weight: 800;
    letter-spacing: -2px;
    margin-bottom: 8px;
    background: linear-gradient(135deg, #1a365d 0%, #d4af37 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}
.fallback-card h1 {
    margin: 8px 0 14px;
    font-size: clamp(1.8rem, 3.2vw, 2.6rem);
    color: #1a365d;
}
.fallback-card p {
    margin: 0 auto;
    max-width: 620px;
    color: #5b6678;
    font-size: 1.06rem;
    line-height: 1.9;
}
.fallback-actions {
    margin-top: 28px;
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 14px;
}
.fallback-actions .button {
    min-width: 190px;
}
@media (max-width: 640px) {
    .fallback-wrap {
        padding: 120px 0 56px;
    }
    .fallback-card {
        border-radius: 20px;
        padding: 30px 20px;
    }
    .fallback-actions .button {
        width: 100%;
        min-width: 0;
    }
}
</style>
@endpush

@section('content')
<section class="fallback-wrap" aria-labelledby="fallbackTitle">
    <div class="container">
        <article class="fallback-card">
            <span class="fallback-code" aria-hidden="true">404</span>
            <h1 id="fallbackTitle">Page Not Found</h1>
            <p>
                The link you tried to access is currently unavailable. It may have been moved,
                deleted, or entered incorrectly. You can return to the homepage or contact us directly.
            </p>

            <div class="fallback-actions">
                <a href="{{ route('mine') }}" class="button button--primary">Back to Home</a>
                <a href="{{ route('contact') }}" class="button button--secondary">Go to Contact Page</a>
            </div>
        </article>
    </div>
</section>
@endsection
