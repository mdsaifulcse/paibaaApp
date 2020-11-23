@extends('frontend.master')

@section('title')
    {{$adDetails->title}} | paibaa | khujlei paibaa
@endsection

@section('style')
    <link rel="stylesheet" href="{{asset('/frontend')}}/css/owlcarousel/owl.carousel.min.css" />
    <link rel="stylesheet" href="{{asset('/frontend')}}/css/owlcarousel/owl.theme.default.min.css" />
@endsection

@section('content')

    <div class="iner_breadcrumb p-t-0 p-b-0">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{URL::to('/')}}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{URL::to('ads/bangladesh/'.$adDetails->postCategory->link)}}">{{$adDetails->postCategory->category_name}}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">
                        <a href="{{URL::to('ads/bangladesh/'.$adDetails->postCategory->link.'?subcategory='.$adDetails->adSubCategory->first()->id)}}">{{$adDetails->adSubCategory->first()->sub_category_name}}
                        </a>
                    </li>
                    <li class="breadcrumb-item " aria-current="page">{{$adDetails->title}}</li>
                </ul>
            </nav>
        </div>
    </div>


    <section class="detail_part m-t-5">
        <div class="container">
            <div class="row">
                <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 col-12">
                    <div class="detail_box">
                        <div class="detail_head">
                            <p><a href="{{URL::to('/profile/'.$adDetails->postAuthor->user_name)}}"> {{$adDetails->postAuthor->name}} </a>
                                {{--<a href="{{URL::to('/profile/'.$adDetails->postAuthor->user_name)}}" class="pull-right"> View author all Ads </a>--}}
                            </p>

                        </div>

                    </div>
                    <div class="description_box">
                            <h4 class="m-b-15 text-danger">{{$adDetails->title}}</h4>
                            <h6 class="m-b-10">
                                <span class="text-muted">Written By</span>
                                <a href="{{URL::to('/profile/'.$adDetails->postAuthor->user_name)}}">{{$adDetails->postAuthor->name}}
                                </a>
                                <span class="text-muted"><i class="fa fa-clock-o them-color"></i> {{date('M, d, Y h:i a',strtotime($adDetails->updated_at))}}</span>
                            </h6>

                        <?php echo $adDetails->description;?>

                        <div class="detail_box owl-carousel owl-theme">
                            @if(file_exists('images/post_photo/big/'.$adDetails->postPhoto->photo_one))
                            <div>
                                <img class="img-fluid" src="{{asset('images/post_photo/big/'.$adDetails->postPhoto->photo_one)}}" alt="{{$adDetails->title}}">
                            </div>
                            @endif



                        @if($adDetails->postPhoto->photo_two!='')
                            <div><img class="img-fluid" src="{{asset('images/post_photo/big/'.$adDetails->postPhoto->photo_two)}}" alt="{{$adDetails->title}}"></div>
                        @endif

                        @if($adDetails->postPhoto->photo_three!='')
                            <div><img class="img-fluid" src="{{asset('images/post_photo/big/'.$adDetails->postPhoto->photo_three)}}" alt="{{$adDetails->title}}"></div>
                        @endif
                        @if($adDetails->postPhoto->photo_four!='')
                            <div><img class="img-fluid" src="{{asset('images/post_photo/big/'.$adDetails->postPhoto->photo_four)}}" alt="{{$adDetails->title}}"></div>
                        @endif

                        </div>
                    </div>


                    <!-- post answer start -->

                    <hr>
                    <strong id="editAns"></strong>
                    <h5 class=" p-1 text-warning">Edit Your answer <a href="{{URL::to('ad/'.$adDetails->link)}}" class="pull-right">  <i class="fa fa-angle-double-left"></i> Back</a></h5>
                    {!! Form::open(['route'=>['blog-answer.update',$blogAnswer->id],'method'=>'PUT','id'=>'answerFormEdit','data-route'=>'ad-public-comment']) !!}

                    <input type="hidden" name="user_id" value="{{Auth::check() && Auth::user()->id}}" id="userId">
                    <input type="hidden" name="ad_post_id" value="{{$adDetails->id}}" id="adPostId">

                    <textarea name="answer" class="form-control textarea type-pass" id="description" placeholder="Write few lines about this post" rows="7"><?php echo $blogAnswer->answer;?></textarea>

                    <strong class="text-default pull-right description-error">
                        <span id="character_count" >0</span> /400
                    </strong>

                    @if ($errors->has('answer'))
                        <span class="help-block">
                            <strong class="text-danger">{{ $errors->first('answer') }}</strong>
                        </span>
                    @endif

                    <span id="descriptionError" class="text-danger"></span>

                    <div class="answerSubmitCancel m-t-5 " style="display: block">
                        {{--<span class="btn btn-default cancel">CANCEL</span> &nbsp;&nbsp;&nbsp;&nbsp;--}}
                        <button type="submit" class="btn btn-warning" id="answerSubmitEdit" onclick="return ValidateCharacterLength();"> Save Change </button>
                    </div>

                    {!! Form::close() !!}


                    <!-- post answer end -->


                </div><!-- end col-8 -->

                </div><!-- end row -->
        </div><!-- end container -->
    </section>



@endsection



@section('script')


    <script>

        // create answer -------------


        window.onload = function () {
            tinymce.init({
                selector: '.textarea',
                menubar: false,
                theme: 'modern',
                plugins: 'image code link lists textcolor imagetools colorpicker ',
                browser_spellcheck: true,
                toolbar1: 'formatselect | bold italic strikethrough | link image | alignleft aligncenter alignright alignjustify  | numlist bullist outdent indent  | removeformat',
                // enable title field in the Image dialog
                image_title: true,
                setup: function (ed) {
                    ed.on('keyup', function (e) {
                        var count = CountCharacters();
                        document.getElementById("character_count").innerHTML = "Characters: " + count;
                    });
                }
            });
        }

        function CountCharacters() {
            var body = tinymce.get("description").getBody();
            var content = tinymce.trim(body.innerText || body.textContent);
            return content.length;
        };


        function ValidateCharacterLength() {
            var max = 400;
            var count = CountCharacters();
            if (count > max) {
                alert("Maximum " + max + " characters allowed.")
                return false;
            }else if(count<=50) {
                alert("Minimum " + 50 + " characters required.")
                return false;
            }else{

                return;
            }
        }






    </script>
















    {{--Comment Section ------------}}
    <script>
        function openCommentBox(value) {

            $('.submitCancel').css('display','block')

            if(value.length>0){
                $('#commentSubmit').attr('disabled',false)
            }else {
                $('#commentSubmit').attr('disabled',true)
            }

            var commentText=value.replace('http://','')
             commentText=commentText.replace('https://www.','')
             commentText=commentText.replace('https://','')
             commentText=commentText.replace('http://www.','')
             commentText=commentText.replace('paibaa.com','https://www.paibaa.com')
            $('#comment').val(commentText)



            if(value.length>200){
                $('#commentSubmit').attr('disabled',true)
                $('.comment-error').text('Max 200 Character')
                $('.comment-error').css('display','block')
            }else {
                $('.comment-error').text('')
                $('.comment-error').css('display','none')
                $('#commentSubmit').attr('disabled',false)
            }

        }


        // hide submit button -----------------------
        $('.cancel').on('click',function () {
            $('.submitCancel').css('display','none')
        })


        //  ========  Submit comment  ========
        $('#commentForm').submit(function (e) {
            e.preventDefault()

            {{--if($('#userId').val()==''){--}}
                {{--window.location.href='{{URL::to('/login')}}'--}}
            {{--}--}}

            if($('#comment').val().length>0){
                $('#commentSubmit').attr('disabled',false)
                $('.comment-error').css('display','none')

                var route=$('#commentForm').data('route');
                //console.log($('#commentForm').serialize());

                $.ajax({
                    type: 'get',
                    url:"{{URL::to('/ad-public-comment-save')}}",
                    data:$('#commentForm').serialize(),

                    success:function (data) {

                        if (data=='success'){
                             console.log('321')
                            $('#comment').val('')
                            $('#commentSubmit').attr('disabled',true)
                            // comment load comments data ----------
                            loadData($('#adPostId').val())
                        }

                         if(data.adPostComment){
                            $('.comment-error').css('display','block')
                            $('.comment-error').text('Only one Comment a day')
                        }
                    },
                    error:function (error) {
                        if(error.status==401){
                            var adPostId=$('#adPostId').val()
                            window.location.href='{{URL::to('/ad-public-comment-save')}}'+'?ad_post_id='+adPostId
                        }
                    }
                })

            }else {
                $('#commentSubmit').attr('disabled',true)
                $('.comment-error').css('display','block')
                return false;
            }
        })

        function loadData(adPostId) {
            $('#commentData').empty().load('{{URL::to("load-comments-data")}}'+'/'+adPostId)
        }


        $('#seeMoreComment').on('click',function () {
            loadData($('#adPostId').val())

            $('#seeMoreComment').hide();
        })

    </script>


    <script>
        function makeOffer() {
            $('#offerPrice').val($('#offer_price').val())

            $('#priceDealModal').modal('show')
        }
    </script>


    <script src="{{asset('/frontend')}}/js/owlcarousel/owl.carousel.min.js"></script>


    <script>
        $(document).ready(function(){
            $(".owl-carousel").owlCarousel(
                {
                    stagePadding: 50,loop:true,margin:0,nav:true,
                    responsive:{
                        0:{ items:1 },
                        600:{ items:1},
                        1000:{items:1}
                    },
                    center:true,autoWidth:true, navText:["<i class=\"fa fa-angle-left\" aria-hidden=\"true\"></i>","<i class=\"fa fa-angle-right\" aria-hidden=\"true\"></i>"],
                    dots:false

                }
            );
        });
    </script>



@endsection