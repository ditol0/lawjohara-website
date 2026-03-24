<!doctype html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>لوحة الأدمن - تعديل خبر</title>
    <link rel="icon" type="image/x-icon" href="images/logo.png">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;500;600;700&display=swap" rel="stylesheet">


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <link rel="stylesheet" href="{{ asset('css/admin/news/edit.css') }}">
</head>
<body>
<div class="container">
    <a href="{{ route('admin.cases') }}" class="back-link">
        <i class="fas fa-arrow-right"></i> العودة إلى لوحة التحكم
    </a>

    <header>
        <div class="header-top">
            <h1><i class="fas fa-pen-to-square"></i> تعديل الخبر</h1>
            <div class="header-actions">
                <a href="{{ route('admin.news') }}" class="btn btn-secondary">
                    <i class="fas fa-list"></i> قائمة الأخبار
                </a>
            </div>
        </div>
        <p>قم بتعديل بيانات الخبر ثم احفظ التغييرات</p>
    </header>

    @if($errors->any())
        <div class="alert alert-danger">
            <i class="fas fa-exclamation-triangle"></i>
            <div>
                <strong>يرجى تصحيح الأخطاء التالية:</strong>
                <ul style="margin-top: 8px; margin-right: 20px;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

    @if(session('success'))
        <div class="alert alert-success">
            <i class="fas fa-check-circle"></i>
            <div>
                <strong>تم بنجاح!</strong>
                <p style="margin-top: 5px;">{{ session('success') }}</p>
            </div>
        </div>
    @endif


    <form method="POST" action="{{ route('admin.news.update', $news->id) }}" enctype="multipart/form-data" id="newsForm">
        @csrf
        @method('PUT')

        <div class="form-container">
            <h3><i class="fas fa-info-circle"></i> المعلومات الأساسية</h3>

            <div class="form-group">
                <label class="required">عنوان الخبر</label>
                <input type="text" name="title" class="form-control"
                       value="{{ old('title', $news->title) }}"
                       placeholder="أدخل عنوان الخبر" maxlength="200" required>
                <div class="char-counter" id="titleCounter">0/200</div>
                <div class="error-message" id="titleError"></div>
            </div>

            <div class="form-group">
                <label>ملخص الخبر (اختياري)</label>
                <textarea name="excerpt" class="form-control" rows="3"
                          placeholder="أدخل ملخصاً مختصراً للخبر" maxlength="500">{{ old('excerpt', $news->excerpt) }}</textarea>
                <div class="char-counter" id="excerptCounter">0/500</div>
                <div class="error-message" id="excerptError"></div>
            </div>

            <div class="form-group">
                <label class="required">محتوى الخبر</label>
                <textarea name="content" class="form-control" rows="8"
                          placeholder="أدخل محتوى الخبر الكامل" required>{{ old('content', $news->content) }}</textarea>
                <div class="error-message" id="contentError"></div>
            </div>
        </div>

        <div class="form-container">
            <h3><i class="fas fa-image"></i> صورة الخبر</h3>


            @if($news->cover_image)
                <div style="margin-bottom:15px;">
                    <p style="margin-bottom:8px;color:#666;">الصورة الحالية:</p>
                    <img src="{{ asset($news->cover_image) }}" alt="cover"
                         style="max-width:260px;border-radius:10px;border:1px solid #eee;">
                </div>
            @endif

            <div class="file-upload-container" id="fileUploadContainer">
                <label class="file-upload-label" for="cover_image">
                    <i class="fas fa-cloud-upload-alt"></i>
                    <div>
                        <span>اسحب وأسقط الصورة هنا أو</span>
                        <strong>انقر لاختيار صورة</strong>
                    </div>
                    <small>يُفضل صورة بحجم 1200×630 بكسل (JPG, PNG, WEBP)</small>
                </label>
                <input type="file" name="cover_image" id="cover_image" class="file-input" accept="image/*">
            </div>

            <div class="file-preview-container" id="filePreviewContainer">
                <div class="file-preview">
                    <img id="filePreview" src="" alt="معاينة الصورة">
                    <div class="file-info">
                        <h5 id="fileName">اسم الملف</h5>
                        <p id="fileSize">حجم الملف</p>
                    </div>
                    <button type="button" class="remove-file" id="removeFile">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>

            <div class="error-message" id="imageError"></div>
        </div>

        <div class="form-container">
            <h3><i class="fas fa-cog"></i> الإعدادات</h3>

            <div class="form-group">
                <div class="checkbox-group">
                    <input type="checkbox" name="is_published" id="is_published" value="1"
                           {{ old('is_published', $news->is_published ? '1' : '0') == '1' ? 'checked' : '' }}>
                    <label for="is_published">نشر الخبر</label>
                </div>
                <small style="color: #666; display: block; margin-top: 8px;">
                    إذا أزلت التحديد، سيتم حفظ الخبر كمسودة.
                </small>
            </div>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-success">
                <i class="fas fa-save"></i> حفظ التعديلات
            </button>


            <a href="{{ route('admin.news') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-right"></i> رجوع
            </a>

        
            <a href="{{ route('admin.news') }}" class="btn btn-danger">
                <i class="fas fa-times"></i> إلغاء
            </a>
        </div>
    </form>
</div>

<script src="{{ asset('js/admin/news/edit.js') }}"></script>

</body>
</html>
