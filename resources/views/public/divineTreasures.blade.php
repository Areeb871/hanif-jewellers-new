@extends('public.layouts.header_new')
@php
    use Illuminate\Support\Facades\File;
@endphp

@section('content')

    @php
        // Safe defaults if controller didn't set these
        $backgroundType = $backgroundType ?? 'video';
        $backgroundFile = $backgroundFile ?? 'assets/f_assets/image/devine-treasure/main.mp4';
        $mobileBackgroundFile = $mobileBackgroundFile ?? 'assets/f_assets/image/devine-treasure/mobile.mp4';
    @endphp

    <!-- Desktop Banner -->
    <section class="sectionOne d-md-block d-none">
        @if($backgroundType === 'video' && !empty($backgroundFile))
            <video autoplay loop muted playsinline preload="auto" class="bannerMedia">
                <source src="{{ asset($backgroundFile) }}" type="video/mp4">
                Your browser does not support the video tag.
            </video>
        @elseif($backgroundType === 'image' && !empty($backgroundFile))
            <div class="bannerMedia bannerBgImage" style="background-image: url('{{ asset($backgroundFile) }}');"></div>
        @endif
    </section>

    <!-- Mobile Banner -->
    <section class="sectionMobile d-md-none">
        <video autoplay loop muted playsinline class="bannerMedia">
            <source src="{{ asset($mobileBackgroundFile) }}" type="video/mp4">
            Your browser does not support the video tag.
        </video>
    </section>

    <style>
        .sectionOne{
            position: relative;
            min-height: calc(100vh - 120px);
            overflow: hidden;
            margin: 0 !important;
            padding: 0 !important;
        }

        .sectionMobile{
            position: relative;
            min-height: calc(100vh - 80px);
            overflow: hidden;
            margin: 0 !important;
            padding: 0 !important;
        }

        .bannerMedia{
            position: absolute;
            inset: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
            z-index: 0;
        }

        .bannerBgImage{
            background-position: center center;
            background-size: cover;
            background-repeat: no-repeat;
        }
    </style>


<section class="container">
    <h4 class="text-center py-3 mt-4 text-uppercase">Discover Our Collection</h4>

    <div style="width: 100vw; margin-left: calc(-50vw + 50%); background: #fff; position: relative; overflow: hidden;">
        <!-- Arrows -->
        <button type="button" class="slider-arrow prev" onclick="DivineGallery.scroll('imageSlider', -1)">
            <i class="fa-solid fa-chevron-left"></i>
        </button>
        <button type="button" class="slider-arrow next" onclick="DivineGallery.scroll('imageSlider', 1)">
            <i class="fa-solid fa-chevron-right"></i>
        </button>

        <div id="imageSlider"
             style="display: flex; gap: 20px; overflow-x: auto; scroll-snap-type: x mandatory; -webkit-overflow-scrolling: touch; padding: 20px;">
            
            <style>
                #imageSlider::-webkit-scrollbar { display: none; }
                .slider-arrow {
                       position: absolute;
    top: 50%;
    transform: translateY(-50%);
    width: 42px;
    height: 42px;
    border-radius: 50%;
    border: none;
    background: transparent;
    color: #fff;
    display: flex
;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    z-index: 3;
                }
                .slider-arrow.prev { left: 10px; }
                .slider-arrow.next { right: 10px; }
                /* Force horizontal centering */
.position-absolute.bottom-0.start-50.translate-middle-x {
    display: flex;
    justify-content: center;
    align-items: center;
    width: 100%;
}

/* Make the buttons appear horizontally */
.d-flex.gap-2 {
    flex-direction: row !important;
}
.zoom-panel {
    position: absolute;
    top: 70px; /* place just below X close icon */
    right: 20px;
    width: 48px;
    background-color: #26292c;
    border-radius: 0;
    display: flex;
    flex-direction: column;
    align-items: center;
    padding: 6px 0;
    gap: 10px;
    z-index: 1056;
}

.zoom-btn {
    width: 100%;
    height: 38px;
    background: none;
    border: none;
    color: #fff;
    font-size: 22px;
    cursor: pointer;
}

.zoom-btn i {
    font-size: 18px;
}

.zoom-btn:hover {
    background-color: #2f3235;
}
</style>

            @php
                $allSlides = [];
            @endphp

            @for ($look = 1; $look <= 3; $look++)
                @php
                    $folderPath = public_path("assets/f_assets/image/devine-treasure/Tasbeeh {$look}/Web Images");
                    if (File::exists($folderPath)) {
                        $files = File::files($folderPath);
                        foreach ($files as $file) {
                            $relativePath = str_replace(public_path(), '', $file->getPathname());
                            $relativePath = ltrim($relativePath, '/\\');
                            $allSlides[] = $relativePath;
                        }
                    }
                @endphp
            @endfor

            @foreach ($allSlides as $index => $slide)
                <img src="{{ asset($slide) }}"
                     class="img-fluid"
                     style="width: 25vw; min-width: 350px; max-width: 400px; scroll-snap-align: start;"
                     alt="Tasbeeh Image"
                     data-index="{{ $index }}"
                     onclick="DivineGallery.open('imageSlider', Number(this.dataset.index))">
            @endforeach
        </div>
    </div>
</section>

<div class="row g-3 justify-content-center"> 
    <div class="col-md-8 col-lg-6 mx-auto"> 
        <div class="text-center"> 
            <p class="m-0 px-3" style="padding-top: 1.5rem !important;font-size: 1.5rem;"> Jewels with a deeply spiritual meaning, Divine Treasures by Hanif is a collection for the believers and collectors alike, exquisitely crafted to perfection.
    </p> 
    </div> 
        </div> 
</div>

<section class="container mt-5">
    <div style="width: 100vw; margin-left: calc(-50vw + 50%); background: #fff; position: relative; overflow: hidden;">
        <!-- Arrows -->
        <button type="button" class="slider-arrow prev" onclick="DivineGallery.scroll('imageSlider2', -1)">
            <i class="fa-solid fa-chevron-left"></i>
        </button>
        <button type="button" class="slider-arrow next" onclick="DivineGallery.scroll('imageSlider2', 1)">
            <i class="fa-solid fa-chevron-right"></i>
        </button>

        <div id="imageSlider2"
             style="display: flex; gap: 20px; overflow-x: auto; scroll-snap-type: x mandatory;">

            @php
                use Illuminate\Support\Facades\File as F;

                $folderPath = public_path('assets/f_assets/image/devine-treasure/Pendant Website');
                $allSlides2 = [];

                if (F::exists($folderPath)) {
                    $files = F::files($folderPath);
                    foreach ($files as $file) {
                        $relativePath = ltrim(str_replace(public_path(), '', $file->getPathname()), '/\\');
                        $allSlides2[] = $relativePath;
                    }
                }
            @endphp

            @foreach ($allSlides2 as $index => $slide)
                <img src="{{ asset($slide) }}" 
                     class="img-fluid"
                     style="width: 25vw; min-width: 350px; max-width: 400px; scroll-snap-align: start;"
                     alt="Pendant Image {{ $index + 1 }}" 
                     data-index="{{ $index }}"
                     onclick="DivineGallery.open('imageSlider2', Number(this.dataset.index))">
            @endforeach
        </div>
    </div>
</section>

<!-- ✅ Your existing modal -->
<div class="divine-image-modal" id="imageModal" tabindex="-1" role="dialog" aria-modal="true" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content bg-transparent border-0">
            <div class="modal-header border-0">
                <button type="button" class="divine-modal-close" aria-label="Close" onclick="DivineGallery.close()">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center p-0 position-relative"
                 style="overflow: hidden; display: flex; align-items: center; justify-content: center;">
                <img id="modalImage" src="" class="img-fluid"
                     style="max-height: 90vh; max-width: 90vw; cursor: grab; touch-action: none; user-select: none;"
                     draggable="false" alt="">
                
                <!-- Navigation Arrows -->
                <button id="modalPrev" class="btn btn-link position-absolute top-50 start-0 translate-middle-y text-white"
                        style="left: 20px; z-index: 10;" onclick="DivineGallery.navigate(-1)">
                    <i class="fas fa-chevron-left fa-1x"></i>
                </button>
                <button id="modalNext" class="btn btn-link position-absolute top-50 end-0 translate-middle-y text-white"
                        style="right: 20px; z-index: 10;" onclick="DivineGallery.navigate(1)">
                    <i class="fas fa-chevron-right fa-1x"></i>
                </button>

                <!-- Zoom Controls -->
                <div class="divine-zoom-controls">
                    <div class="btn-group-vertical" role="group">
                        <button type="button" class="btn btn-dark btn-sm" onclick="DivineGallery.zoomIn()" title="Zoom In">
                            <i class="fas fa-plus"></i>
                        </button>
                        <button type="button" class="btn btn-dark btn-sm" onclick="DivineGallery.zoomOut()" title="Zoom Out">
                            <i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-dark btn-sm" onclick="DivineGallery.resetZoom()" title="Reset Zoom">
                            <i class="fas fa-expand-arrows-alt"></i>
                        </button>
                    </div>
                </div>

                <!-- Image Counter -->
                <div class="position-absolute bottom-0 start-50 translate-middle-x mb-3">
                    <span id="imageCounter" class="badge bg-dark bg-opacity-75 text-white px-3 py-2"></span>
                </div>
            </div>
        </div>
    </div>
</div>
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

<style>
.divine-image-modal {
    position: fixed;
    inset: 0;
    display: none;
    width: 100vw;
    height: 100vh;
    overflow: hidden;
    background: rgba(0, 0, 0, 0.94);
    z-index: 999999;
}

.divine-image-modal.is-open {
    display: block;
}

.divine-image-modal .modal-dialog,
.divine-image-modal .modal-content {
    width: 100%;
    height: 100%;
    margin: 0;
}

.divine-image-modal .modal-header {
    position: absolute;
    top: 16px;
    right: 16px;
    margin: 0;
    padding: 0;
    z-index: 30;
}

.divine-modal-close {
    width: 42px;
    height: 42px;
    margin: 0;
    padding: 0 0 4px;
    border: 1px solid rgba(255, 255, 255, 0.35);
    border-radius: 50%;
    background: rgba(25, 28, 31, 0.92);
    color: #fff;
    font-family: Arial, sans-serif;
    font-size: 32px;
    font-weight: 300;
    line-height: 1;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    opacity: 1;
}

.divine-modal-close:hover,
.divine-modal-close:focus {
    background: #34383c;
    color: #fff;
    outline: 2px solid rgba(255, 255, 255, 0.55);
    outline-offset: 2px;
}

.divine-zoom-controls {
    position: absolute;
    top: 72px;
    right: 16px;
    z-index: 25;
}

.divine-image-modal .modal-body {
    width: 100%;
    height: 100%;
}

body.divine-modal-open {
    overflow: hidden !important;
}

@media (max-width: 576px) {
    .divine-image-modal .modal-header {
        top: max(12px, env(safe-area-inset-top));
        right: 12px;
    }

    .divine-zoom-controls {
        top: calc(max(12px, env(safe-area-inset-top)) + 54px);
        right: 12px;
    }
}
</style>



<!-- 🧠 JS + CSS -->
<style>
    #imageSlider2::-webkit-scrollbar { display: none; }
    .slider-arrow {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        width: 42px;
        height: 42px;
        border-radius: 50%;
        border: none;
        background: transparent;
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        z-index: 3;
    }
    .slider-arrow.prev { left: 10px; }
    .slider-arrow.next { right: 10px; }

    /* From your shared code */
    .position-absolute.bottom-0.start-50.translate-middle-x {
        display: flex;
        justify-content: center;
        align-items: center;
        width: 100%;
    }

    .d-flex.gap-2 {
        flex-direction: row !important;
    }

    .zoom-panel {
        position: absolute;
        top: 70px;
        right: 20px;
        width: 48px;
        background-color: #26292c;
        border-radius: 0;
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 6px 0;
        gap: 10px;
        z-index: 1056;
    }

    .zoom-btn {
        width: 100%;
        height: 38px;
        background: none;
        border: none;
        color: #fff;
        font-size: 22px;
        cursor: pointer;
    }

    .zoom-btn i {
        font-size: 18px;
    }

    .zoom-btn:hover {
        background-color: #2f3235;
    }
</style>











<!-- 💡 JS: Slider + Modal Controls -->





<script>
window.DivineGallery = (() => {
    const modalElement = document.getElementById('imageModal');
    const imageElement = document.getElementById('modalImage');
    const counterElement = document.getElementById('imageCounter');
    const previousButton = document.getElementById('modalPrev');
    const nextButton = document.getElementById('modalNext');

    let images = [];
    let alts = [];
    let activeIndex = 0;
    let zoom = 1;
    let offsetX = 0;
    let offsetY = 0;
    let dragging = false;
    let dragStartX = 0;
    let dragStartY = 0;
    let pinchDistance = 0;
    let pinchZoom = 1;

    const clampIndex = index => Math.min(Math.max(index, 0), Math.max(images.length - 1, 0));

    function applyTransform() {
        imageElement.style.transform = `translate3d(${offsetX}px, ${offsetY}px, 0) scale(${zoom})`;
        imageElement.style.cursor = zoom > 1 ? (dragging ? 'grabbing' : 'grab') : 'default';
    }

    function resetZoom() {
        zoom = 1;
        offsetX = 0;
        offsetY = 0;
        dragging = false;
        applyTransform();
    }

    function updateImage() {
        if (!images.length) return;

        resetZoom();
        imageElement.src = images[activeIndex];
        imageElement.alt = alts[activeIndex] || `Divine Treasure image ${activeIndex + 1}`;
        counterElement.textContent = `${activeIndex + 1} / ${images.length}`;

        const hasMultipleImages = images.length > 1;
        previousButton.hidden = !hasMultipleImages;
        nextButton.hidden = !hasMultipleImages;
    }

    function open(sliderId, index = 0) {
        const slider = document.getElementById(sliderId);
        if (!slider) return;

        const sliderImages = Array.from(slider.querySelectorAll('img'));
        if (!sliderImages.length) return;

        images = sliderImages.map(image => image.currentSrc || image.src);
        alts = sliderImages.map(image => image.alt || '');
        activeIndex = clampIndex(Number(index) || 0);
        updateImage();

        modalElement.classList.add('is-open');
        modalElement.setAttribute('aria-hidden', 'false');
        document.body.classList.add('divine-modal-open');
        modalElement.focus();
    }

    function close() {
        modalElement.classList.remove('is-open');
        modalElement.setAttribute('aria-hidden', 'true');
        document.body.classList.remove('divine-modal-open');
        resetZoom();
        imageElement.removeAttribute('src');
        images = [];
        alts = [];
    }

    function navigate(direction) {
        if (images.length < 2) return;
        activeIndex = (activeIndex + direction + images.length) % images.length;
        updateImage();
    }

    function zoomIn() {
        zoom = Math.min(zoom + 0.25, 5);
        applyTransform();
    }

    function zoomOut() {
        zoom = Math.max(zoom - 0.25, 1);
        if (zoom === 1) {
            offsetX = 0;
            offsetY = 0;
        }
        applyTransform();
    }

    function scroll(sliderId, direction) {
        const slider = document.getElementById(sliderId);
        if (!slider) return;

        const firstImage = slider.querySelector('img');
        const gap = parseFloat(getComputedStyle(slider).gap) || 0;
        const distance = firstImage ? firstImage.getBoundingClientRect().width + gap : 400;
        slider.scrollBy({ left: direction * distance, behavior: 'smooth' });
    }

    function touchDistance(touches) {
        const x = touches[0].clientX - touches[1].clientX;
        const y = touches[0].clientY - touches[1].clientY;
        return Math.hypot(x, y);
    }

    imageElement.addEventListener('pointerdown', event => {
        if (zoom <= 1 || event.pointerType === 'touch') return;
        dragging = true;
        dragStartX = event.clientX - offsetX;
        dragStartY = event.clientY - offsetY;
        if (imageElement.setPointerCapture) {
            imageElement.setPointerCapture(event.pointerId);
        }
        applyTransform();
    });

    imageElement.addEventListener('pointermove', event => {
        if (!dragging || zoom <= 1) return;
        event.preventDefault();
        offsetX = event.clientX - dragStartX;
        offsetY = event.clientY - dragStartY;
        applyTransform();
    });

    const stopDragging = () => {
        dragging = false;
        applyTransform();
    };

    imageElement.addEventListener('pointerup', stopDragging);
    imageElement.addEventListener('pointercancel', stopDragging);

    imageElement.addEventListener('touchstart', event => {
        if (event.touches.length === 2) {
            pinchDistance = touchDistance(event.touches);
            pinchZoom = zoom;
            dragging = false;
        } else if (event.touches.length === 1 && zoom > 1) {
            dragging = true;
            dragStartX = event.touches[0].clientX - offsetX;
            dragStartY = event.touches[0].clientY - offsetY;
        }
    }, { passive: false });

    imageElement.addEventListener('touchmove', event => {
        if (event.touches.length === 2 && pinchDistance > 0) {
            event.preventDefault();
            zoom = Math.min(Math.max(pinchZoom * (touchDistance(event.touches) / pinchDistance), 1), 5);
            applyTransform();
        } else if (event.touches.length === 1 && dragging && zoom > 1) {
            event.preventDefault();
            offsetX = event.touches[0].clientX - dragStartX;
            offsetY = event.touches[0].clientY - dragStartY;
            applyTransform();
        }
    }, { passive: false });

    imageElement.addEventListener('touchend', () => {
        dragging = false;
        pinchDistance = 0;
        applyTransform();
    });

    imageElement.addEventListener('wheel', event => {
        if (!modalElement.classList.contains('is-open')) return;
        event.preventDefault();
        event.deltaY < 0 ? zoomIn() : zoomOut();
    }, { passive: false });

    imageElement.addEventListener('dblclick', () => {
        if (zoom === 1) {
            zoom = 2;
            applyTransform();
        } else {
            resetZoom();
        }
    });

    document.addEventListener('keydown', event => {
        if (!modalElement.classList.contains('is-open')) return;

        if (event.key === 'ArrowLeft') navigate(-1);
        if (event.key === 'ArrowRight') navigate(1);
        if (event.key === '+' || event.key === '=') zoomIn();
        if (event.key === '-') zoomOut();
        if (event.key === '0') resetZoom();
        if (event.key === 'Escape') close();
    });

    modalElement.addEventListener('click', event => {
        if (event.target === modalElement) close();
    });

    return { open, close, navigate, zoomIn, zoomOut, resetZoom, scroll };
})();
</script>

@endsection
