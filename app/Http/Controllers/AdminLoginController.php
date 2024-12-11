<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\SystemUser; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminLoginController extends Controller
{
    public function showLoginForm()
    {
        return view('AdminDashboard.admin_login'); 
    }


    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);
    
        $hardcodedAdminEmail = 'admin@example.com';
        $hardcodedAdminPassword = 'password123'; 
    
        $admin = \App\Models\SystemUser::where('email', $request->email)
            ->where('role', 'Admin') 
            ->first();
    
        if ($admin && password_verify($request->password, $admin->password)) {
            session([
                'is_admin' => true, 
                'name' => $admin->name, 
                'email' => $admin->email,
                'image' => $admin->image, 
            ]);
            return redirect()->route('admin.index');
        }
    
        if ($request->email === $hardcodedAdminEmail && $request->password === $hardcodedAdminPassword) {
            session([
                'is_admin' => true, 
                'name' => 'Admin', 
                'email' => $hardcodedAdminEmail,
                'image' => null, 
            ]);

            session()->flash('success', 'Successfully logged in as Admin.');
            return redirect()->route('admin.index'); 
        }
    
        return back()->withErrors(['email' => 'Invalid credentials.'])->withInput();
    }
    




    public function logout(Request $request)
    {

        $request->session()->flush();
        return redirect()->route('admin.login')->with('success', 'Logged out successfully.');
    }


}
