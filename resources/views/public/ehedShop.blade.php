@extends('public.layouts.header_latest')

@section('content')
 <!-- Desktop Video Banner (match gehnawa.blade structure) -->
 <section class="sectionOne d-flex align-items-end justify-content-center text-center p-5 d-md-block d-none" style="position: relative; min-height: 500px; overflow: hidden;">
        <video autoplay loop muted playsinline style="position: absolute; left: 0; top: 0; width: 100%; height: 100%; object-fit: cover; z-index: 0;">
            <source src="{{ asset('assets/f_assets/image/Ehad Banner Video.mp4') }}" type="video/mp4">
            Your browser does not support the video tag.
        </video>
    </section>
    <!-- Mobile Video Banner -->
    <section class="d-md-none" style="position: relative; height: 110vh; overflow: hidden;">
        <video autoplay loop muted playsinline style="position: absolute; left: 0; top: 0; width: 100%; height: 100%; object-fit: cover; z-index: 0;">
            <source src="{{ asset('assets/f_assets/image/Ehad Mob Banner Video.mp4') }}" type="video/mp4">
            Your browser does not support the video tag.
        </video>
    </section>

    <section>
        <div class="py-5">
            <style>
                /*.desktop-banner { background: url('/assets/f_assets/image/Online%20Store%20Web%20banner.jpg') center center / cover no-repeat; min-height: 400px; }
                .mobile-banner { background: url('/assets/f_assets/image/Online%20Store%20Mob%20banner.jpg') center top / cover no-repeat; min-height: 300px; }
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
                /* Collapsible lists for METAL TEXTURE/BAND */
                .category-list.collapsible {
                    max-height: 1000px; /* open by default */
                    overflow: hidden;
                    transition: max-height 0.3s ease-out;
                }
                .category-list.collapsible:not(.show) {
                    max-height: 0;
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
                    display: flex;
                    align-items: flex-start;
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
                /* Add a little gap between tag checkboxes and their labels */
                .filter-tag-checkbox { margin-right: 8px; }
                /* Make tag checkboxes shadow-free and black */
                .form-check-input.filter-tag-checkbox { accent-color: #111; border-color: #bbb; box-shadow: none !important; outline: none !important; }
                .form-check-input.filter-tag-checkbox:focus,
                .form-check-input.filter-tag-checkbox:active,
                .form-check-input.filter-tag-checkbox:hover { box-shadow: none !important; outline: none !important; }
                .form-check-input.filter-tag-checkbox:checked { background-color: #111; border-color: #111; }
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
                .my-3 {
                    margin-top: 1.5rem !important;
                    margin-bottom: 1rem !important;
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
                <h2 class="m-0 my-3 title text-black text-uppercase text-center w-100"></h2>
                <button class="navbar-toggler border-0 text-black position-absolute end-0" type="button" data-bs-toggle="offcanvas"
                    data-bs-target="#offcanvasFilter" aria-controls="offcanvasFilter" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span> SORT & FILTER
                </button>
            </div>
            <div class="offcanvas offcanvas-end offcanvas-modern" tabindex="-1" id="offcanvasFilter"
                aria-labelledby="offcanvasFilterLabel" data-bs-backdrop="true" data-bs-scroll="false">
                <div class="offcanvas-header">
                    <span class="offcanvas-title" id="offcanvasFilterLabel">SORT & FILTER</span>
                    <button type="button" class="btn-close btn-close-black" data-bs-dismiss="offcanvas"
                        aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <form method="GET" action="{{ url('ehedshop') }}" id="filterForm">
                        <input type="hidden" name="tags" id="tagsInput" value="{{ request('tags') }}">
                        <div>
                            <div class="filter-section-title" onclick="toggleCategory('sortList', this.querySelector('.category-toggle'))" style="font-size: 14px !important;">
                                Sort By
                                <span class="category-toggle">+</span>
                            </div>
                            <ul class="sort-list" id="sortList">
                                <li data-value="" class="{{ !request('sort') ? 'selected' : '' }}">
                                    <span class="diamond">◆</span> Best Selling
                                </li>
                                <li data-value="az" class="{{ request('sort')=='az' ? 'selected' : '' }}">
                                    <span class="diamond">◇</span> Alphabetically, A-Z
                                </li>
                                <li data-value="za" class="{{ request('sort')=='za' ? 'selected' : '' }}">
                                    <span class="diamond">◇</span> Alphabetically, Z-A
                                </li>
                                <li data-value="price_low_high" class="{{ request('sort')=='price_low_high' ? 'selected' : '' }}">
                                    <span class="diamond">◇</span> Price, low to high
                                </li>
                                <li data-value="price_high_low" class="{{ request('sort')=='price_high_low' ? 'selected' : '' }}">
                                    <span class="diamond">◇</span> Price, high to low
                                </li>
                                <li data-value="new_old" class="{{ request('sort')=='new_old' ? 'selected' : '' }}">
                                    <span class="diamond">◇</span> Date, new to old
                                </li>
                                <li data-value="old_new" class="{{ request('sort')=='old_new' ? 'selected' : '' }}">
                                    <span class="diamond">◇</span> Date, old to new
                                </li>
                            </ul>
                            <input type="hidden" name="sort" id="sortInput" value="{{ request('sort') }}">
                        </div>
                        <hr>
                        <hr>
                        <div class="mt-3">
                            <div class="filter-section-title" onclick="toggleCategory('tagListMetalTexture', this.querySelector('.category-toggle'))" style="font-size: 14px !important;">METAL TEXTURE <span class="category-toggle">+</span></div>
                            <ul class="category-list collapsible" id="tagListMetalTexture">
                                <li><input type="checkbox" class="form-check-input filter-tag-checkbox" value="white-gold" onclick="event.stopPropagation();"> <span class="subcat-label">White Gold</span></li>
                                <li><input type="checkbox" class="form-check-input filter-tag-checkbox" value="rose-gold" onclick="event.stopPropagation();"> <span class="subcat-label">Rose Gold</span></li>
                                <li><input type="checkbox" class="form-check-input filter-tag-checkbox" value="yellow-gold" onclick="event.stopPropagation();"> <span class="subcat-label">Yellow Gold</span></li>
                            </ul>
                        </div>
                        <div class="mt-3">
                            <div class="filter-section-title" onclick="toggleCategory('tagListBand', this.querySelector('.category-toggle'))" style="font-size: 14px !important;">BAND <span class="category-toggle">+</span></div>
                            <ul class="category-list collapsible" id="tagListBand">
                                <li><input type="checkbox" class="form-check-input filter-tag-checkbox" value="2mm" onclick="event.stopPropagation();"> <span class="subcat-label">2mm</span></li>
                                <li><input type="checkbox" class="form-check-input filter-tag-checkbox" value="3mm" onclick="event.stopPropagation();"> <span class="subcat-label">3mm</span></li>
                                <li><input type="checkbox" class="form-check-input filter-tag-checkbox" value="4mm" onclick="event.stopPropagation();"> <span class="subcat-label">4mm</span></li>
                                <li><input type="checkbox" class="form-check-input filter-tag-checkbox" value="5mm" onclick="event.stopPropagation();"> <span class="subcat-label">5mm</span></li>
                                <li><input type="checkbox" class="form-check-input filter-tag-checkbox" value="6mm" onclick="event.stopPropagation();"> <span class="subcat-label">6mm</span></li>
                            </ul>
                        </div>
                        <div class="mt-3">
                            <div class="filter-section-title" onclick="toggleCategory('tagListTexture', this.querySelector('.category-toggle'))" style="font-size: 14px !important;">TEXTURE <span class="category-toggle">+</span></div>
                            <ul class="category-list collapsible" id="tagListTexture">
                                <li><input type="checkbox" class="form-check-input filter-tag-checkbox" value="sand" onclick="event.stopPropagation();"> <span class="subcat-label">Sand</span></li>
                                <li><input type="checkbox" class="form-check-input filter-tag-checkbox" value="silk" onclick="event.stopPropagation();"> <span class="subcat-label">Silk</span></li>
                                <li><input type="checkbox" class="form-check-input filter-tag-checkbox" value="polish" onclick="event.stopPropagation();"> <span class="subcat-label">Polish</span></li>
                            </ul>
                        </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <script>
                // Simple toggle function
                function toggleCategory(targetId, element) {
                    const target = document.getElementById(targetId);
                    if (target) {
                        const isExpanded = target.classList.contains('show');
                        if (isExpanded) {
                            // Collapse
                            target.classList.remove('show');
                            element.textContent = '+';
                        } else {
                            // Expand
                            target.classList.add('show');
                            element.textContent = '−';
                        }
                    }
                }
                
                // Close filter function
                function closeFilter() {
                    const offcanvas = document.getElementById('offcanvasFilter');
                    if (offcanvas) {
                        const bsOffcanvas = bootstrap.Offcanvas.getInstance(offcanvas);
                        if (bsOffcanvas) {
                            bsOffcanvas.hide();
                        }
                    }
                }
                
                // Sort selection and category toggles
                document.addEventListener('DOMContentLoaded', function() {
                    // Close button functionality
                    const closeBtn = document.querySelector('#offcanvasFilter .btn-close');
                    if (closeBtn) {
                        closeBtn.addEventListener('click', function(e) {
                            e.preventDefault();
                            closeFilter();
                        });
                    }
                    
                    // Close on escape key
                    document.addEventListener('keydown', function(e) {
                        if (e.key === 'Escape') {
                            closeFilter();
                        }
                    });
                    
                    // Sort selection (AJAX - no reload)
                    const sortList = document.getElementById('sortList');
                    const sortInput = document.getElementById('sortInput');
                    const filterForm = document.getElementById('filterForm');
                    if (sortList && sortInput && filterForm) {
                        function buildUrlForSort() {
                            const url = new URL(window.location.href);
                            // reset page
                            url.searchParams.set('page', '1');
                            // set sort
                            if (sortInput.value) {
                                url.searchParams.set('sort', sortInput.value);
                            } else {
                                url.searchParams.delete('sort');
                            }
                            // persist tags
                            const tagsInput = document.getElementById('tagsInput');
                            if (tagsInput && tagsInput.value) {
                                url.searchParams.set('tags', tagsInput.value);
                            }
                            return url;
                        }

                        function fetchAndRenderForSort() {
                            const url = buildUrlForSort();
                            window.history.pushState({}, '', url.toString());
                            fetch(url.toString(), { headers: { 'X-Requested-With': 'XMLHttpRequest' }})
                                .then(resp => resp.text())
                                .then(html => {
                                    const parser = new DOMParser();
                                    const doc = parser.parseFromString(html, 'text/html');
                                    const incomingGrid = doc.querySelector('.ehedStore');
                                    const grid = document.querySelector('.ehedStore');
                                    if (incomingGrid && grid) {
                                        grid.innerHTML = incomingGrid.innerHTML;
                                    }
                                    const incomingFooter = doc.querySelector('.text-center.py-4');
                                    const currentFooter = document.querySelector('.text-center.py-4');
                                    if (currentFooter) {
                                        if (incomingFooter) {
                                            currentFooter.innerHTML = incomingFooter.innerHTML;
                                        } else {
                                            currentFooter.remove();
                                        }
                                    } else if (incomingFooter && grid) {
                                        grid.parentElement.insertAdjacentHTML('beforeend', incomingFooter.outerHTML);
                                    }
                                    // Re-bind Load More on new footer
                                    if (typeof window.bindLoadMore === 'function') { window.bindLoadMore(); }
                                })
                                .catch(() => {});
                        }

                        sortList.querySelectorAll('li').forEach(li => {
                            li.addEventListener('click', function() {
                                // UI state
                                sortList.querySelectorAll('li').forEach(x => {
                                    x.classList.remove('selected');
                                    x.querySelector('.diamond').textContent = '◇';
                                });
                                this.classList.add('selected');
                                this.querySelector('.diamond').textContent = '◆';
                                sortInput.value = this.getAttribute('data-value');
                                // Fetch & render
                                fetchAndRenderForSort();
                            });
                        });
                    }
                    
                    // Checkbox multi-select handling (AJAX - no page reload)
                    (function() {
                        const tagCheckboxes = document.querySelectorAll('.filter-tag-checkbox');
                        const tagsInput = document.getElementById('tagsInput');
                        const filterForm = document.getElementById('filterForm');
                        if (!filterForm) return;

                        function writeSelectionsToInputs() {
                            const tagValues = [];
                            tagCheckboxes.forEach(cb => { if (cb.checked) tagValues.push(cb.value); });
                            if (tagsInput) tagsInput.value = tagValues.join(',');
                        }

                        function buildUrlWithFormParams() {
                            const url = new URL(window.location.href);
                            // Reset to first page
                            url.searchParams.set('page', '1');
                            // Persist sort
                            const sortInput = document.getElementById('sortInput');
                            if (sortInput && sortInput.value) {
                                url.searchParams.set('sort', sortInput.value);
                            } else {
                                url.searchParams.delete('sort');
                            }
                            // Apply tags
                            if (tagsInput && tagsInput.value) {
                                url.searchParams.set('tags', tagsInput.value);
                            } else {
                                url.searchParams.delete('tags');
                            }
                            return url;
                        }

                        function removeFooterNow() {
                            const footer = document.querySelector('.text-center.py-4');
                            if (footer) footer.remove();
                        }

                        function fetchAndRender() {
                            const url = buildUrlWithFormParams();
                            // Update browser URL without reload
                            window.history.pushState({}, '', url.toString());
                            // Fetch HTML and replace grid + footer controls
                            fetch(url.toString(), { headers: { 'X-Requested-With': 'XMLHttpRequest' }})
                                .then(resp => resp.text())
                                .then(html => {
                                    const parser = new DOMParser();
                                    const doc = parser.parseFromString(html, 'text/html');
                                    const incomingGrid = doc.querySelector('.ehedStore');
                                    const grid = document.querySelector('.ehedStore');
                                    if (incomingGrid && grid) {
                                        grid.innerHTML = incomingGrid.innerHTML;
                                    }
                                    // Replace footer area
                                    const incomingFooter = doc.querySelector('.text-center.py-4');
                                    const currentFooter = document.querySelector('.text-center.py-4');
                                    if (currentFooter) {
                                        if (incomingFooter) {
                                            currentFooter.innerHTML = incomingFooter.innerHTML;
                                        } else {
                                            currentFooter.remove();
                                        }
                                    } else if (incomingFooter) {
                                        // If footer didn't exist but incoming has one, append after grid
                                        grid.parentElement.insertAdjacentHTML('beforeend', incomingFooter.outerHTML);
                                    }
                                    // Re-bind Load More after filter rendering
                                    if (typeof window.bindLoadMore === 'function') { window.bindLoadMore(); }
                                })
                                .catch(() => { /* ignore */ });
                        }

                        // Restore and bind tag checkboxes
                        if (tagsInput) {
                            const existingTags = (tagsInput.value || '').split(',').map(s => s.trim()).filter(Boolean);
                            const existingTagsSet = new Set(existingTags);
                            tagCheckboxes.forEach(cb => {
                                if (existingTagsSet.has(cb.value)) cb.checked = true;
                                cb.addEventListener('click', function(e) {
                                    e.stopPropagation();
                                    writeSelectionsToInputs();
                                    removeFooterNow();
                                    fetchAndRender();
                                });
                            });
                        }
                    })();
                });
            </script>

            {{-- Dynamic Products Grid --}}
            <div class="row ehedStore g-2 pt-3">
                @forelse($products as $product)
                    <div class="col-md-3">
                        @include('public.partials.product-card-new', ['product' => $product])
                    </div>
                @empty
                    <div class="col-12">
                        <div class="text-center py-5 text-muted">No products available.</div>
                    </div>
                @endforelse
            </div>
            @php
                $hasActiveFilters = request()->filled('tags');
            @endphp
            @if($products->count() > 0)
            <div class="text-center py-4">
                <div class="products-counter" data-total="{{ $products->total() }}" style="font-size: 1rem; letter-spacing: 0.2em; margin-bottom: 1.5rem;">
                    @if($hasActiveFilters)
                        SHOWING {{ $products->count() }} OF {{ $products->total() }} PRODUCTS
                    @else
                    SHOWING {{ $products->count() + ($products->perPage() * ($products->currentPage() - 1)) }} OF {{ $products->total() }} PRODUCTS
                    @endif
                </div>
                @if($products->currentPage() < $products->lastPage())
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
                    // Expose a reusable binder so we can reattach after AJAX renders
                    window.bindLoadMore = function bindLoadMore() {
                        const loadMoreBtn = document.getElementById('loadMoreBtn');
                        if (!loadMoreBtn) return;
                        // Remove previous listeners by cloning
                        const btn = loadMoreBtn.cloneNode(true);
                        loadMoreBtn.parentNode.replaceChild(btn, loadMoreBtn);

                    function getGrid(container) {
                        return container.querySelector('.ehedStore');
                    }

                    function appendIncomingItems(doc) {
                        const currentGrid = getGrid(document);
                        if (!currentGrid) return 0;

                        // Primary: take children of incoming .ehedStore
                        let nodesToAppend = [];
                        const incomingGrid = getGrid(doc) || doc.querySelector('.ehedStore');
                        if (incomingGrid) {
                            nodesToAppend = Array.from(incomingGrid.children);
                        } else {
                            // Fallback: find product cards and append their closest column wrappers
                            const cards = Array.from(doc.querySelectorAll('.card.addToCartProductDetailsTop'));
                            nodesToAppend = cards.map(card => card.closest('.col-12, .col-md-3, .col-6') || card);
                        }
                        let appended = 0;
                        nodesToAppend.forEach(node => {
                            if (!node) return;
                            currentGrid.appendChild(node);
                            appended++;
                        });
                        return appended;
                    }

                    function updateCounter() {
                        const grid = getGrid(document);
                        if (!grid) return;
                        const totalShown = grid.querySelectorAll('.card.addToCartProductDetailsTop').length;
                        const counter = document.querySelector('.text-center .products-counter');
                        if (counter) {
                            const total = parseInt(counter.getAttribute('data-total') || '0', 10);
                            counter.textContent = `SHOWING ${totalShown} OF ${total} PRODUCTS`;
                        }
                    }

                    btn.addEventListener('click', function() {
                        const nextPage = parseInt(btn.getAttribute('data-page') || '2', 10);
                        const lastPage = parseInt(btn.getAttribute('data-last-page') || String(nextPage), 10);
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
                                updateCounter();

                                // Sync last page from incoming markup (in case it changed with filters)
                                const incomingBtn = doc.querySelector('#loadMoreBtn');
                                if (incomingBtn) {
                                    const incomingLast = parseInt(incomingBtn.getAttribute('data-last-page') || String(lastPage), 10);
                                    btn.setAttribute('data-last-page', String(incomingLast));
                                }

                                // Compute next state
                                const effectiveLast = parseInt(btn.getAttribute('data-last-page') || String(lastPage), 10);
                                // If nothing appended but we did receive a grid, try innerHTML append as a fallback
                                if (appended === 0) {
                                    const currentGrid = document.querySelector('.ehedStore');
                                    const incomingGrid2 = doc.querySelector('.ehedStore');
                                    if (currentGrid && incomingGrid2) {
                                        currentGrid.insertAdjacentHTML('beforeend', incomingGrid2.innerHTML);
                                        appended = incomingGrid2.children.length;
                                        updateCounter();
                                    }
                                }
                                const reachedEnd = nextPage >= effectiveLast || appended === 0;
                                if (reachedEnd) {
                                    btn.style.display = 'none';
                                } else {
                                    btn.setAttribute('data-page', String(nextPage + 1));
                                    btn.disabled = false;
                                    btn.textContent = 'LOAD MORE';
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
                });
            </script>
        </div>
    </section>
@endsection