@extends('public.layouts.header_latest')

@section('content')
<link rel="stylesheet" href="{{ asset('assets/f_assets/css/details.css') }}">
<script src="{{ asset('assets/f_assets/js/filter.js') }}" defer></script>
<section class="hj-product-detail-page">

    <div class="hj-product-container">

     {{-- LEFT IMAGE GALLERY --}}
<div class="hj-gallery-slider-wrap">

    <div class="hj-product-gallery" id="hjProductGallery">

        <div class="hj-gallery-item">
            <span class="hj-badge">TRADE IN AVAILABLE</span>
            <img src="{{ asset('assets/f_assets/image/solitaire/ring1.png') }}" alt="Ring">
            <!-- <p class="hj-img-caption">Shown with 2 Carat Diamond</p> -->
        </div>

        <div class="hj-gallery-item">
            <img src="{{ asset('assets/f_assets/image/solitaire/ring2.png') }}" alt="Model wearing ring">
        </div>

        <div class="hj-gallery-item">
            <img src="{{ asset('assets/f_assets/image/solitaire/ring3.png') }}" alt="Ring lifestyle">
        </div>

        <div class="hj-gallery-item">
            <img src="{{ asset('assets/f_assets/image/solitaire/ring4.png') }}" alt="Ring side">
        </div>

        <div class="hj-gallery-item">
            <img src="{{ asset('assets/f_assets/image/solitaire/ring5.png') }}" alt="Ring closeup">
        </div>

        <div class="hj-gallery-item">
            <img src="{{ asset('assets/f_assets/image/solitaire/ring6.png') }}" alt="Ring hand">
        </div>

        <div class="hj-gallery-item">
            <img src="{{ asset('assets/f_assets/image/solitaire/ring7.png') }}" alt="Ring model">
        </div>

        <div class="hj-gallery-item">
            <img src="{{ asset('assets/f_assets/image/solitaire/ring8.png') }}" alt="Ring">
        </div>

    </div>

    {{-- MOBILE SLIDER CONTROLS --}}
    <button type="button" class="hj-gallery-arrow" aria-label="Next image" id="hjGalleryNext">
    <img src="{{ asset('assets/f_assets/image/reviews/Vector.svg') }}" alt="Next" class="hj-gallery-arrow-img hj-arrow-right">
</button>
    <!-- <button type="button" class="hj-gallery-arrow" id="hjGalleryNext">›</button> -->

    <div class="hj-mobile-gallery-bottom">
        <div class="hj-gallery-tabs">
            <!-- <button type="button">Spin</button> -->
            <button type="button" class="active">Gallery</button>
        </div>

        <div class="hj-gallery-dots" id="hjGalleryDots">
            <button class="active"></button>
            <button></button>
            <button></button>
            <button></button>
            <button></button>
            <button></button>
            <button></button>
            <button></button>
        </div>
    </div>

</div>

      <aside class="hj-product-info">

    <div class="hj-product-top">

    <div class="hj-breadcrumb">
        <a href="#">Home</a>
        <span>/</span>
        <a href="#">Solitaire Rings</a>
        <span>/</span>
        <a href="#">Solitaire Engagement Ring -14K White Gold</a>
    </div>

    <h1>Julia Solitaire Ring</h1>

    <p class="hj-sku">
        SKU: M10116W14_3 | Lab Created | Gemological certificate included
    </p>

</div>
    <div class="hj-option-card">

        <!-- METAL -->
        <div class="hj-row hj-metal-row">
            <span class="hj-label">METAL</span>

            <div class="hj-middle hj-metal-options">
                <button class="metal-chip metal-silver">14K</button>
                <button class="metal-chip metal-rose">14K</button>
                <button class="metal-chip metal-yellow active">14K</button>
                <button class="metal-chip metal-light">18K</button>
                <button class="metal-chip metal-pink">18K</button>
                <button class="metal-chip metal-gold">18K</button>
            </div>

            <button class="hj-side-btn">14K YELLOW</button>
        </div>

       <!-- CARAT -->
<div class="hj-row hj-carat-row">
    <span class="hj-label">
        TOTAL CARAT
        <small>(+Rs 100,000)</small>
    </span>

    <div class="hj-middle hj-slider-box">
        <div class="hj-slider-text">
            <span>0.25 Carat</span>
            <span>1.00 Carat</span>
        </div>

        <input
            class="hj-range hj-carat-range"
            id="caratRange"
            type="range"
            min="0"
            max="8"
            step="1"
            value="0"
        >
    </div>

    <button class="hj-side-btn" id="caratBtn">0.25 CARAT</button>
</div>

        <!-- RING SIZE -->
        <div class="hj-row hj-size-row">
            <span class="hj-label">RING SIZE</span>

            <p class="hj-middle hj-select-text">Please select</p>

            <button class="hj-side-btn">SELECT</button>
        </div>

    </div>

  <div class="hj-price-row">
    <div class="hj-price-left">
        <del>$1,550</del>
        <strong>$1,130</strong>
        <span>You save 34 %</span>
    </div>

    <button class="hj-cart-btn">ADD TO CART</button>
</div>

<button class="hj-engraving">
    <b>+</b>
    <span>Add Free Inscription</span>
</button>

<div class="hj-spec-card">

    <div class="hj-tabs">
        <button type="button" class="hj-tab-btn active" data-tab="main-stone">MAIN STONE</button>
        <button type="button" class="hj-tab-btn" data-tab="settings">SETTINGS</button>
    </div>

    <!-- MAIN STONE TAB -->
    <div class="hj-tab-panel active" id="main-stone">

        <div class="hj-spec-grid">

            <div class="hj-spec-item">
                <div class="hj-spec-head">
                    <small>Carat</small>
                    <button class="hj-help-btn" type="button">?</button>
                    <div class="hj-help-dropdown">Carat refers to the weight of the diamond.</div>
                </div>
                <strong>1 CARAT</strong>
                <span>Standard measure</span>
            </div>

            <div class="hj-spec-item">
                <div class="hj-spec-head">
                    <small>Color</small>
                    <button class="hj-help-btn" type="button">?</button>
                    <div class="hj-help-dropdown">Color shows how white or colorless the diamond appears.</div>
                </div>
                <strong>F</strong>
                <span>Exceptional Colorless Brilliance</span>
            </div>

            <div class="hj-spec-item">
                <div class="hj-spec-head">
                    <small>Clarity</small>
                    <button class="hj-help-btn" type="button">?</button>
                    <div class="hj-help-dropdown">Clarity shows how clean the diamond is.</div>
                </div>
                <strong>VS1</strong>
                <span>Perfectly Eye Clean</span>
            </div>

            <div class="hj-spec-item">
                <div class="hj-spec-head">
                    <small>Cut</small>
                    <button class="hj-help-btn" type="button">?</button>
                    <div class="hj-help-dropdown">Cut affects the brilliance and sparkle.</div>
                </div>
                <strong>EXCELLENT</strong>
                <span>Perfect brilliance</span>
            </div>

            <div class="hj-spec-item">
                <div class="hj-spec-head">
                    <small>Shape</small>
                    <button class="hj-help-btn" type="button">?</button>
                    <div class="hj-help-dropdown">Shape refers to the diamond outline.</div>
                </div>
                <strong>OVAL</strong>
                <span>Preferred style</span>
            </div>

            <div class="hj-spec-item">
                <div class="hj-spec-head">
                    <small>Stone Origin</small>
                    <button class="hj-help-btn" type="button">?</button>
                    <div class="hj-help-dropdown">Lab created stones are made in controlled conditions.</div>
                </div>
                <strong>LAB CREATED</strong>
                <span>Gemstone perfection</span>
            </div>

        </div>

        <div class="hj-certificate">
            <span>◎</span>
            <div>
                <small>Certification</small>
                <strong>GEMOLOGICAL CERTIFICATE INCLUDED</strong>
                <p>Guaranteed authenticity</p>
            </div>
        </div>

    </div>

    <!-- SETTINGS TAB -->
    <div class="hj-tab-panel" id="settings">

        <div class="hj-spec-grid">

            <div class="hj-spec-item">
                <div class="hj-spec-head">
                    <small>Metal</small>
                    <button class="hj-help-btn" type="button">?</button>
                    <div class="hj-help-dropdown">Metal defines the ring material.</div>
                </div>
                <strong>18K GOLD</strong>
                <span>Premium finish</span>
            </div>

            <div class="hj-spec-item">
                <div class="hj-spec-head">
                    <small>Metal Color</small>
                    <button class="hj-help-btn" type="button">?</button>
                    <div class="hj-help-dropdown">The visible color tone of the ring.</div>
                </div>
                <strong>WHITE GOLD</strong>
                <span>Elegant appearance</span>
            </div>

            <div class="hj-spec-item">
                <div class="hj-spec-head">
                    <small>Setting Type</small>
                    <button class="hj-help-btn" type="button">?</button>
                    <div class="hj-help-dropdown">Setting type holds the stone in place.</div>
                </div>
                <strong>SOLITAIRE</strong>
                <span>Classic style</span>
            </div>

            <div class="hj-spec-item">
                <div class="hj-spec-head">
                    <small>Prong Style</small>
                    <button class="hj-help-btn" type="button">?</button>
                    <div class="hj-help-dropdown">Prongs secure the diamond safely.</div>
                </div>
                <strong>4 PRONG</strong>
                <span>Secure diamond hold</span>
            </div>

            <div class="hj-spec-item">
                <div class="hj-spec-head">
                    <small>Band Style</small>
                    <button class="hj-help-btn" type="button">?</button>
                    <div class="hj-help-dropdown">Band style defines the ring profile.</div>
                </div>
                <strong>PLAIN BAND</strong>
                <span>Minimal design</span>
            </div>

            <div class="hj-spec-item">
                <div class="hj-spec-head">
                    <small>Ring Size</small>
                    <button class="hj-help-btn" type="button">?</button>
                    <div class="hj-help-dropdown">Ring size can be selected before order.</div>
                </div>
                <strong>CUSTOM</strong>
                <span>Made to fit</span>
            </div>

        </div>

        <div class="hj-certificate">
            <span>◎</span>
            <div>
                <small>Certification</small>
                <strong>GEMOLOGICAL CERTIFICATE INCLUDED</strong>
                <p>Guaranteed authenticity</p>
            </div>
        </div>

    </div>

</div>
<div class="hj-appointment-card">

    <div class="hj-avatars">
        <img src="{{ asset('assets/f_assets/image/avators/one.jpg') }}" alt="Expert">
        <img src="{{ asset('assets/f_assets/image/avators/one.jpg') }}" alt="Expert">
        <img src="{{ asset('assets/f_assets/image/avators/one.jpg') }}" alt="Expert">
        <span></span>
    </div>

    <div class="hj-appointment-top">
        <h4>SET A VIRTUAL APPOINTMENT</h4>
        <small>Free of charge</small>
    </div>

    <div class="hj-appointment-bottom">
        <p>
            Meet one of our experts who can help you Explore
            engagement rings, Diamonds and fine jewellery
            in person at your device
        </p>

        <button type="button">
            <svg viewBox="0 0 24 24" aria-hidden="true">
                <rect x="4" y="5" width="16" height="15" rx="2"></rect>
                <path d="M8 3v4M16 3v4M4 10h16"></path>
            </svg>
            BOOK APPOINTMENT
        </button>
    </div>

</div>
    
<div class="hj-accordion">
                <div class="hj-acc-item">
                    <button>Why Choose Our Lab Created Engagement Rings? <span>⌄</span></button>
                </div>

                <div class="hj-acc-item">
                    <button>Free Shipping & Returns <span>⌄</span></button>
                </div>
                 <div class="hj-acc-item">
                    <button>Why Choose Our Lab Created Engagement Rings? <span>⌄</span></button>
                </div>

                <div class="hj-acc-item">
                    <button>Free Shipping & Returns <span>⌄</span></button>
                </div>
            </div>

  
</div>

            

        </aside>

    </div>


    

</section>
<section class="hj-handcrafted-banner">
    <div class="hj-handcrafted-container">

        <h2>
            Beautifully Handcrafted, Each Piece Is A Celebration Of Your <br>
            Love, Your Life, And Everything In Between.
        </h2>

        <div class="hj-handcrafted-image">
            <img src="{{ asset('assets/f_assets/image/solitaire/image1.png') }}" alt="Handcrafted Jewellery Banner">
        </div>

    </div>
</section>
<section class="hj-lab-products-section">

    <div class="hj-lab-products-grid">

        <div class="hj-lab-product-card">
            <div class="hj-lab-img-box">
                <span class="hj-lab-tag">Lab Created</span>
                <img src="{{ asset('assets/f_assets/image/solitaire/ring10.jpeg') }}" alt="Emerald Solitaire Ring">
            </div>

            <div class="hj-lab-product-info">
                <h3>Emerald Solitaire Ring</h3>
                <p>3.8 Total Carat · Radiant · Solitaire · 14K White Gold</p>

                <div class="hj-lab-price-row">
                    <span class="hj-old-price">£2,540</span>
                    <span class="hj-new-price">$1,530</span>
                    <span class="hj-discount">40% off</span>
                </div>
            </div>
        </div>

          <div class="hj-lab-product-card">
            <div class="hj-lab-img-box">
                <span class="hj-lab-tag">Lab Created</span>
                <img src="{{ asset('assets/f_assets/image/solitaire/ring10.jpeg') }}" alt="Emerald Solitaire Ring">
            </div>

            <div class="hj-lab-product-info">
                <h3>Emerald Solitaire Ring</h3>
                <p>3.8 Total Carat · Radiant · Solitaire · 14K White Gold</p>

                <div class="hj-lab-price-row">
                    <span class="hj-old-price">£2,540</span>
                    <span class="hj-new-price">$1,530</span>
                    <span class="hj-discount">40% off</span>
                </div>
            </div>
        </div>

          <div class="hj-lab-product-card">
            <div class="hj-lab-img-box">
                <span class="hj-lab-tag">Lab Created</span>
                <img src="{{ asset('assets/f_assets/image/solitaire/ring10.jpeg') }}" alt="Emerald Solitaire Ring">
            </div>

            <div class="hj-lab-product-info">
                <h3>Emerald Solitaire Ring</h3>
                <p>3.8 Total Carat · Radiant · Solitaire · 14K White Gold</p>

                <div class="hj-lab-price-row">
                    <span class="hj-old-price">£2,540</span>
                    <span class="hj-new-price">$1,530</span>
                    <span class="hj-discount">40% off</span>
                </div>
            </div>
        </div>
    </div>

</section>
<section class="hj-review-section">

    <div class="hj-review-container">

        <!-- TOP AREA -->
        <div class="hj-review-top">

            <div class="hj-review-summary">
                <h2>Reviews</h2>

                <div class="hj-rating-number">5.0</div>
                <div class="hj-rating-stars">★★★★★</div>
                <div class="hj-rating-count">8 Reviews</div>
                <a href="#" class="hj-leave-review">Leave a Review</a>
            </div>

            <div class="hj-review-gallery-area">

                <div class="hj-review-arrows">
                   <button type="button" class="hj-gallery-prev" aria-label="Previous image">
    <img src="{{ asset('assets/f_assets/image/reviews/Icon.svg') }}" alt="Previous" class="hj-gallery-arrow-img hj-arrow-left">
</button>

<button type="button" class="hj-gallery-next" aria-label="Next image">
    <img src="{{ asset('assets/f_assets/image/reviews/Vector.svg') }}" alt="Next" class="hj-gallery-arrow-img hj-arrow-right">
</button>
                </div>

                <div class="hj-review-gallery-viewport">
                    <div class="hj-review-gallery-track">

                        <img src="{{ asset('assets/f_assets/image/solitaire/review.png') }}" alt="Review Image">
                        <img src="{{ asset('assets/f_assets/image/solitaire/review.png') }}" alt="Review Image">
                        <img src="{{ asset('assets/f_assets/image/solitaire/review.png') }}" alt="Review Image">
                        <img src="{{ asset('assets/f_assets/image/solitaire/review.png') }}" alt="Review Image">
                        <img src="{{ asset('assets/f_assets/image/solitaire/review.png') }}" alt="Review Image">
                        <img src="{{ asset('assets/f_assets/image/solitaire/review.png') }}" alt="Review Image"> 
                        <img src="{{ asset('assets/f_assets/image/solitaire/review.png') }}" alt="Review Image">
                        <img src="{{ asset('assets/f_assets/image/solitaire/review.png') }}" alt="Review Image">
                        <img src="{{ asset('assets/f_assets/image/solitaire/review.png') }}" alt="Review Image">
                        <img src="{{ asset('assets/f_assets/image/solitaire/review.png') }}" alt="Review Image">
                         <img src="{{ asset('assets/f_assets/image/solitaire/review.png') }}" alt="Review Image">
                        <img src="{{ asset('assets/f_assets/image/solitaire/review.png') }}" alt="Review Image">
                        <img src="{{ asset('assets/f_assets/image/solitaire/review.png') }}" alt="Review Image">
                        <img src="{{ asset('assets/f_assets/image/solitaire/review.png') }}" alt="Review Image">
                        <img src="{{ asset('assets/f_assets/image/solitaire/review.png') }}" alt="Review Image">
                        <img src="{{ asset('assets/f_assets/image/solitaire/review.png') }}" alt="Review Image">

                    </div>
                </div>

            </div>

        </div>

        <!-- SORT -->
        <div class="hj-review-sort">
            <button type="button">Sort: Highest Rating <span>⌄</span></button>
        </div>

        <!-- REVIEW 1 -->
        <div class="hj-review-item">

            <div class="hj-review-text">
                <h4>Nikol</h4>
                <div class="hj-review-stars-small">★★★★★</div>
                <h5>Love love love it!</h5>
                <p>
                    I love the fact I was able to customize this ring. I love the simplicity but elegance to it.
                    The shine is incredible.
                </p>
            </div>

            <div class="hj-review-media">
                <span>September 28, 2023</span>

                <div class="hj-single-review-img">
                    <img src="{{ asset('assets/f_assets/image/solitaire/review.png') }}" alt="Review Image">
                </div>
            </div>

        </div>

        <!-- REVIEW 2 -->
        <div class="hj-review-item">

            <div class="hj-review-text">
                <h4>Frank’s Fiancé</h4>
                <div class="hj-review-stars-small">★★★★★</div>
                <h5>The Sparkle ✨</h5>
                <p>
                    This marquise Nadia gold ring is the ring of my dreams. I am so happy with it.
                    It never stops sparkling and I am constantly getting compliments.
                    My fiancé did a wonderful job picking out the setting.
                </p>
            </div>

            <div class="hj-review-media">
                <span>July 3, 2023</span>

                <div class="hj-single-review-img hj-more-images">
                    <img src="{{ asset('assets/f_assets/image/solitaire/review.png') }}" alt="Review Image">
                    <small>+1</small>
                </div>
            </div>

        </div>

        <!-- REVIEW 3 -->
        <div class="hj-review-item">

            <div class="hj-review-text">
                <h4>Sparkly Fiancée</h4>
                <div class="hj-review-stars-small">★★★★★</div>
                <h5>Stunning. Simply stunning.</h5>
                <p>
                    Constantly getting compliments on the ring. Perfect size and shape.
                    Beautifully crafted. Sparkles every day. Super ideal cut.
                    Setting is low-high, which I like as my job is very hands-on.
                </p>
            </div>

            <div class="hj-review-media">
                <span>April 14, 2023</span>

                <div class="hj-single-review-img hj-more-images">
                    <img src="{{ asset('assets/f_assets/image/solitare/review.png') }}" alt="Review Image">
                    <small>+1</small>
                </div>
            </div>

        </div>

        <!-- LOAD MORE -->
        <div class="hj-load-more">
            <button type="button">Load More</button>
        </div>

    </div>

</section>
<section class="hj-other-questions">
    <div class="hj-other-questions-inner">

        <h2>Other Questions?</h2>

        <p>We are here 24/7 to answer question you may have.</p>

        <div class="hj-question-actions">
            <a href="#" class="hj-question-btn">FAQ'S</a>

            <a href="tel:+18669784466" class="hj-question-btn hj-call-btn">
                CALL +1(866) 978-4466
            </a>

            <a href="#" class="hj-question-btn">LIVE CHAT</a>
        </div>

    </div>
</section>

@endsection