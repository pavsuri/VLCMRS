<?php
namespace helpers;

class HtmlGenerator
{
    public static function  htmlInput($field, $optionsData)
    {
        $fieldType = $field->fieldType;
        $fieldName = $field->fieldName;
        $fieldLabel = $field->fieldLabel;
        $fieldValue = $field->fieldValue;
        $uuid = $field->uuid;
        switch ($fieldType) {
            case "textbox":
                $textbox = "<input type='".$fieldType."' name='".$fieldName."' placeholder='".$fieldValue."' class='form-control' readonly/>";
                $output = self::divStructure($fieldLabel, $textbox);
                break;
            case "textarea":
                $textarea =  " <".$fieldType."  name='".$fieldName."' rows='1'  class='form-control' readonly></textarea>";
                $output = self::divStructure($fieldLabel, $textarea);
                break;
            case "selectbox":
                $output = self::getSelectboxHtml($fieldLabel,$fieldName, $optionsData);
                break;
            case "image":
                $image =  "<input  type='file'  name='".$fieldName."' readonly>";
                $output = self::divStructure($fieldLabel, $image);
                break;
            case "checkbox":
                $output = self::getCheckboxHtml($fieldLabel, $fieldName, $optionsData);
                break;
            case "radiobutton":
                $radio = "";
                foreach($optionsData as $option) {
                    $radio .= "<input type='radio' name=".$fieldName." value=".$option->fieldValue.">".$option->fieldName;
                }
                $output = self::getRadioButtonHtml($fieldLabel, $fieldName, $optionsData);
                break;
        }
        return $output;
    }
    
    /**
     * Form Tag- HTML
     */
    public static function htmlForm($formName, $typeId)
    {
        return  "<form name='".$formName."' >";
    }
    
    /**
     * TextBox-Html
     */
    public static function divStructure($fieldLabel, $fieldHtml)
    {
        $structure = '<div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
                <div class="form-group">
                    <div class="input-field">
                        <label for="name" class="control-label">'.$fieldLabel.'</label>
                        '.$fieldHtml.'
                    </div>
                </div>
            </div>';
        return $structure;
    }
    
    /**
     * Checkbox-Html
     */
    public static function getCheckboxHtml($fieldLabel, $fieldName, $optionsData)
    {
        $structure = '<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
                        <div class="form-group">
                                <div class="input-field">
                                        <label class="control-label" for="">'.$fieldLabel.'</label>
                                        <div class="data">';
        foreach($optionsData as $option) {
            $structure .= '<div class="chk">
                            <label for="checkbox1">'.$option->fieldLabel.'</label>
                            <input type="checkbox" name="'.$fieldName.'[]" value="'.$option->fieldValue.'" >
                            <label for="checkbox1"></label>
                        </div>';
        }
        $structure .= '</div></div></div></div>';
        return $structure;
    }
    
    /**
     * SelectBox-HTML
     */
    public static function getSelectboxHtml($fieldLabel, $fieldName, $optionsData)
    {
        $structure = '<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
                        <div class="form-group">
                                <div class="input-field">
                                        <label for="town-code" class="control-label">'.$fieldLabel.'</label>
                                        <div class="styled-select">
                                           <select class="form-control" name="'.$fieldName.'" disabled>
                                                        <option>Select one</option>';
        foreach($optionsData as $option) {
            $structure .= "<option value='".$option->fieldValue."' >".$option->fieldName."</option>";
        }
        $structure .= '</select></div></div></div></div>';
        return $structure;
    }
    /**
     * RadioButton - HTML
     */
    public static function getRadioButtonHtml($fieldLabel, $fieldName, $optionsData)
    {
        $structure = '<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
                        <div class="form-group">
                                <div class="input-field">
                                        <label class="control-label" for="">'.$fieldLabel.'</label>
                                        <div class="data">';
        foreach($optionsData as $option) {
            $structure .= '<div class="chk">
                            <label for="male">
                                <input type="radio" value="'.$option->fieldValue.'" name="'.$fieldName.'"> 
                                    <span>'.$option->fieldLabel.'</span>
				</label>
                            </div>';
        }
        $structure .= '</div></div></div></div>';
        return $structure;
    }
}
