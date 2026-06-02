@extends('public.layouts.header_latest')

@section('content')
   <link rel="stylesheet" href="{{ asset('assets/f_assets/css/solitaire.css') }}">
       <script src="{{ asset('assets/f_assets/js/filter.js') }}"></script>


<main class="hj-ring-page">

    <!-- HERO SECTION -->
    <section class="hj-ring-hero">
        <div class="hj-ring-hero-content">
            <h1>Solitaire Engagement Rings</h1>
            <p>
                Classic, sparkling and endlessly symbolic solitaire rings bring sleek style.
                Explore gemstone and diamond solitaire engagement rings in gold and platinum.
            </p>
        </div>

        <div class="hj-ring-hero-image">
            <img src="{{ asset('assets/f_assets/image/solitaire/image.png') }}" alt="Solitaire Engagement Rings">
        </div>
    </section>

    <!-- BREADCRUMB -->
    <section class="hj-ring-breadcrumb">
        <a href="#">Home</a>
        <span>/</span>
        <a href="#">Engagement Rings</a>
        <span>/</span>
        <a href="#">Solitaire Engagement Rings</a>
    </section>

<!-- FILTER SECTION -->
<div class="hj-filter-section">
    <input type="hidden" id="hjSortValue" value="featured">

    <!-- DESKTOP FILTER BAR -->
    <div class="hj-filter-top hj-desktop-filter-top">

        <div class="hj-filter-left">

            <button class="hj-filter-label" type="button">
                Filters
            </button>

            <button class="hj-filter-btn" id="shapeFilterBtn" type="button">
                <span>Shapes</span>
                <i class="hj-chevron"></i>
            </button>

            <button class="hj-filter-btn" id="materialFilterBtn" type="button">
                <span>Material Type</span>
                <i class="hj-chevron"></i>
            </button>

            <button class="hj-filter-btn" id="priceFilterBtn" type="button">
                <span>Price Ranges</span>
                <i class="hj-chevron"></i>
            </button>

        </div>

       <div class="hj-sort-box hj-custom-sort" id="hjDesktopSort">

    <button type="button" class="hj-sort-toggle" id="hjDesktopSortToggle">
        <span id="hjDesktopSortText">Sort: Featured</span>
                <i class="hj-chevron"></i>

    </button>

    <div class="hj-sort-dropdown" id="hjDesktopSortDropdown">
        <button type="button" data-sort-value="featured" data-sort-label="Sort: Featured">Featured</button>
        <button type="button" data-sort-value="newest" data-sort-label="Sort: Newest first">Newest first</button>
        <button type="button" data-sort-value="price_low_high" data-sort-label="Sort: Price: low to high">Price: low to high</button>
        <button type="button" data-sort-value="price_high_low" data-sort-label="Sort: Price: high to low">Price: high to low</button>
    </div>

</div>

    </div>
<!-- MOBILE FILTER BUTTON -->
<div class="hj-mobile-filter-top">
    <button type="button" class="hj-mobile-filter-open" id="hjOpenMobileFilters">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none">
            <path d="M4 7H13" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
            <path d="M17 7H20" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
            <path d="M15 5V9" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
            <path d="M4 17H9" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
            <path d="M13 17H20" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
            <path d="M11 15V19" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
        </svg>
        <span>Filters</span>
    </button>
</div>
    <!-- DESKTOP SHAPES PANEL -->
    <div class="hj-shapes-panel" id="shapesPanel">
           <div class="hj-shapes-list">

            <button class="hj-shape-item active" type="button">
                <img src="{{ asset('assets/f_assets/image/solitaire/round.png') }}" alt="Round">
                <span>Round</span>
            </button>

            <button class="hj-shape-item" type="button">
                <img src="{{ asset('assets/f_assets/image/solitaire/princess.png') }}" alt="Princess">
                <span>Princess</span>
            </button>

            <button class="hj-shape-item" type="button">
                <img src="{{ asset('assets/f_assets/image/solitaire/oval.png') }}" alt="Oval">
                <span>Oval</span>
            </button>

        </div>

         <button class="hj-clear-btn" type="button">
    <span class="hj-clear-x">×</span>
    <span>CLEAR ALL</span>
</button>
</div>

    <!-- DESKTOP MATERIAL PANEL -->
    <div class="hj-material-panel" id="materialPanel">
         <div class="hj-material-list">

        <button class="hj-material-item" type="button">
            <span class="hj-material-circle silver">14K</span>
            <span>14K Silver</span>
        </button>

        <button class="hj-material-item" type="button">
            <span class="hj-material-circle rose">14K</span>
            <span>14K Rose</span>
        </button>

        <button class="hj-material-item" type="button">
            <span class="hj-material-circle gold">14K</span>
            <span>14K Gold</span>
        </button>

        <button class="hj-material-item" type="button">
            <span class="hj-material-circle silver">18K</span>
            <span>18K Silver</span>
        </button>

        <button class="hj-material-item" type="button">
            <span class="hj-material-circle rose">18K</span>
            <span>18K Rose</span>
        </button>

        <button class="hj-material-item" type="button">
            <span class="hj-material-circle gold">18K</span>
            <span>18K Gold</span>
        </button>

        <button class="hj-material-item" type="button">
            <span class="hj-material-circle platinum">PT</span>
            <span>Platinum</span>
        </button>

    </div>

    <button class="hj-clear-material-btn" type="button">
        <span class="hj-clear-x">×</span>
        <span>CLEAR ALL</span>
    </button>

</div>

    <!-- DESKTOP PRICE PANEL -->
    <div class="hj-price-panel" id="pricePanel">
 <div class="hj-price-range-box">

        <div class="hj-range-wrap">
            <div class="hj-price-tooltip" id="priceTooltip">PKR 50,000</div>

            <input
                type="range"
                id="priceRange"
                min="0"
                max="200000"
                step="1000"
                value="0"
            >
        </div>

        <div class="hj-price-inputs">
            <input type="text" id="priceMin" value="PKR 0" readonly class="hj-price-min">
            <span>-</span>
            <input type="text" id="priceMax" value="PKR 200,000" readonly class="hj-price-max">
        </div>

    </div>

    <button class="hj-clear-price-btn" type="button">
        <span class="hj-clear-x">×</span>
        <span>CLEAR ALL</span>
    </button>

</div>
</div>

</div>


<!-- MOBILE FILTER MODAL -->
<div class="hj-mobile-filter-overlay" id="hjMobileFilterOverlay"></div>

<div class="hj-mobile-filter-drawer" id="hjMobileFilterDrawer">

    <div class="hj-mobile-filter-head">
        <span>Filters</span>
        <button type="button" id="hjCloseMobileFilters">Close</button>
    </div>

    <div class="hj-mobile-filter-content-area">

        <!-- SORT DROPDOWN -->
        <div class="hj-modal-sort-wrap" id="hjModalSortWrap">
            <button class="hj-modal-sort-toggle" type="button" id="hjModalSortToggle">
                <span id="hjModalSortText">Sort: Featured</span>
                <i class="hj-chevron"></i>
            </button>

            <div class="hj-modal-sort-dropdown" id="hjModalSortDropdown">
                <button type="button" data-sort-value="featured" data-sort-label="Sort: Featured">Featured</button>
                <button type="button" data-sort-value="newest" data-sort-label="Sort: Newest first">Newest first</button>
                <button type="button" data-sort-value="price_low_high" data-sort-label="Sort: Price: low to high">Price: low to high</button>
                <button type="button" data-sort-value="price_high_low" data-sort-label="Sort: Price: high to low">Price: high to low</button>
            </div>
        </div>


        <!-- METAL -->
        <div class="hj-mobile-filter-block active">
            <button type="button" class="hj-mobile-filter-title">
                <span>Metal</span>
                <i></i>
            </button>

            <div class="hj-mobile-filter-content">
                <div class="hj-mobile-metal-list">

                    <button type="button" class="active" data-value="14k-white">
                        <span class="hj-mobile-metal-circle silver">14K</span>
                        <small>14k White</small>
                    </button>

                    <button type="button" data-value="14k-gold">
                        <span class="hj-mobile-metal-circle gold">14K</span>
                        <small>14k Gold</small>
                    </button>

                    <button type="button" data-value="14k-rose">
                        <span class="hj-mobile-metal-circle rose">14K</span>
                        <small>14k Rose</small>
                    </button>

                </div>

                <input type="hidden" name="metal" id="mobileMetalInput" value="14k-white">
            </div>
        </div>


     <!-- PRICE -->
<div class="hj-mobile-filter-block active">
    <button type="button" class="hj-mobile-filter-title">
        <span>Price</span>
        <i></i>
    </button>

    <div class="hj-mobile-filter-content">

        <div class="hj-price-label-row">
            <span id="mobilePriceMinTop">500$</span>
            <span id="mobilePriceMaxTop">20,000$</span>
        </div>

        <div class="hj-price-slider-wrap">
    <div class="hj-price-slider-track"></div>
    <div class="hj-price-slider-fill" id="mobilePriceFill"></div>

    <input type="range" id="mobilePriceMinRange" min="500" max="20000" step="100" value="2500">
    <input type="range" id="mobilePriceMaxRange" min="500" max="20000" step="100" value="12000">
</div>

        <div class="hj-price-inputs">
            <input type="text" id="mobilePriceMinText" placeholder="min" value="">
            <input type="text" id="mobilePriceMaxText" value="$20,000">
        </div>

        <input type="hidden" name="min_price" id="mobileMinPriceInput" value="500">
        <input type="hidden" name="max_price" id="mobileMaxPriceInput" value="20000">

    </div>
</div>


        <!-- SHAPES -->
        <div class="hj-mobile-filter-block active">
            <button type="button" class="hj-mobile-filter-title">
                <span>Shapes</span>
                <i></i>
            </button>

            <div class="hj-mobile-filter-content">
                <div class="hj-mobile-shapes-grid">

                    <button type="button" class="active" data-value="round">
                        <img src="{{ asset('assets/f_assets/image/solitaire/round.png') }}" alt="Round">
                        <span>Round</span>
                    </button>

                    <button type="button" data-value="oval">
                        <img src="{{ asset('assets/f_assets/image/solitaire/oval.png') }}" alt="Oval">
                        <span>Oval</span>
                    </button>

                    <button type="button" data-value="princess">
                        <img src="{{ asset('assets/f_assets/image/solitaire/princess.png') }}" alt="Princess">
                        <span>Princess</span>
                    </button>

                </div>

                <input type="hidden" name="shapes" id="mobileShapesInput" value="round">
            </div>
        </div>

    </div>

    <div class="hj-mobile-filter-bottom">
        <button type="button" class="hj-mobile-view-products" id="hjMobileViewProducts">
            View Products (258)
        </button>
    </div>

</div>


    @php
        $products = [
            ['img' => 'ring.png', 'label' => 'Lab Created'],
            ['img' => 'ring.png', 'label' => 'Lab Created'],
            ['img' => 'ring.png', 'label' => 'Lab Created'],
            ['img' => 'ring.png', 'label' => 'Lab Created'],
            ['img' => 'ring.png', 'label' => 'Lab Created'],
            ['img' => 'ring.png', 'label' => 'Lab Created'],
            ['img' => 'ring.png', 'label' => 'Lab Created'],
            ['img' => 'ring.png', 'label' => 'Lab Created'],
            ['img' => 'ring.png', 'label' => 'Lab Created'],
            ['img' => 'ring.png', 'label' => 'Lab Created'],
        ];
    @endphp

<!-- PRODUCT GRID -->
<section class="hj-product-grid">

    @foreach($products as $product)
        <article class="hj-product-card">

            <div class="hj-product-image-box">
                <span class="hj-product-badge">
                    {{ $product['label'] ?? 'Lab Created' }}
                </span>

                <img 
                    src="{{ asset('assets/f_assets/image/solitaire/' . $product['img']) }}" 
                    alt="{{ $product['title'] ?? 'Emerald Solitaire Ring' }}"
                >
            </div>

            <div class="hj-product-info">
                <h3>
                    {{ $product['title'] ?? 'Emerald Solitaire Ring' }}
                </h3>

                <p>
                    {{ $product['desc'] ?? '3.8 Total Carat · Radiant · Solitaire · 14K White Gold' }}
                </p>

                <div class="hj-metal-options">
                    <span class="hj-metal active">14K</span>
                    <span class="hj-metal rose">14K</span>
                    <span class="hj-metal silver">18K</span>
                    <span class="hj-metal rose">18K</span>
                    <span class="hj-metal platinum">PT</span>
                </div>

                <div class="hj-size-options">
                    <button type="button">1.0</button>
                    <button type="button">1.8</button>
                    <button type="button">2.7</button>
                    <button type="button" class="active">3.8</button>
                    <button type="button">5.3</button>
                    <button type="button">7.25</button>
                </div>

                <div class="hj-price-row">
                    <del>{{ $product['old_price'] ?? '$2,540' }}</del>
                    <strong>{{ $product['price'] ?? '$1,530' }}</strong>
                    <span>{{ $product['discount'] ?? '40% off' }}</span>
                </div>
            </div>

        </article>
    @endforeach

</section>

 <!-- PAGINATION -->
<section class="hj-pagination">

    <a href="#" class="hj-page-arrow" aria-label="Previous page">
        <svg viewBox="0 0 24 24" class="hj-arrow-icon">
            <path d="M15 18L9 12L15 6"></path>
        </svg>
    </a>

    <a href="#" class="hj-page-number active">1</a>
    <a href="#" class="hj-page-number">2</a>
    <a href="#" class="hj-page-number">3</a>
    <a href="#" class="hj-page-number">4</a>

    <a href="#" class="hj-page-arrow" aria-label="Next page">
        <svg viewBox="0 0 24 24" class="hj-arrow-icon">
            <path d="M9 6L15 12L9 18"></path>
        </svg>
    </a>

</section>

    <!-- CONTENT BOX -->
<section class="hj-info-section">
    <div class="hj-info-box">
        <h2>SOLITAIRE DIAMOND ENGAGEMENT RING</h2>

        <p>
            A perfect solitaire ring lets your gorgeous diamond take the center stage so everyone can admire it along with you.
            Browse through our stylish solitaire rings in the latest couture designs and find the one that tells your love
            story to perfection.
        </p>

        <p>
            Can you do any better than perfection? Well, that’s a tough act to follow. The lady who is drawn to the
            sophistication of a solitaire ring knows her mind. She knows what she likes, and reveals a confidence born
            of a developed sense of style—you don’t follow—you lead the way with your effortless chic.
        </p>

        <p>
            There are so many ways to personalize your solitaire ring. We’ll let you decide how you want to show your style.
            Rose gold or platinum can be your heart’s desire. But so can princess cut diamonds, or a romantic heart shaped
            stone. Your choice will be simply perfection.
        </p>
    </div>
</section>

</main>
@endsection
