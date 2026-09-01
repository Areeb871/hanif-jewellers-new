@extends('public.layouts.header_new')

@section('content')
@php
    $campaignSlides = [
        ['desktop' => 'assets/f_assets/image/Gehwana/desktop2.png', 'mobile' => 'assets/f_assets/image/Gehwana/mob2.png', 'show_copy' => true],
        ['desktop' => 'assets/f_assets/image/Gehwana/desktop3.png', 'mobile' => 'assets/f_assets/image/Gehwana/mob3.png', 'show_copy' => false],
    ];

    $gehnawaCopy = "Gehnawa fuses modern day bridals with their heritage jewels. Rooting from 'Gehna' (meaning jewels) and 'Pehnawa' meaning 'clothes', gehnawa is the latest essence table to be dressed in gold, head to toe; which is every bridal's dream attire!";
    $appointmentUrl = 'https://api.whatsapp.com/send?phone=923070222666&text=' . rawurlencode('Hello Hanif Jewellers, I would like to book an appointment.');

    $lookGroups = [
        ['id' => 'gehnawaCarousel-6', 'column' => 'col-md-6', 'directory' => 'Look 6', 'pattern' => 'Gehwana %d.jpg', 'alt' => 'Gehnawa look 6'],
        ['id' => 'gehnawaCarousel-3', 'column' => 'col-md-6', 'directory' => 'Look 3', 'pattern' => 'Gehwana %d.jpg', 'alt' => 'Gehnawa look 3'],
        ['id' => 'gehnawaCarousel-5', 'column' => 'col-md-4', 'directory' => 'Look 5', 'pattern' => '%d.jpg', 'alt' => 'Gehnawa look 5'],
    ];

    foreach ($lookGroups as &$group) {
        $group['images'] = [];
        for ($imageIndex = 1; $imageIndex <= 4; $imageIndex++) {
            $group['images'][] = [
                'src' => asset('assets/f_assets/image/Gehwana/' . $group['directory'] . '/' . sprintf($group['pattern'], $imageIndex)),
                'alt' => $group['alt'] . ' image ' . $imageIndex,
            ];
        }
    }
    unset($group);

@endphp

<style>
.gehnawa-full-bleed{width:100vw;margin-left:calc(50% - 50vw);margin-right:calc(50% - 50vw);overflow:hidden}
.gehnawa-banner,.gehnawa-mobile-banner{margin:0;padding:0;background:#000}
.gehnawa-banner video,.gehnawa-mobile-banner video{display:block;width:100%;height:auto;object-fit:contain}
.gehnawa-campaign{background:#d9af78}
.gehnawa-campaign__slide{position:relative}
.gehnawa-campaign__image{display:block;width:100%;height:auto}
.gehnawa-campaign__panel{position:absolute;left:clamp(20px,3.65vw,70px);bottom:clamp(20px,4.7vw,90px);z-index:2;display:flex;flex-direction:column;align-items:flex-start;width:clamp(340px,34vw,560px);max-width:calc(100% - 40px);box-sizing:border-box;padding:0;background:transparent;color:#fff;font-family:'Poppins',sans-serif;text-align:left;text-shadow:0 1px 8px rgba(0,0,0,.35)}
.gehnawa-campaign__title{margin:0;color:inherit;font-family:'Poppins',sans-serif;font-size:clamp(20px,1.6vw,26px);font-weight:500;letter-spacing:.18em;line-height:1.2}
.gehnawa-campaign__copy{width:100%;max-width:40em;margin:10px 0 18px;color:inherit;font-family:'Poppins',sans-serif;font-size:clamp(12px,.78vw,14px);font-weight:400;letter-spacing:.02em;line-height:1.7}
.gehnawa-campaign__button{display:inline-block;padding:clamp(10px,.72vw,13px) clamp(16px,1.4vw,26px);background:#fff;color:#111;font-family:'Poppins',sans-serif;font-size:clamp(10px,.58vw,11px);letter-spacing:.16em;line-height:1.4;text-decoration:none;text-shadow:none;text-transform:uppercase}
.gehnawa-campaign__button:hover,.gehnawa-campaign__button:focus{background:#e7e7e7;color:#111}
.gehnawa-campaign__mobile-panel{display:flex;flex-direction:column;align-items:center;justify-content:center;width:100%;box-sizing:border-box;padding:32px 24px 36px;background:#fff;color:#111;font-family:'Poppins',sans-serif;text-align:center}
.gehnawa-campaign__mobile-panel .gehnawa-campaign__title{width:100%;font-size:22px;text-align:center}
.gehnawa-campaign__mobile-panel .gehnawa-campaign__copy{max-width:34em;margin:12px auto 20px;font-size:13px;text-align:center}
.gehnawa-campaign__mobile-panel .gehnawa-campaign__button{background:#111;color:#fff}
.gehnawa-campaign__mobile-panel .gehnawa-campaign__button:hover,.gehnawa-campaign__mobile-panel .gehnawa-campaign__button:focus{background:#2b2b2b;color:#fff}
.gehnawa-looks{position:relative;background:#fff;overflow:hidden}
.gehnawa-looks__slider{position:relative;width:100%;max-width:1320px;margin:0 auto;padding:0;overflow:hidden!important;touch-action:pan-y}
.gehnawa-looks__slider .swiper-slide{height:auto;min-width:0}
.gehnawa-looks__box{height:100%}
.gehnawa-looks__box .carousel,.gehnawa-looks__box .carousel-inner,.gehnawa-looks__box .carousel-item{height:100%}
.gehnawa-looks__box .carousel-item img{display:block;width:100%;height:auto;aspect-ratio:1/1;object-fit:cover}
.gehnawa-ending-appointment{display:flex;align-items:center;justify-content:center;padding:48px 20px;background:#fff}
@media(max-width:575px){
    .gehnawa-looks__slider{padding:0 8px}
}
</style>

{{-- The main desktop hero is one looping video, not a slider. --}}
<section class="gehnawa-full-bleed gehnawa-banner d-none d-md-block" aria-label="Gehnawa desktop banner">
    <video autoplay loop muted playsinline preload="metadata">
        <source src="{{ asset('assets/f_assets/image/Gehwana/gehnawa.mp4') }}" type="video/mp4">
        Your browser does not support the video tag.
    </video>
</section>

<section class="gehnawa-full-bleed gehnawa-mobile-banner d-md-none" aria-label="Gehnawa mobile banner">
    <video autoplay loop muted playsinline preload="metadata">
        <source src="{{ asset('assets/f_assets/image/Gehwana/Gehnawa Banner Mob View.mp4') }}" type="video/mp4">
        Your browser does not support the video tag.
    </video>
</section>

{{-- Separate full-width campaign sections in desktop2, desktop3 order. --}}
<section class="gehnawa-full-bleed gehnawa-campaign" aria-label="Gehnawa campaign">
    @foreach($campaignSlides as $index => $slide)
        <div class="gehnawa-campaign__slide">
            <picture>
                <source media="(max-width: 991.98px)" srcset="{{ asset($slide['mobile']) }}">
                <img class="gehnawa-campaign__image" src="{{ asset($slide['desktop']) }}" alt="Gehnawa campaign image {{ $index + 1 }}" loading="{{ $index === 0 ? 'eager' : 'lazy' }}" decoding="async">
            </picture>

            @if($slide['show_copy'])
                <div class="gehnawa-campaign__panel d-none d-lg-flex">
                    <h2 class="gehnawa-campaign__title">GEHNAWA</h2>
                    <p class="gehnawa-campaign__copy">{{ $gehnawaCopy }}</p>
                    <a class="gehnawa-campaign__button" href="{{ $appointmentUrl }}" target="_blank" rel="noopener noreferrer">BOOK AN APPOINTMENT</a>
                </div>

                <div class="gehnawa-campaign__mobile-panel d-lg-none">
                    <h2 class="gehnawa-campaign__title">GEHNAWA</h2>
                    <p class="gehnawa-campaign__copy">{{ $gehnawaCopy }}</p>
                    <a class="gehnawa-campaign__button" href="{{ $appointmentUrl }}" target="_blank" rel="noopener noreferrer">BOOK AN APPOINTMENT</a>
                </div>
            @endif
        </div>
    @endforeach
</section>

{{-- One outer slider with six look boxes; every box keeps its four-image carousel. --}}
<section class="gehnawa-looks">
    <div class="container-fluid px-3 px-md-4 pt-3 pb-0">
        <div id="gehnawaLookGroups" class="swiper gehnawa-looks__slider" aria-label="Gehnawa collection looks">
            <div class="swiper-wrapper">
                @foreach($lookGroups as $group)
                    <div class="swiper-slide">
                        <div class="gehnawa-looks__box">
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

<section class="gehnawa-ending-appointment" aria-label="Book an appointment">
    <x-book-appointment />
</section>

@include('public.partials.image-gallery-modal')

<script>
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('[id^="gehnawaCarousel-"]').forEach(function (carouselElement) {
        bootstrap.Carousel.getOrCreateInstance(carouselElement, {
            interval: false,
            wrap: true,
            touch: false,
        });
    });

    const looksElement = document.getElementById('gehnawaLookGroups');
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
