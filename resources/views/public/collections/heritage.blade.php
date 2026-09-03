@extends('public.layouts.header_new')

@section('content')
@php
    $desktopBanner = $subcategory->banner_url ?? null;
    $isDesktopVideo = $desktopBanner
        ? \Illuminate\Support\Str::endsWith(strtolower($desktopBanner), ['.mp4', '.webm', '.ogg'])
        : false;
    $mobileBanner = 'assets/f_assets/image/heritage_mobile.mp4';
    $heritageCopy = "An ode to contemporary beauty. Woven in sweeping gold, this necklace whispers secrets of the past with a discreet charm that's effortlessly modern.";
@endphp

@if($desktopBanner)
    <section class="heritage-hero d-none d-md-block" aria-label="Heritage desktop banner">
        @if($isDesktopVideo)
            <video autoplay loop muted playsinline preload="metadata">
                <source src="{{ asset($desktopBanner) }}" type="video/{{ strtolower(pathinfo($desktopBanner, PATHINFO_EXTENSION)) }}">
                Your browser does not support the video tag.
            </video>
        @else
            <img src="{{ asset($desktopBanner) }}" alt="{{ $subcategory->name ?? 'Heritage' }} banner">
        @endif
    </section>
@endif

<section class="heritage-hero d-md-none" aria-label="Heritage mobile banner">
    <video autoplay loop muted playsinline preload="metadata">
        <source src="{{ asset($mobileBanner) }}" type="video/mp4">
        Your browser does not support the video tag.
    </video>
</section>

<section class="heritage-campaign" aria-label="Heritage campaign">
    @foreach(range(1, 3) as $index)
        <div class="heritage-campaign__banner">
            <img class="heritage-campaign__image heritage-campaign__image--desktop"
                 src="{{ asset('assets/f_assets/image/heritage/desktop' . $index . '.png') }}"
                 alt="Heritage campaign banner {{ $index }}"
                 loading="{{ $index === 1 ? 'eager' : 'lazy' }}" decoding="async">
            <img class="heritage-campaign__image heritage-campaign__image--mobile"
                 src="{{ asset('assets/f_assets/image/heritage/mob' . $index . '.png') }}"
                 alt="Heritage mobile campaign banner {{ $index }}"
                 loading="{{ $index === 1 ? 'eager' : 'lazy' }}" decoding="async">

            @if($index === 1)
                <div class="heritage-campaign__content d-none d-md-flex">
                    <h2 class="heritage-campaign__title">HERITAGE</h2>
                    <p class="heritage-campaign__copy">{{ $heritageCopy }}</p>
                    <x-book-appointment class="heritage-campaign__button" />
                </div>
                <div class="heritage-campaign__mobile-content d-md-none">
                    <h2 class="heritage-campaign__mobile-title">HERITAGE</h2>
                    <p class="heritage-campaign__mobile-copy">{{ $heritageCopy }}</p>
                    <x-book-appointment />
                </div>
            @endif
        </div>
    @endforeach
</section>

@if($products->isNotEmpty())
<section class="heritage-looks" aria-label="Heritage products">
    <div class="swiper heritage-looks-slider">
        <div class="swiper-wrapper heritage-collection-grid">
            @foreach($products as $product)
                <div class="swiper-slide">
                    @include('public.partials.simple-card', [
                        'product' => $product,
                        'storeContext' => true,
                        'hideDetails' => true,
                    ])
                </div>
            @endforeach
        </div>
        <button class="swiper-button-prev heritage-looks-slider__prev" type="button" aria-label="Previous Heritage looks"></button>
        <button class="swiper-button-next heritage-looks-slider__next" type="button" aria-label="Next Heritage looks"></button>
    </div>

    <div class="heritage-appointment text-center">
        <x-book-appointment />
    </div>
</section>
@endif

<style>
html, body{margin:0;padding:0}
.heritage-hero,.heritage-campaign{width:100%;overflow:hidden}
.heritage-hero,.heritage-campaign,.heritage-campaign__banner{margin:0;padding:0}
.heritage-hero img,.heritage-hero video,.heritage-campaign__image{display:block;width:100%;height:auto}
.heritage-campaign{margin-bottom:34px}
.heritage-campaign__banner{position:relative}
.heritage-campaign__image--desktop{display:none}
.heritage-campaign__image--mobile{display:block}
.heritage-campaign__content{position:absolute;top:50%;left:auto;right:clamp(20px,3.65vw,70px);width:clamp(340px,34vw,560px);max-width:calc(100% - 40px);transform:translateY(-50%);flex-direction:column;align-items:flex-start;box-sizing:border-box;padding:clamp(24px,3vw,48px);background:#d8bca5;color:#111;font-family:"Poppins",sans-serif;text-align:left}
.heritage-campaign__title,.heritage-campaign__mobile-title{font-family:"Poppins",sans-serif;font-weight:500;letter-spacing:.18em}
.heritage-campaign__title{margin:0;font-size:clamp(20px,1.6vw,26px);line-height:1.2}
.heritage-campaign__copy{width:100%;max-width:40em;margin:10px 0 18px;font-family:"Poppins",sans-serif;font-size:clamp(12px,.78vw,14px);font-weight:400;letter-spacing:.02em;line-height:1.7;text-align:left}
.heritage-campaign__button{margin:0!important;padding:clamp(10px,.72vw,13px) clamp(16px,1.4vw,26px)!important;border:1px solid #000!important;background:#000!important;color:#fff!important;font-size:clamp(10px,.58vw,11px)!important;letter-spacing:.16em!important;line-height:1.4!important}
.heritage-campaign__button:hover,.heritage-campaign__button:focus{background:#222!important;color:#fff!important}
.heritage-campaign__mobile-content{padding:32px 24px 38px;background:#fff;color:#111;text-align:center}
.heritage-campaign__mobile-title{margin:0 0 14px;font-size:22px}
.heritage-campaign__mobile-copy{max-width:36em;margin:0 auto 22px;font-family:"Poppins",sans-serif;font-size:13px;font-weight:400;line-height:1.7}
.heritage-looks{width:100%;overflow:hidden}
.heritage-looks-slider{width:100%;overflow:hidden}
.heritage-looks-slider .swiper-slide{height:auto;min-width:0}
.heritage-looks-slider__prev,.heritage-looks-slider__next{width:44px;height:44px;margin-top:0;top:calc(50% - 22px);transform:translateY(-50%);z-index:9999;border:0;border-radius:50%;background:#fff;color:#000;box-shadow:0 6px 18px rgba(0,0,0,.12);display:flex;align-items:center;justify-content:center;pointer-events:auto}
.heritage-looks-slider__prev{left:10px}
.heritage-looks-slider__next{right:10px}
.heritage-looks-slider__prev::after,.heritage-looks-slider__next::after{color:#000;font-size:16px;font-weight:700}
.heritage-looks-slider__prev:hover,.heritage-looks-slider__next:hover{background:#f8f8f8}
.heritage-looks-slider__prev.swiper-button-disabled,.heritage-looks-slider__next.swiper-button-disabled{opacity:.35;cursor:not-allowed;pointer-events:none!important}
.heritage-looks-slider__prev::before,.heritage-looks-slider__next::before{content:"";position:absolute;inset:-12px}
.heritage-appointment{padding:3.5rem 20px}
@media(min-width:768px){.heritage-campaign__image--desktop{display:block}.heritage-campaign__image--mobile{display:none}}
@media(max-width:575.98px){.heritage-looks-slider__prev,.heritage-looks-slider__next{display:none}}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const looksSlider = document.querySelector('.heritage-looks-slider');
    if (looksSlider && typeof Swiper !== 'undefined') {
        new Swiper(looksSlider, {
            loop:false,
            grabCursor:true,
            watchOverflow:true,
            observer:true,
            observeParents:true,
            navigation:{
                nextEl:looksSlider.querySelector('.heritage-looks-slider__next'),
                prevEl:looksSlider.querySelector('.heritage-looks-slider__prev')
            },
            breakpoints:{
                0:{slidesPerView:1,spaceBetween:8},
                576:{slidesPerView:2,spaceBetween:10},
                768:{slidesPerView:3,spaceBetween:12},
                1200:{slidesPerView:4,spaceBetween:12}
            }
        });
    }
});
</script>
@endsection
