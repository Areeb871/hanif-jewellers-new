@extends('admin_layout.app')

@section('content')

<div class="container">
    <h2 class="mb-4">Edit Review</h2>

    <form 
        action="{{ route('reviews.update', $review->id) }}" 
        method="POST" 
        enctype="multipart/form-data"
    >
        @csrf
        @method('PUT')

        @include('admin.reviews.form')

        <button type="submit" class="btn btn-success">
            Update Review
        </button>

        <a href="{{ route('reviews.index') }}" class="btn btn-secondary">
            Back
        </a>
    </form>
</div>

@endsection