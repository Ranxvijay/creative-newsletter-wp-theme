<?php
function creative_newsletter_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('custom-logo');
    
    register_nav_menus(array(
        'primary' => 'Primary Menu',
        'footer' => 'Footer Menu',
    ));
}
add_action('after_setup_theme', 'creative_newsletter_setup');

function creative_newsletter_scripts() {
    wp_enqueue_style('creative-newsletter-style', get_stylesheet_uri());
    wp_enqueue_script('creative-newsletter-main', get_template_directory_uri() . '/assets/js/main.js', array('jquery'), '1.0.0', true);
}
add_action('wp_enqueue_scripts', 'creative_newsletter_scripts');

// Custom Post Types
function creative_newsletter_post_types() {
    register_post_type('newsletter', array(
        'labels' => array('name' => 'Newsletters', 'singular_name' => 'Newsletter'),
        'public' => true,
        'has_archive' => true,
        'supports' => array('title', 'editor', 'thumbnail'),
    ));
    
    register_post_type('product', array(
        'labels' => array('name' => 'Products', 'singular_name' => 'Product'),
        'public' => true,
        'has_archive' => true,
        'supports' => array('title', 'editor', 'thumbnail'),
    ));
}
add_action('init', 'creative_newsletter_post_types');
?>