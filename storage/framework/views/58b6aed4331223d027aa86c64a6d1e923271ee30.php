<?php if(count($categoryWiseLocations)>0): ?>
    <?php $__currentLoopData = $categoryWiseLocations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $location): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <a href="<?php echo e(URL::to('ads/'.$location->locationByCat->url.'/'.'bangladesh')); ?>"><?php echo e($location->locationByCat->location_name); ?></a>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php else: ?>
    <a href="javascript:void(0)"> No Location </a>
<?php endif; ?><?php /**PATH D:\xampp\htdocs\paibaApp\resources\views/frontend/ad/search-nav-location.blade.php ENDPATH**/ ?>