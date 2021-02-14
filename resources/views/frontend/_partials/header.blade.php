<div class="topbar ">
    <!-- Header  -->
    <div class="header" >
        <div class="container-fluid">

            {{--<nav class="navbar navbar-expand-lg hover-dropdown header-nav-bar"> <a href="01-Home-Page.html" class="navbar-brand ">
                    <img src="{{asset('/frontend')}}/images/logo.png" alt="Paibaa | Khojlei Paibaa" class="img-responsive">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#h5-info" aria-expanded="false" aria-label="Toggle navigation"><i class="fa fa-bars"></i></button>
                <div class="collapse navbar-collapse" id="h5-info">



                    <div class="header_r d-flex">
                        @if(Auth::check())
                            <ul class="navbar-nav">
                                <li class="nav-item dropdown auth-user">
                                    <a class="nav-link dropdown-toggle" href="01-Home-Page.html#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{Auth::user()->name}}</a>
                                    <ul class="b-none dropdown-menu font-14 animated fadeInUp">
                                        <li><a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a></li>
                                        {!! Form::open(['route'=>'logout','method'=>'POST','id'=>'logout-form','style'=>'display:none']) !!}
                                        {!! Form::close() !!}

                                    </ul>
                                </li>
                            </ul>
                        @endif

                        @if(!Auth::check())
                            <div class="loin">
                                <a class="nav-link" href="01-Home-Page.html#" data-toggle="modal" data-target="#login">Sign In</a>
                            </div>
                            <div class="loin">
                                <a class="nav-link" href="01-Home-Page.html#" data-toggle="modal" data-target="#register">Register</a>
                            </div>
                        @endif



                        <ul class="ml-auto post_ad">
                            <li class="nav-item search"><a class="nav-link" href="20-Post_Ad-Page.html">Post Your Ad</a></li>
                        </ul>
                    </div>
                </div>
            </nav>--}}



            <div class="row "  id="topBarFixed">
                <div class="col-lg-1 col-md-1 col-sm-12  desktop-logo">
                    <a href="{{URL::to('/')}}" class="navbar-brand ">
                        <img src="{{asset('/frontend')}}/images/logo.png" alt="Paibaa | Khojlei Paibaa" class="img-responsive">
                    </a>
                </div>

                <div class="@if(Auth::check()) col-md-8 col-lg-8 @else col-lg-8 col-md-8 @endif col-sm-12">
                    <div>
                        <?php
                        $pathUrl=request()->path();
                        //echo $area_id;
                        ?>

                        {!! Form::open(['url'=>'','class'=>'book-now-home','method'=>'GET','id'=>'mainSearch']) !!}

                            <div class="form-group selectdiv">
                                <?php $path=request()->segment(count(request()->segments()));?>

                            @if(isset($adDetails))
                            {{Form::select('catLink',$categoryArr,$adDetails->postCategory->link,['id'=>'catLink','class'=>'form-control border-right-0 text-truncate','placeholder'=>'Select Category','required'=>true])}}

                                @else
                            {{Form::select('catLink',$categoryArr,$path,['id'=>'catLink','class'=>'form-control border-right-0 text-truncate','placeholder'=>'Select Category','required'=>true])}}

                                @endif
                            </div>

                            <div class="form-group search-file">
                                <input type="text" value="" name="by_playing_user" class="form-control text-truncate" placeholder="What are you looking for" required >
                            </div>

                            <button type="submit" class="btn btn-primary booknow btn-skin"><i class="fa fa-search"></i> Search</button>
                        {!! Form::close() !!}
                    </div>
                </div>

                <div class="@if(Auth::check())col-lg-3 col-md-3 @else col-lg-3 col-md-3 @endif col-sm-12">
                    <div class="header_r d-flex">
                        <div class="loin">

                            @if(Auth::check())

                                <div class="dropdown my-account-dropdown ">
                                    <a href="#" class=" dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user-circle-o"></i> {{substr(Auth::user()->name, 0,16)}}
                                        <span class="caret"></span>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li><a href="{{URL::to('/profile/'.Auth::user()->user_name)}}">Public Profile</a></li>
                                        <li><a href="{{URL::to('/my-ads')}}">My Ads</a></li>
                                        <li><a href="{{URL::to('/my-profile')}}">Profile Setting</a></li>
                                        <li><a class="nav-link1" href="{{ url('/logout') }}" onclick="event.preventDefault(); document.getElementById('logoutForm').submit()"><i class="fa fa-sign-out" aria-hidden="true"></i>Sign Out</a></li>
                                    </ul>
                                </div>

                                <div class="dropdown notification">
                                    <a href="#" class=" dropdown-toggle" data-toggle="dropdown"><i class="fa fa-comments" aria-hidden="true"></i> {{$countUnreadMessage}}  </a>
                                    <ul class="dropdown-menu">

                                        @if(count($notification)>0)
                                            @foreach($notification as $key=>$data)
                                                <?php
                                                $userId='';
                                                    if ($data['offer']==1){
                                                        $userId=$data['request_by'];
                                                        $userName=$data['offered_user']['name'];
                                                        $userImg=$data['offered_user']['image'];
                                                    }else{
                                                        $userId=$data['request_to'];
                                                        $userName=$data['replay_user']['name'];
                                                        $userImg=$data['replay_user']['image'];
                                                    }

                                                    if ($data['status']==0){
                                                        $className='unreadMessage';
                                                    }else{
                                                        $className='readMessage';
                                                    }

                                                    ?>

                                                <li class="message-notification">
                                                    <a class="{{$className}}" href="{{URL::to('ad/'.$data['link'].'?user='.encrypt($userId).'&offer='.encrypt($data['offer']))}}">
                                                        <img src="{{asset($userImg)}}" style="width: 28px; border-radius: 50%"> <strong>{{$userName}}</strong> : {{substr($data['request_message'],0,40)}} ...

                                                    </a>
                                                </li>

                                            @endforeach

                                        @endif

                                    </ul>
                                </div>

                                <form id="logoutForm" method="POST" action="{{route('logout')}}" style="display: none">
                                    {{csrf_field()}}
                                </form>

                                @else
                                <div class="header_r d-flex">
                                <div class="loin">
                                    <a class="nav-link" href="{{URL::to('/login')}}">Sign In</a>
                                </div>
                                <div class="loin">
                                    <a class="nav-link" href="{{URL::to('/register')}}">Register</a>
                                </div>
                                </div>
                                {{--<div class="dropdown my-account-dropdown ">
                                    <a href="{{URL::to('/login')}}" class=" dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user-circle-o"></i>
                                        <span class="caret"></span> Account
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li><a href="{{URL::to('/register')}}">Create New Account</a></li>
                                        <li><a href="{{URL::to('/login')}}"> Login In </a></li>
                                    </ul>
                                </div>--}}
                                @endif
                        </div>
                        <ul class="ml-auto post_ad">
                            <li class="nav-item search"><a class="nav-link" href="{{URL::to('/ad-post')}}">Post Your Ad</a></li>
                        </ul>
                    </div>


                </div>
            </div>






        </div> <!-- end container -->


        <div class="container po-relative">
            <nav class="navbar navbar-expand-lg hover-dropdown header-nav-bar desktop-visible">
                <a href="{{URL::to('/')}}" class="navbar-brand d-block  d-md-none d-sm-block ">
                    <img src="{{asset('/frontend')}}/images/logo.png" alt="Paibaa | Khojlei Paibaa" class="img-responsive">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#h5-info" aria-expanded="false" aria-label="Toggle navigation"><i class="fa fa-bars"></i></button>
                <div class="collapse navbar-collapse" id="h5-info">
                    <ul class="navbar-nav">
                        @if(count($categories)>0)
                            <?php  $path=request()->segment(count(request()->segments()));?>
                            @foreach($categories as $categoryData)
                                <li class="nav-item">
                                    <a id="{{'categoryId-'.$categoryData->id}}" class="ad-category nav-link @if(isset($adDetails) && $adDetails->category_id==$categoryData->id) active @endif  @if($path==$categoryData->link) active @else '' @endif
                                       @if(isset($category) && $category->id==$categoryData->id) active @else '' @endif"  href="{{URL::to('ads/bangladesh/'.$categoryData->link)}}">
                                        {{$categoryData->category_name}}
                                    </a>
                                </li>
                            @endforeach
                        @endif
                    </ul>
                </div>
            </nav>
        </div>

    </div><!-- end header -->


    <!-- End Header  -->
</div>
