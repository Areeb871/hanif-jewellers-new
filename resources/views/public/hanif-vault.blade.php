@extends('public.layouts.header_black_white_fixed')

@section('content')
<style>
@import url('https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,400;0,500;0,600;1,400&family=Manrope:wght@400;500;600&display=swap');

.vault-page {
    --vault-ink: #1c1917;
    --vault-muted: #6b6560;
    --vault-gold: #9a8460;
    --vault-gold-soft: #c4b08a;
    --vault-wash: #f3f0eb;
    --vault-wash-2: #e8e2d8;
    --vault-wa: #128C7E;
    font-family: 'Manrope', sans-serif;
    color: var(--vault-ink);
    background:
        radial-gradient(ellipse 90% 70% at 50% -10%, rgba(196, 176, 138, 0.28), transparent 55%),
        linear-gradient(180deg, #faf8f5 0%, var(--vault-wash) 45%, var(--vault-wash-2) 100%);
    min-height: calc(100vh - 80px);
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 4.5rem 1.25rem 3.5rem;
    position: relative;
    overflow: hidden;
}

.vault-page::before {
    content: "";
    position: absolute;
    inset: 0;
    background-image:
        linear-gradient(rgba(28, 25, 23, 0.03) 1px, transparent 1px),
        linear-gradient(90deg, rgba(28, 25, 23, 0.03) 1px, transparent 1px);
    background-size: 48px 48px;
    mask-image: radial-gradient(ellipse 70% 60% at 50% 40%, black, transparent 75%);
    pointer-events: none;
    opacity: 0.6;
}

.vault-inner {
    position: relative;
    z-index: 1;
    width: 100%;
    max-width: 640px;
    text-align: center;
}

.vault-brand {
    font-family: 'Cormorant Garamond', Georgia, serif;
    font-size: clamp(2.75rem, 8vw, 4.5rem);
    font-weight: 500;
    letter-spacing: 0.14em;
    line-height: 1;
    text-transform: uppercase;
    margin: 0 0 1.25rem;
    color: var(--vault-ink);
    animation: vaultFadeUp 0.9s ease both;
}

.vault-rule {
    width: 56px;
    height: 1px;
    margin: 0 auto 1.5rem;
    background: linear-gradient(90deg, transparent, var(--vault-gold), transparent);
    animation: vaultFadeUp 0.9s ease 0.12s both;
}

.vault-headline {
    font-family: 'Cormorant Garamond', Georgia, serif;
    font-size: clamp(1.35rem, 3.5vw, 1.75rem);
    font-weight: 400;
    font-style: italic;
    letter-spacing: 0.04em;
    color: var(--vault-gold);
    margin: 0 0 1rem;
    animation: vaultFadeUp 0.9s ease 0.2s both;
}

.vault-copy {
    font-size: clamp(0.95rem, 2vw, 1.05rem);
    font-weight: 400;
    line-height: 1.65;
    color: var(--vault-muted);
    max-width: 28rem;
    margin: 0 auto 2.25rem;
    animation: vaultFadeUp 0.9s ease 0.3s both;
}

.vault-cta {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 0.65rem;
    min-height: 50px;
    min-width: 280px;
    padding: 0.75rem 1.75rem;
    background: #17120f !important;
    color: #fff !important;
    text-decoration: none !important;
    font-family: "Poppins", sans-serif !important;
    font-size: 11px !important;
    font-weight: 500 !important;
    letter-spacing: .16em;
    text-transform: uppercase;
    border: 1px solid #17120f !important;
    border-radius: 0 !important;
    transition: background-color .2s ease, color .2s ease;
    animation: vaultFadeUp 0.9s ease 0.42s both;
}

.vault-cta:hover,
.vault-cta:focus-visible {
    background: transparent !important;
    border-color: #17120f !important;
    color: #17120f !important;
}

.vault-cta svg {
    width: 16px;
    height: 16px;
    flex-shrink: 0;
}

.vault-note {
    margin-top: 1.75rem;
    font-size: 0.75rem;
    letter-spacing: 0.12em;
    text-transform: uppercase;
    color: var(--vault-muted);
    opacity: 0.75;
    animation: vaultFadeUp 0.9s ease 0.55s both;
}

@keyframes vaultFadeUp {
    from {
        opacity: 0;
        transform: translateY(18px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@media (max-width: 575.98px) {
    .vault-page {
        padding: 5.5rem 1.15rem 3rem;
        min-height: calc(100svh - 60px);
    }

    .vault-brand {
        letter-spacing: 0.1em;
    }

    .vault-cta {
        width: 100%;
        max-width: 320px;
    }
}
</style>

<section class="vault-page">
    <div class="vault-inner">
        <h1 class="vault-brand">Hanif Vault</h1>
        <div class="vault-rule" aria-hidden="true"></div>
        <p class="vault-headline">Experience Pure Art</p>
        <p class="vault-copy">
            Join our official WhatsApp channel for curated jewellery stories, new arrivals, and exclusive updates from Hanif Jewellers.
        </p>
        <a
            class="vault-cta"
            href="https://whatsapp.com/channel/0029VbD1vrS1iUxfH2RM3h0C"
            target="_blank"
            rel="noopener noreferrer"
        >
            <svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.435 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
            </svg>
            Join WhatsApp Channel
        </a>
        <p class="vault-note">Official Hanif Jewellers channel</p>
    </div>
</section>
@endsection
