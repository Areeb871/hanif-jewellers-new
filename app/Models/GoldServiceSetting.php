<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GoldServiceSetting extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'weight_threshold',
        'sale_weight_threshold',
        'light_oc_final_per_article',
        'sale_light_oc_final_per_article',
        'heavy_oc_final_per_gram',
        'sale_heavy_oc_final_per_gram',
        'sort_order',
        'is_active',
        'is_sale',
    ];

    protected $casts = [
        'weight_threshold' => 'float',
        'sale_weight_threshold' => 'float',
        'light_oc_final_per_article' => 'float',
        'sale_light_oc_final_per_article' => 'float',
        'heavy_oc_final_per_gram' => 'float',
        'sale_heavy_oc_final_per_gram' => 'float',
        'is_active' => 'boolean',
        'is_sale' => 'boolean',
    ];
}
