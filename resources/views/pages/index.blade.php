@extends('layout.master')

@section('head')
    <title>صدرا | طراحی بسته‌بندی</title>
    <link rel="stylesheet" href="{{ asset('asset/css/style.css') }}">
    <style>
        .brand-logo img {
            min-width: 8rem;
            max-width: 15rem;
            min-height: 8rem;
            max-height: 5rem;
            object-fit: cover;
            display: block;
        }
    </style>
@endsection

@section('main')
    <section class="hero" id="hero">
        <span class="hero-glow"></span>
        <span class="hero-glow two"></span>
        <div class="hero-dots" aria-hidden="true"></div>
        <div class="hero-watermark latin" aria-hidden="true">SADRA</div>
        <svg class="reg-mark rm-tl" viewBox="0 0 20 20" aria-hidden="true">
            <circle cx="10" cy="10" r="7" fill="none" stroke="#cdb18e" stroke-width="1" />
            <line x1="10" y1="0" x2="10" y2="20" stroke="#cdb18e" stroke-width="1" />
            <line x1="0" y1="10" x2="20" y2="10" stroke="#cdb18e" stroke-width="1" />
        </svg>
        <svg class="reg-mark rm-br" viewBox="0 0 20 20" aria-hidden="true">
            <circle cx="10" cy="10" r="7" fill="none" stroke="#cdb18e" stroke-width="1" />
            <line x1="10" y1="0" x2="10" y2="20" stroke="#cdb18e" stroke-width="1" />
            <line x1="0" y1="10" x2="20" y2="10" stroke="#cdb18e" stroke-width="1" />
        </svg>

        <div class="wrap hero-inner">
            <div>
                <p class="hero-tag latin">
                    <span>SADRA. — packaging studio</span>
                </p>
                <h1>
                    <span class="line">
                        <span>طراحی بسته‌بندی،</span>
                    </span>
                    <span class="line">
                        <span>فراتر از ظاهر</span>
                    </span>
                </h1>
                <p class="hero-lede">جایی که ساختار، ماده و برند در یک تصمیم طراحی به هم می‌رسند.</p>
                <p class="hero-body">بسته‌بندی نخستین لحظه گفت‌وگوی برند شما با مخاطب است. صدرا این لحظه را با دقت
                    مهندسی، نگاه خلاق و شناخت واقعی از صنعت بسته‌بندی طراحی می‌کند؛ از اولین ایده تا خطی که روی تولید اجرا
                    می‌شود.</p>
                <div class="hero-buttons">
                    <a href="#work" class="btn-primary">دیدن نمونه‌کارها</a>
                    <a href="#contact" class="btn-ghost">شروع گفتگو</a>
                </div>
            </div>

            <div class="hero-visual">
                <div class="hero-chip chip-1">دای‌کات دقیق</div>
                <div class="hero-chip chip-2">چاپ افست</div>
                <div class="hero-chip chip-3">کاغذ گلاسه</div>
                <div class="hero-ring"></div>
                <div class="hero-ring r2"></div>

                <svg class="hero-seal" viewBox="0 0 200 200" aria-hidden="true">
                    <defs>
                        <path id="sealCircle" d="M100,100 m-78,0 a78,78 0 1,1 156,0 a78,78 0 1,1 -156,0" />
                    </defs>
                    <circle cx="100" cy="100" r="78" fill="none" stroke="#cdb18e" stroke-width="1"
                        opacity="0.55" />
                    <circle cx="100" cy="100" r="32" fill="none" stroke="#fffdf8" stroke-width="1"
                        opacity="0.5" />
                    <text font-size="11.5" letter-spacing="3" fill="#e2c9a3" opacity="0.9">
                        <textPath href="#sealCircle">SADRA. • PACKAGING STUDIO • SADRA. • PACKAGING STUDIO •
                        </textPath>
                    </text>
                </svg>

                <svg class="hero-box" viewBox="0 0 300 300">
                    <defs>
                        <radialGradient id="boxShadow" cx="50%" cy="50%" r="50%">
                            <stop offset="0%" stop-color="#000000" stop-opacity="0.38" />
                            <stop offset="100%" stop-color="#000000" stop-opacity="0" />
                        </radialGradient>
                        <linearGradient id="boxTop" x1="0%" y1="0%" x2="100%" y2="100%">
                            <stop offset="0%" stop-color="#f4e6cc" />
                            <stop offset="100%" stop-color="#dcc09a" />
                        </linearGradient>
                        <linearGradient id="boxLeft" x1="0%" y1="0%" x2="0%" y2="100%">
                            <stop offset="0%" stop-color="#d8b98d" />
                            <stop offset="100%" stop-color="#b7935f" />
                        </linearGradient>
                        <linearGradient id="boxRight" x1="0%" y1="0%" x2="0%" y2="100%">
                            <stop offset="0%" stop-color="#c2a173" />
                            <stop offset="100%" stop-color="#93764c" />
                        </linearGradient>
                    </defs>

                    <ellipse cx="150" cy="272" rx="102" ry="16" fill="url(#boxShadow)" />
                    <path d="M150 30 L250 85 L150 140 L50 85 Z" fill="url(#boxTop)" opacity="0.97" />
                    <path d="M50 85 L150 140 L150 260 L50 205 Z" fill="url(#boxLeft)" />
                    <path d="M250 85 L150 140 L150 260 L250 205 Z" fill="url(#boxRight)" />
                    <path class="crease" d="M150 140 L150 260" stroke="#22205f" stroke-width="1.5" opacity="0.45"
                        fill="none" />
                    <path class="crease" d="M50 85 L150 140 L250 85" fill="none" stroke="#fffdf8" stroke-width="1.5"
                        opacity="0.9" />
                    <path class="crease" d="M150 30 L150 140" stroke="#fffdf8" stroke-width="1" opacity="0.35"
                        fill="none" />
                </svg>
            </div>
        </div>

        <div class="scroll-cue">
            <span>اسکرول کنید</span>
            <span class="dot"></span>
        </div>
    </section>

    <div class="fold-rule">
        <svg viewBox="0 0 1200 34" preserveAspectRatio="none" aria-hidden="true">
            <path
                d="M0 34 L40 4 L80 34 L120 4 L160 34 L200 4 L240 34 L280 4 L320 34 L360 4 L400 34 L440 4 L480 34 L520 4 L560 34 L600 4 L640 34 L680 4 L720 34 L760 4 L800 34 L840 4 L880 34 L920 4 L960 34 L1000 4 L1040 34 L1080 4 L1120 34 L1160 4 L1200 34"
                fill="none" stroke="#cdb18e" stroke-width="1" opacity="0.5" />
        </svg>
    </div>

    <section class="brands">
        <p class="brands-label">برندهایی که به صدرا اعتماد کرده‌اند</p>

        <div class="marquee">
            <div class="marquee-track">
                @foreach ($brands as $brand)
                    <span class="brand-logo latin">
                        @if ($brand->img)
                            <img src="{{ asset($brand->img) }}" alt="{{ $brand->name }}">
                        @else
                            {{ $brand->name }}
                        @endif
                    </span>
                @endforeach
            </div>

            <div class="marquee-track" aria-hidden="true">
                @foreach ($brands as $brand)
                    <span class="brand-logo latin">
                        @if ($brand->img)
                            <img src="{{ asset($brand->img) }}" alt="{{ $brand->name }}">
                        @else
                            {{ $brand->name }}
                        @endif
                    </span>
                @endforeach
            </div>
        </div>
    </section>

    <section id="why">
        <div class="wrap">
            <div class="section-head reveal">
                <h2>چرا صدرا؟</h2>
                <p class="section-note">یک استودیوی تخصصی بسته‌بندی، نه یک آژانس تبلیغاتی عمومی.</p>
            </div>

            <div class="why-grid">
                @foreach ($whys as $why)
                    <div class="why-card reveal" style="--d:{{ $loop->index / 10 }}s">
                        {!! $why->class !!}
                        <h3>{{ $why->title }}</h3>
                        <p>{{ $why->text }}</p>
                    </div>
                @endforeach
            </div>

            <div class="stats-row">
                <div class="stat reveal" style="--d:0s">
                    <span class="num" data-count="120">
                        <span class="suffix">+</span>
                    </span>
                    <p class="label">پروژه بسته‌بندی</p>
                </div>

                <div class="stat reveal" style="--d:0.1s">
                    <span class="num" data-count="40">
                        <span class="suffix">+</span>
                    </span>
                    <p class="label">برند همکار</p>
                </div>

                <div class="stat reveal" style="--d:0.2s">
                    <span class="num" data-count="8">
                        <span class="suffix"></span>
                    </span>
                    <p class="label">سال تجربه</p>
                </div>

                <div class="stat reveal" style="--d:0.3s">
                    <span class="num" data-count="15">
                        <span class="suffix">+</span>
                    </span>
                    <p class="label">صنعت مختلف</p>
                </div>
            </div>
        </div>
    </section>

    <section id="services" class="work-showcase services-showcase">
        <div class="work-bg" aria-hidden="true">
            <div class="work-grid-lines"></div>
            <div class="work-glow services-glow"></div>
        </div>

        <div class="wrap">
            <div class="section-head reveal">
                <h2>خدمات ما</h2>
                <p class="section-note">از طراحی گرافیک بسته‌بندی تا ساختار فیزیکی و نظارت بر تولید — همه در یک تیم.</p>
            </div>

            <div class="services-grid">
                @if ($services->isNotEmpty())
                    @foreach ($services as $item)
                        <a href="{{ route('services', $item->id) }}" style="text-decoration: none;">
                            <div class="service-glass reveal" style="--d:{{ $loop->index * 0.08 }}s">
                                <span class="num">
                                    {{ sprintf('%02d', $loop->index + 1) }}
                                </span>

                                {!! $item->icon !!}

                                <h3>{{ $item->name }}</h3>

                                <p>{{ $item->description }}</p>

                                <span class="bottom-line"></span>
                            </div>
                        </a>
                    @endforeach
                @endif
            </div>
        </div>
    </section>

    <section class="process" id="process">
        <div class="wrap">
            <div class="section-head reveal">
                <h2>فرآیند سفارش گذاری</h2>
                <p class="section-note">یک مسیر مشخص و قابل پیش‌بینی، از شناخت برند تا آماده‌سازی برای تولید.</p>
            </div>

            <div class="process-track">
                <div class="process-connector">
                    <span></span>
                </div>

                <div class="process-list">
                    @foreach ($processes->sortBy('order') as $process)
                        <div class="process-item reveal" style="--d:{{ $loop->index / 10 }}s">
                            <span class="num-badge">
                                {{ sprintf('%02d', $process->order) }}
                            </span>
                            {!! $process->class !!}
                            <h3>{{ $process->title }}</h3>
                            <p>{{ $process->text }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <section id="work" class="work-showcase">
        <div class="work-bg" aria-hidden="true">
            <div class="work-grid-lines"></div>
            <div class="work-glow"></div>

            <svg class="drift drift-1" viewBox="0 0 100 100">
                <circle cx="50" cy="50" r="42" fill="none" stroke="#cdb18e" stroke-width="1.4"
                    stroke-dasharray="3 9" />
            </svg>

            <svg class="drift drift-2" viewBox="0 0 100 100">
                <rect x="18" y="18" width="64" height="64" fill="none" stroke="#cdb18e" stroke-width="1.4" />
            </svg>

            <svg class="drift drift-3" viewBox="0 0 100 100">
                <line x1="50" y1="10" x2="50" y2="90" stroke="#cdb18e"
                    stroke-width="1.4" />
                <line x1="10" y1="50" x2="90" y2="50" stroke="#cdb18e"
                    stroke-width="1.4" />
            </svg>

            <svg class="drift drift-4" viewBox="0 0 100 100">

                <path d="M50 8 L92 50 L50 92 L8 50 Z" fill="none" stroke="#cdb18e" stroke-width="1.4" />
            </svg>
        </div>

        <div class="wrap">
            <div class="section-head reveal">
                <h2>نمونه‌کارها</h2>
                <p class="section-note">گزیده‌ای از حوزه‌هایی که صدرا در آن‌ها بسته‌بندی طراحی کرده است.</p>
            </div>

            <div class="work-filters reveal">
                @foreach ($categories as $category)
                    <button class="filter-btn" data-filter="{{ $category->id }}">
                        {{ $category->name }}
                    </button>
                @endforeach
            </div>

            <div class="work-grid">
                @foreach ($products as $product)
                    <a href="{{ route('product', $product->id) }}" class="work-card reveal"
                        data-cat="{{ $product->category_id }}" style="--d:{{ $loop->index * 0.08 }}s">
                        <div class="work-card-inner">
                            <span class="work-corner"></span>

                            <div class="work-visual">
                                <img src="{{ $product->image ? asset($product->image) : asset('asset/img/p1.png') }}"
                                    alt="{{ $product->title ?: $product->name }}">
                            </div>

                            <div class="work-overlay">
                                <p class="cat">
                                    {{ $product->category?->name }}
                                </p>

                                <h3>
                                    {{ $product->title ?: $product->name }}
                                </h3>

                                <div class="work-excerpt-wrap">
                                    <p class="work-excerpt">
                                        {{ $product->description }}
                                    </p>

                                    <span class="work-link">
                                        مشاهده کامل
                                    </span>
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
            <div class="blog-all reveal">
                <a href="{{ route('products') }}" class="btn-outline1">مشاهده همه محصولات</a>
            </div>
        </div>
    </section>

    <section id="blog">
        <div class="wrap">
            <div class="section-head reveal">
                <h2>از وبلاگ صدرا</h2>
                <p class="section-note">
                    یادداشت‌هایی درباره طراحی، ساختار و صنعت بسته‌بندی.
                </p>
            </div>

            <div class="blog-grid">
                @foreach ($blogs as $blog)
                    <a href="{{ route('blog.post', ['id' => $blog->id]) }}" class="blog-card reveal"
                        style="--d:{{ $loop->index * 0.1 }}s">
                        <div class="blog-thumb">
                            @if ($blog->image)
                                <div class="blog-post-cover-icon">
                                    <img src="{{ asset($blog->image) }}" alt="{{ $blog->title }}">
                                </div>
                            @else
                                {!! $blog->icon !!}
                            @endif
                        </div>

                        <div class="blog-body">
                            <p class="blog-cat">
                                {{ $blog->main_tag }}
                            </p>

                            <h3>
                                {{ $blog->title }}
                            </h3>

                            <p>
                                {{ $blog->short_text }}
                            </p>

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

            <div class="blog-all reveal">
                <a href="{{ route('blog') }}" class="btn-outline">
                    مشاهده همه وبلاگ‌ها
                </a>
            </div>
        </div>
    </section>

    <section class="manifesto" id="about">
        <div class="wrap">
            <p class="reveal zoom">
                بسته‌بندی، جایی است که تصمیم برند به یک شیء تبدیل می‌شود.
                <span class="credit latin">SADRA.</span>
            </p>
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
                                    <path d="M4 5c0 8.5 6.5 15 15 15l2-4-6-2-2 2c-3-1.5-3.5-3.5-6.5-6.5l2-2-2-6z" />
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
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const marquee = document.querySelector('.marquee');
            const track = marquee?.querySelector('.marquee-track');

            if (!marquee || !track) return;

            const speed = 50;
            const originalItems = Array.from(track.children).map(item => item.cloneNode(true));

            let position = 0;
            let lastTime = 0;
            let frameId;
            let paused = false;

            function setup() {
                cancelAnimationFrame(frameId);
                track.innerHTML = '';

                for (let i = 0; i < 10; i++) {
                    originalItems.forEach(item => {
                        track.appendChild(item.cloneNode(true));
                    });
                }

                position = 0;
                lastTime = 0;
                track.style.transform = 'translateX(0px)';

                frameId = requestAnimationFrame(animate);
            }

            function animate(time) {
                if (paused) return;

                if (!lastTime) lastTime = time;

                const delta = Math.min((time - lastTime) / 1000, 0.05);
                lastTime = time;

                position += speed * delta;

                while (track.firstElementChild) {
                    const first = track.firstElementChild;
                    const gap = parseFloat(getComputedStyle(track).gap) || 0;
                    const itemWidth = first.getBoundingClientRect().width;
                    const totalWidth = itemWidth + gap;

                    if (-position < totalWidth) break;

                    position += totalWidth;
                    track.appendChild(first);
                }

                track.style.transform = `translateX(${position}px)`;
                frameId = requestAnimationFrame(animate);
            }

            marquee.addEventListener('mouseenter', () => {
                paused = true;
                cancelAnimationFrame(frameId);
            });

            marquee.addEventListener('mouseleave', () => {
                paused = false;
                lastTime = 0;
                frameId = requestAnimationFrame(animate);
            });

            window.addEventListener('resize', setup);

            setup();
        });
    </script>

    <script src="{{ asset('asset/js/script.js') }}"></script>
@endsection
