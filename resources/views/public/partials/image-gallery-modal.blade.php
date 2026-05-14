<!-- ================= IMAGE GALLERY MODAL START ================= -->

<!-- IMAGE MODAL -->
<div class="modal fade" id="imageModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen image-modal-dialog">
        <div class="modal-content image-modal-content border-0">

            <button
                type="button"
                class="btn-close btn-close-white image-modal-close"
                data-bs-dismiss="modal"
                aria-label="Close">
            </button>

            <div class="modal-body image-modal-body">

                <div class="image-stage">
                    <img id="modalImage" src="" alt="" class="image-modal-img" draggable="false">
                </div>

                <button id="modalPrev" class="image-nav image-nav-prev" type="button" onclick="navigateModal(-1)">
                    <i class="fas fa-chevron-left"></i>
                </button>

                <button id="modalNext" class="image-nav image-nav-next" type="button" onclick="navigateModal(1)">
                    <i class="fas fa-chevron-right"></i>
                </button>

                <div class="image-zoom-controls">
                    <button type="button" class="btn btn-dark btn-sm" onclick="zoomIn()" title="Zoom In">
                        <i class="fas fa-plus"></i>
                    </button>
                    <button type="button" class="btn btn-dark btn-sm" onclick="zoomOut()" title="Zoom Out">
                        <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-dark btn-sm" onclick="resetZoom()" title="Reset Zoom">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </button>
                </div>

                <div class="image-counter-wrap">
                    <span id="imageCounter" class="badge bg-dark bg-opacity-75 text-white px-3 py-2"></span>
                </div>

            </div>
        </div>
    </div>
</div>

<style>
#imageModal {
    background: rgba(0, 0, 0, 0.94);
    z-index: 999999 !important;
}

.modal-backdrop.show {
    opacity: 0.92 !important;
    z-index: 999998 !important;
}

#imageModal .modal-dialog {
    margin: 0;
    max-width: 100%;
    width: 100%;
    height: 100%;
}

.image-modal-content {
    background: transparent;
    height: 100vh;
    min-height: 100vh;
    border: 0;
    position: relative;
}

.image-modal-body {
    position: relative;
    width: 100%;
    height: 100vh;
    overflow: hidden;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 60px 90px;
}

.image-stage {
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
    touch-action: none;
    position: relative;
    z-index: 2;
}

.image-modal-img {
    max-width: 88vw;
    max-height: 86vh;
    width: auto;
    height: auto;
    object-fit: contain;
    user-select: none;
    -webkit-user-drag: none;
    cursor: grab;
    will-change: transform;
    transition: transform 0.05s linear;
    display: block;
}

.image-modal-close {
    position: absolute;
    top: 22px;
    right: 22px;
    z-index: 1000001 !important;
    background-size: 1.1rem;
    opacity: 1;
    padding: 12px;
    border-radius: 50%;
    background-color: rgba(0, 0, 0, 0.45);
}

.image-nav {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    z-index: 1000000 !important;
    background: rgba(0, 0, 0, 0.45);
    color: #fff;
    border: 0;
    width: 56px;
    height: 56px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.25s ease;
}

.image-nav:hover {
    background: rgba(0, 0, 0, 0.75);
    color: #fff;
}

.image-nav i {
    font-size: 18px;
    pointer-events: none;
}

.image-nav-prev {
    left: 24px;
}

.image-nav-next {
    right: 24px;
}

.image-zoom-controls {
    position: absolute;
    top: 22px;
    right: 78px;
    z-index: 1000000 !important;
    display: flex;
    flex-direction: column;
    gap: 8px;
}

.image-zoom-controls .btn {
    min-width: 38px;
    min-height: 38px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.image-counter-wrap {
    position: absolute;
    bottom: 18px;
    left: 50%;
    transform: translateX(-50%);
    z-index: 1000000 !important;
}

/* KEEP OLD CLASS NAMES */
.gallery-image,
#heritageGalleryTop img,
#heritageGalleryBottom img,
#heritageHighlightCarousel img {
    cursor: pointer !important;
}

@media (max-width: 991px) {
    .image-modal-body {
        padding: 70px 20px 30px;
    }

    .image-modal-img {
        max-width: 94vw;
        max-height: 78vh;
    }

    .image-modal-close {
        top: 14px;
        right: 14px;
    }

    .image-zoom-controls {
        top: 14px;
        right: 56px;
        gap: 6px;
    }

    .image-nav {
        width: 46px;
        height: 46px;
    }

    .image-nav-prev {
        left: 10px;
    }

    .image-nav-next {
        right: 10px;
    }
}

body.image-modal-open header,
body.image-modal-open .site-header,
body.image-modal-open .navbar,
body.image-modal-open .main-header {
    z-index: 1 !important;
}
</style>

<script>
let currentModalImages = [];
let currentModalAlts = [];
let currentModalIndex = 0;

let currentZoom = 1;
let isDragging = false;
let startX = 0;
let startY = 0;
let translateX = 0;
let translateY = 0;
let lastTouchDistance = 0;

const imageModalEl = document.getElementById('imageModal');
const modalImage = document.getElementById('modalImage');
const imageCounter = document.getElementById('imageCounter');

function openImageModal(carouselId, imageIndex = 0) {
    const carousel = document.getElementById(carouselId);
    if (!carousel) return;

    const images = carousel.querySelectorAll('img');
    if (!images.length) return;

    currentModalImages = Array.from(images).map(img => img.src);
    currentModalAlts = Array.from(images).map(img => img.alt || '');
    currentModalIndex = imageIndex;

    updateModalImage();
    resetZoom();

    const modal = new bootstrap.Modal(imageModalEl);
    modal.show();
}

function updateModalImage() {
    if (!currentModalImages.length) return;

    modalImage.src = currentModalImages[currentModalIndex];
    modalImage.alt = currentModalAlts[currentModalIndex] || '';
    imageCounter.textContent = `${currentModalIndex + 1} / ${currentModalImages.length}`;
}

function navigateModal(direction) {
    if (!currentModalImages.length) return;

    currentModalIndex += direction;

    if (currentModalIndex < 0) {
        currentModalIndex = currentModalImages.length - 1;
    } else if (currentModalIndex >= currentModalImages.length) {
        currentModalIndex = 0;
    }

    updateModalImage();
    resetZoom();
}

function applyTransform() {
    modalImage.style.transform = `translate(${translateX}px, ${translateY}px) scale(${currentZoom})`;
    modalImage.style.cursor = currentZoom > 1 ? (isDragging ? 'grabbing' : 'grab') : 'default';
}

function zoomIn() {
    currentZoom = Math.min(currentZoom + 0.2, 5);
    applyTransform();
}

function zoomOut() {
    currentZoom = Math.max(currentZoom - 0.2, 1);

    if (currentZoom === 1) {
        translateX = 0;
        translateY = 0;
    }

    applyTransform();
}

function resetZoom() {
    currentZoom = 1;
    translateX = 0;
    translateY = 0;
    isDragging = false;
    applyTransform();
}

function getTouchDistance(t1, t2) {
    const dx = t1.clientX - t2.clientX;
    const dy = t1.clientY - t2.clientY;
    return Math.sqrt(dx * dx + dy * dy);
}

modalImage.addEventListener('mousedown', function(e) {
    if (currentZoom <= 1) return;
    isDragging = true;
    startX = e.clientX - translateX;
    startY = e.clientY - translateY;
    applyTransform();
});

window.addEventListener('mousemove', function(e) {
    if (!isDragging || currentZoom <= 1) return;
    e.preventDefault();
    translateX = e.clientX - startX;
    translateY = e.clientY - startY;
    applyTransform();
});

window.addEventListener('mouseup', function() {
    isDragging = false;
    applyTransform();
});

modalImage.addEventListener('touchstart', function(e) {
    if (e.touches.length === 1 && currentZoom > 1) {
        isDragging = true;
        startX = e.touches[0].clientX - translateX;
        startY = e.touches[0].clientY - translateY;
    } else if (e.touches.length === 2) {
        isDragging = false;
        lastTouchDistance = getTouchDistance(e.touches[0], e.touches[1]);
    }
}, { passive: false });

modalImage.addEventListener('touchmove', function(e) {
    if (e.touches.length === 1 && isDragging && currentZoom > 1) {
        e.preventDefault();
        translateX = e.touches[0].clientX - startX;
        translateY = e.touches[0].clientY - startY;
        applyTransform();
    } else if (e.touches.length === 2) {
        e.preventDefault();
        const newDistance = getTouchDistance(e.touches[0], e.touches[1]);
        const scaleChange = newDistance / lastTouchDistance;
        currentZoom = Math.min(Math.max(currentZoom * scaleChange, 1), 5);
        lastTouchDistance = newDistance;
        applyTransform();
    }
}, { passive: false });

modalImage.addEventListener('touchend', function() {
    isDragging = false;
});

modalImage.addEventListener('wheel', function(e) {
    if (!imageModalEl.classList.contains('show')) return;
    e.preventDefault();

    if (e.deltaY < 0) {
        zoomIn();
    } else {
        zoomOut();
    }
}, { passive: false });

document.addEventListener('keydown', function(e) {
    if (!imageModalEl.classList.contains('show')) return;

    if (e.key === 'ArrowLeft') {
        navigateModal(-1);
    } else if (e.key === 'ArrowRight') {
        navigateModal(1);
    } else if (e.key === 'Escape') {
        const modalInstance = bootstrap.Modal.getInstance(imageModalEl);
        if (modalInstance) modalInstance.hide();
    } else if (e.key === '+' || e.key === '=') {
        zoomIn();
    } else if (e.key === '-') {
        zoomOut();
    } else if (e.key === '0') {
        resetZoom();
    }
});

imageModalEl.addEventListener('hidden.bs.modal', function() {
    resetZoom();
    modalImage.src = '';
});

document.addEventListener('shown.bs.modal', function (event) {
    if (event.target.id === 'imageModal') {
        document.body.classList.add('image-modal-open');
    }
});

document.addEventListener('hidden.bs.modal', function (event) {
    if (event.target.id === 'imageModal') {
        document.body.classList.remove('image-modal-open');
    }
});
</script>