@extends('layout.empty')

@section('title')Create Form @endsection

@section('content')
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 title-content">
        <div class="cms-page-title">
            <h1>Map Fields</h1>
        </div>					
    </div>
</div>
<!-- END of .row -->
<div class="right-section-content cms-user-form ">
    <div class="select-form">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="form-group">
                    <label for="select-form" class="col-xs-12 col-sm-3 col-md-3 col-lg-3 control-label">Select Form</label>
                     <div class="col-xs-12 col-sm-8 col-md-7 col-lg-7">
                        <select  id="formId" data-style="btn-inverse" onchange="getForm(this.value);"> 
                            <option>Form type</option>
                            @foreach($formTypes as $formType) {
                            <option value="{{{$formType->id}}}">{{{$formType->form_type}}}</option>
                            @endforeach
                        </select>
                    </div>
                </div> 
            </div>
        </div>
    </div>
    <div id="form-data" style="display:none;">
    <div class="row" >  
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <p class="user-current-form" id="form_name"></p>
        </div>
    </div>
    <div class="cms-preview-data">
        <div class="row" id="form_data"> </div>
    </div>
    <!-- END of .cms-preview-data -->
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center btns">
            <button type="submit" class="btn btn-primary btm-btn">Edit Form</button>
        </div>
    </div>
    </div>
</div>
@endsection
