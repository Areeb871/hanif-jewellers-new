@extends('public.layouts.header_black_white_fixed')

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

/* Banner fills the screen under the header. Extra image is cropped equally from top and bottom. */
#carouselExampleRide {
  --brand-banner-height: calc(100dvh - var(--megaTop, 72px));
  padding: 0;
  width: 100%;
  height: var(--brand-banner-height);
  max-height: var(--brand-banner-height);
  background: #000;
  overflow: hidden;
}

#carouselExampleRide .carousel-inner,
#carouselExampleRide .carousel-item,
#carouselExampleRide .hero-slide,
#carouselExampleRide .hero-slide picture {
  width: 100%;
  height: 100%;
}

#carouselExampleRide .carousel-inner {
  position: relative;
  height: var(--brand-banner-height);
}

#carouselExampleRide .carousel-item {
  height: var(--brand-banner-height);
}

#carouselExampleRide .hero-slide {
  width: 100%;
  height: 100%;
  background: #000;
}

#carouselExampleRide .hero-slide picture {
  width: 100%;
  height: 100%;
  display: block;
}

#carouselExampleRide .hero-slide img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  object-position: center center;
  display: block;
}

@media (min-width: 768px) {
  section.bespoke-collections.d-none.d-md-block:not(.bespoke-showcase) {
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
  height: 100%;
  overflow: hidden;
  background: #000;
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
  margin: 0;
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
/* Hero fills the viewport under the header so Discover More stays on screen */
.custom-banner {
    position: relative;
    width: 100%;
    height: calc(100dvh - var(--hj-header-h, 0px));
    margin: 0;
    padding: 0;
    overflow: hidden;
    background: #000;
}

.custom-banner-video {
    display: block;
    width: 100%;
    height: 100%;
    max-width: none;
    margin: 0;
    object-fit: cover;
    object-position: center center;
}

.home-hero-mobile {
    position: relative;
    width: 100%;
    height: calc(100dvh - var(--hj-header-h, 0px));
    overflow: hidden;
    background: #000;
}

/* Video stays pinned until the product cards have covered the whole frame */
.home-hero-scroll {
    position: relative;
}

.home-hero-runway {
    height: var(--hero-scroll, 70vh);
    pointer-events: none;
}

.home-hero-scroll > .custom-banner,
.home-hero-scroll > .home-hero-mobile {
    position: sticky;
    top: var(--hj-header-h, 0px);
    z-index: 1;
    backface-visibility: hidden;
}

.home-hero-scroll .custom-banner-video,
.home-hero-scroll .mobileStackVideo {
    transform: translateZ(0);
}

/* Discover More scrolls up with the page/cards — not pinned to sticky video */
.home-hero-scroll > .custom-banner-btn,
.home-hero-scroll > .custom-banner-btn-new {
    position: absolute;
    top: calc(var(--hero-scroll, 70vh) - 70px);
    bottom: auto;
    left: 50%;
    transform: translateX(-50%);
    z-index: 2;
}

.home-hero-scroll + .watch,
.home-hero-scroll ~ section {
    position: relative;
    z-index: 3;
}

.home-hero-scroll + .watch {
    margin-top: calc(var(--hero-scroll, 70vh) * -1);
    background-color: #f6f3ee;
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
  width: 88%;
  height: 78%;
  padding: 38px 28px;
  background: rgba(245,245,245,0.96);

  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%) scale(0.9);

  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  box-sizing: border-box;

  z-index: 3;
  transition: transform .45s ease;
}

/* Logo ALWAYS inside box */
.lux-logo{
  width: 100%;
  height: 100%;
  max-width: 100%;
  max-height: 100%;
  object-fit: contain;
  object-position: center;
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

/* Mobile: overlay stays visible so logo + tagline can be read without hover */
@media (max-width: 767px){
  .lux-hover{ opacity: .85; }
  .lux-box{
    width: 90%;
    height: 80%;
    padding: 32px 20px;
    transform: translate(-50%, -50%) scale(1);
  }
  .lux-logo{ max-width: 90%; max-height: 100%; }
  .lux-card::before, .lux-card::after{ inset: 10px; opacity: 1; }
  .lux-card::before{ transform: scaleX(1); }
  .lux-card::after{ transform: scaleY(1); }
  .lux-img{ transform: scale(1.03); }
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

/*section.watch .scroller-container {*/
/*    display: flex;*/
/*    width: max-content;*/
/*    padding-inline: 16px;*/
/*    gap: 10px;*/
/*}*/

section.watch .scroller-container {
    display: flex;
    width: max-content;
    padding-inline: 16px;
    gap: 10px;
    margin-top: 16px;
    margin-bottom: 16px;
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
    top: 0;
    bottom: 0;
    z-index: 30;
    width: 66px;
    height: auto;
    border: 0;
    border-radius: 0;
    background: transparent;
    color: #2a2a2a;
    box-shadow: none;
    display: flex !important;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    padding: 0;
    opacity: 0;
    visibility: visible;
    pointer-events: none;
    overflow: hidden;
    transition: opacity 0.22s ease-out;
    backdrop-filter: none;
    -webkit-backdrop-filter: none;
    isolation: isolate;
}

/* Frosted control matched to the supplied Apple UI reference. */
section.watch .watch-scroller-arrow::before,
.bespoke-collections .watch-scroller-arrow::before {
    content: "";
    position: absolute;
    top: 0;
    bottom: 0;
    left: 50%;
    width: 100%;
    height: 100%;
    transform: translateX(-50%);
    z-index: 0;
    box-sizing: border-box;
    background: rgba(151, 181, 196, 0.1);
    border: none;
    border-radius: 24px;
    box-shadow: 0 3px 12px rgba(0, 0, 0, 0.06);
    backdrop-filter: blur(12px) saturate(112%);
    -webkit-backdrop-filter: blur(12px) saturate(112%);
    pointer-events: none;
    transition: background 0.3s ease, box-shadow 0.3s ease, backdrop-filter 0.3s ease,
                transform 0.3s cubic-bezier(.2,.8,.2,1);
}

/* Soft glass sheen; intentionally restrained like the reference. */
section.watch .watch-scroller-arrow::after,
.bespoke-collections .watch-scroller-arrow::after {
    content: "";
    position: absolute;
    top: 1px;
    bottom: 1px;
    left: 50%;
    width: calc(100% - 2px);
    height: auto;
    z-index: 1;
    border-radius: 23px;
    transform: translateX(-50%);
    background: linear-gradient(145deg,
        rgba(255, 255, 255, 0.07),
        rgba(255, 255, 255, 0) 58%);
    opacity: .65;
    pointer-events: none;
    transition: opacity .3s ease, transform .3s cubic-bezier(.2,.8,.2,1);
}

/* Fade the inner edge into the card so the glass has no visible seam. */
section.watch .watch-scroller-arrow--prev::before,
.bespoke-collections .watch-scroller-arrow--prev::before,
.bespoke-collections .watch-scroller-arrow--prev::after,
section.watch .watch-scroller-arrow--prev::after {
    border-radius: 0 24px 24px 0;
}

section.watch .watch-scroller-arrow--next::before,
.bespoke-collections .watch-scroller-arrow--next::before,
.bespoke-collections .watch-scroller-arrow--next::after,
section.watch .watch-scroller-arrow--next::after {
    border-radius: 24px 0 0 24px;
}

section.watch .watch-scroller-arrow--prev::before,
section.watch .watch-scroller-arrow--prev::after,
.bespoke-collections .watch-scroller-arrow--prev::before,
.bespoke-collections .watch-scroller-arrow--prev::after {
    -webkit-mask-image: linear-gradient(to right,
        #000 0%, #000 38%, rgba(0,0,0,.72) 68%, transparent 100%);
    mask-image: linear-gradient(to right,
        #000 0%, #000 38%, rgba(0,0,0,.72) 68%, transparent 100%);
}

section.watch .watch-scroller-arrow--next::before,
section.watch .watch-scroller-arrow--next::after,
.bespoke-collections .watch-scroller-arrow--next::before,
.bespoke-collections .watch-scroller-arrow--next::after {
    -webkit-mask-image: linear-gradient(to left,
        #000 0%, #000 38%, rgba(0,0,0,.72) 68%, transparent 100%);
    mask-image: linear-gradient(to left,
        #000 0%, #000 38%, rgba(0,0,0,.72) 68%, transparent 100%);
}

section.watch .watch-scroller-arrow .arrow-icon,
.bespoke-collections .watch-scroller-arrow .arrow-icon {
    position: relative;
    z-index: 2;
    color: rgba(0, 0, 0, 0.86);
    filter: none;
    transform: scale(1.08);
    transition: none;
}

section.watch .watch-slider-viewport:hover .watch-scroller-arrow:not(:disabled),
section.watch .watch-slider-viewport:focus-within .watch-scroller-arrow:not(:disabled),
.bespoke-collections .watch-slider-viewport:hover .watch-scroller-arrow:not(:disabled),
.bespoke-collections .watch-slider-viewport:focus-within .watch-scroller-arrow:not(:disabled) {
    opacity: 1;
    pointer-events: auto;
}

/* The watch cards have 16px vertical margins inside their viewport. */
section.watch .watch-scroller-arrow {
    top: 16px;
    bottom: 16px;
}

section.watch .watch-scroller-arrow--prev,
.bespoke-collections .watch-scroller-arrow--prev {
    left: 0;
}

section.watch .watch-scroller-arrow--next,
.bespoke-collections .watch-scroller-arrow--next {
    right: 0;
}

section.watch .watch-scroller-arrow .arrow-left svg,
.bespoke-collections .watch-scroller-arrow .arrow-left svg {
    transform: rotate(180deg);
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
        padding: 22px 16px 14px;
    }

    .bespoke-collections.d-md-none .watch-progress.is-hidden {
        visibility: hidden;
    }

    .bespoke-collections.d-md-none .watch-progress__track {
        width: 46%;
        min-width: 140px;
        max-width: 200px;
        height: 3px;
        background: #e5e7eb;
        border-radius: 999px;
    }

    .bespoke-collections.d-md-none .watch-progress__fill {
        background: #0d2a39;
        border-radius: 999px;
    }
}

@media (min-width: 768px) and (max-width: 991.98px) {
    .bespoke-collections .watch-scroller-arrow {
        width: calc((100vw - 120px) / 18);
    }
}

@media (min-width: 992px) {
    section.watch .watch-scroller-arrow {
        width: 75px;
        height: auto;
    }

    .bespoke-collections .watch-scroller-arrow {
        width: calc((100vw - 120px) / 18);
        height: auto;
    }

    section.watch .watch-scroller-arrow--prev,
    .bespoke-collections .watch-scroller-arrow--prev {
        left: 0;
    }

    section.watch .watch-scroller-arrow--next,
    .bespoke-collections .watch-scroller-arrow--next {
        right: 0;
    }
}

@media (min-width: 1200px) and (max-width: 1365.98px) {
    section.watch .watch-scroller-arrow {
        width: 80px;
    }
}

@media (min-width: 1366px) and (max-width: 1919.98px) {
    section.watch .watch-scroller-arrow {
        width: 84px;
    }
}

@media (min-width: 1920px) {
    section.watch .watch-scroller-arrow {
        width: 88px;
    }
}

section.watch .addToCartProductDetailsTop .carousel .carousel-item img,
section.watch .addToCartProductDetailsTop .product-image {
    max-width: 100%;
    max-height: 100%;
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

/* Homepage product-card arrows: readable on light or dark artwork. */
section.watch .addToCartProductDetailsTop .carousel-control-prev,
section.watch .addToCartProductDetailsTop .carousel-control-next {
    display: flex !important;
    align-items: center;
    justify-content: center;
    top: 50%;
    bottom: auto;
    width: 38px;
    height: 96px;
    border: none;
    border-radius: 4px;
    background: transparent;
    box-shadow: none;
    visibility: hidden;
    opacity: 0 !important;
    pointer-events: none !important;
    transform: translateY(-50%);
    transition: opacity 0.2s ease, visibility 0.2s ease;
    backdrop-filter: none;
    -webkit-backdrop-filter: none;
}

section.watch .addToCartProductDetailsTop:hover .carousel-control-prev,
section.watch .addToCartProductDetailsTop:hover .carousel-control-next,
section.watch .addToCartProductDetailsTop:focus-within .carousel-control-prev,
section.watch .addToCartProductDetailsTop:focus-within .carousel-control-next {
    display: flex !important;
    visibility: visible;
    opacity: 0.92 !important;
    pointer-events: auto !important;
}

section.watch .addToCartProductDetailsTop .carousel-control-prev {
    left: 8px;
}

section.watch .addToCartProductDetailsTop .carousel-control-next {
    right: 8px;
}

section.watch .addToCartProductDetailsTop .carousel-control-prev:hover,
section.watch .addToCartProductDetailsTop .carousel-control-next:hover {
    background: transparent;
    opacity: 1 !important;
}

section.watch .addToCartProductDetailsTop .carousel-control-prev-icon,
section.watch .addToCartProductDetailsTop .carousel-control-next-icon {
    width: 10px;
    height: 10px;
    border: none;
    border-radius: 0;
    background-color: transparent;
    background-image: none;
    box-shadow: none;
    backdrop-filter: none;
    -webkit-backdrop-filter: none;
}

section.watch .addToCartProductDetailsTop .carousel-control-prev-icon {
    border-right: 1.5px solid #9a9a9a;
    border-bottom: 1.5px solid #9a9a9a;
    transform: rotate(135deg);
}

section.watch .addToCartProductDetailsTop .carousel-control-next-icon {
    border-right: 1.5px solid #9a9a9a;
    border-bottom: 1.5px solid #9a9a9a;
    transform: rotate(-45deg);
}

/* Keep the complete product artwork visible, including on hover. */
section.watch .addToCartProductDetailsTop .carousel-item img,
section.watch .addToCartProductDetailsTop:hover .carousel-item img,
section.watch .addToCartProductDetailsTop .product-image,
section.watch .addToCartProductDetailsTop:hover .product-image {
    object-fit: contain !important;
    object-position: center !important;
    transform: none !important;
}

@media (max-width: 767.98px) {
    section.watch .addToCartProductDetailsTop .carousel-control-prev,
    section.watch .addToCartProductDetailsTop .carousel-control-next {
        width: 34px;
        height: 82px;
    }

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

    section.watch .watch-progress {
        display: flex;
        justify-content: center;
        padding: 22px 16px 14px;
    }

    section.watch .watch-progress__track {
        width: 46%;
        min-width: 140px;
        max-width: 200px;
    }
}

section.watch .watch-progress,
.bespoke-collections .watch-progress {
    display: flex;
    justify-content: center;
    padding: 28px 16px 22px;
}

section.watch .watch-progress.is-hidden,
.bespoke-collections .watch-progress.is-hidden {
    visibility: hidden;
}

section.watch .watch-progress__track,
.bespoke-collections .watch-progress__track {
    position: relative;
    width: 25%;
    min-width: 160px;
    max-width: 280px;
    height: 3px;
    background: #e5e7eb;
    overflow: hidden;
    border-radius: 999px;
}

section.watch .watch-progress__fill,
.bespoke-collections .watch-progress__fill {
    position: absolute;
    top: 0;
    height: 100%;
    background: #0d2a39;
    border-radius: 999px;
    transition: none;
    will-change: left, width;
}

@media (max-width: 767.98px) {
    section.watch .watch-progress__track,
    .bespoke-collections .watch-progress__track {
        width: 46%;
        min-width: 140px;
        max-width: 200px;
    }
}

@media (min-width: 768px) and (max-width: 991.98px) {
    section.watch .watch-progress__track,
    .bespoke-collections .watch-progress__track {
        width: 34%;
        min-width: 180px;
        max-width: 240px;
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

/* Same space above and below every section heading */
.section-title,
.bespoke-collections__title {
    font-family: "Argent CF", serif;
    font-size: clamp(28px, 3.3vw, 45px);
    font-weight: 300;
    margin: 0;
    padding: 80px 0;
    color: #111;
}

.watch-brands-section {
    padding: 0;
}

.watch-brands-section > .section-title {
    margin: 0;
    padding: 80px 0;
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

<!--<section class="custom-banner d-none d-md-block position-relative">-->
<!-- <img-->
<!--        src="{{ asset('assets/f_assets/image/pak-banner.jpeg') }}"-->
<!--        alt="Jeweller of the Nation"-->
<!--        class="custom-banner-video"-->
<!--        width="3840"-->
<!--        height="2160"-->
<!--        fetchpriority="high"-->
<!--    >-->
<!--</section>-->



<div class="home-hero-scroll">
<section class="custom-banner d-none d-md-block">
    <video class="custom-banner-video" autoplay muted loop playsinline>
        <source src="{{ asset('assets/f_assets/image/homepage video/desktop ayeza.mp4') }}" type="video/mp4">
        Your browser does not support the video tag.
    </video>
</section>
<a href="/collections/nagar" class="custom-banner-btn d-none d-md-inline-block">{{ __('site.discover_more') }}</a>

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
        <a href="/collections/eid-par-sony-ki-choriyan" class="custom-banner-btn">{{ __('site.discover_more') }}</a>

</div>


</section> -->
<section class="home-hero-mobile d-block d-md-none">
  <div class="mobileStackImgWrap">
  <video class="mobileStackVideo" autoplay muted loop playsinline preload="metadata">
    <source src="{{ asset('assets/f_assets/image/homepage video/mobile ayeza.mp4') }}" type="video/mp4">
  </video>
  
  
  
  <!-- <img-->
  <!--  class="mobileStackVideo"-->
  <!--  src="{{ asset('assets/f_assets/image/homepage_2_banner/fm-mob-view.jpg') }}"-->
  <!--  alt="Franck Muller"-->
  <!--  fetchpriority="high"-->
  <!-->-->
 <!-- <img
  class="mobileStackVideo"
  src="{{ asset('assets/f_assets/image/misterio_data/misterio_mobile.jpeg') }}"
  alt="Divine Treasure"
  loading="lazy"
/> -->

  </div>
</section>
<a href="/collections/nagar" class="custom-banner-btn-new d-inline-block d-md-none">{{ __('site.discover_more') }}</a>
    <div class="home-hero-runway" aria-hidden="true"></div>
</div>
    <!-- Watches / Featured Products Scroller (unified responsive) -->
    <section class="onlineStore watch" style="background-color:#f6f3ee;">
        <div class="watch-slider-viewport">
            <button type="button" class="watch-scroller-arrow watch-scroller-arrow--prev" aria-label="{{ __('site.prev_products') }}" disabled>
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
                                @include('public.partials.product-card-new', [
                                'product' => $product,
                                'storeContext' => strtolower(optional($product->category)->slug ?? '') !== 'watches',
                            ])
                        </div>
                    @endforeach
                </div>
            </div>
            <button type="button" class="watch-scroller-arrow watch-scroller-arrow--next" aria-label="{{ __('site.next_products') }}">
                <span aria-hidden="true" class="arrow-icon">
                    <svg viewBox="0 0 24 24" height="22" width="22" fill="currentColor">
                        <path d="M12.6 12L8.7 8.1C8.52 7.92 8.42 7.68 8.42 7.4C8.42 7.12 8.52 6.88 8.7 6.7C8.88 6.52 9.12 6.42 9.4 6.42C9.68 6.42 9.92 6.52 10.1 6.7L14.7 11.3C14.8 11.4 14.87 11.51 14.91 11.62C14.95 11.74 14.97 11.87 14.97 12C14.97 12.13 14.95 12.26 14.91 12.38C14.87 12.49 14.8 12.6 14.7 12.7L10.1 17.3C9.92 17.48 9.68 17.57 9.4 17.57C9.12 17.57 8.88 17.48 8.7 17.3C8.52 17.12 8.42 16.88 8.42 16.6C8.42 16.32 8.52 16.08 8.7 15.9L12.6 12Z"/>
                    </svg>
                </span>
            </button>
        </div>
        @if (count($products) > 1)
        <div class="watch-progress" aria-hidden="true">
            <div class="watch-progress__track">
                <div class="watch-progress__fill"></div>
            </div>
        </div>
        @endif
    </section>

    @php
    $brandBannerSlides = [
        ['alt' => 'Bovet', 'desktop' => 'assets/f_assets/image/homepage_2_banner/Bovet-homepage-banner.avif', 'mobile' => 'assets/f_assets/image/homepage_2_banner/Bovet-mob-homepage.webp'],

 ['alt' => 'Franck Muller', 'desktop' => 'assets/f_assets/image/homepage_2_banner/Home Page FM BAnner.jpg', 'mobile' => 'assets/f_assets/image/homepage_2_banner/FM-mob-homepage.webp'],
        ['alt' => 'Maurice Lacroix', 'desktop' => 'assets/f_assets/image/watches/ML-banner-index.jpeg', 'mobile' => 'assets/f_assets/image/homepage_2_banner/ML-mobile-view.webp'],
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
                <span class="visually-hidden">{{ __('site.previous') }}</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleRide" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">{{ __('site.next') }}</span>
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

    <section class="bespoke-collections bespoke-showcase">
        <div class="bespoke-showcase__info">
            <div class="bespoke-showcase__copy">
                <h2 class="bespoke-showcase__title">{{ __('site.bespoke_title') }}</h2>
                <p class="bespoke-showcase__text">{{ __('site.bespoke_text_1') }}</p>
                <p class="bespoke-showcase__text">{{ __('site.bespoke_text_2') }}</p>
                <p class="bespoke-showcase__text">{{ __('site.bespoke_text_3') }}</p>
            </div>
            @if (count($products_new) > 1)
            <div class="bespoke-showcase__dots bespoke-showcase__dots--side" role="tablist" aria-label="{{ __('site.bespoke_pages') }}"></div>
            @endif
        </div>

        <div class="watch-slider-viewport bespoke-showcase__stage">
            <button type="button" class="watch-scroller-arrow watch-scroller-arrow--prev" aria-label="{{ __('site.prev_collections') }}" disabled>
                <svg viewBox="0 0 10 18" width="10" height="18" fill="none" aria-hidden="true">
                    <path d="M8.4 1.25L1.7 8.38C1.51 8.61 1.37 8.89 1.37 9.13C1.37 9.36 1.51 9.64 1.7 9.87L8.4 17" stroke="currentColor" stroke-width="1.2"/>
                </svg>
            </button>
            <div class="mobile-product-scroller">
                <div class="scroller-container">
                    @foreach ($products_new as $key => $product)
                    <div class="scroller-item">
                        <a href="{{ url('collections/' . ($bespokeCollectionLinks[$loop->index] ?? $product->slug)) }}" class="bespoke-showcase__card">
                            <span class="bespoke-showcase__media">
                                <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" loading="lazy">
                            </span>
                            <span class="bespoke-showcase__name">{{ $product->name }}</span>
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>
            <button type="button" class="watch-scroller-arrow watch-scroller-arrow--next" aria-label="{{ __('site.next_collections') }}">
                <svg viewBox="0 0 10 18" width="10" height="18" fill="none" aria-hidden="true">
                    <path d="M1.6 1.25L8.3 8.38C8.49 8.61 8.63 8.89 8.63 9.13C8.63 9.36 8.49 9.64 8.3 9.87L1.6 17" stroke="currentColor" stroke-width="1.2"/>
                </svg>
            </button>
        </div>

        @if (count($products_new) > 1)
        <div class="bespoke-showcase__dots bespoke-showcase__dots--bottom" role="tablist" aria-label="{{ __('site.bespoke_pages') }}"></div>
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

.bespoke-showcase {
    background: #fff;
    color: #0d2a39;
    padding: 80px 0 0;
}

.bespoke-showcase__info {
    flex: 1 1 100%;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    gap: 28px;
    padding: 0 36px 0 40px;
}

.bespoke-showcase__copy {
    width: fit-content;
    max-width: 100%;
}

.bespoke-showcase__title {
    margin: 0 0 48px;
    padding: 0;
    width: max-content;
    max-width: none;
    font-family: "Argent CF", Georgia, serif;
    font-size: 41px;
    font-weight: 600;
    line-height: 1.2;
    letter-spacing: 1px;
    text-transform: none;
    white-space: nowrap;
    color: #0d2a39;
    text-align: left;
}

.bespoke-showcase__text {
    margin: 0;
    width: 0;
    min-width: 100%;
    max-width: 100%;
    font-family: "Poppins", sans-serif;
    font-size: 14px;
    font-weight: 300;
    line-height: 1.55;
    letter-spacing: normal;
    color: #868686;
    text-align: justify;
    white-space: normal;
    word-break: normal;
    overflow-wrap: break-word;
}

.bespoke-showcase__text + .bespoke-showcase__text {
    margin-top: 14px;
}

.bespoke-showcase__dots {
    display: flex;
    align-items: center;
    gap: 8px;
    min-height: 18px;
}

.bespoke-showcase__dots--side {
    display: none;
}

.bespoke-showcase__dots--bottom {
    display: none;
}

.bespoke-showcase__dot {
    width: 8px;
    height: 8px;
    padding: 0;
    border: 0;
    border-radius: 50%;
    background: #d5d5d5;
    cursor: pointer;
}

.bespoke-showcase__dot.is-active {
    background: #0d2a39;
}

.bespoke-showcase__stage {
    position: relative;
    flex: 1 1 100%;
    min-width: 0;
}

.bespoke-showcase .mobile-product-scroller {
    width: 100%;
    background: #fff;
    container-type: inline-size;
}

.bespoke-showcase .scroller-container {
    gap: 30px;
    padding: 0;
    margin: 0;
}

.bespoke-showcase .scroller-item {
    flex: 0 0 calc((100cqi - 30px) / 2);
    width: calc((100cqi - 30px) / 2);
    max-width: none;
    min-width: 0;
}

.bespoke-showcase__card {
    display: block;
    color: inherit;
    text-decoration: none;
}

.bespoke-showcase__media {
    display: block;
    aspect-ratio: 1 / 1;
    background: #fff;
    overflow: hidden;
}

.bespoke-showcase__media img {
    width: 100%;
    height: 100%;
    object-fit: contain;
    display: block;
}

.bespoke-showcase__name {
    display: block;
    margin-top: 18px;
    font-family: "Argent CF", Georgia, serif;
    font-size: 15px;
    font-weight: 400;
    line-height: 1.4;
    letter-spacing: 1px;
    text-transform: uppercase;
    text-align: center;
    color: #0d2a39;
}

.bespoke-showcase .watch-scroller-arrow {
    top: 34%;
    bottom: auto;
    width: 44px;
    height: 44px;
    opacity: 1;
    pointer-events: auto;
    color: #0d2a39;
    background: transparent;
}

.bespoke-showcase .watch-scroller-arrow::before,
.bespoke-showcase .watch-scroller-arrow::after {
    display: none;
}

.bespoke-showcase .watch-scroller-arrow--prev {
    left: 0;
}

.bespoke-showcase .watch-scroller-arrow--next {
    right: 0;
}

.bespoke-showcase .watch-slider-viewport:hover .watch-scroller-arrow:not(:disabled) {
    opacity: 1;
}

/* Emirati Arabic: text on the right, products on the left, scroller stays LTR */
html[dir="rtl"] .bespoke-showcase {
    direction: ltr;
}
html[dir="rtl"] .bespoke-showcase__info,
html[dir="rtl"] .bespoke-showcase__copy,
html[dir="rtl"] .bespoke-showcase__title,
html[dir="rtl"] .bespoke-showcase__text {
    direction: rtl;
    text-align: right;
}
html[dir="rtl"] .bespoke-showcase__title {
    font-family: "Cairo", "Argent CF", Georgia, serif;
    letter-spacing: 0;
    white-space: normal;
}
html[dir="rtl"] .bespoke-showcase__text {
    font-family: "Cairo", "Poppins", sans-serif;
    text-align: right;
}
html[dir="rtl"] .bespoke-showcase .mobile-product-scroller,
html[dir="rtl"] .bespoke-showcase .scroller-container {
    direction: ltr;
}
html[dir="rtl"] .bespoke-showcase__dots {
    direction: ltr;
    justify-content: flex-start;
}
@media (min-width: 1100px) {
    html[dir="rtl"] .bespoke-showcase {
        flex-direction: row-reverse;
    }
    html[dir="rtl"] .bespoke-showcase__info {
        padding: 0 48px 0 28px;
    }
    /* Arabic: next on the left, previous on the right */
    html[dir="rtl"] .bespoke-showcase .watch-scroller-arrow--prev {
        left: auto !important;
        right: 0 !important;
        transform: scaleX(-1) !important;
    }
    html[dir="rtl"] .bespoke-showcase .watch-scroller-arrow--next {
        right: auto !important;
        left: 0 !important;
        transform: scaleX(-1) !important;
    }
}
@media (max-width: 1099.98px) {
    html[dir="rtl"] .bespoke-showcase__info {
        padding: 0 24px 28px;
    }
    html[dir="rtl"] .bespoke-showcase__dots--bottom {
        justify-content: center;
    }
    html[dir="rtl"] .bespoke-showcase .watch-scroller-arrow--prev {
        left: auto !important;
        right: 8px !important;
        transform: scaleX(-1) !important;
    }
    html[dir="rtl"] .bespoke-showcase .watch-scroller-arrow--next {
        right: auto !important;
        left: 8px !important;
        transform: scaleX(-1) !important;
    }
}

html[dir="rtl"] section.watch {
    direction: ltr;
}

@media (min-width: 1100px) {
    .bespoke-showcase {
        display: flex;
        flex-wrap: wrap;
        align-items: stretch;
    }

    .bespoke-showcase__info {
        flex: 0 0 460px;
        width: 460px;
        padding: 0 28px 0 48px;
    }

    .bespoke-showcase__stage {
        flex: 1 1 0;
        width: calc(100% - 460px);
    }

    .bespoke-showcase .scroller-item {
        flex: 0 0 calc((100cqi - 60px) / 3);
        width: calc((100cqi - 60px) / 3);
        min-width: 0;
    }

    .bespoke-showcase__dots--side {
        display: flex;
    }

    .bespoke-showcase__dots--bottom {
        display: none;
    }
}

@media (min-width: 1600px) {
    .bespoke-showcase__info {
        flex-basis: 480px;
        width: 480px;
        padding: 0 28px 0 48px;
    }

    .bespoke-showcase__stage {
        width: calc(100% - 480px);
    }
}

@media (max-width: 1099.98px) {
    .bespoke-showcase {
        display: flex;
        flex-direction: column;
        padding: 80px 0 0;
    }

    .bespoke-showcase__info {
        flex: 0 0 auto;
        width: 100%;
        padding: 0 24px 28px;
        gap: 0;
    }

    .bespoke-showcase__title {
        font-size: 28px;
        margin-bottom: 40px;
    }

    .bespoke-showcase__dots--side {
        display: none;
    }

    .bespoke-showcase__dots--bottom {
        display: flex;
        justify-content: center;
        width: 100%;
        margin-top: 28px;
        padding: 0 24px;
    }

    .bespoke-showcase__stage {
        flex: 0 0 auto;
        width: 100%;
        padding: 0 16px;
    }

    .bespoke-showcase .scroller-item {
        flex: 0 0 calc((100cqi - 30px) / 2);
        width: calc((100cqi - 30px) / 2);
        min-width: 0;
    }

    .bespoke-showcase .watch-scroller-arrow {
        opacity: 1;
    }

    .bespoke-showcase .watch-scroller-arrow--prev {
        left: 8px;
    }

    .bespoke-showcase .watch-scroller-arrow--next {
        right: 8px;
    }
}

@media (max-width: 767.98px) {
    .carousel-section {
        margin-bottom: 0 !important;
    }

    .bespoke-showcase {
        padding: 80px 0 0;
    }

    .bespoke-showcase__info {
        align-items: center;
        padding: 0 20px 22px;
        text-align: center;
    }

    .bespoke-showcase__copy {
        width: 100%;
        margin-inline: auto;
        text-align: center;
    }

    .bespoke-showcase__title {
        width: 100%;
        max-width: 100%;
        margin-inline: auto;
        font-size: 24px;
        margin-bottom: 32px;
        text-align: center;
        white-space: normal;
    }

    .bespoke-showcase__text {
        width: 100%;
        min-width: 0;
        margin-inline: auto;
        text-align: center;
    }

    html[dir="rtl"] .bespoke-showcase__info,
    html[dir="rtl"] .bespoke-showcase__copy,
    html[dir="rtl"] .bespoke-showcase__title,
    html[dir="rtl"] .bespoke-showcase__text {
        text-align: center;
    }

    .bespoke-showcase__stage {
        padding: 0 12px;
    }

    .bespoke-showcase .scroller-container {
        gap: 20px;
    }

    .bespoke-showcase .scroller-item {
        flex: 0 0 calc((100cqi - 20px) / 2);
        width: calc((100cqi - 20px) / 2);
    }

    .bespoke-showcase__name {
        font-size: 12px;
        margin-top: 14px;
    }

    .bespoke-showcase__dots--bottom {
        margin-top: 22px;
        padding: 0 20px;
    }
}
</style>
<section class="container">
<h4 class="section-title text-center">
  INTERNATIONAL JEWELLERY BRAND
</h4>
</section>
<section class="brand-editorial">
  <article class="brand-editorial__item">
    <a href="{{ url('/forevermark') }}" class="brand-editorial__media">
      <img src="{{ asset('assets/f_assets/image/forever.png') }}" alt="Forevermark">
    </a>
    <h2 class="brand-editorial__title">FOREVERMARK</h2>
    <p class="brand-editorial__text">
      Every De Beers Forevermark diamond undergoes a journey of rigorous selection. Our unique inscription is an assurance that every De Beers Forevermark diamond meets the exceptional standards of beauty, rarity and is responsibly sourced.
    </p>
    <a href="{{ url('/forevermark') }}" class="brand-editorial__link brand-editorial__link--box">{{ __('site.shop_collection') }}</a>
  </article>

  <article class="brand-editorial__item">
    <a href="/collections/farah-khan" class="brand-editorial__media">
      <img src="{{ asset('assets/f_assets/image/farah.png') }}" alt="Farah Khan">
    </a>
    <h2 class="brand-editorial__title">FARAH KHAN</h2>
    <p class="brand-editorial__text">
      “I see myself as an alchemist that captures the moments in my life and transforms them into beautiful objects of art.”
    </p>
    <a href="/collections/farah-khan" class="brand-editorial__link brand-editorial__link--box">{{ __('site.shop_collection') }}</a>
  </article>
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
    padding: 12px 16px;
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
    touch-action: manipulation;
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

.home-brands .brand-item:hover::before,
.home-brands .brand-item.is-touch-active::before {
    transform: scaleX(1);
}

.home-brands .brand-item:hover::after,
.home-brands .brand-item.is-touch-active::after {
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

.home-brands .brand-item:hover img,
.home-brands .brand-item.is-touch-active img {
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
(function () {
    function syncHeroStickyTop() {
        var header = window.innerWidth < 992
            ? document.querySelector('header.mobile-header-main')
            : document.querySelector('.luxury-header');
        var height = header ? header.offsetHeight : 0;
        document.documentElement.style.setProperty('--hj-header-h', height + 'px');
    }

    function syncHeroScroll() {
        syncHeroStickyTop();
        var scene = document.querySelector('.home-hero-scroll');
        if (!scene) return;
        var banner = window.innerWidth >= 768
            ? scene.querySelector('.custom-banner')
            : scene.querySelector('.home-hero-mobile');
        if (!banner) return;
        var height = Math.round(banner.getBoundingClientRect().height);
        if (height < 1) return;
        scene.style.setProperty('--hero-scroll', height + 'px');
        document.documentElement.style.setProperty('--hero-scroll', height + 'px');
    }

    syncHeroScroll();
    window.addEventListener('resize', syncHeroScroll);
    window.addEventListener('load', syncHeroScroll);
    document.querySelectorAll('.home-hero-scroll video').forEach(function (video) {
        video.addEventListener('loadedmetadata', syncHeroScroll);
        video.addEventListener('loadeddata', syncHeroScroll);
    });

    var reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    var finePointer = window.matchMedia('(pointer: fine)').matches;
    if (reduceMotion || !finePointer) return;

    document.documentElement.style.scrollBehavior = 'auto';

    var current = window.scrollY;
    var target = window.scrollY;
    var frame = 0;
    var driving = false;
    var ease = 0.08;

    function maxScroll() {
        var scrolling = document.scrollingElement || document.documentElement;
        return Math.max(0, scrolling.scrollHeight - window.innerHeight);
    }

    function clampScroll(value) {
        return Math.max(0, Math.min(maxScroll(), value));
    }

    function canScrollInside(node, delta) {
        var el = node;
        while (el && el !== document.body && el !== document.documentElement) {
            if (el.nodeType === 1) {
                var style = window.getComputedStyle(el);
                var overflowY = style.overflowY;
                if ((overflowY === 'auto' || overflowY === 'scroll' || overflowY === 'overlay') && el.scrollHeight > el.clientHeight + 2) {
                    var atTop = el.scrollTop <= 0;
                    var atBottom = el.scrollTop + el.clientHeight >= el.scrollHeight - 1;
                    if ((delta < 0 && !atTop) || (delta > 0 && !atBottom)) return true;
                }
            }
            el = el.parentElement;
        }
        return false;
    }

    function tick() {
        var delta = target - current;
        if (Math.abs(delta) < 0.5) {
            current = target;
            frame = 0;
        } else {
            current += delta * ease;
            frame = window.requestAnimationFrame(tick);
        }
        var y = Math.round(current);
        if (Math.abs(window.scrollY - y) >= 1) {
            driving = true;
            window.scrollTo(0, y);
            driving = false;
        }
    }

    function glideTo(nextTarget) {
        target = clampScroll(nextTarget);
        if (!frame) frame = window.requestAnimationFrame(tick);
    }

    window.addEventListener('scroll', function () {
        if (driving) return;
        if (Math.abs(window.scrollY - Math.round(current)) < 3) return;
        current = window.scrollY;
        target = window.scrollY;
        if (frame) {
            window.cancelAnimationFrame(frame);
            frame = 0;
        }
    }, { passive: true });

    window.addEventListener('wheel', function (event) {
        if (event.ctrlKey || event.metaKey) return;
        if (Math.abs(event.deltaX) > Math.abs(event.deltaY)) return;

        var delta = event.deltaY;
        if (event.deltaMode === 1) delta *= 16;
        else if (event.deltaMode === 2) delta *= window.innerHeight;
        if (canScrollInside(event.target, delta)) return;

        event.preventDefault();
        glideTo(target + delta);
    }, { passive: false });

    window.addEventListener('keydown', function (event) {
        var tag = event.target && event.target.tagName;
        if (tag === 'INPUT' || tag === 'TEXTAREA' || tag === 'SELECT' || (event.target && event.target.isContentEditable)) return;
        if (event.altKey || event.ctrlKey || event.metaKey) return;

        var delta = 0;
        if (event.key === 'ArrowDown') delta = 90;
        else if (event.key === 'ArrowUp') delta = -90;
        else if (event.key === 'PageDown') delta = window.innerHeight * 0.9;
        else if (event.key === 'PageUp') delta = window.innerHeight * -0.9;
        else if (event.key === ' ') delta = (event.shiftKey ? -1 : 1) * window.innerHeight * 0.9;
        else if (event.key === 'Home') {
            event.preventDefault();
            glideTo(0);
            return;
        } else if (event.key === 'End') {
            event.preventDefault();
            glideTo(maxScroll());
            return;
        } else {
            return;
        }

        event.preventDefault();
        glideTo(target + delta);
    });
})();
</script>
<script>
document.addEventListener('DOMContentLoaded', () => {
    const selector = '.home-brands .brand-item';
    const items = document.querySelectorAll(selector);
    let gesture = null;

    const findItem = target => target.closest(selector);

    function activate(activeItem) {
        items.forEach(item => {
            const image = item.querySelector('img[data-hover]');
            const active = item === activeItem;
            item.classList.toggle('is-touch-active', active);
            if (image) image.src = image.dataset[active ? 'hover' : 'original'];
        });
    }

    document.querySelectorAll('.home-brands .brand-item img[data-hover]').forEach(image => {
        const item = image.closest('.brand-item');
        image.dataset.original = image.src;
        if (image.dataset.hover) new Image().src = image.dataset.hover;
        image.addEventListener('mouseenter', () => image.src = image.dataset.hover);
        image.addEventListener('mouseleave', () => {
            if (!item.classList.contains('is-touch-active')) image.src = image.dataset.original;
        });
    });

    document.addEventListener('touchstart', e => {
        const point = e.touches[0];
        const item = findItem(e.target);
        if (!point) return;
        gesture = {
            item,
            wasActive: !!(item && item.classList.contains('is-touch-active')),
            x: point.clientX,
            y: point.clientY,
            moved: false
        };
        activate(item);
    }, { passive: true });

    document.addEventListener('touchmove', e => {
        if (gesture && e.touches[0] && (Math.abs(e.touches[0].clientX - gesture.x) > 10 || Math.abs(e.touches[0].clientY - gesture.y) > 10)) {
            gesture.moved = true;
        }
    }, { passive: true });

    document.addEventListener('touchend', e => {
        if (gesture && e.changedTouches[0] && (Math.abs(e.changedTouches[0].clientX - gesture.x) > 10 || Math.abs(e.changedTouches[0].clientY - gesture.y) > 10)) {
            gesture.moved = true;
        }
        const g = gesture;
        setTimeout(() => { if (gesture === g) gesture = null; }, 1500);
    }, { passive: true });

    document.addEventListener('click', e => {
        if (!gesture || e.detail === 0) return;
        const last = gesture;
        gesture = null;
        if (!last.item || findItem(e.target) !== last.item) return;
        if (last.moved || !last.wasActive) {
            e.preventDefault();
            e.stopPropagation();
        }
    }, true);
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

.brand-editorial{
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 12px;
  width: 100%;
  margin: 0;
  padding: 0 12px;
  background: #fff;
}

.brand-editorial__item{
  display: flex;
  flex-direction: column;
  align-items: center;
  text-align: center;
  min-width: 0;
}

.brand-editorial__media{
  display: block;
  width: 100%;
  aspect-ratio: 4 / 3;
  overflow: hidden;
  background: #f4f1ec;
}

.brand-editorial__media img{
  width: 100%;
  height: 100%;
  object-fit: cover;
  object-position: center;
  display: block;
}

.brand-editorial__title{
  margin: 32px 0 16px;
  padding: 0 16px;
  font-family: "poppins", sans-serif;
  font-size: 21px;
  font-weight: 500;
  letter-spacing: 0.22em;
  line-height: 1.4;
  text-transform: uppercase;
  color: #111;
}

.brand-editorial__text{
  max-width: 420px;
  margin: 0 0 14px;
  padding: 0 29px;
  font-family: "poppins", sans-serif;
  font-size: 14px;
  font-weight: 400;
  line-height: 1.65;
  text-align: center;
  color: #6d6d6d;
}

.brand-editorial__link{
  color: #111;
  font-family: "poppins", sans-serif;
  font-size: 15px;
  line-height: 1.4;
}

.brand-editorial__link:hover{
  color: #111;
}

.brand-editorial__link--box{
  display: inline-flex;
  align-items: center;
  justify-content: center;
  margin-top: 6px;
  padding: 12px 22px;
  border: 1px solid #111;
  text-decoration: none;
}

.brand-editorial__link--box:hover{
  background: #111;
  color: #fff;
}

@media (max-width: 767.98px){
  .brand-editorial{
    grid-template-columns: 1fr;
    gap: 80px;
    padding: 0;
    margin-bottom: 0;
  }

  .brand-editorial__title{
    margin-top: 22px;
    letter-spacing: 0.16em;
  }
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

            let logicalIndex = 0;
            let animRaf = 0;
            let animating = false;
            let isMouseDown = false;
            let mouseStartX = 0;
            let mouseStartScrollLeft = 0;
            let dragDistance = 0;
            let pointerVelocity = 0;
            let lastPointerX = 0;
            let lastPointerT = 0;
            let startX = 0;
            let startY = 0;
            let isInteractingWithCarousel = false;

            const arrowPrevBtn = section.querySelector('.watch-scroller-arrow--prev');
            const arrowNextBtn = section.querySelector('.watch-scroller-arrow--next');
            const watchProgressEl = section.querySelector('.watch-progress');
            const watchProgressFill = section.querySelector('.watch-progress__fill');

            function isDesktopScrollerSection() {
                const isDesktopBespoke = scroller.closest('section.bespoke-showcase');
                const isDesktopWatches = scroller.closest('section.watch');
                return !!(isDesktopBespoke || isDesktopWatches);
            }

            function getScrollLimit() {
                return Math.max(0, scroller.scrollWidth - scroller.clientWidth);
            }

            function getItemStep() {
                if (items.length >= 2) {
                    const step = items[1].offsetLeft - items[0].offsetLeft;
                    return step > 0 ? step : items[0].getBoundingClientRect().width;
                }
                return items[0].getBoundingClientRect().width;
            }

            function getMaxIndex() {
                const step = getItemStep();
                const limit = getScrollLimit();
                if (!step || step <= 0 || limit <= 2) return 0;

                let max = 0;
                for (let i = 1; i < items.length; i++) {
                    const pos = Math.min(limit, Math.round(i * step));
                    const prev = Math.min(limit, Math.round((i - 1) * step));
                    if (pos - prev < 8) break;
                    max = i;
                    if (pos >= limit - 2) break;
                }
                return max;
            }

            function indexToScroll(index) {
                const step = getItemStep();
                const limit = getScrollLimit();
                const bounded = Math.max(0, Math.min(getMaxIndex(), index));
                return Math.max(0, Math.min(limit, Math.round(bounded * step)));
            }

            function getNearestIndex() {
                const step = getItemStep();
                if (!step || step <= 0) return 0;
                const rawIndex = Math.round(scroller.scrollLeft / step);
                return Math.max(0, Math.min(getMaxIndex(), rawIndex));
            }

            function stopAnimation() {
                if (animRaf) cancelAnimationFrame(animRaf);
                animRaf = 0;
                animating = false;
            }

            function smoothScrollTo(target) {
                const destination = Math.max(0, Math.min(getScrollLimit(), target));
                stopAnimation();
                const startLeft = scroller.scrollLeft;
                const distance = destination - startLeft;
                if (Math.abs(distance) < 1) {
                    scroller.scrollLeft = destination;
                    refreshScrollerUi();
                    return;
                }

                animating = true;
                const duration = Math.min(680, Math.max(340, 280 + Math.abs(distance) * 0.35));
                let startTime = null;

                function easeOutCubic(t) {
                    return 1 - Math.pow(1 - t, 3);
                }

                function step(timestamp) {
                    if (startTime === null) startTime = timestamp;
                    const progress = Math.min((timestamp - startTime) / duration, 1);
                    scroller.scrollLeft = startLeft + distance * easeOutCubic(progress);
                    updateWatchProgress();
                    if (progress < 1) {
                        animRaf = requestAnimationFrame(step);
                    } else {
                        scroller.scrollLeft = destination;
                        animRaf = 0;
                        animating = false;
                        refreshScrollerUi();
                    }
                }

                animRaf = requestAnimationFrame(step);
            }

            function updateWatchProgress() {
                if (!watchProgressFill || !watchProgressEl) return;

                const limit = getScrollLimit();
                const total = scroller.scrollWidth;
                if (limit <= 2 || items.length <= 1 || total <= 0) {
                    watchProgressEl.classList.add('is-hidden');
                    return;
                }

                watchProgressEl.classList.remove('is-hidden');
                const thumb = Math.max(12, (scroller.clientWidth / total) * 100);
                const left = (scroller.scrollLeft / limit) * (100 - thumb);
                watchProgressFill.style.width = thumb + '%';
                watchProgressFill.style.left = left + '%';
            }

            function updateArrowButtons() {
                if (!arrowPrevBtn || !arrowNextBtn || !items.length) return;

                const limit = getScrollLimit();
                const noScroll = limit <= 2 || items.length <= 1;

                arrowPrevBtn.disabled = noScroll || scroller.scrollLeft <= 5;
                arrowNextBtn.disabled = noScroll || scroller.scrollLeft >= limit - 5;
            }

            function scrollToItemByIndex(itemIndex) {
                const bounded = Math.max(0, Math.min(getMaxIndex(), itemIndex));
                logicalIndex = bounded;
                smoothScrollTo(indexToScroll(bounded));
            }

            function resetScrollerPosition() {
                stopAnimation();
                logicalIndex = 0;
                scroller.scrollLeft = 0;
            }

            const dotsEls = section.querySelectorAll('.bespoke-showcase__dots');

            function updateDots() {
                if (!dotsEls.length) return;
                const pages = getMaxIndex() + 1;
                dotsEls.forEach(function(dotsEl) {
                    if (dotsEl.childElementCount !== pages) {
                        dotsEl.innerHTML = '';
                        for (let i = 0; i < pages; i++) {
                            const dot = document.createElement('button');
                            dot.type = 'button';
                            dot.className = 'bespoke-showcase__dot';
                            dot.setAttribute('aria-label', 'Show collections ' + (i + 1));
                            (function(pageIndex) {
                                dot.addEventListener('click', function() {
                                    scrollToItemByIndex(pageIndex);
                                });
                            })(i);
                            dotsEl.appendChild(dot);
                        }
                    }
                    Array.from(dotsEl.children).forEach(function(dot, index) {
                        dot.classList.toggle('is-active', index === logicalIndex);
                        dot.setAttribute('aria-current', index === logicalIndex ? 'true' : 'false');
                    });
                });
            }

            function refreshScrollerUi() {
                updateArrowButtons();
                updateWatchProgress();
                updateDots();
            }

            if (arrowPrevBtn && arrowNextBtn) {
                arrowPrevBtn.addEventListener('click', function() {
                    scrollToItemByIndex(logicalIndex - 1);
                });
                arrowNextBtn.addEventListener('click', function() {
                    scrollToItemByIndex(logicalIndex + 1);
                });
            }

            function endDrag() {
                if (!isMouseDown) return;
                isMouseDown = false;
                if (isDesktopScrollerSection()) scroller.style.cursor = 'grab';
                if (dragDistance < 8) {
                    logicalIndex = getNearestIndex();
                    refreshScrollerUi();
                    return;
                }
                let index = getNearestIndex();
                if (pointerVelocity <= -0.45) index += 1;
                else if (pointerVelocity >= 0.45) index -= 1;
                scrollToItemByIndex(index);
            }

            scroller.addEventListener('mousedown', function(e) {
                if (!isDesktopScrollerSection() || e.button !== 0) return;

                stopAnimation();
                isMouseDown = true;
                dragDistance = 0;
                pointerVelocity = 0;
                mouseStartX = e.clientX;
                mouseStartScrollLeft = scroller.scrollLeft;
                lastPointerX = e.clientX;
                lastPointerT = performance.now();
                scroller.style.cursor = 'grabbing';
                e.preventDefault();
            });

            scroller.addEventListener('mousemove', function(e) {
                if (!isMouseDown) return;
                e.preventDefault();
                const now = performance.now();
                const dt = now - lastPointerT;
                if (dt > 0) pointerVelocity = (e.clientX - lastPointerX) / dt;
                lastPointerX = e.clientX;
                lastPointerT = now;
                const dx = e.clientX - mouseStartX;
                dragDistance = Math.abs(dx);
                scroller.scrollLeft = mouseStartScrollLeft - dx;
            });

            scroller.addEventListener('mouseup', endDrag);

            scroller.addEventListener('mouseleave', function() {
                if (!isMouseDown) return;
                endDrag();
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
                    if (!animating && !isMouseDown) logicalIndex = getNearestIndex();
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
                    const keep = logicalIndex;
                    stopAnimation();
                    logicalIndex = Math.max(0, Math.min(getMaxIndex(), keep));
                    scroller.scrollLeft = indexToScroll(logicalIndex);
                    refreshScrollerUi();
                }, 150);
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
