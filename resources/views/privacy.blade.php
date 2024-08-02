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
                        <a href="/" class="nav-item nav-link active">Home</a>
                        <a href="about" class="nav-item nav-link">About Us</a>
                        <a href="why-us" class="nav-item nav-link">Why Us</a>
                        <!--<a href="#" class="nav-item nav-link">Blog</a>-->
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
                <h3 class="text-white display-3 mb-4">Privacy & Refund Policy</h1>
                <ol class="breadcrumb justify-content-center mb-0">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Pages</a></li>
                    <li class="breadcrumb-item active text-white">Privacy & Refund Policy</li>
                </ol>    
            </div>
        </div>
        <!-- Header End -->

        <!-- About Start -->
        
		
    <div class="container-fluid about py-5">
        <div class="container py-5">
            <div class="row g-5 align-items-center">
                <div class="col-lg-12">
					<h3 style="margin-top: -50px;margin-bottom: 30px;">Privacy policy for Ship Nick, A Logistics Company</h3>
						<p class="mb-4">At ShipNick, we are committed to protecting the privacy and security of your personal information. This Privacy Policy outlines how we collect, use, disclose, and safeguard your information when you use our services or interact with our website.</p>
						<p class="mb-4"><strong>1. Information We Collect:</strong></p>
							<ul class="bullets">
								<li>Personal Information: We may collect personal information such as your name, email address, phone number, shipping address, and payment details when you register for an account or use our services.</li>
								<li>Transactional Information: We may collect information related to your transactions, including shipment details, tracking information, and order history.</li>
								<li>Usage Information: We automatically collect information about your interactions with our website and services, including your IP address, browser type, pages visited, and device information.</li>
							</ul>
						<p class="mb-4"><strong>2. How We Use Your Information:</strong></p>
							<ul class="bullets">
								<li>We use your information to provide and improve our services, process transactions, communicate with you, and personalize your experience.</li>
								<li>We may use your information to send you updates, newsletters, promotional offers, and other communications related to our services.</li>
							</ul>
                        <p class="mb-4"><strong>3. Information Sharing:</strong></p>
							<ul class="bullets">
								<li>We may share your information with third-party service providers, business partners, and affiliates who assist us in delivering our services and operating our business.</li>
								<li>We may disclose your information in response to legal requests, to protect our rights or the safety of others, or as required by law.</li>
							</ul>
						<p class="mb-4"><strong>4. Data Security:</strong></p>
							<ul class="bullets">
								<li>We implement appropriate security measures to protect your information from unauthorized access, alteration, disclosure, or destruction.</li>
								<li>Despite our efforts, no data transmission over the internet or method of electronic storage is completely secure. Therefore, we cannot guarantee absolute security.</li>
							</ul>
						<p class="mb-4"><strong>5. Your Choices:</strong></p>
							<ul class="bullets">
								<li>You may choose not to provide certain information, although this may limit your ability to use certain features of our services.</li>
								<li>You can opt out of receiving promotional emails by following the unsubscribe instructions provided in the email.</li>
							</ul>
						<p class="mb-4"><strong>6. Changes to This Privacy Policy:</strong></p>
							<ul class="bullets">
								<li>We may update this Privacy Policy from time to time. We will notify you of any changes by posting the new Privacy Policy on this page.</li>
							</ul>	
						<p class="mb-4"><strong>7. Contact Us:</strong></p>
							<ul class="bullets">
								<li>If you have any questions or concerns about this Privacy Policy or our practices, please contact us at info@shipnick.com
							</ul>	
						<p class="mb-4">By using our website or services, you consent to the collection, use, and disclosure of your information as described in this Privacy Policy.</p>
						<p class="mb-4">Thank you for trusting ShipNick with your logistics needs.</p>
				</div>
				<div class="col-lg-12">
					<h3 style="margin-top: -50px;margin-bottom: 30px;">Refund Policy</h3>
						<p class="mb-4">We are not into sale of any Products. We are courier aggregators, we provide services, courier / Logistics.  So there is 'NO REFUND' in that case. For any further calrification, you can any time reach to us: info@shipnick.com</p>
						
					
				</div>
			</div>
		</div>
	</div>
        <!-- About End -->

        <!-- Travel Guide Start -->
        
        <!-- Travel Guide End -->
@endsection