<?php
/**
 * Save ACF into Shortcode.
 */
function synck_html( $post_id ) {
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;

    $page_layouts = get_field('page_layouts', $post_id);

    if(!$page_layouts) return;

    $shortcode = "";

    foreach($page_layouts as $layout) {
        $classes = "class=\"{$layout['display']['bg']} {$layout['display']['py']}\"";
        $shortcode .= generate_shortcode($layout, $classes);
    }
    
    $post_data = array(
        'ID'           => $post_id,
        'post_content' => $shortcode,
    );
    
    wp_update_post($post_data);
}

function generate_shortcode($layout, $classes) {
    $shortcode = "";

    switch ($layout['acf_fc_layout']) {
        case 'html':
            $shortcode .= "[synck_html {$classes}]{$layout['html']}[/synck_html]";
            break;
        case 'banner':
            $shortcode .= "[synck_banner bg=\"{$layout['image']}\" {$classes} ]{$layout['content']}[/synck_banner]";
            break;
        case 'text_-_image':
            $shortcode .= "[synck_image_text bg=\"{$layout['image']}\" {$classes} hortizontal=\"{$layout['horizontal_layout']}\"]{$layout['content']}[/synck_image_text]";
            break;
        case 'icon_slider':
            $icons = implode(',', array_column($layout['icon_box'], 'icon'));
            $shortcode .= "[synck_icon_slider ids=\"{$icons}\" {$classes}]";
            break;
        case 'icon_box':
            $icon_box = implode(' ', array_map(function($item) {
                return "[icon_box icon=\"{$item['icon']}\" title=\"{$item['title']}\"]{$item['content']}[/icon_box]";
            }, $layout['icon_box']));
            $shortcode .= "[synck_icon_box {$classes}]{$icon_box}[/synck_icon_box]";
            break;
        case 'columns':
            $responsive = implode(" ", array_map(function($item, $key) {
                return "{$key}-{$item}";
            }, $layout['layout'], array_keys($layout['layout'])));

            $columns = implode(" ", array_map(function($item) {
                return "[content]{$item['content']}[/content]";
            }, $layout['columns']));

            $shortcode .= "[synck_row classes=\"{$responsive} {$classes}\"]{$columns}[/synck_row]";
            break;
    }

    return $shortcode;
}

add_action( 'acf/save_post', 'synck_html', 20 );
