@extends('admin.layout.master')

@section('title')
    {{ $pageTitle }} | پنل مدیریت
@endsection

@section('head')
    <style>
        .admin-content {
            padding: 30px;
        }

        .page-header {
            background: #fffdf8;
            border: 1px solid rgba(34, 32, 95, 0.08);
            border-radius: 26px;
            padding: 24px 28px;
            margin-bottom: 24px;
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .page-header-icon {
            width: 55px;
            height: 55px;
            border-radius: 17px;
            background: #2e2b7a;
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
        }

        .page-header h1 {
            margin: 0;
            color: #1a1740;
            font-size: 24px;
            font-weight: 800;
        }

        .page-header p {
            margin: 6px 0 0;
            color: #77738e;
            font-size: 14px;
        }

        .form-card {
            background: #fffdf8;
            border: 1px solid rgba(34, 32, 95, 0.08);
            border-radius: 26px;
            padding: 30px;
        }

        .form-label {
            color: #1a1740;
            font-weight: 700;
            font-size: 14px;
            margin-bottom: 9px;
        }

        .form-control,
        .form-select {
            border: 1px solid #ddd9e8;
            border-radius: 13px;
            padding: 12px 14px;
            color: #34314e;
            background: #fff;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #423a9e;
            box-shadow: 0 0 0 3px rgba(66, 58, 158, 0.08);
        }

        textarea.form-control {
            min-height: 130px;
            resize: vertical;
        }

        .current-image {
            margin-top: 12px;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .current-image img {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 15px;
            border: 1px solid #ddd9e8;
        }

        .current-image span {
            font-size: 12px;
            color: #77738e;
        }

        .section-title {
            color: #2e2b7a;
            font-size: 17px;
            font-weight: 800;
            margin: 30px 0 18px;
            padding-bottom: 12px;
            border-bottom: 1px solid #eeeaf2;
        }

        .feature-item {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 10px;
        }

        .feature-item .form-control {
            flex: 1;
        }

        .remove-feature {
            width: 42px;
            height: 42px;
            flex-shrink: 0;
            border: 0;
            border-radius: 11px;
            background: #fbeeee;
            color: #b54444;
            cursor: pointer;
        }

        .remove-feature:hover {
            background: #b54444;
            color: #fff;
        }

        .add-feature {
            border: 1px dashed #bdb8d0;
            background: transparent;
            color: #423a9e;
            border-radius: 12px;
            padding: 10px 16px;
            font-size: 13px;
            font-weight: 700;
            cursor: pointer;
        }

        .add-feature:hover {
            background: #eeeefa;
        }

        .switch-wrapper {
            background: #f7f4ee;
            border-radius: 14px;
            padding: 15px 17px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .switch-text strong {
            display: block;
            color: #1a1740;
            font-size: 14px;
        }

        .switch-text span {
            display: block;
            color: #77738e;
            font-size: 12px;
            margin-top: 4px;
        }

        .form-check-input {
            width: 45px;
            height: 23px;
            cursor: pointer;
        }

        .form-actions {
            margin-top: 30px;
            padding-top: 22px;
            border-top: 1px solid #eeeaf2;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
        }

        .submit-btn {
            border: 0;
            background: #2e2b7a;
            color: #fff;
            border-radius: 13px;
            padding: 13px 25px;
            font-size: 14px;
            font-weight: 700;
            cursor: pointer;
        }

        .submit-btn:hover {
            background: #423a9e;
        }

        .back-btn {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            color: #77738e;
            text-decoration: none;
            border: 1px solid #ddd9e8;
            border-radius: 13px;
            padding: 12px 20px;
            font-size: 14px;
            font-weight: 700;
        }

        .back-btn:hover {
            color: #2e2b7a;
            border-color: #2e2b7a;
        }

        .invalid-feedback {
            display: block;
            margin-top: 6px;
        }

        @media (max-width: 768px) {
            .admin-content {
                padding: 18px;
            }

            .form-card {
                padding: 20px;
            }

            .form-actions {
                flex-direction: column-reverse;
                align-items: stretch;
            }

            .submit-btn,
            .back-btn {
                justify-content: center;
                text-align: center;
            }
        }
    </style>
@endsection

@section('main')
    <div class="admin-content">

        <div class="page-header">

            <div class="page-header-icon">
                <i class="bi bi-box-seam"></i>
            </div>

            <div>
                <h1>{{ $pageTitle }}</h1>
                <p>
                    اطلاعات محصول و ویژگی‌های آن را وارد کنید.
                </p>
            </div>

        </div>

        <div class="form-card">

            <form
                action="{{ $product->exists
                    ? route('admin.products.update', $product->id)
                    : route('admin.products.store') }}"
                method="POST"
                enctype="multipart/form-data"
            >

                @csrf

                @if($product->exists)
                    @method('PUT')
                @endif

                <div class="row g-4">

                    <div class="col-md-6">

                        <label class="form-label">
                            نام محصول
                        </label>

                        <input
                            type="text"
                            name="name"
                            class="form-control @error('name') is-invalid @enderror"
                            value="{{ old('name', $product->name) }}"
                            placeholder="مثلاً دستگاه تصفیه آب"
                        >

                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>

                    <div class="col-md-6">

                        <label class="form-label">
                            عنوان محصول
                        </label>

                        <input
                            type="text"
                            name="title"
                            class="form-control @error('title') is-invalid @enderror"
                            value="{{ old('title', $product->title) }}"
                            placeholder="عنوان نمایشی محصول"
                        >

                        @error('title')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>

                    <div class="col-md-6">

                        <label class="form-label">
                            دسته‌بندی
                        </label>

                        <select
                            name="category_id"
                            class="form-select @error('category_id') is-invalid @enderror"
                        >
                            <option value="">
                                انتخاب دسته‌بندی
                            </option>

                            @foreach($categories as $category)

                                <option
                                    value="{{ $category->id }}"
                                    @selected(old('category_id', $product->category_id) == $category->id)
                                >
                                    {{ $category->name }}
                                </option>

                            @endforeach

                        </select>

                        @error('category_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>

                    <div class="col-md-6">

                        <label class="form-label">
                            تصویر محصول
                        </label>

                        <input
                            type="file"
                            name="image"
                            class="form-control @error('image') is-invalid @enderror"
                            accept=".jpg,.jpeg,.png,.webp"
                        >

                        @error('image')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                        @if($product->image)

                            <div class="current-image">

                                <img
                                    src="{{ asset($product->image) }}"
                                    alt="{{ $product->name }}"
                                >

                                <span>
                                    تصویر فعلی محصول
                                </span>

                            </div>

                        @endif

                    </div>

                    <div class="col-12">

                        <label class="form-label">
                            توضیح کوتاه
                        </label>

                        <textarea
                            name="description"
                            class="form-control @error('description') is-invalid @enderror"
                            placeholder="توضیح کوتاهی درباره محصول..."
                        >{{ old('description', $product->description) }}</textarea>

                        @error('description')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>

                    <div class="col-12">

                        <label class="form-label">
                            درباره محصول
                        </label>

                        <textarea
                            name="about"
                            class="form-control @error('about') is-invalid @enderror"
                            style="min-height: 220px;"
                            placeholder="توضیحات کامل درباره محصول..."
                        >{{ old('about', $product->about) }}</textarea>

                        @error('about')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>

                </div>

                <div class="section-title">
                    <i class="bi bi-list-check"></i>
                    ویژگی‌های محصول
                </div>

                <div id="featuresContainer">

                    @php
                        $oldFeatures = old('features');

                        if ($oldFeatures !== null) {
                            $featureValues = $oldFeatures;
                        } elseif ($product->exists) {
                            $featureValues = $product->features->pluck('text')->toArray();
                        } else {
                            $featureValues = [''];
                        }
                    @endphp

                    @foreach($featureValues as $feature)

                        <div class="feature-item">

                            <input
                                type="text"
                                name="features[]"
                                class="form-control"
                                value="{{ $feature }}"
                                placeholder="مثلاً دارای گارانتی ۲ ساله"
                            >

                            <button
                                type="button"
                                class="remove-feature"
                                onclick="removeFeature(this)"
                            >
                                <i class="bi bi-trash"></i>
                            </button>

                        </div>

                    @endforeach

                </div>

                <button
                    type="button"
                    class="add-feature"
                    onclick="addFeature()"
                >
                    <i class="bi bi-plus-lg"></i>
                    افزودن ویژگی
                </button>

                <div class="section-title">
                    <i class="bi bi-gear"></i>
                    وضعیت محصول
                </div>

                <div class="switch-wrapper">

                    <div class="switch-text">

                        <strong>
                            نمایش محصول در سایت
                        </strong>

                        <span>
                            در صورت فعال بودن، محصول در بخش محصولات سایت نمایش داده می‌شود.
                        </span>

                    </div>

                    <div>
                        <input
                            type="hidden"
                            name="is_active"
                            value="0"
                        >

                        <input
                            type="checkbox"
                            name="is_active"
                            value="1"
                            class="form-check-input"
                            @checked(old('is_active', $product->exists ? $product->is_active : true))
                        >
                    </div>

                </div>

                <div class="form-actions">

                    <a
                        href="{{ route('admin.products.index') }}"
                        class="back-btn"
                    >
                        <i class="bi bi-arrow-right"></i>
                        بازگشت
                    </a>

                    <button
                        type="submit"
                        class="submit-btn"
                    >
                        <i class="bi bi-check-lg"></i>

                        {{ $product->exists ? 'ذخیره تغییرات' : 'ثبت محصول' }}
                    </button>

                </div>

            </form>

        </div>

    </div>
@endsection

@section('js')
    <script>
        function addFeature() {
            const container = document.getElementById('featuresContainer');

            const item = document.createElement('div');

            item.className = 'feature-item';

            item.innerHTML = `
                <input
                    type="text"
                    name="features[]"
                    class="form-control"
                    placeholder="مثلاً دارای گارانتی ۲ ساله"
                >

                <button
                    type="button"
                    class="remove-feature"
                    onclick="removeFeature(this)"
                >
                    <i class="bi bi-trash"></i>
                </button>
            `;

            container.appendChild(item);

            item.querySelector('input').focus();
        }

        function removeFeature(button) {
            const container = document.getElementById('featuresContainer');
            const items = container.querySelectorAll('.feature-item');

            if (items.length === 1) {
                items[0].querySelector('input').value = '';
                return;
            }

            button.closest('.feature-item').remove();
        }
    </script>
@endsection