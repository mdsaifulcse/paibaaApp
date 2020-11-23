@extends('frontend.master')

@section('title') Update My User Name | Khojlei Paibaa | Shob Paibaa  @endsection


@section('content')

    <!-- breadcrumb -->
    <div class="iner_breadcrumb bg-light p-t-10 p-b-10">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{URL::to('/')}}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Profile Setting</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- End breadcrumb -->


    <section class="dashboard_sec m-t-30">
        <div class="container my-account-bg">
            <div class="row">
                <div class="col-md-3">
                    @include('frontend.my-account.sidebar')
                </div>
                <div class="col-md-9">

                    <div class="row">
                        <div class="@if($userData->social_id==null)col-md-6 @else col-md-8 @endif m-t-40 margin_top">
                            <div class="profile_detail">
                                <h3>Update Username </h3>
                                {!! Form::open(['route'=>['change.my.username'],'method'=>'POST','files'=>true]) !!}
                                    <div class="form-group">
                                        <label>Username</label>
                                        <input type="hidden" name="id" id="userId" value="{{$userData->id}}" />
                                        {{Form::text('user_name',$value=isset($userData->user_name)?$userData->user_name:'',['class'=>'form-control','required'=>true])}}
                                        {{Form::hidden('old_user_name',$value=$userData->user_name)}}
                                        @if ($errors->has('user_name'))
                                            <span class="help-block">
                                                <strong class="text-danger">{{ $errors->first('user_name') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                    <button class="update_btn mt-2 text-capitalize" type="submit" value="button" id="updateBtn">update</button>
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                    <div class="single-sidebar m-t-50 m-b-50">
                        <img class="add_img img-fluid" src="{{asset('/frontend')}}/images/discount-img.png" alt="Classified Plus">
                    </div>
                </div>
            </div>
        </div>
    </section>


@endsection

@section('script')

    <script>

        $('.type-pass').keypress(function() {
            $('#changeSubmit').attr('type','submit')
        });
    </script>

    <script>
        $('#passwordChangeForm').on('submit',function (e) {
            e.preventDefault()

            var n = $('#newPassword').val().localeCompare($('#passwordConfirmation').val());
            if (parseInt(n)<0){
                $('#confirmPassError').text('Confirmed Password Does Not Match')
                $('#changeSubmit').html('Change Now')
                return false
            }else {
                $('#confirmPassError').text(' ')
                $(this).unbind().submit();
            }
        })

    </script>

    <script>
        $('.maxlength').keypress(function() {
            if (this.value.length >= 11) {
                return false;
            }
        });
    </script>

    <script>
        $('#userMobileUpdata').on('blur',function () {

            if (Number($('#userMobileUpdata').val().length<11) || Number($('#userMobileUpdata').val().length>11) || $('#userMobileUpdata').val().substring(0, 2)!=='01'){
                $('#updateMobileError').html('Valid Mobile Number must be 11 digit')
                $('#updateBtn').attr('disabled',true)
                return true;
            }else {
                $('#updateMobileError').html('')
                $('#updateBtn').attr('disabled',false)
            }


            $.ajax({
                url:'{{url("/check-unique-user")}}'+'/'+$('#userMobileUpdata').val()+'/'+$('#userId').val() ,
                type: 'GET',
                'dataType' : 'json',
                success: function(data) {
                    if (data.userData===null){
                        $('#updateBtn').attr('disabled',false)
                        $('#updateMobileError').html('')
                    }else {
                        $('#updateBtn').attr('disabled',true)
                        $('#updateMobileError').html('Mobile Number Already Taken')
                    }
                }
            })
        })
    </script>

    <script type="text/javascript">

        function loadArea(id){
            $('#loadArea').load('{{URL::to("load-area-on-profile")}}/'+id);
        }
    </script>

    <script>
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
