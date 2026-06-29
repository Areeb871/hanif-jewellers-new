@extends('public.layouts.header_latest')

@section('content')
    <style>
        /* ── Tissot page: typography & spacing tokens ── */
        .tissot-home-content,
        .tissot-products,
        .tissot-brand-bar,
        .offcanvas-modern {
            font-family: "Lato", Helvetica Neue, sans-serif;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        .tissot-home-hero,
        .tissot-video-hero video,
        .tissot-video-hero .tissot-video-fallback {
            width: 100%;
            height: min(70vh, 680px);
            min-height: 300px;
        }
        .tissot-home-hero {
            overflow: hidden;
            background: #c9b89a;
            line-height: 0;
        }
        .tissot-home-hero img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center;
            display: block;
        }
        .tissot-video-hero {
            margin: 0;
            padding: 0;
            line-height: 0;
            overflow: hidden;
            position: relative;
            z-index: 0;
        }
        .tissot-video-hero video,
        .tissot-video-hero .tissot-video-fallback {
            object-fit: cover;
            object-position: center;
            display: block;
            vertical-align: top;
        }

        /* Shared type roles */
        .tissot-label {
            font-size: 12px;
            font-weight: 400;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            line-height: 1.5;
            color: #5c5c5c;
        }
        .tissot-body {
            font-size: 16px;
            font-weight: 400;
            line-height: 1.7;
            font-style: italic;
            color: #4a4a4a;
        }
        .tissot-section-x {
            padding-left: clamp(24px, 4vw, 48px);
            padding-right: clamp(24px, 4vw, 48px);
        }

        .tissot-home-content {
            background: #fff;
            padding-top: clamp(48px, 6vw, 64px);
            padding-bottom: clamp(48px, 6vw, 64px);
        }
        .tissot-home-content__grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 32px;
            max-width: 1100px;
            margin: 0 auto;
            align-items: center;
        }
        .tissot-home-content__eyebrow {
            margin: 0 0 16px;
            font-size: 12px;
            font-weight: 600;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            line-height: 1.5;
            color: #5c5c5c;
        }
        .tissot-home-content__heading {
            margin: 0;
            font-size: clamp(36px, 5vw, 52px);
            font-weight: 400;
            letter-spacing: -0.01em;
            line-height: 1.12;
            color: #1a1a1a;
        }
        .tissot-home-content__text {
            margin: 0;
            font-size: 20px;
            font-weight: 400;
            line-height: 1.7;
            font-style: italic;
            color: #4a4a4a;
        }
        .tissot-home-content__cta {
            display: inline-block;
            margin-top: 24px;
            color: #1a1a1a;
            font-size: 10px;
            font-weight: 500;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            text-decoration: none;
            border-bottom: 1px solid #1a1a1a;
            padding-bottom: 4px;
        }
        .tissot-home-content__cta:hover { color: #1a1a1a; opacity: 0.55; }

        .tissot-brand-bar-wrap {
            --tissot-bar-space: clamp(32px, 4vw, 40px);
            padding: var(--tissot-bar-space) clamp(24px, 4vw, 48px);
        }
        .tissot-brand-bar {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 12px;
            padding: 0;
            margin: 0;
            min-height: auto;
        }
        .tissot-brand-bar.navbar {
            --bs-navbar-padding-y: 0;
            --bs-navbar-padding-x: 0;
        }
        .tissot-brand-bar .brand-logo-wrapper {
            width: 100%;
            margin: 0;
        }
        .tissot-brand-bar .brand-logo {
            display: block;
            margin: 0 auto;
            width: clamp(120px, 14vw, 180px);
            height: auto;
        }
        .tissot-brand-bar__filter-row {
            width: 100%;
            display: flex;
            justify-content: flex-end;
            align-items: center;
        }
        .tissot-brand-bar .navbar-toggler {
            position: static !important;
            margin: 0 !important;
            padding: 0 !important;
            line-height: 1.5;
        }

        .tissot-products {
            padding: 0 0 48px;
        }
        .tissot-products .container-fluid {
            padding-left: clamp(24px, 4vw, 48px);
            padding-right: clamp(24px, 4vw, 48px);
        }
        .tissot-products .onlineStore {
            padding-top: 0;
        }
        .tissot-footer {
            padding-top: 32px;
            padding-bottom: 16px;
        }
        .tissot-products-counter {
            font-size: 12px;
            font-weight: 400;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            color: #5c5c5c;
            margin-bottom: 24px;
        }
        .tissot-load-more-btn {
            background: #e3e4e5;
            border: none;
            color: #1a1a1a;
            font-family: inherit;
            font-size: 12px;
            font-weight: 500;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            padding: 14px 32px;
            border-radius: 8px;
            transition: background 0.2s, opacity 0.2s;
        }
        .tissot-load-more-btn:hover {
            background: #d8d9da;
        }

        @media (max-width: 767px) {
            .tissot-home-content__grid {
                grid-template-columns: 1fr;
                gap: 24px;
            }
            .tissot-home-hero,
            .tissot-video-hero video,
            .tissot-video-hero .tissot-video-fallback {
                height: min(52vh, 480px);
                min-height: 260px;
            }
            .tissot-home-content {
                padding-top: 40px;
                padding-bottom: 40px;
            }
            .tissot-home-content__heading {
                font-size: clamp(28px, 8vw, 36px);
            }
            .tissot-home-content__text {
                font-size: 15px;
            }
            .tissot-brand-bar-wrap {
                --tissot-bar-space: 28px;
            }
            .tissot-brand-bar {
                gap: 10px;
            }
            .tissot-brand-bar .brand-logo {
                width: clamp(100px, 36vw, 150px);
            }
        }

        .offcanvas-modern { background:#fff !important; color:#222; min-width:320px; max-width:380px; }
        @media (max-width: 767px) { .offcanvas-modern { min-width:100% !important; max-width:100% !important; width:100% !important; } }
        .offcanvas-modern .offcanvas-header { border-bottom:1px solid #ecebe7; padding-bottom:0.75rem; background:#fff; }
        .offcanvas-modern .offcanvas-title { font-size:12px; font-weight:500; letter-spacing:0.12em; text-transform:uppercase; color:#1a1a1a; }
        .offcanvas-modern .btn-close { filter:none; opacity:1; background-size:1em; width:1em; height:1em; }
        .filter .navbar-toggler { border:none !important; outline:none !important; box-shadow:none !important; background:transparent !important; padding:4px 10px; font-size:12px; font-weight:500; letter-spacing:0.12em; line-height:1.5; display:flex; align-items:center; gap:6px; z-index:10; font-family:inherit; }
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
        .sort-list li { padding: 0.5rem 0; font-size: 15px; font-weight: 400; display:flex; align-items:center; color:#4a4a4a; cursor:pointer; line-height: 1.5; }
        .sort-list li.selected { font-weight: 500; color:#1a1a1a; }
        .sort-list li .diamond { font-size: 0.7em; margin-right: 0.7em; color: #b2b2b2; }
        .sort-list li.selected .diamond { color:#1a1a1a; }
        .category-list > li { padding: 0.5rem 0; font-size: 15px; font-weight: 400; display:flex; align-items:center; color:#4a4a4a; cursor:pointer; line-height: 1.5; }
        .filter-section-title { font-size:12px; font-weight:500; letter-spacing:0.12em; margin-bottom:16px; margin-top:24px; text-transform:uppercase; color:#1a1a1a; display:flex; align-items:center; justify-content:space-between; border-bottom:1px solid #ecebe7; padding-bottom:8px; cursor:pointer; }
        .filter-section-title:first-child { margin-top: 0; }
        .category-list { list-style:none; padding-left:0; margin-bottom:0; }
        .category-list.collapsible { max-height:1000px; overflow:hidden; transition:max-height .3s ease-out; }
        .category-list.collapsible:not(.show) { max-height:0; transition:max-height .3s ease-in; }
        .category-toggle { font-size:1.1em; color:#b2b2b2; cursor:pointer; user-select:none; width:20px; text-align:center; margin-left:10px; }
        .form-check-input.filter-tag-checkbox { accent-color:#111; border-color:#bbb; box-shadow:none !important; }
        .form-check-input.filter-tag-checkbox:checked { background-color:#111; border-color:#111; }
        .filter-actions { position:sticky; bottom:-16px; background:#fff; padding:16px 0 0 0; }
        .filter-actions-inner { border-top:1px solid #ecebe7; padding-top:16px; display:flex; gap:12px; }
        .filter-actions .btn { border-radius:8px; font-size:12px; font-weight:500; letter-spacing:0.08em; padding:10px 16px; font-family:inherit; }
        .offcanvas-modern .offcanvas-body { background: rgb(255, 255, 255); padding: 1.25rem; }
        .onlineStore .col-6, .onlineStore .col-sm-4, .onlineStore .col-md-3, .onlineStore .col-lg-3 { display: flex; flex-direction: column; }
        .onlineStore .card { flex: 1; display: flex; flex-direction: column; }
        .onlineStore .card-body { flex: 1; display: flex; flex-direction: column; justify-content: space-between; }
        .discover-more-btn { align-self: center; margin: 0 auto; }
        .filter-tag-checkbox { margin-right: 8px; }
        .offcanvas.offcanvas-modern { z-index: 20000 !important; }
        .offcanvas { z-index: 20000 !important; }
        .offcanvas-backdrop { z-index: 19999 !important; }
    </style>

    <section class="tissot-home-hero">
        <img src="{{ asset('assets/f_assets/image/Tissot-banner.jpeg') }}" alt="Tissot Collection">
    </section>

    <section class="tissot-home-content tissot-section-x">
        <div class="tissot-home-content__grid">
            <div>
                <p class="tissot-home-content__eyebrow">Set your own pace.<br>Own your time.</p>
                <h2 class="tissot-home-content__heading">Embrace Every<br>Possibility</h2>
            </div>
            <div>
                <p class="tissot-home-content__text">Discover the latest additions to the tissot collections and find the perfect timepiece, to wear or to gift.</p>
                <a href="#tissotGrid" class="tissot-home-content__cta">Discover</a>
            </div>
        </div>
    </section>

    @if(isset($tissotSubcategory) && $tissotSubcategory && $tissotSubcategory->banner_url)
        <section class="tissot-video-hero p-0 position-relative">
            {{-- Desktop Video --}}
            @if(Str::endsWith($tissotSubcategory->banner_url, ['.mp4', '.webm', '.ogg']))
                <video
                    autoplay
                    loop
                    muted
                    playsinline
                    class="video-desktop d-none d-md-block"
                    onerror="this.style.display='none'; this.nextElementSibling.style.display='block';">
                    <source src="{{ asset($tissotSubcategory->banner_url) }}" type="video/{{ pathinfo($tissotSubcategory->banner_url, PATHINFO_EXTENSION) }}">
                    Your browser does not support the video tag.
                </video>
            @else
                {{-- Static image for desktop --}}
                <div class="d-none d-md-block tissot-video-fallback" style="background-image:url('{{ asset($tissotSubcategory->banner_url) }}'); background-size:cover; background-position:center;"></div>
            @endif

            {{-- Mobile Video (Dynamic based on subcategory) --}}
            @php
                $mobileVideo = null;
                $mobileVideoPath = 'assets/f_assets/image/watches mobile view/tissot_mobile.mp4';
                if ($tissotSubcategory->slug === 'tissot') {
                    $mobileVideo = $mobileVideoPath;
                } else {
                    $mobileVideo = $tissotSubcategory->banner_url;
                }
            @endphp

            @if(Str::endsWith($mobileVideo, ['.mp4', '.webm', '.ogg']))
                <video
                    autoplay
                    loop
                    muted
                    playsinline
                    class="video-mobile d-block d-md-none"
                    onerror="this.style.display='none'; this.nextElementSibling.style.display='block';">
                    <source src="{{ asset($mobileVideo) }}" type="video/{{ pathinfo($mobileVideo, PATHINFO_EXTENSION) }}">
                    Your browser does not support the video tag.
                </video>
                {{-- Fallback image for mobile --}}
                 <!-- <div class="video-fallback-mobile d-block d-md-none tissot-video-fallback" style="display:none; background-image:url('{{ asset($mobileVideo) }}'); background-size:cover; background-position:center;"></div> -->
            @else
                {{-- Static image for mobile --}}
                <div class="d-block d-md-none tissot-video-fallback" style="background-image:url('{{ asset($mobileVideo) }}'); background-size:cover; background-position:center;"></div>
            @endif
        </section>
    @endif

    <section class="tissot-products">
        <div class="tissot-brand-bar-wrap">
        <div class="navbar navbar-white filter tissot-brand-bar">
            <div class="brand-logo-wrapper text-center">
                <img src="{{ asset('assets/f_assets/image/watch logo/Tissot-logo.png') }}" alt="Tissot logo" class="brand-logo">
            </div>
            <div class="tissot-brand-bar__filter-row">
                <button class="navbar-toggler border-0 text-black" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasTissot" aria-controls="offcanvasTissot" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span> SORT & FILTER
                </button>
            </div>
        </div>
        </div>

        <div class="container-fluid">
        <div class="row onlineStore g-3" id="tissotGrid">
            @if(isset($products) && $products->count())
                @foreach($products as $prod)
                    <div class="col-6 col-sm-4 col-md-3 col-lg-3">
                        @include('public.partials.product-card-watches', ['product' => $prod])
                    </div>
                @endforeach
            @else
                <div class="col-12"><div class="text-center py-5 text-muted">Collections to be Revealed Soon!</div></div>
            @endif
        </div>
        </div>
        
        <div class="text-center py-4 tissot-footer">
        @if($products->count() > 0)
            @php
                $totalShown = $currentPageProducts;
                $hasMorePages = $products->currentPage() < $products->lastPage();
            @endphp
            @if($totalFilteredProducts > 0)
            <div class="products-counter tissot-products-counter" data-total="{{ $totalFilteredProducts }}" data-current="{{ $currentPageProducts }}" data-per-page="{{ $products->perPage() }}" data-current-page="{{ $products->currentPage() }}">
                SHOWING {{ $currentPageProducts }} OF {{ $totalFilteredProducts }} PRODUCTS
            </div>
            @endif
            @php
                $allProductsShown = $totalShown >= $totalFilteredProducts;
                $shouldShowLoadMore = $hasMorePages && !$allProductsShown;
            @endphp
            @if($shouldShowLoadMore)
                <button id="loadMoreBtn"
                        class="tissot-load-more-btn"
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

    <div class="offcanvas offcanvas-end offcanvas-modern" tabindex="-1" id="offcanvasTissot" aria-labelledby="offcanvasTissotLabel" data-bs-backdrop="true" data-bs-scroll="false">
        <div class="offcanvas-header">
            <span class="offcanvas-title" id="offcanvasTissotLabel">SORT & FILTER</span>
            <button type="button" class="btn-close btn-close-black" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <div>
                <div class="filter-section-title" onclick="toggleCategory('tissotSortList', this.querySelector('.category-toggle'))">
                    Sort By <span class="category-toggle">+</span>
                </div>
                <ul class="sort-list" id="tissotSortList">
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
                <div class="filter-section-title" onclick="toggleCategory('tissotGenderList', this.querySelector('.category-toggle'))">Gender <span class="category-toggle">+</span></div>
                <ul class="category-list collapsible" id="tissotGenderList">
                    @php $selectedTags = collect(explode(',', request('tags', '')))->map(fn($s)=>trim($s)); @endphp
                    <li><input type="checkbox" class="form-check-input filter-tag-checkbox tissot-filter" data-group="gender" value="mens" {{ $selectedTags->contains('mens') ? 'checked' : '' }} onclick="event.stopPropagation();"> <span class="subcat-label">Men's</span></li>
                    <li><input type="checkbox" class="form-check-input filter-tag-checkbox tissot-filter" data-group="gender" value="ladies" {{ $selectedTags->contains('ladies') ? 'checked' : '' }} onclick="event.stopPropagation();"> <span class="subcat-label">Ladies</span></li>
                </ul>
            </div>
            <div class="mt-3">
                <div class="filter-section-title" onclick="toggleCategory('tissotSeriesList', this.querySelector('.category-toggle'))">Series <span class="category-toggle">+</span></div>
                <ul class="category-list collapsible" id="tissotSeriesList">
                    @php $series = ['prx','prc 200','prs 200','pr 100','prs 516','desire','classic dream','carson','couturier','tradition','t-race','bridge port','quickster']; @endphp
                    @foreach($series as $s)
                        <li><input type="checkbox" class="form-check-input filter-tag-checkbox tissot-filter" data-group="series" value="{{ $s }}" {{ $selectedTags->contains($s) ? 'checked' : '' }} onclick="event.stopPropagation();"> <span class="subcat-label">{{ ucwords(str_replace(['-'], [' '], $s)) }}</span></li>
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
        const offcanvas = document.getElementById('offcanvasTissot');
        function buildUrl() {
            const url = new URL(window.location.href);
            // Build unified tags param to match server-side filtering
            url.searchParams.delete('tags');
            url.searchParams.delete('gender');
            url.searchParams.delete('series');
            url.searchParams.delete('size');
            const selected = Array.from(document.querySelectorAll('.tissot-filter:checked')).map(i=>i.value);
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
                    const incomingGrid = doc.querySelector('#tissotGrid');
                    const grid = document.querySelector('#tissotGrid');
                    
                    if (incomingGrid && grid) {
                        grid.innerHTML = incomingGrid.innerHTML;
                    }
                    
                    const incomingFooter = doc.querySelector('.tissot-footer');
                    const footer = document.querySelector('.tissot-footer');
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
            const sortList = document.getElementById('tissotSortList');
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
        document.querySelectorAll('.tissot-filter').forEach(cb => {
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
                return container.querySelector('#tissotGrid');
            }

            function appendIncomingItems(doc) {
                const currentGrid = getGrid(document);
                if (!currentGrid) return 0;

                // Primary: take children of incoming #tissotGrid
                let nodesToAppend = [];
                const incomingGrid = getGrid(doc) || doc.querySelector('#tissotGrid');
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
                const counter = document.querySelector('.tissot-footer .products-counter');
                
                if (counter) {
                    const total = parseInt(counter.getAttribute('data-total') || '0', 10);
                    const perPage = parseInt(counter.getAttribute('data-per-page') || '20', 10);
                    const currentPage = parseInt(counter.getAttribute('data-current-page') || '1', 10);
                    
                    // Update the data attributes for next calculation
                    counter.setAttribute('data-current', totalShown);
                    
                    // Only show counter if there are products
                    if (total > 0) {
                        // Use the actual count of visible products
                        counter.textContent = `SHOWING ${totalShown} OF ${total} PRODUCTS`;
                        counter.style.display = 'block';
                    } else {
                        counter.style.display = 'none';
                    }
                    
                    // Update button data if it exists
                    const loadMoreBtn = document.getElementById('loadMoreBtn');
                    if (loadMoreBtn) {
                        const nextPage = Math.ceil(totalShown / perPage) + 1;
                        loadMoreBtn.setAttribute('data-page', nextPage);
                        
                        // Hide button if all products are shown
                        if (totalShown >= total) {
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
                            const currentGrid = document.querySelector('#tissotGrid');
                            const incomingGrid2 = doc.querySelector('#tissotGrid');
                            if (currentGrid && incomingGrid2) {
                                currentGrid.insertAdjacentHTML('beforeend', incomingGrid2.innerHTML);
                                appended = incomingGrid2.children.length;
                                window.updateCounter();
                            }
                        }
                        
                        // Check if we've reached the end
                        const currentTotal = parseInt(btn.getAttribute('data-total') || total, 10);
                        const currentGrid = document.querySelector('#tissotGrid');
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
