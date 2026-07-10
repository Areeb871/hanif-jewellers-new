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
        $forStore = $context === 'store';

        $collections = Subcategory::query()
            ->whereIn('status', $this->publishedCollectionStatuses())
            ->select('id', 'name', 'slug', 'description', 'image', 'status')
            ->orderBy('name')
            ->get()
            ->map(fn (Subcategory $subcategory) => $this->mapCollection($subcategory));

        $products = Products::with('images')
            ->where('status', 'published')
            ->whereHas('subcategory', function ($query) {
                $query->whereIn('status', $this->publishedCollectionStatuses());
            })
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
            ->orderBy('name')
            ->get()
            ->map(fn (Products $product) => $this->mapProduct($product, $forStore))
            ->values();

        return $collections
            ->merge($products)
            ->values()
            ->all();
    }

    private function publishedCollectionStatuses(): array
    {
        return ['published', 'active'];
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
            'subtitle' => Str::limit(strip_tags($description), 60, '...'),
            'url' => $url,
            'searchText' => strtolower(implode(' ', array_filter($searchParts))),
            'type' => 'product',
        ];
    }

    private function mapCollection(Subcategory $subcategory): array
    {
        $description = strip_tags($subcategory->description ?? '');
        $imagePath = $subcategory->image;

        return [
            'label' => $subcategory->name ?? '',
            'slug' => $subcategory->slug,
            'image' => $imagePath ? asset($imagePath) : asset('assets/f_assets/image/logo.png'),
            'subtitle' => Str::limit($description, 60, '...'),
            'url' => route('subcategory', ['subcategory' => $subcategory->slug]),
            'searchText' => strtolower(implode(' ', array_filter([
                $subcategory->name,
                $subcategory->slug,
                $description,
            ]))),
            'type' => 'collection',
        ];
    }
}
