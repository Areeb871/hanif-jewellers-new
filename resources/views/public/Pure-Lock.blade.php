@extends('public.layouts.header_black_white_fixed')

@section('content')
@php
    $fallbackDesktop = 'assets/f_assets/image/pure-lock/banner-desktop.jpg';
    $fallbackMobile = 'assets/f_assets/image/pure-lock/banner-mobile.jpg';
    $mobileVideoFallback = 'assets/f_assets/image/pure-lock/mobile-view.mp4';
    $videoExtensions = ['mp4', 'webm', 'ogg'];

    $desktopBannerSource = optional($subcategory)->banner_url ?: $fallbackDesktop;
    $mobileBannerSource = optional($subcategory)->banner_mobile_url ?: optional($subcategory)->banner_url;

    if (!$mobileBannerSource && file_exists(public_path($mobileVideoFallback))) {
        $mobileBannerSource = $mobileVideoFallback;
    }

    if (!$mobileBannerSource) {
        $mobileBannerSource = $fallbackMobile;
    }

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
    :root {
        --pure-lock-gap: 8px;
    }
    .ehed-hero-section {
        display: flex;
        flex-direction: column;
        align-items: stretch;
    }
    .ehed-video-container {
        width: 100%;
        position: relative;
        overflow: hidden;
        flex-shrink: 0;
        height: auto;
        background: #000;
    }
    .ehed-video-container video,
    .ehed-media-cover {
        position: static;
        width: 100%;
        height: auto;
        object-fit: contain;
        object-position: center center;
        display: block;
    }
    .ehed-content-container {
        width: 50%;
        min-width: 0;
        box-sizing: border-box;
        padding: 8px 24px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        background: #fff;
    }
    .ehed-category-label {
        font-size: 14px;
        font-weight: 400;
        color: #999;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Arial, sans-serif;
        margin: 0 0 16px;
    }
    .ehed-main-title {
        font-size: 3rem;
        color: #000;
        font-family: Walbaum;
        margin: 0 0 10px;
        line-height: 1.1;
        font-weight: 400;
    }
    .ehed-body-text {
        font-size: 16px;
        font-weight: 400;
        color: #000;
        line-height: 1.6;
        max-width: 100%;
    }
    .font-family--serif,
    .ehed-body-text {
        font-family: Fancy Cut, Almarai, Times, serif;
    }
    .hero__description {
        margin-top: 0;
        font-size: 100%;
        max-width: 100%;
    }
    .text-large {
        font-family: Walbaum, sans-serif;
        color: #010307;
        font-style: normal;
        font-weight: 400;
        line-height: 120%;
        font-size: 2rem;
        letter-spacing: 1.6px;
    }
    .uppercase {
        text-transform: uppercase;
    }
    h1, h2, h3, h4, h5, h6 {
        margin-top: 0;
        margin-bottom: 0;
    }
    @media (min-width: 48rem) {
        .hero__description {
            max-width: 40rem;
            font-size: 110%;
        }
        .text-align--center .hero__description {
            margin-left: auto;
            margin-right: auto;
        }
    }
    @media (min-width: 699px) {
        .text-large {
            font-size: 2.5rem;
            letter-spacing: 2px;
        }
    }
    @media (min-width: 1024px) {
        .text-large {
            font-size: 3rem;
            letter-spacing: 2.4px;
        }
    }
    @media (max-width: 991.98px) {
        .ehed-hero-section {
            padding-top: 56px;
        }
    }
    @media (min-width: 768px) {
        .ehed-content-container {
            padding: 8px 40px;
        }
    }
    @media (min-width: 768px) and (max-width: 1199.98px) {
        .ehed-video-container {
            min-height: 0;
            height: auto;
        }
        .ehed-content-container {
            padding: 8px 28px;
            overflow: visible;
        }
        .ehed-category-label {
            font-size: 12px;
            margin: 0 0 8px;
        }
        .ehed-main-title {
            font-size: clamp(28px, 3.6vw, 42px);
            line-height: 1.1;
            margin: 0 0 8px;
        }
        .ehed-body-text {
            font-size: 14px;
            line-height: 1.55;
        }
        .hero__description {
            max-width: 100%;
            font-size: 100%;
        }
    }
    @media (min-width: 1200px) {
        .ehed-content-container {
            padding: 8px 60px;
        }
    }
    @media (max-width: 767.98px) {
        .ehed-hero-section {
            flex-direction: column;
            min-height: auto;
        }
        .ehed-video-container {
            width: 100%;
            height: auto;
        }
        .ehed-content-container {
            width: 100%;
            padding: 24px 20px;
        }
        .ehed-main-title {
            font-size: 48px;
        }
        .ehed-category-label {
            font-size: 12px;
        }
        .ehed-body-text {
            font-size: 14px;
        }
    }
    @media (max-width: 576px) {
        .ehed-main-title {
            font-size: 36px;
        }
        .ehed-content-container {
            padding: 30px 20px;
        }
    }
    #promoCarousel {
        position: relative;
        width: 100%;
        height: 100%;
        overflow: hidden;
    }
    @media (min-width: 768px) {
        #promoCarousel {
            height: 63vh;
        }
        .promo-tile {
            height: 63vh;
        }
    }
    #promoCarousel .carousel-inner {
        width: 100%;
        height: 100%;
    }
    #promoCarousel .carousel-item {
        height: 100%;
        transition: transform 0.6s ease-in-out;
    }
    #promoCarousel .carousel-item img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    #promoCarousel .carousel-control-prev,
    #promoCarousel .carousel-control-next {
        opacity: 1;
        width: 50px;
        height: 50px;
        top: 50%;
        transform: translateY(-50%);
        background-color: rgba(0, 0, 0, 0.3);
        border-radius: 50%;
        z-index: 10;
    }
    #promoCarousel .carousel-control-prev {
        left: 15px;
    }
    #promoCarousel .carousel-control-next {
        right: 15px;
    }
    #promoCarousel .carousel-control-prev-icon,
    #promoCarousel .carousel-control-next-icon {
        filter: invert(1) brightness(200%);
        width: 1.5rem;
        height: 1.5rem;
    }
    #promoCarousel .carousel-control-prev:hover,
    #promoCarousel .carousel-control-next:hover {
        background-color: rgba(0, 0, 0, 0.5);
    }
    .discover-button-overlay {
        z-index: 5;
        pointer-events: none;
    }
    .discover-btn {
        background-color: rgba(128, 128, 128, 0.6);
        border: none;
        color: white;
        font-weight: 600;
        font-size: 1rem;
        letter-spacing: 2px;
        text-transform: uppercase;
        border-radius: 4px;
        pointer-events: auto;
        backdrop-filter: blur(5px);
        transition: all 0.3s ease;
    }
    .discover-btn:hover {
        background-color: rgba(128, 128, 128, 0.8);
        color: white;
        transform: scale(1.05);
    }
    .pure-lock-banner-wrapper {
        margin-top: 2rem;
        margin-bottom: 2rem;
    }
    .pure-lock-banner {
        width: 100%;
        height: auto;
        display: block;
        object-fit: cover;
    }
    .pure-lock-gallery {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: var(--pure-lock-gap);
        padding: 0;
        margin: var(--pure-lock-gap) 0;
        box-sizing: border-box;
        --bs-gutter-x: 0;
        --bs-gutter-y: 0;
    }
    .pure-lock-gallery > * {
        width: auto;
        max-width: none;
        padding: 0;
        margin: 0;
        line-height: 0;
    }
    .pure-lock-gallery .gallery-image,
    .pure-lock-gallery .gallery-placeholder {
        width: 100%;
        aspect-ratio: 1 / 1;
        object-fit: cover;
        display: block;
    }
    @media (max-width: 767.98px) {
        .pure-lock-gallery {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
    }
    .pure-lock-products {
        position: relative;
        width: 100%;
        overflow: hidden;
    }
    .pure-lock-products__title {
        margin: 0;
        padding: 48px 20px 0;
        color: #111;
        font-family: 'Poppins', sans-serif;
        font-size: clamp(22px, 2vw, 32px);
        font-weight: 500;
        letter-spacing: .18em;
        line-height: 1.3;
        text-align: center;
    }
    .pure-lock-product-swiper {
        width: 100%;
        padding: 40px 8px;
        overflow: hidden;
        touch-action: pan-y;
    }
    .pure-lock-product-swiper .swiper-slide {
        height: auto;
        min-width: 0;
    }
    .pure-lock-product-swiper .hjPagination {
        display: none !important;
    }
    .pure-lock-product-swiper .swiper-button-next,
    .pure-lock-product-swiper .swiper-button-prev {
        width: 44px;
        height: 44px;
        border-radius: 50%;
        background: #fff;
        box-shadow: 0 6px 18px rgba(0, 0, 0, .12);
        color: #000;
    }
    .pure-lock-product-swiper .swiper-button-next::after,
    .pure-lock-product-swiper .swiper-button-prev::after {
        font-size: 16px;
        font-weight: 700;
    }
    .pure-lock-product-swiper > .swiper-pagination {
        display: none;
    }
    @media (max-width: 575px) {
        .pure-lock-products__title {
            padding-top: 36px;
            font-size: 20px;
        }
        .pure-lock-product-swiper {
            padding-bottom: 42px;
        }
        .pure-lock-product-swiper .swiper-button-next,
        .pure-lock-product-swiper .swiper-button-prev {
            display: none;
        }
        .pure-lock-product-swiper > .swiper-pagination {
            display: flex;
            bottom: 10px;
            justify-content: center;
        }
    }
    .pure-lock-banners { display: flex; flex-direction: column; width: 100%; margin: 0; padding: 0; }
    .pure-lock-banners img { display: block; width: 100%; height: auto; }
    .pure-lock-banner { position: relative; }
    .pure-lock-banner__panel { position: absolute; left: auto; right: clamp(24px, 4vw, 72px); top: 50%; transform: translateY(-50%); z-index: 2; display: flex; flex-direction: column; align-items: flex-start; width: clamp(260px, 30vw, 420px); max-width: calc(50% - 32px); box-sizing: border-box; color: #111; font-family: 'Poppins', sans-serif; text-align: start; }
    .pure-lock-banner__title { margin: 0; color: inherit; font-family: 'Poppins', sans-serif; font-size: clamp(20px, 1.6vw, 26px); font-weight: 500; letter-spacing: .18em; line-height: 1.2; }
    .pure-lock-banner__copy { width: 100%; max-width: 40em; margin: 10px 0 18px; color: inherit; font-family: 'Poppins', sans-serif; font-size: clamp(12px, .78vw, 14px); font-weight: 400; letter-spacing: .02em; line-height: 1.7; }
    .pure-lock-banner__button { display: inline-block; padding: clamp(10px, .72vw, 13px) clamp(16px, 1.4vw, 26px); background: #111; color: #fff; font-family: 'Poppins', sans-serif; font-size: clamp(10px, .58vw, 11px); letter-spacing: .16em; line-height: 1.4; text-decoration: none; text-transform: uppercase; }
    .pure-lock-banner__button:hover, .pure-lock-banner__button:focus { background: #2b2b2b; color: #fff; }
    .pure-lock-banner__mobile-panel { display: flex; flex-direction: column; align-items: center; width: 100%; box-sizing: border-box; padding: 32px 24px 36px; background: #fff; color: #111; font-family: 'Poppins', sans-serif; text-align: center; }
    .pure-lock-banner__mobile-panel .pure-lock-banner__title { width: 100%; font-size: 22px; text-align: center; }
    .pure-lock-banner__mobile-panel .pure-lock-banner__copy { max-width: 34em; margin: 12px auto 20px; font-size: 13px; text-align: center; }
    .pure-lock-shop-spacing {
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 2.5rem 0;
    }
    @media (max-width: 767.98px) {
        .pure-lock-shop-spacing {
            padding: 1.5rem 0;
        }
    }
</style>

<section class="ehed-hero-section">
    <div class="ehed-video-container d-none d-md-block">
        @if($desktopIsVideo)
            <video autoplay loop muted playsinline>
                <source src="{{ $desktopBannerUrl }}" @if($desktopType) type="{{ $desktopType }}" @endif>
                Your browser does not support the video tag.
            </video>
        @else
            <img src="{{ $desktopBannerUrl }}" alt="Pure Lock Banner" class="ehed-media-cover">
        @endif
    </div>
    <div class="ehed-video-container d-block d-md-none">
        @if($mobileIsVideo)
            <video autoplay loop muted playsinline>
                <source src="{{ $mobileBannerUrl }}" @if($mobileType) type="{{ $mobileType }}" @endif>
                Your browser does not support the video tag.
            </video>
        @else
            <img src="{{ $mobileBannerUrl }}" alt="Pure Lock Banner Mobile" class="ehed-media-cover">
        @endif
    </div>
</section>

<div class="pure-lock-banners">
    @foreach([1, 2, 3] as $banner)
        <div class="pure-lock-banner">
            <img src="{{ asset('assets/f_assets/image/pure-lock/' . $banner . '.png') }}"
                 alt="Pure Lock Banner {{ $banner }}"
                 width="1920"
                 height="1080"
                 @if($banner > 1) loading="lazy" @endif
                 decoding="async">
            @if($banner === 1)
                <div class="pure-lock-banner__panel d-none d-lg-flex">
                    <h1 class="pure-lock-banner__title">{{ __('site.col_pure_lock') }}</h1>
                    <p class="pure-lock-banner__copy">{{ __('site.pure_lock_copy') }}</p>
                    <x-shop-now href="https://www.hanifjewellers.com/products/pure-lock-p233590?store=1" class="pure-lock-banner__button" />
                </div>
                <div class="pure-lock-banner__mobile-panel d-lg-none">
                    <h1 class="pure-lock-banner__title">{{ __('site.col_pure_lock') }}</h1>
                    <p class="pure-lock-banner__copy">{{ __('site.pure_lock_copy') }}</p>
                    <x-shop-now href="https://www.hanifjewellers.com/products/pure-lock-p233590?store=1" class="pure-lock-banner__button" />
                </div>
            @endif
        </div>
    @endforeach
</div>

<div class="pure-lock-shop-spacing">
    <x-shop-now
        href="https://www.hanifjewellers.com/products/pure-lock-p233590?store=1"
        class="btn border btn-outline-dark px-5 py-2"
    />
</div>
@endsection
