@if(count($categoryWiseLocations)>0)
    @foreach($categoryWiseLocations as $location)
        <a href="{{URL::to('ads/'.$location->locationByCat->url.'/'.'bangladesh')}}">{{$location->locationByCat->location_name}}</a>
    @endforeach
@else
    <a href="javascript:void(0)"> No Location </a>
@endif