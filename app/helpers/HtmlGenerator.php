<?php
namespace helpers;

class HtmlGenerator
{
    public static function  htmlInput($fieldType, $fieldName, $fieldLabel, $fieldValue = '')
    {
        switch ($fieldType) {
            case "textbox":
                $output = $fieldLabel. ": <input type='".$fieldType."' name='".$fieldName."' value='".$fieldValue."' />";
                break;
            case "textarea":
                $output =  $fieldLabel. ": <".$fieldType."  name='".$fieldName."'>".$fieldValue."</textarea>";
                break;
        }
        return $output;
    }
    
    public static function htmlForm($formName, $typeId)
    {
        echo  "<form name='".$formName."' >";
    }
}
