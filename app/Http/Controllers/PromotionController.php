<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\Promotion;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class PromotionController extends Controller
{
    public function displayProducts()
    {
        $products = Product::all();
        return view('AdminDashboard.add_promotions', compact('products'));
    }

    public function show()
    {
        $promotions = Promotion::with('product')->get(); 
        return view('AdminDashboard.promotions', compact('promotions'));
    }


    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'product_id' => 'required|string|max:255',
            'discount' => 'required|numeric',
            'discount_price' => 'required|numeric',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
            'status' => 'required|string'
        ]);

         Promotion::create([
                'product_id' => $request->product_id,
                'discount' => $request->discount,
                'discount_price' => $request->discount_price,
                'start_date' => $request->start_date, 
                'end_date' => $request->end_date,
                'status' => $request->status,
            ]);

        return redirect()->route('promotions')->with('success', 'Promotion added successfully.');
    }

    public function edit($promotionId)
    {
        $promotion = Promotion::findOrFail($promotionId);
        $products = Product::all();
        return view('AdminDashboard.edit_promotions', compact('promotion', 'products'));
    }


    public function update(Request $request, $promotionId)
    {
        // Validate the incoming request
        $validator = Validator::make($request->all(), [
            'product_id' => 'required|string|max:255',
            'discount' => 'required|numeric',
            'discount_price' => 'required|numeric',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
            'status' => 'required|string|in:active,inactive',
        ]);

        if ($validator->fails()) {
            return redirect()->route('promotion.edit', $promotionId)
                ->withErrors($validator)
                ->withInput();
        }

        // Find the promotion to update
        $promotion = Promotion::findOrFail($promotionId);

        // Update the promotion details
        $promotion->product_id = $request->product_id;
        $promotion->discount = $request->discount;
        $promotion->discount_price = $request->discount_price;
        $promotion->start_date = $request->start_date;
        $promotion->end_date = $request->end_date;
        $promotion->status = $request->status;
        $promotion->save(); 

        return redirect()->route('promotions')->with('success', 'Promotion updated successfully.');
    }


    public function destroy($id)
    {
        $promotions = Promotion::findOrFail($id);
        $promotions->delete();
        return redirect()->route('promotions')->with('success', 'Promotion deleted successfully.');
    }

}
