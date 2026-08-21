@extends('public.layouts.header_black_white_fixed')

@section('content')
<style>
    .loc-profile {
        --lp-ink: #181713;
        --lp-muted: #6f6a62;
        --lp-accent: #9b7540;
        --lp-border: #dfd9cf;
        --lp-surface: #f8f5f0;
        min-height: 70vh;
        padding: clamp(76px, 8vw, 126px) 0 clamp(88px, 9vw, 140px);
        background: radial-gradient(circle at 50% 0, rgba(183, 148, 94, .12), transparent 32%), #fff;
        color: var(--lp-ink);
    }
    .loc-profile__shell {
        width: min(calc(100% - 40px), 540px);
        margin: 0 auto;
    }
    .loc-profile__header {
        text-align: center;
        margin-bottom: clamp(36px, 5vw, 56px);
    }
    .loc-profile__eyebrow {
        margin: 0 0 14px;
        font-family: "Poppins", Arial, sans-serif;
        font-size: 10px;
        font-weight: 500;
        letter-spacing: .28em;
        text-transform: uppercase;
        color: var(--lp-accent);
    }
    .loc-profile__title {
        margin: 0;
        font-family: "Argent CF", "Cormorant Garamond", Georgia, serif;
        font-size: clamp(30px, 5vw, 52px);
        font-weight: 400;
        line-height: 1;
        letter-spacing: .04em;
        text-transform: uppercase;
    }
    .loc-profile__rule {
        width: 38px;
        height: 1px;
        margin: 22px auto 0;
        background: var(--lp-ink);
    }
    .loc-profile__links {
        display: flex;
        flex-direction: column;
        gap: 12px;
    }
    .loc-profile__card {
        display: flex;
        align-items: center;
        min-height: 80px;
        padding: 20px 22px;
        border: 1px solid var(--lp-border);
        background: rgba(255,255,255,.88);
        color: var(--lp-ink);
        text-decoration: none;
        transition: border-color .25s ease, background-color .25s ease, transform .25s ease;
    }
    .loc-profile__card:hover,
    .loc-profile__card:focus-visible {
        border-color: var(--lp-accent);
        background: var(--lp-surface);
        color: var(--lp-ink);
        transform: translateY(-2px);
    }
    .loc-profile__card:focus-visible {
        outline: 2px solid var(--lp-accent);
        outline-offset: 3px;
    }
    .loc-profile__icon {
        display: inline-grid;
        flex: 0 0 44px;
        width: 44px;
        height: 44px;
        margin-right: 16px;
        place-items: center;
        border: 1px solid var(--lp-border);
        border-radius: 50%;
        font-size: 18px;
        color: var(--lp-accent);
    }
    .loc-profile__label {
        font-family: "Poppins", Arial, sans-serif;
        font-size: 13px;
        font-weight: 500;
        letter-spacing: .08em;
        text-transform: uppercase;
    }
    .loc-profile__arrow {
        margin-left: auto;
        padding-left: 14px;
        font-size: 12px;
        color: var(--lp-accent);
    }
    .loc-profile__back {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        margin-top: clamp(30px, 4vw, 48px);
        font-family: "Poppins", Arial, sans-serif;
        font-size: 11px;
        font-weight: 400;
        letter-spacing: .06em;
        text-transform: uppercase;
        color: var(--lp-muted);
        text-decoration: none;
        transition: color .2s ease;
    }
    .loc-profile__back:hover { color: var(--lp-ink); }

    @media (max-width: 700px) {
        .loc-profile { padding-top: 58px; }
        .loc-profile__shell { width: calc(100% - 24px); }
    }
    @media (prefers-reduced-motion: reduce) {
        .loc-profile__card { transition: none; }
    }
</style>

<main class="loc-profile">
    <div class="loc-profile__shell">
        <header class="loc-profile__header">
            <p class="loc-profile__eyebrow">HANIF FLAGSHIP STORE</p>
            <h1 class="loc-profile__title">{{ $location['name'] }}</h1>
            <div class="loc-profile__rule" aria-hidden="true"></div>
        </header>

        <div class="loc-profile__links">
            <a class="loc-profile__card" href="https://www.instagram.com/hanifjewellers/" target="_blank" rel="noopener noreferrer">
                <span class="loc-profile__icon"><i class="fa-brands fa-instagram"></i></span>
                <span class="loc-profile__label">Instagram</span>
                <i class="fa-solid fa-arrow-up-right-from-square loc-profile__arrow" aria-hidden="true"></i>
            </a>

            <a class="loc-profile__card" href="https://whatsapp.com/channel/0029Vb7KL8H3rZZc3W4YMP3A" target="_blank" rel="noopener noreferrer">
                <span class="loc-profile__icon"><i class="fa-brands fa-whatsapp"></i></span>
                <span class="loc-profile__label">Hanif Gold Exchange</span>
                <i class="fa-solid fa-arrow-up-right-from-square loc-profile__arrow" aria-hidden="true"></i>
            </a>

            <a class="loc-profile__card" href="https://whatsapp.com/channel/0029VbD1vrS1iUxfH2RM3h0C" target="_blank" rel="noopener noreferrer">
                <span class="loc-profile__icon"><i class="fa-brands fa-whatsapp"></i></span>
                <span class="loc-profile__label">Hanif Vault</span>
                <i class="fa-solid fa-arrow-up-right-from-square loc-profile__arrow" aria-hidden="true"></i>
            </a>

            <a class="loc-profile__card" href="{{ $location['review_url'] }}" target="_blank" rel="noopener noreferrer">
                <span class="loc-profile__icon"><i class="fa-brands fa-google"></i></span>
                <span class="loc-profile__label">Google Reviews</span>
                <i class="fa-solid fa-arrow-up-right-from-square loc-profile__arrow" aria-hidden="true"></i>
            </a>
        </div>

        <a class="loc-profile__back" href="{{ route('social-links') }}">
            <i class="fa-solid fa-arrow-left"></i> Back to all locations
        </a>
    </div>
</main>
@endsection
