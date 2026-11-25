@if (app()->getLocale() === 'ar')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;500;600;700&display=swap" rel="stylesheet">
@else
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
@endif
<style>
.hj-lang-switch {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    margin: 0;
    color: inherit;
    font-size: 11px;
    letter-spacing: 1.2px;
    line-height: 1;
}
.hj-lang-switch button {
    background: none;
    border: 0;
    padding: 0;
    font: inherit;
    letter-spacing: inherit;
    color: inherit;
    cursor: pointer;
    opacity: 0.45;
}
.hj-lang-switch button.is-active {
    opacity: 1;
}
.hj-lang-switch button[lang="ar"] {
    font-family: "Cairo", sans-serif;
    letter-spacing: 0;
    text-transform: none;
    font-size: 13px;
}
.hj-lang-switch button[value="pk"],
.hj-lang-switch button[value="uae"] {
    text-transform: uppercase;
}
.hj-lang-divider {
    opacity: 0.4;
}
.hj-lang-mobile {
    padding: 16px 20px 4px;
}
.mobile-nav-icons .hj-lang-switch {
    color: #111;
    margin-inline-end: 4px;
}
.hj-lang-mobile-bar {
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 0 8px 8px;
    color: #111;
}
.hj-lang-mobile-bar .hj-lang-switch {
    gap: 10px;
    flex-wrap: nowrap;
    white-space: nowrap;
}
.hj-lang-mobile-bar .hj-lang-switch button {
    padding: 6px 2px;
    min-height: 32px;
}
html[dir="rtl"] body {
    font-family: "Cairo", "Helvetica Neue", Arial, sans-serif !important;
}
html[dir="rtl"] .header-left,
html[dir="rtl"] .main-nav,
html[dir="rtl"] .hj-title,
html[dir="rtl"] .hj-acc-btn,
html[dir="rtl"] .mega-menu .mega-heading,
html[dir="rtl"] .menu-section-title {
    letter-spacing: 0;
    text-transform: none;
}
html[dir="rtl"] .mega-menu .mega-heading,
html[dir="rtl"] .menu-section-title {
    font-family: "Cairo", sans-serif;
}
.header-static-tools .hj-lang-switch {
    position: relative;
    z-index: 10030;
    color: #111;
    margin-inline-end: 8px;
}
html:not([dir="rtl"]) .luxury-header .main-nav,
html:not([dir="rtl"]) .luxury-header .main-nav a,
html:not([dir="rtl"]) .luxury-header .main-nav button,
html:not([dir="rtl"]) .luxury-header .header-left,
html:not([dir="rtl"]) .luxury-header .header-left a,
html:not([dir="rtl"]) .luxury-header .header-right,
html:not([dir="rtl"]) .luxury-header .header-static-tools,
html:not([dir="rtl"]) .luxury-header .hj-lang-switch,
html:not([dir="rtl"]) .luxury-header .hj-lang-switch button {
    font-family: "Argent CF", Georgia, serif !important;
    font-weight: 100 !important;
    font-size: 14px !important;
    font-synthesis: none !important;
}
html:not([dir="rtl"]) header.mobile-header-main .hj-lang-switch,
html:not([dir="rtl"]) header.mobile-header-main .hj-lang-switch button {
    font-family: "Argent CF", Georgia, serif !important;
    font-weight: 100 !important;
    font-size: 11px !important;
    letter-spacing: 0.7px !important;
    font-synthesis: none !important;
}
html:not([dir="rtl"]) header.mobile-header-main .hj-lang-switch button[lang="ar"] {
    font-size: 12px !important;
    letter-spacing: 0 !important;
}
html[dir="rtl"] .mega-menu .mega-heading::after,
html[dir="rtl"] .menu-section-title::after {
    left: auto;
    right: 0;
}
html[dir="rtl"] .mega-menu .mega-link,
html[dir="rtl"] .mobile-submenu a,
html[dir="rtl"] .bespoke-showcase__name {
    direction: ltr;
    unicode-bidi: isolate;
}
html[dir="rtl"] .product-name-fixed:not(.product-detail-full-name),
html[dir="rtl"] .card-title:not(.product-detail-full-name) {
    direction: ltr;
    unicode-bidi: isolate;
}
html[dir="rtl"] .product-detail-full-name {
    direction: rtl;
    unicode-bidi: plaintext;
    text-align: right;
}
html[dir="rtl"] .ehed-body-text,
html[dir="rtl"] [class*="__copy"],
html[dir="rtl"] .momentu-copy,
html[dir="rtl"] .momentu-subtitle,
html[dir="rtl"] .momentu-section-title,
html[dir="rtl"] .mobileSub {
    font-family: "Cairo", sans-serif !important;
    letter-spacing: 0 !important;
    direction: rtl;
    text-align: start;
}
html[dir="rtl"] [class*="mobile"] [class*="__copy"],
html[dir="rtl"] [class*="__mobile-copy"],
html[dir="rtl"] [class*="__mobile-panel"] [class*="__copy"],
html[dir="rtl"] .ehed-content-container .ehed-body-text {
    text-align: center;
}
html[dir="rtl"] .ehed-category-label,
html[dir="rtl"] .book-appointment-btn,
html[dir="rtl"] .shop-now-btn,
html[dir="rtl"] [class*="__button"] {
    font-family: "Cairo", sans-serif !important;
    letter-spacing: 0 !important;
    text-transform: none;
}
html[dir="rtl"] .hj-filter-label,
html[dir="rtl"] .hj-filter-btn,
html[dir="rtl"] .hj-sort-toggle,
html[dir="rtl"] .hj-sort-dropdown button,
html[dir="rtl"] .hj-mobile-filter-open,
html[dir="rtl"] .hj-mobile-filter-head,
html[dir="rtl"] .hj-mobile-filter-title,
html[dir="rtl"] .hj-modal-sort-toggle,
html[dir="rtl"] .hj-modal-sort-dropdown button,
html[dir="rtl"] .hj-clear-btn,
html[dir="rtl"] .hj-clear-material-btn,
html[dir="rtl"] .hj-clear-price-btn,
html[dir="rtl"] .hj-material-item,
html[dir="rtl"] .hj-shape-item,
html[dir="rtl"] .hj-mobile-metal-list small,
html[dir="rtl"] .hj-mobile-shapes-grid span,
html[dir="rtl"] .hj-price-label-row,
html[dir="rtl"] .hj-price-inputs input,
html[dir="rtl"] .hj-mobile-view-products,
html[dir="rtl"] .hj-ring-hero-content h1,
html[dir="rtl"] .hj-ring-hero-content p,
html[dir="rtl"] .hj-ring-breadcrumb,
html[dir="rtl"] .hj-info-box h2,
html[dir="rtl"] .hj-info-box p,
html[dir="rtl"] .fm-hero__title,
html[dir="rtl"] .fm-intro-copy,
html[dir="rtl"] .fm-row__title,
html[dir="rtl"] .fm-split__copy,
html[dir="rtl"] .banner-location,
html[dir="rtl"] .heroText,
html[dir="rtl"] .heroText-last,
html[dir="rtl"] .triangleText,
html[dir="rtl"] .mobileText,
html[dir="rtl"] .heroBtn,
html[dir="rtl"] .mobileBtn,
html[dir="rtl"] .mobileSub,
html[dir="rtl"] .discover-more-btn,
html[dir="rtl"] .hj-card__text,
html[dir="rtl"] .writeup,
html[dir="rtl"] .product-details-info-col,
html[dir="rtl"] .product-detail-full-name,
html[dir="rtl"] .product-section-label,
html[dir="rtl"] .product-description,
html[dir="rtl"] .product-price-note,
html[dir="rtl"] .ring-size-heading,
html[dir="rtl"] .ring-size-toggle,
html[dir="rtl"] .product-action-btn,
html[dir="rtl"] .section-luxury-heading,
html[dir="rtl"] .asian-size-note {
    font-family: "Cairo", sans-serif !important;
    letter-spacing: 0 !important;
    text-transform: none;
}

/* Keep jewellery product details layout: image left, info right. */
html[dir="rtl"] .product-details-layout {
    direction: ltr !important;
}
html[dir="rtl"] .product-details-info-col {
    direction: rtl !important;
    text-align: right;
}
html[dir="rtl"] .product-details-info-col .product-action-btn,
html[dir="rtl"] .product-details-info-col .ring-size-toggle {
    text-align: center;
}

/* Keep collection carousel / Swiper arrows pointing the correct way in Arabic. */
html[dir="rtl"] .carousel-control-prev {
    left: 0 !important;
    right: auto !important;
}
html[dir="rtl"] .carousel-control-next {
    right: 0 !important;
    left: auto !important;
}
html[dir="rtl"] .carousel-control-prev-icon,
html[dir="rtl"] .carousel-control-next-icon {
    transform: none !important;
}
html[dir="rtl"] .swiper-button-prev,
html[dir="rtl"] .swiper-rtl .swiper-button-prev {
    left: var(--swiper-navigation-sides-offset, 10px) !important;
    right: auto !important;
}
html[dir="rtl"] .swiper-button-next,
html[dir="rtl"] .swiper-rtl .swiper-button-next {
    right: var(--swiper-navigation-sides-offset, 10px) !important;
    left: auto !important;
}
html[dir="rtl"] .swiper-button-prev::after,
html[dir="rtl"] .swiper-rtl .swiper-button-prev::after {
    content: "prev" !important;
    transform: none !important;
}
html[dir="rtl"] .swiper-button-next::after,
html[dir="rtl"] .swiper-rtl .swiper-button-next::after {
    content: "next" !important;
    transform: none !important;
}
</style>
@if (app()->getLocale() === 'ar')
<script>
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.swiper').forEach(function (el) {
        el.setAttribute('dir', 'ltr');
    });
}, true);
</script>
@endif
<script>
window.__HJ_REGION = {
    market: @json(session('market', app()->getLocale() === 'ar' ? 'uae' : 'pk')),
    source: @json(session('market_source', 'geo'))
};
(function () {
    var cfg = window.__HJ_REGION || {};

    function readCookie(name) {
        var parts = ('; ' + document.cookie).split('; ' + name + '=');
        if (parts.length < 2) {
            return '';
        }
        return parts.pop().split(';').shift();
    }

    function writeCookie(name, value) {
        document.cookie = name + '=' + value + ';path=/;max-age=15552000;SameSite=Lax';
    }

    function browserLocation() {
        var timezone = '';
        try {
            timezone = String(Intl.DateTimeFormat().resolvedOptions().timeZone || '');
        } catch (e) {}
        var language = String(navigator.language || navigator.userLanguage || '').toLowerCase();
        var offset = new Date().getTimezoneOffset();
        var utc = offset === 0 ? 'UTC' : ('UTC' + (offset > 0 ? '-' : '+') + Math.abs(offset / 60));

        return {
            timezone: timezone,
            language: language,
            offsetMinutes: offset,
            utc: utc
        };
    }

    function detectRegion(info) {
        var zone = String(info.timezone || '').toLowerCase();
        var language = info.language || '';
        var offset = info.offsetMinutes;

        if (zone === 'asia/dubai' || zone.indexOf('dubai') !== -1 || zone.indexOf('abu_dhabi') !== -1 || zone.indexOf('abudhabi') !== -1) {
            return 'uae';
        }
        if (zone === 'asia/karachi' || zone.indexOf('karachi') !== -1) {
            return 'pk';
        }
        if (language.indexOf('-ae') !== -1) {
            return 'uae';
        }
        if (language.indexOf('-pk') !== -1) {
            return 'pk';
        }
        if (offset === -240) {
            return 'uae';
        }
        if (offset === -300) {
            return 'pk';
        }
        return null;
    }

    function regionCheck() {
        var info = browserLocation();
        var detected = detectRegion(info);
        var result = {
            timezone: info.timezone,
            utc: info.utc,
            language: info.language,
            detected: detected || 'unknown',
            currentSite: cfg.market === 'uae' ? 'uae' : 'pk',
            source: cfg.source || 'geo',
            cookie: readCookie('hj_browser_region') || '(none)',
            url: window.location.href
        };
        console.log('[Hanif region]', result);
        return result;
    }

    window.hjRegionCheck = regionCheck;

    var info = browserLocation();
    var detected = detectRegion(info);
    regionCheck();

    if (cfg.source === 'manual') {
        return;
    }

    if (!detected) {
        return;
    }

    if (readCookie('hj_browser_region') !== detected) {
        writeCookie('hj_browser_region', detected);
    }

    var current = cfg.market === 'uae' ? 'uae' : 'pk';
    var params = new URLSearchParams(window.location.search);
    if (detected === current && (params.get('region') === detected || !params.get('region'))) {
        return;
    }
    if (params.get('region') === detected && params.get('auto') === '1') {
        return;
    }

    params.set('region', detected);
    params.set('auto', '1');
    window.location.replace(window.location.pathname + '?' + params.toString() + window.location.hash);
})();
</script>
