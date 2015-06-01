<?php
namespace helpers;

class HtmlGenerator
{
    public static function  htmlInput($fieldType, $fieldName, $fieldLabel, $fieldValue = '', $optionsData)
    {
        switch ($fieldType) {
            case "textbox":
                $output = $fieldLabel. ": <input type='".$fieldType."' name='".$fieldName."' value='".$fieldValue."' />";
                break;
            case "textarea":
                $output =  $fieldLabel. ": <".$fieldType."  name='".$fieldName."'>".$fieldValue."</textarea>";
                break;
            case "selectbox":
                $output =  $fieldLabel. ": <select  name='".$fieldName."' value = '".$fieldValue."'>";
                $output .= "<option value='' >Select Country</option>";
                foreach($optionsData as $option) {
                    $output .= "<option value='".$option->fieldValue."' >".$option->fieldName."</option>";
                }
                $output .= "</select>";
                break;
            case "checkbox":
                $output = $fieldLabel;
                foreach($optionsData as $option) {
                    $output .= "<input type='checkbox' name=".$fieldName." value=".$option->fieldValue.">".$option->fieldName;
                }
                break;
            case "radio":
                $output = $fieldLabel;
                foreach($optionsData as $option) {
                    $output .= "<input type='radio' name=".$fieldName." value=".$option->fieldValue.">".$option->fieldName;
                }
                break;
            case "submit":
                $output = "<input type='".$fieldType."' name='".$fieldName."' value='".$fieldValue."' />";
                break;
            case "container":
                $output = "<h1>".$fieldName."</h1>";
                break;
        }
        return $output;
    }
    
    public static function htmlForm($formName, $typeId)
    {
        echo  "<form name='".$formName."' >";
    }
}
