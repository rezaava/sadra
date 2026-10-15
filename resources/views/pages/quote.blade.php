@extends('layout.master')

@section('head')
    <title>استعلام قیمت | صدرا</title>
    <link rel="stylesheet" href="{{ asset('asset/css/quote.css') }}">
    <style>
        .quote-tracking {
            margin: 24px auto;
            padding: 20px;
            max-width: 320px;
            border: 1px dashed #423a9e;
            border-radius: 12px;
            background: #f7f4ee;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 10px;
        }

        .quote-tracking>span {
            font-size: 14px;
            color: #423a9e;
        }

        .quote-tracking strong {
            font-size: 24px;
            letter-spacing: 2px;
            color: #1a1740;
        }

        .quote-tracking p {
            margin: 0;
            font-size: 13px;
            color: #555;
        }
    </style>
@endsection

@section('main')
    <div class="page-bg-anim" aria-hidden="true">
        <span class="pba-blob pba-1"></span>
        <span class="pba-blob pba-2"></span>
        <span class="pba-blob pba-3"></span>
    </div>

    <section class="quote-hero">
        <div class="quote-hero-icons" aria-hidden="true">
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
        <div class="wrap quote-hero-inner">
            <p class="breadcrumb">
                <a href="{{ route('home') }}">خانه</a>
                <span class="sep">/</span>
                <span class="current">استعلام قیمت</span>
            </p>
            <span class="quote-hero-eyebrow">SADRA. — GET A QUOTE</span>
            <h1 class="quote-hero-title">برای پروژه‌ی خود
                <span class="accent-grad">استعلام قیمت بگیرید</span>
            </h1>
            <p class="quote-hero-lede">جزئیات محصول و بسته‌بندی مدنظرتان را برای ما بفرستید؛ تیم فنی صدرا پس از بررسی،
                پیش‌فاکتور و زمان‌بندی تقریبی تولید را برایتان ارسال می‌کند.</p>
            <div class="quote-hero-buttons">
                <a href="#quoteFormSection" class="btn-primary">تکمیل فرم استعلام</a>
                <a href="tel:+989130032144" class="btn-ghost" dir="ltr">0913 003 2144</a>
            </div>
        </div>
    </section>

    <section class="quote-steps">
        <div class="wrap">
            <div class="section-head reveal">
                <h2>روند بررسی درخواست</h2>
                <p class="section-note">از لحظه‌ی ثبت فرم تا دریافت پیش‌فاکتور، این مسیر را طی می‌کنیم.</p>
            </div>
            <div class="quote-steps-row">
                <div class="quote-step reveal" style="--d:0s">
                    <span class="quote-step-num">۰۱</span>
                    <h3>ثبت درخواست</h3>
                    <p>فرم را با جزئیات محصول، تیراژ و متریال مدنظرتان تکمیل می‌کنید.</p>
                </div>
                <div class="quote-step reveal" style="--d:0.1s">
                    <span class="quote-step-num">۰۲</span>
                    <h3>بررسی فنی تیم</h3>
                    <p>کارشناسان ما درخواست را از نظر ساختار، متریال و امکان تولید بررسی می‌کنند.</p>
                </div>
                <div class="quote-step reveal" style="--d:0.2s">
                    <span class="quote-step-num">۰۳</span>
                    <h3>ارسال پیش‌فاکتور</h3>
                    <p>پیش‌فاکتور، زمان‌بندی تقریبی تولید و مراحل بعدی از طریق ایمیل یا تماس برایتان ارسال می‌شود.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="quote-form-section" id="quoteFormSection">
        <div class="wrap">
            <div class="quote-form-wrap reveal">
                <div class="quote-form-head {{ session('success') ? 'hide' : '' }}" id="quoteFormHead">
                    <h2>فرم استعلام قیمت</h2>
                    <p>هرچه اطلاعات دقیق‌تری بدهید، پیش‌فاکتور دقیق‌تری دریافت می‌کنید. فیلدهای بدون توضیح، اختیاری هستند.
                    </p>
                </div>
                @if (session('success'))
                    <div class="quote-success show" id="quoteSuccess">
                        <span class="quote-success-icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <path d="M20 6L9 17l-5-5" />
                            </svg>
                        </span>

                        <h3>درخواست استعلام شما ثبت شد</h3>

                        <p>{{ session('success') }}</p>

                        <div class="quote-tracking">
                            <span>کد رهگیری درخواست شما</span>
                            <strong dir="ltr">{{ session('tracking_code') }}</strong>
                            <p>این کد را برای پیگیری درخواست خود نگه دارید.</p>
                        </div>

                        <a href="{{ route('home') }}" class="btn-ghost">بازگشت به صفحه اصلی</a>
                    </div>
                @else
                    <form class="quote-form" id="quoteForm" method="POST" action="{{ route('quote.store') }}"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="quote-field">
                            <label for="quoteName">نام و نام خانوادگی</label>
                            <input type="text" id="quoteName" name="name" value="{{ old('name') }}"
                                placeholder="مثلاً: علی رضایی" required>
                            @error('name')
                                <span class="quote-field-error">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="quote-field">
                            <label for="quoteBrand">نام برند / شرکت</label>
                            <input type="text" id="quoteBrand" name="brand" value="{{ old('brand') }}"
                                placeholder="نام برند شما" required>
                            @error('brand')
                                <span class="quote-field-error">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="quote-field">
                            <label for="quoteEmail">ایمیل</label>
                            <input type="email" id="quoteEmail" name="email" value="{{ old('email') }}"
                                placeholder="example@email.com" required>
                            @error('email')
                                <span class="quote-field-error">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="quote-field">
                            <label for="quotePhone">شماره تماس</label>
                            <input type="tel" id="quotePhone" name="phone" value="{{ old('phone') }}"
                                placeholder="۰۹۱۲۰۰۰۰۰۰۰" required>
                            @error('phone')
                                <span class="quote-field-error">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="quote-field">
                            <label for="quoteCategory">نوع محصول</label>
                            <select id="quoteCategory" name="category" required>
                                <option value="" disabled @selected(!old('category'))>یک دسته را انتخاب کنید
                                </option>
                                <option value="carton" @selected(old('category') === 'carton')>کارتن مواد غذایی</option>
                                <option value="agriculture" @selected(old('category') === 'agriculture')>کارتن کشاورزی</option>
                                <option value="pharma" @selected(old('category') === 'pharma')>کارتن دارویی</option>
                                <option value="hygiene" @selected(old('category') === 'hygiene')>کارتن بهداشتی</option>
                                <option value="industrial" @selected(old('category') === 'industrial')>کارتن صنعتی</option>
                                <option value="other" @selected(old('category') === 'other')>سایر</option>
                            </select>
                            @error('category')
                                <span class="quote-field-error">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="quote-field">
                            <label for="quotePackaging">نوع بسته‌بندی مدنظر</label>
                            <select id="quotePackaging" name="packaging" required>
                                <option value="" disabled @selected(!old('packaging'))>یک گزینه را انتخاب کنید
                                </option>
                                <option value="export-carton" @selected(old('packaging') === 'export-carton')>کارتن چاپی</option>
                                <option value="gift-box" @selected(old('packaging') === 'gift-box')>کارتن لمینتی</option>
                                <option value="die-cut" @selected(old('packaging') === 'die-cut')>کارتن دایکاتی</option>
                            </select>
                            @error('packaging')
                                <span class="quote-field-error">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="quote-field">
                            <label for="quoteQuantity">تیراژ تقریبی</label>
                            <select id="quoteQuantity" name="quantity" required>
                                <option value="" disabled @selected(!old('quantity'))>یک بازه را انتخاب کنید
                                </option>
                                <option value="lt1000" @selected(old('quantity') === 'lt1000')>زیر ۱٬۰۰۰ عدد</option>
                                <option value="1k-5k" @selected(old('quantity') === '1k-5k')>۱٬۰۰۰ تا ۵٬۰۰۰ عدد</option>
                                <option value="5k-20k" @selected(old('quantity') === '5k-20k')>۵٬۰۰۰ تا ۲۰٬۰۰۰ عدد</option>
                                <option value="gt20k" @selected(old('quantity') === 'gt20k')>بالای ۲۰٬۰۰۰ عدد</option>
                            </select>
                            @error('quantity')
                                <span class="quote-field-error">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="quote-field">
                            <label for="quoteTimeline">زمان‌بندی مدنظر تحویل <span class="opt">(اختیاری)</span></label>
                            <select id="quoteTimeline" name="timeline">
                                <option value="" @selected(!old('timeline'))>انتخاب کنید</option>
                                <option value="urgent" @selected(old('timeline') === 'urgent')>فوری — زیر ۱ ماه</option>
                                <option value="1to2m" @selected(old('timeline') === '1to2m')>۱ تا ۲ ماه</option>
                                <option value="2to3m" @selected(old('timeline') === '2to3m')>۲ تا ۳ ماه</option>
                                <option value="unsure" @selected(old('timeline') === 'unsure')>هنوز مشخص نیست</option>
                            </select>
                            @error('timeline')
                                <span class="quote-field-error">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="quote-field">
                            <label for="quoteDimensions">ابعاد تقریبی <span class="opt">(اختیاری)</span></label>
                            <input type="text" id="quoteDimensions" name="dimensions"
                                value="{{ old('dimensions') }}" placeholder="مثلاً: ۲۰×۱۵×۱۰ سانتی‌متر">
                            @error('dimensions')
                                <span class="quote-field-error">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="quote-field">
                            <label for="quoteSheet">ترتیب ورق <span class="opt">(اختیاری)</span></label>
                            <select id="quoteSheet" name="sheet">
                                <option value="" @selected(!old('sheet'))>انتخاب کنید</option>
                                <option value="3-layer" @selected(old('sheet') === '3-layer')>۳ لایه</option>
                                <option value="5-layer" @selected(old('sheet') === '5-layer')>۵ لایه</option>
                            </select>
                            @error('sheet')
                                <span class="quote-field-error">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="quote-field full">
                            <label for="quoteFile">فایل تیغ و یا نمونه کارتن <span class="opt">(اختیاری، PDF یا
                                    تصویر)</span></label>
                            <label class="quote-file" id="quoteFileLabel" for="quoteFile">
                                <svg viewBox="0 0 24 24" fill="none" stroke-width="1.6">
                                    <path d="M12 3v12M7 10l5 5 5-5" />
                                    <path d="M4 19h16" />
                                </svg>
                                <span>فایل را انتخاب کنید یا بکشید و رها کنید</span>
                            </label>
                            <input type="file" id="quoteFile" name="file" accept="application/pdf,image/*">
                            @error('file')
                                <span class="quote-field-error">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="quote-field full">
                            <label for="quoteMessage">توضیحات پروژه <span class="opt">(اختیاری)</span></label>
                            <textarea id="quoteMessage" name="message"
                                placeholder="متریال مدنظر، مکانیزم بازشو، یا هر جزئیات دیگری که به ما در برآورد قیمت کمک می‌کند...">{{ old('message') }}</textarea>
                            @error('message')
                                <span class="quote-field-error">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="quote-form-foot">
                            <div>
                                <label class="quote-consent">
                                    <input type="checkbox" name="consent" value="1"
                                        {{ old('consent') ? 'checked' : '' }} required>
                                    <span>با ارسال این فرم، موافقت می‌کنم اطلاعات من برای بررسی و ارسال پیش‌فاکتور استفاده
                                        شود.</span>
                                </label>
                                @error('consent')
                                    <span class="quote-field-error">{{ $message }}</span>
                                @enderror
                            </div>
                            <button type="submit" class="btn-primary quote-submit-btn width-fit-content">ارسال درخواست
                                استعلام</button>
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
                        <h2>
                            پروژه بعدی برند شما
                            <br>
                            از اینجا شروع می‌شود
                        </h2>
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
    <script src="{{ asset('asset/js/quote.js') }}"></script>
    @if (session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const successBox = document.getElementById('quoteSuccess');
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
