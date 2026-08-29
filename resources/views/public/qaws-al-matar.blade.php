@extends('public.layouts.header_new')

@section('content')
@php
    $desktopBanner = $subcategory->banner_url ?? 'assets/f_assets/image/Qaws-al-Matr Desktop View.mp4';
    $mobileBanner = 'assets/f_assets/image/Qaws-ul-Matr Mob View.mp4';
    $isDesktopVideo = \Illuminate\Support\Str::endsWith(strtolower($desktopBanner), ['.mp4', '.webm', '.ogg']);
    $desktopBannerSrc = filter_var($desktopBanner, FILTER_VALIDATE_URL) ? $desktopBanner : asset($desktopBanner);
    $qawsCopy = 'Brilliantly Handcrafted Bespoke Pieces, an ensemble of Gold and opulent Gemstones combined with a touch of class. A hallmark of The Art of handcrafted, bespoke jewellery.';
    $stories = [
        [
            'image' => 'assets/f_assets/image/Qaws al matar Web/desktop1.jpg',
            'mobile_image' => 'assets/f_assets/image/Qaws al matar Web/mobile1.jpg',
            'copy' => $qawsCopy,
            'side' => 'right',
        ],
        [
            'image' => 'assets/f_assets/image/Qaws al matar Web/desktop2.jpg',
            'mobile_image' => 'assets/f_assets/image/Qaws al matar Web/mobile2.jpg',
            'copy' => null,
            'side' => 'null',
        ],
        [
            'image' => 'assets/f_assets/image/Qaws al matar Web/desktop3.jpg',
            'mobile_image' => 'assets/f_assets/image/Qaws al matar Web/mobile3.jpg',
            'copy' => null,
            'side' => 'null',
        ],
    ];
@endphp

<style>
.qaws-full-bleed{width:100vw;margin-left:calc(50% - 50vw);margin-right:calc(50% - 50vw);overflow:hidden}
.qaws-intro-media{width:100%;height:auto;display:block}
.qaws-story{position:relative;aspect-ratio:16/9;background:#eee}
.qaws-story__image{position:absolute;inset:0;width:100%;height:100%;object-fit:cover;display:block}
.qaws-story__panel{position:absolute;left:clamp(20px,3.65vw,70px);bottom:clamp(20px,4.7vw,90px);z-index:2;display:flex;flex-direction:column;align-items:flex-start;width:clamp(340px,34vw,560px);max-width:calc(100% - 40px);box-sizing:border-box;padding:0;background:transparent;font-family:'Poppins',sans-serif;text-align:left}
.qaws-story__panel--right{right:clamp(20px,3.65vw,70px);left:auto}
.qaws-story__title,.qaws-mobile__title{margin:0;color:#111;font-family:'Poppins',sans-serif;font-size:clamp(20px,1.6vw,26px);font-weight:500;letter-spacing:.18em;line-height:1.2;text-wrap:balance}
.qaws-story__copy{margin:10px 0 18px;width:100%;max-width:40em;color:#111;font-size:clamp(12px,.78vw,14px);font-weight:400;letter-spacing:.02em;line-height:1.7}
.qaws-story__button,.qaws-mobile__button{display:inline-block;padding:clamp(10px,.72vw,13px) clamp(16px,1.4vw,26px);background:#111;color:#fff;font-family:'Poppins',sans-serif;font-size:clamp(10px,.58vw,11px);letter-spacing:.16em;line-height:1.4;text-decoration:none;text-transform:uppercase}
.qaws-story__button:hover,.qaws-mobile__button:hover{background:#2b2b2b;color:#fff}
.qaws-mobile{background:#fff;text-align:center}
.qaws-mobile__image{width:100%;height:auto;display:block}
.qaws-mobile__content{display:flex;flex-direction:column;align-items:center;justify-content:center;width:100%;box-sizing:border-box;padding:32px 24px 36px;font-family:'Poppins',sans-serif;text-align:center}
.qaws-mobile__title{display:block;width:100%;font-size:22px;text-align:center}
.qaws-mobile__copy{display:block;width:100%;max-width:34em;margin:12px auto 20px;color:#222;font-family:'Poppins',sans-serif;font-size:13px;font-weight:400;letter-spacing:.02em;line-height:1.7;text-align:center}
.qaws-mobile__button{width:auto;margin-top:20px;text-align:center}
.qaws-mobile__copy + .qaws-mobile__button{margin-top:0}
.qaws-ending-appointment{display:flex;align-items:center;justify-content:center;padding-block:clamp(32px,4vw,64px);background:#fff}
</style>

<section class="qaws-full-bleed d-none d-md-block">
    @if($isDesktopVideo)
        <video class="qaws-intro-media" autoplay loop muted playsinline preload="metadata">
            <source src="{{ $desktopBannerSrc }}" type="video/{{ strtolower(pathinfo($desktopBanner, PATHINFO_EXTENSION)) }}">
        </video>
    @else
        <img class="qaws-intro-media" src="{{ $desktopBannerSrc }}" alt="Qaws Al Matar collection">
    @endif
</section>

<section class="qaws-full-bleed d-md-none">
    <video class="qaws-intro-media" autoplay loop muted playsinline preload="metadata">
        <source src="{{ asset($mobileBanner) }}" type="video/mp4">
    </video>
</section>

@foreach($stories as $index => $story)
    <section class="qaws-full-bleed qaws-story d-none d-lg-block">
        <img class="qaws-story__image" src="{{ asset($story['image']) }}" alt="Qaws Al Matar collection" loading="{{ $index === 0 ? 'eager' : 'lazy' }}">
        @if($index === 0)
            <div class="qaws-story__panel {{ $story['side'] === 'right' ? 'qaws-story__panel--right' : '' }}">
                <h2 class="qaws-story__title">QAWS AL MATAR</h2>
                @if($story['copy'])
                    <p class="qaws-story__copy">{{ $story['copy'] }}</p>
                @endif
                <a class="qaws-story__button" href="https://api.whatsapp.com/send?phone=923070222666&text={{ rawurlencode('Hello Hanif Jewellers, I would like to book an appointment.') }}" target="_blank" rel="noopener noreferrer">BOOK AN APPOINTMENT</a>
            </div>
        @endif
    </section>
@endforeach

@foreach($stories as $index => $story)
    <section class="qaws-full-bleed qaws-mobile d-lg-none">
        <img class="qaws-mobile__image" src="{{ asset($story['mobile_image']) }}" alt="Qaws Al Matar collection" loading="{{ $index === 0 ? 'eager' : 'lazy' }}">
        @if($index === 0)
            <div class="qaws-mobile__content">
                <h2 class="qaws-mobile__title">QAWS AL MATAR</h2>
                @if($story['copy'])
                    <p class="qaws-mobile__copy">{{ $story['copy'] }}</p>
                @endif
                <a class="qaws-mobile__button" href="https://api.whatsapp.com/send?phone=923070222666&text={{ rawurlencode('Hello Hanif Jewellers, I would like to book an appointment.') }}" target="_blank" rel="noopener noreferrer">BOOK AN APPOINTMENT</a>
            </div>
        @endif
    </section>
@endforeach

<section class="qaws-ending-appointment" aria-label="Book an appointment">
    <x-book-appointment />
</section>
@endsection
