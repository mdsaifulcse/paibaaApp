<?php $__env->startSection('title'); ?>
    Paibaa | khujlei Paibaa | Shob Paibaa
<?php $__env->stopSection(); ?>

<?php $__env->startSection('style'); ?>


    <?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <style>

        /*  horizontal menu for location  */
        div.scrollmenu {
            background-color: #ffffff;
            overflow: auto;
            white-space: nowrap;
        }

        div.scrollmenu a {
            display: inline-block;
            color: #ffffff;
            background-color: #417f9d;
            text-align: center;
            padding: 7px;
            margin: 0px;
            text-decoration: none;
        }

        div.scrollmenu a:hover {
            background-color: #777;
        }

        /* Fixed sidenav, full height */
        .sidenav {
            height: auto;
            width: 100% ;
            position: relative;
            z-index: 1;
            top: 0;
            left: 0;
            background-color: #FFFFFF;
            border: 1px solid #e1e1e1;
            overflow-x: visible;
        }

        /* Style the sidenav links and the dropdown button */
        .sidenav a, .dropdown-btn {
            padding: 6px 8px 6px 16px;
            margin-bottom: 5px;
            text-decoration: none;
            font-size: 15px;
            color: #fff !important;
            display: block;
            border: none;
            background: #607D8B;
            width: 100%;
            text-align: left;
            cursor: pointer;
            outline: none;
        }

        /* On mouse-over */
        .sidenav a:hover, .dropdown-btn:hover {
            color: #f1f1f1;
        }

        /* Main content */
        .main {
            margin-left: 200px; /* Same as the width of the sidenav */
            font-size: 15px; /* Increased text to enable scrolling */
            padding: 0px 10px;
        }

        /* Add an active class to the active dropdown button */

        /* Dropdown container (hidden by default). Optional: add a lighter background color and some left padding to change the design of the dropdown content */
        .dropdown-container {
            display: none;
            background-color: #de0959;
            padding-left: 8px;
            width: 220px;
        }
        .dropdown-container>a{
            background-color: #f6f6f6;
            color: #de0959 !important;
            border: 1px solid #de0959;
        }

        /* Optional: Style the caret down icon */
        .fa-caret-down {
            float: right;
            padding-right: 8px;
        }
        .sub-menu-active{
        background-color: #de0959;
        }

        /* Some media queries for responsiveness */
        @media  screen and (max-height: 450px) {
            .sidenav {padding-top: 15px;}
            .sidenav a {font-size: 15px;}
        }
    </style>

    <!-- location start -->

    <?php echo $__env->make('frontend.ad.location-area', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <!-- location End -->

    <section class="top_listings">
        <div class="container">
            <div class="row m-t-10 margin_top">
                <div class="col-md-2 col-sm-12 col-xs-12">

                    <!-- sidenave start -->
                    <?php echo $__env->make('frontend.ad.sidenave', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <!-- sidenave end -->
                </div>

                <div class="col-md-10 col-sm-12 col-xs-12">
                    <div class="row">
                        <div class="col-md-12 col-lg-12">
                            <h6 class=""><a href="<?php echo e(URL::to('/')); ?>"> <i class="fa fa-home"></i> Home</a> / <a href="<?php echo e(URL::to('/')); ?>"> All Ads</a> /
                                <a href="<?php echo e(URL::to('/ads/bangladesh/'.$category->link)); ?>"> <?php echo e($category->category_name); ?></a>
                            </h6>
                            <hr>
                        </div>
                    </div>
                <?php if(count($activeAds)>0): ?>
                    <?php $__currentLoopData = $activeAds; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$activeAd): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                    <?php if($activeAd->postCategory->ad_view_type==1): ?> <!-- ======================== For Grid View ===================== -->

                        <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">
                            <div class="featured-parts rounded m-b-30">
                                <div class="featured-img">
                                    <a href="<?php echo e(URL::to('ad/'.$activeAd->link)); ?>">
                                        <?php if(file_exists('images/post_photo/small/'.$activeAd->postPhoto->photo_one)): ?>
                                            <img class="img-fluid rounded-top" src="<?php echo e(asset('images/post_photo/small/'.$activeAd->postPhoto->photo_one)); ?>" alt="<?php echo e($activeAd->title); ?>" title="<?php echo e($activeAd->title); ?>">

                                        <?php else: ?>
                                            <img class="img-fluid rounded-top" src="<?php echo e(asset('/images/default/photo.png')); ?>" alt="<?php echo e($activeAd->title); ?>" title="<?php echo e($activeAd->title); ?>">
                                        <?php endif; ?>
                                    </a>

                                    
                                    <div class="featured-price">
                                        <a href="javascript:void(0)">৳ <?php echo e(number_format($activeAd->price)); ?> </a>
                                    </div>
                                </div>
                                <div class="featured-text">
                                    <div class="text-top d-flex justify-content-between ">
                                        <div class="heading"> <a href="<?php echo e(URL::to('ad/'.$activeAd->link)); ?>" title="<?php echo e($activeAd->title); ?>">
                                            <?php
                                            if (strlen($activeAd->title) != strlen(utf8_decode($activeAd->title)))
                                            {
                                                echo substr($activeAd->title,0,47);
                                            }else{
                                                echo substr($activeAd->title,0,18);
                                            }?>
                                            </a>
                                        </div>
                                        
                                    </div>
                                    <div class="text-stars m-t-5">
                                        <p title="<?php

                                        $allSubCat=$activeAd->adSubCategory->pluck('sub_category_name')->toArray();
                                        foreach ($allSubCat as $subCatData){
                                            echo $subCatData.' , ';
                                        }?>">
                                            <strong> <?php echo e($category->category_name); ?> </strong> >

                                            <?php if($subCategoryInfo!=''): ?>
                                            <?php echo e($activeAd->adSubCategory->where('id',$subCategoryInfo->id)->first()->sub_category_name); ?>

                                                <?php else: ?>
                                                <?php echo e($activeAd->adSubCategory->first()->sub_category_name); ?>

                                            <?php endif; ?>
                                        </p>

                                    </div>
                                    <div class="featured-bottum m-b-30">
                                        <ul class="d-flex justify-content-between list-unstyled m-b-20">
                                            <li><a href="<?php echo e(URL::to('ad/'.$activeAd->link)); ?>" title="<?php

                                                $allLocations=$activeAd->adLocation->pluck('location_name')->toArray();
                                                foreach ($allLocations as $locationData){
                                                    echo $locationData.' , ';
                                                }?>"><i class="fa fa-map-marker them-color"></i> <?php echo e($activeAd->adLocation->first()->location_name); ?> </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                    <?php elseif($activeAd->postCategory->ad_view_type==2): ?> <!-- ========================= For List view =================== -->

                        <div class="col-xl-10 col-lg-10 col-md-10 col-sm-12">
                            <div class="featured-parts rounded m-t-10 m-b-10">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="featured-img">
                                            <a href="<?php echo e(URL::to('ad/'.$activeAd->link)); ?>" title="<?php echo e($activeAd->title); ?>">
                                                <?php if(file_exists('images/post_photo/small/'.$activeAd->postPhoto->photo_one)): ?>
                                                    <img class="img-fluid rounded-top" src="<?php echo e(asset('images/post_photo/small/'.$activeAd->postPhoto->photo_one)); ?>" alt="<?php echo e($activeAd->title); ?>">

                                                <?php else: ?>
                                                    <img class="img-fluid rounded-top" src="<?php echo e(asset('/images/default/photo.png')); ?>" alt="<?php echo e($activeAd->title); ?>">
                                                <?php endif; ?>
                                            </a>
                                        </div>
                                    </div>

                                    <div class="col-md-9">
                                        <div class="featured-text">
                                            <div class="text-top d-flex justify-content-between ">
                                                <div class="heading"> <a href="<?php echo e(URL::to('/ad/'.$activeAd->link)); ?>" title="<?php echo e($activeAd->title); ?>"><?php echo e($activeAd->title); ?></a>

                                                    <?php if($activeAd->postCategory->post_type==1): ?> <!-- Special Category -->
                                                    <ul class="deal-price list-view-price-request list-unstyled text-capitalize m-b-5 m-t-15">

                                                        <li class="d-inline-block p-r-20">
                                                            <span class="rend-blog-price-type"> <?php echo e($activeAd->adPostPrice->first()->price_title); ?> </span> <strong> ৳ </strong> :<span class="price">
                                            <?php echo e(Form::number('offer_price',$value=round($activeAd->price), ['id'=>'offer_price','min'=>0,'readonly'=>false])); ?>

                                            </span> <span> &nbsp; BDT</span>
                                                        </li>
                                                    </ul>
                                                        <?php endif; ?>
                                                </div>
                                            </div>

                                            <a  href="<?php echo e(URL::to('/ad/'.$activeAd->link)); ?>" class="list-view-short-details">
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

                        <?php endif; ?>

                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        <div class="clearfix"></div>
                        
                            
                        
                        <?php else: ?>
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                            <h5 class="text-center text-danger m-b-20"><i class="fa fa-warning"></i> No Ad Data Found !</h5>
                            </div>

                        <?php endif; ?>

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
                    <h5 class="modal-title request-title">Request to post author with your affordable price</h5>
                </div>
                <div class="modal-body">

                    <?php echo Form::open(['route'=>'price-negotiation.store','method'=>'POST']); ?>


                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group has-feedback">

                                <?php echo e(Form::number('price',$value='',['id'=>'offerPrice','class'=>'form-control','min'=>0,'placeholder'=>'Price is required','readonly'=>false,'required'=>true] )); ?>

                            </div>

                            <?php if($errors->has('price')): ?>
                                <span class="help-block">
                                    <strong class="text-danger"><?php echo e($errors->first('price')); ?></strong>
                                </span>
                            <?php endif; ?>

                        </div>
                        <div class="col-sm-12">
                            <div class="form-group has-feedback">
                                <?php echo e(Form::hidden('ad_post_id',$value='',['id'=>'adPostId','class'=>'form-control','required'=>true] )); ?>

                            </div>
                            <?php if($errors->has('ad_post_id')): ?>
                                <span class="help-block">
                        <strong class="text-danger"><?php echo e($errors->first('ad_post_id')); ?></strong>
                    </span>
                            <?php endif; ?>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group has-feedback">
                                <?php echo e(Form::textarea('request_message','',['rows'=>'3','class'=>'form-control request-message','placeholder'=>'Write some message','required'=>true])); ?>

                                <?php if($errors->has('request_message')): ?>
                                    <span class="help-block">
                                        <strong class="text-danger"><?php echo e($errors->first('request_message')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                            <?php if($errors->has('ad_post_id')): ?>
                                <span class="help-block">
                                    <strong class="text-danger"><?php echo e($errors->first('ad_post_id')); ?></strong>
                                </span>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="form-group">

                        <button type="submit" class="buttons login_btn" name="login" value="Continue">Send Request </button>

                    </div>

                    <?php echo Form::close(); ?>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>



<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>

    <script>
        /* Loop through all dropdown buttons to toggle between hiding and showing its dropdown content - This allows the user to have multiple dropdowns without any conflict */
        var dropdown = document.getElementsByClassName("dropdown-btn");
        var i;

        for (i = 0; i < dropdown.length; i++) {
            dropdown[i].addEventListener("click", function() {
                this.classList.toggle("sub-menu-active");
                var dropdownContent = this.nextElementSibling;
                if (dropdownContent.style.display === "block") {
                    dropdownContent.style.display = "none";
                } else {
                    dropdownContent.style.display = "block";
                }
            });
        }
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
            location.href="<?php echo e(URL::to($path)); ?>"+'?area_id='+filterValue+'&min_price='+min_price+'&max_price='+max_price;
            }
            else if(subcategoryId!='' && areaId=='') {

                location.href="<?php echo e(URL::to($path)); ?>"+'?subcategory='+subcategoryId+'&area_id='+filterValue+'&min_price='+min_price+'&max_price='+max_price;
            }
            else if(subcategoryId!='' && areaId!='') {
                console.log(4)
                location.href="<?php echo e(URL::to($path)); ?>"+'?subcategory='+subcategoryId+'&area_id='+filterValue+'&min_price='+min_price+'&max_price='+max_price;
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
                location.href="<?php echo e(URL::to($path)); ?>"+'?area_id='+areaId+'&field_value='+fieldValue+'&field_id='+fieldId+'&min_price='+min_price+'&max_price='+max_price;
            }
            else if(subcategoryId!='' && areaId!='') {

                location.href="<?php echo e(URL::to($path)); ?>"+'?subcategory='+subcategoryId+'&area_id='+areaId+'&field_value='+fieldValue+'&field_id='+fieldId+'&min_price='+min_price+'&max_price='+max_price;
            }
            else if(subcategoryId!='') {

                location.href="<?php echo e(URL::to($path)); ?>"+'?subcategory='+subcategoryId+'&field_value='+fieldValue+'&field_id='+fieldId+'&min_price='+min_price+'&max_price='+max_price;
            }
            else if(subcategoryId=='') {
                location.href="<?php echo e(URL::to($path)); ?>"+'?field_value='+fieldValue+'&field_id='+fieldId+'&min_price='+min_price+'&max_price='+max_price;
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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\paibaApp\resources\views/frontend/ad/index.blade.php ENDPATH**/ ?>