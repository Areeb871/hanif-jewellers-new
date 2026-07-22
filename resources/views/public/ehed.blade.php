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
        padding-top: 59.92%; /* Aspect ratio: 746/447 = 1.669 - fallback for older browsers */
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
    /* Promotional Carousel Styles */
    #promoCarousel {
        position: relative;
        width: 100%;
        height: 100%;
        overflow: hidden;
    }
    @media (min-width: 768px) {
        #promoCarousel {
            height: 100%;
            min-height: 400px;
        }
        .promo-tile {
            height: 63vh;
            min-height: 400px;
            display: flex;
        }
        .discover-button-overlay {
            padding-bottom: 2.5rem;
        }
    }
    @media (min-width: 992px) {
        .promo-tile {
            height: 65vh;
            min-height: 450px;
        }
        .discover-button-overlay {
            padding-bottom: 3rem;
        }
        .discover-btn {
            padding: 0.875rem 3.5rem;
        }
    }
    @media (min-width: 1200px) {
        .promo-tile {
            height: 70vh;
            min-height: 500px;
        }
    }
    @media (min-width: 1400px) {
        .promo-tile {
            height: 75vh;
            min-height: 550px;
        }
    }
    #promoCarousel .carousel-inner {
        width: 100%;
        height: 100%;
    }
    #promoCarousel .carousel-item {
        height: 100%;
        transition: transform 0.6s ease-in-out;
        position: relative;
    }
    #promoCarousel .carousel-item img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        position: absolute;
        top: 0;
        left: 0;
        z-index: 1;
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
        z-index: 15;
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
    /* Discover Button Overlay Styles */
    .discover-button-overlay {
        z-index: 20;
        pointer-events: none;
        padding-bottom: 2rem;
        left: 0;
        right: 0;
        bottom: 0;
    }
    .discover-btn {
    background-color: transparent;
    border: 1px solid rgba(255, 255, 255, 0.7);
    color: #ffffff;
    font-weight: 600;
    font-size: 1rem;
    letter-spacing: 2px;
    text-transform: uppercase;
    border-radius: 4px;
    pointer-events: auto;
    backdrop-filter: none;
    transition: all 0.3s ease;
    padding: 0.75rem 3rem;
    white-space: nowrap;
    display: inline-block;
    text-decoration: none;
}
    .discover-btn:hover {
        background-color: rgba(128, 128, 128, 0.8);
        color: white;
        transform: scale(1.05);
        text-decoration: none;
    }
    .discover-btn:active {
        transform: scale(0.98);
    }
    /* Product Images Styles */
    .product-images-container {
        height: 100%;
    }
    @media (min-width: 768px) {
        .product-images-container {
            height: 100%;
        }
        .col-12.col-md-6.d-flex {
            height: 63vh;
            min-height: 400px;
        }
        .col-12.col-md-6:last-child {
            height: 63vh;
            min-height: 400px;
        }
    }
    @media (min-width: 992px) {
        .col-12.col-md-6.d-flex {
            height: 65vh;
            min-height: 450px;
        }
        .col-12.col-md-6:last-child {
            height: 65vh;
            min-height: 450px;
        }
    }
    @media (min-width: 1200px) {
        .col-12.col-md-6.d-flex {
            height: 70vh;
            min-height: 500px;
        }
        .col-12.col-md-6:last-child {
            height: 70vh;
            min-height: 500px;
        }
    }
    @media (min-width: 1400px) {
        .col-12.col-md-6.d-flex {
            height: 75vh;
            min-height: 550px;
        }
        .col-12.col-md-6:last-child {
            height: 75vh;
            min-height: 550px;
        }
    }
    .product-image-wrapper {
        height: 100%;
    }
    .product-image {
        height: 100%;
        object-fit: cover;
    }
    /* Tablet and Mobile Responsive Styles */
    @media (max-width: 991px) and (min-width: 769px) {
        #promoCarousel {
            height: 100%;
            min-height: 350px;
        }
        .promo-tile {
            height: 50vh;
            min-height: 350px;
        }
        .col-12.col-md-6.d-flex {
            height: 50vh;
            min-height: 350px;
        }
        .col-12.col-md-6:last-child {
            height: 50vh;
            min-height: 350px;
        }
        .discover-button-overlay {
            padding-bottom: 2rem;
        }
    }
    /* Mobile Responsive Styles */
    @media (max-width: 768px) {
        .onlineStore {
            padding-top: 0 !important;
            padding-bottom: 0 !important;
        }
        .onlineStore .row {
            margin-left: 0;
            margin-right: 0;
        }
        .onlineStore .g-2 {
            --bs-gutter-x: 0.25rem;
            --bs-gutter-y: 0.25rem;
        }
        #promoCarousel {
            height: auto;
            min-height: 300px;
            position: relative;
            margin-top: 0;
            margin-bottom: 0;
            overflow: hidden;
        }
        @supports (aspect-ratio: 1) {
            #promoCarousel {
                aspect-ratio: 4 / 5;
            }
        }
        @supports not (aspect-ratio: 1) {
            #promoCarousel {
                padding-top: 125%;
            }
        }
        #promoCarousel .carousel-inner {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }
        #promoCarousel .carousel-item {
            position: relative;
            height: 100%;
            width: 100%;
        }
        #promoCarousel .carousel-item img {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center;
            z-index: 1;
        }
        #promoCarousel .carousel-control-prev,
        #promoCarousel .carousel-control-next {
            width: 40px;
            height: 40px;
            top: 50%;
            transform: translateY(-50%);
        }
        #promoCarousel .carousel-control-prev {
            left: 10px;
        }
        #promoCarousel .carousel-control-next {
            right: 10px;
        }
        #promoCarousel .carousel-control-prev-icon,
        #promoCarousel .carousel-control-next-icon {
            width: 1rem;
            height: 1rem;
        }
        .promo-tile {
            height: auto;
            margin-top: 0 !important;
            margin-bottom: 0 !important;
            padding: 0 !important;
        }
        .product-image-wrapper {
            height: 40vh;
            min-height: 250px;
        }
        .product-image {
            height: 100%;
            min-height: 250px;
        }
        .product-images-container {
            height: auto;
            margin-top: 0 !important;
        }
        .col-12.col-md-6:last-child {
            height: auto;
        }
        .col-12.col-md-6.d-flex {
            margin-top: 0;
        }
        .product-images-container .col-6 {
            padding-left: 0.25rem;
            padding-right: 0.25rem;
        }
        .discover-button-overlay {
            padding-bottom: 1.5rem !important;
            z-index: 20 !important;
            bottom: 0 !important;
            position: absolute !important;
        }
        .discover-btn {
            font-size: 0.875rem;
            padding: 0.625rem 1.5rem !important;
            letter-spacing: 1.5px;
            width: auto;
            max-width: 90%;
        }
    }
    @media (max-width: 576px) {
        #promoCarousel {
            min-height: 280px;
            margin-top: 0;
            margin-bottom: 0;
        }
        @supports (aspect-ratio: 1) {
            #promoCarousel {
                aspect-ratio: 3 / 4;
            }
        }
        @supports not (aspect-ratio: 1) {
            #promoCarousel {
                padding-top: 133.33%;
            }
        }
        .product-image-wrapper {
            height: 35vh;
            min-height: 200px;
        }
        .product-image {
            height: 100%;
            min-height: 200px;
        }
        #promoCarousel .carousel-control-prev,
        #promoCarousel .carousel-control-next {
            width: 35px;
            height: 35px;
        }
        #promoCarousel .carousel-control-prev {
            left: 8px;
        }
        #promoCarousel .carousel-control-next {
            right: 8px;
        }
        .discover-btn {
            font-size: 0.75rem;
            padding: 0.5rem 1.25rem !important;
            letter-spacing: 1px;
        }
        .discover-button-overlay {
            padding-bottom: 1rem !important;
            z-index: 20 !important;
            position: absolute !important;
            bottom: 0 !important;
        }
    }
    @media (max-width: 480px) {
        #promoCarousel {
            min-height: 250px;
            margin-top: 0;
            margin-bottom: 0;
        }
        @supports (aspect-ratio: 1) {
            #promoCarousel {
                aspect-ratio: 2 / 3;
            }
        }
        @supports not (aspect-ratio: 1) {
            #promoCarousel {
                padding-top: 150%;
            }
        }
        .discover-btn {
            font-size: 1.2rem;
            padding: 0.5rem 1rem !important;
            letter-spacing: 0.5px;
        }
        .discover-button-overlay {
            padding-bottom: 0.875rem !important;
            z-index: 20 !important;
            position: absolute !important;
            bottom: 0 !important;
        }
        .product-image-wrapper {
            height: 30vh;
            min-height: 180px;
        }
        .product-image {
            min-height: 180px;
        }
        .product-images-container .col-6 {
            padding-left: 0.25rem;
            padding-right: 0.25rem;
        }
    }
    @media (max-width: 375px) {
        #promoCarousel {
            min-height: 220px;
            margin-top: 0;
            margin-bottom: 0;
        }
        .discover-btn {
            font-size: 1.1rem;
            padding: 0.45rem 0.875rem !important;
            letter-spacing: 0.5px;
        }
        .discover-button-overlay {
            padding-bottom: 0.75rem !important;
            z-index: 20 !important;
            position: absolute !important;
            bottom: 0 !important;
        }
    }
    /* Hide button on iPhone 6/7/8 (375x667) */
    @media (max-width: 375px) and (max-height: 667px) {
        .discover-button-overlay {
            display: none !important;
        }
    }
    /* Hide button on iPhone 6/7/8 Plus (414x736) */
    @media (max-width: 414px) and (max-height: 736px) and (min-width: 376px) {
        .discover-button-overlay {
            display: none !important;
        }
    }
    /* Specific styling for 360x740 screens */
    @media (max-width: 360px) {
        .discover-button-overlay {
            bottom: auto !important;
            top: 80% !important;
            left: 50% !important;
            transform: translate(-50%, -50%) !important;
            padding-bottom: 0 !important;
        }
    }
        #promoCarousel .carousel-control-prev,
        #promoCarousel .carousel-control-next {
            width: 30px;
            height: 30px;
        }
        #promoCarousel .carousel-control-prev {
            left: 5px;
        }
        #promoCarousel .carousel-control-next {
            right: 5px;
        }
        #promoCarousel .carousel-control-prev-icon,
        #promoCarousel .carousel-control-next-icon {
            width: 0.875rem;
            height: 0.875rem;
        }
        .product-image-wrapper {
            min-height: 160px;
        }
        .product-image {
            min-height: 160px;
        }
    }
    @media (max-width: 320px) {
        #promoCarousel {
            min-height: 200px;
            margin-top: 0;
            margin-bottom: 0;
        }
        .discover-btn {
            font-size: 0.6rem;
            padding: 0.4rem 0.75rem !important;
        }
        .discover-button-overlay {
            padding-bottom: 0.5rem !important;
            z-index: 20 !important;
            position: absolute !important;
            bottom: 0 !important;
        }
        #promoCarousel .carousel-control-prev,
        #promoCarousel .carousel-control-next {
            width: 28px;
            height: 28px;
        }
        .product-image-wrapper {
            min-height: 150px;
        }
        .product-image {
            min-height: 150px;
        }
    }
    /* ===== PROMO SECTION: SAME HEIGHT BOTH SIDES ===== */
.promo-section{ height:auto; }
@media (min-width:768px){  .promo-section{ height:63vh; min-height:400px; } }
@media (min-width:992px){  .promo-section{ height:65vh; min-height:450px; } }
@media (min-width:1200px){ .promo-section{ height:70vh; min-height:500px; } }
@media (min-width:1400px){ .promo-section{ height:75vh; min-height:550px; } }

.promo-row{ height:100%; }
.promo-col{ height:100%; }

/* Carousel fill */
#promoCarouselEhed{ position:relative; width:100%; height:100%; overflow:hidden; }
#promoCarouselEhed .carousel-inner,
#promoCarouselEhed .carousel-item{ height:100%; }
#promoCarouselEhed .carousel-item img{
  position:absolute; inset:0;
  width:100%; height:100%;
  object-fit:cover;
  display:block;
  z-index:1;
}

/* Right side grid */
.right-grid{
  height:100%;
  width:100%;
  display:grid;
  grid-template-columns:1fr 1fr;
  gap:.5rem; /* same as g-2 */
}
.right-tile{
  height:100%;
  width:100%;
  overflow:hidden;
  display:block;
}
.right-tile img{
  width:100%;
  height:100%;
  object-fit:cover;
  display:block;
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
    <div class="ehed-content-container">
        <div class="ehed-category-label">MEN & WOMEN</div>
        <h1 class="ehed-main-title">EHED</h1>
        <p class="ehed-body-text hero__description font-family--serif">
            Ehed by Hanif is for all those unbreakable promises. Explore a whole world of possibilities elegantly handcrafted for all occasions.
        </p>
    </div>
</section>
@if(isset($galleryImages) && $galleryImages->count() > 0)
<div class="row g-2 mb-3" id="qawsAlMatarGallery" style="margin-top:1rem;">
    @foreach($galleryImages as $index => $image)
        <div class="col-md-3 {{ $index > 0 ? 'justify-content-center d-flex align-items-center' : '' }}">
            <img src="{{ asset($image->image) }}" class="img-fluid gallery-image" alt="Ehed Gallery Image" data-gallery="qawsAlMatarGallery" data-index="{{ $index }}" style="cursor: pointer;" onclick="openImageModal('qawsAlMatarGallery', {{ $index }})">
        </div>
    @endforeach
    @if($galleryImages->count() < 4)
        @for($i = $galleryImages->count(); $i < 4; $i++)
            <div class="col-md-3 justify-content-center d-flex align-items-center">
                <div style="width: 100%; height: 200px; background-color: #f5f5f5; display: flex; align-items: center; justify-content: center;">
                    <span class="text-muted">No image</span>
                </div>
            </div>
        @endfor
    @endif
</div>
@endif
      {{-- PROMO + RIGHT 2 IMAGES (SAME HEIGHT ALWAYS) --}}
<div class="row onlineStore g-2 promo-section">
    <div class="col-12 h-100">
        <div class="row g-2 align-items-stretch promo-row h-100">

            {{-- LEFT CAROUSEL --}}
            <div class="col-12 col-md-6 promo-col d-flex position-relative">
                <div id="promoCarouselEhed" class="carousel slide w-100 h-100" data-bs-ride="carousel">
                    <div class="carousel-inner h-100">

                        <div class="carousel-item active h-100 position-relative">
                            <img src="{{ asset('assets/f_assets/image/ehed/male_ehed.png') }}"
                                 alt="Promotional Banner 1"
                                 class="img-fluid w-100 h-100">
                            <div class="discover-button-overlay position-absolute bottom-0 start-50 translate-middle-x w-100 text-center">
                                <x-shop-now :href="route('collections.ehed')" class="btn discover-btn" label="Shop Now" />
                            </div>
                        </div>

                        <div class="carousel-item h-100 position-relative">
                            <img src="{{ asset('assets/f_assets/image/ehed/female_ehed.png') }}"
                                 alt="Promotional Banner 2"
                                 class="img-fluid w-100 h-100">
                            <div class="discover-button-overlay position-absolute bottom-0 start-50 translate-middle-x w-100 text-center">
                                <x-shop-now :href="route('collections.ehed')" class="btn discover-btn" label="Shop Now" />
                            </div>
                        </div>

                    </div>

                    <button class="carousel-control-prev" type="button" data-bs-target="#promoCarouselEhed" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#promoCarouselEhed" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>

                </div>
            </div>

            {{-- RIGHT 2 PRODUCTS (GRID = FULL HEIGHT, NO GAP) --}}
            <div class="col-12 col-md-6 promo-col d-flex">
                <div class="right-grid">
                    @if(isset($productImages) && $productImages->count() > 0)
                        @foreach($productImages as $index => $image)
                            @php $img = $image->image ?? null; @endphp

                            <a href="#" class="right-tile">
                                @if($img)
                                    <img src="{{ asset($img) }}" alt="Product {{ $index + 1 }}">
                                @else
                                    <div style="width:100%; height:100%; background:#f5f5f5; display:flex; align-items:center; justify-content:center;">
                                        <span class="text-muted">No image</span>
                                    </div>
                                @endif
                            </a>
                        @endforeach

                        {{-- if less than 2 images, fill --}}
                        @if($productImages->count() < 2)
                            @for($i = $productImages->count(); $i < 2; $i++)
                                <a href="#" class="right-tile">
                                    <div style="width:100%; height:100%; background:#f5f5f5; display:flex; align-items:center; justify-content:center;">
                                        <span class="text-muted">No image</span>
                                    </div>
                                </a>
                            @endfor
                        @endif

                    @endif
                </div>
            </div>

        </div>
    </div>
</div>


@if(isset($bottomImages) && $bottomImages->count() > 0)
<div class="row g-2 mb-3 mt-3" id="bottomGallery">
    @foreach($bottomImages as $index => $image)
        <div class="col-md-3 {{ $index > 0 ? 'justify-content-center d-flex align-items-center' : '' }}">
            <img src="{{ asset($image->image) }}" class="img-fluid gallery-image" alt="Ehed Gallery Image" data-gallery="bottomGallery" data-index="{{ $index }}" style="cursor: pointer;" onclick="openImageModal('bottomGallery', {{ $index }})">
        </div>
    @endforeach
    @if($bottomImages->count() < 4)
        @for($i = $bottomImages->count(); $i < 4; $i++)
            <div class="col-md-3 justify-content-center d-flex align-items-center">
                <div style="width: 100%; height: 200px; background-color: #f5f5f5; display: flex; align-items: center; justify-content: center;">
                    <span class="text-muted">No image</span>
                </div>
            </div>
        @endfor
    @endif
</div>
@endif

@if(isset($bottomImagesRow2) && $bottomImagesRow2->count() > 0)
<div class="row g-2 mb-3 mt-3" id="bottomGalleryRow2">
    @foreach($bottomImagesRow2 as $index => $image)
        <div class="col-md-3 {{ $index > 0 ? 'justify-content-center d-flex align-items-center' : '' }}">
            <img src="{{ asset($image->image) }}" class="img-fluid gallery-image" alt="Ehed Gallery Image" data-gallery="bottomGalleryRow2" data-index="{{ $index }}" style="cursor: pointer;" onclick="openImageModal('bottomGalleryRow2', {{ $index }})">
        </div>
    @endforeach
    @if($bottomImagesRow2->count() < 4)
        @for($i = $bottomImagesRow2->count(); $i < 4; $i++)
            <div class="col-md-3 justify-content-center d-flex align-items-center">
                <div style="width: 100%; height: 200px; background-color: #f5f5f5; display: flex; align-items: center; justify-content: center;">
                    <span class="text-muted">No image</span>
                </div>
            </div>
        @endfor
    @endif
</div>
@endif
<style>
.ehed-shop-spacing {
    display: flex;
    align-items: center;
    justify-content: center;
    height: 9.5rem;
}
</style>
<div class="ehed-shop-spacing">
    <x-shop-now :href="route('collections.ehed')" class="btn border btn-outline-dark px-5 py-2" />
</div>



@include('public.partials.image-gallery-modal')
@endsection









