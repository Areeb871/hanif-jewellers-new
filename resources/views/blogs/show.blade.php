@extends('public.layouts.header_latest')

@section('content')
@php
    $heroImage = $blog->image
        ? asset($blog->image)
        : asset('assets/f_assets/image/Watch_Creative_Banner.jpg');
    $publishedDate = $blog->published_at ?: $blog->created_at;
@endphp

<style>
    .article-hero {
        min-height: clamp(390px, 46vw, 610px);
        position: relative;
        display: grid;
        place-items: center;
        overflow: hidden;
        background: #111;
        color: #fff;
    }

    .article-hero__image,
    .article-hero__shade {
        position: absolute;
        inset: 0;
        width: 100%;
        height: 100%;
    }

    .article-hero__image {
        object-fit: cover;
    }

    .article-hero__shade {
        background: linear-gradient(180deg, rgba(0, 0, 0, .38), rgba(0, 0, 0, .30));
    }

    .article-hero__content {
        width: min(90%, 850px);
        padding: 120px 20px 70px;
        position: relative;
        z-index: 1;
        text-align: center;
    }

    .article-hero__title {
        max-width: 780px;
        margin: 0 auto 20px;
        color: #fff;
        font-family: "Argent CF", Georgia, serif;
        font-size: clamp(28px, 4vw, 56px);
        font-weight: 400;
        line-height: 1.02;
        letter-spacing: .13em;
        text-transform: uppercase;
        text-wrap: balance;
    }

    .article-hero__date {
        margin: 0;
        color: #fff;
        font-family: "Argent CF", Georgia, serif;
        font-size: 14px;
        letter-spacing: .02em;
    }

    .article-story {
        background: #fff;
        padding: 72px 20px 90px;
    }

    .article-story__inner {
        width: min(100%, 760px);
        margin: 0 auto;
    }

    .article-story__intro,
    .article-section__text {
        color: #171717;
        font-family: "Argent CF", Georgia, serif;
        font-size: 16px;
        line-height: 1.55;
    }

    .article-story__intro {
        margin: 0 0 34px;
    }

    .article-section {
        margin: 0 0 34px;
    }

    .article-section__text {
        margin: 20px 0 0;
    }

    .article-section__text:first-child {
        margin-top: 0;
        margin-bottom: 20px;
    }

    .article-section__images {
        display: grid;
        grid-template-columns: 1fr;
        gap: 12px;
    }

    .article-section__images--grid {
        grid-template-columns: repeat(2, minmax(0, 1fr));
    }

    .article-section__image {
        display: block;
        width: 100%;
        height: auto;
        object-fit: cover;
    }

    .article-section__images--grid .article-section__image {
        height: clamp(230px, 32vw, 440px);
    }

    .article-story__footer {
        margin-top: 50px;
        text-align: center;
    }

    .article-story__all-link {
        display: inline-block;
        min-width: 190px;
        padding: 13px 22px;
        border: 1px solid #111;
        color: #111;
        font-family: "Argent CF", Georgia, serif;
        font-size: 12px;
        letter-spacing: .12em;
        text-decoration: none;
        text-transform: uppercase;
        transition: background .25s ease, color .25s ease;
    }

    .article-story__all-link:hover {
        background: #111;
        color: #fff;
    }

    .article-story__share {
        margin-top: 42px;
        padding-top: 18px;
        border-top: 1px solid #ddd;
        display: flex;
        align-items: center;
        gap: 8px;
        color: #888;
        font-size: 13px;
    }

    .article-story__share button {
        appearance: none;
        border: 0;
        background: none;
        color: inherit;
        padding: 0;
        cursor: pointer;
    }

    @media (max-width: 767.98px) {
        .article-hero {
            min-height: 440px;
        }

        .article-hero__content {
            padding: 100px 14px 52px;
        }

        .article-hero__title {
            font-size: clamp(25px, 8vw, 38px);
            letter-spacing: .08em;
        }

        .article-story {
            padding: 46px 16px 64px;
        }

        .article-story__intro,
        .article-section__text {
            font-size: 16px;
            line-height: 1.6;
        }

        .article-section__images--grid {
            gap: 8px;
        }

        .article-section__images--grid .article-section__image {
            height: 55vw;
        }
    }
</style>

<article>
    <header class="article-hero">
        <img src="{{ $heroImage }}" alt="{{ $blog->title }}" class="article-hero__image">
        <div class="article-hero__shade"></div>
        <div class="article-hero__content">
            <h1 class="article-hero__title">{{ $blog->title }}</h1>
            <p class="article-hero__date">{{ $publishedDate->format('F j, Y') }}</p>
        </div>
    </header>

    <div class="article-story">
        <div class="article-story__inner">
            <div class="article-story__intro">{!! nl2br(e($blog->description)) !!}</div>

            @foreach($blog->sections ?? [] as $section)
                @php
                    $sectionImages = is_array($section['images'] ?? null) ? $section['images'] : [];
                    $imagePosition = ($section['image_position'] ?? 'before') === 'after' ? 'after' : 'before';
                @endphp

                <section class="article-section">
                    @if($imagePosition === 'after' && filled($section['text'] ?? null))
                        <div class="article-section__text">{!! nl2br(e($section['text'])) !!}</div>
                    @endif

                    @if($sectionImages)
                        <div class="article-section__images {{ ($section['layout'] ?? 'full') === 'grid' ? 'article-section__images--grid' : '' }}">
                            @foreach($sectionImages as $sectionImage)
                                <img src="{{ asset($sectionImage) }}" alt="{{ $blog->title }}" class="article-section__image" loading="lazy">
                            @endforeach
                        </div>
                    @endif

                    @if($imagePosition === 'before' && filled($section['text'] ?? null))
                        <div class="article-section__text">{!! nl2br(e($section['text'])) !!}</div>
                    @endif
                </section>
            @endforeach

            <div class="article-story__footer">
                <a href="{{ route('blogs.index') }}" class="article-story__all-link">Discover all articles</a>
            </div>

            <div class="article-story__share">
                <i class="fa-solid fa-share-nodes" aria-hidden="true"></i>
                <button type="button" id="shareArticle">Share article</button>
            </div>
        </div>
    </div>
</article>

<script>
    document.getElementById('shareArticle')?.addEventListener('click', async function () {
        const shareData = { title: @json($blog->title), url: window.location.href };

        if (navigator.share) {
            try {
                await navigator.share(shareData);
            } catch (error) {
                // The visitor closed the native share dialog.
            }
            return;
        }

        try {
            await navigator.clipboard.writeText(shareData.url);
            const originalText = this.textContent;
            this.textContent = 'Link copied';
            window.setTimeout(() => { this.textContent = originalText; }, 1600);
        } catch (error) {
            window.location.href = shareData.url;
        }
    });
</script>
@endsection
