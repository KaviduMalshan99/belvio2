<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        try {
            // Attempt to authenticate the user
            $request->authenticate();

            // Regenerate session to prevent session fixation attacks
            $request->session()->regenerate();

            // Forget temporary session data
            Session::forget(['email', 'psw', 'phone_number', 'otp']);

            // Redirect to the intended route or fallback to 'home'
            return redirect()->intended(route('home', absolute: false));
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Redirect to the 'cus_login' route with an error message
            return redirect()

                ->route('cus_login')

                ->route('cus-login')

                ->with(['error' => 'Invalid email or password. Please try again.']);
        }
    }


    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
