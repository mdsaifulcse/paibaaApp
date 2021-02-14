@extends('frontend.master')

@section('title')
   {{$adDetails->title}} | paibaa | khujlei paibaa
@endsection

@section('style')
    <link rel="stylesheet" href="{{asset('/frontend')}}/css/owlcarousel/owl.carousel.min.css" />
    <link rel="stylesheet" href="{{asset('/frontend')}}/css/owlcarousel/owl.theme.default.min.css" />

    <link rel="stylesheet" href="{{asset('/frontend')}}/datepicker/css/pickmeup.css" />
@endsection

@section('content')
    <style>
        .nounderline{
            text-decoration: none !important;
        }
        .badge-info{
            background-color: #8BC34A;
        }
    </style>

    <div class="iner_breadcrumb p-t-0 p-b-0">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{URL::to('/')}}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{URL::to('ads/bangladesh/'.$adDetails->postCategory->link)}}">{{$adDetails->postCategory->category_name}}</a></li>
                    {{--<li class="breadcrumb-item active" aria-current="page">
                        <a href="{{URL::to('ads/bangladesh/'.$adDetails->postCategory->link.'?subcategory='.$adDetails->adSubCategory->first()->id)}}">{{$adDetails->adSubCategory->first()->sub_category_name}}
                        </a>
                    </li>--}}
                    <li class="breadcrumb-item " aria-current="page">{{$adDetails->title}}</li>
                </ul>
            </nav>
        </div>
    </div>


    <section class="detail_part m-t-5">
        <div class="container">
            <div class="row">
                @if($adDetails->postCategory->post_type==1)
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                    <div class="detail_box owl-carousel owl-theme">
                        <div>
                        @if(file_exists('images/post_photo/big/'.$adDetails->postPhoto->photo_one))
                            <img class="img-fluid" src="{{asset('images/post_photo/big/'.$adDetails->postPhoto->photo_one)}}" alt="{{$adDetails->title}}">
                        </div>
                        @else
                        <img class="img-fluid" src="{{asset('/images/default/photo.png')}}" alt="{{$adDetails->title}}">
                    </div>
                        @endif

                        @if($adDetails->postPhoto->photo_two!='')
                            <div><img class="img-fluid" src="{{asset('images/post_photo/big/'.$adDetails->postPhoto->photo_two)}}" alt="{{$adDetails->title}}"></div>
                        @endif

                        @if($adDetails->postPhoto->photo_three!='')
                            <div><img class="img-fluid" src="{{asset('images/post_photo/big/'.$adDetails->postPhoto->photo_three)}}" alt="{{$adDetails->title}}"></div>
                        @endif
                        @if($adDetails->postPhoto->photo_four!='')
                            <div><img class="img-fluid" src="{{asset('images/post_photo/big/'.$adDetails->postPhoto->photo_four)}}" alt="{{$adDetails->title}}"></div>
                        @endif
                    </div>

                    <p style="padding-top: px"><i class="fa fa-clock-o them-color"></i> {{date('d-M-Y h:i a',strtotime($adDetails->updated_at))}}
                        <i class="fa fa-map-marker them-color"></i>
                        <?php

                        $allLocations=$adDetails->adLocation->pluck('url')->toArray();
                        ?>

                    </p>
                    <br>
                    Location:
                    @forelse($allLocations as $allLocation)

                        <a href="{{URL::to('ads/'."$allLocation".'/'.$adDetails->postCategory->link)}}" class="nounderline">
                            <span class="badge badge-secondary">{{$allLocation}}</span>
                        </a>

                    @empty
                        <span>No Category</span>
                    @endforelse


                    <hr>
                    Category:
                        @forelse($adDetails->adSubCategory as $subCatName)
                            <a href="{{URL::to('ads/bangladesh/'.$adDetails->postCategory->link.'?subcategory='.$subCatName->id)}}" class="nounderline">
                                <span class="badge badge-secondary">{{$subCatName->sub_category_name}}</span>
                            </a>
                        @empty
                            <span>No Category</span>
                            @endforelse

                    <hr>
                    Tags:
                        @forelse($tags as $tag)
                            <a href="{{URL::to('/tag/'.str_replace(' ','-',$tag))}}" class="nounderline">
                                <span class="badge badge-secondary">{{$tag}}</span>
                            </a>

                        @empty
                            <span>No Tag</span>
                        @endforelse
                </div>
            @endif

                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                    <div class="detail_box">
                        <div class="detail_head">
                            <p><a href="{{URL::to('/profile/'.$adDetails->postAuthor->user_name)}}"> {{$adDetails->postAuthor->name}} </a>
                                {{--<a href="{{URL::to('/profile/'.$adDetails->postAuthor->user_name)}}" class="pull-right"> View author all Ads </a>--}}
                                <br>
                            </p>
                            <h3> {{$adDetails->title}}</h3>

                            @if(count($adDetails->adPostPrice)>0)
                                <ul class="deal-price list-unstyled text-capitalize m-b-0 m-t-15" id="orderPriceTitle">
                                    @foreach($adDetails->adPostPrice as $key=>$adPostPrice)
                                    <li class="d-inline-block p-r-20 every-price">
                                        <?php
                                        if ($adPostPrice->is_negotiable==1){$readOnly='true'; }else{$readOnly='false';}
                                        ?>
                                            <span class="rend-blog-price-type">
                                                <a href="{{URL::to('price/'.$adPostPrice->price_title.'?cat='.$adDetails->postCategory->link)}}" class="order-price-title">
                                                    {{$adPostPrice->price_title}}
</a>
                                            </span>

                                            <label>
                                                <input type="checkbox" name="offer_price[{{$adPostPrice->price_title}}]" />
                                                BDT {{round($adPostPrice->price)}}

                                            </label>
                                    </li>

                                    @endforeach
                                </ul>

                                <ul class="deal-price list-unstyled text-capitalize m-b-0 m-t-15" id="requestPriceTitle" style="display: none">
                                    @foreach($adDetails->adPostPrice as $key=>$adPostPrice)
                                        <li class="d-inline-block p-r-20 every-price">
                                            <?php
                                            if ($adPostPrice->is_negotiable==1){$readOnly='true'; }else{$readOnly='false';}
                                            ?>
                                            <span class="rend-blog-price-type">
                                                {{$adPostPrice->price_title}} </span> :<span class="price">

                                            {{Form::number("offer_price[$adPostPrice->price_title]",$value=round($adPostPrice->price), ['min'=>0,'readonly'=>false])}}
                                        </span>
                                            <label> &nbsp; BDT <input type="checkbox" name="price_title[]" value="{{$adPostPrice->price_title}}"></label>
                                        </li>

                                    @endforeach
                                </ul>

                                <ul class="list-unstyled text-capitalize m-b-0 m-t-15">

                                    <li class="d-inline-block p-r-20">
                                        <?php
                                        if (Session::has('odRf')){
                                            Session::forget('odRf');
                                        }
                                        ?>

                                        @if(!Auth::check())
                                            <a href="{{URL::to('/login?'.'od_rf='.Request::path())}}" class="price-request"> Request </a>
                                        @elseif(Auth::check() && Auth::user()->id==$adDetails->user_id)
                                            <span>This is your Ad </span>

                                        @elseif(!Auth::check() || empty($priceNegotiation))

                                        <a href="javascript:void(0)" class="price-request" title="Click here to Request" onclick="makeOffer()" > Request</a>

                                        @elseif(!empty($priceNegotiation) && $priceNegotiation->ad_post_id==$adDetails->id)
                                        <a href="javascript:void(0)" class="price-request send-request"> Already Requested <i class="fa fa-check" aria-hidden="true"></i> </a>
                                        @endif


                                            @if(!Auth::check())
                                            &nbsp; <a href="{{URL::to('/login?'.'od_rf='.Request::path())}}" class="price-request" title="Click here to {{$adDetails->postCategory->order_label}}" > {{$adDetails->postCategory->order_label}}</a>
                                            @elseif(Auth::check() && Auth::user()->id!=$adDetails->user_id)
                                                <a href="javascript:void(0)" class="price-request" title="Click here to {{$adDetails->postCategory->order_label}}" onclick="makeOrder()" > {{$adDetails->postCategory->order_label}}</a>
                                                @endif
                                    </li>

                                </ul>

                                @endif
                        </div>


                    </div>

                    <div class="description_box">
                        <?php echo $adDetails->description;?>
                    </div>
                    <hr>
                    <ul class="list-unstyled d-inline-block float-left detail_left m-b-0">
                        <li class="meetup"><i class="fa fa-handshake-o" aria-hidden="true"></i> Phone &nbsp; </li>
                    </ul>
                    <ul class="list-unstyled d-inline-block m-l-40 detail_right  m-b-0">
                        <li class="meetup"><i class="fa fa-mobile them-color"></i> {{$adDetails->contact}}</li>
                    </ul>
                    <br>
                    <ul class="list-unstyled d-inline-block float-left detail_left m-b-0">
                        <li class="meetup"><i class="fa fa-handshake-o" aria-hidden="true"></i> Meetup</li>
                    </ul>
                    <ul class="list-unstyled d-inline-block m-l-40 detail_right  m-b-0">
                        <li class="meetup"><i class="fa fa-map-marker them-color"></i> {{$adDetails->address}}</li>
                    </ul>


                <!--Request Start Modal -->
                    <div class="modal fade" id="requestModal" role="dialog" data-keyboard="false" data-backdrop="static">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h5 class="modal-title request-title"> &nbsp; Request to author with your message ( {{$adDetails->postAuthor->name}} ) </h5>
                                </div>
                                <div class="modal-body">



                                    {!! Form::open(['route'=>'price-negotiation.store','method'=>'POST']) !!}

                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group has-feedback">
                                                {{Form::hidden('ad_post_id',$value=$adDetails->id,['class'=>'form-control','required'=>true] )}}
                                            </div>
                                            @if ($errors->has('ad_post_id'))
                                                <span class="help-block">
                                                    <strong class="text-danger">{{ $errors->first('ad_post_id') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group has-feedback">
                                                {{Form::textarea('request_message','',['rows'=>'3','class'=>'form-control request-message','placeholder'=>'Write some message','required'=>true])}}
                                                @if ($errors->has('request_message'))
                                                    <span class="help-block">
                                        <strong class="text-danger">{{ $errors->first('request_message') }}</strong>
                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-sm-12">
                                            <div class="form-group has-feedback">
                                                <ul class="deal-price list-unstyled text-capitalize m-b-0 m-t-15" id="requestPriceTitleLi">


                                                </ul>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="form-group">

                                        <button type="submit" class="buttons login_btn" name="login" value="Continue">Send Request </button>

                                    </div>

                                    {!! Form::close() !!}


                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>

                <!--Request End Modal -->


                <!--Order Start Modal -->
                    <div class="modal fade" id="priceDealModal" role="dialog" data-keyboard="false" data-backdrop="static">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h5 class="modal-title request-title"> &nbsp;{{$adDetails->postCategory->order_label}} to author with your message ( {{$adDetails->postAuthor->name}} ) </h5>
                                </div>
                                <div class="modal-body">

                                    {!! Form::open(['route'=>'customer-order.store','method'=>'POST','files'=>true]) !!}

                                    <div class="row">

                                        <div class="col-sm-12">
                                            <div class="form-group has-feedback">
                                                <input type="hidden" name="ad_post_id" value="{{$adDetails->id}}" required >
                                            </div>
                                        </div>

                                        <div class="col-sm-12">
                                            <div class="form-group has-feedback">
                                                {{Form::textarea('txt_message','',['rows'=>'3','class'=>'form-control request-message','placeholder'=>'Write some message','required'=>true])}}
                                                @if ($errors->has('txt_message'))
                                                    <span class="help-block">
                                                        <strong class="text-danger">{{ $errors->first('txt_message') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                    @if($adDetails->category_id==1) <!-- NEED -->

                                        <div class="col-sm-12">
                                            <div class="form-group has-feedback">

                                                <label>Please choose pdf file</label>
                                                {{Form::file('attach_file',['class'=>'form-control','accept'=>'application/pdf','title'=>'Please chose pdf file','required'=>true] )}}
                                            </div>

                                            @if ($errors->has('attach_file'))
                                                <span class="help-block">
                                                        <strong class="text-danger">{{ $errors->first('attach_file') }}</strong>
                                                    </span>
                                            @endif
                                        </div>

                                    @endif

                                    @if($adDetails->category_id==2) <!-- SALE -->
                                        <div class="col-sm-12">
                                            <div class="form-group has-feedback">

                                                {{Form::text('delivery_address',$value='',['title'=>'Delivery address * ','class'=>'form-control','placeholder'=>'Delivery address *','readonly'=>false,'required'=>true] )}}
                                            </div>

                                            @if ($errors->has('delivery_address'))
                                                <span class="help-block">
                                                    <strong class="text-danger">{{ $errors->first('delivery_address') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    @endif

                                    @if($adDetails->category_id==4) <!-- Service -->
                                        <div class="col-sm-12">
                                            <div class="form-group has-feedback">

                                                {{Form::text('service_meet_up',$value='',['title'=>'Meet up address ','class'=>'form-control','placeholder'=>'Delivery address *','readonly'=>false,'required'=>true] )}}
                                            </div>

                                            @if ($errors->has('service_meet_up'))
                                                <span class="help-block">
                                                    <strong class="text-danger">{{ $errors->first('service_meet_up') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    @endif


                                    @if($adDetails->category_id==3 || $adDetails->category_id==4) <!-- Rent and  Service -->

                                        <?php
                                        if ($adDetails->category_id==3){
                                            $required=true;
                                        }else{
                                            $required=false;
                                        }
                                        ?>
                                        <div class="col-md-3 col-md-3">
                                            <div class="form-group has-feedback">
                                                <label>Date Start</label>
                                                {{Form::text('booking_date_start',$value='',['class'=>'dateStart form-control','required'=>$required] )}}
                                            </div>

                                            @if ($errors->has('booking_date_start'))
                                                <span class="help-block">
                                                        <strong class="text-danger">{{ $errors->first('booking_date_start') }}</strong>
                                                    </span>
                                            @endif
                                        </div>

                                        <div class="col-md-3 col-md-3">
                                            <div class="form-group has-feedback">
                                                <label>Time Start</label>
                                                {{Form::time('booking_time_start',$value='',['class'=>'form-control','required'=>$required] )}}
                                            </div>

                                            @if ($errors->has('booking_time_start'))
                                                <span class="help-block">
                                                        <strong class="text-danger">{{ $errors->first('booking_time_start') }}</strong>
                                                    </span>
                                            @endif
                                        </div>

                                        <!-- Date and time end -->


                                        <div class="col-md-3 col-md-3">
                                            <div class="form-group has-feedback">
                                                <label>Date End</label>
                                                {{Form::text('booking_date_end',$value='',['class'=>'dateEnd form-control','required'=>$required] )}}
                                            </div>

                                            @if ($errors->has('booking_date_end'))
                                                <span class="help-block">
                                                        <strong class="text-danger">{{ $errors->first('booking_date_end') }}</strong>
                                                    </span>
                                            @endif
                                        </div>

                                        <div class="col-md-3 col-md-3">
                                            <div class="form-group has-feedback">
                                                <label>Time End</label>
                                                {{Form::time('booking_time_end',$value='',['class'=>'form-control','required'=>$required] )}}
                                            </div>

                                            @if ($errors->has('booking_time_end'))
                                                <span class="help-block">
                                                        <strong class="text-danger">{{ $errors->first('booking_time_end') }}</strong>
                                                    </span>
                                            @endif
                                        </div>

                                        @endif


                                        <div class="col-sm-12">
                                            <div class="form-group has-feedback">

                                                <ul class="deal-price list-unstyled text-capitalize m-b-0 m-t-15" id="priceTitleToAuthor">


                                                </ul>
                                            </div>
                                        </div>

                                        </div><!-- end row -->
                                        <div class="form-group">

                                            <button type="submit" class="buttons login_btn"
                                                    name="login" value="Continue" onclick="return confirm('Please Check Again') ">Submit {{$adDetails->postCategory->order_label}} </button>

                                        </div>

                                        {!! Form::close() !!}
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <!-- End Order modal -->
            </div>
    </section>


<hr>
    <section class="description">
        <div class="container">

            <!-- Row  -->
            <div class="row justify-content-left">
                <div class="col-md-7 text-left">

                </div>
            </div>
            <!-- Row  -->

            <div class="row">
                <div class="col-md-8">
                    <h5 class=" badge-info p-1"> Comment</h5>

                    <section class="iner_breadcrumb p-t-20 p-b-20">


                        <div class="row">
                            <div class="col-md-1 col-sm-3">
                                <div class="">
                                    @if(!empty(auth()->user()->image))
                                        <img class="comment-user-img" src="{{asset(auth()->user()->image)}}">
                                    @else
                                        <img class="comment-user-img" src="{{asset('/images/default/photo.png')}}">
                                    @endif
                                </div>

                            </div>
                            <div class="col-md-11 col-sm-9">
                                @if(Auth::check() && Auth::user()->status==0)

                                    <p class="text-center m-b-10">
                                        <span class="text-danger">Your Profile is not complete, Please complete</span>
                                        <a href="{{URL::to('my-profile')}}" class="price-request"> Profile </a>
                                    </p>

                                    <?php $readonly='readonly'?>
                                @else
                                    <?php $readonly=''?>
                                @endif
                                <strong></strong>
                                {!! Form::open(['url'=>'/ad-public-comment-save','method'=>'POST','id'=>'commentForm','data-route'=>'ad-public-comment']) !!}

                                <input type="hidden" name="user_id" value="{{Auth::check() && Auth::user()->id}}" id="userId">
                                <input type="hidden" name="ad_post_id" value="{{$adDetails->id}}" id="adPostId">

                                <textarea name="comment" id="comment" {{$readonly}} onclick="openCommentBox(this.value)" onkeyup="openCommentBox(this.value)" rows="2" class="form-control comment-box" placeholder="Add Public Comment"></textarea>
                                <span class="text-danger comment-error" style="display: none"> Comment is required !</span>

                                <div class="submitCancel pull-right m-t-5 " style="display: none">
                                    <span class="btn btn-default cancel">CANCEL</span> &nbsp;&nbsp;&nbsp;&nbsp; <button type="submit" disabled class="btn btn-success" id="commentSubmit"> COMMENT </button>
                                </div>

                                {!! Form::close() !!}
                            </div>
                        </div>


                        {{--<div class="row">--}}
                            {{--<div class="col-md-2">--}}
                                {{--<h5 class="text-left"> Comment</h5>--}}
                            {{--</div>--}}
                            {{--<div class="col-md-10">--}}
                                {{--<h5><a href="{{URL::to('/login')}}" class="price-request">  Login </a>  for Comment <i class="fa fa-commenting-o" aria-hidden="true"></i> Or Get <a href="javascript:void(0)" data-toggle="modal" data-target="#register" class="badge-primary"> Register </a>  </h5>--}}
                            {{--</div>--}}
                        {{--</div>--}}

                        <hr>
                        <!-- Start Comment show  -->
                        <div id="commentData">
                            <?php $numberOfComment=count($comments);?>
                            @if($numberOfComment>0)
                                @foreach($comments->take(3) as $comment)
                                    <div class="row m-t-20">
                                        <div class="col-md-1 col-sm-3">
                                            <div class="">
                                                @if(!empty($comment->commentAuthor->image))
                                                    <a href="{{URL::to('/profile/'.$comment->commentAuthor->user_name)}}">
                                                    <img class="comment-user-img" src="{{asset($comment->commentAuthor->image)}}"></a>
                                                @else
                                                    <a href="{{URL::to('/profile/'.$comment->commentAuthor->user_name)}}">
                                                    <img class="comment-user-img" src="{{asset('/images/default/photo.png')}}">
                                                    </a>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-11 col-sm-9">

                                            <h6><a href="{{URL::to('/profile/'.$comment->commentAuthor->user_name)}}"> <strong>{{$comment->commentAuthor->name}} </strong></a>{{$comment->created_at->diffForHumans()}} </h6>
                                            <h6> {{$comment->comment}}</h6>

                                            {!! Form::close() !!}
                                        </div>
                                    </div>
                                @endforeach

                                @if($numberOfComment>3)
                                <button class="btn btn-info btn-sm m-t-10" id="seeMoreComment"> See more</button>
                                @endif

                            @endif
                        </div>

                        <!-- end comment show -->

                    </section>

                </div>


                <div class="col-md-4">
                    <div class="single-sidebar">
                        <!--  Chat Start -->
                        {{-- && !empty($currentChatUser) && count($getChatReplayData)>0--}}
                        @if(Auth::check() && (count($getChatReplayData)>0 || count($getChatOfferData)>0))
                            <h6 class=" badge-info p-1 "> <i class="fa fa-comments-o" aria-hidden="true"></i> Chat</h6>
                                <div class="card  bg-dark text-white">
                                    <div class="card-header">
                                        <div>

                                            @if(count($offerUsers)>0)
                                                <div class="">
                                                    <label class="control-label price-request"> Chat Partner</label>

                                                    {{Form::select('user_id',$offerUsers,$currentChatUser->id,['id'=>'CurrentUser','class'=>'form-control','required'=>true])}}
                                                </div>
                                            @endif
                                            <span>
                                                <img id="chatUserImage" style="width: 25px;border-radius: 50%" src="@if(!empty($currentChatUser->image)) {{asset($currentChatUser->image)}} @else {{asset('/images/default/photo.png')}} @endif ">
                                            </span>
                                                <span id="chatUserName"> @if(!empty($currentChatUser)) {{$currentChatUser->name}} @endif </span>

                                        </div>
                                    </div>
                                    <div class="card-body">

                                        <div class="row">

                                            <div class="col-md-2 col-sm-3">
                                                <div class="">
                                                    @if(!empty(auth()->user()->image))
                                                        <img class="chat-user-img" src="{{asset(auth()->user()->image)}}">
                                                    @else
                                                        <img class="chat-user-img" src="{{asset('/images/default/photo.png')}}">
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="col-md-10 col-sm-9">

                                            @if(Auth::user()->status==0)

                                                <p class="text-center m-b-10">
                                                    <span class="text-danger">Your Profile is not complete, Please complete</span>
                                                    <a href="{{URL::to('my-profile')}}" class="price-request"> Profile </a>
                                                </p>

                                                <?php $readonly='readonly'?>
                                            @else
                                                <?php $readonly=''?>
                                            @endif


                                                {!! Form::open(['url'=>'/ad-public-comment-save','method'=>'POST','id'=>'chatForm','data-route'=>'ad-public-comment']) !!}

                                                <input type="hidden" name="user_id" value="{{!empty($currentChatUser)?$currentChatUser->id:Auth::user()->id}}" id="chatUserId">
                                                <input type="hidden" name="ad_post_id" value="{{$adDetails->id}}" id="chatAdPostId">
                                                <input type="hidden" name="offer" value="{{$offer==1?2:1}}" id="chatOffer">

                                                <textarea name="request_message" id="requestMessage" {{$readonly}} onclick="openChatBox(this.value)" onkeyup="openChatBox(this.value)" class="form-control comment-box" placeholder=" Type a Message" autofocus></textarea>
                                                <span class="text-danger chat-error" style="display: none"> Message is required !</span>

                                                <div class="chatSubmitCancel pull-right m-t-5 " style="display: none">
                                                    <span class="btn btn-default chatCancel">CANCEL</span> &nbsp;&nbsp;&nbsp;&nbsp; <button type="submit" disabled class="btn btn-success" id="chatSubmit"> Send </button>
                                                </div>

                                                {!! Form::close() !!}

                                            </div>
                                        </div>


                                    </div>
                                    <div class="card-footer" style="min-height: 200px; max-height: 400px; overflow: scroll;">

                                        <!-- Start Chat Offer Data show ---------------------------  -->
                                        @if(count($getChatOfferData)>0 && $offer==1)
                                            <div id="chatData">
                                                @foreach($getChatOfferData as $offer)
                                                    <div class="row m-b-10 conversation">
                                                        <div class="col-md-2 col-sm-3">
                                                            <div class="">
                                                                @if($offer->offer==1)
                                                                    <a href="{{URL::to('/profile/'.$offer->offeredUser->user_name)}}">
                                                                    <img class="chat-user-img" src="@if(!empty($offer->offeredUser->image)) {{asset($offer->offeredUser->image)}} @else {{asset('/images/default/photo.png')}} @endif ">
                                                                    </a>
                                                                @elseif($offer->offer==2)
                                                                    <a href="{{URL::to('/profile/'.$offer->replayUser->user_name)}}">
                                                                    <img class="chat-user-img" src="@if(!empty($offer->replayUser->image)) {{asset($offer->replayUser->image)}} @else {{asset('/images/default/photo.png')}} @endif ">
                                                                    </a>
                                                                @endif

                                                            </div>
                                                        </div>

                                                        <div class="col-md-10 col-sm-9">

                                                            @if($offer->offer==1)
                                                                <h6 class="user-time">
                                                                    <a href="{{URL::to('/profile/'.$offer->offeredUser->user_name)}}">
                                                                        <strong>{{$offer->offeredUser->name}} </strong></a>

                                                                    {{$offer->created_at->diffForHumans()}} </h6>
                                                            @elseif($offer->offer==2)
                                                                <h6 class="user-time">
                                                                    <a href="{{URL::to('/profile/'.$offer->replayUser->user_name)}}">
                                                                    <strong>{{$offer->replayUser->name}}</strong>
                                                                    </a>
                                                                    {{$offer->created_at->diffForHumans()}} </h6>
                                                            @endif

                                                            <h6> {{$offer->request_message}}</h6>

                                                            {!! Form::close() !!}
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>


                                        <!-- Start Chat Replay Data show ---------------------------  -->
                                    @endif


                                    <!-- Start Chat Replay show  -->
                                    @if(count($getChatReplayData)>0 && $offer==2)
                                        <div id="chatData">
                                            @foreach($getChatReplayData as $replay)
                                                <div class="row m-b-10 conversation">
                                                    <div class="col-md-2 col-sm-3 com-xs-6">
                                                        <div class="">
                                                            @if($replay->offer==1)
                                                                <a href="{{URL::to('/profile/'.$replay->offeredUser->user_name)}}">
                                                                <img class="chat-user-img" src="@if(!empty($replay->offeredUser->image)) {{asset($replay->offeredUser->image)}} @else {{asset('/images/default/photo.png')}} @endif ">
                                                                </a>
                                                            @elseif($replay->offer==2)
                                                                <a href="{{URL::to('/profile/'.$replay->replayUser->user_name)}}">
                                                                <img class="chat-user-img" src="@if(!empty($replay->replayUser->image)) {{asset($replay->replayUser->image)}} @else {{asset('/images/default/photo.png')}} @endif ">
                                                                </a>
                                                            @endif

                                                        </div>
                                                    </div>

                                                    <div class="col-md-10 col-sm-9 col-xs-6">
                                                        @if($replay->offer==1)
                                                            <h6 class="user-time"> <strong>
                                                                    <a href="{{URL::to('/profile/'.$replay->offeredUser->user_name)}}">
                                                                    {{$replay->offeredUser->name}}
                                                                    </a>
                                                                </strong>{{$replay->created_at->diffForHumans()}} </h6>
                                                        @elseif($replay->offer==2)
                                                            <h6 class="user-time">
                                                                <a href="{{URL::to('/profile/'.$replay->replayUser->user_name)}}">
                                                                <strong>
                                                                    {{$replay->replayUser->name}}

                                                                </strong>
                                                                </a>
                                                                {{$replay->created_at->diffForHumans()}} </h6>
                                                        @endif

                                                        <h6> {{$replay->request_message}}

                                                            @if($replay->price_message!='')
                                                                <br>
                                                                Price: {{$replay->price_message}}
                                                                @endif

                                                        </h6>

                                                        {!! Form::close() !!}
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif

                                    </div>
                                </div>


                        @else

                        @endif

                    <!-- end Chat show -->

                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="top_listings">
        <div class="container">

            <!-- Row  -->
            <div class="row">
                <div class="col-md-3  m-b-10">
                    <h5 class=" price-request p-1">You might also like</h5>
                </div>
            </div>
            <!-- Row  -->

            <div class="row">
                <div class="col-md-10 col-lg-10">
                    <div class="row">
                        @if(count($activeAds)>0)
                            @foreach($activeAds as $key=>$activeAd)
                                <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">
                                    <div class="featured-parts rounded m-b-30">
                                        <div class="featured-img">

                                            <a href="{{URL::to('ad/'.$activeAd->link)}}" title="{{$activeAd->title}}">
                                                @if(file_exists('images/post_photo/small/'.$activeAd->postPhoto->photo_one))
                                                    <img class="img-fluid rounded-top" src="{{asset('images/post_photo/small/'.$activeAd->postPhoto->photo_one)}}" alt="{{$activeAd->title}}">

                                                @else
                                                    <img class="img-fluid rounded-top" src="{{asset('/images/default/photo.png')}}" alt="{{$activeAd->title}}">
                                                @endif
                                            </a>

                                            {{--<div class="featured-new bg_warning1"> <a href="#"> New </a> </div>--}}
                                            <div class="featured-price">
                                                <a href="javascript:void(0)">৳ {{ number_format($activeAd->price)  }} </a>
                                            </div>
                                        </div>

                                        <div class="featured-text">
                                            <div class="text-top d-flex justify-content-between ">
                                                <div class="heading"> <a href="{{URL::to('ad/'.$activeAd->link)}}" title="{{$activeAd->title}}">
                                                        <?php
                                                        if (strlen($activeAd->title) != strlen(utf8_decode($activeAd->title)))
                                                        {
                                                            echo substr($activeAd->title,0,48);
                                                        }else{
                                                            echo substr($activeAd->title,0,19);
                                                        }
                                                        ?>
                                                        ...</a> </div>
                                                {{--<div class="book-mark"><a href="#"><i class="fa fa-bookmark"></i></a></div>--}}
                                            </div>
                                            <div class="text-stars m-t-5">
                                                <p><strong > {{$activeAd->postCategory->category_name}} </strong> > {{substr('sub category name here',0,12)}}</p>

                                            </div>
                                            <div class="featured-bottum m-b-30">
                                                <ul class="d-flex justify-content-between list-unstyled m-b-20">
                                                    <li><a href="{{URL::to('ad/'.$activeAd->link)}}"><i class="fa fa-map-marker"></i> {{'division_town'}} </a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif

                        {{--<button class="view-btn hvr-pulse-grow" type="submit" value="button">View all</button>--}}

                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-md-12">
                    <div class="single-sidebar m-b-50 m-t-50 text-center"> <img class="add_img img-fluid" src="{{asset('/frontend')}}/images/discount-img.png" alt="Paibaa | Khojlei Paibaa"> </div>
                </div>
            </div>
        </div>
    </section>





@endsection



@section('script')
    <!-- datepickeer -->
<script src="{{asset('/frontend/datepicker/js/pickmeup.js')}}"></script>

<script>
    //priceTitleToAuthor
    function makeOffer() {
        //$('#offerPrice').val($('#offer_price').val())

        $("#requestPriceTitleLi").empty().append($('#requestPriceTitle').html());

        $('#requestModal').modal('show')
    }

    //priceTitleToAuthor
    function makeOrder() {
        //$('#offerPrice').val($('#offer_price').val())

        $("#priceTitleToAuthor").empty().append($('#orderPriceTitle').html());

        $('#priceDealModal').modal('show')
    }
</script>

 <script>
     addEventListener('DOMContentLoaded', function () {
         pickmeup('.dateStart', {
             position       : 'center',
             hide_on_select : true
         });

         var plus_5_days = new Date;
         plus_5_days.setDate(plus_5_days.getDate() + 2);

         pickmeup('.dateEnd', {
             position       : 'center',
             hide_on_select : true,
             date      : [
                 plus_5_days
             ]
         });
     });



 </script>

    {{-- ===================== Chagge Chat Person =================== --}}

    <script>
        $('#CurrentUser').on('change',function () {

            var currentUser=$(this).val()
            var adPostId=$('#chatAdPostId').val()

            $('#chatData').empty().load('{{URL::to("load-chat-data-by-user")}}'+'/'+adPostId+'/'+currentUser)

            var imags='{{asset('/')}}'

            $.ajax({
                type:'GET',
                url:'{{URl::to("get-chat-user-info")}}'+'/'+currentUser,
                success:function (data) {
                    $('#chatUserId').empty().val(data.userInfo.id)
                    $('#chatUserName').empty().text(data.userInfo.name)
                    $('#chatUserImage').attr( 'src', imags+data.userInfo.image)
                }

            })

        })


    </script>

    {{--Chat Section ---------------}}

    <script>
        function openChatBox(value) {

            $('.chatSubmitCancel').css('display','block')

            if(value.length>0){
                $('#chatSubmit').attr('disabled',false)
            }else {
                $('#chatSubmitCancel').attr('disabled',true)
            }
        }


        // hide submit button -----------------------
        $('.chatCancel').on('click',function () {
            $('.chatSubmitCancel').css('display','none')
        })


        //  ========  Submit Chat Message  ========
        $('#chatForm').submit(function (e) {
            e.preventDefault()
            console.log($('#chatForm').data('route'))

            if($('#requestMessage').val().length>0){
                $('#chatSubmit').attr('disabled',false)
                $('.comment-error').css('display','none')

                var route=$('#chatForm').data('route');
                //console.log($('#chatForm').serialize());

                $.ajax({
                    type: 'get',
                    url:"{{URL::to('/send-chat-message')}}",
                    data:$('#chatForm').serialize(),
                    success:function (data) {
                        if (data='success'){
                            $('#requestMessage').val('')
                            $('#chatSubmit').attr('disabled',true)
                            // comment load comments data ----------
                            loadChatData($('#chatAdPostId').val(),$('#chatOffer').val(),$('#chatUserId').val())
                        }
                    }
                })

            }else {
                $('#chatSubmit').attr('disabled',true)
                $('.chat-error').css('display','block')
                return false;
            }
        })

        function loadChatData(adPostId,chatOffer,userId) {
            $('#chatData').empty().load('{{URL::to("load-chat-data")}}'+'/'+adPostId+'/'+chatOffer+'/'+userId)
        }


        // For live chat ---------

        setInterval(function(){

            loadChatData($('#chatAdPostId').val(),$('#chatOffer').val(),$('#chatUserId').val())
            console.log('sdf')

        }, 7000);

    </script>

    {{--Comment Section ------------}}
    <script>
        function openCommentBox(value) {

            $('.submitCancel').css('display','block')

            if(value.length>0){
                $('#commentSubmit').attr('disabled',false)
            }else {
                $('#commentSubmit').attr('disabled',true)
            }

            var commentText=value.replace('http://','')
             commentText=commentText.replace('https://www.','')
             commentText=commentText.replace('https://','')
             commentText=commentText.replace('http://www.','')
             commentText=commentText.replace('paibaa.com','https://www.paibaa.com')
            $('#comment').val(commentText)



            if(value.length>200){
                $('#commentSubmit').attr('disabled',true)
                $('.comment-error').text('Max 200 Character')
                $('.comment-error').css('display','block')
            }else {
                $('.comment-error').text('')
                $('.comment-error').css('display','none')
                $('#commentSubmit').attr('disabled',false)
            }

        }


        // hide submit button -----------------------
        $('.cancel').on('click',function () {
            $('.submitCancel').css('display','none')
        })


        //  ========  Submit comment  ========
        $('#commentForm').submit(function (e) {
            e.preventDefault()

            {{--if($('#userId').val()==''){--}}
                {{--window.location.href='{{URL::to('/login')}}'--}}
            {{--}--}}

            if($('#comment').val().length>0){
                $('#commentSubmit').attr('disabled',false)
                $('.comment-error').css('display','none')

                var route=$('#commentForm').data('route');
                //console.log($('#commentForm').serialize());

                $.ajax({
                    type: 'get',
                    url:"{{URL::to('/ad-public-comment-save')}}",
                    data:$('#commentForm').serialize(),

                    success:function (data) {

                        console.log(data)

                        if (data=='success'){
                             console.log('321')
                            $('#comment').val('')
                            $('#commentSubmit').attr('disabled',true)
                            // comment load comments data ----------
                            loadData($('#adPostId').val())
                        }

                         if(data.adPostComment){
                            console.log('123')
                            $('.comment-error').css('display','block')
                            $('.comment-error').text('Only one Comment a day')
                        }
                    },
                    error:function (error) {
                        if(error.status==401){
                            var adPostId=$('#adPostId').val()
                            window.location.href='{{URL::to('/ad-public-comment-save')}}'+'?ad_post_id='+adPostId
                        }
                    }
                })

            }else {
                $('#commentSubmit').attr('disabled',true)
                $('.comment-error').css('display','block')
                return false;
            }
        })

        function loadData(adPostId) {
            $('#commentData').empty().load('{{URL::to("load-comments-data")}}'+'/'+adPostId)
        }


        $('#seeMoreComment').on('click',function () {
            loadData($('#adPostId').val())

            $('#seeMoreComment').hide();
        })

    </script>


    <script src="{{asset('/frontend')}}/js/owlcarousel/owl.carousel.min.js"></script>


    <script>
        $(document).ready(function(){
            $(".owl-carousel").owlCarousel(
                {
                    stagePadding: 50,loop:true,margin:0,nav:true,
                    responsive:{
                        0:{ items:1 },
                        600:{ items:1},
                        1000:{items:1}
                    },
                    center:true,autoWidth:true, navText:["<i class=\"fa fa-angle-left\" aria-hidden=\"true\"></i>","<i class=\"fa fa-angle-right\" aria-hidden=\"true\"></i>"],
                    dots:false

                }
            );
        });
    </script>


@endsection