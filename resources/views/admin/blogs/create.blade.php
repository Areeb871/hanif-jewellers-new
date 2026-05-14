@extends('admin_layout.app')

@section('content')
<div class="container py-5">
    <h2 class="mb-4">Create Blog</h2>

    <form action="{{ route('admin.blogs.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label class="form-label">Title</label>
            <input type="text" name="title" class="form-control" value="{{ old('title') }}" required>
            @error('title') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description" rows="8" class="form-control" required>{{ old('description') }}</textarea>
            @error('description') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Image</label>
            <input type="file" name="image" class="form-control">
            @error('image') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Published Date</label>
            <input type="datetime-local" name="published_at" class="form-control" value="{{ old('published_at') }}">
        </div>

        <button type="submit" class="btn btn-dark">Save Blog</button>
    </form>
</div>
@endsection