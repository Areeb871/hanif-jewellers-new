@extends('public.layouts.header_black_white_fixed')
@section('content')

<style>
.cys-page {
  --cys-section-space: clamp(2.5rem, 5vw, 5rem);
  --cys-content-gap: clamp(1.25rem, 2.5vw, 2rem);
}

.cys-page .cys-logo-section {
  margin: 0;
  padding: var(--cys-section-space) 15px;
}

.cys-page .cys-logo-section .brand-logo-wrapper {
  margin-top: 0 !important;
  margin-bottom: 0 !important;
}

.cys-page .cys-logo-section .brand-logo {
  display: block;
  width: min(210px, 52vw);
  max-width: 210px;
  height: auto;
  margin: 0 auto !important;
}

.cys-page .cys-story {
  margin-top: 0 !important;
  padding: 0 0 var(--cys-section-space);
}

.cys-page .cys-head {
  margin-bottom: var(--cys-content-gap);
}

.cys-page .cys-products-section {
  padding-top: 0 !important;
  padding-bottom: var(--cys-section-space) !important;
}

.cys-page .cys-cta {
  margin: 0;
  padding: 70px 0 27px 0;
}

.cys-page .cys-btn {
  padding: 0;
  font-family:"Argent CF", Georgia, serif;
  font-size: 24px;
  font-weight: 600;
  /* letter-spacing: 0; */
}

.cys-page .cys-products-section .onlineStore {
  padding-top:16px !important;
}

.cys-page .cys-footer {
  padding-top: var(--cys-section-space) !important;
  padding-bottom: 0 !important;
}

@media (max-width: 767px) {
  .cys-page .cys-logo-section {
    padding-right: 12px;
    padding-left: 12px;
  }

  .cys-page .cys-logo-section .brand-logo {
    width: min(150px, 48vw);
  }

  .cys-page .cys-cta {
    padding-right: 12px;
    padding-left: 12px;
  }

  .cys-page .cys-btn {
    width: auto !important;
    font-size: 13px;
  }
}
</style>

<main class="cys-page">

@if(!empty($cysSubcategory) && !empty($cysSubcategory->banner_url))
@php
    // Desktop banner (from DB)
    $desktopMedia = $cysSubcategory->banner_url;
    $desktopExt   = strtolower(pathinfo($desktopMedia, PATHINFO_EXTENSION));
    $desktopIsVideo = in_array($desktopExt, ['mp4','webm','ogg']);

    // Mobile override (ONLY if you really have a separate mobile file)
    // IMPORTANT: your current page slug is "cuervo-y-sobrinos", not "epos"
    $mobileMedia = $desktopMedia;

    if ($cysSubcategory->slug === 'cuervo-y-sobrinos') {
        $mobileMedia = 'assets/f_assets/image/watches mobile view/CYS Mob Banner.mp4';
     }

    $mobileExt   = strtolower(pathinfo($mobileMedia, PATHINFO_EXTENSION));
    $mobileIsVideo = in_array($mobileExt, ['mp4','webm','ogg']);
@endphp

<section class="gehnawaSection p-0 position-relative">

    {{-- DESKTOP (md and up) --}}
    @if($desktopIsVideo)
        <video
            autoplay
            loop
            muted
            playsinline
            preload="metadata"
            class="d-none d-md-block"
            style="width:100%; height:120vh; object-fit:cover;"
        >
            <source src="{{ asset($desktopMedia) }}" type="video/{{ $desktopExt }}">
            Your browser does not support the video tag.
        </video>
    @else
        <img
            class="d-none d-md-block"
            src="{{ asset($desktopMedia) }}"
            alt="Banner"
            style="width:100%; height:120vh; object-fit:cover;"
            loading="eager"
        >
    @endif

    {{-- MOBILE (below md) --}}
    @if($mobileIsVideo)
        <video
            autoplay
            loop
            muted
            playsinline
            preload="metadata"
            class="d-block d-md-none"
            style="width:100%; height:120vh; object-fit:cover;"
        >
            <source src="{{ asset($mobileMedia) }}" type="video/{{ $mobileExt }}">
            Your browser does not support the video tag.
        </video>
    @else
        <img
            class="d-block d-md-none"
            src="{{ asset($mobileMedia) }}"
            alt="Banner"
            style="width:100%; height:120vh; object-fit:cover;"
            loading="eager"
        >
    @endif

</section>
@endif
@php
  // ✅ Put your real files here
  $storyVideo   = 'assets/f_assets/image/cys/main.jpg';
  $heritageImg1 = 'assets/f_assets/image/cys/1.jpg'; // <-- change to your file
  $heritageImg2 = 'assets/f_assets/image/cys/2.jpg'; // <-- change to your file
@endphp
<div class="cys-logo-section navbar navbar-white align-items-center filter position-relative justify-content-center">
 <div class="brand-logo-wrapper w-70 my-3 text-center">
    <img src="{{ asset('assets/f_assets/image/watch logo/CYS.png') }}" alt="CYS logo" class="brand-logo">
  </div>
</div>

<section class="cys-story">
  <div class="cys-wrap">

    <div class="cys-head">
      <p class="cys-kicker">A journey through excellence, style, and tradition.</p>
      <p class="cys-sub">
        Discover the Cuervo y Sobrinos collections. Each timepiece tells a story of Swiss elegance and Cuban soul.
      </p>
    </div>

    <div class="cys-grid">

      <div class="cys-left">
        <p>
          Cuervo y Sobrinos is the only luxury watch brand with a true Latin legacy. Inspired and animated by
          Havana’s golden years, Cuervo y Sobrinos watches evoke a flamboyant and legendary way of life.
        </p>
      </div>

      <div class="cys-center">
        <div class="cys-video">

    <img src="{{ asset('assets/f_assets/image/cys/main.jpg') }}"
     alt="Cuervo y Sobrinos Heritage"
     class="cys-main-image"
     loading="lazy"style="width: 100%;">


        </div>
      </div>

      <div class="cys-right">
        <div class="cys-imggrid">
          <img src="{{ asset($heritageImg1) }}" alt="Heritage Image 1" loading="lazy">
          <img src="{{ asset($heritageImg2) }}" alt="Heritage Image 2" loading="lazy">
        </div>
      </div>

    </div>
  </div>
</section>
<div class="container-fluid p-0">

    <img src="{{ asset('assets/f_assets/image/cys/banner.jpg') }}"
         class="img-fluid w-100"
         alt="Cuervo y Sobrinos Banner">

</div>



    <section class="cys-products-section">
        <style>
         .cys-full-banner img{
    width: 100%;
    height: auto;
    max-height: 100vh;
}
            .offcanvas-modern { font-family: 'Inter', Arial, sans-serif; background:#fff !important; color:#222; min-width:320px; max-width:380px; }
            @media (max-width: 767px) { .offcanvas-modern { min-width:100% !important; max-width:100% !important; width:100% !important; } }
            .offcanvas-modern .offcanvas-header { border-bottom:1px solid #fff; padding-bottom:0.5rem; background:#fff; }
            .offcanvas-modern .offcanvas-title { font-size:1.1rem; font-weight:400; letter-spacing:.02em; text-transform:uppercase; color:#222; }
            .offcanvas-modern .btn-close { filter:none; opacity:1; background-size:1em; width:1em; height:1em; }
            .filter .navbar-toggler { border:none !important; outline:none !important; box-shadow:none !important; background:transparent !important; padding:4px 10px; font-family:"Poppins", sans-serif; font-size:12px; line-height:1.1; display:flex; align-items:center; gap:6px; }
            .filter .navbar-toggler:focus,
            .filter .navbar-toggler:hover,
            .filter .navbar-toggler:active { border:none !important; outline:none !important; box-shadow:none !important; background:transparent !important; }
            .filter .navbar-toggler-icon {
                width: 18px; height: 14px; background: none; display: inline-block; position: relative;
                background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 20'%3e%3crect x='0' y='0' width='30' height='2' fill='%23333'/%3e%3crect x='0' y='9' width='30' height='2' fill='%23333'/%3e%3crect x='0' y='18' width='30' height='2' fill='%23333'/%3e%3c/svg%3e");
                background-size: 100% 100%; background-repeat: no-repeat; margin-right: 2px;
            }
            .sort-list, .category-list, .subcategory-list { list-style:none; padding-left:0; margin-bottom:0; }
            .sort-list { max-height: 0; overflow:hidden; transition: max-height 0.3s ease-out; }
            .sort-list.show { max-height: 500px; transition: max-height 0.3s ease-in; }
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
            .offcanvas-modern .offcanvas-body { background: rgb(255, 255, 255); padding: 1rem; }
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
              @media (max-width: 767.98px) {
  .discover-more-btn {
    width: 120px !important;
    display: block;
    margin-left: auto;
    margin-right: auto;
    text-align: center;
  }
}
           
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
                    width: 54%;
                    margin-top: -65px;
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
        margin-top: -51px;                }
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
                    margin-right: 10px !important;
                    font-size: 12px !important;
                    padding: 4px 8px !important;
                }
            }
            /* Small mobile screens (576px to 767px) */
            @media (min-width: 576px) and (max-width: 767px) {
                .filter .navbar-toggler {
                    margin-top: -59px !important;
                    margin-right: 15px !important;
                    font-size: 12px !important;
                }
            }
            /* Tablet screens (768px to 991px) */
            @media (min-width: 768px) and (max-width: 991px) {
                .filter .navbar-toggler {
                    margin-top: -60px !important;
                    margin-right: 20px !important;
                }
            }
            /* Desktop screens (992px and above) */
            @media (min-width: 992px) {
                .filter .navbar-toggler {
                    margin-top: -63px !important;
                    margin-right: 23px !important;
                }
            }
  .cys-story{
    padding: 28px 0;
    background:#fff;
  }
  .cys-wrap{
    max-width: 1100px;
    margin: 0 auto;
    padding: 0 18px;
  }

  /* Top text */
  .cys-head{
    text-align:center;
    margin-bottom: 18px;
  }
  .cys-kicker{
    margin:0;
    font-family:"Argent CF", Georgia, serif;
    font-size:36px;
    font-weight:600;
  }
  .cys-sub{
    margin:6px 0 0;
    font-family:"Poppins", sans-serif;
    font-size:13px;
    line-height:1.59;
  }

/* 3 column layout */
.cys-grid{
  display: grid;
  grid-template-columns: 1fr 1.4fr 1fr;
  gap: 24px;
  align-items: stretch; /* IMPORTANT */
}

/* Center video column */
.cys-center{
  display: flex;
}

/* Video container */
.cys-video{
  position: relative;
  width: 100%;
  height: 100%; /* FULL HEIGHT */
  overflow: hidden;
  background: #eee;
}

/* Video fill */
.cys-video video,
.cys-video iframe{
  position: absolute;
  inset: 0;
  width: 100%;
  height: 100%;
  object-fit: cover;
}

/* Right image grid */
.cys-imggrid{
  display: grid;
  grid-template-rows: 1fr 1fr;
  gap: 14px;
  height: 100%; /* IMPORTANT */
}

.cys-imggrid img{
  width: 100%;
  height: 100%;
  object-fit: cover;
  display: block;
}
.cys-left{
  display: flex;
  align-items: center;      /* vertical center */
  justify-content: center;  /* horizontal center */
  text-align: center;
  font-family:"Poppins", sans-serif;
  font-size:13px;
  line-height:1.7;
  height: 100%;
}


  /* CTA */
  .cys-cta{
    text-align:center;
    margin-top: 18px;
  }
  .cys-btn{
    display:inline-block;
    font-size: 14.5px;
    letter-spacing: 1px;
    text-decoration:none;
    color:#000;
    padding: 10px 14px;
  }

  /* Responsive */
  @media (max-width: 900px){
    .cys-kicker{
      max-width:100%;
      font-size:24px;
      line-height:1.3;
      overflow-wrap:break-word;
    }
    .cys-grid{
      grid-template-columns: 1fr;
      gap: 16px;
    }
    .cys-imggrid img{
  width: 100%;
}
    .cys-left{ order:1; }
    .cys-center{ order:2; }
    .cys-right{ order:3; }
    .cys-left{ text-align:center; }
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
 <div class="cys-cta">
      <a href="#cysGrid" class="cys-btn">EXPLORE THE TIMEPIECES</a>
    </div>
{{-- =========================
   PAGE HEADER + GRID + FOOTER
========================= --}}
<div class="filter d-flex justify-content-end px-3">

  <button class="navbar-toggler border-0 text-black"
          type="button"
          data-bs-toggle="offcanvas"
          data-bs-target="#offcanvasCys"
          aria-controls="offcanvasCys"
          aria-label="Toggle navigation"
          style="position:static!important; margin:0!important;">
    <span class="navbar-toggler-icon"></span> SORT & FILTER
  </button>
</div>

<div class="container-fluid px-3">
  <div class="row onlineStore g-2 pt-3" id="cysGrid">
    @if(isset($products) && $products->count())
      @foreach($products as $prod)
        <div class="col-6 col-sm-4 col-md-3 col-lg-3">
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
{{-- ✅ FOOTER MUST BE OUTSIDE OFFCANVAS --}}
<div class="text-center py-4 cys-footer" id="cysFooter">
  @if($products->count() > 0)

    @php
      $hasMorePages = $products->currentPage() < $products->lastPage();
    @endphp

    @if($totalFilteredProducts > 0)
      <div class="products-counter"
           data-total="{{ $totalFilteredProducts }}"
           data-current="{{ $currentPageProducts }}"
           data-per-page="{{ $products->perPage() }}"
           data-current-page="{{ $products->currentPage() }}"
           style="font-family: 'Poppins', sans-serif; font-size: 0.8rem; letter-spacing: 0.2em; margin-bottom: 1.5rem;">
        SHOWING {{ $currentPageProducts }} OF {{ $totalFilteredProducts }} PRODUCTS
      </div>
    @endif

    @php
      $allProductsShown = $currentPageProducts >= $totalFilteredProducts;
      $shouldShowLoadMore = $hasMorePages && !$allProductsShown;
    @endphp

    @if($shouldShowLoadMore)
      <button id="loadMoreBtn"
              style="background:#e3e4e5;border:none;color:#222;font-family:'Poppins',sans-serif;font-size:0.7rem;letter-spacing:0.15em;padding:0.8rem 2rem;border-radius:8px;font-weight:400;box-shadow:none;transition:background 0.2s;"
              data-page="{{ $products->currentPage() + 1 }}"
              data-last-page="{{ $products->lastPage() }}"
              data-per-page="{{ $products->perPage() }}"
              data-total="{{ $totalFilteredProducts }}">
        LOAD MORE
      </button>
    @endif

  @endif
</div>

{{-- =========================
   OFFCANVAS (FILTERS ONLY)
========================= --}}
<div class="offcanvas offcanvas-end offcanvas-modern"
     tabindex="-1"
     id="offcanvasCys"
     aria-labelledby="offcanvasCysLabel"
     data-bs-backdrop="true"
     data-bs-scroll="false">

  <div class="offcanvas-header">
    <span class="offcanvas-title" id="offcanvasCysLabel">SORT & FILTER</span>
    <button type="button" class="btn-close btn-close-black" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>

  <div class="offcanvas-body">

    {{-- SORT --}}
    <div>
      <div class="filter-section-title"
           onclick="toggleCategory('cysSortList', this.querySelector('.category-toggle'))"
           style="font-size:14px!important;">
        SORT BY <span class="category-toggle">−</span>
      </div>

      @php $currentSort = request('sort'); @endphp
      <ul class="sort-list show" id="cysSortList">
        <li data-value="" class="{{ !$currentSort ? 'selected' : '' }}">
          <span class="diamond">{{ !$currentSort ? '◆' : '◇' }}</span> Best Selling
        </li>
        <li data-value="new_old" class="{{ $currentSort=='new_old' ? 'selected' : '' }}">
          <span class="diamond">{{ $currentSort=='new_old' ? '◆' : '◇' }}</span> Date, new to old
        </li>
        <li data-value="old_new" class="{{ $currentSort=='old_new' ? 'selected' : '' }}">
          <span class="diamond">{{ $currentSort=='old_new' ? '◆' : '◇' }}</span> Date, old to new
        </li>
        <li data-value="price_low_high" class="{{ $currentSort=='price_low_high' ? 'selected' : '' }}">
          <span class="diamond">{{ $currentSort=='price_low_high' ? '◆' : '◇' }}</span> Price, low to high
        </li>
        <li data-value="price_high_low" class="{{ $currentSort=='price_high_low' ? 'selected' : '' }}">
          <span class="diamond">{{ $currentSort=='price_high_low' ? '◆' : '◇' }}</span> Price, high to low
        </li>
      </ul>
    </div>

    {{-- GENDER --}}
    <div class="mt-3">
      <div class="filter-section-title"
           onclick="toggleCategory('cysGenderList', this.querySelector('.category-toggle'))"
           style="font-size:14px!important;">
        GENDER <span class="category-toggle">+</span>
      </div>

      @php
        $selectedTags = collect(explode(',', request('tags','')))
          ->map(fn($s)=>trim(strtolower($s)))->filter();
      @endphp

      <ul class="category-list collapsible" id="cysGenderList">
        <li>
          <input type="checkbox" class="form-check-input filter-tag-checkbox cys-filter"
                 value="mens" {{ $selectedTags->contains('mens') ? 'checked' : '' }}>
          <span class="subcat-label">Men's</span>
        </li>
        <li>
          <input type="checkbox" class="form-check-input filter-tag-checkbox cys-filter"
                 value="ladies" {{ $selectedTags->contains('ladies') ? 'checked' : '' }}>
          <span class="subcat-label">Ladies</span>
        </li>
      </ul>
    </div>

    {{-- SERIES --}}
    <div class="mt-3">
      <div class="filter-section-title"
           onclick="toggleCategory('cysSeriesList', this.querySelector('.category-toggle'))"
           style="font-size:14px!important;">
        SERIES <span class="category-toggle">+</span>
      </div>

      @php
        $cysSeries = ['historiador','prominente','vuelo','buceador','esplendidos','robusto'];
      @endphp

      <ul class="category-list collapsible" id="cysSeriesList">
        @foreach($cysSeries as $s)
          <li>
            <input type="checkbox" class="form-check-input filter-tag-checkbox cys-filter"
                   value="{{ $s }}" {{ $selectedTags->contains($s) ? 'checked' : '' }}>
            <span class="subcat-label">{{ strtoupper($s) }}</span>
          </li>
        @endforeach
      </ul>
    </div>

    {{-- CASE SIZE --}}
    <div class="mt-3">
      <div class="filter-section-title"
           onclick="toggleCategory('cysSizeList', this.querySelector('.category-toggle'))"
           style="font-size:14px!important;">
        CASE SIZE <span class="category-toggle">+</span>
      </div>

      @php $cysSizes = ['36','38','40','43','44','52']; @endphp
      <ul class="category-list collapsible" id="cysSizeList">
        @foreach($cysSizes as $sz)
          <li>
            <input type="checkbox" class="form-check-input filter-tag-checkbox cys-filter"
                   value="{{ $sz }}" {{ $selectedTags->contains($sz) ? 'checked' : '' }}>
            <span class="subcat-label">{{ $sz }}mm</span>
          </li>
        @endforeach
      </ul>
    </div>

  </div>
</div>

{{-- =========================
   JS (FILTER + SORT + LOAD MORE)
========================= --}}
<script>
function toggleCategory(targetId, element) {
  const target = document.getElementById(targetId);
  if (!target) return;
  const open = target.classList.contains('show');
  target.classList.toggle('show');
  if (element) element.textContent = open ? '+' : '−';
}

(function () {

  function buildUrl() {
    const url = new URL(window.location.href);
    url.searchParams.delete('tags');
    url.searchParams.delete('page');

    const selected = Array.from(document.querySelectorAll('.cys-filter:checked')).map(i => i.value);
    if (selected.length) url.searchParams.set('tags', selected.join(','));

    url.searchParams.set('page', '1');
    return url;
  }

  function replaceGridAndFooter(doc) {
    const incomingGrid = doc.querySelector('#cysGrid');
    const grid = document.querySelector('#cysGrid');
    if (incomingGrid && grid) grid.innerHTML = incomingGrid.innerHTML;

    // ✅ update ONLY bottom footer
    const incomingFooter = doc.querySelector('#cysFooter');
    const footer = document.querySelector('#cysFooter');
    if (footer) footer.innerHTML = incomingFooter ? incomingFooter.innerHTML : '';
  }

  function fetchAndRender(url) {
    window.history.pushState({}, '', url.toString());
    fetch(url.toString(), { headers: { 'X-Requested-With': 'XMLHttpRequest' } })
      .then(r => r.text())
      .then(html => {
        const doc = new DOMParser().parseFromString(html, 'text/html');
        replaceGridAndFooter(doc);
        bindLoadMore();
        updateCounter();
      })
      .catch(() => {});
  }

  // SORT
  const sortList = document.getElementById('cysSortList');
  if (sortList) {
    sortList.querySelectorAll('li').forEach(li => {
      li.addEventListener('click', () => {
        sortList.querySelectorAll('li').forEach(x => {
          x.classList.remove('selected');
          const d = x.querySelector('.diamond');
          if (d) d.textContent = '◇';
        });

        li.classList.add('selected');
        const d = li.querySelector('.diamond');
        if (d) d.textContent = '◆';

        const url = buildUrl();
        const val = li.getAttribute('data-value') || '';
        if (val) url.searchParams.set('sort', val); else url.searchParams.delete('sort');

        fetchAndRender(url);
      });
    });
  }

  // FILTER CHECKBOXES
  document.querySelectorAll('.cys-filter').forEach(cb => {
    cb.addEventListener('click', e => {
      e.stopPropagation();
      fetchAndRender(buildUrl());
    });
  });

  // expose for reuse
  window.cysFetchAndRender = fetchAndRender;

})();

function bindLoadMore() {
  const btn = document.getElementById('loadMoreBtn');
  if (!btn) return;

  btn.onclick = function () {
    const nextPage = parseInt(btn.dataset.page || '2', 10);

    btn.disabled = true;
    btn.textContent = 'Loading...';

    const url = new URL(window.location.href);
    url.searchParams.set('page', String(nextPage));

    fetch(url.toString(), { headers: { 'X-Requested-With': 'XMLHttpRequest' } })
      .then(r => r.text())
      .then(html => {
        const doc = new DOMParser().parseFromString(html, 'text/html');

        const incomingGrid = doc.querySelector('#cysGrid');
        const grid = document.querySelector('#cysGrid');
        if (incomingGrid && grid) {
          Array.from(incomingGrid.children).forEach(el => grid.appendChild(el));
        }

        // update ONLY footer
        const incomingFooter = doc.querySelector('#cysFooter');
        const footer = document.querySelector('#cysFooter');
        if (footer) footer.innerHTML = incomingFooter ? incomingFooter.innerHTML : '';

        bindLoadMore();
        updateCounter();
      })
      .catch(() => {
        btn.disabled = false;
        btn.textContent = 'LOAD MORE';
      });
  };
}

function updateCounter() {
  const grid = document.getElementById('cysGrid');
  const counter = document.querySelector('#cysFooter .products-counter');
  if (!grid || !counter) return;

  const shown = grid.querySelectorAll('.card.addToCartProductDetailsTop').length;
  const total = parseInt(counter.dataset.total || '0', 10);

  if (total > 0) {
    counter.textContent = `SHOWING ${shown} OF ${total} PRODUCTS`;
    counter.style.display = 'block';
  } else {
    counter.style.display = 'none';
  }
}

document.addEventListener('DOMContentLoaded', function () {
  bindLoadMore();
  updateCounter();
});
</script>
</main>
@endsection
