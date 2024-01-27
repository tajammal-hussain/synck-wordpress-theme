<?php

namespace Monk\ACF\Field;

require_once 'collection.php';

/*
 * Group
 */


class Group extends \Monk\ACF\Field {
    
    use \Monk\ACF\Collection;
    
    public $layout      = 'row';
    public $type        = 'group';
    
    
    function __construct($label, $type = null) {
        parent::__construct($label, $type);
                
        $this->autoResolveSubFields();
        
    }
    
    
    function register($parent) {
        
        $field = parent::register($parent);
        
        \Monk\Utils\acf_add_local_fields(array_splice($field['sub_fields'], 0), $this);
        
        return $field;
        
    }
    
}


class Repeater extends Group {
    
    public $button_label;
    public $collapsed;
    public $type = 'repeater';
    
    
    function __construct($label, $type = null) {
        parent::__construct($label, $type);
        
        if( empty($this->button_label) ) {

            $this->button_label = sprintf(__('Add %s'), $this->label);

        }
        
    }

}