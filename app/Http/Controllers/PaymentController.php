<?php

namespace App\Http\Controllers;
use App\Models\CustomerOrder;
use App\Models\CustomerOrderItems;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    

    public function showPaymentPage($order_code)
    {
        $order = CustomerOrder::where('order_code', $order_code)->with('items.product')->firstOrFail();
        return view('frontend.payment', compact('order'));
    }



    public function confirmCODOrder($order_code)
    {
        try {
            $order = CustomerOrder::where('order_code', $order_code)->where('user_id', Auth::id())->firstOrFail();
            
            // Update the payment method and payment status
            $order->update([
                'payment_method' => 'COD',
            ]);

            return redirect()->route('order.thankyou', ['order_code' => $order_code])
                            ->with('success', 'Order confirmed successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to confirm order. Please try again.');
        }
    }


    public function getOrderDetails($order_code)
    {
        $order = CustomerOrder::where('order_code', $order_code)
                    ->where('user_id', Auth::id())
                    ->firstOrFail();

        $orderItems = CustomerOrderItems::where('order_code', $order_code)->get();
        return view('frontend.order_received', compact('order', 'orderItems'));
    }


}
