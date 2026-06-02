@extends('admin_layout.app')

@section('content')

<div class="container">
    <h2>Edit Solitaire Product</h2>

<form 
    id="solitaireProductForm"
    action="{{ route('solitaire-products.update', $product->id) }}" 
    method="POST" 
    enctype="multipart/form-data"
    onsubmit="prepareMetalImageInputs()"
>
    @csrf
    @method('PUT')

    @include('admin.solitaire-products.form')

    <button type="submit" class="btn btn-success">
        Update Solitaire Product
    </button>
</form>
</div>

@endsection