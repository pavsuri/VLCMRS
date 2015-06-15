<?php
namespace helpers;

class UserFormHtmlGenerator
{
    public static function  htmlInput($field, $optionsData)
    {
        $fieldType = $field->fieldType;
        $fieldName = $field->fieldName.'-'.$field->uuid;
        $fieldLabel = $field->fieldLabel;
        $fieldValue = $field->fieldValue;
        switch ($fieldType) {
            case "textbox":
                $textbox = "<input type='".$fieldType."' name='".$fieldName."' placeholder='".$fieldValue."' class='form-control' />";
                $output = self::divStructure($fieldLabel, $textbox);
                break;
            case "textarea":
                $textarea =  " <".$fieldType."  name='".$fieldName."' rows='1'  class='form-control' ></textarea>";
                $output = self::divStructure($fieldLabel, $textarea);
                break;
            case "selectbox":
                $output = self::getSelectboxHtml($fieldLabel,$fieldName, $optionsData);
                break;
            case "image":
                $image =  "<input  type='file'  name='".$fieldName."'>";
                $output = self::divStructure($fieldLabel, $image);
                break;
            case "checkbox":
                $output = self::getCheckboxHtml($fieldLabel, $fieldName, $optionsData, $field->uuid);
                break;
            case "radiobutton":
                $output = self::getRadioButtonHtml($fieldLabel, $fieldName, $optionsData, $field->uuid);
                break;
        }
        return $output;
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
    public static function getCheckboxHtml($fieldLabel, $fieldName, $optionsData, $uuid)
    {
        $structure = '<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
                        <div class="form-group">
                                <div class="input-field">
                                        <label class="control-label" for="">'.$fieldLabel.'</label>
                                        <div class="data">';
        foreach($optionsData as $option) {
            $structure .= '<div class="chk">
                            <label for="checkbox1">'.$option->fieldLabel.'</label>
                            <input type="checkbox" name="'.$fieldName.'[]" value="'.$option->fieldValue.'"   id="'.$uuid.'">
                        </div>';
        }//<label for="checkbox1"></label>
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
                                           <select class="form-control" name="'.$fieldName.'" >
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
    public static function getRadioButtonHtml($fieldLabel, $fieldName, $optionsData, $uuid )
    {
        $structure = '<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
                        <div class="form-group">
                                <div class="input-field">
                                        <label class="control-label" for="">'.$fieldLabel.'</label>
                                        <div class="data">';
        foreach($optionsData as $option) {
            $structure .= '<div class="chk">
                            <label for="male">
                                <input type="radio" value="'.$option->fieldValue.'" name="'.$fieldName.'"  id="'.$uuid.'"> 
                                    <span>'.$option->fieldLabel.'</span>
				</label>
                            </div>';
        }
        $structure .= '</div></div></div></div>';
        return $structure;
    }
}
