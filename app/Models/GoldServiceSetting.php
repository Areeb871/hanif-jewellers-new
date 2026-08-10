<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GoldServiceSetting extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'weight_threshold',
        'light_oc_final_per_article',
        'heavy_oc_final_per_gram',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'weight_threshold' => 'float',
        'light_oc_final_per_article' => 'float',
        'heavy_oc_final_per_gram' => 'float',
        'is_active' => 'boolean',
    ];
}
