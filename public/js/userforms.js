$(document).ready(function () {    
    $('#addBtnDiv').hide();
    $('#addBtnDiv_new').click(function(){
        $('#submitBtnDiv').show();
        $('#addBtnDiv_div').hide();
    });
    
    //Edit Form in Add fields page
    $('#add_values_btn').on('click', function (event) {
        event.preventDefault();
        var formId = $('#formEditId').val();
        getUserForm(formId); 
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
        success: function (data) {//alert(data);
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
{//alert(formId);
    $.ajax({
        url: "/checkUserForm/"+formId,  //It checks in user_forms table if found it contains values
        type: "get",
        success: function (data) {
            
             //getUserForm(formId);
            
            if (data == 'null' || data == '') {
                getForm(formId);
                $('#addBtnDiv_div').hide();
                $('#addBtnDiv').show();
                $('#submitBtnDiv').hide();
                //getFormData(formId);
            } else {//alert(data);
                //getForm(formId);
                $('#addBtnDiv').hide();
                $('#submitBtnDiv').hide();
                $('#addBtnDiv_div').show();
                getUserFormValues(formId);
            }
        }
    });
}

function getFormData(formId) 
{
     $.ajax({
        url: "/preview/"+formId,
        type: "get",
        success: function (data) {//alert(data);
            getFormName(formId);
            $('#form_data').html(data);
            $('#form-data').removeAttr('style');
            $('#formEditId').val(formId);
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
            $('#form_data').html(data);
            $('#formEditId').val(formId);
            $("#formSubmitId").val(formId);
            //$("#formTypeSubmitId").val(formId);
        }
    });
}


