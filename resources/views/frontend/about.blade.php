@extends ('frontend.master')

@section('content')

<link rel="stylesheet" href="./frontendnew/stylesheets/aboutus.css">

<!-- Page title -->
<div class="page-title parallax parallax1">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="page-title-heading">
                    <h1 class="title">About Us</h1>
                </div><!-- /.page-title-heading -->
                <div class="breadcrumbs">
                    <ul>
                        <li><a href="{{route('home')}}">Home</a></li>
                        <li><a href="{{route('aboutus')}}">About</a></li>
                    </ul>
                </div><!-- /.breadcrumbs -->
            </div><!-- /.col-md-12 -->
        </div><!-- /.row -->
    </div><!-- /.container -->
</div><!-- /.page-title -->
<!-- ========================= Breadcrumb End =============================== -->



<section class="hero-section">
    <!-- Left Section -->
    <div class="title-section animate-left">
        <h1 class="title">Delivering Happiness <br> On the Go!</h1>
    </div>

    <!-- Right Section -->
    <div class="hero-right animate-right">
        <h2>Welcome to Belvio</h2>
        <p id="intro-text">
            Your ultimate e-commerce destination where innovation, style, and affordability come together. At Belvio, shopping is more than a transaction; it's an experience. Discover a wide range of premium products from top brands like Neon, Blevio, Cripto, and more, all at your fingertips.
        </p>
        <p id="more-text">
            Founded with a focus on customer satisfaction, Belvio is not just another online store. Our mission is to transform your shopping journey by offering handpicked, high-quality items curated to meet standards of quality, durability, and style.
            <br><br>
            Thank you for choosing Belvio. We are thrilled to provide you with an exceptional online shopping experience every time you visit.
        </p>
        <a href="javascript:void(0);" onclick="toggleText()" class="see-more">See More</a>
    </div>
</section>

<!-- ICON BOX -->
<section class="flat-row row-icon-box bg-section bg-color-f5f d-flex justify-content-between">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="flat-icon-box icon-top style-1 clearfix text-center">
                    <div class="inner no-margin">
                        <div class="icon-wrap">
                            <i class="fa fa-truck"></i>
                        </div>
                        <div class="text-wrap">
                            <h5 class="heading">Free & Easy Return</h5>
                        </div>
                    </div>
                </div>
            </div><!-- /.col-md-3 -->

            <div class="col-md-4">
                <div class="flat-icon-box icon-top style-1 clearfix text-center">
                    <div class="inner">
                        <div class="icon-wrap">
                            <i class="fa fa-money"></i>
                        </div>
                        <div class="text-wrap">
                            <h5 class="heading">Safe & Secure Payments</h5>
                        </div>
                    </div>
                </div>
            </div><!-- /.col-md-3 -->

            <div class="col-md-4">
                <div class="flat-icon-box icon-top style-1 clearfix text-center">
                    <div class="inner">
                        <div class="icon-wrap">
                            <i class="fa fa-gift"></i>
                        </div>
                        <div class="text-wrap">
                            <h5 class="heading">Exclusive Offers</h5>
                        </div>
                    </div>
                </div>
            </div><!-- /.col-md-3 -->
        </div>
    </div>
</section>
<!-- END ICON BOX -->

<div class="values-section">
    <div class="values-container">
        <div class="values-left fade-left">
            <div class="values-item">
                <div class="section-title">
                    <img src="images/embrace-change.png" alt="Embrace Change">
                </div>
                <div class="value-description">
                    <h3>Embrace Change</h3>
                    <p>We embrace and anticipate change. Change is growth, and growth is what drives us every day.</p>
                </div>
            </div>
            <div class="values-item">
                <div class="icon">
                    <img src="images/teamwork.png" alt="Teamwork">
                </div>
                <div class="value-description">
                    <h3>Teamwork</h3>
                    <p>We think as a team, work as a team, and grow as a team. The power of our team allows ordinary people to achieve extraordinary things.</p>
                </div>
            </div>
            <div class="values-item">
                <div class="icon">
                    <img src="images/customer.png" alt="Customer Commitment">
                </div>
                <div class="value-description">
                    <h3>Customer Commitment</h3>
                    <p>We believe in giving the best to our customers, sellers, and society.</p>
                </div>
            </div>
        </div>
        <div class="title-section">
            <h2 class="title me-6">Our Values</h2>
        </div>
    </div>
</div>


<section class="mission-vision-section">
    <div class="tabs">
        <!-- Left and Right Tabs -->
        <div class="tab-titles">
            <div class="tab-title active" onclick="openTab('mission')">
                Our Mission
            </div>
            <div class="tab-title" onclick="openTab('vision')">
                Our Vision
            </div>
        </div>

        <!-- Tab Content -->
        <div class="tab-content">
            <div id="mission" class="tab-pane active">
                <p class="text-white">At Belvio, our mission is to enhance the online shopping experience by offering high-quality, affordable products and exceptional customer service. We are dedicated to creating a trusted platform where convenience, quality, and customer satisfaction take priority, ensuring our customers can easily find everything they need in one place. We aim to build lasting relationships with our customers by constantly refining our offerings and staying true to our commitment to excellence.</p>
            </div>

            <div id="vision" class="tab-pane">
                <p class="text-white">Our vision is to become a leader in e-commerce by setting new benchmarks in quality, affordability, and customer experience. We strive to be known not only for our extensive product range but also for our integrity, reliability, and innovation. Through continuous growth, expansion, and the adoption of the latest technology, we aim to transform Belvio into a global shopping hub, helping customers make informed and satisfying choices while simplifying their lives.</p>
            </div>
        </div>
    </div>
</section>

<section class="promise-section">
    <div class="title-section">
        <h2 class="title">Our Promise</h2>
    </div>
    <div class="promise-content">
        <img src="images/aboutus2.jpg" alt="About Us" class="promise-img">

        <div class="promise-items">
            <div class="promise-item">
                <i class="icon">📱</i>
                <div>
                    <strong>Biggest Variety</strong>
                    <p>We offer millions of products at a great value for our customers.</p>
                </div>
            </div>
            <div class="promise-item">
                <i class="icon">💲</i>
                <div>
                    <strong>Best Prices</strong>
                    <p>We provide great value by offering competitive prices on all our products.</p>
                </div>
            </div>
            <div class="promise-item">
                <i class="icon">⚡</i>
                <div>
                    <strong>Ease & Speed</strong>
                    <p>Download the app for a smooth shopping experience.</p>
                </div>
            </div>
            <div class="promise-item">
                <i class="icon">🚚</i>
                <div>
                    <strong>Fast Delivery</strong>
                    <p>We aim to please our customers with fast delivery and easy tracking.</p>
                </div>
            </div>
            <div class="promise-item">
                <i class="icon">🔒</i>
                <div>
                    <strong>100% Protected</strong>
                    <p>We provide 100% protection for your purchase from click to delivery.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const heroText = document.querySelector(".hero-section p");
        setTimeout(() => {
            heroText.style.opacity = "1";
        }, 4000);
    });

    // JavaScript for fade-in animation when elements are in view
    document.addEventListener('DOMContentLoaded', function() {
        const observer = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('in-view');
                    observer.unobserve(entry.target);
                }
            });
        }, {
            threshold: 0.5
        });

        const promiseItems = document.querySelectorAll('.promise-item');
        const promiseImg = document.querySelector('.promise-img');

        promiseItems.forEach(item => observer.observe(item));
        observer.observe(promiseImg);
    });

    function openTab(tabName) {
        // Hide all tab panes
        const allTabs = document.querySelectorAll('.tab-pane');
        allTabs.forEach(tab => tab.classList.remove('active'));

        // Show the selected tab pane
        const selectedTab = document.getElementById(tabName);
        selectedTab.classList.add('active');

        // Update the tab title state
        const allTitles = document.querySelectorAll('.tab-title');
        allTitles.forEach(title => title.classList.remove('active'));
        const activeTitle = document.querySelector(`.tab-title[onclick="openTab('${tabName}')"]`);
        activeTitle.classList.add('active');
    }

    // Set default active tab
    openTab('mission');

    document.addEventListener("DOMContentLoaded", function() {
        // Select all icon boxes
        const iconBoxes = document.querySelectorAll('.flat-icon-box');

        // Set up the intersection observer options
        const observerOptions = {
            root: null, // Default is the viewport
            rootMargin: "0px",
            threshold: 0.5 // Trigger when 50% of the element is in the viewport
        };

        // Define the observer callback function
        const observerCallback = (entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    // Add the visible class to trigger animation
                    entry.target.classList.add('visible');
                    observer.unobserve(entry.target); // Stop observing after animation triggers
                }
            });
        };

        // Create the intersection observer
        const observer = new IntersectionObserver(observerCallback, observerOptions);

        // Observe each icon box
        iconBoxes.forEach(iconBox => {
            iconBox.classList.add('icon-box-animation'); // Add initial class for animation
            observer.observe(iconBox);
        });
    });

    function toggleText() {
        var moreText = document.getElementById("more-text");
        var linkText = document.querySelector("a");

        // Toggle the display of the extra text
        if (moreText.style.display === "none" || moreText.style.display === "") {
            moreText.style.display = "block";
            linkText.textContent = "See Less";
        } else {
            moreText.style.display = "none";
            linkText.textContent = "See More";
        }
    }

    document.addEventListener("DOMContentLoaded", function() {
        const heroText = document.querySelectorAll(".hero-right p");
        heroText.forEach((p, index) => {
            setTimeout(() => {
                p.style.opacity = "1";
            }, index * 1000);
        });
    });
</script>
@endsection