@extends('layout.master')

@section('head')
    <title>خدمات ما | صدرا</title>
    <link rel="stylesheet" href="{{ asset('asset/css/services.css') }}">
@endsection

@section('main')

    @php
        $serviceItems = $service->items;
    @endphp

    <section class="svc-banner">
        <div class="svc-banner-icons" aria-hidden="true">
            <svg viewBox="0 0 34 34">
                <path d="M17 4 L30 12 L17 20 L4 12 Z" fill="none" stroke-width="1.2"/>
            </svg>

            <svg viewBox="0 0 34 34">
                <circle cx="17" cy="17" r="12" fill="none" stroke-width="1.2"/>
            </svg>

            <svg viewBox="0 0 34 34">
                <rect x="4" y="4" width="26" height="26" fill="none" stroke-width="1.2"/>
            </svg>
        </div>

        <div class="wrap svc-banner-inner">

            <p class="breadcrumb">
                <a href="{{ route('home') }}">خانه</a>
                <span class="sep">/</span>
                <span class="current">خدمات</span>
            </p>

            <span class="svc-banner-eyebrow">
                SADRA. — SERVICES
            </span>

            <h1 class="svc-banner-title">
                {{ $service->name }}
            </h1>

            <p class="svc-banner-lede">
                {{ $service->description }}
            </p>

            <nav class="svc-chip-nav">
                @foreach($serviceItems as $item)
                    <a
                        class="svc-chip"
                        href="#svc-{{ $item->id }}"
                    >
                        <b>{{ sprintf('%02d', $item->number) }}</b>
                        {{ $item->title }}
                    </a>
                @endforeach
            </nav>

        </div>
    </section>

    <section class="svc-explorer">
        <div class="wrap svc-explorer-grid">

            <aside class="svc-rail">
                <p class="svc-rail-label">
                    فهرست خدمات
                </p>

                <nav class="svc-rail-nav">
                    @foreach($serviceItems as $item)
                        <a
                            href="#svc-{{ $item->id }}"
                            data-target="svc-{{ $item->id }}"
                        >
                            <span>
                                {{ sprintf('%02d', $item->number) }}
                            </span>

                            <span>
                                {{ $item->title }}
                            </span>
                        </a>
                    @endforeach
                </nav>
            </aside>

            <div class="svc-rows">

                @foreach($serviceItems as $item)

                    <article
                        class="svc-row"
                        id="svc-{{ $item->id }}"
                        data-index="{{ sprintf('%02d', $item->number) }}"
                    >

                        <span class="svc-row-num">
                            {{ sprintf('%02d', $item->number) }}
                        </span>

                        <span class="svc-row-icon">
                            {!! $item->icon !!}
                        </span>

                        <div class="svc-row-body">

                            <h3>
                                {{ $item->title }}
                            </h3>

                            <p>
                                {{ $item->text }}
                            </p>

                            @if($item->tags->isNotEmpty())
                                <div class="svc-tags">
                                    @foreach($item->tags as $tag)
                                        <span class="svc-tag">
                                            {{ $tag->name }}
                                        </span>
                                    @endforeach
                                </div>
                            @endif

                        </div>

                    </article>

                @endforeach

            </div>

        </div>
    </section>

    <section class="impact-section">
        <div class="wrap">

            <div class="impact-bar">

                <div class="impact-item">
                    <span
                        class="impact-num"
                        data-count="{{ $service->projects_count }}"
                    >
                        <span class="suffix">+</span>
                    </span>

                    <p class="impact-label">
                        پروژه بسته‌بندی
                    </p>
                </div>

                <div class="impact-item">
                    <span
                        class="impact-num"
                        data-count="{{ $service->brands_count }}"
                    >
                        <span class="suffix">+</span>
                    </span>

                    <p class="impact-label">
                        برند همکار
                    </p>
                </div>

                <div class="impact-item">
                    <span
                        class="impact-num"
                        data-count="{{ $service->experience_years }}"
                    >
                        <span class="suffix"></span>
                    </span>

                    <p class="impact-label">
                        سال تجربه
                    </p>
                </div>

                <div class="impact-item">
                    <span
                        class="impact-num"
                        data-count="{{ $service->industries_count }}"
                    >
                        <span class="suffix">+</span>
                    </span>

                    <p class="impact-label">
                        صنعت مختلف
                    </p>
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
                            برای گفتگو درباره بسته‌بندی محصول‌تان، با تیم صدرا در تماس باشید.
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
    <script src="{{ asset('asset/js/services.js') }}"></script>
@endsection