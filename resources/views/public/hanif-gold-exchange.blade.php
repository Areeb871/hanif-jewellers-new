@extends('public.layouts.header_black_white_fixed')

@section('content')
<style>
@import url('https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,400;0,500;1,400&family=Manrope:wght@400;500&display=swap');

.gold-exchange-page {
    --exchange-ink: #1c1917;
    --exchange-muted: #6b6560;
    --exchange-gold: #9a8460;
    font-family: 'Manrope', sans-serif;
    color: var(--exchange-ink);
    background:
        radial-gradient(ellipse 90% 70% at 50% -10%, rgba(196, 176, 138, .28), transparent 55%),
        linear-gradient(180deg, #faf8f5 0%, #f3f0eb 45%, #e8e2d8 100%);
    min-height: calc(100vh - 80px);
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 4.5rem 1.25rem 3.5rem;
    position: relative;
    overflow: hidden;
}

.gold-exchange-page::before {
    content: "";
    position: absolute;
    inset: 0;
    background-image:
        linear-gradient(rgba(28, 25, 23, .03) 1px, transparent 1px),
        linear-gradient(90deg, rgba(28, 25, 23, .03) 1px, transparent 1px);
    background-size: 48px 48px;
    mask-image: radial-gradient(ellipse 70% 60% at 50% 40%, black, transparent 75%);
    pointer-events: none;
    opacity: .6;
}

.gold-exchange-inner {
    position: relative;
    z-index: 1;
    width: 100%;
    max-width: 680px;
    text-align: center;
}

.gold-exchange-title {
    font-family: 'Cormorant Garamond', Georgia, serif;
    font-size: clamp(2.5rem, 7vw, 4.25rem);
    font-weight: 500;
    letter-spacing: .1em;
    line-height: 1.05;
    text-transform: uppercase;
    margin: 0 0 1.25rem;
    animation: exchangeFadeUp .9s ease both;
}

.gold-exchange-rule {
    width: 56px;
    height: 1px;
    margin: 0 auto 1.5rem;
    background: linear-gradient(90deg, transparent, var(--exchange-gold), transparent);
    animation: exchangeFadeUp .9s ease .12s both;
}

.gold-exchange-headline {
    font-family: 'Cormorant Garamond', Georgia, serif;
    font-size: clamp(1.35rem, 3.5vw, 1.75rem);
    font-style: italic;
    letter-spacing: .04em;
    color: var(--exchange-gold);
    margin: 0 0 1rem;
    animation: exchangeFadeUp .9s ease .2s both;
}

.gold-exchange-copy {
    max-width: 30rem;
    margin: 0 auto 2.25rem;
    color: var(--exchange-muted);
    font-size: clamp(.95rem, 2vw, 1.05rem);
    line-height: 1.65;
    animation: exchangeFadeUp .9s ease .3s both;
}

.gold-exchange-cta {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: .65rem;
    min-width: 280px;
    min-height: 50px;
    padding: .75rem 1.75rem;
    color: #fff !important;
    background: #17120f !important;
    border: 1px solid #17120f !important;
    border-radius: 0 !important;
    text-decoration: none !important;
    font-family: 'Poppins', sans-serif !important;
    font-size: 11px !important;
    font-weight: 500 !important;
    letter-spacing: .16em;
    text-transform: uppercase;
    transition: background-color .2s ease, color .2s ease;
    animation: exchangeFadeUp .9s ease .42s both;
}

.gold-exchange-cta:hover,
.gold-exchange-cta:focus-visible {
    color: #17120f !important;
    background: transparent !important;
}

.gold-exchange-cta svg {
    width: 16px;
    height: 16px;
}

.gold-exchange-note {
    margin-top: 1.75rem;
    color: var(--exchange-muted);
    font-size: .75rem;
    letter-spacing: .12em;
    text-transform: uppercase;
    opacity: .75;
    animation: exchangeFadeUp .9s ease .55s both;
}

@keyframes exchangeFadeUp {
    from { opacity: 0; transform: translateY(18px); }
    to { opacity: 1; transform: translateY(0); }
}

@media (max-width: 575.98px) {
    .gold-exchange-page {
        min-height: calc(100svh - 60px);
        padding: 5.5rem 1.15rem 3rem;
    }

    .gold-exchange-title { letter-spacing: .07em; }
    .gold-exchange-cta { width: 100%; max-width: 320px; }
}
</style>

<section class="gold-exchange-page">
    <div class="gold-exchange-inner">
        <h1 class="gold-exchange-title">Hanif Gold Exchange</h1>
        <div class="gold-exchange-rule" aria-hidden="true"></div>
        <p class="gold-exchange-headline">Exchange Gold with Confidence</p>
        <p class="gold-exchange-copy">
            Join our official WhatsApp channel for gold exchange updates, guidance, and trusted assistance from Hanif Jewellers.
        </p>
        <a
            class="gold-exchange-cta"
            href="https://www.whatsapp.com/channel/0029Vb7KL8H3rZZc3W4YMP3A"
            target="_blank"
            rel="noopener noreferrer"
        >
            <svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.435 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
            </svg>
            Join WhatsApp Channel
        </a>
        <p class="gold-exchange-note">Official Hanif Gold Exchange channel</p>
    </div>
</section>
@endsection
