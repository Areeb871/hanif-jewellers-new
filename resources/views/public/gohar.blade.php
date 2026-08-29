@extends('public.layouts.header_new')

@section('content')
@php
    $assetBase = 'assets/f_assets/image/Gohar';
    $goharCopy = 'Gohar, Treasures from the Depths of the Oceans an exquisite chapter in the story of Hanif. Pearls collected and carefully curated from the rarest and deepest parts of the oceans, transformed into mesmerizing pieces of natural art that beautifully adorn you and your collections alike.';
    $stories = [
        [
            'image' => $assetBase . '/desktop1.png',
            'mobile_image' => $assetBase . '/mob1.png',
            'copy' => $goharCopy,
            'side' => 'right',
        ],
        [
            'image' => $assetBase . '/desktop2.png',
            'mobile_image' => $assetBase . '/mob2.png',
            'copy' => null,
            'side' => 'left',
        ],
        [
            'image' => $assetBase . '/desktop3.png',
            'mobile_image' => $assetBase . '/mob3.png',
            'copy' => null,
            'side' => 'right',
        ],
    ];
@endphp

<style>
.gohar-full-bleed{width:100vw;margin-left:calc(50% - 50vw);margin-right:calc(50% - 50vw);overflow:hidden}
.gohar-intro-media{width:100%;height:auto;display:block}
.gohar-story{position:relative;aspect-ratio:16/9;background:#eee}
.gohar-story__image{position:absolute;inset:0;width:100%;height:100%;object-fit:cover;display:block}
.gohar-story__panel{position:absolute;left:clamp(20px,3.65vw,70px);bottom:clamp(20px,4.7vw,90px);z-index:2;display:flex;flex-direction:column;align-items:flex-start;width:clamp(340px,34vw,560px);max-width:calc(100% - 40px);box-sizing:border-box;padding:clamp(37px,2.4vw,3px);background:rgba(239,229,218,.94);box-shadow:0 18px 48px rgba(31,22,15,.16);font-family:'Poppins',sans-serif;text-align:left}
.gohar-story__panel--right{right:clamp(20px,3.65vw,70px);left:auto}
.gohar-story__title,.gohar-mobile__title{margin:0;color:#111;font-family:'Poppins',sans-serif;font-size:clamp(20px,1.6vw,26px);font-weight:500;letter-spacing:.18em;line-height:1.2;text-wrap:balance}
.gohar-story__copy{margin:10px 0 18px;width:100%;max-width:40em;color:#111;font-size:clamp(12px,.78vw,14px);font-weight:400;letter-spacing:.02em;line-height:1.7}
.gohar-story__button,.gohar-mobile__button{display:inline-block;padding:clamp(10px,.72vw,13px) clamp(16px,1.4vw,26px);background:#111;color:#fff;font-family:'Poppins',sans-serif;font-size:clamp(10px,.58vw,11px);letter-spacing:.16em;line-height:1.4;text-decoration:none;text-transform:uppercase}
.gohar-story__button:hover,.gohar-mobile__button:hover{background:#2b2b2b;color:#fff}
.gohar-mobile{background:#fff;text-align:center}
.gohar-mobile__image{width:100%;height:auto;display:block}
.gohar-mobile__content{display:flex;flex-direction:column;align-items:center;justify-content:center;width:100%;box-sizing:border-box;padding:32px 24px 36px;font-family:'Poppins',sans-serif;text-align:center}
.gohar-mobile__title{display:block;width:100%;font-size:22px;text-align:center}
.gohar-mobile__copy{display:block;width:100%;max-width:34em;margin:12px auto 20px;color:#222;font-family:'Poppins',sans-serif;font-size:13px;font-weight:400;letter-spacing:.02em;line-height:1.7;text-align:center}
.gohar-mobile__button{width:auto;margin-top:20px;text-align:center}
.gohar-mobile__copy + .gohar-mobile__button{margin-top:0}
.gohar-ending-appointment{display:flex;align-items:center;justify-content:center;padding-block:clamp(32px,4vw,64px);background:#fff}
</style>

<section class="gohar-full-bleed d-none d-md-block">
    <video class="gohar-intro-media" autoplay loop muted playsinline preload="metadata">
        <source src="{{ asset($assetBase . '/Gohar Banner Desktop.mp4') }}" type="video/mp4">
    </video>
</section>

<section class="gohar-full-bleed d-md-none">
    <video class="gohar-intro-media" autoplay loop muted playsinline preload="metadata">
        <source src="{{ asset($assetBase . '/Gohar_Mob_banner.mp4') }}" type="video/mp4">
    </video>
</section>

@foreach($stories as $index => $story)
    <section class="gohar-full-bleed gohar-story d-none d-lg-block">
        <img class="gohar-story__image" src="{{ asset($story['image']) }}" alt="Gohar collection" loading="{{ $index === 0 ? 'eager' : 'lazy' }}">
        @if($index === 0)
            <div class="gohar-story__panel {{ $story['side'] === 'right' ? 'gohar-story__panel--right' : '' }}">
                <h2 class="gohar-story__title">GOHAR</h2>
                <p class="gohar-story__copy">{{ $story['copy'] }}</p>
                <a class="gohar-story__button" href="https://api.whatsapp.com/send?phone=923070222666&text={{ rawurlencode('Hello Hanif Jewellers, I would like to book an appointment.') }}" target="_blank" rel="noopener noreferrer">BOOK AN APPOINTMENT</a>
            </div>
        @endif
    </section>
@endforeach

@foreach($stories as $index => $story)
    <section class="gohar-full-bleed gohar-mobile d-lg-none">
        <img class="gohar-mobile__image" src="{{ asset($story['mobile_image']) }}" alt="Gohar collection" loading="{{ $index === 0 ? 'eager' : 'lazy' }}">
        @if($index === 0)
            <div class="gohar-mobile__content">
                <h2 class="gohar-mobile__title">GOHAR</h2>
                <p class="gohar-mobile__copy">{{ $story['copy'] }}</p>
                <a class="gohar-mobile__button" href="https://api.whatsapp.com/send?phone=923070222666&text={{ rawurlencode('Hello Hanif Jewellers, I would like to book an appointment.') }}" target="_blank" rel="noopener noreferrer">BOOK AN APPOINTMENT</a>
            </div>
        @endif
    </section>
@endforeach

<section class="gohar-ending-appointment" aria-label="Book an appointment">
    <x-book-appointment />
</section>
@endsection
