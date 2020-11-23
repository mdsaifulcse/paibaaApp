

@if(count($areas)>0)
    <style>
        .select2-container{
            background-color: #fbfbfb !important;
            padding: 0px !important;
            display: inline-block;
        }
        .profile_detail input, .change_password input{
            height: unset;
        }
    </style>
    {{Form::select('area_id[]',$areas,[],['class'=>'col-md-12 select2 select form-control','multiple'=>true,'placeholder'=>'Select Area','required'=>true])}}
    @else
    {{Form::select('area_id[]',[],[],['class'=>'col-md-12 form-control','placeholder'=>'No Area Found !','required'=>true])}}
@endif
    <script>
        $('.select2').select2({
            placeholder: "Select Specific area"
        })
    </script>
