@extends('layout.master')

@section('no_chrome', '1')

@section('head')
    <title>صدرا</title>
    <link rel="stylesheet" href="{{ asset('asset/css/intro.css') }}">
@endsection

@section('main')
    <div class="intro-stage" id="introStage">
        <div class="intro-bg" id="introBg"></div>
        <div class="intro-grain"></div>
        <div class="intro-particles" id="introParticles"></div>

        <div class="intro-shapes" aria-hidden="true">
            <div class="intro-shape is-1">
                <svg viewBox="0 0 100 100" stroke-width="1.1"><rect x="12" y="12" width="76" height="76"/><line x1="12" y1="38" x2="88" y2="38"/></svg>
            </div>
            <div class="intro-shape is-2">
                <svg viewBox="0 0 100 100" stroke-width="1.2"><circle cx="50" cy="50" r="38"/></svg>
            </div>
            <div class="intro-shape is-3">
                <svg viewBox="0 0 100 100" stroke-width="1.1"><path d="M50 6 L94 30 L50 54 L6 30 Z"/><path d="M6 30 L6 70 L50 94 L94 70 L94 30"/></svg>
            </div>
            <div class="intro-shape is-4">
                <svg viewBox="0 0 100 100" stroke-width="1.3"><path d="M50 4 L96 50 L50 96 L4 50 Z"/></svg>
            </div>
            <div class="intro-shape is-5">
                <svg viewBox="0 0 100 100" stroke-width="1.3"><rect x="18" y="18" width="64" height="64" rx="6"/></svg>
            </div>
        </div>

        <div class="intro-loader" id="introLoader">
            <div class="intro-loader-ring">
                <svg viewBox="0 0 84 84" width="84" height="84">
                    <defs>
                        <linearGradient id="introGrad" x1="0%" y1="0%" x2="100%" y2="100%">
                            <stop offset="0%" stop-color="#e6c99a"/>
                            <stop offset="55%" stop-color="#cdb18e"/>
                            <stop offset="100%" stop-color="#e08a5c"/>
                        </linearGradient>
                    </defs>
                    <circle class="intro-loader-track" cx="42" cy="42" r="36"/>
                    <circle class="intro-loader-bar" id="introLoaderBar" cx="42" cy="42" r="36"/>
                </svg>
                <img class="intro-loader-mark" src="{{ asset('asset/img/logo3.png') }}" alt="">
            </div>
            <span class="intro-loader-pct" id="introLoaderPct">۰٪</span>
        </div>

        <div class="intro-content">
            <span class="intro-badge">
                <span class="intro-badge-dot"></span>
                SADRA. — PACKAGING STUDIO
            </span>
            <div class="intro-title-wrap">
                <h1 class="intro-title">صنایع بسته‌بندی <span class="accent-grad">صدرا</span></h1>
            </div>
            <p class="intro-tagline">جایی که بسته‌بندی از یک ایده ساده، به تجربه‌ای می‌رسد که برند شما را به یاد ماندنی می‌کند.</p>
            <button class="intro-cta" id="introEnterBtn" data-href="{{ route('home') }}" type="button">
                ورود به سایت
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 12H5M11 18l-6-6 6-6"/></svg>
            </button>
            <p class="intro-hint">استودیوی طراحی و تولید بسته‌بندی</p>
        </div>
    </div>
    <div class="intro-wash" id="introWash"></div>
@endsection

@section('js')
    <script src="{{ asset('asset/js/intro.js') }}"></script>
@endsection
