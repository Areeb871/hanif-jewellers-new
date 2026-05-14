@extends('admin_layout.app')

@section('content')
    {{-- <section class="aboutSection p-5">

    </section> --}}

    <section class="">
        <div class="container py-5 text-center">
            <form method="POST" action="{{ route('read_csv') }}" enctype="multipart/form-data">
                @csrf
                <label class="form-label">Categories</label>
                <select 
                    class="form-select mb-2" 
                    name="category_id" 
                    id="category_id"
                    data-control="select2" 
                    data-placeholder="Select an option" 
                    data-allow-clear="true"
                required>
                    <option>Select Category</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
                <script>
                    const allSubcategories = @json($subcategories);
                </script>
                {{-- <div class="text-muted fs-7 mb-7">Add product to a category.</div> --}}
                {{-- <a href="{{ route('product-category') }}" class="btn btn-light-primary btn-sm mb-10">
                    <i class="ki-outline ki-plus fs-2"></i>Create new category
                </a> --}}

                <label class="form-label">Sub Categories</label>
                <select 
                    class="form-select mb-2" 
                    name="subcategory_id" 
                    id="subcategory_id"
                    data-control="select2" 
                    data-placeholder="Select an option" 
                    data-allow-clear="true"
                required>
                    {{-- initially empty --}}
                    <option>Select Sub Category</option>
                </select>
                <label class="form-label">Add Keyword Where You Want To Add Product</label>
                <input type="text" name="keyword" class="form-control mb-2" placeholder="Like: taj mahal" required>
                {{-- <div class="text-muted fs-7 mb-7">Add product to a subcategory.</div> --}}
                {{-- <a href="{{ route('product-sub-category') }}" class="btn btn-light-primary btn-sm mb-10">
                    <i class="ki-outline ki-plus fs-2"></i>Create new subcategory
                </a> --}}
                <input type="file" name="csv_file" accept=".csv" class="form-control mb-2" placeholder="Upload CSV" required>
                <button type="submit">Upload CSV</button>
            </form>
        </div>
    </section>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
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
document.querySelector('form').addEventListener('submit', function(e) {
    const category = document.getElementById('category_id');
    const subcategory = document.getElementById('subcategory_id');
    if (!subcategory.value || subcategory.value === 'Select Sub Category') {
        alert('Please select a subcategory.');
        subcategory.focus();
        e.preventDefault(); // Stop form submission
    }
    if (!category.value || category.value === 'Select Category') {
        alert('Please select a category.');
        category.focus();
        e.preventDefault(); // Stop form submission
    }
});

    </script>
@endsection
