@if(count($areas)>0)
    {{Form::select('area_id',$areas,[],['class'=>'form-control','placeholder'=>'Select Area','required'=>true])}}
@else
    {{Form::select('area_id',[],[],['class'=>'form-control','placeholder'=>'No Area Found !','required'=>true])}}
@endif