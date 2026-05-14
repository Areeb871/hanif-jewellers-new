@extends('public.layouts.header_latest')

@section('content')

{{-- Optional: remove top padding for specific slugs --}}
@if(isset($subcategory) && in_array(strtolower($subcategory->slug ?? ''), ['breathtaking','valentine-jewels','haphazard']))
    <style>
        .py-5 { padding-top: 0rem !important; }
    </style>
@endif

@php
    $banner = $subcategory->banner_url ?? null;

    $videoExtensions = ['mp4', 'webm', 'ogg'];
    $imageExtensions = ['jpg', 'jpeg', 'png', 'webp'];

    // desktop ext (from banner_url)
    $ext = $banner ? strtolower(pathinfo($banner, PATHINFO_EXTENSION)) : null;

    // ---- MOBILE banner mapping (can be video OR image) ----
    $mobileBanner = $banner;

    if(isset($subcategory) && !empty($subcategory->slug)) {
        switch (strtolower($subcategory->slug)) {
            case 'breathtaking':
                $mobileBanner = 'assets/f_assets/image/Breathtaking Mobile Size Banner.mp4';
                break;
            case 'marchisio':
                $mobileBanner = 'assets/f_assets/image/mid_banner_mobile.mp4';
                break;
            case 'selene':
                $mobileBanner = 'assets/f_assets/image/selene_mobile.mp4';
                break;
            case 'navratan':
                $mobileBanner = 'assets/f_assets/image/Navratan Banner Mob View.mp4';
                break;
            case 'taj-mahal':
                $mobileBanner = 'assets/f_assets/image/Taj Mahal Mob banner.mp4';
                break;
            case 'mona-lisa':
                $mobileBanner = 'assets/f_assets/image/Mona Lisa Mob View.mp4';
                break;
            case 'jewelphabets':
                $mobileBanner = 'assets/f_assets/image/Web Banner Mobile size.mp4';
                break;
            case 'ehed':
                $mobileBanner = 'assets/f_assets/image/Ehad Mob Banner Video.mp4';
                break;
            case 'gulposh':
                $mobileBanner = 'assets/f_assets/image/gulposh/mobile-view.mp4';
                break;
            case 'pure-lock':
            case 'haphazard':
                $mobileBanner = 'assets/f_assets/image/pure-lock/mobile-view.mp4';
                break;
            case 'favre-leuba':
                $mobileBanner = 'assets/f_assets/image/watches mobile view/favre_luba_mobile.mp4';
                break;
            case 'corum':
                $mobileBanner = 'assets/f_assets/image/watches mobile view/corum_mobile_view.mp4';
                break;
            case 'perrelet':
                $mobileBanner = 'assets/f_assets/image/watches mobile view/perrelet_mobile_view.mp4';
                break;

            // ✅ image on mobile
            case 'nagar':
                $mobileBanner = 'assets/f_assets/image/nagar.jpg';
                break;
        }
    }

    // mobile ext (from mobileBanner)
    $mobileExt = $mobileBanner ? strtolower(pathinfo($mobileBanner, PATHINFO_EXTENSION)) : null;

    // Validity checks
    $isDesktopVideo = $ext && in_array($ext, $videoExtensions);
    $isDesktopImage = $ext && in_array($ext, $imageExtensions);

    $isMobileVideo = $mobileExt && in_array($mobileExt, $videoExtensions);
    $isMobileImage = $mobileExt && in_array($mobileExt, $imageExtensions);

    // show section only if at least desktop is valid (video/image)
    $showSection = $banner && ($isDesktopVideo || $isDesktopImage);
@endphp

@if($showSection)
<section class="gehnawaSection p-0 position-relative">

    {{-- ================= DESKTOP ================= --}}
    @if($isDesktopVideo)
        <video
            autoplay
            loop
            muted
            playsinline
            class="video-desktop d-none d-md-block"
            style="width:100%; height:120vh; object-fit:cover;">
            <source src="{{ asset($banner) }}" type="video/{{ $ext }}">
            Your browser does not support the video tag.
        </video>
    @elseif($isDesktopImage)
        <div
            class="banner-desktop d-none d-md-block"
            style="
                width:100%;
                height:120vh;
                background-image:url('{{ asset($banner) }}');
                background-size:cover;
                background-position:center;
                background-repeat:no-repeat;
            ">
        </div>
    @endif


    {{-- ================= MOBILE ================= --}}
    @if($isMobileVideo)
        <video
            autoplay
            loop
            muted
            playsinline
            class="video-mobile d-block d-md-none"
            style="width:100%; height:120vh; object-fit:cover;">
            <source src="{{ asset($mobileBanner) }}" type="video/{{ $mobileExt }}">
            Your browser does not support the video tag.
        </video>
     @elseif($isMobileImage)
    <div
        class="fm-hero__image fm-hero__mobile banner-mobile d-block d-md-none"
        style="
            width:100%;
            height:calc(120vh - 72px);
            margin-top:72px;
            background-image:url('{{ asset($mobileBanner) }}');
            background-size:cover;
            background-position:top center;
            background-repeat:no-repeat;
        ">
    </div>
        @else
        {{-- Fallback: if mobile mapping is missing/invalid, show desktop banner on mobile as image/video --}}
        @if($isDesktopVideo)
            <video
                autoplay
                loop
                muted
                playsinline
                class="video-mobile d-block d-md-none"
                style="width:100%; height:120vh; object-fit:cover;">
                <source src="{{ asset($banner) }}" type="video/{{ $ext }}">
                Your browser does not support the video tag.
            </video>
        @elseif($isDesktopImage)
            <div
                class="banner-mobile d-block d-md-none"
                style="
                    width:100%;
                    height:120vh;
                    background-image:url('{{ asset($banner) }}');
                    background-size:cover;
                    background-position:center;
                    background-repeat:no-repeat;
                ">
            </div>
        @endif
    @endif

</section>
@endif



    {{-- <section class="gehnawaSection">

    </section> --}}

    @if(isset($subcategory) && (strtolower($subcategory->slug ?? '') === 'breathtaking' || strtolower($subcategory->slug ?? '') === 'valentine-jewels' || strtolower($subcategory->slug ?? '') === 'eid-par-sony-ki-choriyan' || strtolower($subcategory->slug ?? '') === 'winter-jewels' || strtolower($subcategory->slug ?? '') === 'heritage' || strtolower($subcategory->slug ?? '') === 'mona-lisa' || strtolower($subcategory->slug ?? '') === 'jewelphabets' || strtolower($subcategory->slug ?? '') === 'selene' || strtolower($subcategory->slug ?? '') === 'haphazard'))
    <div class="container my-5">
        <h4 class="text-center text-uppercase m-0">Discover Our Collection</h4>
    </div>
    @endif
    <section>
        <div class="py-5 @if(isset($subcategory) && (strtolower($subcategory->slug ?? '') === 'breathtaking' || strtolower($subcategory->slug ?? '') === 'valentine-jewels' || strtolower($subcategory->slug ?? '') === 'eid-par-sony-ki-choriyan' || strtolower($subcategory->slug ?? '') === 'winter-jewels' || strtolower($subcategory->slug ?? '') === 'heritage' || strtolower($subcategory->slug ?? '') === 'mona-lisa' || strtolower($subcategory->slug ?? '') === 'jewelphabets' || strtolower($subcategory->slug ?? '') === 'selene'|| strtolower($subcategory->slug ?? '') === 'haphazard')) pt-0 @endif">
            
            <!-- <div class="row onlineStore g-3 pt-3">
                @foreach($products->slice(0, 4) as $product)
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-img">
                            <a href="{{ route('product.details', $product->slug) }}">
                                <img src="{{ $product->image ? asset($product->image) : asset('default.jpg')}}"
                                    class="img-fluid">
                            </a>
                        </div>

                        <div class="card-body text-center">
                            <h5 class="card-title pb-3">{{$product->name}}</h5>
                            @if($product->show_price)
                                <p class="card-text"> <b>PKR {{ $product->price }} </b></p>
                            @endif
                            <a href="{{ route('product.details', $product->slug) }}" class="btn text-white bg-black addToCart">
                                Discover More
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div> -->
            <!-- <div class="row onlineStore align-items-center justify-content-center g-3 pt-3">
                <div class="col-md-6">
                    <a href="#" target="_blank">
                        <img src="https://www.hanifjewellers.com/cdn/shop/files/Gehnawa_Collection_gold_jewellery_1728x1728.jpg?v=1739372205"
                            alt="" class="img-fluid">
                    </a>
                </div>
                <div class="col-md-6">
                    <div class="row g-3">
                        @foreach($products->slice(4, 4) as $product)
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-img">
                                    <a href="{{ route('product.details', $product->slug) }}">
                                        <img src="{{ $product->image ? asset($product->image) : asset('default.jpg')}}"
                                            class="img-fluid">
                                    </a>
                                </div>

                                <div class="card-body text-center">
                                    <h5 class="card-title pb-3">{{$product->name}}</h5>
                                    @if($product->show_price)
                                        <p class="card-text"> <b>PKR {{ $product->price }} </b></p>
                                    @endif
                                    <a href="{{ route('product.details', $product->slug) }}" class="btn text-white bg-black addToCart">
                                        Discover More
                                    </a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div> -->
            <!-- <div class="row onlineStore g-3 pt-3">
                @foreach($products->slice(8, 4) as $product)
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-img">
                            <a href="{{ route('product.details', $product->slug) }}">
                                <img src="{{ $product->image ? asset($product->image) : asset('default.jpg')}}"
                                    class="img-fluid">
                            </a>
                        </div>

                        <div class="card-body text-center">
                            <h5 class="card-title pb-3">{{$product->name}}</h5>
                            @if($product->show_price)
                                <p class="card-text"> <b>PKR {{ $product->price }} </b></p>
                            @endif
                            <a href="{{ route('product.details', $product->slug) }}" class="btn text-white bg-black addToCart">
                                Discover More
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div> -->
            
            <section class="onlineStore">
                <div class="row mx-auto my-auto justify-content-center g-2 gy-3">
                    @foreach ($products as $key => $product)
                        <div class="col-md-3">
                            @include('public.partials.product-card', ['product' => $product])
                        </div>
                    @endforeach
                </div>
            </section>

            @php
                $slugLower = isset($subcategory) ? strtolower($subcategory->slug ?? '') : '';
                $nameLower = isset($subcategory) ? strtolower($subcategory->name ?? '') : '';
                $hideLoadMore = in_array($slugLower, ['breathtaking', 'qaws-al-matar','selene','eid-par-sony-ki-choriyan','navratan','winter-jewels','heritage']) || in_array($nameLower, ['breathtaking', 'qaws-al-matar','selene','eid-par-sony-ki-choriyan','navratan','winter-jewels','heritage','nagar']);
            @endphp
            <div class="text-center py-4" @if($hideLoadMore) style="display:none;" @endif>
                <div style="font-size: 1rem; letter-spacing: 0.2em; margin-bottom: 1.5rem;">
                    SHOWING {{ $products->count() + ($products->perPage() * ($products->currentPage() - 1)) }} OF {{ $products->total() }} PRODUCTS
                </div>
                <button id="loadMoreBtn"
                        style="background: #e3e4e5; border: none; color: #222; font-size: 0.8rem; letter-spacing: 0.15em; padding: 0.8rem 2rem; border-radius: 8px; font-family: inherit; font-weight: 400; box-shadow: none; transition: background 0.2s;"
                        data-page="2"
                        data-last-page="{{ $products->lastPage() }}"
                        @if($hideLoadMore) style="display:none;" @elseif($products->currentPage() == $products->lastPage()) style="display:none;" @endif>
                    LOAD MORE
                </button>
            </div>
            @if(isset($subcategory) && (strtolower($subcategory->slug ?? '') === 'breathtaking'))
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
    @endif

            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const loadMoreBtn = document.getElementById('loadMoreBtn');
                    if (!loadMoreBtn) return;

                    loadMoreBtn.addEventListener('click', function() {
                        const btn = this;
                        const nextPage = btn.getAttribute('data-page');
                        const lastPage = btn.getAttribute('data-last-page');
                        btn.disabled = true;
                        btn.textContent = 'Loading...';

                        fetch(`{{ request()->url() }}?page=${nextPage}`, {
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest'
                            }
                        })
                        .then(response => response.text())
                        .then(html => {
                            // Extract only the product cards from the returned HTML
                            const parser = new DOMParser();
                            const doc = parser.parseFromString(html, 'text/html');
                            const newCards = doc.querySelectorAll('.onlineStore .row > .col-md-3');
                            const row = document.querySelector('.onlineStore .row');
                            newCards.forEach(card => row.appendChild(card));

                            // Update the count display
                            const totalShown = row.querySelectorAll('.col-md-3').length;
                            document.querySelector('.text-center > div').textContent = `SHOWING ${totalShown} OF {{ $products->total() }} PRODUCTS`;

                            // Update button state
                            let newPage = parseInt(nextPage) + 1;
                            btn.setAttribute('data-page', newPage);
                            btn.disabled = false;
                            btn.textContent = 'LOAD MORE';
                            if (parseInt(nextPage) >= parseInt(lastPage)) {
                                btn.style.display = 'none';
                            }
                        })
                        .catch(() => {
                            btn.disabled = false;
                            btn.textContent = 'LOAD MORE';
                        });
                    });
                });
            </script>
        </div>
    </section>
@endsection
