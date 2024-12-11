@extends ('frontend.master')

@section('content')
<style>


  .card {
    border-radius: 0; 
    width: 90%;
  }

  .thank-you-section {
    display: flex;
    justify-content: center; 
    align-items: center;

  }

  .card-container {
    display: flex;
    justify-content: center; 
    align-items: center; 

  }
</style>

<section class="flat-row main-shop shop-detail style-1">
<div class="container">
  
  <section class="thank-you-section">
    <!-- Payment -->
    <div class="col-md-12 mb-4 card-container" >
      <div class="card shadow-0 border"  style="background-color: #fafafa;">
        @csrf
        <div class="p-20 text-center">
          <h4 style="color: red; margin-top:10px;">Thank You for Your Purchase!</h4>
          <h6 class="mt-4" style="color:black;" >Your order has been confirmed. Your order code is: <strong>{{ $order->order_code }}</strong></h6>
          <p class="mt-4" style="color:black;">Please have this amount ready on the delivery day.</p>
          <h5 style="color: red;">Rs.{{ $order->total_cost }}</h5>
        </div>
      </div>
    </div>
  </section>
</div>
</section>

@endsection
