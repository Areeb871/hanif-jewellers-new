@extends('public.layouts.header_latest')

@section('content')
<style>
html, body{
    margin: 0;
    padding: 0;
}

/* =========================
   REMOVE HEADER SPACING
========================= */
header,
.main-header,
.navbar,
.header-wrapper,
.top-header {
    margin: 0 !important;
    padding-top: 0 !important;
    padding-bottom: 0 !important;
}

header .container,
header .row,
header .col,
.navbar .container,
.navbar .row {
    margin-top: 0 !important;
    margin-bottom: 0 !important;
    padding-top: 0 !important;
    padding-bottom: 0 !important;
}

/* =========================
   BANNER (RESPONSIVE - NO CROP)
========================= */
.sectionOne,
.sectionMobile{
    position: relative;
    width: 100%;
    height: auto; /* 👈 responsive height */
    overflow: hidden;
    margin: 0 !important;
    padding: 0 !important;
}

/* VIDEO */
.sectionOne video,
.sectionMobile video{
    width: 100%;
    height: auto;          /* 👈 SHRINK WITH SCREEN */
    display: block;
    object-fit: contain;   /* 👈 NO CROP */
}

/* remove unwanted gaps */
.sectionOne,
.sectionMobile,
section{
    margin-top: 0 !important;
}
</style>

<!-- =========================
     DESKTOP BANNER
========================= -->
<section class="sectionOne d-md-block d-none">
    <video autoplay loop muted playsinline>
        <source src="{{ asset('assets/f_assets/image/Gehwana/gehnawa.mp4') }}" type="video/mp4">
        Your browser does not support the video tag.
    </video>
</section>

<!-- =========================
     MOBILE BANNER
========================= -->
<section class="sectionMobile d-md-none">
    <video autoplay loop muted playsinline>
        <source src="{{ asset('assets/f_assets/image/Gehwana/Gehnawa Banner Mob View.mp4') }}" type="video/mp4">
        Your browser does not support the video tag.
    </video>
</section>
<style>
    .mt-3 {
        margin-top: 1rem !important;
    }
</style>
    <section>
        <div class="container py-5">
            <div class="text-center my-4">
                <h4 class="text-uppercase mb-2">Discover Our Collection</h4>
                <!-- <p class="mt-3" style="max-width: 780px; margin: 0 auto;">
                    Gehnawa fuses modern day bridals with their heritage jewels. Rooting from 'Gehna' (meaning
                    jewels) and 'Pehnawa' meaning 'clothes', Gehnawa is the latest essence table to be dressed
                    in gold, head to toe; which is every bridal's dream attire!
                </p> -->
            </div>

            <div class="row g-3 pt-4">
                <div class="col-md-6">
                    @php
                        $gehnawaImages1 = [];
                        for ($i = 1; $i <= 4; $i++) {
                            $gehnawaImages1[] = [
                                'src' => asset('assets/f_assets/image/Gehwana/Look 6/Gehwana ' . $i . '.jpg'),
                                'alt' => 'gehnawa-6-' . $i,
                            ];
                        }
                    @endphp
                    @include('public.partials.carousel', [
                        'id' => 'gehnawaCarousel-6',
                        'images' => $gehnawaImages1,
                    ])
                </div>
                <div class="col-md-6">
                    @php
                        $gehnawaImages3 = [];
                        for ($i = 1; $i <= 4; $i++) {
                            $gehnawaImages3[] = [
                                'src' => asset('assets/f_assets/image/Gehwana/Look 3/Gehwana ' . $i . '.jpg'),
                                'alt' => 'gehnawa-3-' . $i,
                            ];
                        }
                    @endphp
                    @include('public.partials.carousel', [
                        'id' => 'gehnawaCarousel-3',
                        'images' => $gehnawaImages3,
                    ])
                </div>
            </div>

            <div class="row g-3 pt-4 align-items-center">
                <div class="col-md-6">
                    @php
                        $gehnawaImages4 = [];
                        for ($i = 1; $i <= 4; $i++) {
                            $gehnawaImages4[] = [
                                'src' => asset('assets/f_assets/image/Gehwana/Look 4/Gehwana ' . $i . '.jpg'),
                                'alt' => 'gehnawa-4-' . $i,
                            ];
                        }
                    @endphp
                    @include('public.partials.carousel', [
                        'id' => 'gehnawaCarousel-4',
                        'images' => $gehnawaImages4,
                    ])
                </div>
                <div class="col-md-6 d-flex flex-column align-items-center text-center">
    <p>
        Gehnawa fuses modern day bridals with their heritage jewels. Rooting from 'Gehna' (meaning
        jewels) and 'Pehnawa' meaning 'clothes', Gehnawa is the latest essence table to be dressed
        in gold, head to toe; which is every bridal's dream attire!
    </p>

    <a class="btn border btn-outline-dark px-4 py-2 mt-3" href="{{ route('contact-us') }}">
        BOOK AN APPOINTMENT
    </a>
</div>
            </div>


            <div class="row g-3 pt-4">
                <div class="col-md-4">
                    @php
                        $gehnawaImages4 = [];
                        for ($i = 1; $i <= 4; $i++) {
                            $gehnawaImages4[] = [
                                'src' => asset('assets/f_assets/image/Gehwana/Look 2/Gehnawa-Look-2-' . $i . '.png'),
                                'alt' => 'gehnawa-2-' . $i,
                            ];
                        }
                    @endphp
                    @include('public.partials.carousel', [
                        'id' => 'gehnawaCarousel-2',
                        'images' => $gehnawaImages4,
                    ])
                </div>
                <div class="col-md-4">
                    @php
                        $gehnawaImages5 = [];
                        for ($i = 1; $i <= 4; $i++) {
                            $gehnawaImages5[] = [
                                'src' => asset('assets/f_assets/image/Gehwana/Look1/Gehwana ' . $i . '.jpg'),
                                'alt' => 'gehnawa-1-' . $i,
                            ];
                        }
                    @endphp
                    @include('public.partials.carousel', [
                        'id' => 'gehnawaCarousel-1',
                        'images' => $gehnawaImages5,
                    ])
                </div>
                <div class="col-md-4">
                    @php
                        $gehnawaImages6 = [];
                        for ($i = 1; $i <= 4; $i++) {
                            $gehnawaImages6[] = [
                                'src' => asset('assets/f_assets/image/Gehwana/Look 5/' . $i . '.jpg'),
                                'alt' => 'gehnawa-5-' . $i,
                            ];
                        }
                    @endphp
                    @include('public.partials.carousel', [
                        'id' => 'gehnawaCarousel-5',
                        'images' => $gehnawaImages6,
                    ])
                </div>
            </div>
            <!-- <div class="row g-3 pt-3">
                <div class="col-md-4">
                    @php
                        $gehnawaImages7 = [];
                        for ($i = 0; $i < 3; $i++) {
                            $gehnawaImages7[] = [
                                'src' => asset('assets/f_assets/image/Hasht_Rubies_Rose_Gold_Pendant_1500X2100.jpg'),
                                'alt' => 'gehnawa-7-' . ($i+1),
                            ];
                        }
                    @endphp
                    @include('public.partials.carousel', [
                        'id' => 'gehnawaCarousel-7',
                        'images' => $gehnawaImages7,
                    ])
                </div>
                <div class="col-md-4">
                    @php
                        $gehnawaImages8 = [];
                        for ($i = 0; $i < 3; $i++) {
                            $gehnawaImages8[] = [
                                'src' => asset('assets/f_assets/image/Hasht_Rubies_Rose_Gold_Pendant_1500X2100.jpg'),
                                'alt' => 'gehnawa-8-' . ($i+1),
                            ];
                        }
                    @endphp
                    @include('public.partials.carousel', [
                        'id' => 'gehnawaCarousel-8',
                        'images' => $gehnawaImages8,
                    ])
                </div>
                 <div class="col-md-4">
                    @php
                        $gehnawaImages9 = [];
                        for ($i = 0; $i < 3; $i++) {
                            $gehnawaImages9[] = [
                                'src' => asset('assets/f_assets/image/Hasht_Rubies_Rose_Gold_Pendant_1500X2100.jpg'),
                                'alt' => 'gehnawa-9-' . ($i+1),
                            ];
                        }
                    @endphp
                    @include('public.partials.carousel', [
                        'id' => 'gehnawaCarousel-9',
                        'images' => $gehnawaImages9,
                    ])
                </div> -->
            </div>

            @include('public.partials.image-gallery-modal')

            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    // Initialize all Gehnawa carousels (1..9)
                    for (let i = 1; i <= 9; i++) {
                        const el = document.getElementById('gehnawaCarousel-' + i);
                        if (el) new bootstrap.Carousel(el, { interval: false, wrap: true, touch: true });
                    }
                });
            </script>
        </div>
    </section>
@endsection
