@extends('admin.layout.master')

@section('title')
    صدراکو | تجهیزات صنعتی آشپزخانه
@endsection

@section('head')
    <link rel="stylesheet" href="{{ asset('asset/css/admin/index.css') }}">
@endsection

@section('main')
    <div class="admin-content">
        <div class="dashboard-header">
            <div>
                <h1>داشبورد مدیریت</h1>
                <p>نمای کلی وضعیت وب‌سایت صدراکو</p>
            </div>

            <div class="dashboard-date">
                <i class="bi bi-calendar3"></i>
                {{ now()->format('Y/m/d') }}
            </div>
        </div>
        <div class="row g-4 mb-4">

            <div class="col-xl-4 col-md-6">
                <div class="stat-card">
                    <div class="stat-icon products-icon">
                        <i class="bi bi-box-seam"></i>
                    </div>

                    <div class="stat-content">
                        <div class="stat-label">تعداد محصولات</div>
                        <div class="stat-number">
                            {{ number_format($productsCount) }}
                        </div>

                        <a href="{{ route('admin.products.index') }}" class="stat-link">
                            مشاهده محصولات
                            <i class="bi bi-arrow-left"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 col-md-6">
                <div class="stat-card">
                    <div class="stat-icon blogs-icon">
                        <i class="bi bi-journal-text"></i>
                    </div>

                    <div class="stat-content">
                        <div class="stat-label">تعداد بلاگ‌ها</div>
                        <div class="stat-number">
                            {{ number_format($blogsCount) }}
                        </div>

                        <a href="{{ route('admin.blogs.index') }}" class="stat-link">
                            مشاهده بلاگ‌ها
                            <i class="bi bi-arrow-left"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 col-md-6">
                <div class="stat-card">
                    <div class="stat-icon services-icon">
                        <i class="bi bi-grid-1x2"></i>
                    </div>

                    <div class="stat-content">
                        <div class="stat-label">تعداد خدمات</div>
                        <div class="stat-number">
                            {{ number_format($servicesCount) }}
                        </div>

                        <a href="{{ route('admin.services.index') }}" class="stat-link">
                            مشاهده خدمات
                            <i class="bi bi-arrow-left"></i>
                        </a>
                    </div>
                </div>
            </div>

        </div>
        <div class="row g-4 mb-4">
            <div class="col-xl-3 col-md-6">
                <a href="{{ route('admin.requests.join') }}" class="request-card">
                    <div class="request-card-top">
                        <div class="request-icon">
                            <i class="bi bi-person-plus"></i>
                        </div>

                        <span class="request-arrow">
                            <i class="bi bi-arrow-left"></i>
                        </span>
                    </div>

                    <div class="request-title">
                        درخواست همکاری
                    </div>

                    <div class="request-number">
                        {{ number_format($joinRequestsCount) }}
                    </div>

                    <div class="request-description">
                        درخواست ثبت‌شده برای همکاری با مجموعه
                    </div>
                </a>
            </div>
            <div class="col-xl-3 col-md-6">
                <a href="{{ route('admin.requests.quote') }}" class="request-card">
                    <div class="request-card-top">
                        <div class="request-icon">
                            <i class="bi bi-calculator"></i>
                        </div>

                        <span class="request-arrow">
                            <i class="bi bi-arrow-left"></i>
                        </span>
                    </div>

                    <div class="request-title">
                        درخواست استعلام قیمت
                    </div>

                    <div class="request-number">
                        {{ number_format($quoteRequestsCount) }}
                    </div>

                    <div class="request-description">
                        درخواست‌های ثبت‌شده برای استعلام قیمت
                    </div>
                </a>
            </div>
            <div class="col-xl-3 col-md-6">
                <a href="{{ route('admin.requests.representative') }}" class="request-card">
                    <div class="request-card-top">
                        <div class="request-icon">
                            <i class="bi bi-building"></i>
                        </div>

                        <span class="request-arrow">
                            <i class="bi bi-arrow-left"></i>
                        </span>
                    </div>

                    <div class="request-title">
                        درخواست نمایندگی
                    </div>

                    <div class="request-number">
                        {{ number_format($representativeRequestsCount) }}
                    </div>

                    <div class="request-description">
                        درخواست‌های ثبت‌شده برای دریافت نمایندگی
                    </div>
                </a>
            </div>
            <div class="col-xl-3 col-md-6">
                <a href="{{ route('admin.requests.portfolio') }}" class="request-card">

                    <div class="request-card-top">

                        <div class="request-icon">
                            <i class="bi bi-briefcase"></i>
                        </div>

                        <span class="request-arrow">
                            <i class="bi bi-arrow-left"></i>
                        </span>

                    </div>

                    <div class="request-title">
                        ارسال نمونه‌کار
                    </div>

                    <div class="request-number">
                        {{ number_format($portfolioRequestsCount) }}
                    </div>

                    <div class="request-description">
                        نمونه‌کارهای ارسال‌شده توسط کاربران
                    </div>

                </a>
            </div>
        </div>
        <div class="dashboard-panel video-panel mb-4">

            <div class="panel-header">
                <div>
                    <h3>ویدیوی اصلی سایت</h3>
                    <span>فقط یک ویدیو می‌تواند در سیستم ذخیره شود</span>
                </div>

                <span
                    class="video-status"
                    id="videoStatus"
                    style="{{ $adminVideo ? '' : 'display:none;' }}"
                >
                    <i class="bi bi-check-circle-fill"></i>
                    ویدیو ثبت شده
                </span>
            </div>

            <div class="video-manager">

                {{-- پیام --}}
                <div
                    id="videoMessage"
                    class="video-message"
                    style="display:none;"
                ></div>


                {{-- آپلود جدید --}}
                <div
                    class="video-upload-area"
                    id="videoUploadArea"
                    style="{{ $adminVideo ? 'display:none;' : '' }}"
                >

                    <div class="video-upload-icon">
                        <i class="bi bi-cloud-arrow-up"></i>
                    </div>

                    <h4>ویدیوی اصلی را آپلود کنید</h4>

                    <p>
                        فرمت‌های MP4، WEBM، MOV و AVI
                        <br>
                        حداکثر حجم 100 مگابایت
                    </p>

                    <form
                        id="videoUploadForm"
                        action="{{ route('admin.video.upload') }}"
                        method="POST"
                        enctype="multipart/form-data"
                    >

                        @csrf

                        <label
                            for="videoInput"
                            class="video-select-btn"
                        >
                            <i class="bi bi-upload"></i>
                            انتخاب ویدیو
                        </label>

                        <input
                            type="file"
                            name="video"
                            id="videoInput"
                            accept=".mp4,.webm,.mov,.avi"
                            hidden
                        >

                        <div
                            id="selectedVideoName"
                            class="selected-video-name"
                        ></div>

                        <div
                            id="newVideoPreview"
                            class="new-video-preview"
                            style="display:none;"
                        >
                            <video
                                id="previewVideo"
                                controls
                                style="max-width:100%;"
                            ></video>
                        </div>

                        <div
                            id="uploadProgressBox"
                            style="display:none;"
                        >
                            <div class="upload-progress-info">
                                <span>در حال آپلود...</span>
                                <strong id="uploadProgressText">0%</strong>
                            </div>

                            <div class="upload-progress">
                                <div
                                    id="uploadProgressBar"
                                    class="upload-progress-bar"
                                    style="width:0%;"
                                ></div>
                            </div>
                        </div>

                        <button
                            type="submit"
                            id="uploadVideoBtn"
                            class="video-submit-btn"
                            style="display:none;"
                        >
                            <i class="bi bi-cloud-upload"></i>
                            ذخیره ویدیو
                        </button>

                    </form>

                </div>


                {{-- ویدیوی ذخیره شده --}}
                <div
                    id="savedVideoArea"
                    style="{{ $adminVideo ? '' : 'display:none;' }}"
                >

                    <div class="video-preview-box">

                        <video
                            id="savedVideo"
                            controls
                            preload="metadata"
                        >
                            @if($adminVideo)
                                <source
                                    src="{{ asset($adminVideo->video) }}"
                                    type="video/{{ pathinfo($adminVideo->video, PATHINFO_EXTENSION) }}"
                                >
                            @endif

                            مرورگر شما از پخش ویدیو پشتیبانی نمی‌کند.
                        </video>

                    </div>


                    <div class="video-info">

                        <div class="video-file-info">

                            <div class="video-file-icon">
                                <i class="bi bi-file-earmark-play"></i>
                            </div>

                            <div>
                                <strong>ویدیوی فعلی</strong>

                                <span id="savedVideoName">
                                    {{ $adminVideo ? basename($adminVideo->video) : '' }}
                                </span>
                            </div>

                        </div>


                        <div class="video-actions">

                            <form
                                id="videoReplaceForm"
                                action="{{ route('admin.video.upload') }}"
                                method="POST"
                                enctype="multipart/form-data"
                            >

                                @csrf

                                <label
                                    for="videoReplace"
                                    class="video-upload-btn"
                                >
                                    <i class="bi bi-arrow-repeat"></i>
                                    جایگزین کردن ویدیو
                                </label>

                                <input
                                    type="file"
                                    name="video"
                                    id="videoReplace"
                                    accept=".mp4,.webm,.mov,.avi"
                                    hidden
                                >

                            </form>


                            <button
                                type="button"
                                id="deleteVideoBtn"
                                class="video-delete-btn"
                            >
                                <i class="bi bi-trash3"></i>
                                حذف ویدیو
                            </button>

                        </div>

                    </div>

                </div>

            </div>

        </div>
        <div class="row g-4">

            <div class="col-xl-7">
                <div class="dashboard-panel">

                    <div class="panel-header">
                        <div>
                            <h3>آخرین درخواست‌های همکاری</h3>
                            <span>آخرین درخواست‌های ثبت‌شده</span>
                        </div>

                        <a href="{{ route('admin.requests.join') }}">
                            مشاهده همه
                            <i class="bi bi-arrow-left"></i>
                        </a>
                    </div>

                    <div class="request-list">

                        @forelse($latestJoinRequests as $request)
                            <div class="request-list-item">

                                <div class="list-avatar">
                                    <i class="bi bi-person"></i>
                                </div>

                                <div class="list-info">
                                    <strong>
                                        {{ $request->name ?? 'بدون نام' }}
                                    </strong>

                                    <span>
                                        {{ $request->email ?? ($request->phone ?? 'اطلاعات تماس ثبت نشده') }}
                                    </span>
                                </div>

                                <div class="list-date">
                                    {{ $request->created_at?->format('Y/m/d') }}
                                </div>

                            </div>

                        @empty

                            <div class="empty-state">
                                <i class="bi bi-inbox"></i>
                                <span>درخواستی ثبت نشده است.</span>
                            </div>
                        @endforelse

                    </div>

                </div>
            </div>

            <div class="col-xl-5">
                <div class="dashboard-panel">

                    <div class="panel-header">
                        <div>
                            <h3>دسترسی سریع</h3>
                            <span>مدیریت بخش‌های اصلی سایت</span>
                        </div>
                    </div>

                    <div class="quick-actions">

                        <a href="{{ route('admin.products.create') }}" class="quick-action">
                            <div class="quick-icon">
                                <i class="bi bi-plus-lg"></i>
                            </div>

                            <div>
                                <strong>افزودن محصول</strong>
                                <span>ثبت محصول جدید</span>
                            </div>

                            <i class="bi bi-chevron-left"></i>
                        </a>

                        <a href="{{ route('admin.blogs.create') }}" class="quick-action">
                            <div class="quick-icon">
                                <i class="bi bi-plus-lg"></i>
                            </div>

                            <div>
                                <strong>افزودن بلاگ</strong>
                                <span>انتشار مطلب جدید</span>
                            </div>

                            <i class="bi bi-chevron-left"></i>
                        </a>

                        <a href="{{ route('admin.services.create') }}" class="quick-action">
                            <div class="quick-icon">
                                <i class="bi bi-plus-lg"></i>
                            </div>

                            <div>
                                <strong>افزودن خدمت</strong>
                                <span>ثبت خدمت جدید</span>
                            </div>

                            <i class="bi bi-chevron-left"></i>
                        </a>

                        <a href="{{ route('admin.service-categories.create') }}" class="quick-action">
                            <div class="quick-icon">
                                <i class="bi bi-plus-lg"></i>
                            </div>

                            <div>
                                <strong>افزودن دسته‌بندی خدمت</strong>
                                <span>ایجاد دسته‌بندی جدید</span>
                            </div>

                            <i class="bi bi-chevron-left"></i>
                        </a>

                    </div>

                </div>
            </div>

        </div>
    </div>
@endsection

@section('js')
<script>
document.addEventListener('DOMContentLoaded', function () {

    const uploadForm = document.getElementById('videoUploadForm');
    const replaceForm = document.getElementById('videoReplaceForm');

    const videoInput = document.getElementById('videoInput');
    const videoReplace = document.getElementById('videoReplace');

    const previewVideo = document.getElementById('previewVideo');
    const newVideoPreview = document.getElementById('newVideoPreview');

    const selectedVideoName = document.getElementById('selectedVideoName');

    const uploadVideoBtn = document.getElementById('uploadVideoBtn');

    const uploadProgressBox = document.getElementById('uploadProgressBox');
    const uploadProgressBar = document.getElementById('uploadProgressBar');
    const uploadProgressText = document.getElementById('uploadProgressText');

    const savedVideoArea = document.getElementById('savedVideoArea');
    const savedVideo = document.getElementById('savedVideo');
    const savedVideoName = document.getElementById('savedVideoName');

    const videoUploadArea = document.getElementById('videoUploadArea');
    const videoStatus = document.getElementById('videoStatus');

    const deleteVideoBtn = document.getElementById('deleteVideoBtn');

    const messageBox = document.getElementById('videoMessage');


    function showMessage(message, type = 'success') {

        messageBox.textContent = message;

        messageBox.className = 'video-message ' + type;

        messageBox.style.display = 'block';

        setTimeout(function () {
            messageBox.style.display = 'none';
        }, 5000);
    }


    function formatFileSize(bytes) {

        if (bytes < 1024) {
            return bytes + ' B';
        }

        if (bytes < 1024 * 1024) {
            return (bytes / 1024).toFixed(1) + ' KB';
        }

        return (bytes / (1024 * 1024)).toFixed(1) + ' MB';
    }


    function validateVideo(file) {

        if (!file) {
            showMessage('لطفاً یک ویدیو انتخاب کنید.', 'error');
            return false;
        }

        const allowedTypes = [
            'video/mp4',
            'video/webm',
            'video/quicktime',
            'video/x-msvideo'
        ];

        const allowedExtensions = [
            'mp4',
            'webm',
            'mov',
            'avi'
        ];

        const extension = file.name
            .split('.')
            .pop()
            .toLowerCase();

        if (
            !allowedTypes.includes(file.type) &&
            !allowedExtensions.includes(extension)
        ) {
            showMessage(
                'فرمت ویدیو باید MP4، WEBM، MOV یا AVI باشد.',
                'error'
            );

            return false;
        }

        if (file.size > 100 * 1024 * 1024) {
            showMessage(
                'حجم ویدیو نباید بیشتر از 100 مگابایت باشد.',
                'error'
            );

            return false;
        }

        return true;
    }


    function updateSavedVideo(video) {

        savedVideoArea.style.display = 'block';

        videoUploadArea.style.display = 'none';

        videoStatus.style.display = 'inline-flex';

        savedVideo.innerHTML = '';

        const source = document.createElement('source');

        source.src = video.url;

        source.type = 'video/' + video.path.split('.').pop();

        savedVideo.appendChild(source);

        savedVideo.load();

        savedVideoName.textContent = video.name;
    }


    function resetUpload() {

        if (uploadForm) {
            uploadForm.reset();
        }

        selectedVideoName.textContent = '';

        newVideoPreview.style.display = 'none';

        previewVideo.removeAttribute('src');

        uploadVideoBtn.style.display = 'none';

        uploadProgressBox.style.display = 'none';

        uploadProgressBar.style.width = '0%';

        uploadProgressText.textContent = '0%';
    }


    function uploadVideo(form, file) {

        if (!validateVideo(file)) {
            return;
        }

        const formData = new FormData();

        formData.append('video', file);

        const csrfToken = document.querySelector(
            'meta[name="csrf-token"]'
        )?.getAttribute('content');


        const xhr = new XMLHttpRequest();

        xhr.open('POST', form.action, true);

        if (csrfToken) {
            xhr.setRequestHeader('X-CSRF-TOKEN', csrfToken);
        }

        xhr.setRequestHeader(
            'Accept',
            'application/json'
        );


        uploadProgressBox.style.display = 'block';

        uploadProgressBar.style.width = '0%';

        uploadProgressText.textContent = '0%';

        uploadVideoBtn.disabled = true;

        uploadVideoBtn.innerHTML =
            '<i class="bi bi-hourglass-split"></i> در حال آپلود...';


        xhr.upload.addEventListener('progress', function (event) {

            if (!event.lengthComputable) {
                return;
            }

            const percent = Math.round(
                (event.loaded / event.total) * 100
            );

            uploadProgressBar.style.width = percent + '%';

            uploadProgressText.textContent =
                percent + '%';
        });


        xhr.onload = function () {

            uploadVideoBtn.disabled = false;

            uploadVideoBtn.innerHTML =
                '<i class="bi bi-cloud-upload"></i> ذخیره ویدیو';


            let response = null;

            try {
                response = JSON.parse(xhr.responseText);
            } catch (error) {
                showMessage(
                    'پاسخ نامعتبر از سرور دریافت شد.',
                    'error'
                );

                return;
            }


            if (
                xhr.status >= 200 &&
                xhr.status < 300 &&
                response.success
            ) {

                uploadProgressBar.style.width = '100%';

                uploadProgressText.textContent = '100%';

                updateSavedVideo(response.video);

                resetUpload();

                showMessage(
                    response.message,
                    'success'
                );

            } else {

                let errorMessage =
                    response.message ||
                    'آپلود ویدیو انجام نشد.';

                if (response.errors) {

                    const firstError = Object.values(
                        response.errors
                    )[0];

                    if (firstError && firstError.length) {
                        errorMessage = firstError[0];
                    }
                }

                showMessage(
                    errorMessage,
                    'error'
                );
            }
        };


        xhr.onerror = function () {

            uploadVideoBtn.disabled = false;

            uploadVideoBtn.innerHTML =
                '<i class="bi bi-cloud-upload"></i> ذخیره ویدیو';

            showMessage(
                'ارتباط با سرور برقرار نشد.',
                'error'
            );
        };


        xhr.send(formData);
    }


    /*
    |--------------------------------------------------------------------------
    | انتخاب ویدیو برای آپلود اولیه
    |--------------------------------------------------------------------------
    */

    videoInput?.addEventListener('change', function () {

        const file = this.files[0];

        if (!file) {
            return;
        }

        if (!validateVideo(file)) {
            this.value = '';
            return;
        }

        selectedVideoName.textContent =
            file.name + ' — ' + formatFileSize(file.size);

        const url = URL.createObjectURL(file);

        previewVideo.src = url;

        newVideoPreview.style.display = 'block';

        uploadVideoBtn.style.display = 'inline-flex';

        previewVideo.load();
    });


    /*
    |--------------------------------------------------------------------------
    | آپلود اولیه
    |--------------------------------------------------------------------------
    */

    uploadForm?.addEventListener('submit', function (event) {

        event.preventDefault();

        const file = videoInput.files[0];

        uploadVideo(this, file);
    });


    /*
    |--------------------------------------------------------------------------
    | انتخاب ویدیوی جایگزین
    |--------------------------------------------------------------------------
    */

    videoReplace?.addEventListener('change', function () {

        const file = this.files[0];

        if (!file) {
            return;
        }

        if (!validateVideo(file)) {
            this.value = '';
            return;
        }

        uploadVideo(
            replaceForm,
            file
        );
    });


    /*
    |--------------------------------------------------------------------------
    | حذف ویدیو
    |--------------------------------------------------------------------------
    */

    deleteVideoBtn?.addEventListener('click', function () {

        if (!confirm('آیا از حذف ویدیو مطمئن هستید؟')) {
            return;
        }

        deleteVideoBtn.disabled = true;

        deleteVideoBtn.innerHTML =
            '<i class="bi bi-hourglass-split"></i> در حال حذف...';


        const xhr = new XMLHttpRequest();

        xhr.open(
            'POST',
            '{{ route('admin.video.delete') }}',
            true
        );


        const csrfToken = document.querySelector(
            'meta[name="csrf-token"]'
        )?.getAttribute('content');


        if (csrfToken) {
            xhr.setRequestHeader(
                'X-CSRF-TOKEN',
                csrfToken
            );
        }

        xhr.setRequestHeader(
            'Accept',
            'application/json'
        );


        const formData = new FormData();

        formData.append(
            '_token',
            csrfToken
        );

        formData.append(
            '_method',
            'DELETE'
        );


        xhr.onload = function () {

            deleteVideoBtn.disabled = false;

            deleteVideoBtn.innerHTML =
                '<i class="bi bi-trash3"></i> حذف ویدیو';


            let response = null;

            try {
                response = JSON.parse(
                    xhr.responseText
                );
            } catch (error) {

                showMessage(
                    'پاسخ نامعتبر از سرور دریافت شد.',
                    'error'
                );

                return;
            }


            if (
                xhr.status >= 200 &&
                xhr.status < 300 &&
                response.success
            ) {

                savedVideo.pause();

                savedVideo.removeAttribute('src');

                savedVideo.innerHTML = '';

                savedVideo.load();

                savedVideoArea.style.display = 'none';

                videoUploadArea.style.display = 'block';

                videoStatus.style.display = 'none';

                showMessage(
                    response.message,
                    'success'
                );

            } else {

                showMessage(
                    response.message ||
                    'حذف ویدیو انجام نشد.',
                    'error'
                );
            }
        };


        xhr.onerror = function () {

            deleteVideoBtn.disabled = false;

            deleteVideoBtn.innerHTML =
                '<i class="bi bi-trash3"></i> حذف ویدیو';

            showMessage(
                'ارتباط با سرور برقرار نشد.',
                'error'
            );
        };


        xhr.send(formData);
    });

});
</script>
@endsection