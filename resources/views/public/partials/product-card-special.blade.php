@php
    $carouselId = 'carouselOnline' . ($product->slug ?? 'item') . '_' . uniqid();
    $hasImages = isset($product->images) && count($product->images) > 0;
    $displayImage = $hasImages ? asset($product->images->first()->image) : ($product->image ? asset($product->image) : asset('default.jpg'));
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

</style>
<div class="card addToCartProductDetailsTop h-100">

    @php
        // ✅ Force routes by position in loop
        $forcedRoutes = [
            0 => 'collections/hasht', // first product
            1 => 'collections/qaws-al-matar',     // second product
            2 => 'collections/nagar', 
            3 => 'collections/gulposh', 
            4 => 'collections/tawoos', 
            5 => 'collections/gohar', 
            6 => 'collections/haphazard', 
        ];

        // ✅ One final href used everywhere
        $href = url($forcedRoutes[$loop->index] ?? 'collections/haphazard');
    @endphp

    <div class="card-img">
        @if($hasImages && count($product->images) > 1)
            <div id="{{ $carouselId }}" class="carousel slide position-relative" data-bs-touch="false">
                <div class="carousel-inner">
                    @foreach ($product->images as $imgIndex => $img)
                        <div class="carousel-item{{ $imgIndex === 0 ? ' active' : '' }}">
                            <a href="{{ $href }}" class="product-image-link">
                                <img src="{{ asset($img->image) }}" class="product-image" loading="lazy" alt="{{ $product->name }} image">
                            </a>
                        </div>
                    @endforeach
                </div>

                <ul class="swiper-pagination swiper-pagination-clickable swiper-pagination-bullets swiper-pagination-horizontal" id="indicator-container-{{ $carouselId }}">
                    @foreach ($product->images as $imgIndex => $img)
                        <li class="swiper-pagination-bullet {{ $imgIndex === 0 ? 'swiper-pagination-bullet-active' : '' }}"
                            data-position="{{ $imgIndex + 1 }}"
                            data-slide-index="{{ $imgIndex }}"
                            data-carousel-id="{{ $carouselId }}"
                            @if($imgIndex === 0) aria-current="true" @endif>
                            <button type="button">
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
                <a href="{{ $href }}" class="product-image-link">
                    <img
                        src="{{ $hasImages ? asset($product->images->first()->image) : $displayImage }}"
                        class="product-image"
                        loading="lazy"
                        alt="{{ $product->name }} image">
                </a>
            </div>
        @endif
    </div>

    <div class="card-body text-center {{ empty($product->price) || $product->price <= 0 || empty($product->show_price) ? 'no-price' : '' }}" style="background-color: #F6F4F2;">
        <h5 class="card-title product-name-fixed pb-5 pb-md-0">

            {{-- ✅ Hover image should NOT be a separate link; keep same forced href --}}
            <a href="{{ $href }}" class="product-image-link">
                @if($product->hover_image)
                    <img
                        src="{{ asset($product->hover_image) }}"
                        class="product-image hover-image"
                        loading="lazy"
                        alt="{{ $product->name }} hover image"
                        style="width:180px; height:150px; margin-bottom:-51px; margin-top:-44px;">
                @endif
            </a>

        </h5>
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