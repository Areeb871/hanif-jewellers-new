@extends('public.layouts.headerCheckout')

@section('content')
<!-- Checkout Progress Indicator -->
<div class="checkout-progress">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="progress-container">
                    <div class="progress-steps">
                        <div class="step active" id="step1">
                            <span class="step-number">1</span>
                            <span class="step-label">Shipping</span>
                        </div>
                        <div class="step" id="step2">
                            <span class="step-number">2</span>
                            <span class="step-label">Payment</span>
                        </div>
                    </div>
                    <div class="progress-bar">
                        <div class="progress-fill" id="progressFill"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="checkout-container">
    <div class="container-fluid py-5">
        <div class="row">
            <!-- Left Column - Shipping & Payment Forms -->
            <div class="col-lg-8">
                <!-- Step 1: Shipping Details -->
                <div class="checkout-step" id="shippingStep">
                    <div class="shipping-section">
                        <h4 class="mb-4 fw-bold">Shipping Information</h4>
                        
                        <!-- Delivery Options -->
                        <div class="delivery-options mb-4">
                            <h5 class="mb-3 fw-bold">Delivery Options</h5>
                            <div class="form-check mb-3">
                                <input class="form-check-input" type="radio" name="deliveryOption" id="shipItems" value="ship" checked>
                                <label class="form-check-label fw-semibold" for="shipItems">
                                    Ship My Items
                                </label>
                            </div>
                        </div>

                        <!-- Shipping Address Form -->
                        <div class="shipping-address">
                            <h5 class="mb-3 fw-bold">Shipping Address</h5>
                            <form id="shippingForm">
                                <div class="row">
                                    <div class="col-12 mb-1">
                                        <div class="underline-field">
                                            <label class="field-label">Title (optional)</label>
                                            <div class="field-container">
                                                <select class="underline-input" id="title" name="title">
                                                    <option value="">Select Title</option>
                                                    <option value="Mr">Mr</option>
                                                    <option value="Mrs">Mrs</option>
                                                    <option value="Ms">Ms</option>
                                                    <option value="Dr">Dr</option>
                                                </select>
                                                <div class="dropdown-arrow">▼</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-1">
                                        <div class="underline-field">
                                            <label class="field-label">First Name</label>
                                            <input type="text" class="underline-input" id="firstName" name="firstName" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-1">
                                        <div class="underline-field">
                                            <label class="field-label">Last Name</label>
                                            <input type="text" class="underline-input" id="lastName" name="lastName" required>
                                        </div>
                                    </div>
                                    <div class="col-12 mb-1">
                                        <div class="underline-field">
                                            <label class="field-label">Email Address</label>
                                            <input type="email" class="underline-input" id="email" name="email" required>
                                        </div>
                                    </div>
     <div class="col-12 mb-1">
    <div class="underline-field">
        <label class="field-label">Phone Number</label>
        <input 
            type="tel" 
            class="underline-input" 
            id="phone" 
            name="phone" 
            placeholder=""
            maxlength="13"
            required
        >
        <small id="phoneError" style="color:red; display:none;">
            Please enter a valid number
        </small>
    </div>
</div>
                                    <div class="col-12 mb-1">
                                        <div class="underline-field">
                                            <label class="field-label">Address 1</label>
                                            <input type="text" class="underline-input" id="address1" name="address1" required>
                                        </div>
                                    </div>
                                    <div class="col-12 mb-1">
                                        <div class="underline-field">
                                            <label class="field-label">Address 2 (optional)</label>
                                            <input type="text" class="underline-input" id="address2" name="address2">
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-1">
                                        <div class="underline-field">
                                            <label class="field-label">Zip Code</label>
                                            <input type="text" class="underline-input" id="zipCode" name="zipCode" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-1">
                                        <div class="underline-field">
                                            <label class="field-label">City</label>
                                            <input type="text" class="underline-input" id="city" name="city" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-1">
                                        <div class="underline-field">
                                            <label class="field-label">State</label>
                                            <div class="field-container">
                                                <select class="underline-input" id="state" name="state" required>
                                                    <option value="">Select State</option>
                                                    <option value="Punjab">Punjab</option>
                                                    <option value="Sindh">Sindh</option>
                                                    <option value="Khyber Pakhtunkhwa">Khyber Pakhtunkhwa</option>
                                                    <option value="Balochistan">Balochistan</option>
                                                </select>
                                                <div class="dropdown-arrow">▼</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    
                    <div class="step-actions mt-4">
                        <button type="button" class="btn btn-dark px-5 py-3 fw-bold" onclick="nextStep()">
                            Continue to Payment <i class="fas fa-arrow-right ms-2"></i>
                        </button>
                    </div>
                </div>

                <!-- Step 2: Payment Details -->
                <div class="checkout-step" id="paymentStep" style="display: none;">
                    <div class="payment-section">
                        <h4 class="mb-4 fw-bold">Payment Information</h4>
                        
                        <div class="payment-method mb-4">
                            <h5 class="mb-3 fw-bold">Payment Gateway</h5>
                            <div class="payment-option">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="paymentMethod" id="bankAlfalah" value="bank_alfalah" checked>
                                    <label class="form-check-label fw-semibold" for="bankAlfalah">
                                        Pay Online with Bank Alfalah
                                    </label>
                                </div>
                                <p class="text-muted mt-2">You will be redirected to Bank Alfalah's secure payment page.</p>
                            </div>

                            <div id="alfalahTransactionOptions" class="mt-3">
                                <label for="transactionTypeId" class="form-label fw-semibold">Payment Type</label>
                                <select id="transactionTypeId" name="transactionTypeId" class="form-select">
                                    <option value="">Select payment type</option>
                                    <option value="1">Alfa Wallet</option>
                                    <option value="2">Alfalah Bank Account</option>
                                    <option value="3">Credit/Debit Card</option>



                                </select>
                            </div>
                        </div>

                        <!-- Payment Receipt Upload -->
                        <!-- <div class="payment-receipt mb-4">
                            <h5 class="mb-3 fw-bold">Upload Payment Receipt</h5>
                            <div class="receipt-upload-area">
                                <div class="upload-container" id="uploadContainer">
                                    <div class="upload-icon">
                                        <i class="fas fa-cloud-upload-alt"></i>
                                    </div>
                                    <h6 class="upload-title">Upload Payment Screenshot</h6>
                                    <p class="upload-description">Please upload a clear screenshot of your bank transfer receipt</p>
                                    <input type="file" id="paymentReceipt" name="paymentReceipt" accept="image/*" style="display: none;">
                                    <button type="button" class="btn btn-outline-dark" onclick="document.getElementById('paymentReceipt').click()">
                                        Choose File
                                    </button>
                                </div>
                                <div class="preview-container" id="previewContainer" style="display: none;">
                                    <img id="receiptPreview" src="" alt="Payment Receipt" class="receipt-preview">
                                    <button type="button" class="btn btn-sm btn-outline-danger mt-2" onclick="removeReceipt()">
                                        Remove
                                    </button>
                                </div>
                            </div>
                        </div> -->

                        <!-- Order Notes -->
                        <!-- <div class="order-notes mb-4">
                            <h5 class="mb-3 fw-bold">Additional Notes (Optional)</h5>
                            <div class="underline-field">
                                <textarea class="underline-input" id="orderNotes" name="orderNotes" rows="3" placeholder="Any special instructions or notes for your order..."></textarea>
                            </div>
                        </div> -->
                    </div>
                    
                    <div class="step-actions mt-4">
                        <button type="button" class="btn btn-outline-dark px-4 py-3 fw-bold me-3" onclick="previousStep()">
                            <i class="fas fa-arrow-left me-2"></i> Back to Shipping
                        </button>
                        <button type="button" class="btn btn-dark px-5 py-3 fw-bold" id="completeOrderButton" onclick="processCheckout()">
                            Complete Order <i class="fas fa-check ms-2"></i>
                        </button>
                    </div>
                </div>
            </div>
        <!-- Right Column - Order Summary -->
<div class="col-lg-4">

    @php
        $userId = Auth::check() ? Auth::id() : null;
        $sessionId = !$userId ? session()->getId() : null;

        $cartItems = \App\Models\Cart::with(['product.tags', 'solitaireProduct'])
            ->when($userId, function ($query) use ($userId) {
                return $query->where('user_id', $userId);
            })
            ->when($sessionId, function ($query) use ($sessionId) {
                return $query->where('session_id', $sessionId);
            })
            ->get();

        $calcNormalProductPrice = function ($product, bool $forStore = false) {
            if (!$product) {
                return 0;
            }

            $price = (float) $product->displayPrice($forStore);

            if ((int) ($product->discount_type ?? 0) === 2 && (float) ($product->discount_percentage ?? 0) > 0) {
                $price = $price - ($price * (float) $product->discount_percentage / 100);
            } elseif ((int) ($product->discount_type ?? 0) === 3 && (float) ($product->discounted_price ?? 0) > 0) {
                $price = (float) $product->discounted_price;
            }

            return max(0, round($price));
        };

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

        $subtotal = 0;

        foreach ($cartItems as $cartItem) {
            $isSolitaire = ($cartItem->cart_type ?? 'normal') === 'solitaire'
                || !empty($cartItem->solitaire_product_id);

            if ($isSolitaire) {
                $price = (float) ($cartItem->variant_price ?? 0);
            } else {
                $cartKey = $cartItem->product_id . '_' . ($cartItem->size ?: 'default');
                $forStore = (bool) data_get(session('cart_store_context', []), $cartKey, false);
                $price = (float) $calcNormalProductPrice($cartItem->product, $forStore);
            }

            $subtotal += $price * (int) $cartItem->quantity;
        }

        $shipping = 0;
        $total = $subtotal + $shipping;
        $asianRingSizes = range(4, 27);
    @endphp

    <div class="order-summary" id="checkoutOrderSummary" data-cart-count="{{ $cartItems->count() }}">
        <h5 class="mb-4 fw-bold">Order Summary</h5>
        @if($cartItems->count() > 0)

            @foreach($cartItems as $item)
                @php
                    $isSolitaire = ($item->cart_type ?? 'normal') === 'solitaire'
                        || !empty($item->solitaire_product_id);

                    /*
                    |--------------------------------------------------------------------------
                    | Product Relation
                    |--------------------------------------------------------------------------
                    */
                    $product = $isSolitaire
                        ? $item->solitaireProduct
                        : $item->product;

                    $requiresAsianRingSize = !$isSolitaire
                        && $product
                        && $product->requiresAsianRingSize();

                    $forStore = false;
                    if (!$isSolitaire && $item->product_id) {
                        $cartKey = $item->product_id . '_' . ($item->size ?: 'default');
                        $forStore = (bool) data_get(session('cart_store_context', []), $cartKey, false);
                    }

                    /*
                    |--------------------------------------------------------------------------
                    | Name
                    |--------------------------------------------------------------------------
                    */
                    $productName = $isSolitaire
                        ? ($product->name ?? $product->title ?? 'Product')
                        : ($product ? $product->displayName($forStore) : 'Product');

                    if (preg_match('/^(.*?)\s*-\s*([\p{L}\p{N}-]+)$/u', $productName, $nameParts)) {
                        $productName = \Illuminate\Support\Str::title(
                            \Illuminate\Support\Str::lower(trim($nameParts[1]))
                        ) . ' - ' . $nameParts[2];
                    } else {
                        $productName = \Illuminate\Support\Str::title(
                            \Illuminate\Support\Str::lower($productName)
                        );
                    }

                    /*
                    |--------------------------------------------------------------------------
                    | Image
                    |--------------------------------------------------------------------------
                    | Solitaire = selected metal image saved in cart
                    | Normal = product image
                    |--------------------------------------------------------------------------
                    */
                    if ($isSolitaire) {
                        $imagePath = $item->selected_image ?? null;

                        if (
                            !$imagePath
                            || str_contains((string) $imagePath, 'no-image')
                        ) {
                            $metalImageGroup = collect($product->metal_images ?? [])
                                ->first(function ($group) use ($item) {
                                    $groupCode = is_array($group)
                                        ? ($group['metal_code'] ?? $group['code'] ?? null)
                                        : null;

                                    return $groupCode
                                        && strtolower(trim((string) $groupCode)) === strtolower(trim((string) $item->metal_code));
                                });

                            $imagePath = data_get($metalImageGroup, 'images.0.image_path')
                                ?? data_get($metalImageGroup, 'images.0.image')
                                ?? data_get($product->gallery_images, '0.image_path')
                                ?? null;
                        }
                    } else {
                        $imagePath = $product->image ?? null;
                    }

                    $imageUrl = $makeImageUrl($imagePath);

                    /*
                    |--------------------------------------------------------------------------
                    | Price
                    |--------------------------------------------------------------------------
                    */
                    if ($isSolitaire) {
                        $price = (float) ($item->variant_price ?? 0);
                        $basePrice = (float) ($item->old_price ?? $price);
                        $discountPercent = $item->discount_percent ?? null;

                        $hasDiscount = $basePrice > $price;
                        $discountText = $discountPercent
                            ? $discountPercent . '% OFF'
                            : ($hasDiscount ? 'PKR ' . number_format(($basePrice - $price), 0, '.', ',') . ' OFF' : '');

                    } else {
                        $basePrice = (float) $product->displayPrice($forStore);
                        $price = (float) $calcNormalProductPrice($product, $forStore);

                        $hasDiscount = false;
                        $discountText = '';

                        if ($product) {
                            if ((int) ($product->discount_type ?? 0) === 2 && (float) ($product->discount_percentage ?? 0) > 0) {
                                $hasDiscount = true;
                                $discountText = $product->discount_percentage . '% OFF';
                            } elseif ((int) ($product->discount_type ?? 0) === 3 && (float) ($product->discounted_price ?? 0) > 0) {
                                $hasDiscount = true;
                                $diff = max(0, ($basePrice - $product->discounted_price));
                                $discountText = $diff > 0 ? 'PKR ' . number_format($diff, 0, '.', ',') . ' OFF' : '';
                            }
                        }
                    }

                    $showStrike = $hasDiscount && $basePrice > $price;
                    $itemSubtotal = $price * (int) $item->quantity;
                @endphp

                <div class="order-item mb-4" data-checkout-cart-item="{{ $item->id }}">
                    <div class="row align-items-center">
                        <div class="col-3">
                            <img src="{{ $imageUrl }}"
                                 alt="{{ $productName }}"
                                 class="img-fluid rounded product-image">
                        </div>

                        <div class="col-8">
                            <h6 class="mb-1 fw-semibold">{{ $productName }}</h6>

                            @if($isSolitaire)
                                @if($item->metal_name || $item->metal_code)
                                    <div class="item-size mb-1" style="font-size: 0.85rem; color: #666666;">
                                        Metal: {{ $item->metal_name ?? $item->metal_code }}
                                    </div>
                                @endif

                                @if($item->diamond_carat)
                                    <div class="item-size mb-1" style="font-size: 0.85rem; color: #666666;">
                                        Carat: {{ $item->diamond_carat }}
                                    </div>
                                @endif

                                @if($item->solitaire_ring_size)
                                    <div class="item-size mb-1" style="font-size: 0.85rem; color: #666666;">
                                        Ring Size: {{ $item->solitaire_ring_size }}
                                    </div>
                                @endif

                                @if($item->inscription_text)
                                    <div class="item-size mb-1" style="font-size: 0.85rem; color: #666666;">
                                        Inscription: {{ $item->inscription_text }}
                                    </div>
                                @endif
                            @else
                                @if($requiresAsianRingSize)
                                    <div class="checkout-ring-size mb-2">
                                        <label for="checkout-ring-size-{{ $item->id }}" class="checkout-ring-size-label">
                                            Asian Ring Size
                                        </label>
                                        <select id="checkout-ring-size-{{ $item->id }}"
                                                class="checkout-ring-size-select"
                                                data-cart-item-id="{{ $item->id }}"
                                                data-original-size="{{ $item->size }}"
                                                aria-label="Asian ring size for {{ $productName }}"
                                                required>
                                            <option value="" disabled @selected(!$item->size)>Select size</option>
                                            @foreach($asianRingSizes as $ringSize)
                                                <option value="{{ $ringSize }}" @selected((string) $item->size === (string) $ringSize)>
                                                    {{ $ringSize }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <small class="checkout-ring-size-status" aria-live="polite"></small>
                                    </div>
                                @elseif($item->size)
                                    <div class="item-size mb-1" style="font-size: 0.85rem; color: #666666;">
                                        Size: {{ $item->size ?? 'N/A' }}
                                    </div>
                                @endif
                            @endif

                            <div class="item-pricing mb-2">
                                @if($showStrike)
                                    <span class="original-price"
                                          style="text-decoration: line-through; color: #6c757d; font-size: 0.9rem; margin-right: 0.5rem;">
                                        PKR {{ number_format(round($basePrice, -3), 0, '.', ',') }}
                                    </span>
                                @endif

                                <span class="current-price fw-bold">
                                    PKR {{ number_format(round($price, -3), 0, '.', ',') }}
                                </span>

                                @if($hasDiscount && $discountText)
                                    <div class="discount-info">
                                        <small class="text-success">{{ $discountText }}</small>
                                    </div>
                                @endif
                            </div>

                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="text-muted">Quantity</span>
                                <span class="fw-bold checkout-item-subtotal">
                                    PKR {{ number_format(round($itemSubtotal, -3), 0, '.', ',') }}
                                </span>
                            </div>

                            <div class="checkout-item-actions"
                                data-cart-item-id="{{ $item->id }}"
                                data-unit-price="{{ $price }}">
                                <div class="checkout-quantity-control" role="group" aria-label="Quantity for {{ $productName }}">
                                    <button type="button"
                                            class="checkout-quantity-button"
                                            data-quantity-change="-1"
                                            aria-label="Decrease quantity"
                                            @disabled((int) $item->quantity <= 1)>
                                        &minus;
                                    </button>
                                    <span class="checkout-quantity-value" aria-live="polite">{{ $item->quantity }}</span>
                                    <button type="button"
                                        class="checkout-quantity-button"
                                        data-quantity-change="1"
                                        aria-label="Increase quantity">
                                        &plus;
                                    </button>
                                </div>
                                <button type="button" class="checkout-remove-item" aria-label="Remove {{ $productName }} from order">
                                    <i class="fas fa-trash-alt" aria-hidden="true"></i>
                                    <span>Remove</span>
                                </button>
                                <small class="checkout-item-action-status" aria-live="polite"></small>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

        @else
            <div class="text-center py-4">
                <p class="text-muted">Your cart is empty</p>
                <a href="{{ route('cart') }}" class="btn btn-outline-dark">Continue Shopping</a>
            </div>
        @endif

        @if($cartItems->count() > 0)
            <div id="checkoutTotalsSection">
            <hr class="my-4">

            <div class="order-totals">
                <div class="d-flex justify-content-between mb-2">
                    <span>Subtotal:</span>
                    <span class="fw-bold" id="checkoutSubtotalValue">
                        PKR {{ number_format(round($subtotal, -3), 0, '.', ',') }}
                    </span>
                </div>

                <!-- <div class="d-flex justify-content-between mb-2">
                    <span>Express Delivery with Signature:</span>
                    <span class="fw-bold" id="checkoutShippingValue" data-shipping="{{ $shipping }}">
                        PKR {{ number_format($shipping, 0, '.', ',') }}
                    </span>
                </div> -->

                <hr class="my-3">

                <div class="d-flex justify-content-between">
                    <span class="fw-bold">Total Amount:</span>
                    <span class="fw-bold fs-5" id="checkoutTotalValue">
                        PKR {{ number_format(round($total, -3), 0, '.', ',') }}
                    </span>
                </div>
            </div>
            </div>
        @endif
    </div>
</div>

       
<style>
/* Checkout Progress Indicator */
.checkout-progress {
    background-color: #ffffff;
    padding: 60px 0 20px 0;
    border-bottom: 1px solid #f0f0f0;
}

.progress-container {
    text-align: center;
}

.progress-steps {
    display: flex;
    justify-content: center;
    align-items: center;
    margin-bottom: 15px;
}

.step {
    display: flex;
    flex-direction: column;
    align-items: center;
    margin: 0 40px;
    position: relative;
}

.step-number {
    font-size: 16px;
    font-weight: 600;
    color: #333;
    margin-bottom: 5px;
}

.step-label {
    font-size: 14px;
    color: #333;
    font-weight: 500;
}

.step.active .step-number,
.step.active .step-label {
    color: #000;
    font-weight: 600;
}

.progress-bar {
    width: 100%;
    height: 2px;
    background-color: #d0d0d0;
    position: relative;
    max-width: 400px;
    margin: 0 auto;
}

.progress-fill {
    height: 100%;
    background-color: #000;
    width: 50%;
    transition: width 0.3s ease;
}

/* Reset and base styles */
* {
    box-sizing: border-box;
}

body {
    font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
    line-height: 1.6;
    color: #333;
}

.checkout-container {
    background-color: #ffffff;
    min-height: 100vh;
    padding: 40px 0;
}

.checkout-ring-size-label {
    display: block;
    margin-bottom: 0.3rem;
    color: #666;
    font-family: "Poppins", sans-serif !important;
    font-size: 0.75rem;
    font-weight: 500;
    letter-spacing: 0.04em;
}

.checkout-ring-size-select {
    width: 100%;
    max-width: 190px;
    padding: 0.4rem 0.55rem;
    border: 1px solid #d0d0d0;
    border-radius: 0;
    background: #fff;
    color: #222;
    font-family: "Poppins", sans-serif !important;
    font-size: 0.85rem;
}

.checkout-ring-size-select:focus {
    border-color: #222;
    outline: none;
    box-shadow: none;
}

.checkout-ring-size-status {
    display: block;
    min-height: 1rem;
    margin-top: 0.2rem;
    color: #666;
    font-size: 0.72rem;
}

/* Shipping Section Styling */
.shipping-section {
    background: #ffffff;
    padding: 30px;
    border-radius: 0;
    box-shadow: none;
    border: none;
}

.shipping-section h5 {
    color: #333;
    font-size: 18px;
    font-weight: 600;
    margin-bottom: 20px;
    text-transform: none;
    letter-spacing: normal;
}

/* Underline Field Styling - Minimalist Design */
.underline-field {
    position: relative;
    /* margin-bottom: 20px; */
}

.field-label {
    color: #999;
    font-size: 14px;
    font-weight: 400;
    margin-bottom: 8px;
    display: block;
    font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
}

.underline-input {
    width: 100%;
    border: none;
    border-bottom: 1px solid #d0d0d0;
    background: transparent;
    padding: 8px 0;
    font-size: 16px;
    color: #333;
    outline: none;
    transition: border-color 0.2s ease;
    font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
}

.underline-input:focus {
    border-bottom-color: #81d4fa;
    border-bottom-width: 2px;
}

.underline-input::placeholder {
    color: #999;
    font-size: 14px;
}

/* Dropdown styling */
.field-container {
    position: relative;
}

.dropdown-arrow {
    position: absolute;
    right: 0;
    top: 50%;
    transform: translateY(-50%);
    color: #333;
    font-size: 10px;
    pointer-events: none;
}

/* Remove default select styling */
.underline-input[type="select"] {
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    background: transparent;
}

/* Radio Buttons - Tiffany Style */
.form-check-input {
    width: 18px;
    height: 18px;
    border: 2px solid #d0d0d0;
    border-radius: 50%;
    margin-right: 10px;
    position: relative;
    top: 2px;
}

.form-check-input:checked {
    background-color: #81d4fa;
    border-color: #81d4fa;
}

.form-check-label {
    color: #333;
    font-size: 14px;
    font-weight: 500;
    cursor: pointer;
}

/* Payment Section Styling */
.payment-section {
    background: #ffffff;
    padding: 30px;
    border-radius: 0;
    box-shadow: none;
    border: none;
}

.payment-section h4 {
    color: #333;
    font-size: 18px;
    font-weight: 600;
    margin-bottom: 20px;
    text-transform: none;
    letter-spacing: normal;
}

.payment-method {
    margin-bottom: 25px;
}

.payment-option {
    border: 1px solid #e0e0e0;
    border-radius: 4px;
    padding: 20px;
    background-color: #f9f9f9;
}

.payment-option .form-check {
    margin-bottom: 10px;
}

.payment-option .form-check-label {
    color: #333;
    font-size: 16px;
    font-weight: 500;
}

.payment-option .text-muted {
    font-size: 14px;
    color: #666;
}

.bank-details {
    margin-top: 20px;
}

.bank-info-card {
    border: 1px solid #e0e0e0;
    border-radius: 4px;
    padding: 15px;
    background-color: #f9f9f9;
}

.bank-info-item {
    display: flex;
    justify-content: space-between;
    margin-bottom: 10px;
}

.bank-info-item .label {
    font-size: 14px;
    color: #666;
    font-weight: 400;
}

.bank-info-item .value {
    font-size: 14px;
    font-weight: 500;
    color: #333;
}

.payment-receipt {
    margin-top: 20px;
}

.receipt-upload-area {
    border: 1px dashed #d0d0d0;
    border-radius: 4px;
    padding: 20px;
    text-align: center;
    background-color: #f9f9f9;
    cursor: pointer;
    transition: border-color 0.2s ease;
}

.receipt-upload-area:hover {
    border-color: #81d4fa;
}

.upload-container {
    display: flex;
    flex-direction: column;
    align-items: center;
}

.upload-icon {
    font-size: 40px;
    color: #81d4fa;
    margin-bottom: 10px;
}

.upload-title {
    font-size: 18px;
    font-weight: 600;
    color: #333;
    margin-bottom: 5px;
}

.upload-description {
    font-size: 14px;
    color: #666;
    margin-bottom: 15px;
}

.preview-container {
    margin-top: 15px;
}

.receipt-preview {
    max-width: 100%;
    max-height: 200px;
    object-fit: contain;
    border: 1px solid #e0e0e0;
    border-radius: 4px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}

.order-notes {
    margin-top: 20px;
}

.order-notes .underline-field {
    margin-bottom: 0;
}

.order-notes .underline-input {
    min-height: 80px;
    resize: vertical;
}

/* Order Summary Styling */
.order-summary {
    background: #ffffff;
    padding: 30px;
    border-radius: 0;
    box-shadow: none;
    border: none;
}

/* Step Navigation Styling */
.checkout-step {
    background: #ffffff;
    border-radius: 0;
    box-shadow: none;
    border: none;
}

.step-actions {
    display: flex;
    justify-content: flex-end;
    gap: 15px;
    padding-top: 20px;
    /* border-top: 1px solid #f0f0f0; */
}

.step-actions .btn {
    min-width: 150px;
}

/* Progress Bar Animation */
.progress-fill {
    height: 100%;
    background-color: #000;
    width: 50%;
    transition: width 0.5s ease;
}

.progress-fill.active {
    width: 100%;
}

/* Step Active States */
.step.active .step-number {
    background-color: #000;
    color: #fff;
    border-radius: 50%;
    width: 30px;
    height: 30px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.step.active .step-label {
    color: #000;
    font-weight: 600;
}

.step.completed .step-number {
    background-color: #28a745;
    color: #fff;
    border-radius: 50%;
    width: 30px;
    height: 30px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.order-summary h5 {
    color: #333;
    font-size: 18px;
    font-weight: 600;
    margin-bottom: 25px;
    text-transform: none;
    letter-spacing: normal;
}

.order-item {
    padding: 15px;
    /* border: 1px solid #f0f0f0; */
    border-radius: 4px;
    /* background: #fafafa; */
    margin-bottom: 15px;
    max-height: 700px;
    overflow: hidden;
    transition: opacity 0.22s ease, transform 0.22s ease, max-height 0.28s ease, margin 0.28s ease, padding 0.28s ease;
}

.order-item.is-updating {
    opacity: 0.65;
}

.order-item.is-removing {
    max-height: 0;
    margin-top: 0 !important;
    margin-bottom: 0 !important;
    padding-top: 0;
    padding-bottom: 0;
    opacity: 0;
    transform: translateX(-16px);
}

.product-image {
    width: 70px;
    height: 70px;
    object-fit: cover;
    border-radius: 4px;
}

.order-item h6 {
    color: #333;
    font-size: 14px;
    font-weight: 500;
    margin-bottom: 8px;
}

.checkout-item-actions {
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    gap: 10px;
}

.checkout-quantity-control {
    display: inline-flex;
    align-items: center;
    height: 36px;
    border: 1px solid #d8d8d8;
    background: #fff;
}

.checkout-quantity-button {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 34px;
    height: 34px;
    padding: 0;
    border: 0;
    background: #fff;
    color: #17120f;
    font-size: 18px;
    line-height: 1;
    transition: background-color 0.2s ease, color 0.2s ease;
}

.checkout-quantity-button:hover:not(:disabled),
.checkout-quantity-button:focus-visible {
    background: #17120f;
    color: #fff;
    outline: none;
}

.checkout-quantity-button:disabled {
    color: #b9b9b9;
    cursor: not-allowed;
}

.checkout-item-actions.is-busy {
    pointer-events: none;
}

.checkout-quantity-value {
    min-width: 34px;
    color: #17120f;
    font-size: 13px;
    font-weight: 600;
    text-align: center;
}

.checkout-remove-item {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    min-height: 36px;
    padding: 0 4px;
    border: 0;
    border-bottom: 1px solid transparent;
    background: transparent;
    color: #777;
    font-size: 12px;
    transition: color 0.2s ease, border-color 0.2s ease;
}

.checkout-remove-item:hover,
.checkout-remove-item:focus-visible {
    border-bottom-color: #a12020;
    color: #a12020;
    outline: none;
}

.checkout-item-action-status {
    flex-basis: 100%;
    min-height: 18px;
    color: #666;
    font-size: 11px;
}

.checkout-total-flash {
    animation: checkout-total-flash 0.45s ease;
}

@keyframes checkout-total-flash {
    0% { color: #a98750; transform: translateY(-2px); }
    100% { color: inherit; transform: translateY(0); }
}

.order-totals {
    background: #fafafa;
    padding: 20px;
    border-radius: 4px;
}

.order-totals .d-flex {
    font-size: 14px;
    color: #333;
}

.order-totals .fw-bold {
    font-weight: 600;
}

.order-totals .fs-5 {
    font-size: 18px !important;
}

/* Gift Box Styling - Tiffany Blue */
.gift-box-container {
    position: relative;
    height: 300px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.gift-box-image {
    width: 200px;
    height: 200px;
    object-fit: cover;
    border-radius: 8px;
    box-shadow: 0 8px 30px rgba(0,0,0,0.15);
    transition: transform 0.3s ease;
    cursor: pointer;
}

.gift-box-image:hover {
    transform: scale(1.05);
}

.gift-box {
    position: relative;
    width: 180px;
    height: 180px;
    transition: transform 0.3s ease;
}

.box-body {
    width: 100%;
    height: 100%;
    background: linear-gradient(135deg, #81d4fa 0%, #4fc3f7 50%, #29b6f6 100%);
    border-radius: 6px;
    box-shadow: 0 6px 25px rgba(0,0,0,0.15);
}

.ribbon {
    position: absolute;
    top: -8px;
    left: 50%;
    transform: translateX(-50%);
    width: 100%;
    height: 35px;
}

.ribbon-bow {
    position: absolute;
    top: 0;
    left: 50%;
    transform: translateX(-50%);
    width: 50px;
    height: 35px;
}

.bow-left, .bow-right {
    position: absolute;
    width: 22px;
    height: 30px;
    background: #ffffff;
    border-radius: 50% 50% 0 0;
    top: 5px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.bow-left {
    left: 0;
    transform: rotate(-12deg);
}

.bow-right {
    right: 0;
    transform: rotate(12deg);
}

.bow-center {
    position: absolute;
    top: 12px;
    left: 50%;
    transform: translateX(-50%);
    width: 6px;
    height: 6px;
    background: #ffffff;
    border-radius: 50%;
    box-shadow: 0 1px 2px rgba(0,0,0,0.1);
}

.box-shadow {
    position: absolute;
    bottom: -15px;
    left: 50%;
    transform: translateX(-50%);
    width: 70%;
    height: 15px;
    background: rgba(0,0,0,0.08);
    border-radius: 50%;
    filter: blur(4px);
}

/* Button Styling - Tiffany Style */
.btn-dark {
    background-color: #333333;
    border-color: #333333;
    color: #ffffff;
    font-size: 16px;
    font-weight: 600;
    padding: 15px 30px;
    border-radius: 4px;
    transition: all 0.3s ease;
    text-transform: none;
    letter-spacing: normal;
}

.btn-dark:hover {
    background-color: #222222;
    border-color: #222222;
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
}

.btn-outline-dark {
    border-color: #333333;
    color: #333333;
    background-color: transparent;
    font-weight: 500;
    padding: 10px 20px;
    border-radius: 4px;
    transition: all 0.3s ease;
}

.btn-outline-dark:hover {
    background-color: #333333;
    border-color: #333333;
    color: #ffffff;
}

/* Horizontal Rules */
hr {
    border: none;
    border-top: 1px solid #e0e0e0;
    margin: 20px 0;
}

/* Responsive Design */
@media (max-width: 991.98px) {
    .gift-box-container {
        display: none;
    }
    
    .col-lg-5 {
        margin-bottom: 30px;
    }
    
    .shipping-section, .order-summary {
        padding: 25px;
    }
    
    /* Progress indicator responsive */
    .progress-steps {
        margin-bottom: 10px;
    }
    
    .step {
        margin: 0 20px;
    }
    
    .step-number {
        font-size: 14px;
    }
    
    .step-label {
        font-size: 12px;
    }
    
    .progress-bar {
        max-width: 300px;
    }
}

@media (max-width: 767.98px) {
    .checkout-container {
        padding: 20px 0;
    }
    
    .shipping-section, .order-summary {
        padding: 20px;
    }
    
    .gift-box {
        width: 140px;
        height: 140px;
    }
    
    .underline-input {
        font-size: 14px;
    }
    
    .field-label {
        font-size: 13px;
    }
    
    /* Progress indicator mobile */
    .progress-steps {
        margin-bottom: 8px;
    }
    
    .step {
        margin: 0 15px;
    }
    
    .step-number {
        font-size: 13px;
        margin-bottom: 3px;
    }
    
    .step-label {
        font-size: 11px;
    }
    
    .progress-bar {
        max-width: 250px;
        height: 1px;
    }
    
    .checkout-progress {
        padding: 20px 0 15px 0;
    }
}

/* Container adjustments */
.container-fluid {
    max-width: 1400px;
    margin: 0 auto;
    padding: 0 30px;
}

/* Error and Success Messages */
.error-message, .success-message {
    border-radius: 4px;
    padding: 12px 16px;
    margin-top: 16px;
    font-size: 14px;
    font-weight: 500;
    display: flex;
    align-items: center;
    gap: 8px;
    animation: slideIn 0.3s ease;
}

.error-message {
    background-color: #f8d7da;
    border: 1px solid #f5c6cb;
    color: #721c24;
}

.success-message {
    background-color: #d4edda;
    border: 1px solid #c3e6cb;
    color: #155724;
}

@keyframes slideIn {
    from {
        opacity: 0;
        transform: translateY(-10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@media (max-width: 768px) {
    .container-fluid {
        padding: 0 15px;
    }
}
</style>

<script>
let currentStep = 1;
let shippingData = {};
let leadTimer = null;
let lastLeadHash = null;

/* =========================
   LEAD / ABANDONED TRACKING
========================= */
function leadPayload(reason = 'typing') {
    return {
        step: currentStep,
        title: document.getElementById('title')?.value || '',
        firstName: document.getElementById('firstName')?.value || '',
        lastName: document.getElementById('lastName')?.value || '',
        email: document.getElementById('email')?.value || '',
        phone: document.getElementById('phone')?.value || '',
        address1: document.getElementById('address1')?.value || '',
        address2: document.getElementById('address2')?.value || '',
        zipCode: document.getElementById('zipCode')?.value || '',
        city: document.getElementById('city')?.value || '',
        state: document.getElementById('state')?.value || '',
        deliveryOption: document.querySelector('input[name="deliveryOption"]:checked')?.id || null,
        reason
    };
}

function simpleHash(obj) {
    const str = JSON.stringify(obj);
    let h = 0;
    for (let i = 0; i < str.length; i++) h = ((h << 5) - h) + str.charCodeAt(i) | 0;
    return String(h);
}

function saveLead(reason = 'typing') {
    const payload = leadPayload(reason);

    // Only save if user provided at least email or phone
    if (!payload.email && !payload.phone) return;

    // prevent too many duplicate saves
    const hash = simpleHash(payload);
    if (hash === lastLeadHash && reason !== 'heartbeat') return;
    lastLeadHash = hash;

    fetch("{{ route('checkout.lead.save') }}", {
        method: "POST",
        headers: {
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,
            "Accept": "application/json",
            "Content-Type": "application/json"
        },
        body: JSON.stringify(payload)
    }).catch(() => {});
}

function startLeadHeartbeat() {
    if (leadTimer) clearInterval(leadTimer);
    leadTimer = setInterval(() => saveLead('heartbeat'), 15000); // every 15 seconds
}

function sendExitBeacon() {
    const payload = leadPayload('exit');
    if (!payload.email && !payload.phone) return;

    const url = "{{ route('checkout.lead.exit') }}";
    const blob = new Blob([JSON.stringify(payload)], { type: 'application/json' });
    navigator.sendBeacon(url, blob);
}

/* =========================
   YOUR ORIGINAL FUNCTIONS
========================= */

function nextStep() {
    if (validateShippingForm()) {

        // Save lead snapshot when user reaches payment step
        saveLead('step_to_payment');

        // Store shipping data
        shippingData = {
            title: document.getElementById('title').value,
            firstName: document.getElementById('firstName').value,
            lastName: document.getElementById('lastName').value,
            email: document.getElementById('email').value,
            phone: document.getElementById('phone').value,
            address1: document.getElementById('address1').value,
            address2: document.getElementById('address2').value,
            zipCode: document.getElementById('zipCode').value,
            city: document.getElementById('city').value,
            state: document.getElementById('state').value,
            deliveryOption: document.querySelector('input[name="deliveryOption"]:checked').id
        };

        // Show payment step
        document.getElementById('shippingStep').style.display = 'none';
        document.getElementById('paymentStep').style.display = 'block';

        // Update progress
        currentStep = 2;
        updateProgress();

        // Update transfer amount
        const transferAmount = document.getElementById('transferAmount');
        if (transferAmount) {
            transferAmount.textContent = '{{ number_format($total, 2) }}';
        }
    }
}

function previousStep() {
    // Save lead snapshot when user goes back
    saveLead('back_to_shipping');

    // Show shipping step
    document.getElementById('paymentStep').style.display = 'none';
    document.getElementById('shippingStep').style.display = 'block';

    // Update progress
    currentStep = 1;
    updateProgress();
}

function updateProgress() {
    const step1 = document.getElementById('step1');
    const step2 = document.getElementById('step2');
    const progressFill = document.getElementById('progressFill');

    if (currentStep === 1) {
        step1.classList.add('active');
        step1.classList.remove('completed');
        step2.classList.remove('active', 'completed');
        progressFill.style.width = '50%';
        progressFill.classList.remove('active');
    } else {
        step1.classList.remove('active');
        step1.classList.add('completed');
        step2.classList.add('active');
        step2.classList.remove('completed');
        progressFill.style.width = '100%';
        progressFill.classList.add('active');
    }
}

function validateShippingForm() {
    const requiredFields = ['firstName', 'lastName', 'email', 'phone', 'address1', 'city', 'state', 'zipCode'];
    let isValid = true;
    let errorMessage = '';

    // Clear previous error styling
    document.querySelectorAll('.underline-input').forEach(input => {
        input.style.borderBottomColor = '#d0d0d0';
    });

    // Check required fields
    requiredFields.forEach(fieldName => {
        const field = document.getElementById(fieldName);
        const value = field.value.trim();

        if (!value) {
            field.style.borderBottomColor = '#dc3545';
            isValid = false;
            if (!errorMessage) {
                errorMessage = `Please fill in ${fieldName.replace(/([A-Z])/g, ' $1').toLowerCase()}`;
            }
        }
    });

    // Validate email format
    const email = document.getElementById('email').value.trim();
    if (email && !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
        document.getElementById('email').style.borderBottomColor = '#dc3545';
        isValid = false;
        if (!errorMessage) {
            errorMessage = 'Please enter a valid email address';
        }
    }

    // Validate phone format
    const phone = document.getElementById('phone').value.trim();
    const cleanPhone = phone.replace(/[^\d+]/g, '');
    if (phone && (cleanPhone.length < 7 || cleanPhone.length > 20)) {
        document.getElementById('phone').style.borderBottomColor = '#dc3545';
        isValid = false;
        if (!errorMessage) {
            errorMessage = 'Please enter a valid phone number (7-20 digits)';
        }
    }

    // Validate zip code format (your existing logic)
    const zipCode = document.getElementById('zipCode').value.trim();
    if (zipCode && !/^\d{5}(-\d{4})?$/.test(zipCode)) {
        document.getElementById('zipCode').style.borderBottomColor = '#dc3545';
        isValid = false;
        if (!errorMessage) {
            errorMessage = 'Please enter a valid zip code';
        }
    }

    if (!isValid) {
        showError(errorMessage);
        return false;
    }

    return true;
}

let checkoutSubmissionInProgress = false;
let checkoutSizeUpdatesPending = 0;
let checkoutItemUpdatesPending = 0;

document.querySelectorAll('.checkout-ring-size-select').forEach(select => {
    select.addEventListener('change', async function () {
        const previousSize = this.dataset.originalSize || '';
        const status = this.parentElement.querySelector('.checkout-ring-size-status');

        this.disabled = true;
        checkoutSizeUpdatesPending += 1;
        if (status) status.textContent = 'Saving size...';

        try {
            const response = await fetch("{{ route('cart.update') }}", {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    id: this.dataset.cartItemId,
                    size: this.value
                })
            });
            const data = await response.json();

            if (!response.ok || !data.success) {
                throw new Error(data.message || 'Could not save the selected size.');
            }

            this.dataset.originalSize = data.size;
            if (status) status.textContent = 'Size saved';
        } catch (error) {
            this.value = previousSize;
            if (status) status.textContent = error.message || 'Could not save size';
        } finally {
            this.disabled = false;
            checkoutSizeUpdatesPending = Math.max(0, checkoutSizeUpdatesPending - 1);
        }
    });
});

function setCheckoutItemControlsDisabled(actions, disabled) {
    const currentQuantity = Number(actions.querySelector('.checkout-quantity-value')?.textContent || 1);

    actions.classList.toggle('is-busy', disabled);
    actions.querySelectorAll('button').forEach(button => {
        const isDecreaseButton = button.dataset.quantityChange === '-1';
        button.disabled = disabled || (isDecreaseButton && currentQuantity <= 1);
    });
}

function formatCheckoutMoney(amount) {
    const roundedAmount = Math.round(Number(amount || 0) / 1000) * 1000;
    return `PKR ${roundedAmount.toLocaleString('en-US', { maximumFractionDigits: 0 })}`;
}

function flashCheckoutValue(element) {
    if (!element) return;

    element.classList.remove('checkout-total-flash');
    void element.offsetWidth;
    element.classList.add('checkout-total-flash');
}

function refreshCheckoutTotals() {
    let subtotal = 0;

    document.querySelectorAll('.checkout-item-actions').forEach(actions => {
        const unitPrice = Number(actions.dataset.unitPrice || 0);
        const quantity = Number(actions.querySelector('.checkout-quantity-value')?.textContent || 0);
        subtotal += unitPrice * quantity;
    });

    const subtotalElement = document.getElementById('checkoutSubtotalValue');
    const shippingElement = document.getElementById('checkoutShippingValue');
    const totalElement = document.getElementById('checkoutTotalValue');
    const shipping = Number(shippingElement?.dataset.shipping || 0);

    if (subtotalElement) subtotalElement.textContent = formatCheckoutMoney(subtotal);
    if (totalElement) totalElement.textContent = formatCheckoutMoney(subtotal + shipping);

    flashCheckoutValue(subtotalElement);
    flashCheckoutValue(totalElement);
}

function showCheckoutEmptyState() {
    const orderSummary = document.getElementById('checkoutOrderSummary');
    const totalsSection = document.getElementById('checkoutTotalsSection');
    const completeOrderButton = document.getElementById('completeOrderButton');

    totalsSection?.remove();
    if (orderSummary && !orderSummary.querySelector('.checkout-empty-state')) {
        orderSummary.insertAdjacentHTML('beforeend', `
            <div class="checkout-empty-state text-center py-4">
                <p class="text-muted">Your cart is empty</p>
                <a href="{{ route('cart') }}" class="btn btn-outline-dark">Continue Shopping</a>
            </div>
        `);
        orderSummary.dataset.cartCount = '0';
    }
    if (completeOrderButton) completeOrderButton.disabled = true;
}

document.querySelectorAll('.checkout-quantity-button').forEach(button => {
    button.addEventListener('click', async function () {
        const actions = this.closest('.checkout-item-actions');
        const quantityValue = actions?.querySelector('.checkout-quantity-value');
        const status = actions?.querySelector('.checkout-item-action-status');
        const cartItemId = actions?.dataset.cartItemId;
        const currentQuantity = Number(quantityValue?.textContent || 1);
        const quantityChange = Number(this.dataset.quantityChange || 0);
        const newQuantity = Math.max(1, currentQuantity + quantityChange);

        if (!actions || !cartItemId || newQuantity === currentQuantity) return;

        const orderItem = actions.closest('.order-item');
        setCheckoutItemControlsDisabled(actions, true);
        orderItem?.classList.add('is-updating');
        checkoutItemUpdatesPending += 1;
        if (status) status.textContent = 'Updating quantity...';

        try {
            const response = await fetch("{{ route('cart.update') }}", {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    id: cartItemId,
                    quantity: newQuantity
                })
            });
            const data = await response.json();

            if (!response.ok || !data.success) {
                throw new Error(data.message || 'Could not update the quantity.');
            }

            const savedQuantity = Number(data.quantity || newQuantity);
            if (quantityValue) quantityValue.textContent = savedQuantity;

            const itemSubtotal = orderItem?.querySelector('.checkout-item-subtotal');
            if (itemSubtotal) {
                itemSubtotal.textContent = formatCheckoutMoney(Number(actions.dataset.unitPrice || 0) * savedQuantity);
                flashCheckoutValue(itemSubtotal);
            }

            setCheckoutItemControlsDisabled(actions, false);
            refreshCheckoutTotals();
            if (status) status.textContent = 'Quantity updated';
            window.setTimeout(() => {
                if (status?.isConnected) status.textContent = '';
            }, 1200);
        } catch (error) {
            if (status) status.textContent = error.message || 'Could not update quantity';
            setCheckoutItemControlsDisabled(actions, false);
        } finally {
            orderItem?.classList.remove('is-updating');
            checkoutItemUpdatesPending = Math.max(0, checkoutItemUpdatesPending - 1);
        }
    });
});

document.querySelectorAll('.checkout-remove-item').forEach(button => {
    button.addEventListener('click', async function () {
        const actions = this.closest('.checkout-item-actions');
        const status = actions?.querySelector('.checkout-item-action-status');
        const cartItemId = actions?.dataset.cartItemId;

        if (!actions || !cartItemId) return;

        const orderItem = actions.closest('.order-item');
        setCheckoutItemControlsDisabled(actions, true);
        orderItem?.classList.add('is-updating');
        checkoutItemUpdatesPending += 1;
        if (status) status.textContent = 'Removing item...';

        try {
            const response = await fetch(`{{ url('/cart/remove') }}/${encodeURIComponent(cartItemId)}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'
                }
            });
            const data = await response.json();

            if (!response.ok || !data.success) {
                throw new Error(data.message || 'Could not remove the item.');
            }

            if (status) status.textContent = 'Item removed';
            orderItem?.classList.remove('is-updating');
            orderItem?.classList.add('is-removing');

            window.setTimeout(() => {
                orderItem?.remove();

                const orderSummary = document.getElementById('checkoutOrderSummary');
                const remainingItems = document.querySelectorAll('.order-item').length;
                if (orderSummary) orderSummary.dataset.cartCount = String(remainingItems);

                if (remainingItems === 0) {
                    showCheckoutEmptyState();
                } else {
                    refreshCheckoutTotals();
                }
            }, 280);
        } catch (error) {
            if (status) status.textContent = error.message || 'Could not remove item';
            setCheckoutItemControlsDisabled(actions, false);
            orderItem?.classList.remove('is-updating');
        } finally {
            checkoutItemUpdatesPending = Math.max(0, checkoutItemUpdatesPending - 1);
        }
    });
});

function processCheckout() {
    if (checkoutSubmissionInProgress) {
        return;
    }

    if (checkoutSizeUpdatesPending > 0 || checkoutItemUpdatesPending > 0) {
        alert('Please wait while your order summary is updated.');
        return;
    }

    const missingRingSize = Array.from(document.querySelectorAll('.checkout-ring-size-select'))
        .find(select => !select.value);
    if (missingRingSize) {
        missingRingSize.focus();
        alert('Please select an Asian ring size before completing your order.');
        return;
    }

    const form = document.getElementById('shippingForm');
    const completeOrderButton = document.getElementById('completeOrderButton');

    if (!form) {
        alert('Shipping form not found.');
        return;
    }

    const formData = new FormData(form);

    const deliveryOption = document.querySelector('input[name="deliveryOption"]:checked');
    if (deliveryOption) {
        formData.set('deliveryOption', deliveryOption.value || deliveryOption.id);
    }
    const paymentMethod = document.querySelector('input[name="paymentMethod"]:checked');
    if (!paymentMethod) {
        alert('Please select a payment method.');
        return;
    }

    formData.set('paymentMethod', paymentMethod.value);

    if (paymentMethod.value === 'bank_alfalah') {
        const transactionType = document.getElementById('transactionTypeId');

        if (!transactionType || !transactionType.value) {
            alert('Please select a Bank Alfalah payment type.');
            return;
        }

        formData.set('transactionTypeId', transactionType.value);
    }

    checkoutSubmissionInProgress = true;
    if (completeOrderButton) {
        completeOrderButton.disabled = true;
        completeOrderButton.textContent = 'Processing...';
    }

    fetch("{{ route('checkout.process') }}", {
        method: "POST",
        headers: {
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,
            "Accept": "application/json"
        },
        body: formData
    })
    .then(async response => {
        const data = await response.json();

        if (!response.ok) {
            throw data;
        }

        return data;
    })
    .then(data => {
        if (data.success) {
            window.location.href = data.redirect;
            return;
        }

        throw data;
    })
    .catch(error => {
        console.log('Checkout error:', error);

        checkoutSubmissionInProgress = false;
        if (completeOrderButton) {
            completeOrderButton.disabled = false;
            completeOrderButton.innerHTML = 'Complete Order <i class="fas fa-check ms-2"></i>';
        }

        if (error.errors) {
            alert(Object.values(error.errors).flat().join("\n"));
        } else {
            alert(error.message || 'Checkout failed.');
        }
    });
}

function showError(message) {
    const existingError = document.querySelector('.error-message');
    if (existingError) existingError.remove();

    const errorDiv = document.createElement('div');
    errorDiv.className = 'error-message alert alert-danger mt-3';
    errorDiv.innerHTML = `<i class="fas fa-exclamation-triangle"></i> ${message}`;

    const form = document.getElementById('shippingForm');
    form.parentNode.insertBefore(errorDiv, form.nextSibling);

    setTimeout(() => {
        if (errorDiv.parentNode) errorDiv.remove();
    }, 5000);
}

function showSuccess(message) {
    const existingMessage = document.querySelector('.success-message');
    if (existingMessage) existingMessage.remove();

    const successDiv = document.createElement('div');
    successDiv.className = 'success-message alert alert-success mt-3';
    successDiv.innerHTML = `<i class="fas fa-check-circle"></i> ${message}`;

    const form = document.getElementById('shippingForm');
    form.parentNode.insertBefore(successDiv, form.nextSibling);
}

/* =========================
   DOM READY (your existing + new)
========================= */
document.addEventListener('DOMContentLoaded', function() {
    const paymentMethods = document.querySelectorAll('input[name="paymentMethod"]');
    const alfalahTransactionOptions = document.getElementById('alfalahTransactionOptions');
    const transactionType = document.getElementById('transactionTypeId');
    const bankTransferDetails = document.getElementById('bankTransferDetails');

    const updatePaymentMethodFields = () => {
        const selectedMethod = document.querySelector('input[name="paymentMethod"]:checked')?.value;
        const isBankAlfalah = selectedMethod === 'bank_alfalah';

        if (alfalahTransactionOptions) {
            alfalahTransactionOptions.style.display = isBankAlfalah ? 'block' : 'none';
        }
        if (transactionType) {
            transactionType.required = isBankAlfalah;
        }
        if (bankTransferDetails) {
            bankTransferDetails.style.display = isBankAlfalah ? 'none' : 'block';
        }
    };

    paymentMethods.forEach(radio => {
        radio.addEventListener('change', updatePaymentMethodFields);
    });
    updatePaymentMethodFields();

    // gift box interactivity
    const giftBox = document.querySelector('.gift-box');
    if (giftBox) {
        giftBox.addEventListener('mouseenter', function() {
            this.style.transform = 'scale(1.05)';
        });

        giftBox.addEventListener('mouseleave', function() {
            this.style.transform = 'scale(1)';
        });
    }

    // input focus effects (your existing)
    const inputs = document.querySelectorAll('.underline-input');
    inputs.forEach(input => {
        input.addEventListener('focus', function() {
            this.parentElement.classList.add('focused');
        });

        input.addEventListener('blur', function() {
            if (!this.value) {
                this.parentElement.classList.remove('focused');
            }
        });

        // NEW: save lead on input + blur
        input.addEventListener('input', () => saveLead('typing'));
        input.addEventListener('blur',  () => saveLead('blur'));
    });

    // NEW: delivery option change tracking
    document.querySelectorAll('input[name="deliveryOption"]').forEach(radio => {
        radio.addEventListener('change', () => saveLead('delivery_change'));
    });

    // NEW: start heartbeat + exit tracking
    startLeadHeartbeat();
    window.addEventListener('pagehide', sendExitBeacon);
    window.addEventListener('beforeunload', sendExitBeacon);
});
</script>
<script>
const phoneInput = document.getElementById('phone');
const errorMsg = document.getElementById('phoneError');

phoneInput.addEventListener('input', function () {
    let value = this.value.replace(/\D/g, ''); // remove non-digits

    // Auto convert 03 → +92
    if (value.startsWith('03')) {
        value = '92' + value.substring(1);
    }

    // Auto convert 042 / 021 → +92
    if (value.startsWith('0') && !value.startsWith('03')) {
        value = '92' + value.substring(1);
    }

    // Add + sign
    if (value.startsWith('92')) {
        value = '+' + value;
    }

    this.value = value;

    // Validation
    const regex = /^(?:\+92)(?:3\d{9}|[1-9]\d{8,10})$/;

    if (!regex.test(this.value)) {
        errorMsg.style.display = 'block';
    } else {
        errorMsg.style.display = 'none';
    }
});
</script>
@endsection
