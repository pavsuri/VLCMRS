<?php
namespace classes;

class HtmlGenerator
{
    public function htmlInput($fieldType, $fieldName, $fieldLabel, $fieldValue = '')
    {
        switch ($fieldType) {
            case "textbox":
                $output = $fieldLabel. ": <input type='".$fieldType."' name='".$fieldName."' value='".$fieldValue."' />";
                break;
            case "textarea":
                $output = $fieldLabel. ": <".$fieldType."  name='".$fieldName."'>".$fieldValue."</textarea>";
                break;
        }
        return $output;
    }
    
    public function htmlForm($formName, $typeId)
    {
        return "<form name='".$formName."' >";
    }
}
