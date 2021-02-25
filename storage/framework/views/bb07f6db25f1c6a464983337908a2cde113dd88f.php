<?php $__env->startSection('style'); ?>

<?php $__env->stopSection(); ?>


<div class="sidenav">

    <div class="sidebar-wrapper">

        <div class="single-sidebar">
            <?php $routeName=explode('/',Request::path());?>
            <?php if($routeName[0]=='price' ||$routeName[0]=='tag'): ?>
                <span></span>
                <?php else: ?>
                    <form class="search-form" onsubmit="return false" >
                        <input placeholder="Category search" type="text" id="catKeywords" autocomplete="off">
                        <button type="button" id="findCategory"><i class="fa fa-search" aria-hidden="true"></i></button>
                        <ul id="searchKeywordUl0" style="margin-bottom:0rem;"></ul>
                    </form>

                <?php endif; ?>
        </div>

    <div id="categoryResult">

    </div>

    <div id="showDefaultCategory" style="display: none">
        <a href="javascript:void(0)" style="background-color: #663e4c;text-align: center;"> <i class="fa fa-angle-double-left"></i> Go Back </a>
    </div>

    <div id="defaultCategory">

        <ul class="nav nav-pills">
            <?php
            $locationName=Request::segment(2);
            ?>

            <?php $__empty_1 = true; $__currentLoopData = $adSubCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$adSubCategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

            <li class="dropdown">

                <?php if(count($adSubCategory->subCatByCat->subCatPrices)>0): ?>

                    <a href="<?php echo e(URL::to("ads/$locationName/".$category->link.'?subcategory='.$adSubCategory->subCatByCat->id)); ?>" class="dropdown-toggle <?php if($subCategoryInfo!='' && $subCategoryInfo->id==$adSubCategory->subCatByCat->id): ?> active-category <?php else: ?> '' <?php endif; ?>">
                        <?php echo e($adSubCategory->subCatByCat->sub_category_name); ?>

                        (<?php echo e(number_format($adSubCategory->subCatByCat->totalSubCatAd->total_ad)); ?>)
                        <b class="caret"></b></a>

                        <ul class="dropdown-menu dropdown-container" id="menu1<?php echo e($key); ?>">
                            <?php $__currentLoopData = $adSubCategory->subCatByCat->subCatPrices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $priceData): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li>
                                <a href="<?php echo e(URL::to("ads/$locationName/".$category->link.'?subcategory='.$adSubCategory->subCatByCat->id."&pricetitle=$priceData->price_title")); ?>">
                                    <?php echo e($priceData->price_title); ?> </a>
                            </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>

                <?php else: ?>
                    <a class="<?php if($subCategoryInfo!='' && $subCategoryInfo->id==$adSubCategory->subCatByCat->id): ?> active-category <?php else: ?> '' <?php endif; ?>"
                       href="<?php echo e(URL::to("ads/$locationName/".$category->link.'?subcategory='.$adSubCategory->subCatByCat->id)); ?>">
                        <?php echo e($adSubCategory->subCatByCat->sub_category_name); ?>

                        <?php if(!empty($adSubCategory->subCatByCat->totalSubCatAd)): ?>
                            (<?php echo e(number_format($adSubCategory->subCatByCat->totalSubCatAd->total_ad)); ?>)
                        <?php else: ?>
                            0
                        <?php endif; ?>
                    </a>
                <?php endif; ?>

            </li>

                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <li class="">
                <a href="javascript:void(0)" class="dropdown-toggle">No Data Found !</a>

            </li>
                <?php endif; ?>
        </ul>
    </div>

</div>

<div class="single-sidebar mt-4">
    <img class="add_img img-fluid" src="<?php echo e(asset('/frontend')); ?>/images/google_adds1.png" alt="Classified Plus">
</div>

</div>

<?php /**PATH D:\xampp\htdocs\paibaApp\resources\views/frontend/ad/sidenave.blade.php ENDPATH**/ ?>