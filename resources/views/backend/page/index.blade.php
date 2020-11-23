
@extends('backend.app')
@section('content')
    <div id="content" class="content">

        <div class="row">
            <div class="col-lg-12">
                <div class="box box-danger">

                    <div class="box-header with-border bg-gray-active">
                        <h4 class="box-title"> All Pages </h4>
                        <a href="{{URL::to('pages/create')}}" class="btn btn-primary btn-sm pull-right"> <i class="fa fa-plus"></i> Add new page </a>
                    </div>

                    <div class="box-body ">
                        <table class="table table-striped table-hover table-bordered center_table" id="my_table">
                            <thead>
                            <tr>
                                <th>SL</th>
                                <th>Page Name</th>
                                <th>Page Title </th>
                                <th>Page Link </th>
                                <th>Status</th>
                                <th>Created At</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <? $i=1; ?>
                            @foreach($allData as $data)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td> {{$data->name}} </td>
                                    <td> {{$data->title}} </td>
                                    <td><a href="{{URL::to('page/'.$data->link)}}" target="_blank">{{URL::to('page/'.$data->link)}}</a></td>

                                    <td><i class="{{($data->status==1)? 'fa fa-check-circle text-success' : 'fa fa-times-circle'}}"></i></td>
                                    <td>{{$data->created_at}}</td>
                                    <td>
                                        {!! Form::open(array('route' => ['pages.destroy',$data->id],'method'=>'DELETE','id'=>"deleteForm$data->id")) !!}
                                        <a href="{{URL::to('pages/'.$data->id.'/edit')}}" class="btn btn-warning btn-xs" title="Click here to Edit this page info"><i class="fa fa-edit"></i>  </a>

                                        <button type="button" class="btn btn-danger btn-xs" onclick="return deleteConfirm('deleteForm{{$data->id}}')" title="Click here to delete">
                                            <i class="fa fa-trash"></i>
                                        </button>
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
                </div>
            </div>
        </div><!--end row-->



    </div><!--end content-->


@endsection
