@php
    $carouselId = 'carouselOnline' . ($product->slug ?? 'item') . '_' . uniqid();
    $hasImages = isset($product->images) && count($product->images) > 0;
    $displayImage = $hasImages ? asset($product->images->first()->image) : ($product->image ? asset($product->image) : asset('default.jpg'));
@endphp
<style>
    /* Custom circular dots for product carousel */
    .product-carousel-dots {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 8px;
        padding: 10px 0;
        position: absolute;
        bottom: 10px;
        left: 50%;
        transform: translateX(-50%);
        z-index: 10;
        width: 100%;
    }
    .product-carousel-dot {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background-color: rgba(211, 211, 211, 0.6);
        cursor: pointer;
        transition: all 0.3s ease;
        border: none;
        padding: 0;
    }
    .product-carousel-dot:hover {
        background-color: rgba(153, 153, 153, 0.8);
        transform: scale(1.2);
    }
    .product-carousel-dot.active {
        background-color: #000;
        width: 8px;
        height: 8px;
        transform: scale(1.3);
    }
    /* Center Discover More button */
    .discover-more-btn {
        display: block !important;
        margin-left: auto !important;
        margin-right: auto !important;
        text-align: center !important;
        width: auto !important;
    }
    
    /* Mobile spacing for Discover More button */
    @media (max-width: 576px) {
        .addToCartProductDetailsTop .card-body {
            padding-bottom: 15px !important;
        }
        .discover-more-btn {
            display: block !important;
            margin-left: auto !important;
            margin-right: auto !important;
            text-align: center !important;
        }
    }
    
</style>
<div class="card addToCartProductDetailsTop h-100">
    <div class="card-img">
        <div id="{{ $carouselId }}" class="carousel slide position-relative" data-bs-touch="true">
            @if($hasImages)
                <div class="carousel-inner">
                    @foreach ($product->images as $imgIndex => $img)
                        <div class="carousel-item{{ $imgIndex === 0 ? ' active' : '' }}">
                            <a href="{{ route('product.details', $product->slug) }}" class="position-relative d-block" style="z-index:2;">
                                <img src="{{ asset($img->image) }}" class="img-fluid d-block" loading="lazy" alt="{{ $product->name }} image" width="400" height="400" style="pointer-events:auto;">
                            </a>
                        </div>
                    @endforeach
                </div>
                @if(count($product->images) > 1)
                    <button class="carousel-control-prev pe-none" type="button" data-bs-target="#{{ $carouselId }}" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next pe-none" type="button" data-bs-target="#{{ $carouselId }}" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                    {{-- Custom horizontal line dots --}}
                    <div class="product-carousel-dots" id="dots-{{ $carouselId }}">
                        @foreach ($product->images as $imgIndex => $img)
                            <button type="button"
                                    class="product-carousel-dot {{ $imgIndex === 0 ? 'active' : '' }}"
                                    data-slide-to="{{ $imgIndex }}"
                                    data-carousel-id="{{ $carouselId }}"
                                    @if($imgIndex === 0) aria-current="true" @endif
                                    aria-label="Slide {{ $imgIndex + 1 }}"></button>
                        @endforeach
                    </div>
                @endif
            @else
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <a href="{{ route('product.details', $product->slug) }}" class="position-relative d-block" style="z-index:2;">
                            <img src="{{ $displayImage }}" class="img-fluid d-block" loading="lazy" alt="{{ $product->name }} image" width="400" height="400" style="pointer-events:auto;">
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>
    <!-- <div class="card-img-overlay pe-none">New</div> -->
    <div class="card-body text-center" style="background-color: #F6F4F2;">
        <h5 class="card-title product-name-fixed pb-5 pb-md-0">
            @if(true)
                @php
                    $nameParts = explode('-', $product->name, 2);
                @endphp
                @if(count($nameParts) > 1)
                    {{ $nameParts[0] }}<br><small class="text-muted">{{ $nameParts[1] }}</small>
                @else
                    {{ $product->name }}
                @endif
            @else
                {{ $product->name }}
            @endif
        </h5>
        <p class="card-text">
@if(!empty($product->price) && $product->price > 0 && !empty($product->show_price))
    PKR {{ number_format($product->price, 0, '.', ',') }}
@endif
        </p>
        @if(!(request()->routeIs('qaws-al-matar') || request()->routeIs('qaws-al-matar-collection-page')))
            <a href="{{ route('product.details', $product->slug) }}" class="btn text-white bg-black addToCartProductDetails discover-more-btn">Discover More</a>
        @endif
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize touch/swipe functionality for product carousels
    const carousels = document.querySelectorAll('.carousel');
    
    carousels.forEach(function(carousel) {
        let startX = 0;
        let startY = 0;
        let endX = 0;
        let endY = 0;
        let isSwiping = false;
        let hasMoved = false;
        
        // Get carousel elements
        const carouselInner = carousel.querySelector('.carousel-inner');
        const carouselItems = carousel.querySelectorAll('.carousel-item');
        const carouselId = carousel.getAttribute('id');
        const dotsContainer = document.querySelector('#dots-' + carouselId);
        const dots = dotsContainer ? dotsContainer.querySelectorAll('.product-carousel-dot') : [];
        
        if (!carouselInner || carouselItems.length <= 1) return;
        
        let currentIndex = 0;
        
        // Bootstrap carousel instance for smooth animated transitions
        const bsInstance = (typeof bootstrap !== 'undefined' && bootstrap.Carousel)
            ? (bootstrap.Carousel.getInstance(carousel) || new bootstrap.Carousel(carousel, {
                interval: false,
                wrap: true,
                keyboard: false,
                touch: true,
                pause: false
            }))
            : null;
        
        // Function to update dots
        function updateDots(index) {
            dots.forEach((dot, i) => {
                if (i === index) {
                    dot.classList.add('active');
                    dot.setAttribute('aria-current', 'true');
                } else {
                    dot.classList.remove('active');
                    dot.setAttribute('aria-current', 'false');
                }
            });
        }
        
        // Function to go to specific slide
        function goToSlide(index) {
            if (index < 0 || index >= carouselItems.length) return;
            
            // Prefer Bootstrap's animated transition
            if (bsInstance) {
                try {
                    bsInstance.to(index);
                    currentIndex = index;
                    updateDots(index);
                    return;
                } catch (_) {}
            }
            
            // Fallback: manual class toggle
            carouselItems.forEach((item, i) => {
                item.classList.remove('active');
                if (i === index) {
                    item.classList.add('active');
                }
            });
            
            updateDots(index);
            currentIndex = index;
        }
        
        // Function to go to next slide
        function nextSlide() {
            const nextIndex = (currentIndex + 1) % carouselItems.length;
            if (bsInstance) {
                try {
                    bsInstance.next();
                    currentIndex = nextIndex;
                    updateDots(nextIndex);
                    return;
                } catch (_) {}
            }
            goToSlide(nextIndex);
        }
        
        // Function to go to previous slide
        function prevSlide() {
            const prevIndex = currentIndex === 0 ? carouselItems.length - 1 : currentIndex - 1;
            if (bsInstance) {
                try {
                    bsInstance.prev();
                    currentIndex = prevIndex;
                    updateDots(prevIndex);
                    return;
                } catch (_) {}
            }
            goToSlide(prevIndex);
        }
        
        // Listen to Bootstrap carousel events
        if (carousel) {
            carousel.addEventListener('slid.bs.carousel', function(e) {
                const activeIndex = Array.from(carouselItems).indexOf(e.relatedTarget);
                currentIndex = activeIndex;
                updateDots(activeIndex);
            });
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
        
        // Handle custom dot clicks
        dots.forEach((dot, index) => {
            dot.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                // Prefer Bootstrap's animated slide for parity with arrows
                if (bsInstance) {
                    try {
                        bsInstance.to(index);
                        currentIndex = index;
                        updateDots(index);
                        return;
                    } catch (err) {
                        // Fallback to manual if something goes wrong
                        goToSlide(index);
                        return;
                    }
                }
                // Fallback to manual class switch if Bootstrap not available
                goToSlide(index);
            });
        });
    });
});
</script>

