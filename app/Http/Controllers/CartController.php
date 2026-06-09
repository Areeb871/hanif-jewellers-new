<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\CheckoutLead;
use App\Models\SolitaireProduct;


class CartController extends Controller
{
    // Show cart page
    public function index()
    {
        $userId = Auth::check() ? Auth::id() : null;
        $sessionId = !$userId ? session()->getId() : null;

        $cartItems = Cart::with('product','solitaireProduct')
            ->when($userId, function($query) use ($userId) {
                return $query->where('user_id', $userId);
            })
            ->when($sessionId, function($query) use ($sessionId) {
                return $query->where('session_id', $sessionId);
            })
            ->get();

        return view('public.cart', compact('cartItems'));
    }

    // Update cart quantities
    public function update(Request $request)
    {
        $userId = \Auth::check() ? \Auth::id() : null;
        $sessionId = !$userId ? session()->getId() : null;
        $id = $request->input('id');
        $qty = $request->input('quantity');

        $cartItem = \App\Models\Cart::where('id', $id)
            ->where(function($query) use ($userId, $sessionId) {
                if ($userId) {
                    $query->where('user_id', $userId);
                } else {
                    $query->where('session_id', $sessionId);
                }
            })
            ->first();

        if ($cartItem) {
            $cartItem->quantity = max(1, (int)$qty);
            $cartItem->save();
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false]);
    }

    // Remove item from cart
    public function remove($id)
    {
        $userId = \Auth::check() ? \Auth::id() : null;
        $sessionId = !$userId ? session()->getId() : null;

        $cartItem = \App\Models\Cart::where('id', $id)
            ->where(function($query) use ($userId, $sessionId) {
                if ($userId) {
                    $query->where('user_id', $userId);
                } else {
                    $query->where('session_id', $sessionId);
                }
            })
            ->first();

        if ($cartItem) {
            $cartItem->delete();
            return response()->json(['success' => true, 'message' => 'Item removed successfully']);
        }

        return response()->json(['success' => false, 'message' => 'Item not found'], 404);
    }

    // Clear entire cart
    public function clearCart()
    {
        $userId = \Auth::check() ? \Auth::id() : null;
        $sessionId = !$userId ? session()->getId() : null;

        $deletedCount = \App\Models\Cart::where(function($query) use ($userId, $sessionId) {
            if ($userId) {
                $query->where('user_id', $userId);
            } else {
                $query->where('session_id', $sessionId);
            }
        })->delete();

        if ($deletedCount > 0) {
            return response()->json(['success' => true, 'message' => 'Cart cleared successfully']);
        }

        return response()->json(['success' => false, 'message' => 'Cart is already empty'], 404);
    }

    // Checkout page (simple placeholder)
    public function checkout()
    {
        // Check if user has items in cart
        $userId = Auth::check() ? Auth::id() : null;
        $sessionId = !$userId ? session()->getId() : null;
        
        $cartItems = Cart::with('product')
            ->when($userId, function($query) use ($userId) {
                return $query->where('user_id', $userId);
            })
            ->when($sessionId, function($query) use ($sessionId) {
                return $query->where('session_id', $sessionId);
            })
            ->get();
        
        if ($cartItems->isEmpty()) {
            return redirect()->route('cart')->with('error', 'Your cart is empty. Please add items before checkout.');
        }
        
        return view('public.checkout');
    }
    public function processCheckout(Request $request)
{
    Log::info('Checkout process started');

    try {
        /* ---------- 1. VALIDATION ---------- */
        $request->validate([
            'firstName' => 'required|string|max:255',
            'lastName'  => 'required|string|max:255',
            'email'     => 'required|email|max:255',
'phone' => [
    'required',
    'regex:/^(?:\+92|0)(?:3\d{9}|(?:2[1]|4[2]|5[1])\d{7,8})$/'
],
            'address1'  => 'required|string|max:500',
            'address2'  => 'nullable|string|max:500',
            'city'      => 'required|string|max:255',
            'state'     => 'required|string|max:255',
            'zipCode'   => 'required|string|max:20',
            'deliveryOption' => 'nullable|string',
            'orderNotes' => 'nullable|string|max:1000',
        ]);

        /* ---------- 2. USER / SESSION ---------- */
        $userId = Auth::check() ? Auth::id() : null;
        $sessionId = !$userId ? session()->getId() : null;

        Log::info('Checkout user/session resolved', [
            'user_id' => $userId,
            'session_id' => $sessionId
        ]);

        /* ---------- 3. FETCH CART ---------- */
        $cartItems = Cart::with('product')
            ->when($userId, fn($q) => $q->where('user_id', $userId))
            ->when(!$userId, fn($q) => $q->where('session_id', $sessionId))
            ->get()
            ->filter(fn($item) => $item->product !== null);

        Log::info('Cart fetched', ['items_count' => $cartItems->count()]);

        if ($cartItems->isEmpty()) {
            Log::warning('Checkout stopped: Cart empty');
            return response()->json([
                'success' => false,
                'message' => 'Your cart is empty.'
            ], 400);
        }

        DB::beginTransaction();

        /* ---------- PRICE CALCULATOR (same as checkout blade) ---------- */
        $calcPrice = function ($product): int {
            $basePrice = (float)($product->final_price ?? $product->price ?? 0);
            $price = $basePrice;

            if ((int)($product->discount_type ?? 0) === 2 && (float)($product->discount_percentage ?? 0) > 0) {
                $price = $basePrice - ($basePrice * (float)$product->discount_percentage / 100);
            } elseif ((int)($product->discount_type ?? 0) === 3 && (float)($product->discounted_price ?? 0) > 0) {
                $price = (float)$product->discounted_price;
            }

            return (int) max(0, round($price));
        };

        /* ---------- 4. CALCULATE TOTALS ---------- */
        $subtotal = 0;

        foreach ($cartItems as $item) {
            $product = $item->product;
            $unit = $calcPrice($product);

            $subtotal += $unit * (int)$item->quantity;

            Log::debug('Price calculated (live)', [
                'product_id' => $product->id,
                'base_price' => (float)($product->final_price ?? $product->price ?? 0),
                'unit_price' => $unit,
                'quantity' => (int)$item->quantity
            ]);
        }

        $shipping = 0;
        $total = $subtotal + $shipping;

        Log::info('Totals calculated', [
            'subtotal' => $subtotal,
            'shipping' => $shipping,
            'total' => $total
        ]);

        /* ---------- 5. CREATE ORDER ---------- */
        $order = Order::create([
            'order_number' => 'ORD-' . strtoupper(uniqid()),
            'status' => 'pending',
            'user_id' => $userId,
            'session_id' => $sessionId,
            'first_name' => $request->firstName,
            'last_name' => $request->lastName,
            'email' => $request->email,
            'phone' => $request->phone,
            'address1' => $request->address1,
            'address2' => $request->address2,
            'city' => $request->city,
            'state' => $request->state,
            'zip_code' => $request->zipCode,
            'delivery_option' => $request->deliveryOption,
            'order_notes' => $request->orderNotes,
            'subtotal' => $subtotal,
            'shipping_cost' => $shipping,
            'total_amount' => $total,
        ]);

        Log::info('Order created', [
            'order_id' => $order->id,
            'order_number' => $order->order_number
        ]);
        CheckoutLead::where('session_id', session()->getId())
    ->update([
        'is_converted' => true,
        'order_id' => $order->id,
        'last_activity_at' => now(),
        'last_reason' => 'converted_to_order',
    ]);
     Log::info('Checkout lead', [
            'order_id' => $order->id,
        ]);

        /* ---------- 6. CREATE ORDER ITEMS ---------- */
        foreach ($cartItems as $item) {
            $product = $item->product;

            $unitPrice = $calcPrice($product);
            $qty = (int)$item->quantity;

            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $product->id,
                'product_name' => $product->name ?? 'Product',
                'product_image' => $product->image ?? null,
                'unit_price' => $unitPrice,
                'quantity' => $qty,
                'total_price' => $unitPrice * $qty,
            ]);

            Log::info('Order item created (live)', [
                'order_id' => $order->id,
                'product_id' => $product->id,
                'unit_price' => $unitPrice,
                'quantity' => $qty
            ]);
        }

        /* ---------- 7. CLEAR CART ---------- */
        Cart::when($userId, fn($q) => $q->where('user_id', $userId))
            ->when(!$userId, fn($q) => $q->where('session_id', $sessionId))
            ->delete();

        Log::info('Cart cleared');

        DB::commit();

        Log::info('Checkout completed successfully');

        return response()->json([
            'success' => true,
            'message' => 'Order placed successfully!',
            'redirect' => route('index'),
            'order_number' => $order->order_number,
            'order_total' => $order->total_amount
        ]);

    } catch (ValidationException $e) {
        if (DB::transactionLevel() > 0) DB::rollBack();

        Log::warning('Checkout validation failed', $e->errors());

        return response()->json([
            'success' => false,
            'errors' => $e->errors()
        ], 422);

    } catch (\Exception $e) {
        if (DB::transactionLevel() > 0) DB::rollBack();

        Log::error('Checkout error', [
            'message' => $e->getMessage(),
            'trace' => $e->getTraceAsString()
        ]);

        return response()->json([
            'success' => false,
            'message' => 'Something went wrong. Please try again.'
        ], 500);
    }
}
    // // Process checkout form submission
    // public function processCheckout(Request $request)
    // {
    //     try {
    //         // Validate request
    //         $request->validate([
    //             'firstName' => 'required|string|max:255',
    //             'lastName' => 'required|string|max:255',
    //             'email' => 'required|email|max:255',
    //             'phone' => 'required|string|max:20',
    //             'address1' => 'required|string|max:500',
    //             'city' => 'required|string|max:255',
    //             'state' => 'required|string|max:255',
    //             'zipCode' => 'required|string|max:20',
    //             'address2' => 'nullable|string|max:500',
    //             'title' => 'nullable|string|max:10',
    //             'deliveryOption' => 'required|string',
    //             'paymentMethod' => 'required|string',
    //             'orderNotes' => 'nullable|string|max:1000',
    //             'paymentReceipt' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120' // 5MB max
    //         ]);
            
    //         // Get cart items
    //         $userId = Auth::check() ? Auth::id() : null;
    //         $sessionId = !$userId ? session()->getId() : null;
            
    //         $cartItems = Cart::with('product')
    //             ->when($userId, function($query) use ($userId) {
    //                 return $query->where('user_id', $userId);
    //             })
    //             ->when($sessionId, function($query) use ($sessionId) {
    //                 return $query->where('session_id', $sessionId);
    //             })
    //             ->get();
            
    //         if ($cartItems->isEmpty()) {
    //             return response()->json([
    //                 'success' => false,
    //                 'message' => 'Your cart is empty. Please add items before checkout.'
    //             ], 400);
    //         }
            
    //         // Calculate totals
    //         $subtotal = 0;
    //         $orderItems = [];
    //         foreach($cartItems as $item) {
    //             // Calculate final price based on discount_option
    //             $price = $item->product->price;
                
    //             if ($item->product->discount_option == 2 && $item->product->discount_percentage > 0) {
    //                 // Percentage discount
    //                 $price = $item->product->price - ($item->product->price * $item->product->discount_percentage / 100);
    //             } elseif ($item->product->discount_option == 3 && $item->product->discounted_price > 0) {
    //                 // Fixed amount discount
    //                 $price = $item->product->discounted_price;
    //             }
                
    //             $price = max(0, $price); // Ensure price doesn't go below 0
    //             $subtotal += $price * $item->quantity;
                
    //             $orderItems[] = [
    //                 'product_id' => $item->product_id,
    //                 'product_name' => $item->product->name,
    //                 'quantity' => $item->quantity,
    //                 'unit_price' => $price,
    //                 'total_price' => $price * $item->quantity
    //             ];
    //         }
            
    //         $shipping = 0; // Free shipping
    //         $total = $subtotal + $shipping;
            
    //         // Handle file upload
    //         $receiptPath = null;
    //         if ($request->hasFile('paymentReceipt')) {
    //             $file = $request->file('paymentReceipt');
    //             $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
    //             $receiptPath = 'uploads/payments/' . $fileName;
    //             $file->move(public_path('uploads/payments'), $fileName);
    //         }
            
    //         // Create order in database
    //         $order = Order::create([
    //             'order_number' => Order::generateOrderNumber(),
    //             'status' => 'pending',
    //             'user_id' => $userId,
    //             'session_id' => $sessionId,
    //             'title' => $request->title,
    //             'first_name' => $request->firstName,
    //             'last_name' => $request->lastName,
    //             'email' => $request->email,
    //             'phone' => $request->phone,
    //             'address1' => $request->address1,
    //             'address2' => $request->address2,
    //             'city' => $request->city,
    //             'state' => $request->state,
    //             'zip_code' => $request->zipCode,
    //             'delivery_option' => $request->deliveryOption,
    //             'payment_method' => $request->paymentMethod,
    //             'payment_receipt' => $receiptPath,
    //             'payment_status' => 'pending',
    //             'order_notes' => $request->orderNotes,
    //             'subtotal' => $subtotal,
    //             'shipping_cost' => $shipping,
    //             'total_amount' => $total,
    //         ]);
            
    //         // Create order items
    //         foreach($cartItems as $item) {
    //             $product = $item->product;
                
    //             // Calculate pricing details
    //             $originalPrice = $product->price;
    //             $unitPrice = $product->price;
    //             $discountAmount = 0;
    //             $discountType = null;
    //             $discountPercentage = null;
                
    //             if ($product->discount_option == 2 && $product->discount_percentage > 0) {
    //                 // Percentage discount
    //                 $unitPrice = $product->price - ($product->price * $product->discount_percentage / 100);
    //                 $discountAmount = $product->price - $unitPrice;
    //                 $discountType = 'percentage';
    //                 $discountPercentage = $product->discount_percentage;
    //             } elseif ($product->discount_option == 3 && $product->discounted_price > 0) {
    //                 // Fixed amount discount
    //                 $unitPrice = $product->discounted_price;
    //                 $discountAmount = $product->price - $product->discounted_price;
    //                 $discountType = 'fixed';
    //             }
                
    //             $unitPrice = max(0, $unitPrice);
    //             $totalPrice = $unitPrice * $item->quantity;
                
    //             OrderItem::create([
    //                 'order_id' => $order->id,
    //                 'product_id' => $item->product_id,
    //                 'product_name' => $product->name,
    //                 'product_image' => $product->image,
    //                 'unit_price' => $unitPrice,
    //                 'original_price' => $originalPrice,
    //                 'discount_amount' => $discountAmount,
    //                 'discount_type' => $discountType,
    //                 'discount_percentage' => $discountPercentage,
    //                 'quantity' => $item->quantity,
    //                 'total_price' => $totalPrice,
    //             ]);
    //         }
            
    //         // Clear the cart
    //         Cart::where('user_id', $userId)
    //             ->orWhere('session_id', $sessionId)
    //             ->delete();
            
    //         // Store order success in session for display
    //         session()->flash('order_success', [
    //             'order_number' => $order->order_number,
    //             'total' => $order->total_amount,
    //             'order_id' => $order->id
    //         ]);
            
    //         return response()->json([
    //             'success' => true,
    //             'message' => 'Order placed successfully! We will verify your payment and process your order.',
    //             'redirect' => route('index'),
    //             'order_total' => $order->total_amount,
    //             'order_number' => $order->order_number
    //         ]);
            
    //     } catch (ValidationException $e) {
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'Please check your form data and try again.',
    //             'errors' => $e->errors()
    //         ], 422);
    //     } catch (\Exception $e) {
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'An error occurred while processing your order. Please try again.'
    //         ], 500);
    //     }
    // }

public function add(Request $request)
{
    Log::info('Add to cart started', $request->all());

    $cartType = $request->input('cart_type', 'normal');
    $quantity = (int) $request->input('quantity', 1);

    if ($quantity < 1) {
        $quantity = 1;
    }

    $userId = Auth::check() ? Auth::id() : null;
    $sessionId = !$userId ? session()->getId() : null;

    /*
    |--------------------------------------------------------------------------
    | HELPER: Extract first image path from any image array/string format
    |--------------------------------------------------------------------------
    */
    $extractImagePath = function ($value) use (&$extractImagePath) {
        if (empty($value)) {
            return null;
        }

        if (is_string($value)) {
            return $value;
        }

        if (is_object($value)) {
            $value = (array) $value;
        }

        if (!is_array($value)) {
            return null;
        }

        foreach (['image', 'image_path', 'path', 'url', 'src', 'file'] as $key) {
            if (!empty($value[$key])) {
                if (is_string($value[$key])) {
                    return $value[$key];
                }

                if (is_array($value[$key])) {
                    $path = $extractImagePath($value[$key]);

                    if ($path) {
                        return $path;
                    }
                }
            }
        }

        foreach (['images', 'gallery', 'metal_images', 'metals_images'] as $key) {
            if (!empty($value[$key])) {
                $path = $extractImagePath($value[$key]);

                if ($path) {
                    return $path;
                }
            }
        }

        foreach ($value as $item) {
            $path = $extractImagePath($item);

            if ($path) {
                return $path;
            }
        }

        return null;
    };

    /*
    |--------------------------------------------------------------------------
    | HELPER: Fetch solitaire image from metals_images by metal_code
    |--------------------------------------------------------------------------
    */
    $getSolitaireMetalImage = function ($product, $metalCode, $selectedMetal, $requestSelectedImage = null) use ($extractImagePath) {
        // If frontend already sends selected image, save that image directly
        if (!empty($requestSelectedImage)) {
            return $requestSelectedImage;
        }

        $metalsImages = $product->metals_images ?? [];

        if (is_string($metalsImages)) {
            $decoded = json_decode($metalsImages, true);
            $metalsImages = is_array($decoded) ? $decoded : [];
        }

        if (is_object($metalsImages)) {
            $metalsImages = (array) $metalsImages;
        }

        if (is_array($metalsImages) && count($metalsImages) > 0) {

            // Format example:
            // metals_images = {
            //   "white_gold": ["image1.jpg", "image2.jpg"],
            //   "yellow_gold": ["image3.jpg"]
            // }
            if (isset($metalsImages[$metalCode])) {
                $path = $extractImagePath($metalsImages[$metalCode]);

                if ($path) {
                    return $path;
                }
            }

            // Case-insensitive key matching
            foreach ($metalsImages as $key => $value) {
                if (is_string($key) && strtolower(trim($key)) === strtolower(trim($metalCode))) {
                    $path = $extractImagePath($value);

                    if ($path) {
                        return $path;
                    }
                }
            }

            // Format example:
            // metals_images = [
            //   {"metal_code": "white_gold", "images": ["image1.jpg"]},
            //   {"metal_code": "yellow_gold", "images": ["image2.jpg"]}
            // ]
            foreach ($metalsImages as $row) {
                if (is_object($row)) {
                    $row = (array) $row;
                }

                if (!is_array($row)) {
                    continue;
                }

                $rowMetalCode = $row['metal_code']
                    ?? $row['code']
                    ?? $row['metal']
                    ?? $row['metalCode']
                    ?? null;

                if ($rowMetalCode && strtolower(trim((string) $rowMetalCode)) === strtolower(trim((string) $metalCode))) {
                    $path = $extractImagePath($row);

                    if ($path) {
                        return $path;
                    }
                }
            }
        }

        // Fallback if image exists inside selected metal array
        $metalImages = data_get($selectedMetal, 'images');
        $path = $extractImagePath($metalImages);

        if ($path) {
            return $path;
        }

        // Final fallback
        return $product->image ?? 'assets/f_assets/image/no-image.png';
    };

    /*
    |--------------------------------------------------------------------------
    | SOLITAIRE PRODUCT ADD TO CART
    |--------------------------------------------------------------------------
    */
    if ($cartType === 'solitaire') {

        $productId = $request->input('solitaire_product_id') ?? $request->input('product_id');
        $metalCode = $request->input('metal_code');
        $diamondCarat = $request->input('diamond_carat');
        $ringSize = $request->input('solitaire_ring_size');
        $requestSelectedImage = $request->input('selected_image');

        $inscriptionText = trim((string) $request->input('inscription_text', ''));

        if ($inscriptionText === '') {
            $inscriptionText = null;
        }

        if (!$productId || !$metalCode || !$diamondCarat || !$ringSize) {
            return response()->json([
                'success' => false,
                'message' => 'Please select metal, carat, and ring size.'
            ], 422);
        }

        if ($inscriptionText && strlen($inscriptionText) > 15) {
            return response()->json([
                'success' => false,
                'message' => 'Inscription must be maximum 15 characters.'
            ], 422);
        }

        $product = SolitaireProduct::where('status', 1)->find($productId);

        if (!$product) {
            Log::warning('Solitaire add to cart failed: Product not found', [
                'product_id' => $productId
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Product not found.'
            ], 404);
        }

        $metals = collect($product->metals ?? []);
        $variants = collect($product->variants ?? []);

        $selectedMetal = $metals->first(function ($metal) use ($metalCode) {
            return (data_get($metal, 'code') === $metalCode)
                || (data_get($metal, 'metal_code') === $metalCode);
        });

        if (!$selectedMetal) {
            return response()->json([
                'success' => false,
                'message' => 'Selected metal is not available.'
            ], 422);
        }

        $diamondCaratFormatted = number_format((float) $diamondCarat, 2, '.', '');

        $selectedVariant = $variants->first(function ($variant) use ($metalCode, $diamondCaratFormatted) {
            $status = data_get($variant, 'status');

            $isActive = !isset($status)
                || $status === true
                || $status === 1
                || $status === '1';

            return $isActive
                && (data_get($variant, 'metal_code') === $metalCode)
                && number_format((float) data_get($variant, 'diamond_carat', 0), 2, '.', '') === $diamondCaratFormatted;
        });

        if (!$selectedVariant || empty(data_get($selectedVariant, 'price'))) {
            return response()->json([
                'success' => false,
                'message' => 'Selected metal and carat price is unavailable.'
            ], 422);
        }

        $price = (float) data_get($selectedVariant, 'price');
        $oldPrice = !empty(data_get($selectedVariant, 'old_price')) ? (float) data_get($selectedVariant, 'old_price') : null;
        $discount = !empty(data_get($selectedVariant, 'discount_percent')) ? (float) data_get($selectedVariant, 'discount_percent') : null;

        $selectedImage = $getSolitaireMetalImage(
            $product,
            $metalCode,
            $selectedMetal,
            $requestSelectedImage
        );

        $cartItem = Cart::where('cart_type', 'solitaire')
            ->whereNull('product_id')
            ->where('solitaire_product_id', $product->id)
            ->where('metal_code', $metalCode)
            ->where('diamond_carat', $diamondCaratFormatted)
            ->where('solitaire_ring_size', $ringSize)
            ->where('inscription_text', $inscriptionText)
            ->when($userId, function ($query) use ($userId) {
                return $query->where('user_id', $userId);
            })
            ->when(!$userId, function ($query) use ($sessionId) {
                return $query->where('session_id', $sessionId);
            })
            ->first();

        if ($cartItem) {
            $cartItem->quantity += $quantity;
            $cartItem->variant_price = $price;
            $cartItem->old_price = $oldPrice;
            $cartItem->discount_percent = $discount;
            $cartItem->selected_image = $selectedImage;
            $cartItem->save();

            Log::info('Solitaire cart updated', [
                'cart_id' => $cartItem->id,
                'quantity' => $cartItem->quantity,
                'selected_image' => $selectedImage
            ]);
        } else {
            Cart::create([
                'user_id' => $userId,
                'session_id' => $sessionId,

                'product_id' => null,
                'solitaire_product_id' => $product->id,

                'quantity' => $quantity,
                'size' => null,
                'solitaire_ring_size' => $ringSize,

                'metal_code' => $metalCode,
                'metal_name' => data_get($selectedMetal, 'name') ?? data_get($selectedMetal, 'metal_name') ?? $metalCode,
                'diamond_carat' => $diamondCaratFormatted,
                'inscription_text' => $inscriptionText,

                'selected_image' => $selectedImage,

                'variant_price' => $price,
                'old_price' => $oldPrice,
                'discount_percent' => $discount,

                'cart_type' => 'solitaire',
            ]);

            Log::info('New solitaire cart item created', [
                'solitaire_product_id' => $product->id,
                'metal_code' => $metalCode,
                'diamond_carat' => $diamondCaratFormatted,
                'solitaire_ring_size' => $ringSize,
                'quantity' => $quantity,
                'selected_image' => $selectedImage
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Solitaire product added to cart!'
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | NORMAL PRODUCT ADD TO CART
    |--------------------------------------------------------------------------
    */
    $productId = $request->input('product_id');
    $size = $request->input('size');

    $product = Products::find($productId);

    if (!$product) {
        Log::warning('Add to cart failed: Product not found', [
            'product_id' => $productId
        ]);

        return response()->json([
            'success' => false,
            'message' => 'Product not found.'
        ], 404);
    }

    $cartItem = Cart::where('cart_type', 'normal')
        ->where('product_id', $productId)
        ->where('size', $size)
        ->when($userId, function ($query) use ($userId) {
            return $query->where('user_id', $userId);
        })
        ->when(!$userId, function ($query) use ($sessionId) {
            return $query->where('session_id', $sessionId);
        })
        ->first();

    if ($cartItem) {
        $cartItem->quantity += $quantity;
        $cartItem->save();

        Log::info('Normal cart updated', [
            'cart_id' => $cartItem->id,
            'quantity' => $cartItem->quantity
        ]);
    } else {
        Cart::create([
            'user_id' => $userId,
            'session_id' => $sessionId,

            'product_id' => $productId,
            'solitaire_product_id' => null,

            'quantity' => $quantity,
            'size' => $size,
            'solitaire_ring_size' => null,

            'metal_code' => null,
            'metal_name' => null,
            'diamond_carat' => null,
            'inscription_text' => null,
            'selected_image' => null,
            'variant_price' => null,
            'old_price' => null,
            'discount_percent' => null,

            'cart_type' => 'normal',
        ]);

        Log::info('New normal cart item created', [
            'product_id' => $productId,
            'quantity' => $quantity
        ]);
    }

    return response()->json([
        'success' => true,
        'message' => 'Product added to cart!'
    ]);
}
}