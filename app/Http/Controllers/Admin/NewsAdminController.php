<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class NewsAdminController extends Controller
{
    /**
     * عرض كل الأخبار
     */
    public function index()
    {
        $news = News::latest()->paginate(20);

        return view('admin.news.index', compact('news'));
    }

    /**
     * صفحة إضافة خبر
     */
    public function create()
    {
        return view('admin.news.create');
    }

    /**
     * حفظ خبر جديد
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title'        => 'required|string|max:255',
            'excerpt'      => 'nullable|string|max:300',
            'content'      => 'required|string',
            'is_published' => 'nullable',
            'cover_image'  => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $data['uuid'] = (string) Str::uuid();
        $data['slug'] = Str::slug($data['title']) . '-' . Str::random(6);
        $data['is_published'] = $request->has('is_published');
        $data['published_at'] = $data['is_published'] ? now() : null;

        if ($request->hasFile('cover_image')) {
            $file = $request->file('cover_image');
            $filename = time() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/news'), $filename);
            $data['cover_image'] = 'uploads/news/' . $filename;
        }

        News::create($data);

        return redirect()->route('admin.news')
            ->with('success', 'تم إضافة الخبر بنجاح');
    }

    /**
     * عرض خبر واحد
     */
    public function show(News $news)
    {
        return view('admin.news.show', compact('news'));
    }

    /**
     * صفحة تعديل خبر
     */
    public function edit(News $news)
    {
        return view('admin.news.edit', compact('news'));
    }

    /**
     * تحديث خبر
     */
    public function update(Request $request, News $news)
    {
        $data = $request->validate([
            'title'        => 'required|string|max:255',
            'excerpt'      => 'nullable|string|max:300',
            'content'      => 'required|string',
            'is_published' => 'nullable',
            'cover_image'  => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $data['is_published'] = $request->has('is_published');
        $data['published_at'] = $data['is_published'] ? now() : null;

        if ($request->hasFile('cover_image')) {
            $file = $request->file('cover_image');
            $filename = time() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/news'), $filename);
            $data['cover_image'] = 'uploads/news/' . $filename;
        }

        $news->update($data);

        return redirect()->route('admin.news')
            ->with('success', 'تم تحديث الخبر بنجاح');
    }

    /**
     * حذف خبر
     */
    public function destroy(News $news)
    {
        $news->delete();

        return redirect()->route('admin.news')
            ->with('success', 'تم حذف الخبر بنجاح');
    }
}