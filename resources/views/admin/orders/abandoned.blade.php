@extends('admin_layout.app')

@section('content')
<div class="container-fluid py-3">

    {{-- Header --}}
 <div class="d-flex flex-wrap justify-content-between align-items-center mb-3 gap-2">
    <div>
        <h3 class="mb-1 fw-bold">Abandoned Checkouts</h3>
        <div class="text-muted small">Customers who started checkout but didn’t complete the order.</div>
    </div>

    <div class="d-flex align-items-center gap-2">
        <div style="min-width: 260px;">
            <input 
                type="text" 
                id="leadSearch" 
                class="form-control form-control-sm" 
                placeholder="Search order, name, email, phone, city..."
            >
        </div>

        <a href="{{ url()->current() }}" class="btn btn-dark btn-sm">
            <i class="fas fa-sync-alt me-1"></i> Refresh
        </a>
    </div>
</div>
    @if(session('success'))
        <div class="alert alert-success d-flex align-items-center" role="alert">
            <i class="fas fa-check-circle me-2"></i>
            <div>{{ session('success') }}</div>
        </div>
    @endif

    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0" id="abandonedTable">
                    <thead class="table-light">
                        <tr>
                            <th class="ps-3">Order #</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th class="pe-3">Created At</th>
                           <th class="pe-3">Action</th>

                        </tr>
                    </thead>

                    <tbody>
                        @forelse($orders as $order)
                            <tr class="search-row">
                                <td class="ps-3">
                                    <span class="fw-semibold">{{ $order->order_number }}</span>
                                    <div class="text-muted small">#{{ $order->id }}</div>
                                </td>

                                <td>
                                    <div class="fw-semibold">{{ $order->first_name }} {{ $order->last_name }}</div>
                                </td>

                                <td>
                                    <span class="text-dark">{{ $order->email }}</span>
                                </td>

                                <td>
                                    <span class="text-dark">{{ $order->phone }}</span>
                                </td>

                                <!-- <td>
                                    <span class="fw-semibold">
                                        {{ number_format((float)($order->total_amount ?? 0), 2) }}
                                    </span>
                                </td> -->
                                <td class="pe-3">
                                    <div class="fw-semibold">{{ $order->created_at->format('d M Y') }}</div>
                                    <div class="text-muted small">{{ $order->created_at->format('h:i A') }}</div>
                                </td>
                                <td class="pe-3">
                                     <a href="{{ route('checkout-leads.show', $order->id) }}" class="btn btn-sm btn-info">
                                            <i class="fas fa-eye"></i> View
                                        </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-5">
                                    <div class="text-muted">
                                        <i class="fas fa-inbox fa-2x mb-2"></i>
                                        <div class="fw-semibold">No abandoned orders found</div>
                                        <div class="small">They will appear here once customers leave checkout without completing.</div>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        @if(method_exists($orders, 'links'))
            <div class="card-footer bg-white d-flex justify-content-end">
                {{ $orders->links() }}
            </div>
        @endif
    </div>
</div>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.getElementById('leadSearch');
    const table = document.getElementById('abandonedTable');
    const rows = table.querySelectorAll('tbody tr.search-row');

    searchInput.addEventListener('keyup', function () {
        const searchValue = this.value.toLowerCase().trim();

        rows.forEach(function (row) {
            const rowText = row.innerText.toLowerCase();

            if (rowText.includes(searchValue)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });
});
</script>    
@endsection
