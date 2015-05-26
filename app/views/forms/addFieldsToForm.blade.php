<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
<h2>{{{$formData->name}}}</h2>
{{ Form::open([
    //'route' => 'forms.saveattributes',
    'method' => 'post',
    'role' => 'form',
    'name' => 'add_fields'
  ]) }}
      <input type="hidden" name="form_id" id="form_id" value="{{{$formData->id}}}" >
    Field:<select name="field_type" id="field_type"  onchange="getAttributes(this.value)">
        <option value="">Select</option>
        <?php foreach ($fields as $field) { ?>
        <option value="{{{$field->id}}}">{{{$field->name}}}</option>
        <?php }?>
         <option value="all">All</option>
    </select>

    <button type="submit" class="btn btn-default btn-lg" tabindex="4">Add fields to Form</button>
{{ Form::close() }}

<script>
function getAttributes(fieldId) {
        if (fieldId.length > 0) {
            $.ajax({
                type: "GET",
                url: "/getFieldAttributes/"+fieldId,
                data: {
                    'field_id': fieldId
                },
                dataType: "text",
                success: function(msg) {
                    alert(msg);
                }
            });
        }
}
</script>