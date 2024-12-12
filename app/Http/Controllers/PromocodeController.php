<?php

namespace App\Http\Controllers;
use App\Models\Promocode;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class PromocodeController extends Controller
{
    public function show()
    {
        $promocodes = Promocode::all(); 
        return view('AdminDashboard.promo_codes', compact('promocodes'));
    }


  
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'percentage' => 'required|numeric',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
        ]);

         Promocode::create([
                'name' => $request->name,
                'description' => $request->description,
                'percentage' => $request->percentage,
                'start_date' => $request->start_date, 
                'end_date' => $request->end_date,
            ]);

        return redirect()->route('promo_codes')->with('success', 'Promo code added successfully.');
    }

    
    public function destroy($id)
    {
        $promocodes = Promocode::findOrFail($id);
        $promocodes->delete();
        return redirect()->route('promo_codes')->with('success', 'Promo code deleted successfully.');
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'percentage' => 'required|numeric|min:0|max:100',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after:start_date',
        ]);

        $promoCode = PromoCode::findOrFail($id);
        $promoCode->update($request->all());

        return redirect()->back()->with('success', 'Promo Code updated successfully.');
    }


}
