    



    


    



<?php $__env->startSection('title'); ?>
    Paibaa | Khojleye Paibaa | Shob Paibaa
    <?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>

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
                        <h5 class="text-center text-danger"> No Result Found ! <hr>
                            <a href="<?php echo e(URL::to('/')); ?>" class="btn btn-warning btn-warning ">Brows all ads</a>
                        </h5>
                    </div>

                <?php endif; ?>

                    

            </div>
        </div>
    </section>
    <!-- End Featured_ads -->





    <?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>

    <script>
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>

    <?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\paibaApp\resources\views/frontend/home/index.blade.php ENDPATH**/ ?>