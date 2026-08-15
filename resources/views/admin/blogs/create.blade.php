@extends('admin_layout.app')

@section('content')
    @include('admin.blogs._form', [
        'pageTitle' => 'Create Blog',
        'formAction' => route('admin.blogs.store'),
        'submitLabel' => 'Save Blog',
        'blog' => null,
    ])
@endsection
