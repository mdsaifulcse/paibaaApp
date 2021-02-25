<div class="container">
    <div class="row m-t-10 margin_top">

        <div class="col-md-2 col-sm-12 col-xs-12">
            <h6 class="text-right m-t-10">Location</h6>
        </div>

        <div class="col-md-10 col-sm-12 col-xs-12">
            <div class="scrollmenu">

                <div id="locationResult">

                </div>
                <a id="showDefaultLocation" style="display: none;background-color: #663e4c;text-align: center;" href="javascript:void(0)" style="background-color: #663e4c;text-align: center;"> X </a>



                <div id="defaultLocation">
                    <?php
                    $routeName=explode('/',Request::path());
                    $locationName=Request::segment(2);
                    ?>
                    <?php if($routeName[0]=='price' ||$routeName[0]=='tag'): ?>
                        <span></span>
                    <?php else: ?>
                    <form class="search-form" style="display: inline-table;" onsubmit="return false">
                        <input placeholder="Location search" type="text" id="locationKeyword">
                        <button type="button" id="findLocation" style="cursor: pointer"><i class="fa fa-search" aria-hidden="true"></i></button>
                    </form>
                    <?php endif; ?>

                <?php if(count($categoryWiseLocations)>0): ?>

                        <?php $__currentLoopData = $categoryWiseLocations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $location): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($locationName==$location->locationByCat->url): ?>
                            <a class="active" href="<?php echo e(URL::to('ads/'.$location->locationByCat->url.'/'.$category->link)); ?>"><?php echo e($location->locationByCat->location_name); ?> </a>
                                <?php else: ?>
                                    <a class="" href="<?php echo e(URL::to('ads/'.$location->locationByCat->url.'/'.$category->link)); ?>"><?php echo e($location->locationByCat->location_name); ?></a>
                                <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php else: ?>
                        <a href="javascript:void(0)"> No Location </a>
                    <?php endif; ?>

                </div>
            </div>
        </div>
    </div>
</div><?php /**PATH D:\xampp\htdocs\paibaApp\resources\views/frontend/ad/location-area.blade.php ENDPATH**/ ?>