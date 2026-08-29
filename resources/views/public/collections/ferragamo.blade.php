@extends('public.layouts.header_black_white_fixed')

@section('content')
    @if(isset($ferragamoSubcategory) && $ferragamoSubcategory && $ferragamoSubcategory->banner_url)
        <section class="gehnawaSection p-0 position-relative">
            {{-- Desktop Video --}}
            @if(Str::endsWith($ferragamoSubcategory->banner_url, ['.mp4', '.webm', '.ogg']))
                <video 
                    autoplay 
                    loop 
                    muted 
                    playsinline 
                    class="video-desktop d-none d-md-block"
                    style="width:100%; height:120vh; object-fit:cover;"
                    onerror="this.style.display='none'; this.nextElementSibling.style.display='block';">
                    <source src="{{ asset($ferragamoSubcategory->banner_url) }}" type="video/{{ pathinfo($ferragamoSubcategory->banner_url, PATHINFO_EXTENSION) }}">
                    Your browser does not support the video tag.
                </video>
                {{-- Fallback image for desktop --}}
                <!-- <div class="video-fallback-desktop d-none d-md-block" style="display:none; width:100%; height:120vh; background-image:url('{{ asset($ferragamoSubcategory->banner_url) }}'); background-size:cover; background-position:center;"></div> -->
            @else
                {{-- Static image for desktop --}}
                <div class="d-none d-md-block" style="width:100%; height:120vh; background-image:url('{{ asset($ferragamoSubcategory->banner_url) }}'); background-size:cover; background-position:center;"></div>
            @endif

            {{-- Mobile Video --}}
            @php
                $mobileVideo = null;
                $mobileVideoPath = 'assets/f_assets/image/watches mobile view/ferregamo_new.mp4';

                if ($ferragamoSubcategory->slug === 'ferragamo') {
                    $mobileVideo = $mobileVideoPath;
                } else {
                    $mobileVideo = $ferragamoSubcategory->banner_url;
                }
            @endphp

            @if(Str::endsWith($mobileVideo, ['.mp4', '.webm', '.ogg']))
                <video 
                    autoplay 
                    loop 
                    muted 
                    playsinline 
                    class="video-mobile d-block d-md-none"
                    style="width:100%; height:120vh; object-fit:cover;"
                    onerror="this.style.display='none'; this.nextElementSibling.style.display='block';">
                    <source src="{{ asset($mobileVideo) }}" type="video/{{ pathinfo($mobileVideo, PATHINFO_EXTENSION) }}">
                    Your browser does not support the video tag.
                </video>
                {{-- Fallback image for mobile --}}
                <div class="video-fallback-mobile d-block d-md-none" style="display:none; width:100%; height:120vh; background-image:url('{{ asset($mobileVideo) }}'); background-size:cover; background-position:center;"></div>
            @else
                {{-- Static image for mobile --}}
                <div class="d-block d-md-none" style="width:100%; height:120vh; background-image:url('{{ asset($mobileVideo) }}'); background-size:cover; background-position:center;"></div>
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
            .filter-tag-checkbox {
                margin-right: 8px;
            }
            /* Center Discover More button in product cards */
            #ferragamoGrid .discover-more-btn,
            #ferragamoGrid .addToCartProductDetails {
                display: block !important;
                margin: 0 auto !important;
                text-align: center !important;
                width: auto !important;
            }
            #ferragamoGrid .card-body {
                text-align: center !important;
            }
            #ferragamoGrid .card-body .btn {
                margin-left: auto !important;
                margin-right: auto !important;
            }
           .brand-logo {
                display: block;
                margin-left: auto;
                margin-right: auto;
                width: 12%;
                height: auto;
            }
            /* .ferragamo-brand-bar {
                padding: 0.75rem 0;
            } */
            .ferragamo-brand-bar .brand-logo-wrapper {
                margin-top: 30px;
            }
            /* Responsive logo sizing */
            @media (max-width: 575px) {
                .brand-logo {
                    width: 45%;
                }
                .ferragamo-brand-bar {
                    padding: 0.5rem 0;
                }
            }
            @media (min-width: 576px) and (max-width: 767px) {
                .brand-logo {
                    width: 35%;
                }
            }
            @media (min-width: 768px) and (max-width: 991px) {
                .brand-logo {
                    width: 24%;
                }
            }
            @media (min-width: 992px) {
                .brand-logo {
                    width: 24%;
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
                .ferragamo-hero-row {
                    display: grid;
                    grid-template-columns: 1fr 1fr 1fr 1fr;
                    grid-template-rows: auto auto;
                    gap: 0.5rem;
                }
                .ferragamo-hero-card:nth-child(1) { grid-column: 1; grid-row: 1; }
                .ferragamo-hero-card:nth-child(2) { grid-column: 2; grid-row: 1; }
                .ferragamo-hero-card:nth-child(3) { grid-column: 1; grid-row: 2; }
                .ferragamo-hero-card:nth-child(4) { grid-column: 2; grid-row: 2; }
                .ferragamo-hero-row > .ferragamo-inline-banner {
                    grid-column: 3 / 5;
                    grid-row: 1 / 3;
                    position: relative;
                    overflow: hidden;
                    min-height: 0;
                }
                .ferragamo-hero-row > .ferragamo-inline-banner img {
                    position: absolute;
                    inset: 0;
                    width: 100%;
                    height: 100%;
                    object-fit: cover;
                    display: block;
                }
            }
            @media (max-width: 991.98px) {
                .ferragamo-hero-row {
                    display: grid;
                    grid-template-columns: 1fr 1fr;
                    gap: 0.5rem;
                }
                .ferragamo-hero-card:nth-child(1) { grid-column: 1; grid-row: 1; }
                .ferragamo-hero-card:nth-child(2) { grid-column: 2; grid-row: 1; }
                .ferragamo-hero-card:nth-child(3) { grid-column: 1; grid-row: 2; }
                .ferragamo-hero-card:nth-child(4) { grid-column: 2; grid-row: 2; }
                .ferragamo-hero-row > .ferragamo-inline-banner {
                    grid-column: 1 / -1;
                    grid-row: 3;
                }
                .ferragamo-inline-banner img {
                    position: static;
                    width: 100%;
                    height: auto;
                    object-fit: contain;
                    display: block;
                }
            }
        </style>

        <div class="navbar navbar-white align-items-center filter position-relative justify-content-center ferragamo-brand-bar">
            <div class="brand-logo-wrapper w-70 text-center">
                <img src="{{ asset('assets/f_assets/image/watch logo/Ferragamo.png') }}" alt="Ferragamo logo" class="brand-logo">
            </div>
        </div>
        <div class="filter d-flex justify-content-end px-3">
            <button class="navbar-toggler border-0 text-black" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasFerragamo" aria-controls="offcanvasFerragamo" aria-label="Toggle navigation" style="position:static!important; margin:0!important;">
                <span class="navbar-toggler-icon"></span> SORT & FILTER
            </button>
        </div>

        <div class="container-fluid px-3">
        <div class="row onlineStore g-2 pt-3" id="ferragamoGrid">
            @if(isset($products) && $products->count())
                @php
                    $showHero = $products->currentPage() == 1;
                    $heroProducts = $showHero ? $products->take(4) : collect();
                    $gridProducts = $showHero ? $products->slice(4) : $products;
                @endphp

                @if($showHero)
                    <div class="col-12">
                        <div class="ferragamo-hero-row">
                            @foreach($heroProducts as $prod)
                                <div class="ferragamo-hero-card">
                                    @include('public.partials.product-card-watches', ['product' => $prod])
                                </div>
                            @endforeach
                            <div class="ferragamo-inline-banner">
                                <img src="{{ asset('assets/f_assets/image/ferragamo-grid.jpeg') }}" alt="Ferragamo">
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
                <div class="col-12"><div class="text-center py-5 text-muted">Collection to be Revealed Soon!</div></div>
            @endif
        </div>
        </div>
        
        <div class="text-center py-5 ferragamo-footer">
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
                <div class="d-flex justify-content-center">
                    <button id="loadMoreBtn"
                            style="background: #e3e4e5; border: none; color: #222; font-family: 'Poppins', sans-serif; font-size: 0.7rem; letter-spacing: 0.15em; padding: 0.8rem 2rem; border-radius: 8px; font-weight: 400; box-shadow: none; transition: background 0.2s; display: inline-block; margin: 0 auto;"
                            data-page="{{ $products->currentPage() + 1 }}"
                            data-last-page="{{ $products->lastPage() }}"
                            data-per-page="{{ $products->perPage() }}"
                            data-total="{{ $totalFilteredProducts }}">
                        LOAD MORE
                    </button>
                </div>
            @endif
        </div>
        @endif
    </section>

    <div class="offcanvas offcanvas-end offcanvas-modern" tabindex="-1" id="offcanvasFerragamo" aria-labelledby="offcanvasFerragamoLabel" data-bs-backdrop="true" data-bs-scroll="false">
        <div class="offcanvas-header">
            <span class="offcanvas-title" id="offcanvasFerragamoLabel">SORT & FILTER</span>
            <button type="button" class="btn-close btn-close-black" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <div>
                <div class="filter-section-title" onclick="toggleCategory('ferragamoSortList', this.querySelector('.category-toggle'))" style="font-size: 14px !important;">
                    Sort By <span class="category-toggle">+</span>
                </div>
                <ul class="sort-list" id="ferragamoSortList">
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
                <div class="filter-section-title" onclick="toggleCategory('ferragamoGenderList', this.querySelector('.category-toggle'))" style="font-size: 14px !important;">Gender <span class="category-toggle">+</span></div>
                <ul class="category-list collapsible" id="ferragamoGenderList">
                    @php $selectedTags = collect(explode(',', request('tags', '')))->map(fn($s)=>trim($s)); @endphp
                    <li><input type="checkbox" class="form-check-input filter-tag-checkbox ferragamo-filter" data-group="gender" value="mens" {{ $selectedTags->contains('mens') ? 'checked' : '' }} onclick="event.stopPropagation();"> <span class="subcat-label">Men's</span></li>
                    <li><input type="checkbox" class="form-check-input filter-tag-checkbox ferragamo-filter" data-group="gender" value="ladies" {{ $selectedTags->contains('ladies') ? 'checked' : '' }} onclick="event.stopPropagation();"> <span class="subcat-label">Ladies</span></li>
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
        const offcanvas = document.getElementById('offcanvasFerragamo');
        function buildUrl() {
            const url = new URL(window.location.href);
            url.searchParams.delete('tags');
            url.searchParams.delete('gender');
            const selected = Array.from(document.querySelectorAll('.ferragamo-filter:checked')).map(i=>i.value);
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
                    const incomingGrid = doc.querySelector('#ferragamoGrid');
                    const grid = document.querySelector('#ferragamoGrid');
                    
                    if (incomingGrid && grid) {
                        grid.innerHTML = incomingGrid.innerHTML;
                    }
                    
                    const incomingFooter = doc.querySelector('.ferragamo-footer');
                    const footer = document.querySelector('.ferragamo-footer');
                    if (footer) {
                        footer.innerHTML = incomingFooter ? incomingFooter.innerHTML : '';
                        if (typeof window.bindLoadMore === 'function') {
                            window.bindLoadMore();
                        }
                        if (typeof window.updateCounter === 'function') {
                            window.updateCounter();
                        }
                    }
                })
                .catch(()=>{});
        }
        
        // Sort handlers (AJAX, no page reload)
        function attachSortHandlers() {
            const sortList = document.getElementById('ferragamoSortList');
            if (!sortList) return;
            
            sortList.querySelectorAll('li').forEach(li => {
                li.addEventListener('click', function(e){
                    e.preventDefault();
                    e.stopPropagation();
                    sortList.querySelectorAll('li').forEach(x => { 
                        x.classList.remove('selected'); 
                        const d = x.querySelector('.diamond'); 
                        if(d) d.textContent='◇'; 
                    });
                    this.classList.add('selected'); 
                    const d = this.querySelector('.diamond'); 
                    if(d) d.textContent='◆';
                    const url = buildUrl();
                    const val = this.getAttribute('data-value') || '';
                    if (val) url.searchParams.set('sort', val); else url.searchParams.delete('sort');
                    fetchAndRender(url);
                });
            });
        }
        
        attachSortHandlers();

        // Checkbox immediate apply
        document.querySelectorAll('.ferragamo-filter').forEach(cb => {
            cb.addEventListener('click', function(e){ e.stopPropagation(); const url = buildUrl(); fetchAndRender(url); });
        });
    })();
    
    // Load More functionality
    document.addEventListener('DOMContentLoaded', function() {
        window.bindLoadMore = function bindLoadMore() {
            const loadMoreBtn = document.getElementById('loadMoreBtn');
            if (!loadMoreBtn) return;
            
            const btn = loadMoreBtn.cloneNode(true);
            loadMoreBtn.parentNode.replaceChild(btn, loadMoreBtn);

            function getGrid(container) {
                return container.querySelector('#ferragamoGrid');
            }

            function appendIncomingItems(doc) {
                const currentGrid = getGrid(document);
                if (!currentGrid) return 0;

                let nodesToAppend = [];
                const incomingGrid = getGrid(doc) || doc.querySelector('#ferragamoGrid');
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
                const counter = document.querySelector('.ferragamo-footer .products-counter');
                
                if (counter) {
                    const total = parseInt(counter.getAttribute('data-total') || '0', 10);
                    const perPage = parseInt(counter.getAttribute('data-per-page') || '20', 10);
                    
                    counter.setAttribute('data-current', totalShown);
                    
                    if (total > 0) {
                        counter.textContent = `SHOWING ${totalShown} OF ${total} PRODUCTS`;
                        counter.style.display = 'block';
                    } else {
                        counter.style.display = 'none';
                    }
                    
                    const loadMoreBtn = document.getElementById('loadMoreBtn');
                    if (loadMoreBtn) {
                        const currentPage = parseInt(loadMoreBtn.getAttribute('data-page') || '2', 10);
                        const lastPage = parseInt(loadMoreBtn.getAttribute('data-last-page') || '2', 10);
                        const totalFromBtn = parseInt(loadMoreBtn.getAttribute('data-total') || total, 10);
                        
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
                            const currentGrid = document.querySelector('#ferragamoGrid');
                            const incomingGrid2 = doc.querySelector('#ferragamoGrid');
                            if (currentGrid && incomingGrid2) {
                                currentGrid.insertAdjacentHTML('beforeend', incomingGrid2.innerHTML);
                                appended = incomingGrid2.children.length;
                                window.updateCounter();
                            }
                        }
                        
                        const currentTotal = parseInt(btn.getAttribute('data-total') || total, 10);
                        const currentGrid = document.querySelector('#ferragamoGrid');
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
                            const nextPage = parseInt(btn.getAttribute('data-page') || '2', 10);
                            url.searchParams.set('page', String(nextPage));
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
