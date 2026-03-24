@extends('layout.main-shell-ar', [
    'title' => 'مكتب الجوهرة للمحاماة والاستشارات القانونية | التواصل',
    'description' => 'تواصل مع مكتب الجوهرة للمحاماة والاستشارات القانونية للحصول على استشارة قانونية متخصصة في السعودية.',
    'page' => 'contact',
    'bodyClass' => 'contact-page',
])

@push('head')
    <link rel="stylesheet" href="{{ asset('css/contact-page.css') }}?v={{ config('assets.version') }}">
@endpush

@section('content')
    <section class="contact-hero">
        <div class="container">
            <div class="contact-hero-content reveal">
                <span class="contact-hero-badge">تواصل مباشر واحترافي</span>
                <h1 class="contact-hero-title">اتصل بنا</h1>
                <p class="contact-hero-subtitle">نستقبل طلبات الاستشارات والقضايا ونعود لك بأسرع وقت ممكن عبر القنوات المناسبة.</p>
            </div>
        </div>
    </section>

    <section class="contact-section">
        <div class="container contact-container">
            <div class="section-header reveal">
                <span class="section-badge">التواصل</span>
                <h2 class="section-title">نحن هنا لخدمتك</h2>
                <p class="section-subtitle">أرسل تفاصيل طلبك وسنتواصل معك لمراجعة الحالة وتحديد أفضل خطوة قانونية.</p>
            </div>

            <div class="contact-content">
                <div class="contact-info">
                    <div class="contact-method reveal">
                        <div class="contact-icon"><i class="fas fa-phone"></i></div>
                        <div class="contact-details">
                            <h3>الهاتف</h3>
                            <p><a href="tel:+966533461460">533461460 966+ </a></p>
                        </div>
                    </div>

                    <div class="contact-method reveal">
                        <div class="contact-icon"><i class="fas fa-envelope"></i></div>
                        <div class="contact-details">
                            <h3>البريد الإلكتروني</h3>
                            <p><a href="mailto:info@aljawharalaw.com">info@aljawharalaw.com</a></p>
                        </div>
                    </div>

                    <div class="contact-method reveal">
                        <div class="contact-icon"><i class="fas fa-location-dot"></i></div>
                        <div class="contact-details">
                            <h3>الموقع</h3>
                            <p>الرياض - المملكة العربية السعودية</p>
                            <p>جده - المملكة العربية السعودية</p>
                            <p>الدمام - المملكة العربية السعودية</p>
                            <p>المدينة المنورة - المملكة العربية السعودية</p>
                        </div>
                    </div>
                </div>

                <div class="contact-form-container reveal">
                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-error">
                            <strong>يرجى مراجعة الحقول التالية:</strong>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('contact.store') }}" method="POST" class="contact-form" id="contactForm">
                        @csrf

                        <div class="form-row">
                            <div class="form-group">
                                <label class="form-label" for="name">الاسم</label>
                                <input id="name" name="name" type="text" class="form-input" value="{{ old('name') }}" required>
                                <div class="error-message" id="nameError"></div>
                            </div>

                            <div class="form-group">
                                <label class="form-label" for="phone">رقم الجوال</label>
                                <input id="phone" name="phone" type="text" class="form-input" value="{{ old('phone') }}" required>
                                <div class="error-message" id="phoneError"></div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label class="form-label" for="email">البريد الإلكتروني</label>
                                <input id="email" name="email" type="email" class="form-input" value="{{ old('email') }}">
                                <div class="error-message" id="emailError"></div>
                            </div>

                            <div class="form-group">
                                <label class="form-label" for="case_type">نوع القضية</label>
                                <select id="case_type" name="case_type" class="form-select" required>
                                    <option value="">اختر نوع القضية</option>
                                    <option value="تجارية" @selected(old('case_type') == 'تجارية')>تجارية</option>
                                    <option value="أحوال شخصية" @selected(old('case_type') == 'أحوال شخصية')>أحوال شخصية</option>
                                    <option value="جنائية" @selected(old('case_type') == 'جنائية')>جنائية</option>
                                    <option value="عقارية" @selected(old('case_type') == 'عقارية')>عقارية</option>
                                    <option value="اخرى" @selected(old('case_type') == 'اخرى')>أخرى</option>
                                </select>
                                <div class="error-message" id="case_typeError"></div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="details">تفاصيل القضية</label>
                            <textarea id="details" name="details" class="form-textarea" required>{{ old('details') }}</textarea>
                            <div class="error-message" id="detailsError"></div>
                        </div>

                        <input type="hidden" name="lang" value="ar">

                        <button type="submit" class="btn btn-primary" id="submitButton">
                            <i class="fas fa-paper-plane"></i>
                            إرسال الطلب
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
