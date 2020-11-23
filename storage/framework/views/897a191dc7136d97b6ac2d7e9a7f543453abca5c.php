<?php $__env->startSection('title'); ?>
   <?php echo e($userProfile->name); ?>  all ads | Paibaa Khojleye Paibaa  Shob Paibaa
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


    <div class="top_listings_sec p-b-0 m-t-10">
        <div class="container">

            <div class="row">
                <div class="col-lg-4 col-md-4 border-right ">
                    <div class="author-profile">
                        <?php if(!empty($userProfile->image)): ?>
                        <img class="img img-circle img-responsive" src="<?php echo e(asset($userProfile->image)); ?>" style="border-radius: 50%">

                        <?php else: ?>
                            <img class="img img-circle img-responsive" src="<?php echo e(asset('/images/default/photo.png')); ?>" style="border-radius: 50%">
                        <?php endif; ?>
                    </div>
                    <div class="author-profile">
                        <h5 class="text-center"><?php echo e(substr($userProfile->name,0,20)); ?></h5>
                        
                        <br>
                        <?php if(Auth::check() && Auth::user()->id==$userProfile->id): ?>
                            <h6 class="text-center"> <a href="<?php echo e(URL::to('/my-profile')); ?>"> <i class="fa fa-pencil"></i> Edit</a></h6>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="col-lg-4 col-md-4 border-right">
                    <h5>Verify With :</h5>
                    <?php if($userProfile->social_id==''): ?>
                        <i class="fa fa-mobile them-color"></i> Mobile
                    <?php else: ?>
                        <i class="fa fa-facebook-official them-color"></i> Facebook
                    <?php endif; ?>
                    <h6 class="align-baseline m-t-10 ">
                        <a href="javascript:void(0)"><span class="them-color"> Followers </span></a> |
                        <a href="javascript:void(0)"><span class="them-color"> Following </span> </a>
                    </h6>
                </div>

                <div class="col-lg-4 col-md-4">
                   <h5><?php echo e($userProfile->address); ?></h5>
                </div>


            </div>

        </div>
    </div>

    <section class="top_listings">
        <div class="container">
            <div class="row">
                <?php if(count($activeAds)>0): ?>
                    <?php $__currentLoopData = $activeAds; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$activeAd): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
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
                                        <div class="heading">
                                            <a href="<?php echo e(URL::to('ad/'.$activeAd->link)); ?>" title="<?php echo e($activeAd->title); ?>">
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
                                        
                                    </div>
                                    <div class="text-stars m-t-5">
                                        <p data-toggle="tooltip1" data-placement="top" title="<?php

                                        $allSubCat=$activeAd->adSubCategory->pluck('sub_category_name')->toArray();
                                        foreach ($allSubCat as $subCatData){
                                            echo $subCatData.' , ';
                                        }?>">
                                            <strong > <?php echo e($activeAd->postCategory->category_name); ?> </strong> > <?php echo e($activeAd->adSubCategory->first()->sub_category_name); ?>


                                        </p>

                                    </div>
                                    <div class="featured-bottum m-b-30">
                                        <ul class="d-flex justify-content-between list-unstyled m-b-20">
                                            <li>
                                                <a href="<?php echo e(URL::to('ad/'.$activeAd->link)); ?>" title="<?php

                                                $allLocations=$activeAd->adLocation->pluck('location_name')->toArray();
                                                foreach ($allLocations as $locationData){
                                                    echo $locationData.' , ';
                                                }?>"><i class="fa fa-map-marker"></i>

                                                    <?php echo e($activeAd->adLocation->first()->location_name); ?>


                                                </a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                <?php else: ?>
                    <div class="col-md-12">
                        <h5 class="text-center text-danger"> No Ads Found ! <hr>
                            <a href="<?php echo e(URL::to('/')); ?>" class="btn btn-warning btn-warning ">Brows all ads</a>
                        </h5>
                    </div>

                <?php endif; ?>

                

            </div>
        </div>
    </section>


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
<?php echo $__env->make('frontend.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\paibaApp\resources\views/frontend/ad/author-all-ads.blade.php ENDPATH**/ ?>