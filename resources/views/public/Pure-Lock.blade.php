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
    <div class="ehed-content-container">
        <div class="ehed-category-label">MEN & WOMEN</div>
        <h1 class="ehed-main-title">PURE LOCK</h1>
        <p class="ehed-body-text hero__description font-family--serif">
            Pure Lock by Hanif celebrates the strength of unbreakable bonds. Discover refined silhouettes and bold statement pieces, meticulously crafted to bring contemporary elegance to every occasion.
        </p>
    </div>
</section>

@if(isset($galleryImages) && $galleryImages->count() > 0)
<div class="pure-lock-gallery" id="pureLockTopGallery">
    @foreach($galleryImages as $index => $image)
        <div class="col-md-3 {{ $index > 0 ? 'justify-content-center d-flex align-items-center' : '' }}">
            <img src="{{ asset($image->image) }}" class="img-fluid gallery-image" alt="Pure Lock Gallery Image" data-gallery="pureLockTopGallery" data-index="{{ $index }}" style="cursor: pointer;" onclick="openImageModal('pureLockTopGallery', {{ $index }})">
        </div>
    @endforeach
    @if($galleryImages->count() < 4)
        @for($i = $galleryImages->count(); $i < 4; $i++)
            <div class="col-md-3 justify-content-center d-flex align-items-center">
                <div class="gallery-placeholder d-flex align-items-center justify-content-center" style="background-color: #f5f5f5;">
                    <span class="text-muted">No image</span>
                </div>
            </div>
        @endfor
    @endif
</div>
@endif
<div class="d-none d-md-block" style="position: relative; aspect-ratio: 16 / 9; width: 100vw; margin-left: calc(50% - 50vw); margin-right: calc(50% - 50vw); overflow: hidden;">
    <video autoplay loop muted playsinline preload="auto" 
           style="position: absolute; inset: 0; width: 100%; height: 100%; object-fit: contain; object-position: center; z-index: 0;">
        <source src="{{ asset('assets/f_assets/image/pure-lock/purelock.mp4') }}" type="video/mp4">
        Your browser does not support the video tag.
    </video>
</div>

<!-- Mobile Video Banner -->
<!-- <div class="d-md-none" style="position: relative; height: 768px; width: 100vw; margin-left: calc(50% - 50vw); margin-right: calc(50% - 50vw); overflow: hidden;"> 
    <video autoplay loop muted playsinline preload="auto" 
           style="position: absolute; inset: 0; width: 100%; height: 100%; object-fit: cover; object-position: center; z-index: 0;">
        <source src="{{ asset('assets/f_assets/image/pure-lock/purelock.mp4') }}" type="video/mp4">
        Your browser does not support the video tag.
    </video>
</div>  -->

@if(isset($products) && $products->isNotEmpty())
<section class="pure-lock-products">
    <h2 class="pure-lock-products__title">PURE LOCK JEWELLERY</h2>
    <div class="swiper pure-lock-product-swiper">
        <div class="swiper-wrapper">
            @foreach($products as $product)
                <div class="swiper-slide">
                    @include('public.partials.simple-card', ['product' => $product])
                </div>
            @endforeach
        </div>
        <div class="swiper-button-prev"></div>
        <div class="swiper-button-next"></div>
        <div class="swiper-pagination"></div>
    </div>
</section>

<script>
document.querySelectorAll('.pure-lock-product-swiper').forEach((swiperEl) => {
    new Swiper(swiperEl, {
        loop: false,
        grabCursor: true,
        watchOverflow: true,
        observer: true,
        observeParents: true,
        breakpoints: {
            0: { slidesPerView: 1, spaceBetween: 8 },
            576: { slidesPerView: 2, spaceBetween: 8 },
            768: { slidesPerView: 3, spaceBetween: 8 },
            1200: { slidesPerView: 4, spaceBetween: 8 }
        },
        navigation: {
            nextEl: swiperEl.querySelector('.swiper-button-next'),
            prevEl: swiperEl.querySelector('.swiper-button-prev')
        },
        pagination: {
            el: swiperEl.querySelector('.swiper-pagination'),
            clickable: true
        }
    });
});
</script>
@endif
<div class="pure-lock-shop-spacing">
    <x-shop-now
        href="https://www.hanifjewellers.com/products/pure-lock-p233590?store=1"
        class="btn border btn-outline-dark px-5 py-2"
    />
</div>
@include('public.partials.image-gallery-modal')
@endsection
