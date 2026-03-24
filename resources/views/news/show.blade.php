@extends('layout.main-shell-ar', [
    'title' => 'مكتب الجوهرة للمحاماة والاستشارات القانونية | ' . $newsItem->title,
    'description' => \Illuminate\Support\Str::limit(strip_tags($newsItem->excerpt ?: $newsItem->content), 155),
    'page' => 'news',
    'bodyClass' => 'news-show-page',
])

@php
    $canonicalUrl = url()->current();
    $metaDescription = \Illuminate\Support\Str::limit(strip_tags($newsItem->excerpt ?: $newsItem->content), 155);
    $coverImage = $newsItem->cover_image ? asset($newsItem->cover_image) : asset('images/logo.png');
@endphp

@push('head')
    <link rel="canonical" href="{{ $canonicalUrl }}">
    <meta property="og:type" content="article">
    <meta property="og:title" content="{{ $newsItem->title }}">
    <meta property="og:description" content="{{ $metaDescription }}">
    <meta property="og:url" content="{{ $canonicalUrl }}">
    <meta property="og:image" content="{{ $coverImage }}">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $newsItem->title }}">
    <meta name="twitter:description" content="{{ $metaDescription }}">
    <meta name="twitter:image" content="{{ $coverImage }}">

    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "NewsArticle",
        "headline": @json($newsItem->title),
        "image": [@json($coverImage)],
        "datePublished": @json(optional($newsItem->published_at ?? $newsItem->created_at)->toIso8601String()),
        "dateModified": @json(optional($newsItem->updated_at ?? $newsItem->created_at)->toIso8601String()),
        "author": {
            "@type": "Person",
            "name": @json($newsItem->author ?? 'مكتب الجوهرة للمحاماة والاستشارات القانونية')
        },
        "publisher": {
            "@type": "Organization",
            "name": "مكتب الجوهرة للمحاماة والاستشارات القانونية",
            "logo": {
                "@type": "ImageObject",
                "url": @json(asset('images/logo.png'))
            }
        },
        "mainEntityOfPage": {
            "@type": "WebPage",
            "@id": @json($canonicalUrl)
        }
    }
    </script>

    <style>
        .news-show-page {
            --news-gold: #9c7d2f;
            --news-navy: #19384c;
            --news-bg: #f8f7f4;
            --news-card: #ffffff;
            --news-text: #2f2f2f;
            --news-muted: #6d6d6d;
            --news-shadow: 0 10px 30px rgba(16, 34, 46, 0.08);
            background: var(--news-bg);
        }

        .news-show-page .news-show-wrap {
            padding: 2rem 0 4rem;
        }

        .news-show-page .news-container {
            width: min(1100px, 92%);
            margin: 0 auto;
        }

        .news-show-page .news-breadcrumb {
            display: flex;
            gap: 0.6rem;
            align-items: center;
            flex-wrap: wrap;
            background: #fff;
            border: 1px solid rgba(156, 125, 47, 0.15);
            border-radius: 12px;
            padding: 0.95rem 1.15rem;
            margin-bottom: 1.5rem;
            color: var(--news-muted);
        }

        .news-show-page .news-breadcrumb a {
            color: var(--news-navy);
            text-decoration: none;
            font-weight: 700;
            transition: color 0.2s ease;
        }

        .news-show-page .news-breadcrumb a:hover {
            color: var(--news-gold);
        }

        .news-show-page .news-article {
            background: var(--news-card);
            border-radius: 18px;
            border: 1px solid rgba(156, 125, 47, 0.18);
            box-shadow: var(--news-shadow);
            overflow: hidden;
        }

        .news-show-page .news-header {
            padding: 2rem;
            border-bottom: 1px solid rgba(25, 56, 76, 0.08);
        }

        .news-show-page .news-title {
            font-family: 'El Messiri', 'Noto Naskh Arabic', sans-serif;
            font-size: clamp(1.6rem, 3vw, 2.4rem);
            line-height: 1.35;
            margin: 0 0 1rem;
            color: var(--news-navy);
        }

        .news-show-page .news-meta {
            display: flex;
            flex-wrap: wrap;
            gap: 0.7rem;
        }

        .news-show-page .news-meta-item {
            display: inline-flex;
            align-items: center;
            gap: 0.45rem;
            padding: 0.45rem 0.8rem;
            border-radius: 999px;
            background: rgba(25, 56, 76, 0.06);
            color: var(--news-muted);
            font-size: 0.92rem;
        }

        .news-show-page .news-meta-item i {
            color: var(--news-gold);
        }

        .news-show-page .news-cover {
            max-height: 520px;
            overflow: hidden;
            background: #e8e8e8;
        }

        .news-show-page .news-cover img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .news-show-page .news-excerpt {
            margin: 1.5rem 2rem 0;
            padding: 1rem 1.25rem;
            border-radius: 12px;
            background: linear-gradient(135deg, rgba(156, 125, 47, 0.08), rgba(25, 56, 76, 0.04));
            color: var(--news-text);
            border-right: 4px solid var(--news-gold);
            line-height: 1.9;
        }

        .news-show-page .news-content {
            padding: 1.8rem 2rem 2rem;
            color: var(--news-text);
            line-height: 1.95;
            font-size: 1.06rem;
        }

        .news-show-page .news-content h2,
        .news-show-page .news-content h3,
        .news-show-page .news-content h4 {
            font-family: 'El Messiri', 'Noto Naskh Arabic', sans-serif;
            color: var(--news-navy);
            margin: 1.7rem 0 0.8rem;
            line-height: 1.5;
        }

        .news-show-page .news-content h2 {
            font-size: 1.55rem;
            border-bottom: 2px solid rgba(156, 125, 47, 0.4);
            padding-bottom: 0.35rem;
        }

        .news-show-page .news-content h3 {
            font-size: 1.3rem;
            border-right: 3px solid var(--news-gold);
            padding-right: 0.65rem;
        }

        .news-show-page .news-content img {
            max-width: 100%;
            height: auto;
            border-radius: 14px;
            margin: 1rem auto;
            display: block;
        }

        .news-show-page .news-content table {
            width: 100%;
            border-collapse: collapse;
            margin: 1.2rem 0;
        }

        .news-show-page .news-content th,
        .news-show-page .news-content td {
            border: 1px solid rgba(25, 56, 76, 0.12);
            padding: 0.7rem;
            text-align: right;
        }

        .news-show-page .news-content th {
            background: rgba(25, 56, 76, 0.08);
            color: var(--news-navy);
        }

        .news-show-page .news-footer {
            border-top: 1px solid rgba(25, 56, 76, 0.08);
            padding: 1.25rem 2rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 1rem;
            background: #fafafa;
        }

        .news-show-page .back-button {
            display: inline-flex;
            align-items: center;
            gap: 0.55rem;
            text-decoration: none;
            background: var(--news-navy);
            color: #fff;
            border-radius: 10px;
            padding: 0.72rem 1.05rem;
            font-weight: 700;
            border: 1px solid transparent;
            transition: all 0.2s ease;
        }

        .news-show-page .back-button:hover {
            background: #fff;
            color: var(--news-navy);
            border-color: var(--news-navy);
        }

        .news-show-page .share-buttons {
            display: flex;
            align-items: center;
            gap: 0.55rem;
        }

        .news-show-page .share-button {
            width: 42px;
            height: 42px;
            border-radius: 999px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            text-decoration: none;
            transition: transform 0.2s ease;
        }

        .news-show-page .share-button:hover {
            transform: translateY(-2px);
        }

        .news-show-page .share-button.whatsapp {
            background: #25d366;
        }

        .news-show-page .share-button.twitter {
            background: #1da1f2;
        }

        .news-show-page .share-button.facebook {
            background: #1877f2;
        }

        .news-show-page .share-button.linkedin {
            background: #0077b5;
        }

        .news-show-page .related-news {
            margin-top: 2.4rem;
        }

        .news-show-page .related-title {
            text-align: center;
            margin: 0 0 1.2rem;
            color: var(--news-navy);
            font-family: 'El Messiri', 'Noto Naskh Arabic', sans-serif;
            font-size: 1.7rem;
        }

        .news-show-page .related-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 1rem;
        }

        .news-show-page .related-card {
            background: #fff;
            border: 1px solid rgba(25, 56, 76, 0.1);
            border-radius: 14px;
            overflow: hidden;
            display: flex;
            flex-direction: column;
        }

        .news-show-page .related-image {
            height: 170px;
            overflow: hidden;
        }

        .news-show-page .related-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .news-show-page .related-content {
            padding: 1rem;
            display: flex;
            flex-direction: column;
            gap: 0.7rem;
            height: 100%;
        }

        .news-show-page .related-headline {
            color: var(--news-navy);
            font-size: 1.05rem;
            line-height: 1.6;
            margin: 0;
        }

        .news-show-page .related-excerpt {
            color: var(--news-muted);
            font-size: 0.94rem;
            line-height: 1.8;
            margin: 0;
            flex: 1;
        }

        .news-show-page .related-link {
            color: var(--news-navy);
            text-decoration: none;
            font-weight: 700;
            width: fit-content;
        }

        .news-show-page .related-link:hover {
            color: var(--news-gold);
        }

        @media (max-width: 768px) {
            .news-show-page .news-show-wrap {
                padding: 1.25rem 0 3rem;
            }

            .news-show-page .news-header,
            .news-show-page .news-content,
            .news-show-page .news-footer {
                padding-right: 1rem;
                padding-left: 1rem;
            }

            .news-show-page .news-excerpt {
                margin-right: 1rem;
                margin-left: 1rem;
            }

            .news-show-page .news-footer {
                flex-direction: column;
                align-items: stretch;
            }

            .news-show-page .share-buttons {
                justify-content: center;
            }

            .news-show-page .back-button {
                justify-content: center;
            }
        }
    </style>
@endpush

@section('content')
    <section class="news-show-wrap">
        <div class="news-container">
            <nav class="news-breadcrumb" aria-label="مسار التنقل">
                <a href="{{ route('mine') }}">الرئيسية</a>
                <span>/</span>
                <a href="{{ route('news') }}">الأخبار</a>
                <span>/</span>
                <span>{{ \Illuminate\Support\Str::limit($newsItem->title, 55) }}</span>
            </nav>

            <article class="news-article">
                <header class="news-header">
                    <h1 class="news-title">{{ $newsItem->title }}</h1>

                    <div class="news-meta">
                        @if($newsItem->published_at)
                            <span class="news-meta-item">
                                <i class="far fa-calendar-alt"></i>
                                {{ $newsItem->published_at->format('Y-m-d') }}
                            </span>
                        @endif

                        @if($newsItem->author)
                            <span class="news-meta-item">
                                <i class="far fa-user"></i>
                                {{ $newsItem->author }}
                            </span>
                        @endif
                    </div>
                </header>

                @if($newsItem->cover_image)
                    <div class="news-cover">
                        <img src="{{ asset($newsItem->cover_image) }}" alt="{{ $newsItem->title }}" loading="lazy">
                    </div>
                @endif

                @if($newsItem->excerpt)
                    <div class="news-excerpt">
                        {{ $newsItem->excerpt }}
                    </div>
                @endif

                <div class="news-content">
                    {!! $newsItem->content !!}
                </div>

                <footer class="news-footer">
                    <a href="{{ route('news') }}" class="back-button" aria-label="العودة إلى صفحة الأخبار">
                        <i class="fas fa-arrow-right"></i>
                        العودة للأخبار
                    </a>

                    <div class="share-buttons" aria-label="مشاركة الخبر">
                        <a href="https://wa.me/?text={{ urlencode($newsItem->title . ' ' . $canonicalUrl) }}" class="share-button whatsapp" target="_blank" rel="noopener" aria-label="مشاركة عبر واتساب">
                            <i class="fab fa-whatsapp"></i>
                        </a>
                        <a href="https://twitter.com/intent/tweet?text={{ urlencode($newsItem->title) }}&url={{ $canonicalUrl }}" class="share-button twitter" target="_blank" rel="noopener" aria-label="مشاركة عبر تويتر">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ $canonicalUrl }}" class="share-button facebook" target="_blank" rel="noopener" aria-label="مشاركة عبر فيسبوك">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ $canonicalUrl }}" class="share-button linkedin" target="_blank" rel="noopener" aria-label="مشاركة عبر لينكدإن">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                    </div>
                </footer>
            </article>

            @if(isset($relatedNews) && $relatedNews->count())
                <section class="related-news" aria-label="أخبار ذات صلة">
                    <h2 class="related-title">أخبار ذات صلة</h2>

                    <div class="related-grid">
                        @foreach($relatedNews as $related)
                            <article class="related-card">
                                @if($related->cover_image)
                                    <div class="related-image">
                                        <img src="{{ asset($related->cover_image) }}" alt="{{ $related->title }}" loading="lazy">
                                    </div>
                                @endif

                                <div class="related-content">
                                    <h3 class="related-headline">{{ $related->title }}</h3>
                                    <p class="related-excerpt">{{ \Illuminate\Support\Str::limit($related->excerpt, 110) }}</p>
                                    <a href="{{ route('news.show', $related->slug) }}" class="related-link">
                                        اقرأ المزيد
                                        <i class="fas fa-arrow-left"></i>
                                    </a>
                                </div>
                            </article>
                        @endforeach
                    </div>
                </section>
            @endif
        </div>
    </section>
@endsection
