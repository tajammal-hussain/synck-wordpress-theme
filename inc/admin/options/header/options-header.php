<?php


/*************
 * Header Panel
 *************/

Synck_Option::add_panel( 'header', array(
	'title'       => __( 'Header', 'synck-admin' ),
	'description' => __( 'Header Options here.', 'synck-admin' ),
) );

include_once(dirname( __FILE__ ).'/options-header-logo.php');
include_once(dirname( __FILE__ ).'/options-header-buttons.php');
