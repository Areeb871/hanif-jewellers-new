<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $table = 'carts';
    protected $fillable = [
        'user_id',
        'session_id',
        'product_id',
        'quantity',
        'size',
        'solitaire_product_id',
        'metal_code',
        'metal_name',
        'diamond_carat',
        'inscription_text',
        'variant_price',
        'old_price',
        'discount_percent',
        'cart_type',
        'solitaire_ring_size',
        'selected_image',
    ];

    public function product() {
        return $this->belongsTo(Products::class, 'product_id');
    }
    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function solitaireProduct()
{
    return $this->belongsTo(SolitaireProduct::class, 'solitaire_product_id');
}
}
