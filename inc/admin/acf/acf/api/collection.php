<?php

namespace Monk\ACF;


trait Collection {
    
    public $sub_fields  = [];
    public $key;
            
    
    function autoResolveSubFields() {
        
        if( $sub_fields = $this->sub_fields ) {

            $this->sub_fields = [];
            
            foreach($sub_fields as $field) {

                $field = \Monk\Utils\auto_resolve_acf_field($field);
                
                $this->addSubField($field);

            }

        }
        
    }
    
    
    function addSubField(\Monk\ACF\Field $field) {
        
        foreach(func_get_args() as $field) {

            array_push($this->sub_fields, $field);
                        
        }
        
        return $this;
        
    }
    
    
    function copy($label = null) {
        
        $copy = parent::copy($label);
        
        $copy->sub_fields = array_map(function(\Monk\ACF $field) {
            
            return $field->copy(); 
            
        }, $this->sub_fields);
        
        return $copy;
        
    }
    
}