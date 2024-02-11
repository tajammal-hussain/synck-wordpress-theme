<?php

function synck_icon_slider($atts) {
    extract(shortcode_atts(array(
        '_id' => 'icon_slider-'.rand(),
        'class' => '',
        'ids' => '', // Gallery IDS
        'lightbox_image_size' => 'large',
    ), $atts));
    ob_start();
     // Get attachments
    $_attachments = get_posts( array( 'include' => $ids, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image' ) );

    $attachments = array();
    foreach ( $_attachments as $key => $val ) {
        $attachments[$val->ID] = $_attachments[$key];
    }
    ?>
    <section class="client-area">
        <div class="clients clients-marquee d-flex align-items-center">

    <?php
    if ( empty( $attachments ) ) {
        ob_end_clean();
        return '';
    }
    foreach ( $attachments as $id => $attachment ) {
        $get_image = wp_get_attachment_image_src( $attachment->ID, $lightbox_image_size);
        ?>
            <div class="client-logo simple-shadow">
                <img src="<?php echo $get_image[0]; ?>" alt="Client" />
            </div>
        <?php
    }
    ?>
        </div>
    </section>
    <?php
    $content = ob_get_contents();
    ob_end_clean();
    return $content;
}
add_shortcode('synck_icon_slider', 'synck_icon_slider');