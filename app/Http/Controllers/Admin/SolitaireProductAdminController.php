<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SolitaireProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Symfony\Component\Process\Process;

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
            'slug' => 'nullable|string|max:255',

            'gallery_images.*' => 'nullable|image|mimes:jpg,jpeg,png,webp',

            'metal_image_codes.*' => 'nullable|string|max:100',
            'metal_image_files.*.*' => 'nullable|image|mimes:jpg,jpeg,png,webp',
            'metal_video_files.*' => 'nullable|file|mimes:mp4,mov,avi,webm,m4v|max:512000',
            'shape' => 'nullable|in:oval,princess,round',
        ]);

        $product = SolitaireProduct::create([
            'name' => $request->name,
            'slug' => $this->makeUniqueSlug($request->name, $request->slug),
            'sku' => $request->sku,
            'tag_label' => $request->tag_label,
            'short_description' => $request->short_description,
            'currency' => $request->currency ?? 'PKR',
            'shape' => $request->shape,

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
            'slug' => 'nullable|string|max:255',

            'gallery_images.*' => 'nullable|image|mimes:jpg,jpeg,png,webp',

            'metal_image_codes.*' => 'nullable|string|max:100',
            'metal_image_files.*.*' => 'nullable|image|mimes:jpg,jpeg,png,webp',
            'metal_video_files.*' => 'nullable|file|mimes:mp4,mov,avi,webm,m4v|max:512000',
            'shape' => 'nullable|in:oval,princess,round',
        ]);

        $oldGalleryImages = $product->gallery_images ?? [];
        $oldMetalImages = $product->metal_images ?? [];

        /*
            These two fields come from hidden textarea/input in form.blade.php.
            When user clicks X on image, JS removes image from these JSON values.
        */
        $keptGalleryImages = $this->decodeJsonInput(
            $request->input('existing_gallery_images'),
            $oldGalleryImages
        );

        $keptMetalImages = $this->decodeJsonInput(
            $request->input('existing_metal_images'),
            $oldMetalImages
        );

        $newGalleryImages = $this->storeGalleryImages($request);
        $newMetalImages = $this->storeMetalImages($request);

        $finalGalleryImages = array_values(array_merge(
            $keptGalleryImages,
            $newGalleryImages
        ));

        $finalMetalImages = $this->normalizeMetalImageOrder($this->mergeMetalImages(
            $keptMetalImages,
            $newMetalImages
        ));

        /*
            Delete files which were removed from JSON.
        */
        $this->deleteRemovedGalleryFiles($oldGalleryImages, $finalGalleryImages);
        $this->deleteRemovedMetalFiles($oldMetalImages, $finalMetalImages);
        $this->deleteRemovedMetalFrameFolders($oldMetalImages, $finalMetalImages);

        $product->update([
            'name' => $request->name,
            'slug' => $this->makeUniqueSlug($request->name, $request->slug, $product->id),
            'sku' => $request->sku,
            'tag_label' => $request->tag_label,
            'short_description' => $request->short_description,
            'currency' => $request->currency ?? 'PKR',
            'shape' => $request->shape,
            'gallery_images' => $finalGalleryImages,
            'metals' => $this->cleanMetals($request->metals ?? []),
            'diamond_carats' => $this->cleanDiamondCarats($request->diamond_carats ?? []),
            'metal_images' => $finalMetalImages,
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

        $this->deleteAllProductFiles($product);

        $product->delete();

        return redirect()
            ->route('admin.solitaire-products.index')
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
        $metalVideoFiles = $request->file('metal_video_files', []);

        foreach ($metalCodes as $index => $metalCode) {
            if (empty($metalCode)) {
                continue;
            }

            $cleanMetalCode = Str::slug($metalCode, '_');

            $images = [];

            foreach (($metalFiles[$index] ?? []) as $fileIndex => $file) {
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

            $videoData = null;

            if (!empty($metalVideoFiles[$index]) && $metalVideoFiles[$index]->isValid()) {
                $videoData = $this->storeMetalVideoFrames($metalVideoFiles[$index], $cleanMetalCode);
            }

            if (!empty($images) || !empty($videoData)) {
                $group = [
                    'metal_code' => $cleanMetalCode,
                    'images' => $images,
                ];

                if (!empty($videoData)) {
                    $group['video'] = $videoData['video'];
                    $group['frames'] = $videoData['frames'];
                }

                $metalImages[] = $group;
            }
        }

        return $metalImages;
    }

    private function storeMetalVideoFrames($file, string $cleanMetalCode): array
    {
        $baseFolder = 'uploads/solitaire-products/metals/' . $cleanMetalCode;
        $videoFolder = $baseFolder . '/videos';
        $framesFolder = $baseFolder . '/frames/' . time() . '_' . uniqid();

        $videoDestinationPath = public_path($videoFolder);
        $framesDestinationPath = public_path($framesFolder);

        if (!is_dir($videoDestinationPath)) {
            mkdir($videoDestinationPath, 0755, true);
        }

        if (!is_dir($framesDestinationPath)) {
            mkdir($framesDestinationPath, 0755, true);
        }

        $videoFilename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
        $file->move($videoDestinationPath, $videoFilename);

        $videoPath = $videoFolder . '/' . $videoFilename;
        $outputPattern = $framesDestinationPath . DIRECTORY_SEPARATOR . 'frame_%03d.jpg';
        $ffmpegBinary = env('FFMPEG_BINARY', 'ffmpeg');

        $process = new Process([
            $ffmpegBinary,
            '-y',
            '-i',
            public_path($videoPath),
            '-vf',
            'fps=12,scale=900:-1',
            '-q:v',
            '2',
            $outputPattern,
        ]);

        $process->setTimeout(300);
        $process->run();

        if (!$process->isSuccessful()) {
            $this->deletePublicFile($videoPath);
            $this->deletePublicDirectory($framesFolder);

            throw ValidationException::withMessages([
                'metal_video_files' => 'FFmpeg could not convert the uploaded metal video. Make sure FFmpeg is installed and the video file is valid.',
            ]);
        }

        $frameCount = count(glob($framesDestinationPath . DIRECTORY_SEPARATOR . 'frame_*.jpg') ?: []);

        if ($frameCount === 0) {
            $this->deletePublicFile($videoPath);
            $this->deletePublicDirectory($framesFolder);

            throw ValidationException::withMessages([
                'metal_video_files' => 'The uploaded metal video did not produce any frames.',
            ]);
        }

        return [
            'video' => [
                'video_path' => $videoPath,
                'original_name' => $file->getClientOriginalName(),
            ],
            'frames' => [
                'folder' => $framesFolder,
                'frame_count' => $frameCount,
                'extension' => 'jpg',
                'source_fps' => 12,
                'first_frame' => $framesFolder . '/frame_001.jpg',
            ],
        ];
    }

    private function mergeMetalImages(array $existing, array $new): array
    {
        foreach ($new as $newGroup) {
            if (
                empty($newGroup['metal_code'])
                || (empty($newGroup['images']) && empty($newGroup['frames']))
            ) {
                continue;
            }

            $found = false;

            foreach ($existing as &$existingGroup) {
                if (($existingGroup['metal_code'] ?? null) === $newGroup['metal_code']) {
                    $existingGroup['images'] = array_values(array_merge(
                        $existingGroup['images'] ?? [],
                        $newGroup['images'] ?? []
                    ));

                    if (!empty($newGroup['video'])) {
                        $existingGroup['video'] = $newGroup['video'];
                    }

                    if (!empty($newGroup['frames'])) {
                        $existingGroup['frames'] = $newGroup['frames'];
                    }

                    $found = true;
                    break;
                }
            }

            if (!$found) {
                $existing[] = $newGroup;
            }
        }

        return array_values(array_filter($existing, function ($group) {
            return !empty($group['metal_code'])
                && (!empty($group['images']) || !empty($group['frames']));
        }));
    }

    private function normalizeMetalImageOrder(array $groups): array
    {
        foreach ($groups as &$group) {
            if (empty($group['images']) || !is_array($group['images'])) {
                $group['images'] = [];
                continue;
            }

            $group['images'] = array_values($group['images']);

            foreach ($group['images'] as $index => &$image) {
                $image['sort_order'] = $index + 1;
            }
        }

        return array_values($groups);
    }

    private function cleanMetals(array $metals): array
    {
        return collect($metals)
            ->filter(function ($metal) {
                return !empty($metal['code']) && !empty($metal['name']);
            })
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
            ->filter(function ($carat) {
                return !empty($carat['value']);
            })
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
            ->filter(function ($variant) {
                return !empty($variant['metal_code'])
                    && !empty($variant['diamond_carat'])
                    && isset($variant['price']);
            })
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

    private function makeUniqueSlug(string $name, ?string $slug = null, ?int $ignoreId = null): string
    {
        $baseSlug = Str::slug($slug ?: $name);

        if (!$baseSlug) {
            $baseSlug = 'solitaire-product';
        }

        $finalSlug = $baseSlug;
        $counter = 2;

        while (
            SolitaireProduct::where('slug', $finalSlug)
                ->when($ignoreId, function ($query) use ($ignoreId) {
                    $query->where('id', '!=', $ignoreId);
                })
                ->exists()
        ) {
            $finalSlug = $baseSlug . '-' . $counter;
            $counter++;
        }

        return $finalSlug;
    }

    private function decodeJsonInput(?string $json, array $fallback = []): array
    {
        if ($json === null || $json === '') {
            return $fallback;
        }

        $decoded = json_decode($json, true);

        return is_array($decoded) ? $decoded : $fallback;
    }

    private function deleteRemovedGalleryFiles(array $oldImages, array $newImages): void
    {
        $oldPaths = collect($oldImages)
            ->pluck('image_path')
            ->filter()
            ->values()
            ->toArray();

        $newPaths = collect($newImages)
            ->pluck('image_path')
            ->filter()
            ->values()
            ->toArray();

        foreach (array_diff($oldPaths, $newPaths) as $path) {
            $this->deletePublicFile($path);
        }
    }

    private function deleteRemovedMetalFiles(array $oldGroups, array $newGroups): void
    {
        $oldPaths = $this->extractMetalImagePaths($oldGroups);
        $newPaths = $this->extractMetalImagePaths($newGroups);

        foreach (array_diff($oldPaths, $newPaths) as $path) {
            $this->deletePublicFile($path);
        }
    }

    private function deleteRemovedMetalFrameFolders(array $oldGroups, array $newGroups): void
    {
        $oldFolders = $this->extractMetalFrameFolders($oldGroups);
        $newFolders = $this->extractMetalFrameFolders($newGroups);

        foreach (array_diff($oldFolders, $newFolders) as $folder) {
            $this->deletePublicDirectory($folder);
        }
    }

    private function extractMetalImagePaths(array $groups): array
    {
        $paths = [];

        foreach ($groups as $group) {
            foreach (($group['images'] ?? []) as $image) {
                if (!empty($image['image_path'])) {
                    $paths[] = $image['image_path'];
                }
            }

            if (!empty($group['video']['video_path'])) {
                $paths[] = $group['video']['video_path'];
            }
        }

        return array_values(array_filter($paths));
    }

    private function extractMetalFrameFolders(array $groups): array
    {
        $folders = [];

        foreach ($groups as $group) {
            if (!empty($group['frames']['folder'])) {
                $folders[] = $group['frames']['folder'];
            }
        }

        return array_values(array_filter($folders));
    }

    private function deleteAllProductFiles(SolitaireProduct $product): void
    {
        foreach (($product->gallery_images ?? []) as $image) {
            if (!empty($image['image_path'])) {
                $this->deletePublicFile($image['image_path']);
            }
        }

        foreach (($product->metal_images ?? []) as $group) {
            foreach (($group['images'] ?? []) as $image) {
                if (!empty($image['image_path'])) {
                    $this->deletePublicFile($image['image_path']);
                }
            }

            if (!empty($group['video']['video_path'])) {
                $this->deletePublicFile($group['video']['video_path']);
            }

            if (!empty($group['frames']['folder'])) {
                $this->deletePublicDirectory($group['frames']['folder']);
            }
        }
    }

    private function deletePublicFile(?string $path): void
    {
        if (!$path) {
            return;
        }

        /*
            Safety check:
            only delete files from your solitaire uploads folder.
        */
        if (!Str::startsWith($path, 'uploads/solitaire-products/')) {
            return;
        }

        $fullPath = public_path($path);

        if (file_exists($fullPath)) {
            @unlink($fullPath);
        }
    }

    private function deletePublicDirectory(?string $path): void
    {
        if (!$path || !Str::startsWith($path, 'uploads/solitaire-products/')) {
            return;
        }

        $fullPath = public_path($path);

        if (!is_dir($fullPath)) {
            return;
        }

        $items = new \RecursiveIteratorIterator(
            new \RecursiveDirectoryIterator($fullPath, \FilesystemIterator::SKIP_DOTS),
            \RecursiveIteratorIterator::CHILD_FIRST
        );

        foreach ($items as $item) {
            $item->isDir() ? @rmdir($item->getRealPath()) : @unlink($item->getRealPath());
        }

        @rmdir($fullPath);
    }
}
