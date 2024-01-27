<?php

namespace Monk\ACF;


class Field extends \Monk\ACF {

    public $type = 'text';
    public $required;
    public $instructions;
    public $default_value;
    public $parent_layout;
    public $conditional_logic = [];
    
    
    function createKey() {
        
        $this->key = "field_mnk_{$this->type}_{$this->name}";
        
        return $this;
        
    }
    
    
    /**
     * 
     * Conditionally hide or show this field based on other field's values. 
     * $field can either be a field's key or an instance of the Field object.
     * Special values (do not need an operator): '!=empty', '==empty'.
     * Valid operators: '==', '!=', '==pattern', '==contains'
     * 
     * @param string|Field $field
     * @param string $value
     * @param string|null $operator
     * @param boolean $new_group
     * @return $this
     */
    function addConditional($field, $value = '!=empty', $operator = null, $new_group = false) {
        
        if( empty($this->conditional_logic) ) {
            
            $new_group = true;
            
        }
        
        if( $new_group ) {
            
            $this->conditional_logic[] = [];
            
        }
        
        if( empty($operator) ) {
            
            $operator = $value;
            $value = null;
            
        }
                
        array_push( $this->conditional_logic[count($this->conditional_logic) - 1], \Monk\Utils\array_filter([
            'field'     => $field,
            'operator'  => $operator,
            'value'     => $value,
        ]) );
        
        return $this;
        
    }
    
    
    function prepareConditionalLogic($suffix = '') {
        
        array_walk($this->conditional_logic, function(&$group) use ($suffix) {

            foreach ($group as &$cond) {

                if($cond['field'] instanceof Field) {

                    $cond['field'] = $cond['field']->key;

                }
                
                $cond['field'] .= $suffix;
                
            }

        });
        
    }
    
}


require_once __DIR__.'/api/presentational.php';
require_once __DIR__.'/api/basic.php';
require_once __DIR__.'/api/choice.php';
require_once __DIR__.'/api/content.php';
require_once __DIR__.'/api/group.php';
require_once __DIR__.'/api/jquery.php';
require_once __DIR__.'/api/layouts.php';
require_once __DIR__.'/api/relational.php';