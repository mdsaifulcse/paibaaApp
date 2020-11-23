<?php $__env->startSection('title'); ?> Update My User Name | Khojlei Paibaa | Shob Paibaa  <?php $__env->stopSection(); ?>


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

                    <div class="row">
                        <div class="<?php if($userData->social_id==null): ?>col-md-6 <?php else: ?> col-md-8 <?php endif; ?> m-t-40 margin_top">
                            <div class="profile_detail">
                                <h3>Update Username </h3>
                                <?php echo Form::open(['route'=>['change.my.username'],'method'=>'POST','files'=>true]); ?>

                                    <div class="form-group">
                                        <label>Username</label>
                                        <input type="hidden" name="id" id="userId" value="<?php echo e($userData->id); ?>" />
                                        <?php echo e(Form::text('user_name',$value=isset($userData->user_name)?$userData->user_name:'',['class'=>'form-control','required'=>true])); ?>

                                        <?php echo e(Form::hidden('old_user_name',$value=$userData->user_name)); ?>

                                        <?php if($errors->has('user_name')): ?>
                                            <span class="help-block">
                                                <strong class="text-danger"><?php echo e($errors->first('user_name')); ?></strong>
                                            </span>
                                        <?php endif; ?>
                                    </div>

                                    <button class="update_btn mt-2 text-capitalize" type="submit" value="button" id="updateBtn">update</button>
                                <?php echo Form::close(); ?>

                            </div>
                        </div>
                    </div>
                    <div class="single-sidebar m-t-50 m-b-50">
                        <img class="add_img img-fluid" src="<?php echo e(asset('/frontend')); ?>/images/discount-img.png" alt="Classified Plus">
                    </div>
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
            $('#loadArea').load('<?php echo e(URL::to("load-area-on-profile")); ?>/'+id);
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

<?php echo $__env->make('frontend.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\paibaApp\resources\views/frontend/my-account/set-username.blade.php ENDPATH**/ ?>