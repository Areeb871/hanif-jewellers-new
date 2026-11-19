@extends('public.layouts.header_new')

@section('content')
@php
    $campaignSlides = [
        ['desktop' => 'assets/f_assets/image/timeless/desktop2.png', 'mobile' => 'assets/f_assets/image/timeless/mob2.png', 'show_copy' => false],
    ];

    $gehnawaCopy = __('site.timeless_copy');
    $appointmentUrl = $appointmentWhatsappUrl;

    $lookGroups = [
        [
            'id' => 'timelessCarousel-1',
            'images' => [
                ['src' => asset('assets/f_assets/image/timeless/16/1.png'), 'alt' => 'Timeless jewels look 1'],
                ['src' => asset('assets/f_assets/image/timeless/16/2.png'), 'alt' => 'Timeless jewels look 2'],
            ],
        ],
        [
            'id' => 'timelessCarousel-2',
            'images' => [
                ['src' => asset('assets/f_assets/image/timeless/17/1.png'), 'alt' => 'Timeless jewels look 1'],
                ['src' => asset('assets/f_assets/image/timeless/17/2.png'), 'alt' => 'Timeless jewels look 2'],
                ['src' => asset('assets/f_assets/image/timeless/17/3.png'), 'alt' => 'Timeless jewels look 3'],

            ],
        ],
        [
            'id' => 'timelessCarousel-3',
            'images' => [
                ['src' => asset('assets/f_assets/image/timeless/18/1.png'), 'alt' => 'Timeless jewels look 1'],
                ['src' => asset('assets/f_assets/image/timeless/18/2.png'), 'alt' => 'Timeless jewels look 2'],
                ['src' => asset('assets/f_assets/image/timeless/18/3.png'), 'alt' => 'Timeless jewels look 3'],
            ],
        ],
    ];

@endphp

<style>
.gehnawa-full-bleed{width:100vw;margin-left:calc(50% - 50vw);margin-right:calc(50% - 50vw);overflow:hidden}
.gehnawa-banner,.gehnawa-mobile-banner{margin:0;padding:0;background:#000}
.gehnawa-banner video,.gehnawa-mobile-banner video,
.gehnawa-banner img,.gehnawa-mobile-banner img{display:block;width:100%;height:auto;object-fit:contain}
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
.timeless-square-pair{background:#fff}
.timeless-square-pair__image{width:100%;height:auto;aspect-ratio:1/1;object-fit:cover;display:block}
.timeless-square-pair .carousel,.timeless-square-pair .carousel-inner,.timeless-square-pair .carousel-item{height:100%}
.timeless-square-pair .carousel-item img{display:block;width:100%;height:auto;aspect-ratio:1/1;object-fit:cover}
.gehnawa-ending-appointment{display:flex;align-items:center;justify-content:center;padding-block:clamp(32px,4vw,64px);background:#fff}
</style>

{{-- Main hero image (desktop1 / mob1) instead of video. --}}
<section class="gehnawa-full-bleed gehnawa-campaign" aria-label="Timeless jewels banner">
    <div class="gehnawa-campaign__slide">
        <picture>
            <source media="(max-width: 767.98px)" srcset="{{ asset('assets/f_assets/image/timeless/mob1.png') }}">
            <img class="gehnawa-campaign__image" src="{{ asset('assets/f_assets/image/timeless/desktop1.png') }}" alt="Timeless jewels" loading="eager" decoding="async">
        </picture>
        <div class="gehnawa-campaign__panel d-none d-lg-flex">
            <h2 class="gehnawa-campaign__title">{{ __('site.col_timeless') }}</h2>
            <p class="gehnawa-campaign__copy">{{ $gehnawaCopy }}</p>
            <a class="gehnawa-campaign__button" href="{{ $appointmentUrl }}" target="_blank" rel="noopener noreferrer">{{ __('site.book_appointment') }}</a>
        </div>
        <div class="gehnawa-campaign__mobile-panel d-lg-none">
            <h2 class="gehnawa-campaign__title">{{ __('site.col_timeless') }}</h2>
            <p class="gehnawa-campaign__copy">{{ $gehnawaCopy }}</p>
            <a class="gehnawa-campaign__button" href="{{ $appointmentUrl }}" target="_blank" rel="noopener noreferrer">{{ __('site.book_appointment') }}</a>
        </div>
    </div>
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
                    <a class="gehnawa-campaign__button" href="{{ $appointmentUrl }}" target="_blank" rel="noopener noreferrer">{{ __('site.book_appointment') }}</a>
                </div>

                <div class="gehnawa-campaign__mobile-panel d-lg-none">
                    <h2 class="gehnawa-campaign__title">GEHNAWA</h2>
                    <p class="gehnawa-campaign__copy">{{ $gehnawaCopy }}</p>
                    <a class="gehnawa-campaign__button" href="{{ $appointmentUrl }}" target="_blank" rel="noopener noreferrer">{{ __('site.book_appointment') }}</a>
                </div>
            @endif
        </div>
    @endforeach
</section>

{{-- Three look carousels in one row. --}}
<section class="container pt-4 pt-md-5 timeless-square-pair" aria-label="Timeless jewels collection looks">
    <div class="row gx-3 gy-3 gy-md-0">
        @foreach($lookGroups as $group)
            <div class="col-md-4">
                @include('public.partials.carousel', [
                    'id' => $group['id'],
                    'images' => $group['images'],
                ])
            </div>
        @endforeach
    </div>
</section>

<section class="gehnawa-ending-appointment" aria-label="{{ __('site.book_appointment') }}">
    <x-book-appointment />
</section>

@include('public.partials.image-gallery-modal')

<script>
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('[id^="timelessCarousel-"]').forEach(function (carouselElement) {
        bootstrap.Carousel.getOrCreateInstance(carouselElement, {
            interval: false,
            wrap: true,
            touch: false,
        });
    });
});
</script>
@endsection
