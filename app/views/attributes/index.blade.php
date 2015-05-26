
{{ Form::open([
    'route' => 'attributes.save',
    'method' => 'post',
    'role' => 'form',
    'name' => 'create_attributes'
  ]) }}  
    <div>Field:<select name="field_type" id="field_type" >
        <option value="select">Select</option>
        <?php foreach ($fields as $field) { ?>
        <option value="{{{$field->id}}}">{{{$field->name}}}</option>
        <?php }?>
    </select>
        
    Name<input type='text' name='field_name'>
    Label<input type='text' name='field_label'>
    Value<input type='text' name='field_value'>
    <button type="submit" class="btn btn-default btn-lg" tabindex="4">Save Attributes</button>
{{ Form::close() }}

@if(isset($msg))
{{{$msg}}}
@endif