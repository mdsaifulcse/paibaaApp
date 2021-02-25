@extends('frontend.master')

@section('title') My Client Request | Khojlei Paibaa | Shob Paibaa  @endsection


@section('content')

    <style>
        td{
            white-space: normal !important;
        }
    </style>

    <!-- breadcrumb -->
    <div class="iner_breadcrumb bg-light p-t-10 p-b-10">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{URL::to('/')}}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Client Request</li>
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
                            <h3> My Client Request </h3>
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
                                <div class="table table-responsive">
                                    <table class="table table-xl table-bordered mb-0 table-responsive">
                                        <thead>
                                        <tr>

                                            <th class="border-top text-capitalize">Sl</th>
                                            <th class="border-top text-capitalize" width="50%">Message </th>
                                            <th class="border-top text-capitalize">Related Ad </th>
                                            <th class="border-top text-capitalize">Client </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if(count($clientRequests)>0)
                                        @foreach($clientRequests as $key =>$data)
                                        <tr>
                                            <td class="text-truncate">{{$key+1}}</td>
                                            <td class="text-truncate"><a href="{{url('/ad/'.$data->priceNegotiationOfAds->link.'?user='.encrypt($data->request_by).'&offer='.encrypt($data->offer))}}">{{$data->request_message}}</a>
                                            </td>

                                            <td class="text-truncate">
                                                <a href="{{url('/ad/'.$data->priceNegotiationOfAds->link.'?user='.encrypt($data->request_by).'&offer='.encrypt($data->offer))}}"><p>{{$data->priceNegotiationOfAds->title}}</p></a>
                                                </td>

                                            <td class="text-truncate">
                                                <div class="form-check">
                                                    {{--<input class="form-check-input" value=""  type="checkbox">--}}
                                                    <div class="recent_img" style="width: 60px;">
                                                        <a href="{{url('/ad/'.$data->priceNegotiationOfAds->link.'?user='.encrypt($data->request_by).'&offer='.encrypt($data->offer))}}">
                                                            @if(!empty($data->offeredUser->image))
                                                                <img class="img-fluid rounded-top" src="{{asset($data->offeredUser->image)}}" alt="{{$data->offeredUser->name}}" title="{{$data->offeredUser->name}}">

                                                            @else
                                                                <img class="img-fluid rounded-top" src="{{asset('/images/default/photo.png')}}" alt="{{$data->offeredUser->name}}" title="{{$data->offeredUser->name}}">
                                                            @endif

                                                            <span>{{$data->offeredUser->name}}</span>
                                                        </a>
                                                    </div>
                                                </div>
                                            </td>

                                        </tr>
                                        @endforeach
                                            @else
                                            <tr>
                                                <td colspan="4" class="text-center">No Client Request Found !</td>
                                            </tr>

                                            @endif

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <nav aria-label="Page navigation example">
                        <ul class="pagination justify-content-center m-t-20 m-b-50">
                            {{$clientRequests->render()}}
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
