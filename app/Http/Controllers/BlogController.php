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
        $recentBlogs = Blog::where('id', '!=', $blog->id)->latest()->take(3)->get();

        return view('blogs.show', compact('blog', 'recentBlogs'));
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
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'published_at' => 'nullable|date',
        ]);

        $imagePath = null;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . Str::slug($request->title) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/blogs'), $imageName);
            $imagePath = 'uploads/blogs/' . $imageName;
        }

        $slug = Str::slug($request->title);
        $originalSlug = $slug;
        $count = 1;

        while (Blog::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $count++;
        }

        Blog::create([
            'title' => $request->title,
            'slug' => $slug,
            'description' => $request->description,
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
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'published_at' => 'nullable|date',
        ]);

        $imagePath = $blog->image;

        if ($request->hasFile('image')) {
            if ($blog->image && File::exists(public_path($blog->image))) {
                File::delete(public_path($blog->image));
            }

            $image = $request->file('image');
            $imageName = time() . '_' . Str::slug($request->title) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/blogs'), $imageName);
            $imagePath = 'uploads/blogs/' . $imageName;
        }

        $slug = Str::slug($request->title);
        $originalSlug = $slug;
        $count = 1;

        while (Blog::where('slug', $slug)->where('id', '!=', $blog->id)->exists()) {
            $slug = $originalSlug . '-' . $count++;
        }

        $blog->update([
            'title' => $request->title,
            'slug' => $slug,
            'description' => $request->description,
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

        $blog->delete();

        return redirect()->route('admin.blogs.index')->with('success', 'Blog deleted successfully.');
    }
}
