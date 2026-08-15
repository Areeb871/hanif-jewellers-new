@extends('public.layouts.header_latest')

@section('content')
<style>
    .blog-journal {
        background: #fff;
        padding: 42px 20px 80px;
    }

    .blog-journal__inner {
        width: min(100%, 960px);
        margin: 0 auto;
    }

    .blog-entry {
        margin-bottom: 58px;
    }

    .blog-entry__image-link,
    .blog-entry__image {
        display: block;
        width: 100%;
    }

    .blog-entry__image {
    object-fit: cover;
    }

    .blog-entry__toolbar {
        min-height: 56px;
        padding: 0 120px;
        border-bottom: 1px solid #d7d7d7;
        display: flex;
        align-items: center;
    }

    .blog-entry__share {
        appearance: none;
        border: 0;
        background: transparent;
        color: #8b8b8b;
        padding: 6px 0;
        font: inherit;
        font-size: 13px;
        cursor: pointer;
    }

    .blog-entry__share:hover,
    .blog-entry__share:focus {
        color: #111;
    }

    .blog-entry__content {
        display: grid;
        grid-template-columns: 240px minmax(0, 1fr);
        gap: 48px;
        padding-top: 36px;
    }

    .blog-entry__title {
        margin: 0 0 20px;
        color: #111;
        font-family: "Argent CF", Georgia, serif;
        font-size: clamp(26px, 2.3vw, 34px);
        font-weight: 400;
        line-height: .96;
        letter-spacing: .01em;
    }

    .blog-entry__title a {
        color: inherit;
        text-decoration: none;
    }

    .blog-entry__title a:hover {
        opacity: .65;
    }

    .blog-entry__date,
    .blog-entry__excerpt {
        color: #111;
    }

    .blog-entry__date {
        margin: 0;
        font-size: 15px;
        line-height: 1.4;
    }

    .blog-entry__excerpt {
        margin: -2px 0 0;
        font-size: 18px;
        line-height: 1.42;
        text-align: justify;
    }

    .blog-entry__read-more {
        display: inline-block;
        margin-top: 16px;
        color: #111;
        font-family: "Argent CF", Georgia, serif;
        font-size: 13px;
        letter-spacing: .08em;
        text-decoration: none;
        text-transform: uppercase;
        border-bottom: 1px solid #111;
    }

    .blog-journal__empty {
        padding: 90px 20px;
        text-align: center;
        font-family: "Argent CF", Georgia, serif;
        font-size: 22px;
    }

    .blog-journal__pagination {
        display: flex;
        justify-content: center;
        margin-top: 20px;
    }

    @media (max-width: 767.98px) {
        .blog-journal {
            padding: 24px 16px 56px;
        }

        .blog-entry {
            margin-bottom: 44px;
        }

        .blog-entry__image {
            height: 56vw;
            min-height: 220px;
        }

        .blog-entry__toolbar {
            min-height: 48px;
            padding: 0;
        }

        .blog-entry__content {
            grid-template-columns: 1fr;
            gap: 22px;
            padding-top: 28px;
        }

        .blog-entry__title {
            max-width: 330px;
            line-height: 1.04;
        }

        .blog-entry__excerpt {
            font-size: 17px;
            text-align: left;
        }
    }
</style>

<main class="blog-journal">
    <div class="blog-journal__inner">
        @forelse($blogs as $blog)
            @php
                $blogUrl = route('blogs.show', $blog->slug);
                $publishedDate = $blog->published_at ?: $blog->created_at;
            @endphp

            <article class="blog-entry">
                <a href="{{ $blogUrl }}" class="blog-entry__image-link" aria-label="Read {{ $blog->title }}">
                    <img
                        src="{{ $blog->image ? asset($blog->image) : asset('assets/f_assets/image/Watch_Creative_Banner.jpg') }}"
                        alt="{{ $blog->title }}"
                        class="blog-entry__image"
                        loading="{{ $loop->first ? 'eager' : 'lazy' }}"
                    >
                </a>

                <div class="blog-entry__toolbar">
                    <button
                        type="button"
                        class="blog-entry__share"
                        data-share-url="{{ $blogUrl }}"
                        data-share-title="{{ $blog->title }}"
                        aria-label="Share {{ $blog->title }}"
                    >
                        <i class="fa-solid fa-share-nodes" aria-hidden="true"></i> Share
                    </button>
                </div>

                <div class="blog-entry__content">
                    <div>
                        <h2 class="blog-entry__title">
                            <a href="{{ $blogUrl }}">{{ $blog->title }}</a>
                        </h2>
                        <p class="blog-entry__date">{{ $publishedDate->format('F j, Y') }}</p>
                    </div>

                    <div>
                        <p class="blog-entry__excerpt">
                            {{ \Illuminate\Support\Str::limit(strip_tags($blog->description), 560) }}
                        </p>
                        <a href="{{ $blogUrl }}" class="blog-entry__read-more">Read article</a>
                    </div>
                </div>
            </article>
        @empty
            <div class="blog-journal__empty">No articles have been published yet.</div>
        @endforelse

        @if($blogs->hasPages())
            <div class="blog-journal__pagination">
                {{ $blogs->links() }}
            </div>
        @endif
    </div>
</main>

<script>
    document.addEventListener('click', async function (event) {
        const button = event.target.closest('.blog-entry__share');
        if (!button) return;

        const shareData = {
            title: button.dataset.shareTitle,
            url: button.dataset.shareUrl
        };

        if (navigator.share) {
            try {
                await navigator.share(shareData);
            } catch (error) {
                // Closing the native share dialog needs no further action.
            }
            return;
        }

        try {
            await navigator.clipboard.writeText(shareData.url);
            const originalText = button.innerHTML;
            button.textContent = 'Link copied';
            window.setTimeout(() => { button.innerHTML = originalText; }, 1600);
        } catch (error) {
            window.location.href = shareData.url;
        }
    });
</script>
@endsection
