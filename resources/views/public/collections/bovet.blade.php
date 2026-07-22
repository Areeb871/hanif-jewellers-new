@extends('public.layouts.header_new')

@section('content')
<style>
    @media (min-width: 992px){
  /* IMPORTANT: replace .mainHeader with your actual header wrapper class/id */
  header, .mainHeader, .navbar-main, .site-header {
      position: absolute !important;
      top: 0;
      left: 0;
      width: 100%;
      z-index: 9999;
      background: transparent !important;
  }

  /* Remove any shadow/border if your header has it */
  header *, .mainHeader * , .navbar-main * , .site-header *{
      box-shadow: none !important;
  }

  /* Hero starts from top of page (behind header) */
  #bovetHero{
      position: relative;
      width: 100%;
      height: 120vh;          /* your desktop hero height */
      overflow: hidden;
      margin-top: 0 !important;
      padding-top: 0 !important;
  }
/* Shared for image & video */
.bovet-hero__media{
    position: absolute;
    inset: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
}

  /* Video fills hero */
  #bovetHero video{
      position: absolute;
      top: 50%;
      left: 50%;
      width: 100%;
      height: 100%;
      object-fit: cover;
      transform: translate(-50%, -50%);
  }

  /* If banner is image div fallback */
  #bovetHero .video-fallback-desktop,
  #bovetHero .hero-image{
      position: absolute;
      inset: 0;
      background-size: cover;
      background-position: center;
  }
}
  </style>
    {{-- =======================
        BANNER SECTION
    ======================== --}}
 @php
    use Illuminate\Support\Str;

    // Desktop asset
    $desktopAsset = $bovetSubcategory->banner_url ?? null;

    // Mobile asset (custom Bovet mobile video fallback)
    $mobileAsset = ($bovetSubcategory->slug === 'bovet')
        ? 'assets/f_assets/image/watches mobile view/bovet_st.jpg'
        : $desktopAsset;

    // Detect types
    $desktopIsVideo = $desktopAsset && Str::endsWith($desktopAsset, ['.mp4', '.webm', '.ogg']);
    $mobileIsVideo  = $mobileAsset && Str::endsWith($mobileAsset,  ['.mp4', '.webm', '.ogg']);
@endphp

@if($desktopAsset)
<section class="bovet-hero" id="bovetHero">

    {{-- =====================
        DESKTOP
    ====================== --}}
    @if($desktopIsVideo)
        <video class="bovet-hero__media d-none d-md-block"
               autoplay loop muted playsinline preload="metadata">
            <source src="{{ asset($desktopAsset) }}"
                    type="video/{{ pathinfo($desktopAsset, PATHINFO_EXTENSION) }}">
        </video>
    @else
        <img src="{{ asset($desktopAsset) }}"
             class="bovet-hero__media d-none d-md-block"
             alt="{{ $bovetSubcategory->name ?? 'Banner' }}"
             loading="eager">
    @endif


    {{-- =====================
        MOBILE
    ====================== --}}
    @if($mobileIsVideo)
        <video class="bovet-hero__media d-block d-md-none"
               autoplay loop muted playsinline preload="metadata">
            <source src="{{ asset($mobileAsset) }}"
                    type="video/{{ pathinfo($mobileAsset, PATHINFO_EXTENSION) }}">
        </video>
    @else
        <img src="{{ asset($mobileAsset) }}"
             class="bovet-hero__media d-block d-md-none"
             alt="{{ $bovetSubcategory->name ?? 'Banner' }}"
             loading="eager">
    @endif

</section>
@endif


    {{-- =======================
        PAGE STYLES
    ======================== --}}
    <section class="py-4">
        <style>
            /* =========================
               GLOBAL / BASE
            ========================== */
            .offcanvas-modern{
                font-family: 'Inter', Arial, sans-serif;
                background:#fff !important;
                color:#222;
                min-width:320px;
                max-width:380px;
            }
            .offcanvas-modern .offcanvas-header{
                border-bottom:1px solid #fff;
                padding-bottom:0.5rem;
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

            /* Offcanvas full width on mobile */
            @media (max-width: 767px){
                .offcanvas-modern{
                    width:100vw !important;
                    max-width:100vw !important;
                    min-width:100vw !important;
                }
            }

            /* =========================
               BANNER RESPONSIVENESS
               (Fix 120vh causing issues on mobile)
            ========================== */
            .video-desktop,
            .video-fallback-desktop{
                width:100%;
                height:120vh;
                object-fit:cover;
                background-size:cover;
                background-position:center;
            }
            .video-mobile,
            .video-fallback-mobile{
                width:100%;
                height:70vh;
                object-fit:cover;
                background-size:cover;
                background-position:center;
            }
            @media (max-width: 360px){
                .video-mobile,
                .video-fallback-mobile{ height:62vh; }
            }
            @media (min-width: 576px) and (max-width: 991px){
                .video-mobile,
                .video-fallback-mobile{ height:80vh; }
            }

            /* =========================
               FILTER BAR (FIXED)
               No absolute positioning, no margin-top hacks.
            ========================== */
            .filter-bar{
                display:flex;
                align-items:center;
                justify-content:space-between;
                gap:12px;
                padding:12px 14px;
                background:#fff;
                position: sticky; /* optional, keeps it visible on scroll */
                top: 0;
                z-index: 50;
            }
            .brand-logo-wrapper{
                display:flex;
                align-items:center;
                justify-content:flex-start;
                min-width:0;
            }
            .brand-logo{
                width:clamp(120px, 32vw, 190px);
                height:auto;
                display:block;
            }

            /* Sort button - no borders on any state */
            .filter-toggler{
                border:none !important;
                outline:none !important;
                box-shadow:none !important;
                background:transparent !important;
                padding:6px 8px;
                font-size:12px;
                line-height:1;
                display:flex;
                align-items:center;
                gap:6px;
                white-space:nowrap;
            }
            .filter-toggler:focus,
            .filter-toggler:hover,
            .filter-toggler:active{
                border:none !important;
                outline:none !important;
                box-shadow:none !important;
                background:transparent !important;
            }
            /* Same hamburger icon style */
            .filter-toggler .navbar-toggler-icon{
                width:18px;
                height:14px;
                background:none;
                display:inline-block;
                background-image:url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 20'%3e%3crect x='0' y='0' width='30' height='2' fill='%23333'/%3e%3crect x='0' y='9' width='30' height='2' fill='%23333'/%3e%3crect x='0' y='18' width='30' height='2' fill='%23333'/%3e%3c/svg%3e");
                background-size:100% 100%;
                background-repeat:no-repeat;
                margin-right:2px;
            }

            /* =========================
               SORT/FILTER LISTS
            ========================== */
            .sort-list, .category-list, .subcategory-list{
                list-style:none;
                padding-left:0;
                margin-bottom:0;
            }
            .sort-list{
                max-height:0;
                overflow:hidden;
                transition:max-height 0.3s ease-out;
            }
            .sort-list.show{
                max-height:300px;
                transition:max-height 0.3s ease-in;
            }
            .sort-list li{
                padding:0.4rem 0;
                font-size:0.97rem;
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
                font-size:0.7em;
                margin-right:0.7em;
                color:#b2b2b2;
            }
            .sort-list li.selected .diamond{ color:#111; }

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
            }
            .form-check-input.filter-tag-checkbox:checked{
                background-color:#111;
                border-color:#111;
            }
            .filter-tag-checkbox{ margin-right:8px; }

            /* Sticky actions area */
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

            /* =========================
               PRODUCT GRID MOBILE POLISH
            ========================== */
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
           .discover-more-btn{
  display: block;
  margin: 0 auto;
}
            /* Counter look */
            .products-counter{
                font-size:1rem;
                letter-spacing:0.2em;
                margin-bottom:1.5rem;
            }
            /* ===============================
   HERO (Fix white blank space)
================================ */
/* Wrapper controls the height */
.bovet-hero{
    position: relative;
    width: 100%;
    height: 120vh;          /* desktop hero height */
    overflow: hidden;
    background: #000;       /* fallback */
}

/* Video behaves like background-image: cover */
.bovet-hero-video{
    position: absolute;
    top: 50%;
    left: 50%;
    width: 100%;
    height: 100%;
    object-fit: cover;      /* 🔥 MOST IMPORTANT LINE */
    transform: translate(-50%, -50%);
}

/* Optional: reduce height on smaller screens */
@media (max-width: 991px){
    .bovet-hero{
        height: 85vh;
    }
}

/* Very small phones */
@media (max-width: 360px){
    .bovet-hero{ height: 62vh; }
}

/* Tablets */
@media (min-width: 576px) and (max-width: 991px){
    .bovet-hero{ height: 80vh; }
}

/* Desktop */
@media (min-width: 992px){
    .bovet-hero{ height: 120vh; }
}

.bovet-hero__media{
    width:100%;
    height:100%;
    object-fit:cover;
    display:block;
    background:#fff;
}

.bovet-hero__fallback{
    width:100%;
    height:100%;
    background-size:cover;
    background-position:center;
    background-repeat:no-repeat;
    display:block;
    background-color:#fff;
}

/* ===============================
   FILTER BAR (no absolute hacks)
================================ */
.bovet-filterbar{
    display:grid;
    grid-template-columns: 1fr auto 1fr;   /* left space | logo | button */
    align-items:center;
    padding:12px 14px;
    background:#fff;
}

.bovet-filterbar__left{ justify-self:start; }
.bovet-filterbar__center{ justify-self:center; }
.bovet-filterbar__right{ justify-self:end; }

.bovet-brand-logo{
    margin-top: -35px;
    width:clamp(120px, 32vw, 190px);
    height:auto;
    display:block;
}

/* Button (no borders) */
.bovet-filterbar__btn{
    border:none !important;
    outline:none !important;
    box-shadow:none !important;
    background:transparent !important;
    padding:6px 8px;
    font-size:12px;
    display:flex;
    align-items:center;
    gap:6px;
    white-space:nowrap;
}

.bovet-filterbar__btn:focus,
.bovet-filterbar__btn:hover,
.bovet-filterbar__btn:active{
    border:none !important;
    outline:none !important;
    box-shadow:none !important;
    background:transparent !important;
}

/* Hamburger icon same */
.bovet-filterbar__btn .navbar-toggler-icon{
    width:18px;
    height:14px;
    background:none;
    display:inline-block;
    background-image:url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 20'%3e%3crect x='0' y='0' width='30' height='2' fill='%23333'/%3e%3crect x='0' y='9' width='30' height='2' fill='%23333'/%3e%3crect x='0' y='18' width='30' height='2' fill='%23333'/%3e%3c/svg%3e");
    background-size:100% 100%;
    background-repeat:no-repeat;
}
.bovet-banner{
    background:#fff;
    width:100%;
}

/* TEXT FULL WIDTH WITH CLEAN PADDING */
.bovet-text{
    padding: 25px 40px 15px 10px; /* left & right spacing */
}

.bovet-title{
    font-family: "Georgia", serif;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: .04em;
    font-size: 24px;
    margin-bottom: 12px;
    color:#111;
}

.bovet-desc{
    font-size: 15px;
    line-height: 1.89;
    max-width: 1100px;
    color:#111;
}

/* EDGE TO EDGE IMAGE */
.bovet-img-frame{
    width:100%;
    border-top: 1px solid #ddd;
    border-bottom: 1px solid #ddd;
    overflow:hidden;
}

.bovet-img{
    width:100%;
    height:450px;
    object-fit:cover;
    display:block;
}

/* Responsive */
@media (max-width:768px){
    .bovet-text{
        padding:20px;
    }

    .bovet-title{
        font-size:18px;
    }

    .bovet-img{
        height:280px;
    }
}
</style>

        {{-- =======================
            FILTER BAR (NEW)
        ======================== --}}
      <div class="navbar navbar-white bovet-filterbar">
    <div class="bovet-filterbar__left"></div>

    <div class="bovet-filterbar__center">
        <img src="{{ asset('assets/f_assets/image/watch logo/Bovet.png') }}"
             class="bovet-brand-logo" alt="Bovet">
    </div>

    <div class="bovet-filterbar__right">
        <button class="navbar-toggler bovet-filterbar__btn" type="button"
                data-bs-toggle="offcanvas" data-bs-target="#offcanvasBovet"style="display:none;">
            <span class="navbar-toggler-icon"></span> SORT & FILTER
        </button>
    </div>
</div>
<section class="bovet-banner">

    <!-- TEXT SECTION -->
    <div class="bovet-text">
        <h2 class="bovet-title">ELEVATING THE ART OF TIMEPIECES</h2>

        <p class="bovet-desc">
            For more than 200 years, BOVET 1822 has pursued horological excellence,
            creating extraordinary timepieces that unite heritage, precision, and artistry.
            Each masterpiece is designed for collectors who appreciate time not just as a measure,
            but as a true luxury.
        </p>
    </div>

    <!-- FULL WIDTH BANNER -->
    <div class="bovet-img-frame">
        <img src="{{ asset('assets/f_assets/image/watches/bovet_new.jpg') }}"
         class="img-fluid w-100"
         alt="Cuervo y Sobrinos Banner">
    </div>

</section>

<section class="hanif-bovet-wrap">
  <div class="container hanif-bovet-container">

    <!-- TOP LINE -->
    <div class="hanif-bovet-top">
      HANIF × BOVET | THE RECITAL 30, 'KARACHI' PAKISTAN LIMITED EDITION
    </div>

    <!-- 2 COLUMN ROW -->
    <div class="row align-items-start gy-4 hanif-bovet-row">

      <!-- LEFT IMAGE -->
      <div class="col-12 col-md-5">
        <div class="hanif-bovet-img-frame">
          <img src="{{ asset('assets/f_assets/image/watches mobile view/bovet_st.jpg') }}"
               class="img-fluid w-100"
               alt="BOVET Recital 30 Karachi">
        </div>
      </div>

      <!-- RIGHT TEXT -->
      <div class="col-12 col-md-7">
        <div class="hanif-bovet-text">

          <!-- FIRST PARAGRAPH (Always Visible) -->
          <p>
           The Récital 30 focuses on the innovative roller system from the award winning Récital 28, allowing world travelers to accurately display 25 global time zones across the four periods of the year. The Récital 30 is one of only two world timepieces, both from BOVET, that are able to adapt to Daylight Saving Time. The Récital 30 emphasizes the essentials needed for keeping track of world time. The world time rollers cover nearly the entire dial, making it the clear focus of this timepiece for tracking world time. As a result, the Récital 30 is the perfect companion for world travelers. This special edition of the Récital 30 holds particular significance for the House of HANIF.



          </p>

          <!-- SECOND PARAGRAPH (Hidden on Mobile Initially) -->
          <div class="mobile-extra-text">
            <p>
             The roller representing the country’s time zone is specifically labeled "Karachi”. The two green arrows accompany the designation, subtly highlighting the region while reflecting the colors closely associated with Pakistan. With its vertically integrated manufacturing capabilities, BOVET possesses the rare ability to create highly personalized timepieces for distinguished collectors and partners around the world.
            </p>
          </div>

          <!-- MOBILE BUTTON -->
          <span class="mobile-toggle-btn">See More</span>

        </div>
      </div>

    </div>

    <!-- BOTTOM LINE -->
    <div class="hanif-bovet-bottom">
     The Récital 30 "Karachi” stands as a refined expression of this craftsmanship, demonstrating the Maison’s commitment to precision engineering, bespoke watchmaking, and the creation of exceptional horological masterpieces.
    </div>

    <!-- CTA -->
    <div class="hanif-bovet-cta">
<x-book-appointment href="javascript:void(0);" id="bookAppointmentBtn" />
    </div>

  </div>
</section>
    <script>
document.getElementById('bookAppointmentBtn').addEventListener('click', function (e) {
    e.preventDefault();

    const phoneNumber = @json('923070222666');

    const message = "Hello Hanif Jewellers, I would like to book an appointment for HANIF × BOVET | THE RECITAL 30, 'KARACHI' PAKISTAN LIMITED EDITION";

    const whatsappUrl = `https://api.whatsapp.com/send?phone=${phoneNumber}&text=${encodeURIComponent(message)}`;

    window.open(whatsappUrl, '_blank');
});
</script>



<style>
.hanif-bovet-wrap{
  background:#fff;
  padding:18px 0 22px;
}

.hanif-bovet-container{
  max-width:980px;
}

.hanif-bovet-top{
  text-align:center;
  font-size:15px;
  letter-spacing:.08em;
  text-transform:uppercase;
  font-weight:600;
  color:#111;
  margin-bottom:14px;
}

.hanif-bovet-img-frame{
  width:100%;
  border:1px solid #e1e1e1;
  background:#f5f0e6;
  overflow:hidden;
}

.hanif-bovet-text{
  font-size:15px;
  line-height:1.89;
  color:#111;
  padding-left:10px;
}

.hanif-bovet-text p{
  margin-bottom:14px;
}

.hanif-bovet-bottom{
  font-size:15px;
  line-height:1.89;
  color:#111;
  margin-top:14px;
  padding:0 6px;
}

.hanif-bovet-cta{
  text-align:center;
  margin-top:14px;
}

.hanif-bovet-btn{
  display:inline-block;
  font-size:14px;
  letter-spacing:.12em;
  text-transform:uppercase;
  font-weight:700;
  color:#111;
  text-decoration:none;
  padding:8px 10px;
}

.hanif-bovet-btn:hover{
  text-decoration:underline;
}

/* Hide toggle on desktop */
.mobile-toggle-btn{
  display:none;
}

/* Mobile Only */
@media (max-width:768px){

  .hanif-bovet-text{
    padding-left:0;
  }

  .mobile-extra-text{
    display:none;
  }

  .mobile-extra-text.active{
    display:block;
  }

  .mobile-toggle-btn{
    display:inline-block;
    font-size:14px;
    font-weight:600;
    margin-top:5px;
    cursor:pointer;
    text-decoration:underline;
  }
}
</style>


<script>
document.addEventListener("DOMContentLoaded", function () {

  const toggleBtn = document.querySelector(".mobile-toggle-btn");
  const extraText = document.querySelector(".mobile-extra-text");

  if(toggleBtn){
    toggleBtn.addEventListener("click", function(){

      extraText.classList.toggle("active");

      if(extraText.classList.contains("active")){
        toggleBtn.textContent = "See Less";
      } else {
        toggleBtn.textContent = "See More";
      }

    });
  }

});
</script>

  <div class="bovet-filterbar__right">
        <button class="navbar-toggler bovet-filterbar__btn" type="button"
                data-bs-toggle="offcanvas" data-bs-target="#offcanvasBovet">
            <span class="navbar-toggler-icon"></span> SORT & FILTER
        </button>
    </div>

        {{-- =======================
            PRODUCTS GRID
        ======================== --}}
       
  <div class="container-fluid px-3">
    <div class="row onlineStore g-2 pt-3" id="bovetGrid">
        @if(isset($products) && $products->count())
            @foreach($products as $prod)
                <div class="col-6 col-lg-3">
                    @include('public.partials.product-card-watches', ['product' => $prod])
                </div>
            @endforeach
        @else
            <div class="col-12">
                <div class="text-center py-5 text-muted">Collection to be Revealed Soon!</div>
            </div>
        @endif
    </div>
</div>


        {{-- =======================
            FOOTER: COUNTER + LOAD MORE
        ======================== --}}
        <div class="text-center py-4 bovet-footer">
            @if(isset($products) && $products->count() > 0)
                @php
                    $totalShown = $currentPageProducts;
                    $hasMorePages = $products->currentPage() < $products->lastPage();
                @endphp

                @if($totalFilteredProducts > 0)
                    <div class="products-counter"
                         data-total="{{ $totalFilteredProducts }}"
                         data-current="{{ $currentPageProducts }}"
                         data-per-page="{{ $products->perPage() }}"
                         data-current-page="{{ $products->currentPage() }}">
                        SHOWING {{ $currentPageProducts }} OF {{ $totalFilteredProducts }} PRODUCTS
                    </div>
                @endif

                @php
                    $allProductsShown = $totalShown >= $totalFilteredProducts;
                    $shouldShowLoadMore = $hasMorePages && !$allProductsShown;
                @endphp

                @if($shouldShowLoadMore)
                    <button id="loadMoreBtn"
                            style="background:#e3e4e5;border:none;color:#222;font-size:0.8rem;letter-spacing:0.15em;padding:0.8rem 2rem;border-radius:8px;font-family:inherit;font-weight:400;box-shadow:none;transition:background 0.2s;"
                            data-page="{{ $products->currentPage() + 1 }}"
                            data-last-page="{{ $products->lastPage() }}"
                            data-per-page="{{ $products->perPage() }}"
                            data-total="{{ $totalFilteredProducts }}">
                        LOAD MORE
                    </button>
                @endif
            @endif
        </div>
    </section>

    {{-- =======================
        OFFCANVAS SORT/FILTER
    ======================== --}}
    <div class="offcanvas offcanvas-end offcanvas-modern"
         tabindex="-1"
         id="offcanvasBovet"
         aria-labelledby="offcanvasBovetLabel"
         data-bs-backdrop="false"
         data-bs-scroll="true">
        <div class="offcanvas-header">
            <span class="offcanvas-title" id="offcanvasBovetLabel">SORT & FILTER</span>
            <button type="button" class="btn-close btn-close-black" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>

        <div class="offcanvas-body">
            <div>
                <div class="filter-section-title" onclick="toggleCategory('bovetSortList', this.querySelector('.category-toggle'))" style="font-size:14px !important;">
                    Sort By <span class="category-toggle">+</span>
                </div>

                <ul class="sort-list" id="bovetSortList">
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
                <div class="filter-section-title" onclick="toggleCategory('bovetGenderList', this.querySelector('.category-toggle'))" style="font-size:14px !important;">
                    Gender <span class="category-toggle">+</span>
                </div>

                <ul class="category-list collapsible" id="bovetGenderList">
                    @php $selectedTags = collect(explode(',', request('tags', '')))->map(fn($s)=>trim($s)); @endphp
                    <li>
                        <input type="checkbox" class="form-check-input filter-tag-checkbox bovet-filter" data-group="gender" value="mens"
                               {{ $selectedTags->contains('mens') ? 'checked' : '' }} onclick="event.stopPropagation();">
                        <span class="subcat-label">Men's</span>
                    </li>
                    <li>
                        <input type="checkbox" class="form-check-input filter-tag-checkbox bovet-filter" data-group="gender" value="ladies"
                               {{ $selectedTags->contains('ladies') ? 'checked' : '' }} onclick="event.stopPropagation();">
                        <span class="subcat-label">Ladies</span>
                    </li>
                </ul>
            </div>

            <div class="mt-3">
                <div class="filter-section-title" onclick="toggleCategory('bovetSeriesList', this.querySelector('.category-toggle'))" style="font-size:14px !important;">
                    Series <span class="category-toggle">+</span>
                </div>

                <ul class="category-list collapsible" id="bovetSeriesList">
                    @php $series = ['fleurier','dimier','recital','amadeo','miss-audrey','the-art-of-miniature-painting','monsieur']; @endphp
                    @foreach($series as $s)
                        <li>
                            <input type="checkbox" class="form-check-input filter-tag-checkbox bovet-filter" data-group="series" value="{{ $s }}"
                                   {{ $selectedTags->contains($s) ? 'checked' : '' }} onclick="event.stopPropagation();">
                            <span class="subcat-label">{{ ucwords(str_replace(['-', 'the-art-of-'], [' ', 'The Art of '], $s)) }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>

            <div class="mt-3">
                <div class="filter-section-title" onclick="toggleCategory('bovetSizeList', this.querySelector('.category-toggle'))" style="font-size:14px !important;">
                    Case Size <span class="category-toggle">+</span>
                </div>

                <ul class="category-list collapsible" id="bovetSizeList">
                    @php $sizes = ['36','40','42','43','43.30','44','44.00','45','46.30','48.30']; @endphp
                    @foreach($sizes as $sz)
                        <li>
                            <input type="checkbox" class="form-check-input filter-tag-checkbox bovet-filter" data-group="size" value="{{ $sz }}"
                                   {{ $selectedTags->contains($sz) ? 'checked' : '' }} onclick="event.stopPropagation();">
                            <span class="subcat-label">{{ $sz }}mm</span>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>

    {{-- =======================
        SCRIPTS (UNCHANGED)
    ======================== --}}
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
            function buildUrl() {
                const url = new URL(window.location.href);
                url.searchParams.delete('tags');
                url.searchParams.delete('gender');
                url.searchParams.delete('series');
                url.searchParams.delete('size');

                const selected = Array.from(document.querySelectorAll('.bovet-filter:checked')).map(i=>i.value);
                if (selected.length) url.searchParams.set('tags', selected.join(','));
                else url.searchParams.delete('tags');

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

                        const incomingGrid = doc.querySelector('#bovetGrid');
                        const grid = document.querySelector('#bovetGrid');
                        if (incomingGrid && grid) grid.innerHTML = incomingGrid.innerHTML;

                        const incomingFooter = doc.querySelector('.bovet-footer');
                        const footer = document.querySelector('.bovet-footer');
                        if (footer) {
                            footer.innerHTML = incomingFooter ? incomingFooter.innerHTML : '';
                            if (typeof window.bindLoadMore === 'function') window.bindLoadMore();
                            if (typeof window.updateCounter === 'function') window.updateCounter();
                        }
                    })
                    .catch(()=>{});
            }

            // Sort handlers
            (function(){
                const sortList = document.getElementById('bovetSortList');
                if (!sortList) return;
                sortList.querySelectorAll('li').forEach(li => {
                    li.addEventListener('click', function(){
                        sortList.querySelectorAll('li').forEach(x => {
                            x.classList.remove('selected');
                            const d=x.querySelector('.diamond');
                            if(d) d.textContent='◇';
                        });
                        this.classList.add('selected');
                        const d=this.querySelector('.diamond');
                        if(d) d.textContent='◆';

                        const url = buildUrl();
                        const val = this.getAttribute('data-value') || '';
                        if (val) url.searchParams.set('sort', val);
                        else url.searchParams.delete('sort');

                        fetchAndRender(url);
                    });
                });
            })();

            // Checkbox immediate apply
            document.querySelectorAll('.bovet-filter').forEach(cb => {
                cb.addEventListener('click', function(e){
                    e.stopPropagation();
                    const url = buildUrl();
                    fetchAndRender(url);
                });
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
                    return container.querySelector('#bovetGrid');
                }

                function appendIncomingItems(doc) {
                    const currentGrid = getGrid(document);
                    if (!currentGrid) return 0;

                    let nodesToAppend = [];
                    const incomingGrid = getGrid(doc) || doc.querySelector('#bovetGrid');
                    if (incomingGrid) {
                        nodesToAppend = Array.from(incomingGrid.children);
                    } else {
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

                    const totalShown = grid.querySelectorAll('.card.addToCartProductDetailsTop').length;
                    const counter = document.querySelector('.bovet-footer .products-counter');

                    if (counter) {
                        const total = parseInt(counter.getAttribute('data-total') || '0', 10);

                        counter.setAttribute('data-current', totalShown);

                        if (total > 0) {
                            counter.textContent = `SHOWING ${totalShown} OF ${total} PRODUCTS`;
                            counter.style.display = 'block';
                        } else {
                            counter.style.display = 'none';
                        }

                        const loadMoreBtn2 = document.getElementById('loadMoreBtn');
                        if (loadMoreBtn2) {
                            const currentPage = parseInt(loadMoreBtn2.getAttribute('data-page') || '2', 10);
                            const lastPage = parseInt(loadMoreBtn2.getAttribute('data-last-page') || '2', 10);
                            const totalFromBtn = parseInt(loadMoreBtn2.getAttribute('data-total') || total, 10);

                            if (totalShown >= totalFromBtn || currentPage > lastPage) {
                                loadMoreBtn2.style.display = 'none';
                            } else {
                                loadMoreBtn2.style.display = 'inline-block';
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

                    const url = new URL(window.location.href);
                    url.searchParams.set('page', String(nextPage));

                    fetch(url.toString(), { headers: { 'X-Requested-With': 'XMLHttpRequest' }, cache: 'no-cache' })
                        .then(response => response.text())
                        .then(html => {
                            const parser = new DOMParser();
                            const doc = parser.parseFromString(html, 'text/html');

                            let appended = appendIncomingItems(doc);
                            window.updateCounter();

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

                            if (appended === 0) {
                                const currentGrid = document.querySelector('#bovetGrid');
                                const incomingGrid2 = doc.querySelector('#bovetGrid');
                                if (currentGrid && incomingGrid2) {
                                    currentGrid.insertAdjacentHTML('beforeend', incomingGrid2.innerHTML);
                                    appended = incomingGrid2.children.length;
                                    window.updateCounter();
                                }
                            }

                            const currentTotal = parseInt(btn.getAttribute('data-total') || total, 10);
                            const currentGrid = document.querySelector('#bovetGrid');
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

                            try { window.scrollBy({ top: 200, left: 0, behavior: 'smooth' }); } catch (_) {}
                        })
                        .catch(() => {
                            btn.disabled = false;
                            btn.textContent = 'LOAD MORE';
                            try {
                                const url = new URL(window.location.href);
                                const nextPage2 = parseInt(btn.getAttribute('data-page') || '2', 10);
                                url.searchParams.set('page', String(nextPage2));
                                window.location.href = url.toString();
                            } catch (_) {}
                        });
                });
            };

            window.bindLoadMore();
            window.updateCounter();
        });
    </script>
@endsection
