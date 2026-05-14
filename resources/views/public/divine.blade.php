@extends('public.layouts.header_latest')

@section('content')
    <section class="ehadBannerSection" style="background: url('{{ asset('assets/f_assets/image/Banner-ehad.jpg') }}') center center/cover no-repeat; min-height: 400px;">
    </section>

    <section class="container">
        <h4 class="text-center py-3 mt-4 text-uppercase">Discover Our Collection</h4>
        <div class="row g-3 mb-3">
            <div class="col-md-6">
                <img src="{{ asset('assets/f_assets/image/04_2d7e3a4a-2ce6-4354-8c67-4b41a8251be0_1500X2100.jpg') }}"
                    class="img-fluid" alt="Ehad Collection">
            </div>
            <div class="col-md-6">
                <img src="{{ asset('assets/f_assets/image/01_f2a57c12-3e3b-46a1-9977-b7a96fa86ffd_1500X2100.jpg') }}"
                    class="img-fluid" alt="Ehad Collection">
            </div>
        </div>
        <div class="row g-3 mb-3 justify-content-center d-flex align-items-center">
            <div class="col-md-6">
                <p class="p-5 text-center">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quibusdam hic commodi
                    provident dolor architecto explicabo, quasi cumque ea minima aspernatur pariatur odio voluptates
                    doloribus accusamus aperiam numquam saepe nisi eum.</p>
            </div>
        </div>
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
                <a class="m-5 btn border btn-outline-dark px-5 py-2" style="padding: 10px 70px !important" href="{{ route('contact-us')  }}">BOOK AN APPOINTMENT</a>
            </div>
            <div class="col-md-6 text-center">
                <a class="m-5 btn border btn-outline-dark px-5 py-2" style="padding: 10px 100px !important" href="{{ route('subcategory', ['subcategory' => 'divine'])  }}">SHOP NOW</a>
            </div>
        </div>
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
    </section>
@endsection
