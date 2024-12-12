<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckOtpVerified
{
    public function handle(Request $request, Closure $next)
    {
        // Check if OTP is verified in the session
        if (!$request->session()->get('otp_verified', false)) {
            // If OTP is not verified, log the user out
            Auth::logout();
            return redirect()->route('login')->with('message', 'You need to log in again to verify OTP.');
        }

        return $next($request);
    }
}

