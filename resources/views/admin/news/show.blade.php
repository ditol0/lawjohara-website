<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>لوحة الأدمن | عرض الخبر - {{ $news->title }}</title>
    <link rel="icon" type="image/x-icon" href="images/logo.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Amiri:wght@400;700&family=Cairo:wght@300;400;600;700&display=swap" rel="stylesheet">


     <link rel="stylesheet" href="{{ asset('css/admin/show.css') }}">
</head>

<body style="font-family:'Cairo',sans-serif; background:#f7f7f7; margin:0;">

    <header style="background:#fff; padding:15px 0; box-shadow:0 5px 15px rgba(0,0,0,.06);">
        <div style="max-width:1100px; margin:0 auto; padding:0 20px; display:flex; justify-content:space-between; align-items:center;">
            <div style="display:flex; gap:10px; align-items:center;">
                <div style="width:45px;height:45px; border-radius:10px; background:#2d5a27; display:flex; align-items:center; justify-content:center; color:#fff;">
                    <i class="fas fa-newspaper"></i>
                </div>
                <div>
                    <div style="font-weight:700; font-size:18px;">لوحة الأدمن</div>
                    <div style="font-size:12px; color:#666;">عرض خبر</div>
                </div>
            </div>

            <div style="display:flex; gap:10px;">
                <a href="{{ route('admin.news') }}"
                   style="text-decoration:none; background:#2d5a27; color:#fff; padding:10px 14px; border-radius:8px; font-weight:600;">
                    <i class="fas fa-arrow-right"></i> رجوع للأخبار
                </a>

                <a href="{{ route('admin.news.edit', $news->id) }}"
                   style="text-decoration:none; background:#8B4513; color:#fff; padding:10px 14px; border-radius:8px; font-weight:600;">
                    <i class="fas fa-edit"></i> تعديل
                </a>

                <form action="{{ route('admin.news.destroy', $news->id) }}" method="POST"
                      onsubmit="return confirm('متأكد تبغى تحذف الخبر؟');" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                            style="border:none; cursor:pointer; background:#c0392b; color:#fff; padding:10px 14px; border-radius:8px; font-weight:600;">
                        <i class="fas fa-trash"></i> حذف
                    </button>
                </form>
            </div>
        </div>
    </header>

    <main style="max-width:1100px; margin:25px auto; padding:0 20px;">
        <div style="background:#fff; border-radius:14px; padding:22px; box-shadow:0 5px 15px rgba(0,0,0,.06);">

            <div style="display:flex; justify-content:space-between; gap:15px; flex-wrap:wrap; align-items:flex-start;">
                <div style="flex:1; min-width:280px;">
                    <h1 style="margin:0 0 10px; font-family:'Amiri',serif; font-size:30px; color:#2d5a27;">
                        {{ $news->title }}
                    </h1>

                    <div style="display:flex; gap:15px; flex-wrap:wrap; color:#666; font-size:14px;">
                        <div><i class="far fa-calendar-alt"></i>
                            تاريخ الإنشاء: {{ optional($news->created_at)->format('Y-m-d') }}
                        </div>

                        @if($news->published_at)
                            <div><i class="far fa-clock"></i>
                                تاريخ النشر: {{ $news->published_at->format('Y-m-d') }}
                            </div>
                        @endif

                        <div>
                            <i class="fas fa-circle" style="font-size:10px; margin-left:6px; color:{{ $news->is_published ? '#27ae60' : '#e67e22' }}"></i>
                            الحالة: {{ $news->is_published ? 'منشور' : 'مسودة' }}
                        </div>
                    </div>
                </div>
            </div>

            @if($news->cover_image)
                <div style="margin-top:20px; border-radius:14px; overflow:hidden; border:1px solid #eee;">
                    <img src="{{ asset($news->cover_image) }}" alt="{{ $news->title }}"
                         style="width:100%; height:420px; object-fit:cover; display:block;">
                </div>
            @endif

            @if($news->excerpt)
                <div style="margin-top:18px; padding:14px 16px; background:#f5f1ec; border-radius:12px; color:#444; line-height:1.8;">
                    <strong>ملخص:</strong> {{ $news->excerpt }}
                </div>
            @endif

            <div style="margin-top:20px; color:#222; line-height:2; font-size:16px;">
                {!! $news->content !!}
            </div>

        </div>
    </main>

</body>
</html>
