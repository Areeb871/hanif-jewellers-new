<!DOCTYPE html>
<html lang="en">

<head>
<link rel="canonical" href="{{ request()->url() }}">
<!-- Meta Pixel Code -->
<script>
!function(f,b,e,v,n,t,s)
{if(f.fbq)return;n=f.fbq=function(){n.callMethod?
n.callMethod.apply(n,arguments):n.queue.push(arguments)};
if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
n.queue=[];t=b.createElement(e);t.async=!0;
t.src=v;s=b.getElementsByTagName(e)[0];
s.parentNode.insertBefore(t,s)}(window, document,'script',
'https://connect.facebook.net/en_US/fbevents.js');
fbq('init', '782153561546821');
fbq('track', 'PageView');
</script>
<noscript><img height="1" width="1" style="display:none"
src="https://www.facebook.com/tr?id=782153561546821&ev=PageView&noscript=1"
/></noscript>
<!-- End Meta Pixel Code -->
    <!-- Meta facebook Pixel Code -->
<script>
!function(f,b,e,v,n,t,s)
{if(f.fbq)return;n=f.fbq=function(){n.callMethod?
n.callMethod.apply(n,arguments):n.queue.push(arguments)};
if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
n.queue=[];t=b.createElement(e);t.async=!0;
t.src=v;s=b.getElementsByTagName(e)[0];
s.parentNode.insertBefore(t,s)}(window, document,'script',
'https://connect.facebook.net/en_US/fbevents.js');
fbq('init', '2755203871495186');
fbq('track', 'PageView');
</script>
<noscript><img height="1" width="1" style="display:none"
src="https://www.facebook.com/tr?id=2755203871495186&ev=PageView&noscript=1"
/></noscript>
<!-- End Meta Pixel Code -->
    <!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-KSC9KD3H');</script>
<!-- End Google Tag Manager -->
 <!-- TikTok Pixel Code Start -->
<script>
!function (w, d, t) {
  w.TiktokAnalyticsObject=t;var ttq=w[t]=w[t]||[];ttq.methods=["page","track","identify","instances","debug","on","off","once","ready","alias","group","enableCookie","disableCookie","holdConsent","revokeConsent","grantConsent"],ttq.setAndDefer=function(t,e){t[e]=function(){t.push([e].concat(Array.prototype.slice.call(arguments,0)))}};for(var i=0;i<ttq.methods.length;i++)ttq.setAndDefer(ttq,ttq.methods[i]);ttq.instance=function(t){for(
var e=ttq._i[t]||[],n=0;n<ttq.methods.length;n++)ttq.setAndDefer(e,ttq.methods[n]);return e},ttq.load=function(e,n){var r="https://analytics.tiktok.com/i18n/pixel/events.js",o=n&&n.partner;ttq._i=ttq._i||{},ttq._i[e]=[],ttq._i[e]._u=r,ttq._t=ttq._t||{},ttq._t[e]=+new Date,ttq._o=ttq._o||{},ttq._o[e]=n||{};n=document.createElement("script")
;n.type="text/javascript",n.async=!0,n.src=r+"?sdkid="+e+"&lib="+t;e=document.getElementsByTagName("script")[0];e.parentNode.insertBefore(n,e)};


  ttq.load('D54KV3JC77UAQNS9HN4G');
  ttq.page();
}(window, document, 'ttq');
</script>
<!-- TikTok Pixel Code End -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hanif Jewellers</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{ asset('assets/f_assets/image/favicon_hanif_32x32.jpg') }}" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('assets/f_assets/css/style.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500;600&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;500;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css">
<link href="https://fonts.googleapis.com/css2?family=Cinzel+Decorative:wght@400;700;900&family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
:root{
  --bg:#3c230d;
  --text:#ffffff;
  --border:#e5e5e5;

  /* Controls how “close” icons/left links feel to HANIF */
  --shellMax: 1320px;   /* 1200 / 1280 / 1320 / 1360 */
  --shellPad: 24px;     /* 18–32 */
}

*{ box-sizing:border-box; }
body{ margin:0; font-family:'OptimaNovaLTPro, sans-serif'; background:#fff; }

/* Fixed Header (no layout vibration) */
.luxury-header{
  position: fixed;        /* ✅ changed from sticky */
  top: 0;
  left: 0;
  right: 0;
  z-index: 9999;
  background: var(--bg);
  will-change: transform;
}

/* Spacer keeps page from jumping */
.header-spacer{
  height: 0;              /* JS will set exact height */
  background: var(--bg);
}

/* Cartier-like centered “shell” so left/logo/right stay together */
.luxury-shell{
  max-width: var(--shellMax);
  margin: 0 auto;
  padding: 0 var(--shellPad);
  background: var(--bg);
  position: relative;
}

/* One-row header (left | centered logo | right) */
.header-row{
  display: grid;
  grid-template-columns: 1fr auto 1fr;
  align-items: center;
  padding: 18px 0;
  column-gap: 24px;
  background: var(--bg);
}

/* LEFT */
.header-left{
  justify-self: start;
  display: flex;
  align-items: center;
  gap: 22px;
  white-space: nowrap;
  flex-wrap: nowrap;
  font-size: 11px;
  letter-spacing: 1.6px;
  text-transform: uppercase;
  color: var(--text);
}
.header-left a{
  text-decoration: none;
  color: var(--text);
  opacity: .85;
}

/* CENTER LOGO (image) */
.header-logo{
  justify-self: center;
  display: inline-flex;
  align-items: center;
  text-decoration: none;
  line-height: 1;
}
.header-logo-img{
  display:block;
  height: 40px;   /* adjust 44–60 */
  width: auto;
  object-fit: contain;
}

/* RIGHT ICONS */
.header-right{
  justify-self: end;
  display: flex;
  align-items: center;
  gap: 18px;
  white-space: nowrap;
  flex-wrap: nowrap;
}
.header-right a{
  color: var(--text);
  font-size: 16px;
  line-height: 1;
  text-decoration: none;
  opacity: .85;
  display: inline-flex;
  align-items: center;
}

/* NAV (below header row) */
.main-nav{
  display: flex;
  justify-content: center;
  align-items: center;
  gap: 30px;
  padding: 14px 170px 18px 190px;
  background: var(--bg);

  font-size: 12px;
  letter-spacing: 1.5px;
  text-transform: uppercase;
  white-space: nowrap;
  overflow-x: auto;
  scrollbar-width: none;
}
.main-nav::-webkit-scrollbar{ display:none; }
.main-nav a{
  text-decoration: none;
  color: var(--text);
  opacity: .9;
  flex: 0 0 auto;
}
.header-static-tools{
  position: absolute;
  right: var(--shellPad);
  top: 50%;
  transform: translateY(-50%);
  display: inline-flex;
  align-items: center;
  gap: 14px;
  z-index: 10020;
}
.nav-divider{
  width: 1px;
  height: 14px;
  background: #ffffff;
  opacity: .9;
  margin: 0 6px;
  flex: 0 0 auto;
}

/* Responsive on ALL desktop sizes */
@media (max-width: 1400px){
  :root{ --shellPad: 20px; }
  .header-row{ column-gap: 18px; }
  .header-left{ gap: 18px; }
}
@media (max-width: 1200px){
  :root{ --shellPad: 18px; --shellMax: 1200px; }
  .header-left{ font-size: 10.5px; gap: 14px; }
  .header-right{ gap: 14px; }
  .header-static-tools{ gap: 10px; }
  .main-nav{ padding-left: 170px; padding-right: 145px; }
}

/* ✅ No hover / no transparency effects on DESKTOP */
@media (min-width: 992px){

  .luxury-header,
  .luxury-header:hover{
    background-color:#3c230d !important;
  }

  /* Keep top-level header links transparent without forcing dropdown internals */
  .luxury-header .header-left > a,
  .luxury-header .header-right > a,
  .luxury-header .main-nav > a,
  .luxury-header .main-nav > .dropdown > .dropdown-toggle,
  .luxury-header .header-static-tools > a,
  .luxury-header .header-static-tools > .dropdown > a,
  .luxury-header .header-static-tools > .dropdown > a *{
    background-color: transparent !important;
  }

  .luxury-header .header-left > a,
  .luxury-header .header-left > a:hover,
  .luxury-header .header-left > a:focus,
  .luxury-header .header-left > a:active,
  .luxury-header .header-left > a:visited,
  .luxury-header .header-right > a,
  .luxury-header .header-right > a:hover,
  .luxury-header .header-right > a:focus,
  .luxury-header .header-right > a:active,
  .luxury-header .header-right > a:visited,
  .luxury-header .main-nav > a,
  .luxury-header .main-nav > a:hover,
  .luxury-header .main-nav > a:focus,
  .luxury-header .main-nav > a:active,
  .luxury-header .main-nav > a:visited,
  .luxury-header .main-nav > .dropdown > .dropdown-toggle,
  .luxury-header .main-nav > .dropdown > .dropdown-toggle:hover,
  .luxury-header .main-nav > .dropdown > .dropdown-toggle:focus,
  .luxury-header .main-nav > .dropdown > .dropdown-toggle:active,
  .luxury-header .main-nav > .dropdown > .dropdown-toggle:visited,
  .luxury-header .header-static-tools > a,
  .luxury-header .header-static-tools > a:hover,
  .luxury-header .header-static-tools > a:focus,
  .luxury-header .header-static-tools > a:active,
  .luxury-header .header-static-tools > a:visited,
  .luxury-header .header-static-tools #cartHeader a,
  .luxury-header .header-static-tools #cartHeader a:hover,
  .luxury-header .header-static-tools #cartHeader a:focus,
  .luxury-header .header-static-tools #cartHeader a:active,
  .luxury-header .header-static-tools #cartHeader a:visited,
  .luxury-header .header-static-tools > .dropdown > a,
  .luxury-header .header-static-tools > .dropdown > a:hover,
  .luxury-header .header-static-tools > .dropdown > a:focus,
  .luxury-header .header-static-tools > .dropdown > a:active,
  .luxury-header .header-static-tools > .dropdown > a:visited{
    color:#ffffff !important;
    opacity:1 !important;
    text-decoration:none !important;
    outline:none !important;
    box-shadow:none !important;
  }

  .luxury-header .header-left > a i,
  .luxury-header .header-right > a i,
  .luxury-header .main-nav > a i,
  .luxury-header .main-nav > .dropdown > .dropdown-toggle i,
  .luxury-header .header-static-tools > a i,
  .luxury-header .header-static-tools > .dropdown > a i,
  .luxury-header .header-left > a:hover i,
  .luxury-header .header-right > a:hover i,
  .luxury-header .main-nav > a:hover i,
  .luxury-header .main-nav > .dropdown > .dropdown-toggle:hover i,
  .luxury-header .header-static-tools > a:hover i,
  .luxury-header .header-static-tools #cartHeader a i,
  .luxury-header .header-static-tools #cartHeader a:hover i,
  .luxury-header .header-static-tools #cartHeader a:focus i,
  .luxury-header .header-static-tools > .dropdown > a:hover i,
  .luxury-header .header-left > a:focus i,
  .luxury-header .header-right > a:focus i,
  .luxury-header .main-nav > a:focus i,
  .luxury-header .main-nav > .dropdown > .dropdown-toggle:focus i,
  .luxury-header .header-static-tools > a:focus i,
  .luxury-header .header-static-tools > .dropdown > a:focus i{
    color:#ffffff !important;
    opacity:1 !important;
  }

  .luxury-header .nav-link:hover,
  .luxury-header .nav-link:focus,
  .luxury-header .dropdown-toggle:hover,
  .luxury-header .dropdown-toggle:focus{
    background-color:transparent !important;
  }

  .luxury-header a{
    -webkit-tap-highlight-color: transparent;
  }

  .luxury-header .header-static-tools .dropdown-menu .dropdown-item{
    color:#000 !important;
  }
  .luxury-header .header-static-tools .dropdown-menu .dropdown-item:hover,
  .luxury-header .header-static-tools .dropdown-menu .dropdown-item:focus,
  .luxury-header .header-static-tools .dropdown-menu .dropdown-item:active{
    color:#000 !important;
    background-color:#f7f7f7 !important;
  }
}

/* Prevent badge clipping */
.luxury-header,
.luxury-shell,
.header-row,
.header-right{
  overflow: visible !important;
}
.top-header,
.main-nav{
  transition: 
    padding 0.35s cubic-bezier(.4,0,.2,1),
    max-height 0.35s cubic-bezier(.4,0,.2,1),
    opacity 0.25s ease,
    letter-spacing 0.3s ease;
  will-change: padding, max-height;
}

.top-header{
  max-height: 120px;
  overflow: hidden;
}
.luxury-header.scrolled .top-header{
  max-height: 0 !important;
  padding: 0 !important;
  opacity: 0;
}

/* ✅ ON SCROLL: NAVBAR HEIGHT INCREASE (more premium) */
.luxury-header.scrolled .main-nav{
  padding: 20px 0 22px !important;   /* ✅ increased height */
  gap: 30px !important;              /* keep luxury spacing */
  font-size: 12px !important;        /* keep same size */
  letter-spacing: 1.5px !important;  /* keep same */
}

/* Optional: shadow only */
.luxury-header.scrolled{
  box-shadow: 0 4px 14px rgba(0,0,0,0.06);
}
/* ==============================
   FIX: MODAL ABOVE FIXED HEADER
================================= */
#navSearchModal{
  z-index: 20000 !important;
}
.modal-backdrop{
  z-index: 19990 !important;
}

/* Make sure search icon stays clickable */
#navSearchTrigger{
  position: relative;
  z-index: 10001;
  pointer-events: auto;
}
/* Smooth transition */
.luxury-header,
.header-logo,
.scroll-logo {
  transition: all 0.35s ease;
}

/* Base state */
.scroll-logo {
  position: absolute;
  left: 24px;
  top: 50%;
  opacity: 0;
  visibility: hidden;
  transform: translateY(-50%);
  z-index: 10020;
  
  /* FAST hide */
  transition: opacity 0.05s ease, 
              visibility 0.05s ease,
              transform 0.05s ease;
}

/* When scrolled (slow smooth show) */
.luxury-header.scrolled .scroll-logo {
  opacity: 1;
  visibility: visible;
  transform: translateY(-50%);

  /* SLOW show */
  transition: opacity 0.35s ease, 
              transform 0.35s ease;
}

/* Hide Center Logo when Scrolled */
.luxury-header.scrolled .header-logo {
  opacity: 0;
  visibility: hidden;
}

/* Optional shrink header */
.luxury-header.scrolled {
  padding: 8px 0;
}
/* Optional nav spacing */
.luxury-header.scrolled .main-nav {
  margin-top: 0;
}
/* =========================
   FIX NAV OVERFLOW (IMPORTANT)
   dropdown was getting clipped
========================= */
@media (min-width: 992px){
  .main-nav{
    overflow: visible !important;
  }

  header .hj-mega .dropdown-menu.mega-menu{
    /* margin-top: 10px; !important; */
    /* width: 100% !important; */
    position: fixed !important;
    /* left: 0 !important; */
    /* right: 0 !important; */
    /* width: 100% !important; */
    /* top: calc(var(--megaTop) + 24px) !important; */
    /* transform: none !important; */
    /* inset: auto 0 auto 0 !important; */
    /* z-index: 10000 !important; */
    /* border: 1px solid red !important; */
  }
}

/* =========================
   MEGA MENU TEXT-ONLY (2 COLUMNS)
   Like screenshot
   No structure change
========================= */

/* Hide all logos/images ONLY inside the mega menu */
/* Hide all images in mega menu EXCEPT the promo card image */
header .dropdown-menu.mega-menu img:not(.hanif-mega-card-img){
  display: none !important;
}



/* Turn the swiper wrapper into a 2-column vertical list */
header .dropdown-menu.mega-menu .swiper-wrapper{
  display: grid !important;
  grid-template-columns: 1fr 1fr;   /* 2 columns */
  column-gap: 90px;                /* space between columns */
  row-gap: 18px;                   /* space between rows */

  width: 100% !important;
  transform: none !important;      /* stop swiper translate */
}

/* Each slide behaves like a simple list item */
header .dropdown-menu.mega-menu .swiper-slide{
  width: auto !important;
  height: auto !important;
  padding: 0 !important;
  margin: 0 !important;
}

/* Remove any link flex styling from old slider */
header .dropdown-menu.mega-menu .swiper-slide > a{
  display: block !important;
  height: auto !important;
}

/* Typography like luxury menu */
header .dropdown-menu.mega-menu .swiper-slide .fw-bold{
  font-weight: 500 !important;
  letter-spacing: .10em;
  font-size: 12px;
  text-transform: uppercase;
  text-align: left !important;
  color: #111 !important;
}

/* Hover underline */
header .dropdown-menu.mega-menu .swiper-slide a:hover .fw-bold{
  text-decoration: underline;
  text-underline-offset: 6px;
}

/* Hide arrows completely */
header .dropdown-menu.mega-menu .swiper-button-next,
header .dropdown-menu.mega-menu .swiper-button-prev{
  display: none !important;
}

/* Remove underline wrapper line if you want clean like screenshot */
header .dropdown-menu.mega-menu .carousel-underline-wrapper::after{
  display: none !important;
}

/* On smaller desktop, reduce gap */
@media (max-width: 1200px){
  header .dropdown-menu.mega-menu .swiper-wrapper{
    column-gap: 50px;
  }
}

/* ✅ IMPORTANT: dropdown should not clip the right image */
.dropdown-menu.mega-menu{
  overflow: visible !important;
}

/* Keep mega menu compact */
.mega-menu .mega-tab-content{
  padding: 10px 0 !important;
}

/* Headings */
.mega-menu .mega-heading{
  font-family: WilliamsCaslonText, "Times New Roman", Times, serif;
  letter-spacing: .14em;
  text-transform: uppercase;
  font-size: 12px;
  color: #222;
  display: inline-block;
  position: relative;
  padding-bottom: 12px;
  margin-bottom: 16px;
}

.mega-menu .mega-heading::after{
  content:"";
  position:absolute;
  left:0;
  bottom:0;
  width: 110px;
  height: 1px;
  background: #c7a76a;
  opacity: .9;
}

/* ✅ FIXED mega-links (your old padding/min-height was breaking layout) */
.mega-menu .mega-links{
  margin-top: 0 !important;
  display:flex;
  flex-direction:column;
  gap: 14px;
  padding: 0 !important;
  min-height: auto !important;
  margin-bottom: 0 !important;
  border: 0 !important;
  color: inherit !important;
  line-height: inherit !important;
}

.mega-menu .mega-link{
  font-family: WilliamsCaslonText, "Times New Roman", Times, serif;
  letter-spacing: .06em;
  text-transform: uppercase;
  font-size: 14px;
  color: #222;
  text-decoration: none;
  display:block;
  padding: 6px 0;
}

.mega-menu .mega-link:hover{
  opacity: .75;
}

/* layout spacing */
.mega-inner-wrap{
  padding-right: 10px;
}

/* right card */
.mega-promo-card{
  text-align: center;
  width: 100%;
}

.mega-promo-img-wrap{
  width: 100%;
  border: 1px solid #e6e1d8;
  background: #fff;
  padding: 10px;
  display: block;
  max-width: 420px;
  margin-left: auto;
  margin-right: auto;
}

/* ✅ FORCE visible height */
.mega-promo-img{
  width: 100% !important;
  height: 260px !important;
  object-fit: cover !important;
  display: block !important;
  opacity: 1 !important;
  visibility: visible !important;
}

/* button */
.mega-promo-btn{
  display: inline-block;
  margin-top: 16px;
  padding: 14px 26px;
  border: 1px solid #b79b62;
  color: #8b6f3a;
  text-decoration: none;
  letter-spacing: 1px;
  font-size: 12px;
  text-transform: uppercase;
  min-width: 280px;
}

.mega-promo-btn:hover{
  background: #b79b62;
  color: #fff;
}
/* ===============================
   HANIF MEGA MENU RIGHT CARD
   Completely isolated styles
================================= */

.dropdown-menu.mega-menu{
  overflow: visible !important;
}

/* main card container */
.hanif-mega-card{
  text-align: center;
  width: 100%;
}

/* image wrapper */
.hanif-mega-card-img-wrap{
  display: block;
  width: 100%;
  max-width: 420px;
  margin: 0 auto;
  padding: 10px;
  border: 1px solid #e6e1d8;
  background: #ffffff;
}

/* actual image */
.hanif-mega-card-img{
  display: block !important;
  width: 100% !important;
  height: 260px !important;
  object-fit: cover !important;
  visibility: visible !important;
  opacity: 1 !important;
}

/* button */
.hanif-mega-card-btn{
  display: inline-block;
  margin-top: 18px;
  padding: 14px 28px;
  border: 1px solid #b79b62;
  color: #8b6f3a;
  font-size: 12px;
  letter-spacing: 1px;
  text-transform: uppercase;
  text-decoration: none;
  min-width: 280px;
  transition: all 0.3s ease;
}

.hanif-mega-card-btn:hover{
  background: #b79b62;
  color: #ffffff;
}
.hanif-mega-title {
    font-size: 14px;
    letter-spacing: 2px;
    font-weight: 500;
    color: #111;
    text-transform: uppercase;
  font-family: WilliamsCaslonText, "Times New Roman", Times, serif;
}
.break-line {
    display: inline;
}

/* Break only between 992px and 1400px */
@media (min-width: 992px) and (max-width: 1500px) {
    .break-line {
        display: block;
    }
}
 

  </style>
</head>

<body data-currency="pkr">
    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>

    <!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-KSC9KD3H"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
    @include('public.partials.page-loader')
    
    <!-- Include Mobile Header -->
    @include('public.partials.mobile-header')
<header class="luxury-header scrolled d-none d-lg-block">
  <div class="luxury-shell">

  <a href="/" class="scroll-logo" aria-label="Hanif Jewellers Home">
  <img
    src="{{ asset('assets/f_assets/image/logo.png') }}"
    alt="Hanif Jewellers"
   style="width:auto; height:40px; object-fit:contain;"
  >
</a>
    <!-- ✅ ROW 1: top line -->
<div class="header-row top-header">
      <div class="header-left">
        <!-- <a href="#">United States</a> -->
        <a href="{{ url('/pages/contact-us')}}">Contact Us</a>
        <!-- <a href="#">Services</a> -->
      </div>

      <a href="/" class="header-logo" aria-label="Hanif Jewellers Home">
        <img
          src="{{ asset('assets/f_assets/image/logo.png') }}"
          alt="Hanif Jewellers"
          class="header-logo-img"
          width="200"
          height="60"
          loading="eager"
        >
      </a>

    </div><!-- ✅ CLOSE header-row -->

    <!-- ✅ ROW 2: nav -->
    <nav class="main-nav" aria-label="Main navigation">
                            <a href="{{ url('/highend-jewellery') }}">HIGH END</a>

    <div class="dropdown hj-mega position-static">
  <a class="dropdown-toggle" href="#" id="JEWELLERYDropdown"
     role="button" data-bs-toggle="dropdown" aria-expanded="false">
    Jewellery
  </a>

  <div class="dropdown-menu mega-menu p-0 border-0 rounded-0 w-100"
       aria-labelledby="JEWELLERYDropdown">

    <div class="container-fluid py-4">
      <div class="row py-4">

        <div class="col-md-2 border-end d-flex flex-column align-items-center justify-content-center">
          <a href="#" class="fw-bold text-dark">Our House <span class="break-line">Collections</span></a>
        </div>
 <div class="col-md-10">

     @php
$menus = [

    'BRIDAL' => [
        ['label' => 'GEHNAWA',      'url' => route('gehnawa')],
        ['label' => 'NAVRATAN',     'url' => route('collections.navratan')],
        ['label' => 'TAJ MAHAL',    'url' => route('taj-mahal')],
        ['label' => 'HERITAGE',       'url' => url('collections/heritage')], // ✅ FIXED
        ['label' => 'CLEOPATRA',    'url' => route('cleopatra')],
        ['label' => 'MISTERIO',         'url' => route('misterio')],

    ],

    'LIFESTYLE' => [
        ['label' => 'EHED',         'url' => route('ehed')],
        ['label' => 'JEWELPHABETS', 'url' => url('collections/jewelphabets')],
        ['label' => 'MONA LISA',    'url' => url('collections/mona-lisa')],
        ['label' => 'PURE LOCK',    'url' => route('pure-lock')],
        ['label' => 'SELENE',       'url' => url('collections/selene')], // ✅ FIXED
        ['label' => 'MARCHISIO',        'url' => route('marchisio')],
        ['label' => 'DIVINE TREASURES', 'url' => route('divine-treasures')],

    ],
     'Festive' => [
        ['label' => 'Eid Par Sone ki Choriyan', 'url' => url('collections/eid-par-sony-ki-choriyan')],
        ['label'=> 'Valentine Hearts', 'url' => url('collections/valentine-jewels')],


    ],

];

$card = [
    'img' => 'assets/f_assets/image/tawoos/009.jpg',
    'btn' => 'EXPLORE COLLECTION',
    'url' => url('collections/tawoos'),
];
@endphp


<div class="row g-0 align-items-start mt-4 mega-inner-wrap">

    <!-- LEFT SIDE (BRIDAL + LIFESTYLE) -->
 <!-- LEFT SIDE (3 COLUMNS) -->
    <div class="col-md-8">

        <div class="row">

            <!-- BRIDAL -->
            <div class="col-md-4">
                <div class="mega-heading">BRIDAL</div>
                <div class="mega-links">
                    @foreach($menus['BRIDAL'] as $item)
                        <a class="mega-link" href="{{ $item['url'] }}">
                            {{ $item['label'] }}
                        </a>
                    @endforeach
                </div>
            </div>

            <!-- LIFESTYLE -->
            <div class="col-md-4">
                <div class="mega-heading">LIFESTYLE</div>
                <div class="mega-links">
                    @foreach($menus['LIFESTYLE'] as $item)
                        <a class="mega-link" href="{{ $item['url'] }}">
                            {{ $item['label'] }}
                        </a>
                    @endforeach
                </div>
            </div>

            <!-- FESTIVE -->
            <div class="col-md-4">
                <div class="mega-heading">FESTIVE</div>
                <div class="mega-links">
                    @foreach($menus['Festive'] as $item)
                        <a class="mega-link" href="{{ $item['url'] }}">
                            {{ $item['label'] }}
                        </a>
                    @endforeach
                </div>
            </div>

        </div>

    </div>
    <!-- RIGHT SIDE IMAGE -->
<div class="col-md-4 ps-md-4">
    <div class="hanif-mega-card">      
        <!-- IMAGE -->
        <a href="{{ $card['url'] }}" class="hanif-mega-card-img-wrap">
            <img src="{{ asset($card['img']) }}" alt="Promo" class="hanif-mega-card-img">
        </a>
        <br>
        <div class="hanif-mega-title">
              TAWOOS
        </div>
        <!-- BUTTON -->
        <a href="{{ $card['url'] }}" class="hanif-mega-card-btn">
            {{ $card['btn'] }}
        </a>
    </div>
</div>
</div>

          

        </div>
       

      </div>
    </div>

  </div>
</div>
      <a href="{{ url('solitaire') }}">Solitaire</a>
      <a href="{{ url('/collections/online-shopping-store') }}">Online Shopping Store</a>
      <a href="{{ url('watches') }}">Watches</a>
      <span class="nav-divider" aria-hidden="true"></span>
<a href="#"
   id="navSearchTrigger"
   aria-label="Search"
   class="d-inline-flex align-items-center">
   <i class="fa-solid fa-magnifying-glass"></i>
</a>
 </nav>

  <div class="header-static-tools">
    {{-- CART SECTION --}}
    <span id="cartHeader" class="d-inline-flex align-items-center">
      @include('public.partials.cart-header')
    </span>

    {{-- SETTINGS DROPDOWN --}}
    <div class="dropdown position-relative">

      <a href="/checkout" aria-label="Settings">
        <i class="fa-solid fa-gear"></i>
      </a>

      <ul class="dropdown-menu dropdown-menu-end px-3 py-2"
        style="left:-140px; top:40px; background:#ffffff;">
        <li class="mb-2">
          <a class="dropdown-item" href="/checkout">
            <i class="fa fa-check-circle px-2"></i>Check Out
          </a>
        </li>
      </ul>

    </div>
  </div>

  </div>
</header>

<div class="header-spacer"></div>

  @php
    $searchItems = \App\Models\Products::with('images')
        ->where('status', 1)
        ->select('id', 'name', 'slug', 'image', 'hover_image', 'description')
        ->orderBy('name')
        ->get()
        ->map(function ($product) {
            $relatedImage = optional($product->images)->firstWhere('image', '!=', null)->image ?? null;
            $imagePath = $relatedImage ?: $product->hover_image ?: $product->image;

            return [
                'label' => $product->name,
                'slug' => $product->slug,
                'image' => $imagePath ? asset($imagePath) : asset('assets/f_assets/image/logo.png'),
                'subtitle' => \Illuminate\Support\Str::limit(strip_tags($product->description ?? ''), 60, '…'),
                'url' => route('product.details', ['slug' => $product->slug]),
                'type' => 'product',
            ];
        })
        ->values()
        ->toArray();
@endphp

    <style>
        .nav-search-wrapper {
            max-width: 1200px;
            margin: 0 auto;
        }
        .nav-search-brand {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 18px;
        }
        .nav-search-brand img {
            max-height: 44px;
            width: auto;
        }
        .nav-search-form {
            display: flex;
            gap: 12px;
            align-items: center;
            margin-bottom: 14px;
        }
        .nav-search-input {
            flex: 1;
            border: none;
            border-bottom: 1px solid #cfcfcf;
            border-radius: 0;
            box-shadow: none;
            padding: 10px 0;
            font-size: 15px;
        }
        .nav-search-input:focus {
            outline: none;
            box-shadow: none;
            border-bottom-color: #000;
        }
        .nav-search-btn {
            background: #111;
            color: #fff;
            border: none;
            padding: 12px 18px;
            font-weight: 700;
            letter-spacing: 0.5px;
        }
        .nav-search-btn:focus {
            outline: none;
            box-shadow: none;
        }
        .nav-search-results {
            background: #fff;
            border: 1px solid #eee;
            border-radius: 6px;
            padding: 16px;
            max-height: 520px;
            overflow-y: auto;
            max-width: 1080px;
            margin: 0 auto;
        }
        .nav-search-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 12px;
            font-weight: 800;
            font-size: 16px;
            letter-spacing: 0.5px;
            text-transform: uppercase;
        }
        .nav-search-count {
            color: #000;
            font-weight: 700;
            font-size: 14px;
            letter-spacing: 0.3px;
        }
        .nav-search-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(160px, 1fr));
            gap: 14px;
        }
        .nav-search-card {
            background: #fff;
            border: 1px solid #f2f2f2;
            border-radius: 6px;
            padding: 10px;
            text-decoration: none;
            color: #111;
            transition: transform 0.15s ease, box-shadow 0.15s ease;
        }
        .nav-search-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 16px rgba(0,0,0,0.08);
        }
        .nav-search-card img {
            width: 100%;
            aspect-ratio: 1 / 1;
            object-fit: cover;
            border-radius: 4px;
            margin-bottom: 8px;
            background: #fafafa;
        }
        .nav-search-card .title {
            font-size: 14px;
            font-weight: 700;
            line-height: 1.3;
            margin-bottom: 4px;
            text-transform: uppercase;
        }
        .nav-search-card .subtitle {
            font-size: 12px;
            color: #555;
            line-height: 1.4;
        }
        .nav-search-empty {
            color: #888;
            font-size: 14px;
            text-align: center;
        }
        
    </style>

    <!-- Navbar Search Modal -->
    <div class="modal fade" id="navSearchModal" tabindex="-1" aria-labelledby="navSearchLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-sm">
                <div class="modal-header border-0 pb-0">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="nav-search-wrapper">
                        <div class="nav-search-brand">
                            <img src="{{ asset('assets/f_assets/image/HanifLogoBlack.png') }}" alt="Hanif Jewellers">
                        </div>
                        <form id="navSearchForm" class="nav-search-form">
                            <input type="text" class="form-control nav-search-input" id="navSearchInput" placeholder="Search products" autocomplete="off">
                            <button type="submit" class="nav-search-btn">SEARCH</button>
                        </form>
                        <div class="nav-search-results">
                            <div class="nav-search-header">
                                <span id="navSearchCount" class="nav-search-count"></span>
                            </div>
                            <div id="navSearchResults" class="nav-search-grid"></div>
                            <div id="navSearchEmpty" class="nav-search-empty"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @yield('content')

@if (in_array(Route::currentRouteName(), ['index', 'collections.valentine']))
    @include('public.layouts.footer_home_page')
@else
    @include('public.layouts.footer')
@endif
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
  const header = document.querySelector('.luxury-header');

  function setMegaTop(){
    if (!header) return;
    const rect = header.getBoundingClientRect();
    document.documentElement.style.setProperty('--megaTop', rect.bottom + 'px');
  }

  // initial
  setMegaTop();

  // update on scroll/resize (header height changes when scrolled)
  window.addEventListener('scroll', setMegaTop, { passive: true });
  window.addEventListener('resize', setMegaTop);

  // Desktop hover dropdown support (Bootstrap)
  if (window.innerWidth >= 992 && window.bootstrap) {
    document.querySelectorAll('header .hj-mega').forEach(function (dd) {
      const toggle = dd.querySelector('[data-bs-toggle="dropdown"]');
      if (!toggle) return;

      dd.addEventListener('mouseenter', function () {
        setMegaTop();
        bootstrap.Dropdown.getOrCreateInstance(toggle).show();
      });

      dd.addEventListener('mouseleave', function () {
        bootstrap.Dropdown.getOrCreateInstance(toggle).hide();
      });
    });

    const settingsDropdown = document.querySelector('header .header-static-tools .dropdown');
    if (settingsDropdown) {
      const settingsToggle = settingsDropdown.querySelector('a[aria-label="Settings"]');
      if (settingsToggle) {
        settingsDropdown.addEventListener('mouseenter', function () {
          bootstrap.Dropdown.getOrCreateInstance(settingsToggle).show();
        });

        settingsDropdown.addEventListener('mouseleave', function () {
          bootstrap.Dropdown.getOrCreateInstance(settingsToggle).hide();
        });
      }
    }
  }
});
</script>
<script>
document.addEventListener("DOMContentLoaded", function () {
  const trigger = document.getElementById('navSearchTrigger');
  const modalEl = document.getElementById('navSearchModal');

  if (!trigger || !modalEl || !window.bootstrap) return;

  const modal = bootstrap.Modal.getOrCreateInstance(modalEl, {
    backdrop: true,
    keyboard: true
  });

  trigger.addEventListener('click', function(e){
    e.preventDefault();
    e.stopPropagation();
    modal.show();
  });
});
</script>
 <script>
document.addEventListener("DOMContentLoaded", function () {
  // Navbar search modal logic
  const searchData = @json($searchItems);
  const searchModalEl = document.getElementById('navSearchModal');
  const searchInput = document.getElementById('navSearchInput');
  const searchResults = document.getElementById('navSearchResults');
  const searchForm = document.getElementById('navSearchForm');
  const searchEmpty = document.getElementById('navSearchEmpty');
  const searchCount = document.getElementById('navSearchCount');

  const renderResults = (term = '') => {
    const normalized = term.trim().toLowerCase();
    searchResults.innerHTML = '';
    searchEmpty.textContent = '';
    if (searchCount) searchCount.textContent = '';

    if (!normalized) {
      searchEmpty.textContent = 'Start typing to search products.';
      return;
    }

    const matches = searchData
      .filter(item => {
        const label = (item.label || '').toLowerCase();
        const slug  = (item.slug  || '').toLowerCase();
        return label ? label.includes(normalized) : slug.includes(normalized);
      })
      .slice(0, 10);

    if (!matches.length) {
      searchEmpty.textContent = 'No products found.';
      return;
    }

    if (searchCount) searchCount.textContent = `Products (${matches.length})`;

    matches.forEach(item => {
      const card = document.createElement('a');
      card.className = 'nav-search-card';
      card.href = item.url;

      const img = document.createElement('img');
      img.src = item.image || '';
      img.alt = item.label || 'Product';

      const title = document.createElement('div');
      title.className = 'title';
      title.textContent = item.label || '';

      card.appendChild(img);
      card.appendChild(title);
      searchResults.appendChild(card);
    });
  };

  if (searchInput) {
    searchInput.addEventListener('input', (e) => renderResults(e.target.value));
  }

  if (searchForm) {
    searchForm.addEventListener('submit', (e) => {
      e.preventDefault();
      const term = (searchInput.value || '').trim().toLowerCase();
      if (!term) return;

      const match = searchData.find(item => {
        const label = (item.label || '').toLowerCase();
        const slug  = (item.slug  || '').toLowerCase();
        return label ? label.includes(term) : slug.includes(term);
      });

      if (match) window.location.href = match.url;
      else renderResults(term);
    });
  }

  if (searchModalEl) {
    searchModalEl.addEventListener('shown.bs.modal', () => {
      if (!searchInput) return;
      searchInput.value = '';
      renderResults('');
      searchInput.focus();
    });
  }
});
</script>
<script>
document.addEventListener("DOMContentLoaded", function () {
  const header = document.querySelector(".luxury-header");
  const spacer = document.querySelector(".header-spacer");

  if (!header || !spacer) return;

  function setSpacerHeight() {
    spacer.style.height = header.offsetHeight + "px";
  }

  // initial spacer
  setSpacerHeight();

  // update spacer on resize
  window.addEventListener("resize", () => {
    setSpacerHeight();
  });
});
</script>
<script>
(function () {

  function initOneCarousel(carousel) {
    if (!carousel || carousel.dataset.carouselInitialized === "1") return;

    const items = carousel.querySelectorAll(".carousel-item");
    if (!items || items.length <= 1) {
      carousel.dataset.carouselInitialized = "1";
      return;
    }

    // Bootstrap instance
    const instance =
      bootstrap.Carousel.getInstance(carousel) ||
      new bootstrap.Carousel(carousel, {
        interval: false,
        wrap: true,
        touch: true,
        keyboard: false,
        pause: false
      });

    // IMPORTANT: bullets only inside this carousel
    const bullets = carousel.querySelectorAll(".swiper-pagination-bullet");

    function setActive(index) {
      bullets.forEach((b, i) => {
        if (i === index) {
          b.classList.add("swiper-pagination-bullet-active");
          b.setAttribute("aria-current", "true");
        } else {
          b.classList.remove("swiper-pagination-bullet-active");
          b.removeAttribute("aria-current");
        }
      });
    }

    // initial active
    let currentIndex = 0;
    items.forEach((it, i) => { if (it.classList.contains("active")) currentIndex = i; });
    setActive(currentIndex);

    // update on slide
    carousel.addEventListener("slid.bs.carousel", function () {
      items.forEach((it, i) => {
        if (it.classList.contains("active")) currentIndex = i;
      });
      setActive(currentIndex);
    });

    // bullet click
    bullets.forEach((bullet, idx) => {
      bullet.addEventListener("click", function (e) {
        e.preventDefault();
        e.stopPropagation();
        instance.to(idx);
        setActive(idx);
      });
    });

    carousel.dataset.carouselInitialized = "1";
  }

  function initAll(root = document) {
    const carousels = root.querySelectorAll(".addToCartProductDetailsTop .carousel");
    carousels.forEach(initOneCarousel);
  }

  // First load
  document.addEventListener("DOMContentLoaded", function () {
    initAll(document);

    // Auto-init for AJAX appended products (Load More)
    const observer = new MutationObserver(function (mutations) {
      mutations.forEach(m => {
        m.addedNodes.forEach(node => {
          if (node.nodeType !== 1) return;
          initAll(node);
        });
      });
    });

    // Observe body (works for all 18 pages, even if grid class differs)
    observer.observe(document.body, { childList: true, subtree: true });
  });

  // Expose for manual use (optional)
  window.initProductCardCarousels = initAll;

})();
</script>

@include('partials.toast')
</body>

</html>