@extends('public.layouts.header_latest')

<style>
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
    font-family: 'cinzel';
    font-size: 48px;
    font-weight: 400;
    letter-spacing: 4px;
    margin: 0 0 0px 0;
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);

}
/* ================= SPLIT LAYOUT ================= */
.hj-split-row{
    align-items: stretch; /* both columns same height */
}

/* ================= LEFT HERO ================= */
.hj-hero{
    position: relative;
    width: 100%;
    height: 100%;
    display: block;
    overflow: hidden;
}

.hj-hero__img{
    width: 100%;
    height: 100%;
    min-height: 560px;     /* MASTER HEIGHT */
    object-fit: cover;
    display: block;
}

/* ================= RIGHT COLUMN (CENTERED) ================= */
.hj-right-col{
    display: flex;
    align-items: center;      /* vertical center */
    justify-content: center;  /* horizontal center */
    min-height: 560px;        /* MUST match hero height */
}

/* ================= IMAGE-ONLY CARD ================= */
.hj-card{
    position: relative;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    background: transparent;
    text-decoration: none;
}

/* IMAGE */
.hj-card__media{
    position: relative;
    display: flex;
    align-items: center;
    justify-content: center;
}

.hj-card__media img{
    max-width: 100%;
    height: auto;
    display: block;
}

/* WISHLIST */
.hj-wish{
    position: absolute;
    top: 10px;
    left: 10px;
    width: 34px;
    height: 34px;
    border-radius: 50%;
    border: none;
    background: rgba(255,255,255,0.9);
    font-size: 20px;
    cursor: pointer;
    z-index: 5;
}

/* NEW TAG */
.hj-card__tag{
    position: absolute;
    bottom: 10px;
    left: 50%;
    transform: translateX(-50%);
    font-size: 12px;
    padding: 4px 10px;
    background: rgba(255,255,255,0.75);
    border-radius: 999px;
    color: #777;
    z-index: 5;
}

/* ================= MOBILE ================= */
@media (max-width: 991px){
    .hj-split-row{
        flex-direction: column;
    }

    .hj-hero__img{
        min-height: 360px;
        height: auto;
    }

    .hj-right-col{
        min-height: auto;
        padding: 24px 12px;
    }
}
/* ================= TEXT BELOW CARD ================= */
.hj-card{
    flex-direction: column;   /* stack image + text */
    align-items: center;
}

.hj-card__media{
    width: 100%;
    position: relative;
}

/* text container */
.hj-card__content{
    text-align: center;
    margin-top: 12px;
}

/* paragraph below image */
.hj-card__text{
    margin-top: 12px;
    text-align: center;
    font-size: 25px;
    color: #111;
    letter-spacing: 0.4px;
    line-height: 1.5;
}

/* subtle secondary text */
.hj-card__text span{
    display: block;
    font-size: 13px;
    color: #777;
    margin-top: 2px;
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
/* ------------- CONTENT SECTION ----------- */
.content-section{
    padding: clamp(40px, 6vw, 80px) 0;
    text-align: center;
}

/* SIDE BY SIDE GRID */
.media-grid{
    display: flex;
    justify-content: center;
    align-items: center;
    gap: clamp(20px, 4vw, 50px);
    margin-bottom: 40px;
}

/* COMMON MEDIA BOX */
.media-box{
    position: relative; /* ✅ REQUIRED for overlay button */
    background: #000;
    overflow: hidden;
    border-radius: 6px;
}

/* STORYLINE REEL (VERTICAL) */
.media-box.storyline{
    width: clamp(300px, 26vw, 440px);
    aspect-ratio: 9 / 16;
    background-color: #5b3a3a;
}

/* PENDANT VIDEO (SQUARE) */
.media-box.square{
    width: clamp(380px, 34vw, 620px);
    aspect-ratio: 1 / 1;
    background-color: #6a4e2e;
}

/* VIDEO FIT */
.media-box video{
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
}

/* OVERLAY BUTTON INSIDE VIDEO */
.custom-banner-btn{
    position: absolute;
    bottom: 30px;
    left: 50%;
    transform: translateX(-50%);

    padding: 15px 10px;
    font-size: 0.8rem;
    font-weight: 500;

    background: rgba(0,0,0,0.65); /* premium overlay */
    color: #fff;

    border: 1px solid rgba(255,255,255,0.8);
    border-radius: 0;

    text-transform: uppercase;
    letter-spacing: 2px;

    display: inline-block;
    z-index: 10;
    text-decoration: none;
    white-space: nowrap;
}

/* Optional hover */
/* .custom-banner-btn:hover{
    background: rgba(255,255,255,0.12);
    border-color: #fff;
    color: #fff;
} */

/* WRITEUP */
.writeup{
    font-family: serif;
    font-style: italic;
    font-size: clamp(16px, 1.2vw, 18px);
}

/* ------------- MOBILE ------------- */
@media (max-width: 768px){
    .media-grid{
        flex-direction: column;
    }

    .media-box.storyline,
    .media-box.square{
        width: 90%;
        max-width: 420px;
    }

    .custom-banner-btn{
        bottom: 20px;
        padding: 12px 10px;
        font-size: 0.75rem;
    }
}


</style>

@section('content')
<section class="heroBanner d-none d-lg-block">

  <video
    class="heroVideo"
    autoplay
    muted
    loop
    playsinline
    preload="metadata"
  >
    <source src="{{ asset('assets/f_assets/image/valentine/desktop.mp4') }}" type="video/mp4">
    Your browser does not support the video tag.
  </video>
  
    {{-- Overlay Content --}}
    <div class="banner-content">
        <!-- <div class="banner-title">HANIF HEARTS</div> -->
        <!-- <div class="banner-location">Crafted in the heart of the world’s
towering peaks</div> -->
        <!-- <a href="{{ url('collections/haphazard') }}" class="banner-btn">Discover</a> -->
    </div>
</section>
<section class="d-block d-md-none position-relative">
  <div class="mobileStackImgWrap">
    <video
      class="mobileStackVideo"
      autoplay
      muted
      loop
      playsinline
      preload="metadata"
      poster="{{ asset('assets/f_assets/image/valentine/mobile.mp4') }}"
    >
      <source src="{{ asset('assets/f_assets/image/valentine/mobile.mp4') }}" type="video/mp4">
    </video>
  </div>
</section>
<section class="content-section">
    <div class="media-grid">

        <!-- STORYLINE REEL (VERTICAL) -->
        <div class="media-box storyline">
            <video autoplay muted loop playsinline>
                <source src="{{ asset('assets/f_assets/image/valentine/hanif.webm') }}" type="video/mp4">
                Your browser does not support the video tag.
            </video>
         @if(isset($products[0]))
            <!-- Button INSIDE video -->
            <a href="{{ route('product.details', $products[0]->slug) }}" class="custom-banner-btn">
                DISCOVER MORE
            </a>
        @endif
        </div>

        <!-- PENDANT VIDEO (SQUARE) -->
        <div class="media-box square">
            <video autoplay muted loop playsinline>
                <source src="{{ asset('assets/f_assets/image/valentine/Hanif Heart.mp4') }}" type="video/mp4">
                Your browser does not support the video tag.
            </video>
         @if(isset($products[0]))
            <!-- Button INSIDE video -->
            <a href="{{ route('product.details', $products[0]->slug) }}" class="custom-banner-btn">
                DISCOVER MORE
            </a>
        @endif
        </div>

    </div>
    <!-- WRITE-UP + CTA -->
    <div class="writeup text-center">
        <p class="hj-card__text">
            HANIF hearts, Together We are One..<br>
            <span>One design. One meaning. One love.</span>
        </p>
    </div>
</section>




<!-- <section class="container-fluid px-0">
    <div class="row g-0 hj-split-row m-0">

        {{-- LEFT FULL-BLEED HERO --}}
        <div class="col-lg-6 px-0">
            <a href="{{ route('subcategory', ['subcategory' => 'gohar']) }}" class="hj-hero">
                <video class="hj-hero__img" autoplay muted loop playsinline preload="metadata">
                    <source src="{{ asset('assets/f_assets/image/valentine/hanif.mp4') }}" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
            </a>
        </div>

        {{-- RIGHT CENTERED CARDS --}}
        <div class="col-lg-6 hj-right-col px-lg-4 px-3">
            <div class="row g-4 justify-content-center align-items-center">

                @if(isset($products[149]))
                <div class="col-6 d-flex justify-content-center">
                    <a href="{{ route('product.details', $products[149]->slug) }}" class="hj-card">
                        <button class="hj-wish" data-wish-key="149-angle-1" aria-label="Wishlist">♡</button>
                        <div class="hj-card__media">
                            <img src="{{ asset('assets/f_assets/image/valentine/1.png') }}" alt="">
                        </div>
                        <div class="hj-card__tag">New</div>
                    </a>
                </div>
                @endif

                @if(isset($products[149]))
                <div class="col-6 d-flex justify-content-center">
                    <a href="{{ route('product.details', $products[149]->slug) }}" class="hj-card">
                        <button class="hj-wish" data-wish-key="149-angle-2" aria-label="Wishlist">♡</button>
                        <div class="hj-card__media">
                            <img src="{{ asset('assets/f_assets/image/valentine/2.png') }}" alt="">
                        </div>
                        <div class="hj-card__tag">New</div>
                    </a>
                </div>
                @endif
                 {{-- TEXT BELOW IMAGE --}}
        <div class="hj-card__content">
            <p class="hj-card__text">
     HANIF hearts, Together as One..
<span>One design. One meaning. One love.</span>
</p>
        </div>

            </div>
        </div>

    </div>
</section> -->

<script>
document.addEventListener('DOMContentLoaded', function () {
    const STORAGE_KEY = 'hj_wishlist_tiles';
    let wishlist = JSON.parse(localStorage.getItem(STORAGE_KEY)) || [];

    document.querySelectorAll('.hj-wish').forEach(btn => {
        const key = btn.dataset.wishKey;

        if (wishlist.includes(key)) {
            btn.textContent = '♥';
        }

        btn.addEventListener('click', function (e) {
            e.preventDefault();
            e.stopPropagation();

            if (wishlist.includes(key)) {
                wishlist = wishlist.filter(k => k !== key);
                btn.textContent = '♡';
            } else {
                wishlist.push(key);
                btn.textContent = '♥';
            }

            localStorage.setItem(STORAGE_KEY, JSON.stringify(wishlist));
        });
    });
});
</script>
@endsection
