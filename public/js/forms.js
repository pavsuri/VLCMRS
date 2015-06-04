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
            alert('Form Name already exist!');
        }
    });
}

function fieldLibraryTemplate(fields)
{
    var response = '';
    for (i=0; i<fields.length; i++) {
        response += fields[i].name +"<br>";
    }
    $('#fieldLibrary').html(response);
}