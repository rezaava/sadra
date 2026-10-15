@extends('layout.master')

@section('no_chrome', '1')

@section('head')
    <title>ورود | صدرا</title>
    <link rel="stylesheet" href="{{ asset('asset/css/login.css') }}">
@endsection

@section('main')
    <div class="login-screen">
        <div class="login-brand">
            <a class="login-brand-top" href="{{ route('home') }}">
                <img src="{{ asset('asset/img/logo3.png') }}" alt="logo">
                <div>
                    <div class="brand-name-fa">صدرا</div>
                    <div class="brand-name-en">SADRA.</div>
                </div>
            </a>

            <div class="login-brand-mid">
                <svg class="login-art" viewBox="0 0 200 200" aria-hidden="true">
                    <defs>
                        <linearGradient id="lgTop" x1="0" y1="0" x2="1" y2="1">
                            <stop offset="0" stop-color="#f3e3c6"/>
                            <stop offset="1" stop-color="#cdb18e"/>
                        </linearGradient>
                        <linearGradient id="lgL" x1="0" y1="0" x2="0" y2="1">
                            <stop offset="0" stop-color="#cdb18e"/>
                            <stop offset="1" stop-color="#a88a63"/>
                        </linearGradient>
                        <linearGradient id="lgR" x1="0" y1="0" x2="0" y2="1">
                            <stop offset="0" stop-color="#b89b74"/>
                            <stop offset="1" stop-color="#8f7452"/>
                        </linearGradient>
                    </defs>

                    <path d="M100 22 L172 60 L100 98 L28 60 Z" fill="url(#lgTop)"/>
                    <path d="M28 60 L100 98 L100 178 L28 140 Z" fill="url(#lgL)"/>
                    <path d="M172 60 L100 98 L100 178 L172 140 Z" fill="url(#lgR)"/>
                    <path d="M64 41 L136 79" stroke="#fffdf8" stroke-opacity=".55" stroke-width="1.5" stroke-dasharray="4 4"/>
                    <path d="M100 98 L100 178" stroke="#fffdf8" stroke-opacity=".35" stroke-width="1.2" stroke-dasharray="4 4"/>
                </svg>

                <span class="login-eyebrow">SADRA. — client panel</span>

                <h1>پنل مشتریان <span>صدرا</span></h1>

                <p>
                    برای پیگیری سفارش‌ها، مشاهده‌ی پیش‌فاکتورها و ارتباط با تیم پروژه،
                    وارد حساب کاربری خود شوید.
                </p>

                <ul class="login-points">
                    <li>
                        <svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M20 6L9 17l-5-5"/>
                        </svg>
                        پیگیری لحظه‌ای وضعیت سفارش
                    </li>

                    <li>
                        <svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M20 6L9 17l-5-5"/>
                        </svg>
                        دسترسی به پیش‌فاکتورها و فایل‌های طراحی
                    </li>

                    <li>
                        <svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M20 6L9 17l-5-5"/>
                        </svg>
                        ارتباط مستقیم با تیم پروژه
                    </li>
                </ul>
            </div>

            <div class="login-brand-bottom">
                © ۱۴۰۴ صدرا. تمامی حقوق محفوظ است.
            </div>
        </div>

        <div class="login-panel">
            <div class="login-panel-inner">

                <div class="login-head">
                    <h2>ورود به حساب کاربری</h2>
                    <p>
                        حساب ندارید؟
                        <a href="{{ route('quote') }}">درخواست همکاری بدهید</a>
                    </p>
                </div>

                <div class="login-error-banner" id="loginErrorBanner">
                    <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke-width="1.8"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                    >
                        <circle cx="12" cy="12" r="9"/>
                        <path d="M12 8v5M12 16h.01"/>
                    </svg>

                    <span>جیمیل یا رمز عبور اشتباه است.</span>
                </div>

                <form class="login-form" id="loginForm" novalidate>

                    <div class="login-field">
                        <label for="loginGmail">جیمیل</label>

                        <input
                            type="email"
                            id="loginGmail"
                            name="gmail"
                            placeholder="example@gmail.com"
                            autocomplete="email"
                            inputmode="email"
                            required
                        >

                        <span class="login-field-error">
                            لطفاً یک جیمیل معتبر وارد کنید.
                        </span>
                    </div>

                    <div class="login-field">
                        <label for="loginPassword">رمز عبور</label>

                        <div class="login-password-wrap">
                            <input
                                type="password"
                                id="loginPassword"
                                name="password"
                                placeholder="••••••••"
                                autocomplete="current-password"
                                required
                                minlength="6"
                            >

                            <button
                                type="button"
                                class="login-toggle-pass"
                                id="loginTogglePass"
                                aria-label="نمایش رمز عبور"
                            >
                                <svg
                                    id="eyeOpen"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="1.7"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                >
                                    <path d="M1 12s4-7 11-7 11 7 11 7-4 7-11 7-11-7-11-7Z"/>
                                    <circle cx="12" cy="12" r="3"/>
                                </svg>

                                <svg
                                    id="eyeClosed"
                                    style="display:none"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="1.7"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                >
                                    <path d="M3 3l18 18"/>
                                    <path d="M10.6 10.6a3 3 0 0 0 4.24 4.24"/>
                                    <path d="M6.5 6.7C3.9 8.3 2 12 2 12s4 7 11 7c1.9 0 3.6-.5 5-1.2M19.4 17.3C21.1 15.7 22 12 22 12s-1.8-3.2-4.9-5.3"/>
                                </svg>
                            </button>
                        </div>

                        <span class="login-field-error">
                            رمز عبور باید حداقل ۶ کاراکتر باشد.
                        </span>
                    </div>

                    <div class="login-row">
                        <label class="login-remember">
                            <input type="checkbox" name="remember">
                            مرا به خاطر بسپار
                        </label>

                        <a class="login-forgot" href="#">
                            فراموشی رمز عبور؟
                        </a>
                    </div>

                    <button
                        type="submit"
                        class="btn-primary login-submit-btn"
                    >
                        <span class="spinner" aria-hidden="true"></span>
                        <span class="label">ورود</span>
                    </button>

                </form>

                <a class="login-back" href="{{ route('home') }}">
                    <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                    >
                        <path d="M14 6l-6 6 6 6"/>
                    </svg>
                    بازگشت به سایت
                </a>

            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('asset/js/login.js') }}"></script>
@endsection
