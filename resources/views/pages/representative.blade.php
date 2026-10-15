@extends('layout.master')
@section('head')
    <title>درخواست نمایندگی | صدرا</title>
    <link rel="stylesheet" href="{{ asset('asset/css/representative.css') }}">
@endsection
@section('main')
    <div class="page-bg-anim" aria-hidden="true">
        <span class="pba-blob pba-1"></span>
        <span class="pba-blob pba-2"></span>
        <span class="pba-blob pba-3"></span>
    </div>
    <section class="rep-hero">
        <div class="wrap">
            <p class="breadcrumb">
                <a href="{{ route('home') }}">خانه</a>
                <span class="sep">/</span>
                <span class="current">درخواست نمایندگی</span>
            </p>
            <div class="rep-hero-badge" aria-hidden="true">
                <svg viewBox="0 0 24 24" fill="none" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="M12 3 L21 8 L12 13 L3 8 Z"/><path d="M3 8 L3 16 L12 21 L21 16"/></svg>
            </div>
            <h1 class="rep-hero-title">درخواست
                <span class="accent-grad">نمایندگی صدرا</span>
            </h1>
            <p class="rep-hero-lede">اگر مایل به فروش، توزیع یا معرفی خدمات صدرا در شهر یا حوزه‌ی کاری خود هستید، فرم کوتاه زیر را پر کنید تا تیم ما با شما تماس بگیرد.</p>
        </div>
    </section>
    <section class="rep-section">
        <div class="wrap">
            <div class="rep-split reveal">
                <div class="rep-perks">
                    <h2>چرا نماینده صدرا شوید؟</h2>
                    <p>همکاری با استودیویی که از طراحی تا تولید، همه‌ی مسیر بسته‌بندی را پوشش می‌دهد.</p>
                    <div class="rep-perk-list">
                        <div class="rep-perk">
                            <span class="rep-perk-ic">
                                <svg viewBox="0 0 24 24" fill="none" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2v20M2 12h20"/></svg>
                            </span>
                            <div>
                                <h4>پشتیبانی فنی مستمر</h4>
                                <p>تیم فنی ما در طول همکاری همراه شماست، از مشاوره اولیه تا تحویل سفارش.</p>
                            </div>
                        </div>
                        <div class="rep-perk">
                            <span class="rep-perk-ic">
                                <svg viewBox="0 0 24 24" fill="none" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><path d="M3 12l6 6L21 6"/></svg>
                            </span>
                            <div>
                                <h4>کیفیت تضمین‌شده</h4>
                                <p>تمام سفارش‌ها پیش از تحویل، تحت کنترل کیفیت داخلی استودیو قرار می‌گیرند.</p>
                            </div>
                        </div>
                        <div class="rep-perk">
                            <span class="rep-perk-ic">
                                <svg viewBox="0 0 24 24" fill="none" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 3"/></svg>
                            </span>
                            <div>
                                <h4>پاسخ‌گویی سریع</h4>
                                <p>درخواست شما در کوتاه‌ترین زمان ممکن بررسی و پیگیری می‌شود.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="rep-form-panel">
                    <div class="rep-form-panel-head {{ session('success') ? 'hide' : '' }}" id="repFormHead">
                        <h3>فرم درخواست نمایندگی</h3>
                        <p>پر کردن این فرم فقط چند دقیقه زمان می‌برد.</p>
                    </div>
                    @if (session('success'))
                        <div class="rep-success show" id="repSuccess">
                            <span class="rep-success-icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg>
                            </span>
                            <h3>درخواست شما ثبت شد</h3>
                            <p>{{ session('success') }}</p>
                            <a href="{{ route('home') }}" class="btn-ghost">بازگشت به صفحه اصلی</a>
                        </div>
                    @else
                        <form class="rep-form" id="repForm" method="POST" action="{{ route('representative.store') }}">
                            @csrf
                            <div class="rep-field-row">
                                <div class="rep-field">
                                    <label for="repName">نام و نام خانوادگی</label>
                                    <input type="text" id="repName" name="name" value="{{ old('name') }}" placeholder="نام شما" required>
                                    @error('name')
                                        <span class="rep-field-error">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="rep-field">
                                    <label for="repCity">شهر / استان</label>
                                    <input type="text" id="repCity" name="city" value="{{ old('city') }}" placeholder="مثلاً: اصفهان" required>
                                    @error('city')
                                        <span class="rep-field-error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="rep-field-row">
                                <div class="rep-field">
                                    <label for="repPhone">شماره تماس</label>
                                    <input type="tel" id="repPhone" name="phone" value="{{ old('phone') }}" placeholder="۰۹۱۲۰۰۰۰۰۰۰" required>
                                    @error('phone')
                                        <span class="rep-field-error">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="rep-field">
                                    <label for="repEmail">ایمیل</label>
                                    <input type="email" id="repEmail" name="email" value="{{ old('email') }}" placeholder="example@email.com" required>
                                    @error('email')
                                        <span class="rep-field-error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="rep-field">
                                <label for="repType">نوع همکاری مدنظر</label>
                                <select id="repType" name="type" required>
                                    <option value="" disabled @selected(!old('type'))>یک گزینه را انتخاب کنید</option>
                                    <option value="sales" @selected(old('type') === 'sales')>پخش و فروش محصولات</option>
                                    <option value="online" @selected(old('type') === 'online')>نمایندگی فروش آنلاین</option>
                                    <option value="regional" @selected(old('type') === 'regional')>همکاری و پوشش منطقه‌ای</option>
                                    <option value="other" @selected(old('type') === 'other')>سایر</option>
                                </select>
                                @error('type')
                                    <span class="rep-field-error">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="rep-field">
                                <label for="repMessage">توضیح کوتاه <span class="opt">(اختیاری)</span></label>
                                <textarea id="repMessage" name="message" placeholder="سابقه فعالیت، حوزه کاری یا هر نکته‌ی دیگری...">{{ old('message') }}</textarea>
                                @error('message')
                                    <span class="rep-field-error">{{ $message }}</span>
                                @enderror
                            </div>
                            <label class="rep-consent">
                                <input type="checkbox" name="consent" value="1" {{ old('consent') ? 'checked' : '' }} required>
                                <span>با ارسال این فرم، موافقت می‌کنم اطلاعات من برای بررسی درخواست نمایندگی استفاده شود.</span>
                            </label>
                            @error('consent')
                                <span class="rep-field-error">{{ $message }}</span>
                            @enderror
                            <button type="submit" class="btn-primary rep-submit-btn">ارسال درخواست</button>
                        </form>
                    @endif
                </div>
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
                            <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="1.8">
                                <path d="M12 3 L21 8 L12 13 L3 8 Z"/>
                                <path d="M3 8 L3 16 L12 21 L21 16"/>
                                <path d="M12 13 L12 21"/>
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
                                    <rect x="3" y="5" width="18" height="14" rx="2"/>
                                    <path d="M3 7 L12 13 L21 7"/>
                                </svg>
                            </span>
                            <span class="en">SadraPacking@gmail.com</span>
                        </a>
                        <a class="cta-contact-row" href="tel:+989130032144">
                            <span class="cta-ic">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6">
                                    <path d="M4 5c0 8.5 6.5 15 15 15l2-4-6-2-2 2c-3-1.5-3-3.5-6.5-6.5l2-2-2-6z"/>
                                </svg>
                            </span>
                            <span class="en" dir="ltr">0913 003 2144</span>
                        </a>
                        <div class="cta-contact-row static">
                            <span class="cta-ic">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6">
                                    <path d="M12 21s7-6.5 7-12a7 7 0 1 0-14 0c0 5.5 7 12 7 12z"/>
                                    <circle cx="12" cy="9" r="2.4"/>
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
    <script src="{{ asset('asset/js/representative.js') }}"></script>
    @if (session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const successBox = document.getElementById('repSuccess');
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