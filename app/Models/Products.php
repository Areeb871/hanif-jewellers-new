<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Services\GoldPriceCalculator;

class Products extends Model
{
    protected $table = 'products';
    protected $fillable = ['category_id', 'sub_category_id', 'name', 'slug', 'sku', 'barcode', 'description', 'image', 'hover_image', 'price', 'price_aed', 'discounted_price', 'discount_percentage', 'quantity', 'status', 'meta_title', 'meta_description', 'meta_keywords', 'is_featured', 'is_latest', 'show_price'];
    protected $hidden = ['created_at', 'updated_at'];
    // public function getPriceAttribute($value)
    // {
    //     $currency = session('currency', 'PKR');
    
    //     return $currency === 'AED'
    //         ? ($this->price_aed ?? 0)
    //         : ($this->attributes['price'] ?? 0);
    // }

    // ===========================
    // PRICE BREAKDOWN (returns array: PKR + AED) FOR YOUR BLADE COMPONENT
    // ===========================
    // public function getDisplayPrices(): array
    // {
    //     return [
    //         'pkr' => $this->attributes['price'] ?? 0,
    //         'aed' => $this->price_aed ?? 0,
    //     ];
    // }
    

    public function category()
    {
        return $this->belongsTo(Categories::class, 'category_id');
    }
    public function tags()
    {
        return $this->belongsToMany(Tags::class, 'product_tags', 'product_id', 'tag_id');
    }
    public function productTags()
    {
        return $this->hasMany(ProductTags::class, 'product_id');
    }
    public function images() {
        return $this->hasMany(ProductImages::class, 'product_id');
    }
    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class, 'subcategory_id');
    }

    /**
     * Live-calculated price based on current gold rate settings and description.
     * Falls back to stored price if calculation is not possible.
     */
    public function getFinalPriceAttribute(): float
    {
        $calculated = GoldPriceCalculator::calculateFromDescription($this->description ?? '');

        if ($calculated !== null) {
            return $calculated;
        }

        return (float) ($this->attributes['price'] ?? 0);
    }
}
