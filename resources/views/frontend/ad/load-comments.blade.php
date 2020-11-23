@if(count($comments)>0)
    @foreach($comments as $comment)
        <div class="row m-t-20">
            <div class="col-md-1 col-sm-3">
                <div class="">
                    @if(!empty($comment->commentAuthor->image))
                        <a href="{{URL::to('/profile/'.$comment->commentAuthor->user_name)}}">
                            <img class="" src="{{asset($comment->commentAuthor->image)}}" style="width: 50px;border-radius: 50%"></a>
                    @else
                        <a href="{{URL::to('/profile/'.$comment->commentAuthor->user_name)}}">
                            <img class="" src="{{asset('/images/default/photo.png')}}" style="width: 50px;border-radius: 50%"></a>
                    @endif
                </div>

            </div>
            <div class="col-md-11 col-sm-9">

                <h6> <a href="{{URL::to('/profile/'.$comment->commentAuthor->user_name)}}">
                        <strong>{{$comment->commentAuthor->name}}</strong></a>
                    {{$comment->created_at->diffForHumans()}}
                </h6>
                <h6> {{$comment->comment}}</h6>

                {!! Form::close() !!}
            </div>
        </div>
    @endforeach

@endif