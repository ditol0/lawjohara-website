<?php

namespace App\Http\Controllers;

use App\Models\CaseRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class CaseRequestController extends Controller
{
    // عرض صفحة التواصل
    public function create()
    {
        return view('contact'); // resources/views/contact.blade.php
    }

    // حفظ الطلب مع حماية ضد السبام/السب
    public function store(Request $request)
{
    // تحديد اللغة القادمة من الفورم (ar/en)
    $lang = $request->input('lang', 'ar');
    $isEn = ($lang === 'en');

    /**
     * 1) Honeypot (مصيدة بوتات)
     * لو الحقل المخفي تعبى = بوت
     */
    if ($request->filled('website')) {
        abort(422);
    }

    /**
     * 2) Rate Limit بسيط (لكل IP)
     * 5 محاولات خلال 10 دقائق
     */
    $key = 'contact:' . $request->ip();

    if (\Illuminate\Support\Facades\RateLimiter::tooManyAttempts($key, 5)) {
        $seconds = \Illuminate\Support\Facades\RateLimiter::availableIn($key);

        throw \Illuminate\Validation\ValidationException::withMessages([
            'form' => $isEn
                ? "Too many submissions. Please try again in {$seconds} seconds."
                : "كثرة محاولات الإرسال. حاول بعد {$seconds} ثانية."
        ]);
    }

    \Illuminate\Support\Facades\RateLimiter::hit($key, 600); // 10 دقائق

    /**
     * 3) Validation + منع روابط/إيميلات داخل التفاصيل
     */
    $data = $request->validate([
        'name'      => ['required', 'string', 'max:255',
            // يمنع حشو روابط في الاسم
            'not_regex:/https?:\/\/|www\.|\.com|\.net|\.org|\.ru|\.xyz/i'
        ],
        'email'     => ['required', 'email', 'max:255'],
        'phone'     => ['required', 'string', 'max:20'],
        'case_type' => ['required', 'string', 'max:255'],
        'details'   => [
            'required', 'string', 'min:10', 'max:4000',
            // يمنع روابط
            'not_regex:/https?:\/\/|www\.|\.com|\.net|\.org|\.ru|\.xyz/i',
            // يمنع ايميلات داخل التفاصيل (غالبًا سبام)
            'not_regex:/[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,}/i',
        ],
        'lang'      => ['nullable', 'in:ar,en'],
        // honeypot field (اختياري للتأكد)
        'website'   => ['nullable', 'string', 'max:255'],
    ], [
        'details.not_regex' => $isEn
            ? 'Please write your case details without links, emails, or promotional content.'
            : 'فضلاً اكتب تفاصيل القضية بدون روابط أو بريد إلكتروني أو بيانات تسويقية.',
    ]);

    /**
     * 4) فلتر كلمات ممنوعة (سب/تسويق)
     */
    $badWords = [
        'seo', 'محركات البحث', 'تسويق', 'اعلان', 'إعلان', 'دعاية', 'تبرع',
        'تابعني', 'قناتي', 'واتساب تسويق', 'SEO',

        // سباب (حط اللي يناسب)
        'كس', 'قحبة', 'شرموط', 'كلب', 'حمار', 'خرا', 'لعين', 'يموت', 'يموتوا', 'يلعن', 'يلعنوا', 'حرامي',
        'نصاب', 'كذاب', 'فاسد', 'مدنس', 'خنزير', 'زبالة', 'قذر', 'وسخ', 'حقير', 'وضيع',
    ];

    $text = mb_strtolower($data['details'] ?? '');
    foreach ($badWords as $w) {
        if (mb_stripos($text, mb_strtolower($w)) !== false) {
            return back()
                ->withErrors([
                    'details' => $isEn
                        ? 'Your message contains disallowed content.'
                        : 'الرسالة تحتوي محتوى غير مسموح.'
                ])
                ->withInput();
        }
    }

    /**
     * 5) تنظيف بسيط للنص (يشيل مسافات زايدة)
     */
    $data['name']    = trim(preg_replace('/\s+/', ' ', $data['name']));
    $data['details'] = trim($data['details']);

    /**
     * 6) الحفظ
     */
    $data['status'] = 'new';

    // ما نحتاج نخزن lang/website في الداتابيس
    unset($data['lang'], $data['website']);

    \App\Models\CaseRequest::create($data);

    return back()->with('success', $isEn
        ? 'Your request has been sent successfully. We will contact you soon.'
        : 'تم إرسال طلبك بنجاح، سيتم التواصل معك قريبًا.'
    );
}

}