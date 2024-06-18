@extends('frontend.layouts.frontend')

@section('content')

   <!--========================== Banner Section Start ==========================-->
   <section class="banner">
    <div class="container container-two">
        <div class="position-relative">
            <div class="row">
                <div class="col-lg-6">
                    <div class="banner-inner position-relative">
                        <div class="banner-content">
                            <span class="banner-content__subtitle text-uppercase font-14">FinTech Fusion</span>
                            <h1 class="banner-content__title">Invest today in You <span
                                    class="text-gradient">Dream Home</span> </h1>
                            <p class="banner-content__desc font-18">Unlock the Power of Real Estate Making Your
                                Real Estate Dreams a Reality Real Estate here Unlock the Power of Real Estate
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 order-lg-0 order-1">
                    <div class="banner-thumb">
                        <img src="{{asset('frontend/assets/images/thumbs/banner-img.png')}}" alt="">
                        <img src="{{asset('frontend/assets/images/shapes/shape-triangle.png')}}" alt=""
                            class="shape-element one">
                        <img src="{{asset('frontend/assets/images/shapes/shape-circle.png')}}" alt=""
                            class="shape-element two">
                        <img src="{{asset('frontend/assets/images/shapes/shape-moon.png')}}" alt=""
                            class="shape-element three">
                    </div>
                </div>
                <div class="col-lg-12">
                  
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-rent" role="tabpanel"
                            aria-labelledby="pills-rent-tab" tabindex="0">

                            <div class="filter">
                                <form action="{{ route('properties') }}" method="GET">
                                    <div class="row gy-sm-4 gy-3">
                                        <div class="col-lg-6 col-sm-6 col-xs-6">
                                            <input type="text" name="keyword" class="common-input"
                                                placeholder="Enter Keyword">
                                        </div>
                                       
                                        <div class="col-lg-3 col-sm-6 col-xs-6">
                                            <div class="select-has-icon icon-black">

                                                @php
                                                $propertyTypes = App\Models\Property::all();
                                                $types = array_unique($propertyTypes->pluck('type')->toArray());
                
                                            @endphp
                                                <select class="select common-input" name="location">
                                                    <option value="" disabled>Type</option>
                                                    <option value="all">All</option>
                                                    @foreach ($types as $type )
                                                    <option value="{{ $type }}">{{ $type }}</option>
                                                    @endforeach
                                                   
                                                    
                                                     
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-sm-6 col-xs-6">
                                            <button type="submit" class="btn btn-main w-100">Find
                                                Now</button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                        </div>
                        <div class="tab-pane fade" id="pills-buy" role="tabpanel"
                            aria-labelledby="pills-buy-tab" tabindex="0">

                            <div class="filter">
                                <form action="#">
                                    <div class="row gy-sm-4 gy-3">
                                        <div class="col-lg-3 col-sm-6 col-xs-6">
                                            <input type="text" class="common-input"
                                                placeholder="Enter Keyword">
                                        </div>
                                        <div class="col-lg-3 col-sm-6 col-xs-6">
                                            <div class="select-has-icon icon-black">
                                                <select class="select common-input">
                                                    <option value="1" disabled>Property Type</option>
                                                    <option value="1">Apartment</option>
                                                    <option value="1">House</option>
                                                    <option value="1">Land</option>
                                                    <option value="1">Single Family</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-sm-6 col-xs-6">
                                            <div class="select-has-icon icon-black">
                                                <select class="select common-input">
                                                    <option value="1" disabled>Location</option>
                                                    <option value="1">Bangladesh</option>
                                                    <option value="1">Japan</option>
                                                    <option value="1">Korea</option>
                                                    <option value="1">Singapore</option>
                                                    <option value="1">Germany</option>
                                                    <option value="1">Thailand</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-sm-6 col-xs-6">
                                            <button type="submit" class="btn btn-main w-100">Find
                                                Now</button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                        </div>
                        <div class="tab-pane fade" id="pills-sell" role="tabpanel"
                            aria-labelledby="pills-sell-tab" tabindex="0">

                            <div class="filter">
                                <form action="#">
                                    <div class="row gy-sm-4 gy-3">
                                        <div class="col-lg-3 col-sm-6 col-xs-6">
                                            <input type="text" class="common-input"
                                                placeholder="Enter Keyword">
                                        </div>
                                        <div class="col-lg-3 col-sm-6 col-xs-6">
                                            <div class="select-has-icon icon-black">
                                                <select class="select common-input">
                                                    <option value="1" disabled>Property Type</option>
                                                    <option value="1">Apartment</option>
                                                    <option value="1">House</option>
                                                    <option value="1">Land</option>
                                                    <option value="1">Single Family</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-sm-6 col-xs-6">
                                            <div class="select-has-icon icon-black">
                                                <select class="select common-input">
                                                    <option value="1" disabled>Location</option>
                                                    <option value="1">Bangladesh</option>
                                                    <option value="1">Japan</option>
                                                    <option value="1">Korea</option>
                                                    <option value="1">Singapore</option>
                                                    <option value="1">Germany</option>
                                                    <option value="1">Thailand</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-sm-6 col-xs-6">
                                            <button type="submit" class="btn btn-main w-100">Find
                                                Now</button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--========================== Banner Section End ==========================-->

<!-- ======================== About Section Start ========================== -->
<section class="about padding-y-120">
    <div class="container container-two">
        <div class="row gy-4 align-items-center">
            <div class="col-lg-6">
                <div class="about-thumb">
                    <img src="assets/images/thumbs/about-img.png" alt="">
                    <div class="client-statistics flx-align">
                        <span class="client-statistics__icon">
                            <i class="fas fa-users text-gradient"></i>
                        </span>
                        <div class="client-statistics__content">
                            <h5 class="client-statistics__number statisticsCounter">4,000+</h5>
                            <span class="client-statistics__text fs-18">Satisfied Clients</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="about-content">
                    <div class="section-heading style-left">
                        <span class="section-heading__subtitle"> <span class="text-gradient fw-semibold">About
                                Us</span> </span>
                        <h2 class="section-heading__title">Stay with us feel at home Your perfect stay awaits
                        </h2>
                        <p class="section-heading__desc">Real Estate is a vast industry that deals with the
                            buying, selling, and renting of properties. It inv transactions related to
                            residential</p>
                    </div>
                    <div class="about-box d-flex">
                        <div class="about-box__icon">
                            <img src="assets/images/icons/about-icon.svg" alt="">
                        </div>
                        <div class="about-box__content">
                            <h6 class="about-box__title">Your Dream Home Awaits</h6>
                            <p class="about-box__desc font-13">Real Estate is a vast industry that deals with
                                the buying, selling, and renting of properties. It inv transactions related to
                                residential, commercial, and industrial properties</p>
                        </div>
                    </div>
                    <div class="about-button">
                        <a href="#" class="btn btn-main">Learn More <span class="icon-right"> <i
                                    class="fas fa-arrow-right"></i> </span> </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ======================== About Section End ========================== -->
<!-- ============================ property Start ==================== -->
<section class="property padding-y-120">
    <div class="container container-two">

        <div class="section-heading style-left style-dark flx-between align-items-end gap-3">
            <div class="section-heading__inner">
                <span class="section-heading__subtitle"> <span class="text-gradient fw-semibold">Latest
                        property</span> </span>
                <h2 class="section-heading__title">Prestige Propert Management property for you</h2>
            </div>
            <a href="{{ route('properties')}}" class="btn btn-main">View More <span class="icon-right"> <i
                        class="fas fa-arrow-right"></i> </span> </a>
        </div>

        <div class="row gy-4">

            @foreach ($properties as $property)
            <div class="col-lg-4 col-sm-6">
                <div class="property-item">
                    <div class="property-item__thumb">
                        <a href="{{ route('property', $property->id)}}" class="link">
                            <img src="{{ asset('storage/'.$property->thumbnail) }}"
                                alt="" class="cover-img">
                        </a>
                        <span class="property-item__badge">
                            <a href="{{route('booking', $property->id)}}" class="text-light">Book Now</a>
                        </span>
                    </div>
                    <div class="property-item__content">
                        <h6 class="property-item__price">$ {{ $property->price}} <span class="day">/per day</span> </h6>
                        <h6 class="property-item__title"> <a href="{{ route('property', $property->id)}}"
                                class="link"> {{ $property->name}} </a> </h6>
                        <p class="property-item__location d-flex gap-2"> <span class="icon"> <i
                                    class="fas fa-map-marker-alt"></i></span> {{ $property->address}}
                        </p>
                        <div class="property-item__bottom flx-between gap-2">
                            <ul class="amenities-list flx-align">
                                <li class="amenities-list__item flx-align">
                                    <span class="icon"><i class="fas fa-bed"></i></span>
                                    <span class="text">{{ $property->bedroom}} Beds</span>
                                </li>
                                <li class="amenities-list__item flx-align">
                                    <span class="icon"><i class="fas fa-bath"></i></span>
                                    <span class="text">{{ $property->bathroom}} Baths</span>
                                </li>
                            </ul>
                            <a href="{{route('booking', $property->id)}}" class="simple-btn">Book Now <span class="icon-right"> <i
                                        class="fas fa-arrow-right"></i> </span> </a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
           
            
        </div>
        <div class="text-center property__btn">
            <a href="{{ route('properties')}}" class="btn btn-main"> Sell All Listing <span class="icon-right"> <i
                        class="fas fa-arrow-right"></i> </span> </a>
        </div>
    </div>
</section>
<!-- ============================ property End ==================== -->
<!-- ======================= Property Section Start ================================== -->
<section class="property-type padding-y-120">
    <div class="container container-two">
        <div class="section-heading">
            <span class="section-heading__subtitle bg-gray-100"> <span
                    class="text-gradient fw-semibold">Property Type</span> </span>
            <h2 class="section-heading__title">Let us find the perfect the property for you</h2>
        </div>
        <div class="row gy-4">
            <div class="col-lg-4 col-sm-6 col-xs-6">
                <div class="property-type-item">
                    <span class="property-type-item__icon">
                        <img src="{{ asset('frontend/assets/images/icons/property-type-icon1.svg') }}"
                            alt="">
                    </span>
                    <h6 class="property-type-item__title"> Seamless Solutions Your Success </h6>
                    <p class="property-type-item__desc font-18">Customer satisfaction is crucial for amohlodi
                        business as it leads to customer loyalty loves positive word</p>
                </div>
            </div>
            <div class="col-lg-4 col-sm-6 col-xs-6">
                <div class="property-type-item">
                    <span class="property-type-item__icon">
                        <img src="{{ asset('frontend/assets/images/icons/property-type-icon2.svg') }}"
                            alt="">
                    </span>
                    <h6 class="property-type-item__title"> Proactive Realty Services </h6>
                    <p class="property-type-item__desc font-18">Customer satisfaction is crucial for amohlodi
                        business as it leads to customer loyalty loves positive word</p>
                </div>
            </div>
            <div class="col-lg-4 col-sm-6 col-xs-6">
                <div class="property-type-item">
                    <span class="property-type-item__icon">
                        <img src="{{ asset('frontend/assets/images/icons/property-type-icon3.svg') }}"
                            alt="">
                    </span>
                    <h6 class="property-type-item__title"> Supreme Home Finders </h6>
                    <p class="property-type-item__desc font-18">Customer satisfaction is crucial for amohlodi
                        business as it leads to customer loyalty loves positive word</p>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ======================= Property Section End ================================== -->
<!-- ======================== Video popup Section Start =================== -->
<div class="video-popup ">
    <div class="container container-two">
        <div class="video-popup__thumb">
            <img src="{{ asset('frontend/assets/images/thumbs/video-popup.png') }}" alt=""
                class="cover-img">
            <a href="https://www.youtube.com/watch?v=pPl3ZZdTP3g"
                class="popup-video-link video-popup__button">
                <i class="fas fa-play"></i>
            </a>
        </div>
    </div>
</div>
<!-- ======================== Video popup Section End =================== -->
<!-- ============================= Counter Section Start ======================= -->
<section class="counter padding-y-120">
    <div class="container">
        <div class="row gy-4">
            <div class="col-sm-3 col-6">
                <div class="counter-item position-relative">
                    <h2 class="counter-item__number counter"> 200 </h2>
                    <span class="counter-item__text"> HAPPY PATIENTS </span>
                </div>
            </div>
            <div class="col-sm-3 col-6">
                <div class="counter-item position-relative">
                    <h2 class="counter-item__number counter"> 20 </h2>
                    <span class="counter-item__text"> SAVED HEARTS </span>
                </div>
            </div>
            <div class="col-sm-3 col-6">
                <div class="counter-item position-relative">
                    <h2 class="counter-item__number counter"> 10k </h2>
                    <span class="counter-item__text"> EXPERT DOCTORS </span>
                </div>
            </div>
            <div class="col-sm-3 col-6">
                <div class="counter-item position-relative">
                    <h2 class="counter-item__number counter"> 900 </h2>
                    <span class="counter-item__text"> SERENITY WORK </span>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ============================= Counter Section End ======================= -->
<!-- ========================= Message Section Start ======================== -->
 
<!-- ========================= Message Section End ======================== -->
<!-- ========================= Portfolio Section Start ==================== -->
<section class="portfolio padding-t-120 padding-b-60">
    <div class="section-heading">
        <span class="section-heading__subtitle"> <span class="text-gradient fw-semibold">Latest
                Portfolio</span> </span>
        <h2 class="section-heading__title">Optimum Homes & Properties Realty Experts</h2>
    </div>
    <div class="portfolio-wrapper">
        
        @php
            $portfolios = App\Models\Property::latest()->where('status', 1)->skip(6)->take(5)->get();
        @endphp
        
        @foreach ($portfolios as $portfolio)
        <div class="portfolio-item">
            <div class="portfolio-item__thumb">
                <img src="{{  asset('storage/'.$portfolio->thumbnail) }}" alt=""
                    class="cover-img">
            </div>
            <div class="portfolio-item__content">
                <a href="{{ route('property', $portfolio->id)}}" class="btn btn-icon">
                    <span class="text-gradient line-height-0">
                        <i class="fas fa-arrow-right"></i>
                    </span>
                </a>
                <div class="portfolio-item__inner">
                    <h6 class="portfolio-item__title">
                        <a href="{{ route('property', $portfolio->id)}}" class="link"> {{ $portfolio->name}} </a>
                    </h6>
                    <p class="portfolio-item__desc"> {{ $portfolio->address }} </p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</section>
<!-- ========================= Portfolio Section End ==================== -->
<!-- ==================== Testimonials Section Start ==================== -->
<section class="testimonial padding-y-60">
    <div class="container container-two">
        <div class="section-heading style-left style-flex">
            <div class="section-heading__inner">
                <span class="section-heading__subtitle"> <span class="text-gradient fw-semibold">Client
                        Testimonial</span> </span>
                <h2 class="section-heading__title">Optimum Homes & Properties property for you</h2>
            </div>
            <p class="section-heading__desc">Use receiving accounts a number a currencies and get paid like a
                local Use receivin accounts a number paid the most beautiful think</p>
        </div>
        <div class="testimonial__inner">
            <div class="row">
                <div class="col-lg-6 col-md-8">
                    <div class="testimonial-box">
                        <div class="testimonial-item">
                            <div class="testimonial-item__top flx-between">
                                <div class="testimonial-item__info">
                                    <h6 class="testimonial-item__name">Sakib Fahad</h6>
                                    <span class="testimonial-item__designation">Content Creator</span>
                                </div>
                                <img src="{{ asset('frontend/assets/images/icons/quote.svg') }}"
                                    alt="">
                            </div>
                            <p class="testimonial-item__desc">Their product exceeded his my routi expectations.
                                The the quality and attention to detail a the a moutstanding and it has become
                                an essential most a education the a man who can do tant clearly</p>
                            <ul class="star-rating flx-align justify-content-end">
                                <li class="star-rating__item"><i class="fas fa-star"></i></li>
                                <li class="star-rating__item"><i class="fas fa-star"></i></li>
                                <li class="star-rating__item"><i class="fas fa-star"></i></li>
                                <li class="star-rating__item"><i class="fas fa-star"></i></li>
                                <li class="star-rating__item unabled"><i class="fas fa-star"></i></li>
                            </ul>
                        </div>
                        <div class="testimonial-item">
                            <div class="testimonial-item__top flx-between">
                                <div class="testimonial-item__info">
                                    <h6 class="testimonial-item__name">John Doe</h6>
                                    <span class="testimonial-item__designation">Frontend Developer</span>
                                </div>
                                <img src="{{ asset('frontend/assets/images/icons/quote.svg') }}"
                                    alt="">
                            </div>
                            <p class="testimonial-item__desc">Lorem ipsum dolor sit amet consectetur
                                adipisicing elit. Optio, autem! Consectetur illo tempora sed repudiandae eaque
                                velit expedita, ipsa earum explicabo libero, voluptatibus aliquid odio</p>
                            <ul class="star-rating flx-align justify-content-end">
                                <li class="star-rating__item"><i class="fas fa-star"></i></li>
                                <li class="star-rating__item"><i class="fas fa-star"></i></li>
                                <li class="star-rating__item"><i class="fas fa-star"></i></li>
                                <li class="star-rating__item"><i class="fas fa-star"></i></li>
                                <li class="star-rating__item unabled"><i class="fas fa-star"></i></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="testimonial-thumb">
                        <img src="{{ asset('frontend/assets/images/thumbs/testimonial-img.png') }}"
                            alt="" class="cover-img">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ==================== Testimonials Section End ==================== -->
<!-- ==================== Blog Start Here ==================== -->
<section class="blog padding-t-60 padding-b-120">
    <div class="container container-two">
        <div class="section-heading style-left style-flex flx-between align-items-end gap-3">
            <div class="section-heading__inner">
                <span class="section-heading__subtitle"> <span class="text-gradient fw-semibold">Latest
                        Product</span> </span>
                <h2 class="section-heading__title">Prestige Propert Management property for you</h2>
            </div>
            <a href="{{ route('properties')}}" class="btn btn-outline-main">View More <span class="icon-right"> <i
                        class="fas fa-plus"></i> </span> </a>
        </div>
        <div class="row gy-4">

            @php
            $newProperties = \App\Models\Property::oldest()->where('status', 1)->take(3)->get();
            @endphp

            @foreach ($newProperties as  $property)
                
            
            <div class="col-lg-4 col-sm-6">
                <div class="blog-item">
                    <div class="blog-item__thumb">
                        <a href="{{ route('property', $property->id)}}" class="blog-item__thumb-link">
                            <img src="{{  asset('storage/'.$property->thumbnail) }}"
                                class="cover-img" alt="">
                        </a>
                    </div>
                    <div class="blog-item__inner">
                        <span class="blog-item__date"> 09 <span class="text">Mar</span> </span>
                        <div class="blog-item__content">
                            <ul class="text-list flx-align">
                                <li class="font-12 flx-align gap-3">
                                    <span class="icon"><i class="fas fa-user text-gradient"></i></span>
                                    <a href="#" class="link text-body">By {{ $property->landlord->name}}</a>
                                </li>
                              
                            </ul>
                            <h6 class="blog-item__title">
                                <a href="#" class="blog-item__title-link border-effect">
                                    {{ $property->title}} </a>
                            </h6>
                            <a href="{{ route('booking', $property->id)}}" class="simple-btn text-heading fw-semibold">Book Now
                                <span class="icon-right text-gradient"> <i class="fas fa-plus"></i> </span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
<!-- ==================== Blog End Here ==================== -->

@endsection