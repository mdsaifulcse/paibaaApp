@extends('frontend.master')

@section('title')
    Paibaa | Khojleye Paibaa | Shob Paibaa
@endsection


@section('content')

    <div class="top_listings_sec p-b-0 p-t-0">
        <div class="container">
            <div class="row">
                <form class="top_listings_search">

                    <div class="form-group selectdiv text-left">
                        <label class="mr-sm-2">Area</label>
                        <select class="form-control text-truncate">
                            <option>All Area</option>
                            <option>2</option>
                            <option>3</option>
                        </select>
                    </div>
                    <div class="form-group selectdiv text-left">
                        <label class="mr-sm-2">Condition</label>
                        <select class="form-control text-truncate">
                            <option>Select One</option>
                            <option>New</option>
                            <option>Used</option>

                        </select>
                    </div>
                    <div class="form-group selectdiv text-left">
                        <label class="mr-sm-2">Sort by</label>
                        <select class="form-control text-truncate">
                            <option>Sort by</option>
                            <option>Top rated</option>
                            <option>Mide rated</option>
                            <option>Low rated</option>

                        </select>
                    </div>
                    <div class="form-group text-left">
                        <p>
                            <label for="amount" class="Price_label2">Price Per Day</label>
                            <input id="amount" readonly="readonly" value="$30 - $500" type="text">
                        </p>
                        <div id="slider-range" class="ui-slider ui-corner-all ui-slider-horizontal ui-widget ui-widget-content bg-success">

                            <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default" style="left: 0%;"></span>
                            <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default" style="left: 100%;"></span>

                            <div class="ui-slider-range ui-corner-all ui-widget-header" style="left: 0%; width: 100%;"></div></div>
                    </div>
                    <div class="form-group text-left text-sm-center text-xs-center">
                        <button type="submit" class="btn btn-primary booknow btn-skin "><i class="fa fa-search fa-custom"></i> Search</button></div>
                </form>
            </div>
        </div>
    </div>

    <section class="top_listings">
        <div class="container">
            <div class="row m-t-40 margin_top">
                <div class="col-md-2 col-sm-12 col-xs-12">
                    <div class="sidebar-wrapper">
                        <div class="single-sidebar">
                            <div class="sec-title">
                                <h3 class="all-categories">All Category</h3>
                                <ul class="categories clearfix slide">
                                    <li class="active-category"><a href="#">Vehicles (1029)</a></li>
                                    <li><a href="#">Electronics (175)</a></li>
                                    <li><a href="#">Mobiles (1800)</a></li>
                                    <li><a href="#">Furniture (3129)</a></li>
                                    <li><a href="#">Fashion (7160)</a></li>
                                    <li><a href="#">Real Estate (600)</a></li>
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
                        <img class="add_img img-fluid" src="{{asset('/frontend')}}/images/google_adds1.png" alt="Classified Plus">
                    </div>
                </div>

                <div class="col-md-10 col-sm-12 col-xs-12">
                    <div class="row">
                        <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">
                            <div class="featured-parts rounded m-b-30">
                                <div class="featured-img"> <img class="img-fluid rounded-top" src="{{asset('/frontend')}}/images/Featured-img-1.png" alt="Classified Plus">
                                    <div class="featured-new bg_warning1"> <a href="#"> New </a> </div>
                                </div>
                                <div class="featured-text">
                                    <div class="text-top d-flex justify-content-between ">
                                        <div class="heading"> <a href="#">Mobile</a> </div>
                                        <div class="book-mark"><a href="#"><i class="fa fa-bookmark"></i></a></div>
                                    </div>
                                    <div class="text-stars m-t-5">
                                        <p>Smartphone for sele</p>
                                        <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> </div>
                                    <div class="featured-bottum m-b-30">
                                        <ul class="d-flex justify-content-between list-unstyled m-b-20">
                                            <li><a href="#"><i class="fa fa-map-marker"></i> East 7th street 98 </a></li>
                                            <li><a href="#"><i class="fa fa-heart-o"></i> Save</a> </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">
                            <div class="featured-parts rounded m-b-30">
                                <div class="featured-img"> <img class="img-fluid rounded-top" src="{{asset('/frontend')}}/images/Featured-img-2.png" alt="Classified Plus"> </div>
                                <div class="featured-text">
                                    <div class="text-top d-flex justify-content-between ">
                                        <div class="heading"> <a href="#">Fashion</a> </div>
                                        <div class="book-mark"><a href="#"><i class="fa fa-bookmark-o"></i></a></div>
                                    </div>
                                    <div class="text-stars m-t-5">
                                        <p>Cloth for sele</p>
                                        <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> </div>
                                    <div class="featured-bottum m-b-30">
                                        <ul class="d-flex justify-content-between list-unstyled m-b-20">
                                            <li><a href="#"><i class="fa fa-map-marker"></i> East 7th street 98 </a></li>
                                            <li><a href="#"><i class="fa fa-heart-o"></i> Save</a> </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>



                        <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">
                            <div class="featured-parts rounded m-b-30">
                                <div class="featured-img"> <img class="img-fluid rounded-top" src="{{asset('/frontend')}}/images/Featured-img-9.png" alt="Classified Plus">

                                </div>
                                <div class="featured-text">
                                    <div class="text-top d-flex justify-content-between ">
                                        <div class="heading"> <a href="#">Vehicles</a> </div>
                                        <div class="book-mark"><a href="#"><i class="fa fa-bookmark"></i></a></div>
                                    </div>
                                    <div class="text-stars m-t-5">
                                        <p>Renger cycle for sele</p>
                                        <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> </div>
                                    <div class="featured-bottum m-b-30">
                                        <ul class="d-flex justify-content-between list-unstyled m-b-20">
                                            <li><a href="#"><i class="fa fa-map-marker"></i> East 7th street 98 </a></li>
                                            <li><a href="#"><i class="fa fa-heart-o"></i> Save</a> </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">
                            <div class="featured-parts rounded m-b-30">
                                <div class="featured-img"> <img class="img-fluid rounded-top" src="{{asset('/frontend')}}/images/Featured-img-10.png" alt="Classified Plus">
                                    <div class="discount bg_warning2"> <a href="#"> Opening now </a> </div>
                                </div>
                                <div class="featured-text">
                                    <div class="text-top d-flex justify-content-between">
                                        <div class="heading"> <a href="#">Job</a> </div>
                                        <div class="book-mark"><a href="#"><i class="fa fa-bookmark-o"></i></a></div>
                                    </div>
                                    <div class="text-stars m-t-5">
                                        <p>Job for web designer</p>
                                        <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> </div>
                                    <div class="featured-bottum m-b-30">
                                        <ul class="d-flex justify-content-between list-unstyled m-b-20">
                                            <li><a href="#"><i class="fa fa-map-marker"></i> East 7th street 98 </a></li>
                                            <li><a href="#"><i class="fa fa-heart-o"></i> Save</a> </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">
                            <div class="featured-parts rounded m-b-30">
                                <div class="featured-img"> <img class="img-fluid rounded-top" src="{{asset('/frontend')}}/images/Featured-img-11.png" alt="Classified Plus">
                                </div>
                                <div class="featured-text">
                                    <div class="text-top d-flex justify-content-between ">
                                        <div class="heading"> <a href="#">Real Estate</a> </div>
                                        <div class="book-mark"><a href="#"><i class="fa fa-bookmark"></i></a></div>
                                    </div>
                                    <div class="text-stars m-t-5">
                                        <p>Luxury house for sele</p>
                                        <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> </div>
                                    <div class="featured-bottum m-b-30">
                                        <ul class="d-flex justify-content-between list-unstyled m-b-20">
                                            <li><a href="#"><i class="fa fa-map-marker"></i> East 7th street 98 </a></li>
                                            <li><a href="#"><i class="fa fa-heart-o"></i> Save</a> </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">
                            <div class="featured-parts rounded m-b-30">
                                <div class="featured-img"> <img class="img-fluid rounded-top" src="{{asset('/frontend')}}/images/Featured-img-13.png" alt="Classified Plus">
                                </div>
                                <div class="featured-text">
                                    <div class="text-top d-flex justify-content-between ">
                                        <div class="heading"> <a href="#">Fashion</a> </div>
                                        <div class="book-mark"><a href="#"><i class="fa fa-bookmark"></i></a></div>
                                    </div>
                                    <div class="text-stars m-t-5">
                                        <p>Ladies sandal for sele</p>
                                        <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> </div>
                                    <div class="featured-bottum m-b-30">
                                        <ul class="d-flex justify-content-between list-unstyled m-b-20">
                                            <li><a href="#"><i class="fa fa-map-marker"></i> East 7th street 98 </a></li>
                                            <li><a href="#"><i class="fa fa-heart-o"></i> Save</a> </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">
                            <div class="featured-parts rounded m-b-30">
                                <div class="featured-img"> <img class="img-fluid rounded-top" src="{{asset('/frontend')}}/images/Featured-img-14.png" alt="Classified Plus"> </div>
                                <div class="featured-text">
                                    <div class="text-top d-flex justify-content-between ">
                                        <div class="heading"> <a href="#">Education</a> </div>
                                        <div class="book-mark"><a href="#"><i class="fa fa-bookmark-o"></i></a></div>
                                    </div>
                                    <div class="text-stars m-t-5">
                                        <p>New courses for students</p>
                                        <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> </div>
                                    <div class="featured-bottum m-b-30">
                                        <ul class="d-flex justify-content-between list-unstyled m-b-20">
                                            <li><a href="#"><i class="fa fa-map-marker"></i> East 7th street 98 </a></li>
                                            <li><a href="#"><i class="fa fa-heart-o"></i> Save</a> </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">
                            <div class="featured-parts rounded m-b-30">
                                <div class="featured-img"> <img class="img-fluid rounded-top" src="{{asset('/frontend')}}/images/Featured-img-15.png" alt="Classified Plus">
                                    <div class="discount"> <a href="#"> Discount 30% </a> </div>
                                    <div class="featured-price"> <a href="#"> $550.00 </a> </div>
                                </div>
                                <div class="featured-text">
                                    <div class="text-top d-flex justify-content-between ">
                                        <div class="heading"> <a href="#">Matrimony</a> </div>
                                        <div class="book-mark"><a href="#"><i class="fa fa-bookmark"></i></a></div>
                                    </div>
                                    <div class="text-stars m-t-5">
                                        <p>jewellery for sele</p>
                                        <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> </div>
                                    <div class="featured-bottum m-b-30">
                                        <ul class="d-flex justify-content-between list-unstyled m-b-20">
                                            <li><a href="#"><i class="fa fa-map-marker"></i> East 7th street 98 </a></li>
                                            <li><a href="#"><i class="fa fa-heart-o"></i> Save</a> </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">
                            <div class="featured-parts rounded m-b-30">
                                <div class="featured-img"> <img class="img-fluid rounded-top" src="{{asset('/frontend')}}/images/Featured-img-16.png" alt="Classified Plus"> </div>
                                <div class="featured-text">
                                    <div class="text-top d-flex justify-content-between ">
                                        <div class="heading"> <a href="#">Vehicles</a> </div>
                                        <div class="book-mark"><a href="#"><i class="fa fa-bookmark"></i></a></div>
                                    </div>
                                    <div class="text-stars m-t-5">
                                        <p>Car BMW for sales</p>
                                        <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> </div>
                                    <div class="featured-bottum m-b-30">
                                        <ul class="d-flex justify-content-between list-unstyled m-b-20">
                                            <li><a href="#"><i class="fa fa-map-marker"></i> East 7th street 98 </a></li>
                                            <li><a href="#"><i class="fa fa-heart-o"></i> Save</a> </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">
                            <div class="featured-parts rounded m-b-30">
                                <div class="featured-img"> <img class="img-fluid rounded-top" src="{{asset('/frontend')}}/images/Featured-img-18.png" alt="Classified Plus"> </div>
                                <div class="featured-text">
                                    <div class="text-top d-flex justify-content-between ">
                                        <div class="heading"> <a href="#">Furniture</a> </div>
                                        <div class="book-mark"><a href="#"><i class="fa fa-bookmark-o"></i></a></div>
                                    </div>
                                    <div class="text-stars m-t-5">
                                        <p>Bed sheet for sele</p>
                                        <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> </div>
                                    <div class="featured-bottum m-b-30">
                                        <ul class="d-flex justify-content-between list-unstyled m-b-20">
                                            <li><a href="#"><i class="fa fa-map-marker"></i> East 7th street 98 </a></li>
                                            <li><a href="#"><i class="fa fa-heart-o"></i> Save</a> </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">
                            <div class="featured-parts rounded m-b-30">
                                <div class="featured-img"> <img class="img-fluid rounded-top" src="{{asset('/frontend')}}/images/Featured-img-19.png" alt="Classified Plus">
                                </div>
                                <div class="featured-text">
                                    <div class="text-top d-flex justify-content-between ">
                                        <div class="heading"> <a href="#">Baby products</a> </div>
                                        <div class="book-mark"><a href="#"><i class="fa fa-bookmark"></i></a></div>
                                    </div>
                                    <div class="text-stars m-t-5">
                                        <p>Bed sheet for sele</p>
                                        <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> </div>
                                    <div class="featured-bottum m-b-30">
                                        <ul class="d-flex justify-content-between list-unstyled m-b-20">
                                            <li><a href="#"><i class="fa fa-map-marker"></i> East 7th street 98 </a></li>
                                            <li><a href="#"><i class="fa fa-heart-o"></i> Save</a> </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">
                            <div class="featured-parts rounded m-b-30">
                                <div class="featured-img"> <img class="img-fluid rounded-top" src="{{asset('/frontend')}}/images/Featured-img-12.png" alt="Classified Plus"> </div>
                                <div class="featured-text">
                                    <div class="text-top d-flex justify-content-between ">
                                        <div class="heading"> <a href="#">Mobile</a> </div>
                                        <div class="book-mark"><a href="#"><i class="fa fa-bookmark"></i></a></div>
                                    </div>
                                    <div class="text-stars m-t-5">
                                        <p>Smartphone for sele</p>
                                        <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> </div>
                                    <div class="featured-bottum m-b-30">
                                        <ul class="d-flex justify-content-between list-unstyled m-b-20">
                                            <li><a href="#"><i class="fa fa-map-marker"></i> East 7th street 98 </a></li>
                                            <li><a href="#"><i class="fa fa-heart-o"></i> Save</a> </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">
                            <div class="featured-parts rounded m-b-30">
                                <div class="featured-img"> <img class="img-fluid rounded-top" src="{{asset('/frontend')}}/images/Featured-img-20.png" alt="Classified Plus"> </div>
                                <div class="featured-text">
                                    <div class="text-top d-flex justify-content-between ">
                                        <div class="heading"> <a href="#">Animals</a> </div>
                                        <div class="book-mark"><a href="#"><i class="fa fa-bookmark"></i></a></div>
                                    </div>
                                    <div class="text-stars m-t-5">
                                        <p>Cat for sales</p>
                                        <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> </div>
                                    <div class="featured-bottum m-b-30">
                                        <ul class="d-flex justify-content-between list-unstyled m-b-20">
                                            <li><a href="#"><i class="fa fa-map-marker"></i> East 7th street 98 </a></li>
                                            <li><a href="#"><i class="fa fa-heart-o"></i> Save</a> </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">
                            <div class="featured-parts rounded m-b-30">
                                <div class="featured-img"> <img class="img-fluid rounded-top" src="{{asset('/frontend')}}/images/Featured-img-17.png" alt="Classified Plus">
                                    <div class="featured-new bg_warning"> <a href="#"> New </a> </div>
                                </div>
                                <div class="featured-text">
                                    <div class="text-top d-flex justify-content-between ">
                                        <div class="heading"> <a href="#">Matrimony</a> </div>
                                        <div class="book-mark"><a href="#"><i class="fa fa-bookmark"></i></a></div>
                                    </div>
                                    <div class="text-stars m-t-5">
                                        <p>jewellery for sele</p>
                                        <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> </div>
                                    <div class="featured-bottum m-b-30">
                                        <ul class="d-flex justify-content-between list-unstyled m-b-20">
                                            <li><a href="#"><i class="fa fa-map-marker"></i> East 7th street 98 </a></li>
                                            <li><a href="#"><i class="fa fa-heart-o"></i> Save</a> </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">
                            <div class="featured-parts rounded m-b-30">
                                <div class="featured-img"> <img class="img-fluid rounded-top" src="{{asset('/frontend')}}/images/Featured-img-4.png" alt="Classified Plus"> </div>
                                <div class="featured-text">
                                    <div class="text-top d-flex justify-content-between ">
                                        <div class="heading"> <a href="#">Animals</a> </div>
                                        <div class="book-mark"><a href="#"><i class="fa fa-bookmark"></i></a></div>
                                    </div>
                                    <div class="text-stars m-t-5">
                                        <p>Greyhounds Dogs for sales</p>
                                        <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> </div>
                                    <div class="featured-bottum m-b-30">
                                        <ul class="d-flex justify-content-between list-unstyled m-b-20">
                                            <li><a href="#"><i class="fa fa-map-marker"></i> East 7th street 98 </a></li>
                                            <li><a href="#"><i class="fa fa-heart-o"></i> Save</a> </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="col-md-12">
                            <button class="view-btn hvr-pulse-grow" type="submit" value="button">View all</button>
                        </div>
                        <div class="col-md-12">
                            <div class="single-sidebar">
                                <img class="add_img img-fluid" src="{{asset('/frontend')}}/images/discount-img.png" alt="Classified Plus">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


@endsection

@section('script')

    <script>
        $(document).ready(function(){
            $(".all-categories").on('click', function(e){
                $(".slide").slideToggle("slow");
            });
        });


        $(document).ready(function(){
            $(".condition").on('click', function(e){
                $(".condition-slide").slideToggle("slow");
            });
        });

        $(document).ready(function(){
            $(".post-by").on('click', function(e){
                $(".post-slide").slideToggle("slow");
            });
        });

        $(document).ready(function(){
            $(".price_r").on('click', function(e){
                $(".price-range-block").slideToggle("slow");
            });
        });
    </script>
@endsection