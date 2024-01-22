<?php

Synck_Option::add_section( 'header_buttons',
	array(
		'title' => __( 'Buttons', 'synck-admin' ),
		'panel' => 'header',
	)
);

Synck_Option::add_field( '',
	array(
		'type'     => 'custom',
		'settings' => 'custom_title_button_1',
		'label'    => __( '', 'synck-admin' ),
		'section'  => 'header_buttons',
		'default'  => '<div class="options-title-divider">Contact Us</div>',
	)
);

Synck_Option::add_field( 'option',
	array(
		'type'      => 'text',
		'settings'  => 'header_button_1',
		'transport' => $transport,
		'default'   => 'Button 1',
		'label'     => __( 'Call Us Text', 'synck-admin' ),
		'section'   => 'header_buttons',
	)
);




Synck_Option::add_field( 'option',
	array(
		'type'        => 'text',
		'settings'    => 'header_button_1_link',
		'transport'   => $transport,
		'default'     => '',
		'label'       => __( 'Link', 'synck-admin' ),
		'section'     => 'header_buttons',
		'description' => $smart_links,
	)
);

Synck_Option::add_field( 'option',
	array(
		'type'      => 'select',
		'settings'  => 'header_button_1_link_target',
		'transport' => $transport,
		'label'     => __( 'Target', 'synck-admin' ),
		'section'   => 'header_buttons',
		'default'   => '_self',
		'choices'   => array(
			'_self'  => __( 'Same window', 'synck-admin' ),
			'_blank' => __( 'New window', 'synck-admin' ),
		),
	)
);

Synck_Option::add_field( 'option',
	array(
		'type'        => 'text',
		'settings'    => 'header_button_1_link_rel',
		'transport'   => $transport,
		'default'     => '',
		'label'       => __( 'Rel', 'synck-admin' ),
		'section'     => 'header_buttons',
	)
);

Synck_Option::add_field( 'option',
	array(
		'type'      => 'text',
		'settings'  => 'header_button_1_radius',
		'transport' => $transport,
		'default'   => '99px',
		'label'     => __( 'Radius', 'synck-admin' ),
		'section'   => 'header_buttons',
	)
);
Synck_Option::add_field( '',
	array(
		'type'     => 'custom',
		'settings' => 'custom_title_button_2',
		'label'    => __( '', 'flatsome-admin' ),
		'section'  => 'header_buttons',
		'default'  => '<div class="options-title-divider">Call Us</div>',
	)
);

Synck_Option::add_field( 'option',
	array(
		'type'      => 'text',
		'settings'  => 'header_button_2',
		'transport' => $transport,
		'default'   => 'Button 2',
		'label'     => __( 'Text', 'synck-admin' ),
		'section'   => 'header_buttons',
	)
);

Synck_Option::add_field( 'option',
	array(
		'type'      => 'text',
		'settings'  => 'header_button_2_bottom',
		'transport' => $transport,
		'default'   => 'Button 1',
		'label'     => __( 'Number', 'synck-admin' ),
		'section'   => 'header_buttons',
	)
);

Synck_Option::add_field( 'option',
	array(
		'type'        => 'text',
		'settings'    => 'header_button_2_link',
		'transport'   => $transport,
		'default'     => '',
		'label'       => __( 'Link', 'synck-admin' ),
		'section'     => 'header_buttons',
		'description' => $smart_links,
	)
);

Synck_Option::add_field( 'option',
	array(
		'type'      => 'select',
		'settings'  => 'header_button_2_link_target',
		'transport' => $transport,
		'label'     => __( 'Target', 'synck-admin' ),
		'section'   => 'header_buttons',
		'default'   => '_self',
		'choices'   => array(
			'_self'  => __( 'Same window', 'synck-admin' ),
			'_blank' => __( 'New window', 'synck-admin' ),
		),
	)
);

Synck_Option::add_field( 'option',
	array(
		'type'        => 'text',
		'settings'    => 'header_button_2_link_rel',
		'transport'   => $transport,
		'default'     => '',
		'label'       => __( 'Rel', 'synck-admin' ),
		'section'     => 'header_buttons',
	)
);

