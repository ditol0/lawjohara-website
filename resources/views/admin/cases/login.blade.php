<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>نظام إدارة القضايا - تسجيل الدخول</title>
    <link rel="icon" type="image/x-icon" href="images/logo.png">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">

    <link rel="stylesheet" href="{{ asset('css/admin/login.css') }}">
</head>
<body>

    <div class="background-animation">
        <div class="shape"></div>
        <div class="shape"></div>
        <div class="shape"></div>
        <div class="shape"></div>
    </div>

    <div class="login-container">

        <div class="login-side">
            <div class="logo">
                <div class="logo-icon">
                    <i class="fas fa-gavel"></i>
                </div>
                <div class="logo-text">
                    <h1>نظام إدارة القضايا</h1>
                    <p>لوحة تحكم إدارية متكاملة</p>
                </div>
            </div>

            <div class="side-content">
                <h2>مرحباً بعودتك!</h2>
                <p>سجل الدخول الآن للوصول إلى لوحة التحكم الإدارية لإدارة قضايا العملاء ومتابعة الطلبات.</p>

                <ul class="features">
                    <li>
                        <i class="fas fa-shield-alt"></i>
                        <span>نظام آمن وحماية متقدمة</span>
                    </li>
                    <li>
                        <i class="fas fa-chart-line"></i>
                        <span>إحصائيات وتقارير مفصلة</span>
                    </li>
                    <li>
                        <i class="fas fa-users-cog"></i>
                        <span>إدارة متكاملة للطلبات</span>
                    </li>
                    <li>
                        <i class="fas fa-bell"></i>
                        <span>إشعارات فورية للتحديثات</span>
                    </li>
                </ul>
            </div>
        </div>


        <div class="login-form-side">
            <div class="form-header">
                <h2>تسجيل الدخول</h2>
                <p>أدخل بياناتك للوصول إلى لوحة التحكم</p>
            </div>


            @if($errors->any())
                <div class="alert alert-error animate__animated animate__shakeX">
                    <i class="fas fa-exclamation-triangle alert-icon"></i>
                    <div>{{ $errors->first() }}</div>
                </div>
            @endif


            <form method="POST" action="{{ route('admin.login.submit') }}" class="login-form" id="loginForm">
                @csrf


                <div class="form-group">
                    <label for="email" class="form-label">
                        <i class="fas fa-envelope"></i>
                        البريد الإلكتروني
                    </label>
                    <div class="input-with-icon">
                        <input type="email"
                               name="email"
                               id="email"
                               class="form-input"
                               placeholder="أدخل بريدك الإلكتروني"
                               required
                               value="{{ old('email') }}">
                        <div class="input-icon">
                            <i class="fas fa-user"></i>
                        </div>
                    </div>
                    <div class="error-message" id="emailError"></div>
                </div>


                <div class="form-group">
                    <label for="password" class="form-label">
                        <i class="fas fa-lock"></i>
                        كلمة المرور
                    </label>
                    <div class="input-with-icon">
                        <input type="password"
                               name="password"
                               id="password"
                               class="form-input"
                               placeholder="أدخل كلمة المرور"
                               required>
                        <div class="input-icon">
                            <i class="fas fa-key"></i>
                        </div>
                        <button type="button" class="password-toggle" id="togglePassword">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                    <div class="error-message" id="passwordError"></div>
                </div>


                <div class="form-options">
                    <div class="remember-me" id="rememberMe">
                        <div class="remember-checkbox" id="rememberCheckbox">
                            <i class="fas fa-check" style="display: none;"></i>
                        </div>
                        <span class="remember-text">تذكر بيانات الدخول</span>
                        <input type="checkbox" name="remember" id="remember" style="display: none;">
                    </div>


                </div>


                <div class="security-notice">
                    <i class="fas fa-lock"></i>
                    <p>بيانات الدخول مشفرة وآمنة. تأكد من أنك تستخدم جهازك الشخصي.</p>
                </div>


                <button type="submit" class="btn-login pulse" id="loginButton">
                    <i class="fas fa-sign-in-alt"></i>
                    <span id="loginButtonText">دخول إلى لوحة التحكم</span>
                </button>
            </form>


            <div class="copyright">
                <p>الإصدار 2.1.0</p>
            </div>
        </div>
    </div>

   <script src="{{ asset('js/admin/login.js') }}"></script>
</body>
</html>
