<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\CheckoutLead;


class OrderController extends Controller
{
    /**
     * Display a listing of orders
     */
    public function index()
    {
        $orders = Order::with(['items', 'user'])
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('admin.orders.index', compact('orders'));
    }

    /**
     * Display the specified order
     */
    public function show($id)
    {
        $order = Order::with(['items.product', 'user'])->findOrFail($id);
        return view('admin.orders.show', compact('order'));
    }

    /**
     * Update order status
     */
      public function updateStatus(Request $request, $id)
{
    $request->validate([
        'status' => 'required|in:pending,payment_verified,processing,shipped,delivered,cancelled',
        'payment_status' => 'required|in:pending,verified,failed',
        'cancel_reason' => 'nullable|string'
    ], [
        'cancel_reason.string' => 'Cancellation reason must be valid text.'
    ]);

    if ($request->status === 'cancelled' && empty(trim($request->cancel_reason))) {
        return response()->json([
            'success' => false,
            'message' => 'Cancellation reason is required when order is cancelled.',
            'errors' => [
                'cancel_reason' => ['Cancellation reason is required when order is cancelled.']
            ]
        ], 422);
    }

    $order = Order::findOrFail($id);

    $order->update([
        'status' => $request->status,
        'payment_status' => $request->payment_status,
        'cancel_reason' => $request->status === 'cancelled' ? $request->cancel_reason : null,
    ]);

    return response()->json([
        'success' => true,
        'message' => 'Order status updated successfully'
    ]);
}
 public function saveCancelReason(Request $request, $id)
{
    $request->validate([
        'cancel_reason' => 'required|string'
    ]);

    $order = Order::findOrFail($id);

    $order->update([
        'status' => 'cancelled',
        'cancel_reason' => $request->cancel_reason
    ]);

    return response()->json([
        'success' => true,
        'message' => 'Cancellation reason saved successfully.'
    ]);
}

    /**
     * Verify payment for an order
     */
    public function verifyPayment($id)
    {
        $order = Order::findOrFail($id);
        $order->update([
            'payment_status' => 'verified',
            'status' => 'processing'
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Payment verified successfully'
        ]);
    }

    /**
     * Get orders for dashboard
     */
    public function getDashboardStats()
    {
        $totalOrders = Order::count();
        $pendingOrders = Order::where('status', 'pending')->count();
        $pendingPayments = Order::where('payment_status', 'pending')->count();
        $recentOrders = Order::with(['items', 'user'])
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        return response()->json([
            'total_orders' => $totalOrders,
            'pending_orders' => $pendingOrders,
            'pending_payments' => $pendingPayments,
            'recent_orders' => $recentOrders
        ]);
    }
      public function destroy(Order $order)
{
    DB::beginTransaction();

    try {
        // Delete order items first (important)
        $order->items()->delete();
        // Delete order
        $order->delete();

        DB::commit();

        return response()->json([
            'success' => true
        ]);

    } catch (\Exception $e) {
        DB::rollBack();

        return response()->json([
            'success' => false,
            'message' => 'Unable to delete order'
        ], 500);
    }
}
public function abandonedOrders()
{
$orders = CheckoutLead::with(['items'])
            ->where('is_converted', 0)
            ->orderBy('created_at', 'desc')
            ->paginate(20);
    return view('admin.orders.abandoned', compact('orders'));
}
    public function showcheckoutlead($id)
    {
        $lead = CheckoutLead::with([
            'user',
            'items.product'
        ])->findOrFail($id);

        return view('admin.orders.showcheckoutlead', compact('lead'));
    }
}