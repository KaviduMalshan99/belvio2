@extends ('frontend.master')

@section('content')

<!-- ========================= Breadcrumb Start =============================== -->
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
                        <li><a href="index.html">Home</a></li>
                        <li><a href="shop-3col.html">Cart</a></li>
                        <li><a href="shop-detail-video.html">Checkout</a></li>
                    </ul>
                </div><!-- /.breadcrumbs -->
            </div><!-- /.col-md-12 -->
        </div><!-- /.row -->
    </div><!-- /.container -->
</div><!-- /.page-title -->
<!-- ========================= Breadcrumb End =============================== -->

<section class="py-3" style="padding: 50px; margin-bottom: 60px; margin-top: 60px;">
    <div class="row checkout-summary-container">
        <!-- Payment -->
        <div class="col-md-8 mb-4">
            <div class="card shadow-0 border checkout-card" style="padding: 20px; margin-bottom: 30px;">
                <div class="p-4">
                    <h5 class="card-title mb-4" style="font-size: 20px;">Select Payment Method</h5>

                    <!-- Payment Tabs -->
                    <ul class="nav nav-tabs" id="paymentTabs" role="tablist" style="text-align: center; margin-bottom: 25px;margin-top:25px;">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active" id="cash-on-delivery-tab" data-bs-toggle="tab" href="#cash-on-delivery" role="tab" aria-controls="cash-on-delivery" aria-selected="true">
                                <div class="mb-10 mt-12">
                                    <img src="{{ asset('frontendnew/images/cod.png') }}" style="width: 60px; height: auto; display: block; margin: 0 auto;">
                                </div>
                                <span>Cash on Delivery</span>
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="credit-card-tab" data-bs-toggle="tab" href="#credit-card" role="tab" aria-controls="credit-card" aria-selected="false">
                                <div class="mb-10 mt-12">
                                    <img src="{{ asset('frontendnew/images/card.png') }}" style="width: 40px; height: auto; display: block; margin: 0 auto;">
                                </div>
                                <span>Credit/Debit Card</span>
                            </a>
                        </li>
                    </ul>

                    <!-- Tab Content -->
                    <div class="tab-content mt-4" id="paymentTabsContent">
                        <!-- Cash on Delivery -->
                        <div class="tab-pane fade show active" id="cash-on-delivery" role="tabpanel" aria-labelledby="cash-on-delivery-tab" style="margin-top: 30px;">
                            <div class="mb-4">
                                <p style="font-size: 15px; color:black;">- You may pay in cash to our courier upon receiving your parcel at the doorstep.<br>
                                - Before agreeing to receive the parcel, check if your delivery status has been updated to 'Out for Delivery'
                                </p>
                            </div>
                            <form action="{{ route('confirm.cod.order', $order->order_code) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn" style=" color: white; margin-top: 2rem;">
                                    Confirm Order
                                </button>
                            </form>
                        </div>

                        <!-- Credit/Debit Card Payment -->
                        <div class="tab-pane fade" id="credit-card" role="tabpanel" aria-labelledby="credit-card-tab" style="width: 60%; margin-bottom: 30px;margin-top:30px;">
                            <!-- <div class="mb-4">
                                <label for="cardName" class="form-label"><span class="text-danger me-1">*</span>Name on Card</label>
                                <input type="text" class="form-control square-input" id="cardName" placeholder="Name on Card" required>
                            </div>
                            <div class="mb-4">
                                <label for="cardNumber" class="form-label"><span class="text-danger me-1">*</span>Card Number</label>
                                <input type="text" class="form-control square-input" id="cardNumber" placeholder="Card Number" required>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <label for="expiryDate" class="form-label"><span class="text-danger me-1">*</span>Expiry Date</label>
                                    <input type="text" class="form-control square-input" id="expiryDate" placeholder="MM/YY" required>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label for="cvv" class="form-label"><span class="text-danger me-1">*</span>CVV</label>
                                    <input type="text" class="form-control square-input" id="cvv" placeholder="123" required>
                                </div>
                            </div> -->
                            <a  href="{{route('transaction',$order->order_code)}}" type="button" class="btn" style="background-color: rgb(238, 82, 10); color: white; width: 48%; margin-top: 2rem;">Pay Now</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Summary -->
        <div class="col-md-4" style="color:black;">
            <div class="card shadow-0 border summary-card" style="padding: 20px; margin-bottom: 30px;">
                <div class="p-4">
                    <h5 class="mb-4" style="font-size: 20px;">Order Summary</h5>
                    <div class="d-flex justify-content-between mb-3">
                        <p class="mb-2">Subtotal:</p>
                        <p class="mb-2">Rs. {{ number_format($order->total_cost - 350, 2) }}</p>
                    </div>
                    <div class="d-flex justify-content-between mb-3">
                        <p class="mb-2">Delivery Fee:</p>
                        <p class="mb-2">Rs. 350.00</p>
                    </div>
                    <hr />
                    <div class="d-flex justify-content-between mt-3">
                        <h6 class="mb-2">Total Amount:</h6>
                        <h6 class="mb-2 fw-bold">Rs. {{ number_format($order->total_cost, 2) }}</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Add this JavaScript to enable tab switching -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Show the Cash on Delivery tab by default
        const codTab = document.querySelector('#cash-on-delivery-tab');
        const cardTab = document.querySelector('#credit-card-tab');

        const cashOnDeliveryPane = document.querySelector('#cash-on-delivery');
        const creditCardPane = document.querySelector('#credit-card');

        // Event listener to show Cash on Delivery
        codTab.addEventListener('click', function() {
            codTab.classList.add('active');
            cardTab.classList.remove('active');
            cashOnDeliveryPane.classList.add('show', 'active');
            creditCardPane.classList.remove('show', 'active');
        });

        // Event listener to show Credit/Debit Card
        cardTab.addEventListener('click', function() {
            cardTab.classList.add('active');
            codTab.classList.remove('active');
            creditCardPane.classList.add('show', 'active');
            cashOnDeliveryPane.classList.remove('show', 'active');
        });
    });
</script>

@endsection
