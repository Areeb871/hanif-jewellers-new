@extends('admin_layout.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        Order Details - {{ $order->order_number }}
                        <a href="{{ route('orders.index') }}" class="btn btn-sm btn-secondary ml-2">
                            <i class="fas fa-arrow-left"></i> Back to Orders
                        </a>
                    </h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <!-- Order Information -->
                        <div class="col-md-8">
                            <div class="row">
                                <!-- Customer Information -->
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5 class="card-title">Customer Information</h5>
                                        </div>
                                        <div class="card-body">
                                            <p><strong>Name:</strong> {{ $order->full_name }}</p>
                                            <p><strong>Email:</strong> {{ $order->email }}</p>
                                            <p><strong>Phone:</strong> {{ $order->phone }}</p>
                                            @if($order->user)
                                                <p><strong>User ID:</strong> {{ $order->user_id }}</p>
                                            @else
                                                <p><strong>Type:</strong> Guest Order</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <!-- Shipping Information -->
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5 class="card-title">Shipping Address</h5>
                                        </div>
                                        <div class="card-body">
                                            <p>{{ $order->full_address }}</p>
                                            <p><strong>Delivery Option:</strong> {{ ucfirst(str_replace('shipItems', 'Ship Items', $order->delivery_option)) }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Order Items -->
                            <div class="card mt-3">
                                <div class="card-header">
                                    <h5 class="card-title">Order Items</h5>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Product</th>
                                                    <th>Image</th>
                                                    <th>Price</th>
                                                    <th>Quantity</th>
                                                    <th>Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($order->items as $item)
                                                <tr>
                                                    <td>
                                                        <strong>{{ $item->product_name }}</strong>
                                                        @if($item->discount_amount > 0)
                                                            <br><small class="text-success">
                                                                @if($item->discount_type === 'percentage')
                                                                    {{ $item->discount_percentage }}% OFF
                                                                @else
                                                                    ${{ number_format($item->discount_amount, 2) }} OFF
                                                                @endif
                                                            </small>
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
                                                    <td>
                                                        @if($item->original_price > $item->unit_price)
                                                            <span class="text-muted text-decoration-line-through">PKR{{ number_format(round($item->original_price,-3), 2) }}</span><br>
                                                        @endif
                                                        <strong>PKR{{ number_format(round($item->unit_price,-3), 2) }}</strong>
                                                    </td>
                                                    <td>{{ $item->quantity }}</td>
                                                    <td><strong>PKR{{ number_format(round($item->total_price,-3), 2) }}</strong></td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Order Summary & Actions -->
                        <div class="col-md-4">
                            <!-- Order Status -->
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title">Order Status</h5>
                                </div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label><strong>Order Status:</strong></label>
                                        <select class="form-control" id="orderStatus" onchange="updateOrderStatus()">
                                            <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                            <option value="payment_verified" {{ $order->status === 'payment_verified' ? 'selected' : '' }}>Fake Order</option>
                                            <option value="processing" {{ $order->status === 'processing' ? 'selected' : '' }}>Processing</option>
                                            <option value="shipped" {{ $order->status === 'shipped' ? 'selected' : '' }}>Shipped</option>
                                            <!-- <option value="delivered" {{ $order->status === 'delivered' ? 'selected' : '' }}>Delivered</option> -->
                                            <option value="cancelled" {{ $order->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                        </select>
                                    </div>
                                   <div class="col-12 mb-3" id="cancelReasonBox" style="{{ $order->status === 'cancelled' ? '' : 'display:none;' }}">
    <label for="cancel_reason" class="form-label fw-semibold">Cancellation Reason</label>

    <textarea 
        name="cancel_reason" 
        id="cancel_reason" 
        rows="4" 
        class="form-control" 
        placeholder="Please enter the reason for cancellation..."
    >{{ old('cancel_reason', $order->cancel_reason) }}</textarea>

    <div id="cancel_reason_error" class="text-danger mt-1 small"></div>
    <div id="cancel_reason_success" class="text-success mt-1 small"></div>

    <button type="button" class="btn btn-dark mt-3" onclick="saveCancelReason()">
        Save Reason
    </button>
</div>
                                    
                                    <div class="mb-3">
                                        <label><strong>Payment Status:</strong></label>
                                        <select class="form-control" id="paymentStatus" onchange="updatePaymentStatus()">
                                            <option value="pending" {{ $order->payment_status === 'pending' ? 'selected' : '' }}>Pending</option>
                                            <option value="verified" {{ $order->payment_status === 'verified' ? 'selected' : '' }}>Verified</option>
                                            <option value="failed" {{ $order->payment_status === 'failed' ? 'selected' : '' }}>Failed</option>
                                        </select>
                                    </div>

                                    @if($order->payment_status === 'pending' && $order->payment_receipt)
                                        <button type="button" class="btn btn-success btn-block" onclick="verifyPayment()">
                                            <i class="fas fa-check"></i> Verify Payment
                                        </button>
                                    @endif
                                </div>
                            </div>

                            <!-- Order Summary -->
                            <div class="card mt-3">
                                <div class="card-header">
                                    <h5 class="card-title">Order Summary</h5>
                                </div>
                                <div class="card-body">
                                    <div class="d-flex justify-content-between mb-2">
                                        <span>Subtotal:</span>
                                        <span>PKR{{ number_format(round($order->subtotal,-3), 2) }}</span>
                                    </div>
                                    <div class="d-flex justify-content-between mb-2">
                                        <span>Shipping:</span>
                                        <span>PKR{{ number_format(round($order->shipping_cost,-3), 2) }}</span>
                                    </div>
                                    <hr>
                                    <div class="d-flex justify-content-between">
                                        <strong>Total:</strong>
                                        <strong>PKR{{ number_format(round($order->total_amount,-3), 2) }}</strong>
                                    </div>
                                </div>
                            </div>

                            <!-- Payment Information -->
                            <div class="card mt-3">
                                <div class="card-header">
                                    <h5 class="card-title">Payment Information</h5>
                                </div>
                                <div class="card-body">
                                    <p><strong>Method:</strong> {{ ucfirst(str_replace('bankTransfer', 'Bank Transfer', $order->payment_method)) }}</p>
                                    <p><strong>Status:</strong> 
                                        @switch($order->payment_status)
                                            @case('pending')
                                                <span class="badge badge-warning">Pending</span>
                                                @break
                                            @case('verified')
                                                <span class="badge badge-success">Verified</span>
                                                @break
                                            @case('failed')
                                                <span class="badge badge-danger">Failed</span>
                                                @break
                                        @endswitch
                                    </p>
                                    
                                    @if($order->payment_receipt)
                                        <div class="mt-3">
                                            <label><strong>Payment Receipt:</strong></label>
                                            <div class="mt-2">
                                                <img src="{{ asset($order->payment_receipt) }}" 
                                                     alt="Payment Receipt" 
                                                     class="img-fluid" 
                                                     style="max-height: 200px; cursor: pointer;"
                                                     onclick="openReceiptModal()">
                                            </div>
                                        </div>
                                    @else
                                        <p class="text-muted">No payment receipt uploaded</p>
                                    @endif
                                </div>
                            </div>

                            <!-- Order Notes -->
                            @if($order->order_notes)
                            <div class="card mt-3">
                                <div class="card-header">
                                    <h5 class="card-title">Order Notes</h5>
                                </div>
                                <div class="card-body">
                                    <p>{{ $order->order_notes }}</p>
                                </div>
                            </div>
                            @endif

                            <!-- Order Details -->
                            <div class="card mt-3">
                                <div class="card-header">
                                    <h5 class="card-title">Order Details</h5>
                                </div>
                                <div class="card-body">
                                    <p><strong>Order Date:</strong> {{ $order->created_at->format('M d, Y h:i A') }}</p>
                                    <p><strong>Last Updated:</strong> {{ $order->updated_at->format('M d, Y h:i A') }}</p>
                                    <p><strong>Items Count:</strong> {{ $order->items->count() }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Payment Receipt Modal -->
<div class="modal fade" id="receiptModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Payment Receipt</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <img src="{{ asset($order->payment_receipt) }}" 
                     alt="Payment Receipt" 
                     class="img-fluid">
            </div>
        </div>
    </div>
</div>

<script>
function updateOrderStatus() {
    const status = document.getElementById('orderStatus').value;
    const paymentStatus = document.getElementById('paymentStatus').value;
    const cancelReasonField = document.getElementById('cancel_reason');
    const cancelReasonError = document.getElementById('cancel_reason_error');

    const cancelReason = cancelReasonField ? cancelReasonField.value.trim() : '';

    // reset error
    if (cancelReasonError) cancelReasonError.innerText = '';

    if (status === 'cancelled' && cancelReason === '') {
        cancelReasonError.innerText = 'Cancellation reason is required.';
        cancelReasonField.focus();
        return;
    }

    fetch(`/admin/orders/{{ $order->id }}/status`, {
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Accept': 'application/json'
        },
        body: JSON.stringify({
            status: status,
            payment_status: paymentStatus,
            cancel_reason: cancelReason
        })
    })
    .then(async response => {
        const data = await response.json();

        if (!response.ok) {
            throw data;
        }

        return data;
    })
    .then(data => {
        if (data.success) {
            location.reload();
        }
    })
    .catch(error => {
        if (error.errors && error.errors.cancel_reason) {
            cancelReasonError.innerText = error.errors.cancel_reason[0];
        } else {
            console.error(error);
        }
    });
}
function updatePaymentStatus() {
    updateOrderStatus();
}

function verifyPayment() {
    if (!confirm('Are you sure you want to verify the payment for this order?')) {
        return;
    }

    fetch(`/admin/orders/{{ $order->id }}/verify-payment`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Accept': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            location.reload();
        } else {
            alert('Error verifying payment: ' + data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Error verifying payment');
    });
}

function openReceiptModal() {
    $('#receiptModal').modal('show');
}

document.addEventListener('DOMContentLoaded', function () {
    const statusSelect = document.getElementById('orderStatus');
    const cancelReasonBox = document.getElementById('cancelReasonBox');
    const cancelReasonField = document.getElementById('cancel_reason');

    function toggleCancelReason() {
        if (!statusSelect || !cancelReasonBox || !cancelReasonField) return;

        if (statusSelect.value === 'cancelled') {
            cancelReasonBox.style.display = 'block';
            cancelReasonField.setAttribute('required', 'required');
        } else {
            cancelReasonBox.style.display = 'none';
            cancelReasonField.removeAttribute('required');
            cancelReasonField.value = '';
        }
    }

    if (statusSelect) {
        statusSelect.addEventListener('change', toggleCancelReason);
        toggleCancelReason();
    }
});
</script>
<script>
function saveCancelReason() {
    const cancelReasonField = document.getElementById('cancel_reason');
    const statusField = document.getElementById('orderStatus');
    const errorBox = document.getElementById('cancel_reason_error');
    const successBox = document.getElementById('cancel_reason_success');

    const cancelReason = cancelReasonField.value.trim();
    const status = statusField.value;

    errorBox.innerText = '';
    successBox.innerText = '';
    cancelReasonField.classList.remove('is-invalid');

    if (status !== 'cancelled') {
        errorBox.innerText = 'Please select Cancelled status first.';
        return;
    }

    if (cancelReason === '') {
        errorBox.innerText = 'Cancellation reason is required.';
        cancelReasonField.classList.add('is-invalid');
        cancelReasonField.focus();
        return;
    }

    fetch(`/admin/orders/{{ $order->id }}/save-cancel-reason`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Accept': 'application/json'
        },
        body: JSON.stringify({
            cancel_reason: cancelReason
        })
    })
    .then(async response => {
        const data = await response.json();

        if (!response.ok) {
            throw data;
        }

        return data;
    })
    .then(data => {
        if (data.success) {
            successBox.innerText = data.message;
        } else {
            errorBox.innerText = data.message || 'Unable to save reason.';
        }
    })
    .catch(error => {
        if (error.errors && error.errors.cancel_reason) {
            errorBox.innerText = error.errors.cancel_reason[0];
        } else {
            errorBox.innerText = error.message || 'Something went wrong.';
        }
    });
}
</script>
@endsection 