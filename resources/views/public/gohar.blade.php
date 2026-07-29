@extends('public.layouts.header_new')

@section('content')
  <!-- DESKTOP -->
<div class="fullBanner d-none d-md-block">
    <video autoplay loop muted playsinline class="fullBannerMedia">
        <source src="{{ asset('assets/f_assets/image/Gohar Banner Desktop.mp4') }}" type="video/mp4">
        Your browser does not support the video tag.
    </video>
</div>

<!-- MOBILE -->
<div class="fullBanner d-md-none">
    <video autoplay loop muted playsinline class="fullBannerMedia">
        <source src="{{ asset('assets/f_assets/image/Gohar_Mob_banner.mp4') }}" type="video/mp4">
        Your browser does not support the video tag.
    </video>
</div>

<style>
html, body{
    margin: 0;
    padding: 0;
}

/* FULL WIDTH (NO GAP) */
.fullBanner{
    width: 100vw;
    margin-left: calc(50% - 50vw);
    margin-right: calc(50% - 50vw);
    overflow: hidden;
    line-height: 0;
    padding: 0; /* 👈 ensure no gap */
}

/* VIDEO */
.fullBannerMedia{
    width: 100%;
    height: auto;        /* 👈 responsive */
    display: block;
    object-fit: contain; /* 👈 no crop */
}
</style>

    <section class="container pt-4 pt-md-5">
        <div class="row g-3 mb-3">
            <div class="col-md-6">
                <img src="{{ asset('assets/f_assets/image/colection-design-images/Gohar_Square_img_1.jpg') }}" class="img-fluid" alt="gohar Collection" style="cursor: pointer;" onclick="openImageModalForGohar(0)">
            </div>
            <div class="col-md-6 justify-content-center d-flex align-items-center">
                 <img src="{{ asset('assets/f_assets/image/colection-design-images/Gohar_Square_img_2.jpg') }}" class="img-fluid" alt="gohar Collection" style="cursor: pointer;" onclick="openImageModalForGohar(1)">
            </div>
        </div>
        <div class="row g-3 justify-content-center align-items-center">
            <div class="col-md-6 d-flex justify-content-center align-items-center">
                <div class="text-center">
                    <p class="p-4 m-0">
                        Gohar, Treasures From The Depths of The Oceans, an exquisite chapter in the story of Hanif, Pearls that are collected and curated from the rarest and deepest parts of the oceans, Mesmerizing pieces of natural art that adorn you and your collections alike!
                    </p>
                </div>
            </div>
        </div>
        <div class="row pb-4">
            <style>
                    .app-btn {
                        padding: 6px 16px !important;
                    }
            </style>
            <div class="text-center">
                <x-book-appointment class="m-1" />
            </div>
            <!-- <div class="col-md-6 text-center">
                <x-shop-now :href="route('subcategory', ['subcategory' => 'gohar'])" class="m-5 btn border btn-outline-dark px-5 py-2" style="padding: 10px 100px !important" />
            </div> -->
        </div>
    </section>
    @include('public.partials.image-gallery-modal')
    <script>
        // Gohar images array for modal
        const goharImages = [
            "{{ asset('assets/f_assets/image/colection-design-images/Gohar_Square_img_1.jpg') }}",
            "{{ asset('assets/f_assets/image/colection-design-images/Gohar_Square_img_2.jpg') }}"
        ];
        const goharAlts = [
            "Gohar Image 1",
            "Gohar Image 2"
        ];
        function openImageModalForGohar(idx) {
            // Set modal images and alts (must be global, not window-scoped)
            currentModalImages = goharImages;
            currentModalAlts = goharAlts;
            currentModalIndex = idx;
            // Reset zoom and position
            currentZoom = 1;
            currentTranslate = { x: 0, y: 0 };
            targetTranslate = { x: 0, y: 0 };
            velocity = { x: 0, y: 0 };
            if (typeof updateModalImage === 'function') updateModalImage();
            if (typeof updateNavigationButtons === 'function') updateNavigationButtons();
            if (typeof resetZoom === 'function') resetZoom();
            const modal = new bootstrap.Modal(document.getElementById('imageModal'));
            modal.show();
        }
    </script>
@endsection
