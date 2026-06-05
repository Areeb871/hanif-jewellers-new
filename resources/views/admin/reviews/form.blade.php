@php
    $galleryImages = $review->images ?? [];
@endphp

@if ($errors->any())
    <div class="alert alert-danger">
        <strong>Please fix these errors:</strong>

        <ul class="mb-0 mt-2">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="card mb-4">
    <div class="card-header">
        Review Details
    </div>

    <div class="card-body">

        <div class="mb-3">
            <label>Main Title</label>
            <input 
                type="text" 
                name="main_title" 
                class="form-control" 
                value="{{ old('main_title', $review->main_title) }}"
                placeholder="Customer Reviews"
            >
        </div>

        <div class="mb-3">
            <label>Title</label>
            <input 
                type="text" 
                name="title" 
                class="form-control" 
                value="{{ old('title', $review->title) }}"
                placeholder="Excellent Craftsmanship"
            >
        </div>

        <div class="mb-3">
            <label>Description</label>
            <textarea 
                name="description" 
                rows="5" 
                class="form-control"
                placeholder="Write review description..."
            >{{ old('description', $review->description) }}</textarea>
        </div>

        <div class="mb-3">
            <label>Status</label><br>

            <label>
                <input 
                    type="checkbox" 
                    name="status" 
                    value="1"
                    {{ old('status', $review->status ?? 1) ? 'checked' : '' }}
                >
                Active
            </label>
        </div>

    </div>
</div>


<div class="card mb-4">
    <div class="card-header">
        Main Image
    </div>

    <div class="card-body">

        @if(!empty($review->image))
            <div class="mb-3">
                <img 
                    src="{{ asset($review->image) }}" 
                    width="120" 
                    height="120" 
                    style="object-fit:cover;border:1px solid #ddd;"
                >

                <p class="text-muted mt-2 mb-0">
                    Uploading a new image will replace this image.
                </p>
            </div>
        @endif

        <input 
            type="file" 
            name="image" 
            class="form-control"
        >

    </div>
</div>


<div class="card mb-4">
    <div class="card-header">
        Multiple Images
    </div>

    <div class="card-body">

        <textarea 
            name="existing_images" 
            id="existingImagesInput" 
            style="display:none;"
        >@json($galleryImages)</textarea>

        <div id="existingImagesPreview" class="mb-3"></div>

        <label>Add More Images</label>

        <input 
            type="file" 
            name="images[]" 
            class="form-control" 
            multiple
        >

    </div>
</div>


<script>
let existingImages = @json(array_values($galleryImages));

function escapeHtml(value) {
    return String(value || '')
        .replaceAll('&', '&amp;')
        .replaceAll('<', '&lt;')
        .replaceAll('>', '&gt;')
        .replaceAll('"', '&quot;')
        .replaceAll("'", '&#039;');
}

function imageUrl(path) {
    if (!path) return '';

    if (String(path).startsWith('http') || String(path).startsWith('/')) {
        return path;
    }

    return '/' + path;
}

function syncExistingImages() {
    let input = document.getElementById('existingImagesInput');

    if (input) {
        input.value = JSON.stringify(existingImages);
    }
}

function renderExistingImages() {
    let container = document.getElementById('existingImagesPreview');

    if (!container) return;

    if (!existingImages.length) {
        container.innerHTML = `
            <div class="alert alert-warning">
                No multiple images stored yet.
            </div>
        `;

        syncExistingImages();
        return;
    }

    let html = `<div class="d-flex flex-wrap gap-2">`;

    existingImages.forEach(function (image) {
        html += `
            <div class="position-relative" style="width:100px;">
                <button 
                    type="button" 
                    class="btn btn-sm btn-danger remove-review-image"
                    data-image-path="${escapeHtml(image.image_path)}"
                    style="position:absolute;top:-8px;right:-8px;border-radius:50%;width:24px;height:24px;padding:0;z-index:2;"
                >
                    ×
                </button>

                <img 
                    src="${imageUrl(escapeHtml(image.image_path))}" 
                    width="100" 
                    height="100" 
                    style="object-fit:cover;border:1px solid #ddd;"
                >
            </div>
        `;
    });

    html += `</div>`;

    container.innerHTML = html;
    syncExistingImages();
}

document.addEventListener('click', function (event) {
    if (event.target.classList.contains('remove-review-image')) {
        let imagePath = event.target.dataset.imagePath;

        existingImages = existingImages.filter(function (image) {
            return image.image_path !== imagePath;
        });

        renderExistingImages();
    }
});

document.addEventListener('DOMContentLoaded', function () {
    renderExistingImages();
});
</script>