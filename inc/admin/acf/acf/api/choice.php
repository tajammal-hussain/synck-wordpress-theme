<?php

namespace Monk\ACF\Field;

/*
 * Choices
 */


class Choice extends \Monk\ACF\Field {
    
    public $choices = [];
    public $default_value;
    public $return_format;
    
    
    /**
     * Specify how the value is formatted when loaded. Default 'value'. 
     * Choices of 'value', 'label' or 'array'
     * 
     * @param string $format
     * @return $this
     */
    function setReturnFormat($format = null) {
        
        if( empty($format) ) {
            
            $format = 'value';
            
        }
        
        $this->return_format = $format;
        
        return $this;
        
    }
    
    /**
     * 
     * @param array|string $value A single choice or an array of $value => $label choices.
     * @param string $label The label to display $value as if a string is passed. If Omitted, then $value will be used as the choice's label.
     * @return $this
     */
    function addChoices($value, $label = null) {
        
        if( is_array($value) ) {
            
            $this->choices = array_merge($this->choices, $value);
            
        } else {
            
            if( empty($label) ) {
                
                $label = $value;
                
            }
            
            $this->choices[$value] = $label;
            
        }
        
        $this->choices = \Monk\Utils\array_filter($this->choices);
        
        return $this;
        
    }
    
}


class ButtonGroup extends Choice {
    
    public $allow_null;
    public $layout;
    public $type = 'button_group';
    
}


class Select extends Choice {
    
    public $allow_null;
    public $multiple;
    public $ui;
    public $placeholder;
    public $type = 'select';
    
    function __construct($label, $type = null) {
        
        parent::__construct($label, $type);
        
        $this->placeholder = sprintf("-- Select %s --", $this->label);
        
    }
    
}


class Icons extends Select {
    
    public $type = 'icon';
    public $icons_path;
    
    function __construct($label, $type = null) {
        parent::__construct($label, $type);
        
        $this->icons_path = $GLOBALS['monk_default_manifest'];
        
    }
    
}


class Chechbox extends Choice {
    
    public $layout;
    public $allow_custom;
    public $save_custom;
    public $toggle;
    public $type = 'checkbox';
    
}


class Radio extends Choice {
    
    public $layout;
    public $other_choice;
    public $save_other_choice;
    public $allow_null;
    public $type = 'radio';
    
}


class TrueFalse extends \Monk\ACF\Field {
    
    public $default_value;
    public $message;
    public $ui = 1;
    public $ui_on_text;
    public $ui_off_text;
    public $type = 'true_false';
    
}