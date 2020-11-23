@extends('backend.app')
@section('content')
    <div id="content" class="content">

        <div class="row">
            <div class="col-lg-12">
                <div class="box box-danger">

                    <div class="box-header with-border bg-gray-active">
                        <h4 class="box-title"> Create New Page </h4>
                        <a href="{{URL::to('pages')}}" class="btn btn-primary btn-sm pull-right"> <i class="fa fa-list"></i> All Pages </a>
                    </div>

                    <div class="box-body ">

                        {!! Form::open(array('route' => 'pages.store','class'=>'form-horizontal','files'=>true)) !!}
                        {{--<div class="form-group  {{ $errors->has('link') ? 'has-error' : '' }}">--}}

                            {{--{{Form::label('link', 'Page link', array('class' => 'col-md-3 control-label'))}}--}}
                            {{--<div class="col-md-8">--}}
                                {{--<div class="input-group">--}}
                                    {{--<div class="input-group-addon">{{URL::to('page')}}/</div>--}}
                                    {{--{{Form::text('link','',array('class'=>'form-control','placeholder'=>'Page link','required'))}}--}}
                                {{--</div>--}}
                                {{--@if ($errors->has('link'))--}}
                                    {{--<span class="help-block">--}}
                        {{--<strong>{{ $errors->first('link') }}</strong>--}}
                    {{--</span>--}}
                                {{--@endif--}}
                            {{--</div>--}}
                        {{--</div>--}}

                        <div class="form-group">
                            {{Form::label('name', 'Page Name', array('class' => 'col-md-3 control-label'))}}
                            <div class="col-md-8">
                                {{Form::text('name',$value=old('name'),array('class'=>'form-control','placeholder'=>'Page Name','required'))}}
                            </div>
                        </div>


                        <div class="form-group">
                            {{Form::label('title', 'Page Title', array('class' => 'col-md-3 control-label'))}}
                            <div class="col-md-8">
                                {{Form::textArea('title',$value=old('title'),array('class'=>'form-control textareas','placeholder'=>'Page Title','required','rows'=>'2'))}}
                            </div>
                        </div>


                        <div class="form-group">
                            {{Form::label('description', 'Description', array('class' => 'col-md-3 control-label'))}}
                            <div class="col-md-8">
                                {{Form::textArea('description',$value=old('description'),array('class'=>'form-control textarea','placeholder'=>'Write some thing about page','rows'=>'10','required'=>false))}}

                                @if ($errors->has('description'))
                                    <span class="help-block text-danger">
                                    <strong class="text-danger">{{ $errors->first('description') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            {{Form::label('status', 'Status', array('class' => 'col-md-3 control-label'))}}
                            <div class="col-md-2">
                                {{Form::select('status', array('1' => 'Active', '2' => 'Inactive'),'1', ['class' => 'form-control'])}}
                            </div>

                            {{Form::label('status', 'Serial No.', array('class' => 'col-md-2 control-label'))}}
                            <div class="col-md-2">
                                {{Form::number('serial_num', $value=$serialNum, ['min'=>0,'class' => 'form-control','readonly'=>true])}}
                            </div>
                        </div>

                        <div class="from-group col-md-6 multiple_upload">
                            <!-- Load multiple photo -->
                        </div>

                        <div class="form-group">
                            <div class="col-md-9 col-md-offset-3">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </div>
                    {!! Form::close() !!}


                    </div>
                </div>
            </div>
        </div><!--end row-->



    </div><!--end content-->


@endsection


