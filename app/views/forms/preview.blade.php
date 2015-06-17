@extends('layout.empty')

@section('title')Create Form @endsection

@section('content')
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 title-content">
        <div class="cms-page-title">
            <h1>Form Preview</h1>
        </div>					
    </div>
</div>
<!-- END of .row -->
<div class="right-section-content">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="cms-links">
                <ul>
                    <li class="active"> <a href="#" data-toggle="modal" data-target="#delete-form-data"><div class="round">1</div> Create Form</a></li>
                    <li class="second active"><a href="/mapFields"><div class="round">2</div> Add Fields</a></li>
                    <li class="third active"><a href="javascript:void(0)"><div class="round">3</div> Preview</a></li>
                    <div class="clearfix"></div>
                </ul>
            </div>
            <!-- END of .cms-links -->
        </div>
    </div>
    <div class="cms-preview-data">
        <div class="row"><?php echo $formData; ?></div>
    </div>
    <!-- END of .cms-preview-data -->
    <div class="row" id="preview_buttons">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center btns">
            <a href="/mapFields"><button type="button" class="btn btn-primary btm-btn">Back</button></a>
            <a href="/confirmation"> <button type="submit" class="btn btn-primary btm-btn">Submit</button></a>
            <!--<a href="#" data-toggle="modal" data-target="#form-submit-confirmation"> <button type="submit" class="btn btn-primary btm-btn">Submit</button></a> -->
        </div>
    </div>
</div>

<!-- Delete Form Alert -->
<div class="modal fade createfield-popup" id="delete-form-data" tabindex="-1" role="dialog" aria-labelledby="my-modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="display:block;"><span aria-hidden="true"><img src="{{{url()}}}/images/crossinpopup.png" alt="cross"/></span></button>
                <h4 class="modal-title">Create Form</h4>
            </div>
            <div class="modal-body">
                
                <div class="form-group">
                    <div class="input-field">
                        <label for="field-type" class="control-label">It will delete the form data. Are you sure you want to delete the form data?</label>
                    </div>
                </div>
               
                <div class="form-group">
                    <div class="text-center">
                        <button type="submit" id="delete_confirm" class="btn btn-primary next">Yes</button>
                    </div>
                </div>
              
            </div>
        </div>
    </div>
</div>

<!-- Form submit confirmation -->
<div class="modal fade createfield-popup" id="form-submit-confirmation" tabindex="-1" role="dialog" aria-labelledby="my-modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                
                <h4 class="modal-title">Confirmation</h4>
            </div>
            <div class="modal-body">
                
                <div class="form-group" style="margin-top: 30%; margin-bottom: 30%; margin-left: 15%">
                    <div class="input-field">
                        <label for="field-type" class="control-label" style="font-size: 17px;">Form created Successfully.</label>
                    </div>
                </div>
                <div class="form-group">
                    <div class="text-center">
                        <button type=""  id="submit-confirmation"   class="btn btn-primary next">Ok</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection