
<ul class="nav nav-pills">

    <?php $__empty_1 = true; $__currentLoopData = $adSubCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$adSubCategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

        <li class="dropdown">

            <?php if(count($adSubCategory->subCatByCat->subCatPrices)>0): ?>

                <a href="<?php echo e(URL::to("ads/$location/".$category->link.'?subcategory='.$adSubCategory->subCatByCat->id)); ?>" class="dropdown-toggle <?php if($subCategoryInfo!='' && $subCategoryInfo->id==$adSubCategory->subCatByCat->id): ?> active-category <?php else: ?> '' <?php endif; ?>">
                    <?php echo e($adSubCategory->subCatByCat->sub_category_name); ?>

                    (<?php echo e(number_format($adSubCategory->subCatByCat->totalSubCatAd->total_ad)); ?>)
                    <b class="caret"></b></a>

                <ul class="dropdown-menu dropdown-container" id="menu1<?php echo e($key); ?>">
                    <?php $__currentLoopData = $adSubCategory->subCatByCat->subCatPrices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $priceData): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li>
                            <a href="<?php echo e(URL::to("ads/$location/".$category->link.'?subcategory='.$adSubCategory->subCatByCat->id."&pricetitle=$priceData->price_title")); ?>">
                                <?php echo e($priceData->price_title); ?> </a>
                        </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>

            <?php else: ?>
                <a class="<?php if($subCategoryInfo!='' && $subCategoryInfo->id==$adSubCategory->subCatByCat->id): ?> active-category <?php else: ?> '' <?php endif; ?>"
                   href="<?php echo e(URL::to("ads/$location/".$category->link.'?subcategory='.$adSubCategory->subCatByCat->id)); ?>">
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
</ul><?php /**PATH D:\xampp\htdocs\paibaApp\resources\views/frontend/ad/search-nav-subcategory.blade.php ENDPATH**/ ?>