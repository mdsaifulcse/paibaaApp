<?php $__env->startSection('title'); ?> My Client | Khojlei Paibaa | Shob Paibaa  <?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>

    <style>
        td{
            white-space: normal !important;
        }
    </style>

    <!-- breadcrumb -->
    <div class="iner_breadcrumb bg-light p-t-10 p-b-10">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo e(URL::to('/')); ?>">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Client Request</li>
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
                            <h3> My Client Request </h3>
                        </div>
                        
                            
                                
                                    
                                    
                                    
                                    
                                    
                                    
                                
                            
                        
                        <div class="row m-t-15">
                            <div id="recent-transactions" class="col-12"> <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                <div class="heading-elements"> </div>
                                <div class="table table-responsive">
                                    <table class="table table-xl table-bordered mb-0 table-responsive">
                                        <thead>
                                        <tr>

                                            <th class="border-top text-capitalize">Sl</th>
                                            <th class="border-top text-capitalize" width="50%">Message </th>
                                            <th class="border-top text-capitalize">Related Ad </th>
                                            <th class="border-top text-capitalize">Client </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php if(count($clientRequests)>0): ?>
                                        <?php $__currentLoopData = $clientRequests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key =>$data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td class="text-truncate"><?php echo e($key+1); ?></td>
                                            <td class="text-truncate"><a href="<?php echo e(url('/ad/'.$data->priceNegotiationOfAds->link.'?user='.encrypt($data->request_by).'&offer='.encrypt($data->offer))); ?>"><?php echo e($data->request_message); ?></a>
                                            </td>

                                            <td class="text-truncate">
                                                <a href="<?php echo e(url('/ad/'.$data->priceNegotiationOfAds->link.'?user='.encrypt($data->request_by).'&offer='.encrypt($data->offer))); ?>"><p><?php echo e($data->priceNegotiationOfAds->title); ?></p></a>
                                                </td>

                                            <td class="text-truncate">
                                                <div class="form-check">
                                                    
                                                    <div class="recent_img" style="width: 60px;">
                                                        <a href="<?php echo e(url('/ad/'.$data->priceNegotiationOfAds->link.'?user='.encrypt($data->request_by).'&offer='.encrypt($data->offer))); ?>">
                                                            <?php if(!empty($data->offeredUser->image)): ?>
                                                                <img class="img-fluid rounded-top" src="<?php echo e(asset($data->offeredUser->image)); ?>" alt="<?php echo e($data->offeredUser->name); ?>" title="<?php echo e($data->offeredUser->name); ?>">

                                                            <?php else: ?>
                                                                <img class="img-fluid rounded-top" src="<?php echo e(asset('/images/default/photo.png')); ?>" alt="<?php echo e($data->offeredUser->name); ?>" title="<?php echo e($data->offeredUser->name); ?>">
                                                            <?php endif; ?>

                                                            <span><?php echo e($data->offeredUser->name); ?></span>
                                                        </a>
                                                    </div>
                                                </div>
                                            </td>

                                        </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php else: ?>
                                            <tr>
                                                <td colspan="4" class="text-center">No Client Request Found !</td>
                                            </tr>

                                            <?php endif; ?>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <nav aria-label="Page navigation example">
                        <ul class="pagination justify-content-center m-t-20 m-b-50">
                            <?php echo e($clientRequests->render()); ?>

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

<?php echo $__env->make('frontend.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\paibaApp\resources\views/frontend/client-request/client-request.blade.php ENDPATH**/ ?>