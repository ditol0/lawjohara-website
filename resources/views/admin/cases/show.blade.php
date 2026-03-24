<!doctype html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>تفاصيل الطلب - {{ $case->uuid }}</title>
    <link rel="icon" type="image/x-icon" href="images/logo.png">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;500;600;700&display=swap" rel="stylesheet">


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <link rel="stylesheet" href="{{ asset('css/admin/show.css') }}">
</head>
<body>
    <div class="container">

        @if(session('success'))
            <div class="alert alert-success">
                <i class="fas fa-check-circle alert-icon"></i>
                <div>{{ session('success') }}</div>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-error">
                <i class="fas fa-exclamation-circle alert-icon"></i>
                <div>{{ session('error') }}</div>
            </div>
        @endif


        <div class="header">
            <div class="header-info">
                <div class="header-icon">
                    <i class="fas fa-gavel"></i>
                </div>
                <div class="header-text">
                    <h1>تفاصيل الطلب #{{ $case->uuid }}</h1>
                    <p>عرض وتعديل معلومات القضية المقدمة من العميل</p>
                </div>
            </div>
            <div class="header-actions">
                <a href="{{ route('admin.cases') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-right"></i> العودة للقائمة
                </a>
                <button onclick="window.print()" class="btn btn-print">
                    <i class="fas fa-print"></i> طباعة
                </button>
            </div>
        </div>


        <div class="content-grid">

            <div class="main-content">

                <div class="card">
                    <div class="card-header">
                        <i class="fas fa-user-circle"></i>
                        <h3>معلومات العميل</h3>
                    </div>
                    <div class="card-body">
                        <div class="client-info">
                            <div class="info-item">
                                <div class="info-label">
                                    <i class="fas fa-user"></i>
                                    الاسم الكامل
                                </div>
                                <div class="info-value">{{ $case->name }}</div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">
                                    <i class="fas fa-phone"></i>
                                    رقم الجوال
                                </div>
                                <div class="info-value">
                                    <a href="tel:{{ $case->phone }}" dir="ltr">{{ $case->phone }}</a>
                                </div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">
                                    <i class="fas fa-envelope"></i>
                                    البريد الإلكتروني
                                </div>
                                <div class="info-value">
                                    <a href="mailto:{{ $case->email }}">{{ $case->email }}</a>
                                </div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">
                                    <i class="fas fa-balance-scale"></i>
                                    نوع القضية
                                </div>
                                <div class="info-value">{{ $case->case_type }}</div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="case-details">
                    <h3><i class="fas fa-file-alt"></i> تفاصيل القضية</h3>
                    <div class="details-content">
                        {{ $case->details ?: 'لم يتم تقديم تفاصيل إضافية' }}
                    </div>
                </div>


                <div class="timeline">
                    <h3><i class="fas fa-history"></i> الخط الزمني للقضية</h3>

                    <div class="timeline-item">
                        <div class="timeline-content">
                            <div class="timeline-date">
                                <i class="fas fa-calendar"></i>
                                {{ $case->created_at->format('Y-m-d H:i') }}
                            </div>
                            <div class="timeline-text">
                                <strong>إنشاء الطلب:</strong> تم تقديم طلب القضية من قبل العميل
                            </div>
                        </div>
                    </div>

                    @if($case->updated_at != $case->created_at)
                    <div class="timeline-item">
                        <div class="timeline-content">
                            <div class="timeline-date">
                                <i class="fas fa-calendar"></i>
                                {{ $case->updated_at->format('Y-m-d H:i') }}
                            </div>
                            <div class="timeline-text">
                                <strong>آخر تحديث:</strong> تم تحديث حالة القضية إلى
                                @php
                                    $statusText = '';
                                    if($case->status == 'new') $statusText = 'جديد';
                                    elseif($case->status == 'in_progress') $statusText = 'قيد المعالجة';
                                    elseif($case->status == 'closed') $statusText = 'مغلق';
                                @endphp
                                <span class="status-badge
                                    @if($case->status == 'new') status-new
                                    @elseif($case->status == 'in_progress') status-in-progress
                                    @elseif($case->status == 'closed') status-closed
                                    @endif">
                                    {{ $statusText }}
                                </span>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>


            <div class="sidebar">

                <div class="card">
                    <div class="card-header">
                        <i class="fas fa-info-circle"></i>
                        <h3>حالة الطلب</h3>
                    </div>
                    <div class="card-body">
                        <div class="status-container">
                            <div class="current-status">
                                <div>
                                    <div class="info-label">الحالة الحالية</div>
                                    @php
                                        $statusText = '';
                                        $statusClass = '';
                                        if($case->status == 'new') {
                                            $statusText = 'جديد';
                                            $statusClass = 'status-new';
                                        } elseif($case->status == 'in_progress') {
                                            $statusText = 'قيد المعالجة';
                                            $statusClass = 'status-in-progress';
                                        } elseif($case->status == 'closed') {
                                            $statusText = 'مغلق';
                                            $statusClass = 'status-closed';
                                        }
                                    @endphp
                                    <div class="status-badge {{ $statusClass }}">
                                        <i class="fas fa-circle"></i> {{ $statusText }}
                                    </div>
                                </div>
                                <div class="info-item">
                                    <div class="info-label">رقم التعريف</div>
                                    <div class="info-value" style="font-size: 14px;">{{ $case->uuid }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="status-form">
                    <h3><i class="fas fa-edit"></i> تحديث الحالة</h3>
                    <form method="POST" action="{{ route('admin.cases.status', $case->id) }}" id="statusForm">
                        @csrf
                        <div class="form-group">
                            <label for="status">تغيير حالة الطلب</label>
                            <select name="status" id="status" class="form-select" required>
                                <option value="new" @selected($case->status=='new')>جديد</option>
                                <option value="in_progress" @selected($case->status=='in_progress')>قيد المعالجة</option>
                                <option value="closed" @selected($case->status=='closed')>مغلق</option>

                            </select>
                        </div>

                        <div class="form-group">
                            <label for="notes">ملاحظات (اختياري)</label>
                            <textarea name="notes" id="notes" class="form-select" rows="3" placeholder="أضف ملاحظات حول التحديث..."></textarea>
                        </div>

                        <button type="submit" class="btn-submit">
                            <i class="fas fa-save"></i> حفظ التغييرات
                        </button>
                    </form>
                </div>


                <div class="card">
                    <div class="card-header">
                        <i class="fas fa-calendar-alt"></i>
                        <h3>معلومات إضافية</h3>
                    </div>
                    <div class="card-body">
                        <div class="info-item">
                            <div class="info-label">
                                <i class="fas fa-calendar-plus"></i>
                                تاريخ الإنشاء
                            </div>
                            <div class="info-value">{{ $case->created_at->format('Y-m-d H:i') }}</div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">
                                <i class="fas fa-calendar-check"></i>
                                آخر تحديث
                            </div>
                            <div class="info-value">{{ $case->updated_at->format('Y-m-d H:i') }}</div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">
                                <i class="fas fa-clock"></i>
                                المدة المنقضية
                            </div>
                            <div class="info-value" id="duration">{{ $case->created_at->diffForHumans() }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

       
        <div class="footer-actions">
            <div class="footer-info">
                <p><i class="fas fa-info-circle"></i> تم فتح هذه القضية في {{ $case->created_at->format('Y-m-d') }}</p>
            </div>
            <div>
                <a href="{{ route('admin.cases') }}" class="btn btn-secondary">
                    <i class="fas fa-list"></i> عرض جميع الطلبات
                </a>
            </div>
        </div>
    </div>

   <script src="{{ asset('js/admin/show.js') }}"></script>
</body>
</html>
