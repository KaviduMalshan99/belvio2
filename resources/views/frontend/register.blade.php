@extends('frontend.master', ['hideHeader' => true, 'hideFooter' => true])

@section('content')
<!-- Include FontAwesome CSS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">


<div class="container-fluid d-flex align-items-center justify-content-center" style="min-height: 100vh; background: black;">
    <div class="register-form col-md-8" id="register" style="padding: 20px; background: #f9f9f9; border-radius: 12px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
        <div class="form-header" style="text-align: center; margin-bottom: 20px;">
            <img src="/frontendnew/images/Logo.jpg" alt="Belvio Logo" class="belvio-logo" style="width: 120px; margin-bottom: 10px;">
            <h5 style="font-size: 1.5em; font-weight: 600; color: #333;">Create Your Account</h5>
            <p style="font-size: 0.9em; color: #666;">Join Belvio and start shopping with ease!</p>

        </div>
        <form novalidate="" class="comment-form" id="registerform" method="post" action="{{ route('registerStore') }}">
            @csrf
            <div class="row">
                <div class="comment-name col-md-6" style="margin-bottom: 15px;">
                    <label style="display: block; font-size: 0.9em; color: #555;">Full Name*</label>
                    <input type="text" name="fullname" id="fullname" style="color: #333;" placeholder="Enter your full name" required>
                    @error('fullname')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="comment-email col-md-6" style="margin-bottom: 15px;">
                    <label style="display: block; font-size: 0.9em; color: #555;">Email*</label>
                    <input type="email" name="email" id="email" style="color: #333;" placeholder="Enter your email address" required>
                    @error('email')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="comment-name col-md-6" style="margin-bottom: 15px;">
                    <label style="display: block; font-size: 0.9em; color: #555;">Mobile Number*(Enter Mobile Number with Country Code without + sign)</label>
                    <input type="text" name="mobile" id="mobile" style="color: #333;" placeholder="Enter your mobile number" required>
                    @error('mobile')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="comment-name col-md-6" style="margin-bottom: 15px;">
                    <label style="display: block; font-size: 0.9em; color: #555;">Address*</label>
                    <input type="text" name="address" id="address" style="color: #333;" placeholder="Enter your address" required>
                    @error('address')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="comment-password col-md-6" style="margin-bottom: 15px;">
                    <label style="display: block; font-size: 0.9em; color: #555;">Password*</label>
                    <div style="position: relative;">
                        <input type="password" name="password" id="password" style="color: #333; width: 100%; padding-right: 2.5rem;" placeholder="Create a password" required>
                        <span id="togglePassword" style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); cursor: pointer; color: #555;">
                            <i class="fas fa-eye"></i>
                        </span>
                    </div>
                    @error('password')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>

                <div class="comment-password col-md-6" style="margin-bottom: 15px;">
                    <label style="display: block; font-size: 0.9em; color: #555;">Confirm Password*</label>
                    <div style="position: relative;">
                        <input type="password" name="password_confirmation" id="password_confirmation" style="color: #333; width: 100%; padding-right: 2.5rem;" placeholder="Confirm your password" required>
                        <span id="togglePasswordConfirm" style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); cursor: pointer; color: #555;">
                            <i class="fas fa-eye"></i>
                        </span>
                    </div>
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
                Already have an account? <a href="{{ route('cus-login') }}" style="color: #ff4d00; text-decoration: none;">Login here</a>.
            </p>
        </form>
    </div>

</div>


<script>
    // Password toggle for the main password field
    const togglePassword = document.querySelector('#togglePassword');
    const passwordInput = document.querySelector('#password');

    togglePassword.addEventListener('click', function() {
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);
        this.querySelector('i').classList.toggle('fa-eye');
        this.querySelector('i').classList.toggle('fa-eye-slash');
    });

    // Password toggle for the confirm password field
    const togglePasswordConfirm = document.querySelector('#togglePasswordConfirm');
    const confirmPasswordInput = document.querySelector('#password_confirmation');

    togglePasswordConfirm.addEventListener('click', function() {
        const type = confirmPasswordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        confirmPasswordInput.setAttribute('type', type);
        this.querySelector('i').classList.toggle('fa-eye');
        this.querySelector('i').classList.toggle('fa-eye-slash');
    });
</script>

@endsection