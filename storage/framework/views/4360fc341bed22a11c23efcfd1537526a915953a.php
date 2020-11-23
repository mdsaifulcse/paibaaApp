<div class="topbar ">
    <!-- Header  -->
    <div class="header" >
        <div class="container-fluid">

            



            <div class="row "  id="topBarFixed">
                <div class="col-lg-1 col-md-1 col-sm-12  desktop-logo">
                    <a href="<?php echo e(URL::to('/')); ?>" class="navbar-brand ">
                        <img src="<?php echo e(asset('/frontend')); ?>/images/logo.png" alt="Paibaa | Khojlei Paibaa" class="img-responsive">
                    </a>
                </div>

                <div class="<?php if(Auth::check()): ?> col-md-8 col-lg-8 <?php else: ?> col-lg-8 col-md-8 <?php endif; ?> col-sm-12">
                    <div>
                        <?php
                        $pathUrl=request()->path();
                        //echo $area_id;
                        ?>

                        <?php echo Form::open(['url'=>'','class'=>'book-now-home','method'=>'GET','id'=>'mainSearch']); ?>


                            <div class="form-group selectdiv">
                                <?php $path=request()->segment(count(request()->segments()));?>

                            <?php if(isset($adDetails)): ?>
                            <?php echo e(Form::select('catLink',$categoryArr,$adDetails->postCategory->link,['id'=>'catLink','class'=>'form-control border-right-0 text-truncate','placeholder'=>'Select Category','required'=>true])); ?>


                                <?php else: ?>
                            <?php echo e(Form::select('catLink',$categoryArr,$path,['id'=>'catLink','class'=>'form-control border-right-0 text-truncate','placeholder'=>'Select Category','required'=>true])); ?>


                                <?php endif; ?>
                            </div>

                            <div class="form-group search-file">
                                <input type="text" value="" name="by_playing_user" class="form-control text-truncate" placeholder="What are you looking for" required >
                            </div>

                            <button type="submit" class="btn btn-primary booknow btn-skin"><i class="fa fa-search"></i> Search</button>
                        <?php echo Form::close(); ?>

                    </div>
                </div>

                <div class="<?php if(Auth::check()): ?>col-lg-3 col-md-3 <?php else: ?> col-lg-3 col-md-3 <?php endif; ?> col-sm-12">
                    <div class="header_r d-flex">
                        <div class="loin">

                            <?php if(Auth::check()): ?>

                                <div class="dropdown my-account-dropdown ">
                                    <a href="#" class=" dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user-circle-o"></i> <?php echo e(substr(Auth::user()->name, 0,16)); ?>

                                        <span class="caret"></span>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li><a href="<?php echo e(URL::to('/profile/'.Auth::user()->user_name)); ?>">Public Profile</a></li>
                                        <li><a href="<?php echo e(URL::to('/my-ads')); ?>">My Ads</a></li>
                                        <li><a href="<?php echo e(URL::to('/my-profile')); ?>">Profile Setting</a></li>
                                        <li><a class="nav-link1" href="<?php echo e(url('/logout')); ?>" onclick="event.preventDefault(); document.getElementById('logoutForm').submit()"><i class="fa fa-sign-out" aria-hidden="true"></i>Sign Out</a></li>
                                    </ul>
                                </div>

                                <div class="dropdown notification">
                                    <a href="#" class=" dropdown-toggle" data-toggle="dropdown"><i class="fa fa-comments" aria-hidden="true"></i> <?php echo e($countUnreadMessage); ?>  </a>
                                    <ul class="dropdown-menu">

                                        <?php if(count($notification)>0): ?>
                                            <?php $__currentLoopData = $notification; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php
                                                $userId='';
                                                    if ($data['offer']==1){
                                                        $userId=$data['request_by'];
                                                        $userName=$data['offered_user']['name'];
                                                        $userImg=$data['offered_user']['image'];
                                                    }else{
                                                        $userId=$data['request_to'];
                                                        $userName=$data['replay_user']['name'];
                                                        $userImg=$data['replay_user']['image'];
                                                    }

                                                    if ($data['status']==0){
                                                        $className='unreadMessage';
                                                    }else{
                                                        $className='readMessage';
                                                    }

                                                    ?>

                                                <li class="message-notification">
                                                    <a class="<?php echo e($className); ?>" href="<?php echo e(URL::to('ad/'.$data['link'].'?user='.encrypt($userId).'&offer='.encrypt($data['offer']))); ?>">
                                                        <img src="<?php echo e(asset($userImg)); ?>" style="width: 28px; border-radius: 50%"> <strong><?php echo e($userName); ?></strong> : <?php echo e(substr($data['request_message'],0,40)); ?> ...

                                                    </a>
                                                </li>

                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                        <?php endif; ?>

                                    </ul>
                                </div>

                                <form id="logoutForm" method="POST" action="<?php echo e(route('logout')); ?>" style="display: none">
                                    <?php echo e(csrf_field()); ?>

                                </form>

                                <?php else: ?>
                                <div class="dropdown my-account-dropdown ">
                                    <a href="<?php echo e(URL::to('/login')); ?>" class=" dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user-circle-o"></i>
                                        <span class="caret"></span> Account
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li><a href="<?php echo e(URL::to('/register')); ?>">Create New Account</a></li>
                                        <li><a href="<?php echo e(URL::to('/login')); ?>"> Login In </a></li>
                                    </ul>
                                </div>
                                <?php endif; ?>
                        </div>
                        <ul class="ml-auto post_ad">
                            <li class="nav-item search"><a class="nav-link" href="<?php echo e(URL::to('/ad-post')); ?>">Post Your Ad</a></li>
                        </ul>
                    </div>


                </div>
            </div>






        </div> <!-- end container -->


        <div class="container po-relative">
            <nav class="navbar navbar-expand-lg hover-dropdown header-nav-bar desktop-visible">
                <a href="<?php echo e(URL::to('/')); ?>" class="navbar-brand d-block  d-md-none d-sm-block ">
                    <img src="<?php echo e(asset('/frontend')); ?>/images/logo.png" alt="Paibaa | Khojlei Paibaa" class="img-responsive">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#h5-info" aria-expanded="false" aria-label="Toggle navigation"><i class="fa fa-bars"></i></button>
                <div class="collapse navbar-collapse" id="h5-info">
                    <ul class="navbar-nav">
                        <?php if(count($categories)>0): ?>
                            <?php  $path=request()->segment(count(request()->segments()));?>
                            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li class="nav-item">
                                    <a id="<?php echo e('categoryId-'.$category->id); ?>" class="ad-category nav-link <?php if(isset($adDetails) && $adDetails->category_id==$category->id): ?> active <?php endif; ?>  <?php if($path==$category->link): ?> active <?php else: ?> '' <?php endif; ?>"  href="<?php echo e(URL::to('ads/bangladesh/'.$category->link)); ?>">
                                        <?php echo e($category->category_name); ?>

                                    </a>
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                    </ul>
                </div>
            </nav>
        </div>

    </div><!-- end header -->


    <!-- End Header  -->
</div>
<?php /**PATH D:\xampp\htdocs\paibaApp\resources\views/frontend/_partials/header.blade.php ENDPATH**/ ?>