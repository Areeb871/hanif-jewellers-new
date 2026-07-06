@extends('public.layouts.header_new')

@section('content')
@php
    $desktopBanner = $subcategory->banner_url ?? 'assets/f_assets/image/Qaws-al-Matr Desktop View.mp4';
    $mobileBanner  = 'assets/f_assets/image/Qaws-ul-Matr Mob View.mp4';

    $isDesktopVideo = \Illuminate\Support\Str::endsWith(strtolower($desktopBanner), ['.mp4', '.webm', '.ogg']);
@endphp

<style>
html, body{
    margin: 0;
    padding: 0;
}

/* full width */
.fullBanner{
    width: 100vw;
    margin-left: calc(50% - 50vw);
    margin-right: calc(50% - 50vw);
    overflow: hidden;
    line-height: 0;
}

/* responsive (no crop) */
.fullBannerMedia{
    width: 100%;
    height: auto;
    display: block;
    object-fit: contain;
}
</style>

{{-- DESKTOP --}}
<section class="fullBanner d-none d-md-block">
    @if($isDesktopVideo)
        <video autoplay loop muted playsinline class="fullBannerMedia">
            <source src="{{ asset($desktopBanner) }}" type="video/{{ strtolower(pathinfo($desktopBanner, PATHINFO_EXTENSION)) }}">
        </video>
    @else
        <img src="{{ asset($desktopBanner) }}" class="fullBannerMedia" alt="Banner">
    @endif
</section>

{{-- MOBILE --}}
<section class="fullBanner d-md-none">
    <video autoplay loop muted playsinline class="fullBannerMedia">
        <source src="{{ asset($mobileBanner) }}" type="video/mp4">
    </video>
</section>
    <section class="container">
        <style>
            /* Mobile-specific spacing adjustments */
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
                }
                /* Add more spacing below text on mobile */
                .px-5 {
                    margin-bottom: 2rem !important;
                }
                /* Center all text on mobile */
                p {
                    text-align: center !important;
                }
                .text-center {
                    text-align: center !important;
                }
            }
            
            /* Center all text on desktop as well */
            p {
                text-align: center !important;
                font-family: "Lato", sans-serif;
                font-weight: 300;
                font-size: 16px;
            }
            h4{
         font-family: "Lato", sans-serif;
    font-weight: 300;
        font-size: 18px;
            }
        </style>
        <h4 class="text-center py-3 mt-4 text-uppercase">Discover Our Collection</h4>
     
        <div class="row g-3 mb-3" id="qawsAlMatarGallery">
            <div class="col-md-3">
                <img src="{{ asset('assets/f_assets/image/Qaws al matar Web/Qaws al matar Web 001.jpg') }}" class="img-fluid" alt="Qaws al Matar Collection" style="cursor: pointer;" onclick="openImageModal('qawsAlMatarGallery', 0)">
            </div>
            <div class="col-md-3 justify-content-center d-flex align-items-center">
                 <img src="{{ asset('assets/f_assets/image/Qaws al matar Web/Qaws al matar Web 002.jpg') }}" class="img-fluid" alt="Qaws al Matar Collection" style="cursor: pointer;" onclick="openImageModal('qawsAlMatarGallery', 1)">
            </div>
             <div class="col-md-3 justify-content-center d-flex align-items-center">
                 <img src="{{ asset('assets/f_assets/image/Qaws al matar Web/Qaws al matar Web 003.jpg') }}" class="img-fluid" alt="Qaws al Matar Collection" style="cursor: pointer;" onclick="openImageModal('qawsAlMatarGallery', 2)">
            </div>
             <div class="col-md-3 justify-content-center d-flex align-items-center">
                 <img src="{{ asset('assets/f_assets/image/Qaws al matar Web/Qaws al matar Web 004.jpg') }}" class="img-fluid" alt="Qaws al Matar Collection" style="cursor: pointer;" onclick="openImageModal('qawsAlMatarGallery', 3)">
            </div>

        </div>
        <div class="row g-4 align-items-center">
            <div class="col-md-7">
                <div class="text-center mb-5" id="qawsAlMatarHero">
                    <img src="{{ asset('assets/f_assets/image/Qaws al matar Web/Qaws al matar Web 005.jpg') }}" class="img-fluid" alt="Ehad Collection" style="margin-top: 8px; cursor: pointer;" onclick="openImageModal('qawsAlMatarHero', 0)">
                </div>
            </div>
            <div class="col-md-5 m-0">
                <div class="text-center px-5">
<p class="m-0">
    Brilliantly Handcrafted Bespoke Pieces, an ensemble of Gold and opulent Gemstones combined with a touch of class. A hallmark of The Art of handcrafted, bespoke jewellery.
</p>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-12 text-center my-4">
                <a class="m-1 app-btn btn border btn-outline-dark px-2 py-1" href="{{ route('contact-us')  }}">BOOK AN APPOINTMENT</a>
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
