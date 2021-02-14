@extends('frontend.master')

@section('title') Post Your Ad | Paibaa | Khojlei Paibaa | Shob Paibaa  @endsection

<style>
    .select2-container{
        background-color: #fbfbfb;
        padding: 0px;
        display: contents;
    }
</style>

@section('style')
<!-- for taging -->
<link rel="stylesheet" href="{{asset('/tagging/css/jqueryui1.12.1-ui.css')}}">
<link rel="stylesheet" href="{{asset('/tagging/css/jquery.tagit.css')}}">
<link rel="stylesheet" href="{{asset('/tagging/css/tagit.ui-zendesk.css')}}">
@endsection


@section('content')


    <!-- breadcrumb -->
    <div class="iner_breadcrumb bg-light p-t-10 p-b-10">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{URL::to('/')}}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{$categoryInfo->category_name}}</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- End breadcrumb -->


    <section class="dashboard_sec m-t-0">
        <div class="container ad-post my-account-bg">
            <div class="row">
                {{--<div class="col-md-2">--}}
                    {{--@include('frontend.my-account.sidebar')--}}
                {{--</div>--}}
                <div class="col-md-12" style="background-color: #f7f7f7">
                    <div class="dashboard_profile_main">
                        <div class="dashboard_profile d-flex justify-content-between">
                            <div class="profile_setting text-capitalize">
                                <h3 class="text-primary"><i class="fa fa-list"></i> {{$categoryInfo->category_name}}
                                   &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <a href="{{URL::to('/ad-post')}}"><i class="fa fa-pencil"></i> Edit</a>
                                </h3>
                            </div>
                            <div class="title_edit text-capitalize"></div>
                        </div>

                    </div>


                    <div class="row">
                        <div class="col-md-9  m-t-10 margin_top" style="background-color: #e1f7d8ab">
                            <div class="profile_detail">
                                <h3>Your Ad Details</h3>
                                {!! Form::open(['route'=>'ad-post.store','method'=>'POST', 'class'=>'ad-post-form type-pass','data-toggle'=>'validator1','role'=>'form','novalidate'=>false, 'files'=>true]) !!}

                                <input id="categoryId" type="hidden" name="category_id" value="{{$categoryInfo->id}}">

                                <div class="row form-group paddingTop15">
                                    <label class="col-md-2"> Location <sup class="text-danger help-block with-errors">*</sup></label>

                                    <div class="col-md-10">
                                        {{Form::text('location[]',$value=old('location'),['id'=>'locationField','style'=>'display:none','class'=>'form-control type-pass','placeholder'=>'Type your category and press Enter','required'=>false])}}

                                        <ul id="locationFieldUl"></ul>
                                        <span class="locationError text-danger"> </span>
                                        <span class="taging-notes"> Type your location and press Enter. Max(5) </span>

                                        @if ($errors->has('location'))
                                            <span class="help-block">
                                        <strong class="text-danger">{{ $errors->first('location') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                                @if($categoryInfo->post_type==2)
                                <div class="row form-group">
                                    <label class="col-md-2"> Language <sup class="text-danger help-block with-errors">*</sup></label>

                                    <div class="col-md-10">
                                        {{Form::text('lang',$value=old('lang'),['id'=>'title','class'=>' form-control type-pass','placeholder'=>'Your preferred language, (Ex: English, Bengali)',
                                    'required'=>true])}}

                                        @if ($errors->has('lang'))
                                            <span class="help-block">
                                            <strong class="text-danger">{{ $errors->first('lang') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                @endif



                                <div class="row  {{ $errors->has('title') ? ' has-error' : '' }}">
                                    <label for="title" class="col-md-2">Title <sup class=" text-danger help-block with-errors">*</sup> </label>

                                    <div class="col-md-10">
                                        {{Form::text('title',$value=old('title'),['id'=>'title','class'=>' form-control type-pass','placeholder'=>'Short title will be more useful to find your ad',
                                    'required'=>true,'data-error'=>':Please enter Ad title'])}}
                                        @if ($errors->has('title'))
                                            <span class="help-block">
                                            <strong class="text-danger">{{ $errors->first('title') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="row paddingTop15">
                                    <label class="col-md-2"> Category <sup class="text-danger help-block with-errors">*</sup></label>

                                    <div class="col-md-10">
                                        {{Form::text('sub_category_name[]',$value=old('sub_category_name'),['id'=>'subCategoryField','style'=>'display:none','class'=>'form-control type-pass','placeholder'=>'Type your category and press Enter','required'=>false])}}

                                        <ul id="subCategoryFieldUl"></ul>
                                        <span class="subCategoryError text-danger"> </span>
                                        <span class="taging-notes"> Type your category and press enter. Max(5) </span>

                                        @if ($errors->has('sub_category_name'))
                                            <span class="help-block">
                                        <strong class="text-danger">{{ $errors->first('sub_category_name') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>


                                <div class="row form-group {{ $errors->has('photo_one') ? ' has-error' : '' }}  {{ $errors->has('photo_two') ? ' has-error' : '' }}  {{ $errors->has('photo_three') ? ' has-error' : '' }}  {{ $errors->has('photo_four') ? ' has-error' : '' }} add-image">
                                    <label class="col-sm-2 label-title">Photo(s) </label>

                                    <div class="col-sm-10">
                                        <p style="font-size:14px;"><span>The first photo is your main photo.</span></p>
                                        <div class="form-group ad-post-photo">

                                            <label class="slide_upload profile-image" for="photo1">
                                                <img id="image_load1" src="{{asset('/')}}images/default/photo.png" title="First Photo" alt="Paibaa | Khojlei Paibaa | Shob Paibaa" style="max-width: 100px;border: 2px dashed #2783bb; cursor: pointer">
                                                <input id="photo1" style="display:none" name="photo_one" class="type-pass" type="file" onchange="photoLoad(this,this.id)" accept="image/*">
                                            </label>

                                            <label class="slide_upload profile-image" for="photo2">
                                                <img id="image_load2" src="{{asset('/')}}images/default/photo.png" title="Second Photo" alt="Paibaa | Khojlei Paibaa | Shob Paibaa" style="max-width: 100px;border: 2px dashed #2783bb; cursor: pointer">
                                                <input id="photo2" style="display:none" name="photo_two" type="file" onchange="photoLoad(this,this.id)" accept="image/*">
                                            </label>

                                            <label class="slide_upload profile-image" for="photo3">
                                                <img id="image_load3" src="{{asset('/')}}images/default/photo.png" title="Third Photo" alt="Paibaa | Khojlei Paibaa | Shob Paibaa" style="max-width: 100px;border: 2px dashed #2783bb; cursor: pointer">
                                                <input id="photo3" style="display:none" name="photo_three" type="file" onchange="photoLoad(this,this.id)" accept="image/*">
                                            </label>

                                            <label class="slide_upload profile-image" for="photo4">
                                                <img id="image_load4" src="{{asset('/')}}images/default/photo.png" title="Last Photo" alt="Paibaa | Khojlei Paibaa | Shob Paibaa" style="max-width: 100px;border: 2px dashed #2783bb; cursor: pointer">
                                                <input id="photo4" style="display:none" name="photo_four" type="file" onchange="photoLoad(this,this.id)" accept="image/*">
                                            </label>
                                            <div id="errorPhoto" class="text-danger"> </div>
                                        </div>

                                        @if ($errors->has('photo_one'))  <span class="help-block"> <strong>{{ $errors->first('photo_one') }}</strong> </span><br>@endif
                                        @if ($errors->has('photo_two'))<span class="help-block"><strong>{{ $errors->first('photo_two') }}</strong> </span><br>@endif
                                        @if ($errors->has('photo_three'))<span class="help-block"><strong>{{ $errors->first('photo_three') }}</strong> </span><br> @endif
                                        @if ($errors->has('photo_four'))<span class="help-block"><strong>{{ $errors->first('photo_four') }}</strong></span> <br>@endif
                                        <br>

                                    </div> <!--end row-9-->
                                </div>


                                <div class="row form-group">
                                    <label class="col-md-2">@if($categoryInfo->post_type==2) Write/Ask @else Description @endif <sup class="text-danger help-block with-errors">*</sup></label>

                                    <div class="col-md-10">
                                        {{Form::textArea('description','',['rows'=>'7','class'=>'form-control textarea type-pass','data-error'=>'Ad description is required','id'=>'description','placeholder'=>'Write few lines about your ad','required'=>false])}}
                                        <strong class="text-default pull-right description-error"><span id="character_count">0</span> /400 </strong>
                                        @if ($errors->has('description'))
                                            <span class="help-block">
                                            <strong class="text-danger">{{ $errors->first('description') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                    <span id="descriptionError" class="text-danger"></span>
                                </div>


                                @if($categoryInfo->post_type==1)
                                <div class="row form-group">
                                    <label class="col-md-2" title="Phone number">Phone <sup class="text-danger help-block with-errors">*</sup></label>
                                    <div class="col-md-10">
                                        {{Form::text('contact',$value=old('contact'),['class'=>'form-control type-pass','placeholder'=>'Phone number here','required'=>true])}}
                                        @if ($errors->has('contact'))
                                            <span class="help-block">
                                        <strong class="text-danger">{{ $errors->first('contact') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>


                                <div class="row form-group">
                                    <label class="col-md-2">Meetup</label>
                                    <div class="col-md-10">
                                        {{Form::text('address',$value=old('address'),['data-error'=>':Specific Address is Required','class'=>'form-control type-pass','placeholder'=>'Specific Address ','required'=>false])}}
                                        @if ($errors->has('address'))
                                            <span class="help-block">
                                            <strong class="text-danger">{{ $errors->first('address') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>

                                @endif

                                @if($categoryInfo->post_type==1) <!--hide when category is special=blog -->
                                <div class="row form-group  {{ $errors->has('price') ? ' has-error' : '' }} select-price">
                                    <label class="col-sm-2 label-title">@if($categoryInfo->category_name=='Need') Pay @else Price @endif <sup class="text-danger">*</sup></label>
                                    <div class="col-sm-10">
                                        <div class="field_wrapper">
                                            <div class="clearfix">

                                                {{Form::text('price_title[]',$value=old('price_title'),['class'=>'form-control price-title','min'=>'0','max'=>999999,'step'=>'any','placeholder'=>'Title Ex: One day 1000 tk','required'=>true])}}
                                                {{Form::number('price[]',$value=old('price'),['class'=>'form-control price-amount','min'=>'0','max'=>999999,'step'=>'any','placeholder'=>'tk','required'=>true])}}


                                                <a href="javascript:void(0);" class="add_button" title="Add More Price"><img src="{{asset('images/default/add-icon.png')}}">
                                                </a>
                                            </div>
                                        </div>


                                        <div class="text-danger help-block with-errors"></div>
                                        @if ($errors->has('price'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('price') }}</strong>
                                            </span>
                                        @endif
                                    </div>


                                </div><!-- end row form-group -->
                            @endif


                                @if($categoryInfo->post_type==1) <!--hide when category is special=blog -->
                                <div class="row form-group  {{ $errors->has('price') ? ' has-error' : '' }} select-price" style="display: flex" id="packageOffer">
                                    <label class="col-md-2 col-sm-2 label-title">Deliverable</label>

                                    <div class="col-md-3">
                                        <label for="deliverable" style="width: auto;background-color: #e8f6e2;color: #000000">
                                            <input name="deliverable" type="checkbox" class="" id="deliverable">Yes Deliverable
                                        </label>
                                    </div>

                                    <label class="col-md-3 col-sm-2 delivery-fee" style="display: none">&nbsp; &nbsp; Delivery Charge</label>
                                    <div class="col-md-4 col-sm-10">
                                        {{Form::number('delivery_fee',$value=old('delivery_fee'),['style'=>'display: none','class'=>'form-control delivery-fee-amount','min'=>'0','placeholder'=>'Change amount','required'=>false])}}

                                        <div class="text-danger help-block with-errors"></div>
                                        @if ($errors->has('delivery_fee'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('delivery_fee') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                @endif

                                <div class="row paddingTop15">
                                <label class="col-md-2"> Tags </label>

                                <div class="col-md-10">
                                {{Form::text('tag[]',$value=old('tag'),['id'=>'tagField','style'=>'display:none','class'=>'form-control type-pass','placeholder'=>'Type your tag and press Enter Or Tag Name Separate by comma (,)','required'=>false])}}

                                    <ul id="tagFieldUl"></ul>
                                    <span class="taging-notes"> Type your tags and press Enter. Max(5) </span>

                                @if ($errors->has('tag'))
                                    <span class="help-block">
                                    <strong class="text-danger">{{ $errors->first('tag') }}</strong>
                                </span>
                                @endif
                                </div>
                            </div>

                                <div class="row col-md-12 ad-type-label">
                                    <span class="col-md-2"></span>
                                    <label class="col-md-" for="agree_with" style="width: auto;background-color: #e8f6e2;color: #000000">
                                        <input type="checkbox" name="agree_with" data-error="Must be agree with Terms of Use & Privacy Policy", id="agree_with" required> I agree with <a href="{{URL::to('page/using-rules')}}" target="_blank">Terms of Use</a> and <a href="{{URL::to('page/using-rules')}}" target="_blank">Privacy Policy.</a>
                                    </label>
                                    <div class="text-danger help-block with-errors"></div>
                                </div>

                                <div class="row">
                                    <span class="col-md-2"></span>
                                    <button class="col-md-4 update_btn mt-2 text-capitalize" type="submit" value="button" id="postSubmit"
                                     
                                    ">Post Your Ad</button>

                                    <span>{{$errors}}</span>
                                </div>
                                {!! Form::close() !!}
                            </div>
                        </div>

                        <!-- quick-rules -->
                        <div class="col-md-3 m-t-50 quick-rules">
                            <div class="section ">
                                <h5>Quick rules</h5>
                                <p class="lead">Posting an ad on <a href="http://www.paibaa.com" target="_blank">Paibaa</a> is free! However, all ads must follow our rules:</p>

                                <ul>
                                    <li><i class="fa fa-angle-double-right"></i> Make sure you post in the correct category.</li>
                                    <li><i class="fa fa-angle-double-right"></i> Do not post the same ad more than once or repost an ad within 48 hours.</li>
                                    <li><i class="fa fa-angle-double-right"></i> Do not upload pictures with watermarks.</li>
                                    <li><i class="fa fa-angle-double-right"></i> Do not post ads containing multiple items unless it's a package deal.</li>
                                    <li><i class="fa fa-angle-double-right"></i> Do not put your email or phone numbers in the title or description.</li>

                                </ul>
                            </div>
                        </div><!-- quick-rules -->


                    </div> <!--end row-->

                    <div class="single-sidebar m-t-50 m-b-50">
                        <img class="add_img img-fluid" src="{{asset('/frontend')}}/images/discount-img.png" alt="Paibaa">
                    </div>
                </div>
            </div>
        </div>
    </section>


@endsection

@section('script')
    {{--<script src="https://cdnjs.cloudflare.com/ajax/libs/1000hz-bootstrap-validator/0.11.9/validator.min.js"></script>--}}
    <!-- for taging -->
    <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
    <script src="{{asset('/tagging/js/jquery-1.12.1-ui.min.js')}}"></script>
    <script src="{{asset('/tagging/js/tag-it.min.js')}}"></script>

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


    <!-- Add / Remove Code -->
    <script type="text/javascript">
        $(document).ready(function(){
            var maxField = 3; //Input fields increment limitation
            var addButton = $('.add_button'); //Add button selector
            var wrapper = $('.field_wrapper'); //Input field wrapper
            //var fieldHTML = '<div><input type="text" name="field_name[]" value=""/><a href="javascript:void(0);" class="remove_button"><img src="{{asset('images/default/remove-icon.png')}}"/></a></div>'; //New input field html
            var fieldHTML = '<div class="clearfix">\n' +
                '\n' +
                '<input class="form-control price-title" min="0" max="999999" step="any" placeholder="Title Ex: One day 1000 tk" required="" name="price_title[]" type="text">\n' +
                '<input class="form-control price-amount" min="0" max="999999" step="any" placeholder="tk" required="" name="price[]" type="number">\n' +
                '\n' +
                '\n' +
                '<a href="javascript:void(0);" class="remove_button" title="Delete"><img src="{{asset('images/default/remove-icon.png')}}">\n' +
                '</a>\n' +
                '</div>'; //New input field html
            var x = 1; //Initial field counter is 1

            //Once add button is clicked
            $(addButton).click(function(){
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
                            url: "{{URL::to('/get-ad-location')}}",
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
                placeholderText:'Search Or type your category',
                //autocomplete: {source:country_list},
                autocomplete: {
                    source: function( request, response ) {
                        $.ajax({
                            url: "{{URL::to('/sub-category-by-category?category_id=')}}"+categoryId,
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
               {{--autocomplete: {--}}
                   {{--source: function( request, response ) {--}}
                       {{--$.ajax({--}}
                           {{--url: "{{URL::to('/return-ajax-data')}}",--}}
                           {{--dataType: "json",--}}
                           {{--data: {--}}
                               {{--q: request.term--}}
                           {{--},--}}
                           {{--success: function( data ) {--}}
                               {{--response( data );--}}
                           {{--}--}}
                       {{--});--}}
                   {{--},--}}

               {{--},--}}

           });
       });



   </script>


    <script>
        $('.type-pass').on('keypress click change',function() {
            $('#postSubmit').attr('type','submit')
            $('#postSubmit').html('Post Your Ad')
        });
    </script>

    <script type="text/javascript">
        $('#postSubmit').click(function(){
            if($('#photo1').val()==''){
                $('#errorPhoto').html('<span class="text-danger">You must upload the first photo.</span>');
                return false
            }else if($('#subCategoryFieldUl li').length<2){
                $('#errorPhoto').html('');

                $('.subCategoryError').html('Category is required.');

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


@endsection
