<?php

/**
 * Renders the `synck_banner` shortcode.
 *
 * @param array  $atts    An array of attributes.
 * @param string $content The shortcode content.
 * @param string $tag     The name of the shortcode, provided for context to enable filtering.
 *
 * @return string
 */

 function synck_render_banner_shortcode( $atts, $content, $tag ) {
    $atts = shortcode_atts(
		array(
			'class'      => '',
            'lightbox_image_size' => 'large',
			'bg' => ''
		),
		$atts,
		$tag
	);
        $classes = array();

        if ( ! empty( $atts['class'] ) )      $classes[] = $atts['class'];

        $_attachments = get_post( $atts['bg'] );
        $image = wp_get_attachment_image_src($_attachments->ID, $atts['lightbox_image_size']);
        if(!$image){
            ob_end_clean();
            return '';
        }
        ob_start(); 

    ?>
        <section class="hero-service-wrap hero-section-wrap hero-career-wrap <?php echo esc_attr( implode( ' ', $classes ) ); ?>">
        <div class="hero-section-content-wrap">
                <img src="<?php echo $image[0];?>" alt="<?php echo $_attachments->title; ?>" class="animation-slide-left bg-shape slide-left">
                <div class="custom-container">
                    <div class="hero-portfolio-body">
                        <div class="hero-section-content text-center">
                            <?php echo do_shortcode( $content ); ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
  	<?php
    return ob_get_clean();
}
 add_shortcode('synck_banner', 'synck_render_banner_shortcode');