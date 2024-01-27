<?php

namespace Monk\ACF\Field;

/*
 * Content
 */


class Wysiwyg extends \Monk\ACF\Field {
    
    public $tabs;
    public $toolbar;
    public $media_upload = 0;
    public $type = 'wysiwyg';
    
    
    /**
     * 
     * Specify which tabs are available. Defaults to 'all'. 
     * Choices of 'all' (Visual & Text), 'visual' (Visual Only) or text (Text Only)
     * 
     * @param string $tabs Fallback to default if omitted
     * @return $this
     */
    function setTabs($tabs = null) {
        
        if( empty($tabs) ) {
            
            $tabs = 'all';
            
        }
        
        $this->tabs  = $tabs;
        
        return $this;
        
    }
    
    
    /**
     * 
     * Specify the editor's toolbar. Defaults to 'full'. 
     * Choices of 'full' (Full), 'basic' (Basic) or a custom toolbar (https://www.advancedcustomfields.com/resources/customize-the-wysiwyg-toolbars/)
     * 
     * @param string $toolbar Fallback to default if omitted
     * @return $this
     */
    function setToolbar($toolbar = null) {
        
        if( empty($toolbar) ) {
            
            $toolbar = 'full';
            
        }
        
        $this->toolbar = $toolbar;
        
        return $this;
        
    }
    
}


class File extends \Monk\ACF\Field {
    
    public $return_format = 'id';
    public $preview_size;
    public $library;
    public $mime_types;
    public $type = 'file';
    
    
    /**
     * 
     * Specify the type of value returned by get_field(). Defaults to 'array'.
     * Choices of 'array' (Image Array), 'url' (Image URL) or 'id' (Image ID)
     * 
     * @param string $format Fallback to default if omitted
     * @return $this
     */
    function setReturnFormat($format = null) {
        
        if( empty($format) ) {
            
            $format = 'array';
            
        }
        
        $this->return_format = $format;
        
        return $this;
        
    }
    
}


class Image extends File {
    
    public $type = 'image';
    
}


class Gallery extends Image {
    
    public $type = 'gallery';
    
}