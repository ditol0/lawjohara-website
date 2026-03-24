
        document.addEventListener('DOMContentLoaded', function() {
            // عناصر DOM
            const searchInput = document.getElementById('searchInput');
            const statusFilter = document.getElementById('statusFilter');
            const caseTypeFilter = document.getElementById('caseTypeFilter');
            const applyFilterBtn = document.getElementById('applyFilter');
            const resetFilterBtn = document.getElementById('resetFilter');
            const casesTableBody = document.getElementById('casesTableBody');
            const casesRows = document.querySelectorAll('#casesTableBody tr[data-case-id]');
            const noResultsRow = document.getElementById('noResultsRow');
            const quickViewButtons = document.querySelectorAll('.quick-view-btn');
            const caseDetailsModal = document.getElementById('caseDetailsModal');
            const closeModalBtn = document.getElementById('closeModal');
            const modalFullViewLink = document.getElementById('modalFullViewLink');
            const modalPrintBtn = document.getElementById('modalPrintBtn');

            const STATUS_LABELS = {
                new: 'جديد',
                in_progress: 'جاري العمل',
                closed: 'مغلقة',
                cancelled: 'ملغي'
            };

            function normalizeStatusFilterValue(value) {
                if (value === 'in-progress') return 'in_progress';
                if (value === 'completed') return 'closed';
                return value;
            }

            function getStatusClass(status) {
                if (status === 'new') return 'status-new';
                if (status === 'in_progress') return 'status-in-progress';
                if (status === 'closed') return 'status-completed';
                if (status === 'cancelled') return 'status-cancelled';
                return 'status-new';
            }

            function getNoResultsRow() {
                let row = document.getElementById('noResultsRow');
                if (row) return row;

                row = document.createElement('tr');
                row.id = 'noResultsRow';
                row.style.display = 'none';
                row.innerHTML = `
                    <td colspan="7">
                        <div class="empty-state">
                            <i class="fas fa-inbox"></i>
                            <h3>لا توجد نتائج</h3>
                            <p>لم يتم العثور على أي طلبات قضايا تطابق معايير البحث.</p>
                        </div>
                    </td>
                `;
                casesTableBody.appendChild(row);
                return row;
            }
            
            // إحصائيات
            const totalCasesEl = document.querySelector('.stat-content h3:first-child');
            const pendingCasesEl = document.querySelectorAll('.stat-content h3')[1];
            const completedCasesEl = document.querySelectorAll('.stat-content h3')[2];
            const cancelledCasesEl = document.querySelectorAll('.stat-content h3')[3];
            
            // تهيئة الإحصائيات
            function initializeStats() {
                let pending = 0, completed = 0, inProgress = 0;
                
                casesRows.forEach(row => {
                    const status = row.dataset.caseStatus;
                    if (status === 'new') pending++;
                    else if (status === 'in_progress') inProgress++;
                    else if (status === 'closed') completed++;
                });
                
                // إذا كنت تريد عرض الإحصائيات الحية (اختياري)
                // pendingCasesEl.textContent = pending;
                // completedCasesEl.textContent = completed;
                // cancelledCasesEl.textContent = cancelled;
            }
            
            // تصفية الجدول
            function filterTable() {
                const searchTerm = searchInput.value.toLowerCase();
                const statusValue = normalizeStatusFilterValue(statusFilter.value);
                const caseTypeValue = caseTypeFilter.value;
                const noResultsRow = getNoResultsRow();
                
                let visibleRows = 0;
                
                casesRows.forEach(row => {
                    const uuid = row.dataset.caseUuid.toLowerCase();
                    const name = row.dataset.caseName.toLowerCase();
                    const phone = row.dataset.casePhone;
                    const caseType = row.dataset.caseType;
                    const status = row.dataset.caseStatus;
                    
                    // تطبيق عوامل التصفية
                    const matchesSearch = !searchTerm || 
                        uuid.includes(searchTerm) || 
                        name.includes(searchTerm) || 
                        phone.includes(searchTerm);
                    
                    const matchesStatus = !statusValue || status === statusValue;
                    
                    const matchesCaseType = !caseTypeValue || caseType === caseTypeValue;
                    
                    if (matchesSearch && matchesStatus && matchesCaseType) {
                        row.style.display = '';
                        visibleRows++;
                    } else {
                        row.style.display = 'none';
                    }
                });
                
                // عرض رسالة إذا لم توجد نتائج
                if (visibleRows === 0) {
                    noResultsRow.style.display = '';
                } else {
                    noResultsRow.style.display = 'none';
                }
                
                // تحديث الإحصائيات بناءً على الصفوف المرئية (اختياري)
                // updateFilteredStats();
            }
            
            // تحديث الإحصائيات بعد التصفية (اختياري)
            function updateFilteredStats() {
                let pending = 0, completed = 0, inProgress = 0;
                
                casesRows.forEach(row => {
                    if (row.style.display !== 'none') {
                        const status = row.dataset.caseStatus;
                        if (status === 'new') pending++;
                        else if (status === 'in_progress') inProgress++;
                        else if (status === 'closed') completed++;
                    }
                });
                
                // إذا كنت تريد تحديث الإحصائيات ديناميكيًا
                // pendingCasesEl.textContent = pending;
                // completedCasesEl.textContent = completed;
                // cancelledCasesEl.textContent = cancelled;
                // totalCasesEl.textContent = pending + completed + cancelled + inProgress;
            }
            
            // فتح Modal لعرض التفاصيل
            function openCaseModal(caseRow) {
                const caseId = caseRow.dataset.caseId;
                const caseUuid = caseRow.dataset.caseUuid;
                const caseName = caseRow.dataset.caseName;
                const casePhone = caseRow.dataset.casePhone;
                const caseType = caseRow.dataset.caseType;
                const caseStatus = caseRow.dataset.caseStatus;
                const caseCreated = caseRow.dataset.caseCreated;
                const caseDetails = caseRow.dataset.caseDetails;
                
                // تعيين القيم في الـ Modal
                document.getElementById('modalCaseId').textContent = caseUuid;
                document.getElementById('modalCaseName').textContent = caseName;
                document.getElementById('modalCasePhone').textContent = casePhone;
                document.getElementById('modalCaseType').textContent = caseType;
                document.getElementById('modalCaseCreated').textContent = caseCreated;
                document.getElementById('modalCaseDetails').textContent = caseDetails;
                
                // تحديث حالة الطلب مع التنسيق المناسب
                const statusEl = document.getElementById('modalCaseStatus');
                statusEl.textContent = STATUS_LABELS[caseStatus] || caseStatus;
                
                // إزالة جميع classes السابقة
                statusEl.className = 'status-badge';
                
                // إضافة class بناءً على الحالة
                statusEl.classList.add(getStatusClass(caseStatus));
                
                // تحديث رابط العرض الكامل
                modalFullViewLink.href = `/admin/cases/${caseId}`;
                
                // عرض الـ Modal
                caseDetailsModal.style.display = 'flex';
            }
            
            // طباعة تفاصيل القضية
            function printCaseDetails() {
                const modalContent = document.querySelector('.modal-content').cloneNode(true);
                const printWindow = window.open('', '_blank');
                
                // إزالة أزرار الإجراءات من الطباعة
                const actionSection = modalContent.querySelector('.detail-row:last-child');
                if (actionSection) actionSection.remove();
                
                // إضافة تنسيق بسيط للطباعة
                printWindow.document.write(`
                    <!DOCTYPE html>
                    <html dir="rtl" lang="ar">
                    <head>
                        <meta charset="UTF-8">
                        <title>تفاصيل القضية - ${document.getElementById('modalCaseId').textContent}</title>
                        <style>
                            body { font-family: 'Cairo', sans-serif; padding: 20px; color: #333; }
                            h1 { color: #2c3e50; border-bottom: 2px solid #3498db; padding-bottom: 10px; }
                            .detail-row { margin-bottom: 15px; padding-bottom: 15px; border-bottom: 1px solid #eee; }
                            .detail-label { font-weight: bold; color: #2c3e50; display: inline-block; width: 150px; }
                            .detail-value { display: inline-block; }
                            .status-badge { padding: 5px 10px; border-radius: 15px; font-size: 14px; }
                            .status-new { background: #e3f2fd; color: #1565c0; }
                            @media print { 
                                body { font-size: 14px; }
                                .no-print { display: none; }
                            }
                        </style>
                    </head>
                    <body>
                        <h1>تفاصيل القضية</h1>
                        ${modalContent.innerHTML}
                        <div class="no-print" style="margin-top: 30px; font-size: 12px; color: #777; text-align: center;">
                            تم الطباعة في ${new Date().toLocaleString('ar-SA')}
                        </div>
                        <script>
                            window.onload = function() {
                                window.print();
                                setTimeout(function() {
                                    window.close();
                                }, 500);
                            }
                        <\/script>
                    </body>
                    </html>
                `);
                
                printWindow.document.close();
            }
            
            // إضافة Event Listeners
            applyFilterBtn.addEventListener('click', filterTable);
            resetFilterBtn.addEventListener('click', function() {
                searchInput.value = '';
                statusFilter.value = '';
                caseTypeFilter.value = '';
                filterTable();
                initializeStats(); // إعادة تعيين الإحصائيات
            });

            statusFilter.addEventListener('change', filterTable);
            caseTypeFilter.addEventListener('change', filterTable);
            searchInput.addEventListener('input', filterTable);
            
            searchInput.addEventListener('keyup', function(event) {
                if (event.key === 'Enter') {
                    filterTable();
                }
            });
            
            // إضافة Event Listeners لأزرار العرض السريع
            quickViewButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const caseRow = this.closest('tr');
                    openCaseModal(caseRow);
                });
            });
            
            // إغلاق Modal
            closeModalBtn.addEventListener('click', function() {
                caseDetailsModal.style.display = 'none';
            });
            
            // إغلاق Modal بالنقر خارج المحتوى
            caseDetailsModal.addEventListener('click', function(event) {
                if (event.target === caseDetailsModal) {
                    caseDetailsModal.style.display = 'none';
                }
            });
            
            // طباعة التفاصيل
            modalPrintBtn.addEventListener('click', printCaseDetails);
            
            // تهيئة الإحصائيات عند تحميل الصفحة
            initializeStats();
            
            // إضافة تأثيرات تفاعلية للصفوف
            casesRows.forEach(row => {
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
                    btn.innerHTML = '<i class="' + btn.querySelector('i').className + '"></i>';
                    btn.title = btn.textContent.trim();
                });
            }
        });
