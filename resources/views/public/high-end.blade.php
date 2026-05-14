@extends('public.layouts.header_latest')

@section('content')
    <section class="bovetSection p-5">

    </section>

    <section class="container py-5">
        <video class="desktop-video" playsinline="" autoplay="" loop="" muted=""
            style="max-width: 100%; display: block;">
            <source src="https://cdn.shopify.com/videos/c/o/v/2773abb1067649a5a9f8237beb73da56.mp4">
        </video>
    </section>

    <section>
        <div class="container py-5">
            <h2 class="title text-center">Latest Collection</h2>
            <div class="row g-3">
                <div class="col-md-4">
                    <a href="http://" target="_blank">
                        <img src="{{ asset('assets/f_assets/image/Forevermark_TILE_619bc1db-6fa3-4f3e-8f8e-9fda2a7c0b15_1920x1920.jpg') }}"
                            alt="" class="img-fluid">
                    </a>
                </div>
                <div class="col-md-4">
                    <a href="http://" target="_blank">
                        <img src="{{ asset('assets/f_assets/image/FKFJ_TILE_1920x1920.jpg') }}" alt=""
                            class="img-fluid">
                    </a>
                </div>
                <div class="col-md-4">
                    <a href="http://" target="_blank">
                        <img src="{{ asset('assets/f_assets/image/Forevermark_TILE_619bc1db-6fa3-4f3e-8f8e-9fda2a7c0b15_1920x1920.jpg') }}"
                            alt="" class="img-fluid">
                    </a>
                </div>
            </div>
        </div>
    </section>
    <section>
        <div class="container py-5">

            <div class="row g-4 d-flex align-items-center justify-content-center">
                <div class="col-md-6">
                    <video class="desktop-video" playsinline="" autoplay="" loop="" muted=""
                        style="max-width: 100%; display: block;">
                        <source src="https://cdn.shopify.com/videos/c/o/v/2773abb1067649a5a9f8237beb73da56.mp4">
                    </video>
                </div>
                <div class="col-md-6">
                    <h2 class="title">Latest Collection</h2>
                    <p>
                        Lorem, ipsum dolor sit amet consectetur adipisicing elit. Dolor, autem! Repudiandae officia facilis
                        necessitatibus ipsam odit dolorum ad neque? Asperiores ducimus quidem blanditiis, molestiae officiis
                        provident consequuntur non eligendi eveniet. Lorem, ipsum dolor sit amet consectetur adipisicing
                        elit. Dolor, autem! Repudiandae officia facilis necessitatibus ipsam odit dolorum ad neque?
                        Asperiores ducimus quidem blanditiis, molestiae officiis provident consequuntur non eligendi
                        eveniet.
                    </p>
                </div>
            </div>
        </div>
    </section>
    <section>
        <div class="container py-5">

            <div class="row g-4 d-flex align-items-center justify-content-center">
                <div class="col-md-2"></div>
                <div class="col-md-4">
                    <img src="{{ asset('assets/f_assets/image/Forevermark_TILE_619bc1db-6fa3-4f3e-8f8e-9fda2a7c0b15_1920x1920.jpg') }}"
                        alt="" class="img-fluid">
                </div>
                <div class="col-md-4">
                    <img src="{{ asset('assets/f_assets/image/FKFJ_TILE_1920x1920.jpg') }}"
                        alt="" class="img-fluid high_endImage">
                </div>
            </div>
        </div>
    </section>
@endsection
