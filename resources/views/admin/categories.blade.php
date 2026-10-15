@extends('admin.layout.master')

@section('title')
    مدیریت دسته‌بندی‌ها | صدراکو
@endsection

@section('head')
    <link rel="stylesheet" href="{{asset('css/admin/categories.css')}}">
@endsection

@section('main')
    <div class="admin-content">

        @if (session('success'))
            <div class="alert-strip success">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="alert-strip error">{{ session('error') }}</div>
        @endif

        <!-- Page head -->
        <div class="content-head-row">
            <div>
                <h2 class="content-title">مدیریت دسته‌بندی‌ها</h2>
                <div class="content-sub">دسته‌ها و زیردسته‌های محصولات فروشگاه را مدیریت کنید</div>
            </div>
            <button type="button" class="btn btn-dark-custom" data-bs-toggle="modal" data-bs-target="#addCategoryModal">
                <i class="bi bi-plus-lg me-1"></i> افزودن دسته‌بندی جدید
            </button>
        </div>

        <!-- Categories list -->
        <div class="table-card">

            <div class="cat-manage-list">

                @forelse ($categories as $category)
                    <div class="cat-manage-card">
                        <div class="cat-manage-head {{ $loop->first ? '' : 'collapsed' }}"
                             data-bs-toggle="collapse"
                             data-bs-target="#catSub{{ $category->id }}"
                             aria-expanded="{{ $loop->first ? 'true' : 'false' }}"
                             aria-controls="catSub{{ $category->id }}">
                            <div class="cat-manage-info">
                                <div class="cat-icon"><i class="bi bi-folder2"></i></div>
                                <div>
                                    <div class="cat-name">{{ $category->name }}</div>
                                    <div class="cat-meta">
                                        {{ $category->children->count() }} زیردسته
                                    </div>
                                </div>
                            </div>
                            <div class="cat-manage-actions" onclick="event.stopPropagation()">
                                <button type="button" class="icon-btn" data-bs-toggle="modal" data-bs-target="#editCategoryModal{{ $category->id }}" title="ویرایش دسته"><i class="bi bi-pencil"></i></button>
                                <button type="button" class="icon-btn danger" data-bs-toggle="modal" data-bs-target="#deleteCategoryModal{{ $category->id }}" title="حذف دسته"><i class="bi bi-trash3"></i></button>
                                <i class="bi bi-chevron-down expand-caret"></i>
                            </div>
                        </div>

                        <div class="collapse {{ $loop->first ? 'show' : '' }}" id="catSub{{ $category->id }}">
                            <div class="subcat-list">

                                @forelse ($category->children as $child)
                                    <div class="subcat-row">
                                        <span class="subcat-name"><i class="bi bi-dot"></i> {{ $child->name }}</span>
                                        <span class="subcat-count">{{ $child->products->count() }} محصول</span>
                                        <div class="subcat-actions">
                                            <button type="button" class="icon-btn" data-bs-toggle="modal" data-bs-target="#editSubcategoryModal{{ $child->id }}" title="ویرایش"><i class="bi bi-pencil"></i></button>
                                            <button type="button" class="icon-btn danger" data-bs-toggle="modal" data-bs-target="#deleteSubcategoryModal{{ $child->id }}" title="حذف"><i class="bi bi-trash3"></i></button>
                                        </div>
                                    </div>
                                @empty
                                    <div class="empty-subcat-note">هنوز زیردسته‌ای برای این دسته ثبت نشده است.</div>
                                @endforelse

                                <button type="button" class="add-subcat-btn" data-bs-toggle="modal" data-bs-target="#addSubcategoryModal{{ $category->id }}">
                                    <i class="bi bi-plus-lg"></i> افزودن زیردسته به «{{ $category->name }}»
                                </button>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="empty-state">
                        <i class="bi bi-diagram-3"></i>
                        <p>هنوز هیچ دسته‌بندی‌ای ثبت نشده است.</p>
                    </div>
                @endforelse

            </div>
        </div>
    </div>

    <!-- ===================== Modals ===================== -->

    {{-- Add top-level category modal --}}
    <div class="modal fade" id="addCategoryModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form method="POST" action="{{ route('admin.categories.store') }}">
                    @csrf
                    <input type="hidden" name="parent_id" value="">
                    <div class="modal-header">
                        <h5 class="modal-title">افزودن دسته‌بندی جدید</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="بستن"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">نام دسته‌بندی</label>
                            <input type="text" name="name" class="form-control" placeholder="مثلاً تجهیزات پخت و پز" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-dark-custom" data-bs-dismiss="modal">انصراف</button>
                        <button type="submit" class="btn btn-dark-custom">ذخیره دسته‌بندی</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @foreach ($categories as $category)

        {{-- Edit category modal --}}
        <div class="modal fade" id="editCategoryModal{{ $category->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <form method="POST" action="{{ route('admin.categories.update', $category) }}">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="parent_id" value="">
                        <div class="modal-header">
                            <h5 class="modal-title">ویرایش دسته‌بندی</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="بستن"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label">نام دسته‌بندی</label>
                                <input type="text" name="name" class="form-control" value="{{ $category->name }}" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-dark-custom" data-bs-dismiss="modal">انصراف</button>
                            <button type="submit" class="btn btn-dark-custom">ذخیره تغییرات</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- Delete category modal --}}
        <div class="modal fade" id="deleteCategoryModal{{ $category->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body text-center py-4">
                        <div class="delete-icon-circle"><i class="bi bi-trash3"></i></div>
                        <h5 class="mt-3 mb-1">حذف «{{ $category->name }}»؟</h5>
                        <p class="text-muted mb-0" style="font-size:.88rem;">
                            با حذف این دسته، تمام زیردسته‌های آن نیز حذف خواهند شد. این عملیات قابل بازگشت نیست.
                        </p>
                    </div>
                    <div class="modal-footer justify-content-center border-0 pb-4">
                        <button type="button" class="btn btn-outline-dark-custom" data-bs-dismiss="modal">انصراف</button>
                        <form method="POST" action="{{ route('admin.categories.destroy', $category) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-delete-confirm">بله، حذف کن</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        {{-- Add subcategory modal (parent locked to this category) --}}
        <div class="modal fade" id="addSubcategoryModal{{ $category->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <form method="POST" action="{{ route('admin.categories.store') }}">
                        @csrf
                        <input type="hidden" name="parent_id" value="{{ $category->id }}">
                        <div class="modal-header">
                            <h5 class="modal-title">افزودن زیردسته به «{{ $category->name }}»</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="بستن"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label">نام زیردسته</label>
                                <input type="text" name="name" class="form-control" placeholder="مثلاً فر پیتزا" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-dark-custom" data-bs-dismiss="modal">انصراف</button>
                            <button type="submit" class="btn btn-dark-custom">ذخیره زیردسته</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        @foreach ($category->children as $child)

            {{-- Edit subcategory modal --}}
            <div class="modal fade" id="editSubcategoryModal{{ $child->id }}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <form method="POST" action="{{ route('admin.categories.update', $child) }}">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="parent_id" value="{{ $category->id }}">
                            <div class="modal-header">
                                <h5 class="modal-title">ویرایش زیردسته</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="بستن"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label class="form-label">دسته‌بندی والد</label>
                                    <input type="text" class="form-control" value="{{ $category->name }}" disabled>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">نام زیردسته</label>
                                    <input type="text" name="name" class="form-control" value="{{ $child->name }}" required>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-outline-dark-custom" data-bs-dismiss="modal">انصراف</button>
                                <button type="submit" class="btn btn-dark-custom">ذخیره تغییرات</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            {{-- Delete subcategory modal --}}
            <div class="modal fade" id="deleteSubcategoryModal{{ $child->id }}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-body text-center py-4">
                            <div class="delete-icon-circle"><i class="bi bi-trash3"></i></div>
                            <h5 class="mt-3 mb-1">حذف «{{ $child->name }}»؟</h5>
                            <p class="text-muted mb-0" style="font-size:.88rem;">این عملیات قابل بازگشت نیست.</p>
                        </div>
                        <div class="modal-footer justify-content-center border-0 pb-4">
                            <button type="button" class="btn btn-outline-dark-custom" data-bs-dismiss="modal">انصراف</button>
                            <form method="POST" action="{{ route('admin.categories.destroy', $child) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-delete-confirm">بله، حذف کن</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        @endforeach
    @endforeach

@endsection