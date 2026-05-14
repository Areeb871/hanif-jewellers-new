<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Products;
use App\Models\Cart;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(){
        try {
            // Order Statistics
            $totalOrders = Order::count();
            $pendingOrders = Order::where('status', 'pending')->count();
            $processingOrders = Order::where('status', 'processing')->count();
            $shippedOrders = Order::where('status', 'shipped')->count();
            $deliveredOrders = Order::where('status', 'delivered')->count();
            $cancelledOrders = Order::where('status', 'cancelled')->count();
            
            // Payment Statistics
            $pendingPayments = Order::where('payment_status', 'pending')->count();
            $verifiedPayments = Order::where('payment_status', 'verified')->count();
            $failedPayments = Order::where('payment_status', 'failed')->count();
            
            // Revenue Statistics
            $totalRevenue = Order::where('payment_status', 'verified')->sum('total_amount');
            $monthlyRevenue = Order::where('payment_status', 'verified')
                ->whereMonth('created_at', Carbon::now()->month)
                ->sum('total_amount');
            $weeklyRevenue = Order::where('payment_status', 'verified')
                ->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
                ->sum('total_amount');
            
            // Product Statistics
            $totalProducts = Products::count();
            $featuredProducts = Products::where('is_featured', '1')->count();
            
            // User Statistics
            $totalUsers = User::count();
            $guestOrders = Order::whereNull('user_id')->count();
            $userOrders = Order::whereNotNull('user_id')->count();
            
            // Cart Statistics
            $activeCarts = Cart::count();
            
            // Recent Orders
            $recentOrders = Order::with(['items', 'user'])
                ->orderBy('created_at', 'desc')
                ->limit(10)
                ->get();
            
            // Monthly Revenue Chart Data (Last 6 months)
            $monthlyRevenueData = [];
            for ($i = 5; $i >= 0; $i--) {
                $month = Carbon::now()->subMonths($i);
                $revenue = Order::where('payment_status', 'verified')
                    ->whereYear('created_at', $month->year)
                    ->whereMonth('created_at', $month->month)
                    ->sum('total_amount');
                
                $monthlyRevenueData[] = [
                    'month' => $month->format('M Y'),
                    'revenue' => $revenue
                ];
            }
            
            // Order Status Distribution
            $orderStatusData = [
                ['status' => 'Pending', 'count' => $pendingOrders, 'color' => '#ffc107'],
                ['status' => 'Processing', 'count' => $processingOrders, 'color' => '#007bff'],
                ['status' => 'Shipped', 'count' => $shippedOrders, 'color' => '#6c757d'],
                ['status' => 'Delivered', 'count' => $deliveredOrders, 'color' => '#28a745'],
                ['status' => 'Cancelled', 'count' => $cancelledOrders, 'color' => '#dc3545'],
            ];
            
            // Top Products (by order count)
            $topProducts = collect();
            if (DB::table('order_items')->count() > 0) {
                $topProducts = DB::table('order_items')
                    ->select('product_name', DB::raw('SUM(quantity) as total_quantity'), DB::raw('COUNT(*) as order_count'))
                    ->groupBy('product_name')
                    ->orderBy('total_quantity', 'desc')
                    ->limit(5)
                    ->get();
            }
            
            return view('admin.index', compact(
                'totalOrders',
                'pendingOrders',
                'processingOrders',
                'shippedOrders',
                'deliveredOrders',
                'cancelledOrders',
                'pendingPayments',
                'verifiedPayments',
                'failedPayments',
                'totalRevenue',
                'monthlyRevenue',
                'weeklyRevenue',
                'totalProducts',
                'featuredProducts',
                'totalUsers',
                'guestOrders',
                'userOrders',
                'activeCarts',
                'recentOrders',
                'monthlyRevenueData',
                'orderStatusData',
                'topProducts'
            ));
        } catch (\Throwable $th) {
            return response()->json([ 'message' => 'SOMETHING WENT WRONG','error' => $th->getMessage() ], 500);
        }
    }
}
