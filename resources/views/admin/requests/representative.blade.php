@extends('admin.layout.master')

@section('title')
    درخواست‌های نمایندگی | پنل مدیریت
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

        .request-count i {
            font-size: 16px;
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

        .phone-cell {
            direction: ltr;
            text-align: right;
            font-family: monospace;
            color: #4d4a63;
        }

        .email-cell {
            color: #5b57a0;
        }

        .badge-type {
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

        .badge-type::before {
            content: '';
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: #6b66c4;
        }

        .request-message {
            max-width: 320px;
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
                        <i class="bi bi-building-add"></i>
                    </div>

                    <div>
                        <h4>درخواست‌های نمایندگی</h4>
                        <p>مدیریت و مشاهده درخواست‌های ثبت‌شده برای نمایندگی</p>
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
                        لیست درخواست‌ها
                    </div>

                    <div class="table-head-sub">
                        آخرین درخواست‌ها در بالای لیست قرار دارند
                    </div>

                </div>


                <div class="table-responsive">

                    <table class="admin-table">

                        <thead>
                            <tr>
                                <th>#</th>
                                <th>متقاضی</th>
                                <th>شهر</th>
                                <th>شماره تماس</th>
                                <th>ایمیل</th>
                                <th>نوع نمایندگی</th>
                                <th>توضیحات</th>
                                <th>تاریخ ثبت</th>
                            </tr>
                        </thead>

                        <tbody>

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
                                                <strong>{{ $request->name }}</strong>
                                                <span>متقاضی نمایندگی</span>
                                            </div>

                                        </div>

                                    </td>

                                    <td>
                                        {{ $request->city }}
                                    </td>

                                    <td class="phone-cell">
                                        {{ $request->phone }}
                                    </td>

                                    <td class="email-cell">
                                        {{ $request->email }}
                                    </td>

                                    <td>

                                        <span class="badge-type">
                                            {{ match ($request->type) {
                                                'sales' => 'فروش',
                                                'online' => 'فروش آنلاین',
                                                'regional' => 'نمایندگی منطقه‌ای',
                                                'other' => 'سایر',
                                                default => $request->type,
                                            } }}
                                        </span>

                                    </td>

                                    <td class="request-message">
                                        {{ $request->message ?: 'بدون توضیحات' }}
                                    </td>

                                    <td class="date-cell">
                                        {{ $request->created_at ? verta($request->created_at)->format('Y/m/d') : '-' }}
                                    </td>

                                </tr>

                            @empty

                                <tr>
                                    <td colspan="8">

                                        <div class="empty-state">

                                            <div class="empty-icon">
                                                <i class="bi bi-inbox"></i>
                                            </div>

                                            <strong>
                                                هنوز درخواست نمایندگی ثبت نشده است
                                            </strong>

                                            <p>
                                                وقتی درخواستی ثبت شود، در این قسمت نمایش داده خواهد شد.
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
