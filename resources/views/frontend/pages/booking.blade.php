@extends('frontend.layouts.frontend')

@section('content')


 
    <!-- ==================== Breadcrumb Start Here ==================== -->
    <section class="breadcrumb padding-y-120">
        <img src="{{asset('frontend/assets/images/thumbs/breadcrumb-img.png')}}" alt="" class="breadcrumb__img">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="breadcrumb__wrapper">
                        <h2 class="breadcrumb__title"> Booking </h2>
                        <ul class="breadcrumb__list">
                            <li class="breadcrumb__item"><a href="{{ url('/') }}" class="breadcrumb__link"> <i class="las la-home"></i> Home</a> </li>
                            <li class="breadcrumb__item"><i class="fas fa-angle-right"></i></li>
                            <li class="breadcrumb__item"> <span class="breadcrumb__item-text"> Booking </span> </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ==================== Breadcrumb End Here ==================== -->
        
        <!-- ===================== Checkout Section Start ============================ -->
    <section class="checkout padding-y-120">
        <div class="container container-two">
            <form action="{{route('checkout')}}" method="POST">
                @csrf
                <div class="row gy-4">
                    <div class="col-lg-8 pe-lg-5">
                        <div class="card common-card">
                            <div class="card-body">
                                <h6 class="title mb-4">Shipping Address</h6>
                                <input type="hidden" name="property_id" value="{{ $property->id }}">
                                <div class="row gy-4">
                                    <div class="col-sm-6 col-xs-6">
                                        <label for="fname" class="form-label">First Name</label>
                                        <input type="text" class="common-input" name="fname" id="fname" required placeholder="First Name">


                                        @error('fname')
                                            <span class="text-danger">{{$message}}</span>   
                                        @enderror


                                    </div>
                                    <div class="col-sm-6 col-xs-6">
                                        <label for="lname" class="form-label">Last Name</label>
                                        <input type="text" class="common-input" name="lname" id="lname" required  placeholder="Last Name">


                                       @error('lname')
                                            <span class="text-danger">{{$message}}</span>
                                       @enderror     


                                    </div>


                                    <div class="col-sm-6 col-xs-6">
                                        <label for="checkin" class="form-label">Check in</label>
                                        <input type="date" class="common-input" min="{{ date('Y-m-d') }}" name="checkin" id="checkin" required>

                                        @error('checkin')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>


                                


                                    <div class="col-sm-6 col-xs-6">
                                        <label for="checkout" class="form-label">Check out</label>
                                        <input type="date" class="common-input" name="checkout" id="checkout" min="{{ date('Y-m-d') }}" required> 

                                        @error('checkout')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>

                                    <div class="col-sm-6 col-xs-6">
                                        <label for="adults" class="form-label">Adults</label>
                                        <input type="number" min="0" class="common-input" name="adults" id="adults" placeholder="Adults" required>

                                        @error('adults')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>

                                    <div class="col-sm-6 col-xs-6">
                                        <label for="kids" class="form-label">Kids</label>
                                        <input type="number" class="common-input" name="kids" id="kids" min="0" placeholder="Kids">

                                        @error('kids')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>


                                    <div class="col-sm-6 col-xs-6">
                                        <label for="EmailAddress" class="form-label">Email Address</label>
                                        <input type="email" class="common-input" name="email" id="EmailAddress" placeholder="Email Address" required>


                                        @error('email')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror


                                    </div>
                                    <div class="col-sm-6 col-xs-6">
                                        <label for="PhoneNumber" class="form-label">Phone Number</label>
                                        <input type="tel" class="common-input" name="phone" id="PhoneNumber" placeholder="Phone Number" >


                                        @error('phone')
                                            <span class="text-danger">{{$message}}</span>


                                        @enderror


                                    </div>
                                    <div class="col-sm-6 col-xs-6">
                                        <label for="Address" class="form-label">Address</label>
                                        <input type="text" class="common-input" name="address" id="Address" placeholder="Address" required>


                                        @error('address')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                    <div class="col-sm-6 col-xs-6">
                                        <label for="Country" class="form-label">Country</label>
                                        <div class="select-has-icon icon-black">
                                            <select class="select common-input" name="country" id="Country" required>
                                             
                                                <option value="Philippines" selected>Philippines</option>

                                            </select>
                                        </div>


                                        @error('country')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror

                                    </div>
                                    <div class="col-sm-6 col-xs-6">
                                        <label for="city" class="form-label">City</label>
                                        <input type="text" class="common-input" name="city" id="city" placeholder="city" required>


                                        @error('city')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror

                                    </div>
                                    {{-- <div class="col-sm-6 col-xs-6">
                                        <label for="State" class="form-label">State</label>
                                        <input type="text" class="common-input" name="state" id="State" placeholder="State" required>
                                        @error('state')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div> --}}
                                    <div class="col-sm-6 col-xs-6">
                                        <label for="region" class="form-label">Region</label>
                                        <input type="text" class="common-input" name="region" id="region" placeholder="Region" required>

                                        @error('region')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                    <div class="col-sm-6 col-xs-6">
                                        <label for="zip_code" class="form-label">ZipCode</label>
                                        <input type="text" class="common-input"  name="zip_code" id="zip_code" placeholder="ZipCode" required>

                                        @error('zip_code')
                                            <span class="text-danger">{{$message}}</span>
                                            
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card common-card mb-4">
                            <div class="card-body">
                                <h6 class="title mb-4">Payment Method</h6>
                                <div class="d-flex flex-column gap-3">
                                    {{-- <div class="payment-method">
                                        <div class="common-radio">
                                            <input class="form-check-input" type="radio" name="payment_method" id="DebitCard">
                                            <label class="form-check-label" for="DebitCard">
                                                Debit card / Credit card
                                                
                                                <img src="{{asset('frontend/assets/images/thumbs/paypal.png')}}" alt="">
                                            </label>
                                        </div>
                                    </div> --}}
                                    <div class="payment-method">
                                        <div class="common-radio">
                                            <input class="form-check-input" type="radio" name="payment_method" value="Stripe" id="payPal" checked>
                                            <label class="form-check-label" for="payPal">
                                                Pay By Card
                                                <!--<img src="{{asset('frontend/assets/images/thumbs/visa.png')}}" alt="">-->
                                                
                                            </label>
                                        </div>
                                        
                                        <div class="common-radio">
                                            <input class="form-check-input" type="radio" name="payment_method" value="Stripe" id="payPal">
                                            <label class="form-check-label" for="payPal">
                                                Pay By GCash
                                                <img src="https://upload.wikimedia.org/wikipedia/commons/5/52/GCash_logo.svg" alt="">
                                                
                                            </label>
                                        </div>
                                        <div class="common-radio">
                                            <input class="form-check-input" type="radio" name="payment_method" value="Stripe" id="payPal">
                                            <label class="form-check-label" for="payPal">
                                                Pay By Bank
                                                <img src="{{asset('frontend/assets/images/thumbs/visa.png')}}" alt="">
                                                
                                            </label>
                                        </div>

                                        @error('payment_method')
                                            <span class="text-danger">{{$message}}</span>
                                            
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card common-card">
                            <div class="card-body">
                                <h6 class="title mb-4">Totals</h6>
                                <ul class="billing-list">
                                    <li class="billing-list__item flx-between">
                                        <input type="hidden" name="amount" value="{{ $property->price }}">
                                        <span class="text text-poppins font-15"> {{ substr($property->name, 0, 20) }} </span>
                                        <span class="amount fw-semibold text-heading text-poppins">₱{{ $property->price}} </span>
                                    </li>
                                    
                                    <li class="billing-list__item flx-between">
                                        <span class="text text-poppins fw-semibold text-heading">Order Total</span>
                                        <span class="amount fw-semibold text-heading text-poppins"> ₱{{$property->price}}</span>
                                    </li>
                                </ul>
                                <button type="submit" class="btn btn-main w-100 mt-4">Pay By Card</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
    <!-- ===================== Checkout Section End ============================ -->
        
        <!-- ============================= CTA section Start ===================== -->
    

@endsection