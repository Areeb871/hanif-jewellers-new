@extends('public.layouts.header_latest')

@section('content')
<style>
/* =======================
   DESKTOP HERO BASE
   ======================= */
.heroBanner{
  position: relative;
  width: 100%;
  height: 1100px;
  max-height: 1100px;
  overflow: hidden;
  background: #000;
  margin-top: -10rem;

  display: flex;
  align-items: center;
  justify-content: center;
}

/* Image */
.heroImg{
  position: absolute;              /* ✅ FIX: prevent height collapse */
  inset: 0;
  width: 100%;
  height: 100%;
  object-fit: cover;
  object-position: center;
  display: block;
}
/* Video behaves exactly like image banner */
.heroVideo{
  position: absolute;
  inset: 0;
  width: 100%;
  height: 100%;
  object-fit: cover;     /* cinematic fill */
  object-position: center;
  z-index: 1;
}
/* Overlay box */
.heroOverlay{
  position: absolute;
  right: -145px;        /* moved from left to right */
  bottom: 120px;
  width: min(530px, 70%);
  padding: 38px 6px;
  text-align: center;
  z-index: 2;
}
/* Overlay box */
.heroOverlay-left{
  position: absolute;
  left: 70px;        /* moved from left to right */
  bottom: 120px;
  width: min(530px, 70%);
  padding: 38px 6px;
  text-align: center;
  z-index: 2;
}

/* Typography */
.heroTitle{
  margin: 0 0 10px;
  letter-spacing: 6px;
  font-size: 44px;
  line-height: 1.05;
  color: white;
  font-weight: 500;
    font-family: 'Diplomacy', sans-serif;
}

.heroText{
  margin: 0 auto 22px;
  font-size: 20px;
  color: white;
  max-width: 540px;
  margin-top:-13px;
}
/* Typography */
.heroTitle-last{
  margin: 0 0 10px;
  letter-spacing: 6px;
  font-size: 44px;
  line-height: 1.05;
  color: black;
  font-weight: 500;
    font-family: 'Diplomacy', sans-serif;
}

.heroText-last{
  margin: 0 auto 22px;
  font-size: 20px;
  color: black;
  max-width: 540px;
  margin-top:-13px;
}
.heroBtn{
  display: inline-block;
  background: transparent;     /* transparent by default */
  color: #111;                 /* dark text */
  text-decoration: none;
  padding: 14px 26px;
  letter-spacing: 2px;
  font-size: 12px;
  text-align: center;
  margin-top: -12px;

  border: 1px solid #111;      /* outline style */
  transition: all 0.3s ease;   /* smooth luxury hover */
}

/* Hover effect */
.heroBtn:hover{
  background: #111;            /* black on hover */
  color: #fff;                /* text turns white */
  border-color: #111;
}
/* =======================
   EDGE-TO-EDGE FIX
   ======================= */
.heroBanner.d-lg-block{
  width: 100vw;
  margin-left: calc(-50vw + 50%);
  margin-right: calc(-50vw + 50%);
}
.heroTextWrap{
  display: flex;
  justify-content: center;
  align-items: center;
  padding: 40px 20px;
  overflow: visible;
}
.triangleText{
  text-align: center;
  line-height: 1.7;    /* extra safety */
  font-size:18px;
}

.triangleText span{
  display: block;
  margin: 0 auto;
  font-size:18px;
}



/* =======================
   RESPONSIVE RATIO (DESKTOP)
   ======================= */
@media (min-width: 992px){
  .heroBanner{
    aspect-ratio: 1750 / 992;
    height: auto;
    max-height: 1100px;
  }
}

/* =======================
   TABLET / MOBILE SAFETY
   ======================= */
@media (max-width: 991px){
  .heroBanner{ height: 750px; }

  .heroOverlay{
    left: 20px;
    right: 20px;
    bottom: 30px;
    width: auto;
    padding: 22px;
  }

  .heroTitle{
    font-size: 30px;
    letter-spacing: 4px;
  }
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

.mobileStackContent{
  width: 100%;
  background: #fff;
  text-align: center;
  padding: 26px 18px 28px;
}

.mobileTitle{
  margin: 0 0 10px;
  font-size: 34px;
  letter-spacing: 7px;
  font-weight: 500;
  color: #111;
}

.mobileSub{
  margin: 0 0 10px;
  font-size: 14px;
  color: #111;
}

.mobileText{
  margin: 0 auto 18px;
  max-width: 520px;
  font-size: 13px;
  line-height: 1.6;
  color: #333;
}

.mobileBtn{
  display: inline-block;
  background: #111;
  color: #fff;
  text-decoration: none;
  padding: 12px 18px;
  font-size: 11px;
  letter-spacing: 2px;
  text-transform: uppercase;
}
.mobileStackVideo{
  width: 100%;
  height: auto;     /* keeps proportions like image */
  display: block;   /* removes gaps */
}
/*move 3rd card to right */
.heroBanner:nth-of-type(4) .heroOverlay{
  left: auto;
  right: -145px;
  text-align: center;
}
/* =========================
   Overlay Content (Haphazard + Discover + Location)
   Button starts from the "H" of Haphazard (left aligned)
========================= */
.banner-content{
    position: absolute;
    right: 2%;
    top: 70%;
    transform: translateY(-50%);
    z-index: 5;
    max-width: 420px;
    color: #fff;

    /* ✅ KEY: button aligns with Haphazard start */
    text-align: left;
}

.banner-location{
    font-size: 14px;
    letter-spacing: 2px;
    text-transform: uppercase;
    opacity: 0.85;
    margin-bottom: 21px;
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        text-align: center;
            margin-top: -13px;



}

.banner-title{
    font-family: 'Diplomacy', sans-serif;
    font-size: 60px;
    font-weight: 400;
    letter-spacing: 1.5px;
    margin: 0 0 0px 0;
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);

}
/* =========================
   MAIN BANNERS
========================= */
.custom-banner,
.custom-banner-below{
    width: 100%;
    margin: 0;
    padding: 0;
    position: relative;
}

.custom-banner-video,
.custom-banner-below-img{
    width: 100%;
    height: auto;
    display: block;
}

/* =========================
   MOBILE VIDEO
========================= */
.mobileStackHero{
    width: 100%;
    background: #fff;
}

.mobileStackImgWrap{
    width: 100%;
    overflow: hidden;
    background: #000;
}

.mobileStackVideo{
    width: 100%;
    height: auto;
    display: block;
}

</style>
<section class="custom-banner d-none d-md-block">
    <video class="custom-banner-video" autoplay muted loop playsinline>
        <source src="{{ asset('assets/f_assets/image/tawoos/tawoos.mp4') }}" type="video/mp4">
        Your browser does not support the video tag.
    </video>
     <div class="banner-content">
        <div class="banner-title">Tawoos</div>
        <div class="banner-location">
          Grace of Peacock
        </div>
        <!-- <a href="{{ url('collections/haphazard') }}" class="banner-btn">Discover</a> -->
    </div>
</section>

<section class="d-block d-md-none">
    <div class="mobileStackImgWrap">
        <video class="mobileStackVideo" autoplay muted loop playsinline preload="metadata">
            <source src="{{ asset('assets/f_assets/image/tawoos/tawoos_mobile.mp4') }}" type="video/mp4">
        </video>
    </div>
</section>
<section class="d-none d-lg-block">
<div class="heroTextWrap">
  <div class="triangleText">
    <span>An inspiration by the Peacock’s magnificent beauty and majestic presence,where every hue and feather narrates a tale of elegance.</span>
       <span>Each piece reflects the rhythm of wings, 
       the grace of motion, and the charm of nature,</span> 
       <span>transforming elegance into refined Jewellery art.</span>
  </div>
</div>
</section>
{{-- =======================
   DESKTOP HERO 1
   ======================= --}}
<section class="heroBanner d-none d-lg-block"style="margin:-15px;">
  <img
    src="{{ asset('assets/f_assets/image/tawoos/1.jpeg') }}"
    alt="Hanif Banner"
    class="heroImg"
    loading="eager"
  >

  <div class="heroOverlay">
    <h2 class="heroTitle">Tawoos</h2>
    <p class="heroText">
          Grace of Peacock
    </p>
@if(isset($products[0]))
<a href="{{ route('product.details', $products[0]->slug) }}" class="heroBtn">
  DISCOVER
</a>
@endif
  </div>
</section>

{{-- =======================
   DESKTOP HERO 2
   ======================= --}}
<section class="heroBanner d-none d-lg-block" style="margin:-15px;">
  <img
    src="{{ asset('assets/f_assets/image/tawoos/2.jpeg') }}"
    alt="Hanif Banner"
    class="heroImg"
    loading="eager"
  >

   <div class="heroOverlay-left">
    <h2 class="heroTitle">Tawoos</h2>
    <p class="heroText">
          Grace of Peacock
    </p>
    @if(isset($products[0]))
<a href="{{ route('product.details', $products[0]->slug) }}" class="heroBtn">
  DISCOVER 
</a>
@endif
  </div>
</section>
<section class="heroBanner d-none d-lg-block" style="margin:-15px;">
  <img
    src="{{ asset('assets/f_assets/image/tawoos/3.jpeg') }}"
    alt="Hanif Banner"
    class="heroImg"
    loading="eager"
  >
   <div class="heroOverlay">
    <h2 class="heroTitle-last">Tawoos</h2>
    <p class="heroText-last">
          Grace of Peacock
    </p>
    @if(isset($products[0]))
<a href="{{ route('product.details', $products[0]->slug) }}" class="heroBtn">
  DISCOVER
</a>
@endif
  </div>

</section>
<section class="d-lg-none mobileStackHero">
<div class="heroTextWrap">
  <div class="triangleText">
    <span>An inspiration by the Peacock’s magnificent beauty and majestic presence,where every hue and feather narrates a tale of elegance.</span>
       Each piece reflects the rhythm of wings, 
       the grace of motion, and the charm of nature,
       transforming elegance into refined Jewellery art.</span>
  </div>
</div>
</section>
<section class="d-lg-none mobileStackHero">
  <div class="mobileStackImgWrap">
    <img
      src="{{ asset('assets/f_assets/image/tawoos/1_mobile.jpeg') }}"
      alt="Hanif Banner"
      class="mobileStackImg"
      loading="eager"
    >
  </div>

  <div class="mobileStackContent">
    <h2 class="mobileTitle">TAWOOS</h2>
    <!-- <p class="mobileSub">Magnetic, ever-evolving, eternal.</p> -->
    <p class="mobileText">
                Grace of Peacock
    </p>
    @if(isset($products[0]))
<a href="{{ route('product.details', $products[0]->slug) }}" class="mobileBtn">
  DISCOVER
</a>
@endif
  </div>
</section>
<section class="d-lg-none mobileStackHero">
  <div class="mobileStackImgWrap">
    <img
      src="{{ asset('assets/f_assets/image/tawoos/2_mobile.jpeg') }}"
      alt="Hanif Banner"
      class="mobileStackImg"
      loading="eager"
    >
  </div>

  <div class="mobileStackContent">
    <h2 class="mobileTitle">TAWOOS</h2>
    <!-- <p class="mobileSub">Magnetic, ever-evolving, eternal.</p> -->
    <p class="mobileText">
          Grace of Peacock
  </p>
     @if(isset($products[0]))
<a href="{{ route('product.details', $products[0]->slug) }}" class="mobileBtn">
  DISCOVER
</a>
@endif
  </div>
</section>
<section class="d-lg-none mobileStackHero">
  <div class="mobileStackImgWrap">
    <img
      src="{{ asset('assets/f_assets/image/tawoos/3_mobile.jpeg') }}"
      alt="Hanif Banner"
      class="mobileStackImg"
      loading="eager"
    >
  </div>

  <div class="mobileStackContent">
    <h2 class="mobileTitle">TAWOOS</h2>
    <!-- <p class="mobileSub">Magnetic, ever-evolving, eternal.</p> -->
    <p class="mobileText">
          Grace of Peacock
    </p>
     @if(isset($products[0]))
<a href="{{ route('product.details', $products[0]->slug) }}" class="mobileBtn">
  DISCOVER
</a>
@endif
  </div>
</section>
<!-- <section class="d-lg-none mobileStackHero">
<div class="heroTextWrap">
  <div class="triangleText">
    <span>Nagar draws inspiration from the harmony of light and stone, 
    showcasing handpicked gemstones of rare beauty
    and exceptional craftsmanship.</span>
  </div>
</div>
</section> -->


<style>
/* FIX: you missed the dot before .onlineStore */
.onlineStore{
    position: relative;
    overflow: visible !important;
}

.productSwiper{
    position: relative;
    padding: 40px 0 40px;
    overflow: visible !important;
}

.productSwiper .swiper-slide{
    height: auto;
}

/* =========================
   NAVIGATION ARROWS
========================= */
.productSwiper .swiper-button-next,
.productSwiper .swiper-button-prev{
    width: 44px;
    height: 44px;
    background: #fff;
    border-radius: 50%;
    box-shadow: 0 6px 18px rgba(0,0,0,0.12);
    display: flex;
    align-items: center;
    justify-content: center;
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    z-index: 9999;
    pointer-events: auto;
}

/* Arrow icons */
.productSwiper .swiper-button-next::after,
.productSwiper .swiper-button-prev::after{
    font-size: 16px;
    font-weight: 700;
    color: #000;
}

/* Positions */
.productSwiper .swiper-button-prev{ left: 10px; }
.productSwiper .swiper-button-next{ right: 10px; }

/* Hover */
.productSwiper .swiper-button-next:hover,
.productSwiper .swiper-button-prev:hover{
    background: #f8f8f8;
}

/* =========================
   DISABLED STATE
========================= */
.productSwiper .swiper-button-next.swiper-button-disabled,
.productSwiper .swiper-button-prev.swiper-button-disabled{
    opacity: 0.35;
    cursor: not-allowed;
    pointer-events: none !important;
}

/* CLICK SHIELD */
.productSwiper .swiper-button-next::before,
.productSwiper .swiper-button-prev::before{
    content: "";
    position: absolute;
    inset: -12px;
}

/* PRODUCT CARD SAFETY */
.productSwiper .swiper-slide a{
    position: relative;
    z-index: 1;
}

/* =========================
   MOBILE: OPTIONAL (keep or remove)
   If you want arrows on tablet but not mobile
========================= */
@media (max-width: 575px){
    .productSwiper .swiper-button-next,
    .productSwiper .swiper-button-prev{
        display: none;
    }

    /* Optional: a little side padding so 1 slide looks nice */
    .productSwiper{
        padding-left: 8px;
        padding-right: 8px;
    }
}
</style>

<script>
document.querySelectorAll(".productSwiper").forEach((swiperEl) => {
    new Swiper(swiperEl, {
        loop: false,
        grabCursor: true,
        watchOverflow: true,

        // ✅ IMPORTANT: use breakpoints (your code was missing "breakpoints:")
        breakpoints: {
            // Mobile: 1 full image
            0: {
                slidesPerView: 1,
                spaceBetween: 8,
            },

            // Tablet: 2 images visible
            576: {
                slidesPerView: 2,
                spaceBetween: 10,
            },

            // Small desktop: 3 images (optional)
            768: {
                slidesPerView: 3,
                spaceBetween: 12,
            },

            // Desktop: 4 images
            1200: {
                slidesPerView: 4,
                spaceBetween: 12,
            },
        },

        // navigation scoped to this swiper
        navigation: {
            nextEl: swiperEl.querySelector(".swiper-button-next"),
            prevEl: swiperEl.querySelector(".swiper-button-prev"),
        },
    });
});
</script>


@endsection