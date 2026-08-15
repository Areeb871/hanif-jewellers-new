@extends('public.layouts.header_latest')

@section('content')
<style>
    .friends-page {
        --friends-ink: #181713;
        background: #fff;
        color: var(--friends-ink);
        overflow: hidden;
        padding: clamp(76px, 8vw, 132px) 0 clamp(82px, 9vw, 150px);
    }

    .friends-page h1,
    .friends-page h2,
    .friends-page h3,
    .friends-page h4,
    .friends-page h5,
    .friends-page h6,
    .friends-directory__name {
        font-family: "Argent CF", Georgia, serif;
    }

    .friends-page p,
    .friends-directory__role {
        font-family: "Poppins", Arial, sans-serif !important;
    }

    .friends-page__shell {
        width: min(100% - 40px, 1120px);
        margin: 0 auto;
    }

    .friends-page__intro {
        max-width: 670px;
        margin: 0 auto clamp(72px, 8vw, 126px);
        text-align: center;
    }

    .friends-page__eyebrow,
    .friends-feature__name {
        margin: 0;
        font-family: "Argent CF", Georgia, serif;
        font-weight: 500;
        text-transform: uppercase;
    }

    .friends-page__eyebrow {
        font-size: clamp(34px, 4.2vw, 64px);
        line-height: .95;
        letter-spacing: .055em;
    }

    @media (min-width: 601px) {
        .friends-page {
            padding-top: clamp(74px, 7vw, 126px);
        }

        .friends-page__eyebrow {
            position: relative;
            left: 50%;
            display: block;
            width: min(1500px, calc(100vw - 48px));
            height: auto;
            transform: translateX(-50%);
            font-family: "Argent CF", Georgia, serif;
            font-size: clamp(38px, 6.2vw, 112px);
            font-weight: 100;
            font-style: normal;
            line-height: .94;
            letter-spacing: .035em;
            text-align: center;
            text-transform: uppercase;
            color: #000;
            white-space: nowrap;
        }
    }

    .friends-page__rule {
        width: 38px;
        height: 1px;
        margin: 32px auto 27px;
        background: var(--friends-ink);
    }

    .friends-page__lead,
    .friends-feature__copy {
        margin: 0;
        font-family: "Poppins", Arial, sans-serif;
        font-weight: 100;
        text-transform: none;
        line-height: 1.85;
    }

    .friends-page__lead {
        max-width: 720px;
        margin-right: auto;
        margin-left: auto;
        font-size: clamp(10px, .72vw, 13px);
    }

    .friends-page__section-title {
        margin: 0;
        font-family: "Argent CF", Georgia, serif;
        font-size: clamp(13px, 1vw, 17px);
        font-weight: 400;
        line-height: 1;
        letter-spacing: .055em;
        text-align: center;
        text-transform: uppercase;
    }

    .friends-page__eyebrow + .friends-page__section-title {
        margin-top: clamp(52px, 6vw, 92px);
    }

    .friends-page__section-title + .friends-page__lead {
        margin-top: clamp(24px, 2.5vw, 38px);
    }

    .friends-page__emblem {
        display: block;
        width: 30px;
        height: 30px;
        margin: clamp(48px, 5vw, 76px) auto;
        object-fit: contain;
    }

    .friends-story {
        margin-top: clamp(66px, 8vw, 120px);
    }

    .friends-feature {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        align-items: end;
        gap: clamp(28px, 5vw, 72px);
    }

    .friends-feature__image-wrap {
        overflow: hidden;
        background: #eee9e3;
        aspect-ratio: 1 / 1;
    }

    .friends-feature__image {
        display: block;
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .friends-feature__image--portrait {
        object-position: center 24%;
    }

    .friends-feature__content {
        padding-bottom: clamp(8px, 2vw, 22px);
    }

    .friends-feature__name {
        font-size: clamp(21px, 2.2vw, 34px);
        letter-spacing: .02em;
        line-height: 1;
    }

    .friends-feature__line {
        display: inline-block;
        width: 30px;
        height: 1px;
        margin: 20px 0 17px;
        background: var(--friends-ink);
        vertical-align: top;
    }

    .friends-feature__copy {
        max-width: 430px;
        font-size: 13px;
    }

    .friends-gallery {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: clamp(6px, 1.4vw, 16px);
        margin-top: clamp(28px, 3vw, 46px);
    }

    .friends-gallery__item {
        overflow: hidden;
        aspect-ratio: 1 / 1;
        background: #eee9e3;
    }

    .friends-gallery__image {
        display: block;
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform .65s cubic-bezier(.2, .65, .25, 1);
    }

    .friends-gallery__item:hover .friends-gallery__image {
        transform: scale(1.025);
    }

    .friends-directory {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: clamp(10px, 1.6vw, 20px);
        margin-top: clamp(72px, 9vw, 132px);
    }

    .friends-directory__card {
        margin: 0;
        min-width: 0;
        text-align: center;
    }

    .friends-directory__image-wrap {
        overflow: hidden;
        aspect-ratio: 1 / 1.08;
        background: #eee9e3;
    }

    .friends-directory__image {
        display: block;
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform .65s cubic-bezier(.2, .65, .25, 1);
    }

    .friends-directory__card:hover .friends-directory__image {
        transform: scale(1.025);
    }

    .friends-directory__caption {
        min-height: 66px;
        padding: 13px 8px 18px;
        background: #fff;
    }

    .friends-directory__role,
    .friends-directory__name {
        display: block;
        margin: 0;
        text-transform: uppercase;
    }

    .friends-directory__role {
        font-family: "Poppins", Arial, sans-serif;
        font-size: 13px;
        font-weight: 600;
        line-height: 1.5;
    }

    .friends-directory__name {
        margin-top: 5px;
        font-family: "Poppins",sans-serif;
        font-size: 11px;
        font-weight: 200;
        line-height: 1;
    }

    @media (max-width: 600px) {
        .friends-page {
            padding-top: 58px;
        }

        .friends-page__shell {
            width: calc(100% - 24px);
        }

        .friends-page__intro {
            width: 100%;
            max-width: none;
            margin-bottom: 52px;
            padding: 0;
        }

        .friends-page__eyebrow {
            width: 100%;
            font-family: "Argent CF", Georgia, serif;
            font-size: clamp(22px, 7.2vw, 29px);
            font-weight: 100;
            line-height: 1;
            letter-spacing: .035em;
            text-align: center;
            white-space: nowrap;
        }

        .friends-page__rule {
            margin-top: 23px;
            margin-bottom: 20px;
        }

        .friends-page__lead {
            max-width: 330px;
            margin-right: auto;
            margin-left: auto;
            font-family: "Poppins", Arial, sans-serif;
            font-size: 7px;
            line-height: 1.65;
        }

        .friends-page__section-title {
            font-size: 10px;
        }

        .friends-page__eyebrow + .friends-page__section-title {
            margin-top: 48px;
        }

        .friends-page__section-title + .friends-page__lead {
            margin-top: 22px;
        }

        .friends-page__emblem {
            width: 17px;
            height: 17px;
            margin: 38px auto;
        }

        .friends-story {
            margin-top: 30px;
        }

        .friends-feature {
            gap: 10px;
        }

        .friends-feature__name {
            font-size: 10px;
        }

        .friends-feature__line {
            width: 15px;
            margin: 8px 0 6px;
        }

        .friends-feature__copy {
            font-size: 4.5px;
            line-height: 1.6;
            letter-spacing: .08em;
        }

        .friends-feature__content {
            padding-bottom: 3px;
        }

        .friends-gallery {
            margin-top: 13px;
        }

        .friends-directory {
            gap: 5px;
            margin-top: 42px;
        }

        .friends-directory__caption {
            min-height: 42px;
            padding: 7px 3px 10px;
        }

        .friends-directory__role {
            font-size: 4.5px;
        }

        .friends-directory__name {
            margin-top: 3px;
            font-size: 8px;
        }
    }

    @media (prefers-reduced-motion: reduce) {
        .friends-gallery__image,
        .friends-directory__image {
            transition: none;
        }
    }
</style>

<main class="friends-page">
    <div class="friends-page__shell">
        <section class="friends-page__intro" aria-labelledby="friends-page-title">
            <h1 class="friends-page__eyebrow" id="friends-page-title">Friends of the Brand</h1>
            <h2 class="friends-page__section-title">Ambassadors</h2>
            <p class="friends-page__lead">Artists, legends, athletes: our ambassadors are exceptional personalities, passionate about their respective fields and determined to make history.</p>
            <img class="friends-page__emblem" src="{{ asset('assets/f_assets/image/favicon_hanif_32x32.jpg') }}" alt="Hanif emblem">
            <h2 class="friends-page__section-title">Our Friends</h2>
            <p class="friends-page__lead">Greatness is recognized, not chosen. Friends of Hanif is a distinguished circle of celebrated personalities whose achievements, character, and enduring influence reflect the values of the House of Hanif.</p>
        </section>

        <section class="friends-story" aria-labelledby="friend-wasim">
            <div class="friends-feature">
                <div class="friends-feature__image-wrap">
                    <img class="friends-feature__image friends-feature__image--portrait" src="{{ asset('assets/f_assets/image/friend of the brands/1wasim.png') }}" alt="Wasim Akram wearing a luxury timepiece">
                </div>
                <div class="friends-feature__content">
                    <h2 class="friends-feature__name" id="friend-wasim">Wasim Akram</h2>
                    <span class="friends-feature__line" aria-hidden="true"></span>
                    <p class="friends-feature__copy">A legend of the game and a name recognised far beyond cricket, Wasim Akram carries an enduring global presence.
His connection with HANIF goes beyond titles and partnerships, built on respect, trust and shared moments.
An icon to the world, and a cherished friend of HANIF.</p>
                </div>
            </div>
            <div class="friends-gallery" aria-label="Wasim Akram gallery">
                <div class="friends-gallery__item"><img class="friends-gallery__image" src="{{ asset('assets/f_assets/image/friend of the brands/2wasim.png') }}" alt="Wasim Akram at a cricket match"></div>
                <div class="friends-gallery__item"><img class="friends-gallery__image" src="{{ asset('assets/f_assets/image/friend of the brands/3wasim.png') }}" alt="Wasim Akram wearing a luxury watch"></div>
                <div class="friends-gallery__item"><img class="friends-gallery__image" src="{{ asset('assets/f_assets/image/friend of the brands/4wasim.png') }}" alt="Wasim Akram representing Pakistan cricket"></div>
            </div>
        </section>

        <section class="friends-story" aria-labelledby="friend-ayeza">
            <div class="friends-feature">
                <div class="friends-feature__image-wrap">
                    <img class="friends-feature__image" src="{{ asset('assets/f_assets/image/friend of the brands/aizakhannagar1.png') }}" alt="Ayeza Khan wearing emerald jewellery">
                </div>
                <div class="friends-feature__content">
                    <h2 class="friends-feature__name" id="friend-ayeza">Ayeza Khan</h2>
                    <span class="friends-feature__line" aria-hidden="true"></span>
                    <p class="friends-feature__copy">Celebrated across screens and admired far beyond them, Ayeza Khan is a name that carries its own presence.
With HANIF, that connection goes beyond celebrity into a bond built over beautiful moments.
A celebrated star, a cherished friend, and a familiar part of the HANIF story.</p>
                </div>
            </div>
            <div class="friends-gallery" aria-label="Ayeza Khan gallery">
                <div class="friends-gallery__item"><img class="friends-gallery__image" src="{{ asset('assets/f_assets/image/friend of the brands/aizakhannagar2.png') }}" alt="Ayeza Khan wearing ruby jewellery"></div>
                <div class="friends-gallery__item"><img class="friends-gallery__image" src="{{ asset('assets/f_assets/image/friend of the brands/aizakhannagar3.png') }}" alt="Ayeza Khan wearing emerald and diamond jewellery"></div>
                <div class="friends-gallery__item"><img class="friends-gallery__image" src="{{ asset('assets/f_assets/image/friend of the brands/aizakhannagar4.png') }}" alt="Ayeza Khan wearing diamond and emerald jewellery"></div>
            </div>
        </section>

        <section class="friends-story" aria-labelledby="friend-hania">
            <div class="friends-feature">
                <div class="friends-feature__image-wrap">
                    <img class="friends-feature__image" src="{{ asset('assets/f_assets/image/friend of the brands/haniamir1.png') }}" alt="Hania Aamir wearing diamond jewellery">
                </div>
                <div class="friends-feature__content">
                    <h2 class="friends-feature__name" id="friend-hania">Hania Aamir</h2>
                    <span class="friends-feature__line" aria-hidden="true"></span>
                    <p class="friends-feature__copy">Hania Aamir and HANIF share a bond that goes beyond the spotlight.
A familiar face, a cherished friend, and part of some of our most memorable moments.
Hania with HANIF, a connection that simply feels natural.</p>
                </div>
            </div>
            <div class="friends-gallery" aria-label="Hania Aamir gallery">
                <div class="friends-gallery__item"><img class="friends-gallery__image" src="{{ asset('assets/f_assets/image/friend of the brands/haniamir2.png') }}" alt="Hania Aamir wearing gold bangles and a watch"></div>
                <div class="friends-gallery__item"><img class="friends-gallery__image" src="{{ asset('assets/f_assets/image/friend of the brands/haniaamir3.png') }}" alt="Hania Aamir watch campaign portrait"></div>
                <div class="friends-gallery__item"><img class="friends-gallery__image" src="{{ asset('assets/f_assets/image/friend of the brands/haniamir4.png') }}" alt="Hania Aamir wearing a luxury watch"></div>
            </div>
        </section>

        {{-- Legacy placeholder kept out of the rendered sequence.
        <section class="friends-story" aria-labelledby="friend-farah">
            <div class="friends-feature">
                <div class="friends-feature__image-wrap">
                    <img class="friends-feature__image" src="{{ asset('assets/f_assets/image/4.jpg') }}" alt="Farah Khan Fine Jewellery campaign portrait">
                </div>
                <div class="friends-feature__content">
                    <h2 class="friends-feature__name" id="friend-farah">Farah Khan</h2>
                    <span class="friends-feature__line" aria-hidden="true"></span>
                    <p class="friends-feature__copy">A celebrated alchemist of colour and imagination, Farah shares our belief that jewellery is more than an object—it is a memory, an emotion and a work of wearable art.</p>
                </div>
            </div>
            <div class="friends-gallery" aria-label="Farah Khan Fine Jewellery gallery">
                <div class="friends-gallery__item"><img class="friends-gallery__image" src="{{ asset('assets/f_assets/image/2.jpg') }}" alt="Farah Khan emerald jewellery"></div>
                <div class="friends-gallery__item"><img class="friends-gallery__image" src="{{ asset('assets/f_assets/image/farah-khan-banners/Amaira_2.webp') }}" alt="Farah Khan Amaira jewellery"></div>
                <div class="friends-gallery__item"><img class="friends-gallery__image" src="{{ asset('assets/f_assets/image/farah-khan-banners/Becharmed.webp') }}" alt="Farah Khan Becharmed jewellery"></div>
            </div>
        </section>

        --}}

        <section class="friends-directory" aria-label="More friends of the brand">
            <figure class="friends-directory__card">
                <div class="friends-directory__image-wrap">
                    <img class="friends-directory__image" src="{{ asset('assets/f_assets/image/friend of the brands/actor1.png') }}" alt="Friend of Hanif portrait 1">
                </div>
                <figcaption class="friends-directory__caption">
                    <span class="friends-directory__role">SHEHERYAR MUNAWAR SIDDIQUI</span>
                    <span class="friends-directory__name">Actor</span>
                </figcaption>
            </figure>

            <figure class="friends-directory__card">
                <div class="friends-directory__image-wrap">
                    <img class="friends-directory__image" src="{{ asset('assets/f_assets/image/friend of the brands/actor2.png') }}" alt="Friend of Hanif portrait 2">
                </div>
                <figcaption class="friends-directory__caption">
                    <span class="friends-directory__role">Adnan Siddiqui</span>
                    <span class="friends-directory__name">Actor/film producer</span>
                </figcaption>
            </figure>

            <figure class="friends-directory__card">
                <div class="friends-directory__image-wrap">
                    <img class="friends-directory__image" src="{{ asset('assets/f_assets/image/friend of the brands/actor3.png') }}" alt="Friend of Hanif portrait 3">
                </div>
                <figcaption class="friends-directory__caption">
                    <span class="friends-directory__role">Ushna shah</span>
                    <span class="friends-directory__name">Actress</span>
                </figcaption>
            </figure>

            <figure class="friends-directory__card">
                <div class="friends-directory__image-wrap">
                    <img class="friends-directory__image" src="{{ asset('assets/f_assets/image/friend of the brands/actor4.png') }}" alt="Friend of Hanif portrait 4">
                </div>
                <figcaption class="friends-directory__caption">
                    <span class="friends-directory__role">Manj Music</span>
                    <span class="friends-directory__name">Composer/singer</span>
                </figcaption>
            </figure>

            <figure class="friends-directory__card">
                <div class="friends-directory__image-wrap">
                    <img class="friends-directory__image" src="{{ asset('assets/f_assets/image/friend of the brands/actor5.png') }}" alt="Friend of Hanif portrait 5">
                </div>
                <figcaption class="friends-directory__caption">
                    <span class="friends-directory__role">Frahan Saeed</span>
                    <span class="friends-directory__name">Singer/Actor</span>
                </figcaption>
            </figure>

            <figure class="friends-directory__card">
                <div class="friends-directory__image-wrap">
                    <img class="friends-directory__image" src="{{ asset('assets/f_assets/image/friend of the brands/actor6.png') }}" alt="Friend of Hanif portrait 6">
                </div>
                <figcaption class="friends-directory__caption">
                    <span class="friends-directory__role">Iqra Aziz</span>
                    <span class="friends-directory__name">Actress</span>
                </figcaption>
            </figure>

            <figure class="friends-directory__card">
                <div class="friends-directory__image-wrap">
                    <img class="friends-directory__image" src="{{ asset('assets/f_assets/image/friend of the brands/actor7.png') }}" alt="Friend of Hanif portrait 7">
                </div>
                <figcaption class="friends-directory__caption">
                    <span class="friends-directory__role">Aima Baig</span>
                    <span class="friends-directory__name">Actress</span>
                </figcaption>
            </figure>

            <figure class="friends-directory__card">
                <div class="friends-directory__image-wrap">
                    <img class="friends-directory__image" src="{{ asset('assets/f_assets/image/friend of the brands/actor8.png') }}" alt="Friend of Hanif portrait 8">
                </div>
                <figcaption class="friends-directory__caption">
                    <span class="friends-directory__role">Nimra Khan</span>
                    <span class="friends-directory__name">Actress</span>
                </figcaption>
            </figure>
        </section>
    </div>
</main>
@endsection
