@extends('admin_layout.app')

@section('content')

<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Reviews</h2>

        <a href="{{ route('reviews.create') }}" class="btn btn-primary">
            Add Review
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card">
        <div class="card-body table-responsive">

            <table class="table table-bordered align-middle">
                <thead>
                    <tr>
                        <th width="70">ID</th>
                        <th>Main Image</th>
                        <th>Main Title</th>
                        <th>Title</th>
                        <th>Status</th>
                        <th>Created At</th>
                        <th width="170">Action</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($reviews as $review)
                        <tr>
                            <td>{{ $review->id }}</td>

                            <td>
                                @if($review->image)
                                    <img 
                                        src="{{ asset($review->image) }}" 
                                        width="70" 
                                        height="70" 
                                        style="object-fit:cover;border:1px solid #ddd;"
                                    >
                                @else
                                    <span class="text-muted">No Image</span>
                                @endif
                            </td>

                            <td>{{ $review->main_title }}</td>
                            <td>{{ $review->title }}</td>

                            <td>
                                @if($review->status)
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-danger">Inactive</span>
                                @endif
                            </td>

                            <td>{{ $review->created_at?->format('d M Y') }}</td>

                            <td>
                                <a 
                                    href="{{ route('reviews.edit', $review->id) }}" 
                                    class="btn btn-sm btn-warning"
                                >
                                    Edit
                                </a>

                                <form 
                                    action="{{ route('reviews.destroy', $review->id) }}" 
                                    method="POST" 
                                    style="display:inline-block;"
                                    onsubmit="return confirm('Are you sure you want to delete this review?')"
                                >
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="btn btn-sm btn-danger">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted">
                                No reviews found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            {{ $reviews->links() }}

        </div>
    </div>
</div>

@endsection