        document.addEventListener('DOMContentLoaded', function() {
            // عناصر DOM
            const filterForm = document.getElementById('filterForm');
            const searchInput = document.querySelector('input[name="search"]');
            const statusSelect = document.querySelector('select[name="status"]');
            const sortSelect = document.querySelector('select[name="sort"]');
            const newsTableBody = document.getElementById('newsTableBody');
            const newsRows = document.querySelectorAll('#newsTableBody tr[data-news-id]');
            
            // إضافة التأكيد عند الحذف
            window.confirmDelete = function(event) {
                event.preventDefault();
                const form = event.target.closest('form');
                
                if (confirm('هل أنت متأكد من حذف هذا الخبر؟ هذا الإجراء لا يمكن التراجع عنه.')) {
                    form.submit();
                }
                
                return false;
            };
            
            // فلترة الجدول في الوقت الحقيقي (اختياري)
            function filterTable() {
                const searchTerm = searchInput.value.toLowerCase();
                const statusValue = statusSelect.value;
                
                let visibleRows = 0;
                
                newsRows.forEach(row => {
                    const title = row.querySelector('.news-title').textContent.toLowerCase();
                    const excerpt = row.querySelector('.news-excerpt') ? 
                        row.querySelector('.news-excerpt').textContent.toLowerCase() : '';
                    const statusBadge = row.querySelector('.status-badge');
                    const isPublished = statusBadge.classList.contains('status-published');
                    
                    // تطبيق عوامل التصفية
                    const matchesSearch = !searchTerm || 
                        title.includes(searchTerm) || 
                        excerpt.includes(searchTerm);
                    
                    const matchesStatus = !statusValue || 
                        (statusValue === 'published' && isPublished) ||
                        (statusValue === 'draft' && !isPublished);
                    
                    if (matchesSearch && matchesStatus) {
                        row.style.display = '';
                        visibleRows++;
                    } else {
                        row.style.display = 'none';
                    }
                });
                
                // إخفاء رسالة عدم وجود نتائج إذا كانت هناك نتائج
                const noResultsRow = document.getElementById('noResultsRow');
                if (noResultsRow) {
                    if (visibleRows === 0) {
                        noResultsRow.style.display = '';
                    } else {
                        noResultsRow.style.display = 'none';
                    }
                }
            }
            
            // إضافة فلترة في الوقت الحقيقي (اختياري)
            searchInput.addEventListener('keyup', function() {
                // يمكن تفعيل هذه الميزة إذا أردت فلترة في الوقت الحقيقي
                // filterTable();
            });
            
            statusSelect.addEventListener('change', function() {
                // يمكن تفعيل هذه الميزة إذا أردت فلترة في الوقت الحقيقي
                // filterTable();
            });
            
            // إضافة تأثيرات تفاعلية للصفوف
            newsRows.forEach(row => {
                row.addEventListener('mouseenter', function() {
                    this.style.backgroundColor = '#f0f7ff';
                });
                
                row.addEventListener('mouseleave', function() {
                    this.style.backgroundColor = '';
                });
            });
            
            // تحسين تجربة المستخدم على الهواتف
            if (window.innerWidth <= 768) {
                document.querySelectorAll('.action-btn').forEach(btn => {
                    const icon = btn.querySelector('i').className;
                    btn.innerHTML = `<i class="${icon}"></i>`;
                    btn.title = btn.textContent.trim();
                });
            }
            
            // تحديث الإحصائيات الديناميكية إذا لزم الأمر
            function updateStats() {
                // يمكن إضافة كود لتحديث الإحصائيات ديناميكياً
            }
            
            // تفعيل فلترة في الوقت الحقيقي مع تأخير للبحث
            let searchTimeout;
            searchInput.addEventListener('input', function() {
                clearTimeout(searchTimeout);
                searchTimeout = setTimeout(function() {
                    // إذا كنت تريد فلترة في الوقت الحقيقي بدون إرسال النموذج
                    // filterTable();
                }, 500);
            });
        });
