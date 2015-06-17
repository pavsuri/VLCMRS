$(document).ready(function () {
    //Edit Form in Add fields page
    $('#add_values_btn').on('click', function (event) {
        event.preventDefault();
        var formId = $('#formEditId').val();
        getUserForm(formId) 
    });
    
   
});

//Get Forms by Form Type Id
function getFormsByTypeId(formTypeId)
{
    var i, response;;
    $('#form_type_id').val(formTypeId);
    $('#type-div-'.formTypeId).addClass('active');
    $.ajax({
        url: "/getFormsByType/"+formTypeId,
        type: "get",
        success: function (forms) {
            response = '<select name="form_names" id="form_names" class="form-control" onchange="getFormHtml(this.value);"  data-style="btn-inverse" >\n\
                        <option value="">Select Form</option>';
            for(i=0; i<forms.length; i++)
            { 
                response += "<option value="+forms[i].id+">"+forms[i].name+"</option>";
            }
            response += '</select>';
            response += '<input type="hidden" id="formTypeId" value='+formTypeId+' >';
            $('#formListDiv').html(response);
        }
    });
}


//Get complete Form with Attributes and enabled HTML
function getUserForm(formId) 
{
    $.ajax({
        url: "/getFormHtmlEdit/"+formId,
        type: "get",
        success: function (data) {
            $('#formSubmitId').val(formId);
            $('#formTypeSubmitId').val($('#formTypeId').val());
            $('#form_data').html(data);
            $('#addBtnDiv').css("display","none");
            $('#submitBtnDiv').removeAttr('style');
        }
    });
}


//Get complete Form with Attributes and HTML
function getFormHtml(formId) 
{
    $.ajax({
        url: "/checkUserForm/"+formId,
        type: "get",
        success: function (data) {
            if (data == 'null' || data == '') {
                getForm(formId);
            } else {
                getForm(formId);
                getUserFormValues(formId);
            }
        }
    });
}

//Get Existed User Form
function getUserFormValues(formId)
{
    $.ajax({
        url: "/getUserFormValues/"+formId,
        type: "get",
        success: function (data) {
            alert(data);
        }
    });
}