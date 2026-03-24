
        document.addEventListener('DOMContentLoaded', function() {
            // تحديث المدة المنقضية تلقائياً
            function updateDuration() {
                const createdAt = new Date("{{ $case->created_at->format('Y-m-d H:i:s') }}");
                const now = new Date();
                const diffMs = now - createdAt;
                
                const days = Math.floor(diffMs / (1000 * 60 * 60 * 24));
                const hours = Math.floor((diffMs % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                const minutes = Math.floor((diffMs % (1000 * 60 * 60)) / (1000 * 60));
                
                let durationText = '';
                if (days > 0) {
                    durationText = `${days} يوم و ${hours} ساعة`;
                } else if (hours > 0) {
                    durationText = `${hours} ساعة و ${minutes} دقيقة`;
                } else {
                    durationText = `${minutes} دقيقة`;
                }
                
                document.getElementById('duration').textContent = durationText;
            }
            
            // تحديث المدة كل دقيقة
            updateDuration();
            setInterval(updateDuration, 60000);
            
            // تأكيد تحديث الحالة
            const statusForm = document.getElementById('statusForm');
            statusForm.addEventListener('submit', function(e) {
                const currentStatus = "{{ $case->status }}";
                const selectedStatus = document.getElementById('status').value;
                
                if (currentStatus === selectedStatus) {
                    e.preventDefault();
                    alert('لم تقم بتغيير حالة الطلب. الرجاء اختيار حالة مختلفة.');
                    return false;
                }
                
                // عرض رسالة تأكيد
                const statusText = document.querySelector(`#status option[value="${selectedStatus}"]`).textContent;
                const confirmed = confirm(`هل أنت متأكد من تغيير حالة الطلب إلى "${statusText}"؟`);
                
                if (!confirmed) {
                    e.preventDefault();
                    return false;
                }
                
                // إضافة مؤشر تحميل
                const submitBtn = statusForm.querySelector('.btn-submit');
                const originalText = submitBtn.innerHTML;
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> جاري الحفظ...';
                submitBtn.disabled = true;
                
                // استعادة النص الأصلي بعد 5 ثواني (في حالة وجود خطأ)
                setTimeout(() => {
                    submitBtn.innerHTML = originalText;
                    submitBtn.disabled = false;
                }, 5000);
            });
            
            // إضافة تأثيرات تفاعلية
            const infoItems = document.querySelectorAll('.info-item');
            infoItems.forEach(item => {
                item.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateX(-5px)';
                    this.style.transition = 'transform 0.3s ease';
                });
                
                item.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateX(0)';
                });
            });
            
            // إضافة إمكانية نسخ رقم الطلب بالنقر
            const caseIdElement = document.querySelector('.header-text h1');
            caseIdElement.addEventListener('click', function() {
                const caseId = "{{ $case->uuid }}";
                navigator.clipboard.writeText(caseId).then(() => {
                    // عرض رسالة مؤقتة
                    const originalText = this.textContent;
                    this.textContent = '✓ تم نسخ رقم الطلب!';
                    this.style.color = '#27ae60';
                    
                    setTimeout(() => {
                        this.textContent = originalText;
                        this.style.color = '';
                    }, 2000);
                });
            });
            
            // تمييز رقم الجوال والبريد الإلكتروني
            const phoneLink = document.querySelector('a[href^="tel:"]');
            const emailLink = document.querySelector('a[href^="mailto:"]');
            
            if (phoneLink) {
                phoneLink.addEventListener('click', function(e) {
                    e.stopPropagation();
                });
            }
            
            if (emailLink) {
                emailLink.addEventListener('click', function(e) {
                    e.stopPropagation();
                });
            }
            
            // تحسين تجربة الطباعة
            const printBtn = document.querySelector('.btn-print');
            printBtn.addEventListener('click', function() {
                // إضافة رسالة قبل الطباعة
                const originalTitle = document.title;
                document.title = `تفاصيل الطلب - {{ $case->uuid }}`;
                
                // بعد إغلاق نافذة الطباعة
                window.onafterprint = function() {
                    document.title = originalTitle;
                };
            });
        });
    