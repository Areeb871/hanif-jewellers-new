@extends('public.layouts.header_black_white_fixed')

@section('content')
<style>
@media (max-width: 767px) {
    .gehnawaSection {
        height: auto !important;
        min-height: 0 !important;
        margin: 0 !important;
        padding: 0 !important;
        line-height: 0;
        z-index: 0 !important;
    }
}
</style>
    @if(isset($versaceSubcategory) && $versaceSubcategory && $versaceSubcategory->banner_url)
        <section class="gehnawaSection p-0 position-relative">
            {{-- Desktop Video --}}
            @if(Str::endsWith($versaceSubcategory->banner_url, ['.mp4', '.webm', '.ogg']))
                <video 
                    autoplay 
                    loop 
                    muted 
                    playsinline 
                    class="video-desktop d-none d-md-block"
                    style="width:100%; height:120vh; object-fit:cover;"
                    onerror="this.style.display='none'; this.nextElementSibling.style.display='block';">
                    <source src="{{ asset($versaceSubcategory->banner_url) }}" type="video/{{ pathinfo($versaceSubcategory->banner_url, PATHINFO_EXTENSION) }}">
                    Your browser does not support the video tag.
                </video>
                {{-- Fallback image for desktop --}}
                <!-- <div class="video-fallback-desktop d-none d-md-block" style="display:none; width:100%; height:120vh; background-image:url('{{ asset($versaceSubcategory->banner_url) }}'); background-size:cover; background-position:center;"></div> -->
            @else
                {{-- Static image for desktop --}}
                <div class="d-none d-md-block" style="width:100%; height:120vh; background-image:url('{{ asset($versaceSubcategory->banner_url) }}'); background-size:cover; background-position:center;"></div>
            @endif

            {{-- Mobile Video (Dynamic based on subcategory) --}}
            @php
                $mobileVideo = null;
                $mobileVideoPath = 'assets/f_assets/image/watches mobile view/versache_mobile.webm'; // Corrected path without assets/ prefix

                if ($versaceSubcategory->slug === 'versace') {
                    $mobileVideo = $mobileVideoPath;
                } else {
                    // fallback if no specific mobile version exists
                    $mobileVideo = $versaceSubcategory->banner_url;
                }
            @endphp

            @if(Str::endsWith($mobileVideo, ['.mp4', '.webm', '.ogg']))
                <video 
                    autoplay 
                    loop 
                    muted 
                    playsinline 
                    class="video-mobile d-block d-md-none"
                    style="width:100%; height:auto; object-fit:contain; display:block;"
                    onerror="this.style.display='none'; this.nextElementSibling.style.display='block';">
                    <source src="{{ asset($mobileVideo) }}" type="video/{{ pathinfo($mobileVideo, PATHINFO_EXTENSION) }}">
                    Your browser does not support the video tag.
                </video>
                {{-- Fallback image for mobile --}}
                <div class="video-fallback-mobile d-md-none" style="display:none; width:100%; height:auto; background-image:url('{{ asset($mobileVideo) }}'); background-size:contain; background-repeat:no-repeat; background-position:center;"></div>
            @else
                {{-- Static image for mobile --}}
                <img src="{{ asset($mobileVideo) }}" alt="{{ $versaceSubcategory->name ?? 'Banner' }}" class="d-block d-md-none" style="width:100%; height:auto; display:block; object-fit:contain;">
            @endif
        </section>
    @endif

    <section class="">
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
            .versace-brand-bar {
                padding-top: 2.45rem;
            }
            .versace-brand-bar .brand-logo-wrapper {
                margin: 0;
            }
            /* Responsive logo sizing */
            @media (max-width: 575px) {
                .brand-logo {
                    width: 40%;
                }
                .versace-brand-bar {
                    padding: 1rem 0;
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
            @media (min-width: 992px) {
                .versace-hero-row {
                    display: grid;
                    grid-template-columns: 1fr 1fr 1fr 1fr;
                    grid-template-rows: auto auto;
                    gap: 0.5rem;
                }
                .versace-hero-card:nth-child(1) { grid-column: 1; grid-row: 1; }
                .versace-hero-card:nth-child(2) { grid-column: 2; grid-row: 1; }
                .versace-hero-card:nth-child(3) { grid-column: 1; grid-row: 2; }
                .versace-hero-card:nth-child(4) { grid-column: 2; grid-row: 2; }
                .versace-hero-row > .versace-inline-banner {
                    grid-column: 3 / 5;
                    grid-row: 1 / 3;
                    position: relative;
                    overflow: hidden;
                    min-height: 0;
                }
                .versace-hero-row > .versace-inline-banner img {
                    position: absolute;
                    inset: 0;
                    width: 100%;
                    height: 100%;
                    object-fit: cover;
                    display: block;
                }
            }
            @media (max-width: 991.98px) {
                .versace-hero-row {
                    display: grid;
                    grid-template-columns: 1fr 1fr;
                    gap: 0.5rem;
                }
                .versace-hero-card:nth-child(1) { grid-column: 1; grid-row: 1; }
                .versace-hero-card:nth-child(2) { grid-column: 2; grid-row: 1; }
                .versace-hero-card:nth-child(3) { grid-column: 1; grid-row: 2; }
                .versace-hero-card:nth-child(4) { grid-column: 2; grid-row: 2; }
                .versace-hero-row > .versace-inline-banner {
                    grid-column: 1 / -1;
                    grid-row: 3;
                }
                .versace-inline-banner img {
                    position: static;
                    width: 100%;
                    height: auto;
                    object-fit: contain;
                    display: block;
                }
            }
        </style>
     <div class="navbar navbar-white align-items-center filter position-relative justify-content-center versace-brand-bar">
            <div class="brand-logo-wrapper w-70 text-center">
                <img src="{{ asset('assets/f_assets/image/watch logo/Versace.png') }}" alt="Versace logo" class="brand-logo">
            </div>
        </div>
        <div class="filter d-flex justify-content-end px-3">
            <button class="navbar-toggler border-0 text-black" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasVersace" aria-controls="offcanvasVersace" aria-label="Toggle navigation" style="position:static!important; margin:0!important;">
                <span class="navbar-toggler-icon"></span> SORT & FILTER
            </button>
        </div>

        <div class="container-fluid px-3">
        <div class="row onlineStore g-2 pt-3" id="versaceGrid">
            @if(isset($products) && $products->count())
                @php
                    $showHero = $products->currentPage() == 1;
                    $heroProducts = $showHero ? $products->take(4) : collect();
                    $gridProducts = $showHero ? $products->slice(4) : $products;
                @endphp

                @if($showHero)
                    <div class="col-12">
                        <div class="versace-hero-row">
                            @foreach($heroProducts as $prod)
                                <div class="versace-hero-card">
                                    @include('public.partials.product-card-watches', ['product' => $prod])
                                </div>
                            @endforeach
                            <div class="versace-inline-banner">
                                <img src="{{ asset('assets/f_assets/image/versace-grid.jpeg') }}" alt="Versace">
                            </div>
                        </div>
                    </div>
                @endif

                @foreach($gridProducts as $prod)
                    <div class="col-6 col-sm-4 col-md-3 col-lg-3">
                        @include('public.partials.product-card-watches', ['product' => $prod])
                    </div>
                @endforeach
            @else
                <div class="col-12"><div class="text-center py-5 text-muted">Collection to be Revealed Soon!.</div></div>
            @endif
        </div>
        </div>
        
        <div class="text-center py-5 versace-footer">
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
            @endif
        </div>
    </section>

    <div class="offcanvas offcanvas-end offcanvas-modern" tabindex="-1" id="offcanvasVersace" aria-labelledby="offcanvasVersaceLabel" data-bs-backdrop="true" data-bs-scroll="false">
        <div class="offcanvas-header">
            <span class="offcanvas-title" id="offcanvasVersaceLabel">SORT & FILTER</span>
            <button type="button" class="btn-close btn-close-black" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <div>
                <div class="filter-section-title" onclick="toggleCategory('versaceSortList', this.querySelector('.category-toggle'))" style="font-size: 14px !important;">
                    Sort By <span class="category-toggle">+</span>
                </div>
                <ul class="sort-list" id="versaceSortList">
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
                <div class="filter-section-title" onclick="toggleCategory('versaceGenderList', this.querySelector('.category-toggle'))" style="font-size: 14px !important;">Gender <span class="category-toggle">+</span></div>
                <ul class="category-list collapsible" id="versaceGenderList">
                    @php $selectedTags = collect(explode(',', request('tags', '')))->map(fn($s)=>trim($s)); @endphp
                    <li><input type="checkbox" class="form-check-input filter-tag-checkbox versace-filter" data-group="gender" value="mens" {{ $selectedTags->contains('mens') ? 'checked' : '' }} onclick="event.stopPropagation();"> <span class="subcat-label">Men's</span></li>
                    <li><input type="checkbox" class="form-check-input filter-tag-checkbox versace-filter" data-group="gender" value="ladies" {{ $selectedTags->contains('ladies') ? 'checked' : '' }} onclick="event.stopPropagation();"> <span class="subcat-label">Ladies</span></li>
                </ul>
            </div>
            <div class="mt-3">
                <div class="filter-section-title" onclick="toggleCategory('versaceSeriesList', this.querySelector('.category-toggle'))" style="font-size: 14px !important;">Series <span class="category-toggle">+</span></div>
                <ul class="category-list collapsible" id="versaceSeriesList">
                    @php $series = ['medusa','greca','dv-one','v-race','hellenistic']; @endphp
                    @foreach($series as $s)
                        <li><input type="checkbox" class="form-check-input filter-tag-checkbox versace-filter" data-group="series" value="{{ $s }}" {{ $selectedTags->contains($s) ? 'checked' : '' }} onclick="event.stopPropagation();"> <span class="subcat-label">{{ ucwords(str_replace('-', ' ', $s)) }}</span></li>
                    @endforeach
                </ul>
            </div>
            <div class="mt-3">
                <div class="filter-section-title" onclick="toggleCategory('versaceSizeList', this.querySelector('.category-toggle'))" style="font-size: 14px !important;">Case Size <span class="category-toggle">+</span></div>
                <ul class="category-list collapsible" id="versaceSizeList">
                    @php $sizes = ['25','27','28','30','32','34','35','36','37','38','40','41','42','43','44','45']; @endphp
                    @foreach($sizes as $sz)
                        <li><input type="checkbox" class="form-check-input filter-tag-checkbox versace-filter" data-group="size" value="{{ $sz }}" {{ $selectedTags->contains($sz) ? 'checked' : '' }} onclick="event.stopPropagation();"> <span class="subcat-label">{{ $sz }}mm</span></li>
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
        const offcanvas = document.getElementById('offcanvasVersace');
        function buildUrl() {
            const url = new URL(window.location.href);
            // Build unified tags param to match server-side filtering
            url.searchParams.delete('tags');
            url.searchParams.delete('gender');
            url.searchParams.delete('size');
            url.searchParams.delete('movement');
            url.searchParams.delete('caseType');
            const selected = Array.from(document.querySelectorAll('.versace-filter:checked')).map(i=>i.value);
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
                    const incomingGrid = doc.querySelector('#versaceGrid');
                    const grid = document.querySelector('#versaceGrid');
                    
                    if (incomingGrid && grid) {
                        grid.innerHTML = incomingGrid.innerHTML;
                    }
                    
                    const incomingFooter = doc.querySelector('.versace-footer');
                    const footer = document.querySelector('.versace-footer');
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
            const sortList = document.getElementById('versaceSortList');
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
        document.querySelectorAll('.versace-filter').forEach(cb => {
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
                return container.querySelector('#versaceGrid');
            }

            function appendIncomingItems(doc) {
                const currentGrid = getGrid(document);
                if (!currentGrid) return 0;

                // Primary: take children of incoming #versaceGrid
                let nodesToAppend = [];
                const incomingGrid = getGrid(doc) || doc.querySelector('#versaceGrid');
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
                const counter = document.querySelector('.text-center .products-counter');
                
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
                            const currentGrid = document.querySelector('#versaceGrid');
                            const incomingGrid2 = doc.querySelector('#versaceGrid');
                            if (currentGrid && incomingGrid2) {
                                currentGrid.insertAdjacentHTML('beforeend', incomingGrid2.innerHTML);
                                appended = incomingGrid2.children.length;
                                window.updateCounter();
                            }
                        }
                        
                        // Check if we've reached the end
                        const currentTotal = parseInt(btn.getAttribute('data-total') || total, 10);
                        const currentGrid = document.querySelector('#versaceGrid');
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
