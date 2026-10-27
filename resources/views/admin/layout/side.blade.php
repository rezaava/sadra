<!-- Sidebar -->
<div class="offcanvas-lg offcanvas-start admin-sidebar" tabindex="-1" id="adminSidebar">
    <div class="offcanvas-header d-lg-flex align-items-center px-3 py-3">
        <a href="{{ route('admin.dashboard') }}" class="sidebar-brand">
            <span class="mark">
                <i class="bi bi-egg-fried"></i>
            </span>
            <span>
                صدراکو
                <small>پنل مدیریت</small>
            </span>
        </a>
        <button type="button" class="btn-close btn-close-white d-lg-none" data-bs-dismiss="offcanvas"
            data-bs-target="#adminSidebar" aria-label="بستن"></button>
    </div>

    <div class="offcanvas-body d-flex flex-column p-0">

        {{-- اصلی --}}
        <div class="sidebar-section-label">اصلی</div>
        <nav class="admin-nav">
            <a href="{{ route('admin.dashboard') }}"
                class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="bi bi-speedometer2"></i>
                داشبورد
            </a>
        </nav>

        {{-- مدیریت محتوا --}}
        <div class="sidebar-section-label">مدیریت محتوا</div>
        <nav class="admin-nav">
            <a href="{{ route('admin.products.index') }}"
                class="{{ request()->routeIs('admin.products.*') ? 'active' : '' }}">
                <i class="bi bi-box-seam"></i>
                محصولات
            </a>

            <a href="{{ route('admin.categories.index') }}"
                class="{{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
                <i class="bi bi-grid"></i>
                دسته‌بندی‌ها
            </a>

            <a href="{{ route('admin.brands.index') }}"
                class="{{ request()->routeIs('admin.brands.*') ? 'active' : '' }}">
                <i class="bi bi-tags"></i>
                برندها
            </a>

            <a href="{{ route('admin.services.index') }}"
                class="{{ request()->routeIs('admin.services.*') || request()->routeIs('admin.service-categories.*') ? 'active' : '' }}">
                <i class="bi bi-tools"></i>
                خدمات
            </a>

            <a href="{{ route('admin.blogs.index') }}"
                class="{{ request()->routeIs('admin.blogs.*') ? 'active' : '' }}">
                <i class="bi bi-journal-text"></i>
                بلاگ‌ها
            </a>
        </nav>

        {{-- مدیریت صفحات سایت --}}
        <div class="sidebar-section-label">مدیریت صفحات سایت</div>
        <nav class="admin-nav">
            <a href="{{ route('admin.about') }}"
                class="{{ request()->routeIs('admin.about', 'admin.about.update') ? 'active' : '' }}">
                <i class="bi bi-info-circle"></i>
                درباره ما
            </a>

            <a href="{{ route('admin.processes.index') }}"
                class="{{ request()->routeIs('admin.processes.*') ? 'active' : '' }}">
                <i class="bi bi-list-ol"></i>
                سفارش گذاری
            </a>
        </nav>

        {{-- درخواست‌ها --}}
        <div class="sidebar-section-label">درخواست‌ها</div>
        <nav class="admin-nav">
            <a href="{{ route('admin.requests.join') }}"
                class="{{ request()->routeIs('admin.requests.join*') ? 'active' : '' }}">
                <i class="bi bi-person-plus"></i>
                دعوت به همکاری
            </a>

            <a href="{{ route('admin.requests.quote') }}"
                class="{{ request()->routeIs('admin.requests.quote*') ? 'active' : '' }}">
                <i class="bi bi-file-earmark-text"></i>
                استعلام قیمت
            </a>

            <a href="{{ route('admin.requests.representative') }}"
                class="{{ request()->routeIs('admin.requests.representative*') ? 'active' : '' }}">
                <i class="bi bi-building-add"></i>
                درخواست نمایندگی
            </a>

            <a href="{{ route('admin.requests.portfolio') }}"
                class="{{ request()->routeIs('admin.requests.portfolio*') ? 'active' : '' }}">
                <i class="bi bi-briefcase"></i>
                ارسال نمونه‌کار
            </a>
        </nav>

        {{-- حساب کاربری --}}
        <div class="sidebar-section-label">حساب کاربری</div>
        <nav class="admin-nav">
            <a href="{{ route('logout') }}">
                <i class="bi bi-box-arrow-left"></i>
                خروج از حساب
            </a>
        </nav>

        {{-- پایین سایدبار --}}
        <div class="mt-auto">
            <div class="sidebar-footer admin-nav p-2">
                <a href="{{ route('home') }}">
                    <i class="bi bi-house-door"></i>
                    بازگشت به سایت
                </a>
            </div>
        </div>
    </div>
</div>