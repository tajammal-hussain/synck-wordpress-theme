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
    
    $banner_text = new Monk\ACF\Field\Wysiwyg('content');
    $banner_text->instructions = "The text to display Left of the Screen";
    
    $learn_more = new \Monk\ACF\Field\Basic('LearnMore');
    $learn_more->instructions = 'Learn More Button Please Add Learn more Text';
    $learn_more_url = new \Monk\ACF\Field\Basic('LearnMorekUrl','url');

    $letTalk = new \Monk\ACF\Field\Basic('LetsTalk');

    $letTalk->instructions = 'Lets Talk Button Please Add Learn more Text';
    $let_Talk_url = new \Monk\ACF\Field\Basic('LetsTalkUrl', 'url');


    $image = new \Monk\ACF\Field\Image('banner');
    $image->instructions = 'Image to the right';

    $experience = new \Monk\ACF\Field\Group('Experience');
    $experienceImage = new \Monk\ACF\Field\Image('experienceImage');
    $experienceImage->instructions = 'Image to the left of the Experience';
    $number = new \Monk\ACF\Field\Number('experienceNumber');
    $exp_content = new Monk\ACF\Field\Wysiwyg('experienceContent');

    $experience->addSubField(
        $experienceImage,
        $number,
        $exp_content
    );


    $experts = new \Monk\ACF\Field\Group('Experts');

    $repeat_image = new \Monk\ACF\Field\Repeater('image');
    $ExpertImage = new \Monk\ACF\Field\Image('expertImage');

    $repeat_image->addSubField(
        $ExpertImage
    );

    $expertContent = new Monk\ACF\Field\Wysiwyg('expertcontent');
    $Expert_url = new \Monk\ACF\Field\Basic('experturl', 'url');

    $experts->addSubField(
        $repeat_image,
        $expertContent,
        $Expert_url,
    );


    $banner->addSubField(
        $banner_text,
        $learn_more,
        $letTalk,
        $learn_more_url,
        $let_Talk_url,
        $image,
        $experience,
        $experts
    );
    
    $frontpage->addField($banner);
    
    return $frontpage;
}
