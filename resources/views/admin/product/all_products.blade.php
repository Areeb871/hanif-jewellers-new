@extends('admin_layout.app')

@section('content')
<div class="app-main flex-column flex-row-fluid" id="kt_app_main">
    <div class="d-flex flex-column flex-column-fluid">
        <div id="kt_app_toolbar" class="app-toolbar pt-7 pt-lg-10">
            <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex align-items-stretch">
                <div class="app-toolbar-wrapper d-flex flex-stack flex-wrap gap-4 w-100">
                    <div class="page-title d-flex flex-column justify-content-center gap-1 me-3">
                        <h1 class="page-heading d-flex flex-column justify-content-center text-dark fw-bold fs-3 m-0">All Products</h1>
                        <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0">
                            <li class="breadcrumb-item text-muted">
                                <a href="/admin/dashboard" class="text-muted text-hover-primary">Home</a>
                            </li>
                            <li class="breadcrumb-item">
                                <span class="bullet bg-gray-400 w-5px h-2px"></span>
                            </li>
                            <li class="breadcrumb-item text-muted">All Products</li>
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
            <input type="hidden" id="base_url" value="{{ url('/') }}">
            <div id="kt_app_content_container" class="app-container container-fluid">
                <div class="card card-flush">
                    <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                        <div class="card-title">
                            <div class="d-flex align-items-center position-relative my-1">
                                <i class="ki-outline ki-magnifier fs-3 position-absolute ms-4"></i>
                                <input type="text" id="search_product" data-kt-ecommerce-product-filter="search" class="form-control form-control-solid w-300px ps-12" placeholder="Search Product By Name" />
                            </div>
                        </div>
                        <div class="card-toolbar flex-row-fluid justify-content-end gap-5">
                            <div class="w-100 mw-150px">
                                <select id="filter_status" class="form-select form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="Status" data-kt-ecommerce-product-filter="status">
                                    <option>Status</option>
                                    <option value="all">All</option>
                                    <option value="published">Published</option>
                                    <option value="draft">Draft</option>
                                    <option value="inactive">Inactive</option>
                                </select>
                            </div>
                            <div class="w-100 mw-150px">
                                <select id="filter_category" class="form-select form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="Category" data-kt-ecommerce-product-filter="category">
                                    <option>Category</option>
                                    @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="w-100 mw-150px">
                                <select id="filter_subcategory" class="form-select form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="Subcategory" data-kt-ecommerce-product-filter="subcategory">
                                    <option>Subcategory</option>
                                    @foreach($subcategories as $subcategory)
                                    <option value="{{ $subcategory->id }}">{{ $subcategory->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="button" id="btn-delete-selected" class="btn btn-danger" style="display: none;">
                                <i class="ki-outline ki-trash fs-2"></i> Delete Selected
                            </button>
                            <a href="/admin/product/add" class="btn btn-primary">Add Product</a>
                        </div>
                        
                    </div>
                    <div class="card-body pt-0">
                        <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_ecommerce_products_table">
                            <thead>
                                <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                                    <th class="w-10px pe-2">
                                        <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                            <input class="form-check-input" type="checkbox" id="select-all-checkbox" data-kt-check="true" data-kt-check-target="#kt_ecommerce_products_table .product-checkbox" value="1" />
                                        </div>
                                    </th>
                                    <th class="min-w-200px">Product</th>
                                    <th class="text-end min-w-100px">SKU</th>
                                    <th class="text-end min-w-70px">Qty</th>
                                    <th class="text-end min-w-100px">Price</th>
                                    <th class="text-end min-w-100px">Barcode</th>
                                    <th class="text-end min-w-100px">Featured</th>
                                    <th class="text-end min-w-100px">Status</th>
                                    <th class="text-end min-w-70px">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="fw-semibold text-gray-600">
                                @foreach($products as $product)
                                <tr>
                                    <td>
                                        <div class="form-check form-check-sm form-check-custom form-check-solid">
                                            <input class="form-check-input product-checkbox" type="checkbox" name="selected_products[]" value="{{ $product->id }}" />
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <a href="#" class="symbol symbol-50px">
                                                <span class="symbol-label" style='background-image:url({{url($product->image)}});'></span>
                                            </a>
                                            <div class="ms-5">
                                                <a href="{{ route('update-product',$product->id) }}" class="text-gray-800 text-hover-primary fs-5 fw-bold" data-kt-ecommerce-product-filter="product_name">{{ $product->name }}</a>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-end pe-0">
                                        <span class="fw-bold">{{ $product->sku }}</span>
                                    </td>
                                    <td class="text-end pe-0" data-order="17">
                                        <span class="fw-bold ms-3">{{ $product->quantity }}</span>
                                    </td>
                                    <td class="text-end pe-0">{{ $product->price }}</td>
                                    <td class="text-end pe-0">{{ $product->barcode }}</td>
                                    <td>
                                         <div class="">
                                            <div class="form-check form-switch form-check-custom form-check-solid" style="float: right;">
                                                <input class="form-check-input" type="checkbox" name="is_featured" id="featured_{{ $product->id }}" value="1" data-id="{{ $product->id }}" {{ $product->is_featured ? 'checked' : '' }}/>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-end pe-0" data-order="Published">
                                        @if($product->status == 'published')
                                        <div class="badge badge-light-primary">{{ $product->status }}</div>
                                        @elseif($product->status == 'draft')
                                        <div class="badge badge-light-warning">{{ $product->status }}</div>
                                        @elseif($product->status == 'inactive')
                                        <div class="badge badge-light-danger">{{ $product->status }}</div>
                                        @endif
                                    </td>
                                    <td class="text-end">
                                        <a href="#" class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
                                        <i class="ki-outline ki-down fs-5 ms-1"></i></a>
                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                                            <div class="menu-item px-3">
                                                <a href="{{ route('update-product',$product->id) }}" class="menu-link px-3">Edit</a>
                                            </div>
                                            <div class="menu-item px-3">
                                                {{-- <a href="{{ route('delete-product',$product->id) }}" class="menu-link px-3">Delete</a> --}}
                                                <a href="javascript:void(0);" class="menu-link px-3 btn-delete-product" 
                                                    data-id="{{ $product->id }}" 
                                                    data-name="{{ $product->name }}">
                                                    Delete
                                                    </a>
                                            </div>
                                            {{-- {{ route('product.update', $product->id) }} --}}
                                            <!-- <div class="menu-item px-3">
                                                <a href="#" class="menu-link px-3" data-kt-ecommerce-product-filter="delete_row">Delete</a>
                                            </div> -->
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="custom-pagination-wrapper" id="pagination-links">
                            {{ $products->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteConfirmationModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-4">
            <div class="modal-header">
                <h5 class="modal-title text-danger">Confirm Deletion</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete <strong id="productName"></strong>?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                <form id="deleteProductForm" method="POST">
                    @csrf
                    @method('GET')
                    <button type="submit" class="btn btn-danger">Yes</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Bulk Delete Confirmation Modal -->
<div class="modal fade" id="bulkDeleteModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-4">
            <div class="modal-header">
                <h5 class="modal-title text-danger">Confirm Bulk Deletion</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p id="bulkDeleteMessage"></p>
                <p class="text-muted small mt-2">This action cannot be undone.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <form id="bulkDeleteForm">
                    @csrf
                    <button type="submit" id="btn-bulk-delete-confirm" class="btn btn-danger">Yes, Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>


@section('jsfiles')
<script src="{{ asset('assets/js/custom/apps/ecommerce/catalog/products.js') }}"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
// Function to initialize featured checkboxes (global function)
window.initializeFeaturedCheckboxes = function() {
    $('.form-check-input[name="is_featured"]').off('change').on('change', function () {
        let productId = $(this).data('id');
        let isFeatured = $(this).is(':checked') ? 1 : 0;
        let checkbox = $(this);
        
        // Disable checkbox during request and show loading state
        checkbox.prop('disabled', true);
        checkbox.closest('.form-check').addClass('loading');
        
        const BASE_URL = "{{ url('/') }}";
        $.ajax({
            url: BASE_URL+'/admin/product/updatefeatured/' + productId,
            type: 'POST',
            data: {
                is_featured: isFeatured,
                _method: 'PUT',
                _token: '{{ csrf_token() }}'
            },
            success: function (response) {
                if (response.success) {
                    toastr.success(response.message);
                } else {
                    toastr.error(response.message || 'Update failed.');
                    // Revert checkbox state on failure
                    checkbox.prop('checked', !isFeatured);
                }
            },
            error: function (xhr) {
                console.error('AJAX Error:', xhr);
                toastr.error(xhr.responseJSON?.message || 'Failed to update featured status');
                // Revert checkbox state on error
                checkbox.prop('checked', !isFeatured);
            },
            complete: function () {
                // Re-enable checkbox and remove loading state
                checkbox.prop('disabled', false);
                checkbox.closest('.form-check').removeClass('loading');
            }
        });
    });
}

$(document).ready(function () {
    // Initialize featured checkboxes on page load
    initializeFeaturedCheckboxes();
});

$(document).ready(function () {
    // Handle Delete button click (using delegation for dynamically loaded content)
    $(document).on('click', '.btn-delete-product', function () {
        const productId = $(this).data('id');
        const productName = $(this).data('name');
        const BASE_URL = "{{ url('/') }}";
        const actionUrl = BASE_URL + '/admin/product/delete' + "/" + productId;

        $('#productName').text(productName);
        $('#deleteProductForm').attr('action', actionUrl);
        $('#deleteConfirmationModal').modal('show');
    });

    // Function to show/hide delete selected button (make it global for AJAX updates)
    window.updateDeleteButton = function() {
        const selectedCount = $('.product-checkbox:checked').length;
        if (selectedCount > 0) {
            $('#btn-delete-selected').show().html('<i class="ki-outline ki-trash fs-2"></i> Delete Selected (' + selectedCount + ')');
        } else {
            $('#btn-delete-selected').hide();
        }
    };

    // Handle checkbox selection (using delegation for dynamically loaded content)
    $(document).on('change', '.product-checkbox, #select-all-checkbox', function() {
        updateDeleteButton();
    });

    // Handle delete selected button click
    $('#btn-delete-selected').on('click', function() {
        const selectedIds = [];
        $('.product-checkbox:checked').each(function() {
            selectedIds.push($(this).val());
        });

        if (selectedIds.length === 0) {
            toastr.warning('Please select at least one product to delete.');
            return;
        }

        // Show confirmation modal
        const productCount = selectedIds.length;
        const message = productCount === 1 
            ? 'Are you sure you want to delete this product?' 
            : 'Are you sure you want to delete ' + productCount + ' selected products?';
        
        $('#bulkDeleteMessage').text(message);
        $('#bulkDeleteModal').modal('show');
        $('#bulkDeleteForm').data('ids', selectedIds);
    });

    // Handle bulk delete form submission
    $('#bulkDeleteForm').on('submit', function(e) {
        e.preventDefault();
        const selectedIds = $(this).data('ids');
        const BASE_URL = "{{ url('/') }}";

        // Disable button and show loading
        $('#btn-bulk-delete-confirm').prop('disabled', true).text('Deleting...');

        $.ajax({
            url: BASE_URL + '/admin/product/bulk-delete',
            type: 'POST',
            data: {
                product_ids: selectedIds,
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                if (response.success) {
                    toastr.success(response.message);
                    $('#bulkDeleteModal').modal('hide');
                    // Reload page after a short delay
                    setTimeout(function() {
                        location.reload();
                    }, 1000);
                } else {
                    toastr.error(response.message || 'Failed to delete products.');
                    $('#btn-bulk-delete-confirm').prop('disabled', false).text('Yes, Delete');
                }
            },
            error: function(xhr) {
                console.error('AJAX Error:', xhr);
                toastr.error(xhr.responseJSON?.message || 'Failed to delete products.');
                $('#btn-bulk-delete-confirm').prop('disabled', false).text('Yes, Delete');
            }
        });
    });
});

</script>


@endsection

@section('cssfiles')
<style>
    .form-check.loading {
        opacity: 0.6;
        pointer-events: none;
    }
    
    .form-check.loading .form-check-input {
        cursor: not-allowed;
    }
    
    .form-check-input:disabled {
        opacity: 0.6;
    }
</style>
@endsection