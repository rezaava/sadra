@extends('admin.layout.master')

@section('title')
درخواست‌های دعوت به همکاری | پنل مدیریت
@endsection

@section('head') <style>
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

    .email-cell {
        color: #5b57a0 !important;
    }

    .phone-cell {
        direction: ltr;
        text-align: right;
        font-family: monospace;
        color: #4d4a63 !important;
    }

    .badge-field {
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

    .badge-field::before {
        content: '';
        width: 6px;
        height: 6px;
        border-radius: 50%;
        background: #6b66c4;
    }

    .experience {
        color: #625f75;
        font-size: 12px;
    }

    .action-btn {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 7px 11px;
        border-radius: 10px;
        text-decoration: none;
        font-size: 11px;
        font-weight: 700;
        transition: 0.2s ease;
    }

    .portfolio-btn {
        background: #eef4ff;
        color: #4268a9;
    }

    .portfolio-btn:hover {
        background: #dfeaff;
        color: #315795;
    }

    .resume-btn {
        background: #fff0f0;
        color: #b64d4d;
    }

    .resume-btn:hover {
        background: #ffe2e2;
        color: #a63e3e;
    }

    .empty-action {
        color: #aaa;
        font-size: 12px;
    }

    .request-message {
        max-width: 300px;
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
                    <i class="bi bi-person-plus"></i>
                </div>

                <div>
                    <h4>درخواست‌های دعوت به همکاری</h4>
                    <p>مدیریت و مشاهده درخواست‌های همکاری ثبت‌شده</p>
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
                            <th>ایمیل</th>
                            <th>شماره تماس</th>
                            <th>حوزه فعالیت</th>
                            <th>سابقه</th>
                            <th>نمونه‌کار</th>
                            <th>رزومه</th>
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
                                            <span>متقاضی همکاری</span>
                                        </div>

                                    </div>

                                </td>

                                <td class="email-cell">
                                    {{ $request->email }}
                                </td>

                                <td class="phone-cell">
                                    {{ $request->phone }}
                                </td>

                                <td>

                                    <span class="badge-field">

                                        {{ match($request->field) {
                                            'graphic' => 'گرافیک',
                                            'structure' => 'سازه',
                                            'production' => 'تولید',
                                            'marketing' => 'بازاریابی',
                                            'internship' => 'کارآموزی',
                                            'other' => 'سایر',
                                            default => $request->field,
                                        } }}

                                    </span>

                                </td>

                                <td class="experience">

                                    {{ match($request->experience) {
                                        'lt1' => 'کمتر از ۱ سال',
                                        '1to3' => '۱ تا ۳ سال',
                                        '3to5' => '۳ تا ۵ سال',
                                        'gt5' => 'بیشتر از ۵ سال',
                                        default => 'ثبت نشده',
                                    } }}

                                </td>

                                <td>

                                    @if($request->portfolio)

                                        <a
                                            href="{{ $request->portfolio }}"
                                            target="_blank"
                                            class="action-btn portfolio-btn"
                                        >
                                            <i class="bi bi-link-45deg"></i>
                                            مشاهده
                                        </a>

                                    @else

                                        <span class="empty-action">-</span>

                                    @endif

                                </td>

                                <td>

                                    @if($request->resume)

                                        <a
                                            href="{{ asset($request->resume) }}"
                                            target="_blank"
                                            class="action-btn resume-btn"
                                        >
                                            <i class="bi bi-file-earmark-pdf"></i>
                                            رزومه
                                        </a>

                                    @else

                                        <span class="empty-action">-</span>

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

                                <td colspan="10">

                                    <div class="empty-state">

                                        <div class="empty-icon">
                                            <i class="bi bi-inbox"></i>
                                        </div>

                                        <strong>
                                            هنوز درخواست دعوت به همکاری ثبت نشده است
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
