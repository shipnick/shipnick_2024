
@extends('layout')

@section('content')
 <!-- Navbar & Hero Start -->
        <div class="container-fluid position-relative p-0">
            <nav class="navbar navbar-expand-lg navbar-light px-4 px-lg-5 py-3 py-lg-0">
                <a href="" class="navbar-brand p-0">
                    <h1 class="m-0"><i class="fa fa-map-marker-alt me-3"></i>Shipnick</h1>
                    <!-- <img src="img/logo.png" alt="Logo"> -->
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                    <span class="fa fa-bars"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <div class="navbar-nav ms-auto py-0">
                        <a href="index" class="nav-item nav-link ">Home</a>
                        <a href="about" class="nav-item nav-link">About Us</a>
                        <a href="why-us" class="nav-item nav-link active">Why Us</a>
                        <a href="#" class="nav-item nav-link">Blog</a>
                        <a href="contact" class="nav-item nav-link">Contact</a>
                    </div>
                    <a href="" class="btn btn-primary rounded-pill py-2 px-4 ms-lg-4">Track Your Order</a>
                </div>
            </nav>
</div>
        <!-- Navbar & Hero End -->

        <!-- Header Start -->
        <div class="container-fluid bg-breadcrumb">
            <div class="container text-center py-5" style="max-width: 900px;">
                <h3 class="text-white display-3 mb-4">Why Us</h1>
                <ol class="breadcrumb justify-content-center mb-0">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Pages</a></li>
                    <li class="breadcrumb-item active text-white">Why Us</li>
                </ol>    
            </div>
        </div>
        <!-- Header End -->

        <!-- About Start -->
    

	<div class="container-fluid about py-5">
        <div class="container py-5">
            <div class="row g-5 align-items-center">
                <div class="col-lg-12">					
						<p class="mb-4">In today's fast-paced world of e-commerce and global trade, efficient shipping solutions are crucial for businesses to thrive. Our all-in-one shipping solution offers a comprehensive platform designed to streamline your shipping processes, reduce costs, and enhance customer satisfaction. Whether you're a small business or a large enterprise, our solution is tailored to meet your shipping needs with precision and reliability.</p>

						
				</div>
			</div>
		</div>
	</div>	
		
	<div class="container-fluid about py-5">
            <div class="container py-5" style="margin-top: -150px;">
                <div class="row g-5 align-items-center">
                    <div class="col-lg-5" style="margin-top: -200px;">
                        <div class="h-100">
                            <img src="img/why-us-1.jpg" class="img-fluid w-100 h-100" alt="">
                        </div>
                    </div>
                    <div class="col-lg-7">
                        <p class="mb-4"><strong>Key Features</strong>:</p>
						<ol class="bullets">
							<li>Multi-Carrier Integration: Our platform integrates seamlessly with leading shipping carriers worldwide, giving you access to a diverse range of shipping options and services. From national postal services to major couriers, we've got you covered.</li>
							<li>Automated Shipping Processes: Say goodbye to manual data entry and repetitive tasks. Our solution automates the shipping process from start to finish, saving you time and minimizing errors. Generate shipping labels, track packages, and manage shipments effortlessly.</li>
							<li>Centralized Dashboard: Monitor all your shipping activities from a centralized dashboard. Gain real-time visibility into shipments, track delivery status, and analyze shipping performance with intuitive reporting tools.</li>
							<li>Rate Comparison and Optimization: Compare shipping rates across multiple carriers to find the most cost-effective shipping solution for your business. Take advantage of negotiated rates and bulk discounts to maximize savings on shipping expenses.</li>
							<li>Customized Shipping Rules: Set up custom shipping rules based on weight, destination, shipping method, and other criteria to automate shipping calculations and ensure accurate shipping charges for your customers.</li>
							<li>International Shipping Support: Expand your global reach with our international shipping capabilities. Easily navigate complex customs regulations, generate customs documentation, and calculate duties and taxes for international shipments.</li>
							<li>Order Management Integration: Seamlessly integrate our shipping solution with your existing order management system or e-commerce platform. Streamline order processing, synchronize inventory levels, and enhance order fulfillment efficiency.</li>
							<li>Customer Communication: Keep your customers informed throughout the shipping process with automated notifications and tracking updates. Build trust and loyalty by providing transparent and proactive communication.</li>
						</ol>
                    </div>
                </div>
            </div>
    </div>	
		
	<div class="container-fluid about py-5">
            <div class="container py-5">
                <div class="row g-5 align-items-center">
                    
                    <div class="col-lg-7" style="background: linear-gradient(rgba(255, 255, 255, .8), rgba(255, 255, 255, .8)), url(img/about-img-1.png);">
                        <p class="mb-4" style="margin-top: -300px;"><strong>Benefits</strong>:</p>
						<ul class="bullets">
							<li>Reduce Shipping Costs: Optimize shipping rates and eliminate unnecessary expenses with our cost-effective shipping solution.</li>
							<li>Improve Efficiency: Automate repetitive tasks and streamline shipping workflows to increase operational efficiency.</li>
							<li>Enhance Customer Experience: Deliver a seamless shipping experience that delights your customers and fosters long-term relationships.</li>
							<li>Scale Your Business: With scalable and flexible shipping solutions, grow your business and expand into new markets with confidence.</li>
						</ul>
                    </div>
					<div class="col-lg-5" style="margin-top: -100px;">
                        <div class="h-100">
                            <img src="img/why-us-2.jpg" class="img-fluid w-100 h-100" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>	
		
		
		
		
    
        <!-- About End -->

        <!-- Travel Guide Start -->
        
        <!-- Travel Guide End -->
@endsection