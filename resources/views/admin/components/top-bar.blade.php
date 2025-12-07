<<<<<<< HEAD

<div class="navbar-custom">
    <ul class="list-unstyled topnav-menu float-right mb-0">

        

        
      

        <li class="dropdown notification-list">
            <a class="nav-link dropdown-toggle nav-user mr-0 waves-effect waves-light" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">

                @if (Auth::guard('admin')->user()->image)
                <img src="{{ asset('storage/' . Auth::guard('admin')->user()->image)  }}" class="rounded-circle">
                @endif
              

                <span class="ml-1">{{ Auth::guard('admin')->user()->name }} <i class="mdi mdi-chevron-down"></i> </span>
            </a>
            <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                <!-- item-->
                <div class="dropdown-header noti-title">
                    <h6 class="text-overflow m-0">Welcome !</h6>
                </div>

                <!-- item-->
                <a href="{{  route('admin.profile') }}" class="dropdown-item notify-item">
                    <i class="fe-user"></i>
                    <span>Profile</span>
                </a>

                <!-- item-->
           

                <!-- item-->
               

                <div class="dropdown-divider"></div>

                <!-- item-->
                <a href="{{  route('admin.logout') }}" class="dropdown-item notify-item">
                    <i class="fe-log-out"></i>
                    <span>Logout</span>
                </a>

            </div>
        </li>

        <li class="dropdown notification-list">
            <a href=" " class="nav-link right-bar-toggle waves-effect waves-light">
               
            </a>
        </li>


    </ul>

    <!-- LOGO -->
    <div class="logo-box">
        <a href="{{route('admin.dashboard')}}" class="logo text-center">
            <span class="logo-lg">
                <img src="{{asset('frontend/assets/images/logo/system-logo.png')}}" alt="" width="60">
                <!-- <span class="logo-lg-text-light">UBold</span> -->
            </span>
            <span class="logo-sm">
                <!-- <span class="logo-sm-text-dark">U</span> -->
                <img src="{{asset('frontend/assets/images/logo/system-logo.png')}}" alt="" height="28">
            </span>
        </a>
    </div>

    <ul class="list-unstyled topnav-menu topnav-menu-left m-0">
        <li>
            <button class="button-menu-mobile waves-effect waves-light">
                <i class="fe-menu"></i>
            </button>
        </li>

       

    </ul>
=======

<div class="navbar-custom">
    <ul class="list-unstyled topnav-menu float-right mb-0">

        

        
      

        <li class="dropdown notification-list">
            <a class="nav-link dropdown-toggle nav-user mr-0 waves-effect waves-light" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">

                @if (Auth::guard('admin')->user()->image)
                <img src="{{ asset('storage/' . Auth::guard('admin')->user()->image)  }}" class="rounded-circle">
                @endif
              

                <span class="ml-1">{{ Auth::guard('admin')->user()->name }} <i class="mdi mdi-chevron-down"></i> </span>
            </a>
            <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                <!-- item-->
                <div class="dropdown-header noti-title">
                    <h6 class="text-overflow m-0">Welcome !</h6>
                </div>

                <!-- item-->
                <a href="{{  route('admin.profile') }}" class="dropdown-item notify-item">
                    <i class="fe-user"></i>
                    <span>Profile</span>
                </a>

                <!-- item-->
           

                <!-- item-->
               

                <div class="dropdown-divider"></div>

                <!-- item-->
                <a href="{{  route('admin.logout') }}" class="dropdown-item notify-item">
                    <i class="fe-log-out"></i>
                    <span>Logout</span>
                </a>

            </div>
        </li>

        <li class="dropdown notification-list">
            <a href=" " class="nav-link right-bar-toggle waves-effect waves-light">
               
            </a>
        </li>


    </ul>

    <!-- LOGO -->
    <div class="logo-box">
        <a href="{{route('admin.dashboard')}}" class="logo text-center">
            <span class="logo-lg">
                <img src="{{asset('frontend\assets/images/logo/PMPLOGO-removebg-.png')}}" alt="" width="60">
                <!-- <span class="logo-lg-text-light">UBold</span> -->
            </span>
            <span class="logo-sm">
                <!-- <span class="logo-sm-text-dark">U</span> -->
                <img src="{{asset('frontend\assets/images/logo/PMPLOGO-removebg-.png')}}" alt="" height="28">
            </span>
        </a>
    </div>

    <ul class="list-unstyled topnav-menu topnav-menu-left m-0">
        <li>
            <button class="button-menu-mobile waves-effect waves-light">
                <i class="fe-menu"></i>
            </button>
        </li>

       

    </ul>
>>>>>>> 4d626894314be39286e444578073dd7e4c5bad0a
</div>