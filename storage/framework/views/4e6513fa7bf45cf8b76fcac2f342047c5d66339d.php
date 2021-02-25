<?php $__env->startSection('title'); ?>
   <?php echo e($adDetails->title); ?> | paibaa | khujlei paibaa
<?php $__env->stopSection(); ?>

<?php $__env->startSection('style'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('/frontend')); ?>/css/owlcarousel/owl.carousel.min.css" />
    <link rel="stylesheet" href="<?php echo e(asset('/frontend')); ?>/css/owlcarousel/owl.theme.default.min.css" />

    <link rel="stylesheet" href="<?php echo e(asset('/frontend')); ?>/datepicker/css/pickmeup.css" />
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <style>
        .nounderline{
            text-decoration: none !important;
        }
        .badge-info{
            background-color: #8BC34A;
        }
    </style>

    <div class="iner_breadcrumb p-t-0 p-b-0">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo e(URL::to('/')); ?>">Home</a></li>
                    <li class="breadcrumb-item"><a href="<?php echo e(URL::to('ads/bangladesh/'.$adDetails->postCategory->link)); ?>"><?php echo e($adDetails->postCategory->category_name); ?></a></li>
                    
                    <li class="breadcrumb-item " aria-current="page"><?php echo e($adDetails->title); ?></li>
                </ul>
            </nav>
        </div>
    </div>


    <section class="detail_part m-t-5">
        <div class="container">
            <div class="row">
                <?php if($adDetails->postCategory->post_type==1): ?>
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                    <div class="detail_box owl-carousel owl-theme">
                        <div>
                        <?php if(file_exists('images/post_photo/big/'.$adDetails->postPhoto->photo_one)): ?>
                            <img class="img-fluid" src="<?php echo e(asset('images/post_photo/big/'.$adDetails->postPhoto->photo_one)); ?>" alt="<?php echo e($adDetails->title); ?>">
                        </div>
                        <?php else: ?>
                        <img class="img-fluid" src="<?php echo e(asset('/images/default/photo.png')); ?>" alt="<?php echo e($adDetails->title); ?>">
                    </div>
                        <?php endif; ?>

                        <?php if($adDetails->postPhoto->photo_two!=''): ?>
                            <div><img class="img-fluid" src="<?php echo e(asset('images/post_photo/big/'.$adDetails->postPhoto->photo_two)); ?>" alt="<?php echo e($adDetails->title); ?>"></div>
                        <?php endif; ?>

                        <?php if($adDetails->postPhoto->photo_three!=''): ?>
                            <div><img class="img-fluid" src="<?php echo e(asset('images/post_photo/big/'.$adDetails->postPhoto->photo_three)); ?>" alt="<?php echo e($adDetails->title); ?>"></div>
                        <?php endif; ?>
                        <?php if($adDetails->postPhoto->photo_four!=''): ?>
                            <div><img class="img-fluid" src="<?php echo e(asset('images/post_photo/big/'.$adDetails->postPhoto->photo_four)); ?>" alt="<?php echo e($adDetails->title); ?>"></div>
                        <?php endif; ?>
                    </div>

                    <p style="padding-top: px"><i class="fa fa-clock-o them-color"></i> <?php echo e(date('d-M-Y h:i a',strtotime($adDetails->updated_at))); ?>

                        <i class="fa fa-map-marker them-color"></i>
                        <?php

                        $allLocations=$adDetails->adLocation->pluck('url')->toArray();
                        ?>

                    </p>
                    <br>
                    Location:
                    <?php $__empty_1 = true; $__currentLoopData = $allLocations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $allLocation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

                        <a href="<?php echo e(URL::to('ads/'."$allLocation".'/'.$adDetails->postCategory->link)); ?>" class="nounderline">
                            <span class="badge badge-secondary"><?php echo e($allLocation); ?></span>
                        </a>

                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <span>No Category</span>
                    <?php endif; ?>


                    <hr>
                    Category:
                        <?php $__empty_1 = true; $__currentLoopData = $adDetails->adSubCategory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subCatName): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <a href="<?php echo e(URL::to('ads/bangladesh/'.$adDetails->postCategory->link.'?subcategory='.$subCatName->id)); ?>" class="nounderline">
                                <span class="badge badge-secondary"><?php echo e($subCatName->sub_category_name); ?></span>
                            </a>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <span>No Category</span>
                            <?php endif; ?>

                    <hr>
                    Tags:
                        <?php $__empty_1 = true; $__currentLoopData = $tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <a href="<?php echo e(URL::to('/tag/'.str_replace(' ','-',$tag))); ?>" class="nounderline">
                                <span class="badge badge-secondary"><?php echo e($tag); ?></span>
                            </a>

                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <span>No Tag</span>
                        <?php endif; ?>
                </div>
            <?php endif; ?>

                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                    <div class="detail_box">
                        <div class="detail_head">
                            <p><a href="<?php echo e(URL::to('/profile/'.$adDetails->postAuthor->user_name)); ?>"> <?php echo e($adDetails->postAuthor->name); ?> </a>
                                
                                <br>
                            </p>
                            <h3> <?php echo e($adDetails->title); ?></h3>

                            <?php if(count($adDetails->adPostPrice)>0): ?>
                                <ul class="deal-price list-unstyled text-capitalize m-b-0 m-t-15" id="orderPriceTitle">
                                    <?php $__currentLoopData = $adDetails->adPostPrice; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$adPostPrice): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li class="d-inline-block p-r-20 every-price">
                                        <?php
                                        if ($adPostPrice->is_negotiable==1){$readOnly='true'; }else{$readOnly='false';}
                                        ?>
                                            <span class="rend-blog-price-type">
                                                <a href="<?php echo e(URL::to('price/'.$adPostPrice->price_title.'?cat='.$adDetails->postCategory->link)); ?>" class="order-price-title">
                                                    <?php echo e($adPostPrice->price_title); ?>

</a>
                                            </span>

                                            <label>
                                                <input type="checkbox" name="offer_price[<?php echo e($adPostPrice->price_title); ?>]" />
                                                BDT <?php echo e(round($adPostPrice->price)); ?>


                                            </label>
                                    </li>

                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>

                                <ul class="deal-price list-unstyled text-capitalize m-b-0 m-t-15" id="requestPriceTitle" style="display: none">
                                    <?php $__currentLoopData = $adDetails->adPostPrice; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$adPostPrice): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li class="d-inline-block p-r-20 every-price">
                                            <?php
                                            if ($adPostPrice->is_negotiable==1){$readOnly='true'; }else{$readOnly='false';}
                                            ?>
                                            <span class="rend-blog-price-type">
                                                <?php echo e($adPostPrice->price_title); ?> </span> :<span class="price">

                                            <?php echo e(Form::number("offer_price[$adPostPrice->price_title]",$value=round($adPostPrice->price), ['min'=>0,'readonly'=>false])); ?>

                                        </span>
                                            <label> &nbsp; BDT <input type="checkbox" name="price_title[]" value="<?php echo e($adPostPrice->price_title); ?>"></label>
                                        </li>

                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>

                                <ul class="list-unstyled text-capitalize m-b-0 m-t-15">

                                    <li class="d-inline-block p-r-20">
                                        <?php
                                        if (Session::has('odRf')){
                                            Session::forget('odRf');
                                        }
                                        ?>

                                        <?php if(!Auth::check()): ?>
                                            <a href="<?php echo e(URL::to('/login?'.'od_rf='.Request::path())); ?>" class="price-request"> Request </a>
                                        <?php elseif(Auth::check() && Auth::user()->id==$adDetails->user_id): ?>
                                            <span>This is your Ad </span>

                                        <?php elseif(!Auth::check() || empty($priceNegotiation)): ?>

                                        <a href="javascript:void(0)" class="price-request" title="Click here to Request" onclick="makeOffer()" > Request</a>

                                        <?php elseif(!empty($priceNegotiation) && $priceNegotiation->ad_post_id==$adDetails->id): ?>
                                        <a href="javascript:void(0)" class="price-request send-request"> Already Requested <i class="fa fa-check" aria-hidden="true"></i> </a>
                                        <?php endif; ?>


                                            <?php if(!Auth::check()): ?>
                                            &nbsp; <a href="<?php echo e(URL::to('/login?'.'od_rf='.Request::path())); ?>" class="price-request" title="Click here to <?php echo e($adDetails->postCategory->order_label); ?>" > <?php echo e($adDetails->postCategory->order_label); ?></a>
                                            <?php elseif(Auth::check() && Auth::user()->id!=$adDetails->user_id): ?>
                                                <a href="javascript:void(0)" class="price-request" title="Click here to <?php echo e($adDetails->postCategory->order_label); ?>" onclick="makeOrder()" > <?php echo e($adDetails->postCategory->order_label); ?></a>
                                                <?php endif; ?>
                                    </li>

                                </ul>

                                <?php endif; ?>
                        </div>


                    </div>

                    <div class="description_box">
                        <?php echo $adDetails->description;?>
                    </div>
                    <hr>
                    <ul class="list-unstyled d-inline-block float-left detail_left m-b-0">
                        <li class="meetup"><i class="fa fa-handshake-o" aria-hidden="true"></i> Phone &nbsp; </li>
                    </ul>
                    <ul class="list-unstyled d-inline-block m-l-40 detail_right  m-b-0">
                        <li class="meetup"><i class="fa fa-mobile them-color"></i> <?php echo e($adDetails->contact); ?></li>
                    </ul>
                    <br>
                    <ul class="list-unstyled d-inline-block float-left detail_left m-b-0">
                        <li class="meetup"><i class="fa fa-handshake-o" aria-hidden="true"></i> Meetup</li>
                    </ul>
                    <ul class="list-unstyled d-inline-block m-l-40 detail_right  m-b-0">
                        <li class="meetup"><i class="fa fa-map-marker them-color"></i> <?php echo e($adDetails->address); ?></li>
                    </ul>


                <!--Request Start Modal -->
                    <div class="modal fade" id="requestModal" role="dialog" data-keyboard="false" data-backdrop="static">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h5 class="modal-title request-title"> &nbsp; Request to author with your message ( <?php echo e($adDetails->postAuthor->name); ?> ) </h5>
                                </div>
                                <div class="modal-body">



                                    <?php echo Form::open(['route'=>'price-negotiation.store','method'=>'POST']); ?>


                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group has-feedback">
                                                <?php echo e(Form::hidden('ad_post_id',$value=$adDetails->id,['class'=>'form-control','required'=>true] )); ?>

                                            </div>
                                            <?php if($errors->has('ad_post_id')): ?>
                                                <span class="help-block">
                                                    <strong class="text-danger"><?php echo e($errors->first('ad_post_id')); ?></strong>
                                                </span>
                                            <?php endif; ?>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group has-feedback">
                                                <?php echo e(Form::textarea('request_message','',['rows'=>'3','class'=>'form-control request-message','placeholder'=>'Write some message','required'=>true])); ?>

                                                <?php if($errors->has('request_message')): ?>
                                                    <span class="help-block">
                                        <strong class="text-danger"><?php echo e($errors->first('request_message')); ?></strong>
                                    </span>
                                                <?php endif; ?>
                                            </div>
                                        </div>

                                        <div class="col-sm-12">
                                            <div class="form-group has-feedback">
                                                <ul class="deal-price list-unstyled text-capitalize m-b-0 m-t-15" id="requestPriceTitleLi">


                                                </ul>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="form-group">

                                        <?php if(Auth::check() && Auth::user()->status==0): ?>

                                            <p class="text-center m-b-10">
                                                <span class="text-danger">Your profile is not complete, Please complete</span>
                                                <a href="<?php echo e(URL::to('my-profile')); ?>" class="price-request"> Profile </a>
                                            </p>

                                            <?php $submit='button'?>
                                        <?php else: ?>
                                            <?php $submit='submit'?>
                                                <button type="<?php echo e($submit); ?>" class="buttons login_btn" name="login" value="Continue">Send Request </button>

                                        <?php endif; ?>
                                    </div>

                                    <?php echo Form::close(); ?>



                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>

                <!--Request End Modal -->


                <!--Order Start Modal -->
                    <div class="modal fade" id="priceDealModal" role="dialog" data-keyboard="false" data-backdrop="static">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h5 class="modal-title request-title"> &nbsp;<?php echo e($adDetails->postCategory->order_label); ?> to author with your message ( <?php echo e($adDetails->postAuthor->name); ?> ) </h5>
                                </div>
                                <div class="modal-body">

                                    <?php echo Form::open(['route'=>'customer-order.store','method'=>'POST','files'=>true]); ?>


                                    <div class="row">

                                        <div class="col-sm-12">
                                            <div class="form-group has-feedback">
                                                <input type="hidden" name="ad_post_id" value="<?php echo e($adDetails->id); ?>" required >
                                            </div>
                                        </div>

                                        <div class="col-sm-12">
                                            <div class="form-group has-feedback">
                                                <?php echo e(Form::textarea('txt_message','',['rows'=>'3','class'=>'form-control request-message','placeholder'=>'Write some message','required'=>true])); ?>

                                                <?php if($errors->has('txt_message')): ?>
                                                    <span class="help-block">
                                                        <strong class="text-danger"><?php echo e($errors->first('txt_message')); ?></strong>
                                                    </span>
                                                <?php endif; ?>
                                            </div>
                                        </div>

                                    <?php if($adDetails->category_id==1): ?> <!-- NEED -->

                                        <div class="col-sm-12">
                                            <div class="form-group has-feedback">

                                                <label>Please choose pdf file</label>
                                                <?php echo e(Form::file('attach_file',['class'=>'form-control','accept'=>'application/pdf','title'=>'Please chose pdf file','required'=>true] )); ?>

                                            </div>

                                            <?php if($errors->has('attach_file')): ?>
                                                <span class="help-block">
                                                        <strong class="text-danger"><?php echo e($errors->first('attach_file')); ?></strong>
                                                    </span>
                                            <?php endif; ?>
                                        </div>

                                    <?php endif; ?>

                                    <?php if($adDetails->category_id==2): ?> <!-- SALE -->
                                        <div class="col-sm-12">
                                            <div class="form-group has-feedback">

                                                <?php echo e(Form::text('delivery_address',$value='',['title'=>'Delivery address * ','class'=>'form-control','placeholder'=>'Delivery address *','readonly'=>false,'required'=>true] )); ?>

                                            </div>

                                            <?php if($errors->has('delivery_address')): ?>
                                                <span class="help-block">
                                                    <strong class="text-danger"><?php echo e($errors->first('delivery_address')); ?></strong>
                                                </span>
                                            <?php endif; ?>
                                        </div>
                                    <?php endif; ?>

                                    <?php if($adDetails->category_id==4): ?> <!-- Service -->
                                        <div class="col-sm-12">
                                            <div class="form-group has-feedback">

                                                <?php echo e(Form::text('service_meet_up',$value='',['title'=>'Meet up address ','class'=>'form-control','placeholder'=>'Delivery address *','readonly'=>false,'required'=>true] )); ?>

                                            </div>

                                            <?php if($errors->has('service_meet_up')): ?>
                                                <span class="help-block">
                                                    <strong class="text-danger"><?php echo e($errors->first('service_meet_up')); ?></strong>
                                                </span>
                                            <?php endif; ?>
                                        </div>
                                    <?php endif; ?>


                                    <?php if($adDetails->category_id==3 || $adDetails->category_id==4): ?> <!-- Rent and  Service -->

                                        <?php
                                        if ($adDetails->category_id==3){
                                            $required=true;
                                        }else{
                                            $required=false;
                                        }
                                        ?>
                                        <div class="col-md-3 col-md-3">
                                            <div class="form-group has-feedback">
                                                <label>Date Start</label>
                                                <?php echo e(Form::text('booking_date_start',$value='',['class'=>'dateStart form-control','required'=>$required] )); ?>

                                            </div>

                                            <?php if($errors->has('booking_date_start')): ?>
                                                <span class="help-block">
                                                        <strong class="text-danger"><?php echo e($errors->first('booking_date_start')); ?></strong>
                                                    </span>
                                            <?php endif; ?>
                                        </div>

                                        <div class="col-md-3 col-md-3">
                                            <div class="form-group has-feedback">
                                                <label>Time Start</label>
                                                <?php echo e(Form::time('booking_time_start',$value='',['class'=>'form-control','required'=>$required] )); ?>

                                            </div>

                                            <?php if($errors->has('booking_time_start')): ?>
                                                <span class="help-block">
                                                        <strong class="text-danger"><?php echo e($errors->first('booking_time_start')); ?></strong>
                                                    </span>
                                            <?php endif; ?>
                                        </div>

                                        <!-- Date and time end -->


                                        <div class="col-md-3 col-md-3">
                                            <div class="form-group has-feedback">
                                                <label>Date End</label>
                                                <?php echo e(Form::text('booking_date_end',$value='',['class'=>'dateEnd form-control','required'=>$required] )); ?>

                                            </div>

                                            <?php if($errors->has('booking_date_end')): ?>
                                                <span class="help-block">
                                                        <strong class="text-danger"><?php echo e($errors->first('booking_date_end')); ?></strong>
                                                    </span>
                                            <?php endif; ?>
                                        </div>

                                        <div class="col-md-3 col-md-3">
                                            <div class="form-group has-feedback">
                                                <label>Time End</label>
                                                <?php echo e(Form::time('booking_time_end',$value='',['class'=>'form-control','required'=>$required] )); ?>

                                            </div>

                                            <?php if($errors->has('booking_time_end')): ?>
                                                <span class="help-block">
                                                        <strong class="text-danger"><?php echo e($errors->first('booking_time_end')); ?></strong>
                                                    </span>
                                            <?php endif; ?>
                                        </div>

                                        <?php endif; ?>


                                        <div class="col-sm-12">
                                            <div class="form-group has-feedback">

                                                <ul class="deal-price list-unstyled text-capitalize m-b-0 m-t-15" id="priceTitleToAuthor">


                                                </ul>
                                            </div>
                                        </div>

                                        </div><!-- end row -->
                                        <div class="form-group">

                                            <?php if(Auth::check() && Auth::user()->status==0): ?>

                                                <p class="text-center m-b-10">
                                                    <span class="text-danger">Your profile is not complete, Please complete</span>
                                                    <a href="<?php echo e(URL::to('my-profile')); ?>" class="price-request"> Profile </a>
                                                </p>

                                                <?php $submit='button'?>
                                            <?php else: ?>
                                                <?php $submit='submit'?>
                                                    <button type="<?php echo e($submit); ?>" class="buttons login_btn"
                                                            name="login" value="Continue" onclick="return confirm('Please Check Again') ">Submit <?php echo e($adDetails->postCategory->order_label); ?> </button>
                                            <?php endif; ?>



                                        </div>

                                        <?php echo Form::close(); ?>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <!-- End Order modal -->
            </div>
    </section>


<hr>
    <section class="description">
        <div class="container">

            <!-- Row  -->
            <div class="row justify-content-left">
                <div class="col-md-7 text-left">

                </div>
            </div>
            <!-- Row  -->

            <div class="row">
                <div class="col-md-8">
                    <h5 class=" badge-info p-1"> Comment</h5>

                    <section class="iner_breadcrumb p-t-20 p-b-20">


                        <div class="row">
                            <div class="col-md-1 col-sm-3">
                                <div class="">
                                    <?php if(!empty(auth()->user()->image)): ?>
                                        <img class="comment-user-img" src="<?php echo e(asset(auth()->user()->image)); ?>">
                                    <?php else: ?>
                                        <img class="comment-user-img" src="<?php echo e(asset('/images/default/photo.png')); ?>">
                                    <?php endif; ?>
                                </div>

                            </div>
                            <div class="col-md-11 col-sm-9">
                                <?php if(Auth::check() && Auth::user()->status==0): ?>

                                    <p class="text-center m-b-10">
                                        <span class="text-danger">Your Profile is not complete, Please complete</span>
                                        <a href="<?php echo e(URL::to('my-profile')); ?>" class="price-request"> Profile </a>
                                    </p>

                                    <?php $readonly='readonly'?>
                                <?php else: ?>
                                    <?php $readonly=''?>
                                <?php endif; ?>
                                <strong></strong>
                                <?php echo Form::open(['url'=>'/ad-public-comment-save','method'=>'POST','id'=>'commentForm','data-route'=>'ad-public-comment']); ?>


                                <input type="hidden" name="user_id" value="<?php echo e(Auth::check() && Auth::user()->id); ?>" id="userId">
                                <input type="hidden" name="ad_post_id" value="<?php echo e($adDetails->id); ?>" id="adPostId">

                                <textarea name="comment" id="comment" <?php echo e($readonly); ?> onclick="openCommentBox(this.value)" onkeyup="openCommentBox(this.value)" rows="2" class="form-control comment-box" placeholder="Add Public Comment"></textarea>
                                <span class="text-danger comment-error" style="display: none"> Comment is required !</span>

                                <div class="submitCancel pull-right m-t-5 " style="display: none">
                                    <span class="btn btn-default cancel">CANCEL</span> &nbsp;&nbsp;&nbsp;&nbsp; <button type="submit" disabled class="btn btn-success" id="commentSubmit"> COMMENT </button>
                                </div>

                                <?php echo Form::close(); ?>

                            </div>
                        </div>


                        
                            
                                
                            
                            
                                
                            
                        

                        <hr>
                        <!-- Start Comment show  -->
                        <div id="commentData">
                            <?php $numberOfComment=count($comments);?>
                            <?php if($numberOfComment>0): ?>
                                <?php $__currentLoopData = $comments->take(3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="row m-t-20">
                                        <div class="col-md-1 col-sm-3">
                                            <div class="">
                                                <?php if(!empty($comment->commentAuthor->image)): ?>
                                                    <a href="<?php echo e(URL::to('/profile/'.$comment->commentAuthor->user_name)); ?>">
                                                    <img class="comment-user-img" src="<?php echo e(asset($comment->commentAuthor->image)); ?>"></a>
                                                <?php else: ?>
                                                    <a href="<?php echo e(URL::to('/profile/'.$comment->commentAuthor->user_name)); ?>">
                                                    <img class="comment-user-img" src="<?php echo e(asset('/images/default/photo.png')); ?>">
                                                    </a>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <div class="col-md-11 col-sm-9">

                                            <h6><a href="<?php echo e(URL::to('/profile/'.$comment->commentAuthor->user_name)); ?>"> <strong><?php echo e($comment->commentAuthor->name); ?> </strong></a><?php echo e($comment->created_at->diffForHumans()); ?> </h6>
                                            <h6> <?php echo e($comment->comment); ?></h6>

                                            <?php echo Form::close(); ?>

                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                <?php if($numberOfComment>3): ?>
                                <button class="btn btn-info btn-sm m-t-10" id="seeMoreComment"> See more</button>
                                <?php endif; ?>

                            <?php endif; ?>
                        </div>

                        <!-- end comment show -->

                    </section>

                </div>


                <div class="col-md-4">
                    <div class="single-sidebar">
                        <!--  Chat Start -->
                        
                        <?php if(Auth::check() && (count($getChatReplayData)>0 || count($getChatOfferData)>0)): ?>
                            <h6 class=" badge-info p-1 "> <i class="fa fa-comments-o" aria-hidden="true"></i> Chat</h6>
                                <div class="card  bg-dark text-white">
                                    <div class="card-header">
                                        <div>

                                            <?php if(count($offerUsers)>0): ?>
                                                <div class="">
                                                    <label class="control-label price-request"> Chat Partner</label>

                                                    <?php echo e(Form::select('user_id',$offerUsers,$currentChatUser->id,['id'=>'CurrentUser','class'=>'form-control','required'=>true])); ?>

                                                </div>
                                            <?php endif; ?>
                                            <span>
                                                <img id="chatUserImage" style="width: 25px;border-radius: 50%" src="<?php if(!empty($currentChatUser->image)): ?> <?php echo e(asset($currentChatUser->image)); ?> <?php else: ?> <?php echo e(asset('/images/default/photo.png')); ?> <?php endif; ?> ">
                                            </span>
                                                <span id="chatUserName"> <?php if(!empty($currentChatUser)): ?> <?php echo e($currentChatUser->name); ?> <?php endif; ?> </span>

                                        </div>
                                    </div>
                                    <div class="card-body">

                                        <div class="row">

                                            <div class="col-md-2 col-sm-3">
                                                <div class="">
                                                    <?php if(!empty(auth()->user()->image)): ?>
                                                        <img class="chat-user-img" src="<?php echo e(asset(auth()->user()->image)); ?>">
                                                    <?php else: ?>
                                                        <img class="chat-user-img" src="<?php echo e(asset('/images/default/photo.png')); ?>">
                                                    <?php endif; ?>
                                                </div>
                                            </div>

                                            <div class="col-md-10 col-sm-9">

                                            <?php if(Auth::user()->status==0): ?>

                                                <p class="text-center m-b-10">
                                                    <span class="text-danger">Your Profile is not complete, Please complete</span>
                                                    <a href="<?php echo e(URL::to('my-profile')); ?>" class="price-request"> Profile </a>
                                                </p>

                                                <?php $readonly='readonly'?>
                                            <?php else: ?>
                                                <?php $readonly=''?>
                                            <?php endif; ?>


                                                <?php echo Form::open(['url'=>'/ad-public-comment-save','method'=>'POST','id'=>'chatForm','data-route'=>'ad-public-comment']); ?>


                                                <input type="hidden" name="user_id" value="<?php echo e(!empty($currentChatUser)?$currentChatUser->id:Auth::user()->id); ?>" id="chatUserId">
                                                <input type="hidden" name="ad_post_id" value="<?php echo e($adDetails->id); ?>" id="chatAdPostId">
                                                <input type="hidden" name="offer" value="<?php echo e($offer==1?2:1); ?>" id="chatOffer">

                                                <textarea name="request_message" id="requestMessage" <?php echo e($readonly); ?> onclick="openChatBox(this.value)" onkeyup="openChatBox(this.value)" class="form-control comment-box" placeholder=" Type a Message" autofocus></textarea>
                                                <span class="text-danger chat-error" style="display: none"> Message is required !</span>

                                                <div class="chatSubmitCancel pull-right m-t-5 " style="display: none">
                                                    <span class="btn btn-default chatCancel">CANCEL</span> &nbsp;&nbsp;&nbsp;&nbsp; <button type="submit" disabled class="btn btn-success" id="chatSubmit"> Send </button>
                                                </div>

                                                <?php echo Form::close(); ?>


                                            </div>
                                        </div>


                                    </div>
                                    <div class="card-footer" style="min-height: 200px; max-height: 400px; overflow: scroll;">

                                        <!-- Start Chat Offer Data show ---------------------------  -->
                                        <?php if(count($getChatOfferData)>0 && $offer==1): ?>
                                            <div id="chatData">
                                                <?php $__currentLoopData = $getChatOfferData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $offer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <div class="row m-b-10 conversation">
                                                        <div class="col-md-2 col-sm-3">
                                                            <div class="">
                                                                <?php if($offer->offer==1): ?>
                                                                    <a href="<?php echo e(URL::to('/profile/'.$offer->offeredUser->user_name)); ?>">
                                                                    <img class="chat-user-img" src="<?php if(!empty($offer->offeredUser->image)): ?> <?php echo e(asset($offer->offeredUser->image)); ?> <?php else: ?> <?php echo e(asset('/images/default/photo.png')); ?> <?php endif; ?> ">
                                                                    </a>
                                                                <?php elseif($offer->offer==2): ?>
                                                                    <a href="<?php echo e(URL::to('/profile/'.$offer->replayUser->user_name)); ?>">
                                                                    <img class="chat-user-img" src="<?php if(!empty($offer->replayUser->image)): ?> <?php echo e(asset($offer->replayUser->image)); ?> <?php else: ?> <?php echo e(asset('/images/default/photo.png')); ?> <?php endif; ?> ">
                                                                    </a>
                                                                <?php endif; ?>

                                                            </div>
                                                        </div>

                                                        <div class="col-md-10 col-sm-9">

                                                            <?php if($offer->offer==1): ?>
                                                                <h6 class="user-time">
                                                                    <a href="<?php echo e(URL::to('/profile/'.$offer->offeredUser->user_name)); ?>">
                                                                        <strong><?php echo e($offer->offeredUser->name); ?> </strong></a>

                                                                    <?php echo e($offer->created_at->diffForHumans()); ?> </h6>
                                                            <?php elseif($offer->offer==2): ?>
                                                                <h6 class="user-time">
                                                                    <a href="<?php echo e(URL::to('/profile/'.$offer->replayUser->user_name)); ?>">
                                                                    <strong><?php echo e($offer->replayUser->name); ?></strong>
                                                                    </a>
                                                                    <?php echo e($offer->created_at->diffForHumans()); ?> </h6>
                                                            <?php endif; ?>

                                                            <h6> <?php echo e($offer->request_message); ?></h6>

                                                            <?php echo Form::close(); ?>

                                                        </div>
                                                    </div>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </div>


                                        <!-- Start Chat Replay Data show ---------------------------  -->
                                    <?php endif; ?>


                                    <!-- Start Chat Replay show  -->
                                    <?php if(count($getChatReplayData)>0 && $offer==2): ?>
                                        <div id="chatData">
                                            <?php $__currentLoopData = $getChatReplayData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $replay): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <div class="row m-b-10 conversation">
                                                    <div class="col-md-2 col-sm-3 com-xs-6">
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

                                                    <div class="col-md-10 col-sm-9 col-xs-6">
                                                        <?php if($replay->offer==1): ?>
                                                            <h6 class="user-time"> <strong>
                                                                    <a href="<?php echo e(URL::to('/profile/'.$replay->offeredUser->user_name)); ?>">
                                                                    <?php echo e($replay->offeredUser->name); ?>

                                                                    </a>
                                                                </strong><?php echo e($replay->created_at->diffForHumans()); ?> </h6>
                                                        <?php elseif($replay->offer==2): ?>
                                                            <h6 class="user-time">
                                                                <a href="<?php echo e(URL::to('/profile/'.$replay->replayUser->user_name)); ?>">
                                                                <strong>
                                                                    <?php echo e($replay->replayUser->name); ?>


                                                                </strong>
                                                                </a>
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
                                        </div>
                                    <?php endif; ?>

                                    </div>
                                </div>


                        <?php else: ?>

                        <?php endif; ?>

                    <!-- end Chat show -->

                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="top_listings">
        <div class="container">

            <!-- Row  -->
            <div class="row">
                <div class="col-md-3  m-b-10">
                    <h5 class=" price-request p-1">You might also like</h5>
                </div>
            </div>
            <!-- Row  -->

            <div class="row">
                <div class="col-md-10 col-lg-10">
                    <div class="row">
                        <?php if(count($activeAds)>0): ?>
                            <?php $__currentLoopData = $activeAds; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$activeAd): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">
                                    <div class="featured-parts rounded m-b-30">
                                        <div class="featured-img">

                                            <a href="<?php echo e(URL::to('ad/'.$activeAd->link)); ?>" title="<?php echo e($activeAd->title); ?>">
                                                <?php if(file_exists('images/post_photo/small/'.$activeAd->postPhoto->photo_one)): ?>
                                                    <img class="img-fluid rounded-top" src="<?php echo e(asset('images/post_photo/small/'.$activeAd->postPhoto->photo_one)); ?>" alt="<?php echo e($activeAd->title); ?>">

                                                <?php else: ?>
                                                    <img class="img-fluid rounded-top" src="<?php echo e(asset('/images/default/photo.png')); ?>" alt="<?php echo e($activeAd->title); ?>">
                                                <?php endif; ?>
                                            </a>

                                            
                                            <div class="featured-price">
                                                <a href="javascript:void(0)">৳ <?php echo e(number_format($activeAd->price)); ?> </a>
                                            </div>
                                        </div>

                                        <div class="featured-text">
                                            <div class="text-top d-flex justify-content-between ">
                                                <div class="heading"> <a href="<?php echo e(URL::to('ad/'.$activeAd->link)); ?>" title="<?php echo e($activeAd->title); ?>">
                                                        <?php
                                                        if (strlen($activeAd->title) != strlen(utf8_decode($activeAd->title)))
                                                        {
                                                            echo substr($activeAd->title,0,48);
                                                        }else{
                                                            echo substr($activeAd->title,0,19);
                                                        }
                                                        ?>
                                                        ...</a> </div>
                                                
                                            </div>
                                            <div class="text-stars m-t-5">
                                                <p><strong > <?php echo e($activeAd->postCategory->category_name); ?> </strong> > <?php echo e(substr('sub category name here',0,12)); ?></p>

                                            </div>
                                            <div class="featured-bottum m-b-30">
                                                <ul class="d-flex justify-content-between list-unstyled m-b-20">
                                                    <li><a href="<?php echo e(URL::to('ad/'.$activeAd->link)); ?>"><i class="fa fa-map-marker"></i> <?php echo e('division_town'); ?> </a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>

                        

                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-md-12">
                    <div class="single-sidebar m-b-50 m-t-50 text-center"> <img class="add_img img-fluid" src="<?php echo e(asset('/frontend')); ?>/images/discount-img.png" alt="Paibaa | Khojlei Paibaa"> </div>
                </div>
            </div>
        </div>
    </section>





<?php $__env->stopSection(); ?>



<?php $__env->startSection('script'); ?>
    <!-- datepickeer -->
<script src="<?php echo e(asset('/frontend/datepicker/js/pickmeup.js')); ?>"></script>

<script>
    //priceTitleToAuthor
    function makeOffer() {
        //$('#offerPrice').val($('#offer_price').val())

        $("#requestPriceTitleLi").empty().append($('#requestPriceTitle').html());

        $('#requestModal').modal('show')
    }

    //priceTitleToAuthor
    function makeOrder() {
        //$('#offerPrice').val($('#offer_price').val())

        $("#priceTitleToAuthor").empty().append($('#orderPriceTitle').html());

        $('#priceDealModal').modal('show')
    }
</script>

 <script>
     addEventListener('DOMContentLoaded', function () {
         pickmeup('.dateStart', {
             position       : 'center',
             hide_on_select : true
         });

         var plus_5_days = new Date;
         plus_5_days.setDate(plus_5_days.getDate() + 2);

         pickmeup('.dateEnd', {
             position       : 'center',
             hide_on_select : true,
             date      : [
                 plus_5_days
             ]
         });
     });



 </script>

    

    <script>
        $('#CurrentUser').on('change',function () {

            var currentUser=$(this).val()
            var adPostId=$('#chatAdPostId').val()

            $('#chatData').empty().load('<?php echo e(URL::to("load-chat-data-by-user")); ?>'+'/'+adPostId+'/'+currentUser)

            var imags='<?php echo e(asset('/')); ?>'

            $.ajax({
                type:'GET',
                url:'<?php echo e(URl::to("get-chat-user-info")); ?>'+'/'+currentUser,
                success:function (data) {
                    $('#chatUserId').empty().val(data.userInfo.id)
                    $('#chatUserName').empty().text(data.userInfo.name)
                    $('#chatUserImage').attr( 'src', imags+data.userInfo.image)
                }

            })

        })


    </script>

    

    <script>
        function openChatBox(value) {

            $('.chatSubmitCancel').css('display','block')

            if(value.length>0){
                $('#chatSubmit').attr('disabled',false)
            }else {
                $('#chatSubmitCancel').attr('disabled',true)
            }
        }


        // hide submit button -----------------------
        $('.chatCancel').on('click',function () {
            $('.chatSubmitCancel').css('display','none')
        })


        //  ========  Submit Chat Message  ========
        $('#chatForm').submit(function (e) {
            e.preventDefault()
            console.log($('#chatForm').data('route'))

            if($('#requestMessage').val().length>0){
                $('#chatSubmit').attr('disabled',false)
                $('.comment-error').css('display','none')

                var route=$('#chatForm').data('route');
                //console.log($('#chatForm').serialize());

                $.ajax({
                    type: 'get',
                    url:"<?php echo e(URL::to('/send-chat-message')); ?>",
                    data:$('#chatForm').serialize(),
                    success:function (data) {
                        if (data='success'){
                            $('#requestMessage').val('')
                            $('#chatSubmit').attr('disabled',true)
                            // comment load comments data ----------
                            loadChatData($('#chatAdPostId').val(),$('#chatOffer').val(),$('#chatUserId').val())
                        }
                    }
                })

            }else {
                $('#chatSubmit').attr('disabled',true)
                $('.chat-error').css('display','block')
                return false;
            }
        })

        function loadChatData(adPostId,chatOffer,userId) {
            $('#chatData').empty().load('<?php echo e(URL::to("load-chat-data")); ?>'+'/'+adPostId+'/'+chatOffer+'/'+userId)
        }


        // For live chat ---------

        setInterval(function(){

            loadChatData($('#chatAdPostId').val(),$('#chatOffer').val(),$('#chatUserId').val())
            console.log('sdf')

        }, 7000);

    </script>

    
    <script>
        function openCommentBox(value) {

            $('.submitCancel').css('display','block')

            if(value.length>0){
                $('#commentSubmit').attr('disabled',false)
            }else {
                $('#commentSubmit').attr('disabled',true)
            }

            var commentText=value.replace('http://','')
             commentText=commentText.replace('https://www.','')
             commentText=commentText.replace('https://','')
             commentText=commentText.replace('http://www.','')
             commentText=commentText.replace('paibaa.com','https://www.paibaa.com')
            $('#comment').val(commentText)



            if(value.length>200){
                $('#commentSubmit').attr('disabled',true)
                $('.comment-error').text('Max 200 Character')
                $('.comment-error').css('display','block')
            }else {
                $('.comment-error').text('')
                $('.comment-error').css('display','none')
                $('#commentSubmit').attr('disabled',false)
            }

        }


        // hide submit button -----------------------
        $('.cancel').on('click',function () {
            $('.submitCancel').css('display','none')
        })


        //  ========  Submit comment  ========
        $('#commentForm').submit(function (e) {
            e.preventDefault()

            
                
            

            if($('#comment').val().length>0){
                $('#commentSubmit').attr('disabled',false)
                $('.comment-error').css('display','none')

                var route=$('#commentForm').data('route');
                //console.log($('#commentForm').serialize());

                $.ajax({
                    type: 'get',
                    url:"<?php echo e(URL::to('/ad-public-comment-save')); ?>",
                    data:$('#commentForm').serialize(),

                    success:function (data) {

                        console.log(data)

                        if (data=='success'){
                             console.log('321')
                            $('#comment').val('')
                            $('#commentSubmit').attr('disabled',true)
                            // comment load comments data ----------
                            loadData($('#adPostId').val())
                        }

                         if(data.adPostComment){
                            console.log('123')
                            $('.comment-error').css('display','block')
                            $('.comment-error').text('Only one Comment a day')
                        }
                    },
                    error:function (error) {
                        if(error.status==401){
                            var adPostId=$('#adPostId').val()
                            window.location.href='<?php echo e(URL::to('/ad-public-comment-save')); ?>'+'?ad_post_id='+adPostId
                        }
                    }
                })

            }else {
                $('#commentSubmit').attr('disabled',true)
                $('.comment-error').css('display','block')
                return false;
            }
        })

        function loadData(adPostId) {
            $('#commentData').empty().load('<?php echo e(URL::to("load-comments-data")); ?>'+'/'+adPostId)
        }


        $('#seeMoreComment').on('click',function () {
            loadData($('#adPostId').val())

            $('#seeMoreComment').hide();
        })

    </script>


    <script src="<?php echo e(asset('/frontend')); ?>/js/owlcarousel/owl.carousel.min.js"></script>


    <script>
        $(document).ready(function(){
            $(".owl-carousel").owlCarousel(
                {
                    stagePadding: 50,loop:true,margin:0,nav:true,
                    responsive:{
                        0:{ items:1 },
                        600:{ items:1},
                        1000:{items:1}
                    },
                    center:true,autoWidth:true, navText:["<i class=\"fa fa-angle-left\" aria-hidden=\"true\"></i>","<i class=\"fa fa-angle-right\" aria-hidden=\"true\"></i>"],
                    dots:false

                }
            );
        });
    </script>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\paibaApp\resources\views/frontend/ad/details.blade.php ENDPATH**/ ?>