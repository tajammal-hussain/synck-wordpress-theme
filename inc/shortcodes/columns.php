<?php

/**
 * Renders the `synck_column` shortcode.
 *
 * @param array  $atts    An array of attributes.
 * @param string $content The shortcode content.
 * @param string $tag     The name of the shortcode, provided for context to enable filtering.
 *
 * @return string
 */
function synck_column ( $atts, $content, $tag ){
    $atts = shortcode_atts(
		array(
            'classes'=> '',
            'title' => '',
            'lightbox_image_size' => 'large'
		),
		$atts,
		$tag
	);
    $classes = array();
    
	if ( ! empty( $atts['class'] ) )      $classes[] = $atts['class'];
    ob_start(); 
    ?>

    <section class="service-area">
        <div class="custom-container">
            <div class="service-section-header section-header d-flex align-items-end justify-content-between <?php echo esc_attr( implode( ' ', $classes ) ); ?> ">
                <?php echo do_shortcode( $content) ;?>
            </div>
        </div>
    </section>
    <?php
    return ob_get_clean();
}
add_shortcode('synck_row', 'synck_column');

function content_shortcode($atts, $content, $tag ){
    ob_start(); 
    ?>
        <div class="col">
            <?php echo do_shortcode( $content) ;?>
        </div>
    <?php
    return ob_get_clean();
}
add_shortcode('content', 'content_shortcode');