<?php

namespace Monk\ACF\Field;

/*
 * Basic fields
 */


class Basic extends \Monk\ACF\Field {
    
    public $placeholder;
    public $prepend;
    public $append;
    
}


class Number extends Basic {
    
    public $min;
    public $max;
    public $step;
    public $type = 'number';
    
}


class Range extends Number {
    
    public $type = 'range';
    
}


class Textarea extends Basic {
    
    public $rows;
    public $new_lines;
    public $type = 'textarea';
    
        
    /**
     * 
     * How to render new lines. Defaults to 'wpautop'. 
     * Choices of 'wpautop' (Automatically add paragraphs), 'p' (Alias of 'wpautop'), 'br' (Automatically add <br>) or '' (No Formatting)
     * 
     * @param string $wrapper
     * @return $this
     */
    function wrapNewLines($wrapper = 'p') {
        
        if( $wrapper === 'p' ) {
            
            $wrapper = 'wpautop';
            
        }
        
        $this->new_lines = $wrapper;
        
        return $this;
        
    }
    
}


class Heading extends Basic {

    public $heading_level;
    public $heading_classes;
    public $heading_id;
    public $type = 'heading';

}