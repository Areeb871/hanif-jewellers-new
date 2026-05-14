<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order extends Model
{
    protected $fillable = [
        'order_number',
        'status',
        'user_id',
        'session_id',
        'title',
        'first_name',
        'last_name',
        'email',
        'phone',
        'address1',
        'address2',
        'city',
        'state',
        'zip_code',
        'delivery_option',
        'payment_method',
        'payment_receipt',
        'payment_status',
        'order_notes',
        'subtotal',
        'shipping_cost',
        'total_amount',
        'cancel_reason',

    ];

    protected $casts = [
        'subtotal' => 'decimal:2',
        'shipping_cost' => 'decimal:2',
        'total_amount' => 'decimal:2',
    ];

    /**
     * Get the order items for this order
     */
    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    /**
     * Get the user who placed this order
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the full name of the customer
     */
    public function getFullNameAttribute(): string
    {
        $name = $this->first_name . ' ' . $this->last_name;
        if ($this->title) {
            $name = $this->title . ' ' . $name;
        }
        return $name;
    }

    /**
     * Get the complete shipping address
     */
    public function getFullAddressAttribute(): string
    {
        $address = $this->address1;
        if ($this->address2) {
            $address .= ', ' . $this->address2;
        }
        $address .= ', ' . $this->city . ', ' . $this->state . ' ' . $this->zip_code;
        return $address;
    }

    /**
     * Check if order is pending payment verification
     */
    public function isPendingPayment(): bool
    {
        return $this->status === 'pending' && $this->payment_status === 'pending';
    }

    /**
     * Check if order is ready for processing
     */
    public function isReadyForProcessing(): bool
    {
        return $this->status === 'pending' && $this->payment_status === 'verified';
    }

    /**
     * Generate a unique order number
     */
    public static function generateOrderNumber(): string
    {
        $prefix = 'ORD';
        $timestamp = now()->format('Ymd');
        $random = strtoupper(substr(uniqid(), -4));
        return $prefix . '-' . $timestamp . '-' . $random;
    }
}
