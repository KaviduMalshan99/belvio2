@extends ('frontend.master')

@section('content')

<style>
/* @media (max-width: 630px) {
    .product-content .product {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        align-items: center;
        margin-left:20%;
    } 
}

@media (max-width: 980px) {
    .product-content .product {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        align-items: center;
        margin-left:15%;
    } 
} */

.product-content .product-item {
    position: relative;
}

@media (max-width: 600px) {
    .product-content .product {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        align-items: center;
        margin-left:0;
    } 
}

.owl-carousel .item {
    display: flex;
    justify-content: center;
}

.owl-carousel .owl-stage {
    display: flex;
    justify-content: center;
}

.owl-carousel .owl-item {
    display: flex;
    justify-content: center;
}

.owl-carousel .item {
    margin: 0 10px; /* Adjust the margin as needed */
}

.owl-carousel .owl-stage-outer {
    display: flex;
    justify-content: center;
}




</style>


<style>
/* General Styles */
.services-section {
  background-color: #111; /* Dark background to make neon colors pop */
  padding: 20px 10px;
  font-family: 'Poppins', sans-serif; /* Sleek and modern font */
}

.container {
  max-width: 1200px;
  margin: 0 auto;
}

.services-list {
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
  gap: 12px; /* Balanced spacing for modern look */
}

.service-item {
  background: #1c1c1c; /* Darker background for a more vibrant effect */
  border-radius: 8px; /* Slightly rounded corners for elegance */
  text-align: center;
  padding: 10px;
  width: calc(25% - 12px); /* Four items per row */
  box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); /* Softer shadow for modern effect */
  height: 140px; /* Appropriate height for clothing branding */
  display: flex;
  flex-direction: column;
  justify-content: center;
  transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.service-item:hover {
  transform: scale(1.05);
  box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
}

.service-icon img {
  width: 40px; /* Larger icon size for better visibility */
  height: 40px;
  object-fit: contain;
  margin-bottom: 6px;
  filter: brightness(0) saturate(100%) invert(40%) sepia(91%) saturate(6224%) hue-rotate(75deg) brightness(200%); /* Neon effect for icons */
}

.service-heading {
  font-size: 14px; /* Slightly larger font for a bold effect */
  color: #f4f4f4; /* Light gray text for contrast */
  font-weight: 600;
  line-height: 1.2;
}

.service-text {
  font-size: 11px; /* Slightly larger font for a bold effect */
  color: #f4f4f4; /* Light gray text for contrast */
  font-weight: 400;
  line-height: 1.2;
  margin-top:7px;
}

.service-heading strong {
  font-size: 16px;
}

/* Neon effect for hover */
.service-item:hover .service-heading {
  color: #e6f500; /* Neon yellow on hover for extra emphasis */
}




/* Responsive Styles */
@media (max-width: 992px) {
  .service-item {
    width: calc(50% - 12px); /* Two items per row for medium screens */
  }
}

@media (max-width: 600px) {
  .service-item {
    width: 100%; /* Full width for small screens */
  }
}


</style>
  
    

        <!-- SLIDER -->
        <div class="rev_slider_wrapper fullwidthbanner-container">
            <div id="rev-slider3" class="rev_slider fullwidthabanner">
                <ul>
                    <!-- Slide 1 -->
                    <li data-transition="random">
                       <!-- Main Image -->
                       <img src="{{ asset('images/Website banner.png') }}" alt="" data-bgposition="center center" data-no-retina>
                      
                       <!-- Layers -->
                       <div class="tp-caption tp-resizeme text-000 font-weight-500 letter-spacing-08"
                           data-x="['left','left','left','center']" data-hoffset="['7','7','7','0']"
                           data-y="['middle','middle','middle','middle']" data-voffset="['-122','-122','-122','-122']"
                           data-fontsize="['18','18','18','18']"
                           data-lineheight="['36','36','36','36']"
                           data-width="full"
                           data-height="none"
                           data-whitespace="normal"
                           data-transform_idle="o:1;"
                           data-transform_in="y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;s:2000;e:Power4.easeInOut;" 
                           data-transform_out="y:[100%];s:1000;e:Power2.easeInOut;s:1000;e:Power2.easeInOut;" 
                           data-mask_in="x:0px;y:[100%];" 
                           data-mask_out="x:inherit;y:inherit;" 
                           data-start="700" 
                           data-splitin="none" 
                           data-splitout="none" 
                           data-responsive_offset="on">
                           In store & Online
                       </div>
                   

                       <div class="tp-caption tp-resizeme text-333 font-weight-500 letter-spacing-3" 

                           data-x="['left','left','left','center']" data-hoffset="['7','7','7','0']"
                           data-y="['middle','middle','middle','middle']" data-voffset="['-62','-62','-62','-62']"
                           data-fontsize="['72','72','72','46']"
                           data-lineheight="['80','80','80','50']"
                           data-width="full"
                           data-height="none"
                           data-whitespace="normal"
                           data-transform_idle="o:1;"
                           data-transform_in="y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;s:2000;e:Power4.easeInOut;" 
                           data-transform_out="y:[100%];s:1000;e:Power2.easeInOut;s:1000;e:Power2.easeInOut;"
                           data-mask_in="x:0px;y:[100%];" 
                           data-mask_out="x:inherit;y:inherit;" 
                           data-start="1000" 
                           data-splitin="none" 
                           data-splitout="none" 
                           data-responsive_offset="on" 
                           style="color: white !important;">
                           BLACK FRIDAY
                       </div>
                   
                       <div class="tp-caption tp-resizeme text-000 font-weight-300 "
                           data-x="['left','left','left','center']" data-hoffset="['7','7','7','0']"
                           data-y="['middle','middle','middle','middle']" data-voffset="['3','3','3','3']"
                           data-fontsize="['20','20','20','20']"
                           data-lineheight="['48','48','48','48']"
                           data-width="full"
                           data-height="none"
                           data-whitespace="normal"
                           data-transform_idle="o:1;"
                           data-transform_in="y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;s:2000;e:Power4.easeInOut;" 
                           data-transform_out="y:[100%];s:1000;e:Power2.easeInOut;s:1000;e:Power2.easeInOut;" 
                           data-mask_in="x:0px;y:[100%];" 
                           data-mask_out="x:inherit;y:inherit;" 
                           data-start="1000" 
                           data-splitin="none" 
                           data-splitout="none" 
                           data-responsive_offset="on"
                           style="color: white !important;">
                           30% SALE  OFF EVERYTHING
                       </div>
                   
                       <div class="tp-caption"
                           data-x="['left','left','left','center']" data-hoffset="['7','7','7','0']"
                           data-y="['middle','middle','middle','middle']" data-voffset="['72','72','72','72']"
                           data-width="full"
                           data-height="none"
                           data-whitespace="normal"
                           data-transform_idle="o:1;"
                           data-transform_in="y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;s:2000;e:Power4.easeInOut;" 
                           data-transform_out="y:[100%];s:1000;e:Power2.easeInOut;s:1000;e:Power2.easeInOut;" 
                           data-mask_in="x:0px;y:[100%];" 
                           data-mask_out="x:inherit;y:inherit;" 
                           data-start="1000" 
                           data-splitin="none" 
                           data-splitout="none" 
                           data-responsive_offset="on">
                           <a href="{{route('shop')}}" class="themesflat-button has-padding-36 bg-accent has-shadow"><span style="color:#fff">SHOP NOW</span></a>
                       </div>
                    </li>
                    <!-- /End Slide 1 -->
                    <!-- Slide 2 -->
                    <li data-transition="random">    
                        <!-- Main Image -->
                        <img src="{{ asset('images/homeslider.jpg') }}" alt="" data-bgposition="center center" data-no-retina>
                       
                        <!-- Layers -->
                        <div class="tp-caption tp-resizeme text-000 font-weight-300 text-right"
                            data-x="['right','right','right','center']" data-hoffset="['172','167','167','0']"
                            data-y="['middle','middle','middle','middle']" data-voffset="['-43','-43','-43','-83']"
                            data-fontsize="['24','24','24','24']"
                            data-lineheight="['72','72','72','72']"
                            data-width="full"
                            data-height="none"
                            data-whitespace="normal"
                            data-transform_idle="o:1;"
                            data-transform_in="y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;s:2000;e:Power4.easeInOut;" 
                            data-transform_out="y:[100%];s:1000;e:Power2.easeInOut;s:1000;e:Power2.easeInOut;" 
                            data-mask_in="x:0px;y:[100%];" 
                            data-mask_out="x:inherit;y:inherit;" 
                            data-start="700" 
                            data-splitin="none" 
                            data-splitout="none" 
                            data-responsive_offset="on"
                            style="color: white !important;">
                            NEW TREND 2024
                        </div>

                        <div class="tp-caption tp-resizeme text-000 font-weight-500 text-right"
                            data-x="['right','right','right','center']" data-hoffset="['5','-5','-5','0']"
                            data-y="['middle','middle','middle','middle']" data-voffset="['8','8','8','0']"
                            data-fontsize="['52','52','52','40']"
                            data-lineheight="['60','60','60','60']"
                            data-width="full"
                            data-height="none"
                            data-whitespace="normal"
                            data-transform_idle="o:1;"
                            data-transform_in="y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;s:2000;e:Power4.easeInOut;" 
                            data-transform_out="y:[100%];s:1000;e:Power2.easeInOut;s:1000;e:Power2.easeInOut;"
                            data-mask_in="x:0px;y:[100%];" 
                            data-mask_out="x:inherit;y:inherit;" 
                            data-start="1000" 
                            data-splitin="none" 
                            data-splitout="none" 
                            data-responsive_offset="on"
                            style="color: white !important;">
                            Women‘s Collection
                        </div>

                        <div class="tp-caption tp-resizeme text-000 font-weight-400 text-right"
                            data-x="['right','right','right','center']" data-hoffset="['120','117','117','0']"
                            data-y="['middle','middle','middle','middle']" data-voffset="['74','77','77','77']"
                            data-fontsize="['18','18','18','16']"
                            data-lineheight="['72','72','72','38']"
                            data-width="full"
                            data-height="none"
                            data-whitespace="normal"
                            data-transform_idle="o:1;"
                            data-transform_in="y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;s:2000;e:Power4.easeInOut;" 
                            data-transform_out="y:[100%];s:1000;e:Power2.easeInOut;s:1000;e:Power2.easeInOut;" 
                            data-mask_in="x:0px;y:[100%];" 
                            data-mask_out="x:inherit;y:inherit;" 
                            data-start="1000" 
                            data-splitin="none" 
                            data-splitout="none" 
                            data-responsive_offset="on"
                            style="color: white !important;">
                            BIG SALE OF THIS WEEK UP TO 30%
                        </div>

                        <div class="tp-caption text-right"
                            data-x="['right','right','right','center']" data-hoffset="['170','170','170','0']"
                            data-y="['middle','middle','middle','middle']" data-voffset="['142','142','142','142']"
                            data-width="full"
                            data-height="none"
                            data-whitespace="normal"
                            data-transform_idle="o:1;"
                            data-transform_in="y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;s:2000;e:Power4.easeInOut;" 
                            data-transform_out="y:[100%];s:1000;e:Power2.easeInOut;s:1000;e:Power2.easeInOut;" 
                            data-mask_in="x:0px;y:[100%];" 
                            data-mask_out="x:inherit;y:inherit;" 
                            data-start="1000" 
                            data-splitin="none" 
                            data-splitout="none" 
                            data-responsive_offset="on">
                            <a href="{{route('shop')}}" class="themesflat-button has-padding-36 bg-accent has-shadow"><span>SHOP NOW</span></a>
                        </div>
                    </li>
                    <!-- /End Slide 2 -->

                    <!-- Slide 3 -->
                    <li data-transition="random">
                        <!-- Main Image -->
                        <img src="{{ asset('images/slider3.jpg') }}" alt="" data-bgposition="center center" data-no-retina>
                       
                        <!-- Layers -->
                        <div class="tp-caption tp-resizeme text-333 font-weight-300 text-right"
                            data-x="['right','right','right','center']" data-hoffset="['172','167','167','0']"
                            data-y="['middle','middle','middle','middle']" data-voffset="['-43','-43','-43','-83']"
                            data-fontsize="['24','24','24','24']"
                            data-lineheight="['72','72','72','72']"
                            data-width="full"
                            data-height="none"
                            data-whitespace="normal"
                            data-transform_idle="o:1;"
                            data-transform_in="y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;s:2000;e:Power4.easeInOut;" 
                            data-transform_out="y:[100%];s:1000;e:Power2.easeInOut;s:1000;e:Power2.easeInOut;" 
                            data-mask_in="x:0px;y:[100%];" 
                            data-mask_out="x:inherit;y:inherit;" 
                            data-start="700" 
                            data-splitin="none" 
                            data-splitout="none" 
                            data-responsive_offset="on"
                            style="color: white !important;">
                            NEW TREND 2024
                        </div>

                        <div class="tp-caption tp-resizeme text-333 font-weight-500 text-right"
                            data-x="['right','right','right','center']" data-hoffset="['5','-5','-5','0']"
                            data-y="['middle','middle','middle','middle']" data-voffset="['8','8','8','0']"
                            data-fontsize="['52','52','52','40']"
                            data-lineheight="['60','60','60','60']"
                            data-width="full"
                            data-height="none"
                            data-whitespace="normal"
                            data-transform_idle="o:1;"
                            data-transform_in="y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;s:2000;e:Power4.easeInOut;" 
                            data-transform_out="y:[100%];s:1000;e:Power2.easeInOut;s:1000;e:Power2.easeInOut;"
                            data-mask_in="x:0px;y:[100%];" 
                            data-mask_out="x:inherit;y:inherit;" 
                            data-start="1000" 
                            data-splitin="none" 
                            data-splitout="none" 
                            data-responsive_offset="on"
                            style="color: white !important;">
                            Women‘s Collection
                        </div>

                        <div class="tp-caption tp-resizeme text-6e6 font-weight-400 text-right"
                            data-x="['right','right','right','center']" data-hoffset="['120','117','117','0']"
                            data-y="['middle','middle','middle','middle']" data-voffset="['74','77','77','77']"
                            data-fontsize="['18','18','18','16']"
                            data-lineheight="['72','72','72','38']"
                            data-width="full"
                            data-height="none"
                            data-whitespace="normal"
                            data-transform_idle="o:1;"
                            data-transform_in="y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;s:2000;e:Power4.easeInOut;" 
                            data-transform_out="y:[100%];s:1000;e:Power2.easeInOut;s:1000;e:Power2.easeInOut;" 
                            data-mask_in="x:0px;y:[100%];" 
                            data-mask_out="x:inherit;y:inherit;" 
                            data-start="1000" 
                            data-splitin="none" 
                            data-splitout="none" 
                            data-responsive_offset="on"
                            style="color: white !important;">
                            BIG SALE OF THIS WEEK UP TO 30%
                        </div>

                        <div class="tp-caption text-right"
                            data-x="['right','right','right','center']" data-hoffset="['170','170','170','0']"
                            data-y="['middle','middle','middle','middle']" data-voffset="['142','142','142','142']"
                            data-width="full"
                            data-height="none"
                            data-whitespace="normal"
                            data-transform_idle="o:1;"
                            data-transform_in="y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;s:2000;e:Power4.easeInOut;" 
                            data-transform_out="y:[100%];s:1000;e:Power2.easeInOut;s:1000;e:Power2.easeInOut;" 
                            data-mask_in="x:0px;y:[100%];" 
                            data-mask_out="x:inherit;y:inherit;" 
                            data-start="1000" 
                            data-splitin="none" 
                            data-splitout="none" 
                            data-responsive_offset="on">
                            <a href="{{route('shop')}}" class="themesflat-button has-padding-36 bg-accent has-shadow"><span>SHOP NOW</span></a>
                        </div>
                    </li>
                    <!-- /End Slide 3 -->

                </ul>
            </div> 
        </div>
        <!-- END SLIDER -->


        <section id="services-section" class="services-section">
        <div class="container">
            <div class="services-list">
            <div class="service-item">
                <div class="service-icon">
                <img src="{{ asset('images/tshirt.png') }}" alt="quality">
                </div>
                <div class="service-heading">HIGH QUALITY</div>
                <div class="service-text">We have been pursuing high standards of product quality.</div>
            </div>
            <div class="service-item">
                <div class="service-icon">
                <img src="{{ asset('images/sewing-machine.png') }}" alt="sewing">
                </div>
                <div class="service-heading">QUALITY IN SEWING</div>
                <div class="service-text">The quality in clothing production and inspection standards.</div>
            </div>
            <div class="service-item">
                <div class="service-icon">
                <img src="{{ asset('images/think-outside-the-box.png') }}" alt="unique">
                </div>
                <div class="service-heading">UNIQUE DESIGN</div>
                <div class="service-text">We have a plan for the design patterns are unique.</div>
            </div>
            <div class="service-item">
                <div class="service-icon">
                <img src="{{ asset('images/bag.png') }}" alt="bag">
                </div>
                <div class="service-heading">FAST DELIVERY</div>
                <div class="service-text">We provide fast transportation.</div>
            </div>
            </div>
        </div>
        </section>



      <!-- IMAGE BOX -->

        <section class="flat-row row-image-box">
            <div class="container">
                <div class="row">
                    @foreach($categories as $category)
                        <div class="col-md-4 col-sm-6 mb-4">
                            <div class="thumb" style="position: relative; overflow: hidden; border-radius: 10px;">
                                <img src="{{ asset('images/back3.jpg') }}" alt="{{ $category->name }}" style="width: 100%; height: 200px; object-fit: cover; border-radius: 10px;">
                                <!-- Overlay Text -->
                                <div style="
                                    position: absolute;
                                    top: 50%;
                                    left: 50%;
                                    transform: translate(-50%, -50%);
                                    color: #39FF14;
                                    font-size: 25px;
                                    font-weight: bold;
                                    text-shadow: 1px 1px 5px rgba(0, 0, 0, 0.7);
                                    text-align: center;
                                    z-index: 2;
                                ">
                                    {{ $category->name }}
                                </div>
                                <!-- Link to Category -->
                                <a href="{{ url('/shop?category=' . urlencode($category->name)) }}" style="
                                    position: absolute;
                                    top: 0;
                                    left: 0;
                                    width: 100%;
                                    height: 100%;
                                    z-index: 1;
                                "></a>
                                <!-- Background Overlay -->
                                <div style="
                                    position: absolute;
                                    top: 0;
                                    left: 0;
                                    width: 100%;
                                    height: 100%;
                                    background: rgba(0, 0, 0, 0.4);
                                    z-index: 0;
                                "></div>
                            </div>
                        </div>
                    @endforeach
                </div>

            </div><!-- /.container -->
        </section>
        <!-- END IMAGE BOX -->


        <!-- PRODUCT -->
        <section class="flat-row row-product-project shop-collection style1">

            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="title-section margin-bottom-41">
                            <h2 class="title">Product</h2>      
                        </div>
                        <!-- Filter by Category -->

                        <div class="container">
                            <ul class="flat-filter style-1 text-center clearfix d-flex flex-wrap justify-content-center align-items-center">
                                <li class="active ">
                                    <a href="{{route('shop')}}" data-filter="*">All Products</a>
                                </li>
                                @foreach($categories as $category)
                                <li class="m-1">

                                    <a href="#" data-filter=".category-{{ $category->id }}">       
                                        {{ $category->name }}
                                    </a>
                                </li>
                                @endforeach
                            </ul>
                        </div>



                       <!-- Product Listing -->
                       <div class="product-content product-fourcolumn clearfix mt-5" >
                            <!-- <ul class="product style2 isotope-product clearfix mt-3" style="display: flex; flex-wrap: wrap; justify-content: center; gap: 15px; padding: 0; margin: 0;">

                                
                            <li class="product-item" style="list-style: none; border-radius: 8px;">
                                <div class="card" style="width: 100%; border: 1px solid #ddd; border-radius: 8px; overflow: hidden; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); transition: transform 0.3s ease;">
                                    <div class="card-image">
                                        <a href="{{route('shop')}}"><img src="{{ asset('images/homeproducts/3D-62.jpg') }}" alt="Product Image" style="width: 100%; height: 280px; object-fit: cover;"></a>
                                    </div>
                                    <div class="card-body" style="padding: 15px; text-align: center;">
                                        <h5 style="font-size: 18px; font-weight: 600; margin-bottom: 3px; color:green">3D-62</h5>

                                    </div>
                                </div>
                            </li>

                            <li class="product-item" style="list-style: none; border-radius: 8px;">
                                <div class="card" style="width: 100%; border: 1px solid #ddd; border-radius: 8px; overflow: hidden; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); transition: transform 0.3s ease;">
                                    <div class="card-image">
                                        <a href="{{route('shop')}}"><img src="{{ asset('images/homeproducts/3D-83.jpg') }}" alt="Product Image" style="width: 100%; height: 280px; object-fit: cover;"></a>
                                    </div>
                                    <div class="card-body" style="padding: 15px; text-align: center;">
                                        <h5 style="font-size: 18px; font-weight: 600; margin-bottom: 3px; color:green">3D-83</h5>
                                    </div>
                                </div>
                            </li>

                            <li class="product-item" style="list-style: none; border-radius: 8px;">
                                <div class="card" style="width: 100%; border: 1px solid #ddd; border-radius: 8px; overflow: hidden; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); transition: transform 0.3s ease;">
                                    <div class="card-image">
                                        <a href="{{route('shop')}}"><img src="{{ asset('images/homeproducts/3D-121.jpg') }}" alt="Product Image" style="width: 100%; height: 280px; object-fit: cover;"></a>
                                    </div>
                                    <div class="card-body" style="padding: 15px; text-align: center;">
                                        <h5 style="font-size: 18px; font-weight: 600; margin-bottom: 3px; color:green">3D-121</h5>
                                    </div>
                                </div>
                            </li>

                            <li class="product-item" style="list-style: none; border-radius: 8px;">
                                <div class="card" style="width: 100%; border: 1px solid #ddd; border-radius: 8px; overflow: hidden; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); transition: transform 0.3s ease;">
                                    <div class="card-image">
                                        <a href="{{route('shop')}}"><img src="{{ asset('images/homeproducts/3D-126.jpg') }}" alt="Product Image" style="width: 100%; height: 280px; object-fit: cover;"></a>
                                    </div>
                                    <div class="card-body" style="padding: 15px; text-align: center;">
                                        <h5 style="font-size: 18px; font-weight: 600; margin-bottom: 3px; color:green">3D-126</h5>
                                    </div>
                                </div>
                            </li>

                            <li class="product-item" style="list-style: none; border-radius: 8px;">
                                <div class="card" style="width: 100%; border: 1px solid #ddd; border-radius: 8px; overflow: hidden; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); transition: transform 0.3s ease;">
                                    <div class="card-image">
                                        <a href="{{route('shop')}}"><img src="{{ asset('images/homeproducts/4D-5.jpg') }}" alt="Product Image" style="width: 100%; height: 280px; object-fit: cover;"></a>
                                    </div>
                                    <div class="card-body" style="padding: 15px; text-align: center;">
                                        <h5 style="font-size: 18px; font-weight: 600; margin-bottom: 3px; color:green">4D-5</h5>
                                    </div>
                                </div>
                            </li>

                            <li class="product-item" style="list-style: none; border-radius: 8px;">
                                <div class="card" style="width: 100%; border: 1px solid #ddd; border-radius: 8px; overflow: hidden; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); transition: transform 0.3s ease;">
                                    <div class="card-image">
                                        <a href="{{route('shop')}}"><img src="{{ asset('images/homeproducts/4D-011.jpg') }}" alt="Product Image" style="width: 100%; height: 280px; object-fit: cover;"></a>
                                    </div>
                                    <div class="card-body" style="padding: 15px; text-align: center;">
                                        <h5 style="font-size: 18px; font-weight: 600; margin-bottom: 3px; color:green">4D-011</h5>
                                    </div>
                                </div>
                            </li>

                            <li class="product-item" style="list-style: none; border-radius: 8px;">
                                <div class="card" style="width: 100%; border: 1px solid #ddd; border-radius: 8px; overflow: hidden; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); transition: transform 0.3s ease;">
                                    <div class="card-image">
                                        <a href="{{route('shop')}}"><img src="{{ asset('images/homeproducts/GR-554.jpg') }}" alt="Product Image" style="width: 100%; height: 280px; object-fit: cover;"></a>
                                    </div>
                                    <div class="card-body" style="padding: 15px; text-align: center;">
                                        <h5 style="font-size: 18px; font-weight: 600; margin-bottom: 3px; color:green">GR-554</h5>
                                    </div>
                                </div>
                            </li>

                            <li class="product-item" style="list-style: none;border-radius: 8px; ">
                                <div class="card" style="width: 100%; border: 1px solid #ddd; border-radius: 8px; overflow: hidden; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); transition: transform 0.3s ease;">
                                    <div class="card-image">
                                        <a href="{{route('shop')}}"><img src="{{ asset('images/homeproducts/GR-607.jpg') }}" alt="Product Image" style="width: 100%; height: 280px; object-fit: cover;"></a>
                                    </div>
                                    <div class="card-body" style="padding: 15px; text-align: center;">
                                        <h5 style="font-size: 18px; font-weight: 600; margin-bottom: 3px; color:green">GR-607</h5>
                                    </div>
                                </div>
                            </li>

                            <li class="product-item" style="list-style: none; border-radius: 8px;">
                                <div class="card" style="width: 100%; border: 1px solid #ddd; border-radius: 8px; overflow: hidden; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); transition: transform 0.3s ease;">
                                    <div class="card-image">
                                        <a href="{{route('shop')}}"><img src="{{ asset('images/homeproducts/GR-672.jpg') }}" alt="Product Image" style="width: 100%; height: 280px; object-fit: cover;"></a>
                                    </div>
                                    <div class="card-body" style="padding: 15px; text-align: center;">
                                        <h5 style="font-size: 18px; font-weight: 600; margin-bottom: 3px; color:green">GR-672</h5>
                                    </div>
                                </div>
                            </li>

                            <li class="product-item" style="list-style: none; border-radius: 8px;">
                                <div class="card" style="width: 100%; border: 1px solid #ddd; border-radius: 8px; overflow: hidden; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); transition: transform 0.3s ease;">
                                    <div class="card-image">
                                        <a href="{{route('shop')}}"><img src="{{ asset('images/homeproducts/GR-744.jpg') }}" alt="Product Image" style="width: 100%; height: 280px; object-fit: cover;"></a>
                                    </div>
                                    <div class="card-body" style="padding: 15px; text-align: center;">
                                        <h5 style="font-size: 18px; font-weight: 600; margin-bottom: 3px; color:green">GR-744</h5>
                                    </div>
                                </div>
                            </li>

                            <li class="product-item" style="list-style: none; border-radius: 8px;">
                                <div class="card" style="width: 100%; border: 1px solid #ddd; border-radius: 8px; overflow: hidden; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); transition: transform 0.3s ease;">
                                    <div class="card-image">
                                        <a href="{{route('shop')}}"><img src="{{ asset('images/homeproducts/HD-107.jpg') }}" alt="Product Image" style="width: 100%; height: 280px; object-fit: cover;"></a>
                                    </div>
                                    <div class="card-body" style="padding: 15px; text-align: center;">
                                        <h5 style="font-size: 18px; font-weight: 600; margin-bottom: 3px; color:green">HD-107</h5>
                                    </div>
                                </div>
                            </li>

                            <li class="product-item" style="list-style: none; border-radius: 8px;">
                                <div class="card" style="width: 100%; border: 1px solid #ddd; border-radius: 8px; overflow: hidden; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); transition: transform 0.3s ease;">
                                    <div class="card-image">
                                        <a href="{{route('shop')}}"><img src="{{ asset('images/homeproducts/4D-11.jpg') }}" alt="Product Image" style="width: 100%; height: 280px; object-fit: cover;"></a>
                                    </div>
                                    <div class="card-body" style="padding: 15px; text-align: center;">
                                        <h5 style="font-size: 18px; font-weight: 600; margin-bottom: 3px; color:green">4D-11</h5>
                                    </div>
                                </div>
                            </li>

                            </ul> -->
                        
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
                                    </div>
                                    <div class="product-info clearfix">
                                        <span class="product-title">{{ $product->product_name }}</span>
                                        <div class="price">
                                            <ins>
                                                <span class="amount" style="color:green;">LKR {{ number_format($product->normal_price, 2) }}</span>
                                            </ins>
                                        </div>
                                    </div>
                                    <div class="add-to-cart text-center"  >
                                        <a href="#" 
                                            style="width:100%; color:black;" 
                                            class="add-to-cart text-center" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#cartModal_{{ $product->product_id }}" 
                                            data-product-id="{{ $product->product_id }}">
                                               <span  style="color:black;"> Add To Cart <i class="ph ph-shopping-cart" ></i> </span>
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
                                    <div class="modal fade" id="cartModal_{{ $product->product_id }}"  tabindex="-1" aria-labelledby="cartModalLabel" aria-hidden="true">
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

                                                            <div class="mt-8 mb-3 product-price d-flex align-items-center">
                                                                <span class="" style="margin-right: 10px;">                                                   
                                                                <h5 class="mb-0">Rs {{ $product->normal_price }}</h5>
                                                                </span>
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

                        
                        
                        
                        
                        
                        </div>

                         
                    </div>
                </div>
                

            </div>
        </div>
    </div>
</section>

        <!-- END PRODUCT -->

        <!-- NEW LATEST -->
        <section class="flat-row row-new-latest">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="title-section margin-bottom-40">
                            <h2 class="title">Latest Blogs</h2>
                        </div>
                        <div class="new-latest-wrap">
                            <div class="flat-new-latest flat-carousel-box post-wrap style3 data-effect clearfix" data-auto="true" data-column="3" data-column2="2" data-column3="1" data-gap="30" > 
                                <div class="">

                                <div class="row">
                                @if ($blogs->isEmpty())
                                    <div class="col-12 text-center">
                                        <p>No blogs available at the moment. Please check back later.</p>
                                    </div>
                                @else
                                    @foreach ($blogs as $blog)

                                    <article class="post clearfix col-md-4 mb-4">
                                        <div class="featured-post data-effect-item">
                                            @php
                                                $media = json_decode($blog->media, true);
                                                $firstMedia = isset($media['images'][0]) 
                                                    ? asset('storage/' . $media['images'][0]) 
                                                    : (isset($media['videos'][0]) 
                                                        ? asset('storage/' . $media['videos'][0]) 
                                                        : null);
                                            @endphp
                                            @if ($firstMedia)
                                                <img src="{{ $firstMedia }}" alt="image" style="width: 100%; height: 300px; object-fit: cover;">
                                            @else
                                                <img src="{{ asset('images/blogdemo.png') }}" alt="image" style="width: 100%; height: 300px; object-fit: cover;">
                                            @endif
                                            <!-- <img src="frontendnew/images/blog/new-lastest-1-370x280.jpg" alt="image"> -->
                                            <div class="content-post text-center">
                                                <div class="title-post">
                                                    <h2><a href="{{ route('blog.show', $blog->id) }}">{{ $blog->title }}</a></h2>
                                                </div><!-- /.title-post -->
                                                <ul class="meta-post">
                                                    <li class="date">
                                                    {{ $blog->created_at->format('M d, Y') }} 
                                                    </li>
                                                    <li class="author">
                                                        <a href="#">BY ADMIN</a>
                                                    </li>                                                
                                                </ul><!-- /.meta-post -->
                                                <div class="entry-post">
                                                    <p>{{ Str::limit($blog->text, 20, '...') }}</p>
                                                    <div class="more-link">
                                                        <a href="{{ route('blog.show', $blog->id) }}">READ MORE</a>
                                                    </div>
                                                </div>
                                            </div><!-- /.content-post -->
                                            <div class="overlay-effect bg-overlay-black"></div>
                                        </div>                                            
                                    </article><!-- /.post -->

                                    @endforeach
                                @endif
                                </div>
                                
                                </div><!-- /.owl-carousel -->                                                            
                            </div>
                        </div>
                            
                    </div>
                </div>
            </div>
        </section>
        <!-- END NEW LATEST -->

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


    @endsection
                               
