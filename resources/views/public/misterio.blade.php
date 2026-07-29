@extends('public.layouts.header_new')

@section('content')
<style>
html, body{
    margin: 0;
    padding: 0;
}

/* =========================
   DESKTOP BANNER
========================= */
.sectionOne{
    width: 100%;
    height: auto; /* 👈 important */
    position: relative;
    overflow: hidden;
    margin: 0 !important;
    padding: 0 !important;
}

/* =========================
   MEDIA (VIDEO + IMAGE)
========================= */
.bannerMedia{
    width: 100%;
    height: auto;        /* 👈 shrink with screen */
    display: block;
    object-fit: contain; /* 👈 no crop */
}

/* image fallback */
.bannerBgImage{
    background-position: center center;
    background-size: contain;
    background-repeat: no-repeat;
}

/* =========================
   MOBILE BANNER
========================= */
.mobileBanner{
    width: 100vw;
    margin-left: calc(50% - 50vw);
    margin-right: calc(50% - 50vw);
    overflow: hidden;
    line-height: 0;
}

.mobileBanner video{
    width: 100%;
    height: auto;
    display: block;
    object-fit: contain;
}
</style>

    <!-- Mobile Video Banner Section -->
    <!-- <section class="d-md-none" style="position: relative; height: 110vh; overflow: hidden;">
        <video autoplay loop muted playsinline style="position: absolute; left: 0; top: 0; width: 100%; height: 100%; object-fit: cover; z-index: 0;">
            <source src="{{ asset('assets/f_assets/image/Misterio yellow Neclace Mobile view Banner.mp4') }}" type="video/mp4">
            Your browser does not support the video tag.
        </video>
    </section> -->
<!-- =========================
     DESKTOP
========================= -->
<section class="sectionOne d-md-block d-none">
    <img src="{{ asset('assets/f_assets/image/misterio_data/new3.jpeg') }}" 
         class="bannerMedia" 
         alt="Banner">
</section>

<!-- MOBILE -->
<div class="mobileBanner d-md-none">
    <img src="{{ asset('assets/f_assets/image/misterio_data/misterio_mobile.jpeg') }}" 
         class="bannerMedia" 
         alt="Mobile Banner">
</div>
    <section class="container">
         <div class="row g-3 mb-3">

            {{-- Slider for images --}}
            <div class="col-md-6">
                <div id="ehadImageSlider" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="{{ asset('assets/f_assets/image/misterio_data/Tourmaline-Look-2/01.jpg') }}" class="img-fluid" alt="misterio Collection 1" style="cursor: pointer;" onclick="openImageModal('ehadImageSlider', 0)">
                        </div>
                        <div class="carousel-item">
                            <img src="{{ asset('assets/f_assets/image/misterio_data/Tourmaline-Look-2/02.jpg') }}" class="img-fluid" alt="misterio Collection 2" style="cursor: pointer;" onclick="openImageModal('ehadImageSlider', 1)">
                        </div>
                        <div class="carousel-item">
                            <img src="{{ asset('assets/f_assets/image/misterio_data/Tourmaline-Look-2/03.jpg') }}" class="img-fluid" alt="misterio Collection 3" style="cursor: pointer;" onclick="openImageModal('ehadImageSlider', 2)">
                        </div>
                    </div>

                    {{-- Optional controls --}}
                    <button class="carousel-control-prev" type="button" data-bs-target="#ehadImageSlider" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#ehadImageSlider" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div> 
              <div class="col-md-6 justify-content-center d-flex align-items-center">
                <div class="text-center my-5">
                    <p class="p-5"> Exquisite masterpieces crafted with high-quality tourmaline, prized for its unparalleled depth and vibrant hues, paired with precious metal, expertly calibrated to radiate warmth and sophistication. Showcasing timeless artisanal craftsmanship and uniqueness, culminating in a true resemblance of experience pure art.</p>
                </div>
            </div>
        </div>
      <div class="row g-3 mb-3">
    <div class="col-md-6 d-flex align-items-center justify-content-center order-2 order-md-1">
        <div class="text-center my-5">
            <p class="p-5">
               Exquisite masterpieces crafted with high-quality diamonds of unreachable purity and depth, expertly calibrated to radiate brilliance, showcasing timeless artisanal craftsmanship and uniqueness, culminating in a true resemblance of <br>experience pure art.
            </p>
        </div>
    </div>
    {{-- Slider 1 --}}
    <div class="col-md-6 order-1 order-md-2">
        <div id="marchisioSlider1" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="{{ asset('assets/f_assets/image/misterio_data/Diamond-Look-1/Diamond_Web_1.jpg') }}" class="img-fluid" alt="misterio 1 - 1" style="cursor: pointer;" onclick="openImageModal('marchisioSlider1', 0)">
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('assets/f_assets/image/misterio_data/Diamond-Look-1/Diamond_Web_2.jpg') }}" class="img-fluid" alt="misterio 1 - 2" style="cursor: pointer;" onclick="openImageModal('marchisioSlider1', 1)">
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('assets/f_assets/image/misterio_data/Diamond-Look-1/Diamond_Web_3.jpg') }}" class="img-fluid" alt="misterio 1 - 3" style="cursor: pointer;" onclick="openImageModal('marchisioSlider1', 2)">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#marchisioSlider1" data-bs-slide="prev">
                <span class="carousel-control-prev-icon"></span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#marchisioSlider1" data-bs-slide="next">
                <span class="carousel-control-next-icon"></span>
            </button>
        </div>
    </div>
</div>

<!-- DESKTOP -->
<div class="fullBanner d-none d-md-block">
    <img src="{{ asset('assets/f_assets/image/misterio_data/mid_banner.jpg') }}" 
         class="fullBannerMedia" 
         alt="Desktop Banner">
</div>

<!-- MOBILE -->
<div class="fullBanner d-md-none">
    <img src="{{ asset('assets/f_assets/image/misterio_data/mobile_view_product.jpeg') }}" 
         class="fullBannerMedia" 
         alt="Mobile Banner">
</div>

<style>
.fullBanner{
    width:100%;
    line-height:0;
    overflow:hidden;
}

.fullBannerMedia{
    width:100%;
    height:auto;
    display:block;
    object-fit:contain;
}
</style>

<!-- DESKTOP -->
<!--<div class="fullBanner d-none d-md-block">-->
<!--    <video autoplay loop muted playsinline preload="auto" class="fullBannerMedia">-->
<!--        <source src="{{ asset('assets/f_assets/image/misterio_data/misterio_latest.mp4') }}" type="video/mp4">-->
<!--        Your browser does not support the video tag.-->
<!--    </video>-->
<!--</div>-->

<!-- MOBILE -->
<!--<div class="fullBanner d-md-none">-->
<!--    <video autoplay loop muted playsinline preload="auto" class="fullBannerMedia">-->
<!--        <source src="{{ asset('assets/f_assets/image/misterio_data/misterio mobile size second.mp4') }}" type="video/mp4">-->
<!--        Your browser does not support the video.-->
<!--    </video>-->
<!--</div>-->

<style>
html, body{
    margin: 0;
    padding: 0;
}

/* =========================
   FULL WIDTH WRAPPER
========================= */
.fullBanner{
    width: 100vw;
    margin-left: calc(50% - 50vw);
    margin-right: calc(50% - 50vw);

    overflow: hidden;
    line-height: 0;
}

/* =========================
   VIDEO (RESPONSIVE)
========================= */
.fullBannerMedia{
    width: 100%;
    height: auto;          /* 👈 SHRINKS */
    display: block;
    object-fit: contain;   /* 👈 NO CROP */
}
</style>
    <!-- ====== Carousel 2 ====== -->
<div class="row g-3 mt-3 mb-3">
     <div class="col-md-6 d-flex align-items-center justify-content-center order-2 order-md-1">
        <div class="text-center my-5">
            <p class="p-5">
               Exquisite masterpieces crafted with beautiful Sapphire and Diamonds, prized for its unparalleled depth and vibrant hues, paired with precious metal, expertly calibrated to radiate warmth and sophistication. Showcasing timeless artisanal craftsmanship and uniqueness, culminating in a true resemblance of Experience pure art.
            </p>
        </div>
    </div>
    <div class="col-md-6 order-1 order-md-2">
        <div id="marchisioSlider2" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="{{ asset('assets/f_assets/image/misterio_data/Blue-Saphire/Misterio_1.jpg') }}" class="img-fluid" alt="misterio 2 - 1" style="cursor: pointer;" onclick="openImageModal('marchisioSlider2', 0)">
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('assets/f_assets/image/misterio_data/Blue-Saphire/Misterio_2.jpg') }}" class="img-fluid" alt="misterio 2 - 2" style="cursor: pointer;" onclick="openImageModal('marchisioSlider2', 1)">
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('assets/f_assets/image/misterio_data/Blue-Saphire/Misterio_3.jpg') }}" class="img-fluid" alt="misterio 2 - 3" style="cursor: pointer;" onclick="openImageModal('marchisioSlider2', 2)">
                </div>
            </div>

            <!-- Carousel Controls -->
            <button class="carousel-control-prev" type="button" data-bs-target="#marchisioSlider2" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#marchisioSlider2" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
</div>

<!-- ====== Carousel 3 ====== -->
<div class="row g-3 mb-3">
    <div class="col-md-6">
        <div id="marchisioSlider3" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="{{ asset('assets/f_assets/image/misterio_data/Green-Chain/Green_Chain_1.jpg') }}" class="img-fluid" alt="misterio 3 - 1" style="cursor: pointer;" onclick="openImageModal('marchisioSlider3', 0)">
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('assets/f_assets/image/misterio_data/Green-Chain/Green_Chain_2.jpg') }}" class="img-fluid" alt="misterio 3 - 2" style="cursor: pointer;" onclick="openImageModal('marchisioSlider3', 1)">
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('assets/f_assets/image/misterio_data/Green-Chain/Green_Chain_3.jpg') }}" class="img-fluid" alt="misterio 3 - 3" style="cursor: pointer;" onclick="openImageModal('marchisioSlider3', 2)">
                </div>
            </div>

            <!-- Carousel Controls -->
            <button class="carousel-control-prev" type="button" data-bs-target="#marchisioSlider3" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#marchisioSlider3" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>

    <div class="col-md-6 d-flex align-items-center justify-content-center">
        <div class="text-center my-5">
            <p class="p-5">
                Long chain adorned with vibrant corals, expertly crafted with high-quality Stones and Precious metal. This exquisite piece radiates warmth, sophistication, and timeless artisanal craftsmanship.
            </p>
        </div>
    </div>
</div>
<!-- <div class="row g-3 mt-3 mb-3">
     <div class="col-md-6 d-flex align-items-center justify-content-center order-2 order-md-1">
        <div class="text-center my-5">
            <p class="p-5">
               Exquisite masterpieces crafted with beautiful Sapphire and Diamonds, prized for its unparalleled depth and vibrant hues, paired with precious metal, expertly calibrated to radiate warmth and sophistication. Showcasing timeless artisanal craftsmanship and uniqueness, culminating in a true resemblance of Experience pure art.
            </p>
        </div>
    </div>
    <div class="col-md-6 order-1 order-md-2">
        <div id="marchisioSlider4" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="{{ asset('assets/f_assets/image/misterio_data/New look/Miterio-Web-001.png') }}" class="img-fluid" alt="misterio 4 - 1" style="cursor: pointer;" onclick="openImageModal('marchisioSlider4', 0)">
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('assets/f_assets/image/misterio_data/New look/Miterio-Web-002.png') }}" class="img-fluid" alt="misterio 4 - 2" style="cursor: pointer;" onclick="openImageModal('marchisioSlider4', 1)">
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('assets/f_assets/image/misterio_data/New look/Miterio-Web-003.png') }}" class="img-fluid" alt="misterio 4 - 3" style="cursor: pointer;" onclick="openImageModal('marchisioSlider4', 2)">
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('assets/f_assets/image/misterio_data/New look/Miterio-Web-004.png') }}" class="img-fluid" alt="misterio 4 - 4" style="cursor: pointer;" onclick="openImageModal('marchisioSlider4', 3)">
                </div>

            </div>

            <button class="carousel-control-prev" type="button" data-bs-target="#marchisioSlider4" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#marchisioSlider4" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
</div> -->

<div class="row">
            <style>
                    .app-btn {
                        padding: 6px 16px !important;
                    }
            </style>
            <div class="text-center">
                <x-book-appointment class="m-1" />
            </div>
            <!-- <div class="col-md-6 text-center">
                <x-shop-now :href="route('subcategory', ['subcategory' => 'gohar'])" class="m-5 btn border btn-outline-dark px-5 py-2" style="padding: 10px 100px !important" />
            </div> -->
        </div>
        </div>
    </section>

    @include('public.partials.image-gallery-modal')

    <style>
        /* White carousel control icons for Misterio page */
        #ehadImageSlider .carousel-control-prev-icon,
        #marchisioSlider1 .carousel-control-prev-icon,
        #marchisioSlider2 .carousel-control-prev-icon,
        #marchisioSlider3 .carousel-control-prev-icon {
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='%23ffffff' viewBox='0 0 8 8'%3E%3Cpath d='M5.5 0.5L2 4l3.5 3.5L5 8 1 4l4-4z'/%3E%3C/svg%3E");
        }
        
        #ehadImageSlider .carousel-control-next-icon,
        #marchisioSlider1 .carousel-control-next-icon,
        #marchisioSlider2 .carousel-control-next-icon,
        #marchisioSlider3 .carousel-control-next-icon {
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='%23ffffff' viewBox='0 0 8 8'%3E%3Cpath d='M2.5 0.5L6 4 2.5 7.5 3 8l4-4-4-4z'/%3E%3C/svg%3E");
        }
    </style>
@endsection
