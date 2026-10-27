@extends('layout.master')

@section('head')
    <link rel="stylesheet" href="{{ asset('asset/css/join.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/persian-datepicker@1.2.0/dist/css/persian-datepicker.min.css">
    <title>فرم استخدام | صنایع بسته‌بندی صدرا</title>
    <style>
        .employment-page {
            direction: rtl;
            color: #1a1740;
            padding: 36px 0 60px
        }

        .employment-page * {
            box-sizing: border-box
        }

        .employment-card {
            max-width: 1200px;
            margin: auto;
            padding: 28px;
            background: #fffdf8;
            border: 1px solid #e6e1d8;
            border-radius: 16px
        }

        .employment-head {
            display: flex;
            justify-content: space-between;
            gap: 20px;
            align-items: center;
            flex-wrap: wrap;
            padding-bottom: 22px;
            margin-bottom: 24px;
            border-bottom: 2px solid #cdb18e
        }

        .employment-head h1 {
            font-size: 26px;
            margin: 0 0 8px;
            font-weight: 800
        }

        .employment-head p {
            margin: 0;
            color: #6b687d
        }

        .employment-meta {
            display: grid;
            grid-template-columns: repeat(1, minmax(120px, 1fr));
            gap: 12px
        }

        .employment-section {
            padding: 22px;
            margin-bottom: 22px;
            background: #fff;
            border: 1px solid #e6e1d8;
            border-radius: 12px
        }

        .employment-section h2 {
            font-size: 18px;
            margin: 0 0 20px;
            padding-bottom: 12px;
            border-bottom: 1px solid #eee8df
        }

        .employment-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 16px
        }

        .employment-grid.two {
            grid-template-columns: repeat(2, minmax(0, 1fr))
        }

        .employment-field {
            min-width: 0
        }

        .employment-field.full {
            grid-column: 1/-1
        }

        .employment-page label,
        .employment-page .field-label {
            display: block;
            font-size: 13px;
            font-weight: 700;
            margin-bottom: 7px
        }

        .employment-page input:not([type=checkbox]):not([type=radio]),
        .employment-page select,
        .employment-page textarea {
            width: 100%;
            min-height: 43px;
            padding: 10px 12px;
            border: 1px solid #dcd8e2;
            border-radius: 7px;
            background: #fff;
            color: #1a1740;
            font: inherit;
            font-size: 14px
        }

        .employment-page textarea {
            min-height: 100px;
            resize: vertical
        }

        .employment-page input:focus,
        .employment-page select:focus,
        .employment-page textarea:focus {
            outline: 2px solid #cdb18e;
            outline-offset: 1px
        }

        .employment-options {
            display: flex;
            flex-wrap: wrap;
            gap: 16px
        }

        .employment-options label {
            display: flex;
            align-items: center;
            gap: 7px;
            margin: 0;
            font-weight: 500
        }

        .employment-options input {
            accent-color: #423a9e
        }

        .employment-table-wrap {
            overflow-x: auto
        }

        .employment-table {
            width: 100%;
            min-width: 780px;
            border-collapse: collapse
        }

        .employment-table th,
        .employment-table td {
            border: 1px solid #e6e1d8;
            padding: 9px;
            vertical-align: top
        }

        .employment-table th {
            background: #f7f4ee;
            font-size: 12px;
            text-align: right
        }

        .employment-table td input,
        .employment-table td select,
        .employment-table td textarea {
            min-width: 110px
        }

        .employment-add,
        .employment-remove {
            border: 0;
            border-radius: 7px;
            padding: 9px 13px;
            cursor: pointer;
            font: inherit;
            font-size: 13px
        }

        .employment-add {
            margin-top: 12px;
            background: #1a1740;
            color: #fff
        }

        .employment-remove {
            background: #fbe8e6;
            color: #8d2820
        }

        .employment-note {
            font-size: 12px;
            color: #777185;
            line-height: 1.9;
            margin-top: 12px
        }

        .employment-alert {
            padding: 14px 16px;
            border-radius: 8px;
            margin-bottom: 20px
        }

        .employment-alert.success {
            background: #e7f6eb;
            color: #176336
        }

        .employment-alert.errors {
            background: #fff0ee;
            color: #8d2820
        }

        .employment-error {
            display: block;
            color: #b42318;
            font-size: 12px;
            margin-top: 5px
        }

        .employment-submit {
            display: flex;
            gap: 12px;
            align-items: center;
            flex-wrap: wrap
        }

        .employment-submit button {
            border: 0;
            border-radius: 8px;
            padding: 13px 24px;
            background: #1a1740;
            color: #fff;
            font: inherit;
            font-weight: 700;
            cursor: pointer
        }

        .employment-submit a {
            color: #423a9e
        }

        .jalali-date {
            direction: ltr;
            text-align: left;
            cursor: pointer;
            background: #fff
        }

        .persian-datepicker-container {
            z-index: 99999 !important
        }

        @media(max-width:800px) {
            .employment-card {
                padding: 16px
            }

            .employment-grid,
            .employment-grid.two {
                grid-template-columns: repeat(2, minmax(0, 1fr))
            }

            .employment-section {
                padding: 16px
            }
        }

        @media(max-width:520px) {

            .employment-grid,
            .employment-grid.two {
                grid-template-columns: 1fr
            }

            .employment-meta {
                width: 100%
            }

            .employment-head h1 {
                font-size: 21px
            }
        }
    </style>
@endsection

@section('main')
    <div class="employment-page">
        <div class="wrap">
            <form class="employment-card" id="employmentForm" method="POST" action="{{ route('join.store') }}">
                @csrf

                <div class="employment-head">
                    <div>
                        <h1>فرم استخدام صنایع بسته‌بندی صدرا</h1>
                        <p>لطفاً اطلاعات زیر را با دقت تکمیل کنید.</p>
                    </div>
                    <div class="employment-meta">
                        <div class="employment-field">
                            <label for="form_date">تاریخ تکمیل فرم</label>
                            <input id="form_date" type="text" class="jalali-date" value="{{ now()->format('Y-m-d') }}"
                                disabled>
                        </div>
                    </div>
                </div>

                @if (session('success'))
                    <div class="employment-alert success">{{ session('success') }}</div>
                @endif

                @if ($errors->any())
                    <div class="employment-alert errors">
                        <strong>لطفاً خطاهای زیر را بررسی کنید:</strong>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <section class="employment-section">
                    <h2>۱ ـ اطلاعات شخصی</h2>
                    <div class="employment-grid">
                        <div class="employment-field">
                            <label for="name">نام و نام خانوادگی *</label>
                            <input id="name" name="name" value="{{ old('name') }}" required>
                            @error('name')
                                <span class="employment-error">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="employment-field">
                            <label for="father_name">نام پدر</label>
                            <input id="father_name" name="father_name" value="{{ old('father_name') }}">
                        </div>
                        <div class="employment-field">
                            <label for="national_id">کد ملی</label>
                            <input id="national_id" name="national_id" value="{{ old('national_id') }}">
                        </div>
                        <div class="employment-field">
                            <label for="birth_certificate_number">شماره شناسنامه</label>
                            <input id="birth_certificate_number" name="birth_certificate_number"
                                value="{{ old('birth_certificate_number') }}">
                        </div>
                        <div class="employment-field">
                            <label for="birth_date">تاریخ تولد</label>
                            <input id="birth_date" type="text" class="jalali-date" name="birth_date"
                                value="{{ old('birth_date') }}" autocomplete="off" placeholder="۱۴۰۵/۰۱/۰۱">
                        </div>
                        <div class="employment-field">
                            <label for="birth_place">محل تولد</label>
                            <input id="birth_place" name="birth_place" value="{{ old('birth_place') }}">
                        </div>
                        <div class="employment-field">
                            <label for="certificate_issue_date">تاریخ صدور شناسنامه</label>
                            <input id="certificate_issue_date" type="text" class="jalali-date"
                                name="certificate_issue_date" value="{{ old('certificate_issue_date') }}"
                                autocomplete="off">
                        </div>
                        <div class="employment-field">
                            <label for="certificate_issue_place">محل صدور شناسنامه</label>
                            <input id="certificate_issue_place" name="certificate_issue_place"
                                value="{{ old('certificate_issue_place') }}">
                        </div>
                        <div class="employment-field">
                            <label for="religion">دین (مذهب)</label>
                            <input id="religion" name="religion" value="{{ old('religion') }}">
                        </div>
                        <div class="employment-field">
                            <label for="nationality">ملیت</label>
                            <input id="nationality" name="nationality" value="{{ old('nationality') }}">
                        </div>
                        <div class="employment-field">
                            <span class="field-label">وضعیت تأهل</span>
                            <div class="employment-options">
                                <label><input type="radio" name="marital_status" value="single"
                                        @checked(old('marital_status') === 'single')> مجرد</label>
                                <label><input type="radio" name="marital_status" value="married"
                                        @checked(old('marital_status') === 'married')> متأهل</label>
                            </div>
                        </div>
                        <div class="employment-field">
                            <span class="field-label">سلامت روحی و جسمانی</span>
                            <div class="employment-options">
                                <label><input type="radio" name="health_status" value="1"
                                        @checked(old('health_status') === '1')> بله</label>
                                <label><input type="radio" name="health_status" value="0"
                                        @checked(old('health_status') === '0')> خیر</label>
                            </div>
                        </div>
                        <div class="employment-field full">
                            <label for="health_description">در صورت خیر، توضیح دهید</label>
                            <textarea id="health_description" name="health_description">{{ old('health_description') }}</textarea>
                        </div>
                    </div>
                </section>

                <section class="employment-section">
                    <h2>۲ ـ سوابق تحصیلی و آموزشی</h2>
                    <div class="employment-table-wrap">
                        <table class="employment-table">
                            <thead>
                                <tr>
                                    <th>مدرک تحصیلی (از آخرین مدرک)</th>
                                    <th>رشته تحصیلی</th>
                                    <th>نام مؤسسه آموزشی</th>
                                    <th>عملیات</th>
                                </tr>
                            </thead>
                            <tbody id="educationRows">
                                @foreach (old('education_records', [['degree' => '', 'field' => '', 'institution' => '']]) as $i => $row)
                                    <tr>
                                        <td><input name="education_records[{{ $i }}][degree]"
                                                value="{{ $row['degree'] ?? '' }}"></td>
                                        <td><input name="education_records[{{ $i }}][field]"
                                                value="{{ $row['field'] ?? '' }}"></td>
                                        <td><input name="education_records[{{ $i }}][institution]"
                                                value="{{ $row['institution'] ?? '' }}"></td>
                                        <td><button type="button" class="employment-remove"
                                                onclick="removeRow(this)">حذف</button></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <button type="button" class="employment-add"
                        onclick="addRow('educationRows','education_records',['مدرک تحصیلی','رشته تحصیلی','نام مؤسسه آموزشی'])">+
                        افزودن سابقه تحصیلی</button>
                </section>

                <section class="employment-section">
                    <h2>۳ ـ تجربیات شغلی</h2>
                    <div class="employment-table-wrap">
                        <table class="employment-table">
                            <thead>
                                <tr>
                                    <th>نام سازمان یا شرکت (از آخرین سابقه)</th>
                                    <th>سمت / شرح شغل</th>
                                    <th>مدت سابقه</th>
                                    <th>تاریخ شروع</th>
                                    <th>تاریخ پایان</th>
                                    <th>آخرین حقوق و مزایا / ریال</th>
                                    <th>علت ترک خدمت</th>
                                    <th>عملیات</th>
                                </tr>
                            </thead>
                            <tbody id="workRows">
                                @foreach (old('work_experiences', [['company' => '', 'position' => '', 'duration' => '', 'start_date' => '', 'end_date' => '', 'salary' => '', 'leaving_reason' => '']]) as $i => $row)
                                    <tr>
                                        @foreach (['company', 'position', 'duration', 'start_date', 'end_date', 'salary', 'leaving_reason'] as $key)
                                            <td>
                                                <input name="work_experiences[{{ $i }}][{{ $key }}]"
                                                    value="{{ $row[$key] ?? '' }}"
                                                    @if (in_array($key, ['start_date', 'end_date'])) type="text" class="jalali-date" autocomplete="off" @endif>
                                            </td>
                                        @endforeach
                                        <td><button type="button" class="employment-remove"
                                                onclick="removeRow(this)">حذف</button></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <button type="button" class="employment-add"
                        onclick="addRow('workRows','work_experiences',['نام سازمان یا شرکت','سمت / شرح شغل','مدت سابقه','تاریخ شروع','تاریخ پایان','حقوق و مزایا','علت ترک خدمت'])">+
                        افزودن سابقه شغلی</button>
                </section>

                <section class="employment-section">
                    <h2>۴ ـ آشنایی به زبان‌های خارجی و سایر دوره‌ها</h2>
                    <div class="employment-table-wrap">
                        <table class="employment-table">
                            <thead>
                                <tr>
                                    <th>نام زبان</th>
                                    <th>مکالمه</th>
                                    <th>نوشتن</th>
                                    <th>خواندن</th>
                                    <th>عملیات</th>
                                </tr>
                            </thead>
                            <tbody id="languageRows">
                                @foreach (old('languages', [['name' => 'انگلیسی', 'speaking' => '', 'writing' => '', 'reading' => '']]) as $i => $row)
                                    <tr>
                                        <td><input name="languages[{{ $i }}][name]"
                                                value="{{ $row['name'] ?? '' }}"></td>
                                        @foreach (['speaking', 'writing', 'reading'] as $key)
                                            <td>
                                                <select name="languages[{{ $i }}][{{ $key }}]">
                                                    <option value="">انتخاب سطح</option>
                                                    @foreach (['weak' => 'ضعیف', 'medium' => 'متوسط', 'good' => 'خوب', 'excellent' => 'عالی'] as $v => $label)
                                                        <option value="{{ $v }}" @selected(($row[$key] ?? '') === $v)>
                                                            {{ $label }}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                        @endforeach
                                        <td><button type="button" class="employment-remove"
                                                onclick="removeRow(this)">حذف</button></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <button type="button" class="employment-add" onclick="addLanguageRow()">+ افزودن زبان</button>
                    <div class="employment-grid two" style="margin-top:20px">
                        <div class="employment-field">
                            <label for="online_business">آشنایی با کسب‌وکار آنلاین</label>
                            <input id="online_business" name="other_courses[0][name]"
                                value="{{ old('other_courses.0.name') }}">
                        </div>
                        <div class="employment-field">
                            <label for="online_store">آشنایی با فروشگاه آنلاین</label>
                            <input id="online_store" name="other_courses[1][name]"
                                value="{{ old('other_courses.1.name') }}">
                        </div>
                    </div>
                </section>

                <section class="employment-section">
                    <h2>۵ ـ آشنایی با کامپیوتر و گواهینامه دوره‌های فنی و حرفه‌ای یا مؤسسات آموزشی</h2>
                    <div class="employment-field">
                        <span class="field-label">مهارت‌های کامپیوتری</span>
                        <div class="employment-options">
                            @foreach (['windows' => 'Windows', 'access' => 'Access', 'excel' => 'Excel', 'word' => 'Word', 'internet' => 'Internet', 'powerpoint' => 'PowerPoint', 'typing' => 'تایپ'] as $value => $label)
                                <label><input type="checkbox" name="computer_skills[]" value="{{ $value }}"
                                        @checked(in_array($value, old('computer_skills', [])))> {{ $label }}</label>
                            @endforeach
                        </div>
                    </div>
                    <div class="employment-field" style="margin-top:16px">
                        <label for="computer_other">سایر مهارت‌ها / توضیحات</label>
                        <textarea id="computer_other" name="computer_other">{{ old('computer_other') }}</textarea>
                    </div>
                    <div class="employment-table-wrap" style="margin-top:20px">
                        <table class="employment-table">
                            <thead>
                                <tr>
                                    <th>ردیف</th>
                                    <th>نام دوره آموزشی</th>
                                    <th>نام مؤسسه آموزش</th>
                                    <th>مدت دوره</th>
                                    <th>تاریخ شروع</th>
                                    <th>تاریخ پایان</th>
                                    <th>توضیحات</th>
                                    <th>عملیات</th>
                                </tr>
                            </thead>
                            <tbody id="courseRows">
                                @foreach (old('training_courses', [['name' => '', 'institution' => '', 'duration' => '', 'start_date' => '', 'end_date' => '', 'description' => '']]) as $i => $row)
                                    <tr>
                                        <td>{{ $i + 1 }}</td>
                                        @foreach (['name', 'institution', 'duration', 'start_date', 'end_date', 'description'] as $key)
                                            <td>
                                                <input name="training_courses[{{ $i }}][{{ $key }}]"
                                                    value="{{ $row[$key] ?? '' }}"
                                                    @if (in_array($key, ['start_date', 'end_date'])) type="text" class="jalali-date" autocomplete="off" @endif>
                                            </td>
                                        @endforeach
                                        <td><button type="button" class="employment-remove"
                                                onclick="removeRow(this)">حذف</button></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <button type="button" class="employment-add" onclick="addCourseRow()">+ افزودن دوره</button>
                </section>

                <section class="employment-section">
                    <h2>۶ ـ نحوه همکاری</h2>
                    <div class="employment-field">
                        <span class="field-label">تمایل به همکاری به‌صورت</span>
                        <div class="employment-options">
                            <label><input type="checkbox" name="cooperation_types[]" value="full_time"
                                    @checked(in_array('full_time', old('cooperation_types', [])))> تمام‌وقت</label>
                            <label><input type="checkbox" name="cooperation_types[]" value="part_time"
                                    @checked(in_array('part_time', old('cooperation_types', [])))> پاره‌وقت</label>
                            <label><input type="checkbox" name="cooperation_types[]" value="off_site"
                                    @checked(in_array('off_site', old('cooperation_types', [])))> همکاری خارج از مرکز (محل کارفرما)</label>
                        </div>
                    </div>
                    <div class="employment-field" style="margin-top:16px">
                        <label for="part_time_schedule">در صورت تمایل به کار پاره‌وقت، ساعات و روزهای همکاری را دقیقاً
                            اعلام فرمایید</label>
                        <textarea id="part_time_schedule" name="part_time_schedule">{{ old('part_time_schedule') }}</textarea>
                    </div>
                </section>

                <section class="employment-section">
                    <h2>۷ ـ شغل مورد درخواست</h2>
                    <div class="employment-grid two">
                        <div class="employment-field">
                            <label for="requested_job">عنوان شغل مورد درخواست</label>
                            <input id="requested_job" name="requested_job"
                                value="{{ old('requested_job', 'حسابدار') }}">
                        </div>
                        <div class="employment-field">
                            <label for="available_from">تاریخی که می‌توانید مشغول به کار شوید</label>
                            <input id="available_from" type="text" class="jalali-date" name="available_from"
                                value="{{ old('available_from') }}" autocomplete="off">
                        </div>
                    </div>
                </section>

                <section class="employment-section">
                    <h2>۸ ـ سابقه پرداخت حق بیمه</h2>
                    <div class="employment-field">
                        <span class="field-label">آیا دارای سابقه پرداخت حق بیمه هستید؟</span>
                        <div class="employment-options">
                            <label><input type="radio" name="has_insurance_history" value="1"
                                    @checked(old('has_insurance_history') === '1')> بله</label>
                            <label><input type="radio" name="has_insurance_history" value="0"
                                    @checked(old('has_insurance_history') === '0')> خیر</label>
                        </div>
                    </div>
                    <div class="employment-field" style="margin-top:16px">
                        <label for="insurance_years">در صورت مثبت بودن، چند سال؟</label>
                        <input id="insurance_years" name="insurance_years" value="{{ old('insurance_years') }}">
                    </div>
                </section>

                <section class="employment-section">
                    <h2>۹ ـ چگونگی آشنایی شما با شرکت</h2>
                    <div class="employment-field">
                        <textarea name="how_found_company" aria-label="چگونگی آشنایی با شرکت">{{ old('how_found_company') }}</textarea>
                    </div>
                </section>

                <section class="employment-section">
                    <h2>۱۰ ـ دو نفر از کسانی که شما را به‌خوبی می‌شناسند و هیچ‌گونه نسبت فامیلی با شما ندارند</h2>
                    <div class="employment-table-wrap">
                        <table class="employment-table">
                            <thead>
                                <tr>
                                    <th>ردیف</th>
                                    <th>نام و نام خانوادگی</th>
                                    <th>نسبت</th>
                                    <th>شغل</th>
                                    <th>نشانی و محل کار</th>
                                    <th>تلفن</th>
                                    <th>عملیات</th>
                                </tr>
                            </thead>
                            <tbody id="referenceRows">
                                @foreach (old('references', [['name' => '', 'relation' => '', 'job' => '', 'workplace_address' => '', 'phone' => ''], ['name' => '', 'relation' => '', 'job' => '', 'workplace_address' => '', 'phone' => '']]) as $i => $row)
                                    <tr>
                                        <td>{{ $i + 1 }}</td>
                                        @foreach (['name', 'relation', 'job', 'workplace_address', 'phone'] as $key)
                                            <td><input name="references[{{ $i }}][{{ $key }}]"
                                                    value="{{ $row[$key] ?? '' }}"></td>
                                        @endforeach
                                        <td><button type="button" class="employment-remove"
                                                onclick="removeRow(this)">حذف</button></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <button type="button" class="employment-add" onclick="addReferenceRow()">+ افزودن معرف</button>
                </section>

                <section class="employment-section">
                    <h2>۱۱ ـ وضعیت اشتغال فعلی</h2>
                    <div class="employment-options">
                        <label><input type="radio" name="currently_employed" value="1"
                                @checked(old('currently_employed') === '1')> بله، اکنون مشغول به کار هستم</label>
                        <label><input type="radio" name="currently_employed" value="0"
                                @checked(old('currently_employed') === '0')> خیر</label>
                    </div>
                </section>

                <section class="employment-section">
                    <h2>۱۲ ـ مسیر شغلی خود در ۱۰ سال آینده را به چه صورت می‌بینید؟ مایلید جایگاه شغلی شما چه باشد؟</h2>
                    <textarea name="career_plan">{{ old('career_plan') }}</textarea>
                </section>

                <section class="employment-section">
                    <h2>۱۳ ـ خود را به‌طور مشخص برای چه شغلی آماده می‌دانید؟</h2>
                    <textarea name="prepared_for_job">{{ old('prepared_for_job') }}</textarea>
                </section>

                <section class="employment-section">
                    <h2>۱۴ ـ نرم‌افزارهایی که با آن‌ها تجربه کار دارید</h2>
                    <textarea name="experienced_software">{{ old('experienced_software') }}</textarea>
                </section>

                <section class="employment-section">
                    <h2>۱۵ ـ حداقل حقوق مورد انتظار</h2>
                    <div class="employment-field">
                        <label for="expected_salary">مبلغ پیشنهادی (ریال)</label>
                        <input id="expected_salary" name="expected_salary" value="{{ old('expected_salary') }}">
                    </div>
                </section>

                <section class="employment-section">
                    <h2>۱۶ ـ آدرس محل سکونت و اطلاعات تماس</h2>
                    <div class="employment-grid">
                        <div class="employment-field">
                            <span class="field-label">نوع محل سکونت</span>
                            <div class="employment-options">
                                <label><input type="radio" name="residence_type" value="personal"
                                        @checked(old('residence_type') === 'personal')> منزل شخصی</label>
                                <label><input type="radio" name="residence_type" value="rented"
                                        @checked(old('residence_type') === 'rented')> منزل اجاره‌ای</label>
                                <label><input type="radio" name="residence_type" value="other"
                                        @checked(old('residence_type') === 'other')> سایر</label>
                            </div>
                        </div>
                        <div class="employment-field">
                            <label for="phone">تلفن همراه *</label>
                            <input id="phone" name="phone" type="tel" value="{{ old('phone') }}" required>
                            @error('phone')
                                <span class="employment-error">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="employment-field">
                            <label for="landline">تلفن ثابت</label>
                            <input id="landline" name="landline" type="tel" value="{{ old('landline') }}">
                        </div>
                        <div class="employment-field">
                            <label for="email">آدرس ایمیل</label>
                            <input id="email" name="email" type="email" value="{{ old('email') }}">
                            @error('email')
                                <span class="employment-error">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="employment-field full">
                            <label for="residence_address">آدرس محل سکونت</label>
                            <textarea id="residence_address" name="residence_address">{{ old('residence_address') }}</textarea>
                        </div>
                        <div class="employment-field full">
                            <label for="residence_description">توضیح سایر موارد</label>
                            <textarea id="residence_description" name="residence_description">{{ old('residence_description') }}</textarea>
                        </div>
                    </div>
                </section>

                <section class="employment-section">
                    <h2>تأیید اطلاعات متقاضی</h2>
                    <p class="employment-note">بدین‌وسیله صحت کلیه اطلاعات مندرج در این فرم را تأیید و گواهی می‌نمایم.
                        تکمیل نمودن این فرم هیچ‌گونه تعهدی در قبال استخدام شما برای شرکت ایجاد نمی‌نماید.</p>
                    <div class="employment-grid two">
                        <div class="employment-field">
                            <label for="signature_name">نام و نام خانوادگی</label>
                            <input id="signature_name" name="signature_name" value="{{ old('signature_name') }}">
                        </div>
                        <div class="employment-field">
                            <label for="signature_date">تاریخ</label>
                            <input id="signature_date" type="text" class="jalali-date" name="signature_date"
                                value="{{ old('signature_date') }}" autocomplete="off">
                        </div>
                    </div>
                    <div class="employment-field" style="margin-top:16px">
                        <label><input type="checkbox" name="consent" value="1" @checked(old('consent'))
                                required> صحت اطلاعات واردشده را تأیید می‌کنم.</label>
                        @error('consent')
                            <span class="employment-error">{{ $message }}</span>
                        @enderror
                    </div>
                </section>

                <div class="employment-submit">
                    <button type="submit">ثبت فرم استخدام</button>
                    <a href="{{ route('home') }}">بازگشت به صفحه اصلی</a>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/persian-date@1.1.0/dist/persian-date.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/persian-datepicker@1.2.0/dist/js/persian-datepicker.min.js"></script>

    <script>
        function removeRow(button) {
            const row = button.closest('tr');
            const tbody = row.parentElement;

            if (tbody.rows.length > 1) {
                row.remove();
                [...tbody.rows].forEach((tr, index) => {
                    if (tr.cells[0] && /^\d+$/.test(tr.cells[0].textContent.trim())) {
                        tr.cells[0].textContent = index + 1;
                    }
                });
            } else {
                row.querySelectorAll('input').forEach(input => input.value = '');
                row.querySelectorAll('select').forEach(select => select.selectedIndex = 0);
            }
        }

        function nextIndex(tbody) {
            return Math.max(-1, ...[...tbody.querySelectorAll('input,select,textarea')]
                .map(el => {
                    const match = el.name.match(/\[(\d+)\]/);
                    return match ? Number(match[1]) : -1;
                })) + 1;
        }

        function initializeJalaliDatepicker(container = document) {
            $(container).find('.jalali-date').each(function() {
                const input = $(this);

                if (input.data('datepicker-initialized')) {
                    return;
                }

                input.data('datepicker-initialized', true);

                const value = this.value.trim();

                if (/^\d{4}-\d{2}-\d{2}$/.test(value)) {
                    const [year, month, day] = value.split('-').map(Number);
                    this.value = new persianDate(new Date(year, month - 1, day)).format('YYYY/MM/DD');
                }

                input.persianDatepicker({
                    format: 'YYYY/MM/DD',
                    initialValue: false,
                    autoClose: true,
                    calendar: {
                        persian: {
                            locale: 'fa'
                        }
                    }
                });
            });
        }

        function addRow(tbodyId, prefix, labels) {
            const tbody = document.getElementById(tbodyId);
            const index = nextIndex(tbody);
            const tr = document.createElement('tr');

            const keys = {
                education_records: ['degree', 'field', 'institution'],
                work_experiences: ['company', 'position', 'duration', 'start_date', 'end_date', 'salary',
                    'leaving_reason'
                ]
            };

            labels.forEach((label, i) => {
                const td = document.createElement('td');
                const input = document.createElement('input');
                const key = keys[prefix][i];

                input.name = `${prefix}[${index}][${key}]`;
                input.setAttribute('aria-label', label);

                if (prefix === 'work_experiences' && ['start_date', 'end_date'].includes(key)) {
                    input.type = 'text';
                    input.classList.add('jalali-date');
                    input.autocomplete = 'off';
                }

                td.appendChild(input);
                tr.appendChild(td);
            });

            const action = document.createElement('td');
            action.innerHTML = '<button type="button" class="employment-remove" onclick="removeRow(this)">حذف</button>';
            tr.appendChild(action);
            tbody.appendChild(tr);
            initializeJalaliDatepicker(tr);
        }

        function addLanguageRow() {
            const tbody = document.getElementById('languageRows');
            const index = nextIndex(tbody);
            const tr = document.createElement('tr');
            const name = document.createElement('td');

            name.innerHTML = `<input name="languages[${index}][name]" aria-label="نام زبان">`;
            tr.appendChild(name);

            ['speaking', 'writing', 'reading'].forEach(key => {
                const td = document.createElement('td');
                const select = document.createElement('select');

                select.name = `languages[${index}][${key}]`;
                select.innerHTML =
                    '<option value="">انتخاب سطح</option><option value="weak">ضعیف</option><option value="medium">متوسط</option><option value="good">خوب</option><option value="excellent">عالی</option>';

                td.appendChild(select);
                tr.appendChild(td);
            });

            const action = document.createElement('td');
            action.innerHTML = '<button type="button" class="employment-remove" onclick="removeRow(this)">حذف</button>';
            tr.appendChild(action);
            tbody.appendChild(tr);
        }

        function addCourseRow() {
            const tbody = document.getElementById('courseRows');
            const index = nextIndex(tbody);
            const tr = document.createElement('tr');
            const number = document.createElement('td');

            number.textContent = tbody.rows.length + 1;
            tr.appendChild(number);

            ['name', 'institution', 'duration', 'start_date', 'end_date', 'description'].forEach(key => {
                const td = document.createElement('td');
                const input = document.createElement('input');

                input.name = `training_courses[${index}][${key}]`;

                if (['start_date', 'end_date'].includes(key)) {
                    input.type = 'text';
                    input.classList.add('jalali-date');
                    input.autocomplete = 'off';
                }

                td.appendChild(input);
                tr.appendChild(td);
            });

            const action = document.createElement('td');
            action.innerHTML = '<button type="button" class="employment-remove" onclick="removeRow(this)">حذف</button>';
            tr.appendChild(action);
            tbody.appendChild(tr);
            initializeJalaliDatepicker(tr);
        }

        function addReferenceRow() {
            const tbody = document.getElementById('referenceRows');
            const index = nextIndex(tbody);
            const tr = document.createElement('tr');
            const number = document.createElement('td');

            number.textContent = tbody.rows.length + 1;
            tr.appendChild(number);

            ['name', 'relation', 'job', 'workplace_address', 'phone'].forEach(key => {
                const td = document.createElement('td');
                const input = document.createElement('input');

                input.name = `references[${index}][${key}]`;
                td.appendChild(input);
                tr.appendChild(td);
            });

            const action = document.createElement('td');
            action.innerHTML = '<button type="button" class="employment-remove" onclick="removeRow(this)">حذف</button>';
            tr.appendChild(action);
            tbody.appendChild(tr);
        }

        function convertJalaliToGregorian(value) {
            if (!value || !/^\d{4}[\/-]\d{1,2}[\/-]\d{1,2}$/.test(value.trim())) {
                return value;
            }

            const [year, month, day] = value.trim().replace(/-/g, '/').split('/').map(Number);

            return new persianDate([year, month, day])
                .toCalendar('gregorian')
                .format('YYYY-MM-DD');
        }

        document.addEventListener('DOMContentLoaded', function() {
            initializeJalaliDatepicker();

            document.getElementById('employmentForm').addEventListener('submit', function() {
                this.querySelectorAll('.jalali-date').forEach(input => {
                    if (input.disabled || !input.name) {
                        return;
                    }

                    input.value = convertJalaliToGregorian(input.value);
                });
            });
        });
    </script>
@endsection