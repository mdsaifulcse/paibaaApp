@extends('backend.app')
@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="{{URL::to('home')}}"><i class="fa fa-home" aria-hidden="true"></i> Home</a></li>
        <li class="#">Unpublished/Pending Ads</li>
    </ol>

@endsection
@section('content')
    <div id="content" class="content">
        <div class="row">
            <div class="col-lg-12">
                <div class="box box-danger">
                    <div class="box-header bg-gray-active">
                        All Unpublished/Pending Ads
                        <div class="box-btn pull-right">

                            <a href="{{url('all-ads')}}" class="btn btn-primary btn-sm pull-right"> <i class="fa fa-check-square-o" aria-hidden="true"></i> Go Approved Ads </a>
                        </div>
                    </div>
                    <div class="box-body table-responsive">
                        @if(count($adPost)>0)
                        <table class="table table-striped table-hover table-bordered center_table" id="my_table">
                            <thead>
                            <tr>
                                <th>SL</th>
                                <th>Photo</th>
                                <th width="30%">Title</th>
                                <th>Sub.Category</th>
                                <th>Category</th>
                                <th>Author Name</th>
                                <th>Author Mobile</th>
                                <th>Status</th>
                                <th>Created At</th>
                                <th width="6%">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $i=1; ?>
                            @foreach($adPost as $data)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td>
                                        <img src="{{asset('images/post_photo/small/'.$data->postPhoto->photo_one)}}" style="width: 60px" alt=" Paibaa | Shob Paiba">
                                    </td>
                                    <td>{{$data->title}}</td>
                                    <td>{{$data->adSubCategory->first()->sub_category_name}}</td>
                                    <td>{{$data->postCategory->category_name}}</td>
                                    <td>{{$data->postAuthor->name}}</td>
                                    <td>{{$data->postAuthor->mobile}}</td>
                                    <td>
                                        @if($data->is_approved==2)
                                            <span class="btn btn-warning btn-xs">Pending</span>
                                        @endif
                                    </td>

                                    <td>{{date('D-M-Y',strtotime($data->created_at))}}</td>
                                    <td>
                                        {!! Form::open(array('route' => ['manage-ad.destroy',$data->id],'method'=>'DELETE','id'=>"deleteForm$data->id")) !!}
                                        <a href="{{route('manage-ad.edit',$data->id)}}" title="Click Here To View & Edit This Ad" class="btn btn-xs btn-info"> <i class="fa fa-edit"></i> </a>
                                        <button type="button" class="btn btn-xs btn-danger" title="Click Here To Delete This Ad" onclick='return deleteConfirm("deleteForm{{$data->id}}")'><i class="fa fa-trash"></i></button>
                                        {!! Form::close() !!}
                                    </td>

                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                            @else
                            <h4 class="text-danger text-center"><i class="fa fa-warning"></i>  No Ad Data Found ! </h4>
                            @endif
                    </div>
                    <div class="pull-right">
                        {{$adPost->render()}}
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
