@extends('public.layouts.header_latest')

@section('content')
    <!-- <section class="solitaireSection d-flex align-items-center" style="min-height:340px;">
        <div class="">
            <div class="row align-items-center">
                <div class="col-md-5 text-start px-3 px-md-5">
                    <h1 class="fw-bold mb-3">Solitaire Engagement Rings</h1>
                    <p class="mb-0 text-muted" style="font-size:1.1rem;">
                        Classic, sparkling and endlessly symbolic solitaire rings bring sleek style. Explore gemstone and diamond
                        solitaire engagement rings in gold and platinum.
                    </p>
                </div>
                <div class="col-md-7 text-center">
                    <img src="{{ asset('assets/f_assets/image/Soliteir_Banner.png') }}" alt="Solitaire Engagement Rings" class="img-fluid rounded shadow" style="bject-fit:cover;">
                </div>
            </div>
        </div>
    </section> -->
    <section class="sectionOne d-flex align-items-end justify-content-center text-center p-5 d-md-block d-none" style="position: relative; min-height: 500px; overflow: hidden;">
        <video autoplay loop muted playsinline style="position: absolute; left: 0; top: 0; width: 100%; height: 100%; object-fit: cover; z-index: 0;">
            <source src="{{ asset('assets/f_assets/image/solitaire_new_banner.mp4') }}" type="video/mp4">
            Your browser does not support the video tag.
        </video>
    </section>
    <section class="d-md-none" style="position: relative; height: 110vh; overflow: hidden;">
        <video autoplay loop muted playsinline style="position: absolute; left: 0; top: 0; width: 100%; height: 100%; object-fit: cover; z-index: 0;">
            <source src="{{ asset('assets/f_assets/image/sol_mobile.mp4') }}" type="video/mp4">
            Your browser does not support the video tag.
        </video>
    </section>

    <section class="onlineStore py-5">
        <div class="row mx-auto my-auto g-2 gy-3">
            @foreach ($products as $key => $product)
                <div class="col-md-3">
                    @include('public.partials.product-card', ['product' => $product])
                </div>
            @endforeach
        </div>
    </section>
@endsection
