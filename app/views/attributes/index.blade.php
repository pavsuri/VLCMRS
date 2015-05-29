<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
{{ Form::open([
    'route' => 'attributes.save',
    'method' => 'post',
    'role' => 'form',
    'name' => 'create_attributes'
  ]) }}  
    <div>Field:<select name="field_type" id="field_type" onChange="javascript:addOptions();" >
        <option value="select">Select</option>
        <?php foreach ($fields as $field) { ?>
        <option value="{{{$field->id}}}">{{{$field->name}}}</option>
        <?php }?>
    </select>
        
    Name<input type='text' name='field_name'>
    Label<input type='text' name='field_label'>
    Value<input type='text' name='field_value'>
    <div id="options" ></div>
    <button type="submit" class="btn btn-default btn-lg" tabindex="4">Save Attributes</button>
{{ Form::close() }}

@if(isset($msg))
{{{$msg}}}
@endif

<script>
function addOptions() {
   var selectedFieldType = $('#field_type>option:selected').text();
   if (selectedFieldType == 'selectbox' || selectedFieldType == 'checkbox' || selectedFieldType == 'radio') {
        selectboxOptions();
    } else {
        $('#options').html('');
    }
}
 function selectboxOptions() {
        var optionAttributes = "<input type='text' name='optionLabels[]'> <input type='text' name='optionValues[]'> <a href='#' onClick='appendOptions(); return false;' > Add Option </a><br>";
        $('#options').html(optionAttributes);
    }
    
 function appendOptions() {
      var optionAttributes = "<input type='text' name='optionLabels[]'> <input type='text' name='optionValues[]'> <a href='#' onClick='appendOptions(); return false;' > Add Option </a><br>";
        $('#options').append(optionAttributes);
    }
</script>