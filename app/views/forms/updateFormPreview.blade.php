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
            <div class="cms-links"><h2>{{{$formProfile->name}}}</h2></div>
            <!-- END of .cms-links -->
        </div>
    </div>
    <div class="cms-preview-data">
        <div class="row"><?php echo $formData; ?></div>
    </div>
    <!-- END of .cms-preview-data -->
   <!--<div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center btns">
            <a href="/mapFields"><button type="button" class="btn btn-primary btm-btn">Back</button></a>
            <button type="submit" class="btn btn-primary btm-btn">Submit</button>
        </div>
    </div> -->
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
@endsection