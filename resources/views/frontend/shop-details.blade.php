@extends('frontend.master')

@section('content')
<!-- FlexSlider CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flexslider/2.7.2/flexslider.min.css">

<!-- FlexSlider JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/flexslider/2.7.2/jquery.flexslider-min.js"></script>

<style>
    /* General Button Styles */
.size-button, .color-button {
    cursor: pointer; 
    border: 2px solid #ccc; 
    border-radius: 4px; 
    text-align: center;
    font-size: 14px;
    font-weight: bold;
    background-color: #f8f9fa; 
    color: #333; 
    transition: background-color 0.3s, transform 0.2s;
    margin-left: 5px;
}

.size-button {
    width: 25px; 
    height: 25px;
    padding: 2px 4px; 
}

.color-button {
    width: 20px; 
    height: 20px;
    padding: 2px 4px; 
    border-radius: 50%; 
    border: 2px solid #ccc; 
    display: inline-block;
    cursor: pointer;
    transition: transform 0.2s, box-shadow 0.3s;
}

/* Hover Styles */
.size-button:hover, .color-button:hover {
    background-color: #007bff; 
    color: #fff; 
    border-color: #0056b3; 
    transform: scale(1.05); 
}

/* Active/Selected Styles */
.size-button.selected, .color-button.selected {
    background-color: #0056b3; 
    color: #fff; 
    border-color: #003f7f; 
    transform: scale(1.1); 
}

a.disabled {
        pointer-events: none;
        opacity: 0.6;
        cursor: not-allowed;
    }

    .flexslider {
    margin: 0;
    padding: 0;
    overflow: hidden;
    position: relative;
}

.flexslider .slides {
    list-style: none;
    margin: 0;
    padding: 0;
    display: flex; 
    align-items: center;
}

.flexslider .slides li {
    display: block;
    position: relative;
    height: auto;
}

.flexslider .slides img,
.flexslider .slides video {
    display: block;
    max-width: 100%;
    height: auto;
}

.heart-icon i {
    transition: color 0.3s ease;
}

.heart-icon.active i {
    color: red;
}

.limited-description {
    display: -webkit-box;
    -webkit-line-clamp: 4; 
    -webkit-box-orient: vertical;
    overflow: hidden;
    text-overflow: ellipsis;
    line-height: 1.5; 
    max-height: calc(1.5em * 4); 
}

</style>
<!-- Page title -->
<div class="page-title parallax parallax1">
    		<div class="container">
    			<div class="row">
    				<div class="col-md-12">
    					<div class="page-title-heading">
    						<h1 class="title">{{ $product->product_name }}</h1>
    					</div><!-- /.page-title-heading -->
    					<div class="breadcrumbs">
    						<ul>
    							<li><a href="index.html">Home</a></li>
    							<li><a href="shop-3col.html">Shop</a></li>
                                <li><a href="shop-detail-video.html">Products</a></li> 
    						</ul>                                               
    					</div><!-- /.breadcrumbs -->
    				</div><!-- /.col-md-12 -->
    			</div><!-- /.row -->
    		</div><!-- /.container -->
    	</div><!-- /.page-title -->

<section class="flat-row main-shop shop-detail style-1">
    <div class="container">
        <div class="row">

            <div class="col-md-6">
                <div class="wrap-gallery" style="display: flex;">
                    <!-- Thumbnails (Left, Vertical) -->
                    <div class="thumbnails-slider" style="display: flex; flex-direction: column; overflow-y: auto; gap: 10px; max-height: 400px; margin-right: 10px; width: 90px;">
                        @foreach($product->images as $index => $image)
                            @if($image->video_path)
                                <!-- Video Thumbnail -->
                                <div class="thumbnail" style="cursor: pointer; border: 2px solid #ccc; border-radius: 5px; padding: 2px;">
                                    <video onclick="showMainSlide({{ $index }})" muted style="width: 100%; height: 80px; object-fit: cover;">
                                        <source src="{{ asset('storage/' . $image->video_path) }}" type="video/mp4">
                                    </video>

                                </div>
                            @else
                                <!-- Image Thumbnail -->
                                <div class="thumbnail" style="cursor: pointer; border: 2px solid #ccc; border-radius: 5px; padding: 2px;">
                                    <img onclick="showMainSlide({{ $index }})" src="{{ asset('storage/' . $image->image_path) }}" alt="Thumbnail" style="width: 100%; height: 80px; object-fit: cover;">
                                </div>
                            @endif
                        @endforeach
                    </div>

                    <!-- Main Display -->
                    <div id="main-slider" class="main-display-slider" style="position: relative; width: 100%; height: 500px; overflow: hidden;">
                        @foreach($product->images as $index => $image)
                            @if($image->video_path)
                                <!-- Video Slide -->
                                <div class="main-slide" style="display: {{ $index === 0 ? 'block' : 'none' }}; width: 100%; height: 100%;">
                                    <video controls style="width: 100%; height: 100%; object-fit: cover;">
                                        <source src="{{ asset('storage/' . $image->video_path) }}" type="video/mp4">
                                        Your browser does not support the video tag.
                                    </video>
                                </div>
                            @else
                                <!-- Image Slide -->
                                <div class="main-slide" style="display: {{ $index === 0 ? 'block' : 'none' }}; width: 100%; height: 100%;">
                                    <img src="{{ asset('storage/' . $image->image_path) }}" alt="Image" style="width: 100%; height: 100%; object-fit: cover;">
                                </div>
                            @endif
                        @endforeach

                        <!-- Navigation Arrows -->
                        <button id="prev-main-slide" onclick="changeMainSlide(-1)" style="position: absolute; left: 10px; top: 50%; transform: translateY(-50%); background: rgba(0, 0, 0, 0.5); color: white; border: none; padding: 5px 10px; cursor: pointer; z-index: 10;">‹</button>
                        <button id="next-main-slide" onclick="changeMainSlide(1)" style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); background: rgba(0, 0, 0, 0.5); color: white; border: none; padding: 5px 10px; cursor: pointer; z-index: 10;">›</button>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="divider h0"></div>
                <div class="product-detail">
                    <div class="inner">
                        <div class="content-detail">
                            <h2 class="product-title" style="color:white">{{ $product->product_name }}</h2>
                            <div class="flat-star style-1">
                            @if ($totalReviews!=0)
                                <div class="flex-align gap-12 flex-wrap">
                                    <div class="flex-align gap-8">
                                        @php
                                        $fullStars = floor($averageRating); // Number of full stars
                                        $hasHalfStar = ($averageRating - $fullStars) >= 0.5; // Half-star condition
                                        @endphp
                                        @for ($i = 0; $i < $fullStars; $i++)
                                            <i class="fa fa-star"></i>
                                            @endfor
                                            @if ($hasHalfStar)
                                            <i class="fa fa-star-half-o"></i>
                                            @endif
                                            <span class="text-sm fw-medium text-neutral-600">{{ number_format($averageRating, 1) }} Star Rating</span>
                                            <span class="text-sm fw-medium text-gray-500">({{$totalReviews}})</span>
                                    </div>
                                </div>
                                @endif
                            </div>
                            <p class="limited-description">{{ $product->product_description }}</p>
                            <p>{{ $product->description }}</p> 
                           
                            <div class="price margin-top-24 d-flex align-items-center">
                                @if($product->promotions->isNotEmpty())
                                    <h2 class="mb-0 me-3">
                                        <span class="amount" style="color:white;">LKR {{ number_format($product->promotions->first()->discount_price, 2) }}</span>
                                    </h2>
                                    <span style="">&nbsp;</span> 
                                    <del>
                                        <span class="amount" style="color:red; font-weight:300;">LKR {{ number_format($product->normal_price, 2) }}</span>
                                    </del>
                                @else
                                    <h2>
                                        <span class="amount" style="color:white;">LKR {{ number_format($product->normal_price, 2) }}</span>
                                    </h2>
                                @endif
                            </div>

                            <div class="">
                                <p class="mb-10 text-black">
                                    Availability:
                                    @if ($product->quantity > 0)
                                    <span class="text-success fw-bold">In Stock</span>
                                    @else
                                    <span class="text-danger fw-bold">Pre Order</span>
                                    @endif
                                </p>

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

                            </div>

                            <div class="product-categories margin-top-22">
                                <span>Categories: </span><a href="#">{{ $product->category->name }}</a>
                            </div>
                            <div class="product-tags">
                                <span>Tags: </span><a href="#">{{ $product->tags }}</a>
                            </div>
                            <div class="product-quantity margin-top-35" style="display: flex; align-items: center; gap: 15px;">
                                <!-- Quantity Section -->
                                <div class="quantity">
                                    <input type="number" min="1" max="{{ $product->quantity }}" value="1" 
                                    name="quantity-number" class="quantity-number" id="quantity-input" />
                                </div>

                              <!-- Add to Cart and Buy Now Buttons -->
                                <div class="add-to-cart" style="display: flex; align-items: center; gap: 10px;">
                                    @auth
                                    <form action="{{ route('cart.add') }}" method="POST" id="addToCartForm" style="width: 50%;">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                        <input type="hidden" name="size" id="selectedSize">
                                        <input type="hidden" name="color" id="selectedColor">
                                        <input type="hidden" name="quantity" id="hiddenQuantity" value="1">
                                        <input type="hidden" name="price" id="hiddenPrice" value="{{ $product->normal_price }}">
                                        <button type="submit" 
                                                class="btn text-capitalize" 
                                                style="font-weight:bold;height: 50px; width: 150px; font-size: 16px; border-radius: 4px; color: #fff; border: none; text-align: center;"
                                                id="addToCartBtn">
                                            Add to Cart
                                        </button>
                                    </form>

                                    <a href="{{ route('buyNow.checkout', ['product_id' => $product->id]) }}" 
                                    id="buyNowBtn" 
                                    style="height: 50px; width: 150px; display: flex; align-items: center; justify-content: center; text-transform: capitalize; font-size: 16px; border-radius: 4px; color: #fff; text-decoration: none;">
                                        Buy Now
                                    </a>
                                    @else
                                    <p style="color: red; text-align: center;">Please <a href="{{route('cus-login')}}">log in</a> to add items to the cart.</p>
                                    @endauth
                                </div>


                                <!-- Heart Icon -->
                                    <div class="box-like">
                                        <a href="javascript:void(0);" class="like" 
                                        id="wishlist-icon-{{ $product->product_id }}" 
                                        onclick="toggleWishlist(this, '{{ $product->product_id }}')">
                                            <i class="fa fa-heart-o"></i>
                                        </a>
                                    </div>

                            </div>

                        </div><!-- /.product-detail -->
                    </div>
                </div><!-- /.row -->
            </div><!-- /.container -->
        </section><!-- /.flat-row -->


        <section class="flat-row shop-detail-content">
        	<div class="container">
        		<div class="row">
        			<div class="col-md-12">
        				<div class="flat-tabs style-1 has-border">
        					<div class="inner">
        						<ul class="menu-tab">
        							<li class="active">Description</li>
        							
        							<li>Reviews</li>
        						</ul>
        						<div class="content-tab">
        							<div class="content-inner">
    									<div class="inner max-width-77 padding-top-33 padding-left-7">
                                            <p>{{ $product->product_description }}</p> 
                                        </div>	        								
        							</div><!-- /.content-inner -->
        							<div class="content-inner">
                                        <div class="inner max-width-83 padding-top-33">
                                            <ol class="review-list">
                                                @forelse($reviews as $review)
                                                <li class="review">
                                                    <!-- <div class="thumb">
                                                        <img src="/frontendnew/images/avatar-1.png" alt="Image">
                                                    </div> -->
                                                    <div class="text-wrap">
                                                        <div class="review-meta">
                                                            <h5 class="name" style="color:white;">{{ $review->is_anonymous ? 'Anonymous' : $review->reviewer->name }}</h5>
                                                            <span class="text-gray-800 text-xs">{{ $review->created_at->format('d.m.Y') }}</span>
                                                            <div class="flat-star style-1">
                                                                @for($i = 1; $i <= 5; $i++)
                                                                    @if($i <=floor($review->rating))
                                                                    <i class="fa fa-star"></i>
                                                                    @elseif($i == ceil($review->rating))
                                                                    <i class="fa fa-star-half-o"></i>
                                                                    @else
                                                                    <i class="fa fa-star-o"></i>
                                                                    @endif
                                                                    @endfor
                                                            </div>
                                                        </div>
                                                        <div class="review-text">
                                                            <p>{{ $review->review ?? 'No Text'}}</p>
                                                        </div>
                                                        <!-- Uploaded Images -->
                                                        @if($review->media && count($review->media) > 0)
                                                        <div class="review-images">
                                                            @foreach($review->media as $mediaPath)
                                                            <div style="display: inline-block; position: relative; margin: 5px;">
                                                                <img src="{{ asset('storage/' . $mediaPath) }}" alt="Review Image"
                                                                    style="width: 100px; height: 100px; object-fit: cover; border: 1px solid #ccc;">
                                                            </div>
                                                            @endforeach
                                                        </div>
                                                        @endif
                                                    </div>
                                                </li><!--  /.review    -->
                                                @empty
                                                <p>No reviews available for this product.</p>
                                                @endforelse
                                            </ol><!-- /.review-list -->

                                        </div>
                                    </div><!-- /.content-inner -->
        						</div>
        					</div>
        				</div>
        			</div>
        		</div>
        	</div>
        </section><!-- /.shop-detail-content -->

        <section class="flat-row shop-related">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="title-section margin-bottom-55">
                    <h2 class="title">Related Products</h2>
                </div>

                <div class="product-content product-fourcolumn clearfix">
                    <ul class="product style2" style="display: flex; flex-wrap: wrap; justify-content: space-between;">
                        @foreach($relatedProducts as $relatedProduct)
                            <li class="product-item" style="margin-bottom:70px; width: calc(24% - 5px);">
                                <div class="product-thumb clearfix">
                                    <a href="{{ route('shop_details', $relatedProduct->id) }}">
                                        <img src="{{ asset('storage/' . $relatedProduct->images->first()->image_path) }}" alt="image" style="height: 300px; width: auto; object-fit: cover;">
                                    </a>
                                </div>
                                <div class="product-info clearfix">
                                    <span class="product-title">{{ $relatedProduct->product_name }}</span>
                                    <div class="price">
                                        <ins>
                                            <span class="amount text-black">Rs {{ $relatedProduct->normal_price }}</span>
                                        </ins>
                                    </div>
                                </div>
                               
                                <a href="javascript:void(0);" 
                                    class="heart-icon like" 
                                    id="wishlist-icon-{{ $product->product_id }}" 
                                    data-product-id="{{ $product->product_id }}" 
                                    onclick="toggleWishlist(this, '{{ $product->product_id }}')">
                                        <i class="fa fa-heart-o"></i>
                                    </a>
                            </li>
                       
                    @endforeach
                    </ul><!-- /.product -->
                </div><!-- /.product-content -->
            </div>
        </div><!-- /.row -->
    </div>
</section>


<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Get the stock status from the backend and disable buttons if out of stock
        const stockStatus = @json($product->quantity);
        
        // If the product is out of stock
        if (stockStatus <= 0) {
            // Disable both buttons
            document.getElementById('addToCartBtn').disabled = true;
            document.getElementById('buyNowBtn').style.pointerEvents = 'none';
            document.getElementById('buyNowBtn').style.opacity = '0.5'; // Make the button look disabled
        }
    });
</script>

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

        // Handle "Buy Now" button click
        document.getElementById('buyNowBtn').addEventListener('click', function(e) {
            e.preventDefault();

            // Get the selected size, color, and quantity
            var selectedSize = document.getElementById('selectedSize').value;
            var selectedColor = document.getElementById('selectedColor').value;
            var quantity = document.querySelector('.quantity-number').value;  // Get the selected quantity

            // Check if size/color are selected
            if ((!selectedSize && document.querySelectorAll('.size-button').length > 0) || 
                (!selectedColor && document.querySelectorAll('.color-button').length > 0)) {
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
            } else {
                // Proceed with redirecting to checkout, including size, color, and quantity in the URL
                const url = new URL("{{ url('/buy-now-checkout/' . $product->id) }}");
                url.searchParams.append('selectedSize', selectedSize || '');
                url.searchParams.append('selectedColor', selectedColor || '');
                url.searchParams.append('quantity', quantity || 1);  // Append quantity

                // Redirect to the checkout URL
                window.location.href = url;
            }
        });
    });
</script>




<script>
 document.addEventListener('DOMContentLoaded', function () {
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
        body: JSON.stringify({ product_ids: productIds }),
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
        body: JSON.stringify({ product_id: productId }),
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
    $(document).ready(function() {
        // Handle tab click
        $('.menu-tab li').on('click', function() {
            // Remove active class from all tabs
            $('.menu-tab li').removeClass('active');
            // Add active class to the clicked tab
            $(this).addClass('active');

            // Get the index of the clicked tab
            var tabIndex = $(this).index();

            // Hide all content sections
            $('.content-tab .content-inner').hide();

            // Show the content section corresponding to the clicked tab
            $('.content-tab .content-inner').eq(tabIndex).show();
        });

        // Show the first tab and content by default
        $('.menu-tab li:first').addClass('active');
        $('.content-tab .content-inner:first').show();
    });
</script>
<script>
    $(document).ready(function () {
        $('.flexslider').flexslider({
            animation: "slide", // Use "fade" or "slide"
            controlNav: true,   // Enable/disable navigation dots
            directionNav: true, // Enable/disable next/prev arrows
            slideshow: true,    // Enable/disable autoplay
            smoothHeight: true, // Adjust height dynamically
        });
    });
</script>
<script>
    let currentMainSlide = 0;
    const mainSlides = document.querySelectorAll("#main-slider .main-slide");

    function showMainSlide(index) {
        mainSlides.forEach((slide, i) => {
            slide.style.display = i === index ? "block" : "none";
        });
        currentMainSlide = index;
    }

    function changeMainSlide(step) {
        currentMainSlide += step;

        // Loop around if the index goes out of bounds
        if (currentMainSlide < 0) {
            currentMainSlide = mainSlides.length - 1;
        } else if (currentMainSlide >= mainSlides.length) {
            currentMainSlide = 0;
        }

        showMainSlide(currentMainSlide);
    }
</script>

@endsection