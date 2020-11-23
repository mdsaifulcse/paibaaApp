@extends('backend.app')

@section('breadcrumb')

      <ol class="breadcrumb">
        <li><a href="{{URL::to('home')}}"><i class="fa fa-home"></i> Home</a></li>
        <li><a href="{{url('all-users')}}">Admin</a></li>
        <li class="active">Create</li>
      </ol>

   @endsection

@section('content')

<div class="content">
  <div class="row">
    <div class="col-md-12">
    <!-- general form elements -->
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Add New Admin</h3>

            <div class="card-btn pull-right">
              <a href="{{URL::to('all-users')}}"><button type="button" class="btn btn-success btn-xs">All Admin</button></a>
            </div>
        </div>
        <div class="box-body">
            <div class="col-md-8 col-md-offset-2" style="margin-top: 20px;">
                <div class="row">
                    {{$errors}}
                        {!! Form::open(['route'=>'all-users.store','method'=>'POST','role'=>'form','data-toggle'=>'validator','class'=>'form-horizontal','files'=>'true'])  !!}
        
                        <div class="form-group row">
                            <label for="name" class="col-md-2 col-form-label text-md-right">{{ __('Name') }}</label>
        
                            <div class="col-md-8">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>
        
                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                    <div class="form-group row">
                        <label for="mobile" class="col-md-2 col-form-label text-md-right">{{ __('Mobile Number') }}</label>

                        <div class="col-md-8">
                            <input id="mobile" type="number" class="form-control{{ $errors->has('mobile') ? ' is-invalid' : '' }}" name="mobile" value="{{ old('mobile') }}" required>

                            @if ($errors->has('mobile'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('mobile') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>
        
                        <div class="form-group row">
                            <label for="email" class="col-md-2 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
        
                            <div class="col-md-8">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}">
        
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
        
        
                        <div class="form-group row">
                            <label for="password" class="col-md-2 col-form-label text-md-right">{{ __('Password') }}</label>
        
                            <div class="col-md-8">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
        
                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
        
                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-2 col-form-label text-md-right">{{ __('Confirm Password') }}</label>
        
                            <div class="col-md-8">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>
        
        
                    <div class="form-group ">
                        <label for="slide_photo" class="col-md-2 control-label"> Photo</label>
                        <div class="col-md-8">
                            <label class="slide_upload profile-image" for="file">
                                    <img id="image_load" src="{{asset('images/default/photo.png')}}">
                            </label>
        
                            <input id="file" style="display:none" name="image" type="file" onchange="photoLoad(this,this.id)">
        
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 control-label">Role </label>
                        <div class="col-md-4 no-padding">
                                {{Form::select('role_id',$roles,'',['class'=>'form-control select','required','placeholder'=>'-Select Role-'])}}
                                @if ($errors->has('role_id'))
                                    <span class="help-block">
                                            <small>{{ $errors->first('role_id') }}</small>
                                        </span>
                                @endif
                            </div>


                        
                    </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-2"></div>
                            <div class="col-md-8">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                            {{Form::close()}}
        
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
