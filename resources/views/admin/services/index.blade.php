@extends('admin.layout.master')

@section('title')
    خدمات | پنل مدیریت
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

        .header-info {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .header-icon {
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

        .header-actions {
            display: flex;
            gap: 10px;
        }

        .btn-main {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: #2e2b7a;
            color: #fff;
            text-decoration: none;
            border-radius: 14px;
            padding: 12px 20px;
            font-weight: 700;
        }

        .btn-secondary {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: #f7f4ee;
            color: #423a9e;
            text-decoration: none;
            border-radius: 14px;
            padding: 12px 20px;
            font-weight: 700;
        }

        .success {
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
            min-width: 1000px;
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
            padding: 17px;
            border-top: 1px solid rgba(34, 32, 95, .07);
            color: #34314e;
            vertical-align: middle;
        }

        tr:hover td {
            background: #faf8f2;
        }

        .service-icon {
            width: 50px;
            height: 50px;
            border-radius: 14px;
            background: #eeeefa;
            color: #423a9e;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
        }

        .name {
            font-weight: 800;
            color: #1a1740;
        }

        .category {
            display: inline-block;
            background: #eeeefa;
            color: #423a9e;
            padding: 6px 10px;
            border-radius: 9px;
            font-size: 12px;
        }

        .count {
            color: #423a9e;
            font-weight: 700;
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

            <div class="header-info">

                <div class="header-icon">
                    <i class="bi bi-tools"></i>
                </div>

                <div>
                    <h1>خدمات</h1>
                    <p>مدیریت خدمات، آیتم‌ها و ویژگی‌های خدمات</p>
                </div>

            </div>

            <div class="header-actions">

                <a
                    href="{{ route('admin.service-categories.index') }}"
                    class="btn-secondary"
                >
                    <i class="bi bi-grid"></i>
                    دسته‌بندی‌ها
                </a>

                <a
                    href="{{ route('admin.services.create') }}"
                    class="btn-main"
                >
                    <i class="bi bi-plus-lg"></i>
                    افزودن خدمت
                </a>

            </div>

        </div>

        @if(session('success'))
            <div class="success">
                <i class="bi bi-check-circle"></i>
                {{ session('success') }}
            </div>
        @endif

        <div class="card-box">

            @if($services->isNotEmpty())

                <div class="table-wrapper">

                    <table>

                        <thead>
                        <tr>
                            <th>#</th>
                            <th>آیکن</th>
                            <th>نام خدمت</th>
                            <th>دسته‌بندی</th>
                            <th>پروژه‌ها</th>
                            <th>برندها</th>
                            <th>سابقه</th>
                            <th>آیتم‌ها</th>
                            <th>عملیات</th>
                        </tr>
                        </thead>

                        <tbody>

                        @foreach($services as $service)

                            <tr>

                                <td>
                                    {{ $loop->iteration }}
                                </td>

                                <td>
                                    <div class="service-icon">
                                        <i class="{{ $service->icon }}"></i>
                                    </div>
                                </td>

                                <td>
                                    <div class="name">
                                        {{ $service->name }}
                                    </div>
                                </td>

                                <td>
                                    <span class="category">
                                        {{ $service->category?->name ?? 'بدون دسته‌بندی' }}
                                    </span>
                                </td>

                                <td>
                                    <span class="count">
                                        {{ $service->projects_count }}
                                    </span>
                                </td>

                                <td>
                                    <span class="count">
                                        {{ $service->brands_count }}
                                    </span>
                                </td>

                                <td>
                                    {{ $service->experience_years }} سال
                                </td>

                                <td>
                                    <span class="category">
                                        {{ $service->items_count }} آیتم
                                    </span>
                                </td>

                                <td>

                                    <div class="actions">

                                        <a
                                            href="{{ route('admin.services.edit', $service->id) }}"
                                            class="action edit"
                                            title="ویرایش"
                                        >
                                            <i class="bi bi-pencil"></i>
                                        </a>

                                        <form
                                            action="{{ route('admin.services.destroy', $service->id) }}"
                                            method="POST"
                                            onsubmit="return confirm('آیا از حذف این خدمت مطمئن هستید؟');"
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

                    <i class="bi bi-tools"></i>

                    <h3>هنوز خدمتی ثبت نشده است</h3>

                    <p>برای شروع اولین خدمت را اضافه کنید.</p>

                </div>

            @endif

        </div>

    </div>
@endsection