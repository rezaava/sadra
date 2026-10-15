@extends('layout.master')

@section('head')
    <title>وبلاگ | صدرا</title>
    <link rel="stylesheet" href="{{ asset('asset/css/blog.css') }}">
@endsection

@section('main')
    <div class="page-bg-anim" aria-hidden="true">
        <span class="pba-blob pba-1"></span>
        <span class="pba-blob pba-2"></span>
        <span class="pba-blob pba-3"></span>
    </div>

    <section class="blog-hero">
        <div class="wrap blog-hero-grid">
            <div class="blog-hero-content">
                <p class="breadcrumb">
                    <a href="{{ route('home') }}">خانه</a>
                    <span class="sep">/</span>
                    <span class="current">وبلاگ</span>
                </p>

                <span class="blog-hero-eyebrow">SADRA. — JOURNAL</span>

                <h1 class="blog-hero-title">
                    یادداشت‌هایی درباره
                    <span class="accent-grad">طراحی و صنعت بسته‌بندی</span>
                </h1>

                <p class="blog-hero-lede">
                    مروری بر تجربه‌های استودیوی صدرا در طراحی ساختاری، برندینگ و تولید؛ نوشته‌هایی برای برندهایی که می‌خواهند بسته‌بندی را جدی بگیرند.
                </p>

                <div class="blog-hero-stats">
                    <div class="blog-hero-stat">
                        <b>{{ $blogCount }}</b>
                        <span>یادداشت منتشرشده</span>
                    </div>

                    <div class="blog-hero-stat">
                        <b>{{ $categoryCount }}</b>
                        <span>دسته‌بندی</span>
                    </div>

                    <div class="blog-hero-stat">
                        <b>هفتگی</b>
                        <span>به‌روزرسانی</span>
                    </div>
                </div>

                <div class="blog-hero-buttons">
                    <a href="#blogListing" class="btn-primary">
                        مشاهده یادداشت‌ها
                    </a>

                    <a href="#contact" class="btn-ghost">
                        شروع گفتگو
                    </a>
                </div>

                <nav class="blog-chip-nav" id="blogChipNav" aria-label="دسته‌بندی سریع">
                    @foreach($groups as $category => $categoryBlogs)
                        <a
                            class="blog-chip"
                            href="#cat-{{ Str::slug($category) }}"
                        >
                            <b>{{ $loop->iteration }}</b>
                            {{ $category }}
                        </a>
                    @endforeach
                </nav>
            </div>

            <div class="blog-hero-visual" aria-hidden="true">
                <span class="bhv-glow"></span>
                <span class="bhv-ring"></span>

                @foreach($blogs->take(3) as $index => $blog)
                    <div class="bhv-card bhv-{{ $index + 1 }}">
                        <span class="bhv-tag">
                            {{ $blog->main_tag }}
                        </span>

                        <h4>{{ $blog->title }}</h4>

                        <p>{{ $blog->reading_time }} مطالعه</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    @if($blogs->count())
        @php
            $featured = $blogs->first();
        @endphp

        <section class="blog-featured-wrap">
            <div class="wrap">
                <div id="blogFeatured">
                    <a
                        href="{{ route('blog.post', ['id' => $featured->id]) }}"
                        class="blog-featured reveal"
                    >
                        <div class="blog-featured-visual">
                            <span class="blog-featured-badge">
                                تازه‌ترین یادداشت
                            </span>

                            @if ($featured->image)
                                <div class="blog-post-cover-icon">
                                    <img src="{{ asset($featured->image) }}" alt="{{ $featured->title }}">
                                </div>
                            @else
                                <div class="blog-post-cover-icon" id="postCoverIcon" aria-hidden="true">
                                    {!! $featured->icon !!}
                                </div>
                            @endif
                        </div>

                        <div class="blog-featured-body">
                            <p class="blog-featured-cat">
                                {{ $featured->main_tag }}
                            </p>

                            <h3>{{ $featured->title }}</h3>

                            <p>{{ $featured->short_text }}</p>

                            <div class="blog-meta">
                                <span>
                                    {{ $featured->reading_time }} مطالعه
                                </span>

                                <span class="blog-read">
                                    ادامه مطلب
                                    <span class="arrow">‹</span>
                                </span>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </section>
    @endif

    <section class="blog-listing" id="blogListingSection">
        <div class="wrap">
            <div id="blogListing">
                @foreach($groups as $category => $categoryBlogs)
                    <div
                        class="blog-group"
                        id="cat-{{ Str::slug($category) }}"
                    >
                        <div class="blog-group-head reveal">
                            <h2>{{ $category }}</h2>

                            <span class="count">
                                {{ $categoryBlogs->count() }} مطلب
                            </span>
                        </div>

                        <div class="blog-grid">
                            @foreach($categoryBlogs as $blog)
                                <a
                                    href="{{ route('blog.post', ['id' => $blog->id]) }}"
                                    class="blog-card reveal"
                                    style="--d:{{ ($loop->index * 0.07) }}s"
                                    data-cat="{{ Str::slug($category) }}"
                                >
                                    <div class="blog-thumb">
                                        @if ($blog->image)
                                            <div class="blog-post-cover-icon">
                                                <img src="{{ asset($blog->image) }}" alt="{{ $blog->title }}">
                                            </div>
                                        @else
                                            <div class="blog-post-cover-icon" id="postCoverIcon" aria-hidden="true">
                                                {!! $blog->icon !!}
                                            </div>
                                        @endif
                                    </div>

                                    <div class="blog-body">
                                        <p class="blog-cat">
                                            {{ $blog->main_tag }}
                                        </p>

                                        <h3>{{ $blog->title }}</h3>

                                        <p>{{ $blog->short_text }}</p>

                                        <div class="blog-meta">
                                            <span>
                                                {{ $blog->reading_time }} مطالعه
                                            </span>

                                            <span class="blog-read">
                                                ادامه مطلب
                                                <span class="arrow">‹</span>
                                            </span>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        </div>
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

                    <div class="cta-contacts reveal" style="--d:0.15s">
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
                                    <path d="M4 5c0 8.5 6.5 15 15 15l2-4-6-2-2 2c-3-1.5-5.5-3.5-6.5-6.5l2-2-2-6z"/>
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

                            <span>یزد -میدان قران -بلوار خاتم یزدی-ساختمان صدرا طبقه ۳</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('js')
    <script src="{{ asset('asset/js/blog-listing.js') }}"></script>
@endsection
