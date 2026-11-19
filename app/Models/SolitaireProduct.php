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
        'uae_name',
        'slug',
        'sku',
        'tag_label',
        'uae_tag_label',
        'short_description',
        'uae_short_description',
        'currency',
        'gallery_images',
        'metals',
        'diamond_carats',
        'metal_images',
        'variants',
        'default_metal_code',
        'default_diamond_carat',
        'status',
        'shape',
    ];

    protected $casts = [
        'gallery_images' => 'array',
        'metals' => 'array',
        'diamond_carats' => 'array',
        'metal_images' => 'array',
        'variants' => 'array',
        'status' => 'boolean',
    ];

    public function isUaeStorefront(): bool
    {
        return Products::currentMarket() === 'uae';
    }

    public function usesArabicCopy(): bool
    {
        return app()->getLocale() === 'ar';
    }

    public function displayName(): string
    {
        if ($this->usesArabicCopy() && filled($this->uae_name)) {
            return $this->uae_name;
        }

        return (string) ($this->name ?? '');
    }

    public function displayTag(): string
    {
        if ($this->usesArabicCopy() && filled($this->uae_tag_label)) {
            return $this->uae_tag_label;
        }

        return (string) ($this->tag_label ?: 'Lab Created');
    }

    public function displayDescription(): string
    {
        if ($this->usesArabicCopy() && filled($this->uae_short_description)) {
            return $this->uae_short_description;
        }

        return (string) ($this->short_description ?? '');
    }

    public function displayCurrency(): string
    {
        return $this->isUaeStorefront() ? 'AED' : (string) ($this->currency ?: 'PKR');
    }

    public function displayShape(): string
    {
        $shape = strtolower((string) ($this->shape ?: 'oval'));
        $key = 'site.shape_'.$shape;

        return __($key) !== $key ? __($key) : ucfirst($shape);
    }

    public function displayMetalName(array $metal): string
    {
        if ($this->usesArabicCopy() && filled($metal['name_ar'] ?? null)) {
            return (string) $metal['name_ar'];
        }

        return (string) ($metal['name'] ?? ($metal['short_label'] ?? ''));
    }

    public function marketAmount(array $variant, string $field): ?float
    {
        if ($this->isUaeStorefront()) {
            $aed = $variant[$field.'_aed'] ?? null;
            if ($aed !== null && $aed !== '') {
                return (float) $aed;
            }
        }

        $amount = $variant[$field] ?? null;

        return ($amount === null || $amount === '') ? null : (float) $amount;
    }

    public function presentVariant(array $variant): array
    {
        $variant['price'] = $this->marketAmount($variant, 'price');
        $variant['old_price'] = $this->marketAmount($variant, 'old_price');

        return $variant;
    }

    public function presentMetal(array $metal): array
    {
        $metal['name'] = $this->displayMetalName($metal);

        return $metal;
    }
}