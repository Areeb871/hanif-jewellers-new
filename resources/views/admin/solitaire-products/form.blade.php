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
@endphp

<div class="card mb-4">
    <div class="card-header">
        Product Information
    </div>

    <div class="card-body">
        <div class="mb-3">
            <label>Product Name</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $product->name) }}" required>
        </div>

        <div class="mb-3">
            <label>Slug</label>
            <input type="text" name="slug" class="form-control" value="{{ old('slug', $product->slug) }}">
        </div>

        <div class="mb-3">
            <label>SKU</label>
            <input type="text" name="sku" class="form-control" value="{{ old('sku', $product->sku) }}">
        </div>

        <div class="mb-3">
            <label>Tag Label</label>
            <input type="text" name="tag_label" class="form-control" value="{{ old('tag_label', $product->tag_label) }}" placeholder="Lab Created">
        </div>

        <div class="mb-3">
            <label>Currency</label>
            <input type="text" name="currency" class="form-control" value="{{ old('currency', $product->currency ?? 'AED') }}">
        </div>

        <div class="mb-3">
            <label>Short Description</label>
            <textarea name="short_description" class="form-control" rows="3">{{ old('short_description', $product->short_description) }}</textarea>
        </div>

        <label>
            <input type="checkbox" name="status" {{ old('status', $product->status ?? 1) ? 'checked' : '' }}>
            Active
        </label>
    </div>
</div>

<div class="card mb-4">
    <div class="card-header">
        Product Gallery Images
    </div>

    <div class="card-body">
        @if(!empty($product->gallery_images))
            <div class="mb-3 d-flex flex-wrap gap-2">
                @foreach($product->gallery_images as $image)
                    <img src="{{ asset('storage/' . $image['image_path']) }}" width="90" height="90" style="object-fit:cover;border:1px solid #ddd;">
                @endforeach
            </div>
        @endif

        <input type="file" name="gallery_images[]" class="form-control" multiple>
    </div>
</div>

<div class="card mb-4">
    <div class="card-header d-flex justify-content-between">
        <span>Metals</span>
        <button type="button" class="btn btn-sm btn-primary" onclick="addMetalRow()">Add Metal</button>
    </div>

    <div class="card-body">
        <div id="metalRows">
            @forelse($metals as $index => $metal)
                <div class="metal-row border p-3 mb-3">
                    <div class="row">
                        <div class="col-md-2">
                            <label>Code</label>
                            <input type="text" name="metals[{{ $index }}][code]" class="form-control metal-code" value="{{ $metal['code'] ?? '' }}" placeholder="14k_white">
                        </div>

                        <div class="col-md-3">
                            <label>Name</label>
                            <input type="text" name="metals[{{ $index }}][name]" class="form-control" value="{{ $metal['name'] ?? '' }}" placeholder="14K White Gold">
                        </div>

                        <div class="col-md-2">
                            <label>Short Label</label>
                            <input type="text" name="metals[{{ $index }}][short_label]" class="form-control" value="{{ $metal['short_label'] ?? '' }}" placeholder="14K">
                        </div>

                        <div class="col-md-2">
                            <label>Purity</label>
                            <input type="text" name="metals[{{ $index }}][purity]" class="form-control" value="{{ $metal['purity'] ?? '' }}" placeholder="14K">
                        </div>

                        <div class="col-md-2">
                            <label>Tone</label>
                            <input type="text" name="metals[{{ $index }}][tone]" class="form-control" value="{{ $metal['tone'] ?? '' }}" placeholder="white">
                        </div>

                        <div class="col-md-1">
                            <label>Color</label>
                            <input type="color" name="metals[{{ $index }}][hex_color]" class="form-control" value="{{ $metal['hex_color'] ?? '#c7c7c7' }}">
                        </div>
                    </div>
                </div>
            @empty
                <div class="metal-row border p-3 mb-3">
                    <div class="row">
                        <div class="col-md-2">
                            <label>Code</label>
                            <input type="text" name="metals[0][code]" class="form-control metal-code" placeholder="14k_white">
                        </div>

                        <div class="col-md-3">
                            <label>Name</label>
                            <input type="text" name="metals[0][name]" class="form-control" placeholder="14K White Gold">
                        </div>

                        <div class="col-md-2">
                            <label>Short Label</label>
                            <input type="text" name="metals[0][short_label]" class="form-control" placeholder="14K">
                        </div>

                        <div class="col-md-2">
                            <label>Purity</label>
                            <input type="text" name="metals[0][purity]" class="form-control" placeholder="14K">
                        </div>

                        <div class="col-md-2">
                            <label>Tone</label>
                            <input type="text" name="metals[0][tone]" class="form-control" placeholder="white">
                        </div>

                        <div class="col-md-1">
                            <label>Color</label>
                            <input type="color" name="metals[0][hex_color]" class="form-control" value="#c7c7c7">
                        </div>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
</div>

<div class="card mb-4">
    <div class="card-header">
        Diamond Carats
    </div>

    <div class="card-body">
        <div id="caratRows">
            @foreach($diamondCarats as $index => $carat)
                <div class="row mb-2">
                    <div class="col-md-3">
                        <input type="text" name="diamond_carats[{{ $index }}][label]" class="form-control" value="{{ $carat['label'] ?? '' }}" placeholder="Label">
                    </div>

                    <div class="col-md-3">
                        <input type="text" name="diamond_carats[{{ $index }}][value]" class="form-control carat-value" value="{{ $carat['value'] ?? '' }}" placeholder="Value">
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

<div class="card mb-4">
    <div class="card-header">
        Metal Images
    </div>

    <div class="card-body">

        @if(!empty($product->metal_images) && count($product->metal_images) > 0)
            <div class="alert alert-success">
                Metal images are stored.
            </div>

            @foreach($product->metal_images as $group)
                <h6>Metal Code: {{ $group['metal_code'] ?? '' }}</h6>

                <div class="d-flex flex-wrap gap-2 mb-3">
                    @foreach(($group['images'] ?? []) as $image)
                        <img 
                            src="{{ asset($image['image_path']) }}" 
                            width="90" 
                            height="90" 
                            style="object-fit:cover;border:1px solid #ddd;"
                        >
                    @endforeach
                </div>
            @endforeach
        @else
            <div class="alert alert-danger">
                No metal images stored yet.
            </div>
        @endif

        <p class="text-muted">
            Add metal images using metal code. Example: <strong>14k_white</strong>
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

                <div class="col-md-6">
                    <input 
                        type="file" 
                        name="metal_image_files[0][]" 
                        class="form-control" 
                        multiple
                    >
                </div>

                <div class="col-md-3">
                    <button type="button" class="btn btn-danger" onclick="this.closest('.metal-image-row').remove()">
                        Remove
                    </button>
                </div>
            </div>
        </div>

        <button type="button" class="btn btn-sm btn-primary" onclick="addMetalImageRow()">
            Add More Metal Image
        </button>
    </div>
</div>

<div class="card mb-4">
    <div class="card-header d-flex justify-content-between">
        <span>Variants Prices</span>
        <button type="button" class="btn btn-sm btn-primary" onclick="buildVariants()">Build Variant Matrix</button>
    </div>

    <div class="card-body">
        <div id="variantRows">
            @foreach($variants as $index => $variant)
                <div class="variant-row border p-3 mb-3">
                    <div class="row">
                        <div class="col-md-2">
                            <label>Metal Code</label>
                            <input type="text" name="variants[{{ $index }}][metal_code]" class="form-control" value="{{ $variant['metal_code'] ?? '' }}">
                        </div>

                        <div class="col-md-2">
                            <label>Carat</label>
                            <input type="text" name="variants[{{ $index }}][diamond_carat]" class="form-control" value="{{ $variant['diamond_carat'] ?? '' }}">
                        </div>

                        <div class="col-md-2">
                            <label>SKU</label>
                            <input type="text" name="variants[{{ $index }}][variant_sku]" class="form-control" value="{{ $variant['variant_sku'] ?? '' }}">
                        </div>

                        <div class="col-md-1">
                            <label>Old Price</label>
                            <input type="number" step="0.01" name="variants[{{ $index }}][old_price]" class="form-control" value="{{ $variant['old_price'] ?? '' }}">
                        </div>

                        <div class="col-md-1">
                            <label>Price</label>
                            <input type="number" step="0.01" name="variants[{{ $index }}][price]" class="form-control" value="{{ $variant['price'] ?? '' }}">
                        </div>

                        <div class="col-md-1">
                            <label>Discount</label>
                            <input type="number" name="variants[{{ $index }}][discount_percent]" class="form-control" value="{{ $variant['discount_percent'] ?? '' }}">
                        </div>

                        <div class="col-md-1">
                            <label>Stock</label>
                            <input type="number" name="variants[{{ $index }}][stock]" class="form-control" value="{{ $variant['stock'] ?? 0 }}">
                        </div>

                        <div class="col-md-1">
                            <label>Default</label><br>
                            <input type="checkbox" name="variants[{{ $index }}][is_default]" value="1" {{ !empty($variant['is_default']) ? 'checked' : '' }}>
                        </div>

                        <div class="col-md-1">
                            <label>Status</label><br>
                            <input type="checkbox" name="variants[{{ $index }}][status]" value="1" {{ !empty($variant['status']) ? 'checked' : '' }}>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

<div class="card mb-4">
    <div class="card-header">
        Default Selection
    </div>

    <div class="card-body">
        <div class="mb-3">
            <label>Default Metal Code</label>
            <input type="text" name="default_metal_code" class="form-control" value="{{ old('default_metal_code', $product->default_metal_code) }}" placeholder="14k_white">
        </div>

        <div class="mb-3">
            <label>Default Diamond Carat</label>
            <input type="text" name="default_diamond_carat" class="form-control" value="{{ old('default_diamond_carat', $product->default_diamond_carat) }}" placeholder="0.25">
        </div>
    </div>
</div>

<script>
let metalIndex = {{ count($metals) ?: 1 }};
let variantIndex = {{ count($variants) ?: 0 }};
let metalImageIndex = 1;

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

            <div class="col-md-6">
                <input 
                    type="file" 
                    name="metal_image_files[${metalImageIndex}][]" 
                    class="form-control" 
                    multiple
                >
            </div>

            <div class="col-md-3">
                <button type="button" class="btn btn-danger" onclick="this.closest('.metal-image-row').remove()">
                    Remove
                </button>
            </div>
        </div>
    `;

    document.getElementById('metalImageRows').insertAdjacentHTML('beforeend', html);
    metalImageIndex++;
}
/* Clean metal code */
function cleanMetalCode(code) {
    return code
        .trim()
        .toLowerCase()
        .replace(/\s+/g, '_')
        .replace(/[^a-z0-9_]/g, '');
}

/* Add new metal row */
function addMetalRow() {
    let html = `
        <div class="metal-row border p-3 mb-3">
            <div class="row">
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

                <div class="col-md-2">
                    <label>Purity</label>
                    <input type="text" name="metals[${metalIndex}][purity]" class="form-control" placeholder="14K">
                </div>

                <div class="col-md-2">
                    <label>Tone</label>
                    <input type="text" name="metals[${metalIndex}][tone]" class="form-control" placeholder="white">
                </div>

                <div class="col-md-1">
                    <label>Color</label>
                    <input type="color" name="metals[${metalIndex}][hex_color]" class="form-control" value="#c7c7c7">
                </div>
            </div>
        </div>
    `;

    document.getElementById('metalRows').insertAdjacentHTML('beforeend', html);
    metalIndex++;
}

/* Update metal image input name */
function updateMetalImageInputName(row) {
    let codeInput = row.querySelector('.metal-image-code');
    let fileInput = row.querySelector('.metal-image-input');
    let preview = row.querySelector('.metal-image-name-preview');

    if (!codeInput || !fileInput) return;

    let code = cleanMetalCode(codeInput.value);

    if (code) {
        fileInput.setAttribute('name', `metal_images[${code}][]`);

        if (preview) {
            preview.innerText = `Input name: metal_images[${code}][]`;
        }
    } else {
        fileInput.removeAttribute('name');

        if (preview) {
            preview.innerText = '';
        }
    }
}

/* Prepare all metal image inputs before submit */
function prepareMetalImageInputs() {
    document.querySelectorAll('.metal-image-row').forEach(row => {
        updateMetalImageInputName(row);
    });
}

/* Auto update name when metal code is typed */
document.addEventListener('input', function (e) {
    if (e.target.classList.contains('metal-image-code')) {
        let row = e.target.closest('.metal-image-row');
        updateMetalImageInputName(row);
    }
});

/* Auto update name when image selected */
document.addEventListener('change', function (e) {
    if (e.target.classList.contains('metal-image-input')) {
        let row = e.target.closest('.metal-image-row');
        updateMetalImageInputName(row);
    }
});

/* Validate before form submit */
document.addEventListener('DOMContentLoaded', function () {
    let solitaireForm = document.getElementById('solitaireProductForm');

    if (solitaireForm) {
        solitaireForm.addEventListener('submit', function (e) {
            prepareMetalImageInputs();

            let hasFileWithoutCode = false;

            document.querySelectorAll('.metal-image-row').forEach(row => {
                let codeInput = row.querySelector('.metal-image-code');
                let fileInput = row.querySelector('.metal-image-input');

                if (
                    fileInput &&
                    fileInput.files.length > 0 &&
                    !cleanMetalCode(codeInput.value)
                ) {
                    hasFileWithoutCode = true;
                }
            });

            if (hasFileWithoutCode) {
                e.preventDefault();
                alert('Please enter metal code for selected metal images.');
            }
        });
    }
});

/* Build variant matrix */
function buildVariants() {
    let metals = [];
    let carats = [];

    document.querySelectorAll('.metal-code').forEach(input => {
        let code = cleanMetalCode(input.value);

        if (code) {
            metals.push(code);
        }
    });

    document.querySelectorAll('.carat-value').forEach(input => {
        let carat = input.value.trim();

        if (carat) {
            carats.push(carat);
        }
    });

    if (metals.length === 0) {
        alert('Please add metals first.');
        return;
    }

    if (carats.length === 0) {
        alert('Please add diamond carats first.');
        return;
    }

    let container = document.getElementById('variantRows');
    container.innerHTML = '';
    variantIndex = 0;

    metals.forEach(metalCode => {
        carats.forEach(carat => {
            let html = `
                <div class="variant-row border p-3 mb-3">
                    <div class="row">
                        <div class="col-md-2">
                            <label>Metal Code</label>
                            <input type="text" name="variants[${variantIndex}][metal_code]" class="form-control" value="${metalCode}">
                        </div>

                        <div class="col-md-2">
                            <label>Carat</label>
                            <input type="text" name="variants[${variantIndex}][diamond_carat]" class="form-control" value="${carat}">
                        </div>

                        <div class="col-md-2">
                            <label>SKU</label>
                            <input type="text" name="variants[${variantIndex}][variant_sku]" class="form-control">
                        </div>

                        <div class="col-md-1">
                            <label>Old Price</label>
                            <input type="number" step="0.01" name="variants[${variantIndex}][old_price]" class="form-control">
                        </div>

                        <div class="col-md-1">
                            <label>Price</label>
                            <input type="number" step="0.01" name="variants[${variantIndex}][price]" class="form-control">
                        </div>

                        <div class="col-md-1">
                            <label>Discount</label>
                            <input type="number" name="variants[${variantIndex}][discount_percent]" class="form-control">
                        </div>

                        <div class="col-md-1">
                            <label>Stock</label>
                            <input type="number" name="variants[${variantIndex}][stock]" class="form-control" value="0">
                        </div>

                        <div class="col-md-1">
                            <label>Default</label><br>
                            <input type="checkbox" name="variants[${variantIndex}][is_default]" value="1">
                        </div>

                        <div class="col-md-1">
                            <label>Status</label><br>
                            <input type="checkbox" name="variants[${variantIndex}][status]" value="1" checked>
                        </div>
                    </div>
                </div>
            `;

            container.insertAdjacentHTML('beforeend', html);
            variantIndex++;
        });
    });
}
</script>