@extends('admin_layout.app')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Manage Blogs</h2>
        <a href="{{ route('admin.blogs.create') }}" class="btn btn-dark">Add New Blog</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered align-middle">
            <thead>
                <tr>
                    <th width="80">ID</th>
                    <th width="120">Image</th>
                    <th>Title</th>
                    <th>Slug</th>
                    <th>Date</th>
                    <th width="180">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($blogs as $blog)
                    <tr>
                        <td>{{ $blog->id }}</td>
                        <td>
                            @if($blog->image)
                                <img src="{{ asset($blog->image) }}" width="80" height="60" style="object-fit:cover;border-radius:8px;">
                            @endif
                        </td>
                        <td>{{ $blog->title }}</td>
                        <td>{{ $blog->slug }}</td>
                        <td>{{ $blog->published_at ? $blog->published_at->format('d M Y') : '-' }}</td>
                        <td>
                            <a href="{{ route('admin.blogs.edit', $blog->id) }}" class="btn btn-sm btn-primary">Edit</a>

                            <form action="{{ route('admin.blogs.destroy', $blog->id) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Delete this blog?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">No blogs found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{ $blogs->links() }}
</div>
@endsection