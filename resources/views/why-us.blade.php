@extends('layout')

@section('content')
<!-- main-area -->
<main class="fix">

    <!-- breadcrumb-area -->
    <section class="breadcrumb__area breadcrumb__bg" data-background="new1/assets/img/images/choose_img01.jpg">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb__content">
                        <h1 class="title">Our Services</h1>
                        <nav class="breadcrumb">
                            <span property="itemListElement" typeof="ListItem">
                                <a href="/">Home</a>
                            </span>
                            <span class="breadcrumb-separator"><i class="fa-solid fa-arrow-right"></i></span>
                            <span property="itemListElement" typeof="ListItem">Services</span>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- breadcrumb-area-end -->  

    <!-- services-area -->
    <section class="services__area-five grey-bg section-pt-120 section-pb-90">
        <div class="container">
            <div class="row gutter-24 justify-content-center">
                <div class="col-lg-4 col-md-6">
                    <div class="services__item-three">
                        <div class="services__thumb-three">
                            <a href="#"><img src="new1/assets/img/blog/blog_img01.jpg" alt="img"></a>

                        </div>
                        <div class="services__content-three">
                            <div class="services__icon-three">
                                <i class="fa-solid fa-truck-fast"></i>
                            </div>
                            <h4 class="title"><a href="#">Same Day Delivery(SDD) </a></h4>
                            <p>Give Your Customers The Delightful Experience Of Same Day Delivery</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="services__item-three">
                        <div class="services__thumb-three">
                            <a href="#"><img src="new1/assets/img/services/services_img02.jpg"
                                    alt="img"></a>

                        </div>
                        <div class="services__content-three">
                            <div class="services__icon-three">
                                <i class="fa-solid fa-boxes-stacked"></i>
                            </div>
                            <h4 class="title"><a href="#">Next Day Delivery (NDD)</a></h4>
                            <p>The delivery of goods to customers according to the motto “ordered today, delivered tomorrow.</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="services__item-three">
                        <div class="services__thumb-three">
                            <a href="#"><img src="new1/assets/img/services/services_img07.jpg"
                                    alt="img"></a>

                        </div>
                        <div class="services__content-three">
                            <div class="services__icon-three">
                                <i class="fa-solid fa-server"></i>
                            </div>
                            <h4 class="title"><a href="#"> Third-Party Logistics (3PL)</a></h4>
                            <p>We specialize in offering comprehensive third-party logistics services specific requirements.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="services__item-three">
                        <div class="services__thumb-three">
                            <a href="#"><img src="new1/assets/img/services/services_img04.jpg"
                                    alt="img"></a>

                        </div>
                        <div class="services__content-three">
                            <div class="services__icon-three">
                                <i class="fa-solid fa-truck-fast"></i>
                            </div>
                            <h4 class="title"><a href="#">B2B(Bulk Shipping)</a></h4>
                            <p>Heavy shipments, not a problem. Price starts Rs. 7 per kg*.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="services__item-three">
                        <div class="services__thumb-three">
                            <a href="#"><img src="new1/assets/img/services/services_img08.jpg"
                                    alt="img"></a>

                        </div>
                        <div class="services__content-three">
                            <div class="services__icon-three">
                                <i class="fa-solid fa-house-tsunami"></i>
                            </div>
                            <h4 class="title"><a href="#"> Supply Chain Management</a></h4>
                            <p>We do sourcing, design, production, warehousing, shipping, and distribution. </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="services__item-three">
                        <div class="services__thumb-three">
                            <a href="#"><img src="new1/assets/img/services/services_img09.jpg"
                                    alt="img"></a>

                        </div>
                        <div class="services__content-three">
                            <div class="services__icon-three">
                                <i class="fa-solid fa-truck-medical"></i>
                            </div>
                            <h4 class="title"><a href="#"> Operations Management</a></h4>
                            <p>From order processing to inventory control, our comprehensive operations </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="services__item-three">
                        <div class="services__thumb-three">
                            <a href="#"><img src="new1/assets/img/services/services_img09.jpg"
                                    alt="img"></a>

                        </div>
                        <div class="services__content-three">
                            <div class="services__icon-three">
                                <i class="fa-solid fa-truck-arrow-right"></i>
                            </div>
                            <h4 class="title"><a href="#"> Ecomm Management</a></h4>
                            <p> E-commerce, Amazon Self ship service, integration by API with Shopify Ecommerce etc
                                .</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="services__item-three">
                        <div class="services__thumb-three">
                            <a href="#"><img src="new1/assets/img/project/project_img02.jpg"
                                    alt="img"></a>

                        </div>
                        <div class="services__content-three">
                            <div class="services__icon-three">
                                <i class="fa-solid fa-warehouse"></i>
                            </div>
                            <h4 class="title"><a href="#"> Warehousing</a></h4>
                            <p>we store goods for you, till they are ready for Transport.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- services-area-end -->

</main>
<!-- main-area-end -->
@endsection