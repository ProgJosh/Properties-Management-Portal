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
                            <span class="banner-content__subtitle text-uppercase font-14">HOME AWAITS!</span>
                            <h1 class="banner-content__title">Find Your Apartment In<span
                                    class="text-gradient">Guagua, Pampanga</span> </h1>
                            <p class="banner-content__desc font-18">Discover Trusted Rentals in Guagua, Pampanga, 
                                Making Your Apartment Search Effortless
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 order-lg-0 order-1">
                    <div class="banner-thumb">
                        <img src="{{asset('frontend/assets/images/thumbs/banner-img.png')}}" alt="">
                        <img src="{{asset('frontend/assets/images/shapes/shape-triangle.png')}}" alt=""
                            class="shape-element one">
                        {{-- <img src="{{asset('frontend/assets/images/shapes/shape-circle.png')}}" alt=""
                            class="shape-element two"> --}}
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
                                                placeholder="Enter place want to rent">
                                        </div>
                                       
                                        <div class="col-lg-3 col-sm-6 col-xs-6">
                                            <div class="select-has-icon icon-black">

                                                @php
                                                $propertyTypes = App\Models\Property::all();
                                                $types = array_unique($propertyTypes->pluck('type')->toArray());
                
                                            @endphp

                                            
                                                <select class="select common-input" name="barangay">
                                                    <option value="" disabled {{ !request('barangay') ? 'selected' : '' }}>Barangay</option>
                                                    <optgroup label="POBLACION AREA">
                                                    <option value="Bancal" {{ request('barangay') == 'Bancal' ? 'selected' : ''}}>Bancal</option>
                                                    <option value="Plaza Burgos" {{ request('barangay') == 'Plaza Burgos' ? 'selected' : ''}}>Plaza Burgos</option>
                                                    <option value="San Nicolas 1st" {{ request('barangay') == 'San Nicolas 1st' ? 'selected' : ''}}>San Nicolas 1st</option>
                                                    <option value="San Pedro" {{ request('barangay') == 'San Pedro' ? 'selected' : ''}}>San Pedro</option>
                                                    <option value="San Rafael" {{ request('barangay') == 'San Rafael' ? 'selected' : ''}}>San Rafael</option>
                                                    <option value="San Roque" {{ request('barangay') == 'San Roque' ? 'selected' : ''}}>San Roque</option>
                                                    <option value="Santa Filomena" {{ request('barangay') == 'Santa Filomena' ? 'selected' : ''}}>Santa Filomena</option>
                                                    <option value="Santo Cristo" {{ request('barangay') == 'Santo Cristo' ? 'selected' : ''}}>Santo Cristo</option>
                                                    <option value="Santo Niño" {{ request('barangay') == 'Santo Niño' ? 'selected' : ''}}>Santo Niño</option>
                                                </optgroup>
                                                <optgroup label="PANGULO AREA">
                                                    <option value="San Vicente (Ebus)" {{ request('barangay') == 'San Vicente (Ebus)' ? 'selected' : ''}}>San Vicente (Ebus)</option>
                                                    <option value="Lambac" {{ request('barangay') == 'Lambac' ? 'selected' : ''}}>Lambac</option>
                                                    <option value="Magsaysay" {{ request('barangay') == 'Magsaysay' ? 'selected' : ''}}>Magsaysay</option>
                                                    <option value="Maquiapo" {{ request('barangay') == 'Maquiapo' ? 'selected' : ''}}>Maquiapo</option>
                                                    <option value="Natividad" {{ request('barangay') == 'Natividad' ? 'selected' : ''}}>Natividad</option>
                                                    <option value="Pulungmasle" {{ request('barangay') == 'Pulungmasle' ? 'selected' : ''}}>Pulungmasle</option>
                                                    <option value="Rizal" {{ request('barangay') == 'Rizal' ? 'selected' : ''}}>Rizal</option>
                                                    <option value="Ascomo" {{ request('barangay') == 'Ascomo' ? 'selected' : ''}}>Ascomo</option>
                                                    <option value="Jose Abad Santos (Siran)" {{ request('barangay') == 'Jose Abad Santos (Siran)' ? 'selected' : ''}}>Jose Abad Santos (Siran)</option>
                                                </optgroup>
                                                <optgroup label="LOCION AREA">
                                                    <option value="San Pablo" {{ request('barangay') == 'San Pablo' ? 'selected' : ''}}>San Pablo</option>
                                                    <option value="San Juan 1st" {{ request('barangay') == 'San Juan 1st' ? 'selected' : ''}}>San Juan 1st</option>
                                                    <option value="San Jose" {{ request('barangay') == 'San Jose' ? 'selected' : ''}}>San Jose</option>
                                                    <option value="San Matias" {{ request('barangay') == 'San Matias' ? 'selected' : ''}}>San Matias</option>
                                                    <option value="San Isidro" {{ request('barangay') == 'San Isidro' ? 'selected' : ''}}>San Isidro</option>
                                                    <option value="San Antonio" {{ request('barangay') == 'San Antonio' ? 'selected' : ''}}>San Antonio</option>
                                                </optgroup>
                                                <optgroup label="BETIS AREA">
                                                    <option value="San Agustin" {{ request('barangay') == 'San Agustin' ? 'selected' : ''}}>San Agustin</option>
                                                    <option value="San Juan Bautista" {{ request('barangay') == 'San Juan Bautista' ? 'selected' : ''}}>San Juan Bautista</option>
                                                    <option value="San Juan Nepomuceno" {{ request('barangay') == 'San Juan Nepomuceno' ? 'selected' : ''}}>San Juan Nepomuceno</option>
                                                    <option value="San Miguel" {{ request('barangay') == 'San Miguel' ? 'selected' : ''}}>San Miguel</option>
                                                    <option value="San Nicolas 2nd" {{ request('barangay') == 'San Nicolas 2nd' ? 'selected' : ''}}>San Nicolas 2nd</option>
                                                    <option value="Santa Ines" {{ request('barangay') == 'Santa Ines' ? 'selected' : ''}}>Santa Ines</option>
                                                    <option value="Santa Ursula" {{ request('barangay') == 'Santa Ursula' ? 'selected' : ''}}>Santa Ursula</option>
                                                </optgroup>
                                                         
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
                    <img src="{{ asset('frontend/assets/images/thumbs/about-img.png') }}" alt="">
                    <div class="client-statistics flx-align">
                        <span class="client-statistics__icon">
                            <i class="fas fa-users text-gradient"></i>
                        </span>
                        <div class="client-statistics__content">
                            <h5 class="client-statistics__number statisticsCounter">100+</h5>
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
                        <h2 class="section-heading__title">Discover Your Ideal Rental in Guagua, Pampanga
                        </h2>
                        <p class="section-heading__desc">Explore trusted apartment rentals in Guagua, Pampanga
                            and find your perfect home with ease. Simplify your search and settle into a place you'll love. 
                        </p>
                    </div>
                    <div class="about-box d-flex">
                        <div class="about-box__icon">
                            <img src="{{ asset('frontend/assets/images/icons/about-icon.svg') }}" alt="">
                        </div>
                        <div class="about-box__content">
                            <h6 class="about-box__title">Your Dream Home Awaits</h6>
                            <p class="about-box__desc font-13">Your go-to apartment finder for employees, students, and families
                                seeking apartments or other properties around Guagua.Our system streamlines your search, providing
                                detailed listings and essential information to help you find the perfect place effortlessly.
                            </p>
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
                                                Apartment</span> </span>
</span> </span>
                <h2 class="section-heading__title">The Perfect Apartment For You</h2>
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
                            <a href="{{route('booking', $property->id)}}" class="text-light">Rent Now</a>
                        </span>
                    </div>
                    <div class="property-item__content">
                        <h6 class="property-item__price">₱ {{ $property->price}} <span class="day">/per month</span> </h6>
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
                            <a href="{{route('booking', $property->id)}}" class="simple-btn">Rent Now <span class="icon-right"> <i
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
                    class="text-gradient fw-semibold">Apartment Type</span> </span>
            <h2 class="section-heading__title">Let us find the perfect apartment for you</h2>
        </div>
        <div class="row gy-4">
            <div class="col-lg-4 col-sm-6 col-xs-6">
                <div class="property-type-item">
                    <span class="property-type-item__icon">
                        <img src="{{ asset('frontend/assets/images/icons/property-type-icon1.svg') }}"
                            alt="">
                    </span>
                    <h6 class="property-type-item__title"> Explore Listings </h6>
                    <p class="property-type-item__desc font-18">Start by browsing our large database of apartments. Use our advanced search
                        filters to narrow down your options based on location, price, amenities, and more. Each listing includes detailed descriptions,
                    high-quality photos to help you find the apartment that meets your needs. </p>
                </div>
            </div>
            <div class="col-lg-4 col-sm-6 col-xs-6">
                <div class="property-type-item">
                    <span class="property-type-item__icon">
                        <img src="{{ asset('frontend/assets/images/icons/property-type-icon2.svg') }}"
                            alt="">
                    </span>
                    <h6 class="property-type-item__title"> Submit Application </h6>
                    <p class="property-type-item__desc font-18">Once you've found an apartment that catches your eye, submit
                        your application directly through our platform. Track your application status and receive updates as
                        your application is reviewed.
                    </p>
                </div>
            </div>
            <div class="col-lg-4 col-sm-6 col-xs-6">
                <div class="property-type-item">
                    <span class="property-type-item__icon">
                        <img src="{{ asset('frontend/assets/images/icons/property-type-icon3.svg') }}"
                            alt="">
                    </span>
                    <h6 class="property-type-item__title"> Secure Your New Home </h6>
                    <p class="property-type-item__desc font-18">After your application is approved, finalize the lease agreement and
                        any other formalities through our platform. Our streamlined process ensures a hassle-free experience from start to finish.
                        Once everything is in place, you're ready to move into your new apartment and start enjoying your new home.
                    </p>
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
            <img src="{{ asset('frontend/assets/images/thumbs/guagua-apt.png') }}" alt=""
                class="cover-img">
            <a href="https://www.youtube.com/watch?v=v2VhVDSc-9E"
                class="popup-video-link video-popup__button">
                <i class="fas fa-play"></i>
            </a>
        </div>
    </div>
</div>
<!-- ======================== Video popup Section End =================== -->
<!-- ============================= Counter Section Start ======================= -->
{{-- <section class="counter padding-y-120">
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
</section> --}}
<!-- ============================= Counter Section End ======================= -->
<!-- ========================= Message Section Start ======================== -->
 
<!-- ========================= Message Section End ======================== -->
<!-- ========================= Portfolio Section Start ==================== -->
<section class="portfolio padding-t-120 padding-b-60">
    <div class="section-heading">
        <span class="section-heading__subtitle"> <span class="text-gradient fw-semibold">Latest
                Portfolio</span> </span>
        <h2 class="section-heading__title">Optimum Apartments Experts</h2>
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
                <h2 class="section-heading__title">Optimum Apartments for you</h2>
            </div>
            <p class="section-heading__desc">Discover a diverse selection of meticulously curated apartments designed to enhance 
                your lifestyle, whether you're seeking modern amenities, spacious, layouts, or convenient locations. </p>
        </div>
        <div class="testimonial__inner">
            <div class="row">
                <div class="col-lg-6 col-md-8">
                    <div class="testimonial-box">
                        <div class="testimonial-item">
                            <div class="testimonial-item__top flx-between">
                                <div class="testimonial-item__info">
                                    <h6 class="testimonial-item__name">Jin Ashley Manalang</h6>
                                    <span class="testimonial-item__designation">New User</span>
                                </div>
                                <img src="{{ asset('frontend/assets/images/icons/quote.svg') }}"
                                    alt="">
                            </div>
                            <p class="testimonial-item__desc">Finding an apartment in Guagua was effortless with
                                this portal. I highly recommend it to anyone searching for quality rentals in Guagua.
                                </p>
                            <ul class="star-rating flx-align justify-content-end">
                                <li class="star-rating__item"><i class="fas fa-star"></i></li>
                                <li class="star-rating__item"><i class="fas fa-star"></i></li>
                                <li class="star-rating__item"><i class="fas fa-star"></i></li>
                                <li class="star-rating__item"><i class="fas fa-star"></i></li>
                                <li class="star-rating__item"><i class="fas fa-star"></i></li>
                            </ul>
                        </div>
                        <div class="testimonial-item">
                            <div class="testimonial-item__top flx-between">
                                <div class="testimonial-item__info">
                                    <h6 class="testimonial-item__name">Restine Alexandria Baul</h6>
                                    <span class="testimonial-item__designation">New User</span>
                                </div>
                                <img src="{{ asset('frontend/assets/images/icons/quote.svg') }}"
                                    alt="">
                            </div>
                            <p class="testimonial-item__desc">I appreciate how user-friendly and reliable this platform is.
                                From the moment I started using it, I found the interface intuitive and easy to navigate.
                            </p>
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
                                    <h6 class="testimonial-item__name">Angeline Castillo</h6>
                                    <span class="testimonial-item__designation">New User</span>
                                </div>
                                <img src="{{ asset('frontend/assets/images/icons/quote.svg') }}"
                                    alt="">
                            </div>
                            <p class="testimonial-item__desc">The portal helped me discover a perfect apartment
                                near my workplace in Guagua. It's game-changer for anyone looking for quality rentals in this area.
                            </p>
                            <ul class="star-rating flx-align justify-content-end">
                                <li class="star-rating__item"><i class="fas fa-star"></i></li>
                                <li class="star-rating__item"><i class="fas fa-star"></i></li>
                                <li class="star-rating__item"><i class="fas fa-star"></i></li>
                                <li class="star-rating__item"><i class="fas fa-star"></i></li>
                                <li class="star-rating__item"><i class="fas fa-star"></i></li>
                            </ul>
                        </div>
                        <div class="testimonial-item">
                            <div class="testimonial-item__top flx-between">
                                <div class="testimonial-item__info">
                                    <h6 class="testimonial-item__name">Reinian Malit</h6>
                                    <span class="testimonial-item__designation">New User</span>
                                </div>
                                <img src="{{ asset('frontend/assets/images/icons/quote.svg') }}"
                                    alt="">
                            </div>
                            <p class="testimonial-item__desc">I highly recommend this website for its comprehensive listings
                                and easy navigation. The detailed descriptions of each property, coupled with clear photos, gave
                                me a good insights of what to expect before even visiting the apartments.
                            </p>
                            <ul class="star-rating flx-align justify-content-end">
                                <li class="star-rating__item"><i class="fas fa-star"></i></li>
                                <li class="star-rating__item"><i class="fas fa-star"></i></li>
                                <li class="star-rating__item"><i class="fas fa-star"></i></li>
                                <li class="star-rating__item"><i class="fas fa-star"></i></li>
                                <li class="star-rating__item"><i class="fas fa-star"></i></li>
                            </ul>
                        </div>
                        <div class="testimonial-item">
                            <div class="testimonial-item__top flx-between">
                                <div class="testimonial-item__info">
                                    <h6 class="testimonial-item__name">Emmanuel Josh Velo</h6>
                                    <span class="testimonial-item__designation">New User</span>
                                </div>
                                <img src="{{ asset('frontend/assets/images/icons/quote.svg') }}"
                                    alt="">
                            </div>
                            <p class="testimonial-item__desc">Using this website made my staycation found easily in Guagua
                                much smoother than i anticipated. I particularly loved the feature that allows tenants to leave reviews
                                as it gave me idea into the living experience from others.
                            </p>
                            <ul class="star-rating flx-align justify-content-end">
                                <li class="star-rating__item"><i class="fas fa-star"></i></li>
                                <li class="star-rating__item"><i class="fas fa-star"></i></li>
                                <li class="star-rating__item"><i class="fas fa-star"></i></li>
                                <li class="star-rating__item"><i class="fas fa-star"></i></li>
                                <li class="star-rating__item"><i class="fas fa-star"></i></li>
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
                        Apartment</span> </span>
                <h2 class="section-heading__title">The Perfect Apartment for you</h2>
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
                            <a href="{{ route('booking', $property->id)}}" class="simple-btn text-heading fw-semibold">Rent Now
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