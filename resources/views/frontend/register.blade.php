@extends('frontend.master', ['hideHeader' => true, 'hideFooter' => true])

@section('content')


<div class="container-fluid d-flex align-items-center justify-content-center" style="min-height: 100vh; background: black;">
    <div class="register-form col-md-8" id="register" style="padding: 20px; background: #f9f9f9; border-radius: 12px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
        <div class="form-header" style="text-align: center; margin-bottom: 20px;">
            <img src="/frontendnew/images/Logo.JPG" alt="Belvio Logo" class="belvio-logo" style="width: 120px; margin-bottom: 10px;">
            <h5 style="font-size: 1.5em; font-weight: 600; color: #333;">Create Your Account</h5>
            <p style="font-size: 0.9em; color: #666;">Join Belvio and start shopping with ease!</p>

        </div>
        <form novalidate="" class="comment-form" id="registerform" method="post" action="{{ route('registerStore') }}">
            @csrf
            <div class="row">
                <div class="comment-name col-md-6" style="margin-bottom: 15px;">
                    <label style="display: block; font-size: 0.9em; color: #555;">Full Name*</label>
                    <input type="text" name="fullname" id="fullname" placeholder="Enter your full name" required>
                    @error('fullname')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="comment-email col-md-6" style="margin-bottom: 15px;">
                    <label style="display: block; font-size: 0.9em; color: #555;">Email*</label>
                    <input type="email" name="email" id="email" placeholder="Enter your email address" required>
                    @error('email')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="comment-name col-md-6" style="margin-bottom: 15px;">
                    <label style="display: block; font-size: 0.9em; color: #555;">Mobile Number*</label>
                    <input type="text" name="mobile" id="mobile" placeholder="Enter your mobile number" required>
                    @error('mobile')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="comment-name col-md-6" style="margin-bottom: 15px;">
                    <label style="display: block; font-size: 0.9em; color: #555;">Address*</label>
                    <input type="text" name="address" id="address" placeholder="Enter your address" required>
                    @error('address')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="comment-password col-md-6" style="margin-bottom: 15px;">
                    <label style="display: block; font-size: 0.9em; color: #555;">Password*</label>
                    <input type="password" name="password" id="password" placeholder="Create a password" required>
                    @error('password')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="comment-password col-md-6" style="margin-bottom: 15px;">
                    <label style="display: block; font-size: 0.9em; color: #555;">Confirm Password*</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Confirm your password" required>
                    @error('password_confirmation')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
            </div>


            <p class="comment-form-notify clearfix" style="margin-bottom: 20px; font-size: 0.85em; color: #555;">
                <input type="checkbox" name="check-terms" id="check-terms" required style="margin-right: 8px;">
                I agree to the <a href="#" style="color: #007bff; text-decoration: none;">Terms & Conditions</a>.
            </p>
            <p class="form-submit" style="text-align: center;">
                <button class="comment-submit" style="width: 50%; padding: 12px; cursor: pointer;">Register</button>
            </p>
            <p class="form-footer" style="text-align: center; margin-top: 10px; font-size: 0.9em; color:black">
            Already have an account? <a href="{{ route('cus-login') }}" style="color: green; text-decoration: none;">Login here</a>.
            </p>
        </form>
    </div>

</div>

@endsection
