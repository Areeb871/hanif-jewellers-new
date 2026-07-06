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
        <button class="slider-arrow prev" onclick="scrollSlider(-1)">
            <i class="fa-solid fa-chevron-left"></i>
        </button>
        <button class="slider-arrow next" onclick="scrollSlider(1)">
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
                     onclick="openImageModalForDevine(parseInt(this.dataset.index))">
            @endforeach
        </div>
    </div>
</section>

<!-- 💎 Cleopatra-Style Modal Viewer -->
<div id="devineImageModal" class="modal fade" tabindex="-1" aria-hidden="true" style="background: rgba(0,0,0,0.9);">
    <div class="modal-dialog modal-dialog-centered modal-fullscreen">
        <div class="modal-content" style="background: transparent; border: none;">
            <div class="modal-body d-flex align-items-center justify-content-center position-relative">
                <button type="button" class="btn-close btn-close-white position-absolute top-0 end-0 m-3"
                        aria-label="Close" onclick="closeImageModalForDevine()"></button>

                <img id="devineModalImage" src="" class="img-fluid" style="max-height: 90vh; max-width: 90vw; transition: transform 0.3s ease;">

                <!-- Controls -->
                <button class="btn btn-light position-absolute top-50 start-0 translate-middle-y"
                        style="opacity: 0.6;" onclick="prevImageDevine()">❮</button>
                <button class="btn btn-light position-absolute top-50 end-0 translate-middle-y"
                        style="opacity: 0.6;" onclick="nextImageDevine()">❯</button>

             <!-- Zoom Controls (placed below X icon, right side) -->
<div class="zoom-panel">
    <button class="zoom-btn" onclick="zoomInDevine()">+</button>
    <button class="zoom-btn" onclick="zoomOutDevine()">−</button>
    <button class="zoom-btn" onclick="toggleFullScreenDevine()">
        <i class="fa-solid fa-maximize"></i>
    </button>
</div>


            </div>
        </div>
    </div>
</div>


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
        <button class="slider-arrow prev" onclick="scrollSlider2(-1)">
            <i class="fa-solid fa-chevron-left"></i>
        </button>
        <button class="slider-arrow next" onclick="scrollSlider2(1)">
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
                     onclick="openImageModal(parseInt(this.dataset.index))">
            @endforeach
        </div>
    </div>
</section>

<!-- ✅ Your existing modal -->
<div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content bg-transparent border-0">
            <div class="modal-header border-0">
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center p-0 position-relative"
                 style="overflow: hidden; margin-bottom: 100px; height: auto; display: flex; align-items: flex-start; justify-content: center;">
                <img id="modalImage" src="" class="img-fluid"
                     style="max-height: 100vh; max-width: 100vw; cursor: grab; touch-action: none; user-select: none;"
                     onmousedown="startDrag(event)" onmousemove="drag(event)" onmouseup="endDrag()" onmouseleave="endDrag()"
                     ontouchstart="startTouch(event)" ontouchmove="touchMove(event)" ontouchend="endTouch()">
                
                <!-- Navigation Arrows -->
                <button id="modalPrev" class="btn btn-link position-absolute top-50 start-0 translate-middle-y text-white"
                        style="left: 20px; z-index: 10;" onclick="navigateModal(-1)">
                    <i class="fas fa-chevron-left fa-1x"></i>
                </button>
                <button id="modalNext" class="btn btn-link position-absolute top-50 end-0 translate-middle-y text-white"
                        style="right: 20px; z-index: 10;" onclick="navigateModal(1)">
                    <i class="fas fa-chevron-right fa-1x"></i>
                </button>

                <!-- Zoom Controls -->
                <div class="position-absolute top-0 end-0 mt-3 me-3">
                    <div class="btn-group-vertical" role="group">
                        <button class="btn btn-dark btn-sm" onclick="zoomIn()" title="Zoom In">
                            <i class="fas fa-plus"></i>
                        </button>
                        <button class="btn btn-dark btn-sm" onclick="zoomOut()" title="Zoom Out">
                            <i class="fas fa-minus"></i>
                        </button>
                        <button class="btn btn-dark btn-sm" onclick="resetZoom()" title="Reset Zoom">
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
#imageModal .modal-backdrop {
    background-color: rgba(0, 0, 0, 0.9) !important;
}
#imageModal.modal {
    background-color: rgba(0, 0, 0, 0.9) !important;
}
</style>

<script>
let currentIndex = 0;
let allImages = [];
let zoomLevel = 1;
let isDragging = false;
let startX, startY, translateX = 0, translateY = 0;

document.addEventListener("DOMContentLoaded", () => {
    allImages = Array.from(document.querySelectorAll("#imageSlider2 img")).map(img => img.src);
    const modalImage = document.getElementById("modalImage");
    if (modalImage) {
        modalImage.addEventListener("wheel", (e) => {
            e.preventDefault();
            if (e.deltaY < 0) {
                zoomIn();
            } else {
                zoomOut();
            }
        }, { passive: false });

        modalImage.addEventListener("dblclick", () => {
            if (zoomLevel === 1) {
                zoomLevel = 2;
            } else {
                zoomLevel = 1;
                translateX = 0;
                translateY = 0;
            }
            applyZoom();
        });
    }
});

function openImageModal(index) {
    currentIndex = index;
    updateModalImage();
    const modal = new bootstrap.Modal(document.getElementById('imageModal'));
    modal.show();
}

function updateModalImage() {
    const modalImage = document.getElementById("modalImage");
    modalImage.src = allImages[currentIndex];
    document.getElementById("imageCounter").textContent = `${currentIndex + 1} / ${allImages.length}`;
    resetZoom();
}

function navigateModal(direction) {
    currentIndex = (currentIndex + direction + allImages.length) % allImages.length;
    updateModalImage();
}

// ---- ZOOM CONTROLS ----
function zoomIn() {
    zoomLevel += 0.2;
    applyZoom();
}
function zoomOut() {
    zoomLevel = Math.max(1, zoomLevel - 0.2);
    applyZoom();
}
function resetZoom() {
    zoomLevel = 1;
    translateX = 0;
    translateY = 0;
    applyZoom();
}
function applyZoom() {
    const modalImage = document.getElementById("modalImage");
    modalImage.style.transform = `scale(${zoomLevel}) translate(${translateX / zoomLevel}px, ${translateY / zoomLevel}px)`;
}

// ---- DRAG FUNCTIONALITY ----
function startDrag(e) {
    if (zoomLevel <= 1) return;
    isDragging = true;
    startX = e.clientX - translateX;
    startY = e.clientY - translateY;
}

function drag(e) {
    if (!isDragging) return;
    translateX = e.clientX - startX;
    translateY = e.clientY - startY;
    applyZoom();
}

function endDrag() {
    isDragging = false;
}

// Touch support for mobile
function startTouch(e) {
    if (zoomLevel <= 1) return;
    startX = e.touches[0].clientX - translateX;
    startY = e.touches[0].clientY - translateY;
}

function touchMove(e) {
    if (zoomLevel <= 1) return;
    translateX = e.touches[0].clientX - startX;
    translateY = e.touches[0].clientY - startY;
    applyZoom();
}

function endTouch() {}

// ---- MAIN SLIDER ARROWS ----
function scrollSlider2(direction) {
    const slider = document.getElementById("imageSlider2");
    slider.scrollBy({ left: direction * 400, behavior: "smooth" });
}
</script>

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
    let devineCurrentIndex = 0;
    let devineZoom = 1;
    const devineSlides = [];

    function scrollSlider(direction) {
        const slider = document.getElementById('imageSlider');
        const scrollAmount = 400;
        slider.scrollBy({
            left: direction * scrollAmount,
            behavior: 'smooth'
        });
    }

    function openImageModalForDevine(index) {
        // Reuse the shared Cleopatra modal with full zoom/pan/counter
        const imgs = Array.from(document.querySelectorAll('#imageSlider img'));
        allImages = imgs.map(img => img.src);
        currentIndex = index;
        updateModalImage();
        const modal = new bootstrap.Modal(document.getElementById('imageModal'));
        modal.show();
    }

    function closeImageModalForDevine() {
        const modal = bootstrap.Modal.getInstance(document.getElementById('devineImageModal'));
        modal.hide();
    }

    function nextImageDevine() {
        devineCurrentIndex = (devineCurrentIndex + 1) % devineSlides.length;
        document.getElementById('devineModalImage').src = "{{ asset('') }}" + devineSlides[devineCurrentIndex];
    }

    function prevImageDevine() {
        devineCurrentIndex = (devineCurrentIndex - 1 + devineSlides.length) % devineSlides.length;
        document.getElementById('devineModalImage').src = "{{ asset('') }}" + devineSlides[devineCurrentIndex];
    }

    function zoomInDevine() {
        devineZoom += 0.2;
        document.getElementById('devineModalImage').style.transform = `scale(${devineZoom})`;
    }

    function zoomOutDevine() {
        if (devineZoom > 0.4) {
            devineZoom -= 0.2;
            document.getElementById('devineModalImage').style.transform = `scale(${devineZoom})`;
        }
    }

    function resetZoomDevine() {
        devineZoom = 1;
        document.getElementById('devineModalImage').style.transform = `scale(1)`;
    }

    function toggleFullScreenDevine() {
        const modalImage = document.getElementById('devineModalImage');
        if (!document.fullscreenElement) {
            modalImage.requestFullscreen().catch(err => console.log(err));
        } else {
            document.exitFullscreen();
        }
    }
</script>




@endsection
