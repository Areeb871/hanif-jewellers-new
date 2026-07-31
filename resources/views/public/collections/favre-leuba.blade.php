@extends('public.layouts.header_black_white_fixed')

@section('content')
<style>
/* Override global .gehnawaSection on phones (pulls banner behind header) */
@media (max-width: 991.98px) {
    .gehnawaSection {
        margin-top: 0 !important;
        z-index: 0 !important;
        height: auto !important;
    }
}

.fl-since-history-wrapper {
    width: 100%;
    padding: 150px 0;
    background: #e9ecec;
}

.fl-since-history-wrapper .container {
    max-width: 1380px;
    margin: 0 auto;
    padding: 0;
}

.fl-since-history-flex {
    display: grid;
    grid-template-columns: 1.05fr 1fr;
    align-items: stretch;
    background: #e9ecec;
    overflow: hidden;
}

/* LEFT SIDE */
.fl-since-history-col-left {
    position: relative;
}

.fl-since-history-image,
.fl-since-history-image picture,
.fl-since-history-image img {
    width: 100%;
    height: 100%;
    display: block;
}

.fl-since-history-image img {
    object-fit: cover;
}

/* RIGHT SIDE */
.fl-since-history-col-right {
    display: flex;
    align-items: center;
}

.fl-since-history-content {
    padding: 34px 42px;
    width: 100%;
}

.para-regular-upper {
    font-size: 11px;
    letter-spacing: 2.5px;
    text-transform: uppercase;
    font-weight: 600;
    margin-bottom: 16px;
    color: #111;
}

.fl-since-heading {
    margin: 0 0 28px;
    font-family: "Times New Roman", Georgia, serif;
    font-size: 58px;
    font-weight: 400;
    line-height: 1.08;
    color: #111;
}

.fl-since-heading span {
    font-style: italic;
    font-weight: 400;
}

.para-medium {
    font-size: 18px;
    line-height: 1.75;
    color: #1a1a1a;
    margin-bottom: 24px;
    max-width: 94%;
}

.button {
    display: inline-block;
    margin-top: 8px;
    padding: 14px 30px;
    border: 1px solid #111;
    color: #111;
    text-decoration: none;
    font-size: 13px;
    letter-spacing: 1.8px;
    text-transform: uppercase;
    transition: 0.3s ease;
}

.button:hover {
    background: #111;
    color: #fff;
}

/* LAPTOP */
@media (max-width: 1199px) {

    .fl-since-heading {
        font-size: 48px;
    }

    .para-medium {
        font-size: 16px;
        line-height: 1.7;
        max-width: 100%;
    }

    .fl-since-history-content {
        padding: 28px 30px;
    }
}

/* TABLET */
@media (max-width: 991px) {

    .fl-since-history-flex {
        grid-template-columns: 1fr;
    }

    .fl-since-history-image img {
        height: auto;
    }

    .fl-since-history-content {
        padding: 28px;
    }

    .fl-since-heading {
        font-size: 42px;
    }
}

/* MOBILE */
/* MOBILE ONLY */
@media (max-width: 767px) {

    .fl-since-history-flex {
        display: flex;
        flex-direction: column-reverse;   /* TEXT FIRST, IMAGE SECOND */
    }

.fl-since-history-wrapper {
padding:0px;
}
    .fl-since-history-content {
        padding: 22px 18px;
    }

    .para-regular-upper {
        font-size: 10px;
        letter-spacing: 2px;
        margin-bottom: 12px;
    }

    .fl-since-heading {
        font-size: 34px;
        line-height: 1.15;
        margin-bottom: 18px;
    }

    .para-medium {
        font-size: 15px;
        line-height: 1.7;
        margin-bottom: 18px;
    }

    .button {
        width: 100%;
        text-align: center;
        padding: 14px;
    }

    .fl-since-history-image img {
        width: 100%;
        height: auto;
        display: block;
    }
}

/* Favre Leuba page vertical rhythm */
.favre-page {
    --favre-section-space: clamp(2.5rem, 5vw, 5rem);
    --favre-content-gap: clamp(1.25rem, 2.5vw, 2rem);
}

.favre-page .fl-since-history-wrapper {
    padding-top:var(--favre-section-space);
    padding-bottom:var(--favre-section-space);
}

.favre-page .para-regular-upper {
    margin-top:0;
    margin-bottom:var(--favre-content-gap);
}

.favre-page .fl-since-heading {
    margin-top:0;
    margin-bottom:var(--favre-content-gap);
}

.favre-page .para-medium:last-child {
    margin-bottom:0;
}

.favre-page .favre-products-section {
    padding-top:0 !important;
    padding-bottom:var(--favre-section-space) !important;
}

.favre-page .bovet-filterbar {
    display:flex;
    flex-direction:column;
    align-items:center;
    /* gap:clamp(0.5rem, 1vw, 0.75rem); */
    padding:clamp(0.75rem, 2vw, 1.25rem) 14px;
}

.favre-page .bovet-filterbar__left {
    display:none;
}

.favre-page .bovet-filterbar__center {
    width:100%;
    display:flex;
    justify-content:center;
}

.favre-page .bovet-brand-logo {
    margin:0 auto !important;
}

.favre-page .bovet-filterbar__right {
    width:100%;
    display:flex;
    justify-content:flex-end;
}

.favre-page .bovet-filterbar__btn {
    transform:none;
    width:max-content;
    white-space:nowrap;
    flex-wrap:nowrap;
}

.favre-page .favre-products-section .onlineStore {
    padding-top:var(--favre-content-gap) !important;
}

.favre-page .favre-footer {
    padding-top:var(--favre-section-space) !important;
    padding-bottom:0 !important;
}

@media (max-width: 767px) {
    .favre-page .fl-since-history-content {
        padding:0 18px var(--favre-content-gap);
    }

    .favre-page .bovet-filterbar {
        padding-right:12px;
        padding-left:12px;
    }
}
</style>

<main class="favre-page">

    @php
        $bannerUrl = null;

        // Change this to Favre-Leuba mobile video if you have one
        $mobileVideoPath = 'assets/f_assets/image/watches mobile view/favre-leuba-mobile.jpeg';

        if (isset($favreSubcategory) && $favreSubcategory && $favreSubcategory->banner_url) {
            $bannerUrl = $favreSubcategory->banner_url;
        } else {
            // Fallback banner (can be image OR video)
            $bannerUrl = $mobileVideoPath;
        }
    @endphp

    @if($bannerUrl)
<section class="gehnawaSection p-0 position-relative">

    {{-- DESKTOP (≥992px) --}}
    @if(Str::endsWith($bannerUrl, ['.mp4', '.webm', '.ogg']))
        <video
            autoplay
            loop
            muted
            playsinline
            class="video-desktop d-none d-lg-block"
            style="width:100%; height:120vh; object-fit:cover;">
            <source src="{{ asset($bannerUrl) }}"
                    type="video/{{ pathinfo($bannerUrl, PATHINFO_EXTENSION) }}">
        </video>
    @else
        <div class="d-none d-lg-block"
             style="width:100%; height:120vh;
                    background-image:url('{{ asset($bannerUrl) }}');
                    background-size:cover;
                    background-position:center;">
        </div>
    @endif

    {{-- MOBILE + TABLET (<992px) --}}
    @php
        $mobileVideo = (isset($favreSubcategory) && $favreSubcategory && $favreSubcategory->slug === 'favre-leuba')
            ? $mobileVideoPath
            : $bannerUrl;
    @endphp

    @if(Str::endsWith($mobileVideo, ['.mp4', '.webm', '.ogg']))
        <video
            autoplay
            loop
            muted
            playsinline
            class="video-mobile d-block d-lg-none"
            style="width:100%; height:120vh; object-fit:cover;">
            <source src="{{ asset($mobileVideo) }}"
                    type="video/{{ pathinfo($mobileVideo, PATHINFO_EXTENSION) }}">
        </video>
    @else
        <img
            src="{{ asset($mobileVideo) }}"
            alt="Favre Leuba Mobile Banner"
            class="d-block d-lg-none w-100"
            style="height: auto; display: block;"
            loading="eager"
        >
    @endif

</section>
@endif
<section id="hm-section-3" class="fl-since-history-wrapper">
    <div class="container">

        <div class="fl-since-history-flex">

            <!-- LEFT IMAGE -->
            <div class="fl-since-history-col-left">
                <div class="fl-since-history-image">
                   <picture>
    <source 
        srcset="{{ asset('assets/f_assets/image/favre/right_image.jpg') }}" 
        media="(max-width:767px)"
    >

    <img 
        src="{{ asset('assets/f_assets/image/favre/right_image.jpg') }}" 
        alt="Since 1737"
    >
</picture>
                </div>
            </div>

            <!-- RIGHT CONTENT -->
            <div class="fl-since-history-col-right">
                <div class="fl-since-history-content">

                    <div class="para-regular-upper">
                        CONQUERING FRONTIERS SINCE 1737
                    </div>

                    <h1 class="fl-since-heading">
                        Favre Leuba <br>
                        <span>A Legacy That</span> <br>
                        Transcends Time
                    </h1>

                    <p class="para-medium">
                        During the 1700s, Swiss watchmaking was rapidly advancing, with many of today’s well-known brands originating in Le Locle, a small city nestled in the Jura mountains of Switzerland.
                    </p>

                    <p class="para-medium">
                        Standing at the forefront of the horological Swiss movement was Abraham Favre, who was eventually titled the ‘Master Watchmaker of Le Locle.’ Many generations of the watchmaker's family laboured to take his celebrated legacy forward, together with Auguste Leuba from Buttes in Val-de-Travers - creating a brand that has been conquering frontiers ever since.
                    </p>
                </div>
            </div>

        </div>

    </div>
</section>


    <section class="favre-products-section">
        <style>
            .offcanvas-modern { font-family: 'Inter', Arial, sans-serif; background:#fff !important; color:#222; min-width:320px; max-width:380px; }
            @media (max-width: 767px) { .offcanvas-modern { min-width:100% !important; max-width:100% !important; width:100% !important; } }
            .offcanvas-modern .offcanvas-header { border-bottom:1px solid #fff; padding-bottom:0.5rem; background:#fff; }
            .offcanvas-modern .offcanvas-title { font-size:1.1rem; font-weight:400; letter-spacing:.02em; text-transform:uppercase; color:#222; }
            .offcanvas-modern .btn-close { filter:none; opacity:1; background-size:1em; width:1em; height:1em; }

            .filter .navbar-toggler { border:none !important; outline:none !important; box-shadow:none !important; background:transparent !important; padding:4px 10px; font-size:14px; line-height:1.1; display:flex; align-items:center; gap:6px; }
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

            .filter-section-title { font-size:.98rem; font-weight:300; letter-spacing:.01em; margin-bottom:.8rem; margin-top:1.5rem; text-transform:uppercase; color:#222; display:flex; align-items:center; justify-content:space-between; border-bottom:1px solid #ecebe7; padding-bottom:.5rem; cursor:pointer; }

            .category-list { list-style:none; padding-left:0; margin-bottom:0; }
            .category-list.collapsible { max-height:1000px; overflow:hidden; transition:max-height .3s ease-out; }
            .category-list.collapsible:not(.show) { max-height:0; transition:max-height .3s ease-in; }

            .category-toggle { font-size:1.1em; color:#b2b2b2; cursor:pointer; user-select:none; width:20px; text-align:center; margin-left:10px; }

            .form-check-input.filter-tag-checkbox { accent-color:#111; border-color:#bbb; box-shadow:none !important; }
            .form-check-input.filter-tag-checkbox:checked { background-color:#111; border-color:#111; }

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
           .discover-more-btn{
               display: block;
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
           
            

            .filter-tag-checkbox { margin-right: 8px; }

            .brand-logo {
                display: block;
                margin-left: auto;
                margin-right: auto;
                width: 10%;
                height: auto;
            }
            @media (max-width: 575px) {
                .brand-logo { width: 40%; margin-top: -75px; }
            }
            @media (min-width: 576px) and (max-width: 767px) {
                .brand-logo { width: 30%; }
            }
            @media (min-width: 768px) and (max-width: 991px) {
                .brand-logo { width: 20%; }
            }
            @media (min-width: 992px) {
                .brand-logo { width: 20%; margin-top: -75px; }
            }

            .filter .navbar-toggler { position: absolute !important; right: 0 !important; z-index: 10; }
            @media (max-width: 575px) {
                .filter .navbar-toggler { margin-top: 80px !important; margin-right: 10px !important; font-size: 12px !important; padding: 4px 8px !important; }
            }
            @media (min-width: 576px) and (max-width: 767px) {
                .filter .navbar-toggler { margin-top: 100px !important; margin-right: 15px !important; font-size: 13px !important; }
            }
            @media (min-width: 768px) and (max-width: 991px) {
                .filter .navbar-toggler { margin-top: 120px !important; margin-right: 20px !important; }
            }
            @media (min-width: 992px) {
                .filter .navbar-toggler { margin-top: 127px !important; margin-right: 23px !important; }
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
  width: clamp(120px, 32vw, 190px);
  height: auto;
  display: block;
}

.bovet-filterbar__btn{
    border: none !important;
    outline: none !important;
    box-shadow: none !important;
    background: transparent !important;
    padding: 6px 8px;
    font-size: 12px;
    display: flex;
    align-items: center;
    gap: 6px;
    white-space: nowrap;
    transform: translateY(30px); /* move down */
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
 <div class="navbar navbar-white bovet-filterbar">
        <div class="bovet-filterbar__left"></div>

    <div class="bovet-filterbar__center">
        <img src="{{ asset('assets/f_assets/image/watch logo/favre.png') }}"
             class="bovet-brand-logo" alt="Bovet">
    </div>

    <div class="bovet-filterbar__right">
        <button class="navbar-toggler bovet-filterbar__btn" type="button"
                data-bs-toggle="offcanvas" data-bs-target="#offcanvasFavre">
            <span class="navbar-toggler-icon"></span> SORT & FILTER
        </button>
    </div>
</div>
        <div class="container-fluid px-3">
            <div class="row onlineStore g-2 pt-3" id="favreGrid">
                @if(isset($products) && $products->count())
                    @foreach($products as $prod)
                         <div class="col-6 col-lg-3">
                            @include('public.partials.product-card-watches', ['product' => $prod])
                        </div>
                    @endforeach
                @else
                    <div class="col-12"><div class="text-center py-5 text-muted">Collection to be Revealed Soon!</div></div>
                @endif
            </div>
        </div>

        <div class="text-center py-4 favre-footer">
            @if($products->count() > 0)
                @php
                    $totalShown = $currentPageProducts;
                    $hasMorePages = $products->currentPage() < $products->lastPage();
                @endphp

                @if($totalFilteredProducts > 0)
                    <div class="products-counter"
                        data-total="{{ $totalFilteredProducts }}"
                        data-current="{{ $currentPageProducts }}"
                        data-per-page="{{ $products->perPage() }}"
                        data-current-page="{{ $products->currentPage() }}"
                        style="font-size: 1rem; letter-spacing: 0.2em;">
                        SHOWING {{ $currentPageProducts }} OF {{ $totalFilteredProducts }} PRODUCTS
                    </div>
                @endifSHOWING

                @php
                    $allProductsShown = $totalShown >= $totalFilteredProducts;
                    $shouldShowLoadMore = $hasMorePages && !$allProductsShown;
                @endphp

                @if($shouldShowLoadMore)
                    <button id="loadMoreFavreBtn"
                            style="background: #e3e4e5; border: none; color: #222; font-size: 0.8rem; letter-spacing: 0.15em; padding: 0.8rem 2rem; border-radius: 8px; font-family: inherit; font-weight: 400; box-shadow: none; transition: background 0.2s;"
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

<div class="offcanvas offcanvas-end offcanvas-modern"
     tabindex="-1"
     id="offcanvasFavre"
     aria-labelledby="offcanvasFavreLabel"
     data-bs-backdrop="true"
     data-bs-scroll="false">

    <div class="offcanvas-header">
        <span class="offcanvas-title" id="offcanvasFavreLabel">SORT & FILTER</span>
        <button type="button" class="btn-close btn-close-black"
                data-bs-dismiss="offcanvas"
                aria-label="Close"></button>
    </div>

    <div class="offcanvas-body">

        {{-- SORT --}}
        <div>
            <div class="filter-section-title"
                 onclick="toggleCategory('favreSortList', this.querySelector('.category-toggle'))"
                 style="font-size:14px!important;">
                SORT BY <span class="category-toggle">−</span>
            </div>

            <ul class="sort-list show" id="favreSortList">
                @php $currentSort = request('sort'); @endphp
                <li data-value="" class="{{ !$currentSort ? 'selected' : '' }}">
                    <span class="diamond">{{ !$currentSort ? '◆' : '◇' }}</span> Best Selling
                </li>
                <li data-value="new_old" class="{{ $currentSort=='new_old' ? 'selected' : '' }}">
                    <span class="diamond">{{ $currentSort=='new_old' ? '◆' : '◇' }}</span> Date, new to old
                </li>
                <li data-value="old_new" class="{{ $currentSort=='old_new' ? 'selected' : '' }}">
                    <span class="diamond">{{ $currentSort=='old_new' ? '◆' : '◇' }}</span> Date, old to new
                </li>
            </ul>
        </div>

        {{-- GENDER --}}
        <div class="mt-3">
            <div class="filter-section-title"
                 onclick="toggleCategory('favreGenderList', this.querySelector('.category-toggle'))"
                 style="font-size:14px!important;">
                GENDER <span class="category-toggle">+</span>
            </div>

            @php
                $selectedTags = collect(explode(',', request('tags','')))->map(fn($s)=>trim($s));
            @endphp

            <ul class="category-list collapsible" id="favreGenderList">
                <li>
                    <input type="checkbox"
                           class="form-check-input filter-tag-checkbox favre-filter"
                           value="mens"
                           {{ $selectedTags->contains('mens') ? 'checked' : '' }}>
                    <span class="subcat-label">Men's</span>
                </li>
                <li>
                    <input type="checkbox"
                           class="form-check-input filter-tag-checkbox favre-filter"
                           value="ladies"
                           {{ $selectedTags->contains('ladies') ? 'checked' : '' }}>
                    <span class="subcat-label">Ladies</span>
                </li>
            </ul>
        </div>

        {{-- SERIES (MULTI-SELECT) --}}
        <div class="mt-3">
            <div class="filter-section-title"
                 onclick="toggleCategory('favreSeriesList', this.querySelector('.category-toggle'))"
                 style="font-size:14px!important;">
                SERIES <span class="category-toggle">+</span>
            </div>

            @php
                $favreSeries = [
                    'chief-chronograph',
                    'chief-date',
                    'deep-raider-revival',
                    'sea-sky-revival',
                    'deep-raider-renaissance',
                ];
            @endphp

            <ul class="category-list collapsible" id="favreSeriesList">
                @foreach($favreSeries as $s)
                    <li>
                        <input type="checkbox"
                               class="form-check-input filter-tag-checkbox favre-filter"
                               value="{{ $s }}"
                               {{ $selectedTags->contains($s) ? 'checked' : '' }}>
                        <span class="subcat-label">{{ ucwords(str_replace('-', ' ', $s)) }}</span>
                    </li>
                @endforeach
            </ul>
        </div>

    </div>
</div>
<script>
function toggleCategory(targetId, element) {
    const target = document.getElementById(targetId);
    if (!target) return;
    const open = target.classList.contains('show');
    target.classList.toggle('show');
    if (element) element.textContent = open ? '+' : '−';
}

(function(){
    function buildUrl(){
        const url = new URL(window.location.href);
        url.searchParams.delete('tags');
        url.searchParams.delete('page');

        const selected = Array.from(
            document.querySelectorAll('.favre-filter:checked')
        ).map(i => i.value);

        if (selected.length) {
            url.searchParams.set('tags', selected.join(','));
        }

        url.searchParams.set('page','1');
        return url;
    }

    function fetchAndRender(url){
        window.history.pushState({},'',url.toString());
        fetch(url.toString(), { headers:{'X-Requested-With':'XMLHttpRequest'} })
            .then(r=>r.text())
            .then(html=>{
                const doc = new DOMParser().parseFromString(html,'text/html');

                const incomingGrid = doc.querySelector('#favreGrid');
                const grid = document.querySelector('#favreGrid');
                if (incomingGrid && grid) grid.innerHTML = incomingGrid.innerHTML;

                const incomingFooter = doc.querySelector('.favre-footer');
                const footer = document.querySelector('.favre-footer');
                if (footer) footer.innerHTML = incomingFooter ? incomingFooter.innerHTML : '';

                if (window.bindFavreLoadMore) window.bindFavreLoadMore();
                if (window.updateFavreCounter) window.updateFavreCounter();
            })
            .catch(()=>{});
    }

    // SORT
    const sortList = document.getElementById('favreSortList');
    if (sortList){
        sortList.querySelectorAll('li').forEach(li=>{
            li.addEventListener('click',()=>{
                sortList.querySelectorAll('li').forEach(x=>{
                    x.classList.remove('selected');
                    const d=x.querySelector('.diamond'); if(d) d.textContent='◇';
                });
                li.classList.add('selected');
                const d=li.querySelector('.diamond'); if(d) d.textContent='◆';

                const url = buildUrl();
                const val = li.getAttribute('data-value') || '';
                if (val) url.searchParams.set('sort',val);
                else url.searchParams.delete('sort');

                fetchAndRender(url);
            });
        });
    }

    // FILTER CHECKBOXES (MULTI)
    document.querySelectorAll('.favre-filter').forEach(cb=>{
        cb.addEventListener('click', e=>{
            e.stopPropagation();
            fetchAndRender(buildUrl());
        });
    });
})();
</script>

</main>
@endsection
