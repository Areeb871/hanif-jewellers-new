@extends('public.layouts.header_black_white_fixed')

@section('content')
@php
    $fallbackBanner = 'assets/f_assets/image/ehed/ehed banner.mp4';
    $videoExtensions = ['mp4', 'webm', 'ogg'];

    $desktopBannerSource = optional($subcategory)->banner_url ?: $fallbackBanner;
    $mobileBannerSource = optional($subcategory)->banner_mobile_url ?: $desktopBannerSource;

    $desktopPath = parse_url($desktopBannerSource, PHP_URL_PATH) ?? $desktopBannerSource;
    $mobilePath = parse_url($mobileBannerSource, PHP_URL_PATH) ?? $mobileBannerSource;

    $desktopExtension = strtolower(pathinfo($desktopPath, PATHINFO_EXTENSION));
    $mobileExtension = strtolower(pathinfo($mobilePath, PATHINFO_EXTENSION));

    $desktopIsVideo = in_array($desktopExtension, $videoExtensions);
    $mobileIsVideo = in_array($mobileExtension, $videoExtensions);

    $desktopType = $desktopIsVideo && $desktopExtension ? 'video/' . $desktopExtension : null;
    $mobileType = $mobileIsVideo && $mobileExtension ? 'video/' . $mobileExtension : null;

    $desktopBannerUrl = filter_var($desktopBannerSource, FILTER_VALIDATE_URL) ? $desktopBannerSource : asset($desktopBannerSource);
    $mobileBannerUrl = filter_var($mobileBannerSource, FILTER_VALIDATE_URL) ? $mobileBannerSource : asset($mobileBannerSource);
@endphp
<style>
@import url('https://fonts.googleapis.com/css2?family=Cinzel:wght@400;600;700&family=Poppins:wght@400;500;600&display=swap');
@font-face{
    font-family:"Argent CF";
    src:url("{{ asset('assets/f_assets/css/fonts/fonnts.com-Argent-CF-.otf') }}") format("opentype");
    font-weight:400;
    font-style:normal;
    font-display:swap;
}

/* ========== ONE GAP EVERYWHERE ========== */
:root{ --ehed-gap:8px; }

/* ========== HERO ========== */
.ehed-hero-section{
    display:flex;
    align-items:stretch;
}
.ehed-video-container{
    width:50%;
    position:relative;
    overflow:hidden;
    flex-shrink:0;
    aspect-ratio:746 / 430;
    background:#fff;
}
.ehed-video-container video,
.ehed-media-cover{
    position:absolute;
    inset:0;
    width:99.6%;
    height:104%;
    object-fit:contain;
    object-position:center center;
    display:block;
}
.ehed-content-container{
    width:50%;
    min-width:0;
    box-sizing:border-box;
    padding:8px 24px;
    display:flex;
    flex-direction:column;
    justify-content:center;
    background:#fff;
}
.ehed-category-label{
    font-size:14px; font-weight:400; color:#999; text-transform:uppercase;
    letter-spacing:.05em;
    font-family:'Poppins',sans-serif;
    margin:0 0 16px;
}
.ehed-main-title{
    font-size:3rem; color:#000; font-family:"Argent CF",Georgia,serif;
    margin:0 0 10px; line-height:1.1; font-weight:400;
}
.ehed-body-text{
    font-size:16px; font-weight:400; color:#000; line-height:1.6; max-width:100%;
    font-family:'Poppins',sans-serif;
}
.hero__description{ margin-top:0; font-size:100%; max-width:100%; }
.text-large{
    font-family:Walbaum,sans-serif; color:#010307; font-style:normal;
    font-weight:400; line-height:120%; font-size:2rem; letter-spacing:1.6px;
}
.uppercase{ text-transform:uppercase; }
h1,h2,h3,h4,h5,h6{ margin-top:0; margin-bottom:0; }

@media(min-width:48rem){
    .hero__description{ max-width:40rem; font-size:110%; }
    .text-align--center .hero__description{ margin-left:auto; margin-right:auto; }
}
@media(min-width:699px){ .text-large{ font-size:2.5rem; letter-spacing:2px; } }
@media(min-width:1024px){ .text-large{ font-size:3rem; letter-spacing:2.4px; } }

@media(max-width:991.98px){
    .ehed-hero-section{ padding-top:56px; }
}
@media(min-width:768px){
    .ehed-content-container{ padding:8px 40px; }
    .ehed-cards{ margin-top: var(--ehed-gap); }
}
@media(min-width:768px) and (max-width:1199.98px){
    .ehed-hero-section{ align-items:stretch; }
    .ehed-video-container{
        aspect-ratio:746 / 430;
        min-height:0;
        height:auto;
    }
    .ehed-content-container{
        padding:8px 28px;
        overflow:visible;
        justify-content:center;
    }
    .ehed-category-label{ font-size:12px; margin:0 0 8px; }
    .ehed-main-title{ font-size:clamp(28px,3.6vw,42px); line-height:1.1; margin:0 0 8px; overflow:visible; }
    .ehed-body-text{ font-size:14px; line-height:1.55; }
    .hero__description{ max-width:100%; font-size:100%; }
}
@media(min-width:1200px){
    .ehed-content-container{ padding:8px 60px; }
}
@media(max-width:767.98px){
    .ehed-hero-section{ flex-direction:column; min-height:auto; }
    .ehed-video-container{ width:100%; height:auto; aspect-ratio:746 / 430; }
    .ehed-content-container{ width:100%; padding:24px 20px; }
    .ehed-main-title{ font-size:48px; }
    .ehed-category-label{ font-size:12px; }
    .ehed-body-text{ font-size:14px; }
}
@media(max-width:576px){
    .ehed-main-title{ font-size:36px; }
    .ehed-content-container{ padding:30px 20px; }
}

/* ========== DISCOVER BUTTON ========== */
.discover-button-overlay{
    z-index:20; pointer-events:none; padding-bottom:2rem;
    left:0; right:0; bottom:0;
}
.discover-btn{
    background-color:transparent; border:1px solid rgba(255,255,255,.7);
    color:#fff; font-weight:600; font-size:1rem; letter-spacing:2px;
    text-transform:uppercase; border-radius:4px; pointer-events:auto;
    transition:all .3s ease; padding:.75rem 3rem;
    white-space:nowrap; display:inline-block; text-decoration:none;
}
.discover-btn:hover{ background-color:rgba(128,128,128,.8); color:#fff; transform:scale(1.05); text-decoration:none; }
.discover-btn:active{ transform:scale(.98); }

@media(min-width:992px){ .discover-btn{ padding:.875rem 3.5rem; } .discover-button-overlay{ padding-bottom:3rem; } }
@media(max-width:768px){
    .discover-button-overlay{ padding-bottom:1.5rem!important; z-index:20!important; bottom:0!important; position:absolute!important; }
    .discover-btn{ font-size:.875rem; padding:.625rem 1.5rem!important; letter-spacing:1.5px; width:auto; max-width:90%; }
}
@media(max-width:576px){
    .discover-btn{ font-size:.75rem; padding:.5rem 1.25rem!important; letter-spacing:1px; }
    .discover-button-overlay{ padding-bottom:1rem!important; }
}
@media(max-width:480px){
    .discover-btn{ font-size:1.2rem; padding:.5rem 1rem!important; letter-spacing:.5px; }
    .discover-button-overlay{ padding-bottom:.875rem!important; }
}
@media(max-width:375px){
    .discover-btn{ font-size:1.1rem; padding:.45rem .875rem!important; letter-spacing:.5px; }
    .discover-button-overlay{ padding-bottom:.75rem!important; }
}
@media(max-width:375px)and(max-height:667px){ .discover-button-overlay{ display:none!important; } }
@media(max-width:414px)and(max-height:736px)and(min-width:376px){ .discover-button-overlay{ display:none!important; } }
@media(max-width:360px){
    .discover-button-overlay{ bottom:auto!important; top:80%!important; left:50%!important; transform:translate(-50%,-50%)!important; padding-bottom:0!important; }
}

/* ========== CARDS: same 8px gap top-to-bottom and left-to-right ========== */
.ehed-cards{
    display:flex;
    flex-direction:column;
    gap: 8px;
    margin: 8px 0 0;
    padding: 0;
}
.ehed-cards img{ display:block; }
.ehed-grid{
    display:grid;
    grid-template-columns:repeat(4, minmax(0,1fr));
    gap: 8px;
    margin:0 !important;
    --bs-gutter-x:0;
    --bs-gutter-y:0;
}
.ehed-grid > [class*="col-"]{
    width:auto;
    max-width:none;
    padding:0;
    margin:0;
    line-height:0;
}
.ehed-grid-img{
    width:100%; aspect-ratio:1/1; object-fit:cover; display:block;
    vertical-align:top;
}
@media(max-width:767.98px){
    .ehed-grid{ grid-template-columns:repeat(2, minmax(0,1fr)); }
}

/* ========== PROMO SECTION (carousel + right images) ========== */
.ehed-promo{
    margin:0 !important;
    padding:0;
}
.ehed-promo .discover-btn,
.ehed-promo .shop-now-btn{
    border-color:#ECECEC !important;
    color:#ECECEC !important;
}
.ehed-promo .discover-btn:hover,
.ehed-promo .shop-now-btn:hover,
.ehed-promo .discover-btn:focus,
.ehed-promo .shop-now-btn:focus{
    background:#000 !important;
    border-color:#000 !important;
    color:#fff !important;
}

.ehed-promo__row{
    display:grid;
    grid-template-columns:repeat(4, minmax(0,1fr));
    gap: 8px;
    align-items:stretch;
}

/* Carousel col */
.ehed-promo__carousel-col{
    grid-column:span 2;
    min-width:0; min-height:0;
}
.ehed-promo__carousel-wrap{
    position:relative; width:100%; height:100%; overflow:hidden;
}
#promoCarouselEhed{ position:absolute; inset:0; width:100%; height:100%; }
#promoCarouselEhed .carousel-inner,
#promoCarouselEhed .carousel-item{ height:100%; }
#promoCarouselEhed .carousel-item img{
    position:absolute; inset:0; width:100%; height:100%;
    object-fit:cover; display:block; z-index:1;
}

/* Product tiles — aspect-ratio drives the row height */
.ehed-promo__tile{
    position:relative; display:block; width:100%; min-width:0;
    aspect-ratio:1/1; overflow:hidden;
}
.ehed-promo__tile img{
    position:absolute; inset:0; width:100%; height:100%;
    object-fit:cover; display:block;
}

/* Mobile: stack carousel on top, tiles side by side below */
@media(max-width:767.98px){
    .ehed-promo__row{ grid-template-columns:repeat(2, minmax(0,1fr)); }
    .ehed-promo__carousel-col{ grid-column:1 / -1; }
    .ehed-promo__carousel-wrap{ height:auto; aspect-ratio:1/1; }
}

/* ========== SHOP NOW SPACER ========== */
.ehed-shop-spacing{
    display:flex; align-items:center; justify-content:center;
    padding:2.5rem 0;
}
@media(max-width:767.98px){ .ehed-shop-spacing{ padding:1.5rem 0; } }
</style>

{{-- ========== HERO SECTION ========== --}}
<section class="ehed-hero-section">
    <div class="ehed-video-container d-none d-md-block">
        @if($desktopIsVideo)
            <video autoplay loop muted playsinline>
                <source src="{{ $desktopBannerUrl }}" @if($desktopType) type="{{ $desktopType }}" @endif>
                Your browser does not support the video tag.
            </video>
        @else
            <img src="{{ $desktopBannerUrl }}" alt="Ehed Banner" class="ehed-media-cover">
        @endif
    </div>
    <div class="ehed-video-container d-block d-md-none">
        @if($mobileIsVideo)
            <video autoplay loop muted playsinline>
                <source src="{{ $mobileBannerUrl }}" @if($mobileType) type="{{ $mobileType }}" @endif>
                Your browser does not support the video tag.
            </video>
        @else
            <img src="{{ $mobileBannerUrl }}" alt="Ehed Banner Mobile" class="ehed-media-cover">
        @endif
    </div>
    <div class="ehed-content-container">
        <h1 class="ehed-main-title">EHED</h1>
        <div class="ehed-category-label">MEN & WOMEN</div>
        <p class="ehed-body-text hero__description">
            Ehed by Hanif is for all those unbreakable promises. Explore a whole world of possibilities elegantly handcrafted for all occasions.
        </p>
    </div>
</section>

<div class="ehed-cards">
{{-- ========== TOP GALLERY ROW ========== --}}
@if(isset($galleryImages) && $galleryImages->count() > 0)
<div class="ehed-grid" id="qawsAlMatarGallery">
    @foreach($galleryImages as $index => $image)
        <div class="col-6 col-md-3">
            <img src="{{ asset($image->image) }}" class="img-fluid ehed-grid-img" alt="Ehed Gallery Image" data-gallery="qawsAlMatarGallery" data-index="{{ $loop->index }}" style="cursor:pointer;" onclick="openImageModal('qawsAlMatarGallery', {{ $loop->index }})">
        </div>
    @endforeach
    @if($galleryImages->count() < 4)
        @for($i = $galleryImages->count(); $i < 4; $i++)
            <div class="col-6 col-md-3">
                <div class="ehed-grid-img d-flex align-items-center justify-content-center" style="background:#f5f5f5;">
                    <span class="text-muted">No image</span>
                </div>
            </div>
        @endfor
    @endif
</div>
@endif

{{-- ========== PROMO: CAROUSEL + 2 PRODUCT IMAGES ========== --}}
<div class="ehed-promo">
    <div class="ehed-promo__row">
        {{-- Carousel: spans 2 of 4 columns, both rows on desktop --}}
        <div class="ehed-promo__carousel-col">
            <div class="ehed-promo__carousel-wrap">
                <div id="promoCarouselEhed" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner h-100">
                        <div class="carousel-item active h-100 position-relative">
                            <img src="{{ asset('assets/f_assets/image/ehed/male_ehed.png') }}" alt="Promotional Banner 1">
                            <div class="discover-button-overlay position-absolute bottom-0 start-50 translate-middle-x w-100 text-center">
                                <x-shop-now :href="url('/collections/online-shopping-store?page=1&tags=ehed&use_defaults=0')" class="btn discover-btn" label="Shop Now" />
                            </div>
                        </div>
                        <div class="carousel-item h-100 position-relative">
                            <img src="{{ asset('assets/f_assets/image/ehed/female_ehed.png') }}" alt="Promotional Banner 2">
                            <div class="discover-button-overlay position-absolute bottom-0 start-50 translate-middle-x w-100 text-center">
                                <x-shop-now :href="url('/collections/online-shopping-store?page=1&tags=ehed&use_defaults=0')" class="btn discover-btn" label="Shop Now" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Product tiles: each is a direct grid child (1 col each) --}}
        @if(isset($productImages) && $productImages->count() > 0)
            @foreach($productImages->take(2) as $index => $image)
                @php $img = $image->image ?? null; @endphp
                <a href="#" class="ehed-promo__tile">
                    @if($img)
                        <img src="{{ asset($img) }}" alt="Product {{ $index + 1 }}">
                    @else
                        <div style="width:100%;height:100%;background:#f5f5f5;display:flex;align-items:center;justify-content:center;">
                            <span class="text-muted">No image</span>
                        </div>
                    @endif
                </a>
            @endforeach
            @if($productImages->count() < 2)
                @for($i = $productImages->count(); $i < 2; $i++)
                    <a href="#" class="ehed-promo__tile">
                        <div style="width:100%;height:100%;background:#f5f5f5;display:flex;align-items:center;justify-content:center;">
                            <span class="text-muted">No image</span>
                        </div>
                    </a>
                @endfor
            @endif
        @endif
    </div>
</div>

{{-- ========== BOTTOM GALLERY ROW 1 ========== --}}
@if(isset($bottomImages) && $bottomImages->count() > 0)
<div class="ehed-grid" id="bottomGallery">
    @foreach($bottomImages as $index => $image)
        <div class="col-6 col-md-3">
            <img src="{{ asset($image->image) }}" class="img-fluid ehed-grid-img" alt="Ehed Gallery Image" data-gallery="bottomGallery" data-index="{{ $loop->index }}" style="cursor:pointer;" onclick="openImageModal('bottomGallery', {{ $loop->index }})">
        </div>
    @endforeach
    @if($bottomImages->count() < 4)
        @for($i = $bottomImages->count(); $i < 4; $i++)
            <div class="col-6 col-md-3">
                <div class="ehed-grid-img d-flex align-items-center justify-content-center" style="background:#f5f5f5;">
                    <span class="text-muted">No image</span>
                </div>
            </div>
        @endfor
    @endif
</div>
@endif

{{-- ========== BOTTOM GALLERY ROW 2 ========== --}}
@if(isset($bottomImagesRow2) && $bottomImagesRow2->count() > 0)
<div class="ehed-grid" id="bottomGalleryRow2">
    @foreach($bottomImagesRow2 as $index => $image)
        <div class="col-6 col-md-3">
            <img src="{{ asset($image->image) }}" class="img-fluid ehed-grid-img" alt="Ehed Gallery Image" data-gallery="bottomGalleryRow2" data-index="{{ $loop->index }}" style="cursor:pointer;" onclick="openImageModal('bottomGalleryRow2', {{ $loop->index }})">
        </div>
    @endforeach
    @if($bottomImagesRow2->count() < 4)
        @for($i = $bottomImagesRow2->count(); $i < 4; $i++)
            <div class="col-6 col-md-3">
                <div class="ehed-grid-img d-flex align-items-center justify-content-center" style="background:#f5f5f5;">
                    <span class="text-muted">No image</span>
                </div>
            </div>
        @endfor
    @endif
</div>
@endif
</div>

{{-- ========== SHOP NOW ========== --}}
<div class="ehed-shop-spacing">
    <x-shop-now :href="url('/collections/online-shopping-store?page=1&tags=ehed&use_defaults=0')" class="btn border btn-outline-dark px-5 py-2" />
</div>

@include('public.partials.image-gallery-modal')
@endsection
