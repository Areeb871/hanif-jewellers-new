@php
    $carouselId = 'carouselOnline' . ($product->slug ?? 'item') . '_' . uniqid();
    $hasImages  = isset($product->images) && count($product->images) > 0;

    $displayImage = $hasImages
        ? asset(ltrim($product->images->first()->image, '/'))
        : (!empty($product->image) ? asset(ltrim($product->image, '/')) : asset('default.jpg'));

    $storeContext = $storeContext ?? false;
    $hideDetails = $hideDetails ?? false;
    $detailUrl = $storeContext
        ? route('product.details', $product->slug) . '?store=1'
        : route('product.details', $product->slug);
@endphp

<style>
/* ==============================
   TILE / SQUARE IMAGE
============================== */
.hjProductCard{
    position: relative;
    overflow: hidden;
    background: #000;
}
.hjImageArea{
    position: relative;
    overflow: hidden;
    aspect-ratio: 1 / 1;
    background: #000;
}

/* Make carousel fill the square */
.hjImageArea .carousel,
.hjImageArea .carousel-inner,
.hjImageArea .carousel-item,
.hjImageArea .hjImageLink,
.hjImageArea img{
    width: 100%;
    height: 100%;
}

.hjImageArea img{
    display: block;
    object-fit: cover;
    object-position: center;
    transition: transform .4s ease;
}

@media (min-width: 992px){
    .hjProductCard:hover .hjImageArea img{
        transform: scale(1.05);
    }
}

/* ==============================
   OVERLAY (does NOT block arrows)
============================== */
.hjOverlay{
    position: absolute;
    left: 0; right: 0; bottom: 0;
    padding: 18px 22px;
    z-index: 40;
    background: linear-gradient(to top, rgba(0,0,0,.75), rgba(0,0,0,.28), rgba(0,0,0,0));
    pointer-events: none; /* ✅ important */
}
.hjOverlay *{ pointer-events: auto; }

/* ==============================
   PAGINATION (ABOVE TITLE, CENTER)
============================== */
.hjPagination{
    display: flex;
    justify-content: center;
    gap: 8px;
    list-style: none;
    padding: 0;
    margin: 0 0 12px 0;
    position: relative;
    z-index: 110;
}
.hjDot{
    width: 8px;
    height: 8px;
    border-radius: 999px;
    background: rgba(255,255,255,.55);
    transition: width .25s ease, height .25s ease, background .25s ease;
}
.hjDot button{
    width: 100%;
    height: 100%;
    border: 0;
    background: transparent;
    padding: 0;
    cursor: pointer;
}
.hjDot.is-active{
    width: 44px;
    height: 6px;
    background: rgba(255,255,255,.95);
}

/* ==============================
   TITLE + DESC/BUTTON (stable)
============================== */
.hjTitle{
    margin: 0 0 8px 0;
    font-family: Engravers;
    font-size: 13px;
    letter-spacing: .18em;
    text-transform: uppercase;
    color: #fff;
    position: relative;
    z-index: 110;
}
.hjSwapArea{
    position: relative;
    min-height: 44px;
    z-index: 110;
}
.hjDesc{
    font-family: Engravers;
    font-size: 11px;
    letter-spacing: .12em;
    text-transform: uppercase;
    color: rgba(255,255,255,.9);

    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;

    opacity: 1;
    transition: opacity .25s ease;
}
.hjBtn{
    position: absolute;
    left: 0; top: 0;
    width: 100%;
    background: rgba(255,255,255,.92) !important;
    color: #6b6b6b !important;
    border: none !important;
    border-radius: 2px;
    padding: 14px 10px;
    text-align: center;
    font-size: 12px;
    letter-spacing: .14em;
    text-transform: uppercase;
    font-weight: 500;
    opacity: 0;
    pointer-events: none;
    transition: opacity .25s ease;
}

@media (min-width: 992px){
    .hjProductCard:hover .hjDesc{ opacity: 0; }
    .hjProductCard:hover .hjBtn{ opacity: 1; pointer-events: auto; }
}
@media (max-width: 991px){
    .hjSwapArea{ min-height: auto; }
    .hjBtn{
        position: static;
        opacity: 1;
        pointer-events: auto;
        margin-top: 10px;
    }
}

/* ==============================
   ARROWS (ICON ONLY - NO BACKGROUND)
============================== */
.hjArrowBtn{
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    z-index: 200;
    width: 44px;
    height: 44px;
    border: none;
    background: transparent;   /* ✅ no background */
    padding: 0;
    cursor: pointer;
    display: grid;
    place-items: center;
}

/* Position */
.hjArrowPrev{ left: 12px; }
.hjArrowNext{ right: 12px; }

/* SVG */
.hjArrowBtn svg{
    width: 22px;
    height: 22px;
    stroke: #ffffff;
    stroke-width: 2;
    opacity: .85;
    transition: opacity .25s ease, transform .25s ease;
}

@media (min-width: 992px){
    .hjArrowBtn:hover svg{
        opacity: 1;
        transform: scale(1.1);
    }
}
/* ==============================
   MOBILE (<= 767px) - more concise
============================== */
@media (max-width: 767px){

  .hjOverlay{
    padding: 10px 12px !important;
  }

  /* Pagination tighter */
  .hjPagination{
    gap: 5px !important;
    margin: 0 0 6px 0 !important;
  }
  .hjDot{ width: 6px !important; height: 6px !important; }
  .hjDot.is-active{ width: 28px !important; height: 4px !important; }

  /* Title/desc smaller */
  .hjTitle{
    font-size: 10px !important;
    letter-spacing: .12em !important;
    margin: 0 0 4px 0 !important;
    line-height: 1.15 !important;
  }
  .hjDesc{
    font-size: 9px !important;
    letter-spacing: .08em !important;
    -webkit-line-clamp: 1 !important; /* 1 line on mobile */
    line-height: 1.2 !important;
  }

  /* Button smaller + less height */
  .hjBtn{
    padding: 10px 8px !important;
    font-size: 10px !important;
    letter-spacing: .12em !important;
  }

  /* Keep button from taking too much space */
  .hjSwapArea{
    min-height: 34px !important;
  }
}

/* ==============================
   iPad Mini / iPad Air (768–1024)
   Make overlay concise + smaller button
============================== */
@media (min-width: 768px) and (max-width: 1199px){

  /* Overlay height reduced */
  .hjOverlay{
    padding: 10px 12px !important;
  }

  /* Pagination smaller + higher */
  .hjPagination{
    gap: 6px !important;
    margin: 0 0 6px 0 !important;
  }
  .hjDot{ width: 6px !important; height: 6px !important; }
  .hjDot.is-active{ width: 30px !important; height: 4px !important; }

  /* Title smaller */
  .hjTitle{
    font-size: 10px !important;
    letter-spacing: .12em !important;
    margin: 0 0 4px 0 !important;
    line-height: 1.15 !important;
  }

  /* Description smaller (1 line only) */
  .hjDesc{
    font-size: 9px !important;
    letter-spacing: .09em !important;
    -webkit-line-clamp: 1 !important;
    line-height: 1.15 !important;
  }

  /* IMPORTANT:
     On iPad show button like mobile BUT SMALL
     (prevents hover swap issues on iPad) */
  .hjBtn{
    position: static !important;
    opacity: 1 !important;
    pointer-events: auto !important;

    margin-top: 8px !important;
    padding: 9px 8px !important;
    font-size: 10px !important;
    letter-spacing: .12em !important;
  }

  /* Remove extra reserved height */
  .hjSwapArea{
    min-height: auto !important;
  }

  /* Arrows smaller + cleaner on iPad */
  .hjArrowBtn{
    width: 38px !important;
    height: 38px !important;
  }
  .hjArrowBtn svg{
    width: 18px !important;
    height: 18px !important;
    opacity: .75 !important;
  }
}
/* ==============================
   DESKTOP (1025px and above)
   Refined luxury balance
============================== */
@media (min-width: 1200px){

  /* Overlay spacing – refined, not bulky */
  .hjOverlay{
    padding: 16px 18px !important;
  }

  /* Pagination elegant sizing */
  .hjPagination{
    gap: 8px !important;
    margin: 0 0 10px 0 !important;
  }

  .hjDot{
    width: 7px !important;
    height: 7px !important;
  }

  .hjDot.is-active{
    width: 40px !important;
    height: 4px !important;
  }

  /* Title – luxury readable, not loud */
  .hjTitle{
    font-size: 12px !important;
    letter-spacing: .16em !important;
    margin-bottom: 6px !important;
    line-height: 1.25 !important;
  }

  /* Description – calm + concise */
  .hjDesc{
    font-size: 10px !important;
    letter-spacing: .10em !important;
    -webkit-line-clamp: 2 !important;
    line-height: 1.3 !important;
  }

  /* Button – slimmer premium look */
  .hjBtn{
    padding: 12px 10px !important;
    font-size: 11px !important;
    letter-spacing: .14em !important;
  }

  /* Stable area for hover swap */
  .hjSwapArea{
    min-height: 42px !important;
  }

  /* Arrows – subtle but visible */
  .hjArrowBtn{
    width: 44px !important;
    height: 44px !important;
  }

  .hjArrowBtn svg{
    width: 20px !important;
    height: 20px !important;
    opacity: .8 !important;
  }
}


</style>

<div class="hjProductCard">
    <div class="hjImageArea">

        {{-- CAROUSEL / IMAGE --}}
        @if($hasImages && count($product->images) > 1)
            <div id="{{ $carouselId }}"
                 class="carousel slide hj-carousel"
                 data-bs-ride="false"
                 data-bs-interval="false">

                <div class="carousel-inner">
                    @foreach($product->images as $i => $img)
                        <div class="carousel-item {{ $i === 0 ? 'active' : '' }}">
                            <a href="{{ $detailUrl }}"
                               class="hjImageLink d-block">
                                <img src="{{ asset(ltrim($img->image,'/')) }}"
                                     alt="{{ $product->name }} image"
                                     loading="lazy">
                            </a>
                        </div>
                    @endforeach
                </div>

                {{-- LEFT ARROW (ICON ONLY) --}}
                <button class="hjArrowBtn hjArrowPrev"
                        type="button"
                        data-bs-target="#{{ $carouselId }}"
                        data-bs-slide="prev"
                        aria-label="Previous">
                    <svg viewBox="0 0 24 24" fill="none">
                        <path d="M15 18l-6-6 6-6"
                              stroke-linecap="round"
                              stroke-linejoin="round"/>
                    </svg>
                </button>

                {{-- RIGHT ARROW (ICON ONLY) --}}
                <button class="hjArrowBtn hjArrowNext"
                        type="button"
                        data-bs-target="#{{ $carouselId }}"
                        data-bs-slide="next"
                        aria-label="Next">
                    <svg viewBox="0 0 24 24" fill="none">
                        <path d="M9 6l6 6-6 6"
                              stroke-linecap="round"
                              stroke-linejoin="round"/>
                    </svg>
                </button>

            </div>
        @else
            <a href="{{ $detailUrl }}" class="hjImageLink d-block">
                <img src="{{ $displayImage }}"
                     alt="{{ $product->name ?? 'Product' }}"
                     loading="lazy">
            </a>
        @endif

        {{-- OVERLAY --}}
        <div class="hjOverlay">

            {{-- PAGINATION --}}
            @if($hasImages && count($product->images) > 1)
                <ul class="hjPagination" data-carousel="{{ $carouselId }}">
                    @foreach($product->images as $i => $img)
                        <li class="hjDot {{ $i === 0 ? 'is-active' : '' }}" data-slide="{{ $i }}">
                            <button type="button" aria-label="Go to slide {{ $i + 1 }}"></button>
                        </li>
                    @endforeach
                </ul>
            @endif

            <!--<h3 class="hjTitle">{{ $product->name }}</h3>-->

            <div class="hjSwapArea">
                @unless($hideDetails)
                    <div class="hjDesc">{!! $product->description !!}</div>
                @endunless
                <a href="{{ $detailUrl }}" class="btn hjBtn">
                    Discover More
                </a>
            </div>
        </div>

    </div>
</div>

<script>
(function () {
  function initHJCarousels(root = document) {
    const carousels = root.querySelectorAll('.hj-carousel:not([data-hj-init="1"])');

    carousels.forEach((carouselEl) => {
      carouselEl.setAttribute('data-hj-init', '1');

      if (typeof bootstrap === 'undefined' || !bootstrap.Carousel) return;

      const bs = bootstrap.Carousel.getInstance(carouselEl) || new bootstrap.Carousel(carouselEl, {
        interval: false,
        wrap: true,
        keyboard: false,
        touch: true
      });

      const carouselId = carouselEl.id;
      const pager = root.querySelector('.hjPagination[data-carousel="' + carouselId + '"]');
      if (!pager) return;

      const dots  = pager.querySelectorAll('.hjDot');
      const items = carouselEl.querySelectorAll('.carousel-item');

      function setActive(i){
        dots.forEach((d, idx) => d.classList.toggle('is-active', idx === i));
      }

      // click pagination
      dots.forEach((dot) => {
        dot.addEventListener('click', (e) => {
          e.preventDefault();
          e.stopPropagation();
          const idx = parseInt(dot.getAttribute('data-slide'), 10);
          if (!Number.isNaN(idx)) {
            bs.to(idx);
            setActive(idx);
          }
        });
      });

      // update on slide
      carouselEl.addEventListener('slid.bs.carousel', () => {
        let activeIndex = 0;
        items.forEach((it, i) => { if (it.classList.contains('active')) activeIndex = i; });
        setActive(activeIndex);
      });

      // initial sync
      let initial = 0;
      items.forEach((it, i) => { if (it.classList.contains('active')) initial = i; });
      setActive(initial);
    });
  }

  document.addEventListener('DOMContentLoaded', () => initHJCarousels());
  window.initHJCarousels = initHJCarousels;
})();
</script>
