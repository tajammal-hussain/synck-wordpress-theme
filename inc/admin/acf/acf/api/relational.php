<?php

namespace Monk\ACF\Field;

/*
 * Relational
 */


class Relational extends \Monk\ACF\Field {
    
    public $return_format = 'id';
    
    
    /**
     * Specify how the value is formatted when loaded. Default 'id'. 
     * Choices of 'id', 'object' ( 'form_object' for Forms ), user also accepts 'array' and only 'array' or 'url' for links
     * 
     * 
     * @param string $format
     * @return $this
     */
    function setReturnFormat($format = null) {
        
        if( empty($format) ) {
            
            $format = 'id';
            
        }
        
        $this->return_format = $format;
        
        return $this;
        
    }
    
}


class WPObject extends Relational {
    
    public $multiple;
    public $allow_null;
    
}


class User extends WPObject {
    
    public $type = 'user';
    public $role;
    
}


class Taxonomy extends WPObject {
    
    public $taxonomy;
    public $field_type;
    public $add_term;
    public $load_terms;
    public $save_terms;
    public $type = 'taxonomy';
    
    
    /**
     * Set the appearance of this field.
     * Accepted multiple-select types: 'checkbox' (default), 'multi_select'
     * Accepted single-select types: 'radio', 'select'
     * 
     * @param string $type
     * @return $this
     */
    function setFieldType($type = null) {
        
        if( empty($type) ) {
            
            $type = 'checkbox';
            
        }
        
        
        $this->field_type = $type;
        
        return $this;
        
    }
    
    
}


class PostObject extends WPObject {
    
    public $post_type;
    public $taxonomy;
    public $ui;
    public $type = 'post_object';
    
}


/**
 * @property array|string $filters Accepts an array or string of: 'search', 'post_type', 'taxonomy'. Defaults to all
 * @property array $elements Currently this property only seems to accept the value of 'featured_image'
 */
class Relationship extends Relational {
    
    public $post_type;
    public $taxonomy;
    public $elements;
    public $filters;
    public $min;
    public $max;
    public $type = 'relationship';
    
    
    public function showThumbnail() {
        
        $this->elements = ['featured_image'];
        
        return $this;
        
    }
    
}


class Link extends Relational {
    
    public $return_format = 'array';
    public $type = 'link';
    
}