<?php

if ( ! isset( $content_width ) ) {
	$content_width = 1020; // Pixels.
}


/**
 * Setup Synck.
 */

function synck_setup(){
    
    /* add title tag support */
	add_theme_support( 'title-tag' );

    /* Add default posts and comments RSS feed links to head */
	add_theme_support( 'automatic-feed-links' );
    /* Add excerpt to pages */
	add_post_type_support( 'page', 'excerpt' );

    /* Add support for post thumbnails */
	add_theme_support( 'post-thumbnails' );
    /* Add support for Selective Widget refresh */
	add_theme_support( 'customize-selective-refresh-widgets' );

	/** Add sensei support */
	add_theme_support( 'sensei' );

    /* Add support for HTML5 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
		'widgets',
	) );

    /*  Enable support for Post Formats */
	add_theme_support( 'post-formats', array( 'video' ) );

	// Disable widgets-block-editor for now.
	remove_theme_support( 'widgets-block-editor' );
}
add_action( 'after_setup_theme', 'synck_setup');


/**
 * Add JSON to allowed file types.
 *
 * @param array $mimes Allowed file types.
 */
function allow_upload_mimes( $mimes ) {
	if ( ! isset( $mimes['json'] ) ) {
		$mimes['json'] = 'text/plain';
	}
	return $mimes;
}
add_filter( 'upload_mimes', 'allow_upload_mimes' );


/**
 * Add SVG to allowed file types.
 *
 * @param array $mimes Allowed file types.
 */
function allow_svg_upload( $mimes ) {
	if ( ! isset( $mimes['svg'] ) ) {
		$mimes['svg'] = 'image/svg+xml';
	}
	return $mimes;
}
add_filter( 'upload_mimes', 'allow_svg_upload' );
