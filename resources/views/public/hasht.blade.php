@extends('public.layouts.header_latest')

@section('content')
<style>
/* =========================
   Banner Container
========================= */
.custom-banner {
    width: 100%;
    margin: 0;
    padding: 0;
    position: relative;
    overflow: hidden;
}

/* Full width video */
.custom-banner-video {
    width: 100%;
    height: auto;
    display: block;
}

/* Full width image fallback */
.custom-banner img {
    width: 100%;
    height: auto;
    display: block;
}

/* Optional image background */
.custom-banner-image {
    position: absolute;
    inset: 0;
    width: 100%;
    height: 100%;
    background-position: center;
    background-size: cover;
    background-repeat: no-repeat;
    z-index: 0;
}

/* =========================
   Overlay Content
========================= */
.banner-content {
    position: absolute;
    right: 5%;
    top: 63%;
    transform: translateY(-50%);
    z-index: 5;
    max-width: 420px;
    color: #fff;
    text-align: left;
}

.banner-location {
    font-size: 12px;
    letter-spacing: 2px;
    text-transform: uppercase;
    opacity: 0.85;
    margin-top: 15px;
    margin-bottom: 21px;
    line-height: 1.6;
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
}

.banner-title {
    font-family: 'Cinzel Decorative', serif;
    font-size: 31px;
    font-weight: 400;
    letter-spacing: 6px;
    margin: 0;
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
    white-space: nowrap;
}

.custom-banner-btn {
    display: inline-block;
    padding: 12px 32px;
    font-size: 12px;
    font-weight: 500;
    letter-spacing: 2px;
    text-transform: uppercase;
    background: transparent;
    color: #ffffff;
    text-decoration: none;
    border: 1px solid rgba(255, 255, 255, 0.6);
    border-radius: 0;
    transition: all 0.3s ease;
    z-index: 10;
}

.custom-banner-btn:hover {
    background-color: #1d1c1c;
    border-color: #1d1c1c;
    color: #ffffff;
}

/* =======================
   MOBILE STACK
======================= */
.mobileStackHero {
    width: 100%;
    background: #fff;
}

.mobileStackImgWrap {
    width: 100%;
    overflow: hidden;
    background: #000;
}

.mobileStackImg,
.mobileStackVideo {
    width: 100%;
    height: auto;
    display: block;
}

/* =========================
   Responsive
========================= */
@media (max-width: 991px) {
    .banner-content {
        right: 4%;
        top: 60%;
        max-width: 320px;
    }

    .banner-title {
        font-size: 24px;
        letter-spacing: 4px;
        white-space: normal;
    }

    .banner-location {
        font-size: 11px;
        letter-spacing: 1.5px;
    }

    .custom-banner-btn {
        padding: 10px 24px;
        font-size: 11px;
    }
}
</style>

@php
    $desktopBanner = $subcategory->banner_url ?? '';

    // static mobile banner
    $mobileBanner = 'assets/f_assets/image/Hasht Web/hasht_mobile_new.mp4';

    // detect if backend banner is video
    $isDesktopVideo = $desktopBanner
        ? \Illuminate\Support\Str::endsWith(strtolower($desktopBanner), ['.mp4', '.webm', '.ogg'])
        : false;

    // use full URL as-is, otherwise asset()
    $desktopBannerSrc = $desktopBanner
        ? (filter_var($desktopBanner, FILTER_VALIDATE_URL) ? $desktopBanner : asset($desktopBanner))
        : '';

    $mobileBannerSrc = filter_var($mobileBanner, FILTER_VALIDATE_URL) ? $mobileBanner : asset($mobileBanner);
@endphp

<style>
html, body{
    margin: 0;
    padding: 0;
}

.fullBanner{
    width: 100vw;
    margin-left: calc(50% - 50vw);
    margin-right: calc(50% - 50vw);
    overflow: hidden;
    line-height: 0;
}

.fullBannerMedia,
.fullBannerImage{
    width: 100%;
    height: auto;
    display: block;
    object-fit: contain;
}
</style>

{{-- DESKTOP --}}
<section class="fullBanner d-none d-md-block">
    @if(!empty($desktopBannerSrc))
        @if($isDesktopVideo)
            <video autoplay loop muted playsinline class="fullBannerMedia">
                <source src="{{ $desktopBannerSrc }}" type="video/{{ strtolower(pathinfo($desktopBanner, PATHINFO_EXTENSION)) }}">
                Your browser does not support the video tag.
            </video>
        @else
            <img src="{{ $desktopBannerSrc }}" alt="{{ $subcategory->name ?? 'Banner' }}" class="fullBannerImage">
        @endif
    @else
        <div style="padding:40px; text-align:center;">Desktop banner not found</div>
    @endif
</section>

{{-- MOBILE --}}
<section class="fullBanner d-md-none">
    <video autoplay loop muted playsinline class="fullBannerMedia">
        <source src="{{ $mobileBannerSrc }}" type="video/mp4">
        Your browser does not support the video tag.
    </video>
</section>


    <section class="container">
        <h4 class="text-center py-3 pb-5 mt-4 text-uppercase">Discover Our Collection</h4>
        <div class="row g-4">
            <div class="col-md-6">
                <div class="text-center mb-5">
                    <img src="{{ asset('assets/f_assets/image/Hasht_Rubies_Rose_Gold_Pendant_1500X2100.jpg') }}"
                        class="img-fluid" alt="Hasht Collection">
                </div>
                <div class="text-center my-5">
                    <p class="p-5">A piece crafted by House of Hanif to signify Man's connection with the Creator, embellished with the finest of His creations, the purest of precious metals and the rarest of stones to create an expression and an experience of pure art.</p>
                </div>
                <div class="text-center py-5">
                    <img src="{{ asset('assets/f_assets/image/Hasht_Emerald_Yellow_Gold_Pendant_1500X2100.jpg') }}"
                        class="img-fluid emerald-img" alt="Hasht Collection" style="margin-top: 84px;">
                </div>
            </div>
            <div class="col-md-6">
                <div class="text-center my-5">
                    <p class="p-5">HASHT ہشت, literally meaning "Eight", an inspiration taken from the emerald cut and its 8 sides, the 8 doors of heaven, ultimate success and the fulfilment of dreams.</p>
                </div>
                <div class="text-center my-5">
                    <img src="{{ asset('assets/f_assets/image/Hasht_Sapphire_White_Gold_Pendant_3_1500X2100.png') }}"
                        class="img-fluid custom-img" alt="Hasht Collection" style="margin-top: 155px;"
                        >
                    <div class="mt-3 d-md-none text-center py-5">
                        <p class="p-5 fs-6">BESPOKE COLLECTION FROM THE HOUSE OF HANIF</p>
                    </div>
                    <div class="text-center my-5 d-none d-md-block">
                    <p class="p-5" style="font-size: 1.5em;">BESPOKE COLLECTION FROM THE HOUSE OF HANIF</p>
                </div>
                </div>
            </div>
        </div>
        <div class="row">
            <style>
                    .app-btn {
                        padding: 6px 16px !important;
                    }
                    /* Desktop positioning for the second image */
                    .col-md-6 img[src*="Hasht_Emerald_Yellow_Gold_Pendant"] {
                        margin-top: 80px;
                    }
                    
                    /* Desktop text positioning - move down and center */
                    @media (min-width: 768px) {
                        .col-md-6 .my-5 p {
                            margin-top: 181px !important;
                            text-align: center !important;
                        }

                    }
                    
                    /* Mobile-specific spacing */
                    @media (max-width: 767.98px) {
                        .my-5 {
                            margin-top: 2rem !important;
                            margin-bottom: 1rem !important;
                        }
                        .mb-5 {
                            margin-bottom: 1rem !important;
                        }
                        .py-5 {
                            padding-top: 1rem !important;
                            padding-bottom: 1rem !important;
                        }
                        .p-5 {
                            padding: 1rem !important;
                        }
                        
                        /* Move image up on mobile only */
                        .col-md-6 img[src*="Hasht_Emerald_Yellow_Gold_Pendant"] {
                            margin-top: 2px !important;
                        }
                        .col-md-6 img[src*="Hasht_Sapphire_White_Gold_Pendant_3"] {
                            margin-top: 40px !important;
                        }
                        
                        /* Center text on mobile */
                        .col-md-6 p {
                            text-align: center !important;
                        }

                    }
                    @media (min-width: 1400px) and (max-width: 2000px) {
        .custom-img {
            margin-top: 230px !important;
        }
        .emerald-img{
            margin-top: 150px !important;
        }
}
            </style>
            <div class="text-center" >
                <a class="m-1 app-btn btn border btn-outline-dark px-2 py-1" href="{{ route('contact-us')  }}">BOOK AN APPOINTMENT</a>
            </div>
            <!-- <div class="col-md-6 text-center">
                <a class="m-5 btn border btn-outline-dark px-5 py-2" style="padding: 10px 100px !important" href="{{ route('subcategory', ['subcategory' => 'gohar'])  }}">SHOP NOW</a>
            </div> -->
        </div>
    </section>
@endsection
