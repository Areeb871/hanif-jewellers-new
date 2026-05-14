@extends('public.layouts.header_latest')

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
    @import url('https://fonts.googleapis.com/css2?family=Cinzel:wght@400;600;700&display=swap');
    .ehed-hero-section {
        display: flex;
        align-items: center;
    }
    .ehed-video-container {
        width: 50%;
        position: relative;
        overflow: hidden;
        min-height: 0;
        padding-top: 59.92%;
    }
    @supports (aspect-ratio: 1) {
        .ehed-video-container {
            padding-top: 0;
            aspect-ratio: 746 / 430;
        }
    }
    .ehed-video-container video {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }
    .ehed-media-cover {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }
    .ehed-content-container {
        width: 50%;
        padding: 80px 60px;
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
        margin-bottom: 20px;
    }
    .ehed-main-title {
        font-size: 3rem;
        color: #000;
        font-family: Walbaum;
        margin-bottom: 9px;
        line-height: 0.3;
        font-weight: 400;
    }
    .ehed-body-text {
        font-size: 16px;
        font-weight: 400;
        color: #000;
        line-height: 1.6;
    }
    .font-family--serif,
    .ehed-body-text {
        font-family: Fancy Cut, Almarai, Times, serif;
    }
    .hero__description {
        margin-top: 1em;
        font-size: 100%;
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
    @media (max-width: 768px) {
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
            padding: 40px 30px;
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
    <div class="ehed-content-container">
        <div class="ehed-category-label">WOMEN</div>
        <h1 class="ehed-main-title">MONA LISA</h1>
        <p class="ehed-body-text hero__description font-family--serif">
            An ode to the fusion of classic and modern creative jewellery which is an ensemble of exotic expressions for every occasion and event!
</p>
    </div>
</section>
<div class="container-fluid px-3">
        <div class="row onlineStore g-2 pt-3" id="chronoswissGrid">
            @if(isset($products) && $products->count())
                @foreach($products as $prod)
                    <div class="col-6 col-sm-4 col-md-3 col-lg-3">
                        @include('public.partials.product-card', ['product' => $prod])
                    </div>
                @endforeach
            @else
                <div class="col-12"><div class="text-center py-5 text-muted">Collections Revealed Soon!.</div></div>
            @endif
        </div>
        </div>
@endsection