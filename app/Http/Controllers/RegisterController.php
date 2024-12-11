<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function store(Request $request)
    {
        // Validate the form input
        $validatedData = $request->validate([
            'fullname' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'mobile' => 'required',
            'address' => 'required|string|max:255',    
            'password' => 'required|string|min:8|confirmed', 
        ]);

        // Create a new user
        $user = User::create([
            'name' => $validatedData['fullname'],
            'email' => $validatedData['email'],
            'phone' => $validatedData['mobile'],
            'address' => $validatedData['address'],
            'password' => Hash::make($validatedData['password']), 
        ]);

        // auth()->login($user);

        return redirect()->route('cus-login')->with('success', 'Registration successful! Welcome to Belvio.');
    }

}
