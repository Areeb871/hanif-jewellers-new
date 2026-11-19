@extends('public.layouts.header_black_white_fixed')

@section('content')
@php
    $fallbackBanner = 'assets/f_assets/image/ehed/ehed banner.mp4';
    $videoExtensions = ['mp4', 'webm', 'ogg'];

    $desktopBannerSource = optional($subcategory)->banner_url ?: $fallbackBanner;
    $mobileBannerSource = optional($subcategory)->banner_mobile_url ?: $desktopBannerSource;

    $desktopPath = parse_url($desktopBannerSource, PHP_URL_PATH) ?? $desktopBannerSource;
    $mobilePath = parse_url($mobileBannerSource, PHP_URL_PATH) ?? $mobileBannerSource;

    $desktopExtension = strtolower(pathinfo($desktopPath, PATHINFO_EXTENSION));
    $mobileExtension = strtolower(pathinfo($mobilePath, PATHINFO_EXTENSION));

    $desktopIsVideo = in_array($desktopExtension, $videoExtensions);
    $mobileIsVideo = in_array($mobileExtension, $videoExtensions);

    $desktopType = $desktopIsVideo && $desktopExtension ? 'video/' . $desktopExtension : null;
    $mobileType = $mobileIsVideo && $mobileExtension ? 'video/' . $mobileExtension : null;

    $desktopBannerUrl = filter_var($desktopBannerSource, FILTER_VALIDATE_URL) ? $desktopBannerSource : asset($desktopBannerSource);
    $mobileBannerUrl = filter_var($mobileBannerSource, FILTER_VALIDATE_URL) ? $mobileBannerSource : asset($mobileBannerSource);
@endphp
<style>
@import url('https://fonts.googleapis.com/css2?family=Cinzel:wght@400;600;700&family=Poppins:wght@400;500;600&display=swap');
@font-face{
    font-family:"Argent CF";
    src:url("{{ asset('assets/f_assets/css/fonts/fonnts.com-Argent-CF-.otf') }}") format("opentype");
    font-weight:400;
    font-style:normal;
    font-display:swap;
}

/* ========== ONE GAP EVERYWHERE ========== */
:root{ --ehed-gap:8px; }

/* ========== HERO ========== */
.ehed-hero-section{
    display:flex;
    flex-direction:column;
    align-items:stretch;
}
.ehed-video-container{
    width:100%;
    position:relative;
    overflow:hidden;
    flex-shrink:0;
    height:auto;
    background:#000;
}
.ehed-video-container video,
.ehed-media-cover{
    position:static;
    width:100%;
    height:auto;
    object-fit:contain;
    object-position:center center;
    display:block;
}
.ehed-content-container{
    width:50%;
    min-width:0;
    box-sizing:border-box;
    padding:8px 24px;
    display:flex;
    flex-direction:column;
    justify-content:center;
    background:#fff;
}
.ehed-category-label{
    font-size:14px; font-weight:400; color:#999; text-transform:uppercase;
    letter-spacing:.05em;
    font-family:'Poppins',sans-serif;
    margin:0 0 16px;
}
.ehed-main-title{
    font-size:3rem; color:#000; font-family:"Argent CF",Georgia,serif;
    margin:0 0 10px; line-height:1.1; font-weight:400;
}
.ehed-body-text{
    font-size:16px; font-weight:400; color:#000; line-height:1.6; max-width:100%;
    font-family:'Poppins',sans-serif;
}
.hero__description{ margin-top:0; font-size:100%; max-width:100%; }
.text-large{
    font-family:Walbaum,sans-serif; color:#010307; font-style:normal;
    font-weight:400; line-height:120%; font-size:2rem; letter-spacing:1.6px;
}
.uppercase{ text-transform:uppercase; }
h1,h2,h3,h4,h5,h6{ margin-top:0; margin-bottom:0; }

@media(min-width:48rem){
    .hero__description{ max-width:40rem; font-size:100%; }
    .text-align--center .hero__description{ margin-left:auto; margin-right:auto; }
}
@media(min-width:699px){ .text-large{ font-size:2.5rem; letter-spacing:2px; } }
@media(min-width:1024px){ .text-large{ font-size:3rem; letter-spacing:2.4px; } }

@media(max-width:991.98px){
    .ehed-hero-section{ padding-top:56px; }
}
@media(min-width:768px){
    .ehed-content-container{ padding:8px 40px; }
    .ehed-cards{ margin-top: var(--ehed-gap); }
}
@media(min-width:768px) and (max-width:1199.98px){
    .ehed-hero-section{ align-items:stretch; }
    .ehed-video-container{
        min-height:0;
        height:auto;
    }
    .ehed-content-container{
        padding:8px 28px;
        overflow:visible;
        justify-content:center;
    }
    .ehed-category-label{ font-size:12px; margin:0 0 8px; }
    .ehed-main-title{ font-size:clamp(28px,3.6vw,42px); line-height:1.1; margin:0 0 8px; overflow:visible; }
    .ehed-body-text{ font-size:14px; line-height:1.55; }
    .hero__description{ max-width:100%; font-size:100%; }
}
@media(min-width:1200px){
    .ehed-content-container{ padding:8px 60px; }
}
@media(max-width:767.98px){
    .ehed-hero-section{ flex-direction:column; min-height:auto; }
    .ehed-video-container{ width:100%; height:auto; }
    .ehed-content-container{ width:100%; padding:24px 20px; }
    .ehed-main-title{ font-size:48px; }
    .ehed-category-label{ font-size:12px; }
    .ehed-body-text{ font-size:14px; }
}
@media(max-width:576px){
    .ehed-main-title{ font-size:36px; }
    .ehed-content-container{ padding:30px 20px; }
}

/* ========== DISCOVER BUTTON ========== */
.discover-button-overlay{
    z-index:20; pointer-events:none; padding-bottom:2rem;
    left:0; right:0; bottom:0;
}
.discover-btn{
    background-color:transparent; border:1px solid rgba(255,255,255,.7);
    color:#fff; font-weight:600; font-size:1rem; letter-spacing:2px;
    text-transform:uppercase; border-radius:4px; pointer-events:auto;
    transition:all .3s ease; padding:.75rem 3rem;
    white-space:nowrap; display:inline-block; text-decoration:none;
}
.discover-btn:hover{ background-color:rgba(128,128,128,.8); color:#fff; transform:scale(1.05); text-decoration:none; }
.discover-btn:active{ transform:scale(.98); }

@media(min-width:992px){ .discover-btn{ padding:.875rem 3.5rem; } .discover-button-overlay{ padding-bottom:3rem; } }
@media(max-width:768px){
    .discover-button-overlay{ padding-bottom:1.5rem!important; z-index:20!important; bottom:0!important; position:absolute!important; }
    .discover-btn{ font-size:.875rem; padding:.625rem 1.5rem!important; letter-spacing:1.5px; width:auto; max-width:90%; }
}
@media(max-width:576px){
    .discover-btn{ font-size:.75rem; padding:.5rem 1.25rem!important; letter-spacing:1px; }
    .discover-button-overlay{ padding-bottom:1rem!important; }
}
@media(max-width:480px){
    .discover-btn{ font-size:1.2rem; padding:.5rem 1rem!important; letter-spacing:.5px; }
    .discover-button-overlay{ padding-bottom:.875rem!important; }
}
@media(max-width:375px){
    .discover-btn{ font-size:1.1rem; padding:.45rem .875rem!important; letter-spacing:.5px; }
    .discover-button-overlay{ padding-bottom:.75rem!important; }
}
@media(max-width:375px)and(max-height:667px){ .discover-button-overlay{ display:none!important; } }
@media(max-width:414px)and(max-height:736px)and(min-width:376px){ .discover-button-overlay{ display:none!important; } }
@media(max-width:360px){
    .discover-button-overlay{ bottom:auto!important; top:80%!important; left:50%!important; transform:translate(-50%,-50%)!important; padding-bottom:0!important; }
}

/* ========== CARDS: same 8px gap top-to-bottom and left-to-right ========== */
.ehed-cards{
    display:flex;
    flex-direction:column;
    gap: 8px;
    margin: 8px 0 0;
    padding: 0;
}
.ehed-cards img{ display:block; }
.ehed-grid{
    display:grid;
    grid-template-columns:repeat(4, minmax(0,1fr));
    gap: 8px;
    margin:0 !important;
    --bs-gutter-x:0;
    --bs-gutter-y:0;
}
.ehed-grid > [class*="col-"]{
    width:auto;
    max-width:none;
    padding:0;
    margin:0;
    line-height:0;
}
.ehed-grid-img{
    width:100%; aspect-ratio:1/1; object-fit:cover; display:block;
    vertical-align:top;
}
@media(max-width:767.98px){
    .ehed-grid{ grid-template-columns:repeat(2, minmax(0,1fr)); }
}

/* ========== PROMO SECTION (carousel + right images) ========== */
.ehed-promo{
    margin:0 !important;
    padding:0;
}
.ehed-promo .discover-btn,
.ehed-promo .shop-now-btn{
    border-color:#ECECEC !important;
    color:#ECECEC !important;
}
.ehed-promo .discover-btn:hover,
.ehed-promo .shop-now-btn:hover,
.ehed-promo .discover-btn:focus,
.ehed-promo .shop-now-btn:focus{
    background:#000 !important;
    border-color:#000 !important;
    color:#fff !important;
}

.ehed-promo__row{
    display:grid;
    grid-template-columns:repeat(4, minmax(0,1fr));
    gap: 8px;
    align-items:stretch;
}

/* Carousel col */
.ehed-promo__carousel-col{
    grid-column:span 2;
    min-width:0; min-height:0;
}
.ehed-promo__carousel-wrap{
    position:relative; width:100%; height:100%; overflow:hidden;
}
#promoCarouselEhed{ position:absolute; inset:0; width:100%; height:100%; }
#promoCarouselEhed .carousel-inner,
#promoCarouselEhed .carousel-item{ height:100%; }
#promoCarouselEhed .carousel-item img{
    position:absolute; inset:0; width:100%; height:100%;
    object-fit:cover; display:block; z-index:1;
}

/* Product tiles — aspect-ratio drives the row height */
.ehed-promo__tile{
    position:relative; display:block; width:100%; min-width:0;
    aspect-ratio:1/1; overflow:hidden;
}
.ehed-promo__tile img{
    position:absolute; inset:0; width:100%; height:100%;
    object-fit:cover; display:block;
}

/* Mobile: stack carousel on top, tiles side by side below */
@media(max-width:767.98px){
    .ehed-promo__row{ grid-template-columns:repeat(2, minmax(0,1fr)); }
    .ehed-promo__carousel-col{ grid-column:1 / -1; }
    .ehed-promo__carousel-wrap{ height:auto; aspect-ratio:1/1; }
}

/* ========== SHOP NOW SPACER ========== */
.ehed-shop-spacing{
    display:flex; align-items:center; justify-content:center;
    padding:2.5rem 0;
}
@media(max-width:767.98px){ .ehed-shop-spacing{ padding:1.5rem 0; } }

.ehed-banners{display:flex;flex-direction:column;width:100%;margin:0;padding:0}
.ehed-banners img{display:block;width:100%;height:auto}
.ehed-banner{position:relative}
.ehed-banner__panel{position:absolute;left:clamp(24px,4vw,72px);top:50%;right:auto;bottom:auto;transform:translateY(-50%);z-index:2;display:flex;flex-direction:column;align-items:flex-start;width:clamp(260px,30vw,420px);max-width:calc(50% - 32px);box-sizing:border-box;color:#111;font-family:'Poppins',sans-serif;text-align:start}
.ehed-banner__title{margin:0;color:inherit;font-family:'Poppins',sans-serif;font-size:clamp(20px,1.6vw,26px);font-weight:500;letter-spacing:.18em;line-height:1.2}
.ehed-banner__copy{width:100%;max-width:40em;margin:10px 0 18px;color:inherit;font-family:'Poppins',sans-serif;font-size:clamp(12px,.78vw,14px);font-weight:400;letter-spacing:.02em;line-height:1.7}
.ehed-banner__button{display:inline-block;padding:clamp(10px,.72vw,13px) clamp(16px,1.4vw,26px);background:#111;color:#fff;font-family:'Poppins',sans-serif;font-size:clamp(10px,.58vw,11px);letter-spacing:.16em;line-height:1.4;text-decoration:none;text-transform:uppercase}
.ehed-banner__button:hover,.ehed-banner__button:focus{background:#2b2b2b;color:#fff}
.ehed-banner__mobile-panel{display:flex;flex-direction:column;align-items:center;justify-content:center;width:100%;box-sizing:border-box;padding:32px 24px 36px;background:#fff;color:#111;font-family:'Poppins',sans-serif;text-align:center}
.ehed-banner__mobile-panel .ehed-banner__title{width:100%;font-size:22px;text-align:center}
.ehed-banner__mobile-panel .ehed-banner__copy{max-width:34em;margin:12px auto 20px;font-size:13px;text-align:center}
.ehed-products{width:100%;margin-top:8px;overflow:hidden}
.ehed-products__slider{width:100%;overflow:hidden}
.ehed-products__slider .swiper-slide{height:auto;min-width:0}
.ehed-products__prev,.ehed-products__next{width:44px;height:44px;margin-top:0;top:calc(50% - 22px);transform:translateY(-50%);z-index:5;border:0;border-radius:50%;background:#fff;color:#000;box-shadow:0 6px 18px rgba(0,0,0,.12)}
.ehed-products__prev{left:10px}
.ehed-products__next{right:10px}
.ehed-products__prev::after,.ehed-products__next::after{color:#000;font-size:16px;font-weight:700}
.ehed-products__prev.swiper-button-disabled,.ehed-products__next.swiper-button-disabled{opacity:.35;pointer-events:none}
@media(max-width:575.98px){.ehed-products__prev,.ehed-products__next{display:none}}
</style>

{{-- ========== HERO SECTION ========== --}}
<section class="ehed-hero-section">
    <div class="ehed-video-container d-none d-md-block">
        @if($desktopIsVideo)
            <video autoplay loop muted playsinline>
                <source src="{{ $desktopBannerUrl }}" @if($desktopType) type="{{ $desktopType }}" @endif>
                Your browser does not support the video tag.
            </video>
        @else
            <img src="{{ $desktopBannerUrl }}" alt="Ehed Banner" class="ehed-media-cover">
        @endif
    </div>
    <div class="ehed-video-container d-block d-md-none">
        @if($mobileIsVideo)
            <video autoplay loop muted playsinline>
                <source src="{{ $mobileBannerUrl }}" @if($mobileType) type="{{ $mobileType }}" @endif>
                Your browser does not support the video tag.
            </video>
        @else
            <img src="{{ $mobileBannerUrl }}" alt="Ehed Banner Mobile" class="ehed-media-cover">
        @endif
    </div>
</section>

<div class="ehed-banners">
    @foreach([1, 2, 3] as $banner)
        <div class="ehed-banner">
            <img src="{{ asset('assets/f_assets/image/ehed/' . $banner . '.png') }}"
                 alt="Ehed Banner {{ $banner }}"
                 width="1920"
                 height="1080"
                 @if($banner > 1) loading="lazy" @endif
                 decoding="async">
            @if($banner === 1)
                <div class="ehed-banner__panel d-none d-lg-flex">
                    <h1 class="ehed-banner__title">{{ __('site.col_ehed') }}</h1>
                    <p class="ehed-banner__copy">{{ __('site.ehed_copy') }}</p>
                    <a class="ehed-banner__button" href="{{ $appointmentWhatsappUrl }}" target="_blank" rel="noopener noreferrer">{{ __('site.book_appointment') }}</a>
                </div>
                <div class="ehed-banner__mobile-panel d-lg-none">
                    <h1 class="ehed-banner__title">{{ __('site.col_ehed') }}</h1>
                    <p class="ehed-banner__copy">{{ __('site.ehed_copy') }}</p>
                    <a class="ehed-banner__button" href="{{ $appointmentWhatsappUrl }}" target="_blank" rel="noopener noreferrer">{{ __('site.book_appointment') }}</a>
                </div>
            @endif
        </div>
    @endforeach
</div>

@if(isset($products) && $products->isNotEmpty())
<section class="ehed-products" aria-label="{{ __('site.col_ehed') }}">
    <div class="swiper ehed-products__slider">
        <div class="swiper-wrapper">
            @foreach($products as $product)
                <div class="swiper-slide">
                    @include('public.partials.simple-card', [
                        'product' => $product,
                        'storeContext' => true,
                        'hideDetails' => true,
                    ])
                </div>
            @endforeach
        </div>
        <button class="swiper-button-prev ehed-products__prev" type="button" aria-label="Previous"></button>
        <button class="swiper-button-next ehed-products__next" type="button" aria-label="Next"></button>
    </div>
</section>
@endif

<div class="ehed-shop-spacing">
    <x-book-appointment class="btn border btn-outline-dark px-5 py-2" />
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const slider = document.querySelector('.ehed-products__slider');
    if (!slider || typeof Swiper === 'undefined') return;

    new Swiper(slider, {
        rtl: document.documentElement.getAttribute('dir') === 'rtl',
        loop: false,
        grabCursor: true,
        watchOverflow: true,
        observer: true,
        observeParents: true,
        navigation: {
            nextEl: slider.querySelector('.ehed-products__next'),
            prevEl: slider.querySelector('.ehed-products__prev')
        },
        breakpoints: {
            0: { slidesPerView: 1, spaceBetween: 8 },
            576: { slidesPerView: 2, spaceBetween: 8 },
            768: { slidesPerView: 3, spaceBetween: 8 },
            1200: { slidesPerView: 4, spaceBetween: 8 }
        }
    });
});
</script>
@endsection
