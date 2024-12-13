<!DOCTYPE html>
<!--[if IE 8 ]><html class="ie" xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US"><!--<![endif]-->

<head>
    <!-- Basic Page Needs -->
    <meta charset="utf-8">
    <!--[if IE]><meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'><![endif]-->
    <title>Belvio</title>

    <meta name="author" content="themesflat.com">

    <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    
    <!-- Bootstrap -->
    <link rel="stylesheet" type="text/css" href="{{ asset('frontendnew/stylesheets/bootstrap.css') }}">

    <!-- Theme Style -->
    <link rel="stylesheet" type="text/css" href="{{ asset('frontendnew/stylesheets/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontendnew/stylesheets/responsive.css') }}">

    <!-- Colors -->
    <link rel="stylesheet" type="text/css" href="{{ asset('frontendnew/stylesheets/colors/color1.css') }}" id="colors">

    <!-- Animation Style -->
    <link rel="stylesheet" type="text/css" href="{{ asset('frontendnew/stylesheets/animate.css') }}">
   
    @php
    $companyDetails = app(\App\Http\Controllers\CompanySettingsController::class)->getCompanyDetails();
    @endphp

    <!-- Favicon and touch icons  -->
    <link href="{{ asset('images/logo1.jpg') }}" rel="shortcut icon">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <!--[if lt IE 9]>
        <script src="javascript/html5shiv.js"></script>
        <script src="javascript/respond.min.js"></script>
    <![endif]-->
</head>

<body class="header_sticky header-style-2 topbar-style-2 topbar-width-94 topbar-divider has-menu-extra">
    <!-- Preloader
    <div id="loading-overlay">
        <div class="loader"></div>
    </div> -->

    <!-- Boxed -->
    <div class="boxed">
        @unless(isset($hideHeader) && $hideHeader)
        @include('frontend.header') <!-- Header is included only if $hideHeader is not set -->
        @endunless


        @yield('content')



        @unless(isset($hideFooter) && $hideFooter)
        @include('frontend.footer') <!-- Footer is included only if $hideFooter is not set -->
        @endunless

        <!-- Go Top -->
        <a class="go-top">
            <i class="fa fa-chevron-up"></i>
        </a>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                @if(session('success'))
                Swal.fire({
                    title: 'Success!',
                    text: "{{ session('success') }}",
                    icon: 'success',
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer);
                        toast.addEventListener('mouseleave', Swal.resumeTimer);
                    }
                });
                @endif

                @if(session('error'))
                Swal.fire({
                    title: 'Error!',
                    text: "{{ session('error') }}",
                    icon: 'error',
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer);
                        toast.addEventListener('mouseleave', Swal.resumeTimer);
                    }
                });
                @endif
            });
        </script>
<script>
    $(document).ready(function() {
        $.get("{{ route('wishlist.count') }}", function(data) {
            if (data.wishlist_count !== undefined) {
                $('#wishlist-count').text(data.wishlist_count);
            }
        }).fail(function() {
            console.error('Failed to fetch wishlist count');
        });
    });
</script>
    </div>

   <!-- Javascript -->
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
   <script src="{{ asset('frontendnew/javascript/jquery.min.js') }}"></script>
    <script src="{{ asset('frontendnew/javascript/tether.min.js') }}"></script>
    <script src="{{ asset('frontendnew/javascript/bootstrap.min.js') }}"></script>
    <script src="{{ asset('frontendnew/javascript/jquery.easing.js') }}"></script>
    <script src="{{ asset('frontendnew/javascript/parallax.js') }}"></script>
    <script src="{{ asset('frontendnew/javascript/jquery-waypoints.js') }}"></script>
    <script src="{{ asset('frontendnew/javascript/jquery-countTo.js') }}"></script>
    <script src="{{ asset('frontendnew/javascript/jquery.countdown.js') }}"></script>
    <script src="{{ asset('frontendnew/javascript/jquery.flexslider-min.js') }}"></script>
    <script src="{{ asset('frontendnew/javascript/images-loaded.js') }}"></script>
    <script src="{{ asset('frontendnew/javascript/jquery.isotope.min.js') }}"></script>
    <script src="{{ asset('frontendnew/javascript/magnific.popup.min.js') }}"></script>
    <script src="{{ asset('frontendnew/javascript/jquery.hoverdir.js') }}"></script>
    <script src="{{ asset('frontendnew/javascript/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('frontendnew/javascript/equalize.min.js') }}"></script>
    <script src="{{ asset('frontendnew/javascript/gmap3.min.js') }}"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAIEU6OT3xqCksCetQeNLIPps6-AYrhq-s&region=GB"></script>
    <script src="{{ asset('frontendnew/javascript/jquery-ui.js') }}"></script>
    
    <script src="{{ asset('frontendnew/javascript/jquery.cookie.js') }}"></script>
    <script src="{{ asset('frontendnew/javascript/main.js') }}"></script>

    <!-- Revolution Slider -->
    <script src="{{ asset('frontendnew/rev-slider/js/jquery.themepunch.tools.min.js') }}"></script>
    <script src="{{ asset('frontendnew/rev-slider/js/jquery.themepunch.revolution.min.js') }}"></script>
    <script src="{{ asset('frontendnew/javascript/rev-slider.js') }}"></script>

    <!-- Load Extensions only on Local File Systems ! The following part can be removed on Server for On Demand Loading -->
    <script src="{{ asset('frontendnew/rev-slider/js/extensions/revolution.extension.actions.min.js') }}"></script>
    <script src="{{ asset('frontendnew/rev-slider/js/extensions/revolution.extension.carousel.min.js') }}"></script>
    <script src="{{ asset('frontendnew/rev-slider/js/extensions/revolution.extension.kenburn.min.js') }}"></script>
    <script src="{{ asset('frontendnew/rev-slider/js/extensions/revolution.extension.layeranimation.min.js') }}"></script>
    <script src="{{ asset('frontendnew/rev-slider/js/extensions/revolution.extension.migration.min.js') }}"></script>
    <script src="{{ asset('frontendnew/rev-slider/js/extensions/revolution.extension.navigation.min.js') }}"></script>
    <script src="{{ asset('frontendnew/rev-slider/js/extensions/revolution.extension.parallax.min.js') }}"></script>
    <script src="{{ asset('frontendnew/rev-slider/js/extensions/revolution.extension.slideanims.min.js') }}"></script>
    <script src="{{ asset('frontendnew/rev-slider/js/extensions/revolution.extension.video.min.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
    $(document).ready(function() {
        $.get("{{ route('wishlist.count') }}", function(data) {
            if (data.wishlist_count !== undefined) {
                $('#wishlist-count').text(data.wishlist_count);
            }
        }).fail(function() {
            console.error('Failed to fetch wishlist count');
        });
    });
</script>

</body>

</html> 