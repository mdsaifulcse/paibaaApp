<?php $__env->startSection('content'); ?>


	<div id="content" class="content">

		<div class="row">
			<div class="col-lg-12">
				<div class="box box-danger">

					<div class="box-header with-border bg-gray-active">
						<h4 class="box-title">
							<?php if($category->type==1): ?>
								Create sub category under <?php echo e($category->category_name); ?>

							<?php else: ?>
								Create sub category under <?php echo e($category->category_name); ?>

							<?php endif; ?>
                            </h4>
						<a href="<?php echo e(route('category.index')); ?>" class="btn btn-success btn-sm pull-right"> <i class="fa fa-angle-double-left"></i> All Categories </a>

					</div>


					<div class="box-body">
						<?php echo Form::open(array('route' => 'sub-category.store','class'=>'form-horizontal','files'=>true)); ?>

						<div class="form-group <?php echo e($errors->has('sub_category_name') ? 'has-error' : ''); ?>">
							<?php echo e(Form::label('sub_category_name', 'Name', array('class' => 'col-md-2 control-label'))); ?>

							<div class="col-md-8">
								<?php echo e(Form::text('sub_category_name','',array('class'=>'form-control','placeholder'=>'Sub Category Name','required'))); ?>

								<?php if($errors->has('sub_category_name')): ?>
									<span class="help-block">
                        <strong><?php echo e($errors->first('sub_category_name')); ?></strong>
                    </span>
								<?php endif; ?>
							</div>
							<div class="col-md-2">
								<?php echo e(Form::select('status', array('1' => 'Active', '2' => 'Inactive'), '1', ['class' => 'form-control'])); ?>

							</div>
						</div>
						<div class="form-group">
							<?php echo e(Form::label('description', 'Description', array('class' => 'col-md-2 control-label'))); ?>

							<div class="col-md-10">
								<?php echo e(Form::textArea('description','', ['class' => 'form-control','rows'=>'3','placeholder'=>'Write something about sub category. This is helpful for seo.'])); ?>

							</div>
						</div>
						<div class="form-group">
							<?php echo e(Form::label('serial_num', 'Serial Number', array('class' => 'col-md-2 control-label'))); ?>

                            <?php $max=$max_serial+1; ?>
							<div class="col-md-2">
								<?php echo e(Form::number('serial_num',$max, ['min'=>'1','max'=>$max,'class' => 'form-control','required'])); ?>

							</div>
						</div>
						<?php echo e(Form::hidden('category_id',$category->id)); ?>

						<div class="form-group">
							<div class="col-md-10 col-md-offset-2">
								<?php echo e(Form::submit('Submit',array('class'=>'btn btn-info'))); ?>

							</div>
						</div>

						<?php echo Form::close(); ?>


						<?php if(count($allData)): ?>

						<table class="table table-striped table-hover table-bordered center_table" id="my_table">
							<thead>
							<tr>
								<th>SL</th>
								<th>Sub Category Name</th>
								<th>Category</th>
								<th>Status</th>
								<th>Serial No.</th>
								<th colspan="2">Action</th>
							</tr>
							</thead>
							<tbody>
                            <?php $i=1; ?>
							<?php $__currentLoopData = $allData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<tr>
									<td><?php echo e($i++); ?></td>
									<td><?php echo e($data->sub_category_name); ?></td>
									<td><?php echo e($data->category_name); ?></td>
									<td><i class="<?php echo e(($data->status==1)? 'ion-checkmark-circled success' : 'ion-ios-close danger'); ?>"></i></td>
									<td>
										<?php echo e($data->serial_num); ?>

									</td>
									<td>
										<!-- Modal -->
										<div class="modal fade" id="editModal<?php echo e($data->id); ?>" tabindex="-1" role="dialog">
											<div class="modal-dialog modal-lg">
												<div class="modal-content">
													<div class="modal-header">
														<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
														<h4 class="modal-title">Edit : <?php echo e($data->sub_category_name); ?></h4>
													</div>
													<?php echo Form::open(array('route' => ['sub-category.update',$data->id],'class'=>'form-horizontal','method'=>'PUT','files'=>true)); ?>

													<div class="modal-body">
														<div class="form-group <?php echo e($errors->has('sub_category_name') ? 'has-error' : ''); ?>">
															<?php echo e(Form::label('sub_category_name', 'Name', array('class' => 'col-md-2 control-label'))); ?>

															<div class="col-md-8">
																<?php echo e(Form::text('sub_category_name',$data->sub_category_name,array('class'=>'form-control','placeholder'=>'Category Name','required'))); ?>

																<?php if($errors->has('sub_category_name')): ?>
																	<span class="help-block">
                        <strong><?php echo e($errors->first('sub_category_name')); ?></strong>
                    </span>
																<?php endif; ?>
															</div>
															<div class="col-md-2">
																<?php echo e(Form::select('status', array('1' => 'Active', '2' => 'Inactive'),$data->status, ['class' => 'form-control'])); ?>

															</div>
														</div>
														<div class="form-group">
															<?php echo e(Form::label('description', 'Description', array('class' => 'col-md-2 control-label'))); ?>

															<div class="col-md-10">
																<?php echo e(Form::textArea('description',$data->description, ['class' => 'form-control','rows'=>'3','placeholder'=>'Write something about sub category. This is helpful for seo.'])); ?>

															</div>
														</div>
														<div class="form-group">
															<?php echo e(Form::label('serial_num', 'Serial Number', array('class' => 'col-md-2 control-label'))); ?>

                                                            <?php $max=$max_serial+1; ?>
															<div class="col-md-2">
																<?php echo e(Form::number('serial_num',$data->serial_num, ['min'=>'1','max'=>$max,'class' => 'form-control','required'])); ?>

															</div>
														</div>

													</div>
													<div class="modal-footer">
														<button type="button" class="btn btn-default " data-dismiss="modal">Close</button>
														<?php echo e(Form::submit('Save changes',array('class'=>'btn btn-info'))); ?>

													</div>
													<?php echo Form::close(); ?>

												</div><!-- /.modal-content -->
											</div><!-- /.modal-dialog -->
										</div><!-- /.modal -->

									</td>

									<td>

										<?php echo e(Form::open(array('route'=>['sub-category.destroy',$data->id],'method'=>'DELETE','id'=>"deleteForm$data->id"))); ?>

										<a href="#editModal<?php echo e($data->id); ?>" data-toggle="modal" class="btn btn-info btn-xs"><i class="ion ion-compose"></i></a>
										<button type="button" class="btn btn-danger btn-xs" onclick='return deleteConfirm("deleteForm<?php echo e($data->id); ?>")'><i class="ion ion-ios-trash-outline"></i></button>
										<?php echo Form::close(); ?>

									</td>
								</tr>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</tbody>
						</table>
						<div class="pull-right">
							<?php echo e($allData->render()); ?>

						</div>

							<?php endif; ?>

					</div> <!--end box-body-->

				</div>
			</div>
		</div>
	</div>



<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\paibaApp\resources\views/backend/category/subCategory.blade.php ENDPATH**/ ?>