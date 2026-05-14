@extends('admin_layout.app')

@section('content')
<div class="app-main flex-column flex-row-fluid" id="kt_app_main">
    <div class="d-flex flex-column flex-column-fluid">
        <div id="kt_app_toolbar" class="app-toolbar pt-7 pt-lg-10">
            <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex align-items-stretch">
                <div class="app-toolbar-wrapper d-flex flex-stack flex-wrap gap-4 w-100">
                    <div class="page-title d-flex flex-column justify-content-center gap-1 me-3">
                        <h1 class="page-heading d-flex flex-column justify-content-center text-dark fw-bold fs-3 m-0">Edit Category</h1>
                        <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0">
                            <li class="breadcrumb-item text-muted">
                                <a href="/admin/dashboard" class="text-muted text-hover-primary">Home</a>
                            </li>
                            <li class="breadcrumb-item">
                                <span class="bullet bg-gray-400 w-5px h-2px"></span>
                            </li>
                            <li class="breadcrumb-item text-muted">Edit Category</li>
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
                <form id="category_form" class="form d-flex flex-column flex-lg-row" action="{{route('create-update-sub-category')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="d-flex flex-column gap-7 gap-lg-10 w-100 w-lg-300px mb-7 me-lg-10">
                        <div class="card card-flush py-4">
                            <div class="card-header">
                                <div class="card-title">
                                    <h2>Status</h2>
                                </div>
                                <div class="card-toolbar">
                                    <div class="rounded-circle bg-success w-15px h-15px" id="kt_ecommerce_add_category_status"></div>
                                </div>
                            </div>
                            <div class="card-body pt-0">
                                <select class="form-select mb-2" name="status" data-control="select2" data-hide-search="true" data-placeholder="Select an option" id="kt_ecommerce_add_category_status_select">
                                    <option></option>
                                    <option value="active" {{ $subcategory['status'] == 'active' ? 'selected' : '' }}>Published</option>
                                    <option value="inactive" {{ $subcategory['status'] == 'inactive' ? 'selected' : '' }}>Unpublished</option>
                                </select>
                                <div class="text-muted fs-7">Set the category status.</div>
                                <div class="d-none mt-10">
                                    <label for="kt_ecommerce_add_category_status_datepicker" class="form-label">Select publishing date and time</label>
                                    <input class="form-control" id="kt_ecommerce_add_category_status_datepicker" placeholder="Pick date & time" />
                                </div>
                            </div>
                        </div>
                        <div class="card card-flush py-4">
                            <div class="card-header">
                                <div class="card-title">
                                    <h2>Thumbnail</h2>
                                </div>
                            </div>
                            <div class="card-body text-center pt-0">
                            <style>.image-input-placeholder-1 { background-image: url({{asset($subcategory['image'])}}); } [data-bs-theme="dark"] .image-input-placeholder-1 { background-image: url({{asset($subcategory['image'])}}); }</style>
                                <div class="image-input image-input-empty image-input-outline image-input-placeholder-1 mb-3" data-kt-image-input="true">
                                    <div class="image-input-wrapper w-150px h-150px"></div>
                                    <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Change avatar">
                                        <i class="ki-outline ki-pencil fs-7"></i>
                                        <input type="file" name="image" accept=".png, .jpg, .jpeg" />
                                        <input type="hidden" name="avatar_remove" />
                                    </label>
                                    <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="Cancel avatar">
                                        <i class="ki-outline ki-cross fs-2"></i>
                                    </span>
                                    <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="Remove avatar">
                                        <i class="ki-outline ki-cross fs-2"></i>
                                    </span>
                                </div>
                                <div class="text-muted fs-7">Set the category thumbnail image. Only *.png, *.jpg and *.jpeg image files are accepted</div>
                            </div>
                        </div>
                        <input type="hidden" name="id" value="{{$subcategory['id']}}">
                        <div class="card card-flush py-4">
                            <div class="card-header">
                                <div class="card-title">
                                    <h2>Banner Type</h2>
                                </div>
                            </div>
                            <div class="card-body pt-0">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="banner_type" id="banner_image_option" value="image" {{ $subcategory['banner_type'] == 'image' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="banner_image_option">Banner Image</label>
                                </div>
                                <div class="form-check form-check-inline pt-2">
                                    <input class="form-check-input" type="radio" name="banner_type" id="banner_video_option" value="video"  {{ $subcategory['banner_type'] == 'video' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="banner_video_option">Banner Video</label>
                                </div>
                            </div>
                        </div>
                        <div class="card card-flush py-4">
                            <div class="card-header">
                                <div class="card-title">
                                    <h2>Banner Video</h2>
                                </div>
                            </div>
                            <div class="card-body text-center pt-0">
                            <style>.image-input-placeholder { background-image: url({{asset('assets/media/svg/files/blank-image.svg')}}); } [data-bs-theme="dark"] .image-input-placeholder { background-image: url({{asset("assets/media/svg/files/blank-image-dark.svg")}}); }</style>
                                <div class="image-input image-input-empty image-input-outline image-input-placeholder mb-3" data-kt-image-input="true">
                                    <div class="image-input-wrapper w-150px h-150px"></div>
                                    <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Change video">
                                        <i class="ki-outline ki-pencil fs-7"></i>
                                        <input type="file" name="banner_video" accept=".mp4, .webm" />
                                        <input type="hidden" name="video_remove" />
                                    </label>
                                    <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="Cancel video">
                                        <i class="ki-outline ki-cross fs-2"></i>
                                    </span>
                                    <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="Remove video">
                                        <i class="ki-outline ki-cross fs-2"></i>
                                    </span>
                                </div>
                                <video id="banner_video_preview" width="150" height="150" controls style="{{$subcategory['banner_type'] == 'image' ? 'display: none' : ''}}">
                                    <source src="{{ $subcategory['banner_type'] == 'video' ? asset($subcategory['banner_url']) : '' }}" type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>
                                <div class="text-muted fs-7">Set the category banner video. Only *.mp4 and *.webm video files are accepted</div>
                            </div>
                        </div>
                        <div class="card card-flush py-4">
                            <div class="card-header">
                                <div class="card-title">
                                    <h2>Banner Image</h2>
                                </div>
                            </div>
                            <div class="card-body text-center pt-0">
                            <style>.image-input-placeholder-2 { background-image: url({{asset($subcategory['banner_type'] == 'image' ? $subcategory['banner_url'] : 'assets/media/svg/files/blank-image.svg')}}); } [data-bs-theme="dark"] .image-input-placeholder-2 { background-image: url({{asset($subcategory['banner_type'] == 'image' ? $subcategory['banner_url'] : 'assets/media/svg/files/blank-image-dark.svg')}}); }</style>
                                <div class="image-input image-input-empty image-input-outline image-input-placeholder-2 mb-3" data-kt-image-input="true">
                                    <div class="image-input-wrapper w-150px h-150px"></div>
                                    <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Change avatar">
                                        <i class="ki-outline ki-pencil fs-7"></i>
                                        <input type="file" name="banner_image" accept=".png, .jpg, .jpeg" />
                                        <input type="hidden" name="avatar_remove" />
                                    </label>
                                    <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="Cancel avatar">
                                        <i class="ki-outline ki-cross fs-2"></i>
                                    </span>
                                    <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="Remove avatar">
                                        <i class="ki-outline ki-cross fs-2"></i>
                                    </span>
                                </div>
                                <div class="text-muted fs-7">Set the category banner image. Only *.png, *.jpg and *.jpeg image files are accepted</div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
                        <div class="card card-flush py-4">
                            <div class="card-header">
                                <div class="card-title">
                                    <h2>General</h2>
                                </div>
                            </div>
                            <div class="card-body pt-0">
                                <div class="mb-4 fv-row">
                                    <label class="required form-label">Select Category</label>
                                    <select class="form-select" name="category" data-control="select2" data-hide-search="true" data-placeholder="Select an option" id="kt_ecommerce_add_category_select">
                                        <option></option>
                                        @foreach($productCategories as $category)
                                            <option value="{{ $category->id }}" 
                                                {{ (isset($subcategory) && $subcategory['category_id'] == $category->id) ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-10 fv-row">
                                    <label class="required form-label">Category Name</label>
                                    <input type="text" name="name" class="form-control mb-2" placeholder="Product name" value="{{$subcategory['name']}}" />
                                    <div class="text-muted fs-7">A category name is required and recommended to be unique.</div>
                                </div>
                                <div>
                                    <label class="form-label">Description</label>
                                    <div id="kt_ecommerce_add_category_description" name="description" class="min-h-200px mb-2">{!! $subcategory['description'] !!}</div>
                                    <input type="hidden" name="description" id="description">
                                    <div class="text-muted fs-7">Set a description to the category for better visibility.</div>
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
                                    @foreach($subcategory->images as $img)
                                        <div class="position-relative w-100px h-100px border rounded overflow-hidden gallery-image-item">
                                            <img src="{{ asset($img->image) }}" class="w-100 h-100 object-fit-cover previewable-image" alt="Gallery Image" style="cursor:pointer;" data-img="{{ asset($img->image) }}">
                                            <button type="button" class="btn btn-icon btn-danger btn-sm position-absolute top-0 end-0 m-1 remove-gallery-image" data-id="{{ $img->id }}" title="Remove image">
                                                <i class="ki-outline ki-cross fs-2"></i>
                                            </button>
                                            <input type="hidden" name="keep_gallery_images[]" value="{{ $img->id }}">
                                        </div>
                                    @endforeach
                                </div>
                                <input type="file" id="uploaded_files" name="uploaded_files[]" accept="image/png, image/gif, image/jpeg , image/webp" multiple />
                                <div id="uploaded-files-preview" class="d-flex flex-wrap gap-3 mt-2"></div>
                                <div class="text-muted fs-7">Set the product media gallery. You can preview and remove newly uploaded files before saving.</div>
                            </div>
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
                                    <input type="text" class="form-control mb-2" name="meta_title" placeholder="Meta tag name" value="{{$subcategory['meta_title']}}"/>
                                    <div class="text-muted fs-7">Set a meta tag title. Recommended to be simple and precise keywords.</div>
                                </div>
                                <div class="mb-10">
                                    <label class="form-label">Meta Tag Description</label>
                                    <textarea name="meta_description" class="form-control mb-2" placeholder="Meta tag description" rows="10">{{$subcategory['meta_description']}}</textarea>
                                </div>
                                <div>
                                    <label class="form-label">Meta Tag Keywords</label>
                                    <input id="kt_ecommerce_add_category_meta_keywords" name="meta_keywords" class="form-control mb-2" value="{{$subcategory['meta_keywords']}}" />
                                    <div class="text-muted fs-7">Set a list of keywords that the category is related to. Separate the keywords by adding a comma
                                    <code>,</code>between each keyword.</div>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end">
                            <a href="{{ route('product-category') }}" id="kt_ecommerce_add_product_cancel" class="btn btn-light me-5">Cancel</a>
                            <button type="submit" id="kt_ecommerce_add_category_submit" class="btn btn-primary">
                                <span class="indicator-label">Update Changes</span>
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
@endsection

@section('jsfiles')
<script src="{{ asset('assets/js/custom/apps/ecommerce/catalog/save-category.js') }}"></script>
<script>
    document.getElementById('category_form').addEventListener('submit', function() {
        var editorContent = document.querySelector('#kt_ecommerce_add_category_description .ql-editor').innerHTML;
        document.getElementById('description').value = editorContent;
    });

    $(document).ready(function() {
        var statusSelect = document.getElementById('kt_ecommerce_add_category_status_select');
        var statusIndicator = document.getElementById('kt_ecommerce_add_category_status');

        function updateStatusIndicator() {
            if (statusSelect.value === 'active') {
                statusIndicator.classList.remove('bg-danger');
                statusIndicator.classList.add('bg-success');
            } else if (statusSelect.value === 'inactive') {
                statusIndicator.classList.remove('bg-success');
                statusIndicator.classList.add('bg-danger');
            }
        }

        $('#kt_ecommerce_add_category_status_select').on('change', updateStatusIndicator);
        updateStatusIndicator();

        // Banner type options settings
        const bannerImageOption = document.getElementById('banner_image_option');
        const bannerVideoOption = document.getElementById('banner_video_option');
        const bannerImageCard = document.querySelector('input[name="banner_image"]').closest('.card');
        const bannerVideoCard = document.querySelector('input[name="banner_video"]').closest('.card');

        function toggleBannerOptions() {
            if (bannerImageOption.checked) {
                bannerImageCard.style.display = 'block';
                bannerVideoCard.style.display = 'none';
            } else if (bannerVideoOption.checked) {
                bannerImageCard.style.display = 'none';
                bannerVideoCard.style.display = 'block';
            }
            // Preview video when selected
            document.querySelector('input[name="banner_video"]').addEventListener('change', function(event) {
                const file = event.target.files[0];
                const videoPreview = document.getElementById('banner_video_preview');
                if (file) {
                    const url = URL.createObjectURL(file);
                    videoPreview.src = url;
                    videoPreview.style.display = 'block';
                } else {
                    videoPreview.src = '';
                    videoPreview.style.display = 'none';
                }
            });
        };
        bannerImageOption.addEventListener('change', toggleBannerOptions);
        bannerVideoOption.addEventListener('change', toggleBannerOptions);

        toggleBannerOptions();
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