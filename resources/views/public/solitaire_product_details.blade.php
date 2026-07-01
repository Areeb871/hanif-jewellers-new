@extends('public.layouts.header_latest')

@section('content')
<link rel="stylesheet" href="{{ asset('assets/f_assets/css/details.css') }}?v={{ filemtime(public_path('assets/f_assets/css/details.css')) }}">
<script src="{{ asset('assets/f_assets/js/filter.js') }}?v={{ filemtime(public_path('assets/f_assets/js/filter.js')) }}" defer></script>
<section class="hj-product-detail-page">
<script>
document.addEventListener('DOMContentLoaded', function () {
    const viewers = document.querySelectorAll('.hj-360-viewer');

    viewers.forEach(function (viewer) {
        const img = viewer.querySelector('.hj-360-image');

        let currentFrame = 1;
        let isDragging = false;
        let isLoaded = false;
        let frameCount = 0;
        let folder = '';
        let extension = 'jpg';
        let frameInterval = 1000 / 12;
        let loadToken = 0;

        let lastX = 0;
        let dragAccumulator = 0;

        let autoDirection = 1;
        let lastAutoTime = performance.now();
        let rafId = null;

        /*
            Drag setting:
            Bigger = slower / smoother drag
            Smaller = faster drag
        */
        const pixelsPerFrame = 22;

        function getFramePath(frameNumber) {
            const padded = String(frameNumber).padStart(3, '0');
            return `${folder}frame_${padded}.${extension}`;
        }

        function normalizeFrame(frame) {
            if (frame > frameCount) return 1;
            if (frame < 1) return frameCount;
            return frame;
        }

        function setFrame(frameNumber) {
            if (!frameCount || !folder) return;

            currentFrame = normalizeFrame(frameNumber);
            img.src = getFramePath(currentFrame);
        }

        function nextFrame() {
            setFrame(currentFrame + 1);
        }

        function prevFrame() {
            setFrame(currentFrame - 1);
        }

        function preloadFrames(callback) {
            let loaded = 0;
            const token = ++loadToken;

            for (let i = 1; i <= frameCount; i++) {
                const preloadImg = new Image();

                preloadImg.onload = function () {
                    if (token !== loadToken) return;

                    loaded++;

                    if (loaded === frameCount) {
                        isLoaded = true;
                        viewer.classList.add('loaded');

                        if (callback) callback();
                    }
                };

                preloadImg.onerror = function () {
                    if (token !== loadToken) return;

                    console.warn('Missing or broken 360 frame:', preloadImg.src);

                    loaded++;

                    if (loaded === frameCount) {
                        isLoaded = true;
                        viewer.classList.add('loaded');

                        if (callback) callback();
                    }
                };

                preloadImg.src = getFramePath(i);
            }
        }

        function autoLoop(now) {
            if (!frameCount || !folder) {
                rafId = requestAnimationFrame(autoLoop);
                return;
            }

            if (!isLoaded) {
                rafId = requestAnimationFrame(autoLoop);
                return;
            }

            if (!isDragging) {
                const elapsed = now - lastAutoTime;

                if (elapsed >= frameInterval) {
                    /*
                        If browser was slow, do not jump many frames.
                        Move only one frame for luxury smooth feel.
                    */
                    if (autoDirection === 1) {
                        nextFrame();
                    } else {
                        prevFrame();
                    }

                    lastAutoTime = now;
                }
            } else {
                lastAutoTime = now;
            }

            rafId = requestAnimationFrame(autoLoop);
        }

        function startAuto() {
            if (!rafId) {
                lastAutoTime = performance.now();
                rafId = requestAnimationFrame(autoLoop);
            }
        }

        function loadFrames(config) {
            frameCount = parseInt(config.frame_count || config.frameCount || 0, 10);
            folder = config.folder_url || config.folder || '';
            extension = config.extension || 'jpg';
            frameInterval = 1000 / parseFloat(config.source_fps || config.sourceFps || 12);
            currentFrame = 1;
            isLoaded = false;

            if (!folder || !frameCount) {
                viewer.style.display = 'none';
                img.removeAttribute('src');
                loadToken++;
                return;
            }

            viewer.style.display = '';
            viewer.classList.remove('loaded');
            setFrame(1);
            preloadFrames(function () {
                setFrame(1);
            });
            startAuto();
        }

        loadFrames({
            folder: viewer.dataset.folder,
            frame_count: viewer.dataset.frameCount,
            extension: viewer.dataset.extension,
            source_fps: viewer.dataset.sourceFps
        });

        window.hjUpdate360Viewer = function (frames) {
            if (!frames) {
                loadFrames({});
                return;
            }

            const baseUrl = @json(url('/'));
            const folderUrl = frames.folder_url || (frames.folder ? baseUrl.replace(/\/$/, '') + '/' + String(frames.folder).replace(/^\/+/, '') + '/' : '');

            loadFrames({
                folder: folderUrl,
                frame_count: frames.frame_count,
                extension: frames.extension,
                source_fps: frames.source_fps
            });
        };

        viewer.addEventListener('pointerdown', function (e) {
            isDragging = true;
            lastX = e.clientX;
            dragAccumulator = 0;

            viewer.classList.add('dragging');

            if (viewer.setPointerCapture) {
                viewer.setPointerCapture(e.pointerId);
            }

            e.preventDefault();
        });

        viewer.addEventListener('pointermove', function (e) {
            if (!isDragging || !isLoaded) return;

            const diff = e.clientX - lastX;
            lastX = e.clientX;

            dragAccumulator += diff;

            while (Math.abs(dragAccumulator) >= pixelsPerFrame) {
                if (dragAccumulator > 0) {
                    /*
                        Drag right
                    */
                    prevFrame();
                    autoDirection = -1;
                    dragAccumulator -= pixelsPerFrame;
                } else {
                    /*
                        Drag left
                    */
                    nextFrame();
                    autoDirection = 1;
                    dragAccumulator += pixelsPerFrame;
                }
            }

            e.preventDefault();
        });

        function stopDrag(e) {
            if (!isDragging) return;

            isDragging = false;
            dragAccumulator = 0;
            lastAutoTime = performance.now();

            viewer.classList.remove('dragging');

            if (e && viewer.hasPointerCapture && viewer.hasPointerCapture(e.pointerId)) {
                viewer.releasePointerCapture(e.pointerId);
            }
        }

        viewer.addEventListener('pointerup', stopDrag);
        viewer.addEventListener('pointercancel', stopDrag);
        viewer.addEventListener('pointerleave', stopDrag);

        img.addEventListener('dragstart', function (e) {
            e.preventDefault();
        });
    });
});
</script>
<div class="hj-product-container">

     {{-- LEFT IMAGE GALLERY --}}
     <div class="hj-gallery-slider-wrap" id="hjGallerySliderWrap" data-mobile-view="gallery">
@php
    $metals = collect($product->metals ?? [])->values();
    $carats = collect($product->diamond_carats ?? [])->values();
    $variants = collect($product->variants ?? [])->values();
    $metalImages = collect($product->metal_images ?? [])->values();
    $galleryImages = collect($product->gallery_images ?? [])->values();

    $activeVariants = $variants->filter(function ($variant) {
        return !isset($variant['status'])
            || $variant['status'] === true
            || $variant['status'] === 1
            || $variant['status'] === '1';
    })->values();

    $firstMetal = $metals->first();
    $firstCarat = $carats->first();

    $selectedMetalCode = request('metal')
        ?: ($product->default_metal_code ?: data_get($firstMetal, 'code', ''));

    $selectedCarat = request('carat')
        ?: ($product->default_diamond_carat ?: data_get($firstCarat, 'value', ''));

    $selectedMetal = $metals->firstWhere('code', $selectedMetalCode) ?: $firstMetal;

    if ($selectedMetal) {
        $selectedMetalCode = $selectedMetal['code'] ?? '';
    }

    $selectedCaratIndex = $carats->search(function ($carat) use ($selectedCarat) {
        return number_format((float)($carat['value'] ?? 0), 2, '.', '') === number_format((float)$selectedCarat, 2, '.', '');
    });

    if ($selectedCaratIndex === false) {
        $selectedCaratIndex = 0;
        $selectedCarat = data_get($firstCarat, 'value', '');
    }

    $selectedVariant = $activeVariants->first(function ($variant) use ($selectedMetalCode, $selectedCarat) {
        return ($variant['metal_code'] ?? '') === $selectedMetalCode
            && number_format((float)($variant['diamond_carat'] ?? 0), 2, '.', '') === number_format((float)$selectedCarat, 2, '.', '');
    });

    /*
        Image condition:
        1. Selected metal images show first.
        2. If selected metal has no images, gallery images show.
        3. If gallery images are also empty, show no image message.
    */
    $selectedMetalImageGroup = $metalImages->firstWhere('metal_code', $selectedMetalCode);
    $detailImages = collect(data_get($selectedMetalImageGroup, 'images', []))
        ->sortBy(function ($image, $index) {
            return $image['sort_order'] ?? ($index + 1);
        })
        ->values();
    $selectedFrames = data_get($selectedMetalImageGroup, 'frames', []);
    $hasSelectedFrames = !empty(data_get($selectedFrames, 'frame_count'));

    if ($detailImages->isEmpty() && $galleryImages->isNotEmpty()) {
        $detailImages = $galleryImages
            ->sortBy(function ($image, $index) {
                return $image['sort_order'] ?? ($index + 1);
            })
            ->values();
    }

    $currency = $product->currency ?? 'AED';

    $formatMoney = function ($value) use ($currency) {
        if ($value === null || $value === '') {
            return '';
        }

        return $currency . ' ' . number_format((float)$value, 0);
    };

    /*
        Important:
        This is a closure variable, so use:
        $hjMetalClass($metal)
        Not:
        hjMetalClass($metal)
    */
    $detailData = [
        'name' => $product->name,
        'currency' => $currency,
        'metals' => $metals->toArray(),
        'carats' => $carats->toArray(),
        'variants' => $activeVariants->toArray(),
        'metal_images' => $metalImages->toArray(),
        'gallery_images' => $galleryImages->toArray(),
        'selected_metal_code' => $selectedMetalCode,
        'selected_carat_index' => (int) $selectedCaratIndex,
    ];
@endphp

<script type="application/json" id="hjDetailProductData">
    @json($detailData)
</script>


{{-- PRODUCT DETAIL GALLERY --}}
<div class="hj-product-gallery" id="hjProductGallery">
    <div class="hj-gallery-item hj-360-gallery-item" id="hj360GalleryItem" style="{{ $hasSelectedFrames ? '' : 'display:none;' }}">
        <div class="hj-360-viewer"
             id="hj360Viewer"
             style="{{ $hasSelectedFrames ? '' : 'display:none;' }}"
             data-folder="{{ !empty($selectedFrames['folder']) ? asset($selectedFrames['folder']) . '/' : '' }}"
             data-frame-count="{{ $selectedFrames['frame_count'] ?? 0 }}"
             data-extension="{{ $selectedFrames['extension'] ?? 'jpg' }}"
             data-source-fps="{{ $selectedFrames['source_fps'] ?? 12 }}">

            <img
                src="{{ !empty($selectedFrames['first_frame']) ? asset($selectedFrames['first_frame']) : '' }}"
                alt="360 Product View"
                class="hj-360-image"
                draggable="false"
            >

            <div class="hj-360-hint">
                <svg viewBox="0 0 40 32" aria-hidden="true">
                    <path d="M12.8 10.5c2-2.2 5.3-3.6 9-3.6 6.5 0 11.8 3.5 11.8 7.8s-5.3 7.8-11.8 7.8c-5.9 0-10.8-2.9-11.6-6.7" fill="none" stroke="currentColor" stroke-width="1.3" stroke-linecap="round"/>
                    <path d="m8.5 11.4 4.8-1.6-.8 5" fill="none" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/>
                    <ellipse cx="20" cy="16" rx="5.6" ry="3.2" fill="none" stroke="currentColor" stroke-width="1.1"/>
                    <path d="M19.5 6.2c.2-2 1.7-3.5 3.6-3.5 2 0 3.7 1.7 3.7 3.7" fill="none" stroke="currentColor" stroke-width="1.1" stroke-linecap="round"/>
                </svg>
                <span>Drag to spin</span>
            </div>
        </div>
    </div>

    @foreach($detailImages as $index => $image)
        <div class="hj-gallery-item hj-product-image-item">
            @if($index === 0)
                <span class="hj-badge">TRADE IN AVAILABLE</span>
            @endif

            <img 
                src="{{ asset($image['image_path']) }}" 
                alt="{{ $image['alt_text'] ?? $product->name }}"
            >
        </div>
    @endforeach

    @if($detailImages->isEmpty())
        <div class="hj-gallery-no-image">
            No images available for this metal.
        </div>
    @endif

</div>
    {{-- MOBILE SLIDER CONTROLS --}}
    <button type="button" class="hj-gallery-arrow" aria-label="Next image" id="hjGalleryNext">
    <img src="{{ asset('assets/f_assets/image/reviews/Vector.svg') }}" alt="Next" class="hj-gallery-arrow-img hj-arrow-right">
</button>
    <!-- <button type="button" class="hj-gallery-arrow" id="hjGalleryNext">›</button> -->

    <div class="hj-mobile-gallery-bottom">
        <div class="hj-gallery-tabs">
            <button
                type="button"
                class="hj-mobile-media-tab {{ $hasSelectedFrames ? 'active' : '' }}"
                id="hjMobileSpinTab"
                data-mobile-view="spin"
                aria-label="Spin"
                {{ $hasSelectedFrames ? '' : 'hidden' }}
            >
                <svg viewBox="0 0 24 24" aria-hidden="true">
                    <path d="M7.5 7.8c1.1-1 2.7-1.6 4.5-1.6 3.7 0 6.7 2.2 6.7 4.9S15.7 16 12 16c-3.3 0-6.1-1.8-6.6-4.1" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"/>
                    <path d="M5.1 8.4 7.7 7l-.3 3" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/>
                    <circle cx="12" cy="11.1" r="2.1" fill="none" stroke="currentColor" stroke-width="1.5"/>
                </svg>
            </button>

            <button
                type="button"
                class="hj-mobile-media-tab {{ $hasSelectedFrames ? '' : 'active' }}"
                id="hjMobileGalleryTab"
                data-mobile-view="gallery"
                aria-label="Gallery"
            >
                <svg viewBox="0 0 24 24" aria-hidden="true">
                    <rect x="4" y="5" width="16" height="14" rx="2" fill="none" stroke="currentColor" stroke-width="1.7"/>
                    <path d="m7 16 3.5-4 2.5 2.8 1.8-2.1L18 16" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/>
                    <circle cx="15.8" cy="9" r="1.2" fill="currentColor"/>
                </svg>
            </button>
        </div>

        <div class="hj-gallery-dots" id="hjGalleryDots"></div>
    </div>

</div>

      <aside class="hj-product-info">

    <div class="hj-product-top">

    <div class="hj-breadcrumb">
        <a href="{{ url('/') }}">Home</a>
        <span>/</span>
        <a href="{{ route('solitaire') }}">Solitaire Rings</a>
        <span>/</span>
        <span id="selectedMetalTitle">Solitaire Engagement Ring - {{ $selectedMetal['name'] ?? '14K White Gold' }}</span>
    </div>

    <h1>{{ $product->name ?? 'Julia Solitaire Ring' }}</h1>

    <p class="hj-sku">
        <span>SKU: {{ $product->sku ?? 'N/A' }}</span>
        <span class="hj-sku-sep" aria-hidden="true">|</span>
        <span>{{ $product->tag_label ?? 'N/A' }}</span>
        <span class="hj-sku-sep" aria-hidden="true">|</span>
        <span>Gemological certificate included</span>
    </p>

</div>
 {{-- OPTION CARD --}}
<div class="hj-option-card">

@php
    $getMetalColorClass = function ($metal) {
        $metalCode = strtolower($metal['code'] ?? '');
        $metalName = strtolower($metal['name'] ?? '');
        $metalTone = strtolower($metal['tone'] ?? '');

        $value = $metalCode . ' ' . $metalName . ' ' . $metalTone;

        if (str_contains($value, 'rose')) {
            return 'rose';
        }

        if (str_contains($value, 'yellow')) {
            return 'yellow';
        }

        if (str_contains($value, 'white')) {
            return 'white';
        }

        return 'white';
    };
@endphp

{{-- METAL --}}
<div class="hj-row hj-metal-row">
    <span class="hj-label">METAL</span>

    <div class="hj-metal-track-wrap">
        <div class="hj-metal-options" id="metalOptionsTrack">
            @foreach($metals as $metal)
                @php
                    $metalCode = $metal['code'] ?? '';
                    $metalColorClass = $getMetalColorClass($metal);
                @endphp

                <button 
                    type="button"
                    class="metal-chip {{ $metalColorClass }} {{ $metalCode === $selectedMetalCode ? 'active' : '' }}"
                    data-metal-code="{{ $metalCode }}"
                    aria-label="{{ $metal['name'] ?? $metal['short_label'] ?? 'Metal option' }}"
                    aria-pressed="{{ $metalCode === $selectedMetalCode ? 'true' : 'false' }}"
                >
                    {{ $metal['short_label'] ?? $metal['purity'] ?? '14K' }}
                </button>
            @endforeach
        </div>
    </div>

    <div class="hj-metal-btn-wrap">
        <span class="hj-value-badge" id="selectedMetalBtn" aria-live="polite">
            {{ strtoupper($selectedMetal['name'] ?? 'SELECT METAL') }}
        </span>
    </div>
</div>


    {{-- CARAT --}}
    <div class="hj-row hj-carat-row">
        <span class="hj-label">
            TOTAL CARAT
            <small id="caratPriceDiff"></small>
        </span>

        <div class="hj-middle hj-slider-box">
            <div class="hj-slider-text">
                <span>{{ data_get($carats->first(), 'label', '0.25') }} Carat</span>
                <span>{{ data_get($carats->last(), 'label', '1.00') }} Carat</span>
            </div>

            <input
                class="hj-range hj-carat-range"
                id="caratRange"
                type="range"
                min="0"
                max="{{ max($carats->count() - 1, 0) }}"
                step="1"
                value="{{ $selectedCaratIndex }}"
                aria-label="Total carat weight"
                aria-valuemin="0"
                aria-valuemax="{{ max($carats->count() - 1, 0) }}"
                aria-valuenow="{{ $selectedCaratIndex }}"
            >
        </div>

        <div class="hj-carat-btn-wrap">
            <span class="hj-value-badge" id="caratBtn" aria-live="polite">
                {{ strtoupper((data_get($carats[$selectedCaratIndex] ?? [], 'label', $selectedCarat)) . ' CARAT') }}
            </span>
        </div>
    </div>


  {{-- RING SIZE --}}
<div class="hj-ring-size-box" id="hjRingSizeBox">

    <div class="hj-ring-size-head">
        <button
            type="button"
            class="hj-ring-size-toggle"
            id="hjRingSizeToggle"
            aria-expanded="false"
            aria-haspopup="listbox"
            aria-controls="hjRingSizeDropdown"
        >
            <span id="hjRingSizeSelected" class="hj-ring-size-placeholder">Please select</span>
            <span class="hj-ring-size-arrow" aria-hidden="true">
    <svg width="18" height="18" viewBox="0 0 20 20" fill="currentColor">
        <path 
            fill-rule="evenodd" 
            d="M5.23 7.21a.75.75 0 011.06.02L10 10.94l3.71-3.71a.75.75 0 111.08 1.04l-4.25 4.25a.75.75 0 01-1.06 0L5.21 8.27a.75.75 0 01.02-1.06z" 
            clip-rule="evenodd">
        </path>
    </svg>
</span>
        </button>

        <button type="button" class="hj-ring-size-help" aria-label="Ring size help — opens size selector">
            Need help?
        </button>
    </div>

    <p class="hj-ring-size-error" id="hjRingSizeError" role="alert" hidden>Please select a ring size.</p>

    <div class="hj-ring-size-dropdown" id="hjRingSizeDropdown" role="listbox" aria-label="Ring sizes">
        @for($size = 4; $size <= 27; $size++)
            <button 
                type="button" 
                class="hj-ring-size-option"
                data-size="{{ $size }}"
                role="option"
                aria-selected="false"
            >
                {{ $size }}
            </button>
        @endfor
    </div>

    <input type="hidden" name="ring_size" id="hjRingSizeInput" value="">

</div>

</div>


{{-- ADD TO CART / PRICE ROW --}}
<form id="hjAddToCartForm">
    @csrf

    <input type="hidden" name="cart_type" value="solitaire">
    <input type="hidden" name="product_id" value="{{ $product->id }}">
    <input type="hidden" name="quantity" value="1">

    <input type="hidden" name="metal_code" id="cartMetalInput" value="{{ $selectedMetalCode ?? '' }}">
    <input type="hidden" name="diamond_carat" id="cartCaratInput" value="{{ $selectedCarat ?? '' }}">
    <input type="hidden" name="solitaire_ring_size" id="cartRingSizeInput" value="">
    <input type="hidden" name="inscription_text" id="cartInscriptionInput" value="">
    <input type="hidden" name="selected_image" id="cartSelectedImageInput" value="">


    <div class="hj-price-row">
        <div class="hj-price-left">
            <del id="detailOldPrice">
                {{ $selectedVariant && !empty($selectedVariant['old_price']) ? $formatMoney($selectedVariant['old_price']) : '' }}
            </del>

            <strong id="detailNewPrice">
                {{ $selectedVariant && !empty($selectedVariant['price']) ? $formatMoney($selectedVariant['price']) : 'Unavailable' }}
            </strong>

            <span id="detailSavingText">
                {{ $selectedVariant && !empty($selectedVariant['discount_percent']) ? 'You save ' . $selectedVariant['discount_percent'] . ' %' : '' }}
            </span>
        </div>

        <button type="submit" class="hj-cart-btn" id="hjCartSubmitBtn">
            ADD TO CART
        </button>
    </div>
</form>

<button type="button" class="hj-engraving" id="hjOpenInscription">
    <b>+</b>
    <span id="hjInscriptionBtnText">Add Free Inscription</span>
</button>

<input type="hidden" name="inscription_text" id="hjInscriptionHidden" value="">

<div class="hj-inscription-overlay" id="hjInscriptionOverlay"></div>

<div class="hj-inscription-modal" id="hjInscriptionModal">
    <div class="hj-inscription-box">

        <button type="button" class="hj-inscription-close" id="hjCloseInscription">
            ×
        </button>

        <h3>Add Free Inscription</h3>

        <p>Add a short personal message inside your ring.</p>

        <div class="hj-inscription-input-wrap">
            <input 
                type="text" 
                id="hjInscriptionInput" 
                maxlength="15" 
                placeholder="Enter text"
                autocomplete="off"
            >

            <span id="hjInscriptionCount">0/15</span>
        </div>

        <small class="hj-inscription-note">
            Maximum 15 characters allowed.
        </small>

        <div class="hj-inscription-actions">
            <button type="button" class="hj-inscription-cancel" id="hjCancelInscription">
                Cancel
            </button>

            <button type="button" class="hj-inscription-save" id="hjSaveInscription">
                Save
            </button>
        </div>

    </div>
</div>

<div class="hj-spec-card">

    <div class="hj-tabs">
        <button type="button" class="hj-tab-btn active" data-tab="main-stone">MAIN STONE</button>
        <button type="button" class="hj-tab-btn" data-tab="settings">SETTINGS</button>
    </div>

    <!-- MAIN STONE TAB -->
    <div class="hj-tab-panel active" id="main-stone">

        <div class="hj-spec-grid">

            <div class="hj-spec-item">
                <div class="hj-spec-head">
                    <small>Carat</small>
                    <button class="hj-help-btn" type="button">?</button>
                    <div class="hj-help-dropdown">Carat refers to the weight of the diamond.</div>
                </div>
   <strong id="selectedCaratSpec">
        {{ strtoupper((data_get($carats[$selectedCaratIndex] ?? [], 'label', $selectedCarat)) . ' CARAT') }}
    </strong>

                <span>Standard measure</span>
            </div>

            <div class="hj-spec-item">
                <div class="hj-spec-head">
                    <small>Color</small>
                    <button class="hj-help-btn" type="button">?</button>
                    <div class="hj-help-dropdown">Color shows how white or colorless the diamond appears.</div>
                </div>
                <strong>F</strong>
                <span>Exceptional Colorless Brilliance</span>
            </div>

            <div class="hj-spec-item">
                <div class="hj-spec-head">
                    <small>Clarity</small>
                    <button class="hj-help-btn" type="button">?</button>
                    <div class="hj-help-dropdown">Clarity shows how clean the diamond is.</div>
                </div>
                <strong>VS1</strong>
                <span>Perfectly Eye Clean</span>
            </div>

            <div class="hj-spec-item">
                <div class="hj-spec-head">
                    <small>Cut</small>
                    <button class="hj-help-btn" type="button">?</button>
                    <div class="hj-help-dropdown">Cut affects the brilliance and sparkle.</div>
                </div>
                <strong>EXCELLENT</strong>
                <span>Perfect brilliance</span>
            </div>

            <div class="hj-spec-item">
                <div class="hj-spec-head">
                    <small>Shape</small>
                    <button class="hj-help-btn" type="button">?</button>
                    <div class="hj-help-dropdown">Shape refers to the diamond outline.</div>
                </div>
                <strong>OVAL</strong>
                <span>Preferred style</span>
            </div>

            <div class="hj-spec-item">
                <div class="hj-spec-head">
                    <small>Stone Origin</small>
                    <button class="hj-help-btn" type="button">?</button>
                    <div class="hj-help-dropdown">{{ $product->tag_label }} stones are made in controlled conditions.</div>
                </div>
                <strong>{{ $product->tag_label}}</strong>
                <span>Gemstone perfection</span>
            </div>

        </div>

        <div class="hj-certificate">
            <img class="hj-certificate-logo"
                src="{{ asset('assets/f_assets/image/gem-cert.png') }}"
                alt="Hanif Jewellers logo">
            <div>
                <small>Certification</small>
                <strong>GEMOLOGICAL CERTIFICATE INCLUDED</strong>
                <p>Guaranteed authenticity</p>
            </div>
        </div>

    </div>

    <!-- SETTINGS TAB -->
    <div class="hj-tab-panel" id="settings">

        <div class="hj-spec-grid">

         @php
    $initialMetalName = data_get($selectedMetal, 'name', '18K GOLD');

    $initialMetalColor = data_get($selectedMetal, 'tone');

    if (!$initialMetalColor) {
        $metalNameForColor = strtolower($initialMetalName);

        if (str_contains($metalNameForColor, 'rose') || str_contains($metalNameForColor, 'pink')) {
            $initialMetalColor = 'Rose';
        } elseif (str_contains($metalNameForColor, 'yellow') || str_contains($metalNameForColor, 'gold')) {
            $initialMetalColor = 'Yellow';
        } elseif (str_contains($metalNameForColor, 'white') || str_contains($metalNameForColor, 'silver')) {
            $initialMetalColor = 'White';
        } elseif (str_contains($metalNameForColor, 'platinum')) {
            $initialMetalColor = 'Platinum';
        } else {
            $initialMetalColor = 'White';
        }
    }
@endphp

<div class="hj-spec-item">
    <div class="hj-spec-head">
        <small>Metal</small>
        <button class="hj-help-btn" type="button">?</button>
        <div class="hj-help-dropdown">Metal defines the ring material.</div>
    </div>

    <strong id="selectedMetalSpec">
        {{ strtoupper($initialMetalName) }}
    </strong>

    <span>Premium finish</span>
</div>

<div class="hj-spec-item">
    <div class="hj-spec-head">
        <small>Metal Color</small>
        <button class="hj-help-btn" type="button">?</button>
        <div class="hj-help-dropdown">The visible color tone of the ring.</div>
    </div>

    <strong id="selectedMetalColorSpec">
        {{ strtoupper($initialMetalColor) }}
    </strong>

    <span>Elegant appearance</span>
</div>

            <div class="hj-spec-item">
                <div class="hj-spec-head">
                    <small>Setting Type</small>
                    <button class="hj-help-btn" type="button">?</button>
                    <div class="hj-help-dropdown">Setting type holds the stone in place.</div>
                </div>
                <strong>SOLITAIRE</strong>
                <span>Classic style</span>
            </div>

            <div class="hj-spec-item">
                <div class="hj-spec-head">
                    <small>Prong Style</small>
                    <button class="hj-help-btn" type="button">?</button>
                    <div class="hj-help-dropdown">Prongs secure the diamond safely.</div>
                </div>
                <strong>4 PRONG</strong>
                <span>Secure diamond hold</span>
            </div>

            <div class="hj-spec-item">
                <div class="hj-spec-head">
                    <small>Band Style</small>
                    <button class="hj-help-btn" type="button">?</button>
                    <div class="hj-help-dropdown">Band style defines the ring profile.</div>
                </div>
                <strong>PLAIN BAND</strong>
                <span>Minimal design</span>
            </div>

            <div class="hj-spec-item">
                <div class="hj-spec-head">
                    <small>Ring Size</small>
                    <button class="hj-help-btn" type="button">?</button>
                    <div class="hj-help-dropdown">Ring size can be selected before order.</div>
                </div>
                <strong>CUSTOM</strong>
                <span>Made to fit</span>
            </div>

        </div>

        <div class="hj-certificate">
            <img class="hj-certificate-logo"
                src="{{ asset('assets/f_assets/image/gem-cert.png') }}"
                alt="Hanif Jewellers logo">
            <div>
                <small>Certification</small>
                <strong>GEMOLOGICAL CERTIFICATE INCLUDED</strong>
                <p>Guaranteed authenticity</p>
            </div>
        </div>

    </div>

</div>
<div class="hj-appointment-card">

    <div class="hj-avatars">
        <img src="{{ asset('assets/f_assets/image/avators/one.jpg') }}" alt="Expert">
        <img src="{{ asset('assets/f_assets/image/avators/one.jpg') }}" alt="Expert">
        <img src="{{ asset('assets/f_assets/image/avators/one.jpg') }}" alt="Expert">
        <span></span>
    </div>

    <div class="hj-appointment-top">
        <h4>SET A VIRTUAL APPOINTMENT</h4>
        <small>Free of charge</small>
    </div>

    <div class="hj-appointment-bottom">
        <p>
            Meet one of our experts who can help you Explore
            engagement rings, Diamonds and fine jewellery
            in person at your device
        </p>

        <a
            href="https://api.whatsapp.com/send?phone=923070222666&text={{ rawurlencode('Hello Hanif Jewellers, I would like to book an appointment.') }}"
            target="_blank"
            rel="noopener"
            aria-label="Book appointment on WhatsApp"
        >
            <svg viewBox="0 0 24 24" aria-hidden="true">
                <rect x="4" y="5" width="16" height="15" rx="2"></rect>
                <path d="M8 3v4M16 3v4M4 10h16"></path>
            </svg>
            BOOK APPOINTMENT
        </a>
    </div>

</div>
    
<div class="hj-accordion">

    <div class="hj-acc-item">
    <button type="button" class="hj-acc-btn">
    Why Choose Our Lab Created Engagement Rings?

    <span class="hj-acc-arrow">
        <svg width="16" height="16" viewBox="0 0 20 20" fill="currentColor">
            <path 
                fill-rule="evenodd" 
                d="M5.23 7.21a.75.75 0 011.06.02L10 10.94l3.71-3.71a.75.75 0 111.08 1.04l-4.25 4.25a.75.75 0 01-1.06 0L5.21 8.27a.75.75 0 01.02-1.06z" 
                clip-rule="evenodd">
            </path>
        </svg>
    </span>
</button>

        <div class="hj-acc-content">
            <p>
                Our lab created engagement rings offer exceptional brilliance, elegant craftsmanship, and excellent value while keeping the same luxury appearance.
            </p>
        </div>
    </div>

    <div class="hj-acc-item">
        <button type="button" class="hj-acc-btn">
    Why Choose Our Lab Created Engagement Rings?

    <span class="hj-acc-arrow">
        <svg width="16" height="16" viewBox="0 0 20 20" fill="currentColor">
            <path 
                fill-rule="evenodd" 
                d="M5.23 7.21a.75.75 0 011.06.02L10 10.94l3.71-3.71a.75.75 0 111.08 1.04l-4.25 4.25a.75.75 0 01-1.06 0L5.21 8.27a.75.75 0 01.02-1.06z" 
                clip-rule="evenodd">
            </path>
        </svg>
    </span>
</button>

        <div class="hj-acc-content">
            <p>
                We offer secure delivery and easy return support to make your shopping experience smooth and reliable.
            </p>
        </div>
    </div>

    <div class="hj-acc-item">
        <button type="button" class="hj-acc-btn">
    Why Choose Our Lab Created Engagement Rings?

    <span class="hj-acc-arrow">
        <svg width="16" height="16" viewBox="0 0 20 20" fill="currentColor">
            <path 
                fill-rule="evenodd" 
                d="M5.23 7.21a.75.75 0 011.06.02L10 10.94l3.71-3.71a.75.75 0 111.08 1.04l-4.25 4.25a.75.75 0 01-1.06 0L5.21 8.27a.75.75 0 01.02-1.06z" 
                clip-rule="evenodd">
            </path>
        </svg>
    </span>
</button>

        <div class="hj-acc-content">
            <p>
                Each ring is designed with attention to detail, premium finishing, and carefully selected stones for a refined appearance.
            </p>
        </div>
    </div>

    <div class="hj-acc-item">
       <button type="button" class="hj-acc-btn">
    Why Choose Our Lab Created Engagement Rings?

    <span class="hj-acc-arrow">
        <svg width="16" height="16" viewBox="0 0 20 20" fill="currentColor">
            <path 
                fill-rule="evenodd" 
                d="M5.23 7.21a.75.75 0 011.06.02L10 10.94l3.71-3.71a.75.75 0 111.08 1.04l-4.25 4.25a.75.75 0 01-1.06 0L5.21 8.27a.75.75 0 01.02-1.06z" 
                clip-rule="evenodd">
            </path>
        </svg>
    </span>
</button>

        <div class="hj-acc-content">
            <p>
                Our team will guide you with delivery, return, and after-sales support for a premium customer experience.
            </p>
        </div>
    </div>

</div>

            

        </aside>

    </div>


    

</section>
<div class="hj-details-lower-container">
<section class="hj-handcrafted-banner">
    <div class="hj-handcrafted-container">
        <div class="hj-handcrafted-hero">
            <picture>
                <source
                    media="(max-width: 768px)"
                    srcset="{{ asset('assets/f_assets/image/solitaire/mobile.png') }}">
                <img src="{{ asset('assets/f_assets/image/solitaire/desktop.png') }}"
                    alt="Timeless solitaire rings">
            </picture>

            <div class="hj-handcrafted-hero-content">
                <img class="hj-handcrafted-logo"
                    src="{{ asset('assets/f_assets/image/solitaire/emb1.png') }}"
                    alt="Hanif Jewellers">
                <h2>Timeless Styles, Made to Last</h2>
                <p>Each Piece Is A Celebration Of Your Love, Your<br> Life, And Everything In Between.</p>
            </div>
        </div>

        <div class="hj-handcrafted-experience">
            <div class="hj-handcrafted-image">
                <picture>
                    <source
                        media="(max-width: 768px)"
                        srcset="{{ asset('assets/f_assets/image/solitaire/mobile_latest_banner.png') }}">
                    <img src="{{ asset('assets/f_assets/image/solitaire/latest_banner.png') }}"
                        alt="Hanif Jewellers ring packaging">
                </picture>
            </div>

            <div class="hj-handcrafted-copy">
                <div>
                    <h3>We're committed to making your entire experience a pleasant one</h3>
                    <p>Every item we send comes in our signature Hanif packaging. The presentation box also secures your appraisal certificate and diamond grading report.</p>
                </div>

                <a href="{{ route('solitaire') }}">SHOP NOW</a>
            </div>
        </div>
    </div>
</section>
<section class="hj-lab-products-section">

    <div class="hj-lab-products-grid">

        @forelse($relatedProducts as $relatedProduct)

            @php
                $relatedMetals = collect($relatedProduct->metals ?? []);
                $relatedCarats = collect($relatedProduct->diamond_carats ?? []);
                $relatedVariants = collect($relatedProduct->variants ?? []);
                $relatedMetalImages = collect($relatedProduct->metal_images ?? []);
                $relatedGalleryImages = collect($relatedProduct->gallery_images ?? []);

                $defaultVariant = $relatedVariants->firstWhere('is_default', true) 
                    ?? $relatedVariants->first();

                $defaultMetalCode = $relatedProduct->default_metal_code
                    ?: ($defaultVariant['metal_code'] ?? ($relatedMetals->first()['code'] ?? ''));

                $defaultCarat = $relatedProduct->default_diamond_carat
                    ?: ($defaultVariant['diamond_carat'] ?? ($relatedCarats->first()['value'] ?? ''));

                $defaultMetal = $relatedMetals->firstWhere('code', $defaultMetalCode);

                $defaultMetalImageGroup = $relatedMetalImages->firstWhere('metal_code', $defaultMetalCode);

                // Only first image from metal_images
                $mainImage = data_get($defaultMetalImageGroup, 'images.0.image_path')
                    ?: data_get($relatedGalleryImages->toArray(), '0.image_path')
                    ?: null;

                $currency = $relatedProduct->currency ?? 'PKR';

                $oldPrice = $defaultVariant['old_price'] ?? null;
                $price = $defaultVariant['price'] ?? null;
                $discount = $defaultVariant['discount_percent'] ?? null;

                $formatMoney = function ($value) use ($currency) {
                    if ($value === null || $value === '') {
                        return '';
                    }

                    return $currency . ' ' . number_format((float) $value, 0);
                };

                $detailUrl = route('solitaire.details', $relatedProduct->slug);

                if ($defaultMetalCode) {
                    $detailUrl .= '?metal=' . urlencode($defaultMetalCode);

                    if ($defaultCarat) {
                        $detailUrl .= '&carat=' . urlencode($defaultCarat);
                    }
                }
            @endphp

            <a href="{{ $detailUrl }}" class="hj-lab-product-card">
                <div class="hj-lab-img-box">
                    <span class="hj-lab-tag">
                        {{ $relatedProduct->tag_label ?? 'Lab Created' }}
                    </span>

                    @if($mainImage)
                        <img 
                            src="{{ asset($mainImage) }}" 
                            alt="{{ $relatedProduct->name }}"
                        >
                    @else
                        <div class="hj-no-image">
                            No Image Available
                        </div>
                    @endif
                </div>

                <div class="hj-lab-product-info">
                    <h3>
                        {{ $relatedProduct->name }}
                    </h3>

                    <p>
                        {{ $defaultCarat ?: '0.25' }} Total Carat · {{ $relatedProduct->shape ?? 'N/A' }} · Solitaire · {{ $defaultMetal['name'] ?? '14K White Gold' }}
                    </p>

                    <div class="hj-lab-price-row">
                        @if($oldPrice)
                            <span class="hj-old-price">
                                {{ $formatMoney($oldPrice) }}
                            </span>
                        @endif

                        <span class="hj-new-price">
                            {{ $price ? $formatMoney($price) : 'Unavailable' }}
                        </span>

                        @if($discount)
                            <span class="hj-discount">
                                {{ $discount }}% off
                            </span>
                        @endif
                    </div>
                </div>
            </a>

        @empty

            <div class="alert alert-warning">
                No solitaire products found.
            </div>

        @endforelse

    </div>

</section>
@php
    $reviewCount = isset($reviews) ? $reviews->count() : 0;

    $reviewGalleryImages = collect();

    if(isset($reviews)) {
        foreach ($reviews as $review) {
            if (!empty($review->images)) {
                foreach ($review->images as $image) {
                    if (!empty($image['image_path'])) {
                        $reviewGalleryImages->push([
                            'image_path' => $image['image_path'],
                            'alt_text' => $image['alt_text'] ?? $review->title ?? 'Review Image',
                        ]);
                    }
                }
            }
        }
    }
@endphp

@php
    $reviewCount = isset($reviews) ? $reviews->count() : 0;

    $reviewGalleryImages = collect();

    if (isset($reviews)) {
        foreach ($reviews as $review) {
            if (!empty($review->images)) {
                foreach ($review->images as $image) {
                    if (!empty($image['image_path'])) {
                        $reviewGalleryImages->push([
                            'image_path' => $image['image_path'],
                            'alt_text' => $image['alt_text'] ?? $review->title ?? 'Review Image',
                        ]);
                    }
                }
            }
        }
    }
@endphp

<section class="hj-review-section">

    <div class="hj-review-container">

        {{-- TOP AREA --}}
        <div class="hj-review-top">

            {{-- SUMMARY --}}
            <div class="hj-review-summary">
                <h2>Reviews</h2>

                <div class="hj-rating-number">5.0</div>
                <div class="hj-rating-stars">★★★★★</div>

                <div class="hj-rating-count">
                    {{ $reviewCount }} {{ $reviewCount == 1 ? 'Review' : 'Reviews' }}
                </div>
            </div>

            {{-- GALLERY AREA --}}
            <div class="hj-review-gallery-area">

                <div class="hj-review-arrows">
                    <button type="button" class="hj-gallery-prev" aria-label="Previous image">
                        <img 
                            src="{{ asset('assets/f_assets/image/reviews/Icon.svg') }}" 
                            alt="Previous" 
                            class="hj-gallery-arrow-img hj-arrow-left"
                        >
                    </button>

                    <button type="button" class="hj-gallery-next" aria-label="Next image">
                        <img 
                            src="{{ asset('assets/f_assets/image/reviews/Vector.svg') }}" 
                            alt="Next" 
                            class="hj-gallery-arrow-img hj-arrow-right"
                        >
                    </button>
                </div>

                <div class="hj-review-gallery-viewport">
                    <div class="hj-review-gallery-track">

                        @forelse($reviewGalleryImages as $image)
                            <img 
                                src="{{ asset($image['image_path']) }}" 
                                alt="{{ $image['alt_text'] }}"
                            >
                        @empty
                            <p class="text-muted">No review images found.</p>
                        @endforelse

                    </div>
                </div>

            </div>

        </div>


        {{-- SORT --}}
        <div class="hj-review-sort">
            <button type="button">
                Sort: Highest Rating <span>⌄</span>
            </button>
        </div>


        {{-- REVIEW ITEMS --}}
        <div class="hj-review-list" id="hjReviewList">

            @forelse($reviews as $index => $review)

                <div 
                    class="hj-review-item hj-review-load-item"
                    style="{{ $index >= 3 ? 'display:none;' : '' }}"
                >

                    <div class="hj-review-text">
                        <h4>{{ $review->main_title ?? 'Customer' }}</h4>

                        <div class="hj-review-stars-small">★★★★★</div>

                        <h5>{{ $review->title ?? 'Review Title' }}</h5>

                        <p>
                            {{ $review->description ?? '' }}
                        </p>
                    </div>

                    <div class="hj-review-media">
                        <span>
                            {{ $review->created_at ? $review->created_at->format('F d, Y') : '' }}
                        </span>

                        <div class="hj-single-review-img">
                            @if(!empty($review->image))
                                <img 
                                    src="{{ asset($review->image) }}" 
                                    alt="{{ $review->title ?? 'Review Image' }}"
                                >
                            @elseif(!empty($review->images[0]['image_path']))
                                <img 
                                    src="{{ asset($review->images[0]['image_path']) }}" 
                                    alt="{{ $review->title ?? 'Review Image' }}"
                                >
                            @else
                                <div class="hj-no-image">
                                    No Image
                                </div>
                            @endif
                        </div>
                    </div>

                </div>

            @empty

                <div class="alert alert-warning">
                    No reviews found.
                </div>

            @endforelse

        </div>


        {{-- LOAD MORE --}}
        @if($reviews->count() > 3)
            <div class="hj-load-more" id="hjLoadMoreWrap">
                <button type="button" id="hjLoadMoreReviews">
                    Load More
                </button>
            </div>
        @endif

    </div>

</section>
<!-- <section class="hj-other-questions">
    <div class="hj-other-questions-inner">

        <h2>Other Questions?</h2>

        <p>We are here 24/7 to answer question you may have.</p>

        <div class="hj-question-actions">
 <a 
    href="https://wa.me/923070222666" 
    class="hj-question-btn" 
    target="_blank"
>
    LIVE CHAT
</a>
        </div>

    </div>
</section> -->

</div>
<section class="hj-footer-brand-strip" aria-label="Hanif Jewellers">
    <img
        src="{{ asset('assets/f_assets/image/solitaire/emb1.png') }}"
        alt="Hanif Jewellers"
    >
</section>
<script>
    /** Inscription Modal Script */
document.addEventListener('DOMContentLoaded', function () {
    const openBtn = document.getElementById('hjOpenInscription');
    const closeBtn = document.getElementById('hjCloseInscription');
    const cancelBtn = document.getElementById('hjCancelInscription');
    const saveBtn = document.getElementById('hjSaveInscription');

    const overlay = document.getElementById('hjInscriptionOverlay');
    const modal = document.getElementById('hjInscriptionModal');

    const input = document.getElementById('hjInscriptionInput');
    const count = document.getElementById('hjInscriptionCount');
    const hiddenInput = document.getElementById('hjInscriptionHidden');
    const btnText = document.getElementById('hjInscriptionBtnText');

    const maxLength = 15;

    if (!openBtn || !overlay || !modal || !input || !count || !hiddenInput || !btnText) {
        return;
    }

    function openModal() {
        input.value = hiddenInput.value || '';
        updateCount();

        overlay.classList.add('active');
        modal.classList.add('active');

        setTimeout(function () {
            input.focus();
        }, 100);
    }

    function closeModal() {
        overlay.classList.remove('active');
        modal.classList.remove('active');
    }

    function updateCount() {
        let value = input.value || '';

        if (value.length > maxLength) {
            value = value.substring(0, maxLength);
            input.value = value;
        }

        count.textContent = value.length + '/' + maxLength;
    }

    openBtn.addEventListener('click', openModal);

    if (closeBtn) {
        closeBtn.addEventListener('click', closeModal);
    }

    if (cancelBtn) {
        cancelBtn.addEventListener('click', closeModal);
    }

    overlay.addEventListener('click', closeModal);
    input.addEventListener('input', updateCount);

    saveBtn.addEventListener('click', function () {
        const value = input.value.trim();

        hiddenInput.value = value;

        if (value) {
            btnText.textContent = 'Inscription: ' + value;
        } else {
            btnText.textContent = 'Add Free Inscription';
        }

        closeModal();
    });

    document.addEventListener('keydown', function (event) {
        if (event.key === 'Escape') {
            closeModal();
        }
    });
});
</script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const accordionButtons = document.querySelectorAll('.hj-acc-btn');

    accordionButtons.forEach(function (button) {
        button.addEventListener('click', function () {
            const currentItem = this.closest('.hj-acc-item');

            if (!currentItem) return;

            document.querySelectorAll('.hj-acc-item').forEach(function (item) {
                if (item !== currentItem) {
                    item.classList.remove('active');
                }
            });

            currentItem.classList.toggle('active');
        });
    });
});
</script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const dataScript = document.getElementById('hjDetailProductData');
    const gallery = document.getElementById('hjProductGallery');

    if (!dataScript || !gallery) return;

    const data = JSON.parse(dataScript.textContent);
    const galleryWrap = document.getElementById('hjGallerySliderWrap');
    const spinItem = document.getElementById('hj360GalleryItem');
    const mobileSpinTab = document.getElementById('hjMobileSpinTab');
    const mobileGalleryTab = document.getElementById('hjMobileGalleryTab');
    const compactMediaQuery = window.matchMedia('(max-width: 991px)');

    let selectedMetalCode = data.selected_metal_code || '';
    let selectedCaratIndex = Number(data.selected_carat_index || 0);

    const caratRange = document.getElementById('caratRange');
    const caratBtn = document.getElementById('caratBtn');
    function applyCaratRangeBackground(rangeEl, caratCount) {
        if (!rangeEl) {
            return;
        }

        const baseBar = 'linear-gradient(to right, #303030 0%, #303030 100%)';

        if (!caratCount || caratCount <= 1) {
            rangeEl.style.background = baseBar;
            return;
        }

        const tickHalf = 0.35;
        const layers = [];

        for (let i = 1; i < caratCount; i++) {
            const pos = (i / (caratCount - 1)) * 100;
            const start = Math.max(0, pos - tickHalf);
            const end = Math.min(100, pos + tickHalf);

            layers.push(
                'linear-gradient(to right, transparent ' + start + '%, #ffffff ' + start + '%, #ffffff ' + end + '%, transparent ' + end + '%)'
            );
        }

        layers.push(baseBar);
        rangeEl.style.background = layers.join(', ');
    }

    applyCaratRangeBackground(caratRange, (data.carats || []).length);
    const selectedMetalBtn = document.getElementById('selectedMetalBtn');
    const selectedMetalTitle = document.getElementById('selectedMetalTitle');

    const selectedMetalSpec = document.getElementById('selectedMetalSpec');
    const selectedMetalColorSpec = document.getElementById('selectedMetalColorSpec');
    const selectedCaratSpec = document.getElementById('selectedCaratSpec');

    const oldPriceEl = document.getElementById('detailOldPrice');
    const newPriceEl = document.getElementById('detailNewPrice');
    const savingTextEl = document.getElementById('detailSavingText');
    const caratPriceDiffEl = document.getElementById('caratPriceDiff');

    function normalizeCarat(value) {
        const number = Number(value);
        return isNaN(number) ? String(value) : number.toFixed(2);
    }

    function makeAssetUrl(path) {
        if (!path) return '';

        if (path.startsWith('http') || path.startsWith('/')) {
            return path;
        }

        return window.location.origin + '/' + path;
    }

    function formatMoney(value) {
        if (value === null || value === undefined || value === '') {
            return '';
        }

        const number = Number(value);

        if (isNaN(number)) {
            return data.currency + ' ' + value;
        }

        return data.currency + ' ' + number.toLocaleString(undefined, {
            maximumFractionDigits: 0
        });
    }

    function getSelectedCarat() {
        return data.carats[selectedCaratIndex] || data.carats[0] || null;
    }

    function findMetal(metalCode) {
        return (data.metals || []).find(function (metal) {
            return String(metal.code) === String(metalCode);
        });
    }

    function findVariant(metalCode, caratValue) {
        return (data.variants || []).find(function (variant) {
            const status = variant.status === undefined
                || variant.status === true
                || variant.status === 1
                || variant.status === '1';

            return status
                && String(variant.metal_code) === String(metalCode)
                && normalizeCarat(variant.diamond_carat) === normalizeCarat(caratValue);
        });
    }

    function findBaseVariant(metalCode) {
        const firstCarat = data.carats[0];

        if (!firstCarat) return null;

        return findVariant(metalCode, firstCarat.value);
    }

    function getMetalColor(metal) {
        if (!metal) {
            return 'WHITE';
        }

        if (metal.tone) {
            return String(metal.tone).toUpperCase();
        }

        const metalText = String(metal.name || '').toLowerCase();

        if (metalText.includes('rose') || metalText.includes('pink')) {
            return 'ROSE';
        }

        if (metalText.includes('yellow')) {
            return 'YELLOW';
        }

        if (metalText.includes('white') || metalText.includes('silver')) {
            return 'WHITE';
        }

        if (metalText.includes('platinum')) {
            return 'PLATINUM';
        }

        if (metalText.includes('gold')) {
            return 'GOLD';
        }

        return 'WHITE';
    }

    function getMetalImages(metalCode) {
        const group = (data.metal_images || []).find(function (item) {
            return String(item.metal_code) === String(metalCode);
        });

        if (group && group.images && group.images.length > 0) {
            return group.images.slice().sort(function (a, b) {
                return Number(a.sort_order || 0) - Number(b.sort_order || 0);
            });
        }

        if (data.gallery_images && data.gallery_images.length > 0) {
            return data.gallery_images.slice().sort(function (a, b) {
                return Number(a.sort_order || 0) - Number(b.sort_order || 0);
            });
        }

        return [];
    }

    function getMetalFrames(metalCode) {
        const group = (data.metal_images || []).find(function (item) {
            return String(item.metal_code) === String(metalCode);
        });

        if (group && group.frames && group.frames.frame_count) {
            return group.frames;
        }

        return null;
    }

    function setMobileMediaView(view) {
        const hasSpin = mobileSpinTab && !mobileSpinTab.hidden;
        const nextView = view === 'spin' && hasSpin ? 'spin' : 'gallery';

        if (galleryWrap) {
            galleryWrap.dataset.mobileView = nextView;
        }

        if (mobileSpinTab) {
            mobileSpinTab.classList.toggle('active', nextView === 'spin');
        }

        if (mobileGalleryTab) {
            mobileGalleryTab.classList.toggle('active', nextView === 'gallery');
        }

        gallery.scrollLeft = 0;

        if (typeof window.hjInitGallerySlider === 'function') {
            window.hjInitGallerySlider();
        }
    }

    function syncSpinAvailability(frames) {
        const hasFrames = !!(frames && frames.frame_count);

        if (spinItem) {
            spinItem.style.display = hasFrames ? '' : 'none';
        }

        if (mobileSpinTab) {
            mobileSpinTab.hidden = !hasFrames;
        }

        if (compactMediaQuery.matches) {
            setMobileMediaView(hasFrames ? 'spin' : 'gallery');
        } else if (galleryWrap) {
            galleryWrap.dataset.mobileView = 'gallery';
        }
    }

    function renderGallery(metalCode) {
        const images = getMetalImages(metalCode);

        let html = '';

        if (!images || images.length === 0) {
            html = `
                <div class="hj-gallery-no-image">
                    No images available for this metal.
                </div>
            `;
        } else {
            images.forEach(function (image, index) {
                const imagePath = makeAssetUrl(image.image_path);

                html += `
                    <div class="hj-gallery-item hj-product-image-item">
                        ${index === 0 ? '<span class="hj-badge">TRADE IN AVAILABLE</span>' : ''}
                        <img 
                            src="${imagePath}" 
                            alt="${image.alt_text || data.name || 'Product image'}"
                        >
                    </div>
                `;
            });
        }

        gallery.querySelectorAll('.hj-product-image-item, .hj-gallery-no-image').forEach(function (item) {
            item.remove();
        });

        gallery.insertAdjacentHTML('beforeend', html);

        const cartSelectedImageInput = document.getElementById('cartSelectedImageInput');

        if (cartSelectedImageInput && images && images.length > 0 && images[0].image_path) {
            cartSelectedImageInput.value = String(images[0].image_path).replace(/^\/+/, '');
        }
    }

    function updateUrl() {
        const carat = getSelectedCarat();
        const url = new URL(window.location.href);

        if (selectedMetalCode) {
            url.searchParams.set('metal', selectedMetalCode);
        }

        if (carat && carat.value) {
            url.searchParams.set('carat', carat.value);
        }

        window.history.replaceState({}, '', url.toString());
    }

    function updateDetail(options) {
        const settings = Object.assign({
            refreshGallery: true,
            updateUrl: true,
            syncCaratRange: true,
        }, options || {});

        const metal = findMetal(selectedMetalCode);
        const carat = getSelectedCarat();

        if (!carat) return;

        const variant = findVariant(selectedMetalCode, carat.value);
        const baseVariant = findBaseVariant(selectedMetalCode);

        document.querySelectorAll('.metal-chip').forEach(function (btn) {
            const isActive = String(btn.dataset.metalCode) === String(selectedMetalCode);
            btn.classList.toggle('active', isActive);
            btn.setAttribute('aria-pressed', isActive ? 'true' : 'false');
        });

        if (settings.refreshGallery) {
            renderGallery(selectedMetalCode);

            const frames = getMetalFrames(selectedMetalCode);

            if (typeof window.hjUpdate360Viewer === 'function') {
                window.hjUpdate360Viewer(frames);
            }

            syncSpinAvailability(frames);

            if (typeof window.hjInitGallerySlider === 'function') {
                window.hjInitGallerySlider();
            }
        }

        const metalName = metal && metal.name
            ? metal.name
            : selectedMetalCode;

        const metalColor = getMetalColor(metal);

        if (selectedMetalBtn) {
            selectedMetalBtn.textContent = metalName.toUpperCase();
        }

        if (selectedMetalTitle) {
            selectedMetalTitle.textContent = 'Solitaire Engagement Ring - ' + metalName;
        }

        if (selectedMetalSpec) {
            selectedMetalSpec.textContent = metalName.toUpperCase();
        }

        if (selectedMetalColorSpec) {
            selectedMetalColorSpec.textContent = metalColor;
        }

        if (settings.syncCaratRange && caratRange) {
            caratRange.value = String(selectedCaratIndex);
        }

        if (caratRange) {
            caratRange.setAttribute('aria-valuenow', String(selectedCaratIndex));
            caratRange.setAttribute(
                'aria-valuetext',
                String((carat.label || carat.value) + ' carat')
            );
        }

        if (caratBtn) {
            caratBtn.textContent = String((carat.label || carat.value) + ' CARAT').toUpperCase();
        }

        if (selectedCaratSpec) {
            selectedCaratSpec.textContent = String((carat.label || carat.value) + ' CARAT').toUpperCase();
        }

        if (variant) {
            if (oldPriceEl) {
                oldPriceEl.textContent = variant.old_price
                    ? formatMoney(variant.old_price)
                    : '';
            }

            if (newPriceEl) {
                newPriceEl.textContent = variant.price
                    ? formatMoney(variant.price)
                    : 'Unavailable';
            }

            if (savingTextEl) {
                savingTextEl.textContent = variant.discount_percent
                    ? 'You save ' + variant.discount_percent + ' %'
                    : '';
            }

            if (caratPriceDiffEl) {
                let priceDifferenceText = '';

                if (baseVariant && variant.price && baseVariant.price) {
                    const diff = Number(variant.price) - Number(baseVariant.price);

                    priceDifferenceText = diff === 0
                        ? ''
                        : (diff > 0 ? '+' : '-') + formatMoney(Math.abs(diff));
                }

                caratPriceDiffEl.textContent = priceDifferenceText;
            }
        } else {
            if (oldPriceEl) oldPriceEl.textContent = '';
            if (newPriceEl) newPriceEl.textContent = 'Unavailable';
            if (savingTextEl) savingTextEl.textContent = '';
            if (caratPriceDiffEl) caratPriceDiffEl.textContent = '';
        }

        const cartMetalInput = document.getElementById('cartMetalInput');
        const cartCaratInput = document.getElementById('cartCaratInput');

        if (cartMetalInput) {
            cartMetalInput.value = selectedMetalCode;
        }

        if (cartCaratInput && carat.value) {
            cartCaratInput.value = carat.value;
        }

        if (settings.updateUrl) {
            updateUrl();
        }

    }

    function snapCaratRangeToPointer(rangeEl, clientX) {
        const max = Number(rangeEl.max) || 0;

        if (max <= 0) {
            return;
        }

        const rect = rangeEl.getBoundingClientRect();
        const ratio = Math.min(1, Math.max(0, (clientX - rect.left) / rect.width));
        const index = Math.round(ratio * max);

        if (Number(rangeEl.value) !== index) {
            rangeEl.value = String(index);
            selectedCaratIndex = index;
            updateDetail({
                refreshGallery: false,
                updateUrl: false,
                syncCaratRange: false,
            });
        }
    }

    document.querySelectorAll('.metal-chip').forEach(function (btn) {
        btn.addEventListener('click', function (e) {
            e.preventDefault();

            selectedMetalCode = this.dataset.metalCode;
            updateDetail();
        });
    });

    if (mobileSpinTab) {
        mobileSpinTab.addEventListener('click', function () {
            setMobileMediaView('spin');
        });
    }

    if (mobileGalleryTab) {
        mobileGalleryTab.addEventListener('click', function () {
            setMobileMediaView('gallery');
        });
    }

    compactMediaQuery.addEventListener('change', function () {
        syncSpinAvailability(getMetalFrames(selectedMetalCode));
    });

    if (caratRange) {
        caratRange.addEventListener('input', function () {
            selectedCaratIndex = Number(this.value);
            updateDetail({
                refreshGallery: false,
                updateUrl: false,
                syncCaratRange: false,
            });
        });

        caratRange.addEventListener('change', function () {
            selectedCaratIndex = Number(this.value);
            updateDetail({
                refreshGallery: false,
                updateUrl: true,
                syncCaratRange: false,
            });
        });

        caratRange.addEventListener('pointerdown', function (event) {
            if (event.button !== 0) {
                return;
            }

            snapCaratRangeToPointer(this, event.clientX);
        });
    }

    updateDetail();
});
</script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.hj-acc-item button').forEach(function (button) {
        button.addEventListener('click', function () {
            const currentItem = this.closest('.hj-acc-item');

            document.querySelectorAll('.hj-acc-item').forEach(function (item) {
                if (item !== currentItem) {
                    item.classList.remove('active');
                }
            });

            currentItem.classList.toggle('active');
        });
    });
});
</script>
<script>
document.addEventListener('DOMContentLoaded', function () {

    /*
    |--------------------------------------------------------------------------
    | RING SIZE SELECTION
    |--------------------------------------------------------------------------
    */

    const sizeBox = document.getElementById('hjRingSizeBox');
    const sizeToggle = document.getElementById('hjRingSizeToggle');
    const sizeSelected = document.getElementById('hjRingSizeSelected');
    const sizeError = document.getElementById('hjRingSizeError');
    const sizeHelp = document.querySelector('.hj-ring-size-help');

    const mainRingSizeInput = document.getElementById('hjRingSizeInput');
    const cartRingSizeInput = document.getElementById('cartRingSizeInput');

    const sizeOptions = document.querySelectorAll('.hj-ring-size-option');

    function setRingSizeOpen(isOpen) {
        if (!sizeBox) return;
        sizeBox.classList.toggle('active', isOpen);
        if (sizeToggle) {
            sizeToggle.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
        }
    }

    function clearRingSizeError() {
        if (sizeBox) {
            sizeBox.classList.remove('is-invalid');
        }
        if (sizeError) {
            sizeError.hidden = true;
        }
    }

    function showRingSizeError() {
        if (sizeBox) {
            sizeBox.classList.add('is-invalid');
        }
        if (sizeError) {
            sizeError.hidden = false;
        }
    }

    if (sizeToggle && sizeBox) {
        sizeToggle.addEventListener('click', function (event) {
            event.stopPropagation();
            setRingSizeOpen(!sizeBox.classList.contains('active'));
        });
    }

    if (sizeHelp && sizeBox) {
        sizeHelp.addEventListener('click', function (event) {
            if (!window.matchMedia('(max-width: 991px)').matches) return;

            event.preventDefault();
            event.stopPropagation();
            setRingSizeOpen(!sizeBox.classList.contains('active'));
        });
    }

    sizeOptions.forEach(function (option) {
        option.addEventListener('click', function (event) {
            event.preventDefault();
            event.stopPropagation();

            const selectedSize = this.getAttribute('data-size');

            if (!selectedSize) return;

            if (sizeSelected) {
                sizeSelected.textContent = selectedSize;
                sizeSelected.classList.remove('hj-ring-size-placeholder');
            }

            if (mainRingSizeInput) {
                mainRingSizeInput.value = selectedSize;
            }

            if (cartRingSizeInput) {
                cartRingSizeInput.value = selectedSize;
            }

            sizeOptions.forEach(function (btn) {
                btn.classList.remove('active');
                btn.setAttribute('aria-selected', 'false');
            });

            this.classList.add('active');
            this.setAttribute('aria-selected', 'true');

            clearRingSizeError();
            setRingSizeOpen(false);
        });
    });

    document.addEventListener('click', function (event) {
        if (sizeBox && !sizeBox.contains(event.target)) {
            setRingSizeOpen(false);
        }
    });


    /*
    |--------------------------------------------------------------------------
    | SELECTED IMAGE HANDLING
    |--------------------------------------------------------------------------
    */

    function cleanImagePath(value) {
        if (!value) return '';

        value = value.replace(window.location.origin + '/', '');
        value = value.replace(/^\/+/, '');

        return value;
    }

    function setSelectedCartImage(imagePath) {
        const cartSelectedImageInput = document.getElementById('cartSelectedImageInput');

        if (!cartSelectedImageInput || !imagePath) return;

        cartSelectedImageInput.value = cleanImagePath(imagePath);
    }

    function syncCurrentMainImage() {
        const mainImage =
            document.querySelector('#hjProductGallery .hj-gallery-item img') ||
            document.getElementById('mainSolitaireImage') ||
            document.getElementById('mainProductImage') ||
            document.getElementById('hjMainSolitaireImage') ||
            document.querySelector('.hj-main-image img') ||
            document.querySelector('.product-main-image img');

        if (mainImage && mainImage.getAttribute('src')) {
            setSelectedCartImage(mainImage.getAttribute('src'));
        }
    }


    /*
    |--------------------------------------------------------------------------
    | GALLERY IMAGE CLICK
    |--------------------------------------------------------------------------
    */

    document.addEventListener('click', function (event) {
        const imageElement = event.target.closest('[data-image], [data-image-path]');

        if (!imageElement) return;

        const selectedImage =
            imageElement.getAttribute('data-image') ||
            imageElement.getAttribute('data-image-path') ||
            imageElement.getAttribute('src') ||
            '';

        if (selectedImage) {
            setSelectedCartImage(selectedImage);
        }
    });


    /*
    |--------------------------------------------------------------------------
    | METAL SELECTION
    |--------------------------------------------------------------------------
    */

    document.addEventListener('click', function (event) {
        const metalElement = event.target.closest('[data-metal-code], .metal-chip');

        if (!metalElement) return;

        const cartMetalInput = document.getElementById('cartMetalInput');

        const metalCode =
            metalElement.getAttribute('data-metal-code') ||
            metalElement.getAttribute('data-metal') ||
            metalElement.value ||
            '';

        if (cartMetalInput && metalCode) {
            cartMetalInput.value = metalCode;
        }

        const metalImage =
            metalElement.getAttribute('data-first-image') ||
            metalElement.getAttribute('data-image') ||
            metalElement.getAttribute('data-image-path') ||
            '';

        if (metalImage) {
            setSelectedCartImage(metalImage);
        } else {
            setTimeout(syncCurrentMainImage, 200);
        }
    });


    /*
    |--------------------------------------------------------------------------
    | ADD TO CART FORM
    |--------------------------------------------------------------------------
    */

    const form = document.getElementById('hjAddToCartForm');
    const cartSubmitBtn = document.getElementById('hjCartSubmitBtn');

    if (!form) return;

    form.addEventListener('submit', function (event) {
        event.preventDefault();

        if (cartSubmitBtn && cartSubmitBtn.disabled) {
            return;
        }

        const ringSizeMain = document.getElementById('hjRingSizeInput');
        const inscriptionMain = document.getElementById('hjInscriptionHidden');

        const cartMetal = document.getElementById('cartMetalInput');
        const cartCarat = document.getElementById('cartCaratInput');
        const cartRingSize = document.getElementById('cartRingSizeInput');
        const cartInscription = document.getElementById('cartInscriptionInput');
        const cartSelectedImage = document.getElementById('cartSelectedImageInput');

        if (cartRingSize && ringSizeMain) {
            cartRingSize.value = ringSizeMain.value || '';
        }

        if (cartInscription && inscriptionMain) {
            cartInscription.value = inscriptionMain.value || '';
        }

        if (cartSelectedImage && !cartSelectedImage.value) {
            syncCurrentMainImage();
        }

        if (!cartMetal || !cartMetal.value) {
            showToast('error', 'Please select metal.');
            return;
        }

        if (!cartCarat || !cartCarat.value) {
            showToast('error', 'Please select carat.');
            return;
        }

        if (!cartRingSize || !cartRingSize.value) {
            showRingSizeError();
            showToast('error', 'Please select ring size.');
            if (sizeToggle) {
                sizeToggle.focus();
            }
            return;
        }

        clearRingSizeError();

        const formData = new FormData(form);
        const defaultCartLabel = cartSubmitBtn ? cartSubmitBtn.textContent : 'ADD TO CART';

        if (cartSubmitBtn) {
            cartSubmitBtn.disabled = true;
            cartSubmitBtn.textContent = 'ADDING...';
            cartSubmitBtn.setAttribute('aria-busy', 'true');
        }

        fetch("{{ route('cart.add') }}", {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': form.querySelector('input[name="_token"]').value,
                'Accept': 'application/json'
            },
            body: formData
        })
        .then(async response => {
            const data = await response.json();

            if (!response.ok) {
                throw data;
            }

            return data;
        })
        .then(data => {
            showToast('success', data.message || 'Added to cart successfully.');

            if (data.success) {
                setTimeout(() => {
                    window.location.href = "{{ url('/cart') }}";
                }, 800);
            }
        })
        .catch(function (error) {
            showToast('error', error.message || 'Something went wrong. Please try again.');
        })
        .finally(function () {
            if (cartSubmitBtn) {
                cartSubmitBtn.disabled = false;
                cartSubmitBtn.textContent = defaultCartLabel;
                cartSubmitBtn.removeAttribute('aria-busy');
            }
        });
    });


    /*
    |--------------------------------------------------------------------------
    | DEFAULT IMAGE ON PAGE LOAD
    |--------------------------------------------------------------------------
    */

    setTimeout(syncCurrentMainImage, 500);

});
</script>
@endsection
