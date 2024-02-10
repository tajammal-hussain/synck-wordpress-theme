<?php
/**
 * Save ACF into Shortcode.
 */
 function synck_html( $post_id ) {

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
     
    $page_layouts = get_field('page_layouts', $post_id);
    $shortcode = "";
    if($page_layouts) {
        foreach($page_layouts as $layout) {

        $layout_type = $layout['acf_fc_layout'];
        $classes = "class=\"{$layout['display']['bg']} {$layout['display']['py']}\"";
        switch ($layout_type) {
            case 'html':
                $shortcode .= "[sync_html {$classes}]{$layout['html']}[/sync_html]";
            break;
            case 'banner':
                $shortcode .= "[sync_banner bg=\"{$layout['image']}\" {$classes} ]{$layout['content']}[/sync_banner]
                ";
            break;
            case 'text_-_image':
                $shortcode .= "[synck_image_text bg=\"{$layout['image']}\" {$classes} hortizontal=\"{$layout['horizontal_layout']}\"]
                        {$layout['content']}[/synck_image_text]";
            break;
            case 'icon_slider':
                $icons = array_map(function($item) {
                    return $item['icon'];
                }, $layout['icon_box']);
                
                // Convert array to comma-separated string
                $images = implode(',', $icons);
                $shortcode .="[synck_icon_slider icons=\"{$images}\" {$classes}]";
            break;
            case 'icon_box':
                $icons = array_map(function($item) {
                    return "[icon_box icon=\"{$item['icon']}\" title=\"{$item['title']}\"]{$item['content']}[/icon_box]";
                }, $layout['icon_box']);
                $icon_box=implode(' ', $icons);
                $shortcode.="[synck_icon_box {$classes}]{$icon_box}[/synck_icon_box]";
            break;
            case 'columns':
                $responsive = array_map(function($item, $key) {
                    return "{$key}-{$item}";
                }, $layout['layout'], array_keys($layout['layout']));
                $columns = array_map(function($item) {
                    return "[content]{$item['content']}[/content]";
                }, $layout['columns']);
                $_responsive = implode(" ", $responsive);
                $_columns = implode(" ", $columns);
                $shortcode.="[synck_row classes=\"{$_responsive} {$classes}\"]{$_columns}[/synck_row]";
            break;
        }
    }
    }
    $post_data = array(
        'ID'           => $post_id,
        'post_content' => $shortcode,
    );
    wp_update_post($post_data);
 }
 add_action( 'acf/save_post', 'synck_html', 1, 20 );