@extends('public.layouts.header_latest')

@section('content')

<!-- Desktop Banner Section -->
<section class="ehadBannerSection d-md-block d-none desktop-banner" style="position: relative; overflow: hidden; background: none !important; min-height: 120vh;">
    @php
        // Configure desktop banner video; default to Qaws al Matar desktop video
        $desktopVideoFile = $desktopVideoFile ?? 'assets/f_assets/image/Qaws-al-Matr Desktop View.mp4';
    @endphp
    @if(!empty($desktopVideoFile) && file_exists(public_path($desktopVideoFile)))
        <video autoplay loop muted playsinline preload="auto" style="position: absolute; left: 0; top: 0; width: 100%; height: 100%; object-fit: cover; z-index: 0;">
            <source src="{{ asset($desktopVideoFile) }}" type="video/mp4">
            Your browser does not support the video tag.
        </video>
    @endif
    </section>

<!-- Mobile Banner Section -->
<section class="ehadBannerSection d-md-none mobile-banner" style="position: relative; overflow: hidden; background: none !important; min-height: 200vh;">
    @php
        // Configure mobile banner video; default to Qaws al Matar mobile video
        $mobileVideoFile = $mobileVideoFile ?? 'assets/f_assets/image/Qaws-ul-Matr Mob View.mp4';
    @endphp
    @if(!empty($mobileVideoFile) && file_exists(public_path($mobileVideoFile)))
        <video autoplay loop muted playsinline preload="auto" style="position: absolute; left: 0; top: 0; width: 100%; height: 100%; object-fit: cover; z-index: 0;">
            <source src="{{ asset($mobileVideoFile) }}" type="video/mp4">
            Your browser does not support the video tag.
        </video>
    @endif
    </section>
    <section>
        <div class="py-5">
            <style>
                .mobile-banner { background: url('/assets/f_assets/image/ban.jpg') center top / cover no-repeat; min-height: 300px; }
                /* Smaller SORT & FILTER toggle */
                .filter .navbar-toggler {
                    font-size: 16px;
                    padding: 4px 10px;
                    line-height: 1.1;
                    border: none !important;
                    border-radius: 4px;
                    outline: none !important;
                    box-shadow: none !important;
                }
                .filter .navbar-toggler:focus,
                .filter .navbar-toggler:hover,
                .filter .navbar-toggler:active {
                    border: none !important;
                    outline: none !important;
                    box-shadow: none !important;
                }
                /* Make image area fully clickable */
                .card .card-img a { display: block; }
                .card .card-img img { width: 100%; height: auto; }
                /* Allow click-through on overlays like "New" */
                .card .card-img-overlay { pointer-events: none; }
                /* Promo tile sizing */
                .promo-tile { display: flex; height: 100%; }
                .promo-tile > a { flex: 1 1 auto; display: block; height: 100%; }
                .promo-tile img { height: 100%; width: 100%; object-fit: cover; display: block; }
            </style>

            {{-- filter --}}

            <style>
                .offcanvas-modern {
                    font-family: 'Inter', Arial, sans-serif;
                    background: rgb(255, 255, 255) !important;
                    color: #222;
                    min-width: 320px;
                    max-width: 380px;
                }
                
                /* Mobile full width offcanvas */
                @media (max-width: 767px) {
                    .offcanvas-modern {
                        min-width: 100% !important;
                        max-width: 100% !important;
                        width: 100% !important;
                    }
                }
                .offcanvas-modern .offcanvas-header {
                    border-bottom: 1px solid rgb(255, 255, 255);
                    padding-bottom: 0.5rem;
                    background: rgb(255, 255, 255);
                }
                .offcanvas-modern .offcanvas-title {
                    font-size: 1.1rem;
                    font-weight: 400;
                    letter-spacing: 0.02em;
                    text-transform: uppercase;
                    color: #222;
                }
                .offcanvas-modern .btn-close {
                    filter: none;
                    opacity: 1;
                    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%23000'%3e%3cpath d='M.293.293a1 1 0 0 1 1.414 0L8 6.586 14.293.293a1 1 0 1 1 1.414 1.414L9.414 8l6.293 6.293a1 1 0 0 1-1.414 1.414L8 9.414l-6.293 6.293a1 1 0 0 1-1.414-1.414L6.586 8 .293 1.707a1 1 0 0 1 0-1.414z'/%3e%3c/svg%3e");
                    background-size: 1em;
                    width: 1em;
                    height: 1em;
                    cursor: pointer;
                    transition: opacity 0.2s;
                }
                .offcanvas-modern .btn-close:hover {
                    opacity: 0.7;
                }
                .filter-section-title {
                    font-size: 0.98rem;
                    font-weight: 300;
                    letter-spacing: 0.01em;
                    margin-bottom: 0.8rem;
                    margin-top: 1.5rem;
                    text-transform: uppercase;
                    color: #222;
                    display: flex;
                    align-items: center;
                    justify-content: space-between;
                    border-bottom: 1px solid #ecebe7;
                    padding-bottom: 0.5rem;
                    cursor: pointer;
                }
                .sort-list, .category-list, .subcategory-list {
                    list-style: none;
                    padding-left: 0;
                    margin-bottom: 0;
                }
                .sort-list {
                    max-height: 0;
                    overflow: hidden;
                    transition: max-height 0.3s ease-out;
                }
                .sort-list.show {
                    max-height: 300px;
                    transition: max-height 0.3s ease-in;
                }
                .sort-list li, .category-list > li {
                    padding: 0.4rem 0;
                    font-size: 0.97rem;
                    display: flex;
                    align-items: center;
                    cursor: pointer;
                    color: #222;
                }
                .sort-list li.selected {
                    font-weight: 600;
                    color: #111;
                }
                .sort-list li .diamond {
                    font-size: 0.7em;
                    margin-right: 0.7em;
                    color: #b2b2b2;
                }
                .sort-list li.selected .diamond {
                    color: #111;
                }
                .sort-list li:not(.selected) .diamond {
                    color: #b2b2b2;
                }
                .category-list > li {
                    font-weight: 400;
                    text-transform: uppercase;
                    margin-top: 1.2rem;
                    display: flex;
                    align-items: flex-start;
                    justify-content: space-between;
                    color: #222;
                    flex-wrap: wrap;
                    cursor: pointer;
                }
                .category-list > li > span:first-child {
                    flex: 1;
                }
                .category-toggle {
                    font-size: 1.1em;
                    color: #b2b2b2;
                    cursor: pointer;
                    user-select: none;
                    display: inline-block;
                    width: 20px;
                    text-align: center;
                    margin-left: 10px;
                }
                .category-list .subcategory-list {
                    margin-top: 0.5rem;
                    margin-left: 0;
                    list-style: none;
                    padding-left: 0;
                    width: 100%;
                    flex-basis: 100%;
                    max-height: 0;
                    overflow: hidden;
                    transition: max-height 0.3s ease-out;
                }
                .category-list .subcategory-list.show {
                    max-height: 300px;
                    transition: max-height 0.3s ease-in;
                }
                .category-list .subcategory-list li {
                    font-weight: 400;
                    text-transform: none;
                    font-size: 0.96rem;
                    margin: 0.1rem 0;
                    padding: 0.2rem 0 0.2rem 0.5rem;
                    cursor: pointer;
                    color: #222;
                    display: flex;
                    align-items: center;
                }
                .filter-subcat-checkbox { margin-right: 8px; accent-color: #111; }
                .filter-subcat-checkbox:focus { box-shadow: none !important; outline: none !important; }
                .filter-subcat-checkbox:active { box-shadow: none !important; outline: none !important; }
                .filter-subcat-checkbox:hover { box-shadow: none !important; }
                /* Ensure black fill and border when checked (Bootstrap override) */
                .form-check-input.filter-subcat-checkbox:checked { background-color: #111; border-color: #111; }
                .form-check-input.filter-subcat-checkbox { border-color: #bbb; }
                .category-list .subcategory-list li .subcat-label { margin-left: 2px; }
                .category-list .subcategory-list li .diamond {
                    margin-right: 0.7em;
                    font-size: 0.7em;
                    color: #b2b2b2;
                }
                .category-list .subcategory-list li.selected .diamond {
                    color: #111;
                }
                .offcanvas-modern hr {
                    border-color:rgb(255, 255, 255);
                    margin: 1.2rem 0 1rem 0;
                }
                .filter-actions {
                    position: sticky;
                    bottom: -16px;
                    background:rgb(255, 255, 255);
                    padding: 12px 0 0 0;
                }
                .filter-actions-inner {
                    border-top: 1px solid rgb(255, 255, 255);
                    padding-top: 12px;
                    display: flex;
                    gap: 10px;
                }
                .filter-actions .btn {
                    border-radius: 10px;
                    font-size: 13px;
                    padding: 8px 14px;
                }
                .offcanvas-modern .offcanvas-body {
                    background: rgb(255, 255, 255);
                    padding: 1rem;
                }
            </style>
            <div class="navbar navbar-white align-items-center filter position-relative justify-content-center">
                <h2 class="m-0 py-3 title text-black text-uppercase text-center w-100">online shopping store</h2>
            </div>
            {{-- Dynamic Products Grid --}}
            <div class="row onlineStore g-2 pt-3">
                @php
                    $absoluteStart = ($products->perPage() * ($products->currentPage() - 1)) + 1;
                    $absoluteEnd = $absoluteStart + $products->count() - 1;
                    $cursor = 0; // local index in the page collection
                    $rendered = 0;
                @endphp
                @while($cursor < $products->count())
                    @php
                        $absIndex = $absoluteStart + $cursor;
                        $isTileRow = ($absIndex === 9) || ($absIndex === 21); // immediately after 8th and 20th absolute
                    @endphp
                    @if($isTileRow)
                        {{-- Tile row: tile + 4 products (2x2) --}}
                        <div class="col-12">
                            <div class="row g-2 align-items-stretch">
                                {{-- Left: Tile --}}
                                @if($absIndex == 9)
                                <div class="col-md-6 promo-tile">
                                    <a href="#" target="_blank">
                                        <div class="d-flex align-items-center justify-content-center h-100" style="height: 126vh;">
                                            <img src="{{ asset('assets/f_assets/image/Shop_Online_web_Banner_Mobile_size.jpg') }}" alt="Promotional Banner" class="img-fluid w-100" style="height: 126vh; object-fit: cover;">
                </div>
                                    </a>
                                </div>
                                @endif
                                {{-- Right: 4 products --}}
                        <div class="col-md-6">
                                    <div class="row g-2">
                                        @for($i = 0; $i < 4 && ($cursor + $i) < $products->count(); $i++)
                                            @php $sub = $products[$cursor + $i]; @endphp
                                            <div class="col-6">
                                                @include('public.partials.product-card', ['product' => $sub])
                                </div>
                                        @endfor
                        </div>
                                </div>
                                @if($absIndex == 21)
                                <div class="col-md-6 promo-tile">
                                    <a href="#" target="_blank">
                                        <div class="d-flex align-items-center justify-content-center h-100" style="height: 126vh;">
                                            <img src="{{ asset('assets/f_assets/image/Shop_Online_web_Banner_Mobile_size.jpg') }}" alt="Promotional Banner" class="img-fluid w-100" style="height: 126vh; object-fit: cover;">
                        </div>
                                    </a>
                                </div>
                                @endif
                            </div>
                        </div>
                        @php $cursor += 4; @endphp
                    @else
                        {{-- Standard row: 4 products --}}
                        @for($col = 0; $col < 4 && $cursor < $products->count(); $col++)
                            @php $prod = $products[$cursor]; @endphp
                <div class="col-md-3">
                                @include('public.partials.product-card', ['product' => $prod])
                            </div>
                            @php $cursor++; @endphp
                        @endfor
                    @endif
                @endwhile
                @if($products->count() === 0)
                    <div class="col-12">
                        <div class="text-center py-5 text-muted">No products available.</div>
                    </div>
                @endif
            </div>
            @php
                $hasActiveFilters = request()->filled('subcat_pairs') || request()->filled('subcat_name') || request()->filled('cat_name') || request()->filled('tags');
            @endphp
            @if($products->count() > 0)
            <div class="text-center py-4">
                <div style="font-size: 1rem; letter-spacing: 0.2em; margin-bottom: 1.5rem;">
                    @if($hasActiveFilters)
                        SHOWING {{ $products->count() }} OF {{ $products->total() }} PRODUCTS
                    @else
                    SHOWING {{ $products->count() + ($products->perPage() * ($products->currentPage() - 1)) }} OF {{ $products->total() }} PRODUCTS
                    @endif
                </div>
                @if(!$hasActiveFilters && $products->currentPage() < $products->lastPage())
                    <button id="loadMoreBtn"
                            style="background: #e3e4e5; border: none; color: #222; font-size: 0.8rem; letter-spacing: 0.15em; padding: 0.8rem 2rem; border-radius: 8px; font-family: inherit; font-weight: 400; box-shadow: none; transition: background 0.2s;"
                            data-page="{{ $products->currentPage() + 1 }}"
                            data-last-page="{{ $products->lastPage() }}">
                        LOAD MORE
                    </button>
                @endif
            </div>
            @endif
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const loadMoreBtn = document.getElementById('loadMoreBtn');
                    if (!loadMoreBtn) return;

                    loadMoreBtn.addEventListener('click', function() {
                        const btn = this;
                        const nextPage = btn.getAttribute('data-page');
                        const lastPage = btn.getAttribute('data-last-page');
                        btn.disabled = true;
                        btn.textContent = 'Loading...';

                        // Preserve current query (sort/tags)
                        const url = new URL(window.location.href);
                        url.searchParams.set('page', nextPage);

                        fetch(url.toString(), { headers: { 'X-Requested-With': 'XMLHttpRequest' }})
                        .then(response => response.text())
                        .then(html => {
                            const parser = new DOMParser();
                            const doc = parser.parseFromString(html, 'text/html');
                            const incomingGrid = doc.querySelector('.onlineStore');
                            const grid = document.querySelector('.onlineStore');
                            // Append all direct children from incoming grid (supports col-md-3, col-12 tile rows, etc.)
                            Array.from(incomingGrid.children).forEach(child => grid.appendChild(child));

                            // Update the count display
                            const totalShown = grid.querySelectorAll('.card.addToCartProductDetailsTop').length;
                            const counter = document.querySelector('.text-center > div');
                            if (counter) counter.textContent = `SHOWING ${totalShown} OF {{ $products->total() }} PRODUCTS`;

                            // Update button state
                            let newPage = parseInt(nextPage) + 1;
                            btn.setAttribute('data-page', newPage);
                            btn.disabled = false;
                            btn.textContent = 'LOAD MORE';
                            if (parseInt(nextPage) >= parseInt(lastPage)) {
                                btn.style.display = 'none';
                            }
                        })
                        .catch(() => {
                            btn.disabled = false;
                            btn.textContent = 'LOAD MORE';
                        });
                    });
                });
            </script>
        </div>
    </section>
    @include('public.partials.image-gallery-modal')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Delegate clicks on product images to open zoom modal instead of navigating
            const grid = document.querySelector('.onlineStore');
            if (!grid) return;
            grid.addEventListener('click', function(e) {
                const anchor = e.target.closest('.carousel-item a');
                if (!anchor) return;
                e.preventDefault();
                const carousel = anchor.closest('.carousel');
                if (!carousel) return;
                const carouselId = carousel.getAttribute('id');
                const items = Array.from(carousel.querySelectorAll('.carousel-item'));
                const clickedItem = anchor.closest('.carousel-item');
                const index = Math.max(0, items.indexOf(clickedItem));
                if (typeof openImageModal === 'function') {
                    openImageModal(carouselId, index);
                }
            });
        });
    </script>
@endsection
