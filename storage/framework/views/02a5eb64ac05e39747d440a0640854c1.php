<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Title -->
    <title> <?php echo $__env->yieldContent('title'); ?> </title>
    <!-- Front-End - Home Page Web Icon -->
    <link rel="shortcut icon" href="<?php echo e(asset('frontend\assets/images/logo/system-logo.png')); ?>">

    <!-- Bootstrap -->
    <link rel="stylesheet" href="<?php echo e(asset('frontend/assets/css/bootstrap.min.css')); ?>">
    <!-- Fontawesome -->
    <link rel="stylesheet" href="<?php echo e(asset('frontend/assets/css/fontawesome-all.min.css')); ?>">
    <!-- Magnific popup css -->
    <link rel="stylesheet" href="<?php echo e(asset('frontend/assets/css/magnific-popup.css.css')); ?>">
    <!-- Slick -->
    <link rel="stylesheet" href="<?php echo e(asset('frontend/assets/css/slick.css')); ?>">
    <!-- line awesome -->
    <link rel="stylesheet" href="<?php echo e(asset('frontend/assets/css/line-awesome.min.css')); ?>">
    <!-- Image Uploader -->
    <link rel="stylesheet" href="<?php echo e(asset('frontend/assets/css/image-uploader.min.css')); ?>">
    <!-- jQuery Ui Css -->
    <link rel="stylesheet" href="<?php echo e(asset('frontend/assets/css/jquery-ui.css')); ?>">
    <!-- Main css -->
    <link rel="stylesheet" href="<?php echo e(asset('frontend/assets/css/main.css')); ?>">
    <link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
    <?php echo $__env->yieldPushContent('css'); ?>

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
                <img src="<?php echo e(asset('frontend/assets/images/logo/logo.png')); ?>" alt="Logo">
            </a>
            <div class="mobile-menu__menu">

                <ul class="nav-menu flx-align nav-menu--mobile">
                    <li class="nav-menu__item has-submenu">
                        <a href="javascript:void(0)" class="nav-menu__link">Home</a>
                     
                    </li>
                   
                   

                    <li class="nav-menu__item ">
                        <a href="<?php echo e(route('contact')); ?>" class="nav-menu__link">Contact</a>
                      
                    </li>

                    <?php if(Auth::check()): ?>
                        
                    <?php else: ?>
                    <li class="nav-menu__item ">
                        <a href="<?php echo e(route('admin.login')); ?>" class="nav-menu__link">Landlord Login</a>
                      
                    </li>

                    <?php endif; ?>
                   


                    <li class="nav-menu__item has-submenu">

                        <?php if(Auth::check()): ?>
                        <a href="#" class="nav-menu__link">Dashboard</a>
                        <ul class="nav-submenu">
                            <li class="nav-submenu__item">
                                <a href="<?php echo e(route('dashboard')); ?>" class="nav-submenu__link"> Profile</a>
                            </li>
                            <li class="nav-submenu__item">
                                <a href="<?php echo e(route('user.logout')); ?>" class="nav-submenu__link"> Logout</a>
                            </li>
                        </ul>
                        <?php else: ?>
                        <a href="javascript:void(0)" class="nav-menu__link">Login</a>
                        <?php endif; ?>
                    </li>
                 
                </ul>
                <a href="#" class="btn btn-outline-light d-lg-none d-block mt-4">Sell Property <span
                        class="icon-right text-gradient"> <i class="fas fa-arrow-right"></i> </span> </a>
            </div>
        </div>
    </div>
    <!-- ==================== Mobile Menu End Here ==================== -->


    <!-- ==================== Right Offcanvas Start Here ==================== -->
    
    <!-- ==================== Right Offcanvas End Here ==================== -->



   


    <main class="body-bg">
        <!-- ==================== Header Top Start Here ==================== -->
        <?php echo $__env->make('frontend.components.header-top', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        <!-- ==================== Header Top End Here ==================== -->
        <!-- ==================== Header Start Here ==================== -->
        <?php echo $__env->make('frontend.components.nav-bar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        <!-- ==================== Header End Here ==================== -->

     
        <?php echo $__env->yieldContent('content'); ?>


        <!-- ==================== Footer Two Start Here ==================== -->
       <?php echo $__env->make('frontend.components.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        <!-- ==================== Footer Two End Here ==================== -->

    </main>

    <!-- Jquery js -->
    <script src="<?php echo e(asset('frontend/assets/js/jquery-3.7.1.min.js')); ?>"></script>

    <!-- Bootstrap Bundle Js -->
    <script src="<?php echo e(asset('frontend/assets/js/boostrap.bundle.min.js')); ?>"></script>
    <!-- Magnific Popup -->
    <script src="<?php echo e(asset('frontend/assets/js/magnific-popup.min.js')); ?>"></script>
    <!-- Slick js -->
    <script src="<?php echo e(asset('frontend/assets/js/slick.min.js')); ?>"></script>
    <!-- Counter Up Js -->
    <script src="<?php echo e(asset('frontend/assets/js/counterup.min.js')); ?>"></script>
    <!-- Marquee text slider -->
    <script src="<?php echo e(asset('frontend/assets/js/jquery.marquee.min.js')); ?>"></script>
    <!-- Image Uploader -->
    <script src="<?php echo e(asset('frontend/assets/js/image-uploader.min.js')); ?>"></script>
    <!-- jQuery Ui Css -->
    <script src="<?php echo e(asset('frontend/frontend/assets/js/jquery-ui.min.js')); ?>"></script>
    <!-- ApexChart Js -->
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    <!-- main js -->
    <script src="<?php echo e(asset('frontend/assets/js/main.js')); ?>"></script>

    <script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
    <?php echo Toastr::message(); ?>



    <?php echo $__env->yieldPushContent('js'); ?>

</body>

</html>
<?php /**PATH C:\xampp\htdocs\Properties-Management-Portal\resources\views/frontend/layouts/frontend.blade.php ENDPATH**/ ?>