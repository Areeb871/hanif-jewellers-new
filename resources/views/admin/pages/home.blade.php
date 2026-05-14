@extends('admin_layout.app')

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Home Page Settings</h3>
        </div>
        <div class="card-body">
            <form action="#" method="POST" enctype="multipart/form-data">
                @csrf
                <!-- Banner Section -->
                <div class="form-group">
                    <label for="banner_type">Banner Type</label>
                    <div>
                        <label>
                            <input type="radio" name="banner_type" value="image" checked> Image
                        </label>
                    </div>
                    <div>
                        <label>
                            <input type="radio" name="banner_type" value="video"> Video
                        </label>
                    </div>
                </div>
                <div class="card card-flush py-4">
                    <div class="card-header">
                        <div class="card-title">
                            <h2>Banner Image</h2>
                        </div>
                    </div>
                    <div class="card-body text-center pt-0">
                        <style>.image-input-placeholder { background-image: url({{asset('assets/media/svg/files/blank-image.svg')}}); } [data-bs-theme="dark"] .image-input-placeholder { background-image: url({{asset("assets/media/svg/files/blank-image-dark.svg")}}); }</style>
                        <div class="image-input image-input-empty image-input-outline image-input-placeholder mb-3" data-kt-image-input="true">
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
                        <div class="text-muted fs-7">Set the banner image. Only *.png, *.jpg and *.jpeg image files are accepted</div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="banner_video">Banner Video</label>
                    <input type="file" name="banner_video" id="banner_video" class="form-control">
                </div>

                <!-- Section 1 -->
                <h4>Section 1</h4>
                @for ($i = 1; $i <= 4; $i++)
                    <div class="form-group">
                        <label for="section1_image_{{ $i }}">Image {{ $i }}</label>
                        <input type="file" name="section1_images[]" id="section1_image_{{ $i }}" class="form-control">
                    </div>
                @endfor

                <!-- Section 2 -->
                <h4>Section 2</h4>
                <div class="form-group">
                    <label for="section2_slider_images">Slider Images</label>
                    <input type="file" name="section2_slider_images[]" id="section2_slider_images" class="form-control" multiple>
                </div>

                <!-- Section 3 -->
                <h4>Section 3</h4>
                @for ($i = 1; $i <= 4; $i++)
                    <div class="form-group">
                        <label for="section3_image_{{ $i }}">Image {{ $i }}</label>
                        <input type="file" name="section3_images[]" id="section3_image_{{ $i }}" class="form-control">
                    </div>
                @endfor

                <!-- Section 4 -->
                <h4>Section 4</h4>
                <div class="form-group">
                    <label for="section4_brand_logos">Brand Logos</label>
                    <input type="file" name="section4_brand_logos[]" id="section4_brand_logos" class="form-control" multiple>
                </div>

                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>
    </div>
</div>
@endsection

@section('jsfiles')
@endsection