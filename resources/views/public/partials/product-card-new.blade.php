@php
    $carouselId = 'carouselOnline' . ($product->slug ?? 'item') . '_' . uniqid();
    $hasImages = isset($product->images) && count($product->images) > 0;
    $displayImage = $hasImages ? asset($product->images->first()->image) : ($product->image ? asset($product->image) : asset('default.jpg'));
    $storeContext = $storeContext ?? false;
    $cardName = $storeContext ? $product->storefrontName() : $product->name;
    $livePrice = $storeContext ? $product->storefront_price : ($product->final_price ?? 0);
    $detailUrl = $storeContext
        ? route('product.details', $product->slug) . '?store=1'
        : route('product.details', $product->slug);
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
    padding-bottom: 15px !important;
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
    
    /* Button spacing — transform/opacity only (same easing as image zoom) */
    .addToCartProductDetailsTop .card-body .discover-more-btn {
        margin-top: 0.5rem;
        backface-visibility: hidden;
        -webkit-backface-visibility: hidden;
        transform-origin: center center;
        will-change: transform, opacity;
    }

    .addToCartProductDetailsTop .card-body .addToCartProductDetails.discover-more-btn,
    .addToCartProductDetailsTop:hover .card-body .addToCartProductDetails.discover-more-btn,
    .addToCartProductDetailsTop .card-body .addToCartProductDetails.discover-more-btn:hover,
    .addToCartProductDetailsTop .card-body .addToCartProductDetails.discover-more-btn:focus,
    .addToCartProductDetailsTop .card-body .addToCartProductDetails.discover-more-btn:active {
        transform: none !important;
    }
    
    /* Consistent spacing for name and price */
    .addToCartProductDetailsTop .card-body .product-name-fixed {
        margin-bottom: 0.35rem;
    }
    .addToCartProductDetailsTop .card-body .card-text {
        margin-bottom: 0.35rem;
    }
    
    .addToCartProductDetailsTop .carousel .carousel-item img,
    .addToCartProductDetailsTop .product-image {
        transition: transform 0.5s ease;
        transform-origin: center center;
    }
    
    .addToCartProductDetailsTop:hover .carousel .carousel-item img,
    .addToCartProductDetailsTop:hover .product-image {
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
        /* Add padding-bottom to card-body so Discover More button doesn't touch card bottom */
        .addToCartProductDetailsTop .card-body {
            padding-bottom: 1.5rem !important;
        }
        
        .addToCartProductDetailsTop:hover .card-body .product-name-fixed {
            transform: translateY(0);
        }
        
        .addToCartProductDetailsTop:hover .card-body .card-text {
            transform: translateY(-2px);
        }
        
    }

    /* Online store: very subtle card depth */
    .onlineStore .addToCartProductDetailsTop {
        contain: layout style;
        box-shadow: 0 1px 5px rgba(0, 0, 0, 0.05);
    }

    /*
     * Online store: override global style.css (visibility:hidden + 1.2s fade)
     * so Discover More uses the same smooth transform as the product image.
     */
    @media (min-width: 768px) {
        .onlineStore .addToCartProductDetailsTop .card-body .addToCartProductDetails.discover-more-btn {
            visibility: visible !important;
            opacity: 0;
            pointer-events: none;
            transform: none;
            box-shadow: none !important;
            transition: opacity 0.5s ease !important;
        }

        .onlineStore .addToCartProductDetailsTop:hover .addToCartProductDetails.discover-more-btn,
        .onlineStore .addToCartProductDetailsTop:hover .card-body .discover-more-btn {
            visibility: visible !important;
            opacity: 1 !important;
            pointer-events: auto !important;
            transform: none !important;
            box-shadow: none !important;
            transition: opacity 0.5s ease !important;
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
        transition: transform 0.2s ease-in-out !important;
    }
    
    .addToCartProductDetailsTop .carousel-inner {
        transition: transform 0.2s ease-in-out !important;
    }
    
    .addToCartProductDetailsTop .carousel-item.active,
    .addToCartProductDetailsTop .carousel-item-next,
    .addToCartProductDetailsTop .carousel-item-prev {
        transition: transform 0.2s ease-in-out !important;
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
/* Mobile: keep dot area same as card color */
@media (max-width: 767.98px) {
    .addToCartProductDetailsTop {
        background-color: #F6F4F2 !important;
        overflow: hidden;
    }

    .addToCartProductDetailsTop .card-img .carousel-inner,
    .addToCartProductDetailsTop .card-img > .position-relative {
        width: 100%;
        aspect-ratio: 1 / 1;
        overflow: hidden;
    }

    .addToCartProductDetailsTop .card-img .carousel-item,
    .addToCartProductDetailsTop .card-img .carousel-item > a,
    .addToCartProductDetailsTop .card-img .product-image-link {
        width: 100%;
        height: 100% !important;
    }

    .addToCartProductDetailsTop .card-img img,
    .addToCartProductDetailsTop .card-img .product-image {
        width: 100% !important;
        height: 100% !important;
        max-width: 100% !important;
        max-height: 100% !important;
        object-fit: contain !important;
    }

    .addToCartProductDetailsTop .card-img {
        background-color: #F6F4F2 !important;
        margin-bottom: 0 !important;
        padding-bottom: 0 !important;
    }

    .addToCartProductDetailsTop .carousel,
    .addToCartProductDetailsTop .carousel-inner,
    .addToCartProductDetailsTop .carousel-item {
        background-color: #F6F4F2 !important;
    }

    .addToCartProductDetailsTop .swiper-pagination {
        position: static !important;
        left: auto !important;
        bottom: auto !important;
        transform: none !important;
        margin-top: 0 !important;
        margin-bottom: 0 !important;
        padding: 12px 0 12px 0 !important;
        background-color: #F6F4F2 !important;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .addToCartProductDetailsTop .card-body {
        background-color: #F6F4F2 !important;
        margin-top: 0 !important;
        padding-top: 18px !important;
    }
}
</style>
<div class="card addToCartProductDetailsTop h-100">
    <div class="card-img">
        @if($hasImages && count($product->images) > 1)
            <div id="{{ $carouselId }}" class="carousel slide position-relative" data-bs-touch="true">
                <div class="carousel-inner">
                    @foreach ($product->images as $imgIndex => $img)
                        <div class="carousel-item{{ $imgIndex === 0 ? ' active' : '' }}">
                            <a href="{{ $detailUrl }}" class="position-relative d-block" style="z-index:2;">
                                <img src="{{ asset($img->image) }}" class="img-fluid d-block" loading="lazy" alt="{{ $cardName }} image" width="400" height="400" style="pointer-events:auto;">
                            </a>
                        </div>
                    @endforeach
                </div>
                <ul class="swiper-pagination swiper-pagination-clickable swiper-pagination-bullets swiper-pagination-horizontal" data-next-slide-resource="Go to slide" id="indicator-container-{{ $carouselId }}">
                    @foreach ($product->images as $imgIndex => $img)
                        <li class="swiper-pagination-bullet {{ $imgIndex === 0 ? 'swiper-pagination-bullet-active' : '' }}" 
                            data-position="{{ $imgIndex + 1 }}"
                            data-slide-index="{{ $imgIndex }}"
                            data-carousel-id="{{ $carouselId }}"
                            @if($imgIndex === 0) aria-current="true" @endif>
                            <button>
                                <span class="sr-only">Go to slide {{ $imgIndex + 1 }}</span>
                            </button>
                        </li>
                    @endforeach
                </ul>
                <button class="carousel-control-prev pe-none" type="button" data-bs-target="#{{ $carouselId }}" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next pe-none" type="button" data-bs-target="#{{ $carouselId }}" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        @else
            <div class="position-relative d-block">
      <a href="{{ $detailUrl }}" class="product-image-link">
    <img
        src="{{ $hasImages ? asset($product->images->first()->image) : $displayImage }}"
        class="product-image"
        loading="lazy"
        alt="{{ $cardName }} image">
</a>
    </div>

        @endif
    </div>
    <!-- <div class="card-img-overlay pe-none">New</div> -->
    <div class="card-body text-center" style="background-color: #F6F4F2;">
          <h5 class="card-title product-name-fixed">
    @php
        $nameParts = explode('-', $cardName);
    @endphp

    {{ trim($nameParts[0]) }}
</h5>

        <!-- @if(!empty($product->price) && $product->price > 0 && !empty($product->show_price))
            <p class="card-text">
                PKR {{ number_format($product->price, 0, '.', ',') }}
            </p>
        @endif -->

<!-- Commented the price for data entry -->
 
 <!-- <p class="card-text">
@php
    $roundedPrice = round($livePrice, -3);
@endphp

@if($roundedPrice > 0)
    <p class="card-text">
        PKR {{ number_format($roundedPrice, 0, '.', ',') }}
    </p>
@endif

        </p>  -->
   

        @if(!(request()->routeIs('qaws-al-matar') || request()->routeIs('qaws-al-matar-collection-page')))
            <a href="{{ $detailUrl }}" class="btn text-white bg-black addToCartProductDetails discover-more-btn">Discover More</a>
        @endif
    </div>
</div>

<script>
(function() {
    function initProductCardCarousels(root = document) {
        // Initialize touch/swipe functionality for product carousels
        const carousels = root.querySelectorAll('.addToCartProductDetailsTop .carousel:not([data-carousel-initialized="1"])');
        
        carousels.forEach(function(carousel) {
            // Prevent double initialization when appending via AJAX
            carousel.setAttribute('data-carousel-initialized', '1');
            let startX = 0;
            let startY = 0;
            let endX = 0;
            let endY = 0;
            let isSwiping = false;
            let hasMoved = false;
            
            // Get carousel elements
            const carouselInner = carousel.querySelector('.carousel-inner');
            const carouselItems = carousel.querySelectorAll('.carousel-item');
            
            if (!carouselInner || carouselItems.length <= 1) return;
            
            let currentIndex = 0;
            
            // Bootstrap carousel instance for smooth animated transitions (no auto-play)
            const bsInstance = (typeof bootstrap !== 'undefined' && bootstrap.Carousel)
                ? (bootstrap.Carousel.getInstance(carousel) || new bootstrap.Carousel(carousel, {
                    interval: false, // No auto-play
                    wrap: true,
                    keyboard: false,
                    touch: true,
                    pause: false
                }))
                : null;
            
            // Get the Swiper-style pagination container and bullets for this carousel
            const indicatorContainer = document.getElementById('indicator-container-' + carousel.id);
            const indicatorBullets = indicatorContainer ? indicatorContainer.querySelectorAll('.swiper-pagination-bullet') : [];
            
            // Function to update pagination bullets based on active slide
            function updateIndicators(activeIndex) {
                if (indicatorBullets.length === 0) return;
                
                indicatorBullets.forEach((bullet, index) => {
                    if (index === activeIndex) {
                        bullet.classList.add('swiper-pagination-bullet-active');
                        bullet.setAttribute('aria-current', 'true');
                    } else {
                        bullet.classList.remove('swiper-pagination-bullet-active');
                        bullet.removeAttribute('aria-current');
                    }
                });
            }
            
            // Make pagination bullets clickable to jump to specific slides
            if (indicatorBullets.length > 0 && carouselItems.length > 1) {
                // Ensure we have the same number of bullets as carousel items
                if (indicatorBullets.length === carouselItems.length) {
                    indicatorBullets.forEach((bullet, index) => {
                        const button = bullet.querySelector('button');
                        if (button) {
                            button.addEventListener('click', function(e) {
                                e.preventDefault();
                                e.stopPropagation();
                                goToSlide(index);
                            });
                        }
                        // Also allow clicking on the bullet itself
                        bullet.addEventListener('click', function(e) {
                            if (e.target !== button && e.target.tagName !== 'BUTTON') {
                                e.preventDefault();
                                e.stopPropagation();
                                goToSlide(index);
                            }
                        });
                    });
                }
            }
            
            // Update indicators when carousel slides (via next/prev buttons or swipe)
            if (bsInstance && carouselItems.length > 1) {
                carousel.addEventListener('slid.bs.carousel', function (e) {
                    // Update current index based on the active slide
                    carouselItems.forEach((item, i) => {
                        if (item.classList.contains('active')) {
                            currentIndex = i;
                            updateIndicators(i);
                        }
                    });
                });
            }
            
            // Initialize indicators on page load - find the active slide
            if (indicatorBullets.length > 0 && carouselItems.length > 1) {
                // Find which slide is currently active
                let initialActiveIndex = 0;
                carouselItems.forEach((item, i) => {
                    if (item.classList.contains('active')) {
                        initialActiveIndex = i;
                    }
                });
                updateIndicators(initialActiveIndex);
                currentIndex = initialActiveIndex;
            }
            
            // Function to go to specific slide (optimized for speed)
            function goToSlide(index) {
                if (index < 0 || index >= carouselItems.length) return;
                
                // Prefer Bootstrap's animated transition (faster)
                if (bsInstance) {
                    try {
                        // Use requestAnimationFrame for smoother, faster transitions
                        requestAnimationFrame(() => {
                            bsInstance.to(index);
                            currentIndex = index;
                            updateIndicators(index);
                        });
                        return;
                    } catch (_) {}
                }
                
                // Fallback: manual class toggle (instant)
                carouselItems.forEach((item, i) => {
                    item.classList.remove('active');
                    if (i === index) {
                        item.classList.add('active');
                    }
                });
                
                currentIndex = index;
                updateIndicators(index);
            }
            
            // Function to go to next slide (optimized for speed)
            function nextSlide() {
                const nextIndex = (currentIndex + 1) % carouselItems.length;
                if (bsInstance) {
                    try {
                        // Use requestAnimationFrame for faster response
                        requestAnimationFrame(() => {
                            bsInstance.next();
                            currentIndex = nextIndex;
                            updateIndicators(nextIndex);
                        });
                        return;
                    } catch (_) {}
                }
                goToSlide(nextIndex);
            }
            
            // Function to go to previous slide (optimized for speed)
            function prevSlide() {
                const prevIndex = currentIndex === 0 ? carouselItems.length - 1 : currentIndex - 1;
                if (bsInstance) {
                    try {
                        // Use requestAnimationFrame for faster response
                        requestAnimationFrame(() => {
                            bsInstance.prev();
                            currentIndex = prevIndex;
                            updateIndicators(prevIndex);
                        });
                        return;
                    } catch (_) {}
                }
                goToSlide(prevIndex);
            }
            
            // Touch start
            carousel.addEventListener('touchstart', function(e) {
                startX = e.touches[0].clientX;
                startY = e.touches[0].clientY;
                isSwiping = false;
                hasMoved = false;
            }, { passive: true });
            
            // Touch move
            carousel.addEventListener('touchmove', function(e) {
                if (!startX || !startY) return;
                
                endX = e.touches[0].clientX;
                endY = e.touches[0].clientY;
                
                const diffX = startX - endX;
                const diffY = startY - endY;
                
                // Check if it's a horizontal swipe (more horizontal than vertical)
                if (Math.abs(diffX) > Math.abs(diffY) && Math.abs(diffX) > 10) {
                    isSwiping = true;
                    hasMoved = true;
                    // Prevent outer scrollers from hijacking horizontal swipe
                    e.stopPropagation();
                }
            }, { passive: true });
            
            // Touch end
            carousel.addEventListener('touchend', function(e) {
                if (!hasMoved || !startX || !endX) return;
                
                const diffX = startX - endX;
                const threshold = 30; // Reduced threshold for better responsiveness
                
                if (Math.abs(diffX) > threshold && isSwiping) {
                    // Keep the event within the carousel
                    e.stopPropagation();
                    if (diffX > 0) {
                        // Swipe left - next slide
                        nextSlide();
                    } else {
                        // Swipe right - previous slide
                        prevSlide();
                    }
                }
                
                // Reset
                startX = 0;
                startY = 0;
                endX = 0;
                endY = 0;
                isSwiping = false;
                hasMoved = false;
            }, { passive: true });
        });
        
    }

    // Expose so dynamically injected product cards can be initialized after AJAX renders
    window.initProductCardCarousels = initProductCardCarousels;

    // Initial bind for SSR render
    document.addEventListener('DOMContentLoaded', function() {
        initProductCardCarousels();
    });
})();
</script> 
