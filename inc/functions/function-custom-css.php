<?php
/* CUSTOM CSS */
function _custom_css() {
        ob_start();
    ?>
    <style id="custom-css" type="text/css">
        #logo{width:<?php echo get_theme_mod('logo_width', 200); ?>px;}

        <?php if(get_theme_mod('logo_padding')) echo '.header-area .logo img{padding:'.get_theme_mod('logo_padding').'px 0;}'; ?>
        <?php if(get_theme_mod('logo_width')) echo '.header-area .logo img{max-width:'.get_theme_mod('logo_width').'px;}'; ?>

    </style>
<?php
    $buffer = ob_get_clean();
    echo minify_css($buffer);
}
add_action( 'wp_head', '_custom_css', 100 );
