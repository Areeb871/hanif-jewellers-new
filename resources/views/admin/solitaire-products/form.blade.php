@php
    $metals = old('metals', $product->metals ?? []);

    $diamondCarats = old('diamond_carats', $product->diamond_carats ?? [
        ['label' => '0.25', 'value' => '0.25'],
        ['label' => '0.30', 'value' => '0.30'],
        ['label' => '0.40', 'value' => '0.40'],
        ['label' => '0.60', 'value' => '0.60'],
        ['label' => '0.70', 'value' => '0.70'],
        ['label' => '0.75', 'value' => '0.75'],
        ['label' => '0.90', 'value' => '0.90'],
        ['label' => '1', 'value' => '1.00'],
    ]);

    $variants = old('variants', $product->variants ?? []);

    $galleryImages = $product->gallery_images ?? [];
    $metalImages = $product->metal_images ?? [];
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

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif


{{-- PRODUCT INFORMATION --}}
<div class="card mb-4">
    <div class="card-header">
        Product Information
    </div>

    <div class="card-body">
        <div class="mb-3">
            <label>Product Name</label>
            <input 
                type="text" 
                name="name" 
                class="form-control" 
                value="{{ old('name', $product->name) }}" 
                required
            >
        </div>

        <div class="mb-3">
            <label>Slug</label>
            <input 
                type="text" 
                name="slug" 
                class="form-control" 
                value="{{ old('slug', $product->slug) }}"
                placeholder="Leave empty to auto-generate"
            >
        </div>

        <div class="mb-3">
            <label>SKU</label>
            <input 
                type="text" 
                name="sku" 
                class="form-control" 
                value="{{ old('sku', $product->sku) }}"
            >
        </div>

        <div class="mb-3">
            <label>Tag Label</label>
            <input 
                type="text" 
                name="tag_label" 
                class="form-control" 
                value="{{ old('tag_label', $product->tag_label) }}" 
                placeholder="Lab Created"
            >
        </div>

        <div class="mb-3">
            <label>Currency</label>
            <input 
                type="text" 
                name="currency" 
                class="form-control" 
                value="{{ old('currency', $product->currency ?? 'PKR') }}"
            >
        </div>

        <div class="mb-3">
            <label>Short Description</label>
            <textarea 
                name="short_description" 
                class="form-control" 
                rows="3"
            >{{ old('short_description', $product->short_description) }}</textarea>
        </div>

        <div class="mb-3">
    <label>Shape</label>

    <select name="shape" class="form-control">
        <option value="">Select Shape</option>

        <option value="oval" {{ old('shape', $product->shape ?? '') == 'oval' ? 'selected' : '' }}>
            Oval
        </option>

        <option value="princess" {{ old('shape', $product->shape ?? '') == 'princess' ? 'selected' : '' }}>
            Princess
        </option>

        <option value="round" {{ old('shape', $product->shape ?? '') == 'round' ? 'selected' : '' }}>
            Round
        </option>
    </select>
</div>

        <label>
            <input 
                type="checkbox" 
                name="status" 
                {{ old('status', $product->status ?? 1) ? 'checked' : '' }}
            >
            Active
        </label>
    </div>
</div>


{{-- PRODUCT GALLERY IMAGES --}}
<div class="card mb-4">
    <div class="card-header">
        Product Gallery Images
    </div>

    <div class="card-body">

        <textarea 
            name="existing_gallery_images" 
            id="existingGalleryImagesInput" 
            style="display:none;"
        >@json($galleryImages)</textarea>

        <div id="existingGalleryImagesPreview" class="mb-3"></div>

        <label>Add New Gallery Images</label>
        <input 
            type="file" 
            name="gallery_images[]" 
            class="form-control" 
            multiple
        >
    </div>
</div>


{{-- METALS --}}
<div class="card mb-4">
    <div class="card-header d-flex justify-content-between align-items-center">
        <span>Metals</span>

        <button type="button" class="btn btn-sm btn-primary" onclick="addMetalRow()">
            Add Metal
        </button>
    </div>

    <div class="card-body">
        <div id="metalRows">

            @forelse($metals as $index => $metal)
                <div class="metal-row border p-3 mb-3">
                    <div class="row align-items-end">
                        <div class="col-md-2">
                            <label>Code</label>
                            <input 
                                type="text" 
                                name="metals[{{ $index }}][code]" 
                                class="form-control metal-code" 
                                value="{{ $metal['code'] ?? '' }}" 
                                placeholder="14k_white"
                            >
                        </div>

                        <div class="col-md-3">
                            <label>Name</label>
                            <input 
                                type="text" 
                                name="metals[{{ $index }}][name]" 
                                class="form-control" 
                                value="{{ $metal['name'] ?? '' }}" 
                                placeholder="14K White Gold"
                            >
                        </div>

                        <div class="col-md-2">
                            <label>Short Label</label>
                            <input 
                                type="text" 
                                name="metals[{{ $index }}][short_label]" 
                                class="form-control" 
                                value="{{ $metal['short_label'] ?? '' }}" 
                                placeholder="14K"
                            >
                        </div>

                        <div class="col-md-1">
                            <label>Purity</label>
                            <input 
                                type="text" 
                                name="metals[{{ $index }}][purity]" 
                                class="form-control" 
                                value="{{ $metal['purity'] ?? '' }}" 
                                placeholder="14K"
                            >
                        </div>

                        <div class="col-md-1">
                            <label>Tone</label>
                            <input 
                                type="text" 
                                name="metals[{{ $index }}][tone]" 
                                class="form-control" 
                                value="{{ $metal['tone'] ?? '' }}" 
                                placeholder="white"
                            >
                        </div>

                        <div class="col-md-1">
                            <label>Color</label>
                            <input 
                                type="color" 
                                name="metals[{{ $index }}][hex_color]" 
                                class="form-control" 
                                value="{{ $metal['hex_color'] ?? '#c7c7c7' }}"
                            >
                        </div>

                        <div class="col-md-2">
                            <button 
                                type="button" 
                                class="btn btn-danger w-100" 
                                onclick="removeRow(this, '.metal-row')"
                            >
                                Remove
                            </button>
                        </div>
                    </div>
                </div>
            @empty
                <div class="metal-row border p-3 mb-3">
                    <div class="row align-items-end">
                        <div class="col-md-2">
                            <label>Code</label>
                            <input 
                                type="text" 
                                name="metals[0][code]" 
                                class="form-control metal-code" 
                                placeholder="14k_white"
                            >
                        </div>

                        <div class="col-md-3">
                            <label>Name</label>
                            <input 
                                type="text" 
                                name="metals[0][name]" 
                                class="form-control" 
                                placeholder="14K White Gold"
                            >
                        </div>

                        <div class="col-md-2">
                            <label>Short Label</label>
                            <input 
                                type="text" 
                                name="metals[0][short_label]" 
                                class="form-control" 
                                placeholder="14K"
                            >
                        </div>

                        <div class="col-md-1">
                            <label>Purity</label>
                            <input 
                                type="text" 
                                name="metals[0][purity]" 
                                class="form-control" 
                                placeholder="14K"
                            >
                        </div>

                        <div class="col-md-1">
                            <label>Tone</label>
                            <input 
                                type="text" 
                                name="metals[0][tone]" 
                                class="form-control" 
                                placeholder="white"
                            >
                        </div>

                        <div class="col-md-1">
                            <label>Color</label>
                            <input 
                                type="color" 
                                name="metals[0][hex_color]" 
                                class="form-control" 
                                value="#c7c7c7"
                            >
                        </div>

                        <div class="col-md-2">
                            <button 
                                type="button" 
                                class="btn btn-danger w-100" 
                                onclick="removeRow(this, '.metal-row')"
                            >
                                Remove
                            </button>
                        </div>
                    </div>
                </div>
            @endforelse

        </div>
    </div>
</div>


{{-- DIAMOND CARATS --}}
<div class="card mb-4">
    <div class="card-header">
        Diamond Carats
    </div>

    <div class="card-body">
        <div id="caratRows">
            @foreach($diamondCarats as $index => $carat)
                <div class="row mb-2 align-items-end carat-row">
                    <div class="col-md-3">
                        <label>Label</label>
                        <input 
                            type="text" 
                            name="diamond_carats[{{ $index }}][label]" 
                            class="form-control" 
                            value="{{ $carat['label'] ?? '' }}" 
                            placeholder="0.25"
                        >
                    </div>

                    <div class="col-md-3">
                        <label>Value</label>
                        <input 
                            type="text" 
                            name="diamond_carats[{{ $index }}][value]" 
                            class="form-control carat-value" 
                            value="{{ $carat['value'] ?? '' }}" 
                            placeholder="0.25"
                        >
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>


{{-- METAL IMAGES / 360 VIDEOS --}}
<div class="card mb-4">
    <div class="card-header">
        Metal Images / 360 Videos
    </div>

    <div class="card-body">

        <textarea 
            name="existing_metal_images" 
            id="existingMetalImagesInput" 
            style="display:none;"
        >@json($metalImages)</textarea>

        <div id="existingMetalImagesPreview"></div>

        <p class="text-muted">
            Add new metal images and one 360 video using metal code. Video is converted to JPG frames automatically with FFmpeg.
            Example: <strong>14k_white</strong>
        </p>

        <div id="metalImageRows">
            <div class="row mb-3 metal-image-row">
                <div class="col-md-3">
                    <input 
                        type="text" 
                        name="metal_image_codes[0]" 
                        class="form-control" 
                        placeholder="Metal Code e.g. 14k_white"
                    >
                </div>

                <div class="col-md-4">
                    <label class="small text-muted mb-1">Images</label>
                    <input 
                        type="file" 
                        name="metal_image_files[0][]" 
                        class="form-control" 
                        multiple
                    >
                </div>

                <div class="col-md-3">
                    <label class="small text-muted mb-1">360 Video</label>
                    <input 
                        type="file" 
                        name="metal_video_files[0]" 
                        class="form-control"
                        accept="video/mp4,video/quicktime,video/x-msvideo,video/webm,video/x-m4v"
                    >
                </div>

                <div class="col-md-2 d-flex align-items-end">
                    <button 
                        type="button" 
                        class="btn btn-danger" 
                        onclick="removeRow(this, '.metal-image-row')"
                    >
                        Remove
                    </button>
                </div>
            </div>
        </div>

        <button type="button" class="btn btn-sm btn-primary" onclick="addMetalImageRow()">
            Add More Metal Media
        </button>
    </div>
</div>


@php
    /*
        Complete Variant Matrix:
        Metals × Diamond Carats

        Existing saved variants keep their prices.
        Missing combinations show empty fields.
    */

    $formMetals = old('metals', $product->metals ?? []);
    $formCarats = old('diamond_carats', $product->diamond_carats ?? [
        ['label' => '0.25', 'value' => '0.25'],
        ['label' => '0.30', 'value' => '0.30'],
        ['label' => '0.40', 'value' => '0.40'],
        ['label' => '0.60', 'value' => '0.60'],
        ['label' => '0.70', 'value' => '0.70'],
        ['label' => '0.75', 'value' => '0.75'],
        ['label' => '0.90', 'value' => '0.90'],
        ['label' => '1', 'value' => '1.00'],
    ]);

    $savedVariants = old('variants', $product->variants ?? []);

    $variantMap = [];

    foreach ($savedVariants as $variant) {
        $metalCode = $variant['metal_code'] ?? '';
        $caratValue = $variant['diamond_carat'] ?? '';

        if ($metalCode && $caratValue) {
            $key = $metalCode . '|' . number_format((float) $caratValue, 2, '.', '');
            $variantMap[$key] = $variant;
        }
    }

    $matrixVariants = [];

    foreach ($formMetals as $metal) {
        $metalCode = $metal['code'] ?? '';

        if (!$metalCode) {
            continue;
        }

        foreach ($formCarats as $carat) {
            $caratValue = $carat['value'] ?? '';

            if (!$caratValue) {
                continue;
            }

            $formattedCarat = number_format((float) $caratValue, 2, '.', '');
            $key = $metalCode . '|' . $formattedCarat;

            $matrixVariants[] = $variantMap[$key] ?? [
                'metal_code' => $metalCode,
                'diamond_carat' => $formattedCarat,
                'variant_sku' => '',
                'old_price' => '',
                'price' => '',
                'discount_percent' => '',
                'stock' => 0,
                'is_default' => false,
                'status' => true,
            ];
        }
    }
@endphp


{{-- VARIANTS PRICES --}}
<div class="card mb-4">
    <div class="card-header d-flex justify-content-between align-items-center">
        <span>Variants Prices</span>

        <button type="button" class="btn btn-sm btn-primary" onclick="buildVariants()">
            Build Variant Matrix
        </button>
    </div>

    <div class="card-body">

        <div class="alert alert-info">
            Existing variant prices will remain. Missing metal + carat combinations will show as empty fields.
        </div>

        <div id="variantRows">

            @foreach($matrixVariants as $index => $variant)

                <div class="variant-row border p-3 mb-3">
                    <div class="row align-items-end">

                        <div class="col-md-2">
                            <label>Metal Code</label>
                            <input 
                                type="text" 
                                name="variants[{{ $index }}][metal_code]" 
                                class="form-control variant-metal-code" 
                                value="{{ $variant['metal_code'] ?? '' }}"
                                readonly
                            >
                        </div>

                        <div class="col-md-1">
                            <label>Carat</label>
                            <input 
                                type="text" 
                                name="variants[{{ $index }}][diamond_carat]" 
                                class="form-control variant-carat" 
                                value="{{ $variant['diamond_carat'] ?? '' }}"
                                readonly
                            >
                        </div>

                        <div class="col-md-2">
                            <label>SKU</label>
                            <input 
                                type="text" 
                                name="variants[{{ $index }}][variant_sku]" 
                                class="form-control" 
                                value="{{ $variant['variant_sku'] ?? '' }}"
                            >
                        </div>

                        <div class="col-md-1">
                            <label>Old Price</label>
                            <input 
                                type="number" 
                                step="0.01" 
                                name="variants[{{ $index }}][old_price]" 
                                class="form-control" 
                                value="{{ $variant['old_price'] ?? '' }}"
                            >
                        </div>

                        <div class="col-md-1">
                            <label>Price</label>
                            <input 
                                type="number" 
                                step="0.01" 
                                name="variants[{{ $index }}][price]" 
                                class="form-control" 
                                value="{{ $variant['price'] ?? '' }}"
                            >
                        </div>

                        <div class="col-md-1">
                            <label>Discount</label>
                            <input 
                                type="number" 
                                name="variants[{{ $index }}][discount_percent]" 
                                class="form-control" 
                                value="{{ $variant['discount_percent'] ?? '' }}"
                            >
                        </div>

                        <div class="col-md-1">
                            <label>Stock</label>
                            <input 
                                type="number" 
                                name="variants[{{ $index }}][stock]" 
                                class="form-control" 
                                value="{{ $variant['stock'] ?? 0 }}"
                            >
                        </div>

                        <div class="col-md-1">
                            <label>Default</label><br>
                            <input 
                                type="checkbox" 
                                name="variants[{{ $index }}][is_default]" 
                                value="1" 
                                {{ !empty($variant['is_default']) ? 'checked' : '' }}
                            >
                        </div>

                        <div class="col-md-1">
                            <label>Status</label><br>
                            <input 
                                type="checkbox" 
                                name="variants[{{ $index }}][status]" 
                                value="1" 
                                {{ !isset($variant['status']) || !empty($variant['status']) ? 'checked' : '' }}
                            >
                        </div>

                        <div class="col-md-1">
                            <button 
                                type="button" 
                                class="btn btn-danger w-100" 
                                onclick="removeRow(this, '.variant-row')"
                            >
                                X
                            </button>
                        </div>

                    </div>
                </div>

            @endforeach

        </div>
    </div>
</div>


{{-- DEFAULT SELECTION --}}
<div class="card mb-4">
    <div class="card-header">
        Default Selection
    </div>

    <div class="card-body">
        <div class="mb-3">
            <label>Default Metal Code</label>
            <input 
                type="text" 
                name="default_metal_code" 
                class="form-control" 
                value="{{ old('default_metal_code', $product->default_metal_code) }}" 
                placeholder="14k_white"
            >
        </div>

        <div class="mb-3">
            <label>Default Diamond Carat</label>
            <input 
                type="text" 
                name="default_diamond_carat" 
                class="form-control" 
                value="{{ old('default_diamond_carat', $product->default_diamond_carat) }}" 
                placeholder="0.25"
            >
        </div>
    </div>
</div>


<script>
let metalIndex = {{ count($metals) ?: 1 }};
let variantIndex = {{ count($variants) ?: 0 }};
let metalImageIndex = 1;

let existingGalleryImages = @json(array_values($galleryImages));
let existingMetalImages = @json(array_values($metalImages));

function cleanMetalCode(code) {
    return String(code || '')
        .trim()
        .toLowerCase()
        .replace(/\s+/g, '_')
        .replace(/[^a-z0-9_]/g, '');
}
function normalizeCarat(value) {
    var number = Number(value);

    if (isNaN(number)) {
        return String(value || '').trim();
    }

    return number.toFixed(2);
}

function escapeHtml(value) {
    return String(value || '')
        .replaceAll('&', '&amp;')
        .replaceAll('<', '&lt;')
        .replaceAll('>', '&gt;')
        .replaceAll('"', '&quot;')
        .replaceAll("'", '&#039;');
}

function escapeAttr(value) {
    return escapeHtml(value);
}

function imageUrl(path) {
    if (!path) return '';

    if (String(path).startsWith('http') || String(path).startsWith('/')) {
        return path;
    }

    return '/' + path;
}

function removeRow(button, selector) {
    var row = button.closest(selector);

    if (row) {
        row.remove();

        if (selector === '.variant-row') {
            refreshVariantIndexes();
        }
    }
}
function refreshVariantIndexes() {
    document.querySelectorAll('.variant-row').forEach(function (row, index) {
        row.querySelectorAll('input').forEach(function (input) {
            input.name = input.name.replace(/variants\[\d+\]/, 'variants[' + index + ']');
        });
    });

    variantIndex = document.querySelectorAll('.variant-row').length;
}

function getCurrentVariantValues() {
    var values = {};

    document.querySelectorAll('.variant-row').forEach(function (row) {
        var metalCode = row.querySelector('[name*="[metal_code]"]')?.value || '';
        var carat = row.querySelector('[name*="[diamond_carat]"]')?.value || '';

        metalCode = cleanMetalCode(metalCode);
        carat = normalizeCarat(carat);

        if (!metalCode || !carat) return;

        var key = metalCode + '|' + carat;

        values[key] = {
            metal_code: metalCode,
            diamond_carat: carat,
            variant_sku: row.querySelector('[name*="[variant_sku]"]')?.value || '',
            old_price: row.querySelector('[name*="[old_price]"]')?.value || '',
            price: row.querySelector('[name*="[price]"]')?.value || '',
            discount_percent: row.querySelector('[name*="[discount_percent]"]')?.value || '',
            stock: row.querySelector('[name*="[stock]"]')?.value || 0,
            is_default: row.querySelector('[name*="[is_default]"]')?.checked || false,
            status: row.querySelector('[name*="[status]"]')?.checked || false
        };
    });

    return values;
}

function buildVariantRow(index, variant) {
    return `
        <div class="variant-row border p-3 mb-3">
            <div class="row align-items-end">

                <div class="col-md-2">
                    <label>Metal Code</label>
                    <input 
                        type="text" 
                        name="variants[${index}][metal_code]" 
                        class="form-control variant-metal-code" 
                        value="${escapeAttr(variant.metal_code)}"
                        readonly
                    >
                </div>

                <div class="col-md-1">
                    <label>Carat</label>
                    <input 
                        type="text" 
                        name="variants[${index}][diamond_carat]" 
                        class="form-control variant-carat" 
                        value="${escapeAttr(variant.diamond_carat)}"
                        readonly
                    >
                </div>

                <div class="col-md-2">
                    <label>SKU</label>
                    <input 
                        type="text" 
                        name="variants[${index}][variant_sku]" 
                        class="form-control" 
                        value="${escapeAttr(variant.variant_sku)}"
                    >
                </div>

                <div class="col-md-1">
                    <label>Old Price</label>
                    <input 
                        type="number" 
                        step="0.01" 
                        name="variants[${index}][old_price]" 
                        class="form-control" 
                        value="${escapeAttr(variant.old_price)}"
                    >
                </div>

                <div class="col-md-1">
                    <label>Price</label>
                    <input 
                        type="number" 
                        step="0.01" 
                        name="variants[${index}][price]" 
                        class="form-control" 
                        value="${escapeAttr(variant.price)}"
                    >
                </div>

                <div class="col-md-1">
                    <label>Discount</label>
                    <input 
                        type="number" 
                        name="variants[${index}][discount_percent]" 
                        class="form-control" 
                        value="${escapeAttr(variant.discount_percent)}"
                    >
                </div>

                <div class="col-md-1">
                    <label>Stock</label>
                    <input 
                        type="number" 
                        name="variants[${index}][stock]" 
                        class="form-control" 
                        value="${escapeAttr(variant.stock || 0)}"
                    >
                </div>

                <div class="col-md-1">
                    <label>Default</label><br>
                    <input 
                        type="checkbox" 
                        name="variants[${index}][is_default]" 
                        value="1" 
                        ${variant.is_default ? 'checked' : ''}
                    >
                </div>

                <div class="col-md-1">
                    <label>Status</label><br>
                    <input 
                        type="checkbox" 
                        name="variants[${index}][status]" 
                        value="1" 
                        ${variant.status ? 'checked' : ''}
                    >
                </div>

                <div class="col-md-1">
                    <button 
                        type="button" 
                        class="btn btn-danger w-100" 
                        onclick="removeRow(this, '.variant-row')"
                    >
                        X
                    </button>
                </div>

            </div>
        </div>
    `;
}

function syncExistingGalleryImages() {
    let input = document.getElementById('existingGalleryImagesInput');

    if (input) {
        input.value = JSON.stringify(existingGalleryImages);
    }
}

function syncExistingMetalImages() {
    let input = document.getElementById('existingMetalImagesInput');

    if (input) {
        input.value = JSON.stringify(existingMetalImages);
    }
}

function prepareMetalImageInputs() {
    syncExistingGalleryImages();
    syncExistingMetalImages();

    return true;
}

function renderExistingGalleryImages() {
    let container = document.getElementById('existingGalleryImagesPreview');

    if (!container) return;

    if (!existingGalleryImages.length) {
        container.innerHTML = `<div class="alert alert-danger">No gallery images stored yet.</div>`;
        syncExistingGalleryImages();
        return;
    }

    let html = `<div class="alert alert-success">Gallery images are stored.</div>`;
    html += `<div class="d-flex flex-wrap gap-2">`;

    existingGalleryImages.forEach(function (image) {
        html += `
            <div class="position-relative" style="width:90px;">
                <button 
                    type="button" 
                    class="btn btn-sm btn-danger remove-gallery-image"
                    data-image-path="${escapeHtml(image.image_path)}"
                    style="position:absolute;top:-8px;right:-8px;border-radius:50%;width:24px;height:24px;padding:0;z-index:2;"
                >
                    ×
                </button>

                <img 
                    src="${imageUrl(escapeHtml(image.image_path))}" 
                    width="90" 
                    height="90" 
                    style="object-fit:cover;border:1px solid #ddd;"
                >
            </div>
        `;
    });

    html += `</div>`;

    container.innerHTML = html;
    syncExistingGalleryImages();
}

function renderExistingMetalImages() {
    let container = document.getElementById('existingMetalImagesPreview');

    if (!container) return;

    if (!existingMetalImages.length) {
        container.innerHTML = `<div class="alert alert-danger">No metal images stored yet.</div>`;
        syncExistingMetalImages();
        return;
    }

    let html = `<div class="alert alert-success">Metal images are stored.</div>`;

    existingMetalImages.forEach(function (group) {
        html += `
            <div class="border p-3 mb-3">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <h6 class="mb-0">Metal Code: ${escapeHtml(group.metal_code)}</h6>

                    <button 
                        type="button" 
                        class="btn btn-sm btn-danger remove-metal-group"
                        data-metal-code="${escapeHtml(group.metal_code)}"
                    >
                        Remove Group
                    </button>
                </div>

                <div class="d-flex flex-wrap gap-2">
        `;

        group.images = (group.images || []).slice().sort(function (a, b) {
            return Number(a.sort_order || 0) - Number(b.sort_order || 0);
        });

        group.images.forEach(function (image, imageIndex) {
            html += `
                <div
                    class="position-relative border p-1 metal-image-sort-item"
                    style="width:112px;cursor:grab;"
                    draggable="true"
                    data-metal-code="${escapeHtml(group.metal_code)}"
                    data-image-index="${imageIndex}"
                    data-image-path="${escapeHtml(image.image_path)}"
                >
                    <button 
                        type="button" 
                        class="btn btn-sm btn-danger remove-metal-image"
                        data-metal-code="${escapeHtml(group.metal_code)}"
                        data-image-path="${escapeHtml(image.image_path)}"
                        style="position:absolute;top:-8px;right:-8px;border-radius:50%;width:24px;height:24px;padding:0;z-index:2;"
                    >
                        ×
                    </button>

                    <img 
                        src="${imageUrl(escapeHtml(image.image_path))}" 
                        width="100" 
                        height="90" 
                        style="object-fit:cover;border:1px solid #ddd;"
                    >

                    <small class="d-block text-center text-muted mt-1">
                        Drag #${imageIndex + 1}
                    </small>
                </div>
            `;
        });

        if (group.frames && group.frames.frame_count) {
            html += `
                <div class="w-100 mt-3">
                    <div class="alert alert-info mb-2">
                        360 frames stored: ${escapeHtml(group.frames.frame_count)} frames
                    </div>

                    ${group.frames.first_frame ? `
                        <img 
                            src="${imageUrl(escapeHtml(group.frames.first_frame))}" 
                            width="120" 
                            height="120" 
                            style="object-fit:cover;border:1px solid #ddd;"
                        >
                    ` : ''}
                </div>
            `;
        }

        html += `
                </div>
            </div>
        `;
    });

    container.innerHTML = html;
    syncExistingMetalImages();
}

document.addEventListener('click', function (event) {

    if (event.target.classList.contains('remove-gallery-image')) {
        let imagePath = event.target.dataset.imagePath;

        existingGalleryImages = existingGalleryImages.filter(function (image) {
            return image.image_path !== imagePath;
        });

        renderExistingGalleryImages();
    }

    if (event.target.classList.contains('remove-metal-image')) {
        let metalCode = event.target.dataset.metalCode;
        let imagePath = event.target.dataset.imagePath;

        existingMetalImages = existingMetalImages
            .map(function (group) {
                if (group.metal_code === metalCode) {
                    group.images = (group.images || []).filter(function (image) {
                        return image.image_path !== imagePath;
                    });
                }

                return group;
            })
            .filter(function (group) {
                return (group.images || []).length > 0 || !!group.frames;
            });

        renderExistingMetalImages();
    }

    if (event.target.classList.contains('remove-metal-group')) {
        let metalCode = event.target.dataset.metalCode;

        existingMetalImages = existingMetalImages.filter(function (group) {
            return group.metal_code !== metalCode;
        });

        renderExistingMetalImages();
    }
});

document.addEventListener('dragstart', function (event) {
    let item = event.target.closest('.metal-image-sort-item');

    if (!item) return;

    item.classList.add('opacity-50');

    event.dataTransfer.effectAllowed = 'move';
    event.dataTransfer.setData('text/plain', JSON.stringify({
        metalCode: item.dataset.metalCode,
        imageIndex: Number(item.dataset.imageIndex)
    }));
});

document.addEventListener('dragend', function (event) {
    let item = event.target.closest('.metal-image-sort-item');

    if (item) {
        item.classList.remove('opacity-50');
    }
});

document.addEventListener('dragover', function (event) {
    let item = event.target.closest('.metal-image-sort-item');

    if (!item) return;

    event.preventDefault();
    event.dataTransfer.dropEffect = 'move';
});

document.addEventListener('drop', function (event) {
    let targetItem = event.target.closest('.metal-image-sort-item');

    if (!targetItem) return;

    event.preventDefault();

    let dragData;

    try {
        dragData = JSON.parse(event.dataTransfer.getData('text/plain') || '{}');
    } catch (error) {
        return;
    }

    let metalCode = dragData.metalCode;
    let fromIndex = Number(dragData.imageIndex);
    let toIndex = Number(targetItem.dataset.imageIndex);

    if (!metalCode || targetItem.dataset.metalCode !== metalCode || fromIndex === toIndex) {
        return;
    }

    existingMetalImages = existingMetalImages.map(function (group) {
        if (group.metal_code !== metalCode) {
            return group;
        }

        let images = group.images || [];
        let movedImage = images.splice(fromIndex, 1)[0];

        if (!movedImage) {
            return group;
        }

        images.splice(toIndex, 0, movedImage);

        group.images = images.map(function (image, index) {
            image.sort_order = index + 1;
            return image;
        });

        return group;
    });

    renderExistingMetalImages();
});

function addMetalRow() {
    let html = `
        <div class="metal-row border p-3 mb-3">
            <div class="row align-items-end">
                <div class="col-md-2">
                    <label>Code</label>
                    <input type="text" name="metals[${metalIndex}][code]" class="form-control metal-code" placeholder="14k_white">
                </div>

                <div class="col-md-3">
                    <label>Name</label>
                    <input type="text" name="metals[${metalIndex}][name]" class="form-control" placeholder="14K White Gold">
                </div>

                <div class="col-md-2">
                    <label>Short Label</label>
                    <input type="text" name="metals[${metalIndex}][short_label]" class="form-control" placeholder="14K">
                </div>

                <div class="col-md-1">
                    <label>Purity</label>
                    <input type="text" name="metals[${metalIndex}][purity]" class="form-control" placeholder="14K">
                </div>

                <div class="col-md-1">
                    <label>Tone</label>
                    <input type="text" name="metals[${metalIndex}][tone]" class="form-control" placeholder="white">
                </div>

                <div class="col-md-1">
                    <label>Color</label>
                    <input type="color" name="metals[${metalIndex}][hex_color]" class="form-control" value="#c7c7c7">
                </div>

                <div class="col-md-2">
                    <button type="button" class="btn btn-danger w-100" onclick="removeRow(this, '.metal-row')">
                        Remove
                    </button>
                </div>
            </div>
        </div>
    `;

    document.getElementById('metalRows').insertAdjacentHTML('beforeend', html);
    metalIndex++;
}

function addMetalImageRow() {
    let html = `
        <div class="row mb-3 metal-image-row">
            <div class="col-md-3">
                <input 
                    type="text" 
                    name="metal_image_codes[${metalImageIndex}]" 
                    class="form-control" 
                    placeholder="Metal Code e.g. 14k_white"
                >
            </div>

            <div class="col-md-4">
                <label class="small text-muted mb-1">Images</label>
                <input 
                    type="file" 
                    name="metal_image_files[${metalImageIndex}][]" 
                    class="form-control" 
                    multiple
                >
            </div>

            <div class="col-md-3">
                <label class="small text-muted mb-1">360 Video</label>
                <input 
                    type="file" 
                    name="metal_video_files[${metalImageIndex}]" 
                    class="form-control"
                    accept="video/mp4,video/quicktime,video/x-msvideo,video/webm,video/x-m4v"
                >
            </div>

            <div class="col-md-2 d-flex align-items-end">
                <button type="button" class="btn btn-danger" onclick="removeRow(this, '.metal-image-row')">
                    Remove
                </button>
            </div>
        </div>
    `;

    document.getElementById('metalImageRows').insertAdjacentHTML('beforeend', html);
    metalImageIndex++;
}



function buildVariants() {
    var existingValues = getCurrentVariantValues();

    var metalsArray = [];
    var caratsArray = [];

    document.querySelectorAll('.metal-code').forEach(function (input) {
        var code = cleanMetalCode(input.value);

        if (code && !metalsArray.includes(code)) {
            metalsArray.push(code);
        }
    });

    document.querySelectorAll('.carat-value').forEach(function (input) {
        var value = normalizeCarat(input.value);

        if (value && !caratsArray.includes(value)) {
            caratsArray.push(value);
        }
    });

    if (!metalsArray.length) {
        alert('Please add metals first.');
        return;
    }

    if (!caratsArray.length) {
        alert('Please add diamond carats first.');
        return;
    }

    var container = document.getElementById('variantRows');
    var html = '';
    var index = 0;

    metalsArray.forEach(function (metalCode) {
        caratsArray.forEach(function (carat) {
            var key = metalCode + '|' + carat;

            var variant = existingValues[key] || {
                metal_code: metalCode,
                diamond_carat: carat,
                variant_sku: '',
                old_price: '',
                price: '',
                discount_percent: '',
                stock: 0,
                is_default: false,
                status: true
            };

            html += buildVariantRow(index, variant);
            index++;
        });
    });

    container.innerHTML = html;
    variantIndex = index;
}

document.addEventListener('DOMContentLoaded', function () {
    renderExistingGalleryImages();
    renderExistingMetalImages();
});
</script>
