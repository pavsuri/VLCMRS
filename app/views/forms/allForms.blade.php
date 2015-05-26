@if(isset($message))
{{{$message}}}
@endif

<table border="1"> 
    <tr>
        <td>
            S.No
        </td>
        <td>
            Form Name
        </td>
        <td>
            Type Id
        </td>
        <td>Add Fields
        </td>
        <td>
           View
        </td>
    </tr>
    <?php
    $sno=1;
    foreach ($forms as $form) {
        ?>
    <tr>
        <td>{{{$sno}}} </td>
        <td>{{{$form->name}}}</td>
        <td>{{{$form->type_id}}}</td>
        <td><a href="/createForm/{{{$form->id}}}">
            Add Fields
            </a></td>
        <td>View</td>
    </tr>
    <?php } ?>
</table>

<br>
<a href="/addForm" >Add New Form</a><br><br>
<a href="/setAttributes">Set Attributes</a>