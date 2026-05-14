@extends('public.layouts.header_latest')
@section('content')
<style>
    .chronoswiss-hero-media{
    width:100%;
    height:min(120vh, 900px);
    min-height:420px;
    overflow:hidden;
    position:relative;
    line-height:0;
    background:#000;
}

.chronoswiss-hero-video{
    width:100%;
    height:100%;
    display:block;
    object-fit:cover;
    object-position:center center;
    vertical-align:top;
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

.chronoswiss-intro-section{
    padding-top:2px;
    margin-top:-28px;   /* move more upward */
    text-align:center;
}

.chronoswiss-intro-content{
    max-width:980px;
    margin:0 auto;
    padding:0 20px 18px;
}

.chronoswiss-intro-title{
    margin:0 0 14px;
    font-family:"Times New Roman", Georgia, serif;
    font-style:italic;
    font-weight:700;
    font-size:29px;
    line-height:1.3;
    color:#1f1f1f;
}

.chronoswiss-intro-text{
    margin:0 auto;
    max-width:900px;
    font-family:Arial, sans-serif;
    font-size:18px;
    line-height:1.45;
    color:#4a4a4a;
    padding: 25px;
}

.chronoswiss-intro-image-wrap{
    width:100vw;
    height:clamp(180px, 32vw, 500px);
    margin-left:calc(50% - 50vw);
    margin-right:calc(50% - 50vw);
    overflow:hidden;
    position:relative;
    line-height:0;
}

.chronoswiss-intro-image{
    width:100%;
    height:100%;
    display:block;
    object-fit:cover;
    object-position:center top;
    vertical-align:top;
}

.chronoswiss-intro-button-wrap{
    background:#ffffff;
    padding:18px 15px 6px;
}

.chronoswiss-intro-button{
    display:inline-block;
    font-family:Arial, sans-serif;
    font-size:21px;
    font-weight:700;
    letter-spacing:0;
    color:#000;
    text-decoration:none;
    text-transform:uppercase;
}

.chronoswiss-intro-button:hover{
    color:#000;
    text-decoration:none;
}

@media (max-width: 767px){

    .chronoswiss-hero-media{
        height:72vh;
        min-height:320px;
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

    .chronoswiss-intro-section{
        padding-top:0;
        margin-top:-26px;   /* reduce logo/text gap strongly */
    }

    .chronoswiss-intro-content{
        padding:0 14px 14px;
    }

    .chronoswiss-intro-title{
        font-size:30px;
        line-height:1.35;
        margin-bottom:10px;
    }

    .chronoswiss-intro-text{
        font-size:14px;
        line-height:1.5;
        padding:25px;
    
    }

    .chronoswiss-intro-image-wrap{
        height:160px;
    }

    .chronoswiss-intro-button-wrap{
        padding:16px 12px 6px;
    }

    .chronoswiss-intro-button{
        font-size:13px;
    }
}

.ml-bottom{
    padding:14px 20px 0;
}

.ml-discover{
    display:inline-block;
    font-size:13px;
    line-height:1;
    color:#000;
    text-decoration:none;
    letter-spacing:0.3px;
    font-family: Arial, Helvetica, sans-serif;
    margin-bottom:8px;
}

/* desktop tuning */
@media (min-width: 992px){
 

    .ml-bottom{
        padding-top:14px;
    }
    .ml-discover{
        font-size:16px;
        margin-bottom:10px;
    }
}

/* mobile */
@media (max-width: 767px){
    .ml-discover{
        font-size:14px;
    }
}
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

</style>
@if(isset($mauriceLacroixSubcategory) && $mauriceLacroixSubcategory && $mauriceLacroixSubcategory->banner_url)

    @php
        $desktopBanner = $mauriceLacroixSubcategory->banner_url;
        $desktopIsVideo = \Illuminate\Support\Str::endsWith(strtolower($desktopBanner), ['.mp4', '.webm', '.ogg']);

        /* mobile banner dynamic */
        $mobileBanner = $desktopBanner;

        if ($mauriceLacroixSubcategory->slug === 'maurice-lacroix ') {
            $mobileBanner = 'assets/f_assets/image/watches mobile view/maurice_mobile.mp4';
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
            <img src="{{ asset($desktopBanner) }}" alt="{{ $mauriceLacroixSubcategory->name ?? 'Banner' }}">
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
            <img src="{{ asset($mobileBanner) }}" alt="{{ $mauriceLacroixSubcategory->name ?? 'Banner' }}">
        @endif
    </section>

@endif

<section class="chronoswiss-logo-section">
    <img src="{{ asset('assets/f_assets/image/watch logo/Maurice_Lacroix_latest.png') }}"
         alt="Maurice Lacroix logo"
         class="chronoswiss-logo-main">
</section>

<section class="chronoswiss-intro-section">
    <div class="chronoswiss-intro-content">
        <p class="chronoswiss-intro-text">
            Living by the mantra #YourTimeIsNow, we never lose sight of the values we hold dear because they make us who we are. Join us to make the now the most precious asset in life, and enjoy the ride.
        </p>
    </div>

    <div class="chronoswiss-intro-image-wrap">
        <img
            src="{{ asset('assets/f_assets/image/ml_new_updated1.png') }}"
            alt="Independent Watchmaking, Born in 1983"
            class="chronoswiss-intro-image"
        >
    </div>

    <div class="ml-bottom">
        <a href="javascript:void(0)" class="ml-discover">DISCOVER</a>
        <h2 class="ml-title">THE COLLECTIONS</h2>
    </div>
</section> 
    <section class="py-4">
        <style>
            .offcanvas-modern { font-family: 'Inter', Arial, sans-serif; background:#fff !important; color:#222; min-width:320px; max-width:380px; }
            @media (max-width: 767px) { .offcanvas-modern { min-width:100% !important; max-width:100% !important; width:100% !important; } }
            .offcanvas-modern .offcanvas-header { border-bottom:1px solid #fff; padding-bottom:0.5rem; background:#fff; }
            .offcanvas-modern .offcanvas-title { font-size:1.1rem; font-weight:400; letter-spacing:.02em; text-transform:uppercase; color:#222; }
            .offcanvas-modern .btn-close { filter:none; opacity:1; background-size:1em; width:1em; height:1em; }
            /* Simple SORT & FILTER button - no borders on any state */
            .filter .navbar-toggler { border:none !important; outline:none !important; box-shadow:none !important; background:transparent !important; padding:4px 10px; font-size:14px; line-height:1.1; display:flex; align-items:center; gap:6px; }
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
                    margin-right: 10px !important;
                    font-size: 12px !important;
                    padding: 4px 8px !important;
                }
            }
            /* Small mobile screens (576px to 767px) */
            @media (min-width: 576px) and (max-width: 767px) {
                .filter .navbar-toggler {

                margin-right: 15px !important;
                    font-size: 13px !important;
                }
            }
            /* Tablet screens (768px to 991px) */
            @media (min-width: 768px) and (max-width: 991px) {
                .filter .navbar-toggler {

                margin-right: 20px !important;
                }
            }
            /* Desktop screens (992px and above) */
            @media (min-width: 992px) {
                .filter .navbar-toggler {

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
                <img src="{{ asset('assets/f_assets/image/watch logo/Maurice Lacroix.png') }}" alt="Maurice Lacroix logo" class="brand-logo">
            </div>
            <button class="navbar-toggler border-0 text-black position-absolute end-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasMauriceLacroix" aria-controls="offcanvasMauriceLacroix" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span> SORT & FILTER
            </button>
        </div>

        <div class="container-fluid px-3">
        <div class="row onlineStore g-2 pt-3" id="mauriceLacroixGrid">
            @if(isset($products) && $products->count())
                @foreach($products as $prod)
                    <div class="col-6 col-sm-4 col-md-3 col-lg-3">
                        @include('public.partials.product-card-watches', ['product' => $prod])
                    </div>
                @endforeach
            @else
                <div class="col-12"><div class="text-center py-5 text-muted">No products available.</div></div>
            @endif
        </div>
        </div>
        
        <div class="text-center py-4 maurice-lacroix-footer">
        @if($products->count() > 0)
            @php
                $totalShown = $currentPageProducts;
                $hasMorePages = $products->currentPage() < $products->lastPage();
            @endphp
            @if($totalFilteredProducts > 0)
            <div class="products-counter" data-total="{{ $totalFilteredProducts }}" data-current="{{ $currentPageProducts }}" data-per-page="{{ $products->perPage() }}" data-current-page="{{ $products->currentPage() }}" style="font-size: 1rem; letter-spacing: 0.2em; margin-bottom: 1.5rem;">
                SHOWING {{ $currentPageProducts }} OF {{ $totalFilteredProducts }} PRODUCTS
            </div>
            @endif
            @php
                $allProductsShown = $totalShown >= $totalFilteredProducts;
                $shouldShowLoadMore = $hasMorePages && !$allProductsShown;
            @endphp
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
    </section>

    <div class="offcanvas offcanvas-end offcanvas-modern" tabindex="-1" id="offcanvasMauriceLacroix" aria-labelledby="offcanvasMauriceLacroixLabel" data-bs-backdrop="true" data-bs-scroll="false">
        <div class="offcanvas-header">
            <span class="offcanvas-title" id="offcanvasMauriceLacroixLabel">SORT & FILTER</span>
            <button type="button" class="btn-close btn-close-black" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <div>
                <div class="filter-section-title" onclick="toggleCategory('mauriceLacroixSortList', this.querySelector('.category-toggle'))" style="font-size: 14px !important;">
                    Sort By <span class="category-toggle">+</span>
                </div>
                <ul class="sort-list" id="mauriceLacroixSortList">
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
                <div class="filter-section-title" onclick="toggleCategory('mauriceLacroixGenderList', this.querySelector('.category-toggle'))" style="font-size: 14px !important;">Gender <span class="category-toggle">+</span></div>
                <ul class="category-list collapsible" id="mauriceLacroixGenderList">
                    @php $selectedTags = collect(explode(',', request('tags', '')))->map(fn($s)=>trim($s)); @endphp
                    <li><input type="checkbox" class="form-check-input filter-tag-checkbox maurice-lacroix-filter" data-group="gender" value="mens" {{ $selectedTags->contains('mens') ? 'checked' : '' }} onclick="event.stopPropagation();"> <span class="subcat-label">Men's</span></li>
                    <li><input type="checkbox" class="form-check-input filter-tag-checkbox maurice-lacroix-filter" data-group="gender" value="ladies" {{ $selectedTags->contains('ladies') ? 'checked' : '' }} onclick="event.stopPropagation();"> <span class="subcat-label">Ladies</span></li>
                </ul>
            </div>
            <div class="mt-3">
                <div class="filter-section-title" onclick="toggleCategory('mauriceLacroixSeriesList', this.querySelector('.category-toggle'))" style="font-size: 14px !important;">Series <span class="category-toggle">+</span></div>
                <ul class="category-list collapsible" id="mauriceLacroixSeriesList">
                    @php $series = ['pontos','aikon','fiaba','elisir','les-classiques','maurice-lacroix','masterpiece']; @endphp
                    @foreach($series as $s)
                        <li><input type="checkbox" class="form-check-input filter-tag-checkbox maurice-lacroix-filter" data-group="series" value="{{ $s }}" {{ $selectedTags->contains($s) ? 'checked' : '' }} onclick="event.stopPropagation();"> <span class="subcat-label">{{ ucwords(str_replace(['-', 'les'], [' ', 'Les'], $s)) }}</span></li>
                    @endforeach
                </ul>
            </div>
            <div class="mt-3">
                <div class="filter-section-title" onclick="toggleCategory('mauriceLacroixSizeList', this.querySelector('.category-toggle'))" style="font-size: 14px !important;">Case Size <span class="category-toggle">+</span></div>
                <ul class="category-list collapsible" id="mauriceLacroixSizeList">
                    @php $sizes = ['35','38','40','41','42','43','44','45']; @endphp
                    @foreach($sizes as $sz)
                        <li><input type="checkbox" class="form-check-input filter-tag-checkbox maurice-lacroix-filter" data-group="size" value="{{ $sz }}" {{ $selectedTags->contains($sz) ? 'checked' : '' }} onclick="event.stopPropagation();"> <span class="subcat-label">{{ $sz }}mm</span></li>
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
        const offcanvas = document.getElementById('offcanvasMauriceLacroix');
        function buildUrl() {
            const url = new URL(window.location.href);
            // Build unified tags param to match server-side filtering
            url.searchParams.delete('tags');
            url.searchParams.delete('gender');
            url.searchParams.delete('series');
            url.searchParams.delete('size');
            const selected = Array.from(document.querySelectorAll('.maurice-lacroix-filter:checked')).map(i=>i.value);
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
                    const incomingGrid = doc.querySelector('#mauriceLacroixGrid');
                    const grid = document.querySelector('#mauriceLacroixGrid');
                    
                    if (incomingGrid && grid) {
                        grid.innerHTML = incomingGrid.innerHTML;
                    }
                    
                    const incomingFooter = doc.querySelector('.maurice-lacroix-footer');
                    const footer = document.querySelector('.maurice-lacroix-footer');
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
            const sortList = document.getElementById('mauriceLacroixSortList');
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
        document.querySelectorAll('.maurice-lacroix-filter').forEach(cb => {
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
                return container.querySelector('#mauriceLacroixGrid');
            }

            function appendIncomingItems(doc) {
                const currentGrid = getGrid(document);
                if (!currentGrid) return 0;

                // Primary: take children of incoming #mauriceLacroixGrid
                let nodesToAppend = [];
                const incomingGrid = getGrid(doc) || doc.querySelector('#mauriceLacroixGrid');
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
                const counter = document.querySelector('.maurice-lacroix-footer .products-counter');
                
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
                            const currentGrid = document.querySelector('#mauriceLacroixGrid');
                            const incomingGrid2 = doc.querySelector('#mauriceLacroixGrid');
                            if (currentGrid && incomingGrid2) {
                                currentGrid.insertAdjacentHTML('beforeend', incomingGrid2.innerHTML);
                                appended = incomingGrid2.children.length;
                                window.updateCounter();
                            }
                        }
                        
                        // Check if we've reached the end
                        const currentTotal = parseInt(btn.getAttribute('data-total') || total, 10);
                        const currentGrid = document.querySelector('#mauriceLacroixGrid');
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
@endsection




