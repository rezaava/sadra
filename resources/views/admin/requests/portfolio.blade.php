@extends('admin.layout.master')

@section('title')
    درخواست‌های ارسال نمونه‌کار | پنل مدیریت
@endsection

@section('head')
    <style>
        .admin-content {
            padding: 32px;
        }

        .requests-page {
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
            box-shadow: 0 10px 25px rgba(46, 43, 122, 0.18);
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

        .request-count {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 15px;
            border-radius: 14px;
            background: #fffdf8;
            border: 1px solid rgba(34, 32, 95, 0.1);
            color: #423a9e;
            font-size: 13px;
            font-weight: 700;
            box-shadow: 0 5px 20px rgba(34, 32, 95, 0.05);
        }

        .table-card {
            background: #fffdf8;
            border: 1px solid rgba(34, 32, 95, 0.1);
            border-radius: 26px;
            overflow: hidden;
            box-shadow: 0 12px 35px rgba(34, 32, 95, 0.06);
        }

        .table-head {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
            padding: 22px 24px;
            border-bottom: 1px solid rgba(34, 32, 95, 0.08);
            background: rgba(247, 244, 238, 0.45);
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
            padding: 17px 20px;
            text-align: right;
            border-bottom: 1px solid rgba(34, 32, 95, 0.07);
            white-space: nowrap;
            vertical-align: middle;
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
            transition: 0.2s ease;
        }

        .admin-table tbody tr:hover {
            background: #faf9ff;
        }

        .admin-table tbody tr:last-child td {
            border-bottom: none;
        }

        .request-id {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 36px;
            height: 30px;
            padding: 0 9px;
            border-radius: 10px;
            background: #f0effa;
            color: #423a9e;
            font-size: 12px;
            font-weight: 800;
        }

        .name-cell {
            display: flex;
            align-items: center;
            gap: 11px;
        }

        .name-avatar {
            width: 38px;
            height: 38px;
            flex: 0 0 38px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 12px;
            background: linear-gradient(135deg, #eeeaff, #ddd9ff);
            color: #423a9e;
            font-size: 14px;
            font-weight: 800;
        }

        .name-info strong {
            display: block;
            color: #27243d;
            font-size: 13px;
            font-weight: 800;
        }

        .name-info span {
            display: block;
            margin-top: 3px;
            color: #a0a0a0;
            font-size: 11px;
        }

        .field-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 7px 11px;
            border-radius: 11px;
            background: #f0effa;
            color: #423a9e;
            font-size: 11px;
            font-weight: 700;
        }

        .field-badge::before {
            content: '';
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: #6b66c4;
        }

        .email-cell {
            color: #5b57a0 !important;
            direction: ltr;
            text-align: right;
        }

        .link-btn {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 7px 11px;
            border-radius: 11px;
            background: #f0effa;
            color: #423a9e;
            font-size: 11px;
            font-weight: 700;
            text-decoration: none;
            transition: 0.2s ease;
        }

        .link-btn:hover {
            background: #423a9e;
            color: #fff;
        }

        .file-btn {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 7px 11px;
            border-radius: 11px;
            background: #f7f4ee;
            border: 1px solid rgba(34, 32, 95, 0.08);
            color: #4d4a63;
            font-size: 11px;
            font-weight: 700;
            text-decoration: none;
            transition: 0.2s ease;
        }

        .file-btn:hover {
            background: #423a9e;
            color: #fff;
        }

        .no-file {
            color: #a0a0a0;
            font-size: 11px;
        }

        .request-message {
            max-width: 350px;
            min-width: 220px;
            white-space: normal !important;
            line-height: 1.9;
            color: #6f6c7d !important;
        }

        .date-cell {
            color: #858292 !important;
            font-size: 12px !important;
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

        @media (max-width: 1100px) {
            .admin-table th,
            .admin-table td {
                padding: 15px;
            }
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

            .table-card {
                border-radius: 20px;
            }

            .table-head {
                padding: 18px;
            }

            .table-head-sub {
                display: none;
            }

            .admin-table th,
            .admin-table td {
                padding: 14px 15px;
            }
        }
    </style>
@endsection

@section('main')

    <div class="admin-content">

        <div class="requests-page">

            <div class="page-top">

                <div class="page-title">

                    <div class="page-title-icon">
                        <i class="bi bi-briefcase"></i>
                    </div>

                    <div>
                        <h4>درخواست‌های ارسال نمونه‌کار</h4>
                        <p>
                            مدیریت و مشاهده نمونه‌کارهای ارسال‌شده توسط کاربران
                        </p>
                    </div>

                </div>

                <div class="request-count">
                    <i class="bi bi-inbox"></i>
                    {{ $requests->count() }} درخواست
                </div>

            </div>

            <div class="table-card">

                <div class="table-head">

                    <div class="table-head-title">
                        <i class="bi bi-list-ul"></i>
                        لیست نمونه‌کارها
                    </div>

                    <div class="table-head-sub">
                        آخرین ارسال‌ها در بالای لیست قرار دارند
                    </div>

                </div>

                <div class="table-responsive">

                    <table class="admin-table">

                        <thead>

                            <tr>
                                <th>#</th>
                                <th>متقاضی</th>
                                <th>ایمیل</th>
                                <th>حوزه فعالیت</th>
                                <th>نمونه‌کار</th>
                                <th>فایل</th>
                                <th>توضیحات</th>
                                <th>تاریخ ثبت</th>
                            </tr>

                        </thead>

                        <tbody>

                            @php
                                $fields = [
                                    'graphic' => 'گرافیک',
                                    'structure' => 'ساختار',
                                    'illustration' => 'تصویرسازی',
                                    'photography' => 'عکاسی',
                                    'other' => 'سایر',
                                ];
                            @endphp

                            @forelse($requests as $request)

                                <tr>

                                    <td>
                                        <span class="request-id">
                                            #{{ $request->id }}
                                        </span>
                                    </td>

                                    <td>

                                        <div class="name-cell">

                                            <div class="name-avatar">
                                                {{ mb_substr($request->name, 0, 1) }}
                                            </div>

                                            <div class="name-info">
                                                <strong>
                                                    {{ $request->name }}
                                                </strong>

                                                <span>
                                                    ارسال نمونه‌کار
                                                </span>
                                            </div>

                                        </div>

                                    </td>

                                    <td class="email-cell">
                                        {{ $request->email }}
                                    </td>

                                    <td>

                                        <span class="field-badge">
                                            {{ $fields[$request->field] ?? $request->field }}
                                        </span>

                                    </td>

                                    <td>

                                        <a
                                            href="{{ $request->link }}"
                                            target="_blank"
                                            rel="noopener noreferrer"
                                            class="link-btn"
                                        >
                                            <i class="bi bi-box-arrow-up-left"></i>
                                            مشاهده لینک
                                        </a>

                                    </td>

                                    <td>

                                        @if($request->file)

                                            <a
                                                href="{{ asset($request->file) }}"
                                                target="_blank"
                                                rel="noopener noreferrer"
                                                class="file-btn"
                                            >
                                                <i class="bi bi-file-earmark-arrow-down"></i>
                                                مشاهده فایل
                                            </a>

                                        @else

                                            <span class="no-file">
                                                بدون فایل
                                            </span>

                                        @endif

                                    </td>

                                    <td class="request-message">
                                        {{ $request->message ?: 'بدون توضیحات' }}
                                    </td>

                                    <td class="date-cell">
                                        {{ $request->created_at->format('Y/m/d') }}
                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td colspan="8">

                                        <div class="empty-state">

                                            <div class="empty-icon">
                                                <i class="bi bi-briefcase"></i>
                                            </div>

                                            <strong>
                                                هنوز نمونه‌کاری ارسال نشده است
                                            </strong>

                                            <p>
                                                وقتی کاربری نمونه‌کار خود را ارسال کند،
                                                در این قسمت نمایش داده خواهد شد.
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