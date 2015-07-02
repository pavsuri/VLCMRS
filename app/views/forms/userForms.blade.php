@extends('layout.empty')

@section('title')Create Form @endsection

@section('content')
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 title-content">
        <div class="cms-page-title">
            <h1>User Forms</h1>
        </div>					
    </div>
</div>
<!-- END of .row -->
<div class="right-section-content">
    <div class="cms-preview-data">
        <div class="row">
                       
                        <select onchange="getUserFormsList(this.value);">
                            <option value="">Select User</option>
                            <?php 
                                  if(isset($users))
                                  {
                                        foreach($users as $data)
                                        {
                                            echo "<option value='$data->id'>$data->name</option>";
                                        }
                                  }
                            ?>    
                        </select>                          
            {{ Form::open([
            'route' => 'categoryTreeSave',
            'method' => 'post',            
            'role' => 'form',    
            'id' => 'category_tree',
            ]) }}               
                        
           {{ Form::close() }}              
               
        </div>
    </div>
</div>

 
@endsection