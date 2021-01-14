<?php $__env->startSection('content'); ?>
    <div id="content" class="content">

        <div class="row">
            <div class="col-lg-12">
                <div class="box box-danger">

                    <div class="box-header with-border bg-gray-active">
                        <h4 class="box-title"> All Pages </h4>
                        <a href="<?php echo e(URL::to('pages/create')); ?>" class="btn btn-primary btn-sm pull-right"> <i class="fa fa-plus"></i> Add new page </a>
                    </div>

                    <div class="box-body ">
                        <table class="table table-striped table-hover table-bordered center_table" id="my_table">
                            <thead>
                            <tr>
                                <th>SL</th>
                                <th>Page Name</th>
                                <th>Page Title </th>
                                <th>Page Link </th>
                                <th>Status</th>
                                <th>Created At</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $i=1; ?>
                            <?php $__currentLoopData = $allData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($i++); ?></td>
                                    <td> <?php echo e($data->name); ?> </td>
                                    <td> <?php echo e($data->title); ?> </td>
                                    <td><a href="<?php echo e(URL::to('page/'.$data->link)); ?>" target="_blank"><?php echo e(URL::to('page/'.$data->link)); ?></a></td>

                                    <td><i class="<?php echo e(($data->status==1)? 'fa fa-check-circle text-success' : 'fa fa-times-circle'); ?>"></i></td>
                                    <td><?php echo e($data->created_at); ?></td>
                                    <td>
                                        <?php echo Form::open(array('route' => ['pages.destroy',$data->id],'method'=>'DELETE','id'=>"deleteForm$data->id")); ?>

                                        <a href="<?php echo e(URL::to('pages/'.$data->id.'/edit')); ?>" class="btn btn-warning btn-xs" title="Click here to Edit this page info"><i class="fa fa-edit"></i>  </a>

                                        <button type="button" class="btn btn-danger btn-xs" onclick="return deleteConfirm('deleteForm<?php echo e($data->id); ?>')" title="Click here to delete">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                        <?php echo Form::close(); ?>

                                    </td>

                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                        <div class="pull-right">
                            <?php echo e($allData->render()); ?>

                        </div>


                    </div>
                </div>
            </div>
        </div><!--end row-->



    </div><!--end content-->


<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\paibaApp\resources\views/backend/page/index.blade.php ENDPATH**/ ?>