
<aside class="navbar-aside shadow-sm" id="offcanvas_aside">
            <div class="aside-top" style="padding:0">
                <a href="" class="brand-wrap">
                    <img src="{{ optional($companySettings)->logo ? Storage::url($companySettings->logo) : asset('backend/assets/Logo.JPG') }}" 
                    class="logo" 
                    alt="Belvio" 
                    style="width:250px; margin-left:50%;" />

                </a>

                <div>
                    <button class="btn btn-icon btn-aside-minimize"><i class="text-muted material-icons md-menu_open"></i></button>
                </div>
            </div>
            <nav>
                <ul class="menu-aside">
                    <li class="menu-item {{ request()->routeIs('admin.index') ? 'active' : '' }}">
                        <a class="menu-link" href="{{ route('admin.index') }}">
                            <i class="icon material-icons md-home"></i>
                            <span class="text">Dashboard</span>
                        </a>
                    </li>
                    <li class="menu-item has-submenu {{ request()->is('admin/products*') || request()->is('admin/categories*') ? 'active' : '' }}">
                        <a class="menu-link" href="#">
                            <i class="icon material-icons md-shopping_bag"></i>
                            <span class="text">Products</span>
                        </a>
                        <div class="submenu {{ request()->is('admin/products*') ||  request()->is('admin/categories*') ? 'show' : '' }}">
                            <a href="{{ route('products_list') }}" class="{{ request()->is('admin/products') ? 'active' : '' }}">
                                Product List
                            </a>
                            <a href="{{ route('categories') }}" class="{{ request()->is('admin/categories') ? 'active' : '' }}">
                                Categories
                            </a>
                        </div>
                    </li>
                    <li class="menu-item {{ request()->routeIs('customers') ? 'active' : '' }}">
                        <a class="menu-link" href="{{ route('customers') }}">
                        <i class="icon material-icons md-group"></i>
                            <span class="text">Customers</span>
                        </a>
                    </li>

                    <li class="menu-item {{ request()->routeIs('orders') ? 'active' : '' }}">
                        <a class="menu-link" href="{{ route('orders') }}">
                        <i class="icon material-icons md-shopping_cart"></i>
                            <span class="text">Orders</span>
                        </a>
                    </li>


                    
                    <li class="menu-item {{ request()->routeIs('adminReviews') ? 'active' : '' }}">
                        <a class="menu-link" href="{{ route('adminReviews') }}">

                        <i class="icon material-icons md-comment"></i>
                            <span class="text">Reviews</span>
                        </a>
                    </li>
                
                    <li class="menu-item {{ request()->routeIs('adminReturns') ? 'active' : '' }}">
                        <a class="menu-link" href="{{ route('adminReturns') }}">

                        <i class="icon material-icons md-sync_alt"></i>
                            <span class="text">Returns</span>  
                        </a>
                    </li>
                    <li class="menu-item {{ request()->routeIs('admin.customer.inquiries') ? 'active' : '' }}">
                        <a class="menu-link" href="{{ route('admin.customer.inquiries') }}">
                        <i class="icon material-icons md-email"></i>
                            <span class="text">Customer Inquiries</span>
                        </a>
                    </li>
                    <li class="menu-item {{ request()->routeIs('blog.index') ? 'active' : '' }}">
                        <a class="menu-link" href="{{ route('blog.index') }}">

                        <i class="icon material-icons md-event"></i>
                            <span class="text">Blogs</span>  
                        </a>
                    </li>
                    <li class="menu-item {{ request()->routeIs('promo_codes') ? 'active' : '' }}">
                        <a class="menu-link" href="{{ route('promo_codes') }}">
                        <i class="icon material-icons md-local_offer"></i>
                            <span class="text">Promo Codes</span>  
                        </a>
                    </li>
                    <li class="menu-item has-submenu ">
                        <a class="menu-link" href="#">
                            <i class="icon material-icons md-description"></i>
                            <span class="text">Reports</span>
                        </a>
                        <div class="submenu ">
                            <a href="{{ route('customerReport') }}" >
                                Customers
                            </a>
                            <a href="{{ route('productReport') }}" >
                                Products 
                            </a>
                            <a href="{{ route('orderReport') }}" >
                                Orders 
                            </a>
                        </div>
                    </li>
                    <li class="menu-item has-submenu {{ request()->is('admin/manage_company*') || request()->is('admin/users*') || request()->is('admin/role_list*') ? 'active' : '' }}">
                        <a class="menu-link" href="#">
                            <i class="icon material-icons md-settings"></i>
                            <span class="text">Settings</span>
                        </a>
                        <div class="submenu {{ request()->is('admin/manage_company*') || request()->is('admin/users*') || request()->is('admin/role_list*') ? 'show' : '' }}">
                            <a href="{{ route('manage_company') }}" class="{{ request()->is('admin/manage_company') ? 'active' : '' }}">
                                Manage Company
                            </a>
                            <a href="{{ route('users') }}" class="{{ request()->is('admin/users') ? 'active' : '' }}">
                                Users
                            </a>

                        </div>
                    </li>

                </ul>
                <hr />

                <br />
                <br />
            </nav>
        </aside>