@extends('public.layouts.header_new')

@section('content')
@php
    $desktopBanner = $subcategory->banner_url ?? 'assets/f_assets/image/Hasht Web/hasht_new_banner.mp4';
    $mobileBanner = 'assets/f_assets/image/Hasht Web/hasht_mobile_new.mp4';
    $isDesktopVideo = \Illuminate\Support\Str::endsWith(strtolower($desktopBanner), ['.mp4', '.webm', '.ogg']);
    $desktopBannerSrc = filter_var($desktopBanner, FILTER_VALIDATE_URL) ? $desktopBanner : asset($desktopBanner);
    $stories = [
        ['name' => 'SAPPHIRE', 'image' => 'assets/f_assets/image/Hasht Web/Banners/Hasht Saphire Desktop.jpg', 'mobile_image' => 'assets/f_assets/image/Hasht Web/Banners/Hasht Saphire Mob.jpg', 'copy' => [
            "A piece crafted by House of Hanif to signify Man's connection with the Creator.",
            'Embellished with the finest of His creations, the purest of precious metals and the rarest of stones to create an expression and an experience of pure' . "\u{00A0}" . 'art.',
        ], 'side' => 'left'],
        ['name' => 'EMERALD', 'image' => 'assets/f_assets/image/Hasht Web/Banners/Hasht Emerald Desktop.jpg', 'mobile_image' => 'assets/f_assets/image/Hasht Web/Banners/Hasht Emerald Mob.jpg', 'copy' => 'BESPOKE COLLECTION FROM THE HOUSE OF HANIF.', 'side' => 'left'],
        ['name' => 'RUBY', 'image' => 'assets/f_assets/image/Hasht Web/Banners/Hasht Ruby Desktop.jpg', 'mobile_image' => 'assets/f_assets/image/Hasht Web/Banners/Hast Ruby Mob.jpg', 'copy' => 'HASHT ہشت, literally meaning "Eight", an inspiration taken from the emerald cut and its 8 sides, the 8 doors of heaven, ultimate success and the fulfilment of dreams.', 'side' => 'right'],
    ];
@endphp

<style>
.hasht-full-bleed{width:100vw;margin-left:calc(50% - 50vw);margin-right:calc(50% - 50vw);overflow:hidden}
.hasht-intro-media{width:100%;height:auto;display:block}
.hasht-story{position:relative;aspect-ratio:16/9;background:#eee}
.hasht-story__image{position:absolute;inset:0;width:100%;height:100%;object-fit:cover;display:block}
.hasht-story__panel{position:absolute;left:clamp(20px,3.65vw,70px);bottom:clamp(20px,4.7vw,90px);z-index:2;display:flex;flex-direction:column;align-items:flex-start;width:clamp(340px,34vw,560px);max-width:calc(100% - 40px);box-sizing:border-box;padding:0;background:transparent;font-family:'Poppins',sans-serif;text-align:left}
.hasht-story__panel--right{right:clamp(20px,3.65vw,70px);left:auto}
.hasht-story__title,.hasht-mobile__title{margin:0;color:#111;font-family:'Poppins',sans-serif;font-size:clamp(20px,1.6vw,26px);font-weight:500;letter-spacing:.18em;line-height:1.2;text-wrap:balance}
.hasht-story__copy-wrap{display:flex;flex-direction:column;gap:10px;width:100%;max-width:min(100%,42em);margin:10px 0 18px}
.hasht-story__copy{margin:0;width:100%;max-width:40em;color:#111;font-size:clamp(12px,.78vw,14px);font-weight:400;letter-spacing:.02em;line-height:1.7}
.hasht-story__button,.hasht-mobile__button{display:inline-block;padding:clamp(10px,.72vw,13px) clamp(16px,1.4vw,26px);background:#111;color:#fff;font-size:clamp(10px,.58vw,11px);letter-spacing:.16em;line-height:1.4;text-decoration:none;text-transform:uppercase}
.hasht-story__button:hover,.hasht-mobile__button:hover{background:#2b2b2b;color:#fff}
.hasht-manifesto{padding:48px 20px;text-align:center;font-size:15px;line-height:1.8}
.hasht-manifesto span{display:block}
.hasht-mobile{background:#fff;text-align:center}
.hasht-mobile__image{width:100%;height:auto;display:block}
.hasht-mobile__content{display:flex;flex-direction:column;align-items:center;justify-content:center;width:100%;box-sizing:border-box;padding:32px 24px 36px;font-family:'Poppins',sans-serif;text-align:center}
.hasht-mobile__title{display:block;width:100%;margin:0;font-size:22px;letter-spacing:.18em;line-height:1.2;text-align:center}
.hasht-mobile__copy-wrap{display:flex;flex-direction:column;align-items:center;gap:10px;width:100%;max-width:34em;margin:12px auto 20px;text-align:center}
.hasht-mobile__copy{display:block;width:100%;margin:0;color:#222;font-family:'Poppins',sans-serif;font-size:13px;font-weight:400;letter-spacing:.02em;line-height:1.7;text-align:center}
.hasht-mobile__button{display:inline-block;width:auto;margin:0 auto;font-family:'Poppins',sans-serif;text-align:center}
.hasht-products{position:relative;width:100%;overflow:hidden}
.hasht-products .productSwiper{width:100%;padding:40px 0;overflow:hidden;touch-action:pan-y}
.hasht-products .swiper-slide{height:auto;min-width:0}
.hasht-products .swiper-button-next,.hasht-products .swiper-button-prev{width:44px;height:44px;border-radius:50%;background:#fff;box-shadow:0 6px 18px rgba(0,0,0,.12);color:#000}
.hasht-products .swiper-button-next::after,.hasht-products .swiper-button-prev::after{font-size:16px;font-weight:700}
.hasht-products .swiper-pagination{display:none}
@media(max-width:575px){.hasht-products .productSwiper{padding:32px 8px 42px}.hasht-products .swiper-button-next,.hasht-products .swiper-button-prev{display:none}.hasht-products .swiper-pagination{display:flex;bottom:10px;justify-content:center}}
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
        <source src="{{ asset($mobileBanner) }}" type="video/mp4">
    </video>
</section>

@foreach($stories as $index => $story)
    <section class="hasht-full-bleed hasht-story d-none d-lg-block">
        <img class="hasht-story__image" src="{{ asset($story['image']) }}" alt="Hasht {{ ucfirst(strtolower($story['name'])) }} pendant" loading="{{ $index === 0 ? 'eager' : 'lazy' }}">
        <div class="hasht-story__panel {{ $story['side'] === 'right' ? 'hasht-story__panel--right' : '' }}">
            <h2 class="hasht-story__title">HASHT {{ $story['name'] }}</h2>
            <div class="hasht-story__copy-wrap">
                @foreach((array) $story['copy'] as $paragraph)
                    <p class="hasht-story__copy">{{ $paragraph }}</p>
                @endforeach
            </div>
            <a class="hasht-story__button" href="https://api.whatsapp.com/send?phone=923070222666&text={{ rawurlencode('Hello Hanif Jewellers, I would like to book an appointment.') }}" target="_blank" rel="noopener noreferrer">BOOK AN APPOINTMENT</a>
        </div>
    </section>
@endforeach

@if($products->isNotEmpty())
<script>
document.querySelectorAll('.hasht-products .productSwiper').forEach((swiperEl)=>{new Swiper(swiperEl,{loop:false,grabCursor:true,watchOverflow:true,observer:true,observeParents:true,breakpoints:{0:{slidesPerView:1,spaceBetween:8},576:{slidesPerView:2,spaceBetween:10},768:{slidesPerView:3,spaceBetween:12},1200:{slidesPerView:4,spaceBetween:12}},navigation:{nextEl:swiperEl.querySelector('.swiper-button-next'),prevEl:swiperEl.querySelector('.swiper-button-prev')},pagination:{el:swiperEl.querySelector('.swiper-pagination'),clickable:true}})});
</script>
@endif
@endsection
