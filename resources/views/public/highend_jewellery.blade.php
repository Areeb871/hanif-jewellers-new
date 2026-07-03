@extends('public.layouts.header_latest')
@section('content')
<style>
.highend-page {
    --highend-gold: #c7a76a;
    --highend-cream: #f5f0e8;
    --highend-muted: rgba(245, 240, 232, 0.78);
    background: #0a0a0a;
    color: var(--highend-cream);
    font-family: "Montserrat", sans-serif;
}

.highend-eyebrow {
    display: block;
    font-family: "Montserrat", sans-serif;
    font-size: 11px;
    font-weight: 500;
    letter-spacing: 0.28em;
    text-transform: uppercase;
    color: var(--highend-gold);
    margin-bottom: 22px;
}

.highend-heading {
    font-family: "Cormorant Garamond", "Times New Roman", Times, serif;
    font-size: 42px;
    line-height: 1.2;
    letter-spacing: 0.12em;
    font-weight: 400;
    color: var(--highend-cream);
    margin: 0 0 32px;
    text-transform: uppercase;
}

.highend-heading::after {
    content: "";
    display: block;
    width: 72px;
    height: 1px;
    background: var(--highend-gold);
    margin: 28px auto 0;
    opacity: 0.9;
}

.highend-heading--left::after {
    margin-left: 0;
    margin-right: auto;
}

.highend-body {
    font-family: "Montserrat", sans-serif;
    font-size: 15px;
    line-height: 2;
    color: var(--highend-muted);
    font-weight: 300;
    margin: 0;
}

.polychroma-section {
    padding: 100px 0 110px;
    background-color: #000;
}

.polychroma-container {
    max-width: 1240px;
    margin: auto;
    padding: 0 32px;
}

.polychroma-header {
    text-align: center;
    max-width: 720px;
    margin: 0 auto 90px;
}

.polychroma-header .highend-heading::after {
    margin-left: auto;
    margin-right: auto;
}

.polychroma-slider-wrapper {
    position: relative;
    padding: 0 48px;
}

.polychroma-slider-viewport {
    overflow: hidden;
    width: 100%;
    touch-action: pan-y;
}

.polychroma-slider-track {
    display: flex;
    transition: transform 0.6s ease;
}

.polychroma-item {
    flex: 0 0 33.3333%;
    max-width: 33.3333%;
    box-sizing: border-box;
    padding: 0 18px;
    text-align: center;
}

.polychroma-item a {
    display: block;
    text-decoration: none;
    color: inherit;
}

.polychroma-item a:hover h3 {
    color: var(--highend-gold);
}

.image-box {
    width: 100%;
    height: 520px;
    background: #141414;
    margin-bottom: 36px;
    overflow: hidden;
}

.image-box img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
    transition: transform 0.6s ease;
}

.polychroma-item a:hover .image-box img {
    transform: scale(1.04);
}

.polychroma-item h3 {
    font-family: "Cormorant Garamond", "Times New Roman", Times, serif;
    font-size: 17px;
    letter-spacing: 0.22em;
    text-transform: uppercase;
    color: var(--highend-cream);
    margin: 0;
    font-weight: 500;
    transition: color 0.3s ease;
}

.arrow-btn {
    position: absolute;
    top: 260px;
    transform: translateY(-50%);
    width: 48px;
    height: 48px;
    border: 1px solid rgba(199, 167, 106, 0.35);
    border-radius: 50%;
    background: rgba(0, 0, 0, 0.25);
    cursor: pointer;
    z-index: 10;
    padding: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: border-color 0.3s ease, background 0.3s ease;
}

.arrow-btn:hover:not(:disabled) {
    border-color: var(--highend-gold);
    background: rgba(199, 167, 106, 0.12);
}

.arrow-btn.left { left: 0; }
.arrow-btn.right { right: 0; }

.arrow-btn:disabled {
    opacity: 0.25;
    cursor: default;
}

.arrow-icon {
    width: 22px;
    height: 22px;
    fill: var(--highend-gold);
    display: block;
    pointer-events: none;
}

.slider-dots {
    text-align: center;
    margin-top: 48px;
}

.slider-dots button {
    display: inline-block;
    width: 6px;
    height: 6px;
    margin: 0 8px;
    padding: 0;
    border: none;
    background: rgba(199, 167, 106, 0.3);
    border-radius: 50%;
    cursor: pointer;
    transition: 0.3s ease;
}

.slider-dots button.active {
    background: var(--highend-gold);
    transform: scale(1.4);
}

.sectionOne,
.sectionMobile {
    position: relative;
    width: 100%;
    height: auto;
    overflow: hidden;
    margin: 0 !important;
    padding: 0 !important;
    z-index: 1;
}

.sectionOne video,
.sectionMobile video {
    width: 100%;
    height: auto;
    display: block;
    object-fit: contain;
}

.infinite-section {
    background: #000;
    padding: 90px 0;
    border-top: 1px solid rgba(199, 167, 106, 0.15);
}

.infinite-wrapper {
    display: flex;
    align-items: center;
    justify-content: space-between;
    max-width: 1240px;
    margin: 0 auto;
    padding: 0 32px;
    gap: 48px;
}

.infinite-image {
    width: 68%;
    flex-shrink: 0;
}

.infinite-image img {
    width: 100%;
    height: auto;
    display: block;
}

.infinite-content {
    width: 32%;
    padding: 0 20px 0 0;
    text-align: left;
}

.infinite-content .highend-heading {
    font-size: 32px;
    letter-spacing: 0.1em;
    margin-bottom: 28px;
}

.infinite-content .highend-body {
    font-size: 14px;
    line-height: 1.95;
}

@media (max-width: 992px) {
    .polychroma-section {
        padding: 72px 0 80px;
    }

    .polychroma-item {
        flex: 0 0 50%;
        max-width: 50%;
    }

    .image-box {
        height: 460px;
    }

    .arrow-btn {
        top: 230px;
    }

    .infinite-section {
        padding: 64px 0;
    }

    .infinite-wrapper {
        flex-direction: column;
        gap: 36px;
    }

    .infinite-image,
    .infinite-content {
        width: 100%;
    }

    .infinite-content {
        padding: 0 12px;
        text-align: center;
    }

    .infinite-content .highend-heading::after {
        margin-left: auto;
        margin-right: auto;
    }

    .infinite-wrapper--image-first-mobile .infinite-image {
        order: -1;
    }

    .highend-heading {
        font-size: 34px;
    }

    .infinite-content .highend-heading {
        font-size: 28px;
    }
}

@media (max-width: 576px) {
    .polychroma-slider-wrapper {
        padding: 0 36px;
    }

    .polychroma-item {
        flex: 0 0 100%;
        max-width: 100%;
    }

    .image-box {
        height: 420px;
        margin-bottom: 28px;
    }

    .arrow-btn {
        top: 210px;
        width: 42px;
        height: 42px;
    }

    .polychroma-header {
        margin-bottom: 56px;
    }

    .highend-heading {
        font-size: 28px;
        letter-spacing: 0.08em;
    }

    .highend-body {
        font-size: 14px;
        line-height: 1.85;
    }

    .polychroma-item h3 {
        font-size: 15px;
        letter-spacing: 0.18em;
    }
}
</style>

<div class="highend-page">
<!-- DESKTOP BANNER -->
<section class="sectionOne d-md-block d-none">
    <video autoplay loop muted playsinline>
        <source src="{{ asset('assets/f_assets/image/highend/banner.mp4') }}" type="video/webm">
        Your browser does not support the video tag.
    </video>
</section>

<!-- MOBILE BANNER -->
<section class="sectionMobile d-md-none">
    <video autoplay loop muted playsinline>
        <source src="{{ asset('assets/f_assets/image/highend/mobview.mp4') }}" type="video/webm">
        Your browser does not support the video tag.
    </video>
</section>

<section class="polychroma-section" id="jewels-of-the-crown">
    <div class="polychroma-container">

        <div class="polychroma-header">
            <span class="highend-eyebrow">Hanif High Jewellery</span>
            <h2 class="highend-heading">Jewels of the Crown</h2>
            <p class="highend-body">
                Behold the Jewel of the Crown—an extraordinary necklace that transcends time, crafted for those who rule not just kingdoms, but generations. At its heart rests a majestic above 100ct emerald, cut with unparalleled precision, cradled in a royal crown-inspired base sculpted like the crescent moon.
            </p>
        </div>

        <div class="polychroma-slider-wrapper">

            <button type="button" class="arrow-btn left" id="sliderPrev" aria-label="Previous slide">
                <svg class="arrow-icon" viewBox="0 0 24 24" aria-hidden="true">
                    <path d="M14.7 6.3a1 1 0 0 1 0 1.4L10.41 12l4.29 4.3a1 1 0 1 1-1.41 1.4l-5-5a1 1 0 0 1 0-1.4l5-5a1 1 0 0 1 1.41 0z"/>
                </svg>
            </button>

            <div class="polychroma-slider-viewport" id="sliderViewport">
                <div class="polychroma-slider-track" id="sliderTrack">

                    <div class="polychroma-item">
                        <a href="{{ url('/collections/tawoos') }}">
                            <div class="image-box">
                                <img src="{{ asset('assets/f_assets/image/highend/1.jpeg') }}" alt="Tawoos Collection">
                            </div>
                            <h3>TAWOOS</h3>
                        </a>
                    </div>

                    <div class="polychroma-item">
                        <a href="{{ url('/collections/gohar') }}">
                            <div class="image-box">
                                <img src="{{ asset('assets/f_assets/image/highend/2.jpeg') }}" alt="Gohar Collection">
                            </div>
                            <h3>GOHAR</h3>
                        </a>
                    </div>

                    <div class="polychroma-item">
                        <a href="{{ url('/collections/gulposh') }}">
                            <div class="image-box">
                                <img src="{{ asset('assets/f_assets/image/highend/3.jpeg') }}" alt="Gulposh Collection">
                            </div>
                            <h3>GULPOSH</h3>
                        </a>
                    </div>

                    <div class="polychroma-item">
                        <a href="{{ url('/collections/misterio') }}">
                            <div class="image-box">
                                <img src="{{ asset('assets/f_assets/image/highend/4.jpeg') }}" alt="Misterio Collection">
                            </div>
                            <h3>MISTERIO</h3>
                        </a>
                    </div>

                    <div class="polychroma-item">
                        <a href="{{ url('/collections/nagar') }}">
                            <div class="image-box">
                                <img src="{{ asset('assets/f_assets/image/highend/5.jpeg') }}" alt="Nagar Collection">
                            </div>
                            <h3>NAGAR</h3>
                        </a>
                    </div>

                    <div class="polychroma-item">
                        <a href="{{ url('/highend-jewellery') }}#jewels-of-the-crown">
                            <div class="image-box">
                                <img src="{{ asset('assets/f_assets/image/highend/6.png') }}" alt="Jewels of the Crown">
                            </div>
                            <h3>JOC</h3>
                        </a>
                    </div>

                    <div class="polychroma-item">
                        <a href="{{ url('/collections/timeless-jewels') }}">
                            <div class="image-box">
                                <img src="{{ asset('assets/f_assets/image/highend/7.png') }}" alt="Timeless Blue Collection">
                            </div>
                            <h3>TIMELESS BLUE</h3>
                        </a>
                    </div>

                </div>
            </div>

            <button type="button" class="arrow-btn right" id="sliderNext" aria-label="Next slide">
                <svg class="arrow-icon" viewBox="0 0 24 24" aria-hidden="true">
                    <path d="M9.3 17.7a1 1 0 0 1 0-1.4L13.59 12 9.3 7.7a1 1 0 1 1 1.41-1.4l5 5a1 1 0 0 1 0 1.4l-5 5a1 1 0 0 1-1.41 0z"/>
                </svg>
            </button>

        </div>

        <div class="slider-dots" id="sliderDots"></div>

    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const track = document.getElementById('sliderTrack');
    const viewport = document.getElementById('sliderViewport');
    const dotsEl = document.getElementById('sliderDots');
    const prevBtn = document.getElementById('sliderPrev');
    const nextBtn = document.getElementById('sliderNext');

    if (!track || !viewport || !dotsEl || !prevBtn || !nextBtn) {
        return;
    }

    const items = track.querySelectorAll('.polychroma-item');
    if (!items.length) {
        return;
    }

    let index = 0;
    let resizeTimer = null;
    let touchStartX = 0;
    let touchStartY = 0;

    function itemsPerView() {
        if (window.innerWidth <= 576) return 1;
        if (window.innerWidth <= 992) return 2;
        return 3;
    }

    function lastIndex() {
        return Math.max(0, items.length - itemsPerView());
    }

    function buildDots() {
        dotsEl.innerHTML = '';
        for (let i = 0; i <= lastIndex(); i++) {
            const dot = document.createElement('button');
            dot.type = 'button';
            dot.setAttribute('aria-label', 'Go to slide ' + (i + 1));
            dot.addEventListener('click', function () { goTo(i); });
            dotsEl.appendChild(dot);
        }
    }

    function goTo(i) {
        index = Math.max(0, Math.min(i, lastIndex()));
        track.style.transform = 'translateX(-' + (index * items[0].offsetWidth) + 'px)';
        prevBtn.disabled = index === 0;
        nextBtn.disabled = index === lastIndex();
        dotsEl.querySelectorAll('button').forEach(function (dot, n) {
            dot.classList.toggle('active', n === index);
        });
    }

    function refreshSlider() {
        buildDots();
        goTo(index);
    }

    prevBtn.addEventListener('click', function () { goTo(index - 1); });
    nextBtn.addEventListener('click', function () { goTo(index + 1); });

    viewport.addEventListener('touchstart', function (e) {
        touchStartX = e.touches[0].clientX;
        touchStartY = e.touches[0].clientY;
    }, { passive: true });

    viewport.addEventListener('touchend', function (e) {
        const touchEndX = e.changedTouches[0].clientX;
        const touchEndY = e.changedTouches[0].clientY;
        const diffX = touchStartX - touchEndX;
        const diffY = touchStartY - touchEndY;

        if (Math.abs(diffX) > 50 && Math.abs(diffX) > Math.abs(diffY)) {
            goTo(index + (diffX > 0 ? 1 : -1));
        }
    }, { passive: true });

    window.addEventListener('resize', function () {
        clearTimeout(resizeTimer);
        resizeTimer = setTimeout(refreshSlider, 150);
    });

    window.addEventListener('load', refreshSlider);

    track.querySelectorAll('img').forEach(function (img) {
        if (!img.complete) {
            img.addEventListener('load', goTo.bind(null, index), { once: true });
        }
    });

    refreshSlider();
});
</script>

<section class="infinite-section">
    <div class="infinite-wrapper">

        <div class="infinite-image">
            <img src="{{ asset('assets/f_assets/image/highend/banner1.jpeg') }}" alt="High End Jewellery Collection">
        </div>

        <div class="infinite-content">
            <span class="highend-eyebrow">The Collection</span>
            <h2 class="highend-heading highend-heading--left">High End Jewellery</h2>
            <p class="highend-body">
                Bold asymmetry, dynamic volumes and unexpected contrasts define Hanif's unique approach to high jewellery. Each creation is a fluid expression of endless transformation—reinventing colour, form and artisanal mastery with audacious creativity.
            </p>
        </div>

    </div>
</section>

<section class="infinite-section">
    <div class="infinite-wrapper infinite-wrapper--image-first-mobile">

        <div class="infinite-content">
            <span class="highend-eyebrow">Masterpiece</span>
            <h2 class="highend-heading highend-heading--left">Emerald Necklace</h2>
            <p class="highend-body">
                A symphony composed with the rarest brilliance and timeless allure. Each stone is selected for its depth of colour and character, brought together through generations of craftsmanship into a piece worthy of becoming an heirloom.
            </p>
        </div>

        <div class="infinite-image">
            <img src="{{ asset('assets/f_assets/image/highend/banner2.jpeg') }}" alt="Emerald Necklace">
        </div>

    </div>
</section>

</div>

@endsection
