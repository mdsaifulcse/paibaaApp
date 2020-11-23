@extends('backend.app')
@section('content')


<h3 class="box_title">
Last Step Category
<a href='{{URL::to("sub-category/$subCategory->fk_category_id")}}' class="btn btn-success pull-right">{{$subCategory->sub_category_name}} </a></h3>
	<div class="box-body col-md-11">
		{!! Form::open(array('route' => 'last-step-catageory.store','class'=>'form-horizontal','files'=>true)) !!}
		<div class="form-group {{ $errors->has('last_step_category_name') ? 'has-error' : '' }}">
			{{Form::label('last_step_category_name', 'Name', array('class' => 'col-md-2 control-label'))}}
			<div class="col-md-8">
				{{Form::text('last_step_category_name','',array('class'=>'form-control','placeholder'=>'Last Step Category Name','required'))}}
				@if ($errors->has('last_step_category_name'))
                    <span class="help-block">
                        <strong>{{ $errors->first('last_step_category_name') }}</strong>
                    </span>
	            @endif
			</div>
			<div class="col-md-2">
				{{Form::select('status', array('1' => 'Active', '2' => 'Inactive'), '1', ['class' => 'form-control'])}}
			</div>
		</div>
		<div class="form-group">
				{{Form::label('description', 'Description', array('class' => 'col-md-2 control-label'))}}
				<div class="col-md-10">
					{{Form::textArea('description','', ['class' => 'form-control','rows'=>'3','placeholder'=>'Write something about sub category. This is helpful for seo.'])}}
				</div>
			</div>
		<div class="form-group">
			{{Form::label('serial_num', 'Serial Number', array('class' => 'col-md-2 control-label'))}}
			<? $max=$max_serial+1; ?>
			<div class="col-md-2">
				{{Form::number('serial_num',$max, ['min'=>'1','max'=>$max,'class' => 'form-control','required'])}}
			</div>
		</div>
				{{Form::hidden('fk_sub_category_id',$subCategory->id)}}
		<div class="form-group">
			<div class="col-md-10 col-md-offset-2">
				{{Form::submit('Submit',array('class'=>'btn btn-info'))}}
			</div>
		</div>
			
		{!! Form::close() !!}
	</div>
	<div class="col-md-12">
		<table class="table table-striped table-hover table-bordered center_table" id="my_table">
			<thead>
				<tr>
					<th>SL</th>
					<th>Last Step Category</th>
					<th>Sub Category Name</th>
					<th>Status</th>
					<th>Created At</th>
					<th colspan="2">Action</th>
				</tr>
			</thead>
			<tbody>
			<? $i=1; ?>
			@foreach($allData as $data)
				<tr>
					<td>{{$i++}}</td>
					<td>{{$data->last_step_category_name}}</td>
					<td>{{$data->sub_category_name}}</td>
					<td><i class="{{($data->status==1)? 'ion-checkmark-circled success' : 'ion-ios-close danger'}}"></i></td>
					<td>
					<? echo date('d-M-Y',strtotime($data->created_at)); ?></td>
					<td><a href="#editModal{{$data->id}}" data-toggle="modal" class="btn btn-info"><i class="ion ion-compose"></i></a>
					<!-- Modal -->
<div class="modal fade" id="editModal{{$data->id}}" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Edit : {{$data->last_step_category_name}}</h4>
      </div>
        {!! Form::open(array('route' => ['last-step-catageory.update',$data->id],'class'=>'form-horizontal','method'=>'PUT','files'=>true)) !!}
      <div class="modal-body">
		<div class="form-group {{ $errors->has('last_step_category_name') ? 'has-error' : '' }}">
			{{Form::label('last_step_category_name', 'Name', array('class' => 'col-md-2 control-label'))}}
			<div class="col-md-8">
				{{Form::text('last_step_category_name',$data->last_step_category_name,array('class'=>'form-control','placeholder'=>'Category Name','required'))}}
				@if ($errors->has('last_step_category_name'))
                    <span class="help-block">
                        <strong>{{ $errors->first('last_step_category_name') }}</strong>
                    </span>
	            @endif
			</div>
			<div class="col-md-2">
				{{Form::select('status', array('1' => 'Active', '2' => 'Inactive'),$data->status, ['class' => 'form-control'])}}
			</div>
		</div>
		<div class="form-group">
				{{Form::label('description', 'Description', array('class' => 'col-md-2 control-label'))}}
				<div class="col-md-10">
					{{Form::textArea('description',$data->description, ['class' => 'form-control','rows'=>'3','placeholder'=>'Write something about sub category. This is helpful for seo.'])}}
				</div>
			</div>
		<div class="form-group">
			{{Form::label('serial_num', 'Serial Number', array('class' => 'col-md-2 control-label'))}}
			<? $max=$max_serial+1; ?>
			<div class="col-md-2">
				{{Form::number('serial_num',$data->serial_num, ['min'=>'1','max'=>$max,'class' => 'form-control','required'])}}
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
						{{Form::open(array('route'=>['last-step-catageory.destroy',$data->id],'method'=>'DELETE'))}}
            				<button type="submit" class="btn btn-danger" onclick="return deleteConfirm()"><i class="ion ion-ios-trash-outline"></i></button>
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

@endsection




<script type="text/javascript">

function deleteConfirm(){
  var con= confirm("Do you want to delete?");
  if(con){
    return true;
  }else 
  return false;
}
</script>