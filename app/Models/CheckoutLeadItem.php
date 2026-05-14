<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CheckoutLeadItem extends Model
{
    protected $fillable = [
        'checkout_lead_id',
        'product_id',
        'product_name',
        'product_image',
        'unit_price',
        'original_price',
        'discount_amount',
        'discount_type',
        'discount_percentage',
        'quantity',
        'total_price',
    ];

    protected $casts = [
        'unit_price' => 'decimal:2',
        'original_price' => 'decimal:2',
        'discount_amount' => 'decimal:2',
        'discount_percentage' => 'decimal:2',
        'total_price' => 'decimal:2',
    ];

    public function checkoutLead()
    {
        return $this->belongsTo(CheckoutLead::class, 'checkout_lead_id');
    }

    public function product()
    {
        return $this->belongsTo(Products::class, 'product_id');
    }
}