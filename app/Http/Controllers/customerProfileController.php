<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\User;
use App\Models\CustomerOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class customerProfileController extends Controller
{
    public function viewProfile()
    {
        $loggedCustomerId = Auth::id(); //change with logging

        if ($loggedCustomerId) {
            $customer = User::findOrFail($loggedCustomerId);

            $orders = DB::table('customer_orders')
                ->leftJoin('customer_order_items', 'customer_orders.id', '=', 'customer_order_items.order_code')
                ->leftJoin('products', 'customer_order_items.product_id', '=', 'products.id')
                ->select(
                    'customer_orders.date',
                    'customer_orders.order_code',
                    'customer_orders.total_cost',
                    'customer_orders.status',
                    'customer_orders.payment_method',
                    'customer_orders.payment_status',
                    DB::raw('GROUP_CONCAT(CONCAT(customer_order_items.quantity, "x ", products.product_name) SEPARATOR ", ") as order_items')
                )
                ->groupBy(
                    'customer_orders.date',
                    'customer_orders.order_code',
                    'customer_orders.total_cost',
                    'customer_orders.status',
                    'customer_orders.payment_method',
                    'customer_orders.payment_status'
                )
                ->get();

            $orderedProducts = DB::table('customer_order_items')
                ->join('products', 'customer_order_items.product_id', '=', 'products.id')
                ->select('products.id', 'products.product_name', 'customer_order_items.id')
                ->where('customer_order_items.reviewed', 'no') // Filter for unreviewed items
                ->distinct() // Avoid duplicates
                ->get();

            $userReviews = Review::where('reviewer_id', $customer->id)
                ->join('products', 'reviews.product_id', '=', 'products.id')
                ->select('reviews.*', 'products.product_name')
                ->get();



            return view('frontend.profile', compact('customer', 'orders', 'orderedProducts','userReviews'));
        } else {
            return redirect()->back()->with('error', 'Please Login First.');
        }
    }

    public function updateProfile(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:15',
            'address' => 'required|string|max:255',
        ]);

        $customer = User::findOrFail($id);

        $customer->update([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'phone' => $validatedData['phone'],
            'address' => $validatedData['address'],
        ]);

        return redirect()->back()->with('success', 'Profile updated successfully.');
    }

    public function updatePassword(Request $request, $id)
    {
        $validatedData = $request->validate([
            'password' => 'required|string',
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        $customer = User::findOrFail($id);

        if (!Hash::check($validatedData['password'], $customer->password)) {
            return redirect()->back()->with('error', 'Currrent password is incorrect');
        }

        $customer->update([
            'password' => Hash::make($validatedData['new_password']),
        ]);

        return redirect()->back()->with('success', 'Password updated successfully.');
    }

    public function trackOrder($orderCode)
    {
        $order = CustomerOrder::where('order_code', $orderCode)->firstOrFail();

        // Convert activity_logs to a Laravel Collection
        $order->activity_logs = collect($order->activity_logs ?? []);

        return view('frontend.tracking', compact('order'));
    }


    public function logout()
    {
        Auth::logout(); // Log out the user
        return redirect()->route('home')->with('success', 'You have been logged out successfully.');
    }
}
