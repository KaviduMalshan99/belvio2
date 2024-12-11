@extends('frontend.master', ['hideHeader' => true, 'hideFooter' => true])

@section('content')


<div class="container-fluid d-flex align-items-center justify-content-center" style="min-height: 100vh; background: black;">
    <div class="register-form col-md-4" id="register" style="padding: 20px; background: #f9f9f9; border-radius: 12px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
        <div class="form-header" style="text-align: center; margin-bottom: 20px;">
            <img src="/frontendnew/images/Logo.JPG" alt="Belvio Logo" class="belvio-logo" style="width: 120px; margin-bottom: 10px;">
            <h5 style="font-size: 1.5em; font-weight: 600; color: #333;">Welcome Back!</h5>
            <p style="font-size: 0.9em; color: #666;">Login to your account to continue shopping.</p>
        </div>
        <form novalidate="" class="comment-form" id="registerform" method="post" action="{{ route('login_store') }}">
            @csrf

            <div class="comment-email" style="margin-bottom: 15px;">
                <label style="display: block; font-size: 0.9em; color: #555;">Email*</label>
                <input type="email" name="email" id="email" placeholder="Enter your email address" required>
            </div>

            <div class="comment-password" style="margin-bottom: 15px;">
                <label style="display: block; font-size: 0.9em; color: #555;">Password*</label>
                <input type="password" name="password" id="password" placeholder="Create a password" required>
            </div>


            <p class="form-submit" style="text-align: center;">
                <button class="comment-submit" style="width: 100%; padding: 12px; cursor: pointer;">LOGIN</button>
            </p>
            <p class="form-footer" style="text-align: center; margin-top: 10px; font-size: 0.9em; color:black">
              Don't have an account? <a href="{{ route('cus-register') }}" style="color: green; text-decoration: none;">Register here</a>.
            </p>
        </form>
    </div>

</div>

@endsection
