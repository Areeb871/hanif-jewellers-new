@extends('public.layouts.header_new')

@section('content')
@php
    $backgroundType = $backgroundType ?? 'video';
    $desktopBanner = $backgroundFile ?? 'assets/f_assets/image/colection-design-images/banner.mp4';
    $mobileBanner = $mobileBackgroundFile ?? 'assets/f_assets/image/colection-design-images/mobile.mp4';
    $isDesktopVideo = \Illuminate\Support\Str::endsWith(strtolower($desktopBanner), ['.mp4', '.webm', '.ogg']);
    $desktopBannerSrc = filter_var($desktopBanner, FILTER_VALIDATE_URL) ? $desktopBanner : asset($desktopBanner);
    $cleopatraCopy = "An ode to contemporary beauty. Woven in sweeping gold, this necklace whispers secrets of the past with a discreet charm that's effortlessly modern.";
    $stories = [
        [
            'image' => 'assets/f_assets/image/Cleopatra 1 Ratio 1/desktop1.png',
            'mobile_image' => 'assets/f_assets/image/Cleopatra 1 Ratio 1/mob1.png',
            'copy' => $cleopatraCopy,
        ],
        [
            'image' => 'assets/f_assets/image/Cleopatra 1 Ratio 1/desktop2.png',
            'mobile_image' => 'assets/f_assets/image/Cleopatra 1 Ratio 1/mob2.png',
            'copy' => null,
        ],
        [
            'image' => 'assets/f_assets/image/Cleopatra 1 Ratio 1/desktop3.png',
            'mobile_image' => 'assets/f_assets/image/Cleopatra 1 Ratio 1/mob3.png',
            'copy' => null,
        ],
    ];
@endphp

<style>
.cleopatra-full-bleed{width:100vw;margin-left:calc(50% - 50vw);margin-right:calc(50% - 50vw);overflow:hidden}
.cleopatra-intro-media{width:100%;height:auto;display:block}
.cleopatra-story{position:relative;aspect-ratio:16/9;background:#080604}
.cleopatra-story__image{position:absolute;inset:0;width:100%;height:100%;object-fit:cover;display:block}
.cleopatra-story__panel{position:absolute;left:clamp(20px,3.65vw,70px);bottom:clamp(20px,4.7vw,90px);z-index:2;display:flex;flex-direction:column;align-items:flex-start;width:clamp(340px,34vw,560px);max-width:calc(100% - 40px);box-sizing:border-box;padding:0;font-family:'Poppins',sans-serif;text-align:left}
.cleopatra-story__title,.cleopatra-mobile__title{margin:0;color:#fff;font-family:'Poppins',sans-serif;font-size:clamp(20px,1.6vw,26px);font-weight:500;letter-spacing:.18em;line-height:1.2;text-wrap:balance}
.cleopatra-story__copy{margin:10px 0 18px;width:100%;max-width:40em;color:#fff;font-size:clamp(12px,.78vw,14px);font-weight:400;letter-spacing:.02em;line-height:1.7}
.cleopatra-story__button,.cleopatra-mobile__button{display:inline-block;padding:clamp(10px,.72vw,13px) clamp(16px,1.4vw,26px);background:#fff;color:#111;font-family:'Poppins',sans-serif;font-size:clamp(10px,.58vw,11px);letter-spacing:.16em;line-height:1.4;text-decoration:none;text-transform:uppercase}
.cleopatra-story__button:hover,.cleopatra-mobile__button:hover{background:#e7e7e7;color:#111}
.cleopatra-mobile{background:#fff;text-align:center}
.cleopatra-mobile__image{width:100%;height:auto;display:block}
.cleopatra-mobile__content{display:flex;flex-direction:column;align-items:center;justify-content:center;width:100%;box-sizing:border-box;padding:32px 24px 36px;font-family:'Poppins',sans-serif;text-align:center}
.cleopatra-mobile__title{display:block;width:100%;color:#111;font-size:22px;text-align:center}
.cleopatra-mobile__copy{display:block;width:100%;max-width:34em;margin:12px auto 20px;color:#222;font-family:'Poppins',sans-serif;font-size:13px;font-weight:400;letter-spacing:.02em;line-height:1.7;text-align:center}
.cleopatra-mobile__button{width:auto;background:#111;color:#fff;text-align:center}
.cleopatra-mobile__button:hover{background:#2b2b2b;color:#fff}
.cleopatra-square-pair__image{width:100%;height:auto;aspect-ratio:1/1;object-fit:cover;display:block}
.cleopatra-ending-appointment{display:flex;align-items:center;justify-content:center;padding-block:clamp(32px,4vw,64px);background:#fff}
</style>

<section class="cleopatra-full-bleed d-none d-md-block">
    @if($backgroundType === 'video' && $isDesktopVideo)
        <video class="cleopatra-intro-media" autoplay loop muted playsinline preload="metadata">
            <source src="{{ $desktopBannerSrc }}" type="video/{{ strtolower(pathinfo($desktopBanner, PATHINFO_EXTENSION)) }}">
        </video>
    @else
        <img class="cleopatra-intro-media" src="{{ $desktopBannerSrc }}" alt="Cleopatra collection">
    @endif
</section>

<section class="cleopatra-full-bleed d-md-none">
    <video class="cleopatra-intro-media" autoplay loop muted playsinline preload="metadata">
        <source src="{{ asset($mobileBanner) }}" type="video/mp4">
    </video>
</section>

@foreach($stories as $index => $story)
    <section class="cleopatra-full-bleed cleopatra-story d-none d-lg-block">
        <img class="cleopatra-story__image" src="{{ asset($story['image']) }}" alt="Cleopatra collection" loading="{{ $index === 0 ? 'eager' : 'lazy' }}">
        @if($index === 0)
            <div class="cleopatra-story__panel">
                <h2 class="cleopatra-story__title">CLEOPATRA</h2>
                @if($story['copy'])
                    <p class="cleopatra-story__copy">{{ $story['copy'] }}</p>
                @endif
                <a class="cleopatra-story__button" href="https://api.whatsapp.com/send?phone=923070222666&text={{ rawurlencode('Hello Hanif Jewellers, I would like to book an appointment.') }}" target="_blank" rel="noopener noreferrer">BOOK AN APPOINTMENT</a>
            </div>
        @endif
    </section>
@endforeach

@foreach($stories as $index => $story)
    <section class="cleopatra-full-bleed cleopatra-mobile d-lg-none">
        <img class="cleopatra-mobile__image" src="{{ asset($story['mobile_image']) }}" alt="Cleopatra collection" loading="{{ $index === 0 ? 'eager' : 'lazy' }}">
        @if($index === 0)
            <div class="cleopatra-mobile__content">
                <h2 class="cleopatra-mobile__title">CLEOPATRA</h2>
                @if($story['copy'])
                    <p class="cleopatra-mobile__copy">{{ $story['copy'] }}</p>
                @endif
                <a class="cleopatra-mobile__button" href="https://api.whatsapp.com/send?phone=923070222666&text={{ rawurlencode('Hello Hanif Jewellers, I would like to book an appointment.') }}" target="_blank" rel="noopener noreferrer">BOOK AN APPOINTMENT</a>
            </div>
        @endif
    </section>
@endforeach

<section class="container pt-4 pt-md-5" aria-label="Cleopatra collection looks">
    <div class="row g-3 mb-3">
        <div class="col-md-6">
            <img class="cleopatra-square-pair__image" src="{{ asset('assets/f_assets/image/Cleopatra 1 Ratio 1/Cleopatra Look 4/Cleopatra Look 4  (1).avif') }}" alt="Cleopatra Look 4" loading="lazy">
        </div>
        <div class="col-md-6">
            <img class="cleopatra-square-pair__image" src="{{ asset('assets/f_assets/image/Cleopatra 1 Ratio 1/Cleopatra Look 5/Cleopatra Look 5.avif') }}" alt="Cleopatra Look 5" loading="lazy">
        </div>
    </div>
</section>

<section class="cleopatra-ending-appointment" aria-label="Book an appointment">
    <x-book-appointment />
</section>
@endsection
