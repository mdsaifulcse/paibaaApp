<?php $__env->startSection('title'); ?> My Profile | Khojlei Paibaa | Shob Paibaa  <?php $__env->stopSection(); ?>


<?php $__env->startSection('style'); ?>
    <!-- for taging -->
    <link rel="stylesheet" href="<?php echo e(asset('/tagging/css/jqueryui1.12.1-ui.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('/tagging/css/jquery.tagit.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('/tagging/css/tagit.ui-zendesk.css')); ?>">
<?php $__env->stopSection(); ?>

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
                    <div class="dashboard_profile_main">
                        <div class="dashboard_profile d-flex justify-content-between">
                            <div class="profile_setting text-capitalize">
                                <?php if($userData->status==0): ?>
                                    <h3 class="text-danger"><i class="fa fa-warning"></i> Please update & complete your profile</h3>

                                    <?php else: ?>
                                    <h3> Update Your Profile Setting </h3>
                                <?php endif; ?>

                            </div>
                            <div class="title_edit text-capitalize"><a href="javascript:void(0)">All Ads</a></div>
                        </div>

                    </div>



                    <div class="row">
                        <div class="<?php if($userData->social_id==null): ?>col-md-6 <?php else: ?> col-md-8 <?php endif; ?> m-t-40 margin_top">
                            <div class="profile_detail">
                                <h3>profile detail </h3>
                                <?php echo Form::open(['url'=>'/my-profile','method'=>'POST','files'=>true]); ?>

                                    <div class="form-group">
                                        <label>Full Name</label>
                                        <input type="hidden" name="id" id="userId" value="<?php echo e($userData->id); ?>" />
                                        <?php echo e(Form::text('name',$value=isset($userData->name)?$userData->name:'',['class'=>'form-control','required'=>true])); ?>

                                        <?php if($errors->has('name')): ?>
                                            <span class="help-block">
                                                <strong class="text-danger"><?php echo e($errors->first('name')); ?></strong>
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                    <div class="form-group">
                                        <label>Mobile </label>
                                        <?php echo e(Form::number('mobile',$value=isset($userData->mobile)?$userData->mobile:old('mobile'),['min'=>'0','id'=>'userMobileUpdata','class'=>'form-control maxlength','required'=>true])); ?>

                                        <span id="updateMobileError" class="text-danger"></span>
                                        <?php if($errors->has('mobile')): ?>
                                            <span class="help-block">
                                        <strong class="text-danger"><?php echo e($errors->first('mobile')); ?></strong>
                                    </span>
                                        <?php endif; ?>
                                    </div>
                                    <div class="form-group">
                                        <label>email</label>
                                        <?php echo e(Form::email('email',$value=isset($userData->email)?$userData->email:old('email'),['class'=>'form-control'])); ?>

                                        <?php if($errors->has('email')): ?>
                                            <span class="help-block">
                                                <strong class="text-danger"><?php echo e($errors->first('email')); ?></strong>
                                            </span>
                                        <?php endif; ?>
                                    </div>

                                    <div class="form-group">
                                        <label>Your Location </label>

                                        <?php echo e(Form::text('location[]',$value=$existingLocation,['id'=>'locationField','style'=>'display:none','class'=>'form-control type-pass','placeholder'=>'Type your sub-category and press Enter','required'=>false])); ?>


                                        <ul id="locationFieldUl"></ul>
                                        <span class="locationError text-danger"> </span>
                                        <span class="taging-notes"> Type your location and press Enter. Max(5) </span>

                                    </div>


                                    <div class="form-group">
                                        <label>Address</label>

                                        <?php echo e(Form::textarea('address',$value=isset($userData->address)?$userData->address:old('address'),['rows'=>'5','class'=>'form-control','required'=>true])); ?>

                                        <?php if($errors->has('address')): ?>
                                            <span class="help-block">
                                                <strong class="text-danger"><?php echo e($errors->first('address')); ?></strong>
                                            </span>
                                        <?php endif; ?>

                                    </div>

                                    <div class="form-group ">

                                        <label class="slide_upload profile-image" for="file"> Upload photo
                                            <?php if($userData->image!=null && $userData->social_id!=null): ?>
                                                <img id="image_load" src="<?php echo e($userData->image); ?>" style="cursor: not-allowed !important;max-width: 120px;border: 2px dashed #2783bb; cursor: pointer">

                                            <?php elseif($userData->image!='' && $userData->social_id==''): ?>
                                                <img id="image_load" src="<?php echo e(asset($userData->image)); ?>" style="max-width: 120px;border: 2px dashed #2783bb; cursor: pointer">

                                            <?php else: ?>
                                                <img id="image_load" src="<?php echo e(asset('/')); ?>images/default/photo.png" style="max-width: 120px;border: 2px dashed #2783bb; cursor: pointer">

                                            <?php endif; ?>
                                        </label>

                                        <input id="file" style="display:none" name="image" type="file" <?php if($userData->image!='' && $userData->social_id!=''): ?> disabled="disabled"  <?php endif; ?> onchange="photoLoad(this,this.id)" accept="image/*">

                                    </div>

                                    <button class="update_btn mt-2 text-capitalize" type="submit" value="button" id="updateBtn">update</button>
                                <?php echo Form::close(); ?>

                            </div>
                        </div>

                        <?php if($userData->social_id==null): ?>

                        <div class="col-md-6 m-t-40 margin_top">
                            <div class="change_password m-t-0">
                                <h3>change password</h3>
                                <?php echo Form::open(array('route' => 'change.my.password','method'=>'POST','id'=>'passwordChangeForm','class'=>'form-horizontal',)); ?>

                                    <div class="form-group">
                                        <label>current password</label>
                                        <input type="hidden" name="id" id="passwordChangeId" value="<?php echo e($userData->id); ?>" />
                                        <?php echo e(Form::password('old_password',['class'=>'form-control','required'=>true])); ?>


                                        <?php if($errors->has('errorPass')): ?>
                                            <span class="help-block">
                                                <strong class="text-danger"><?php echo e($errors->first('errorPass')); ?></strong>
                                            </span>
                                        <?php endif; ?>
                                    </div>

                                    <div class="form-group">
                                        <label>new password</label>
                                        <?php echo e(Form::password('password',['min'=>'8','id'=>'newPassword','class'=>'form-control type-pass','required'=>true])); ?>


                                        <?php if($errors->has('password')): ?>
                                            <span class="help-block">
                                                <strong class="text-danger"><?php echo e($errors->first('password')); ?></strong>
                                            </span>
                                        <?php endif; ?>

                                    </div>

                                    <div class="form-group">
                                        <label>confirm new password</label>
                                        <?php echo e(Form::password('password_confirmation',['min'=>'8','id'=>'passwordConfirmation','class'=>'form-control type-pass','required'=>true])); ?>

                                        <span id="confirmPassError" class="text-danger"></span>
                                        <?php if($errors->has('password_confirmation')): ?>
                                            <span class="help-block">
                                                <strong class="text-danger"><?php echo e($errors->first('password_confirmation')); ?></strong>
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                    <button class="change_btn mt-2 text-capitalize" type="submit" id="changeSubmit" value="button">change now</button>
                                <?php echo Form::close(); ?>



                            </div>
                        </div>

                            <?php endif; ?>
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

    <!-- for taging -->
    <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
    <script src="<?php echo e(asset('/tagging/js/jquery-1.12.1-ui.min.js')); ?>"></script>
    <script src="<?php echo e(asset('/tagging/js/tag-it.min.js')); ?>"></script>


    <!-- location line -->
    <script>
        $(function(){
            $('#locationFieldUl').tagit({
                // This will make Tag-it submit a single form value, as a comma-delimited field.
                singleField: true,
                singleFieldNode: $('#locationField'),
                allowSpaces: true,
                fieldName:"location",
                tagLimit:3,
                placeholderText:'Search Or type your ad location',
                //autocomplete: {source:country_list},
                autocomplete: {
                    source: function( request, response ) {
                        $.ajax({
                            url: "<?php echo e(URL::to('/get-ad-location')); ?>",
                            dataType: "json",
                            data: {
                                q: request.term
                            },
                            success: function( data ) {
                                response( data );
                            }
                        });
                    },

                },

            });
        });
    </script>

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

<?php echo $__env->make('frontend.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\paibaApp\resources\views/frontend/my-account/my-profile.blade.php ENDPATH**/ ?>