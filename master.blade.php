<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" type="image/png" sizes="96x96" href="{{asset('/frontend/images')}}/favicon.png">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{asset('/frontend')}}/css/font-awesome.min.css" />
    <link href="{{asset('/frontend')}}/css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('/frontend')}}/css/jquery-ui.css" />
    <link rel="stylesheet" href="{{asset('/frontend')}}/css/price_range_style.css" />
    @yield('style')

    <link rel="stylesheet" href="{{asset('/frontend')}}/css/custom.css" />
    <link rel="stylesheet" href="{{asset('/frontend')}}/css/responsive.css" />

</head>
<body>
    <!-- Header  -->
@include('frontend._partials.header')
    <!-- Modal -->

    <!-- End Header  -->

@yield('content')



<!-- Footer -->
@include('frontend._partials.footer')

    <script>

        <?php  $path=Request::path()?>

        console.log("{{$path}}")

       @if($path=='/')
        $("#catLink").attr('required',false)
        $('#mainSearch').attr('action', "{{URL::to('/')}}")
       @else
       $("#catLink").attr('required',true)
        $(document).ready(function () {
            var catLink= $("#catLink").val();
            $('#mainSearch').attr('action', "{{URL::to('/ads/bangladesh')}}"+'/'+catLink)
        });
       @endif






        $('#catLink').on('change',function () {

            var catLink=$(this).val()

            console.log(catLink)

            $('#mainSearch').attr('action', "{{URL::to('/ads/bangladesh')}}"+'/'+catLink)
        })

    </script>



<script>
    $('#userMobile').on('blur',function () {

        if (Number($('#userMobile').val().length<11) || Number($('#userMobile').val().length>11) || $('#userMobile').val().substring(0, 2)!=='01'){
            $('#mobileError').html('Valid Mobile Number must be 11 digit')
            $('#nextbtn').attr('disabled',true)
            return true;
        }else {
            $('#mobileError').html('')
            $('#nextbtn').attr('disabled',false)
        }


        $.ajax({
            url:'{{url("/check-unique-user")}}'+'/'+$('#userMobile').val() ,
            type: 'GET',
            'dataType' : 'json',
            success: function(data) {
                if (data.userData===null){
                    $('#nextbtn').attr('disabled',false)
                    $('#mobileError').html('')
                }else {
                    $('#nextbtn').attr('disabled',true)
                    $('#mobileError').html('Mobile Number Already Taken')
                }
            }
        })
    })
</script>

<script>

    window.onscroll = function() {navBarFixedTop()};

    var topBar = document.getElementById("topBarFixed");
    var sticky = topBar.offsetTop;


    function navBarFixedTop() {

        console.log(sticky)

        //console.log(window.pageYOffset)

        if (window.pageYOffset > sticky) {
            topBar.classList.add("sticky")
        } else {
            topBar.classList.remove("sticky");
        }
    }
</script>

<script>

    //$('#userEmail').on('blur',function () {
        $('#clientReg').on('submit',function (event) {

            event.preventDefault()
//            $('#clientReg').submit(function (e) {
//                preventDefault()
//            })

            if ($('#userEmail').val().length>0){

                $.ajax({
                    url:'{{url("/check-unique-user")}}'+'/'+$('#userEmail').val() ,
                    type: 'GET',
                    'dataType' : 'json',
                    success: function(data) {
                        if (data.userData===null){
                            console.log($('#userEmail').val()+'emailBlock')
                            $('#emailError').html('')
                            $('#clientReg').unbind().submit();
                        }else {
                            //$('#nextbtn').attr('disabled',true)
                            $('#emailError').html('Email Already Taken')
                            event.preventDefault()
                        }
                    }
                })
            }else {

                $('#clientReg').unbind().submit(function () {
                    return confirm('Check again that, everything is correct !')
                });

            }

        })


</script>



@yield('script')
<!-- End Footer -->
</body>
</html>