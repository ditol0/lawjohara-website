<!doctype html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>لوحة الأدمن - إدارة الأخبار</title>


    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="images/logo.png">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/admin/news/index.css') }}">
</head>
<body>
    <div class="container">
        <a href="{{ route('admin.cases') }}" class="back-link">
            <i class="fas fa-arrow-right"></i> العودة إلى لوحة التحكم
        </a>

        <header>
            <div class="header-top">
                <h1><i class="fas fa-newspaper"></i> إدارة الأخبار</h1>
                <div class="header-actions">

                    <div class="header-actions">
                     <a href="{{ route('admin.cases') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-right"></i> العودة للقائمة
                </a>
                </div>

                    <a href="{{ route('admin.news.create') }}" class="btn">
                        <i class="fas fa-plus-circle"></i>
                        إضافة خبر جديد
                    </a>
                </div>
            </div>
            <p>عرض وإدارة جميع الأخبار المنشورة على الموقع</p>
        </header>

        @if(session('success'))
        <div class="alert alert-success">
            <i class="fas fa-check-circle"></i>
            <div>
                <strong>تم بنجاح!</strong>
                <p style="margin-top: 5px;">{{ session('success') }}</p>
            </div>
        </div>
        @endif

        @if(session('error'))
        <div class="alert alert-danger">
            <i class="fas fa-exclamation-triangle"></i>
            <div>
                <strong>حدث خطأ!</strong>
                <p style="margin-top: 5px;">{{ session('error') }}</p>
            </div>
        </div>
        @endif

        <div class="stats-container">
            <div class="stat-card">
                <div class="stat-icon" style="background-color: var(--secondary-color);">
                    <i class="fas fa-newspaper"></i>
                </div>
                <div class="stat-content">
                    <h3>{{ $stats['total'] ?? $news->total() }}</h3>
                    <p>إجمالي الأخبار</p>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon" style="background-color: var(--success-color);">
                    <i class="fas fa-check-circle"></i>
                </div>
                <div class="stat-content">
                    <h3>{{ $stats['published'] ?? $news->where('is_published', true)->count() }}</h3>
                    <p>أخبار منشورة</p>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon" style="background-color: var(--warning-color);">
                    <i class="fas fa-edit"></i>
                </div>
                <div class="stat-content">
                    <h3>{{ $stats['draft'] ?? $news->where('is_published', false)->count() }}</h3>
                    <p>مسودات</p>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon" style="background-color: var(--accent-color);">
                    <i class="fas fa-calendar-alt"></i>
                </div>
                <div class="stat-content">
                    <h3>{{ $news->filter(fn($n) => $n->created_at->isToday())->count() }}</h3>

                    <p>أخبار اليوم</p>
                </div>
            </div>
        </div>

        <div class="filters-container">
            <h3><i class="fas fa-filter"></i> تصفية الأخبار</h3>
            <form method="GET" action="" id="filterForm">
                <div class="filter-group">
                    <input type="text" name="search" class="filter-input"
                           placeholder="ابحث بالعنوان أو المحتوى..."
                           value="{{ request('search') }}">

                    <select name="status" class="filter-select">
                        <option value="">جميع الحالات</option>
                        <option value="published" {{ request('status') == 'published' ? 'selected' : '' }}>منشور</option>
                        <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>مسودة</option>
                    </select>

                    <select name="sort" class="filter-select">
                        <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>الأحدث أولاً</option>
                        <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>الأقدم أولاً</option>
                        <option value="title_asc" {{ request('sort') == 'title_asc' ? 'selected' : '' }}>العنوان أ-ي</option>
                        <option value="title_desc" {{ request('sort') == 'title_desc' ? 'selected' : '' }}>العنوان ي-أ</option>
                    </select>

                    <button type="submit" class="filter-btn">
                        <i class="fas fa-search"></i> تطبيق التصفية
                    </button>

                    @if(request()->hasAny(['search', 'status', 'sort']))
                    <a href="{{ route('admin.news.index') }}" class="filter-btn reset-btn">
                        <i class="fas fa-redo"></i> إعادة تعيين
                    </a>
                    @endif
                </div>
            </form>
        </div>

        <div class="table-container">
            <table id="newsTable">
                <thead>
                    <tr>
                        <th width="60">#</th>
                        <th>الخبر</th>
                        <th width="120">الحالة</th>
                        <th width="150">التاريخ</th>
                        <th width="220">الإجراءات</th>
                    </tr>
                </thead>
                <tbody id="newsTableBody">
                    @forelse($news as $index => $n)
                        <tr data-news-id="{{ $n->id }}">
                            <td>{{ $loop->iteration + (($news->currentPage() - 1) * $news->perPage()) }}</td>
                            <td>
                                <div class="news-title">{{ $n->title }}</div>
                                @if($n->excerpt)
                                <div class="news-excerpt">{{ $n->excerpt }}</div>
                                @endif
                                @if($n->cover_image)
                                <img src="{{ asset($n->cover_image) }}" alt="صورة الخبر" class="news-image">
                                @endif

                            </td>
                            <td>
                                @if($n->is_published)
                                <span class="status-badge status-published">
                                    <i class="fas fa-check-circle"></i> منشور
                                </span>
                                @else
                                <span class="status-badge status-draft">
                                    <i class="fas fa-edit"></i> مسودة
                                </span>
                                @endif
                            </td>
                            <td>
                                <div class="news-date">
                                    <i class="far fa-calendar"></i>
                                    {{ $n->created_at->format('Y/m/d') }}
                                </div>
                                <div class="news-date" style="font-size: 12px; color: #aaa;">
                                    <i class="far fa-clock"></i>
                                    {{ $n->created_at->format('H:i') }}
                                </div>
                            </td>
                            <td>
                                <div class="action-btns">

                                  <a href="{{ route('admin.news.show', $n->id) }}" class="action-btn btn-primary">
                                    <i class="fas fa-eye"></i> عرض
                                    </a>

                                   <a href="{{ route('admin.news.edit', $n->id) }}"
                                        class="action-btn btn-warning" title="تعديل">
                                        <i class="fas fa-edit"></i> تعديل
                                    </a>

                                    <form action="{{ route('admin.news.destroy', $n->id) }}" method="POST" style="display: inline;" class="delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="action-btn btn-danger" title="حذف" onclick="return confirmDelete(event)">
                                            <i class="fas fa-trash"></i> حذف
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr id="noResultsRow">
                            <td colspan="5">
                                <div class="empty-state">
                                    <i class="fas fa-newspaper"></i>
                                    <h3>لا توجد أخبار</h3>
                                    <p>لم يتم العثور على أي أخبار تطابق معايير البحث.</p>
                                    <a href="{{ route('admin.news.create') }}" class="btn" style="margin-top: 15px;">
                                        <i class="fas fa-plus-circle"></i> إضافة أول خبر
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($news->hasPages())
        <div id="paginationContainer">
            {{ $news->links() }}
        </div>
        @endif
    </div>

   <script src="{{ asset('js/admin/news/index.js') }}"></script>
</body>
</html>
