
        document.addEventListener('DOMContentLoaded', function() {
            // عناصر DOM
            const newsForm = document.getElementById('newsForm');
            const titleInput = document.querySelector('input[name="title"]');
            const excerptInput = document.querySelector('textarea[name="excerpt"]');
            const contentInput = document.querySelector('textarea[name="content"]');
            const fileInput = document.getElementById('cover_image');
            const fileUploadContainer = document.getElementById('fileUploadContainer');
            const filePreviewContainer = document.getElementById('filePreviewContainer');
            const filePreview = document.getElementById('filePreview');
            const fileName = document.getElementById('fileName');
            const fileSize = document.getElementById('fileSize');
            const removeFileBtn = document.getElementById('removeFile');
            const resetFormBtn = document.getElementById('resetForm');
            const isPublishedCheckbox = document.getElementById('is_published');
            
            // عدادات الأحرف
            const titleCounter = document.getElementById('titleCounter');
            const excerptCounter = document.getElementById('excerptCounter');
            
            // رسائل الخطأ
            const titleError = document.getElementById('titleError');
            const excerptError = document.getElementById('excerptError');
            const contentError = document.getElementById('contentError');
            const imageError = document.getElementById('imageError');
            
            // تهيئة عدادات الأحرف
            updateCharCounter(titleInput, titleCounter, 200);
            updateCharCounter(excerptInput, excerptCounter, 500);
            
            // تحديث عدادات الأحرف في الوقت الحقيقي
            titleInput.addEventListener('input', function() {
                updateCharCounter(this, titleCounter, 200);
                clearError(this, titleError);
            });
            
            excerptInput.addEventListener('input', function() {
                updateCharCounter(this, excerptCounter, 500);
                clearError(this, excerptError);
            });
            
            contentInput.addEventListener('input', function() {
                clearError(this, contentError);
            });
            
            // تحميل الملف و drag & drop
            fileInput.addEventListener('change', handleFileSelect);
            
            // Drag & drop events
            ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
                fileUploadContainer.addEventListener(eventName, preventDefaults, false);
            });
            
            function preventDefaults(e) {
                e.preventDefault();
                e.stopPropagation();
            }
            
            ['dragenter', 'dragover'].forEach(eventName => {
                fileUploadContainer.addEventListener(eventName, highlight, false);
            });
            
            ['dragleave', 'drop'].forEach(eventName => {
                fileUploadContainer.addEventListener(eventName, unhighlight, false);
            });
            
            function highlight() {
                fileUploadContainer.classList.add('drag-over');
            }
            
            function unhighlight() {
                fileUploadContainer.classList.remove('drag-over');
            }
            
            fileUploadContainer.addEventListener('drop', handleDrop, false);
            
            function handleDrop(e) {
                const dt = e.dataTransfer;
                const files = dt.files;
                if (files.length > 0) {
                    fileInput.files = files;
                    handleFileSelect();
                }
            }
            
            function handleFileSelect() {
                const file = fileInput.files[0];
                if (file) {
                    // التحقق من نوع الملف
                    if (!file.type.match('image.*')) {
                        showError(fileInput, imageError, 'يرجى اختيار صورة فقط');
                        return;
                    }
                    
                    // التحقق من حجم الملف (5MB كحد أقصى)
                    if (file.size > 5 * 1024 * 1024) {
                        showError(fileInput, imageError, 'حجم الصورة كبير جداً (الحد الأقصى 5 ميجابايت)');
                        return;
                    }
                    
                    // عرض معاينة الصورة
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        filePreview.src = e.target.result;
                        fileName.textContent = file.name;
                        fileSize.textContent = formatFileSize(file.size);
                        filePreviewContainer.style.display = 'block';
                        clearError(fileInput, imageError);
                    };
                    reader.readAsDataURL(file);
                }
            }
            
            // إزالة الصورة المختارة
            removeFileBtn.addEventListener('click', function() {
                fileInput.value = '';
                filePreviewContainer.style.display = 'none';
                clearError(fileInput, imageError);
            });
            
            // إعادة تعيين النموذج
            resetFormBtn.addEventListener('click', function() {
                if (confirm('هل أنت متأكد من مسح جميع البيانات المدخلة؟')) {
                    newsForm.reset();
                    filePreviewContainer.style.display = 'none';
                    updateCharCounter(titleInput, titleCounter, 200);
                    updateCharCounter(excerptInput, excerptCounter, 500);
                    clearAllErrors();
                    isPublishedCheckbox.checked = true;
                }
            });
            
            // التحقق من النموذج قبل الإرسال
            newsForm.addEventListener('submit', function(e) {
                let isValid = true;
                
                // التحقق من العنوان
                if (!titleInput.value.trim()) {
                    showError(titleInput, titleError, 'يرجى إدخال عنوان للخبر');
                    isValid = false;
                } else if (titleInput.value.trim().length < 5) {
                    showError(titleInput, titleError, 'العنوان قصير جداً (5 أحرف على الأقل)');
                    isValid = false;
                }
                
                // التحقق من المحتوى
                if (!contentInput.value.trim()) {
                    showError(contentInput, contentError, 'يرجى إدخال محتوى الخبر');
                    isValid = false;
                } else if (contentInput.value.trim().length < 20) {
                    showError(contentInput, contentError, 'المحتوى قصير جداً (20 حرفاً على الأقل)');
                    isValid = false;
                }
                
                // التحقق من الملف إذا تم تحميله
                if (fileInput.files.length > 0) {
                    const file = fileInput.files[0];
                    if (!file.type.match('image.*')) {
                        showError(fileInput, imageError, 'يرجى اختيار صورة فقط');
                        isValid = false;
                    } else if (file.size > 5 * 1024 * 1024) {
                        showError(fileInput, imageError, 'حجم الصورة كبير جداً (الحد الأقصى 5 ميجابايت)');
                        isValid = false;
                    }
                }
                
                if (!isValid) {
                    e.preventDefault();
                    // التمرير إلى أول خطأ
                    const firstError = document.querySelector('.error-message.show');
                    if (firstError) {
                        firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
                        const input = firstError.previousElementSibling;
                        if (input) input.focus();
                    }
                }
            });
            
            // وظائف مساعدة
            function updateCharCounter(input, counterElement, maxLength) {
                const length = input.value.length;
                counterElement.textContent = `${length}/${maxLength}`;
                
                // تغيير اللون حسب الطول
                if (length > maxLength * 0.9) {
                    counterElement.className = 'char-counter danger';
                } else if (length > maxLength * 0.7) {
                    counterElement.className = 'char-counter warning';
                } else {
                    counterElement.className = 'char-counter';
                }
                
                // قص النص إذا تجاوز الحد
                if (length > maxLength) {
                    input.value = input.value.substring(0, maxLength);
                    updateCharCounter(input, counterElement, maxLength);
                }
            }
            
            function showError(input, errorElement, message) {
                input.classList.add('error');
                errorElement.textContent = message;
                errorElement.classList.add('show');
            }
            
            function clearError(input, errorElement) {
                input.classList.remove('error');
                errorElement.classList.remove('show');
            }
            
            function clearAllErrors() {
                [titleInput, excerptInput, contentInput, fileInput].forEach(input => {
                    input.classList.remove('error');
                });
                [titleError, excerptError, contentError, imageError].forEach(error => {
                    error.classList.remove('show');
                });
            }
            
            function formatFileSize(bytes) {
                if (bytes === 0) return '0 Bytes';
                const k = 1024;
                const sizes = ['Bytes', 'KB', 'MB', 'GB'];
                const i = Math.floor(Math.log(bytes) / Math.log(k));
                return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
            }
            
            // إضافة تأثيرات تفاعلية للعناصر
            const formControls = document.querySelectorAll('.form-control');
            formControls.forEach(control => {
                control.addEventListener('focus', function() {
                    this.parentElement.style.transform = 'translateY(-2px)';
                });
                
                control.addEventListener('blur', function() {
                    this.parentElement.style.transform = 'translateY(0)';
                });
            });
            
            // تعبئة تلقائية للبيانات القديمة إذا كانت موجودة
            const oldCoverImage = "{{ old('cover_image_preview') }}";
            if (oldCoverImage) {
                filePreview.src = oldCoverImage;
                fileName.textContent = "صورة محملة مسبقاً";
                fileSize.textContent = "---";
                filePreviewContainer.style.display = 'block';
            }
        });
   