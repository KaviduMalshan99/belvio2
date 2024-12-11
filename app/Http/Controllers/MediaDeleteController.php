<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductImage;
use Illuminate\Support\Facades\Storage;

class MediaDeleteController extends Controller
{
    public function deleteMedia(Request $request)
    {
        // Validate the request
        $request->validate([
            'mediaId' => 'required|numeric',
            'mediaType' => 'required|in:image,video',
        ]);

        $mediaId = $request->input('mediaId');
        $mediaType = $request->input('mediaType');

        $media = null;

        // Check for image deletion
        if ($mediaType == 'image') {
            $media = ProductImage::find($mediaId);
            if ($media && $media->image_path) {
                // Delete the image file from storage
                Storage::disk('public')->delete('product_images/' . $media->image_path);
                // Delete the media record from the database
                $media->delete();

                return redirect()->back()->with('success', 'Image deleted successfully!');
            }
        }
        // Check for video deletion
        elseif ($mediaType == 'video') {
            $media = ProductImage::find($mediaId);
            if ($media && $media->video_path) {
                Storage::disk('public')->delete('product_videos/' . $media->video_path);
                // Delete the media record from the database
                $media->delete();

                return redirect()->back()->with('success', 'Video deleted successfully!');
            }
        }

        return redirect()->back()->with('error', 'Media not found.');
    }
}
