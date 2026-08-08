@extends('public.layouts.header_black_white_fixed')

@section('content')
    {{-- Success Message Display --}}
    
    {{-- Main Product Details Section --}}
    <section class="product-details-main-section">
        <div class="">
            {{-- Product Details Layout --}}
            <div class="row gy-4 product-details-layout">
                {{-- Left Side - Product Image Gallery (Desktop) --}}
                <div class="col-md-8 col-lg-8 d-none d-md-block" style="padding-right: 30px; padding-left:40px;">
                    <div class="product-gallery">
                        {{-- Main Product Image - Full Width --}}
                        <div class="mb-2">
                            <div class="position-relative">
                                <img 
                                    src="{{ $product->images->first() ? asset($product->images->first()->image) : ($product->image ? asset($product->image) : asset('default.jpg')) }}" 
                                    class="img-fluid w-100 cursor-pointer"
                                    style="object-fit: contain; background-color: #F6F4F2;"
                                    alt="{{ $product->name }}"
                                    onclick="openImagePopup('{{ $product->images->first() ? asset($product->images->first()->image) : ($product->image ? asset($product->image) : asset('default.jpg')) }}')"
                                />
            </div>
                        </div>

                        {{-- Second and Third Images - Side by Side --}}
                        @if($product->images->count() > 1)
                            <div class="row g-2 mb-2">
                                <div class="col-6">
                                    <img 
                                        src="{{ $product->images->get(1) ? asset($product->images->get(1)->image) : asset('default.jpg') }}" 
                                        class="img-fluid w-100 cursor-pointer"
                                        style="object-fit: contain; background-color: #F6F4F2;"
                                        alt="Lifestyle view"
                                        onclick="openImagePopup('{{ $product->images->get(1) ? asset($product->images->get(1)->image) : asset('default.jpg') }}')"
                                    />
                        </div>
                                @if($product->images->count() > 2)
                                    <div class="col-6">
                                        <img 
                                            src="{{ $product->images->get(2) ? asset($product->images->get(2)->image) : asset('default.jpg') }}" 
                                            class="img-fluid w-100 cursor-pointer"
                                            style="object-fit: contain; background-color: #F6F4F2;"
                                            alt="Detail view"
                                            onclick="openImagePopup('{{ $product->images->get(2) ? asset($product->images->get(2)->image) : asset('default.jpg') }}')"
                                        />
                                    </div>
                                    @endif
                        </div>
                        @endif
                        {{-- Fourth Image - Full Width --}}
                        @if($product->images->count() > 3)
                            <div class="mb-2">
                                <img 
                                    src="{{ $product->images->get(3) ? asset($product->images->get(3)->image) : asset('default.jpg') }}" 
                                    class="img-fluid w-100 cursor-pointer"
                                    style="object-fit: contain; background-color: #F6F4F2;"
                                    alt="Additional view"
                                    onclick="openImagePopup('{{ $product->images->get(3) ? asset($product->images->get(3)->image) : asset('default.jpg') }}')"
                                />
                            </div>
                                    @endif
                        {{-- Fifth Image and Beyond - Two in a Row --}}
                        @if($product->images->count() > 4)
                            @php
                                $remainingImages = $product->images->slice(4);
                                $imagePairs = $remainingImages->chunk(2);
                            @endphp
                            
                            @foreach($imagePairs as $pair)
                                <div class="row g-2 mb-2">
                                    @foreach($pair as $imgIndex => $img)
                                        <div class="col-6">
                                            <img 
                                                src="{{ asset($img->image) }}" 
                                                class="img-fluid w-100 cursor-pointer"
                                                style="object-fit: contain; background-color: #F6F4F2;"
                                                alt="Additional view {{ $imgIndex + 4 }}"
                                                onclick="openImagePopup('{{ asset($img->image) }}')"
                                            />
                                        </div>
                                @endforeach
                                </div>
                                @endforeach
                            @endif
                            </div>
                            </div>

                {{-- Mobile Product Image Gallery --}}
                <div class="col-12 d-md-none" style="padding: unset; margin: unset;">
                    <div class="mobile-product-gallery">
                        <div id="mobileProductCarousel" class="carousel slide">
                            @php
                                $hasImages = $product->images && $product->images->count() > 0;
                                $mainImage = $product->image ? asset($product->image) : asset('default.jpg');
                                $totalImages = $hasImages ? $product->images->count() : 1;
                            @endphp
                            
                            {{-- Carousel Indicators --}}
                            @if($totalImages > 1)
                                <div class="carousel-indicators">
                                    @if($hasImages)
                                        @foreach($product->images as $imgIndex => $img)
                                            <button type="button" 
                                                    data-bs-target="#mobileProductCarousel" 
                                                    data-bs-slide-to="{{ $imgIndex }}" 
                                                    class="{{ $imgIndex === 0 ? 'active' : '' }}"
                                                    aria-current="{{ $imgIndex === 0 ? 'true' : 'false' }}"
                                                    aria-label="Slide {{ $imgIndex + 1 }}">
                                            </button>
                                        @endforeach
                                    @else
                                        <button type="button" 
                                                data-bs-target="#mobileProductCarousel" 
                                                data-bs-slide-to="0" 
                                                class="active"
                                                aria-current="true"
                                                aria-label="Slide 1">
                                        </button>
                                    @endif
                                </div>
                            @endif
                            
                            {{-- Carousel Items --}}
                            <div class="carousel-inner">
                                @if($hasImages)
                                    @foreach($product->images as $imgIndex => $img)
                                        <div class="carousel-item {{ $imgIndex === 0 ? 'active' : '' }}">
                                            <div class="mobile-carousel-image-wrapper">
                                                <img 
                                                    src="{{ asset($img->image) }}" 
                                                    class="d-block"
                                                    alt="{{ $product->name }} image {{ $imgIndex + 1 }}"
                                                    onclick="openImagePopup('{{ asset($img->image) }}')"
                                                />
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="carousel-item active">
                                        <div class="mobile-carousel-image-wrapper">
                                            <img 
                                                src="{{ $mainImage }}" 
                                                class="d-block"
                                                alt="{{ $product->name }}"
                                                onclick="openImagePopup('{{ $mainImage }}')"
                                            />
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Right Side - Product Information (Sticky) --}}
                <div class="col-md-4 col-lg-4 mt-0" style="padding-right: 40px; margin: unset;">
                    <div class="product-info sticky-sidebar">

@php
    $storeContext = request()->boolean('store');
    $displayName = $product->displayName($storeContext);
    $displayDescription = $product->displayDescription($storeContext);
@endphp

<h5 class="card-title product-detail-full-name">
    @php
        $nameParts = explode('-', $displayName, 2);
    @endphp
    @if(count($nameParts) > 1)
        {{ strtoupper($nameParts[0]) }}<br>
        <div class="text-muted product-detail-reference">{{ strtoupper($nameParts[1]) }}</div>
    @else
        {{ strtoupper($displayName) }}
    @endif
</h5>






<style>
.product-details-main-section {
    padding: 1.25rem 0 0;
    background: #fff;
}

@media (min-width: 992px) {
    .product-details-main-section {
        padding-top: 1.15rem;
    }
}

.product-details-layout {
    margin-left: 0;
    margin-right: 0;
    --bs-gutter-x: 0;
}

.product-gallery {
    width: 100%;
}

.product-title-wrap {
    margin-bottom: 1.35rem;
}

.product-detail-title,
.product-detail-full-name {
    color: #17120f;
    font-family: 'Argent CF', Georgia, serif !important;
    font-size: clamp(1.5rem, 2.7vw, 3rem) !important;
    font-weight: 200;
    letter-spacing: .015em;
    line-height: 1.06;
}

.product-detail-title {
    font-family: 'Argent CF', Georgia, serif !important;
}

.product-section-label {
    margin: 0 0 12px;
    color: #17120f;
    font-family: "Argent CF", Georgia, serif !important;
    font-size: 1.15rem;
    font-weight: 100;
    letter-spacing: .015em;
    /* text-transform: uppercase; */
    text-decoration: none;
}

.product-features-panel {
    margin-bottom: 1.45rem;
    padding-bottom: 0;
}

.product-description {
    color: #625b54;
    font-family: inherit;
    line-height: 1.72;
    /* font-size: 14px; */
}

/* Paragraph & list base */
.product-description p,
.product-description li {
    margin: 0;
    padding: 0;
    /* line-height: 1.2; */
    font-size: 13px !important;
    font-weight: 400;
}

/* LEFT side labels (normal / slightly bold) */
.product-description strong,
.product-description b {
    font-size: 14px !important;
    font-weight: 500;
    color: #201b17;
}

/* RIGHT side values (more bold & clearer) */
.product-description strong + span,
.product-description b + span {
    /* font-weight: 700; */
    color: #17120f;
}

.product-detail-full-name {
    margin: 0 0 1.35rem;
    overflow: visible !important;
    text-overflow: clip !important;
    white-space: normal !important;
    word-break: normal;
    overflow-wrap: normal;
    display: block !important;
    -webkit-line-clamp: unset !important;
    -webkit-box-orient: unset !important;
}

.product-detail-reference {
    font-size: 0.8rem;
    line-height: 1.2;
}
.price-display {
    font-weight: 500;
    font-size: clamp(1.25rem)
    color: #17120f;
    font-family: 'Poppins';
    letter-spacing: 0.25em;
}

.product-old-price {
    /* margin-bottom: 1.35rem; */
    color: #8f867d;
    font-size: .9rem;
    font-weight: 500;
    letter-spacing: .02em;
    text-decoration: line-through;
    text-decoration-thickness: 1px;
}

.product-price-note {
    margin: .65rem 0 0;
    color: #7a7169;
    font-size: 11px;
    line-height: 1.55;
}

.product-price-panel {
    margin: 1rem 0 !important;
    padding-top: 1rem;
    padding-bottom: 1rem;
    border-top: 1px solid #e6ded6;
    border-bottom: 1px solid #e6ded6;
}

.cta-buttons {
    margin-top: 1.4rem;
}

.product-action-btn {
    min-height: 50px;
    border: 1px solid #17120f !important;
    border-radius: 0 !important;
    font-family: "Poppins", sans-serif !important;
    font-size: 11px !important;
    font-weight: 500 !important;
    letter-spacing: .16em;
    transition: background-color .2s ease, color .2s ease;
}

.product-action-btn-primary {
    background: #17120f !important;
    color: #fff !important;
}

.product-action-btn-primary:hover,
.product-action-btn-primary:focus-visible {
    background: #342b25 !important;
}

.product-action-btn-secondary {
    background: #fff !important;
    color: #17120f !important;
}

.product-action-btn-secondary:hover,
.product-action-btn-secondary:focus-visible {
    background: #17120f !important;
    color: #fff !important;
}

.you-may-like-section {
    margin-top: 0;
    border-top: 0;
    background: linear-gradient(180deg, #fff 0%, #fbfaf8 100%);
    padding-top: 3rem !important;
}

.section-luxury-heading {
    margin: 0;
    color: #17120f;
    font-family: 'Arjent CF', Georgia, serif;
    font-size: clamp(1.5rem, 3.5vw, 1.75rem);
    font-weight: 500;
    letter-spacing: .06em;
    line-height: 1.1;
}

.you-may-like-section .text-center.mb-5 {
    margin-bottom: 3rem !important;
}


@media (max-width: 767.98px) {
    .product-details-main-section {
        padding-top: 62px;
    }

    #mobileProductCarousel .mobile-carousel-image-wrapper {
        aspect-ratio: 1 / 1;
        height: auto !important;
        min-height: 0 !important;
        max-height: calc(100svh - 96px);
    }

    .product-detail-full-name {
        margin: 18px 0 8px !important;
        font-size: 1.25rem !important;
        line-height: 1.2;
    }

    .product-info > .mb-4 {
        /* padding: 0 !important; */
        margin-top: 0 !important;
        margin-bottom: 1rem !important;
    }
}

@media (min-width: 768px) and (max-width: 991.98px) {
    .product-details-main-section {
        padding-top: 72px;
    }

    .product-details-layout > .col-lg-8 {
        padding-right: 28px !important;
    }

    .product-details-layout > .col-lg-4 {
        padding: 0 24px 0 0 !important;
    }
}

.ring-size-panel {
    margin: 1.5rem 0;
}
.ring-size-heading {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 1rem;
    margin-bottom: 0.65rem;
}
.ring-size-heading label {
    margin: 0;
    font-family: "Poppins", sans-serif !important;
    font-size: 0.8rem;
    font-weight: 500;
    letter-spacing: 0.08em;
    text-transform: uppercase;
}
.ring-size-chart-link {
    padding: 0;
    border: 0;
    border-bottom: 1px solid currentColor;
    background: transparent;
    color: #222;
    font-size: 0.75rem;
    line-height: 1.4;
}
.ring-size-toggle {
    width: 100%;
    min-height: 46px;
    padding: 0.65rem 0.85rem;
    border: 1px solid #111;
    border-radius: 0;
    background-color: #fff;
    color: #222;
    font-family: "Poppins", sans-serif !important;
    font-size: 0.9rem;
    display: flex;
    align-items: center;
    justify-content: space-between;
    text-align: left;
    cursor: pointer;
}
.ring-size-toggle:focus {
    border-color: #111;
    outline: none;
    box-shadow: none;
}
.ring-size-arrow {
    display: inline-flex;
    transition: transform 0.2s ease;
}
.ring-size-panel.is-open .ring-size-arrow {
    transform: rotate(180deg);
}
.ring-size-dropdown {
    width: 100%;
    max-height: 0;
    overflow: hidden;
    visibility: hidden;
    opacity: 0;
    border: 0 solid #111;
    border-top: 0;
    background: #fff;
    transition: max-height 0.2s ease, opacity 0.15s ease, visibility 0.15s ease;
}
.ring-size-panel.is-open .ring-size-toggle {
    border-bottom-color: #111;
}
.ring-size-panel.is-open .ring-size-dropdown {
    max-height: 246px;
    overflow-y: auto;
    visibility: visible;
    opacity: 1;
    border-width: 1px;
    border-top-width: 0;
}
.ring-size-option {
    display: block;
    width: 100%;
    min-height: 41px;
    padding: 0.55rem 0.85rem;
    border: 0;
    border-bottom: 1px solid #eeeeee;
    background: #fff;
    color: #222;
    font-family: "Poppins", sans-serif !important;
    font-size: 0.9rem;
    text-align: left;
    cursor: pointer;
}
.ring-size-option:last-child {
    border-bottom: 0;
}
.ring-size-option:hover,
.ring-size-option.is-selected,
.ring-size-option:focus-visible {
    background: #f5f5f5;
    outline: none;
}
.asian-size-note {
    padding-right: 3.5rem;
    color: #666;
    font-size: 0.78rem;
    line-height: 1.5;
}
#asianRingSizeChart {
    z-index: 20000 !important;
}
@media (min-width: 768px) {
    #asianRingSizeChart .modal-dialog {
        left: -28px;
    }
}
#asianRingSizeChart .modal-content {
    position: relative;
    max-height: calc(100vh - 2rem);
}
.ring-size-modal-close {
    position: absolute;
    top: 12px;
    right: 12px;
    z-index: 3;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 42px;
    height: 42px;
    padding: 0;
    border: 1px solid rgba(255, 255, 255, 0.75);
    border-radius: 50%;
    background: rgba(17, 17, 17, 0.92);
    box-shadow: 0 5px 18px rgba(0, 0, 0, 0.28);
    color: #fff;
    font-size: 1.8rem;
    font-weight: 300;
    line-height: 1;
    cursor: pointer;
    transition: background-color 0.2s ease, box-shadow 0.2s ease, transform 0.2s ease;
}
.ring-size-modal-close:hover,
.ring-size-modal-close:focus-visible {
    background: #a98750;
    box-shadow: 0 7px 22px rgba(0, 0, 0, 0.34);
    outline: 2px solid #fff;
    outline-offset: 2px;
    transform: rotate(90deg);
}
.asian-size-chart-image {
    display: block;
    width: 100%;
    height: auto;
}
@media (max-width: 767.98px) {
    .asian-size-chart-scroll {
        overflow-x: auto;
    }
    .asian-size-chart-image {
        min-width: 720px;
    }
}

</style>
@if(
    optional($product->subcategory)->slug === 'favre-leuba' ||
    optional($product->subcategory)->slug === 'cuervo-y-sobrinos'||
        optional($product->subcategory)->slug === 'maurice-lacroix'

)
<style>
  @media (max-width: 576px) {
    .mb-4 {
      margin-top: -50px !important;
    }
  }
</style>
@endif

@if(filled($displayDescription))
<div class="product-features-panel">
    <h3 class="product-section-label">
        Main Features:
    </h3>
    <div class="product-description">
        {!! $displayDescription !!}
    </div>
</div>
@endif

                        {{-- Price Display --}}
                        <!-- <div class="my-5">
                            @if($product->show_price && $product->price > 0)
                                <div class="price-display" style="font-size: 1.3rem; font-weight: 600;">
                                    PKR {{ number_format($product->price) }}
                                </div>
                            @endif
                        </div> -->
@php
    $livePrice    = $product->displayPrice($storeContext);
    $roundedPrice = round($livePrice, -3);
    $isJewelleryProduct = optional($product->category)->slug !== 'watches';
    $canShowPrice = $storeContext
        ? ($roundedPrice > 0)
        : (!empty($product->show_price) && $roundedPrice > 0);
    $isOutOfStock = $product->quantity !== null && (int) $product->quantity === 0;
@endphp

    <!-- @if($canShowPrice)
        <div class="price-display" style="font-size: 1.3rem; font-weight: 600;">
            PKR {{ number_format($roundedPrice, 0, '.', ',') }}
        </div>
        <p class="mt-2 mb-0" style="font-size: 12px; color: #666; line-height: 1;">
        All prices are subject to change without prior notice due to fluctuations in gold prices, size, weight variations, handcrafted production, and customization requirements.
      </p>
    @endif   -->
@if($canShowPrice)
<div class="product-price-panel">
    

    <div class="price-display">
        PKR {{ number_format($roundedPrice, 0, '.', ',') }}
    </div>

    @if($isJewelleryProduct)
        <p class="product-price-note">
            All prices are subject to change without prior notice due to fluctuations in gold prices, size, weight variations, handcrafted production, and customization requirements.
        </p>
    @endif
</div>
@endif
                        {{-- Size Selector --}}
                        @php
                            $isRingSizeProduct = $product->requiresAsianRingSize();
                            $asianRingSizes = range(4, 27);
                            $pricePositive = ($product->price ?? 0) > 0;
                        @endphp

                        @if($isRingSizeProduct)
                            <div class="ring-size-panel" id="productSizePanel">
                                <div class="ring-size-heading">
                                    <label for="productSizeToggle">Select Asian Ring Size</label>
                                    <button type="button" class="ring-size-chart-link" data-bs-toggle="modal" data-bs-target="#asianRingSizeChart">
                                        View Size Chart
                                    </button>
                                </div>
                                <button type="button" class="ring-size-toggle" id="productSizeToggle" aria-expanded="false" aria-haspopup="listbox" aria-controls="productSizeDropdown">
                                    <span id="productSizeSelected">Choose a size</span>
                                    <span class="ring-size-arrow" aria-hidden="true">
                                        <svg width="18" height="18" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 0 1 1.06.02L10 10.94l3.71-3.71a.75.75 0 1 1 1.08 1.04l-4.25 4.25a.75.75 0 0 1-1.06 0L5.21 8.27a.75.75 0 0 1 .02-1.06Z" clip-rule="evenodd" />
                                        </svg>
                                    </span>
                                </button>
                                <div class="ring-size-dropdown" id="productSizeDropdown" role="listbox" aria-label="Asian ring sizes">
                                    @foreach($asianRingSizes as $ringSize)
                                        <button type="button" class="ring-size-option" data-size="{{ $ringSize }}" role="option" aria-selected="false">
                                            {{ $ringSize }}
                                        </button>
                                    @endforeach
                                </div>
                                <input type="hidden" id="product-size" name="size" value="">
                            </div>

                            <div class="modal fade" id="asianRingSizeChart" tabindex="-1" aria-label="Asian ring size chart" aria-hidden="true">
                                <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                                    <div class="modal-content rounded-0">
                                        <button type="button" class="ring-size-modal-close" data-bs-dismiss="modal" aria-label="Close size chart">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        <div class="modal-body">
                                            <p class="asian-size-note mb-3">
                                                Measure the inside diameter of a ring that fits comfortably, then select the closest Asian size.
                                            </p>
                                            <div class="asian-size-chart-scroll">
                                                <img
                                                    src="{{ asset('assets/media/size-chart.jpeg') }}"
                                                    class="asian-size-chart-image"
                                                    alt="International ring size conversion chart with circumference, diameter, USA and Canada, UK and Australia, Asia, and Switzerland sizes"
                                                >
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif

                        {{-- Call-to-Action Buttons --}}
                        <div class="cta-buttons">
                            @if($canShowPrice)
                                @if($isOutOfStock)
                                    <p class="text-danger text-center fw-semibold mb-3">This is out of stock</p>
                                @else
                                    {{-- First Row - Add to Cart and Buy Now --}}
                                    <div class="row g-2 mb-3">
                                        <!-- <div class="col-6">
                                            <button type="button" class="btn btn-dark w-100 py-2" onclick="addToCart()" 
                                                    style="font-weight: 400; font-size: 0.8rem; border-radius: 4px;">
                                                ADD TO CART
                                            </button>
                                        </div> -->
                                        <div class="">
                                            <button type="button" class="product-action-btn product-action-btn-primary btn btn-dark w-100 py-2" onclick="buyNow()">
                                                BUY NOW
                                            </button>
                                        </div>
                                    </div>
                                @endif
                                {{-- Talk to Expert when price is available --}}
                                <div class="text-center">
                                    <button type="button" class="product-action-btn product-action-btn-secondary btn btn-dark w-100 py-2" onclick="talkToExpert()">
                                        TALK TO AN EXPERT
                                    </button>
                                </div>
                            @else
                                {{-- Only Talk to Expert when no price --}}
                                <div class="text-center">
                                    <button type="button" class="product-action-btn product-action-btn-primary btn btn-dark w-100 py-2" onclick="talkToExpert()">
                                        TALK TO AN EXPERT
                                    </button>
                                </div>
                            @endif
                        </div>
                          <p class="mt-2 mb-0" style="font-size: 12px; color: #666; line-height: 1;"  >
                            Estimated delivery time is 7 to 10 business days.
            </p>

                        {{-- Success Message --}}
                        <div id="cartMessage" class="mt-3"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @php
        $productSubcategorySlug = strtolower(trim((string) optional($product->subcategory)->slug));
        $productSubcategoryName = strtolower(trim((string) optional($product->subcategory)->name));
        $isTawoosSubcategory = $productSubcategorySlug === 'tawoos'
            || $productSubcategoryName === 'tawoos';
    @endphp

    @unless($isTawoosSubcategory)
            {{-- YOU MAY ALSO LIKE Section --}}
    <section class="py-5 you-may-like-section">
        <div class="">
            <div class="text-center mb-5">
                <h3 class="section-luxury-heading">YOU MAY ALSO LIKE</h3>
            </div>

            <!-- Desktop: homepage-style single-row scroller -->
            <section id="ymlDesktop" class="onlineStore">
                <div class="yml-slider-viewport">
                    <button type="button" class="yml-scroller-arrow yml-scroller-arrow--prev" aria-label="Previous products" disabled>
                        <span aria-hidden="true" class="yml-arrow-left">
                            <svg viewBox="0 0 24 24" height="22" width="22" fill="currentColor">
                                <path d="M12.6 12L8.7 8.1C8.52 7.92 8.42 7.68 8.42 7.4C8.42 7.12 8.52 6.88 8.7 6.7C8.88 6.52 9.12 6.42 9.4 6.42C9.68 6.42 9.92 6.52 10.1 6.7L14.7 11.3C14.8 11.4 14.87 11.51 14.91 11.62C14.95 11.74 14.97 11.87 14.97 12C14.97 12.13 14.95 12.26 14.91 12.38C14.87 12.49 14.8 12.6 14.7 12.7L10.1 17.3C9.92 17.48 9.68 17.57 9.4 17.57C9.12 17.57 8.88 17.48 8.7 17.3C8.52 17.12 8.42 16.88 8.42 16.6C8.42 16.32 8.52 16.08 8.7 15.9L12.6 12Z"/>
                            </svg>
                        </span>
                    </button>
                    <div id="recommendedProducts" class="mobile-product-scroller" tabindex="0" aria-label="You may also like products">
                        <div class="scroller-container">
                            @foreach($recommendedProducts as $recProduct)
                                <div class="scroller-item">
                                    @include('public.partials.product-card-new', [
                                        'product' => $recProduct,
                                        'storeContext' => $storeContext,
                                    ])
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <button type="button" class="yml-scroller-arrow yml-scroller-arrow--next" aria-label="Next products">
                        <span aria-hidden="true">
                            <svg viewBox="0 0 24 24" height="22" width="22" fill="currentColor">
                                <path d="M12.6 12L8.7 8.1C8.52 7.92 8.42 7.68 8.42 7.4C8.42 7.12 8.52 6.88 8.7 6.7C8.88 6.52 9.12 6.42 9.4 6.42C9.68 6.42 9.92 6.52 10.1 6.7L14.7 11.3C14.8 11.4 14.87 11.51 14.91 11.62C14.95 11.74 14.97 11.87 14.97 12C14.97 12.13 14.95 12.26 14.91 12.38C14.87 12.49 14.8 12.6 14.7 12.7L10.1 17.3C9.92 17.48 9.68 17.57 9.4 17.57C9.12 17.57 8.88 17.48 8.7 17.3C8.52 17.12 8.42 16.88 8.42 16.6C8.42 16.32 8.52 16.08 8.7 15.9L12.6 12Z"/>
                            </svg>
                        </span>
                    </button>
                </div>
                <div class="scroller-dots mt-3">
                    <div class="yml-progress-track" aria-hidden="true">
                        <span class="yml-progress-fill"></span>
                    </div>
                </div>
            </section>
        </div>
    </section>
    @endunless

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        function smoothScrollTo(element, target, duration = 450) {
            const start = element.scrollLeft;
            const distance = target - start;
            if (Math.abs(distance) < 1) return;
            const startTime = performance.now();
            function easeInOutQuad(t) { return t < 0.5 ? 2 * t * t : -1 + (4 - 2 * t) * t; }
            function step(now) {
                const elapsed = now - startTime;
                const progress = Math.min(1, elapsed / duration);
                element.scrollLeft = start + distance * easeInOutQuad(progress);
                if (progress < 1) requestAnimationFrame(step);
                else element.scrollLeft = target;
            }
            requestAnimationFrame(step);
        }

        function initializeYmlScroller(sectionSelector) {
            const scroller = document.querySelector(`${sectionSelector} .mobile-product-scroller`);
            const container = document.querySelector(`${sectionSelector} .scroller-container`);
            const items = document.querySelectorAll(`${sectionSelector} .scroller-item`);
            const dots = document.querySelectorAll(`${sectionSelector} .dot`);
            const progressFill = document.querySelector(`${sectionSelector} .yml-progress-fill`);
            const prevButton = document.querySelector(`${sectionSelector} .yml-scroller-arrow--prev`);
            const nextButton = document.querySelector(`${sectionSelector} .yml-scroller-arrow--next`);
            if (!scroller || !container || !items.length) return;

            function getLastScrollableIndex() {
                return Math.max(0, items.length - 1);
            }

            function getStep() {
                if (items.length < 2) return items[0].getBoundingClientRect().width;
                const base = items[0].offsetLeft;
                for (let i = 1; i < items.length; i++) {
                    const d = items[i].offsetLeft - base;
                    if (d > 0) return d;
                }
                return items[0].getBoundingClientRect().width;
            }

            function nearestIndex() {
                let idx = 0;
                let best = Infinity;
                items.forEach((item, i) => {
                    const dist = Math.abs(item.offsetLeft - scroller.scrollLeft);
                    if (dist < best) {
                        best = dist;
                        idx = i;
                    }
                });
                return Math.min(idx, getLastScrollableIndex());
            }

            function paintDot(dot, isActive) {
                dot.classList.toggle('active', isActive);
                dot.setAttribute('aria-current', isActive ? 'true' : 'false');
                dot.style.backgroundColor = '';
            }

            function updateDots() {
                const idx = nearestIndex();
                const lastScrollableIndex = getLastScrollableIndex();
                dots.forEach((dot, index) => {
                    const isAvailable = index <= lastScrollableIndex;
                    dot.hidden = !isAvailable;
                    dot.setAttribute('aria-hidden', isAvailable ? 'false' : 'true');
                    paintDot(dot, isAvailable && index === idx);
                });

                const maxScroll = Math.max(0, scroller.scrollWidth - scroller.clientWidth);
                const noScroll = maxScroll <= 2;
                if (progressFill) {
                    const segment = 100 / items.length;
                    const progress = noScroll ? 0 : scroller.scrollLeft / maxScroll;
                    progressFill.style.width = `${segment}%`;
                    progressFill.style.left = `${progress * (100 - segment)}%`;
                }
                if (prevButton) prevButton.disabled = noScroll || scroller.scrollLeft <= 5;
                if (nextButton) nextButton.disabled = noScroll || scroller.scrollLeft >= maxScroll - 5;
            }

            function itemTarget(index) {
                const maxScroll = Math.max(0, scroller.scrollWidth - scroller.clientWidth);
                if (index <= 0) return 0;
                if (index >= getLastScrollableIndex()) return maxScroll;
                return Math.max(0, Math.min(maxScroll, items[index].offsetLeft));
            }

            let isMouseDown = false, startX = 0, startLeft = 0;
            scroller.addEventListener('mousedown', (e) => {
                if (e.target.closest('a, button')) return;
                isMouseDown = true;
                startX = e.clientX;
                startLeft = scroller.scrollLeft;
                scroller.style.cursor = 'grabbing';
                e.preventDefault();
            });
            scroller.addEventListener('mousemove', (e) => {
                if (!isMouseDown) return;
                scroller.scrollLeft = startLeft - (e.clientX - startX);
            });
            ['mouseleave','mouseup'].forEach(evt => scroller.addEventListener(evt, () => {
                if (!isMouseDown) return;
                isMouseDown = false;
                scroller.style.cursor = 'grab';
                // snap to nearest
                const idx = nearestIndex();
                smoothScrollTo(scroller, itemTarget(idx), 350);
            }));

            dots.forEach((dot) => {
                dot.addEventListener('click', () => {
                    const indexAttr = dot.getAttribute('data-index');
                    const targetIdx = indexAttr ? parseInt(indexAttr, 10) : 0;
                    const bounded = Math.max(0, Math.min(getLastScrollableIndex(), targetIdx));
                    smoothScrollTo(scroller, itemTarget(bounded), 450);
                });
            });

            if (prevButton) {
                prevButton.addEventListener('click', () => {
                    const targetIndex = Math.max(0, nearestIndex() - 1);
                    smoothScrollTo(scroller, itemTarget(targetIndex), 450);
                });
            }
            if (nextButton) {
                nextButton.addEventListener('click', () => {
                    const targetIndex = Math.min(getLastScrollableIndex(), nearestIndex() + 1);
                    smoothScrollTo(scroller, itemTarget(targetIndex), 450);
                });
            }

            let rafId = null;
            scroller.addEventListener('scroll', () => {
                if (rafId) cancelAnimationFrame(rafId);
                rafId = requestAnimationFrame(() => { updateDots(); rafId = null; });
            });

            // initial state
            if (window.matchMedia('(max-width: 767.98px)').matches) {
                scroller.scrollLeft = 0;
            }
            updateDots();
            window.addEventListener('resize', updateDots);
            if (getComputedStyle(scroller).cursor === 'auto') scroller.style.cursor = 'grab';
        }

        initializeYmlScroller('#ymlDesktop');
    });
    </script>

    {{-- ICONIC DESIGN Section --}}
    <!-- <section class="py-5 my-5" style="background: #fafafa;">
        <div class="container">
            <div class="row align-items-center">
                {{-- Left Side - Product Description --}}
                <div class="col-lg-6">
                    <div class="pe-lg-5">
                        <h2 class="fw-bold mb-4" style="font-family: serif; font-size: 2.5rem;">
                            ICONIC DESIGN
                        </h2>
                        <div class="product-description" style="line-height: 1.8; color: #6c757d; font-size: 1.1rem;">
                            <p class="mb-4">
                                {{ $product->name }} represents a feminine masterpiece of watchmaking art, 
                                featuring dancing diamonds that create a mesmerizing display of light and movement. 
                                This piece serves as a crossroads between a watch and a piece of jewellery, 
                                embodying the perfect fusion of precision engineering and artistic elegance.
                            </p>
                            <p class="mb-0">
                                Each {{ $product->name }} is crafted with meticulous attention to detail, 
                                using only the finest materials and most advanced techniques. The result is a 
                                timeless piece that transcends trends and becomes a cherished part of your personal story.
                            </p>
                        </div>
                    </div>
                </div>
                
                {{-- Right Side - Detailed Product Image --}}
                <div class="col-lg-6">
                    <div class="text-center">
                        <div class="position-relative">
                            <img 
                                src="{{ $product->images->count() > 0 ? asset($product->images->first()->image) : ($product->image ? asset($product->image) : asset('default.jpg')) }}" 
                                alt="{{ $product->name }} - Detailed View"
                                class="img-fluid rounded-3"
                                style="max-height: 400px; object-fit: contain; filter: drop-shadow(0 10px 30px rgba(0,0,0,0.1));"
                            />
                            
                            {{-- Floating Elements --}}
                            <div class="position-absolute" 
                                 style="top: 20%; right: 10%; width: 60px; height: 60px; background: rgba(255,255,255,0.9); border-radius: 50%; display: flex; align-items: center; justify-content: center; box-shadow: 0 5px 15px rgba(0,0,0,0.1);">
                                <i class="fas fa-gem" style="color: #d4af37; font-size: 24px;"></i>
                            </div>
                            <div class="position-absolute" 
                                 style="bottom: 30%; left: 5%; width: 40px; height: 40px; background: rgba(255,255,255,0.9); border-radius: 50%; display: flex; align-items: center; justify-content: center; box-shadow: 0 5px 15px rgba(0,0,0,0.1);">
                                <i class="fas fa-star" style="color: #d4af37; font-size: 16px;"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> -->

    {{-- RECENTLY VIEWED Section --}}
    <!-- <section class="py-5">
        <div class="container">
            {{-- Section Header --}}
            <div class="text-center mb-5">
                <h3 class="fw-bold" style="font-family: serif; font-size: 2rem;">
                    RECENTLY VIEWED
                </h3>
            </div>
            
            {{-- Carousel Container --}}
            <div class="position-relative">
                {{-- Navigation Arrows --}}
                <button class="btn btn-link position-absolute top-50 start-0 translate-middle-y text-dark p-0" 
                        onclick="scrollRecentlyViewed('left')" 
                        style="z-index: 10; left: -20px;">
                    <i class="fas fa-chevron-left" style="font-size: 24px;"></i>
                </button>
                <button class="btn btn-link position-absolute top-50 end-0 translate-middle-y text-dark p-0" 
                        onclick="scrollRecentlyViewed('right')" 
                        style="z-index: 10; right: -20px;">
                    <i class="fas fa-chevron-right" style="font-size: 24px;"></i>
                </button>
                
                {{-- Products Carousel --}}
                <div class="products-carousel" id="recentlyViewedProducts" 
                     style="overflow-x: auto; scroll-behavior: smooth; -webkit-overflow-scrolling: touch;">
                    <div class="d-flex gap-3" style="min-width: max-content;">
                        {{-- Recently viewed products will be loaded here via JavaScript --}}
                        <div id="recentlyViewedContainer">
                            {{-- Loading placeholder --}}
                            <div class="text-center py-5">
                                <div class="spinner-border text-muted" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                                <p class="mt-3 text-muted">Loading recently viewed products...</p>
                            </div>
                    </div>
                </div>
            </div>

                {{-- Carousel Dots --}}
                <div class="text-center mt-4">
                    <div class="d-flex justify-content-center gap-2" id="recentlyViewedDots">
                        {{-- Dots will be generated dynamically --}}
                    </div>
                </div>
            </div>
        </div>
    </section> -->

    {{-- Full Page Image Popup Modal --}}
    <div id="imagePopup" class="image-popup-modal" style="display: none;">
        <div class="popup-overlay">
            {{-- Popup Carousel Container --}}
            <div class="popup-carousel-container">
                <div class="popup-carousel-track" id="popupCarouselTrack">
                    {{-- Images will be dynamically added here --}}
                </div>
            </div>
            
            {{-- Navigation Arrows --}}
            <button class="popup-nav popup-prev" onclick="navigatePopup(-1)">
                <i class="fas fa-chevron-left"></i>
            </button>
            <button class="popup-nav popup-next" onclick="navigatePopup(1)">
                <i class="fas fa-chevron-right"></i>
            </button>
            
            {{-- Close Button --}}
            <button class="popup-close" onclick="closeImagePopup()">
                <i class="fas fa-times"></i>
            </button>
            
            {{-- Zoom Controls --}}
            <div class="popup-zoom-controls">
                <button class="popup-zoom-btn" onclick="zoomIn()" title="Zoom In">
                    <i class="fas fa-search-plus"></i>
                </button>
                <button class="popup-zoom-btn" onclick="zoomOut()" title="Zoom Out">
                    <i class="fas fa-search-minus"></i>
                </button>
                <button class="popup-zoom-btn" onclick="resetZoom()" title="Reset Zoom">
                    <i class="fas fa-expand-arrows-alt"></i>
                </button>
            </div>
            
            {{-- Image Counter --}}
            <div class="popup-counter">
                <span id="currentImageIndex">1</span> / <span id="totalImages">1</span>
            </div>
            
            {{-- Carousel Dots --}}
            <div class="popup-dots" id="popupDots">
                {{-- Dots will be generated dynamically --}}
            </div>
        </div>
    </div>

    {{-- Custom Styles --}}
    <style>
        /* ===== GENERAL STYLES ===== */
        .cursor-pointer {
            cursor: pointer;
        }
        
        .product-description {
            color: #625b54;
            font-family: inherit;
            line-height: 1.72;
        }
        
        /* ===== PRODUCT CARD STYLES ===== */
        .product-card:hover:not(.addToCartProductDetailsTop) {
            transform: translateY(-8px);
            box-shadow: 0 12px 40px rgba(0,0,0,0.15) !important;
        }
        
        .product-card a:hover {
            text-decoration: none;
        }
        
        .product-card .btn-link:hover {
            background-color: rgba(255,255,255,0.9);
            border-radius: 50%;
        }
        /* ===== SERVICE ITEM STYLES ===== */
        .service-item {
            cursor: pointer;
            transition: background-color 0.3s ease;
            border-radius: 8px;
            margin-bottom: 2px;
        }
        
        .service-item:hover {
            background-color: #f8f9fa;
        }
        
        .service-item.expanded {
            background-color: #f8f9fa;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        
        .service-item.expanded .fa-chevron-down {
            transform: rotate(180deg);
        }
        
        .service-item .fa-chevron-down {
            transition: transform 0.3s ease;
        }
        
        /* ===== SCROLLBAR STYLES ===== */
        .service-features {
            scrollbar-width: thin;
            scrollbar-color: #ccc transparent;
        }
        
        .service-features::-webkit-scrollbar {
            width: 6px;
        }
        
        .service-features::-webkit-scrollbar-track {
            background: transparent;
        }
        
        .service-features::-webkit-scrollbar-thumb {
            background-color: #ccc;
            border-radius: 3px;
        }
        /* ===== CAROUSEL DOT STYLES ===== */
        .carousel-dot.active, 
        .recently-viewed-dot.active {
            background: #000 !important;
        }
        
        /* ===== STICKY SIDEBAR STYLES ===== */
        .sticky-sidebar {
            position: sticky;
            top: 88px;
            height: fit-content;
            align-self: flex-start;
            /* max-height: calc(100vh - 40px);
            overflow-y: auto; */
            z-index: 5;
        }
        
        /* ===== RESPONSIVE ADJUSTMENTS ===== */
        @media (max-width: 767.98px) {
            .sticky-sidebar {
                position: static;
                top: auto;
                max-height: none;
                overflow-y: visible;
            }
            
            .product-info {
                margin-top: 20px;
                box-shadow: none;
                border: 0;
            }

            .mobile-product-gallery,
            #mobileProductCarousel {
                width: 100%;
                overflow: hidden;
                background-color: #F6F4F2;
            }

            #mobileProductCarousel .mobile-carousel-image-wrapper {
                width: 100% !important;
                aspect-ratio: 1 / 1;
                height: auto !important;
                min-height: 0 !important;
                max-height: calc(100svh - 96px);
                display: flex;
                align-items: center;
                justify-content: center;
                background-color: #F6F4F2;
                overflow: hidden;
            }

            #mobileProductCarousel .mobile-carousel-image-wrapper img {
                width: auto !important;
                height: auto !important;
                max-width: 100%;
                max-height: calc(100svh - 96px);
                object-fit: contain !important;
                cursor: pointer;
            }

            #mobileProductCarousel .mobile-carousel-scroll-track {
                align-items: center;
            }

            #mobileProductCarousel .mobile-carousel-scroll-item {
                display: flex !important;
                align-items: center;
                justify-content: center;
            }

            #mobileProductCarousel .carousel-indicators {
                bottom: 12px;
                left: 50%;
                right: auto;
                transform: translateX(-50%);
                display: inline-flex;
                align-items: center;
                justify-content: center;
                gap: 4px;
                width: auto;
                margin: 0;
                padding: 0;
                background: transparent;
                z-index: 5;
            }

            #mobileProductCarousel .carousel-indicators button {
                width: 4px !important;
                height: 4px !important;
                min-width: 4px;
                min-height: 4px;
                margin: 0 !important;
                padding: 0;
                border: 0 !important;
                border-top: 0 !important;
                border-bottom: 0 !important;
                border-radius: 50% !important;
                background-color: #000 !important;
                background-clip: initial !important;
                opacity: .28;
                transition: opacity .18s ease, width .18s ease;
            }

            #mobileProductCarousel .carousel-indicators button.active {
                width: 24px !important;
                min-width: 24px;
                height: 4px !important;
                min-height: 4px;
                border-radius: 999px !important;
                opacity: 1;
            }
        }
        
        /* ===== SMOOTH SCROLLING ===== */
        html {
            scroll-behavior: smooth;
        }
        
        /* ===== IMAGE POPUP MODAL STYLES ===== */
        .image-popup-modal {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255);
            z-index: 9999;
            display: flex;
            justify-content: center;
            align-items: center;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
            overflow: hidden;
        }
        
        .image-popup-modal.show {
            opacity: 1;
            visibility: visible;
        }
        
        .popup-overlay {
            position: relative;
            width: 100%;
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        
        .popup-carousel-container {
            width: 90%;
            height: 90%;
            overflow: hidden;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .popup-carousel-track {
            display: flex;
            transition: transform 0.5s ease-in-out;
            height: 100%;
            align-items: center;
        }
        
        .popup-carousel-item {
            min-width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .popup-image {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
            border-radius: 8px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            cursor: zoom-in;
            transition: all 0.5s ease-in-out;
            transform-origin: center center;
        }
        
        .popup-image:active {
            cursor: grabbing;
        }
        
        .popup-image.zoomed {
            cursor: grab;
        }
        
        .popup-image.zoom-out {
            cursor: zoom-out;
        }
        
        /* ===== POPUP NAVIGATION STYLES ===== */
        .popup-nav {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background: rgba(0, 0, 0, 0.1);
            border: none;
            color: #333;
            font-size: 20px;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
            backdrop-filter: blur(10px);
            z-index: 10001;
        }
        
        .popup-nav:hover {
            background: rgba(0, 0, 0, 0.2);
            transform: translateY(-50%) scale(1.1);
        }
        
        .popup-prev {
            left: 20px;
        }
        
        .popup-next {
            right: 20px;
        }
        
        /* ===== POPUP CLOSE BUTTON ===== */
        .popup-close {
            position: absolute;
            top: 20px;
            right: 30px;
            background: rgba(0, 0, 0, 0.1);
            border: none;
            color: #333;
            font-size: 24px;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
            backdrop-filter: blur(10px);
            z-index: 10001;
        }
        
        .popup-close:hover {
            background: rgba(0, 0, 0, 0.2);
            transform: scale(1.1);
        }
        
        /* ===== POPUP ZOOM CONTROLS ===== */
        .popup-zoom-controls {
            position: absolute;
            top: 20px;
            right: 100px;
            display: flex;
            gap: 10px;
            z-index: 10001;
        }
        
        .popup-zoom-btn {
            background: rgba(0, 0, 0, 0.1);
            border: none;
            color: #333;
            font-size: 18px;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
            backdrop-filter: blur(10px);
        }
        
        .popup-zoom-btn:hover {
            background: rgba(0, 0, 0, 0.2);
            transform: scale(1.1);
        }
        
        .popup-zoom-btn:disabled {
            opacity: 0.5;
            cursor: not-allowed;
            transform: none;
        }
        
        /* ===== POPUP COUNTER ===== */
        .popup-counter {
            position: absolute;
            bottom: 30px;
            left: 50%;
            transform: translateX(-50%);
            background: rgba(0, 0, 0, 0.8);
            color: white;
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 14px;
            font-weight: 500;
            z-index: 10001;
        }
        
        /* ===== POPUP DOTS ===== */
        .popup-dots {
            position: absolute;
            bottom: 80px;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            gap: 8px;
            z-index: 10001;
        }
        
        .popup-dot {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background: rgba(0, 0, 0, 0.3);
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .popup-dot:hover {
            background: rgba(0, 0, 0, 0.5);
        }
        
        .popup-dot.active {
            background: #333;
            transform: scale(1.2);
        }
        
        /* ===== MOBILE RESPONSIVE STYLES ===== */
        @media (max-width: 768px) {
            .popup-image {
                max-width: 95%;
                max-height: 80%;
            }
            
            .popup-close {
                top: 10px;
                right: 15px;
                width: 40px;
                height: 40px;
                font-size: 18px;
            }
            
            .popup-nav {
                width: 40px;
                height: 40px;
                font-size: 16px;
            }
            
            .popup-prev {
                left: 10px;
            }
            
            .popup-next {
                right: 10px;
            }
            
            .popup-counter {
                bottom: 20px;
                font-size: 12px;
                padding: 6px 12px;
            }
            
            .popup-dots {
                bottom: 60px;
            }
            
            .popup-dot {
                width: 8px;
                height: 8px;
            }
        }

        /* Product card button styling */
        .addToCartProductDetails {
            position: relative;
            z-index: 15;
            pointer-events: auto !important;
        }
        
        /* ===== RECENTLY VIEWED CAROUSEL STYLING ===== */
        #recentlyViewedProducts {
            overflow-x: auto !important;
            scroll-behavior: smooth !important;
            -webkit-overflow-scrolling: touch !important;
        }
        
        #recentlyViewedProducts .d-flex {
            display: flex !important;
            flex-direction: row !important;
            flex-wrap: nowrap !important;
            gap: 1rem !important;
            min-width: max-content !important;
        }
        
        #recentlyViewedContainer {
            display: flex !important;
            flex-direction: row !important;
            flex-wrap: nowrap !important;
            gap: 1rem !important;
            min-width: max-content !important;
        }
        
        .product-card-item {
            flex-shrink: 0 !important;
            min-width: 350px !important;
            max-width: 350px !important;
            flex: 0 0 350px !important;
        }
        
        /* Drag-to-scroll cursor styling */
        #recommendedProducts { cursor: grab; }
        #recommendedProducts.is-grabbing { cursor: grabbing; }
        /* Hide scrollbar while keeping scroll functionality */
        #recommendedProducts { -ms-overflow-style: none; scrollbar-width: none; }
        #recommendedProducts::-webkit-scrollbar { display: none; }

        /* YOU MAY ALSO LIKE – Desktop horizontal scroller */
        #ymlDesktop .mobile-product-scroller {
            overflow-x: auto;
            overflow-y: hidden;
            -webkit-overflow-scrolling: touch;
            scrollbar-width: none;
        }
        #ymlDesktop .mobile-product-scroller::-webkit-scrollbar { display: none; }
        #ymlDesktop .yml-slider-viewport {
            position: relative;
            width: 100%;
            overflow: visible;
        }
        #ymlDesktop .yml-scroller-arrow {
            position: absolute;
            top: 47%;
            transform: translateY(-50%);
            z-index: 30;
            width: 44px;
            height: 44px;
            border: 1px solid rgba(0, 0, 0, 0.12);
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.95);
            color: #2a2a2a;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            padding: 0;
            transition: transform 0.3s ease, box-shadow 0.3s ease, opacity 0.3s ease, background 0.3s ease;
            backdrop-filter: blur(6px);
            -webkit-backdrop-filter: blur(6px);
        }
        #ymlDesktop .yml-scroller-arrow--prev { left: 10px; }
        #ymlDesktop .yml-scroller-arrow--next { right: 10px; }
        #ymlDesktop .yml-arrow-left svg { transform: rotate(180deg); }
        #ymlDesktop .yml-scroller-arrow:hover:not(:disabled) {
            transform: translateY(-50%) scale(1.04);
            background: #fff;
            box-shadow: 0 2px 14px rgba(0, 0, 0, 0.14);
        }
        #ymlDesktop .yml-scroller-arrow:disabled {
            opacity: 0;
            visibility: hidden;
            pointer-events: none;
        }
        #ymlDesktop .scroller-container {
            display: flex;
            gap: 10px;
            padding: 0 20px;
            width: max-content;
        }
        #ymlDesktop .scroller-item {
            flex: 0 0 350px;
            min-width: 350px;
            max-width: 350px;
        }
        #ymlDesktop .scroller-item .card { width: 100%; height: 100%; }
        #ymlDesktop .mobile-product-scroller { cursor: grab; }

        /* Desktop dots styling */
        #ymlDesktop .scroller-dots {
            display: none;
            justify-content: center;
            margin-top: 20px;
        }
        #ymlDesktop .dots-container {
            display: flex;
            gap: 8px;
        }
        #ymlDesktop .dot {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background-color: #ccc;
            cursor: pointer;
            transition: background-color 0.3s ease;
            border: none;
            outline: none;
        }
        #ymlDesktop .dot.active { background-color: #000; }
        #ymlDesktop .dot:hover { background-color: #666; }

        /* YOU MAY ALSO LIKE – Mobile horizontal scroller */
        #ymlMobile .mobile-product-scroller {
            overflow-x: auto;
            overflow-y: hidden;
            -webkit-overflow-scrolling: touch;
            scrollbar-width: none;
        }
        #ymlMobile .mobile-product-scroller::-webkit-scrollbar { display: none; }
        #ymlMobile .scroller-container {
            display: flex;
            gap: 10px;
            padding: 0 12px;
            width: max-content;
        }
        #ymlMobile .scroller-item {
            flex: 0 0 320px;
            min-width: 320px;
            max-width: 320px;
        }
        #ymlMobile .scroller-item .card { width: 100%; height: 100%; }

        /* Mobile dots styling */
        #ymlMobile .scroller-dots {
            display: flex;
            justify-content: center;
            margin-top: 16px;
        }
        #ymlMobile .dots-container {
            display: flex;
            gap: 8px;
        }
        #ymlMobile .dot {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background-color: #ccc;
            cursor: pointer;
            transition: background-color 0.3s ease;
            border: none;
            outline: none;
        }
        #ymlMobile .dot.active { background-color: #000; }
        #ymlMobile .dot:hover { background-color: #666; }

        @media (max-width: 767.98px) {
            #ymlDesktop .yml-scroller-arrow {
                display: none;
            }

            .you-may-like-section {
                padding-top: 2rem !important;
                padding-bottom: 2rem !important;
                overflow: hidden;
            }

            .you-may-like-section .text-center.mb-5 {
                margin-bottom: 1.25rem !important;
            }

            .you-may-like-section h3 {
                font-size: 1.7rem !important;
                line-height: 1.15;
                margin: 0;
            }

            #ymlDesktop .mobile-product-scroller {
                width: 100%;
                padding: 0;
                scroll-snap-type: none;
            }

            #ymlDesktop .scroller-container {
                gap: 10px;
                padding: 0 12px;
                width: max-content;
            }

            #ymlDesktop .scroller-item {
                flex: 0 0 calc(100vw - 24px);
                min-width: calc(100vw - 24px);
                max-width: calc(100vw - 24px);
                scroll-snap-align: none;
            }

            #ymlDesktop .scroller-item .card {
                min-height: 0;
                border: 1px solid #ece8e3;
                background-color: #F6F4F2 !important;
                overflow: hidden;
                display: flex;
                flex-direction: column;
            }

            #ymlDesktop .addToCartProductDetailsTop .card-img {
                height: auto !important;
                min-height: 0 !important;
                padding: 0 !important;
                margin: 0 !important;
                display: flex;
                align-items: center;
                justify-content: center;
                background-color: #F6F4F2 !important;
            }

            #ymlDesktop .addToCartProductDetailsTop .card-img > .position-relative {
                width: 100%;
                height: 100%;
                display: flex !important;
                align-items: center;
                justify-content: center;
            }

            #ymlDesktop .addToCartProductDetailsTop .carousel,
            #ymlDesktop .addToCartProductDetailsTop .carousel-inner,
            #ymlDesktop .addToCartProductDetailsTop .carousel-item,
            #ymlDesktop .addToCartProductDetailsTop .carousel-item > a,
            #ymlDesktop .addToCartProductDetailsTop .product-image-link {
                width: 100%;
                height: 100% !important;
            }

            #ymlDesktop .addToCartProductDetailsTop .carousel-item > a,
            #ymlDesktop .addToCartProductDetailsTop .product-image-link {
                display: flex !important;
                align-items: center;
                justify-content: center;
            }

            #ymlDesktop .addToCartProductDetailsTop .card-img img,
            #ymlDesktop .addToCartProductDetailsTop .product-image {
                width: 100% !important;
                max-width: 100% !important;
                max-height: 100% !important;
                height: 100% !important;
                object-fit: contain;
                margin: 0 !important;
                display: block;
            }

            #ymlDesktop .addToCartProductDetailsTop .swiper-pagination {
                position: absolute !important;
                left: 50% !important;
                bottom: 12px !important;
                transform: translateX(-50%) !important;
                width: auto;
                height: 18px;
                gap: 9px;
                margin: 0 !important;
                padding: 0 !important;
                background: transparent !important;
            }

            #ymlDesktop .addToCartProductDetailsTop .swiper-pagination-bullet {
                width: 5px;
                height: 5px;
                background-color: #e4e1dc;
                opacity: 1;
            }

            #ymlDesktop .addToCartProductDetailsTop .swiper-pagination-bullet-active {
                width: 36px;
                height: 3px;
                border-radius: 999px;
                background-color: #222;
            }

            #ymlDesktop .addToCartProductDetailsTop .card-body {
                padding: 10px 10px 18px !important;
                background-color: #F6F4F2 !important;
                display: flex;
                flex-direction: column;
                align-items: center;
                flex: 0 0 auto;
            }

            #ymlDesktop .addToCartProductDetailsTop .product-name-fixed {
                width: 100%;
                font-size: 12px !important;
                line-height: 1.25 !important;
                min-height: 0 !important;
                margin: 0 0 12px !important;
                padding: 0 !important;
                white-space: nowrap !important;
                overflow: hidden !important;
                text-overflow: ellipsis !important;
                text-align: center;
            }

            #ymlDesktop .addToCartProductDetailsTop .card-text {
                font-size: 13px !important;
                line-height: 1.2 !important;
                margin: -2px 0 10px !important;
                min-height: 0;
            }

            #ymlDesktop .addToCartProductDetailsTop .discover-more-btn {
                width: 140px !important;
                min-height: 32px;
                margin: 0 auto !important;
                display: inline-flex !important;
                align-items: center;
                justify-content: center;
                font-size: 12px !important;
                line-height: 1;
                visibility: visible !important;
                opacity: 1 !important;
            }

            #ymlDesktop .scroller-dots {
                display: block;
                margin-top: 14px !important;
            }

            #ymlDesktop .yml-progress-track {
                position: relative;
                width: 96px;
                height: 2px;
                margin: 0 auto;
                overflow: hidden;
                background: #d8d8d8;
            }

            #ymlDesktop .yml-progress-fill {
                position: absolute;
                top: 0;
                left: 0;
                height: 100%;
                background: #111;
            }

            #ymlDesktop .dots-container {
                gap: 8px;
                align-items: center;
                justify-content: center;
                padding: 0;
                width: auto;
                max-width: calc(100vw - 24px);
                overflow: visible;
            }

            #ymlDesktop button.dot.carousel-dot {
                display: block !important;
                flex: 0 0 8px !important;
                width: 8px !important;
                height: 8px !important;
                min-width: 8px !important;
                min-height: 8px !important;
                max-width: 8px !important;
                max-height: 8px !important;
                aspect-ratio: 1 / 1;
                padding: 0 !important;
                margin: 0 !important;
                border: 0 !important;
                border-radius: 50% !important;
                appearance: none;
                -webkit-appearance: none;
                box-sizing: border-box;
                line-height: 0;
                background-color: #d8d8d8;
            }

            #ymlDesktop button.dot.carousel-dot.active {
                flex-basis: 8px !important;
                width: 8px !important;
                height: 8px !important;
                min-width: 8px !important;
                min-height: 8px !important;
                max-width: 8px !important;
                max-height: 8px !important;
                border-radius: 50% !important;
                background-color: #000 !important;
            }
        }
    </style>

    {{-- JavaScript Functionality --}}
                            <script>
        // ===== QUANTITY MANAGEMENT =====
        function updateQuantity(change) {
            const quantityInput = document.getElementById('quantity');
            const newValue = parseInt(quantityInput.value) + change;
            if (newValue >= 1) {
                quantityInput.value = newValue;
                document.getElementById('quantityDisplay').textContent = newValue;
            }
        }


        // ===== IMAGE GALLERY FUNCTIONALITY =====
                                function changeMainImage(src, index) {
                                    document.getElementById('mainImage').src = src;
            
            // Update thumbnail borders
            document.querySelectorAll('.thumbnail-gallery img').forEach((img, idx) => {
                img.style.borderColor = idx === index ? '#000' : '#e9ecef';
            });
        }

        // ===== CART FUNCTIONALITY =====
        // Ring and supported gold-colour tags require an Asian ring size.
        const requiresSizeSelection = @json($isRingSizeProduct);

        const productSizePanel = document.getElementById('productSizePanel');
        const productSizeToggle = document.getElementById('productSizeToggle');
        const productSizeSelected = document.getElementById('productSizeSelected');
        const productSizeInput = document.getElementById('product-size');
        const productSizeOptions = document.querySelectorAll('.ring-size-option');
        const asianRingSizeModal = document.getElementById('asianRingSizeChart');

        // The product panel is sticky and creates a low stacking context. Moving
        // the modal to <body> lets it sit above the site's high-z-index backdrop.
        if (asianRingSizeModal && asianRingSizeModal.parentElement !== document.body) {
            document.body.appendChild(asianRingSizeModal);
        }

        function setProductSizeOpen(isOpen) {
            if (!productSizePanel || !productSizeToggle) return;

            productSizePanel.classList.toggle('is-open', isOpen);
            productSizeToggle.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
        }

        if (productSizeToggle) {
            productSizeToggle.addEventListener('click', function () {
                setProductSizeOpen(!productSizePanel.classList.contains('is-open'));
            });
        }

        productSizeOptions.forEach(function (option) {
            option.addEventListener('click', function () {
                const selectedSize = option.dataset.size;

                productSizeInput.value = selectedSize;
                productSizeSelected.textContent = selectedSize;
                productSizeOptions.forEach(function (item) {
                    const isSelected = item === option;
                    item.classList.toggle('is-selected', isSelected);
                    item.setAttribute('aria-selected', isSelected ? 'true' : 'false');
                });
                setProductSizeOpen(false);
            });
        });

        document.addEventListener('click', function (event) {
            if (productSizePanel && !productSizePanel.contains(event.target)) {
                setProductSizeOpen(false);
            }
        });
        
        function addToCart() {
            const quantity = document.getElementById('quantity') ? document.getElementById('quantity').value : 1;
            const sizeSelect = document.getElementById('product-size');
            const selectedSize = sizeSelect ? sizeSelect.value : '';
            
            // Validate only products that render the Asian ring-size selector.
            if (requiresSizeSelection && !selectedSize) {
                showToast('error', 'Please select a size before adding to cart.');
                setProductSizeOpen(true);
                productSizeToggle?.focus();
                return;
            }
            
            const formData = new FormData();
            formData.append('product_id', '{{ $product->id }}');
            formData.append('quantity', quantity);
            formData.append('size', selectedSize);
            formData.append('_token', '{{ csrf_token() }}');
            @if($storeContext)
            formData.append('store', '1');
            @endif

            fetch("{{ route('cart.add') }}", {
                method: "POST",
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                },
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showToast('success', data.message);
                    location.reload();
                } else {
                    showToast('error', data.message || 'Could not add to cart');
                }
            })
            .catch(() => {
                showToast('error', 'Error adding to cart.');
            });
        }

        function buyNow() {
            // Add to cart first, then redirect to checkout
            const quantity = document.getElementById('quantity') ? document.getElementById('quantity').value : 1;
            const sizeSelect = document.getElementById('product-size');
            const selectedSize = sizeSelect ? sizeSelect.value : '';
            
            // Validate only products that render the Asian ring-size selector.
            if (requiresSizeSelection && !selectedSize) {
                showToast('error', 'Please select a size before proceeding to checkout.');
                setProductSizeOpen(true);
                productSizeToggle?.focus();
                return;
            }
            
            const formData = new FormData();
            formData.append('product_id', '{{ $product->id }}');
            formData.append('quantity', quantity);
            formData.append('size', selectedSize);
            formData.append('_token', '{{ csrf_token() }}');
            @if($storeContext)
            formData.append('store', '1');
            @endif

            fetch("{{ route('cart.add') }}", {
                method: "POST",
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                },
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if(data.success) {
                    // Redirect to checkout
                    window.location.href = "{{ route('checkout') }}";
                } else {
                    showToast('error', data.message || 'Could not add to cart');
                }
            })
            .catch(() => {
                showToast('error', 'Error adding to cart.');
            });
        }

        function talkToExpert() {
            // Open WhatsApp chat with expert
            const productLink = '{{ url(route("product.details", $product->slug)) }}';
            const message = `Hi, I want to consult about this product: {{ $product->name }}\n\n${productLink}`;
            @php
                $isFranckMuller = false;
                if ($product->subcategory && strtolower($product->subcategory->slug) === 'franck-muller') {
                    $isFranckMuller = true;
                }
            @endphp
            const phoneNumber = @json($isFranckMuller ? '923070222666' : '923070222666');
            const whatsappUrl = `https://api.whatsapp.com/send?phone=${phoneNumber}&text=${encodeURIComponent(message)}`;
            window.open(whatsappUrl, '_blank');
        }

        // ===== SERVICE TOGGLE FUNCTIONALITY =====
        function toggleService(serviceItem) {
            // Toggle the expanded state
            const isExpanded = serviceItem.classList.contains('expanded');
            
            // Close all other items
            document.querySelectorAll('.service-item').forEach(item => {
                item.classList.remove('expanded');
                const icon = item.querySelector('.fa-chevron-down');
                if (icon) icon.style.transform = 'rotate(0deg)';
                
                // Hide full content and show preview for all items
                const fullContent = item.querySelector('.service-full-content');
                const preview = item.querySelector('.service-preview');
                if (fullContent) fullContent.style.display = 'none';
                if (preview) preview.style.display = 'block';
            });
            
            // Toggle current item
            if (!isExpanded) {
                serviceItem.classList.add('expanded');
                const icon = serviceItem.querySelector('.fa-chevron-down');
                if (icon) icon.style.transform = 'rotate(180deg)';
                
                // Show full content and hide preview for current item
                const fullContent = serviceItem.querySelector('.service-full-content');
                const preview = serviceItem.querySelector('.service-preview');
                if (fullContent) fullContent.style.display = 'block';
                if (preview) preview.style.display = 'none';
            }
        }

        // ===== CAROUSEL NAVIGATION =====
        function scrollProducts(direction) {
            const container = document.getElementById('recommendedProducts');
            const containerWidth = container.clientWidth;
            const currentScroll = container.scrollLeft;
            const maxScroll = container.scrollWidth - container.clientWidth;
            
            if (direction === 'right') {
                if (currentScroll < maxScroll) {
                    container.scrollBy({ left: containerWidth, behavior: 'smooth' });
                }
            } else {
                if (currentScroll > 0) {
                    container.scrollBy({ left: -containerWidth, behavior: 'smooth' });
                }
            }
            
            // Update arrow visibility after scroll
            setTimeout(() => {
                updateArrowVisibility();
            }, 300);
        }

        function scrollRecentlyViewed(direction) {
            const container = document.getElementById('recentlyViewedProducts');
            const containerWidth = container.clientWidth;
            const currentScroll = container.scrollLeft;
            const maxScroll = container.scrollWidth - container.clientWidth;
            
            if (direction === 'right') {
                if (currentScroll < maxScroll) {
                    container.scrollBy({ left: containerWidth, behavior: 'smooth' });
                }
            } else {
                if (currentScroll > 0) {
                    container.scrollBy({ left: -containerWidth, behavior: 'smooth' });
                }
            }
            
            // Update arrow visibility after scroll
            setTimeout(() => {
                updateRecentlyViewedArrowVisibility();
            }, 300);
        }
        
        // ===== ARROW VISIBILITY MANAGEMENT =====
        function updateArrowVisibility() {
            const container = document.getElementById('recommendedProducts');
            const leftArrow = document.querySelector('[onclick="scrollProducts(\'left\')"]');
            const rightArrow = document.querySelector('[onclick="scrollProducts(\'right\')"]');
            
            const currentScroll = container.scrollLeft;
            const maxScroll = container.scrollWidth - container.clientWidth;
            
            // Show/hide left arrow
            if (leftArrow) {
                leftArrow.style.opacity = currentScroll > 0 ? '1' : '0.3';
            }
            
            // Show/hide right arrow
            if (rightArrow) {
                rightArrow.style.opacity = currentScroll < maxScroll ? '1' : '0.3';
            }
        }

        function updateRecentlyViewedArrowVisibility() {
            const container = document.getElementById('recentlyViewedProducts');
            const leftArrow = document.querySelector('[onclick="scrollRecentlyViewed(\'left\')"]');
            const rightArrow = document.querySelector('[onclick="scrollRecentlyViewed(\'right\')"]');
            
            const currentScroll = container.scrollLeft;
            const maxScroll = container.scrollWidth - container.clientWidth;
            
            // Show/hide left arrow
            if (leftArrow) {
                leftArrow.style.opacity = currentScroll > 0 ? '1' : '0.3';
            }
            
            // Show/hide right arrow
            if (rightArrow) {
                rightArrow.style.opacity = currentScroll < maxScroll ? '1' : '0.3';
            }
        }

        // ===== CAROUSEL SLIDE NAVIGATION =====
        function goToSlide(slideIndex) {
            const container = document.getElementById('recommendedProducts');
            if (!container) return;
            const items = container.querySelectorAll('.scroller-item, .product-card-item');
            const maxScroll = Math.max(0, container.scrollWidth - container.clientWidth);
            const lastScrollableIndex = Math.max(0, items.length - 1);
            slideIndex = Math.max(0, Math.min(lastScrollableIndex, slideIndex));
            const target = items[slideIndex];
            if (!target) return;
            let targetLeft;
            if (slideIndex === 0) {
                targetLeft = 0;
            } else if (slideIndex >= lastScrollableIndex) {
                targetLeft = maxScroll;
            } else {
                const targetRect = target.getBoundingClientRect();
                const contRect = container.getBoundingClientRect();
                targetLeft = container.scrollLeft + (targetRect.left - contRect.left);
            }
            container.scrollTo({ left: targetLeft, behavior: 'smooth' });
            setTimeout(() => { updateRecommendedDots(); }, 60);
        }
        // Ensure global access for inline handlers
        window.ymlGoTo = goToSlide;
 
        // Keep outer carousel dots in sync with scroll position
        function updateRecommendedDots() {
            const container = document.getElementById('recommendedProducts');
            if (!container) return;
            const section = container.closest('section') || document;
            const dots = section.querySelectorAll('.carousel-dot');
            const items = container.querySelectorAll('.scroller-item, .product-card-item');
            if (!items.length || !dots.length) return;
            const maxScroll = Math.max(0, container.scrollWidth - container.clientWidth);
            const lastScrollableIndex = Math.max(0, items.length - 1);
            // Find nearest item to current scroll (relative to container)
            const currentLeft = container.scrollLeft;
            let nearestIndex = 0;
            let nearestDist = Infinity;
            items.forEach((el, i) => {
                const itemLeft = container.scrollLeft + (el.getBoundingClientRect().left - container.getBoundingClientRect().left);
                const dist = Math.abs(itemLeft - currentLeft);
                if (dist < nearestDist) { nearestDist = dist; nearestIndex = i; }
            });
            nearestIndex = Math.min(nearestIndex, lastScrollableIndex);
            dots.forEach((dot, index) => {
                const isAvailable = index <= lastScrollableIndex;
                const isActive = isAvailable && index === nearestIndex;
                dot.hidden = !isAvailable;
                dot.setAttribute('aria-hidden', isAvailable ? 'false' : 'true');
                dot.classList.toggle('active', isActive);
                dot.setAttribute('aria-current', isActive ? 'true' : 'false');
                dot.style.background = '';
            });
        }

        function goToMobileSlide(slideIndex) {
            const scroller = document.querySelector('#ymlDesktop .mobile-product-scroller');
            const item = document.querySelector(`#ymlDesktop .scroller-item:nth-child(${slideIndex + 1})`);
            if (!scroller || !item) return;

            scroller.scrollTo({ left: item.offsetLeft, behavior: 'smooth' });

            // Update dots
            document.querySelectorAll('#ymlDesktop .scroller-dots .dot').forEach((dot) => {
                dot.classList.remove('active');
            });
            const activeDot = document.querySelector(`#ymlDesktop .scroller-dots .dot:nth-child(${slideIndex + 1})`);
            if (activeDot) activeDot.classList.add('active');
        }

        function goToPopupSlide(index) {
            // Reset zoom when navigating to a specific image
            resetZoom();
            
            currentPopupIndex = index;
            clickCount = 0;
            
            // Update counter and dots
            currentImageIndex.textContent = currentPopupIndex + 1;
            generatePopupDots();
            
            // Update carousel position to show the selected image
            const carouselTrack = document.getElementById('popupCarouselTrack');
            if (carouselTrack) {
                const targetPosition = -(currentPopupIndex + 1) * 100;
                carouselTrack.style.transition = 'transform 0.5s ease-in-out';
                carouselTrack.style.transform = `translateX(${targetPosition}%)`;
            }
        }
        
        // ===== WISHLIST FUNCTIONALITY =====
        function addToWishlist(productId) {
            // Prevent the link from being followed
            event.stopPropagation();
            
            // Toggle heart icon
            const heartIcon = event.target.closest('.btn-link').querySelector('i');
            if (heartIcon.classList.contains('far')) {
                heartIcon.classList.remove('far');
                heartIcon.classList.add('fas');
                heartIcon.style.color = '#dc3545';
            } else {
                heartIcon.classList.remove('fas');
                heartIcon.classList.add('far');
                heartIcon.style.color = '#000';
            }
            
            // Here you would typically make an AJAX call to add/remove from wishlist
            // For now, we'll just show a simple message
        }

        // ===== IMAGE POPUP FUNCTIONALITY =====
        const imagePopup = document.getElementById('imagePopup');
        const popupImage = document.getElementById('popupImage');
        const popupDots = document.getElementById('popupDots');
        const currentImageIndex = document.getElementById('currentImageIndex');
        const totalImages = document.getElementById('totalImages');
        
        // Store gallery images array
        let galleryImages = [];
        let currentPopupIndex = 0;
        
        // Zoom functionality variables
        let currentZoom = 1;
        let minZoom = 0.5;
        let maxZoom = 3;
        let isDragging = false;
        let dragStartX = 0;
        let dragStartY = 0;
        let translateX = 0;
        let translateY = 0;
        let clickCount = 0; // Track click count for cycling zoom
        let zoomLevels = [1, 1.5, 2, 1]; // Zoom levels to cycle through

        function openImagePopup(src) {
            // Disable body scrolling when popup opens
            document.body.style.overflow = 'hidden';
            
            // Get all gallery images (excluding the feature image)
            galleryImages = [];
            
            // Add all product gallery images to the gallery (excluding feature image)
            @foreach($product->images as $index => $img)
                galleryImages.push('{{ asset($img->image) }}');
            @endforeach
            
            // If no gallery images, add the main product image
            if (galleryImages.length === 0) {
                galleryImages.push('{{ $product->image ? asset($product->image) : asset('default.jpg') }}');
            }

            // Find the index of the clicked image
            currentPopupIndex = galleryImages.indexOf(src);
            if (currentPopupIndex === -1) currentPopupIndex = 0;

            // Reset zoom when opening new image
            resetZoom();
            clickCount = 0;

            // Build carousel track with circular structure
            const carouselTrack = document.getElementById('popupCarouselTrack');
            carouselTrack.innerHTML = '';
            
            if (galleryImages.length === 1) {
                // For single image, just add the image directly
                const carouselItem = document.createElement('div');
                carouselItem.className = 'popup-carousel-item';
                
                const img = document.createElement('img');
                img.src = galleryImages[0];
                img.alt = 'Product Image';
                img.className = 'popup-image';
                img.onclick = clickToZoom;
                
                carouselItem.appendChild(img);
                carouselTrack.appendChild(carouselItem);
            } else {
                // For multiple images, build circular structure
                // Add last image at the beginning (for circular effect)
                const lastImage = galleryImages[galleryImages.length - 1];
                const carouselItemLast = document.createElement('div');
                carouselItemLast.className = 'popup-carousel-item';
                const imgLast = document.createElement('img');
                imgLast.src = lastImage;
                imgLast.alt = 'Product Image';
                imgLast.className = 'popup-image';
                imgLast.onclick = clickToZoom;
                carouselItemLast.appendChild(imgLast);
                carouselTrack.appendChild(carouselItemLast);
                
                // Add all original images
                galleryImages.forEach((imageSrc, index) => {
                    const carouselItem = document.createElement('div');
                    carouselItem.className = 'popup-carousel-item';
                    
                    const img = document.createElement('img');
                    img.src = imageSrc;
                    img.alt = 'Product Image';
                    img.className = 'popup-image';
                    img.onclick = clickToZoom;
                    
                    carouselItem.appendChild(img);
                    carouselTrack.appendChild(carouselItem);
                });
                
                // Add first image at the end (for circular effect)
                const firstImage = galleryImages[0];
                const carouselItemFirst = document.createElement('div');
                carouselItemFirst.className = 'popup-carousel-item';
                const imgFirst = document.createElement('img');
                imgFirst.src = firstImage;
                imgFirst.alt = 'Product Image';
                imgFirst.className = 'popup-image';
                imgFirst.onclick = clickToZoom;
                carouselItemFirst.appendChild(imgFirst);
                carouselTrack.appendChild(carouselItemFirst);
            }

            // Update popup content
            currentImageIndex.textContent = currentPopupIndex + 1;
            totalImages.textContent = galleryImages.length;

            // Generate dots
            generatePopupDots();

            // Show popup
            imagePopup.style.display = 'flex';
            setTimeout(() => {
                imagePopup.classList.add('show');
                
                // Check if there's only one image
                if (galleryImages.length === 1) {
                    // Disable navigation arrows for single image
                    const prevBtn = document.querySelector('.popup-prev');
                    const nextBtn = document.querySelector('.popup-next');
                    if (prevBtn) prevBtn.style.display = 'none';
                    if (nextBtn) nextBtn.style.display = 'none';
                    
                    // Disable dots for single image
                    const dotsContainer = document.getElementById('popupDots');
                    if (dotsContainer) dotsContainer.style.display = 'none';
                    
                    // Disable counter for single image
                    const counterContainer = document.querySelector('.popup-counter');
                    if (counterContainer) counterContainer.style.display = 'none';
                } else {
                    // Enable navigation arrows for multiple images
                    const prevBtn = document.querySelector('.popup-prev');
                    const nextBtn = document.querySelector('.popup-next');
                    if (prevBtn) prevBtn.style.display = 'flex';
                    if (nextBtn) nextBtn.style.display = 'flex';
                    
                    // Enable dots for multiple images
                    const dotsContainer = document.getElementById('popupDots');
                    if (dotsContainer) dotsContainer.style.display = 'flex';
                    
                    // Enable counter for multiple images
                    const counterContainer = document.querySelector('.popup-counter');
                    if (counterContainer) counterContainer.style.display = 'block';
                    
                    // Set initial position to show the correct image
                    const carouselTrack = document.getElementById('popupCarouselTrack');
                    const initialPosition = -(currentPopupIndex + 1) * 100;
                    carouselTrack.style.transition = 'none';
                    carouselTrack.style.transform = `translateX(${initialPosition}%)`;
                    setTimeout(() => {
                        carouselTrack.style.transition = 'transform 0.5s ease-in-out';
                    }, 10);
                }
            }, 10);
        }

        function generatePopupDots() {
            popupDots.innerHTML = '';
            for (let i = 0; i < galleryImages.length; i++) {
                const dot = document.createElement('div');
                dot.classList.add('popup-dot');
                if (i === currentPopupIndex) {
                    dot.classList.add('active');
                }
                dot.onclick = () => goToPopupSlide(i);
                popupDots.appendChild(dot);
            }
        }

        function navigatePopup(direction) {
            // Reset zoom when navigating to a new image
            resetZoom();
            
            // Calculate new index
            let newIndex = currentPopupIndex + direction;
            let isLooping = false;
            
            // Handle circular navigation
            if (newIndex < 0) {
                newIndex = galleryImages.length - 1;
                isLooping = true;
            } else if (newIndex >= galleryImages.length) {
                newIndex = 0;
                isLooping = true;
            }
            
            // Update index
            currentPopupIndex = newIndex;
            
            // Update counter and dots
            currentImageIndex.textContent = currentPopupIndex + 1;
            generatePopupDots();
            
            // Update carousel position with smooth infinite circular motion
            updateCarouselPositionInfinite(direction);
        }
        
        function updateCarouselPositionInfinite(direction) {
            const carouselTrack = document.getElementById('popupCarouselTrack');
            if (!carouselTrack) {
                return;
            }
            
            // Calculate the target position for infinite circular motion
            let targetPosition;
            let needsReset = false;
            
            if (direction > 0) {
                // Moving forward (next)
                if (currentPopupIndex === 0) {
                    // Going from last to first (infinite loop)
                    targetPosition = -(galleryImages.length + 1) * 100; // Slide to cloned first
                    needsReset = true;
                } else {
                    // Normal forward movement
                    targetPosition = -(currentPopupIndex + 1) * 100;
                }
            } else {
                // Moving backward (previous)
                if (currentPopupIndex === galleryImages.length - 1) {
                    // Going from first to last (infinite loop)
                    targetPosition = 0; // Slide to cloned last
                    needsReset = true;
                } else {
                    // Normal backward movement
                    targetPosition = -(currentPopupIndex + 1) * 100;
                }
            }
            
            // Apply smooth transition
            carouselTrack.style.transition = 'transform 0.5s ease-in-out';
            carouselTrack.style.transform = `translateX(${targetPosition}%)`;
            
            // Handle infinite loop reset after transition
            if (needsReset) {
                setTimeout(() => {
                    carouselTrack.style.transition = 'none';
                    
                    if (direction > 0) {
                        // Reset to real first image
                        carouselTrack.style.transform = `translateX(-100%)`;
                    } else {
                        // Reset to real last image
                        carouselTrack.style.transform = `translateX(-${galleryImages.length * 100}%)`;
                    }
                    
                    setTimeout(() => {
                        carouselTrack.style.transition = 'transform 0.5s ease-in-out';
                    }, 10);
                }, 500);
            }
        }
        
        function updateCarouselPosition() {
            const carouselTrack = document.getElementById('popupCarouselTrack');
            if (carouselTrack) {
                const translateX = -currentPopupIndex * 100;
                carouselTrack.style.transform = `translateX(${translateX}%)`;
            }
        }

        function closeImagePopup() {
            // Re-enable body scrolling when popup closes
            document.body.style.overflow = '';
            
            imagePopup.classList.remove('show');
            setTimeout(() => {
                imagePopup.style.display = 'none';
            }, 300);
        }
        
        // ===== ZOOM FUNCTIONALITY =====
        function zoomIn() {
            if (currentZoom < maxZoom) {
                currentZoom += 0.5;
                updateZoom();
            }
            updateZoomButtons();
        }
        
        function zoomOut() {
            if (currentZoom > minZoom) {
                currentZoom -= 0.5;
                updateZoom();
            }
            updateZoomButtons();
        }
        
        function resetZoom() {
            currentZoom = 1;
            translateX = 0;
            translateY = 0;
            clickCount = 0;
            updateZoom();
            updateZoomButtons();
        }
        
        function updateZoom() {
            let currentImage;
            
            if (galleryImages.length === 1) {
                // For single image, target the first (and only) carousel item
                currentImage = document.querySelector('.popup-carousel-item:nth-child(1) .popup-image');
            } else {
                // For multiple images, calculate the correct carousel item index (accounting for the cloned last image at the beginning)
                const carouselItemIndex = currentPopupIndex + 2; // +2 because: 1 for cloned last image + 1 for 1-based index
                currentImage = document.querySelector('.popup-carousel-item:nth-child(' + carouselItemIndex + ') .popup-image');
            }
            
            if (!currentImage) return;
            
            const transform = `scale(${currentZoom}) translate(${translateX}px, ${translateY}px)`;
            currentImage.style.transform = transform;
            
            // Update cursor classes based on zoom state
            currentImage.classList.remove('zoomed', 'zoom-out');
            
            if (currentZoom > 1) {
                if (currentZoom >= 2) {
                    // At max zoom, show zoom-out cursor
                    currentImage.classList.add('zoom-out');
                } else {
                    // At medium zoom, show grab cursor for dragging
                    currentImage.classList.add('zoomed');
                }
            } else {
                // At normal zoom, show zoom-in cursor
                currentImage.classList.remove('zoomed', 'zoom-out');
            }
        }
        
        function updateZoomButtons() {
            const zoomInBtn = document.querySelector('.popup-zoom-btn[onclick="zoomIn()"]');
            const zoomOutBtn = document.querySelector('.popup-zoom-btn[onclick="zoomOut()"]');
            
            if (zoomInBtn) {
                zoomInBtn.disabled = currentZoom >= maxZoom;
            }
            if (zoomOutBtn) {
                zoomOutBtn.disabled = currentZoom <= minZoom;
            }
        }
        
        // Mouse wheel zoom
        function handleWheel(e) {
            if (imagePopup.style.display === 'flex') {
                e.preventDefault();
                if (e.deltaY < 0) {
                    zoomIn();
                } else {
                    zoomOut();
                }
            }
        }
        
        // Drag functionality for zoomed images
        function handleMouseDown(e) {
            if (currentZoom > 1) {
                isDragging = true;
                dragStartX = e.clientX - translateX;
                dragStartY = e.clientY - translateY;
                
                let currentImage;
                if (galleryImages.length === 1) {
                    currentImage = document.querySelector('.popup-carousel-item:nth-child(1) .popup-image');
                } else {
                    const carouselItemIndex = currentPopupIndex + 2;
                    currentImage = document.querySelector('.popup-carousel-item:nth-child(' + carouselItemIndex + ') .popup-image');
                }
                
                if (currentImage) {
                    currentImage.style.cursor = 'grabbing';
                }
            }
        }
        
        function handleMouseMove(e) {
            if (isDragging && currentZoom > 1) {
                translateX = e.clientX - dragStartX;
                translateY = e.clientY - dragStartY;
                updateZoom();
            }
        }
        
        function handleMouseUp() {
            isDragging = false;
            
            let currentImage;
            if (galleryImages.length === 1) {
                currentImage = document.querySelector('.popup-carousel-item:nth-child(1) .popup-image');
            } else {
                const carouselItemIndex = currentPopupIndex + 2;
                currentImage = document.querySelector('.popup-carousel-item:nth-child(' + carouselItemIndex + ') .popup-image');
            }
            
            if (currentImage) {
                if (currentZoom > 1) {
                    // Restore appropriate cursor based on zoom level
                    if (currentZoom >= 2) {
                        currentImage.style.cursor = 'zoom-out';
                    } else {
                        currentImage.style.cursor = 'grab';
                    }
                } else {
                    currentImage.style.cursor = 'zoom-in';
                }
            }
        }
        
        // Click to zoom functionality
        function clickToZoom(e) {
            if (e) {
                e.preventDefault();
                e.stopPropagation();
            }
            
            if (isDragging) {
                return; // Don't zoom if user was dragging
            }
            
            clickCount = (clickCount + 1) % zoomLevels.length;
            currentZoom = zoomLevels[clickCount];
            
            if (currentZoom === 1) {
                // Reset position when returning to normal zoom
                translateX = 0;
                translateY = 0;
            }
            
            updateZoom();
            updateZoomButtons();
        }

        // ===== RECENTLY VIEWED PRODUCTS SYSTEM =====
        class RecentlyViewedProducts {
            constructor() {
                this.storageKey = 'hanif_recently_viewed_products';
                this.maxProducts = 20;
                this.displayLimit = 12;
                this.currentProduct = {
                    id: {{ $product->id }},
                    name: '{{ $product->name }}',
                    slug: '{{ $product->slug }}',
                    price: {{ $product->price ?? 0 }},
                    show_price: {{ $product->show_price ? 'true' : 'false' }},
                    image: '{{ $product->image ? asset($product->image) : asset('default.jpg') }}',
                    images: @json($product->images->map(function($img) { return $img->image; })->toArray()),
                    category: '{{ $product->category->name ?? '' }}',
                    viewed_at: new Date().toISOString()
                };
                
                this.init();
            }

            init() {
                this.addProduct(this.currentProduct);
                this.loadRecentlyViewedProducts();
            }

            addProduct(product) {
                try {
                    let recentlyViewed = this.getRecentlyViewed();
                    recentlyViewed = recentlyViewed.filter(p => p.id !== product.id);
                    recentlyViewed.unshift(product);
                    
                    if (recentlyViewed.length > this.maxProducts) {
                        recentlyViewed = recentlyViewed.slice(0, this.maxProducts);
                    }
                    
                    
                    localStorage.setItem(this.storageKey, JSON.stringify(recentlyViewed));
                } catch (error) {
                    console.error('Error saving recently viewed product:', error);
                }
            }

            getRecentlyViewed() {
                try {
                    const stored = localStorage.getItem(this.storageKey);
                    return stored ? JSON.parse(stored) : [];
                } catch (error) {
                    console.error('Error reading recently viewed products:', error);
                    return [];
                }
            }

            async loadRecentlyViewedProducts() {
                const container = document.getElementById('recentlyViewedContainer');
                const dotsContainer = document.getElementById('recentlyViewedDots');
                
                if (!container) {
                    console.error('recentlyViewedContainer not found');
                    return;
                }

                try {
                    const recentlyViewed = this.getRecentlyViewed();
                    const productsToShow = recentlyViewed
                        .filter(product => product.id !== this.currentProduct.id)
                        .slice(0, this.displayLimit);

                    if (productsToShow.length === 0) {
                        this.showEmptyState(container);
                        return;
                    }

                    // Use partial via AJAX instead of generateProductHTML
                    let productHTML = '';
                    for (const product of productsToShow) {
                        try {
                            const response = await fetch('/api/render-product-card', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                },
                                body: JSON.stringify({ product: product })
                            });
                            
                            if (response.ok) {
                                const partialHTML = await response.text();
                                productHTML += `<div class="product-card-item" style="min-width: 280px; max-width: 280px; flex: 0 0 280px;">${partialHTML}</div>`;
                            } else {
                                throw new Error('Failed to render partial');
                            }
                        } catch (error) {
                            console.error('Error fetching partial for product:', product.id, error);
                            // Fallback to simple HTML if partial fails
                            productHTML += `<div class="product-card-item" style="min-width: 280px; max-width: 280px; flex: 0 0 280px;">
                                <div class="card addToCartProductDetailsTop h-100">
                                    <div class="card-img">
                                        <img src="${product.image}" class="img-fluid d-block" loading="lazy" alt="${product.name} image" width="400" height="400">
                                    </div>
                                    <div class="card-img-overlay pe-none">New</div>
                                    <div class="card-body text-center" style="background-color: #F6F4F2;">
                                        <h5 class="card-title">${product.name}</h5>
                                        <p class="card-text">
                                         ${product.show_price ? `PKR ${this.formatPrice(product.price)}` : ''}
                                        </p>
                                        <a href="/products/${product.slug}" class="btn text-white bg-black addToCartProductDetails">Discover More</a>
                    </div>
                                </div>
                            </div>`;
                        }
                    }
                    
                    container.innerHTML = productHTML;
                    
                    // Ensure proper layout
                    container.style.display = 'flex';
                    container.style.flexDirection = 'row';
                    container.style.flexWrap = 'nowrap';
                    container.style.gap = '1rem';
                    container.style.minWidth = 'max-content';
                    
                    this.generateCarouselDots(productsToShow.length, dotsContainer);
                    
                    // Initialize carousels after content is loaded
                    setTimeout(() => {
                        this.initializeRecentlyViewedCarousels();
                    }, 100);

                } catch (error) {
                    console.error('Error loading recently viewed products:', error);
                    this.showErrorState(container);
                }
            }

            showEmptyState(container) {
                container.innerHTML = `
                    <div class="product-card-item" style="min-width: 280px; max-width: 280px; flex: 0 0 280px;">
                        <div class="card text-center py-5" style="background-color: #F6F4F2; border: 2px dashed #dee2e6;">
                            <div class="card-body">
                                <i class="fas fa-eye-slash text-muted" style="font-size: 3rem;"></i>
                                <p class="mt-3 text-muted">No recently viewed products yet</p>
                                <p class="text-muted small">Products you view will appear here</p>
                    </div>
                </div>
            </div>
                `;
            }

            showErrorState(container) {
                container.innerHTML = `
                    <div class="product-card-item" style="min-width: 280px; max-width: 280px; flex: 0 0 280px;">
                        <div class="card text-center py-5" style="background-color: #F6F4F2; border: 2px dashed #dee2e6;">
                            <div class="card-body">
                                <i class="fas fa-exclamation-triangle text-warning" style="font-size: 3rem;"></i>
                                <p class="mt-3 text-muted">Error loading recently viewed products</p>
        </div>
                        </div>
                    </div>
                `;
            }

            generateCarouselDots(productCount, container) {
                const dotCount = Math.ceil(productCount / 4);
                const dotsHTML = Array.from({ length: dotCount }, (_, i) => `
                    <div class="recently-viewed-dot" onclick="goToRecentlyViewedSlide(${i})" 
                         style="width: 8px; height: 8px; border-radius: 50%; background: ${i === 0 ? '#000' : '#ccc'}; cursor: pointer; transition: background 0.3s ease;"></div>
                `).join('');
                
                container.innerHTML = dotsHTML;
            }

            formatPrice(price) {
                return new Intl.NumberFormat('en-US').format(price);
            }

            clearRecentlyViewed() {
                try {
                    localStorage.removeItem(this.storageKey);
                    this.loadRecentlyViewedProducts();
                } catch (error) {
                    console.error('Error clearing recently viewed products:', error);
                }
            }

            getRecentlyViewedCount() {
                return this.getRecentlyViewed().length;
            }

            initializeRecentlyViewedCarousels() {
                // Initialize Bootstrap carousels for recently viewed products
                const carousels = document.querySelectorAll('#recentlyViewedContainer .carousel');
                carousels.forEach(carousel => {
                    if (typeof bootstrap !== 'undefined') {
                        new bootstrap.Carousel(carousel, {
                            interval: false,
                            wrap: true,
                            keyboard: false
                        });
                    }
                });
                
                // Add event listeners to prevent conflicts
                document.querySelectorAll('#recentlyViewedContainer .carousel-control-prev, #recentlyViewedContainer .carousel-control-next').forEach(control => {
                    control.addEventListener('click', function(e) {
                        e.stopPropagation();
                    });
                });
                
                document.querySelectorAll('#recentlyViewedContainer .carousel-indicators button').forEach(indicator => {
                    indicator.addEventListener('click', function(e) {
                        e.stopPropagation();
                    });
                });
            }
        }

        // ===== EVENT LISTENERS =====
        // Initialize recently viewed products system
        const recentlyViewedSystem = new RecentlyViewedProducts();

        // Close popup with Escape key only
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && imagePopup.style.display === 'flex') {
                closeImagePopup();
            }
        });

        // Navigate with arrow keys
        document.addEventListener('keydown', function(e) {
            if (imagePopup.style.display === 'flex') {
                if (e.key === 'ArrowLeft') {
                    navigatePopup(-1);
                } else if (e.key === 'ArrowRight') {
                    navigatePopup(1);
                }
            }
        });

        // Initialize arrow visibility on page load
        document.addEventListener('DOMContentLoaded', function() {
            updateArrowVisibility();
            updateRecentlyViewedArrowVisibility();
            
            // Add zoom event listeners to document for carousel images
            document.addEventListener('wheel', function(e) {
                if (imagePopup.style.display === 'flex') {
                    let currentImage;
                    if (galleryImages && galleryImages.length === 1) {
                        currentImage = document.querySelector('.popup-carousel-item:nth-child(1) .popup-image');
                    } else {
                        const carouselItemIndex = currentPopupIndex + 2;
                        currentImage = document.querySelector('.popup-carousel-item:nth-child(' + carouselItemIndex + ') .popup-image');
                    }
                    if (currentImage && currentImage.contains(e.target)) {
                        handleWheel(e);
                    }
                }
            }, { passive: false });
            
            // Drag functionality for zoomed images
            document.addEventListener('mousedown', function(e) {
                if (imagePopup.style.display === 'flex') {
                    let currentImage;
                    if (galleryImages && galleryImages.length === 1) {
                        currentImage = document.querySelector('.popup-carousel-item:nth-child(1) .popup-image');
                    } else {
                        const carouselItemIndex = currentPopupIndex + 2;
                        currentImage = document.querySelector('.popup-carousel-item:nth-child(' + carouselItemIndex + ') .popup-image');
                    }
                    if (currentImage && currentImage.contains(e.target)) {
                        handleMouseDown(e);
                    }
                }
            });
            
            document.addEventListener('mousemove', handleMouseMove);
            document.addEventListener('mouseup', handleMouseUp);
            
            // Touch events for mobile
            document.addEventListener('touchstart', function(e) {
                if (imagePopup.style.display === 'flex') {
                    let currentImage;
                    if (galleryImages && galleryImages.length === 1) {
                        currentImage = document.querySelector('.popup-carousel-item:nth-child(1) .popup-image');
                    } else {
                        const carouselItemIndex = currentPopupIndex + 2;
                        currentImage = document.querySelector('.popup-carousel-item:nth-child(' + carouselItemIndex + ') .popup-image');
                    }
                    if (currentImage && currentImage.contains(e.target)) {
                        const touch = e.touches[0];
                        handleMouseDown({ clientX: touch.clientX, clientY: touch.clientY });
                    }
                }
            });
            
            document.addEventListener('touchmove', (e) => {
                if (isDragging) {
                    e.preventDefault();
                    const touch = e.touches[0];
                    handleMouseMove({ clientX: touch.clientX, clientY: touch.clientY });
                }
            }, { passive: false });
            
            document.addEventListener('touchend', handleMouseUp);
        });

        // Enable drag-to-scroll for YOU MAY ALSO LIKE carousel
        document.addEventListener('DOMContentLoaded', function() {
            const slider = document.getElementById('recommendedProducts');
            if (!slider) return;

            let isDown = false;
            let startX = 0;
            let scrollLeft = 0;
            let isDragging = false;

            // Debug: initial state
            (function debugInit() {
                const sectionDbg = slider.closest('section') || document;
                const dotsDbg = sectionDbg.querySelectorAll('.carousel-dot');
            })();

            function getNearestItemIndex() {
                const items = slider.querySelectorAll('.scroller-item, .product-card-item');
                const maxScroll = Math.max(0, slider.scrollWidth - slider.clientWidth);
                const lastScrollableIndex = Math.max(0, items.length - 1);
                const currentLeft = slider.scrollLeft;
                let nearestIndex = 0;
                let nearestDist = Infinity;
                items.forEach((el, i) => {
                    const itemLeft = slider.scrollLeft + (el.getBoundingClientRect().left - slider.getBoundingClientRect().left);
                    const dist = Math.abs(itemLeft - currentLeft);
                    if (dist < nearestDist) { nearestDist = dist; nearestIndex = i; }
                });
                return Math.min(nearestIndex, lastScrollableIndex);
            }

            function snapToNearest() {
                const items = slider.querySelectorAll('.scroller-item, .product-card-item');
                if (!items.length) return;
                const idx = getNearestItemIndex();
                const target = items[idx];
                if (target) {
                    const maxScroll = Math.max(0, slider.scrollWidth - slider.clientWidth);
                    const targetLeft = idx === 0
                        ? 0
                        : Math.min(maxScroll, slider.scrollLeft + (target.getBoundingClientRect().left - slider.getBoundingClientRect().left));
                    slider.scrollTo({ left: targetLeft, behavior: 'smooth' });
                }
                requestAnimationFrame(updateRecommendedDots);
            }

            // Mouse events
            slider.addEventListener('mousedown', (e) => {
                isDown = true;
                isDragging = false;
                slider.classList.add('is-grabbing');
                startX = e.pageX - slider.offsetLeft;
                scrollLeft = slider.scrollLeft;
            });

            slider.addEventListener('mouseleave', () => {
                isDown = false;
                slider.classList.remove('is-grabbing');
                // Snap to nearest on leave
                snapToNearest();
            });

            slider.addEventListener('mouseup', () => {
                isDown = false;
                slider.classList.remove('is-grabbing');
                setTimeout(() => { isDragging = false; }, 50);
                // Snap to nearest on mouse up
                snapToNearest();
            });

            slider.addEventListener('mousemove', (e) => {
                if (!isDown) return;
                e.preventDefault();
                const x = e.pageX - slider.offsetLeft;
                const walk = (x - startX);
                if (Math.abs(walk) > 3) isDragging = true;
                slider.scrollLeft = scrollLeft - walk;
                // Update dots during scroll for responsiveness
                requestAnimationFrame(updateRecommendedDots);
            });

            // Touch events
            slider.addEventListener('touchstart', (e) => {
                const t = e.touches[0];
                isDown = true;
                isDragging = false;
                startX = t.pageX - slider.offsetLeft;
                scrollLeft = slider.scrollLeft;
            }, { passive: true });

            slider.addEventListener('touchend', () => {
                isDown = false;
                setTimeout(() => { isDragging = false; }, 50);
            }, { passive: true });

            slider.addEventListener('touchmove', (e) => {
                if (!isDown) return;
                const t = e.touches[0];
                const x = t.pageX - slider.offsetLeft;
                const walk = (x - startX);
                if (Math.abs(walk) > 3) isDragging = true;
                slider.scrollLeft = scrollLeft - walk;
                requestAnimationFrame(updateRecommendedDots);
            }, { passive: false });

            // Prevent accidental clicks when dragging
            slider.querySelectorAll('a').forEach((anchor) => {
                anchor.addEventListener('click', (e) => {
                    if (isDragging) e.preventDefault();
                }, true);
            });

            // Also update dots on native scrolls (e.g., momentum)
            let scrollRAF = null;
            slider.addEventListener('scroll', () => {
                if (scrollRAF) cancelAnimationFrame(scrollRAF);
                scrollRAF = requestAnimationFrame(() => {
                    updateRecommendedDots();
                    scrollRAF = null;
                });
            });
            // Initialize dots to correct state
            requestAnimationFrame(updateRecommendedDots);

            // Bind dot clicks to navigate to specific product
            const section = slider.closest('section') || document;
            const dots = section.querySelectorAll('.carousel-dot');
            dots.forEach((dot, index) => {
                dot.addEventListener('click', (e) => {
                    e.preventDefault();
                    e.stopPropagation();
                    goToSlide(index);
                });
            });

            // Delegated click handler as fallback (in case direct binding misses)
            document.addEventListener('click', (e) => {
                const dotEl = e.target.closest('.carousel-dot');
                if (!dotEl) return;
                e.preventDefault();
                e.stopPropagation();
                const idxAttr = dotEl.getAttribute('data-index');
                const idx = idxAttr ? parseInt(idxAttr, 10) : Array.from(section.querySelectorAll('.carousel-dot')).indexOf(dotEl);
                if (idx >= 0) {
                    goToSlide(idx);
                }
            }, true);

            // Mobile: delegated touch handler to ensure dot taps trigger
            document.addEventListener('touchstart', (e) => {
                const dotEl = e.target.closest('.carousel-dot');
                if (!dotEl) return;
                e.preventDefault();
                e.stopPropagation();
                const idxAttr = dotEl.getAttribute('data-index');
                const idx = idxAttr ? parseInt(idxAttr, 10) : Array.from(section.querySelectorAll('.carousel-dot')).indexOf(dotEl);
                if (idx >= 0) {
                    goToSlide(idx);
                }
            }, { passive: false });
        });

        // Mobile Gallery Carousel Functionality
        document.addEventListener('DOMContentLoaded', function() {
            const mobileCarousel = document.getElementById('mobileProductCarousel');
            
            if (!mobileCarousel) return;

            // Convert to smooth scroll behavior
            const carouselInner = mobileCarousel.querySelector('.carousel-inner');
            const carouselItems = mobileCarousel.querySelectorAll('.carousel-item');
            const indicators = mobileCarousel.querySelectorAll('.carousel-indicators button');
            
            if (!carouselInner || carouselItems.length <= 1) return;

            // Remove Bootstrap carousel and make it scrollable
            carouselInner.style.display = 'flex';
            carouselInner.style.overflowX = 'auto';
            carouselInner.style.scrollSnapType = 'x mandatory';
            carouselInner.style.scrollBehavior = 'smooth';
            carouselInner.style.webkitOverflowScrolling = 'touch';
            carouselInner.style.scrollbarWidth = 'none';
            carouselInner.style.msOverflowStyle = 'none';
            carouselInner.style.gap = '0';
            carouselInner.style.width = '100%';
            carouselInner.style.minWidth = '100%';
            
            // Remove Bootstrap carousel classes that might interfere
            carouselInner.classList.add('mobile-carousel-scroll-track');
            carouselInner.classList.remove('carousel-inner');
            carouselItems.forEach(item => {
                item.classList.add('mobile-carousel-scroll-item');
                item.classList.remove('carousel-item', 'active');
            });

            // Hide scrollbar and add custom smooth scroll
            const scrollbarStyle = document.createElement('style');
            scrollbarStyle.textContent = `
                #mobileProductCarousel .mobile-carousel-scroll-track::-webkit-scrollbar {
                    display: none;
                }
                #mobileProductCarousel .mobile-carousel-scroll-track {
                    scroll-behavior: smooth;
                    overflow-x: auto;
                    -webkit-overflow-scrolling: touch;
                }
            `;
            document.head.appendChild(scrollbarStyle);

            // Make each item take full width and snap
            carouselItems.forEach((item, index) => {
                item.style.flex = '0 0 100%';
                item.style.scrollSnapAlign = 'start';
                item.style.width = '100%';
                item.style.minWidth = '100%';
                item.style.display = 'block';
                item.style.position = 'relative';
                item.style.left = '0';
                item.style.transform = 'none';
            });

            // Update indicators based on scroll position
            function updateIndicators() {
                const scrollLeft = carouselInner.scrollLeft;
                const itemWidth = carouselInner.offsetWidth;
                const currentIndex = Math.round(scrollLeft / itemWidth);
                
                indicators.forEach((indicator, index) => {
                    if (index === currentIndex) {
                        indicator.classList.add('active');
                    } else {
                        indicator.classList.remove('active');
                    }
                });
            }

            // Handle indicator clicks for smooth scroll
            indicators.forEach((indicator, index) => {
                // Disable Bootstrap carousel behavior to avoid conflicts
                indicator.removeAttribute('data-bs-target');
                indicator.removeAttribute('data-bs-slide-to');
                indicator.setAttribute('type', 'button');

                const handleActivate = (e) => {
                    if (e) { e.preventDefault(); e.stopPropagation(); }
                    const itemWidth = carouselInner.offsetWidth;
                    const targetScroll = index * itemWidth;
                    
                    const startScroll = carouselInner.scrollLeft;
                    const distance = targetScroll - startScroll;
                    const duration = 500; // 0.5s smooth scroll
                    const startTime = performance.now();
                    
                    function animateScroll(currentTime) {
                        const elapsed = currentTime - startTime;
                        const progress = Math.min(elapsed / duration, 1);
                        const easeInOutCubic = progress < 0.5 
                            ? 4 * progress * progress * progress 
                            : 1 - Math.pow(-2 * progress + 2, 3) / 2;
                        carouselInner.scrollLeft = startScroll + (distance * easeInOutCubic);
                        updateIndicators();
                        if (progress < 1) requestAnimationFrame(animateScroll);
                    }
                    requestAnimationFrame(animateScroll);
                };

                indicator.addEventListener('click', handleActivate, { passive: false });
                indicator.addEventListener('touchstart', handleActivate, { passive: false });
                indicator.addEventListener('pointerdown', handleActivate, { passive: false });
            });

            // Listen for scroll events
            carouselInner.addEventListener('scroll', updateIndicators);
            
            // Initialize first indicator as active
            updateIndicators();
        });

        // Mobile Scroller Functionality for YOU MAY ALSO LIKE
        document.addEventListener('DOMContentLoaded', function() {
            const mobileScroller = document.querySelector('.yml-mobile .mobile-product-scroller');
            const dotsContainer = document.querySelector('#ymlDesktop .scroller-dots .dots-container');
            
            if (!mobileScroller) return;
            if (!window.matchMedia('(max-width: 767.98px)').matches) return;

            mobileScroller.scrollLeft = 0;

            // Update dots based on scroll position
            function updateMobileDots() {
                const items = mobileScroller.querySelectorAll('.scroller-item');
                const maxScroll = Math.max(0, mobileScroller.scrollWidth - mobileScroller.clientWidth);
                const lastScrollableIndex = Math.max(0, items.length - 1);
                let currentIndex = 0;
                let best = Infinity;
                items.forEach((item, index) => {
                    const dist = Math.abs(item.offsetLeft - mobileScroller.scrollLeft);
                    if (dist < best) {
                        best = dist;
                        currentIndex = index;
                    }
                });
                currentIndex = Math.min(currentIndex, lastScrollableIndex);
                
                // Update all dots
                document.querySelectorAll('#ymlDesktop .scroller-dots .dot').forEach((dot, index) => {
                    const isAvailable = index <= lastScrollableIndex;
                    const isActive = isAvailable && index === currentIndex;
                    dot.hidden = !isAvailable;
                    dot.setAttribute('aria-hidden', isAvailable ? 'false' : 'true');
                    dot.classList.toggle('active', isActive);
                    dot.setAttribute('aria-current', isActive ? 'true' : 'false');
                    dot.style.backgroundColor = '';
                });
                
                // Scroll dots container to keep active dot visible
                const activeDot = document.querySelector('#ymlDesktop .scroller-dots .dot.active');
                if (activeDot && dotsContainer) {
                    const scrollPosition = activeDot.offsetLeft - (dotsContainer.clientWidth / 2) + (activeDot.offsetWidth / 2);
                    dotsContainer.scrollTo({ left: Math.max(0, scrollPosition), behavior: 'smooth' });
                }
            }

            // Listen for scroll events
            mobileScroller.addEventListener('scroll', updateMobileDots);
            
            // Initialize first dot as active
            function setInitialDot() {
                mobileScroller.scrollLeft = 0;
                updateMobileDots();
            }

            setInitialDot();
            requestAnimationFrame(setInitialDot);
            setTimeout(setInitialDot, 250);
            window.addEventListener('load', setInitialDot, { once: true });
        });

        // Mobile: initialize YOU MAY ALSO LIKE scroller
        document.addEventListener('DOMContentLoaded', function() {
            const section = document.querySelector('.yml-mobile');
            if (!section) return;
            const scroller = section.querySelector('.mobile-product-scroller');
            const container = section.querySelector('.scroller-container');
            const items = section.querySelectorAll('.scroller-item');
            const dots = section.querySelectorAll('.dot');
            if (!scroller || !container || !items.length || !dots.length) return;

            function nearestIndex() {
                const left = scroller.scrollLeft;
                let idx = 0; let best = Infinity;
                items.forEach((el, i) => {
                    const dist = Math.abs(el.offsetLeft - left);
                    if (dist < best) { best = dist; idx = i; }
                });
                return idx;
            }

            function updateDots() {
                const idx = nearestIndex();
                dots.forEach((d, i) => d.classList.toggle('active', i === idx));
            }

            function scrollToIndex(i) {
                const target = items[i];
                if (!target) return;
                scroller.scrollTo({ left: target.offsetLeft, behavior: 'smooth' });
                setTimeout(updateDots, 60);
            }

            dots.forEach((dot, i) => {
                dot.addEventListener('click', (e) => { e.preventDefault(); e.stopPropagation(); scrollToIndex(i); });
                dot.addEventListener('touchstart', (e) => { e.preventDefault(); e.stopPropagation(); scrollToIndex(i); }, { passive: false });
            });

            let raf = null; scroller.addEventListener('scroll', () => {
                if (raf) cancelAnimationFrame(raf);
                raf = requestAnimationFrame(() => { updateDots(); raf = null; });
            });

            updateDots();
        });

        // Mobile Touch/Swipe functionality for Popup Image Gallery
        document.addEventListener('DOMContentLoaded', function() {
            const imagePopup = document.getElementById('imagePopup');
            if (!imagePopup) return;

            let startX = 0;
            let startY = 0;
            let endX = 0;
            let endY = 0;
            let isSwiping = false;
            let hasMoved = false;

            // Touch start
            imagePopup.addEventListener('touchstart', function(e) {
                // Only handle touch events when popup is visible
                if (imagePopup.style.display !== 'flex') return;
                
                startX = e.touches[0].clientX;
                startY = e.touches[0].clientY;
                isSwiping = false;
                hasMoved = false;
            }, { passive: true });

            // Touch move
            imagePopup.addEventListener('touchmove', function(e) {
                if (!startX || !startY || imagePopup.style.display !== 'flex') return;
                
                endX = e.touches[0].clientX;
                endY = e.touches[0].clientY;
                
                const diffX = startX - endX;
                const diffY = startY - endY;
                
                // Check if it's a horizontal swipe (more horizontal than vertical)
                if (Math.abs(diffX) > Math.abs(diffY) && Math.abs(diffX) > 10) {
                    isSwiping = true;
                    hasMoved = true;
                    // Prevent default to avoid page scrolling
                    e.preventDefault();
                }
            }, { passive: false });

            // Touch end
            imagePopup.addEventListener('touchend', function(e) {
                if (!hasMoved || !startX || !endX || imagePopup.style.display !== 'flex') return;
                
                // Don't allow swipe navigation if there's only one image
                if (galleryImages && galleryImages.length <= 1) return;
                
                const diffX = startX - endX;
                const threshold = 30; // Minimum swipe distance
                
                if (Math.abs(diffX) > threshold && isSwiping) {
                    e.preventDefault();
                    e.stopPropagation();
                    
                    if (diffX > 0) {
                        // Swipe left - next image
                        navigatePopup(1);
                    } else {
                        // Swipe right - previous image
                        navigatePopup(-1);
                    }
                }
                
                // Reset
                startX = 0;
                startY = 0;
                endX = 0;
                endY = 0;
                isSwiping = false;
                hasMoved = false;
            }, { passive: false });
        });
    </script>
@endsection
