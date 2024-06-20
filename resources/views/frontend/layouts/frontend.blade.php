<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Title -->
    <title> @yield('title') </title>
    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('frontend/assets/images/logo/favicon.png') }}">

    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/bootstrap.min.css') }}">
    <!-- Fontawesome -->
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/fontawesome-all.min.css') }}">
    <!-- Magnific popup css -->
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/magnific-popup.css.css') }}">
    <!-- Slick -->
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/slick.css') }}">
    <!-- line awesome -->
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/line-awesome.min.css') }}">
    <!-- Image Uploader -->
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/image-uploader.min.css') }}">
    <!-- jQuery Ui Css -->
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/jquery-ui.css') }}">
    <!-- Main css -->
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/main.css') }}">
    <link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
    @stack('css')

</head>

<body>

    <!--==================== Preloader Start ====================-->
    <div class="preloader">
        <div class="loader"></div>
    </div>
    <!--==================== Preloader End ====================-->

    <!--==================== Overlay Start ====================-->
    <div class="overlay"></div>
    <!--==================== Overlay End ====================-->

    <!--==================== Sidebar Overlay End ====================-->
    <div class="side-overlay"></div>
    <!--==================== Sidebar Overlay End ====================-->

    <!-- ==================== Scroll to Top End Here ==================== -->
    <div class="progress-wrap">
        <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
            <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
        </svg>
    </div>
    <!-- ==================== Scroll to Top End Here ==================== -->

    <!-- ==================== Mobile Menu Start Here ==================== -->
    <div class="mobile-menu d-lg-none d-block">
        <button type="button" class="close-button"> <i class="las la-times"></i> </button>
        <div class="mobile-menu__inner">
            <a href="index.html" class="mobile-menu__logo">
                <img src="{{ asset('frontend/assets/images/logo/logo-1.jpeg') }}" alt="Logo" width="100">
            </a>
            <div class="mobile-menu__menu">

                <ul class="nav-menu flx-align nav-menu--mobile">
                    <li class="nav-menu__item has-submenu">
                        <a href="javascript:void(0)" class="nav-menu__link">Home</a>
                     
                    </li>
                   
                   

                    <li class="nav-menu__item ">
                        <a href="{{route('contact')}}" class="nav-menu__link">Contact</a>
                      
                    </li>


                    <li class="nav-menu__item ">
                        <a href="{{route('admin.login')}}" class="nav-menu__link">Landlord Login</a>
                      
                    </li>


                    <li class="nav-menu__item has-submenu">

                        @if (Auth::check())
                        <a href="#" class="nav-menu__link">Dashboard</a>
                        <ul class="nav-submenu">
                            <li class="nav-submenu__item">
                                <a href="{{route('dashboard')}}" class="nav-submenu__link"> Profile</a>
                            </li>
                            <li class="nav-submenu__item">
                                <a href="{{route('user.logout')}}" class="nav-submenu__link"> Logout</a>
                            </li>
                        </ul>
                        @else
                        <a href="javascript:void(0)" class="nav-menu__link">Login</a>
                        @endif
                    </li>
                 
                </ul>
                <a href="#" class="btn btn-outline-light d-lg-none d-block mt-4">Sell Property <span
                        class="icon-right text-gradient"> <i class="fas fa-arrow-right"></i> </span> </a>
            </div>
        </div>
    </div>
    <!-- ==================== Mobile Menu End Here ==================== -->


    <!-- ==================== Right Offcanvas Start Here ==================== -->
    {{-- <div class="common-offcanvas d-lg-block d-none">
        <div class="flx-between">
            <a href="index.html" class="mobile-menu__logo">
                <img src="{{ asset('frontend/assets/images/logo/white-logo.png') }}" alt="Logo">
            </a>
            <button type="button" class="close-button d-flex position-relative top-0 end-0"> <i
                    class="las la-times"></i> </button>
        </div>

        <div class="search-box mt-5">
            <form action="#">
                <input type="text" class="common-input common-input--light" placeholder="Search...">
                <button type="submit" class="icon"> <i class="fas fa-search"></i> </button>
            </form>
        </div>

        <ul class="address-list mt-5">
            <li class="address-list__item flx-align">
                <span class="address-list__icon"><i class="fas fa-map-marker-alt"></i></span>
                <div class="address-list__content">
                    <p class="address-list__text">Burmsille Street, MN 55337, <br> United States</p>
                </div>
            </li>
            <li class="address-list__item flx-align">
                <span class="address-list__icon"> <i class="fas fa-phone"></i></span>
                <div class="address-list__content">
                    <a href="tel:" class="address-list__text">+(1) 123 456 7890 </a>
                    <a href="tel:" class="address-list__text">+(1) 098 765 4321 </a>
                </div>
            </li>
            <li class="address-list__item flx-align">
                <span class="address-list__icon"> <i class="fas fa-envelope"></i></span>
                <div class="address-list__content">
                    <a href="mailto:" class="address-list__text"> info@driller.com</a>
                    <a href="mailto:" class="address-list__text">info.example@driller.com</a>
                </div>
            </li>
        </ul>

        <div class="google-map mt-5">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m10!1m8!1m3!1d1511.2499674845235!2d-73.99553882767792!3d40.75102778252164!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sbd!4v1686536419224!5m2!1sen!2sbd"
                loading="lazy" class="w-100 h-100"></iframe>
        </div>

        <ul class="social-list">
            <li class="social-list__item"><a href="https://www.facebook.com" class="social-list__link flx-center"><i
                        class="fab fa-facebook-f"></i></a> </li>
            <li class="social-list__item"><a href="https://www.twitter.com" class="social-list__link flx-center"> <i
                        class="fab fa-twitter"></i></a></li>
            <li class="social-list__item"><a href="https://www.linkedin.com" class="social-list__link flx-center"> <i
                        class="fab fa-linkedin-in"></i></a></li>
            <li class="social-list__item"><a href="https://www.pinterest.com" class="social-list__link flx-center">
                    <i class="fab fa-instagram"></i></a></li>
        </ul>

    </div> --}}
    <!-- ==================== Right Offcanvas End Here ==================== -->



   


    <main class="body-bg">
        <!-- ==================== Header Top Start Here ==================== -->
        @include('frontend.components.header-top')
        <!-- ==================== Header Top End Here ==================== -->
        <!-- ==================== Header Start Here ==================== -->
        @include('frontend.components.nav-bar')
        <!-- ==================== Header End Here ==================== -->

     
        @yield('content')


        <!-- ==================== Footer Two Start Here ==================== -->
       @include('frontend.components.footer')
        <!-- ==================== Footer Two End Here ==================== -->

    </main>

    <!-- Jquery js -->
    <script src="{{ asset('frontend/assets/js/jquery-3.7.1.min.js') }}"></script>

    <!-- Bootstrap Bundle Js -->
    <script src="{{ asset('frontend/assets/js/boostrap.bundle.min.js') }}"></script>
    <!-- Magnific Popup -->
    <script src="{{ asset('frontend/assets/js/magnific-popup.min.js') }}"></script>
    <!-- Slick js -->
    <script src="{{ asset('frontend/assets/js/slick.min.js') }}"></script>
    <!-- Counter Up Js -->
    <script src="{{ asset('frontend/assets/js/counterup.min.js') }}"></script>
    <!-- Marquee text slider -->
    <script src="{{ asset('frontend/assets/js/jquery.marquee.min.js') }}"></script>
    <!-- Image Uploader -->
    <script src="{{ asset('frontend/assets/js/image-uploader.min.js') }}"></script>
    <!-- jQuery Ui Css -->
    <script src="{{ asset('frontend/frontend/assets/js/jquery-ui.min.js') }}"></script>
    <!-- ApexChart Js -->
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    <!-- main js -->
    <script src="{{ asset('frontend/assets/js/main.js') }}"></script>

    <script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
    {!! Toastr::message() !!}


    @stack('js')

</body>

</html>
