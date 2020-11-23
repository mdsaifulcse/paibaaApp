@extends('frontend.master')

@section('title')
    Paibaa | khujlei Paibaa | Shob Paibaa
@endsection


@section('content')

    <section class="top_listings">
        <div class="container">
            <div class="row m-t-10 margin_top">
                <div class="col-md-2 col-sm-12 col-xs-12">
                    <div class="sidebar-wrapper">
                        <div class="single-sidebar">
                            <div class="sec-title">

                                <ul class="categories clearfix slide">
                                    @if(count($adSubCategories)>0)
                                        @foreach($adSubCategories as $adSubCategory)
                                    <li class="@if($subCategoryInfo!='' && $subCategoryInfo->id==$adSubCategory->subCatByCat->id) active-category @else '' @endif">
                                        <a href="{{URL::to('ads/bangladesh/'.$category->link.'?subcategory='.$adSubCategory->subCatByCat->id)}}"> {{$adSubCategory->subCatByCat->sub_category_name}}
                                            ({{number_format($adSubCategory->subCatByCat->totalSubCatAd->total_ad)}})  </a>


                                        <!-- submenu start -->

                                        <!-- submenu end -->


                                    </li>
                                        @endforeach
                                        @else
                                        <li class=" active-category ">
                                            <a href="javascript:void(0)"> No Sub-subcategory  </a>
                                        </li>
                                        @endif

                                </ul>
                            </div>
                            {{--<div class="single-sidebar">--}}
                                {{--<div class="sec-title">--}}
                                    {{--<h3 class="condition mb-2">Condition</h3>--}}
                                    {{--<div class="form-group form-check condition-slide">--}}
                                        {{--<input type="checkbox" class="form-check-input">--}}
                                        {{--<label class="form-check-label text-uppercase">New</label>--}}
                                    {{--</div>--}}
                                    {{--<div class="form-group form-check condition-slide">--}}
                                        {{--<input type="checkbox" class="form-check-input">--}}
                                        {{--<label class="form-check-label text-uppercase">Used</label>--}}
                                    {{--</div>--}}
                                {{--</div>--}}

                            {{--</div>--}}

                        </div>
                    </div>
                    <div class="single-sidebar mt-4">
                        <img class="add_img img-fluid" src="{{asset('/frontend')}}/images/google_adds1.png" alt="Paibaa | Khojlei Paibaa">
                    </div>
                </div>

                <div class="col-md-10 col-sm-12 col-xs-12">
                    <div class="row">
                        <div class="col-md-12 col-lg-12">
                            <h6 class=""><a href="{{URL::to('/')}}"> <i class="fa fa-home"></i> Home</a> / <a href="{{URL::to('/')}}"> All Ads</a> /
                                <a href="{{URL::to('/ads/bangladesh/'.$category->link)}}"> {{$category->category_name}}</a>
                            </h6>
                            <hr>
                        </div>
                @if(count($activeAds)>0)
                    @foreach($activeAds as $key=>$activeAd)

                    @if($activeAd->postCategory->ad_view_type==1) <!-- ======================== For Grid View ===================== -->

                        <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">
                            <div class="featured-parts rounded m-b-30">
                                <div class="featured-img">
                                    <a href="{{URL::to('ad/'.$activeAd->link)}}">
                                        @if(file_exists($activeAd->postPhoto->photo_one))
                                            <img class="img-fluid rounded-top" src="{{asset('images/post_photo/small/'.$activeAd->postPhoto->photo_one)}}" alt="{{$activeAd->title}}" title="{{$activeAd->title}}">

                                        @else
                                            <img class="img-fluid rounded-top" src="{{asset('/images/default/photo.png')}}" alt="{{$activeAd->title}}" title="{{$activeAd->title}}">
                                        @endif
                                    </a>

                                    {{--<div class="featured-new bg_warning1"> <a href="#"> New </a> </div>--}}
                                    <div class="featured-price">
                                        <a href="javascript:void(0)">৳ {{number_format($activeAd->price)}} </a>
                                    </div>
                                </div>
                                <div class="featured-text">
                                    <div class="text-top d-flex justify-content-between ">
                                        <div class="heading"> <a href="{{URL::to('ad/'.$activeAd->link)}}" title="{{$activeAd->title}}">{{substr( $activeAd->title,0,19)}} ...</a> </div>
                                        {{--<div class="book-mark"><a href="#"><i class="fa fa-bookmark"></i></a></div>--}}
                                    </div>
                                    <div class="text-stars m-t-5">
                                        <p title="<?php

                                        $allSubCat=$activeAd->adSubCategory->pluck('sub_category_name')->toArray();
                                        foreach ($allSubCat as $subCatData){
                                            echo $subCatData.' , ';
                                        }?>"> <strong > {{$category->category_name}} </strong> >
                                            @if($subCategoryInfo!='')
                                            {{$activeAd->adSubCategory->where('id',$subCategoryInfo->id)->first()->sub_category_name}}
                                                @else
                                                {{$activeAd->adSubCategory->first()->sub_category_name}}
                                            @endif
                                        </p>

                                    </div>
                                    <div class="featured-bottum m-b-30">
                                        <ul class="d-flex justify-content-between list-unstyled m-b-20">
                                            <li><a href="{{URL::to('ad/'.$activeAd->link)}}" title="<?php

                                                $allLocations=$activeAd->adLocation->pluck('location_name')->toArray();
                                                foreach ($allLocations as $locationData){
                                                    echo $locationData.' , ';
                                                }?>"><i class="fa fa-map-marker them-color"></i> {{$activeAd->adLocation->first()->location_name}} </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                    @elseif($activeAd->postCategory->ad_view_type==2) <!-- ========================= For List view =================== -->

                        <div class="col-xl-10 col-lg-10 col-md-10 col-sm-12">
                            <div class="featured-parts rounded m-t-10 m-b-10">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="featured-img">
                                            <a href="{{URL::to('ad/'.$activeAd->link)}}" title="{{$activeAd->title}}">
                                                @if(file_exists('images/post_photo/small/'.$activeAd->postPhoto->photo_one))
                                                    <img class="img-fluid rounded-top" src="{{asset('images/post_photo/small/'.$activeAd->postPhoto->photo_one)}}" alt="{{$activeAd->title}}">

                                                @else
                                                    <img class="img-fluid rounded-top" src="{{asset('/images/default/photo.png')}}" alt="{{$activeAd->title}}">
                                                @endif
                                            </a>
                                        </div>
                                    </div>

                                    <div class="col-md-9">
                                        <div class="featured-text">
                                            <div class="text-top d-flex justify-content-between ">
                                                <div class="heading"> <a href="{{URL::to('/ad/'.$activeAd->link)}}" title="{{$activeAd->title}}">{{$activeAd->title}}</a>

                                                    @if($activeAd->postCategory->post_type==1) <!-- Special Category -->
                                                    <ul class="deal-price list-view-price-request list-unstyled text-capitalize m-b-5 m-t-15">

                                                        <li class="d-inline-block p-r-20">
                                                            <span class="rend-blog-price-type"> post filed </span> <strong> ৳ </strong> :<span class="price">
                                            {{Form::number('offer_price',$value=round($activeAd->price), ['id'=>'offer_price','min'=>0,'readonly'=>false])}}
                                            </span> <span> &nbsp; BDT</span>
                                                        </li>

                                                        <li class="d-inline-block p-r-20">
                                                            @if(Auth::check() && Auth::user()->id==$activeAd->postAuthor->id)
                                                                <span>This is your Ad</span>
                                                            @elseif(!Auth::check() || empty($activeAd->userPriceNegotiation))
                                                                <a href="javascript:void(0)" class="price-request" title="Click here to Price Negotiate" onclick="makeOffer({{$activeAd->id}})" > Request </a>
                                                            @elseif(!empty($activeAd->userPriceNegotiation) && $activeAd->userPriceNegotiation->ad_post_id==$activeAd->id)
                                                                <a href="javascript:void(0)" class="price-request send-request"> Send Request <i class="fa fa-check"></i> </a>
                                                            @endif
                                                        </li>
                                                    </ul>
                                                        @endif
                                                </div>
                                                {{--<div class="book-mark"><a href="31-Listing_left-sidebar_List-Page.html#"><i class="fa fa-bookmark"></i></a></div>--}}
                                            </div>

                                            <a  href="{{URL::to('/ad/'.$activeAd->link)}}" class="list-view-short-details">
                                                <p class="">
                                                    <?php
                                                    if (strlen($activeAd->description) != strlen(utf8_decode($activeAd->description)))
                                                    {
                                                        echo substr($activeAd->description,0,800);
                                                    }else{

                                                        echo substr($activeAd->description,0,150);
                                                    }
                                                    ?>

                                                </p>
                                            </a>


                                        </div>
                                    </div>
                                </div> <!-- end row -->

                            </div>
                        </div>

                        @endif

                    @endforeach

                        <div class="clearfix"></div>
                        {{--<div class="col-md-12">--}}
                            {{--<button class="view-btn hvr-pulse-grow" type="submit" value="button">View all</button>--}}
                        {{--</div>--}}
                        @else
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                            <h5 class="text-center text-danger m-b-20"><i class="fa fa-warning"></i> No Ad Data Found !</h5>
                            </div>

                        @endif

                    </div>
                </div>
            </div>
        </div>
    </section>



    <!-- Make offer modal  -->
    <div class="modal fade" id="priceDealModal" role="dialog" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h5 class="modal-title request-title"> Request to post author with your affordable price</h5>
                </div>
                <div class="modal-body">

                    {!! Form::open(['route'=>'price-negotiation.store','method'=>'POST']) !!}

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group has-feedback">

                                {{Form::number('price',$value='',['id'=>'offerPrice','class'=>'form-control','min'=>0,'placeholder'=>'Price is required','readonly'=>false,'required'=>true] )}}
                            </div>

                            @if ($errors->has('price'))
                                <span class="help-block">
                                    <strong class="text-danger">{{ $errors->first('price') }}</strong>
                                </span>
                            @endif

                        </div>
                        <div class="col-sm-12">
                            <div class="form-group has-feedback">
                                {{Form::hidden('ad_post_id',$value='',['id'=>'adPostId','class'=>'form-control','required'=>true] )}}
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
                            @if ($errors->has('ad_post_id'))
                                <span class="help-block">
                                    <strong class="text-danger">{{ $errors->first('ad_post_id') }}</strong>
                                </span>
                            @endif
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



@endsection

@section('script')

    <script>
        $(document).ready(function(){
            $(".sub-all-categories").on('click', function(e){
                $(".sub-slide").slideToggle("slow");
            });
        })
    </script>


    <script>
        function makeOffer(adPostId) {
            $('#offerPrice').val($('#offer_price').val())
            $('#adPostId').val(adPostId)

            $('#priceDealModal').modal('show')
        }
    </script>


    <script>
        function filterAds(filterValue) {

            var min_price=$('#min_price').val()
            var max_price=$('#max_price').val()


            if (filterValue==''){var filterValue=0}


            var subcategoryId=$('#subcategoryId').val();
            var areaId=$('#areaId').val();
            <?php
            $path=request()->path();
            ?>


            if (subcategoryId==''){
            location.href="{{URL::to($path)}}"+'?area_id='+filterValue+'&min_price='+min_price+'&max_price='+max_price;
            }
            else if(subcategoryId!='' && areaId=='') {

                location.href="{{URL::to($path)}}"+'?subcategory='+subcategoryId+'&area_id='+filterValue+'&min_price='+min_price+'&max_price='+max_price;
            }
            else if(subcategoryId!='' && areaId!='') {
                console.log(4)
                location.href="{{URL::to($path)}}"+'?subcategory='+subcategoryId+'&area_id='+filterValue+'&min_price='+min_price+'&max_price='+max_price;
            }
        }


        $('#fieldValue').on('change',function () {

            var min_price=$('#min_price').val()
            var max_price=$('#max_price').val()

            var subcategoryId=$('#subcategoryId').val();
            var areaId=$('#areaId').val();
            var fieldValue=$('#fieldValue').val();

            if(fieldValue==''){fieldValue=0}

            var fieldId=$('#fieldId').val();

            if (subcategoryId=='' && areaId!=''){
                location.href="{{URL::to($path)}}"+'?area_id='+areaId+'&field_value='+fieldValue+'&field_id='+fieldId+'&min_price='+min_price+'&max_price='+max_price;
            }
            else if(subcategoryId!='' && areaId!='') {

                location.href="{{URL::to($path)}}"+'?subcategory='+subcategoryId+'&area_id='+areaId+'&field_value='+fieldValue+'&field_id='+fieldId+'&min_price='+min_price+'&max_price='+max_price;
            }
            else if(subcategoryId!='') {

                location.href="{{URL::to($path)}}"+'?subcategory='+subcategoryId+'&field_value='+fieldValue+'&field_id='+fieldId+'&min_price='+min_price+'&max_price='+max_price;
            }
            else if(subcategoryId=='') {
                location.href="{{URL::to($path)}}"+'?field_value='+fieldValue+'&field_id='+fieldId+'&min_price='+min_price+'&max_price='+max_price;
            }

        })


        $(document).ready(function(){

            $(".price_r").on('click', function(e){
                $(".price-range-block").slideToggle("slow");
            });

            $(function () {
                $("#slider-range").slider({
                    range: true,
                    orientation: "horizontal",
                    min: 0,
                    max: $('#max_price_hide').val(),
                    values: [$('#min_price_hide').val(), $('#max_price_hide').val()],
                    step: 10,

                    slide: function (event, ui) {
                        if (ui.values[0] == ui.values[1]) {
                            return false;
                        }

                        $("#min_price").val(ui.values[0]);
                        $("#max_price").val(ui.values[1]);
                    }
                });

                $("#min_price").val($("#slider-range").slider("values", 0));
                $("#max_price").val($("#slider-range").slider("values", 1));

            });


        });
    </script>
@endsection