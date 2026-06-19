<?php

namespace App\Services;

use App\Models\Products;
use App\Models\Subcategory;
use Illuminate\Support\Str;

class ProductSearchService
{
    public function itemsForCurrentPage(): array
    {
        $context = $this->resolveContext();
        $collectionSlug = $context === 'collection' ? request()->segment(2) : null;

        $query = Products::with('images')
            ->where('status', 'published')
            ->select(
                'id',
                'name',
                'online_store_name',
                'slug',
                'image',
                'hover_image',
                'description',
                'online_store_description',
                'subcategory_id'
            )
            ->orderBy('name');

        if ($context === 'collection' && filled($collectionSlug)) {
            $subcategory = Subcategory::where('slug', $collectionSlug)->first();
            if ($subcategory) {
                $query->where('subcategory_id', $subcategory->id);
            }
        }

        $forStore = $context === 'store';

        return $query->get()
            ->map(fn (Products $product) => $this->mapProduct($product, $forStore))
            ->values()
            ->all();
    }

    private function resolveContext(): string
    {
        if (request()->boolean('store') || request()->is('collections/online-shopping-store*')) {
            return 'store';
        }

        if (request()->is('collections/*')) {
            return 'collection';
        }

        return 'general';
    }

    private function mapProduct(Products $product, bool $forStore): array
    {
        $relatedImage = optional($product->images)->firstWhere('image', '!=', null)->image ?? null;
        $imagePath = $relatedImage ?: $product->hover_image ?: $product->image;
        $label = $forStore ? $product->storefrontName() : ($product->name ?? '');
        $description = $forStore ? $product->storefrontDescription() : ($product->description ?? '');

        $searchParts = $forStore
            ? [$product->name, $product->online_store_name, $product->slug, strip_tags($product->description ?? ''), strip_tags($product->online_store_description ?? '')]
            : [$product->name, $product->slug, strip_tags($product->description ?? '')];

        $url = route('product.details', ['slug' => $product->slug]);
        if ($forStore) {
            $url .= '?store=1';
        }

        return [
            'label' => $label,
            'slug' => $product->slug,
            'image' => $imagePath ? asset($imagePath) : asset('assets/f_assets/image/logo.png'),
            'subtitle' => Str::limit(strip_tags($description), 60, '…'),
            'url' => $url,
            'searchText' => strtolower(implode(' ', array_filter($searchParts))),
            'type' => 'product',
        ];
    }
}
