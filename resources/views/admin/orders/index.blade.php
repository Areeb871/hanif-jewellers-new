@extends('admin_layout.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Orders Management</h3>
                    <div class="card-tools">
                        <div class="input-group input-group-sm" style="width: 250px;">
                            <input type="text" name="table_search"id="orderSearch" class="form-control float-right" placeholder="Search orders...">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-default">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap"id="ordersTable">
                        <thead>
                            <tr>
                                <th>Order #</th>
                                <th>Customer</th>
                                <th>Items</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>Payment</th>
                                <th>Reason</th>
                                <th>Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($orders as $order)
                            <tr>
                                <td>
                                    <strong>{{ $order->order_number }}</strong>
                                    @if($order->user)
                                        <br><small class="text-muted">User ID: {{ $order->user_id }}</small>
                                    @else
                                        <br><small class="text-muted">Guest Order</small>
                                    @endif
                                </td>
                                <td>
                                    <div>
                                        <strong>{{ $order->full_name }}</strong>
                                        <br><small class="text-muted">{{ $order->email }}</small>
                                        <br><small class="text-muted">{{ $order->phone }}</small>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge badge-info">{{ $order->items->count() }} items</span>
                                    <br><small class="text-muted">
                                        @foreach($order->items->take(2) as $item)
                                            {{ $item->product_name }} ({{ $item->quantity }})
                                            @if(!$loop->last), @endif
                                        @endforeach
                                        @if($order->items->count() > 2)
                                            +{{ $order->items->count() - 2 }} more
                                        @endif
                                    </small>
                                </td>
                                <td>
                                    <strong>PKR{{ number_format(round($order->total_amount,-3), 2) }}</strong>
                                    @if($order->shipping_cost > 0)
                                        <br><small class="text-muted">Shipping: PKR{{ number_format(round($order->shipping_cost,-3), 2) }}</small>
                                    @endif
                                </td>
                                <td>
                                    @switch($order->status)
                                        @case('pending')
                                            <span class="badge badge-warning">Pending</span>
                                            @break
                                        @case('payment_verified')
                                            <span class="badge badge-info">Fake Order</span>
                                            @break
                                        @case('processing')
                                            <span class="badge badge-primary">Processing</span>
                                            @break
                                        @case('shipped')
                                            <span class="badge badge-secondary">Shipped</span>
                                            @break
                                        @case('delivered')
                                            <span class="badge badge-success">Delivered</span>
                                            @break
                                        @case('cancelled')
                                            <span class="badge badge-danger">Cancelled</span>
                                            @break
                                        @default
                                            <span class="badge badge-secondary">{{ ucfirst($order->status) }}</span>
                                    @endswitch
                                </td>
                                <td>
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
                                        @default
                                            <span class="badge badge-secondary">{{ ucfirst($order->payment_status) }}</span>
                                    @endswitch
                                    @if($order->payment_receipt)
                                        <br><small class="text-muted">Receipt uploaded</small>
                                    @endif
                                </td>
                                <td>
@if($order->status === 'cancelled' && $order->cancel_reason)
    <div class="mt-1 px-2 py-1 bg-light border rounded small text-danger">
        {{ Str::limit($order->cancel_reason, 50) }}
    </div>
@endif
  
                                </td>
                                <td>
                                    {{ $order->created_at->format('M d, Y') }}
                                    <br><small class="text-muted">{{ $order->created_at->format('h:i A') }}</small>
                                </td>
                                <td>
                                    <style>
                                        .dropdown-item.text-danger:hover {
    background-color: rgba(220, 53, 69, 0.1);
}

.dropdown-item.text-danger:hover i {
    transform: scale(1.1);
}

.dropdown-item i {
    transition: transform 0.2s ease;
}
</style>
                                    <div class="btn-group">
                                        <a href="{{ route('orders.show', $order->id) }}" class="btn btn-sm btn-info">
                                            <i class="fas fa-eye"></i> View
                                        </a>
<!--                                       <a class="dropdown-item d-flex align-items-center text-danger fw-bold"-->
<!--   href="javascript:void(0)"-->
<!--   onclick="deleteOrder({{ $order->id }})">-->
    
<!--    <span class="bg-danger text-white d-inline-flex align-items-center justify-content-center rounded-circle mr-2"-->
<!--          style="width:28px; height:28px;">-->
<!--        <i class="fas fa-trash-alt"></i>-->
<!--    </span>-->
<!--</a>-->

                                        @if($order->payment_status === 'pending' && $order->payment_receipt)
                                            <button type="button" class="btn btn-sm btn-success" onclick="verifyPayment({{ $order->id }})">
                                                <i class="fas fa-check"></i> Verify Payment
                                            </button>
                                        @endif
                                        <!-- <button type="button" class="btn btn-sm btn-primary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown">
                                            <span class="sr-only">Toggle Dropdown</span>
                                        </button> -->
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="#" onclick="updateStatus({{ $order->id }}, 'processing')">
                                                <i class="fas fa-cog"></i> Mark Processing
                                            </a>
                                            <a class="dropdown-item" href="#" onclick="updateStatus({{ $order->id }}, 'shipped')">
                                                <i class="fas fa-shipping-fast"></i> Mark Shipped
                                            </a>
                                            <a class="dropdown-item" href="#" onclick="updateStatus({{ $order->id }}, 'delivered')">
                                                <i class="fas fa-check-circle"></i> Mark Delivered
                                            </a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item text-danger" href="#" onclick="updateStatus({{ $order->id }}, 'cancelled')">
                                                <i class="fas fa-times"></i> Cancel Order
                                            </a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8" class="text-center py-4">
                                    <div class="text-muted">
                                        <i class="fas fa-shopping-cart fa-3x mb-3"></i>
                                        <h5>No orders found</h5>
                                        <p>Orders will appear here once customers place them.</p>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="card-footer clearfix">
                    {{ $orders->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Status Update Modal -->
<div class="modal fade" id="statusModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Update Order Status</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="statusForm">
                    <div class="form-group">
                        <label for="status">Order Status</label>
                        <select class="form-control" id="status" name="status">
                            <option value="pending">Pending</option>
                            <option value="payment_verified">Payment Verified</option>
                            <option value="processing">Processing</option>
                            <option value="shipped">Shipped</option>
                            <option value="delivered">Delivered</option>
                            <option value="cancelled">Cancelled</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="payment_status">Payment Status</label>
                        <select class="form-control" id="payment_status" name="payment_status">
                            <option value="pending">Pending</option>
                            <option value="verified">Verified</option>
                            <option value="failed">Failed</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" onclick="saveStatus()">Update Status</button>
            </div>
        </div>
    </div>
</div>

<script>
let currentOrderId = null;

function updateStatus(orderId, status) {
    currentOrderId = orderId;
    document.getElementById('status').value = status;
    $('#statusModal').modal('show');
}

function saveStatus() {
    if (!currentOrderId) return;
    
    const status = document.getElementById('status').value;
    const paymentStatus = document.getElementById('payment_status').value;
    
    fetch(`/admin/orders/${currentOrderId}/status`, {
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({
            status: status,
            payment_status: paymentStatus
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            location.reload();
        } else {
            alert('Error updating status: ' + data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Error updating status');
    });
}

function verifyPayment(orderId) {
    if (!confirm('Are you sure you want to verify the payment for this order?')) {
        return;
    }
    
    fetch(`/admin/orders/${orderId}/verify-payment`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
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
function deleteOrder(orderId) {
    if (!confirm('⚠️ This will permanently delete the order and its items. Continue?')) {
        return;
    }

    fetch(`/admin/orders/${orderId}`, {
        method: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Accept': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Order deleted successfully');
            location.reload();
        } else {
            alert('Error deleting order: ' + data.message);
        }
    })
    .catch(error => {
        console.error(error);
        alert('Something went wrong while deleting the order.');
    });
}
</script>
<script>
document.getElementById('orderSearch').addEventListener('keyup', function () {
    let value = this.value.toLowerCase();
    let rows = document.querySelectorAll('#ordersTable tbody tr');

    rows.forEach(function(row) {
        let text = row.textContent.toLowerCase();

        if (text.includes(value)) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
});
</script>
@endsection 