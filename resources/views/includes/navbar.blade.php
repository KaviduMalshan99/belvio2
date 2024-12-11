<!-- Boxed -->
<div class="boxed">
        <div id="site-header-wrap">
            <!-- Top Bar -->
            <div id="top-bar">
                <div id="top-bar-inner" class="container-fluid container-width-94">
                    <div class="top-bar-inner-wrap ">
                        <div class="top-bar-left">
                            <ul class="language style2">
                                <li class="active">
                                    <a href="#">ENG</a>
                                </li>
                                <li>
                                    <a href="#">FRA</a>
                                </li>
                                <li>
                                    <a href="#">GER</a>
                                </li>
                            </ul>     
                        </div>
                        <div class="top-bar-content">
                            <span class="content">FREE SHIPPING & FREE RETURNS ON ALL ORDERS</span>
                        </div>
                        <div class="top-bar-nav">
                            <div class="inner">                                                          
                                <span class="money">USD <i class="fa fa-usd"></i></span>
                                <span class="account"><a href="#">My Account <i class="fa fa-user"></i></a></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Top Bar -->
            <!-- Header -->
            <header id="header" class="header clearfix">
                <div class="container-fluid clearfix container-width-93" id="site-header-inner">
                    <div id="logo" class="logo float-left">
                        <a href="index.html" title="logo">
                            <img src="./frontendnew/images/Logo.JPG" alt="belvio" width="107" >
                        </a>
                    </div><!-- /.logo -->
                    <div class="mobile-button"><span></span></div>
                    <ul class="menu-extra">
                        <li class="box-search">
                            <a class="icon_search header-search-icon" href="#"></a>
                            <form role="search" method="get" class="header-search-form" action="#">
                                <input type="text" value="" name="s" class="header-search-field" placeholder="Search...">
                                <button type="submit" class="header-search-submit" title="Search">Search</button>
                            </form>
                        </li>
                        <li class="box-login">
                            <a class="icon_login" href="#"></a>
                        </li>
                        <li class="box-cart nav-top-cart-wrapper">
                            <!-- Cart icon with number of items -->
                            <a class="icon_cart nav-cart-trigger active" href="{{ route('cart') }}">
                                <span>0</span>
                            </a>

                            <!-- Mini-cart content -->
                            <div class="nav-shop-cart">
                                <div class="widget_shopping_cart_content">
                                    <!-- Optional content for mini-cart preview -->
                                </div>
                            </div><!-- /.nav-shop-cart -->
                        </li>

                    </ul><!-- /.menu-extra -->
                    <div class="nav-wrap">
                        <nav id="mainnav" class="mainnav">
                            <ul class="menu">
                                <li class="active">
                                    <a href="{{ route('home') }}">HOME</a>
                                </li>
                                <li>
                                    <a href="shop-3col.html">SHOP</a>
                                </li>
                                <li>
                                    <a href="coming-soon.html">PAGE</a>
                                    <ul class="submenu">                                        
                                        <li><a href="coming-soon.html">Coming Soon</a></li>
                                        <li><a href="404.html"> Error 404</a></li>
                                        <li><a href="faqs.html">FAQs</a></li>
                                    </ul>
                                </li>
                                <li >
                                    <a href="blog-list.html">BLOG</a>
                                    <ul class="submenu">
                                        <li ><a href="blog-list.html">Blog List Full</a></li>
                                        <li><a href="blog-list-1.html">Blog list Slide 1</a></li>
                                        <li><a href="blog-list-2.html">Blog list Slide 2</a></li>
                                        <li><a href="blog-grid.html">Blog Gird Full</a></li>
                                        <li><a href="blog-grid-1.html">Blog Gird Slide</a></li>
                                        <li><a href="blog-detail.html">Blog Details</a></li>
                                    </ul><!-- /.submenu -->
                                </li>
                                <li>
                                    <a href="contact.html">CONTACT</a>
                                    <ul class="submenu right-submenu">
                                        <li><a href="contact.html">Contact Style 1</a></li>
                                        <li><a href="contact-v2.html">Contact Style 2</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </nav><!-- /.mainnav -->
                    </div><!-- /.nav-wrap -->
                </div><!-- /.container-fluid -->
            </header><!-- /header -->
        </div><!-- /.site-header-wrap -->