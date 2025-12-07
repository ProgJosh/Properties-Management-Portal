<header class="header">
    <div class="container container-two">
        <nav class="header-inner flx-between">
            <!-- Logo Start -->
            <div class="logo">
                <a href="<?php echo e(url('/')); ?>" class="link">
<<<<<<< HEAD
                    <img src="<?php echo e(asset('frontend\assets/images/logo/system-logo.png')); ?>" alt="Logo" width="75">
=======
                    <img src="<?php echo e(asset('frontend/assets/images/logo/PMPLOGO-removebg-.png')); ?>" alt="Logo" width="75">
>>>>>>> 4d626894314be39286e444578073dd7e4c5bad0a
                </a>
            </div>
            <!-- Logo End  -->

            <!-- Menu Start  -->
            <div class="header-menu d-lg-block d-none">

                <ul class="nav-menu flx-align ">
                    <li class="nav-menu__item ">
                        <a href="<?php echo e(url('/')); ?>" class="nav-menu__link">Home</a>
                       
                    </li>
                 
                  
                    <li class="nav-menu__item">
                        <a href="<?php echo e(route('contact')); ?>" class="nav-menu__link">Contact</a>
                    </li>


<<<<<<< HEAD
                    
                    <li class="nav-menu__item ">
                        <a href="<?php echo e(route('admin.login')); ?>" target="_blank" class="nav-menu__link">Landlord Login</a>
                         
                    </li>
=======
                   <?php if(Auth::check()): ?>
                       
                   <?php else: ?>
                   <li class="nav-menu__item ">
                    <a href="<?php echo e(route('admin.login')); ?>" target="_blank" class="nav-menu__link">Landlord Login</a>
                     
                </li>
                   <?php endif; ?>
                     
                  
                  
>>>>>>> 4d626894314be39286e444578073dd7e4c5bad0a

                    <li class="nav-menu__item has-submenu">
                        <?php if(Auth::check()): ?>

                     

                            <a href="<?php echo e(route('dashboard')); ?>" class="nav-menu__link">Dashboard</a>

                            <ul class="nav-submenu">
                                <li class="nav-submenu__item">
                                    <a href="<?php echo e(route('dashboard')); ?>" class="nav-submenu__link"> Profile </a>
                                </li>
                                <li class="nav-submenu__item ">
                                    <a href="<?php echo e(route('user.logout')); ?>" class="nav-submenu__link">Logout</a>
                             
                                </li>
                            </ul>
                            
                        <?php else: ?>
                        <a href="<?php echo e(route('login')); ?>" class="nav-menu__link">Login</a>
                        <?php endif; ?>
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
</header><?php /**PATH C:\xampp\htdocs\Properties-Management-Portal\resources\views/frontend/components/nav-bar.blade.php ENDPATH**/ ?>