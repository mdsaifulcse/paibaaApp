@extends('backend.app')
@section('content')

<div class="tab_content">
@if ($errors->has('email'))
    <div class="col-md-12">
        <div class="alert alert-danger alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <b>{{ $errors->first('email') }}</b> 
       </div>
    </div>
@endif
  <h3 class="box_title">All Ads
 <a href="{{route('banner-manager.create')}}" class="btn btn-default pull-right"> <i class="ion ion-plus"></i> Add new Ad</a></h3>
        <table class="table table-striped table-hover table-bordered center_table" id="my_table">
            <thead>
                <tr>
                    <th>Caption</th>
                    <th>Page Name</th>
                    <th>Category</th>
                    <th>Serial</th>
                    <th>Status</th>
                    <th>Created At</th>
                    <th colspan="2" width="5%">Action</th>
                </tr>
            </thead>
            <tbody>
            @foreach($allData as $data)
                <tr>
                    <td><a href="{{route('banner-manager.edit',$data->id)}}" class="top_caption">
                    <? echo $data['caption']; ?></a> </td>
                    <td>{{$data->name}}</td>
                    <td>{{$data->cat_name}}</td>
                    <td>{{$data->serial_num}}</td>
                    <td><i class="{{($data->status==1)? 'ion-checkmark-circled success' : 'ion-ios-close danger'}}"></i></td>
                    <td>{{date('jS M Y',strtotime($data->created_at))}}</td>
                    <td>
                       <a href="{{route('banner-manager.edit',$data->id)}}" class="btn btn-info"><i class="ion ion-compose"></i></a> 
                        
                    </td>
                    <td>
        {!! Form::open(array('route' => ['banner-manager.destroy',$data->id],'method'=>'DELETE')) !!}
            <button type="submit" class="btn btn-danger" onclick="return deleteConfirm()"><i class="ion ion-ios-trash-outline"></i></button>
        {!! Form::close() !!}
                    </td>

                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="pull-right">
        {{$allData->render()}} 
        </div>
  </div>


@endsection