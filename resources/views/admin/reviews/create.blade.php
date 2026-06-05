@extends('admin_layout.app')

@section('content')

<div class="container">
    <h2 class="mb-4">Add Review</h2>

    <form 
        action="{{ route('reviews.store') }}" 
        method="POST" 
        enctype="multipart/form-data"
    >
        @csrf

        @include('admin.reviews.form')

        <button type="submit" class="btn btn-success">
            Save Review
        </button>

        <a href="{{ route('reviews.index') }}" class="btn btn-secondary">
            Back
        </a>
    </form>
</div>

@endsection