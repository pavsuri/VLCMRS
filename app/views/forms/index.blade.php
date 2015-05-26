{{ Form::open([
    'route' => 'forms.saveform',
    'method' => 'post',
    'role' => 'form',
    'name' => 'create_form'
  ]) }}  
Form Name <input type="text"  id="name" name="name"  ><br>
Type Id <input type="text" id="type_id" name="type_id"><br>
<button type="submit" class="btn btn-default btn-lg" tabindex="4">Create Form</button>
{{ Form::close() }}