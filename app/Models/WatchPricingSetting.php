<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WatchPricingSetting extends Model
{
    protected $fillable = [
        'subcategory_id',
        'chf_rate',
        'discount_value',
        'sale_discount_value',
        'is_sale',
        'gst_percent',
    ];

    protected $casts = [
        'chf_rate' => 'decimal:4',
        'discount_value' => 'decimal:2',
        'sale_discount_value' => 'decimal:2',
        'is_sale' => 'boolean',
        'gst_percent' => 'decimal:2',
    ];

    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class, 'subcategory_id');
    }
}
