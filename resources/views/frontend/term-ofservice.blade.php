@extends ('frontend.master')

@section('content')

<style>
.customer-service-content h3 {
  position: relative !important;
  margin-bottom: 20px!important;
  font-size: 22px!important;
  font-weight: 700!important;
  color: white;
}
.customer-service-content h3 i {
  position: absolute!important;
  top: 0!important;
  left: 0!important;
  color:  #0c990c!important ;
}
.customer-service-content h3:not(:first-child) {
  margin-top: 30px!important;
}
.customer-service-content ul {
  padding-left: 0!important;
  list-style-type: none!important;
  margin-bottom: 0!important;
}
.customer-service-content ul li {
  color: white!important;
  margin-bottom: 12px!important;
  position: relative!important;
  padding-left: 13px!important;
}
.customer-service-content ul li::before {
  content: ""!important;
  position: absolute!important;
  left: 0!important;
  top: 9px!important;
  width: 5px!important;
  height: 5px!important;
  border-radius: 50%!important;
  background:  #0c990c !important;
}
.customer-service-content ul li:last-child {
  margin-bottom: 0!important;
}
.customer-service-content ul li a {
  display: inline-block!important;
  color: white!important;
}
.customer-service-content ul li a:hover {
  color: hsl(120, 90%, 12%)!important;
}

</style>

<!-- Page title -->
<div class="page-title parallax parallax1">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="page-title-heading">
                    <h1 class="title">Term of service</h1>
                </div><!-- /.page-title-heading -->
                <div class="breadcrumbs">
                    <ul>
                        <li><a href="{{route('home')}}">Home</a></li>
                        <li><a href="{{route('term-ofservice')}}">Term of service</a></li>
                    </ul>
                </div><!-- /.breadcrumbs -->
            </div><!-- /.col-md-12 -->
        </div><!-- /.row -->
    </div><!-- /.container -->
</div><!-- /.page-title -->
<!-- ========================= Breadcrumb End =============================== -->


        <!-- Start Customer Service Area -->
        <section class="customer-service-area ptb-100">
            <div class="container">
                <div class="customer-service-content" style="margin-top: 30px;margin-bottom:30px;">
                    <h3>1. Shipping Times and Costs</h3>
                    <ul>
                        <li>Complimentary ground shipping within 1 to 7 business days</li>
                        <li>In-store collection available within 1 to 7 business days</li>
                        <li>Next-day and Express delivery options also available</li>
                        <li>Purchases are delivered in an orange box tied with a Bolduc ribbon, with the exception of certain items</li>
                        <li>See the delivery FAQs for details on shipping methods, costs and delivery times</li>
                    </ul>
                    <h3>2. Payment Methods</h3>
                    <p>Belvio accepts the following payment methods:</p>
                    <ul>
                        <li>Credit Card: Visa, MasterCard, Discover, American Express, JCB, Visa Electron. The total will be charged to your card when the order is shipped.</li>
                        <li>Belvio features a Fast Checkout option, allowing you to securely save your credit card details so that you don't have to re-enter them for future purchases.</li>
                        <li>PayPal: Shop easily online without having to enter your credit card details on the website.Your account will be charged once the order is completed. To register for a PayPal account, visit the website paypal.com.</a></li>
                    </ul>
                    <h3>3. Exchanges, Returns and Refunds</h3>
                    <p>Items returned within 14 days of their original shipment date in same as new condition will be eligible for a full refund or store credit. Refunds will be charged back to the original form of payment used for purchase. Customer is responsible for shipping charges when making returns and shipping/handling fees of original purchase is non-refundable.</p>
                </div>
            </div>
        </section>
        <!-- End Customer Service Area -->
@endsection