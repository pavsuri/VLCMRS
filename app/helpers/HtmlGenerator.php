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
                    $output .= "<option value='".$option->value."' >".$option->name."</option>";
                }
                $output .= "</select>";
                break;
            case "checkbox":
                $output = "";
                foreach($optionsData as $option) {
                    $output .= $fieldLabel. "<input type='checkbox' name=".$fieldName." value=".$option->value.">".$option->name;
                }
                break;
            case "radio":
                $output = "";
                foreach($optionsData as $option) {
                    $output .= $fieldLabel. "<input type='radio' name=".$fieldName." value=".$option->value.">".$option->name;
                }
                break;
            case "radio":
            $output = "";
            foreach($optionsData as $option) {
                $output .= $fieldLabel. "<input type='radio' name=".$fieldName." value=".$option->value.">".$option->name;
            }
            break;
            case "submit":
            $output = "<input type='".$fieldType."' name='".$fieldName."' value='".$fieldValue."' />";
            break;
        }
        return $output;
    }
    
    public static function htmlForm($formName, $typeId)
    {
        echo  "<form name='".$formName."' >";
    }
}
