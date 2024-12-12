<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\CustomerOrder;
use App\Models\CustomerOrderItems;
use App\Models\Variations;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log; 

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $query = CustomerOrder::query();
        if ($request->filled('order_code')) {
            $query->where('order_code', 'like', '%' . $request->order_code . '%');
        }
        if ($request->filled('status') && $request->status != 'All') {
            $query->where('status', $request->status);
        }
        $orders = $query->latest()->paginate(10);

        return view('AdminDashboard.orders', compact('orders'));
}

    public function destroy($id)
    {
        $order = CustomerOrder::findOrFail($id);
        $order->delete();

        return redirect()->route('orders')->with('success', 'Order deleted successfully.');
    }

    public function showOrderDetails($orderCode)
    {
        $order = CustomerOrder::with('items.product')->where('order_code', $orderCode)->first();
        $order = CustomerOrder::with('items.product.images')->where('order_code', $orderCode)->first();
        return view('AdminDashboard.order-details', compact('order'));
    }


    public function updateStatus(Request $request, $orderCode)
    {

        $request->validate([
            'status' => 'required|string|in:Accepted,Shipped,Delivered,Cancelled',
        ]);

        $order = CustomerOrder::where('order_code', $orderCode)->firstOrFail();

        $order->update([
            'status' => $request->status,
        ]);
        return redirect()->back()->with('success', 'Order status updated successfully.');
    }






    //frontend order controller

    public function placeOrder(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'email' => 'required|email',
            'house_no' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'postal_code' => 'required|string|max:10',
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    
        try {
            $user = Auth::user();
            $cartItems = \App\Models\CartItem::where('user_id', $user->id)->get();
    
            if ($cartItems->isEmpty()) {
                return redirect()->back()->with('error', 'Your cart is empty.');
            }
    
            $orderCode = 'ORD-' . strtoupper(Str::random(8));
    
            $subtotal = $cartItems->sum('subtotal');
            $deliveryFee = 350.00;
    
            // Apply promo code if available
            $promoCode = session('promo.name'); 
            $promoDiscount = session('promo.discount_amount', 0); 
    
            $totalCost = $subtotal + $deliveryFee - $promoDiscount; // Apply the discount to the total cost
    
            $customerName = $request->input('first_name') . ' ' . $request->input('last_name');
    
            // Prepare order data
            $orderData = [
                'order_code' => $orderCode,
                'user_id' => $user->id,
                'customer_name' => $customerName,
                'phone' => $request->input('phone'),
                'email' => $request->input('email'),
                'house_no' => $request->input('house_no'),
                'apartment' => $request->input('apartment'),
                'city' => $request->input('city'),
                'postal_code' => $request->input('postal_code'),
                'date' => Carbon::now()->format('Y-m-d'),
                'total_cost' => $totalCost,
                'promo_code' => $promoCode,  // Store promo code
                'promo_discount' => $promoDiscount,  // Store promo discount
                'status' => 'Pending',
                'payment_method' => $request->input('payment_method', null),
                'payment_status' => 'Pending',
            ];
    
            // Create the order
            $order = CustomerOrder::create($orderData);
    
            // Update stock quantities for cart items and variations
            foreach ($cartItems as $cartItem) {
                if (!isset($cartItem->product_id, $cartItem->quantity, $cartItem->price)) {
                    continue;
                }
    
                $product = \App\Models\Product::find($cartItem->product_id);
                if ($product) {
                    $product->quantity = max(0, $product->quantity - $cartItem->quantity);
                    $product->save();
                }
    
                // Update the size variation quantity
                $sizeVariation = \App\Models\Variations::where('product_id', $product->product_id)
                    ->where('type', 'size')
                    ->where('value', $cartItem->size)
                    ->first();
    
                if ($sizeVariation) {
                    $sizeVariation->quantity = max(0, $sizeVariation->quantity - $cartItem->quantity);
                    $sizeVariation->save();
                }
    
                // Add '#' to color if it's not there
                $colorWithHash = (strpos($cartItem->color, '#') === 0) ? $cartItem->color : '#' . $cartItem->color;
    
                // Update the color variation quantity
                $colorVariation = \App\Models\Variations::where('product_id', $product->product_id)
                    ->where('type', 'color')
                    ->where('hex_value', $colorWithHash)
                    ->first();
    
                if ($colorVariation) {
                    $colorVariation->quantity = max(0, $colorVariation->quantity - $cartItem->quantity);
                    $colorVariation->save();
                }
    
                // Add to order items
                CustomerOrderItems::create([
                    'order_code' => $orderCode,
                    'product_id' => $cartItem->product_id,
                    'date' => Carbon::now()->format('Y-m-d'),
                    'cost' => $cartItem->subtotal,
                    'quantity' => $cartItem->quantity,
                    'size' => $cartItem->size ?? null,
                    'color' => $cartItem->color ?? null,
                ]);
            }
    
            // Clear the user's cart
            \App\Models\CartItem::where('user_id', $user->id)->delete();
    
            // Redirect to the payment page with the order code
            return redirect()->route('paymentpage', ['order_code' => $orderCode]);
    
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while placing the order. Please try again.');
        }
    }
    
    


    public function paymentpage(Request $request)
    {
        $orderCode = $request->order_code;

        // Find the order based on the order code
        $order = CustomerOrder::where('order_code', $orderCode)->firstOrFail();

        // Pass the order data to the view
        return view('frontend.paymentmethod', compact('order'));
    }


    public function buynow_placeOrder(Request $request)
    {
        $userId = Auth::id();
        $orderCode = 'ORD-' . strtoupper(Str::random(8));
        $deliveryFee = 350;
        $subtotal = 0;
        
        // Calculate subtotal based on the products in the request
        if ($request->has('products') && is_array($request->products)) {
            foreach ($request->products as $product) {
                $itemSubtotal = $product['cost'] * $product['quantity'];
                $subtotal += $itemSubtotal;
            }
        } else {
            return redirect()->back()->with('error', 'No products selected');
        }
        
        $total = $subtotal + $deliveryFee;
        
        // Create the order
        $order = CustomerOrder::create([
            'order_code' => $orderCode,
            'user_id' => $userId,
            'customer_name' => $request->first_name . ' ' . $request->last_name,
            'phone' => $request->phone,
            'email' => $request->email,
            'house_no' => $request->house_no,
            'apartment' => $request->apartment,
            'city' => $request->city,
            'postal_code' => $request->postal_code,
            'date' => Carbon::now(),
            'total_cost' => $total,
            'status' => 'Pending',
            'payment_method' => $request->input('payment_method', null),
            'payment_status' => 'Pending',
        ]);
        
        // Insert order items and update product/variation quantities
        if ($request->has('products') && is_array($request->products)) {
            foreach ($request->products as $product) {
                $itemSubtotal = $product['cost'] * $product['quantity'];
        
                // Create the order item
                CustomerOrderItems::create([
                    'order_code' => $orderCode,
                    'product_id' => $product['product_id'],
                    'quantity' => $product['quantity'],
                    'size' => $product['size'], 
                    'color' => $product['color'], 
                    'cost' => $itemSubtotal,
                    'date' => Carbon::now(),
                ]);
        
                // Update the main product quantity
                $productRecord = Product::find($product['product_id']);
                $productRecord->decrement('quantity', $product['quantity']);
        
                // Check if size is provided and update size variation stock
                if (isset($product['size']) && $product['size']) {
                    $sizeVariation = \App\Models\Variations::where('product_id', $productRecord->product_id)  
                        ->where('type', 'size')
                        ->where('value', $product['size'])  
                        ->first();
        
                    if ($sizeVariation) {
                        // Decrement the quantity of the size variation
                        $sizeVariation->decrement('quantity', $product['quantity']);
                    } else {
                        // Log product ID and size for debugging, but do not return error
                        //\Log::info('Size variation not found for product ID: ' . $productRecord->product_id . ' with size: ' . $product['size']);
                    }
                }
        
                // Check if color is provided and update color variation stock
                if (isset($product['color']) && $product['color']) {
                    $colorWithHash = (strpos($product['color'], '#') === 0) ? $product['color'] : '#' . $product['color'];
        
                    $colorVariation = \App\Models\Variations::where('product_id', $productRecord->product_id)  
                        ->where('type', 'color')
                        ->where('hex_value', $colorWithHash)  
                        ->first();
        
                    if ($colorVariation) {
                        // Decrement the quantity of the color variation
                        $colorVariation->decrement('quantity', $product['quantity']);
                    } else {
                        // Log product ID and color for debugging, but do not return error
                        //\Log::info('Color variation not found for product ID: ' . $productRecord->product_id . ' with color: ' . $colorWithHash);
                    }
                }
            }
        } else {
            return redirect()->back()->with('error', 'No products selected');
        }
        
        // Redirect to the payment page
        return redirect()->route('paymentpage', ['order_code' => $orderCode]);
    }

    
}
