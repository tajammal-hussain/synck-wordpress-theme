<?php
/**
 * Synck template.
 *
 * @package          Synck\Templates
 * @Synck-version 1.0.0
 */

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> class="">
<head>
	 <!-- ========== Meta Tags ========== -->
     <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta charset="<?php bloginfo( 'charset' ); ?>" />
	
    <link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />


	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php do_action( 'synck_after_body_open' ); ?>

<a class="skip-link screen-reader-text" href="#main"><?php esc_html_e( 'Skip to content', 'flatsome' ); ?></a>
    <!-- Main -->
    <main class="main-page homepage">
        <!-- Header -->
        <header class="header-area">
            <div class="custom-container">
                <div class="custom-row align-items-center justify-content-between">
                    <?php get_template_part( 'template-parts/header/header', 'wrapper' ); ?>
                </div>
            </div>
        </header>