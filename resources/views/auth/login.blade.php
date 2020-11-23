@extends('auth.master')
@section('content')
    <style>
        .paddingBottom{
            padding-bottom: 20px;
        }
        .register-form{
            padding: 50px;
        }
        .register-form .only-border-bottom{
            border: none;
            border-bottom: 1px solid #d5d5d5;
            border-radius: 0px;
            box-shadow: none;
        }
        .login_btn{
            border-radius: 50px;
            margin-left: 41%;
            padding: 7px 15px;
            color: #004eff;
            border: 1px solid #E91E63;
        }
        .social-login{
            padding:30px;
            margin-top: 20%;
        }
        .social-login a{
            display: flex;
            overflow: hidden;
            background: #4267b2;
            height: 41px;
            width: 100%;
            text-align: center;
            font-size: 17px;
            color: #fff;
            border-radius: 0px;
            border: 1px solid #4267b2;
            margin-bottom: 15px;
            text-decoration: none;
            transition: all 0.3s ease;
            padding: 6px;
        }
        .social-login a img{
            padding-right: 5px;
        }
        @media only screen and (max-width :768px) {
            .register-form{
                padding-top: 10px;
            }
            .social-login{
                margin-top: 0%;
            }
        }

    </style>
    <div class="paddingBottom"> </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-2 col-md-2 col-sm-3 col-xs-12">
                <a href="{{URL::to('/')}}" class=" ">
                    <img src="{{asset('/frontend')}}/images/logo.png" alt="Paibaa | Khojlei Paibaa" class="img-responsive center-block">
                </a>
            </div>

            <div class="col-lg-8 col-md-8 col-sm-9 col-xs-12">
                <div class="text-center">
                    <h1>Paibaa Sign</h1>
                    <h5> New to Paibaa ? <a href="{{URL::to('/register')}}"> Create an Account </a></h5>

                    <?php Session::put('odRf',$odRf)?>

                </div>
            </div>
        </div>
    </div>
    <hr>

    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" style="border-right: 1px solid #aeaaaa;">
                <div class="register-form">
                    {!! Form::open(['url'=>'/login','id'=>'clientReg','method'=>'POST']) !!}
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group has-feedback">
                                {{Form::text('mobile',$value=old('mobile'),['class'=>'form-control only-border-bottom','placeholder'=>'Mobile/Email *','required'=>true])}}

                                @if(Session::has('error'))
                                    <span class="help-block text-danger">
                                <strong class="text-danger">{{Session::get('error')}}</strong>
                            </span>
                                @endif

                            </div>
                        </div>


                        <div class="col-sm-12">
                            <div class="form-group has-feedback">
                                {{Form::password('password',['class'=>'form-control only-border-bottom','placeholder'=>'Password *','min'=>8,'required'=>true])}}

                            </div>
                        </div>



                    </div>
                    <div class="form-group">
                        <button type="submit"  class="buttons login_btn text-center" value="Login">
                            Sign In
                        </button>
                    </div>
                    <div class="form-info">
                        <p class="text-center "></p>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div><!-- Register area -->

            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <div class="list-unstyled list-inline social-login">
                    <a href="{{URL::to('social-login/facebook')}}" class="facebook"> <img src="{{asset('/frontend')}}/images/fb.png" alt="Classified Plus"> Continue wiith Facbook</a>
                    <a href="#" class="google" style="background-color: #2687d5ad;"> <img src="{{asset('/frontend')}}/images/google_p.png" alt="Classified Plus"> <span>Continue with Google</span></a>
                </div>
            </div><!-- social register area -->
        </div>
    </div>

@endsection

@section('script')

@endsection
