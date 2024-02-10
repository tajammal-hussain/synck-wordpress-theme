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
            case 'columns':
                $responsive = array_map(function($item, $key) {
                    return "{$key}-{$item}";
                }, $layout['layout'], array_keys($layout['layout']));
                $columns = array_map(function($item) {
                    return "[content]{$item['content']}[/content]";
                }, $layout['columns']);
                $_responsive = implode(" ", $responsive);
                $_columns = implode(" ", $columns);
                echo "[synck_row classes=\"{$_responsive}\"]{$_columns}[/synck_row]";
            break;
        }
    }
    }
    
?>
<?php get_footer(); ?>