 


<?php $__env->startSection('content'); ?>
<div class="account-pages mt-2 pt-2 mb-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 col-lg-12 col-xl-12">
                <div class="card bg-pattern">

                    <div class="card-body p-4">
                        
                       

                        <form action="<?php echo e(route('admin.profile.payment-info-update')); ?>" method="POST" enctype="multipart/form-data" class="form-horizontal">

                            <?php echo csrf_field(); ?>
                            <div class="row">

                                
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="payment_method">Payement Method</label>
                                        <select name="payment_method" class="form-control" id="">
                                            <option value="" disabled >Select Payment Method</option>
                                            <option value="bank" <?php echo e(@$admin->payment_method == 'bank' ? 'selected' : ''); ?>>Bank</option>
                                           
                                        </select>
        
                                        <?php $__errorArgs = ['payment_method'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="text-danger"><?php echo e($message); ?></span>
                                            
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        
        
                                    </div>
                                </div>


                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="bank_name">Bank Name</label>
                                        <input class="form-control" type="text" id="bank_name" name="bank_name" value="<?php echo e(@$admin->bank_name); ?>" required="" >
        
                                        <?php $__errorArgs = ['bank_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="text-danger"><?php echo e($message); ?></span>
                                            
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        
        
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="branch_name"> Branch Name</label>
                                        <input class="form-control" type="text" name="branch_name" id="branch_name"  value="<?php echo e(@$admin->branch_name); ?>" required>
        
                                        <?php $__errorArgs = ['branch_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="text-danger"><?php echo e($message); ?></span>
                                            
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="account_name"> Account Name</label>
                                        <input class="form-control" type="tel" id="account_name" name="account_name" value="<?php echo e(@$admin->account_name); ?>" required="" >
        
                                        <?php $__errorArgs = ['account_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="text-danger"><?php echo e($message); ?></span>
                                            
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        
        
                                    </div>
                                </div>

                                
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                            

                                        <label for="account_number"> Account Number</label>
                                        <input class="form-control" type="text" required="" id="account_number" name="account_number"  value="<?php echo e(@$admin->account_number); ?>">


                                        <?php $__errorArgs = ['account_number'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="text-danger"><?php echo e($address); ?></span>
                                            
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                </div>

                                



                            </div>
                       

    

                            <div class="form-group mb-0 text-center">
                                <button class="btn btn-gradient btn-block" type="submit"> Update </button>
                            </div>

                        </form>

                  


                    </div> <!-- end card-body -->
                </div>
                <!-- end card -->

           

            </div> <!-- end col -->
        </div>
        <!-- end row -->
    </div>
    <!-- end container -->
</div>

<?php $__env->stopSection(); ?>



<?php echo $__env->make('admin.layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Properties-Management-Portal\resources\views/admin/pages/auth/payment-info.blade.php ENDPATH**/ ?>