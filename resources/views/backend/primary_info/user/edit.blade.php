@extends('backend.app')

@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="{{URL::to('home')}}"><i class="fa fa-home"></i> Home</a></li>
        <li><a href="{{url('all-users')}}">Admin</a></li>
        <li class="active">Edit</li>
    </ol>
@endsection
@section('content')

    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Edit Admin</h3>

                        <div class="card-btn pull-right">
                            <a href="{{route('all-users.edit',$data->id)}}"><button type="button" class="btn btn-warning btn-sm">Password Change</button></a>
                            <a href="{{URL::to('all-users')}}"><button type="button" class="btn btn-success btn-sm">All Admin</button></a>
                        </div>



                    </div>




                    <div class="col-md-8 col-md-offset-2">
                        <div class="row">



                            {!! Form::open(array('route' =>['all-users.update',$data->id],'method'=>'PUT','class'=>'form-horizontals','files'=>true)) !!}

                            <div class="box-body">

                                <div class="form-group row">
                                    <label for="username3" class="col-sm-2 col-form-label">Admin Name</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" value="{{$data->name}}" name="name" placeholder="name">
                                        @if ($errors->has('name'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                                <input type="hidden" value="{{$data->id}}" name="id"/>
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Mobile Number</label>
                                    <div class="col-sm-10">
                                        <input type="number" class="form-control" value="{{$data->mobile}}" name="mobile"  placeholder="mobile">
                                        @if ($errors->has('mobile'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('mobile') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
                                    <div class="col-sm-10">
                                        <input type="email" class="form-control" value="{{$data->email}}" name="email"  placeholder="Email">
                                        @if ($errors->has('email'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>




                                <div class="form-group ">
                                    <label for="slide_photo" class="col-md-2 control-label"> Photo</label>
                                    <div class="col-md-10">
                                        <label class="slide_upload profile-image" for="file">
                                            <!--  -->

                                            @if($data->image!=null)
                                                <img id="image_load" src='{{asset("$data->image")}}' class="img-responsive">
                                            @else
                                                <img id="image_load" src="{{asset('images/default/photo.png')}}">
                                            @endif

                                        </label>

                                        {{Form::file('image',array('id'=>'file','style'=>'display:none','onchange'=>"photoLoad(this,this.id)"))}}

                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-2 control-label">Role </label>
                                    <div class="col-md-4 no-padding">
                                        {{Form::select('role_id',$roles,$data->role_id,['class'=>'form-control select','required','placeholder'=>'-Select Role-'])}}
                                        @if ($errors->has('role_id'))
                                            <span class="help-block">
                                          <small>{{ $errors->first('role_id') }}</small>
                                      </span>
                                        @endif
                                    </div>


                                </div>



                                <div class="form-group row">
                                    <div class="col-sm-10">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Submit') }}
                                        </button>


                                    </div>
                                </div>

                            </div>

                            {!! Form::close() !!}


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection

@section('script')

    <script type="text/javascript">


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

@endsection
