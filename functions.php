<?php
/**
 * Synck functions and definitions
 *
 * @package Synck
 */

require get_template_directory() . '/inc/init.php';

define('MNK_REPLACE_LABELS_META_KEY', '_mnk_replace_labels');


add_action('acf/init', function() {
    $colors = [
        'none'      => __('None'),
        'primary'   => __('Dark Blue'),
        'light'     => __('Light Blue'),
        'gradient'  => __('Gradient')
    ];
    
    $footer_screen  = acf_add_options_page( __('Footer') );
    $footer_group   = new \Monk\ACF\Group();
    
    $signup_fields  = new \Monk\ACF\Field\Group('Signup');
    $signup_text    = new Monk\ACF\Field\Textarea('Text');
    $signup_text->wrapNewLines('br');
    
    $signup_modal   = new Monk\ACF\Field\Textarea('Modal');
    
    $signup_fields->addSubField($signup_text, $signup_modal);
    
    $footer_fields  = new \Monk\ACF\Field\Group('Footer');
    $footer_fields->layout = 'table';
    $footer_fields->addSubField(
            new Monk\ACF\Field\Wysiwyg('Col 1'),
            new Monk\ACF\Field\Wysiwyg('Col 2')
    );
    
    $footer_group->addField($signup_fields, $footer_fields);
    $footer_group->addToOptions($footer_screen);
    
    mnk_init_frontpage_fields();
    
    
    // Boilerplate setup for page templates, including the front page but excluding regular pages. 
    // Hides the content editor by default and loads in the page layouts ACF field.
    $page_templates = new \Monk\ACF\Group('Page Templates');
    $page_templates->setStyle();
    // $page_templates->hideOnScreen('the_content');
    // $page_templates->setPosition('high');
    $page_templates->menu_order = 99;
    
    $page_templates->addToTemplate();
    $page_templates->addLocation('front_page', 'page_type', '!=', false);
//    $page_templates->addLocation('posts_page', 'page_type', '!=', false);
    
    // $page_templates->addToFrontpage();
    
    $layouts = new \Monk\ACF\Field\Layouts('Page Layouts');
    $layouts->parse();
 
    foreach($layouts->layouts as $layout) {
        
        /** @var Monk\ACF\Layout $layout */
        
        $display = new \Monk\ACF\Field\Group('Display');
        
        $display_bg = new Monk\ACF\Field\Radio('Background Color');
        $display_bg->addChoices($colors);
        $display_bg->setName('bg');
        $display_bg->default_value = reset($colors);
        $display_bg->layout = 'horizontal';
        
        $display_padding = new Monk\ACF\Field\Radio('Padding');
        $display_padding->setName('py');
//        $display_padding->default_value = '6';
        $display_padding->layout = 'horizontal';
        $display_padding->addChoices('6', 'Cozy');
        $display_padding->addChoices('4', 'Compact');
        $display_padding->addChoices('0', 'None');
    
        $display->addSubField($display_bg, $display_padding);
        
        $layout->addSubField($display);
        
    }
    $page_templates->addField($layouts);
});



/**
 * Init frontpage fields
 * 
 * @return \Monk\ACF\Group
 */
function mnk_init_frontpage_fields() {
    
    $notes = new Monk\ACF\Field\Message('<h3>Note: all fields are ordered relative to where they are rendered on the front page.</h3>');
    
    $frontpage = new Monk\ACF\Group();
    $frontpage->addToFrontpage();
    $frontpage->hideOnScreen('the_content');
    $frontpage->setPosition('high');
    
    $banner = new \Monk\ACF\Field\Group('Banner');
    
    $banner->instructions = 'This field group controls the full height banner displayed at the top of the page. Currently only the text and popout video are controllable, the background video is hard-coded.';
    
    $banner_text = new Monk\ACF\Field\Textarea('Text');
    $banner_text->wrapNewLines('br');
    $banner_text->instructions = "The text to display over the background video.";
    
    $banner_video = new \Monk\ACF\Field\Basic('Video', 'url');
    $banner_video->instructions = 'The video to play in the popout display. Can be either a vimeo or youtube link but vimeo is recommended.';
    
    $banner->addSubField(
//            new Monk\ACF\Field('Background', 'oembed'),
            $banner_text,
            $banner_video
        );
    
    $about = new \Monk\ACF\Field\Group('About');
    $about->instructions = 'This group controls the text that follows immediately after scrolling past the top banner and just before the parallax section.';
    
    $about_heading = new \Monk\ACF\Field\Textarea('Heading');
    $about_heading->instructions = 'This field controls the text that is displayed behind the Content field.';
    
    $about_content = new Monk\ACF\Field\Textarea('Content');
    
    $about->addSubField(
            $about_heading->wrapNewLines('br'),
            $about_content->wrapNewLines(),
            new \Monk\ACF\Field\Link('Read More')
        );
    
    
    $quote = new \Monk\ACF\Field\Group('Quote');
    
    $quote_text     = new Monk\ACF\Field\Textarea('Quote');
    $quote_cite     = new Monk\ACF\Field\Textarea('Cite');
    $quote_video    = new Monk\ACF\Field\Basic('Background', 'oembed');
    
    $quote->addSubField(
            $quote_video,
            $quote_text->wrapNewLines(),
            $quote_cite->wrapNewLines('br')
        );
    
    $frontpage->addField($notes, $banner, $about, $quote);
    
    return $frontpage;
    
}

