<footer class="footer_all">
    <div class="footer">
        <div class="container spacer b-t">

            <div class="footer-top d-flex justify-content-between">
                <div class="footer-logo"> <img class="img-fluid" src="{{asset('/frontend')}}/images/footer-logo.png" alt="footer-logo"> </div>
                <div class="footer-subscribe">
                    <div class="input-group mb-3">
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-lg-9 col-md-9 m-b-30">
                    <ul class="p-0">
                        <li><a href="javascript:void(0)" >&copy;Copyright {{date('Y')}} </a></li>
                        @if(count($footerPage)>0)
                            @foreach($footerPage as $paeData)
                            <li><a href="{{URL::to('/page/'.$paeData->link)}}" > {{$paeData->name}} </a></li>
                            @endforeach


                        @endif
                    </ul>
                </div>

                <div class="col-lg-3 col-md-3 m-b-30">
                    <ul class="list-unstyled d-flex p-0 soical-icon">
                        <li class="mr-2"><a href="https://www.facebook.com/gopaibaa/" target="_blank"><i class="fa fa-facebook-f"></i> </a></li>
                        <li class="mr-2"><a href="#"><i class="fa fa-twitter"></i> </a></li>
                        <li class="mr-2"><a href="#"><i class="fa fa-google-plus"></i> </a></li>
                        <li class="active"><a href="#"><i class="fa fa-linkedin"></i> </a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- End Footer -->

<div class="top_awro pull-right" id="back-to-top" data-original-title="" title=""><i class="fa fa-chevron-up" aria-hidden="true"></i> </div>
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
</script>
<script src="{{asset('/backend/assets/sweetalert2.all.min.js')}}"></script>
<script src="{{asset('/js/tinymce/tinymce.min.js')}}"></script>

<script src="{{asset('/frontend')}}/js/custom.js"></script>
<script src="{{asset('/frontend')}}/js/price_range_script.js"></script>

<script src="{{asset('/frontend')}}/js/jquery-ui.js"></script>
<script src="{{asset('/frontend')}}/select2/select2.full.min.js"></script>

<script>
    $('form').on('submit',function(){
        var button = $(this).find('button[type=submit]')
        //button.html('<i class="fa fa-spinner fa-pulse"></i> In progress')
        //button.attr('type','button')
    })
</script>
<script>
    function deleteConfirm(id){
        swal({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.value) {
            $("#"+id).submit();
        }
    })
    }
</script>

@if(Session::has('success'))
    <script type="text/javascript">
        swal({
            type: 'success',
            title: '{{Session::get("success")}}',
            showConfirmButton: true,
            timer: 2000
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