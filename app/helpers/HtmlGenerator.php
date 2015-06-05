<?php
namespace helpers;

class HtmlGenerator
{
    public static function  htmlInput($fieldType, $fieldName, $fieldLabel, $fieldValue = '', $optionsData)
    {
        switch ($fieldType) {
            case "textbox":
                $textbox = "<input type='".$fieldType."' name='".$fieldName."' value='".$fieldValue."' class='form-control'/>";
                $output = self::divStructure($fieldLabel, $textbox);
                break;
            case "textarea":
                $textarea =  " <".$fieldType."  name='".$fieldName."'>".$fieldValue."</textarea>";
                $output = self::divStructure($fieldLabel, $textarea);
                break;
            case "selectbox":
                $select =  "<select  name='".$fieldName."' value = '".$fieldValue."'  class='selectpicker' data-style='btn-inverse' >";
                $select .= "<option value='' >Select Country</option>";
                foreach($optionsData as $option) {
                    $select .= "<option value='".$option->fieldValue."' >".$option->fieldName."</option>";
                }
                $select .= "</select>";
                $output = self::divStructure($fieldLabel, $select);
                break;
            case "checkbox":
                $checkbox = "";
                foreach($optionsData as $option) {
                    $checkbox .= "<input type='checkbox' name=".$fieldName." value=".$option->fieldValue.">".$option->fieldName;
										
                }
                $output = self::getCheckboxHtml($fieldLabel, $checkbox);
                break;
            case "radio":
                $radio = "";
                foreach($optionsData as $option) {
                    $radio .= "<input type='radio' name=".$fieldName." value=".$option->fieldValue.">".$option->fieldName;
                }
                $output = self::divStructure($fieldLabel, $radio);
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
    
    public static function getCheckboxHtml($fieldLabel, $fieldHtml)
    {
        $structure = '<div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
                        <div class="data">
                            <span>' . $fieldLabel . '</span> 
                                <div class="check-box">
                                ' . $fieldHtml . '
                                    <label for="oc"></label>
                                </div>
                          </div>
                </div>';
        return $structure;
    }
}
