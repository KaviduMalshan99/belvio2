<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Review;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function shop(Request $request)
    {
        // Fetch all categories
        $categories = Category::all();

        // Fetch products with associated images and variations (for color and size filters)
        $products = Product::with(['images', 'variations','promotions']);

        // Filter by Category (if a category is selected)
        if ($request->has('category')) {
            $products = $products->whereHas('category', function ($query) use ($request) {
                $query->where('name', $request->category);
            });
        }

        // Apply Size filter if selected
        if ($request->has('size') && !empty($request->size)) {
            $products = $products->whereHas('variations', function ($query) use ($request) {
                $query->where('type', 'size')
                    ->whereIn('value', $request->size);
            });
        }

        // Filter by Color (if colors are selected)
        if ($request->has('color')) {
            $colors = $request->color;
            if (!is_array($colors)) {
                $colors = [$colors];
            }

            $products = $products->whereHas('variations', function ($query) use ($colors) {
                $query->where('type', 'color')
                    ->whereIn('hex_value', $colors);
            });
        }


        // Apply Price filter if price range is selected
        if ($request->has('price_min') && $request->has('price_max')) {
            $price_min = $request->price_min;
            $price_max = $request->price_max;

            // Ensure the price range is valid
            if (is_numeric($price_min) && is_numeric($price_max) && $price_min <= $price_max) {
                $products = $products->whereBetween('normal_price', [$price_min, $price_max]);
            }
        }

        // Filter by Tags (if tags are selected)
        if ($request->has('tags') && is_array($request->tags)) {
            $tags = $request->tags;
            $products = $products->where(function ($query) use ($tags) {
                foreach ($tags as $tag) {
                    $query->orWhere('tags', 'like', '%' . $tag . '%');
                }
            });
        }

        // Filter by Name (Search functionality)
        if ($request->has('s') && !empty($request->s)) {
            $search = $request->s;
            $products = $products->where('product_name', 'like', '%' . $search . '%');
        }

        // Paginate products (12 per page)
        $products = $products->paginate(12);

        // Get all tags from the products table and ensure no duplicates
        $tags = Product::pluck('tags')
            ->map(function ($tag) {
                return explode(',', $tag);
            })
            ->flatten()
            ->map(function ($tag) {
                return trim($tag);
            })
            ->unique();

        return view('frontend.shop', compact('products', 'categories', 'tags'));
    }



    public function shop_details($product_id)
    {
        $product = Product::with('category', 'images', 'variations','promotions')->findOrFail($product_id);

        // Get related products from the same category, excluding the current product
        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->with('images')
            ->take(4)
            ->get();

        $reviews = Review::where('product_id', $product->id)
            ->where('status', 'Published')
            ->with('reviewer')
            ->get();

        $productStock = $product->quantity;

        // Calculate average rating
        $averageRating = $reviews->avg('rating');

        // Calculate rating counts
        $ratingCounts = $reviews->groupBy('rating')->map(function ($group) {
            return $group->count();
        });

        // Total reviews
        $totalReviews = $reviews->count();

        // Ensure all rating levels (1-5) exist
        $ratingCounts = collect([1, 2, 3, 4, 5])->mapWithKeys(function ($rating) use ($ratingCounts) {
            return [$rating => $ratingCounts->get($rating, 0)];
        });

        return view('frontend.shop-details', compact(
            'product',
            'relatedProducts',
            'reviews',
            'averageRating',
            'ratingCounts',
            'totalReviews',
            'productStock'
        ));
    }

    public function sub_catogory_view($category_id, $sub_category_id)
    {


        $sub_category = Subcategory::where('id',$sub_category_id)->value('name');
        // Fetch products for this subcategory
        $products = Product::with(['images', 'variations'])->where('subcategory_id', $sub_category_id);

        // Paginate products (12 per page)
        $products = $products->paginate(12);

        // Get all tags from the products table and ensure no duplicates
        $tags = Product::pluck('tags')
            ->map(function ($tag) {
                return explode(',', $tag);
            })
            ->flatten()
            ->map(function ($tag) {
                return trim($tag);
            })
            ->unique();
        // dd('test');
        return view('frontend.sub-categories', compact('products', 'sub_category' ,'tags'));
    }
}
