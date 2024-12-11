@extends ('frontend.master')

@section('content')

<style>
 

  .card {
    border-radius: 0; 
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  }

  .checkout-card {
    flex: 1; 
  }

  .error-message {
    color: red;
    font-size: 0.875rem;
  }

  .square-input {
    border-radius: 0; 
    font-size: 14px;
  }

</style>

<!-- Page title -->
<div class="page-title parallax parallax1">
    		<div class="container">
    			<div class="row">
    				<div class="col-md-12">
    					<div class="page-title-heading">
    						<h1 class="title">Payment</h1>
    					</div><!-- /.page-title-heading -->
    					<div class="breadcrumbs">
    						<ul>
    							<li><a href="index.html">Home</a></li>
    							<li><a href="shop-3col.html">Checkout</a></li>
                                <li><a href="shop-detail-video.html">Payment</a></li>
    						</ul>
    					</div><!-- /.breadcrumbs -->
    				</div><!-- /.col-md-12 -->
    			</div><!-- /.row -->
    		</div><!-- /.container -->
    	</div><!-- /.page-title -->

<section class="flat-row main-shop shop-detail style-1">
    <div class="container">
    <div class="row checkout-summary-container">
      <!-- Payment -->
      <div class="col-md-8 mb-4">
        <div class="card shadow-0 border checkout-card" style="padding: 20px; margin-bottom: 30px;">
          <div class="p-4">
            <h5 class="card-title mb-4 " style="font-size: 20px;">Select Payment Method</h5>

            <!-- Payment Tabs -->
            <ul class="nav nav-tabs" id="paymentTabs" role="tablist" style="text-align: center; margin-bottom: 25px;margin-top:25px;">
              <li class="nav-item" role="presentation">
                <a class="nav-link active" id="credit-card-tab" data-bs-toggle="tab" href="#credit-card" role="tab" aria-controls="credit-card" aria-selected="true">
                  <div class="mb-10 mt-12 ">
                    <img src="{{ asset('frontendnew/assets/images/imgs/card.png') }}" style="width: 40px; height: auto; display: block; margin: 0 auto;">
                  </div>
                  <span>Credit/Debit Card</span>
                  
                </a>
              </li>
              <li class="nav-item" role="presentation">
                <a class="nav-link" id="cash-on-delivery-tab" data-bs-toggle="tab" href="#cash-on-delivery" role="tab" aria-controls="cash-on-delivery" aria-selected="false">
                  <div class="mb-10 mt-12 ">
                    <img src="{{ asset('frontend/assets/images/imgs/cod.png') }}" style="width: 60px; height: auto; display: block; margin: 0 auto;">
                  </div>
                  <span>Cash on Delivery</span>
                  
                </a>
              </li>
            </ul>

            <!-- Tab Content -->
            <div class="tab-content mt-4" id="paymentTabsContent">
              <!-- Credit/Debit Card Payment -->
              <div class="tab-pane fade show active" id="credit-card" role="tabpanel" aria-labelledby="credit-card-tab" style="width: 60%; margin-bottom: 30px;margin-top:30px;">
                <div class="mb-4">
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
                </div>
                <button type="button" class="btn" style="background-color: rgb(238, 82, 10); color: white; width: 48%; margin-top: 2rem;">Pay Now</button>
              </div>

              <!-- Cash on Delivery -->
              <div class="tab-pane fade" id="cash-on-delivery" role="tabpanel" aria-labelledby="cash-on-delivery-tab" style="margin-top: 30px;">
                <div class="mb-4">
                  <p style="font-size: 15px;">- You may pay in cash to our courier upon receiving your parcel at the doorstep.<br>
                  - Before agreeing to receive the parcel, check if your delivery status has been updated to 'Out for Delivery'
                  </p>
                </div>
                <form action="{{ route('confirm.cod.order', $order->order_code) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn" style="background-color: rgb(238, 82, 10); color: white; margin-top: 2rem;">
                        Confirm Order
                    </button>
                </form>

              </div>
              
            </div>
          </div>
        </div>
      </div>

      <!-- Summary -->
      <div class="col-md-4 ">
        <div class="card shadow-0 border summary-card" style="padding: 20px; margin-bottom: 30px;">
          <div class="p-4">
            <h5 class="mb-4"style="font-size: 20px;">Order Summary</h5>
            <div class="d-flex justify-content-between mb-3">
              <p class="mb-2">Subtotal:</p>
              <p class="mb-2">Rs. {{ number_format($order->total_cost - 300, 2) }}</p>
            </div>
            <div class="d-flex justify-content-between mb-3">
              <p class="mb-2">Delivery Fee:</p>
              <p class="mb-2">Rs. 300.00</p>
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
</div>
  </section>




@endsection
