@extends('backend.app')
@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="{{URL::to('home')}}"><i class="fa fa-home" aria-hidden="true"></i> Home</a></li>
        <li class="#">Unpublished/Pending Ads</li>
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
                        All Approved Ads
                        <div class="box-btn pull-right">

                            <a href="{{url('manage-ad')}}" class="btn btn-primary btn-sm pull-right"> <i class="fa fa-hourglass-start" aria-hidden="true"></i> Go Pending Ads </a>
                        </div>
                    </div>
                    <div class="box-body table-responsive">
                        <table class="table table-striped table-hover table-bordered center_table" id="allAds">
                            <thead>
                            <tr>
                                <th>SL</th>
                                <th>Photo</th>
                                <th width="20%">Title</th>
                                <th>Category</th>
                                <th>Author Name</th>
                                <th>Author Mobile</th>
                                <th>Status</th>
                                <th>Created At</th>
                                <th width="6%">Action</th>
                            </tr>
                            </thead>
                            <tbody id="publishedAds">

                            </tbody>
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

                ajax: '{{ URL::to("show-all-ads") }}',
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    { data: 'Photo'},
                    { data: 'title',name:'ad_post.title'},
                    //{ data: 'sub_category_name',name:'sub_category.sub_category_name'},
                    { data: 'category_name',name:'categories.category_name'},
                    { data: 'name',name:'users.name'},
                    { data: 'mobile',name:'users.mobile'},
                    { data: 'Status'},
                    { data: 'CreatedAt'},
                    { data: 'Action'},
                ]
            });

        });
    </script>

    @endsection
