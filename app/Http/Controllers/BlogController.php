<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::paginate(10);
        return view('AdminDashboard.blogs', compact('blogs'));
    }

    public function create()
    {
        return view('AdminDashboard.add_blog');
    }


    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'blog_title' => 'required|string|max:255',
            'blog_text' => 'required|string',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'videos.*' => 'nullable|mimes:mp4,mov,ogg,qt|max:10000',
        ]);

        $media = [
            'images' => [],
            'videos' => [],
        ];

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imagePath = $image->store('blogs/images', 'public');
                $media['images'][] = $imagePath;
            }
        }

        if ($request->hasFile('videos')) {
            foreach ($request->file('videos') as $video) {
                $videoPath = $video->store('blogs/videos', 'public');
                $media['videos'][] = $videoPath;
            }
        }

        $blog = new Blog();
        $blog->title = $request->blog_title;
        $blog->text = $request->blog_text;
        $blog->media = json_encode($media);
        $blog->status = 'Active';
        $blog->save();

        return redirect()->route('blog.index')->with('success', 'Blog added successfully!');
    }

    public function edit($id)
    {
        $blog = Blog::findOrFail($id);
        $blog->media = json_decode($blog->media, true); // Decode JSON to array for usage in the view
        return view('AdminDashboard.edit_blog', compact('blog'));
    }




    public function update(Request $request, $id)
    {
        $blog = Blog::findOrFail($id);

        // Validate input
        $validatedData = $request->validate([
            'blog_title' => 'required|string|max:255',
            'blog_text' => 'required|string',
            'status' => 'required|in:Active,Inactive',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'videos.*' => 'nullable|mimes:mp4,mov,ogg,qt|max:10000',
            'delete_images' => 'nullable|array',
            'delete_videos' => 'nullable|array',
        ]);

        $media = $blog->media ? json_decode($blog->media, true) : ['images' => [], 'videos' => []];

        // Handle deletion of selected images
        if ($request->filled('delete_images')) {
            foreach ($request->delete_images as $image) {
                if (($key = array_search($image, $media['images'])) !== false) {
                    unset($media['images'][$key]);
                    Storage::disk('public')->delete($image); // Delete from storage
                }
            }
        }

        // Handle deletion of selected videos
        if ($request->filled('delete_videos')) {
            foreach ($request->delete_videos as $video) {
                if (($key = array_search($video, $media['videos'])) !== false) {
                    unset($media['videos'][$key]);
                    Storage::disk('public')->delete($video); // Delete from storage
                }
            }
        }

        // Handle new image uploads
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imagePath = $image->store('blogs/images', 'public');
                $media['images'][] = $imagePath;
            }
        }

        // Handle new video uploads
        if ($request->hasFile('videos')) {
            foreach ($request->file('videos') as $video) {
                $videoPath = $video->store('blogs/videos', 'public');
                $media['videos'][] = $videoPath;
            }
        }

        // Update blog data
        $blog->title = $request->blog_title;
        $blog->text = $request->blog_text;
        $blog->media = json_encode($media);
        $blog->status = $request->status;
        $blog->save();

        return redirect()->route('blog.index')->with('success', 'Blog updated successfully!');
    }


    public function destroy($id)
    {
        $blog = Blog::findOrFail($id);
        $blog->delete();
        return redirect()->route('blog.index')->with('success', 'Blog deleted successfully!');
    }






    //customer side

    public function viewBlogs()
    {
        $blogs = Blog::where('status', 'Active')->paginate(6);
        $blogs->each(function ($blog) {
            $blog->media = json_decode($blog->media, true);
        });
        return view('frontend.blogs', compact('blogs'));
    }

    public function viewBlogDetails($id){
        $blog = Blog::findOrFail($id);
        $blog->media = json_decode($blog->media, true); 
        return view('frontend.blog_details', compact('blog'));
    }

}
