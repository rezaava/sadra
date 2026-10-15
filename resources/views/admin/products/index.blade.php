@extends('admin.layout.master')

@section('title')
    محصولات | پنل مدیریت
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
            gap: 8px;
            background: #2e2b7a;
            color: #fff;
            text-decoration: none;
            border-radius: 14px;
            padding: 12px 20px;
            font-size: 14px;
            font-weight: 700;
            transition: .2s;
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

        .products-card {
            background: #fffdf8;
            border: 1px solid rgba(34, 32, 95, 0.08);
            border-radius: 26px;
            overflow: hidden;
        }

        .table-wrapper {
            overflow-x: auto;
        }

        .products-table {
            width: 100%;
            border-collapse: collapse;
            min-width: 950px;
        }

        .products-table th {
            background: #f7f4ee;
            color: #423a9e;
            font-size: 13px;
            font-weight: 800;
            padding: 17px 15px;
            text-align: right;
            white-space: nowrap;
        }

        .products-table td {
            padding: 17px 15px;
            border-top: 1px solid rgba(34, 32, 95, 0.07);
            color: #34314e;
            font-size: 14px;
            vertical-align: middle;
        }

        .products-table tbody tr {
            transition: .2s;
        }

        .products-table tbody tr:hover {
            background: #faf8f2;
        }

        .product-image {
            width: 65px;
            height: 65px;
            border-radius: 14px;
            object-fit: cover;
            border: 1px solid rgba(34, 32, 95, 0.08);
            background: #f7f4ee;
        }

        .no-image {
            width: 65px;
            height: 65px;
            border-radius: 14px;
            background: #f1eee7;
            color: #8d889d;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
        }

        .product-name {
            font-weight: 800;
            color: #1a1740;
            margin-bottom: 4px;
        }

        .product-title {
            color: #77738e;
            font-size: 12px;
        }

        .category-badge {
            display: inline-flex;
            align-items: center;
            padding: 6px 11px;
            border-radius: 10px;
            background: #eeeefa;
            color: #423a9e;
            font-size: 12px;
            font-weight: 700;
        }

        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 7px 11px;
            border-radius: 10px;
            font-size: 12px;
            font-weight: 700;
        }

        .status-active {
            background: #eaf7ef;
            color: #25834b;
        }

        .status-inactive {
            background: #fbeeee;
            color: #b54444;
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

        .toggle-btn {
            background: #f8f1e7;
            color: #a77836;
        }

        .toggle-btn:hover {
            background: #a77836;
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
        }
    </style>
@endsection

@section('main')
    <div class="admin-content">

        <div class="page-header">
            <div class="page-header-info">
                <div class="page-header-icon">
                    <i class="bi bi-box-seam"></i>
                </div>

                <div>
                    <h1>محصولات</h1>
                    <p>
                        مدیریت محصولات و وضعیت انتشار آن‌ها
                    </p>
                </div>
            </div>

            <a href="{{ route('admin.products.create') }}" class="add-btn">
                <i class="bi bi-plus-lg"></i>
                افزودن محصول
            </a>
        </div>

        @if(session('success'))
            <div class="alert-success">
                <i class="bi bi-check-circle me-1"></i>
                {{ session('success') }}
            </div>
        @endif

        <div class="products-card">

            @if($products->isNotEmpty())

                <div class="table-wrapper">
                    <table class="products-table">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>تصویر</th>
                            <th>محصول</th>
                            <th>دسته‌بندی</th>
                            <th>ویژگی‌ها</th>
                            <th>وضعیت</th>
                            <th>تاریخ</th>
                            <th>عملیات</th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach($products as $product)
                            <tr>

                                <td>
                                    {{ $loop->iteration }}
                                </td>

                                <td>
                                    @if($product->image)
                                        <img
                                            src="{{ asset($product->image) }}"
                                            alt="{{ $product->name }}"
                                            class="product-image"
                                        >
                                    @else
                                        <div class="no-image">
                                            <i class="bi bi-image"></i>
                                        </div>
                                    @endif
                                </td>

                                <td>
                                    <div class="product-name">
                                        {{ $product->name }}
                                    </div>

                                    <div class="product-title">
                                        {{ $product->title }}
                                    </div>
                                </td>

                                <td>
                                    @if($product->category)
                                        <span class="category-badge">
                                            {{ $product->category->name }}
                                        </span>
                                    @else
                                        <span class="text-muted">
                                            بدون دسته‌بندی
                                        </span>
                                    @endif
                                </td>

                                <td>
                                    <span class="category-badge">
                                        {{ $product->features->count() }} ویژگی
                                    </span>
                                </td>

                                <td>
                                    @if($product->is_active)
                                        <span class="status-badge status-active">
                                            <i class="bi bi-check-circle"></i>
                                            فعال
                                        </span>
                                    @else
                                        <span class="status-badge status-inactive">
                                            <i class="bi bi-x-circle"></i>
                                            غیرفعال
                                        </span>
                                    @endif
                                </td>

                                <td>
                                    {{ $product->created_at?->format('Y/m/d') }}
                                </td>

                                <td>
                                    <div class="actions">

                                        <a
                                            href="{{ route('admin.products.edit', $product->id) }}"
                                            class="action-btn edit-btn"
                                            title="ویرایش"
                                        >
                                            <i class="bi bi-pencil"></i>
                                        </a>

                                        <form
                                            action="{{ route('admin.products.toggle', $product->id) }}"
                                            method="POST"
                                        >
                                            @csrf
                                            @method('PATCH')

                                            <button
                                                type="submit"
                                                class="action-btn toggle-btn"
                                                title="تغییر وضعیت"
                                            >
                                                <i class="bi bi-power"></i>
                                            </button>
                                        </form>

                                        <form
                                            action="{{ route('admin.products.destroy', $product->id) }}"
                                            method="POST"
                                            onsubmit="return confirm('آیا از حذف این محصول مطمئن هستید؟');"
                                        >
                                            @csrf
                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="action-btn delete-btn"
                                                title="حذف"
                                            >
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>

                                    </div>
                                </td>

                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

            @else

                <div class="empty-state">
                    <i class="bi bi-box-seam"></i>

                    <h3>
                        هنوز محصولی ثبت نشده است
                    </h3>

                    <p>
                        برای شروع، اولین محصول را اضافه کنید.
                    </p>

                    <a
                        href="{{ route('admin.products.create') }}"
                        class="add-btn"
                    >
                        <i class="bi bi-plus-lg"></i>
                        افزودن محصول
                    </a>
                </div>

            @endif

        </div>

    </div>
@endsection