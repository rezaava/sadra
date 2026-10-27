@extends('admin.layout.master')

@section('title', 'جزئیات درخواست استخدام | مدیریت صدرا')

@section('head')
<style>
.join-detail{direction:rtl;color:#1a1740;padding:28px 0 50px}
.join-detail *{box-sizing:border-box}
.join-detail .panel{background:#fffdf8;border:1px solid #e6e1d8;border-radius:14px;padding:24px;margin-bottom:20px}
.join-detail .top{display:flex;justify-content:space-between;align-items:center;gap:16px;flex-wrap:wrap;margin-bottom:22px}
.join-detail h1{font-size:24px;margin:0 0 7px}
.join-detail h2{font-size:17px;margin:0 0 18px;padding-bottom:12px;border-bottom:1px solid #eee8df}
.join-detail .muted{color:#777185;font-size:13px;margin:0}
.join-detail .grid{display:grid;grid-template-columns:repeat(3,minmax(0,1fr));gap:12px}
.join-detail .item{padding:12px;background:#fff;border:1px solid #eee8df;border-radius:8px;min-width:0}
.join-detail .label{display:block;color:#777185;font-size:12px;margin-bottom:7px}
.join-detail .value{font-size:14px;white-space:pre-wrap;overflow-wrap:anywhere}
.join-detail .full{grid-column:1/-1}
.join-detail .table-wrap{overflow-x:auto}
.join-detail table{width:100%;border-collapse:collapse;min-width:650px}
.join-detail th,.join-detail td{padding:10px;border:1px solid #e6e1d8;text-align:right;vertical-align:top;font-size:13px}
.join-detail th{background:#f7f4ee}
.join-detail .btn{display:inline-block;text-decoration:none;border:0;border-radius:7px;padding:9px 14px;background:#1a1740;color:#fff;font-size:13px}
.join-detail .empty{color:#777185;font-size:13px}
@media(max-width:800px){
    .join-detail .grid{grid-template-columns:repeat(2,minmax(0,1fr))}
    .join-detail .panel{padding:16px}
}
@media(max-width:520px){
    .join-detail .grid{grid-template-columns:1fr}
}
</style>
@endsection

@section('main')
@php
    $arrayFields = [
        'education_records',
        'work_experiences',
        'languages',
        'other_courses',
        'computer_skills',
        'training_courses',
        'cooperation_types',
        'references',
    ];

    foreach ($arrayFields as $field) {
        $value = $request->getAttribute($field);

        while (is_string($value)) {
            $decoded = json_decode($value, true);

            if (json_last_error() !== JSON_ERROR_NONE) {
                break;
            }

            $value = $decoded;
        }

        $request->setAttribute($field, is_array($value) ? $value : []);
    }

    $yesNo = fn ($value) => is_null($value) ? '—' : ($value ? 'بله' : 'خیر');
    $display = fn ($value) => filled($value) ? $value : '—';

    $levels = [
        'weak' => 'ضعیف',
        'medium' => 'متوسط',
        'good' => 'خوب',
        'excellent' => 'عالی',
    ];

    $marital = [
        'single' => 'مجرد',
        'married' => 'متأهل',
    ];

    $residence = [
        'personal' => 'منزل شخصی',
        'rented' => 'منزل اجاره‌ای',
        'other' => 'سایر',
    ];

    $cooperation = [
        'full_time' => 'تمام‌وقت',
        'part_time' => 'پاره‌وقت',
        'off_site' => 'همکاری خارج از مرکز',
    ];

    $computer = [
        'windows' => 'Windows',
        'access' => 'Access',
        'excel' => 'Excel',
        'word' => 'Word',
        'internet' => 'Internet',
        'powerpoint' => 'PowerPoint',
        'typing' => 'تایپ',
    ];
@endphp

<div class="join-detail">
    <div class="wrap m-4">
        <div class="panel">
            <div class="top">
                <div>
                    <h1>جزئیات درخواست استخدام</h1>
                    <p class="muted">
                        شماره درخواست: #{{ $request->id }}
                        |
                        ثبت‌شده در: {{ $request->created_at?->format('Y/m/d H:i') }}
                    </p>
                </div>

                <a class="btn" href="{{ route('admin.requests.join') }}">
                    بازگشت به فهرست
                </a>
            </div>
        </div>

        {{-- ۱ ـ اطلاعات شخصی --}}
        <section class="panel">
            <h2>۱ ـ اطلاعات شخصی</h2>

            <div class="grid">
                @foreach([
                    'نام و نام خانوادگی' => $request->name,
                    'نام پدر' => $request->father_name,
                    'کد ملی' => $request->national_id,
                    'شماره شناسنامه' => $request->birth_certificate_number,
                    'تاریخ تولد' => $request->birth_date?->format('Y/m/d'),
                    'محل تولد' => $request->birth_place,
                    'تاریخ صدور شناسنامه' => $request->certificate_issue_date?->format('Y/m/d'),
                    'محل صدور شناسنامه' => $request->certificate_issue_place,
                    'دین و مذهب' => $request->religion,
                    'ملیت' => $request->nationality,
                    'وضعیت تأهل' => $marital[$request->marital_status] ?? $request->marital_status,
                    'وضعیت سلامت' => is_null($request->health_status) ? '—' : $yesNo($request->health_status),
                    'تلفن همراه' => $request->phone,
                    'تلفن ثابت' => $request->landline,
                    'ایمیل' => $request->email,
                ] as $label => $value)
                    <div class="item">
                        <span class="label">{{ $label }}</span>
                        <div class="value">{{ $display($value) }}</div>
                    </div>
                @endforeach

                <div class="item full">
                    <span class="label">توضیحات وضعیت سلامت</span>
                    <div class="value">{{ $display($request->health_description) }}</div>
                </div>
            </div>
        </section>

        {{-- ۲ ـ سوابق تحصیلی --}}
        <section class="panel">
            <h2>۲ ـ سوابق تحصیلی</h2>

            @if($request->education_records)
                <div class="table-wrap">
                    <table>
                        <thead>
                        <tr>
                            <th>مدرک</th>
                            <th>رشته</th>
                            <th>مؤسسه آموزشی</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($request->education_records as $row)
                            <tr>
                                <td>{{ $row['degree'] ?? '—' }}</td>
                                <td>{{ $row['field'] ?? '—' }}</td>
                                <td>{{ $row['institution'] ?? '—' }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p class="empty">اطلاعاتی ثبت نشده است.</p>
            @endif
        </section>

        {{-- ۳ ـ سوابق شغلی --}}
        <section class="panel">
            <h2>۳ ـ سوابق شغلی</h2>

            @if($request->work_experiences)
                <div class="table-wrap">
                    <table>
                        <thead>
                        <tr>
                            <th>شرکت</th>
                            <th>سمت</th>
                            <th>مدت</th>
                            <th>شروع</th>
                            <th>پایان</th>
                            <th>حقوق</th>
                            <th>علت ترک</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($request->work_experiences as $row)
                            <tr>
                                <td>{{ $row['company'] ?? '—' }}</td>
                                <td>{{ $row['position'] ?? '—' }}</td>
                                <td>{{ $row['duration'] ?? '—' }}</td>
                                <td>{{ $row['start_date'] ?? '—' }}</td>
                                <td>{{ $row['end_date'] ?? '—' }}</td>
                                <td>{{ $row['salary'] ?? '—' }}</td>
                                <td>{{ $row['leaving_reason'] ?? '—' }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p class="empty">اطلاعاتی ثبت نشده است.</p>
            @endif
        </section>

        {{-- ۴ ـ زبان‌های خارجی و دوره‌های دیگر --}}
        <section class="panel">
            <h2>۴ ـ زبان‌های خارجی و دوره‌های دیگر</h2>

            @if($request->languages)
                <div class="table-wrap">
                    <table>
                        <thead>
                        <tr>
                            <th>زبان</th>
                            <th>مکالمه</th>
                            <th>نوشتن</th>
                            <th>خواندن</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($request->languages as $row)
                            <tr>
                                <td>{{ $row['name'] ?? '—' }}</td>
                                <td>{{ $levels[$row['speaking'] ?? ''] ?? '—' }}</td>
                                <td>{{ $levels[$row['writing'] ?? ''] ?? '—' }}</td>
                                <td>{{ $levels[$row['reading'] ?? ''] ?? '—' }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p class="empty">اطلاعات زبان ثبت نشده است.</p>
            @endif

            <h2 style="margin-top:22px">دوره‌ها و آشنایی‌های دیگر</h2>

            <div class="grid">
                @forelse(($request->other_courses ?? []) as $i => $row)
                    <div class="item">
                        <span class="label">مورد {{ $i + 1 }}</span>
                        <div class="value">{{ $display($row['name'] ?? null) }}</div>
                    </div>
                @empty
                    <p class="empty">موردی ثبت نشده است.</p>
                @endforelse
            </div>
        </section>

        {{-- ۵ ـ مهارت‌های کامپیوتری و دوره‌های آموزشی --}}
        <section class="panel">
            <h2>۵ ـ مهارت‌های کامپیوتری و دوره‌های آموزشی</h2>

            <div class="grid">
                <div class="item full">
                    <span class="label">مهارت‌های انتخاب‌شده</span>
                    <div class="value">
                        {{ collect($request->computer_skills ?? [])->map(fn($skill) => $computer[$skill] ?? $skill)->implode('، ') ?: '—' }}
                    </div>
                </div>

                <div class="item full">
                    <span class="label">سایر مهارت‌ها</span>
                    <div class="value">{{ $display($request->computer_other) }}</div>
                </div>
            </div>

            @if($request->training_courses)
                <div class="table-wrap" style="margin-top:18px">
                    <table>
                        <thead>
                        <tr>
                            <th>دوره</th>
                            <th>مؤسسه</th>
                            <th>مدت</th>
                            <th>شروع</th>
                            <th>پایان</th>
                            <th>توضیحات</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($request->training_courses as $row)
                            <tr>
                                <td>{{ $row['name'] ?? '—' }}</td>
                                <td>{{ $row['institution'] ?? '—' }}</td>
                                <td>{{ $row['duration'] ?? '—' }}</td>
                                <td>{{ $row['start_date'] ?? '—' }}</td>
                                <td>{{ $row['end_date'] ?? '—' }}</td>
                                <td>{{ $row['description'] ?? '—' }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p class="empty" style="margin-top:14px">دوره‌ای ثبت نشده است.</p>
            @endif
        </section>

        {{-- ۶ تا ۹ ـ همکاری، شغل درخواستی و بیمه --}}
        <section class="panel">
            <h2>۶ تا ۹ ـ همکاری، شغل درخواستی و بیمه</h2>

            <div class="grid">
                <div class="item">
                    <span class="label">نحوه همکاری</span>
                    <div class="value">
                        {{ collect($request->cooperation_types ?? [])->map(fn($type) => $cooperation[$type] ?? $type)->implode('، ') ?: '—' }}
                    </div>
                </div>

                <div class="item">
                    <span class="label">شغل درخواستی</span>
                    <div class="value">{{ $display($request->requested_job) }}</div>
                </div>

                <div class="item">
                    <span class="label">تاریخ آمادگی شروع</span>
                    <div class="value">{{ $request->available_from?->format('Y/m/d') ?? '—' }}</div>
                </div>

                <div class="item">
                    <span class="label">سابقه بیمه</span>
                    <div class="value">
                        {{ is_null($request->has_insurance_history) ? '—' : $yesNo($request->has_insurance_history) }}
                    </div>
                </div>

                <div class="item">
                    <span class="label">مدت سابقه بیمه</span>
                    <div class="value">{{ $display($request->insurance_years) }}</div>
                </div>

                <div class="item full">
                    <span class="label">زمان‌بندی همکاری پاره‌وقت</span>
                    <div class="value">{{ $display($request->part_time_schedule) }}</div>
                </div>

                <div class="item full">
                    <span class="label">چگونگی آشنایی با شرکت</span>
                    <div class="value">{{ $display($request->how_found_company) }}</div>
                </div>
            </div>
        </section>

        {{-- ۱۰ ـ معرف‌ها --}}
        <section class="panel">
            <h2>۱۰ ـ معرف‌ها</h2>

            @if($request->references)
                <div class="table-wrap">
                    <table>
                        <thead>
                        <tr>
                            <th>نام</th>
                            <th>نسبت</th>
                            <th>شغل</th>
                            <th>نشانی محل کار</th>
                            <th>تلفن</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($request->references as $row)
                            <tr>
                                <td>{{ $row['name'] ?? '—' }}</td>
                                <td>{{ $row['relation'] ?? '—' }}</td>
                                <td>{{ $row['job'] ?? '—' }}</td>
                                <td>{{ $row['workplace_address'] ?? '—' }}</td>
                                <td>{{ $row['phone'] ?? '—' }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p class="empty">معرفی ثبت نشده است.</p>
            @endif
        </section>

        {{-- ۱۱ تا ۱۶ ـ اطلاعات تکمیلی --}}
        <section class="panel">
            <h2>۱۱ تا ۱۶ ـ وضعیت شغلی، برنامه آینده و تماس</h2>

            <div class="grid">
                <div class="item">
                    <span class="label">وضعیت اشتغال فعلی</span>
                    <div class="value">
                        {{ is_null($request->currently_employed) ? '—' : $yesNo($request->currently_employed) }}
                    </div>
                </div>

                <div class="item">
                    <span class="label">حقوق مورد انتظار</span>
                    <div class="value">{{ $display($request->expected_salary) }}</div>
                </div>

                <div class="item">
                    <span class="label">نوع محل سکونت</span>
                    <div class="value">
                        {{ $residence[$request->residence_type] ?? $request->residence_type ?? '—' }}
                    </div>
                </div>

                <div class="item full">
                    <span class="label">برنامه شغلی ده سال آینده</span>
                    <div class="value">{{ $display($request->career_plan) }}</div>
                </div>

                <div class="item full">
                    <span class="label">شغل موردنظر و آمادگی</span>
                    <div class="value">{{ $display($request->prepared_for_job) }}</div>
                </div>

                <div class="item full">
                    <span class="label">نرم‌افزارهای مورد تجربه</span>
                    <div class="value">{{ $display($request->experienced_software) }}</div>
                </div>

                <div class="item full">
                    <span class="label">نشانی محل سکونت</span>
                    <div class="value">{{ $display($request->residence_address) }}</div>
                </div>

                <div class="item full">
                    <span class="label">توضیحات محل سکونت</span>
                    <div class="value">{{ $display($request->residence_description) }}</div>
                </div>

                <div class="item">
                    <span class="label">نام تأییدکننده فرم</span>
                    <div class="value">{{ $display($request->signature_name) }}</div>
                </div>

                <div class="item">
                    <span class="label">تاریخ تأیید</span>
                    <div class="value">{{ $request->signature_date?->format('Y/m/d') ?? '—' }}</div>
                </div>
            </div>
        </section>
    </div>
</div>
@endsection