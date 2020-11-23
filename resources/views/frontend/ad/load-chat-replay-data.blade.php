@if(count($getChatReplayData)>0)
    @foreach($getChatReplayData as $replay)
        <div class="row m-b-10 conversation">
            <div class="col-md-2 col-sm-3">
                <div class="">
                    @if($replay->offer==1)
                        <a href="{{URL::to('/profile/'.$replay->offeredUser->user_name)}}">
                        <img class="chat-user-img" src="@if(!empty($replay->offeredUser->image)) {{asset($replay->offeredUser->image)}} @else {{asset('/images/default/photo.png')}} @endif ">
                        </a>
                    @elseif($replay->offer==2)
                        <a href="{{URL::to('/profile/'.$replay->replayUser->user_name)}}">
                        <img class="chat-user-img" src="@if(!empty($replay->replayUser->image)) {{asset($replay->replayUser->image)}} @else {{asset('/images/default/photo.png')}} @endif ">
                        </a>
                    @endif

                </div>
            </div>
            <div class="col-md-10 col-sm-9">

                @if($replay->offer==1)
                    <h6 class="user-time">
                        <a href="{{URL::to('/profile/'.$replay->offeredUser->user_name)}}">
                            <strong>{{$replay->offeredUser->name}} </strong></a>

                        {{$replay->created_at->diffForHumans()}} </h6>
                @elseif($replay->offer==2)
                    <h6 class="user-time">
                        <a href="{{URL::to('/profile/'.$replay->replayUser->user_name)}}">
                            <strong>{{$replay->replayUser->name}} </strong></a>

                        {{$replay->created_at->diffForHumans()}} </h6>
                @endif

                <h6> {{$replay->request_message}}

                    @if($replay->price_message!='')
                        <br>
                        Price: {{$replay->price_message}}
                    @endif
                </h6>

                {!! Form::close() !!}
            </div>
        </div>
    @endforeach

@else
    <h5>No Chat History !</h5>

@endif