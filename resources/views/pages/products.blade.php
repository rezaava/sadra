@extends('layout.master')

@section('head')
    <title>محصولات | صدرا</title>
    <link rel="stylesheet" href="{{ asset('asset/css/products-listing.css') }}">
@endsection

@section('main')
    <div class="page-bg-anim" aria-hidden="true">
        <span class="pba-blob pba-1"></span>
        <span class="pba-blob pba-2"></span>
        <span class="pba-blob pba-3"></span>
    </div>

    <section class="prod-hero">

        <div class="wrap prod-hero-grid">

            <div class="prod-hero-content">

                <p class="breadcrumb">
                    <a href="{{ route('home') }}">خانه</a>
                    <span class="sep">/</span>
                    <span class="current">محصولات</span>
                </p>

                <span class="prod-hero-eyebrow">
                    SADRA. — PRODUCTS
                </span>

                <h1 class="prod-hero-title">
                    محصولاتی که
                    <span class="accent-grad">
                        برای برندها ساخته‌ایم
                    </span>
                </h1>

                <p class="prod-hero-lede">
                    گزیده‌ای از بسته‌بندی‌های اجراشده برای برندهای مختلف؛
                    از کارتن صادراتی تا جعبه‌های لوکس و هدیه.
                    روی هر محصول کلیک کنید تا جزئیات کامل آن را ببینید.
                </p>

                <div class="prod-hero-stats">

                    <div class="prod-hero-stat">
                        <b>{{ $productsCount }}</b>
                        <span>محصول اجراشده</span>
                    </div>

                    <div class="prod-hero-stat">
                        <b>{{ $categoriesCount }}</b>
                        <span>دسته‌بندی</span>
                    </div>

                    <div class="prod-hero-stat">
                        <b>۱۰۰٪</b>
                        <span>طراحی اختصاصی</span>
                    </div>

                </div>

                <div class="prod-hero-buttons">

                    <a href="#prodListing" class="btn-primary">
                        مشاهده محصولات
                    </a>

                    <a href="#contact" class="btn-ghost">
                        شروع پروژه
                    </a>

                </div>

                <nav class="prod-chip-nav" id="prodChipNav" aria-label="دسته‌بندی سریع">

                    @foreach ($categories as $index => $category)
                        <a class="prod-chip" href="#cat-{{ $category->id }}">
                            <b>
                                {{ str_pad($index + 1, 2, '۰', STR_PAD_LEFT) }}
                            </b>

                            {{ $category->name }}
                        </a>
                    @endforeach

                </nav>

            </div>

            <div class="prod-hero-visual" aria-hidden="true">

                <span class="phv-glow"></span>
                <span class="phv-ring"></span>

                @foreach ($heroProducts as $index => $heroProduct)
                    <div class="phv-card phv-{{ $index + 1 }}">
                        <img src="{{ asset($heroProduct->image) }}" alt="{{ $heroProduct->title ?: $heroProduct->name }}">
                    </div>
                @endforeach
            </div>

        </div>

    </section>


    <section class="prod-listing">

        <div class="wrap">

            @foreach ($categories as $category)
                <div class="prod-group" id="cat-{{ $category->id }}">

                    <div class="prod-group-head reveal">

                        <h2>
                            {{ $category->name }}
                        </h2>

                        <span class="count">
                            {{ $category->products->count() }}
                            محصول
                        </span>

                    </div>


                    <div class="prod-grid">

                        @foreach ($category->products as $index => $product)
                            <a class="pcard reveal" style="--d:{{ number_format($index * 0.07, 2) }}s"
                                href="{{ route('product', $product->id) }}">

                                <div class="pcard-visual">

                                    <span class="pcard-badge">
                                        {{ $category->name }}
                                    </span>

                                    <img src="{{ $product->image ? asset($product->image) : asset('asset/img/p1.png') }}"
                                        alt="{{ $product->title ?: $product->name }}" loading="lazy">

                                </div>


                                <div class="pcard-body">

                                    <h3>
                                        {{ $product->title ?: $product->name }}
                                    </h3>

                                    <p>
                                        {{ $product->description }}
                                    </p>

                                    <div class="pcard-foot">

                                        <span>
                                            مشاهده محصول
                                        </span>

                                        <span class="pcard-arrow">

                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                <path d="M14 6l-6 6 6 6" />
                                            </svg>

                                        </span>

                                    </div>

                                </div>

                            </a>
                        @endforeach

                    </div>

                </div>
            @endforeach

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
                                <path d="M3 8 L3 16 L12 21 L21 16" />
                                <path d="M12 13 L12 21" />
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

                        <a href="mailto:SadraPacking@gmail.com" class="btn-primary cta-btn">
                            شروع گفتگو
                        </a>

                    </div>


                    <div class="cta-contacts reveal" style="--d:0.15s">

                        <a class="cta-contact-row" href="mailto:SadraPacking@gmail.com">

                            <span class="cta-ic">

                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6">
                                    <rect x="3" y="5" width="18" height="14" rx="2" />
                                    <path d="M3 7 L12 13 L21 7" />
                                </svg>

                            </span>

                            <span class="en">
                                SadraPacking@gmail.com
                            </span>

                        </a>


                        <a class="cta-contact-row" href="tel:+989130032144">

                            <span class="cta-ic">

                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6">
                                    <path d="M4 5c0 8.5 6.5 15 15 15l2-4-6-2-2 2c-3-1.5-5.5-3.5-6.5-6.5l2-2-2-6z" />
                                </svg>

                            </span>

                            <span class="en" dir="ltr">
                                0913 003 2144
                            </span>

                        </a>


                        <div class="cta-contact-row static">

                            <span class="cta-ic">

                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6">
                                    <path d="M12 21s7-6.5 7-12a7 7 0 1 0-14 0c0 5.5 7 12 7 12z" />
                                    <circle cx="12" cy="9" r="2.4" />
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
    <script src="{{ asset('asset/js/products-listing.js') }}"></script>
@endsection
