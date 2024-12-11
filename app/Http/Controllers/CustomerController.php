<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\CustomerOrder;
use Illuminate\Http\Request;

class CustomerController extends Controller
{

    public function show()
    {
        $customers = User::withCount('customerOrders')->paginate(10); 

        return view('AdminDashboard.customer', compact('customers'));
    }
    
    


    public function showCustomerDetails($user_id)
    {
        $customer = User::findOrFail($user_id);
        
        $orders = CustomerOrder::where('user_id', $user_id)
            ->with('items.product')
            ->get();
        
        $totalCost = $orders->sum('total_cost');
        $totalOrders = $orders->count();
        $totalProducts = $orders->sum(function ($order) {
            return $order->items->sum('quantity');
        });

        return view('AdminDashboard.customer-details', compact('customer', 'orders', 'totalCost', 'totalOrders', 'totalProducts'));
    }
}
