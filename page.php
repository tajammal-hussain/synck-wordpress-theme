<?php
    /**
     * The blog template file.
     *
     * @package          Synck\Templates\Page
     * @Synck-version 1.0.0
     */
    get_header();
    do_action( 'synck_before_page' );
?>
    <?php while ( have_posts() ) : the_post(); ?>
        <?php do_action( 'synck_before_page_content' ); ?>
        
            <?php the_content(); ?>

            <?php if ( comments_open() || '0' != get_comments_number() ){
                comments_template(); } ?>

        <?php do_action( 'synck_after_page_content' ); ?>
    <?php endwhile; // end of the loop. ?>

<?php
    do_action( 'synck_after_page' );
    get_footer();
?>