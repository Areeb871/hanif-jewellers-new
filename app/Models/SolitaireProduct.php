<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SolitaireProduct extends Model
{
    use SoftDeletes;

    protected $table = 'solitaire_products';

    protected $fillable = [
        'name',
        'slug',
        'sku',
        'tag_label',
        'short_description',
        'currency',
        'gallery_images',
        'metals',
        'diamond_carats',
        'metal_images',
        'variants',
        'default_metal_code',
        'default_diamond_carat',
        'status',
    ];

    protected $casts = [
        'gallery_images' => 'array',
        'metals' => 'array',
        'diamond_carats' => 'array',
        'metal_images' => 'array',
        'variants' => 'array',
        'status' => 'boolean',
    ];
}