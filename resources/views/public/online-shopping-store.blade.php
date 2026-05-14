@extends('public.layouts.header_latest')

@section('content')
<style>
    /* =========================
   Banner Container
========================= */
.custom-banner{
    position: relative;
    width: 100%;
    height: 130vh;
    overflow: hidden;
    margin-top: -10rem;
}

/* Video Background */
.custom-banner-video{
    position: absolute;
    inset: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
    z-index: 0;
}

/* Image Background */
.custom-banner-image{
    position: absolute;
    inset: 0;
    width: 100%;
    height: 100%;
    background-position: center;
    background-size: cover;
    background-repeat: no-repeat;
    z-index: 0;
}
                /* =========================
   Overlay Content (Haphazard + Discover + Location)
   Button starts from the "H" of Haphazard (left aligned)
========================= */
.banner-content {
    position: absolute;
    right: 10%;   /* try 10%–20% */
    top: 63%;
    transform: translateY(-50%);
    z-index: 5;
    max-width: 500px;
    color: #fff;
    text-align: left;
}


.banner-location{
    font-size: 12px;
    letter-spacing: 2px;
    text-transform: uppercase;
    opacity: 0.85;
    margin-bottom: 21px;
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
    font-family: 'Montserrat';
    color:#FFD59A;


}

.banner-title{
    font-family: 'Cinzel Decorative';
    font-size: 38px;
    font-weight: 400;
    letter-spacing: 6px;
    margin: 0;
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
    white-space: nowrap; 
}
/* Responsive tweaks */
@media (max-width: 991px){
    .banner-content{ right: 6%; }
    .banner-title{ font-size: 36px; }
}
@media (min-width: 1600px) {
    .banner-content {
        top: 58%;
        right:8%;
    }
     .banner-title{ font-size: 46px; }
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
.mobileStackHero{
    position: relative;
    width: 100%;
    overflow: hidden;
}

.mobileStackImgWrap{
    width:100%;
}

.mobileStackVideo{
    width:100%;
    height:auto;
    display:block;
}

/* TEXT OVERLAY */
.mobileStackContent{
    position:absolute;
    bottom:10%;
    left:50%;
    transform:translateX(-50%);
    text-align:center;
    color:#fff;
    z-index:2;
    padding:0 20px;
    width:100%;
}

.mobileTitle{
      font-family: 'Cinzel Decorative';
    font-size: 34px;
    font-weight: 400;
    letter-spacing: 6px;
    margin: 0;
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
    white-space: nowrap; 
}

.mobileSub{
    font-size:14px;
    letter-spacing:2px;
    margin-bottom:6px;
}

.mobileText{
    font-size: 12px;
    letter-spacing: 2px;
    text-transform: uppercase;
    opacity: 0.85;
    margin-bottom: 21px;
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
    font-family: 'Montserrat';
    color:#FFD59A;
}


</style>
<section class="custom-banner d-none d-lg-block position-relative">
        <video autoplay loop muted playsinline class="custom-banner-video">
            <source src="{{ asset('assets/f_assets/image/online shopping store/desktop.mp4') }}" type="video/mp4">
            Your browser does not support the video tag.
        </video>
          {{-- Overlay Content --}}
    <div class="banner-content">
        <div class="banner-title">Shop Online</div>
        <div class="banner-location">Discover More Creation</div>
         <!-- <a href="{{ url('collections/haphazard') }}" class="banner-btn">Discover</a> -->
    </div>
</section>
<section class="d-lg-none mobileStackHero">

  <div class="mobileStackImgWrap">
    <video class="mobileStackVideo" autoplay muted loop playsinline preload="metadata">
      <source src="{{ asset('assets/f_assets/image/online shopping store/mobile.mp4') }}" type="video/mp4">
    </video>
  </div>

  <div class="mobileStackContent">
      <h2 class="mobileTitle">Shop Online</h2>
      <!-- <p class="mobileSub">Magnetic, ever-evolving, eternal.</p>  -->
      <p class="mobileText">
        Discover More Creation
      </p>
  </div>

</section>
    <section>
        <div class="py-5">
            <style>
/* ================================
   PROMO ROW - FIXED (NO GAP ON iPAD)
   ================================ */
/* Default: AUTO height for mobile + tablet */
.os-promo-section { height: auto !important; min-height: unset !important; }
.os-promo-row { height: auto !important; }
.os-promo-col { height: auto !important; display: flex; min-height: 0; }

/* Banner always visible */
.os-promo-tile { width: 100%; overflow: hidden; }
.os-promo-tile a { display: block; width: 100%; }

/* IMPORTANT: give banner a minimum height on tablet so it never collapses */
.os-promo-tile img { width: 100%; height: auto; display: block; object-fit: cover; }
@media (max-width: 1199.98px){
  .os-promo-tile img{ min-height: 220px; }  /* adjust if you want taller */
}

/* Right side grid AUTO on tablet */
.os-right-grid {
  width: 100%;
  height: auto !important;
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: .5rem;
}

/* STOP forcing 100% height on tablet */
.os-right-grid .os-product-cell,
.os-right-grid .os-product-cell .addToCartProductDetailsTop,
.os-right-grid .addToCartProductDetailsTop .card-img,
.os-right-grid .addToCartProductDetailsTop .carousel,
.os-right-grid .addToCartProductDetailsTop .carousel-inner,
.os-right-grid .addToCartProductDetailsTop .carousel-item {
  height: auto !important;
}

/* Desktop ONLY (>=1200px): fixed height layout */
@media (min-width: 1200px){
  .os-promo-section { height: 70vh !important; min-height: 500px !important; }
  .os-promo-row { height: 100% !important; }
  .os-promo-col { height: 100% !important; }

  .os-promo-tile { height: 100% !important; }
  .os-promo-tile a { height: 100% !important; }
  .os-promo-tile img { height: 100% !important; object-fit: cover !important; }

  .os-right-grid { height: 100% !important; }

  .os-right-grid .os-product-cell { height: 100% !important; }
  .os-right-grid .os-product-cell .addToCartProductDetailsTop {
    height: 100% !important;
    display:flex !important;
    flex-direction:column !important;
  }
  .os-right-grid .addToCartProductDetailsTop .card-img { flex: 1 1 auto !important; }
  .os-right-grid .addToCartProductDetailsTop .carousel,
  .os-right-grid .addToCartProductDetailsTop .carousel-inner,
  .os-right-grid .addToCartProductDetailsTop .carousel-item { height: 100% !important; }
  .os-right-grid .addToCartProductDetailsTop .card-img img {
    width:100% !important;
    height:100% !important;
    object-fit:cover !important;
  }
}
/* Promo columns behave correctly */
.os-promo-col { display: flex; }
.os-promo-col > * { width: 100%; }

/* On xl desktop only, allow equal-height layout if you want */
@media (min-width: 1200px) {
  .os-promo-row { align-items: stretch; }
  .os-promo-tile, .os-promo-tile a, .os-promo-tile img { height: 100%; }
  .os-promo-tile img { object-fit: cover; }
}





    
            
                /* Mobile Video Section Responsive Styles */
                .mobile-video-section {
                    min-height: 100vh !important;
                    max-height: 120vh !important;
                }
                
                /* Responsive text sizing for different mobile devices */
                @media (max-width: 480px) {
                    .mobile-video-title {
                        font-size: 1.5rem !important;
                        margin-bottom: 0.8rem !important;
                    }
                    .mobile-video-subtitle {
                        font-size: 0.9rem !important;
                        margin-bottom: 1.2rem !important;
                    }
                    .mobile-video-cta {
                        padding: 0.7rem 1.5rem !important;
                        font-size: 0.8rem !important;
                    }
                    .mobile-video-content {
                        padding: 1.2rem !important;
                    }
                }
                
                @media (max-width: 375px) {
                    .mobile-video-title {
                        font-size: 1.3rem !important;
                    }
                    .mobile-video-subtitle {
                        font-size: 0.85rem !important;
                    }
                    .mobile-video-cta {
                        padding: 0.6rem 1.2rem !important;
                        font-size: 0.75rem !important;
                    }
                }
                
                @media (max-width: 320px) {
                    .mobile-video-title {
                        font-size: 1.2rem !important;
                    }
                    .mobile-video-subtitle {
                        font-size: 0.8rem !important;
                    }
                    .mobile-video-content {
                        padding: 1rem !important;
                    }
                }
                
                /* Landscape orientation adjustments */
                @media (max-height: 500px) and (orientation: landscape) {
                    .mobile-video-section {
                        min-height: 100vh !important;
                        max-height: 100vh !important;
                    }
                    .mobile-video-overlay {
                        padding: 1rem 0.5rem !important;
                    }
                    .mobile-video-content {
                        padding: 1rem !important;
                    }
                    .mobile-video-title {
                        font-size: 1.3rem !important;
                        margin-bottom: 0.5rem !important;
                    }
                    .mobile-video-subtitle {
                        font-size: 0.85rem !important;
                        margin-bottom: 0.8rem !important;
                    }
                    .mobile-video-cta {
                        padding: 0.5rem 1rem !important;
                        font-size: 0.75rem !important;
                    }
                }
                
                /* Ensure text is always visible */
                .mobile-video-overlay {
                    background: linear-gradient(135deg, rgba(0,0,0,0.2) 0%, rgba(0,0,0,0.4) 100%);
                }
                
                /* Additional mobile optimizations */
                @media (max-width: 768px) {
                    .mobile-video-section {
                        position: relative;
                        width: 100%;
                        height: 100vh;
                        min-height: 100vh;
                        max-height: 120vh;
                    }
                    
                    .mobile-video-section video {
                        width: 100% !important;
                        height: 100% !important;
                        object-fit: cover !important;
                    }
                    
                    .mobile-video-overlay {
                        position: absolute !important;
                        top: 0 !important;
                        left: 0 !important;
                        width: 100% !important;
                        height: 100% !important;
                        z-index: 1 !important;
                    }
                }
                
                /* Very small screens (iPhone SE, etc.) */
                @media (max-width: 360px) {
                    .mobile-video-title {
                        font-size: 1.1rem !important;
                        line-height: 1.1 !important;
                    }
                    .mobile-video-subtitle {
                        font-size: 0.75rem !important;
                        line-height: 1.2 !important;
                    }
                    .mobile-video-cta {
                        padding: 0.5rem 1rem !important;
                        font-size: 0.7rem !important;
                    }
                    .mobile-video-content {
                        padding: 0.8rem !important;
                        margin: 0 0.5rem !important;
                    }
                }
                
                .mobile-video-cta:hover {
                    background: rgba(255, 255, 255, 1) !important;
                    transform: translateY(-2px);
                    box-shadow: 0 4px 8px rgba(0,0,0,0.3);
                }
                
                /* Smaller SORT & FILTER toggle */
                .filter .navbar-toggler {
                    font-size: 16px;
                    padding: 4px 10px;
                    line-height: 1.1;
                    border: none !important;
                    border-radius: 4px;
                    outline: none !important;
                    box-shadow: none !important;
                }
                .filter .navbar-toggler:focus,
                .filter .navbar-toggler:hover,
                .filter .navbar-toggler:active {
                    border: none !important;
                    outline: none !important;
                    box-shadow: none !important;
                }
                /* Make image area fully clickable */
                .card .card-img a { display: block; }
                .card .card-img img { width: 100%; height: auto; }
                /* Allow click-through on overlays like "New" */
                .card .card-img-overlay { pointer-events: none; }
                /* Promo tile sizing */
                .promo-tile { display: flex; height: 100%; }
                .promo-tile > a { flex: 1 1 auto; display: block; height: 100%; }
                .promo-tile img { height: 100%; width: 100%; object-fit: cover; display: block; }
            </style>

            {{-- filter --}}

            <style>
                .offcanvas-modern {
                    font-family: 'Inter', Arial, sans-serif;
                    background: rgb(255, 255, 255) !important;
                    color: #222;
                    min-width: 320px;
                    max-width: 380px;
                }
                
                /* Mobile full width offcanvas */
                @media (max-width: 767px) {
                    .offcanvas-modern {
                        min-width: 100% !important;
                        max-width: 100% !important;
                        width: 100% !important;
                    }
                }
                .offcanvas-modern .offcanvas-header {
                    border-bottom: 1px solid rgb(255, 255, 255);
                    padding-bottom: 0.5rem;
                    background: rgb(255, 255, 255);
                }
                .offcanvas-modern .offcanvas-title {
                    font-size: 1.1rem;
                    font-weight: 400;
                    letter-spacing: 0.02em;
                    text-transform: uppercase;
                    color: #222;
                }
                .offcanvas-modern .btn-close {
                    filter: none;
                    opacity: 1;
                    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%23000'%3e%3cpath d='M.293.293a1 1 0 0 1 1.414 0L8 6.586 14.293.293a1 1 0 1 1 1.414 1.414L9.414 8l6.293 6.293a1 1 0 0 1-1.414 1.414L8 9.414l-6.293 6.293a1 1 0 0 1-1.414-1.414L6.586 8 .293 1.707a1 1 0 0 1 0-1.414z'/%3e%3c/svg%3e");
                    background-size: 1em;
                    width: 1em;
                    height: 1em;
                    cursor: pointer;
                    transition: opacity 0.2s;
                }
                .offcanvas-modern .btn-close:hover {
                    opacity: 0.7;
                }
                .filter-section-title {
                    font-size: 0.98rem;
                    font-weight: 300;
                    letter-spacing: 0.01em;
                    margin-bottom: 0.8rem;
                    margin-top: 1.5rem;
                    text-transform: uppercase;
                    color: #222;
                    display: flex;
                    align-items: center;
                    justify-content: space-between;
                    border-bottom: 1px solid #ecebe7;
                    padding-bottom: 0.5rem;
                    cursor: pointer;
                }
                .sort-list, .category-list, .subcategory-list {
                    list-style: none;
                    padding-left: 0;
                    margin-bottom: 0;
                }
                .sort-list {
                    max-height: 0;
                    overflow: hidden;
                    transition: max-height 0.3s ease-out;
                }
                .sort-list.show {
                    max-height: 300px;
                    transition: max-height 0.3s ease-in;
                }
                /* Collapsible lists for GOLD/DIAMONDS */
                .category-list.collapsible {
                    max-height: 1000px; /* open by default */
                    overflow: hidden;
                    transition: max-height 0.3s ease-out;
                }
                .category-list.collapsible:not(.show) {
                    max-height: 0;
                    transition: max-height 0.3s ease-in;
                }
                .sort-list li, .category-list > li {
                    padding: 0.4rem 0;
                    font-size: 0.97rem;
                    display: flex;
                    align-items: center;
                    cursor: pointer;

                    color: #222;
                }
                .sort-list li.selected {
                    font-weight: 600;
                    color: #111;
                }
                .sort-list li .diamond {
                    font-size: 0.7em;
                    margin-right: 0.7em;
                    color: #b2b2b2;
                }
                .sort-list li.selected .diamond {
                    color: #111;
                }
                .sort-list li:not(.selected) .diamond {
                    color: #b2b2b2;
                }
                .category-list > li {
                    display: flex;
                    align-items: flex-start;
                    color: #222;
                    flex-wrap: wrap;
                    cursor: pointer;
                }
                .category-list > li > span:first-child {
                    flex: 1;
                }
                .category-toggle {
                    font-size: 1.1em;
                    color: #b2b2b2;
                    cursor: pointer;
                    user-select: none;
                    display: inline-block;
                    width: 20px;
                    text-align: center;
                    margin-left: 10px;
                }
                .category-list .subcategory-list {
                    margin-top: 0.5rem;
                    margin-left: 0;
                    list-style: none;
                    padding-left: 0;
                    width: 100%;
                    flex-basis: 100%;
                    max-height: 0;
                    overflow: hidden;
                    transition: max-height 0.3s ease-out;
                }
                .category-list .subcategory-list.show {
                    max-height: 300px;
                    transition: max-height 0.3s ease-in;
                }
                .category-list .subcategory-list li {
                    font-weight: 400;
                    text-transform: none;
                    font-size: 0.96rem;
                    margin: 0.1rem 0;
                    padding: 0.2rem 0 0.2rem 0.5rem;
                    cursor: pointer;
                    color: #222;
                    display: flex;
                    align-items: center;
                }
                .filter-subcat-checkbox { margin-right: 8px; accent-color: #111; }
                .filter-subcat-checkbox:focus { box-shadow: none !important; outline: none !important; }
                .filter-subcat-checkbox:active { box-shadow: none !important; outline: none !important; }
                .filter-subcat-checkbox:hover { box-shadow: none !important; }
                /* Ensure black fill and border when checked (Bootstrap override) */
                .form-check-input.filter-subcat-checkbox:checked { background-color: #111; border-color: #111; }
                .form-check-input.filter-subcat-checkbox { border-color: #bbb; }
                /* Add a little gap between tag checkboxes and their labels */
                .filter-tag-checkbox { margin-right: 8px; }
                /* Make tag checkboxes shadow-free and black */
                .form-check-input.filter-tag-checkbox { accent-color: #111; border-color: #bbb; box-shadow: none !important; outline: none !important; }
                .form-check-input.filter-tag-checkbox:focus,
                .form-check-input.filter-tag-checkbox:active,
                .form-check-input.filter-tag-checkbox:hover { box-shadow: none !important; outline: none !important; }
                .form-check-input.filter-tag-checkbox:checked { background-color: #111; border-color: #111; }
                .category-list .subcategory-list li .subcat-label { margin-left: 2px; }
                .category-list .subcategory-list li .diamond {
                    margin-right: 0.7em;
                    font-size: 0.7em;
                    color: #b2b2b2;
                }
                .category-list .subcategory-list li.selected .diamond {
                    color: #111;
                }
                .offcanvas-modern hr {
                    border-color:rgb(255, 255, 255);
                    margin: 1.2rem 0 1rem 0;
                }
                .filter-actions {
                    position: sticky;
                    bottom: -16px;
                    background:rgb(255, 255, 255);
                    padding: 12px 0 0 0;
                }
                .filter-actions-inner {
                    border-top: 1px solid rgb(255, 255, 255);
                    padding-top: 12px;
                    display: flex;
                    gap: 10px;
                }
                .filter-actions .btn {
                    border-radius: 10px;
                    font-size: 13px;
                    padding: 8px 14px;
                }
                .offcanvas-modern .offcanvas-body {
                    background: rgb(255, 255, 255);
                    padding: 1rem;
                }
                .my-3 {
                    margin-top: 1.5rem !important;
                    margin-bottom: 1rem !important;
                }
</style>
            <div class="navbar navbar-white align-items-center filter position-relative justify-content-center">
                <button class="navbar-toggler border-0 text-black position-absolute end-0" type="button" data-bs-toggle="offcanvas"
                    data-bs-target="#offcanvasFilter" aria-controls="offcanvasFilter" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span> SORT & FILTER
                </button>
            </div>
            <div class="offcanvas offcanvas-end offcanvas-modern" tabindex="-1" id="offcanvasFilter"
                aria-labelledby="offcanvasFilterLabel" data-bs-backdrop="true" data-bs-scroll="false">
                <div class="offcanvas-header">
                    <span class="offcanvas-title" id="offcanvasFilterLabel">SORT & FILTER</span>
                    <button type="button" class="btn-close btn-close-black" data-bs-dismiss="offcanvas"
                        aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <form method="GET" action="{{ url('online-shopping-store') }}" id="filterForm">
                        <input type="hidden" name="use_defaults" value="0">
                        <input type="hidden" name="subcat_name" id="subcatInput" value="{{ request('subcat_name') }}">
                        <input type="hidden" name="cat_name" id="catInput" value="{{ request('cat_name') }}">
                        <input type="hidden" name="subcat_pairs" id="subcatPairsInput" value="{{ request('subcat_pairs') }}">
                        <input type="hidden" name="tags" id="tagsInput" value="{{ request('tags') }}">
                        <div>
                            <div class="filter-section-title" onclick="toggleCategory('sortList', this.querySelector('.category-toggle'))" style="font-size: 14px !important;">
                                Sort By
                                <span class="category-toggle">+</span>
                            </div>
                            <ul class="sort-list" id="sortList">
                                <li data-value="" class="{{ !request('sort') ? 'selected' : '' }}">
                                    <span class="diamond">◆</span> Best Selling
                                </li>
                                <li data-value="az" class="{{ request('sort')=='az' ? 'selected' : '' }}">
                                    <span class="diamond">◇</span> Alphabetically, A-Z
                                </li>
                                <li data-value="za" class="{{ request('sort')=='za' ? 'selected' : '' }}">
                                    <span class="diamond">◇</span> Alphabetically, Z-A
                                </li>
                                <li data-value="price_low_high" class="{{ request('sort')=='price_low_high' ? 'selected' : '' }}">
                                    <span class="diamond">◇</span> Price, low to high
                                </li>
                                <li data-value="price_high_low" class="{{ request('sort')=='price_high_low' ? 'selected' : '' }}">
                                    <span class="diamond">◇</span> Price, high to low
                                </li>
                                <li data-value="new_old" class="{{ request('sort')=='new_old' ? 'selected' : '' }}">
                                    <span class="diamond">◇</span> Date, new to old
                                </li>
                                <li data-value="old_new" class="{{ request('sort')=='old_new' ? 'selected' : '' }}">
                                    <span class="diamond">◇</span> Date, old to new
                                </li>
                            </ul>
                            <input type="hidden" name="sort" id="sortInput" value="{{ request('sort') }}">
                        </div>
                        <hr>
                        <hr>
                        <div>
                            <div class="filter-section-title" onclick="toggleCategory('tagListGold', this.querySelector('.category-toggle'))" style="font-size: 14px !important;">GOLD <span class="category-toggle">+</span></div>
                            <ul class="category-list collapsible" id="tagListGold">
                                <li>
    <input type="checkbox" class="form-check-input filter-tag-checkbox" value="mens_rings" onclick="event.stopPropagation();">
    <span class="subcat-label">Mens Rings</span>
</li>
                                <li><input type="checkbox" class="form-check-input filter-tag-checkbox" value="gold_rings" onclick="event.stopPropagation();"> <span class="subcat-label">Rings</span></li>
                                <li><input type="checkbox" class="form-check-input filter-tag-checkbox" value="gold_tops" onclick="event.stopPropagation();"> <span class="subcat-label">Tops</span></li>
                                <li><input type="checkbox" class="form-check-input filter-tag-checkbox" value="gold_chains" onclick="event.stopPropagation();"> <span class="subcat-label">Chains</span></li>
                                <li><input type="checkbox" class="form-check-input filter-tag-checkbox" value="gold_pendants" onclick="event.stopPropagation();"> <span class="subcat-label">Pendants</span></li>
                                <li><input type="checkbox" class="form-check-input filter-tag-checkbox" value="gold_bangles" onclick="event.stopPropagation();"> <span class="subcat-label">Bangles</span></li>
                                <li><input type="checkbox" class="form-check-input filter-tag-checkbox" value="gold_bracelets" onclick="event.stopPropagation();"> <span class="subcat-label">Bracelets</span></li>
                                <li><input type="checkbox" class="form-check-input filter-tag-checkbox" value="gold_earrings" onclick="event.stopPropagation();"> <span class="subcat-label">Earrings</span></li>
                            </ul>
                        </div>
                        <div class="mt-3">
                            <div class="filter-section-title" onclick="toggleCategory('tagListDiamonds', this.querySelector('.category-toggle'))" style="font-size: 14px !important;">DIAMONDS <span class="category-toggle">+</span></div>
                            <ul class="category-list collapsible" id="tagListDiamonds">
                                <li><input type="checkbox" class="form-check-input filter-tag-checkbox" value="diamond_rings" onclick="event.stopPropagation();"> <span class="subcat-label">Rings</span></li>
                                <li><input type="checkbox" class="form-check-input filter-tag-checkbox" value="diamond_pendants" onclick="event.stopPropagation();"> <span class="subcat-label">Pendants</span></li>
                                <li><input type="checkbox" class="form-check-input filter-tag-checkbox" value="diamond_earrings" onclick="event.stopPropagation();"> <span class="subcat-label">Earrings</span></li>
                                <li><input type="checkbox" class="form-check-input filter-tag-checkbox" value="diamond_bands" onclick="event.stopPropagation();"> <span class="subcat-label">Bands</span></li>
                            </ul>
                        </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <script>
                // Simple toggle function
                function toggleCategory(targetId, element) {
                    const target = document.getElementById(targetId);
                    if (target) {
                        const isExpanded = target.classList.contains('show');
                        if (isExpanded) {
                            // Collapse
                            target.classList.remove('show');
                            element.textContent = '+';
                        } else {
                            // Expand
                            target.classList.add('show');
                            element.textContent = '−';
                        }
                    }
                }
                
                // Close filter function
                function closeFilter() {
                    const offcanvas = document.getElementById('offcanvasFilter');
                    if (offcanvas) {
                        const bsOffcanvas = bootstrap.Offcanvas.getInstance(offcanvas);
                        if (bsOffcanvas) {
                            bsOffcanvas.hide();
                        }
                    }
                }
                
                // Sort selection and category toggles
                document.addEventListener('DOMContentLoaded', function() {
                    // Close button functionality
                    const closeBtn = document.querySelector('#offcanvasFilter .btn-close');
                    if (closeBtn) {
                        closeBtn.addEventListener('click', function(e) {
                            e.preventDefault();
                            closeFilter();
                        });
                    }
                    
                    // Close on escape key
                    document.addEventListener('keydown', function(e) {
                        if (e.key === 'Escape') {
                            closeFilter();
                        }
                    });
                    
                    // Sort selection (AJAX - no reload)
                    const sortList = document.getElementById('sortList');
                    const sortInput = document.getElementById('sortInput');
                    const filterForm = document.getElementById('filterForm');
                    if (sortList && sortInput && filterForm) {
                        function buildUrlForSort() {
                            const url = new URL(window.location.href);
                            // reset page
                            url.searchParams.set('page', '1');
                            // set sort
                            if (sortInput.value) {
                                url.searchParams.set('sort', sortInput.value);
                            } else {
                                url.searchParams.delete('sort');
                            }
                            // persist pairs
                            const pairsInput = document.getElementById('subcatPairsInput');
                            if (pairsInput && pairsInput.value) {
                                url.searchParams.set('subcat_pairs', pairsInput.value);
                            }
                            // ensure defaults flag if needed
                            const defaultsInput = filterForm.querySelector('input[name="use_defaults"]');
                            if (defaultsInput && defaultsInput.value === '0') {
                                url.searchParams.set('use_defaults', '0');
                            } else {
                                url.searchParams.delete('use_defaults');
                            }
                            return url;
                        }

                        function fetchAndRenderForSort() {
                            const url = buildUrlForSort();
                            window.history.pushState({}, '', url.toString());
                            fetch(url.toString(), { headers: { 'X-Requested-With': 'XMLHttpRequest' }})
                                .then(resp => resp.text())
                                .then(html => {
                                    const parser = new DOMParser();
                                    const doc = parser.parseFromString(html, 'text/html');
                                    const incomingGrid = doc.querySelector('.onlineStore');
                                    const grid = document.querySelector('.onlineStore');
                                    if (incomingGrid && grid) {
                                        grid.innerHTML = incomingGrid.innerHTML;
                                        if (typeof window.initProductCardCarousels === 'function') {
                                            window.initProductCardCarousels(grid);
                                        }
                                    }
                                    const incomingFooter = doc.querySelector('.text-center.py-4');
                                    const currentFooter = document.querySelector('.text-center.py-4');
                                    if (currentFooter) {
                                        if (incomingFooter) {
                                            currentFooter.innerHTML = incomingFooter.innerHTML;
                                        } else {
                                            currentFooter.remove();
                                        }
                                    } else if (incomingFooter && grid) {
                                        grid.parentElement.insertAdjacentHTML('beforeend', incomingFooter.outerHTML);
                                    }
                                    // Re-bind Load More on new footer
                                    if (typeof window.bindLoadMore === 'function') { window.bindLoadMore(); }
                                })
                                .catch(() => {});
                        }

                        sortList.querySelectorAll('li').forEach(li => {
                            li.addEventListener('click', function() {
                                // UI state
                                sortList.querySelectorAll('li').forEach(x => {
                                    x.classList.remove('selected');
                                    x.querySelector('.diamond').textContent = '◇';
                                });
                                this.classList.add('selected');
                                this.querySelector('.diamond').textContent = '◆';
                                sortInput.value = this.getAttribute('data-value');
                                // Fetch & render
                                fetchAndRenderForSort();
                            });
                        });
                    }
                    
                    // Checkbox multi-select handling (AJAX - no page reload)
                    (function() {
                        const checkboxes = document.querySelectorAll('.filter-subcat-checkbox');
                        const tagCheckboxes = document.querySelectorAll('.filter-tag-checkbox');
                        const pairsInput = document.getElementById('subcatPairsInput');
                        const tagsInput = document.getElementById('tagsInput');
                        const filterForm = document.getElementById('filterForm');
                        const defaultsInput = filterForm ? filterForm.querySelector('input[name="use_defaults"]') : null;
                        if (!filterForm) return;

                        function writeSelectionsToInputs() {
                            if (pairsInput) pairsInput.value = '';
                            const tagValues = [];
                            tagCheckboxes.forEach(cb => { if (cb.checked) tagValues.push(cb.value); });
                            if (tagsInput) tagsInput.value = tagValues.join(',');
                            // Clear single-select fields
                            const subcatInput = document.getElementById('subcatInput');
                            const catInput = document.getElementById('catInput');
                            if (subcatInput) subcatInput.value = '';
                            if (catInput) catInput.value = '';
                            if (defaultsInput) defaultsInput.value = (tagsInput && tagsInput.value) ? '0' : '1';
                        }

                        function buildUrlWithFormParams() {
                            const url = new URL(window.location.href);
                            // Reset to first page
                            url.searchParams.set('page', '1');
                            // Persist sort
                            const sortInput = document.getElementById('sortInput');
                            if (sortInput && sortInput.value) {
                                url.searchParams.set('sort', sortInput.value);
                            } else {
                                url.searchParams.delete('sort');
                            }
                            // Apply subcat_pairs
                            url.searchParams.delete('subcat_pairs');
                            // Apply tags
                            if (tagsInput && tagsInput.value) {
                                url.searchParams.set('tags', tagsInput.value);
                            } else {
                                url.searchParams.delete('tags');
                            }
                            // Ensure defaults flag
                            if (defaultsInput && defaultsInput.value === '0') {
                                url.searchParams.set('use_defaults', '0');
                            } else {
                                url.searchParams.delete('use_defaults');
                            }
                            return url;
                        }

                        function removeFooterNow() {
                            const footer = document.querySelector('.text-center.py-4');
                            if (footer) footer.remove();
                        }

                        function fetchAndRender() {
                            const url = buildUrlWithFormParams();
                            // Update browser URL without reload
                            window.history.pushState({}, '', url.toString());
                            // Fetch HTML and replace grid + footer controls
                            fetch(url.toString(), { headers: { 'X-Requested-With': 'XMLHttpRequest' }})
                                .then(resp => resp.text())
                                .then(html => {
                                    const parser = new DOMParser();
                                    const doc = parser.parseFromString(html, 'text/html');
                                    const incomingGrid = doc.querySelector('.onlineStore');
                                    const grid = document.querySelector('.onlineStore');
                                    if (incomingGrid && grid) {
                                        grid.innerHTML = incomingGrid.innerHTML;
                                        if (typeof window.initProductCardCarousels === 'function') {
                                            window.initProductCardCarousels(grid);
                                        }
                                    }
                                    // Replace footer area
                                    const incomingFooter = doc.querySelector('.text-center.py-4');
                                    const currentFooter = document.querySelector('.text-center.py-4');
                                    if (currentFooter) {
                                        if (incomingFooter) {
                                            currentFooter.innerHTML = incomingFooter.innerHTML;
                                        } else {
                                            currentFooter.remove();
                                        }
                                    } else if (incomingFooter) {
                                        // If footer didn't exist but incoming has one, append after grid
                                        grid.parentElement.insertAdjacentHTML('beforeend', incomingFooter.outerHTML);
                                    }
                                    // If filters are active (pairs present), ensure footer is removed regardless
                                    if (pairsInput.value) {
                                        removeFooterNow();
                                    }
                                    // Re-bind Load More after filter rendering
                                    if (typeof window.bindLoadMore === 'function') { window.bindLoadMore(); }
                                })
                                .catch(() => { /* ignore */ });
                        }

                        // Restore from query
                        // Remove any legacy subcategory listeners/selection (we don't use them now)

                        // Restore and bind tag checkboxes
                        if (tagsInput) {
                            const existingTags = (tagsInput.value || '').split(',').map(s => s.trim()).filter(Boolean);
                            const existingTagsSet = new Set(existingTags);
                            tagCheckboxes.forEach(cb => {
                                if (existingTagsSet.has(cb.value)) cb.checked = true;
                                cb.addEventListener('click', function(e) {
                                    e.stopPropagation();
                                    writeSelectionsToInputs();
                                    removeFooterNow();
                                    fetchAndRender();
                                });
                            });
                        }
                    })();
                });
            </script>
      {{-- Dynamic Products Grid --}}
<div class="row onlineStore g-2 pt-3">

    @php
        $absoluteStart = ($products->perPage() * ($products->currentPage() - 1)) + 1;
        $cursor = 0;

        // Promo injection points
        $promoPoints = [9, 21];  // after 8th => at 9, after 20th => at 21
    @endphp

    @while($cursor < $products->count())
        @php
            $absIndex = $absoluteStart + $cursor;
        @endphp

        {{-- ✅ PROMO BLOCK 1 (after 8th product => absIndex 9) --}}
        @if($absIndex === 9)
            <div class="w-100"></div>

            <div class="col-12 os-promo-section">
                <div class="row g-2 align-items-stretch os-promo-row">

                    {{-- Banner --}}
                    <div class="col-12 col-xl-6 os-promo-col">
                        <div class="os-promo-tile">
                            <a href="#" target="_blank">
                                <img src="{{ asset('assets/f_assets/image/online1111.png') }}" alt="Promotional Banner">
                            </a>
                        </div>
                    </div>

                    {{-- Product 1 --}}
                    <div class="col-6 col-xl-3 os-promo-col">
                        @if(($cursor) < $products->count())
                            @include('public.partials.product-card-new', ['product' => $products[$cursor]])
                        @endif
                    </div>

                    {{-- Product 2 --}}
                    <div class="col-6 col-xl-3 os-promo-col">
                        @if(($cursor + 1) < $products->count())
                            @include('public.partials.product-card-new', ['product' => $products[$cursor + 1]])
                        @endif
                    </div>

                </div>
            </div>

            <div class="w-100"></div>

            @php $cursor += 2; @endphp
            @continue
        @endif


        {{-- ✅ PROMO BLOCK 2 (after 20th product => absIndex 21) --}}
        @if($absIndex === 19)
            <div class="w-100"></div>

            <div class="col-12 os-promo-section">
                <div class="row g-2 align-items-stretch os-promo-row">

                    {{-- Product 1 --}}
                    <div class="col-6 col-xl-3 os-promo-col">
                        @if(($cursor) < $products->count())
                            @include('public.partials.product-card-new', ['product' => $products[$cursor]])
                        @endif
                    </div>

                    {{-- Product 2 --}}
                    <div class="col-6 col-xl-3 os-promo-col">
                        @if(($cursor + 1) < $products->count())
                            @include('public.partials.product-card-new', ['product' => $products[$cursor + 1]])
                        @endif
                    </div>

                    {{-- Banner --}}
                    <div class="col-12 col-xl-6 os-promo-col">
                        <div class="os-promo-tile">
                            <a href="#" target="_blank">
                                <img src="{{ asset('assets/f_assets/image/online111.png') }}" alt="Promotional Banner">
                            </a>
                        </div>
                    </div>

                </div>
            </div>

            <div class="w-100"></div>

            @php $cursor += 2; @endphp
            @continue
        @endif


        {{-- ✅ STANDARD PRODUCTS (2 per row on mobile/tablet, 4 on xl desktop) --}}
        @php
            $nextPromo = null;
            foreach ($promoPoints as $p) {
                if ($p > $absIndex) { $nextPromo = $p; break; }
            }

            $limit = 4;
            if ($nextPromo !== null) {
                $remainUntilPromo = $nextPromo - $absIndex;
                if ($remainUntilPromo < 4) $limit = max(0, $remainUntilPromo);
            }
        @endphp

        @for($col = 0; $col < $limit && $cursor < $products->count(); $col++)
            @php $prod = $products[$cursor]; @endphp

            <div class="col-6 col-xl-3">
                @include('public.partials.product-card-new', ['product' => $prod])
            </div>

            @php $cursor++; @endphp
        @endfor

        @if($limit === 0)
            @continue
        @endif

    @endwhile


    @if($products->count() === 0)
        <div class="col-12">
            <div class="text-center py-5 text-muted">No products available.</div>
        </div>
    @endif

</div>

   @if($products->count() > 0)
    @php
        $totalShown = $currentPageProducts;
        $hasMorePages = $products->currentPage() < $products->lastPage();
        $allProductsShown = $totalShown >= $totalFilteredProducts;
        $shouldShowLoadMore = $hasMorePages && !$allProductsShown;
    @endphp

    <div class="text-center py-4 online-shopping-footer">
        @if($totalFilteredProducts > 0)
            <div class="products-counter"
                 data-total="{{ $totalFilteredProducts }}"
                 data-current="{{ $currentPageProducts }}"
                 data-per-page="{{ $products->perPage() }}"
                 data-current-page="{{ $products->currentPage() }}"
                 style="font-size: 1rem; letter-spacing: 0.2em; margin-bottom: 1.5rem;">
                SHOWING {{ $currentPageProducts }} OF {{ $totalFilteredProducts }} PRODUCTS
            </div>
        @endif

        @if($shouldShowLoadMore)
            <button id="loadMoreBtn"
                    style="background: #e3e4e5; border: none; color: #222; font-size: 0.8rem; letter-spacing: 0.15em; padding: 0.8rem 2rem; border-radius: 8px; font-family: inherit; font-weight: 400; box-shadow: none; transition: background 0.2s;"
                    data-page="{{ $products->currentPage() + 1 }}"
                    data-last-page="{{ $products->lastPage() }}"
                    data-per-page="{{ $products->perPage() }}"
                    data-total="{{ $totalFilteredProducts }}">
                LOAD MORE
            </button>
        @endif
    </div>
@endif
    </div>
        <script>
    // Function to scroll to products section
    function scrollToProducts() {
        const productsSection = document.querySelector('.onlineStore');
        if (productsSection) {
            productsSection.scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        }
    }

    // Handle mobile video responsiveness
    function handleMobileVideoResize() {
        const mobileVideoSection = document.querySelector('.mobile-video-section');
        if (mobileVideoSection && window.innerWidth < 768) {
            const vh = window.innerHeight;
            if (vh < 600) {
                mobileVideoSection.style.minHeight = '100vh';
                mobileVideoSection.style.maxHeight = '100vh';
            } else {
                mobileVideoSection.style.minHeight = '100vh';
                mobileVideoSection.style.maxHeight = '120vh';
            }
        }
    }

    // Initial call and resize handler
    document.addEventListener('DOMContentLoaded', function () {
        handleMobileVideoResize();
        window.addEventListener('resize', handleMobileVideoResize);
        window.addEventListener('orientationchange', function () {
            setTimeout(handleMobileVideoResize, 100);
        });
    });

    document.addEventListener('DOMContentLoaded', function () {
        window.bindLoadMore = function bindLoadMore() {
            const loadMoreBtn = document.getElementById('loadMoreBtn');
            if (!loadMoreBtn) return;

            // Remove previous listeners by cloning
            const btn = loadMoreBtn.cloneNode(true);
            loadMoreBtn.parentNode.replaceChild(btn, loadMoreBtn);

            function getGrid(container) {
                return container.querySelector('.onlineStore');
            }

            function getShownCount() {
                const grid = getGrid(document);
                if (!grid) return 0;
                return grid.querySelectorAll('.card.addToCartProductDetailsTop').length;
            }

            function appendIncomingItems(doc) {
                const currentGrid = getGrid(document);
                if (!currentGrid) return 0;

                let nodesToAppend = [];
                const incomingGrid = getGrid(doc) || doc.querySelector('.onlineStore');

                if (incomingGrid) {
                    nodesToAppend = Array.from(incomingGrid.children);
                } else {
                    const cards = Array.from(doc.querySelectorAll('.card.addToCartProductDetailsTop'));
                    nodesToAppend = cards.map(card => card.closest('.col-12, .col-md-3, .col-6') || card);
                }

                let appended = 0;
                nodesToAppend.forEach(node => {
                    if (!node) return;
                    currentGrid.appendChild(node);
                    appended++;
                });

                if (appended > 0 && typeof window.initProductCardCarousels === 'function') {
                    window.initProductCardCarousels(currentGrid);
                }

                return appended;
            }

            function syncIncomingMeta(doc) {
                const currentCounter = document.querySelector('.products-counter');
                const incomingCounter = doc.querySelector('.products-counter');
                const incomingBtn = doc.querySelector('#loadMoreBtn');

                if (currentCounter && incomingCounter) {
                    currentCounter.setAttribute(
                        'data-total',
                        incomingCounter.getAttribute('data-total') || currentCounter.getAttribute('data-total') || '0'
                    );
                }

                if (incomingBtn) {
                    btn.setAttribute(
                        'data-last-page',
                        incomingBtn.getAttribute('data-last-page') || btn.getAttribute('data-last-page') || '1'
                    );
                    btn.setAttribute(
                        'data-total',
                        incomingBtn.getAttribute('data-total') || btn.getAttribute('data-total') || '0'
                    );
                }
            }

            function updateCounter() {
                const totalShown = getShownCount();
                const counter = document.querySelector('.products-counter');
                if (!counter) return;

                const totalProducts = parseInt(counter.getAttribute('data-total') || '0', 10);

                counter.setAttribute('data-current', totalShown);

                if (totalProducts > 0) {
                    counter.textContent = `SHOWING ${totalShown} OF ${totalProducts} PRODUCTS`;
                    counter.style.display = 'block';
                } else {
                    counter.style.display = 'none';
                }

                const totalFromBtn = parseInt(btn.getAttribute('data-total') || totalProducts, 10);
                const nextPage = parseInt(btn.getAttribute('data-page') || '2', 10);
                const lastPage = parseInt(btn.getAttribute('data-last-page') || '1', 10);

                if (totalShown >= totalFromBtn || nextPage > lastPage) {
                    btn.style.display = 'none';
                } else {
                    btn.style.display = 'inline-block';
                }
            }

            btn.addEventListener('click', function () {
                const nextPage = parseInt(btn.getAttribute('data-page') || '2', 10);

                btn.disabled = true;
                btn.textContent = 'Loading...';

                const url = new URL(window.location.href);
                url.searchParams.set('page', String(nextPage));

                fetch(url.toString(), {
                    headers: { 'X-Requested-With': 'XMLHttpRequest' },
                    cache: 'no-cache'
                })
                .then(response => response.text())
                .then(html => {
                    const parser = new DOMParser();
                    const doc = parser.parseFromString(html, 'text/html');

                    let appended = appendIncomingItems(doc);

                    if (appended === 0) {
                        const currentGrid = document.querySelector('.onlineStore');
                        const incomingGrid2 = doc.querySelector('.onlineStore');

                        if (currentGrid && incomingGrid2) {
                            currentGrid.insertAdjacentHTML('beforeend', incomingGrid2.innerHTML);
                            appended = incomingGrid2.children.length;

                            if (typeof window.initProductCardCarousels === 'function') {
                                window.initProductCardCarousels(currentGrid);
                            }
                        }
                    }

                    // First sync incoming meta
                    syncIncomingMeta(doc);

                    // Then update next page
                    btn.setAttribute('data-page', String(nextPage + 1));
                    btn.disabled = false;
                    btn.textContent = 'LOAD MORE';

                    // Then update counter
                    updateCounter();

                    // Final hide check
                    const shown = getShownCount();
                    const total = parseInt(btn.getAttribute('data-total') || '0', 10);
                    const lastPage = parseInt(btn.getAttribute('data-last-page') || '1', 10);
                    const upcomingPage = parseInt(btn.getAttribute('data-page') || '1', 10);

                    if (shown >= total || appended === 0 || upcomingPage > lastPage) {
                        btn.style.display = 'none';
                    }

                    try {
                        window.scrollBy({ top: 200, left: 0, behavior: 'smooth' });
                    } catch (_) {}
                })
                .catch(() => {
                    btn.disabled = false;
                    btn.textContent = 'LOAD MORE';

                    try {
                        const url = new URL(window.location.href);
                        const nextPage = parseInt(btn.getAttribute('data-page') || '2', 10);
                        url.searchParams.set('page', String(nextPage));
                        window.location.href = url.toString();
                    } catch (_) {}
                });
            });
        };

        window.bindLoadMore();

        // Initial counter update
        const counter = document.querySelector('.products-counter');
        if (counter) {
            const grid = document.querySelector('.onlineStore');
            if (grid) {
                const totalShown = grid.querySelectorAll('.card.addToCartProductDetailsTop').length;
                const totalProducts = parseInt(counter.getAttribute('data-total') || '0', 10);
                counter.textContent = `SHOWING ${totalShown} OF ${totalProducts} PRODUCTS`;
            }
        }
    });
</script>
        </div>
    </section>
@endsection
