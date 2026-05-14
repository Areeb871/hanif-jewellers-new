@extends('public.layouts.header_latest')

@section('content')
@php
    $desktopBanner = $subcategory->banner_url ?? null;
    $isDesktopVideo = $desktopBanner ? \Illuminate\Support\Str::endsWith(strtolower($desktopBanner), ['.mp4', '.webm', '.ogg']) : false;
    $desktopBannerExt = $isDesktopVideo ? strtolower(pathinfo($desktopBanner, PATHINFO_EXTENSION)) : null;
@endphp

<!-- DESKTOP -->
<section class="sectionOne d-md-block d-none">

    @if($isDesktopVideo)
        <video autoplay loop muted playsinline class="bannerMedia"
            onerror="this.style.display='none'; this.nextElementSibling?.classList.remove('d-none');">
            <source src="{{ asset($desktopBanner) }}" type="video/{{ $desktopBannerExt }}">
        </video>

        <img src="{{ asset($desktopBanner) }}" 
             alt="{{ $subcategory->name ?? 'Heritage Banner' }}" 
             class="bannerMedia d-none">

    @elseif($desktopBanner)
        <img src="{{ asset($desktopBanner) }}" 
             alt="{{ $subcategory->name ?? 'Heritage Banner' }}" 
             class="bannerMedia">
    @else
        <video autoplay loop muted playsinline class="bannerMedia">
            <source src="{{ asset('assets/f_assets/image/heritage_mobile.mp4') }}" type="video/mp4">
        </video>
    @endif

</section>

<!-- MOBILE -->
<section class="sectionMobile d-md-none">
    <video autoplay loop muted playsinline class="bannerMedia">
        <source src="{{ asset('assets/f_assets/image/heritage_mobile.mp4') }}" type="video/mp4">
    </video>
</section>
<style>
    :root{
    --header-desktop: 120px;
    --header-mobile: 80px;
}

/* DESKTOP */
.sectionOne{
    position: relative;
    min-height: calc(100vh - var(--header-desktop));
    overflow: hidden;
}

/* MOBILE */
.sectionMobile{
    position: relative;
    min-height: calc(100vh - var(--header-mobile));
    overflow: hidden;
}

/* MEDIA (video + img same behavior) */
.bannerMedia{
    position: absolute;
    inset: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
}

/* remove any unwanted spacing */
.sectionOne,
.sectionMobile{
    margin: 0 !important;
    padding: 0 !important;
}
</style>

   <section class="container">
    <style>
        @media (max-width: 767.98px) {
            .container {
                padding-top: 1.5rem !important;
            }

            .py-3 {
                padding-top: 1rem !important;
                padding-bottom: 2rem !important;
            }

            .mt-4 {
                margin-top: 1rem !important;
            }

            .mb-4 {
                margin-bottom: 1.5rem !important;
            }

            .mb-3 {
                margin-bottom: 1.5rem !important;
            }

            .g-3 {
                gap: 1rem !important;
            }

            .px-5 {
                padding-left: 1.5rem !important;
                padding-right: 1.5rem !important;
                margin-bottom: 2rem !important;
            }

            p,
            .text-center {
                text-align: center !important;
            }
        }

        .mt-3 {
            margin-top: 0rem !important;
        }

        p {
            text-align: center !important;
        }
    </style>

    <h4 class="text-center py-3 mt-4 text-uppercase">Discover Our Collection</h4>

    <!-- TOP GALLERY -->
    <div class="row g-3 mb-3" id="heritageGalleryTop">
        <div class="col-md-3">
            <img
                src="{{ asset('assets/f_assets/image/heritage/Heritage Jewels 1.png') }}"
                class="img-fluid gallery-image"
                alt="Heritage Jewel 1"
                style="cursor:pointer"
                onclick="openImageModal('heritageGalleryTop', 0)">
        </div>

        <div class="col-md-3 justify-content-center d-flex align-items-center">
            <img
                src="{{ asset('assets/f_assets/image/heritage/Heritage Jewels 2.png') }}"
                class="img-fluid gallery-image"
                alt="Heritage Jewel 2"
                style="cursor:pointer"

                onclick="openImageModal('heritageGalleryTop', 1)">
        </div>

        <div class="col-md-3 justify-content-center d-flex align-items-center">
            <img
                src="{{ asset('assets/f_assets/image/heritage/Heritage Jewels 3.jpg') }}"
                class="img-fluid gallery-image"
                alt="Heritage Jewel 3"
                style="cursor:pointer"

                onclick="openImageModal('heritageGalleryTop', 2)">
        </div>

        <div class="col-md-3 justify-content-center d-flex align-items-center">
            <img
                src="{{ asset('assets/f_assets/image/heritage/Heritage Jewels 4.jpg') }}"
                class="img-fluid gallery-image"
                alt="Heritage Jewel 4"
                style="cursor:pointer"

                onclick="openImageModal('heritageGalleryTop', 3)">
        </div>
    </div>

    <!-- MIDDLE SECTION -->
    <div class="row g-4 align-items-center">

        <!-- LEFT IMAGE CAROUSEL -->
        <div class="col-md-7">
            <div id="heritageHighlightCarousel" class="carousel slide mb-5" data-bs-ride="carousel">
                <div class="carousel-inner">

                    <div class="carousel-item active">
                        <img
                            src="{{ asset('assets/f_assets/image/heritage/Heritage Jewels 13.jpg') }}"
                            class="d-block w-100 img-fluid gallery-image"
                            alt="Heritage Highlight 1"
                            onclick="openImageModal('heritageHighlightCarousel', 0)">
                    </div>

                    <div class="carousel-item">
                        <img
                            src="{{ asset('assets/f_assets/image/heritage/Heritage Jewels 14.jpg') }}"
                            class="d-block w-100 img-fluid gallery-image"
                            alt="Heritage Highlight 2"
                            onclick="openImageModal('heritageHighlightCarousel', 1)">
                    </div>

                    <div class="carousel-item">
                        <img
                            src="{{ asset('assets/f_assets/image/heritage/Heritage Jewels 15.jpg') }}"
                            class="d-block w-100 img-fluid gallery-image"
                            alt="Heritage Highlight 3"
                            onclick="openImageModal('heritageHighlightCarousel', 2)">
                    </div>

                    <div class="carousel-item">
                        <img
                            src="{{ asset('assets/f_assets/image/heritage/Heritage Jewels 16.jpg') }}"
                            class="d-block w-100 img-fluid gallery-image"
                            alt="Heritage Highlight 4"
                            onclick="openImageModal('heritageHighlightCarousel', 3)">
                    </div>

                    <div class="carousel-item">
                        <img
                            src="{{ asset('assets/f_assets/image/heritage/Heritage Jewels 17.jpg') }}"
                            class="d-block w-100 img-fluid gallery-image"
                            alt="Heritage Highlight 5"
                            onclick="openImageModal('heritageHighlightCarousel', 4)">
                    </div>

                    <div class="carousel-item">
                        <img
                            src="{{ asset('assets/f_assets/image/heritage/Heritage Jewels 18.jpg') }}"
                            class="d-block w-100 img-fluid gallery-image"
                            alt="Heritage Highlight 6"
                            onclick="openImageModal('heritageHighlightCarousel', 5)">
                    </div>

                    <div class="carousel-item">
                        <img
                            src="{{ asset('assets/f_assets/image/heritage/Heritage Jewels 19.jpg') }}"
                            class="d-block w-100 img-fluid gallery-image"
                            alt="Heritage Highlight 7"
                            onclick="openImageModal('heritageHighlightCarousel', 6)">
                    </div>

                    <div class="carousel-item">
                        <img
                            src="{{ asset('assets/f_assets/image/heritage/Heritage Jewels 20.jpg') }}"
                            class="d-block w-100 img-fluid gallery-image"
                            alt="Heritage Highlight 8"
                            onclick="openImageModal('heritageHighlightCarousel', 7)">
                    </div>

                </div>

                <button class="carousel-control-prev" type="button" data-bs-target="#heritageHighlightCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon"></span>
                </button>

                <button class="carousel-control-next" type="button" data-bs-target="#heritageHighlightCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon"></span>
                </button>
            </div>
        </div>

        <!-- RIGHT TEXT -->
        <div class="col-md-5 d-flex justify-content-center align-items-center">
            <div class="text-center">
                <p class="mb-4" style="font-size: 20px;">
                    An ode to contemporary beauty. Woven in sweeping gold, this necklace whispers secrets of the past with a discreet charm that's effortlessly modern.
                </p>

                <a class="btn border btn-outline-dark px-4 py-2 mt-3" href="{{ route('contact-us') }}">
                    BOOK AN APPOINTMENT
                </a>
            </div>
        </div>

    </div>

    <!-- BOTTOM GALLERY -->
    <div class="row g-3 mb-3" id="heritageGalleryBottom">
        <div class="col-md-3 justify-content-center d-flex align-items-center">
            <img
                src="{{ asset('assets/f_assets/image/heritage/Heritage Jewels 5.jpg') }}"
                class="img-fluid gallery-image"
                alt="Heritage Jewel 5"
                style="margin-top: 10px;"
                style="cursor:pointer"

                onclick="openImageModal('heritageGalleryBottom', 0)">
        </div>

        <div class="col-md-3 justify-content-center d-flex align-items-center">
            <img
                src="{{ asset('assets/f_assets/image/heritage/Heritage Jewels 6.jpg') }}"
                class="img-fluid gallery-image"
                alt="Heritage Jewel 6"
                style="cursor:pointer"

                onclick="openImageModal('heritageGalleryBottom', 1)">
        </div>

        <div class="col-md-3 justify-content-center d-flex align-items-center">
            <img
                src="{{ asset('assets/f_assets/image/heritage/Heritage Jewels 7.jpg') }}"
                class="img-fluid gallery-image"
                alt="Heritage Jewel 7"
                style="cursor:pointer"

                onclick="openImageModal('heritageGalleryBottom', 2)">
        </div>

        <div class="col-md-3 justify-content-center d-flex align-items-center">
            <img
                src="{{ asset('assets/f_assets/image/heritage/Heritage Jewels 8.jpg') }}"
                class="img-fluid gallery-image"
                alt="Heritage Jewel 8"
                style="cursor:pointer"

                onclick="openImageModal('heritageGalleryBottom', 3)">
        </div>

        <!--<div class="col-md-3">-->
        <!--    <img-->
        <!--        src="{{ asset('assets/f_assets/image/heritage/Heritage Jewels 9.jpg') }}"-->
        <!--        class="img-fluid gallery-image"-->
        <!--        alt="Heritage Jewel 9"-->
        <!--        style="cursor:pointer"-->

        <!--        onclick="openImageModal('heritageGalleryBottom', 4)">-->
        <!--</div>-->

        <div class="col-md-3 justify-content-center d-flex align-items-center">
            <img
                src="{{ asset('assets/f_assets/image/heritage/Heritage Jewels 10.jpg') }}"
                class="img-fluid gallery-image"
                alt="Heritage Jewel 10"
                style="cursor:pointer"

                onclick="openImageModal('heritageGalleryBottom', 5)">
        </div>

        <div class="col-md-3 justify-content-center d-flex align-items-center">
            <img
                src="{{ asset('assets/f_assets/image/heritage/Heritage Jewels 11.jpg') }}"
                class="img-fluid gallery-image"
                alt="Heritage Jewel 11"
                style="cursor:pointer"

                onclick="openImageModal('heritageGalleryBottom', 6)">
        </div>

        <div class="col-md-3 justify-content-center d-flex align-items-center">
            <img
                src="{{ asset('assets/f_assets/image/heritage/Heritage Jewels 12.jpg') }}"
                class="img-fluid gallery-image"
                alt="Heritage Jewel 12"
                style="cursor:pointer"

                onclick="openImageModal('heritageGalleryBottom', 7)">
        </div>
    </div>
</section>

    @include('public.partials.image-gallery-modal')

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Modal functionality is already included in the image-gallery-modal partial
        // No additional initialization needed for the gallery
    });
    </script>
@endsection
