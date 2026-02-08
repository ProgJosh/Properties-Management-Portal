@extends('frontend.layouts.frontend')

@section('content')
    {{-- <section class="breadcrumb padding-y-120">
    <img src="{{ asset('frontend/assets/images/thumbs/breadcrumb-img.png') }}" alt="" class="breadcrumb__img">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="breadcrumb__wrapper">
                    <h2 class="breadcrumb__title"> Account</h2>
                    <ul class="breadcrumb__list">
                        <li class="breadcrumb__item"><a href="index.html" class="breadcrumb__link"> <i class="las la-home"></i> Home</a> </li>
                        <li class="breadcrumb__item"><i class="fas fa-angle-right"></i></li>
                        <li class="breadcrumb__item"> <span class="breadcrumb__item-text"> Account </span> </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section> --}}
    <!-- ==================== Breadcrumb End Here ==================== -->

    <!-- ========================== Account Page Start ==================== -->
    <section class="account padding-y-60">
        <div class="container container-two">
            <div class="row gy-4">
                <div class="col-xl-3 col-lg-4">
                    <div class="account-sidebar search-sidebar">
                        <div class="nav side-tab flex-column nav-pills me-3" id="v-pills-tab" role="tablist"
                            aria-orientation="vertical">
                            <button class="nav-link active" id="v-pills-home-tab" data-bs-toggle="pill"
                                data-bs-target="#v-pills-home" type="button" role="tab" aria-controls="v-pills-home"
                                aria-selected="true"> <span class="icon"><i class="fas fa-home"></i></span> Orders </button>

                            <button class="nav-link" id="v-pills-profile-tab" data-bs-toggle="pill"
                                data-bs-target="#v-pills-profile" type="button" role="tab"
                                aria-controls="v-pills-profile" aria-selected="false"> <span class="icon"> <i
                                        class="fas fa-user"></i></span> Profile</button>
                            
                           
                       
                             
                             
                             
                            <button class="nav-link" id="v-pills-changePassword-tab" data-bs-toggle="pill"
                                data-bs-target="#v-pills-changePassword" type="button" role="tab"
                                aria-controls="v-pills-changePassword" aria-selected="false"> <span class="icon"> <i
                                        class="fas fa-lock"></i></span> Change Password</button>


                            <a href="{{ route('user.logout') }}" class="nav-link"> <span class="icon"> <i
                                        class="fas fa-sign-out-alt"></i></span> Logout</a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-9 col-lg-8">
                    <div class="tab-content" id="v-pills-tabContent">

                        <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel"
                            aria-labelledby="v-pills-home-tab" tabindex="0">
                 
                            <div class="row gy-4 dashboard-widget-wrapper">
                                <div class="col-xl-12 col-sm-12 col-xs-12">
                                    <div class="dashboard-widget  table-responsive ">

                                        <table class="table text-dark table-striped">
                                            <thead>
                                                <tr>
                                                    <th scope="col"  >#</th>
                                                    <th scope="col"   style="text-align: left !important">Property details</th>
                                                    <th scope="col"   style="text-align: left !important">Booking details</th>
                                                    <th scope="col"   style="text-align: center !important">Status</th>
                                                   
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($user->booking as $key => $booking)
                                                <tr >
                                                    <td>{{ $key + 1 }}</td>
                                                    <td style="text-align: left !important"><a href="{{ route('property', $booking->property_id) }}">{{ $booking->property->name }}</a>
                                                        <br>

                                                        Price: {{ $booking->property->price }}
                                                        <br>

                                                        Address: {{ $booking->property->address }} 
                                                        <br>
                                                        Contact :

                                                        <a href="https://wa.me/{{ $booking->property->landlord->phone }}" target="_blank" class="font-20 text-decoration-none"><i class="fab fa-whatsapp-square"></i>{{ $booking->property->landlord->phone }}</a>

                                                    </td>

                                                    <td style="text-align: left !important">
                                                        Checkin: {{ \Carbon\Carbon::parse($booking->checkin)->format('Y-m-d') }} <br>

                                                        Checkout: {{ \Carbon\Carbon::parse($booking->checkout)->format('Y-m-d') }} <br>

                                                        Adults : {{ $booking->adults }} <br>
                                                        Kids : {{ $booking->kids }} <br>
                                                    </td>
                                                    <td style="text-align: center !important">
                                                        @if($booking->status === 'accepted')
                                                            <span class="badge badge-success" style="padding: 8px 15px; font-size: 13px; background-color: #28a745;">
                                                                <i class="fas fa-check-circle"></i> Accepted
                                                            </span>
                                                        @elseif($booking->status === 'pending')
                                                            <span class="badge badge-warning" style="padding: 8px 15px; font-size: 13px; background-color: #ffc107; color: #000;">
                                                                <i class="fas fa-clock"></i> Pending
                                                            </span>
                                                        @else
                                                            <span class="badge badge-secondary" style="padding: 8px 15px; font-size: 13px;">
                                                                <i class="fas fa-question-circle"></i> Unknown
                                                            </span>
                                                        @endif
                                                    </td>
                                                </tr>
                                                @empty
                                                <tr>
                                                    <td colspan="4" class="text-center">No bookings available.</td>
                                                </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                        

                                    </div>
                                </div>



                            </div>


                        </div>



                        <div class="tab-pane fade" id="v-pills-profile" role="tabpanel"
                            aria-labelledby="v-pills-profile-tab" tabindex="0">
                            <div class="card common-card mb-4">
                                <div class="card-body">
                                    <div class="profile-info d-flex gap-4 align-items-center">
                                        <div class="profile-info__thumb">

                                            @if (@$user->userDetails->image)
                                                <img src="{{ asset('storage/' . $user->userDetails->image) }}"
                                                    alt="">
                                            @else
                                                <img src="{{ asset('frontend/assets/images/thumbs/team1.png') }}"
                                                    alt="">
                                            @endif


                                        </div>

                                        <div class="profile-info__content">
                                            <span
                                                class="mb-1 fw-semibold text-main text-poppins font-13">{{ @$user->userDetails->civil_status }}</span>
                                            <h4 class="profile-info__title text-poppins mb-4"> {{ Auth::user()->name }}
                                            </h4>

                                            <div class="contact-info d-flex gap-3 align-items-center mb-2">
                                                <span class="contact-info__icon text-gradient"><i
                                                        class="fas fa-calendar"></i></span>
                                                <div class="contact-info__content">
                                                    <span class="contact-info__address">
                                                        {{ @$user->userDetails->dob }}</span>
                                                </div>
                                            </div>




                                            <div class="contact-info d-flex gap-3 align-items-center mb-2">
                                                <span class="contact-info__icon text-gradient"><i
                                                        class="fas fa-phone"></i></span>
                                                <div class="contact-info__content">
                                                    <span
                                                        class="contact-info__address">{{ @$user->userDetails->phone }}</span>
                                                </div>
                                            </div>
                                            <div class="contact-info d-flex gap-3 align-items-center">
                                                <span class="contact-info__icon text-gradient"><i
                                                        class="fas fa-envelope"></i></span>
                                                <div class="contact-info__content">
                                                    <span class="contact-info__address">{{ @$user->email }}</span>
                                                </div>
                                            </div>

                                            <div class="contact-info d-flex gap-3 align-items-center mb-2">
                                                <span class="contact-info__icon text-gradient"><i
                                                        class="fas fa-map-marker-alt"></i></span>
                                                <div class="contact-info__content">
                                                    <span class="contact-info__address">
                                                        {{ @$user->userDetails->address }}</span>
                                                </div>
                                            </div>
                                        </div>


                                    </div>
                                </div>
                            </div>
                            <div class="card common-card">
                                <div class="card-body">
                                    <form action="{{ route('user.profile.update') }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <h6 class="loginRegister__title text-poppins">Profile Update</h6>

                                        <div class="row gy-lg-4 gy-3">
                                            <div class="col-sm-6 col-xs-6">
                                                <label for="name" class="form-label">Name</label>
                                                <input type="text" class="common-input"
                                                    value="{{ Auth::user()->name }}" placeholder="Enter Your Name"
                                                    name="name" required>
                                            </div>

                                            <div class="col-sm-6 col-xs-6">
                                                <label for="dob" class="form-label">Date of Birth</label>
                                                <input type="date" class="common-input"
                                                    value="{{ @$user->userDetails->dob }}" placeholder="Enter Your Name"
                                                    name="dob" required>
                                            </div>

                                            <div class="col-sm-6 col-xs-6">
                                                <label for="gender" class="form-label">Gender</label>
                                                <select name="gender" id="" class="common-input" required>
                                                    <option value="Male"
                                                        {{ @$user->userDetails->gender == 'Male' ? 'selected' : '' }}>Male
                                                    </option>
                                                    <option value="Female"
                                                        {{ @$user->userDetails->gender == 'Female' ? 'selected' : '' }}>
                                                        Female</option>
                                                    <option value="Others"
                                                        {{ @$user->userDetails->gender == 'Others' ? 'selected' : '' }}>
                                                        Others</option>
                                                </select>
                                            </div>

                                            <div class="col-sm-6 col-xs-6">
                                                <label for="civil_status" class="form-label"> Civil Status</label>
                                                <input type="text" class="common-input"
                                                    value="{{ @$user->userDetails->civil_status }}"
                                                    placeholder="Enter Your Name" name="civil_status" required>
                                            </div>


                                            <div class="col-sm-6 col-xs-6">
                                                <label for="Email" class="form-label">Email</label>
                                                <input type="email" class="common-input" placeholder="Enter Your Email"
                                                    name="email" value="{{ Auth::user()->email }}" id="email" required>
                                            </div>
                                            <div class="col-sm-6 col-xs-6">
                                                <label for="phone" class="form-label">Phone</label>
                                                <input type="tel" class="common-input" placeholder="Enter Your Phone"
                                                    name="phone" value="{{ @$user->userDetails->phone }}"
                                                    id="phone" required>
                                            </div>

                                            <div class="col-sm-6 col-xs-6">
                                                <label for="address" class="form-label">Address</label>
                                                <input type="tel" class="common-input"
                                                    placeholder="Enter Your Address" name="address"
                                                    value="{{ @$user->userDetails->address }}" id="Phone" required>
                                            </div>

                                            <div class="col-sm-6 col-xs-6">
                                                <label for="message" class="form-label">Profile Picture</label>
                                                <input type="file" class="form-control" name="image"
                                                    id="image">

                                                @error('image')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="col-12">
                                                <button type="submit" class="btn btn-main w-100">Profile Update</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    
                       
                       
                       
                         
                        
                        <div class="tab-pane fade" id="v-pills-changePassword" role="tabpanel"
                            aria-labelledby="v-pills-changePassword-tab" tabindex="0">
                            <form action="{{ route('user.password.update') }}" method="POST">
                                <div class="card common-card">
                                    <div class="card-body">
                                        <h6 class="loginRegister__title text-poppins">Password Change </h6>

                                        <div class="row gy-lg-4 gy-3">
                                            @csrf
                                            <div class="col-12">
                                                <label for="new-passwordd" class="form-label">New Password</label>
                                                <div class="position-relative">
                                                    <input type="password" class="common-input" placeholder="Password"
                                                        id="new-passwordd" name="password" required>
                                                    <span
                                                        class="password-show-hide fas fa-eye toggle-password la-eye-slash"
                                                        id="#new-passwordd"></span>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <label for="confirm-passwordd" class="form-label">Confirm
                                                    Password</label>
                                                <div class="position-relative">
                                                    <input type="password" class="common-input" placeholder="Password"
                                                        id="confirm-passwordd" name="password_confirmation" required>
                                                    <span
                                                        class="password-show-hide fas fa-eye toggle-password la-eye-slash"
                                                        id="#confirm-passwordd"></span>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <button type="submit" class="btn btn-main w-100" id="passUpdateBtn"
                                                    disabled>Save Changes</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('js')
    <script>
        $(document).ready(function() {
            $('#confirm-passwordd').on('keyup', function() {
                if ($('#new-passwordd').val() == $('#confirm-passwordd').val()) {
                    $('#confirm-passwordd').css('border-color', 'green');
                    $('#confirm-passwordd').attr('title', 'Password Match');
                    $('#confirm-passwordd').tooltip('show');
                    // submit button enabled
                    $('#passUpdateBtn').prop('disabled', false);
                } else {
                    $('#confirm-passwordd').css('border-color', 'red');
                    $('#confirm-passwordd').attr('title', 'Password Not Match');
                    $('#confirm-passwordd').tooltip('show');
                    $('#passUpdateBtn').prop('disabled', true);
                }
            });
        });
    </script>
@endpush
