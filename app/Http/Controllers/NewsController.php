<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    // صفحة كل الأخبار
    public function index(Request $request)
    {
        $news = News::where('is_published', 1)
            ->latest('published_at')
            ->paginate(6);

        // إذا الرابط يبدأ بـ /en اعرض نسخة الإنجليزي
        $view = $request->is('en/*') ? 'en.news.index' : 'news.index';

        return view($view, compact('news'));
    }

    // صفحة خبر واحد
    public function show(Request $request, $slug)
    {
        $newsItem = News::where('slug', $slug)
            ->where('is_published', 1)
            ->firstOrFail();

        // إذا الرابط يبدأ بـ /en اعرض نسخة الإنجليزي
        $view = $request->is('en/*') ? 'en.news.show' : 'news.show';

        return view($view, compact('newsItem'));
    }
}