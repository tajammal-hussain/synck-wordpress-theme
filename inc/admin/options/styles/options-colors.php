<?php
/**
 * Style & Colors
 */

Synck_Option::add_section( 'colors', array(
	'title' => __( 'Colors', 'synck-admin' ),
	'panel' => 'style',
) );

Synck_Option::add_field( '', array(
	'type'     => 'custom',
	'settings' => 'custom_title_colors_main',
	'label'    => __( '', 'synck-admin' ),
	'section'  => 'colors',
	'default'  => '<div class="options-title-divider">Main Colors</div>',
) );

Synck_Option::add_field( 'option', array(
	'type'        => 'color',
	'settings'    => 'color_primary',
	'label'       => __( 'Primary Color', 'synck-admin' ),
	'description' => __( 'Change primary color.', 'synck-admin' ),
	'section'     => 'colors',
	'default'     => Synck_Default::COLOR_PRIMARY,
	'transport'   => $transport,
) );

Synck_Option::add_field( 'option', array(
	'type'        => 'color',
	'settings'    => 'color_secondary',
	'transport'   => $transport,
	'label'       => __( 'Secondary Color', 'synck-admin' ),
	'description' => __( 'Change secondary color.', 'synck-admin' ),
	'default'     => Synck_Default::COLOR_SECONDARY,
	'section'     => 'colors',
) );

Synck_Option::add_field( 'option', array(
	'type'        => 'color',
	'settings'    => 'color_success',
	'transport'   => $transport,
	'label'       => __( 'Success Color', 'synck-admin' ),
	'description' => __( 'Change the success color. Used for global success messages.', 'synck-admin' ),
	'section'     => 'colors',
	'default'     => Synck_Default::COLOR_SUCCESS,
) );

Synck_Option::add_field( 'option', array(
	'type'        => 'color',
	'settings'    => 'color_alert',
	'transport'   => $transport,
	'label'       => __( 'Alert Color', 'synck-admin' ),
	'description' => __( 'Change the alert color. Used for global error messages etc.', 'synck-admin' ),
	'section'     => 'colors',
	'default'     => Synck_Default::COLOR_ALERT,
) );

Synck_Option::add_field( '', array(
	'type'     => 'custom',
	'settings' => 'custom_title_color_type',
	'label'    => __( '', 'synck-admin' ),
	'section'  => 'colors',
	'default'  => '<div class="options-title-divider">Type</div>',
) );

Synck_Option::add_field( 'option', array(
	'type'        => 'color',
	'settings'    => 'color_texts',
	'label'       => __( 'Base Color', 'synck-admin' ),
	'description' => __( 'Used for all normal texts.', 'synck-admin' ),
	'section'     => 'colors',
	'default'     => '#777',
	'transport'   => $transport,
) );

Synck_Option::add_field( 'option', array(
	'type'        => 'color',
	'settings'    => 'type_headings_color',
	'label'       => __( 'Headline Color', 'synck-admin' ),
	'description' => __( 'Used for all headlines on white backgrounds. (H1, H2, H3 etc.)', 'synck-admin' ),
	'section'     => 'colors',
	'default'     => '#555',
	'transport'   => $transport,
) );

Synck_Option::add_field( 'option', array(
	'type'        => 'color-alpha',
	'settings'    => 'color_divider',
	'label'       => __( 'Divider Color', 'synck-admin' ),
	'description' => __( 'Used for dividers.', 'synck-admin' ),
	'section'     => 'colors',
) );

Synck_Option::add_field( '', array(
	'type'     => 'custom',
	'settings' => 'custom_title_type_links',
	'label'    => __( '', 'synck-admin' ),
	'section'  => 'colors',
	'default'  => '<div class="options-title-divider">Links</div>',
) );

Synck_Option::add_field( 'option', array(
	'type'      => 'color',
	'settings'  => 'color_links',
	'label'     => __( 'Link Colors', 'synck-admin' ),
	'section'   => 'colors',
	'default'   => '#4e657b',
	'transport' => $transport,
) );

Synck_Option::add_field( 'option', array(
	'type'      => 'color',
	'settings'  => 'color_links_hover',
	'label'     => __( 'Link Colors :hover', 'synck-admin' ),
	'section'   => 'colors',
	'default'   => '#111',
	'transport' => $transport,
) );

Synck_Option::add_field( 'option', array(
	'type'      => 'color',
	'settings'  => 'color_widget_links',
	'label'     => __( 'Widget Link Colors', 'synck-admin' ),
	'section'   => 'colors',
	'default'   => '',
	'transport' => $transport,
) );

Synck_Option::add_field( 'option', array(
	'type'      => 'color',
	'settings'  => 'color_widget_links_hover',
	'label'     => __( 'Widget Link Colors :hover', 'synck-admin' ),
	'section'   => 'colors',
	'default'   => '',
	'transport' => $transport,
) );
