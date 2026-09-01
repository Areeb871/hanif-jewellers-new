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
.gulposh-story{position:relative;aspect-ratio:16/9;background:#07140d}
.gulposh-story__image{position:absolute;inset:0;width:100%;height:100%;object-fit:cover;display:block}
.gulposh-story__panel{position:absolute;left:clamp(20px,3.65vw,70px);bottom:clamp(20px,4.7vw,90px);z-index:2;display:flex;flex-direction:column;align-items:flex-start;width:clamp(340px,34vw,560px);max-width:calc(100% - 40px);box-sizing:border-box;padding:0;font-family:'Poppins',sans-serif;text-align:left}
.gulposh-story__title,.gulposh-mobile__title{margin:0;color:#fff;font-family:'Poppins',sans-serif;font-size:clamp(20px,1.6vw,26px);font-weight:500;letter-spacing:.18em;line-height:1.2;text-wrap:balance}
.gulposh-story__copy{margin:10px 0 18px;width:100%;max-width:40em;color:#fff;font-size:clamp(12px,.78vw,14px);font-weight:400;letter-spacing:.02em;line-height:1.7}
.gulposh-story__button,.gulposh-mobile__button{display:inline-block;padding:clamp(10px,.72vw,13px) clamp(16px,1.4vw,26px);background:#fff;color:#111;font-family:'Poppins',sans-serif;font-size:clamp(10px,.58vw,11px);letter-spacing:.16em;line-height:1.4;text-decoration:none;text-transform:uppercase}
.gulposh-story__button:hover{background:#e7e7e7;color:#111}
.gulposh-mobile{background:#fff;text-align:center}
.gulposh-mobile__image{width:100%;height:auto;display:block}
.gulposh-mobile__content{display:flex;flex-direction:column;align-items:center;justify-content:center;width:100%;box-sizing:border-box;padding:32px 24px 36px;font-family:'Poppins',sans-serif;text-align:center}
.gulposh-mobile__title{display:block;width:100%;color:#111;font-size:22px;text-align:center}
.gulposh-mobile__copy{display:block;width:100%;max-width:34em;margin:12px auto 20px;color:#222;font-family:'Poppins',sans-serif;font-size:13px;font-weight:400;letter-spacing:.02em;line-height:1.7;text-align:center}
.gulposh-mobile__button{width:auto;background:#111;color:#fff;text-align:center}
.gulposh-mobile__button:hover{background:#2b2b2b;color:#fff}
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
    <section>
        <div class="fullBanner gulposh-story d-none d-lg-block">
            <img src="{{ asset('assets/f_assets/image/gulposh/desktop1.png') }}" class="gulposh-story__image" alt="Gulposh collection">
            <div class="gulposh-story__panel">
                <h2 class="gulposh-story__title">GULPOSH</h2>
                <p class="gulposh-story__copy">A garden of nature's beauty and luxury's refinement. Inspired by the earth's splendor, crafted with meticulous care, each piece is a masterpiece of elegance, sophistication, and timeless allure.</p>
                <a class="gulposh-story__button" href="https://api.whatsapp.com/send?phone=923070222666&text={{ rawurlencode('Hello Hanif Jewellers, I would like to book an appointment.') }}" target="_blank" rel="noopener noreferrer">BOOK AN APPOINTMENT</a>
            </div>
        </div>
        <div class="fullBanner gulposh-mobile d-lg-none">
            <img src="{{ asset('assets/f_assets/image/gulposh/mob1.png') }}" class="gulposh-mobile__image" alt="Gulposh collection">
            <div class="gulposh-mobile__content">
                <h2 class="gulposh-mobile__title">GULPOSH</h2>
                <p class="gulposh-mobile__copy">A garden of nature's beauty and luxury's refinement. Inspired by the earth's splendor, crafted with meticulous care, each piece is a masterpiece of elegance, sophistication, and timeless allure.</p>
                <a class="gulposh-mobile__button" href="https://api.whatsapp.com/send?phone=923070222666&text={{ rawurlencode('Hello Hanif Jewellers, I would like to book an appointment.') }}" target="_blank" rel="noopener noreferrer">BOOK AN APPOINTMENT</a>
            </div>
        </div>
        <div class="d-none">
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
<div class="fullBanner d-none d-md-block">
    <video autoplay loop muted playsinline class="fullBannerMedia">
        <source src="{{ asset('assets/f_assets/image/gulposh/Golposh Product Desktop Banner 1.mp4') }}" type="video/mp4">
    </video>
</div>

<!-- MOBILE -->
<div class="fullBanner d-md-none">
    <video autoplay loop muted playsinline class="fullBannerMedia">
        <source src="{{ asset('assets/f_assets/image/gulposh/Product Mobile.mp4') }}" type="video/mp4">
    </video>
</div>

        <div class="container pt-4 pt-md-5">
        <div class="row g-3 mt-0">
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
        <div class="row g-0">
            <style>
                    .app-btn {
                        padding: 6px 16px !important;
                    }
                    .gulposh-appointment-spacing {
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        width: 100%;
                        height: auto;
                        padding: 48px 20px;
                        box-sizing: border-box;
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


