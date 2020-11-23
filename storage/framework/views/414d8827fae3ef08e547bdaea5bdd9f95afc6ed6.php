<?php $__env->startSection('title'); ?> My Profile | Khojlei Paibaa | Shob Paibaa  <?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>

    <!-- breadcrumb -->
    <div class="iner_breadcrumb bg-light p-t-10 p-b-10">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo e(URL::to('/')); ?>">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Profile Setting</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- End breadcrumb -->


    <section class="dashboard_sec m-t-30">
        <div class="container my-account-bg">
            <div class="row">
                <div class="col-md-3">
                    <?php echo $__env->make('frontend.my-account.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>


                <div class="col-md-9">

                    <div class="dashboard_main">
                        <div class="dashboard_heding">
                            <h3> My All Ads </h3>
                        </div>
                        
                            
                                
                                    
                                    
                                    
                                    
                                    
                                    
                                
                            
                        
                        <div class="row m-t-15">
                            <div id="recent-transactions" class="col-12"> <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                <div class="heading-elements"> </div>
                                <div class="table">
                                    <table class="table table-xl mb-0 table-responsive">
                                        <thead>
                                        <tr>
                                            <th class="border-top text-capitalize ml-44">
                                                
                                                photos
                                            </th>
                                            <th class="border-top text-capitalize">title </th>
                                            <th class="border-top text-capitalize">category </th>
                                            <th class="border-top text-capitalize">ad status </th>
                                            <th class="border-top text-capitalize">price </th>
                                            <th class="border-top text-capitalize">action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php if(count($adPost)>0): ?>
                                        <?php $__currentLoopData = $adPost; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td class="text-truncate">
                                                <div class="form-check">
                                                    
                                                    <div class="recent_img">
                                                        <?php if(file_exists('images/post_photo/small/'.$data->postPhoto->photo_one)): ?>
                                                            <img class="img-fluid rounded-top" src="<?php echo e(asset('images/post_photo/small/'.$data->postPhoto->photo_one)); ?>" alt="<?php echo e($data->title); ?>" title="<?php echo e($data->title); ?>">

                                                        <?php else: ?>
                                                            <img class="img-fluid rounded-top" src="<?php echo e(asset('/images/default/photo.png')); ?>" alt="<?php echo e($data->title); ?>" title="<?php echo e($data->title); ?>">
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-truncate"><p><?php echo e($data->title); ?></p></td>
                                            <td class="text-truncate"><?php echo e($data->postCategory->category_name); ?></td>
                                            <td>
                                                <?php if($data->status==1 && $data->is_approved==1): ?>
                                                <button type="button" class="btn btn-sm active_btn">Active</button>
                                                    <?php else: ?>
                                                    <button type="button" class="btn btn-sm btn-warning" title="Your ad is pending or Inactive">Inactive</button>
                                                <?php endif; ?>
                                            </td>
                                            <td class="text-truncate"><strong><?php echo e($data->price); ?></strong></td>
                                            <td class="text-truncate">
                                                <?php echo Form::open(array('route' => ['ad-post.destroy',$data->id],'method'=>'DELETE','id'=>"deleteForm$data->id")); ?>


                                                <span>
                                                <button type="button" value="butten"><a href="<?php echo e(URL::to('ad-post/'.$data->id.'/edit')); ?>" title="Click here to edit this ad">  <i class="fa fa-pencil"></i> </a>  </button>
                                                </span>

                                                <span>
                                                <button type="button" value="butten" onclick='return deleteConfirm("deleteForm<?php echo e($data->id); ?>")' title="Click here to delete this ad">  <i class="fa fa-trash"></i></button>
                                                </span>

                                                <?php echo Form::close(); ?>



                                            </td>
                                        </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php endif; ?>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <nav aria-label="Page navigation example">
                        <ul class="pagination justify-content-center m-t-20 m-b-50">
                            <?php echo e($adPost->render()); ?>

                        </ul>
                    </nav>
                    <div class="single-sidebar m-b-50"> <img class="add_img img-fluid" src="<?php echo e(asset('/frontend')); ?>/images/discount-img.png" alt="Classified Plus"> </div>

                </div>


            </div>
        </div>
    </section>


<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>

    <script>

        $('.type-pass').keypress(function() {
            $('#changeSubmit').attr('type','submit')
        });
    </script>

    <script>
        $('#passwordChangeForm').on('submit',function (e) {
            e.preventDefault()

            var n = $('#newPassword').val().localeCompare($('#passwordConfirmation').val());
            if (parseInt(n)<0){
                $('#confirmPassError').text('Confirmed Password Does Not Match')
                $('#changeSubmit').html('Change Now')
                return false
            }else {
                $('#confirmPassError').text(' ')
                $(this).unbind().submit();
            }
        })

    </script>

    <script>
        $('.maxlength').keypress(function() {
            if (this.value.length >= 11) {
                return false;
            }
        });
    </script>

    <script>
        $('#userMobileUpdata').on('blur',function () {

            if (Number($('#userMobileUpdata').val().length<11) || Number($('#userMobileUpdata').val().length>11) || $('#userMobileUpdata').val().substring(0, 2)!=='01'){
                $('#updateMobileError').html('Valid Mobile Number must be 11 digit')
                $('#updateBtn').attr('disabled',true)
                return true;
            }else {
                $('#updateMobileError').html('')
                $('#updateBtn').attr('disabled',false)
            }


            $.ajax({
                url:'<?php echo e(url("/check-unique-user")); ?>'+'/'+$('#userMobileUpdata').val()+'/'+$('#userId').val() ,
                type: 'GET',
                'dataType' : 'json',
                success: function(data) {
                    if (data.userData===null){
                        $('#updateBtn').attr('disabled',false)
                        $('#updateMobileError').html('')
                    }else {
                        $('#updateBtn').attr('disabled',true)
                        $('#updateMobileError').html('Mobile Number Already Taken')
                    }
                }
            })
        })
    </script>
    <script type="text/javascript">
        function loadArea(id){
            $('#loadArea').load('<?php echo e(URL::to("load-area-by-division-town")); ?>/'+id);

        }
    </script>

    <script>
        function photoLoad(input,image_load) {
            var target_image='#'+$('#'+image_load).prev().children().attr('id');

            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $(target_image).attr('src', e.target.result);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\paibaApp\resources\views/frontend/adPost/my-ads.blade.php ENDPATH**/ ?>