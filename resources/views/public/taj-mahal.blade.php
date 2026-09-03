@extends('public.layouts.header_new')

@section('content')
@if(isset($subcategory) && $subcategory->banner_url && Str::endsWith($subcategory->banner_url, ['.mp4', '.webm', '.ogg']))

<!-- DESKTOP -->
<section class="sectionOne d-md-block d-none">
    <video autoplay loop muted playsinline>
        <source src="{{ asset($subcategory->banner_url) }}" type="video/{{ pathinfo($subcategory->banner_url, PATHINFO_EXTENSION) }}">
        Your browser does not support the video tag.
    </video>
</section>

<!-- MOBILE -->
@php
    $mobileVideo = 'assets/f_assets/image/Taj Mahal Mob banner.mp4';
@endphp

<section class="sectionMobile d-md-none">
    <video autoplay loop muted playsinline>
        <source src="{{ asset($mobileVideo) }}" type="video/mp4">
        Your browser does not support the video tag.
    </video>
</section>

@endif

<section class="taj-mahal-campaign" aria-label="Taj Mahal campaign">
    @foreach(range(1, 3) as $index)
        <div class="taj-mahal-campaign__banner">
            <img
                class="taj-mahal-campaign__image taj-mahal-campaign__image--desktop"
                src="{{ asset('assets/f_assets/image/Taj Mahal/desktop' . $index . '.png') }}"
                alt="Taj Mahal campaign banner {{ $index }}"
                loading="{{ $index === 1 ? 'eager' : 'lazy' }}"
                decoding="async"
            >
            <img
                class="taj-mahal-campaign__image taj-mahal-campaign__image--mobile"
                src="{{ asset('assets/f_assets/image/Taj Mahal/mob' . $index . '.png') }}"
                alt="Taj Mahal mobile campaign banner {{ $index }}"
                loading="{{ $index === 1 ? 'eager' : 'lazy' }}"
                decoding="async"
            >

            @if($index === 1)
                <div class="taj-mahal-campaign__content d-none d-md-flex">
                    <h2 class="taj-mahal-campaign__title">TAJ MAHAL</h2>
                    <p class="taj-mahal-campaign__copy">A Timeless Tradition of Magnificence with Modern Opulent Vibes. An Heirloom Jewels Collection from the House of Hanif, created with the perfect blend of Classic and Modern Aesthetics.</p>
                    <x-book-appointment class="taj-mahal-campaign__button" />
                </div>

                <div class="taj-mahal-campaign__mobile-content d-md-none">
                    <h2 class="taj-mahal-campaign__mobile-title">TAJ MAHAL</h2>
                    <p class="taj-mahal-campaign__mobile-copy">A Timeless Tradition of Magnificence with Modern Opulent Vibes. An Heirloom Jewels Collection from the House of Hanif, created with the perfect blend of Classic and Modern Aesthetics.</p>
                    <x-book-appointment />
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

/* responsive banner wrapper */
.sectionOne,
.sectionMobile{
    position: relative;
    width: 100%;
    height: auto;
    overflow: hidden;
    margin: 0 !important;
    padding: 0 !important;
}

/* responsive video - no crop */
.sectionOne video,
.sectionMobile video{
    width: 100%;
    height: auto;
    display: block;
    object-fit: contain;
    position: relative;
}

.taj-mahal-campaign{
    width: 100%;
    overflow: hidden;
    margin: 0 0 34px;
    padding: 0;
}

.taj-mahal-campaign__image{
    width: 100%;
}

.taj-mahal-campaign__image{
    height: auto;
}

.taj-mahal-campaign__image--desktop{
    display: none;
}

.taj-mahal-campaign__image--mobile{
    display: block;
}

@media (min-width: 768px){
    .taj-mahal-campaign__image--desktop{
        display: block;
    }

    .taj-mahal-campaign__image--mobile{
        display: none;
    }
}

.taj-mahal-campaign__banner{
    position: relative;
}

.taj-mahal-campaign__content{
    position: absolute;
    top: 50%;
    left: clamp(24px, 7vw, 140px);
    width: min(32vw, 470px);
    transform: translateY(-50%);
    flex-direction: column;
    align-items: flex-start;
    color: #111;
}

.taj-mahal-campaign__title{
    margin: 0 0 14px;
    font-family: "Poppins", sans-serif;
    font-size: clamp(22px, 2vw, 34px);
    font-weight: 500;
    letter-spacing: .18em;
}

.taj-mahal-campaign__copy{
    margin: 0 0 22px;
    font-family: "Poppins", sans-serif;
    font-size: clamp(12px, 1vw, 16px);
    font-weight: 400;
    line-height: 1.7;
}

.taj-mahal-campaign__button{
    margin: 0 !important;
}

.taj-mahal-campaign__mobile-content{
    padding: 32px 24px 38px;
    background: #fff;
    color: #111;
    text-align: center;
}

.taj-mahal-campaign__mobile-title{
    margin: 0 0 14px;
    font-family: "Poppins", sans-serif;
    font-size: 22px;
    font-weight: 500;
    letter-spacing: .18em;
}

.taj-mahal-campaign__mobile-copy{
    max-width: 36em;
    margin: 0 auto 22px;
    font-family: "Poppins", sans-serif;
    font-size: 13px;
    font-weight: 400;
    line-height: 1.7;
}

/* remove unwanted top gap */
.sectionOne,
.sectionMobile,
section{
    margin-top: 0 !important;
}
</style>
<style>
    .triangle-text{
text-align:center;
line-height:1.6;
font-size:20px;
font-weight:400;
}

.triangle-text span{
display:block;
margin:auto;
}

.triangle-text span:nth-child(1){width:100%;}
.triangle-text span:nth-child(2){width:85%;}
.triangle-text span:nth-child(3){width:70%;}
.triangle-text span:nth-child(4){width:55%;}
.triangle-text span:nth-child(5){width:70%;}
.triangle-text span:nth-child(6){width:85%;}
.triangle-text span:nth-child(7){width:100%;}

.taj-mahal-looks-slider{
    width: 100vw;
    margin-left: calc(50% - 50vw);
    margin-right: calc(50% - 50vw);
    overflow: hidden;
}

.taj-mahal-looks-slider .swiper-wrapper > .col-md-4{
    flex: 0 0 auto;
    padding: 0;
}

.taj-mahal-looks-slider__prev,
.taj-mahal-looks-slider__next{
    width: 44px;
    height: 44px;
    margin-top: 0;
    top: calc(50% - 22px);
    transform: translateY(-50%);
    z-index: 9999;
    border: 0;
    border-radius: 50%;
    background: #fff;
    color: #000;
    box-shadow: 0 6px 18px rgba(0, 0, 0, .12);
    display: flex;
    align-items: center;
    justify-content: center;
    pointer-events: auto;
}

.taj-mahal-looks-slider__prev{
    left: 10px;
}

.taj-mahal-looks-slider__next{
    right: 10px;
}

.taj-mahal-looks-slider__prev::after,
.taj-mahal-looks-slider__next::after{
    font-size: 16px;
    font-weight: 700;
    color: #000;
}

.taj-mahal-looks-slider__prev:hover,
.taj-mahal-looks-slider__next:hover{
    background: #f8f8f8;
}

.taj-mahal-looks-slider__prev.swiper-button-disabled,
.taj-mahal-looks-slider__next.swiper-button-disabled{
    opacity: .35;
    cursor: not-allowed;
    pointer-events: none !important;
}

.taj-mahal-looks-slider__prev::before,
.taj-mahal-looks-slider__next::before{
    content: "";
    position: absolute;
    inset: -12px;
}

@media (max-width: 575.98px){
    .taj-mahal-looks-slider__prev,
    .taj-mahal-looks-slider__next{
        display: none;
    }
}
</style>
<section>
        <div class="container pb-0">
             <div class="swiper taj-mahal-looks-slider">
             <div class="swiper-wrapper taj-mahal-collection-grid">
                <div class="col-md-4">
                @php
                       $navratanRedImages = [];
                        for ($i = 1; $i <= 2; $i++) {
                            $navratanRedImages[] = [
                                'src' => asset('assets/f_assets/image/Taj Mahal/11/' . $i . '.png'),
                                'alt' => 'taj-mahal-collection-' . $i,
                            ];
                        }
                    @endphp
                    @include('public.partials.carousel', [
                        'id' => 'tajMahalCarousel-11',
                        'images' => $navratanRedImages,
                    ])
                </div>
                <div class="col-md-4">
                    @php
                        $navratanBlueImages = [];
                        for ($i = 1; $i <= 2; $i++) {
                            $navratanBlueImages[] = [
                                'src' => asset('assets/f_assets/image/Taj Mahal/15/' . $i . '.png'),
                                'alt' => 'taj-mahal-collection-' . $i,
                            ];
                        }
                    @endphp
                    @include('public.partials.carousel', [
                        'id' => 'tajMahalCarousel-15',
                        'images' => $navratanBlueImages,
                    ])
                </div>
                <div class="col-md-4">
                    @php
                        $navratanLook3 = [];
                        for ($i = 1; $i <= 2; $i++) {
                            $navratanLook3[] = [
                                'src' => asset('assets/f_assets/image/Taj Mahal/16/' . $i . '.png'),
                                'alt' => 'taj-mahal-collection-' . $i,
                            ];
                        }
                    @endphp
                    @include('public.partials.carousel', [
                        'id' => 'tajMahalCarousel-16',
                        'images' => $navratanLook3,
                    ])
                </div>
                <div class="col-md-4">
                @php
                       $navratanRedImages = [];
                        for ($i = 1; $i <= 3; $i++) {
                            $navratanRedImages[] = [
                                'src' => asset('assets/f_assets/image/Taj Mahal/17/' . $i . '.png'),
                                'alt' => 'taj-mahal-collection-' . $i,
                            ];
                        }
                    @endphp
                    @include('public.partials.carousel', [
                        'id' => 'tajMahalCarousel-17',
                        'images' => $navratanRedImages,
                    ])
                </div>
                <div class="col-md-4">
                    @php
                        $navratanBlueImages = [];
                        for ($i = 1; $i <= 2; $i++) {
                            $navratanBlueImages[] = [
                                'src' => asset('assets/f_assets/image/Taj Mahal/18/' . $i . '.png'),
                                'alt' => 'taj-mahal-collection-' . $i,
                            ];
                        }
                    @endphp
                    @include('public.partials.carousel', [
                        'id' => 'tajMahalCarousel-18',
                        'images' => $navratanBlueImages,
                    ])
                </div>
                <div class="col-md-4">
                @php
                       $navratanRedImages = [];
                        for ($i = 1; $i <= 4; $i++) {
                            $navratanRedImages[] = [
                                'src' => asset('assets/f_assets/image/Taj Mahal/3/' . $i . '.jpg'),
                                'alt' => 'taj-mahal-collection-' . $i,
                            ];
                        }
                    @endphp
                    @include('public.partials.carousel', [
                        'id' => 'tajMahalCarousel-3',
                        'images' => $navratanRedImages,
                    ])
                </div>
                <div class="col-md-4">
                    @php
                        $navratanBlueImages = [];
                        for ($i = 1; $i <= 4; $i++) {
                            $navratanBlueImages[] = [
                                'src' => asset('assets/f_assets/image/Taj Mahal/4/' . $i . '.jpg'),
                                'alt' => 'taj-mahal-collection-' . $i,
                            ];
                        }
                    @endphp
                    @include('public.partials.carousel', [
                        'id' => 'tajMahalCarousel-4',
                        'images' => $navratanBlueImages,
                    ])
                </div>
                <div class="col-md-4">
                    @php
                        $navratanLook3 = [];
                        for ($i = 1; $i <= 4; $i++) {
                            $navratanLook3[] = [
                                'src' => asset('assets/f_assets/image/Taj Mahal/2/' . $i . '.jpg'),
                                'alt' => 'taj-mahal-collection-' . $i,
                            ];
                        }
                    @endphp
                    @include('public.partials.carousel', [
                        'id' => 'tajMahalCarousel-2',
                        'images' => $navratanLook3,
                    ])
                </div>
                <div class="col-md-4">
                    @php
                        $navratanLook4 = [];
                        for ($i = 1; $i <= 4; $i++) {
                            $navratanLook4[] = [
                                'src' => asset('assets/f_assets/image/Taj Mahal/5/' . $i . '.jpg'),
                                'alt' => 'taj-mahal-collection-' . $i,
                            ];
                        }
                    @endphp
                    @include('public.partials.carousel', [
                        'id' => 'tajMahalCarousel-5',
                        'images' => $navratanLook4,
                    ])
                </div>
                <div class="col-md-4">
                    @php
                        $navratanLook5 = [];
                        for ($i = 1; $i <= 4; $i++) {
                            $navratanLook5[] = [
                                'src' => asset('assets/f_assets/image/Taj Mahal/1/' . $i . '.jpg'),
                                'alt' => 'taj-mahal-collection-' . $i,
                            ];
                        }
                    @endphp
                    @include('public.partials.carousel', [
                        'id' => 'tajMahalCarousel-1',
                        'images' => $navratanLook5,
                    ])
                </div>
            </div>
                <button class="swiper-button-prev taj-mahal-looks-slider__prev" type="button" aria-label="Previous Taj Mahal looks"></button>
                <button class="swiper-button-next taj-mahal-looks-slider__next" type="button" aria-label="Next Taj Mahal looks"></button>
             </div>
            <div class="row">
            <style>
                    .app-btn {
                        padding: 6px 16px !important;
                    }
                    .taj-mahal-appointment-btn {
                        margin: 3.5rem 0 !important;
                    }
            </style>
            <div class="text-center">
                <x-book-appointment class="taj-mahal-appointment-btn" />
            </div>
            <!-- <div class="col-md-6 text-center">
                <x-shop-now :href="route('subcategory', ['subcategory' => 'gohar'])" class="m-5 btn border btn-outline-dark px-5 py-2" style="padding: 10px 100px !important" />
            </div> -->
        </div>

            @include('public.partials.image-gallery-modal')

            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    document.querySelectorAll('.taj-mahal-collection-grid .carousel').forEach(function(el) {
                        bootstrap.Carousel.getOrCreateInstance(el, {
                            interval: false,
                            wrap: true,
                            touch: false
                        });
                    });

                    const looksSlider = document.querySelector('.taj-mahal-looks-slider');

                    if (looksSlider && typeof Swiper !== 'undefined') {
                        looksSlider.querySelectorAll('.swiper-wrapper > .col-md-4').forEach(function(slide) {
                            slide.classList.add('swiper-slide');
                        });

                        new Swiper(looksSlider, {
                            loop: false,
                            grabCursor: true,
                            watchOverflow: true,
                            observer: true,
                            observeParents: true,
                            navigation: {
                                nextEl: looksSlider.querySelector('.taj-mahal-looks-slider__next'),
                                prevEl: looksSlider.querySelector('.taj-mahal-looks-slider__prev')
                            },
                            breakpoints: {
                                0: {
                                    slidesPerView: 1,
                                    spaceBetween: 8
                                },
                                576: {
                                    slidesPerView: 2,
                                    spaceBetween: 10
                                },
                                768: {
                                    slidesPerView: 3,
                                    spaceBetween: 12
                                },
                                1200: {
                                    slidesPerView: 4,
                                    spaceBetween: 12
                                }
                            }
                        });
                    }
                });
            </script>
        </div>
    </section>
@endsection


