@php
    // $id: carousel id (string)
    // $images: array of ['src' => ..., 'alt' => ...]
    // Optionally, each image can have 'srcset' and 'sizes' for optimization
    $carouselId = $id ?? 'carousel-' . uniqid();
@endphp
<style>
    /* Make carousel arrows white and prominent for this carousel only */
    #{{ $carouselId }} .carousel-control-prev-icon,
    #{{ $carouselId }} .carousel-control-next-icon {
        filter: invert(1) brightness(200%) drop-shadow(0 0 2px rgba(0,0,0,0.6)) !important;
        width: 1.5rem !important;
        height: 1.5rem !important;
        background-size: 60% 60% !important;
        background-position: center !important;
    }
    /* Optional subtle dark circle for visibility on light images */
    #{{ $carouselId }} .carousel-control-prev,
    #{{ $carouselId }} .carousel-control-next {
        opacity: 1 !important;
        display: block !important;
        z-index: 30 !important;
        pointer-events: auto !important;
    }
    /* Hide carousel indicators (dots) for this carousel */
    #{{ $carouselId }} .carousel-indicators {
        display: none !important;
    }
</style>

@if(!empty($images) && is_array($images))
<div id="{{ $carouselId }}" class="carousel slide" data-bs-ride="false" style="max-width: 100%;">
    <div class="carousel-inner">
        @foreach($images as $idx => $img)
            <div class="carousel-item {{ $idx === 0 ? 'active' : '' }}">
                <img 
                    src="{{ $img['src'] }}" 
                    @if(isset($img['srcset'])) srcset="{{ $img['srcset'] }}" @endif
                    @if(isset($img['sizes'])) sizes="{{ $img['sizes'] }}" @else sizes="(max-width: 768px) 100vw, 600px" @endif
                    class="d-block w-100 img-fluid" 
                    alt="{{ $img['alt'] ?? '' }}" 
                    style="cursor: pointer;"
                    loading="lazy"
                    decoding="async"
                    onclick="openImageModal('{{ $carouselId }}', {{ $idx }})"
                >
            </div>
        @endforeach
    </div>
    @if(count($images) > 1)
        <button class="carousel-control-prev" type="button" data-bs-target="#{{ $carouselId }}" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#{{ $carouselId }}" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    @endif
</div>
@else
    <div class="text-center">
        <div class="border p-5">No images found for this carousel.</div>
    </div>
@endif