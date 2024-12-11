<?php

namespace App\Http\Controllers;

//use App\Models\Category;

use App\Models\Blog;
use App\Models\Category;
use App\Models\CompanySettings;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $products = Product::with('category', 'images')
                           ->take(12)
                           ->get();

        $blogs = Blog::where('status', 'Active')
                 ->latest()
                 ->take(3)
                 ->get();                  

        return view('frontend.Home', compact('products', 'categories','blogs'));
    }

    
    public function about_us(){
        return view('frontend.about');
    }

    public function show_store(){
        dd('View Store');
        return view('frontend.About');
    }
    
    public function contact_us(){
        $companyDetails = CompanySettings::first();
        return view('frontend.contactUs',compact('companyDetails'));
    }



    public function searchResults(Request $request)
    {
        $query = $request->get('s');
    
        $products = Product::with('category', 'subcategory', 'subSubcategory')
                            ->where('product_name', 'like', '%' . $query . '%')
                            ->orWhere('tags', 'like', '%' . $query . '%')
                            ->orWhereHas('category', function ($q) use ($query) {
                                $q->where('name', 'like', '%' . $query . '%');
                            })
                            ->orWhereHas('subcategory', function ($q) use ($query) {
                                $q->where('name', 'like', '%' . $query . '%');
                            })
                            ->orWhereHas('subSubcategory', function ($q) use ($query) {
                                $q->where('name', 'like', '%' . $query . '%');
                            })
                            ->paginate(12);  // Paginate the results
    
        return view('frontend.search-results', compact('products', 'query'));
    }
    
    

    public function searchSuggestions(Request $request)
    {
        $query = $request->get('query');

        // Search in product names, tags, and categories
        $products = Product::with('category', 'subcategory', 'subSubcategory')
                            ->where('product_name', 'like', '%' . $query . '%')
                            ->orWhere('tags', 'like', '%' . $query . '%')
                            ->orWhereHas('category', function ($q) use ($query) {
                                $q->where('name', 'like', '%' . $query . '%');
                            })
                            ->orWhereHas('subcategory', function ($q) use ($query) {
                                $q->where('name', 'like', '%' . $query . '%');
                            })
                            ->orWhereHas('subSubcategory', function ($q) use ($query) {
                                $q->where('name', 'like', '%' . $query . '%');
                            })
                            ->get();

        return response()->json($products);

    }

    
}
