@extends('public.layouts.header_latest')

@section('content')

@if(isset($subcategory) && $subcategory->banner_url)
@php
    $bannerUrl = $subcategory->banner_url;
    $bannerIsVideo = Str::endsWith(strtolower($bannerUrl), ['.mp4', '.webm', '.ogg']);
    $bannerAlt = ($subcategory->name ?? 'Navratan collection') . ' banner';
    $mobileBannerUrl = 'assets/f_assets/image/watches mobile view/fm_new_mobile.jpg';
@endphp

<!-- DESKTOP -->
<section class="sectionOne d-md-block d-none">
    @if($bannerIsVideo)
        <video autoplay loop muted playsinline>
            <source
                src="{{ asset($bannerUrl) }}"
                type="video/{{ strtolower(pathinfo($bannerUrl, PATHINFO_EXTENSION)) }}"
            >
            Your browser does not support the video tag.
        </video>
    @else
        <img src="{{ asset($bannerUrl) }}" alt="{{ $bannerAlt }}">
    @endif
</section>

<!-- MOBILE -->
<section class="sectionMobile d-md-none">
    <img src="{{ asset($mobileBannerUrl) }}" alt="{{ $bannerAlt }}">
</section>

@endif

<style>
html, body{
    margin: 0;
    padding: 0;
}

/* remove extra white space from header */
header,
.main-header,
.navbar,
.header-wrapper,
.top-header{
    margin: 0 !important;
    padding-top: 0 !important;
    padding-bottom: 0 !important;
}

/* remove container spacing */
header .container,
header .row,
header .col,
.navbar .container,
.navbar .row{
    margin-top: 0 !important;
    margin-bottom: 0 !important;
    padding-top: 0 !important;
    padding-bottom: 0 !important;
}

/* responsive banner wrapper */
.sectionOne,
.sectionMobile{
    position: relative;
    width: 100%;
    height: auto;
    overflow: hidden;
    margin: 0 !important;
    padding: 0 !important;
}

/* responsive video - no crop */
.sectionOne img,
.sectionMobile img,
.sectionOne video,
.sectionMobile video{
    width: 100%;
    height: auto;
    display: block;
    object-fit: contain;
    position: relative;
}

/* remove unwanted top gap */
.sectionOne,
.sectionMobile,
section{
    margin-top: 0 !important;
}
</style>
<style>
    .triangle-text{
text-align:center;
line-height:1.6;
font-size:20px;
font-weight:400;
}

.triangle-text span{
display:block;
margin:auto;
}

.triangle-text span:nth-child(1){width:100%;}
.triangle-text span:nth-child(2){width:85%;}
.triangle-text span:nth-child(3){width:70%;}
.triangle-text span:nth-child(4){width:55%;}
.triangle-text span:nth-child(5){width:70%;}
.triangle-text span:nth-child(6){width:85%;}
.triangle-text span:nth-child(7){width:100%;}
</style>
    <section>
        <div class="container py-5">
            <div class="text-center my-4">
                <h4 class="text-uppercase mb-2">Discover Our Collection</h4>   <p class="triangle-text">
    <span>A Heritage Bridal Jewellery Collection
    as timeless as the art
    of jewel making
    itself.</span>
    <span>Traditionally crafted with
    “Nau Ratans” or
    “Nine Gems”</span>
</p>
            </div>
            

            <div class="row g-3 pt-4">


                <div class="col-md-4">
                    @php
                        $navratanImages = [];
                        for ($i = 1; $i <= 3; $i++) {
                            $navratanImages[] = [
                                'src' => asset('assets/f_assets/image/Navratan/Navratan/' . $i . '.png'),
                                'alt' => 'navratan-' . $i,
                            ];
                        }
                    @endphp
                    @include('public.partials.carousel', [
                        'id' => 'navratanCarousel-1',
                        'images' => $navratanImages,
                    ])
                </div>
                <div class="col-md-4">
                    @php
                        $navratanRedImages = [];
                        for ($i = 1; $i <= 5; $i++) {
                            $navratanRedImages[] = [
                                'src' => asset('assets/f_assets/image/Navratan/Red/' . $i . '.png'),
                                'alt' => 'navratan-red-' . $i,
                            ];
                        }
                    @endphp
                    @include('public.partials.carousel', [
                        'id' => 'navratanCarousel-2',
                        'images' => $navratanRedImages,
                    ])
                </div>
                <div class="col-md-4">
                    @php
                        $navratanBlueImages = [];
                        for ($i = 1; $i <= 4; $i++) {
                            $navratanBlueImages[] = [
                                'src' => asset('assets/f_assets/image/Navratan/Navratan Blue/' . $i . '.png'),
                                'alt' => 'navratan-blue-' . $i,
                            ];
                        }
                    @endphp
                    @include('public.partials.carousel', [
                        'id' => 'navratanCarousel-3',
                        'images' => $navratanBlueImages,
                    ])
                </div>

            </div>

            <!-- Row 2: 3 carousels -->
            <div class="row g-3 pt-4">

             <div class="col-md-4">
                    @php
                        $navratanLook3 = [];
                        for ($i = 1; $i <= 4; $i++) {
                            $navratanLook3[] = [
                                'src' => asset('assets/f_assets/image/Navratan/White/' . $i . '.png'),
                                'alt' => 'navratan-3-' . $i,
                            ];
                        }
                    @endphp
                    @include('public.partials.carousel', [
                        'id' => 'navratanCarousel-4',
                        'images' => $navratanLook3,
                    ])
                </div>

                <div class="col-md-4 ">
                    @php
                        $navratanLook4 = [];
                        for ($i = 1; $i <= 4; $i++) {
                            $navratanLook4[] = [
                                'src' => asset('assets/f_assets/image/Navratan/Sadia faisal/' . $i . '.jpg'),
                                'alt' => 'navratan-4-' . $i,
                            ];
                        }
                    @endphp
                    @include('public.partials.carousel', [
                        'id' => 'navratanCarousel-5',
                        'images' => $navratanLook4,
                    ])
                </div>
                <div class="col-md-4">
                    @php
                        $navratanLook5 = [];
                        for ($i = 1; $i <= 4; $i++) {
                            $navratanLook5[] = [
                                'src' => asset('assets/f_assets/image/Navratan/Pink/' . $i . '.png'),
                                'alt' => 'navratan-5-' . $i,
                            ];
                        }
                    @endphp
                    @include('public.partials.carousel', [
                        'id' => 'navratanCarousel-6',
                        'images' => $navratanLook5,
                    ])
                </div>
            </div>
            <div class="row">
            <style>
                    .app-btn {
                        padding: 6px 16px !important;
                    }
                    .m-1{
                        margin:2.1rem !important;
                    }
            </style>
            <div class="text-center">
                <a class="m-1 app-btn btn border btn-outline-dark px-2 py-1" href="{{ route('contact-us')  }}">BOOK AN APPOINTMENT</a>
            </div>
            <!-- <div class="col-md-6 text-center">
                <a class="m-5 btn border btn-outline-dark px-5 py-2" style="padding: 10px 100px !important" href="{{ route('subcategory', ['subcategory' => 'gohar'])  }}">SHOP NOW</a>
            </div> -->
        </div>

            @include('public.partials.image-gallery-modal')

            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    for (let i = 1; i <= 6; i++) {
                        const el = document.getElementById('navratanCarousel-' + i);
                        if (el) new bootstrap.Carousel(el, { interval: false, wrap: true, touch: true });
                    }
                });
            </script>
        </div>
    </section>
@endsection
