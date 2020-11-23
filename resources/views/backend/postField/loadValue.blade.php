<div class="form-group {{ $errors->has('value') ? 'has-error' : '' }}">
			{{Form::label('value', 'Value* :', array('class' => 'col-md-2 control-label'))}}
			<div class="col-md-10">
			<input name="value" id="tagboxField" value="" type="hidden">
				<ul id="tagbox"></ul>
				<span>For white space, use underscore ( _ )</span>
				@if ($errors->has('value'))
                    <span class="help-block">
                        <strong>{{ $errors->first('value') }}</strong>
                    </span>
	            @endif
			</div>
			
		</div>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript" src="{{asset('public/backend/plugin/tagbox/js/tag-it.min.js')}}"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $(function(){

            $('#tagbox').tagit({
                allowSpaces: true,
                singleField: true,
                singleFieldNode: $('#tagboxField')
            });

            
        });
    });
</script>