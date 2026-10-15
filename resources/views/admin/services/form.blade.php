@extends('admin.layout.master')

@section('title')
    {{ $pageTitle }} | پنل مدیریت
@endsection

@section('head')
    <style>
        .admin-content {
            padding: 32px;
        }

        .form-card {
            max-width: 1400px;
            margin: 0 auto;
            background: #fffdf8;
            border: 1px solid rgba(46, 43, 122, .08);
            border-radius: 30px;
            padding: 34px;
            box-shadow: 0 20px 60px rgba(46, 43, 122, .07);
        }

        .page-title {
            display: flex;
            align-items: center;
            gap: 16px;
            margin-bottom: 34px;
        }

        .page-title-icon {
            width: 58px;
            height: 58px;
            flex-shrink: 0;
            border-radius: 18px;
            background: linear-gradient(135deg, #2e2b7a, #504bb0);
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            box-shadow: 0 12px 25px rgba(46, 43, 122, .18);
        }

        .page-title h1 {
            margin: 0;
            color: #1a1740;
            font-size: 25px;
            font-weight: 900;
        }

        .page-title p {
            margin: 5px 0 0;
            color: #858198;
            font-size: 13px;
        }

        .section {
            margin-top: 38px;
            padding-top: 30px;
            border-top: 1px solid #eeeaf2;
        }

        .section:first-of-type {
            margin-top: 0;
            padding-top: 0;
            border-top: 0;
        }

        .section-heading {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 22px;
        }

        .section-heading-icon {
            width: 38px;
            height: 38px;
            border-radius: 12px;
            background: #f0effb;
            color: #423a9e;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .section-title {
            color: #2e2b7a;
            font-size: 18px;
            font-weight: 900;
            margin: 0;
        }

        .section-description {
            color: #8b879d;
            font-size: 12px;
            margin: 3px 0 0;
        }

        .form-label {
            color: #242044;
            font-weight: 800;
            font-size: 13px;
            margin-bottom: 9px;
        }

        .form-control,
        .form-select {
            min-height: 48px;
            border: 1px solid #dfdbe9;
            border-radius: 14px;
            padding: 11px 14px;
            background: #fff;
            color: #292542;
            transition: .2s ease;
        }

        .form-control:hover,
        .form-select:hover {
            border-color: #c7c2dc;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #423a9e;
            box-shadow: 0 0 0 4px rgba(66, 58, 158, .08);
        }

        textarea.form-control {
            min-height: 135px;
            resize: vertical;
        }

        .icon-field {
            position: relative;
        }

        .icon-textarea {
            min-height: 175px !important;
            direction: ltr;
            text-align: left;
            font-family: "JetBrains Mono", "Fira Code", monospace;
            font-size: 12px;
            line-height: 1.7;
            background: #17152d;
            color: #e9e7ff;
            border: 1px solid #29254c;
            border-radius: 16px;
            padding: 16px;
        }

        .icon-textarea::placeholder {
            color: #777296;
        }

        .icon-textarea:focus {
            background: #17152d;
            color: #f4f2ff;
            border-color: #665fc0;
            box-shadow: 0 0 0 4px rgba(66, 58, 158, .10);
        }

        .icon-preview-wrapper {
            margin-top: 12px;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .icon-preview {
            width: 72px;
            height: 72px;
            flex-shrink: 0;
            border: 1px solid #e3dfec;
            border-radius: 17px;
            background:
                linear-gradient(45deg, #f6f4fb 25%, transparent 25%),
                linear-gradient(-45deg, #f6f4fb 25%, transparent 25%),
                linear-gradient(45deg, transparent 75%, #f6f4fb 75%),
                linear-gradient(-45deg, transparent 75%, #f6f4fb 75%);
            background-size: 14px 14px;
            background-position: 0 0, 0 7px, 7px -7px, -7px 0;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 14px;
            overflow: hidden;
        }

        .icon-preview > div {
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .icon-preview svg {
            width: 100%;
            height: 100%;
            display: block;
        }

        .preview-info {
            color: #77738e;
            font-size: 12px;
        }

        .preview-info strong {
            display: block;
            color: #423a9e;
            margin-bottom: 3px;
        }

        .preview-error {
            color: #b54444;
            font-size: 12px;
            margin-top: 8px;
            display: none;
        }

        .stats-box {
            background: #faf8f3;
            border: 1px solid #ebe6dc;
            border-radius: 18px;
            padding: 15px;
        }

        .stats-box .form-label {
            display: flex;
            align-items: center;
            gap: 7px;
        }

        .stats-box .form-label i {
            color: #423a9e;
        }

        .stats-input {
            text-align: center;
            font-size: 18px;
            font-weight: 800;
        }

        .item-card {
            position: relative;
            background: #faf9f5;
            border: 1px solid #e7e2d9;
            border-radius: 23px;
            padding: 24px;
            margin-bottom: 18px;
            transition: .25s ease;
        }

        .item-card:hover {
            border-color: #d6d1e3;
            box-shadow: 0 12px 35px rgba(46, 43, 122, .06);
        }

        .item-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 22px;
            padding-bottom: 15px;
            border-bottom: 1px solid #ebe7df;
        }

        .item-heading {
            display: flex;
            align-items: center;
            gap: 11px;
        }

        .item-number {
            width: 35px;
            height: 35px;
            border-radius: 11px;
            background: #2e2b7a;
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 13px;
            font-weight: 800;
        }

        .item-title {
            color: #1a1740;
            font-weight: 900;
            font-size: 15px;
        }

        .remove-item {
            border: 0;
            width: 39px;
            height: 39px;
            border-radius: 11px;
            background: #fff0f0;
            color: #b54444;
            cursor: pointer;
            transition: .2s ease;
        }

        .remove-item:hover {
            background: #b54444;
            color: #fff;
            transform: translateY(-1px);
        }

        .tags-box {
            margin-top: 20px;
            padding: 17px;
            border-radius: 17px;
            background: #f4f1ea;
            border: 1px solid #e7e1d7;
        }

        .tags-title {
            display: flex;
            align-items: center;
            gap: 7px;
            font-size: 13px;
            font-weight: 900;
            color: #423a9e;
            margin-bottom: 12px;
        }

        .tag-row {
            display: flex;
            gap: 8px;
            margin-bottom: 8px;
        }

        .tag-row .form-control {
            flex: 1;
            min-height: 44px;
        }

        .remove-tag {
            width: 42px;
            flex-shrink: 0;
            border: 0;
            border-radius: 11px;
            background: #fff0f0;
            color: #b54444;
            transition: .2s ease;
        }

        .remove-tag:hover {
            background: #b54444;
            color: #fff;
        }

        .add-tag,
        .add-item {
            border: 1px dashed #bcb7d0;
            background: transparent;
            color: #423a9e;
            border-radius: 12px;
            padding: 9px 14px;
            font-size: 12px;
            font-weight: 800;
            cursor: pointer;
            transition: .2s ease;
        }

        .add-tag:hover,
        .add-item:hover {
            background: #eeedf9;
            border-color: #423a9e;
        }

        .add-item {
            width: 100%;
            padding: 14px;
            margin-top: 2px;
            font-size: 13px;
        }

        .empty-items {
            padding: 35px;
            text-align: center;
            border: 1px dashed #d5d0df;
            border-radius: 20px;
            color: #858198;
            margin-bottom: 15px;
        }

        .empty-items i {
            display: block;
            font-size: 30px;
            color: #aaa5bb;
            margin-bottom: 8px;
        }

        .form-actions {
            margin-top: 38px;
            padding-top: 24px;
            border-top: 1px solid #eeeaf2;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
        }

        .btn-submit {
            border: 0;
            background: linear-gradient(135deg, #2e2b7a, #48439a);
            color: #fff;
            border-radius: 14px;
            padding: 14px 28px;
            font-weight: 800;
            box-shadow: 0 10px 22px rgba(46, 43, 122, .17);
            transition: .2s ease;
        }

        .btn-submit:hover {
            color: #fff;
            transform: translateY(-2px);
            box-shadow: 0 14px 28px rgba(46, 43, 122, .23);
        }

        .btn-back {
            text-decoration: none;
            color: #77738e;
            border: 1px solid #ddd9e8;
            background: #fff;
            border-radius: 14px;
            padding: 13px 23px;
            font-weight: 800;
            transition: .2s ease;
        }

        .btn-back:hover {
            color: #423a9e;
            border-color: #bcb7d0;
            background: #faf9ff;
        }

        .number-box {
            text-align: center;
        }

        .text-danger {
            font-size: 12px;
            font-weight: 600;
        }

        @media(max-width: 768px) {

            .admin-content {
                padding: 15px;
            }

            .form-card {
                padding: 20px;
                border-radius: 22px;
            }

            .page-title h1 {
                font-size: 20px;
            }

            .page-title-icon {
                width: 50px;
                height: 50px;
            }

            .item-card {
                padding: 17px;
            }

            .form-actions {
                flex-direction: column-reverse;
            }

            .btn-submit,
            .btn-back {
                width: 100%;
                text-align: center;
            }

            .icon-textarea {
                min-height: 145px !important;
            }
        }
    </style>
@endsection

@section('main')
    <div class="admin-content">

        <div class="form-card">

            {{-- Header --}}

            <div class="page-title">

                <div class="page-title-icon">
                    <i class="bi bi-tools"></i>
                </div>

                <div>
                    <h1>{{ $pageTitle }}</h1>
                    <p>اطلاعات خدمت، آمار و آیتم‌های مربوط به آن را مدیریت کنید.</p>
                </div>

            </div>

            <form
                action="{{ $service->exists
                    ? route('admin.services.update', $service->id)
                    : route('admin.services.store') }}"
                method="POST"
            >

                @csrf

                @if($service->exists)
                    @method('PUT')
                @endif

                {{-- Main Service --}}

                <div class="section">

                    <div class="section-heading">

                        <div class="section-heading-icon">
                            <i class="bi bi-info-lg"></i>
                        </div>

                        <div>
                            <div class="section-title">
                                اطلاعات اصلی خدمت
                            </div>

                            <div class="section-description">
                                مشخصات اصلی خدمت را وارد کنید.
                            </div>
                        </div>

                    </div>

                    <div class="row g-4">

                        {{-- Category --}}

                        <div class="col-md-6">

                            <label class="form-label">
                                دسته‌بندی
                            </label>

                            <select
                                name="service_category_id"
                                class="form-select"
                            >

                                <option value="">
                                    انتخاب دسته‌بندی
                                </option>

                                @foreach($categories as $category)

                                    <option
                                        value="{{ $category->id }}"
                                        @selected(old('service_category_id', $service->service_category_id) == $category->id)
                                    >
                                        {{ $category->name }}
                                    </option>

                                @endforeach

                            </select>

                            @error('service_category_id')
                                <div class="text-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>

                        {{-- Name --}}

                        <div class="col-md-6">

                            <label class="form-label">
                                نام خدمت
                            </label>

                            <input
                                type="text"
                                name="name"
                                class="form-control"
                                value="{{ old('name', $service->name) }}"
                                placeholder="مثلاً طراحی سایت"
                            >

                            @error('name')
                                <div class="text-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>

                        {{-- Service SVG --}}

                        <div class="col-12">

                            <label class="form-label">
                                آیکن SVG خدمت
                            </label>

                            <textarea
                                name="icon"
                                id="serviceIconInput"
                                class="form-control icon-textarea"
                                rows="7"
                                placeholder='<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
...
</svg>'
                            >{{ old('icon', $service->icon) }}</textarea>

                            @error('icon')
                                <div class="text-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror

                            <div class="icon-preview-wrapper">

                                <div class="icon-preview">
                                    <div id="serviceIconPreview"></div>
                                </div>

                                <div class="preview-info">
                                    <strong>پیش‌نمایش آیکن</strong>
                                    آیکن SVG را وارد کنید تا نتیجه را اینجا ببینید.
                                </div>

                            </div>

                            <div
                                class="preview-error"
                                id="serviceIconPreviewError"
                            >
                                کد SVG وارد شده معتبر نیست.
                            </div>

                        </div>

                        {{-- Description --}}

                        <div class="col-12">

                            <label class="form-label">
                                توضیحات
                            </label>

                            <textarea
                                name="description"
                                class="form-control"
                                placeholder="توضیحات مربوط به خدمت..."
                            >{{ old('description', $service->description) }}</textarea>

                            @error('description')
                                <div class="text-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>

                    </div>

                </div>

                {{-- Statistics --}}

                <div class="section">

                    <div class="section-heading">

                        <div class="section-heading-icon">
                            <i class="bi bi-bar-chart"></i>
                        </div>

                        <div>
                            <div class="section-title">
                                آمار خدمت
                            </div>

                            <div class="section-description">
                                اعداد آماری مربوط به این خدمت.
                            </div>
                        </div>

                    </div>

                    <div class="row g-3">

                        <div class="col-md-3">

                            <div class="stats-box">

                                <label class="form-label">
                                    <i class="bi bi-kanban"></i>
                                    تعداد پروژه‌ها
                                </label>

                                <input
                                    type="number"
                                    name="projects_count"
                                    min="0"
                                    class="form-control stats-input"
                                    value="{{ old('projects_count', $service->exists ? $service->projects_count : 0) }}"
                                >

                            </div>

                        </div>

                        <div class="col-md-3">

                            <div class="stats-box">

                                <label class="form-label">
                                    <i class="bi bi-building"></i>
                                    تعداد برندها
                                </label>

                                <input
                                    type="number"
                                    name="brands_count"
                                    min="0"
                                    class="form-control stats-input"
                                    value="{{ old('brands_count', $service->exists ? $service->brands_count : 0) }}"
                                >

                            </div>

                        </div>

                        <div class="col-md-3">

                            <div class="stats-box">

                                <label class="form-label">
                                    <i class="bi bi-clock-history"></i>
                                    سال تجربه
                                </label>

                                <input
                                    type="number"
                                    name="experience_years"
                                    min="0"
                                    class="form-control stats-input"
                                    value="{{ old('experience_years', $service->exists ? $service->experience_years : 0) }}"
                                >

                            </div>

                        </div>

                        <div class="col-md-3">

                            <div class="stats-box">

                                <label class="form-label">
                                    <i class="bi bi-grid"></i>
                                    تعداد صنایع
                                </label>

                                <input
                                    type="number"
                                    name="industries_count"
                                    min="0"
                                    class="form-control stats-input"
                                    value="{{ old('industries_count', $service->exists ? $service->industries_count : 0) }}"
                                >

                            </div>

                        </div>

                    </div>

                </div>

                {{-- Items --}}

                <div class="section">

                    <div class="section-heading">

                        <div class="section-heading-icon">
                            <i class="bi bi-list-check"></i>
                        </div>

                        <div>
                            <div class="section-title">
                                آیتم‌های خدمت
                            </div>

                            <div class="section-description">
                                ویژگی‌ها و بخش‌های مختلف این خدمت را اضافه کنید.
                            </div>
                        </div>

                    </div>

                    <div id="itemsContainer">

                        @php
                            $oldItems = old('items');

                            if ($oldItems !== null) {
                                $items = $oldItems;
                            } elseif ($service->exists) {
                                $items = $service->items->map(function ($item) {
                                    return [
                                        'number' => $item->number,
                                        'icon' => $item->icon,
                                        'title' => $item->title,
                                        'text' => $item->text,
                                        'tags' => $item->tags->pluck('name')->toArray(),
                                    ];
                                })->toArray();
                            } else {
                                $items = [];
                            }
                        @endphp

                        @foreach($items as $index => $item)

                            <div class="item-card">

                                <div class="item-header">

                                    <div class="item-heading">

                                        <div class="item-number">
                                            {{ $index + 1 }}
                                        </div>

                                        <div class="item-title">
                                            آیتم خدمت
                                        </div>

                                    </div>

                                    <button
                                        type="button"
                                        class="remove-item"
                                        onclick="removeItem(this)"
                                        title="حذف آیتم"
                                    >
                                        <i class="bi bi-trash3"></i>
                                    </button>

                                </div>

                                <div class="row g-3">

                                    {{-- Number --}}

                                    <div class="col-md-2">

                                        <label class="form-label">
                                            شماره
                                        </label>

                                        <input
                                            type="number"
                                            min="0"
                                            name="items[{{ $index }}][number]"
                                            class="form-control number-box"
                                            value="{{ $item['number'] ?? 0 }}"
                                        >

                                    </div>

                                    {{-- Item SVG --}}

                                    <div class="col-md-4">

                                        <label class="form-label">
                                            آیکن SVG
                                        </label>

                                        <textarea
                                            name="items[{{ $index }}][icon]"
                                            class="form-control icon-textarea item-icon-input"
                                            rows="7"
                                            placeholder='<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
...
</svg>'
                                        >{{ $item['icon'] ?? '' }}</textarea>

                                        <div class="icon-preview-wrapper">

                                            <div class="icon-preview item-icon-preview">
                                            </div>

                                            <div class="preview-info">
                                                <strong>پیش‌نمایش</strong>
                                                SVG آیتم
                                            </div>

                                        </div>

                                        <div class="preview-error item-icon-error">
                                            کد SVG وارد شده معتبر نیست.
                                        </div>

                                    </div>

                                    {{-- Title --}}

                                    <div class="col-md-6">

                                        <label class="form-label">
                                            عنوان
                                        </label>

                                        <input
                                            type="text"
                                            name="items[{{ $index }}][title]"
                                            class="form-control"
                                            value="{{ $item['title'] ?? '' }}"
                                            placeholder="عنوان آیتم"
                                        >

                                    </div>

                                    {{-- Text --}}

                                    <div class="col-12">

                                        <label class="form-label">
                                            متن
                                        </label>

                                        <textarea
                                            name="items[{{ $index }}][text]"
                                            class="form-control"
                                            placeholder="توضیح آیتم..."
                                        >{{ $item['text'] ?? '' }}</textarea>

                                    </div>

                                </div>

                                {{-- Tags --}}

                                <div class="tags-box">

                                    <div class="tags-title">
                                        <i class="bi bi-tags"></i>
                                        تگ‌های این آیتم
                                    </div>

                                    <div
                                        class="tags-container"
                                        data-item-index="{{ $index }}"
                                    >

                                        @foreach(($item['tags'] ?? ['']) as $tag)

                                            <div class="tag-row">

                                                <input
                                                    type="text"
                                                    name="items[{{ $index }}][tags][]"
                                                    class="form-control"
                                                    value="{{ $tag }}"
                                                    placeholder="مثلاً طراحی اختصاصی"
                                                >

                                                <button
                                                    type="button"
                                                    class="remove-tag"
                                                    onclick="removeTag(this)"
                                                    title="حذف تگ"
                                                >
                                                    <i class="bi bi-x-lg"></i>
                                                </button>

                                            </div>

                                        @endforeach

                                    </div>

                                    <button
                                        type="button"
                                        class="add-tag"
                                        onclick="addTag(this)"
                                    >
                                        <i class="bi bi-plus"></i>
                                        افزودن تگ
                                    </button>

                                </div>

                            </div>

                        @endforeach

                    </div>

                    @if(count($items) === 0)

                        <div
                            class="empty-items"
                            id="emptyItems"
                        >
                            <i class="bi bi-layers"></i>
                            هنوز آیتمی برای این خدمت اضافه نشده است.
                        </div>

                    @endif

                    <button
                        type="button"
                        class="add-item"
                        onclick="addItem()"
                    >
                        <i class="bi bi-plus-lg"></i>
                        افزودن آیتم جدید
                    </button>

                </div>

                {{-- Actions --}}

                <div class="form-actions">

                    <a
                        href="{{ route('admin.services.index') }}"
                        class="btn-back"
                    >
                        <i class="bi bi-arrow-right"></i>
                        بازگشت
                    </a>

                    <button
                        type="submit"
                        class="btn-submit"
                    >
                        <i class="bi bi-check-lg"></i>
                        {{ $service->exists ? 'ذخیره تغییرات' : 'ثبت خدمت' }}
                    </button>

                </div>

            </form>

        </div>

    </div>
@endsection

@section('js')
    <script>
        let itemIndex = {{ count($items) }};

        function previewSvg(input, preview, error) {

            const svg = input.value.trim();

            preview.innerHTML = '';
            error.style.display = 'none';

            if (!svg) {
                return;
            }

            const parser = new DOMParser();

            const parsedDocument = parser.parseFromString(
                svg,
                'image/svg+xml'
            );

            const parsedSvg = parsedDocument.documentElement;

            if (
                parsedSvg.tagName.toLowerCase() !== 'svg' ||
                parsedDocument.querySelector('parsererror')
            ) {
                error.style.display = 'block';
                return;
            }

            const svgElement = document.importNode(
                parsedSvg,
                true
            );

            preview.appendChild(svgElement);
        }

        function initServiceIconPreview() {

            const input = document.getElementById(
                'serviceIconInput'
            );

            const preview = document.getElementById(
                'serviceIconPreview'
            );

            const error = document.getElementById(
                'serviceIconPreviewError'
            );

            if (!input || !preview || !error) {
                return;
            }

            input.addEventListener('input', function () {

                previewSvg(
                    input,
                    preview,
                    error
                );

            });

            previewSvg(
                input,
                preview,
                error
            );
        }

        function initItemIconPreview(input) {

            const itemCard = input.closest(
                '.item-card'
            );

            if (!itemCard) {
                return;
            }

            const preview = itemCard.querySelector(
                '.item-icon-preview'
            );

            const error = itemCard.querySelector(
                '.item-icon-error'
            );

            if (!preview || !error) {
                return;
            }

            input.addEventListener('input', function () {

                previewSvg(
                    input,
                    preview,
                    error
                );

            });

            previewSvg(
                input,
                preview,
                error
            );
        }

        function initAllItemIconPreviews() {

            document
                .querySelectorAll('.item-icon-input')
                .forEach(function (input) {

                    initItemIconPreview(input);

                });

        }

        function updateItemNumbers() {

            document
                .querySelectorAll('#itemsContainer .item-card')
                .forEach(function (item, index) {

                    const number = item.querySelector(
                        '.item-number'
                    );

                    if (number) {
                        number.textContent = index + 1;
                    }

                });

        }

        function addItem() {

            const container = document.getElementById(
                'itemsContainer'
            );

            const emptyItems = document.getElementById(
                'emptyItems'
            );

            if (emptyItems) {
                emptyItems.remove();
            }

            const currentIndex = itemIndex;

            const html = `
                <div class="item-card">

                    <div class="item-header">

                        <div class="item-heading">

                            <div class="item-number">
                                1
                            </div>

                            <div class="item-title">
                                آیتم جدید
                            </div>

                        </div>

                        <button
                            type="button"
                            class="remove-item"
                            onclick="removeItem(this)"
                            title="حذف آیتم"
                        >
                            <i class="bi bi-trash3"></i>
                        </button>

                    </div>

                    <div class="row g-3">

                        <div class="col-md-2">

                            <label class="form-label">
                                شماره
                            </label>

                            <input
                                type="number"
                                min="0"
                                name="items[${currentIndex}][number]"
                                class="form-control number-box"
                                value="0"
                            >

                        </div>

                        <div class="col-md-4">

                            <label class="form-label">
                                آیکن SVG
                            </label>

                            <textarea
                                name="items[${currentIndex}][icon]"
                                class="form-control icon-textarea item-icon-input"
                                rows="7"
                                placeholder='<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
...
</svg>'
                            ></textarea>

                            <div class="icon-preview-wrapper">

                                <div class="icon-preview item-icon-preview">
                                </div>

                                <div class="preview-info">
                                    <strong>پیش‌نمایش</strong>
                                    SVG آیتم
                                </div>

                            </div>

                            <div class="preview-error item-icon-error">
                                کد SVG وارد شده معتبر نیست.
                            </div>

                        </div>

                        <div class="col-md-6">

                            <label class="form-label">
                                عنوان
                            </label>

                            <input
                                type="text"
                                name="items[${currentIndex}][title]"
                                class="form-control"
                                placeholder="عنوان آیتم"
                            >

                        </div>

                        <div class="col-12">

                            <label class="form-label">
                                متن
                            </label>

                            <textarea
                                name="items[${currentIndex}][text]"
                                class="form-control"
                                placeholder="توضیح آیتم..."
                            ></textarea>

                        </div>

                    </div>

                    <div class="tags-box">

                        <div class="tags-title">
                            <i class="bi bi-tags"></i>
                            تگ‌های این آیتم
                        </div>

                        <div class="tags-container">

                            <div class="tag-row">

                                <input
                                    type="text"
                                    name="items[${currentIndex}][tags][]"
                                    class="form-control"
                                    placeholder="مثلاً طراحی اختصاصی"
                                >

                                <button
                                    type="button"
                                    class="remove-tag"
                                    onclick="removeTag(this)"
                                    title="حذف تگ"
                                >
                                    <i class="bi bi-x-lg"></i>
                                </button>

                            </div>

                        </div>

                        <button
                            type="button"
                            class="add-tag"
                            onclick="addTag(this)"
                        >
                            <i class="bi bi-plus"></i>
                            افزودن تگ
                        </button>

                    </div>

                </div>
            `;

            container.insertAdjacentHTML(
                'beforeend',
                html
            );

            const newItem =
                container.lastElementChild;

            const iconInput =
                newItem.querySelector(
                    '.item-icon-input'
                );

            if (iconInput) {
                initItemIconPreview(iconInput);
            }

            itemIndex++;

            updateItemNumbers();
        }

        function removeItem(button) {

            const item = button.closest(
                '.item-card'
            );

            if (item) {
                item.remove();
            }

            const container =
                document.getElementById(
                    'itemsContainer'
                );

            const items =
                container.querySelectorAll(
                    '.item-card'
                );

            if (items.length === 0) {

                container.insertAdjacentHTML(
                    'beforeend',
                    `
                        <div
                            class="empty-items"
                            id="emptyItems"
                        >
                            <i class="bi bi-layers"></i>
                            هنوز آیتمی برای این خدمت اضافه نشده است.
                        </div>
                    `
                );

            }

            updateItemNumbers();
        }

        function addTag(button) {

            const itemCard = button.closest(
                '.item-card'
            );

            const tagsContainer =
                itemCard.querySelector(
                    '.tags-container'
                );

            const firstInput =
                tagsContainer.querySelector(
                    'input'
                );

            if (!firstInput) {
                return;
            }

            const name =
                firstInput.name;

            const html = `
                <div class="tag-row">

                    <input
                        type="text"
                        name="${name}"
                        class="form-control"
                        placeholder="مثلاً طراحی اختصاصی"
                    >

                    <button
                        type="button"
                        class="remove-tag"
                        onclick="removeTag(this)"
                        title="حذف تگ"
                    >
                        <i class="bi bi-x-lg"></i>
                    </button>

                </div>
            `;

            tagsContainer.insertAdjacentHTML(
                'beforeend',
                html
            );
        }

        function removeTag(button) {

            const container =
                button.closest(
                    '.tags-container'
                );

            const rows =
                container.querySelectorAll(
                    '.tag-row'
                );

            if (rows.length === 1) {

                const input =
                    rows[0].querySelector(
                        'input'
                    );

                if (input) {
                    input.value = '';
                }

                return;
            }

            button.closest(
                '.tag-row'
            ).remove();
        }

        initServiceIconPreview();

        initAllItemIconPreviews();

        updateItemNumbers();
    </script>
@endsection