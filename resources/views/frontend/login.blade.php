@extends('frontend.master', ['hideHeader' => true, 'hideFooter' => true])

@section('content')
<!-- Include FontAwesome CSS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">


<div class="container-fluid d-flex align-items-center justify-content-center" style="min-height: 100vh; background: black;">
    <div class="register-form col-md-4" id="register" style="padding: 20px; background: #f9f9f9; border-radius: 12px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
        <div class="form-header" style="text-align: center; margin-bottom: 20px;">
            <img src="/frontendnew/images/Logo.jpg" alt="Belvio Logo" class="belvio-logo" style="width: 120px; margin-bottom: 10px;">
            <h5 style="font-size: 1.5em; font-weight: 600; color: #333;">Welcome Back!</h5>
            <p style="font-size: 0.9em; color: #666;">Login to your account to continue shopping.</p>
        </div>
        <form class="comment-form" id="registerform" method="post" action="{{ route('send-otp') }}">
            @csrf

            <div class="comment-email" style="margin-bottom: 15px;">
                <label style="display: block; font-size: 0.9em; color: #555;">Email*</label>
                <input type="email" name="email" id="email" style="color: #333;" placeholder="Enter your email address" required>
            </div>
            
            <div class="comment-password">
                <label style="display: block; font-size: 0.9em; color: #555;">Password*</label>
                <div style="position: relative; display: flex; align-items: center;">
                    <input type="password" name="password" id="password" style="color: #333; width: 100%; padding-right: 2.5rem;" placeholder="Create a password" required>
                    <span id="togglePassword" style="position: absolute; right: 10px; cursor: pointer; color: #555;">
                        <i class="fas fa-eye"></i>
                    </span>
                </div>
            </div>

            <p class="form-footer" style="font-size: 0.9em; color:black; margin-bottom: 15px;">
                Forgot Password? <a href="{{ route('password.request') }}" style="color: #ff4d00; text-decoration: none;">Reset Password</a>.
            </p>

            <p class="form-submit" style="text-align: center;">
                <button type="submit" style="width: 100%; padding: 12px; cursor: pointer;">LOGIN</button>
            </p>
            <p class="form-footer" style="text-align: center; margin-top: 10px; font-size: 0.9em; color:black">
                Don't have an account? <a href="{{ route('cus-register') }}" style="color: #ff4d00; text-decoration: none;">Register here</a>.
            </p>
        </form>
    </div>

</div>

<script>
    // JavaScript to toggle password visibility
    const togglePassword = document.querySelector('#togglePassword');
    const passwordInput = document.querySelector('#password');

    togglePassword.addEventListener('click', function() {
        // Toggle the type attribute
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);

        // Toggle the icon class
        const icon = this.querySelector('i');
        icon.classList.toggle('fa-eye');
        icon.classList.toggle('fa-eye-slash');
    });
</script>

@endsection