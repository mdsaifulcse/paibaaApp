@extends('frontend.master')

@section('title') Post Your Ad | Paibaa | Khojlei Paibaa | Shob Paibaa  @endsection
@section('style')
@endsection


@section('content')

    <!-- breadcrumb -->
    <div class="iner_breadcrumb bg-light p-t-10 p-b-10">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{URL::to('/')}}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit Ad Information </li>
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
                                <h3 class="text-warning "><i class="fa fa-list"></i> {{$subCategoryInfo->category_name}} <i class="fa fa-angle-double-right"></i>
                                    {{$subCategoryInfo->sub_category_name}} <i class="fa fa-angle-double-right"></i> {{$adData->title}} </h3>
                            </div>
                            <div class="title_edit text-capitalize">
                                {{--<a href="{{URL::to('/ad-post')}}"><i class="fa fa-pencil"></i> Edit</a>--}}
                            </div>
                        </div>

                    </div>



                    <div class="row">
                        <div class="col-md-9  m-t-10 margin_top" style="background-color: #f1c8d345">
                            <div class="profile_detail">
                                <h3>Edit Ad Information Details </h3>
                                {!! Form::open(['route'=>['ad-post.update',$adData->id],'method'=>'PUT', 'class'=>'ad-post-form type-pass','data-toggle'=>'validator1','role'=>'form','novalidate'=>false, 'files'=>true]) !!}
                                <input type="hidden" name="sub_category_id" value="{{$subCategoryInfo->id}}" />

                                <div class="row form-group {{ $errors->has('title') ? ' has-error' : '' }}">
                                    <label for="title" class="col-md-2">Title <sup class="text-danger help-block with-errors">*</sup> </label>
                                    <div class="col-md-10">
                                        {{Form::text('title',$value=$adData->title,['id'=>'title','class'=>'form-control type-pass','placeholder'=>'Short title will be more useful to find your ad',
                                    'required'=>true,'data-error'=>':Please enter Ad title'])}}
                                        @if ($errors->has('title'))
                                            <span class="help-block">
                                            <strong class="text-danger">{{ $errors->first('title') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>


                                <div class="row form-group">
                                    <label class="col-md-2">Description <sup class="text-danger help-block with-errors">*</sup></label>

                                    <div class="col-md-10">
                                        {{Form::textArea('description',$adData->description,['data-error'=>'Ad description is required','id'=>'description','rows'=>'7','class'=>'form-control type-pass','placeholder'=>'Write few lines about your ad','required'=>false])}}
                                        <strong class="text-default pull-right description-error"> 0/400 </strong>
                                        @if ($errors->has('description'))
                                            <span class="help-block">
                                            <strong class="text-danger">{{ $errors->first('description') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                    <span id="descriptionError" class="text-danger"></span>
                                </div>


                                <div class="row form-group {{ $errors->has('photo_one') ? ' has-error' : '' }}  {{ $errors->has('photo_two') ? ' has-error' : '' }}  {{ $errors->has('photo_three') ? ' has-error' : '' }}  {{ $errors->has('photo_four') ? ' has-error' : '' }} add-image">
                                    <label class="col-sm-2 label-title">Photo(s) </label>

                                    <div class="col-sm-10">
                                        <p style="font-size:14px;"><span>The first photo is your main photo. You must upload the first photo.</span></p>
                                        <div class="form-group ad-post-photo">

                                            <label class="slide_upload profile-image" for="photo1">
                                                <img id="image_load1" src="@if(file_exists($adData->postPhoto->photo_one)) {{asset('images/post_photo/big/'.$adData->postPhoto->photo_one)}} @else {{asset('/')}}images/default/photo.png @endif" title="First Photo" alt="Paibaa | Khojlei Paibaa | Shob Paibaa" style="max-width: 100px;border: 2px dashed #2783bb; cursor: pointer">
                                                <input id="photo1" style="display:none" name="photo_one" class="type-pass" type="file" onchange="photoLoad(this,this.id)" accept="image/*">
                                            </label>

                                            <label class="slide_upload profile-image" for="photo2">
                                                <img id="image_load2" src="@if($adData->postPhoto->photo_two!='') {{asset('images/post_photo/big/'.$adData->postPhoto->photo_two)}} @else {{asset('/')}}images/default/photo.png @endif" title="Second Photo" alt="Paibaa | Khojlei Paibaa | Shob Paibaa" style="max-width: 100px;border: 2px dashed #2783bb; cursor: pointer">
                                                <input id="photo2" style="display:none" name="photo_two" type="file" onchange="photoLoad(this,this.id)" accept="image/*">
                                            </label>

                                            <label class="slide_upload profile-image" for="photo3">
                                                <img id="image_load3" src="@if($adData->postPhoto->photo_three!='') {{asset('images/post_photo/big/'.$adData->postPhoto->photo_three)}} @else {{asset('/')}}images/default/photo.png @endif" title="Third Photo" alt="Paibaa | Khojlei Paibaa | Shob Paibaa" style="max-width: 100px;border: 2px dashed #2783bb; cursor: pointer">
                                                <input id="photo3" style="display:none" name="photo_three" type="file" onchange="photoLoad(this,this.id)" accept="image/*">
                                            </label>

                                            <label class="slide_upload profile-image" for="photo4">
                                                <img id="image_load4" src="@if($adData->postPhoto->photo_four!='') {{asset('images/post_photo/big/'.$adData->postPhoto->photo_four)}} @else {{asset('/')}}images/default/photo.png @endif" title="Last Photo" alt="Paibaa | Khojlei Paibaa | Shob Paibaa" style="max-width: 100px;border: 2px dashed #2783bb; cursor: pointer">
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

                                    <label class="col-md-2">Area <sup class="text-danger help-block with-errors">*</sup></label>
                                    <div class="col-md-3 ">
                                        {{--<label>Location <sup class="text-danger help-block with-errors">*</sup></label>--}}
                                        {{Form::select('division_town_id',$divisionTowns,$adData->division_town_id,['data-error'=>':Location is Required','onchange'=>'loadArea(this.value)','class'=>'form-control type-pass','placeholder'=>'Select Division/Town','required'=>true])}}

                                    </div>

                                    <div class="col-md-7" id="loadArea">
                                        {{--<label>Area <sup class="text-danger help-block with-errors">*</sup></label>--}}
                                        {{Form::select('area_id[]',$existDivisionTownArea,json_decode($adData->area_id),['data-error'=>':Area is Required','class'=>'select2 form-control type-pass','multiple'=>true,'placeholder'=>'Select Division/Town First !','required'=>true])}}
                                    </div>
                                </div>


                                <div class="row form-group">
                                    <label class="col-md-2">Meetup <sup class="text-danger help-block with-errors">*</sup></label>
                                    <div class="col-md-10">
                                        {{Form::text('address',$value=$adData->address,['data-error'=>':Specific Address is Required','class'=>'form-control type-pass','required'=>true])}}
                                        @if ($errors->has('address'))
                                            <span class="help-block">
                                            <strong class="text-danger">{{ $errors->first('address') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>


                                <!-- custom fields start-->
                                @if(count($postFields)>0)

                                    @foreach($postFields as $postField)
                                        <div class="row form-group ">
                                            <label class="col-sm-2 label-title">{{$postField->title}}  <sup class="text-danger">{{$postField->required=='required'?'*':''}}</sup></label>
                                            <div class="col-sm-10 ">

                                                @if($postField->field_type=='text')
                                                    {{Form::text('field_value[]',$value=$postField->field_value,['class'=>'form-control type-pass','placeholder'=>$postField->placeholder,
                                                    'data-error'=>$postField->title.' is required','required'=>$postField->required=='required'?true:false])}}
                                                    @if ($errors->has('field_value'))
                                                        <span class="help-block"><strong>{{ $errors->first('field_value') }}</strong> </span>
                                                    @endif

                                                @elseif($postField->field_type=='number')
                                                    {{Form::number('field_value[]',$value=$postField->field_value,['class'=>'form-control type-pass','min'=>'0','step'=>'any',
                                                'placeholder'=>$postField->placeholder,'required'=>$postField->required=='required'?true:false])}}
                                                    @if ($errors->has('field_value'))
                                                        <span class="help-block"><strong>{{ $errors->first('field_value') }}</strong> </span>
                                                    @endif

                                                @elseif($postField->field_type=='dropdown')
                                                    <?php
                                                    $value1=explode(',',$postField->value);
                                                    $values=array();
                                                    foreach ($value1 as $val) {
                                                        if($val!=null){
                                                            $values[$val]=$val;
                                                        }
                                                    }
                                                    ?>

                                                    {{Form::select('field_value[]',$values,$postField->field_value,['class'=>'form-control type-pass','min'=>'0','step'=>'any',
                                                'placeholder'=>'-Select Payment Type-','required'=>$postField->required=='required'?true:false])}}
                                                    @if ($errors->has('field_value'))
                                                        <span class="help-block"><strong>{{ $errors->first('field_value') }}</strong> </span>
                                                    @endif

                                                @endif
                                                {{Form::hidden('post_field_id[]',$postField->id,['readonly'=>true])}}

                                                <div class="text-danger help-block with-errors"></div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif


                            <!-- custom fields end-->



                                @if($subCategoryInfo->post_type==1) <!--hide when category is special=blog -->
                                <div class="row form-group  {{ $errors->has('price') ? ' has-error' : '' }} select-price">
                                    <label class="col-sm-2 label-title">@if($subCategoryInfo->category_name=='Need') Amount @else Price @endif <sup class="text-danger">*</sup></label>
                                    <div class="col-sm-6">
                                        {{Form::number('price',$value=$adData->price,['data-error'=>'Price is required','class'=>'priceAmount form-control type-pass','min'=>'0','step'=>'any','placeholder'=>'tk','required'=>true])}}

                                        <div class="text-danger help-block with-errors"></div>
                                        @if ($errors->has('price'))
                                            <span class="help-block">
							                        <strong>{{ $errors->first('price') }}</strong>
							                    </span>
                                        @endif
                                    </div>
                                    <div class="col-md-3">
                                        <div class="checkbox">
                                            <div class="form-group ad-type-label {{ $errors->has('is_negotiable') ? ' has-error' : '' }} col-md-12">
                                                <label for="negotiable" style="width: auto">
                                                    <input name="is_negotiable" type="checkbox" {{ $adData->is_negotiable==1?'checked':''}} class="type-pass" id="negotiable">Negotiable
                                                </label>
                                                @if ($errors->has('is_negotiable'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('is_negotiable') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            @endif


                            @if($subCategoryInfo->post_type==1) <!--hide when category is special=blog -->
                            <div class="row form-group  {{ $errors->has('price') ? ' has-error' : '' }} select-price" style="display: @if($adData->price2!='') flex @else none @endif" id="packageOffer">
                                <label class="col-md-2 col-sm-2 label-title">@if($subCategoryInfo->category_name=='Need') Package @else Package @endif</label>
                                <div class="col-md-10 col-sm-10">
                                    {{Form::text('price2',$value=$adData->price2,['data-error'=>'Price is required','class'=>'price2 form-control type-pass','min'=>'0','placeholder'=>'You can offer package, Ex: 1 day/month 0000 tk','required'=>false])}}

                                    <div class="text-danger help-block with-errors"></div>
                                    @if ($errors->has('price2'))
                                        <span class="help-block">
                                                <strong>{{ $errors->first('price2') }}</strong>
                                            </span>
                                    @endif
                                </div>
                            </div>
                            @endif

                                <!--sub-category wise brand start-->

                                @if(count($brands)>0)

                                    <div class="row form-group ">
                                        <label class="col-sm-2 label-title"> Brand <sup class="text-danger help-block with-errors">*</sup></label>
                                        <div class="col-sm-10 ">

                                                {{Form::select('brand_id',$brands,$adData->brand_id,['class'=>'form-control type-pass','placeholder'=>'-Select Brand-','required'=>false,'data-error'=>'Brand name is required'])}}
                                                @if ($errors->has('field_value'))
                                                    <span class="help-block"><strong>{{ $errors->first('field_value') }}</strong> </span>
                                                @endif
                                        </div>
                                    </div>
                                @endif

                                <!--sub-category wise brand end-->


                                <div class="row">
                                    <label class="col-md-2"> Tags </label>

                                    <div class="col-md-10">
                                        {{Form::text('tag',$value=$adData->tag,['id'=>'tagboxField','class'=>'form-control type-pass','placeholder'=>'Type your tag and press Enter Or Tag Name Separate by comma (,)','required'=>false])}}
                                        @if ($errors->has('tag'))
                                            <span class="help-block">
                                            <strong class="text-danger">{{ $errors->first('tag') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>


                                <div class="row">
                                    <span class="col-md-2"></span>
                                    <div class="col-md-10">
                                        <button class="update_btn mt-2 text-capitalize" type="button" value="button" id="postSubmit">Update Your Ad</button>

                                        <a href="{{URL::to('/my-ads')}}" class=" text-capitalize btn btn-warning pull-right"><i class="fa fa-times"></i> Cancel </a>
                                    </div>
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
                        <img class="add_img img-fluid" src="{{asset('/frontend')}}/images/discount-img.png" alt="Classified Plus">
                    </div>
                </div>
            </div>
        </div>
    </section>


@endsection

@section('script')
    {{--<script src="https://cdnjs.cloudflare.com/ajax/libs/1000hz-bootstrap-validator/0.11.9/validator.min.js"></script>--}}

    <script>
        $('.priceAmount').on('blur',function() {
            var priceAmount=$(this).val()

            if(priceAmount.length>0){
                $('#packageOffer').css('display','flex')
            }else {
                $('#packageOffer').css('display','none')
                $('.price2').val('')
            }


            $('#postSubmit').html('Post Your Ad')
        });
    </script>


    <script>
        $('#description').keyup(function() { //description

            if (this.value.length > 400) {
                var data=400-this.value.length
                $('.description-error').text(data+'/400')

                $('#description').val(this.value.substr(0, 400))
                return false

            }else {
                $('.description-error').text(400-this.value.length+'/400')
            }
        });
    </script>


    <script>
        $('.type-pass').on('keypress click change',function() {
            $('#postSubmit').attr('type','submit')
            $('#postSubmit').html('Update Your Ad')
        });
    </script>

    <script type="text/javascript">

        function loadArea(id){
            $('#loadArea').load('{{URL::to("load-area-by-division-town-on-ad-post")}}/'+id);
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


    <script>
        $('.maxlength').keypress(function() {
            if (this.value.length >= 11) {
                return false;
            }
        });
    </script>


@endsection
