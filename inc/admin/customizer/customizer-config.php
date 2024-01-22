<?php
/**
 * Add Custom CSS to Customizer
 */

function synck_enqueue_customizer_stylesheet() {
    $theme = wp_get_theme( get_template() );
    $version = $theme['Version'];

    wp_enqueue_style( 'synck-customizer-admin', get_template_directory_uri() . '/assets/admin/css/admin-customizer.css', NULL, $version, 'all' );
}
add_action( 'customize_controls_print_styles', 'synck_enqueue_customizer_stylesheet' );
