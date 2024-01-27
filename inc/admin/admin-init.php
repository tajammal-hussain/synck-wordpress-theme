<?php
/**
 * Synck Admin Engine Room.
 * This is where all Admin Functions run
 *
 * @package Synck
 */


//Global CSS

define( 'SYNCK_ADMIN_ROOT', dirname(__DIR__) );

require get_template_directory(). '/inc/admin/customizer/customizer-config.php';

//ACF
require get_template_directory(). '/inc/admin/acf/acf.php';


 // Add Options
if(is_customize_preview()){
    include_once(dirname( __FILE__ ).'/options/helpers/options-helpers.php');    
    include_once(dirname( __FILE__ ).'/options/styles/options-css.php');
    include_once(dirname( __FILE__ ).'/options/styles/options-colors.php');
    // include_once(dirname( __FILE__ ).'/options/styles/options-lightbox.php');

    //Header
    include_once(dirname( __FILE__ ).'/options/header/options-header.php');

}


