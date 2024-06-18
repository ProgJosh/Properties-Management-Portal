<header class="header">
    <div class="container container-two">
        <nav class="header-inner flx-between">
            <!-- Logo Start -->
            <div class="logo">
                <a href="{{ url('/') }}" class="link">
                    <img src="{{ asset('frontend/assets/images/logo/logo-1.jpeg') }}" alt="Logo" width="100">
                </a>
            </div>
            <!-- Logo End  -->

            <!-- Menu Start  -->
            <div class="header-menu d-lg-block d-none">

                <ul class="nav-menu flx-align ">
                    <li class="nav-menu__item ">
                        <a href="{{ url('/') }}" class="nav-menu__link">Home</a>
                       
                    </li>
                 
                    <li class="nav-menu__item ">
                        <a href="#" class="nav-menu__link">Blog</a>
                         
                    </li>
                    <li class="nav-menu__item">
                        <a href="#" class="nav-menu__link">Contact</a>
                    </li>


                    
                    <li class="nav-menu__item ">
                        <a href="{{route('admin.register')}}" target="_blank" class="nav-menu__link">Landlor Login</a>
                         
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
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="24"
                        viewBox="0 0 30 24" fill="none">
                        <line x1="0.0078125" y1="12.293" x2="30.0078" y2="12.293" stroke="#181616"
                            stroke-width="3" />
                        <path d="M5.00781 22.293H30.0078" stroke="#181616" stroke-width="3" />
                        <path d="M10.0078 2.29297H30.0078" stroke="#181616" stroke-width="3" />
                    </svg>
                </button>
                
                <button type="button" class="toggle-mobileMenu d-lg-none ms-3"> <i class="las la-bars"></i>
                </button>
            </div>
            <!-- Header Right End  -->
        </nav>
    </div>
</header>