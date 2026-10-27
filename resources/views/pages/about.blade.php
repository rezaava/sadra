@extends('layout.master')

@section('head')
    <title>درباره ما | صدرا</title>
    <link rel="stylesheet" href="{{ asset('asset/css/about.css') }}">
@endsection

@section('main')
    <div class="page-bg-anim" aria-hidden="true">
        <span class="pba-blob pba-1"></span>
        <span class="pba-blob pba-2"></span>
        <span class="pba-blob pba-3"></span>
    </div>

    <section class="ab-hero">
        <span class="ab-hero-word" aria-hidden="true">SADRA</span>

        <div class="wrap ab-hero-grid">
            <div class="ab-hero-copy">

                <p class="breadcrumb">
                    <a href="{{ route('home') }}">خانه</a>
                    <span class="sep">/</span>
                    <span class="current">درباره ما</span>
                </p>

                <span class="ab-eyebrow">SADRA. — ABOUT</span>

                <h1 class="reveal">
                    {{ $about->title }}
                </h1>

                <p class="ab-lede reveal" style="--d:0.08s">
                    {{ Str::of(strip_tags($about->text))->before("\n") }}
                </p>

                <div class="ab-hero-buttons reveal" style="--d:0.16s">
                    <a href="#story" class="btn-primary">داستان ما</a>
                    <a href="#contact" class="btn-ghost">شروع پروژه</a>
                </div>

            </div>

            <div class="ab-hero-visual" aria-hidden="true">
                <span class="abv-glow"></span>
                <span class="abv-ring"></span>

                <div class="abv-card abv-1" style="--r:6deg">
                    <img src="{{ asset('asset/img/p1.png') }}" alt="">
                </div>

                <div class="abv-card abv-2" style="--r:-7deg">
                    <img src="{{ asset('asset/img/p3.png') }}" alt="">
                </div>

                <div class="abv-card abv-3" style="--r:3deg">
                    <img src="{{ asset('asset/img/p4.png') }}" alt="">
                </div>
            </div>
        </div>
    </section>

    <section class="ab-story" id="story">
        <div class="wrap ab-story-grid">

            <div class="ab-story-side reveal">
                <span class="ab-kicker">داستان ما</span>
                <h2>{{ $about->slogan }}</h2>
                <br>
                <img src="{{ asset($about->img) }}" alt="" style="border-radius: 10px;">
            </div>

            <div class="ab-story-body">
                {!! $about->text !!}
            </div>

        </div>
    </section>

    <section class="ab-stats">
        <div class="wrap">
            <div class="ab-stats-card reveal">

                <span class="ab-stats-glow" aria-hidden="true"></span>

                @foreach ($stats as $stat)
                    <div class="ab-stat">
                        <b data-count="{{ $stat->number }}"
                            data-suffix="{{ $stat->title === 'رضایت مشتریان' ? '٪' : '+' }}">
                            {{ $stat->number }}{{ $stat->title === 'رضایت مشتریان' ? '٪' : '+' }}
                        </b>

                        <span>{{ $stat->title }}</span>
                    </div>
                @endforeach

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
    <script src="{{ asset('asset/js/about.js') }}"></script>
@endsection
