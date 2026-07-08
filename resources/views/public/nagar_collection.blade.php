@extends('public.layouts.header_new')

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
  left: 70px;
  bottom: 120px;
  width: min(530px, 70%);
  padding: 38px 6px;
  background: rgba(245, 232, 210, 0.78);
  backdrop-filter: blur(2px);
  text-align: center;
  z-index: 2;                      /* ✅ stay above image */
}

/* Typography */
.heroTitle{
  margin: 0 0 10px;
  letter-spacing: 6px;
  font-size: 44px;
  line-height: 1.05;
  color: #111;
  font-weight: 500;
  font-family:'Atelier';
}

.heroText{
  margin: 0 auto 22px;
  font-size: 14px;
  color: #111;
  max-width: 540px;
}

/* Button */
.heroBtn{
  display: inline-block;
  background: #111;
  color: #fff;
  text-decoration: none;
  padding: 14px 26px;
  letter-spacing: 2px;
  font-size: 12px;
  text-align: center;
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
}

.triangleText span{
  display: block;
  margin: 0 auto;
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
  right: 70px;
  text-align: center;
}
/* =========================
   Overlay Content (Haphazard + Discover + Location)
   Button starts from the "H" of Haphazard (left aligned)
========================= */
.banner-content{
    position: absolute;
    right: 0%;
    top: 70%;
    transform: translateY(-50%);
    z-index: 5;
    max-width: 420px;
    color: #fff;

    /* ✅ KEY: button aligns with Haphazard start */
    text-align: left;
}

.banner-location{
    font-size: 12px;
    letter-spacing: 2px;
    text-transform: uppercase;
    opacity: 0.85;
    margin-bottom: 21px;
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);

}

.banner-title{
    font-family: 'Atelier';
    font-size: 48px;
    font-weight: 400;
    letter-spacing: 15px;
    margin: 0 0 0px 0;
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);

}

</style>
<section class="heroBanner d-none d-lg-block">

  <video
    class="heroVideo"
    autoplay
    muted
    loop
    playsinline
    preload="metadata"
  >
    <source src="{{ asset('assets/f_assets/image/ayeza/ayeza_all.mp4') }}" type="video/mp4">
    Your browser does not support the video tag.
  </video>
  
    {{-- Overlay Content --}}
    <div class="banner-content">
        <div class="banner-title">NAGAR</div>
        <div class="banner-location">Crafted in the heart of the world’s
towering peaks</div>
        <!-- <a href="{{ url('collections/haphazard') }}" class="banner-btn">Discover</a> -->
    </div>
<!-- 
  <div class="heroOverlay">
    <h2 class="heroTitle">NAGAR</h2>
    <p class="heroText">
      A legacy carved from stone and peak; these rubies carry the deep, royal weight of the mountains in a design that breathes with life and power.
    </p>
    <a href="#" class="heroBtn">
      DISCOVER NAGAR<br>CREATIONS
    </a>
  </div> -->

</section>

{{-- =======================
   DESKTOP HERO 1
   ======================= --}}
<section class="heroBanner d-none d-lg-block"style="margin:-15px;">
  <img
    src="{{ asset('assets/f_assets/image/ayeza/1.jpg') }}"
    alt="Hanif Banner"
    class="heroImg"
    loading="eager"
  >

  <div class="heroOverlay">
    <h2 class="heroTitle">NAGAR</h2>
    <p class="heroText">
      A legacy carved from stone and peak; these rubies carry the deep royal weight of the mountains in a design that breathes with life and power.
    </p>
    @if(isset($products[7]))
<a href="{{ route('product.details', $products[7]->slug) }}" class="heroBtn">
  DISCOVER NAGAR<br>CREATIONS
</a>
@endif
  </div>
</section>

{{-- =======================
   DESKTOP HERO 2
   ======================= --}}
<section class="heroBanner d-none d-lg-block" style="margin:-15px;">
  <img
    src="{{ asset('assets/f_assets/image/ayeza/ayeza2.jpg') }}"
    alt="Hanif Banner"
    class="heroImg"
    loading="eager"
  >

  <div class="heroOverlay">
    <h2 class="heroTitle">NAGAR</h2>
    <p class="heroText">
      Inspired by royal regalia, this necklace unites precision set diamonds and vivid colour into a commanding modern statement.
    </p>
    @if(isset($products[8]))
<a href="{{ route('product.details', $products[8]->slug) }}" class="heroBtn">
  DISCOVER NAGAR<br>CREATIONS
</a>
@endif
  </div>
</section>
<section class="heroBanner d-none d-lg-block" style="margin:-15px;">
  <img
    src="{{ asset('assets/f_assets/image/ayeza/3.jpg') }}"
    alt="Hanif Banner"
    class="heroImg"
    loading="eager"
  >

  <div class="heroOverlay">
    <h2 class="heroTitle">NAGAR</h2>
    <p class="heroText">
        The way the green is "cradled" by gold and diamonds, mirrors the way valuable life is protected by the rugged mountain terrain.   
    </p>
    @if(isset($products[9]))
<a href="{{ route('product.details', $products[9]->slug) }}" class="heroBtn">
  DISCOVER NAGAR<br>CREATIONS
</a>
@endif
  </div>
</section>
<section class="heroBanner d-none d-lg-block" style="margin:-10px;">
  <img
    src="{{ asset('assets/f_assets/image/ayeza/4.jpg') }}"
    alt="Hanif Banner"
    class="heroImg"
    loading="eager"
  >

  <div class="heroOverlay">
    <h2 class="heroTitle">NAGAR</h2>
    <p class="heroText">
     Emeralds once reserved for royal courts, drawn from Pakistan’s Nagar valleys, admired for their colour and character, 
     are shaped into jewellery that carries history with quiet confidence.  
      </p>
    @if(isset($products[10]))
<a href="{{ route('product.details', $products[10]->slug) }}" class="heroBtn">
  DISCOVER NAGAR<br>CREATIONS
</a>
@endif
  </div>
</section>

<section class="d-none d-lg-block">
<div class="heroTextWrap">
  <div class="triangleText">
    <span>Nagar draws inspiration from the harmony of light and stone,</span>
    <span>showcasing handpicked gemstones of rare beauty</span>
    <span>and exceptional craftsmanship.</span>
  </div>
</div>
</section>

{{-- =======================
   MOBILE / TABLET HERO
   ======================= --}}
<section class="d-lg-none mobileStackHero">
  <div class="mobileStackImgWrap">
    <video
      class="mobileStackVideo"
      autoplay
      muted
      loop
      playsinline
      preload="metadata"
      poster="{{ asset('assets/f_assets/image/ayeza/ayeza_mobile.mp4') }}"
    >
      <source src="{{ asset('assets/f_assets/image/ayeza/ayeza_mobile.mp4') }}" type="video/mp4">
    </video>
  </div>
<!-- <div class="mobileStackContent">
    <h2 class="mobileTitle">NAGAR</h2>
     <p class="mobileSub">Magnetic, ever-evolving, eternal.</p> 
    <p class="mobileText">
       Crafted in the heart of the world’s
towering peaks.
    </p>
    <a href="#" class="mobileBtn">DISCOVER NAGAR CREATIONS</a> 
  </div> -->
  
</section>

<section class="d-lg-none mobileStackHero">
  <div class="mobileStackImgWrap">
    <img
      src="{{ asset('assets/f_assets/image/ayeza/1-mobile.jpg') }}"
      alt="Hanif Banner"
      class="mobileStackImg"
      loading="eager"
    >
  </div>

  <div class="mobileStackContent">
    <h2 class="mobileTitle">NAGAR</h2>
    <!-- <p class="mobileSub">Magnetic, ever-evolving, eternal.</p> -->
    <p class="mobileText">
       A legacy carved from stone and peak; these rubies carry the deep royal weight of the mountains in a design that breathes with life and power.
    </p>
    @if(isset($products[7]))
<a href="{{ route('product.details', $products[7]->slug) }}" class="mobileBtn">
  DISCOVER NAGAR CREATIONS
</a>
@endif
  </div>
</section>
<section class="d-lg-none mobileStackHero">
  <div class="mobileStackImgWrap">
    <img
      src="{{ asset('assets/f_assets/image/ayeza/2-mobile.jpg') }}"
      alt="Hanif Banner"
      class="mobileStackImg"
      loading="eager"
    >
  </div>

  <div class="mobileStackContent">
    <h2 class="mobileTitle">NAGAR</h2>
    <!-- <p class="mobileSub">Magnetic, ever-evolving, eternal.</p> -->
    <p class="mobileText">
        Inspired by royal regalia, this necklace unites precision set diamonds and vivid colour into a commanding modern statement.
    </p>
     @if(isset($products[8]))
<a href="{{ route('product.details', $products[8]->slug) }}" class="mobileBtn">
  DISCOVER NAGAR CREATIONS
</a>
@endif
  </div>
</section>
<section class="d-lg-none mobileStackHero">
  <div class="mobileStackImgWrap">
    <img
      src="{{ asset('assets/f_assets/image/ayeza/3-mobile.jpg') }}"
      alt="Hanif Banner"
      class="mobileStackImg"
      loading="eager"
    >
  </div>

  <div class="mobileStackContent">
    <h2 class="mobileTitle">NAGAR</h2>
    <!-- <p class="mobileSub">Magnetic, ever-evolving, eternal.</p> -->
    <p class="mobileText">
       The way the green is "cradled" by gold and diamonds, mirrors the way valuable life is protected by the rugged mountain terrain.
    </p>
     @if(isset($products[9]))
<a href="{{ route('product.details', $products[9]->slug) }}" class="mobileBtn">
  DISCOVER NAGAR CREATIONS
</a>
@endif
  </div>
</section>
<section class="d-lg-none mobileStackHero">
  <div class="mobileStackImgWrap">
    <img
      src="{{ asset('assets/f_assets/image/ayeza/4-mobile.jpg') }}"
      alt="Hanif Banner"
      class="mobileStackImg"
      loading="eager"
    >
  </div>

  <div class="mobileStackContent">
    <h2 class="mobileTitle">NAGAR</h2>
    <!-- <p class="mobileSub">Magnetic, ever-evolving, eternal.</p> -->
    <p class="mobileText">
      Emeralds once reserved for royal courts, drawn from Pakistan’s Nagar valleys, admired for their colour and character, are shaped into jewellery that carries history with quiet confidence.
     </p>
     @if(isset($products[10]))
<a href="{{ route('product.details', $products[10]->slug) }}" class="mobileBtn">
  DISCOVER NAGAR CREATIONS
</a>
@endif
  </div>
</section>
<section class="d-lg-none mobileStackHero">
<div class="heroTextWrap">
  <div class="triangleText">
    <span>Nagar draws inspiration from the harmony of light and stone, 
    showcasing handpicked gemstones of rare beauty
    and exceptional craftsmanship.</span>
  </div>
</div>
</section>
{{-- ✅ SWIPER PRODUCT SLIDER (Desktop + Mobile) --}}
<section class="onlineStore">
    <div class="swiper productSwiper">
        <div class="swiper-wrapper">
            @foreach ($products->take(max(0, $products->count() - 4)) as $product)
                <div class="swiper-slide">
                    @include('public.partials.simple-card', ['product' => $product])
                </div>
            @endforeach
        </div>

        {{-- Navigation arrows --}}
        <div class="swiper-button-prev"></div>
        <div class="swiper-button-next"></div>
    </div>
</section>

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
