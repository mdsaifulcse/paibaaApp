@extends('backend.app')
@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="{{URL::to('home')}}"><i class="fa fa-home" aria-hidden="true"></i> Home</a></li>
        <li>All Location</li>
    </ol>

@endsection
@section('content')
    <style>
    .action-dropdown li{
        width: fit-content !important;
        margin-bottom: 5px;
    }
    </style>

    <div id="content" class="content">
        <div class="row">
            <div class="col-lg-12">
                <div class="box box-danger">
                    <div class="box-header bg-gray-active">
                        All Location
                        <div class="box-btn pull-right">

                            <a href="#modal-dialog" class="btn btn-primary btn-sm" data-toggle="modal"> <i class="fa fa-plus" aria-hidden="true"></i> New Location </a>
                        </div>
                    </div>


                    <!-- location creation modal start -->

                    <div class="modal fade" id="modal-dialog" data-backdrop="static" data-keyboard="false">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                {!! Form::open(array('route' => 'location.store','class'=>'form-horizontal','method'=>'POST','files'=>true)) !!}
                                <div class="modal-header">
                                    <h4 class="modal-title">Add New Location</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                </div>
                                <div class="modal-body">

                                    <div class="form-group row">
                                        <label class="col-md-12"> Location Name <sup class="text-danger">*</sup>:</label>
                                        <div class="col-md-12">
                                            <input type="text" class="form-control" name="location_name" value="{{old('location_name')}}" required placeholder="Location Name">
                                        </div>
                                    </div>



                                    <div class="form-group row">
                                        <div class="col-md-4 no-padding">
                                            <label class="col-md-12"> Status <sup class="text-danger">*</sup></label>
                                            <div class="col-md-12">
                                                {{Form::select('status',['1'=>'Active','0'=>'Inactive'],[],['class'=>'form-control'])}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <a href="javascript:void(0)" class="btn btn-sm btn-danger pull-left" data-dismiss="modal">Close</a>
                                    <button type="submit" class="btn btn-sm btn-success">Submit</button>
                                </div>
                                {!! Form::close(); !!}
                            </div>
                        </div>
                    </div>


                    <!-- location creation modal end -->

                    <div class="box-body ">
                        <table class="table table-striped table-hover table-bordered center_table" id="allAds">
                            <thead>
                            <tr>
                                <th>SL</th>
                                <th>Location</th>
                                <th>Status</th>
                                <th>Author Name</th>
                                <th>Created At</th>
                                <th width="6%">Action</th>
                            </tr>
                            </thead>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection


@section('script')
    <script>
        $(function() {
            $('#allAds').DataTable( {
                processing: true,
                serverSide: true,

                ajax: '{{ URL::to("location/create") }}',
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    { data: 'location_name',name:'locations.location_name'},
                    { data: 'Status'},
                    { data: 'name',name:'users.name'},
                    { data: 'CreatedAt'},
                    { data: 'Action'},
                ]
            });

        });
    </script>

    @endsection
