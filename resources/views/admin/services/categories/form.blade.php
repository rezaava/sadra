@extends('admin.layout.master')

@section('title')
    {{ $pageTitle }} | پنل مدیریت
@endsection

@section('head')
    <style>
        .admin-content {
            padding: 30px;
        }

        .form-card {
            max-width: 900px;
            margin: auto;
            background: #fffdf8;
            border: 1px solid rgba(34, 32, 95, .08);
            border-radius: 26px;
            padding: 30px;
        }

        .title {
            color: #1a1740;
            font-size: 24px;
            font-weight: 800;
            margin-bottom: 25px;
        }

        .form-label {
            font-weight: 700;
            color: #1a1740;
            margin-bottom: 8px;
        }

        .form-control {
            border: 1px solid #ddd9e8;
            border-radius: 13px;
            padding: 12px 14px;
        }

        .form-control:focus {
            border-color: #423a9e;
            box-shadow: 0 0 0 3px rgba(66, 58, 158, .08);
        }

        textarea.form-control {
            min-height: 180px;
            resize: vertical;
            direction: ltr;
            text-align: left;
            font-family: monospace;
            line-height: 1.7;
        }

        .icon-preview-wrapper {
            margin-top: 15px;
        }

        .icon-preview-title {
            font-size: 13px;
            color: #77738e;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .icon-preview {
            width: 90px;
            height: 90px;
            border-radius: 18px;
            background: #eeeefa;
            color: #423a9e;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 18px;
            border: 1px solid #ddd9e8;
        }

        .icon-preview svg {
            width: 100%;
            height: 100%;
            display: block;
        }

        .preview-error {
            margin-top: 8px;
            color: #b54444;
            font-size: 12px;
            display: none;
        }

        .hint {
            margin-top: 8px;
            color: #77738e;
            font-size: 12px;
        }

        .actions {
            margin-top: 30px;
            display: flex;
            justify-content: space-between;
            gap: 10px;
        }

        .btn-main {
            border: 0;
            background: #2e2b7a;
            color: #fff;
            border-radius: 13px;
            padding: 13px 25px;
            font-weight: 700;
        }

        .btn-main:hover {
            background: #423a9e;
        }

        .btn-back {
            text-decoration: none;
            border: 1px solid #ddd9e8;
            color: #77738e;
            border-radius: 13px;
            padding: 12px 20px;
            font-weight: 700;
        }

        @media (max-width: 768px) {
            .admin-content {
                padding: 18px;
            }

            .form-card {
                padding: 20px;
            }

            .actions {
                flex-direction: column-reverse;
            }

            .btn-main,
            .btn-back {
                width: 100%;
                text-align: center;
            }
        }
    </style>
@endsection

@section('main')
    <div class="admin-content">

        <div class="form-card">

            <div class="title">
                {{ $pageTitle }}
            </div>

            <form
                action="{{ $category->exists
                    ? route('admin.service-categories.update', $category->id)
                    : route('admin.service-categories.store') }}"
                method="POST"
            >

                @csrf

                @if($category->exists)
                    @method('PUT')
                @endif

                <div class="mb-4">

                    <label class="form-label">
                        نام دسته‌بندی
                    </label>

                    <input
                        type="text"
                        name="name"
                        class="form-control"
                        value="{{ old('name', $category->name) }}"
                        placeholder="مثلاً طراحی و توسعه"
                    >

                    @error('name')
                        <div class="text-danger mt-2">
                            {{ $message }}
                        </div>
                    @enderror

                </div>

                <div class="mb-4">

                    <label class="form-label">
                        آیکن SVG
                    </label>

                    <textarea
                        name="icon"
                        id="iconInput"
                        class="form-control"
                        placeholder='<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
    ...
</svg>'
                    >{{ old('icon', $category->icon) }}</textarea>

                    <div class="hint">
                        کد کامل SVG را وارد کنید.
                    </div>

                    @error('icon')
                        <div class="text-danger mt-2">
                            {{ $message }}
                        </div>
                    @enderror

                    <div class="icon-preview-wrapper">

                        <div class="icon-preview-title">
                            پیش‌نمایش آیکن
                        </div>

                        <div
                            class="icon-preview"
                            id="iconPreview"
                        ></div>

                        <div
                            class="preview-error"
                            id="previewError"
                        >
                            کد SVG وارد شده معتبر نیست.
                        </div>

                    </div>

                </div>

                <div class="actions">

                    <a
                        href="{{ route('admin.service-categories.index') }}"
                        class="btn-back"
                    >
                        بازگشت
                    </a>

                    <button
                        type="submit"
                        class="btn-main"
                    >
                        <i class="bi bi-check-lg"></i>

                        {{ $category->exists
                            ? 'ذخیره تغییرات'
                            : 'ثبت دسته‌بندی' }}
                    </button>

                </div>

            </form>

        </div>

    </div>
@endsection

@section('js')
    <script>
        const iconInput = document.getElementById('iconInput');
        const iconPreview = document.getElementById('iconPreview');
        const previewError = document.getElementById('previewError');

        function updateIcon() {

            const svg = iconInput.value.trim();

            iconPreview.innerHTML = '';
            previewError.style.display = 'none';

            if (!svg) {
                return;
            }

            const parser = new DOMParser();

            const document = parser.parseFromString(
                svg,
                'image/svg+xml'
            );

            const parsedSvg = document.documentElement;

            if (
                parsedSvg.tagName.toLowerCase() !== 'svg' ||
                document.querySelector('parsererror')
            ) {
                previewError.style.display = 'block';
                return;
            }

            const svgElement = document.importNode(parsedSvg, true);

            iconPreview.appendChild(svgElement);
        }

        iconInput.addEventListener('input', updateIcon);

        updateIcon();
    </script>
@endsection