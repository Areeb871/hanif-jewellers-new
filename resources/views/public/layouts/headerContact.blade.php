<!DOCTYPE html>
<html lang="en">

<head>
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
<link href="https://fonts.googleapis.com/css2?family=Cinzel+Decorative:wght@400;700;900&family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        .currency-toggle-btn {
            border-radius: 999px;
            padding: 4px 16px;
            font-size: 0.8rem;
            letter-spacing: 1px;
            text-transform: uppercase;
        }
        body[data-currency="pkr"] .price-value-aed {
            display: none !important;
        }
        body[data-currency="aed"] .price-value-pkr {
            display: none !important;
        }
        #collectionTabs {
            justify-content: center;
            gap: 10% !important;
        }
        #collectionTabs .nav-link {
            font-weight: bold;
            font-size: 1.1rem;
            letter-spacing: 1px;
            color: #333;
            background: none;
            border: none;
            border-bottom: 2px solid transparent;
            border-radius: 0;
            padding-bottom: 6px;
            transition: border-color 0.2s, color 0.2s;
            position: relative;
        }
        #collectionTabs .nav-link.active,
        #collectionTabs .nav-link:focus {
            color: #222;
            background: none;
        }
        #collectionTabs .nav-link .tab-label {
            position: relative;
            display: inline-block;
            text-transform: uppercase;
            font-weight: 400;
            letter-spacing: 2px;
            font-size: 14px;
            /* Remove or reduce padding-bottom if you want only margin on underline */
            padding-bottom: 0;
        }

        #collectionTabs .nav-link .tab-label::after {
            content: "";
            display: block;
            height: 2px;
            width: 0;
            background: rgb(145, 145, 145);
            position: absolute;
            left: 0;
            bottom: -8px; /* This moves the underline 8px below the text */
            margin-top: 8px; /* This is optional, but bottom is more reliable */
            transition: width 0.3s cubic-bezier(.4,0,.2,1);
        }

        #collectionTabs .nav-link:hover .tab-label::after,
        #collectionTabs .nav-link.active .tab-label::after {
            width: 95%; /* Or your preferred length */
        }
        #collectionTabs .fa-chevron-down {
            margin-left: 6px;
            font-size: 0.9em;
            color: #888;
        }
        @media (max-width: 768px) {
            #collectionTabs {
                gap: 10px;
                font-size: 0.95rem;
            }
        }
        #JEWELLERYDropdown.dropdown-toggle::after {
            display: none !important;
        }
        /* Swiper navigation buttons styling */
        .swiper-button-next,
        .swiper-button-prev {
            width: 0px;
            height: 0px;
            color: #555;
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0.85;
            transition: background 0.2s, color 0.2s, opacity 0.2s;
            font-size: 0px;
            position: absolute;
            top: 25%;
            transform: translateY(-50%);
            z-index: 2;
        }
        .swiper-button-next:after,
        .swiper-button-prev:after {
            font-size: 16px;
            font-weight: bold;
        }
        .carousel-underline-wrapper {
            position: relative;
            width: 100%;
            margin-bottom: 32px; /* space below the underline, adjust as needed */
        }
        .carousel-underline-wrapper::after {
            content: "";
            display: block;
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
            bottom: -110px; /* adjust as needed */
            width: 70%;
            border-bottom: 1px solid rgb(222, 226, 230);
            z-index: 1;
        }
        .swiper {
            position: relative;
        }
        .swiper-slide {
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: stretch;
        }

        .swiper-slide > a {
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: stretch;
        }
        .swiper {
            overflow: hidden !important;
            position: relative;
            /* REMOVE padding-left and padding-right here! */
        }
        .swiper-button-prev {
            left: 5px;
            top: 50%;
            transform: translateY(-50%);
            z-index: 2;
        }
        .swiper-button-next {
            right: 5px;
            top: 50%;
            transform: translateY(-50%);
            z-index: 2;
        }
        
        /* Specific positioning for home page */
        body.home-page .swiper-button-prev,
        body.home-page .swiper-button-next {
            top: 25%;
        }
        /* Prevent blue background/text on header nav links (e.g., SOLITAIRE) in ALL states */
        header .navbar .navbar-nav .nav-link,
        header .navbar .navbar-nav .nav-link:hover,
        header .navbar .navbar-nav .nav-link:visited,
        header .navbar .navbar-nav .nav-link:focus,
        header .navbar .navbar-nav .nav-link:focus-visible,
        header .navbar .navbar-nav .nav-link:active,
        header .navbar .navbar-nav .nav-link.active,
        header .navbar .navbar-nav .nav-link.show,
        header .navbar .navbar-nav .dropdown-toggle.show {
            background-color: transparent !important;
            color: inherit !important;
            outline: none !important;
            box-shadow: none !important;
            -webkit-tap-highlight-color: transparent;
            user-select: none;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
        }
        /* Specifically target SOLITAIRE link across all states */
        header .navbar .navbar-nav .nav-link[href*="solitaire"],
        header .navbar .navbar-nav .nav-link[href*="solitaire"]:hover,
        header .navbar .navbar-nav .nav-link[href*="solitaire"]:visited,
        header .navbar .navbar-nav .nav-link[href*="solitaire"]:focus,
        header .navbar .navbar-nav .nav-link[href*="solitaire"]:focus-visible,
        header .navbar .navbar-nav .nav-link[href*="solitaire"]:active {
            background-color: transparent !important;
            color: inherit !important;
            outline: none !important;
            box-shadow: none !important;
        }
    </style>
</head>

<body class="contactPageHeader" data-currency="pkr">
      <!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-KSC9KD3H"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
    @include('public.partials.page-loader')
    
    <!-- Include Mobile Header -->
    @include('public.partials.mobile-header')
    
    <header class="d-none d-md-block">
        <div class="px-md-0 px-3">
            <!-- only for desktop -->
            <div class="px-md-3">
                <div class="row pt-3 desktopLogos">
                    <div class="col">
                        <a class="text-white" href="/locator"><i class="fa-solid fa-location-dot"></i></a>
                        <a class="text-white px-4" href="/contact-us"><i class="fa-solid fa-phone-volume"></i></a>
                        <a class="text-white" href="#" data-bs-toggle="modal" data-bs-target="#navSearchModal"><i class="fa-solid fa-magnifying-glass"></i></a>
                    </div>
                    <div class="text-center col">
                        <a class="navbar-brand" href="/">
                            <img class="HanifLogoBlack img-fluid" src="{{ asset('assets/f_assets/image/logo.png') }}"
                                alt="Hanif Jewellers" width="200" height="60" loading="eager">
                            <img class="HanifLogoWhite img-fluid"
                                src="{{ asset('assets/f_assets/image/HanifLogoBlack.png') }}" alt="Hanif Logo Black" width="200" height="60" loading="eager">
                        </a>
                    </div>
                    <div class="col d-flex justify-content-end align-items-center gap-3">
                        <!-- <button class="btn btn-sm btn-outline-light currency-toggle-btn" data-currency-toggle type="button">Show AED</button> -->
                        <!-- <a class="text-white" href="http://"><i class="fa-regular fa-heart"></i></a> -->
                        <div id="cartHeader">
                            @include('public.partials.cart-header')
                        </div>
                        <div class="dropdown" onmouseenter="this.classList.add('show'); this.querySelector('.dropdown-menu').classList.add('show');" onmouseleave="this.classList.remove('show'); this.querySelector('.dropdown-menu').classList.remove('show');">
                            <a class="text-white" href="#" id="settingsDropdown" role="button" aria-expanded="false">
                                <i class="fa-solid fa-gear"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end px-3 py-2" aria-labelledby="settingsDropdown" style="left: -140px; top: 40px; background: #ffffff;">
                                <li class="mb-2"><a class="dropdown-item" href="/checkout"><i class="fa fa-check-circle px-2" aria-hidden="true"></i>Check Out</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <!-- <li class="mb-2"><a class="dropdown-item" href="/wishlist"><i class="fa fa-heart px-2" aria-hidden="true"></i>Wishlist</a></li> -->
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End only for desktop -->
            <nav class="navbar navbar-expand-lg px-md-3 pt-3 pb-0">
                <a class="navbar-brand mobileLogo" href="/">
                    <img class="HanifLogoBlack img-fluid" src="{{ asset('assets/f_assets/image/logo.png') }}"
                        alt="Hanif Jewellers" width="200" height="60" loading="eager">
                    <img class="HanifLogoWhite img-fluid" src="{{ asset('assets/f_assets/image/HanifLogoBlack.png') }}"
                        alt="Hanif Logo Black" width="200" height="60" loading="eager">
                </a>
                <div class="col d-flex justify-content-end mobileIcon">
                    <a class="text-white mobileIcon" href="#" data-bs-toggle="modal" data-bs-target="#navSearchModal"><i class="fa-solid fa-magnifying-glass"></i></a>
                    <!-- <a class="text-white px-3 mobileIcon" href="http://">{{-- <i class="fa-solid fa-cart-shopping"></i> --}}</a> -->
                </div>
                <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas"
                    data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar"
                    aria-labelledby="offcanvasNavbarLabel">
                    <div class="offcanvas-header">
                        <img class="offcanvas-title" id="offcanvasNavbarLabel"
                            src="{{ asset('assets/f_assets/image/HanifLogoBlack.png') }}" alt="Hanif Jewellers" width="200" height="60" loading="eager">
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas"
                            aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">
                        <ul class="navbar-nav flex-grow-1">
                            <li class="nav-item dropdown position-static">
                                <a class="nav-link dropdown-toggle d-flex align-items-center pb-4" href="#"
                                    id="JEWELLERYDropdown" role="button">
                                    <div class="group_title d-flex align-items-center">
                                        COLLECTIONS <span class="ms-2"><i class="fa fa-chevron-down" style="font-size: 0.8em;"></i></span>
                                    </div>
                                </a>
                                @php
                                    $categories = \App\Models\Categories::where('status', 1)->get();
                                    $watchCategories = \App\Models\Categories::where('status', 1)->get();
                                    $jewelryCollections = \App\Models\Subcategory::where([['status', 'active'],['category_id', 1]])->get();
                                @endphp
                                @php
                                    $customRoutes = [
                                        'EHED' => route('ehed'),
                                        'GEHNAWA' => route('gehnawa'),
                                        'NAVRATAN' => route('collections.navratan'),
                                    ];
                                @endphp
                                <!-- Mega Menu -->
                                <div class="dropdown-menu mega-menu p-0 border-0 rounded-0"
                                     aria-labelledby="JEWELLERYDropdown">
                                    <div class="container-fluid py-4">
                                        <div class="row py-5">
                                            <!-- Sidebar -->
                                            <div class="col-md-2 border-end d-flex flex-column align-items-center justify-content-center">
                                                <a href="#" class="fw-bold text-dark">ALL COLLECTIONS</a>
                                            </div>
                                            <!-- Main Content -->
                                            <div class="col-md-10">
                                                <!-- Tabs 'SEASONAL' => 'SEASONAL',
-->
                                                <ul class="nav nav-tabs mb-3" id="collectionTabs" role="tablist" style="border: unset;">
                                                    @php
                                                        $tabs = [
                                                            'HIGH_END' => 'HIGH END | BESPOKE',
                                                            'BRIDAL' => 'BRIDAL',
                                                            'LIFESTYLE' => 'LIFESTYLE'
                                                        ];
                                                    @endphp
                                                    @foreach($tabs as $tabKey => $tabLabel)
                                                        <li class="nav-item" role="presentation">
                                                            <button class="nav-link d-flex align-items-center justify-content-center @if($loop->first) active @endif"
                                                                id="tab-{{ $tabKey }}"
                                                                data-bs-toggle="tab"
                                                                data-bs-target="#content-{{ $tabKey }}"
                                                                type="button"
                                                                role="tab"
                                                                style="background: none; border: none;">
                                                                <span class="tab-label">{{ strtoupper($tabLabel) }}</span>
                                                                <span class="ms-2"><i class="fa fa-chevron-down" style="font-size: 0.7em;"></i></span>
                                                            </button>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                                <!-- Tab Content  'SEASONAL' => [
                                                                'EID PAR SONY KI CHORIYAN', 'VALENTINE JEWELS', 'WINTER JEWELS'
                                                            ],  -->
                                                <div class="tab-content py-5 px-4" id="collectionTabsContent">
                                                   @php
                                                        $tabCollections = [
												'HIGH_END' => [
													 'HASHT', 'QAWS-AL-MATAR','NAGAR', 'GULPOSH','GOHAR','HAPHAZARD'
												],
                                                            'BRIDAL' => [
                                                                'GEHNAWA', 'NAVRATAN', 'TAJ MAHAL', 'HERITAGE','BREATHTAKING','CLEOPATRA','DIVINE TREASURES','MISTERIO','MARCHISIO'
                                                            ],
                                                            'LIFESTYLE' => [
                                                                'EHED', 'JEWELPHABETS', 'MONA LISA', 'PURE LOCK', 'SELENE'
                                                            ]
                                                        ];
                                                    @endphp
                                                    @foreach($tabs as $tabKey => $tabLabel)
                                                        <div class="tab-pane fade @if($loop->first) show active @endif"
                                                            id="content-{{ $tabKey }}"
                                                            role="tabpanel"
                                                            aria-labelledby="tab-{{ $tabKey }}">
                                                            @php
                                                                $filteredCollections = $jewelryCollections->filter(function($item) use ($tabCollections, $tabKey) {
                                                                    return in_array(strtoupper($item->name), $tabCollections[$tabKey] ?? []);
                                                                })->values();
                                                            @endphp
                                                            <div class="carousel-underline-wrapper">
                                                                @if($filteredCollections->count())
                                                                <div class="swiper mySwiper-{{ $tabKey }}" data-slide-count="{{ $filteredCollections->count() }}">
                                                                    <div class="swiper-wrapper">
                                                                        @foreach ($filteredCollections as $collection)
                                                                            @php
                                                                                $collectionName = strtoupper($collection['name']);
                                                                                $url = $customRoutes[$collectionName] ?? route('subcategory', ['subcategory' => $collection['slug']]);
                                                                            @endphp
                                                                            <div class="swiper-slide px-3">
                                                                                <a href="{{ $url }}" class="text-decoration-none">
                                                                                    <img src="{{ asset('assets/f_assets/image/jewelry-collection-logos/' . $collection['name'] . '.jpg') }}" class="img-fluid mb-2" alt="{{ $collection['name'] }}" loading="lazy">
                                                                                    <div class="fw-bold text-dark text-center">{{ strtoupper($collection['name']) }}</div>
                                                                                </a>
                                                                            </div>
                                                                        @endforeach
                                                                    </div>
                                                                    @if ($filteredCollections->count() > 3)
                                                                        <div class="swiper-button-next swiper-button-next-{{ $tabKey }}"></div>
                                                                        <div class="swiper-button-prev swiper-button-prev-{{ $tabKey }}"></div>
                                                                    @endif
                                                                </div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" aria-current="page" href="{{ url('solitaire') }}">SOLITAIRE</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" aria-current="page"
                                    href="{{ url('/collections/online-shopping-store') }}">ONLINE
                                    SHOPPING STORE</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" aria-current="page" href="{{ url('watches') }}">WATCHES</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    </header>

    @php
        $searchItems = app(\App\Services\ProductSearchService::class)->itemsForCurrentPage();
    @endphp

    <style>
        .nav-search-wrapper {
            max-width: 1200px;
            margin: 0 auto;
        }
        #navSearchModal .modal-content {
            background: #fff !important;
            color: #111;
            opacity: 1 !important;
            border-radius: 6px;
            box-shadow: 0 18px 60px rgba(0,0,0,0.24) !important;
        }
        #navSearchModal .modal-body {
            background: #fff;
            padding: 22px 18px 24px;
        }
        #navSearchModal .btn-close {
            opacity: 1;
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
                            <input type="text" class="form-control nav-search-input" id="navSearchInput" placeholder="Search collections or products" autocomplete="off">
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

    @extends('public.layouts.footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
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
                    searchEmpty.textContent = 'Start typing to search collections or products.';
                    return;
                }

                const matches = searchData
                    .filter(item => (item.searchText || item.label || '').includes(normalized));

                if (!matches.length) {
                    searchEmpty.textContent = 'No results found.';
                    return;
                }

                if (searchCount) {
                    searchCount.textContent = `Results (${matches.length})`;
                }

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
                    const term = searchInput.value.trim().toLowerCase();
                    const match = searchData.find(item => (item.searchText || item.label || '').includes(term));
                    if (match) {
                        window.location.href = match.url;
                    } else {
                        renderResults(term);
                    }
                });
            }

            if (searchModalEl) {
                searchModalEl.addEventListener('shown.bs.modal', () => {
                    if (searchInput) {
                        searchInput.value = '';
                        renderResults('');
                        searchInput.focus();
                    }
                });
            }

            // Tab hover logic (keep as is)
            const tabButtons = document.querySelectorAll('#collectionTabs .nav-link');
            tabButtons.forEach(function (btn) {
                btn.addEventListener('mouseenter', function (e) {
                    e.preventDefault();
                    const tab = new bootstrap.Tab(btn);
                    tab.show();
                });
            });

            // Swiper initialization on tab show
            let swiperInstances = {};

            function initSwiper(tabKey) {
                // Destroy previous instance if it exists
                if (swiperInstances[tabKey]) {
                    swiperInstances[tabKey].destroy(true, true);
                    swiperInstances[tabKey] = null;
                }
                var swiperEl = document.querySelector('.mySwiper-' + tabKey);
                if (!swiperEl) return;
                var slideCount = swiperEl.querySelectorAll('.swiper-slide').length;
                var slidesPerView = 3;
                var loopEnabled = slideCount > slidesPerView;

                // Hide navigation arrows if not enough slides
                var nextBtn = swiperEl.querySelector('.swiper-button-next');
                var prevBtn = swiperEl.querySelector('.swiper-button-prev');
                if (nextBtn && prevBtn) {
                    if (loopEnabled) {
                        nextBtn.style.display = '';
                        prevBtn.style.display = '';
                    } else {
                        nextBtn.style.display = 'none';
                        prevBtn.style.display = 'none';
                    }
                }

                swiperInstances[tabKey] = new Swiper('.mySwiper-' + tabKey, {
                    slidesPerView: slidesPerView,
                    spaceBetween: 0,
                    loop: loopEnabled,
                    navigation: {
                        nextEl: '.swiper-button-next-'+tabKey,
                        prevEl: '.swiper-button-prev-'+tabKey,
                    },
                    autoplay: {
                        delay: 2500,
                        disableOnInteraction: false
                    },
                    observer: true,
                    observeParents: true,
                    watchSlidesProgress: true,
                    breakpoints: {
                        0: { slidesPerView: 3 }
                    }
                });
            }

            // Initialize the first tab's Swiper on page load
            initSwiper('HIGH_END');

            // Initialize Swiper when a tab is shown
            tabButtons.forEach(function (btn) {
                btn.addEventListener('shown.bs.tab', function () {
                    const tabKey = btn.id.replace('tab-', '');
                    setTimeout(function() {
                        initSwiper(tabKey);
                    }, 50); // 50ms delay ensures DOM is ready
                });
            });

            // After Swiper initialization and tab event listeners
            // Prevent Swiper nav arrow clicks from bubbling up
            setTimeout(function() {
                document.querySelectorAll('.swiper-button-next, .swiper-button-prev').forEach(function(btn) {
                    btn.addEventListener('click', function(e) {
                        e.stopPropagation();
                    });
                });
            }, 100);
        });
    </script>
</body>

</html>
