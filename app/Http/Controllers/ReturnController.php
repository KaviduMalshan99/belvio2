<?php

namespace App\Http\Controllers;

use App\Models\CustomerOrderItems;
use App\Models\Returns;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReturnController extends Controller
{
    public function returns()
    {
        $loggedCustomerId = Auth::id(); //change with logging

        if ($loggedCustomerId) {
            $orderedProducts = DB::table('customer_order_items')
                ->join('products', 'customer_order_items.product_id', '=', 'products.id')
                ->join('customer_orders', 'customer_order_items.order_code', '=', 'customer_orders.id')
                ->select('products.id', 'products.product_name', 'customer_order_items.id', 'customer_orders.order_code')
                ->where('customer_order_items.returned', 'no') // Filter for unreviewed items
                ->distinct() // Avoid duplicates
                ->get();

            $returns = Returns::where('returns.customer_id', $loggedCustomerId)
                ->join('customer_order_items', 'returns.order_item_id', '=', 'customer_order_items.id')
                ->join('customer_orders', 'customer_order_items.order_code', '=', 'customer_orders.id')
                ->join('products', 'returns.product_id', '=', 'products.id')
                ->select(
                    'returns.*',
                    'products.product_name',
                    'customer_orders.order_code'
                )
                ->get();


            return view('frontend.return_product', compact('orderedProducts', 'returns'));
        } else {
            return redirect()->back()->with('error', 'Please Login First.');
        }
    }

    public function storeReturn(Request $request)
    {
        //Log::info('Store request data: ', $request->all());

        $validatedData = $request->validate([
            'order_item_id' => 'required|exists:customer_order_items,id',
            'reason' => 'nullable|string',
            'media' => 'nullable|array',
            'media.*' => 'mimes:jpg,jpeg,png|max:5120', // 5MB limit
        ]);

        // Handle media upload
        $mediaPaths = [];
        if ($request->hasFile('media')) {
            foreach ($request->file('media') as $media) {
                $mediaPaths[] = $media->store('returns/media', 'public');
            }
        }

        $orderItem = CustomerOrderItems::find($validatedData['order_item_id']);

        $validatedData['media'] = $mediaPaths;
        $validatedData['status'] = 'Pending'; // Default status
        $validatedData['customer_id'] = Auth::id();
        $validatedData['product_id'] = $orderItem->product_id;

        Returns::create($validatedData);

        if ($orderItem) {
            $orderItem->returned = 'yes';
            $orderItem->save();
        }

        return redirect()->back()->with('success', 'Return submitted successfully.');
    }







    public function adminView()
    {
        $approvedReturns = Returns::select(
            'returns.*',
            'products.product_name',
            'customer_orders.order_code'
        )
        ->join('customer_order_items', 'returns.order_item_id', '=', 'customer_order_items.id')
        ->join('products', 'customer_order_items.product_id', '=', 'products.id')
        ->join('customer_orders', 'customer_order_items.order_code', '=', 'customer_orders.id')
        ->where('returns.status', 'Approved')
        ->latest()
        ->paginate(10, ['*'], 'published_page');

        $pendingReturns = Returns::select(
            'returns.*',
            'products.product_name',
            'customer_orders.order_code'
        )
        ->join('customer_order_items', 'returns.order_item_id', '=', 'customer_order_items.id')
        ->join('products', 'customer_order_items.product_id', '=', 'products.id')
        ->join('customer_orders', 'customer_order_items.order_code', '=', 'customer_orders.id')
        ->where('returns.status', 'Pending')
        ->latest()
        ->paginate(10, ['*'], 'pending_page'); // Separate pagination for pending
    

        $rejectedReturns = Returns::select(
            'returns.*',
            'products.product_name',
            'customer_orders.order_code'
        )
        ->join('customer_order_items', 'returns.order_item_id', '=', 'customer_order_items.id')
        ->join('products', 'customer_order_items.product_id', '=', 'products.id')
        ->join('customer_orders', 'customer_order_items.order_code', '=', 'customer_orders.id')
        ->where('returns.status', 'Rejected')
        ->latest()
        ->paginate(10, ['*'], 'rejected_page'); // Separate pagination for rejected
    

        return view('AdminDashboard.returns', compact('approvedReturns', 'pendingReturns', 'rejectedReturns'));
    }

    public function adminViewDetails($id)
    {
        $return= Returns::findOrFail($id);
        return view('AdminDashboard.return_details', compact('return'));
    }


    public function updateStatus(Request $request, $id)
    {
        $validated = $request->validate([
            'status' => 'required|in:Pending,Approved,Rejected',
        ]);

        $return = Returns::findOrFail($id);
        $return->update(['status' => $validated['status']]);

        return redirect()->route('adminReturns')->with('success', 'Return status updated successfully.');
    }


    public function destroy(Returns $return)
    {
        $orderItemId = $return->order_item_id;

        if ($orderItemId) {
            CustomerOrderItems::where('id', $orderItemId)->update(['returned' => 'no']);
        }

        $return->delete();
        return redirect()->back()->with('success', 'Return deleted successfully.');
    }
}
