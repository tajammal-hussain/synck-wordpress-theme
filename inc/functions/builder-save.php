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
        switch ($layout_type) {
            case 'html':
                $shortcode .= "[sync_html content=\"{$layout['html']}\" class=\"{$layout['display']['bg']} {$layout['display']['py']}\"]";
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