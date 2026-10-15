<div class="grain-layer" aria-hidden="true"></div>
<div class="cursor-spotlight" id="cursorSpotlight" aria-hidden="true"></div>
<div class="scroll-progress" id="scrollProgress"></div>
<header id="siteHeader">
            <div class="wrap header-inner">
                <div class="brand-block">
                    <img src="{{ asset('asset/img/logo3.png') }}" alt="logo">
                    <div>
                        <div class="brand-name-fa">صدرا</div>
                        <div class="brand-name-en">SADRA.</div>
                    </div>
                </div>
                <button
                    class="menu-toggle"
                    aria-label="باز کردن منو"
                    aria-expanded="false"
                    id="menuToggle"
                >
                    <span></span>
                </button>
                <nav class="main-nav" id="mainNav">
                    <a href="{{ route('submit-portfolio') }}">ارسال نمونه‌کار</a>
                    <!-- <a href="#why">چرا ما</a> -->
                    <div class="nav-item">
                        <button
                            class="dropdown-trigger"
                            id="servicesTrigger"
                            aria-expanded="false"
                            aria-controls="servicesDropdown"
                        >
                            خدمات
                            <svg
                                class="chevron"
                                viewBox="0 0 12 12"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="1.6"
                            >
                                <path d="M2 4 L6 8 L10 4"/>
                            </svg>
                        </button>
                        <div class="dropdown-panel" id="servicesDropdown" role="menu">
@if($headerServices->isNotEmpty())
    @foreach($headerServices as $category)

        <div class="dd-category">

            <button class="dd-cat-trigger" aria-expanded="false">
                <span class="dd-icon">
                    @if($category->icon === 'identity')
                        <svg viewBox="0 0 34 34">
                            <rect x="4" y="4" width="26" height="26" fill="none" stroke="#22205f" stroke-width="1.4"/>
                            <line x1="4" y1="14" x2="30" y2="14" stroke="#cdb18e" stroke-width="1.4"/>
                        </svg>
                    @elseif($category->icon === 'consulting')
                        <svg viewBox="0 0 34 34">
                            <circle cx="17" cy="17" r="12" fill="none" stroke="#22205f" stroke-width="1.4"/>
                            <line x1="17" y1="9" x2="17" y2="17" stroke="#cdb18e" stroke-width="1.4"/>
                            <line x1="17" y1="17" x2="23" y2="20" stroke="#cdb18e" stroke-width="1.4"/>
                        </svg>
                    @elseif($category->icon === 'production')
                        <svg viewBox="0 0 34 34">
                            <rect x="4" y="10" width="26" height="18" fill="none" stroke="#22205f" stroke-width="1.4"/>
                            <path d="M4 10 L17 3 L30 10" fill="none" stroke="#cdb18e" stroke-width="1.4"/>
                        </svg>
                    @endif
                </span>

                <span class="dd-cat-title">
                    {{ $category->name }}
                </span>

                <svg
                    class="chevron-sm"
                    viewBox="0 0 12 12"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.6"
                >
                    <path d="M2 4 L6 8 L10 4"/>
                </svg>
            </button>

            <div class="dd-submenu">

                @foreach($category->services as $service)

                    <a
                        class="dropdown-item"
                        href="{{ route('services', $service->id) }}"
                        role="menuitem"
                    >
                        <span>
                            <span class="dd-title">
                                {{ $service->name }}
                            </span>

                            <span class="dd-sub">
                                {{ $service->description }}
                            </span>
                        </span>
                    </a>

                @endforeach

            </div>

        </div>

    @endforeach
@endif 
                        </div>
                    </div>
                    <a href="{{ route('home') }}#work">نمونه‌کارها</a>
                    <a href="{{ route('blog') }}">وبلاگ</a>
                    <a href="#contact">تماس</a>
                    <a href="{{ route('about') }}">درباره ما</a>
                    <a href="{{ route('join') }}">دعوت به همکاری</a>
                    <a href="{{ route('quote') }}">استعلام قیمت</a>
                    <a href="{{ route('representative') }}">درخواست نمایندگی</a>
                    <a href="#contact" class="mobile-cta">شروع پروژه</a>
                </nav>
                <a href="#contact" class="nav-cta">شروع پروژه</a>
            </div>
        </header>
