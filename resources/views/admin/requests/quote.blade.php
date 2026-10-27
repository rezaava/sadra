@extends('admin.layout.master')

@section('title')
    درخواست‌های استعلام قیمت | پنل مدیریت
@endsection

@section('head')
    <style>
        .admin-content {
            padding: 32px
        }

        .requests-page {
            max-width: 1800px;
            margin: 0 auto
        }

        .page-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 24px
        }

        .page-title {
            display: flex;
            align-items: center;
            gap: 14px
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
            box-shadow: 0 10px 25px rgba(46, 43, 122, .18)
        }

        .page-title h4 {
            margin: 0;
            color: #1a1740;
            font-size: 20px;
            font-weight: 800
        }

        .page-title p {
            margin: 5px 0 0;
            color: #858585;
            font-size: 13px
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
            box-shadow: 0 5px 20px rgba(34, 32, 95, .05)
        }

        .table-card {
            background: #fffdf8;
            border: 1px solid rgba(34, 32, 95, .1);
            border-radius: 26px;
            overflow: hidden;
            box-shadow: 0 12px 35px rgba(34, 32, 95, .06)
        }

        .table-head {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
            padding: 22px 24px;
            border-bottom: 1px solid rgba(34, 32, 95, .08);
            background: rgba(247, 244, 238, .45)
        }

        .table-head-title {
            display: flex;
            align-items: center;
            gap: 10px;
            color: #1a1740;
            font-size: 15px;
            font-weight: 800
        }

        .table-head-title i {
            color: #423a9e;
            font-size: 18px
        }

        .table-head-sub {
            color: #929292;
            font-size: 12px
        }

        .admin-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0
        }

        .admin-table th,
        .admin-table td {
            padding: 15px 17px;
            text-align: right;
            border-bottom: 1px solid rgba(34, 32, 95, .07);
            white-space: nowrap;
            vertical-align: middle
        }

        .admin-table th {
            background: #faf8f3;
            color: #68648d;
            font-size: 12px;
            font-weight: 800
        }

        .admin-table td {
            color: #37344c;
            font-size: 13px
        }

        .admin-table tbody tr {
            transition: .2s ease
        }

        .admin-table tbody tr:hover {
            background: #faf9ff
        }

        .admin-table tbody tr:last-child td {
            border-bottom: none
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
            font-weight: 800
        }

        .name-cell {
            display: flex;
            align-items: center;
            gap: 11px
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
            font-weight: 800
        }

        .name-info strong {
            display: block;
            color: #27243d;
            font-size: 13px;
            font-weight: 800
        }

        .name-info span {
            display: block;
            margin-top: 3px;
            color: #a0a0a0;
            font-size: 11px
        }

        .brand-badge,
        .value-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 7px 11px;
            border-radius: 11px;
            background: #f0effa;
            color: #423a9e;
            font-size: 11px;
            font-weight: 700
        }

        .brand-badge::before {
            content: '';
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: #6b66c4
        }

        .email-cell {
            color: #5b57a0 !important
        }

        .phone-cell {
            direction: ltr;
            text-align: right;
            font-family: monospace;
            color: #4d4a63 !important
        }

        .date-cell {
            color: #858292 !important;
            font-size: 12px !important
        }

        .file-btn,
        .description-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            padding: 8px 12px;
            border: 0;
            border-radius: 10px;
            background: #f0effa;
            color: #423a9e;
            font-size: 12px;
            font-weight: 700;
            text-decoration: none;
            cursor: pointer;
            transition: .2s
        }

        .file-btn:hover,
        .description-btn:hover {
            background: #423a9e;
            color: #fff
        }

        .no-value {
            color: #aaa;
            font-size: 12px
        }

        .empty-state {
            padding: 75px 30px;
            text-align: center
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
            font-size: 26px
        }

        .empty-state strong {
            display: block;
            color: #38354d;
            font-size: 14px
        }

        .empty-state p {
            margin: 7px 0 0;
            color: #999;
            font-size: 12px
        }

        .quote-modal {
            position: fixed;
            inset: 0;
            z-index: 9999;
            display: none;
            align-items: center;
            justify-content: center;
            padding: 20px;
            background: rgba(16, 14, 44, .65);
            backdrop-filter: blur(5px)
        }

        .quote-modal.show {
            display: flex
        }

        .quote-modal-box {
            width: 100%;
            max-width: 600px;
            max-height: 85vh;
            overflow: hidden;
            border-radius: 22px;
            background: #fffdf8;
            box-shadow: 0 25px 80px rgba(0, 0, 0, .2);
            animation: modalIn .2s ease
        }

        .quote-modal-head {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
            padding: 20px 24px;
            border-bottom: 1px solid rgba(34, 32, 95, .1);
            background: #faf8f3
        }

        .quote-modal-head h3 {
            margin: 0;
            color: #1a1740;
            font-size: 17px;
            font-weight: 800
        }

        .quote-modal-close {
            width: 36px;
            height: 36px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 0;
            border-radius: 10px;
            background: #f0effa;
            color: #423a9e;
            font-size: 20px;
            cursor: pointer
        }

        .quote-modal-body {
            padding: 24px;
            overflow-y: auto;
            max-height: calc(85vh - 80px);
            color: #49465e;
            font-size: 14px;
            line-height: 2.2;
            white-space: pre-wrap;
            overflow-wrap: anywhere
        }

        @keyframes modalIn {
            from {
                opacity: 0;
                transform: translateY(10px) scale(.98)
            }

            to {
                opacity: 1;
                transform: translateY(0) scale(1)
            }
        }

        @media(max-width:768px) {
            .admin-content {
                padding: 18px
            }

            .page-top {
                align-items: flex-start
            }

            .page-title h4 {
                font-size: 17px
            }

            .page-title-icon {
                width: 45px;
                height: 45px;
                border-radius: 14px
            }

            .request-count {
                display: none
            }

            .table-card {
                border-radius: 20px
            }

            .table-head {
                padding: 18px
            }

            .table-head-sub {
                display: none
            }

            .admin-table th,
            .admin-table td {
                padding: 14px 15px
            }

            .quote-modal-box {
                border-radius: 17px
            }

            .quote-modal-head,
            .quote-modal-body {
                padding: 18px
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
                        <i class="bi bi-file-earmark-text"></i>
                    </div>
                    <div>
                        <h4>درخواست‌های استعلام قیمت</h4>
                        <p>مدیریت و مشاهده تمام اطلاعات درخواست‌های ثبت‌شده</p>
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
                    <div class="table-head-sub">آخرین درخواست‌ها در بالای لیست قرار دارند</div>
                </div>

                <div class="table-responsive">
                    <table class="admin-table">
                        <thead>
                            <tr>
                                <th>شناسه</th>
                                <th>نام و نام خانوادگی</th>
                                <th>برند / شرکت</th>
                                <th>ایمیل</th>
                                <th>شماره تماس</th>
                                <th>نوع محصول</th>
                                <th>نوع بسته‌بندی</th>
                                <th>تیراژ</th>
                                <th>زمان تحویل</th>
                                <th>ابعاد</th>
                                <th>ترتیب ورق</th>
                                <th>فایل پیوست</th>
                                <th>توضیحات پروژه</th>
                                <th>تاریخ ثبت</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($requests as $request)
                                @php
                                    $categories = [
                                        'carton' => 'کارتن مواد غذایی',
                                        'agriculture' => 'کارتن کشاورزی',
                                        'pharma' => 'کارتن دارویی',
                                        'hygiene' => 'کارتن بهداشتی',
                                        'industrial' => 'کارتن صنعتی',
                                        'other' => 'سایر',
                                    ];
                                    $packagings = [
                                        'export-carton' => 'کارتن چاپی',
                                        'gift-box' => 'کارتن لمینتی',
                                        'die-cut' => 'کارتن دایکاتی',
                                    ];
                                    $quantities = [
                                        'lt1000' => 'کمتر از ۳۰۰ عدد',
                                        'lt300' => 'کمتر از ۳۰۰ عدد',
                                        '1k-5k' => '۳۰۰ تا ۵٬۰۰۰ عدد',
                                        '5k-10k' => '۵٬۰۰۰ تا ۱۰٬۰۰۰ عدد',
                                        '10k-20k' => '۱۰٬۰۰۰ تا ۲۰٬۰۰۰ عدد',
                                        '20k-50k' => '۲۰٬۰۰۰ تا ۵۰٬۰۰۰ عدد',
                                        'gt20k' => 'بالای ۵۰٬۰۰۰ عدد',
                                        'gt50k' => 'بالای ۵۰٬۰۰۰ عدد',
                                    ];
                                    $timelines = [
                                        'urgent' => 'فوری — زیر ۱ ماه',
                                        '1to2m' => '۱ تا ۲ ماه',
                                        '2to3m' => '۲ تا ۳ ماه',
                                        'unsure' => 'هنوز مشخص نیست',
                                    ];
                                    $sheets = [
                                        '3-layer' => '۳ لایه',
                                        '5-layer' => '۵ لایه',
                                    ];
                                    $description = $request->message ?? $request->description;
                                    $filePath = $request->file ?? null;
                                @endphp
                                <tr>
                                    <td><span class="request-id">#{{ $request->id }}</span></td>
                                    <td>
                                        <div class="name-cell">
                                            <div class="name-avatar">{{ mb_substr($request->name ?? '؟', 0, 1) }}</div>
                                            <div class="name-info">
                                                <strong>{{ $request->name ?: 'ثبت نشده' }}</strong>
                                                <span>متقاضی استعلام قیمت</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td><span class="brand-badge">{{ $request->brand ?: 'ثبت نشده' }}</span></td>
                                    <td class="email-cell">{{ $request->email ?: '-' }}</td>
                                    <td class="phone-cell">{{ $request->phone ?: '-' }}</td>
                                    <td><span
                                            class="value-badge">{{ $categories[$request->category ?? ''] ?? ($request->category ?: '-') }}</span>
                                    </td>
                                    <td>{{ $packagings[$request->packaging ?? ''] ?? ($request->packaging ?: '-') }}</td>
                                    <td>{{ $quantities[$request->quantity ?? ''] ?? ($request->quantity ?: '-') }}</td>
                                    <td>{{ $timelines[$request->timeline ?? ''] ?? ($request->timeline ?: '-') }}</td>
                                    <td>{{ $request->dimensions ?: '-' }}</td>
                                    <td>{{ $sheets[$request->sheet ?? ''] ?? ($request->sheet ?: '-') }}</td>
                                    <td>
                                        @if ($filePath)
                                            <a class="file-btn" href="{{ asset('storage/' . $filePath) }}" target="_blank"
                                                rel="noopener">
                                                <i class="bi bi-file-earmark-arrow-down"></i>
                                                مشاهده فایل
                                            </a>
                                        @else
                                            <span class="no-value">بدون فایل</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($description && trim($description) !== '')
                                            <button type="button" class="description-btn"
                                                data-description="{{ $description }}" onclick="openDescription(this)">
                                                <i class="bi bi-chat-left-text"></i>
                                                مشاهده توضیحات
                                            </button>
                                        @else
                                            <span class="no-value">بدون توضیحات</span>
                                        @endif
                                    </td>
                                    <td class="date-cell">
                                        {{ $request->created_at ? verta($request->created_at)->format('Y/m/d H:i') : '-' }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="14">
                                        <div class="empty-state">
                                            <div class="empty-icon"><i class="bi bi-inbox"></i></div>
                                            <strong>هنوز درخواست استعلام قیمتی ثبت نشده است</strong>
                                            <p>پس از ثبت درخواست جدید، اطلاعات آن در این قسمت نمایش داده می‌شود.</p>
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

    <div class="quote-modal" id="descriptionModal" role="dialog" aria-modal="true" aria-labelledby="descriptionModalTitle"
        onclick="closeDescriptionOutside(event)">
        <div class="quote-modal-box">
            <div class="quote-modal-head">
                <h3 id="descriptionModalTitle">توضیحات پروژه</h3>
                <button type="button" class="quote-modal-close" onclick="closeDescription()"
                    aria-label="بستن">&times;</button>
            </div>
            <div class="quote-modal-body" id="descriptionModalBody"></div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        function openDescription(button) {
            const modal = document.getElementById('descriptionModal');
            const body = document.getElementById('descriptionModalBody');
            body.textContent = button.dataset.description || '';
            modal.classList.add('show');
            document.body.style.overflow = 'hidden';
        }

        function closeDescription() {
            document.getElementById('descriptionModal').classList.remove('show');
            document.body.style.overflow = '';
        }

        function closeDescriptionOutside(event) {
            if (event.target.id === 'descriptionModal') {
                closeDescription();
            }
        }

        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                closeDescription();
            }
        });
    </script>
@endsection
