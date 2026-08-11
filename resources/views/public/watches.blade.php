@extends('public.layouts.header_black_white_fixed')
<style>
html,
body{
    max-width: 100%;
    overflow-x: hidden;
    overflow-x: clip;
}


/* responsive banner wrapper */
.watches-video-hero{
    position: relative;
    width: 100%;
    height: auto !important;
    min-height: 0 !important;
    overflow: hidden;
    margin: 0 !important;
    padding: 0 !important;
    background: #fff;
    line-height: 0;
}

/* responsive video - no crop */
.watches-video-hero video{
    width: 100%;
    height: auto;
    display: block;
    object-fit: contain;
    position: relative;
    vertical-align: top;
}

/* remove unwanted top gap */
.watches-video-hero,
section{
    margin-top: 0 !important;
}
</style>
<style>
/* Card base */
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

  /* Artya uses a wide, mobile-specific image. */
  .lux-card--artya .lux-ratio{ padding-top: 47.2727%; }
  .lux-card--artya .lux-box{
    inset: 24px;
    width: auto;
    height: auto;
    transform: scale(.9);
  }
  .lux-card--artya:hover .lux-box{ transform: scale(1); }
  .lux-card--artya::before,
  .lux-card--artya::after{ inset: 6px; }
}







/* Main wrapper */
.rolex-carousel .carousel-inner{
    height: auto;
    min-height: 0;
    overflow: hidden;
}

/* Each slide fills */
.hero-slide{
    height: auto;
    width: 100%;
    background-size: cover;
    background-position: center;
    position: relative;
}

/* Overlay text */
.hero-content{
    position: absolute;
    left: 50%;
    top: 35%;
    transform: translateX(-50%);
    text-align: center;
    color: #fff;
}

.hero-cta{
    display: inline-flex;
    align-items: center;
    gap: 8px;
    margin-top: 18px;
    padding: 10px 18px;
    border-radius: 30px;
    background: rgba(0,0,0,.45);
    color: #fff;
    text-decoration: none;
}
/* ✅ Vertical transition */
.rolex-carousel .carousel-item{
  transition: transform .9s ease-in-out;
}

/* Next slide comes from bottom (moves UP) */
.rolex-carousel .carousel-item-next:not(.carousel-item-start),
.rolex-carousel .active.carousel-item-end{
  transform: translateY(100%);
}

/* Prev slide comes from top (moves DOWN) */
.rolex-carousel .carousel-item-prev:not(.carousel-item-end),
.rolex-carousel .active.carousel-item-start{
  transform: translateY(-100%);
}

/* Active */
.rolex-carousel .carousel-item.active{
  transform: translateY(0);
}

/* Stack items */
.rolex-carousel .carousel-inner{
  position: relative;
  overflow: hidden;
}
.rolex-carousel .carousel-inner > .carousel-item{
  position: absolute;
  inset: 0;
}
.rolex-carousel .carousel-inner > .carousel-item.active{
  position: relative;
}

/* Dots */
.rolex-carousel .carousel-indicators{
  margin-bottom: 18px;
}
/* Hero slide wrapper */
.hero-slide{
    position: relative;
    width: 100%;
    height: auto;
    min-height: 0;
    overflow: hidden;
}

/* 🔥 Image fills slide perfectly */
.hero-bg-img{
    position: relative;
    width: 100%;
    height: auto;
    object-fit: contain;
    object-position: center;
    z-index: 0;
    display: block;
}

/* Text overlay */
.hero-content{
    position: absolute;
    left: 50%;
    top: 38%;
    transform: translateX(-50%);
    text-align: center;
    color: #fff;
    z-index: 2;
}

/* CTA */
.hero-cta{
    display: inline-block;
    margin-top: 18px;
    padding: 10px 22px;
    border-radius: 26px;
    background: rgba(0,0,0,0.45);
    color: #fff;
    text-decoration: none;
    font-size: 14px;
}
/* Base reveal state */
.reveal {
    opacity: 0;
    transition: 
        opacity 1.1s ease,
        transform 1.3s ease;
}

/* Left → Right */
.reveal-left {
    transform: translateX(-80px);
}

/* Right → Left */
.reveal-right {
    transform: translateX(80px);
}

/* When visible */
.reveal.active {
    opacity: 1;
    transform: translateX(0);
}

/* Optional: softer delay for text */
.ehed-content-container {
    transition-delay: 0.15s;
}

/* Mobile: reduce movement for elegance */
@media (max-width: 768px) {
    .reveal-left,
    .reveal-right {
        transform: translateY(40px);
    }
}

    @import url('https://fonts.googleapis.com/css2?family=Cinzel:wght@400;600;700&display=swap');
    .ehed-hero-section {
        display: flex;
        align-items: center;
    }
    .ehed-video-container {
        width: 50%;
        position: relative;
        overflow: hidden;
        min-height: 0;
        padding-top: 59.92%; /* Aspect ratio: 746/447 = 1.669 - fallback for older browsers */
    }
    @supports (aspect-ratio: 1) {
        .ehed-video-container {
            padding-top: 0;
            aspect-ratio: 746 / 430;
        }
    }
    .ehed-video-container video {
        position: absolute;
        top: 10%;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }
    .ehed-media-cover {
        position: absolute;
        top: 10px;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }
    .ehed-content-container {
        width: 50%;
        padding: 80px 60px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        background: #fff;
    }
    .ehed-category-label {
        font-size: 14px;
        font-weight: 400;
        color: #999;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Arial, sans-serif;
        margin-bottom: 20px;
    }
    .ehed-main-title {
        font-size: 3rem;
        color: #000;
        font-family: Walbaum;
        margin-bottom: 9px;
        line-height: 0.3;
        font-weight: 400;
    }
    .ehed-main-title-perrelet {
        font-size: 3rem;
        color: #000;
        font-family: Walbaum;
        margin-bottom: 36px;
        line-height: 0.3;
        font-weight: 400;
        margin-top:41px
    }
    .ehed-body-text {
        font-size: 13px;
        font-weight: 400;
        color: #000;
        line-height: 1.6;
    }
    /* .font-family--serif,
    .ehed-body-text {
        font-family: Fancy Cut, Almarai, Times, serif;
    } */
    .hero__description {
        margin-top: 1em;
        font-size: 13px;
    }
    .text-large {
        font-family: Walbaum, sans-serif;
        color: #010307;
        font-style: normal;
        font-weight: 400;
        line-height: 120%;
        font-size: 2rem;
        letter-spacing: 1.6px;
    }
    .uppercase {
        text-transform: uppercase;
    }
    h1, h2, h3, h4, h5, h6 {
        margin-top: 0;
        margin-bottom: 0;
    }
    @media (min-width: 48rem) {
        .hero__description {
            max-width: 40rem;
            font-size: 13px;
        }
        .text-align--center .hero__description {
            margin-left: auto;
            margin-right: auto;
        }
    }
    @media (min-width: 699px) {
        .text-large {
            font-size: 2.5rem;
            letter-spacing: 2px;
        }
    }
    @media (min-width: 1024px) {
        .text-large {
            font-size: 3rem;
            letter-spacing: 2.4px;
        }
    }
    @media (max-width: 1100px) {
        .ehed-hero-section {
            flex-direction: column;
            min-height: auto;
        }
        .ehed-video-container {
            width: 100%;
            height: auto;
        }
        .ehed-content-container {
            width: 100%;
            padding: 40px 30px;
        }
        .ehed-main-title {
            font-size: 48px;
        }
        .ehed-category-label {
            font-size: 12px;
        }
        .ehed-body-text {
            font-size: 13px;
        }
    }
    @media (max-width: 576px) {
        .ehed-main-title {
            font-size: 36px;
        }
        .ehed-content-container {
            padding: 30px 20px;
        }
    }
    /* MOBILE ORDER FIX */
@media (max-width: 1000px) {

    /* Always show IMAGE first on mobile */
    .ehed-hero-section {
        flex-direction: column;
    }

    .ehed-video-container {
        order: 1;
    }

    .ehed-content-container {
        order: 2;
    }
}
@media (max-width: 767px){

  .ehed-hero-section{
    display: flex;
    flex-direction: column;
  }

  /* Text comes first */
  .ehed-content-container{
    order: 1;
    padding: 24px 16px 16px;
    background: #fff; /* keeps text readable */
  }

  /* Image comes after text */
  .ehed-video-container{
    order: 2;
  }

  /* Reduce hero height issues on mobile */
  .ehed-media-cover{
    min-height: 200px;
  }
}
/* Mobile View - Reverse */
@media (max-width: 768px) {
    .ehed-main-title {
        order: 1;
        text-align:center;
    }

    .ehed-category-label {
        order: 2;
        text-align:center;
    }
    .ehed-body-text {
        order: 3;
       text-align:center;
        margin-top: -9px;
    }
}
.triangle-text {
  text-align: center;
  max-width: 700px;
  margin: 0 auto;
}
.triangle-text span {
  display: block;
  padding-left: 40px;
  padding-right: 40px;
}

.triangle-text p::before,
.triangle-text p::after {
  content: "";
  display: block;
  width: 60%;
  margin: 10px auto;
}

/* Consistent vertical rhythm for this page */
.luxury-watch-section {
    padding-top: 48px !important;
    padding-bottom: 48px !important;
}
.luxury-watch-section > p {
    margin-top: 0;
    margin-bottom: 32px;
    padding-top: 0 !important;
}
.explore-brands-section {
    padding-top: 48px;
    padding-bottom: 48px !important;
}
.explore-brands-title {
    font-family: "Argent CF", Georgia, serif !important;
    font-weight: 600;
    letter-spacing: .04em;
    margin: 40px 0;
    padding-top: 0 !important;
    padding-bottom: 0 !important;
}
.ehed-hero-section {
    margin-top: 0;
    margin-bottom: 0;
}
.ehed-media-cover,
.ehed-video-container video {
    top: 0;
}
.ehed-content-container {
    padding-top: 48px;
    padding-bottom: 48px;
}
.ehed-category-label {
    margin-top: 0;
    margin-bottom: 16px;
}
.ehed-main-title,
.ehed-main-title-perrelet {
    line-height: 1.1;
}
.ehed-main-title {
    margin-top: 0;
    margin-bottom: 16px;
}
.ehed-body-text.hero__description {
    margin-top: 0;
    margin-bottom: 0;
}
.triangle-text {
    padding-top: 48px;
    padding-bottom: 48px;
}
.ehed-main-title-perrelet {
    margin-top: 0;
    margin-bottom: 16px;
}

@media (max-width: 767px) {
    .luxury-watch-section,
    .explore-brands-section {
        padding-top: 32px !important;
        padding-bottom: 32px !important;
    }
    .luxury-watch-section > p {
        margin-bottom: 24px;
    }
    .explore-brands-title {
        margin: 24px 0;
    }
    .ehed-content-container {
        padding-top: 32px;
        padding-bottom: 32px;
    }
    .ehed-body-text {
        margin-top: 0;
    }
    .triangle-text {
        padding-top: 32px;
        padding-bottom: 20px;
    }
    .sectionOneMobile {
        margin-top: 20px !important;
        min-height: 0 !important;
    }
    .sectionOneMobile .carousel-inner,
    .sectionOneMobile .carousel-item {
        height: auto !important;
        min-height: 0 !important;
    }
    .sectionOneMobile .carousel-item img {
        width: 100%;
        height: auto !important;
        object-fit: contain !important;
        display: block;
        margin-top:35px;
    }
}
</style>
@section('content')
<section class="watches-video-hero d-none d-md-block" data-header-hero>
        <video autoplay loop muted playsinline>
            <source src="{{ asset('assets/f_assets/image/watches/FMPK-banner.mp4') }}" type="video/mp4">
            Your browser does not support the video tag.
        </video>
    </section>
    <!-- Mobile Video Banner -->
    <section class="watches-video-hero d-md-none" data-header-hero>
        <video autoplay loop muted playsinline>
            <source src="{{ asset('assets/f_assets/image/watches/FMPK-Mob-Banner.mp4') }}" type="video/mp4">
            Your browser does not support the video tag.
        </video>
    </section>



    <!-- Hero Section Slider -->
<!-- <section class="watches-desktop-hero d-none d-md-block"
    style="position: relative; overflow: hidden;">

    <div id="rolexCarousel"
         class="carousel slide rolex-carousel"
         data-bs-ride="carousel">

        <div class="carousel-inner">


            <div class="carousel-item active">
                <div class="hero-slide">
                    

                    <img
                        src="{{ asset('assets/f_assets/image/homepage_2_banner/Home Page FM BAnner.jpg') }}"
                        alt="Franck Muller"
                        class="hero-bg-img">

                    <div class="hero-content">

                    </div>

                </div>
            </div>


            <div class="carousel-item">
                <div class="hero-slide">

                    <img
                        src="{{ asset('assets/f_assets/image/watches/Bovet Web Banner.png') }}"
                        alt="Nagar"
                        class="hero-bg-img">

                    <div class="hero-content">
                    </div>

                </div>
            </div>

            <div class="carousel-item">
                <div class="hero-slide">

                    <img
                        src="{{ asset('assets/f_assets/image/watches/ML-banner-index.jpeg') }}"
                        alt="Nagar"
                        class="hero-bg-img">



                </div>
            </div>

            <div class="carousel-item">
                <div class="hero-slide">

                    <img
                        src="{{ asset('assets/f_assets/image/watches/perrelet_banner_image.jpeg') }}"
                        alt="Nagar"
                        class="hero-bg-img">

                    <div class="hero-content">
                    </div>

                </div>
            </div>
        </div>


        <div class="carousel-indicators">
            <button type="button" data-bs-target="#rolexCarousel" data-bs-slide-to="0" class="active" style="display:none;"></button>
            <button type="button" data-bs-target="#rolexCarousel" data-bs-slide-to="1"  style="display:none;"></button>
             <button type="button" data-bs-target="#rolexCarousel" data-bs-slide-to="2"  style="display:none;"></button>
  <button type="button" data-bs-target="#rolexCarousel" data-bs-slide-to="3" style="display:none;"></button>
   <button type="button" data-bs-target="#rolexCarousel" data-bs-slide-to="4" style="display:none;"></button>
        </div>

    </div>
</section> -->



<!-- <section class="sectionOne d-flex align-items-end justify-content-center text-center p-5 d-md-block d-none"
    style="position: relative; min-height: 500px; overflow: hidden;">
    <img
        src="{{ asset('assets/f_assets/image/franck_muller_new.jpg') }}"
        alt="Banner"
        style="
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            z-index: 0;
        "
    >
</section> -->

<!-- MOBILE HERO Slider-->
<!-- <section class="sectionOneMobile d-block d-md-none"
    style="position: relative; overflow: hidden;">

    <div id="rolexCarouselMobile"
         class="carousel slide"
         data-bs-ride="carousel">

        <div class="carousel-inner">

         
            <div class="carousel-item active">
                <img src="{{ asset('assets/f_assets/image/homepage_2_banner/fm-mob-view.jpg') }}"
                     class="w-100 h-100 object-fit-cover"
                     alt="Franck Muller Mobile">
            </div>

            <div class="carousel-item">
                <img src="{{ asset('assets/f_assets/image/watches mobile view/bovet_static.png') }}"
                     class="w-100 h-100 object-fit-cover"
                     alt="Bovet Mobile">
            </div>

            <div class="carousel-item">
                <img src="{{ asset('assets/f_assets/image/watches/ML-mobile-index.avif') }}"
                     class="w-100 h-100 object-fit-cover"
                     alt="ML Mobile">
            </div>

            <div class="carousel-item">
                <img src="{{ asset('assets/f_assets/image/watches mobile view/perrelee_mobile.jpg') }}"
                     class="w-100 h-100 object-fit-cover"
                     alt="Perrelet Mobile">
            </div>

        </div>

        <div class="carousel-indicators">
            <button type="button" data-bs-target="#rolexCarouselMobile" data-bs-slide-to="0" class="active"></button>
            <button type="button" data-bs-target="#rolexCarouselMobile" data-bs-slide-to="1"></button>
            <button type="button" data-bs-target="#rolexCarouselMobile" data-bs-slide-to="2"></button>
            <button type="button" data-bs-target="#rolexCarouselMobile" data-bs-slide-to="3"></button>
            <button type="button" data-bs-target="#rolexCarouselMobile" data-bs-slide-to="4"></button>

        </div>
    </div>
</section> -->

<section class="py-5 luxury-watch-section">
    <p class="text-center py-3 px-3 fs-6">
        Discover our hand picked selection of luxury Watches from renowned brands.
    </p>

    <div class="row mx-0 justify-content-center g-3 g-md-4 px-3">

        <div class="col-6 col-md">
            <a href="{{ route('subcategory', ['subcategory' => 'bovet']) }}" class="text-decoration-none d-block">
                <div class="lux-card">
                    <span class="lux-ratio"></span>
                    <img src="{{ asset('assets/f_assets/image/Watch-3.png') }}" alt="Bovet" loading="lazy" class="lux-img">
                    <div class="lux-hover">
                        <div class="lux-box">
                            <img src="{{ asset('assets/f_assets/image/watch logo/Bovet.png') }}" alt="Bovet Logo" class="lux-logo">
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-6 col-md">
            <a href="{{ route('subcategory', ['subcategory' => 'louis-moinet']) }}" class="text-decoration-none d-block">
                <div class="lux-card">
                    <span class="lux-ratio"></span>
                    <img src="{{ asset('assets/f_assets/image/lious_monet111.png') }}" alt="Louis Moinet" loading="lazy" class="lux-img">
                    <div class="lux-hover">
                        <div class="lux-box">
                            <img src="{{ asset('assets/f_assets/image/watch logo/lm.png') }}" alt="Louis Moinet Logo" class="lux-logo">
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-6 col-md">
            <a href="{{ route('subcategory', ['subcategory' => 'franck-muller']) }}" class="text-decoration-none d-block">
                <div class="lux-card">
                    <span class="lux-ratio"></span>
                    <img src="{{ asset('assets/f_assets/image/fm.png') }}" alt="Franck Muller" loading="lazy" class="lux-img">
                    <div class="lux-hover">
                        <div class="lux-box">
                            <img src="{{ asset('assets/f_assets/image/watch logo/fm.png') }}" alt="Franck Muller Logo" class="lux-logo">
                        </div>
                    </div>
                </div>
            </a>
        </div>
         <div class="col-6 col-md">
            <a href="{{ route('subcategory', ['subcategory' => 'corum']) }}" class="text-decoration-none d-block">
                <div class="lux-card">
                    <span class="lux-ratio"></span>
                    <img src="{{ asset('assets/f_assets/image/corum_back.jpeg') }}" alt="Corum" loading="lazy" class="lux-img">
                    <div class="lux-hover">
                        <div class="lux-box">
                            <img src="{{ asset('assets/f_assets/image/watch logo/Corum.png') }}" alt="Corum Logo" class="lux-logo">
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-12 col-md">
            <a href="{{ route('subcategory', ['subcategory' => 'Artya']) }}" class="text-decoration-none d-block">
                <div class="lux-card lux-card--artya">
                    <span class="lux-ratio"></span>
                    <picture>
                        <source media="(max-width: 767px)" srcset="{{ asset('assets/f_assets/image/artya-mobile.png') }}">
                        <img src="{{ asset('assets/f_assets/image/artya.png') }}" alt="Artya" loading="lazy" class="lux-img">
                    </picture>
                    <div class="lux-hover">
                        <div class="lux-box">
                            <img src="{{ asset('assets/f_assets/image/watch logo/Artya.png') }}" alt="Artya Logo" class="lux-logo">
                        </div>
                    </div>
                </div>
            </a>
        </div>

       

    </div>
</section>

<section class="pb-5">
<h2 class="explore-brands-title text-center pt-2 pb-2 mb-0">EXPLORE OUR BRANDS</h2>

<style>

.brand-grid{
display:flex;
flex-wrap:wrap;
justify-content:center;
max-width:1400px;
margin:auto;
gap:40px;
}

/* each brand box */
/* each brand box */
.brand-item{
flex:0 0 calc(25% - 40px);
display:flex;
justify-content:center;
align-items:center;
position:relative;
padding:10px;
}

/* animated border container */
.brand-item::before,
.brand-item::after{
content:"";
position:absolute;
inset:0;
border:2px solid transparent;
transition:all .5s ease;
pointer-events:none;
}

/* top & bottom lines */
.brand-item::before{
border-top-color:#c8a46a;
border-bottom-color:#c8a46a;
transform:scaleX(0);
transform-origin:left;
}

/* left & right lines */
.brand-item::after{
border-left-color:#c8a46a;
border-right-color:#c8a46a;
transform:scaleY(0);
transform-origin:top;
}

/* hover animation */
.brand-item:hover::before{
transform:scaleX(1);
}

.brand-item:hover::after{
transform:scaleY(1);
}

/* logo style */
.brand-item img{
width:100%;
max-width:306px;
height:236px;
object-fit:contain;
background:#fff;
padding:25px;
transition:all .3s ease;
}

.brand-item img:hover{
transform:scale(1.06);
}
/* tablet */
@media(max-width:992px){
.brand-item{
flex:0 0 calc(33.33% - 40px);
}
}

/* mobile */
@media(max-width:768px){

.brand-grid{
gap:20px;
}

.brand-item{
flex:0 0 calc(50% - 20px);
}

.brand-item img{
height:120px;
padding:15px;
}

}

</style>

@php
$brands = [
['name'=> 'Chronoswiss', 'slug' => 'chronoswiss', 'img' => 'Chronoswiss.avif'],
['name'=> 'Cuervo-Y-Sobrinos', 'slug' => 'cuervo-y-sobrinos', 'img' => 'CYS.avif'],
['name'=> 'Favre Leuba', 'slug' => 'favre-leuba', 'img' => 'favre-leuba.avif'],
['name'=> 'Perrelet', 'slug' => 'perrelet', 'img' => 'Perrelet.avif'],
['name'=> 'Maurice Lacroix', 'slug' => 'maurice-lacroix', 'img' => 'Maurice Lacroix.avif'],
['name'=> 'Louis Erard', 'slug' => 'louis-erard', 'img' => 'Louis Erard.avif'],
['name'=> 'Rado', 'slug' => 'rado', 'img' => 'Rado.avif'],
['name'=> 'Tissot', 'slug' => 'tissot', 'img' => 'Tisot.avif'],
['name'=> 'EPOS', 'slug' => 'epos', 'img' => 'EPOS.avif'],
['name'=> 'Armand Nicolet', 'slug' => 'armand-nicolet', 'img' => 'Armand Nicolet.avif'],
['name'=> 'Garaham', 'slug' => 'graham', 'img' => 'Garaham.avif'],
['name'=> 'Versace', 'slug' => 'versace', 'img' => 'Versace.avif'],
['name'=> 'Feregamo', 'slug' => 'ferragamo', 'img' => 'Feregamo.avif'],
['name'=> 'Swiss Military', 'slug' => 'swiss-military', 'img' => 'Swiss Military.avif'],
];
@endphp

<div class="brand-grid">

@foreach($brands as $brand)

<a class="brand-item" href="{{ route('subcategory',['subcategory'=>$brand['slug']]) }}">

<img 
src="{{ asset('assets/f_assets/image/watch logo new/'.$brand['img']) }}"
data-hover="{{ asset('assets/f_assets/image/watch logo new/hover/'.$brand['img']) }}"
alt="{{ $brand['name'] }} logo"
loading="lazy">

</a>

@endforeach

</div>

</section>
<section class="ehed-hero-section reveal reveal-left">
@php
    use Illuminate\Support\Str;

    $desktopBanner = 'assets/f_assets/image/watches/Bovet Web Banner.png';
    $mobileBanner  = 'assets/f_assets/image/watches/Bovet Web Banner.png';

    $desktopIsVideo = Str::endsWith(strtolower($desktopBanner), ['.mp4', '.webm', '.ogg']);
    $mobileIsVideo  = Str::endsWith(strtolower($mobileBanner),  ['.mp4', '.webm', '.ogg']);

    // Get extensions safely
    $desktopExtension = strtolower(pathinfo($desktopBanner, PATHINFO_EXTENSION));
    $mobileExtension  = strtolower(pathinfo($mobileBanner, PATHINFO_EXTENSION));

    // Build mime types only if video
    $desktopType = $desktopIsVideo ? "video/{$desktopExtension}" : null;
    $mobileType  = $mobileIsVideo  ? "video/{$mobileExtension}"  : null;
@endphp

    <!-- DESKTOP -->
    <div class="ehed-video-container d-none d-md-block">
        @if($desktopIsVideo)
            <video autoplay loop muted playsinline class="ehed-media-cover">
                <source src="{{ asset($desktopBanner) }}" @if($desktopType) type="{{ $desktopType }}" @endif>
                Your browser does not support the video tag.
            </video>
        @else
            <img src="{{ asset($desktopBanner) }}" alt="Ehed Banner" class="ehed-media-cover">
        @endif
    </div>

    <!-- MOBILE -->
    <div class="ehed-video-container d-block d-md-none">
        @if($mobileIsVideo)
            <video autoplay loop muted playsinline class="ehed-media-cover">
                <source src="{{ asset($mobileBanner) }}" @if($mobileType) type="{{ $mobileType }}" @endif>
                Your browser does not support the video tag.
            </video>
        @else
            <img src="{{ asset($mobileBanner) }}" alt="Ehed Banner Mobile" class="ehed-media-cover">
        @endif
    </div>

    <!-- CONTENT -->
    <div class="ehed-content-container">
        <div class="ehed-category-label">Limited Edition</div>
        <h1 class="ehed-main-title">BOVET</h1>
        <p class="ehed-body-text hero__description font-family--serif">
The Récital 30 focuses on the innovative roller system from the award winning Récital 28, allowing world travelers to accurately display 25 global time zones across the four periods of the year. The Récital 30 is one of only two world timepieces, both from BOVET, that are able to adapt to Daylight Saving Time.
        </p>
    </div>
</section>
<section class="ehed-hero-section reverse reveal reveal-right">
@php
    $desktopBanner = 'assets/f_assets/image/watches/Yatch-Banner.png';
    $mobileBanner  = 'assets/f_assets/image/watches/Yatch-Banner.png';

    $desktopIsVideo = Str::endsWith(strtolower($desktopBanner), ['.mp4', '.webm', '.ogg']);
    $mobileIsVideo  = Str::endsWith(strtolower($mobileBanner),  ['.mp4', '.webm', '.ogg']);

    $desktopExtension = strtolower(pathinfo($desktopBanner, PATHINFO_EXTENSION));
    $mobileExtension  = strtolower(pathinfo($mobileBanner, PATHINFO_EXTENSION));

    $desktopType = $desktopIsVideo ? "video/{$desktopExtension}" : null;
    $mobileType  = $mobileIsVideo  ? "video/{$mobileExtension}"  : null;
@endphp

    <!-- TEXT (LEFT on Desktop) -->
    <div class="ehed-content-container">
        <div class="ehed-category-label">Featuring Wasim Akram</div>
        <h1 class="ehed-main-title">Franck Muller</h1>
        <p class="ehed-body-text hero__description font-family--serif">
          Against the breathtaking view of Lake Geneva and the iconic Franck Muller geneve Watchland Manufacture, the legendary Wasim Akram embraced the spirit of the Vanguard Yachting Mariner. Inspired by life at sea, its bold architecture and presence embody the freedom to explore and the artistry of Swiss Haute Horlogerie.
        </p>
    </div>

    <!-- IMAGE / VIDEO (RIGHT on Desktop) -->
    <div class="ehed-video-container">
        <!-- DESKTOP -->
        <div class="d-none d-md-block">
            @if($desktopIsVideo)
                <video autoplay loop muted playsinline class="ehed-media-cover">
                    <source src="{{ asset($desktopBanner) }}" @if($desktopType) type="{{ $desktopType }}" @endif>
                </video>
            @else
                <img src="{{ asset($desktopBanner) }}" alt="Ehed Banner" class="ehed-media-cover">
            @endif
        </div>

        <!-- MOBILE -->
        <div class="d-block d-md-none">
            @if($mobileIsVideo)
                <video autoplay loop muted playsinline class="ehed-media-cover">
                    <source src="{{ asset($mobileBanner) }}" @if($mobileType) type="{{ $mobileType }}" @endif>
                </video>
            @else
                <img src="{{ asset($mobileBanner) }}" alt="Ehed Banner Mobile" class="ehed-media-cover">
            @endif
        </div>
    </div>

</section>
<script>
  document.querySelectorAll('.marquee-group img').forEach(img => {
    const originalSrc = img.src;
    const hoverSrc = img.getAttribute('data-hover');

    if (!hoverSrc) return;

    img.addEventListener('mouseenter', () => {
      img.src = hoverSrc;
    });

    img.addEventListener('mouseleave', () => {
      img.src = originalSrc;
    });
  });
</script>

<script>
document.addEventListener('DOMContentLoaded', function () {

    const revealItems = document.querySelectorAll('.reveal-on-scroll');

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('is-visible');
                observer.unobserve(entry.target); // animate only once
            }
        });
    }, {
        threshold: 0.25
    });

    revealItems.forEach(item => observer.observe(item));

});
</script>
<style>
.bannerWrap{
    width: 100%;
    aspect-ratio: 16 / 9;
    position: relative;
    overflow: hidden;
}

.bannerVideo{
    width: 100%;
    height: 100%;
    object-fit: cover;
    object-position: center;
    display: block;
}

</style>
<div class="triangle-text">
  <h1 class="ehed-main-title-perrelet">ARTYA</h1>
  <p class="ehed-body-text hero__description font-family--serif px-2">
    Experience the Purity collection by ArtyA:  new revolutionary movements where each layer of the architecture is taken to the extreme. Complexity that only appears to be simple, the essence minimalism – extreme, pure simplicity.
  </p>
</div>
<div class="container-fluid p-0">
    <section class="bannerWrap">
        <video
            class="bannerVideo"
            autoplay
            loop
            muted
            playsinline
        >
            <source src="{{ asset('assets/f_assets/image/watches/artya-14-aug.mp4') }}" type="video/mp4">
            Your browser does not support the video tag.
        </video>
    </section>
</div>
<script>
document.addEventListener('DOMContentLoaded', function () {
  const desktopCarousel = document.getElementById('rolexCarousel');
  if (desktopCarousel) {
    const desktopInstance = bootstrap.Carousel.getOrCreateInstance(desktopCarousel, {
      interval: 3000,
      pause: false,
      ride: 'carousel',
      wrap: true
    });
    desktopInstance.cycle();
  }

  const el = document.getElementById('rolexCarouselMobile');
  if (!el) return;

  new bootstrap.Carousel(el, {
    interval: 2000,   // change speed
    pause: false,     // keep moving
    ride: 'carousel'
  });
});
</script>
<script>
document.querySelectorAll('.brand-item img').forEach(img => {

const original = img.src
const hover = img.dataset.hover

img.addEventListener('mouseenter',()=>{
img.src = hover
})

img.addEventListener('mouseleave',()=>{
img.src = original
})

})
</script>
<script>
document.addEventListener('DOMContentLoaded', function () {
  const container = document.getElementById('marqueeContainer');
  if (!container) return;

  const imgs = container.querySelectorAll('.marquee-group img[data-hover]');

  // Save original src once + preload hover
  imgs.forEach(img => {
    if (!img.dataset.original) img.dataset.original = img.getAttribute('src');
    const hoverSrc = img.dataset.hover;
    if (hoverSrc) { const pre = new Image(); pre.src = hoverSrc; }
  });

  function resetAll() {
    imgs.forEach(img => {
      img.setAttribute('src', img.dataset.original);
      img.classList.remove('is-active');
    });
  }

  function activate(img) {
    resetAll(); // only one active at a time
    const hoverSrc = img.dataset.hover;
    if (hoverSrc) img.setAttribute('src', hoverSrc);
    img.classList.add('is-active');
  }

  // Desktop hover (works normally)
  imgs.forEach(img => {
    img.addEventListener('mouseenter', () => activate(img));
    img.addEventListener('mouseleave', () => resetAll());
  });

  // Mobile tap: activate logo, but don't keep it stuck when user moves next/prev
  imgs.forEach(img => {
    img.addEventListener('touchstart', function (e) {
      activate(img);
    }, { passive: true });

    // Also activate on click (some mobiles fire click instead of touch)
    img.addEventListener('click', function (e) {
      // Prevent sticky focus on iOS
      if (img.closest('a')) img.closest('a').blur?.();
      activate(img);
    });
  });

  // When user taps Next/Prev -> reset to original
  const prevBtn = document.getElementById('prevBtn');
  const nextBtn = document.getElementById('nextBtn');

  [prevBtn, nextBtn].forEach(btn => {
    if (!btn) return;
    btn.addEventListener('click', resetAll);
    btn.addEventListener('touchstart', resetAll, { passive: true });
  });

  // When user drags/swipes marquee -> reset to original
  container.addEventListener('touchmove', resetAll, { passive: true });
  container.addEventListener('touchstart', function (e) {
    // If touch is NOT on an image, reset
    if (!e.target.closest('.marquee-group img')) resetAll();
  }, { passive: true });

});
</script>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const reveals = document.querySelectorAll(".reveal");

    const observer = new IntersectionObserver(
        (entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add("active");
                    observer.unobserve(entry.target); // animate once
                }
            });
        },
        {
            threshold: 0.2,
            rootMargin: "0px 0px -80px 0px"
        }
    );

    reveals.forEach(el => observer.observe(el));
});
</script>



<script>
(function () {
  const track = document.getElementById('marqueeTrack');
  const container = document.getElementById('marqueeContainer');
  const nextBtn = document.getElementById('nextBtn');
  const prevBtn = document.getElementById('prevBtn');
  const groupA = document.getElementById('groupA');

  let position = 0;
  let speed = 2;

  let paused = false;
  let isPointerDown = false;
  let isDragging = false;
  let isButtonAnimating = false;

  let startX = 0;
  let startPos = 0;
  let activePointerId = null;

  let dragStartedOnLink = false;
  let moved = 0;

  const DRAG_THRESHOLD = 10; // px (click vs drag)

  function groupWidth() {
    return groupA ? groupA.scrollWidth : 0;
  }

  function setX(x) {
    track.style.transform = `translate3d(${x}px,0,0)`;
  }

  function wrap() {
    const w = groupWidth();
    if (!w) return;
    if (position <= -w) position += w;
    if (position > 0) position -= w;
  }

  function animate() {
    if (!paused && !isDragging && !isButtonAnimating) {
      position -= speed;
      wrap();
      setX(position);
    }
    requestAnimationFrame(animate);
  }
  animate();

  // Desktop hover pause
  container.addEventListener('mouseenter', () => paused = true);
  container.addEventListener('mouseleave', () => paused = false);

  // POINTER DOWN
  container.addEventListener('pointerdown', (e) => {
    if (e.target.closest('#nextBtn') || e.target.closest('#prevBtn')) return;

    isPointerDown = true;
    isDragging = false;
    moved = 0;

    startX = e.clientX;
    startPos = position;
    activePointerId = e.pointerId;

    // ✅ allow click on links unless drag really happens
    dragStartedOnLink = !!e.target.closest('a');

    paused = true;
  }, { passive: true });

  // POINTER MOVE
  container.addEventListener('pointermove', (e) => {
    if (!isPointerDown || e.pointerId !== activePointerId) return;

    const dx = e.clientX - startX;
    moved = Math.abs(dx);

    // ✅ only start dragging after threshold
    if (!isDragging && moved > DRAG_THRESHOLD) {
      isDragging = true;
      // capture only when dragging started (prevents stealing click)
      container.setPointerCapture(e.pointerId);
    }

    if (!isDragging) return;

    position = startPos + dx;
    wrap();
    setX(position);
  }, { passive: true });

  // POINTER UP / CANCEL
  function endPointer(e) {
    if (!isPointerDown || e.pointerId !== activePointerId) return;

    isPointerDown = false;

    if (isDragging) {
      try { container.releasePointerCapture(e.pointerId); } catch(_) {}
    }

    isDragging = false;
    activePointerId = null;

    wrap();
    setX(position);
    paused = false;
  }

  container.addEventListener('pointerup', endPointer, { passive: true });
  container.addEventListener('pointercancel', endPointer, { passive: true });

  // ✅ Prevent link click ONLY if it was a drag
  container.addEventListener('click', (e) => {
    const link = e.target.closest('a');
    if (!link) return;

    // if user dragged more than threshold, cancel click
    if (moved > DRAG_THRESHOLD) {
      e.preventDefault();
      e.stopPropagation();
    }
  }, true);

  // Buttons
  function firstItemWidth() {
    const img = track.querySelector('.marquee-group img');
    if (!img) return 0;
    const style = getComputedStyle(img);
    const margin = parseFloat(style.marginLeft) + parseFloat(style.marginRight);
    return img.offsetWidth + margin;
  }

  function smoothTo(target, duration = 450) {
    if (isButtonAnimating) return;
    isButtonAnimating = true;
    paused = true;

    const start = position;
    const change = target - start;
    const startTime = performance.now();

    function ease(t) {
      return t < 0.5 ? 4 * t * t * t : 1 - Math.pow(-2 * t + 2, 3) / 2;
    }

    function step(now) {
      const t = Math.min((now - startTime) / duration, 1);
      position = start + change * ease(t);
      wrap();
      setX(position);

      if (t < 1) requestAnimationFrame(step);
      else {
        wrap();
        setX(position);
        paused = false;
        isButtonAnimating = false;
      }
    }
    requestAnimationFrame(step);
  }

  nextBtn.addEventListener('click', (e) => {
    e.stopPropagation();
    const w = firstItemWidth();
    if (!w) return;
    smoothTo(position - w);
  });

  prevBtn.addEventListener('click', (e) => {
    e.stopPropagation();
    const w = firstItemWidth();
    if (!w) return;
    smoothTo(position + w);
  });

  window.addEventListener('load', () => {
    wrap();
    setX(position);
  });
})();
</script>

</section>

@endsection
