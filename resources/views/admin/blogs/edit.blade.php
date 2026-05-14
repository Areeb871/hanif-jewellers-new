@extends('admin_layout.app')

@section('content')
<div class="container py-5">
    <h2 class="mb-4">Edit Blog</h2>

    <form action="{{ route('admin.blogs.update', $blog->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Title</label>
            <input type="text" name="title" class="form-control" value="{{ old('title', $blog->title) }}" required>
            @error('title') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description" rows="8" class="form-control" required>{{ old('description', $blog->description) }}</textarea>
            @error('description') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Current Image</label><br>
            @if($blog->image)
                <img src="{{ asset($blog->image) }}" width="140" style="border-radius:10px;">
            @else
                <p>No image uploaded.</p>
            @endif
        </div>

        <div class="mb-3">
            <label class="form-label">Change Image</label>
            <input type="file" name="image" class="form-control">
            @error('image') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Published Date</label>
            <input type="datetime-local" name="published_at" class="form-control"
                value="{{ old('published_at', $blog->published_at ? $blog->published_at->format('Y-m-d\TH:i') : '') }}">
        </div>

        <button type="submit" class="btn btn-dark">Update Blog</button>
    </form>
</div>
@endsection