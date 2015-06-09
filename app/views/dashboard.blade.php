@extends('layout.empty')

@section('title')Create Form @endsection

@section('content')
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 title-content">
        <div class="cms-page-title">
            <h1>Dashboard</h1>
        </div>					
    </div>
</div>
<!-- END of .row -->
<div class="right-section-content">
    <div class="row">
        @foreach($forms as $formType) 
        <?php 
        if($formType->total != ''){  $url ='/formList/'.$formType->id; }  else { $url = '#' ; }
        ?>
        <a href="{{{$url}}}" >
        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-4">
            <div class="cms-dash-block">
                <div class="round-no">{{{$formType->total}}}</div>
                <img src="images/survey.png" alt="survey"/>
                <p>{{{$formType->form_type}}}</p>
            </div>
        </div>
        </a>
        @endforeach
    </div>
    <!-- END of .row -->
</div>
@endsection