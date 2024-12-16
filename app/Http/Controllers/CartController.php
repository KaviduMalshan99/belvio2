<?php

namespace App\Http\Controllers;
use App\Models\CartItem;
use App\Models\PromoCode;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;


class CartController extends Controller
{

    public function getCartCount()
    {
        if (Auth::check()) {
            $cartCount = CartItem::where('user_id', Auth::id())->count();
        } else {
            $cart = session()->get('cart', []);
            $cartCount = count($cart);
        }

        return response()->json(['cart_count' => $cartCount]);
    }

    
    public function showCart()
    {
        if (!auth()->check()) {
            return view('frontend.cart')
                ->with('message', 'Please sign in to view your cart and start shopping.')
                ->with('cartItems', collect([])); 
        }
    
        $userId = auth()->user()->id;
        $cartItems = CartItem::where('user_id', $userId)->get();
    
        if ($cartItems->isEmpty()) {
            return view('frontend.cart')
                ->with('cartItems', collect([])); 
        }
    
        foreach ($cartItems as $item) {
            $product = Product::with('images')->find($item->product_id);
    
            if ($product) {
                $item->product_name = $product->name;
                $item->product_image = $product->images->first() ? $product->images->first()->image_path : null; // Fetch the first image
                $item->subtotal = $item->price * $item->quantity;
            } else {
                $item->product_name = 'Unknown Product';
                $item->product_image = null;
                $item->subtotal = 0;
            }
        }
    
        return view('frontend.cart', compact('cartItems'));
    }
    
    
    public function applyPromo(Request $request)
{
    $request->validate([
        'promo_code' => 'required|string',
    ]);

    // Check if the promo code is valid
    $promoCode = PromoCode::where('name', $request->promo_code)
        ->where('start_date', '<=', now())
        ->where('end_date', '>=', now())
        ->first();

    if (!$promoCode) {
        session()->flash('error', 'Invalid or expired promo code.');
        return redirect()->back();
    }

    // Check if the cart is empty
    $userId = auth()->user()->id;
    $cartItems = CartItem::where('user_id', $userId)->get();

    if ($cartItems->isEmpty()) {
        session()->flash('error', 'Your cart is empty.');
        return redirect()->back(); 
    }

    // Calculate totals
    $subtotal = $cartItems->sum(function ($item) {
        return $item->price * $item->quantity;
    });

    $discountPercentage = $promoCode->percentage;
    $discountAmount = ($subtotal * $discountPercentage) / 100;
    $total = $subtotal + 350 - $discountAmount;

    // Store promo details in the session
    session()->put('promo', [
        'name' => $promoCode->name,
        'discount_percentage' => $discountPercentage,
        'discount_amount' => $discountAmount,
        'total' => $total,
    ]);

    session()->flash('success', 'Promo code applied successfully.');
    return redirect()->back(); 
}


    
    
    
    

    public function removePromo()
    {
        session()->forget('promo');  // Remove the promo code session
        return redirect()->route('cart');  
    }



    public function update(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);
    
        $cartItem = CartItem::find($id);
    
        if (!$cartItem) {
            return response()->json([
                'message' => 'Cart item not found',
            ], 404);
        }
    
        // Update the quantity and subtotal
        $cartItem->quantity = $request->quantity;
        $cartItem->subtotal = $cartItem->product->normal_price * $cartItem->quantity;
        $cartItem->save();
    
        return response()->json([
            'message' => 'Cart item updated successfully',
            'cart_item' => [
                'id' => $cartItem->id,
                'quantity' => $cartItem->quantity,
                'subtotal' => $cartItem->subtotal,
            ],
        ]);
    }
    

    
    
    

    public function remove(CartItem $cartItem)
    {
        $cartItem->delete();
        return redirect()->route('cart');
    }

    

    public function addToCart(Request $request)
    {
        try {
            $quantity = $request->input('quantity', 1);
            $productId = $request->input('product_id');
            $size = $request->input('size');
            $color = $request->input('color');
    
            // Validate input
            $request->validate([
                'product_id' => 'required|exists:products,id',
                'quantity' => 'required|integer|min:1',
                'size' => 'nullable|string',
                'color' => 'nullable|string',
            ]);
    
            // Check if user is logged in
            if (!auth()->check()) {
                return redirect()->route('login')->with('error', 'Please log in to add items to the cart.');
            }
    
            $product = Product::with('promotions')->findOrFail($productId);
    
            // Determine price: use discount price if available, otherwise normal price
            $price = $product->promotions->isNotEmpty()
                ? $product->promotions->first()->discount_price
                : $product->normal_price;
    
            if (is_null($price)) {
                return redirect()->back()->with('error', 'Product price is not available.');
            }
    
            $subtotal = $quantity * $price;
    
            $existingCartItem = CartItem::where('user_id', auth()->id())
                ->where('product_id', $productId)
                ->where(function($query) use ($size, $color) {
                    if ($size) {
                        $query->where('size', $size);
                    }
                    if ($color) {
                        $query->where('color', $color);
                    }
                })
                ->first();
    
            if ($existingCartItem) {
                // If the same combination of size/color exists, update the quantity and subtotal
                $existingCartItem->quantity += $quantity;
                $existingCartItem->subtotal = $existingCartItem->quantity * $price;
                $existingCartItem->save();
                return redirect()->back()->with('success', 'Product added to cart');
            } else {
                // Create a new cart item with the calculated subtotal
                CartItem::create([
                    'user_id' => auth()->id(),
                    'product_id' => $productId,
                    'quantity' => $quantity,
                    'size' => $size,
                    'color' => $color,
                    'price' => $price,
                    'subtotal' => $subtotal,
                ]);
    
                return redirect()->back()->with('success', 'Product added to cart!');
            }
    
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong while adding the item to your cart.');
        }
    }
    
    
    
    
    public function checkout(Request $request)
    {
        // Get the promo code from the query string, if any
        $promoCode = $request->query('promo_code', null);
        
        $userId = Auth::id();
        $cartItems = CartItem::where('user_id', $userId)->get();
    
        foreach ($cartItems as $item) {
            $product = Product::find($item->product_id);
            $item->product_name = $product->product_name;
            $item->subtotal = $item->price * $item->quantity;
        }
    
        $subtotal = $cartItems->sum('subtotal');
        $deliveryFee = 350;
        
        $total = $subtotal + $deliveryFee;
    
        // If there's a promo code, apply the discount
        $discountAmount = 0;
        if ($promoCode && session('promo')) {
            $discountAmount = session('promo.discount_amount');
            $total -= $discountAmount; 
        }
    
        return view('frontend.checkout', compact('cartItems', 'subtotal', 'total', 'discountAmount'));
    }
    
    
    

    public function buyNowCheckout($productId, Request $request)
    {
        $userId = Auth::id();
        $product = Product::findOrFail($productId);

        $products = [$product]; 
    
        if ($product->quantity <= 0) {
            return redirect()->back()->with('error', 'This product is out of stock.');
        }
    
        $selectedSize = $request->get('selectedSize');
        $selectedColor = $request->get('selectedColor');
        $quantity = (int)$request->get('quantity', 1); 
    
        $subtotal = $product->normal_price * $quantity; 
        $total = $subtotal + 350; 
    
        return view('frontend.buy_now_checkout', compact('products', 'quantity', 'subtotal', 'total', 'selectedSize', 'selectedColor'));
    }
    



}
