@extends('public.layouts.header_new')

@section('content')

@php
    $bannerUrl = $subcategory->banner_url ?? null;
    $bannerIsVideo = $bannerUrl && Str::endsWith(strtolower($bannerUrl), ['.mp4', '.webm', '.ogg']);
    $bannerAlt = ($subcategory->name ?? 'Navratan collection') . ' banner';
    $mobileBannerUrl = 'assets/f_assets/image/Navratan Banner Mob View.mp4';
    $navratanCopy = "A heritage bridal jewellery collection as timeless as the art of jewellery making itself, traditionally crafted with 'Nau Ratans', or 'Nine Gems'.";
    $appointmentUrl = 'https://api.whatsapp.com/send?phone=923070222666&text=' . rawurlencode('Hello Hanif Jewellers, I would like to book an appointment.');

    $campaignBanners = [
        ['desktop' => 'assets/f_assets/image/Navratan/desktop3.png', 'mobile' => 'assets/f_assets/image/Navratan/mob3.png', 'show_copy' => true],
        ['desktop' => 'assets/f_assets/image/Navratan/desktop1.png', 'mobile' => 'assets/f_assets/image/Navratan/mob1.png', 'show_copy' => false],
        ['desktop' => 'assets/f_assets/image/Navratan/desktop2.png', 'mobile' => 'assets/f_assets/image/Navratan/mob2.png', 'show_copy' => false],
    ];
@endphp

@if($bannerUrl)
    <section class="navratan-hero d-none d-md-block" aria-label="Navratan desktop banner">
        @if($bannerIsVideo)
            <video autoplay loop muted playsinline preload="metadata">
                <source src="{{ asset($bannerUrl) }}" type="video/{{ strtolower(pathinfo($bannerUrl, PATHINFO_EXTENSION)) }}">
                Your browser does not support the video tag.
            </video>
        @else
            <img src="{{ asset($bannerUrl) }}" alt="{{ $bannerAlt }}">
        @endif
    </section>

    <section class="navratan-hero d-md-none" aria-label="Navratan mobile banner">
        <video autoplay loop muted playsinline preload="metadata">
            <source src="{{ asset($mobileBannerUrl) }}" type="video/mp4">
            Your browser does not support the video tag.
        </video>
    </section>
@endif

<section class="navratan-campaign" aria-label="Navratan campaign">
    @foreach($campaignBanners as $index => $banner)
        <div class="navratan-campaign__slide">
            <picture>
                <source media="(max-width: 991.98px)" srcset="{{ asset($banner['mobile']) }}">
                <img
                    class="navratan-campaign__image"
                    src="{{ asset($banner['desktop']) }}"
                    alt="Navratan campaign banner {{ $index + 1 }}"
                    loading="{{ $index === 0 ? 'eager' : 'lazy' }}"
                    decoding="async"
                >
            </picture>

            @if($banner['show_copy'])
                <div class="navratan-campaign__panel d-none d-lg-flex">
                    <h2 class="navratan-campaign__title">NAVRATAN</h2>
                    <p class="navratan-campaign__copy">{{ $navratanCopy }}</p>
                    <a class="navratan-campaign__button" href="{{ $appointmentUrl }}" target="_blank" rel="noopener noreferrer">BOOK AN APPOINTMENT</a>
                </div>

                <div class="navratan-campaign__mobile-panel d-lg-none">
                    <h2 class="navratan-campaign__title">NAVRATAN</h2>
                    <p class="navratan-campaign__copy">{{ $navratanCopy }}</p>
                    <a class="navratan-campaign__button" href="{{ $appointmentUrl }}" target="_blank" rel="noopener noreferrer">BOOK AN APPOINTMENT</a>
                </div>
            @endif
        </div>
    @endforeach
</section>

<style>
html, body{
    margin: 0;
    padding: 0;
}

/* remove extra white space from header */
header,
.main-header,
.navbar,
.header-wrapper,
.top-header{
    margin: 0 !important;
    padding-top: 0 !important;
    padding-bottom: 0 !important;
}

/* remove container spacing */
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

.navratan-campaign{
    width: 100vw;
    margin-left: calc(50% - 50vw);
    margin-right: calc(50% - 50vw);
    overflow: hidden;
    background: #000;
}

.navratan-hero{
    width: 100vw;
    margin-left: calc(50% - 50vw);
    margin-right: calc(50% - 50vw);
    overflow: hidden;
    background: #000;
}

.navratan-hero img,
.navratan-hero video{
    display: block;
    width: 100%;
    height: auto;
    object-fit: contain;
}

.navratan-campaign__slide{
    position: relative;
}

.navratan-campaign__image{
    display: block;
    width: 100%;
}

.navratan-campaign__image{
    height: auto;
}

.navratan-campaign__panel{
    position: absolute;
    left: clamp(20px, 5vw, 96px);
    bottom: clamp(28px, 5vw, 96px);
    z-index: 2;
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    width: clamp(320px, 32vw, 520px);
    max-width: calc(100% - 40px);
    color: #fff;
    font-family: 'Poppins', sans-serif;
    text-align: left;
    text-shadow: 0 1px 8px rgba(0, 0, 0, .55);
}

.navratan-campaign__title{
    margin: 0;
    color: inherit;
    font-family: 'Poppins', sans-serif;
    font-size: clamp(20px, 1.6vw, 26px);
    font-weight: 500;
    letter-spacing: .18em;
    line-height: 1.2;
}

.navratan-campaign__copy{
    width: 100%;
    max-width: 40em;
    margin: 10px 0 18px;
    color: inherit;
    font-family: 'Poppins', sans-serif;
    font-size: clamp(12px, .78vw, 14px);
    font-weight: 400;
    letter-spacing: .02em;
    line-height: 1.7;
}

.navratan-campaign__button{
    display: inline-block;
    padding: clamp(10px, .72vw, 13px) clamp(16px, 1.4vw, 26px);
    background: #fff;
    color: #111;
    font-family: 'Poppins', sans-serif;
    font-size: clamp(10px, .58vw, 11px);
    letter-spacing: .16em;
    line-height: 1.4;
    text-decoration: none;
    text-shadow: none;
    text-transform: uppercase;
}

.navratan-campaign__button:hover,
.navratan-campaign__button:focus{
    background: #e7e7e7;
    color: #111;
}

.navratan-campaign__mobile-panel{
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    width: 100%;
    box-sizing: border-box;
    padding: 32px 24px 36px;
    background: #fff;
    color: #111;
    font-family: 'Poppins', sans-serif;
    text-align: center;
}

.navratan-campaign__mobile-panel .navratan-campaign__copy{
    max-width: 34em;
    margin: 12px auto 20px;
    font-size: 13px;
}

.navratan-campaign__mobile-panel .navratan-campaign__button{
    background: #111;
    color: #fff;
}
</style>
    <section>
        <div class="container pt-4 pt-md-5 pb-0">
            <div class="row g-3 justify-content-center">
                <div class="col-md-4 ">
                    @php
                        $navratanLook4 = [];
                        for ($i = 1; $i <= 4; $i++) {
                            $navratanLook4[] = [
                                'src' => asset('assets/f_assets/image/Navratan/Sadia faisal/' . $i . '.jpg'),
                                'alt' => 'navratan-4-' . $i,
                            ];
                        }
                    @endphp
                    @include('public.partials.carousel', [
                        'id' => 'navratanCarousel-5',
                        'images' => $navratanLook4,
                    ])
                </div>

                <div class="col-md-4">
                    @php
                        $navratanBlueImages = [];
                        for ($i = 1; $i <= 4; $i++) {
                            $navratanBlueImages[] = [
                                'src' => asset('assets/f_assets/image/Navratan/Navratan Blue/' . $i . '.png'),
                                'alt' => 'navratan-blue-' . $i,
                            ];
                        }
                    @endphp
                    @include('public.partials.carousel', [
                        'id' => 'navratanCarousel-3',
                        'images' => $navratanBlueImages,
                    ])
                </div>
                <div class="col-md-4">
                    @php
                        $navratanLook5 = [];
                        for ($i = 1; $i <= 4; $i++) {
                            $navratanLook5[] = [
                                'src' => asset('assets/f_assets/image/Navratan/Pink/' . $i . '.png'),
                                'alt' => 'navratan-5-' . $i,
                            ];
                        }
                    @endphp
                    @include('public.partials.carousel', [
                        'id' => 'navratanCarousel-6',
                        'images' => $navratanLook5,
                    ])
                </div>

            </div>
            <div class="row">
            <style>
                    .app-btn {
                        padding: 6px 16px !important;
                    }
                    .navratan-appointment-btn {
                        margin: 3.5rem 0 !important;
                    }
            </style>
            <div class="text-center">
                <x-book-appointment class="navratan-appointment-btn" />
            </div>
            <!-- <div class="col-md-6 text-center">
                <x-shop-now :href="route('subcategory', ['subcategory' => 'gohar'])" class="m-5 btn border btn-outline-dark px-5 py-2" style="padding: 10px 100px !important" />
            </div> -->
        </div>

            @include('public.partials.image-gallery-modal')

            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    for (let i = 2; i <= 6; i++) {
                        const el = document.getElementById('navratanCarousel-' + i);
                        if (el) new bootstrap.Carousel(el, { interval: false, wrap: true, touch: true });
                    }
                });
            </script>
        </div>
    </section>
@endsection
