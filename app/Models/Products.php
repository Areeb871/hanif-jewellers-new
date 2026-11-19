<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Services\GoldPriceCalculator;
use App\Services\DiamondPriceCalculator;
use App\Services\WatchPriceCalculator;

class Products extends Model
{
    protected $table = 'products';
    protected $fillable = [
        'category_id',
        'sub_category_id',
        'name',
        'uae_name',
        'online_store_name',
        'uae_online_store_name',
        'slug',
        'sku',
        'barcode',
        'description',
        'uae_description',
        'online_store_description',
        'uae_online_store_description',
        'image',
        'hover_image',
        'price',
        'online_store_price',
        'diamond_price',
        'online_store_diamond_price',
        'uae_diamond_price',
        'uae_online_store_diamond_price',
        'watch_rate',
        'gold_weight',
        'online_store_gold_weight',
        'uae_gold_weight',
        'uae_online_store_gold_weight',
        'gold_service_id',
        'online_store_gold_service_id',
        'uae_gold_service_id',
        'uae_online_store_gold_service_id',
        'price_aed',
        'online_store_price_aed',
        'discounted_price',
        'discount_percentage',
        'quantity',
        'status',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'is_featured',
        'is_pinned',
        'is_latest',
        'show_price',
    ];
    protected $casts = [
        'is_pinned' => 'boolean',
        'watch_rate' => 'decimal:2',
    ];
    protected $hidden = ['created_at', 'updated_at'];

    public static function currentMarket(): string
    {
        $market = session('market');

        if (in_array($market, ['pk', 'uae'], true)) {
            return $market;
        }

        return app()->getLocale() === 'ar' ? 'uae' : 'pk';
    }

    public function isUaeMarket(?string $market = null): bool
    {
        return ($market ?? static::currentMarket()) === 'uae';
    }

    /**
     * Pakistan display prices round to the nearest 1,000.
     * Dubai and Arabic display prices round to the nearest 100.
     * 50 or more rounds up (9,470 → 9,500). Under 50 rounds down (9,445 → 9,400).
     */
    public static function roundDisplayPrice(float|int|null $price, ?string $market = null): float
    {
        $price = (float) ($price ?? 0);
        if ($price <= 0) {
            return 0.0;
        }

        $market = $market ?? static::currentMarket();
        if ($market === 'uae') {
            return (float) round(round($price, 2), -2, PHP_ROUND_HALF_UP);
        }

        return (float) round($price, -3, PHP_ROUND_HALF_UP);
    }

    public function displayRoundedPrice(bool $forStore = false): float
    {
        return static::roundDisplayPrice($this->displayPrice($forStore));
    }

    public function category()
    {
        return $this->belongsTo(Categories::class, 'category_id');
    }
    public function tags()
    {
        return $this->belongsToMany(Tags::class, 'product_tags', 'product_id', 'tag_id');
    }

    public function requiresAsianRingSize(): bool
    {
        $normalize = static function ($value): string {
            return trim((string) preg_replace(
                '/[^a-z0-9]+/',
                '-',
                strtolower(trim((string) $value))
            ), '-');
        };

        $containsRingSegment = static fn ($value): bool =>
            preg_match('/(?:^|-)rings?(?:-|$)/', $normalize($value)) === 1;

        $tags = $this->relationLoaded('tags')
            ? $this->tags
            : $this->tags()->get(['tags.id', 'tags.slug']);

        $tagSlugs = $tags->map(fn ($tag) => $normalize($tag->slug));

        $hasExistingRingSizeTag = $tagSlugs->contains(function ($slug) {
            return preg_match('/^gold-rings?(?:-\d+)?$/', $slug) === 1
                || preg_match('/^diamond(?:-men)?-rings?(?:-\d+)?$/', $slug) === 1
                || preg_match('/^(?:white|rose|yellow)-gold(?:-\d+)?$/', $slug) === 1;
        });

        $isMonaLisaRing = $tagSlugs->contains(
            fn ($slug) => preg_match('/^mona-?lisa(?:-\d+)?$/', $slug) === 1
        ) && $tagSlugs->contains(
            fn ($slug) => preg_match('/^rings?(?:-\d+)?$/', $slug) === 1
        );

        if ($hasExistingRingSizeTag || $isMonaLisaRing || $tagSlugs->contains($containsRingSegment)) {
            return true;
        }

        $productNames = [$this->name, $this->online_store_name];
        if (collect($productNames)->filter()->contains($containsRingSegment)) {
            return true;
        }

        $category = $this->relationLoaded('category')
            ? $this->category
            : $this->category()->first(['id', 'name', 'slug']);
        $subcategory = $this->relationLoaded('subcategory')
            ? $this->subcategory
            : $this->subcategory()->first(['id', 'name', 'slug']);

        return collect([
            $category?->name,
            $category?->slug,
            $subcategory?->name,
            $subcategory?->slug,
        ])->filter()->contains($containsRingSegment);
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

    public function isSeleneProduct(): bool
    {
        $subcategory = $this->subcategory;

        return strtolower(trim((string) ($subcategory?->slug))) === 'selene'
            || strtolower(trim((string) ($subcategory?->name))) === 'selene';
    }

    public function getShowPriceAttribute($value)
    {
        return $this->isSeleneProduct() ? false : $value;
    }

    public function goldService()
    {
        return $this->belongsTo(GoldServiceSetting::class, 'gold_service_id');
    }

    public function uaeGoldService()
    {
        return $this->belongsTo(GoldServiceSetting::class, 'uae_gold_service_id');
    }

    public function scopePinnedFirst($query)
    {
        return $query->orderByDesc('is_pinned');
    }

    public function marketName(?string $market = null): string
    {
        // UAE + English site: keep copy in English; Arabic locale uses UAE Arabic fields.
        if ($this->isUaeMarket($market) && app()->getLocale() === 'ar') {
            return filled($this->uae_name) ? $this->uae_name : ($this->name ?? '');
        }

        return $this->name ?? '';
    }

    /** Visible copy only. Empty editor HTML such as <p><br></p> does not count. */
    public static function plainText(?string $html): string
    {
        $text = html_entity_decode((string) $html, ENT_QUOTES | ENT_HTML5, 'UTF-8');
        $text = preg_replace('/[\x{FEFF}\x{200B}\x{200C}\x{200D}\x{2060}]/u', '', $text);
        $text = strip_tags($text);
        $text = str_replace("\xC2\xA0", ' ', $text);

        return trim((string) preg_replace('/\s+/u', ' ', $text));
    }

    public function marketDescription(?string $market = null): string
    {
        if ($this->isUaeMarket($market) && app()->getLocale() === 'ar' && static::plainText($this->uae_description) !== '') {
            return $this->uae_description;
        }

        return $this->description ?? '';
    }

    public function marketDiamondPrice(?string $market = null): float
    {
        if ($this->isUaeMarket($market) && filled($this->uae_diamond_price)) {
            return (float) $this->uae_diamond_price;
        }

        return (float) ($this->diamond_price ?? 0);
    }

    public function marketGoldWeight(?string $market = null): ?float
    {
        if ($this->isUaeMarket($market) && filled($this->uae_gold_weight)) {
            return (float) $this->uae_gold_weight;
        }

        return filled($this->gold_weight) ? (float) $this->gold_weight : null;
    }

    public function marketGoldServiceId(?string $market = null): ?int
    {
        if ($this->isUaeMarket($market) && filled($this->uae_gold_service_id)) {
            return (int) $this->uae_gold_service_id;
        }

        return filled($this->gold_service_id) ? (int) $this->gold_service_id : null;
    }

    public function marketCurrency(?string $market = null): string
    {
        return $this->isUaeMarket($market) ? 'AED' : 'PKR';
    }

    /**
     * Live-calculated price from any description text (same gold/diamond logic).
     * UAE/Arabic uses Manage Gold Rates UAE + falls back to stored price_aed.
     */
    public function finalPriceForDescription(?string $description, ?string $market = null): float
    {
        $market = $market ?? static::currentMarket();

        if ($this->isWatchProduct()) {
            $watchPrice = WatchPriceCalculator::calculateForProduct($this);

            return $watchPrice ?? (float) ($this->isUaeMarket($market)
                ? ($this->price_aed ?? 0)
                : ($this->attributes['price'] ?? 0));
        }

        $fallback = $this->isUaeMarket($market)
            ? (float) ($this->price_aed ?? 0)
            : (float) ($this->attributes['price'] ?? 0);

        if ($this->shouldUseDiamondPricing()) {
            $diamond = DiamondPriceCalculator::calculateFromDescription(
                $description ?? '',
                $this->marketDiamondPrice($market),
                $this->marketGoldWeight($market),
                $this->isUaeMarket($market) ? 'uae' : 'pk'
            );
            if ($diamond !== null) {
                return $diamond;
            }

            // Diamond tags do not use the gold-jewellery VAT formula.
            // Pakistan keeps its stored price. Dubai uses the gram price above.
            return $fallback;
        }

        if ($this->isUaeMarket($market)) {
            return $this->dubaiPriceFromStoredWeight($description ?? '', false) ?? $fallback;
        }

        $calculated = GoldPriceCalculator::calculateFromDescription(
            $description ?? '',
            $this->marketGoldWeight($market),
            $this->marketGoldServiceId($market),
            'pk'
        );

        if ($calculated !== null) {
            return $calculated;
        }

        return $fallback;
    }

    /**
     * Dubai price only when a Dubai weight is stored.
     * Description text such as "Gross Weight: 3.65g" is not a stored price.
     */
    protected function dubaiPriceFromStoredWeight(?string $description, bool $forStore): ?float
    {
        $weight = $forStore && filled($this->uae_online_store_gold_weight)
            ? (float) $this->uae_online_store_gold_weight
            : (filled($this->uae_gold_weight) ? (float) $this->uae_gold_weight : null);

        if ($weight === null || $weight <= 0) {
            return null;
        }

        $serviceId = $forStore && filled($this->uae_online_store_gold_service_id)
            ? (int) $this->uae_online_store_gold_service_id
            : (filled($this->uae_gold_service_id) ? (int) $this->uae_gold_service_id : null);

        $calculated = GoldPriceCalculator::calculateFromDescription(
            $description ?? '',
            $weight,
            $serviceId,
            'uae'
        );

        if ($calculated === null && static::plainText($this->storefrontDescription()) !== '') {
            $calculated = GoldPriceCalculator::calculateFromDescription(
                $this->storefrontDescription(),
                $weight,
                $serviceId,
                'uae'
            );
        }

        return $calculated;
    }

    /**
     * Live-calculated price: diamond (tagged) or gold from description, else stored price.
     */
    public function getFinalPriceAttribute(): float
    {
        $market = static::currentMarket();

        return $this->finalPriceForDescription($this->marketDescription($market), $market);
    }

    /** Online store name when set, otherwise default product name (market-aware). */
    public function storefrontName(): string
    {
        if ($this->isUaeMarket() && app()->getLocale() === 'ar') {
            if (filled($this->uae_online_store_name)) {
                return $this->uae_online_store_name;
            }
            if (filled($this->online_store_name)) {
                return $this->online_store_name;
            }

            return $this->marketName();
        }

        return filled($this->online_store_name) ? $this->online_store_name : $this->marketName();
    }

    /** Online store description when set, otherwise default description (market-aware). */
    public function storefrontDescription(): string
    {
        if ($this->isUaeMarket() && app()->getLocale() === 'ar') {
            if (static::plainText($this->uae_online_store_description) !== '') {
                return $this->uae_online_store_description;
            }
            if (static::plainText($this->online_store_description) !== '') {
                return $this->online_store_description;
            }

            return $this->marketDescription();
        }

        return static::plainText($this->online_store_description) !== ''
            ? $this->online_store_description
            : $this->marketDescription();
    }

    /** Live price for online shopping store (Pakistan PKR / UAE AED separate). */
    public function getStorefrontPriceAttribute(): float
    {
        $market = static::currentMarket();

        if ($this->isUaeMarket($market)) {
            if ($this->isWatchProduct()) {
                return $this->finalPriceForDescription($this->storefrontDescription(), 'uae');
            }

            // Dubai weight only. A weight written in the description is not a stored price.
            $goldWeight = filled($this->uae_online_store_gold_weight)
                ? (float) $this->uae_online_store_gold_weight
                : (filled($this->uae_gold_weight) ? (float) $this->uae_gold_weight : null);
            $diamondPrice = filled($this->uae_online_store_diamond_price)
                ? (float) $this->uae_online_store_diamond_price
                : $this->marketDiamondPrice('uae');

            if ($this->shouldUseDiamondPricing()) {
                $diamond = DiamondPriceCalculator::calculateFromDescription(
                    $this->storefrontDescription(),
                    $diamondPrice,
                    $goldWeight,
                    'uae'
                );
                if ($diamond !== null) {
                    return $diamond;
                }
            } else {
                $calculated = $this->dubaiPriceFromStoredWeight($this->storefrontDescription(), true);
                if ($calculated !== null) {
                    return $calculated;
                }
            }

            if (filled($this->online_store_price_aed) && (float) $this->online_store_price_aed > 0) {
                return (float) $this->online_store_price_aed;
            }

            return (float) ($this->price_aed ?? 0);
        }

        if ($this->isWatchProduct()) {
            return $this->finalPriceForDescription($this->storefrontDescription(), 'pk');
        }

        $goldWeight = filled($this->online_store_gold_weight)
            ? (float) $this->online_store_gold_weight
            : $this->marketGoldWeight('pk');
        $serviceId = filled($this->online_store_gold_service_id)
            ? (int) $this->online_store_gold_service_id
            : $this->marketGoldServiceId('pk');
        $diamondPrice = filled($this->online_store_diamond_price)
            ? (float) $this->online_store_diamond_price
            : $this->marketDiamondPrice('pk');

        if ($this->shouldUseDiamondPricing()) {
            $diamond = DiamondPriceCalculator::calculateFromDescription(
                $this->storefrontDescription(),
                $diamondPrice,
                $goldWeight,
                'pk'
            );
            if ($diamond !== null) {
                return $diamond;
            }
        } else {
            $calculated = GoldPriceCalculator::calculateFromDescription(
                $this->storefrontDescription(),
                $goldWeight,
                $serviceId,
                'pk'
            );
            if ($calculated !== null) {
                return $calculated;
            }
        }

        if (filled($this->online_store_price) && (float) $this->online_store_price > 0) {
            return (float) $this->online_store_price;
        }

        return (float) ($this->attributes['price'] ?? 0);
    }

    public function displayName(bool $forStore = false): string
    {
        return $forStore ? $this->storefrontName() : $this->marketName();
    }

    public function displayDescription(bool $forStore = false): string
    {
        return $forStore ? $this->storefrontDescription() : $this->marketDescription();
    }

    public function displayPrice(bool $forStore = false): float
    {
        return $forStore ? $this->storefront_price : $this->final_price;
    }

    public function displayCurrency(bool $forStore = false): string
    {
        if ($forStore) {
            return $this->marketCurrency();
        }

        return $this->marketCurrency();
    }

    /**
     * Regular and sale prices for a gold product, used when both must be displayed.
     * When $forStore is true, uses the same online-store weight/service as storefront_price.
     *
     * @return array{regular_price: float, sale_price: float, final_price: float, is_sale: bool}|null
     */
    public function goldPriceBreakdown(bool $forStore = false): ?array
    {
        if ($this->isWatchProduct() || $this->shouldUseDiamondPricing()) {
            return null;
        }

        $market = static::currentMarket();
        $marketKey = $this->isUaeMarket($market) ? 'uae' : 'pk';

        if ($forStore) {
            // Same online weight/service as storefront_price (UAE → Dubai rates/services).
            if ($marketKey === 'uae') {
                $goldWeight = filled($this->uae_online_store_gold_weight)
                    ? (float) $this->uae_online_store_gold_weight
                    : (filled($this->uae_gold_weight) ? (float) $this->uae_gold_weight : null);
                if ($goldWeight === null || $goldWeight <= 0) {
                    return null;
                }
                $serviceId = filled($this->uae_online_store_gold_service_id)
                    ? (int) $this->uae_online_store_gold_service_id
                    : (filled($this->uae_gold_service_id) ? (int) $this->uae_gold_service_id : null);
            } else {
                $goldWeight = filled($this->online_store_gold_weight)
                    ? (float) $this->online_store_gold_weight
                    : $this->marketGoldWeight('pk');
                $serviceId = filled($this->online_store_gold_service_id)
                    ? (int) $this->online_store_gold_service_id
                    : $this->marketGoldServiceId('pk');
            }

            return GoldPriceCalculator::calculateBreakdownFromDescription(
                $this->displayDescription(true),
                $goldWeight,
                $serviceId,
                $marketKey
            );
        }

        if ($marketKey === 'uae') {
            if (! filled($this->uae_gold_weight) || (float) $this->uae_gold_weight <= 0) {
                return null;
            }

            return GoldPriceCalculator::calculateBreakdownFromDescription(
                $this->displayDescription(false),
                (float) $this->uae_gold_weight,
                filled($this->uae_gold_service_id) ? (int) $this->uae_gold_service_id : null,
                'uae'
            );
        }

        return GoldPriceCalculator::calculateBreakdownFromDescription(
            $this->displayDescription(false),
            $this->marketGoldWeight('pk'),
            $this->marketGoldServiceId('pk'),
            'pk'
        );
    }

    public function isWatchProduct(): bool
    {
        if (str_contains(strtolower($this->name ?? ''), 'watch')) {
            return true;
        }

        $category = $this->relationLoaded('category')
            ? $this->category
            : $this->category()->first();

        if (!$category) {
            return false;
        }

        return str_contains(strtolower($category->name ?? ''), 'watch')
            || str_contains(strtolower($category->slug ?? ''), 'watch');
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
