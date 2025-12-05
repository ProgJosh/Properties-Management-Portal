<div class="left-side-menu">

    <div class="slimscroll-menu">

        <!--- Sidemenu -->
        <div id="sidebar-menu">

            <ul class="metismenu" id="side-menu">

                <li class="menu-title">Navigation</li>

                <li>
                    <a href="<?php echo e(route('admin.dashboard')); ?>">
                        <i class="fe-airplay"></i>
                        
                        <span> Dashboard </span>
                    </a>
                </li>

                <li>
                    <a href="javascript: void(0);">
                        <i class="fe-briefcase"></i>
                        <span> Properties </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="nav-second-level" aria-expanded="false">
                        <li><a href="<?php echo e(route('admin.properties')); ?>"> All Properties</a></li>
                        
                        <li><a href="<?php echo e(route('admin.property.create')); ?>"> Add Property</a></li>
                         
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);">
                        <i class="fe-box"></i>
                        <span> Booking </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="nav-second-level" aria-expanded="false">
                        <li><a href="<?php echo e(route('admin.booked')); ?>"> Booking List </a></li>
                        
                    
                         
                    </ul>
                </li>


                <li>
                    <a href="javascript: void(0);">
                        <i class="fe-bar-chart-2"></i>
                        <span> Earning </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="nav-second-level" aria-expanded="false">
                        <li><a href="<?php echo e(route('admin.earnings')); ?>"> Earning</a></li>
                        
                    
                         
                    </ul>
                </li>

                
                <?php if(Auth::user()->role == 0): ?>
                <li>
                    <a href="javascript: void(0);">
                        <i class="far fa-address-card"></i>
                        <span> Payment </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="nav-second-level" aria-expanded="false">
                        <li><a href="<?php echo e(route('admin.withdraw-requests')); ?>"> Withdraw Request</a></li>
                        
                    
                         
                    </ul>
                </li>
             
                

             

                <li>
                    <a href="javascript: void(0);">
                        <i class="fe-user"></i>
                        <span> Users </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="nav-second-level" aria-expanded="false">
                        <li><a href="<?php echo e(route('admin.list')); ?>"> Admins </a></li>

                        <li><a href="<?php echo e(route('admin.landlords')); ?>"> Landlords </a></li>
                        
                        <li><a href="<?php echo e(route('admin.tenants')); ?>"> Tenants </a></li>
                        
                    </ul>
                </li>
                <?php endif; ?>
             
                
                <li>
                    <a href="javascript: void(0);">
                        <i class="fab fa-bity"></i>
                        <span> Profile </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="nav-second-level" aria-expanded="false">
                        <li><a href="<?php echo e(route('admin.profile')); ?>"> Profile  </a></li>
                        <li><a href="<?php echo e(route('admin.profile.personal-info')); ?>"> Personal Info  </a></li>
                        <li><a href="<?php echo e(route('admin.profile.payment-info')); ?>"> Payment Info </a></li>
                        <li><a href="<?php echo e(route('admin.profile.change-password')); ?>"> Password Update </a></li>
                         
                    </ul>
                </li>

             
            </ul>

        </div>
        <!-- End Sidebar -->

        <div class="clearfix"></div>

    </div>
    <!-- Sidebar -left -->

</div><?php /**PATH C:\xampp\htdocs\Properties-Management-Portal\resources\views/admin/components/side-bar.blade.php ENDPATH**/ ?>