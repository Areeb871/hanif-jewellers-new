@extends('public.layouts.header_new')

@section('content')
<style>
<style>
body {
    background: #f3f3f3;
    font-family: "Georgia", serif;
    margin: 0;
    padding: 0;
}

/* Container */
.polychroma-section {
    padding: 40px 0 70px;
    background-color:black;
}

.polychroma-container {
    max-width: 1300px;
    margin: auto;
    padding: 0 20px;
}

/* Header */
.polychroma-header {
    text-align: center;
    max-width: 760px;
    margin: 0 auto 70px;
}

.polychroma-header h2 {
    font-size: 34px;
    line-height: 1.25;
    letter-spacing: 8px;
    font-weight: 400;
    color: white;
    margin: 0 0 18px;
    text-transform: uppercase;
    font-family: "Bulgari_Capitalis" !important;
}

.polychroma-header p {
    font-family: "Helvetica Neue", Arial, sans-serif;
    font-size: 16px;
    line-height: 1.8;
    color: white;
    font-weight: 300;
    margin: 0 auto;
    max-width: 760px;
}

/* Slider wrapper */
.polychroma-slider-wrapper {
    position: relative;
    padding: 0 40px;
}

/* IMPORTANT: this hides extra images */
.polychroma-slider-viewport {
    overflow: hidden;
    width: 100%;
}

/* Track */
.polychroma-slider-track {
    display: flex;
    transition: transform 0.6s ease;
}

/* Desktop: exactly 3 items */
.polychroma-item {
    flex: 0 0 33.3333%;
    max-width: 33.3333%;
    box-sizing: border-box;
    padding: 0 15px;
    text-align: center;
}

/* Image */
.image-box {
    width: 100%;
    height: 500px;
    background: #eaeaea;
    margin-bottom: 25px;
    overflow: hidden;
}

.image-box img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
}

/* Title */
.polychroma-item h3 {
    font-size: 14px;
    letter-spacing: 3px;
    text-transform: uppercase;
    color: white;
    margin: 0;
}

/* Arrows */
.arrow-btn {
    position: absolute;
    top: 42%;
    transform: translateY(-50%);
    width: 40px;
    height: 40px;
    border: none;
    background: transparent;
    cursor: pointer;
    z-index: 10;
    padding: 0;
    display: flex;
    align-items: center;
    justify-content: center;
}

.arrow-btn.left {
    left: 0;
}

.arrow-btn.right {
    right: 0;
}

.arrow-icon {
    width: 76px;
    height: 76px;
    fill: white;
    display: block;
}

/* Dots */
.slider-dots {
    text-align: center;
    margin-top: 30px;
}

.slider-dots span {
    display: inline-block;
    width: 8px;
    height: 8px;
    margin: 0 6px;
    background: #ccc;
    border-radius: 50%;
    cursor: pointer;
    transition: 0.3s ease;
}

.slider-dots span.active {
    background: #111;
    transform: scale(1.2);
}

/* Banner */
.sectionOne,
.sectionMobile {
    position: relative;
    width: 100%;
    height: auto;
    overflow: hidden;
    margin: 0 !important;
    padding: 0 !important;
}

.sectionOne video,
.sectionMobile video {
    width: 100%;
    height: auto;
    display: block;
    object-fit: contain;
}

/* Tablet */
@media (max-width: 992px) {
    .polychroma-item {
        flex: 0 0 50%;
        max-width: 50%;
    }

    .image-box {
        height: 440px;
    }
}

/* Mobile */
@media (max-width: 576px) {
    .polychroma-slider-wrapper {
        padding: 0 30px;
    }

    .polychroma-item {
        flex: 0 0 100%;
        max-width: 100%;
    }

    .image-box {
        height: 400px;
    }

    .polychroma-header h2 {
        font-size: 26px;
        letter-spacing: 5px;
    }

    .polychroma-header p {
        font-size: 14px;
    }
}
</style>

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

<section class="polychroma-section">
    <div class="polychroma-container">

        <div class="polychroma-header">
            <h2>JEWELS OF THE CROWN</h2>
            <p>
                Behold the "Jewel of the Crown"—an extraordinary necklace that transcends time, crafted for those who rule not just kingdoms, but generations. At its heart rests a majestic above 100ct emerald, cut with unparalleled precision, cradled in a royal crown-inspired base sculpted like the crescent moon.
            </p>
        </div>

        <div class="polychroma-slider-wrapper">

            <button class="arrow-btn left" onclick="moveSlide(-1)" aria-label="Previous Slide">
                <svg class="arrow-icon" viewBox="0 0 24 24" aria-hidden="true">
                    <path d="M14.7 6.3a1 1 0 0 1 0 1.4L10.41 12l4.29 4.3a1 1 0 1 1-1.41 1.4l-5-5a1 1 0 0 1 0-1.4l5-5a1 1 0 0 1 1.41 0z"/>
                </svg>
            </button>

            <div class="polychroma-slider-viewport">
                <div class="polychroma-slider-track" id="sliderTrack">

                    <div class="polychroma-item">
                        <div class="image-box">
                            <img src="{{ asset('assets/f_assets/image/highend/1.jpeg') }}" alt="Tawoos">
                        </div>
                        <h3>TAWOOS</h3>
                    </div>

                    <div class="polychroma-item">
                        <div class="image-box">
                            <img src="{{ asset('assets/f_assets/image/highend/2.jpeg') }}" alt="Gohar">
                        </div>
                        <h3>GOHAR</h3>
                    </div>

                    <div class="polychroma-item">
                        <div class="image-box">
                            <img src="{{ asset('assets/f_assets/image/highend/3.jpeg') }}" alt="Gulposh">
                        </div>
                        <h3>GULPOSH</h3>
                    </div>

                    <div class="polychroma-item">
                        <div class="image-box">
                            <img src="{{ asset('assets/f_assets/image/highend/4.jpeg') }}" alt="Misterio">
                        </div>
                        <h3>MISTERIO</h3>
                    </div>

                    <div class="polychroma-item">
                        <div class="image-box">
                            <img src="{{ asset('assets/f_assets/image/highend/5.jpeg') }}" alt="Nagar">
                        </div>
                        <h3>NAGAR</h3>
                    </div>
                    <!-- <div class="polychroma-item">
                        <div class="image-box">
                            <img src="{{ asset('assets/f_assets/image/highend/6.png') }}" alt="JOC">
                        </div>
                        <h3>JOC</h3>
                    </div>
                    <div class="polychroma-item">
                        <div class="image-box">
                            <img src="{{ asset('assets/f_assets/image/highend/7.png') }}" alt="Timeless Blue">
                        </div>
                        <h3>Timeless Blue</h3>
                    </div> -->

                </div>
            </div>

            <button class="arrow-btn right" onclick="moveSlide(1)" aria-label="Next Slide">
                <svg class="arrow-icon" viewBox="0 0 24 24" aria-hidden="true">
                    <path d="M9.3 17.7a1 1 0 0 1 0-1.4L13.59 12 9.3 7.7a1 1 0 1 1 1.41-1.4l5 5a1 1 0 0 1 0 1.4l-5 5a1 1 0 0 1-1.41 0z"/>
                </svg>
            </button>

        </div>

        <div class="slider-dots" id="sliderDots"></div>

    </div>
</section>

<script>
const track = document.getElementById('sliderTrack');
const items = document.querySelectorAll('.polychroma-item');
const dotsContainer = document.getElementById('sliderDots');

let currentIndex = 0;
let itemsPerView = getItemsPerView();
let maxIndex = items.length - itemsPerView;

function getItemsPerView() {
    if (window.innerWidth <= 576) return 1;
    if (window.innerWidth <= 992) return 2;
    return 3;
}

function createDots() {
    dotsContainer.innerHTML = '';
    itemsPerView = getItemsPerView();
    maxIndex = items.length - itemsPerView;

    for (let i = 0; i <= maxIndex; i++) {
        const dot = document.createElement('span');
        if (i === currentIndex) dot.classList.add('active');

        dot.addEventListener('click', function () {
            currentIndex = i;
            updateSlider();
        });

        dotsContainer.appendChild(dot);
    }
}

function updateSlider() {
    itemsPerView = getItemsPerView();
    maxIndex = items.length - itemsPerView;

    if (currentIndex < 0) currentIndex = 0;
    if (currentIndex > maxIndex) currentIndex = maxIndex;

    const itemWidth = items[0].offsetWidth;
    track.style.transform = `translateX(-${currentIndex * itemWidth}px)`;

    const dots = dotsContainer.querySelectorAll('span');
    dots.forEach((dot, index) => {
        dot.classList.toggle('active', index === currentIndex);
    });
}

function moveSlide(direction) {
    currentIndex += direction;

    if (currentIndex > maxIndex) currentIndex = 0;
    if (currentIndex < 0) currentIndex = maxIndex;

    updateSlider();
}

window.addEventListener('resize', function () {
    itemsPerView = getItemsPerView();
    maxIndex = items.length - itemsPerView;

    if (currentIndex > maxIndex) {
        currentIndex = maxIndex;
    }

    createDots();
    updateSlider();
});

createDots();
updateSlider();
</script>
<section class="infinite-section">
    <div class="infinite-wrapper">

        <!-- LEFT IMAGE -->
        <div class="infinite-image">
          <img src="{{ asset('assets/f_assets/image/highend/banner1.jpeg') }}">
        </div>

        <!-- RIGHT CONTENT -->
        <div class="infinite-content">
            <h2>HIGH END JEWELLRY</h2>
            <!-- <p>
                Bold asymmetry, dynamic volumes and unexpected contrasts embody Bvlgari’s unique 
                approach to High Jewelry. Drawing from a plurality of inspirations, each creation 
                is a fluid expression of endless transformation, reinventing colors, forms, textures 
                and jewelry-making techniques with audacious creativity and artisanal mastery.
            </p> -->
        </div>

    </div>
</section>

<section class="infinite-section">
    <div class="infinite-wrapper">

        <!-- RIGHT CONTENT -->
        <div class="infinite-content">
            <h2>EMERALD NECKLACE</h2>
            <p>
                A symphony composed with the rarest brilliance and timeless allure, 
                Timeless Jewels ensemble the epitome of refined artistry.
            </p>
        </div>
         <!-- LEFT IMAGE -->
        <div class="infinite-image">
          <img src="{{ asset('assets/f_assets/image/highend/banner2.jpeg') }}">
        </div>

    </div>
</section>
<!-- <section class="infinite-section">
    <div class="infinite-wrapper">

         LEFT IMAGE -
        <div class="infinite-image">
          <img src="{{ asset('assets/f_assets/image/highend/banner3.avif') }}">
        </div>

        RIGHT CONTENT 
        <div class="infinite-content">
            <h2>INFINITE SHAPES</h2>
            <p>
                Bold asymmetry, dynamic volumes and unexpected contrasts embody Bvlgari’s unique 
                approach to High Jewelry. Drawing from a plurality of inspirations, each creation 
                is a fluid expression of endless transformation, reinventing colors, forms, textures 
                and jewelry-making techniques with audacious creativity and artisanal mastery.
            </p>
        </div>

    </div>
</section> -->
<style>
    .infinite-section {
    background:black;
    padding: 40px 0;
}

.infinite-wrapper {
    display: flex;
    align-items: center;
    justify-content: space-between;
}

/* LEFT IMAGE */
.infinite-image {
    width: 70%;
}

.infinite-image img {
    width: 100%;
    height: auto;
    display: block;
}

/* RIGHT TEXT */
.infinite-content {
    width: 30%;
    padding: 0 60px;
}

.infinite-content h2 {
 font-size: 26px;
    letter-spacing: 6px;
    font-weight: 400;
    margin-bottom: 20px;
    text-transform: uppercase;
    color: white;
    font-family: "Bulgari_Capitalis" !important;
    text-align: center;
}

.infinite-content p {
    font-size: 14px;
    line-height: 1.8;
    color: white;
    font-family: Arial, sans-serif;
}
@media (max-width: 992px) {
    .infinite-wrapper {
        flex-direction: column;
    }

    .infinite-image,
    .infinite-content {
        width: 100%;
    }

    .infinite-content {
        padding: 30px 20px;
        text-align: center;
    }
}
</style>

@endsection