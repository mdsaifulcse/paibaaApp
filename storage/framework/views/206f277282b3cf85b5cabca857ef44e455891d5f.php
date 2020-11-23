<div class="dashboard_menu">
    <div class="dashbord_img">
        <div class="dashboard_back"> <img class="img-fluid w-100" src="<?php echo e(asset('/frontend')); ?>/images/dash-background.png" alt="Classified Plus"> </div>
        <div class="rounded_img">
            <?php if(!empty(Auth::user()->image)): ?>
            <img class="img-fluid" src="<?php echo e(asset(Auth::user()->image)); ?>" alt="Classified Plus">
                <?php else: ?>
                <img class="img-fluid" src="<?php echo e(asset('/')); ?>images/default/photo.png" alt="Classified Plus">

            <?php endif; ?>
        </div>
        <div class="aditya"><?php echo e(Auth::user()->name); ?></div>

    </div>
    <ul class="list-unstyled  m-t-20">
        
        <li class=" <?php if(Request::path()=='my-ads'): ?> active <?php else: ?> '' <?php endif; ?> "><span><i class="fa fa-database"></i></span><a href="<?php echo e(URL::to('/my-ads')); ?>"> My Ads </a></li>
        <li class=" <?php if(Request::path()=='ad-post/create'): ?> active <?php else: ?> '' <?php endif; ?> "><span><i class="fa fa-database"></i></span><a href="<?php echo e(URL::to('/ad-post')); ?>"> Post New Ad </a></li>
        <li class=" <?php if(Request::path()=='my-profile'): ?> active <?php else: ?> '' <?php endif; ?> "><span><i class="fa fa-cog"></i></span><a href="<?php echo e(URL::to('/my-profile')); ?>"> Profile Settings </a></li>
        <li class=" <?php if(Request::path()=='change-my-username'): ?> active <?php else: ?> '' <?php endif; ?> "><span><i class="fa fa-cog"></i></span><a href="<?php echo e(URL::to('/change-my-username')); ?>"> Set Username </a></li>
        <li><span><i class="fa fa-sign-in"></i></span><a href="javascript:void(0)" onclick="event.preventDefault(); document.getElementById('logoutForm').submit()"> Logout </a></li>
    </ul>
</div><?php /**PATH D:\xampp\htdocs\paibaApp\resources\views/frontend/my-account/sidebar.blade.php ENDPATH**/ ?>