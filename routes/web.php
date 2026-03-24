<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CaseRequestController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\Admin\CaseRequestAdminController;
use App\Http\Controllers\Admin\NewsAdminController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Response;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/register',function(){
    return view('admin.register');
})->name('admin.register');


Route::post('/register', [RegisterController::class, 'store'])->name('admin.register.submit');



// الصفحة الرئيسية
Route::get('/', function () {
    return view('mine');
})->name('mine');

Route::get('/en', function () {
    return view('en.mine');
})->name('en.mine');

Route::get('/en/contact', function () {
    return view('en.contact');
})->name('contact.en');

Route::get('/en/news', [NewsController::class, 'index-en'])->name('news.en');

Route::get('/en/news/{slug}', [NewsController::class, 'show'])
    ->name('news.show.en');



Route::get('/en/news', [NewsController::class, 'index'])->name('news.en');

// صفحة تواصل/إرسال قضية
Route::get('/contact', [CaseRequestController::class, 'create'])->name('contact');
Route::post('/contact', [CaseRequestController::class, 'store'])->name('contact.store');


// تسجيل دخول الأدمن
Route::get('/admin/login/cases/1425/1/25.exictmantec/', [AdminAuthController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login', [AdminAuthController::class, 'login'])->name('admin.login.submit');
Route::post('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');


// ===== أخبار الزوار (Public) =====
Route::get('/news', [NewsController::class, 'index'])->name('news');
Route::get('/news/{slug}', [NewsController::class, 'show'])->name('news.show');


// ===== لوحة الأدمن (Auth) =====
Route::middleware('auth')->group(function () {

    // القضايا
    Route::get('/admin/cases/1425/1/25.exictmantec/', [CaseRequestAdminController::class, 'index'])->name('admin.cases');
    Route::get('/admin/cases/{case}/admin/cases/1425/1/25.exictmantec/', [CaseRequestAdminController::class, 'show'])->name('admin.cases.show');
    Route::post('/admin/cases/{case}/status/admin/cases/1425/1/25.exictmantec/', [CaseRequestAdminController::class, 'updateStatus'])->name('admin.cases.status');

    // الأخبار (Admin CRUD)
    Route::get('/admin/news/admin/cases/1425/1/25.exictmantec/', [NewsAdminController::class, 'index'])->name('admin.news');
    Route::get('/admin/news/create/admin/cases/1425/1/25.exictmantec/', [NewsAdminController::class, 'create'])->name('admin.news.create');
    Route::post('/admin/news/admin/cases/1425/1/25.exictmantec/', [NewsAdminController::class, 'store'])->name('admin.news.store');

    Route::get('/admin/news/{news}/admin/cases/1425/1/25.exictmantec/', [NewsAdminController::class, 'show'])->name('admin.news.show');
    Route::get('/admin/news/{news}/edit/admin/cases/1425/1/25.exictmantec/', [NewsAdminController::class, 'edit'])->name('admin.news.edit');
    Route::put('/admin/news/{news}/admin/cases/1425/1/25.exictmantec/', [NewsAdminController::class, 'update'])->name('admin.news.update');
    Route::delete('/admin/news/{news}/admin/cases/1425/1/25.exictmantec/', [NewsAdminController::class, 'destroy'])->name('admin.news.destroy');
     Route::delete('/cases/{case}/admin/cases/1425/1/25.exictmantec/', [CaseRequestAdminController::class, 'destroy'])->name('admin.cases.destroy');
});

use App\Models\News;


Route::get('/sitemap.xml', function () {
    $news = News::where('is_published', 1)->get();

    return Response::make(
        view('sitemap', compact('news'))->render(),
        200,
        ['Content-Type' => 'application/xml']
    );
});

Route::fallback(function () {
    return response()->view('fallback', [], 404);
});

