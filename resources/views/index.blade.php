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
                    <!--<a href="" class="btn btn-primary rounded-pill py-2 px-4 ms-lg-4">Track Your Order</a>-->
                </div>
            </nav>
  <!-- Carousel Start -->
  <div class="carousel-header">
                <div id="carouselId" class="carousel slide" data-bs-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-bs-target="#carouselId" data-bs-slide-to="0" class="active"></li>
                        <li data-bs-target="#carouselId" data-bs-slide-to="1"></li>
                        <li data-bs-target="#carouselId" data-bs-slide-to="2"></li>
                    </ol>
                    <div class="carousel-inner" role="listbox">
                        <div class="carousel-item active">
                            <img src="img/carousel-2.jpg" class="img-fluid" alt="Image">
                            <div class="carousel-caption">
                                 <div class="row">
                            <div class="col-md-2 ">
                                <div class="p-3">
                                    <img src="img/rmiage2.png" alt="" class="img-fluid" style="height: auto;width:auto;margin-bottom: 2%;">
                                </div>
                            </div>
                            <div class="col-md-3" ></div>
                            <div class="col-md-6">
                                <div class="p-3">
                                    <h1 class="display-2 text-capitalize text-white mb-4">We provide super fast and fuss-free delivery service</h1>
                                    <p class="mb-5 fs-5">We guarantee no complications and refunds in case of damages.
                                    </p>

                                </div>
                            </div>
                        </div>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img src="img/carousel-1.jpg" class="img-fluid" alt="Image">
                            <div class="carousel-caption">
                                <div class="p-3" style="max-width: 900px;">
                                    <h1 class="display-2 text-capitalize text-white mb-4">FAST AND SECURE COURIER FOR ALL YOUR PACKAGES</h1>
                                    <p class="mb-5 fs-5">Cost effective & on time delivery, Our MOTO</p>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img src="img/carousel-3.jpg" class="img-fluid" alt="Image">
                            <div class="carousel-caption">
                                <div class="p-3" style="max-width: 900px;">
                                    <h1 class="display-2 text-capitalize text-white mb-4">WORLD WIDE SHIPPING AND PROFESSIONAL SOLUTIONS</h1>
                                    <p class="mb-5 fs-5">No matter the location we got you covered with our global solutions</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselId" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon btn bg-primary" aria-hidden="false"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselId" data-bs-slide="next">
                        <span class="carousel-control-next-icon btn bg-primary" aria-hidden="false"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
            <!-- Carousel End -->
        </div>
        <div class="container-fluid search-bar position-relative" style="top: -50%; transform: translateY(-50%);">
            <div class="container">
                <div class="position-relative rounded-pill w-100 mx-auto p-5" style="background: rgba(19, 53, 123, 0.8);">
                    <input class="form-control border-0 rounded-pill w-100 py-3 ps-4 pe-5" type="text" placeholder="Track your order">
                    <button type="button" class="btn btn-primary rounded-pill py-2 px-4 position-absolute me-2" style="top: 50%; right: 46px; transform: translateY(-50%);">Search</button>
                </div>
            </div>
        </div>
        <!-- Navbar & Hero End -->

        <!-- About Start -->
        <div class="container-fluid about py-5">
            <div class="container py-5">
                <div class="row g-5 align-items-center">
                    <div class="col-lg-5" style="margin-top: -100px;">
                        <div class="h-100" style="border: 50px solid; border-color: transparent #13357B transparent #13357B;">
                            <img src="img/about-image.jpg" class="img-fluid w-100 h-100" alt="">
                        </div>
                    </div>
                    <div class="col-lg-7" style="background: linear-gradient(rgba(255, 255, 255, .8), rgba(255, 255, 255, .8)), url(img/about-img-1.png);">
                        <h5 class="section-about-title pe-3">About Us</h5>
                        <p class="mb-4">Introducing ShipNick, your innovative solution for seamless courier services. Born from a passion for efficiency and reliability, ShipNick sets sail as a pioneering force in the world of logistics. With a commitment to excellence and customer satisfaction, ShipNick redefines the standards of delivery with its cutting-edge technology and personalized approach.</p>
						<p class="mb-4">At ShipNick, we understand that every package tells a story and every delivery matters. Whether it's a small parcel or a large shipment, we handle each item with precision and care, ensuring it reaches its destination swiftly and securely. Our state-of-the-art tracking system allows you to monitor your shipment every step of the way, providing peace of mind and transparency like never before.</p>						
						<p class="mb-4">What sets ShipNick apart is our dedicated team of professionals who go above and beyond to exceed your expectations. From our courteous customer service representatives to our skilled logistics specialists, every member of the ShipNick family is committed to delivering excellence in every interaction.</p>
						<p class="mb-4">With a focus on sustainability, ShipNick employs eco-friendly practices wherever possible, minimizing our environmental footprint while maximizing efficiency. We believe in creating a brighter future for generations to come, and that commitment shines through in everything we do.</p>
						<p class="mb-4">Experience the difference with ShipNick - where reliability meets innovation, and your satisfaction is our top priority. Join us on this exciting journey as we redefine the world of courier services, one delivery at a time. ShipNick - Delivering Excellence, Every Time.</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- About End -->

        <div class="container-fluid about py-5">
            <div class="container py-5">
                <div class="row g-5 align-items-center">
                    
                    <div class="col-lg-6">
                        <h3 style="margin-top: -100px;">Advanced Logistics Application</h3><br />
						<br />
						<p class="mb-4"><i class="fa fa-arrow-right text-primary me-2"></i>Multi-Carrier Integration</p>
                        <p class="mb-4"><i class="fa fa-arrow-right text-primary me-2"></i>Automated Shipping Processes</p>
						<p class="mb-4"><i class="fa fa-arrow-right text-primary me-2"></i>Centralized Dashboard</p>
						<p class="mb-4"><i class="fa fa-arrow-right text-primary me-2"></i>Customized Shipping Rules</p>
                    </div>
					<div class="col-lg-6" style="margin-top: -100px;">
                        <div class="h-100" style="width: 600px;">
                            <img src="img/dash.png" class="img-fluid w-100 h-100" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Services Start -->
        <div class="container-fluid bg-light service py-5">
            <div class="container py-5">
                <div class="mx-auto text-center mb-5" style="max-width: 900px;">
                    <h5 class="section-title px-3">Choose Us</h5>
                    <h1 class="mb-0">ALL IN ONE SHIPPING SOLUTION</h1>
                </div>
                <div class="row g-4">
                    <div class="col-lg-6">
                        <div class="row g-4">
                            <div class="col-12">
                                <div class="service-content-inner d-flex align-items-center bg-white border border-primary rounded p-4 pe-0">
                                    <div class="service-content text-end">
                                        <h5 class="mb-4">One roof solution for all your logistic needs</h5>
                                        <p class="mb-0">One-roof solution for logistics offers businesses a holistic approach to managing their supply chain and transportation needs, fostering operational efficiency, cost-effectiveness, and customer satisfaction.
                                        </p>
                                    </div>
                                    <div class="service-icon p-4">
                                        <img src="img/one-roof-solution.png" class="img-fluid w-100 h-100" alt="">
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="service-content-inner d-flex align-items-center  bg-white border border-primary rounded p-4 pe-0">
                                    <div class="service-content text-end">
                                        <h5 class="mb-4">Dedicated Account Manager</h5>
                                        <p class="mb-0">Single point of contact to understand the client needs and build relationship and contributing to the overall success of both the client and the company. Yes, we believe in relationship.
                                        </p>
                                    </div>
                                    <div class="service-icon p-4">
                                        <img src="img/dedicated-account-manager.jpeg" class="img-fluid w-100 h-100" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="row g-4">
                            <div class="col-12">
                                <div class="service-content-inner d-flex align-items-center bg-white border border-primary rounded p-4 ps-0">
                                    <div class="service-icon p-4">
                                        <img src="img/automated-shipping-process.jpeg" class="img-fluid w-100 h-100" alt="">
                                    </div>
                                    <div class="service-content">
                                        <h5 class="mb-4">Automated shipping process</h5>
                                        <p class="mb-5">Automated shipping process which can help you to save time and give efficiency in the project
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="service-content-inner d-flex align-items-center bg-white border border-primary rounded p-4 ps-0">
                                    <div class="service-icon p-4">
                                        <img src="img/cod-remmitance.jpeg" class="img-fluid w-100 h-100" alt="">
                                    </div>
                                    <div class="service-content">
                                        <h5 class="mb-4">Quick COD Remittance & Support</h5>
                                        <p class="mb-5">COD orders will not block your money any longer. Get remittance daily.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>	
                </div>
            </div>
        </div>
        <!-- Services End -->

        <!-- Destination Start -->
        
        <!-- Destination End -->

        <!-- Explore Tour Start -->
        
        <!-- Explore Tour Start -->

        <!-- Packages Start -->

        <!-- Packages End -->

        <!-- Gallery Start -->

        <!-- Gallery End -->

        <!-- Tour Booking Start -->
        
        <!-- Tour Booking End -->

        <!-- Travel Guide Start -->
        <div class="container-fluid guide py-5">
            <div class="container py-5">
                <div class="mx-auto text-center mb-5" style="max-width: 900px;">
                    <h5 class="section-title px-3">Clients</h5>
                    <h1 class="mb-0">Satisfied clients</h1>
                </div>
                <div class="row g-4">
                    <div class="col-md-12 col-lg-3">
                        <div class="guide-item">
                            <div class="guide-img">
                                <div class="guide-img-efects">
                                    <img src="img/gaurav.jpg" class="img-fluid w-100 rounded-top" alt="Image">
                                </div>
                                <div class="guide-icon rounded-pill p-2">
                                    <a class="btn btn-square btn-primary rounded-circle mx-1" href=""><i class="fab fa-facebook-f"></i></a>
                                    <a class="btn btn-square btn-primary rounded-circle mx-1" href=""><i class="fab fa-twitter"></i></a>
                                    <a class="btn btn-square btn-primary rounded-circle mx-1" href=""><i class="fab fa-instagram"></i></a>
                                    <a class="btn btn-square btn-primary rounded-circle mx-1" href=""><i class="fab fa-linkedin-in"></i></a>
                                </div>
                            </div>
                            <div class="guide-title text-center rounded-bottom p-4">
                                <div class="guide-title-inner">
                                    <h4 class="mt-3">Gaurav Mehta</h4>
                                    <p class="mb-0">"Exceptional courier service! I've been consistently impressed with the speed and reliability of deliveries from ShipNick.”</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Travel Guide End -->

        <!-- Blog Start -->
<!--        <div class="container-fluid blog py-5">-->
<!--            <div class="container py-5">-->
<!--                <div class="mx-auto text-center mb-5" style="max-width: 900px;">-->
<!--                    <h5 class="section-title px-3">Our Blog</h5>-->
<!--                    <h1 class="mb-4">Popular Blogs</h1>-->
<!--                    <p class="mb-0">Importance of Same day Courier Service – -->
<!--Same day courier service plays a crucial role in various sectors and for different reasons. Here’s why it’s important:-->

<!--                    </p>-->
                    
<!--                </div>-->
<!--                <div class="row g-4 justify-content-center">-->
<!--                    <div class="col-lg-4 col-md-6">-->
<!--                        <div class="blog-item">-->
<!--                            <div class="blog-img">-->
<!--                                <div class="blog-img-inner">-->
<!--                                    <img class="img-fluid w-100 rounded-top" src="img/blog-1.jpg" alt="Image">-->
<!--                                    <div class="blog-icon">-->
<!--                                        <a href="#" class="my-auto"><i class="fas fa-link fa-2x text-white"></i></a>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                                <div class="blog-info d-flex align-items-center border border-start-0 border-end-0">-->
<!--                                    <small class="flex-fill text-center border-end py-2"><i class="fa fa-calendar-alt text-primary me-2"></i>28 Jan 2050</small>-->
<!--                                    <a href="#" class="btn-hover flex-fill text-center text-white border-end py-2"><i class="fa fa-thumbs-up text-primary me-2"></i>1.7K</a>-->
<!--                                    <a href="#" class="btn-hover flex-fill text-center text-white py-2"><i class="fa fa-comments text-primary me-2"></i>1K</a>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="blog-content border border-top-0 rounded-bottom p-4">-->
<!--                                <p class="mb-3">Posted By: Royal Hamblin </p>-->
<!--                                <a href="#" class="h4">The Great Innovators</a>-->
<!--                                <p class="my-3">Tempor erat elitr rebum at clita. Diam dolor diam ipsum sit diam amet diam eos</p>-->
<!--                                <a href="#" class="btn btn-primary rounded-pill py-2 px-4">Read More</a>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                    <div class="col-lg-4 col-md-6">-->
<!--                        <div class="blog-item">-->
<!--                            <div class="blog-img">-->
<!--                                <div class="blog-img-inner">-->
<!--                                    <img class="img-fluid w-100 rounded-top" src="img/blog-2.jpg" alt="Image">-->
<!--                                    <div class="blog-icon">-->
<!--                                        <a href="#" class="my-auto"><i class="fas fa-link fa-2x text-white"></i></a>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                                <div class="blog-info d-flex align-items-center border border-start-0 border-end-0">-->
<!--                                    <small class="flex-fill text-center border-end py-2"><i class="fa fa-calendar-alt text-primary me-2"></i>28 Jan 2050</small>-->
<!--                                    <a href="#" class="btn-hover flex-fill text-center text-white border-end py-2"><i class="fa fa-thumbs-up text-primary me-2"></i>1.7K</a>-->
<!--                                    <a href="#" class="btn-hover flex-fill text-center text-white py-2"><i class="fa fa-comments text-primary me-2"></i>1K</a>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="blog-content border border-top-0 rounded-bottom p-4">-->
<!--                                <p class="mb-3">Posted By: Royal Hamblin </p>-->
<!--                                <a href="#" class="h4">The Story of Civilization</a>-->
<!--                                <p class="my-3">Tempor erat elitr rebum at clita. Diam dolor diam ipsum sit diam amet diam eos</p>-->
<!--                                <a href="#" class="btn btn-primary rounded-pill py-2 px-4">Read More</a>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                    <div class="col-lg-4 col-md-6">-->
<!--                        <div class="blog-item">-->
<!--                            <div class="blog-img">-->
<!--                                <div class="blog-img-inner">-->
<!--                                    <img class="img-fluid w-100 rounded-top" src="img/blog-3.jpg" alt="Image">-->
<!--                                    <div class="blog-icon">-->
<!--                                        <a href="#" class="my-auto"><i class="fas fa-link fa-2x text-white"></i></a>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                                <div class="blog-info d-flex align-items-center border border-start-0 border-end-0">-->
<!--                                    <small class="flex-fill text-center border-end py-2"><i class="fa fa-calendar-alt text-primary me-2"></i>28 Jan 2050</small>-->
<!--                                    <a href="#" class="btn-hover flex-fill text-center text-white border-end py-2"><i class="fa fa-thumbs-up text-primary me-2"></i>1.7K</a>-->
<!--                                    <a href="#" class="btn-hover flex-fill text-center text-white py-2"><i class="fa fa-comments text-primary me-2"></i>1K</a>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="blog-content border border-top-0 rounded-bottom p-4">-->
<!--                                <p class="mb-3">Posted By: Royal Hamblin </p>-->
<!--                                <a href="#" class="h4">Building for Society</a>-->
<!--                                <p class="my-3">Tempor erat elitr rebum at clita. Diam dolor diam ipsum sit diam amet diam eos</p>-->
<!--                                <a href="#" class="btn btn-primary rounded-pill py-2 px-4">Read More</a>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
        <!-- Blog End -->

		<div class="container-fluid destination py-5">
            <div class="container py-5">
                <div class="mx-auto text-center mb-5" style="max-width: 900px;">
                    <h5 class="section-title px-3">FEATURES</h5>
                </div>
                <div class="tab-class text-center">
                    
                    <div class="tab-content">
                        <div id="tab-1" class="tab-pane fade show p-0 active">
                            <div class="row g-4">
                                <div class="col-xl-8">
                                    <div class="row g-4">
                                        <div class="col-lg-6">
                                            <div class="destination-img">
                                                <img class="img-fluid rounded w-100" src="img/features-1.jpeg" alt="">
												<div class="destination-overlay p-4">
                                                    <h4 class="text-white mb-2 mt-3">SMS noticifications</h4>
                                                    <a href="#" class="btn-hover text-white">of packet journey</a>
                                                </div>
                                                <div class="search-icon">
                                                    <a href="img/features-1.jpeg" data-lightbox="destination-1"><i class="fa fa-plus-square fa-1x btn btn-light btn-lg-square text-primary"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="destination-img">
                                                <img class="img-fluid rounded w-100" src="img/features-2.jpeg" alt="">
												<div class="destination-overlay p-4">
                                                    <h4 class="text-white mb-2 mt-3">Advanced management</h4>
                                                    <a href="#" class="btn-hover text-white">for on time delivery</a>
                                                </div>
                                                <div class="search-icon">
                                                    <a href="img/features-2.jpeg" data-lightbox="destination-2"><i class="fa fa-plus-square fa-1x btn btn-light btn-lg-square text-primary"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="destination-img">
                                                <img class="img-fluid rounded w-100" src="img/features-3.jpeg" alt="">
												<div class="destination-overlay p-4">
                                                    <h4 class="text-white mb-2 mt-3">Time bound</h4>
                                                    <a href="#" class="btn-hover text-white">deliveries</a>
                                                </div>                                                
												<div class="search-icon">
                                                    <a href="img/features-3.jpeg" data-lightbox="destination-7"><i class="fa fa-plus-square fa-1x btn btn-light btn-lg-square text-primary"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="destination-img">
                                                <img class="img-fluid rounded w-100" src="img/features-4.jpeg" alt="">
												<div class="destination-overlay p-4">
                                                    <h4 class="text-white mb-2 mt-3">Dedicated</h4>
                                                    <a href="#" class="btn-hover text-white">account manager</a>
                                                </div>                                                
												<div class="search-icon">
                                                    <a href="img/features-4.jpeg" data-lightbox="destination-8"><i class="fa fa-plus-square fa-1x btn btn-light btn-lg-square text-primary"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-4">
                                    <div class="destination-img h-100">
                                        <img class="img-fluid rounded w-100 h-100" src="img/features-5.jpeg" style="object-fit: cover; min-height: 300px;" alt="">
										<div class="destination-overlay p-4">
                                                    <h4 class="text-white mb-2 mt-3">Timely remmitance/Next day</h4>
                                                    <a href="#" class="btn-hover text-white">remmitance facility</a>
                                        </div>
                                        <div class="search-icon">
                                            <a href="img/features-5.jpeg" data-lightbox="destination-4"><i class="fa fa-plus-square fa-1x btn btn-light btn-lg-square text-primary"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="destination-img">
                                        <img class="img-fluid rounded w-100" src="img/features-6.jpeg" alt="">
											<div class="destination-overlay p-4">
                                                    <h4 class="text-white mb-2 mt-3">Accurate tracking</h4>
                                                    <a href="#" class="btn-hover text-white">of packet</a>
                                            </div>                                                
                                        <div class="search-icon">
                                            <a href="img/features-6.jpeg" data-lightbox="destination-4"><i class="fa fa-plus-square fa-1x btn btn-light btn-lg-square text-primary"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="destination-img">
                                        <img class="img-fluid rounded w-100" src="img/features-7.jpeg" alt="">
											<div class="destination-overlay p-4">
                                                    <h4 class="text-white mb-2 mt-3">1 Day/Next</h4>
                                                    <a href="#" class="btn-hover text-white">day delivery</a>
                                            </div>                                        
										<div class="search-icon">
                                            <a href="img/features-7.jpeg" data-lightbox="destination-5"><i class="fa fa-plus-square fa-1x btn btn-light btn-lg-square text-primary"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="destination-img">
                                        <img class="img-fluid rounded w-100" src="img/features-8.jpeg" alt="">
											<div class="destination-overlay p-4">
                                                    <h4 class="text-white mb-2 mt-3">We deliver</h4>
                                                    <a href="#" class="btn-hover text-white">smiles</a>
                                            </div>                                         
										 <div class="search-icon">
                                            <a href="img/features-8.jpeg" data-lightbox="destination-6"><i class="fa fa-plus-square fa-1x btn btn-light btn-lg-square text-primary"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Testimonial Start -->
        <div class="container-fluid testimonial py-5">
            <div class="container py-5">
                <div class="mx-auto text-center mb-5" style="max-width: 900px;">
                    <h5 class="section-title px-3">CARRIER PARTNERS</h5>
                    <h1 class="mb-0">Our Carrier Partners</h1>
                </div>
                <div class="testimonial-carousel owl-carousel">
 
					<div class="testimonial-item text-center rounded pb-4">
                        <div class="testimonial-comment bg-light rounded p-4">
                            <p><img class="img-responsive" alt="partners" src="img/aramex.png" /></p>
                        </div>
                    </div>
                    <div class="testimonial-item text-center rounded pb-4">
                        <div class="testimonial-comment bg-light rounded p-4">
                             <p><img class="img-responsive" alt="partners" src="img/delhivery.jpg" /></p>
                        </div>
                    </div>
                    <div class="testimonial-item text-center rounded pb-4">
                        <div class="testimonial-comment bg-light rounded p-4">
							<p><img class="img-responsive" alt="partners" src="img/bluedart.png" /></p>
                        </div>
                    </div>
                    <div class="testimonial-item text-center rounded pb-4">
                        <div class="testimonial-comment bg-light rounded p-4">
                            <p><img class="img-responsive" alt="partners" src="img/fedex.png" /></p>
                        </div>
                    </div>
					<div class="testimonial-item text-center rounded pb-4">
                        <div class="testimonial-comment bg-light rounded p-4">
                            <p><img class="img-responsive" alt="partners" src="img/shadofax.png" /></p>
                        </div>
                    </div>
					<div class="testimonial-item text-center rounded pb-4">
                        <div class="testimonial-comment bg-light rounded p-4">
                            <p><img class="img-responsive" alt="partners" src="img/ekart.png" /></p>
                        </div>
                    </div>
					<div class="testimonial-item text-center rounded pb-4">
                        <div class="testimonial-comment bg-light rounded p-4">
                            <p><img class="img-responsive" alt="partners" src="img/xpressbees.png" /></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Testimonial End -->
@endsection