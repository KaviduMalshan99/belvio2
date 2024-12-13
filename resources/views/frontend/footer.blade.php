<!-- Footer -->
<footer class="footer" style="background-color: #000; color: #fff; padding: 20px 0;">
    <hr style="background-color:white" />
    <div class="container">
        <div class="row" style="text-align: left;">
            <div class="col-sm-6 col-md-3" style="text-align: left;">
                <div class="widget widget-link">
                    <h5 style="color: #fff; margin-bottom: 15px;">Quick Links</h5>
                    <ul>
                        <li>• <a href="{{route('home')}}">Home</a></li>
                        <li>• <a href="{{route('aboutus')}}">About Us</a></li>
                        <li>• <a href="{{route('shop')}}">Online Store</a></li>
                        <li>• <a href="{{route('contactus')}}">Contact Us</a></li>
                    </ul>
                </div><!-- /.widget -->
            </div><!-- /.col-md-3 -->
            <div class="col-sm-6 col-md-3" style="text-align: left;">
                <div class="widget widget-link link-login">
                    <h5 style="color: #fff; margin-bottom: 15px;">Account</h5>
                    <ul>
                        <li>• <a href="{{route('cus-login')}}">Login/ Register</a></li>
                        <li>• <a href="{{route('cart')}}">Your Cart</a></li>
                        <li>• <a href="{{route('wishlist')}}">Wishlist items</a></li>
                        <li>• <a href="{{route('viewProfile')}}">Your profile</a></li>
                    </ul>
                </div><!-- /.widget -->
            </div><!-- /.col-md-3 -->
            <div class="col-sm-6 col-md-3" style="text-align: left;">
                <div class="widget widget-link link-faq">
                    <h5 style="color: #fff; margin-bottom: 15px;">Help & Policies</h5>
                    <ul>
                        <li>• <a href="{{route('faq')}}">FAQs</a></li>
                        <li>• <a href="{{route('term-ofservice')}}"> Term of service</a></li>
                        <li>• <a href="{{route('privacy-policy')}}">Privacy Policy</a></li>
                        <li>• <a href="{{route('returns')}}">Returns</a></li>
                    </ul>
                </div><!-- /.widget -->
            </div><!-- /.col-md-3 -->
            <div class="col-sm-6 col-md-3" style="text-align: left;">
                <div class="widget widget-brand">
                    <div class="logo logo-footer">
                             <img src="{{ asset('storage/app/public/' . optional($companyDetails)->logo) }}" class="logo" alt="Belvio" width="150" height="30" />
                    </div>
                    <ul class="flat-contact">
                        <li class="address">{{$companyDetails->address ?? 'No Address'}}</li>
                        <li class="phone">{{$companyDetails->contact ?? 'No Contact'}}</li>
                        <li class="email">{{$companyDetails->email ?? 'No Email'}}</li>
                    </ul><!-- /.flat-contact -->
                    <div class="row">
            <!-- Social Media Icons Section -->
            <div class="col-12 " style="margin-top: 20px;">
                <div class="social-icons">
                    <a href="https://www.facebook.com/profile.php?id=61565733800311&mibextid=LQQJ4d" target="_blank" style="margin-right: 10px;">
                        <img src="{{ asset('images/facebook.png') }}" alt="Facebook" width="20" height="20">
                    </a>
                    <a href="https://instagram.com/belvio_looks" target="_blank" style="margin-right: 10px;">
                        <img src="{{ asset('images/insta.png') }}" alt="Instagram" width="20" height="20">
                    </a>
                    <a href="https://tiktok.com/@_belvio_" target="_blank" style="margin-right: 10px;">
                        <img src="{{ asset('images/tik.png') }}" alt="tiktok" width="20" height="20">
                    </a>
                    <a href="https://www.youtube.com/@belvioclothing" target="_blank" style="margin-right: 10px;">
                        <img src="{{ asset('images/youtube.png') }}" alt="youtube" width="20" height="20">
                    </a>
                    <a href="https://api.whatsapp.com/send?phone=94707029600" target="_blank">
                        <img src="{{ asset('images/whatsapp.png') }}" alt="whatsapp" width="20" height="20">
                    </a>
                </div>
            </div>
        </div><!-- /.row -->
                </div><!-- /.widget -->
            </div><!-- /.col-md-3 -->
        </div><!-- /.row -->
       
    </div><!-- /.container -->
</footer><!-- /.footer -->

<div class="footer-bottom" style="background-color: #111; padding: 10px 0; text-align: center;">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <p class="text-center copyright" style="color: #fff;">
                    <script>document.write(new Date().getFullYear());</script> 
                    @ <a href="https://esupport.live/" style=" text-decoration: none;">eSupport Technologies</a> All rights reserved
                </p>
            </div>
        </div>
    </div>
</div>

<!-- Media Query for Mobile Devices -->
<style>
    @media (max-width: 767px) {
        .footer .row {
            text-align: center !important;
        }
        .footer .col-sm-6 {
            text-align: center !important;
        }
        .social-icons {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-top: 10px;
        }
        .social-icons img {
            width: 35px;
            height: 35px;
        }
    }
    
    /* General hover effect for all text on the page */
li:hover,
li:hover * {
    color: #45cc2d !important; /* Replace #45cc2d with your desired hover color */
}





</style>
