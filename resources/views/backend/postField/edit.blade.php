@extends('backend.app')
@section('content')
<div id="content" class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="box box-danger">

                <div class="box-header with-border bg-gray-active">
                    <h4 class="box-title">Edit : {{$data->title}} </h4>
                    <a href='{{URL::to("post-field")}}' class="btn btn-default pull-right"> <i class="ion ion-navicon-round"></i> View All Fields </a></h3>

                </div>

                <div class="box-body ">

                    <div class="well">
                        {!! Form::open(array('route' => ['post-field.update',$data->id],'class'=>'form-horizontal','method'=>'PUT','files'=>true)) !!}
                        <div class="form-group col-md-12 {{ $errors->has('title') ? 'has-error' : '' }}">
                            {{Form::label('title', 'Title* :', array('class' => 'col-md-2 control-label'))}}

                            <div class="col-md-8">
                                {{Form::text('title',$value=$data->title,array('class'=>'form-control','placeholder'=>'Title','required'=>true))}}

                                @if ($errors->has('title'))
                                    <span class="help-block">
                                        <strong class="text-danger">{{ $errors->first('title') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-2">
                                {{Form::select('status', array('1' => 'Active', '2' => 'Inactive'), $data->status, ['class' => 'form-control'])}}

                                @if ($errors->has('status'))
                                    <span class="help-block">
                                        <strong class="text-danger">{{ $errors->first('status') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group col-md-5">
                            {{Form::label('type', 'Input Type', array('class' => 'col-md-5 control-label'))}}

                            <div class="col-md-6">
                                {{Form::select('field_type',$type, $data->field_type, ['class' => 'form-control','onchange'=>'inputType(this.value)','placeholder'=>'Select One','required'=>true])}}

                                @if ($errors->has('field_type'))
                                    <span class="help-block">
											<strong class="text-danger">{{ $errors->first('field_type') }}</strong>
										</span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group col-md-3">
                            {{Form::label('required', 'Required', array('class' => 'col-md-4 control-label'))}}

                            <div class="col-md-8">
                                {{Form::select('required',['required'=>'Yes',''=>'No'], $data->required, ['class' => 'form-control','placeholder'=>'Select one','required'=>true])}}

                                @if ($errors->has('required'))
                                    <span class="help-block">
											<strong class="text-danger">{{ $errors->first('required') }}</strong>
										</span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group col-md-4">
                            {{Form::label('required', 'Use On Filter', array('class' => 'col-md-4 control-label'))}}

                            <div class="col-md-8">
                                {{Form::select('use_on_filter',['0'=>'No','1'=>'Yes'], $data->use_on_filter, ['class' => 'form-control','placeholder'=>'Select one','required'=>true,'title'=>'Is this filter Will be on filter ?'])}}
                                @if ($errors->has('use_on_filter'))
                                    <span class="help-block">
											<strong class="text-danger">{{ $errors->first('use_on_filter') }}</strong>
										</span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group col-md-12" id="dropdownValue" style="display: {{$data->field_type=='dropdown'?'block':'none'}}">
                            {{Form::label('Value', 'Dropdown Value* :', array('class' => 'col-md-2 control-label'))}}

                            <div class="col-md-10">
                                {{Form::text('value',$value=$data->value, ['id'=>'tagboxField','class' => 'form-control','placeholder'=>'Type value and press enter','required'=>false])}}
                                <span>Press enter for every value</span>
                                @if ($errors->has('value'))
                                    <span class="help-block">
											<strong class="text-danger">{{ $errors->first('value') }}</strong>
										</span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group col-md-6">
                            {{Form::label('category', 'Select Category* :', array('class' => 'col-md-4 control-label'))}}
                            <div class="col-md-7">
                                {{Form::select('category',$category,$categoryId, ['id'=>'categoryId','class' => 'form-control chosen-select','placeholder'=>'Select Category','required','onchange'=>'loadSubCategory(this.value)'])}}
                                @if ($errors->has('category'))
                                    <span class="help-block">
											<strong class="text-danger">{{ $errors->first('category') }}</strong>
										</span>
                                @endif
                            </div>
                        </div>


                        {{--<div id="loadValue"><!-- Load Sub Category --></div>--}}

                        <div class="form-group col-md-12">
                            {{Form::label('category', 'Sub-Category* :', array('class' => 'col-md-2 control-label'))}}
                            <div class="col-md-10" id="loadSubCat">
                                @if(count($existSubCat)>0)
                                {{Form::select('sub_category_id[]', $subCategory, $existSubCat, ['class' => 'form-control select2','multiple'=>true,'required'=>true])}}
                                @else

                                {{Form::select('sub_category_id[]',[],'', ['class' => 'form-control','placeholder'=>'No Sub Category Data','required'])}}
                                @endif

                                @if ($errors->has('sub_category_id'))
                                    <span class="help-block">
											<strong class="text-danger">{{ $errors->first('sub_category_id') }}</strong>
										</span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group">
                            <div class="col-md-10 col-md-offset-2">
                                {{Form::submit('Submit',array('class'=>'btn btn-md btn-info'))}}
                            </div>
                        </div>

                        {!! Form::close() !!}
                    </div>


                </div>
            </div>
        </div>
    </div>
</div>


@endsection

@section('script')
    @if(count($errors)>0)

        <script>
            var id=$('#categoryId').val()
            $('#loadSubCat').load('{{URL::to("load-sub-category")}}/'+id);
        </script>

    @endif

    <script type="text/javascript">
        function loadSubCategory(id){
            $('#loadSubCat').load('{{URL::to("load-sub-category")}}/'+id);
        }
        function inputType(value){
            if(value=='dropdown'){
                console.log('Good')
                $('#dropdownValue').css('display','block')
                //$('#dropdownValue').next().next().children().attr('required',true)
            }else{
                $('#dropdownValue').css('display','none')

            }
        }
    </script>
@endsection