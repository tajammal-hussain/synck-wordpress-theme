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
    <!-- Main -->
    <main class="main-page homepage">