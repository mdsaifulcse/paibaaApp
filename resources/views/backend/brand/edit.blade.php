@extends('backend.app')
@section('content')


    <div id="content" class="content">

        <div class="row">
            <div class="col-lg-12">
                <div class="box box-danger">

                    <div class="box-header with-border bg-gray-active">
                        <h4 class="box-title">Edit {{$data->brand_name}} </h4>
                        <a href="{{URL::to('/brand')}}" class="btn btn-primary btn-sm pull-right"> <i class="fa fa-angle-double-left"></i> All Brand </a>

                    </div>

                    <div class="box-body ">

                        <div class="well">
                            {!! Form::open(array('route' => ['brand.update',$data->id],'class'=>'form-horizontal','method'=>'PUT','files'=>true)) !!}

                            <div class="form-group {{ $errors->has('brand_name') ? 'has-error' : '' }}">
                                {{Form::label('brand_name', 'Name', array('class' => 'col-md-2 control-label'))}}

                                <div class="col-md-7">
                                    {{Form::text('brand_name',$data->brand_name,array('class'=>'form-control','placeholder'=>'Brand Name','required'))}}
                                    @if ($errors->has('brand_name'))
                                        <span class="help-block">
                        <strong>{{ $errors->first('brand_name') }}</strong>
                    </span>
                                    @endif
                                </div>

                            </div>

                            <div class="form-group">
                                {{Form::label('category', 'Select Category* :', array('class' => 'col-md-2 control-label'))}}
                                <div class="col-md-4">
                                    {{Form::select('category[]',$category,$categoryId, ['class' => 'form-control chosen-select','placeholder'=>'Select Category','required','onchange'=>'loadSubCategory(this.value)'])}}
                                </div>

                                {{Form::label('status', 'Status', array('class' => 'col-md-1 control-label'))}}
                                <div class="col-md-2">
                                    {{Form::select('status', array('1' => 'Active', '2' => 'Inactive'), $data->status, ['class' => 'form-control'])}}
                                </div>
                            </div>

                            <div>
                                <div class="form-group">

                                    {{Form::label('sub_category_id', 'Sub Category* :', array('class' => 'col-md-2 control-label'))}}

                                    <div class="col-md-7" id="loadSubCategory">
                                        {{Form::select('sub_category_id[]',$subCategory,$existSubCat, ['class' => 'form-control select2','data-placeholder'=>'Select Sub Category','multiple','required'])}}
                                    </div>
                                </div>
                            </div>
                            {{Form::hidden('id',$data->id)}}
                            <div class="form-group">
                                <div class="col-md-10 col-md-offset-2">
                                    {{Form::submit('Save Change',array('class'=>'btn btn-md btn-primary'))}}
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

    <script type="text/javascript">
        function loadSubCategory(id){
            $('#loadSubCategory').load('{{URL::to("load-sub-category")}}/'+id);

        }
    </script>
@endsection