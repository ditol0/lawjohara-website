<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuthController extends Controller
{
    // عرض صفحة تسجيل الدخول
    public function showLogin()
    {
        // لأن ملف الدخول عندك داخل admin/cases
        return view('admin.cases.login');
    }

    // تنفيذ تسجيل الدخول
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {

            // تأكد أنه أدمن
            if (!auth()->user()->is_admin) {
                Auth::logout();

                return back()->withErrors([
                    'email' => 'غير مصرح لك بالدخول'
                ]);
            }

            // تجديد الجلسة للحماية
            $request->session()->regenerate();

            // تحويل للوحة القضايا
            return redirect()->route('admin.cases');
        }

        return back()->withErrors([
            'email' => 'بيانات الدخول غير صحيحة'
        ]);
    }

    // تسجيل الخروج
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }
}
