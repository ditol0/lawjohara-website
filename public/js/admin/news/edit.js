
document.addEventListener('DOMContentLoaded', function() {
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

    const titleCounter = document.getElementById('titleCounter');
    const excerptCounter = document.getElementById('excerptCounter');

    const titleError = document.getElementById('titleError');
    const excerptError = document.getElementById('excerptError');
    const contentError = document.getElementById('contentError');
    const imageError = document.getElementById('imageError');

    updateCharCounter(titleInput, titleCounter, 200);
    updateCharCounter(excerptInput, excerptCounter, 500);

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

    fileInput.addEventListener('change', handleFileSelect);

    ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
        fileUploadContainer.addEventListener(eventName, preventDefaults, false);
    });

    function preventDefaults(e) { e.preventDefault(); e.stopPropagation(); }

    ['dragenter', 'dragover'].forEach(eventName => {
        fileUploadContainer.addEventListener(eventName, () => fileUploadContainer.classList.add('drag-over'), false);
    });

    ['dragleave', 'drop'].forEach(eventName => {
        fileUploadContainer.addEventListener(eventName, () => fileUploadContainer.classList.remove('drag-over'), false);
    });

    fileUploadContainer.addEventListener('drop', function(e) {
        const files = e.dataTransfer.files;
        if (files.length > 0) {
            fileInput.files = files;
            handleFileSelect();
        }
    }, false);

    function handleFileSelect() {
        const file = fileInput.files[0];
        if (!file) return;

        if (!file.type.match('image.*')) {
            showError(fileInput, imageError, 'يرجى اختيار صورة فقط');
            return;
        }

        if (file.size > 5 * 1024 * 1024) {
            showError(fileInput, imageError, 'حجم الصورة كبير جداً (الحد الأقصى 5 ميجابايت)');
            return;
        }

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

    removeFileBtn.addEventListener('click', function() {
        fileInput.value = '';
        filePreviewContainer.style.display = 'none';
        clearError(fileInput, imageError);
    });

    newsForm.addEventListener('submit', function(e) {
        let isValid = true;

        if (!titleInput.value.trim()) {
            showError(titleInput, titleError, 'يرجى إدخال عنوان للخبر');
            isValid = false;
        } else if (titleInput.value.trim().length < 5) {
            showError(titleInput, titleError, 'العنوان قصير جداً (5 أحرف على الأقل)');
            isValid = false;
        }

        if (!contentInput.value.trim()) {
            showError(contentInput, contentError, 'يرجى إدخال محتوى الخبر');
            isValid = false;
        } else if (contentInput.value.trim().length < 20) {
            showError(contentInput, contentError, 'المحتوى قصير جداً (20 حرفاً على الأقل)');
            isValid = false;
        }

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
            const firstError = document.querySelector('.error-message.show');
            if (firstError) {
                firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
            }
        }
    });

    function updateCharCounter(input, counterElement, maxLength) {
        const length = input.value.length;
        counterElement.textContent = `${length}/${maxLength}`;

        if (length > maxLength * 0.9) counterElement.className = 'char-counter danger';
        else if (length > maxLength * 0.7) counterElement.className = 'char-counter warning';
        else counterElement.className = 'char-counter';

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

    function formatFileSize(bytes) {
        if (bytes === 0) return '0 Bytes';
        const k = 1024;
        const sizes = ['Bytes', 'KB', 'MB', 'GB'];
        const i = Math.floor(Math.log(bytes) / Math.log(k));
        return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
    }
});
