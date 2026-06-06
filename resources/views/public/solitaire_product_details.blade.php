@extends('public.layouts.header_latest')

@section('content')
<link rel="stylesheet" href="{{ asset('assets/f_assets/css/details.css') }}">
<script src="{{ asset('assets/f_assets/js/filter.js') }}" defer></script>
<section class="hj-product-detail-page">

<div class="hj-product-container">

     {{-- LEFT IMAGE GALLERY --}}
     <div class="hj-gallery-slider-wrap">
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

    $firstMetal = $metals->first();
    $firstCarat = $carats->first();

    $selectedMetalCode = request('metal')
        ?: ($product->default_metal_code ?: data_get($firstMetal, 'code', ''));

    $selectedCarat = request('carat')
        ?: ($product->default_diamond_carat ?: data_get($firstCarat, 'value', ''));

    $selectedMetal = $metals->firstWhere('code', $selectedMetalCode) ?: $firstMetal;

    if ($selectedMetal) {
        $selectedMetalCode = $selectedMetal['code'] ?? '';
    }

    $selectedCaratIndex = $carats->search(function ($carat) use ($selectedCarat) {
        return number_format((float)($carat['value'] ?? 0), 2, '.', '') === number_format((float)$selectedCarat, 2, '.', '');
    });

    if ($selectedCaratIndex === false) {
        $selectedCaratIndex = 0;
        $selectedCarat = data_get($firstCarat, 'value', '');
    }

    $selectedVariant = $activeVariants->first(function ($variant) use ($selectedMetalCode, $selectedCarat) {
        return ($variant['metal_code'] ?? '') === $selectedMetalCode
            && number_format((float)($variant['diamond_carat'] ?? 0), 2, '.', '') === number_format((float)$selectedCarat, 2, '.', '');
    });

    /*
        Image condition:
        1. Selected metal images show first.
        2. If selected metal has no images, gallery images show.
        3. If gallery images are also empty, show no image message.
    */
    $selectedMetalImageGroup = $metalImages->firstWhere('metal_code', $selectedMetalCode);
    $detailImages = collect(data_get($selectedMetalImageGroup, 'images', []));

    if ($detailImages->isEmpty() && $galleryImages->isNotEmpty()) {
        $detailImages = $galleryImages;
    }

    $currency = $product->currency ?? 'AED';

    $formatMoney = function ($value) use ($currency) {
        if ($value === null || $value === '') {
            return '';
        }

        return $currency . ' ' . number_format((float)$value, 0);
    };

    /*
        Important:
        This is a closure variable, so use:
        $hjMetalClass($metal)
        Not:
        hjMetalClass($metal)
    */
    $detailData = [
        'name' => $product->name,
        'currency' => $currency,
        'metals' => $metals->toArray(),
        'carats' => $carats->toArray(),
        'variants' => $activeVariants->toArray(),
        'metal_images' => $metalImages->toArray(),
        'gallery_images' => $galleryImages->toArray(),
        'selected_metal_code' => $selectedMetalCode,
        'selected_carat_index' => (int) $selectedCaratIndex,
    ];
@endphp

<script type="application/json" id="hjDetailProductData">
    @json($detailData)
</script>


{{-- PRODUCT DETAIL GALLERY --}}
<div class="hj-product-gallery" id="hjProductGallery">

    @forelse($detailImages as $index => $image)
        <div class="hj-gallery-item">
            @if($index === 0)
                <span class="hj-badge">TRADE IN AVAILABLE</span>
            @endif

            <img 
                src="{{ asset($image['image_path']) }}" 
                alt="{{ $image['alt_text'] ?? $product->name }}"
            >
        </div>
    @empty
        <div class="hj-gallery-no-image">
            No images available for this metal.
        </div>
    @endforelse

</div>
    {{-- MOBILE SLIDER CONTROLS --}}
    <button type="button" class="hj-gallery-arrow" aria-label="Next image" id="hjGalleryNext">
    <img src="{{ asset('assets/f_assets/image/reviews/Vector.svg') }}" alt="Next" class="hj-gallery-arrow-img hj-arrow-right">
</button>
    <!-- <button type="button" class="hj-gallery-arrow" id="hjGalleryNext">›</button> -->

    <div class="hj-mobile-gallery-bottom">
        <div class="hj-gallery-tabs">
            <!-- <button type="button">Spin</button> -->
            <button type="button" class="active">Gallery</button>
        </div>

        <div class="hj-gallery-dots" id="hjGalleryDots"></div>
    </div>

</div>

      <aside class="hj-product-info">

    <div class="hj-product-top">

    <div class="hj-breadcrumb">
        <a href="#">Home</a>
        <span>/</span>
        <a href="#">Solitaire Rings</a>
        <span>/</span>
<a href="#" id="selectedMetalTitle">
    Solitaire Engagement Ring - {{ $selectedMetal['name'] ?? '14K White Gold' }}
</a>
    </div>

    <h1>{{ $product->name ?? 'Julia Solitaire Ring' }}</h1>

    <p class="hj-sku">
        SKU: {{ $product->sku ?? 'N/A' }} | {{ $product->tag_label ?? 'N/A' }} | Gemological certificate included
    </p>

</div>
 {{-- OPTION CARD --}}
<div class="hj-option-card">

  @php
    $metalDesignClasses = [
        0 => '',
        1 => 'rose',
        2 => 'silver',
        3 => 'rose',
        4 => 'silver',
        5 => 'silver',
    ];
@endphp

{{-- METAL --}}
<div class="hj-row hj-metal-row">
    <span class="hj-label">METAL</span>

    <div class="hj-metal-track-wrap">
        <div class="hj-metal-options" id="metalOptionsTrack">
            @foreach($metals as $index => $metal)
                <button 
                    type="button"
                    class="metal-chip {{ $metalDesignClasses[$index] ?? 'silver' }} {{ ($metal['code'] ?? '') === $selectedMetalCode ? 'active' : '' }}"
                    data-metal-code="{{ $metal['code'] ?? '' }}"
                >
                    {{ $metal['short_label'] ?? $metal['purity'] ?? '14K' }}
                </button>
            @endforeach
        </div>
    </div>

    <button type="button" class="hj-side-btn" id="selectedMetalBtn">
        {{ strtoupper($selectedMetal['name'] ?? 'SELECT METAL') }}
    </button>
</div>


    {{-- CARAT --}}
    <div class="hj-row hj-carat-row">
        <span class="hj-label">
            TOTAL CARAT
            <small id="caratPriceDiff"></small>
        </span>

        <div class="hj-middle hj-slider-box">
            <div class="hj-slider-text">
                <span>{{ data_get($carats->first(), 'label', '0.25') }} Carat</span>
                <span>{{ data_get($carats->last(), 'label', '1.00') }} Carat</span>
            </div>

            <input
                class="hj-range hj-carat-range"
                id="caratRange"
                type="range"
                min="0"
                max="{{ max($carats->count() - 1, 0) }}"
                step="1"
                value="{{ $selectedCaratIndex }}"
            >
        </div>

        <button type="button" class="hj-side-btn" id="caratBtn">
            {{ strtoupper((data_get($carats[$selectedCaratIndex] ?? [], 'label', $selectedCarat)) . ' CARAT') }}
        </button>
    </div>


    {{-- RING SIZE --}}
    <div class="hj-row hj-size-row">
        <span class="hj-label">RING SIZE</span>

        <p class="hj-middle hj-select-text">Please select</p>

        <button type="button" class="hj-side-btn">SELECT</button>
    </div>

</div>


{{-- PRICE ROW --}}
<div class="hj-price-row">
    <div class="hj-price-left">
        <del id="detailOldPrice">
            {{ $selectedVariant && !empty($selectedVariant['old_price']) ? $formatMoney($selectedVariant['old_price']) : '' }}
        </del>

        <strong id="detailNewPrice">
            {{ $selectedVariant && !empty($selectedVariant['price']) ? $formatMoney($selectedVariant['price']) : 'Unavailable' }}
        </strong>

        <span id="detailSavingText">
            {{ $selectedVariant && !empty($selectedVariant['discount_percent']) ? 'You save ' . $selectedVariant['discount_percent'] . ' %' : '' }}
        </span>
    </div>

    <button type="button" class="hj-cart-btn">ADD TO CART</button>
</div>

<button class="hj-engraving">
    <b>+</b>
    <span>Add Free Inscription</span>
</button>

<div class="hj-spec-card">

    <div class="hj-tabs">
        <button type="button" class="hj-tab-btn active" data-tab="main-stone">MAIN STONE</button>
        <button type="button" class="hj-tab-btn" data-tab="settings">SETTINGS</button>
    </div>

    <!-- MAIN STONE TAB -->
    <div class="hj-tab-panel active" id="main-stone">

        <div class="hj-spec-grid">

            <div class="hj-spec-item">
                <div class="hj-spec-head">
                    <small>Carat</small>
                    <button class="hj-help-btn" type="button">?</button>
                    <div class="hj-help-dropdown">Carat refers to the weight of the diamond.</div>
                </div>
   <strong id="selectedCaratSpec">
        {{ strtoupper((data_get($carats[$selectedCaratIndex] ?? [], 'label', $selectedCarat)) . ' CARAT') }}
    </strong>

                <span>Standard measure</span>
            </div>

            <div class="hj-spec-item">
                <div class="hj-spec-head">
                    <small>Color</small>
                    <button class="hj-help-btn" type="button">?</button>
                    <div class="hj-help-dropdown">Color shows how white or colorless the diamond appears.</div>
                </div>
                <strong>F</strong>
                <span>Exceptional Colorless Brilliance</span>
            </div>

            <div class="hj-spec-item">
                <div class="hj-spec-head">
                    <small>Clarity</small>
                    <button class="hj-help-btn" type="button">?</button>
                    <div class="hj-help-dropdown">Clarity shows how clean the diamond is.</div>
                </div>
                <strong>VS1</strong>
                <span>Perfectly Eye Clean</span>
            </div>

            <div class="hj-spec-item">
                <div class="hj-spec-head">
                    <small>Cut</small>
                    <button class="hj-help-btn" type="button">?</button>
                    <div class="hj-help-dropdown">Cut affects the brilliance and sparkle.</div>
                </div>
                <strong>EXCELLENT</strong>
                <span>Perfect brilliance</span>
            </div>

            <div class="hj-spec-item">
                <div class="hj-spec-head">
                    <small>Shape</small>
                    <button class="hj-help-btn" type="button">?</button>
                    <div class="hj-help-dropdown">Shape refers to the diamond outline.</div>
                </div>
                <strong>OVAL</strong>
                <span>Preferred style</span>
            </div>

            <div class="hj-spec-item">
                <div class="hj-spec-head">
                    <small>Stone Origin</small>
                    <button class="hj-help-btn" type="button">?</button>
                    <div class="hj-help-dropdown">{{ $product->tag_label }} stones are made in controlled conditions.</div>
                </div>
                <strong>{{ $product->tag_label}}</strong>
                <span>Gemstone perfection</span>
            </div>

        </div>

        <div class="hj-certificate">
            <span>◎</span>
            <div>
                <small>Certification</small>
                <strong>GEMOLOGICAL CERTIFICATE INCLUDED</strong>
                <p>Guaranteed authenticity</p>
            </div>
        </div>

    </div>

    <!-- SETTINGS TAB -->
    <div class="hj-tab-panel" id="settings">

        <div class="hj-spec-grid">

         @php
    $initialMetalName = data_get($selectedMetal, 'name', '18K GOLD');

    $initialMetalColor = data_get($selectedMetal, 'tone');

    if (!$initialMetalColor) {
        $metalNameForColor = strtolower($initialMetalName);

        if (str_contains($metalNameForColor, 'rose') || str_contains($metalNameForColor, 'pink')) {
            $initialMetalColor = 'Rose';
        } elseif (str_contains($metalNameForColor, 'yellow') || str_contains($metalNameForColor, 'gold')) {
            $initialMetalColor = 'Yellow';
        } elseif (str_contains($metalNameForColor, 'white') || str_contains($metalNameForColor, 'silver')) {
            $initialMetalColor = 'White';
        } elseif (str_contains($metalNameForColor, 'platinum')) {
            $initialMetalColor = 'Platinum';
        } else {
            $initialMetalColor = 'White';
        }
    }
@endphp

<div class="hj-spec-item">
    <div class="hj-spec-head">
        <small>Metal</small>
        <button class="hj-help-btn" type="button">?</button>
        <div class="hj-help-dropdown">Metal defines the ring material.</div>
    </div>

    <strong id="selectedMetalSpec">
        {{ strtoupper($initialMetalName) }}
    </strong>

    <span>Premium finish</span>
</div>

<div class="hj-spec-item">
    <div class="hj-spec-head">
        <small>Metal Color</small>
        <button class="hj-help-btn" type="button">?</button>
        <div class="hj-help-dropdown">The visible color tone of the ring.</div>
    </div>

    <strong id="selectedMetalColorSpec">
        {{ strtoupper($initialMetalColor) }}
    </strong>

    <span>Elegant appearance</span>
</div>

            <div class="hj-spec-item">
                <div class="hj-spec-head">
                    <small>Setting Type</small>
                    <button class="hj-help-btn" type="button">?</button>
                    <div class="hj-help-dropdown">Setting type holds the stone in place.</div>
                </div>
                <strong>SOLITAIRE</strong>
                <span>Classic style</span>
            </div>

            <div class="hj-spec-item">
                <div class="hj-spec-head">
                    <small>Prong Style</small>
                    <button class="hj-help-btn" type="button">?</button>
                    <div class="hj-help-dropdown">Prongs secure the diamond safely.</div>
                </div>
                <strong>4 PRONG</strong>
                <span>Secure diamond hold</span>
            </div>

            <div class="hj-spec-item">
                <div class="hj-spec-head">
                    <small>Band Style</small>
                    <button class="hj-help-btn" type="button">?</button>
                    <div class="hj-help-dropdown">Band style defines the ring profile.</div>
                </div>
                <strong>PLAIN BAND</strong>
                <span>Minimal design</span>
            </div>

            <div class="hj-spec-item">
                <div class="hj-spec-head">
                    <small>Ring Size</small>
                    <button class="hj-help-btn" type="button">?</button>
                    <div class="hj-help-dropdown">Ring size can be selected before order.</div>
                </div>
                <strong>CUSTOM</strong>
                <span>Made to fit</span>
            </div>

        </div>

        <div class="hj-certificate">
            <span>◎</span>
            <div>
                <small>Certification</small>
                <strong>GEMOLOGICAL CERTIFICATE INCLUDED</strong>
                <p>Guaranteed authenticity</p>
            </div>
        </div>

    </div>

</div>
<div class="hj-appointment-card">

    <div class="hj-avatars">
        <img src="{{ asset('assets/f_assets/image/avators/one.jpg') }}" alt="Expert">
        <img src="{{ asset('assets/f_assets/image/avators/one.jpg') }}" alt="Expert">
        <img src="{{ asset('assets/f_assets/image/avators/one.jpg') }}" alt="Expert">
        <span></span>
    </div>

    <div class="hj-appointment-top">
        <h4>SET A VIRTUAL APPOINTMENT</h4>
        <small>Free of charge</small>
    </div>

    <div class="hj-appointment-bottom">
        <p>
            Meet one of our experts who can help you Explore
            engagement rings, Diamonds and fine jewellery
            in person at your device
        </p>

        <button type="button">
            <svg viewBox="0 0 24 24" aria-hidden="true">
                <rect x="4" y="5" width="16" height="15" rx="2"></rect>
                <path d="M8 3v4M16 3v4M4 10h16"></path>
            </svg>
            BOOK APPOINTMENT
        </button>
    </div>

</div>
    
<div class="hj-accordion">

    <div class="hj-acc-item">
        <button type="button" class="hj-acc-btn">
            Why Choose Our Lab Created Engagement Rings?
            <span>⌄</span>
        </button>

        <div class="hj-acc-content">
            <p>
                Our lab created engagement rings offer exceptional brilliance, elegant craftsmanship, and excellent value while keeping the same luxury appearance.
            </p>
        </div>
    </div>

    <div class="hj-acc-item">
        <button type="button" class="hj-acc-btn">
            Free Shipping & Returns
            <span>⌄</span>
        </button>

        <div class="hj-acc-content">
            <p>
                We offer secure delivery and easy return support to make your shopping experience smooth and reliable.
            </p>
        </div>
    </div>

    <div class="hj-acc-item">
        <button type="button" class="hj-acc-btn">
            Why Choose Our Lab Created Engagement Rings?
            <span>⌄</span>
        </button>

        <div class="hj-acc-content">
            <p>
                Each ring is designed with attention to detail, premium finishing, and carefully selected stones for a refined appearance.
            </p>
        </div>
    </div>

    <div class="hj-acc-item">
        <button type="button" class="hj-acc-btn">
            Free Shipping & Returns
            <span>⌄</span>
        </button>

        <div class="hj-acc-content">
            <p>
                Our team will guide you with delivery, return, and after-sales support for a premium customer experience.
            </p>
        </div>
    </div>

</div>

            

        </aside>

    </div>


    

</section>
<section class="hj-handcrafted-banner">
    <div class="hj-handcrafted-container">

        <h2>
            Beautifully Handcrafted, Each Piece Is A Celebration Of Your <br>
            Love, Your Life, And Everything In Between.
        </h2>

        <div class="hj-handcrafted-image">
            <img src="{{ asset('assets/f_assets/image/solitaire/image1.png') }}" alt="Handcrafted Jewellery Banner">
        </div>

    </div>
</section>
<section class="hj-lab-products-section">

    <div class="hj-lab-products-grid">

        @forelse($relatedProducts as $relatedProduct)

            @php
                $relatedMetals = collect($relatedProduct->metals ?? []);
                $relatedCarats = collect($relatedProduct->diamond_carats ?? []);
                $relatedVariants = collect($relatedProduct->variants ?? []);
                $relatedMetalImages = collect($relatedProduct->metal_images ?? []);
                $relatedGalleryImages = collect($relatedProduct->gallery_images ?? []);

                $defaultVariant = $relatedVariants->firstWhere('is_default', true) 
                    ?? $relatedVariants->first();

                $defaultMetalCode = $relatedProduct->default_metal_code
                    ?: ($defaultVariant['metal_code'] ?? ($relatedMetals->first()['code'] ?? ''));

                $defaultCarat = $relatedProduct->default_diamond_carat
                    ?: ($defaultVariant['diamond_carat'] ?? ($relatedCarats->first()['value'] ?? ''));

                $defaultMetal = $relatedMetals->firstWhere('code', $defaultMetalCode);

                $defaultMetalImageGroup = $relatedMetalImages->firstWhere('metal_code', $defaultMetalCode);

                // Only first image from metal_images
                $mainImage = data_get($defaultMetalImageGroup, 'images.0.image_path')
                    ?: data_get($relatedGalleryImages->toArray(), '0.image_path')
                    ?: null;

                $currency = $relatedProduct->currency ?? 'PKR';

                $oldPrice = $defaultVariant['old_price'] ?? null;
                $price = $defaultVariant['price'] ?? null;
                $discount = $defaultVariant['discount_percent'] ?? null;

                $formatMoney = function ($value) use ($currency) {
                    if ($value === null || $value === '') {
                        return '';
                    }

                    return $currency . ' ' . number_format((float) $value, 0);
                };

                $detailUrl = route('solitaire.details', $relatedProduct->slug);

                if ($defaultMetalCode) {
                    $detailUrl .= '?metal=' . urlencode($defaultMetalCode);

                    if ($defaultCarat) {
                        $detailUrl .= '&carat=' . urlencode($defaultCarat);
                    }
                }
            @endphp

            <a href="{{ $detailUrl }}" class="hj-lab-product-card">
                <div class="hj-lab-img-box">
                    <span class="hj-lab-tag">
                        {{ $relatedProduct->tag_label ?? 'Lab Created' }}
                    </span>

                    @if($mainImage)
                        <img 
                            src="{{ asset($mainImage) }}" 
                            alt="{{ $relatedProduct->name }}"
                        >
                    @else
                        <div class="hj-no-image">
                            No Image Available
                        </div>
                    @endif
                </div>

                <div class="hj-lab-product-info">
                    <h3>
                        {{ $relatedProduct->name }}
                    </h3>

                    <p>
                        {{ $defaultCarat ?: '0.25' }} Total Carat · Radiant · Solitaire · {{ $defaultMetal['name'] ?? '14K White Gold' }}
                    </p>

                    <div class="hj-lab-price-row">
                        @if($oldPrice)
                            <span class="hj-old-price">
                                {{ $formatMoney($oldPrice) }}
                            </span>
                        @endif

                        <span class="hj-new-price">
                            {{ $price ? $formatMoney($price) : 'Unavailable' }}
                        </span>

                        @if($discount)
                            <span class="hj-discount">
                                {{ $discount }}% off
                            </span>
                        @endif
                    </div>
                </div>
            </a>

        @empty

            <div class="alert alert-warning">
                No solitaire products found.
            </div>

        @endforelse

    </div>

</section>
@php
    $reviewCount = isset($reviews) ? $reviews->count() : 0;

    $reviewGalleryImages = collect();

    if(isset($reviews)) {
        foreach ($reviews as $review) {
            if (!empty($review->images)) {
                foreach ($review->images as $image) {
                    if (!empty($image['image_path'])) {
                        $reviewGalleryImages->push([
                            'image_path' => $image['image_path'],
                            'alt_text' => $image['alt_text'] ?? $review->title ?? 'Review Image',
                        ]);
                    }
                }
            }
        }
    }
@endphp

@php
    $reviewCount = isset($reviews) ? $reviews->count() : 0;

    $reviewGalleryImages = collect();

    if (isset($reviews)) {
        foreach ($reviews as $review) {
            if (!empty($review->images)) {
                foreach ($review->images as $image) {
                    if (!empty($image['image_path'])) {
                        $reviewGalleryImages->push([
                            'image_path' => $image['image_path'],
                            'alt_text' => $image['alt_text'] ?? $review->title ?? 'Review Image',
                        ]);
                    }
                }
            }
        }
    }
@endphp

<section class="hj-review-section">

    <div class="hj-review-container">

        {{-- TOP AREA --}}
        <div class="hj-review-top">

            {{-- SUMMARY --}}
            <div class="hj-review-summary">
                <h2>Reviews</h2>

                <div class="hj-rating-number">5.0</div>
                <div class="hj-rating-stars">★★★★★</div>

                <div class="hj-rating-count">
                    {{ $reviewCount }} {{ $reviewCount == 1 ? 'Review' : 'Reviews' }}
                </div>
            </div>

            {{-- GALLERY AREA --}}
            <div class="hj-review-gallery-area">

                <div class="hj-review-arrows">
                    <button type="button" class="hj-gallery-prev" aria-label="Previous image">
                        <img 
                            src="{{ asset('assets/f_assets/image/reviews/Icon.svg') }}" 
                            alt="Previous" 
                            class="hj-gallery-arrow-img hj-arrow-left"
                        >
                    </button>

                    <button type="button" class="hj-gallery-next" aria-label="Next image">
                        <img 
                            src="{{ asset('assets/f_assets/image/reviews/Vector.svg') }}" 
                            alt="Next" 
                            class="hj-gallery-arrow-img hj-arrow-right"
                        >
                    </button>
                </div>

                <div class="hj-review-gallery-viewport">
                    <div class="hj-review-gallery-track">

                        @forelse($reviewGalleryImages as $image)
                            <img 
                                src="{{ asset($image['image_path']) }}" 
                                alt="{{ $image['alt_text'] }}"
                            >
                        @empty
                            <p class="text-muted">No review images found.</p>
                        @endforelse

                    </div>
                </div>

            </div>

        </div>


        {{-- SORT --}}
        <div class="hj-review-sort">
            <button type="button">
                Sort: Highest Rating <span>⌄</span>
            </button>
        </div>


        {{-- REVIEW ITEMS --}}
        <div class="hj-review-list" id="hjReviewList">

            @forelse($reviews as $index => $review)

                <div 
                    class="hj-review-item hj-review-load-item"
                    style="{{ $index >= 10 ? 'display:none;' : '' }}"
                >

                    <div class="hj-review-text">
                        <h4>{{ $review->main_title ?? 'Customer' }}</h4>

                        <div class="hj-review-stars-small">★★★★★</div>

                        <h5>{{ $review->title ?? 'Review Title' }}</h5>

                        <p>
                            {{ $review->description ?? '' }}
                        </p>
                    </div>

                    <div class="hj-review-media">
                        <span>
                            {{ $review->created_at ? $review->created_at->format('F d, Y') : '' }}
                        </span>

                        <div class="hj-single-review-img">
                            @if(!empty($review->image))
                                <img 
                                    src="{{ asset($review->image) }}" 
                                    alt="{{ $review->title ?? 'Review Image' }}"
                                >
                            @elseif(!empty($review->images[0]['image_path']))
                                <img 
                                    src="{{ asset($review->images[0]['image_path']) }}" 
                                    alt="{{ $review->title ?? 'Review Image' }}"
                                >
                            @else
                                <div class="hj-no-image">
                                    No Image
                                </div>
                            @endif
                        </div>
                    </div>

                </div>

            @empty

                <div class="alert alert-warning">
                    No reviews found.
                </div>

            @endforelse

        </div>


        {{-- LOAD MORE --}}
        @if($reviews->count() > 3)
            <div class="hj-load-more" id="hjLoadMoreWrap">
                <button type="button" id="hjLoadMoreReviews">
                    Load More
                </button>
            </div>
        @endif

    </div>

</section>
<section class="hj-other-questions">
    <div class="hj-other-questions-inner">

        <h2>Other Questions?</h2>

        <p>We are here 24/7 to answer question you may have.</p>

        <div class="hj-question-actions">
 <a 
    href="https://wa.me/923236314044" 
    class="hj-question-btn" 
    target="_blank"
>
    LIVE CHAT
</a>
        </div>

    </div>
</section>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const dataScript = document.getElementById('hjDetailProductData');
    const gallery = document.getElementById('hjProductGallery');

    if (!dataScript || !gallery) return;

    const data = JSON.parse(dataScript.textContent);

    let selectedMetalCode = data.selected_metal_code || '';
    let selectedCaratIndex = Number(data.selected_carat_index || 0);

    const caratRange = document.getElementById('caratRange');
    const caratBtn = document.getElementById('caratBtn');
    const selectedMetalBtn = document.getElementById('selectedMetalBtn');
    const selectedMetalTitle = document.getElementById('selectedMetalTitle');

    const selectedMetalSpec = document.getElementById('selectedMetalSpec');
    const selectedMetalColorSpec = document.getElementById('selectedMetalColorSpec');
    const selectedCaratSpec = document.getElementById('selectedCaratSpec');

    const oldPriceEl = document.getElementById('detailOldPrice');
    const newPriceEl = document.getElementById('detailNewPrice');
    const savingTextEl = document.getElementById('detailSavingText');
    const caratPriceDiffEl = document.getElementById('caratPriceDiff');

    function normalizeCarat(value) {
        const number = Number(value);
        return isNaN(number) ? String(value) : number.toFixed(2);
    }

    function makeAssetUrl(path) {
        if (!path) return '';

        if (path.startsWith('http') || path.startsWith('/')) {
            return path;
        }

        return window.location.origin + '/' + path;
    }

    function formatMoney(value) {
        if (value === null || value === undefined || value === '') {
            return '';
        }

        const number = Number(value);

        if (isNaN(number)) {
            return data.currency + ' ' + value;
        }

        return data.currency + ' ' + number.toLocaleString(undefined, {
            maximumFractionDigits: 0
        });
    }

    function getSelectedCarat() {
        return data.carats[selectedCaratIndex] || data.carats[0] || null;
    }

    function findMetal(metalCode) {
        return (data.metals || []).find(function (metal) {
            return String(metal.code) === String(metalCode);
        });
    }

    function findVariant(metalCode, caratValue) {
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

    function findBaseVariant(metalCode) {
        const firstCarat = data.carats[0];

        if (!firstCarat) return null;

        return findVariant(metalCode, firstCarat.value);
    }

    function getMetalColor(metal) {
        if (!metal) {
            return 'WHITE';
        }

        if (metal.tone) {
            return String(metal.tone).toUpperCase();
        }

        const metalText = String(metal.name || '').toLowerCase();

        if (metalText.includes('rose') || metalText.includes('pink')) {
            return 'ROSE';
        }

        if (metalText.includes('yellow')) {
            return 'YELLOW';
        }

        if (metalText.includes('white') || metalText.includes('silver')) {
            return 'WHITE';
        }

        if (metalText.includes('platinum')) {
            return 'PLATINUM';
        }

        if (metalText.includes('gold')) {
            return 'GOLD';
        }

        return 'WHITE';
    }

    function getMetalImages(metalCode) {
        const group = (data.metal_images || []).find(function (item) {
            return String(item.metal_code) === String(metalCode);
        });

        if (group && group.images && group.images.length > 0) {
            return group.images;
        }

        if (data.gallery_images && data.gallery_images.length > 0) {
            return data.gallery_images;
        }

        return [];
    }

    function renderGallery(metalCode) {
        const images = getMetalImages(metalCode);

        let html = '';

        if (!images || images.length === 0) {
            html = `
                <div class="hj-gallery-no-image">
                    No images available for this metal.
                </div>
            `;
        } else {
            images.forEach(function (image, index) {
                const imagePath = makeAssetUrl(image.image_path);

                html += `
                    <div class="hj-gallery-item">
                        ${index === 0 ? '<span class="hj-badge">TRADE IN AVAILABLE</span>' : ''}
                        <img 
                            src="${imagePath}" 
                            alt="${image.alt_text || data.name || 'Product image'}"
                        >
                    </div>
                `;
            });
        }

        gallery.innerHTML = html;

        if (typeof window.hjInitGallerySlider === 'function') {
            window.hjInitGallerySlider();
        }
    }

    function updateUrl() {
        const carat = getSelectedCarat();
        const url = new URL(window.location.href);

        if (selectedMetalCode) {
            url.searchParams.set('metal', selectedMetalCode);
        }

        if (carat && carat.value) {
            url.searchParams.set('carat', carat.value);
        }

        window.history.replaceState({}, '', url.toString());
    }

    function updateDetail() {
        const metal = findMetal(selectedMetalCode);
        const carat = getSelectedCarat();

        if (!carat) return;

        const variant = findVariant(selectedMetalCode, carat.value);
        const baseVariant = findBaseVariant(selectedMetalCode);

        renderGallery(selectedMetalCode);

        document.querySelectorAll('.metal-chip').forEach(function (btn) {
            btn.classList.toggle(
                'active',
                String(btn.dataset.metalCode) === String(selectedMetalCode)
            );
        });

        const metalName = metal && metal.name
            ? metal.name
            : selectedMetalCode;

        const metalColor = getMetalColor(metal);

        if (selectedMetalBtn) {
            selectedMetalBtn.textContent = metalName.toUpperCase();
        }

        if (selectedMetalTitle) {
            selectedMetalTitle.textContent = 'Solitaire Engagement Ring - ' + metalName;
        }

        if (selectedMetalSpec) {
            selectedMetalSpec.textContent = metalName.toUpperCase();
        }

        if (selectedMetalColorSpec) {
            selectedMetalColorSpec.textContent = metalColor;
        }

        if (caratRange) {
            caratRange.value = selectedCaratIndex;
        }

        if (caratBtn) {
            caratBtn.textContent = String((carat.label || carat.value) + ' CARAT').toUpperCase();
        }

        if (selectedCaratSpec) {
            selectedCaratSpec.textContent = String((carat.label || carat.value) + ' CARAT').toUpperCase();
        }

        if (variant) {
            if (oldPriceEl) {
                oldPriceEl.textContent = variant.old_price
                    ? formatMoney(variant.old_price)
                    : '';
            }

            if (newPriceEl) {
                newPriceEl.textContent = variant.price
                    ? formatMoney(variant.price)
                    : 'Unavailable';
            }

            if (savingTextEl) {
                savingTextEl.textContent = variant.discount_percent
                    ? 'You save ' + variant.discount_percent + ' %'
                    : '';
            }

            if (caratPriceDiffEl && baseVariant && variant.price && baseVariant.price) {
                const diff = Number(variant.price) - Number(baseVariant.price);

                caratPriceDiffEl.textContent = diff > 0
                    ? '(+' + formatMoney(diff) + ')'
                    : '';
            }
        } else {
            if (oldPriceEl) oldPriceEl.textContent = '';
            if (newPriceEl) newPriceEl.textContent = 'Unavailable';
            if (savingTextEl) savingTextEl.textContent = '';
            if (caratPriceDiffEl) caratPriceDiffEl.textContent = '';
        }

        updateUrl();
    }

    document.querySelectorAll('.metal-chip').forEach(function (btn) {
        btn.addEventListener('click', function (e) {
            e.preventDefault();

            selectedMetalCode = this.dataset.metalCode;
            updateDetail();
        });
    });

    if (caratRange) {
        caratRange.addEventListener('input', function () {
            selectedCaratIndex = Number(this.value);
            updateDetail();
        });
    }

    updateDetail();
});
</script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const reviewItems = document.querySelectorAll('.hj-review-load-item');
    const loadMoreBtn = document.getElementById('hjLoadMoreReviews');
    const loadMoreWrap = document.getElementById('hjLoadMoreWrap');

    let visibleCount = 10;
    const loadStep = 10;

    if (!loadMoreBtn) return;

    loadMoreBtn.addEventListener('click', function () {
        visibleCount += loadStep;

        reviewItems.forEach(function (item, index) {
            if (index < visibleCount) {
                item.style.display = '';
            }
        });

        if (visibleCount >= reviewItems.length) {
            loadMoreWrap.style.display = 'none';
        }
    });
});
</script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.hj-acc-item button').forEach(function (button) {
        button.addEventListener('click', function () {
            const currentItem = this.closest('.hj-acc-item');

            document.querySelectorAll('.hj-acc-item').forEach(function (item) {
                if (item !== currentItem) {
                    item.classList.remove('active');
                }
            });

            currentItem.classList.toggle('active');
        });
    });
});
</script>
@endsection