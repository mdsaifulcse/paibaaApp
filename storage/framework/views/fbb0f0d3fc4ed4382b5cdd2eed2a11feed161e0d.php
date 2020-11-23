<?php $__env->startSection('breadcrumb'); ?>
    <ol class="breadcrumb">
        <li><a href="<?php echo e(URL::to('home')); ?>"><i class="fa fa-home" aria-hidden="true"></i> Home</a></li>
        <li class="#">Unpublished/Pending Ads</li>
    </ol>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div id="content" class="content">
        <div class="row">
            <div class="col-lg-12">
                <div class="box box-danger">
                    <div class="box-header bg-gray-active">
                        All Unpublished/Pending Ads
                        <div class="box-btn pull-right">

                            <a href="<?php echo e(url('all-ads')); ?>" class="btn btn-primary btn-sm pull-right"> <i class="fa fa-check-square-o" aria-hidden="true"></i> Go Approved Ads </a>
                        </div>
                    </div>
                    <div class="box-body ">
                        <?php if(count($adPost)>0): ?>
                        <table class="table table-striped table-hover table-bordered center_table" id="my_table">
                            <thead>
                            <tr>
                                <th>SL</th>
                                <th>Photo</th>
                                <th width="30%">Title</th>
                                <th>Sub.Category</th>
                                <th>Category</th>
                                <th>Author Name</th>
                                <th>Author Mobile</th>
                                <th>Status</th>
                                <th>Created At</th>
                                <th width="6%">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $i=1; ?>
                            <?php $__currentLoopData = $adPost; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($i++); ?></td>
                                    <td>
                                        <img src="<?php echo e(asset('images/post_photo/small/'.$data->postPhoto->photo_one)); ?>" style="width: 60px" alt=" Paibaa | Shob Paiba">
                                    </td>
                                    <td><?php echo e($data->title); ?></td>
                                    <td><?php echo e($data->adSubCategory->first()->sub_category_name); ?></td>
                                    <td><?php echo e($data->postCategory->category_name); ?></td>
                                    <td><?php echo e($data->postAuthor->name); ?></td>
                                    <td><?php echo e($data->postAuthor->mobile); ?></td>
                                    <td>
                                        <?php if($data->is_approved==2): ?>
                                            <span class="btn btn-warning btn-xs">Pending</span>
                                        <?php endif; ?>
                                    </td>

                                    <td><?php echo e(date('D-M-Y',strtotime($data->created_at))); ?></td>
                                    <td>
                                        <?php echo Form::open(array('route' => ['manage-ad.destroy',$data->id],'method'=>'DELETE','id'=>"deleteForm$data->id")); ?>

                                        <a href="<?php echo e(route('manage-ad.edit',$data->id)); ?>" title="Click Here To View & Edit This Ad" class="btn btn-xs btn-info"> <i class="fa fa-edit"></i> </a>
                                        <button type="button" class="btn btn-xs btn-danger" title="Click Here To Delete This Ad" onclick='return deleteConfirm("deleteForm<?php echo e($data->id); ?>")'><i class="fa fa-trash"></i></button>
                                        <?php echo Form::close(); ?>

                                    </td>

                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                            <?php else: ?>
                            <h4 class="text-danger text-center"><i class="fa fa-warning"></i>  No Ad Data Found ! </h4>
                            <?php endif; ?>
                    </div>
                    <div class="pull-right">
                        <?php echo e($adPost->render()); ?>

                    </div>
                </div>
            </div>
        </div>
    </div>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\paibaApp\resources\views/backend/ad/index.blade.php ENDPATH**/ ?>