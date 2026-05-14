@extends('public.layouts.header_latest')

@section('content')
    <!-- Desktop Video Banner (match gehnawa.blade structure) -->
    <section class="sectionOne d-flex align-items-end justify-content-center text-center p-5 d-md-block d-none" style="position: relative; min-height: 500px; overflow: hidden;">
        <video autoplay loop muted playsinline style="position: absolute; left: 0; top: 0; width: 100%; height: 100%; object-fit: cover; z-index: 0;">
            <source src="{{ asset('assets/f_assets/image/Gehwana/Gehnawa Banner 2nd Dekstop View.mp4') }}" type="video/mp4">
            Your browser does not support the video tag.
        </video>
    </section>
    <!-- Mobile Video Banner -->
    <section class="d-md-none" style="position: relative; height: 110vh; overflow: hidden;">
        <video autoplay loop muted playsinline style="position: absolute; left: 0; top: 0; width: 100%; height: 100%; object-fit: cover; z-index: 0;">
            <source src="{{ asset('assets/f_assets/image/Gehnawa Banner Mob View.mp4') }}" type="video/mp4">
            Your browser does not support the video tag.
        </video>
    </section>

    <section>
        <div class="container py-5">
            <h4 class="text-center text-uppercase mb-4">Gehnawa Collection</h4>
            <div class="row mx-auto my-auto justify-content-center g-2 gy-3 onlineStore">
                @foreach ($products as $product)
                    <div class="col-md-3">
                        @include('public.partials.product-card', ['product' => $product])
                    </div>
                @endforeach
                @if($products->count() === 0)
                    <div class="col-12">
                        <div class="text-center py-5 text-muted">No products available.</div>
                    </div>
                @endif
            </div>

            @if($products->count() > 0)
            <div class="text-center py-4">
                <div style="font-size: 1rem; letter-spacing: 0.2em; margin-bottom: 1.5rem;">
                    SHOWING {{ $products->count() + ($products->perPage() * ($products->currentPage() - 1)) }} OF {{ $products->total() }} PRODUCTS
                </div>
                @if($products->currentPage() < $products->lastPage())
                    <a class="btn border btn-outline-dark px-4 py-2" href="{{ request()->fullUrlWithQuery(['page' => $products->currentPage() + 1]) }}">LOAD MORE</a>
                @endif
            </div>
            @endif
        </div>
    </section>
@endsection


