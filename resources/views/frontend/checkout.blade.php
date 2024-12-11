@extends ('frontend.master')

@section('content')

<!-- Page title -->
<div class="page-title parallax parallax1">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="page-title-heading">
                    <h1 class="title">Checkout</h1>
                </div><!-- /.page-title-heading -->
                <div class="breadcrumbs">
                    <ul>
                        <li><a href="{{route('home')}}">Home</a></li>
                        <li><a href="{{route('cart')}}">Cart</a></li>
                        <li><a href="#">Checkout</a></li>
                    </ul>
                </div><!-- /.breadcrumbs -->
            </div><!-- /.col-md-12 -->
        </div><!-- /.row -->
    </div><!-- /.container -->
</div><!-- /.page-title -->

<!-- ================================= Checkout Page Start ===================================== -->
<section class="flat-row main-shop shop-detail style-1">
    <div class="container">
        <form action="{{ route('order.place') }}" method="POST">
            @csrf
            <div class="row">
                <!-- Billing Details Section -->
                <div class="col-xl-8 col-lg-7">
                    <div class="border rounded" style="border:1px solid #f5f2f2; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); padding: 20px;">
                        <h3 class="text-lg font-semibold" style="color: white">Billing Details</h3>
                        <div class="row">
                            <div class="col-sm-6 mt-3">
                                <input type="text" name="first_name" class="form-control" placeholder="First Name" required>
                            </div>
                            <div class="col-sm-6 mt-3">
                                <input type="text" name="last_name" class="form-control" placeholder="Last Name" required>
                            </div>
                            <div class="col-12 mt-3">
                                <input type="text" name="house_no" class="form-control" placeholder="House number and street name" required>
                            </div>
                            <div class="col-12 mt-3">
                                <input type="text" name="apartment" class="form-control" placeholder="Apartment, suite, unit, etc. (Optional)">
                            </div>
                            <div class="col-sm-6 mt-3">
                                <input type="text" name="city" class="form-control" placeholder="City" required>
                            </div>
                            <div class="col-sm-6 mt-3">
                                <input type="text" name="postal_code" class="form-control" placeholder="Postal Code" required>
                            </div>
                            <div class="col-12 mt-3">
                                <input type="number" name="phone" class="form-control" placeholder="Phone" required>
                            </div>
                            <div class="col-12 mt-3">
                                <input type="email" name="email" class="form-control" placeholder="Email Address" required>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Order Summary Section -->
                <div class="col-xl-4 col-lg-5">
                    <div class="checkout-sidebar border rounded p-3" style="box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                        <!-- Header -->
                        <div class="bg-light rounded text-center py-3 mb-3">
                            <span class="fw-bold" style="font-size:20px">Your Orders</span>
                        </div>

                        <!-- Order Details -->
                        <div class="border rounded p-3">
                            <!-- Header Row -->
                            <div class="d-flex justify-content-between border-bottom pb-2 mb-3">
                                <span class="fw-bold" style="font-size: 16px;">Product</span>
                                <span class="fw-bold text-end" style="font-size: 16px;">Subtotal</span>
                            </div>

                            <!-- Items Loop -->
                            @php
                            $total = 0;
                            @endphp
                            @foreach ($cartItems as $item)
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <div class="d-flex flex-column">
                                    @php
                                    $product = App\Models\Product::find($item->product_id);
                                    @endphp

                                    <span style="font-size: 14px; display: inline-flex; justify-content: space-between; gap: 50px;">
                                        {{$product->product_name}}
                                        <span>X {{$item->quantity}}</span>
                                    </span>

                                    <!-- Hidden Inputs for Product Details -->
                                    <input type="hidden" name="products[{{$loop->index}}][product_id]" value="{{$product->id}}">
                                    <input type="hidden" name="products[{{$loop->index}}][product_name]" value="{{$product->product_name}}">
                                    <input type="hidden" name="products[{{$loop->index}}][quantity]" value="{{$item->quantity}}">
                                    <input type="hidden" name="products[{{$loop->index}}][subtotal]" value="{{$item->subtotal}}">
                                </div>
                                <span class="fw-semibold text-end" style="font-size: 14px;">Rs. {{$item->subtotal}}</span>
                                @php
                                $total += $item->subtotal; // Correct increment syntax
                                @endphp
                            </div>
                            @endforeach

                            <!-- Separator -->
                            <hr class="my-3">

                            <!-- Subtotal Row -->
                            <div class="d-flex justify-content-between mb-2">
                                <span class="fw-bold" style="font-size: 14px;">Subtotal</span>
                                <span class="fw-semibold text-end" style="font-size: 14px;">Rs. {{$total}}</span>
                            </div>

                            <!-- Delivery Fee Row -->
                            <div class="d-flex justify-content-between mb-2">
                                <span class="fw-bold" style="font-size: 14px;">Delivery Fee</span>
                                <span class="fw-semibold text-end" style="font-size: 14px;">Rs 300.00</span>
                            </div>

                            <!-- Total Row -->
                            <hr class="my-3">
                            <div class="d-flex justify-content-between">
                                <span class="fw-bold text-lg" style="font-size: 16px;">Total</span>
                                <span class="fw-bold text-lg text-end" style="font-size: 16px;">Rs. {{($total)+ 300}}</span>
                            </div>
                        </div>

                        <!-- Privacy Notice -->
                        <div class="mt-3 pt-3 border-top">
                            <p class="text-muted" style="font-size: 12px;">
                                Your personal data will be used to process your order, support your experience throughout this website, and for other purposes described in our
                                <a href="#" class="text-primary text-decoration-underline">privacy policy</a> .
                            </p>
                        </div>

                        <!-- Place Order Button -->
                        <button type="submit" class="btn mt-3 w-100" style="padding: 10px; font-size: 14px;">Place Order</button>
                    </div>
                </div>

            </div>
        </form>
    </div>
</section>
<!-- ================================= Checkout Page End ===================================== -->

@endsection
