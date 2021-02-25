<?php $__env->startSection('content'); ?>

<div id="content" class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="box box-danger">

                <div class="box-header with-border bg-gray-active">
                    <h4 class="box-title">Edit Category
                    </h4>
                    <a href="<?php echo e(route('category.index')); ?>" class="btn btn-success btn-sm pull-right"> <i class="fa fa-angle-double-left"></i> All Categories </a>

                </div>

                <div class="box-body ">
                    <?php echo Form::open(array('route' => ['category.update',$data->id],'method'=>'PUT','class'=>'form-horizontal','files'=>true)); ?>

                    <div class="form-group <?php echo e($errors->has('name') ? 'has-error' : ''); ?>">
                        <?php echo e(Form::label('category_name', 'Category Name', array('class' => 'col-md-2 control-label'))); ?>

                        <div class="col-md-8">
                            <?php echo e(Form::text('category_name',$value=$data->category_name,array('class'=>'form-control','placeholder'=>'Category Name','required','autofocus'))); ?>

                            <?php if($errors->has('category_name')): ?>
                                <span class="help-block">
                        				<strong class="text-danger"><?php echo e($errors->first('category_name')); ?></strong>
                    			</span>
                            <?php endif; ?>
                        </div>
                        <div class="col-md-2">
                            <?php echo e(Form::select('status', array('1' => 'Active', '2' => 'Inactive'), $data->status, ['class' => 'form-control'])); ?>

                        </div>
                    </div>
                    <div class="form-group">
                        <?php echo e(Form::label('short_description', 'Short Description', array('class' => 'col-md-2 control-label'))); ?>

                        <div class="col-md-10">
                            <?php echo e(Form::textArea('short_description',$data->short_description, ['class' => 'form-control','rows'=>'2','placeholder'=>'Short Description for Home Page'])); ?>

                        </div>
                    </div>

                    <div class="form-group <?php echo e($errors->has('icon_photo') ? 'has-error' : ''); ?>">
                        <?php echo e(Form::label('icon_photo', 'Icon', array('class' => 'col-md-2 control-label'))); ?>

                        <div class="col-md-2">
                            <label class="upload_photo upload icon_upload" for="file">
                                <!--  -->

                                <?php if(!empty($data)): ?>

                                <img id="image_load" src="<?php echo e(asset($data->icon_photo)); ?>" style="max-width: 120px;border: 2px dashed #2783bb; cursor: pointer">
                                <?php else: ?>
                                    <img id="image_load" src="<?php echo e(asset('images/default/photo.png')); ?>" style="max-width: 120px;border: 2px dashed #2783bb; cursor: pointer">
                                    <?php endif; ?>
                                
                            </label>
                            <input type="file" id="file" style="display: none;" name="icon_photo" onchange="photoLoad(this, this.id)" />
                            <?php if($errors->has('icon_photo')): ?>
                                <span class="help-block" style="display:block">
                            <strong><?php echo e($errors->first('icon_photo')); ?></strong>
                        </span>
                            <?php endif; ?>
                        </div>
                        <div class="col-md-1">
                            <b>OR</b>
                        </div>
                        <div class="col-md-5">
                            <?php echo e(Form::text('icon_class',$data->icon_class,array('class'=>'form-control','placeholder'=>'Ex: fa fa-facebook, ion-gear-a'))); ?>

                            <span>Use : <a class="btn btn-link" href="http://fontawesome.io/icons/">Font Awesome</a>, <a class="btn btn-link" href="http://ionicons.com/">ion icons</a></span>
                        </div>
                        <? $max=$max_serial+1; ?>
                        <div class="col-md-2">
                            <?php echo e(Form::number('serial_num',$data->serial_num, ['min'=>'1','class' => 'form-control','required'])); ?>

                            <span>Category Serial</span>
                        </div>
                    </div>

                    <div class="form-group">
                        <?php echo e(Form::label('post_type', 'Order/Apply Label', array('class' => 'col-md-2 control-label'))); ?>

                        <div class="col-md-2">
                            <?php echo e(Form::text('order_label',$value=$data->order_label,['class'=>'form-control','placeholder'=>'Ex: Order, Request, Apply'])); ?>

                        </div>


                        <?php echo e(Form::label('post_type', 'Category Type', array('class' => 'col-md-2 control-label'))); ?>

                        <div class="col-md-3">
                            <?php echo e(Form::select('post_type', array('1' => 'Normal Category', '2' => 'Special/Blog'), $data->post_type, ['class' => 'form-control'])); ?>

                        </div>

                        <?php echo e(Form::label('post_type', 'Ad view type', array('class' => 'col-md-2 control-label'))); ?>

                        <div class="col-md-3">
                            <?php echo e(Form::select('ad_view_type', array('1' => 'Grid View', '2' => 'List View'), $data->ad_view_type, ['class' => 'form-control'])); ?>

                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-10 col-md-offset-2">
                            <?php echo e(Form::submit('Save Change',array('class'=>'btn btn-lg btn-info'))); ?>

                        </div>
                    </div>

                    <?php echo Form::close(); ?>



                </div>
            </div>
        </div>
    </div>



</div> <!--end content-->


<?php $__env->stopSection(); ?>


<?php echo $__env->make('backend.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\paibaApp\resources\views/backend/category/edit.blade.php ENDPATH**/ ?>