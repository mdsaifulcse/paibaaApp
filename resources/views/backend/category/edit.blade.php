@extends('backend.app')
@section('content')

<div id="content" class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="box box-danger">

                <div class="box-header with-border bg-gray-active">
                    <h4 class="box-title">Edit Category
                    </h4>
                    <a href="{{route('category.index')}}" class="btn btn-success btn-sm pull-right"> <i class="fa fa-angle-double-left"></i> All Categories </a>

                </div>

                <div class="box-body ">
                    {!! Form::open(array('route' => ['category.update',$data->id],'method'=>'PUT','class'=>'form-horizontal','files'=>true)) !!}
                    <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                        {{Form::label('category_name', 'Category Name', array('class' => 'col-md-2 control-label'))}}
                        <div class="col-md-8">
                            {{Form::text('category_name',$value=$data->category_name,array('class'=>'form-control','placeholder'=>'Category Name','required','autofocus'))}}
                            @if ($errors->has('category_name'))
                                <span class="help-block">
                        				<strong class="text-danger">{{ $errors->first('category_name') }}</strong>
                    			</span>
                            @endif
                        </div>
                        <div class="col-md-2">
                            {{Form::select('status', array('1' => 'Active', '2' => 'Inactive'), $data->status, ['class' => 'form-control'])}}
                        </div>
                    </div>
                    <div class="form-group">
                        {{Form::label('short_description', 'Short Description', array('class' => 'col-md-2 control-label'))}}
                        <div class="col-md-10">
                            {{Form::textArea('short_description',$data->short_description, ['class' => 'form-control','rows'=>'2','placeholder'=>'Short Description for Home Page'])}}
                        </div>
                    </div>

                    <div class="form-group {{ $errors->has('icon_photo') ? 'has-error' : '' }}">
                        {{Form::label('icon_photo', 'Icon', array('class' => 'col-md-2 control-label'))}}
                        <div class="col-md-2">
                            <label class="upload_photo upload icon_upload" for="file">
                                <!--  -->

                                @if(!empty($data))

                                <img id="image_load" src="{{asset($data->icon_photo)}}" style="max-width: 120px;border: 2px dashed #2783bb; cursor: pointer">
                                @else
                                    <img id="image_load" src="{{asset('images/default/photo.png')}}" style="max-width: 120px;border: 2px dashed #2783bb; cursor: pointer">
                                    @endif
                                {{--<i class="upload_hover ion ion-ios-camera-outline"></i>--}}
                            </label>
                            <input type="file" id="file" style="display: none;" name="icon_photo" onchange="photoLoad(this, this.id)" />
                            @if ($errors->has('icon_photo'))
                                <span class="help-block" style="display:block">
                            <strong>{{ $errors->first('icon_photo') }}</strong>
                        </span>
                            @endif
                        </div>
                        <div class="col-md-1">
                            <b>OR</b>
                        </div>
                        <div class="col-md-5">
                            {{Form::text('icon_class',$data->icon_class,array('class'=>'form-control','placeholder'=>'Ex: fa fa-facebook, ion-gear-a'))}}
                            <span>Use : <a class="btn btn-link" href="http://fontawesome.io/icons/">Font Awesome</a>, <a class="btn btn-link" href="http://ionicons.com/">ion icons</a></span>
                        </div>
                        <? $max=$max_serial+1; ?>
                        <div class="col-md-2">
                            {{Form::number('serial_num',$data->serial_num, ['min'=>'1','class' => 'form-control','required'])}}
                            <span>Category Serial</span>
                        </div>
                    </div>

                    <div class="form-group">
                        {{Form::label('post_type', 'Order/Apply Label', array('class' => 'col-md-2 control-label'))}}
                        <div class="col-md-2">
                            {{Form::text('order_label',$value=$data->order_label,['class'=>'form-control','placeholder'=>'Ex: Order, Request, Apply'])}}
                        </div>


                        {{Form::label('post_type', 'Category Type', array('class' => 'col-md-2 control-label'))}}
                        <div class="col-md-3">
                            {{Form::select('post_type', array('1' => 'Normal Category', '2' => 'Special/Blog'), $data->post_type, ['class' => 'form-control'])}}
                        </div>

                        {{Form::label('post_type', 'Ad view type', array('class' => 'col-md-2 control-label'))}}
                        <div class="col-md-3">
                            {{Form::select('ad_view_type', array('1' => 'Grid View', '2' => 'List View'), $data->ad_view_type, ['class' => 'form-control'])}}
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-10 col-md-offset-2">
                            {{Form::submit('Save Change',array('class'=>'btn btn-lg btn-info'))}}
                        </div>
                    </div>

                    {!! Form::close() !!}


                </div>
            </div>
        </div>
    </div>



</div> <!--end content-->


@endsection

