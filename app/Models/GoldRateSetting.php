<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class GoldRateSetting extends Model
{
    protected $table = 'gold_rate_settings';

    protected $fillable = [
        'market',
        'karat',
        'gold_rate_per_gram',
        'vat_percent',
        'is_active',
    ];

    public function scopeForMarket(Builder $query, string $market = 'pk'): Builder
    {
        return $query->where('market', $market);
    }
}
