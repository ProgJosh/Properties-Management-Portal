@extends('frontend.layouts.frontend')

@section('content') 


<!-- ============================= Contact Top Section Start ======================= -->
<section class="contact-top padding-y-120">
    <div class="container container-two">
        <div class="section-heading">
            <span class="section-heading__subtitle bg-gray-100"> 
                <span class="text-gradient fw-semibold">Contact</span> 
            </span>
            <h2 class="section-heading__title">Contact Us!</h2>
        </div>
        <div class="row gy-4">
            <div class="col-lg-4 col-sm-6">
                <div class="contact-card">
                    <span class="contact-card__icon"><i class="fas fa-paper-plane"></i></span>
                    <h5 class="contact-card__title">Email</h5>
                    <p class="contact-card__text font-18">
                        <a href="mailto:" class="link">joshua27emmanuel30@gmail.com</a>
                    </p>
                    <p class="contact-card__text font-18">
                        <a href="mailto:" class="link">work.jin.manalang@gmail.com</a>
                    </p>
                </div>
            </div>
            <div class="col-lg-4 col-sm-6">
                <div class="contact-card">
                    <span class="contact-card__icon"><i class="fas fa-map-marker-alt"></i></span>
                    <h5 class="contact-card__title">Location</h5>
                    <p class="contact-card__text font-18">
                        Santa Rita, Guagua, Pampanga
                    </p>
                </div>
            </div>
            <div class="col-lg-4 col-sm-6">
                <div class="contact-card">
                    <span class="contact-card__icon"><i class="fas fa-phone"></i></span>
                    <h5 class="contact-card__title">Contacts </h5>
                    <p class="contact-card__text font-18">
                        <a href="mailto:" class="link">09054882023</a>
                    </p>
                    <p class="contact-card__text font-18">
                        <a href="mailto:" class="link">09752162057</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ============================= Contact Top Section End ======================= -->
<div class="contact-map address-map">
<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3854.156161948528!2d120.61966117325451!3d14.984034067577902!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x339658b2f2b874ef%3A0x439e5c3952903128!2sMary%20the%20Queen%20College!5e0!3m2!1sen!2sph!4v1754055974380!5m2!1sen!2sph" width="400" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
</div>


@endsection