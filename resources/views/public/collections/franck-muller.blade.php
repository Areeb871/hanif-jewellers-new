@extends('public.layouts.header_black_white_fixed')

@section('content')
<style>
.watchland-section{
    width: 100%;
    margin: 0;
    padding: 0;
}

/* =======================
   TOP TEXT
======================= */
.watchland-text-top{
    width: 100%;
    margin: 0 auto;
    padding: 30px 20px 25px;
    text-align: center;
}

.watchland-text-top p{
    margin: 0;
    font-size: 14px;
    line-height: 1.8;
    color: #222;
}

/* =======================
   BANNER
======================= */
.watchland-banner{
    position: relative;
    width: 100%;
    overflow: hidden;
}

.watchland-banner img{
    width: 100%;
    height: auto;
    display: block;
}
/* Center text on banner */
.watchland-title{
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    
    font-size: 52px;
    letter-spacing: 8px;
    color: #fff;
    font-weight: 500;
    text-transform: uppercase;
    text-align: center;
    font-family: 'Montserrat', sans-serif;
}

/* Tablet */
@media(max-width:992px){
    .watchland-title{
        font-size:36px;
        letter-spacing:5px;
    }
}

/* Mobile */
@media(max-width:576px){
    .watchland-title{
        font-size:24px;
        letter-spacing:3px;
    }
}

/* =======================
   LOGO SECTION
======================= */
.watchland-logo{
    width: 100%;
    text-align: center;
    padding: 30px 20px;
}

.watchland-logo img{
    max-width: 220px;
    width: 100%;
    height: auto;
    display: inline-block;
}

/* =======================
   FURTHER CONTENT
======================= */
.watchland-content{
    width: 100%;
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px 40px;
    text-align: center;
}

.watchland-content p{
    margin: 0;
    font-size: 16px;
    line-height: 1.8;
    color: #222;
}

/* =======================
   DESKTOP HERO
======================= */
.heroBanner{
    position: relative;
    width: 100%;
    overflow: hidden;
    background: #000;
    line-height: 0;
}

.heroVideo,
.heroImg{
    width: 100%;
    height: auto;
    display: block;
    object-fit: cover;
}

/* full width desktop */
.heroBanner.d-lg-block,
.heroBanner.d-md-block{
    width: 100vw;
    margin-left: calc(-50vw + 50%);
    margin-right: calc(-50vw + 50%);
}

/* =======================
   MOBILE / TABLET
======================= */
.mobileStackHero{
    width: 100%;
    background: #000;
}

.mobileStackImgWrap{
    width: 100%;
    overflow: hidden;
    background: #000;
    line-height: 0;
}

.mobileStackVideo,
.mobileStackImg{
    width: 100%;
    height: auto;
    display: block;
    object-fit: cover;
}
/*franck muller new */
.chronoswiss-intro-image-wrap{
    width:100vw;
    height:clamp(180px, 32vw, 500px);
    margin-left:calc(50% - 50vw);
    margin-right:calc(50% - 50vw);
    overflow:hidden;
    position:relative;
    line-height:0;
}
.chronoswiss-intro-image{
    width:100%;
    height:100%;
    display:block;
    object-fit:cover;
    object-position:center top;
    vertical-align:top;
}

/* =======================
   TABLET
======================= */
@media (max-width: 992px){
    .watchland-text-top{
        padding: 25px 18px 20px;
    }

    .watchland-text-top p,
    .watchland-content p{
        font-size: 15px;
        line-height: 1.7;
    }

    .watchland-logo{
        padding: 25px 18px;
    }

    .watchland-logo img{
        max-width: 180px;
    }
     .watchland-title{
        font-size: 40px;
        letter-spacing: 6px;
    }
}

/* =======================
   MOBILE
======================= */
@media (max-width: 768px){
    .watchland-text-top{
        padding: 20px 15px 18px;
    }

    .watchland-text-top p,
    .watchland-content p{
        font-size: 14px;
        line-height: 1.7;
    }

    .watchland-logo{
        padding: 20px 15px;
    }

    .watchland-logo img{
        max-width: 150px;
    }

    .watchland-content{
        padding: 0 15px 30px;
    }
      .watchland-title{
        font-size: 28px;
        letter-spacing: 4px;
    }
      .chronoswiss-intro-image-wrap{
        height:160px;
    }
}
@media (max-width: 576px){
       .chronoswiss-intro-image-wrap{
        height:100px;
    }
}
.offcanvas.offcanvas-modern{
  z-index: 20000 !important;
}

/* Offcanvas must be above any fixed header */
.offcanvas{
  z-index: 20000 !important;
}

/* Backdrop should stay below offcanvas */
.offcanvas-backdrop{
  z-index: 19999 !important;
}
</style>

<section class="watchland-section">
<div class="watchland-banner"style="letter-spacing: 8px;font-weight: 300;"> 
    <img src="{{ asset('assets/f_assets/image/watches/Watchland.webp') }}" alt="Divine Treasure" loading="lazy" />
        <div class="watchland-title">
        WATCHLAND
    </div>
 </div>
 


    <!-- TEXT FIRST -->
    <div class="watchland-text-top">
        <p>
            Franck Muller watches are one of the finest and most complicated of the world. The manufacture was founded in Geneva by Franck Muller and Vartan Sirmakes with the aim of creating exclusive timepieces characterised by complicated movements and original designs. Thanks to its strong in-house capabilities in numerous fields of Haute Horlogerie, this young company rapidly became one of the best Swiss horlogerie brands. Today, we believe we succeeded in combining boldness and creativity with exceptional Haute Horlogerie know-how.
        </p>
    </div>
      <div class="chronoswiss-intro-image-wrap">
        <img
            src="{{ asset('assets/f_assets/image/fm_new_view.png') }}"
            alt="Independent Watchmaking, Born in 1983"
            class="chronoswiss-intro-image"
        >
    </div>
    <div class="watchland-text-top">
        <h2 style="letter-spacing: 8px;font-weight: 300;">NEW MODELS</h2>
         <p>
            All the mechanical watchmaking complications invented by Franck Muller are designed and developed at the heart of our own workshops. From the simple sketch of a world premiere mechanism to the execution of the plans, every stage of manufacturing a timepiece is followed to its successful completion.
        </p>
    </div>
    @if(isset($franckMullerSubcategory) && $franckMullerSubcategory && $franckMullerSubcategory->banner_url)

        @php
           $mobileVideoPath = 'assets/f_assets/image/watches mobile view/fm_new_mobile.jpg';
            if (!empty($franckMullerSubcategory->slug) && $franckMullerSubcategory->slug === 'franck-muller') {
                $mobileVideo = $mobileVideoPath;
            } else {
                $mobileVideo = $franckMullerSubcategory->banner_url;
            }

            $desktopIsVideo = \Illuminate\Support\Str::endsWith($franckMullerSubcategory->banner_url, ['.mp4', '.webm', '.ogg']);
            $mobileIsVideo  = \Illuminate\Support\Str::endsWith($mobileVideo, ['.mp4', '.webm', '.ogg']);

            $desktopExt = pathinfo($franckMullerSubcategory->banner_url, PATHINFO_EXTENSION);
            $mobileExt  = pathinfo($mobileVideo, PATHINFO_EXTENSION);
        @endphp

        <!-- DESKTOP BANNER -->
        @if($desktopIsVideo)
            <section class="heroBanner d-none d-md-block">
                <video
                    id="heroVideoDesktop"
                    class="heroVideo"
                    autoplay
                    loop
                    muted
                    playsinline
                    preload="metadata"
                >
                    <source src="{{ asset($franckMullerSubcategory->banner_url) }}" type="video/{{ $desktopExt }}">
                    Your browser does not support the video tag.
                </video>
            </section>
        @else
            <section class="heroBanner d-none d-md-block">
                <img
                    src="{{ asset($franckMullerSubcategory->banner_url) }}"
                    alt="Franck Muller Banner"
                    class="heroImg"
                    loading="eager"
                >
            </section>
        @endif

        <!-- MOBILE + TABLET BANNER -->
        @if($mobileIsVideo)
            <section class="mobileStackHero d-md-none">
                <div class="mobileStackImgWrap">
                    <video
                        id="heroVideoMobile"
                        class="mobileStackVideo"
                        autoplay
                        loop
                        muted
                        playsinline
                        preload="metadata"
                        poster="{{ asset('assets/f_assets/image/ayeza/ayeza_all_mobile_poster.jpg') }}"
                    >
                        <source src="{{ asset($mobileVideo) }}" type="video/{{ $mobileExt }}">
                        Your browser does not support the video tag.
                    </video>
                </div>
            </section>
        @else
            <section class="mobileStackHero d-md-none">
                <div class="mobileStackImgWrap">
                    <img
                        src="{{ asset($mobileVideo) }}"
                        alt="Franck Muller Banner"
                        class="mobileStackImg"
                        loading="eager"
                    >
                </div>
            </section>
        @endif
    @endif
     <div class="watchland-text-top">
        <h3 style="letter-spacing: 8px;font-weight: 300;">FEATURED TIMEPIECES</h3>
        <p>
Wasim Akram for Franck Muller — an enduring symbol of power, discipline, and timeless elegance.The Vanguard Yachting Anchor features an open-worked design with blue anodised bridges, showcasing exceptional mechanical depth and artisanal craftsmanship. Powered by an in-house movement with a seven-day power reserve, it represents strength, precision, and enduring performance.        </p>
    </div>
</section>


    <section class="py-4">
        <style>
            .offcanvas-modern { font-family: 'Inter', Arial, sans-serif; background:#fff !important; color:#222; min-width:320px; max-width:380px; }
            @media (max-width: 767px) { .offcanvas-modern { min-width:100% !important; max-width:100% !important; width:100% !important; } }
            .offcanvas-modern .offcanvas-header { border-bottom:1px solid #fff; padding-bottom:0.5rem; background:#fff; }
            .offcanvas-modern .offcanvas-title { font-size:1.1rem; font-weight:400; letter-spacing:.02em; text-transform:uppercase; color:#222; }
            .offcanvas-modern .btn-close { filter:none; opacity:1; background-size:1em; width:1em; height:1em; }
            /* Simple SORT & FILTER button - no borders on any state */
            .filter .navbar-toggler { border:none !important; outline:none !important; box-shadow:none !important; background:transparent !important; padding:4px 10px; font-size:14px; line-height:1.1; display:flex; align-items:center; gap:6px; }
            .filter .navbar-toggler:focus,
            .filter .navbar-toggler:hover,
            .filter .navbar-toggler:active { border:none !important; outline:none !important; box-shadow:none !important; background:transparent !important; }
            /* Match Online Shopping Store hamburger symbol */
            .filter .navbar-toggler-icon {
                width: 18px; height: 14px; background: none; display: inline-block; position: relative;
                background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 20'%3e%3crect x='0' y='0' width='30' height='2' fill='%23333'/%3e%3crect x='0' y='9' width='30' height='2' fill='%23333'/%3e%3crect x='0' y='18' width='30' height='2' fill='%23333'/%3e%3c/svg%3e");
                background-size: 100% 100%; background-repeat: no-repeat; margin-right: 2px;
            }
            /* Online Shopping Store spacing and typography for lists */
            .sort-list, .category-list, .subcategory-list { list-style:none; padding-left:0; margin-bottom:0; }
            .sort-list { max-height: 0; overflow:hidden; transition: max-height 0.3s ease-out; }
            .sort-list.show { max-height: 300px; transition: max-height 0.3s ease-in; }
            .sort-list li { padding: 0.4rem 0; font-size: 0.97rem; display:flex; align-items:center; color:#222; cursor:pointer; }
            .sort-list li.selected { font-weight: 600; color:#111; }
            .sort-list li .diamond { font-size: 0.7em; margin-right: 0.7em; color: #b2b2b2; }
            .sort-list li.selected .diamond { color:#111; }
            .category-list > li { padding: 0.4rem 0; font-size: 0.97rem; display:flex; align-items:center; color:#222; cursor:pointer; }
            .filter-section-title { font-size:.98rem; font-weight:300; letter-spacing:.01em; margin-bottom:.8rem; margin-top:1.5rem; text-transform:uppercase; color:#222; display:flex; align-items:center; justify-content:space-between; border-bottom:1px solid #ecebe7; padding-bottom:.5rem; cursor:pointer; }
            .category-list { list-style:none; padding-left:0; margin-bottom:0; }
            .category-list.collapsible { max-height:1000px; overflow:hidden; transition:max-height .3s ease-out; }
            .category-list.collapsible:not(.show) { max-height:0; transition:max-height .3s ease-in; }
            .category-list > li { padding:.4rem 0; font-size:.97rem; display:flex; align-items:center; color:#222; cursor:pointer; }
            .category-toggle { font-size:1.1em; color:#b2b2b2; cursor:pointer; user-select:none; width:20px; text-align:center; margin-left:10px; }
            .form-check-input.filter-tag-checkbox { accent-color:#111; border-color:#bbb; box-shadow:none !important; }
            .form-check-input.filter-tag-checkbox:checked { background-color:#111; border-color:#111; }
            .filter-actions { position:sticky; bottom:-16px; background:#fff; padding:12px 0 0 0; }
            .filter-actions-inner { border-top:1px solid #fff; padding-top:12px; display:flex; gap:10px; }
            .filter-actions .btn { border-radius:10px; font-size:13px; padding:8px 14px; }
            .offcanvas-modern .offcanvas-body { background: rgb(255, 255, 255); padding: 1rem; }
            /* Ensure cards fill available space */
            .onlineStore .col-6, .onlineStore .col-sm-4, .onlineStore .col-md-3, .onlineStore .col-lg-3 {
                display: flex;
                flex-direction: column;
            }
            .onlineStore .card {
                flex: 1;
                display: flex;
                flex-direction: column;
            }
            .onlineStore .card-body {
                flex: 1;
                display: flex;
                flex-direction: column;
                justify-content: space-between;
            }
            /* Center the Discover More button */
           .discover-more-btn{
  display: block;
  margin: 0 auto;
}
            /* Add space between checkbox and text */
            .filter-tag-checkbox {
                margin-right: 8px;
            }
           .brand-logo {
                display: block;
                margin-left: auto;
                margin-right: auto;
                width: 10%;
                height: auto;
            }
            /* Responsive logo sizing */
            @media (max-width: 575px) {
                .brand-logo {
                    width: 40%;
                    margin-top: -75px;
                }
            }
            @media (min-width: 576px) and (max-width: 767px) {
                .brand-logo {
                    width: 30%;
                }
            }
            @media (min-width: 768px) and (max-width: 991px) {
                .brand-logo {
                    width: 20%;
                }
            }
            @media (min-width: 992px) {
                .brand-logo {
                    width: 20%;
                    margin-top: -75px;
                }
            }
            /* Responsive SORT & FILTER button positioning */
            .filter .navbar-toggler {
                position: absolute !important;
                right: 0 !important;
                z-index: 10;
            }
            /* Mobile screens (up to 575px) */
            @media (max-width: 575px) {
                .filter .navbar-toggler {
                    margin-top: 80px !important;
                    margin-right: 10px !important;
                    font-size: 12px !important;
                    padding: 4px 8px !important;
                }
            }
            /* Small mobile screens (576px to 767px) */
            @media (min-width: 576px) and (max-width: 767px) {
                .filter .navbar-toggler {
                    margin-top: 100px !important;
                    margin-right: 15px !important;
                    font-size: 13px !important;
                }
            }
            /* Tablet screens (768px to 991px) */
            @media (min-width: 768px) and (max-width: 991px) {
                .filter .navbar-toggler {
                    margin-top: 120px !important;
                    margin-right: 20px !important;
                }
            }
            /* Desktop screens (992px and above) */
            @media (min-width: 992px) {
                .filter .navbar-toggler {
                    margin-top: 127px !important;
                    margin-right: 23px !important;
                }
            }
 /* ===============================
   FILTER BAR (no absolute hacks)
================================ */
.bovet-filterbar{
    display:grid;
    grid-template-columns: 1fr auto 1fr;   /* left space | logo | button */
    align-items:center;
    padding:12px 14px;
    background:#fff;
}

.bovet-filterbar__left{ justify-self:start; }
.bovet-filterbar__center{ justify-self:center; }
.bovet-filterbar__right{ justify-self:end; }

.bovet-brand-logo{
  width: clamp(120px, 32vw, 190px);
  height: auto;
  display: block;
  margin-top:-68px;
}

.bovet-filterbar__btn{
    border: none !important;
    outline: none !important;
    box-shadow: none !important;
    background: transparent !important;
    padding: 6px 8px;
    font-size: 12px;
    display: flex;
    align-items: center;
    gap: 6px;
    white-space: nowrap;
    transform: translateY(30px); /* move down */
}


.bovet-filterbar__btn:focus,
.bovet-filterbar__btn:hover,
.bovet-filterbar__btn:active{
    border:none !important;
    outline:none !important;
    box-shadow:none !important;
    background:transparent !important;
}

/* Hamburger icon same */
.bovet-filterbar__btn .navbar-toggler-icon{
    width:18px;
    height:14px;
    background:none;
    display:inline-block;
    background-image:url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 20'%3e%3crect x='0' y='0' width='30' height='2' fill='%23333'/%3e%3crect x='0' y='9' width='30' height='2' fill='%23333'/%3e%3crect x='0' y='18' width='30' height='2' fill='%23333'/%3e%3c/svg%3e");
    background-size:100% 100%;
    background-repeat:no-repeat;
}

        </style>
         <div class="navbar navbar-white bovet-filterbar">
    <div class="bovet-filterbar__left"></div>

    <div class="bovet-filterbar__center">
        <img src="{{ asset('assets/f_assets/image/watch logo/fm.png') }}"
             class="bovet-brand-logo" alt="Bovet">
    </div>

    <div class="bovet-filterbar__right">
        <button class="navbar-toggler bovet-filterbar__btn" type="button"
                data-bs-toggle="offcanvas" data-bs-target="#offcanvasFranckMuller">
            <span class="navbar-toggler-icon"></span> SORT & FILTER
        </button>
    </div>
</div>
       
         <div class="container-fluid px-3">
    <div class="row onlineStore g-2 pt-3" id="franckMullerGrid">
        @if(isset($products) && $products->count())
            @foreach($products as $prod)
                <div class="col-6 col-lg-3">
                    @include('public.partials.product-card-watches', ['product' => $prod])
                </div>
            @endforeach
        @else
            <div class="col-12">
                <div class="text-center py-5 text-muted">Collection to be Revealed Soon!</div>
            </div>
        @endif
    </div>
</div>

        
        
        <div class="text-center py-4 franck-muller-footer">
        @if($products->count() > 0)
            @php
                $totalShown = $currentPageProducts;
                $hasMorePages = $products->currentPage() < $products->lastPage();
            @endphp
            @if($totalFilteredProducts > 0)
            <div class="products-counter" data-total="{{ $totalFilteredProducts }}" data-current="{{ $currentPageProducts }}" data-per-page="{{ $products->perPage() }}" data-current-page="{{ $products->currentPage() }}" style="font-size: 1rem; letter-spacing: 0.2em; margin-bottom: 1.5rem;">
                SHOWING {{ $currentPageProducts }} OF {{ $totalFilteredProducts }} PRODUCTS
            </div>
            @endif
            @php
                $allProductsShown = $totalShown >= $totalFilteredProducts;
                $shouldShowLoadMore = $hasMorePages && !$allProductsShown;
            @endphp
            @if($shouldShowLoadMore)
                <button id="loadMoreBtn"
                        style="background: #e3e4e5; border: none; color: #222; font-size: 0.8rem; letter-spacing: 0.15em; padding: 0.8rem 2rem; border-radius: 8px; font-family: inherit; font-weight: 400; box-shadow: none; transition: background 0.2s;"
                        data-page="{{ $products->currentPage() + 1 }}"
                        data-last-page="{{ $products->lastPage() }}"
                        data-per-page="{{ $products->perPage() }}"
                        data-total="{{ $totalFilteredProducts }}">
                    LOAD MORE
                </button>
            @endif
        </div>
        @endif
    </section>

    <div class="offcanvas offcanvas-end offcanvas-modern" tabindex="-1" id="offcanvasFranckMuller" aria-labelledby="offcanvasFranckMullerLabel" data-bs-backdrop="true" data-bs-scroll="false">
        <div class="offcanvas-header">
            <span class="offcanvas-title" id="offcanvasFranckMullerLabel">SORT & FILTER</span>
            <button type="button" class="btn-close btn-close-black" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <div>
                <div class="filter-section-title" onclick="toggleCategory('franckMullerSortList', this.querySelector('.category-toggle'))" style="font-size: 14px !important;">
                    Sort By <span class="category-toggle">+</span>
                </div>
                <ul class="sort-list" id="franckMullerSortList">
                    @php $currentSort = request('sort'); @endphp
                    <li data-value="" class="{{ !$currentSort ? 'selected' : '' }}">
                        <span class="diamond">{{ !$currentSort ? '◆' : '◇' }}</span> Best Selling
                    </li>
                    <li data-value="az" class="{{ $currentSort=='az' ? 'selected' : '' }}">
                        <span class="diamond">{{ $currentSort=='az' ? '◆' : '◇' }}</span> Alphabetically, A-Z
                    </li>
                    <li data-value="za" class="{{ $currentSort=='za' ? 'selected' : '' }}">
                        <span class="diamond">{{ $currentSort=='za' ? '◆' : '◇' }}</span> Alphabetically, Z-A
                    </li>

                </ul>
            </div>
            <div>
                <div class="filter-section-title" onclick="toggleCategory('franckMullerGenderList', this.querySelector('.category-toggle'))" style="font-size: 14px !important;">Gender <span class="category-toggle">+</span></div>
                <ul class="category-list collapsible" id="franckMullerGenderList">
                    @php $selectedTags = collect(explode(',', request('tags', '')))->map(fn($s)=>trim($s)); @endphp
                    <li><input type="checkbox" class="form-check-input filter-tag-checkbox franck-muller-filter" data-group="gender" value="mens" {{ $selectedTags->contains('mens') ? 'checked' : '' }} onclick="event.stopPropagation();"> <span class="subcat-label">Men's</span></li>
                    <li><input type="checkbox" class="form-check-input filter-tag-checkbox franck-muller-filter" data-group="gender" value="ladies" {{ $selectedTags->contains('ladies') ? 'checked' : '' }} onclick="event.stopPropagation();"> <span class="subcat-label">Ladies</span></li>
                </ul>
            </div>
            <div class="mt-3">
                <div class="filter-section-title" onclick="toggleCategory('franckMullerSeriesList', this.querySelector('.category-toggle'))" style="font-size: 14px !important;">Series <span class="category-toggle">+</span></div>
                <ul class="category-list collapsible" id="franckMullerSeriesList">
                    @php
                        $series = [
                            'cintree-curvex' => 'Cintree Curvex',
                            'curvex-cx' => 'Curvex CX',
                            'conquistador-gpg' => 'Conquistador GPG',
                            'galet' => 'Galet',
                            'heart' => 'Heart',
                            'long-island' => 'Long Island',
                            'master-square' => 'Master Square',
                            'round' => 'Round',
                            'vanguard' => 'Vanguard',
                            'Crazy Hours' => 'Crazy Hours',
                            'Black Croco' => 'Black Croco',
                            'Mariner'=>'Mariner',
                            'Secret Hours'=>'Secret Hours',
                            'Master Banker'=>'Master Banker'
                        ];
                    @endphp
                    @foreach($series as $s => $label)
                        <li><input type="checkbox" class="form-check-input filter-tag-checkbox franck-muller-filter" data-group="series" value="{{ $s }}" {{ $selectedTags->contains($s) ? 'checked' : '' }} onclick="event.stopPropagation();"> <span class="subcat-label">{{ $label }}</span></li>
                    @endforeach
                </ul>
            </div>
            <div class="mt-3">
                <div class="filter-section-title" onclick="toggleCategory('franckMullerSizeList', this.querySelector('.category-toggle'))" style="font-size: 14px !important;">Case Size <span class="category-toggle">+</span></div>
                <ul class="category-list collapsible" id="franckMullerSizeList">
                    @php $sizes = ['25','26','32','36','37','39.6','40','42','43','44','45']; @endphp
                    @foreach($sizes as $sz)
                        <li><input type="checkbox" class="form-check-input filter-tag-checkbox franck-muller-filter" data-group="size" value="{{ $sz }}" {{ $selectedTags->contains($sz) ? 'checked' : '' }} onclick="event.stopPropagation();"> <span class="subcat-label">{{ $sz }}mm</span></li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>

    <script>
    function toggleCategory(targetId, element) {
        const target = document.getElementById(targetId);
        if (!target) return;
        const isExpanded = target.classList.contains('show');
        if (isExpanded) { 
            target.classList.remove('show'); 
            if (element) element.textContent = '+'; 
        } else { 
            target.classList.add('show'); 
            if (element) element.textContent = '−'; 
        }
    }
    (function(){
        const offcanvas = document.getElementById('offcanvasFranckMuller');
        function buildUrl() {
            const url = new URL(window.location.href);
            // Build unified tags param to match server-side filtering
            url.searchParams.delete('tags');
            url.searchParams.delete('gender');
            url.searchParams.delete('series');
            url.searchParams.delete('size');
            const selected = Array.from(document.querySelectorAll('.franck-muller-filter:checked')).map(i=>i.value);
            if (selected.length) url.searchParams.set('tags', selected.join(',')); else url.searchParams.delete('tags');
            url.searchParams.set('page', '1');
            return url;
        }
        function fetchAndRender(url) {
            window.history.pushState({}, '', url.toString());
            fetch(url.toString(), { headers: { 'X-Requested-With': 'XMLHttpRequest' }})
                .then(resp => resp.text())
                .then(html => {
                    const parser = new DOMParser();
                    const doc = parser.parseFromString(html, 'text/html');
                    const incomingGrid = doc.querySelector('#franckMullerGrid');
                    const grid = document.querySelector('#franckMullerGrid');
                    
                    if (incomingGrid && grid) {
                        grid.innerHTML = incomingGrid.innerHTML;
                    }
                    
                    const incomingFooter = doc.querySelector('.franck-muller-footer');
                    const footer = document.querySelector('.franck-muller-footer');
                    if (footer) {
                        footer.innerHTML = incomingFooter ? incomingFooter.innerHTML : '';
                        if (typeof window.bindLoadMore === 'function') {
                            window.bindLoadMore();
                        }
                        if (typeof window.updateCounter === 'function') {
                            window.updateCounter();
                        }
                    }
                    
                    // Keep offcanvas open like Online Store for quick multi-select
                })
                .catch(()=>{});
        }
        // Sort handlers (AJAX, no page reload)
        (function(){
            const sortList = document.getElementById('franckMullerSortList');
            if (!sortList) return;
            sortList.querySelectorAll('li').forEach(li => {
                li.addEventListener('click', function(){
                    // UI update like online store
                    sortList.querySelectorAll('li').forEach(x => { x.classList.remove('selected'); const d=x.querySelector('.diamond'); if(d) d.textContent='◇'; });
                    this.classList.add('selected'); const d=this.querySelector('.diamond'); if(d) d.textContent='◆';
                    const url = buildUrl();
                    const val = this.getAttribute('data-value') || '';
                    if (val) url.searchParams.set('sort', val); else url.searchParams.delete('sort');
                    fetchAndRender(url);
                });
            });
        })();

        // Checkbox immediate apply like online store
        document.querySelectorAll('.franck-muller-filter').forEach(cb => {
            cb.addEventListener('click', function(e){ e.stopPropagation(); const url = buildUrl(); fetchAndRender(url); });
        });
    })();
    
    // Load More functionality
    document.addEventListener('DOMContentLoaded', function() {
        window.bindLoadMore = function bindLoadMore() {
            const loadMoreBtn = document.getElementById('loadMoreBtn');
            if (!loadMoreBtn) return;
            
            // Remove previous listeners by cloning
            const btn = loadMoreBtn.cloneNode(true);
            loadMoreBtn.parentNode.replaceChild(btn, loadMoreBtn);

            function getGrid(container) {
                return container.querySelector('#franckMullerGrid');
            }

            function appendIncomingItems(doc) {
                const currentGrid = getGrid(document);
                if (!currentGrid) return 0;

                // Primary: take children of incoming #franckMullerGrid
                let nodesToAppend = [];
                const incomingGrid = getGrid(doc) || doc.querySelector('#franckMullerGrid');
                if (incomingGrid) {
                    nodesToAppend = Array.from(incomingGrid.children);
                } else {
                    // Fallback: find product cards and append their closest column wrappers
                    const cards = Array.from(doc.querySelectorAll('.card.addToCartProductDetailsTop'));
                    nodesToAppend = cards.map(card => card.closest('.col-6, .col-sm-4, .col-md-3, .col-lg-3') || card);
                }
                let appended = 0;
                nodesToAppend.forEach(node => {
                    if (!node) return;
                    currentGrid.appendChild(node);
                    appended++;
                });
                return appended;
            }

            window.updateCounter = function updateCounter() {
                const grid = getGrid(document);
                if (!grid) return;
                
                // Count products dynamically from the grid - count actual product cards
                const totalShown = grid.querySelectorAll('.card.addToCartProductDetailsTop').length;
                const counter = document.querySelector('.franck-muller-footer .products-counter');
                
                if (counter) {
                    // Get the total from data attribute (set by server)
                    const total = parseInt(counter.getAttribute('data-total') || '0', 10);
                    const perPage = parseInt(counter.getAttribute('data-per-page') || '20', 10);
                    
                    // Update the current count
                    counter.setAttribute('data-current', totalShown);
                    
                    // Only show counter if there are products
                    if (total > 0) {
                        // Update the display text with actual counts
                        counter.textContent = `SHOWING ${totalShown} OF ${total} PRODUCTS`;
                        counter.style.display = 'block';
                    } else {
                        counter.style.display = 'none';
                    }
                    
                    // Update button data if it exists
                    const loadMoreBtn = document.getElementById('loadMoreBtn');
                    if (loadMoreBtn) {
                        const currentPage = parseInt(loadMoreBtn.getAttribute('data-page') || '2', 10);
                        const lastPage = parseInt(loadMoreBtn.getAttribute('data-last-page') || '2', 10);
                        const totalFromBtn = parseInt(loadMoreBtn.getAttribute('data-total') || total, 10);
                        
                        // Hide button if all products are shown or no more pages
                        if (totalShown >= totalFromBtn || currentPage > lastPage) {
                            loadMoreBtn.style.display = 'none';
                        } else {
                            loadMoreBtn.style.display = 'inline-block';
                        }
                    }
                }
            }

            btn.addEventListener('click', function() {
                const nextPage = parseInt(btn.getAttribute('data-page') || '2', 10);
                const lastPage = parseInt(btn.getAttribute('data-last-page') || String(nextPage), 10);
                const perPage = parseInt(btn.getAttribute('data-per-page') || '20', 10);
                const total = parseInt(btn.getAttribute('data-total') || '0', 10);
                
                btn.disabled = true;
                btn.textContent = 'Loading...';

                // Preserve current query (sort, tags, etc.)
                const url = new URL(window.location.href);
                url.searchParams.set('page', String(nextPage));

                fetch(url.toString(), { headers: { 'X-Requested-With': 'XMLHttpRequest' }, cache: 'no-cache' })
                    .then(response => response.text())
                    .then(html => {
                        const parser = new DOMParser();
                        const doc = parser.parseFromString(html, 'text/html');

                        let appended = appendIncomingItems(doc);
                        window.updateCounter();

                        // Sync data from incoming markup
                        const incomingBtn = doc.querySelector('#loadMoreBtn');
                        const incomingCounter = doc.querySelector('.products-counter');
                        
                        if (incomingBtn) {
                            const incomingLast = parseInt(incomingBtn.getAttribute('data-last-page') || String(lastPage), 10);
                            const incomingPerPage = parseInt(incomingBtn.getAttribute('data-per-page') || String(perPage), 10);
                            const incomingTotal = parseInt(incomingBtn.getAttribute('data-total') || String(total), 10);
                            
                            btn.setAttribute('data-last-page', String(incomingLast));
                            btn.setAttribute('data-per-page', String(incomingPerPage));
                            btn.setAttribute('data-total', String(incomingTotal));
                        }
                        
                        if (incomingCounter) {
                            const counter = document.querySelector('.products-counter');
                            if (counter) {
                                counter.setAttribute('data-total', incomingCounter.getAttribute('data-total') || total);
                                counter.setAttribute('data-per-page', incomingCounter.getAttribute('data-per-page') || perPage);
                            }
                        }

                        // If nothing appended but we did receive a grid, try innerHTML append as a fallback
                        if (appended === 0) {
                            const currentGrid = document.querySelector('#franckMullerGrid');
                            const incomingGrid2 = doc.querySelector('#franckMullerGrid');
                            if (currentGrid && incomingGrid2) {
                                currentGrid.insertAdjacentHTML('beforeend', incomingGrid2.innerHTML);
                                appended = incomingGrid2.children.length;
                                window.updateCounter();
                            }
                        }
                        
                        // Check if we've reached the end
                        const currentTotal = parseInt(btn.getAttribute('data-total') || total, 10);
                        const currentGrid = document.querySelector('#franckMullerGrid');
                        const currentShown = currentGrid ? currentGrid.querySelectorAll('.card.addToCartProductDetailsTop').length : 0;
                        const reachedEnd = currentShown >= currentTotal || appended === 0;
                        
                        if (reachedEnd) {
                            btn.style.display = 'none';
                        } else {
                            btn.setAttribute('data-page', String(nextPage + 1));
                            btn.disabled = false;
                            btn.textContent = 'LOAD MORE';
                            btn.style.display = 'inline-block';
                        }
                        // Smoothly scroll a bit to bring new items into view
                        try { window.scrollBy({ top: 200, left: 0, behavior: 'smooth' }); } catch (_) {}
                    })
                    .catch(() => {
                        btn.disabled = false;
                        btn.textContent = 'LOAD MORE';
                        // As a last resort, fall back to full navigation
                        try {
                            const url = new URL(window.location.href);
                            const nextPage = parseInt(btn.getAttribute('data-page') || '2', 10);
                            url.searchParams.set('page', String(nextPage));
                            window.location.href = url.toString();
                        } catch (_) {}
                    });
            });
        };
        // Initial bind
        window.bindLoadMore();
        
        // Initialize counter on page load
        window.updateCounter();
    });
    </script>
@endsection
