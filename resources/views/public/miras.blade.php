@extends('public.layouts.header_new')

@section('content')
@php
    $desktopBanner = $subcategory->banner_url ?? 'assets/f_assets/image/miras/miras_desktop.mp4';
    $mobileBanner = 'assets/f_assets/image/miras/miras_mob.webm';
    $isDesktopVideo = \Illuminate\Support\Str::endsWith(strtolower($desktopBanner), ['.mp4', '.webm', '.ogg']);
    $desktopBannerSrc = filter_var($desktopBanner, FILTER_VALIDATE_URL) ? $desktopBanner : asset($desktopBanner);
    $stories = [
        ['name' => 'Miras | ميراث - Inherited Faith', 'image' => 'assets/f_assets/image/miras/desktop2.jpg', 'mobile_image' => 'assets/f_assets/image/miras/mobile2.jpg', 'copy' => [
           'Some things are not bought, they are inherited. Miras is a fine example of cultural art. Jewellery that carries the weight of what came before and the promise of what comes after. Crafted entirely in gold, built to move through hands and hearts for generations.',
        ], 'side' => 'left'],
        ['name' => '', 'image' => 'assets/f_assets/image/miras/desktop1.jpg', 'mobile_image' => 'assets/f_assets/image/miras/mobile1.jpg', 'copy' => '', 'side' => 'left'],
    ];
@endphp

<style>
.hasht-full-bleed{width:100vw;margin-left:calc(50% - 50vw);margin-right:calc(50% - 50vw);overflow:hidden}
.hasht-intro-media{width:100%;height:auto;display:block}
.hasht-story{position:relative;aspect-ratio:16/9;background:#eee}
.hasht-story__image{position:absolute;inset:0;width:100%;height:100%;object-fit:cover;display:block}
.hasht-story__panel{position:absolute;left:clamp(20px,3.65vw,70px);bottom:clamp(20px,4.7vw,90px);z-index:2;display:flex;flex-direction:column;align-items:flex-start;width:clamp(340px,34vw,560px);max-width:calc(100% - 40px);box-sizing:border-box;padding:0;background:transparent;font-family:'Poppins',sans-serif;text-align:left}
.hasht-story__panel--right{right:clamp(20px,3.65vw,70px);left:auto}
.hasht-story__title,.hasht-mobile__title{margin:0;color:white;font-family:'Poppins',sans-serif;font-size:clamp(20px,1.6vw,26px);font-weight:500;letter-spacing:.18em;line-height:1.2;text-wrap:balance}
.hasht-story__copy-wrap{display:flex;flex-direction:column;gap:10px;width:100%;max-width:min(100%,42em);margin:10px 0 18px}
.hasht-story__copy{margin:0;width:100%;max-width:40em;color:white;font-size:clamp(12px,.78vw,14px);font-weight:400;letter-spacing:.02em;line-height:1.7}
.hasht-story__button,.hasht-mobile__button{display:inline-block;padding:clamp(10px,.72vw,13px) clamp(16px,1.4vw,26px);background:#111;color:#fff;font-size:clamp(10px,.58vw,11px);letter-spacing:.16em;line-height:1.4;text-decoration:none;text-transform:uppercase}
.hasht-story__button:hover,.hasht-mobile__button:hover{background:#2b2b2b;color:#fff}
.hasht-manifesto{padding:48px 20px;text-align:center;font-size:15px;line-height:1.8}
.hasht-manifesto span{display:block}
.hasht-mobile{background:#fff;text-align:center}
.hasht-mobile__image{width:100%;height:auto;display:block}
.hasht-mobile__content{display:flex;flex-direction:column;align-items:center;justify-content:center;width:100%;box-sizing:border-box;padding:32px 24px 36px;font-family:'Poppins',sans-serif;text-align:center}
.hasht-mobile__title{display:block;width:100%;margin:0;color:#111;font-size:22px;letter-spacing:.18em;line-height:1.2;text-align:center}
.hasht-mobile__copy-wrap{display:flex;flex-direction:column;align-items:center;gap:10px;width:100%;max-width:34em;margin:12px auto 20px;text-align:center}
.hasht-mobile__copy{display:block;width:100%;margin:0;color:#222;font-family:'Poppins',sans-serif;font-size:13px;font-weight:400;letter-spacing:.02em;line-height:1.7;text-align:center}
.hasht-mobile__button{display:inline-block;width:auto;margin:0 auto;font-family:'Poppins',sans-serif;text-align:center}
.hasht-products{position:relative;width:100%;overflow:hidden}
.miras-products__title{margin:0;padding:48px 20px 0;color:#111;font-family:'Poppins',sans-serif;font-size:clamp(22px,2vw,32px);font-weight:500;letter-spacing:.18em;line-height:1.3;text-align:center}
.hasht-products .productSwiper{width:100%;padding:40px 0;overflow:hidden;touch-action:pan-y}
.hasht-products .swiper-slide{height:auto;min-width:0}
.hasht-products .swiper-button-next,.hasht-products .swiper-button-prev{width:44px;height:44px;border-radius:50%;background:#fff;box-shadow:0 6px 18px rgba(0,0,0,.12);color:#000}
.hasht-products .swiper-button-next::after,.hasht-products .swiper-button-prev::after{font-size:16px;font-weight:700}
.hasht-products .swiper-pagination{display:none}
@media(max-width:575px){.miras-products__title{padding-top:36px;font-size:20px}.hasht-products .productSwiper{padding:32px 8px 42px}.hasht-products .swiper-button-next,.hasht-products .swiper-button-prev{display:none}.hasht-products .swiper-pagination{display:flex;bottom:10px;justify-content:center}}
</style>

<section class="hasht-full-bleed d-none d-md-block">
    @if($isDesktopVideo)
        <video class="hasht-intro-media" autoplay loop muted playsinline preload="metadata">
            <source src="{{ $desktopBannerSrc }}" type="video/{{ strtolower(pathinfo($desktopBanner, PATHINFO_EXTENSION)) }}">
        </video>
    @else
        <img class="hasht-intro-media" src="{{ $desktopBannerSrc }}" alt="Hasht collection">
    @endif
</section>

<section class="hasht-full-bleed d-md-none">
    <video class="hasht-intro-media" autoplay loop muted playsinline preload="metadata">
        <source src="{{ asset($mobileBanner) }}" type="video/webm">
    </video>
</section>

@foreach($stories as $index => $story)
    <section class="hasht-full-bleed hasht-story d-none d-lg-block">
        <img class="hasht-story__image" src="{{ asset($story['image']) }}" alt="Hasht {{ ucfirst(strtolower($story['name'])) }} pendant" loading="{{ $index === 0 ? 'eager' : 'lazy' }}">
        @if($index === 0)
            <div class="hasht-story__panel {{ $story['side'] === 'right' ? 'hasht-story__panel--right' : '' }}">
                <h2 class="hasht-story__title">{{ $story['name'] }}</h2>
                <div class="hasht-story__copy-wrap">
                    @foreach((array) $story['copy'] as $paragraph)
                        <p class="hasht-story__copy">{{ $paragraph }}</p>
                    @endforeach
                </div>
                <a class="hasht-story__button" href="https://api.whatsapp.com/send?phone=923070222666&text={{ rawurlencode('Hello Hanif Jewellers, I would like to book an appointment.') }}" target="_blank" rel="noopener noreferrer">BOOK AN APPOINTMENT</a>
            </div>
        @endif
    </section>
@endforeach

@foreach($stories as $index => $story)
    <section class="hasht-full-bleed hasht-mobile d-lg-none">
        <img class="hasht-mobile__image" src="{{ asset($story['mobile_image']) }}" alt="Hasht {{ ucfirst(strtolower($story['name'])) }} pendant" loading="{{ $index === 0 ? 'eager' : 'lazy' }}">
        @if($index === 0)
            <div class="hasht-mobile__content">
                <h2 class="hasht-mobile__title">HASHT {{ $story['name'] }}</h2>
                <div class="hasht-mobile__copy-wrap">
                    @foreach((array) $story['copy'] as $paragraph)
                        <p class="hasht-mobile__copy">{{ $paragraph }}</p>
                    @endforeach
                </div>
                <a class="hasht-mobile__button" href="https://api.whatsapp.com/send?phone=923070222666&text={{ rawurlencode('Hello Hanif Jewellers, I would like to book an appointment.') }}" target="_blank" rel="noopener noreferrer">BOOK AN APPOINTMENT</a>
            </div>
        @endif
    </section>
@endforeach
@if($products->isNotEmpty())
{{-- SWIPER PRODUCT SLIDER (Desktop + Mobile) --}}
<section class="onlineStore">
    <!-- <h2 class="miras-products__title">MIRAS JEWELLERY</h2> -->
    <div class="swiper productSwiper">
        <div class="swiper-wrapper">
            @foreach ($products as $product)
                <div class="swiper-slide">
                    @include('public.partials.simple-card', [
                        'product' => $product,
                        'storeContext' => true,
                    ])
                </div>
            @endforeach
        </div>

        {{-- Navigation arrows --}}
        <div class="swiper-button-prev"></div>
        <div class="swiper-button-next"></div>

        {{-- Mobile swipe indicator --}}
        <div class="swiper-pagination"></div>
    </div>
</section>

<style>
/* FIX: you missed the dot before .onlineStore */
.onlineStore{
    position: relative;
    width: 100%;
    max-width: 100%;
    overflow: hidden;
}

.onlineStore .hjPagination{
    display: none !important;
}

.productSwiper{
    position: relative;
    padding: 40px 0 40px;
    width: 100%;
    max-width: 100%;
    overflow: hidden !important;
    touch-action: pan-y;
}

.productSwiper .swiper-slide{
    height: auto;
    min-width: 0;
}

.productSwiper > .swiper-pagination{
    display: none;
}

/* =========================
   NAVIGATION ARROWS
========================= */
.productSwiper .swiper-button-next,
.productSwiper .swiper-button-prev{
    width: 44px;
    height: 44px;
    background: #fff;
    border-radius: 50%;
    box-shadow: 0 6px 18px rgba(0,0,0,0.12);
    display: flex;
    align-items: center;
    justify-content: center;
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    z-index: 9999;
    pointer-events: auto;
}

/* Arrow icons */
.productSwiper .swiper-button-next::after,
.productSwiper .swiper-button-prev::after{
    font-size: 16px;
    font-weight: 700;
    color: #000;
}

/* Positions */
.productSwiper .swiper-button-prev{ left: 10px; }
.productSwiper .swiper-button-next{ right: 10px; }

/* Hover */
.productSwiper .swiper-button-next:hover,
.productSwiper .swiper-button-prev:hover{
    background: #f8f8f8;
}

/* =========================
   DISABLED STATE
========================= */
.productSwiper .swiper-button-next.swiper-button-disabled,
.productSwiper .swiper-button-prev.swiper-button-disabled{
    opacity: 0.35;
    cursor: not-allowed;
    pointer-events: none !important;
}

/* CLICK SHIELD */
.productSwiper .swiper-button-next::before,
.productSwiper .swiper-button-prev::before{
    content: "";
    position: absolute;
    inset: -12px;
}

/* PRODUCT CARD SAFETY */
.productSwiper .swiper-slide a{
    position: relative;
    z-index: 1;
}

/* =========================
   MOBILE: OPTIONAL (keep or remove)
   If you want arrows on tablet but not mobile
========================= */
@media (max-width: 575px){
    .productSwiper .swiper-button-next,
    .productSwiper .swiper-button-prev{
        display: none;
    }

    /* Optional: a little side padding so 1 slide looks nice */
    .productSwiper{
        padding-left: 8px;
        padding-right: 8px;
        padding-bottom: 34px;
    }

    .productSwiper > .swiper-pagination{
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 7px;
        bottom: 10px;
    }

    .productSwiper > .swiper-pagination .swiper-pagination-bullet{
        width: 6px;
        height: 6px;
        margin: 0 !important;
        background: #9a9a9a;
        opacity: .5;
        transition: width .2s ease, border-radius .2s ease, opacity .2s ease;
    }

    .productSwiper > .swiper-pagination .swiper-pagination-bullet-active{
        width: 24px;
        border-radius: 999px;
        background: #111;
        opacity: 1;
    }
}
</style>

<script>
document.querySelectorAll(".productSwiper").forEach((swiperEl) => {
    new Swiper(swiperEl, {
        loop: false,
        grabCursor: true,
        watchOverflow: true,
        observer: true,
        observeParents: true,

        // ✅ IMPORTANT: use breakpoints (your code was missing "breakpoints:")
        breakpoints: {
            // Mobile: 1 full image
            0: {
                slidesPerView: 1,
                spaceBetween: 8,
            },

            // Tablet: 2 images visible
            576: {
                slidesPerView: 2,
                spaceBetween: 10,
            },

            // Small desktop: 3 images (optional)
            768: {
                slidesPerView: 3,
                spaceBetween: 12,
            },

            // Desktop: 4 images
            1200: {
                slidesPerView: 4,
                spaceBetween: 12,
            },
        },

        // navigation scoped to this swiper
        navigation: {
            nextEl: swiperEl.querySelector(".swiper-button-next"),
            prevEl: swiperEl.querySelector(".swiper-button-prev"),
        },

        pagination: {
            el: swiperEl.querySelector(".swiper-pagination"),
            clickable: true,
        },
    });
});
</script>
@endif


@endsection
