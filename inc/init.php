<?php
/**
* Synck Template Inc.
* This section houses the core functions for the Synck theme.
* @package Synck
*/

//Require Classes
require get_template_directory() . '/inc/classes/class-synck-default.php';
require get_template_directory() . '/inc/classes/class-synck-options.php';


/**
 * Integrate Kirki.
 * For accessibility from the frontend and the generation of local Font CSS
 * within the kirki-inline-styles <style> element, options-type.php must be accessible.
*/
require get_template_directory() . '/inc/admin/kirki/kirki.php';
require get_template_directory() . '/inc/admin/kirki-config.php';
require get_template_directory() . '/inc/admin/options/styles/options-type.php';

/**
 * Theme Admin
 */
   require get_template_directory() . '/inc/admin/admin-init.php';
/**
 * Setup.
 * Enqueue styles, register widget regions, etc.
 */
require get_template_directory(). '/inc/functions/function-global.php';
require get_template_directory(). '/inc/functions/function-setup.php';
require get_template_directory() . '/inc/functions/function-custom-css.php';
require get_template_directory() . '/inc/functions/builder-save.php';

/**
 * Setup.
 * Shortcodes
 */
require get_template_directory(). '/inc/shortcodes/synck_icon_slider.php';
require get_template_directory(). '/inc/shortcodes/synck_html.php';
require get_template_directory(). '/inc/shortcodes/synck_banner.php';
require get_template_directory(). '/inc/shortcodes/icon_box.php';
require get_template_directory(). '/inc/shortcodes/synck_icon_box.php';
require get_template_directory(). '/inc/shortcodes/columns.php';