<?php $__env->startSection('content'); ?>

<div class="row">
    <div class="col-lg-12">
       

        <div class="card-box">
            <a href="<?php echo e(route('admin.create')); ?>" class="btn btn-primary btn-sm float-right p-2 mb-3">Add New Admin</a> 
           
           
            <div class="table-responsive">

                <table class="table mb-0" id="admin-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>

                            
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php $__currentLoopData = $admins; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $admins): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
                        <tr>
                            <th scope="row"><?php echo e($key + 1); ?></th>
                            <td> <?php echo e($admins->name); ?> </td>
                            <td> <?php echo e($admins->email); ?> </td>
                            <td>   <a href="https://wa.me/<?php echo e($admins->phone); ?>" target="_blank"
                                style="color:rgb(180, 180, 180); font-size: 16px"><i
                                    class="fab fa-whatsapp-square"></i> <?php echo e($admins->phone); ?> </a> </td>
                           
                            <td>
                             
                                <a href="<?php echo e(route('admin.delete', $admins->id)); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</a>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                       
                       
                    </tbody>
                </table>


                
            </div>
        
        </div>

        <div>
           
        </div>



    </div>


</div>



<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>

<script>
    $(document).ready(function(){
    $("#admin-table").DataTable();
    
});
</script>
    
<?php $__env->stopPush(); ?>
<?php echo $__env->make('admin.layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Properties-Management-Portal\resources\views/admin/pages/admin-list.blade.php ENDPATH**/ ?>