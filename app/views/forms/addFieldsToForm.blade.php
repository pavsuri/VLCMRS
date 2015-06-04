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
<!-- END of .row -->
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
        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
            <div class="cms-search-field">
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
        </div>
        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 form">
            <div class="cms-sys-maintenance">
                <div>
                    <img src="images/smallcircle.png" alt="smallcircle" class="smallcircle"/>
                    <p id="formName">{{{$data['formName']}}}</p>
                    <a href="#Form-Edit" data-toggle="modal"><img src="images/edit.png" alt="edit"/></a>
                </div>
            </div>
            <!-- END of .cms-sys-maintenance -->
        </div>
    </div>

    <div class="row">
        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
            <div class="cms-add-field-block" id="fieldLibrary">
                @foreach($data['fieldsLibrary'] as $fieldAttribute)
                <div class="cms-add-fields">
                    <input type="text" value="{{{$fieldAttribute->value}}}" name="{{{$fieldAttribute->name}}}" id="{{{$fieldAttribute->identifier}}}">
                    <a href="javascript:void(0)">
                        <img src="images/add.png" alt="add"/>
                    </a>
                    <div class="clearfix"></div>	
                </div>
                @endforeach
            </div>
            <div class="cms-create-new-field">
                <a href="javascript:void(0)">
                    <img src="images/plusicon.png" alt="plusicon"/> Create New Field
                </a>
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
            <div class="cms-add-field-block">
                <div class="cms-add-fields">
                    <input type="text"  value="Emp ID">
                    <a href="javascript:void(0)">
                        <img src="images/cross.png" alt="cross"/>
                    </a>
                    <div class="clearfix"></div>	
                </div>
                <div class="cms-add-fields">
                    <input type="text"  value="Name">
                    <a href="javascript:void(0)">
                        <img src="images/cross.png" alt="cross"/>
                    </a>
                    <div class="clearfix"></div>	
                </div>
                <div class="cms-add-fields">
                    <input type="text" class="dashed">
                    <div class="clearfix"></div>	
                </div>
            </div>
        </div>
    </div>
    <!-- END of .row -->
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center btns">
            <button type="button" class="btn btn-primary btm-btn">Back</button>
            <button type="button" class="btn btn-primary btm-btn">Next</button>
        </div>
    </div>
</div>
<!-- END of .right-section-content -->
<!-- Popup for edit Form Name -->
<div class="modal fade createfield-popup" id="Form-Edit" tabindex="-1" role="dialog" aria-labelledby="my-modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="display:block;"><span aria-hidden="true"><img src="images/crossinpopup.png" alt="cross"/></span></button>
                <h4 class="modal-title">Create Field</h4>
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
                            <option value="{{{$formType->id}}}"  <?php if ($data['formType'] == $formType->id) {
    echo "selected=selected";
} ?>>{{{$formType->form_type}}}</option>
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
@endsection

