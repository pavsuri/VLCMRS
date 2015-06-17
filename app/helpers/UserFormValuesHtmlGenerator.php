<?php
namespace helpers;

class UserFormValuesHtmlGenerator
{
    public static function  htmlInput($field, $optionsData, $formValues)
    {
        $fieldType = $field->fieldType;
        $fieldName = $field->fieldName.'-'.$field->uuid;
        $fieldLabel = $field->fieldLabel;
        $fieldValue = $field->fieldValue;
        if (!isset($formValues[$field->uuid])) {
            $userValue = "";
        } else {
            $userValue = $formValues[$field->uuid];
        }
        switch ($fieldType) {
            case "textbox":
                $textbox = "<input type='".$fieldType."' name='".$fieldName."' value='".$userValue."' class='form-control' readonly />";
                $output = self::divStructure($fieldLabel, $textbox);
                break;
            case "textarea":
                $textarea =  " <".$fieldType."  name='".$fieldName."' rows='1'  class='form-control' readonly>".$userValue."</textarea>";
                $output = self::divStructure($fieldLabel, $textarea);
                break;
            case "selectbox":
                $output = self::getSelectboxHtml($fieldLabel,$fieldName, $optionsData, $userValue);
                break;
            case "image":
                $output =  "<img src='uploads/".$userValue."'>";
                break;
            case "checkbox":
                $output = self::getCheckboxHtml($fieldLabel, $fieldName, $optionsData, $field->uuid, $userValue);
                break;
            case "radiobutton":
                $output = self::getRadioButtonHtml($fieldLabel, $fieldName, $optionsData, $field->uuid, $userValue);
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
    public static function getCheckboxHtml($fieldLabel, $fieldName, $optionsData, $uuid, $userValue)
    {
        $structure = '<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
                        <div class="form-group">
                                <div class="input-field">
                                        <label class="control-label" for="">'.$fieldLabel.'</label>
                                        <div class="data">';
        $selectedOptions = explode('|', $userValue);
        foreach($optionsData as $option) {
            if (in_array($option->fieldValue, $selectedOptions)) {
                $status = "checked = checked";
            } else {
                $status = "";
            }
            $structure .= '<div class="chk">
                            <label for="checkbox1">'.$option->fieldLabel.'</label>
                            <input type="checkbox" name="'.$fieldName.'[]" value="'.$option->fieldValue.'" '.$status.'  id="'.$uuid.'" disabled>
                        </div>';
        }//<label for="checkbox1"></label>
        $structure .= '</div></div></div></div>';
        return $structure;
    }
    
    /**
     * SelectBox-HTML
     */
    public static function getSelectboxHtml($fieldLabel, $fieldName, $optionsData, $userValue)
    {
        $structure = '<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
                        <div class="form-group">
                                <div class="input-field">
                                        <label for="town-code" class="control-label">'.$fieldLabel.'</label>
                                        <div class="styled-select">
                                           <select class="form-control" name="'.$fieldName.'" disabled>
                                                        <option>Select one</option>';
        foreach($optionsData as $option) {
            if ($userValue == $option->fieldValue) {
                $status = "selected = selected";
            } else {
                $status = "";
            }
            $structure .= "<option value='".$option->fieldValue."' ".$status."  >".$option->fieldName."</option>";
        }
        $structure .= '</select></div></div></div></div>';
        return $structure;
    }
    /**
     * RadioButton - HTML
     */
    public static function getRadioButtonHtml($fieldLabel, $fieldName, $optionsData, $uuid, $userValue)
    {
        $structure = '<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
                        <div class="form-group">
                                <div class="input-field">
                                        <label class="control-label" for="">'.$fieldLabel.'</label>
                                        <div class="data">';
        foreach($optionsData as $option) {
            if ($userValue == $option->fieldValue) {
                $status = "checked = checked";
            } else {
                $status = "";
            }
            $structure .= '<div class="chk">
                            <label for="male">
                                <input type="radio" value="'.$option->fieldValue.'" name="'.$fieldName.'" '.$status.' id="'.$uuid.'"> 
                                    <span>'.$option->fieldLabel.'</span>
				</label>
                            </div>';
        }
        $structure .= '</div></div></div></div>';
        return $structure;
    }
}
