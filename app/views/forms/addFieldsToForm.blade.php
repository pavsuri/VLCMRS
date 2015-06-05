@extends('layout.empty')

@section('title')Create Form @endsection

@section('content')
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 title-content">
        <div class="cms-page-title">
            <h1>Create Form</h1>
        </div>					
    </div>
</div>

<div class="right-section-content">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="cms-links">
                <ul>
                    <li class="active">
                        <a href="javascript:void(0)">
                            <div class="round">1</div> Create Form
                        </a>
                    </li>
                    <li class="second active">
                        <a href="javascript:void(0)">
                            <div class="round">2</div> Add Fields
                        </a>
                    </li>
                    <li class="third inactive">
                        <a href="javascript:void(0)">
                            <div class="round">3</div> Preview
                        </a>
                    </li>
                    <div class="clearfix"></div>
                </ul>
            </div>
            <!-- END of .cms-links -->
        </div>
    </div>
    <!-- END of .form -->


    <div class="row">
        {{ Form::open([
    'route' => 'forms.mapFieldstoForm',
    'method' => 'post',
    'id' => 'field-form-map',
    'role' => 'form'
  ]) }}
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
            <div class="cms-search-field" >
                <input type="text" name="search_attribute" id="search_attribute" placeholder="Search"/>
                <select class="selectpicker" data-style="btn-inverse" name="search_field" id="search_field">
                    <option value="">Search by</option>
                    @foreach($data['fieldTypes'] as $fieldType)
                    <option value="{{{$fieldType->id}}}">{{{ucfirst($fieldType->name)}}}</option>
                    @endforeach
                </select>
                <a  id="searchFields">
                    <img src="images/search.png" alt="search"/>
                </a>
            </div>
            <div class="cms-add-field-block"  id="fieldLibrary">
                @foreach($data['fieldsLibrary'] as $fieldAttribute)
                <div class="cms-add-fields" id="div-left-{{{$fieldAttribute->id}}}">
                    <input type="text" value="{{{$fieldAttribute->value}}}" name="{{{$fieldAttribute->name}}}" id="{{{$fieldAttribute->identifier}}}">
                    <a  onclick="moveField({{{$fieldAttribute->id}}})">
                        <img src="images/add.png" alt="add"/>
                    </a>
                    <div class="clearfix"></div>	
                </div>
                @endforeach
            </div>
            <div class="cms-create-new-field">
                <a href="javascript:void(0)" data-toggle="modal" data-target="#create-field">
                    <img src="images/plusicon.png" alt="plusicon"/> Create New Field
                </a>
            </div>
        </div>
        
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
            <div class="cms-sys-maintenance">
                <div>
                    <!--<img src="images/smallcircle.png" alt="smallcircle" class="smallcircle"/>-->
                    <p id="formName">{{{$data['formName']}}}</p>
                    <a href="#Form-Edit" data-toggle="modal"><img src="images/edit.png" alt="edit"/></a>
                </div>
            </div>
            <input type="hidden" name="form_id_map" id="form_id_map" value="{{{$data['formId']}}}">
            <!-- END of .cms-sys-maintenance -->
            <!-- Form Fields -->
            <div class="cms-add-field-block" id="form-fields"></div>
        </div> 
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center btns">
            <button type="button" class="btn btn-primary btm-btn">Back</button>
            <input type="submit" class="btn btn-primary btm-btn" Value="Next">
        </div>

        {{ Form::close() }}
    </div>



    <!-- END of .row -->
</div>

<!-- Popup for edit Form Name -->
<div class="modal fade createfield-popup" id="Form-Edit" tabindex="-1" role="dialog" aria-labelledby="my-modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="display:block;"><span aria-hidden="true"><img src="images/crossinpopup.png" alt="cross"/></span></button>
                <h4 class="modal-title">Edit Form</h4>
            </div>
            <div class="modal-body">
                {{ Form::open([
    'method' => 'post',
    'class' => 'form-horizontal',
    'role' => 'form'
  ]) }}
                <input type="hidden" name="form_id" id="form_id" value="{{{$data['formId']}}}">
                <div class="form-group">
                    <div class="form-field">
                        <label for="form-name" class="control-label">Form Name</label>
                        <input type="text"  id="form_name" name="name"  value="{{{$data['formName']}}}" class="form-control"  >
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-field">
                        <label for="form-type" class="control-label">Form Type</label>
                        <select name="type_id" id="type_id" class="selectpicker"  data-style="btn-inverse">
                            <option value="" >Select Form Type</option>
                            @foreach($formTypes as $formType)
                            <option value="{{{$formType->id}}}" <?php
                            if ($data['formType'] == $formType->id) {
                                echo "selected=selected";
                            }
                            ?>>{{{$formType->form_type}}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <div class="text-center">
                        <button type="button" id="editForm" class="btn btn-primary btm-btn next">Next</button>
                    </div>
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>



<!-- Popup Create field -->
<div class="modal fade createfield-popup" id="create-field" tabindex="-1" role="dialog" aria-labelledby="my-modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="display:block;"><span aria-hidden="true"><img src="images/crossinpopup.png" alt="cross"/></span></button>
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

                        <select name="field_type" id="field_type" class="selectpicker"  id="field-type" data-style="btn-inverse" >
                            <option value="select">Select</option>
                            @foreach($data['fieldTypes'] as $fieldType)
                            <option value="{{{$fieldType->id}}}">{{{ucfirst($fieldType->name)}}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-field">
                        <label for="field-name" class="control-label">Field Name</label>
                        <input type="text" id="field_name" class="form-control" name='field_name'/>
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-field">
                        <label for="field-lable" class="control-label">Field Lable</label>
                        <input type="text" id="field_label" class="form-control" name='field_label'/>
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-field">
                        <label for="field-value" class="control-label">Field Value</label>
                        <input type="text" id="field_value" class="form-control" name='field_value'/>
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
@endsection

