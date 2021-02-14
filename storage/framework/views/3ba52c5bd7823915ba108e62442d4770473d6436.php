<?php $__env->startSection('breadcrumb'); ?>
      <ol class="breadcrumb">
        <li><a href="<?php echo e(URL::to('home')); ?>"><i class="fa fa-home"></i> Home</a></li>
        <li class="<?php echo e(URL::to('all-users')); ?>">Admin</li>
      </ol>
    </section>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>


<div class="content">


    <div class="box">
        <div class="box-header">
            <h3 class="box-title">View All Admin</h3>

            <h3 class="pull-right box-title"><a href="<?php echo e(URL::to('all-users/create')); ?>">
                    <button type="button" class="btn btn-success">Create new Admin</button>
                </a></h3>

        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">


                <div class="row">
                    <div class="col-sm-12">
                        <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
                                <thead>
                                <tr>
                                    <th width="5%">Sl.No</th>
                                    <th>Name</th>
                                    <th>Mobile</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody class="table table-striped table-bordered nowrap">


                                <?php $i=1; ?>
                                <?php $__currentLoopData = $allUsers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                    <tr role="row" class="odd">
                                        <td class="sorting_1"><?php echo e($i++); ?></td>
                                        <td><?php echo e($user->name); ?></td>
                                        <td><?php echo e($user->mobile); ?></td>
                                        <td>
                                            <?php if($user->email!=''): ?>
                                            <?php echo e($user->email); ?>

                                            <?php else: ?>
                                            <span>No Email</span>
                                            <?php endif; ?>
                                        </td>
                                        <td><?php echo e($user->role_name); ?></td>
                                        <td><?php echo e($user->status); ?></td>
                                        <td>
                                            <?php echo e(Form::open(array('route'=>['all-users.destroy',$user->id],'method'=>'DELETE','id'=>"deleteForm$user->id"))); ?>


                                            <a href='<?php echo e(URL::to("all-users/$user->id")); ?>' title="Edit User" class="btn btn-info btn-xs">
                                                <i class="fa fa-pencil-square"></i>
                                            </a>
                                            <button type="button" class="btn btn-danger btn-xs" onclick="return deleteConfirm('deleteForm<?php echo e($user->id); ?>')">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                            <?php echo Form::close(); ?>

                                        </td>
                                    </tr>

                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>



                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>
                <div class="row">

                    <div class="col-sm-7">
                        <div class="dataTables_paginate paging_simple_numbers" id="example1_paginate">

                            <?php echo e($allUsers->render()); ?>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
    <!-- /.box-body -->


<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\paibaApp\resources\views/backend/primary_info/user/index.blade.php ENDPATH**/ ?>