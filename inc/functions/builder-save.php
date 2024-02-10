<?php
/**
 * Save ACF into Shortcode.
 */
 function synck_html( $post_id ) {

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
     
    $page_layouts = get_field('page_layouts', $post_id);
    $shortcode = "";
    if($page_layouts) {
        foreach($page_layouts as $layout) {

        $layout_type = $layout['acf_fc_layout'];
        $classes = "class=\"{$layout['display']['bg']} {$layout['display']['py']}\"";
        switch ($layout_type) {
            case 'html':
                $shortcode .= "[sync_html content=\"{$layout['html']}\" {$classes}]";
            break;
            case 'banner':
                $shortcode .= "[sync_banner bg=\"{$layout['image']}\" content=\"{$layout['content']}\"  {$classes}";
            break;
            case 'text_-_image':
                $shortcode .= "[synck_image_text bg=\"{$layout['image']}\" content=\"{$layout['content']}\"  {$classes} hortizontal=\"{$layout['horizontal_layout']}\"]";
            break;
            case 'icon_slider':
                $icons = array_map(function($item) {
                    return $item['icon'];
                }, $layout['icon_box']);
                
                // Convert array to comma-separated string
                $images = implode(',', $icons);
                $shortcode .="[synck_icon_slider icons=\"{$images}\" {$classes}]";
            break;
        }
    }
    }
    $post_data = array(
        'ID'           => $post_id,
        'post_content' => $shortcode,
    );
    wp_update_post($post_data);
 }
 add_action( 'acf/save_post', 'synck_html', 1, 20 );