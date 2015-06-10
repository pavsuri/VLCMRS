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
    
    //Update Field
    $('#update_field').on('click', function (event) {
        event.preventDefault();
        updateField();
    });
    //Move back to create form from Map fields page
    $('#delete_confirm').on('click', function (event) {
        event.preventDefault();
        var formId = $('#form_id_map').val();
        $('#delete-form-data').modal('hide');
        deleteForm(formId);
        window.location.replace('/addForm');
    });
    
    //Clear Create Field form
    $('#create-field-link').on('click', function (event) {
        event.preventDefault();
        $("#field_type").val([]);
        $('#field_name').val('');
        $('#field_label').val('');
        $('#field_value').val('');
        $('#fieldName_err').html('');
        $('#fieldType_err').html('');
        $('#fieldLabel_err').html('');
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

function deleteForm(formId)
{
    var status;
    $.ajax({
        url: "/deleteForm/"+formId,
        type: "get",
        success: function (data) {
            status = data;
        }
    });
    return status;
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
                $('#fieldLibrary').html('');
                alert('No records found');
            }
        },
        error: function () {
            $('#fieldLibrary').html('');
            alert('No records found');
        }
    });
}

function fieldLibraryTemplate(fields)
{
    var response = '';
    for (i=0; i<fields.length; i++) {
        response += '<div class="cms-add-fields" id="div-left-'+fields[i].id+'">\n\
                    <input type="text" value="'+fields[i].name+'" readonly title="'+fields[i].fieldType+'">\n\
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
            //$("#div-left-"+fieldId).remove();
            formFieldsTemplate(data);
        }
    });
}

function formFieldsTemplate(field)
{
    field = field[0];
    var response= '';
    response += '<div class="cms-add-fields" id="div-right-'+field.fieldId+'">\n\
                    <input type="text" value="'+field.fieldName+'" name="allFields['+field.fieldId+']" readonly title="'+field.fieldType+'">\n\
                    <a onclick="removeField('+field.fieldId+')" value=><img src="images/cross.png" alt="Remove"/></a>\n\
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
            //addFieldtoFieldLibrary(data);
            $("#div-right-"+fieldId).remove();
        }
    });
}


function addFieldtoFieldLibrary(field)
{
    field = field[0];
    var response= '';
    response += '<div class="cms-add-fields" id="div-left-'+field.fieldId+'">\n\
                    <input type="text" value="'+field.fieldName+'" readonly title="'+field.fieldType+'">\n\
                    <a onclick="moveField('+field.fieldId+')" value=><img src="images/add.png" alt="add"/></a>\n\
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
            addFieldToLibrary(data);
        },
        error: function () {
            alert('Field Name already exist!');
        }
    });
}

/**
 * Add new field to Library
 */
function addFieldToLibrary(fieldId)
{
    var from_location; // This is for from which page we are creating field. If it is 1-Field Library page
    from_location = $('#from-library-page').val();
    $.ajax({
        url: "/moveField/"+fieldId,
        type: "get",
        success: function (data) {
            if(from_location == 1) {
                addFieldToLibraryHtml(data);
                $('#create-field-page').modal('hide');
            } else {
                addFieldtoFieldLibrary(data);
            } 
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

//Form Library Validation
function checkFormFields()
{
    var fieldLIst = $('#form-fields').html();
    if ((fieldLIst == '') || (fieldLIst == null)) {
        $('#formLib_err').html('Please add atleast one field');
        return false;
    } else {
        $('#formLib_err').html('');
        return true;
    }
}

//Create Fields Validation
function createFieldsValidate()
{
    var field_type_err = ($('#field_type').val() == '')
    var field_type_err_msg = (field_type_err) ? "Please select Field type" : "";
    $('#field_type_err').html(field_type_err_msg);

    var field_name_err = ($('#field_name').val() == '')
    var field_name_err_msg = (field_name_err) ? "Please enter Field Name" : "";
    $('#field_name_err').html(field_name_err_msg);
    
    var field_label_err = ($('#field_label').val() == '')
    var field_label_err_msg = (field_label_err) ? "Please enter Field Label" : "";
    $('#field_label_err').html(field_label_err_msg);
    
    return !field_type_err && !field_name_err && !field_label_err;
}

//Get Attributes by Field type
function getAttributesByField(typeId)
{
    $.ajax({
        url: "/searchFieldLibrary",
        type: "post",
        data: {
            'fieldTypeId': typeId
        },
        success: function (data) {
            if (data.length >0) {
                fieldLibraryHtml(data);
            } else {
                $('#lib-records').html('');
                alert('No records found');
            }
        },
        error: function () {
            $('#lib-records').html('');
            alert('No records found');
        }
    });
}

function fieldLibraryHtml(fields) 
{
    $('#lib-records').html('');
    var response = ''; var sno = 1;
    response += '<table class="table" style="width:80%;  text-align: center" id="lib-table"><thead>\n\
                        <tr><th style="text-align: center"> Name</th>\n\
                            <th style="text-align: center"> Label</th>\n\
                            <th style="text-align: center"> Type</th>\n\
                            <th style="text-align: center">Edit</th>\n\
                        </tr></thead><tbody>';
    for (i=0; i<fields.length; i++) {
        response += '<tr><td>'+fields[i].name+'</td><td>'+fields[i].label+'</td><td>'+fields[i].fieldType+'</td>\n\
                    <td><a onclick="editField('+fields[i].id+');" data-toggle="modal" data-target="#edit-field-page"> Edit</a></td></tr>';
    }
    response += '</tbody></table>';
    $('#lib-records').html(response);
}

function addFieldToLibraryHtml(fields)
{
    var response = ''; 
    for (i=0; i<fields.length; i++) {
        response += '<tr id="field-'+fields[i].fieldId+'"><td>'+fields[i].fieldName+'</td>\n\
                                <td >'+fields[i].fieldLabel+'</td>\n\
                                <td >'+fields[i].fieldType+'</td>\n\
                                <td ><a onclick="editField('+fields[i].fieldId+');" data-toggle="modal" data-target="#edit-field-page"> Edit</a></td></tr>';
    }
    $('#lib-table').append(response);
}

//Open Modal with existed Field Values
function editField(fieldId)
{
    $.ajax({
        url: "/moveField/"+fieldId,
        type: "get",
        success: function (data) {
            $('#editFieldId').val(data[0].fieldId);
            $("select#edit_field_type option")
            .each(function() {
                this.selected = (this.value == data[0].id); });
            $('#edit_field_name').val(data[0].fieldName);
            $('#edit_field_label').val(data[0].fieldLabel);
            $('#edit_field_value').val(data[0].fieldValue);
        }
    });
}

//Create Fields Validation
function updateFieldsValidate()
{
    var field_type_err = ($('#edit_field_type').val() == '')
    var field_type_err_msg = (field_type_err) ? "Please select Field type" : "";
    $('#edit_fieldType_err').html(field_type_err_msg);

    var field_name_err = ($('#edit_field_name').val() == '')
    var field_name_err_msg = (field_name_err) ? "Please enter Field Name" : "";
    $('#edit_fieldName_err').html(field_name_err_msg);
    
    var field_label_err = ($('#edit_field_label').val() == '')
    var field_label_err_msg = (field_label_err) ? "Please enter Field Label" : "";
    $('#edit_fieldLabel_err').html(field_label_err_msg);
    
    return !field_type_err && !field_name_err && !field_label_err;
}
    
//Update Field db
function updateField() 
{
    var field_id, field_type, field_name, field_label, field_value, response;
    field_id = $('#editFieldId').val();
    field_type = $('#edit_field_type').val();
    field_name = $('#edit_field_name').val();
    field_label = $('#edit_field_label').val();
    field_value = $('#edit_field_value').val();
    $.ajax({
        url: "/updateField",
        type: "post",
        data: {
            'field_id' : field_id,
            'field_type': field_type,
            'field_name': field_name,
            'field_label': field_label,
            'field_value': field_value,
        },
        success: function (data) {
            $('#edit-field-page').modal('hide');
            var editLink = '<a onclick="editField('+field_id+');" data-toggle="modal" data-target="#edit-field-page"> Edit</a>';
            response = '<td>'+field_name+'</td><td>'+field_label+'</td><td>'+field_value+'</td><td>'+editLink+'</td>';
            $('#field-'+field_id).html(response);
        }
    });
}