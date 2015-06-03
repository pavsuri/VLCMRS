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
                    <li class="second active">
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
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 form">
            <div class="cms-sys-maintenance">
                <div>
                    <img src="images/smallcircle.png" alt="smallcircle" class="smallcircle"/>
                    <p>{{{$data['formName']}}}</p> 
                    <a href="javascript:void(0)"><img src="images/edit.png" alt="edit"/></a>
                </div>
            </div>
            <!-- END of .cms-sys-maintenance -->
            </div>
    </div>
            <!-- END of .form -->
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="cms-search-field">
                        <input type="text" value="Search"/>
                        <select class="selectpicker" data-style="btn-inverse">
                            <option>Search by</option>
                            <option>Maintenance</option>
                            <option>Maintenance</option>
                        </select>
                        <a href="javascript:void(0)">
                            <img src="images/search.png" alt="search"/>
                        </a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
                    <div class="cms-add-field-block">
                        @foreach($data['fieldsLibrary'] as $fieldAttribute)
                        <div class="cms-add-fields">
                            <input type="text" value="{{{$fieldAttribute->value}}}" name="{{{$fieldAttribute->name}}}" id="{{{$fieldAttribute->identifier}}}">
                            <a href="javascript:void(0)">
                                <img src="images/add.png" alt="add"/>
                            </a>
                            <div class="clearfix"></div>	
                        </div>
                        @endforeach
                    </div>
                    <div class="cms-create-new-field">
                        <a href="javascript:void(0)">
                            <img src="images/plusicon.png" alt="plusicon"/> Create New Field
                        </a>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
                    <div class="cms-add-field-block">
                        <div class="cms-add-fields">
                            <input type="text"  value="Emp ID">
                            <a href="javascript:void(0)">
                                <img src="images/cross.png" alt="cross"/>
                            </a>
                            <div class="clearfix"></div>	
                        </div>
                        <div class="cms-add-fields">
                            <input type="text"  value="Name">
                            <a href="javascript:void(0)">
                                <img src="images/cross.png" alt="cross"/>
                            </a>
                            <div class="clearfix"></div>	
                        </div>
                        <div class="cms-add-fields">
                            <input type="text" class="dashed">
                            <div class="clearfix"></div>	
                        </div>
                    </div>
                </div>
            </div>
            <!-- END of .row -->
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center btns">
                    <button type="button" class="btn btn-primary btm-btn">Back</button>
                    <button type="button" class="btn btn-primary btm-btn">Next</button>
                </div>
            </div>
            </div>
            <!-- END of .right-section-content -->
            @endsection
