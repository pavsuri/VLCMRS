@extends('userLayout.empty')

@section('title')Create Form @endsection

@section('content')
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 title-content">
        <a href="javascript:void(0);" class="btnPrevious"><p>Previous</p></a>
        <a href="javascript:void(0);" class="btnNext"><p>Next</p></a>
        <div class="carousel">
            <ul class="nav nav-tabs" style="left: 135px; top: 0px;">
                @foreach($formTypes as $formType)
                <li class="survey" style="width: 145px;" id="type-div-{{{$formType->id}}}" onclick="getFormsByTypeId({{{$formType->id}}});">
                    <a class="surveylink" data-toggle="tab" role="tab" >
                        <p>{{{$formType->form_type}}}</p>
                    </a>
                </li>
                @endforeach
            </ul>
            <input type="formTypeId" name="form_type_id" id="form_type_id" >
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane" id="surveylink">surveylink</div>
                <div role="tabpanel" class="tab-pane active" id="maintenancelink">
                    <div class="right-section-content">
                        <div class="select-form">
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                    <div class="form-group">
                                        <label for="select-form" class="col-xs-12 col-sm-3 col-md-3 col-lg-3 control-label">Select Form</label>
                                        <div class="styled-select" id="formListDiv">
                                            <select name="form_names" id="form_names" class="form-control"   data-style="btn-inverse" ></select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row" >
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <p class="user-current-form" id="form_name" ></p>
                            </div>
                        </div>
                        {{ Form::open([
                        'route' => 'userforms.saveFormvalues',
                        'method' => 'post',
                        'id' => 'field-form-map',
                        'role' => 'form',
                        //'onsubmit' => 'return checkFormFields();'
                      ]) }}
                        <div class="cms-preview-data">
                            <div class="row" id="form_data"> </div>
                        </div>
                        <div class="row" id="submitBtnDiv" style="display:none;">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center btns">
                                <!-- <button type="button" class="btn btn-primary btm-btn">Previw</button> -->
                                <input type="hidden" value="" name="formSubmitId" id="formSubmitId" >
                                <input type="hidden" value="" name="formTypeSubmitId" id="formTypeSubmitId" >
                                <button type="submit" class="btn btn-primary btm-btn" id="submit_form_values">Submit</button>

                            </div>
                        </div>
                        {{ Form::close() }}
                        <!-- END of .row -->
                        <div class="row" id="addBtnDiv">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center btns">
                                <!-- <button type="button" class="btn btn-primary btm-btn">Previw</button> -->
                                <input type="hidden" value="" name="formEditId" id="formEditId" >
                                <button type="submit" class="btn btn-primary btm-btn" id="add_values_btn">Add Values</button>

                            </div>
                        </div>
                        <!-- END of .row -->
                    </div>
                    <!-- END of .right-bottom-content -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
