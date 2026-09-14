@extends('public.layouts.header_black_white_fixed')

@section('content')

<style>
.epos-page {
    --epos-section-space:clamp(2.5rem, 5vw, 4.5rem);
    --epos-content-gap:clamp(1.25rem, 2.5vw, 2rem);
}

/*
 * Pinned hero underlay — banner stays behind while content slides over.
 * Uses fixed + spacer (more reliable than sticky when body has overflow-x:hidden).
 */
.epos-page .epos-hero-spacer {
    position: relative;
    height: 100vh;
    height: 100dvh;
    margin: 0;
    padding: 0;
    pointer-events: none;
}

.epos-page .epos-hero.gehnawaSection {
    position: fixed !important;
    top: 0;
    left: 0;
    right: 0;
    z-index: 0 !important;
    height: 100vh !important;
    height: 100dvh !important;
    margin: 0 !important;
    padding: 0 !important;
    overflow: hidden;
    background: #111;
    pointer-events: none;
}

/* Keep site footer above the fixed hero video */
body:has(.epos-page) .hj-footer {
    position: relative;
    z-index: 5;
}

.epos-page .epos-hero-media {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
}

.epos-page .epos-hero-fallback {
    width: 100%;
    height: 100%;
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
}

@media (min-width: 768px) {
    .epos-page .epos-hero.gehnawaSection video,
    .epos-page .epos-hero.gehnawaSection img {
        width: 100% !important;
        height: 100% !important;
        object-fit: cover !important;
    }

    .epos-page .epos-hero.gehnawaSection > div[style*="background-image"],
    .epos-page .epos-hero .epos-hero-fallback {
        width: 100% !important;
        height: 100% !important;
        aspect-ratio: unset !important;
        background-size: cover !important;
        background-position: center !important;
    }
}

.epos-page .epos-intro-sheet,
.epos-page .epos-mid-sheet,
.epos-page .epos-products-section {
    position: relative;
    z-index: 2;
    padding: 0 !important;
    background: #fff;
    box-shadow: 0 -18px 48px rgba(0, 0, 0, 0.12);
}

/* Story sheet over pinned image — soft overlay so image stays visible behind */
.epos-page .epos-mid-sheet {
    background: rgba(0, 0, 0, 0.88);
    backdrop-filter: blur(1px);
    -webkit-backdrop-filter: blur(1px);
    min-height: 45vh;
    display: flex;
    align-items: center;
    justify-content: center;
}

.epos-page .epos-mid-sheet .epos-story-label,
.epos-page .epos-mid-sheet .epos-story-title,
.epos-page .epos-mid-sheet .epos-story-text {
    color: #fff;
}

/* Second pinned banner (same underlay feel as hero) */
.epos-page .epos-mid-spacer {
    position: relative;
    height: 100vh;
    height: 100dvh;
    margin: 0;
    padding: 0;
    pointer-events: none;
}

.epos-page .epos-mid-pin {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    z-index: 0;
    height: 100vh;
    height: 100dvh;
    margin: 0;
    padding: 0;
    overflow: hidden;
    background: #111;
    pointer-events: none;
    visibility: hidden;
}

.epos-page .epos-mid-pin img,
.epos-page .epos-mid-pin .epos-hero-media {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
}

.epos-page .epos-filter-header {
    display:flex;
    flex-direction:column;
    align-items:center;
    gap:clamp(0.5rem, 1vw, 0.75rem);
    padding-top:clamp(0.75rem, 2vw, 1.5rem) 14px;
}

.epos-page .epos-filter-header .brand-logo-wrapper {
    width:100% !important;
    margin-top:35px !important;
}

.epos-page .epos-filter-header .brand-logo {
    width:clamp(120px, 28vw, 190px);
    height:auto;
    margin:0 auto !important;
}

.epos-page .epos-filter-header .navbar-toggler {
    position:static !important;
    align-self:flex-end;
    margin:0 !important;
    width:max-content;
    white-space:nowrap;
    flex-wrap:nowrap;
}

.epos-page .onlineStore {
    padding-top:16px !important;
}

.epos-page .epos-footer {
    padding-top:var(--epos-section-space) !important;
    padding-bottom:var(--epos-section-space) !important;
}

/* Story + mid banners — Poppins, existing site sizes */
.epos-page .epos-story {
    max-width: 720px;
    margin: 0 auto;
    padding: 5.5rem 1.7rem;
    text-align: center;
}

.epos-page .epos-story-label {
    font-family: 'Poppins', sans-serif;
    font-size: 0.7rem;
    letter-spacing: 0.2em;
    text-transform: uppercase;
    color: #888;
    margin-bottom: 0.85rem;
}

.epos-page .epos-story-title {
    font-family: 'Poppins', sans-serif;
    font-size: 1.15rem;
    font-weight: 500;
    letter-spacing: 0.08em;
    text-transform: uppercase;
    color: #222;
    margin: 0 0 1rem;
}

.epos-page .epos-story-text {
    font-family: 'Poppins', sans-serif;
    font-size: 0.85rem;
    font-weight: 300;
    line-height: 1.75;
    color: #555;
    margin: 0;
}

@media (min-width: 768px) {
    .epos-page .epos-story {
        padding: 5.25rem 2rem;
    }
}

@media (max-width: 767px) {
    .epos-page .epos-filter-header {
        padding-right:12px;
        padding-left:12px;
    }
}
</style>

<main class="epos-page">

    @if(isset($eposSubcategory) && $eposSubcategory && $eposSubcategory->banner_url)
        <div class="epos-hero-spacer" aria-hidden="true"></div>
        <section class="gehnawaSection epos-hero p-0" aria-label="EPOS collection banner">
            {{-- Desktop Video --}}
            @if(Str::endsWith($eposSubcategory->banner_url, ['.mp4', '.webm', '.ogg']))
                <video 
                    autoplay 
                    loop 
                    muted 
                    playsinline 
                    class="video-desktop d-none d-md-block epos-hero-media"
                    onerror="this.style.display='none'; this.nextElementSibling.style.display='block';">
                    <source src="{{ asset($eposSubcategory->banner_url) }}" type="video/{{ pathinfo($eposSubcategory->banner_url, PATHINFO_EXTENSION) }}">
                    Your browser does not support the video tag.
                </video>
                <div class="video-fallback-desktop d-none d-md-block epos-hero-fallback" style="display:none; background-image:url('{{ asset($eposSubcategory->banner_url) }}');"></div>
            @else
                {{-- Static image for desktop --}}
                <div class="d-none d-md-block epos-hero-fallback" style="background-image:url('{{ asset($eposSubcategory->banner_url) }}');"></div>
            @endif

            {{-- Mobile Video (Dynamic based on subcategory) --}}
            @php
                $mobileVideo = null;
                $mobileVideoPath = 'assets/f_assets/image/watches mobile view/epos_mobile_view.mp4';

                if ($eposSubcategory->slug === 'epos') {
                    $mobileVideo = $mobileVideoPath;
                } else {
                    $mobileVideo = $eposSubcategory->banner_url;
                }
            @endphp

            @if(Str::endsWith($mobileVideo, ['.mp4', '.webm', '.ogg']))
                <video 
                    autoplay 
                    loop 
                    muted 
                    playsinline 
                    class="video-mobile d-block d-md-none epos-hero-media"
                    onerror="this.style.display='none'; this.nextElementSibling.style.display='block';">
                    <source src="{{ asset($mobileVideo) }}" type="video/{{ pathinfo($mobileVideo, PATHINFO_EXTENSION) }}">
                    Your browser does not support the video tag.
                </video>
                <div class="video-fallback-mobile d-block d-md-none epos-hero-fallback" style="display:none; background-image:url('{{ asset($mobileVideo) }}');"></div>
            @else
                <div class="d-block d-md-none epos-hero-fallback" style="background-image:url('{{ asset($mobileVideo) }}');"></div>
            @endif
        </section>
    @endif

    <section class="epos-intro-sheet">
        <div class="epos-story">
            <h2 class="epos-story-title">Artistry in Watchmaking</h2>
            <p class="epos-story-text">
            EPOS offers high-quality mechanical watches with interesting functions but still at an affordable price. Finished with loving care, according to the traditional Swiss watchmakers’ heritage, they deserve to be called Artistry in Watchmaking
            </p>
        </div>
    </section>

    <div class="epos-mid-spacer" aria-hidden="true"></div>

    <section class="epos-mid-sheet">
        <div class="epos-story">
            <!-- <p class="epos-story-label">Heritage &amp; Detail</p> -->
            <h2 class="epos-story-title">SPECIALIZED IN MECHANICAL WATCHES</h2>
            <p class="epos-story-text">
            EPOS is a Swiss producer of mechanical watches. All time pieces are designed and manufactured in Switzerland.

EPOS has made itself a name as a creator of sophisticated Swiss mechanical watches, featuring complex complications.
            </p>
        </div>
    </section>

    <section class="epos-products-section">
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
                    margin-top: 80px !important;
                    margin-right: 10px !important;
                    font-size: 12px !important;
                    padding: 4px 8px !important;
                }
            }
            /* Small mobile screens (576px to 767px) */
            @media (min-width: 576px) and (max-width: 767px) {
                .filter .navbar-toggler {
                    margin-top: 100px !important;
                    margin-right: 15px !important;
                    font-size: 12px !important;
                }
            }
            /* Tablet screens (768px to 991px) */
            @media (min-width: 768px) and (max-width: 991px) {
                .filter .navbar-toggler {
                    margin-top: 120px !important;
                    margin-right: 20px !important;
                }
            }
            /* Desktop screens (992px and above) */
            @media (min-width: 992px) {
                .filter .navbar-toggler {
                    margin-top: 127px !important;
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
        <div class="epos-filter-header navbar navbar-white filter">
            <div class="brand-logo-wrapper w-70 text-center">
                <img src="{{ asset('assets/f_assets/image/watch logo/Epos.png') }}" alt="Epos logo" class="brand-logo">
            </div>
        </div>
        <div class="filter d-flex justify-content-end px-3">
            <button class="navbar-toggler border-0 text-black" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasEpos" aria-controls="offcanvasEpos" aria-label="Toggle navigation" style="position:static!important; margin:0!important;">
                <span class="navbar-toggler-icon"></span> SORT & FILTER
            </button>
        </div> 

        <div class="container-fluid px-3">
        <div class="row onlineStore g-2 pt-3" id="eposGrid">
            @if(isset($products) && $products->count())
                @foreach($products as $prod)
                    <div class="col-6 col-sm-4 col-md-3 col-lg-3">
                        @include('public.partials.product-card-watches', ['product' => $prod])
                    </div>
                @endforeach
            @else
                <div class="col-12"><div class="text-center py-5 text-muted">Collection to be Revealed Soon!</div></div>
            @endif
        </div>
        </div>
        
        <div class="text-center py-4 epos-footer">
        @if($products->count() > 0)
            @php
                $totalShown = $currentPageProducts;
                $hasMorePages = $products->currentPage() < $products->lastPage();
            @endphp
            @if($totalFilteredProducts > 0)
            <div class="products-counter" data-total="{{ $totalFilteredProducts }}" data-current="{{ $currentPageProducts }}" data-per-page="{{ $products->perPage() }}" data-current-page="{{ $products->currentPage() }}" style="font-family: 'Poppins', sans-serif; font-size: 0.8rem; letter-spacing: 0.2em; margin-bottom: 1.5rem;">
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

    <div class="offcanvas offcanvas-end offcanvas-modern" tabindex="-1" id="offcanvasEpos" aria-labelledby="offcanvasEposLabel" data-bs-backdrop="true" data-bs-scroll="false">
        <div class="offcanvas-header">
            <span class="offcanvas-title" id="offcanvasEposLabel">SORT & FILTER</span>
            <button type="button" class="btn-close btn-close-black" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <div>
                <div class="filter-section-title" onclick="toggleCategory('eposSortList', this.querySelector('.category-toggle'))" style="font-size: 14px !important;">
                    Sort By <span class="category-toggle">+</span>
                </div>
                <ul class="sort-list" id="eposSortList">
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
                <div class="filter-section-title" onclick="toggleCategory('eposGenderList', this.querySelector('.category-toggle'))" style="font-size: 14px !important;">Gender <span class="category-toggle">+</span></div>
                <ul class="category-list collapsible" id="eposGenderList">
                    @php $selectedTags = collect(explode(',', request('tags', '')))->map(fn($s)=>trim($s)); @endphp
                    <li><input type="checkbox" class="form-check-input filter-tag-checkbox epos-filter" data-group="gender" value="mens" {{ $selectedTags->contains('mens') ? 'checked' : '' }} onclick="event.stopPropagation();"> <span class="subcat-label">Men's</span></li>
                    <li><input type="checkbox" class="form-check-input filter-tag-checkbox epos-filter" data-group="gender" value="ladies" {{ $selectedTags->contains('ladies') ? 'checked' : '' }} onclick="event.stopPropagation();"> <span class="subcat-label">Ladies</span></li>
                </ul>
            </div>
            <div class="mt-3">
                <div class="filter-section-title" onclick="toggleCategory('eposSeriesList', this.querySelector('.category-toggle'))" style="font-size: 14px !important;">Series <span class="category-toggle">+</span></div>
                <ul class="category-list collapsible" id="eposSeriesList">
                    <li><input type="checkbox" class="form-check-input filter-tag-checkbox epos-filter" data-group="series" value="timeless" {{ $selectedTags->contains('timeless') ? 'checked' : '' }} onclick="event.stopPropagation();"> <span class="subcat-label">Timeless</span></li>
                    <li><input type="checkbox" class="form-check-input filter-tag-checkbox epos-filter" data-group="series" value="sport" {{ $selectedTags->contains('sport') ? 'checked' : '' }} onclick="event.stopPropagation();"> <span class="subcat-label">Sport</span></li>
                    <li><input type="checkbox" class="form-check-input filter-tag-checkbox epos-filter" data-group="series" value="artistry" {{ $selectedTags->contains('artistry') ? 'checked' : '' }} onclick="event.stopPropagation();"> <span class="subcat-label">Artistry</span></li>
                </ul>
            </div>
            <div class="mt-3">
                <div class="filter-section-title" onclick="toggleCategory('eposSizeList', this.querySelector('.category-toggle'))" style="font-size: 14px !important;">Case Size <span class="category-toggle">+</span></div>
                <ul class="category-list collapsible" id="eposSizeList">
                    @php $sizes = ['32','41','41.5']; @endphp
                    @foreach($sizes as $sz)
                        <li><input type="checkbox" class="form-check-input filter-tag-checkbox epos-filter" data-group="size" value="{{ $sz }}" {{ $selectedTags->contains($sz) ? 'checked' : '' }} onclick="event.stopPropagation();"> <span class="subcat-label">{{ $sz }}mm</span></li>
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
        const offcanvas = document.getElementById('offcanvasEpos');
        function buildUrl() {
            const url = new URL(window.location.href);
            // Build unified tags param to match server-side filtering
            url.searchParams.delete('tags');
            url.searchParams.delete('gender');
            url.searchParams.delete('size');
            url.searchParams.delete('movement');
            url.searchParams.delete('caseType');
            const selected = Array.from(document.querySelectorAll('.epos-filter:checked')).map(i=>i.value);
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
                    const incomingGrid = doc.querySelector('#eposGrid');
                    const grid = document.querySelector('#eposGrid');
                    
                    if (incomingGrid && grid) {
                        grid.innerHTML = incomingGrid.innerHTML;
                    }
                    
                    const incomingFooter = doc.querySelector('.epos-footer');
                    const footer = document.querySelector('.epos-footer');
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
            const sortList = document.getElementById('eposSortList');
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
        document.querySelectorAll('.epos-filter').forEach(cb => {
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
                return container.querySelector('#eposGrid');
            }

            function appendIncomingItems(doc) {
                const currentGrid = getGrid(document);
                if (!currentGrid) return 0;

                // Primary: take children of incoming #eposGrid
                let nodesToAppend = [];
                const incomingGrid = getGrid(doc) || doc.querySelector('#eposGrid');
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
                const counter = document.querySelector('.epos-footer .products-counter');
                
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
                            const currentGrid = document.querySelector('#eposGrid');
                            const incomingGrid2 = doc.querySelector('#eposGrid');
                            if (currentGrid && incomingGrid2) {
                                currentGrid.insertAdjacentHTML('beforeend', incomingGrid2.innerHTML);
                                appended = incomingGrid2.children.length;
                                window.updateCounter();
                            }
                        }
                        
                        // Check if we've reached the end
                        const currentTotal = parseInt(btn.getAttribute('data-total') || total, 10);
                        const currentGrid = document.querySelector('#eposGrid');
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

        // Keep hero video only until products sheet covers the screen —
        // prevents fixed video from showing through the site footer.
        (function () {
            const hero = document.querySelector('.epos-page .epos-hero');
            const sheet = document.querySelector('.epos-page .epos-products-section');
            if (!hero || !sheet) return;

            const syncPins = () => {
                const top = sheet.getBoundingClientRect().top;
                const hide = top <= 0;
                hero.style.visibility = hide ? 'hidden' : 'visible';
                hero.style.pointerEvents = 'none';
            };

            window.addEventListener('scroll', syncPins, { passive: true });
            window.addEventListener('resize', syncPins);
            syncPins();
        })();
    });
    </script>
</main>
@endsection
