<?php

namespace App\Http\Controllers;

use App\Models\CustomerOrder;
use App\Models\CustomerOrderItems;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;


use Illuminate\Support\Facades\Redirect;



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


    public function createTransaction($order_code)
    {
        $order = CustomerOrder::where('order_code', $order_code)->where('user_id', Auth::id())->firstOrFail();
        
        $apiKey = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJhcHBJZCI6IjM2YmFmY2U3LWEyMDEtNDI5Yi1hOWUyLWM1Yjc4NTQ2Njc3YyIsImNvbXBhbnlJZCI6IjYzOTdmMzlkZjA3ZmJhMDAwODQyYTkwYiIsImlhdCI6MTY3MDkwMjY4NSwiZXhwIjo0ODI2NTc2Mjg1fQ.fy12dgFhA3iB_RCjD7y8j5HClNRZUiBZgAg-QzFpxaE';  
        
        $transactionData = [
            'amount' => $order->total_cost * 100,  // Amount in cents (e.g., 500 = 5.00 LKR)
            'currency' => 'LKR',  
            'redirectUrl' => 'https://belvio.lk/payment_received',  
            'webhook' => 'https://belvio.lk/webhook',  
            'localId' => $order_code,  // Local ID for transaction reference
            
        ];

        $client = new Client();  

        try {
            $response = $client->request('POST', 'https://api.uat.geniebiz.lk/public/v2/transactions', [
                'headers' => [
                    'Accept' => 'application/json',
                    'Authorization' => $apiKey,
                    'Content-Type' => 'application/json',
                ],
                'json' => $transactionData,  
            ]);

            $responseBody = json_decode($response->getBody()->getContents(), true);
            
            if (isset($responseBody['url'])) {
                $order->update([
                    'payment_method' => 'Card',
                    'payment_status' => 'Confirmed',
                ]);
                return Redirect::to($responseBody['url']);
                
            } else {
                return response()->json(['error' => 'Payment portal URL not found.'], 400);
            }

        } catch (\Exception $e) {
            return response()->json(['error' => 'Error creating transaction: ' . $e->getMessage()], 500);
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

    public function getOrderDetails2()
    {
        return view('frontend.payment_received');
    }

    public function initiatePayment(Request $request)
    {
        // Validate form data
        $validated = $request->validate([
            'cardName' => 'required|string',
            'cardNumber' => 'required|numeric',
            'expiryDate' => 'required|string',
            'cvv' => 'required|numeric',
        ]);

        // Prepare data to send to the Genie API
        $paymentData = [
            'amount' => $request -> amount,
            'currency' => 'LKR',
            'card_name' => $validated['cardName'],
            'card_number' => $validated['cardNumber'],
            'expiry_date' => $validated['expiryDate'],
            'cvv' => $validated['cvv'],
            'order_id' => uniqid(),
            'return_url' => route('payment.success'),
            'cancel_url' => route('payment.cancel'),
        ];

        // Call Genie Business API for payment initiation
        $url = config('services.genie.base_url') . '/payment/initiate';
        $response = Http::withHeaders([
            'App-Id' => config('services.genie.app_id'),
            'Api-Key' => config('services.genie.api_key'),
        ])->post($url, $paymentData);

        if ($response->successful()) {
            $data = $response->json();
            return redirect()->away($data['payment_url'])->with('success', 'Payment initiation success'); // Redirect user to payment gateway
        } else {
            return back()->with('error','Payment initiation failed. Please try again.');
        }
    }

    public function verifyPayment(Request $request)
    {
        $url = config('services.genie.base_url') . '/payment/verify'; // Adjust endpoint


        $response = Http::withHeaders([
            'App-Id' => config('services.genie.app_id'),
            'Api-Key' => config('services.genie.api_key'),
        ])->post($url, [
            'order_id' => $request->input('order_id'),
        ]);

        if ($response->successful()) {
            return response()->json($response->json());
        } else {
            return response()->json(['error' => 'Verification failed'], 400);
        }
    }
}
