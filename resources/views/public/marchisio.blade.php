@extends('public.layouts.header_new')

@section('content')
<style>
html, body{
    margin: 0;
    padding: 0;
    overflow-x: clip;
}

/* =========================
   HERO BANNERS
========================= */
.heroFullWidth{
    width: 100vw;
    margin-left: calc(50% - 50vw);
    margin-right: calc(50% - 50vw);
    line-height: 0;
    overflow: hidden;
}

.heroMedia{
    width: 100%;
    height: auto;
    display: block;
    object-fit: contain;
}

/* =========================
   MID FULL-WIDTH BANNERS
========================= */
.bannerFullWidth{
    width: 100vw;
    margin-left: calc(50% - 50vw);
    margin-right: calc(50% - 50vw);
    line-height: 0;
    overflow: hidden;
}

.midBannerMedia{
    width: 100%;
    height: auto;
    display: block;
    object-fit: contain;
}

.midBannerMobile{
    width: 100vw;
    margin-left: calc(50% - 50vw);
    margin-right: calc(50% - 50vw);
    line-height: 0;
    overflow: hidden;
}

.midBannerMobile video{
    width: 100%;
    height: auto;
    display: block;
    object-fit: contain;
}

/* =========================
   CONTENT
========================= */
.collection-text p{
    width: min(100%, 67ch);
    padding: 40px;
    margin: 0 auto;
    box-sizing: border-box;
    font-size: 13px;
    line-height: 1.6;
    color: #222;
    text-align: justify;
    text-align-last: center;
    text-justify: inter-word;
}

.app-btn{
    padding: 8px 18px !important;
    min-height: 44px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    text-align: center;
    letter-spacing: 0.06em;
    white-space: normal;
    line-height: 1.35;
}

#ehadImageSliderDesktop,
#ehadImageSliderMobileTop,
#ehadBottomSliderDesktop,
#ehadBottomSliderMobile{
    overflow: hidden;
}

#ehadImageSliderDesktop img,
#ehadImageSliderMobileTop img,
#ehadBottomSliderDesktop img,
#ehadBottomSliderMobile img{
    display: block;
}

#ehadImageSliderDesktop .carousel-control-prev,
#ehadImageSliderDesktop .carousel-control-next,
#ehadImageSliderMobileTop .carousel-control-prev,
#ehadImageSliderMobileTop .carousel-control-next,
#ehadBottomSliderDesktop .carousel-control-prev,
#ehadBottomSliderDesktop .carousel-control-next,
#ehadBottomSliderMobile .carousel-control-prev,
#ehadBottomSliderMobile .carousel-control-next{
    width: 12%;
    opacity: 1;
}

#ehadImageSliderDesktop .carousel-control-prev-icon,
#ehadImageSliderDesktop .carousel-control-next-icon,
#ehadImageSliderMobileTop .carousel-control-prev-icon,
#ehadImageSliderMobileTop .carousel-control-next-icon,
#ehadBottomSliderDesktop .carousel-control-prev-icon,
#ehadBottomSliderDesktop .carousel-control-next-icon,
#ehadBottomSliderMobile .carousel-control-prev-icon,
#ehadBottomSliderMobile .carousel-control-next-icon{
    width: 42px;
    height: 42px;
    border-radius: 50%;
    background-color: rgba(0, 0, 0, 0.38);
    background-size: 42% 42%;
}

@media (max-width: 767.98px){
    .heroMedia{
        min-height: 220px;
        object-fit: cover;
        object-position: center;
    }

    .midBannerMobile{
        width: calc(100% + 24px);
        margin-left: -12px;
        margin-right: -12px;
    }

    .collection-text p{
        padding: 18px 8px 10px;
        font-size: 13px;
        line-height: 1.6;
    }

    .mobile-space{
        margin-top: 18px;
    }

    .mobile-btn-wrap{
        text-align: center;
        margin-top: 20px;
        margin-bottom: 10px;
    }

    .app-btn{
        width: min(100%, 280px);
        padding: 10px 18px !important;
        font-size: 13px;
    }

    #ehadImageSliderMobileTop,
    #ehadBottomSliderMobile{
        border-radius: 14px;
    }

    #ehadImageSliderMobileTop .carousel-control-prev,
    #ehadImageSliderMobileTop .carousel-control-next,
    #ehadBottomSliderMobile .carousel-control-prev,
    #ehadBottomSliderMobile .carousel-control-next{
        width: 18%;
    }

    #ehadImageSliderMobileTop .carousel-control-prev-icon,
    #ehadImageSliderMobileTop .carousel-control-next-icon,
    #ehadBottomSliderMobile .carousel-control-prev-icon,
    #ehadBottomSliderMobile .carousel-control-next-icon{
        width: 34px;
        height: 34px;
        background-color: rgba(0, 0, 0, 0.46);
    }

    .productSwiper{
        padding-top: 28px;
        padding-bottom: 28px;
    }
}
</style>

<!-- DESKTOP HERO -->
<section class="heroFullWidth d-none d-md-block">
    <video autoplay loop muted playsinline class="heroMedia">
        <source src="{{ asset('assets/f_assets/image/Marchisio Updated Website Data/marchisio.mp4') }}" type="video/mp4">
        Your browser does not support the video tag.
    </video>
</section>

<!-- MOBILE HERO -->
<section class="heroFullWidth d-md-none">
    <video autoplay loop muted playsinline class="heroMedia">
        <source src="{{ asset('assets/f_assets/image/Marchisio Updated Website Data/mobile_view.mp4') }}" type="video/mp4">
        Your browser does not support the video tag.
    </video>
</section>

<section class="container pt-4 pt-md-5">
    <!-- =========================
         DESKTOP FIRST SECTION
    ========================= -->
    <div class="row g-3 mb-3 mb-md-5 d-none d-md-flex">
        <div class="col-md-6 justify-content-center d-flex align-items-center">
            <div class="text-center my-5 collection-text">
                <p>
                    For The Modern Urban Man
                    Since 1859 Marchisio has been creating
                    trend setting, fabulously designed and hand-crafted, breath-taking pieces of jewellery, that at a glance can be mistaken for lace, must-have contemporary pieces that have fascinated connoisseurs for ages.
                </p>
            </div>
        </div>

        <div class="col-md-6">
            <div id="ehadImageSliderDesktop" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="{{ asset('assets/f_assets/image/Marchisio Updated Website Data/MArchisio Selected Web Image/MARCHISIO_HANIF_6_1500X2100.jpg') }}" class="img-fluid w-100" alt="Marchisio Collection">
                    </div>
                    <div class="carousel-item">
                        <img src="{{ asset('assets/f_assets/image/Marchisio Updated Website Data/MArchisio Selected Web Image/MARCHISIO_HANIF_11_1500X2100.jpg') }}" class="img-fluid w-100" alt="Marchisio Collection">
                    </div>
                    <div class="carousel-item">
                        <img src="{{ asset('assets/f_assets/image/Marchisio Updated Website Data/MArchisio Selected Web Image/MARCHISIO_HANIF_14_1500X2100.jpg') }}" class="img-fluid w-100" alt="Marchisio Collection">
                    </div>
                </div>

                <button class="carousel-control-prev" type="button" data-bs-target="#ehadImageSliderDesktop" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#ehadImageSliderDesktop" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    </div>

    <!-- =========================
         MOBILE ORDER
         1) IMAGE
         2) TEXT
    ========================= -->
    <div class="d-md-none mb-4">
        <div id="ehadImageSliderMobileTop" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="{{ asset('assets/f_assets/image/Marchisio Updated Website Data/MArchisio Selected Web Image/MARCHISIO_HANIF_6_1500X2100.jpg') }}" class="img-fluid w-100" alt="Marchisio Collection">
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('assets/f_assets/image/Marchisio Updated Website Data/MArchisio Selected Web Image/MARCHISIO_HANIF_11_1500X2100.jpg') }}" class="img-fluid w-100" alt="Marchisio Collection">
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('assets/f_assets/image/Marchisio Updated Website Data/MArchisio Selected Web Image/MARCHISIO_HANIF_14_1500X2100.jpg') }}" class="img-fluid w-100" alt="Marchisio Collection">
                </div>
            </div>

            <button class="carousel-control-prev" type="button" data-bs-target="#ehadImageSliderMobileTop" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#ehadImageSliderMobileTop" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>

    <div class="d-md-none mb-4">
        <div class="text-center collection-text">
            <p>
                For The Modern Urban Man
                Since 1859 Marchisio has been creating
                trend setting, fabulously designed and hand-crafted, breath-taking pieces of jewellery, that at a glance can be mistaken for lace, must-have contemporary pieces that have fascinated connoisseurs for ages.
            </p>
        </div>
    </div>

    <!-- =========================
         DESKTOP MID BANNER
    ========================= -->
    <div class="bannerFullWidth d-none d-md-block">
        <video autoplay loop muted playsinline preload="auto" class="midBannerMedia">
            <source src="{{ asset('assets/f_assets/image/Marchisio Updated Website Data/second_banner.mp4') }}" type="video/mp4">
            Your browser does not support the video tag.
        </video>
    </div>

    <!-- =========================
         MOBILE MID BANNER
         3) BANNER
    ========================= -->
    <div class="midBannerMobile d-md-none mobile-space">
        <video autoplay loop muted playsinline preload="auto">
            <source src="{{ asset('assets/f_assets/image/Marchisio Updated Website Data/mid_banner_mobile.mp4') }}" type="video/mp4">
            Your browser does not support the video tag.
        </video>
    </div>

    <!-- =========================
         DESKTOP BOTTOM SECTION
    ========================= -->
    <div class="row g-3 mb-3 align-items-center d-none d-md-flex">
        <div class="col-md-6">
            <div id="ehadBottomSliderDesktop" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="{{ asset('assets/f_assets/image/Marchisio Updated Website Data/MArchisio Selected Web Image/MARCHISIO_HANIF_20_1500X2100.jpg') }}" class="img-fluid w-100" alt="Marchisio Collection" style="margin-top:20px;">
                    </div>
                    <div class="carousel-item">
                        <img src="{{ asset('assets/f_assets/image/Marchisio Updated Website Data/MArchisio Selected Web Image/MARCHISIO_HANIF_21_1500X2100.jpg') }}" class="img-fluid w-100" alt="Marchisio Collection" style="margin-top:20px;">
                    </div>
                    <div class="carousel-item">
                        <img src="{{ asset('assets/f_assets/image/Marchisio Updated Website Data/MArchisio Selected Web Image/MARCHISIO_HANIF_25_1500X2100.jpg') }}" class="img-fluid w-100" alt="Marchisio Collection" style="margin-top:20px;">
                    </div>
                    <div class="carousel-item">
                        <img src="{{ asset('assets/f_assets/image/Marchisio Updated Website Data/MArchisio Selected Web Image/MARCHISIO_HANIF_35_1500X2100.jpg') }}" class="img-fluid w-100" alt="Marchisio Collection" style="margin-top:20px;">
                    </div>
                </div>

                <button class="carousel-control-prev" type="button" data-bs-target="#ehadBottomSliderDesktop" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#ehadBottomSliderDesktop" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>

        <div class="col-md-6 d-flex justify-content-center">
            <x-book-appointment class="m-1" />
        </div>
    </div>

    <!-- =========================
         MOBILE BOTTOM IMAGE
         4) IMAGE
    ========================= -->
    <div class="d-md-none mt-4">
        <div id="ehadBottomSliderMobile" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="{{ asset('assets/f_assets/image/Marchisio Updated Website Data/MArchisio Selected Web Image/MARCHISIO_HANIF_20_1500X2100.jpg') }}" class="img-fluid w-100" alt="Marchisio Collection">
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('assets/f_assets/image/Marchisio Updated Website Data/MArchisio Selected Web Image/MARCHISIO_HANIF_21_1500X2100.jpg') }}" class="img-fluid w-100" alt="Marchisio Collection">
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('assets/f_assets/image/Marchisio Updated Website Data/MArchisio Selected Web Image/MARCHISIO_HANIF_25_1500X2100.jpg') }}" class="img-fluid w-100" alt="Marchisio Collection">
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('assets/f_assets/image/Marchisio Updated Website Data/MArchisio Selected Web Image/MARCHISIO_HANIF_35_1500X2100.jpg') }}" class="img-fluid w-100" alt="Marchisio Collection">
                </div>
            </div>

            <button class="carousel-control-prev" type="button" data-bs-target="#ehadBottomSliderMobile" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#ehadBottomSliderMobile" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>

        <div class="mobile-btn-wrap">
            <x-book-appointment class="m-1" />
        </div>
    </div>
</section>
{{-- ✅ SWIPER PRODUCT SLIDER (Desktop + Mobile) --}}
<section class="onlineStore">
    <div class="swiper productSwiper">
        <div class="swiper-wrapper">
            @foreach ($products->take(max(0, $products->count())) as $product)
                <div class="swiper-slide">
                    @include('public.partials.simple-card', [
                        'product' => $product,
                        'hideDetails' => true,
                    ])
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
