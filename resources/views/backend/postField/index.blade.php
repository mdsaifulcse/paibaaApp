@extends('backend.app')
@section('content')

	<div id="content" class="content">

		<div class="row">
			<div class="col-lg-12">
				<div class="box box-danger">

					<div class="box-header with-border bg-gray-active">
						<h4 class="box-title">Create Different Post Field </h4>
						{{--<a href="" class="btn btn-primary btn-sm pull-right"> <i class="fa fa-plus"></i> Add new </a>--}}

					</div>

					<div class="box-body ">
						<div class="well">
							{!! Form::open(array('route' => 'post-field.store','class'=>'form-horizontal','files'=>true)) !!}
							<div class="form-group col-md-12 {{ $errors->has('title') ? 'has-error' : '' }}">
								{{Form::label('title', 'Title* :', array('class' => 'col-md-2 control-label'))}}

								<div class="col-md-8">
									{{Form::text('title','',array('class'=>'form-control','placeholder'=>'Title','required'=>true))}}

									@if ($errors->has('title'))
										<span class="help-block">
											<strong class="text-danger">{{ $errors->first('title') }}</strong>
										</span>
									@endif
								</div>
								<div class="col-md-2">
									{{Form::select('status', array('1' => 'Active', '2' => 'Inactive'), '1', ['class' => 'form-control'])}}
									@if ($errors->has('status'))
										<span class="help-block">
											<strong class="text-danger">{{ $errors->first('status') }}</strong>
										</span>
									@endif
								</div>
							</div>

							<div class="form-group col-md-5">
								{{Form::label('type', 'Input Type', array('class' => 'col-md-5 control-label'))}}

								<div class="col-md-6">
									{{Form::select('field_type',$type, '', ['class' => 'form-control','onchange'=>'inputType(this.value)','placeholder'=>'Select One','required'=>true])}}
									@if ($errors->has('field_type'))
										<span class="help-block">
											<strong class="text-danger">{{ $errors->first('field_type') }}</strong>
										</span>
									@endif
								</div>
							</div>

							<div class="form-group col-md-3">
								{{Form::label('required', 'Required', array('class' => 'col-md-4 control-label'))}}

								<div class="col-md-8">
									{{Form::select('required',['required'=>'Yes',''=>'No'], '[]', ['class' => 'form-control','placeholder'=>'Select one','required'=>true])}}
									@if ($errors->has('required'))
										<span class="help-block">
											<strong class="text-danger">{{ $errors->first('required') }}</strong>
										</span>
									@endif
								</div>
							</div>
							<div class="form-group col-md-4">
								{{Form::label('required', 'Use On Filter', array('class' => 'col-md-4 control-label'))}}

								<div class="col-md-8">
									{{Form::select('use_on_filter',['0'=>'No','1'=>'Yes'], '[]', ['class' => 'form-control','placeholder'=>'Select one','required'=>true,'title'=>'Is this filter Will be on filter ?'])}}
									@if ($errors->has('use_on_filter'))
										<span class="help-block">
											<strong class="text-danger">{{ $errors->first('use_on_filter') }}</strong>
										</span>
									@endif
								</div>
							</div>

							<div class="form-group col-md-12" id="dropdownValue" style="display: block">
								{{Form::label('Value', 'Dropdown Value* :', array('class' => 'col-md-2 control-label'))}}
								<div class="col-md-10">
									{{Form::text('value',$value='', ['id'=>'tagboxField','class' => 'form-control','placeholder'=>'Type value and press enter','required'=>false])}}
									<span>Press enter for every value</span>
									@if ($errors->has('value'))
										<span class="help-block">
											<strong class="text-danger">{{ $errors->first('value') }}</strong>
										</span>
									@endif
								</div>
							</div>


							<div class="form-group col-md-6">
								{{Form::label('category', 'Select Category* :', array('class' => 'col-md-4 control-label'))}}
								<div class="col-md-7">
									{{Form::select('category',$category,'', ['id'=>'categoryId','class' => 'form-control chosen-select','placeholder'=>'Select Category','required','onchange'=>'loadSubCategory(this.value)'])}}
									@if ($errors->has('category'))
										<span class="help-block">
											<strong class="text-danger">{{ $errors->first('category') }}</strong>
										</span>
									@endif
								</div>
							</div>


							{{--<div id="loadValue"><!-- Load Sub Category --></div>--}}

							<div class="form-group col-md-12">
								{{Form::label('category', 'Sub-Category* :', array('class' => 'col-md-2 control-label'))}}
								<div class="col-md-10" id="loadSubCat">
									{{Form::select('sub_category_id[]',[],'', ['class' => 'form-control','placeholder'=>'Select Category First','required'])}}
									@if ($errors->has('sub_category_id'))
										<span class="help-block">
											<strong class="text-danger">{{ $errors->first('sub_category_id') }}</strong>
										</span>
									@endif
								</div>
							</div>


							<div class="form-group">
								<div class="col-md-10 col-md-offset-2">
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
						<h4 class="box-title">Post filed List</h4>
						{{--<a href="" class="btn btn-primary btn-sm pull-right"> <i class="fa fa-plus"></i> Add new </a>--}}

					</div>

					<div class="box-body ">

                        <?php $i=0;?>
						<div class="col-md-12">
							<table class="table table-striped table-hover table-bordered center_table" id="my_table">
								<thead>
								<tr>
									<th width="2%">SL</th>
									<th>Field Title</th>
									<th>Field Type</th>
									<th width="4%">Status</th>
									<th width="7%">Required</th>
									<th>Sub Category</th>
									<th>Category</th>
									<th colspan="2" width="5%">Action</th>
								</tr>
								</thead>
								<tbody>
								@foreach($allData as $data)
                                    <?php $i++; ?>
									<tr>
										<td>{{$i}}</td>
										<td>{{$data->title}}</td>
										<td>{{ucwords($data->field_type)}}</td>
										<td><i class="{{($data->status==1)? 'ion-checkmark-circled success' : 'ion-ios-close danger'}}"></i></td>

										<td>{{$data->required=='required'?ucwords($data->required):'No Required'}}</td>
										<td><small>{{$data->sub_category_name}}</small></td>
										<td><small>{{$data->category_name}}</small></td>
										<td><a href='{{URL::to("post-field/$data->id/edit")}}' class="btn btn-info btn-xs"><i class="ion ion-compose"></i></a></td>
										<td>
											{{Form::open(array('route'=>['post-field.destroy',$data->id],'method'=>'DELETE','id'=>"deleteForm$data->id"))}}
											<button type="button" class="btn btn-xs btn-danger" onclick='return deleteConfirm("deleteForm{{$data->id}}")'><i class="ion ion-ios-trash-outline"></i></button>
											{!! Form::close() !!}

										</td>
									</tr>
								@endforeach
								</tbody>
							</table>


						</div>
						<div class="col-md-12">
							<div class="pull-right">
								{{$allData->render()}}
							</div>
						</div>


					</div>
				</div>
			</div>
		</div>



	</div><!-- end content-->
	

@endsection
@section('script')
	@if(count($errors)>0)

		<script>
			var id=$('#categoryId').val()
            $('#loadSubCat').load('{{URL::to("load-sub-category")}}/'+id);
		</script>

		@endif

 <script type="text/javascript">
 	function loadSubCategory(id){
 		$('#loadSubCat').load('{{URL::to("load-sub-category")}}/'+id);
 	}
 	function inputType(value){
        if(value=='dropdown'){
            console.log('Good')
            $('#dropdownValue').css('display','block')
            //$('#dropdownValue').next().next().children().attr('required',true)
 		}else{
            $('#dropdownValue').css('display','none')

 		}
 	}
 </script>
@endsection