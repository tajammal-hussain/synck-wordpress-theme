<?php

namespace Monk;

/**
 * @property \Monk\ACF $parent Description
 */
abstract class ACF {
    
    public $key;
    public $name;
    public $label;
    public $parent;
    
    
    function __construct($label, $type = null) {
            
        $this->initialize($label, $type);
        
    }
    
    
    /**
     * 
     * @param array|string $label If array then each element will be mapped to the object's properties. If string provided, then will be set as the field\'s label
     * @param null|string $type If string then will be assigned as the field\'s type value.
     */
    function initialize($label, $type = null) {
        
        if( is_array($label) ) {

            $element    = $label;
            $label      = null;

            extract( \Monk\Utils\array_filter($element) );

            foreach($element as $k => $v) {

                $this->{strtolower($k)} = $v;

            }

        }

        if( isset($label) && is_string($label) ) {

            $this->label    = $label;            

        }

        if( isset($type) ) {

            $this->type = $type;

        }

        if( empty($this->name) ) {

            $this->name = sanitize_title( str_replace(' ', '_', $this->label) );

        }

        if( isset($key) ) {

            $this->key = $key;

        } else {

            $this->createKey();

        }
        
        return $this;
        
    }
    
    
    function copy($label = null) {
                
        $copy = clone $this;

        if($label) {

            $copy->name = null;

        }
        
        return $copy->initialize($label, $this->type);
        
    }
    
    
    /**
     * 
     * @param \Monk\ACF|\Monk\ACF\Group $parent
     * @return array
     */
    function register($parent) {
        
        $this->parent = $parent->key;
        
        return Utils\array_filter( get_object_vars($this) );
        
    }
    
    
    function setName($name) {
        
        $this->name = $name;
        
        $this->createKey();
        
        return $this;
        
    }
    
    
    abstract function createKey();

}

require_once __DIR__.'/acf/group.php';
require_once __DIR__.'/acf/field.php';
require_once __DIR__.'/utils.php';