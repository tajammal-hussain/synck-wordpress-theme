<?php

/**
 * Renders the `synck_icon_box` shortcode.
 *
 * @param array  $atts    An array of attributes.
 * @param string $content The shortcode content.
 * @param string $tag     The name of the shortcode, provided for context to enable filtering.
 *
 * @return string
 */

 function synck_icon_box_shortcode( $atts, $content, $tag ) {
    $atts = shortcode_atts(
		array(
			'class'      => '',
		),
		$atts,
		$tag
	);
    $classes = array();
    
	if ( ! empty( $atts['class'] ) )      $classes[] = $atts['class'];

    ob_start(); 

    ?>
    <section class="service-area <?php echo esc_attr( implode( ' ', $classes ) ); ?> ">
        <div class="services-list d-flex">
            <?php echo do_shortcode( $content ); ?>
        </div>
    </section>
    <?php
    return ob_get_clean();
}

add_shortcode('synck_icon_box', 'synck_icon_box_shortcode');