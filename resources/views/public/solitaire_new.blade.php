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
<!-- PRODUCT GRID -->
<section class="hj-product-grid">

    @foreach($products as $product)

        @php
            $metals = collect($product->metals ?? []);
            $carats = collect($product->diamond_carats ?? []);
            $variants = collect($product->variants ?? []);
            $metalImages = collect($product->metal_images ?? []);
            $galleryImages = collect($product->gallery_images ?? []);

            $defaultVariant = $variants->firstWhere('is_default', true) ?? $variants->first();

            $defaultMetalCode = $product->default_metal_code 
                ?? ($defaultVariant['metal_code'] ?? ($metals->first()['code'] ?? ''));

            $defaultCarat = $product->default_diamond_carat 
                ?? ($defaultVariant['diamond_carat'] ?? ($carats->first()['value'] ?? ''));

            $defaultMetal = $metals->firstWhere('code', $defaultMetalCode);

            $defaultMetalImageGroup = $metalImages->firstWhere('metal_code', $defaultMetalCode);

            $mainImage = data_get($defaultMetalImageGroup, 'images.0.image_path')
                ?? data_get($galleryImages, '0.image_path')
                ?? null;

            $metalDesignClasses = [
                0 => '',
                1 => 'rose',
                2 => 'silver',
                3 => 'rose',
                4 => 'silver',
            ];

            $cardData = [
                'id' => $product->id,
                'name' => $product->name,
                'currency' => $product->currency ?? 'AED',
                'metals' => $metals->values(),
                'carats' => $carats->values(),
                'variants' => $variants->values(),
                'metal_images' => $metalImages->values(),
                'gallery_images' => $galleryImages->values(),
                'default_metal_code' => $defaultMetalCode,
                'default_carat' => $defaultCarat,
                'fallback_image' => asset('assets/f_assets/image/solitaire/ring10.jpeg'),
            ];

            $price = $defaultVariant['price'] ?? null;
            $oldPrice = $defaultVariant['old_price'] ?? null;
            $discount = $defaultVariant['discount_percent'] ?? null;
        @endphp

<article 
    class="hj-product-card" 
    data-product-card
    data-product-url="{{ route('solitaire.details', $product->slug) }}"
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
                <h3>
                    {{ $product->name }}
                </h3>

                <p class="hj-product-desc">
                    {{ $defaultCarat }} Total Carat · Radiant · Solitaire · {{ $defaultMetal['name'] ?? '14K White Gold' }}
                </p>

                <div class="hj-metal-options">
                    @foreach($metals as $index => $metal)
                        <span 
                            class="hj-metal {{ $defaultMetalCode == ($metal['code'] ?? '') ? 'active' : '' }} {{ $metalDesignClasses[$index] ?? '' }}"
                            data-metal-code="{{ $metal['code'] ?? '' }}"
                        >
                            {{ $metal['short_label'] ?? $metal['purity'] ?? '14K' }}
                        </span>
                    @endforeach
                </div>

                <div class="hj-size-options">
                    @foreach($carats as $carat)
                        @php
                            $caratValue = $carat['value'] ?? '';
                            $activeCarat = number_format((float)$caratValue, 2, '.', '') 
                                == number_format((float)$defaultCarat, 2, '.', '');
                        @endphp

                        <button 
                            type="button"
                            class="{{ $activeCarat ? 'active' : '' }}"
                            data-carat-value="{{ $caratValue }}"
                        >
                            {{ $carat['label'] ?? $caratValue }}
                        </button>
                    @endforeach
                </div>

                <div class="hj-price-row">
                    <del class="hj-old-price">
                        {{ $oldPrice ? ($product->currency ?? 'AED') . ' ' . number_format($oldPrice) : '' }}
                    </del>

                    <strong class="hj-new-price">
                        {{ $price ? ($product->currency ?? 'AED') . ' ' . number_format($price) : 'Unavailable' }}
                    </strong>

                    <span class="hj-discount-text">
                        {{ $discount ? $discount . '% off' : '' }}
                    </span>
                </div>
            </div>

        </article>

    @endforeach

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

    function normalizeCarat(value) {
        let number = Number(value);

        if (isNaN(number)) {
            return String(value);
        }

        return number.toFixed(2);
    }

    function makeAssetUrl(path, fallback) {
        if (!path) {
            return fallback;
        }

        if (path.startsWith('http') || path.startsWith('/')) {
            return path;
        }

        return window.location.origin + '/' + path;
    }

    function formatMoney(value, currency) {
        if (value === null || value === undefined || value === '') {
            return '';
        }

        let number = Number(value);

        if (isNaN(number)) {
            return currency + ' ' + value;
        }

        return currency + ' ' + number.toLocaleString();
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
            let status = variant.status === undefined 
                || variant.status === true 
                || variant.status === 1 
                || variant.status === '1';

            return status &&
                String(variant.metal_code) === String(metalCode) &&
                normalizeCarat(variant.diamond_carat) === normalizeCarat(caratValue);
        });
    }

    function findMetalImage(data, metalCode) {
        let group = (data.metal_images || []).find(function (item) {
            return String(item.metal_code) === String(metalCode);
        });

        if (group && group.images && group.images.length > 0) {
            return group.images[0].image_path;
        }

        if (data.gallery_images && data.gallery_images.length > 0) {
            return data.gallery_images[0].image_path;
        }

        return null;
    }

    document.querySelectorAll('[data-product-card]').forEach(function (card) {
        let jsonScript = card.querySelector('.hj-product-json');

        if (!jsonScript) return;

        let data = JSON.parse(jsonScript.textContent);

        let selectedMetalCode = data.default_metal_code;
        let selectedCarat = data.default_carat;

        let imageEl = card.querySelector('.hj-product-main-img');
        let descEl = card.querySelector('.hj-product-desc');
        let oldPriceEl = card.querySelector('.hj-old-price');
        let newPriceEl = card.querySelector('.hj-new-price');
        let discountEl = card.querySelector('.hj-discount-text');

        function updateCard() {
            let variant = findVariant(data, selectedMetalCode, selectedCarat);

            let metal = findMetal(data, selectedMetalCode);
            let carat = findCarat(data, selectedCarat);

            let imagePath = findMetalImage(data, selectedMetalCode);

            card.dataset.selectedMetal = selectedMetalCode;

            if (imageEl) {
                imageEl.src = makeAssetUrl(imagePath, data.fallback_image);
            }

            if (descEl) {
                descEl.textContent =
                    (carat ? carat.label : selectedCarat) +
                    ' Total Carat · Radiant · Solitaire · ' +
                    (metal ? metal.name : selectedMetalCode);
            }

            if (variant) {
                oldPriceEl.textContent = variant.old_price
                    ? formatMoney(variant.old_price, data.currency)
                    : '';

                newPriceEl.textContent = variant.price
                    ? formatMoney(variant.price, data.currency)
                    : 'Unavailable';

                discountEl.textContent = variant.discount_percent
                    ? variant.discount_percent + '% off'
                    : '';
            } else {
                oldPriceEl.textContent = '';
                newPriceEl.textContent = 'Unavailable';
                discountEl.textContent = '';
            }

            card.querySelectorAll('.hj-metal').forEach(function (btn) {
                btn.classList.toggle('active', btn.dataset.metalCode === selectedMetalCode);
            });

            card.querySelectorAll('.hj-size-options button').forEach(function (btn) {
                btn.classList.toggle(
                    'active',
                    normalizeCarat(btn.dataset.caratValue) === normalizeCarat(selectedCarat)
                );
            });
        }

        card.querySelectorAll('.hj-metal').forEach(function (btn) {
            btn.addEventListener('click', function () {
                selectedMetalCode = this.dataset.metalCode;
                updateCard();
            });
        });

        card.querySelectorAll('.hj-size-options button').forEach(function (btn) {
            btn.addEventListener('click', function () {
                selectedCarat = this.dataset.caratValue;
                updateCard();
            });
        });
    });

});
</script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('[data-product-card]').forEach(function (card) {
        card.addEventListener('click', function (e) {

            if (
                e.target.closest('.hj-metal') ||
                e.target.closest('.hj-size-options') ||
                e.target.closest('button') ||
                e.target.closest('a')
            ) {
                return;
            }

            let url = card.dataset.productUrl;
            let metal = card.dataset.selectedMetal;

            if (metal) {
                url = url + '?metal=' + encodeURIComponent(metal);
            }

            window.location.href = url;
        });
    });
});
</script>
@endsection
