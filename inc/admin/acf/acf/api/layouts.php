<?php

namespace Monk\ACF\Field;

require_once 'layout.php';

/*
 * Layout
 */


class FlexibleContent extends \Monk\ACF\Field {
    
    public $button_label;
    public $layouts = [];
    public $type    = 'flexible_content';
    
    
    function __construct($label, $type = null) {
        parent::__construct($label, $type);
        
        if( empty($this->button_label) ) {
            
            $this->button_label = sprintf(__('Add %s'), $this->label);
            
        }
        
    }
    
    
    function addLayout(\Monk\ACF\Layout $layout) {
        
        foreach(func_get_args() as $layout) {
                                    
            array_push($this->layouts, $layout);
            
        }
        
        return $this;
        
    }
    
    
    function copy($label = null) {
        
        $field = parent::copy($label);
                
        array_walk($field->layouts, function(\Monk\ACF\Layout &$layout) {
            
            $layout = $layout->copy();
        
        });
        
        return $field;
        
    }
    
    
    function register($parent) {
        
        $field = parent::register($parent);
        
        foreach($field['layouts'] as &$layout) {
            
            if($layout instanceof \Monk\ACF\Layout) {

                $layout = $layout->register($this);

            }
            
        }
        
        return $field;
        
    }
    
}


class Layouts extends FlexibleContent {
    
    public $type = 'layouts';
    public $root = 'layout';
    
    function parse($path = '.') {
        
        $root   = sprintf('%s/admin/builder/%s', SYNCK_ADMIN_ROOT, $this->root);
        $paths  = glob( sprintf('%s/%s/*{,/*}.php', $root, trim($path, '/') ), GLOB_BRACE);

        foreach($paths as $path) {

           $headers = \Monk\Utils\parse_template_headers($path, 'layout');
           $slug    = trim(str_replace($root, '', $path), './');
           $path    = str_replace(SYNCK_ADMIN_ROOT, '', $path);
           foreach($headers as &$layout) {
               
               $layout['name'] = str_replace('.php', '', $slug);;
               $layout['key']  = "layout_mnk_" . sanitize_title($path);
               $this->addLayout( new \Monk\ACF\Layout($layout) );
           }
        }
        
    }
    
}