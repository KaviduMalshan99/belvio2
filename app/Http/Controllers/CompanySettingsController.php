<?php

namespace App\Http\Controllers;

use App\Models\CompanySettings;
use Illuminate\Http\Request;

class CompanySettingsController extends Controller
{

    public function index()
    {
        $company = CompanySettings::first();
        return view('AdminDashboard.manage_company', compact('company'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'contact' => 'required|string|max:15',
            'website' => 'nullable|string|max:255',
            'footer_text' => 'nullable|string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        $company = CompanySettings::first();
        $data = $request->only(['title', 'address', 'email', 'contact', 'website', 'footer_text']);
        
        if ($request->hasFile('logo')) {
            $logo = $request->file('logo');
            $logoName = time() . '.' . $logo->getClientOriginalExtension();
            
            $logoPath = $logo->storeAs('logo', $logoName, 'public');
            
            $data['logo'] = $logoPath; 
        }
    
        if ($company) {
            $company->update($data);
        } else {
            CompanySettings::create($data);
        }
    
        return redirect()->route('manage_company')->with('success', 'Company details saved successfully.');
    }

    public function getCompanyDetails(){
        return CompanySettings::first();
    }
    
}
