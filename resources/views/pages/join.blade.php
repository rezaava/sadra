@extends('layout.master')
@section('head')
    <title>دعوت به همکاری | صدرا</title>
    <link rel="stylesheet" href="{{ asset('asset/css/join.css') }}">
@endsection
@section('main')
    <div class="page-bg-anim" aria-hidden="true">
        <span class="pba-blob pba-1"></span>
        <span class="pba-blob pba-2"></span>
        <span class="pba-blob pba-3"></span>
    </div>
    <section class="join-hero">
        <div class="join-hero-icons" aria-hidden="true">
            <svg viewBox="0 0 34 34">
                <rect x="4" y="4" width="26" height="26" fill="none" stroke-width="1.2" />
                <line x1="4" y1="14" x2="30" y2="14" stroke-width="1.2" />
            </svg>
            <svg viewBox="0 0 34 34">
                <circle cx="17" cy="17" r="12" fill="none" stroke-width="1.2" />
            </svg>
            <svg viewBox="0 0 34 34">
                <path d="M17 4 L30 12 L17 20 L4 12 Z" fill="none" stroke-width="1.2" />
            </svg>
            <svg viewBox="0 0 34 34">
                <path d="M17 4 L30 12 L17 30 L4 12 Z" fill="none" stroke-width="1.2" />
            </svg>
        </div>
        <div class="wrap join-hero-inner">
            <p class="breadcrumb">
                <a href="{{ route('home') }}">خانه</a>
                <span class="sep">/</span>
                <span class="current">دعوت به همکاری</span>
            </p>
            <span class="join-hero-eyebrow">SADRA. — CAREERS</span>
            <h1 class="join-hero-title">به جمع
                <span class="accent-grad">خانواده صدرا</span>
                بپیوندید
            </h1>
            <p class="join-hero-lede">ما همیشه به دنبال آدم‌هایی هستیم که به بسته‌بندی به چشم یک طراحی جدی نگاه می‌کنند؛ اگر
                دوست دارید در پروژه‌های واقعی برندها نقش داشته باشید، فرم زیر را پر کنید تا با شما در ارتباط باشیم.</p>
            <div class="join-hero-buttons">
                <a href="#joinFormSection" class="btn-primary">تکمیل فرم همکاری</a>
                <a href="mailto:careers@sadraco.ir" class="btn-ghost">careers@sadraco.ir</a>
            </div>
        </div>
    </section>
    <section class="join-why">
        <div class="wrap">
            <div class="section-head reveal">
                <h2>چرا با ما همکاری کنید</h2>
                <p class="section-note">فضایی برای رشد واقعی، در کنار پروژه‌هایی که واقعاً تولید و اجرا می‌شوند.</p>
            </div>
            <div class="why-grid">
                <div class="why-card reveal" style="--d:0s">
                    <svg class="why-icon" viewBox="0 0 40 40" fill="none" stroke="#221f5e" stroke-width="1.4">
                        <path d="M20 4 L34 12 L20 20 L6 12 Z" />
                        <path d="M6 12 L6 28 L20 36 L34 28 L34 12" />
                        <path d="M20 20 L20 36" />
                    </svg>
                    <h3>پروژه‌های واقعی</h3>
                    <p>روی بسته‌بندی برندهایی کار می‌کنید که واقعاً تولید و روانه‌ی بازار می‌شوند، نه تمرین‌های فرضی.</p>
                </div>
                <div class="why-card reveal" style="--d:0.08s">
                    <svg class="why-icon" viewBox="0 0 40 40" fill="none" stroke="#221f5e" stroke-width="1.4">
                        <circle cx="20" cy="20" r="14" />
                        <path d="M20 11 v9 l6 4" />
                    </svg>
                    <h3>یادگیری مستمر</h3>
                    <p>از طراحی ساختاری تا نظارت بر چاپ؛ فرصت یادگیری کل چرخه‌ی ساخت یک بسته‌بندی را دارید.</p>
                </div>
                <div class="why-card reveal" style="--d:0.16s">
                    <svg class="why-icon" viewBox="0 0 40 40" fill="none" stroke="#221f5e" stroke-width="1.4">
                        <rect x="6" y="6" width="28" height="28" rx="4" />
                        <path d="M13 20 h14 M20 13 v14" />
                    </svg>
                    <h3>تیم کوچک و صمیمی</h3>
                    <p>در استودیویی کار می‌کنید که تصمیم‌ها سریع گرفته می‌شوند و صدای هر عضو تیم شنیده می‌شود.</p>
                </div>
                <div class="why-card reveal" style="--d:0.24s">
                    <svg class="why-icon" viewBox="0 0 40 40" fill="none" stroke="#221f5e" stroke-width="1.4">
                        <path d="M8 32 V18 L20 8 L32 18 V32" />
                        <path d="M16 32 V22 H24 V32" />
                    </svg>
                    <h3>مسیر رشد شفاف</h3>
                    <p>بازخورد مستمر و مسیر پیشرفت مشخص، برای این‌که بدانید کجا ایستاده‌اید و کجا می‌روید.</p>
                </div>
            </div>
        </div>
    </section>
    <section class="join-form-section" id="joinFormSection">
        <div class="wrap">
            <div class="join-form-wrap reveal">
                <div class="join-form-head {{ session('success') ? 'hide' : '' }}" id="joinFormHead">
                    <h2>فرم همکاری با صدرا</h2>
                    <p>اطلاعات خودتان را با ما در میان بگذارید؛ تیم ما فرم شما را بررسی می‌کند و در صورت تناسب با نیازهای
                        استودیو، تماس می‌گیرد.</p>
                </div>
                @if (session('success'))
                    <div class="join-success show" id="joinSuccess">
                        <span class="join-success-icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <path d="M20 6L9 17l-5-5" />
                            </svg>
                        </span>
                        <h3>درخواست شما ثبت شد</h3>
                        <p>{{ session('success') }}</p>
                        <a href="{{ route('home') }}" class="btn-ghost" id="joinResetBtn">بازگشت به صفحه اصلی</a>
                    </div>
                @else
                    <form class="join-form" id="joinForm" method="POST" action="{{ route('join.store') }}"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="join-field">
                            <label for="joinName">نام و نام خانوادگی</label>
                            <input type="text" id="joinName" name="name" value="{{ old('name') }}"
                                placeholder="مثلاً: سارا احمدی" required>
                            @error('name')
                                <span class="join-field-error">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="join-field">
                            <label for="joinEmail">ایمیل</label>
                            <input type="email" id="joinEmail" name="email" value="{{ old('email') }}"
                                placeholder="example@email.com" required>
                            @error('email')
                                <span class="join-field-error">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="join-field">
                            <label for="joinPhone">شماره تماس</label>
                            <input type="tel" id="joinPhone" name="phone" value="{{ old('phone') }}"
                                placeholder="۰۹۱۲۰۰۰۰۰۰۰" required>
                            @error('phone')
                                <span class="join-field-error">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="join-field">
                            <label for="joinField">حوزه مورد علاقه</label>
                            <select id="joinField" name="field" required>
                                <option value="" disabled @selected(!old('field'))>یک حوزه را انتخاب کنید
                                </option>
                                <option value="graphic" @selected(old('field') === 'graphic')>طراحی گرافیک بسته‌بندی</option>
                                <option value="structure" @selected(old('field') === 'structure')>طراحی ساختاری و دای‌کات</option>
                                <option value="production" @selected(old('field') === 'production')>تولید و نظارت بر چاپ</option>
                                <option value="marketing" @selected(old('field') === 'marketing')>بازاریابی و فروش</option>
                                <option value="internship" @selected(old('field') === 'internship')>کارآموزی</option>
                                <option value="other" @selected(old('field') === 'other')>سایر</option>
                            </select>
                            @error('field')
                                <span class="join-field-error">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="join-field">
                            <label for="joinExperience">سابقه کار <span class="opt">(اختیاری)</span></label>
                            <select id="joinExperience" name="experience">
                                <option value="" @selected(!old('experience'))>انتخاب کنید</option>
                                <option value="lt1" @selected(old('experience') === 'lt1')>کمتر از ۱ سال</option>
                                <option value="1to3" @selected(old('experience') === '1to3')>۱ تا ۳ سال</option>
                                <option value="3to5" @selected(old('experience') === '3to5')>۳ تا ۵ سال</option>
                                <option value="gt5" @selected(old('experience') === 'gt5')>بیش از ۵ سال</option>
                            </select>
                            @error('experience')
                                <span class="join-field-error">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="join-field">
                            <label for="joinPortfolio">لینک نمونه‌کار <span class="opt">(اختیاری)</span></label>
                            <input type="url" id="joinPortfolio" name="portfolio" value="{{ old('portfolio') }}"
                                placeholder="https://...">
                            @error('portfolio')
                                <span class="join-field-error">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="join-field full">
                            <label for="joinResume">فایل رزومه <span class="opt">(اختیاری، PDF)</span></label>
                            <label class="join-file" id="joinFileLabel" for="joinResume">
                                <svg viewBox="0 0 24 24" fill="none" stroke-width="1.6">
                                    <path d="M12 3v12M7 10l5 5 5-5" />
                                    <path d="M4 19h16" />
                                </svg>
                                <span>فایل را انتخاب کنید یا بکشید و رها کنید</span>
                            </label>
                            <input type="file" id="joinResume" name="resume" accept="application/pdf">
                            @error('resume')
                                <span class="join-field-error">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="join-field full">
                            <label for="joinMessage">درباره خودتان بگویید <span class="opt">(اختیاری)</span></label>
                            <textarea id="joinMessage" name="message"
                                placeholder="تجربه‌ها، پروژه‌های موردعلاقه، یا هر چیزی که فکر می‌کنید باید بدانیم...">{{ old('message') }}</textarea>
                            @error('message')
                                <span class="join-field-error">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="join-form-foot">
                            <label class="join-consent">
                                <input type="checkbox" name="consent" value="1"
                                    {{ old('consent') ? 'checked' : '' }} required>
                                <span>با ارسال این فرم، موافقت می‌کنم اطلاعات من برای بررسی همکاری با صدرا استفاده
                                    شود.</span>
                            </label>
                            @error('consent')
                                <span class="join-field-error">{{ $message }}</span>
                            @enderror
                            <button type="submit" class="btn-primary join-submit-btn width-fit-content">ارسال درخواست همکاری</button>
                        </div>
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
                <div class="cta-dots" aria-hidden="true"></div>
                <div class="cta-card-inner">
                    <div class="cta-copy reveal">
                        <span class="cta-badge">
                            <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor"
                                stroke-width="1.8">
                                <path d="M12 3 L21 8 L12 13 L3 8 Z" />
                                <path d="M3 8 L3 16 L12 21 L21 16 L21 8" />
                                <path d="M12 13 L12 21" />
                            </svg>
                            آماده همکاری با برند شما
                        </span>
                        <h2>پروژه بعدی برند شما<br>از اینجا شروع می‌شود</h2>
                        <p>برای گفتگو درباره بسته‌بندی محصول‌تان، با تیم صدرا در تماس باشید.</p>
                        <a href="mailto:SadraPacking@gmail.com" class="btn-primary cta-btn">شروع گفتگو</a>
                    </div>
                    <div class="cta-contacts reveal" style="--d:0.15s">
                        <a class="cta-contact-row" href="mailto:SadraPacking@gmail.com">
                            <span class="cta-ic">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6">
                                    <rect x="3" y="5" width="18" height="14" rx="2" />
                                    <path d="M3 7 L12 13 L21 7" />
                                </svg>
                            </span>
                            <span class="en">SadraPacking@gmail.com</span>
                        </a>
                        <a class="cta-contact-row" href="tel:+989130032144">
                            <span class="cta-ic">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6">
                                    <path d="M4 5c0 8.5 6.5 15 15 15l2-4-6-2-2 2c-3-1.5-5-3.5-6.5-6.5l2-2-2-6z" />
                                </svg>
                            </span>
                            <span class="en" dir="ltr">0913 003 2144</span>
                        </a>
                        <div class="cta-contact-row static">
                            <span class="cta-ic">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6">
                                    <path d="M12 21s7-6.5 7-12a7 7 0 1 0-14 0c0 5.5 7 12 7 12z" />
                                    <circle cx="12" cy="9" r="2.4" />
                                </svg>
                            </span>
                            <span>یزد -میدان قران -بلوار خاتم یزدی-ساختمان صدرا طبقه ۳</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('js')
    <script src="{{ asset('asset/js/join.js') }}"></script>
    @if (session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const successBox = document.getElementById('joinSuccess');
                if (successBox) {
                    setTimeout(function() {
                        successBox.scrollIntoView({
                            behavior: 'smooth',
                            block: 'center'
                        });
                    }, 300);
                }
            });
        </script>
    @endif
@endsection
