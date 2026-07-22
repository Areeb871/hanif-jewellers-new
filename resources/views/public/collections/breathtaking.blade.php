@extends('public.layouts.header_latest')

@section('content')
    @if(isset($breathtakingSubcategory) && $breathtakingSubcategory && $breathtakingSubcategory->banner_url)
        {{-- Desktop Video --}}
        <section class="gehnawaSection p-0 position-relative d-none d-md-block">
            @if(Str::endsWith($breathtakingSubcategory->banner_url, ['.mp4', '.webm', '.ogg']))
                <video 
                    autoplay 
                    loop 
                    muted 
                    playsinline 
                    class="video-desktop"
                    style="width:100%; height:120vh; object-fit:cover;"
                    onerror="this.style.display='none'; this.nextElementSibling.style.display='block';">
                    <source src="{{ asset($breathtakingSubcategory->banner_url) }}" type="video/{{ pathinfo($breathtakingSubcategory->banner_url, PATHINFO_EXTENSION) }}">
                    Your browser does not support the video tag.
                </video>
                <div class="video-fallback-desktop" style="display:none; width:100%; height:120vh; background-image:url('{{ asset($breathtakingSubcategory->banner_url) }}'); background-size:cover; background-position:center;"></div>
            @else
                <div style="width:100%; height:120vh; background-image:url('{{ asset($breathtakingSubcategory->banner_url) }}'); background-size:cover; background-position:center;"></div>
            @endif
        </section>

        {{-- Mobile Video --}}
        @php
            $mobileVideoPath = 'assets/f_assets/image/Breathtaking Mobile Size Banner.mp4';
            $mobileVideo = ($breathtakingSubcategory->slug === 'breathtaking') ? $mobileVideoPath : $breathtakingSubcategory->banner_url;
        @endphp
        <section class="d-md-none" style="position: relative; height: 100vh; overflow: hidden; width: 100%;">
            @if(Str::endsWith($mobileVideo, ['.mp4', '.webm', '.ogg']))
                <video 
                    autoplay 
                    loop 
                    muted 
                    playsinline 
                    style="position: absolute; left: 0; top: 0; width: 100%; height: 100%; object-fit: cover; object-position: center bottom; z-index: 0;">
                    <source src="{{ asset($mobileVideo) }}" type="video/{{ pathinfo($mobileVideo, PATHINFO_EXTENSION) }}">
                    Your browser does not support the video tag.
                </video>
            @else
                <div style="position: absolute; left: 0; top: 0; width: 100%; height: 100%; background-image:url('{{ asset($mobileVideo) }}'); background-size:cover; background-position:center bottom; z-index: 0;"></div>
            @endif
        </section>
    @endif

    <section class="py-4">
        <style>
            /* Mobile video section fixes */
            @media (max-width: 767.98px) {
                .gehnawaSection {
                    display: none !important;
                }
                section.d-md-none[style*="height: 100vh"] {
                    margin: 0 !important;
                    padding: 0 !important;
                    display: block !important;
                }
            }
            
            /* Product grid layout */
            .onlineStore {
                justify-content: center;
            }
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

            /* Pagination Dots */
            .pagination-dots {
                display: flex;
                justify-content: center;
                align-items: center;
                gap: 10px;
                padding: 20px 0;
            }

            .pagination-dot {
                width: 10px !important;
                height: 10px !important;
                border-radius: 50% !important;
                background-color: #d3d3d3 !important; /* inactive gray */
                cursor: pointer;
                transition: background-color 0.3s ease, transform 0.3s ease;
                border: none !important;
                padding: 0 !important;
            }

            .pagination-dot:hover {
                background-color: #999 !important;
                transform: scale(1.2);
            }

            .pagination-dot.active {
                background-color: #000 !important; /* black active dot */
                width: 10px !important;
                height: 10px !important;
                border-radius: 50% !important;
                transform: scale(1.3);
            }
        </style>
        <h4 class="text-center py-3 mt-4 text-uppercase">Discover Our Collection</h4>
        <div class="container-fluid px-3">
            <div class="row onlineStore g-2 pt-3" id="breathtakingGrid">
                @if(isset($products) && $products->count())
                    @foreach($products as $prod)
                        <div class="col-6 col-sm-4 col-md-3 col-lg-3">
                            @include('public.partials.product-card1', ['product' => $prod])
                        </div>
                    @endforeach
                @else
                    <div class="col-12"><div class="text-center py-5 text-muted">No products available.</div></div>
                @endif
            </div>
        </div>

        @if(isset($products) && $products->count() > 0 && $products->lastPage() > 1)
        <div class="pagination-dots" id="paginationDots">
            @for($i = 1; $i <= $products->lastPage(); $i++)
                <button class="pagination-dot {{ $i == $products->currentPage() ? 'active' : '' }}" 
                        data-page="{{ $i }}"
                        aria-label="Go to page {{ $i }}"></button>
            @endfor
        </div>
        @endif
    </section>
    <div class="row">
            <style>
                    .app-btn {
                        padding: 6px 16px !important;
                    }
                    .m-1{
                        margin:1rem !important;
                    }
            </style>
            <div class="text-center">
                <x-book-appointment class="m-1" />
            </div>
            <!-- <div class="col-md-6 text-center">
                <x-shop-now :href="route('subcategory', ['subcategory' => 'gohar'])" class="m-5 btn border btn-outline-dark px-5 py-2" style="padding: 10px 100px !important" />
            </div> -->
        </div>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        function getGrid(container) {
            return container.querySelector('#breathtakingGrid');
        }

        function loadPage(pageNumber) {
            const url = new URL(window.location.href);
            url.searchParams.set('page', String(pageNumber));
            window.history.pushState({}, '', url.toString());

            const grid = getGrid(document);
            if (grid) grid.style.opacity = '0.5';

            fetch(url.toString(), { headers: { 'X-Requested-With': 'XMLHttpRequest' }, cache: 'no-cache' })
                .then(response => response.text())
                .then(html => {
                    const parser = new DOMParser();
                    const doc = parser.parseFromString(html, 'text/html');
                    const incomingGrid = getGrid(doc);
                    const currentGrid = getGrid(document);
                    if (incomingGrid && currentGrid) currentGrid.innerHTML = incomingGrid.innerHTML;

                    const incomingDots = doc.querySelector('#paginationDots');
                    const currentDots = document.querySelector('#paginationDots');
                    if (incomingDots && currentDots) {
                        currentDots.innerHTML = incomingDots.innerHTML;
                        bindPaginationDots();
                    }

                    if (grid) grid.style.opacity = '1';
                    currentGrid.scrollIntoView({ behavior: 'smooth', block: 'start' });
                })
                .catch(() => window.location.href = url.toString());
        }

        function bindPaginationDots() {
            const dots = document.querySelectorAll('.pagination-dot');
            dots.forEach(dot => {
                dot.addEventListener('click', function() {
                    const page = parseInt(this.getAttribute('data-page') || '1', 10);
                    loadPage(page);
                });
            });
        }

        bindPaginationDots();
    });
    </script>
@endsection
