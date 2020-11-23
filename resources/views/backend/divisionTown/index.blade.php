@extends('backend.app')
@section('content')
<div id="content" class="content">

	<div class="row">
		<div class="col-lg-12">
			<div class="box box-danger">

				<div class="box-header with-border bg-gray-active">
					<h4 class="box-title"> Create New Division / Town </h4>
					{{--<a href="" class="btn btn-primary btn-sm pull-right"> <i class="fa fa-plus"></i> Add new </a>--}}
				</div>

				<div class="box-body ">

					<div class="well">
						{!! Form::open(array('route' => 'division-town.store','class'=>'form-horizontal','files'=>true)) !!}

					<div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">

						{{Form::label('Division/Town', 'Division/Town Name* :', array('class' => 'col-md-2 control-label'))}}

						<div class="col-md-8">
							{{Form::text('division_town',$value='', ['id'=>'tagboxField','class' => 'form-control','placeholder'=>'Type name and press enter','required'=>false])}}
							<span>Press enter for every name</span>

							@if ($errors->has('division_town'))
								<span class="help-block">
									<strong>{{ $errors->first('division_town') }}</strong>
								</span>
							@endif
						</div>

					</div>

					<div class="form-group">
						{{Form::label('type', 'Type* :', array('class' => 'col-md-2 control-label'))}}
						<div class="col-md-2">
							{{Form::select('type',['1'=>'Division','2'=>'Town'],'', ['class' => 'form-control','required','placeholder'=>'select type'])}}
						</div>


						{{Form::label('Serial No.', 'Serial No.', array('class' => 'col-md-1 control-label'))}}

						<div class="col-md-2">
							{{Form::number('serial_num', $value=$maxSerial+1, ['min'=>'1','max'=>$maxSerial+1, 'class' => 'form-control'])}}
						</div>
						@if ($errors->has('serial_num'))
							<span class="help-block">
									<strong>{{ $errors->first('serial_num') }}</strong>
								</span>
						@endif


						{{Form::label('status', 'Status', array('class' => 'col-md-1 control-label'))}}

						<div class="col-md-2">
							{{Form::select('status', array('1' => 'Active', '2' => 'Inactive'), '1', ['class' => 'form-control'])}}
						</div>

					</div>
					<div id="loadSubCat"><!-- Load Sub Category --></div>


					<div class="form-group">
						<div class="col-md-9 col-md-offset-2">
							{{Form::submit('Submit',array('class'=>'btn btn-md btn-info'))}}
						</div>
					</div>

					{!! Form::close() !!}
					</div>

				</div>
			</div>
		</div>
	</div><!--end row-->



	<div class="row">
		<div class="col-lg-12">
			<div class="box box-success">

				<div class="box-header with-border bg-gray-active">
					<h4 class="box-title"> Division / Town List </h4>
					{{--<a href="" class="btn btn-primary btn-sm pull-right"> <i class="fa fa-plus"></i> Add new </a>--}}
				</div>

				<div class="box-body table-responsive">

					<table class="table table-striped table-hover table-bordered center_table" id="my_table">
						<thead>
						<tr>
							<th>SL</th>
							<th>Division/Town Name</th>
							<th>Status</th>
							<th>Type</th>
							<th>Area</th>
							<th colspan="2" width="5%">Action</th>
						</tr>
						</thead>
						<tbody>
                        <?php $i=1; ?>
						@foreach($allData as $data)
							<tr>
								<td>{{$i++}}</td>
								<td>{{$data->division_town}}</td>
								<td><i class="{{($data->status==1)? 'ion-checkmark-circled success' : 'ion-ios-close danger'}}"></i></td>

								<td>{{($data->type==1)? 'Division' : 'Town'}}</td>
								<td><a class="btn btn-success btn-xs" href='{{URL::to("area/$data->id")}}'>Area</a></td>
								<td><a href="#editModal{{$data->id}}" data-toggle="modal" class="btn btn-info btn-xs"><i class="ion ion-compose"></i></a>
									<!-- Modal -->
									<div class="modal fade" id="editModal{{$data->id}}" tabindex="-1" role="dialog">
										<div class="modal-dialog">
											<div class="modal-content">
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
													<h4 class="modal-title">Edit : {{$data->division_town}}</h4>
												</div>
												{!! Form::open(array('route' => ['division-town.update',$data->id],'class'=>'form-horizontal','method'=>'PUT','files'=>true)) !!}
												<div class="modal-body">
													<div class="form-group {{ $errors->has('division_town') ? 'has-error' : '' }}">
														{{Form::label('name', 'Name', array('class' => 'col-md-2 control-label'))}}
														<div class="col-md-8">
															{{Form::text('division_town',$data->division_town,array('class'=>'form-control','placeholder'=>'Enter Division Or Town Name','required'))}}
															@if ($errors->has('division_town'))
																<span class="help-block">
                        											<strong>{{ $errors->first('division_town') }}</strong>
                    											</span>
															@endif
														</div>

													</div>
													<div class="form-group">
														{{Form::label('status', 'Status', array('class' => 'col-md-2 control-label'))}}
														<div class="col-md-8">
															{{Form::select('status', array('1' => 'Active', '2' => 'Inactive'),$data->status, ['class' => 'form-control'])}}
														</div>
													</div>

												</div>
												<div class="modal-footer">
													<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
													{{Form::submit('Save changes',array('class'=>'btn btn-info'))}}
												</div>
												{!! Form::close() !!}
											</div><!-- /.modal-content -->
										</div><!-- /.modal-dialog -->
									</div><!-- /.modal -->

								</td>
								<td>
									{{Form::open(array('route'=>['division-town.destroy',$data->id],'method'=>'DELETE','id'=>"deleteForm$data->id"))}}
									<button type="button" class="btn btn-xs btn-danger" onclick='return deleteConfirm("deleteForm{{$data->id}}")'><i class="ion ion-ios-trash-outline"></i></button>
									{!! Form::close() !!}
								</td>
							</tr>
						@endforeach
						</tbody>
					</table>
					<div class="pull-right">
						{{$allData->render()}}
					</div>


				</div>
			</div>
		</div>
	</div>




</div><!--end content-->


@endsection
