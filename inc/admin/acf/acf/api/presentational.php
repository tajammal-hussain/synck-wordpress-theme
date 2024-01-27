<?php

namespace Monk\ACF\Field;

/*
 * Presentational
 */


class Message extends \Monk\ACF\Field {
    
    public $message;
    public $new_lines;
    public $type = 'message';
            
    function __construct($message) {
        
        if( is_string($message) ) {
            
            parent::__construct(null);
        
            $this->message = $message;
            
        } else {
            
            parent::__construct($message);
            
        }
                
        $this->setName( md5($this->message) );
        
    }
    
}


class Accordion extends \Monk\ACF\Field {
    
    public $open;
    public $multi_expand;
    public $endpoint;
    public $type = 'accordion';
    
}


class EndAccordion extends Accordion {
    
    public $endpoint = 1;
    
    function __construct() {
        
        parent::__construct(null);
        
    }
    
}


class Tab extends \Monk\ACF\Field {
    
    public $endpoint;
    public $placement;
    public $type = 'tab';
    
    /**
     * Determine how the tabs are displayed.
     * Accepted values are: 'top' and 'left'
     * 
     * @param string $placement
     * @return $this
     */
    function setPlacement($placement = null) {
        
        if( empty($placement) ) {
            
            $placement = 'top';
            
        }
        
        $this->placement = $placement;
        
        return $this;
        
    }
    
}


class EndTab extends Tab {
    
    public $endpoint = 1;
    
    function __construct() {
        
        parent::__construct(null);
        
    }
    
}


class Separator extends \Monk\ACF\Field {
    
    public $type = 'separator';
    
    function __construct() {
        
        parent::__construct(null);
        
    }
    
}


class Output extends \Monk\ACF\Field {
    
    public $html;
    public $type = 'output';
    
    function __construct($output) {
        
        parent::__construct(null);
        
        $this->html = $output;
        
    }
    
}