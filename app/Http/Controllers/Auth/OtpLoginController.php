<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\NotyfyService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class OtpLoginController extends Controller
{

    public function showOtpLoginForm()
    {

        // dd(Session()->all());
        $phoneNumber = Session::get('phone_number');
        // dd($phoneNumber);
        return view('frontend.verify_otp', compact('phoneNumber'));
    }

    public function sendOtp(Request $request)
    {
        $phoneNumber = User::where('email', $request->email)->value('phone');

        // return response()->json(['message' => $phoneNumber]);
        // Generate OTP
        $otp = rand(100000, 999999);

        // Store OTP in session for later comparison
        Session::put('otp', $otp);
        Session::put('phone_number', $phoneNumber);
        Session::put('email', $request->email);
        Session::put('psw', $request->password);
        // Send OTP to the user via Notify.lk API
        $response = Http::post('https://app.notify.lk/api/v1/send', [
            'user_id'   => config('services.notify.user_id'),
            'api_key'   => config('services.notify.api_key'),
            'sender_id' => 'NotifyDEMO',
            'to'        => $phoneNumber,
            'message'   => "Your OTP is $otp",
        ]);

        return redirect()->route('show_otp_form');
        // return response()->json(['message' => $response]);
        // Check if the OTP was sent successfully
        if ($response->successful()) {
            // Log::info("OTP sent successfully to $phoneNumber: $otp");
            // return response()->json(['message' => 'OTP sent successfully']);
            return redirect()->route('show_otp_form');
        } else {
            // return response()->json(['message' => 'Failed to send OTP'], 400);
            // return redirect()->route('show_otp_form');
            return redirect()->route('cus-login')->with(['error' => 'Failed to send OTP']);
        }
    }

    // Method to verify OTP
    public function verifyOtp(Request $request)
    {
        // Validate the OTP input
        // return response()->json(['message' => "verify"]);
        $request->validate([
            'n_1' => 'required|numeric',
            'n_2' => 'required|numeric',
            'n_3' => 'required|numeric',
            'n_4' => 'required|numeric',
            'n_5' => 'required|numeric',
            'n_6' => 'required|numeric',
        ]);
        $otp = $request->n_3 . $request->n_2 . $request->n_3 . $request->n_4 . $request->n_5 . $request->n_6;
        // dd(Session()->all());
        $enteredOtp = $otp;        
        $storedOtp = Session::get('otp');  // Retrieve OTP from session
         // Retrieve OTP from session

        // return response()->json(['message' => $storedOtp == $enteredOtp]);
        // Log::info($storedOtp, $storedPhoneNumber);
        // Check if OTP matches and if the phone number matches
        // dd($enteredOtp == $storedOtp);
        if ($enteredOtp == $storedOtp) {
            return redirect()->route('otp-msg');
            // return response()->json(['message' => 'OTP verified successfully']);
        } else {
            return redirect()->route('cus-login');
            // return response()->json(['message' => 'Invalid OTP'], 400);
        }
    }

    public function finish()
    {
        return view('frontend.complete_otp_verification');
    }
}
