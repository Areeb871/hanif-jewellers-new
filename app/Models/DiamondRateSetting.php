<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class DiamondRateSetting extends Model
{
    protected $table = 'diamond_rate_settings';

    protected $fillable = [
        'market',
        'karat',
        'rate_per_carat',
        'making_charge',
        'gst_percent',
        'dollar_rate',
        'discount_percent',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function scopeForMarket(Builder $query, string $market = 'pk'): Builder
    {
        return $query->where('market', $market);
    }
}
