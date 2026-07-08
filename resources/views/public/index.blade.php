@extends('public.layouts.header_new')
@section('content')
<style>

.custom-banner {
    width: 100%;
    margin: 0;
    padding: 0;
}

/* Full width image */
.custom-banner img {
    width: 100%;
    height: auto;
    display: block;
}
.custom-banner-btn {
  position: absolute;
  bottom: 35px;
  left: 50%;
  transform: translateX(-50%);
  padding: 13px 10px;
  font-size: 0.8rem;
  font-weight: 500;
  background: transparent;   /* Transparent background */
  color: #fff;
  border: 1px solid #fff;    /* White border for visibility */
  border-radius: 0;
  text-transform: uppercase;
  letter-spacing: 2px;
  display: inline-block;
  z-index: 10;
}

} */
/* remove any spacing around the section */
.carousel-section {
  padding: 0 !important;
  margin: 0 !important;
}

/* Brand banner carousel */
.hero-slide {
  width: 100%;
  height: 100%;
  background: transparent;
  overflow: hidden;
}
.hero-slide picture,
.hero-slide img {
  width: 100%;
  display: block;
}
#carouselExampleRide { width: 100%; }
#carouselExampleRide .carousel-item { line-height: 0; }

/* Carousel nav — visible on all screens */
#carouselExampleRide .carousel-control-prev,
#carouselExampleRide .carousel-control-next {
  width: 48px;
  height: 48px;
  top: 50%;
  bottom: auto;
  transform: translateY(-50%);
  opacity: 0.9;
}
#carouselExampleRide .carousel-control-prev-icon,
#carouselExampleRide .carousel-control-next-icon {
  filter: drop-shadow(0 1px 4px rgba(0, 0, 0, 0.55));
}

/* Banner scales with screen — no crop on any breakpoint */
#carouselExampleRide {
  padding: 0;
  width: 100%;
  height: auto;
  background: #000;
  overflow: hidden;
}

#carouselExampleRide .carousel-inner,
#carouselExampleRide .carousel-item,
#carouselExampleRide .hero-slide,
#carouselExampleRide .hero-slide picture {
  height: auto;
}

#carouselExampleRide .carousel-inner {
  position: relative;
}

#carouselExampleRide .hero-slide {
  width: 100%;
  background: #000;
}

#carouselExampleRide .hero-slide picture {
  width: 100%;
  display: block;
}

#carouselExampleRide .hero-slide img {
  width: 100%;
  height: auto;
  display: block;
}

@media (min-width: 768px) {
  section.bespoke-collections.d-none.d-md-block {
    margin-top: 0 !important;
    padding-top: 0 !important;
  }
}

@media (min-width: 992px) {
  #carouselExampleRide .carousel-control-prev,
  #carouselExampleRide .carousel-control-next {
    width: 50px;
    height: 50px;
  }
}

@media (min-width: 1366px) {
  #carouselExampleRide .carousel-control-prev,
  #carouselExampleRide .carousel-control-next {
    width: 60px;
    height: 60px;
  }
}

@media (min-width: 1920px) {
  #carouselExampleRide .carousel-control-prev,
  #carouselExampleRide .carousel-control-next {
    width: 70px;
    height: 70px;
  }
}

#carouselExampleRide.carousel.carousel-fade .carousel-item {
  transition: opacity 1.5s ease-in-out !important;
}
 header * {
    line-height: normal;
  }

  header .swiper-button-prev,
  header .swiper-button-next {
    line-height: 1 !important;
    top:28%;
  }
  /* =======================
   MOBILE STACK
   ======================= */
.mobileStackHero{
  width: 100%;
  background: #fff;
}

.mobileStackImgWrap{
  width: 100%;
  overflow: hidden;
  background: #000;
  height: 82vh;
  min-height: 520px;
  max-height: 92vh;
}

.mobileStackImg{
  width: 100%;
  height: 100%;
  object-fit: cover;
  object-position: center;
  display: block;
}
.mobileStackVideo{
  width: 100%;
  height: 100%;
  object-fit: cover;
  object-position: center center;
  display: block;
}
/* =========================
   Overlay Content (Haphazard + Discover + Location)
   Button starts from the "H" of Haphazard (left aligned)
========================= */
.banner-content{
    position:absolute;
    left:50%;
    top:80%;
    transform:translate(-50%, -50%);
    z-index:5;
    width:100%;
    text-align:center;
}


.banner-location{
    width:523px;
    max-width:95%;
    margin:0 auto 28px;
    color:#fff;
    font-size:12.5px;
    line-height:1.5;
    font-family:'Poppins', sans-serif !important;
    font-weight:300;
    text-align:center;
    text-shadow:2px 2px 4px rgba(0,0,0,0.55);
}
.banner-title{
    width:100%;
    text-align:center;
}

.banner-title img.banner-logo{
    width:175px !important;
    height:99px !important;
    max-width:none !important;
    display:block !important;
    object-fit:contain !important;
    margin:0 auto !important;   /* perfectly center */
}
.banner-btn{
    display: inline-block;
    padding: 12px 32px;
    font-size: 12px;
    font-weight: 500;
    letter-spacing: 2px;
    text-transform: uppercase;

    background: transparent;              /* ✅ transparent */
    color: #ffffff;
    text-decoration: none;

    border: 1px solid rgba(255,255,255,0.6); /* luxury outline */
    border-radius: 0;

    transition: all 0.3s ease;
}

.banner-btn:hover{
    background-color: #1d1c1c;   /* ✅ hover background */
    border-color: #1d1c1c;       /* ✅ hover border */
    color: #ffffff;
}
/*latest */
/* Remove any container restriction */
.custom-banner {
    width: 100%;
    margin: 0;
    padding: 0;
}

/* Full width image */
.custom-banner-video {
    width: 100%;
    height: auto;
    display: block;
}
.custom-banner-btn-new
{
    position: absolute;
    bottom: 37px;
    left: 50%;
    transform: translateX(-50%);
    padding: 10px 10px;
    font-size: 0.7rem;
    font-weight: 450;
    background: transparent;
    color: #fff;
    border: 1px solid #fff;
    border-radius: 0;
    text-transform: uppercase;
    letter-spacing: 1px;
    display: inline-block;
    z-index: 10;
}
/* for card hover*/
/*Card base */
.lux-card{
  position: relative;
  overflow: hidden;
  background: #000;
  width: 100%;
 
}

/* Ratio spacer: equal height cards */
.lux-ratio{
  display: block;
  padding-top: 100%; /* square */
}

/* Background image */
.lux-img{
  position: absolute;
  inset: 0;
  width: 100%;
  height: 100%;
  object-fit: cover;
  display: block;
  transition: transform .6s ease;
}

/* Overlay */
.lux-hover{
  position: absolute;
  inset: 0;
  background: rgba(0,0,0,0.35);
  display: flex;
  align-items: center;
  justify-content: center;
  opacity: 0;
  transition: opacity .45s ease;
  z-index: 2;
}

/* Center box locked to center */
.lux-box{
  width: 240px;
  height: 240px;
  background: rgba(245,245,245,0.95);

  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%) scale(0.9);

  display: flex;
  align-items: center;
  justify-content: center;

  z-index: 3;
  transition: transform .45s ease;
}

/* ✅ Logo ALWAYS inside box */
.lux-logo{
  max-width: 80%;
  max-height: 70%;
  width: auto;
  height: auto;
  object-fit: contain;
  display: block;
}

/* Border animation (safe) */
.lux-card::before,
.lux-card::after{
  content:"";
  position:absolute;
  inset: 14px;
  pointer-events:none;
  opacity: 0;
  z-index: 2;
}

.lux-card::before{
  border-top: 2px solid rgba(255,255,255,0.95);
  border-right: 2px solid rgba(255,255,255,0.95);
  transform: scaleX(0);
  transform-origin: left center;
  transition: transform .45s ease, opacity .2s ease;
}

.lux-card::after{
  border-bottom: 2px solid rgba(255,255,255,0.95);
  border-left: 2px solid rgba(255,255,255,0.95);
  transform: scaleY(0);
  transform-origin: center bottom;
  transition: transform .45s ease .15s, opacity .2s ease;
}

/* Hover */
.lux-card:hover .lux-hover{ opacity: .85; }
.lux-card:hover .lux-box{ transform: translate(-50%, -50%) scale(1); }
.lux-card:hover .lux-img{ transform: scale(1.05); }
.lux-card:hover::before,
.lux-card:hover::after{ opacity: 1; }
.lux-card:hover::before{ transform: scaleX(1); }
.lux-card:hover::after{ transform: scaleY(1); }

/* Mobile */
@media (max-width: 767px){
  .lux-box{ width: 140px; height: 140px; }
  .lux-card::before, .lux-card::after{ inset: 10px; }
}
/* =========================
   WATCHES SCROLLER — no snap/animation, first card flush left
========================= */
section.watch .mobile-product-scroller {
    width: 100%;
    overflow-x: auto;
    overflow-y: hidden;
    scrollbar-width: none;
    -ms-overflow-style: none;
    -webkit-overflow-scrolling: touch;
    scroll-behavior: auto;
    scroll-snap-type: none;
}

section.watch .mobile-product-scroller::-webkit-scrollbar {
    display: none;
}

section.watch .scroller-item {
    scroll-snap-align: none;
}

section.watch .scroller-container {
    display: flex;
    width: max-content;
    padding-inline: 16px;
    gap: 10px;
}

/* Watch + Bespoke scroller arrows */
section.watch .watch-slider-viewport,
.bespoke-collections .watch-slider-viewport {
    position: relative;
    width: 100%;
    overflow: visible;
}

section.watch .watch-scroller-arrow,
.bespoke-collections .watch-scroller-arrow {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    z-index: 30;
    width: 44px;
    height: 44px;
    border: 1px solid rgba(0, 0, 0, 0.12);
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.95);
    color: #2a2a2a;
    box-shadow: 0 2px 12px rgba(0, 0, 0, 0.1);
    display: flex !important;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    padding: 0;
    transition: transform 0.3s ease, box-shadow 0.3s ease, opacity 0.3s ease, background 0.3s ease;
    backdrop-filter: blur(6px);
    -webkit-backdrop-filter: blur(6px);
}

section.watch .watch-scroller-arrow--prev,
.bespoke-collections .watch-scroller-arrow--prev {
    left: 6px;
}

section.watch .watch-scroller-arrow--next,
.bespoke-collections .watch-scroller-arrow--next {
    right: 6px;
}

section.watch .watch-scroller-arrow .arrow-left svg,
.bespoke-collections .watch-scroller-arrow .arrow-left svg {
    transform: rotate(180deg);
}

section.watch .watch-scroller-arrow:hover:not(:disabled),
.bespoke-collections .watch-scroller-arrow:hover:not(:disabled) {
    transform: translateY(-50%) scale(1.04);
    background: #fff;
    box-shadow: 0 2px 14px rgba(0, 0, 0, 0.14);
}

section.watch .watch-scroller-arrow:disabled,
.bespoke-collections .watch-scroller-arrow:disabled {
    opacity: 0;
    visibility: hidden;
    pointer-events: none;
}

@media (max-width: 767.98px) {
    section.watch .watch-scroller-arrow,
    .bespoke-collections.d-md-none .watch-scroller-arrow {
        display: none !important;
    }

    .bespoke-collections.d-md-none .watch-progress {
        display: flex;
        justify-content: center;
        padding: 22px 24px 14px;
    }

    .bespoke-collections.d-md-none .watch-progress.is-hidden {
        visibility: hidden;
    }

    .bespoke-collections.d-md-none .watch-progress__track {
        position: relative;
        width: 88px;
        height: 2px;
        background: rgba(0, 0, 0, 0.12);
        overflow: hidden;
        border-radius: 1px;
    }

    .bespoke-collections.d-md-none .watch-progress__fill {
        position: absolute;
        top: 0;
        left: 0;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        transition: left 0.2s ease-out, width 0.2s ease-out;
        will-change: left, width;
    }
}

@media (min-width: 992px) {
    section.watch .watch-scroller-arrow,
    .bespoke-collections .watch-scroller-arrow {
        width: 46px;
        height: 46px;
    }

    section.watch .watch-scroller-arrow--prev,
    .bespoke-collections .watch-scroller-arrow--prev {
        left: 10px;
    }

    section.watch .watch-scroller-arrow--next,
    .bespoke-collections .watch-scroller-arrow--next {
        right: 10px;
    }
}

section.watch .addToCartProductDetailsTop .carousel .carousel-item img,
section.watch .addToCartProductDetailsTop .product-image {
    width: 100%;
    max-width: 100%;
    margin-left: auto;
    margin-right: auto;
    object-fit: contain;
}

section.watch .addToCartProductDetailsTop .card-img {
    display: flex;
    justify-content: center;
    align-items: center;
}

section.watch .addToCartProductDetailsTop .carousel,
section.watch .addToCartProductDetailsTop .carousel-inner,
section.watch .addToCartProductDetailsTop .carousel-item {
    width: 100%;
}

@media (max-width: 767.98px) {
    section.watch .mobile-product-scroller {
        touch-action: pan-x pan-y;
        overscroll-behavior-x: contain;
    }

    section.watch .scroller-container {
        gap: 14px;
    }

    section.watch .scroller-item {
        flex: 0 0 86vw;
        width: 86vw;
        max-width: 86vw;
        min-width: 86vw;
    }

    section.watch .scroller-item .card,
    section.watch .scroller-item > * {
        width: 100%;
        max-width: 100%;
    }

    /* Minimal scroll progress — mobile only, no dots */
    section.watch .watch-progress {
        display: flex;
        justify-content: center;
        padding: 22px 24px 14px;
    }

    section.watch .watch-progress.is-hidden {
        visibility: hidden;
    }

    section.watch .watch-progress__track {
        position: relative;
        width: 88px;
        height: 2px;
        background: rgba(0, 0, 0, 0.12);
        overflow: hidden;
        border-radius: 1px;
    }

    section.watch .watch-progress__fill {
        position: absolute;
        top: 0;
        left: 0;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        transition: left 0.2s ease-out, width 0.2s ease-out;
        will-change: left, width;
    }
}

/* Tablet — horizontal scroll, fixed card width (product cards need ~300px) */
@media (min-width: 768px) and (max-width: 991.98px) {
    section.watch .scroller-item {
        flex: 0 0 300px;
        width: 300px;
        max-width: 300px;
        min-width: 300px;
    }

    section.watch .watch-progress {
        display: none !important;
    }
}

/* Migrated from legacy desktopStyle injection */
section.watch {
    padding: 1.5rem 0;
}

@media (min-width: 992px) {
    section.watch .mobile-product-scroller {
        user-select: none;
        -webkit-user-select: none;
    }

    section.watch .scroller-item {
        flex: 0 0 300px;
        max-width: 300px;
        min-width: 300px;
    }

    section.watch .scroller-item .card {
        width: 100%;
        height: 100%;
    }
}

@media (min-width: 992px) and (max-width: 1199.98px) {
    section.watch .scroller-item {
        flex: 0 0 340px;
        max-width: 340px;
        min-width: 340px;
    }
}

@media (min-width: 1200px) and (max-width: 1365.98px) {
    section.watch .scroller-item {
        flex: 0 0 360px;
        max-width: 360px;
        min-width: 360px;
    }
}

@media (min-width: 1366px) {
    section.watch .scroller-container {
        gap: 20px;
        padding: 0 20px;
    }

    section.watch .scroller-item {
        flex: 0 0 380px;
        max-width: 380px;
        min-width: 380px;
    }
}

@media (min-width: 1920px) {
    section.watch .scroller-container {
        gap: 25px;
        padding: 0 25px;
    }

    section.watch .scroller-item {
        flex: 0 0 400px;
        max-width: 400px;
        min-width: 400px;
    }
}

section.watch .card {
    border: none;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

section.watch .card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
}

/* Section headings — equal space above & below */
.section-title,
.bespoke-collections__title {
    font-family: "Cormorant Garamond", serif;
    font-size: clamp(28px, 1.3vw, 44px);
    font-weight: 600;
    padding: 1.5rem 0;
    /* padding: 0; */
    color: #111;
}

@media (min-width: 768px) {
    .section-title,
    .bespoke-collections__title {
        padding: 2rem 0;
    }
}

@media (min-width: 1366px) {
    .section-title,
    .bespoke-collections__title {
        padding: 2.5rem 0;
    }
}

.watch-brands-section {
    padding: 0;
}

#carouselExampleRide .carousel-control-prev,
#carouselExampleRide .carousel-control-next {
    background: none !important;
    background-color: transparent !important;
    border: none !important;
}

</style>

<div style="display:flex;justify-content:center;width:100%;">
  <span style="width:100vw;background:#e6ded3;"></span>
</div>

<!-- <section class="custom-banner d-none d-md-block position-relative">
    <img 
        src="{{ asset('assets/f_assets/image/misterio_data/new3.jpeg') }}" 
        alt="Nagar Collection" 
        class="custom-banner-video"
    >

       {{-- Overlay Content --}}
     <div class="banner-content"> 
        <div class="banner-title">
    <img src="{{ asset('assets/f_assets/image/misterio_data/misterio_logo.png') }}" alt="Hanif Jewellers Logo" class="banner-logo">
</div>
        <div class="banner-location">Exquisite masterpieces crafted with high-quality diamonds of unreachable purity and depth, 
expertly calibrated to radiate brilliance, showcasing timeless artisanal craftsmanship and uniqueness, 
culminating in a true resemblance of experience pure art.</div> 
    <a href="/collections/misterio" class="custom-banner-btn">
        DISCOVER MORE
    </a>
</div>
</section> -->

<section class="custom-banner d-none d-md-block position-relative">
    <video class="custom-banner-video" autoplay muted loop playsinline>
        <source src="{{  asset('assets/f_assets/image/highend/banner.mp4') }}" type="video/mp4">
        Your browser does not support the video tag.
    </video>
            <a href="/highend-jewellery" class="custom-banner-btn">DISCOVER MORE</a>
</section>



<!--<section class="custom-banner d-none d-md-block position-relative">-->
<!--    <video class="custom-banner-video" autoplay muted loop playsinline>-->
<!--        <source src="{{ asset('assets/f_assets/image/nagar/main.mp4') }}" type="video/mp4">-->
<!--        Your browser does not support the video tag.-->
<!--    </video>-->
<!--            <a href="/collections/nagar" class="custom-banner-btn">DISCOVER MORE</a>-->
<!--</section>-->

<!-- <section class="custom-banner d-none d-md-block position-relative">
     @php
        $backgroundType = 'video'; // 'video' or 'image'
        $backgroundFile = 'assets/f_assets/image/devine-treasure/main.mp4';
        // If using image, set $backgroundType='image' and $backgroundFile='path/to/image.jpg'
    @endphp

    {{-- Video Background --}}
    @if(isset($backgroundType) && $backgroundType === 'video' && !empty($backgroundFile))
        <video autoplay loop muted playsinline class="custom-banner-video">
            <source src="{{ asset($backgroundFile) }}" type="video/mp4">
            Your browser does not support the video tag.
        </video>

    {{-- Image Background --}}
    @elseif(isset($backgroundType) && $backgroundType === 'image' && !empty($backgroundFile))
        <div class="custom-banner-image" style="background-image: url('{{ asset($backgroundFile) }}');"></div>
    @endif 
        <img src="{{ asset('assets/f_assets/image/eid/eid_banner.jpg') }}" alt="Eid Banner">


       {{-- Overlay Content --}}
     <div class="banner-content"> -->
        <!-- <div class="banner-title">Divine Treasures</div> -->
        <!-- <div class="banner-location">Crafted in the heart of the world’s
towering peaks</div> 
        <a href="/collections/eid-par-sony-ki-choriyan" class="custom-banner-btn">DISCOVER MORE</a>

</div>


</section> -->
<section class="d-block d-md-none position-relative">
  <div class="mobileStackImgWrap">
  <video class="mobileStackVideo" autoplay muted loop playsinline preload="metadata" poster="{{  asset('assets/f_assets/image/highend/banner.mp4') }}" > <source src="{{  asset('assets/f_assets/image/highend/banner.mp4')}}" type="video/mp4"> </video>
 <!-- <img
  class="mobileStackVideo"
  src="{{ asset('assets/f_assets/image/misterio_data/misterio_mobile.jpeg') }}"
  alt="Divine Treasure"
  loading="lazy"
/> -->

  </div>
<a href="/highend-jewellery" class="custom-banner-btn-new">DISCOVER MORE</a>
</section>
    <!-- Watches / Featured Products Scroller (unified responsive) -->
    <section class="onlineStore watch" style="background-color:#f6f3ee;">
        <div class="watch-slider-viewport">
            <button type="button" class="watch-scroller-arrow watch-scroller-arrow--prev" aria-label="Previous products" disabled>
                <span aria-hidden="true" class="arrow-icon arrow-left">
                    <svg viewBox="0 0 24 24" height="22" width="22" fill="currentColor">
                        <path d="M12.6 12L8.7 8.1C8.52 7.92 8.42 7.68 8.42 7.4C8.42 7.12 8.52 6.88 8.7 6.7C8.88 6.52 9.12 6.42 9.4 6.42C9.68 6.42 9.92 6.52 10.1 6.7L14.7 11.3C14.8 11.4 14.87 11.51 14.91 11.62C14.95 11.74 14.97 11.87 14.97 12C14.97 12.13 14.95 12.26 14.91 12.38C14.87 12.49 14.8 12.6 14.7 12.7L10.1 17.3C9.92 17.48 9.68 17.57 9.4 17.57C9.12 17.57 8.88 17.48 8.7 17.3C8.52 17.12 8.42 16.88 8.42 16.6C8.42 16.32 8.52 16.08 8.7 15.9L12.6 12Z"/>
                    </svg>
                </span>
            </button>
            <div class="mobile-product-scroller onlineStore">
                <div class="scroller-container">
                    @foreach ($products as $key => $product)
                        <div class="scroller-item">
                            @include('public.partials.product-card-new', ['product' => $product])
                        </div>
                    @endforeach
                </div>
            </div>
            <button type="button" class="watch-scroller-arrow watch-scroller-arrow--next" aria-label="Next products">
                <span aria-hidden="true" class="arrow-icon">
                    <svg viewBox="0 0 24 24" height="22" width="22" fill="currentColor">
                        <path d="M12.6 12L8.7 8.1C8.52 7.92 8.42 7.68 8.42 7.4C8.42 7.12 8.52 6.88 8.7 6.7C8.88 6.52 9.12 6.42 9.4 6.42C9.68 6.42 9.92 6.52 10.1 6.7L14.7 11.3C14.8 11.4 14.87 11.51 14.91 11.62C14.95 11.74 14.97 11.87 14.97 12C14.97 12.13 14.95 12.26 14.91 12.38C14.87 12.49 14.8 12.6 14.7 12.7L10.1 17.3C9.92 17.48 9.68 17.57 9.4 17.57C9.12 17.57 8.88 17.48 8.7 17.3C8.52 17.12 8.42 16.88 8.42 16.6C8.42 16.32 8.52 16.08 8.7 15.9L12.6 12Z"/>
                    </svg>
                </span>
            </button>
        </div>
        @if (count($products) > 1)
        <div class="watch-progress d-lg-none" aria-hidden="true">
            <div class="watch-progress__track">
                <div class="watch-progress__fill"></div>
            </div>
        </div>
        @endif
    </section>

    @php
    $brandBannerSlides = [
        ['alt' => 'Bovet', 'desktop' => 'assets/f_assets/image/homepage_2_banner/Bovet Web Banner.avif', 'mobile' => 'assets/f_assets/image/homepage_2_banner/Bovet_mobile.avif'],
        ['alt' => 'Favre-leuba', 'desktop' => 'assets/f_assets/image/watches/Hompage_favre.jpeg', 'mobile' => 'assets/f_assets/image/watches/homepage_mobile_favre.jpeg'],
        ['alt' => 'Franck Muller', 'desktop' => 'assets/f_assets/image/homepage_2_banner/Home Page FM BAnner.jpg', 'mobile' => 'assets/f_assets/image/homepage_2_banner/fm-mob-view.jpg'],
        ['alt' => 'Maurice Lacroix', 'desktop' => 'assets/f_assets/image/homepage_2_banner/ml_new.avif', 'mobile' => 'assets/f_assets/image/homepage_2_banner/ml_new_mobile.avif'],
        ['alt' => 'Artya', 'desktop' => 'assets/f_assets/image/watches/homepageArtya.jpeg', 'mobile' => 'assets/f_assets/image/watches/homepage_artya_mobile.jpeg'],

    ];
    @endphp

    <!-- Brand Banner Carousel (unified responsive) -->
    <section class="carousel-section p-0 m-0">
        <div id="carouselExampleRide" class="carousel slide carousel-fade">
            <div class="carousel-inner">
                @foreach ($brandBannerSlides as $idx => $slide)
                <div class="carousel-item {{ $idx === 0 ? 'active' : '' }}">
                    <div class="hero-slide">
                        <picture>
                            <source media="(max-width: 767.98px)" srcset="{{ asset($slide['mobile']) }}">
                            <img src="{{ asset($slide['desktop']) }}" alt="{{ $slide['alt'] }}" @if($idx === 0) fetchpriority="high" @endif>
                        </picture>
                    </div>
                </div>
                @endforeach
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleRide" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleRide" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </section>

    @php
    $bespokeCollectionLinks = [
        0 => 'hasht',
        1 => 'qaws-al-matar',
        2 => 'nagar',
        3 => 'gulposh',
        4 => 'tawoos',
        5 => 'gohar',
        6 => 'haphazard',
    ];
    @endphp

    <section class="onlineStore bespoke-collections d-none d-md-block" style="background-color:#f6f3ee;">
    <h2 class="text-center bespoke-collections__title">
        Bespoke Collections
    </h2>

    <div class="watch-slider-viewport">
        <button type="button" class="watch-scroller-arrow watch-scroller-arrow--prev" aria-label="Previous" disabled>
            <span aria-hidden="true" class="arrow-icon arrow-left">
                <svg viewBox="0 0 24 24" height="22" width="22" fill="currentColor">
                    <path d="M12.6 12L8.7 8.1C8.52 7.92 8.42 7.68 8.42 7.4C8.42 7.12 8.52 6.88 8.7 6.7C8.88 6.52 9.12 6.42 9.4 6.42C9.68 6.42 9.92 6.52 10.1 6.7L14.7 11.3C14.8 11.4 14.87 11.51 14.91 11.62C14.95 11.74 14.97 11.87 14.97 12C14.97 12.13 14.95 12.26 14.91 12.38C14.87 12.49 14.8 12.6 14.7 12.7L10.1 17.3C9.92 17.48 9.68 17.57 9.4 17.57C9.12 17.57 8.88 17.48 8.7 17.3C8.52 17.12 8.42 16.88 8.42 16.6C8.42 16.32 8.52 16.08 8.7 15.9L12.6 12Z"/>
                </svg>
            </span>
        </button>
        <div class="mobile-product-scroller" style="background-color:#f6f3ee;">
            <div class="scroller-container">
                @foreach ($products_new as $key => $product)
                <div class="scroller-item">
                    <a href="{{ url('collections/' . ($bespokeCollectionLinks[$loop->index] ?? $product->slug)) }}" class="text-decoration-none d-block">
                        <div class="lux-card">
                            <span class="lux-ratio"></span>
                            <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" class="lux-img" loading="lazy">
                            <div class="lux-hover">
                                <div class="lux-box">
                                    @if(!empty($product->hover_image))
                                        <img src="{{ asset($product->hover_image) }}" alt="{{ $product->name }}" class="lux-logo">
                                    @else
                                        <span class="text-dark fw-semibold text-center px-2">{{ $product->name }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
        <button type="button" class="watch-scroller-arrow watch-scroller-arrow--next" aria-label="Next">
            <span aria-hidden="true" class="arrow-icon">
                <svg viewBox="0 0 24 24" height="22" width="22" fill="currentColor">
                    <path d="M12.6 12L8.7 8.1C8.52 7.92 8.42 7.68 8.42 7.4C8.42 7.12 8.52 6.88 8.7 6.7C8.88 6.52 9.12 6.42 9.4 6.42C9.68 6.42 9.92 6.52 10.1 6.7L14.7 11.3C14.8 11.4 14.87 11.51 14.91 11.62C14.95 11.74 14.97 11.87 14.97 12C14.97 12.13 14.95 12.26 14.91 12.38C14.87 12.49 14.8 12.6 14.7 12.7L10.1 17.3C9.92 17.48 9.68 17.57 9.4 17.57C9.12 17.57 8.88 17.48 8.7 17.3C8.52 17.12 8.42 16.88 8.42 16.6C8.42 16.32 8.52 16.08 8.7 15.9L12.6 12Z"/>
                </svg>
            </span>
        </button>
    </div>
</section>

<!-- ========================= MOBILE SECTION ========================= -->
<section class="mobile-jewelry-section bespoke-collections d-md-none" style="background-color:#f6f3ee;">
    <h2 class="text-center bespoke-collections__title">
        Bespoke Collection
    </h2>

    <div class="watch-slider-viewport">
        <div class="mobile-product-scroller" style="background-color:#f6f3ee;">
            <div class="scroller-container">
                @foreach ($products_new as $key => $product)
                <div class="scroller-item">
                    <a href="{{ url('collections/' . ($bespokeCollectionLinks[$loop->index] ?? $product->slug)) }}" class="text-decoration-none d-block">
                        <div class="lux-card">
                            <span class="lux-ratio"></span>
                            <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" class="lux-img" loading="lazy">
                            <div class="lux-hover">
                                <div class="lux-box">
                                    @if(!empty($product->hover_image))
                                        <img src="{{ asset($product->hover_image) }}" alt="{{ $product->name }}" class="lux-logo">
                                    @else
                                        <span class="text-dark fw-semibold text-center px-2">{{ $product->name }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    @if (count($products_new) > 1)
    <div class="watch-progress" aria-hidden="true">
        <div class="watch-progress__track">
            <div class="watch-progress__fill"></div>
        </div>
    </div>
    @endif
</section>

<style>
/* Bespoke collections scroller (same scroll pattern as watch) */
.bespoke-collections .mobile-product-scroller {
    width: 100%;
    overflow-x: auto;
    overflow-y: hidden;
    scrollbar-width: none;
    -ms-overflow-style: none;
    -webkit-overflow-scrolling: touch;
    scroll-behavior: auto;
    scroll-snap-type: none;
}

.bespoke-collections .mobile-product-scroller::-webkit-scrollbar {
    display: none;
}

.bespoke-collections .scroller-container {
    display: flex;
    gap: 20px;
    width: max-content;
    padding: 0;
}

.bespoke-collections .scroller-item {
    flex: 0 0 auto;
    scroll-snap-align: none;
}

@media (min-width: 768px) {
    .bespoke-collections.d-none.d-md-block .watch-slider-viewport {
        padding: 0 20px;
    }

    .bespoke-collections.d-none.d-md-block .scroller-item {
        flex: 0 0 calc((100vw - 120px) / 4);
        width: calc((100vw - 120px) / 4);
        max-width: calc((100vw - 120px) / 4);
        min-width: calc((100vw - 120px) / 4);
    }
}

@media (max-width: 767.98px) {
    .carousel-section {
        margin-bottom: 0 !important;
        /* padding-top:20px !important; */
    }

    .bespoke-collections.d-md-none {
        margin-top: 0;
        padding-top: 0;
    }

    .bespoke-collections.d-md-none .watch-slider-viewport {
        padding: 0 10px;
    }

    .bespoke-collections.d-md-none .scroller-container {
        gap: 14px;
    }

    .bespoke-collections.d-md-none .scroller-item {
        flex: 0 0 86vw;
        width: 86vw;
        max-width: 86vw;
        min-width: 86vw;
    }
}
</style>
<section class="container">
<h4 class="section-title text-center">
  INTERNATIONAL JEWELLERY BRAND
</h4>
  <!-- ROW 1: Image Left | Content Right -->
  <div class="row align-items-center g-4 mb-5">
    <div class="col-md-6 text-center">
      <div class="fixed-media mx-auto">
        <img src="{{ asset('assets/f_assets/image/forever.jpg') }}"
             alt="Hasht Collection" class="fixed-media__img">
      </div>
    </div>

    <div class="col-md-6">
      <div class="hero-card">
        <div class="hero-content">
          <h2 class="hero-title">FOREVERMARK</h2>
          <p class="hero-subtitle">
           Every De Beers Forevermark diamond undergoes a journey of rigorous selection. Our unique inscription is an assurance that every De Beers Forevermark diamond meets the exceptional standards of beauty, rarity and is responsibly sourced
          </p>
          <!-- <a href="#" class="hero-btn">DISCOVER</a> -->
          <a href="{{ url('/forevermark') }}" class="hero-btn">DISCOVER</a>
        </div>
      </div>
    </div>
  </div>

  <!-- ROW 2: Content Left | Image Right -->
  <div class="row align-items-center g-4">
    <div class="col-md-6 order-2 order-md-1">
      <div class="hero-card hero-card--alt">
        <div class="hero-content">
          <h2 class="hero-title">FARAH KHAN</h2>
          <p class="hero-subtitle">
            “I see myself as an alchemist that captures the moments in my life and transforms them into beautiful objects of art.”
FARAH KHAN
          </p>
          <a href="/collections/farah-khan" class="hero-btn">DISCOVER</a>
        </div>
      </div>
    </div>

    <div class="col-md-6 text-center order-1 order-md-2">
      <div class="fixed-media mx-auto">
        <img src="{{ asset('assets/f_assets/image/farah.jpg') }}"
             alt="Hasht Collection" class="fixed-media__img">
      </div>
    </div>
  </div>
</section>
<section class="home-brands watch-brands-section">
  <h4 class="section-title text-center">
    INTERNATIONAL WATCH BRAND
  </h4>

<style>
.home-brands .brand-grid {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    align-items: stretch;
    gap: 40px;
    max-width: 1400px;
    margin: 0 auto;
    padding: 0 16px;
}

.home-brands .brand-item {
    display: flex;
    justify-content: center;
    align-items: center;
    position: relative;
    padding: 24px;
    text-decoration: none;
    background: #fff;
    box-sizing: border-box;
}

.home-brands .brand-item::before,
.home-brands .brand-item::after {
    content: "";
    position: absolute;
    inset: 0;
    border: 2px solid transparent;
    transition: all 0.5s ease;
    pointer-events: none;
}

.home-brands .brand-item::before {
    border-top-color: #c8a46a;
    border-bottom-color: #c8a46a;
    transform: scaleX(0);
    transform-origin: center;
}

.home-brands .brand-item::after {
    border-left-color: #c8a46a;
    border-right-color: #c8a46a;
    transform: scaleY(0);
    transform-origin: center;
}

.home-brands .brand-item:hover::before {
    transform: scaleX(1);
}

.home-brands .brand-item:hover::after {
    transform: scaleY(1);
}

.home-brands .brand-item img {
    width: 100%;
    max-width: 252px;
    height: auto;
    max-height: 180px;
    object-fit: contain;
    object-position: center center;
    background: transparent;
    padding: 0;
    transition: transform 0.3s ease;
    display: block;
}

.home-brands .brand-item:hover img {
    transform: scale(1.06);
}

/* Desktop: exactly 4 per row → 19 logos = 4+4+4+4+3 (last 3 centered) */
@media (min-width: 992px) {
    .home-brands .brand-item {
        flex: 0 0 calc((100% - 120px) / 4);
        width: calc((100% - 120px) / 4);
        min-height: 256px;
    }
}

@media (min-width: 768px) and (max-width: 991.98px) {
    .home-brands .brand-item {
        flex: 0 0 calc((100% - 80px) / 3);
        width: calc((100% - 80px) / 3);
        min-height: 220px;
        padding: 20px;
    }

    .home-brands .brand-item img {
        max-height: 150px;
    }
}

@media (max-width: 767.98px) {
    .home-brands .brand-grid {
        gap: 16px;
        padding: 0 10px;
    }

    .home-brands .brand-item {
        flex: 0 0 calc((100% - 16px) / 2);
        width: calc((100% - 16px) / 2);
        min-height: 168px;
        padding: 14px;
    }

    .home-brands .brand-item img {
        max-width: 100%;
        max-height: 120px;
    }
}
</style>

@php
$brands = [
    ['name' => 'Bovet', 'slug' => 'bovet', 'img' => 'Bovet.avif'],
    ['name' => 'Louis Moinet', 'slug' => 'louis-moinet', 'img' => 'LM.avif'],
    ['name' => 'Franck Muller', 'slug' => 'franck-muller', 'img' => 'FM.avif'],
    ['name' => 'Corum', 'slug' => 'corum', 'img' => 'Corum.avif'],
    ['name' => 'Artya', 'slug' => 'Artya', 'img' => 'Artya.avif'],
    ['name' => 'Chronoswiss', 'slug' => 'chronoswiss', 'img' => 'Chronoswiss.avif'],
    ['name' => 'Cuervo-Y-Sobrinos', 'slug' => 'cuervo-y-sobrinos', 'img' => 'CYS.avif'],
    ['name' => 'Favre Leuba', 'slug' => 'favre-leuba', 'img' => 'favre-leuba.avif'],
    ['name' => 'Perrelet', 'slug' => 'perrelet', 'img' => 'Perrelet.avif'],
    ['name' => 'Maurice Lacroix', 'slug' => 'maurice-lacroix', 'img' => 'Maurice Lacroix.avif'],
    ['name' => 'Louis Erard', 'slug' => 'louis-erard', 'img' => 'Louis Erard.avif'],
    ['name' => 'Rado', 'slug' => 'rado', 'img' => 'Rado.avif'],
    ['name' => 'Tissot', 'slug' => 'tissot', 'img' => 'Tisot.avif'],
    ['name' => 'EPOS', 'slug' => 'epos', 'img' => 'EPOS.avif'],
    ['name' => 'Armand Nicolet', 'slug' => 'armand-nicolet', 'img' => 'Armand Nicolet.avif'],
    ['name' => 'Garaham', 'slug' => 'graham', 'img' => 'Garaham.avif'],
    ['name' => 'Versace', 'slug' => 'versace', 'img' => 'Versace.avif'],
    ['name' => 'Feregamo', 'slug' => 'ferragamo', 'img' => 'Feregamo.avif'],
    ['name' => 'Swiss Military', 'slug' => 'swiss-military', 'img' => 'Swiss Military.avif'],
];
@endphp

<div class="brand-grid">
@foreach ($brands as $brand)
    <a class="brand-item" href="{{ route('subcategory', ['subcategory' => $brand['slug']]) }}">
        <img
            src="{{ asset('assets/f_assets/image/watch logo new/'.$brand['img']) }}"
            data-hover="{{ asset('assets/f_assets/image/watch logo new/hover/'.$brand['img']) }}"
            alt="{{ $brand['name'] }} logo"
            loading="lazy">
    </a>
@endforeach
</div>

<script>
document.querySelectorAll('.home-brands .brand-item img').forEach(function(img) {
    const original = img.src;
    const hover = img.dataset.hover;
    if (hover) { const pre = new Image(); pre.src = hover; }

    img.addEventListener('mouseenter', function() {
        if (hover) img.src = hover;
    });

    img.addEventListener('mouseleave', function() {
        img.src = original;
    });
});
</script>

</section>
<style>
/* 993px – 1199px */
@media (min-width: 993px) and (max-width: 1199px) {

  /* Remove left spacing */
  .container,
  .container-lg {
    padding-left: 0 !important;
  }

  .row {
    margin-left: 0 !important;
  }

  .row > [class*="col-"] {
    padding-left: 0 !important;
  }

  /* Make image full width */
  .hero-image img,
  .hero-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
  }

}
.fixed-media{
  width: 520px;     /* fixed width */
  height: 520px;    /* fixed height */
  overflow: hidden;
  display: flex;
  align-items: center;
  justify-content: center;
}

.fixed-media__img{
  width: 100%;
  height: 100%;
  object-fit: cover;  /* no distortion */
  display: block;
}

/* Content box */
.hero-card{
  display: flex;
  align-items: center;
  justify-content: center;
  padding: 48px 24px;
}

/* .hero-card--alt{
  background: #f7f7f7;
} */

.hero-content{
  width: min(520px, 100%);
  text-align: center;
  padding: 24px 18px;
}

.hero-title{
  font-family: "Cormorant Garamond", serif;
  font-size: clamp(28px, 2.6vw, 44px);
  font-weight: 500;
  margin: 0 0 14px;
  color: #111;
}

.hero-subtitle{
  font-family: "Montserrat", sans-serif;
  font-size: 13px;
  line-height: 1.8;
  letter-spacing: .3px;
  color: #555;
  margin: 0 0 28px;
}

.hero-btn{
  display: inline-flex;
  align-items: center;
  justify-content: center;
  min-width: 240px;
  height: 48px;
  padding: 0 24px;
  border: 1px solid #caa55a;
  color: #6c5526;
  text-decoration: none;
  font-size: 12px;
  letter-spacing: 2px;
  font-family: "Montserrat", sans-serif;
  text-transform: uppercase;
  transition: all .25s ease;
}

.hero-btn:hover{
  background: rgba(202,165,90,.08);
  transform: translateY(-1px);
}

/* Responsive */
@media (max-width: 992px){
  .fixed-media{
    width: 100%;
    max-width: 520px;
    height: 420px; /* smaller on mobile */
  }
}
@media (max-width: 768px) {

  .fixed-media {
    width: 100%;
    height: auto;        /* remove fixed height */
    overflow: visible;   /* prevent cutting */
  }

  .fixed-media__img {
    width: 100%;
    height: auto;        /* auto height keeps ratio */
    object-fit: contain; /* show full image */
  }

}
</style>
@endsection
<script>
document.addEventListener('DOMContentLoaded', function() {
    function initializeArrowScroller(sectionClass) {
        document.querySelectorAll(sectionClass).forEach(function(section) {
            const scroller = section.querySelector('.mobile-product-scroller');
            const items = section.querySelectorAll('.scroller-item');

            if (!scroller || !items.length) {
                return;
            }

            let isAnimating = false;
            let isMouseDown = false;
            let mouseStartX = 0;
            let mouseStartScrollLeft = 0;
            let startX = 0;
            let startY = 0;
            let isInteractingWithCarousel = false;

            const arrowPrevBtn = section.querySelector('.watch-scroller-arrow--prev');
            const arrowNextBtn = section.querySelector('.watch-scroller-arrow--next');
            const watchProgressEl = section.querySelector('.watch-progress');
            const watchProgressFill = section.querySelector('.watch-progress__fill');

            function isDesktopScrollerSection() {
                const isDesktopBespoke = scroller.closest('section.bespoke-collections.d-none.d-md-block');
                const isDesktopWatches = scroller.closest('section.watch');
                return !!(isDesktopBespoke || isDesktopWatches);
            }

            function getItemScrollTarget(item) {
                const maxScroll = Math.max(0, scroller.scrollWidth - scroller.clientWidth);
                const itemIndex = Array.from(items).indexOf(item);
                if (itemIndex === 0) {
                    return 0;
                }
                if (itemIndex === items.length - 1) {
                    const endAligned = item.offsetLeft + item.offsetWidth - scroller.clientWidth;
                    return Math.max(0, Math.min(maxScroll, endAligned));
                }
                return Math.max(0, Math.min(maxScroll, item.offsetLeft));
            }

            function smoothScrollTo(element, target) {
                isAnimating = true;
                const startLeft = element.scrollLeft;
                const distance = target - startLeft;
                const duration = 500;
                let startTime = null;

                function easeInOutCubic(t) {
                    return t < 0.5 ? 4 * t * t * t : 1 - Math.pow(-2 * t + 2, 3) / 2;
                }

                function step(timestamp) {
                    if (startTime === null) startTime = timestamp;
                    const elapsed = timestamp - startTime;
                    const progress = Math.min(elapsed / duration, 1);
                    const eased = easeInOutCubic(progress);
                    element.scrollLeft = startLeft + distance * eased;
                    if (elapsed < duration) {
                        requestAnimationFrame(step);
                    } else {
                        element.scrollLeft = target;
                        isAnimating = false;
                        updateArrowButtons();
                        updateWatchProgress();
                    }
                }

                requestAnimationFrame(step);
            }

            function scrollWatchTo(target) {
                if (isAnimating) return;
                smoothScrollTo(scroller, target);
            }

            function getItemStep() {
                if (items.length >= 2) {
                    const step = items[1].offsetLeft - items[0].offsetLeft;
                    return step > 0 ? step : items[0].getBoundingClientRect().width;
                }
                return items[0].getBoundingClientRect().width;
            }

            function getNearestIndex() {
                const step = getItemStep();
                if (!step || step <= 0) return 0;
                const rawIndex = Math.round(scroller.scrollLeft / step);
                return Math.max(0, Math.min(items.length - 1, rawIndex));
            }

            function updateWatchProgress() {
                if (!watchProgressFill || !watchProgressEl) return;

                const maxScroll = Math.max(0, scroller.scrollWidth - scroller.clientWidth);
                if (maxScroll <= 2 || items.length <= 1) {
                    watchProgressEl.classList.add('is-hidden');
                    return;
                }

                watchProgressEl.classList.remove('is-hidden');
                const segmentPct = 100 / items.length;
                const progress = scroller.scrollLeft / maxScroll;
                watchProgressFill.style.width = segmentPct + '%';
                watchProgressFill.style.left = (progress * (100 - segmentPct)) + '%';
            }

            function updateArrowButtons() {
                if (!arrowPrevBtn || !arrowNextBtn || !items.length) return;

                const maxScroll = Math.max(0, scroller.scrollWidth - scroller.clientWidth);
                const noScroll = maxScroll <= 2 || items.length <= 1;

                arrowPrevBtn.disabled = noScroll || scroller.scrollLeft <= 5;
                arrowNextBtn.disabled = noScroll || scroller.scrollLeft >= maxScroll - 5;
            }

            function scrollToItemByIndex(itemIndex) {
                const bounded = Math.max(0, Math.min(items.length - 1, itemIndex));
                const targetItem = items[bounded];
                if (!targetItem) return;

                scrollWatchTo(getItemScrollTarget(targetItem));

                setTimeout(() => {
                    updateArrowButtons();
                    updateWatchProgress();
                }, 520);
            }

            function resetScrollerPosition() {
                scroller.scrollLeft = 0;
            }

            function refreshScrollerUi() {
                updateArrowButtons();
                updateWatchProgress();
            }

            if (arrowPrevBtn && arrowNextBtn) {
                arrowPrevBtn.addEventListener('click', function() {
                    scrollToItemByIndex(getNearestIndex() - 1);
                });
                arrowNextBtn.addEventListener('click', function() {
                    scrollToItemByIndex(getNearestIndex() + 1);
                });
            }

            scroller.addEventListener('mousedown', function(e) {
                if (!isDesktopScrollerSection()) return;

                isMouseDown = true;
                mouseStartX = e.clientX;
                mouseStartScrollLeft = scroller.scrollLeft;
                scroller.style.cursor = 'grabbing';
                e.preventDefault();
            });

            scroller.addEventListener('mousemove', function(e) {
                if (!isMouseDown) return;
                e.preventDefault();
                scroller.scrollLeft = mouseStartScrollLeft + (mouseStartX - e.clientX) * 2;
            });

            scroller.addEventListener('mouseup', function() {
                isMouseDown = false;
                scroller.style.cursor = 'grab';
            });

            scroller.addEventListener('mouseleave', function() {
                isMouseDown = false;
                scroller.style.cursor = 'grab';
            });

            if (isDesktopScrollerSection()) {
                scroller.style.cursor = 'grab';
            }

            scroller.addEventListener('touchstart', function(e) {
                isInteractingWithCarousel = !!e.target.closest('.carousel');
                startX = e.touches[0].clientX;
                startY = e.touches[0].clientY;
            }, { passive: true });

            scroller.addEventListener('touchmove', function(e) {
                if (!isInteractingWithCarousel) return;
                const currentX = e.touches[0].clientX;
                const currentY = e.touches[0].clientY;
                const diffX = Math.abs(currentX - startX);
                const diffY = Math.abs(currentY - startY);
                if (diffX > diffY && diffX > 10) {
                    e.preventDefault();
                    e.stopPropagation();
                }
            }, { passive: false });

            scroller.addEventListener('touchend', function() {
                isInteractingWithCarousel = false;
                startX = 0;
                startY = 0;
            }, { passive: true });

            let scrollRAF = null;
            scroller.addEventListener('scroll', function() {
                if (scrollRAF) cancelAnimationFrame(scrollRAF);
                scrollRAF = requestAnimationFrame(() => {
                    refreshScrollerUi();
                    scrollRAF = null;
                });
            });

            resetScrollerPosition();
            refreshScrollerUi();

            let resizeTimer = null;
            window.addEventListener('resize', function() {
                if (resizeTimer) clearTimeout(resizeTimer);
                resizeTimer = setTimeout(function() {
                    resetScrollerPosition();
                    refreshScrollerUi();
                }, 150);
            });

            window.addEventListener('load', function() {
                resetScrollerPosition();
                refreshScrollerUi();
            });
        });
    }

    initializeArrowScroller('section.watch');
    initializeArrowScroller('section.bespoke-collections');
    

    // Brand banner carousel (single init — no duplicate data-bs-* on HTML)
    const carouselEl = document.getElementById('carouselExampleRide');
    if (carouselEl && window.bootstrap && bootstrap.Carousel) {
        new bootstrap.Carousel(carouselEl, {
            interval: 5000,
            ride: 'carousel',
            wrap: true,
            pause: false,
            keyboard: false
        });
    }
});
</script>
