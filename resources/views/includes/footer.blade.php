<style>
    .footer-subsidiaries .subsidiary-item {
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        gap: 8px;
    }

    .footer-subsidiaries .subsidiary-name {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        font-size: 15px;
        margin: 0;
        font-weight: 600;
    }

    .footer-subsidiaries .subsidiary-name svg {
        opacity: 0.6;
        transition: opacity 0.2s, transform 0.2s;
    }

    .footer-subsidiaries .subsidiary-name:hover svg {
        opacity: 1;
        transform: translate(2px, -2px);
    }

    .footer-subsidiaries .subsidiary-label {
        font-size: 12px;
        opacity: 0.65;
    }

    .footer-subsidiaries .subsidiary-phone {
        direction: ltr;
        font-size: 14px;
        letter-spacing: 0.3px;
        transition: opacity 0.2s;
    }

    .footer-subsidiaries .subsidiary-phone:hover {
        opacity: 0.7;
    }
</style>
<footer>
    <div class="wrap">
        <div class="footer-top">
            <div class="footer-brand">
                <div class="brand-name-fa">صدرا</div>
                <p>استودیوی طراحی بسته‌بندی صدرا؛ همراه برندها از ایده تا تولید.</p>
            </div>
            <div class="footer-cols">
                <div class="footer-col">
                    <h4>نقشه سایت</h4>
                    <a href="{{ route('home') }}#why">چرا ما</a>
                    <a href="{{ route('about') }}">درباره ما</a>
                    <a href="{{ route('home') }}#services">خدمات</a>
                    <a href="{{ route('products') }}">محصولات</a>
                    <a href="{{ route('home') }}#work">نمونه‌کارها</a>
                </div>
                <div class="footer-col">
                    <h4>کارشناسان فروش</h4>
                    <a href="tel:09135429933" dir="ltr">0913 542 9933</a>
                    <a href="tel:09135439933" dir="ltr">0913 543 9933</a>
                    <a href="tel:09135459933" dir="ltr">0913 545 9933</a>
                    <a href="tel:09135469933" dir="ltr">0913 546 9933</a>
                </div>
                <div class="footer-col footer-subsidiaries">
                    <h4>شرکت‌های زیرمجموعه</h4>
                    <div class="subsidiary-item">
                        <a href="https://malzino.com" target="_blank" rel="noopener noreferrer" class="subsidiary-name m-0"
                            dir="ltr">
                            Malzino
                            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="1.8">
                                <path
                                    d="M14 3h7v7M10 14 21 3M19 13v7a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V6a1 1 0 0 1 1-1h7" />
                            </svg>
                        </a>
                        <span class="subsidiary-label">واحد فروش ملزینو</span>
                        <a href="tel:09136432008" class="subsidiary-phone" dir="ltr">
                            0913 643 2008
                        </a>
                    </div>
                </div>
                <div class="footer-col">
                    <h4>شبکه‌های اجتماعی</h4>
                    <a href="#">اینستاگرام</a>
                    <a href="#">لینکدین</a>
                </div>

            </div>
        </div>
        <div class="footer-bottom">
            <span>© ۱۴۰۴ صدرا. تمامی حقوق محفوظ است.</span>
            <span class="en">SADRA.</span>
        </div>
    </div>
</footer>

<button class="to-top" id="toTop" aria-label="بازگشت به بالا">
    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
        <path d="M12 19V5M5 12l7-7 7 7" />
    </svg>
</button>
