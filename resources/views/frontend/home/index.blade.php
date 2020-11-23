{{--@extends('frontend.master')--}}

{{--@section('title')--}}
    {{--@endsection--}}


{{--@section('content')--}}
    {{--@endsection--}}

{{--@section('script')--}}
    {{--@endsection--}}

@extends('frontend.master')

@section('title')
    Paibaa | Khojleye Paibaa | Shob Paibaa
    @endsection


@section('content')

    <section class="featured_ads bg-light">
        <div class="container">
            <!-- Row  -->
            <div class="row justify-content-center">
                <div class="col-md-7 text-center">
                    <h2 class="title"></h2>
                </div>
            </div>
            <!-- Row  -->
            <div class="row">
                @if(count($activeAds)>0)
                    @foreach($activeAds as $key=>$activeAd)
                        <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">
                            <div class="featured-parts rounded m-b-30">
                                <div class="featured-img">
                                    <a href="{{URL::to('ad/'.$activeAd->link)}}">
                                        @if(file_exists('images/post_photo/small/'.$activeAd->postPhoto->photo_one))
                                            <img class="img-fluid rounded-top" src="{{asset('images/post_photo/small/'.$activeAd->postPhoto->photo_one)}}" alt="{{$activeAd->title}}" title="{{$activeAd->title}}">

                                        @else
                                            <img class="img-fluid rounded-top" src="{{asset('/images/default/photo.png')}}" alt="{{$activeAd->title}}" title="{{$activeAd->title}}">
                                        @endif
                                    </a>
                                    {{--<div class="featured-new bg_warning1"> <a href="#"> New </a> </div>--}}
                                    <div class="featured-price">
                                        <a href="javascript:void(0)">৳ {{ number_format($activeAd->price)  }} </a>
                                    </div>
                                </div>
                                <div class="featured-text">
                                    <div class="text-top d-flex justify-content-between ">
                                        <div class="heading">
                                            <a href="{{URL::to('ad/'.$activeAd->link)}}" title="{{$activeAd->title}}">
                                                <?php
                                                if (strlen($activeAd->title) != strlen(utf8_decode($activeAd->title)))
                                                    {
                                                        echo substr($activeAd->title,0,57);
                                                    }else{
                                                    echo substr($activeAd->title,0,19);
                                                    }
                                                ?>
                                                ...</a>
                                        </div>
                                        {{--<div class="book-mark"><a href="#"><i class="fa fa-bookmark"></i></a></div>--}}
                                    </div>
                                    <div class="text-stars m-t-5">
                                        <p data-toggle="tooltip1" data-placement="top" title="<?php

                                      $allSubCat=$activeAd->adSubCategory->pluck('sub_category_name')->toArray();
                                      foreach ($allSubCat as $subCatData){
                                          echo $subCatData.' , ';
                                      }?>">
                                            <strong > {{$activeAd->postCategory->category_name}} </strong> > {{$activeAd->adSubCategory->first()->sub_category_name}}

                                        </p>

                                    </div>
                                    <div class="featured-bottum m-b-30">
                                        <ul class="d-flex justify-content-between list-unstyled m-b-20">
                                            <li>
                                            <a href="{{URL::to('ad/'.$activeAd->link)}}" title="<?php

                                            $allLocations=$activeAd->adLocation->pluck('location_name')->toArray();
                                            foreach ($allLocations as $locationData){
                                                echo $locationData.' , ';
                                            }?>"><i class="fa fa-map-marker"></i>

                                            {{$activeAd->adLocation->first()->location_name}}

                                            </a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    @else
                    <div class="col-md-12">
                        <h5 class="text-center text-danger"> No Result Found ! <hr>
                            <a href="{{URL::to('/')}}" class="btn btn-warning btn-warning ">Brows all ads</a>
                        </h5>
                    </div>

                @endif

                    {{--<button class="view-btn hvr-pulse-grow" type="submit" value="button">View all</button>--}}

            </div>
        </div>
    </section>
    <!-- End Featured_ads -->





    @endsection

@section('script')

    <script>
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>

    @endsection