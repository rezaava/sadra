@extends('admin.layout.master')

@section('title')
    دسته‌بندی خدمات | پنل مدیریت
@endsection

@section('head')
    <style>
        .admin-content {
            padding: 30px;
        }

        .page-header {
            background: #fffdf8;
            border: 1px solid rgba(34, 32, 95, .08);
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
        }

        .add-btn:hover {
            background: #423a9e;
            color: #fff;
        }

        .success-alert {
            background: #edf8f1;
            color: #247a45;
            padding: 14px 18px;
            border-radius: 15px;
            margin-bottom: 20px;
        }

        .card-box {
            background: #fffdf8;
            border: 1px solid rgba(34, 32, 95, .08);
            border-radius: 26px;
            overflow: hidden;
        }

        .table-wrapper {
            overflow-x: auto;
        }

        table {
            width: 100%;
            min-width: 700px;
            border-collapse: collapse;
        }

        th {
            background: #f7f4ee;
            color: #423a9e;
            padding: 17px;
            text-align: right;
            font-size: 13px;
        }

        td {
            padding: 16px;
            border-top: 1px solid rgba(34, 32, 95, .07);
            color: #34314e;
        }

        tr:hover td {
            background: #faf8f2;
        }

        .icon-box {
            width: 45px;
            height: 45px;
            background: #eeeefa;
            color: #423a9e;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
        }

        .badge {
            background: #eeeefa;
            color: #423a9e;
            border-radius: 9px;
            padding: 6px 10px;
            font-size: 12px;
        }

        .actions {
            display: flex;
            gap: 7px;
        }

        .action {
            width: 36px;
            height: 36px;
            border: 0;
            border-radius: 10px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            cursor: pointer;
        }

        .edit {
            background: #eeeefa;
            color: #423a9e;
        }

        .delete {
            background: #fbeeee;
            color: #b54444;
        }

        .empty {
            padding: 70px 20px;
            text-align: center;
            color: #77738e;
        }

        .empty i {
            font-size: 55px;
            color: #c7c2d2;
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
                    <h1>دسته‌بندی خدمات</h1>
                    <p>مدیریت دسته‌بندی‌های خدمات سایت</p>
                </div>

            </div>

            <a
                href="{{ route('admin.service-categories.create') }}"
                class="add-btn"
            >
                <i class="bi bi-plus-lg"></i>
                افزودن دسته‌بندی
            </a>

        </div>

        @if(session('success'))
            <div class="success-alert">
                <i class="bi bi-check-circle"></i>
                {{ session('success') }}
            </div>
        @endif

        <div class="card-box">

            @if($categories->isNotEmpty())

                <div class="table-wrapper">

                    <table>

                        <thead>
                        <tr>
                            <th>#</th>
                            <th>آیکن</th>
                            <th>نام</th>
                            <th>تعداد خدمات</th>
                            <th>تاریخ</th>
                            <th>عملیات</th>
                        </tr>
                        </thead>

                        <tbody>

                        @foreach($categories as $category)

                            <tr>

                                <td>
                                    {{ $loop->iteration }}
                                </td>

                                <td>
                                    <div class="icon-box">
                                        <i class="{{ $category->icon }}"></i>
                                    </div>
                                </td>

                                <td>
                                    <strong>{{ $category->name }}</strong>
                                </td>

                                <td>
                                    <span class="badge">
                                        {{ $category->services_count }} خدمت
                                    </span>
                                </td>

                                <td>
                                    {{ $category->created_at?->format('Y/m/d') }}
                                </td>

                                <td>

                                    <div class="actions">

                                        <a
                                            href="{{ route('admin.service-categories.edit', $category->id) }}"
                                            class="action edit"
                                            title="ویرایش"
                                        >
                                            <i class="bi bi-pencil"></i>
                                        </a>

                                        <form
                                            action="{{ route('admin.service-categories.destroy', $category->id) }}"
                                            method="POST"
                                            onsubmit="return confirm('با حذف این دسته‌بندی، خدمات وابسته نیز حذف می‌شوند. ادامه می‌دهید؟');"
                                        >
                                            @csrf
                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="action delete"
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

                <div class="empty">
                    <i class="bi bi-grid"></i>

                    <h3>دسته‌بندی‌ای ثبت نشده است</h3>

                    <p>برای شروع اولین دسته‌بندی را اضافه کنید.</p>
                </div>

            @endif

        </div>

    </div>
@endsection