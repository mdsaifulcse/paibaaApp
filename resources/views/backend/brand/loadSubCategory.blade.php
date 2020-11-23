@if(count($subCategory)>0)
    {{Form::select('sub_category_id[]', $subCategory, [], ['class' => 'form-control select2','multiple'=>true,'required'=>true])}}

@else


	{{Form::select('sub_category_id[]', [], [], ['class' => 'form-control ','placeholder'=>'No Sub Category Found !','multiple'=>false,'required'=>true])}}


@endif

	<script type="text/javascript">
        $('.select2').select2({
            placeholder: "Select Sub-category"
        })

	</script>

