<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    // FRONTEND BLOG LIST
    public function index()
    {
        $blogs = Blog::latest()->paginate(9);

        return view('blogs.index', compact('blogs'));
    }

    // FRONTEND BLOG DETAIL
    public function show($slug)
    {
        $blog = Blog::where('slug', $slug)->firstOrFail();

        return view('blogs.show', compact('blog'));
    }

    // ADMIN LIST
    public function adminIndex()
    {
        $blogs = Blog::latest()->paginate(10);

        return view('admin.blogs.index', compact('blogs'));
    }

    // ADMIN CREATE FORM
    public function create()
    {
        return view('admin.blogs.create');
    }

    // ADMIN STORE
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:8192',
            'published_at' => 'nullable|date',
            'sections' => 'nullable|array|max:30',
            'sections.*.text' => 'nullable|string',
            'sections.*.layout' => 'nullable|in:full,grid',
            'sections.*.image_position' => 'nullable|in:before,after',
            'sections.*.images' => 'nullable|array|max:10',
            'sections.*.images.*' => 'image|mimes:jpg,jpeg,png,webp|max:8192',
        ]);

        $imagePath = null;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time().'_'.Str::slug($request->title).'.'.$image->getClientOriginalExtension();
            $image->move(public_path('uploads/blogs'), $imageName);
            $imagePath = 'uploads/blogs/'.$imageName;
        }

        $slug = Str::slug($request->title);
        $originalSlug = $slug;
        $count = 1;

        while (Blog::where('slug', $slug)->exists()) {
            $slug = $originalSlug.'-'.$count++;
        }

        Blog::create([
            'title' => $request->title,
            'slug' => $slug,
            'description' => $request->description,
            'sections' => $this->buildSections($request),
            'image' => $imagePath,
            'published_at' => $request->published_at,
        ]);

        return redirect()->route('admin.blogs.index')->with('success', 'Blog created successfully.');
    }

    // ADMIN EDIT FORM
    public function edit($id)
    {
        $blog = Blog::findOrFail($id);

        return view('admin.blogs.edit', compact('blog'));
    }

    // ADMIN UPDATE
    public function update(Request $request, $id)
    {
        $blog = Blog::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:8192',
            'published_at' => 'nullable|date',
            'sections' => 'nullable|array|max:30',
            'sections.*.text' => 'nullable|string',
            'sections.*.layout' => 'nullable|in:full,grid',
            'sections.*.image_position' => 'nullable|in:before,after',
            'sections.*.existing_images' => 'nullable|array|max:10',
            'sections.*.existing_images.*' => 'string',
            'sections.*.images' => 'nullable|array|max:10',
            'sections.*.images.*' => 'image|mimes:jpg,jpeg,png,webp|max:8192',
        ]);

        $imagePath = $blog->image;

        if ($request->hasFile('image')) {
            if ($blog->image && File::exists(public_path($blog->image))) {
                File::delete(public_path($blog->image));
            }

            $image = $request->file('image');
            $imageName = time().'_'.Str::slug($request->title).'.'.$image->getClientOriginalExtension();
            $image->move(public_path('uploads/blogs'), $imageName);
            $imagePath = 'uploads/blogs/'.$imageName;
        }

        $slug = Str::slug($request->title);
        $originalSlug = $slug;
        $count = 1;

        while (Blog::where('slug', $slug)->where('id', '!=', $blog->id)->exists()) {
            $slug = $originalSlug.'-'.$count++;
        }

        $sections = $this->buildSections($request, $blog->sections ?? []);
        $this->deleteRemovedSectionImages($blog->sections ?? [], $sections);

        $blog->update([
            'title' => $request->title,
            'slug' => $slug,
            'description' => $request->description,
            'sections' => $sections,
            'image' => $imagePath,
            'published_at' => $request->published_at,
        ]);

        return redirect()->route('admin.blogs.index')->with('success', 'Blog updated successfully.');
    }

    // ADMIN DELETE
    public function destroy($id)
    {
        $blog = Blog::findOrFail($id);

        if ($blog->image && File::exists(public_path($blog->image))) {
            File::delete(public_path($blog->image));
        }

        foreach ($this->sectionImagePaths($blog->sections ?? []) as $sectionImage) {
            $this->deleteBlogImage($sectionImage);
        }

        $blog->delete();

        return redirect()->route('admin.blogs.index')->with('success', 'Blog deleted successfully.');
    }

    private function buildSections(Request $request, array $currentSections = []): array
    {
        $sections = [];
        $allowedExistingImages = $this->sectionImagePaths($currentSections);

        foreach ($request->input('sections', []) as $index => $section) {
            $existingImages = collect($section['existing_images'] ?? [])
                ->filter(fn ($path) => is_string($path) && in_array($path, $allowedExistingImages, true))
                ->values()
                ->all();

            $newImages = [];
            foreach ($request->file("sections.$index.images", []) as $image) {
                $newImages[] = $this->storeBlogImage($image, $request->title, "section-$index");
            }

            $text = trim((string) ($section['text'] ?? ''));
            $images = array_values(array_merge($existingImages, $newImages));

            if ($text === '' && $images === []) {
                continue;
            }

            $sections[] = [
                'text' => $text,
                'layout' => ($section['layout'] ?? 'full') === 'grid' ? 'grid' : 'full',
                'image_position' => ($section['image_position'] ?? 'before') === 'after' ? 'after' : 'before',
                'images' => $images,
            ];
        }

        return $sections;
    }

    private function storeBlogImage($image, string $title, string $suffix): string
    {
        $directory = public_path('uploads/blogs');
        if (! File::isDirectory($directory)) {
            File::makeDirectory($directory, 0755, true);
        }

        $imageName = Str::uuid().'_'.Str::slug($title).'_'.$suffix.'.'.$image->getClientOriginalExtension();
        $image->move($directory, $imageName);

        return 'uploads/blogs/'.$imageName;
    }

    private function sectionImagePaths(array $sections): array
    {
        return collect($sections)
            ->flatMap(fn ($section) => is_array($section['images'] ?? null) ? $section['images'] : [])
            ->filter(fn ($path) => is_string($path))
            ->unique()
            ->values()
            ->all();
    }

    private function deleteRemovedSectionImages(array $oldSections, array $newSections): void
    {
        $removedImages = array_diff(
            $this->sectionImagePaths($oldSections),
            $this->sectionImagePaths($newSections)
        );

        foreach ($removedImages as $removedImage) {
            $this->deleteBlogImage($removedImage);
        }
    }

    private function deleteBlogImage(string $path): void
    {
        if (str_starts_with($path, 'uploads/blogs/') && File::exists(public_path($path))) {
            File::delete(public_path($path));
        }
    }
}
