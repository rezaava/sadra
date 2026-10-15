@extends('layout.master')

@section('head')
    <title>{{ $blog->title }} | صدرا</title>
    <link rel="stylesheet" href="{{ asset('asset/css/blog-post.css') }}">
@endsection

@section('main')
    <div class="page-bg-anim" aria-hidden="true">
        <span class="pba-blob pba-1"></span>
        <span class="pba-blob pba-2"></span>
        <span class="pba-blob pba-3"></span>
    </div>

    <section class="blog-post-crumb">
        <div class="wrap">
            <p class="breadcrumb">
                <a href="{{ route('home') }}">خانه</a>
                <span class="sep">/</span>
                <a href="{{ route('blog') }}">وبلاگ</a>
                <span class="sep">/</span>
                <span class="current">{{ $blog->title }}</span>
            </p>
        </div>
    </section>

    <section class="blog-post-hero">
        <div class="wrap">
            @if ($blog->image)
                <div class="blog-post-cover-icon">
                    <img src="{{ asset($blog->image) }}" alt="{{ $blog->title }}">
                </div>
            @else
                <div class="blog-post-cover-icon" id="postCoverIcon" aria-hidden="true">
                    {!! $blog->icon !!}
                </div>
            @endif

            <span class="blog-post-cat-pill">
                {{ $blog->main_tag }}
            </span>

            <h1>{{ $blog->title }}</h1>

            <div class="blog-post-meta">
                <span>
                    {{ $blog->created_at->format('Y/m/d') }} </span>
                <span>
                    {{ $blog->reading_time }} مطالعه
                </span>
            </div>
        </div>
    </section>

    <section class="blog-post-body-wrap" id="blogPostBody">
        <div class="wrap">
            <p class="blog-post-lede">
                {{ $blog->short_text }}
            </p>

            <div class="blog-post-content">
                {!! $blog->text !!}
            </div>

            @if ($blog->tags->count())
                <div class="blog-post-tags">
                    @foreach ($blog->tags as $tag)
                        <span>
                            {{ $tag->name }}
                        </span>
                    @endforeach
                </div>
            @endif

            <div class="blog-post-share">
                <a href="{{ route('blog') }}" class="blog-post-back">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M14 6l-6 6 6 6" />
                    </svg>
                    بازگشت به وبلاگ
                </a>

                <div class="blog-post-share-links">
                    <a class="blog-post-share-link"
                        href="https://t.me/share/url?url={{ urlencode(request()->url()) }}&text={{ urlencode($blog->title) }}"
                        target="_blank" rel="noopener" aria-label="اشتراک‌گذاری در تلگرام">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                            <path d="M22 3 L2 11 L9 13 L11 20 L14 15 L20 19 Z" />
                        </svg>
                    </a>

                    <a class="blog-post-share-link"
                        href="mailto:?subject={{ urlencode($blog->title) }}&body={{ urlencode(request()->url()) }}"
                        aria-label="اشتراک‌گذاری با ایمیل">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6">
                            <rect x="3" y="5" width="18" height="14" rx="2" />
                            <path d="M3 7 L12 13 L21 7" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </section>

    @if ($relatedBlogs->count())
        <section class="blog-post-related">
            <div class="wrap">
                <div class="section-head reveal">
                    <h2>یادداشت‌های مرتبط</h2>
                    <p class="section-note">
                        مطالب دیگری از وبلاگ صدرا که ممکن است بپسندید.
                    </p>
                </div>

                <div class="blog-grid">
                    @foreach ($relatedBlogs as $relatedBlog)
                        <a href="{{ route('blog.post', ['id' => $relatedBlog->id]) }}" class="blog-card reveal"
                            style="--d:{{ $loop->index * 0.07 }}s" data-cat="{{ $relatedBlog->main_tag }}">
                            <div class="blog-thumb">
                                @if ($relatedBlog->image)
                                    <img src="{{ asset($relatedBlog->image) }}" alt="{{ $relatedBlog->title }}"
                                        loading="lazy">
                                @else
                                    <svg viewBox="0 0 34 34">
                                        <rect x="6" y="6" width="22" height="22" fill="none" stroke="#fffdf8"
                                            stroke-width="1.4" />
                                        <line x1="6" y1="16" x2="28" y2="16" stroke="#cdb18e"
                                            stroke-width="1.4" />
                                    </svg>
                                @endif
                            </div>

                            <div class="blog-body">
                                <p class="blog-cat">
                                    {{ $relatedBlog->main_tag }}
                                </p>

                                <h3>{{ $relatedBlog->title }}</h3>

                                <p>
                                    {{ $relatedBlog->short_text }}
                                </p>

                                <div class="blog-meta">
                                    <span>
                                        {{ $relatedBlog->reading_time }} مطالعه
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

                        <p>
                            برای گفتگو درباره بسته‌بندی محصول‌تان، با تیم صدرا در تماس باشید.
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

                            <span class="en">SadraPacking@gmail.com</span>
                        </a>

                        <a class="cta-contact-row" href="tel:+989130032144">
                            <span class="cta-ic">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6">
                                    <path d="M4 5c0 8.5 6.5 15 15 15l2-4-6-2-2 2c-3-1.5-5.5-3.5-6.5-6.5l2-2-2-6z" />
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
    <script src="{{ asset('asset/js/blog-post.js') }}"></script>
@endsection
