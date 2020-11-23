@extends('frontend.master')

@section('title') My Profile | Khojlei Paibaa | Shob Paibaa  @endsection


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

                    <div class="dashboard_main">
                        <div class="dashboard_heding">
                            <h3> My All Ads </h3>
                        </div>
                        {{--<div class="row">--}}
                            {{--<div class=" col-md-12 all_ads">--}}
                                {{--<ul class="list-unstyled m-0">--}}
                                    {{--<li class="my_ad m-b-15"><a href="19-My_Ads-Page.html#"> All(42) </a></li>--}}
                                    {{--<li class="my_ad m-b-15"><a href="19-My_Ads-Page.html#"> Published (88) </a></li>--}}
                                    {{--<li class="my_ad m-b-15"><a href="19-My_Ads-Page.html#"> Featured (12) </a></li>--}}
                                    {{--<li class="my_ad m-b-15"><a href="19-My_Ads-Page.html#"> Sold (02) </a></li>--}}
                                    {{--<li class="my_ad m-b-15"><a href="19-My_Ads-Page.html#"> Active (42) </a></li>--}}
                                    {{--<li class="my_ad m-b-15"><a href="19-My_Ads-Page.html#"> Expired (01) </a></li>--}}
                                {{--</ul>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        <div class="row m-t-15">
                            <div id="recent-transactions" class="col-12"> <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                <div class="heading-elements"> </div>
                                <div class="table">
                                    <table class="table table-xl mb-0 table-responsive">
                                        <thead>
                                        <tr>
                                            <th class="border-top text-capitalize ml-44">
                                                {{--<input class="form-check-input" value="" type="checkbox">--}}
                                                photos
                                            </th>
                                            <th class="border-top text-capitalize">title </th>
                                            <th class="border-top text-capitalize">category </th>
                                            <th class="border-top text-capitalize">ad status </th>
                                            <th class="border-top text-capitalize">price </th>
                                            <th class="border-top text-capitalize">action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if(count($adPost)>0)
                                        @foreach($adPost as $data)
                                        <tr>
                                            <td class="text-truncate">
                                                <div class="form-check">
                                                    {{--<input class="form-check-input" value=""  type="checkbox">--}}
                                                    <div class="recent_img">
                                                        @if(file_exists('images/post_photo/small/'.$data->postPhoto->photo_one))
                                                            <img class="img-fluid rounded-top" src="{{asset('images/post_photo/small/'.$data->postPhoto->photo_one)}}" alt="{{$data->title}}" title="{{$data->title}}">

                                                        @else
                                                            <img class="img-fluid rounded-top" src="{{asset('/images/default/photo.png')}}" alt="{{$data->title}}" title="{{$data->title}}">
                                                        @endif
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-truncate"><p>{{$data->title}}</p></td>
                                            <td class="text-truncate">{{$data->postCategory->category_name}}</td>
                                            <td>
                                                @if($data->status==1 && $data->is_approved==1)
                                                <button type="button" class="btn btn-sm active_btn">Active</button>
                                                    @else
                                                    <button type="button" class="btn btn-sm btn-warning" title="Your ad is pending or Inactive">Inactive</button>
                                                @endif
                                            </td>
                                            <td class="text-truncate"><strong>{{$data->price}}</strong></td>
                                            <td class="text-truncate">
                                                {!! Form::open(array('route' => ['ad-post.destroy',$data->id],'method'=>'DELETE','id'=>"deleteForm$data->id")) !!}

                                                <span>
                                                <button type="button" value="butten"><a href="{{URL::to('ad-post/'.$data->id.'/edit')}}" title="Click here to edit this ad">  <i class="fa fa-pencil"></i> </a>  </button>
                                                </span>

                                                <span>
                                                <button type="button" value="butten" onclick='return deleteConfirm("deleteForm{{$data->id}}")' title="Click here to delete this ad">  <i class="fa fa-trash"></i></button>
                                                </span>

                                                {!! Form::close() !!}


                                            </td>
                                        </tr>
                                        @endforeach
                                            @endif

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <nav aria-label="Page navigation example">
                        <ul class="pagination justify-content-center m-t-20 m-b-50">
                            {{$adPost->render()}}
                        </ul>
                    </nav>
                    <div class="single-sidebar m-b-50"> <img class="add_img img-fluid" src="{{asset('/frontend')}}/images/discount-img.png" alt="Classified Plus"> </div>

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
            $('#loadArea').load('{{URL::to("load-area-by-division-town")}}/'+id);

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
