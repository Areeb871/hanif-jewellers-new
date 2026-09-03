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
</style>

@if(isset($louisMoinetSubcategory) && $louisMoinetSubcategory && $louisMoinetSubcategory->banner_url)

    @php
        $desktopBanner = $louisMoinetSubcategory->banner_url;
        $desktopIsVideo = \Illuminate\Support\Str::endsWith(strtolower($desktopBanner), ['.mp4', '.webm', '.ogg']);

        /* Dedicated mobile banner */
        $mobileBanner = 'assets/f_assets/image/watches mobile view/LM-mobile-view.mp4';


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
            <img src="{{ asset($desktopBanner) }}" alt="{{ $louisMoinetSubcategory->name ?? 'Banner' }}">
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
            <img src="{{ asset($mobileBanner) }}" alt="{{ $louisMoinetSubcategory->name ?? 'Banner' }}">
        @endif
    </section>

@endif
    
       <section >
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
                                        margin-top:-85px;
                    margin-right: 10px !important;
                    font-size: 12px !important;
                    padding: 4px 8px !important;
                }
            }
            /* Small mobile screens (576px to 767px) */
            @media (min-width: 576px) and (max-width: 767px) {
                .filter .navbar-toggler {
                    margin-top:-85px;
                margin-right: 15px !important;
                    font-size: 13px !important;
                }
            }
            /* Tablet screens (768px to 991px) */
            @media (min-width: 768px) and (max-width: 991px) {
                .filter .navbar-toggler {
                    margin-top:-85px;
                margin-right: 20px !important;
                }
            }
            /* Desktop screens (992px and above) */
            @media (min-width: 992px) {
                .filter .navbar-toggler {
                    margin-top:-85px;
                margin-right: 23px !important;
                }
            }

.louis-moinet-header{
    text-align: center;
    max-width: 1100px;
    margin: 0 auto;
    position: relative;
    z-index: 2;
}

.louis-moinet-logo{
    text-align: center;
    margin: 30px 0px;
}

.louis-moinet-logo img{
    display: block;
    width: 190px;
    max-width: 100%;
    height: auto;
    margin: 0 auto;
    transform: translateY(-20px); /* move slightly up */
}

.louis-moinet-text p{
    max-width: 780px;
    font-family:"Poppins", sans-serif;
    font-size:13px;
    line-height:1.59;
    color:#111;
    margin:0 auto;
    text-align:center;
}

.louis-moinet-text strong{
    font-weight:600;
}

.louis-moinet-text h3{
    font-family:"Argent CF", Georgia, serif;
    font-size:24px;
    font-weight:700;
    line-height:normal;
    letter-spacing:.04em;
    /* margin:50px 0 0; */
    margin: 70px 0 25px;
    text-transform:uppercase;
}
/* Tablet */
@media (max-width: 992px){

.louis-moinet-header{
    padding:34px 20px;
}

.louis-moinet-logo img{
    max-width:180px;
    margin-bottom:20px;
}

.louis-moinet-text p{
    font-size:13px;
    line-height:1.59;
}

.louis-moinet-text h3{
    font-size:24px;
    margin-top:34px;
}

}


/* Mobile */
@media (max-width: 768px){

.louis-moinet-header{
    padding:34px 20px;
}

.louis-moinet-logo img{
    max-width:150px;
    margin-bottom:18px;
}

.louis-moinet-text p{
    font-size:13px;
    line-height:1.59;
    margin-bottom:14px;
}

.louis-moinet-text h3{
    font-size:18px;
    margin-top:34px;
}

}


/* Small Mobile */
@media (max-width: 480px){

.louis-moinet-logo img{
    max-width:130px;
}

.louis-moinet-text p{
    font-size:13px;
    line-height:1.59;
}

.louis-moinet-text h3{
    font-size:18px;
}

}

/* Match Bovet collection typography and spacing. */

.louis-moinet-logo img{
    transform:none;
    margin-bottom:24px;
}

.filter{
    justify-content:flex-end !important;
    padding:14px 14px !important;
    background:#fff;
}

.filter .navbar-toggler{
    position:static !important;
    margin:0 !important;
    padding:6px 8px !important;
    font-family:"Poppins", sans-serif;
    font-size:12px !important;
    line-height:1 !important;
}

.louis-moinet-footer .products-counter,
.louis-moinet-footer #loadMoreBtn{
    font-family:"Poppins", sans-serif !important;
}

.louis-moinet-footer .products-counter{
    font-size:.8rem !important;
    letter-spacing:.2em;
    margin-bottom: 1.5rem;
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
<div class="louis-moinet-header">

    <!-- Logo -->
    <div class="louis-moinet-logo">
        <img src="{{ asset('assets/f_assets/image/watch logo/lm.png') }}" alt="Louis Moinet">
    </div>

    <!-- Text -->
    <div class="louis-moinet-text">
        <p>
            Louis Moinet today is an independent watch brand located in Saint-Blaise, Switzerland,
            specialising in the creation of high-end timepieces, often featuring exotic materials
            and innovative technology, underpinned by the philosophy of limited edition mechanical art.
        </p>
        <br/>

        <p>
            All of Louis Moinet’s timepieces are either exclusive limited editions or unique pieces.
        </p>

        <p>
            <strong>Uniqueness, Creative Horology, Exclusivity and Art & Design are at the heart of
            Louis Moinet creations.</strong>
        </p>

        <h3>DISCOVER THE CREATIONS</h3>
    </div>

</div>


         <div class="navbar navbar-white align-items-center filter position-relative justify-content-center">
            <div class="brand-logo-wrapper w-70 my-3 text-center"style="display:none;">
                <img src="{{ asset('assets/f_assets/image/watch logo/Maurice Lacroix.png') }}" alt="Maurice Lacroix logo" class="brand-logo">
            </div>
            <button class="navbar-toggler border-0 text-black position-absolute end-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasLouisMoinet" aria-controls="offcanvasLouisMoinet" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span> SORT & FILTER
            </button>
        </div>
  <div class="container-fluid px-3">
    <div class="row onlineStore g-2" id="louisMoinetGrid">
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
        <div class="text-center py-5 louis-moinet-footer">
        @if($products->count() > 0)
            @php
                $totalShown = $currentPageProducts;
                $hasMorePages = $products->currentPage() < $products->lastPage();
            @endphp
            @if($totalFilteredProducts > 0)
            <div class="products-counter" data-total="{{ $totalFilteredProducts }}" data-current="{{ $currentPageProducts }}" data-per-page="{{ $products->perPage() }}" data-current-page="{{ $products->currentPage() }}">
                SHOWING {{ $currentPageProducts }} OF {{ $totalFilteredProducts }} PRODUCTS
            </div>
            @endif
            @php
                $allProductsShown = $totalShown >= $totalFilteredProducts;
                $shouldShowLoadMore = $hasMorePages && !$allProductsShown;
            @endphp
            @if($shouldShowLoadMore)
                <button id="loadMoreBtn"
                        style="background: #e3e4e5; border: none; color: #222; font-size: 0.7rem; letter-spacing: 0.15em; padding: 0.8rem 2rem; border-radius: 8px; font-family: 'Poppins', sans-serif; font-weight: 400; box-shadow: none; transition: background 0.2s;"
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

    <div class="offcanvas offcanvas-end offcanvas-modern" tabindex="-1" id="offcanvasLouisMoinet" aria-labelledby="offcanvasLouisMoinetLabel" data-bs-backdrop="true" data-bs-scroll="false">
        <div class="offcanvas-header">
            <span class="offcanvas-title" id="offcanvasLouisMoinetLabel">SORT & FILTER</span>
            <button type="button" class="btn-close btn-close-black" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <div>
                <div class="filter-section-title" onclick="toggleCategory('louisMoinetSortList', this.querySelector('.category-toggle'))" style="font-size: 14px !important;">
                    Sort By <span class="category-toggle">−</span>
                </div>
                <ul class="sort-list show" id="louisMoinetSortList">
                    @php $currentSort = request('sort'); @endphp
                    <!-- <li data-value="" class="{{ !$currentSort ? 'selected' : '' }}">
                        <span class="diamond">{{ !$currentSort ? '◆' : '◇' }}</span> Best Selling
                    </li> -->
                    <li data-value="az" class="{{ $currentSort=='az' ? 'selected' : '' }}">
                        <span class="diamond">{{ $currentSort=='az' ? '◆' : '◇' }}</span> Alphabetically, A-Z
                    </li>
                    <li data-value="za" class="{{ $currentSort=='za' ? 'selected' : '' }}">
                        <span class="diamond">{{ $currentSort=='za' ? '◆' : '◇' }}</span> Alphabetically, Z-A
                    </li>
                    <!-- <li data-value="price_low_high" class="{{ $currentSort=='price_low_high' ? 'selected' : '' }}">
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
                    </li> -->
                </ul>
            </div>
            <div>
                <div class="filter-section-title" onclick="toggleCategory('louisMoinetGenderList', this.querySelector('.category-toggle'))" style="font-size: 14px !important;">Gender <span class="category-toggle">+</span></div>
                <ul class="category-list collapsible" id="louisMoinetGenderList">
                    @php $selectedTags = collect(explode(',', request('tags', '')))->map(fn($s)=>trim($s)); @endphp
                    <li><input type="checkbox" class="form-check-input filter-tag-checkbox louis-moinet-filter" data-group="gender" value="mens" {{ $selectedTags->contains('mens') ? 'checked' : '' }} onclick="event.stopPropagation();"> <span class="subcat-label">Men's</span></li>
                    <li><input type="checkbox" class="form-check-input filter-tag-checkbox louis-moinet-filter" data-group="gender" value="ladies" {{ $selectedTags->contains('ladies') ? 'checked' : '' }} onclick="event.stopPropagation();"> <span class="subcat-label">Ladies</span></li>
                </ul>
            </div>
            <div class="mt-3">
                <div class="filter-section-title" onclick="toggleCategory('louisMoinetCollectionList', this.querySelector('.category-toggle'))" style="font-size: 14px !important;">Series <span class="category-toggle">+</span></div>
                <ul class="category-list collapsible" id="louisMoinetCollectionList">
                    @php $collections = ['memoris','time-to-race','tempograph','super-moon','mars-mission', 'metropolis', 'tourbillon', 'allende-meteorite', 'derrick', 'mars-red', 'geograph', 'skylink']; @endphp
                    @foreach($collections as $c)
                        <li><input type="checkbox" class="form-check-input filter-tag-checkbox louis-moinet-filter" data-group="collection" value="{{ $c }}" {{ $selectedTags->contains($c) ? 'checked' : '' }} onclick="event.stopPropagation();"> <span class="subcat-label">{{ ucwords(str_replace('-', ' ', $c)) }}</span></li>
                    @endforeach
                </ul>
            </div>
            <div class="mt-3">
                <div class="filter-section-title" onclick="toggleCategory('louisMoinetSizeList', this.querySelector('.category-toggle'))" style="font-size: 14px !important;">Case Size <span class="category-toggle">+</span></div>
                <ul class="category-list collapsible" id="louisMoinetSizeList">
                   @php $sizes = ['40','40.6 ','43','44','45']; @endphp
                    @foreach($sizes as $sz)
                        <li><input type="checkbox" class="form-check-input filter-tag-checkbox louis-moinet-filter" data-group="size" value="{{ $sz }}" {{ $selectedTags->contains($sz) ? 'checked' : '' }} onclick="event.stopPropagation();"> <span class="subcat-label">{{ $sz }}mm</span></li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>

    <script>
    function toggleCategory(targetId, element) {
        const target = document.getElementById(targetId);
        if (!target) {
            console.error('Target element not found:', targetId);
            return;
        }
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
        const offcanvas = document.getElementById('offcanvasLouisMoinet');
        function buildUrl() {
            const url = new URL(window.location.href);
            // Build unified tags param to match server-side filtering
            url.searchParams.delete('tags');
            url.searchParams.delete('gender');
            url.searchParams.delete('series');
            url.searchParams.delete('size');
            const selected = Array.from(document.querySelectorAll('.louis-moinet-filter:checked')).map(i=>i.value);
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
                    const incomingGrid = doc.querySelector('#louisMoinetGrid');
                    const grid = document.querySelector('#louisMoinetGrid');
                    
                    if (incomingGrid && grid) {
                        grid.innerHTML = incomingGrid.innerHTML;
                    }
                    
                    const incomingFooter = doc.querySelector('.louis-moinet-footer');
                    const footer = document.querySelector('.louis-moinet-footer');
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
            const sortList = document.getElementById('louisMoinetSortList');
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
        document.querySelectorAll('.louis-moinet-filter').forEach(cb => {
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
                return container.querySelector('#louisMoinetGrid');
            }

            function appendIncomingItems(doc) {
                const currentGrid = getGrid(document);
                if (!currentGrid) return 0;

                // Primary: take children of incoming #louisMoinetGrid
                let nodesToAppend = [];
                const incomingGrid = getGrid(doc) || doc.querySelector('#louisMoinetGrid');
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
                const counter = document.querySelector('.louis-moinet-footer .products-counter');
                
                if (counter) {
                    // Get the total from data attribute (set by server)
                    const total = parseInt(counter.getAttribute('data-total') || '0', 10);
                    const perPage = parseInt(counter.getAttribute('data-per-page') || '20', 10);
                    
                    // Update the current count
                    counter.setAttribute('data-current', totalShown);
                    
                    // Update the display text with actual counts
                    counter.textContent = `SHOWING ${totalShown} OF ${total} PRODUCTS`;
                    
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
                            const currentGrid = document.querySelector('#louisMoinetGrid');
                            const incomingGrid2 = doc.querySelector('#louisMoinetGrid');
                            if (currentGrid && incomingGrid2) {
                                currentGrid.insertAdjacentHTML('beforeend', incomingGrid2.innerHTML);
                                appended = incomingGrid2.children.length;
                                window.updateCounter();
                            }
                        }
                        
                        // Check if we've reached the end
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
        
        // Debug: Log that JavaScript is loaded
        console.log('Louis Moinet collection JavaScript loaded');
        console.log('Sort list element:', document.getElementById('louisMoinetSortList'));
        console.log('Gender list element:', document.getElementById('louisMoinetGenderList'));
        console.log('Collection list element:', document.getElementById('louisMoinetCollectionList'));
        console.log('Size list element:', document.getElementById('louisMoinetSizeList'));
    });
    </script>
@endsection
