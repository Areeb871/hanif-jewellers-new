@extends('admin_layout.app')

@section('content')

<style>
    .hj-admin-wrap {
        padding: 24px 0;
    }

    .hj-page-head {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 16px;
        margin-bottom: 22px;
    }

    .hj-page-title h2 {
        font-size: 26px;
        font-weight: 600;
        margin: 0;
        color: #111;
    }

    .hj-page-title p {
        margin: 5px 0 0;
        color: #777;
        font-size: 14px;
    }

    .hj-add-btn {
        background: #111;
        color: #fff;
        border: none;
        padding: 11px 18px;
        border-radius: 8px;
        font-size: 14px;
        text-decoration: none;
        transition: 0.2s ease;
    }

    .hj-add-btn:hover {
        background: #333;
        color: #fff;
    }

    .hj-stats-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 16px;
        margin-bottom: 22px;
    }

    .hj-stat-card {
        background: #fff;
        border: 1px solid #eee;
        border-radius: 14px;
        padding: 18px;
        box-shadow: 0 8px 24px rgba(0,0,0,0.04);
    }

    .hj-stat-card span {
        display: block;
        color: #777;
        font-size: 13px;
        margin-bottom: 8px;
    }

    .hj-stat-card strong {
        font-size: 24px;
        color: #111;
        font-weight: 600;
    }

    .hj-table-card {
        background: #fff;
        border: 1px solid #eee;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 8px 24px rgba(0,0,0,0.04);
    }

    .hj-table-top {
        padding: 18px 20px;
        border-bottom: 1px solid #eee;
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 16px;
    }

    .hj-table-top h4 {
        margin: 0;
        font-size: 17px;
        font-weight: 600;
        color: #111;
    }

    .hj-search-box {
        max-width: 280px;
        width: 100%;
    }

    .hj-search-box input {
        width: 100%;
        border: 1px solid #ddd;
        border-radius: 8px;
        padding: 9px 12px;
        font-size: 13px;
        outline: none;
    }

    .hj-search-box input:focus {
        border-color: #111;
    }

    .hj-admin-table {
        margin: 0;
        width: 100%;
        border-collapse: collapse;
    }

    .hj-admin-table thead th {
        background: #fafafa;
        color: #555;
        font-size: 13px;
        font-weight: 600;
        padding: 14px 16px;
        border-bottom: 1px solid #eee;
        white-space: nowrap;
    }

    .hj-admin-table tbody td {
        padding: 15px 16px;
        vertical-align: middle;
        border-bottom: 1px solid #f1f1f1;
        color: #333;
        font-size: 14px;
    }

    .hj-product-info-admin {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .hj-product-thumb {
        width: 58px;
        height: 58px;
        border-radius: 10px;
        background: #f7f7f7;
        overflow: hidden;
        border: 1px solid #eee;
        flex: 0 0 auto;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .hj-product-thumb img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .hj-product-name {
        font-weight: 600;
        color: #111;
        margin-bottom: 3px;
    }

    .hj-product-slug {
        font-size: 12px;
        color: #888;
    }

    .hj-status {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 70px;
        padding: 5px 10px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 500;
    }

    .hj-status.active {
        background: #e9f8ef;
        color: #188447;
    }

    .hj-status.inactive {
        background: #fdecec;
        color: #c62828;
    }

    .hj-actions {
        display: flex;
        gap: 8px;
        align-items: center;
    }

    .hj-action-edit {
        background: #fff8e1;
        color: #8a6500;
        border: 1px solid #ffe59a;
        padding: 7px 12px;
        border-radius: 7px;
        font-size: 13px;
        text-decoration: none;
    }

    .hj-action-edit:hover {
        background: #ffe59a;
        color: #111;
    }

    .hj-action-delete {
        background: #fff;
        color: #c62828;
        border: 1px solid #f3b5b5;
        padding: 7px 12px;
        border-radius: 7px;
        font-size: 13px;
    }

    .hj-action-delete:hover {
        background: #c62828;
        color: #fff;
    }

    .hj-empty-box {
        padding: 45px 20px;
        text-align: center;
        color: #777;
    }

    .hj-pagination-wrap {
        padding: 18px 20px;
    }

    @media (max-width: 991px) {
        .hj-stats-grid {
            grid-template-columns: 1fr;
        }

        .hj-page-head,
        .hj-table-top {
            flex-direction: column;
            align-items: flex-start;
        }

        .hj-search-box {
            max-width: 100%;
        }

        .hj-table-responsive {
            overflow-x: auto;
        }

        .hj-admin-table {
            min-width: 850px;
        }
    }
</style>

<div class="container hj-admin-wrap">

    @php
        $totalProducts = $products->total();
        $activeProducts = $products->where('status', 1)->count();
        $inactiveProducts = $products->where('status', 0)->count();
    @endphp

    <div class="hj-page-head">
        <div class="hj-page-title">
            <h2>Solitaire Products</h2>
            <p>Manage solitaire products, metals, carats, images, and variant prices.</p>
        </div>

        <a href="{{ route('solitaire-products.create') }}" class="hj-add-btn">
            + Add Solitaire Product
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="hj-stats-grid">
        <div class="hj-stat-card">
            <span>Total Products</span>
            <strong>{{ $totalProducts }}</strong>
        </div>

        <div class="hj-stat-card">
            <span>Active on Website</span>
            <strong>{{ $activeProducts }}</strong>
        </div>

        <div class="hj-stat-card">
            <span>Inactive Products</span>
            <strong>{{ $inactiveProducts }}</strong>
        </div>
    </div>

    <div class="hj-table-card">

        <div class="hj-table-top">
            <h4>Product List</h4>

            <div class="hj-search-box">
                <input type="text" id="hjProductSearch" placeholder="Search product name or SKU...">
            </div>
        </div>

        <div class="hj-table-responsive">
            <table class="hj-admin-table" id="hjProductsTable">
                <thead>
                    <tr>
                        <th width="80">ID</th>
                        <th>Product</th>
                        <th>SKU</th>
                        <th>Currency</th>
                        <th>Default Metal</th>
                        <th>Default Carat</th>
                        <th>Status</th>
                        <th width="180">Action</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($products as $product)

                        @php
                            $metalImages = collect($product->metal_images ?? []);
                            $galleryImages = collect($product->gallery_images ?? []);

                            $defaultMetalCode = $product->default_metal_code;

                            $defaultMetalImageGroup = $defaultMetalCode
                                ? $metalImages->firstWhere('metal_code', $defaultMetalCode)
                                : $metalImages->first();

                            $thumbImage = data_get($defaultMetalImageGroup, 'images.0.image_path')
                                ?: data_get($galleryImages->first(), 'image_path');

                            $metals = collect($product->metals ?? []);
                            $defaultMetal = $metals->firstWhere('code', $product->default_metal_code);
                        @endphp

                        <tr>
                            <td>#{{ $product->id }}</td>

                            <td>
                                <div class="hj-product-info-admin">
                                    <div class="hj-product-thumb">
                                        @if($thumbImage)
                                            <img src="{{ asset($thumbImage) }}" alt="{{ $product->name }}">
                                        @else
                                            <span style="font-size:11px;color:#999;">No Img</span>
                                        @endif
                                    </div>

                                    <div>
                                        <div class="hj-product-name">
                                            {{ $product->name }}
                                        </div>

                                        <div class="hj-product-slug">
                                            {{ $product->slug }}
                                        </div>
                                    </div>
                                </div>
                            </td>

                            <td>{{ $product->sku ?? '-' }}</td>

                            <td>{{ $product->currency ?? 'AED' }}</td>

                            <td>
                                {{ data_get($defaultMetal, 'name', $product->default_metal_code ?? '-') }}
                            </td>

                            <td>
                                {{ $product->default_diamond_carat ?? '-' }}
                            </td>

                            <td>
                                @if($product->status)
                                    <span class="hj-status active">Active</span>
                                @else
                                    <span class="hj-status inactive">Inactive</span>
                                @endif
                            </td>

                            <td>
                                <div class="hj-actions">
                                    <a 
                                        href="{{ route('solitaire-products.edit', $product->id) }}" 
                                        class="hj-action-edit"
                                    >
                                        Edit
                                    </a>

                                    <form 
                                        action="{{ route('solitaire-products.destroy', $product->id) }}" 
                                        method="POST" 
                                        onsubmit="return confirm('Delete this solitaire product?')"
                                    >
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="hj-action-delete">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>

                    @empty
                        <tr>
                            <td colspan="8">
                                <div class="hj-empty-box">
                                    No solitaire products found.
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="hj-pagination-wrap">
            {{ $products->links() }}
        </div>

    </div>

</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.getElementById('hjProductSearch');
    const table = document.getElementById('hjProductsTable');

    if (!searchInput || !table) return;

    searchInput.addEventListener('input', function () {
        const searchValue = this.value.toLowerCase();
        const rows = table.querySelectorAll('tbody tr');

        rows.forEach(function (row) {
            const text = row.innerText.toLowerCase();

            row.style.display = text.includes(searchValue) ? '' : 'none';
        });
    });
});
</script>

@endsection