<?php

/**
 * Renders the `icon_box` shortcode.
 *
 * @param array  $atts    An array of attributes.
 * @param string $content The shortcode content.
 * @param string $tag     The name of the shortcode, provided for context to enable filtering.
 *
 * @return string
 */
function synck_sub_icon_box_shortcode( $atts, $content, $tag ) {
    $atts = shortcode_atts(
		array(
            'icon'=> '',
            'title' => '',
            'lightbox_image_size' => 'large'
		),
		$atts,
		$tag
	);
    ob_start(); 

    $_attachments = get_post( $atts['icon'] );
    $image = wp_get_attachment_image_src($_attachments->ID, $atts['lightbox_image_size']);
    if(!$image){
        ob_end_clean();
        return '';
    }

    ?>
       <div class="service-card simple-shadow pop-in">
            <img src="<?php echo $image[0]; ?>" alt="<?php echo $_attachments->title; ?>" class="service-icon">
            <h3><a href="./service-details.html"><?php echo $atts['title']; ?></a></h3>
            <p><?php echo do_shortcode( $content); ?></p>
        </div> 
    <?php
    return ob_get_clean();
}
add_shortcode('icon_box', 'synck_sub_icon_box_shortcode');