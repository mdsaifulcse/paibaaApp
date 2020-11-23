<?php $__env->startSection('content'); ?>
    <style>
        .paddingBottom{
            padding-bottom: 20px;
        }
        .register-form{
            padding: 50px;
        }
        .register-form .only-border-bottom{
            border: none;
            border-bottom: 1px solid #d5d5d5;
            border-radius: 0px;
            box-shadow: none;
        }
        .login_btn{
            border-radius: 50px;
            margin-left: 41%;
            padding: 7px 15px;
            color: #004eff;
            border: 1px solid #E91E63;
        }
        .social-login{
            padding:30px;
            margin-top: 20%;
        }
        .social-login a{
            display: flex;
            overflow: hidden;
            background: #4267b2;
            height: 41px;
            width: 100%;
            text-align: center;
            font-size: 17px;
            color: #fff;
            border-radius: 0px;
            border: 1px solid #4267b2;
            margin-bottom: 15px;
            text-decoration: none;
            transition: all 0.3s ease;
            padding: 6px;
        }
        .social-login a img{
            padding-right: 5px;
        }
        @media  only screen and (max-width :768px) {
            .register-form{
                padding-top: 10px;
            }
            .social-login{
                margin-top: 0%;
            }
        }

    </style>
    <div class="paddingBottom"> </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-2 col-md-2 col-sm-3 col-xs-12">
                <a href="<?php echo e(URL::to('/')); ?>" class=" ">
                    <img src="<?php echo e(asset('/frontend')); ?>/images/logo.png" alt="Paibaa | Khojlei Paibaa" class="img-responsive center-block">
                </a>
            </div>

            <div class="col-lg-8 col-md-8 col-sm-9 col-xs-12">
                <div class="text-center">
                    <h1>Sign up to Paibaa</h1>
                    <h5>Already have Paibaa account? <a href="<?php echo e(URL::to('/login')); ?>"> Login </a></h5>

                </div>
            </div>
        </div>
    </div>
    <hr>

    <div class="paddingBottom"></div>

    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" style="border-right: 1px solid #aeaaaa;">
                <div class="register-form">
                    <?php echo Form::open(['url'=>'/register-client','id'=>'clientReg','method'=>'POST']); ?>

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group has-feedback">
                                <?php echo e(Form::text('name',$value=old('name'),['class'=>'form-control only-border-bottom','placeholder'=>'Name *','required'=>true])); ?>


                                <?php if($errors->has('name')): ?>
                                    <span class="help-block">
                        <strong class="text-danger"><?php echo e($errors->first('name')); ?></strong>
                    </span>
                                <?php endif; ?>

                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group has-feedback">
                                <?php echo e(Form::number('mobile',$value=old('mobile'),['id'=>'userMobile','class'=>'form-control only-border-bottom','placeholder'=>'Mobile *','required'=>true])); ?>

                                <span id="mobileError" class="text-danger"></span>
                                <?php if($errors->has('mobile')): ?>
                                    <span class="help-block">
                                        <strong class="text-danger"><?php echo e($errors->first('mobile')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>

                        </div>

                        <div class="col-sm-12">
                            <div class="form-group has-feedback">
                                <?php echo e(Form::email('email',$value=old('email'),['id'=>'userEmail','class'=>'form-control only-border-bottom','placeholder'=>'Email Address'])); ?>


                                <?php if($errors->has('email')): ?>
                                    <span class="help-block">
                        <strong class="text-danger"><?php echo e($errors->first('email')); ?></strong>
                    </span>
                                <?php endif; ?>
                                <span id="emailError" class="text-danger"></span>
                            </div>

                        </div>

                        <div class="col-sm-12">
                            <div class="form-group has-feedback">
                                <?php echo e(Form::password('password',['class'=>'form-control only-border-bottom','placeholder'=>'Password','min'=>8,'required'=>true])); ?>

                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="form-group has-feedback">
                                <?php echo e(Form::password('password_confirmation',['class'=>'form-control only-border-bottom','placeholder'=>'Retype password','min'=>8,'required'=>true])); ?>

                                <?php if($errors->has('password')): ?>
                                    <span class="help-block">
                        <strong class="text-danger"><?php echo e($errors->first('password')); ?></strong>
                    </span>
                                <?php endif; ?>
                                <span id="emailError" class="text-danger"></span>
                            </div>
                        </div>

                    </div>
                    <div class="form-group">
                        <button type="submit" class="buttons login_btn text-center" value="Login">
                            Continue
                        </button>
                    </div>
                    <div class="form-info">
                        <p class="text-center "></p>
                    </div>
                    <?php echo Form::close(); ?>

                </div>
            </div><!-- Register area -->

            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <div class="list-unstyled list-inline social-login">
                    <a href="#" class="facebook"> <img src="<?php echo e(asset('/frontend')); ?>/images/fb.png" alt="Classified Plus"> Continue wiith Facbook</a>
                    <a href="#" class="google" style="background-color: #2687d5ad;"> <img src="<?php echo e(asset('/frontend')); ?>/images/google_p.png" alt="Classified Plus"> <span>Continue with Google</span></a>
                </div>
            </div><!-- social register area -->
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('auth.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\paibaApp\resources\views/auth/register.blade.php ENDPATH**/ ?>