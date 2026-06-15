
@extends('public.layouts.header_latest')
<style>
/* =======================
   DESKTOP HERO
   ======================= */
.heroBanner{
  position: relative;
  width: 100%;
  overflow: hidden;
  background: #000;
  line-height: 0;
  margin-top: 0;
}

.heroVideo,
.heroImg{
  width: 100%;
  height: auto;
  display: block;
  object-fit: cover;
}

.heroBanner.d-lg-block,
.heroBanner.d-md-block{
  width: 100vw;
  margin-left: calc(-50vw + 50%);
  margin-right: calc(-50vw + 50%);
}

/* =======================
   MOBILE STACK
   ======================= */
.mobileStackHero{
  width: 100%;
  background: #000;
}

.mobileStackImgWrap{
  width: 100%;
  overflow: hidden;
  background: #000;
  line-height: 0;
}

.mobileStackVideo,
.mobileStackImg{
  width: 100%;
  height: auto;
  display: block;
  object-fit: cover;
}
</style>
@section('content')
@if(isset($subcategory) && $subcategory && $subcategory->banner_url)

    @php
        // Default mobile fallback (image or video)
        $mobileFallback = 'assets/f_assets/image/watches mobile view/perrelee_mobile.jpg';

        // If Perrelet slug, force mobile fallback
        if (!empty($subcategory->slug) && $subcategory->slug === 'perrelet') {
            $mobileMedia = $mobileFallback;
        } else {
            $mobileMedia = $subcategory->banner_url;
        }

        // Detect video or image
        $desktopIsVideo = \Illuminate\Support\Str::endsWith($subcategory->banner_url, ['.mp4', '.webm', '.ogg']);
        $mobileIsVideo  = \Illuminate\Support\Str::endsWith($mobileMedia, ['.mp4', '.webm', '.ogg']);

        // Extensions for mime types
        $desktopExt = pathinfo($subcategory->banner_url, PATHINFO_EXTENSION);
        $mobileExt  = pathinfo($mobileMedia, PATHINFO_EXTENSION);
    @endphp

    {{-- ================= DESKTOP (Video or Image) ================= --}}
    @if($desktopIsVideo)
        <section class="heroBanner d-none d-md-block">
            <video
                id="heroVideoDesktop"
                class="heroVideo"
                autoplay
                loop
                muted
                playsinline
                preload="metadata"
            >
                <source src="{{ asset($subcategory->banner_url) }}" type="video/{{ $desktopExt }}">
                Your browser does not support the video tag.
            </video>
        </section>
    @else   
        <section class="heroBanner d-none d-md-block">
            <img
                src="{{ asset($subcategory->banner_url) }}"
                alt="Perrelet Banner"
                class="heroImg"
                loading="eager"
            >
        </section>
    @endif

    {{-- ================= MOBILE + TABLET ================= --}}
    @if($mobileIsVideo)
        <section class="mobileStackHero d-md-none">
            <div class="mobileStackImgWrap">
                <video
                    id="heroVideoMobile"
                    class="mobileStackVideo"
                    autoplay
                    loop
                    muted
                    playsinline
                    preload="metadata"
                    poster="{{ asset('assets/f_assets/image/ayeza/ayeza_all_mobile_poster.jpg') }}"
                >
                    <source src="{{ asset($mobileMedia) }}" type="video/{{ $mobileExt }}">
                    Your browser does not support the video tag.
                </video>
            </div>
        </section>
    @else
        <section class="mobileStackHero d-md-none">
            <div class="mobileStackImgWrap">
                <img
                    src="{{ asset($mobileMedia) }}"
                    alt="Perrelet Mobile Banner"
                    class="mobileStackImg"
                    loading="eager"
                >
            </div>
        </section>
    @endif

@endif



    <section class="py-4">
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
                    font-size: 13px !important;
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
      margin-top: -60px;

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
.perrelet-intro{
    width: 100%;
    padding: 35px 20px 20px;
    text-align: center;
}

.perrelet-intro-box{
    max-width: 900px;
    margin: 0 auto;
}

.perrelet-intro h2{
    margin: 0;
    font-size: 24px;
    font-weight: 700;
    color: #000;
    font-family: Arial, sans-serif;
}

.perrelet-subtitle{
    margin-top: 6px;
    font-size: 15px;
    color: #222;
    font-family: Arial, sans-serif;
}

.perrelet-intro p{
    max-width: 760px;
    margin: 20px auto 0;
    font-size: 15px;
    line-height: 1.65;
    color: #111;
    font-family: Arial, sans-serif;
}

/* Mobile */
@media (max-width: 768px){
    .perrelet-intro{
        padding: 28px 15px 18px;
    }

    .perrelet-intro h2{
        font-size: 20px;
    }

    .perrelet-subtitle{
        font-size: 13px;
    }

    .perrelet-intro p{
        font-size: 14px;
        line-height: 1.7;
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
        <section class="perrelet-intro">
    <div class="perrelet-intro-box">
        <h2>Perrelet Watches</h2>
        <div class="perrelet-subtitle">Tradition of innovation - Since 1777</div>
        <p>
            The Maison Perrelet was founded almost 250 years ago as a result of such a groundbreaking
            innovation that it just could not be managed as a mere novelty. Since then, development and
            innovation have been an obsession for everyone who has been part of this house, pursuing
            excellence and absolute precision. This tradition has brought us into the 21st century,
            and we keep on innovating.
        </p>
    </div>
</section>
         <div class="navbar navbar-white bovet-filterbar">
    <div class="bovet-filterbar__left"></div>

    <div class="bovet-filterbar__center">
        <img src="{{ asset('assets/f_assets/image/watch logo/Perrelet.png') }}"
             class="bovet-brand-logo" alt="Bovet">
    </div>

    <div class="bovet-filterbar__right">
        <button class="navbar-toggler bovet-filterbar__btn" type="button"
                data-bs-toggle="offcanvas" data-bs-target="#offcanvasPerrelet">
            <span class="navbar-toggler-icon"></span> SORT & FILTER
        </button>
    </div>
</div>
  <div class="container-fluid px-3">
    <div class="row onlineStore g-2 pt-3" id="perreletGrid">
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
    
        <div class="text-center py-4 perrelet-footer">
        @if(isset($products) && $products->count() > 0)
            @php
                $totalShown = isset($currentPageProducts) ? $currentPageProducts : $products->count();
                $hasMorePages = $products->currentPage() < $products->lastPage();
            @endphp
            @if(isset($totalFilteredProducts) && $totalFilteredProducts > 0)
            <div class="products-counter" data-total="{{ $totalFilteredProducts }}" data-current="{{ $totalShown }}" data-per-page="{{ $products->perPage() }}" data-current-page="{{ $products->currentPage() }}" style="font-size: 1rem; letter-spacing: 0.2em; margin-bottom: 1.5rem;">
                SHOWING {{ $totalShown }} OF {{ $totalFilteredProducts }} PRODUCTS
            </div>
            @endif
            @php
                $allProductsShown = $totalShown >= (isset($totalFilteredProducts) ? $totalFilteredProducts : $products->total());
                $shouldShowLoadMore = $hasMorePages && !$allProductsShown;
            @endphp
            @if($shouldShowLoadMore)
                <div class="d-flex justify-content-center">
                    <button id="loadMoreBtn"
                            style="background: #e3e4e5; border: none; color: #222; font-size: 0.8rem; letter-spacing: 0.15em; padding: 0.8rem 2rem; border-radius: 8px; font-family: inherit; font-weight: 400; box-shadow: none; transition: background 0.2s; display: inline-block; margin: 0 auto;"
                            data-page="{{ $products->currentPage() + 1 }}"
                            data-last-page="{{ $products->lastPage() }}"
                            data-per-page="{{ $products->perPage() }}"
                            data-total="{{ isset($totalFilteredProducts) ? $totalFilteredProducts : $products->total() }}">
                        LOAD MORE
                    </button>
                </div>
            @endif
        </div>
        @endif
    </section>

    <div class="offcanvas offcanvas-end offcanvas-modern" tabindex="-1" id="offcanvasPerrelet" aria-labelledby="offcanvasPerreletLabel" data-bs-backdrop="true" data-bs-scroll="false">
        <div class="offcanvas-header">
            <span class="offcanvas-title" id="offcanvasPerreletLabel">SORT & FILTER</span>
            <button type="button" class="btn-close btn-close-black" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <div>
                <div class="filter-section-title" onclick="toggleCategory('perreletSortList', this.querySelector('.category-toggle'))" style="font-size: 14px !important;">
                    Sort By <span class="category-toggle">+</span>
                </div>
                <ul class="sort-list" id="perreletSortList">
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
                <div class="filter-section-title" onclick="toggleCategory('perreletGenderList', this.querySelector('.category-toggle'))" style="font-size: 14px !important;">Gender <span class="category-toggle">+</span></div>
                <ul class="category-list collapsible" id="perreletGenderList">
                    @php $selectedTags = collect(explode(',', request('tags', '')))->map(fn($s)=>trim($s)); @endphp
                    <li><input type="checkbox" class="form-check-input filter-tag-checkbox perrelet-filter" data-group="gender" value="mens" {{ $selectedTags->contains('mens') ? 'checked' : '' }} onclick="event.stopPropagation();"> <span class="subcat-label">Men's</span></li>
                    <li><input type="checkbox" class="form-check-input filter-tag-checkbox perrelet-filter" data-group="gender" value="ladies" {{ $selectedTags->contains('ladies') ? 'checked' : '' }} onclick="event.stopPropagation();"> <span class="subcat-label">Ladies</span></li>
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
        const offcanvas = document.getElementById('offcanvasPerrelet');
        function buildUrl() {
            const url = new URL(window.location.href);
            url.searchParams.delete('tags');
            url.searchParams.delete('gender');
            const selected = Array.from(document.querySelectorAll('.perrelet-filter:checked')).map(i=>i.value);
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
                    const incomingGrid = doc.querySelector('#perreletGrid');
                    const grid = document.querySelector('#perreletGrid');
                    
                    if (incomingGrid && grid) {
                        grid.innerHTML = incomingGrid.innerHTML;
                    }
                    
                    const incomingFooter = doc.querySelector('.perrelet-footer');
                    const footer = document.querySelector('.perrelet-footer');
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
            const sortList = document.getElementById('perreletSortList');
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
        document.querySelectorAll('.perrelet-filter').forEach(cb => {
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
                return container.querySelector('#perreletGrid');
            }

            function appendIncomingItems(doc) {
                const currentGrid = getGrid(document);
                if (!currentGrid) return 0;

                let nodesToAppend = [];
                const incomingGrid = getGrid(doc) || doc.querySelector('#perreletGrid');
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
                const counter = document.querySelector('.perrelet-footer .products-counter');
                
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
                            const currentGrid = document.querySelector('#perreletGrid');
                            const incomingGrid2 = doc.querySelector('#perreletGrid');
                            if (currentGrid && incomingGrid2) {
                                currentGrid.insertAdjacentHTML('beforeend', incomingGrid2.innerHTML);
                                appended = incomingGrid2.children.length;
                                window.updateCounter();
                            }
                        }
                        
                        const currentTotal = parseInt(btn.getAttribute('data-total') || total, 10);
                        const currentGrid = document.querySelector('#perreletGrid');
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
