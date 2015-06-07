$(document).ready(function () {
    //Edit Form in Add fields page
    $('#editForm').on('click', function (event) {
        event.preventDefault();
        var formName = $('#form_name').val();
        var formType = $('#type_id').val();
        if(formName == '') {
            $('#formName_err').html('Please enter Form Name');
            $('#formType_err').html('');
        } else if(formType == ''){
            $('#formName_err').html('');
            $('#formType_err').html('Please select Form type');
        } else {
            updateForm();
        }
    });
    
    //Search Fields from Library on Add fields page
    $('#searchFields').on('click', function (event) {
        event.preventDefault();
        searchFields();
    });
    
    //Create Field
    $('#create_field').on('click', function (event) {
        event.preventDefault();
        var field_type, field_name, field_label, field_value;
        field_type = $('#field_type').val();
        field_name = $('#field_name').val();
        field_label = $('#field_label').val();
        if(field_type == '') {
            $('#fieldType_err').html('Please Select Field Type');
            $('#fieldName_err').html('');
            $('#fieldLabel_err').html('');
        } else if(field_name == ''){
            $('#fieldLabel_err').html('');
            $('#fieldType_err').html('');
            $('#fieldName_err').html('Please enter Field Name');
        } else if(field_label == ''){
            $('#fieldName_err').html('');
            $('#fieldType_err').html('');
            $('#fieldLabel_err').html('Please enter Field Label');
        } else {
            createField();
        }
    });
});

function updateForm()
{
    var formName = $('#form_name').val();
    var formId = $('#form_id').val();
    var formType = $('#type_id').val();
    $.ajax({
        url: "/updateForm",
        type: "post",
        data: {
            'formName': formName,
            'formId': formId,
            'formType': formType
        },
        success: function (data) {
            $('#formName').html(formName);
            $('#Form-Edit').modal('hide');
        },
        error: function () {
            $('#formName_err').html('Form Name already exist!');
        }
    });
}

function searchFields() {
    var attributeKeyword = $('#search_attribute').val();
    var fieldTypeId = $('#search_field').val();
    $.ajax({
        url: "/searchFieldLibrary",
        type: "post",
        data: {
            'attributeKeyword': attributeKeyword,
            'fieldTypeId': fieldTypeId
        },
        success: function (data) {
            if (data.length >0) {
                fieldLibraryTemplate(data);
            } else {
                alert('No records found');
            }
        },
        error: function () {
            alert('No records found');
        }
    });
}

function fieldLibraryTemplate(fields)
{
    var response = '';
    for (i=0; i<fields.length; i++) {
        response += '<div class="cms-add-fields" id="div-left-'+fields[i].id+'">\n\
                    <input type="text" value="'+fields[i].name+'" >\n\
                    <a onclick="moveField('+fields[i].id+')" value=><img src="images/add.png" alt="add"/></a>\n\
                    <div class="clearfix"></div>\n\
                    </div>';
    }
    $('#fieldLibrary').html(response);
}

function moveField(fieldId)
{
    $.ajax({
        url: "/moveField/"+fieldId,
        type: "get",
        success: function (data) {
            $("#div-left-"+fieldId).remove();
            formFieldsTemplate(data);
        }
    });
}

function formFieldsTemplate(field)
{
    var response= '';
    response += '<div class="cms-add-fields" id="div-right-'+field.id+'">\n\
                    <input type="text" value="'+field.name+'" name="allFields['+field.id+']">\n\
                    <a onclick="removeField('+field.id+')" value=><img src="images/cross.png" alt="Remove"/></a>\n\
                    <div class="clearfix"></div>\n\
                    </div>';
    $('#form-fields').append(response);
}


function removeField(fieldId)
{
    $.ajax({
        url: "/moveField/"+fieldId,
        type: "get",
        success: function (data) {
            addFieldtoFieldLibrary(data);
            $("#div-right-"+fieldId).remove();
        }
    });
}


function addFieldtoFieldLibrary(field)
{
    var response= '';
    response += '<div class="cms-add-fields" id="div-left-'+field.id+'">\n\
                    <input type="text" value="'+field.name+'">\n\
                    <a onclick="moveField('+field.id+')" value=><img src="images/add.png" alt="add"/></a>\n\
                    <div class="clearfix"></div>\n\
                    </div>';
    $('#fieldLibrary').append(response);
}

function createField()
{
    var field_type, field_name, field_label, field_value;
    field_type = $('#field_type').val();
    field_name = $('#field_name').val();
    field_label = $('#field_label').val();
    field_value = $('#field_value').val();
    $.ajax({
        url: "/saveAttributes",
        type: "post",
        data: {
            'field_type': field_type,
            'field_name': field_name,
            'field_label': field_label,
            'field_value': field_value,
        },
        success: function (data) {
            $('#create-field').modal('hide');
            removeField(data);
        },
        error: function () {
            alert('Field Name already exist!');
        }
    });
}

function getForm(formId) 
{
     $.ajax({
        url: "/preview/"+formId,
        type: "get",
        success: function (data) {
            getFormName(formId);
            $('#form_data').html(data);
            $('#form-data').removeAttr('style');
        }
    });
}

function getFormName(formId)
{
    $.ajax({
        url: "/getFormDetails/"+formId,
        type: "get",
        success: function (data) {
            $('#form_name').html(data.name)
        }
    });
}

//Add Form Validation
function addFormValidate()
{
    var name = $('#form-name').val();
    var type = $('#type_id').val();
    if(name == '') {
        $('#form_name_err').html('Please enter Form Name');
        return false;
    } 
    if(type == '') {
        $('#form_name_err').html('');
        $('#form_type_err').html('Please select Form Type');
        return false;
    } 
    return true;
}