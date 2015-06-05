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
        <div class="row"><?php echo $formData; ?>  </div>
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