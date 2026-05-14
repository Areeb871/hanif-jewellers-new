@extends('public.layouts.header_latest')
@section('content')

<style>
/* =========================
   MAIN BANNERS
========================= */
.custom-banner,
.custom-banner-below{
    width: 100%;
    margin: 0;
    padding: 0;
    position: relative;
}

.custom-banner-video,
.custom-banner-below-img{
    width: 100%;
    height: auto;
    display: block;
}

/* =========================
   MOBILE VIDEO
========================= */
.mobileStackHero{
    width: 100%;
    background: #fff;
}

.mobileStackImgWrap{
    width: 100%;
    overflow: hidden;
    background: #000;
}

.mobileStackVideo{
    width: 100%;
    height: auto;
    display: block;
}

/* =========================
   LUXURY SECTION
========================= */
.luxury-layout{
    --gap: clamp(14px, 1.2vw, 22px);
    width: 100%;
    margin: 0;
    padding: 0;
}

.luxury-layout .row{
    justify-content: flex-start !important;
    --bs-gutter-x: var(--gap);
    --bs-gutter-y: var(--gap);
}

.luxury-layout .col-12,
.luxury-layout .lux-card{
    max-width: none !important;
}

.lux-card{
    width: 100%;
    overflow: hidden;
    border-radius: 0;
    background: #fff;
}

.lux-card img,
.lux-card video{
    width: 100%;
    height: auto;
    display: block;
    object-fit: contain;
}

/* =========================
   WRITEUP SECTION
========================= */
.writeup-section{
    width: 100%;
    /* padding: 50px 20px; */
    text-align: center;
}

.writeup-box{
    max-width: 900px;
    margin: 0 auto;
}

.writeup-box h2{
    margin: 13px 0 10px;
    font-size: 38px;
    font-weight: 600;
    color: #000;
    line-height: 1.2;
}

.writeup-box h4{
    margin: 0 0 22px;
    font-size: 18px;
    font-weight: 400;
    color: #222;
    line-height: 1.5;
}

.writeup-box p{
    margin: 0 auto;
    max-width: 820px;
    font-size: 16px;
    line-height: 1.8;
    color: #111;
}

/* =========================
   SPACING
========================= */
.section-space{
    margin-top: 24px;
}

/* =========================
   MOBILE
========================= */
@media (max-width: 991px){
    .section-space{
        margin-top: 16px;
    }

    .writeup-section{
        padding: 35px 16px;
    }

    .writeup-box h2{
        font-size: 28px;
    }

    .writeup-box h4{
        font-size: 16px;
        margin-bottom: 16px;
    }

    .writeup-box p{
        font-size: 14px;
        line-height: 1.7;
    }
}
</style>

<!-- =========================
     FIRST MAIN BANNER
========================= -->
<section class="custom-banner d-none d-md-block">
    <video class="custom-banner-video" autoplay muted loop playsinline>
        <source src="{{ asset('assets/f_assets/image/psl_trophy/psl_main.mp4') }}" type="video/mp4">
        Your browser does not support the video tag.
    </video>
</section>

<section class="d-block d-md-none">
    <div class="mobileStackImgWrap">
        <video class="mobileStackVideo" autoplay muted loop playsinline preload="metadata">
            <source src="{{ asset('assets/f_assets/image/psl_trophy/psl_mob.mp4') }}" type="video/mp4">
        </video>
    </div>
</section>

<!-- =========================
     SECTION 1
     LEFT BANNER + RIGHT 2 IMAGES
========================= -->
<section class="container-fluid px-0 my-5 luxury-layout">
    <div class="row g-0">

        <div class="col-12 col-lg-8">
            <div class="lux-card big-card">
                <video autoplay muted loop playsinline preload="metadata">
                    <source src="{{ asset('assets/f_assets/image/achievements/achievements.mp4') }}" type="video/mp4">
                </video>
            </div>
        </div>

        <div class="col-12 col-lg-4">
            <div class="row g-0">
                <div class="col-12">
                    <div class="lux-card small-card">
                        <img src="{{ asset('assets/f_assets/image/achievements/achievements1.png') }}" alt="Hanif Banner" loading="eager">
                    </div>
                </div>
                <div class="col-12">
                    <div class="lux-card small-card">
                        <img src="{{ asset('assets/f_assets/image/achievements/achievements2.png') }}" alt="Hanif Banner" loading="eager">
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>

<!-- =========================
     WRITEUP 1
========================= -->
<section class="writeup-section">
    <div class="writeup-box">
          <h2>MAKER OF THE TROPHY</h2> 
        <h4>PSL 11</h4> 
        <p>
HANIF presents, More than a symbol of victory, this trophy reflects the spirit of Pakistan Super League. At its base, 8 cornered Emerald cut stones represent the colors of Eight PSL teams, paying tribute to their cities and the millions of passionate fans who stand behind them.
As the design rises, it symbolizes the journey of determination, teamwork, and resilience required to reach the pinnacle of the game.
Crowning the masterpiece is the crescent and star, embodying hope, unity, and the pride of Pakistan.
This extraordinary creation was meticulously handcrafted by 18 Master artisans from the House of HANIF, dedicated 2600 hours of craftsmanship and precision, the use of precious Metals including Gold, Silver, Copper and more than 1,600 stones studded to bring this remarkable vision to life.
        </p>
    </div>
</section>

<!-- =========================
     FULL BANNER 1
========================= -->
<section class="custom-banner-below section-space">
    <img src="{{ asset('assets/f_assets/image/achievements/Bovet-Static-Web-Banner.png') }}"
         alt="Hanif Eid Banner"
         class="custom-banner-below-img">
</section>

<!-- =========================
     WRITEUP 2
========================= -->
<section class="writeup-section">
    <div class="writeup-box">
        <h2>THE RECITAL 30</h2>
         <h4>'KARACHI' PAKISTAN LIMITED EDITION</h4>
        <p>
            The Récital 30 focuses on the innovative roller system from the award winning Récital 28, allowing world travelers to accurately display 25 global time zones across the four periods of the year. The Récital 30 is one of only two world timepieces, both from BOVET, that are able to adapt to Daylight Saving Time.

The Récital 30 emphasizes  the essentials needed for keeping track of world time. The world time rollers cover nearly the entire dial, making it the clear focus of this timepiece for tracking world time. As a result, the Récital 30 is the perfect companion for world travelers. 

This special edition of the Récital 30 holds particular significance for the House of HANIF. The roller representing the country’s time zone is specifically labeled "Karachi”. The two green arrows accompany the designation, subtly highlighting the region while reflecting the colors closely associated with Pakistan.

With its vertically integrated manufacturing capabilities, BOVET possesses the rare ability to create highly personalized timepieces for distinguished collectors and partners around the world. The Récital 30 "Karachi” stands as a refined expression of this craftsmanship, demonstrating the Maison’s commitment to precision engineering, bespoke watchmaking, and the creation of exceptional horological masterpieces.
        </p>
    </div>
</section>

<!-- =========================
     SECTION 2
     LEFT BANNER + RIGHT 2 IMAGES
========================= -->
<section class="container-fluid px-0 my-5 luxury-layout">
    <div class="row g-0">

        <div class="col-12 col-lg-8">
            <div class="lux-card big-card">
                <video autoplay muted loop playsinline preload="metadata">
                    <source src="{{ asset('assets/f_assets/image/achievements/fm.mp4') }}" type="video/mp4">
                </video>
            </div>
        </div>

        <div class="col-12 col-lg-4">
            <div class="row g-0">
                <div class="col-12">
                    <div class="lux-card small-card">
                        <img src="{{ asset('assets/f_assets/image/achievements/fm1.png') }}" alt="Hanif Banner" loading="eager">
                    </div>
                </div>
                <div class="col-12">
                    <div class="lux-card small-card">
                        <img src="{{ asset('assets/f_assets/image/achievements/fm2.png') }}" alt="Hanif Banner" loading="eager">
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>

<!-- =========================
     WRITEUP 3
========================= -->
<section class="writeup-section">
    <div class="writeup-box">
        <h2>FRANCK MULLER</h2>
        <h4>Pakistan Edition</h4> 
        <p>
        Pepresenting the ideological and emotional identity of Pakistan with a timelessly captivating shape, the FRANCK MULLER PAKISTAN watch is a testament to and for all the patriots, dreamers, collectors & enthusiasts with clean and innovative aesthetics.
The distinctive crescent, the 5-pointed star & applique numerals have been meticulously hand-polished and hand-brushed. The steel dial and gold crown give a final touch to the richness, elegance and unique aesthetic of the watch. The green strap is cleverly integrated inside the case in order to maintain and extend the curved aspect of the timepiece, the result being a stunning timepiece with a unique design that truly is the horological embodiment of Pakistan.
        </p>
    </div>
</section>

<!-- =========================
     FULL BANNER 2
========================= -->
<section class="custom-banner-below section-space">
    <img src="{{ asset('assets/f_assets/image/achievements/Makkah-Watch-Banner.png') }}"
         alt="Hanif Eid Banner"
         class="custom-banner-below-img">
</section>

<!-- =========================
     WRITEUP 4
========================= -->
<section class="writeup-section">
    <div class="writeup-box">
        <h2>LOUIS MOINET</h2>
        <h4>Kabbah Edition</h4>
        <p>
           The Makkah timepiece by Louis Moinet draws its inspiration from Masjid al-Haram,  the heart of Islam, where millions unite in devotion. A symbol of faith and unity, this creation pays tribute to a message that continues to inspire the world.
        </p>
    </div>
</section>

<!-- =========================
     SECTION 3
     LEFT BANNER + RIGHT 2 IMAGES
========================= -->
<section class="container-fluid px-0 my-5 luxury-layout">
    <div class="row g-0">

        <div class="col-12 col-lg-8">
            <div class="lux-card big-card">
                <video autoplay muted loop playsinline preload="metadata">
                    <source src="{{ asset('assets/f_assets/image/achievements/Madina.mp4') }}" type="video/mp4">
                </video>
            </div>
        </div>

        <div class="col-12 col-lg-4">
            <div class="row g-0">
                <div class="col-12">
                    <div class="lux-card small-card">
                        <img src="{{ asset('assets/f_assets/image/achievements/Madina1.png') }}" alt="Hanif Banner" loading="eager">
                    </div>
                </div>
                <div class="col-12">
                    <div class="lux-card small-card">
                        <img src="{{ asset('assets/f_assets/image/achievements/Madina2.png') }}" alt="Hanif Banner" loading="eager">
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>

<!-- =========================
     WRITEUP 5
========================= -->
<section class="writeup-section">
    <div class="writeup-box">
        <h2>LOUIS MOINET</h2>
        <h4>Madina Edition</h4>
        <p>
            The Madina timepiece by Louis Moinet is inspired by Al-Masjid An-Nabawi ,the lighthouse from which the message of this divine revolution spread throughout the world. This timepiece pays a heartened tribute to that message. LIMITED TO ONLY 12 PIECES.
        </p>
    </div>
</section>

@endsection