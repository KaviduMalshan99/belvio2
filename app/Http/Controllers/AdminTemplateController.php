<?php

namespace App\Http\Controllers;
use App\Models\CustomerOrder;
use App\Models\CustomerOrderItems;
use App\Models\User;
use App\Models\CompanySettings; 
use App\Models\Product;
use Illuminate\Http\Request;
use Carbon\Carbon; 

class AdminTemplateController extends Controller
{

    public function index()
    {
        $orderCount = CustomerOrder::count();
        $customerCount = User::count();
        $productCount = Product::count();
        $totalCostToday = CustomerOrder::whereDate('created_at', Carbon::today())->sum('total_cost');
    
        // Sales data for the chart (last 12 months)
        $salesData = CustomerOrder::selectRaw('MONTH(created_at) as month, SUM(total_cost) as total_sales')
            ->whereYear('created_at', Carbon::now()->year)
            ->groupBy('month')
            ->orderBy('month')
            ->get()
            ->pluck('total_sales', 'month');
        
        // Fill sales data for all 12 months
        $salesChartData = array_fill(0, 12, 0);
        foreach ($salesData as $month => $sales) {
            $salesChartData[$month - 1] = $sales; // Adjust for zero-based index
        }
    
        // Fetch recent activities
        $recentProducts = Product::latest()->take(5)->get();
        $recentOrders = CustomerOrder::latest()->take(5)->get();
        $recentUsers = User::latest()->take(5)->get();
    
        // Prepare recent activities data
        $recentActivities = collect();
    
        foreach ($recentOrders as $order) {
            $recentActivities->push([
                'date' => $order->created_at->format('d M'),
                'message' => 'New Order: ' . $order->order_code,
            ]);
        }
    
        foreach ($recentProducts as $product) {
            $recentActivities->push([
                'date' => $product->created_at->format('d M'),
                'message' => 'New Product: ' . $product->product_name,
            ]);
        }
    
        foreach ($recentUsers as $user) {
            $recentActivities->push([
                'date' => $user->created_at->format('d M'),
                'message' => 'New User: ' . $user->name,
            ]);
        }
    
    
        // Sort activities by date
        $recentActivities = $recentActivities->sortByDesc('date')->take(6);

        $latestOrders = CustomerOrder::where('created_at', '>=', Carbon::now()->subDays(3))
        ->orderBy('created_at', 'desc')
        ->take(10)
        ->get();
        
        return view('AdminDashboard.Home', compact(
            'orderCount',
            'customerCount',
            'productCount',
            'totalCostToday',
            'salesChartData',
            'recentActivities',
            'latestOrders'
        ));
    }


    public function sidebar()
    {
        $companySettings = CompanySettings::first(); 
        return view('AdminDashboard.Sidebar', compact('companySettings'));
    }

    
}


