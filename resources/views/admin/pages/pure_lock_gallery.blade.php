@extends('admin_layout.app')

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Pure Lock Gallery Images Management</h3>
            <p class="text-muted mb-0">Upload multiple images. The first 4 active images (by display order) power the hero gallery, followed by the next slots for the Pure Lock page.</p>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="card mb-5">
                <div class="card-header">
                    <h4 class="card-title">Upload New Images</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.pure-lock-gallery.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="images" class="form-label">Select Images (Multiple selection allowed)</label>
                            <input type="file" name="images[]" id="images" class="form-control" multiple accept="image/*" required>
                            <small class="form-text text-muted">JPEG, PNG, JPG, GIF up to 2MB each.</small>
                        </div>
                        <button type="submit" class="btn btn-primary">
                            <i class="ki-outline ki-upload fs-2"></i> Upload Images
                        </button>
                    </form>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Gallery Images (Drag to reorder)</h4>
                </div>
                <div class="card-body">
                    @if($images->count() > 0)
                        @php
                            $activeImages = $images->where('is_active', true)->sortBy('display_order')->take(4);
                            $displayedIds = $activeImages->pluck('id')->toArray();
                        @endphp
                        <div id="sortable-images" class="row g-3">
                            @foreach($images as $image)
                                <div class="col-md-3 col-sm-6" data-id="{{ $image->id }}">
                                    <div class="card h-100 {{ !$image->is_active ? 'border-warning' : '' }}" style="cursor: move;">
                                        <div class="card-body p-2">
                                            <div class="position-relative">
                                                <img src="{{ asset($image->image) }}" alt="Pure Lock Gallery Image" class="img-fluid rounded" style="width: 100%; height: 200px; object-fit: cover;">
                                                @if(!$image->is_active)
                                                    <span class="badge bg-warning position-absolute top-0 start-0 m-2">Inactive</span>
                                                @endif
                                                @if(in_array($image->id, $displayedIds))
                                                    <span class="badge bg-success position-absolute top-0 end-0 m-2">Top Section</span>
                                                @endif
                                            </div>
                                            <div class="mt-2 text-center">
                                                <small class="text-muted d-block">Order: {{ $image->display_order }}</small>
                                                <div class="btn-group btn-group-sm mt-2" role="group">
                                                    <form action="{{ route('admin.pure-lock-gallery.toggle-status', $image->id) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('PUT')
                                                        <button type="submit" class="btn btn-sm {{ $image->is_active ? 'btn-warning' : 'btn-success' }}" title="{{ $image->is_active ? 'Deactivate' : 'Activate' }}">
                                                            <i class="ki-outline ki-{{ $image->is_active ? 'cross' : 'check' }} fs-5"></i>
                                                        </button>
                                                    </form>
                                                    <form action="{{ route('admin.pure-lock-gallery.delete', $image->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this image?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger" title="Delete">
                                                            <i class="ki-outline ki-trash fs-5"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="alert alert-info">
                            <p class="mb-0">No images uploaded yet. Use the form above to add gallery items.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('jsfiles')
<script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const sortableEl = document.getElementById('sortable-images');
    
    if (sortableEl) {
        const sortable = Sortable.create(sortableEl, {
            animation: 150,
            handle: '.card',
            onEnd: function() {
                const imageIds = Array.from(sortableEl.children).map(child => child.getAttribute('data-id'));
                
                fetch('{{ route("admin.pure-lock-gallery.update-order") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        image_ids: imageIds
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        location.reload();
                    } else {
                        alert('Error updating order: ' + data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Error updating order. Please try again.');
                });
            }
        });
    }
});
</script>
@endsection

