
<div class="form-group">
	{{Form::label('sub_category_id', 'Sub Category* :', array('class' => 'col-md-2 control-label'))}}
	<div class="col-md-10">
		{{Form::select('sub_category_id[]',$subCategory,'', ['class' => 'form-control select','data-placeholder'=>'Select Sub Category','multiple','required'])}}
	</div>
</div>
<div class="form-group">
	{{Form::label('part_of', 'Part of Field:', array('class' => 'col-md-2 control-label'))}}
	<div class="col-md-4">
		{{Form::select('part_of',$partOf,'', ['class' => 'form-control select','placeholder'=>'Select Field'])}}
	</div>
</div>


<script type="text/javascript">
    $(".select").chosen({});
       
</script>