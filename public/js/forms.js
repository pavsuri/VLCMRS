$(document).ready(function () {
    //Edit Form in Add fields page
    $('#editForm').on('click', function (event) {
        event.preventDefault();
        updateForm();
    });
    
    //Search Fields from Library on Add fields page
    $('#searchFields').on('click', function (event) {
        event.preventDefault();
        searchFields();
    });
    
    //Move fields from Library to Form
    $('#moveField').on('click', function (event) {
        event.preventDefault();
        alert();
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

            alert('Form Name already exist!');
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
        },
        error: function () {
            alert('Form Name already exist!');
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
            $("#div-right-"+fieldId).remove();
            addFieldtoFieldLibrary(data);
        },
        error: function () {
            alert('Form Name already exist!');
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