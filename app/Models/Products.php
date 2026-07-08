<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Services\GoldPriceCalculator;
use App\Services\DiamondPriceCalculator;

class Products extends Model
{
    protected $table = 'products';
    protected $fillable = ['category_id', 'sub_category_id', 'name', 'online_store_name', 'slug', 'sku', 'barcode', 'description', 'online_store_description', 'image', 'hover_image', 'price', 'diamond_price', 'gold_weight', 'price_aed', 'discounted_price', 'discount_percentage', 'quantity', 'status', 'meta_title', 'meta_description', 'meta_keywords', 'is_featured', 'is_latest', 'show_price'];
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
     * Live-calculated price from any description text (same gold/diamond logic).
     */
    public function finalPriceForDescription(?string $description): float
    {
        if ($this->shouldUseDiamondPricing()) {
            $diamond = DiamondPriceCalculator::calculateFromDescription(
                $description ?? '',
                (float) ($this->diamond_price ?? 0),
                filled($this->gold_weight) ? (float) $this->gold_weight : null
            );
            if ($diamond !== null) {
                return $diamond;
            }

            return (float) ($this->attributes['price'] ?? 0);
        }

        $calculated = GoldPriceCalculator::calculateFromDescription(
            $description ?? '',
            filled($this->gold_weight) ? (float) $this->gold_weight : null
        );

        if ($calculated !== null) {
            return $calculated;
        }

        return (float) ($this->attributes['price'] ?? 0);
    }

    /**
     * Live-calculated price: diamond (tagged) or gold from description, else stored price.
     */
    public function getFinalPriceAttribute(): float
    {
        return $this->finalPriceForDescription($this->description ?? '');
    }

    /** Online store name when set, otherwise default product name. */
    public function storefrontName(): string
    {
        return filled($this->online_store_name) ? $this->online_store_name : ($this->name ?? '');
    }

    /** Online store description when set, otherwise default description. */
    public function storefrontDescription(): string
    {
        return filled($this->online_store_description)
            ? $this->online_store_description
            : ($this->description ?? '');
    }

    /** Live price from storefront description (matches online store card). */
    public function getStorefrontPriceAttribute(): float
    {
        return $this->finalPriceForDescription($this->storefrontDescription());
    }

    public function displayName(bool $forStore = false): string
    {
        return $forStore ? $this->storefrontName() : ($this->name ?? '');
    }

    public function displayDescription(bool $forStore = false): string
    {
        return $forStore ? $this->storefrontDescription() : ($this->description ?? '');
    }

    public function displayPrice(bool $forStore = false): float
    {
        return $forStore ? $this->storefront_price : $this->final_price;
    }

    public function isWatchProduct(): bool
    {
        if (str_contains(strtolower($this->name ?? ''), 'watch')) {
            return true;
        }

        $category = $this->relationLoaded('category')
            ? $this->category
            : $this->category()->first();

        return $category && str_contains(strtolower($category->name ?? ''), 'watch');
    }

    public function hasDiamondTag(): bool
    {
        $tags = $this->relationLoaded('tags') ? $this->tags : $this->tags()->get();

        foreach ($tags as $tag) {
            $slug = strtolower($tag->slug ?? $tag->name ?? '');
            if (str_contains($slug, 'diamond')) {
                return true;
            }
        }

        return false;
    }

    protected function shouldUseDiamondPricing(): bool
    {
        return !$this->isWatchProduct() && $this->hasDiamondTag();
    }
}
