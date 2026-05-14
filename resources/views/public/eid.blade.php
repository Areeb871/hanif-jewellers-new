@extends('public.layouts.header_latest')
@section('content')
<style>
/* Remove any container restriction */
.custom-banner {
    width: 100%;
    margin: 0;
    padding: 0;
}

/* Full width image */
.custom-banner-video {
    width: 100%;
    height: auto;
    display: block;
}
/* =======================
   MOBILE STACK
   ======================= */
.mobileStackHero{
  width: 100%;
  background: #fff;
}

.mobileStackImgWrap{
  width: 100%;
  overflow: hidden;
  background: #000;
}

.mobileStackImg{
  width: 100%;
  height: auto;
  display: block;
}
.mobileStackVideo{
  width: 100%;
  height: auto;     /* keeps proportions like image */
  display: block;   /* removes gaps */
}
</style>
<section class="custom-banner d-none d-md-block position-relative">
    <video class="custom-banner-video" autoplay muted loop playsinline>
        <source src="{{ asset('assets/f_assets/image/eid/eid_banner_new.mp4') }}" type="video/mp4">
        Your browser does not support the video tag.
    </video>
</section>
<section class="d-block d-md-none position-relative">
  <div class="mobileStackImgWrap">
    <video class="mobileStackVideo" autoplay muted loop playsinline preload="metadata" poster="{{ asset('assets/f_assets/image/eid/Web Mob Banner.mp4') }}" > <source src="{{ asset('assets/f_assets/image/eid/Web Mob Banner.mp4') }}" type="video/mp4"> </video>
<!-- <img
  class="mobileStackVideo"
  src="{{ asset('assets/f_assets/image/eid/mobile banner.jpg') }}"
  alt="Divine Treasure"
  loading="lazy"
/>
  </div> -->
</section>
 <section class="onlineStore">
                <div class="row mx-auto my-auto justify-content-center g-2 gy-3">
                    @foreach ($firstFour as $key => $product)
                        <div class="col-md-3">
                            @include('public.partials.product-card', ['product' => $product])
                        </div>
                    @endforeach
                </div>
            </section>
<style>
  /* ✅ CONTROL GAP (works at every screen incl. 1500+) */
  .luxury-layout{
    --gap: clamp(14px, 1.2vw, 22px); /* responsive gap but never crazy */
  }

  /* ✅ IMPORTANT: prevent "space-between" gap */
  .luxury-layout .row{
    justify-content: flex-start !important;  /* kills huge middle gap */
    --bs-gutter-x: var(--gap);
    --bs-gutter-y: var(--gap);
  }

  .lux-card{
    width: 100%;
    overflow: hidden;
    border-radius: 0;
    background: #fff;
  }

  /* ✅ Images fill their column width */
  .lux-card img{
    width: 100%;
    height: auto;
    display: block;
    object-fit: contain; /* no crop */
  }

  /* Optional: if any CSS sets max-width on columns/cards, kill it */
  .luxury-layout .col-12,
  .luxury-layout .lux-card{
    max-width: none !important;
  }
</style>

<section class="container-fluid px-0 my-5 luxury-layout">

  <!-- ROW 1 : VIDEO LEFT / IMAGES RIGHT -->
  <div class="row g-0">

    <!-- LEFT VIDEO -->
    <div class="col-12 col-lg-8" style="transform: translateY(-6px);">
      <div class="lux-card big-card">
        <video autoplay muted loop playsinline preload="metadata" class="w-100 h-100">
          <source src="{{ asset('assets/f_assets/image/eid/eid_first.mp4') }}" type="video/mp4">
        </video>
      </div>
    </div>

    <!-- RIGHT IMAGES -->
    <div class="col-12 col-lg-4">
      <div class="row g-0">
        <div class="col-12">
          <div class="lux-card small-card">
            <img src="{{ asset('assets/f_assets/image/eid/eid_1.avif') }}" alt="Hanif Banner" loading="eager">
          </div>
        </div>

        <div class="col-12">
          <div class="lux-card small-card">
            <img src="{{ asset('assets/f_assets/image/eid/eid_4.avif') }}" alt="Hanif Banner" loading="eager">
          </div>
        </div>
      </div>
    </div>

  </div>


  <!-- ROW 2 : IMAGES LEFT / VIDEO RIGHT -->
  <div class="row g-0"style="margin-top:22px;">

    <!-- LEFT IMAGES -->
    <div class="col-12 col-lg-4">
      <div class="row g-0">
        <div class="col-12">
          <div class="lux-card small-card">
            <img src="{{ asset('assets/f_assets/image/eid/eid_2.avif') }}" alt="Hanif Banner" loading="eager">
          </div>
        </div>

        <div class="col-12">
          <div class="lux-card small-card">
            <img src="{{ asset('assets/f_assets/image/eid/eid_3.avif') }}" alt="Hanif Banner" loading="eager">
          </div>
        </div>
      </div>
    </div>

    <!-- RIGHT VIDEO -->
    <div class="col-12 col-lg-8"style="transform: translateY(-5px);">
      <div class="lux-card big-card">
        <video autoplay muted loop playsinline preload="metadata" class="w-100 h-100">
          <source src="{{ asset('assets/f_assets/image/eid/eid_second.mp4') }}" type="video/mp4">
        </video>
      </div>
    </div>

  </div>

</section>
 <section class="onlineStore"style="transform: translateY(-30px);">
                <div class="row mx-auto my-auto justify-content-center g-2 gy-3">
                    @foreach ($elevenToTwentyTwo as $key => $product)
                        <div class="col-md-3">
                            @include('public.partials.product-card', ['product' => $product])
                        </div>
                    @endforeach
                </div>
            </section>
@endsection