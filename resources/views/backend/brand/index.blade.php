@extends('backend.app')
@section('content')

	<div id="content" class="content">

		<div class="row">
			<div class="col-lg-12">
				<div class="box box-danger">

					<div class="box-header with-border bg-gray-active">
						<h4 class="box-title"> Create New Brand and assign to sub-category </h4>
						<a href="{{URL::to('/category')}}" class="btn btn-primary btn-sm pull-right"> <i class="fa fa-angle-double-left"></i> All Categories </a>

					</div>

					<div class="box-body ">

						<div class="well">
							{!! Form::open(array('route' => 'brand.store','class'=>'form-horizontal','files'=>true)) !!}
							<div class="form-group {{ $errors->has('brand_name') ? 'has-error' : '' }}">
								{{Form::label('brand_name', 'Brand Name* :', array('class' => 'col-md-2 control-label'))}}

								<div class="col-md-7">
									<input type="text" name="brand_name" value="{{old('brand_name')}}" class="form-control"  autofocus id="tagboxField" required/>
									<ul id="tagbox"></ul>
									<span>For white space, use underscore ( _ )</span>
									@if ($errors->has('brand_name'))
										<span class="help-block">
										<strong>{{ $errors->first('brand_name') }}</strong>
									</span>
									@endif
								</div>

							</div>
							<div class="form-group">
								{{Form::label('category', 'Select Category* :', array('class' => 'col-md-2 control-label'))}}
								<div class="col-md-4">
									{{Form::select('category_id',$category,'', ['class' => 'form-control chosen-select','placeholder'=>'Select Category','required','onchange'=>'loadSubCategory(this.value)'])}}
								</div>


								{{Form::label('status', 'Status', array('class' => 'col-md-1 control-label'))}}

								<div class="col-md-2">
									{{Form::select('status', array('1' => 'Active', '2' => 'Inactive'), '1', ['class' => 'form-control'])}}
								</div>
							</div>

							<div class="form-group">
								{{Form::label('Sub Category', 'Sub Category', array('class' => 'col-md-2 control-label'))}}

								<div class="col-md-7" id="loadSubCategory">
									{{Form::select('sub_category_id[]', [], [], ['class' => 'form-control ','placeholder'=>'Select Category First !','multiple'=>false,'required'=>true])}}
								</div>
							</div>

							<div class="form-group">
								<div class="col-md-10 col-md-offset-2">
									{{Form::submit('Submit',array('class'=>'btn btn-md btn-primary'))}}
								</div>
							</div>

							{!! Form::close() !!}
						</div>

						<hr>


                        <?php
                        $total=count($allData);
                        $chunk=round($total/2);
                        $i=0;
                        ?>
						@foreach($allData->chunk($chunk) as $data1)
							<div class="col-md-6">
								<table class="table table-striped table-hover table-bordered center_table" id="my_table">
									<thead>
									<tr>
										<th>SL</th>
										<th>Brand Name</th>
										<th>Status</th>
										<th>Sub Category</th>
										<th colspan="2" width="5%">Action</th>
									</tr>
									</thead>
									<tbody>
									@foreach($data1 as $data)
                                        <?php $i++; ?>
										<tr>
											<td>{{$i}}</td>
											<td>{{$data->brand_name}}</td>
											<td><i class="{{($data->status==1)? 'ion-checkmark-circled success' : 'ion-ios-close danger'}}"></i></td>

											<td><small>{{$data->sub_category_name}}</small></td>
											<td><a href='{{URL::to("brand/$data->id/edit")}}' data-toggle="modal" class="btn btn-success btn-xs"><i class="ion ion-compose"></i></a></td>
											<td>
												{{Form::open(array('route'=>['brand.destroy',$data->id],'method'=>'DELETE','id'=>"deleteForm$data->id"))}}
												<button type="button" class="btn btn-xs btn-danger" onclick='return deleteConfirm("deleteForm{{$data->id}}")'><i class="ion ion-ios-trash-outline"></i></button>
												{!! Form::close() !!}
											</td>
										</tr>
									@endforeach
									</tbody>
								</table>


							</div>
						@endforeach
						<div class="col-md-12">
							<div class="pull-right">
								{{$allData->render()}}
							</div>
						</div>


					</div>
				</div>
			</div>
		</div>
	</div>

	

@endsection
@section('script')
 <script type="text/javascript">
 	function loadSubCategory(id){
 		$('#loadSubCategory').load('{{URL::to("load-sub-category")}}/'+id);

 	}
 </script>
@endsection