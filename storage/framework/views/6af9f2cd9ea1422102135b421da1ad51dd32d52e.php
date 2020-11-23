<?php $__env->startSection('title'); ?> My Profile | Khojlei Paibaa | Shob Paibaa  <?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>

    <!-- breadcrumb -->
    <div class="iner_breadcrumb bg-light p-t-10 p-b-10">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo e(URL::to('/')); ?>">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Post your ad</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- End breadcrumb -->


    <section class="dashboard_sec m-t-0 m-b-20">
        <div class="container my-account-bg" style="webkit-box-shadow: 0px 0px 5px 5px rgba(222,222,222,1);
-moz-box-shadow: 0px 0px 5px 5px rgba(222,222,222,1);
box-shadow: 0px 0px 5px 5px rgba(222,222,222,1);">
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-8 content-just-center" >
                    <div class="dashboard_profile_main">
                        <div class="dashboard_profile d-flex justify-content-between">
                            <div class="profile_setting text-capitalize">
                                
                            </div>
                        </div>

                    </div>
                    <div class="dashboard_menu">
                        <ul class="category-list list-unstyled  m-t-20">
                            <?php if(count($categories)>0): ?>
                                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li  id="loadSubCategory<?php echo e($category->id); ?>">
                                <a href="javascript:void(0)" onclick="selectCategory(<?php echo e($category->id); ?>)"> <?php echo e($category->category_name); ?> <span><i class="fa fa-angle-double-down" aria-hidden="true"></i></span>
                                </a>
                            </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            <?php else: ?>
                                <li><a href="" class="text-danger"><i class="fa fa-warning"></i> No Category Found !</a></li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div> <!--end col-md-3-->
                <div class="col-md-2"></div>


                <div class="col-md-2"></div>
                <div class="col-md-3" id="loadedSubCategory">

                </div> <!--end col-md-3-->



                <div class="col-md-12" id="nextForm" style="display: none">
                    <div class="dashboard_profile_main">
                        
                            
                                
                            
                        


                    <div class="change_password m-t-10">

                        <div class="dashboard_menu">
                            <?php echo Form::open(array('url' => 'ad-post/create','method'=>'GET','class'=>'form-horizontal',)); ?>



                            <div class="form-group">
                                <?php echo e(Form::hidden('sub_category_id','',['id'=>'nextStep','class'=>'form-control type-pass','required'=>true])); ?>

                                <span id="confirmPassError" class="text-danger"></span>
                            </div>
                            <button class="change_btn mt-2 text-capitalize" type="submit" id="changeSubmit" value="button">GO</button>
                            <?php echo Form::close(); ?>


                        </div>
                    </div>
                </div>


            </div><!--end row-->
        </div>
        </div>

    </section>



<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>

<script>
    function selectCategory(categoryId) {
        $('#nextForm').css('display','none')
        $('#loadedSubCategory').html('')

        window.location.href='<?php echo e(URL::to("/ad-post/create")); ?>'+'?cat_id='+categoryId
        //$('#loadedSubCategory').load('<?php echo e(URL::to("/load-sub-category-list")); ?>'+'/'+categoryId)

        $('.category-list > li').removeClass('active')
        $('#loadSubCategory'+categoryId).addClass('active')
    }
</script>

<script>
    function selectSubCategory(subCategoryId) {
        $('#nextForm').css('display','none')
        $('.sub-category-list > li').removeClass('active')
        $('#subCategory'+subCategoryId).addClass('active')
        $('#nextStep').val(subCategoryId)

        window.location.href='<?php echo e(URL::to("/ad-post/create")); ?>'+'?sub_category_id='+subCategoryId
    }
</script>





<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\paibaApp\resources\views/frontend/adPost/selectCategory.blade.php ENDPATH**/ ?>