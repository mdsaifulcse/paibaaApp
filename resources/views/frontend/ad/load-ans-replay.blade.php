@if(count($ansReplay)>0)
    <div id="ansReplay_{{$ansId}}">
        @foreach($ansReplay as $replay)
            <div class="row m-t-20">
                <div class="col-md-1 col-sm-3">
                    <div class="">
                        @if(!empty($replay->replayAuthor->image))
                            <a href="{{URL::to('/profile/'.$replay->replayAuthor->user_name)}}">
                                <img class="" src="{{asset($replay->replayAuthor->image)}}" style="width: 50px;border-radius: 50%"></a>
                        @else
                            <a href="{{URL::to('/profile/'.$replay->replayAuthor->user_name)}}">
                                <img class="" src="{{asset('/images/default/photo.png')}}" style="width: 50px;border-radius: 50%"></a>
                        @endif
                    </div>

                </div>
                <div class="col-md-11 col-sm-9">

                    <h6> <a href="{{URL::to('/profile/'.$replay->replayAuthor->user_name)}}">
                            <strong>{{$replay->replayAuthor->name}}</strong></a>
                        {{$replay->created_at->diffForHumans()}}
                    </h6>
                    <h6> {{$replay->replay}}</h6>

                    @if(Auth::check() && $replay->user_id==Auth::user()->id)
                    {!! Form::open(array('route' => ['blog-ans-replay.destroy',$replay->id],'method'=>'DELETE','id'=>"deleteForm$replay->id","class"=>"pull-right")) !!}

                    <button type="button" class="btn btn-danger btn-xs " value="button" onclick='return deleteConfirm("deleteForm{{$replay->id}}")' title="Click here to delete your replay" style="cursor: pointer;">  <i class="fa fa-trash"></i>
                    </button>

                    {!! Form::close() !!}
                        @endif

                </div>
            </div>
        @endforeach
    </div>
    <button class="btn btn-info btn-sm m-t-10" onclick="viewReplayData({{$ansId}})" id="viewReplay_{{$ansId}}" style="display: none"> View Replay</button>
    <button class="btn btn-info btn-sm m-t-10" onclick="hideReplayData({{$ansId}})" id="hideReplay_{{$ansId}}"> Hide Replay</button>

    @else

    <div class="text-center"> No Replay Available </div>

@endif