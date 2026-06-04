@extends('admin_layout.app')

@section('content')

<div class="container">
    <h2>Add Solitaire Product</h2>

<form 
    id="solitaireProductForm"
    action="{{ route('solitaire-products.store') }}" 
    method="POST" 
    enctype="multipart/form-data"
    onsubmit="prepareMetalImageInputs()"
>
    @csrf

    @include('admin.solitaire-products.form')

    <button type="submit" class="btn btn-success">
        Save Solitaire Product
    </button>
</form>
</div>

@endsection