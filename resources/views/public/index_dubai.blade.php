@extends('public.layouts.header_black_white_fixed')

@section('content')
<style>
.hj-footer {
    padding: 60px 0 0;
}
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

@media (max-width: 767.98px) {
  #carouselExampleRide {
    --brand-banner-height: auto;
    height: auto;
    max-height: none;
    background: transparent;
    overflow: hidden;
  }

  #carouselExampleRide .carousel-inner,
  #carouselExampleRide .carousel-item,
  #carouselExampleRide .hero-slide,
  #carouselExampleRide .hero-slide picture {
    height: auto;
  }

  #carouselExampleRide .carousel-inner {
    height: auto !important;
  }

  #carouselExampleRide .carousel-item {
    height: auto;
  }

  #carouselExampleRide .hero-slide {
    background: transparent;
  }

  #carouselExampleRide .hero-slide img {
    width: 100%;
    height: auto;
    max-width: 100%;
    max-height: none;
    object-fit: contain;
    object-position: center center;
  }

  #carouselExampleRide .carousel-control-prev,
  #carouselExampleRide .carousel-control-next {
    width: 40px;
    height: 40px;
    opacity: 1;
  }

  #carouselExampleRide .carousel-control-prev {
    left: 6px;
  }

  #carouselExampleRide .carousel-control-next {
    right: 6px;
  }
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

.home-hero-scroll + .dxb-feature,
.home-hero-scroll ~ section {
    position: relative;
    z-index: 3;
}

/* Dubai: no overlapping product strip after video — VCA split sits cleanly below */
.home-hero-scroll .home-hero-runway {
    height: 0;
}
.home-hero-scroll > .custom-banner-btn,
.home-hero-scroll > .custom-banner-btn-new {
    top: auto;
    bottom: 37px;
}

/* VCA-style feature split: product carousel (left) + large image (right) */
.dxb-feature {
    display: grid;
    grid-template-columns: minmax(0, 1fr) minmax(0, 1.05fr);
    align-items: stretch;
    min-height: 0;
    background: #fff;
    color: #111;
    overflow: hidden;
}
.dxb-feature__left {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    padding: clamp(2.75rem, 6vw, 4.5rem) clamp(1.25rem, 3vw, 2.5rem);
    text-align: center;
    background: #fff;
    position: relative;
}
.dxb-feature__track-wrap {
    position: relative;
    width: min(100%, 36rem);
    margin-bottom: 1.35rem;
    cursor: grab;
    user-select: none;
    touch-action: pan-y;
    overflow: hidden;
    padding: 0.5rem 0;
}
.dxb-feature__track-wrap.is-dragging {
    cursor: grabbing;
}
/* VCA cover-flow: side | gap+arrow | center | gap+arrow | side */
.dxb-feature__track {
    position: relative;
    display: grid;
    grid-template-columns: 5.75rem 2.75rem minmax(9.5rem, 11rem) 2.75rem 5.75rem;
    align-items: center;
    justify-items: center;
    justify-content: center;
    column-gap: 0.35rem;
    min-height: 13.5rem;
    width: 100%;
    max-width: 32rem;
    margin: 0 auto;
}
.dxb-feature__thumb {
    display: block;
    width: 5.5rem;
    height: 8.25rem;
    object-fit: contain;
    object-position: center;
    border: none;
    border-radius: 0;
    background: transparent;
    opacity: 0.38;
    cursor: pointer;
    transition: opacity 0.35s ease, transform 0.35s ease, filter 0.35s ease;
    flex-shrink: 0;
    pointer-events: auto;
}
.dxb-feature__thumb.is-side {
    opacity: 0.38;
    transform: scale(0.95);
}
.dxb-feature__thumb.is-active {
    width: 10.75rem;
    height: 13.25rem;
    opacity: 1;
    transform: scale(1);
    cursor: default;
    filter: drop-shadow(0 12px 20px rgba(0, 0, 0, 0.09));
}
/* Circular < > in gaps — hide until hover */
.dxb-feature__nav {
    position: static;
    width: 36px;
    height: 36px;
    margin: 0;
    border-radius: 50%;
    border: 1px solid #6e6e6e;
    background: rgba(255, 255, 255, 0.95);
    color: #4a4a4a;
    cursor: pointer;
    display: grid;
    place-items: center;
    z-index: 4;
    opacity: 0 !important;
    visibility: hidden !important;
    pointer-events: none !important;
    transform: none;
    transition: opacity 0.2s ease, visibility 0.2s ease, border-color 0.2s ease, color 0.2s ease;
    padding: 0;
    box-shadow: none;
    justify-self: center;
}
.dxb-feature__track-wrap.is-nav-visible .dxb-feature__nav,
.dxb-feature__track-wrap:hover .dxb-feature__nav {
    opacity: 1 !important;
    visibility: visible !important;
    pointer-events: auto !important;
}
.dxb-feature__nav:hover {
    border-color: #222;
    color: #111;
}
.dxb-feature__nav--prev,
.dxb-feature__nav--next {
    left: auto;
    right: auto;
}
.dxb-feature__nav svg {
    width: 12px;
    height: 12px;
    stroke-width: 1.75;
}
html[dir="rtl"] .dxb-feature__nav svg {
    transform: scaleX(-1);
}
.dxb-feature__info {
    max-width: 26rem;
    padding: 0 0.75rem;
}
.dxb-feature__info h2 {
    font-family: "Cormorant Garamond", Georgia, "Times New Roman", serif;
    font-size: clamp(1.5rem, 2.3vw, 1.95rem);
    font-weight: 500;
    margin: 0 0 0.45rem;
    line-height: 1.25;
    color: #1a1a1a;
    letter-spacing: 0.01em;
}
.dxb-feature__meta {
    margin: 0 0 0.35rem;
    font-size: 0.78rem;
    line-height: 1.5;
    color: #7a7a7a;
    font-weight: 300;
}
.dxb-feature__price {
    margin: 0;
    font-size: 0.86rem;
    letter-spacing: 0.02em;
    color: #555;
    font-weight: 300;
}
.dxb-feature__price a {
    color: inherit;
    text-decoration: underline;
    text-underline-offset: 3px;
}
.dxb-feature__dots {
    display: flex;
    gap: 0.5rem;
    justify-content: center;
    margin-top: 1.35rem;
}
.dxb-feature__dot {
    width: 6px;
    height: 6px;
    border-radius: 50%;
    border: none;
    padding: 0;
    background: #d0d0d0;
    cursor: pointer;
    transition: background 0.2s ease, transform 0.2s ease;
}
.dxb-feature__dot.is-active {
    background: #555;
    transform: scale(1.2);
}
.dxb-feature__right {
    position: relative;
    background: #f4f4f4;
    overflow: visible;
    min-height: 0;
    height: auto;
    align-self: stretch;
    display: flex;
    align-items: center;
    justify-content: center;
}
.dxb-feature__right img {
    position: relative;
    inset: auto;
    width: 100%;
    height: auto;
    max-width: 100%;
    object-fit: contain;
    object-position: center;
    display: block;
}
@media (hover: none), (max-width: 1199px) {
    .dxb-feature__track-wrap .dxb-feature__nav {
        opacity: 1 !important;
        visibility: visible !important;
        pointer-events: auto !important;
    }
}

/* Tablet: keep the split, shrink the carousel so it stays inside the column */
@media (max-width: 1199px) and (min-width: 992px) {
    .dxb-feature {
        grid-template-columns: minmax(0, 1fr) minmax(0, 1fr);
        min-height: 0;
    }
    .dxb-feature__left {
        padding: 2.25rem 1rem;
    }
    .dxb-feature__track-wrap {
        width: 100%;
    }
    .dxb-feature__track {
        grid-template-columns: 4.25rem 2.1rem minmax(7.25rem, 8.25rem) 2.1rem 4.25rem;
        min-height: 10.5rem;
        max-width: 100%;
        column-gap: 0.15rem;
    }
    .dxb-feature__thumb.is-active {
        width: 8.25rem;
        height: 10.25rem;
    }
    .dxb-feature__thumb.is-side,
    .dxb-feature__thumb {
        width: 4.15rem;
        height: 6.25rem;
    }
}

/* Tablet portrait + mobile: stack image above the carousel */
@media (max-width: 991px) {
    .dxb-feature {
        grid-template-columns: minmax(0, 1fr);
        min-height: 0;
    }
    .dxb-feature__right {
        order: -1;
        height: auto;
        min-height: 0;
        aspect-ratio: auto;
    }
    .dxb-feature__left {
        padding: 2.25rem 1rem 2.75rem;
    }
    .dxb-feature__track-wrap {
        width: min(100%, 28rem);
    }
    .dxb-feature__track {
        grid-template-columns: 4.25rem 2.15rem minmax(7.25rem, 8.5rem) 2.15rem 4.25rem;
        min-height: 10.25rem;
        max-width: 100%;
        column-gap: 0.15rem;
    }
    .dxb-feature__thumb.is-active {
        width: 8.25rem;
        height: 10rem;
    }
    .dxb-feature__thumb.is-side,
    .dxb-feature__thumb {
        width: 4.15rem;
        height: 6.25rem;
    }
    .dxb-feature__nav {
        width: 32px;
        height: 32px;
    }
}

@media (max-width: 575px) {
    .dxb-feature__right {
        min-height: 0;
        aspect-ratio: auto;
    }
    .dxb-feature__left {
        padding: 1.75rem 0.75rem 2.25rem;
    }
    .dxb-feature__track-wrap {
        width: 100%;
        margin-bottom: 1rem;
    }
    .dxb-feature__track {
        grid-template-columns: minmax(0, 3.1rem) 1.85rem minmax(0, 6.4rem) 1.85rem minmax(0, 3.1rem);
        min-height: 8.5rem;
        column-gap: 0.1rem;
    }
    .dxb-feature__thumb.is-active {
        width: 6.15rem;
        height: 8rem;
    }
    .dxb-feature__thumb.is-side,
    .dxb-feature__thumb {
        width: 3rem;
        height: 4.6rem;
    }
    .dxb-feature__info h2 {
        font-size: 1.55rem;
    }
    .dxb-feature__nav {
        width: 28px;
        height: 28px;
    }
}

/* 4 consecutive VCA-style story banners */
.dxb-story {
    content-visibility: auto;
    contain-intrinsic-size: 100vw 56.25vw;
    position: relative;
    width: 100%;
    aspect-ratio: 16 / 9;
    min-height: 0;
    display: grid;
    place-items: center start;
    overflow: hidden;
    isolation: isolate;
    color: #fff;
    text-decoration: none;
}
a.dxb-story { color: inherit; }
a.dxb-story:hover { color: inherit; text-decoration: none; }
.dxb-story__media,
.dxb-story__shade {
    position: absolute;
    inset: 0;
}
.dxb-story__media { z-index: -2; }
.dxb-story__shade { z-index: -1; }
.dxb-story__media img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    object-position: center;
    display: block;
}
.dxb-story__copy {
    position: relative;
    z-index: 2;
    width: min(34rem, calc(100% - 3rem));
    margin-inline-start: clamp(4vw, 7vw, 7rem);
    margin-inline-end: auto;
    padding: 0;
    text-align: start;
}
.dxb-story__copy h2 {
    font-family: "Poppins", "Helvetica Neue", Arial, sans-serif;
    font-weight: 500;
    font-size: clamp(1.15rem, 1.55vw, 1.6rem);
    line-height: 1.2;
    margin: 0 0 0.7rem;
    letter-spacing: 0.18em;
    text-transform: uppercase;
}
.dxb-story__copy p {
    margin: 0 0 1.15rem;
    font-family: "Poppins", "Helvetica Neue", Arial, sans-serif;
    font-size: clamp(0.75rem, 0.82vw, 0.875rem);
    line-height: 1.7;
    font-weight: 400;
    letter-spacing: 0.02em;
    max-width: none;
}
.dxb-story__book {
    display: inline-block;
    padding: 0.7rem 1.35rem;
    background: #fff;
    color: #111;
    font-family: "Poppins", "Helvetica Neue", Arial, sans-serif;
    font-size: 0.68rem;
    font-weight: 400;
    letter-spacing: 0.16em;
    line-height: 1.4;
    text-decoration: none;
    text-transform: uppercase;
}
.dxb-story__book:hover { background: #2b2b2b; color: #fff; }

/* 1 — Qaws: white title, copy and filled button on the left */
.dxb-story--qaws,
.dxb-story--qaws .dxb-story__copy,
.dxb-story--qaws h2,
.dxb-story--qaws p {
    color: #fff;
}
.dxb-story--qaws .dxb-story__shade {
    background: linear-gradient(90deg, rgba(70, 62, 54, 0.42) 0%, rgba(70, 62, 54, 0.12) 46%, transparent 72%);
}

/* 2 — Gulposh: same writeup, kept on the left */
.dxb-story--gulposh,
.dxb-story--gulposh .dxb-story__copy,
.dxb-story--gulposh h2,
.dxb-story--gulposh p {
    color: #fff;
}
.dxb-story--gulposh {
    place-items: center start;
}
.dxb-story--gulposh .dxb-story__shade {
    background: linear-gradient(90deg, rgba(8, 12, 20, 0.72) 0%, rgba(8, 12, 20, 0.28) 42%, transparent 72%);
}

/* 3 — Tawoos: outlined title, Grace of Peacock, black Discover */
.dxb-story--tawoos {
    place-items: center start;
    color: #fff;
}
.dxb-story--tawoos .dxb-story__shade {
    background: linear-gradient(90deg, rgba(8, 12, 20, 0.45) 0%, rgba(8, 12, 20, 0.12) 42%, transparent 68%);
}
.dxb-story--tawoos .dxb-story__copy {
    width: auto;
    max-width: calc(100% - 2rem);
    margin: 0;
    margin-inline-start: clamp(4vw, 7vw, 7rem);
    padding: 0;
    text-align: start;
    color: #fff;
}
.dxb-story--qaws .dxb-story__copy h2,
.dxb-story--gulposh .dxb-story__copy h2,
.dxb-story--gohar .dxb-story__copy h2 {
    font-family: "Poppins", "Helvetica Neue", Arial, sans-serif;
    font-weight: 500;
    font-size: clamp(1.7rem, 2.7vw, 2.15rem);
    letter-spacing: 0.08em;
    line-height: 1;
    margin: 0 0 0.35rem;
    text-transform: uppercase;
}
.dxb-story--tawoos .dxb-story__copy h2 {
    font-family: "Diplomacy", sans-serif;
    font-weight: 400;
    font-size: clamp(1.7rem, 2.7vw, 2.15rem);
    letter-spacing: 0.08em;
    line-height: 1;
    margin: 0 0 0.35rem;
    text-transform: uppercase;
}
.dxb-story--qaws .dxb-story__copy p,
.dxb-story--gulposh .dxb-story__copy p,
.dxb-story--tawoos .dxb-story__copy p,
.dxb-story--gohar .dxb-story__copy p {
    margin: 0 0 1.15rem;
    max-width: none;
    font-family: "Poppins", "Helvetica Neue", Arial, sans-serif;
    font-size: clamp(0.8rem, 1vw, 0.95rem);
    font-weight: 400;
    letter-spacing: 0.02em;
    line-height: 1.3;
}
.dxb-story--tawoos .dxb-story__copy h2,
.dxb-story--tawoos .dxb-story__copy p {
    color: #fff;
}
.dxb-story__discover {
    display: inline-block;
    padding: 0.85rem 1.7rem;
    background: #000;
    color: #fff;
    border: 1px solid #111;
    font-family: "Poppins", "Helvetica Neue", Arial, sans-serif;
    font-size: 0.72rem;
    letter-spacing: 0.18em;
    line-height: 1.4;
    text-decoration: none;
    text-transform: uppercase;
}
.dxb-story__discover:hover {
    background: #fff;
    color: #111;
}

/* 4 — Gohar: cream panel on the left, vertically centered */
.dxb-story--gohar,
.dxb-story--gohar .dxb-story__copy,
.dxb-story--gohar h2,
.dxb-story--gohar p {
    color: #3f3d3a;
}
.dxb-story--gohar {
    place-items: center start;
}
.dxb-story--gohar .dxb-story__media img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    object-position: center center;
}
.dxb-story--gohar .dxb-story__shade {
    background: none;
}
.dxb-story--gohar .dxb-story__copy {
    position: relative;
    left: auto;
    right: auto;
    top: auto;
    bottom: auto;
    transform: none;
    margin: 0;
    margin-inline-start: clamp(4vw, 7vw, 7rem);
    width: fit-content;
    max-width: min(19rem, 40%);
    padding: clamp(1rem, 1.4vw, 1.35rem);
    background: rgba(239, 229, 218, 0.94);
    text-align: start;
    box-sizing: border-box;
}
.dxb-story__book--dark {
    background: #6a6864;
    color: #fff;
}
.dxb-story__book--dark:hover { background: #2b2b2b; color: #fff; }

.dxb-home[dir="rtl"] .dxb-story--qaws .dxb-story__shade,
.dxb-home[dir="rtl"] .dxb-story--gulposh .dxb-story__shade {
    background: linear-gradient(270deg, rgba(70, 62, 54, 0.42) 0%, rgba(70, 62, 54, 0.12) 46%, transparent 72%);
}
.dxb-home[dir="rtl"] .dxb-story--gulposh .dxb-story__shade {
    background: linear-gradient(270deg, rgba(8, 12, 20, 0.72) 0%, rgba(8, 12, 20, 0.28) 42%, transparent 72%);
}
.dxb-home[dir="rtl"] .dxb-story--tawoos .dxb-story__shade {
    background: linear-gradient(270deg, rgba(8, 12, 20, 0.45) 0%, rgba(8, 12, 20, 0.12) 42%, transparent 68%);
}

@media (max-width: 991px) {
    .dxb-story {
        display: block;
        aspect-ratio: auto;
        min-height: 0;
        overflow: visible;
        content-visibility: visible;
        background: #fff;
        color: #111;
    }
    .dxb-story__media,
    .dxb-story__shade {
        position: relative;
        inset: auto;
    }
    .dxb-story__media { z-index: auto; }
    .dxb-story__shade { display: none; }
    .dxb-story__media img,
    .dxb-story--gohar .dxb-story__media img {
        width: 100%;
        height: auto;
        object-fit: contain;
        object-position: center;
    }
    .dxb-story__copy,
    .dxb-story--gohar .dxb-story__copy,
    .dxb-story--gulposh .dxb-story__copy,
    .dxb-story--tawoos .dxb-story__copy {
        position: relative;
        left: auto;
        right: auto;
        top: auto;
        bottom: auto;
        transform: none;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        width: 100% !important;
        max-width: none !important;
        margin: 0 !important;
        padding: 32px 24px 36px !important;
        background: #fff;
        color: #111;
        text-align: center;
        box-sizing: border-box;
    }
    .dxb-story--qaws .dxb-story__copy,
    .dxb-story--qaws .dxb-story__copy h2,
    .dxb-story--qaws .dxb-story__copy p,
    .dxb-story--gulposh .dxb-story__copy,
    .dxb-story--gulposh .dxb-story__copy h2,
    .dxb-story--gulposh .dxb-story__copy p,
    .dxb-story--tawoos .dxb-story__copy,
    .dxb-story--tawoos .dxb-story__copy h2,
    .dxb-story--tawoos .dxb-story__copy p,
    .dxb-story--gohar .dxb-story__copy,
    .dxb-story--gohar .dxb-story__copy h2,
    .dxb-story--gohar .dxb-story__copy p {
        color: #111;
        text-align: center;
    }
    .dxb-story--qaws .dxb-story__copy h2,
    .dxb-story--gulposh .dxb-story__copy h2,
    .dxb-story--gohar .dxb-story__copy h2,
    .dxb-story--tawoos .dxb-story__copy h2 {
        width: 100%;
        margin: 0;
        font-size: 22px;
        letter-spacing: 0.18em;
        line-height: 1.2;
        text-align: center;
    }
    .dxb-story--qaws .dxb-story__copy h2,
    .dxb-story--gulposh .dxb-story__copy h2,
    .dxb-story--gohar .dxb-story__copy h2 {
        font-family: "Poppins", "Helvetica Neue", Arial, sans-serif;
        font-weight: 500;
    }
    .dxb-story--tawoos .dxb-story__copy h2 {
        font-family: "Diplomacy", sans-serif;
        font-weight: 400;
    }
    .dxb-story--qaws .dxb-story__copy p,
    .dxb-story--gulposh .dxb-story__copy p,
    .dxb-story--tawoos .dxb-story__copy p,
    .dxb-story--gohar .dxb-story__copy p {
        max-width: 34em;
        margin: 12px auto 20px;
        font-size: 13px;
        line-height: 1.7;
        text-align: center;
    }
    .dxb-story__discover {
        background: #111;
        color: #fff;
        border-color: #111;
    }
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

/* Product scroller only: plain black prev/next icons, no panel/blur. */
section.watch .watch-scroller-arrow {
    position: absolute;
    top: 16px;
    bottom: 16px;
    z-index: 30;
    width: 40px;
    height: auto;
    border: 0;
    border-radius: 0;
    background: transparent;
    color: #000;
    box-shadow: none;
    display: flex !important;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    padding: 0;
    opacity: 0;
    visibility: visible;
    pointer-events: none;
    overflow: visible;
    transition: opacity 0.22s ease-out;
    filter: none;
    backdrop-filter: none;
    -webkit-backdrop-filter: none;
}

section.watch .watch-scroller-arrow::before,
section.watch .watch-scroller-arrow::after {
    content: none;
    display: none;
}

section.watch .watch-scroller-arrow .arrow-icon {
    position: relative;
    z-index: 2;
    color: #000;
    filter: none;
    transform: none;
    transition: none;
}

section.watch .watch-scroller-arrow .arrow-left svg {
    transform: rotate(180deg);
}

section.watch .watch-slider-viewport:hover .watch-scroller-arrow:not(:disabled),
section.watch .watch-slider-viewport:focus-within .watch-scroller-arrow:not(:disabled) {
    opacity: 1;
    pointer-events: auto;
}

section.watch .watch-scroller-arrow--prev {
    left: 0;
}

section.watch .watch-scroller-arrow--next {
    right: 0;
}

html[dir="rtl"] section.watch .watch-scroller-arrow--prev {
    left: auto;
    right: 0;
}

html[dir="rtl"] section.watch .watch-scroller-arrow--next {
    right: auto;
    left: 0;
}

html[dir="rtl"] section.watch .watch-scroller-arrow .arrow-left svg {
    transform: none;
}

html[dir="rtl"] section.watch .watch-scroller-arrow--next svg {
    transform: scaleX(-1);
}

section.watch .watch-scroller-arrow:disabled {
    opacity: 0;
    visibility: hidden;
    pointer-events: none;
}

@media (max-width: 767.98px) {
    section.watch .watch-scroller-arrow {
        display: none !important;
    }
}

@media (min-width: 992px) {
    section.watch .watch-scroller-arrow {
        width: 44px;
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
    <video class="custom-banner-video" autoplay muted loop playsinline preload="none" data-poster="{{ asset('assets/f_assets/image/dxb-opt/miras-poster.jpg') }}" data-src="{{ asset('assets/f_assets/image/ayeza/ayeza_all.mp4') }}" data-type="video/mp4" width="1600" height="900"></video>
</section>
<a href="/collections/miras" class="custom-banner-btn d-none d-md-inline-block">{{ __('site.discover_more') }}</a>

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
  <video class="mobileStackVideo" autoplay muted loop playsinline preload="none" data-poster="{{ asset('assets/f_assets/image/dxb-opt/miras-poster-mobile.jpg') }}" data-src="{{ asset('assets/f_assets/image/dxb-opt/miras-mobile.mp4') }}" data-type="video/mp4" width="720" height="1280"></video>
  
  
  
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
<a href="/collections/franck-muller" class="custom-banner-btn-new d-inline-block d-md-none">{{ __('site.discover_more') }}</a>
    <div class="home-hero-runway" aria-hidden="true"></div>
</div>
<script>
(function () {
    var desktop = window.matchMedia('(min-width: 768px)').matches;
    var video = document.querySelector(desktop ? '.custom-banner-video' : '.mobileStackVideo');
    if (!video || !video.dataset.src) return;
    if (video.dataset.poster) video.poster = video.dataset.poster;
    var source = document.createElement('source');
    source.src = video.dataset.src;
    source.type = video.dataset.type || 'video/mp4';
    video.appendChild(source);
    video.preload = 'auto';
    video.addEventListener('canplay', function () {
        video.play().catch(function () {});
    }, { once: true });
    video.load();
})();
</script>
    @php
        // VCA-style feature carousel: curated jewellery with thumb + large feature image
        $dxbFeatureSlides = collect([
            [
                'name' => __('site.dxb_slide_emerald'),
                'meta' => __('site.dxb_slide_emerald_meta'),
                'price' => __('site.talk_to_an_expert'),
                'price_is_link' => true,
                'thumb' => asset('assets/f_assets/image/Hasht Web/Hasht 3.jpg'),
                'url' => route('hasht'),
            ],
            [
                'name' => __('site.dxb_slide_ruby'),
                'meta' => __('site.dxb_slide_ruby_meta'),
                'price' => __('site.talk_to_an_expert'),
                'price_is_link' => true,
                'thumb' => asset('assets/f_assets/image/Hasht Web/Hasht 21.jpg'),
                'url' => route('hasht'),
            ],
            [
                'name' => __('site.dxb_slide_sapphire'),
                'meta' => __('site.dxb_slide_sapphire_meta'),
                'price' => __('site.talk_to_an_expert'),
                'price_is_link' => true,
                'thumb' => asset('assets/f_assets/image/Hasht Web/Hasht 2.jpg'),
                'url' => route('hasht'),
            ],
          
        ]);

        $dxbFeatureCount = $dxbFeatureSlides->count();
    @endphp

    {{-- Second section: VCA-style product carousel (left) + feature image (right) --}}
    <section class="dxb-feature" id="dxbFeatureSplit" data-count="{{ $dxbFeatureCount }}" aria-label="{{ __('site.dxb_selection_title') }}">
        <div class="dxb-feature__left">
            <div class="dxb-feature__track-wrap">
                <div class="dxb-feature__track" data-dxb-track>
                    {{-- Order: side · prev · center · next · side (built by JS) --}}
                    <button type="button" class="dxb-feature__nav dxb-feature__nav--prev" aria-label="{{ __('site.previous') }}">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" aria-hidden="true">
                            <path d="M15 6l-6 6 6 6"/>
                        </svg>
                    </button>
                    <button type="button" class="dxb-feature__nav dxb-feature__nav--next" aria-label="{{ __('site.next') }}">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" aria-hidden="true">
                            <path d="M9 6l6 6-6 6"/>
                        </svg>
                    </button>
                </div>
            </div>

            <div class="dxb-feature__info">
                <h2 data-dxb-title></h2>
                <p class="dxb-feature__meta" data-dxb-meta></p>
                <p class="dxb-feature__price" data-dxb-price></p>
            </div>

            <div class="dxb-feature__dots" data-dxb-dots role="tablist" aria-label="{{ __('site.dxb_selection_title') }}"></div>
        </div>

        <div class="dxb-feature__right">
            <img
                src="{{ asset('assets/f_assets/image/Hasht Web/Hasht.png') }}"
                alt="{{ __('site.dxb_solitaire_title') }}"
                width="1000"
                height="1200"
                loading="lazy"
                decoding="async"
            >
        </div>
    </section>

    <script type="application/json" id="dxbFeatureData">@json($dxbFeatureSlides->values())</script>

    {{-- 4 consecutive VCA-format story banners --}}
    <section class="dxb-story dxb-story--qaws" aria-label="{{ __('site.dxb_qaws_title') }}">
        <div class="dxb-story__media">
            <img src="{{ asset('assets/f_assets/image/dxb-opt/qaws.webp') }}" alt="{{ __('site.dxb_qaws_title') }}" width="1920" height="1080" loading="lazy" decoding="async">
        </div>
        <div class="dxb-story__shade" aria-hidden="true"></div>
        <div class="dxb-story__copy">
            <h2>{{ __('site.dxb_qaws_title') }}</h2>
            <p>{{ __('site.dxb_qaws_tagline') }}</p>
            <a class="dxb-story__discover" href="{{ route('qaws-al-matar') }}">{{ __('site.discover') }}</a>
        </div>
    </section>

    <section class="dxb-story dxb-story--gulposh" aria-label="{{ __('site.dxb_gulposh_title') }}">
        <div class="dxb-story__media">
            <img src="{{ asset('assets/f_assets/image/dxb-opt/gulposh.webp') }}" alt="{{ __('site.dxb_gulposh_title') }}" width="1920" height="1080" loading="lazy" decoding="async">
        </div>
        <div class="dxb-story__shade" aria-hidden="true"></div>
        <div class="dxb-story__copy">
            <h2>{{ __('site.dxb_gulposh_title') }}</h2>
            <p>{{ __('site.dxb_gulposh_tagline') }}</p>
            <a class="dxb-story__discover" href="{{ route('gulposh') }}">{{ __('site.discover') }}</a>
        </div>
    </section>

    <section class="dxb-story dxb-story--tawoos" aria-label="{{ __('site.dxb_tawoos_title') }}">
        <div class="dxb-story__media">
            <img src="{{ asset('assets/f_assets/image/dxb-opt/tawoos.webp') }}" alt="{{ __('site.dxb_tawoos_title') }}" width="1920" height="1080" loading="lazy" decoding="async">
        </div>
        <div class="dxb-story__shade" aria-hidden="true"></div>
        <div class="dxb-story__copy">
            <h2>{{ __('site.dxb_tawoos_title') }}</h2>
            <p>{{ __('site.tawoos_grace') }}</p>
            <a class="dxb-story__discover" href="{{ route('collections.tawoos') }}">{{ __('site.discover') }}</a>
        </div>
    </section>

    <section class="dxb-story dxb-story--gohar" aria-label="{{ __('site.dxb_gohar_title') }}">
        <div class="dxb-story__media">
            <img src="{{ asset('assets/f_assets/image/dxb-opt/gohar.webp') }}" alt="{{ __('site.dxb_gohar_title') }}" width="1920" height="1080" loading="lazy" decoding="async">
        </div>
        <div class="dxb-story__shade" aria-hidden="true"></div>
        <div class="dxb-story__copy">
            <h2>{{ __('site.dxb_gohar_title') }}</h2>
            <p>{{ __('site.dxb_gohar_tagline') }}</p>
            <a class="dxb-story__discover" href="{{ route('gohar') }}">{{ __('site.discover') }}</a>
        </div>
    </section>

    {{-- Featured products scroller (same as Pakistan homepage top cards) --}}
    @if(isset($products) && count($products))
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
    @endif

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
  display: flex;
  flex-direction: column;
  gap: 0;
  width: 100%;
  max-width: none;
  margin: 0;
  padding: 0;
  background: #fff;
}

.brand-editorial__item{
  display: flex;
  flex-direction: column;
  align-items: center;
  text-align: center;
  width: 100%;
  min-width: 0;
  padding-bottom: 4.5rem;
}

.brand-editorial__media{
  display: block;
  width: 100%;
  height: auto;
  overflow: visible;
  background: #f4f1ec;
}

.brand-editorial__media img{
  width: 100%;
  height: auto;
  max-width: none;
  object-fit: contain;
  object-position: center;
  display: block;
}

.brand-editorial__title{
  margin: 64px 0 32px;
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
    gap: 3.5rem;
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

            let rtlScrollType = 'ltr';

            function detectRtlScroll() {
                if (getComputedStyle(scroller).direction !== 'rtl') {
                    rtlScrollType = 'ltr';
                    return;
                }
                const max = Math.max(0, scroller.scrollWidth - scroller.clientWidth);
                if (max < 2) {
                    rtlScrollType = 'negative';
                    return;
                }
                scroller.scrollLeft = 0;
                const box = scroller.getBoundingClientRect();
                const first = items[0].getBoundingClientRect();
                const atStart = Math.abs(box.right - first.right) <= Math.abs(box.left - first.left);
                scroller.scrollLeft = -2;
                if (scroller.scrollLeft < 0) {
                    rtlScrollType = 'negative';
                    return;
                }
                rtlScrollType = atStart ? 'positive' : 'reverse';
            }

            function toRaw(logical) {
                const max = Math.max(0, scroller.scrollWidth - scroller.clientWidth);
                const value = Math.max(0, Math.min(max, logical));
                if (rtlScrollType === 'negative') return -value;
                if (rtlScrollType === 'reverse') return max - value;
                return value;
            }

            function fromRaw(raw) {
                const max = Math.max(0, scroller.scrollWidth - scroller.clientWidth);
                if (rtlScrollType === 'negative') return Math.min(max, Math.abs(Math.min(0, raw)));
                if (rtlScrollType === 'reverse') return Math.max(0, Math.min(max, max - raw));
                return Math.max(0, Math.min(max, raw));
            }

            function getScrollLimit() {
                return Math.max(0, scroller.scrollWidth - scroller.clientWidth);
            }

            function getItemStep() {
                if (items.length >= 2) {
                    const first = items[0].getBoundingClientRect();
                    const second = items[1].getBoundingClientRect();
                    const step = Math.abs(second.left - first.left);
                    if (step > 0) return step;
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
                const rawIndex = Math.round(fromRaw(scroller.scrollLeft) / step);
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
                const startLogical = fromRaw(scroller.scrollLeft);
                const distance = destination - startLogical;
                if (Math.abs(distance) < 1) {
                    scroller.scrollLeft = toRaw(destination);
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
                    scroller.scrollLeft = toRaw(startLogical + distance * easeOutCubic(progress));
                    updateWatchProgress();
                    if (progress < 1) {
                        animRaf = requestAnimationFrame(step);
                    } else {
                        scroller.scrollLeft = toRaw(destination);
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
                const left = (fromRaw(scroller.scrollLeft) / limit) * (100 - thumb);
                watchProgressFill.style.width = thumb + '%';
                if (rtlScrollType === 'ltr') {
                    watchProgressFill.style.right = 'auto';
                    watchProgressFill.style.left = left + '%';
                } else {
                    watchProgressFill.style.left = 'auto';
                    watchProgressFill.style.right = left + '%';
                }
            }

            function updateArrowButtons() {
                if (!arrowPrevBtn || !arrowNextBtn || !items.length) return;

                const limit = getScrollLimit();
                const logical = fromRaw(scroller.scrollLeft);
                const noScroll = limit <= 2 || items.length <= 1;

                arrowPrevBtn.disabled = noScroll || logical <= 5;
                arrowNextBtn.disabled = noScroll || logical >= limit - 5;
            }

            function scrollToItemByIndex(itemIndex) {
                const bounded = Math.max(0, Math.min(getMaxIndex(), itemIndex));
                logicalIndex = bounded;
                smoothScrollTo(indexToScroll(bounded));
            }

            function resetScrollerPosition() {
                stopAnimation();
                detectRtlScroll();
                logicalIndex = 0;
                scroller.scrollLeft = toRaw(0);
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
                const forwardVelocity = rtlScrollType === 'ltr' ? -pointerVelocity : pointerVelocity;
                if (forwardVelocity >= 0.45) index += 1;
                else if (forwardVelocity <= -0.45) index -= 1;
                scrollToItemByIndex(index);
            }

            scroller.addEventListener('mousedown', function(e) {
                if (!isDesktopScrollerSection() || e.button !== 0) return;

                stopAnimation();
                isMouseDown = true;
                dragDistance = 0;
                pointerVelocity = 0;
                mouseStartX = e.clientX;
                mouseStartScrollLeft = fromRaw(scroller.scrollLeft);
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
                const delta = rtlScrollType === 'ltr' ? -dx : dx;
                scroller.scrollLeft = toRaw(mouseStartScrollLeft + delta);
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
                    detectRtlScroll();
                    logicalIndex = Math.max(0, Math.min(getMaxIndex(), keep));
                    scroller.scrollLeft = toRaw(indexToScroll(logicalIndex));
                    refreshScrollerUi();
                }, 150);
            });
        });
    }

    initializeArrowScroller('section.watch');

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

    // Dubai VCA feature split — product carousel (prev / next)
    (function initDxbFeatureSplit() {
        const root = document.getElementById('dxbFeatureSplit');
        const dataEl = document.getElementById('dxbFeatureData');
        if (!root || !dataEl) return;

        let slides = [];
        try { slides = JSON.parse(dataEl.textContent || '[]'); } catch (e) { slides = []; }
        if (!slides.length) return;

        const track = root.querySelector('[data-dxb-track]');
        const dotsWrap = root.querySelector('[data-dxb-dots]');
        const titleEl = root.querySelector('[data-dxb-title]');
        const metaEl = root.querySelector('[data-dxb-meta]');
        const priceEl = root.querySelector('[data-dxb-price]');

        let index = 0;

        function renderDots() {
            dotsWrap.innerHTML = '';
            slides.forEach((_, i) => {
                const btn = document.createElement('button');
                btn.type = 'button';
                btn.className = 'dxb-feature__dot' + (i === index ? ' is-active' : '');
                btn.setAttribute('role', 'tab');
                btn.setAttribute('aria-selected', i === index ? 'true' : 'false');
                btn.addEventListener('click', () => goTo(i));
                dotsWrap.appendChild(btn);
            });
        }

        function makeThumb(i, role) {
            const slide = slides[i];
            const img = document.createElement('img');
            img.src = slide.thumb;
            img.alt = slide.name || '';
            img.draggable = false;
            img.className = 'dxb-feature__thumb ' + (role === 'active' ? 'is-active' : 'is-side');
            if (role !== 'active') {
                img.addEventListener('click', (e) => {
                    e.stopPropagation();
                    goTo(i);
                });
            }
            return img;
        }

        function renderTrack() {
            const prevBtnEl = track.querySelector('.dxb-feature__nav--prev');
            const nextBtnEl = track.querySelector('.dxb-feature__nav--next');
            if (prevBtnEl) prevBtnEl.remove();
            if (nextBtnEl) nextBtnEl.remove();
            track.innerHTML = '';

            if (slides.length === 1) {
                track.appendChild(makeThumb(index, 'active'));
                return;
            }

            const prev = (index - 1 + slides.length) % slides.length;
            const next = (index + 1) % slides.length;

            track.appendChild(makeThumb(prev, 'side'));
            if (prevBtnEl) {
                prevBtnEl.style.display = '';
                track.appendChild(prevBtnEl);
            }
            track.appendChild(makeThumb(index, 'active'));
            if (nextBtnEl) {
                nextBtnEl.style.display = '';
                track.appendChild(nextBtnEl);
            }
            track.appendChild(makeThumb(next, 'side'));
        }

        function renderInfo() {
            const slide = slides[index];
            titleEl.textContent = slide.name || '';
            metaEl.textContent = slide.meta || '';

            if (slide.price_is_link) {
                priceEl.innerHTML = '';
                const a = document.createElement('a');
                a.href = slide.url || '#';
                a.textContent = slide.price || '';
                priceEl.appendChild(a);
            } else {
                priceEl.textContent = slide.price || '';
            }
        }

        function goTo(i) {
            index = (i + slides.length) % slides.length;
            renderTrack();
            renderInfo();
            renderDots();
            bindNavClicks();
        }

        function bindNavClicks() {
            const p = track.querySelector('.dxb-feature__nav--prev');
            const n = track.querySelector('.dxb-feature__nav--next');
            if (p && !p.dataset.bound) {
                p.dataset.bound = '1';
                p.addEventListener('click', (e) => {
                    e.stopPropagation();
                    goTo(index - 1);
                });
            }
            if (n && !n.dataset.bound) {
                n.dataset.bound = '1';
                n.addEventListener('click', (e) => {
                    e.stopPropagation();
                    goTo(index + 1);
                });
            }
        }

        const rtl = document.documentElement.getAttribute('dir') === 'rtl';
        root.addEventListener('keydown', (e) => {
            if (e.key === 'ArrowLeft') goTo(rtl ? index + 1 : index - 1);
            if (e.key === 'ArrowRight') goTo(rtl ? index - 1 : index + 1);
        });

        const wrap = root.querySelector('.dxb-feature__track-wrap');
        if (wrap) {
            let startX = 0;
            let dragging = false;
            let moved = false;

            wrap.addEventListener('mouseenter', () => wrap.classList.add('is-nav-visible'));
            wrap.addEventListener('mouseleave', () => wrap.classList.remove('is-nav-visible'));

            const onDown = (clientX) => {
                dragging = true;
                moved = false;
                startX = clientX;
                wrap.classList.add('is-dragging');
            };
            const onMove = (clientX) => {
                if (!dragging) return;
                if (Math.abs(clientX - startX) > 8) moved = true;
            };
            const onUp = (clientX) => {
                if (!dragging) return;
                const dx = clientX - startX;
                dragging = false;
                wrap.classList.remove('is-dragging');
                if (!moved || Math.abs(dx) < 40) return;
                if (dx < 0) goTo(index + 1);
                else goTo(index - 1);
            };

            wrap.addEventListener('mousedown', (e) => {
                if (e.button !== 0) return;
                if (e.target.closest('.dxb-feature__nav')) return;
                onDown(e.clientX);
                e.preventDefault();
            });
            window.addEventListener('mousemove', (e) => onMove(e.clientX));
            window.addEventListener('mouseup', (e) => onUp(e.clientX));

            wrap.addEventListener('touchstart', (e) => {
                if (!e.touches[0]) return;
                if (e.target.closest('.dxb-feature__nav')) return;
                wrap.classList.add('is-nav-visible');
                onDown(e.touches[0].clientX);
            }, { passive: true });
            wrap.addEventListener('touchmove', (e) => {
                if (!e.touches[0]) return;
                onMove(e.touches[0].clientX);
            }, { passive: true });
            wrap.addEventListener('touchend', (e) => {
                const t = e.changedTouches && e.changedTouches[0];
                if (t) onUp(t.clientX);
                wrap.classList.remove('is-nav-visible');
            }, { passive: true });

            wrap.addEventListener('click', (e) => {
                if (moved && e.target.classList.contains('dxb-feature__thumb')) {
                    e.stopPropagation();
                    e.preventDefault();
                }
            }, true);
        }

        goTo(0);
    })();
});
</script>
