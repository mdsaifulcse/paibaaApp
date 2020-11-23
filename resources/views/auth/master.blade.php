<!DOCTYPE html>
<html lang="en">
<head>
    <title> {{$info->company_name}} </title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="{{asset('/')}}images/logo/favicon.png"/>
    <!--===============================================================================================-->
    <link rel="stylesheet" href="{{asset('backend/assets/bootstrap.min.css')}}">

    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,400i,500,500i,700,700i" rel="stylesheet">

</head>
<body>

@yield('content')

<!--===============================================================================================-->

<!--===============================================================================================-->
<script src="{{asset('/')}}backend/login/vendor/jquery/jquery-3.2.1.min.js"></script>
<script src="{{asset('/')}}backend/login/vendor/bootstrap/js/bootstrap.min.js"></script>
<script src="{{asset('/backend/assets/sweetalert2.all.min.js')}}"></script>

@if(Session::has('success'))
    <script type="text/javascript">
        swal({
            type: 'success',
            title: '{{Session::get("success")}}',
            showConfirmButton: true,

        })
    </script>
@endif

@if(Session::has('error'))
    <script type="text/javascript">
        swal({
            type: 'error',
            title: '{{Session::get("error")}}',
            showConfirmButton: true
        })
    </script>
@endif
@yield('script')
</body>
</html>
