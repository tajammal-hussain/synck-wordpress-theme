<?php
    /**
     * The blog template file.
     *
     * @package          Synck\Templates
     * @Synck-version 1.0.0
     */
    global $post_id;
    get_header();
     
    $page_layouts = get_field('page_layouts', $post_id);
    if($page_layouts) {
        foreach($page_layouts as $layout) {

        $layout_type = $layout['acf_fc_layout'];
            
        switch ($layout_type) {
            case 'icon_slider':
            break;
        }
    }
    }
    
?>
<?php get_footer(); ?>