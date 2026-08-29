@extends('public.layouts.header_black_white_fixed')

@section('content')


<style>
    /* =========================
   BANNER WRAPPER
========================= */
.sectionOne,
.sectionMobile{
    position: relative;
    width: 100%;
    height: auto;
    overflow: hidden;
    margin: 0 !important;
    padding: 0 !important;
    line-height: 0;
}

/* =========================
   VIDEO
========================= */
.sectionOne video,
.sectionMobile video{
    width: 100%;
    height: auto;
    display: block;
    object-fit: contain;
}

/* =========================
   IMAGE
========================= */
.sectionOne img,
.sectionMobile img{
    width: 100%;
    height: auto;
    display: block;
}

/* fallback image div if needed */
.banner-fallback{
    width: 100%;
    height: auto;
    min-height: 300px;
    background-size: contain;
    background-repeat: no-repeat;
    background-position: center;
}

/* remove unwanted gaps */
.sectionOne,
.sectionMobile,
section,
video,
img{
    margin-top: 0 !important;
    margin-bottom: 0 !important;
    padding-top: 0 !important;
    padding-bottom: 0 !important;
    display: block;
}
    .louis-erard-page{
        padding-bottom:30px;
    }

    .le-brand-strip{
        background:#ffffff;
        text-align:center;
        padding:22px 15px 18px;
        line-height:0;
    }

    .le-brand-strip img{
        width:min(165px, 42vw);
        height:auto;
        display:inline-block;
    }

    .le-hero{
        position:relative;
        width:100%;
        height:clamp(260px, 43vw, 520px);
        overflow:hidden;
        background:#000;
        line-height:0;
    }

    .le-hero img,
    .le-hero video{
        width:100%;
        height:100%;
        object-fit:cover;
        display:block;
    }

    .le-hero-caption{
        position:absolute;
        left:50%;
        bottom:28px;
        transform:translateX(-50%);
        width:min(430px, 82%);
        color:#fff;
        z-index:2;
        text-align:left;
    }

    .le-hero-caption span{
        display:block;
        font-family:Arial, Helvetica, sans-serif;
        font-weight:700;
        text-transform:uppercase;
        letter-spacing:.14em;
        line-height:1.12;
        font-size:clamp(20px, 2.2vw, 34px);
    }

    .le-intro{
        text-align:center;
        /* padding:34px 16px 10px; */
    }

    .le-title{
        margin:0 0 14px;
        font-family:"Argent CF", Georgia, serif;
        font-size:24px;
        line-height:1.1;
        font-weight:400;
        color:#000;
        text-transform:uppercase;
    }

    .le-copy{
        max-width:1100px;
        margin:0 auto;
        font-family:"Poppins", sans-serif;
        font-size:13px;
        line-height:1.59;
        color:#111;
    }

    .le-collections{
        text-align:center;
        padding:49px 31px 8px;
    }

    .le-collections-copy{
        max-width:720px;
        margin:0 auto;
        font-family:"Poppins", sans-serif;
        font-size:13px;
        line-height:1.7;
        color:#111;
    }

    .le-toolbar{
        display:flex;
        justify-content:flex-end;
        align-items:center;
        padding:8px 24px 18px;
    }

    .le-filter-btn{
        border:none !important;
        outline:none !important;
        box-shadow:none !important;
        background:transparent !important;
        color:#333 !important;
        padding:0 !important;
        font-size:14px;
        letter-spacing:.02em;
        display:flex;
        align-items:center;
        gap:8px;
        text-transform:uppercase;
    }

    .le-filter-btn:hover,
    .le-filter-btn:focus,
    .le-filter-btn:active{
        border:none !important;
        outline:none !important;
        box-shadow:none !important;
        background:transparent !important;
        color:#111 !important;
    }

    .le-filter-btn .navbar-toggler-icon{
        width:18px;
        height:14px;
        background:none;
        display:inline-block;
        position:relative;
        background-image:url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 20'%3e%3crect x='0' y='0' width='30' height='2' fill='%23333'/%3e%3crect x='0' y='9' width='30' height='2' fill='%23333'/%3e%3crect x='0' y='18' width='30' height='2' fill='%23333'/%3e%3c/svg%3e");
        background-size:100% 100%;
        background-repeat:no-repeat;
        margin:0;
    }

    .onlineStore .col-6,
    .onlineStore .col-sm-4,
    .onlineStore .col-md-3,
    .onlineStore .col-lg-3{
        display:flex;
        flex-direction:column;
    }

    .onlineStore .card{
        flex:1;
        display:flex;
        flex-direction:column;
    }

    .onlineStore .card-body{
        flex:1;
        display:flex;
        flex-direction:column;
        justify-content:space-between;
    }

    .discover-more-btn{
        align-self:center;
        margin:0 auto;
    }

    .offcanvas-modern{
        font-family:'Inter', Arial, sans-serif;
        background:#fff !important;
        color:#222;
        min-width:320px;
        max-width:380px;
    }

    .offcanvas-modern .offcanvas-header{
        border-bottom:1px solid #fff;
        padding-bottom:.5rem;
        background:#fff;
    }

    .offcanvas-modern .offcanvas-title{
        font-size:1.1rem;
        font-weight:400;
        letter-spacing:.02em;
        text-transform:uppercase;
        color:#222;
    }

    .offcanvas-modern .btn-close{
        filter:none;
        opacity:1;
        background-size:1em;
        width:1em;
        height:1em;
    }

    .offcanvas-modern .offcanvas-body{
        background:#fff;
        padding:1rem;
    }

    .sort-list,
    .category-list,
    .subcategory-list{
        list-style:none;
        padding-left:0;
        margin-bottom:0;
    }

    .sort-list{
        max-height:0;
        overflow:hidden;
        transition:max-height .3s ease-out;
    }

    .sort-list.show{
        max-height:300px;
        transition:max-height .3s ease-in;
    }

    .sort-list li{
        padding:.4rem 0;
        font-size:.97rem;
        display:flex;
        align-items:center;
        color:#222;
        cursor:pointer;
    }

    .sort-list li.selected{
        font-weight:600;
        color:#111;
    }

    .sort-list li .diamond{
        font-size:.7em;
        margin-right:.7em;
        color:#b2b2b2;
    }

    .sort-list li.selected .diamond{
        color:#111;
    }

    .filter-section-title{
        font-size:.98rem;
        font-weight:300;
        letter-spacing:.01em;
        margin-bottom:.8rem;
        margin-top:1.5rem;
        text-transform:uppercase;
        color:#222;
        display:flex;
        align-items:center;
        justify-content:space-between;
        border-bottom:1px solid #ecebe7;
        padding-bottom:.5rem;
        cursor:pointer;
    }

    .category-list.collapsible{
        max-height:1000px;
        overflow:hidden;
        transition:max-height .3s ease-out;
    }

    .category-list.collapsible:not(.show){
        max-height:0;
        transition:max-height .3s ease-in;
    }

    .category-list > li{
        padding:.4rem 0;
        font-size:.97rem;
        display:flex;
        align-items:center;
        color:#222;
        cursor:pointer;
    }

    .category-toggle{
        font-size:1.1em;
        color:#b2b2b2;
        cursor:pointer;
        user-select:none;
        width:20px;
        text-align:center;
        margin-left:10px;
    }

    .form-check-input.filter-tag-checkbox{
        accent-color:#111;
        border-color:#bbb;
        box-shadow:none !important;
        margin-right:8px;
    }

    .form-check-input.filter-tag-checkbox:checked{
        background-color:#111;
        border-color:#111;
    }

    .filter-actions{
        position:sticky;
        bottom:-16px;
        background:#fff;
        padding:12px 0 0 0;
    }

    .filter-actions-inner{
        border-top:1px solid #fff;
        padding-top:12px;
        display:flex;
        gap:10px;
    }

    .filter-actions .btn{
        border-radius:10px;
        font-size:13px;
        padding:8px 14px;
    }

    .louis-erard-footer{
        padding-top:26px !important;
    }

    @media (max-width: 767px){
        .sectionMobile{
            height: clamp(200px, 150vw, 800px);
            max-height: 800px;
        }

        .sectionMobile img,
        .sectionMobile video{
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center center;
        }

        .louis-erard-page{
            padding-bottom:20px;
        }

        .le-brand-strip{
            padding:18px 12px 16px;
        }

        .le-brand-strip img{
            width:min(150px, 52vw);
        }

        .le-hero{
            height:240px;
        }

        .le-hero-caption{
            width:84%;
            bottom:20px;
        }

        .le-hero-caption span{
            font-size:23px;
            letter-spacing:.12em;
        }

        .le-intro{
            padding:28px 14px 6px;
        }

        .le-title{
            font-size:24px;
            margin-bottom:12px;
        }

        .le-copy,
        .le-collections-copy{
            font-size:13px;
            line-height:1.7;
        }

        .le-collections{
            padding:26px 14px 6px;
        }

        .le-toolbar{
            padding:8px 14px 14px;
        }

        .le-filter-btn{
            font-size:12px;
        }

        .offcanvas-modern{
            min-width:100% !important;
            max-width:100% !important;
            width:100% !important;
        }
         .chronoswiss-logo-section{
        padding:0px 12px 0px;   /* almost no bottom space */
        margin:0;
        line-height:0;
    }

    .chronoswiss-logo-main{
        width:min(150px,48vw);
        display:block;
        margin:0 auto;
        transform:translateY(15px);
    }
    }
    .chronoswiss-logo-section{

width:100%;
    background:#fff;
    text-align:center;
    margin-top:-8px;        /* pull upward */
    line-height:0;
padding:2px 15px 0;
    margin:0;
}

.chronoswiss-logo-main{
    width:min(210px,52vw);
    max-width:210px;
    height:auto;
    display:inline-block;
        transform: translateY(15px);


}

/* Louis Erard page vertical rhythm */
.louis-page-wrap {
    --louis-section-space:clamp(2.5rem, 5vw, 4.5rem);
    --louis-content-gap:clamp(1.25rem, 2.5vw, 2rem);
}

.louis-page-wrap .chronoswiss-logo-section {
    margin:0 !important;
    padding:var(--louis-section-space) 15px !important;
}

.louis-page-wrap .chronoswiss-logo-main {
    transform:none;
    margin:0 auto !important;
}

.louis-page-wrap .louis-erard-page {
    padding:0;
}

.louis-page-wrap .le-intro,
.louis-page-wrap .le-collections {
    /* padding:0 16px var(--louis-section-space); */
}

.louis-page-wrap .le-title {
    margin:0 0 var(--louis-content-gap);
    font-family:"Argent CF", Georgia, serif;
    font-size:36px;
    font-weight:400;
    line-height:1.2;
}

.louis-page-wrap .le-copy,
.louis-page-wrap .le-collections-copy {
    font-family:"Poppins", sans-serif;
    font-size:13px;
    line-height:1.59;
}

.louis-page-wrap .louis-products-section {
    padding:0 0 var(--louis-section-space) !important;
}

.louis-page-wrap .louis-products-section .onlineStore {
    padding-top:16px !important;
}

.louis-page-wrap .louis-erard-footer {
    padding-top:var(--louis-section-space) !important;
    padding-bottom:0 !important;
}

@media (max-width: 767px) {
    .louis-page-wrap .chronoswiss-logo-section {
        padding-right:12px !important;
        padding-left:12px !important;
    }

    .louis-page-wrap .le-intro,
    .louis-page-wrap .le-collections {
        padding-right:14px;
        padding-left:14px;
    }
}
</style>

<main class="louis-page-wrap">

@if(isset($louisErardSubcategory) && $louisErardSubcategory->banner_url)

    @php
        $desktopBanner = $louisErardSubcategory->banner_url;
        $desktopIsVideo = \Illuminate\Support\Str::endsWith(strtolower($desktopBanner), ['.mp4', '.webm', '.ogg']);

        /* mobile banner dynamic */
        $mobileBanner = $desktopBanner;

        if (trim(strtolower($louisErardSubcategory->slug ?? '')) === 'louis-erard') {
            $mobileBanner = 'assets/f_assets/image/watches mobile view/louis-erard-mobile.jpeg';
        }

        $mobileIsVideo = \Illuminate\Support\Str::endsWith(strtolower($mobileBanner), ['.mp4', '.webm', '.ogg']);
    @endphp

    {{-- =========================
         DESKTOP BANNER
    ========================= --}}
    <section class="sectionOne d-md-block d-none">
        @if($desktopIsVideo)
            <video autoplay loop muted playsinline>
                <source src="{{ asset($desktopBanner) }}" type="video/{{ strtolower(pathinfo($desktopBanner, PATHINFO_EXTENSION)) }}">
                Your browser does not support the video tag.
            </video>
        @else
            <img src="{{ asset($desktopBanner) }}" alt="{{ $louisErardSubcategory->name ?? 'Banner' }}">
        @endif
    </section>

    {{-- =========================
         MOBILE BANNER
    ========================= --}}
    <section class="sectionMobile d-md-none">
        @if($mobileIsVideo)
            <video autoplay loop muted playsinline>
                <source src="{{ asset($mobileBanner) }}" type="video/{{ strtolower(pathinfo($mobileBanner, PATHINFO_EXTENSION)) }}">
                Your browser does not support the video tag.
            </video>
        @else
            <img src="{{ asset($mobileBanner) }}" alt="{{ $louisErardSubcategory->name ?? 'Banner' }}">
        @endif
    </section>

@endif


<section class="chronoswiss-logo-section">
    <img src="{{ asset('assets/f_assets/image/watch logo/Louis Erard.png') }}"
         alt="Louis Erard logo"
         class="chronoswiss-logo-main">
</section>
<section class="louis-erard-page">

    <div class="le-intro">
        <h2 class="le-title">WHO WE ARE</h2>
        <div class="le-copy">
            Louis Erard disrupts the status quo, making artisanal craftsmanship accessible.
            Its artistic crafts timepieces defy tradition with a contemporary edge, shaped by boundary-breaking artisans.
            Since 1929, independence has fueled their fire, inspired by the untamed spirit of the Swiss Jura and building upon the iconic regulators and mechanical watches.
            Under manuale architect Alain Silberstein’s leadership, Louis Erard prioritizes innovation over conformity and lasting excellence over rapid growth, forging a new path in watchmaking.
            Collaborating with visionaries such as Alain Silberstein, Vianney Halter, and Konstantin Chaykin, the brand transcends artistic boundaries, seizing and playing with new codes to design timepieces disrupting the very essence of time itself.
        </div>
    </div>

    <div class="le-collections">
        <h2 class="le-title">COLLECTIONS</h2>
        <div class="le-collections-copy">
            Louis Erard’s singular expression of contemporary watchmaking conveyed through different lines and functions
        </div>
    </div>
</section>

{{-- KEEP YOUR EXISTING OFFCANVAS CODE AND JS BELOW THIS --}}

    <section class="louis-products-section">
        <style>
            .offcanvas-modern { font-family: 'Inter', Arial, sans-serif; background:#fff !important; color:#222; min-width:320px; max-width:380px; }
            @media (max-width: 767px) { .offcanvas-modern { min-width:100% !important; max-width:100% !important; width:100% !important; } }
            .offcanvas-modern .offcanvas-header { border-bottom:1px solid #fff; padding-bottom:0.5rem; background:#fff; }
            .offcanvas-modern .offcanvas-title { font-size:1.1rem; font-weight:400; letter-spacing:.02em; text-transform:uppercase; color:#222; }
            .offcanvas-modern .btn-close { filter:none; opacity:1; background-size:1em; width:1em; height:1em; }
            /* Simple SORT & FILTER button - no borders on any state */
            .filter .navbar-toggler { border:none !important; outline:none !important; box-shadow:none !important; background:transparent !important; padding:4px 10px; font-family:"Poppins", sans-serif; font-size:12px; line-height:1.1; display:flex; align-items:center; gap:6px; }
            .filter .navbar-toggler:focus,
            .filter .navbar-toggler:hover,
            .filter .navbar-toggler:active { border:none !important; outline:none !important; box-shadow:none !important; background:transparent !important; }
            /* Match Online Shopping Store hamburger symbol */
            .filter .navbar-toggler-icon {
                width: 18px; height: 14px; background: none; display: inline-block; position: relative;
                background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 20'%3e%3crect x='0' y='0' width='30' height='2' fill='%23333'/%3e%3crect x='0' y='9' width='30' height='2' fill='%23333'/%3e%3crect x='0' y='18' width='30' height='2' fill='%23333'/%3e%3c/svg%3e");
                background-size: 100% 100%; background-repeat: no-repeat; margin-right: 2px;
            }
            /* Online Shopping Store spacing and typography for lists */
            .sort-list, .category-list, .subcategory-list { list-style:none; padding-left:0; margin-bottom:0; }
            .sort-list { max-height: 0; overflow:hidden; transition: max-height 0.3s ease-out; }
            .sort-list.show { max-height: 300px; transition: max-height 0.3s ease-in; }
            .sort-list li { padding: 0.4rem 0; font-size: 0.97rem; display:flex; align-items:center; color:#222; cursor:pointer; }
            .sort-list li.selected { font-weight: 600; color:#111; }
            .sort-list li .diamond { font-size: 0.7em; margin-right: 0.7em; color: #b2b2b2; }
            .sort-list li.selected .diamond { color:#111; }
            .category-list > li { padding: 0.4rem 0; font-size: 0.97rem; display:flex; align-items:center; color:#222; cursor:pointer; }
            .filter-section-title { font-size:.98rem; font-weight:300; letter-spacing:.01em; margin-bottom:.8rem; margin-top:1.5rem; text-transform:uppercase; color:#222; display:flex; align-items:center; justify-content:space-between; border-bottom:1px solid #ecebe7; padding-bottom:.5rem; cursor:pointer; }
            .category-list { list-style:none; padding-left:0; margin-bottom:0; }
            .category-list.collapsible { max-height:1000px; overflow:hidden; transition:max-height .3s ease-out; }
            .category-list.collapsible:not(.show) { max-height:0; transition:max-height .3s ease-in; }
            .category-list > li { padding:.4rem 0; font-size:.97rem; display:flex; align-items:center; color:#222; cursor:pointer; }
            .category-toggle { font-size:1.1em; color:#b2b2b2; cursor:pointer; user-select:none; width:20px; text-align:center; margin-left:10px; }
            .form-check-input.filter-tag-checkbox { accent-color:#111; border-color:#bbb; box-shadow:none !important; }
            .form-check-input.filter-tag-checkbox:checked { background-color:#111; border-color:#111; }
            .filter-actions { position:sticky; bottom:-16px; background:#fff; padding:12px 0 0 0; }
            .filter-actions-inner { border-top:1px solid #fff; padding-top:12px; display:flex; gap:10px; }
            .filter-actions .btn { border-radius:10px; font-size:13px; padding:8px 14px; }
            .offcanvas-modern .offcanvas-body { background: rgb(255, 255, 255); padding: 1rem; }
            /* Ensure cards fill available space */
            .onlineStore .col-6, .onlineStore .col-sm-4, .onlineStore .col-md-3, .onlineStore .col-lg-3 {
                display: flex;
                flex-direction: column;
            }
            .onlineStore .card {
                flex: 1;
                display: flex;
                flex-direction: column;
            }
            .onlineStore .card-body {
                flex: 1;
                display: flex;
                flex-direction: column;
                justify-content: space-between;
            }
            /* Center the Discover More button */
            .discover-more-btn {
                align-self: center;
                margin: 0 auto;
            }
            /* Add space between checkbox and text */
            .filter-tag-checkbox {
                margin-right: 8px;
            }
                       .brand-logo {
                display: block;
                margin-left: auto;
                margin-right: auto;
                width: 10%;
                height: auto;
            }
            /* Responsive logo sizing */
            @media (max-width: 575px) {
                .brand-logo {
                    width: 40%;
                    margin-top: -75px;
                }
            }
            @media (min-width: 576px) and (max-width: 767px) {
                .brand-logo {
                    width: 30%;
                }
            }
            @media (min-width: 768px) and (max-width: 991px) {
                .brand-logo {
                    width: 20%;
                }
            }
            @media (min-width: 992px) {
                .brand-logo {
                    width: 20%;
                    margin-top: -75px;
                }
            }
            /* Responsive SORT & FILTER button positioning */
            .filter .navbar-toggler {
                position: absolute !important;
                right: 0 !important;
                z-index: 10;
            }
            /* Mobile screens (up to 575px) */
            @media (max-width: 575px) {
                .filter .navbar-toggler {
                    /* margin-top: 80px !important; */
                    margin-right: 10px !important;
                    font-size: 12px !important;
                    padding: 4px 8px !important;
                }
            }
            /* Small mobile screens (576px to 767px) */
            @media (min-width: 576px) and (max-width: 767px) {
                .filter .navbar-toggler {
                    /* margin-top: 100px !important; */
                    margin-right: 15px !important;
                    font-size: 12px !important;
                }
            }
            /* Tablet screens (768px to 991px) */
            @media (min-width: 768px) and (max-width: 991px) {
                .filter .navbar-toggler {
                    /* margin-top: 120px !important; */
                    margin-right: 20px !important;
                }
            }
            /* Desktop screens (992px and above) */
            @media (min-width: 992px) {
                .filter .navbar-toggler {
                    /* margin-top: 127px !important; */
                    margin-right: 23px !important;
                }
            }
                .offcanvas.offcanvas-modern{
  z-index: 20000 !important;
}

/* Offcanvas must be above any fixed header */
.offcanvas{
  z-index: 20000 !important;
}

/* Backdrop should stay below offcanvas */
.offcanvas-backdrop{
  z-index: 19999 !important;
}
        </style>
      <div class="navbar navbar-white align-items-center filter position-relative justify-content-center">
            <div class="brand-logo-wrapper w-70 my-3 text-center"style="display:none;">
                <img src="{{ asset('assets/f_assets/image/watch logo/LE.png') }}" alt="Loius Erad logo" class="brand-logo">
            </div>
        </div>
        <div class="filter d-flex justify-content-end px-3">
            <button class="navbar-toggler border-0 text-black" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasLouisErard" aria-controls="offcanvasLouisErard" aria-label="Toggle navigation" style="position:static!important; margin:0!important;">
                <span class="navbar-toggler-icon"></span> SORT & FILTER
            </button>
        </div>

        <div class="container-fluid px-3">
        <div class="row onlineStore g-2 pt-3" id="louisErardGrid">
            @if(isset($products) && $products->count())
                @foreach($products as $prod)
                    <div class="col-6 col-sm-4 col-md-3 col-lg-3">
                        @include('public.partials.product-card-watches', ['product' => $prod])
                    </div>
                @endforeach
            @else
                <div class="col-12"><div class="text-center py-5 text-muted">Collections Revealed Soon!</div></div>
            @endif
        </div>
        </div>
        
        <div class="text-center py-4 louis-erard-footer">
        @if($products->count() > 0)
            @php
                $totalShown = $currentPageProducts;
                $hasMorePages = $products->currentPage() < $products->lastPage();
            @endphp
            @if($totalFilteredProducts > 0)
            <div class="products-counter" data-total="{{ $totalFilteredProducts }}" data-current="{{ $currentPageProducts }}" data-per-page="{{ $products->perPage() }}" data-current-page="{{ $products->currentPage() }}" style="font-family: 'Poppins', sans-serif; font-size: 0.8rem; letter-spacing: 0.2em;">
                SHOWING {{ $currentPageProducts }} OF {{ $totalFilteredProducts }} PRODUCTS
            </div>
            @endif
            @php
                $allProductsShown = $totalShown >= $totalFilteredProducts;
                $shouldShowLoadMore = $hasMorePages && !$allProductsShown;
            @endphp
            @if($shouldShowLoadMore)
                <button id="loadMoreBtn"
                        style="background: #e3e4e5; border: none; color: #222; font-family: 'Poppins', sans-serif; font-size: 0.7rem; letter-spacing: 0.15em; padding: 0.8rem 2rem; border-radius: 8px; font-weight: 400; box-shadow: none; transition: background 0.2s;"
                        data-page="{{ $products->currentPage() + 1 }}"
                        data-last-page="{{ $products->lastPage() }}"
                        data-per-page="{{ $products->perPage() }}"
                        data-total="{{ $totalFilteredProducts }}">
                    LOAD MORE
                </button>
            @endif
        </div>
        @endif
    </section>

    <div class="offcanvas offcanvas-end offcanvas-modern" tabindex="-1" id="offcanvasLouisErard" aria-labelledby="offcanvasLouisErardLabel" data-bs-backdrop="true" data-bs-scroll="false">
        <div class="offcanvas-header">
            <span class="offcanvas-title" id="offcanvasLouisErardLabel">SORT & FILTER</span>
            <button type="button" class="btn-close btn-close-black" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <div>
                <div class="filter-section-title" onclick="toggleCategory('louisErardSortList', this.querySelector('.category-toggle'))" style="font-size: 14px !important;">
                    Sort By <span class="category-toggle">+</span>
                </div>
                <ul class="sort-list" id="louisErardSortList">
                    @php $currentSort = request('sort'); @endphp
                    <li data-value="" class="{{ !$currentSort ? 'selected' : '' }}">
                        <span class="diamond">{{ !$currentSort ? '◆' : '◇' }}</span> Best Selling
                    </li>
                    <li data-value="az" class="{{ $currentSort=='az' ? 'selected' : '' }}">
                        <span class="diamond">{{ $currentSort=='az' ? '◆' : '◇' }}</span> Alphabetically, A-Z
                    </li>
                    <li data-value="za" class="{{ $currentSort=='za' ? 'selected' : '' }}">
                        <span class="diamond">{{ $currentSort=='za' ? '◆' : '◇' }}</span> Alphabetically, Z-A
                    </li>
                    <li data-value="price_low_high" class="{{ $currentSort=='price_low_high' ? 'selected' : '' }}">
                        <span class="diamond">{{ $currentSort=='price_low_high' ? '◆' : '◇' }}</span> Price, low to high
                    </li>
                    <li data-value="price_high_low" class="{{ $currentSort=='price_high_low' ? 'selected' : '' }}">
                        <span class="diamond">{{ $currentSort=='price_high_low' ? '◆' : '◇' }}</span> Price, high to low
                    </li>
                    <li data-value="new_old" class="{{ $currentSort=='new_old' ? 'selected' : '' }}">
                        <span class="diamond">{{ $currentSort=='new_old' ? '◆' : '◇' }}</span> Date, new to old
                    </li>
                    <li data-value="old_new" class="{{ $currentSort=='old_new' ? 'selected' : '' }}">
                        <span class="diamond">{{ $currentSort=='old_new' ? '◆' : '◇' }}</span> Date, old to new
                    </li>
                </ul>
            </div>
            <div>
                <div class="filter-section-title" onclick="toggleCategory('louisErardGenderList', this.querySelector('.category-toggle'))" style="font-size: 14px !important;">Gender <span class="category-toggle">+</span></div>
                <ul class="category-list collapsible" id="louisErardGenderList">
                    @php $selectedTags = collect(explode(',', request('tags', '')))->map(fn($s)=>trim($s)); @endphp
                    <li><input type="checkbox" class="form-check-input filter-tag-checkbox louis-erard-filter" data-group="gender" value="mens" {{ $selectedTags->contains('mens') ? 'checked' : '' }} onclick="event.stopPropagation();"> <span class="subcat-label">Men's</span></li>
                    <li><input type="checkbox" class="form-check-input filter-tag-checkbox louis-erard-filter" data-group="gender" value="ladies" {{ $selectedTags->contains('ladies') ? 'checked' : '' }} onclick="event.stopPropagation();"> <span class="subcat-label">Ladies</span></li>
                </ul>
            </div>
            <div class="mt-3">
                <div class="filter-section-title" onclick="toggleCategory('louisErardSeriesList', this.querySelector('.category-toggle'))" style="font-size: 14px !important;">Series <span class="category-toggle">+</span></div>
                <ul class="category-list collapsible" id="louisErardSeriesList">
                    @php $series = ['excellence','la-sportive','heritage','overview-and-straps']; @endphp
                    @foreach($series as $s)
                        <li><input type="checkbox" class="form-check-input filter-tag-checkbox louis-erard-filter" data-group="series" value="{{ $s }}" {{ $selectedTags->contains($s) ? 'checked' : '' }} onclick="event.stopPropagation();"> <span class="subcat-label">{{ ucwords(str_replace(['-'], [' '], $s)) }}</span></li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>

    <script>
    function toggleCategory(targetId, element) {
        const target = document.getElementById(targetId);
        if (!target) return;
        const isExpanded = target.classList.contains('show');
        if (isExpanded) { 
            target.classList.remove('show'); 
            if (element) element.textContent = '+'; 
        } else { 
            target.classList.add('show'); 
            if (element) element.textContent = '−'; 
        }
    }
    (function(){
        const offcanvas = document.getElementById('offcanvasLouisErard');
        function buildUrl() {
            const url = new URL(window.location.href);
            // Build unified tags param to match server-side filtering
            url.searchParams.delete('tags');
            url.searchParams.delete('gender');
            url.searchParams.delete('series');
            const selected = Array.from(document.querySelectorAll('.louis-erard-filter:checked')).map(i=>i.value);
            if (selected.length) url.searchParams.set('tags', selected.join(',')); else url.searchParams.delete('tags');
            url.searchParams.set('page', '1');
            return url;
        }
        function fetchAndRender(url) {
            window.history.pushState({}, '', url.toString());
            fetch(url.toString(), { headers: { 'X-Requested-With': 'XMLHttpRequest' }})
                .then(resp => resp.text())
                .then(html => {
                    const parser = new DOMParser();
                    const doc = parser.parseFromString(html, 'text/html');
                    const incomingGrid = doc.querySelector('#louisErardGrid');
                    const grid = document.querySelector('#louisErardGrid');
                    
                    if (incomingGrid && grid) {
                        grid.innerHTML = incomingGrid.innerHTML;
                    }
                    
                    const incomingFooter = doc.querySelector('.louis-erard-footer');
                    const footer = document.querySelector('.louis-erard-footer');
                    if (footer) {
                        footer.innerHTML = incomingFooter ? incomingFooter.innerHTML : '';
                        if (typeof window.bindLoadMore === 'function') {
                            window.bindLoadMore();
                        }
                        if (typeof window.updateCounter === 'function') {
                            window.updateCounter();
                        }
                    }
                    
                    // Keep offcanvas open like Online Store for quick multi-select
                })
                .catch(()=>{});
        }
        // Sort handlers (AJAX, no page reload)
        (function(){
            const sortList = document.getElementById('louisErardSortList');
            if (!sortList) return;
            sortList.querySelectorAll('li').forEach(li => {
                li.addEventListener('click', function(){
                    // UI update like online store
                    sortList.querySelectorAll('li').forEach(x => { x.classList.remove('selected'); const d=x.querySelector('.diamond'); if(d) d.textContent='◇'; });
                    this.classList.add('selected'); const d=this.querySelector('.diamond'); if(d) d.textContent='◆';
                    const url = buildUrl();
                    const val = this.getAttribute('data-value') || '';
                    if (val) url.searchParams.set('sort', val); else url.searchParams.delete('sort');
                    fetchAndRender(url);
                });
            });
        })();

        // Checkbox immediate apply like online store
        document.querySelectorAll('.louis-erard-filter').forEach(cb => {
            cb.addEventListener('click', function(e){ e.stopPropagation(); const url = buildUrl(); fetchAndRender(url); });
        });
    })();
    
    // Load More functionality
    document.addEventListener('DOMContentLoaded', function() {
        window.bindLoadMore = function bindLoadMore() {
            const loadMoreBtn = document.getElementById('loadMoreBtn');
            if (!loadMoreBtn) return;
            
            // Remove previous listeners by cloning
            const btn = loadMoreBtn.cloneNode(true);
            loadMoreBtn.parentNode.replaceChild(btn, loadMoreBtn);

            function getGrid(container) {
                return container.querySelector('#louisErardGrid');
            }

            function appendIncomingItems(doc) {
                const currentGrid = getGrid(document);
                if (!currentGrid) return 0;

                // Primary: take children of incoming #louisErardGrid
                let nodesToAppend = [];
                const incomingGrid = getGrid(doc) || doc.querySelector('#louisErardGrid');
                if (incomingGrid) {
                    nodesToAppend = Array.from(incomingGrid.children);
                } else {
                    // Fallback: find product cards and append their closest column wrappers
                    const cards = Array.from(doc.querySelectorAll('.card.addToCartProductDetailsTop'));
                    nodesToAppend = cards.map(card => card.closest('.col-6, .col-sm-4, .col-md-3, .col-lg-3') || card);
                }
                let appended = 0;
                nodesToAppend.forEach(node => {
                    if (!node) return;
                    currentGrid.appendChild(node);
                    appended++;
                });
                return appended;
            }

            window.updateCounter = function updateCounter() {
                const grid = getGrid(document);
                if (!grid) return;
                
                // Count products dynamically from the grid - count actual product cards
                const totalShown = grid.querySelectorAll('.card.addToCartProductDetailsTop').length;
                const counter = document.querySelector('.louis-erard-footer .products-counter');
                
                if (counter) {
                    // Get the total from data attribute (set by server)
                    const total = parseInt(counter.getAttribute('data-total') || '0', 10);
                    const perPage = parseInt(counter.getAttribute('data-per-page') || '20', 10);
                    
                    // Update the current count
                    counter.setAttribute('data-current', totalShown);
                    
                    // Only show counter if there are products
                    if (total > 0) {
                        // Update the display text with actual counts
                        counter.textContent = `SHOWING ${totalShown} OF ${total} PRODUCTS`;
                        counter.style.display = 'block';
                    } else {
                        counter.style.display = 'none';
                    }
                    
                    // Update button data if it exists
                    const loadMoreBtn = document.getElementById('loadMoreBtn');
                    if (loadMoreBtn) {
                        const currentPage = parseInt(loadMoreBtn.getAttribute('data-page') || '2', 10);
                        const lastPage = parseInt(loadMoreBtn.getAttribute('data-last-page') || '2', 10);
                        const totalFromBtn = parseInt(loadMoreBtn.getAttribute('data-total') || total, 10);
                        
                        // Hide button if all products are shown or no more pages
                        if (totalShown >= totalFromBtn || currentPage > lastPage) {
                            loadMoreBtn.style.display = 'none';
                        } else {
                            loadMoreBtn.style.display = 'inline-block';
                        }
                    }
                }
            }

            btn.addEventListener('click', function() {
                const nextPage = parseInt(btn.getAttribute('data-page') || '2', 10);
                const lastPage = parseInt(btn.getAttribute('data-last-page') || String(nextPage), 10);
                const perPage = parseInt(btn.getAttribute('data-per-page') || '20', 10);
                const total = parseInt(btn.getAttribute('data-total') || '0', 10);
                
                btn.disabled = true;
                btn.textContent = 'Loading...';

                // Preserve current query (sort, tags, etc.)
                const url = new URL(window.location.href);
                url.searchParams.set('page', String(nextPage));

                fetch(url.toString(), { headers: { 'X-Requested-With': 'XMLHttpRequest' }, cache: 'no-cache' })
                    .then(response => response.text())
                    .then(html => {
                        const parser = new DOMParser();
                        const doc = parser.parseFromString(html, 'text/html');

                        let appended = appendIncomingItems(doc);
                        window.updateCounter();

                        // Sync data from incoming markup
                        const incomingBtn = doc.querySelector('#loadMoreBtn');
                        const incomingCounter = doc.querySelector('.products-counter');
                        
                        if (incomingBtn) {
                            const incomingLast = parseInt(incomingBtn.getAttribute('data-last-page') || String(lastPage), 10);
                            const incomingPerPage = parseInt(incomingBtn.getAttribute('data-per-page') || String(perPage), 10);
                            const incomingTotal = parseInt(incomingBtn.getAttribute('data-total') || String(total), 10);
                            
                            btn.setAttribute('data-last-page', String(incomingLast));
                            btn.setAttribute('data-per-page', String(incomingPerPage));
                            btn.setAttribute('data-total', String(incomingTotal));
                        }
                        
                        if (incomingCounter) {
                            const counter = document.querySelector('.products-counter');
                            if (counter) {
                                counter.setAttribute('data-total', incomingCounter.getAttribute('data-total') || total);
                                counter.setAttribute('data-per-page', incomingCounter.getAttribute('data-per-page') || perPage);
                            }
                        }

                        // If nothing appended but we did receive a grid, try innerHTML append as a fallback
                        if (appended === 0) {
                            const currentGrid = document.querySelector('#louisErardGrid');
                            const incomingGrid2 = doc.querySelector('#louisErardGrid');
                            if (currentGrid && incomingGrid2) {
                                currentGrid.insertAdjacentHTML('beforeend', incomingGrid2.innerHTML);
                                appended = incomingGrid2.children.length;
                                window.updateCounter();
                            }
                        }
                        
                        // Check if we've reached the end
                        const currentTotal = parseInt(btn.getAttribute('data-total') || total, 10);
                        const currentGrid = document.querySelector('#louisErardGrid');
                        const currentShown = currentGrid ? currentGrid.querySelectorAll('.card.addToCartProductDetailsTop').length : 0;
                        const reachedEnd = currentShown >= currentTotal || appended === 0;
                        
                        if (reachedEnd) {
                            btn.style.display = 'none';
                        } else {
                            btn.setAttribute('data-page', String(nextPage + 1));
                            btn.disabled = false;
                            btn.textContent = 'LOAD MORE';
                            btn.style.display = 'inline-block';
                        }
                        // Smoothly scroll a bit to bring new items into view
                        try { window.scrollBy({ top: 200, left: 0, behavior: 'smooth' }); } catch (_) {}
                    })
                    .catch(() => {
                        btn.disabled = false;
                        btn.textContent = 'LOAD MORE';
                        // As a last resort, fall back to full navigation
                        try {
                            const url = new URL(window.location.href);
                            const nextPage = parseInt(btn.getAttribute('data-page') || '2', 10);
                            url.searchParams.set('page', String(nextPage));
                            window.location.href = url.toString();
                        } catch (_) {}
                    });
            });
        };
        // Initial bind
        window.bindLoadMore();
        
        // Initialize counter on page load
        window.updateCounter();
    });
    </script>
</main>
@endsection
