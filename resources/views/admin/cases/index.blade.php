<!doctype html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>لوحة الأدمن - الطلبات</title>

 
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="images/logo.png">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/admin/index.css') }}">

</head>
<body>
    <div class="container">
        <header>
            <div class="header-top">
                <h1><i class="fas fa-gavel"></i> لوحة تحكم الطلبات - القضايا</h1>
               <div class="header-actions">

    <a href="{{ route('admin.news') }}" class="add-news-btn">
        <i class="fas fa-newspaper"></i>
        قائمة الأخبار
    </a>

    <a href="{{ route('admin.news.create') }}" class="add-news-btn">
        <i class="fas fa-plus-circle"></i>
        إضافة خبر جديد
    </a>


    <form action="{{ route('admin.logout') }}" method="POST" style="display:inline;">
        @csrf
        <button type="submit" class="add-news-btn logout-btn">
            <i class="fas fa-sign-out-alt"></i>
            تسجيل الخروج
        </button>
    </form>

</div>


            </div>
            <p>إدارة وعرض جميع طلبات القضايا المقدمة من العملاء</p>
        </header>

        <div class="stats-container">
            {{-- إجمالي الطلبات --}}
            <div class="stat-card">
                <div class="stat-icon" style="background-color: var(--secondary-color);">
                    <i class="fas fa-clipboard-list"></i>
                </div>
                <div class="stat-content">
                    <h3>{{ $stats['total'] }}</h3>
                    <p>إجمالي الطلبات</p>
                </div>
            </div>

            {{-- طلبات قيد الانتظار (new) --}}
            <div class="stat-card">
                <div class="stat-icon" style="background-color: var(--warning-color);">
                    <i class="fas fa-clock"></i>
                </div>
                <div class="stat-content">
                    <h3>{{ $stats['pending'] }}</h3>
                    <p>طلبات قيد الانتظار</p>
                </div>
            </div>

            {{-- طلبات مكتملة (closed) --}}
            <div class="stat-card">
                <div class="stat-icon" style="background-color: var(--success-color);">
                    <i class="fas fa-check-circle"></i>
                </div>
                <div class="stat-content">
                    <h3>{{ $stats['completed'] }}</h3>
                    <p>طلبات مكتملة</p>
                </div>
            </div>

            {{-- طلبات قيد المعالجة (in_progress) --}}
            <div class="stat-card">
                <div class="stat-icon" style="background-color: var(--accent-color);">
                    <i class="fas fa-spinner"></i>
                </div>
                <div class="stat-content">
                    <h3>{{ $stats['in_progress'] }}</h3>
                    <p>طلبات قيد المعالجة</p>
                </div>
            </div>
        </div>

        <div class="filters-container">
            <h3><i class="fas fa-filter"></i> تصفية الطلبات</h3>
            <div class="filter-group">
                <input type="text" id="searchInput" class="filter-input" placeholder="ابحث بالاسم، الجوال أو رقم الطلب...">
                <select id="statusFilter" class="filter-select">
                    <option value="">جميع الحالات</option>
                    <option value="new">جديد</option>
                    <option value="in-progress">قيد المعالجة</option>
                    <option value="completed">مكتمل</option>
                    <option value="cancelled">ملغي</option>
                </select>
                <select id="caseTypeFilter" class="filter-select">
                    <option value="">جميع أنواع القضايا</option>
                    <option value="جنائية">جنائية</option>
                    <option value="مدنية">مدنية</option>
                    <option value="تجارية">تجارية</option>
                    <option value="أحوال شخصية">أحوال شخصية</option>
                    <option value="إدارية">إدارية</option>
                </select>
                <button id="applyFilter" class="filter-btn"><i class="fas fa-search"></i> تطبيق التصفية</button>
                <button id="resetFilter" class="filter-btn reset-btn"><i class="fas fa-redo"></i> إعادة تعيين</button>
            </div>
        </div>

        <div class="table-container">
            <table id="casesTable">
                <thead>
                    <tr>
                        <th>رقم الطلب</th>
                        <th>الاسم</th>
                        <th>الجوال</th>
                        <th>نوع القضية</th>
                        <th>الحالة</th>
                        <th>تاريخ الإرسال</th>
                        <th>الإجراءات</th>
                    </tr>
                </thead>
                <tbody id="casesTableBody">
@foreach($cases as $c)
    @php
        // تحويل الحالة + الكلاس
        $statusText = 'غير معروف';
        $statusClass = 'status-new';

        if ($c->status === 'new') {
            $statusText = 'جديد';
            $statusClass = 'status-new';
        } elseif ($c->status === 'in_progress') {
            $statusText = 'جاري العمل';
            $statusClass = 'status-in-progress';
        } elseif ($c->status === 'closed') {
            $statusText = 'مغلقة';
            $statusClass = 'status-completed';
        }
    @endphp

    <tr
        data-case-id="{{ $c->id }}"
        data-case-uuid="{{ $c->uuid }}"
        data-case-name="{{ $c->name }}"
        data-case-phone="{{ $c->phone }}"
        data-case-type="{{ $c->case_type }}"
        data-case-status="{{ $c->status }}"
        data-case-created="{{ $c->created_at?->format('Y-m-d H:i') }}"
        data-case-details="{{ $c->details ?? 'لا توجد تفاصيل إضافية' }}"
    >
        <td>{{ $c->uuid }}</td>
        <td>{{ $c->name }}</td>
        <td>{{ $c->phone }}</td>
        <td>{{ $c->case_type }}</td>

        <td>
            <span class="status-badge {{ $statusClass }}">
                {{ $statusText }}
            </span>
        </td>

        <td>{{ $c->created_at?->format('Y-m-d H:i') }}</td>

        <td>
            <a href="{{ route('admin.cases.show', $c->id) }}" class="action-btn">
                <i class="fas fa-eye"></i> عرض
            </a>

            <button class="action-btn quick-view-btn" style="background-color: var(--warning-color); margin-right: 5px;">
                <i class="fas fa-external-link-alt"></i> نظرة سريعة
            </button>

            <form method="POST" action="{{ route('admin.cases.destroy', $c->id) }}" class="delete-form" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit"
                        class="action-btn delete-btn"
                        onclick="return confirm('هل أنت متأكد من حذف القضية؟ لا يمكن التراجع عن هذا الإجراء.')">
                    <i class="fas fa-trash-alt"></i> حذف
                </button>
            </form>
        </td>
    </tr>
@endforeach

@if($cases->count() == 0)
<tr id="noResultsRow">
    <td colspan="7">
        <div class="empty-state">
            <i class="fas fa-inbox"></i>
            <h3>لا توجد طلبات</h3>
            <p>لم يتم العثور على أي طلبات قضايا تطابق معايير البحث.</p>
        </div>
    </td>
</tr>
@endif
</tbody>

            </table>
        </div>

        <div id="paginationContainer">
            {{ $cases->links() }}
        </div>
    </div>


    <div id="caseDetailsModal" class="case-details-modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3>تفاصيل القضية</h3>
                <button class="close-modal" id="closeModal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="detail-row">
                    <div class="detail-label">رقم الطلب:</div>
                    <div class="detail-value" id="modalCaseId">-</div>
                </div>
                <div class="detail-row">
                    <div class="detail-label">اسم العميل:</div>
                    <div class="detail-value" id="modalCaseName">-</div>
                </div>
                <div class="detail-row">
                    <div class="detail-label">رقم الجوال:</div>
                    <div class="detail-value" id="modalCasePhone">-</div>
                </div>
                <div class="detail-row">
                    <div class="detail-label">نوع القضية:</div>
                    <div class="detail-value" id="modalCaseType">-</div>
                </div>
                <div class="detail-row">
                    <div class="detail-label">حالة الطلب:</div>
                    <div class="detail-value">
                        <span class="status-badge" id="modalCaseStatus">-</span>
                    </div>
                </div>
                <div class="detail-row">
                    <div class="detail-label">تاريخ الإرسال:</div>
                    <div class="detail-value" id="modalCaseCreated">-</div>
                </div>
                <div class="detail-row">
                    <div class="detail-label">تفاصيل إضافية:</div>
                    <div class="detail-value" id="modalCaseDetails">-</div>
                </div>
                <div class="detail-row">
                    <div class="detail-label">الإجراءات:</div>
                    <div class="detail-value">
                        <a href="#" id="modalFullViewLink" class="action-btn">
                            <i class="fas fa-external-link-alt"></i> عرض الصفحة الكاملة
                        </a>
                        <button id="modalPrintBtn" class="action-btn" style="background-color: #7f8c8d; margin-right: 10px;">
                            <i class="fas fa-print"></i> طباعة
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/admin/index.js')}}"></script>
</body>
</html>
