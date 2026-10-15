@extends('layout.master')

@section('head')
    <title>ارسال نمونه‌کار | صدرا</title>
    <link rel="stylesheet" href="{{ asset('asset/css/submit-portfolio.css') }}">
@endsection

@section('main')

    <div class="page-bg-anim" aria-hidden="true">
        <span class="pba-blob pba-1"></span>
        <span class="pba-blob pba-2"></span>
        <span class="pba-blob pba-3"></span>
    </div>

    <section class="sp-hero">
        <div class="wrap sp-hero-grid">

            <div class="sp-hero-content">

                <p class="breadcrumb">
                    <a href="{{ route('home') }}">خانه</a>
                    <span class="sep">/</span>
                    <span class="current">ارسال نمونه‌کار</span>
                </p>

                <span class="sp-hero-eyebrow">
                    SADRA. — SHOWCASE YOUR WORK
                </span>

                <h1 class="sp-hero-title">
                    نمونه‌کارتان را
                    <span class="accent-grad">
                        با ما به اشتراک بگذارید
                    </span>
                </h1>

                <p class="sp-hero-lede">
                    طراح، عکاس یا تصویرسازی هستید که روی بسته‌بندی کار می‌کنید؟
                    لینک نمونه‌کارتان را برایمان بفرستید؛ اگر با نگاه استودیوی ما
                    هم‌راستا باشد، برای همکاری در پروژه‌های آینده با شما تماس می‌گیریم.
                </p>

                <div class="sp-hero-buttons">
                    <a href="#spFormSection" class="btn-primary">
                        ارسال نمونه‌کار
                    </a>

                    <a href="{{ route('join') }}" class="btn-ghost">
                        مشاهده فرصت‌های همکاری
                    </a>
                </div>

            </div>

            <div class="sp-hero-visual" aria-hidden="true">

                <span class="sphv-glow"></span>

                <div class="sphv-card sphv-1">
                    <svg
                        viewBox="0 0 34 34"
                        fill="none"
                        stroke-width="1.3"
                    >
                        <rect
                            x="4"
                            y="4"
                            width="26"
                            height="26"
                        />
                        <line
                            x1="4"
                            y1="14"
                            x2="30"
                            y2="14"
                        />
                    </svg>

                    <span>طراحی بسته‌بندی</span>
                </div>

                <div class="sphv-card sphv-2">
                    <svg
                        viewBox="0 0 34 34"
                        fill="none"
                        stroke-width="1.3"
                    >
                        <circle
                            cx="17"
                            cy="17"
                            r="12"
                        />
                    </svg>

                    <span>طراحی ساختاری</span>
                </div>

                <div class="sphv-card sphv-3">
                    <svg
                        viewBox="0 0 34 34"
                        fill="none"
                        stroke-width="1.3"
                    >
                        <path d="M17 4 L30 12 L17 20 L4 12 Z"/>
                    </svg>

                    <span>تصویرسازی</span>
                </div>

                <div class="sphv-card sphv-4">
                    <svg
                        viewBox="0 0 34 34"
                        fill="none"
                        stroke-width="1.3"
                    >
                        <path d="M17 4 L30 12 L17 30 L4 12 Z"/>
                    </svg>

                    <span>عکاسی محصول</span>
                </div>

            </div>

        </div>
    </section>

    <section class="sp-form-section" id="spFormSection">

        <div class="wrap">

            <div class="sp-form-wrap reveal">

                @if ($errors->any())

                    <div class="sp-form-errors">
                        @foreach ($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </div>

                @endif

                @if (session('success'))

                    <div class="sp-success show" id="spSuccess">

                        <span class="sp-success-icon">
                            <svg
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke-width="2"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                            >
                                <path d="M20 6L9 17l-5-5"/>
                            </svg>
                        </span>

                        <h3>
                            نمونه‌کار شما ارسال شد
                        </h3>

                        <p>
                            ممنون که نمونه‌کارتان را با ما در میان گذاشتید.
                            تیم صدرا آن را بررسی می‌کند و در صورت هم‌راستایی
                            با پروژه‌های آینده، از طریق ایمیل با شما تماس می‌گیرد.
                        </p>

                        <a
                            href="{{ route('home') }}"
                            class="btn-ghost"
                        >
                            بازگشت به صفحه اصلی
                        </a>

                    </div>

                @else

                    <div class="sp-form-head" id="spFormHead">

                        <h2>
                            فرم ارسال نمونه‌کار
                        </h2>

                        <p>
                            کافی است لینک نمونه‌کارتان (بیهنس، اینستاگرام یا گوگل‌درایو)
                            را برایمان بفرستید؛ نیازی به رزومه یا فرم طولانی نیست.
                        </p>

                    </div>

                    <form
                        class="sp-form"
                        id="spForm"
                        action="{{ route('submit-portfolio.store') }}"
                        method="POST"
                        enctype="multipart/form-data"
                    >

                        @csrf

                        <div class="sp-field">

                            <label for="spName">
                                نام و نام خانوادگی
                            </label>

                            <input
                                type="text"
                                id="spName"
                                name="name"
                                value="{{ old('name') }}"
                                placeholder="مثلاً: مریم کریمی"
                                required
                            >

                            <span class="sp-field-error">
                                @error('name')
                                    {{ $message }}
                                @else
                                    لطفاً نام و نام خانوادگی را وارد کنید.
                                @enderror
                            </span>

                        </div>

                        <div class="sp-field">

                            <label for="spEmail">
                                ایمیل
                            </label>

                            <input
                                type="email"
                                id="spEmail"
                                name="email"
                                value="{{ old('email') }}"
                                placeholder="example@email.com"
                                required
                            >

                            <span class="sp-field-error">
                                @error('email')
                                    {{ $message }}
                                @else
                                    لطفاً یک ایمیل معتبر وارد کنید.
                                @enderror
                            </span>

                        </div>

                        <div class="sp-field">

                            <label for="spLink">
                                لینک نمونه‌کار
                            </label>

                            <input
                                type="url"
                                id="spLink"
                                name="link"
                                value="{{ old('link') }}"
                                placeholder="behance.net/... یا instagram.com/..."
                                required
                            >

                            <span class="sp-field-error">
                                @error('link')
                                    {{ $message }}
                                @else
                                    لطفاً لینک نمونه‌کار را وارد کنید.
                                @enderror
                            </span>

                        </div>

                        <div class="sp-field">

                            <label for="spField">
                                حوزه فعالیت
                            </label>

                            <select
                                id="spField"
                                name="field"
                                required
                            >

                                <option
                                    value=""
                                    disabled
                                    {{ old('field') ? '' : 'selected' }}
                                >
                                    یک حوزه را انتخاب کنید
                                </option>

                                <option
                                    value="graphic"
                                    {{ old('field') === 'graphic' ? 'selected' : '' }}
                                >
                                    طراحی گرافیک بسته‌بندی
                                </option>

                                <option
                                    value="structure"
                                    {{ old('field') === 'structure' ? 'selected' : '' }}
                                >
                                    طراحی ساختاری
                                </option>

                                <option
                                    value="illustration"
                                    {{ old('field') === 'illustration' ? 'selected' : '' }}
                                >
                                    تصویرسازی
                                </option>

                                <option
                                    value="photography"
                                    {{ old('field') === 'photography' ? 'selected' : '' }}
                                >
                                    عکاسی محصول
                                </option>

                                <option
                                    value="other"
                                    {{ old('field') === 'other' ? 'selected' : '' }}
                                >
                                    سایر
                                </option>

                            </select>

                            <span class="sp-field-error">
                                @error('field')
                                    {{ $message }}
                                @else
                                    لطفاً حوزه‌ی فعالیت را انتخاب کنید.
                                @enderror
                            </span>

                        </div>

                        <div class="sp-field full">

                            <label for="spFile">
                                فایل نمونه‌کار
                                <span class="opt">
                                    (اختیاری، PDF یا تصویر)
                                </span>
                            </label>

                            <label
                                class="sp-file"
                                id="spFileLabel"
                                for="spFile"
                            >

                                <svg
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke-width="1.6"
                                >
                                    <path d="M12 3v12M7 10l5 5 5-5"/>
                                    <path d="M4 19h16"/>
                                </svg>

                                <span>
                                    فایل را انتخاب کنید یا بکشید و رها کنید
                                </span>

                            </label>

                            <input
                                type="file"
                                id="spFile"
                                name="file"
                                accept="application/pdf,image/*"
                            >

                            @error('file')
                                <span class="sp-field-error">
                                    {{ $message }}
                                </span>
                            @enderror

                        </div>

                        <div class="sp-field full">

                            <label for="spMessage">
                                چند خط درباره کارتان
                                <span class="opt">
                                    (اختیاری)
                                </span>
                            </label>

                            <textarea
                                id="spMessage"
                                name="message"
                                placeholder="زمینه‌ی فعالیت، پروژه‌های موردعلاقه یا هر توضیح دیگری..."
                            >{{ old('message') }}</textarea>

                            @error('message')
                                <span class="sp-field-error">
                                    {{ $message }}
                                </span>
                            @enderror

                        </div>

                        <div class="sp-form-foot">

                            <label class="sp-consent">

                                <input
                                    type="checkbox"
                                    name="consent"
                                    value="1"
                                    required
                                >

                                <span>
                                    با ارسال این فرم، موافقت می‌کنم اطلاعات و
                                    نمونه‌کارم برای بررسی تیم صدرا استفاده شود.
                                </span>

                            </label>

                            @error('consent')
                                <span class="sp-field-error">
                                    {{ $message }}
                                </span>
                            @enderror

                            <button
                                type="submit"
                                class="btn-primary sp-submit-btn"
                            >
                                ارسال نمونه‌کار
                            </button>

                        </div>

                    </form>

                @endif

            </div>

        </div>

    </section>

    <section class="cta-section" id="contact">

        <div class="wrap">

            <div class="cta-card">

                <span class="cta-glow g1"></span>
                <span class="cta-glow g2"></span>

                <div
                    class="cta-dots"
                    aria-hidden="true"
                ></div>

                <div class="cta-card-inner">

                    <div class="cta-copy reveal">

                        <span class="cta-badge">

                            <svg
                                viewBox="0 0 24 24"
                                width="16"
                                height="16"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="1.8"
                            >
                                <path d="M12 3 L21 8 L12 13 L3 8 Z"/>
                                <path d="M3 8 L3 16 L12 21 L21 16 L21 8"/>
                                <path d="M12 13 L12 21"/>
                            </svg>

                            آماده همکاری با برند شما

                        </span>

                        <h2>
                            پروژه بعدی برند شما
                            <br>
                            از اینجا شروع می‌شود
                        </h2>

                        <p>
                            برای گفتگو درباره بسته‌بندی محصول‌تان،
                            با تیم صدرا در تماس باشید.
                        </p>

                        <a
                            href="mailto:SadraPacking@gmail.com"
                            class="btn-primary cta-btn"
                        >
                            شروع گفتگو
                        </a>

                    </div>

                    <div
                        class="cta-contacts reveal"
                        style="--d:0.15s"
                    >

                        <a
                            class="cta-contact-row"
                            href="mailto:SadraPacking@gmail.com"
                        >

                            <span class="cta-ic">

                                <svg
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="1.6"
                                >
                                    <rect
                                        x="3"
                                        y="5"
                                        width="18"
                                        height="14"
                                        rx="2"
                                    />
                                    <path d="M3 7 L12 13 L21 7"/>
                                </svg>

                            </span>

                            <span class="en">
                                SadraPacking@gmail.com
                            </span>

                        </a>

                        <a
                            class="cta-contact-row"
                            href="tel:+989130032144"
                        >

                            <span class="cta-ic">

                                <svg
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="1.6"
                                >
                                    <path d="M4 5c0 8.5 6.5 15 15 15l2-4-6-2-2 2c-3-1.5-5-3.5-6.5-6.5l2-2-2-6z"/>
                                </svg>

                            </span>

                            <span class="en" dir="ltr">
                                0913 003 2144
                            </span>

                        </a>

                        <div class="cta-contact-row static">

                            <span class="cta-ic">

                                <svg
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="1.6"
                                >
                                    <path d="M12 21s7-6.5 7-12a7 7 0 1 0-14 0c0 5.5 7 12 7 12z"/>
                                    <circle
                                        cx="12"
                                        cy="9"
                                        r="2.4"
                                    />
                                </svg>

                            </span>

                            <span>
                                یزد -میدان قران -بلوار خاتم یزدی-ساختمان صدرا طبقه ۳
                            </span>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>

@endsection

@section('js')
    <script src="{{ asset('asset/js/submit-portfolio.js') }}"></script>
@endsection