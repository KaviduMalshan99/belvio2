<div id="site-header-wrap">

    <style>
/* Hide mobile-only elements on desktop */
.mobile-only {
    display: none;
}

/* Show mobile-only elements when screen size is below 991px */
@media (max-width: 991px) {
    .mobile-only {
        display: block;
    }
    
    /* Hide icons and show text for mobile */
    .menu-extra .box-login a.icon_login, 
    .menu-extra .box-cart a.icon_heart, 
    .menu-extra .box-cart a.icon_cart {
        display: none;
    }

    .menu-extra .box-login a.icon_login::after {
        content: 'Login'; /* Add text for Login */
    }

    .menu-extra .box-cart a.icon_heart::after {
        content: 'Wishlist'; /* Add text for Wishlist */
    }

    .menu-extra .box-cart a.icon_cart::after {
        content: 'Cart'; /* Add text for Cart */
    }
    
    /* Ensure the text is displayed as a block element */
    .menu-extra li a::after {
        display: block;
    }
}


.mobile-button {
    color: #45cc2d !important; /* Set the main color for the icon */
}

.mobile-button span {
    color: #45cc2d !important; /* Set the main color for the icon inside span */
}


        </style>

    <!-- Header -->
    <header id="header" class="header clearfix" style="z-index: 1040;">
        <div class="container-fluid clearfix container-width-93" id="site-header-inner">
            <div id="logo" class="logo float-left">
                <a href="{{route('home')}}" title="logo">
                <img src="{{ asset('storage/app/public/' . optional($companyDetails)->logo) }}" class="logo" alt="Belvio" width="150" height="30" />

                </a>
            </div><!-- /.logo -->
            <div class="mobile-button" style="color: #45cc2d;"><span></span></div>
            <ul class="menu-extra mobile-only">    

               <!-- Search Icon -->
                <li class="box-search">
                    <a class="icon_search header-search-icon active" href="#"></a>
                    <form role="search" method="get" class="header-search-form" action="{{ route('search.results') }}">
                        <input type="text" value="" name="s" id="search-query" class="header-search-field" placeholder="Search..." autocomplete="off">
                        <button type="submit" class="header-search-submit" title="Search">Search</button>
                    </form>
                    <!-- Suggestions will be displayed here -->
                    <div id="search-suggestions" style="position: absolute; background: white; z-index: 999; width: 100%; display: none;">
                        <!-- Suggestions will appear here -->
                    </div>
                </li>



                <!-- User Login/Profile Icon -->
                @guest
                    <li class="box-login">
                        <!-- If the user is not logged in, redirect to the login page -->
                        <a class="icon_login active" href="{{ route('cus-login') }}"></a>
                    </li>
                @else
                    <li class="box-login">
                        <!-- If the user is logged in, show the profile with the first letter of their name -->
                        <a href="{{ route('viewProfile') }}" class="icon_login nav-cart-trigger active">
                            <span class="fs-2">{{ Auth::user()->name[0] }}</span>
                        </a>
                    </li>
                @endguest

                <!-- Wishlist Icon (Visible to logged-in users only) -->
                @auth
                <li class="box-cart nav-top-cart-wrapper">
                    <a class="icon_heart nav-cart-trigger active" href="{{ route('wishlist') }}">
                        <i class="fa fa-heart-o"></i>
                        <span id="wishlist-count">0</span>
                    </a>
                </li>
                @endauth

                <!-- Cart Icon -->
                <li class="box-cart nav-top-cart-wrapper">
                    <a class="icon_cart nav-cart-trigger active" href="{{ route('cart') }}">
                        <span id="cart-count">0</span>
                    </a>
                </li>
            </ul><!-- /.menu-extra -->

            <div class="nav-wrap">
                <nav id="mainnav" class="mainnav">
                    <ul class="menu">
                        <li class="{{ Route::is('home') ? 'active' : '' }}">
                            <a href="{{ route('home') }}">HOME</a>
                        </li>
                        <li class="{{ Route::is('shop') ? 'active' : '' }}">
                            <a href="{{ route('shop') }}">SHOP</a>
                        </li>
                        <li class="{{ Route::is('blogs') ? 'active' : '' }}">
                            <a href="{{ route('blogs') }}">BLOG</a>
                        </li>
                        <li class="{{ Route::is('aboutus') ? 'active' : '' }}">
                            <a href="{{ route('aboutus') }}">ABOUT US</a>
                        </li>
                        <li class="{{ Route::is('contactus') ? 'active' : '' }}">
                            <a href="{{ route('contactus') }}">CONTACT</a>
                        </li>
                    </ul>
                    

                </nav><!-- /.mainnav -->
            </div><!-- /.nav-wrap -->
        </div><!-- /.container-fluid -->
    </header><!-- /header -->
</div><!-- /.site-header-wrap -->

<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        axios.get('{{ route('cart.count') }}')
            .then(response => {
                const cartCount = response.data.cart_count;
                document.getElementById('cart-count').textContent = cartCount;
            })
            .catch(error => {
                console.error('Error fetching cart count:', error);
            });
    });


    $(document).ready(function() {
    $('#search-query').on('keyup', function() {
        var query = $(this).val();

        if (query.length > 2) {  // Only send request if query is longer than 2 characters
            $.ajax({
                url: '{{ route('search.suggestions') }}',
                method: 'GET',
                data: { query: query },
                success: function(data) {
                    var suggestions = $('#search-suggestions');
                    suggestions.empty();

                    // If no results, show "No results found"
                    if (data.length === 0) {
                        suggestions.append('<p>No results found</p>');
                    } else {
                        data.forEach(function(product) {
                            suggestions.append(`
                                <div class="suggestion-item">
                                    <a href="{{ url('shop_details') }}/${product.product_id}">
                                        ${product.product_name} - ${product.category.category_name}
                                    </a>
                                </div>
                            `);
                        });
                    }

                    suggestions.show();  // Show suggestions div
                }
            });
        } else {
            $('#search-suggestions').hide();  // Hide suggestions if query is empty
        }
    });

    // Close suggestions when clicking outside
    $(document).click(function(event) {
        if (!$(event.target).closest('#search-suggestions, #search-query').length) {
            $('#search-suggestions').hide();
        }
    });
});

</script>
<script>
    var userLoggedIn = @json(Auth::check()); // true or false depending on login status
    var userName = @json(Auth::check() ? Auth::user()->name : ''); // Only set the name if logged in
</script>
