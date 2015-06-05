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
                    <li class="active"><a href="javascript:void(0)"><div class="round">1</div> Create Form</a></li>
                    <li class="second active"><a href="javascript:void(0)"><div class="round">2</div> Add Fields</a></li>
                    <li class="third active"><a href="javascript:void(0)"><div class="round">3</div> Preview</a></li>
                    <div class="clearfix"></div>
                </ul>
            </div>
            <!-- END of .cms-links -->
        </div>
    </div>
    <div class="cms-preview-data">
        <div class="row">	
            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4"></div>
            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 ht">
                <div class="data">
                    <span>Honor DST</span> 
                    <div class="check-box">
                        <input type="checkbox" id="honor"/>
                        <label for="honor"></label>
                    </div>
                </div>
            </div>
            <div class="clearfix visible-sm-block"></div>
            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 ht">
                <div class="data">
                    <span>Has Sounder?</span>
                </div>
            </div>
            <div class="clearfix visible-md-block visible-lg-block"></div>
            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
                <div class="form-group">
                    <div class="input-field">
                        <label for="name" class="control-label">Name</label>
                        <input type="text" id="name" class="form-control"/>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
                <div class="data">
                    <span>Limit Verifiaction Times</span> 
                    <div class="check-box">
                        <input type="checkbox" id="limit" checked/>
                        <label for="limit"></label>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
                <div class="data">
                    <span>O&C Supervised</span> 
                    <div class="check-box">
                        <input type="checkbox" id="oc" checked/>
                        <label for="oc"></label>
                    </div>
                </div>
            </div>
            <div class="clearfix visible-md-block visible-lg-block"></div>
            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
                <div class="form-group">
                    <div class="input-field town">
                        <label for="town-code" class="control-label">Town Code</label>	
                        <select class="selectpicker"  id="town-code" data-style="btn-inverse">
                            <option>Select</option>
                            <option>Maintenance</option>
                            <option>Maintenance</option>
                        </select>
                        <a href="javascript:void(0)">
                            <img src="images/directory.png" alt="directory"/>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
                <div class="form-group">
                    <div class="input-field">
                        <label for="duress" class="control-label">Duress</label>
                        <input type="text" id="duress" class="form-control"/>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
                <div class="form-group">
                    <div class="input-field">
                        <label for="dealer-id" class="control-label">Dealer ID</label>
                        <input type="text" id="dealer-id" class="form-control"/>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
                <div class="form-group">
                    <div class="input-field">
                        <label for="pd-permit" class="control-label">PD Permit#</label>
                        <input type="text" id="pd-permit" class="form-control"/>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
                <div class="form-group">
                    <div class="input-field">
                        <label for="verification" class="control-label">Start Verification</label>
                        <input type="text" id="verification" class="form-control"/>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
                <div class="form-group">
                    <div class="input-field">
                        <label for="freq" class="control-label">Report Frequency</label>
                        <select class="selectpicker"  id="freq" data-style="btn-inverse">
                            <option>Select</option>
                            <option>Maintenance</option>
                            <option>Maintenance</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
                <div class="form-group">
                    <div class="input-field">
                        <label for="fd-permit" class="control-label">FD Permit#</label>
                        <input type="text" id="fd-permit" class="form-control"/>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
                <div class="form-group">
                    <div class="input-field">
                        <label for="end-verification" class="control-label">End Verification</label>
                        <input type="text" id="end-verification" class="form-control"/>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
                <div class="form-group">
                    <div class="input-field">
                        <label for="grade" class="control-label">UL Grade</label>
                        <select class="selectpicker"  id="grade" data-style="btn-inverse">
                            <option> </option>
                            <option>Maintenance</option>
                            <option>Maintenance</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END of .cms-preview-data -->
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center btns">
            <button type="button" class="btn btn-primary btm-btn">Back</button>
            <button type="submit" class="btn btn-primary btm-btn">Submit</button>
        </div>
    </div>
</div>
@endsection