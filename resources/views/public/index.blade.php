@extends('public.layouts.header_latest')

@section('content')
<style>
/* =========================
   Banner Container
========================= */
/* .custom-banner{
    position: relative;
    width: 100%;
    height: 130vh;
    overflow: hidden;
    margin-top: -10rem;
}

/* Video Background 
.custom-banner-video{
    position: absolute;
    inset: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
    z-index: 0;
}

/* Image Background 
.custom-banner-image{
    position: absolute;
    inset: 0;
    width: 100%;
    height: 100%;
    background-position: center;
    background-size: cover;
    background-repeat: no-repeat;
    z-index: 0;
} */
/* Remove any container restriction */
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
  bottom: -43px;
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
/* .custom-banner-btn{
  position: absolute;
  bottom: 30px;
  left: 20%;
  transform: translateX(-50%);
padding:10px 4px 10px 4px;
  font-size: 0.8rem;
  font-weight: 500;
  background: transparent;              /* ✅ transparent 
  color: #fff;
  text-transform: uppercase;
  letter-spacing: 0px;
  display: inline-block;
  z-index: 10;
    text-decoration: none;
    border: 1px solid rgba(255,255,255,0.6); /* luxury outline 
    border-radius: 0;
    transition: all 0.3s ease;
} */
/* .custom-banner-btn:hover{
  background: rgba(180,180,180,0.95);
} */
/* remove any spacing around the section */
.carousel-section { padding:0 !important; margin:0 !important; }

/* FORCE the carousel to keep the correct banner height */
#carouselExampleRide,
#carouselExampleRide .carousel-inner,
#carouselExampleRide .carousel-item {
  width: 100%;
  height: calc(100vw * 1080 / 1935); /* ✅ exact 1935x1080 ratio */
  max-height: 1080px;               /* optional safety */
}

/* the slide wrapper must fill */
.hero-slide{
  width: 100%;
  height: 100%;
  background: #000;
  overflow: hidden;
}

/* no crop: show full banner */
.hero-slide img{
  width: 100%;
  height: 100%;
  object-fit: contain;   /* ✅ NO cutting */
  object-position: center;
  display: block;        /* ✅ removes white strip under image */
}

/* remove baseline/line-height gaps */
#carouselExampleRide .carousel-item { line-height: 0; }
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
}

.mobileStackImg{
  width: 100%;
  height: auto;
  display: block;
}
.mobileStackVideo{
  width: 100%;
  height: auto;     /* keeps proportions like image */
  display: block;   /* removes gaps */
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
   WATCHES SCROLLER
========================= */
@media (max-width: 767.98px) {
    .mobile-watches-only-section {
        overflow: hidden;
    }

    .mobile-watches-only-section .mobile-watches-only-scroller {
        overflow-x: auto;
        overflow-y: hidden;
        -webkit-overflow-scrolling: touch;
        scroll-snap-type: x mandatory;
        scrollbar-width: none;
        -ms-overflow-style: none;
        touch-action: pan-x pan-y;
        overscroll-behavior-x: contain;
        width: 100%;
    }

    .mobile-watches-only-section .mobile-watches-only-scroller::-webkit-scrollbar {
        display: none;
    }

    .mobile-watches-only-section .mobile-watches-only-track {
        display: flex;
        gap: 14px;
        width: max-content;
        padding: 0 10px;
    }

    .mobile-watches-only-section .mobile-watches-only-item {
        flex: 0 0 calc(100vw - 60px);
        width: calc(100vw - 60px);
        max-width: calc(100vw - 60px);
        scroll-snap-align: start;
    }

    .mobile-watches-only-section .mobile-watches-only-item .card,
    .mobile-watches-only-section .mobile-watches-only-item > * {
        width: 100%;
        max-width: 100%;
    }

    .mobile-watches-only-section .mobile-watches-only-dots {
        display: flex;
        justify-content: center;
    }

    .mobile-watches-only-section .mobile-watches-only-dots-container {
        display: flex;
        gap: 8px;
        overflow-x: auto;
        scrollbar-width: none;
        -ms-overflow-style: none;
    }

    .mobile-watches-only-section .mobile-watches-only-dots-container::-webkit-scrollbar {
        display: none;
    }

    .mobile-watches-only-section .mobile-watches-only-dot {
        width: 10px;
        height: 10px;
        border-radius: 50%;
        background: #c9c9c9;
        flex: 0 0 auto;
        cursor: pointer;
        transition: 0.25s ease;
    }

    .mobile-watches-only-section .mobile-watches-only-dot.active {
        background: #000;
    }
}

</style>
<section class="custom-banner d-none d-md-block position-relative">
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
    <!--<video class="mobileStackVideo" autoplay muted loop playsinline preload="metadata" poster="{{ asset('assets/f_assets/image/nagar/mobile.mp4') }}" > <source src="{{ asset('assets/f_assets/image/nagar/mobile.mp4') }}" type="video/mp4"> </video>-->
 <img
  class="mobileStackVideo"
  src="{{ asset('assets/f_assets/image/misterio_data/misterio_mobile.jpeg') }}"
  alt="Divine Treasure"
  loading="lazy"
/>

  </div>
<a href="/collections/nagar" class="custom-banner-btn-new">DISCOVER MORE</a>
</section>
    <!-- Desktop/Tablet Section -->
<!-- Desktop/Tablet WATCHES Section -->
    <section class="onlineStore watch d-none d-md-block"style="background-color:#f6f3ee;">
        <!-- <h2 class="text-center mb-3" style="font-family: 'Fancy Cut', Almarai, 'Times New Roman', serif;margin-top:-22px">WATCHES</h2> -->
        <div class="mobile-product-scroller onlineStore">
            <div class="scroller-container">
                @foreach ($products  as $key => $product)
                    <div class="scroller-item">
                        @include('public.partials.product-card-new', ['product' => $product])
                    </div>
                @endforeach
            </div>
        </div>
        <div class="scroller-dots mt-3">
            <div class="dots-container">
                @php
                    $totalWatches = count($products);
                    $watchesPerView = 4;
                    $totalWatchDots = max(0, $totalWatches - $watchesPerView + 1);
                @endphp
                @for ($i = 0; $i < $totalWatchDots; $i++)
                    <div class="dot {{ $i === 0 ? 'active' : '' }}" data-index="{{ $i + $watchesPerView - 1 }}"></div>
                @endfor
            </div>
        </div>
    </section>

    <!-- Mobile WATCHES Section with Horizontal Scroller -->
  <section class="mobile-watches-only-section py-5 d-md-none" style="background-color:#f6f3ee;">
    <div class="mobile-watches-only-scroller">
        <div class="mobile-watches-only-track">
            @foreach ($products as $key => $product)
                <div class="mobile-watches-only-item">
                    @include('public.partials.product-card-new', ['product' => $product])
                </div>
            @endforeach
        </div>
    </div>

    <div class="mobile-watches-only-dots mt-3">
        <div class="mobile-watches-only-dots-container">
            @for ($i = 0; $i < count($products); $i++)
                <div class="mobile-watches-only-dot {{ $i === 0 ? 'active' : '' }}" data-index="{{ $i }}"></div>
            @endfor
        </div>
    </div>
</section>

   <section class="d-md-block d-none carousel-section p-0 m-0">
  <div id="carouselExampleRide" class="carousel slide carousel-fade" data-bs-ride="carousel">

    <div class="carousel-inner">
      <div class="carousel-item active">
        <div class="hero-slide">
          <img src="{{ asset('assets/f_assets/image/homepage_2_banner/Bovet Web Banner.avif') }}" alt="Bovet Watch">
        </div>
      </div>

       <div class="carousel-item">
        <div class="hero-slide">
          <img src="{{ asset('assets/f_assets/image/homepage_2_banner/loius_monet.jpeg') }}" alt="Louis Moinet">
        </div>
      </div>

      <div class="carousel-item">
        <div class="hero-slide">
          <img src="{{ asset('assets/f_assets/image/homepage_2_banner/fm_new.avif') }}" alt="Franck Muller">
        </div>
      </div>

      <div class="carousel-item">
        <div class="hero-slide">
          <img src="{{ asset('assets/f_assets/image/homepage_2_banner/ml_new.avif') }}" alt="Maurice Lacroix">
        </div>
      </div>

      <!--<div class="carousel-item">-->
      <!--  <div class="hero-slide">-->
      <!--    <img src="{{ asset('assets/f_assets/image/homepage_2_banner/Perrelet.avif') }}" alt="Perrelet">-->
      <!--  </div>-->
      <!--</div>-->

       <div class="carousel-item">
        <div class="hero-slide">
          <img src="{{ asset('assets/f_assets/image/homepage_2_banner/corum.jpeg') }}" alt="Favre Leuba">
        </div>
      </div>
    </div>

    <!-- controls must be inside -->
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

    <!-- Mobile Banner Carousel Section -->
    <section class="d-md-none">
        <div id="carouselMobileBanner" class="carousel slide carousel-fade" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="{{ asset('assets/f_assets/image/homepage_2_banner/Bovet_mobile.avif') }}" class="d-block w-100" alt="Franck Muller Mobile">
                </div>
                  <div class="carousel-item">
                    <img src="{{ asset('assets/f_assets/image/homepage_2_banner/LM Watch Mobile.avif') }}" class="d-block w-100" alt="Perrelet Mobile">
                </div>
                <div class="carousel-item active">
                    <img src="{{ asset('assets/f_assets/image/homepage_2_banner/fm_new_mobile.avif') }}" class="d-block w-100" alt="Franck Muller Mobile">
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('assets/f_assets/image/homepage_2_banner/ml_new_mobile.avif') }}" class="d-block w-100" alt="Maurice Mobile">
                </div>
                <!--<div class="carousel-item">-->
                <!--    <img src="{{ asset('assets/f_assets/image/homepage_2_banner/Perrelet-Mobile.avif') }}" class="d-block w-100" alt="Perrelet Mobile">-->
                <!--</div>-->
                 <div class="carousel-item">
                    <img src="{{ asset('assets/f_assets/image/homepage_2_banner/favre_leuba_mobile.avif') }}" class="d-block w-100" alt="Perrelet Mobile">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselMobileBanner"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselMobileBanner"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </section>
    <section class="onlineStore d-none d-md-block" style="background-color:#f6f3ee;">
    <h2 class="text-center" style="font-family:Cormorant Garamond, serif;">
        Bespoke Collections
    </h2>

    <div class="slider-viewport">
        <!-- Prev -->
        <button type="button" class="slider-arrow prev" id="desktopPrevBtn" aria-label="Previous">
            <span aria-hidden="true" class="arrow-icon arrow-left">
                <svg viewBox="0 0 24 24" height="24" width="24" fill="currentColor">
                    <path d="M12.6 12L8.7 8.1C8.52 7.92 8.42 7.68 8.42 7.4C8.42 7.12 8.52 6.88 8.7 6.7C8.88 6.52 9.12 6.42 9.4 6.42C9.68 6.42 9.92 6.52 10.1 6.7L14.7 11.3C14.8 11.4 14.87 11.51 14.91 11.62C14.95 11.74 14.97 11.87 14.97 12C14.97 12.13 14.95 12.26 14.91 12.38C14.87 12.49 14.8 12.6 14.7 12.7L10.1 17.3C9.92 17.48 9.68 17.57 9.4 17.57C9.12 17.57 8.88 17.48 8.7 17.3C8.52 17.12 8.42 16.88 8.42 16.6C8.42 16.32 8.52 16.08 8.7 15.9L12.6 12Z"/>
                </svg>
            </span>
        </button>

        <!-- Slider -->
        <div class="mobile-product-scroller onlineStore" style="background-color:#f6f3ee;">
            <div class="scroller-track" id="productSliderDesktop">

                @foreach ($products_new as $key => $product)
              <div class="scroller-item">

@php
$collectionLinks = [
    0 => 'hasht',
    1 => 'qaws-al-matar',
    2 => 'nagar',
    3 => 'gulposh',
    4 => 'tawoos',
    5 => 'gohar',
    6 => 'haphazard',
];
@endphp

<a href="{{ url('collections/' . ($collectionLinks[$loop->index] ?? $product->slug)) }}" class="text-decoration-none d-block">

    <div class="lux-card">

        <span class="lux-ratio"></span>

        <img 
            src="{{ asset($product->image) }}"
            alt="{{ $product->name }}"
            class="lux-img"
            loading="lazy"
        >

        <div class="lux-hover">
            <div class="lux-box">

                @if(!empty($product->hover_image))
                    <img 
                        src="{{ asset($product->hover_image) }}"
                        alt="{{ $product->name }}"
                        class="lux-logo"
                    >
                @else
                    <span class="text-dark fw-semibold text-center px-2">
                        {{ $product->name }}
                    </span>
                @endif

            </div>
        </div>

    </div>

</a>

</div>

                @endforeach

            </div>
        </div>

        <!-- Next -->
        <button type="button" class="slider-arrow next" id="desktopNextBtn" aria-label="Next">
            <span aria-hidden="true" class="arrow-icon">
                <svg viewBox="0 0 24 24" height="24" width="24" fill="currentColor">
                    <path d="M12.6 12L8.7 8.1C8.52 7.92 8.42 7.68 8.42 7.4C8.42 7.12 8.52 6.88 8.7 6.7C8.88 6.52 9.12 6.42 9.4 6.42C9.68 6.42 9.92 6.52 10.1 6.7L14.7 11.3C14.8 11.4 14.87 11.51 14.91 11.62C14.95 11.74 14.97 11.87 14.97 12C14.97 12.13 14.95 12.26 14.91 12.38C14.87 12.49 14.8 12.6 14.7 12.7L10.1 17.3C9.92 17.48 9.68 17.57 9.4 17.57C9.12 17.57 8.88 17.48 8.7 17.3C8.52 17.12 8.42 16.88 8.42 16.6C8.42 16.32 8.52 16.08 8.7 15.9L12.6 12Z"/>
                </svg>
            </span>
        </button>
    </div>
</section>

<!-- ========================= MOBILE SECTION ========================= -->
<section class="mobile-jewelry-section d-md-none" style="background-color:#f6f3ee;">
    <h2 class="text-center mb-4" style="font-family:'Fancy Cut', Almarai, 'Times New Roman', serif;">
        Bespoke Collection
    </h2>

    <div class="slider-viewport">

        <!-- Prev -->
        <button type="button" class="slider-arrow prev" id="mobilePrevBtn" aria-label="Previous">
            <span aria-hidden="true" class="arrow-icon arrow-left">
                <svg viewBox="0 0 24 24" height="24" width="24" fill="currentColor">
                    <path d="M12.6 12L8.7 8.1C8.52 7.92 8.42 7.68 8.42 7.4C8.42 7.12 8.52 6.88 8.7 6.7C8.88 6.52 9.12 6.42 9.4 6.42C9.68 6.42 9.92 6.52 10.1 6.7L14.7 11.3C14.8 11.4 14.87 11.51 14.91 11.62C14.95 11.74 14.97 11.87 14.97 12C14.97 12.13 14.95 12.26 14.91 12.38C14.87 12.49 14.8 12.6 14.7 12.7L10.1 17.3C9.92 17.48 9.68 17.57 9.4 17.57C9.12 17.57 8.88 17.48 8.7 17.3C8.52 17.12 8.42 16.88 8.42 16.6C8.42 16.32 8.52 16.08 8.7 15.9L12.6 12Z"/>
                </svg>
            </span>
        </button>

        <!-- Slider -->
        <div class="mobile-product-scroller onlineStore" style="background-color:#f6f3ee;">
            <div class="scroller-track" id="productSliderMobile">

                @foreach ($products_new as $key => $product)
<div class="scroller-item">

@php
$collectionLinks = [
    0 => 'hasht',
    1 => 'qaws-al-matar',
    2 => 'nagar',
    3 => 'gulposh',
    4 => 'tawoos',
    5 => 'gohar',
    6 => 'haphazard',
];
@endphp

<a href="{{ url('collections/' . ($collectionLinks[$loop->index] ?? $product->slug)) }}" class="text-decoration-none d-block">

    <div class="lux-card">

        <span class="lux-ratio"></span>

        <img 
            src="{{ asset($product->image) }}"
            alt="{{ $product->name }}"
            class="lux-img"
            loading="lazy"
        >

        <div class="lux-hover">
            <div class="lux-box">

                @if(!empty($product->hover_image))
                    <img 
                        src="{{ asset($product->hover_image) }}"
                        alt="{{ $product->name }}"
                        class="lux-logo"
                    >
                @else
                    <span class="text-dark fw-semibold text-center px-2">
                        {{ $product->name }}
                    </span>
                @endif

            </div>
        </div>

    </div>

</a>

</div>
@endforeach

            </div>
        </div>

        <!-- Next -->
        <button type="button" class="slider-arrow next" id="mobileNextBtn" aria-label="Next">
            <span aria-hidden="true" class="arrow-icon">
                <svg viewBox="0 0 24 24" height="24" width="24" fill="currentColor">
                    <path d="M12.6 12L8.7 8.1C8.52 7.92 8.42 7.68 8.42 7.4C8.42 7.12 8.52 6.88 8.7 6.7C8.88 6.52 9.12 6.42 9.4 6.42C9.68 6.42 9.92 6.52 10.1 6.7L14.7 11.3C14.8 11.4 14.87 11.51 14.91 11.62C14.95 11.74 14.97 11.87 14.97 12C14.97 12.13 14.95 12.26 14.91 12.38C14.87 12.49 14.8 12.6 14.7 12.7L10.1 17.3C9.92 17.48 9.68 17.57 9.4 17.57C9.12 17.57 8.88 17.48 8.7 17.3C8.52 17.12 8.42 16.88 8.42 16.6C8.42 16.32 8.52 16.08 8.7 15.9L12.6 12Z"/>
                </svg>
            </span>
        </button>

    </div>
</section>

<style>
/* ========================= SLIDER VIEWPORT ========================= */
.slider-viewport{
    position: relative;
    width: 100%;
}

.mobile-product-scroller{
    width: 100%;
    overflow: hidden;
}

/* ========================= TRACK ========================= */
.scroller-track{
    display: flex;
    gap: 20px;
    transition: transform 0.45s ease;
    will-change: transform;
}

/* ========================= ITEMS ========================= */
.scroller-item{
    flex: 0 0 auto;
}

/* Desktop item width */
.d-none.d-md-block .scroller-item{
    width: calc((100% - 60px) / 4);
}

/* Mobile item width */
.d-md-none .scroller-item{
    width: calc(100% - 60px);
}

/* ========================= ARROWS ========================= */
.slider-arrow{
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    width: 42px;
    height: 42px;
    border: none;
    border-radius: 50%;
    background: rgba(0, 0, 0, 0.92);
    color: #fff;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    z-index: 9999;
    transition: all 0.25s ease;
    padding: 0;
}

.slider-arrow.prev{ left: 0; }
.slider-arrow.next{ right: 0; }

.slider-arrow:hover{
    background: #000;
    transform: translateY(-50%) scale(1.08);
}

.slider-arrow:disabled{
    opacity: 0.35;
    cursor: not-allowed;
}

.arrow-icon{
    display: flex;
    align-items: center;
    justify-content: center;
    line-height: 1;
}

.arrow-icon svg{
    width: 22px;
    height: 22px;
    display: block;
}

.arrow-left svg{
    transform: rotate(180deg);
}

/* keep arrows a little inside */
@media (min-width: 768px){
    .slider-arrow.prev{ left: 8px; }
    .slider-arrow.next{ right: 8px; }
    .slider-viewport{ padding: 0 20px; }
}

@media (max-width: 767.98px){
    .slider-arrow{
        width: 42px;
        height: 42px;
    }

    .slider-arrow.prev{ left: 4px; }
    .slider-arrow.next{ right: 4px; }

    .slider-viewport{ padding: 0 10px; }
    .scroller-track{ gap: 14px; }

    .d-md-none .scroller-item{
        width: calc(100% - 30px);
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function () {
    function setupArrowOnlySlider(sliderId, prevBtnId, nextBtnId, itemsPerViewDesktop = 4, itemsPerViewMobile = 1) {
        const track = document.getElementById(sliderId);
        const prevBtn = document.getElementById(prevBtnId);
        const nextBtn = document.getElementById(nextBtnId);

        if (!track || !prevBtn || !nextBtn) return;

        const items = track.querySelectorAll('.scroller-item');
        if (!items.length) return;

        let currentIndex = 0;

        function getGap() {
            const styles = window.getComputedStyle(track);
            return parseFloat(styles.gap) || 20;
        }

        function getItemsPerView() {
            return window.innerWidth >= 768 ? itemsPerViewDesktop : itemsPerViewMobile;
        }

        function getMaxIndex() {
            return Math.max(0, items.length - getItemsPerView());
        }

        function updateSlider() {
            const item = items[0];
            const itemWidth = item.getBoundingClientRect().width;
            const gap = getGap();
            const moveAmount = itemWidth + gap;

            track.style.transform = `translateX(-${currentIndex * moveAmount}px)`;

            prevBtn.disabled = currentIndex <= 0;
            nextBtn.disabled = currentIndex >= getMaxIndex();
        }

        nextBtn.addEventListener('click', function () {
            if (currentIndex < getMaxIndex()) {
                currentIndex++;
                updateSlider();
            }
        });

        prevBtn.addEventListener('click', function () {
            if (currentIndex > 0) {
                currentIndex--;
                updateSlider();
            }
        });

        window.addEventListener('resize', function () {
            if (currentIndex > getMaxIndex()) {
                currentIndex = getMaxIndex();
            }
            updateSlider();
        });

        updateSlider();
    }

    setupArrowOnlySlider('productSliderDesktop', 'desktopPrevBtn', 'desktopNextBtn', 4, 1);
    setupArrowOnlySlider('productSliderMobile', 'mobilePrevBtn', 'mobileNextBtn', 4, 1);
});
</script>
<section class="container py-4">
<h4 class="section-title text-center py-3 pb-5 mt-4">
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
          <a href="#" class="hero-btn">DISCOVER</a>
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
<section class="container py-4">

  <h4 class="section-title text-center"style="margin-top:20px">
    INTERNATIONAL WATCH BRAND
  </h4>

 <style>
/* GRID */
.brand-grid{
    display:flex;
    flex-wrap:wrap;
    justify-content:center;
    max-width:1400px;
    margin:auto;
    gap:40px;
}

/* ITEM */
.brand-item{
    flex:0 0 calc(25% - 40px);
    display:flex;
    justify-content:center;
    align-items:center;
    position:relative;
    padding:10px;
    text-decoration:none;
}

/* IMAGE STYLE */
.brand-item img{
    width:100%;
    max-width:306px;
    height:236px;
    object-fit:contain;
    background:#fff;
    padding:25px;
    transition:opacity 0.3s ease, transform 0.3s ease;
}

/* HOVER SCALE */
.brand-item:hover img{
    transform:scale(1.06);
}

/* TABLET */
@media(max-width:992px){
    .brand-item{
        flex:0 0 calc(33.33% - 40px);
    }
}

/* MOBILE */
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
['name'=> 'Bovet', 'slug' => 'bovet', 'img' => 'Bovet.avif'],
['name'=> 'Louis Moinet', 'slug' => 'louis-moinet', 'img' => 'LM.avif'],
['name'=> 'Franck Muller', 'slug' => 'franck-muller', 'img' => 'FM.avif'],
['name'=> 'Corum', 'slug' => 'corum', 'img' => 'Corum.avif'],
['name'=> 'Artya', 'slug' => 'Artya', 'img' => 'Artya.avif'],
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

<!-- JS HOVER EFFECT -->
<script>
document.querySelectorAll('.brand-item img').forEach(function(img){

    const original = img.src;
    const hover = img.getAttribute('data-hover');

    img.addEventListener('mouseenter', function(){
        if(hover){
            img.style.opacity = '0.3';
            setTimeout(() => {
                img.src = hover;
                img.style.opacity = '1';
            }, 150);
        }
    });

    img.addEventListener('mouseleave', function(){
        img.style.opacity = '0.3';
        setTimeout(() => {
            img.src = original;
            img.style.opacity = '1';
        }, 150);
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
    .section-title {
  font-family: "Cormorant Garamond", serif;
  font-size: clamp(28px, 1.3vw, 44px);
  font-weight: 600;
  margin: 0 0 14px;
  color: #111;
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
document.addEventListener('DOMContentLoaded', function () {
    const section = document.querySelector('.mobile-watches-only-section');
    if (!section) return;

    const scroller = section.querySelector('.mobile-watches-only-scroller');
    const items = section.querySelectorAll('.mobile-watches-only-item');
    const dots = section.querySelectorAll('.mobile-watches-only-dot');

    if (!scroller || !items.length || !dots.length) return;

    function getStep() {
        if (items.length > 1) {
            const step = items[1].offsetLeft - items[0].offsetLeft;
            return step > 0 ? step : items[0].offsetWidth;
        }
        return items[0].offsetWidth;
    }

    function updateDots() {
        const step = getStep();
        if (!step) return;

        const index = Math.max(
            0,
            Math.min(dots.length - 1, Math.round(scroller.scrollLeft / step))
        );

        dots.forEach((dot, i) => {
            dot.classList.toggle('active', i === index);
        });
    }

    dots.forEach((dot, index) => {
        dot.addEventListener('click', function () {
            if (!items[index]) return;

            scroller.scrollTo({
                left: items[index].offsetLeft,
                behavior: 'smooth'
            });
        });
    });

    scroller.addEventListener('scroll', updateDots, { passive: true });
    window.addEventListener('resize', updateDots);

    updateDots();
});
</script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const section = document.querySelector('.mobile-watches-only-section');
    if (!section) return;

    const scroller = section.querySelector('.mobile-watches-only-scroller');
    const items = section.querySelectorAll('.mobile-watches-only-item');
    const dots = section.querySelectorAll('.mobile-watches-only-dot');

    if (!scroller || !items.length || !dots.length) return;

    function getStep() {
        if (items.length > 1) {
            return items[1].offsetLeft - items[0].offsetLeft;
        }
        return items[0].offsetWidth;
    }

    function updateDots() {
        const step = getStep();
        if (!step) return;

        const index = Math.max(0, Math.min(dots.length - 1, Math.round(scroller.scrollLeft / step)));

        dots.forEach((dot, i) => {
            dot.classList.toggle('active', i === index);
        });
    }

    dots.forEach((dot, index) => {
        dot.addEventListener('click', function () {
            if (!items[index]) return;

            scroller.scrollTo({
                left: items[index].offsetLeft,
                behavior: 'smooth'
            });
        });
    });

    scroller.addEventListener('scroll', updateDots, { passive: true });
    window.addEventListener('resize', updateDots);

    updateDots();
});
</script>
<script>
document.addEventListener('DOMContentLoaded', function () {

    function initWatchScroller(sectionSelector, itemsPerViewDesktop = 4) {
        const section = document.querySelector(sectionSelector);
        if (!section) return;

        const scroller = section.querySelector('.mobile-product-scroller');
        const container = section.querySelector('.scroller-container');
        const items = section.querySelectorAll('.scroller-item');
        const dots = section.querySelectorAll('.dot');

        if (!scroller || !container || !items.length) return;

        const isMobile = window.innerWidth < 768;

        function getStep() {
            if (items.length > 1) {
                return items[1].offsetLeft - items[0].offsetLeft;
            }
            return items[0].offsetWidth;
        }

        function getDesktopIndex() {
            const step = getStep();
            if (!step) return 0;
            return Math.round(scroller.scrollLeft / step);
        }

        function getMobileIndex() {
            const step = getStep();
            if (!step) return 0;
            return Math.round(scroller.scrollLeft / step);
        }

        function updateDots() {
            if (!dots.length) return;

            if (window.innerWidth < 768) {
                const activeIndex = Math.max(0, Math.min(dots.length - 1, getMobileIndex()));
                dots.forEach((dot, i) => dot.classList.toggle('active', i === activeIndex));
            } else {
                const maxDesktopIndex = Math.max(0, items.length - itemsPerViewDesktop);
                const activeIndex = Math.max(0, Math.min(maxDesktopIndex, getDesktopIndex()));
                dots.forEach((dot, i) => dot.classList.toggle('active', i === activeIndex));
            }
        }

        function scrollToIndex(index) {
            if (!items[index]) return;

            scroller.scrollTo({
                left: items[index].offsetLeft,
                behavior: 'smooth'
            });
        }

        dots.forEach((dot, index) => {
            dot.addEventListener('click', function () {
                scrollToIndex(index);
            });
        });

        scroller.addEventListener('scroll', updateDots, { passive: true });
        window.addEventListener('resize', updateDots);

        updateDots();
    }

    initWatchScroller('.mobile-watches-section', 1);
    initWatchScroller('section.onlineStore.watch', 4);
});
</script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Function to initialize scroller for a specific section
    function initializeScroller(sectionClass) {
        const scroller = document.querySelector(`${sectionClass} .mobile-product-scroller`);
        const dots = document.querySelectorAll(`${sectionClass} .dot`);
        const dotsContainer = document.querySelector(`${sectionClass} .dots-container`);
        const items = document.querySelectorAll(`${sectionClass} .scroller-item`);
        
        if (!scroller || !dots.length || !items.length) {
            return;
        }
        
        let isAnimating = false;
        let startX = 0;
        let startY = 0;
        let startScrollLeft = 0;
        let manualDotSelection = false;
        let isInteractingWithCarousel = false;
        
        // Smooth animated scroll with easing for better UX
        function smoothScrollTo(element, target) {
            isAnimating = true;
            const startLeft = element.scrollLeft;
            const distance = target - startLeft;
            const duration = 500; // ms: adjust for speed
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
                    isAnimating = false;
                }
            }

            requestAnimationFrame(step);
        }
        
        // Helper: get horizontal step between consecutive items
        function getItemStep() {
            if (items.length >= 2) {
                const step = items[1].offsetLeft - items[0].offsetLeft;
                return step > 0 ? step : items[0].getBoundingClientRect().width;
            }
            return items[0].getBoundingClientRect().width;
        }
        
        // Helper: get nearest item index to current scrollLeft using measured step
        function getNearestIndex() {
            const step = getItemStep();
            if (!step || step <= 0) return 0;
            const rawIndex = Math.round(scroller.scrollLeft / step);
            const clamped = Math.max(0, Math.min(items.length - 1, rawIndex));
            return clamped;
        }
        
        function updateActiveDot() {
            if (manualDotSelection) {
                return;
            }
            
            const boundedIndex = getNearestIndex();
            const isDesktopJewellery = scroller.closest('section.onlineStore:not(.watch)');
            const isDesktopWatches = scroller.closest('section.watch');
            
            if (isDesktopJewellery || isDesktopWatches) {
                let mappedDotIndex = 1;
                if (boundedIndex >= 0) {
                    mappedDotIndex = Math.min(dots.length - 1, boundedIndex);
                }
                
                dots.forEach((dot, i) => {
                    dot.classList.toggle('active', i === mappedDotIndex);
                });
                
                if (dotsContainer && dots[mappedDotIndex]) {
                    const activeDot = dots[mappedDotIndex];
                    const containerWidth = dotsContainer.offsetWidth;
                    const dotLeft = activeDot.offsetLeft;
                    const dotCenter = dotLeft + (activeDot.offsetWidth / 2);
                    const containerCenter = containerWidth / 2;
                    const scrollLeftDots = Math.max(0, dotCenter - containerCenter);
                    dotsContainer.scrollTo({ left: scrollLeftDots, behavior: 'auto' });
                }
            } else {
                dots.forEach((dot, index) => {
                    dot.classList.toggle('active', index === boundedIndex);
                });
            }
        }
        
        // Snap using the same native smooth scroll as arrows
        function snapToNearest() {
            if (isAnimating) return;
            const index = getNearestIndex();
            const targetLeft = items[index].offsetLeft;
            smoothScrollTo(scroller, targetLeft);
        }
        
        function scrollToIndex(index) {
            // For desktop sections (jewellery and watches), each dot represents a specific product
            const isDesktopJewellery = scroller.closest('section.onlineStore:not(.watch)');
            const isDesktopWatches = scroller.closest('section.watch');
            
            if (isDesktopJewellery || isDesktopWatches) {
                // Index now directly represents the product position
                const targetItem = items[index];
                if (!targetItem) return;
                
                const targetLeft = targetItem.offsetLeft;
                isAnimating = true;
                smoothScrollTo(scroller, targetLeft);
            } else {
                // Original logic for mobile sections
                const targetItem = items[index];
                if (!targetItem) return;
                
                const targetLeft = targetItem.offsetLeft;
                isAnimating = true;
                smoothScrollTo(scroller, targetLeft);
            }
        }
        
        // Mouse click and drag functionality for desktop
        let isMouseDown = false;
        let mouseStartX = 0;
        let mouseStartScrollLeft = 0;

        scroller.addEventListener('mousedown', function(e) {
            // Only enable for desktop sections
            const isDesktopSection = scroller.closest('section.onlineStore:not(.watch)') || scroller.closest('section.watch');
            if (!isDesktopSection) return;
            
            isMouseDown = true;
            mouseStartX = e.clientX;
            mouseStartScrollLeft = scroller.scrollLeft;
            scroller.style.cursor = 'grabbing';
            e.preventDefault();
        });

        scroller.addEventListener('mousemove', function(e) {
            if (!isMouseDown) return;
            e.preventDefault();
            const x = e.clientX;
            const walk = (mouseStartX - x) * 2; // Scroll speed multiplier
            scroller.scrollLeft = mouseStartScrollLeft + walk;
        });

        scroller.addEventListener('mouseup', function() {
            isMouseDown = false;
            scroller.style.cursor = 'grab';
            // Snap to nearest item for carousel-like behavior
            snapToNearest();
        });

        scroller.addEventListener('mouseleave', function() {
            isMouseDown = false;
            scroller.style.cursor = 'grab';
            // Snap to nearest item when leaving
            snapToNearest();
        });

        // Set initial cursor style for desktop sections
        const isDesktopSection = scroller.closest('section.onlineStore:not(.watch)') || scroller.closest('section.watch');
        if (isDesktopSection) {
            scroller.style.cursor = 'grab';
        }

        // Touch handling on outer scroller
        scroller.addEventListener('touchstart', function(e) {
            const carousel = e.target.closest('.carousel');
            if (carousel) {
                isInteractingWithCarousel = true;
            } else {
                isInteractingWithCarousel = false;
            }
            startX = e.touches[0].clientX;
            startY = e.touches[0].clientY;
            startScrollLeft = scroller.scrollLeft;
        }, { passive: true });
        
        scroller.addEventListener('touchmove', function(e) {
            if (isInteractingWithCarousel) {
                const currentX = e.touches[0].clientX;
                const currentY = e.touches[0].clientY;
                const diffX = Math.abs(currentX - startX);
                const diffY = Math.abs(currentY - startY);
                if (diffX > diffY && diffX > 10) {
                    e.preventDefault();
                    e.stopPropagation();
                }
            }
        }, { passive: false });
        
        scroller.addEventListener('touchend', function() {
            // Don't snap to nearest to avoid jerky behavior
            isInteractingWithCarousel = false;
            startX = 0;
            startY = 0;
            startScrollLeft = 0;
        }, { passive: true });
        
        // Wheel handling: snap shortly after user stops scrolling
        let wheelSnapTimer = null;
        scroller.addEventListener('wheel', function() {
            const isDesktopSection = scroller.closest('section.onlineStore:not(.watch)') || scroller.closest('section.watch');
            if (!isDesktopSection) return;
            if (wheelSnapTimer) clearTimeout(wheelSnapTimer);
            wheelSnapTimer = setTimeout(() => {
                snapToNearest();
            }, 120);
        }, { passive: true });
        
        // Dot clicks using the same native smooth scroll as arrows
        dots.forEach((dot, index) => {
            dot.addEventListener('click', function() {
                // Set flag to prevent updateActiveDot from overriding
                manualDotSelection = true;
                // Clear all active states
                dots.forEach((d) => d.classList.remove('active'));
                // Set clicked dot as active
                dot.classList.add('active');
                // Scroll to the target
                scrollToIndex(index);
                // Reset flag after scroll completes
                setTimeout(() => {
                    manualDotSelection = false;
                }, 500);
            });
        });
        
        // Scroll updates for dots only (no snap)
        let scrollRAF = null;
        scroller.addEventListener('scroll', function() {
            // Throttle with rAF for smooth active-dot updates
            if (scrollRAF) cancelAnimationFrame(scrollRAF);
            scrollRAF = requestAnimationFrame(() => {
                updateActiveDot();
                scrollRAF = null;
            });
        });
        
        // Initialize first indicator as active
        // For desktop sections, ensure first dot is active on page load
        const isDesktopJewellery = scroller.closest('section.onlineStore:not(.watch)');
        const isDesktopWatches = scroller.closest('section.watch');
        
        if (isDesktopJewellery || isDesktopWatches) {
            // Clear all active states first
            dots.forEach((dot) => {
                dot.classList.remove('active');
            });
            // Set first dot as active by default (represents 4th product)
            if (dots.length > 0) {
                dots[0].classList.add('active');
            }
        } else {
            updateActiveDot();
        }
    }
    
    // Initialize all sections
    initializeScroller('.mobile-jewelry-section');
    initializeScroller('.mobile-watches-section');
    initializeScroller('section.onlineStore:not(.watch)'); // Desktop jewellery section (not watches)
    initializeScroller('section.watch'); // Desktop watches section
    
    // Add desktop-specific CSS for single row layout and responsive banners
    const desktopStyle = document.createElement('style');
    desktopStyle.textContent = `
        /* Responsive Main Banner Styles */
        .main-banner-video {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            z-index: 0;
            /* Ensure video maintains aspect ratio on all screen sizes */
            min-width: 100%;
            min-height: 100%;
        }
        
        .main-banner-image {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            z-index: 0;
            /* Ensure image maintains aspect ratio on all screen sizes */
            background-size: cover;
            background-position: center center;
            background-repeat: no-repeat;
        }
        
        .main-banner-content {
            position: relative;
            z-index: 1;
            width: 100%;
            height: 100%;
            display: flex;
            align-items: flex-end;
            justify-content: center;
            padding: 24px;
        }
        
        /* Ensure banner section maintains proper aspect ratio */
        .sectionOne {
            position: relative;
            overflow: hidden;
            /* Maintain 16:9 aspect ratio on larger screens */
            aspect-ratio: 16/9;
        }
        
        /* Override aspect ratio for smaller screens */
        @media (max-width: 991.98px) {
            .sectionOne {
                aspect-ratio: unset;
            }
        }
        
        /* Responsive banner heights for different screen sizes */
        .sectionOne {
            min-height: 500px;
        }
        
        /* Small screens (up to 576px) */
        @media (max-width: 575.98px) {
            .sectionOne {
                min-height: 400px;
            }
            .main-banner-content {
                padding: 16px;
            }
        }
        
        /* Medium screens (576px to 768px) */
        @media (min-width: 576px) and (max-width: 767.98px) {
            .sectionOne {
                min-height: 450px;
            }
        }
        
        /* Large screens (768px to 992px) */
        @media (min-width: 768px) and (max-width: 991.98px) {
            .sectionOne {
                min-height: 500px;
            }
        }
        
        /* Extra large screens (992px to 1200px) */
        @media (min-width: 992px) and (max-width: 1199.98px) {
            .sectionOne {
                min-height: 600px;
            }
        }
        
        /* XXL screens (1200px to 1366px) */
        @media (min-width: 1200px) and (max-width: 1365.98px) {
            .sectionOne {
                min-height: 650px;
            }
        }
        
        /* Ultra-wide screens (1366px and above) */
        @media (min-width: 1366px) {
            .sectionOne {
                min-height: 700px;
            }
            .main-banner-content {
                padding: 32px;
            }
        }
        
        /* 4K and larger screens (1920px and above) */
        @media (min-width: 1920px) {
            .sectionOne {
                min-height: 800px;
            }
            .main-banner-content {
                padding: 40px;
            }
        }
        
        /* Desktop jewellery scroller - single row layout */
        section.onlineStore .mobile-product-scroller {
            overflow-x: auto;
            overflow-y: hidden;
            -webkit-overflow-scrolling: touch;
            scrollbar-width: none;
            -ms-overflow-style: none;
            user-select: none; /* Prevent text selection during drag */
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
        }
        section.onlineStore .mobile-product-scroller::-webkit-scrollbar {
            display: none;
        }
        section.onlineStore .scroller-container {
            display: flex;
            gap: 10px;
            padding: 0 0px;
            width: max-content;
        }
        section.onlineStore .scroller-item {
            flex: 0 0 300px;
            max-width: 300px;
            min-width: 300px;
        }
        
        /* Responsive product card sizing */
        @media (min-width: 768px) and (max-width: 991.98px) {
            section.onlineStore .scroller-item {
                flex: 0 0 320px;
                max-width: 320px;
                min-width: 320px;
            }
        }
        
        @media (min-width: 992px) and (max-width: 1199.98px) {
            section.onlineStore .scroller-item {
                flex: 0 0 340px;
                max-width: 340px;
                min-width: 340px;
            }
        }
        
        @media (min-width: 1200px) and (max-width: 1365.98px) {
            section.onlineStore .scroller-item {
                flex: 0 0 360px;
                max-width: 360px;
                min-width: 360px;
            }
        }
        
        @media (min-width: 1366px) {
            section.onlineStore .scroller-item {
                flex: 0 0 380px;
                max-width: 380px;
                min-width: 380px;
            }
        }
        
        @media (min-width: 1920px) {
            section.onlineStore .scroller-item {
                flex: 0 0 400px;
                max-width: 400px;
                min-width: 400px;
            }
        }
        section.onlineStore .scroller-item .card {
            width: 100%;
            height: 100%;
        }
        
        /* Desktop jewellery dots styling */
        section.onlineStore:not(.watch) .scroller-dots {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }
        section.onlineStore:not(.watch) .dots-container {
            display: flex;
            gap: 8px;
        }
        section.onlineStore:not(.watch) .dot {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background-color: #ccc;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        section.onlineStore:not(.watch) .dot.active {
            background-color: #000 !important;
        }
        section.onlineStore:not(.watch) .dot:hover {
            background-color: #666;
        }
        
        /* Desktop watches scroller - same layout as jewellery */
        section.watch .mobile-product-scroller {
            overflow-x: auto;
            overflow-y: hidden;
            -webkit-overflow-scrolling: touch;
            scrollbar-width: none;
            -ms-overflow-style: none;
            user-select: none; /* Prevent text selection during drag */
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
        }
        section.watch .mobile-product-scroller::-webkit-scrollbar {
            display: none;
        }
        section.watch .scroller-container {
            display: flex;
            gap: 10px;
            padding: 0 0px;
            width: max-content;
        }
        section.watch .scroller-item {
            flex: 0 0 300px;
            max-width: 300px;
            min-width: 300px;
        }
        
        /* Responsive watch card sizing */
        @media (min-width: 768px) and (max-width: 991.98px) {
            section.watch .scroller-item {
                flex: 0 0 320px;
                max-width: 320px;
                min-width: 320px;
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
            section.watch .scroller-item {
                flex: 0 0 380px;
                max-width: 380px;
                min-width: 380px;
            }
        }
        
        @media (min-width: 1920px) {
            section.watch .scroller-item {
                flex: 0 0 400px;
                max-width: 400px;
                min-width: 400px;
            }
        }
        section.watch .scroller-item .card {
            width: 100%;
            height: 100%;
        }
        
        /* Desktop watches dots styling */
        section.watch .scroller-dots {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }
        section.watch .dots-container {
            display: flex;
            gap: 8px;
        }
        section.watch .dot {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background-color: #ccc;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        section.watch .dot.active {
            background-color: #000 !important;
        }
        section.watch .dot:hover {
            background-color: #666;
        }
        
        /* Responsive brand logos section */
        .brandLogo {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            align-items: center;
            gap: 1rem;
        }
        
        .brandLogo .col-md-3 {
            flex: 0 0 auto;
            max-width: 280px;
        }
        
        .brandLogo img {
            width: 100%;
            height: auto;
            max-height: 120px;
            object-fit: contain;
            transition: transform 0.3s ease;
        }
        
        .brandLogo img:hover {
            transform: scale(1.05);
        }
        
        /* Mobile: Force 2 items per row */
        @media (max-width: 767.98px) {
            .brandLogo .col-6 {
                flex: 0 0 calc(50% - 0.5rem) !important;
                max-width: calc(50% - 0.5rem) !important;
                width: calc(50% - 0.5rem) !important;
            }
        }
        
        /* Responsive adjustments for brand logos */
        @media (min-width: 1366px) {
            .brandLogo .col-md-3 {
                max-width: 320px;
            }
            .brandLogo img {
                max-height: 140px;
            }
        }
        
        @media (min-width: 1920px) {
            .brandLogo .col-md-3 {
                max-width: 360px;
            }
            .brandLogo img {
                max-height: 160px;
            }
        }
        
        /* Responsive international jewellery brands section */
        .brands-section .container .row.g-3 {
            display: flex;
            flex-wrap: wrap;
            gap: 1rem;
        }
        
        .brands-section .container .row.g-3 .col-md-6 {
            flex: 0 0 calc(50% - 0.5rem);
            max-width: calc(50% - 0.5rem);
        }
        
        /* Mobile: Full width for brand images */
        @media (max-width: 767.98px) {
            .brands-section .container .row.g-3 .col-md-6,
            .brands-section .container .row.g-3 .col-12 {
                flex: 0 0 100%;
                max-width: 100%;
            }
        }
        
        .brands-section .container .row.g-3 img {
            width: 100%;
            height: auto;
            object-fit: cover;
            border-radius: 8px;
            transition: transform 0.3s ease;
        }
        
        .brands-section .container .row.g-3 img:hover {
            transform: scale(1.02);
        }
        
        /* Responsive adjustments for jewellery brands */
        @media (min-width: 1366px) {
            .brands-section .container .row.g-3 .col-md-6 {
                flex: 0 0 calc(50% - 1rem);
                max-width: calc(50% - 1rem);
            }
        }
        
        @media (min-width: 1920px) {
            .brands-section .container .row.g-3 .col-md-6 {
                flex: 0 0 calc(50% - 1.5rem);
                max-width: calc(50% - 1.5rem);
            }
        }
        
        /* Responsive Typography */
        h2 {
            font-size: clamp(1.5rem, 4vw, 2.5rem);
            font-weight: 200;
            letter-spacing: 1px;
            margin-bottom: 0rem;
        }
        
        /* Small screens */
        @media (max-width: 575.98px) {
            h2 {
                font-size: 1.35rem;
                margin-bottom: 1.5rem;
                margin-top: 30px;
            }
            .watch-brands-section h2 {
                font-size: 1.5rem;
            }
            .mb-4 {
                margin-bottom: -0.4rem !important;
            }
            .py-5 {
                padding-top: 2rem !important;
                padding-bottom: 2rem !important;
            }
        }
        
        /* Medium screens */
        @media (min-width: 576px) and (max-width: 767.98px) {
            h2 {
                font-size: 1.5rem;
                margin-bottom: 1.75rem;
            }
        }
        
        /* Large screens */
        @media (min-width: 768px) and (max-width: 991.98px) {
            h2 {
                font-size: 2rem;
                margin-bottom: 0rem;
            }
        }
        
        /* Extra large screens */
        @media (min-width: 992px) and (max-width: 1199.98px) {
            h2 {
                font-size: 2rem;
                margin-bottom: 0rem;
            }
        }
        
        /* XXL screens */
        @media (min-width: 1200px) and (max-width: 1365.98px) {
            h2 {
                   margin-bottom: 2.5rem;
                margin-bottom: 0rem;
            }
        }
        
        /* Ultra-wide screens */
        @media (min-width: 1366px) {
            h2 {
                font-size: 2.75rem;
                margin-bottom: 0rem;
            }
            .py-5 {
                padding-top: 4rem !important;
                padding-bottom: 4rem !important;
            }
        }
        
        /* 4K and larger screens */
        @media (min-width: 1920px) {
            h2 {
                font-size: 3rem;
                margin-bottom: 3.5rem;
            }
            .py-5 {
                padding-top: 5rem !important;
                padding-bottom: 5rem !important;
            }
        }
        
        /* Responsive Product Cards */
        .card {
            border: none;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
        }
        
        .card-title {
            font-size: clamp(0.9rem, 2.5vw, 1.1rem);
            font-weight: 500;
            line-height: 1.4;
            margin-bottom: 0.75rem;
        }
        
        .card-text {
            font-size: clamp(0.85rem, 2vw, 1rem);
            font-weight: 600;
            color: #333;
        }
        
        .btn {
            font-size: clamp(0.8rem, 2vw, 0.9rem);
            padding: 0.5rem 1.25rem;
            border-radius: 6px;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        
        .btn:hover {
            transform: translateY(-2px);
        }
        
        /* Responsive Container Padding */
        .container {
            padding-left: 1rem;
            padding-right: 1rem;
        }
        
        @media (min-width: 576px) {
            .container {
                padding-left: 1.5rem;
                padding-right: 1.5rem;
            }
        }
        
        @media (min-width: 768px) {
            .container {
                padding-left: 2rem;
                padding-right: 2rem;
            }
        }
        
        @media (min-width: 992px) {
            .container {
                padding-left: 2.5rem;
                padding-right: 2.5rem;
            }
        }
        
        @media (min-width: 1200px) {
            .container {
                padding-left: 3rem;
                padding-right: 3rem;
            }
        }
        
        @media (min-width: 1366px) {
            .container {
                padding-left: 4rem;
                padding-right: 4rem;
            }
        }
        
        @media (min-width: 1920px) {
            .container {
                padding-left: 5rem;
                padding-right: 5rem;
            }
        }
        
        /* Responsive Section Spacing */
        section {
            margin-bottom: 0;
        }
        
        @media (min-width: 1366px) {
            // section {
            //     margin-bottom: 1rem;
            // }
        }
        
        @media (min-width: 1920px) {
            // section {
            //     margin-bottom: 2rem;
            // }
        }
        
        /* Mobile Banner Responsive Improvements */
        .mobile-banner-section {
            position: relative;
            width: 100%;
            overflow: hidden;
            background-color: #000;
        }

        .mobile-banner-section::before {
            content: "";
            display: block;
            padding-top: 140%;
        }

        @supports (aspect-ratio: 3 / 4) {
            .mobile-banner-section {
                aspect-ratio: 3 / 4;
            }

            .mobile-banner-section::before {
                display: none;
            }
        }
        
        .mobile-banner-video {
            position: absolute;
            inset: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center;
            z-index: 0;
        }
        
        .mobile-banner-content {
            position: absolute;
            inset: 0;
            z-index: 1;
            width: 100%;
            height: 100%;
            display: flex;
            align-items: flex-end;
            justify-content: center;
            padding: 16px;
        }
        
        /* Responsive mobile banner aspect ratio adjustments */
        @media (max-width: 375px) {
            .mobile-banner-section::before {
                padding-top: 150%;
            }
        }
        
        @media (min-width: 415px) and (max-width: 575px) {
            .mobile-banner-section::before {
                padding-top: 135%;
            }
            .mobile-banner-content {
                padding: 20px;
            }
        }
        
        /* Responsive Button Improvements */
        .btn-white {
            background-color: rgba(255, 255, 255, 0.95);
            color: #333;
            border: 2px solid rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            font-weight: 600;
            letter-spacing: 0.5px;
        }
        
        .btn-white:hover {
            background-color: rgba(255, 255, 255, 1);
            color: #000;
            border-color: rgba(255, 255, 255, 1);
            transform: translateY(-2px);
        }
        
        /* Responsive Carousel Controls */
        .carousel-control-prev,
        .carousel-control-next {
            width: 50px;
            height: 50px;
            background: none;
            border: none;
            top: 50%;
            transform: translateY(-50%);
            opacity: 0.7;
            transition: opacity 0.3s ease;
        }
        
        .carousel-control-prev:hover,
        .carousel-control-next:hover {
            opacity: 1;
            background: none;
        }
        
        @media (min-width: 1366px) {
            .carousel-control-prev,
            .carousel-control-next {
                width: 60px;
                height: 60px;
                background: none;
            }
        }
        
        @media (min-width: 1920px) {
            .carousel-control-prev,
            .carousel-control-next {
                width: 70px;
                height: 70px;
                background: none;
            }
        }
        
        /* Mobile Product Scroller Responsive Improvements */
        .mobile-product-scroller {
            overflow-x: auto;
            overflow-y: hidden;
            -webkit-overflow-scrolling: touch;
            scrollbar-width: none;
            -ms-overflow-style: none;
        }
        
        .mobile-product-scroller::-webkit-scrollbar {
            display: none;
        }
        
        .scroller-container {
            display: flex;
            gap: 15px;
            padding: 0 10px;
            width: max-content;
        }
        
        .scroller-item {
            flex: 0 0 280px;
            max-width: 280px;
            min-width: 280px;
        }
        
        /* Responsive mobile scroller item sizing */
        @media (max-width: 375px) {
            .scroller-item {
                flex: 0 0 250px;
                max-width: 250px;
                min-width: 250px;
            }
            .scroller-container {
                gap: 10px;
                padding: 0 5px;
            }
        }
        
        @media (min-width: 376px) and (max-width: 414px) {
            .scroller-item {
                flex: 0 0 260px;
                max-width: 260px;
                min-width: 260px;
            }
        }
        
        @media (min-width: 415px) and (max-width: 575px) {
            .scroller-item {
                flex: 0 0 270px;
                max-width: 270px;
                min-width: 270px;
            }
        }
        
        /* Responsive dots styling */
        .scroller-dots {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }
        
        .dots-container {
            display: flex;
            gap: 8px;
            overflow-x: auto;
            scrollbar-width: none;
            -ms-overflow-style: none;
            margin-bottom:16px;
        }
        
        .dots-container::-webkit-scrollbar {
            display: none;
        }
        
        .dot {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background-color: #ccc;
            cursor: pointer;
            transition: background-color 0.3s ease;
            flex-shrink: 0;
        }
        
        .dot.active {
            background-color: #000 !important;
        }
        
        .dot:hover {
            background-color: #666;
        }
        
        /* Responsive dot sizing */
        @media (min-width: 768px) {
            .dot {
                width: 12px;
                height: 12px;
            }
        }
        
        @media (min-width: 1366px) {
            .dot {
                width: 14px;
                height: 14px;
            }
        }
        
        /* Comprehensive Section Responsiveness for 1366x768+ Screens */
        
        /* Jewellery Section Responsive Improvements */
        .onlineStore {
            padding: 1.5rem 0;
        }
        
        @media (min-width: 1366px) {
            .onlineStore {
                padding: 1.5rem 0;
            }
            .onlineStore h2 {
                 font-size: 2rem;
                margin-bottom: 0rem;
                letter-spacing: 2px;
            }
        }
        
        @media (min-width: 1920px) {
            .onlineStore {
                padding: 0.5rem 0;
            }
            .onlineStore h2 {
                 font-size: 2rem;
                margin-bottom: 1rem;
                margin-top:1rem;
                letter-spacing: 3px;
            }
        }
        
        /* Watch Carousel Section Responsive Improvements */
        .carousel-section {
            margin: 2rem 0;
        }
        
        @media (min-width: 1366px) {
            .carousel-section {
                margin: 3rem 0;
            }
        }
        
        @media (min-width: 1920px) {
            .carousel-section {
                margin: 4rem 0;
            }
        }
        
        /* Watches Section Responsive Improvements */
        .watch {
            padding: 3rem 0;
        }
        
        @media (min-width: 1366px) {
            .watch {
                padding: 1.5rem 0;
            }
            .watch h2 {
                font-size: 3rem;
                margin-bottom: 3.5rem;
                letter-spacing: 2px;
            }
        }
        
        @media (min-width: 1920px) {
            .watch {
                padding: 1.5rem 0;
            }
            .watch h2 {
                font-size: 3.5rem;
                margin-bottom: 4rem;
                letter-spacing: 3px;
            }
        }
        
        /* International Brands Section Responsive Improvements */
        .brands-section {
            padding: 3rem 0;
        }
        
        @media (min-width: 1366px) {
            .brands-section {
                padding: 4rem 0;
            }
            // .brands-section h2 {
            //     font-size: 2.75rem;
            //     margin-bottom: 3rem;
            //     letter-spacing: 2px;
            // }
        }
        
        @media (min-width: 1920px) {
            .brands-section {
                padding: 5rem 0;
            }
            // .brands-section h2 {
            //     font-size: 3.25rem;
            //     margin-bottom: 3.5rem;
            //     letter-spacing: 3px;
            // }
        }
        
        /* Watch Brands Section Responsive Improvements */
        .watch-brands-section {
            padding: 3rem 0;
        }
        
        /* Base desktop/tablet styles */
        .watch-brands-section h2 {
            font-size: 1.75rem;
            margin-bottom: 3rem;
            letter-spacing: 1.5px;
            font-weight: 200;
        }
        
        @media (min-width: 300px) and (max-width: 540px) {
            .watch-brands-section h2,
            .watch-brands-heading {
                font-size: 1.35rem;
                line-height: 1.3;
                margin-bottom: 1.25rem;
                margin-top:70px;
            }
        }
        
        @media (min-width: 1366px) {
            .watch-brands-section {
                padding: 4rem 0;
            }
            .watch-brands-section h2 {
                font-size: 2.2rem;
                margin-bottom: 3rem;
                letter-spacing: 2px;
            }
        }
        
        @media (min-width: 1920px) {
            .watch-brands-section {
                padding: 5rem 0;
            }
            .watch-brands-section h2 {
                font-size: 1.75rem;
                margin-bottom: 3.5rem;
                letter-spacing: 3px;
            }
        }
        
        /* Enhanced Product Card Responsiveness for Larger Screens */
        @media (min-width: 1366px) {
            .card {
                border-radius: 16px;
                box-shadow: 0 4px 12px rgba(0,0,0,0.12);
            }
            
            .card:hover {
                transform: translateY(-8px);
                box-shadow: 0 12px 35px rgba(0,0,0,0.2);
            }
            
            .card-title {
                font-size: 1.2rem;
                margin-bottom: 1rem;
            }
            
            .card-text {
                font-size: 1.1rem;
            }
            
            .btn {
                font-size: 1rem;
                padding: 0.75rem 1.5rem;
                border-radius: 8px;
            }
        }
        
        @media (min-width: 1920px) {
            .card {
                border-radius: 20px;
                box-shadow: 0 6px 16px rgba(0,0,0,0.15);
            }
            
            .card:hover {
                transform: translateY(-10px);
                box-shadow: 0 16px 45px rgba(0,0,0,0.25);
            }
            
            .card-title {
                font-size: 1.3rem;
                margin-bottom: 1.25rem;
            }
            
            .card-text {
                font-size: 1.2rem;
            }
            
            .btn {
                font-size: 1.1rem;
                padding: 0.875rem 1.75rem;
                border-radius: 10px;
            }
        }
        
        /* Enhanced Scroller Responsiveness */
        @media (min-width: 1366px) {
            section.onlineStore .scroller-container,
            section.watch .scroller-container {
                gap: 20px;
                padding: 0 20px;
            }
        }
        
        @media (min-width: 1920px) {
            section.onlineStore .scroller-container,
            section.watch .scroller-container {
                gap: 25px;
                padding: 0 25px;
            }
        }
        
        /* Enhanced Dots Responsiveness */
        @media (min-width: 1366px) {
            .scroller-dots {
                margin-top: 30px;
            }
            
            .dots-container {
                gap: 12px;
            }
            
            .dot {
                width: 16px;
                height: 16px;
            }
        }
        
        @media (min-width: 1920px) {
            .scroller-dots {
                margin-top: 35px;
            }
            
            .dots-container {
                gap: 15px;
            }
            
            .dot {
                width: 18px;
                height: 18px;
            }
        }
        
        /* Enhanced Brand Logo Responsiveness */
        @media (min-width: 1366px) {
            .brandLogo {
                gap: 1.5rem;
            }
            
            .brandLogo .col-md-3 {
                max-width: 240px;
            }
            
            .brandLogo img {
                max-height: 100px;
                border-radius: 8px;
            }
        }
        
        @media (min-width: 1920px) {
            .brandLogo {
                gap: 2rem;
            }
            
            .brandLogo .col-md-3 {
                max-width: 280px;
            }
            
            .brandLogo img {
                max-height: 120px;
                border-radius: 10px;
            }
        }
        
        /* Enhanced International Brands Responsiveness */
        @media (min-width: 1366px) {
            .brands-section .container .row.g-3 {
                gap: 1.5rem;
            }
            
            .brands-section .container .row.g-3 .col-md-6 {
                flex: 0 0 calc(50% - 0.75rem);
                max-width: calc(50% - 0.75rem);
            }
            
            .brands-section .container .row.g-3 img {
                border-radius: 12px;
            }
        }
        
        @media (min-width: 1920px) {
            .brands-section .container .row.g-3 {
                gap: 2rem;
            }
            
            .brands-section .container .row.g-3 .col-md-6 {
                flex: 0 0 calc(50% - 1rem);
                max-width: calc(50% - 1rem);
            }
            
            .brands-section .container .row.g-3 img {
                border-radius: 16px;
            }
        }
        
        /* Enhanced Button Responsiveness */
        @media (min-width: 1366px) {
            .btn-white {
                font-size: 1.1rem;
                padding: 0.875rem 2rem;
                letter-spacing: 1px;
                border-radius: 8px;
            }
        }
        
        @media (min-width: 1920px) {
            .btn-white {
                font-size: 1.2rem;
                padding: 1rem 2.25rem;
                letter-spacing: 1.5px;
                border-radius: 10px;
            }
        }
        
        /* Enhanced Carousel Control Responsiveness */
        @media (min-width: 1366px) {
            .carousel-control-prev,
            .carousel-control-next {
                width: 65px;
                height: 65px;
                background: none;
            }
        }
        
        @media (min-width: 1920px) {
            .carousel-control-prev,
            .carousel-control-next {
                width: 75px;
                height: 75px;
                background: none;
            }
        }
        
        /* Remove all carousel backgrounds */
        .carousel-control-prev,
        .carousel-control-next {
            background: none !important;
            background-color: transparent !important;
            border: none !important;
        }
        
        .carousel-control-prev:hover,
        .carousel-control-next:hover {
            background: none !important;
            background-color: transparent !important;
        }
        
        .carousel-control-prev:focus,
        .carousel-control-next:focus {
            background: none !important;
            background-color: transparent !important;
        }
        
        .carousel-control-prev:active,
        .carousel-control-next:active {
            background: none !important;
            background-color: transparent !important;
        }
        
        /* Remove carousel inner backgrounds */
        .carousel-inner {
            background: none !important;
        }
        
        .carousel-item {
            background: none !important;
        }
        
        /* Remove any Bootstrap carousel backgrounds */
        .carousel {
            background: none !important;
        }
    `;
    document.head.appendChild(desktopStyle);

    // Slow down homepage banner carousel (between Jewellery and Watches)
    const carouselEl = document.getElementById('carouselExampleRide');
    if (carouselEl && window.bootstrap && bootstrap.Carousel) {
        bootstrap.Carousel.getOrCreateInstance(carouselEl, {
            interval: 7000, // slower auto-advance (7s)
            ride: 'carousel',
            wrap: true,
            pause: 'hover',
            keyboard: false
        });
        // Soften the fade transition
        const style = document.createElement('style');
        style.textContent = `
            /* Responsive desktop carousel height */
            #carouselExampleRide {
                height: clamp(700px, 65vh, 820px);
            }
            
            /* Small screens (up to 576px) */
            @media (max-width: 575.98px) {
                #carouselExampleRide { height: clamp(300px, 50vh, 400px); }
            }
            
            /* Medium screens (576px to 768px) */
            @media (min-width: 576px) and (max-width: 767.98px) {
                #carouselExampleRide { height: clamp(350px, 55vh, 500px); }
            }
            
            /* Large screens (768px to 992px) */
            @media (min-width: 768px) and (max-width: 991.98px) {
                #carouselExampleRide { height: clamp(400px, 60vh, 600px); }
            }
            
            /* Extra large screens (992px to 1200px) */
            @media (min-width: 992px) and (max-width: 1199.98px) {
                #carouselExampleRide { height: clamp(500px, 65vh, 700px); }
            }
            
            /* XXL screens (1200px to 1366px) */
            @media (min-width: 1200px) and (max-width: 1365.98px) {
                #carouselExampleRide { height: clamp(600px, 70vh, 800px); }
            }
            
            /* Ultra-wide screens (1366px and above) */
            @media (min-width: 1366px) {
                #carouselExampleRide { height: clamp(700px, 75vh, 900px); }
            }
            
            /* 4K and larger screens (1920px and above) */
            @media (min-width: 1920px) {
                #carouselExampleRide { height: clamp(800px, 80vh, 1000px); }
            }
            
            #carouselExampleRide .carousel-inner,
            #carouselExampleRide .carousel-item {
                height: 100%;
            }
            #carouselExampleRide .carousel-item img {
                height: 100%;
                object-fit: cover;
            }
            #carouselExampleRide.carousel.carousel-fade .carousel-item {
                transition: opacity 1.5s ease-in-out !important;
            }
        `;
        document.head.appendChild(style);
    }
    
    // Initialize mobile banner carousel with same slow timing
    const mobileCarouselEl = document.getElementById('carouselMobileBanner');
    if (mobileCarouselEl && window.bootstrap && bootstrap.Carousel) {
        bootstrap.Carousel.getOrCreateInstance(mobileCarouselEl, {
            interval: 7000, // slower auto-advance (7s)
            ride: 'carousel',
            wrap: true,
            pause: 'hover',
            keyboard: false
        });
        // Soften the fade transition for mobile
        const mobileStyle = document.createElement('style');
        mobileStyle.textContent = `
            /* Mobile carousel: show full image to keep all text visible */
            #carouselMobileBanner {
                height: auto;
            }
            #carouselMobileBanner .carousel-inner,
            #carouselMobileBanner .carousel-item {
                height: auto;
            }
            #carouselMobileBanner .carousel-item img {
                width: 100%;
                height: auto;
                object-fit: contain; /* ensure no cropping of text in images */
                background: none; /* remove background */
                display: block;
            }
            
            /* Small devices: add some vertical breathing room */
            @media (max-width: 575.98px) {
                // #carouselMobileBanner { 
                //     padding-top: 8px; 
                //     padding-bottom: 8px; 
                // }
            }
            
            /* Medium devices: slightly more padding */
            @media (min-width: 576px) and (max-width: 767.98px) {
                #carouselMobileBanner { 
                    padding-top: 12px; 
                    padding-bottom: 12px; 
                }
            }
            
            #carouselMobileBanner.carousel.carousel-fade .carousel-item {
                transition: opacity 1.5s ease-in-out !important;
            }
        `;
        document.head.appendChild(mobileStyle);
    }
});
</script>
