@extends('backend.app')
@section('content')
<?$url=Request::path();

?>
<h3 class="box_title">Edit Ad
 <a href='{{route("banner-manager.index")}}' class="btn btn-default pull-right"> <i class="ion ion-navicon-round"></i> View All</a></h3>
    {!! Form::open(array('route' => ["banner-manager.update", $data->id],'method'=>'PUT','class'=>'form-horizontal','files'=>true)) !!}
        
        <div class="form-group {{ $errors->has('photo') ? 'has-error' : '' }}">
            {{Form::label('photo', 'Photo', array('class' => 'col-md-3 control-label'))}}
            <div class="col-md-8">
                <label class="banner_upload" for="file">
                    <!--  -->
                   @if($data->photo!=null)
                   <img id="image_load" src='{{asset("public/img/banners/$data->photo")}}' alt="Upload Your Photo" title="Upload Your Photo">
                   @else
                    <img id="image_load" src='{{asset("public/img/upload.png")}}' alt="Upload Your Photo" title="Upload Your Photo">
                   @endif
                </label>
                {{Form::file('photo',array('id'=>'file','style'=>'display:none'))}}
                 @if ($errors->has('photo'))
	                    <span class="help-block" style="display:block">
	                        <strong>{{ $errors->first('photo') }}</strong>
	                    </span>
	                @endif
            </div>
        </div>
        <div class="form-group">
            {{Form::label('caption', 'Caption', array('class' => 'col-md-3 control-label'))}}
            <div class="col-md-8">
                {{Form::text('caption',$data->caption,array('class'=>'form-control','placeholder'=>'Caption'))}}
            </div>
        </div>
        <div class="form-group">
            {{Form::label('link', 'Link', array('class' => 'col-md-3 control-label'))}}
            <div class="col-md-8">
                {{Form::text('link',$data->link,array('class'=>'form-control','placeholder'=>'link'))}}
            </div>
        </div>
        <div class="form-group">
            {{Form::label('is_photo', 'Use Photo or Script', array('class' => 'col-md-3 control-label'))}}

            <div class="col-md-4">
                {{Form::select('is_photo', array('1' => 'Photo', '2' => 'Script'),$data->is_photo, ['class' => 'form-control'])}}
            </div>
        </div>
        <div class="form-group">
            {{Form::label('script', 'Script', array('class' => 'col-md-3 control-label'))}}
            <div class="col-md-8">
                {{Form::textArea('script',$data->script,array('class'=>'form-control','placeholder'=>'script'))}}
            </div>
        </div>
        <div class="form-group">
            {{Form::label('fk_page_id', 'Page &amp; Position', array('class' => 'col-md-3 control-label'))}}

            <div class="col-md-4">
                {{Form::select('fk_page_id',$pages,$data->fk_page_id, ['class' => 'form-control','placeholder'=>'Select a Page','onchange'=>'loadSerial(this.value)'])}}
            </div>
            <div class="col-md-4">
               <div id="loadSerialNumber">
               	<input type="number" min="1" max="{{$max+1}}" value="{{$data->serial_num}}" name="serial_num" class="form-control" placeholder="Serial" required>
               </div>
            </div>
        </div>
        <div class="form-group  {{ $errors->has('fk_category_id') ? 'has-error' : '' }}">
            {{Form::label('fk_category_id', 'Category', array('class' => 'col-md-3 control-label'))}}

            <div class="col-md-4">
                {{Form::select('fk_category_id',$category,$data->fk_category_id, ['class' => 'form-control','placeholder'=>'Select a category','onchange'=>'loadCatSerial(this.value)'])}}
                @if ($errors->has('fk_category_id'))
                        <span class="help-block" style="display:block">
                            <strong>{{ $errors->first('fk_category_id') }}</strong>
                        </span>
                    @endif
            </div>
        </div>
        <div class="form-group">
            {{Form::label('status', 'Status', array('class' => 'col-md-3 control-label'))}}

            <div class="col-md-4">
                {{Form::select('status', array('1' => 'Active', '2' => 'Inactive'),$data->status, ['class' => 'form-control'])}}
            </div>
        </div>
	    <div class="form-group">
	        <div class="col-md-8 col-md-offset-3">
	            <button type="submit" class="btn btn-primary">Submit</button>
	        </div>
	    </div>
      
	{!! Form::close() !!}

@endsection
@section('script')
<script type="text/javascript">
	function loadSerial(id){
		$('#loadSerialNumber').load('{{URL::to("banner-manager")}}/'+id);
	}
    function loadCatSerial(id){
        $('#loadSerialNumber').load('{{URL::to("banner-serial")}}/'+id);
    }
</script>
@endsection


