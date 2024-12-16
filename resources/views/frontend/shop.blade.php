@extends('frontend.master')

@section('content')

<style>
    .product-pagination {
        display: flex;
        justify-content: center;
        align-items: center;
        margin-top: 30px;
    }

    .product-pagination .page-link {
        color: black;
        border: 1px solid #63ff66;
        margin: 0 3px;
        transition: background-color 0.3s, color 0.3s;
    }

    .product-pagination .page-link:hover {
        background-color: #63ff66;
        color: #fff;
    }

    .product-pagination .page-item.active .page-link {
        background-color: #63ff66;
        color: black;
        border-color: #63ff66;
    }

    .product-content .product-item {
        position: relative;
    }

    @media (max-width: 600px) {
        .product-content .product {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            align-items: center;
            margin-left: 0;
        }
    }
</style>


<!-- Page title -->
<div class="page-title parallax parallax1">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="page-title-heading">
                    <h1 class="title">Shop</h1>
                </div><!-- /.page-title-heading -->
                <div class="breadcrumbs">
                    <ul>
                        <li><a href="{{route('home')}}">Home</a></li>
                        <li><a href="{{route('shop')}}">Shop</a></li>
                    </ul>
                </div><!-- /.breadcrumbs -->
            </div><!-- /.col-md-12 -->
        </div><!-- /.row -->
    </div><!-- /.container -->
</div><!-- /.page-title -->


<section class="flat-row main-shop shop-slidebar">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="sidebar slidebar-shop">
                    <!-- Search Widget -->
                    <div class="widget widget-search">
                        <form role="search" method="get" class="search-form" action="{{ route('shop') }}">
                            <label>
                                <input type="search" class="search-field" placeholder="Search …" value="{{ request('s') }}" name="s">
                            </label>
                            <input type="submit" class="search-submit" value="Search">
                        </form>
                    </div><!-- /.widget-search -->


                    <!-- Filter by Category -->
                    <div class="widget widget-sort-by">
                        <h5 class="widget-title">Filter by Category</h5>
                        <ul>
                            <li><a href="{{ route('shop')}}">
                                    All Products
                                </a></li>
                            @foreach($categories as $category)
                            <li>
                                <a href="{{ route('shop', ['category' => $category->name]) }}">
                                    {{ $category->name }}
                                </a>
                                @php
                                $sub_catrgories = App\Models\Subcategory::where('category_id',$category->id)->get();
                                @endphp
                                @foreach($sub_catrgories as $sub_category)
                            <li class="px-4">
                                <a href="{{ route('shop.sub_category', ['category_id' => $category->id,'sub_category_id' => $sub_category->id]) }}">
                                    {{ $sub_category->name }}
                                </a>
                            </li>
                            @endforeach
                            </li>
                            @endforeach
                        </ul>
                    </div><!-- /.widget-sort-by -->

                    <!-- Filter by Colors -->
                    @if($products->pluck('variations')->flatten()->where('type', 'color')->isNotEmpty())
                    <div class="widget widget-color">
                        <h5 class="widget-title">Colors</h5>
                        <ul class="flat-color-list icon-left">
                            @foreach($products as $product)
                            @foreach($product->variations as $variation)
                            @if($variation->type == 'color')
                            <li>
                                <a href="{{ route('shop', ['color' => $variation->hex_value]) }}" style="background-color: {{ $variation->hex_value }};">
                                    <span>{{ $variation->value }}</span>
                                </a>
                            </li>
                            @endif
                            @endforeach
                            @endforeach
                        </ul>
                    </div><!-- /.widget-color -->
                    @endif

                    <!-- Filter by Size -->
                    <div class="widget widget-size">
                        <h5 class="widget-title">Size</h5>
                        <form method="GET" action="{{ route('shop') }}">
                            <ul>
                                @foreach(['L', 'M', 'S', 'X', 'XL', 'XXL'] as $size)
                                <li class="checkbox">
                                    <input type="checkbox" name="size[]" value="{{ $size }}" id="checkbox{{ $size }}" {{ in_array($size, request('size', [])) ? 'checked' : '' }}>
                                    <label for="checkbox{{ $size }}"><a href="#">{{ $size }}</a></label>
                                </li>
                                @endforeach
                            </ul>
                        </form>
                    </div><!-- /.widget-size -->


                    <!-- Filter by Price -->
                    <div class="widget widget-price">
                        <h5 class="widget-title">Filter by price</h5>
                        <form method="get" action="{{ route('shop') }}">
                            <div class="price-filter">
                                <div id="slide-range"></div>
                                <p class="amount">
                                    Price: <input type="text" id="amount" disabled="" value="LKR {{ request('price_min', 0) }} - LKR {{ request('price_max', 20000) }}">
                                </p>
                                <input type="hidden" name="price_min" id="price_min" value="{{ request('price_min', 0) }}">
                                <input type="hidden" name="price_max" id="price_max" value="{{ request('price_max', 20000) }}">
                                <button type="submit" class="price-filter-btn">Filter</button>
                            </div>
                        </form>

                    </div><!-- /.widget-price -->

                    <!-- Filter by Tags -->
                    <div class="widget widget_tag">
                        <h5 class="widget-title">Tags</h5>
                        <div class="tag-list">
                            @foreach($tags as $tag)
                            <a href="{{ route('shop', array_merge(request()->query(), ['tags' => array_merge((array) request()->tags, [$tag])])) }}">
                                {{ $tag }}
                            </a>
                            @endforeach
                        </div>
                    </div><!-- /.widget -->

                </div><!-- /.sidebar -->
            </div><!-- /.col-md-3 -->

            <!-- Product Display Section -->
            <div class="col-md-9">
                <div class="filter-shop clearfix">
                    <p class="showing-product float-right">
                        Showing {{ $products->firstItem() }}–{{ $products->lastItem() }} of {{ $products->total() }} Products
                    </p>
                </div><!-- /.filter-shop -->

                <div class="product-content product-threecolumn product-slidebar clearfix">
                    <ul class="product style2 sd1">
                        @foreach ($products as $product)
                        <li class="product-item">
                            <div class="product-thumb clearfix">
                                <a href="{{ route('shop_details', ['product_id' => $product->id]) }}">
                                    <img src="{{ Storage::url(optional($product->images->first())->image_path) }}" alt="image" style="height: 300px; width: auto; object-fit: cover;">
                                </a>
                                @if($product->created_at->diffInDays(now()) < 7)
                                    <span class="new">New</span>
                                    @endif


                                    @if($product->promotions->isNotEmpty()) <!-- Check if there are promotions -->
                                        <span class="discount-badge">
                                            - {{ round($product->promotions->first()->discount) }}% 
                                        </span>

                                        @endif

                            </div>
                            <div class="product-info clearfix">
                                <span class="product-title">{{ $product->product_name }}</span>
                                <div class="price">

                                    @if($product->promotions->isNotEmpty())
                                        <ins>
                                            <span class="amount" style="color:green;">LKR {{ ($product->promotions->first()->discount_price), 2 }}</span> 
                                        </ins>
                                        <del>
                                            <span class="amount" style="color:red; font-weight:300">LKR {{ number_format($product->normal_price, 2) }}</span> 
                                        </del>
                                    @else
                                        <ins>
                                            <span class="amount" style="color:green;">LKR {{ number_format($product->normal_price, 2) }}</span>
                                        </ins>
                                    @endif

                                </div>
                            </div>
                            <div class="add-to-cart text-center">
                                <a href="#"
                                    style="width:100%"
                                    class="add-to-cart text-center add-to-cart-btn"
                                    data-bs-toggle="modal"
                                    data-bs-target="#cartModal_{{ $product->product_id }}"
                                    data-product-id="{{ $product->product_id }}">
                                    Add To Cart <i class="ph ph-shopping-cart"></i>
                                </a>

                            </div>
                            <a href="javascript:void(0);"
                                class="heart-icon like"
                                id="wishlist-icon-{{ $product->product_id }}"
                                data-product-id="{{ $product->product_id }}"
                                onclick="toggleWishlist(this, '{{ $product->product_id }}')">
                                <i class="fa fa-heart-o"></i>
                            </a>

                        </li>
                        <!-- Cart Modal -->
                        <div class="modal fade" id="cartModal_{{ $product->product_id }}" tabindex="-1" aria-labelledby="cartModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                <div class="p-6 modal-content" style="border-radius: 0; z-index: 1050;">
                                    <div class="modal-header">
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body" style="color:black">
                                        <div class="row gx-5">
                                            <aside class="col-lg-5">
                                                <div class="mb-3 rounded-4 d-flex justify-content-center">
                                                    <a class="rounded-4 main-image-link" href="{{ asset('storage/' . $product->images->first()->image_path) }}">
                                                        <img id="mainImage" class="rounded-4 fit" src="{{ asset('storage/' . $product->images->first()->image_path) }}" style="width:250px" />
                                                    </a>
                                                </div>
                                                <div class="mb-3 d-flex justify-content-center">
                                                    @foreach($product->images as $image)
                                                    <a class="mx-1 rounded-2 thumbnail-image" data-image="{{ asset('storage/' . $image->image_path) }}" href="javascript:void(0);">
                                                        <img class="thumbnail rounded-2" src="{{ asset('storage/' . $image->image_path) }}" style="width:80px" />
                                                    </a>

                                                    @endforeach
                                                </div>
                                            </aside>

                                            <main class="col-lg-7">
                                                <h5>{{ $product->product_name }}</h5>
                                                <p class="product-description">{{ $product->product_description }}</p>
                                                <div class="flex-align flex-wrap gap-12 mt-12">
                                                    @if ($product->total_reviews!=0)
                                                    <div class="flex-align gap-12 flex-wrap">
                                                        <div class="flex-align gap-8">
                                                            @php
                                                            $fullStars = floor($product->average_rating); // Number of full stars
                                                            $hasHalfStar = ($product->average_rating - $fullStars) >= 0.5; // Half-star condition
                                                            @endphp
                                                            @for ($i = 0; $i < $fullStars; $i++)
                                                                <span class="text-15 fw-medium text-warning-600 d-flex"><i class="ph-fill ph-star"></i></span>
                                                                @endfor
                                                                @if ($hasHalfStar)
                                                                <span class="text-15 fw-medium text-warning-600 d-flex"><i class="ph-fill ph-star-half"></i></span>
                                                                @endif
                                                        </div>
                                                        <span class="text-sm fw-medium text-neutral-600">{{ number_format($product->average_rating, 1) }} Star Rating</span>
                                                        <span class="text-sm fw-medium text-gray-500">({{ $product->total_reviews }})</span>
                                                    </div>
                                                    @endif
                                                </div>
                                                <hr />

                                                <div class="mt-3 mb-12 product-availability">
                                                    <span>Availability :</span>
                                                    @if($product->quantity > 0)
                                                    <span class="ms-1" style="color:#4caf50;">In stock</span>
                                                    @else
                                                    <span class="ms-1" style="color:red;">Out of stock</span>
                                                    @endif
                                                </div>

                                                <!-- Sizes Section -->
                                                @if ($product->variations->where('type', 'size')->pluck('value')->filter()->unique()->isNotEmpty())
                                                <div class="flex-between align-items-start flex-wrap gap-16">
                                                    <div class="d-flex align-items-center">
                                                        <span class="text-gray-900 me-3">Size:</span>
                                                        @foreach ($product->variations->where('type', 'size')->filter(function($variation) {
                                                        return $variation->quantity > 0; // Only show sizes with quantity greater than 0
                                                        })->pluck('value')->unique() as $size)
                                                        <span
                                                            class="size-button ms-5 d-flex align-items-center justify-content-center"
                                                            data-size="{{ $size }}"
                                                            role="button"
                                                            tabindex="0">
                                                            {{ $size }}
                                                        </span>
                                                        @endforeach
                                                    </div>
                                                </div>
                                                @endif

                                                <!-- Colors Section -->
                                                @if ($product->variations->where('type', 'color')->pluck('hex_value')->filter()->unique()->isNotEmpty())
                                                <div class="flex-between align-items-center flex-wrap gap-16 mt-3">
                                                    <div class="d-flex align-items-center mb-4">
                                                        <span class="text-gray-900 me-3">Color:</span>
                                                        @foreach ($product->variations->where('type', 'color')->filter(function($variation) {
                                                        return $variation->quantity > 0; // Only show colors with quantity greater than 0
                                                        })->pluck('hex_value')->unique() as $color)
                                                        <span
                                                            class="color-button me-2"
                                                            style="background-color: {{ $color }};"
                                                            data-color="{{ $color }}"
                                                            role="button"
                                                            tabindex="0">
                                                        </span>
                                                        @endforeach
                                                    </div>
                                                </div>
                                                @endif


                                                <div class="mb-3 product-price d-flex align-items-center">
                                                    @if($product->promotions->isNotEmpty())
                                                        <h5 class="mb-0" style="">
                                                            <span class="amount" style="color:green;">LKR {{ number_format($product->promotions->first()->discount_price, 2) }}</span> 
                                                        </h5>
                                                        <span style="">&nbsp;</span> 
                                                        <del>
                                                            <span class="amount" style="color:red; font-weight:300;">LKR {{ number_format($product->normal_price, 2) }}</span> 
                                                        </del>
                                                    @else
                                                        <h5>
                                                            <span class="amount" style="color:green;">LKR {{ number_format($product->normal_price, 2) }}</span>
                                                        </h5>
                                                    @endif

                                                </div>

                                                @auth
                                                <!-- Add To Cart Form -->
                                                <form action="{{ route('cart.add') }}" method="POST" id="addToCartForm">
                                                    @csrf
                                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                    <input type="hidden" name="size" id="selectedSize">
                                                    <input type="hidden" name="color" id="selectedColor">
                                                    <input type="hidden" name="quantity" id="hiddenQuantity" value="1">
                                                    <input type="hidden" name="price" id="hiddenPrice" value="{{ $product->normal_price }}">

                                                    <!-- Add To Cart Button -->
                                                    <button type="submit" class="btnw-95" id="addToCartBtn"
                                                        @disabled($product->quantity == 0)>
                                                        Add To Cart
                                                    </button>
                                                </form>

                                                @else
                                                <p class="mb-5 text-danger">Please <a href="{{ route('cus-login') }}">log in</a> to add items to the cart.</p>
                                                @endauth
                                                <a href="{{ route('shop_details', ['product_id' => $product->id]) }}" style="text-decoration: none; font-size:14px; color: #297aa5; margin-top:15px">
                                                    View Full Details<i class="fa-solid fa-circle-right"></i>
                                                </a>
                                            </main>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        @endforeach
                    </ul><!-- /.product -->
                </div><!-- /.product-content -->

                <!-- Pagination -->
                <div class="product-pagination text-center clearfix">
                    {{ $products->links('pagination::bootstrap-4') }}
                </div>
            </div><!-- /.col-md-9 -->
        </div><!-- /.row -->
    </div><!-- /.container -->
</section><!-- /.flat-row -->


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<script>
    // Handle size span click event
    document.querySelectorAll('.size-button').forEach(function(button) {
        button.addEventListener('click', function() {
            // Toggle the 'selected' class to highlight the clicked span
            document.querySelectorAll('.size-button').forEach(btn => btn.classList.remove('selected'));
            this.classList.add('selected');
        });
    });

    // Handle color span click event
    document.querySelectorAll('.color-button').forEach(function(button) {
        button.addEventListener('click', function() {
            // Toggle the 'selected' class to highlight the clicked span
            document.querySelectorAll('.color-button').forEach(btn => btn.classList.remove('selected'));
            this.classList.add('selected');
        });
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        let selectedSize = null;
        let selectedColor = null;

        // Size selection event listener
        document.querySelectorAll('.size-button').forEach(button => {
            button.addEventListener('click', () => {
                document.querySelectorAll('.size-button').forEach(btn => btn.classList.remove('selected'));
                button.classList.add('selected');
                selectedSize = button.getAttribute('data-size');
                document.getElementById('selectedSize').value = selectedSize;
            });
        });

        // Color selection event listener
        document.querySelectorAll('.color-button').forEach(button => {
            button.addEventListener('click', () => {
                document.querySelectorAll('.color-button').forEach(btn => btn.classList.remove('selected'));
                button.classList.add('selected');
                selectedColor = button.getAttribute('data-color').replace('#', '');
                document.getElementById('selectedColor').value = selectedColor;
            });
        });

        // Handle Add to Cart form submission
        document.getElementById('addToCartForm').addEventListener('submit', function(e) {
            // Check if size/color are required and selected
            if ((!selectedSize && document.querySelectorAll('.size-button').length > 0) ||
                (!selectedColor && document.querySelectorAll('.color-button').length > 0)) {
                e.preventDefault();
                Swal.fire({
                    title: 'Warning!',
                    text: 'Please select both a size and a color to proceed.',
                    icon: 'warning',
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true
                });
            }
        });
    });
</script>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Get all product IDs in the similar products section
        const productIds = Array.from(document.querySelectorAll('.heart-icon')).map(icon =>
            icon.getAttribute('data-product-id')
        );

        if (productIds.length === 0) {
            return; // No products to check
        }

        // Fetch wishlist status for all products
        fetch('{{ route('wishlist.checkMultiple') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    },
                    body: JSON.stringify({
                        product_ids: productIds
                    }),
                })
            .then(response => response.json())
            .then(data => {
                if (data.wishlist && Array.isArray(data.wishlist)) {
                    const wishlistProducts = data.wishlist;

                    // Loop through the products and update the heart icons
                    wishlistProducts.forEach(productId => {
                        const heartIcon = document.querySelector(`#wishlist-icon-${productId}`);
                        if (heartIcon) {
                            heartIcon.classList.add('active');
                            const icon = heartIcon.querySelector('i');
                            icon.classList.replace('fa-heart-o', 'fa-heart');
                            icon.style.color = 'red';
                        }
                    });
                } else {
                    console.error('Invalid response format:', data);
                }
            })
            .catch(error => console.error('Error fetching wishlist status:', error));
    });


    function toggleWishlist(button, productId) {
        event.preventDefault();

        // Toggle active state
        button.classList.toggle('active');
        const icon = button.querySelector('i');

        // Change the icon based on the state
        if (button.classList.contains('active')) {
            icon.classList.replace('fa-heart-o', 'fa-heart');
            icon.style.color = 'red';
        } else {
            icon.classList.replace('fa-heart', 'fa-heart-o');
            icon.style.color = '#ccc';
        }

        // Send request to toggle wishlist status
        fetch('/wishlist/toggle', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                },
                body: JSON.stringify({
                    product_id: productId
                }),
            })
            .then(response => response.json())
            .then(data => {
                if (data.error) {
                    alert(data.error);
                } else {
                    alert(data.message);
                }
            })
            .catch(error => console.error('Error:', error));
    }
</script>
<script>
    var flatPrice = function() {
        if ($().slider) {
            $(function() {
                // Initialize the slider with min, max, and initial values
                $("#slide-range").slider({
                    range: true,
                    min: 0,
                    max: 20000,
                    values: [{
                        {
                            request('price_min', 0)
                        }
                    }, {
                        {
                            request('price_max', 20000)
                        }
                    }],
                    slide: function(event, ui) {
                        // Update the text input with selected price range
                        $("#amount").val("Rs " + ui.values[0] + ".00" + " - " + "Rs " + ui.values[1] + ".00");

                        // Update hidden inputs with slider values
                        $("#price_min").val(ui.values[0]);
                        $("#price_max").val(ui.values[1]);
                    }
                });

                // Set the initial value for the text input based on slider values
                $("#amount").val("Rs " + $("#slide-range").slider("values", 0) + ".00" + " - " + "Rs " + $("#slide-range").slider("values", 1) + ".00");

                // Ensure hidden inputs have the initial values when the page loads
                $("#price_min").val($("#slide-range").slider("values", 0));
                $("#price_max").val($("#slide-range").slider("values", 1));
            });
        }
    };

    // Call the function when the document is ready
    $(document).ready(function() {
        flatPrice();
    });
</script>

<script>
    document.querySelectorAll('input[name="size[]"]').forEach(function(checkbox) {
        checkbox.addEventListener('change', function() {
            this.closest('form').submit(); // Submit the form automatically on change
        });
    });
</script>


@endsection