<?php

namespace Monk\ACF;

require_once 'collection.php';

/*
 * Layout
 */


class Layout extends \Monk\ACF {
    
    use Collection;
    
    public $display;
    public $min;
    public $max;
    
    function __construct($label) {
        
        parent::__construct($label, null);
        
        $this->autoResolveSubFields();
        
    }
    
     
    function register($parent) {
        
        $layout = parent::register($parent);
                
        \Monk\Utils\acf_add_local_fields(array_splice($layout['sub_fields'], 0), $parent, $this->key);
                
        return $layout;
        
    }
    
    
    function createKey() {
        
        $this->key  = "layout_mnk_{$this->name}";
        
        return $this;
        
    }
    
    
    /**
     * Set the layout's display.
     * Accepted arguments are: 'block' (default), 'row', 'table'
     * 
     * @param string|null $display
     * @return $this
     */
    function setDisplay($display = null) {
        
        if( empty($display) ) {
            
            $display = 'block';
            
        }
        
        $this->display = $display;
        
        return $this;
        
    }
    
}
