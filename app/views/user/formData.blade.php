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
            
            <div class="tab-content">
                
                <div role="tabpanel" class="tab-pane active" id="maintenancelink">
                    <div class="right-section-content">
                        <div class="select-form">
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                    <div class="form-group">
                                        <label for="select-form" class="col-xs-12 col-sm-3 col-md-3 col-lg-3 control-label">Select Form</label>
                                        <div class="styled-select" id="formListDiv" 
                                            <select name="form_names" id="form_names" class="form-control"   data-style="btn-inverse" ></select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> 
            <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 title-content">
                            <div class="cms-page-title">
                                <h1 id="formName">{{{ucfirst($formInfo->name)}}}</h1>
                            </div>					
                    </div>
            </div>
            <div class="right-section-content">
                <div class="cms-preview-data">
                    <div class="row">
                    @foreach($formValues as $value)
                        
                            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
                                <div class="form-group">
                                    <div class="input-field">
                                        <label for="name" class="control-label">{{{$value->fieldLabel}}} :</label>
                                      <?php  if($value->value != '0' ){ echo $value->value; }?>
                                    </div>
                                </div>
                            </div>                          
                       
                    @endforeach
                </div> </div>
                <!-- END of .cms-preview-data -->
            </div>
        </div>
    </div>
</div>
@endsection
