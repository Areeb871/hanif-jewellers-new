@extends('admin_layout.app')

@section('content')
    @include('admin.blogs._form', [
        'pageTitle' => 'Edit Blog',
        'formAction' => route('admin.blogs.update', $blog->id),
        'submitLabel' => 'Update Blog',
        'blog' => $blog,
    ])
@endsection
