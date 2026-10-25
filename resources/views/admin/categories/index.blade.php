@extends('admin.layout.master')

@section('title')
    دسته‌بندی‌ها | پنل مدیریت
@endsection

@section('head')
    <style>
        .admin-content{padding:30px}
        .page-header{background:#fffdf8;border:1px solid rgba(34,32,95,.08);border-radius:26px;padding:24px 28px;margin-bottom:24px;display:flex;align-items:center;justify-content:space-between;gap:20px}
        .page-header-info{display:flex;align-items:center;gap:15px}
        .page-header-icon{width:55px;height:55px;border-radius:17px;background:#2e2b7a;color:#fff;display:flex;align-items:center;justify-content:center;font-size:24px}
        .page-header h1{margin:0;color:#1a1740;font-size:24px;font-weight:800}
        .page-header p{margin:6px 0 0;color:#77738e;font-size:14px}
        .add-btn{display:inline-flex;align-items:center;justify-content:center;gap:8px;background:#2e2b7a;color:#fff;border:0;text-decoration:none;border-radius:14px;padding:12px 20px;font-size:14px;font-weight:700;transition:.2s;cursor:pointer}
        .add-btn:hover{background:#423a9e;color:#fff;transform:translateY(-2px)}
        .categories-card{background:#fffdf8;border:1px solid rgba(34,32,95,.08);border-radius:26px;overflow:hidden}
        .table-wrapper{overflow-x:auto}
        .categories-table{width:100%;border-collapse:collapse;min-width:1000px}
        .categories-table th{background:#f7f4ee;color:#423a9e;font-size:13px;font-weight:800;padding:17px 15px;text-align:right;white-space:nowrap}
        .categories-table td{padding:17px 15px;border-top:1px solid rgba(34,32,95,.07);color:#34314e;font-size:13px;vertical-align:middle}
        .categories-table tbody tr{transition:.2s}
        .categories-table tbody tr:hover{background:#faf8f2}
        .category-image{width:60px;height:60px;border-radius:13px;object-fit:contain;padding:5px;border:1px solid rgba(34,32,95,.08);background:#fff}
        .category-image-placeholder{width:60px;height:60px;border-radius:13px;background:#f0effa;color:#423a9e;display:flex;align-items:center;justify-content:center;font-size:23px}
        .category-name{font-weight:800;color:#1a1740}
        .category-description{max-width:250px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;color:#77738e}
        .category-id{display:inline-flex;align-items:center;justify-content:center;min-width:35px;height:30px;padding:0 8px;border-radius:10px;background:#eeeefa;color:#423a9e;font-size:12px;font-weight:800}
        .parent-badge{display:inline-flex;align-items:center;gap:6px;padding:7px 11px;border-radius:10px;background:#f0effa;color:#423a9e;font-size:12px;font-weight:700}
        .root-badge{background:#edf8f1;color:#247a45}
        .actions{display:flex;align-items:center;gap:7px}
        .action-btn{width:36px;height:36px;border:0;border-radius:10px;display:inline-flex;align-items:center;justify-content:center;text-decoration:none;transition:.2s;cursor:pointer}
        .edit-btn{background:#eeeefa;color:#423a9e}
        .edit-btn:hover{background:#423a9e;color:#fff}
        .delete-btn{background:#fbeeee;color:#b54444}
        .delete-btn:hover{background:#b54444;color:#fff}
        .action-btn:disabled{opacity:.5;cursor:not-allowed}
        .empty-state{padding:70px 20px;text-align:center;color:#77738e}
        .empty-state>i{font-size:55px;display:block;margin-bottom:15px;color:#c7c2d2}
        .empty-state h3{color:#34314e;font-size:18px;margin-bottom:8px}
        .empty-state p{margin-bottom:20px}
        .category-modal .modal-content{background:#fffdf8;border:1px solid rgba(34,32,95,.08);border-radius:24px;overflow:hidden}
        .category-modal .modal-header{padding:22px 25px;border-bottom:1px solid rgba(34,32,95,.08)}
        .category-modal .modal-title{color:#1a1740;font-size:19px;font-weight:800}
        .category-modal .modal-body{padding:25px}
        .category-modal .modal-footer{padding:18px 25px;border-top:1px solid rgba(34,32,95,.08)}
        .form-label{color:#34314e;font-size:14px;font-weight:700;margin-bottom:9px}
        .form-control,.form-select{border:1px solid #e5e1eb;border-radius:12px;padding:12px 14px;font-size:14px;color:#34314e;background-color:#fff}
        .form-control:focus,.form-select:focus{border-color:#423a9e;box-shadow:0 0 0 3px rgba(66,58,158,.1)}
        .form-control.is-invalid,.form-select.is-invalid{border-color:#b54444}
        .invalid-feedback{font-size:12px}
        .image-upload{display:block;padding:15px;border:1px dashed #c7c2d2;border-radius:15px;background:#faf8f2;cursor:pointer;text-align:center;transition:.2s}
        .image-upload:hover{border-color:#423a9e;background:#f4f2fb}
        .image-upload i{display:block;font-size:27px;color:#423a9e;margin-bottom:8px}
        .image-upload span{display:block;color:#34314e;font-size:13px;font-weight:700}
        .image-upload small{display:block;color:#77738e;font-size:12px;margin-top:5px}
        .image-preview-wrapper{margin-top:15px;text-align:center}
        .image-preview{width:120px;height:120px;object-fit:contain;background:#fff;border:1px solid #e5e1eb;border-radius:15px;padding:8px}
        .image-preview-label{display:block;margin-top:8px;font-size:12px;color:#77738e}
        .modal-submit-btn{display:inline-flex;align-items:center;justify-content:center;gap:8px;background:#2e2b7a;color:#fff;border:0;border-radius:12px;padding:11px 22px;font-size:13px;font-weight:700;min-width:130px;cursor:pointer}
        .modal-submit-btn:hover{background:#423a9e;color:#fff}
        .modal-submit-btn:disabled{opacity:.65;cursor:not-allowed}
        .modal-cancel-btn{background:#f1eee7;color:#34314e;border:0;border-radius:12px;padding:11px 20px;font-size:13px;font-weight:700}
        .modal-cancel-btn:hover{background:#e6e1d7}
        .toast-message{position:fixed;top:25px;left:25px;z-index:20000;width:min(400px,calc(100% - 40px));padding:16px 20px;border-radius:15px;font-size:14px;font-weight:700;box-shadow:0 10px 35px rgba(26,23,64,.12);display:none}
        .toast-message.success{display:block;background:#edf8f1;color:#247a45}
        .toast-message.error{display:block;background:#fbeeee;color:#b54444}
        .loading-spinner{width:15px;height:15px;border:2px solid rgba(255,255,255,.4);border-top-color:#fff;border-radius:50%;display:inline-block;animation:category-spin .7s linear infinite}
        @keyframes category-spin{to{transform:rotate(360deg)}}
        @media(max-width:768px){
            .admin-content{padding:18px}
            .page-header{padding:20px;flex-direction:column;align-items:stretch}
            .page-header h1{font-size:21px}
            .add-btn{justify-content:center}
            .category-modal .modal-body{padding:20px}
            .category-modal .modal-header,.category-modal .modal-footer{padding:18px 20px}
        }
    </style>
@endsection

@section('main')
    <div class="admin-content">
        <div class="page-header">
            <div class="page-header-info">
                <div class="page-header-icon">
                    <i class="bi bi-grid"></i>
                </div>
                <div>
                    <h1>دسته‌بندی‌ها</h1>
                    <p>مدیریت نام، تصویر، توضیحات و دسته‌بندی والد</p>
                </div>
            </div>
            <button type="button" class="add-btn" id="openCreateModal">
                <i class="bi bi-plus-lg"></i>
                افزودن دسته‌بندی
            </button>
        </div>

        <div id="toastMessage" class="toast-message" role="status"></div>

        <div class="categories-card">
            <div class="table-wrapper" id="categoriesTableWrapper" @if($categories->isEmpty()) style="display:none" @endif>
                <table class="categories-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>تصویر</th>
                            <th>نام دسته‌بندی</th>
                            <th>دسته‌بندی والد</th>
                            <th>توضیحات</th>
                            <th>تاریخ ثبت</th>
                            <th>عملیات</th>
                        </tr>
                    </thead>
                    <tbody id="categoriesTableBody">
                        @foreach($categories as $category)
                            <tr id="category-row-{{ $category->id }}">
                                <td>
                                    <span class="category-id">{{ $category->id }}</span>
                                </td>
                                <td>
                                    @if($category->image)
                                        <img src="{{ asset($category->image) }}" alt="{{ $category->name }}" class="category-image">
                                    @else
                                        <div class="category-image-placeholder">
                                            <i class="bi bi-image"></i>
                                        </div>
                                    @endif
                                </td>
                                <td>
                                    <div class="category-name">{{ $category->name }}</div>
                                </td>
                                <td>
                                    @if($category->parent)
                                        <span class="parent-badge">
                                            <i class="bi bi-diagram-3"></i>
                                            {{ $category->parent->name }}
                                        </span>
                                    @else
                                        <span class="parent-badge root-badge">دسته‌بندی اصلی</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="category-description" title="{{ $category->description }}">
                                        {{ $category->description ?: 'بدون توضیحات' }}
                                    </div>
                                </td>
                                <td>{{ $category->created_at?->format('Y/m/d') ?? '-' }}</td>
                                <td>
                                    <div class="actions">
                                        <button
                                            type="button"
                                            class="action-btn edit-btn edit-category-btn"
                                            title="ویرایش"
                                            data-id="{{ $category->id }}"
                                            data-name="{{ $category->name }}"
                                            data-parent-id="{{ $category->parent_id }}"
                                            data-description="{{ $category->description }}"
                                            data-image="{{ $category->image ? asset($category->image) : '' }}"
                                            data-update-url="{{ route('admin.categories.update', $category->id) }}">
                                            <i class="bi bi-pencil"></i>
                                        </button>
                                        <button
                                            type="button"
                                            class="action-btn delete-btn delete-category-btn"
                                            title="حذف"
                                            data-id="{{ $category->id }}"
                                            data-name="{{ $category->name }}"
                                            data-delete-url="{{ route('admin.categories.destroy', $category->id) }}">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="empty-state" id="emptyState" @if($categories->isNotEmpty()) style="display:none" @endif>
                <i class="bi bi-grid"></i>
                <h3>هنوز دسته‌بندی‌ای ثبت نشده است</h3>
                <p>برای شروع، اولین دسته‌بندی را اضافه کنید.</p>
                <button type="button" class="add-btn" id="openCreateModalEmpty">
                    <i class="bi bi-plus-lg"></i>
                    افزودن دسته‌بندی
                </button>
            </div>
        </div>
    </div>

    <div class="modal fade category-modal" id="categoryModal" tabindex="-1" aria-labelledby="categoryModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <form id="categoryForm" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="categoryModalTitle">افزودن دسته‌بندی جدید</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="بستن"></button>
                    </div>

                    <div class="modal-body">
                        <div id="formErrors" class="alert alert-danger" style="display:none"></div>

                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label for="categoryName" class="form-label">
                                    نام دسته‌بندی <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control" id="categoryName" name="name" maxlength="255" placeholder="نام دسته‌بندی">
                                <div class="invalid-feedback" id="nameError"></div>
                            </div>

                            <div class="col-md-6 mb-4">
                                <label for="categoryParent" class="form-label">دسته‌بندی والد</label>
                                <select class="form-select" id="categoryParent" name="parent_id">
                                    <option value="">بدون والد — دسته‌بندی اصلی</option>
                                    @foreach($parentCategories as $parentCategory)
                                        @if($parentCategory->parent_id === null)
                                            <option value="{{ $parentCategory->id }}">{{ $parentCategory->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                <div class="invalid-feedback" id="parent_idError"></div>
                            </div>

                            <div class="col-12 mb-4">
                                <label for="categoryDescription" class="form-label">توضیحات</label>
                                <textarea class="form-control" id="categoryDescription" name="description" rows="4" placeholder="توضیحات دسته‌بندی را وارد کنید..."></textarea>
                                <div class="invalid-feedback" id="descriptionError"></div>
                            </div>

                            <div class="col-12 mb-3">
                                <label for="categoryImage" class="form-label">تصویر دسته‌بندی <span class="text-muted">(اختیاری)</span></label>
                                <label for="categoryImage" class="image-upload">
                                    <i class="bi bi-cloud-arrow-up"></i>
                                    <span>برای انتخاب تصویر کلیک کنید</span>
                                    <small>JPG، PNG یا WEBP ـ حداکثر ۲ مگابایت</small>
                                </label>
                                <input type="file" id="categoryImage" name="image" class="d-none" accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp">
                                <div class="invalid-feedback" id="imageError"></div>

                                <div class="image-preview-wrapper" id="imagePreviewWrapper" style="display:none">
                                    <img src="" alt="پیش‌نمایش تصویر" class="image-preview" id="imagePreview">
                                    <span class="image-preview-label" id="imagePreviewLabel">پیش‌نمایش تصویر</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="modal-cancel-btn" data-bs-dismiss="modal">انصراف</button>
                        <button type="submit" class="modal-submit-btn" id="submitCategoryBtn">
                            <i class="bi bi-check-lg"></i>
                            <span id="submitCategoryText">ثبت دسته‌بندی</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const modalElement = document.getElementById('categoryModal');
            const categoryModal = new bootstrap.Modal(modalElement);
            const form = document.getElementById('categoryForm');
            const nameInput = document.getElementById('categoryName');
            const parentInput = document.getElementById('categoryParent');
            const descriptionInput = document.getElementById('categoryDescription');
            const imageInput = document.getElementById('categoryImage');
            const submitButton = document.getElementById('submitCategoryBtn');
            const submitText = document.getElementById('submitCategoryText');
            const modalTitle = document.getElementById('categoryModalTitle');
            const formErrors = document.getElementById('formErrors');
            const toast = document.getElementById('toastMessage');
            const tableBody = document.getElementById('categoriesTableBody');
            const tableWrapper = document.getElementById('categoriesTableWrapper');
            const emptyState = document.getElementById('emptyState');
            const imagePreview = document.getElementById('imagePreview');
            const imagePreviewWrapper = document.getElementById('imagePreviewWrapper');
            const imagePreviewLabel = document.getElementById('imagePreviewLabel');

            let editingId = null;
            let updateUrl = null;
            let toastTimer = null;
            let previewObjectUrl = null;

            const csrfToken = form.querySelector('[name="_token"]').value;

            function showToast(message, type = 'success') {
                clearTimeout(toastTimer);
                toast.textContent = message;
                toast.className = 'toast-message ' + type;
                toastTimer = setTimeout(function () {
                    toast.className = 'toast-message';
                }, 3500);
            }

            function escapeHtml(value) {
                const element = document.createElement('div');
                element.textContent = value ?? '';
                return element.innerHTML;
            }

            function clearPreviewObjectUrl() {
                if (previewObjectUrl) {
                    URL.revokeObjectURL(previewObjectUrl);
                    previewObjectUrl = null;
                }
            }

            function clearErrors() {
                formErrors.style.display = 'none';
                formErrors.textContent = '';

                form.querySelectorAll('.is-invalid').forEach(function (element) {
                    element.classList.remove('is-invalid');
                });

                ['name', 'parent_id', 'description', 'image'].forEach(function (field) {
                    const error = document.getElementById(field + 'Error');
                    if (error) {
                        error.textContent = '';
                    }
                });
            }

            function showValidationErrors(errors) {
                clearErrors();

                Object.keys(errors).forEach(function (field) {
                    const input = form.querySelector('[name="' + field + '"]');
                    const error = document.getElementById(field + 'Error');

                    if (input) {
                        input.classList.add('is-invalid');
                    }

                    if (error) {
                        error.textContent = errors[field][0];
                    } else {
                        formErrors.style.display = 'block';
                        formErrors.textContent += errors[field][0] + '\n';
                    }
                });

                if (formErrors.textContent.trim()) {
                    formErrors.style.whiteSpace = 'pre-line';
                }
            }

            function resetForm() {
                clearPreviewObjectUrl();
                form.reset();
                clearErrors();

                editingId = null;
                updateUrl = null;

                modalTitle.textContent = 'افزودن دسته‌بندی جدید';
                submitText.textContent = 'ثبت دسته‌بندی';

                imagePreview.src = '';
                imagePreviewWrapper.style.display = 'none';
                imagePreviewLabel.textContent = 'پیش‌نمایش تصویر';

                submitButton.disabled = false;
            }

            function updateEmptyState() {
                const hasCategories = tableBody.children.length > 0;
                tableWrapper.style.display = hasCategories ? 'block' : 'none';
                emptyState.style.display = hasCategories ? 'none' : 'block';
            }

            function createCategoryRow(category) {
                const row = document.createElement('tr');
                row.id = 'category-row-' + category.id;

                const imageHtml = category.image
                    ? `<img src="${escapeHtml(category.image)}" alt="${escapeHtml(category.name)}" class="category-image">`
                    : `<div class="category-image-placeholder"><i class="bi bi-image"></i></div>`;

                const parentHtml = category.parent_name
                    ? `<span class="parent-badge"><i class="bi bi-diagram-3"></i>${escapeHtml(category.parent_name)}</span>`
                    : `<span class="parent-badge root-badge">دسته‌بندی اصلی</span>`;

                const description = category.description || 'بدون توضیحات';

                row.innerHTML = `
                    <td><span class="category-id">${escapeHtml(category.id)}</span></td>
                    <td>${imageHtml}</td>
                    <td><div class="category-name">${escapeHtml(category.name)}</div></td>
                    <td>${parentHtml}</td>
                    <td><div class="category-description" title="${escapeHtml(description)}">${escapeHtml(description)}</div></td>
                    <td>${escapeHtml(category.created_at || '-')}</td>
                    <td>
                        <div class="actions">
                            <button type="button" class="action-btn edit-btn edit-category-btn"
                                title="ویرایش"
                                data-id="${escapeHtml(category.id)}"
                                data-name="${escapeHtml(category.name)}"
                                data-parent-id="${escapeHtml(category.parent_id ?? '')}"
                                data-description="${escapeHtml(category.description || '')}"
                                data-image="${escapeHtml(category.image || '')}"
                                data-update-url="${escapeHtml(category.update_url)}">
                                <i class="bi bi-pencil"></i>
                            </button>
                            <button type="button" class="action-btn delete-btn delete-category-btn"
                                title="حذف"
                                data-id="${escapeHtml(category.id)}"
                                data-name="${escapeHtml(category.name)}"
                                data-delete-url="${escapeHtml(category.delete_url)}">
                                <i class="bi bi-trash"></i>
                            </button>
                        </div>
                    </td>
                `;

                return row;
            }

            function refreshParentOptions() {
                const currentValue = parentInput.value;

                parentInput.querySelectorAll('option:not(:first-child)').forEach(function (option) {
                    const row = document.getElementById('category-row-' + option.value);
                    if (!row) {
                        option.remove();
                    }
                });

                const existing = new Set(
                    Array.from(parentInput.options).map(function (option) {
                        return option.value;
                    })
                );

                tableBody.querySelectorAll('tr').forEach(function (row) {
                    const editButton = row.querySelector('.edit-category-btn');
                    if (!editButton) {
                        return;
                    }

                    const id = editButton.dataset.id;
                    const parentId = editButton.dataset.parentId;

                    if (parentId !== '') {
                        return;
                    }

                    if (!existing.has(id)) {
                        const option = document.createElement('option');
                        option.value = id;
                        option.textContent = editButton.dataset.name;
                        parentInput.appendChild(option);
                    }
                });

                if (currentValue && parentInput.querySelector('option[value="' + currentValue + '"]')) {
                    parentInput.value = currentValue;
                }
            }

            function replaceCategoryRow(category) {
                const oldRow = document.getElementById('category-row-' + category.id);

                if (oldRow) {
                    oldRow.replaceWith(createCategoryRow(category));
                } else {
                    tableBody.prepend(createCategoryRow(category));
                }

                refreshParentOptions();
            }

            function setLoading(loading) {
                submitButton.disabled = loading;

                if (loading) {
                    submitButton.innerHTML = '<span class="loading-spinner"></span><span>در حال ذخیره...</span>';
                } else {
                    submitButton.innerHTML = '<i class="bi bi-check-lg"></i><span id="submitCategoryText">' +
                        (editingId ? 'ذخیره تغییرات' : 'ثبت دسته‌بندی') + '</span>';
                }
            }

            function openCreateModal() {
                resetForm();
                refreshParentOptions();
                categoryModal.show();
            }

            document.getElementById('openCreateModal').addEventListener('click', openCreateModal);
            document.getElementById('openCreateModalEmpty').addEventListener('click', openCreateModal);

            document.addEventListener('click', function (event) {
                const editButton = event.target.closest('.edit-category-btn');

                if (editButton) {
                    resetForm();

                    editingId = editButton.dataset.id;
                    updateUrl = editButton.dataset.updateUrl;

                    modalTitle.textContent = 'ویرایش دسته‌بندی';
                    submitText.textContent = 'ذخیره تغییرات';

                    refreshParentOptions();

                    nameInput.value = editButton.dataset.name;
                    parentInput.value = editButton.dataset.parentId || '';
                    descriptionInput.value = editButton.dataset.description || '';

                    const currentId = String(editingId);

                    parentInput.querySelectorAll('option').forEach(function (option) {
                        option.disabled = option.value === currentId;
                    });

                    if (editButton.dataset.image) {
                        imagePreview.src = editButton.dataset.image;
                        imagePreviewWrapper.style.display = 'block';
                        imagePreviewLabel.textContent = 'تصویر فعلی دسته‌بندی';
                    }

                    categoryModal.show();
                    return;
                }

                const deleteButton = event.target.closest('.delete-category-btn');

                if (deleteButton) {
                    const id = deleteButton.dataset.id;
                    const name = deleteButton.dataset.name;

                    if (!confirm('آیا از حذف دسته‌بندی «' + name + '» مطمئن هستید؟')) {
                        return;
                    }

                    deleteButton.disabled = true;

                    fetch(deleteButton.dataset.deleteUrl, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': csrfToken,
                            'Accept': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    })
                    .then(async function (response) {
                        const result = await response.json();

                        if (!response.ok || !result.success) {
                            throw new Error(result.message || 'حذف دسته‌بندی انجام نشد.');
                        }

                        return result;
                    })
                    .then(function (result) {
                        const row = document.getElementById('category-row-' + id);

                        if (row) {
                            row.remove();
                        }

                        updateEmptyState();

                        // اگر دسته‌بندی والد حذف شده باشد، رابطه والد فرزندان نیز تغییر می‌کند.
                        // بارگذاری مجدد باعث هماهنگی جدول و فهرست والدها می‌شود.
                        showToast(result.message);
                        setTimeout(function () {
                            window.location.reload();
                        }, 700);
                    })
                    .catch(function (error) {
                        showToast(error.message || 'خطا در حذف دسته‌بندی.', 'error');
                        deleteButton.disabled = false;
                    });
                }
            });

            imageInput.addEventListener('change', function () {
                clearErrors();
                clearPreviewObjectUrl();

                const file = imageInput.files[0];

                if (!file) {
                    return;
                }

                const allowedTypes = ['image/jpeg', 'image/png', 'image/webp'];

                if (!allowedTypes.includes(file.type)) {
                    imageInput.value = '';
                    imageInput.classList.add('is-invalid');
                    document.getElementById('imageError').textContent =
                        'فرمت تصویر باید JPG، PNG یا WEBP باشد.';
                    return;
                }

                if (file.size > 2 * 1024 * 1024) {
                    imageInput.value = '';
                    imageInput.classList.add('is-invalid');
                    document.getElementById('imageError').textContent =
                        'حجم تصویر نباید بیشتر از ۲ مگابایت باشد.';
                    return;
                }

                previewObjectUrl = URL.createObjectURL(file);
                imagePreview.src = previewObjectUrl;
                imagePreviewWrapper.style.display = 'block';
                imagePreviewLabel.textContent = 'پیش‌نمایش تصویر انتخاب‌شده';
            });

            nameInput.addEventListener('input', function () {
                nameInput.classList.remove('is-invalid');
                document.getElementById('nameError').textContent = '';
            });

            parentInput.addEventListener('change', function () {
                parentInput.classList.remove('is-invalid');
                document.getElementById('parent_idError').textContent = '';
            });

            descriptionInput.addEventListener('input', function () {
                descriptionInput.classList.remove('is-invalid');
                document.getElementById('descriptionError').textContent = '';
            });

            form.addEventListener('submit', function (event) {
                event.preventDefault();
                clearErrors();

                const isEditing = editingId !== null;
                const formData = new FormData(form);
                const url = isEditing
                    ? updateUrl
                    : @json(route('admin.categories.store'));

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
                .then(async function (response) {
                    const result = await response.json();

                    if (response.status === 422) {
                        showValidationErrors(result.errors || {});

                        if (result.message && !result.errors) {
                            showToast(result.message, 'error');
                        }

                        throw new Error('validation');
                    }

                    if (!response.ok || !result.success) {
                        throw new Error(result.message || 'ذخیره اطلاعات انجام نشد.');
                    }

                    return result;
                })
                .then(function (result) {
                    replaceCategoryRow(result.category);
                    updateEmptyState();

                    categoryModal.hide();
                    showToast(result.message);
                    resetForm();
                })
                .catch(function (error) {
                    if (error.message !== 'validation') {
                        showToast(error.message || 'خطایی رخ داد.', 'error');
                    }
                })
                .finally(function () {
                    setLoading(false);
                });
            });

            modalElement.addEventListener('hidden.bs.modal', function () {
                resetForm();

                parentInput.querySelectorAll('option').forEach(function (option) {
                    option.disabled = false;
                });
            });
        });
    </script>
@endsection