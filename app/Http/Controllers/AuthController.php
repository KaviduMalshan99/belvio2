<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request){
        return view('frontend.auth.login');
    }
    public function register(Request $request){
        return view('frontend.auth.register');
    }
}
