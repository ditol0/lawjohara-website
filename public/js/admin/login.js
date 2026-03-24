
        document.addEventListener('DOMContentLoaded', function() {
            // عناصر DOM
            const loginForm = document.getElementById('loginForm');
            const emailInput = document.getElementById('email');
            const passwordInput = document.getElementById('password');
            const togglePassword = document.getElementById('togglePassword');
            const rememberMe = document.getElementById('rememberMe');
            const rememberCheckbox = document.getElementById('rememberCheckbox');
            const rememberInput = document.getElementById('remember');
            const forgotPassword = document.getElementById('forgotPassword');
            const loginButton = document.getElementById('loginButton');
            const loginButtonText = document.getElementById('loginButtonText');
            
            // تبين/إخفاء كلمة المرور
            togglePassword.addEventListener('click', function() {
                const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordInput.setAttribute('type', type);
                
                // تغيير الأيقونة
                const icon = this.querySelector('i');
                if (type === 'text') {
                    icon.className = 'fas fa-eye-slash';
                    this.title = 'إخفاء كلمة المرور';
                } else {
                    icon.className = 'fas fa-eye';
                    this.title = 'إظهار كلمة المرور';
                }
            });
            
            // تذكرني
            rememberMe.addEventListener('click', function() {
                const isChecked = rememberCheckbox.classList.contains('checked');
                
                if (isChecked) {
                    rememberCheckbox.classList.remove('checked');
                    rememberCheckbox.querySelector('i').style.display = 'none';
                    rememberInput.checked = false;
                } else {
                    rememberCheckbox.classList.add('checked');
                    rememberCheckbox.querySelector('i').style.display = 'block';
                    rememberInput.checked = true;
                }
            });
            
            // تحقق من تخزين بيانات الدخول السابقة
            function checkStoredCredentials() {
                const storedEmail = localStorage.getItem('admin_email');
                const storedRemember = localStorage.getItem('admin_remember');
                
                if (storedEmail && storedRemember === 'true') {
                    emailInput.value = storedEmail;
                    rememberCheckbox.classList.add('checked');
                    rememberCheckbox.querySelector('i').style.display = 'block';
                    rememberInput.checked = true;
                    passwordInput.focus();
                }
            }
            
            // استعادة البيانات المخزنة
            checkStoredCredentials();
            
            // التحقق من صحة الإيميل
            function validateEmail(email) {
                const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                return re.test(email);
            }
            
            // التحقق من صحة كلمة المرور
            function validatePassword(password) {
                return password.length >= 6;
            }
            
            // عرض خطأ
            function showError(input, message) {
                const errorElement = document.getElementById(input.id + 'Error');
                input.classList.add('error-input');
                errorElement.innerHTML = `<i class="fas fa-exclamation-circle"></i> ${message}`;
                errorElement.style.display = 'flex';
            }
            
            // إخفاء خطأ
            function hideError(input) {
                const errorElement = document.getElementById(input.id + 'Error');
                input.classList.remove('error-input');
                errorElement.style.display = 'none';
            }
            
            // التحقق من الحقول في الوقت الحقيقي
            emailInput.addEventListener('blur', function() {
                if (!this.value.trim()) {
                    showError(this, 'البريد الإلكتروني مطلوب');
                } else if (!validateEmail(this.value)) {
                    showError(this, 'يرجى إدخال بريد إلكتروني صحيح');
                } else {
                    hideError(this);
                }
            });
            
            passwordInput.addEventListener('blur', function() {
                if (!this.value.trim()) {
                    showError(this, 'كلمة المرور مطلوبة');
                } else if (!validatePassword(this.value)) {
                    showError(this, 'كلمة المرور يجب أن تكون 6 أحرف على الأقل');
                } else {
                    hideError(this);
                }
            });
            
            // إرسال النموذج
            loginForm.addEventListener('submit', function(e) {
                e.preventDefault();
                
                let isValid = true;
                
                // التحقق من الإيميل
                if (!emailInput.value.trim()) {
                    showError(emailInput, 'البريد الإلكتروني مطلوب');
                    isValid = false;
                } else if (!validateEmail(emailInput.value)) {
                    showError(emailInput, 'يرجى إدخال بريد إلكتروني صحيح');
                    isValid = false;
                }
                
                // التحقق من كلمة المرور
                if (!passwordInput.value.trim()) {
                    showError(passwordInput, 'كلمة المرور مطلوبة');
                    isValid = false;
                } else if (!validatePassword(passwordInput.value)) {
                    showError(passwordInput, 'كلمة المرور يجب أن تكون 6 أحرف على الأقل');
                    isValid = false;
                }
                
                if (isValid) {
                    // تغيير حالة زر الدخول
                    loginButton.disabled = true;
                    loginButtonText.textContent = 'جاري التحقق...';
                    
                    // حفظ بيانات الدخول إذا تم اختيار تذكرني
                    if (rememberInput.checked) {
                        localStorage.setItem('admin_email', emailInput.value);
                        localStorage.setItem('admin_remember', 'true');
                    } else {
                        localStorage.removeItem('admin_email');
                        localStorage.removeItem('admin_remember');
                    }
                    
                    // إرسال النموذج بعد تأخير بسيط للمحاكاة
                    setTimeout(() => {
                        loginForm.submit();
                    }, 1500);
                } else {
                    // تأثير اهتزاز للنموذج
                    loginForm.classList.add('animate__animated', 'animate__shakeX');
                    setTimeout(() => {
                        loginForm.classList.remove('animate__animated', 'animate__shakeX');
                    }, 1000);
                }
            });
            
            // نسيت كلمة المرور
            forgotPassword.addEventListener('click', function(e) {
                e.preventDefault();
                
                const email = prompt('الرجاء إدخال بريدك الإلكتروني لإعادة تعيين كلمة المرور:');
                
                if (email) {
                    if (validateEmail(email)) {
                        alert(`تم إرسال رابط إعادة تعيين كلمة المرور إلى ${email}\n\n(هذه ميزة تجريبية، في التطبيق الحقيقي سيتم إرسال بريد إلكتروني فعلي)`);
                        
                        // محاكاة إرسال البريد الإلكتروني
                        emailInput.value = email;
                        emailInput.focus();
                    } else {
                        alert('البريد الإلكتروني غير صالح. الرجاء المحاولة مرة أخرى.');
                    }
                }
            });
            
            // تأثيرات إضافية عند التركيز على الحقول
            const formInputs = document.querySelectorAll('.form-input');
            formInputs.forEach(input => {
                input.addEventListener('focus', function() {
                    this.parentElement.style.transform = 'translateY(-2px)';
                    this.parentElement.style.transition = 'transform 0.3s ease';
                });
                
                input.addEventListener('blur', function() {
                    this.parentElement.style.transform = 'translateY(0)';
                });
            });
            
            // تحسين تجربة المستخدم على الهواتف
            if (window.innerWidth <= 768) {
                // إضافة تأثيرات اللمس
                loginButton.addEventListener('touchstart', function() {
                    this.style.transform = 'scale(0.98)';
                });
                
                loginButton.addEventListener('touchend', function() {
                    this.style.transform = '';
                });
            }
            
            // تركيز على حقل الإيميل عند تحميل الصفحة
            if (!emailInput.value) {
                emailInput.focus();
            }
        });
 