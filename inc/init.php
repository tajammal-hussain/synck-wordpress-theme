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
if(current_user_can( 'manage_options')){
    require get_template_directory() . '/inc/admin/admin-init.php';
}
  


/**
 * Setup.
 * Enqueue styles, register widget regions, etc.
 */


 