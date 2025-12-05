@extends('frontend.layouts.frontend')

@section('content')
    <!-- ==================== Breadcrumb Start Here ==================== -->
    <section class="breadcrumb padding-y-120">
        <img src="{{ asset('frontend/assets/images/thumbs/breadcrumb-img.png') }}" alt="" class="breadcrumb__img">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="breadcrumb__wrapper">
                        <h2 class="breadcrumb__title"> Property Details</h2>
                        <ul class="breadcrumb__list">
                            <li class="breadcrumb__item"><a href="index.html" class="breadcrumb__link"> <i
                                        class="las la-home"></i> Home</a> </li>
                            <li class="breadcrumb__item"><i class="fas fa-angle-right"></i></li>
                            <li class="breadcrumb__item"> <span class="breadcrumb__item-text"> Property Details </span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ==================== Breadcrumb End Here ==================== -->

    <section class="property-details padding-y-120">
        <div class="container container-two">
            <div class="row gy-4">
                <div class="col-lg-8">
                    <div class="row gy-4">
                        <div class="col-sm-12 col-6">
                            <div class="property-details__thumb">
                                <img src="{{ asset('storage/' . $property->thumbnail) }}" alt="" class="cover-img">
                            </div>
                        </div>


                        @foreach ($property->gallery as $img)
                            <div class="col-sm-4 col-6">
                                <div class="property-details__thumb">
                                    <img src="{{ asset('storage/' . $img->image) }}" alt="" class="cover-img">
                                </div>
                            </div>
                        @endforeach

                        <div class="row property-item__content" >
                            <div class="col-md-8 ">
                                <h4>{{ $property->name }} </h4> 
                                <h4 class="property-item__price text-dark"> Price: ₱{{ $property->price }}
                                    <span class="day">/per month</span>
                                </h4>
                                <p class="text-gray-800">{{ $property->description }}</p>
                            </div>

                            <div class="col-md-4">
                               <a href="{{route('booking', $property->id)}}" class="btn btn-main text-uppercase float-end"> Rent Now</a>
                            </div>
                        </div>

                        


                    </div>
                    <div class="property-details-wrapper">
                        <div class="property-details-item">
                            <h6 class="property-details-item__title">Preview</h6>
                            <div class="property-details-item__content">
                                <div class="row gy-4 gy-lg-5">

                                    <div class="col-sm-4 col-6">
                                        <div class="amenities-content d-flex align-items-center">
                                            <span class="amenities-content__icon">
                                                <img src="{{ asset('frontend/assets/images/icons/amenities2.svg') }}"
                                                    alt="">
                                            </span>
                                            <div class="amenities-content__inner">
                                                <span class="amenities-content__text">Bed</span>
                                                <h6 class="amenities-content__title mb-0 font-16"> {{ $property->bedroom }}
                                                    Beds</h6>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-4 col-6">
                                        <div class="amenities-content d-flex align-items-center">
                                            <span class="amenities-content__icon">
                                                <img src="{{ asset('frontend/assets/images/icons/amenities3.svg') }}"
                                                    alt="">
                                            </span>
                                            <div class="amenities-content__inner">
                                                <span class="amenities-content__text">Bath</span>
                                                <h6 class="amenities-content__title mb-0 font-16">{{ $property->bathroom }}
                                                    Baths</h6>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-4 col-6">
                                        <div class="amenities-content d-flex align-items-center">
                                            <span class="amenities-content__icon">
                                                <img src="{{ asset('frontend/assets/images/icons/amenities6.svg') }}"
                                                    alt="">
                                            </span>
                                            <div class="amenities-content__inner">
                                                <span class="amenities-content__text"> Acommodation</span>
                                                <h6 class="amenities-content__title mb-0 font-16"> {{ $property->accommodation }} Person
                                                </h6>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-4 col-6">
                                        <div class="amenities-content d-flex align-items-center">
                                            <span class="amenities-content__icon">
                                                <img src="{{ asset('frontend/assets/images/icons/amenities1.svg') }}"
                                                    alt="">
                                            </span>
                                            <div class="amenities-content__inner">
                                                <span class="amenities-content__text">Floor</span>
                                                <h6 class="amenities-content__title mb-0 font-16">{{ $property->floor }}
                                                    floor</h6>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4 col-6">
                                        <div class="amenities-content d-flex align-items-center">
                                            <span class="amenities-content__icon">
                                                <img src="{{ asset('frontend/assets/images/icons/amenities5.svg') }}"
                                                    alt="">
                                            </span>
                                            <div class="amenities-content__inner">
                                                <span class="amenities-content__text">Garage</span>
                                                <h6 class="amenities-content__title mb-0 font-16">
                                                    {{ $property->garage ? 'Yes' : 'No' }}</h6>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-4 col-6">
                                        <div class="amenities-content d-flex align-items-center">
                                            <span class="amenities-content__icon">
                                                <img src="{{ asset('frontend/assets/images/icons/amenities4.svg') }}"
                                                    alt="">
                                            </span>
                                            <div class="amenities-content__inner">
                                                <span class="amenities-content__text">Pet Friendly</span>
                                                <h6 class="amenities-content__title mb-0 font-16">
                                                    {{ $property->pet_friendly ? 'Yes' : 'No' }}</h6>
                                            </div>
                                        </div>
                                    </div>


                              
                                    <div class="col-sm-4 col-6">
                                        <div class="amenities-content d-flex align-items-center">
                                            <span class="amenities-content__icon">
                                                <img src="{{ asset('frontend/assets/images/icons/amenities6.svg') }}"
                                                    alt="">
                                            </span>
                                            <div class="amenities-content__inner">
                                                <span class="amenities-content__text">Property Type</span>
                                                <h6 class="amenities-content__title mb-0 font-16"> {{ $property->type }}
                                                </h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="property-details-item">
                            <h6 class="property-details-item__title">Features</h6>
                            <div class="property-details-item__content">
                                <div class="row gy-2">
                                    <div class="col-sm-6">
                                        <ul class="check-list">

                                            @php
                                                $features = explode(',', $property->facility);
                                                $firstThreeFeatures = array_slice($features, 0, 4);
                                                $remainingFeatures = array_slice($features, 4);

                                            @endphp

                                            @foreach ($firstThreeFeatures as $feature)
                                                <li class="check-list__item d-flex align-items-center">
                                                    <span class="icon"><i class="fas fa-check"></i></span>
                                                    <span class="text"> {{ $feature }}</span>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    <div class="col-sm-6">
                                        <ul class="check-list">

                                            @foreach ($remainingFeatures as $feature)
                                                <li class="check-list__item d-flex align-items-center">
                                                    <span class="icon"><i class="fas fa-check"></i></span>
                                                    <span class="text"> {{ $feature }}</span>
                                                </li>
                                            @endforeach

                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="property-details-item">
                            <h6 class="property-details-item__title">Address</h6>
                            <div class="property-details-item__content">
                                <div class="row gy-4">
                                    <div class="col-6">
                                        <div class="address-content d-flex gap-4 align-items-center">
                                            <span class="address-content__text font-18">Address</span>
                                            <h6 class="address-content__title font-15 mb-0">{{ $property->address }}</h6>
                                        </div>
                                    {{-- </div>
                                    <div class="col-6">
                                        <div class="address-content d-flex gap-4 align-items-center">
                                            <span class="address-content__text font-18">Code</span>
                                            <h6 class="address-content__title font-15 mb-0">2365</h6>
                                        </div>
                                    </div> --}}
                                </div>
                                <div class="address-map">
                                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d16012953.819244199!2d111.93887189775869!3d11.522235062297884!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x324053215f87de63%3A0x784790ef7a29da57!2sPhilippines!5e0!3m2!1sen!2sus!4v1718996100487!5m2!1sen!2sus" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                                </div>
                            </div>
                        </div>
                        <div class="property-details-item">
                            <h6 class="property-details-item__title">House</h6>
                            <div class="property-details-item__content">
                                <div class="house-content position-relative">
                                    <img src="assets/images/thumbs/house.png" alt="">
                                    <a href="https://www.youtube.com/watch?v=pPl3ZZdTP3g"
                                        class="popup-video-link video-popup__button style-two">
                                        <i class="fas fa-play text-gradient"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="common-sidebar-wrapper">
                        <div class="common-sidebar">
                            <h6 class="common-sidebar__title mb-1"> Contact with landload</h6>
                            <a href="https://wa.me/{{ $property->landlord->phone }}" target="_blank" class="font-36 text-decoration-none"><i class="fab fa-whatsapp-square"></i> </a>

                            <h6 class="common-sidebar__title mt-3"> Property Types </h6>
                            <ul class="category-list">


                                @php
                                    $properties = App\Models\Property::all();
                                   $types = array_unique($properties->pluck('type')->toArray());
                                 
                                     
                                @endphp

                                @foreach ($types as $type)
                                <li class="category-list__item">
                                    <a href="{{ route('propertyByType', $type)}}" class="category-list__link flx-between">
                                        <span class="text"> {{ $type }}</span>
                                        <span class="number">( {{ App\Models\Property::where('type', $type)->count()}})</span>
                                    </a>
                                </li>
                                @endforeach
                                
                               
                                
                            </ul>
                        </div>
                        <div class="common-sidebar">
                            <h6 class="common-sidebar__title"> Recent Post </h6>

                            @php
                                $latest_property = App\Models\Property::latest()->take(3)->get();
                            @endphp

                            @foreach ($latest_property as $property)
                                <div class="latest-blog">
                                    <div class="latest-blog__thumb">
                                        <a href="{{ route('property', $property->id) }}"> <img
                                                src="{{ asset('storage/' . $property->thumbnail) }}" class="cover-img"
                                                alt=""></a>
                                    </div>
                                    <div class="latest-blog__content">
                                        <span class="latest-blog__category font-12 flx-align gap-1">
                                            <span class="icon text-gradient"><i class="fas fa-folder-open"></i></span>
                                            {{ $property->type }}</span>
                                        <h6 class="latest-blog__title">
                                            <a href="{{ route('property', $property->id) }}"> {{ $property->name }}</a>
                                        </h6>
                                    </div>
                            @endforeach

                        </div>

                    </div>
                    <div class="common-sidebar">
                        <h6 class="common-sidebar__title"> Properties </h6>
                        <div class="row gy-4">



                            @php
                                $sameTypeProperties = App\Models\Property::where('type', $property->type)->take(6)->get();
                            @endphp

                            @if ($sameTypeProperties->count() > 0)
                            
                            @foreach ($sameTypeProperties as $sameTypeProperty)
                            <div class="col-lg-6 col-sm-4 col-6">
                                <a href="{{ route('property', $sameTypeProperty->id)}}" class="properties-item d-block w-100">
                                    <img src="{{ asset('storage/' . $sameTypeProperty->thumbnail) }}" alt="Property Image"
                                        class="cover-img">
                                    <span class="properties-item__text"> {{ $sameTypeProperty->name }}</span>
                                </a>
                            </div>
                            @endforeach

                            @endif

                           
                            
                        </div>
                    </div>


                </div>
            </div>
        </div>
        </div>
    </section>



   
@endsection
