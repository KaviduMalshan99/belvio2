<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{

    
    public function toggleWishlist(Request $request)
    {
        if (Auth::check()) {
            $userId = Auth::id();
            $productId = $request->input('product_id');
    
            $wishlistItem = Wishlist::where('user_id', $userId)->where('product_id', $productId)->first();
    
            if ($wishlistItem) {
                $wishlistItem->delete();
                return response()->json(['message' => 'Product removed from wishlist']);
            } else {
                Wishlist::create(['user_id' => $userId, 'product_id' => $productId]);
                return response()->json(['message' => 'Product added to wishlist']);
            }
        }
    
        return response()->json(['error' => 'You must be logged in to add to wishlist']);
    }
    
    
    public function checkMultipleWishlist(Request $request)
    {
        $productIds = $request->input('product_ids');
        $userId = Auth::id();
    
        if ($userId) {
            // Fetch all products in the wishlist for the current user
            $wishlistProducts = Wishlist::where('user_id', $userId)
                                         ->whereIn('product_id', $productIds)
                                         ->pluck('product_id');
            return response()->json(['wishlist' => $wishlistProducts]);
        }
    
        return response()->json(['wishlist' => []]);
    }
    
    
    

    public function showWishlist()
    {
        if (auth()->check()) {
            $userId = auth()->id();
    
            $wishlistItems = Wishlist::where('user_id', $userId)
                ->with('product')
                ->get();
        } else {
            $wishlistItems = collect(); 
        }
    
        return view('frontend.wishlist', compact('wishlistItems'));
    }
    

    public function destroy($productId)
    {
        $userId = auth()->id(); 
        $wishlistItem = Wishlist::where('user_id', $userId)->where('product_id', $productId)->first();

        if ($wishlistItem) {
            $wishlistItem->delete();
            return redirect()->route('wishlist')->with('success', 'Item removed from your wishlist.');
        }
        return redirect()->route('wishlist')->with('error', 'Item not found in your wishlist.');
    }


    public function getWishlistCount()
    {
        if (Auth::check()) {
            $wishlistCount = Wishlist::where('user_id', Auth::id())->count();
        } else {
            $wishlist = session()->get('wishlist', []);
            $wishlistCount = count($wishlist);
        }

        return response()->json(['wishlist_count' => $wishlistCount]);
    }




    

}
