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

    <link rel="stylesheet" href="{{asset('/frontend')}}/css/price_range_style.css" />
    <link rel="stylesheet" href="{{asset('/frontend/select2/select2.min.css')}}">


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

        $('#findLocation').on('click',function () {
            if ($('#locationKeyword').val()===''){
                return false
            }else {

                var category=$('#catLink option:selected').val()
                if (category==''){
                    category='no-sub-cat';
                }
                $('#locationResult').empty().load('{{URL::to("search-nav-location")}}/'+category+'?locationKeyword='+$('#locationKeyword').val());
                $('#locationResult').show()
                $('#defaultLocation').hide()
                $('#showDefaultLocation').show()
            }

        })


        $('#showDefaultLocation').on('click',function () {

            $('#defaultLocation').show()
            $('#locationResult').hide()
            $('#showDefaultLocation').hide()
        })

    </script>

    <script>

        $('#findCategory').on('click',function () {
            if ($('#catKeywords').val()===''){
                return false
            }else {

                var category=$('#catLink option:selected').val()
                if (category==''){
                    category='no-sub-cat';
                }

                $('#categoryResult').load('{{URL::to("search-nav-sub-category")}}/'+category+'?catKeyword='+$('#catKeywords').val());

                $('#categoryResult').show()
                $('#defaultCategory').hide()
                $('#showDefaultCategory').show()
            }

        })


        $('#showDefaultCategory').on('click',function () {
            $('#defaultCategory').show()
            $('#categoryResult').hide()
            $('#showDefaultCategory').hide()
        })

    </script>


    <script>

        <?php  $path=Request::path()?>

       @if($path=='/' || $path=='ad-post' || $path=='ad-post/create')
        $("#catLink").attr('required',false)

        $("#catLink option:selected").text('Search Everything')

        $('#mainSearch').attr('action', "{{URL::to('/')}}")

        @elseif('profile'==strpos($path,'profile') || 'page'==stripos($path,'page') || 'tag'==strpos($path,'tag') || 'price'==strpos($path,'price'))
        $("#catLink").attr('required',false)

        $("#catLink option:selected").text('Search Everything')

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


        $('.select2').select2({
            placeholder: "Select option"
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

        if (window.pageYOffset > sticky) {
            topBar.classList.add("sticky")
        } else {
            topBar.classList.remove("sticky");
        }
    }
</script>

<script>
        $('#clientReg').on('submit',function (event) {

            event.preventDefault()

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