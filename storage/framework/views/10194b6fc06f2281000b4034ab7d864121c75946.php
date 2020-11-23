<?php if(count($comments)>0): ?>
    <?php $__currentLoopData = $comments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="row m-t-20">
            <div class="col-md-1 col-sm-3">
                <div class="">
                    <?php if(!empty($comment->commentAuthor->image)): ?>
                        <a href="<?php echo e(URL::to('/profile/'.$comment->commentAuthor->user_name)); ?>">
                            <img class="" src="<?php echo e(asset($comment->commentAuthor->image)); ?>" style="width: 50px;border-radius: 50%"></a>
                    <?php else: ?>
                        <a href="<?php echo e(URL::to('/profile/'.$comment->commentAuthor->user_name)); ?>">
                            <img class="" src="<?php echo e(asset('/images/default/photo.png')); ?>" style="width: 50px;border-radius: 50%"></a>
                    <?php endif; ?>
                </div>

            </div>
            <div class="col-md-11 col-sm-9">

                <h6> <a href="<?php echo e(URL::to('/profile/'.$comment->commentAuthor->user_name)); ?>">
                        <strong><?php echo e($comment->commentAuthor->name); ?></strong></a>
                    <?php echo e($comment->created_at->diffForHumans()); ?>

                </h6>
                <h6> <?php echo e($comment->comment); ?></h6>

                <?php echo Form::close(); ?>

            </div>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

<?php endif; ?><?php /**PATH D:\xampp\htdocs\paibaApp\resources\views/frontend/ad/load-comments.blade.php ENDPATH**/ ?>