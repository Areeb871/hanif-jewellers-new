@extends('public.layouts.header_new')

@section('content')
    <!-- GULPOSH VIDEO BANNER -->
<!-- GULPOSH VIDEO BANNER -->
@php
    $desktopBanner = $subcategory->banner_url ?? null;

    // static mobile banner
    $mobileBanner = 'assets/f_assets/image/Gulposh Reel Mob Banner.mp4';

    $desktopIsVideo = $desktopBanner 
        ? \Illuminate\Support\Str::endsWith(strtolower($desktopBanner), ['.mp4', '.webm', '.ogg']) 
        : false;
@endphp

<style>
html, body{
    margin: 0;
    padding: 0;
}

/* =========================
   FULL WIDTH WRAPPER
========================= */
.fullBanner{
    width: 100vw;
    margin-left: calc(50% - 50vw);
    margin-right: calc(50% - 50vw);
    overflow: hidden;
    line-height: 0;
}

/* =========================
   RESPONSIVE MEDIA
========================= */
.fullBannerMedia{
    width: 100%;
    height: auto;          /* 👈 SHRINK */
    display: block;
    object-fit: contain;   /* 👈 NO CROP */
}
</style>

{{-- DESKTOP (FROM BACKEND) --}}
@if($desktopBanner)
<section class="fullBanner d-none d-md-block">
    @if($desktopIsVideo)
        <video autoplay loop muted playsinline class="fullBannerMedia">
            <source src="{{ asset($desktopBanner) }}" type="video/{{ strtolower(pathinfo($desktopBanner, PATHINFO_EXTENSION)) }}">
            Your browser does not support the video tag.
        </video>
    @else
        <img src="{{ asset($desktopBanner) }}" class="fullBannerMedia" alt="Gulposh Banner">
    @endif
</section>
@endif

{{-- MOBILE (STATIC) --}}
<section class="fullBanner d-md-none">
    <video autoplay loop muted playsinline class="fullBannerMedia">
        <source src="{{ asset($mobileBanner) }}" type="video/mp4">
        Your browser does not support the video tag.
    </video>
</section>
    <section class="container">
        <h4 class="text-center py-3 mt-4 text-uppercase">Discover Our Collection</h4>
        <div class="row g-3 mb-3">
            <div class="col-md-6">
                @php
                    $gulposhImages1 = [];
                    for ($i = 1; $i <= 4; $i++) {
                        $gulposhImages1[] = [
                            'src' => asset('assets/f_assets/image/gulposh/product/' . $i . '.png'),
                            'alt' => 'gulposh-1-' . $i,
                        ];
                    }
                @endphp
                @include('public.partials.carousel', [
                    'id' => 'gulposhCarousel1',
                    'images' => $gulposhImages1,
                ])
            </div>
            <div class="col-md-6">
            @php
                    $gulposhImages2 = [];
                    for ($i = 1; $i <= 4; $i++) {
                        $gulposhImages2[] = [
                            'src' => asset('assets/f_assets/image/gulposh/model/' . $i . '.gif'),
                            'alt' => 'gulposh-2-' . $i,
                        ];
                    }
                @endphp
                @include('public.partials.carousel', [
                    'id' => 'gulposhCarousel2',
                    'images' => $gulposhImages2,
                ])
            </div>
        </div>
        <div class="row g-3 justify-content-center align-items-center">
            <div class="col-md-6 d-flex justify-content-center align-items-center">
                <div class="text-center">
                    <p class="p-4 m-0">
                    A garden of nature’s beauty and luxury’s refinement. Inspired by the earth’s splendor, crafted with meticulous care, each piece is a masterpiece of elegance, sophistication, and timeless allure.
                    </p>
                </div>
            </div>
        </div>
       <!-- DESKTOP -->
<!-- DESKTOP -->
<div class="fullBanner bannerGap d-none d-md-block">
    <video autoplay loop muted playsinline class="fullBannerMedia">
        <source src="{{ asset('assets/f_assets/image/gulposh/Golposh Product Desktop Banner 1.mp4') }}" type="video/mp4">
    </video>
</div>

<!-- MOBILE -->
<div class="fullBanner bannerGap d-md-none">
    <video autoplay loop muted playsinline class="fullBannerMedia">
        <source src="{{ asset('assets/f_assets/image/gulposh/Product Mobile.mp4') }}" type="video/mp4">
    </video>
</div>

<style>
html, body{
    margin: 0;
    padding: 0;
}

/* YOUR ORIGINAL FULL WIDTH */
.fullBanner{
    width: 100vw;
    margin-left: calc(50% - 50vw);
    margin-right: calc(50% - 50vw);
    overflow: hidden;
    line-height: 0;
}

/* GAP CONTROL */
.bannerGap{
    padding-left: 20px;   /* 👈 left gap */
    padding-right: 20px;  /* 👈 right gap */
    box-sizing: border-box;
}

/* MEDIA */
.fullBannerMedia{
    width: 100%;
    height: auto;
    display: block;
    object-fit: contain;
}
</style>
        <div class="row">
            <style>
                    .app-btn {
                        padding: 6px 16px !important;
                    }
                    .gulposh-appointment-spacing {
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        height: 9.5rem;
                    }
            </style>
            <div class="gulposh-appointment-spacing">
                <x-book-appointment />
            </div>
            <!-- <div class="col-md-6 text-center">
                <x-shop-now :href="route('subcategory', ['subcategory' => 'gohar'])" class="m-5 btn border btn-outline-dark px-5 py-2" style="padding: 10px 100px !important" />
            </div> -->
        </div>
    </section>

    <style>
        #gulposhCarousel1 .carousel-item img,
        #gulposhCarousel2 .carousel-item img {
            width: 100%;
            max-width: 640px;
            height: auto;
            aspect-ratio: 640 / 600;
            object-fit: cover;
        }
    </style>

    @include('public.partials.image-gallery-modal')

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const carousels = ['gulposhCarousel1', 'gulposhCarousel2'];
            carousels.forEach(function(id) {
                const el = document.getElementById(id);
                if (el) {
                    new bootstrap.Carousel(el, { interval: false, wrap: true, touch: true });
                }
            });
        });
    </script>
@endsection


