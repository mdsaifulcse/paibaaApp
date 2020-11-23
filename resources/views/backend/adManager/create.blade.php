@extends('backend.app')
@section('content')
<div class="tab_content">

<h3 class="box_title">Add New Ad
 <a href="{{route('banner-manager.index')}}" class="btn btn-default pull-right"> <i class="ion ion-navicon-round"></i> View All Ad</a></h3>
 <div class="col-md-12">
	{!! Form::open(array('route' => 'banner-manager.store','class'=>'form-horizontal','files'=>true)) !!}
	    <div class="form-group {{ $errors->has('photo') ? 'has-error' : '' }}">
            {{Form::label('photo', 'Photo', array('class' => 'col-md-3 control-label'))}}
            <div class="col-md-8">
                <label class="banner_upload" for="file">
                    <!--  -->
                    <img id="image_load" src="{{asset('public/img/upload.png')}}" alt="Upload Your Photo" title="Upload Your Photo">
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
                {{Form::text('caption',"",array('class'=>'form-control','placeholder'=>'Caption'))}}
            </div>
        </div>
        <div class="form-group">
            {{Form::label('link', 'Link', array('class' => 'col-md-3 control-label'))}}
            <div class="col-md-8">
                {{Form::text('link',"",array('class'=>'form-control','placeholder'=>'link'))}}
            </div>
        </div>
        <div class="form-group">
            {{Form::label('is_photo', 'Use Photo or Script', array('class' => 'col-md-3 control-label'))}}

            <div class="col-md-4">
                {{Form::select('is_photo', array('1' => 'Photo', '2' => 'Script'),'1', ['class' => 'form-control'])}}
            </div>
        </div>
        <div class="form-group">
            {{Form::label('script', 'Script', array('class' => 'col-md-3 control-label'))}}
            <div class="col-md-8">
                {{Form::textArea('script',"",array('class'=>'form-control','placeholder'=>'script'))}}
            </div>
        </div>
        <div class="form-group  {{ $errors->has('fk_page_id') ? 'has-error' : '' }}">
            {{Form::label('fk_page_id', 'Page &amp; Position', array('class' => 'col-md-3 control-label'))}}

            <div class="col-md-4">
                {{Form::select('fk_page_id',$pages,'', ['class' => 'form-control','placeholder'=>'Select a Page','onchange'=>'loadSerial(this.value)'])}}
                @if ($errors->has('fk_page_id'))
                        <span class="help-block" style="display:block">
                            <strong>{{ $errors->first('fk_page_id') }}</strong>
                        </span>
                    @endif
            </div>
            <div class="col-md-4">
               <div id="loadSerialNumber"></div>
            </div>
        </div>
        <div class="form-group  {{ $errors->has('fk_category_id') ? 'has-error' : '' }}">
            {{Form::label('fk_category_id', 'Category', array('class' => 'col-md-3 control-label'))}}

            <div class="col-md-4">
                {{Form::select('fk_category_id',$category,'', ['class' => 'form-control','placeholder'=>'Select a category','onchange'=>'loadCatSerial(this.value)'])}}
                @if ($errors->has('fk_category_id'))
                        <span class="help-block" style="display:block">
                            <strong>{{ $errors->first('fk_category_id') }}</strong>
                        </span>
                    @endif
            </div>
            <div class="col-md-4">
               <div id="loadCatSerialNumber"></div>
            </div>
        </div>
        <div class="form-group">
            {{Form::label('status', 'Status', array('class' => 'col-md-3 control-label'))}}

            <div class="col-md-4">
                {{Form::select('status', array('1' => 'Active', '2' => 'Inactive'),'1', ['class' => 'form-control'])}}
            </div>
        </div>
	    <div class="form-group">
	        <div class="col-md-8 col-md-offset-3">
	            <button type="submit" class="btn btn-primary">Submit</button>
	        </div>
	    </div>
	{!! Form::close() !!}
 </div>

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
