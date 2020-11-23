<?php if(count($getChatReplayData)>0): ?>
    <?php $__currentLoopData = $getChatReplayData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $replay): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="row m-b-10 conversation">
            <div class="col-md-2 col-sm-3">
                <div class="">
                    <?php if($replay->offer==1): ?>
                        <a href="<?php echo e(URL::to('/profile/'.$replay->offeredUser->user_name)); ?>">
                        <img class="chat-user-img" src="<?php if(!empty($replay->offeredUser->image)): ?> <?php echo e(asset($replay->offeredUser->image)); ?> <?php else: ?> <?php echo e(asset('/images/default/photo.png')); ?> <?php endif; ?> ">
                        </a>
                    <?php elseif($replay->offer==2): ?>
                        <a href="<?php echo e(URL::to('/profile/'.$replay->replayUser->user_name)); ?>">
                        <img class="chat-user-img" src="<?php if(!empty($replay->replayUser->image)): ?> <?php echo e(asset($replay->replayUser->image)); ?> <?php else: ?> <?php echo e(asset('/images/default/photo.png')); ?> <?php endif; ?> ">
                        </a>
                    <?php endif; ?>

                </div>
            </div>
            <div class="col-md-10 col-sm-9">

                <?php if($replay->offer==1): ?>
                    <h6 class="user-time">
                        <a href="<?php echo e(URL::to('/profile/'.$replay->offeredUser->user_name)); ?>">
                            <strong><?php echo e($replay->offeredUser->name); ?> </strong></a>

                        <?php echo e($replay->created_at->diffForHumans()); ?> </h6>
                <?php elseif($replay->offer==2): ?>
                    <h6 class="user-time">
                        <a href="<?php echo e(URL::to('/profile/'.$replay->replayUser->user_name)); ?>">
                            <strong><?php echo e($replay->replayUser->name); ?> </strong></a>

                        <?php echo e($replay->created_at->diffForHumans()); ?> </h6>
                <?php endif; ?>

                <h6> <?php echo e($replay->request_message); ?>


                    <?php if($replay->price_message!=''): ?>
                        <br>
                        Price: <?php echo e($replay->price_message); ?>

                    <?php endif; ?>
                </h6>

                <?php echo Form::close(); ?>

            </div>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

<?php else: ?>
    <h5>No Chat History !</h5>

<?php endif; ?><?php /**PATH D:\xampp\htdocs\paibaApp\resources\views/frontend/ad/load-chat-replay-data.blade.php ENDPATH**/ ?>