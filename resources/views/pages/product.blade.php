@extends('layout.master')

@section('head')
    <title>{{ $product->title }} | صدرا</title>
    <link rel="stylesheet" href="{{ asset('asset/css/product-detail.css') }}">
@endsection

@section('main')
    <div class="page-bg-anim" aria-hidden="true">
        <span class="pba-blob pba-1"></span>
        <span class="pba-blob pba-2"></span>
        <span class="pba-blob pba-3"></span>
    </div>

    <section class="product-crumb">
        <div class="wrap">
            <p class="breadcrumb">
                <a href="{{ route('home') }}">خانه</a>
                <span class="sep">/</span>
                <a href="{{ route('products') }}">محصولات</a>
                <span class="sep">/</span>
                <span class="current">{{ $product->title }}</span>
            </p>
        </div>
    </section>

    <section class="product-showcase">
        <div class="wrap product-showcase-grid" id="prodDetail">
            <div class="product-gallery">
                <span class="product-gallery-glow" aria-hidden="true"></span>
                <div class="product-gallery-perspective">
                    <div class="product-gallery-frame" id="prodGalleryFrame">
                        <svg class="reg-mark rm-tl" viewBox="0 0 20 20" aria-hidden="true">
                            <circle
                                cx="10"
                                cy="10"
                                r="7"
                                fill="none"
                                stroke="#22205f"
                                stroke-width="1"
                            />
                            <line
                                x1="10"
                                y1="0"
                                x2="10"
                                y2="20"
                                stroke="#22205f"
                                stroke-width="1"
                            />
                            <line
                                x1="0"
                                y1="10"
                                x2="20"
                                y2="10"
                                stroke="#22205f"
                                stroke-width="1"
                            />
                        </svg>

                        <img
                            id="prodImage"
                            src="{{ asset($product->image) }}"
                            alt="{{ $product->title }}"
                        >

                        <svg class="reg-mark rm-br" viewBox="0 0 20 20" aria-hidden="true">
                            <circle
                                cx="10"
                                cy="10"
                                r="7"
                                fill="none"
                                stroke="#22205f"
                                stroke-width="1"
                            />
                            <line
                                x1="10"
                                y1="0"
                                x2="10"
                                y2="20"
                                stroke="#22205f"
                                stroke-width="1"
                            />
                            <line
                                x1="0"
                                y1="10"
                                x2="20"
                                y2="10"
                                stroke="#22205f"
                                stroke-width="1"
                            />
                        </svg>
                    </div>
                </div>
            </div>

            <div class="product-info">
                <span
                    class="product-cat-pill reveal"
                    style="--d:0.05s"
                >
                    {{ $product->category->name ?? 'محصول' }}
                </span>

                <h1
                    class="reveal"
                    style="--d:0.12s"
                >
                    {{ $product->title }}
                </h1>

                <p
                    class="product-info-lede reveal"
                    style="--d:0.18s"
                >
                    {{ $product->description }}
                </p>

                <ul class="product-features">
                    @foreach($product->features as $feature)
                        <li>
                            {{ $feature->text }}
                        </li>
                    @endforeach
                </ul>

                <div
                    class="product-actions reveal"
                    style="--d:0.3s"
                >
                    <a href="#contact" class="btn-primary">
                        درخواست طراحی مشابه
                    </a>

                    <a
                        href="{{ route('products') }}"
                        class="btn-ghost"
                    >
                        بازگشت به محصولات
                    </a>
                </div>

                <div
                    class="product-trust reveal"
                    style="--d:0.36s"
                >
                    <div class="product-trust-item">
                        <svg
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke-width="1.6"
                        >
                            <path d="M12 2l3 7h7l-5.5 4.5L18.5 21 12 16.5 5.5 21l2-7.5L2 9h7z"/>
                        </svg>
                        <span>طراحی اختصاصی</span>
                    </div>

                    <div class="product-trust-item">
                        <svg
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke-width="1.6"
                        >
                            <circle cx="12" cy="12" r="9"/>
                            <path d="M12 7v5l3 3"/>
                        </svg>
                        <span>تحویل به‌موقع</span>
                    </div>

                    <div class="product-trust-item">
                        <svg
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke-width="1.6"
                        >
                            <path d="M3 7l9-4 9 4-9 4-9-4z"/>
                            <path d="M3 7v10l9 4 9-4V7"/>
                        </svg>
                        <span>نمونه‌سازی پیش از تولید</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="product-desc-section">
        <div class="wrap">
            <h2>درباره این پروژه</h2>

            <p>
                {{ $product->about }}
            </p>
        </div>
    </section>
    @if($relatedProducts->count())
        <section class="product-related">
            <div class="wrap">
                <div class="section-head reveal">
                    <h2>محصولات مشابه</h2>
                    <p class="section-note">
                        نمونه‌های دیگری از طراحی بسته‌بندی صدرا که ممکن است بپسندید.
                    </p>
                </div>

                <div class="prod-grid" id="prodRelated">
                    @foreach($relatedProducts as $relatedProduct)
                        <a
                            class="pcard reveal"
                            data-cat="{{ $relatedProduct->category_id }}"
                            href="{{ route('product', ['id' => $relatedProduct->id]) }}"
                        >
                            <div class="pcard-visual">
                                <span class="pcard-badge">
                                    {{ $relatedProduct->category->name ?? 'محصول' }}
                                </span>

                                <img
                                    src="{{ asset($relatedProduct->image) }}"
                                    alt="{{ $relatedProduct->title }}"
                                    loading="lazy"
                                >
                            </div>

                            <div class="pcard-body">
                                <h3>
                                    {{ $relatedProduct->title }}
                                </h3>

                                <p>
                                    {{ $relatedProduct->description }}
                                </p>

                                <div class="pcard-foot">
                                    <span>مشاهده محصول</span>

                                    <span class="pcard-arrow">
                                        <svg
                                            viewBox="0 0 24 24"
                                            fill="none"
                                            stroke="currentColor"
                                            stroke-width="2"
                                        >
                                            <path d="M14 6l-6 6 6 6"/>
                                        </svg>
                                    </span>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

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
                                    <circle cx="12" cy="9" r="2.4"/>
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
    <script src="{{ asset('asset/js/products-data.js') }}"></script>
    <script src="{{ asset('asset/js/product-detail.js') }}"></script>
@endsection
