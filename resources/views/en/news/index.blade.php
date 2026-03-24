@extends('layout.main-shell-en', [
    'title' => 'Legal News | Al Jawhara Law Firm and Legal Consultancy',
    'description' => 'Browse the latest legal news and updates from Al Jawhara Law Firm and Legal Consultancy.',
    'page' => 'news',
    'bodyClass' => 'news-page',
])

@push('head')
    <link rel="stylesheet" href="{{ asset('css/news-page.css') }}?v={{ config('assets.version') }}">
@endpush

@section('content')
    <section class="news-section">
        <div class="container">
            <div class="page-header reveal">
                <h1 class="page-title">Legal News and Updates</h1>
                <p class="page-description">We share the latest legal developments, regulatory updates, and firm news to keep you informed.</p>
            </div>

            @if($news->count() > 0)
                <div class="news-grid">
                    @foreach($news as $n)
                        <article class="news-card reveal">
                            @if($n->cover_image)
                                <div class="news-image">
                                    <img src="{{ asset($n->cover_image) }}" alt="{{ $n->title }}" loading="lazy">
                                </div>
                            @endif

                            <div class="news-content">
                                <h3 class="news-title">{{ $n->title }}</h3>
                                <p class="news-excerpt">{{ $n->excerpt }}</p>
                                <div class="news-meta">
                                    <a href="{{ route('news.show', $n->slug) }}" class="read-more">
                                        Read More
                                        <i class="fas fa-arrow-left"></i>
                                    </a>

                                    @if($n->created_at)
                                        <span class="news-date">
                                            <i class="far fa-calendar-alt"></i>
                                            {{ $n->created_at->format('Y-m-d') }}
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>

                <div class="pagination">
                    {{ $news->links() }}
                </div>
            @else
                <div class="empty-state reveal">
                    <div class="empty-state-icon">
                        <i class="far fa-newspaper"></i>
                    </div>
                    <h2 class="empty-state-title">No News Available Right Now</h2>
                    <p class="empty-state-text">Legal news and updates will be published soon. Stay tuned for the latest developments.</p>
                </div>
            @endif
        </div>
    </section>
@endsection
