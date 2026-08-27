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
        --selene-gap: 8px;
    }
    .ehed-hero-section {
        display: flex;
        align-items: stretch;
    }
    .ehed-video-container {
        width: 50%;
        position: relative;
        overflow: hidden;
        flex-shrink: 0;
        aspect-ratio: 746 / 430;
        background: #fff;
    }
    .ehed-video-container video,
    .ehed-media-cover {
        position: absolute;
        inset: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
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
            aspect-ratio: 746 / 430;
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
    .selene-gallery {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: var(--selene-gap);
        margin: var(--selene-gap) 0;
        padding: 0;
        box-sizing: border-box;
    }
    .selene-gallery__item {
        display: block;
        min-width: 0;
        margin: 0;
        padding: 0;
        line-height: 0;
        overflow: hidden;
    }
    .selene-gallery__item--center-start {
        grid-column: 2;
    }
    .selene-gallery .gallery-image {
        display: block;
        width: 100%;
        aspect-ratio: 1 / 1;
        object-fit: cover;
    }
    @media (max-width: 767.98px) {
        .selene-gallery {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
        .selene-gallery__item--center-start {
            grid-column: auto;
        }
    }
    .selene-appointment-spacing {
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 2.5rem 0;
    }
    @media (max-width: 767.98px) {
        .selene-appointment-spacing {
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
    <div class="ehed-content-container">
        <div class="ehed-category-label">WOMEN</div>
        <h1 class="ehed-main-title">SELENE</h1>
        <p class="ehed-body-text hero__description font-family--serif">
A Pure Gold Series in 24k Gold as it was meant to be — raw, regal, alive. Celebrating heritage through radiant texture and timeless design, SELENE is wearable wealth for those who treasure elegance.        </p>
    </div>
</section>

@php
    $seleneImages = [
        'assets/f_assets/image/selene/selene_1.png',
        'assets/f_assets/image/selene/selene_2.png',
        'assets/f_assets/image/selene/selene_3.png',
        'assets/f_assets/image/selene/selene_4.png',
        'assets/f_assets/image/selene/selene_5.png',
        'assets/f_assets/image/selene/selene.jpg',
    ];
@endphp
<div class="selene-gallery">
    @foreach($seleneImages as $index => $imagePath)
        @if(isset($products[$index]))
            <a href="{{ route('product.details', $products[$index]->slug) }}" class="selene-gallery__item{{ $index === 4 ? ' selene-gallery__item--center-start' : '' }}">
                <img src="{{ asset($imagePath) }}" class="gallery-image">
            </a>
        @endif
    @endforeach
</div>
<!-- <div class="d-none d-md-block" style="position: relative; height: 768px; width: 100vw; margin-left: calc(50% - 50vw); margin-right: calc(50% - 50vw); overflow: hidden;">
    <video autoplay loop muted playsinline preload="auto" 
           style="position: absolute; inset: 0; width: 100%; height: 100%; object-fit: cover; object-position: center; z-index: 0;">
        <source src="{{ asset('assets/f_assets/image/pure-lock/purelock.mp4') }}" type="video/mp4">
        Your browser does not support the video tag.
    </video>
</div> -->

<!-- Mobile Video Banner -->
<!-- <div class="d-md-none" style="position: relative; height: 768px; width: 100vw; margin-left: calc(50% - 50vw); margin-right: calc(50% - 50vw); overflow: hidden;"> 
    <video autoplay loop muted playsinline preload="auto" 
           style="position: absolute; inset: 0; width: 100%; height: 100%; object-fit: cover; object-position: center; z-index: 0;">
        <source src="{{ asset('assets/f_assets/image/pure-lock/purelock.mp4') }}" type="video/mp4">
        Your browser does not support the video tag.
    </video>
</div>  -->


<div class="selene-appointment-spacing">
    <x-book-appointment class="btn border btn-outline-dark px-5 py-2" />
</div>
@endsection
