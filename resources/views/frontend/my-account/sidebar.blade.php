<div class="dashboard_menu">
    <div class="dashbord_img">
        <div class="dashboard_back"> <img class="img-fluid w-100" src="{{asset('/frontend')}}/images/dash-background.png" alt="Classified Plus"> </div>
        <div class="rounded_img">
            @if(!empty(Auth::user()->image))
            <img class="img-fluid" src="{{asset(Auth::user()->image)}}" alt="Classified Plus">
                @else
                <img class="img-fluid" src="{{asset('/')}}images/default/photo.png" alt="Classified Plus">

            @endif
        </div>
        <div class="aditya">{{Auth::user()->name}}</div>

    </div>
    <ul class="list-unstyled  m-t-20">
        {{--<li><span><i class="fa fa-sliders"></i></span><a href="{{URL::to('/')}}"> Dashboard </a></li>--}}
        <li class=" @if(Request::path()=='my-ads') active @else '' @endif "><span><i class="fa fa-database"></i></span><a href="{{URL::to('/my-ads')}}"> My Ads </a></li>
        <li class=" @if(Request::path()=='ad-post/create') active @else '' @endif "><span><i class="fa fa-database"></i></span><a href="{{URL::to('/ad-post')}}"> Post New Ad </a></li>
        <li class=" @if(Request::path()=='my-profile') active @else '' @endif "><span><i class="fa fa-cog"></i></span><a href="{{URL::to('/my-profile')}}"> Profile Settings </a></li>
        <li class=" @if(Request::path()=='change-my-username') active @else '' @endif "><span><i class="fa fa-cog"></i></span><a href="{{URL::to('/change-my-username')}}"> Set Username </a></li>
        <li><span><i class="fa fa-sign-in"></i></span><a href="javascript:void(0)" onclick="event.preventDefault(); document.getElementById('logoutForm').submit()"> Logout </a></li>
    </ul>
</div>