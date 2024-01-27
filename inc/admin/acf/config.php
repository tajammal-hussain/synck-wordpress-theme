<?php

namespace Monk\Config;
use Monk\Utils;

define("MONK_CONFIG", true);


remove_action('wp_enqueue_scripts', 'wp_common_block_scripts_and_styles');


function acf_init() {
    

    if( $api_key = get_theme_support('monk-google-maps') ) {
        
        acf_update_setting( 'google_api_key', reset($api_key) );
        
    }
    
    $labels_page    = acf_add_options_page([
        'page_title'    => __('Replace Labels'),
        'icon_url'      => 'dashicons-edit'
    ]);

    $labels_page_group  = new \Monk\ACF\Group('Edit Labels');
    $labels_page_field  = new \Monk\ACF\Field\Repeater('Edit Labels');

    $label_singular     = new \Monk\ACF\Field\Basic('Label');
    $label_translations = new \Monk\ACF\Field\Basic('Replace');
    $label_context      = new \Monk\ACF\Field\Basic('Context');

    $label_singular->setName('singular');
    $label_translations->setName('translations');
    $label_context->setName('context');

    $labels_page_field->addSubField($label_singular, $label_translations);
    $labels_page_field->layout = 'table';
    $labels_page_field->button_label = __('Replace Label');
    $labels_page_field->setName(MNK_REPLACE_LABELS_META_KEY);

   

    $labels_page_group->addField($labels_page_field);
    $labels_page_group->setStyle('seamless');
    $labels_page_group->addToOptions($labels_page);
        
}
add_action('acf/init', __NAMESPACE__ . '\acf_init');


function include_custom_fields() {
    
    require_once 'acf/field/icons.php';
    require_once 'acf/field/headings.php';
    require_once 'acf/field/layouts.php';
    require_once 'acf/field/mailchimp.php';
    
}
add_action('acf/include_field_types', __NAMESPACE__ . '\include_custom_fields');


function acf_load_value($value, $post_id, $field) {
    
    $field = wp_parse_args($field, [
        'default_value' => $value
    ]);
    
    $default = $field['default_value'];
    
    if( !isset($value) ) {
        
        $value = $default;
        
    }
     
    return $value;
    
}
add_filter('acf/load_value', __NAMESPACE__ . '\acf_load_value', 15, 3);

function setup_template_acf_fields ($post_type = null, $post = null) {

    $post_type  = $post_type ?: filter_input(INPUT_POST, 'post_type');
    $post       = $post ?: filter_input(INPUT_POST, 'post_id');
    
    if( is_numeric($post_type) ) {
        
        $post_type = get_post_type($post_type);
                
    }
    
    if( !function_exists('get_page_templates') ) {
        
        return;
        
    }
    
    $templates  = get_page_templates($post, $post_type);
    
    foreach( $templates as $title => $template ) {
        
        $headers    = Utils\parse_template_headers(get_template_directory() . "/$template", 'field_group');
        
        foreach( $headers as $header ) {
            
            $header = wp_parse_args($header, [
                'title' => $title,
                'key'   => 'group_mnk_' . sanitize_title($template)
            ]);
            
            $group = new \Monk\ACF\Group($header, false);
            
            $group->style = 'seamless';
            $group->addToTemplate($template);
                        
            $group->fields = array_map('\Monk\Utils\auto_resolve_acf_field', $group->fields);
            
            $group->register();
            
        }
        
    }

}
add_action('add_meta_boxes', __NAMESPACE__ . '\setup_template_acf_fields', 5, 2);
add_action('wp_ajax_acf/ajax/check_screen', __NAMESPACE__ . '\setup_template_acf_fields', 5);
add_action('save_post', __NAMESPACE__ . '\setup_template_acf_fields', 5, 2);

