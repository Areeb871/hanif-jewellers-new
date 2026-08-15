@extends('admin_layout.app')

@section('content')
<style>
    @font-face {
        font-family: "Argent CF";
        src: url("{{ asset('assets/f_assets/css/fonts/fonnts.com-Argent-CF-.otf') }}") format("opentype");
        font-weight: 400;
        font-style: normal;
        font-display: swap;
    }

    .admin-blog-journal {
        max-width: 1080px;
        margin: 0 auto;
        padding: 32px 20px 60px;
    }

    .admin-blog-journal__heading {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 20px;
        margin-bottom: 32px;
    }

    .admin-blog-journal__heading h1 {
        margin: 0;
        font-family: "Argent CF", Georgia, serif;
        font-size: 34px;
        font-weight: 400;
    }

    .admin-blog-entry {
        margin-bottom: 54px;
    }

    .admin-blog-entry__image {
        display: block;
        width: 100%;
        height: clamp(260px, 32vw, 400px);
        object-fit: cover;
    }

    .admin-blog-entry__toolbar {
        min-height: 60px;
        border-bottom: 1px solid #d7d7d7;
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 18px;
    }

    .admin-blog-entry__id {
        color: #888;
        font-size: 13px;
    }

    .admin-blog-entry__actions {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .admin-blog-entry__content {
        display: grid;
        grid-template-columns: 250px minmax(0, 1fr);
        gap: 52px;
        padding-top: 34px;
    }

    .admin-blog-entry__title,
    .admin-blog-entry__date,
    .admin-blog-entry__excerpt {
        font-family: "Argent CF", Georgia, serif;
        color: #111;
    }

    .admin-blog-entry__title {
        margin: 0 0 20px;
        font-size: clamp(26px, 2.3vw, 34px);
        font-weight: 400;
        line-height: .98;
    }

    .admin-blog-entry__date {
        margin: 0;
        font-size: 15px;
    }

    .admin-blog-entry__excerpt {
        margin: -2px 0 0;
        font-size: 18px;
        line-height: 1.45;
        text-align: justify;
    }

    .admin-blog-journal__empty {
        padding: 80px 20px;
        border: 1px solid #e3e3e3;
        text-align: center;
        font-family: "Argent CF", Georgia, serif;
        font-size: 21px;
    }

    @media (max-width: 767.98px) {
        .admin-blog-journal {
            padding-inline: 12px;
        }

        .admin-blog-journal__heading {
            align-items: flex-start;
            flex-direction: column;
        }

        .admin-blog-entry__image {
            height: 56vw;
            min-height: 220px;
        }

        .admin-blog-entry__content {
            grid-template-columns: 1fr;
            gap: 20px;
            padding-top: 26px;
        }

        .admin-blog-entry__toolbar {
            align-items: flex-start;
            flex-direction: column;
            padding: 12px 0;
        }

        .admin-blog-entry__excerpt {
            text-align: left;
        }
    }
</style>

<div class="admin-blog-journal">
    <div class="admin-blog-journal__heading">
        <h1>Manage Blogs</h1>
        <a href="{{ route('admin.blogs.create') }}" class="btn btn-dark">Add New Blog</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success mb-4">{{ session('success') }}</div>
    @endif

    @forelse($blogs as $blog)
        @php($publishedDate = $blog->published_at ?: $blog->created_at)

        <article class="admin-blog-entry">
            <img
                src="{{ $blog->image ? asset($blog->image) : asset('assets/f_assets/image/Watch_Creative_Banner.jpg') }}"
                alt="{{ $blog->title }}"
                class="admin-blog-entry__image"
                loading="{{ $loop->first ? 'eager' : 'lazy' }}"
            >

            <div class="admin-blog-entry__toolbar">
                <span class="admin-blog-entry__id">Blog #{{ $blog->id }} · {{ $blog->slug }}</span>

                <div class="admin-blog-entry__actions">
                    <a href="{{ route('blogs.show', $blog->slug) }}" class="btn btn-sm btn-light" target="_blank" rel="noopener">View</a>
                    <a href="{{ route('admin.blogs.edit', $blog->id) }}" class="btn btn-sm btn-primary">Edit</a>
                    <form action="{{ route('admin.blogs.destroy', $blog->id) }}" method="POST" onsubmit="return confirm('Delete this blog?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </div>
            </div>

            <div class="admin-blog-entry__content">
                <div>
                    <h2 class="admin-blog-entry__title">{{ $blog->title }}</h2>
                    <p class="admin-blog-entry__date">{{ $publishedDate->format('F j, Y') }}</p>
                </div>

                <p class="admin-blog-entry__excerpt">
                    {{ \Illuminate\Support\Str::limit(strip_tags($blog->description), 560) }}
                </p>
            </div>
        </article>
    @empty
        <div class="admin-blog-journal__empty">No blogs found. Add your first article to get started.</div>
    @endforelse

    @if($blogs->hasPages())
        <div class="d-flex justify-content-center mt-4">
            {{ $blogs->links() }}
        </div>
    @endif
</div>
@endsection
