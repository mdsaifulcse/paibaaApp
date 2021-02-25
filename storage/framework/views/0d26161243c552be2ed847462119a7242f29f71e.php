<?php $__env->startSection('content'); ?>

	<div id="content" class="content">

		<div class="row">
			<div class="col-lg-12">
				<div class="box box-danger">

					<div class="box-header with-border bg-gray-active">
						<h4 class="box-title">Create New <?php echo e(($type==1)?'Product':'Business'); ?> Category</h4>
						
					</div>

					<div class="box-body ">
						<?php echo Form::open(array('route' => 'category.store','method'=>'POST','class'=>'form-horizontal','files'=>true)); ?>

						<div class="form-group <?php echo e($errors->has('name') ? 'has-error' : ''); ?>">
							<?php echo e(Form::label('category_name', 'Category Name', array('class' => 'col-md-2 control-label'))); ?>

							<div class="col-md-8">
								<?php echo e(Form::text('category_name',$value=old('category_name'),array('class'=>'form-control','placeholder'=>'Category Name','required','autofocus'))); ?>

								<?php if($errors->has('category_name')): ?>
								<span class="help-block">
                        				<strong class="text-danger"><?php echo e($errors->first('category_name')); ?></strong>
                    			</span>
								<?php endif; ?>
							</div>
							<div class="col-md-2">
								<?php echo e(Form::select('status', array('1' => 'Active', '2' => 'Inactive'), '1', ['class' => 'form-control'])); ?>

							</div>
						</div>
						<div class="form-group">
							<?php echo e(Form::label('short_description', 'Short Description', array('class' => 'col-md-2 control-label'))); ?>

							<div class="col-md-10">
								<?php echo e(Form::textArea('short_description',$value=old('short_description'), ['class' => 'form-control','rows'=>'2','placeholder'=>'Short Description for Home Page'])); ?>

							</div>
						</div>

						<div class="form-group <?php echo e($errors->has('icon_photo') ? 'has-error' : ''); ?>">
							<?php echo e(Form::label('icon_photo', 'Icon', array('class' => 'col-md-2 control-label'))); ?>

							<div class="col-md-2">
								<label class="upload_photo upload icon_upload" for="file">
									<!--  -->
									<img id="image_load" src="<?php echo e(asset('images/default/photo.png')); ?>" style="max-width: 120px;border: 2px dashed #2783bb; cursor: pointer">
									
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
								<?php echo e(Form::text('icon_class','',array('class'=>'form-control','placeholder'=>'Ex: fa fa-facebook, ion-gear-a'))); ?>

								<span>Use : <a class="btn btn-link" href="http://fontawesome.io/icons/">Font Awesome</a>, <a class="btn btn-link" href="http://ionicons.com/">ion icons</a></span>
							</div>
                            <?php $max=$max_serial+1; ?>
							<div class="col-md-2">
								<?php echo e(Form::number('serial_num',$max, ['min'=>'1','max'=>$max,'class' => 'form-control','required'])); ?>

								<span>Category Serial</span>
							</div>
						</div>


						<?php echo e(Form::hidden('type',$type)); ?>

						<div class="form-group">
							<?php echo e(Form::label('post_type', 'Order/Apply Label', array('class' => 'col-md-2 control-label'))); ?>

							<div class="col-md-2">
								<?php echo e(Form::text('order_label',$value=old('order_label'),['class'=>'form-control','placeholder'=>'Ex: Order, Request, Apply'])); ?>

							</div>

							<?php echo e(Form::label('post_type', 'Category Type', array('class' => 'col-md-2 control-label'))); ?>

							<div class="col-md-2">
								<?php echo e(Form::select('post_type', array('1' => 'Normal Category', '2' => 'Special/Blog'), '1', ['class' => 'form-control'])); ?>

							</div>


							<?php echo e(Form::label('post_type', 'Ad view type', array('class' => 'col-md-2 control-label'))); ?>

							<div class="col-md-2">
								<?php echo e(Form::select('ad_view_type', array('1' => 'Grid View', '2' => 'List View'), '1', ['class' => 'form-control'])); ?>

							</div>



						</div>

						<div class="form-group">
							<div class="col-md-10 col-md-offset-2">
								<?php echo e(Form::submit('Submit',array('class'=>'btn btn-lg btn-info'))); ?>

							</div>
						</div>

						<?php echo Form::close(); ?>



					</div>
				</div>
			</div>
		</div>


		<div class="row">
			<div class="col-lg-12">
				<div class="box box-danger">

					<div class="box-header with-border bg-gray-active">
						<h4 class="box-title">All <?php echo e(($type==1)?'Product':'Business'); ?> Categories
						</h4>

					</div>

					<div class="box-body table-responsive">

						<table class="table table-striped table-hover table-bordered center_table" id="my_table">
							<thead>
							<tr>
								<th>SL</th>
								<th>Category Name</th>
								<th>Status</th>
								<th>Icon Photo</th>
								<th>Icon Class</th>
								<th>Sub Category</th>
								<th colspan="2">Action</th>
							</tr>
							</thead>
							<tbody>
                            <?php $i=1; ?>
							<?php $__currentLoopData = $allData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<tr>
									<td><?php echo e($i++); ?></td>
									<td><a href='<?php echo e(URL::to("$url/$data->id/edit")); ?>'><?php echo e($data->category_name); ?></a></td>
									<td><i class="<?php echo e(($data->status==1)? 'ion-checkmark-circled success' : 'ion-ios-close danger'); ?>"></i></td>
									<td><?php if($data->icon_photo!=null): ?>
											<img width="40px" class="img-responsive" src='<?php echo e(asset("$data->icon_photo")); ?>' alt="<?php echo e($data->name); ?>">
										<?php endif; ?>
									</td>
									<td><?php echo e($data->icon_class); ?></td>
									<td><a class="btn btn-xs btn-sm btn-info" href='<?php echo e(URL::to("sub-category/$data->id")); ?>'>Sub Category (<?php echo e(DB::table('sub_category')->where('category_id',$data->id)->count()); ?>)</a></td>

									<td><a href='<?php echo e(URL::to("$url/$data->id/edit")); ?>' class="btn btn-info"><i class="ion ion-compose"></i></a>
									</td>
									<td>
										<?php echo Form::open(array('route' => ['category.destroy',$data->id],'method'=>'DELETE','id'=>"deleteForm$data->id")); ?>


										<button type="button" class="btn btn-xs btn-danger" onclick='return deleteConfirm("deleteForm<?php echo e($data->id); ?>")'><i class="fa fa-trash"></i></button>
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
		</div>

	</div> <!--end content-->



<?php $__env->stopSection(); ?>


<script>
    function photoLoad(input,image_load) {
        var target_image='#'+$('#'+image_load).prev().children().attr('id');

        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $(target_image).attr('src', e.target.result);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>

<script type="text/javascript">

    function deleteConfirm(){
        var con= confirm("Do you want to delete?");
        if(con){
            return true;
        }else
            return false;
    }
</script>
<?php echo $__env->make('backend.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\paibaApp\resources\views/backend/category/index.blade.php ENDPATH**/ ?>