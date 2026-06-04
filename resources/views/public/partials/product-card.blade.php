@php
    // ✅ Unique carousel id (your old working way)
    $carouselId = 'carouselOnline' . ($product->slug ?? 'item') . '_' . uniqid();

    // ✅ Has gallery images?
    $hasImages   = isset($product->images) && $product->images->count() > 0;

    // ✅ Single image logic (NO storage:link)
    // Priority:
    // 1) product->images->first()->image (gallery)
    // 2) product->image (single column)
    // 3) default placeholder
    $singleImagePath =
        $hasImages ? ($product->images->first()->image ?? null)
        : (!empty($product->image) ? $product->image : null);

    $displayImage = $singleImagePath
        ? asset(ltrim($singleImagePath, '/'))
        : asset('assets/f_assets/image/no-image.png'); // your placeholder
@endphp
 <style>
    /*desktop 2000px*/
    @media (min-width: 1700px) and (max-width: 2200px) {
        .carousel-item img {
            margin-left: auto;
            margin-right: auto;
            display: block;
        }
    }
  /* MOBILE ONLY */
@media (max-width: 576px) {

    
/* Add little bit of space below Discover More button on mobile */
.addToCartProductDetailsTop .card-body {
      display: flex;
        flex-direction: column;
        align-items: center;
    padding-bottom: 15px !important;
}

/* Mobile: Reduce button spacing when price is not shown - no gap */
.addToCartProductDetailsTop .card-body.no-price .discover-more-btn {
    margin-top: 0 !important;
}

/* Mobile: Reduce product name bottom padding when no price */
.addToCartProductDetailsTop .card-body.no-price .product-name-fixed {
    padding-bottom: 0.5rem !important;
    margin-bottom: 0 !important;
}

/* Mobile: Reduce spacing when price is shown */
.addToCartProductDetailsTop .card-body .card-text + .discover-more-btn {
    margin-top: 0.5rem !important;
}

/* Mobile: NO spacing - price touches product name */
.addToCartProductDetailsTop .card-body:not(.no-price) .product-name-fixed {
    padding-bottom: 0 !important;
    margin-bottom: 0 !important;
    line-height: 1.2 !important;
}

/* Mobile: NO spacing - price touches product name directly */
.addToCartProductDetailsTop .card-body .card-text {
    margin-bottom: 0 !important;
    padding-bottom: 0 !important;
    margin-top: -10px !important;
    padding-top: 0 !important;
    line-height: 1.2 !important;
}

/* Mobile: Override Bootstrap pb-5 class completely */
.addToCartProductDetailsTop .card-body .product-name-fixed.pb-5 {
    padding-bottom: 0 !important;
}

/* Mobile: Remove any spacing from wrapper divs */
.addToCartProductDetailsTop .card-body > div {
    margin: 0 !important;
    padding: 0 !important;
}
}

    /* Product card image hover zoom - reduced zoom and prevent touching elements below */
    .addToCartProductDetailsTop .card-img {
        overflow: hidden;
        padding-bottom: 10px;
    }
    
    /* Prevent layout shift - maintain card height and smooth transitions */
    .addToCartProductDetailsTop {
        transform: translateZ(0);
        isolation: isolate;
        contain: layout style paint;
        will-change: transform;
    }
    
    .addToCartProductDetailsTop .card-body {
        min-height: fit-content;
    }
    
    /* Adjust button spacing - reduced when price is shown */
    .addToCartProductDetailsTop .card-body .discover-more-btn {
        margin-top: 0.5rem;
        opacity: 0.8;
        transition: transform 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94),
                    opacity 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94),
                    box-shadow 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        transform: translateY(2px);
        backface-visibility: hidden;
    }
    
    /* Show Discover More button prominently on hover - like Chopard */
    .addToCartProductDetailsTop:hover .card-body .discover-more-btn {
        opacity: 1;
        transform: translateY(0);
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
    }
    
    /* Less spacing when price is present */
    .addToCartProductDetailsTop .card-body .card-text + .discover-more-btn {
        margin-top: 0.5rem;
    }
    
    /* Reduce product name bottom padding when price is present - move price up */
    .addToCartProductDetailsTop .card-body:not(.no-price) .product-name-fixed {
        padding-bottom: 0.5rem !important;
        margin-bottom: 0 !important;
    }
    
    /* When price is not present, reduce button top margin - no gap */
    .addToCartProductDetailsTop .card-body.no-price .discover-more-btn {
        margin-top: 0 !important;
    }
    
    /* Reduce product name bottom padding when no price */
    .addToCartProductDetailsTop .card-body.no-price .product-name-fixed {
        padding-bottom: 0.5rem !important;
        margin-bottom: 0 !important;
    }
    
    /* Hide empty price element and remove spacing */
    .addToCartProductDetailsTop .card-text[style*="display: none"] {
        display: none !important;
        margin: 0 !important;
        padding: 0 !important;
        height: 0 !important;
        min-height: 0 !important;
        line-height: 0 !important;
    }
    
    .addToCartProductDetailsTop .card-text:empty {
        display: none !important;
        margin: 0 !important;
        padding: 0 !important;
        height: 0 !important;
        min-height: 0 !important;
    }
    
    /* Adjust button spacing when price is hidden */
    .addToCartProductDetailsTop .card-body .card-text[style*="display: none"] + .discover-more-btn,
    .addToCartProductDetailsTop .card-body .card-text:empty + .discover-more-btn {
        margin-top: 0.5rem !important;
    }
    
    .addToCartProductDetailsTop .carousel .carousel-item img {
        transition: transform 0.3s ease;
        transform-origin: center center;
    }
    
    .addToCartProductDetailsTop:hover .carousel .carousel-item img {
        transform: scale(1.05);
    }
    
    /* Smooth transitions - ONLY transforms, NO margin/padding changes to prevent shaking */
    .addToCartProductDetailsTop .card-body .product-name-fixed,
    .addToCartProductDetailsTop .card-body .card-text {
        transition: transform 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        backface-visibility: hidden;
        -webkit-backface-visibility: hidden;
    }
    
    /* Desktop: Use ONLY transforms on hover - NO margin/padding changes */
    @media (min-width: 768px) {
        .addToCartProductDetailsTop .carousel,
    .addToCartProductDetailsTop .carousel * {
        cursor: default !important;
    }
        /* Add padding-bottom to card-body so Discover More button doesn't touch card bottom */
        .addToCartProductDetailsTop .card-body {
            padding-bottom: 1.5rem !important;
        }
        
        /* Desktop: Reduce price element margin/padding for tighter spacing - move price up */
        .addToCartProductDetailsTop .card-body .card-text {
            margin-bottom: 0;
            padding-bottom: 0;
            margin-top: 0 !important;
        }
        
        .addToCartProductDetailsTop:hover .card-body .product-name-fixed {
            transform: translateY(0);
        }
        
        .addToCartProductDetailsTop:hover .card-body .card-text {
            transform: translateY(-2px);
        }
        
        .addToCartProductDetailsTop:hover .card-body .card-text + .discover-more-btn {
            transform: translateY(0) !important;
            opacity: 1 !important;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
        }
        
        /* When no price, adjust button on hover - ONLY transform */
        .addToCartProductDetailsTop:hover .card-body.no-price .discover-more-btn {
            transform: translateY(0) !important;
            opacity: 1 !important;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
        }
    }
    
    /* Swiper-style pagination container */
    .addToCartProductDetailsTop .swiper-pagination {
        position: absolute;
        bottom: 10px;
        left: 50%;
        transform: translateX(-50%);
        z-index: 10;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        padding: 5px 10px;
        list-style: none;
        margin: 0;
    }
    
    /* Individual pagination bullets */
    .addToCartProductDetailsTop .swiper-pagination-bullet {
        width: 6px;
        height: 6px;
        border-radius: 50%;
        background-color: rgba(0, 0, 0, 0.3);
        cursor: pointer;
        transition: all 0.3s ease;
        flex-shrink: 0;
        display: inline-block;
        position: relative;
        margin: 0;
        padding: 0;
        border: none;
    }
    
    .addToCartProductDetailsTop .swiper-pagination-bullet button {
        width: 100%;
        height: 100%;
        border: none;
        background: transparent;
        padding: 0;
        cursor: pointer;
        position: absolute;
        top: 0;
        left: 0;
    }
    
    .addToCartProductDetailsTop .swiper-pagination-bullet:hover {
        background-color: rgba(0, 0, 0, 0.5);
        transform: scale(1.2);
    }
    
    /* Active pagination bullet (the bar in the middle) */
    .addToCartProductDetailsTop .swiper-pagination-bullet-active {
        width: 60px;
        height: 4px;
        border-radius: 2px;
        background-color: rgba(0, 0, 0, 0.8);
        transform: scale(1);
    }
    
    /* Active bullet button width */
    .addToCartProductDetailsTop .swiper-pagination .swiper-pagination-bullet-active button {
        width: 60px;
    }
    
    /* Mobile: Position indicators below image and reduce active bar width */
    @media (max-width: 767.98px) {
        .addToCartProductDetailsTop .swiper-pagination {
            position: static !important;
            bottom: auto !important;
            transform: none !important;
            left: auto !important;
            margin-top: 10px;
            margin-bottom: 5px;
            padding: 0;
        }
        
        .addToCartProductDetailsTop .swiper-pagination-bullet-active {
            width: 40px;
            height: 3px;
        }
        
        .addToCartProductDetailsTop .swiper-pagination .swiper-pagination-bullet-active button {
            width: 40px;
        }
    }
    
    .addToCartProductDetailsTop .swiper-pagination-bullet .sr-only {
        position: absolute;
        width: 1px;
        height: 1px;
        padding: 0;
        margin: -1px;
        overflow: hidden;
        clip: rect(0, 0, 0, 0);
        white-space: nowrap;
        border-width: 0;
    }
    
    .addToCartProductDetailsTop .carousel-control-prev,
    .addToCartProductDetailsTop .carousel-control-next {
        z-index: 10;
    }
    
    /* Fast carousel transitions */
    .addToCartProductDetailsTop .carousel-item {
        transition: transform 0.6s cubic-bezier(0.22, 0.61, 0.36, 1) !important;
    will-change: transform;
    }
    
    .addToCartProductDetailsTop .carousel-inner {
         transition: transform 0.6s cubic-bezier(0.22, 0.61, 0.36, 1) !important;
    will-change: transform;
    }
    
    .addToCartProductDetailsTop .carousel-item.active,
    .addToCartProductDetailsTop .carousel-item-next,
    .addToCartProductDetailsTop .carousel-item-prev {
         transition: transform 0.6s cubic-bezier(0.22, 0.61, 0.36, 1) !important;
         will-change: transform;
    }
    .addToCartProductDetailsTop .carousel,
.addToCartProductDetailsTop .carousel *,
.addToCartProductDetailsTop .carousel-item,
.addToCartProductDetailsTop .carousel-item img {
    cursor: pointer !important;
}
.addToCartProductDetailsTop,
.addToCartProductDetailsTop * {
    cursor: pointer !important;
}
/* new */
.addToCartProductDetailsTop .swiper-pagination-bullet::after {
    content: "";
    position: absolute;
    top: -10px;
    bottom: -10px;
    left: -10px;
    right: -10px;
}
/* Card image area */
.card-img {
  display: flex;
  justify-content: center;
  align-items: center;
}

/* Make carousel behave like centered container too */
.card-img .carousel,
.card-img .carousel-inner,
.card-img .carousel-item {
  width: 100%;
}

/* Center image in each slide */
.card-img .carousel-item {
  text-align: center;
}

/* The link becomes a flex box to center image perfectly */
.product-image-link {
  display: flex;
  justify-content: center;
  align-items: center;
  width: 100%;
}

/* Image sizing + center */
.product-image {
  max-width: 100%;
  height: auto;
  display: block;
  margin: 0 auto;
  object-fit: contain;
}
.sale-badge{
    position:absolute;
    top:2px;
    left:0px;
    background:#c40000;
    color:#fff;
    font-size:13px;
    font-weight:600;
    padding:6px 12px;
    border-radius:4px;
    letter-spacing:0.5px;
    z-index:10;
    box-shadow:0 3px 8px rgba(0,0,0,0.2);
}

/* Tablet */
@media (max-width: 991px){
.sale-badge{
    top:10px;
    left:10px;
    font-size:8px;
    padding:5px 10px;
}
}

/* Mobile */
@media (max-width: 576px){
.sale-badge{
    top:0px;
    left:0px;
    font-size:8px;
    padding:2px 4px;
    border-radius:2px;
}
}
</style>
<div class="card addToCartProductDetailsTop h-100">
    <div class="card-img">
   <!--@if(in_array($product->id, [694,693,685,684,682,681]))-->
   <!-- <span class="sale-badge">Exclusive Offer-->
   <!-- </span>-->
   <!-- @endif-->

        @if($hasImages && $product->images->count() > 1)

            <div id="{{ $carouselId }}" class="carousel slide position-relative" data-bs-touch="false" data-bs-interval="false">
                <div class="carousel-inner">
                    @foreach ($product->images as $imgIndex => $img)
                        @php
                            $imgSrc = !empty($img->image)
                                ? asset(ltrim($img->image, '/'))
                                : $displayImage;
                        @endphp

                        <div class="carousel-item{{ $imgIndex === 0 ? ' active' : '' }}">
                            <a href="{{ route('product.details', $product->slug) }}" class="product-image-link">
                                <img src="{{ $imgSrc }}"
                                     class="product-image"
                                     loading="lazy"
                                     alt="{{ $product->name }} image"
                                     onerror="this.src='{{ asset('assets/f_assets/image/no-image.png') }}'">
                            </a>
                        </div>
                    @endforeach
                </div>

                <ul class="swiper-pagination swiper-pagination-clickable swiper-pagination-bullets swiper-pagination-horizontal"
                    id="indicator-container-{{ $carouselId }}">
                    @foreach ($product->images as $imgIndex => $img)
                        <li class="swiper-pagination-bullet {{ $imgIndex === 0 ? 'swiper-pagination-bullet-active' : '' }}"
                            data-slide-index="{{ $imgIndex }}"
                            data-carousel-id="{{ $carouselId }}"
                            @if($imgIndex === 0) aria-current="true" @endif>
                            <button type="button">
                                <span class="sr-only">Go to slide {{ $imgIndex + 1 }}</span>
                            </button>
                        </li>
                    @endforeach
                </ul>

                {{-- if you want buttons clickable, remove pe-none --}}
                <button class="carousel-control-prev" type="button" data-bs-target="#{{ $carouselId }}" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#{{ $carouselId }}" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>

        @else
            {{-- ✅ Single image / fallback --}}
            <div class="position-relative d-block">
                <a href="{{ route('product.details', $product->slug) }}" class="product-image-link">
                    <img src="{{ $displayImage }}"
                         class="product-image"
                         loading="lazy"
                         alt="{{ $product->name }} image"
                         onerror="this.src='{{ asset('assets/f_assets/image/no-image.png') }}'">
                </a>
            </div>
        @endif

    </div>

    @php
        $displayPrice = !empty($product->show_price) ? round($product->final_price ?? 0, -3) : 0;
    @endphp
    <div class="card-body text-center {{ $displayPrice <= 0 ? 'no-price' : '' }}"
         style="background-color: #F6F4F2;">

<h5 class="card-title product-name-fixed pb-5 pb-md-0">
    @php 
        $nameParts = explode('-', $product->name); 
    @endphp

    {{ trim($nameParts[0]) }}
</h5>

        @if($displayPrice > 0)
            <p class="card-text">PKR {{ number_format($displayPrice, 0, '.', ',') }}</p>
        @endif

        @if(!(request()->routeIs('qaws-al-matar') || request()->routeIs('qaws-al-matar-collection-page')))
            <a href="{{ route('product.details', $product->slug) }}"
               class="btn text-white bg-black addToCartProductDetails discover-more-btn">
                Discover More
            </a>
        @endif
    </div>
</div>
