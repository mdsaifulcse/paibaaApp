<?php $__env->startSection('title'); ?>
 <?php echo e($pageDetails->title); ?>   | Paibaa | Khojleye Paibaa | Shob Paibaa
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
                <div class="col-lg-8 col-md-81">
                    <div class="jumbotron">
                        <h4 class="m-b-20"><?php echo e($pageDetails->title); ?></h4>

                        <?php echo $pageDetails->description;?>
                    </div>

                </div>

            </div>
        </div>
    </section>
    <!-- End Featured_ads -->





<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\paibaApp\resources\views/frontend/page/details.blade.php ENDPATH**/ ?>