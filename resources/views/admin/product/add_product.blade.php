@extends('admin_layout.app')

@section('content')
<div class="app-main flex-column flex-row-fluid" id="kt_app_main">
    <div class="d-flex flex-column flex-column-fluid">
        <div id="kt_app_toolbar" class="app-toolbar pt-7 pt-lg-10">
            <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex align-items-stretch">
                <div class="app-toolbar-wrapper d-flex flex-stack flex-wrap gap-4 w-100">
                    <div class="page-title d-flex flex-column justify-content-center gap-1 me-3">
                        <h1 class="page-heading d-flex flex-column justify-content-center text-dark fw-bold fs-3 m-0">Add Product</h1>
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
                            <li class="breadcrumb-item text-muted">Add Product</li>
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
                <form id="kt_ecommerce_add_product_form" class="form d-flex flex-column flex-lg-row" action="{{ route('product-create') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="d-flex flex-column gap-7 gap-lg-10 w-100 w-lg-300px mb-7 me-lg-10">
                        <div class="card card-flush py-4">
                            <div class="card-header">
                                <div class="card-title">
                                    <h2>Main Image</h2>
                                </div>
                            </div>
                            <div class="card-body text-center pt-0">
                            <style>.image-input-placeholder { background-image: url({{asset('assets/media/svg/files/blank-image.svg')}}); } [data-bs-theme="dark"] .image-input-placeholder { background-image: url({{asset("assets/media/svg/files/blank-image-dark.svg")}}); }</style>
                                <div class="image-input image-input-empty image-input-outline image-input-placeholder mb-3" data-kt-image-input="true">
                                    <div class="image-input-wrapper w-150px h-150px"></div>
                                    <label class="required btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Add Main Image">
                                        <i class="ki-outline ki-pencil fs-7"></i>
                                        <input type="file" name="image" accept="image/png, image/gif, image/jpeg , image/webp , image/avif" required/>
                                        <input type="hidden" name="avatar_remove" />
                                    </label>
                                    <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="Cancel avatar">
                                        <i class="ki-outline ki-cross fs-2"></i>
                                    </span>
                                    <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="Remove avatar">
                                        <i class="ki-outline ki-cross fs-2"></i>
                                    </span>
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
                            <style>.image-input-placeholder { background-image: url({{asset('assets/media/svg/files/blank-image.svg')}}); } [data-bs-theme="dark"] .image-input-placeholder { background-image: url({{asset("assets/media/svg/files/blank-image-dark.svg")}}); }</style>
                                <div class="image-input image-input-empty image-input-outline image-input-placeholder mb-3" data-kt-image-input="true">
                                    <div class="image-input-wrapper w-150px h-150px"></div>
                                    <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Change avatar">
                                        <i class="ki-outline ki-pencil fs-7"></i>
                                        <input type="file" name="hover_image" accept="image/png, image/gif, image/jpeg , image/webp , image/avif" />
                                        <input type="hidden" name="avatar_remove_hover_image" />
                                    </label>
                                    <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="Cancel avatar">
                                        <i class="ki-outline ki-cross fs-2"></i>
                                    </span>
                                    <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="Remove avatar">
                                        <i class="ki-outline ki-cross fs-2"></i>
                                    </span>
                                </div>
                                <div class="text-muted fs-7">Set the product thumbnail image. Only *.png, *.jpg and *.jpeg image files are accepted</div>
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
                                    <option value="published" selected="selected">Published</option>
                                    <option value="draft">Draft</option>
                                    <option value="inactive">Inactive</option>
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
        <option value="{{ $category->id }}">{{ $category->name }}</option>
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
                                        <input id="kt_ecommerce_add_product_tags" name="tags" class="form-control mb-2" value="" />
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
                                                    <input class="form-check-input" type="checkbox" name="is_featured" id="is_featured_toggle" value="1" />
                                                    <label class="form-check-label" for="is_featured_toggle">Featured Product</label>
                                                </div>
                                                <div class="form-check form-switch form-check-custom form-check-solid mb-0">
                                                    <input class="form-check-input" type="checkbox" name="is_pinned" id="is_pinned_toggle" value="1" />
                                                    <label class="form-check-label" for="is_pinned_toggle">Pin to Top</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body pt-0">
                                            <div id="collectionsProductFields">
                                                <div class="mb-10 fv-row">
                                                    <label class="required form-label">Product Name</label>
                                                    <input type="text" name="name" id="product_name" class="form-control mb-2" placeholder="Product name" value="" required/>
                                                </div>
                                                <div>
                                                    <label class="form-label">Description</label>
                                                    <div id="kt_ecommerce_add_product_description" name="description" class="min-h-200px mb-2"></div>
                                                    <input type="hidden" name="description" id="description">
                                                </div>
                                            </div>
                                            <div id="onlineStoreProductFields" class="d-none">
                                                <div class="mb-10 fv-row">
                                                    <label class="form-label">Product Name</label>
                                                    <input type="text" name="online_store_name" id="online_store_name" class="form-control mb-2" placeholder="Product name for Online Shopping Store" value="{{ old('online_store_name') }}">
                                                </div>
                                                <div>
                                                    <label class="form-label">Description</label>
                                                    <div id="kt_ecommerce_online_store_description" class="min-h-200px mb-2">{!! old('online_store_description') !!}</div>
                                                    <input type="hidden" name="online_store_description" id="online_store_description">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card card-flush py-4">
                                        <div class="card-header">
                                            <div class="card-title">
                                                <h2>Media</h2>
                                            </div>
                                        </div>
                                        <div class="card-body pt-0">
                                            <div class="fv-row mb-2">
                                                <div class="image-input image-input-empty image-input-outline" id="media-gallery" data-kt-image-input="true">
                                                <style>.image-input-placeholder-gallery { background-image: url({{asset('assets/media/svg/files/blank-image.svg')}}); } [data-bs-theme="dark"] .image-input-placeholder-gallery { background-image: url({{asset("assets/media/svg/files/blank-image-dark.svg")}}); }</style>
                                                    <div class="image-input-wrapper w-150px h-150px image-input-placeholder-gallery"></div>
                                                    <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Add files">
                                                        <i class="ki-outline ki-plus fs-1"></i>
                                                        <input type="file" name="uploaded_files[]" id="uploaded_files" accept="image/png, image/gif, image/jpeg , image/webp, image/avif" multiple />
                                                    </label>
                                                    <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="Remove all files">
                                                        <i class="ki-outline ki-cross fs-2"></i>
                                                    </span>
                                                </div>
                                            </div>
                                            <div id="uploaded-files-preview" class="d-flex flex-wrap gap-3 mt-3">
                                                <!-- Preview of uploaded files will be dynamically added here -->
                                            </div>
                                            <div class="text-muted fs-7">Set the product media gallery. You can preview and remove uploaded files.</div>
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
                                                <input class="form-check-input" type="checkbox" name="show_price" id="show_pricing" value="1" checked />
                                                <label class="form-check-label" for="show_pricing">
                                                    Show Pricing
                                                </label>
                                            </div>
                                        </div>
                                        <div id="pricing_section" class="{{ old('show_pricing', 1) ? '' : 'd-none' }}">
                                            <div class="card-body pt-0">
                                                <div class="mb-10 fv-row">
                                                    <label class="form-label">Base Price</label>
                                                    <div class="row g-5">
                                                        <div class="col-md-6">
                                                            <label class="form-label required">PKR</label>
                                                            <div class="input-group mb-2">
                                                                <span class="input-group-text">PKR</span>
                                                                <input type="number" name="price" class="form-control" placeholder="Amount in Pakistani Rupee" value="{{ old('price') }}" min="0" step="0.01" required />
                                                            </div>
                                                            <div class="text-muted fs-7">Price in Pakistani Rupee.</div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label class="form-label">Diamond Price</label>
                                                            <input type="number" name="diamond_price" class="form-control" placeholder="e.g. 97" value="{{ old('diamond_price') }}" min="0" step="0.01" />
                                                            <div class="text-muted fs-7">For diamond products only (used in auto pricing).</div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label class="form-label">Watch Rate</label>
                                                            <input type="number" name="watch_rate" class="form-control" placeholder="Watch price in CHF" value="{{ old('watch_rate') }}" min="0" step="0.01" />
                                                            <div class="text-muted fs-7">For watch products only. CHF, discount and GST are taken from Watch Pricing settings.</div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label class="form-label">Gold Weight (grams)</label>
                                                            <input type="number" name="gold_weight" class="form-control" placeholder="e.g. 5.25" value="{{ old('gold_weight') }}" min="0" step="0.001" />
                                                            <div class="text-muted fs-7">Weight in grams. Used in auto price calculation (gold &amp; diamond).</div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label class="form-label">Jewellery Service</label>
                                                            <select name="gold_service_id" class="form-select">
                                                                @foreach($goldServices as $service)
                                                                    <option value="{{ $service->id }}" @selected((string) old('gold_service_id', $goldServices->firstWhere('slug', 'fine')?->id) === (string) $service->id)>
                                                                        {{ $service->name }}{{ $service->is_active ? '' : ' (Inactive)' }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                            <div class="text-muted fs-7">Controls the weight threshold and OC Final pricing rule.</div>
                                                        </div>
                                                        <!-- <div class="col-md-6">
                                                            <label class="form-label required">AED</label>
                                                            <div class="input-group mb-2">
                                                                <span class="input-group-text">AED</span>
                                                                <input type="number" name="price_aed" class="form-control" placeholder="Amount in United Arab Emirates Dirham" value="{{ old('price_aed') }}" min="0" step="0.01" required />
                                                            </div>
                                                            <div class="text-muted fs-7">Price in United Arab Emirates Dirham.</div>
                                                        </div> -->
                                                    </div>
                                                </div>
                                                <div class="fv-row mb-10">
                                                    <label class="fs-6 fw-semibold mb-2">Discount Type
                                                    <span class="ms-1" data-bs-toggle="tooltip" title="Select a discount type that will be applied to this product">
                                                        <i class="ki-outline ki-information-5 text-gray-500 fs-6"></i>
                                                    </span></label>
                                                    <div class="row row-cols-1 row-cols-md-3 row-cols-lg-1 row-cols-xl-3 g-9" data-kt-buttons="true" data-kt-buttons-target="[data-kt-button='true']">
                                                        <div class="col">
                                                            <label class="btn btn-outline btn-outline-dashed btn-active-light-primary active d-flex text-start p-6" data-kt-button="true">
                                                                <span class="form-check form-check-custom form-check-solid form-check-sm align-items-start mt-1">
                                                                    <input class="form-check-input" type="radio" name="discount_option" value="1" checked="checked" />
                                                                </span>
                                                                <span class="ms-5">
                                                                    <span class="fs-4 fw-bold text-gray-800 d-block">No Discount</span>
                                                                </span>
                                                            </label>
                                                        </div>
                                                        <div class="col">
                                                            <label class="btn btn-outline btn-outline-dashed btn-active-light-primary d-flex text-start p-6" data-kt-button="true">
                                                                <span class="form-check form-check-custom form-check-solid form-check-sm align-items-start mt-1">
                                                                    <input class="form-check-input" type="radio" name="discount_option" value="2" />
                                                                </span>
                                                                <span class="ms-5">
                                                                    <span class="fs-4 fw-bold text-gray-800 d-block">Percentage %</span>
                                                                </span>
                                                            </label>
                                                        </div>
                                                        <div class="col">
                                                            <label class="btn btn-outline btn-outline-dashed btn-active-light-primary d-flex text-start p-6" data-kt-button="true">
                                                                <span class="form-check form-check-custom form-check-solid form-check-sm align-items-start mt-1">
                                                                    <input class="form-check-input" type="radio" name="discount_option" value="3" />
                                                                </span>
                                                                <span class="ms-5">
                                                                    <span class="fs-4 fw-bold text-gray-800 d-block">Fixed Price</span>
                                                                </span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="d-none mb-10 fv-row" id="kt_ecommerce_add_product_discount_percentage">
                                                    <label class="form-label">Set Discount Percentage</label>
                                                        <input type="number" name="discounted_percentage" class="form-control mb-2" placeholder="Discounted percentage" min="0" max="100"/>
                                                    <div class="text-muted fs-7">Set a percentage discount to be applied on this product.</div>
                                                </div>
                                                <div class="d-none mb-10 fv-row" id="kt_ecommerce_add_product_discount_fixed">
                                                    <label class="form-label">Fixed Discounted Price</label>
                                                    <input type="text" name="discounted_price" class="form-control mb-2" placeholder="Discounted price" />
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
                                                <input type="text" name="sku" class="form-control mb-2" placeholder="SKU Number" value="" />
                                                <div class="text-muted fs-7">Enter the product SKU.</div>
                                            </div>
                                            <div class="mb-10 fv-row">
                                                <label class="form-label">Barcode</label>
                                                <input type="text" name="barcode" class="form-control mb-2" placeholder="Barcode Number" value=""/>
                                                <div class="text-muted fs-7">Enter the product barcode number.</div>
                                            </div>
                                            <div class="mb-10 fv-row">
                                                <label class="form-label">Quantity</label>
                                                <div class="d-flex gap-3">
                                                    <input type="number" name="quantity" class="form-control mb-2" placeholder="On shelf" value="" min="0"/>
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
                                                <input type="text" class="form-control mb-2" name="meta_title" placeholder="Meta tag name" />
                                                <div class="text-muted fs-7">Set a meta tag title. Recommended to be simple and precise keywords.</div>
                                            </div>
                                            <div class="mb-10">
                                                <label class="form-label">Meta Tag Description</label>
                                                <div id="kt_ecommerce_add_product_meta_description" name="kt_ecommerce_add_product_meta_description" class="min-h-100px mb-2"></div>
                                                <div class="text-muted fs-7">Set a meta tag description to the product for increased SEO ranking.</div>
                                            </div>
                                            <div>
                                                <label class="form-label">Meta Tag Keywords</label>
                                                <input id="kt_ecommerce_add_product_meta_keywords" name="kt_ecommerce_add_product_meta_keywords" class="form-control mb-2" />
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
<script>
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
    document.addEventListener('DOMContentLoaded', function() {
    const categorySelect    = document.getElementById('category_id');
    const subcategorySelect = document.getElementById('subcategory_id');
    $('#category_id').on('change', function() {
        const catId = this.value;
        // Clear subcategory options
        subcategorySelect.innerHTML = '<option></option>';

        if (!catId) {
            // no category selected, leave subcategories empty
            return;
        }

        // Filter out only those subcategories matching selected category
        const filtered = allSubcategories.filter(sc => sc.category_id == catId);

        // Populate subcategory <select>
        filtered.forEach(sc => {
            const opt = document.createElement('option');
            opt.value = sc.id;
            opt.text  = sc.name;
            subcategorySelect.appendChild(opt);
        });

        // If using Select2, trigger an update:
        if (window.jQuery && $(subcategorySelect).data('select2')) {
            $(subcategorySelect).trigger('change.select2');
        }
    });
});
</script>
@endsection

@section('jsfiles')
<script src="{{ asset('assets/js/custom/apps/ecommerce/catalog/save-product.js') }}"></script>
<script src="{{ asset('assets/plugins/custom/formrepeater/formrepeater.bundle.js') }}"></script>
<script>
    
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

    // Capture description HTML on submit (match update page behavior)
    document.getElementById('kt_ecommerce_add_product_form').addEventListener('submit', function() {
        var editorContentContainer = document.querySelector('#kt_ecommerce_add_product_description');
        var quillEditor = editorContentContainer && editorContentContainer.querySelector('.ql-editor');
        var html = quillEditor ? quillEditor.innerHTML : editorContentContainer.innerHTML;
        document.getElementById('description').value = html;

        var osContainer = document.querySelector('#kt_ecommerce_online_store_description');
        var osEditor = osContainer && osContainer.querySelector('.ql-editor');
        document.getElementById('online_store_description').value = osEditor ? osEditor.innerHTML : (osContainer ? osContainer.innerHTML : '');
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
</script>
@endsection
