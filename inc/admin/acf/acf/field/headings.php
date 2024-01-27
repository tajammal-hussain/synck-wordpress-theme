<?php

defined('ABSPATH') || die;

if( class_exists('acf_field') ) :

class monk_acf_field_headings extends acf_field_text {
    
    static public $atts = [];
    
    function initialize() {
        
        parent::initialize();
        
        // vars
        $this->name     = 'heading';
        $this->label    = __('Heading');
        $this->category = 'Monk4';
        $this->defaults = array_merge($this->defaults, [
            'heading_level'     => '2',
            'heading_classes'   => 'heading',
            'heading_id'        => ''
        ]);
        
    }
    
    
    function render_field_settings($field) {
        
        acf_render_field_setting($field, [
            'label'         => __('Heading Level'),
            'instructions'  => __(''),
            'type'          => 'select',
            'name'          => 'heading_level',
            'choices'       => [
                'h1'    => __('Heading 1'),
                'h2'    => __('Heading 2'),
                'h3'    => __('Heading 3'),
                'h4'    => __('Heading 4'),
                'h5'    => __('Heading 5'),
                'h6'    => __('Heading 6')
            ],
            'default_value' => 'h2'
        ]);
        
        acf_render_field_setting($field, [
            'label'         => __('Heading Classes'),
            'instructions'  => __(''),
            'type'          => 'text',
            'name'          => 'heading_classes',
            'default_value' => 'heading'
        ]);
        
        acf_render_field_setting($field, [
            'label'         => __('Heading ID'),
            'instructions'  => __(''),
            'type'          => 'text',
            'name'          => 'heading_id'
        ]);
        
        parent::render_field_settings($field);
        
    }
    
    function render_field($field) {
        
        $field['type'] = 'text';
        
        parent::render_field($field);
        
    }
    
    function format_value( $value, $post_id, $field ) {

        if( empty($value) )
            return $value;

        $atts            = self::$atts;
        $tag             = 'h' . $field['heading_level'];

        $atts['class']   = $field['heading_classes'];
        $atts['id']      = $field['heading_id'];

        $atts            = apply_filters( "monk\acf\heading\atts", array_filter($atts) );

        return sprintf( "<$tag %s >$value</$tag>", acf_esc_attr($atts) );
        
    }
    
}

return new monk_acf_field_headings();

endif;