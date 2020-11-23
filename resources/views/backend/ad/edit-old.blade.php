@extends('backend.app')
@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="{{URL::to('home')}}"><i class="fa fa-home" aria-hidden="true"></i> Home</a></li>
        <li class="#">Edit Post Ad</li>
    </ol>

@endsection
@section('content')
    <div id="content" class="content">
        <div class="row">
            <div class="col-lg-12">
                <div class="box box-danger">
                    <div class="box-header bg-gray-active">
                        Edit Post Ad : {{$pendingAd->title}}
                        <div class="box-btn pull-right">

                            <a href="{{ url()->previous() }}" class="btn btn-primary btn-sm pull-right"> <i class="fa fa-angle-double-left" aria-hidden="true"></i> Go Back </a>
                        </div>
                    </div>
                    <div class="box-body ">
                        <div class="row">
                            <div class="col-md-8 col-md-offset-2" style="background-color: #e1f7d8ab;border: 1px solid #E91E63">
                                <div class="profile_detail">
                                    <h4>Ad Details: {{$categoryInfo->category_name}} <i class="fa fa-angle-double-right"></i>  <i class="fa fa-angle-double-right"></i> {{$pendingAd->title}} {{$errors}}</h4>

                                        {!! Form::open(['route'=>['manage-ad.update',$pendingAd->id],'method'=>'PUT','files'=>true])!!}
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-6 selectdiv">
                                                    <label>Location <sup class="text-danger with-errors">*</sup></label>
                                                    {{Form::select('division_town_id','',$pendingAd->division_town_id,['data-error'=>':Location is Required','onchange'=>'loadArea(this.value)','class'=>'form-control type-pass','placeholder'=>'Select Division/Town','required'=>true])}}

                                                </div>

                                                <div class="col-md-6 selectdiv">
                                                    <label>Area <sup class="text-danger with-errors">*</sup></label>
                                                    <div id="loadArea">
                                                        {{Form::select('area_id',$existDivisionTownArea,$pendingAd->area_id,['data-error'=>':Area is Required','class'=>'form-control type-pass','placeholder'=>'Select Division/Town First !','required'=>true])}}
                                                    </div>
                                                </div>

                                            </div>
                                        </div>


                                    {{--<div class="form-group">--}}
                                        {{--<label>Contact Number <sup class="text-danger  with-errors">*</sup></label>--}}
                                        {{--{{Form::text('contact',$value=$pendingAd->contact,['data-error'=>':Contact Number is Required','class'=>'form-control type-pass','placeholder'=>'You can update & add more contact number','required'=>true])}}--}}
                                        {{--@if ($errors->has('contact'))--}}
                                            {{--<span class="help-block">--}}
                                            {{--<strong class="text-danger">{{ $errors->first('contact') }}</strong>--}}
                                        {{--</span>--}}
                                        {{--@endif--}}
                                    {{--</div>--}}

                                    <div class="form-group">
                                        <label>Specific Address <sup class="text-danger  with-errors">*</sup></label>
                                        {{Form::text('address',$value=$pendingAd->address,['data-error'=>':Specific Address is Required','class'=>'form-control type-pass','required'=>true])}}
                                        @if ($errors->has('address'))
                                            <span class="help-block">
                                            <strong class="text-danger">{{ $errors->first('address') }}</strong>
                                        </span>
                                        @endif
                                    </div>

                                    {{--@if($categoryInfo->post_type==1) <!--hide when category is special=blog -->--}}
                                    {{--<div class="form-group">--}}
                                        {{--<div class="row">--}}
                                            {{--<div class="col-md-3">--}}
                                                {{--<label class="ad-type">Type of ad  <sup class="text-danger ">*</sup> : </label>--}}
                                            {{--</div>--}}
                                            {{--<div class="col-md-8 ad-type-label">--}}
                                                {{--<label for="newsell" ><input type="radio" name="type" data-error="Please choose type of these options " {{ $pendingAd->type==1?'checked':''}} class="type-pass" value="1"  id="newsell" required> I want to sell </label>--}}
                                                {{--<label for="newbuy"><input type="radio" name="type" data-error="Please choose type of these options " {{ $pendingAd->type==2?'checked':''}} class="type-pass" value="2" id="newbuy" required> I want to buy</label>--}}
                                                {{--<span class="text-danger help-block with-errors"></span>--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                    {{--@endif--}}

                                    <div class="form-group {{ $errors->has('title') ? ' has-error' : '' }}">
                                        <label for="title">Title for your Ad <sup class="text-danger with-errors">*</sup> </label>
                                        {{Form::text('title',$value=$pendingAd->title,['id'=>'title','class'=>'form-control type-pass','placeholder'=>'Short title will be more useful to find your ad',
                                        'required'=>true,'data-error'=>':Please enter Ad title'])}}
                                        @if ($errors->has('title'))
                                            <span class="help-block">
                                            <strong class="text-danger">{{ $errors->first('title') }}</strong>
                                        </span>
                                        @endif
                                    </div>


                                    <div class="row form-group {{ $errors->has('photo_one') ? ' has-error' : '' }}  {{ $errors->has('photo_two') ? ' has-error' : '' }}  {{ $errors->has('photo_three') ? ' has-error' : '' }}  {{ $errors->has('photo_four') ? ' has-error' : '' }} add-image">
                                        <label class="col-sm-3 label-title">Photos for your ad </label>

                                        <div class="col-sm-9">
                                            <p style="font-size:14px;"><span>The first photo is your main photo. You must upload the first photo.</span></p>
                                            <div class="form-group ">

                                                <label class="slide_upload profile-image" for="photo1">
                                                    <img id="image_load1" src="@if($pendingAd->postPhoto->photo_one!='') {{asset('images/post_photo/big/'.$pendingAd->postPhoto->photo_one)}} @else {{asset('/')}}images/default/photo.png @endif" title="First Photo" alt="Paibaa | Khojlei Paibaa | Shob Paibaa" style="max-width: 100px;border: 2px dashed #2783bb; cursor: pointer">
                                                    <input id="photo1" style="display:none" name="photo_one" class="type-pass" type="file" onchange="photoLoad(this,this.id)" accept="image/*">
                                                </label>

                                                <label class="slide_upload profile-image" for="photo2">
                                                    <img id="image_load2" src="@if($pendingAd->postPhoto->photo_two!='') {{asset('images/post_photo/big/'.$pendingAd->postPhoto->photo_two)}} @else {{asset('/')}}images/default/photo.png @endif" title="Second Photo" alt="Paibaa | Khojlei Paibaa | Shob Paibaa" style="max-width: 100px;border: 2px dashed #2783bb; cursor: pointer">
                                                    <input id="photo2" style="display:none" name="photo_two" type="file" onchange="photoLoad(this,this.id)" accept="image/*">
                                                </label>

                                                <label class="slide_upload profile-image" for="photo3">
                                                    <img id="image_load3" src="@if($pendingAd->postPhoto->photo_three!='') {{asset('images/post_photo/big/'.$pendingAd->postPhoto->photo_three)}} @else {{asset('/')}}images/default/photo.png @endif" title="Third Photo" alt="Paibaa | Khojlei Paibaa | Shob Paibaa" style="max-width: 100px;border: 2px dashed #2783bb; cursor: pointer">
                                                    <input id="photo3" style="display:none" name="photo_three" type="file" onchange="photoLoad(this,this.id)" accept="image/*">
                                                </label>

                                                <label class="slide_upload profile-image" for="photo4">
                                                    <img id="image_load4" src="@if($pendingAd->postPhoto->photo_four!='') {{asset('images/post_photo/big/'.$pendingAd->postPhoto->photo_four)}} @else {{asset('/')}}images/default/photo.png @endif" title="Last Photo" alt="Paibaa | Khojlei Paibaa | Shob Paibaa" style="max-width: 100px;border: 2px dashed #2783bb; cursor: pointer">
                                                    <input id="photo4" style="display:none" name="photo_four" type="file" onchange="photoLoad(this,this.id)" accept="image/*">
                                                </label>
                                                <div id="errorPhoto" class="text-danger"> </div>
                                            </div>

                                            @if ($errors->has('photo_one'))  <span class="help-block"> <strong>{{ $errors->first('photo_one') }}</strong> </span><br>@endif
                                            @if ($errors->has('photo_two'))<span class="help-block"><strong>{{ $errors->first('photo_two') }}</strong> </span><br>@endif
                                            @if ($errors->has('photo_three'))<span class="help-block"><strong>{{ $errors->first('photo_three') }}</strong> </span><br> @endif
                                            @if ($errors->has('photo_four'))<span class="help-block"><strong>{{ $errors->first('photo_four') }}</strong></span> <br>@endif

                                        </div> <!--end row-9-->
                                    </div>


                                        <!--hide when category is special=blog -->
                                        {{--<div class="form-group">--}}
                                            {{--<div class="row">--}}
                                                {{--<div class="col-md-3">--}}
                                                    {{--<label class="ad-type">Condition  <sup class="text-danger">*</sup> : </label>--}}
                                                {{--</div>--}}
                                                {{--<div class="col-md-8 ad-type-label">--}}


                                                    {{--<label for="used"><input type="radio" name="condition" data-error="Please choose condition of these options " class="type-pass" {{ $pendingAd->condition==1?'checked':''}} value="1" id="used" required=""> Used </label>--}}


                                                    {{--<label for="new"><input type="radio" name="condition" data-error="Please choose condition of these options " class="type-pass" {{ $pendingAd->condition==2?'checked':''}} value="2" id="new" required=""> New</label>--}}
                                                    {{--<span class="text-danger help-block with-errors"></span>--}}
                                                {{--</div>--}}
                                            {{--</div>--}}
                                        {{--</div>--}}


                                        <!--hide when category is special=blog -->

                                    @if($categoryInfo->post_type==1) <!--hide when category is special=blog -->
                                    <div class="row form-group  {{ $errors->has('price') ? ' has-error' : '' }} select-price">
                                        <label class="col-sm-3 label-title">Price <sup class="text-danger">*</sup></label>
                                        <div class="col-sm-6">
                                            {{Form::number('price',$pendingAd->price,['data-error'=>'Price is required','class'=>'form-control type-pass','min'=>'0','step'=>'any','placeholder'=>'tk','required'=>true])}}

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
                                                        <input name="is_negotiable" {{ $pendingAd->is_negotiable==1?'checked':''}} type="checkbox" class="type-pass" id="negotiable">Negotiable
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

                                    <!-- custom fields start-->


                                    <!--sub-category wise brand start-->

                                    @if(count($brands)>0)

                                        <div class="row form-group ">
                                            <label class="col-sm-3 label-title"> Brand <sup class="text-danger with-errors">*</sup></label>
                                            <div class="col-sm-9 ">

                                                {{Form::select('brand_id',$brands,$pendingAd->brand_id,['class'=>'form-control type-pass','placeholder'=>'-Select Brand-','required'=>false,'data-error'=>'Brand name is required'])}}
                                                @if ($errors->has('field_value'))
                                                    <span class="help-block"><strong>{{ $errors->first('field_value') }}</strong> </span>
                                                @endif
                                            </div>
                                        </div>
                                    @endif

                                <!--sub-category wise brand end-->

                                    <!-- custom fields start-->
                                    @if(count($postFields)>0)

                                        @foreach($postFields as $postField)
                                            <div class="row form-group ">
                                                <label class="col-sm-3 label-title">{{$postField->title}}  <sup class="text-danger">{{$postField->required=='required'?'*':''}}</sup></label>
                                                <div class="col-sm-9 ">

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

                                                            {{Form::select('field_value[]',$values,$postField->field_value,['class'=>'form-control type-pass','min'=>'0','step'=>'any','placeholder'=>'-Select Payment Type-',
                                                            'required'=>$postField->required=='required'?true:false])}}
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

                                        <!-- custom fields end-->


                                    <div class="form-group">
                                        <label> Tags </label>
                                        {{Form::text('tag',$value=$pendingAd->tag, ['id'=>'tagboxField','class' => 'form-control','placeholder'=>'Type value and press enter','required'=>false])}}
                                        @if ($errors->has('tag'))
                                            <span class="help-block">
                                            <strong class="text-danger">{{ $errors->first('tag') }}</strong>
                                        </span>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label>Description <sup class="text-danger help-block with-errors">*</sup></label>

                                        {{Form::textArea('description',$pendingAd->description,['data-error'=>'Ad description is required','id'=>'description','rows'=>'7','class'=>'form-control type-pass','placeholder'=>'Write few lines about your ad','required'=>false])}}
                                        @if ($errors->has('description'))
                                            <span class="help-block">
                                            <strong class="text-danger">{{ $errors->first('description') }}</strong>
                                        </span>
                                        @endif
                                    </div>

                                        <span id="descriptionError" class="text-danger"></span>

                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-6 selectdiv">
                                                <label>Status <sup class="text-danger with-errors">*</sup></label>
                                                {{Form::select('status',['1'=>'Active','0'=>'Inactive'],$pendingAd->status,['data-error'=>':','class'=>'form-control','placeholder'=>'Select Status','required'=>true])}}
                                            </div>
                                            <div class="col-md-6 ">
                                                <label>Published Status <sup class="text-danger with-errors">*</sup></label>
                                                {{Form::select('is_approved',['1'=>'Publish','2'=>'Pending'],$pendingAd->status,['data-error'=>':','class'=>'form-control','placeholder'=>'Select Publish Status','required'=>true])}}
                                            </div>
                                        </div>
                                    </div>

                                        {{--<div class="form-group col-md-12 ad-type-label">--}}
                                            {{--<label for="agree_with" style="width: auto">--}}
                                                {{--<input type="checkbox" name="agree_with" data-error="Must be agree with Terms of Use &amp; Privacy Policy" ,="" id="agree_with" required="">I agree with <a href="http://localhost/paibaaApp/public/page/using-rules" target="_blank">Terms of Use</a> and <a href="http://localhost/paibaaApp/public/page/using-rules" target="_blank">Privacy Policy.</a>--}}
                                            {{--</label>--}}
                                            {{--<div class="text-danger help-block with-errors"></div>--}}
                                        {{--</div>--}}

                                        <button class="update_btn mt-2 text-capitalize btn btn-warning" type="submit" value="button" id="postSubmit">Update Ad</button>
                                    @if($pendingAd->status=0 && $pendingAd==2)
                                        <a href="{{URL::to('/manage-ad/create?id='.$pendingAd->id)}}" onclick="return confirm('Are you sure to published this Ad ?')" class="btn btn-primary pull-right">Approve & Published Ad</a>
                                    @endif
                                        <br>
                                    <hr>
                                    <h4>Author Info</h4>
                                    <h5>Name: {{$pendingAd->postAuthor->name}}, Mobile: {{$pendingAd->postAuthor->mobile}}</h5>
                                    {!! Form::close() !!}
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>


@endsection

@section('script')


    <script>
        $('.type-pass').on('keypress click change',function() {
            $('#postSubmit').attr('type','submit')
            $('#postSubmit').html('Post Your Ad')
        });
    </script>

    <script type="text/javascript">

        function loadArea(id){
            $('#loadArea').load('{{URL::to("load-area-by-division-town")}}/'+id);
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
    @endsection