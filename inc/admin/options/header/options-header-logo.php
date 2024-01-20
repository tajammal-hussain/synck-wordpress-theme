<?php

/*************
 * LOGO
 *************/

 
function synck_logo_name_customizer( $wp_customize ) {
	global $transport;
  $wp_customize->get_setting('blogname')->transport=$transport;
  $wp_customize->get_setting('blogdescription')->transport=$transport;
}
add_action( 'customize_register', 'synck_logo_name_customizer' );

Synck_Option::add_section( 'title_tagline', array(
	'title'       => __( 'Logo & Site Identity', 'synck-admin' ),
) );

Synck_Option::add_field( 'option',  array(
	'type'        => 'checkbox',
	'settings'     => 'site_logo_slogan',
	'label'       => __( 'Display below Logo', 'synck-admin' ),
	'section'     => 'title_tagline',
	'transport' => $transport,
	'default'     => 0,
));

Synck_Option::add_field( 'option',  array(
	'type'        => 'image',
	'settings'     => 'site_logo',
	'label'       => __( 'Logo image', 'synck-admin' ),
	'section'     => 'title_tagline',
	'transport' => $transport,
	'default'     => get_template_directory_uri().'/assets/imgs/logo.svg',
	'choices'   => array( 'save_as' => 'id' ),
));

Synck_Option::add_field( 'option',  array(
	'type'        => 'image',
	'settings'     => 'site_logo_dark',
	'label'       => __( 'Logo image - Light Version', 'synck-admin' ),
	'description' => __( 'Upload an alternative light logo that will be used on Dark and Transparent Header templates', 'synck-admin' ),
	'section'     => 'title_tagline',
	'transport' => $transport,
	'choices'   => array( 'save_as' => 'id' ),
));


Synck_Option::add_field( 'option',  array(
	'type'        => 'slider',
	'settings'     => 'logo_width',
	'label'       => __( 'Logo container width', 'synck-admin' ),
	'section'     => 'title_tagline',
	'default'     => 200,
	'choices'     => array(
		'min'  => 30,
		'max'  => 700,
		'step' => 1
	),
	'transport' => 'postMessage',
));

Synck_Option::add_field( 'option',  array(
  'type'        => 'text',
  'settings'     => 'logo_max_width',
  'label'       => __( 'Logo max width (px)', 'synck-admin' ),
  'section'     => 'title_tagline',
  'description' => __( 'Set the logo max width in pixels. Leave it blank to make it auto fit inside the logo container.', 'synck-admin' ),
  'transport' => 'postMessage',
));

Synck_Option::add_field( 'option',  array(
	'type'        => 'slider',
	'settings'     => 'logo_padding',
	'label'       => __( 'Logo Padding', 'synck-admin' ),
	'section'     => 'title_tagline',
	'default'     => 0,
	'choices'     => array(
		'min'  => 0,
		'max'  => 30,
		'step' => 1
	),
	'transport' => 'postMessage',
));

Synck_Option::add_field( 'option', array(
	'type'        => 'link',
	'settings'    => 'logo_link',
	'label'       => __( 'Logo link', 'flatsome' ),
	'description' => __( 'Custom logo link (defaults to home page link if empty).', 'flatsome' ),
	'section'     => 'title_tagline',
	'default'     => '',
) );
