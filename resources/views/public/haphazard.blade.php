{{-- resources/views/public/haphazard.blade.php --}}
@extends('public.layouts.header_new')

@section('content')
@php
    $fallbackBanner = 'assets/f_assets/image/haphazard/haphazard banner.mp4';
    $videoExtensions = ['mp4', 'webm', 'ogg'];

    $desktopBannerSource = optional($subcategory)->banner_url ?: $fallbackBanner;
    $mobileBannerSource  = optional($subcategory)->banner_mobile_url ?: $desktopBannerSource;

    $desktopPath = parse_url($desktopBannerSource, PHP_URL_PATH) ?? $desktopBannerSource;
    $mobilePath  = parse_url($mobileBannerSource, PHP_URL_PATH) ?? $mobileBannerSource;

    $desktopExtension = strtolower(pathinfo($desktopPath, PATHINFO_EXTENSION));
    $mobileExtension  = strtolower(pathinfo($mobilePath, PATHINFO_EXTENSION));

    $desktopIsVideo = in_array($desktopExtension, $videoExtensions, true);
    $mobileIsVideo  = in_array($mobileExtension, $videoExtensions, true);

    $desktopType = ($desktopIsVideo && $desktopExtension) ? 'video/' . $desktopExtension : null;
    $mobileType  = ($mobileIsVideo && $mobileExtension) ? 'video/' . $mobileExtension : null;

    $desktopBannerUrl = filter_var($desktopBannerSource, FILTER_VALIDATE_URL) ? $desktopBannerSource : asset($desktopBannerSource);
    $mobileBannerUrl  = filter_var($mobileBannerSource, FILTER_VALIDATE_URL) ? $mobileBannerSource : asset($mobileBannerSource);

    // Aliases (if modal expects these)
    $galleryImages     = $featuredProducts ?? collect();
    $productImages     = $sideProducts ?? collect();
    $bottomImages      = $bottomProducts ?? collect();
    $bottomImagesRow2  = $bottomProductsRow2 ?? collect();

    // ✅ Update this if your image column differs (e.g. main_image, thumbnail, etc.)
    $getImg = function ($p) {
        return $p->image ?? null;
    };
@endphp
<style>
@import url('https://fonts.googleapis.com/css2?family=Cinzel:wght@400;600;700&display=swap');

/* =========================
   HERO
   ========================= */
.ehed-hero-section { display:flex; align-items:center; }
.ehed-video-container { width:50%; position:relative; overflow:hidden; min-height:0; padding-top:59.92%; }
@supports (aspect-ratio: 1) { .ehed-video-container { padding-top:0; aspect-ratio:746/430; } }
.ehed-video-container video { position:absolute; inset:0; width:100%; height:100%; object-fit:cover; display:block; }
.ehed-media-cover { position:absolute; inset:0; width:100%; height:100%; object-fit:cover; display:block; }
.ehed-content-container { width:50%; padding:80px 60px; display:flex; flex-direction:column; justify-content:center; background:#fff; }
.ehed-category-label { font-size:14px; font-weight:400; color:#999; text-transform:uppercase; letter-spacing:.05em; font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Arial,sans-serif; margin-bottom:20px; }
.ehed-main-title { font-size:3rem; color:#000; font-family:Walbaum; margin-bottom:9px; line-height:.3; font-weight:400; }
.ehed-body-text { font-size:16px; font-weight:400; color:#000; line-height:1.6; }
.font-family--serif, .ehed-body-text { font-family: Fancy Cut, Almarai, Times, serif; }
.hero__description { margin-top:1em; font-size:100%; }
h1,h2,h3,h4,h5,h6 { margin:0; }

@media (max-width:768px){
  .ehed-hero-section{ flex-direction:column; }
  .ehed-video-container{ width:100%; height:auto; }
  .ehed-content-container{ width:100%; padding:40px 30px; }
  .ehed-main-title{ font-size:48px; }
  .ehed-category-label{ font-size:12px; }
  .ehed-body-text{ font-size:14px; }
}
@media (max-width:576px){
  .ehed-main-title{ font-size:36px; }
  .ehed-content-container{ padding:30px 20px; }
}

/* =========================
   PROMO SECTION HEIGHT (DESKTOP)
   ========================= */
.promo-section{ height:auto; }
@media (min-width:768px){  .promo-section{ height:63vh; min-height:400px; } }
@media (min-width:992px){  .promo-section{ height:65vh; min-height:450px; } }
@media (min-width:1200px){ .promo-section{ height:70vh; min-height:500px; } }
@media (min-width:1400px){ .promo-section{ height:75vh; min-height:550px; } }

.promo-row{ height:100%; }
.promo-col{ height:100%; }

/* =========================
   VIDEO TILE (PROMO)
   ========================= */
.promo-video-wrap{ width:100%; height:100%; position:relative; overflow:hidden; }
.promo-video-wrap video{ width:100%; height:100%; object-fit:cover; display:block; }

/* Shop Now overlay */
.discover-button-overlay{
  z-index:20;
  pointer-events:none;
  padding-bottom:2rem;
  left:0; right:0; bottom:0;
}
.discover-btn{
  background-color: transparent;
  border: 1px solid rgba(255,255,255,.7);
  color:#fff;
  font-weight:600;
  font-size:1rem;
  letter-spacing:2px;
  text-transform:uppercase;
  border-radius:4px;
  pointer-events:auto;
  transition: all .3s ease;
  padding:.75rem 3rem;
  white-space:nowrap;
  display:inline-block;
  text-decoration:none;
}
.discover-btn:hover{
  background-color: rgba(0,0,0,.35);
  color:#fff;
  transform:scale(1.05);
  text-decoration:none;
}

/* =========================
   RIGHT GRID (2 images)
   ========================= */
.right-grid{
  height:100%;
  width:100%;
  display:grid;
  grid-template-columns: 1fr 1fr;
  gap: .5rem; /* same as g-2 */
}
.right-tile{
  height:100%;
  width:100%;
  overflow:hidden;
  display:block;
  position:relative;
}
.right-tile img{
  width:100%;
  height:100%;
  object-fit:cover;
  display:block;
}

/* =========================
   DISCOVER OVERLAY (HOVER ONLY on ALL DEVICES)
   - Desktop: hover
   - Tablet: hover
   - Mobile: tap = hover
   ========================= */
.product-card{
  position: relative;
  overflow: hidden;
  display: block;
}

.product-card .discover-overlay{
  position:absolute;
  left:0;
  right:0;
  bottom:16px;
  display:flex;
  justify-content:center;
  opacity:0;
  transition: opacity .25s ease;
  pointer-events:none;
  z-index: 5;
}

/* show on hover */
.product-card:hover .discover-overlay,
.right-tile:hover .discover-overlay{
  opacity:1;
  pointer-events:auto;
}

.product-card .discover-more-btn,
.right-tile .discover-more-btn{
  width:300px;
  max-width:85%;
  text-align:center;
  background:#2b2b2b;
  color:#fff;
  font-size:14px;
  font-weight:500;
  letter-spacing:1px;
  padding:14px 0;
  text-decoration:none;
  border-radius:2px;
  transition: background-color .25s ease;
  display:inline-block;
}

.product-card .discover-more-btn:hover,
.right-tile .discover-more-btn:hover{
  background:#000;
  color:#fff;
}

/* Responsive sizing ONLY (does NOT force visibility) */
@media (max-width: 1024px){
  .product-card .discover-more-btn,
  .right-tile .discover-more-btn{
    width: 220px;
    max-width: 80%;
    font-size: 12px;
    padding: 10px 0;
    letter-spacing: 0.8px;
  }
}
@media (max-width: 576px){
  .product-card .discover-more-btn,
  .right-tile .discover-more-btn{
    width: 180px;
    max-width: 85%;
    font-size: 11px;
    padding: 9px 0;
  }
  .product-card .discover-overlay,
  .right-tile .discover-overlay{
    bottom: 10px;
  }
}

/* =========================
   TABLET LAYOUT:
   first video full width then 2 images below
   ========================= */
@media (min-width:768px) and (max-width:1024px){
  .promo-section, .promo-row, .promo-col { height:auto !important; min-height:0 !important; }
  .promo-section .promo-col { flex:0 0 100% !important; max-width:100% !important; width:100% !important; }

  .promo-video-wrap{ height:420px !important; }
  .right-grid{ height:420px !important; grid-template-columns: 1fr 1fr !important; }
}
@media (min-width:768px) and (max-width:820px){
  .promo-video-wrap{ height:360px !important; }
  .right-grid{ height:360px !important; }
}

/* =========================
   MOBILE: ensure promo has visible height
   ========================= */
@media (max-width:767.98px){
  .promo-section .h-100, .promo-row.h-100, .promo-col{ height:auto !important; }
  .promo-video-wrap{ height:320px !important; min-height:320px !important; }
  .right-grid{ height:320px !important; grid-template-columns:1fr 1fr !important; }
}
@media (max-width:575.98px){
  .promo-video-wrap{ height:260px !important; min-height:260px !important; }
  .right-grid{ height:260px !important; }
}

/* =========================
   Misc
   ========================= */
.m-5{ margin:1rem !important; }
.grid-img-200{ object-fit:cover; width:100%; display:block; }
</style>

{{-- ===== HERO ===== --}}
<section class="ehed-hero-section">
    <div class="ehed-video-container d-none d-md-block">
        @if($desktopIsVideo)
            <video autoplay loop muted playsinline>
                <source src="{{ $desktopBannerUrl }}" @if($desktopType) type="{{ $desktopType }}" @endif>
                Your browser does not support the video tag.
            </video>
        @else
            <img src="{{ $desktopBannerUrl }}" alt="Haphazard Banner" class="ehed-media-cover">
        @endif
    </div>

    <div class="ehed-video-container d-block d-md-none">
        @if($mobileIsVideo)
            <video autoplay loop muted playsinline>
                <source src="{{ $mobileBannerUrl }}" @if($mobileType) type="{{ $mobileType }}" @endif>
                Your browser does not support the video tag.
            </video>
        @else
            <img src="{{ $mobileBannerUrl }}" alt="Haphazard Banner Mobile" class="ehed-media-cover">
        @endif
    </div>

    <div class="ehed-content-container">
        <!-- <div class="ehed-category-label">WOMEN</div> -->
        <h1 class="ehed-main-title">HAPHAZARD</h1>
        <p class="ehed-body-text hero__description font-family--serif">
        From the dunes of  deserts.
        </p>
    </div>
</section>

{{-- ===== TOP 4 PRODUCTS (WITH DISCOVER) ===== --}}
@if(isset($featuredProducts) && $featuredProducts->count() > 0)
<div class="row g-2 mb-3" id="haphazardGalleryTop" style="margin-top:1rem;">
    @foreach($featuredProducts as $index => $product)
        @php $img = $getImg($product); @endphp
        <div class="col-6 col-md-3">
            <div class="product-card">

                @if($img)
                    <img src="{{ asset($img) }}"
                         class="img-fluid w-100 grid-img-200"
                         alt="{{ $product->name ?? 'Haphazard Product' }}"
                         data-gallery="haphazardGalleryTop"
                         data-index="{{ $index }}"
                         style="cursor:pointer;">
                @else
                    <div style="width:100%; height:200px; background:#f5f5f5; display:flex; align-items:center; justify-content:center;">
                        <span class="text-muted">No image</span>
                    </div>
                @endif

                <div class="discover-overlay">
                    <a href="{{ route('product.details', $product->slug) }}" class="discover-more-btn">
                        Discover More
                    </a>
                </div>

            </div>
        </div>
    @endforeach
</div>
@endif

{{-- ===== PROMO VIDEO (LEFT) + 2 PRODUCTS (RIGHT) ===== --}}
<div class="row onlineStore g-2 promo-section">
    <div class="col-12 h-100">
        <div class="row g-2 align-items-stretch promo-row h-100">

            {{-- LEFT: VIDEO --}}
            <div class="col-12 col-md-6 promo-col d-flex position-relative">
                <div class="promo-video-wrap">
                    <video autoplay muted loop playsinline>
                        <source src="{{ asset('assets/f_assets/image/haphazard/product1.mp4') }}" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>

                    <div class="discover-button-overlay position-absolute bottom-0 start-50 translate-middle-x w-100 text-center">
                        <a class="btn discover-btn" href="{{ route('collections.haphazard_new') }}">Shop Now</a>
                    </div>
                </div>
            </div>

            {{-- RIGHT: 2 PRODUCTS (WITH DISCOVER) --}}
            <div class="col-12 col-md-6 promo-col d-flex">
                <div class="right-grid">
                    @if(isset($sideProducts) && $sideProducts->count() > 0)
                        @foreach($sideProducts as $index => $product)
                            @php $img = $getImg($product); @endphp

                            {{-- Whole tile is link. Button is visual only --}}
                            <a href="{{ route('product.details', $product->slug) }}" class="right-tile product-card">
                                @if($img)
                                    <img src="{{ asset($img) }}" alt="{{ $product->name ?? 'Product ' . ($index + 1) }}">
                                @else
                                    <div class="w-100 h-100 d-flex align-items-center justify-content-center" style="background:#f5f5f5;">
                                        <span class="text-muted">No image</span>
                                    </div>
                                @endif

                                <div class="discover-overlay">
                                    <span class="discover-more-btn">Discover More</span>
                                </div>
                            </a>
                        @endforeach
                    @endif
                </div>
            </div>

        </div>
    </div>
</div>

{{-- ===== BOTTOM ROW 1 (WITH DISCOVER + MODAL) ===== --}}
@if(isset($bottomProducts) && $bottomProducts->count() > 0)
<div class="row g-2 mb-3 mt-3" id="bottomGallery">
    @foreach($bottomProducts as $index => $product)
        @php $img = $getImg($product); @endphp
        <div class="col-6 col-md-3">
            <div class="product-card">
                @if($img)
                    <img src="{{ asset($img) }}"
                         class="img-fluid w-100 grid-img-200 gallery-image"
                         alt="{{ $product->name ?? 'Haphazard Product' }}"
                         data-gallery="bottomGallery"
                         data-index="{{ $index }}"
                         style="cursor:pointer;">
                @else
                    <div style="width:100%; height:200px; background:#f5f5f5; display:flex; align-items:center; justify-content:center;">
                        <span class="text-muted">No image</span>
                    </div>
                @endif

                <div class="discover-overlay">
                    <a href="{{ route('product.details', $product->slug) }}" class="discover-more-btn">Discover More</a>
                </div>
            </div>
        </div>
    @endforeach
</div>
@endif

{{-- ===== BOTTOM ROW 2 (WITH DISCOVER + MODAL) ===== --}}
@if(isset($bottomProductsRow2) && $bottomProductsRow2->count() > 0)
<div class="row g-2 mb-3 mt-3" id="bottomGalleryRow2">
    @foreach($bottomProductsRow2 as $index => $product)
        @php $img = $getImg($product); @endphp
        <div class="col-6 col-md-3">
            <div class="product-card">
                @if($img)
                    <img src="{{ asset($img) }}"
                         class="img-fluid w-100 grid-img-200 gallery-image"
                         alt="{{ $product->name ?? 'Haphazard Product' }}"
                         data-gallery="bottomGalleryRow2"
                         data-index="{{ $index }}"
                         style="cursor:pointer;">
                @else
                    <div style="width:100%; height:200px; background:#f5f5f5; display:flex; align-items:center; justify-content:center;">
                        <span class="text-muted">No image</span>
                    </div>
                @endif

                <div class="discover-overlay">
                    <a href="{{ route('product.details', $product->slug) }}" class="discover-more-btn">Discover More</a>
                </div>
            </div>
        </div>
    @endforeach
</div>
@endif

{{-- ===== PROMO VIDEO (RIGHT) + 2 PRODUCTS (LEFT) from bottomProductsRow3 ===== --}}
<div class="row onlineStore g-2 promo-section">
    <div class="col-12 h-100">
        <div class="row g-2 align-items-stretch promo-row h-100">

            {{-- LEFT: 2 PRODUCTS (Desktop LEFT, Mobile SECOND) --}}
            <div class="col-12 col-md-6 promo-col d-flex order-2 order-md-1">
                <div class="right-grid">
                    @if(isset($bottomProductsRow3) && $bottomProductsRow3->count() > 0)
                        @foreach($bottomProductsRow3 as $index => $product)
                            @php $img = $getImg($product); @endphp
                            <a href="{{ route('product.details', $product->slug) }}" class="right-tile product-card">
                                @if($img)
                                    <img src="{{ asset($img) }}" alt="{{ $product->name ?? 'Product ' . ($index + 1) }}">
                                @else
                                    <div class="w-100 h-100 d-flex align-items-center justify-content-center" style="background:#f5f5f5;">
                                        <span class="text-muted">No image</span>
                                    </div>
                                @endif

                                <div class="discover-overlay">
                                    <span class="discover-more-btn">Discover More</span>
                                </div>
                            </a>
                        @endforeach
                    @endif
                </div>
            </div>

            {{-- RIGHT: VIDEO (Desktop RIGHT, Mobile FIRST) --}}
            <div class="col-12 col-md-6 promo-col d-flex position-relative order-1 order-md-2">
                <div class="promo-video-wrap">
                    <video autoplay muted loop playsinline>
                        <source src="{{ asset('assets/f_assets/image/haphazard/product2.mp4') }}" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>

                    <div class="discover-button-overlay position-absolute bottom-0 start-50 translate-middle-x w-100 text-center">
                        <a class="btn discover-btn" href="{{ route('collections.haphazard_new') }}">Shop Now</a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

{{-- ===== DYNAMIC ROWS (AFTER bottomProductsRow3) - 4 PER ROW, KEEP MODAL + DISCOVER LINK ===== --}}
@if(isset($dynamicBottomRows) && $dynamicBottomRows->count() > 0)
    @foreach($dynamicBottomRows as $rowIndex => $row)
        <div class="row g-2 mb-3 mt-3" id="dynamicRow_{{ $rowIndex }}">
            @foreach($row as $index => $product)
                @php
                    $img = $getImg($product);
                    $globalIndex = ($rowIndex * 4) + $index; // unique index
                @endphp

                <div class="col-6 col-md-3">
                    <div class="product-card">
                        @if($img)
                            <img src="{{ asset($img) }}"
                                 class="img-fluid w-100 grid-img-200 gallery-image"
                                 alt="{{ $product->name ?? 'Haphazard Product' }}"
                                 data-gallery="dynamicGallery"
                                 data-index="{{ $globalIndex }}"
                                 style="cursor:pointer;">
                        @else
                            <div style="width:100%; height:200px; background:#f5f5f5; display:flex; align-items:center; justify-content:center;">
                                <span class="text-muted">No image</span>
                            </div>
                        @endif

                        <div class="discover-overlay">
                            <a href="{{ route('product.details', $product->slug) }}" class="discover-more-btn">
                                Discover More
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endforeach
@endif

<div class="text-center">
    <a class="m-5 btn border btn-outline-dark px-5 py-2" href="{{ route('collections.haphazard_new') }}">SHOP NOW</a>
</div>

@include('public.partials.image-gallery-modal')
@endsection
