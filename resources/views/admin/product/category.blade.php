@extends('admin_layout.app')

@section('content')
<div class="app-main flex-column flex-row-fluid" id="kt_app_main">
    <div class="d-flex flex-column flex-column-fluid">
        <div id="kt_app_toolbar" class="app-toolbar pt-7 pt-lg-10">
            <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex align-items-stretch">
                <div class="app-toolbar-wrapper d-flex flex-stack flex-wrap gap-4 w-100">
                    <div class="page-title d-flex flex-column justify-content-center gap-1 me-3">
                        <h1 class="page-heading d-flex flex-column justify-content-center text-dark fw-bold fs-3 m-0">Categories</h1>
                        <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0">
                            <li class="breadcrumb-item text-muted">
                                <a href="/admin/dashboard" class="text-muted text-hover-primary">Home</a>
                            </li>
                            <li class="breadcrumb-item">
                                <span class="bullet bg-gray-400 w-5px h-2px"></span>
                            </li>
                            <li class="breadcrumb-item text-muted">Categoreis</li>
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
                <div class="card card-flush">
                    <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                        <div class="card-title">
                            <div class="d-flex align-items-center position-relative my-1">
                                <i class="ki-outline ki-magnifier fs-3 position-absolute ms-4"></i>
                                <input type="text" data-kt-ecommerce-category-filter="search" class="form-control form-control-solid w-250px ps-12" placeholder="Search Category" />
                            </div>
                        </div>
                        <div class="card-toolbar">
                            <a href="/admin/product/add-category" class="btn btn-primary">Add Category</a>
                        </div>
                    </div>
                    <div class="card-body pt-0">
                        <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_ecommerce_category_table">
                            <thead>
                                <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                                    <th class="w-10px pe-2">
                                        <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                            <input class="form-check-input" type="checkbox" data-kt-check="true" data-kt-check-target="#kt_ecommerce_category_table .form-check-input" value="1" />
                                        </div>
                                    </th>
                                    <th class="min-w-250px">Category</th>
                                    <th class="min-w-150px">Slug</th>
                                    <th class="min-w-150px">Category Status</th>
                                    <th class="min-w-150px">Banner Type</th>
                                    <th class="text-end min-w-70px">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="fw-semibold text-gray-600">
                                @foreach($productCategories as $key => $category)
                                <tr>
                                    <td>
                                        <div class="form-check form-check-sm form-check-custom form-check-solid">
                                            <input class="form-check-input" type="checkbox" value="{{$key}}" />
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex">
                                            <a href="/admin/product/edit-category/1" class="symbol symbol-50px">
                                                <span class="symbol-label" style="background-image:url({{url(asset($category['image']))}});"></span>
                                            </a>
                                            <div class="ms-5">
                                                <a href="/admin/product/edit-category/1" class="text-gray-800 text-hover-primary fs-5 fw-bold mb-1" data-kt-ecommerce-category-filter="category_name">{{ $category['name'] }}</a>
                                                <div class="text-muted fs-7 fw-bold">{!! \Illuminate\Support\Str::words($category['description'], 10) !!}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="text-muted fs-7 fw-bold">{{ $category['slug'] }}</span>
                                    </td>
                                    <td>
                                        @if ($category['status'] == 'active')
                                        <div class="badge badge-light-success">Published</div>
                                        @else
                                        <div class="badge badge-light-danger">Un Published</div>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($category['banner_type'] == 'image')
                                        <div class="badge badge-warning">Image</div>
                                        @else
                                        <div class="badge badge-info">Video</div>
                                        @endif
                                    </td>
                                    <td class="text-end">
                                        <a href="#" class="btn btn-sm btn-light btn-active-light-primary btn-flex btn-center" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
                                        <i class="ki-outline ki-down fs-5 ms-1"></i></a>
                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                                            <div class="menu-item px-3">
                                                <a href="{{ route('edit-product-category', $category['id']) }}" class="menu-link px-3">Edit</a>
                                            </div>
                                        <div class="menu-item px-3">
                                                <a href="#" class="menu-link px-3" data-bs-toggle="modal" data-bs-target="#deleteCategoryModal{{ $category['id'] }}">Delete</a>
                                            </div>
                                        </div>
                                        <!-- Delete Confirmation Modal -->
                                        <div class="modal fade" id="deleteCategoryModal{{ $category['id'] }}" tabindex="-1" aria-labelledby="deleteCategoryModalLabel{{ $category['id'] }}" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="deleteCategoryModalLabel{{ $category['id'] }}">Are you sure you want to delete this category?</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                        <button type="button" class="btn btn-danger" onclick="document.getElementById('delete-category-form-{{ $category['id'] }}').submit();">Delete</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <form id="delete-category-form-{{ $category['id'] }}" action="{{ route('delete-product-category', $category['id']) }}" method="POST" style="display: none;">
                                            @csrf
                                            @method('GET')
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('jsfiles')
<script src="{{ asset('assets/js/custom/apps/ecommerce/catalog/categories.js') }}"></script>
@endsection