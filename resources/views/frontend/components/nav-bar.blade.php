<header class="header">
    <div class="container container-two">
        <nav class="header-inner flx-between">
            <!-- Logo Start -->
            <div class="logo">
                <a href="{{ url('/') }}" class="link">
                    <img src="{{ asset('frontend\assets/images/logo/system-logo.png') }}" alt="Logo" width="75">
                </a>
            </div>
            <!-- Logo End  -->

            <!-- Menu Start  -->
            <div class="header-menu d-lg-block d-none">

                <ul class="nav-menu flx-align ">
                    <li class="nav-menu__item ">
                        <a href="{{ url('/') }}" class="nav-menu__link">Home</a>
                       
                    </li>
                 
                  
                    <li class="nav-menu__item">
                        <a href="{{route('contact')}}" class="nav-menu__link">Contact</a>
                    </li>


                    
                    <li class="nav-menu__item ">
                        <a href="{{route('admin.login')}}" target="_blank" class="nav-menu__link">Landlord Login</a>
                         
                    </li>

                    <li class="nav-menu__item has-submenu">
                        @if (Auth::check())

                     

                            <a href="{{route('dashboard')}}" class="nav-menu__link">Dashboard</a>

                            <ul class="nav-submenu">
                                <li class="nav-submenu__item">
                                    <a href="{{route('dashboard')}}" class="nav-submenu__link"> Profile </a>
                                </li>
                                <li class="nav-submenu__item ">
                                    <a href="{{route('user.logout')}}" class="nav-submenu__link">Logout</a>
                             
                                </li>
                            </ul>
                            
                        @else
                        <a href="{{route('login')}}" class="nav-menu__link">Login</a>
                        @endif
                    </li>
                </ul>
            </div>
            <!-- Menu End  -->

            <!-- Header Right start -->
            <div class="header-right flx-align">
                <button type="button" class="offcanvas-btn d-lg-block d-none">
                     
                </button>
                
                <button type="button" class="toggle-mobileMenu d-lg-none ms-3"> <i class="las la-bars"></i>
                </button>
            </div>
            <!-- Header Right End  -->
        </nav>
    </div>
</header>