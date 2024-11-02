@extends('layout')

@section('content')
<!-- main-area -->
<main class="fix">

    <!-- banner-area -->
    <section class="banner__area banner__bg" data-background="new1/assets/img/banner/banner_bg.jpg">
        <div class="container">
            <div class="row align-items-end">
                <div class="col-lg-6">
                    <div class="banner__content">
                        <span class="sub-title" data-aos="fade-up" data-aos-delay="200">Fastest & Secure Logistics</span>
                        <h2 class="title" data-aos="fade-up" data-aos-delay="400">We're Speedy Gonzales' Cousin, Delivering Joy in a Blink</h2>
                        <p data-aos="fade-up" data-aos-delay="600">A cutting-edge courier aggregator that connects businesses and individuals with reliable delivery services at the click of a button. With a user-friendly app and a network of trusted local and national couriers</p>
                        <a href="/why-us" class="btn" data-aos="fade-up" data-aos-delay="800">Explore Our Services <img src="new1/assets/img/icon/right_arrow.svg" alt="" class="injectable"></a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="banner__img">
                        <img src="new1/assets/img/banner/banner_img01.png" alt="img" data-aos="fade-left" data-aos-delay="800">
                    </div>
                </div>
            </div>
        </div>
        <div class="banner__shape-wrap">
            <img src="new1/assets/img/banner/banner_shape.png" alt="shape" class="rotateme">
            <img src="new1/assets/img/banner/banner_img02.png" alt="img" class="wow bounceInDown" data-wow-delay=".3s">
        </div>
    </section>
    <!-- banner-area-end -->

    <!-- about-area -->
    <section class="about__area pt-120 pb-120">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-lg-6 col-md-8">
                    <div class="about__img">
                        <img src="new1/assets/img/images/about_img01.png" alt="img">
                        <img src="new1/assets/img/images/about_img02.png" alt="img" data-aos="fade-right" data-aos-delay="200">
                        <img src="new1/assets/img/images/about_img03.png" alt="img" data-aos="fade-down" data-aos-delay="400">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="about__content">
                        <div class="section__title mb-15">
                            <span class="sub-title">Reliable Logistic & Transport Solutions</span>
                            <h2 class="title">Delivering the full range of Logistics Solutions</h2>
                        </div>
                        <p>Delivering a full range of logistics solutions involves integrating various services to meet the diverse needs of businesses.</p>
                        <div class="about__content-bottom">
                            <div class="about__list-box-wrap">
                                <div class="about__list-box">
                                    <ul class="list-wrap">
                                        <li><i class="fa-regular fa-circle-check"></i>Domestic Shipping</li>
                                        <li><i class="fa-regular fa-circle-check"></i>International Shipping</li>
                                        <li><i class="fa-regular fa-circle-check"></i>Drop Shipping</li>
                                        <li><i class="fa-regular fa-circle-check"></i>Warehousing</li>
                                    </ul>
                                </div>
                                <a href="#" class="btn">Get in Touch <img src="new1/assets/img/icon/right_arrow.svg" alt="" class="injectable"></a>
                            </div>
                            <div class="about__review-wrap">
                                <div class="about__review-box">
                                    <div class="about__review-author">
                                        <img src="new1/assets/img/images/author01.png" alt="img">
                                        <img src="new1/assets/img/images/author02.png" alt="img">
                                        <img src="new1/assets/img/images/author03.png" alt="img">
                                        <img src="new1/assets/img/images/author04.png" alt="img">
                                    </div>
                                    <div class="review">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                    </div>
                                    <span>Clients 4.7 (1,567 Reviews)</span>
                                </div>
                                <div class="experience__box">
                                    <h4 class="title">7+</h4>
                                    <span>Years Of <br> Experience</span>
                                </div>
                            </div>
                        </div>
                        <div class="shape">
                            <img src="new1/assets/img/images/about_shape.png" alt="shape" data-aos="fade-left" data-aos-delay="1000">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- about-area-end -->

    <!-- brand-area -->
    <div class="brand__area">
        <div class="container">
            <div class="swiper brand-active fix">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="brand__item">
                            <img src="new1/assets/img/logo/bluedart.png" alt="img">
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="brand__item">
                            <img src="new1/assets/img/logo/dtdc.png" alt="img">
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="brand__item">
                            <img src="new1/assets/img/logo/ecom.png" alt="img">
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="brand__item">
                            <img src="new1/assets/img/logo/xpressbee.png" alt="img">
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="brand__item">
                            <img src="new1/assets/img/logo/ekart1.png" alt="img">
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="brand__item">
                            <img src="new1/assets/img/logo/Delhivery1.png" alt="img">
                        </div>
                    </div>
                    <!-- <div class="swiper-slide">
                    <div class="brand__item">
                        <img src="new1/assets/img/brand/brand_img04.png" alt="img">
                    </div>
                </div> -->
                </div>
            </div>
        </div>
    </div>
    <!-- brand-area-end -->

    <!-- services-area -->
    <section class="services__area fix">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <div class="section__title mb-40">
                        <span class="sub-title">OUR BEST SERVICES</span>
                        <h2 class="title">What We Serve</h2>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="view-all-btn text-end mb-40">
                        <a href="#" class="btn btn-two">All Services <img src="new1/assets/img/icon/right_arrow.svg" alt="" class="injectable"></a>
                    </div>
                </div>
            </div>
            <div class="row gutter-24 justify-content-center">
                <div class="col-xl-3 col-lg-4 col-sm-6">
                    <div class="services__item">
                        <div class="services__thumb-wrap">
                            <div class="">
                                <img src="new1/assets/img/services/services_img04.jpg" alt="img">

                            </div>
                            <div class="services__icon">
                                <i class="fa-solid fa-dolly"></i>
                            </div>
                        </div>
                        <div class="services__content">
                            <h3 class="title"><a href="#">Standard Courier </a></h3>
                            <p>Professional Delivery Solutions That Go the Extra Mile</p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4 col-sm-6">
                    <div class="services__item">
                        <div class="services__thumb-wrap">
                            <div class="">
                                <img src="new1/assets/img/services/services_img02.jpg" alt="img">

                            </div>
                            <div class="services__icon">
                                <i class="fa-solid fa-truck-fast"></i>
                            </div>
                        </div>
                        <div class="services__content">
                            <h3 class="title"><a href="#">Express Courier</a></h3>
                            <p>Catchy Deliveries, Unforgettable Experience. Same day Delivery. Next Day Delivery</p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4 col-sm-6">
                    <div class="services__item">
                        <div class="services__thumb-wrap">
                            <div class="">
                                <img src="new1/assets/img/project/project_img02.jpg" alt="img">

                            </div>
                            <div class="services__icon">
                                <i class="fa-solid fa-cart-flatbed"></i>
                            </div>
                        </div>
                        <div class="services__content">
                            <h3 class="title"><a href="#">Drop shipping </a></h3>
                            <p>Gives you access to the trendiest products in the market across a wide range of categories. Choose from a great selection of quality products that are in demand at competitive prices</p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4 col-sm-6">
                    <div class="services__item">
                        <div class="services__thumb-wrap">
                            <div class="">
                                <img src="new1/assets/img/services/services_img03.jpg" alt="img">

                            </div>
                            <div class="services__icon">
                                <i class="fa-solid fa-ship"></i>
                            </div>
                        </div>
                        <div class="services__content">
                            <h3 class="title"><a href="#">International Courier </a></h3>
                            <p>Expand your brand's global footprint by shipping with our extensive worldwide reach. Making Professional Deliveries Our Priority</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="services__shape-wrap">
            <img src="new1/assets/img/services/services_shape01.png" alt="shape" class="rotateme">
            <img src="new1/assets/img/services/services_shape02.png" alt="shape" data-aos="fade-right" data-aos-delay="400">
        </div>
    </section>
    <!-- services-area-end -->
    <style>
        .counter__content .count {
            margin-bottom: 5px;
            font-size: 12px;
        }

        .counter__item {

            margin-bottom: 16px;
        }
    </style>
    <!-- choose-area -->
    <section class="choose__area choose__bg" data-background="new1/assets/img/bg/vector_bg.svg">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-lg-5 col-md-10">
                    <div class="choose__img wow img-custom-anim-left animated" data-wow-duration="1.5s" data-wow-delay="0.2s">
                        <img src="new1/assets/img/images/choose_img01.jpg" alt="img">
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="choose__content">
                        <div class="section__title white-title mb-25">
                            <span class="sub-title">Why Choose Us</span>
                            <h2 class="title">7+ Years Experiences in Courier Service </h2>
                        </div>
                        <div class="choose__content-bottom">
                            <div class="left-side">
                                <p>Fixed prices and no surprises. You focus on your business and leave delivery on our team. We are contactable & responsive. We understand our responsibilities, we listen, suggest and update</p>
                                <a href="/about" class="btn white-btn">To know more About Us <img src="new1/assets/img/icon/right_arrow.svg" alt="" class="injectable"></a>
                            </div>
                            <div class="counter__wrap">
                                <div class="counter__item">
                                    <div class="counter__icon">
                                        <i class="fa-solid fa-truck-fast"></i>
                                    </div>
                                    <div class="counter__content">
                                        <h2 class="count"><span>Innovative and Clever Deliveries Just for Your</span></h2>
                                        <!-- <p>Delivered Goods</p> -->
                                    </div>
                                </div>
                                <div class="counter__item">
                                    <div class="counter__icon">
                                        <i class="fa-solid fa-truck-fast"></i>
                                    </div>
                                    <div class="counter__content">
                                        <h2 class="count"><span>Your Coolest Delivery Partner</span></h2>
                                        <!-- <p>Delivered Goods</p> -->
                                    </div>
                                </div>
                                <div class="counter__item">
                                    <div class="counter__icon">
                                        <i class="fa-solid fa-money-bill"></i>
                                    </div>
                                    <div class="counter__content">
                                        <h2 class="count"><span>Rhyme and Rhyme, We Deliver On Time</span></h2>
                                        <!-- <p>Clients Worldwide</p> -->
                                    </div>
                                </div>
                                <div class="counter__item">
                                    <div class="counter__icon">
                                        <i class="fa-brands fa-servicestack"></i>
                                    </div>
                                    <div class="counter__content">
                                        <h2 class="count"><span>Classy Delivery Solutions Tailored to You</span></h2>
                                        <!-- <p>Clients Worldwide</p> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- choose-area-end -->

    <!-- achieved-area -->
    <section class="achieved__area fix">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6 col-md-10 order-0 order-lg-2">
                    <div class="achieved__img">
                        <img src="new1/assets/img/images/achieved_img.png" alt="img" class="wow bounceInDown" data-wow-delay=".3s">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="achieved__content">
                        <div class="section__title mb-20">
                            <span class="sub-title">What We Achieved!</span>
                            <h2 class="title">We are logistics improving our skills to fulfill delivery of any level!</h2>
                        </div>
                        <p>We believe in continuous improvement. Regular customer meetings, working on their sales, shipping and working on NDR performance is our duty.</p>
                        <div class="progress__wrap">
                            <div class="progress__item">
                                <div class="progress__item-top">
                                    <h3 class="progress__title">Successful Delivery</h3>
                                    <div class="progress-value"><span class="counter-number">82</span>%</div>
                                </div>
                                <div class="progress">
                                    <div class="progress-bar" style="width: 82%;"></div>
                                </div>
                            </div>
                            <div class="progress__item">
                                <div class="progress__item-top">
                                    <h3 class="progress__title">Happy Customers</h3>
                                    <div class="progress-value"><span class="counter-number">90</span>%</div>
                                </div>
                                <div class="progress">
                                    <div class="progress-bar" style="width: 90%;"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="achieved__shape">
            <img src="new1/assets/img/images/achieved_shape.png" alt="shape">
        </div>
    </section>
    <!-- achieved-area-end -->

    <!-- marquee-area -->
    <section class="marquee__area fix">
        <div class="container-fluid p-0">
            <div class="slider__marquee clearfix marquee-wrap">
                <div class="marquee_mode marquee__group">
                    <h6 class="marquee__item">
                        <a href="#"><img src="new1/assets/img/icon/star.svg" alt="" class="injectable"> Air Freight</a>
                    </h6>
                    <h6 class="marquee__item">
                        <a href="#"><img src="new1/assets/img/icon/star.svg" alt="" class="injectable"> Logistics</a>
                    </h6>
                    <h6 class="marquee__item">
                        <a href="#"><img src="new1/assets/img/icon/star.svg" alt="" class="injectable"> Delivery Service</a>
                    </h6>
                    <h6 class="marquee__item">
                        <a href="#"><img src="new1/assets/img/icon/star.svg" alt="" class="injectable"> Tracking</a>
                    </h6>
                    <h6 class="marquee__item">
                        <a href="#"><img src="new1/assets/img/icon/star.svg" alt="" class="injectable"> Warehouse</a>
                    </h6>
                </div>
            </div>
        </div>
    </section>
    <!-- marquee-area-end -->

    <!-- project-area -->
    <section class="project__area project__bg" data-background="new1/assets/img/bg/vector_bg02.svg">
        <div class="container">
            <div class="row align-items-end">
                <div class="col-lg-6 col-md-8">
                    <div class="section__title mb-40">
                        <span class="sub-title">Featured PRODUCTS</span>
                        <h2 class="title">Navigating Miles, Delivering Smiles</h2>
                    </div>
                </div>
                <div class="col-lg-6 col-md-4">
                    <div class="view-all-btn text-end mb-60">
                        <a href="#" class="btn">See All Projects <img src="new1/assets/img/icon/right_arrow.svg" alt="" class="injectable"></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid p-0 fix">
            <div class="project__item-wrap">
                <div class="swiper project-active">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <div class="project__item">
                                <div class="project__thumb">
                                    <a href="#"><img src="new1/assets/img/project/project_img01.jpg" alt="img"></a>
                                </div>
                                <div class="project__content">
                                    <div class="content">
                                        <h2 class="title"><a href="#">Modern Warehouse</a></h2>
                                        <span>Logistics</span>
                                    </div>
                                    <div class="right-arrow">
                                        <a href="#"><img src="new1/assets/img/icon/right_arrow.svg" alt="" class="injectable"></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="project__item">
                                <div class="project__thumb">
                                    <a href="#"><img src="new1/assets/img/project/project_img02.jpg" alt="img"></a>
                                </div>
                                <div class="project__content">
                                    <div class="content">
                                        <h2 class="title"><a href="#">Modern Warehouse</a></h2>
                                        <span>Logistics</span>
                                    </div>
                                    <div class="right-arrow">
                                        <a href="#"><img src="new1/assets/img/icon/right_arrow.svg" alt="" class="injectable"></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="project__item">
                                <div class="project__thumb">
                                    <a href="#"><img src="new1/assets/img/project/project_img03.jpg" alt="img"></a>
                                </div>
                                <div class="project__content">
                                    <div class="content">
                                        <h2 class="title"><a href="#">Smart Warehouse</a></h2>
                                        <span>Logistics</span>
                                    </div>
                                    <div class="right-arrow">
                                        <a href="#"><img src="new1/assets/img/icon/right_arrow.svg" alt="" class="injectable"></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="project__nav"></div>
                </div>
            </div>
        </div>
    </section>
    <!-- project-area-end -->

    <!-- video-area -->
    <section class="video__area">
        <div class="video__bg" data-background="new1/assets/img/bg/video_bg.jpg"></div>
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xl-7 col-lg-6 order-0 order-lg-2">
                    <div class="video__play-btn">
                        <a href="http://www.youtube.com/watch?v=1iIZeIy7TqM" class="play-btn popup-video"><i class="fas fa-play"></i></a>
                    </div>
                </div>
                <div class="col-xl-5 col-lg-6">
                    <div class="video__content">
                        <div class="section__title white-title">
                            <span class="sub-title">Customer Teams & An Agile Services</span>
                            <h2 class="title">We provide the best and fastest courier services nowadays</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- video-area-end -->

    <!-- request-area -->
    <div class="request__area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="request__wrap">
                        <div class="request__nav">
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="request-tab" data-bs-toggle="tab" data-bs-target="#request-tab-pane" type="button" role="tab" aria-controls="request-tab-pane" aria-selected="true"><i class="fa-solid fa-box"></i>Request a Quote</button>
                                </li>
                                <!-- <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="track-tab" data-bs-toggle="tab" data-bs-target="#track-tab-pane" type="button" role="tab" aria-controls="track-tab-pane" aria-selected="false"><i class="fa-solid fa-hourglass-start"></i>Track & Trace</button>
                                </li> -->
                            </ul>
                        </div>
                        <div class="request__tab-wrap">
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane show active" id="request-tab-pane" role="tabpanel" aria-labelledby="request-tab" tabindex="0">
                                    <form action="request-quote" class="request__form" method="post">@csrf
                                        <span class="title">Personal Data</span>
                                        <div class="row gutter-20">
                                            <div class="col-lg-4">
                                                <div class="form-grp">
                                                    <input type="text" placeholder="Name*" name="Name" required>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-grp">
                                                    <input type="email" name="email" placeholder="Enter Email*" required>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-grp">
                                                    <input type="text" name="Mobile" placeholder="Mobile Number*" required>
                                                </div>
                                            </div>
                                        </div>
                                        <span class="title">Shipment Data</span>
                                        <div class="row gutter-20">

                                            <div class="col-lg-6">
                                                <div class="form-grp">
                                                    <input type="text" name="cname" placeholder="Company Name" required>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-grp">
                                                    <input type="text" name="Website" placeholder="Website Link" required>
                                                </div>
                                            </div>
                                            <span class="title">How many orders do you receive in a month?</span>
                                            <div class="col-lg-4">
                                                <div class="form-grp">
                                                    <div class="form-grp select-grp">
                                                        <select class="form-select" name="count" id="count" placeholder="--Select option--" required="">
                                                            <option>--Select option--</option>
                                                            <option value="Setting up new Business">Setting up new Business</option>
                                                            <option value="Between 1 to 10 Orders">Between 1 to 10 Orders</option>
                                                            <option value="11 to 100 Orders">11 to 100 Orders</option>
                                                            <option value="101 to 500 Orders">101 to 500 Orders</option>
                                                            <option value="501 to 1000 Orders">501 to 1000 Orders</option>
                                                            <option value="1000 to 3000 Orders">1000 to 3000 Orders</option>
                                                            <option value="More than 3000 Orders">More than 3000 Orders</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>


                                        </div>

                                        <button type="submit" class="btn">Request a Quote</button>
                                    </form>
                                </div>
                                <!-- <div class="tab-pane" id="track-tab-pane" role="tabpanel" aria-labelledby="track-tab" tabindex="0">
                                    <form action="#" class="request__form">
                                        <span class="title">Shipment Type</span>
                                        <div class="form-grp select-grp">
                                            <select name="interest" class="orderby">
                                                <option value="Incoterms">Incoterms</option>
                                                <option value="Incoterms">Incoterms</option>
                                                <option value="Incoterms">Incoterms</option>
                                            </select>
                                        </div>
                                        <span class="title">Tracking Number</span>
                                        <div class="form-grp">
                                            <textarea name="comment" placeholder="You can enter up to a maximum of 10 airway bill numbers for tracking"></textarea>
                                        </div>
                                        <div class="request__radio-wrap">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault5" checked>
                                                <label class="form-check-label" for="flexRadioDefault5">
                                                    Air Freight
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault6">
                                                <label class="form-check-label" for="flexRadioDefault6">
                                                    Ocean Freight
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault7">
                                                <label class="form-check-label" for="flexRadioDefault7">
                                                    Road Freight
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault8">
                                                <label class="form-check-label" for="flexRadioDefault8">
                                                    Express Delivery
                                                </label>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn">Track & Trace</button>
                                    </form>
                                </div> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- request-area-end -->

    <!-- testimonial-area -->
    <section class="testimonial__area">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-8 col-lg-10">
                    <div class="testimonial__wrap fix">
                        <div class="testimonial__icon">
                            <img src="new1/assets/img/icon/quote.svg" alt="" class="injectable">
                        </div>
                        <div class="testimonial-slider-dot">
                            <div class="swiper testimonial__nav">
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide">
                                        <button><img src="new1/assets/img/images/author01.png" alt="img"></button>
                                    </div>
                                    <div class="swiper-slide">
                                        <button><img src="new1/assets/img/images/author02.png" alt="img"></button>
                                    </div>
                                    <div class="swiper-slide">
                                        <button><img src="new1/assets/img/images/author03.png" alt="img"></button>
                                    </div>
                                    <div class="swiper-slide">
                                        <button><img src="new1/assets/img/images/author04.png" alt="img"></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="swiper testimonial-active">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide">
                                    <div class="testimonial__item">
                                        <div class="testimonial__info">
                                            <h2 class="name">Gaurav Mehta</h2>
                                            <span>CEO, logistex Agency</span>
                                        </div>
                                        <div class="testimonial__rating">
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                        </div>
                                        <div class="testimonial__content">
                                            <p>"Exceptional courier service! I've been consistently impressed with the speed and reliability of deliveries from ShipNick.”</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="testimonial__item">
                                        <div class="testimonial__info">
                                            <h2 class="name">Komal Bhasin</h2>
                                            <span>Brand Owner – R.O.H.C</span>
                                        </div>
                                        <div class="testimonial__rating">
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                        </div>
                                        <div class="testimonial__content">
                                            <p>“ Their commitment to excellence, adaptability, make them an indispensable partner in our E – commerce logistics solutions. Journey so far with them is truly exceptional..”</p>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="testimonial__nav-wrap">
                                <button class="testimonial-button-prev">
                                    <i class="fa-solid fa-angle-left"></i>
                                </button>
                                <button class="testimonial-button-next">
                                    <i class="fa-solid fa-angle-right"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="testimonial__shape">
            <img src="new1/assets/img/images/testimonial_shape.png" alt="img">
        </div>
    </section>
    <!-- testimonial-area-end -->

    <!-- work-area -->
    <section class="work__area work__bg" data-background="new1/assets/img/bg/vector_bg.svg">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="section__title text-center white-title mb-50">
                        <span class="sub-title">HOW IT WORKS</span>
                        <h2 class="title">We have designed our platform to support every online seller, whether you are a startup or selling on market place. Doesn’t matter, you selling Domestic or International, we have solution for you.</h2>
                    </div>
                </div>
            </div>
            <div class="work__item-wrap">
                <div class="row justify-content-center">
                    <div class="col-lg-3 col-sm-6">
                        <div class="work__item">
                            <div class="work__icon">
                                <i class="fa-solid fa-truck-fast"></i>
                                <span class="number">01</span>
                            </div>
                            <div class="work__content">
                                <h4 class="title">Startup’s / Small scale enterprises </h4>
                                <p>Doesn’t matter you are shipping 10 packets a day or 100 packets we will pick and deliver.</p>
                            </div>
                            <div class="work__shape">
                                <img src="new1/assets/img/images/work_shape01.svg" alt="" class="injectable">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="work__item">
                            <div class="work__icon">
                                <i class="fa-solid fa-headset"></i>
                                <span class="number">02</span>
                            </div>
                            <div class="work__content">
                                <h4 class="title">Marketplace Sellers</h4>
                                <p>Selling on Amazon, ebay, etsy etc we have channel integration for you. Link your store and start shipping.</p>
                            </div>
                            <div class="work__shape">
                                <img src="new1/assets/img/images/work_shape02.svg" alt="" class="injectable">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="work__item">
                            <div class="work__icon">
                                <i class="fa-solid fa-earth-americas"></i>
                                <span class="number">03</span>
                            </div>
                            <div class="work__content">
                                <h4 class="title">Sellers on Social Media </h4>
                                <p>Wow ! Selling on Wat’s App and Instagram, boom your business, give your clients COD facility / partial COD facility. We will take care of all your shipping needs.</p>
                            </div>
                            <div class="work__shape">
                                <img src="new1/assets/img/images/work_shape01.svg" alt="" class="injectable">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="work__item">
                            <div class="work__icon">
                                <i class="fa-solid fa-box"></i>
                                <span class="number">04</span>
                            </div>
                            <div class="work__content">
                                <h4 class="title">Drop Shipper </h4>
                                <p>Selling from multiple locations, selling for multiple vendors, selling heavy weight packets. We will not let you down, we are here for you.</p>
                            </div>
                            <div class="work__shape">
                                <img src="new1/assets/img/images/work_shape01.svg" alt="" class="injectable">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</main>
<!-- main-area-end -->
@endsection