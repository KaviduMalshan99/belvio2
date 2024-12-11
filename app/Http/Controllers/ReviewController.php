<?php

namespace App\Http\Controllers;

use App\Models\CustomerOrderItems;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ReviewController extends Controller
{
    public function store(Request $request)
    {
        //Log::info('Store request data: ', $request->all());

        $validatedData = $request->validate([
            'order_item_id' => 'required|exists:customer_order_items,id',
            'rating' => 'nullable|integer|min:0|max:5',
            'review' => 'nullable|string',
            'is_anonymous' => 'boolean',
            'media' => 'nullable|array',
            'media.*' => 'mimes:jpg,jpeg,png|max:5120', // 5MB limit
        ]);

        // Handle media upload
        $mediaPaths = [];
        if ($request->hasFile('media')) {
            foreach ($request->file('media') as $media) {
                $mediaPaths[] = $media->store('reviews/media', 'public');
            }
        }

        $orderItem = CustomerOrderItems::find($validatedData['order_item_id']);

        if ($validatedData['rating'] == null) {
            $validatedData['rating'] = 0;
        }
        $validatedData['media'] = $mediaPaths;
        $validatedData['status'] = 'Pending'; // Default status
        $validatedData['reviewer_id'] = Auth::id();
        $validatedData['product_id'] = $orderItem->product_id;

        Review::create($validatedData);


        if ($orderItem) {
            $orderItem->reviewed = 'yes';
            $orderItem->save();
        }

        return redirect()->back()->with('success', 'Review submitted successfully.');
    }


    public function customerDestroy(Review $review)
    {
        $orderItemId = $review->order_item_id;

        if ($orderItemId) {
            CustomerOrderItems::where('id', $orderItemId)->update(['reviewed' => 'no']);
        }

        $review->delete();

        return redirect()->back()->with('success', 'Review deleted successfully.');
    }






    //Admin

    public function adminView()
    {
        $publishedReviews = Review::with(['product', 'reviewer'])
            ->where('status', 'Published')
            ->latest()
            ->paginate(10, ['*'], 'published_page'); // Separate pagination for published

        $pendingReviews = Review::with(['product', 'reviewer'])
            ->where('status', 'Pending')
            ->latest()
            ->paginate(10, ['*'], 'pending_page'); // Separate pagination for pending

        $rejectedReviews = Review::with(['product', 'reviewer'])
            ->where('status', 'Rejected')
            ->latest()
            ->paginate(10, ['*'], 'rejected_page');

        return view('AdminDashboard.reviews', compact('publishedReviews', 'pendingReviews', 'rejectedReviews'));
    }

    public function adminViewDetails($id)
    {
        $review = Review::findOrFail($id);
        return view('AdminDashboard.review_details', compact('review'));
    }


    public function updateStatus(Request $request, $id)
    {
        $validated = $request->validate([
            'status' => 'required|in:Pending,Published,Rejected',
        ]);

        $review = Review::findOrFail($id);
        $review->update(['status' => $validated['status']]);

        return redirect()->route('adminReviews')->with('success', 'Review status updated successfully.');
    }


    public function destroy(Review $review)
    {
        $orderItemId = $review->order_item_id;

        if ($orderItemId) {
            CustomerOrderItems::where('id', $orderItemId)->update(['reviewed' => 'no']);
        }

        $review->delete();
        return redirect()->back()->with('success', 'Review deleted successfully.');
    }
}
