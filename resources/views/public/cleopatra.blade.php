@extends('public.layouts.header_new')

@section('content')
@php
    $backgroundType = $backgroundType ?? 'video';
    $backgroundFile = $backgroundFile ?? 'assets/f_assets/image/colection-design-images/banner.mp4';
    $mobileBackgroundFile = $mobileBackgroundFile ?? 'assets/f_assets/image/colection-design-images/mobile.mp4';
@endphp

<!-- Desktop Banner -->
<section class="sectionOne d-md-block d-none">
    @if($backgroundType === 'video' && !empty($backgroundFile))
        <video autoplay loop muted playsinline class="bannerMedia">
            <source src="{{ asset($backgroundFile) }}" type="video/mp4">
            Your browser does not support the video tag.
        </video>
    @elseif($backgroundType === 'image' && !empty($backgroundFile))
        <img src="{{ asset($backgroundFile) }}" class="bannerMedia" alt="Banner">
    @endif
</section>

<!-- Mobile Banner -->
<section class="sectionMobile d-md-none">
    <video autoplay loop muted playsinline class="bannerMedia">
        <source src="{{ asset($mobileBackgroundFile) }}" type="video/mp4">
        Your browser does not support the video tag.
    </video>
</section>

<style>
html, body{
    margin: 0;
    padding: 0;
}

/* =========================
   REMOVE HEADER GAP
========================= */
header,
.main-header,
.navbar,
.header-wrapper,
.top-header{
    margin: 0 !important;
    padding-top: 0 !important;
    padding-bottom: 0 !important;
}

header .container,
header .row,
header .col,
.navbar .container,
.navbar .row{
    margin-top: 0 !important;
    margin-bottom: 0 !important;
    padding-top: 0 !important;
    padding-bottom: 0 !important;
}

/* =========================
   RESPONSIVE BANNER
========================= */
.sectionOne,
.sectionMobile{
    width: 100%;
    height: auto; /* 👈 IMPORTANT */
    position: relative;
    overflow: hidden;
    margin: 0 !important;
    padding: 0 !important;
}

/* =========================
   MEDIA (VIDEO + IMAGE)
========================= */
.bannerMedia{
    width: 100%;
    height: auto;        /* 👈 SHRINKS */
    display: block;
    object-fit: contain; /* 👈 NO CROP */
}

/* remove unwanted gaps */
.sectionOne,
.sectionMobile,
section{
    margin-top: 0 !important;
}
</style>

    <section class="container pt-4 pt-md-5">
    <div class="row g-2 pb-2">
        <style>
            [id^="cleopatraCarousel"] .carousel-control-prev-icon,
            [id^="cleopatraCarousel"] .carousel-control-next-icon {
                filter: invert(1) brightness(200%) drop-shadow(0 0 2px rgba(0,0,0,0.6)) !important;
                width: 1.5rem !important;
                height: 1.5rem !important;
                background-size: 60% 60% !important;
                background-position: center !important;
            }

            [id^="cleopatraCarousel"] .carousel-control-prev,
            [id^="cleopatraCarousel"] .carousel-control-next {
                opacity: 1 !important;
                display: block !important;
                z-index: 30 !important;
                pointer-events: auto !important;
            }

            [id^="cleopatraCarousel"] .carousel-indicators {
                display: none !important;
            }
        </style>

        @for ($look = 1; $look <= 4; $look++)
            @php
                $slides = [];

                // Supported formats with AVIF priority
                $formats = ['avif', ($look === 2 ? 'jpg' : 'png'), 'jpg', 'png'];

                for ($i = 1; $i <= 20; $i++) {
                    $found = false;

                    foreach ($formats as $ext) {
                        $pathsToTry = [
                            "assets/f_assets/image/Cleopatra 1 Ratio 1/Cleopatra Look {$look}/Cleopatra Look {$look} ({$i}).{$ext}",
                            "assets/f_assets/image/Cleopatra 1 Ratio 1/Cleopatra Look {$look}/Cleopatra Look {$look}({$i}).{$ext}",
                            "assets/f_assets/image/Cleopatra 1 Ratio 1/Cleopatra Look {$look}/Cleopatra Look {$look}  ({$i}).{$ext}",
                        ];

                        foreach ($pathsToTry as $relative) {
                            if (file_exists(public_path($relative))) {
                                $slides[] = $relative;
                                $found = true;
                                break 2;
                            }
                        }
                    }

                    if (!$found) {
                        break;
                    }
                }
            @endphp

            <div class="col-md-3 col-6">
                @if(count($slides))
                    <div id="cleopatraCarousel{{ $look }}" class="carousel slide">
                        <div class="carousel-inner">
                            @foreach ($slides as $idx => $img)
                                <div class="carousel-item {{ $idx === 0 ? 'active' : '' }}">
                                    <img
                                        src="{{ asset($img) }}"
                                        class="d-block w-100 img-fluid"
                                        alt="Cleopatra Look {{ $look }} {{ $idx + 1 }}"
                                        style="cursor: pointer;"
                                        onclick="openImageModal('cleopatraCarousel{{ $look }}', {{ $idx }})"
                                    >
                                </div>
                            @endforeach
                        </div>

                        <button class="carousel-control-prev" type="button" data-bs-target="#cleopatraCarousel{{ $look }}" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>

                        <button class="carousel-control-next" type="button" data-bs-target="#cleopatraCarousel{{ $look }}" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                @else
                    <div class="text-center">
                        <div class="border p-5">No images found for Cleopatra Look {{ $look }}</div>
                    </div>
                @endif
            </div>
        @endfor
    </div>

    <div class="row">
        <style>
            .app-btn {
                padding: 6px 16px !important;
            }

            .cleopatra-appointment-spacing {
                display: flex;
                justify-content: center;
                align-items: center;
                padding: 3rem 0 3.5rem;
            }
        </style>

        {{-- <div class="text-center">
            <x-book-appointment class="m-1" />
        </div> --}}

        <!-- <div class="col-md-6 text-center">
            <x-shop-now :href="route('subcategory', ['subcategory' => 'gohar'])" class="m-5 btn border btn-outline-dark px-5 py-2" style="padding: 10px 100px !important" />
        </div> -->
    </div>

<div class="row g-4 align-items-center">

    <!-- BIG IMAGE -->
    <div class="col-md-7">
        <img
            src="{{ asset('assets/f_assets/image/colection-design-images/Cleopatra_single.png') }}"
            class="img-fluid"
        >
    </div>

    <!-- SMALL IMAGE -->
    <div class="col-md-4 d-flex align-items-center justify-content-center">
        <img
            src="{{ asset('assets/f_assets/image/Cleopatra 1 Ratio 1/Cleopatra Look 5/Cleopatra Look 5.avif') }}"
            class="img-fluid"
        >
    </div>
</div>
</section>
<section class="pt-5 pb-0 text-center">

    <div class="container">
        <div class="mx-auto" style="max-width: 520px;">

            <p style="font-size: 15px; line-height: 1.9; margin-bottom: 0;">
                An ode to contemporary beauty. Woven in sweeping gold, this necklace whispers secrets of the past with a discreet charm that's effortlessly modern.
            </p>

            <div class="cleopatra-appointment-spacing">
                <x-book-appointment />
            </div>

        </div>
    </div>

</section>

@include('public.partials.image-gallery-modal')

<script>
document.addEventListener('DOMContentLoaded', function () {
    for (let i = 1; i <= 4; i++) {
        const carouselElement = document.getElementById('cleopatraCarousel' + i);
        if (carouselElement) {
            new bootstrap.Carousel(carouselElement, {
                interval: false,
                wrap: true,
                touch: true
            });
        }
    }
});
</script>
@endsection
