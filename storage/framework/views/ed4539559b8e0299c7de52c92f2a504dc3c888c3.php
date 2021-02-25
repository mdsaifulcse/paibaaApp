<?php $__env->startSection('breadcrumb'); ?>
    <ol class="breadcrumb">
        <li><a href="<?php echo e(URL::to('home')); ?>"><i class="fa fa-home" aria-hidden="true"></i> Home</a></li>
        <li class="#">Edit Post Ad</li>
    </ol>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('style'); ?>
    <!-- for taging -->
    <link rel="stylesheet" href="<?php echo e(asset('/tagging/css/jqueryui1.12.1-ui.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('/tagging/css/jquery.tagit.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('/tagging/css/tagit.ui-zendesk.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div id="content" class="content">
        <div class="row">
            <div class="col-lg-12">
                <div class="box box-danger">
                    <div class="box-header bg-gray-active">
                        Edit Post Ad : <?php echo e($adData->title); ?>

                        <div class="box-btn pull-right">

                            <a href="<?php echo e(url()->previous()); ?>" class="btn btn-primary btn-sm pull-right"> <i class="fa fa-angle-double-left" aria-hidden="true"></i> Go Back </a>
                        </div>
                    </div>
                    <div class="box-body ">
                        <div class="row">
                            <div class="col-md-8 col-md-offset-2" style="background-color: #e1f7d8ab;border: 1px solid #E91E63">
                                <div class="profile_detail">

                                    <h3 class="text-center">Edit Ad Information Details </h3>
                                    <?php echo Form::open(['route'=>['manage-ad.update',$adData->id],'method'=>'PUT', 'class'=>'ad-post-form type-pass','data-toggle'=>'validator1','role'=>'form','novalidate'=>false, 'files'=>true]); ?>


                                    <input id="categoryId" type="hidden" name="category_id" value="<?php echo e($categoryInfo->id); ?>">

                                    <div class="row paddingTop15">
                                        <label class="col-md-2"> Location <sup class="text-danger">*</sup></label>

                                        <div class="col-md-10">
                                            <?php echo e(Form::text('location[]',$value=implode(',',$existLocation),['id'=>'locationField','style'=>'display:none','class'=>'form-control type-pass','placeholder'=>'Type your sub-category and press Enter','required'=>false])); ?>


                                            <ul id="locationFieldUl"></ul>
                                            <span class="locationError text-danger"> </span>
                                            <span class="taging-notes"> Type your location and press Enter. Max(5) </span>
                                            <hr>

                                            <?php if($errors->has('location')): ?>
                                                <span class="help-block"><strong class="text-danger"><?php echo e($errors->first('location')); ?></strong></span>
                                            <?php endif; ?>
                                        </div>
                                    </div>


                                    <?php if($categoryInfo->post_type==2): ?>
                                        <div class="row form-group">
                                            <label class="col-md-2"> Language <sup class="text-danger help-block with-errors">*</sup></label>

                                            <div class="col-md-10">
                                                <?php echo e(Form::text('lang',$value=old('lang',$adData->lang),['id'=>'title','class'=>' form-control type-pass','placeholder'=>'Your preferred language, (Ex: English, Bengali)',
                                                                                    'required'=>true])); ?>

                                                <?php if($errors->has('lang')): ?>
                                                    <span class="help-block">
                                                <strong class="text-danger"><?php echo e($errors->first('lang')); ?></strong>
                                                </span>
                                                <?php endif; ?>
                                            </div>
                                        </div>

                                    <?php endif; ?>


                                    <div class="row <?php echo e($errors->has('title') ? ' has-error' : ''); ?>">
                                        <label for="title" class="col-md-2 label-title">Title <sup class=" text-danger">*</sup> </label>

                                        <div class="col-md-10">
                                            <?php echo e(Form::text('title',$value=$adData->title,['id'=>'title','class'=>' form-control type-pass','placeholder'=>'Short title will be more useful to find your ad',
                                        'required'=>true,'data-error'=>':Please enter Ad title'])); ?>


                                            <?php if($errors->has('title')): ?>
                                                <span class="help-block">
                                            <strong class="text-danger"><?php echo e($errors->first('title')); ?></strong>
                                        </span>
                                            <?php endif; ?>
                                        </div>
                                    </div>

                                    <div class="row paddingTop15">
                                        <label class="col-md-2"> Category <sup class="text-danger">*</sup></label>

                                        <div class="col-md-10">
                                            <?php echo e(Form::text('sub_category_name[]',$value=implode(',',$existPostSubCats),['id'=>'subCategoryField','style'=>'display:none','class'=>'form-control type-pass','placeholder'=>'Type your category and press Enter','required'=>false])); ?>


                                            <ul id="subCategoryFieldUl"></ul>
                                            <span class="subCategoryError text-danger"> </span>
                                            <span class="taging-notes"> Type your category and press Enter. Max(5) </span>
                                            <hr>

                                            <?php if($errors->has('sub_category_name')): ?>
                                                <span class="help-block">
                                        <strong class="text-danger"><?php echo e($errors->first('sub_category_name')); ?></strong>
                                    </span>
                                            <?php endif; ?>
                                        </div>
                                    </div>


                                    <div class="row form-group <?php echo e($errors->has('photo_one') ? ' has-error' : ''); ?>  <?php echo e($errors->has('photo_two') ? ' has-error' : ''); ?>  <?php echo e($errors->has('photo_three') ? ' has-error' : ''); ?>  <?php echo e($errors->has('photo_four') ? ' has-error' : ''); ?> add-image">
                                        <label class="col-sm-2 label-title">Photo(s) </label>

                                        <div class="col-sm-10">
                                            <p style="font-size:14px;"><span>The first photo is your main photo. You must upload the first photo.</span></p>
                                            <div class="form-group ad-post-photo">

                                                <label class="slide_upload profile-image" for="photo1">
                                                    <img id="image_load1" src="<?php if(file_exists('images/post_photo/big/'.$adData->postPhoto->photo_one)): ?> <?php echo e(asset('images/post_photo/big/'.$adData->postPhoto->photo_one)); ?> <?php else: ?> <?php echo e(asset('/')); ?>images/default/photo.png <?php endif; ?>" title="First Photo" alt="Paibaa | Khojlei Paibaa | Shob Paibaa" style="max-width: 100px;border: 2px dashed #2783bb; cursor: pointer">
                                                    <input id="photo1" style="display:none" name="photo_one" class="type-pass" type="file" onchange="photoLoad(this,this.id)" accept="image/*">
                                                </label>

                                                <label class="slide_upload profile-image" for="photo2">
                                                    <img id="image_load2" src="<?php if($adData->postPhoto->photo_two!=''): ?> <?php echo e(asset('/images/post_photo/big/'.$adData->postPhoto->photo_two)); ?> <?php else: ?> <?php echo e(asset('/images/default/photo.png')); ?> <?php endif; ?>" title="Second Photo" alt="Paibaa | Khojlei Paibaa | Shob Paibaa" style="max-width: 100px;border: 2px dashed #2783bb; cursor: pointer">
                                                    <input id="photo2" style="display:none" name="photo_two" type="file" onchange="photoLoad(this,this.id)" accept="image/*">
                                                </label>

                                                <label class="slide_upload profile-image" for="photo3">
                                                    <img id="image_load3" src="<?php if($adData->postPhoto->photo_three!=''): ?> <?php echo e(asset('/images/post_photo/big/'.$adData->postPhoto->photo_three)); ?> <?php else: ?> <?php echo e(asset('/images/default/photo.png')); ?> <?php endif; ?>" title="Third Photo" alt="Paibaa | Khojlei Paibaa | Shob Paibaa" style="max-width: 100px;border: 2px dashed #2783bb; cursor: pointer">
                                                    <input id="photo3" style="display:none" name="photo_three" type="file" onchange="photoLoad(this,this.id)" accept="image/*">
                                                </label>

                                                <label class="slide_upload profile-image" for="photo4">
                                                    <img id="image_load4" src="<?php if($adData->postPhoto->photo_four!=''): ?> <?php echo e(asset('/images/post_photo/big/'.$adData->postPhoto->photo_four)); ?> <?php else: ?> <?php echo e(asset('/images/default/photo.png')); ?> <?php endif; ?>" title="Last Photo" alt="Paibaa | Khojlei Paibaa | Shob Paibaa" style="max-width: 100px;border: 2px dashed #2783bb; cursor: pointer">
                                                    <input id="photo4" style="display:none" name="photo_four" type="file" onchange="photoLoad(this,this.id)" accept="image/*">
                                                </label>
                                                <div id="errorPhoto" class="text-danger"> </div>
                                            </div>

                                            <?php if($errors->has('photo_one')): ?>  <span class="help-block"> <strong><?php echo e($errors->first('photo_one')); ?></strong> </span><br><?php endif; ?>
                                            <?php if($errors->has('photo_two')): ?><span class="help-block"><strong><?php echo e($errors->first('photo_two')); ?></strong> </span><br><?php endif; ?>
                                            <?php if($errors->has('photo_three')): ?><span class="help-block"><strong><?php echo e($errors->first('photo_three')); ?></strong> </span><br> <?php endif; ?>
                                            <?php if($errors->has('photo_four')): ?><span class="help-block"><strong><?php echo e($errors->first('photo_four')); ?></strong></span> <br><?php endif; ?>
                                            <br>
                                        </div> <!--end row-9-->
                                    </div>


                                    <div class="row form-group">
                                        <label class="col-md-2"><?php if($categoryInfo->post_type==2): ?> Write/Ask <?php else: ?> Description <?php endif; ?> <sup class="text-danger with-errors">*</sup></label>

                                        <div class="col-md-10">
                                            <textarea name="description" class="form-control textarea type-pass" id="description" placeholder="Write few lines about your ad" required rows="7"><?php echo $adData->description;?></textarea>

                                            <strong class="text-default pull-right description-error"><span id="character_count">0</span> /400 </strong>
                                            <?php if($errors->has('description')): ?>
                                            <span class="help-block">
                                                <strong class="text-danger"><?php echo e($errors->first('description')); ?></strong>
                                            </span>
                                            <?php endif; ?>
                                        </div>
                                        <span id="descriptionError" class="text-danger"></span>
                                    </div>


                                    <?php if($categoryInfo->post_type==1): ?>

                                        <div class="row form-group">
                                            <label class="col-md-2" title="Phone number">Phone <sup class="text-danger with-errors">*</sup></label>
                                            <div class="col-md-10">
                                                <?php echo e(Form::text('contact',$value=old('contact',$adData->contact),['class'=>'form-control type-pass','placeholder'=>'Phone number here','required'=>true])); ?>

                                                <?php if($errors->has('contact')): ?>
                                                    <span class="help-block">
                                            <strong class="text-danger"><?php echo e($errors->first('contact')); ?></strong>
                                        </span>
                                                <?php endif; ?>
                                            </div>
                                        </div>

                                        <div class="row form-group">
                                            <label class="col-md-2">Meetup</label>
                                            <div class="col-md-10">
                                                <?php echo e(Form::text('address',$value=$adData->address,['class'=>'form-control type-pass','placeholder'=>'Specific Address ','required'=>false])); ?>

                                                <?php if($errors->has('address')): ?>
                                                    <span class="help-block">
                                                        <strong class="text-danger"><?php echo e($errors->first('address')); ?></strong>
                                                    </span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    <?php endif; ?>

                                    <?php if($categoryInfo->post_type==1): ?> <!--hide when category is special=blog -->
                                    <div class="row form-group  <?php echo e($errors->has('price') ? ' has-error' : ''); ?> select-price">
                                        <label class="col-sm-2 label-title"><?php if($categoryInfo->category_name=='Need'): ?> Pay <?php else: ?> Price <?php endif; ?> <sup class="text-danger">*</sup></label>
                                        <div class="col-sm-10">
                                            <div class="field_wrapper">
                                                <?php if(count($adData->adPostPrice)>0): ?>
                                                <?php $priceCount=0;?>
                                                    <?php $__currentLoopData = $adData->adPostPrice; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$postPrice): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                                        <?php if($key==0): ?>
                                                            <div class="clearfix">

                                                                <?php echo e(Form::text('price_title[]',$value=$postPrice->price_title,['class'=>'form-control price-title','min'=>'0','max'=>999999,'step'=>'any','placeholder'=>'Title Ex: One day 1000 tk','required'=>true])); ?>

                                                                <?php echo e(Form::number('price[]',$value=$postPrice->price,['class'=>'form-control price-amount','min'=>'0','max'=>999999,'step'=>'any','placeholder'=>'tk','required'=>true])); ?>


                                                                <a href="javascript:void(0);" class="add_button" title="Add More Price"><img src="<?php echo e(asset('images/default/add-icon.png')); ?>">
                                                                </a>
                                                            </div>

                                                        <?php else: ?>
                                                            <div class="clearfix">

                                                                <?php echo e(Form::text('price_title[]',$value=$postPrice->price_title,['class'=>'form-control price-title','min'=>'0','max'=>999999,'step'=>'any','placeholder'=>'Title Ex: One day 1000 tk','required'=>true])); ?>

                                                                <?php echo e(Form::number('price[]',$value=$postPrice->price,['class'=>'form-control price-amount','min'=>'0','max'=>999999,'step'=>'any','placeholder'=>'tk','required'=>true])); ?>


                                                                <a href="javascript:void(0);" class="remove_button" title="Remove Price"><img src="<?php echo e(asset('images/default/remove-icon.png')); ?>">
                                                                </a>
                                                            </div>

                                                        <?php endif; ?>
                                                        <?php $priceCount+=1?>

                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        <span class="priceRow" style="display:none;"><?php echo e($priceCount); ?></span>

                                                <?php endif; ?>

                                            </div>


                                            <div class="text-danger help-block with-errors"></div>
                                            <?php if($errors->has('price')): ?>
                                                <span class="help-block">
                                                <strong><?php echo e($errors->first('price')); ?></strong>
                                            </span>
                                            <?php endif; ?>
                                        </div>


                                    </div><!-- end row form-group -->
                                    <?php endif; ?>


                                    <?php if($categoryInfo->post_type==1): ?> <!--hide when category is special=blog -->
                                    <div class="row form-group  <?php echo e($errors->has('price') ? ' has-error' : ''); ?> select-price" style="display: flex" id="packageOffer">
                                        <label class="col-md-2 col-sm-2 label-title">Deliverable</label>

                                        <div class="col-md-3">
                                            <label for="deliverable" style="width: auto;background-color: #e8f6e2;color: #000000">
                                                <?php if($adData->deliverable==1): ?>
                                                    <input name="deliverable" type="checkbox" checked class="" id="deliverable">Yes Deliverable
                                                <?php else: ?>
                                                    <input name="deliverable" type="checkbox" class=""  id="deliverable">Yes Deliverable
                                                <?php endif; ?>
                                            </label>
                                        </div>

                                        <?php if($adData->deliverable==1 && $adData->deliverable!=''): ?>

                                            <label class="col-md-3 col-sm-2 delivery-fee" style="display:block">&nbsp; &nbsp; Delivery Charge</label>
                                            <div class="col-md-4 col-sm-10">
                                                <?php echo e(Form::number('delivery_fee',$value=$adData->delivery_fee,['style'=>'display:block','class'=>'form-control delivery-fee-amount','min'=>'0','placeholder'=>'Change amount','required'=>false])); ?>


                                                <div class="text-danger help-block with-errors"></div>
                                                <?php if($errors->has('delivery_fee')): ?>
                                                    <span class="help-block">
                                                <strong class="text-danger"><?php echo e($errors->first('delivery_fee')); ?></strong>
                                            </span>
                                                <?php endif; ?>
                                            </div>

                                        <?php else: ?>
                                            <label class="col-md-3 col-sm-2 delivery-fee" style="display:none">&nbsp; &nbsp; Delivery Charge</label>
                                            <div class="col-md-4 col-sm-10">
                                                <?php echo e(Form::number('delivery_fee',$value=$adData->delivery_fee,['style'=>'display:none','class'=>'form-control delivery-fee-amount','min'=>'0','placeholder'=>'Change amount','required'=>false])); ?>


                                                <div class="text-danger help-block with-errors"></div>
                                                <?php if($errors->has('delivery_fee')): ?>
                                                    <span class="help-block">
                                                <strong class="text-danger"><?php echo e($errors->first('delivery_fee')); ?></strong>
                                            </span>
                                                <?php endif; ?>
                                            </div>

                                        <?php endif; ?>


                                    </div> <!--end row-->


                                    <?php endif; ?>

                                    <div class="row paddingTop15">
                                        <label class="col-md-2"> Tags </label>

                                        <div class="col-md-10">
                                            <?php echo e(Form::text('tag[]',$value=$adData->tag,['id'=>'tagField','style'=>'display:none','class'=>'form-control type-pass','placeholder'=>'Type your tag and press Enter Or Tag Name Separate by comma (,)','required'=>false])); ?>


                                            <ul id="tagFieldUl"></ul>
                                            <span class="taging-notes"> Type your tags and press Enter. Max(5) </span>

                                            <?php if($errors->has('tag')): ?>
                                                <span class="help-block">
                                    <strong class="text-danger"><?php echo e($errors->first('tag')); ?></strong>
                                </span>
                                            <?php endif; ?>
                                        </div>
                                    </div>



                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-6 selectdiv">
                                                <label>Status <sup class="text-danger with-errors">*</sup></label>
                                                <?php echo e(Form::select('status',['1'=>'Active','0'=>'Inactive'],$adData->status,['data-error'=>':','class'=>'form-control','placeholder'=>'Select Status','required'=>true])); ?>

                                            </div>
                                            <div class="col-md-6 ">
                                                <label>Published Status <sup class="text-danger with-errors">*</sup></label>
                                                <?php echo e(Form::select('is_approved',['1'=>'Publish','2'=>'Pending'],$adData->is_approved,['data-error'=>':','class'=>'form-control','placeholder'=>'Select Publish Status','required'=>true])); ?>

                                            </div>
                                        </div>
                                    </div>


                                    <button class="update_btn mt-2 text-capitalize btn btn-warning" type="submit" value="button" id="postSubmit" onclick="return ValidateCharacterLength();">Update Ad</button>

                                    <br>
                                    <hr>
                                    <h4>Author Info</h4>
                                    <h5>Name: <?php echo e($adData->postAuthor->name); ?>, Mobile: <?php echo e($adData->postAuthor->mobile); ?></h5>
                                    <?php echo e($errors); ?>



                                    <?php echo Form::close(); ?>


                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>


<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>



    <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
    <script src="<?php echo e(asset('/tagging/js/jquery-1.12.1-ui.min.js')); ?>"></script>
    <script src="<?php echo e(asset('/tagging/js/tag-it.min.js')); ?>"></script>

    <script type="text/javascript">
        $('#postSubmit').click(function(){
            if($('#subCategoryFieldUl li').length<2){
                $('#errorPhoto').html('');

                $('.subCategoryError').html('Sub-Category is required.');

                return false
            }else if($('#locationFieldUl li').length<2){
                $('#errorPhoto').html('');
                $('.subCategoryError').html('');
                return ValidateCharacterLength();return ValidateCharacterLength();
                $('.locationError').html('Location is required.');

                return false
            }else{
                $('#errorPhoto').html('');
                $('.subCategoryError').html('');
                $('.locationError').html('');
                return true;
            }

        });

    </script>

    <!-- Sub-category line -->
    <script>
        $(function(){
            //-------------------------------
            // Input field
            //-------------------------------
            var categoryId=$('#categoryId').val();
            $('#subCategoryFieldUl').tagit({
                // This will make Tag-it submit a single form value, as a comma-delimited field.
                singleField: true,
                singleFieldNode: $('#subCategoryField'),
                allowSpaces: true,
                tagLimit:3,
                fieldName:"sub_category_name",
                placeholderText:'Search Or type your sub-category',
                //autocomplete: {source:country_list},
                autocomplete: {
                    source: function( request, response ) {
                        $.ajax({
                            url: "<?php echo e(URL::to('/sub-category-by-category?category_id=')); ?>"+categoryId,
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



<!-- location taging -->
    <script>
        $(function(){
            $('#locationFieldUl').tagit({
                // This will make Tag-it submit a single form value, as a comma-delimited field.
                singleField: true,
                singleFieldNode: $('#locationField'),
                allowSpaces: true,
                fieldName:"location",
                tagLimit:5,
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

    <!-- Tag line -->
    <script>

        $(function(){
            var country_list = ["Bangladesh","Barma","Bronai","Afghanistan"];
            //-------------------------------
            // Input field
            //-------------------------------
            $('#tagFieldUl').tagit({
                //availableTags: ["Afghanistan","Bantladesh"],
                // This will make Tag-it submit a single form value, as a comma-delimited field.
                singleField: true,
                singleFieldNode: $('#tagField'),
                allowSpaces: true,
                tagLimit:5,
                placeholderText:'Search Or type your tags',
                //autocomplete: {source:country_list},
                
                
                
                
                
                
                
                
                
                
                
                
                

                

            });
        });
    </script>


    <script>
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
            }else if(count<=10) {
                alert("Minimum " + 50 + " characters required.")
                return false;
            }else{

                return;
            }
        }
    </script>


    <!-- Add / Remove Code -->
    <script type="text/javascript">
        $(document).ready(function(){

            var maxField = 3; //Input fields increment limitation
            var addButton = $('.add_button'); //Add button selector
            var wrapper = $('.field_wrapper'); //Input field wrapper
            //var fieldHTML = '<div><input type="text" name="field_name[]" value=""/><a href="javascript:void(0);" class="remove_button"><img src="<?php echo e(asset('images/default/remove-icon.png')); ?>"/></a></div>'; //New input field html
            var fieldHTML = '<div class="clearfix">\n' +
                '\n' +
                '<input class="form-control price-title" min="0" max="99999999" step="any" placeholder="Title Ex: One day 1000 tk" required="" name="price_title[]" type="text">\n' +
                '<input class="form-control price-amount" min="0" max="99999999" step="any" placeholder="tk" required="" name="price[]" type="number">\n' +
                '\n' +
                '\n' +
                '<a href="javascript:void(0);" class="remove_button" title="Delete"><img src="<?php echo e(asset('images/default/remove-icon.png')); ?>">\n' +
                '</a>\n' +
                '</div>'; //New input field html
            var x=$('.priceRow').text(); //Initial field counter is 1

            //Once add button is clicked
            $(addButton).click(function(){
                console.log($('.priceRow').text())

                //Check maximum number of input fields
                if(x < maxField){
                    x++; //Increment field counter
                    $(wrapper).append(fieldHTML); //Add field html
                }
            });

            //Once remove button is clicked
            $(wrapper).on('click', '.remove_button', function(e){
                e.preventDefault();
                $(this).parent('div').remove(); //Remove field html
                x--; //Decrement field counter
            });
        });
    </script>

    <script>
        $("#deliverable").change(function() {
            if($(this).prop('checked')) {
                $('.delivery-fee').css('display','flex')
                $('.delivery-fee-amount').css('display','flex')
                $('.delivery-fee-amount').attr('required',true)
            } else {
                $('.delivery-fee').css('display','none')
                $('.delivery-fee-amount').css('display','none')
                $('.delivery-fee-amount').attr('required',false)
                $('.delivery-fee-amount').val('')
            }
        });

    </script>


    <script>
        $('.type-pass1').on('keypress click change',function() {
            $('#postSubmit').attr('type','submit')
            $('#postSubmit').html('Post Your Ad s')
        });
    </script>

    <script type="text/javascript">

        function loadArea(id){
            $('#loadArea').load('<?php echo e(URL::to("load-area-by-division-town")); ?>/'+id);
        }
    </script>

    <script>

        $('#agree_with').on('click',function () {
            if($(this).prop('checked')==true){
                $('#postSubmit').attr('type','submit')
            }else{
                $('#postSubmit').attr('type','button')
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
        function photoLoad(input,image_load) {
            var target_image='#'+$('#'+image_load).prev().attr('id');

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
<?php echo $__env->make('backend.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\paibaApp\resources\views/backend/ad/edit.blade.php ENDPATH**/ ?>