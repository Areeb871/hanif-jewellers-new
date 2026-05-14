<tbody id="kt_ecommerce_products_table">
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
                <span class="symbol-label" style='background-image:url({{ url($product->image) }});'></span>
            </a>
            <div class="ms-5">
                <a href="{{ route('update-product',$product->id) }}" class="text-gray-800 text-hover-primary fs-5 fw-bold">{{ $product->name }}</a>
            </div>
        </div>
    </td>
    <td class="text-end pe-0"><span class="fw-bold">{{ $product->sku }}</span></td>
    <td class="text-end pe-0"><span class="fw-bold ms-3">{{ $product->quantity }}</span></td>
    <td class="text-end pe-0">{{ $product->price }}</td>
    <td class="text-end pe-0">{{ $product->barcode }}</td>
    <td>
        <div class="form-check form-switch form-check-custom form-check-solid" style="float: right;">
            <input class="form-check-input" type="checkbox" name="is_featured" value="1" data-id="{{ $product->id }}" {{ $product->is_featured ? 'checked' : '' }}/>
        </div>
    </td>
    <td class="text-end pe-0">
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
                <a href="javascript:void(0);" class="menu-link px-3 btn-delete-product" 
                    data-id="{{ $product->id }}" 
                    data-name="{{ $product->name }}">
                    Delete
                </a>
            </div>
        </div>
    </td>
</tr>
@endforeach
</tbody>
<div class="custom-pagination-wrapper" id="pagination-links">
    {{ $products->links() }}
</div>