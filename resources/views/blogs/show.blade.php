@extends('public.layouts.header_latest')

@section('content')
<style>
    .blog-detail-section {
        padding: 70px 0;
        background: #f8f8f8;
    }

    .blog-detail-img {
        width: 100%;
        max-height: 500px;
        object-fit: cover;
        border-radius: 20px;
        margin-bottom: 30px;
    }

    .blog-detail-title {
        font-size: 35px;
        line-height: 1.2;
        font-weight: 700;
        color: #1b1b1b;
        margin-bottom: 15px;
        font-family: Georgia, serif;
    }

    .blog-detail-date {
        color: #6b6b6b;
        font-size: 16px;
        margin-bottom: 25px;
    }

    .blog-detail-content {
        font-size: 18px;
        line-height: 1.9;
        color: #333;
    }

    .recent-blogs {
        margin-top: 60px;
    }

    .recent-title {
        font-size: 28px;
        font-weight: 700;
        margin-bottom: 25px;
        font-family: Georgia, serif;
    }

    .recent-card {
        background: #e9dfd1;
        border-radius: 18px;
        overflow: hidden;
        box-shadow: 0 4px 14px rgba(0,0,0,0.10);
        height: 100%;
    }

    .recent-card img {
        width: 100%;
        height: 180px;
        object-fit: cover;
    }

    .recent-card-body {
        padding: 18px;
    }

    .recent-card-body h6 {
        font-size: 20px;
        font-weight: 700;
        margin-bottom: 10px;
        font-family: Georgia, serif;
    }

    .recent-card-body a {
        text-decoration: none;
        color: #78a96e;
    }
</style>

<section class="blog-detail-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <img src="{{ $blog->image ? asset($blog->image) : asset('images/default-blog.jpg') }}" alt="{{ $blog->title }}" class="blog-detail-img">

                <h1 class="blog-detail-title">{{ $blog->title }}</h1>

                <div class="blog-detail-date">
                    {{ $blog->published_at ? $blog->published_at->format('F d, Y') : $blog->created_at->format('F d, Y') }}
                </div>

                <div class="blog-detail-content">
                    {!! nl2br(e($blog->description)) !!}
                </div>
            </div>
        </div>

        @if($recentBlogs->count())
            <div class="recent-blogs">
                <h3 class="recent-title">Recent Blogs</h3>

                <div class="row g-4">
                    @foreach($recentBlogs as $item)
                        <div class="col-md-4">
                            <div class="recent-card">
                                <a href="{{ route('blogs.show', $item->slug) }}">
                                    <img src="{{ $item->image ? asset($item->image) : asset('images/default-blog.jpg') }}" alt="{{ $item->title }}">
                                </a>
                                <div class="recent-card-body">
                                    <h6>{{ $item->title }}</h6>
                                    <a href="{{ route('blogs.show', $item->slug) }}">Read More</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</section>
@endsection