@extends('admin_layout.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center flex-wrap">
                    <h3 class="card-title mb-0">
                        Checkout Lead Details - #{{ $lead->id }}
                    </h3>

                    <a href="{{ route('admin.orders.abandoned') }}" class="btn btn-sm btn-secondary">
                        <i class="fas fa-arrow-left"></i> Back
                    </a>
                </div>

                <div class="card-body">
                    <div class="row">
                        {{-- Left Side --}}
                        <div class="col-md-8">
                            <div class="row">
                                {{-- Customer Information --}}
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5 class="card-title mb-0">Customer Information</h5>
                                        </div>
                                        <div class="card-body">
                                            <p><strong>Name:</strong> {{ trim(($lead->first_name ?? '') . ' ' . ($lead->last_name ?? '')) ?: 'N/A' }}</p>
                                            <p><strong>Email:</strong> {{ $lead->email ?? 'N/A' }}</p>
                                            <p><strong>Phone:</strong> {{ $lead->phone ?? 'N/A' }}</p>

                                            @if($lead->user)
                                                <p><strong>User ID:</strong> {{ $lead->user->id }}</p>
                                            @else
                                                <p><strong>Type:</strong> Guest Lead</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                {{-- Shipping Information --}}
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5 class="card-title mb-0">Shipping Address</h5>
                                        </div>
                                        <div class="card-body">
                                            <p class="mb-2">
                                                {{ $lead->address1 ?? '' }}
                                                @if($lead->address2)
                                                    , {{ $lead->address2 }}
                                                @endif
                                                @if($lead->city)
                                                    , {{ $lead->city }}
                                                @endif
                                                @if($lead->state)
                                                    , {{ $lead->state }}
                                                @endif
                                                @if($lead->zip_code)
                                                    - {{ $lead->zip_code }}
                                                @endif
                                            </p>

                                            <p class="mb-0">
                                                <strong>Delivery Option:</strong>
                                                {{ $lead->delivery_option ? ucfirst(str_replace(['shipItems', '_'], ['Ship Items', ' '], $lead->delivery_option)) : 'N/A' }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Lead Items --}}
                            <div class="card mt-3">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">Selected Products</h5>
                                </div>

                                <div class="card-body">
                                    @if($lead->items && $lead->items->count())
                                        <div class="table-responsive">
                                            <table class="table table-bordered align-middle">
                                                <thead>
                                                    <tr>
                                                        <th>Product</th>
                                                        <th>Image</th>
                                                        <!-- <th>Price</th> -->
                                                        <th>Quantity</th>
                                                        <!-- <th>Total</th> -->
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($lead->items as $item)
                                                        <tr>
                                                            <td>
                                                                <strong>{{ $item->product_name ?? 'Product' }}</strong>

                                                                @if(($item->discount_amount ?? 0) > 0)
                                                                    <br>
                                                                    <small class="text-success">
                                                                        @if($item->discount_type === 'percentage')
                                                                            {{ $item->discount_percentage }}% OFF
                                                                        @else
                                                                            PKR {{ number_format((float)$item->discount_amount, 2) }} OFF
                                                                        @endif
                                                                    </small>
                                                                @endif

                                                                @if($item->product)
                                                                    <br>
                                                                    <small class="text-muted">Product ID: {{ $item->product->id }}</small>
                                                                @endif
                                                            </td>

                                                            <td>
                                                                @if($item->product_image)
                                                                    <img src="{{ asset($item->product_image) }}"
                                                                         alt="{{ $item->product_name }}"
                                                                         style="width: 50px; height: 50px; object-fit: cover;">
                                                                @else
                                                                    <span class="text-muted">No image</span>
                                                                @endif
                                                            </td>

                                                            <!-- <td>
                                                                @if(($item->original_price ?? 0) > ($item->unit_price ?? 0))
                                                                    <span class="text-muted text-decoration-line-through">
                                                                        PKR {{ number_format((float)$item->original_price, 2) }}
                                                                    </span>
                                                                    <br>
                                                                @endif
                                                                <strong>PKR {{ number_format((float)($item->unit_price ?? 0), 2) }}</strong>
                                                            </td> -->

                                                            <td>{{ $item->quantity ?? 1 }}</td>

                                                            <!-- <td>
                                                                <strong>PKR {{ number_format((float)($item->total_price ?? 0), 2) }}</strong>
                                                            </td> -->
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    @else
                                        <p class="text-muted mb-0">No products found for this checkout lead.</p>
                                    @endif
                                </div>
                            </div>
                        </div>

                        {{-- Right Side --}}
                        <div class="col-md-4">
                            {{-- Lead Summary --}}
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">Lead Summary</h5>
                                </div>
                                <div class="card-body">
                                    <div class="d-flex justify-content-between mb-2">
                                        <span>Lead ID:</span>
                                        <strong>#{{ $lead->id }}</strong>
                                    </div>

                                    <div class="d-flex justify-content-between mb-2">
                                        <span>Checkout Step:</span>
                                        <strong>{{ $lead->checkout_step ?? 'N/A' }}</strong>
                                    </div>

                                    <div class="d-flex justify-content-between mb-2">
                                        <span>Converted:</span>
                                        <strong>
                                            @if($lead->is_converted)
                                                <span class="badge badge-success">Yes</span>
                                            @else
                                                <span class="badge badge-warning">No</span>
                                            @endif
                                        </strong>
                                    </div>

                                    <div class="d-flex justify-content-between mb-2">
                                        <span>Total Items:</span>
                                        <strong>{{ $lead->items ? $lead->items->count() : 0 }}</strong>
                                    </div>

                                    <!-- <hr> -->

                                    <!-- <div class="d-flex justify-content-between">
                                        <span>Cart Total:</span>
                                        <strong>
                                            PKR {{ number_format((float)($lead->items ? $lead->items->sum('total_price') : 0), 2) }}
                                        </strong>
                                    </div> -->
                                </div>
                            </div>

                            {{-- Lead Details --}}
                            <div class="card mt-3">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">Lead Details</h5>
                                </div>
                                <div class="card-body">
                                    <p><strong>Last Reason:</strong> {{ $lead->last_reason ?? 'N/A' }}</p>
                                    <p><strong>Created At:</strong> {{ $lead->created_at ? $lead->created_at->format('M d, Y h:i A') : 'N/A' }}</p>
                                    <p><strong>Last Activity:</strong> {{ $lead->last_activity_at ? $lead->last_activity_at->format('M d, Y h:i A') : 'N/A' }}</p>
                                    <p class="mb-0"><strong>Updated At:</strong> {{ $lead->updated_at ? $lead->updated_at->format('M d, Y h:i A') : 'N/A' }}</p>
                                </div>
                            </div>

                            {{-- Optional Notes --}}
                            @if(!empty($lead->address1) || !empty($lead->address2))
                                <div class="card mt-3">
                                    <div class="card-header">
                                        <h5 class="card-title mb-0">Address Preview</h5>
                                    </div>
                                    <div class="card-body">
                                        <p class="mb-0">
                                            {{ $lead->address1 ?? '' }}
                                            @if($lead->address2)
                                                <br>{{ $lead->address2 }}
                                            @endif
                                            @if($lead->city || $lead->state || $lead->zip_code)
                                                <br>
                                                {{ $lead->city ?? '' }}
                                                @if($lead->city && $lead->state), @endif
                                                {{ $lead->state ?? '' }}
                                                @if($lead->zip_code) - {{ $lead->zip_code }} @endif
                                            @endif
                                        </p>
                                    </div>
                                </div>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection