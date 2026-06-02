<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SolitaireProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SolitaireProductAdminController extends Controller
{
    public function index()
    {
        $products = SolitaireProduct::latest()->paginate(20);

        return view('admin.solitaire-products.index', compact('products'));
    }

    public function create()
    {
        $product = new SolitaireProduct();

        return view('admin.solitaire-products.create', compact('product'));
    }

    public function store(Request $request)
    {
        $request->validate([
           'name' => 'required|string|max:255',
    'slug' => 'nullable|string|max:255|unique:solitaire_products,slug',

    'gallery_images.*' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',

    'metal_image_codes.*' => 'nullable|string|max:100',
    'metal_image_files.*.*' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
        ]);

        $slug = $request->slug ?: Str::slug($request->name);

        $product = SolitaireProduct::create([
            'name' => $request->name,
            'slug' => $slug,
            'sku' => $request->sku,
            'tag_label' => $request->tag_label,
            'short_description' => $request->short_description,
            'currency' => $request->currency ?? 'AED',

            'gallery_images' => $this->storeGalleryImages($request),
            'metals' => $this->cleanMetals($request->metals ?? []),
            'diamond_carats' => $this->cleanDiamondCarats($request->diamond_carats ?? []),
            'metal_images' => $this->storeMetalImages($request),
            'variants' => $this->cleanVariants($request->variants ?? []),

            'default_metal_code' => $request->default_metal_code,
            'default_diamond_carat' => $request->default_diamond_carat,

            'status' => $request->has('status') ? 1 : 0,
        ]);

        return redirect()
            ->route('solitaire-products.edit', $product->id)
            ->with('success', 'Solitaire product created successfully.');
    }

    public function edit($id)
    {
        $product = SolitaireProduct::findOrFail($id);

        return view('admin.solitaire-products.edit', compact('product'));
    }

    public function update(Request $request, $id)
    {
        $product = SolitaireProduct::findOrFail($id);

        $request->validate([
          'name' => 'required|string|max:255',
    'slug' => 'nullable|string|max:255|unique:solitaire_products,slug,' . $product->id,

    'gallery_images.*' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',

    'metal_image_codes.*' => 'nullable|string|max:100',
    'metal_image_files.*.*' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
        ]);

        $existingGallery = $product->gallery_images ?? [];
        $newGallery = $this->storeGalleryImages($request);

        $existingMetalImages = $product->metal_images ?? [];
        $newMetalImages = $this->storeMetalImages($request);

        $product->update([
            'name' => $request->name,
            'slug' => $request->slug ?: Str::slug($request->name),
            'sku' => $request->sku,
            'tag_label' => $request->tag_label,
            'short_description' => $request->short_description,
            'currency' => $request->currency ?? 'AED',

            'gallery_images' => array_merge($existingGallery, $newGallery),
            'metals' => $this->cleanMetals($request->metals ?? []),
            'diamond_carats' => $this->cleanDiamondCarats($request->diamond_carats ?? []),
            'metal_images' => $this->mergeMetalImages($existingMetalImages, $newMetalImages),
            'variants' => $this->cleanVariants($request->variants ?? []),

            'default_metal_code' => $request->default_metal_code,
            'default_diamond_carat' => $request->default_diamond_carat,

            'status' => $request->has('status') ? 1 : 0,
        ]);

        return back()->with('success', 'Solitaire product updated successfully.');
    }

    public function destroy($id)
    {
        $product = SolitaireProduct::findOrFail($id);

        $product->delete();

        return redirect()
            ->route('solitaire-products.index')
            ->with('success', 'Solitaire product deleted successfully.');
    }

  private function storeGalleryImages(Request $request): array
{
    $images = [];

    if (!$request->hasFile('gallery_images')) {
        return $images;
    }

    foreach ($request->file('gallery_images') as $index => $file) {
        if (!$file || !$file->isValid()) {
            continue;
        }

        $folder = 'uploads/solitaire-products/gallery';
        $destinationPath = public_path($folder);

        if (!is_dir($destinationPath)) {
            mkdir($destinationPath, 0755, true);
        }

        $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

        $file->move($destinationPath, $filename);

        $images[] = [
            'image_path' => $folder . '/' . $filename,
            'alt_text' => $request->gallery_alt_text[$index] ?? null,
            'sort_order' => $index + 1,
            'is_primary' => false,
        ];
    }

    return $images;
}
private function storeMetalImages(Request $request): array
{
    $metalImages = [];

    $metalCodes = $request->input('metal_image_codes', []);
    $metalFiles = $request->file('metal_image_files', []);

    foreach ($metalCodes as $index => $metalCode) {
        if (empty($metalCode)) {
            continue;
        }

        if (empty($metalFiles[$index])) {
            continue;
        }

        $cleanMetalCode = Str::slug($metalCode, '_');
        $images = [];

        foreach ($metalFiles[$index] as $fileIndex => $file) {
            if (!$file || !$file->isValid()) {
                continue;
            }

            $folder = 'uploads/solitaire-products/metals/' . $cleanMetalCode;
            $destinationPath = public_path($folder);

            if (!is_dir($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

            $file->move($destinationPath, $filename);

            $images[] = [
                'image_path' => $folder . '/' . $filename,
                'alt_text' => $cleanMetalCode . ' image',
                'sort_order' => $fileIndex + 1,
            ];
        }

        if (!empty($images)) {
            $metalImages[] = [
                'metal_code' => $cleanMetalCode,
                'images' => $images,
            ];
        }
    }

    return $metalImages;
}

    private function mergeMetalImages(array $existing, array $new): array
    {
        foreach ($new as $newGroup) {
            $found = false;

            foreach ($existing as &$existingGroup) {
                if (($existingGroup['metal_code'] ?? null) === $newGroup['metal_code']) {
                    $existingGroup['images'] = array_merge(
                        $existingGroup['images'] ?? [],
                        $newGroup['images'] ?? []
                    );

                    $found = true;
                    break;
                }
            }

            if (!$found) {
                $existing[] = $newGroup;
            }
        }

        return $existing;
    }

    private function cleanMetals(array $metals): array
    {
        return collect($metals)
            ->filter(fn ($metal) => !empty($metal['code']) && !empty($metal['name']))
            ->map(function ($metal) {
                return [
                    'code' => Str::slug($metal['code'], '_'),
                    'name' => $metal['name'] ?? '',
                    'short_label' => $metal['short_label'] ?? '',
                    'purity' => $metal['purity'] ?? '',
                    'tone' => $metal['tone'] ?? '',
                    'hex_color' => $metal['hex_color'] ?? '',
                ];
            })
            ->values()
            ->toArray();
    }

    private function cleanDiamondCarats(array $carats): array
    {
        return collect($carats)
            ->filter(fn ($carat) => !empty($carat['value']))
            ->map(function ($carat) {
                return [
                    'label' => $carat['label'] ?? $carat['value'],
                    'value' => number_format((float) $carat['value'], 2, '.', ''),
                ];
            })
            ->values()
            ->toArray();
    }

    private function cleanVariants(array $variants): array
    {
        return collect($variants)
            ->filter(fn ($variant) =>
                !empty($variant['metal_code']) &&
                !empty($variant['diamond_carat']) &&
                isset($variant['price'])
            )
            ->map(function ($variant) {
                return [
                    'metal_code' => Str::slug($variant['metal_code'], '_'),
                    'diamond_carat' => number_format((float) $variant['diamond_carat'], 2, '.', ''),
                    'variant_sku' => $variant['variant_sku'] ?? null,
                    'old_price' => $variant['old_price'] ?? null,
                    'price' => $variant['price'] ?? 0,
                    'discount_percent' => $variant['discount_percent'] ?? null,
                    'stock' => $variant['stock'] ?? 0,
                    'is_default' => !empty($variant['is_default']),
                    'status' => !empty($variant['status']),
                ];
            })
            ->values()
            ->toArray();
    }
}