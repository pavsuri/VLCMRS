@extends('layout.empty')

@section('title')Create Form @endsection

@section('content')
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 title-content">
        <div class="cms-page-title">
            <h1>Create Fields</h1>
        </div>					
    </div>
</div>
<!-- END of .row -->
<div class="right-section-content">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="cms-links">
               @if (Session::has('message'))
                    <div class="alert alert-info">{{{ Session::get('message') }}}</div>
               @endif
            </div>
            <!-- END of .cms-links -->
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 form"><div class="modal-body">
                {{ Form::open([
    'route' => 'attributes.saveFieldsToLibrary',
    'method' => 'post',
    'role' => 'form',
    'name' => 'create_attributes',
    'onsubmit' => 'return createFieldsValidate()'
  ]) }}  
                <div class="form-group">
                    <div class="input-field">
                        <label for="field-type" class="control-label">Field Type</label>

                        <select name="field_type" id="field_type" class="selectpicker"  id="field-type" data-style="btn-inverse" >
                            <option value="">Select</option>
                            @foreach($fieldTypes as $fieldType)
                            <option value="{{{$fieldType->id}}}">{{{ucfirst($fieldType->name)}}}</option>
                            @endforeach
                        </select>
                        <div id="field_type_err" style="color:red; font-size: 10px;"></div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-field">
                        <label for="field-name" class="control-label">Field Name</label>
                        <input type="text" id="field_name" class="form-control" name='field_name' />
                        <div id="field_name_err" style="color:red; font-size: 10px;"></div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-field">
                        <label for="field-lable" class="control-label">Field Lable</label>
                        <input type="text" id="field_label" class="form-control" name='field_label' />
                        <div id="field_label_err" style="color:red; font-size: 10px;"></div>
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
                        <button type="submit" id="" class="btn btn-primary next">Create</button>
                    </div>
                </div>
                {{ Form::close() }}
            </div>
        </div>
        <!-- END of .form -->
    </div>
    <!-- END of .row -->
</div>
<!-- END of .right-section-content -->
@endsection