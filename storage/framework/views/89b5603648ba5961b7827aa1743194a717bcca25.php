<?php $__env->startSection('title'); ?>
    <?php echo e($adDetails->title); ?> | paibaa | khujlei paibaa
<?php $__env->stopSection(); ?>

<?php $__env->startSection('style'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('/frontend')); ?>/css/owlcarousel/owl.carousel.min.css" />
    <link rel="stylesheet" href="<?php echo e(asset('/frontend')); ?>/css/owlcarousel/owl.theme.default.min.css" />
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <div class="iner_breadcrumb p-t-0 p-b-0">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo e(URL::to('/')); ?>">Home</a></li>
                    <li class="breadcrumb-item"><a href="<?php echo e(URL::to('ads/bangladesh/'.$adDetails->postCategory->link)); ?>"><?php echo e($adDetails->postCategory->category_name); ?></a></li>
                    <li class="breadcrumb-item active" aria-current="page">
                        <a href="<?php echo e(URL::to('ads/bangladesh/'.$adDetails->postCategory->link.'?subcategory='.$adDetails->adSubCategory->first()->id)); ?>"><?php echo e($adDetails->adSubCategory->first()->sub_category_name); ?>

                        </a>
                    </li>
                    <li class="breadcrumb-item " aria-current="page"><?php echo e($adDetails->title); ?></li>
                </ul>
            </nav>
        </div>
    </div>


    <section class="detail_part m-t-5">
        <div class="container">
            <div class="row">
                <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 col-12">
                    <div class="detail_box">
                        <div class="detail_head">
                            <p><a href="<?php echo e(URL::to('/profile/'.$adDetails->postAuthor->user_name)); ?>"> <?php echo e($adDetails->postAuthor->name); ?> </a>
                                
                            </p>

                        </div>

                    </div>
                    <div class="description_box">
                            <h4 class="m-b-15 text-danger"><?php echo e($adDetails->title); ?></h4>
                            <h6 class="m-b-10">
                                <span class="text-muted">Written By</span>
                                <a href="<?php echo e(URL::to('/profile/'.$adDetails->postAuthor->user_name)); ?>"><?php echo e($adDetails->postAuthor->name); ?>

                                </a>
                                <span class="text-muted"><i class="fa fa-clock-o them-color"></i> <?php echo e(date('M, d, Y h:i a',strtotime($adDetails->updated_at))); ?></span>
                            </h6>

                        <?php echo $adDetails->description;?>

                        <div class="detail_box owl-carousel owl-theme">
                            <?php if(file_exists('images/post_photo/big/'.$adDetails->postPhoto->photo_one)): ?>
                            <div>
                                <img class="img-fluid" src="<?php echo e(asset('images/post_photo/big/'.$adDetails->postPhoto->photo_one)); ?>" alt="<?php echo e($adDetails->title); ?>">
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
                        <hr>Tags:
                        <?php if(count($tags)>0): ?>

                            <?php $__currentLoopData = $tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <a href="<?php echo e(URL::to('/tag/'.str_replace(' ','-',$tag))); ?>">
                                    <span class="badge badge-secondary"><?php echo e($tag); ?></span>
                                </a>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                    </div>

                    <?php if(count($adDetails->blogAnswers)>0): ?>
                        <h5 class="p-t-10 p-b-10">Answer : <?php echo e(count($adDetails->blogAnswers)); ?></h5>

                        <div class="description_box">
                            <?php $__currentLoopData = $adDetails->blogAnswers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $blogAnswer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <span id="blogAns_<?php echo e($blogAnswer->id); ?>"> <?php echo $blogAnswer->answer;?> </span>
                                <h6 class="text-left">

                                    <?php if(Auth::check() && $blogAnswer->user_id==Auth::user()->id): ?>
                                    <?php echo Form::open(array('route' => ['blog-answer.destroy',$blogAnswer->id],'method'=>'DELETE','id'=>"deleteForm$blogAnswer->id")); ?>


                                <a href="<?php echo e(URL::to('blog-answer/'.$blogAnswer->id.'/edit'.'?ques='.$adDetails->id.'#editAns')); ?>" target="_blank" onclicks="blogAnswerEdit(<?php echo e($blogAnswer->id); ?>)" class="btn btn-warning btn-xs" title="Click here to edit your answer">  <i class="fa fa-pencil"></i> </a>



                                        <button type="button" class="btn btn-danger btn-xs " value="button" onclick='return deleteConfirm("deleteForm<?php echo e($blogAnswer->id); ?>")' title="Click here to delete your answer" style="cursor: pointer;">  <i class="fa fa-trash"></i>
                                        </button>

                                    <?php echo Form::close(); ?>

                                    <?php endif; ?>


                                    <a class="pull-right" href="<?php echo e(URL::to('profile/'.$blogAnswer->blogAnswerUser->user_name)); ?>" target="_blank"> <?php echo e($blogAnswer->blogAnswerUser->name); ?>

                                    </a>  </h6>
                                <hr>


                                <!-- ------------ans replay start --------- -->


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
                                        <?php echo Form::open(['url'=>'/blog-ans-replay-save','method'=>'POST','id'=>'commentFormReplay_'.$blogAnswer->id,'data-route'=>'blog-ans-replay']); ?>


                                        <input type="hidden" name="user_id" value="<?php echo e(Auth::check() && Auth::user()->id); ?>" id="replayUserId">
                                        <input type="hidden" name="ad_post_id" value="<?php echo e($adDetails->id); ?>" id="adPostId_<?php echo e($blogAnswer->id); ?>">
                                        <input type="hidden" name="answer_id" value="<?php echo e($blogAnswer->id); ?>" id="ansId_<?php echo e($blogAnswer->id); ?>">

                                        <textarea name="replay" id="commentReplay_<?php echo e($blogAnswer->id); ?>" <?php echo e($readonly); ?> onclick="openReplayBox(<?php echo e($blogAnswer->id); ?>,this.value)" onkeyup="openReplayBox(this.value)" rows="2" class="form-control replay-boxReplay" placeholder=" Replay " style="padding: 0px;
    border-radius: 50px;resize:none;"></textarea>
                                        <span class="text-danger replay-errorReplay" style="display: none"> This field is required !</span>

                                        <div class="submitCancelReplay pull-right m-t-5 " style="display: none">
                                            <span class="btn btn-default cancel">CANCEL</span> &nbsp;&nbsp;&nbsp;&nbsp;
                                            <button type="button" disabled class="btn btn-success" id="commentSubmitReplay_<?php echo e($blogAnswer->id); ?>" onclick="submitReplayForm(<?php echo e($blogAnswer->id); ?>)"> Replay </button>
                                        </div>

                                        <?php echo Form::close(); ?>

                                    </div>



                                    <div style="margin: auto" id="replayData_<?php echo e($blogAnswer->id); ?>">

                                        <button class="btn btn-info btn-sm m-t-10" onclick="viewReplayData(<?php echo e($blogAnswer->id); ?>)" id="viewReplay_<?php echo e($blogAnswer->id); ?>"> View Replay</button>

                                    </div>


                                </div>




                                <!-- ---------ans replay end-------------- -->


                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                <?php endif; ?>


                    <!-- post answer start -->

                    <hr>
                    <strong></strong>
                    <h5 class=" p-1"> Your answer </h5>
                    <?php echo Form::open(['route'=>['blog-answer.store'],'method'=>'POST','id'=>'answerForm','data-route'=>'ad-public-comment']); ?>


                    <input type="hidden" name="user_id" value="<?php echo e(Auth::check() && Auth::user()->id); ?>" id="userId">
                    <input type="hidden" name="ad_post_id" value="<?php echo e($adDetails->id); ?>" id="adPostId">

                    <textarea name="answer" class="form-control textarea type-pass" id="description" placeholder="Write few lines about this post" rows="7"></textarea>

                    <strong class="text-default pull-right description-error">
                        <span id="character_count" >0</span> /400
                    </strong>

                    <?php if($errors->has('answer')): ?>
                        <span class="help-block">
                            <strong class="text-danger"><?php echo e($errors->first('answer')); ?></strong>
                        </span>
                    <?php endif; ?>

                    <span id="descriptionError" class="text-danger"></span>

                    <div class="answerSubmitCancel m-t-5 " style="display: block">
                        
                        <button type="submit" class="btn btn-success" id="answerSubmit" onclick="return ValidateCharacterLength();"> Post your answer </button>
                    </div>

                    <?php echo Form::close(); ?>



                    <!-- post answer end -->


                </div><!-- end col-8 -->

                </div><!-- end row -->
        </div><!-- end container -->
    </section>



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
                    <!-- Description area -->
                    <hr>
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
            </div>
        </div>
    </section>
    <section class="top_listings">
        <div class="container">

            <!-- Row  -->
            <div class="row">
                <div class="col-md-3  m-b-10">
                    <h5 class=" badge-success p-1">You may like ...</h5>
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



    <script>

        function hideReplayData(ansId) {
            $('#ansReplay_'+ansId).css({"display":"none"})
            $('#hideReplay_'+ansId).css({"display":"none"})
            $('#viewReplay_'+ansId).css({"display":"block"})
        }

    </script>


    <script>
        // Blog ans replay --------------------------------
        function openReplayBox(id,value) {

            $('.submitCancelReplay').css('display','block')

            if(value.length>0){
                $('#commentSubmitReplay_'+id).attr('disabled',false)
            }else {
                $('#commentSubmitReplay_'+id).attr('disabled',true)
            }

            var commentTextReplay=value.replace('http://','')
            commentTextReplay=commentTextReplay.replace('https://www.','')
            commentTextReplay=commentTextReplay.replace('https://','')
            commentTextReplay=commentTextReplay.replace('http://www.','')
            commentTextReplay=commentTextReplay.replace('paibaa.com','https://www.paibaa.com')
            $('#commentReplay_'+id).val(commentTextReplay)



            if(value.length>100){
                $('#commentSubmitReplay_'+id).attr('disabled',true)
                $('.comment-errorReplay').text('Max 200 Character')
                $('.comment-errorReplay').css('display','block')
            }else {
                $('.comment-errorReplay').text('')
                $('.comment-errorReplay').css('display','none')
                $('#commentSubmitReplay_'+id).attr('disabled',false)
            }

        }


        // hide submit button -----------------------
        $('.cancel').on('click',function () {
            $('.submitCancelReplay').css('display','none')
        })


        //  ========  Submit comment  ========
        //$('#commentFormReplay').submit(function (e) {
        function submitReplayForm(ansId) {

            
                    
                    

            if($('#commentReplay_'+ansId).val().length>0){
                $('#commentSubmitReplay_'+ansId).attr('disabled',false)
                $('.comment-errorReplay').css('display','none')

                var route=$('#commentFormReplay_'+ansId).data('route');
                //console.log($('#commentForm').serialize());

                $.ajax({
                    type: 'get',
                    url:"<?php echo e(URL::to('/blog-ans-replay-save')); ?>",
                    data:$('#commentFormReplay_'+ansId).serialize(),

                    success:function (data) {

                        if (data=='success'){
                            $('#commentReplay_'+ansId).val('')
                            $('#commentSubmitReplay_'+ansId).attr('disabled',true)
                            // load replay data ----------
                            loadReplayData($('#ansId_'+ansId).val())
                        }

                        if(data.replayData){
                            $('.replay-errorReplay').css('display','block')
                            $('.replay-errorReplay').text('Only one Replay a day')
                        }
                    },
                    error:function (error) {
                        if(error.status==401){
                            var ansId=$('#ansId'+ansId).val()
                            window.location.href='<?php echo e(URL::to('/blog-ans-replay-save')); ?>'+'?ans_id='+ansId
                        }
                    }
                })

            }else {
                $('#commentSubmitReplay_'+ansId).attr('disabled',true)
                $('.replay-errorReplay'+ansId).css('display','block')
                return false;
            }
        }

        function loadReplayData(ansId) {
            $('#replayData_'+ansId).empty().load('<?php echo e(URL::to("load-blog-replay-data")); ?>'+'/'+ansId)
        }


        function viewReplayData(ansId) {
            console.log(ansId)
            $('#replayData_'+ansId).empty().load('<?php echo e(URL::to("load-blog-replay-data")); ?>'+'/'+ansId)
            //loadReplayData($('#ansId'+ansId).val())

            //$('#seeMoreCommentReplay_'+ansId).hide();
        }

    </script>






    <script>
        // ans edit ---------------------------
        function blogAnswerEdit(id) {
            $('#blogEditAnswerModal'+id).modal('show')

        } // end blogAnsEdit

        window.onload = function () {
            tinymce.init({
                selector: '.textareaEdit',
                menubar: false,
                theme: 'modern',
                plugins: 'image code link lists textcolor imagetools colorpicker ',
                browser_spellcheck: true,
                toolbar1: 'formatselect | bold italic strikethrough | link image | alignleft aligncenter alignright alignjustify  | numlist bullist outdent indent  | removeformat',
                // enable title field in the Image dialog
                image_title: true,
                setup: function (edit) {
                    edit.on('keyup', function (e) {
                        var countEdit = CountCharactersEdit();
                        document.getElementById("character_countEdit").innerHTML = "Characters: " + countEdit;
                    });
                }
            });
        }


        function CountCharactersEdit() {
            var body = tinymce.get("descriptionEdit").getBody();
            var content = tinymce.trim(body.innerText || body.textContent);
            return content.length;
        };


        function ValidateCharacterLengthEdit() {
            var max = 400;
            var count = CountCharactersEdit();
            if (count > max) {
                alert("Maximum " + max + " characters allowed.")
                return false;
            } else if (count <= 50) {
                alert("Minimum " + 50 + " characters required.")
                return false;
            } else {
                return;
            }
        }



        // create answer -------------


        window.onload = function () {
            tinymce.init({
                selector: '.textarea',
                menubar: false,
                theme: 'modern',
                plugins: 'image code link lists textcolor imagetools colorpicker ',
                browser_spellcheck: true,
                toolbar1: 'formatselect | bold italic strikethrough | link image | alignleft aligncenter alignright alignjustify  | numlist bullist outdent indent  | removeformat',
                // enable title field in the Image dialog
                image_title: true,
                setup: function (ed) {
                    ed.on('keyup', function (e) {
                        var count = CountCharacters();
                        document.getElementById("character_count").innerHTML = "Characters: " + count;
                    });
                }
            });
        }

        function CountCharacters() {
            var body = tinymce.get("description").getBody();
            var content = tinymce.trim(body.innerText || body.textContent);
            return content.length;
        };


        function ValidateCharacterLength() {
            var max = 400;
            var count = CountCharacters();
            if (count > max) {
                alert("Maximum " + max + " characters allowed.")
                return false;
            }else if(count<=50) {
                alert("Minimum " + 50 + " characters required.")
                return false;
            }else{

                return;
            }
        }




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

                        if (data=='success'){
                            $('#comment').val('')
                            $('#commentSubmit').attr('disabled',true)
                            // comment load comments data ----------
                            loadData($('#adPostId').val())
                        }

                         if(data.adPostComment){
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


    <script>
        function makeOffer() {
            $('#offerPrice').val($('#offer_price').val())

            $('#priceDealModal').modal('show')
        }
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
<?php echo $__env->make('frontend.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\paibaApp\resources\views/frontend/ad/blog-details.blade.php ENDPATH**/ ?>