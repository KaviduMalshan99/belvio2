@extends ('frontend.master')

@section('content')
<style>
    .color-circle {
        display: inline-block;
        width: 16px;
        height: 16px;
        border-radius: 50%;
        margin-left: 4px;
        vertical-align: middle;
        border: 1px solid #ccc;
    }

    /* Cart Sidebar Styling */
    .cart-sidebar {
        background-color: #f9f9f9;
        border: 1px solid #ddd;
        border-radius: 8px;
        padding: 24px;
    }

    /* Header Styling */
    .cart-totals-header {
        font-size: 18px;
        font-weight: bold;
        color: #333;
        margin-bottom: 24px;
    }

    /* Cart Summary Labels and Values */
    .cart-summary-label {
        font-size: 14px;
        color: #333;
    }

    .cart-summary-value {
        font-size: 14px;
        color: #555;
    }

    .cart-summary-value.fw-semibold {
        font-weight: bold;
    }

    /* Total Section Styling */
    .cart-total-label {
        font-size: 18px;
        font-weight: bold;
    }

    .cart-total-value {
        font-size: 18px;
        font-weight: bold;
    }

    /* Background Styling for Total and Summary */
    .bg-color-three {
        background-color: #fff;
        border-radius: 8px;
        padding: 16px;
    }
</style>

<!-- Page title -->
<div class="page-title parallax parallax1">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="page-title-heading">
                    <h1 class="title">Shopping Cart</h1>
                </div><!-- /.page-title-heading -->
                <div class="breadcrumbs">
                    <ul>
                       <li><a href="{{route('home')}}">Home</a></li>
                        <li><a href="#">Cart</a></li>
                    </ul>
                </div><!-- /.breadcrumbs -->
            </div><!-- /.col-md-12 -->
        </div><!-- /.row -->
    </div><!-- /.container -->
</div><!-- /.page-title -->

<!-- ================================ Cart Section Start ================================ -->

<section class="flat-row main-shop shop-detail style-1">
    <div class="container">
        <div class="row gy-4">

            <div class="col-xl-8 col-lg-7">
                <!-- Display the cart items table -->
                <div class="cart-table border border-gray-100 rounded-8 px-40 py-40">
                    <div class="overflow-x-auto scroll-sm scroll-sm-horizontal">
                        @php
                        $total = 0;
                        @endphp
                        @if ($cartItems->count() > 0)
                        <table class="table style-three">
                            <thead>
                                <tr>
                                    <th class="h6 mb-0 text-center fw-bold">Product</th>
                                    <th class="h6 mb-0 text-center fw-bold">Price</th>
                                    <th class="h6 mb-0 text-center  fw-bold">Quantity</th>
                                    <th class="h6 mb-0 text-center  fw-bold">Subtotal</th>
                                    <th class="h6 mb-0 text-center  fw-bold">Delete</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach($cartItems as $item)
                                <tr class="align-items-center">
                                <td>
                                <div class="table-product d-flex align-items-center gap-24">
                                    <a href="#" class="table-product__thumb border border-gray-100 rounded-8 flex-center p-0">
                                        @if ($item->product_image)
                                            <img src="{{ asset('storage/' . $item->product_image) }}" style="width:80px;" alt="Product Image">
                                        @else
                                            <img src="{{ asset('path_to_placeholder_image.jpg') }}" style="width:80px;" alt="Placeholder Image">
                                        @endif
                                    </a>
                                    <div class="table-product__content text-start">
                                        <h6 class="title" style="color:white;">
                                            {{ $item->product->product_name }}
                                        </h6>
                                        @if ($item->size || $item->color)
                                            <div class="">
                                                @if ($item->size)
                                                    <span>Size: {{ $item->size }}</span>
                                                @endif
                                                @if ($item->color)
                                                    <span>Color: </span>
                                                    <span 
                                                        class="color-circle" 
                                                        style="background-color: #{{ $item->color }}; width: 20px; height: 20px; border-radius: 50%; display: inline-block; margin-right: 10px;">
                                                    </span>
                                                @endif
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                </td>

                                    <td class="text-center align-middle">
                                        <span class="h6 mb-0 fw-semibold">Rs. {{$item->price}}</span>
                                    </td>
                                    <td class="text-center align-middle">
                                        <div class="d-flex justify-content-center align-items-center overflow-hidden">
                                            <span class="quantity__minus d-flex justify-content-center align-items-center border border-end-0 border-gray-300" style="width:40px; height:40px; cursor:pointer;">
                                                −
                                            </span>
                                            <input type="number"
                                                name="quantity"
                                                class="quantity__input text-center border border-gray-300 text-black"
                                                style="width:50px; height:40px;"
                                                value="{{$item->quantity}}"
                                                min="1"
                                                max="{{ $item->product->quantity }}"
                                                data-id="{{$item->id}}"
                                                data-price="{{$item->product->price}}">
                                            <span class="quantity__plus d-flex justify-content-center align-items-center border border-start-0 border-gray-300" style="width:40px; height:40px; cursor:pointer;">
                                                +
                                            </span>
                                        </div>
                                                                        
                                    </td>
                                    <td class="text-center align-middle">
                                        <span class="subtotal fw-bold" data-id="{{$item->id}}">
                                            Rs. {{ number_format($item->subtotal, 2) }}
                                        </span>
                                        @php
                                        $total += $item->subtotal; // Correct increment syntax
                                        @endphp
                                    </td>


                                    <td class="text-center align-middle">
                                        <form action="{{ route('cart.remove', $item->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to remove this item?');">
                                            @csrf
                                            @method('DELETE') <!-- This method is used for HTTP DELETE -->
                                            <button type="submit" style="background: none; border: none; cursor: pointer;">
                                                <i class="material-icons text-danger">delete</i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach

                            </tbody>

                        </table>
                        @else
                        <div class="text-center d-flex justify-content-center align-items-center">
                            <i class="material-icons" style="font-size: 80px; color: #888; margin-right: 10px;">shopping_cart</i>
                            <p style="margin-bottom: 0;">Empty Cart</p>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="cart-sidebar border border-gray rounded-8 p-3">
                <!-- Cart Totals Header -->
                <h6 class="cart-totals-header mb-0">Cart Totals</h6>

                <!-- Cart Summary -->
                <div class="bg-color-three rounded-8">
                    <div class="d-flex justify-content-between">
                        <span class="cart-summary-label">Subtotal</span>
                        <span class="cart-summary-value">Rs. {{ number_format($total, 2) }}</span>
                    </div>

                    <div class="d-flex justify-content-between">
                        <span class="cart-summary-label font-heading-two">Delivery Fee</span>
                        <span class="cart-summary-value">
                            @if ($cartItems->count() > 0)
                                Rs 350.00
                            @else
                                Rs 0.00
                            @endif
                        </span>
                    </div>

                  <!-- Promo Discount and Apply Promo Code Form -->
                    @if (session('promo'))
                        <!-- Promo Discount applied -->
                        <div class="d-flex justify-content-between mt-3">
                            <span class="cart-summary-label">Promo Discount ({{ session('promo.discount_percentage') }}%)</span>
                            <span class="cart-summary-value">- Rs. {{ number_format(session('promo.discount_amount'), 2) }}</span>
                        </div>

                        <!-- Remove Promo Code Button -->
                        <form action="{{ route('remove.promo') }}" method="POST" style="text-align: left; margin-top: -10px;">
                            @csrf
                            <button type="submit" class="btn btn-link" style="color: red; text-decoration: none; padding: 0; font-size: 12px;">
                                Remove Promo Code
                            </button>
                        </form>
                    @endif


                    <!-- Promo Code Form -->
                    <form id="promo-form" class="d-flex justify-content-between mt-4" action="{{ route('apply.promo') }}" method="POST">
                        @csrf
                        <input type="text" class="form-control" name="promo_code" placeholder="Enter Promo Code" style="height:40px; font-size:12px" required>
                        <button type="submit" id="apply-promo" style="background-color:black;padding: 0 20px; height:40px; font-size:12px">Apply</button>
                    </form>


                   
                    <div class="d-flex justify-content-between mt-3">
                        <span class="cart-summary-label" style="color: #333; font-size: 1.1rem; font-weight: 600;">Total</span>
                        <span class="cart-summary-value" style="color: #333; font-size: 1.1rem; font-weight: 600;">
                            Rs. {{ number_format(session('promo.total', $total + 350), 2) }}
                        </span>
                    </div>
                </div>

                <!-- Proceed to Checkout -->
                <div class="bg-color-three">
                    <div style="display: flex; justify-content: center; align-items: center;">
                        <button type="button" style="border: none; padding: 0;">
                            <a href="{{ route('checkout', ['promo_code' => session('promo.name')]) }}" 
                            class="btn rounded-8 text-white" 
                            style="font-size:12px; font-weight:bold; padding: 10px 20px; text-decoration: none;">
                            Proceed to Checkout
                            </a>
                        </button>
                    </div>
                </div>
            </div>



        </div>
</section>





<!-- ================================ Cart Section End ================================ -->


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Function to calculate and update the cart total
        function updateCartTotal() {
            let total = 0;

            // Iterate over all subtotals and add them to the total
            $('.subtotal').each(function() {
                let value = $(this).text().replace('Rs.', '').trim(); // Remove 'Rs.' and trim spaces
                let numericValue = parseFloat(value); // Convert to a number
                if (!isNaN(numericValue)) { // Ensure it's a valid number
                    total += numericValue;
                }
            });

            // Update the total in the DOM
            $('#cart-total').text('Rs. ' + total.toFixed(2));
        }

        // Function to update a single cart item's quantity and subtotal
        function updateCartItemQuantity(element, increment = true) {
            const input = $(element).siblings('.quantity__input');
            let quantity = parseInt(input.val());
            const price = parseFloat(input.data('price'));
            const id = input.data('id');
            const maxQuantity = parseInt(input.attr('max')); // Maximum quantity allowed based on available stock

            // Validate quantity and price
            if (isNaN(quantity) || quantity < 1 || isNaN(price)) return;

            // Adjust quantity based on increment/decrement, ensuring it does not exceed max quantity
            if (increment && quantity < maxQuantity) {
                quantity++;
            } else if (!increment && quantity > 1) {
                quantity--;
            }

            // Update the input field with the new quantity
            input.val(quantity);

            // Calculate the new subtotal
            const subtotal = (price * quantity).toFixed(2);

            // Update the subtotal display
            $('.subtotal[data-id="' + id + '"]').text('Rs. ' + subtotal);

            // Recalculate the total
            updateCartTotal();

            // Optionally, send an AJAX request to update the server
            $.ajax({
                url: '/cart/update/' + id,
                method: 'PUT',
                data: {
                    _token: '{{ csrf_token() }}',
                    quantity: quantity
                },
                success: function(response) {
                    console.log('Cart item updated:', response);

                    // Update subtotal with Rs. prefix after confirmation
                    $('.subtotal[data-id="' + id + '"]').text('Rs. ' + parseFloat(response.cart_item.subtotal).toFixed(2));

                    // Recalculate total again if needed
                    updateCartTotal();
                },
                error: function(error) {
                    console.error('Error updating cart item:', error);
                }
            });
        }

        // Handle increment (plus button) click
        $('.quantity__plus').on('click', function() {
            updateCartItemQuantity(this, true); // Increment the quantity
        });

        // Handle decrement (minus button) click
        $('.quantity__minus').on('click', function() {
            updateCartItemQuantity(this, false); // Decrement the quantity
        });

        // Handle quantity input change directly
        $('.quantity__input').on('change', function() {
            const quantity = parseInt($(this).val());
            const price = parseFloat($(this).data('price'));
            const id = $(this).data('id');
            const maxQuantity = parseInt($(this).attr('max')); // Get max quantity allowed based on available stock

            // Ensure the quantity is within valid bounds
            if (quantity >= 1 && quantity <= maxQuantity && !isNaN(price)) {
                const subtotal = (price * quantity).toFixed(2);
                $('.subtotal[data-id="' + id + '"]').text('Rs. ' + subtotal);

                // Recalculate the total
                updateCartTotal();

                // Optionally, send an AJAX request to update the server
                $.ajax({
                    url: '/cart/update/' + id,
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        quantity: quantity
                    },
                    success: function(response) {
                        console.log('Cart item updated:', response);

                        // Update subtotal with Rs. prefix after confirmation
                        $('.subtotal[data-id="' + id + '"]').text('Rs. ' + parseFloat(response.cart_item.subtotal).toFixed(2));

                        // Recalculate total again if needed
                        updateCartTotal();
                    },
                    error: function(error) {
                        console.error('Error updating cart item:', error);
                    }
                });
            } else {
                // If quantity exceeds max, reset to max quantity
                $(this).val(maxQuantity);
                alert('You cannot exceed the available stock.');
            }
        });

        // Initial calculation of total when the page loads
        updateCartTotal();
    });
</script>

<script>
document.getElementById('apply-promo').addEventListener('click', function () {
    const promoCode = document.querySelector('input[name="promo_code"]').value;
    const csrfToken = document.querySelector('input[name="_token"]').value;

    if (!promoCode) {
        alert('Please enter a promo code.');
        return;
    }

    // Submit the form using fetch (via the form submission itself)
    fetch("{{ route('apply.promo') }}", {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken
        },
        body: JSON.stringify({ promo_code: promoCode })
    })
    .then(response => {
        if (response.ok) {
            window.location.reload(); // Reload to reflect any changes in promo or total
        } else {
            alert('Failed to apply promo code.');
        }
    })
    .catch(error => {
        console.error('Error applying promo code:', error);
        alert('An error occurred while applying the promo code. Please try again.');
    });
});
</script>


@endsection