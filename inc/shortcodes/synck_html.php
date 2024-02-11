<?php

/**
 * Renders the `synck_html` shortcode.
 *
 * @param array  $atts    An array of attributes.
 * @param string $content The shortcode content.
 * @param string $tag     The name of the shortcode, provided for context to enable filtering.
 *
 * @return string
 */
function synck_render_html_shortcode( $atts, $content, $tag ) {
	$atts = shortcode_atts(
		array(
			'class'      => '',
			
		),
		$atts,
		$tag
	);

	$classes = array();

	if ( ! empty( $atts['class'] ) )      $classes[] = $atts['class'];

	if ( empty( $classes ) ) {
		return do_shortcode( $content );
	}

	ob_start(); 
	?>
	<section class="html-area">
		<div class="custom-conatiner">
			<div class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">
				<?php echo do_shortcode( $content ); ?>
			</div>
		</div>
	</section>
	<?php

	return ob_get_clean();
}
add_shortcode( 'synck_html', 'synck_render_html_shortcode' );
