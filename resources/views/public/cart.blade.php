@extends('public.layouts.headerCheckout')

@section('content')
<style>
    /* Clean, Minimalist Design - Tiffany & Co. Style */
    body {
        background: #ffffff;
        color: #333333;
        font-family: 'Helvetica Neue', Arial, sans-serif;
    }
    
    .cart-header {
        background: #ffffff;
        color: #333333;
        padding: 4rem 0 3rem 0;
        text-align: center;
    }
    
    .cart-title {
    font-weight: 400;
    font-size: 1.3rem;
    text-align: center;
    margin: 0;
    line-height: 1.2;
    position: relative;
    display: inline-block;
    }
    
    .cart-title .item-count {
        font-weight: 200;
        font-size: 1.0rem;
        color: #333333;
        position: absolute;
        top: -0.4rem;
        right: -1.5rem;
        line-height: 1;
    }
    
.cart-container {
        background: #ffffff;
    min-height: 70vh;
        padding: 2rem 0 4rem 0;
    }
    
    .cart-content {
        max-width: 95%;
        margin: 0 auto;
    display: flex;
        gap: 5rem;
        padding: 0 2rem;
    }
    
    .cart-items-section {
        flex: 2;
    }
    
    .order-summary-section {
        flex: 1;
    }
    
    .cart-item {
    display: flex;
        gap: 2rem;
        padding: 2rem 0;
        border-bottom: 1px solid #e5e5e5;
}

.item-image {
        width: 200px;
        height: 200px;
    object-fit: cover;
        border-radius: 0;
}

.item-details {
    flex: 1;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}

    .item-brand {
        font-family: 'Times New Roman', serif;
        font-size: 1.5rem;
        font-weight: 400;
        color: #333333;
        margin-bottom: 0.5rem;
}

.item-name {
        font-size: 1rem;
        color: #666666;
        margin-bottom: 1rem;
        font-weight: 400;
    }
    
    .item-price {
        font-size: 1rem;
        color: #333333;
        font-weight: 400;
        margin-bottom: 1rem;
    }
    
    .quantity-section {
    display: flex;
    align-items: center;
        gap: 0.5rem;
        margin-bottom: 1rem;
        position: relative;
    }
    
    .quantity-label {
        font-size: 0.9rem;
        color: #333333;
        font-weight: 400;
    }
    
    .quantity-display {
    display: flex;
    align-items: center;
        gap: 0.25rem;
        cursor: pointer;
        padding: 0.25rem 0;
    }
    
    .quantity-value {
        font-size: 0.9rem;
        color: #333333;
        font-weight: 400;
    }
    
    .quantity-arrow {
        width: 12px;
        height: 12px;
        background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3e%3cpolyline points='18,15 12,9 6,15'%3e%3c/polyline%3e%3c/svg%3e");
        background-repeat: no-repeat;
        background-position: center;
        background-size: contain;
        transition: transform 0.2s;
    }
    
    .quantity-dropdown {
        position: absolute;
        top: 100%;
        left: 0;
        background: #ffffff;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        border-radius: 4px;
        z-index: 1000;
        min-width: 60px;
        max-height: 200px;
        overflow-y: auto;
        display: none;
    }
    
    .quantity-dropdown.show {
        display: block;
    }
    
    .quantity-option {
        padding: 0.5rem 1rem;
        cursor: pointer;
        font-size: 0.9rem;
        color: #333333;
        transition: background 0.2s;
    }
    
    .quantity-option:hover {
        background: #f8f8f8;
    }
    
    .quantity-option.selected {
        background: #f5f5dc;
        color: #333333;
    }
    
    .quantity-select {
        display: none;
    }
    
    .shipping-info {
        font-size: 0.9rem;
        color: #666666;
        margin-bottom: 1rem;
        font-weight: 400;
}

.item-actions {
    display: flex;
        gap: 2rem;
    }
    
    .action-link {
        color: #333333;
        text-decoration: underline;
        font-size: 0.9rem;
        font-weight: 400;
    cursor: pointer;
        transition: color 0.3s;
    }
    
    .action-link:hover {
        color: #666666;
        text-decoration: underline;
    }
    
    .order-summary-box {
        background: #f8f8f8;
        padding: 2rem;
        position: sticky;
        top: 2rem;
    }
    
    .summary-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
        padding: 0.75rem 0;
        font-size: 0.9rem;
        color: #666666;
    }
    
    .summary-row.shipping {
        color: #333333;
    }
    
    .summary-row.total {
        padding-top: 1rem;
        margin-top: 0.5rem;
        font-weight: 600;
        color: #333333;
        font-size: 1rem;
    }
    
    .checkout-button {
        background: #000000;
        color: #ffffff;
        border: none;
        padding: 1rem 2rem;
        width: 100%;
        font-size: 1rem;
        font-weight: 400;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-top: 1.5rem;
        cursor: pointer;
        transition: background 0.3s;
    }
    
    .checkout-button:hover {
        background: #333333;
    }
    
    .delivery-info {
        text-align: center;
        margin-top: 1rem;
        font-size: 0.9rem;
        color: #666666;
    }
    
.empty-cart {
    text-align: center;
        padding: 4rem 0;
    }
    
    .empty-cart h2 {
        font-size: 2rem;
        font-weight: 400;
        color: #333333;
        margin-bottom: 1rem;
}

.empty-cart p {
        color: #666666;
        font-size: 1rem;
        margin-bottom: 2rem;
}

.start-shopping-btn {
        background: #000000;
        color: #ffffff;
    text-decoration: none;
        padding: 1rem 2rem;
        font-size: 1rem;
        font-weight: 400;
        text-transform: uppercase;
        letter-spacing: 1px;
        display: inline-block;
        transition: background 0.3s;
}

.start-shopping-btn:hover {
        background: #333333;
        color: #ffffff;
        text-decoration: none;
    }
    
    /* Recommended Section Styles */
    .recommended-section {
        margin-top: 4rem;
        padding-top: 3rem;
    }
    
    .recommended-header {
        text-align: center;
        margin-bottom: 3rem;
    }
    
    .recommended-header h2 {
        font-size: 1.8rem;
        font-weight: 400;
        color: #333333;
    margin: 0;
        letter-spacing: 0.3px;
    }
    
    /* ===== CAROUSEL STYLING ===== */
    
    .carousel-indicators {
        z-index: 20 !important;
        pointer-events: auto !important;
        bottom: 10px !important;
    }
    
    
    /* Ensure carousel items are clickable */
    .carousel-item {
        pointer-events: auto !important;
    }
    
    /* Product card button styling */
    .addToCartProductDetails {
        position: relative;
        z-index: 15;
        pointer-events: auto !important;
    }
    
    /* ===== RECOMMENDED CAROUSEL STYLING ===== */
    #recommendedProducts {
        overflow-x: auto !important;
        scroll-behavior: smooth !important;
        -webkit-overflow-scrolling: touch !important;
    }
    
    #recommendedProducts .d-flex {
        display: flex !important;
        flex-direction: row !important;
        flex-wrap: nowrap !important;
        gap: 1rem !important;
        min-width: max-content !important;
    }
    
    .product-card-item {
        flex-shrink: 0 !important;
        min-width: 280px !important;
        max-width: 280px !important;
        flex: 0 0 280px !important;
    }
    
    /* Responsive Design */
    @media (max-width: 768px) {
        .cart-content {
            flex-direction: column;
            gap: 2rem;
        }
        
        .cart-item {
            flex-direction: column;
            gap: 1rem;
        }
        
        .item-image {
            width: 100px;
            height: 100px;
        }
        
        .order-summary-box {
            position: static;
        }
        
        .recommended-products {
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
            padding: 0 1rem;
        }
    }
</style>
@php
    $cartCount = 0;

    if (Auth::check()) {
        $cartCount = \App\Models\Cart::where('user_id', Auth::id())->sum('quantity');
    } else {
        $cartCount = \App\Models\Cart::where('session_id', session()->getId())->sum('quantity');
    }

    $total = 0;

    $makeImageUrl = function ($imagePath) {
        if (!$imagePath) {
            return asset('assets/f_assets/image/no-image.png');
        }

        $imagePath = trim($imagePath);
        $imagePath = ltrim($imagePath, '/');

        if (str_starts_with($imagePath, 'http://') || str_starts_with($imagePath, 'https://')) {
            return $imagePath;
        }

        if (
            str_starts_with($imagePath, 'storage/') ||
            str_starts_with($imagePath, 'assets/') ||
            str_starts_with($imagePath, 'uploads/')
        ) {
            return asset($imagePath);
        }

        return asset('storage/' . $imagePath);
    };
@endphp

<div class="cart-header">
    <div class="container" style="border-top: solid 1px #cdcdcd; border-bottom: solid 1px #cdcdcd; padding-top: 3rem; padding-bottom: 3rem;">
        <p class="cart-title">Shopping Cart <span class="item-count">({{ $cartCount }})</span></p>
    </div>
</div>

<div class="cart-container">
    <div class="">
        @if($cartItems->count() > 0)

            <div class="cart-content">

                <!-- Cart Items Section -->
                <div class="cart-items-section">

                    @foreach($cartItems as $item)

                        @php
                            $isSolitaire = (($item->cart_type ?? 'normal') === 'solitaire') || !empty($item->solitaire_product_id);

                            $cartProduct = $isSolitaire
                                ? $item->solitaireProduct
                                : $item->product;
                        @endphp

                        @continue(!$cartProduct)

                        @php
                            $forStore = false;
                            $usesWatchPricing = false;
                            if (!$isSolitaire && $item->product_id) {
                                $cartKey = $item->product_id . '_' . ($item->size ?: 'default');
                                $forStore = (bool) data_get(session('cart_store_context', []), $cartKey, false);
                            }

                            $productName = $isSolitaire
                                ? ($cartProduct->name ?? $cartProduct->title ?? 'Product')
                                : $cartProduct->displayName($forStore);

                            if ($isSolitaire) {
                                $imagePath = $item->selected_image ?? null;

                                if (
                                    !$imagePath
                                    || str_contains((string) $imagePath, 'no-image')
                                ) {
                                    $metalImageGroup = collect($cartProduct->metal_images ?? [])
                                        ->first(function ($group) use ($item) {
                                            $groupCode = is_array($group)
                                                ? ($group['metal_code'] ?? $group['code'] ?? null)
                                                : null;

                                            return $groupCode
                                                && strtolower(trim((string) $groupCode)) === strtolower(trim((string) $item->metal_code));
                                        });

                                    $imagePath = data_get($metalImageGroup, 'images.0.image_path')
                                        ?? data_get($metalImageGroup, 'images.0.image')
                                        ?? data_get($cartProduct->gallery_images, '0.image_path')
                                        ?? null;
                                }
                            } else {
                                $imagePath = $cartProduct->image ?? null;
                            }

                            $imageUrl = $makeImageUrl($imagePath);

                            if ($isSolitaire) {
                                $price = (float) ($item->variant_price ?? $cartProduct->price ?? 0);
                                $oldPrice = $item->old_price ?? null;
                                $discountText = $item->discount_percent ? $item->discount_percent . '% OFF' : '';
                                $hasDiscount = !empty($discountText);
                            } else {
                                $watchPriceBreakdown = $cartProduct->isWatchProduct()
                                    ? \App\Services\WatchPriceCalculator::calculateBreakdownForProduct($cartProduct)
                                    : null;
                                $usesWatchPricing = $watchPriceBreakdown !== null;
                                $basePrice = $usesWatchPricing
                                    ? (float) $watchPriceBreakdown['final_price']
                                    : (float) $cartProduct->displayPrice($forStore);
                                $price = $basePrice;
                                $hasDiscount = false;
                                $discountText = '';

                                if (!$usesWatchPricing && ($cartProduct->discount_type ?? null) == 2 && ($cartProduct->discount_percentage ?? 0) > 0) {
                                    $price = $basePrice - ($basePrice * $cartProduct->discount_percentage / 100);
                                    $hasDiscount = true;
                                    $discountText = $cartProduct->discount_percentage . '% OFF';
                                } elseif (!$usesWatchPricing && ($cartProduct->discount_type ?? null) == 3 && ($cartProduct->discounted_price ?? 0) > 0) {
                                    $price = $cartProduct->discounted_price;
                                    $hasDiscount = true;

                                    if ($basePrice > $cartProduct->discounted_price) {
                                        $discountText = 'PKR ' . number_format($basePrice - $cartProduct->discounted_price) . ' OFF';
                                    }
                                }
                            }

                            $price = max(0, $usesWatchPricing
                                ? round($price, -3)
                                : round($price));
                            $subtotal = $price * $item->quantity;
                            $total += $subtotal;
                        @endphp

                        <div class="cart-item" data-id="{{ $item->id }}">
                            <img src="{{ $imageUrl }}" alt="{{ $productName }}" class="item-image">

                            <div class="item-details">
                                <div>
                                    <div class="item-brand">Hanif</div>

                                    <div class="item-name">{{ $productName }}</div>

                                    <div class="item-price">
                                        PKR {{ number_format(round($price, -3)) }}
                                    </div>

                                    @if($isSolitaire)
                                        @if(!empty($item->metal_name))
                                            <div class="item-size" style="font-size: 0.9rem; color: #666666; margin-top: 0.5rem;">
                                                Metal: {{ $item->metal_name }}
                                            </div>
                                        @endif

                                        @if(!empty($item->diamond_carat))
                                            <div class="item-size" style="font-size: 0.9rem; color: #666666; margin-top: 0.3rem;">
                                                Diamond Carat: {{ $item->diamond_carat }}
                                            </div>
                                        @endif

                                        @if(!empty($item->solitaire_ring_size))
                                            <div class="item-size" style="font-size: 0.9rem; color: #666666; margin-top: 0.3rem; margin-bottom: 0.5rem;">
                                                Ring Size: {{ $item->solitaire_ring_size }}
                                            </div>
                                        @endif

                                        @if(!empty($item->inscription_text))
                                            <div class="item-size" style="font-size: 0.9rem; color: #666666; margin-top: 0.3rem; margin-bottom: 0.5rem;">
                                                Inscription: {{ $item->inscription_text }}
                                            </div>
                                        @endif
                                    @else
                                        @if(!empty($item->size))
                                            <div class="item-size" style="font-size: 0.9rem; color: #666666; margin-top: 0.5rem; margin-bottom: 0.5rem;">
                                                Size: {{ $item->size }}
                                            </div>
                                        @endif
                                    @endif

                                    <div class="quantity-section">
                                        <span class="quantity-label">Qty</span>

                                        <div class="quantity-display" onclick="toggleQuantityDropdown(this)">
                                            <span class="quantity-value">{{ $item->quantity }}</span>
                                            <span class="quantity-arrow"></span>
                                        </div>

                                        <div class="quantity-dropdown" id="quantity-dropdown-{{ $item->id }}">
                                            @for($i = 1; $i <= 10; $i++)
                                                <div class="quantity-option" data-value="{{ $i }}" onclick="updateQuantityDirect({{ $item->id }}, {{ $i }})">
                                                    {{ $i }}
                                                </div>
                                            @endfor
                                        </div>
                                    </div>

                                    <div class="shipping-info">Complimentary Standard 7-10 Business Days</div>
                                </div>

                                <div class="item-actions">
                                    <span class="action-link" onclick="removeItem({{ $item->id }})">Delete</span>
                                </div>
                            </div>
                        </div>

                    @endforeach

                </div>

                <!-- Order Summary Section -->
                <div class="order-summary-section">
                    <div class="order-summary-box">

                        <div class="summary-row">
                            <span>Subtotal</span>
                            <span>PKR {{ number_format(round($total, -3)) }}</span>
                        </div>

                        <div class="summary-row shipping">
                            <span>7-10 Business Days</span>
                            <span></span>
                        </div>

                        <div class="summary-row">
                            <span>Estimated Tax</span>
                            <span>-</span>
                        </div>

                        <div class="summary-row">
                            <span class="action-link">Taxes and other shipping methods</span>
                            <span></span>
                        </div>

                        <div class="summary-row total">
                            <span>Estimated Total</span>
                            <span>PKR {{ number_format(round($total, -3)) }}</span>
                        </div>

                        <div class="delivery-info">Complimentary Delivery & Returns</div>

                        <button class="checkout-button" onclick="window.location.href='{{ route('checkout') }}'">
                            Checkout
                        </button>

                    </div>
                </div>

            </div>

        @else

            <!-- Empty Cart State -->
            <div class="empty-cart">
                <h2>Your cart is empty</h2>
                <p>Looks like you haven't added any items to your cart yet.</p>
                <a href="{{ route('index') }}" class="start-shopping-btn">Start Shopping</a>
            </div>

        @endif

        <!-- Recommended for You Section -->
        @if($cartItems->count() > 0)

            <div class="recommended-section">
                <div class="recommended-header">
                    <h2>Recommended for You</h2>
                </div>

                <div class="position-relative">

                    <button class="btn btn-link position-absolute top-50 start-0 translate-middle-y text-dark p-0"
                            onclick="scrollRecommended('left')"
                            style="z-index: 10; left: -20px;">
                        <i class="fas fa-chevron-left" style="font-size: 24px;"></i>
                    </button>

                    <button class="btn btn-link position-absolute top-50 end-0 translate-middle-y text-dark p-0"
                            onclick="scrollRecommended('right')"
                            style="z-index: 10; right: -20px;">
                        <i class="fas fa-chevron-right" style="font-size: 24px;"></i>
                    </button>

                    <div class="products-carousel" id="recommendedProducts"
                         style="overflow-x: auto; scroll-behavior: smooth; -webkit-overflow-scrolling: touch;">

                        <div class="d-flex gap-3" style="min-width: max-content;">

                            @php
                                $recommendedProducts = \App\Models\Products::where('status', 'published')
                                    ->where('show_price', 1)
                                    ->whereHas('tags', function($q) {
                                        $q->where('name', 'Gold Ring');
                                    })
                                    ->with('category', 'subcategory', 'images', 'tags')
                                    ->inRandomOrder()
                                    ->take(12)
                                    ->get();
                            @endphp

                            @foreach($recommendedProducts as $index => $product)

                                @php
                                    $recommendedPrice = $product->price ?? 0;

                                    if (($product->discount_type ?? null) == 2 && ($product->discount_percentage ?? 0) > 0) {
                                        $recommendedPrice = $product->price - ($product->price * $product->discount_percentage / 100);
                                    } elseif (($product->discount_type ?? null) == 3 && ($product->discounted_price ?? 0) > 0) {
                                        $recommendedPrice = $product->discounted_price;
                                    }

                                    $recommendedPrice = max(0, $recommendedPrice);
                                @endphp

                                <div class="product-card-item" style="min-width: 280px; max-width: 280px; flex: 0 0 280px;">
                                    <div class="card addToCartProductDetailsTop">

                                        <div class="card-img">
                                            <div id="carouselRecommended{{ $product->slug }}" class="carousel slide">

                                                @if($product->images && $product->images->count() > 0)

                                                    <div class="carousel-indicators">
                                                        @foreach ($product->images as $imgIndex => $img)
                                                            <button type="button"
                                                                    data-bs-target="#carouselRecommended{{ $product->slug }}"
                                                                    data-bs-slide-to="{{ $imgIndex }}"
                                                                    class="{{ $imgIndex === 0 ? 'active bg-dark' : 'bg-dark' }}"
                                                                    @if($imgIndex === 0) aria-current="true" @endif
                                                                    aria-label="Slide {{ $imgIndex + 1 }}">
                                                            </button>
                                                        @endforeach
                                                    </div>

                                                    <div class="carousel-inner">
                                                        @foreach ($product->images as $imgIndex => $img)
                                                            <div class="carousel-item{{ $imgIndex === 0 ? ' active' : '' }}">
                                                                <img src="{{ asset($img->image) }}"
                                                                     class="img-fluid d-block"
                                                                     loading="lazy"
                                                                     alt="{{ $product->name }} image"
                                                                     width="400"
                                                                     height="400">
                                                            </div>
                                                        @endforeach
                                                    </div>

                                                @else

                                                    <div class="carousel-indicators">
                                                        <button type="button"
                                                                data-bs-target="#carouselRecommended{{ $product->slug }}"
                                                                data-bs-slide-to="0"
                                                                class="active bg-dark"
                                                                aria-label="Slide 1">
                                                        </button>
                                                    </div>

                                                    <div class="carousel-inner">
                                                        <div class="carousel-item active">
                                                            <img src="{{ asset($product->image) }}"
                                                                 class="img-fluid d-block"
                                                                 loading="lazy"
                                                                 alt="{{ $product->name }} image"
                                                                 width="400"
                                                                 height="400">
                                                        </div>
                                                    </div>

                                                @endif

                                                <button class="carousel-control-prev" type="button"
                                                        data-bs-target="#carouselRecommended{{ $product->slug }}"
                                                        data-bs-slide="prev">
                                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                    <span class="visually-hidden">Previous</span>
                                                </button>

                                                <button class="carousel-control-next" type="button"
                                                        data-bs-target="#carouselRecommended{{ $product->slug }}"
                                                        data-bs-slide="next">
                                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                    <span class="visually-hidden">Next</span>
                                                </button>

                                            </div>
                                        </div>

                                        <div class="card-img-overlay">New</div>

                                        <div class="card-body text-center" style="background-color: #F6F4F2;">
                                            <h5 class="card-title">{{ $product->name }}</h5>

                                            @if($product->show_price)
                                                @php
                                                    $livePrice = $product->final_price ?? $recommendedPrice ?? 0;
                                                    $roundedPrice = round($livePrice, -3);
                                                @endphp

                                                @if($roundedPrice > 0)
                                                    <p class="card-text">
                                                        PKR {{ number_format($roundedPrice, 0, '.', ',') }}
                                                    </p>
                                                @endif
                                            @endif

                                            <button class="btn text-white bg-black addToCartProductDetails"
                                                    onclick="addToCartFromRecommendation({{ $product->id }})">
                                                Add to Cart
                                            </button>
                                        </div>

                                    </div>
                                </div>

                            @endforeach

                        </div>
                    </div>

                    <div class="text-center mt-4">
                        <div class="d-flex justify-content-center gap-2">
                            @for($i = 0; $i < ceil($recommendedProducts->count() / 4); $i++)
                                <div class="carousel-dot"
                                     onclick="goToRecommendedSlide({{ $i }})"
                                     style="width: 8px; height: 8px; border-radius: 50%; background: {{ $i === 0 ? '#000' : '#ccc' }}; cursor: pointer; transition: background 0.3s ease;">
                                </div>
                            @endfor
                        </div>
                    </div>

                </div>
            </div>

        @endif

    </div>
</div>



<script>
function updateQuantityDirect(itemId, quantity) {
    const cartItem = document.querySelector(`.cart-item[data-id="${itemId}"]`);
    const quantityValue = cartItem.querySelector('.quantity-value');
    const dropdown = cartItem.querySelector('.quantity-dropdown');
    const arrow = cartItem.querySelector('.quantity-arrow');
    
    // Update the display
    quantityValue.textContent = quantity;
    
    // Update selected state in dropdown
    const options = dropdown.querySelectorAll('.quantity-option');
    options.forEach(option => {
        option.classList.remove('selected');
        if (parseInt(option.dataset.value) === parseInt(quantity)) {
            option.classList.add('selected');
        }
    });
    
    // Close dropdown
    dropdown.classList.remove('show');
    arrow.style.transform = 'rotate(0deg)';
    
    // Show loading state
    cartItem.style.opacity = '0.7';
    
    fetch("{{ route('cart.update') }}", {
        method: "POST",
        headers: {
            "X-CSRF-TOKEN": "{{ csrf_token() }}",
            "Content-Type": "application/json"
        },
        body: JSON.stringify({id: itemId, quantity: quantity})
    })
    .then(response => response.json())
    .then(data => {
        if(data.success){
            location.reload();
        } else {
            cartItem.style.opacity = '1';
        }
    })
    .catch(error => {
        console.error('Error:', error);
        cartItem.style.opacity = '1';
    });
}

function removeItem(itemId) {
    if(confirm('Are you sure you want to remove this item from your cart?')) {
        const cartItem = document.querySelector(`.cart-item[data-id="${itemId}"]`);
        cartItem.style.opacity = '0.5';
        
        const removeUrl = "{{ route('cart.remove', ['id' => '__ITEM_ID__']) }}".replace('__ITEM_ID__', itemId);
        fetch(removeUrl, {
                method: "DELETE",
                headers: {
                "X-CSRF-TOKEN": "{{ csrf_token() }}",
                "Accept": "application/json",
                "Content-Type": "application/json"
                }
            })
        .then(response => response.json())
        .then(data => {
            if(data.success){
                    location.reload();
                } else {
                    cartItem.style.opacity = '1';
                alert('Error removing item: ' + (data.message || 'Unknown error'));
                }
            })
            .catch(error => {
                console.error('Error:', error);
                cartItem.style.opacity = '1';
            alert('Error removing item. Please try again.');
        });
    }
}

// function editItem(itemId) {
//     // Redirect to product page for editing
//     const cartItem = document.querySelector(`.cart-item[data-id="${itemId}"]`);
//     // You can implement edit functionality here
//     console.log('Edit item:', itemId);
// }

// function saveForLater(itemId) {
//     // Implement save for later functionality
//     console.log('Save for later:', itemId);
//     alert('Save for later functionality will be implemented soon.');
// }

function toggleQuantityDropdown(element) {
    const dropdown = element.nextElementSibling;
    const arrow = element.querySelector('.quantity-arrow');
    
    // Close all other dropdowns first
    document.querySelectorAll('.quantity-dropdown').forEach(d => {
        if (d !== dropdown) {
            d.classList.remove('show');
        }
    });
    
    document.querySelectorAll('.quantity-arrow').forEach(a => {
        if (a !== arrow) {
            a.style.transform = 'rotate(0deg)';
        }
    });

    if (dropdown.classList.contains('show')) {
        dropdown.classList.remove('show');
        arrow.style.transform = 'rotate(0deg)';
    } else {
        dropdown.classList.add('show');
        arrow.style.transform = 'rotate(180deg)';
    }
}

// Close dropdowns when clicking outside
document.addEventListener('click', function(event) {
    if (!event.target.closest('.quantity-section')) {
        document.querySelectorAll('.quantity-dropdown').forEach(dropdown => {
            dropdown.classList.remove('show');
        });
        document.querySelectorAll('.quantity-arrow').forEach(arrow => {
            arrow.style.transform = 'rotate(0deg)';
        });
    }
});

// Initialize selected states on page load
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.quantity-option').forEach(option => {
        const itemId = option.closest('.cart-item').dataset.id;
        const currentQuantity = option.closest('.cart-item').querySelector('.quantity-value').textContent;
        if (parseInt(option.dataset.value) === parseInt(currentQuantity)) {
            option.classList.add('selected');
        }
    });
});

function addToCartFromRecommendation(productId) {
    const button = event.target;
    const originalText = button.textContent;
    
    // Show loading state
    button.textContent = 'Adding...';
    button.disabled = true;
    
    const formData = new FormData();
    formData.append('product_id', productId);
    formData.append('quantity', 1);
    formData.append('_token', '{{ csrf_token() }}');

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
            button.textContent = 'Added!';
            button.style.background = '#28a745';
            
            // Reload page after a short delay
        setTimeout(() => {
                location.reload();
            }, 1000);
        } else {
            button.textContent = 'Error';
            button.style.background = '#dc3545';
            
            setTimeout(() => {
                button.textContent = originalText;
                button.style.background = '#000000';
                button.disabled = false;
            }, 2000);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        button.textContent = 'Error';
        button.style.background = '#dc3545';
        
        setTimeout(() => {
            button.textContent = originalText;
            button.style.background = '#000000';
            button.disabled = false;
        }, 2000);
    });
}

// ===== RECOMMENDED CAROUSEL FUNCTIONS =====
function scrollRecommended(direction) {
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
        updateRecommendedArrowVisibility();
    }, 300);
}

function updateRecommendedArrowVisibility() {
    const container = document.getElementById('recommendedProducts');
    const leftArrow = document.querySelector('[onclick="scrollRecommended(\'left\')"]');
    const rightArrow = document.querySelector('[onclick="scrollRecommended(\'right\')"]');
    
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

function goToRecommendedSlide(slideIndex) {
    const container = document.getElementById('recommendedProducts');
    const containerWidth = container.clientWidth;
    container.scrollTo({ left: slideIndex * containerWidth, behavior: 'smooth' });
    
    // Update dots
    document.querySelectorAll('.carousel-dot').forEach((dot, index) => {
        dot.style.background = index === slideIndex ? '#000' : '#ccc';
    });
}

// Initialize recommended carousels on page load
document.addEventListener('DOMContentLoaded', function() {
    // Initialize Bootstrap carousels for recommended products
    const carousels = document.querySelectorAll('#recommendedProducts .carousel');
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
    document.querySelectorAll('#recommendedProducts .carousel-control-prev, #recommendedProducts .carousel-control-next').forEach(control => {
        control.addEventListener('click', function(e) {
            e.stopPropagation();
        });
    });
    
    document.querySelectorAll('#recommendedProducts .carousel-indicators button').forEach(indicator => {
        indicator.addEventListener('click', function(e) {
            e.stopPropagation();
        });
    });
    
    // Initialize arrow visibility
    updateRecommendedArrowVisibility();
});
</script>
@endsection
