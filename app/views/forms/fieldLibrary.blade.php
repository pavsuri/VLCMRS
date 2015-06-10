@extends('layout.empty')

@section('title')Create Form @endsection

@section('content')
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 title-content">
        <div class="cms-page-title">
            <h1>Field Library</h1>
        </div>					
    </div>
</div>
<!-- END of .row -->
<div class="right-section-content">
    <div class="select-form">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="form-group">
                    <label for="select-form" class="col-xs-12 col-sm-3 col-md-3 col-lg-3 control-label">Select Field</label>
                    <div class="col-xs-12 col-sm-8 col-md-7 col-lg-7">
                        <select class="selectpicker"  id="fieldId" data-style="btn-inverse" onchange="getAttributesByField(this.value);"> 
                            <option>Select Field</option>
                            @foreach($fieldTypes as $field) {
                            <option value="{{{$field->id}}}">{{{$field->name}}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 form" id="lib-records">        
            <table class="table" style="width:80%;  text-align: center"  id="lib-table">
    <thead>
        <tr>
        <th style="text-align: center"> Name</th>
        <th style="text-align: center"> Label</th>
        <th style="text-align: center"> Type</th>
        <th style="text-align: center">Edit</th>
      </tr>
    </thead>
    <tbody>
         <?php 
            foreach ($fieldAttributes as $attribute ) {
         ?>
        <tr id="field-{{{$attribute->id}}}">
        <td>{{{$attribute->name}}}</td>
        <td>{{{$attribute->label}}}</td>
        <td>{{{$attribute->fieldType}}}</td>
        <td><a onclick="editField({{{$attribute->id}}});" data-toggle="modal" data-target="#edit-field-page"> Edit</a></td>
      </tr>
      <?php  } ?>
    </tbody>
  </table>
           
        </div>
        <div class="cms-create-new-field">
                <a href="javascript:void(0)" id="create-field-link" data-toggle="modal" data-target="#create-field-page">
                    <img src="{{{url()}}}/images/plusicon.png" alt="plusicon"/> Create New Field
                </a>
            </div> 
    </div>
    <!-- END of .row -->
</div>
<!-- END of .right-section-content -->



<!-- Popup Create field -->
<div class="modal fade createfield-popup" id="create-field-page" tabindex="-1" role="dialog" aria-labelledby="my-modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="display:block;"><span aria-hidden="true"><img src="{{{url()}}}/images/crossinpopup.png" alt="cross"/></span></button>
                <h4 class="modal-title">Create Field</h4>
            </div>
            <div class="modal-body">
                {{ Form::open([
    'route' => 'attributes.save',
    'method' => 'post',
    'role' => 'form',
    'name' => 'create_attributes'
  ]) }}  
                <div class="form-group">
                    <div class="input-field">
                        <label for="field-type" class="control-label">Field Type</label>

                        <select name="field_type" id="field_type" class="selectpicker"  data-style="btn-inverse"  required>
                            <option selected>Select</option>
                            @foreach($fieldTypes as $fieldType)
                            <option value="{{{$fieldType->id}}}">{{{ucfirst($fieldType->name)}}}</option>
                            @endforeach
                        </select>
                        <div id="fieldType_err" style="color:red; font-size: 10px;"></div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-field">
                        <label for="field-name" class="control-label">Field Name</label>
                        <input type="text" id="field_name" class="form-control" name='field_name' required/>
                        <div id="fieldName_err" style="color:red; font-size: 10px;"></div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-field">
                        <label for="field-lable" class="control-label">Field Lable</label>
                        <input type="text" id="field_label" class="form-control" name='field_label' required/>
                        <div id="fieldLabel_err" style="color:red; font-size: 10px;"></div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-field">
                        <label for="field-value" class="control-label">Field Value</label>
                        <input type="text" id="field_value" class="form-control" name='field_value'/>
                        <input type="hidden" id="from-library-page"  value="1">
                    </div>
                </div>
                <div class="form-group">
                    <div class="text-center">
                        <button type="submit" id="create_field" class="btn btn-primary next">Create</button>
                    </div>
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>


<!-- Edit Fields -->
<div class="modal fade createfield-popup" id="edit-field-page" tabindex="-1" role="dialog" aria-labelledby="my-modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="display:block;"><span aria-hidden="true"><img src="{{{url()}}}/images/crossinpopup.png" alt="cross"/></span></button>
                <h4 class="modal-title">Update Field</h4>
            </div>
            <div class="modal-body">
                {{ Form::open([
    //'route' => 'attributes.update',
    'method' => 'post',
    'role' => 'form',
    'name' => 'update_attributes',
    'onsubmit' => 'return updateFieldsValidate();'
  ]) }}  
  <input type="hidden" id="editFieldId" name="editFieldId" >

            <div class="cms-search-field" >
                <label for="field-type" class="control-label">Field Type</label><br>
                <div class="styled-select">
                    <select class="form-control" name="edit_field_type" id="edit_field_type">
                        <option value="">Field Type</option>
                        @foreach($fieldTypes as $fieldType)
                        <option value="{{{$fieldType->id}}}">{{{ucfirst($fieldType->name)}}}</option>
                        @endforeach
                    </select>
                    
                </div><div class="clearfix"></div>
                <div id="edit_fieldType_err" style="color:red; font-size: 10px;"></div>
            </div>
            <div class="clearfix"></div>
                <div class="form-group">
                    <div class="input-field">
                        <label for="field-name" class="control-label">Field Name</label>
                        <input type="text" id="edit_field_name" class="form-control" name='edit_field_name' />
                        <div id="edit_fieldName_err" style="color:red; font-size: 10px;"></div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-field">
                        <label for="field-lable" class="control-label">Field Lable</label>
                        <input type="text" id="edit_field_label" class="form-control" name='edit_field_label' />
                        <div id="edit_fieldLabel_err" style="color:red; font-size: 10px;"></div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-field">
                        <label for="field-value" class="control-label">Field Value</label>
                        <input type="text" id="edit_field_value" class="form-control" name='edit_field_value'/>
                    </div>
                </div>
                <div class="form-group">
                    <div class="text-center">
                        <button type="submit" id="update_field" class="btn btn-primary next">Update</button>
                    </div>
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>
</div>
</div>
@endsection