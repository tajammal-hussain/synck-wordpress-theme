<?php
/**
 * Save ACF into Shortcode.
 */
 function synck_html( $post_id ) {

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (get_post_type($post_id) !== 'page') return;
    $acf_field_1 = get_field('your_acf_field_1', $post_id);
    $html = get_field('html', $post_id);

    if($html)
    {
        $shortcode = "[synck_html content='$html'";
        $post_data = array(
            'ID'           => $post_id,
            'post_content' => $shortcode,
        );
        wp_update_post($post_data);
    }
 }
 add_action( 'acf/save_post', 'synck_html', 20 );