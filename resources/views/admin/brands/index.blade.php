@extends('admin.layout.master')

@section('title')
    برندها | پنل مدیریت
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
            justify-content: space-between;
            gap: 20px;
        }

        .page-header-info {
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

        .add-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            background: #2e2b7a;
            color: #fff;
            border: 0;
            text-decoration: none;
            border-radius: 14px;
            padding: 12px 20px;
            font-size: 14px;
            font-weight: 700;
            transition: .2s;
            cursor: pointer;
        }

        .add-btn:hover {
            background: #423a9e;
            color: #fff;
            transform: translateY(-2px);
        }

        .alert-success {
            border: 0;
            border-radius: 16px;
            background: #edf8f1;
            color: #247a45;
            padding: 14px 18px;
            margin-bottom: 20px;
        }

        .alert-error {
            border: 0;
            border-radius: 16px;
            background: #fbeeee;
            color: #b54444;
            padding: 14px 18px;
            margin-bottom: 20px;
        }

        .brands-card {
            background: #fffdf8;
            border: 1px solid rgba(34, 32, 95, 0.08);
            border-radius: 26px;
            overflow: hidden;
        }

        .table-wrapper {
            overflow-x: auto;
        }

        .brands-table {
            width: 100%;
            border-collapse: collapse;
            min-width: 650px;
        }

        .brands-table th {
            background: #f7f4ee;
            color: #423a9e;
            font-size: 13px;
            font-weight: 800;
            padding: 17px 15px;
            text-align: right;
            white-space: nowrap;
        }

        .brands-table td {
            padding: 17px 15px;
            border-top: 1px solid rgba(34, 32, 95, 0.07);
            color: #34314e;
            font-size: 14px;
            vertical-align: middle;
        }

        .brands-table tbody tr {
            transition: .2s;
        }

        .brands-table tbody tr:hover {
            background: #faf8f2;
        }

        .brand-image {
            width: 65px;
            height: 65px;
            border-radius: 14px;
            object-fit: contain;
            padding: 5px;
            border: 1px solid rgba(34, 32, 95, 0.08);
            background: #fff;
        }

        .brand-name {
            font-weight: 800;
            color: #1a1740;
        }

        .brand-id {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 35px;
            height: 30px;
            padding: 0 8px;
            border-radius: 10px;
            background: #eeeefa;
            color: #423a9e;
            font-size: 12px;
            font-weight: 800;
        }

        .actions {
            display: flex;
            align-items: center;
            gap: 7px;
        }

        .action-btn {
            width: 36px;
            height: 36px;
            border: 0;
            border-radius: 10px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            transition: .2s;
            cursor: pointer;
        }

        .edit-btn {
            background: #eeeefa;
            color: #423a9e;
        }

        .edit-btn:hover {
            background: #423a9e;
            color: #fff;
        }

        .delete-btn {
            background: #fbeeee;
            color: #b54444;
        }

        .delete-btn:hover {
            background: #b54444;
            color: #fff;
        }

        .empty-state {
            padding: 70px 20px;
            text-align: center;
            color: #77738e;
        }

        .empty-state i {
            font-size: 55px;
            display: block;
            margin-bottom: 15px;
            color: #c7c2d2;
        }

        .empty-state h3 {
            color: #34314e;
            font-size: 18px;
            margin-bottom: 8px;
        }

        .empty-state p {
            margin-bottom: 20px;
        }

        .brand-modal .modal-content {
            background: #fffdf8;
            border: 1px solid rgba(34, 32, 95, 0.08);
            border-radius: 24px;
            overflow: hidden;
        }

        .brand-modal .modal-header {
            padding: 22px 25px;
            border-bottom: 1px solid rgba(34, 32, 95, 0.08);
        }

        .brand-modal .modal-title {
            color: #1a1740;
            font-size: 19px;
            font-weight: 800;
        }

        .brand-modal .modal-body {
            padding: 25px;
        }

        .brand-modal .modal-footer {
            padding: 18px 25px;
            border-top: 1px solid rgba(34, 32, 95, 0.08);
        }

        .form-label {
            color: #34314e;
            font-size: 14px;
            font-weight: 700;
            margin-bottom: 9px;
        }

        .form-control {
            border: 1px solid #e5e1eb;
            border-radius: 12px;
            padding: 12px 14px;
            font-size: 14px;
            color: #34314e;
            background: #fff;
        }

        .form-control:focus {
            border-color: #423a9e;
            box-shadow: 0 0 0 3px rgba(66, 58, 158, 0.1);
        }

        .form-control.is-invalid {
            border-color: #b54444;
        }

        .invalid-feedback {
            font-size: 12px;
        }

        .image-upload {
            display: block;
            padding: 15px;
            border: 1px dashed #c7c2d2;
            border-radius: 15px;
            background: #faf8f2;
            cursor: pointer;
            text-align: center;
            transition: .2s;
        }

        .image-upload:hover {
            border-color: #423a9e;
            background: #f4f2fb;
        }

        .image-upload i {
            display: block;
            font-size: 27px;
            color: #423a9e;
            margin-bottom: 8px;
        }

        .image-upload span {
            display: block;
            color: #34314e;
            font-size: 13px;
            font-weight: 700;
        }

        .image-upload small {
            display: block;
            color: #77738e;
            font-size: 12px;
            margin-top: 5px;
        }

        .image-preview-wrapper {
            margin-top: 15px;
            text-align: center;
        }

        .image-preview {
            width: 120px;
            height: 120px;
            object-fit: contain;
            background: #fff;
            border: 1px solid #e5e1eb;
            border-radius: 15px;
            padding: 8px;
        }

        .image-preview-label {
            display: block;
            margin-top: 8px;
            font-size: 12px;
            color: #77738e;
        }

        .modal-submit-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            background: #2e2b7a;
            color: #fff;
            border: 0;
            border-radius: 12px;
            padding: 11px 22px;
            font-size: 13px;
            font-weight: 700;
            min-width: 120px;
            cursor: pointer;
        }

        .modal-submit-btn:hover {
            background: #423a9e;
            color: #fff;
        }

        .modal-submit-btn:disabled {
            opacity: .65;
            cursor: not-allowed;
        }

        .modal-cancel-btn {
            background: #f1eee7;
            color: #34314e;
            border: 0;
            border-radius: 12px;
            padding: 11px 20px;
            font-size: 13px;
            font-weight: 700;
        }

        .modal-cancel-btn:hover {
            background: #e6e1d7;
        }

        .toast-message {
            position: fixed;
            top: 25px;
            left: 25px;
            z-index: 20000;
            width: min(400px, calc(100% - 40px));
            padding: 16px 20px;
            border-radius: 15px;
            font-size: 14px;
            font-weight: 700;
            box-shadow: 0 10px 35px rgba(26, 23, 64, .12);
            display: none;
        }

        .toast-message.success {
            display: block;
            background: #edf8f1;
            color: #247a45;
        }

        .toast-message.error {
            display: block;
            background: #fbeeee;
            color: #b54444;
        }

        .loading-spinner {
            width: 15px;
            height: 15px;
            border: 2px solid rgba(255, 255, 255, .4);
            border-top-color: #fff;
            border-radius: 50%;
            display: inline-block;
            animation: brand-spin .7s linear infinite;
        }

        @keyframes brand-spin {
            to {
                transform: rotate(360deg);
            }
        }

        @media (max-width: 768px) {
            .admin-content {
                padding: 18px;
            }

            .page-header {
                padding: 20px;
                flex-direction: column;
                align-items: stretch;
            }

            .add-btn {
                justify-content: center;
            }

            .brand-modal .modal-body {
                padding: 20px;
            }

            .brand-modal .modal-header,
            .brand-modal .modal-footer {
                padding: 18px 20px;
            }
        }
    </style>
@endsection

@section('main')
    <div class="admin-content">

        <div class="page-header">
            <div class="page-header-info">
                <div class="page-header-icon">
                    <i class="bi bi-award"></i>
                </div>

                <div>
                    <h1>برندها</h1>
                    <p>مدیریت نام و تصاویر برندها</p>
                </div>
            </div>

            <button type="button" class="add-btn" id="openCreateModal">
                <i class="bi bi-plus-lg"></i>
                افزودن برند
            </button>
        </div>

        <div id="toastMessage" class="toast-message"></div>

        <div class="brands-card">

            <div class="table-wrapper" id="brandsTableWrapper"
                @if ($brands->isEmpty()) style="display: none;" @endif>
                <table class="brands-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>تصویر</th>
                            <th>نام برند</th>
                            <th>تاریخ ثبت</th>
                            <th>عملیات</th>
                        </tr>
                    </thead>

                    <tbody id="brandsTableBody">
                        @foreach ($brands as $brand)
                            <tr id="brand-row-{{ $brand->id }}">
                                <td>
                                    <span class="brand-id">{{ $brand->id }}</span>
                                </td>

                                <td>
                                    <img src="{{ asset($brand->img) }}" alt="{{ $brand->name }}" class="brand-image">
                                </td>

                                <td>
                                    <div class="brand-name">{{ $brand->name }}</div>
                                </td>

                                <td>
                                    {{ $brand->created_at ? verta($brand->created_at)->format('Y/m/d') : '-' }} </td>

                                <td>
                                    <div class="actions">
                                        <button type="button" class="action-btn edit-btn edit-brand-btn" title="ویرایش"
                                            data-id="{{ $brand->id }}" data-name="{{ $brand->name }}"
                                            data-image="{{ asset($brand->img) }}"
                                            data-update-url="{{ route('admin.brands.update', $brand->id) }}">
                                            <i class="bi bi-pencil"></i>
                                        </button>

                                        <button type="button" class="action-btn delete-btn delete-brand-btn" title="حذف"
                                            data-id="{{ $brand->id }}" data-name="{{ $brand->name }}"
                                            data-delete-url="{{ route('admin.brands.destroy', $brand->id) }}">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="empty-state" id="emptyState" @if ($brands->isNotEmpty()) style="display: none;" @endif>
                <i class="bi bi-award"></i>

                <h3>هنوز برندی ثبت نشده است</h3>

                <p>برای شروع، اولین برند را اضافه کنید.</p>

                <button type="button" class="add-btn" id="openCreateModalEmpty">
                    <i class="bi bi-plus-lg"></i>
                    افزودن برند
                </button>
            </div>

        </div>
    </div>

    {{-- Create / Edit Modal --}}
    <div class="modal fade brand-modal" id="brandModal" tabindex="-1" aria-labelledby="brandModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <form id="brandForm" enctype="multipart/form-data">
                    @csrf

                    <div class="modal-header">
                        <h5 class="modal-title" id="brandModalTitle">
                            افزودن برند جدید
                        </h5>

                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="بستن"></button>
                    </div>

                    <div class="modal-body">

                        <div id="formErrors" class="alert-error" style="display: none;"></div>

                        <div class="mb-4">
                            <label for="brandName" class="form-label">
                                نام برند
                                <span class="text-danger">*</span>
                            </label>

                            <input type="text" class="form-control" id="brandName" name="name"
                                placeholder="نام برند را وارد کنید" maxlength="255">

                            <div class="invalid-feedback" id="nameError"></div>
                        </div>

                        <div class="mb-3">
                            <label for="brandImage" class="form-label">
                                تصویر برند
                                <span class="text-danger" id="imageRequired">*</span>
                            </label>

                            <label for="brandImage" class="image-upload">
                                <i class="bi bi-cloud-arrow-up"></i>
                                <span>برای انتخاب تصویر کلیک کنید</span>
                                <small>JPG، PNG یا WEBP ـ حداکثر ۲ مگابایت</small>
                            </label>

                            <input type="file" id="brandImage" name="img" class="d-none"
                                accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp">

                            <div class="invalid-feedback" id="imageError"></div>

                            <div class="image-preview-wrapper" id="imagePreviewWrapper" style="display: none;">
                                <img src="" alt="پیش‌نمایش تصویر" class="image-preview" id="imagePreview">

                                <span class="image-preview-label" id="imagePreviewLabel">
                                    پیش‌نمایش تصویر
                                </span>
                            </div>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="modal-cancel-btn" data-bs-dismiss="modal">
                            انصراف
                        </button>

                        <button type="submit" class="modal-submit-btn" id="submitBrandBtn">
                            <i class="bi bi-check-lg"></i>
                            <span id="submitBrandText">ثبت برند</span>
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const brandModalElement = document.getElementById('brandModal');
            const brandModal = new bootstrap.Modal(brandModalElement);

            const brandForm = document.getElementById('brandForm');
            const brandName = document.getElementById('brandName');
            const brandImage = document.getElementById('brandImage');
            const submitBrandBtn = document.getElementById('submitBrandBtn');
            const submitBrandText = document.getElementById('submitBrandText');
            const brandModalTitle = document.getElementById('brandModalTitle');
            const imageRequired = document.getElementById('imageRequired');
            const imagePreview = document.getElementById('imagePreview');
            const imagePreviewWrapper = document.getElementById('imagePreviewWrapper');
            const imagePreviewLabel = document.getElementById('imagePreviewLabel');
            const formErrors = document.getElementById('formErrors');
            const toastMessage = document.getElementById('toastMessage');
            const brandsTableBody = document.getElementById('brandsTableBody');
            const brandsTableWrapper = document.getElementById('brandsTableWrapper');
            const emptyState = document.getElementById('emptyState');

            let editingBrandId = null;
            let currentUpdateUrl = null;
            let toastTimeout = null;

            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content ||
                brandForm.querySelector('[name="_token"]').value;

            function showToast(message, type = 'success') {
                clearTimeout(toastTimeout);

                toastMessage.textContent = message;
                toastMessage.className = 'toast-message ' + type;

                toastTimeout = setTimeout(function() {
                    toastMessage.className = 'toast-message';
                }, 3500);
            }

            function escapeHtml(value) {
                const element = document.createElement('div');
                element.textContent = value ?? '';
                return element.innerHTML;
            }

            function resetErrors() {
                formErrors.style.display = 'none';
                formErrors.textContent = '';

                document.querySelectorAll('#brandForm .is-invalid').forEach(function(element) {
                    element.classList.remove('is-invalid');
                });

                document.getElementById('nameError').textContent = '';
                document.getElementById('imageError').textContent = '';
            }

            function showValidationErrors(errors) {
                resetErrors();

                Object.keys(errors).forEach(function(field) {
                    const input = brandForm.querySelector('[name="' + field + '"]');
                    const errorElement = document.getElementById(field === 'img' ? 'imageError' : field +
                        'Error');

                    if (input) {
                        input.classList.add('is-invalid');
                    }

                    if (errorElement) {
                        errorElement.textContent = errors[field][0];
                    }
                });
            }

            function resetForm() {
                brandForm.reset();

                editingBrandId = null;
                currentUpdateUrl = null;

                resetErrors();

                brandName.classList.remove('is-invalid');
                brandImage.classList.remove('is-invalid');

                brandModalTitle.textContent = 'افزودن برند جدید';
                submitBrandText.textContent = 'ثبت برند';
                imageRequired.style.display = 'inline';

                imagePreviewWrapper.style.display = 'none';
                imagePreview.src = '';
                imagePreviewLabel.textContent = 'پیش‌نمایش تصویر';

                submitBrandBtn.disabled = false;
            }

            function updateEmptyState() {
                const hasBrands = brandsTableBody.children.length > 0;

                brandsTableWrapper.style.display = hasBrands ? 'block' : 'none';
                emptyState.style.display = hasBrands ? 'none' : 'block';
            }

            function createBrandRow(brand) {
                const row = document.createElement('tr');

                row.id = 'brand-row-' + brand.id;

                row.innerHTML = `
                    <td>
                        <span class="brand-id">${escapeHtml(brand.id)}</span>
                    </td>

                    <td>
                        <img
                            src="${escapeHtml(brand.img)}"
                            alt="${escapeHtml(brand.name)}"
                            class="brand-image"
                        >
                    </td>

                    <td>
                        <div class="brand-name">${escapeHtml(brand.name)}</div>
                    </td>

                    <td>${escapeHtml(brand.created_at)}</td>

                    <td>
                        <div class="actions">
                            <button
                                type="button"
                                class="action-btn edit-btn edit-brand-btn"
                                title="ویرایش"
                                data-id="${escapeHtml(brand.id)}"
                                data-name="${escapeHtml(brand.name)}"
                                data-image="${escapeHtml(brand.img)}"
                                data-update-url="${escapeHtml(brand.update_url)}"
                            >
                                <i class="bi bi-pencil"></i>
                            </button>

                            <button
                                type="button"
                                class="action-btn delete-btn delete-brand-btn"
                                title="حذف"
                                data-id="${escapeHtml(brand.id)}"
                                data-name="${escapeHtml(brand.name)}"
                                data-delete-url="${escapeHtml(brand.delete_url)}"
                            >
                                <i class="bi bi-trash"></i>
                            </button>
                        </div>
                    </td>
                `;

                return row;
            }

            function updateBrandRow(brand) {
                const oldRow = document.getElementById('brand-row-' + brand.id);

                if (oldRow) {
                    oldRow.replaceWith(createBrandRow(brand));
                }
            }

            function setLoading(loading) {
                submitBrandBtn.disabled = loading;

                if (loading) {
                    submitBrandBtn.innerHTML = `
                        <span class="loading-spinner"></span>
                        <span>در حال ذخیره...</span>
                    `;
                } else {
                    submitBrandBtn.innerHTML = `
                        <i class="bi bi-check-lg"></i>
                        <span id="submitBrandText">${editingBrandId ? 'ذخیره تغییرات' : 'ثبت برند'}</span>
                    `;
                }
            }

            function openCreateModal() {
                resetForm();
                brandModal.show();
            }

            document.getElementById('openCreateModal').addEventListener('click', openCreateModal);
            document.getElementById('openCreateModalEmpty').addEventListener('click', openCreateModal);

            document.addEventListener('click', function(event) {
                const editButton = event.target.closest('.edit-brand-btn');

                if (editButton) {
                    resetForm();

                    editingBrandId = editButton.dataset.id;
                    currentUpdateUrl = editButton.dataset.updateUrl;

                    brandModalTitle.textContent = 'ویرایش برند';
                    submitBrandText.textContent = 'ذخیره تغییرات';
                    imageRequired.style.display = 'none';

                    brandName.value = editButton.dataset.name;

                    imagePreview.src = editButton.dataset.image;
                    imagePreviewWrapper.style.display = 'block';
                    imagePreviewLabel.textContent = 'تصویر فعلی برند';

                    brandModal.show();
                    return;
                }

                const deleteButton = event.target.closest('.delete-brand-btn');

                if (deleteButton) {
                    const brandId = deleteButton.dataset.id;
                    const brandNameValue = deleteButton.dataset.name;
                    const deleteUrl = deleteButton.dataset.deleteUrl;

                    if (!confirm('آیا از حذف برند «' + brandNameValue + '» مطمئن هستید؟')) {
                        return;
                    }

                    deleteButton.disabled = true;

                    fetch(deleteUrl, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': csrfToken,
                                'Accept': 'application/json',
                                'X-Requested-With': 'XMLHttpRequest'
                            }
                        })
                        .then(async function(response) {
                            const result = await response.json();

                            if (!response.ok || !result.success) {
                                throw new Error(result.message || 'حذف برند انجام نشد.');
                            }

                            return result;
                        })
                        .then(function(result) {
                            const row = document.getElementById('brand-row-' + brandId);

                            if (row) {
                                row.remove();
                            }

                            updateEmptyState();
                            showToast(result.message);
                        })
                        .catch(function(error) {
                            showToast(error.message || 'خطا در حذف برند.', 'error');
                            deleteButton.disabled = false;
                        });
                }
            });

            brandImage.addEventListener('change', function() {
                resetErrors();

                const file = brandImage.files[0];

                if (!file) {
                    return;
                }

                const allowedTypes = ['image/jpeg', 'image/png', 'image/webp'];

                if (!allowedTypes.includes(file.type)) {
                    brandImage.value = '';
                    brandImage.classList.add('is-invalid');
                    document.getElementById('imageError').textContent =
                        'فرمت تصویر باید JPG، PNG یا WEBP باشد.';
                    return;
                }

                if (file.size > 2 * 1024 * 1024) {
                    brandImage.value = '';
                    brandImage.classList.add('is-invalid');
                    document.getElementById('imageError').textContent =
                        'حجم تصویر نباید بیشتر از ۲ مگابایت باشد.';
                    return;
                }

                const reader = new FileReader();

                reader.onload = function(event) {
                    imagePreview.src = event.target.result;
                    imagePreviewWrapper.style.display = 'block';
                    imagePreviewLabel.textContent = 'پیش‌نمایش تصویر انتخاب‌شده';
                };

                reader.readAsDataURL(file);
            });

            brandName.addEventListener('input', function() {
                brandName.classList.remove('is-invalid');
                document.getElementById('nameError').textContent = '';
            });

            brandForm.addEventListener('submit', function(event) {
                event.preventDefault();

                resetErrors();

                const isEditing = editingBrandId !== null;

                if (!isEditing && !brandImage.files.length) {
                    brandImage.classList.add('is-invalid');
                    document.getElementById('imageError').textContent =
                        'انتخاب تصویر برند الزامی است.';
                    return;
                }

                const formData = new FormData(brandForm);
                const url = isEditing ?
                    currentUpdateUrl :
                    @json(route('admin.brands.store'));


                setLoading(true);

                fetch(url, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': csrfToken,
                            'Accept': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest'
                        },
                        body: formData
                    })
                    .then(async function(response) {
                        const result = await response.json();

                        if (response.status === 422) {
                            showValidationErrors(result.errors || {});
                            throw new Error('لطفاً خطاهای فرم را برطرف کنید.');
                        }

                        if (!response.ok || !result.success) {
                            throw new Error(result.message || 'ذخیره اطلاعات انجام نشد.');
                        }

                        return result;
                    })
                    .then(function(result) {
                        if (isEditing) {
                            updateBrandRow(result.brand);
                        } else {
                            brandsTableBody.prepend(createBrandRow(result.brand));
                        }

                        updateEmptyState();
                        brandModal.hide();

                        showToast(result.message);
                        resetForm();
                    })
                    .catch(function(error) {
                        if (error.message !== 'لطفاً خطاهای فرم را برطرف کنید.') {
                            showToast(error.message || 'خطایی رخ داد.', 'error');
                        }
                    })
                    .finally(function() {
                        setLoading(false);
                    });
            });

            brandModalElement.addEventListener('hidden.bs.modal', function() {
                resetForm();
            });
        });
    </script>
@endsection
