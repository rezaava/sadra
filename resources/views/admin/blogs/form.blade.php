@extends('admin.layout.master')

@section('title')
    {{ $pageTitle }} | پنل مدیریت
@endsection

@section('head')

    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/jodit/build/jodit.min.css"
    >

    <style>
        .admin-content {
            padding: 32px;
        }

        .blog-form-page {
            max-width: 1250px;
            margin: 0 auto;
        }

        .page-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 24px;
        }

        .page-title {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .page-title-icon {
            width: 52px;
            height: 52px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 17px;
            background: linear-gradient(135deg, #2e2b7a, #423a9e);
            color: #fff;
            font-size: 22px;
            box-shadow: 0 10px 25px rgba(46, 43, 122, .18);
        }

        .page-title h4 {
            margin: 0;
            color: #1a1740;
            font-size: 20px;
            font-weight: 800;
        }

        .page-title p {
            margin: 5px 0 0;
            color: #858585;
            font-size: 13px;
        }

        .back-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 15px;
            border-radius: 13px;
            background: #fffdf8;
            border: 1px solid rgba(34, 32, 95, .1);
            color: #423a9e;
            text-decoration: none;
            font-size: 12px;
            font-weight: 700;
            transition: .2s ease;
        }

        .back-btn:hover {
            background: #f0effa;
            color: #423a9e;
        }

        .form-card {
            background: #fffdf8;
            border: 1px solid rgba(34, 32, 95, .1);
            border-radius: 26px;
            overflow: hidden;
            box-shadow: 0 12px 35px rgba(34, 32, 95, .06);
        }

        .form-card-head {
            padding: 22px 25px;
            border-bottom: 1px solid rgba(34, 32, 95, .08);
            background: rgba(247, 244, 238, .45);
        }

        .form-card-head h5 {
            margin: 0;
            color: #1a1740;
            font-size: 15px;
            font-weight: 800;
        }

        .form-card-head p {
            margin: 6px 0 0;
            color: #929292;
            font-size: 12px;
        }

        .form-body {
            padding: 28px;
        }

        .alert-errors {
            margin-bottom: 22px;
            padding: 15px 18px;
            border-radius: 14px;
            background: #fff0f0;
            border: 1px solid #ffd8d8;
            color: #a63e3e;
            font-size: 13px;
        }

        .alert-errors ul {
            margin: 8px 0 0;
            padding-right: 20px;
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group.full {
            grid-column: 1 / -1;
        }

        .form-label {
            display: block;
            margin-bottom: 8px;
            color: #38354d;
            font-size: 13px;
            font-weight: 800;
        }

        .required {
            color: #c34d4d;
        }

        .form-control-custom {
            width: 100%;
            padding: 12px 14px;
            border: 1px solid rgba(34, 32, 95, .12);
            border-radius: 12px;
            background: #fff;
            color: #37344c;
            font-family: inherit;
            font-size: 13px;
            outline: none;
            transition: .2s ease;
        }

        .form-control-custom:focus {
            border-color: #423a9e;
            box-shadow: 0 0 0 3px rgba(66, 58, 158, .08);
        }

        textarea.form-control-custom {
            min-height: 110px;
            resize: vertical;
            line-height: 1.9;
        }

        .icon-textarea {
            min-height: 180px !important;
            direction: ltr;
            text-align: left;
            font-family: monospace;
            font-size: 12px;
            line-height: 1.7;
        }

        .help-text {
            margin-top: 7px;
            color: #999;
            font-size: 11px;
        }

        .image-upload {
            position: relative;
            padding: 18px;
            border: 1px dashed rgba(66, 58, 158, .25);
            border-radius: 14px;
            background: #faf9ff;
        }

        .current-image {
            margin-bottom: 15px;
        }

        .current-image img {
            width: 180px;
            height: 110px;
            object-fit: cover;
            border-radius: 14px;
            border: 1px solid rgba(34, 32, 95, .1);
        }

        .file-input {
            width: 100%;
            font-size: 12px;
            color: #666;
        }

        .status-box {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
            padding: 15px 17px;
            border-radius: 14px;
            background: #faf9ff;
            border: 1px solid rgba(34, 32, 95, .08);
        }

        .status-info strong {
            display: block;
            color: #38354d;
            font-size: 13px;
        }

        .status-info span {
            display: block;
            margin-top: 4px;
            color: #999;
            font-size: 11px;
        }

        .switch {
            position: relative;
            width: 48px;
            height: 26px;
            flex: 0 0 48px;
        }

        .switch input {
            display: none;
        }

        .slider {
            position: absolute;
            inset: 0;
            border-radius: 30px;
            background: #d8d8d8;
            cursor: pointer;
            transition: .25s ease;
        }

        .slider::before {
            content: '';
            position: absolute;
            width: 20px;
            height: 20px;
            left: 3px;
            top: 3px;
            border-radius: 50%;
            background: #fff;
            transition: .25s ease;
            box-shadow: 0 2px 5px rgba(0, 0, 0, .15);
        }

        .switch input:checked + .slider {
            background: #423a9e;
        }

        .switch input:checked + .slider::before {
            transform: translateX(22px);
        }

        .form-actions {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 10px;
            margin-top: 25px;
            padding-top: 22px;
            border-top: 1px solid rgba(34, 32, 95, .08);
        }

        .btn-submit {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            min-width: 135px;
            padding: 12px 18px;
            border-radius: 12px;
            border: none;
            cursor: pointer;
            font-family: inherit;
            font-size: 13px;
            font-weight: 700;
            text-decoration: none;
            transition: .2s ease;
        }

        .btn-primary-custom {
            background: #2e2b7a;
            color: #fff;
            box-shadow: 0 8px 20px rgba(46, 43, 122, .16);
        }

        .btn-primary-custom:hover {
            background: #423a9e;
            color: #fff;
        }

        .btn-outline-custom {
            background: #f4f2ec;
            color: #5d5974;
        }

        .btn-outline-custom:hover {
            background: #eae7df;
            color: #38354d;
        }

        .jodit-container {
            border-radius: 13px !important;
            overflow: hidden;
            border-color: rgba(34, 32, 95, .12) !important;
        }

        @media (max-width: 768px) {
            .admin-content {
                padding: 18px;
            }

            .form-body {
                padding: 18px;
            }

            .form-grid {
                grid-template-columns: 1fr;
            }

            .form-group.full {
                grid-column: auto;
            }

            .page-title h4 {
                font-size: 17px;
            }

            .page-title-icon {
                width: 45px;
                height: 45px;
                border-radius: 14px;
            }

            .back-btn span {
                display: none;
            }

            .form-actions {
                flex-direction: column;
            }

            .btn-submit {
                width: 100%;
            }
        }
    </style>
@endsection

@section('main')

    <div class="admin-content">

        <div class="blog-form-page">

            <div class="page-top">

                <div class="page-title">

                    <div class="page-title-icon">
                        <i class="bi bi-journal-text"></i>
                    </div>

                    <div>
                        <h4>{{ $pageTitle }}</h4>
                        <p>اطلاعات بلاگ را وارد و ذخیره کنید</p>
                    </div>

                </div>

                <a
                    href="{{ route('admin.blogs.index') }}"
                    class="back-btn"
                >
                    <i class="bi bi-arrow-right"></i>
                    <span>بازگشت به لیست</span>
                </a>

            </div>

            <div class="form-card">

                <div class="form-card-head">

                    <h5>
                        <i class="bi bi-pencil-square"></i>
                        اطلاعات بلاگ
                    </h5>

                    <p>
                        فیلدهای ستاره‌دار الزامی هستند.
                    </p>

                </div>

                <div class="form-body">

                    @if($errors->any())

                        <div class="alert-errors">

                            <strong>
                                <i class="bi bi-exclamation-circle"></i>
                                لطفاً خطاهای زیر را برطرف کنید:
                            </strong>

                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>

                        </div>

                    @endif

                    <form
                        method="POST"
                        enctype="multipart/form-data"
                        action="{{ $blog->exists
                            ? route('admin.blogs.update', $blog)
                            : route('admin.blogs.store') }}"
                    >

                        @csrf

                        @if($blog->exists)
                            @method('PUT')
                        @endif

                        <div class="form-grid">

                            <div class="form-group">

                                <label class="form-label">
                                    عنوان بلاگ
                                    <span class="required">*</span>
                                </label>

                                <input
                                    type="text"
                                    name="title"
                                    class="form-control-custom"
                                    value="{{ old('title', $blog->title) }}"
                                    placeholder="مثلاً راهنمای انتخاب تجهیزات صنعتی"
                                    required
                                >

                            </div>

                            <div class="form-group">

                                <label class="form-label">
                                    تگ اصلی
                                    <span class="required">*</span>
                                </label>

                                <input
                                    type="text"
                                    name="main_tag"
                                    class="form-control-custom"
                                    value="{{ old('main_tag', $blog->main_tag) }}"
                                    placeholder="مثلاً تجهیزات صنعتی"
                                    required
                                >

                            </div>

                            <div class="form-group">

                                <label class="form-label">
                                    زمان مطالعه
                                    <span class="required">*</span>
                                </label>

                                <input
                                    type="text"
                                    name="reading_time"
                                    class="form-control-custom"
                                    value="{{ old('reading_time', $blog->reading_time) }}"
                                    placeholder="مثلاً ۵ دقیقه"
                                    required
                                >

                            </div>

                            <div class="form-group">

                                <label class="form-label">
                                    آیکن SVG
                                    <span class="required">*</span>
                                </label>

                                <textarea
                                    name="icon"
                                    class="form-control-custom icon-textarea"
                                    placeholder='<svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">...</svg>'
                                    required
                                >{{ old('icon', $blog->icon) }}</textarea>

                                <div class="help-text">
                                    تگ کامل SVG را وارد کنید. مثال:
                                    &lt;svg viewBox="0 0 24 24"&gt;...&lt;/svg&gt;
                                </div>

                            </div>

                            <div class="form-group">

                                <label class="form-label">
                                    تصویر اصلی
                                </label>

                                <div class="image-upload">

                                    @if($blog->exists && $blog->image)

                                        <div class="current-image">

                                            <img
                                                src="{{ asset($blog->image) }}"
                                                alt="{{ $blog->title }}"
                                            >

                                        </div>

                                    @endif

                                    <input
                                        type="file"
                                        name="image"
                                        class="file-input"
                                        accept="image/jpeg,image/png,image/jpg,image/webp"
                                    >

                                    <div class="help-text">
                                        فرمت‌های مجاز: JPG، PNG، WEBP — حداکثر ۵ مگابایت
                                    </div>

                                </div>

                            </div>

                            <div class="form-group full">

                                <label class="form-label">
                                    توضیح کوتاه
                                    <span class="required">*</span>
                                </label>

                                <textarea
                                    name="short_text"
                                    class="form-control-custom"
                                    placeholder="یک توضیح کوتاه برای نمایش در لیست بلاگ‌ها و کارت مقاله..."
                                    required
                                >{{ old('short_text', $blog->short_text) }}</textarea>

                            </div>

                            <div class="form-group full">

                                <label class="form-label">
                                    متن بلاگ
                                    <span class="required">*</span>
                                </label>

                                <textarea
                                    name="text"
                                    id="blogEditor"
                                >{{ old('text', $blog->text) }}</textarea>

                                <div class="help-text">
                                    <i class="bi bi-info-circle"></i>
                                    متن کامل مقاله را با استفاده از ویرایشگر وارد کنید.
                                </div>

                            </div>

                            <div class="form-group full">

                                <div class="status-box">

                                    <div class="status-info">

                                        <strong>
                                            وضعیت انتشار
                                        </strong>

                                        <span>
                                            در صورت فعال بودن، بلاگ در سایت نمایش داده می‌شود.
                                        </span>

                                    </div>

                                    <label class="switch">

                                        <input
                                            type="checkbox"
                                            name="is_active"
                                            value="1"
                                            {{ old('is_active', $blog->exists ? $blog->is_active : true) ? 'checked' : '' }}
                                        >

                                        <span class="slider"></span>

                                    </label>

                                </div>

                            </div>

                        </div>

                        <div class="form-actions">

                            <a
                                href="{{ route('admin.blogs.index') }}"
                                class="btn-submit btn-outline-custom"
                            >
                                <i class="bi bi-x-lg"></i>
                                انصراف
                            </a>

                            <button
                                type="submit"
                                class="btn-submit btn-primary-custom"
                            >
                                <i class="bi bi-check-lg"></i>
                                {{ $blog->exists ? 'ذخیره تغییرات' : 'ایجاد بلاگ' }}
                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

@endsection

@section('js')

    <script src="https://cdn.jsdelivr.net/npm/jodit/build/jodit.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {

            const editor = new Jodit('#blogEditor', {

                width: '100%',
                height: 500,

                direction: 'rtl',
                language: 'fa',

                defaultFont: 'Vazir, Tahoma, Arial, sans-serif',
                defaultFontSize: '14px',

                fonts: [
                    'Vazir',
                    'Tahoma',
                    'Arial',
                    'Courier New'
                ],

                buttons: [
                    'source',
                    '|',
                    'undo',
                    'redo',
                    '|',
                    'bold',
                    'italic',
                    'underline',
                    'strikethrough',
                    '|',
                    'font',
                    'fontsize',
                    'brush',
                    'paragraph',
                    '|',
                    'ul',
                    'ol',
                    'outdent',
                    'indent',
                    '|',
                    'align',
                    'hr',
                    'table',
                    '|',
                    'link',
                    'unlink',
                    '|',
                    'symbols',
                    'emoticons',
                    '|',
                    'print',
                    'fullsize',
                    'preview'
                ],

                colors: {
                    text: [
                        '#000000',
                        '#ff0000',
                        '#00ff00',
                        '#0000ff',
                        '#ff00ff',
                        '#00ffff'
                    ],
                    background: [
                        '#ffffff',
                        '#ffff00',
                        '#00ffff',
                        '#ffcc99'
                    ]
                }

            });

        });
    </script>

@endsection