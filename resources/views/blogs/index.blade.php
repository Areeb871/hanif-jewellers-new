@extends('public.layouts.header_latest')

@section('content')
<style>
    .blog-section {
        padding: 60px 0;
        background: #f5f5f5;
    }

    .blog-heading {
        font-size: 56px;
        font-weight: 700;
        line-height: 1.1;
        color: #1b1b1b;
        margin-bottom: 20px;
        font-family: Georgia, serif;
    }

    .blog-subtext {
        max-width: 1100px;
        font-size: 18px;
        line-height: 1.8;
        color: #5d6470;
        margin-bottom: 40px;
    }

    .blog-card {
        background: #e9dfd1;
        border-radius: 24px;
        overflow: hidden;
        box-shadow: 0 6px 18px rgba(0,0,0,0.12);
        height: 100%;
        transition: 0.3s ease;
    }

    .blog-card:hover {
        transform: translateY(-5px);
    }

    .blog-card img {
        width: 100%;
        height: 260px;
        object-fit: cover;
        display: block;
    }

    .blog-card-body {
        padding: 24px 22px 22px;
    }

    .blog-card-title {
        font-size: 22px;
        line-height: 1.35;
        font-weight: 700;
        color: #1d1d1d;
        margin-bottom: 14px;
        font-family: Georgia, serif;
        min-height: 60px;
    }

    .blog-card-date {
        font-size: 16px;
        color: #5c5c5c;
        margin-bottom: 20px;
    }

    .blog-card-link {
        color: #78a96e;
        font-size: 18px;
        text-decoration: none;
        font-weight: 500;
    }

    .blog-card-link:hover {
        text-decoration: underline;
    }
.influencers-section {
    background: #f5f5f5;
}

.influencer-img {
    width: 100%;
    height: 400px;
    object-fit: cover;
    display: block;
}
    @media (max-width: 768px) {
        .blog-heading {
            font-size: 40px;
        }

        .blog-card img {
            height: 220px;
        }
    }
</style>

<section class="influencers-section py-5">
    <div class="container">
        <h2 class="text-center fw-bold mb-4">Newsletter & Articles</h2>

        <!--<p class="text-center mx-auto mb-4" style="max-width:900px;">-->
        <!--    Are you genuinely passionate about Swiss Military by Chrono and would like to collaborate with us?-->
        <!--    Just drop us an email and let us know – you might end up being our next Swiss Military by Chrono ambassador.-->
        <!--</p>-->

        <div class="row g-4">
            @foreach($blogs->take(3) as $blog)
                <div class="col-md-4">
                    <a href="{{ route('blogs.show', $blog->slug) }}" class="d-block">
                        <img
                            src="{{ $blog->image ? asset($blog->image) : asset('images/default-blog.jpg') }}"
                            class="img-fluid influencer-img"
                            alt="{{ $blog->title }}"
                        >
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endsection