<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Review;

use Illuminate\Support\Str;

class ReviewController extends Controller
{
    public function index()
    {
        $reviews = Review::latest()->paginate(20);

        return view('admin.reviews.index', compact('reviews'));
    }

    public function create()
    {
        $review = new Review();

        return view('admin.reviews.create', compact('review'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'main_title' => 'nullable|string|max:255',
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string',

            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
            'images.*' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
        ]);

        Review::create([
            'main_title' => $request->main_title,
            'title' => $request->title,
            'description' => $request->description,
            'image' => $this->storeMainImage($request),
            'images' => $this->storeGalleryImages($request),
            'status' => $request->has('status') ? 1 : 0,
        ]);

        return redirect()
            ->route('reviews.index')
            ->with('success', 'Review created successfully.');
    }

    public function edit($id)
    {
        $review = Review::findOrFail($id);

        return view('admin.reviews.edit', compact('review'));
    }

    public function update(Request $request, $id)
    {
        $review = Review::findOrFail($id);

        $request->validate([
            'main_title' => 'nullable|string|max:255',
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string',

            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
            'images.*' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
        ]);

        $oldMainImage = $review->image;
        $oldGalleryImages = $review->images ?? [];

        $mainImage = $oldMainImage;

        if ($request->hasFile('image')) {
            $mainImage = $this->storeMainImage($request);
            $this->deletePublicFile($oldMainImage);
        }

        $keptGalleryImages = $this->decodeJsonInput(
            $request->input('existing_images'),
            $oldGalleryImages
        );

        $newGalleryImages = $this->storeGalleryImages($request);

        $finalGalleryImages = array_values(array_merge(
            $keptGalleryImages,
            $newGalleryImages
        ));

        $this->deleteRemovedGalleryFiles($oldGalleryImages, $finalGalleryImages);

        $review->update([
            'main_title' => $request->main_title,
            'title' => $request->title,
            'description' => $request->description,
            'image' => $mainImage,
            'images' => $finalGalleryImages,
            'status' => $request->has('status') ? 1 : 0,
        ]);

        return back()->with('success', 'Review updated successfully.');
    }

    public function destroy($id)
    {
        $review = Review::findOrFail($id);

        $this->deletePublicFile($review->image);

        foreach (($review->images ?? []) as $image) {
            $this->deletePublicFile($image['image_path'] ?? null);
        }

        $review->delete();

        return redirect()
            ->route('reviews.index')
            ->with('success', 'Review deleted successfully.');
    }

    private function storeMainImage(Request $request): ?string
    {
        if (!$request->hasFile('image')) {
            return null;
        }

        $file = $request->file('image');

        if (!$file || !$file->isValid()) {
            return null;
        }

        $folder = 'uploads/reviews/main';
        $destinationPath = public_path($folder);

        if (!is_dir($destinationPath)) {
            mkdir($destinationPath, 0755, true);
        }

        $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

        $file->move($destinationPath, $filename);

        return $folder . '/' . $filename;
    }

    private function storeGalleryImages(Request $request): array
    {
        $images = [];

        if (!$request->hasFile('images')) {
            return $images;
        }

        foreach ($request->file('images') as $index => $file) {
            if (!$file || !$file->isValid()) {
                continue;
            }

            $folder = 'uploads/reviews/gallery';
            $destinationPath = public_path($folder);

            if (!is_dir($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

            $file->move($destinationPath, $filename);

            $images[] = [
                'image_path' => $folder . '/' . $filename,
                'alt_text' => 'Review image',
                'sort_order' => $index + 1,
            ];
        }

        return $images;
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

    private function deletePublicFile(?string $path): void
    {
        if (!$path) {
            return;
        }

        if (!Str::startsWith($path, 'uploads/reviews/')) {
            return;
        }

        $fullPath = public_path($path);

        if (file_exists($fullPath)) {
            @unlink($fullPath);
        }
    }
}