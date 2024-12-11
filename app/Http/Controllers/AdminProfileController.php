<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\SystemUser;
use Illuminate\Support\Facades\Hash;


class AdminProfileController extends Controller
{

    public function showProfile()
    {
        $admin = SystemUser::where('email', session('email'))->first(); 
        if (!$admin) {
            return redirect()->route('admin.login')->withErrors(['error' => 'Admin not found.']);
        }
        return view('AdminDashboard.profile', compact('admin'));
    }
    
    

    public function updateProfile(Request $request)
    {
        $admin = SystemUser::where('email', session('email'))->first();

        if (!$admin) {
            return redirect()->route('admin.login')->withErrors(['error' => 'Admin not found.']);
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:system_users,email,' . $admin->id,
            'contact' => 'required|string|max:15',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->contact = $request->contact;

        // Handle image upload
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('user_images', $fileName, 'public'); 
            $admin->image = $fileName;
        } else {
            $admin->image = $admin->image ?? 'default-user.png';
        }

        $admin->save();

        // Update session with new profile image and name
        session(['name' => $admin->name]);
        session(['image' => $admin->image]);

        return redirect()->route('profile')->with('success', 'Profile updated successfully.');
    }

    



    public function updatePassword(Request $request)
    {
        $admin = SystemUser::where('email', session('email'))->first();
    
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:6|confirmed',
        ]);
    
        if (!$admin) {
            return redirect()->route('admin.login')->withErrors(['error' => 'Admin not found.']);
        }
    
        if (!Hash::check($request->current_password, $admin->password)) {
            return back()->withErrors(['current_password' => 'Current password is incorrect.']);
        }
    
            $newHashedPassword = Hash::make($request->new_password);
    
            $admin->password = $newHashedPassword;
            $admin->save();
    
            return redirect()->route('profile')->with('success', 'Password updated successfully.');
    }
    
    
}
