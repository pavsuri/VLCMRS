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
                    <li class="second inactive">
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
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 form">
 {{ Form::open([
    'route' => 'forms.saveform',
    'method' => 'post',
    'class' => 'form-horizontal',
    'role' => 'form',
    'onsubmit' => 'return addFormValidate();'
  ]) }}
                <div class="form-group">
                    <div class="form-field">
                        <label for="form-name" class="control-label">Form Name</label>
                        <input type="text"  id="form-name" name="name" class="form-control" placeholder="Form Name"   >
                        <div id="form_name_err" style="color: red; font-size: 10px;"><?php if(Session::get('errMsg')!='') { echo Session::get('errMsg'); } ?></div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-field">
                        <label for="form-type" class="control-label">Form Type</label>
                        <select name="type_id" id="type_id" class="selectpicker"  data-style="btn-inverse" >
                            <option value="" >Select Form Type</option>
                            @foreach($formTypes as $formType)
                            <option value="{{{$formType->id}}}" >{{{$formType->form_type}}}</option>
                            @endforeach
                        </select>
                        <div id="form_type_err" style="color: red; font-size: 10px;"></div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary btm-btn next">Next</button>
                    </div>
                </div>
 {{ Form::close() }}
            <!-- END of .form-horizontal -->
        </div>
        <!-- END of .form -->
    </div>
    <!-- END of .row -->
</div>
<!-- END of .right-section-content -->
@endsection