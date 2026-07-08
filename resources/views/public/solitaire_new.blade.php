@extends('public.layouts.header_black_white_fixed')

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
            <img src="{{ asset('assets/f_assets/image/solitaire/Final banner.png') }}" alt="Solitaire Engagement Rings">
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

@php
    $sortLabels = [
        'featured' => 'Sort: Best Selling',
        'newest' => 'Sort: Newest first',
        'price_low_high' => 'Sort: Price: low to high',
        'price_high_low' => 'Sort: Price: high to low',
    ];

    $activeSortLabel = $sortLabels[$selectedSort ?? 'featured'] ?? 'Sort: Best Selling';

    $desktopMinPrice = $selectedMinPrice !== null && $selectedMinPrice !== '' ? $selectedMinPrice : 0;
    $desktopMaxPrice = $selectedMaxPrice !== null && $selectedMaxPrice !== '' ? $selectedMaxPrice : $maxFilterPrice;

    $mobileMinPrice = $selectedMinPrice !== null && $selectedMinPrice !== '' ? $selectedMinPrice : 0;
    $mobileMaxPrice = $selectedMaxPrice !== null && $selectedMaxPrice !== '' ? $selectedMaxPrice : $maxFilterPrice;
@endphp

<!-- FILTER SECTION -->
<div class="hj-filter-section">
    <input type="hidden" id="hjSortValue" value="{{ $selectedSort ?? 'featured' }}">

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
                <span id="hjDesktopSortText">{{ $activeSortLabel }}</span>
                <i class="hj-chevron"></i>
            </button>

            <div class="hj-sort-dropdown" id="hjDesktopSortDropdown">
                <button type="button" data-sort-value="featured" data-sort-label="Sort: Best Selling">Best Selling</button>
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
            @foreach($availableShapes as $shapeValue => $shapeLabel)
                <button 
                    class="hj-shape-item {{ request('shape') === $shapeValue ? 'active' : '' }}" 
                    type="button"
                    data-filter-shape="{{ $shapeValue }}"
                >
                    <img src="{{ asset('assets/f_assets/image/solitaire/' . $shapeValue . '.png') }}" alt="{{ $shapeLabel }}">
                    <span>{{ $shapeLabel }}</span>
                </button>
            @endforeach
        </div>

        <button class="hj-clear-btn" type="button" data-clear-filter="shape">
            <span class="hj-clear-x">×</span>
            <span>CLEAR ALL</span>
        </button>
    </div>

    <!-- DESKTOP MATERIAL PANEL -->
   <div class="hj-material-panel" id="materialPanel">
    <div class="hj-material-list">

        <!-- <button 
            class="hj-material-item {{ request('metal') === '14k_white' ? 'active' : '' }}" 
            type="button"
            data-filter-metal="14k_white"
        >
            <span class="hj-material-circle silver">14K</span>
            <span>14K Gold</span>
        </button>

        <button 
            class="hj-material-item {{ request('metal') === '14k_rose' ? 'active' : '' }}" 
            type="button"
            data-filter-metal="14k_rose"
        >
            <span class="hj-material-circle rose">14K</span>
            <span>14K Gold</span>
        </button>

        <button 
            class="hj-material-item {{ request('metal') === '14k_yellow' ? 'active' : '' }}" 
            type="button"
            data-filter-metal="14k_yellow"
        >
            <span class="hj-material-circle gold">14K</span>
            <span>14K Gold</span>
        </button> -->

        <button 
            class="hj-material-item {{ request('metal') === '18k_white' ? 'active' : '' }}" 
            type="button"
            data-filter-metal="18k_white"
        >
            <span class="hj-material-circle silver">18K</span>
            <span>18K Gold</span>
        </button>

        <button 
            class="hj-material-item {{ request('metal') === '18k_rose' ? 'active' : '' }}" 
            type="button"
            data-filter-metal="18k_rose"
        >
            <span class="hj-material-circle rose">18K</span>
            <span>18K Gold</span>
        </button>

        <button 
            class="hj-material-item {{ request('metal') === '18k_yellow' ? 'active' : '' }}" 
            type="button"
            data-filter-metal="18k_yellow"
        >
            <span class="hj-material-circle gold">18K</span>
            <span>18K Gold</span>
        </button>

        <!-- <button 
            class="hj-material-item {{ request('metal') === 'platinum' ? 'active' : '' }}" 
            type="button"
            data-filter-metal="platinum"
        >
            <span class="hj-material-circle platinum">PT</span>
            <span>Platinum</span>
        </button> -->

    </div>

    <button class="hj-clear-material-btn" type="button" data-clear-filter="metal">
        <span class="hj-clear-x">×</span>
        <span>CLEAR ALL</span>
    </button>
</div>

    <!-- DESKTOP PRICE PANEL -->
    <!-- DESKTOP PRICE PANEL -->
<div class="hj-price-panel" id="pricePanel">
    <div class="hj-price-range-box hj-desktop-price-range-box">

        <div class="hj-price-label-row">
            <span id="desktopPriceMinTop">
                PKR {{ number_format((float) $desktopMinPrice, 0) }}
            </span>

            <span id="desktopPriceMaxTop">
                PKR {{ number_format((float) $desktopMaxPrice, 0) }}
            </span>
        </div>

        <div class="hj-price-slider-wrap">
            <div class="hj-price-slider-track"></div>
            <div class="hj-price-slider-fill" id="desktopPriceFill"></div>

            <input 
                type="range" 
                id="desktopPriceMinRange" 
                min="0" 
                max="{{ (int) $maxFilterPrice }}" 
                step="1000" 
                value="{{ (int) $desktopMinPrice }}"
            >

            <input 
                type="range" 
                id="desktopPriceMaxRange" 
                min="0" 
                max="{{ (int) $maxFilterPrice }}" 
                step="1000" 
                value="{{ (int) $desktopMaxPrice }}"
            >
        </div>

        <div class="hj-price-inputs">
            <input 
                type="text" 
                id="desktopPriceMinText" 
                value="PKR {{ number_format((float) $desktopMinPrice, 0) }}" 
                readonly 
                class="hj-price-min"
            >

            <!-- <span>-</span> -->

            <input 
                type="text" 
                id="desktopPriceMaxText" 
                value="PKR {{ number_format((float) $desktopMaxPrice, 0) }}" 
                readonly 
                class="hj-price-max is-active"
            >
        </div>

        <input type="hidden" id="desktopMinPriceInput" value="{{ $desktopMinPrice }}">
        <input type="hidden" id="desktopMaxPriceInput" value="{{ $desktopMaxPrice }}">

    </div>

    <button class="hj-clear-price-btn" type="button" data-clear-filter="price">
        <span class="hj-clear-x">×</span>
        <span>CLEAR ALL</span>
    </button>
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
                <span id="hjModalSortText">{{ $activeSortLabel }}</span>
                <i class="hj-chevron"></i>
            </button>

            <div class="hj-modal-sort-dropdown" id="hjModalSortDropdown">
                <button type="button" data-sort-value="featured" data-sort-label="Sort: Best Selling">Best Selling</button>
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

            <!-- <button 
                type="button" 
                class="{{ request('metal') === '14k_white' ? 'active' : '' }}"
                data-value="14k_white"
            >
                <span class="hj-mobile-metal-circle silver">14K</span>
                <small>14K Gold</small>
            </button>

            <button 
                type="button" 
                class="{{ request('metal') === '14k_rose' ? 'active' : '' }}"
                data-value="14k_rose"
            >
                <span class="hj-mobile-metal-circle rose">14K</span>
                <small>14K Gold</small>
            </button>

            <button 
                type="button" 
                class="{{ request('metal') === '14k_yellow' ? 'active' : '' }}"
                data-value="14k_yellow"
            >
                <span class="hj-mobile-metal-circle gold">14K</span>
                <small>14K Gold</small>
            </button> -->

            <button 
                type="button" 
                class="{{ request('metal') === '18k_white' ? 'active' : '' }}"
                data-value="18k_white"
            >
                <span class="hj-mobile-metal-circle silver">18K</span>
                <small>18K Gold</small>
            </button>

            <button 
                type="button" 
                class="{{ request('metal') === '18k_rose' ? 'active' : '' }}"
                data-value="18k_rose"
            >
                <span class="hj-mobile-metal-circle rose">18K</span>
                <small>18K Gold</small>
            </button>

            <button 
                type="button" 
                class="{{ request('metal') === '18k_yellow' ? 'active' : '' }}"
                data-value="18k_yellow"
            >
                <span class="hj-mobile-metal-circle gold">18K</span>
                <small>18K Gold</small>
            </button>

            <!-- <button 
                type="button" 
                class="{{ request('metal') === 'platinum' ? 'active' : '' }}"
                data-value="platinum"
            >
                <span class="hj-mobile-metal-circle platinum">PT</span>
                <small>Platinum</small>
            </button> -->

        </div>

        <input 
            type="hidden" 
            name="metal" 
            id="mobileMetalInput" 
            value="{{ request('metal') }}"
        >
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
                    <span id="mobilePriceMinTop">PKR {{ number_format((float) $mobileMinPrice, 0) }}</span>
                    <span id="mobilePriceMaxTop">PKR {{ number_format((float) $mobileMaxPrice, 0) }}</span>
                </div>

                <div class="hj-price-slider-wrap">
                    <div class="hj-price-slider-track"></div>
                    <div class="hj-price-slider-fill" id="mobilePriceFill"></div>

                    <input 
                        type="range" 
                        id="mobilePriceMinRange" 
                        min="0" 
                        max="{{ (int) $maxFilterPrice }}" 
                        step="1000" 
                        value="{{ (int) $mobileMinPrice }}"
                    >

                    <input 
                        type="range" 
                        id="mobilePriceMaxRange" 
                        min="0" 
                        max="{{ (int) $maxFilterPrice }}" 
                        step="1000" 
                        value="{{ (int) $mobileMaxPrice }}"
                    >
                </div>

                <div class="hj-price-inputs">
                    <input 
                        type="text" 
                        id="mobilePriceMinText" 
                        value="PKR {{ number_format((float) $mobileMinPrice, 0) }}"
                    >

                    <input 
                        type="text" 
                        id="mobilePriceMaxText" 
                        value="PKR {{ number_format((float) $mobileMaxPrice, 0) }}"
                    >
                </div>

                <input type="hidden" name="min_price" id="mobileMinPriceInput" value="{{ $mobileMinPrice }}">
                <input type="hidden" name="max_price" id="mobileMaxPriceInput" value="{{ $mobileMaxPrice }}">

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
                    @foreach($availableShapes as $shapeValue => $shapeLabel)
                        <button 
                            type="button" 
                            class="{{ request('shape') === $shapeValue ? 'active' : '' }}"
                            data-value="{{ $shapeValue }}"
                        >
                            <img src="{{ asset('assets/f_assets/image/solitaire/' . $shapeValue . '.png') }}" alt="{{ $shapeLabel }}">
                            <span>{{ $shapeLabel }}</span>
                        </button>
                    @endforeach
                </div>

                <input type="hidden" name="shapes" id="mobileShapesInput" value="{{ request('shape') }}">
            </div>
        </div>

    </div>

    <div class="hj-mobile-filter-bottom">
        <button type="button" class="hj-mobile-view-products" id="hjMobileViewProducts">
            View Products ({{ $products->total() }})
        </button>
    </div>

</div>
<!-- PRODUCT GRID -->
<section class="hj-product-grid">

    @forelse($products as $product)

        @php
            $metals = collect($product->metals ?? [])->values();
            $carats = collect($product->diamond_carats ?? [])->values();
            $variants = collect($product->variants ?? [])->values();
            $metalImages = collect($product->metal_images ?? [])->values();
            $galleryImages = collect($product->gallery_images ?? [])->values();

            $activeVariants = $variants->filter(function ($variant) {
                return !isset($variant['status'])
                    || $variant['status'] === true
                    || $variant['status'] === 1
                    || $variant['status'] === '1';
            })->values();

            /*
                Metal comes from filter.
                If no filter, use product default metal.
            */
            $selectedMetalCode = request('metal')
                ?: ($product->default_metal_code ?: data_get($metals->first(), 'code'));

            /*
                Carat stays product default.
                It will NOT auto jump from 0.25 to 0.30.
            */
            $selectedCaratValue = $product->default_diamond_carat
                ?: data_get($carats->first(), 'value');

            /*
                Price comes from selected metal + default carat.
            */
            $selectedVariant = $activeVariants->first(function ($variant) use ($selectedMetalCode, $selectedCaratValue) {
                return ($variant['metal_code'] ?? '') === $selectedMetalCode
                    && number_format((float) ($variant['diamond_carat'] ?? 0), 2, '.', '')
                    === number_format((float) $selectedCaratValue, 2, '.', '');
            });

            /*
                Fallback only if no metal filter selected.
            */
            if (!$selectedVariant && !request('metal')) {
                $selectedVariant = $activeVariants->firstWhere('is_default', true) ?? $activeVariants->first();

                if ($selectedVariant) {
                    $selectedMetalCode = $selectedVariant['metal_code'] ?? $selectedMetalCode;
                    $selectedCaratValue = $product->default_diamond_carat ?: ($selectedVariant['diamond_carat'] ?? $selectedCaratValue);
                }
            }

            $selectedMetal = $metals->firstWhere('code', $selectedMetalCode);

            $selectedMetalImageGroup = $metalImages->firstWhere('metal_code', $selectedMetalCode);

            $mainImage = data_get($selectedMetalImageGroup, 'images.0.image_path')
                ?: data_get($galleryImages->first(), 'image_path');

            $currency = $product->currency ?? 'PKR';

            $price = $selectedVariant['price'] ?? null;
            $oldPrice = $selectedVariant['old_price'] ?? null;
            $discount = $selectedVariant['discount_percent'] ?? null;

            $formatMoney = function ($value) use ($currency) {
                if ($value === null || $value === '') {
                    return '';
                }

                return $currency . ' ' . number_format((float) $value, 0);
            };

           $getMetalColorClass = function ($metal) {
    $metalCode = strtolower($metal['code'] ?? '');
    $metalName = strtolower($metal['name'] ?? '');
    $metalTone = strtolower($metal['tone'] ?? '');

    $checkValue = $metalCode . ' ' . $metalName . ' ' . $metalTone;

    if (str_contains($checkValue, 'rose')) {
        return 'rose';
    }

    if (str_contains($checkValue, 'yellow')) {
        return 'yellow';
    }

    if (str_contains($checkValue, 'white')) {
        return 'white';
    }

    return 'white';
};

            $detailUrl = route('solitaire.details', $product->slug)
                . '?metal=' . urlencode($selectedMetalCode)
                . '&carat=' . urlencode($selectedCaratValue);

            $cardData = [
    'id' => $product->id,
    'name' => $product->name,
    'slug' => $product->slug,
    'base_detail_url' => route('solitaire.details', $product->slug),
    'shape' => $product->shape ?? 'Oval',
    'currency' => $currency,
    'metals' => $metals->toArray(),
    'carats' => $carats->toArray(),
    'variants' => $activeVariants->toArray(),
    'metal_images' => $metalImages->toArray(),
    'gallery_images' => $galleryImages->toArray(),
    'default_metal_code' => $selectedMetalCode,
    'default_carat' => $selectedCaratValue,
    'fallback_image' => asset('assets/f_assets/image/solitaire/ring10.jpeg'),
];
        @endphp

        <article 
            class="hj-product-card" 
            data-product-card
            data-product-url="{{ $detailUrl }}"
        >
            <script type="application/json" class="hj-product-json">
                @json($cardData)
            </script>

            <div class="hj-product-image-box">
                <span class="hj-product-badge">
                    {{ $product->tag_label ?? 'Lab Created' }}
                </span>

                <img 
                    class="hj-product-main-img"
                    src="{{ $mainImage ? asset($mainImage) : asset('assets/f_assets/image/solitaire/ring10.jpeg') }}" 
                    alt="{{ $product->name }}"
                >
            </div>

            <div class="hj-product-info">
                <h3>{{ $product->name }}</h3>

                <p class="hj-product-desc">
                    {{ $selectedCaratValue }} Total Carat · {{ ucfirst($product->shape ?? 'Oval') }} · Solitaire · {{ data_get($selectedMetal, 'name', $selectedMetalCode) }}
                </p>

                <div class="hj-metal-options">
    @foreach($metals as $metal)
        @php
            $metalCode = $metal['code'] ?? '';
            $metalColorClass = $getMetalColorClass($metal);
        @endphp

        <span 
            class="hj-metal {{ $selectedMetalCode == $metalCode ? 'active' : '' }} {{ $metalColorClass }}"
            data-metal-code="{{ $metalCode }}"
        >
            {{ $metal['short_label'] ?? $metal['purity'] ?? '14K' }}
        </span>
    @endforeach
</div>

                <div class="hj-size-options">
                    @foreach($carats as $carat)
                        @php
                            $caratValue = $carat['value'] ?? '';
                            $caratLabel = $carat['label'] ?? $caratValue;
                            $caratTooltip = trim('Carat weight: ' . $caratLabel);

                            $activeCarat = number_format((float) $caratValue, 2, '.', '') 
                                == number_format((float) $selectedCaratValue, 2, '.', '');
                        @endphp

                        <button 
                            type="button"
                            class="{{ $activeCarat ? 'active' : '' }}"
                            data-carat-value="{{ $caratValue }}"
                            data-carat-tooltip="{{ $caratTooltip }}"
                            aria-label="{{ $caratTooltip }}"
                        >
                            {{ $caratLabel }}
                        </button>
                    @endforeach
                </div>

                <div class="hj-price-row">
                    <del class="hj-old-price">
                        {{ $oldPrice ? $formatMoney($oldPrice) : '' }}
                    </del>

                    <strong class="hj-new-price">
                        {{ $price ? $formatMoney($price) : 'Unavailable' }}
                    </strong>

                    <span class="hj-discount-text">
                        {{ $discount ? $discount . '% off' : '' }}
                    </span>
                </div>
            </div>

        </article>

    @empty
        <!-- <div class="alert alert-warning w-100">
            No solitaire products found.
        </div> -->
    @endforelse

</section>

<!-- PAGINATION -->
@if ($products->hasPages())
    @php
        $paginatedProducts = $products->appends(request()->query());
    @endphp

    <section class="hj-pagination">

        {{-- Previous Button --}}
        @if ($products->onFirstPage())
            <span class="hj-page-arrow disabled" aria-label="Previous page">
                <svg viewBox="0 0 24 24" class="hj-arrow-icon">
                    <path d="M15 18L9 12L15 6"></path>
                </svg>
            </span>
        @else
            <a href="{{ $paginatedProducts->previousPageUrl() }}" class="hj-page-arrow" aria-label="Previous page">
                <svg viewBox="0 0 24 24" class="hj-arrow-icon">
                    <path d="M15 18L9 12L15 6"></path>
                </svg>
            </a>
        @endif


        {{-- Page Numbers --}}
        @foreach ($paginatedProducts->getUrlRange(1, $products->lastPage()) as $page => $url)
            @if ($page == $products->currentPage())
                <span class="hj-page-number active">{{ $page }}</span>
            @else
                <a href="{{ $url }}" class="hj-page-number">{{ $page }}</a>
            @endif
        @endforeach


        {{-- Next Button --}}
        @if ($products->hasMorePages())
            <a href="{{ $paginatedProducts->nextPageUrl() }}" class="hj-page-arrow" aria-label="Next page">
                <svg viewBox="0 0 24 24" class="hj-arrow-icon">
                    <path d="M9 6L15 12L9 18"></path>
                </svg>
            </a>
        @else
            <span class="hj-page-arrow disabled" aria-label="Next page">
                <svg viewBox="0 0 24 24" class="hj-arrow-icon">
                    <path d="M9 6L15 12L9 18"></path>
                </svg>
            </span>
        @endif

    </section>
@endif

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
<script>
document.addEventListener('DOMContentLoaded', function () {
    'use strict';

    function normalizeCarat(value) {
        const number = Number(value);

        if (Number.isNaN(number)) {
            return String(value || '').trim();
        }

        return number.toFixed(2);
    }

    function makeAssetUrl(path, fallback) {
        if (!path) {
            return fallback || '';
        }

        if (String(path).startsWith('http') || String(path).startsWith('/')) {
            return path;
        }

        return window.location.origin + '/' + path;
    }

    function formatMoney(value, currency) {
        if (value === null || value === undefined || value === '') {
            return '';
        }

        const number = Number(value);

        if (Number.isNaN(number)) {
            return currency + ' ' + value;
        }

        return currency + ' ' + number.toLocaleString(undefined, {
            maximumFractionDigits: 0
        });
    }

    function findMetal(data, metalCode) {
        return (data.metals || []).find(function (metal) {
            return String(metal.code) === String(metalCode);
        });
    }

    function findCarat(data, caratValue) {
        return (data.carats || []).find(function (carat) {
            return normalizeCarat(carat.value) === normalizeCarat(caratValue);
        });
    }

    function findVariant(data, metalCode, caratValue) {
        return (data.variants || []).find(function (variant) {
            const status = variant.status === undefined
                || variant.status === true
                || variant.status === 1
                || variant.status === '1';

            return status
                && String(variant.metal_code) === String(metalCode)
                && normalizeCarat(variant.diamond_carat) === normalizeCarat(caratValue);
        });
    }

    function findMetalImage(data, metalCode) {
        const group = (data.metal_images || []).find(function (item) {
            return String(item.metal_code) === String(metalCode);
        });

        if (group && Array.isArray(group.images) && group.images.length > 0) {
            return group.images[0].image_path;
        }

        if (Array.isArray(data.gallery_images) && data.gallery_images.length > 0) {
            return data.gallery_images[0].image_path;
        }

        return '';
    }

    function buildDetailUrl(baseUrl, metalCode, caratValue) {
        const url = new URL(baseUrl, window.location.origin);

        if (metalCode) {
            url.searchParams.set('metal', metalCode);
        }

        if (caratValue) {
            url.searchParams.set('carat', caratValue);
        }

        return url.toString();
    }

    function showCaratTooltip(button) {
        if (!button) {
            return;
        }

        document.querySelectorAll('.hj-size-options button.hj-carat-tooltip-visible').forEach(function (openButton) {
            if (openButton !== button) {
                window.clearTimeout(openButton.hjCaratTooltipTimer);
                openButton.classList.remove('hj-carat-tooltip-visible');
            }
        });

        window.clearTimeout(button.hjCaratTooltipTimer);
        button.classList.add('hj-carat-tooltip-visible');

        button.hjCaratTooltipTimer = window.setTimeout(function () {
            button.classList.remove('hj-carat-tooltip-visible');
        }, 1000);
    }

    document.querySelectorAll('[data-product-card]').forEach(function (card) {
        const jsonScript = card.querySelector('.hj-product-json');

        if (!jsonScript) {
            return;
        }

        let data = {};

        try {
            data = JSON.parse(jsonScript.textContent);
        } catch (error) {
            console.error('Invalid product JSON', error);
            return;
        }

        let selectedMetalCode = data.default_metal_code || '';
        let selectedCarat = data.default_carat || '';

        const baseDetailUrl = data.base_detail_url
            || (card.dataset.productUrl ? card.dataset.productUrl.split('?')[0] : '');

        const imageEl = card.querySelector('.hj-product-main-img');
        const descEl = card.querySelector('.hj-product-desc');
        const oldPriceEl = card.querySelector('.hj-old-price');
        const newPriceEl = card.querySelector('.hj-new-price');
        const discountEl = card.querySelector('.hj-discount-text');

        function updateCard() {
            const metal = findMetal(data, selectedMetalCode);
            const carat = findCarat(data, selectedCarat);
            const variant = findVariant(data, selectedMetalCode, selectedCarat);
            const imagePath = findMetalImage(data, selectedMetalCode);

            card.dataset.selectedMetal = selectedMetalCode;
            card.dataset.selectedCarat = selectedCarat;

            if (baseDetailUrl) {
                card.dataset.productUrl = buildDetailUrl(
                    baseDetailUrl,
                    selectedMetalCode,
                    selectedCarat
                );
            }

            card.querySelectorAll('.hj-metal').forEach(function (chip) {
                chip.classList.toggle(
                    'active',
                    String(chip.dataset.metalCode) === String(selectedMetalCode)
                );
            });

            card.querySelectorAll('.hj-size-options button').forEach(function (btn) {
                const buttonCarat = btn.dataset.caratValue || '';

                btn.classList.toggle(
                    'active',
                    normalizeCarat(buttonCarat) === normalizeCarat(selectedCarat)
                );
            });

            if (imageEl) {
                imageEl.src = makeAssetUrl(imagePath, data.fallback_image);
            }

            if (descEl) {
                const shapeName = String(data.shape || 'Oval');
                const shapeText = shapeName.charAt(0).toUpperCase() + shapeName.slice(1);
                const metalName = metal && metal.name ? metal.name : selectedMetalCode;
                const caratLabel = carat && carat.label ? carat.label : selectedCarat;

                descEl.textContent =
                    caratLabel + ' Total Carat · ' +
                    shapeText + ' · Solitaire · ' +
                    metalName;
            }

            if (oldPriceEl) {
                oldPriceEl.textContent = variant && variant.old_price
                    ? formatMoney(variant.old_price, data.currency || 'PKR')
                    : '';
            }

            if (newPriceEl) {
                newPriceEl.textContent = variant && variant.price
                    ? formatMoney(variant.price, data.currency || 'PKR')
                    : 'Unavailable';
            }

            if (discountEl) {
                discountEl.textContent = variant && variant.discount_percent
                    ? variant.discount_percent + '% off'
                    : '';
            }
        }

        card.querySelectorAll('.hj-metal').forEach(function (chip) {
            chip.addEventListener('click', function (event) {
                event.preventDefault();
                event.stopPropagation();

                selectedMetalCode = this.dataset.metalCode || selectedMetalCode;

                updateCard();
            });
        });

        card.querySelectorAll('.hj-size-options button').forEach(function (btn) {
            btn.addEventListener('mouseenter', function () {
                showCaratTooltip(this);
            });

            btn.addEventListener('focus', function () {
                showCaratTooltip(this);
            });

            btn.addEventListener('click', function (event) {
                event.preventDefault();
                event.stopPropagation();

                showCaratTooltip(this);

                selectedCarat = this.dataset.caratValue || selectedCarat;

                updateCard();
            });
        });

        const imageBox = card.querySelector('.hj-product-image-box');

        if (imageBox) {
            imageBox.addEventListener('click', function () {
                if (card.dataset.productUrl) {
                    window.location.href = card.dataset.productUrl;
                }
            });
        }

        updateCard();
    });
});
</script>
@endsection
