@extends('public.layouts.header_black_white_fixed')

@section('content')
@php
    $socialLinks = [
        [
            'name' => 'Instagram',
            'handle' => '@hanifjewellers',
            'url' => 'https://www.instagram.com/hanifjewellers/',
            'icon' => 'fa-brands fa-instagram',
        ],
        [
            'name' => 'Facebook',
            'handle' => 'Hanif Jewellers',
            'url' => 'https://www.facebook.com/ExperiencePureArt/',
            'icon' => 'fa-brands fa-facebook-f',
        ],
        [
            'name' => 'TikTok',
            'handle' => 'Hanif Jewellers',
            'url' => 'https://www.tiktok.com/discover/hanif-jewellers',
            'icon' => 'fa-brands fa-tiktok',
        ],
        [
            'name' => 'YouTube',
            'handle' => 'Hanif Jewellers',
            'url' => 'https://www.youtube.com/channel/UCKvZhJlCD4G9Zq-mE4X1ERw',
            'icon' => 'fa-brands fa-youtube',
        ],
    ];

    $reviewLinks = [
        ['name' => 'MM Alam Flagship Store, Lahore', 'slug' => 'mm-alam'],
        ['name' => 'DHA Premium Store, Lahore', 'slug' => 'dha'],
        ['name' => 'Dolmen Premium Store, Lahore', 'slug' => 'dolmen-mall'],
        ['name' => 'Franck Muller Boutique, Lahore', 'slug' => 'franck-muller'],
        ['name' => 'F6 Flagship Store, Islamabad', 'slug' => 'f6-islamabad'],
        ['name' => 'Serena Exclusive Store, Islamabad', 'slug' => 'serena-islamabad'],
        ['name' => 'Marriott Lifestyle Store, Islamabad', 'slug' => 'marriott-islamabad'],
        ['name' => 'Flagship Store, Dubai', 'slug' => 'dubai'],
        ['name' => 'ZARTASH Couture , Lahore ', 'slug' => 'zartash-couture']
    ];
@endphp

<style>
    .social-links-page {
        --social-ink: #181713;
        --social-muted: #6f6a62;
        --social-accent: #9b7540;
        --social-border: #dfd9cf;
        --social-surface: #f8f5f0;
        min-height: 70vh;
        padding: clamp(76px, 8vw, 126px) 0 clamp(88px, 9vw, 140px);
        background:
            radial-gradient(circle at 50% 0, rgba(183, 148, 94, .12), transparent 32%),
            #fff;
        color: var(--social-ink);
    }

    .social-links-page__shell {
        width: min(calc(100% - 40px), 980px);
        margin: 0 auto;
    }

    .social-links-page__header {
        max-width: 680px;
        margin: 0 auto clamp(48px, 6vw, 74px);
        text-align: center;
    }

    .social-links-page__eyebrow {
        margin: 0 0 16px;
        font-family: "Poppins", Arial, sans-serif;
        font-size: 10px;
        font-weight: 500;
        letter-spacing: .28em;
        text-transform: uppercase;
        color: var(--social-accent);
    }

    .social-links-page__title,
    .social-links-page__section-title {
        font-family: "Argent CF", "Cormorant Garamond", Georgia, serif;
        font-weight: 400;
        text-transform: uppercase;
    }

    .social-links-page__title {
        margin: 0;
        font-size: clamp(38px, 6vw, 72px);
        line-height: .95;
        letter-spacing: .045em;
    }

    .social-links-page__rule {
        width: 38px;
        height: 1px;
        margin: 28px auto 24px;
        background: var(--social-ink);
    }

    .social-links-page__intro {
        margin: 0;
        font-family: "Poppins", Arial, sans-serif;
        font-size: clamp(12px, 1vw, 14px);
        font-weight: 300;
        line-height: 1.8;
        color: var(--social-muted);
    }

    .social-links-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 14px;
    }

    .social-link-card {
        display: flex;
        align-items: center;
        min-height: 104px;
        padding: 22px 24px;
        border: 1px solid var(--social-border);
        background: rgba(255, 255, 255, .88);
        color: var(--social-ink);
        text-decoration: none;
        transition: border-color .25s ease, background-color .25s ease, transform .25s ease;
    }

    .social-link-card:hover,
    .social-link-card:focus-visible {
        border-color: var(--social-accent);
        background: var(--social-surface);
        color: var(--social-ink);
        transform: translateY(-2px);
    }

    .social-link-card:focus-visible,
    .review-link:focus-visible {
        outline: 2px solid var(--social-accent);
        outline-offset: 3px;
    }

    .social-link-card__icon {
        display: inline-grid;
        flex: 0 0 48px;
        width: 48px;
        height: 48px;
        margin-right: 18px;
        place-items: center;
        border: 1px solid var(--social-border);
        border-radius: 50%;
        font-size: 20px;
    }

    .social-link-card__copy {
        min-width: 0;
    }

    .social-link-card__name,
    .social-link-card__handle {
        display: block;
        font-family: "Poppins", Arial, sans-serif;
    }

    .social-link-card__name {
        font-size: 13px;
        font-weight: 500;
        letter-spacing: .1em;
        text-transform: uppercase;
    }

    .social-link-card__handle {
        margin-top: 4px;
        overflow: hidden;
        font-size: 11px;
        font-weight: 300;
        color: var(--social-muted);
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .social-link-card__arrow {
        margin-left: auto;
        padding-left: 16px;
        font-size: 12px;
        color: var(--social-accent);
    }

    .reviews-section {
        margin-top: clamp(70px, 8vw, 104px);
    }

    .social-links-page__section-heading {
        margin-bottom: 30px;
        text-align: center;
    }

    .social-links-page__section-icon {
        display: inline-grid;
        width: 42px;
        height: 42px;
        margin-bottom: 15px;
        place-items: center;
        border: 1px solid var(--social-border);
        border-radius: 50%;
        color: var(--social-accent);
    }

    .social-links-page__section-title {
        margin: 0;
        font-size: clamp(24px, 3vw, 38px);
        letter-spacing: .04em;
    }

    .social-links-page__section-copy {
        margin: 12px 0 0;
        font-family: "Poppins", Arial, sans-serif;
        font-size: 12px;
        font-weight: 300;
        color: var(--social-muted);
    }

    .review-links-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 10px;
    }

    .review-link {
        display: flex;
        align-items: center;
        min-height: 72px;
        padding: 17px 18px;
        border: 1px solid var(--social-border);
        background: #fff;
        color: var(--social-ink);
        font-family: "Poppins", Arial, sans-serif;
        font-size: 11px;
        font-weight: 400;
        letter-spacing: .035em;
        text-decoration: none;
        transition: border-color .25s ease, color .25s ease;
    }

    .review-link:hover {
        border-color: var(--social-accent);
        color: var(--social-accent);
    }

    .review-link__pin {
        margin-right: 12px;
        color: var(--social-accent);
    }

    .review-link__arrow {
        margin-left: auto;
        padding-left: 10px;
        font-size: 9px;
    }

    @media (max-width: 700px) {
        .social-links-page {
            padding-top: 58px;
        }

        .social-links-page__shell {
            width: calc(100% - 24px);
        }

        .social-links-grid,
        .review-links-grid {
            grid-template-columns: 1fr;
        }

        .social-link-card {
            min-height: 88px;
            padding: 18px;
        }

        .review-link {
            min-height: 64px;
        }
    }

    @media (prefers-reduced-motion: reduce) {
        .social-link-card,
        .review-link {
            transition: none;
        }
    }
</style>

<main class="social-links-page">
    <div class="social-links-page__shell">
        <header class="social-links-page__header">
            <p class="social-links-page__eyebrow">The House of Hanif</p>
            <h1 class="social-links-page__title">Social Links</h1>
            <div class="social-links-page__rule" aria-hidden="true"></div>
            <p class="social-links-page__intro">Follow Hanif Jewellers, discover our latest stories, and share your experience with us.</p>
        </header>

        <section aria-labelledby="social-profiles-title">
            <h2 class="visually-hidden" id="social-profiles-title">Official social profiles</h2>
            <div class="social-links-grid">
                @foreach ($socialLinks as $socialLink)
                    <a class="social-link-card" href="{{ $socialLink['url'] }}" target="_blank" rel="noopener noreferrer" aria-label="Open Hanif Jewellers on {{ $socialLink['name'] }} in a new tab">
                        <span class="social-link-card__icon" aria-hidden="true"><i class="{{ $socialLink['icon'] }}"></i></span>
                        <span class="social-link-card__copy">
                            <span class="social-link-card__name">{{ $socialLink['name'] }}</span>
                            <span class="social-link-card__handle">{{ $socialLink['handle'] }}</span>
                        </span>
                        <i class="fa-solid fa-arrow-up-right-from-square social-link-card__arrow" aria-hidden="true"></i>
                    </a>
                @endforeach
            </div>
        </section>

        <section class="reviews-section" aria-labelledby="google-reviews-title">
            <div class="social-links-page__section-heading">
                <span class="social-links-page__section-icon" aria-hidden="true"><i class="fa-solid fa-location-dot"></i></span>
                <h2 class="social-links-page__section-title" id="google-reviews-title">Our Locations</h2>
                <p class="social-links-page__section-copy">Select a location to view its profile &amp; links.</p>
            </div>

            <div class="review-links-grid">
                @foreach ($reviewLinks as $reviewLink)
                    <a class="review-link" href="{{ route('location-profile', $reviewLink['slug']) }}" aria-label="View {{ $reviewLink['name'] }} profile">
                        <i class="fa-solid fa-location-dot review-link__pin" aria-hidden="true"></i>
                        <span>{{ $reviewLink['name'] }}</span>
                        <i class="fa-solid fa-arrow-up-right-from-square review-link__arrow" aria-hidden="true"></i>
                    </a>
                @endforeach
            </div>
        </section>
    </div>
</main>
@endsection
