@extends('public.layouts.header_new')
@section('content')

<style>
    .corum-hero-media{
        width:100%;
        height:min(120vh, 900px);
        min-height:420px;
        overflow:hidden;
        position:relative;
        line-height:0;
        background:#000;
    }

    .corum-hero-video{
        width:100%;
        height:100%;
        display:block;
        object-fit:cover;
        object-position:center center;
        vertical-align:top;
    }

    .corum-logo-section{
        width:100%;
        background:#fff;
        text-align:center;
        margin-top:-8px;
        line-height:0;
        padding:2px 15px 0;
        margin:0;
    }

    .corum-logo-main{
        width:min(210px,52vw);
        max-width:210px;
        height:auto;
        display:inline-block;
    }

    .corum-intro-section{
        padding-top:2px;
        margin-top:-28px;
        text-align:center;
    }

    .corum-intro-content{
        max-width:980px;
        margin:0 auto;
        padding:0 20px 18px;
    }

    .corum-intro-title{
        margin:0 0 14px;
        font-family:"Times New Roman", Georgia, serif;
        font-style:italic;
        font-weight:700;
        font-size:29px;
        line-height:1.3;
        color:#1f1f1f;
    }

    .corum-intro-text{
        margin:0 auto;
        max-width:900px;
        font-family:Arial, sans-serif;
        font-size:22px;
        line-height:1.45;
        color:#4a4a4a;
    }

    .corum-intro-image-wrap{
        width:100vw;
        height:clamp(180px, 32vw, 500px);
        margin-left:calc(50% - 50vw);
        margin-right:calc(50% - 50vw);
        overflow:hidden;
        position:relative;
        line-height:0;
    }

    .corum-intro-image{
        width:100%;
        height:100%;
        display:block;
        object-fit:cover;
        object-position:center top;
        vertical-align:top;
    }

    .corum-intro-button-wrap{
        background:#ffffff;
        padding:18px 15px 6px;
        text-align:center;
    }

    .corum-intro-button{
        display:inline-block;
        font-family:Arial, sans-serif;
        font-size:21px;
        font-weight:700;
        letter-spacing:0;
        color:#000;
        text-decoration:none;
        text-transform:uppercase;
    }

    .corum-intro-button:hover{
        color:#000;
        text-decoration:none;
    }

    .corum-filter-wrap .brand-logo{
        display:block;
        margin-left:auto;
        margin-right:auto;
        width:10%;
        height:auto;
    }

    .corum-filter-wrap .filter-bar{
        position:relative;
    }

    .corum-filter-wrap .custom-filter-btn{
        border:none !important;
        outline:none !important;
        box-shadow:none !important;
        background:transparent !important;
        padding:4px 10px;
        font-size:14px;
        line-height:1.1;
        display:flex;
        align-items:center;
        gap:6px;
        color:#222;
        font-weight:400;
        position:absolute;
        right:0;
        top:50%;
        transform:translateY(-50%);
        z-index:10001;
        cursor:pointer;
    }

    .corum-filter-wrap .custom-filter-btn:focus,
    .corum-filter-wrap .custom-filter-btn:hover,
    .corum-filter-wrap .custom-filter-btn:active{
        border:none !important;
        outline:none !important;
        box-shadow:none !important;
        background:transparent !important;
    }

    .corum-filter-wrap .custom-filter-btn .navbar-toggler-icon{
        width:18px;
        height:14px;
        background:none;
        display:inline-block;
        position:relative;
        flex:0 0 auto;
        background-image:url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 20'%3e%3crect x='0' y='0' width='30' height='2' fill='%23333'/%3e%3crect x='0' y='9' width='30' height='2' fill='%23333'/%3e%3crect x='0' y='18' width='30' height='2' fill='%23333'/%3e%3c/svg%3e");
        background-size:100% 100%;
        background-repeat:no-repeat;
        margin-right:2px;
    }

    .corum-filter-overlay{
        position:fixed;
        inset:0;
        background:rgba(0,0,0,0.35);
        opacity:0;
        visibility:hidden;
        transition:all 0.3s ease;
        z-index:19999;
    }

    .corum-filter-overlay.show{
        opacity:1;
        visibility:visible;
    }

    .corum-filter-panel{
        position:fixed;
        top:0;
        right:-380px;
        width:360px;
        max-width:90vw;
        height:100vh;
        background:#fff;
        box-shadow:-8px 0 24px rgba(0,0,0,0.12);
        z-index:20000;
        transition:right 0.35s ease;
        overflow-y:auto;
    }

    .corum-filter-panel.show{
        right:0;
    }

    .corum-filter-header{
        display:flex;
        justify-content:space-between;
        align-items:center;
        padding:18px 20px;
        border-bottom:1px solid #e5e5e5;
        position:sticky;
        top:0;
        background:#fff;
        z-index:2;
    }

    .corum-filter-title{
        font-size:16px;
        font-weight:600;
        letter-spacing:.4px;
    }

    .corum-filter-close{
        border:0;
        background:transparent;
        font-size:28px;
        line-height:1;
        color:#000;
        cursor:pointer;
    }

    .corum-filter-body{
        padding:18px 20px 30px;
        background:#fff;
    }

    .corum-filter-wrap .sort-list,
    .corum-filter-wrap .category-list{
        list-style:none;
        padding-left:0;
        margin-bottom:0;
    }

    .corum-filter-wrap .sort-list{
        max-height:0;
        overflow:hidden;
        transition:max-height 0.3s ease-out;
    }

    .corum-filter-wrap .sort-list.show{
        max-height:320px;
    }

    .corum-filter-wrap .category-list.collapsible{
        max-height:0;
        overflow:hidden;
        transition:max-height 0.3s ease-out;
    }

    .corum-filter-wrap .category-list.collapsible.show{
        max-height:1000px;
    }

    .corum-filter-wrap .sort-list li,
    .corum-filter-wrap .category-list > li{
        padding:.55rem 0;
        font-size:.97rem;
        display:flex;
        align-items:center;
        color:#222;
        cursor:pointer;
    }

    .corum-filter-wrap .sort-list li.selected{
        font-weight:600;
        color:#111;
    }

    .corum-filter-wrap .sort-list li .diamond{
        font-size:0.7em;
        margin-right:0.7em;
        color:#b2b2b2;
    }

    .corum-filter-wrap .sort-list li.selected .diamond{
        color:#111;
    }

    .corum-filter-wrap .filter-section-title{
        font-size:.98rem;
        font-weight:300;
        letter-spacing:.01em;
        margin-bottom:.8rem;
        margin-top:1.5rem;
        text-transform:uppercase;
        color:#222;
        display:flex;
        align-items:center;
        justify-content:space-between;
        border-bottom:1px solid #ecebe7;
        padding-bottom:.5rem;
        cursor:pointer;
    }

    .corum-filter-wrap .category-toggle{
        font-size:1.1em;
        color:#b2b2b2;
        user-select:none;
        width:20px;
        text-align:center;
        margin-left:10px;
    }

    .corum-filter-wrap .filter-tag-checkbox{
        margin-right:8px;
        accent-color:#111;
        border-color:#bbb;
        box-shadow:none !important;
    }

    .corum-filter-wrap .onlineStore .col-6,
    .corum-filter-wrap .onlineStore .col-sm-4,
    .corum-filter-wrap .onlineStore .col-md-3,
    .corum-filter-wrap .onlineStore .col-lg-3{
        display:flex;
        flex-direction:column;
    }

    .corum-filter-wrap .onlineStore .card{
        flex:1;
        display:flex;
        flex-direction:column;
    }

    .corum-filter-wrap .onlineStore .card-body{
        flex:1;
        display:flex;
        flex-direction:column;
        justify-content:space-between;
    }

    .corum-filter-wrap .discover-more-btn{
        align-self:center;
        margin:0 auto;
    }

    .corum-filter-wrap .products-counter{
        font-size:1rem;
        letter-spacing:0.2em;
        margin-bottom:1.5rem;
    }

    body.corum-filter-open{
        overflow:hidden;
    }

    @media (max-width:767px){
        .corum-hero-media{
            height:72vh;
            min-height:320px;
        }

        .corum-logo-section{
            padding:0px 12px 0px;
            margin:0;
            line-height:0;
        }

        .corum-logo-main{
            width:min(150px,48vw);
            display:block;
            margin:0 auto;
        }

        .corum-intro-section{
            padding-top:0;
            margin-top:-26px;
        }

        .corum-intro-content{
            padding:0 14px 14px;
        }

        .corum-intro-title{
            font-size:30px;
            line-height:1.35;
            margin-bottom:10px;
        }

        .corum-intro-text{
            font-size:14px;
            line-height:1.5;
        }

        .corum-intro-image-wrap{
            height:160px;
        }

        .corum-intro-button-wrap{
            padding:16px 12px 6px;
        }

        .corum-intro-button{
            font-size:13px;
        }
    }

    @media (max-width:575px){
        .corum-filter-wrap .brand-logo{
            width:40%;
        }

        .corum-filter-wrap .custom-filter-btn{
            right:10px;
            font-size:12px;
            padding:4px 8px;
        }

        .corum-filter-panel{
            width:100vw;
            max-width:100vw;
        }
    }

    @media (min-width:576px) and (max-width:767px){
        .corum-filter-wrap .brand-logo{
            width:30%;
        }

        .corum-filter-wrap .custom-filter-btn{
            right:15px;
            font-size:13px;
        }
    }

    @media (min-width:768px) and (max-width:991px){
        .corum-filter-wrap .brand-logo{
            width:20%;
        }

        .corum-filter-wrap .custom-filter-btn{
            right:20px;
        }
    }

    @media (min-width:992px){
        .corum-filter-wrap .brand-logo{
            width:20%;
        }

        .corum-filter-wrap .custom-filter-btn{
            right:23px;
        }
    }
    /*watch land */
        .watchland-section{
    width: 100%;
    margin: 0;
    padding: 0;
}

/* =======================
   TOP TEXT
======================= */
.watchland-text-top{
    width: 100%;
    margin: 0 auto;
    padding: 30px 20px 25px;
    text-align: center;
}

.watchland-text-top p{
    margin: 0;
    font-size: 18px;
    line-height: 1.8;
    color: #222;
}

/* =======================
   BANNER
======================= */
.watchland-banner{
    position: relative;
    width: 100%;
    overflow: hidden;
}

.watchland-banner img{
    width: 100%;
    height: auto;
    display: block;
    margin-top:10px;
}
/* Center text on banner */
.watchland-title{
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    
    font-size: 52px;
    letter-spacing: 8px;
    color: #fff;
    font-weight: 500;
    text-transform: uppercase;
    text-align: center;
    font-family: 'Montserrat', sans-serif;
}

/* Tablet */
@media(max-width:992px){
    .watchland-title{
        font-size:36px;
        letter-spacing:5px;
    }
}

/* Mobile */
@media(max-width:576px){
    .watchland-title{
        font-size:24px;
        letter-spacing:3px;
    }
}

</style>
</style>

<section class="corum-hero-media">
    @if(isset($corumSubcategory) && $corumSubcategory && $corumSubcategory->banner_url)

        @if(Str::endsWith(strtolower($corumSubcategory->banner_url), ['.mp4', '.webm', '.ogg']))
            <video autoplay loop muted playsinline class="corum-hero-video"
                onerror="this.style.display='none'; this.nextElementSibling.style.display='block';">
                <source src="{{ asset($corumSubcategory->banner_url) }}"
                        type="video/{{ pathinfo($corumSubcategory->banner_url, PATHINFO_EXTENSION) }}">
                Your browser does not support the video tag.
            </video>

            <div class="corum-hero-video"
                 style="display:none; background-image:url('{{ asset($corumSubcategory->banner_url) }}'); background-size:cover; background-position:center;">
            </div>
        @else
            <div class="corum-hero-video"
                 style="background-image:url('{{ asset($corumSubcategory->banner_url) }}'); background-size:cover; background-position:center;">
            </div>
        @endif

    @else
        <img src="{{ asset('assets/f_assets/image/cys/chrono.jpeg') }}"
             alt="Corum Banner"
             class="corum-hero-video">
    @endif
</section>



<section class="corum-logo-section">
    <img src="{{ asset('assets/f_assets/image/watch logo/Corum.png') }}"
         alt="Corum logo"
         class="corum-logo-main">
</section>


<section class="watchland-section">
<div class="watchland-banner"style="letter-spacing: 8px;font-weight: 300;"> 
    <img src="{{ asset('assets/f_assets/image/corum.jpeg') }}" alt="Divine Treasure" loading="lazy" />
 </div>
</section>

<!--<section class="corum-intro-section">-->
<!--    <div class="corum-intro-content">-->
<!--        <h2 class="corum-intro-title">-->
<!--            Discover the Spirit of Corum-->
<!--        </h2>-->

<!--        <p class="corum-intro-text">-->
<!--            Corum reflects bold Swiss watchmaking through distinctive design, refined craftsmanship, and a character that stands apart. Explore a collection shaped by creativity, precision, and modern luxury.-->
<!--        </p>-->
<!--    </div>-->

<!--    <div class="corum-intro-image-wrap">-->
<!--        <img-->
<!--            src="{{ asset('assets/f_assets/image/cys/chrono.jpeg') }}"-->
<!--            alt="Discover the Spirit of Corum"-->
<!--            class="corum-intro-image"-->
<!--        >-->
<!--    </div>-->

<!--    <div class="corum-intro-button-wrap">-->
<!--        <a href="#corumGrid" class="corum-intro-button">-->
<!--            DISCOVER THE COLLECTIONS-->
<!--        </a>-->
<!--    </div>-->
<!--</section>-->

<section class="py-4">
    <div class="corum-filter-wrap">
        <!--<div class="navbar navbar-white align-items-center filter-bar justify-content-center py-3">-->
        <!--    <div class="brand-logo-wrapper w-70 text-center" style="display:none;">-->
        <!--        <img src="{{ asset('assets/f_assets/image/watch logo/Corum.png') }}" alt="Corum logo" class="brand-logo">-->
        <!--    </div>-->

        <!--    <button type="button" class="custom-filter-btn" id="openCorumFilter" aria-label="Open sort and filter">-->
        <!--        <span class="navbar-toggler-icon"></span> SORT & FILTER-->
        <!--    </button>-->
        <!--</div>-->

        <div id="corumFilterOverlay" class="corum-filter-overlay"></div>

        <!--<div id="offcanvasCorum" class="corum-filter-panel">-->
        <!--    <div class="corum-filter-header">-->
        <!--        <span class="corum-filter-title">SORT & FILTER</span>-->
        <!--        <button type="button" class="corum-filter-close" id="closeCorumFilter" aria-label="Close">&times;</button>-->
        <!--    </div>-->

        <!--    <div class="corum-filter-body">-->
        <!--        <div>-->
        <!--            <div class="filter-section-title" onclick="toggleCorumCategory('corumSortList', this.querySelector('.category-toggle'))">-->
        <!--                Sort By <span class="category-toggle">+</span>-->
        <!--            </div>-->

        <!--            @php $currentSort = request('sort'); @endphp-->
        <!--            <ul class="sort-list" id="corumSortList">-->
        <!--                <li data-value="" class="{{ !$currentSort ? 'selected' : '' }}">-->
        <!--                    <span class="diamond">{{ !$currentSort ? '◆' : '◇' }}</span> Best Selling-->
        <!--                </li>-->
        <!--                <li data-value="az" class="{{ $currentSort == 'az' ? 'selected' : '' }}">-->
        <!--                    <span class="diamond">{{ $currentSort == 'az' ? '◆' : '◇' }}</span> Alphabetically, A-Z-->
        <!--                </li>-->
        <!--                <li data-value="za" class="{{ $currentSort == 'za' ? 'selected' : '' }}">-->
        <!--                    <span class="diamond">{{ $currentSort == 'za' ? '◆' : '◇' }}</span> Alphabetically, Z-A-->
        <!--                </li>-->
        <!--                <li data-value="price_low_high" class="{{ $currentSort == 'price_low_high' ? 'selected' : '' }}">-->
        <!--                    <span class="diamond">{{ $currentSort == 'price_low_high' ? '◆' : '◇' }}</span> Price, low to high-->
        <!--                </li>-->
        <!--                <li data-value="price_high_low" class="{{ $currentSort == 'price_high_low' ? 'selected' : '' }}">-->
        <!--                    <span class="diamond">{{ $currentSort == 'price_high_low' ? '◆' : '◇' }}</span> Price, high to low-->
        <!--                </li>-->
        <!--                <li data-value="new_old" class="{{ $currentSort == 'new_old' ? 'selected' : '' }}">-->
        <!--                    <span class="diamond">{{ $currentSort == 'new_old' ? '◆' : '◇' }}</span> Date, new to old-->
        <!--                </li>-->
        <!--                <li data-value="old_new" class="{{ $currentSort == 'old_new' ? 'selected' : '' }}">-->
        <!--                    <span class="diamond">{{ $currentSort == 'old_new' ? '◆' : '◇' }}</span> Date, old to new-->
        <!--                </li>-->
        <!--            </ul>-->
        <!--        </div>-->

        <!--        @php $selectedTags = collect(explode(',', request('tags', '')))->map(fn($s) => trim($s)); @endphp-->

        <!--        <div class="mt-3">-->
        <!--            <div class="filter-section-title" onclick="toggleCorumCategory('corumGenderList', this.querySelector('.category-toggle'))">-->
        <!--                Gender <span class="category-toggle">+</span>-->
        <!--            </div>-->

        <!--            <ul class="category-list collapsible" id="corumGenderList">-->
        <!--                <li>-->
        <!--                    <input type="checkbox" class="form-check-input filter-tag-checkbox corum-filter" value="mens" {{ $selectedTags->contains('mens') ? 'checked' : '' }}>-->
        <!--                    <span class="subcat-label">Men's</span>-->
        <!--                </li>-->
        <!--                <li>-->
        <!--                    <input type="checkbox" class="form-check-input filter-tag-checkbox corum-filter" value="ladies" {{ $selectedTags->contains('ladies') ? 'checked' : '' }}>-->
        <!--                    <span class="subcat-label">Ladies</span>-->
        <!--                </li>-->
        <!--            </ul>-->
        <!--        </div>-->

        <!--        <div class="mt-3">-->
        <!--            <div class="filter-section-title" onclick="toggleCorumCategory('corumSeriesList', this.querySelector('.category-toggle'))">-->
        <!--                Series <span class="category-toggle">+</span>-->
        <!--            </div>-->

        <!--            @php $series = ['tourbillon','skeltec','open-gear','flying','classic','sirius','artist-collection','heritage']; @endphp-->
        <!--            <ul class="category-list collapsible" id="corumSeriesList">-->
        <!--                @foreach($series as $s)-->
        <!--                    <li>-->
        <!--                        <input type="checkbox" class="form-check-input filter-tag-checkbox corum-filter" value="{{ $s }}" {{ $selectedTags->contains($s) ? 'checked' : '' }}>-->
        <!--                        <span class="subcat-label">{{ ucwords(str_replace('-', ' ', $s)) }}</span>-->
        <!--                    </li>-->
        <!--                @endforeach-->
        <!--            </ul>-->
        <!--        </div>-->
        <!--    </div>-->
        <!--</div>-->

        <div class="container-fluid px-3">
            <div class="row onlineStore g-2 pt-3" id="corumGrid">
                @if(isset($products) && $products->count())
                    @foreach($products as $prod)
                        <div class="col-6 col-sm-4 col-md-3 col-lg-3">
                            @include('public.partials.product-card-watches', ['product' => $prod])
                        </div>
                    @endforeach
                @else
                    <div class="col-12">
                        <div class="text-center py-5 text-muted">Collections Reveal Soon!</div>
                    </div>
                @endif
            </div>
        </div>

        <div class="text-center py-4 corum-footer">
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
                         data-current-page="{{ $products->currentPage() }}">
                        SHOWING {{ $currentPageProducts }} OF {{ $totalFilteredProducts }} PRODUCTS
                    </div>
                @endif

                @php
                    $allProductsShown = $totalShown >= $totalFilteredProducts;
                    $shouldShowLoadMore = $hasMorePages && !$allProductsShown;
                @endphp

                @if($shouldShowLoadMore)
                    <button id="loadMoreBtn"
                            style="background:#e3e4e5;border:none;color:#222;font-size:0.8rem;letter-spacing:0.15em;padding:0.8rem 2rem;border-radius:8px;font-family:inherit;font-weight:400;box-shadow:none;transition:background 0.2s;"
                            data-page="{{ $products->currentPage() + 1 }}"
                            data-last-page="{{ $products->lastPage() }}"
                            data-per-page="{{ $products->perPage() }}"
                            data-total="{{ $totalFilteredProducts }}">
                        LOAD MORE
                    </button>
                @endif
            @endif
        </div>
    </div>
</section>

<script>
    function toggleCorumCategory(targetId, element) {
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

    document.addEventListener('DOMContentLoaded', function () {
        const panel = document.getElementById('offcanvasCorum');
        const overlay = document.getElementById('corumFilterOverlay');
        const openBtn = document.getElementById('openCorumFilter');
        const closeBtn = document.getElementById('closeCorumFilter');

        function openFilter() {
            if (panel) panel.classList.add('show');
            if (overlay) overlay.classList.add('show');
            document.body.classList.add('corum-filter-open');
        }

        function closeFilter() {
            if (panel) panel.classList.remove('show');
            if (overlay) overlay.classList.remove('show');
            document.body.classList.remove('corum-filter-open');
        }

        if (openBtn) {
            openBtn.addEventListener('click', function (e) {
                e.preventDefault();
                openFilter();
            });
        }

        if (closeBtn) {
            closeBtn.addEventListener('click', closeFilter);
        }

        if (overlay) {
            overlay.addEventListener('click', closeFilter);
        }

        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape') closeFilter();
        });

        function buildUrl() {
            const url = new URL(window.location.href);

            url.searchParams.delete('tags');
            url.searchParams.delete('page');

            const selected = Array.from(document.querySelectorAll('.corum-filter:checked')).map(i => i.value);
            if (selected.length) {
                url.searchParams.set('tags', selected.join(','));
            }

            const selectedSort = document.querySelector('#corumSortList li.selected');
            if (selectedSort) {
                const sortValue = selectedSort.getAttribute('data-value') || '';
                if (sortValue) {
                    url.searchParams.set('sort', sortValue);
                } else {
                    url.searchParams.delete('sort');
                }
            }

            url.searchParams.set('page', '1');
            return url;
        }

        function fetchAndRender(url) {
            window.history.pushState({}, '', url.toString());

            fetch(url.toString(), {
                headers: { 'X-Requested-With': 'XMLHttpRequest' },
                cache: 'no-cache'
            })
            .then(resp => resp.text())
            .then(html => {
                const parser = new DOMParser();
                const doc = parser.parseFromString(html, 'text/html');

                const incomingGrid = doc.querySelector('#corumGrid');
                const currentGrid = document.querySelector('#corumGrid');
                if (incomingGrid && currentGrid) {
                    currentGrid.innerHTML = incomingGrid.innerHTML;
                }

                const incomingFooter = doc.querySelector('.corum-footer');
                const currentFooter = document.querySelector('.corum-footer');
                if (incomingFooter && currentFooter) {
                    currentFooter.innerHTML = incomingFooter.innerHTML;
                }

                bindLoadMore();
                updateCounter();
                closeFilter();
            })
            .catch(error => console.error('Filter AJAX error:', error));
        }

        const sortList = document.getElementById('corumSortList');
        if (sortList) {
            sortList.querySelectorAll('li').forEach(li => {
                li.addEventListener('click', function () {
                    sortList.querySelectorAll('li').forEach(x => {
                        x.classList.remove('selected');
                        const d = x.querySelector('.diamond');
                        if (d) d.textContent = '◇';
                    });

                    this.classList.add('selected');
                    const d = this.querySelector('.diamond');
                    if (d) d.textContent = '◆';

                    fetchAndRender(buildUrl());
                });
            });
        }

        document.querySelectorAll('.corum-filter').forEach(cb => {
            cb.addEventListener('change', function () {
                fetchAndRender(buildUrl());
            });
        });

        window.updateCounter = function updateCounter() {
            const grid = document.querySelector('#corumGrid');
            if (!grid) return;

            const totalShown = grid.children.length;
            const counter = document.querySelector('.corum-footer .products-counter');

            if (counter) {
                const total = parseInt(counter.getAttribute('data-total') || '0', 10);
                const perPage = parseInt(counter.getAttribute('data-per-page') || '20', 10);

                counter.setAttribute('data-current', totalShown);
                counter.textContent = `SHOWING ${totalShown} OF ${total} PRODUCTS`;

                const loadMoreBtn = document.getElementById('loadMoreBtn');
                if (loadMoreBtn) {
                    const nextPage = Math.ceil(totalShown / perPage) + 1;
                    loadMoreBtn.setAttribute('data-page', nextPage);

                    if (totalShown >= total) {
                        loadMoreBtn.style.display = 'none';
                    } else {
                        loadMoreBtn.style.display = 'inline-block';
                    }
                }
            }
        };

        window.bindLoadMore = function bindLoadMore() {
            const oldBtn = document.getElementById('loadMoreBtn');
            if (!oldBtn) return;

            const btn = oldBtn.cloneNode(true);
            oldBtn.parentNode.replaceChild(btn, oldBtn);

            btn.addEventListener('click', function () {
                const nextPage = parseInt(btn.getAttribute('data-page') || '2', 10);

                btn.disabled = true;
                btn.textContent = 'Loading...';

                const url = new URL(window.location.href);
                url.searchParams.set('page', String(nextPage));

                fetch(url.toString(), {
                    headers: { 'X-Requested-With': 'XMLHttpRequest' },
                    cache: 'no-cache'
                })
                .then(response => response.text())
                .then(html => {
                    const parser = new DOMParser();
                    const doc = parser.parseFromString(html, 'text/html');

                    const currentGrid = document.querySelector('#corumGrid');
                    const incomingGrid = doc.querySelector('#corumGrid');

                    let appended = 0;

                    if (currentGrid && incomingGrid) {
                        Array.from(incomingGrid.children).forEach(node => {
                            currentGrid.appendChild(node);
                            appended++;
                        });
                    }

                    const incomingBtn = doc.querySelector('#loadMoreBtn');
                    const incomingCounter = doc.querySelector('.products-counter');

                    if (incomingBtn) {
                        btn.setAttribute('data-last-page', incomingBtn.getAttribute('data-last-page') || '');
                        btn.setAttribute('data-per-page', incomingBtn.getAttribute('data-per-page') || '');
                        btn.setAttribute('data-total', incomingBtn.getAttribute('data-total') || '');
                    }

                    if (incomingCounter) {
                        const counter = document.querySelector('.products-counter');
                        if (counter) {
                            counter.setAttribute('data-total', incomingCounter.getAttribute('data-total') || '');
                            counter.setAttribute('data-per-page', incomingCounter.getAttribute('data-per-page') || '');
                        }
                    }

                    updateCounter();

                    const total = parseInt(btn.getAttribute('data-total') || '0', 10);
                    const shown = currentGrid ? currentGrid.children.length : 0;

                    if (shown >= total || appended === 0) {
                        btn.style.display = 'none';
                    } else {
                        btn.setAttribute('data-page', String(nextPage + 1));
                        btn.disabled = false;
                        btn.textContent = 'LOAD MORE';
                    }
                })
                .catch(() => {
                    btn.disabled = false;
                    btn.textContent = 'LOAD MORE';
                });
            });
        };

        bindLoadMore();
        updateCounter();
    });
</script>
@endsection