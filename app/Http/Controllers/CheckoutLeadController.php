<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CheckoutLead;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CheckoutLeadController extends Controller
{
public function save(Request $request)
{
    Log::info('Checkout lead save hit', $request->all());

    $sessionId = session()->getId();
    $userId = Auth::check() ? Auth::id() : null;

    if (!$request->email && !$request->phone) {
        return response()->json(['success' => true, 'skipped' => true]);
    }

    $lead = CheckoutLead::firstOrNew(['session_id' => $sessionId]);

    // If this session lead was converted before, reset for a new attempt
    if ($lead->exists && (bool) $lead->is_converted === true) {
        $lead->is_converted = false;
        $lead->order_id = null;
    }

    $lead->user_id = $userId;
    $lead->title = $request->title;
    $lead->first_name = $request->firstName;
    $lead->last_name = $request->lastName;
    $lead->email = $request->email;
    $lead->phone = $request->phone;

    $lead->address1 = $request->address1;
    $lead->address2 = $request->address2;
    $lead->city = $request->city;
    $lead->state = $request->state;
    $lead->zip_code = $request->zipCode;

    $lead->delivery_option = $request->deliveryOption;
    $lead->checkout_step = (int) ($request->step ?? 1);
    $lead->last_activity_at = now();
    $lead->last_reason = $request->reason ?? 'save';

    $lead->save();

    // Save checkout items snapshot
   $cartItems = \App\Models\Cart::with('product')
    ->where(function ($q) use ($sessionId) {
        $q->where('session_id', $sessionId);

        if (Auth::check()) {
            $q->orWhere('user_id', Auth::id());
        }
    })
    ->get();

    // Remove old items and insert latest cart snapshot
    $lead->items()->delete();

    foreach ($cartItems as $cartItem) {
        $product = $cartItem->product;

        $unitPrice = $cartItem->price ?? $cartItem->unit_price ?? 0;
        $quantity = $cartItem->quantity ?? 1;

        $lead->items()->create([
            'product_id'          => $cartItem->product_id,
            'product_name'        => $cartItem->product_name ?? ($product->name ?? null),
            'product_image'       => $cartItem->product_image ?? ($product->image ?? null),
            'unit_price'          => $unitPrice,
            'original_price'      => $cartItem->original_price ?? $unitPrice,
            'discount_amount'     => $cartItem->discount_amount ?? 0,
            'discount_type'       => $cartItem->discount_type ?? null,
            'discount_percentage' => $cartItem->discount_percentage ?? null,
            'quantity'            => $quantity,
            'total_price'         => $cartItem->total_price ?? ($unitPrice * $quantity),
        ]);
    }

    return response()->json([
        'success' => true,
        'lead_id' => $lead->id,
    ]);
}
    public function exit(Request $request)
    {
        // Same behavior; called via sendBeacon
        return $this->save($request);
    }
}
