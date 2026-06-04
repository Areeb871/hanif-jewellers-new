@extends('admin_layout.app')

@section('content')

<div class="container">
    <div class="d-flex justify-content-between mb-3">
        <h2>Solitaire Products</h2>

        <a href="{{ route('solitaire-products.create') }}" class="btn btn-primary">
            Add Solitaire Product
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th width="80">ID</th>
                <th>Name</th>
                <th>SKU</th>
                <th>Status</th>
                <th width="180">Action</th>
            </tr>
        </thead>

        <tbody>
            @foreach($products as $product)
                <tr>
                    <td>{{ $product->id }}</td>

                    <td>{{ $product->name }}</td>

                    <td>{{ $product->sku }}</td>

                    <td>
                        @if($product->status)
                            <span class="badge bg-success">Active</span>
                        @else
                            <span class="badge bg-danger">Inactive</span>
                        @endif
                    </td>

                    <td>
                        <a href="{{ route('solitaire-products.edit', $product->id) }}" class="btn btn-sm btn-warning">
                            Edit
                        </a>

                        <form action="{{ route('solitaire-products.destroy', $product->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')

                            <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this solitaire product?')">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $products->links() }}
</div>

@endsection