@extends('frontend.layouts.frontend')

@section('content')
    <!-- ==================== Breadcrumb Start Here ==================== -->
    <section class="breadcrumb padding-y-120">
        <img src="{{ asset('frontend/assets/images/thumbs/breadcrumb-img.png') }}" alt="" class="breadcrumb__img">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="breadcrumb__wrapper">
                        <h2 class="breadcrumb__title"> Property</h2>
                        <ul class="breadcrumb__list">
                            <li class="breadcrumb__item"><a href="{{ url('/') }}" class="breadcrumb__link"> <i
                                        class="las la-home"></i> Home</a> </li>
                            <li class="breadcrumb__item"><i class="fas fa-angle-right"></i></li>
                            <li class="breadcrumb__item"> <span class="breadcrumb__item-text"> Properties </span> </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ==================== Breadcrumb End Here ==================== -->

    <!-- ======================== Property Section Start ============================ -->
    <section class="property bg-gray-100 padding-y-120">
        <div class="container container-two">



            
           
            @include('frontend.components.product-filter')



            <div class="list-grid-item-wrapper show-two-item row gy-4">

                @if ($properties->count() == 0)
                @else
                    @foreach ($properties as $property)
                   
                        <div class="col-lg-4 col-sm-6">
                            <div class="property-item style-two">
                                <div class="property-item__thumb">
                                    <a href="{{ route('property', $property->id) }}" class="link">
                                        <img src=" {{ asset('storage/' . $property->thumbnail) }}" alt=""
                                            class="cover-img">
                                    </a>
                                </div>
                                <div class="property-item__content">
                                    <h6 class="property-item__title">
                                        <a href="{{ route('property', $property->id) }}" class="link">
                                            {{ $property->name }}
                                        </a>
                                    </h6>
                                    <ul class="amenities-list flx-align">
                                        <li class="amenities-list__item flx-align">
                                            <span class="icon text-gradient"><i class="fas fa-bed"></i></span>
                                            <span class="text"> {{ $property->bedroom }} Beds</span>
                                        </li>
                                        <li class="amenities-list__item flx-align">
                                            <span class="icon text-gradient"><i class="fas fa-bath"></i></span>
                                            <span class="text"> {{ $property->bathroom }} Baths</span>
                                        </li>
                                    </ul>
                                    <h6 class="property-item__price"> ₱{{ $property->price }}
                                        <span class="day">/per month</span>
                                    </h6>
                                    <p class="property-item__location d-flex gap-2">
                                        <span class="icon text-gradient"> <i class="fas fa-map-marker-alt"></i></span>
                                        {{ $property->address }}
                                    </p>
                                    <a href="{{ route('booking', $property->id)}}" class="simple-btn text-gradient fw-semibold font-14">Rent Now
                                        <span class="icon-right"> <i class="fas fa-arrow-right"></i> </span> </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
            </div>
            <nav aria-label="Page navigation example">
                <ul class="pagination common-pagination">

                    {{ $properties->links() }}
                </ul>
            </nav>
            @endif




        </div>
    </section>
    <!-- ======================== Property Section End ============================ -->

    <!-- ============================= CTA section Start ===================== -->
   
@endsection
