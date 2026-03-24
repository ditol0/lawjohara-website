<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="https://www.sitemaps.org/schemas/sitemap/0.9">

    {{-- ========== عربي ========== --}}
    <url>
        <loc>{{ url('/') }}</loc>
        <priority>1.0</priority>
    </url>

    <url>
        <loc>{{ url('/news') }}</loc>
        <priority>0.8</priority>
    </url>

    <url>
        <loc>{{ url('/contact') }}</loc>
        <priority>0.7</priority>
    </url>

    @foreach ($news as $item)
        <url>
            <loc>{{ url('/news/' . $item->slug) }}</loc>
            <lastmod>{{ $item->updated_at->toDateString() }}</lastmod>
            <priority>0.6</priority>
        </url>
    @endforeach


    {{-- ========== English ========== --}}
    <url>
        <loc>{{ url('/en') }}</loc>
        <priority>1.0</priority>
    </url>

    <url>
        <loc>{{ url('/en/news') }}</loc>
        <priority>0.8</priority>
    </url>

    <url>
        <loc>{{ url('/en/contact') }}</loc>
        <priority>0.7</priority>
    </url>

    @foreach ($news as $item)
        <url>
            <loc>{{ url('/en/news/' . $item->slug) }}</loc>
            <lastmod>{{ $item->updated_at->toDateString() }}</lastmod>
            <priority>0.6</priority>
        </url>
    @endforeach

</urlset>
