<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminDashboardController extends Controller
{
    public function index(Request $request)
    {
        $totalSales = Order::where('payment_status', 'paid')->sum('grand_total');
        $todaySales = Order::where('payment_status', 'paid')->whereDate('created_at', today())->sum('grand_total');
        $totalOrders = Order::count();
        $pendingOrders = Order::where('order_status', 'pending')->count();
        $deliveredOrders = Order::where('order_status', 'delivered')->count();
        $totalCustomers = User::whereHas('role', function ($q) { $q->where('name', 'customer'); })->count();
        $totalProducts = Product::count();
        $lowStockProducts = Product::where('stock', '<=', 5)->count();

        $recentOrders = Order::with('user')->latest()->take(8)->get();

        // Chart data - Sales last 7 days
        $salesByDay = Order::select(DB::raw('DATE(created_at) as date'), DB::raw('SUM(grand_total) as total'))
            ->where('payment_status', 'paid')
            ->where('created_at', '>=', now()->subDays(7))
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get();

        return view('admin.dashboard', compact(
            'totalSales', 'todaySales', 'totalOrders', 'pendingOrders',
            'deliveredOrders', 'totalCustomers', 'totalProducts', 'lowStockProducts',
            'recentOrders', 'salesByDay'
        ));
    }
}
