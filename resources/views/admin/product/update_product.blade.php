@extends('admin_layout.app')

@section('content')
<div class="app-main flex-column flex-row-fluid" id="kt_app_main">
    <div class="d-flex flex-column flex-column-fluid">
        <div id="kt_app_toolbar" class="app-toolbar pt-7 pt-lg-10">
            <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex align-items-stretch">
                <div class="app-toolbar-wrapper d-flex flex-stack flex-wrap gap-4 w-100">
                    <div class="page-title d-flex flex-column justify-content-center gap-1 me-3">
                        <h1 class="page-heading d-flex flex-column justify-content-center text-dark fw-bold fs-3 m-0">Edit Product</h1>
                        <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0">
                            <li class="breadcrumb-item text-muted">
                                <a href="{{ route('dashboard') }}" class="text-muted text-hover-primary">Home</a>
                            </li>
                            <li class="breadcrumb-item">
                                <span class="bullet bg-gray-400 w-5px h-2px"></span>
                            </li>
                            <li class="breadcrumb-item text-muted">
                                <a href="{{ route('all-products') }}" class="text-muted text-hover-primary">All Products</a>
                            </li>
                            <li class="breadcrumb-item">
                                <span class="bullet bg-gray-400 w-5px h-2px"></span>
                            </li>
                            <li class="breadcrumb-item text-muted">Edit Product</li>
                        </ul>
                    </div>
                    <div class="d-flex align-items-center gap-2 gap-lg-3">
                        <!-- <a href="#" class="btn btn-flex btn-outline btn-color-gray-700 btn-active-color-primary bg-body h-40px fs-7 fw-bold" data-bs-toggle="modal" data-bs-target="#kt_modal_view_users">Add Member</a>
                        <a href="#" class="btn btn-flex btn-primary h-40px fs-7 fw-bold" data-bs-toggle="modal" data-bs-target="#kt_modal_create_campaign">New Campaign</a> -->
                    </div>
                </div>
            </div>
        </div>
        <div id="kt_app_content" class="app-content flex-column-fluid">
            <div id="kt_app_content_container" class="app-container container-fluid">
                <form id="kt_ecommerce_add_product_form" class="form d-flex flex-column flex-lg-row" action="{{ route('update-product', $product->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="d-flex flex-column gap-7 gap-lg-10 w-100 w-lg-300px mb-7 me-lg-10">
                        <div class="card card-flush py-4">
                            <div class="card-header">
                                <div class="card-title">
                                    <h2>Main Image</h2>
                                </div>
                            </div>
                            <div class="card-body text-center pt-0">
                                <div class="image-input image-input-outline mb-3" data-kt-image-input="true">
                                    <div class="image-input-wrapper w-150px h-150px" style="background-image: url('{{ asset($product->image) }}');"></div>
                                    <label class="required btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Change main image">
                                        <i class="ki-outline ki-pencil fs-7"></i>
                                        <input type="file" name="image" accept="image/png, image/gif, image/jpeg , image/webp , image/avif"/>
                                        <input type="hidden" name="avatar_remove" />
                                    </label>
                                    <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="Cancel avatar">
                                        <i class="ki-outline ki-cross fs-2"></i>
                                    </span>
                                    <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="Remove avatar">
                                        <i class="ki-outline ki-cross fs-2"></i>
                                    </span>
                                </div>
                                <!-- Debug: Simple file input as fallback -->
                                <div class="mt-2">
                                    <small class="text-muted">Debug: Direct file input</small>
                                    <input type="file" name="debug_image" accept="image/png, image/gif, image/jpeg , image/webp, image/avif" class="form-control form-control-sm"/>
                                </div>
                                <div class="text-muted fs-7">Set the product thumbnail image. Only *.png, *.jpg and *.jpeg image files are accepted</div>
                            </div>
                        </div>
                        <div class="card card-flush py-4">
                            <div class="card-header">
                                <div class="card-title">
                                    <h2>Hover Image</h2>
                                </div>
                            </div>
                            <div class="card-body text-center pt-0">
                                <div class="image-input image-input-outline mb-3" data-kt-image-input="true">
                                    <div class="image-input-wrapper w-150px h-150px" style="background-image: url('{{ asset($product->hover_image) }}');"></div>
                                    <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Change hover image">
                                        <i class="ki-outline ki-pencil fs-7"></i>
                                        <input type="file" name="hover_image" accept="image/png, image/gif, image/jpeg , image/webp, image/avif" />
                                        <input type="hidden" name="avatar_remove_hover_image" />
                                    </label>
                                    <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="Cancel avatar">
                                        <i class="ki-outline ki-cross fs-2"></i>
                                    </span>
                                    <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="Remove avatar">
                                        <i class="ki-outline ki-cross fs-2"></i>
                                    </span>
                                </div>
                                <div class="text-muted fs-7">Set the product thumbnail image. Only *.png, *.jpg and *.jpeg avif image files are accepted</div>
                            </div>
                        </div>
                        <div class="card card-flush py-4">
                            <div class="card-header">
                                <div class="card-title">
                                    <h2>Gallery Images</h2>
                                </div>
                            </div>
                            <div class="card-body pt-0">
                                <label>Gallery Images</label>
                                <div class="d-flex flex-wrap gap-3">
                                    @foreach($product->images as $img)
                                        <div class="position-relative w-100px h-100px border rounded overflow-hidden gallery-image-item">
                                            <img src="{{ asset($img->image) }}" class="w-100 h-100 object-fit-cover previewable-image" alt="Gallery Image" style="cursor:pointer;" data-img="{{ asset($img->image) }}">
                                            <button type="button" class="btn btn-icon btn-danger btn-sm position-absolute top-0 end-0 m-1 remove-gallery-image" data-id="{{ $img->id }}" title="Remove image">
                                                <i class="ki-outline ki-cross fs-2"></i>
                                            </button>
                                            <input type="hidden" name="keep_gallery_images[]" value="{{ $img->id }}">
                                        </div>
                                    @endforeach
                                </div>
                                <input type="file" id="uploaded_files" name="uploaded_files[]" accept="image/png, image/gif, image/jpeg , image/webp, image/avif" multiple />
                                <div id="uploaded-files-preview" class="d-flex flex-wrap gap-3 mt-2"></div>
                                <div class="text-muted fs-7">Set the product media gallery. You can preview and remove newly uploaded files before saving.</div>
                            </div>
                        </div>
                        <div class="card card-flush py-4">
                            <div class="card-header">
                                <div class="card-title">
                                    <h2>Status</h2>
                                </div>
                                <div class="card-toolbar">
                                    <div class="rounded-circle bg-success w-15px h-15px" id="kt_ecommerce_add_product_status"></div>
                                </div>
                            </div>
                            <div class="card-body pt-0">
                                <select class="form-select mb-2" name="status" data-control="select2" data-hide-search="true" data-placeholder="Select an option" id="kt_ecommerce_add_product_status_select">
                                    <option value="published" {{ $product->status == 'published' ? 'selected' : '' }}>Published</option>
                                    <option value="draft" {{ $product->status == 'draft' ? 'selected' : '' }}>Draft</option>
                                    <option value="inactive" {{ $product->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                </select>
                                <div class="text-muted fs-7">Set the product status.</div>
                            </div>
                        </div>
                        <div class="card card-flush py-4">
                            <div class="card-header">
                                <div class="card-title">
                                    <h2>Product Details</h2>
                                </div>
                            </div>
                            <div class="card-body pt-0">
                              <script>
    // Make sure $subcategories has a category_id property
    const allSubcategories = @json($subcategories);
    const productSubcategorie = @json($product->subcategory_id);
    const selectedSubcategory = allSubcategories.find(subcat => subcat.id == productSubcategorie);
</script>

<label class="form-label">Categories</label>
<select 
    class="form-select mb-2" 
    name="category_id" 
    id="category_id"
    data-control="select2" 
    data-placeholder="Select an option" 
    data-allow-clear="true"
>
    <option></option>
    @foreach ($categories as $category)
        <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
        </option>
    @endforeach
</select>
<div class="text-muted fs-7 mb-7">Add product to a category.</div>
<a href="{{ route('product-category') }}" class="btn btn-light-primary btn-sm mb-10">
    <i class="ki-outline ki-plus fs-2"></i>Create new category
</a>

<label class="form-label">Sub Categories</label>
<select 
    class="form-select mb-2" 
    name="subcategory_id" 
    id="subcategory_id"
    data-control="select2" 
    data-placeholder="Select an option" 
    data-allow-clear="true"
>
    {{-- initially empty --}}
    <option></option>
</select>
<div class="text-muted fs-7 mb-7">Add product to a subcategory.</div>
<a href="{{ route('product-sub-category') }}" class="btn btn-light-primary btn-sm mb-10">
    <i class="ki-outline ki-plus fs-2"></i>Create new subcategory
</a>

                                <label class="form-label d-block">Tags</label>
                                <div class="d-flex flex-column">
                                    <div id="kt_ecommerce_add_product_tags_wrapper">
                                        <input id="kt_ecommerce_add_product_tags" name="tags" class="form-control mb-2" value="{{ collect($product->tags)->pluck('name')->implode(',') }}" />
                                    </div>
                                </div>
                                <div class="text-muted fs-7">Add tags to a product.</div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
                        <ul class="nav nav-custom nav-tabs nav-line-tabs nav-line-tabs-2x border-0 fs-4 fw-semibold mb-n2">
                            <li class="nav-item">
                                <a class="nav-link text-active-primary pb-4 active" data-bs-toggle="tab" href="#kt_ecommerce_add_product_general">General</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-active-primary pb-4" data-bs-toggle="tab" href="#kt_ecommerce_add_product_advanced">Advanced</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="kt_ecommerce_add_product_general" role="tab-panel">
                                <div class="d-flex flex-column gap-7 gap-lg-10">
                                    <div class="card card-flush py-4">
                                        <div class="card-header flex-wrap gap-3">
                                            <div class="card-title">
                                                <h2>Product Details</h2>
                                            </div>
                                            <div class="card-toolbar d-flex flex-wrap align-items-center gap-5 ms-auto">
                                                <div class="form-check form-switch form-check-custom form-check-solid mb-0">
                                                    <input class="form-check-input" type="checkbox" id="onlineStoreFieldsToggle">
                                                    <label class="form-check-label" for="onlineStoreFieldsToggle">Online Shopping Store</label>
                                                </div>
                                                <div class="form-check form-switch form-check-custom form-check-solid mb-0">
                                                    <input class="form-check-input" type="checkbox" name="is_featured" id="is_featured_toggle" value="1" {{ $product->is_featured ? 'checked' : '' }}/>
                                                    <label class="form-check-label" for="is_featured_toggle">Featured Product</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body pt-0">
                                            <div id="collectionsProductFields">
                                                <div class="mb-10 fv-row">
                                                    <label class="required form-label">Product Name</label>
                                                    <input type="text" name="name" id="product_name" class="form-control mb-2" placeholder="Product name" value="{{ $product->name }}" required/>
                                                </div>
                                                <div>
                                                    <label class="form-label">Description</label>
                                                    <div id="kt_ecommerce_add_product_description" name="description" class="min-h-200px mb-2">{!! $product['description'] !!}</div>
                                                    <input type="hidden" name="description" id="description">
                                                </div>
                                            </div>
                                            <div id="onlineStoreProductFields" class="d-none">
                                                <div class="mb-10 fv-row">
                                                    <label class="form-label">Product Name</label>
                                                    <input type="text" name="online_store_name" id="online_store_name" class="form-control mb-2" placeholder="Product name for Online Shopping Store" value="{{ old('online_store_name', $product->online_store_name) }}">
                                                </div>
                                                <div>
                                                    <label class="form-label">Description</label>
                                                    <div id="kt_ecommerce_online_store_description" class="min-h-200px mb-2">{!! old('online_store_description', $product->online_store_description) !!}</div>
                                                    <input type="hidden" name="online_store_description" id="online_store_description">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card card-flush py-4">
                                        <div class="card-header">
                                            <div class="card-title">
                                                <h2>Pricing</h2>
                                            </div>
                                        </div>
                                        <div class="card-header">
                                            <div class="form-check form-switch form-check-custom form-check-solid">
                                                <input class="form-check-input" type="checkbox" name="show_price" id="show_pricing" value="1" {{ $product->show_price ? 'checked' : '' }} />
                                                <label class="form-check-label" for="show_pricing">
                                                    Show Pricing
                                                </label>
                                            </div>
                                        </div>
                                        <div id="pricing_section" class="{{ old('show_pricing', $product->show_price) ? '' : 'd-none' }}">
                                            <div class="card-body pt-0">
                                                <div class="mb-10 fv-row">
                                                    <label class="form-label">Base Price</label>
                                                    <div class="row g-5">
                                                        <div class="col-md-6">
                                                            <label class="form-label required">PKR</label>
                                                            <div class="input-group mb-2">
                                                                <span class="input-group-text">PKR</span>
                                                                <input type="number" name="price" class="form-control" placeholder="Amount in PKR" value="{{ old('price', $product->price) }}" min="0" step="0.01" required />
                                                            </div>
                                                            <div class="text-muted fs-7">Price in Pakistani Rupee.</div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label class="form-label">Diamond Price</label>
                                                            <input type="number" name="diamond_price" class="form-control" placeholder="e.g. 97" value="{{ old('diamond_price', $product->diamond_price) }}" min="0" step="0.01" />
                                                            <div class="text-muted fs-7">For diamond products only (used in auto pricing).</div>
                                                        </div>
                                                        <!-- <div class="col-md-6">
                                                            <label class="form-label required">AED</label>
                                                            <div class="input-group mb-2">
                                                                <span class="input-group-text">AED</span>
                                                                <input type="number" name="price_aed" class="form-control" placeholder="Amount in AED" value="{{ old('price_aed', $product->price_aed) }}" min="0" step="0.01" />
                                                            </div>
                                                            <div class="text-muted fs-7">Price in United Arab Emirates Dirham.</div>
                                                        </div> -->
                                                    </div>
                                                </div>
                                                <div class="fv-row mb-10">
                                                    <label class="fs-6 fw-semibold mb-2">Discount Type
                                                        <span class="ms-1" data-bs-toggle="tooltip" title="Select a discount type that will be applied to this product">
                                                            <i class="ki-outline ki-information-5 text-gray-500 fs-6"></i>
                                                        </span>
                                                    </label>
                                                    <div class="row row-cols-1 row-cols-md-3 row-cols-lg-1 row-cols-xl-3 g-9" data-kt-buttons="true" data-kt-buttons-target="[data-kt-button='true']">
                                                        <div class="col">
                                                            <label class="btn btn-outline btn-outline-dashed btn-active-light-primary d-flex text-start p-6 {{ ($product->discount_type) ? 'active' : '' }}" data-kt-button="true">
                                                                <span class="form-check form-check-custom form-check-solid form-check-sm align-items-start mt-1">
                                                                    <input class="form-check-input" type="radio" name="discount_option" value="1" {{ ($product->discount_type) ? 'checked' : '' }}>
                                                                </span>
                                                                <span class="ms-5">
                                                                    <span class="fs-4 fw-bold text-gray-800 d-block">No Discount</span>
                                                                </span>
                                                            </label>
                                                        </div>
                                                        <div class="col">
                                                            <label class="btn btn-outline btn-outline-dashed btn-active-light-primary d-flex text-start p-6 {{ ($product->discount_percentage > 0) ? 'active' : '' }}" data-kt-button="true">
                                                                <span class="form-check form-check-custom form-check-solid form-check-sm align-items-start mt-1">
                                                                    <input class="form-check-input" type="radio" name="discount_option" value="2" {{ ($product->discount_percentage > 0) ? 'checked' : '' }}>
                                                                </span>
                                                                <span class="ms-5">
                                                                    <span class="fs-4 fw-bold text-gray-800 d-block">Percentage %</span>
                                                                </span>
                                                            </label>
                                                        </div>
                                                        <div class="col">
                                                            <label class="btn btn-outline btn-outline-dashed btn-active-light-primary d-flex text-start p-6 {{ ($product->discounted_price > 0 && !$product->discount_percentage) ? 'active' : '' }}" data-kt-button="true">
                                                                <span class="form-check form-check-custom form-check-solid form-check-sm align-items-start mt-1">
                                                                    <input class="form-check-input" type="radio" name="discount_option" value="3" {{ ($product->discounted_price > 0 && !$product->discount_percentage) ? 'checked' : '' }}>
                                                                </span>
                                                                <span class="ms-5">
                                                                    <span class="fs-4 fw-bold text-gray-800 d-block">Fixed Price</span>
                                                                </span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="mb-10 fv-row {{ ($product->discount_percentage > 0) ? '' : 'd-none' }}" id="kt_ecommerce_add_product_discount_percentage">
                                                    <label class="form-label">Set Discount Percentage</label>
                                                    <input type="number" name="discount_percentage" class="form-control mb-2" placeholder="Discounted percentage" min="0" max="100" value="{{ $product->discount_percentage }}"/>
                                                    <div class="text-muted fs-7">Set a percentage discount to be applied on this product.</div>
                                                </div>
                                                <div class="mb-10 fv-row {{ ($product->discounted_price > 0 && !$product->discount_percentage) ? '' : 'd-none' }}" id="kt_ecommerce_add_product_discount_fixed">
                                                    <label class="form-label">Fixed Discounted Price</label>
                                                    <input type="text" name="discounted_price" class="form-control mb-2" placeholder="Discounted price" value="{{ $product->discounted_price }}" />
                                                    <div class="text-muted fs-7">Set the discounted product price. The product will be reduced at the determined fixed price</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="kt_ecommerce_add_product_advanced" role="tab-panel">
                                <div class="d-flex flex-column gap-7 gap-lg-10">
                                    <div class="card card-flush py-4">
                                        <div class="card-header">
                                            <div class="card-title">
                                                <h2>Inventory</h2>
                                            </div>
                                        </div>
                                        <div class="card-body pt-0">
                                            <div class="mb-10 fv-row">
                                                <label class="form-label">SKU</label>
                                                <input type="text" name="sku" class="form-control mb-2" placeholder="SKU Number" value="{{ $product->sku }}" />
                                                <div class="text-muted fs-7">Enter the product SKU.</div>
                                            </div>
                                            <div class="mb-10 fv-row">
                                                <label class="form-label">Barcode</label>
                                                <input type="text" name="barcode" class="form-control mb-2" placeholder="Barcode Number" value="{{ $product->barcode }}"/>
                                                <div class="text-muted fs-7">Enter the product barcode number.</div>
                                            </div>
                                            <div class="mb-10 fv-row">
                                                <label class="form-label">Quantity</label>
                                                <div class="d-flex gap-3">
                                                    <input type="number" name="quantity" class="form-control mb-2" placeholder="On shelf" value="{{ $product->quantity }}" min="0"/>
                                                </div>
                                                <div class="text-muted fs-7">Enter the product quantity.</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card card-flush py-4">
                                        <div class="card-header">
                                            <div class="card-title">
                                                <h2>Meta Options</h2>
                                            </div>
                                        </div>
                                        <div class="card-body pt-0">
                                            <div class="mb-10">
                                                <label class="form-label">Meta Tag Title</label>
                                                <input type="text" class="form-control mb-2" name="meta_title" placeholder="Meta tag name" value="{{ $product->meta_title }}" />
                                                <div class="text-muted fs-7">Set a meta tag title. Recommended to be simple and precise keywords.</div>
                                            </div>
                                            <div class="mb-10">
                                                <label class="form-label">Meta Tag Description</label>
                                                <input type="text" class="form-control mb-2" name="meta_description" placeholder="Meta tag description" value="{!! $product->meta_description !!}" />
                                                <div class="text-muted fs-7">Set a meta tag description to the product for increased SEO ranking.</div>
                                            </div>
                                            <div>
                                                <label class="form-label">Meta Tag Keywords</label>
                                                <input id="kt_ecommerce_add_product_meta_keywords" name="meta_keywords" class="form-control mb-2" value="{{ $product->meta_keywords }}" />
                                                <div class="text-muted fs-7">Set a list of keywords that the product is related to. Separate the keywords by adding a comma
                                                <code>,</code>between each keyword.</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end">
                            <a href="{{route('all-products')}}" id="kt_ecommerce_add_product_cancel" class="btn btn-light me-5">Cancel</a>
                            <button type="submit" id="kt_ecommerce_add_product_submit" class="btn btn-primary">
                                <span class="indicator-label">Save Changes</span>
                                <span class="indicator-progress">Please wait...
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Image Preview Modal -->
<div id="imagePreviewModal" class="modal" tabindex="-1" style="display:none; position:fixed; z-index:1050; left:0; top:0; width:100vw; height:100vh; background:rgba(0,0,0,0.7); align-items:center; justify-content:center;">
    <span id="closeImagePreview" style="position:absolute;top:30px;right:40px;font-size:2rem;color:#fff;cursor:pointer;z-index:1060;">&times;</span>
    <img id="imagePreviewModalImg" src="" style="max-width:90vw;max-height:90vh;box-shadow:0 0 20px #000;border-radius:8px;">
</div>
<script>
   document.addEventListener('DOMContentLoaded', function () {
    const categorySelect = document.getElementById('category_id');
    const subcategorySelect = document.getElementById('subcategory_id');

    $('#category_id').on('change', function () {
        const catId = this.value;

        updateSubcategories(catId,subcategorySelect,categorySelect)
      
    });
     const initialCatId = categorySelect.value;
    if (initialCatId) {
        updateSubcategories(initialCatId, subcategorySelect, categorySelect);
    }
});
    function updateSubcategories(catId,subcategorySelect,categorySelect) {
          // Clear subcategory options
        subcategorySelect.innerHTML = '<option></option>';

        if (!catId) {
            return;
        }

        // Filter subcategories by category_id
        const filtered = allSubcategories.filter(sc => sc.category_id == catId);

        // Populate subcategory select
        filtered.forEach(sc => {
            const opt = document.createElement('option');
            opt.value = sc.id;
            opt.text = sc.name;
            if (selectedSubcategory && selectedSubcategory.id == sc.id) {
                opt.selected = true;
            }
            subcategorySelect.appendChild(opt);
        });

        // If using Select2, trigger update and set value
        if (window.jQuery && $(subcategorySelect).data('select2')) {
            $(subcategorySelect).trigger('change.select2');
        }
    }
     document.getElementById('kt_ecommerce_add_product_form').addEventListener('submit', function() {
        var editorContent = document.querySelector('#kt_ecommerce_add_product_description .ql-editor').innerHTML;
        document.getElementById('description').value = editorContent;

        var osEditor = document.querySelector('#kt_ecommerce_online_store_description .ql-editor');
        document.getElementById('online_store_description').value = osEditor ? osEditor.innerHTML : '';
    });

    (function () {
        var toggle = document.getElementById('onlineStoreFieldsToggle');
        var collectionsFields = document.getElementById('collectionsProductFields');
        var onlineStoreFields = document.getElementById('onlineStoreProductFields');
        var productName = document.getElementById('product_name');

        function syncProductFieldsView() {
            var onlineStoreMode = toggle.checked;
            collectionsFields.classList.toggle('d-none', onlineStoreMode);
            onlineStoreFields.classList.toggle('d-none', !onlineStoreMode);
            if (productName) {
                productName.required = !onlineStoreMode;
            }
        }

        toggle.addEventListener('change', syncProductFieldsView);
        syncProductFieldsView();
    })();
    document.querySelectorAll('input[name="discount_option"]').forEach((radio) => {
        radio.addEventListener('change', function () {
            const percentageField = document.getElementById('kt_ecommerce_add_product_discount_percentage');
            const fixedField = document.getElementById('kt_ecommerce_add_product_discount_fixed');

            if (this.value === '2') {
                percentageField.classList.remove('d-none');
                fixedField.classList.add('d-none');
            } else if (this.value === '3') {
                fixedField.classList.remove('d-none');
                percentageField.classList.add('d-none');
            } else {
                percentageField.classList.add('d-none');
                fixedField.classList.add('d-none');
            }
        });
    });

    document.getElementById('show_pricing').addEventListener('change', function () {
        const pricingSection = document.getElementById('pricing_section');
        if (this.checked) {
            pricingSection.classList.remove('d-none');
        } else {
            pricingSection.classList.add('d-none');
        }
    });

    document.getElementById('uploaded_files').addEventListener('change', function(event) {
        const previewContainer = document.getElementById('uploaded-files-preview');
        previewContainer.innerHTML = ''; // Clear previous previews

        Array.from(event.target.files).forEach((file, index) => {
            const reader = new FileReader();
            reader.onload = function(e) {
                const previewItem = document.createElement('div');
                previewItem.classList.add('position-relative', 'w-150px', 'h-150px', 'border', 'rounded', 'overflow-hidden');

                previewItem.innerHTML = `
                    <img src="${e.target.result}" alt="Uploaded File" class="w-100 h-100 object-fit-cover">
                    <button type="button" class="btn btn-icon btn-danger btn-sm position-absolute top-0 end-0 m-1" data-index="${index}" title="Remove file">
                        <i class="ki-outline ki-cross fs-2"></i>
                    </button>
                `;

                previewContainer.appendChild(previewItem);

                // Add remove functionality
                previewItem.querySelector('button').addEventListener('click', function() {
                    const files = Array.from(document.getElementById('uploaded_files').files);
                    files.splice(this.dataset.index, 1);

                    const dataTransfer = new DataTransfer();
                    files.forEach(file => dataTransfer.items.add(file));
                    document.getElementById('uploaded_files').files = dataTransfer.files;

                    previewItem.remove();
                });
            };
            reader.readAsDataURL(file);
        });
    });

    document.querySelectorAll('.remove-gallery-image').forEach(function(btn) {
        btn.addEventListener('click', function() {
            // Remove the image preview from the DOM
            this.closest('.gallery-image-item').remove();
        });
    });

    // Image preview popup
    document.querySelectorAll('.previewable-image').forEach(function(img) {
        img.addEventListener('click', function() {
            document.getElementById('imagePreviewModalImg').src = this.dataset.img;
            document.getElementById('imagePreviewModal').style.display = 'flex';
        });
    });

    document.getElementById('closeImagePreview').addEventListener('click', function() {
        document.getElementById('imagePreviewModal').style.display = 'none';
        document.getElementById('imagePreviewModalImg').src = '';
    });

    // Optional: close modal when clicking outside the image
    document.getElementById('imagePreviewModal').addEventListener('click', function(e) {
        if (e.target === this) {
            this.style.display = 'none';
            document.getElementById('imagePreviewModalImg').src = '';
        }
    });
</script>
@endsection

@section('jsfiles')
<script src="{{ asset('assets/js/custom/apps/ecommerce/catalog/save-product.js') }}"></script>
<script src="{{ asset('assets/plugins/custom/formrepeater/formrepeater.bundle.js') }}"></script>

@endsection