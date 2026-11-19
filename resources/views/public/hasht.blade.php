@extends('public.layouts.header_new')

@section('content')
@php
    $desktopBanner = $subcategory->banner_url ?? 'assets/f_assets/image/Hasht Web/hasht_new_banner.mp4';
    $mobileBanner = 'assets/f_assets/image/Hasht Web/hasht_mobile_new.mp4';
    $isDesktopVideo = \Illuminate\Support\Str::endsWith(strtolower($desktopBanner), ['.mp4', '.webm', '.ogg']);
    $desktopBannerSrc = filter_var($desktopBanner, FILTER_VALIDATE_URL) ? $desktopBanner : asset($desktopBanner);
    $stories = [
        ['name' => 'RUBY', 'title' => __('site.col_hasht_ruby'), 'image' => 'assets/f_assets/image/Hasht Web/Banners/Hasht Ruby Desktop.jpg', 'mobile_image' => 'assets/f_assets/image/Hasht Web/Banners/Hast Ruby Mob.jpg', 'copy' => __('site.hasht_ruby'), 'side' => 'right', 'theme' => 'black'],

        ['name' => 'SAPPHIRE', 'title' => __('site.col_hasht_sapphire'), 'image' => 'assets/f_assets/image/Hasht Web/Banners/Hasht Saphire Desktop.jpg', 'mobile_image' => 'assets/f_assets/image/Hasht Web/Banners/Hasht Saphire Mob.jpg', 'copy' => [
            __('site.hasht_sapphire_1'),
            __('site.hasht_sapphire_2'),
        ], 'side' => 'left', 'theme' => 'black'],
        ['name' => 'EMERALD', 'title' => __('site.col_hasht_emerald'), 'image' => 'assets/f_assets/image/Hasht Web/Banners/Hasht Emerald Desktop.jpg', 'mobile_image' => 'assets/f_assets/image/Hasht Web/Banners/Hasht Emerald Mob.jpg', 'copy' => __('site.hasht_emerald'), 'side' => 'left', 'theme' => 'black'],
    ];
    $bannerBase = 'assets/f_assets/image/Hasht Web/Banners/';
    $lookGroups = [
        ['id' => 'hashtCarousel-1', 'files' => ['1.PNG'], 'alt' => 'Hasht look 1'],
        ['id' => 'hashtCarousel-2', 'files' => ['model1.png', 'model2.png'], 'alt' => 'Hasht model'],
        ['id' => 'hashtCarousel-3', 'files' => ['3.png'], 'alt' => 'Hasht look 3'],
    ];

    foreach ($lookGroups as &$group) {
        $group['images'] = [];
        foreach ($group['files'] as $index => $file) {
            $group['images'][] = [
                'src' => asset($bannerBase . $file),
                'alt' => $group['alt'] . ' image ' . ($index + 1),
            ];
        }
    }
    unset($group);
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
.hasht-story__button,.hasht-mobile__button{display:inline-block;padding:clamp(12px,.8vw,14px) clamp(20px,1.6vw,28px);background:#000;color:#fff;border:0;border-radius:0;font-family:'Poppins',sans-serif;font-size:clamp(10px,.58vw,11px);font-weight:500;letter-spacing:.16em;line-height:1.4;text-decoration:none;text-transform:uppercase}
.hasht-story__button:hover,.hasht-mobile__button:hover{background:#111;color:#fff}
.hasht-story__panel--white .hasht-story__title,
.hasht-story__panel--white .hasht-story__copy{color:#fff}
.hasht-story__panel--white .hasht-story__button{background:white;color:black;border:0}
.hasht-story__panel--white .hasht-story__button:hover{background:#111;color:#fff}
.hasht-manifesto{padding:48px 20px;text-align:center;font-size:15px;line-height:1.8}
.hasht-manifesto span{display:block}
.hasht-mobile{background:#fff;text-align:center}
.hasht-mobile__image{width:100%;height:auto;display:block}
.hasht-mobile__content{display:flex;flex-direction:column;align-items:center;justify-content:center;width:100%;box-sizing:border-box;padding:32px 24px 36px;font-family:'Poppins',sans-serif;text-align:center}
.hasht-mobile__title{display:block;width:100%;margin:0;color:#111;font-size:22px;letter-spacing:.18em;line-height:1.2;text-align:center}
.hasht-mobile__copy-wrap{display:flex;flex-direction:column;align-items:center;gap:10px;width:100%;max-width:34em;margin:12px auto 20px;text-align:center}
.hasht-mobile__copy{display:block;width:100%;margin:0;color:#111;font-family:'Poppins',sans-serif;font-size:13px;font-weight:400;letter-spacing:.02em;line-height:1.7;text-align:center}
.hasht-mobile__button{display:inline-block;width:auto;margin:0 auto;font-family:'Poppins',sans-serif;text-align:center}
.hasht-looks{position:relative;background:#fff;overflow:hidden}
.hasht-looks__slider{position:relative;width:100%;max-width:1320px;margin:0 auto;padding:0;overflow:hidden!important;touch-action:pan-y}
.hasht-looks__slider .swiper-slide{height:auto;min-width:0}
.hasht-looks__box{height:100%}
.hasht-looks__box .carousel,.hasht-looks__box .carousel-inner,.hasht-looks__box .carousel-item{height:100%}
.hasht-looks__box .carousel-item img{display:block;width:100%;height:auto;aspect-ratio:1/1;object-fit:cover}
.hasht-bottom-space{width:100%;height:48px;background:#fff}
@media(max-width:575px){.hasht-looks__slider{padding:0 8px}}
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
    @php $themeClass = (($story['theme'] ?? 'black') === 'white') ? 'hasht-story__panel--white' : 'hasht-story__panel--black'; @endphp
    <section class="hasht-full-bleed hasht-story d-none d-lg-block">
        <img class="hasht-story__image" src="{{ asset($story['image']) }}" alt="Hasht {{ ucfirst(strtolower($story['name'])) }} pendant" loading="{{ $index === 0 ? 'eager' : 'lazy' }}">
        <div class="hasht-story__panel {{ $themeClass }} {{ $story['side'] === 'right' ? 'hasht-story__panel--right' : '' }}">
            <h2 class="hasht-story__title">{{ $story['title'] }}</h2>
            <div class="hasht-story__copy-wrap">
                @foreach((array) $story['copy'] as $paragraph)
                    <p class="hasht-story__copy">{{ $paragraph }}</p>
                @endforeach
            </div>
            <a class="hasht-story__button" href="{{ $appointmentWhatsappUrl }}" target="_blank" rel="noopener noreferrer">{{ __('site.book_appointment') }}</a>
        </div>
    </section>
@endforeach

@foreach($stories as $index => $story)
    <section class="hasht-full-bleed hasht-mobile d-lg-none">
        <img class="hasht-mobile__image" src="{{ asset($story['mobile_image']) }}" alt="Hasht {{ ucfirst(strtolower($story['name'])) }} pendant" loading="{{ $index === 0 ? 'eager' : 'lazy' }}">
        <div class="hasht-mobile__content">
            <h2 class="hasht-mobile__title">{{ $story['title'] }}</h2>
            <div class="hasht-mobile__copy-wrap">
                @foreach((array) $story['copy'] as $paragraph)
                    <p class="hasht-mobile__copy">{{ $paragraph }}</p>
                @endforeach
            </div>
            <a class="hasht-mobile__button" href="{{ $appointmentWhatsappUrl }}" target="_blank" rel="noopener noreferrer">{{ __('site.book_appointment') }}</a>
        </div>
    </section>
@endforeach

<section class="hasht-looks">
    <div class="container-fluid px-3 px-md-4 pt-3 pb-0">
        <div id="hashtLookGroups" class="swiper hasht-looks__slider" aria-label="Hasht collection looks">
            <div class="swiper-wrapper">
                @foreach($lookGroups as $group)
                    <div class="swiper-slide">
                        <div class="hasht-looks__box">
                            @include('public.partials.carousel', [
                                'id' => $group['id'],
                                'images' => $group['images'],
                            ])
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

<div class="hasht-bottom-space" aria-hidden="true"></div>

@include('public.partials.image-gallery-modal')

<script>
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('[id^="hashtCarousel-"]').forEach(function (carouselElement) {
        bootstrap.Carousel.getOrCreateInstance(carouselElement, {
            interval: false,
            wrap: true,
            touch: false,
        });
    });

    const looksElement = document.getElementById('hashtLookGroups');
    if (looksElement) {
        new Swiper(looksElement, {
            loop: false,
            grabCursor: true,
            watchOverflow: true,
            observer: true,
            observeParents: true,
            breakpoints: {
                0: { slidesPerView: 1, spaceBetween: 8 },
                576: { slidesPerView: 2, spaceBetween: 10 },
                768: { slidesPerView: 3, spaceBetween: 12 },
            },
        });
    }
});
</script>
@endsection
