@extends ('frontend.master')

@section('content')

<style>

.flat-title h2{
    color:white !important;
   
   
}
.toggle-title{
    color:#b4b1b1 !important;
    font-weight: bold!important;

}

    
</style>
       
      <!-- Page title -->
<div class="page-title parallax parallax1">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="page-title-heading">
                    <h1 class="title">FAQ's</h1>
                </div><!-- /.page-title-heading -->
                <div class="breadcrumbs">
                    <ul>
                        <li><a href="{{route('home')}}">Home</a></li>
                        <li><a href="{{route('faq')}}">FAQ's</a></li>
                    </ul>
                </div><!-- /.breadcrumbs -->
            </div><!-- /.col-md-12 -->
        </div><!-- /.row -->
    </div><!-- /.container -->
</div><!-- /.page-title -->
<!-- ========================= Breadcrumb End =============================== -->

    	<section class="flat-row">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="flat-title">
                            <h2>Ordering & Payment</h2>
                        </div><!-- /.flat-title -->
                        <div class="flat-accordion">
                            <div class="flat-toggle">
                                <div class="toggle-title">
                                    Q: How do I change or cancel my order?
                                </div>
                                <div class="toggle-content">
                                    <p>
                                        To change or cancel your order on Belvio, please contact our customer support team as soon as possible. Orders can only be modified or canceled before they are processed for shipment. Once your order has been shipped, cancellations or changes will no longer be possible. For assistance, reach out through our support channels listed on the Contact Us page.
                                    </p>
                                </div>
                            </div><!-- /.flat-toggle -->

                            <div class="flat-toggle">
                                <div class="toggle-title">
                                    Q: I placed an order, but never received a confirmation email.
                                </div>
                                <div class="toggle-content">
                                    <p>
                                       I recently placed an order on Belvio, an e-commerce clothing website, but I have not received a confirmation email yet. I would appreciate it if you could check the status of my order and confirm whether it has been successfully processed. Please let me know if you need any additional information from my side. Thank you.
                                    </p>
                                </div>
                            </div><!-- /.flat-toggle -->

                            <div class="flat-toggle">
                                <div class="toggle-title">
                                   Q: What payment methods do you accept?
                                </div>
                                <div class="toggle-content">
                                    <p>
                                        We accept a variety of secure payment methods to ensure a smooth shopping experience at Belvio, your trusted e-commerce clothing destination. Customers can pay using major credit and debit cards, including Visa, MasterCard, and American Express. We also support popular digital wallets such as PayPal, Google Pay, and Apple Pay for fast and secure transactions. Additionally, we offer direct bank transfers and cash-on-delivery services in selected regions. Rest assured, all payment information is processed through encrypted and secure gateways to protect your personal data. Shop confidently with Belvio!
                                    </p>
                                </div>
                            </div><!-- /.flat-toggle -->

                            <div class="flat-toggle">
                                <div class="toggle-title">
                                    Q: I am an international customer and I am not sure how much I'll be charged for a purchase
                                </div>
                                <div class="toggle-content">
                                    <p>
                                        "As an international customer, we understand that you may have questions regarding the total cost of your purchase. The final charge will depend on your location, including shipping fees, applicable customs duties, and taxes. Please note that these additional costs are determined by your country's regulations and are not included in the product price. You can view the estimated shipping costs and potential import charges during checkout, or contact our customer support for further assistance."
                                    </p>
                                </div>
                            </div><!-- /.flat-toggle -->
                        </div><!-- /.flat-accordion -->
                    </div><!-- /.col-md-12 -->
                </div><!-- /.row -->
                <div class="divider"></div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="flat-title">
                            <h2>Tracking Your Order</h2>
                        </div><!-- /.flat-title -->
                        <div class="flat-accordion">
                            <div class="flat-toggle">
                                <div class="toggle-title">
                                   Q: How do I check on the status of my order?
                                </div>
                                <div class="toggle-content">
                                    <p>
                                        To check the status of your order on Belvio, simply log in to your account and navigate to the "My Orders" section. Here, you'll find a detailed list of your recent purchases, along with real-time updates on their status. If your order has been shipped, you will be provided with tracking information so you can follow your package's journey. If you need any further assistance or have specific questions about your order, please don’t hesitate to contact our customer support team.
                                    </p>
                                </div>
                            </div><!-- /.flat-toggle -->

                            <div class="flat-toggle">
                                <div class="toggle-title">
                                    Q: I am an international customer and I want to return an item.
                                </div>
                                <div class="toggle-content">
                                    <p>
                                        "As an international customer, I wish to return an item purchased from Belvio. I understand the process and requirements for returns on international orders and would appreciate guidance on how to proceed with the return. Please let me know the steps, any return forms needed, and if there are any specific conditions or policies related to international returns. Thank you for your assistance."
                                         Let me know if you'd like any adjustments!
                                    </p>
                                </div>
                            </div><!-- /.flat-toggle -->

                            <div class="flat-toggle">
                                <div class="toggle-title">
                                  Q: My tracking info shows my package was delivered, but I never received it.
                                </div>
                                <div class="toggle-content">
                                    <p>
                                        We understand how concerning it can be when a package shows as delivered but hasn't arrived. If you are experiencing this situation, please double-check the delivery location to ensure it wasn't left in a secure area, like a porch, mailbox, or with a neighbor. If you still cannot locate your package, kindly reach out to our customer support team with your order details, and we will work closely with the carrier to resolve the issue. Your satisfaction is our top priority, and we're here to help you every step of the way.
                                    </p>
                                </div>
                            </div><!-- /.flat-toggle -->

                            <div class="flat-toggle">
                                <div class="toggle-title">
                                    Q: How long does it take to process returns?
                                </div>
                                <div class="toggle-content">
                                    <p>
                                        "At Belvio, we strive to provide a seamless return process. Once your return request is submitted, it typically takes 3-5 business days for us to process and approve it. After approval, we will initiate the refund or exchange based on your preference. Please note that the total processing time may vary depending on the method of return and the volume of requests. We aim to ensure that all returns are handled efficiently and in a timely manner, so you can enjoy a hassle-free shopping experience."
                                         Let me know if you need any adjustments!
                                    </p>
                                </div>
                            </div><!-- /.flat-toggle -->
                        </div><!-- /.flat-accordion -->
                    </div><!-- /.col-md-12 -->
                </div><!-- /.row -->
                <div class="divider"></div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="flat-title">
                            <h2>Size Guide</h2>
                        </div><!-- /.flat-title -->
                        <div class="flat-accordion">
                            <div class="flat-toggle">
                                <div class="toggle-title">
                                    Q: I'm an international Fashionista. How do I find out what my size is?
                                </div>
                                <div class="toggle-content">
                                    <p>
                                        Finding the perfect fit is key to feeling confident in your style. At Belvio, we understand that sizing can vary between countries, so we've made it easy for you to find your size regardless of where you are. To determine your size, simply refer to our size guide, which provides measurements for each clothing item in both standard international sizing (S, M, L, etc.) and specific numeric sizes. You can also use the provided charts to compare your body measurements with our recommended sizes. If you’re still unsure, our customer support team is here to assist you in choosing the best fit. Enjoy shopping your favorite styles with confidence at Belvio!
                                    </p>
                                </div>
                            </div><!-- /.flat-toggle -->

                            <div class="flat-toggle">
                                <div class="toggle-title">
                                    Q: What are the inseams of your jeans?
                                </div>
                                <div class="toggle-content">
                                    <p>
                                        At Belvio, we understand how important it is to find the perfect fit when shopping for jeans. That’s why we provide detailed inseam measurements for each pair of jeans we offer. Our inseams range from petite to tall, ensuring that you can find the perfect length no matter your height. Whether you're looking for a cropped style or a full-length jean, you'll find the ideal fit for your body type. If you're unsure about your inseam measurement, feel free to consult our sizing guide or contact our customer support team for assistance.
                                    </p>
                                </div>
                            </div><!-- /.flat-toggle -->

                            <div class="flat-toggle ">
                                <div class="toggle-title">
                                  Q: What is your turn around time? When can I expect to receive my hand made garment?
                                </div>
                                <div class="toggle-content">
                                    <p>
                                        At Belvio, we take great pride in crafting each garment by hand, ensuring the highest quality and attention to detail. Our typical turnaround time for handmade garments is 7-10 business days, depending on the complexity of the design and current order volume. Once your item is ready, it will be shipped to you promptly. You can expect delivery within 3-5 business days after shipment, depending on your location. We strive to offer the best shopping experience, and your satisfaction is our top priority. If you have any questions or special requests, feel free to contact our support team!
                                    </p>
                                </div>
                            </div><!-- /.flat-toggle -->

                            <div class="flat-toggle">
                                <div class="toggle-title">
                                    Q: What if my clothing does not fit?
                                </div>
                                <div class="toggle-content">
                                    <p>
                                        At Belvio, we understand that finding the perfect fit is important. If the clothing you purchased doesn’t fit as expected, don’t worry! We offer an easy return and exchange process. Simply contact our customer support team, and they will guide you through the steps to return or exchange the item. We recommend checking our size guide before purchasing to ensure the best fit, but if any issues arise, our team is here to help. Your satisfaction is our priority!
                                    </p>
                                </div>
                            </div><!-- /.flat-toggle -->
                        </div><!-- /.flat-accordion -->
                    </div><!-- /.col-md-12 -->
                </div><!-- /.row -->
            </div><!-- /.container -->
        </section><!-- /.flat-row -->
		
@endsection		