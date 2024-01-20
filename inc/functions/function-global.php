<?php


/*
 * Enqueue Synck Styles
 *
 * Check if the 'synck_enqueue_styles' function does not already exist.
 * If not, define and enqueue the necessary styles, such as 'synck-icons'.
 * These styles are essential for the Synck theme, enhancing its visual elements.
 */
if(!function_exists("synck_enqueue_styles"))
{
    function synck_enqueue_styles(){

        // ========== Start THeme Stylesheet ========== 
        wp_enqueue_style('synck-icons', get_template_directory_uri().'/assets/css/iconoir.css"', '', '1.0.0', true);
        
        //Bootstrap
        wp_enqueue_style('synck-bootstrap', get_template_directory_uri().'/assets/css/bootstrap.min.css"', '', '5.3.2', true);

        //Swiper
        wp_enqueue_style('synck-Swiper', get_template_directory_uri().'/assets/css/swiper-bundle.min.css"', '', '10.2.0', true);
        
        //Global CSS
        wp_enqueue_style('synck-Global-Style', get_template_directory_uri().'/assets/css/style.css"', '', '10.2.0', true);

        //Responsiveness
        wp_enqueue_style('synck-Global-Style', get_template_directory_uri().'/assets/css/responsive.css"', '', '10.2.0', true);
        // ========== End Theme Stylesheet ==========

    }
    add_action( 'wp_enqueue_scripts', 'synck_enqueue_styles' );
}



if(!function_exists("synck_enqueue_scripts")){

    function synck_enqueue_scripts(){
        // ========== Start THeme Scripts ========== 
        wp_enqueue_script('synck-bootstrap', get_template_directory_uri(  ). '/assets/js/bootstrap.bundle.min.js', array('jquery'), '5.3.2', true);
        wp_enqueue_script('synck-gsap', get_template_directory_uri(  ). '/assets/js/gsap.min.js', array('jquery'), '3.7.0', true);
        wp_enqueue_script('synck-draggable-min', get_template_directory_uri(  ). '/assets/js/Draggable.min.js', array('jquery'), '3.12.2', true);
        wp_enqueue_script('synck-swiper-bundle.min', get_template_directory_uri(  ). '/assets/js/swiper-bundle.min.js', array('jquery'), '3.12.2', true);
        wp_enqueue_script('synck-client-marquee', get_template_directory_uri(  ). '/assets/js/client-marquee.js', array('jquery'), '3.12.2', true);
        wp_enqueue_script('synck-theme-custom', get_template_directory_uri(  ). '/assets/js/theme-custom.js', array('jquery'), '3.12.2', true);
        // ========== End Theme Scripts ==========
    }
    add_action( "wp_enqueue_scripts", "synck_enqueue_scripts");
}