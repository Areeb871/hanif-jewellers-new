@extends('public.layouts.header_latest')

@section('content')
    <section class="ehadBannerSection" style="background: url('{{ asset('assets/f_assets/image/Banner-ehad.jpg') }}') center center/cover no-repeat; min-height: 400px;">
    </section>
    <section class="container">
        <h4 class="text-center py-3 mt-4 text-uppercase">Discover Our Collection</h4>

        <div class="row g-3 mb-3">
            <div class="col-md-4">
                <img src="{{ asset('assets/f_assets/image/jwel1.jpg') }}" class="img-fluid" alt="Ehad Collection">
            </div>
            <div class="col-md-4 justify-content-center d-flex align-items-center">
                 <img src="{{ asset('assets/f_assets/image/jwel1.jpg') }}" class="img-fluid" alt="Ehad Collection">
            </div>
             <div class="col-md-4 justify-content-center d-flex align-items-center">
                 <img src="{{ asset('assets/f_assets/image/jwel1.jpg') }}" class="img-fluid" alt="Ehad Collection">
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 text-center">
                <x-book-appointment class="m-5" />
            </div>
            <div class="col-md-6 text-center">
                <x-shop-now :href="route('subcategory', ['subcategory' => 'timeless-jewels'])" class="m-5 btn border btn-outline-dark px-5 py-2" style="padding: 10px 100px !important" />
            </div>
        </div>
        <div class="text-center my-5">
          <img src="{{ asset('assets/f_assets/image/Hasht_Sapphire_White_Gold_Pendant_3_1500X2100.png') }}"
                        class="img-fluid my-5" alt="Ehad Collection">
        </div>
        <div class="row g-3 mb-3">
            <div class="col-md-6">
                <img src="{{ asset('assets/f_assets/image/jwel1.jpg') }}" class="img-fluid" alt="Ehad Collection">
            </div>
            <div class="col-md-6 justify-content-center d-flex align-items-center">
                 <img src="{{ asset('assets/f_assets/image/jwel1.jpg') }}" class="img-fluid" alt="Ehad Collection">
            </div>
        </div>
         <div>
            <p class="px-5 m-0">
                Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quibusdam hic commodi
                provident dolor architecto explicabo, quasi cumque ea minima aspernatur pariatur odio voluptates
                doloribus accusamus aperiam numquam saepe nisi eum.
            </p>
        </div>
    </section>
@endsection
