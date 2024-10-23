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
                        <h1 class="title">Contact Us</h1>
                        <nav class="breadcrumb">
                            <span property="itemListElement" typeof="ListItem">
                                <a href="index.html">Home</a>
                            </span>
                            <span class="breadcrumb-separator"><i class="fa-solid fa-arrow-right"></i></span>
                            <span property="itemListElement" typeof="ListItem">Contact</span>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- breadcrumb-area-end -->

    <!-- contact-area -->
    <section class="contact__area section-py-120">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="contact-map contact-map-two">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3485.9991587583536!2d75.95479517941118!3d29.105706199052793!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x391239120a57b52f%3A0x3d7318132dd0f5e0!2sLal%20Rd%2C%20Hansi%2C%20Haryana%20125033!5e0!3m2!1sen!2sin!4v1729574022659!5m2!1sen!2sin"
                            style="border:0;" allowfullscreen="" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"></iframe>


                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-sm-6">
                    <div class="contact__info-item">
                        <h4 class="title">Corporate Office in Haryana </h4>
                        <p class="info-one">BK Tower, First Floor, Lal Sarak, Hansi., <br> Haryana</p>
                        <h4 class="title"><a href="tel:0123456789">+(91) 9132165478</a></h4>
                        <p class="info-two">Monday – Friday: 9:00-20:00 <br> Saturday: 11:00 – 15:00</p>
                        <a href="mailto:info@shipnick.com">info@shipnick.com</a>
                    </div>
                </div>


            </div>
            <div class="row">
                <div class="col-12">
                    <div class="contact__form-wrap">
                        <h2 class="title">Send Us Message</h2>
                        <form action="new1/assets/mail" class="contact__form" method="POST" id="contact-form">
                            <div class="row gutter-20">
                                <div class="col-lg-4">
                                    <div class="form-grp">
                                        <input type="text" name="name" placeholder="name">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-grp">
                                        <input type="email" name="email" placeholder="E-mail">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-grp">
                                        <input type="tel" name="phone" placeholder="Phone">
                                    </div>
                                </div>
                            </div>
                            <div class="form-grp">
                                <input type="text" name="subject" placeholder="Subject">
                            </div>
                            <div class="form-grp">
                                <textarea name="message" placeholder="Comments"></textarea>
                            </div>
                            <button class="btn red-btn">Send Me Message <img src="new1/assets/img/icon/right_arrow.svg"
                                    alt="" class="injectable"></button>
                        </form>
                        <p class="ajax-response mb-0"></p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- contact-area-end -->

</main>
<!-- main-area-end -->
@endsection