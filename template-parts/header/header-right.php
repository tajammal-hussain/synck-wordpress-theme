<?php
/**
 * Header Template
 *
 * The header template for your WordPress theme.
 * This file includes the opening <html> tag, <head> section, 
 * and the beginning of the <body> tag. It sets up the basic structure
 * of your website and includes essential meta tags, stylesheets, and scripts.
 *
 * @package Synck
 */

?>
<div class="header-right">
    <div class="header-contact-info d-flex align-items-center">
        <div class="phone-number">
            <a href="<?php echo get_theme_mod("header_button_2_link", "#"); ?>">
            <?php echo get_theme_mod('header_button_2', 'Call US'); ?>
                <i class="iconoir-arrow-up-right"></i>
            </a>
            <?php echo get_theme_mod('header_button_2_bottom', '+1-938-740-7555'); ?>
        </div>
        <a href="<?php echo get_theme_mod('header_button_1_link', '#'); ?>" class="theme-btn" 
                target="<?php echo get_theme_mod('header_button_1_link_target'); ?>" rel="<?php echo get_theme_mod('header_button_1_link_rel'); ?>" 
            style="border-radius:<?php echo get_theme_mod("header_button_1_radius", "99px"); ?>"        
        >
            <?php echo get_theme_mod('header_button_1', 'Contact Us'); ?>
        </a>
    </div>
</div>
