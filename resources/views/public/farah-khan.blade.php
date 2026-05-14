@extends('public.layouts.header_latest')

@section('content')
<section class="farahKhanBannerSection">
    <div id="farahKhanSlider" class="carousel slide" data-bs-ride="carousel" data-bs-pause="false">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="{{ asset('assets/f_assets/image/farah-khan-banners/Amaira_2.webp') }}" class="d-block w-100" style="object-fit:cover; height:110vh;" alt="Farah Khan Banner 1">
            </div>
            <div class="carousel-item">
                <img src="{{ asset('assets/f_assets/image/farah-khan-banners/AMAIRA_7.webp') }}" class="d-block w-100" style="object-fit:cover; height:110vh;" alt="Farah Khan Banner 2">
            </div>
            <div class="carousel-item">
                <img src="{{ asset('assets/f_assets/image/farah-khan-banners/AMAIRA3.webp') }}" class="d-block w-100" style="object-fit:cover; height:110vh;" alt="Farah Khan Banner 3">
            </div>
            <div class="carousel-item">
                <img src="{{ asset('assets/f_assets/image/farah-khan-banners/AYYAT_2.webp') }}" class="d-block w-100" style="object-fit:cover; height:110vh;" alt="Farah Khan Banner 4">
            </div>
            <div class="carousel-item">
                <img src="{{ asset('assets/f_assets/image/farah-khan-banners/Becharmed_2.webp') }}" class="d-block w-100" style="object-fit:cover; height:110vh;" alt="Farah Khan Banner 5">
            </div>
            <div class="carousel-item">
                <img src="{{ asset('assets/f_assets/image/farah-khan-banners/Becharmed.webp') }}" class="d-block w-100" style="object-fit:cover; height:110vh;" alt="Farah Khan Banner 6">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#farahKhanSlider" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#farahKhanSlider" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</section>
<section class="onlineStore py-5">
<div class="row mx-auto my-auto justify-content-center g-2 gy-3">
        @foreach ($products as $key => $product)
            <div class="col-md-3">
                <div class="card">
                    <div class="card-img">
                        <div id="carouselJewellery{{ $product->slug }}" class="carousel slide">

    @if(isset($product['images']) && count($product['images']) > 0)

        {{-- Indicators --}}
        @if(count($product['images']) > 1)
        <div class="carousel-indicators">
            @foreach ($product['images'] as $imgIndex => $img)
                <button type="button"
                    data-bs-target="#carouselJewellery{{ $product->slug }}"
                    data-bs-slide-to="{{ $imgIndex }}"
                    class="{{ $imgIndex === 0 ? 'active bg-dark' : 'bg-dark' }}"
                    @if($imgIndex === 0) aria-current="true" @endif
                    aria-label="Slide {{ $imgIndex + 1 }}">
                </button>
            @endforeach
        </div>
        @endif

        {{-- Images --}}
        <div class="carousel-inner">
            @foreach ($product['images'] as $imgIndex => $img)
                <div class="carousel-item{{ $imgIndex === 0 ? ' active' : '' }}">
                    <img src="{{ url('/') }}/{{ $img['image'] }}"
                         class="img-fluid d-block w-100"
                         alt="{{ $product->name }}">
                </div>
            @endforeach
        </div>

        {{-- Arrows --}}
        @if(count($product['images']) > 1)
        <button class="carousel-control-prev" type="button"
            data-bs-target="#carouselJewellery{{ $product->slug }}"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </button>

        <button class="carousel-control-next" type="button"
            data-bs-target="#carouselJewellery{{ $product->slug }}"
            data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
        </button>
        @endif

    @else

        {{-- Single Image --}}
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="{{ url('/') }}/{{ $product->image }}"
                     class="img-fluid d-block w-100"
                     alt="{{ $product->name }}">
            </div>
        </div>

    @endif

    {{-- FULL CLICKABLE LINK --}}
    <a href="{{ route('product.details', $product->slug) }}"
       class="stretched-link"></a>

</div>
                    </div>
                    <div class="card-img-overlay">New</div>
                    <div class="card-body text-center">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="card-text">
                            @if($product->show_price)
                                @php
                                    $priceBreakdown = $product->getDisplayPrices();
                                @endphp
                                @include('public.partials.currency-amount', [
                                    'pkr' => $priceBreakdown['pkr'],
                                    'aed' => $priceBreakdown['aed'],
                                    'pkrDecimals' => 0,
                                    'aedDecimals' => 2,
                                    'class' => 'fw-semibold',
                                ])
                            @endif
                        </p>
                        <a href="{{ route('product.details', $product->slug) }}"
                            class="btn text-white bg-black addToCart">Discover More</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</section>

@endsection