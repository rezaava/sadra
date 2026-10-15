@extends('admin.layout.master')

@section('title')
    مدیریت بلاگ‌ها | پنل مدیریت
@endsection

@section('head')
    <style>
        .admin-content {
            padding: 32px;
        }

        .blogs-page {
            max-width: 1600px;
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

        .page-actions {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .request-count {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 15px;
            border-radius: 14px;
            background: #fffdf8;
            border: 1px solid rgba(34, 32, 95, .1);
            color: #423a9e;
            font-size: 13px;
            font-weight: 700;
            box-shadow: 0 5px 20px rgba(34, 32, 95, .05);
        }

        .add-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 11px 17px;
            border-radius: 13px;
            background: #2e2b7a;
            color: #fff;
            text-decoration: none;
            font-size: 13px;
            font-weight: 700;
            box-shadow: 0 8px 20px rgba(46, 43, 122, .18);
            transition: .2s ease;
        }

        .add-btn:hover {
            background: #423a9e;
            color: #fff;
            transform: translateY(-1px);
        }

        .alert-success {
            margin-bottom: 20px;
            padding: 13px 17px;
            border-radius: 14px;
            background: #edf8f1;
            border: 1px solid #d4edda;
            color: #277443;
            font-size: 13px;
        }

        .table-card {
            background: #fffdf8;
            border: 1px solid rgba(34, 32, 95, .1);
            border-radius: 26px;
            overflow: hidden;
            box-shadow: 0 12px 35px rgba(34, 32, 95, .06);
        }

        .table-head {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 22px 24px;
            border-bottom: 1px solid rgba(34, 32, 95, .08);
            background: rgba(247, 244, 238, .45);
        }

        .table-head-title {
            display: flex;
            align-items: center;
            gap: 10px;
            color: #1a1740;
            font-size: 15px;
            font-weight: 800;
        }

        .table-head-title i {
            color: #423a9e;
            font-size: 18px;
        }

        .table-head-sub {
            color: #929292;
            font-size: 12px;
        }

        .admin-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
        }

        .admin-table th,
        .admin-table td {
            padding: 16px 20px;
            text-align: right;
            border-bottom: 1px solid rgba(34, 32, 95, .07);
            vertical-align: middle;
            white-space: nowrap;
        }

        .admin-table th {
            background: #faf8f3;
            color: #68648d;
            font-size: 12px;
            font-weight: 800;
        }

        .admin-table td {
            color: #37344c;
            font-size: 13px;
        }

        .admin-table tbody tr {
            transition: .2s ease;
        }

        .admin-table tbody tr:hover {
            background: #faf9ff;
        }

        .admin-table tbody tr:last-child td {
            border-bottom: none;
        }

        .blog-image {
            width: 65px;
            height: 48px;
            border-radius: 12px;
            overflow: hidden;
            background: #f0effa;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .blog-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .blog-image i {
            color: #423a9e;
            font-size: 20px;
        }

        .blog-icon {
            width: 48px;
            height: 48px;
            border-radius: 13px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f0effa;
            color: #423a9e;
            overflow: hidden;
        }

        .blog-icon svg {
            width: 28px;
            height: 28px;
        }

        .blog-title {
            max-width: 280px;
            white-space: normal !important;
        }

        .blog-title strong {
            display: block;
            color: #27243d;
            font-size: 13px;
            font-weight: 800;
            line-height: 1.8;
        }

        .blog-short-text {
            margin-top: 4px;
            color: #999;
            font-size: 11px;
            line-height: 1.7;
        }

        .tag-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 7px 11px;
            border-radius: 11px;
            background: #eeeaff;
            color: #423a9e;
            font-size: 11px;
            font-weight: 700;
        }

        .reading-time {
            color: #656276;
            font-size: 12px;
        }

        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 7px 11px;
            border-radius: 11px;
            font-size: 11px;
            font-weight: 700;
        }

        .status-badge.active {
            background: #edf8f1;
            color: #287544;
        }

        .status-badge.inactive {
            background: #fff0f0;
            color: #b64d4d;
        }

        .status-dot {
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: currentColor;
        }

        .action-buttons {
            display: flex;
            align-items: center;
            gap: 7px;
        }

        .action-btn {
            width: 34px;
            height: 34px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
            text-decoration: none;
            border: none;
            cursor: pointer;
            transition: .2s ease;
        }

        .edit-btn {
            background: #eef4ff;
            color: #4268a9;
        }

        .edit-btn:hover {
            background: #dfeaff;
            color: #315795;
        }

        .toggle-btn {
            background: #fff6e7;
            color: #ad7925;
        }

        .toggle-btn:hover {
            background: #ffedcc;
            color: #986719;
        }

        .delete-btn {
            background: #fff0f0;
            color: #b64d4d;
        }

        .delete-btn:hover {
            background: #ffe2e2;
            color: #a63e3e;
        }

        .empty-state {
            padding: 75px 30px;
            text-align: center;
        }

        .empty-icon {
            width: 65px;
            height: 65px;
            margin: 0 auto 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 20px;
            background: #f0effa;
            color: #423a9e;
            font-size: 26px;
        }

        .empty-state strong {
            display: block;
            color: #38354d;
            font-size: 14px;
        }

        .empty-state p {
            margin: 7px 0 0;
            color: #999;
            font-size: 12px;
        }

        @media (max-width: 768px) {
            .admin-content {
                padding: 18px;
            }

            .page-top {
                align-items: flex-start;
            }

            .page-title h4 {
                font-size: 17px;
            }

            .page-title-icon {
                width: 45px;
                height: 45px;
                border-radius: 14px;
            }

            .request-count {
                display: none;
            }

            .add-btn {
                padding: 10px 12px;
            }

            .add-btn span {
                display: none;
            }

            .table-card {
                border-radius: 20px;
            }

            .table-head {
                padding: 18px;
            }

            .table-head-sub {
                display: none;
            }
        }
    </style>
@endsection

@section('main')

    <div class="admin-content">
        <div class="blogs-page">

            <div class="page-top">

                <div class="page-title">

                    <div class="page-title-icon">
                        <i class="bi bi-journal-text"></i>
                    </div>

                    <div>
                        <h4>مدیریت بلاگ‌ها</h4>
                        <p>مدیریت، ویرایش و انتشار مقالات سایت</p>
                    </div>

                </div>

                <div class="page-actions">

                    <div class="request-count">
                        <i class="bi bi-journal-text"></i>
                        {{ $blogs->count() }} بلاگ
                    </div>

                    <a href="{{ route('admin.blogs.create') }}" class="add-btn">
                        <i class="bi bi-plus-lg"></i>
                        <span>افزودن بلاگ</span>
                    </a>

                </div>

            </div>

            @if(session('success'))
                <div class="alert-success">
                    <i class="bi bi-check-circle"></i>
                    {{ session('success') }}
                </div>
            @endif

            <div class="table-card">

                <div class="table-head">

                    <div class="table-head-title">
                        <i class="bi bi-list-ul"></i>
                        لیست بلاگ‌ها
                    </div>

                    <div class="table-head-sub">
                        جدیدترین بلاگ‌ها در بالای لیست قرار دارند
                    </div>

                </div>

                <div class="table-responsive">

                    <table class="admin-table">

                        <thead>
                            <tr>
                                <th>#</th>
                                <th>تصویر</th>
                                <th>آیکن</th>
                                <th>عنوان</th>
                                <th>تگ اصلی</th>
                                <th>زمان مطالعه</th>
                                <th>وضعیت</th>
                                <th>تاریخ</th>
                                <th>عملیات</th>
                            </tr>
                        </thead>

                        <tbody>

                            @forelse($blogs as $blog)

                                <tr>

                                    <td>
                                        <span class="request-id">
                                            #{{ $blog->id }}
                                        </span>
                                    </td>

                                    <td>

                                        <div class="blog-image">

                                            @if($blog->image)
                                                <img
                                                    src="{{ asset($blog->image) }}"
                                                    alt="{{ $blog->title }}"
                                                >
                                            @else
                                                <i class="bi bi-image"></i>
                                            @endif

                                        </div>

                                    </td>

                                    <td>

                                        <div class="blog-icon">
                                            @if($blog->icon)
                                                {!! $blog->icon !!}
                                            @else
                                                <i class="bi bi-code-square"></i>
                                            @endif
                                        </div>

                                    </td>

                                    <td>

                                        <div class="blog-title">

                                            <strong>
                                                {{ $blog->title }}
                                            </strong>

                                            <div class="blog-short-text">
                                                {{ \Illuminate\Support\Str::limit($blog->short_text, 80) }}
                                            </div>

                                        </div>

                                    </td>

                                    <td>

                                        <span class="tag-badge">
                                            <i class="bi bi-tag"></i>
                                            {{ $blog->main_tag }}
                                        </span>

                                    </td>

                                    <td class="reading-time">
                                        <i class="bi bi-clock"></i>
                                        {{ $blog->reading_time }}
                                    </td>

                                    <td>

                                        @if($blog->is_active)

                                            <span class="status-badge active">
                                                <span class="status-dot"></span>
                                                فعال
                                            </span>

                                        @else

                                            <span class="status-badge inactive">
                                                <span class="status-dot"></span>
                                                غیرفعال
                                            </span>

                                        @endif

                                    </td>

                                    <td>
                                        {{ $blog->created_at->format('Y/m/d') }}
                                    </td>

                                    <td>

                                        <div class="action-buttons">

                                            <a
                                                href="{{ route('admin.blogs.edit', $blog) }}"
                                                class="action-btn edit-btn"
                                                title="ویرایش"
                                            >
                                                <i class="bi bi-pencil"></i>
                                            </a>

                                            <form
                                                action="{{ route('admin.blogs.toggle', $blog) }}"
                                                method="POST"
                                            >
                                                @csrf
                                                @method('PATCH')

                                                <button
                                                    type="submit"
                                                    class="action-btn toggle-btn"
                                                    title="تغییر وضعیت"
                                                >
                                                    <i class="bi bi-toggle2-on"></i>
                                                </button>
                                            </form>

                                            <form
                                                action="{{ route('admin.blogs.destroy', $blog) }}"
                                                method="POST"
                                                onsubmit="return confirm('آیا از حذف این بلاگ مطمئن هستید؟');"
                                            >
                                                @csrf
                                                @method('DELETE')

                                                <button
                                                    type="submit"
                                                    class="action-btn delete-btn"
                                                    title="حذف"
                                                >
                                                    <i class="bi bi-trash3"></i>
                                                </button>
                                            </form>

                                        </div>

                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td colspan="9">

                                        <div class="empty-state">

                                            <div class="empty-icon">
                                                <i class="bi bi-journal-x"></i>
                                            </div>

                                            <strong>
                                                هنوز بلاگی ثبت نشده است
                                            </strong>

                                            <p>
                                                برای شروع، اولین بلاگ سایت را ایجاد کنید.
                                            </p>

                                        </div>

                                    </td>

                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

        </div>
    </div>

@endsection