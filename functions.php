<?php
/**
 * Creative Newsletter Pro Theme Functions
 * 
 * @package Creative_Newsletter_Pro
 * @since 1.0.0
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Theme setup and initialization
 */
function creative_newsletter_setup() {
    // Add theme support for various features
    add_theme_support('automatic-feed-links');
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('customize-selective-refresh-widgets');
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
    ));

    // Add custom logo support
    add_theme_support('custom-logo', array(
        'height'      => 100,
        'width'       => 400,
        'flex-width'  => true,
        'flex-height' => true,
    ));

    // Set content width
    $GLOBALS['content_width'] = 1200;

    // Register navigation menus
    register_nav_menus(array(
        'primary' => esc_html__('Primary Menu', 'creative-newsletter-pro'),
        'footer'  => esc_html__('Footer Menu', 'creative-newsletter-pro'),
        'social'  => esc_html__('Social Menu', 'creative-newsletter-pro'),
    ));

    // Add support for editor styles
    add_theme_support('editor-styles');
    add_editor_style('assets/css/editor-style.css');

    // Add support for responsive embeds
    add_theme_support('responsive-embeds');
}
add_action('after_setup_theme', 'creative_newsletter_setup');

/**
 * Enqueue scripts and styles
 */
function creative_newsletter_scripts() {
    // Enqueue main stylesheet
    wp_enqueue_style('creative-newsletter-style', get_stylesheet_uri(), array(), '1.0.0');
    
    // Enqueue animations CSS
    wp_enqueue_style('creative-newsletter-animations', get_template_directory_uri() . '/assets/css/animations.css', array(), '1.0.0');
    
    // Enqueue main JavaScript
    wp_enqueue_script('creative-newsletter-main', get_template_directory_uri() . '/assets/js/main.js', array('jquery'), '1.0.0', true);
    
    // Localize script for AJAX
    wp_localize_script('creative-newsletter-main', 'creative_newsletter_ajax', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce'    => wp_create_nonce('creative_newsletter_nonce'),
    ));

    // Enqueue comment reply script
    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'creative_newsletter_scripts');

/**
 * Register widget areas
 */
function creative_newsletter_widgets_init() {
    register_sidebar(array(
        'name'          => esc_html__('Sidebar', 'creative-newsletter-pro'),
        'id'            => 'sidebar-1',
        'description'   => esc_html__('Add widgets here.', 'creative-newsletter-pro'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));

    // Footer widget areas
    for ($i = 1; $i <= 4; $i++) {
        register_sidebar(array(
            'name'          => sprintf(esc_html__('Footer %d', 'creative-newsletter-pro'), $i),
            'id'            => 'footer-' . $i,
            'description'   => sprintf(esc_html__('Footer column %d widget area.', 'creative-newsletter-pro'), $i),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h3 class="widget-title">',
            'after_title'   => '</h3>',
        ));
    }
}
add_action('widgets_init', 'creative_newsletter_widgets_init');

/**
 * Register Custom Post Types
 */
function creative_newsletter_register_post_types() {
    // Newsletter Post Type
    register_post_type('newsletter', array(
        'labels' => array(
            'name'               => esc_html__('Newsletters', 'creative-newsletter-pro'),
            'singular_name'      => esc_html__('Newsletter', 'creative-newsletter-pro'),
            'menu_name'          => esc_html__('Newsletters', 'creative-newsletter-pro'),
            'add_new'            => esc_html__('Add New', 'creative-newsletter-pro'),
            'add_new_item'       => esc_html__('Add New Newsletter', 'creative-newsletter-pro'),
            'edit_item'          => esc_html__('Edit Newsletter', 'creative-newsletter-pro'),
            'new_item'           => esc_html__('New Newsletter', 'creative-newsletter-pro'),
            'view_item'          => esc_html__('View Newsletter', 'creative-newsletter-pro'),
            'search_items'       => esc_html__('Search Newsletters', 'creative-newsletter-pro'),
            'not_found'          => esc_html__('No newsletters found', 'creative-newsletter-pro'),
            'not_found_in_trash' => esc_html__('No newsletters found in trash', 'creative-newsletter-pro'),
        ),
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array('slug' => 'newsletter'),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 20,
        'menu_icon'          => 'dashicons-email-alt',
        'supports'           => array('title', 'editor', 'excerpt', 'thumbnail', 'custom-fields'),
        'show_in_rest'       => true,
    ));

    // Products Post Type
    register_post_type('product', array(
        'labels' => array(
            'name'               => esc_html__('Products', 'creative-newsletter-pro'),
            'singular_name'      => esc_html__('Product', 'creative-newsletter-pro'),
            'menu_name'          => esc_html__('Products', 'creative-newsletter-pro'),
            'add_new'            => esc_html__('Add New', 'creative-newsletter-pro'),
            'add_new_item'       => esc_html__('Add New Product', 'creative-newsletter-pro'),
            'edit_item'          => esc_html__('Edit Product', 'creative-newsletter-pro'),
            'new_item'           => esc_html__('New Product', 'creative-newsletter-pro'),
            'view_item'          => esc_html__('View Product', 'creative-newsletter-pro'),
            'search_items'       => esc_html__('Search Products', 'creative-newsletter-pro'),
            'not_found'          => esc_html__('No products found', 'creative-newsletter-pro'),
            'not_found_in_trash' => esc_html__('No products found in trash', 'creative-newsletter-pro'),
        ),
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array('slug' => 'product'),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 21,
        'menu_icon'          => 'dashicons-cart',
        'supports'           => array('title', 'editor', 'excerpt', 'thumbnail', 'custom-fields'),
        'show_in_rest'       => true,
    ));
}
add_action('init', 'creative_newsletter_register_post_types');

/**
 * Add custom meta boxes for products
 */
function creative_newsletter_add_meta_boxes() {
    add_meta_box(
        'product_details',
        esc_html__('Product Details', 'creative-newsletter-pro'),
        'creative_newsletter_product_meta_box_callback',
        'product',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'creative_newsletter_add_meta_boxes');

/**
 * Product meta box callback
 */
function creative_newsletter_product_meta_box_callback($post) {
    wp_nonce_field('creative_newsletter_save_product_meta', 'creative_newsletter_product_meta_nonce');
    
    $price = get_post_meta($post->ID, '_product_price', true);
    $currency = get_post_meta($post->ID, '_product_currency', true) ?: '$';
    $link = get_post_meta($post->ID, '_product_link', true);
    
    echo '<table class="form-table">';
    echo '<tr>';
    echo '<th><label for="product_price">' . esc_html__('Price', 'creative-newsletter-pro') . '</label></th>';
    echo '<td>';
    echo '<input type="text" id="product_currency" name="product_currency" value="' . esc_attr($currency) . '" style="width: 50px;" /> ';
    echo '<input type="number" id="product_price" name="product_price" value="' . esc_attr($price) . '" step="0.01" />';
    echo '</td>';
    echo '</tr>';
    echo '<tr>';
    echo '<th><label for="product_link">' . esc_html__('Product Link', 'creative-newsletter-pro') . '</label></th>';
    echo '<td><input type="url" id="product_link" name="product_link" value="' . esc_attr($link) . '" style="width: 100%;" /></td>';
    echo '</tr>';
    echo '</table>';
}

/**
 * Save product meta data
 */
function creative_newsletter_save_product_meta($post_id) {
    if (!isset($_POST['creative_newsletter_product_meta_nonce']) || 
        !wp_verify_nonce($_POST['creative_newsletter_product_meta_nonce'], 'creative_newsletter_save_product_meta')) {
        return;
    }

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    if (isset($_POST['product_price'])) {
        update_post_meta($post_id, '_product_price', sanitize_text_field($_POST['product_price']));
    }

    if (isset($_POST['product_currency'])) {
        update_post_meta($post_id, '_product_currency', sanitize_text_field($_POST['product_currency']));
    }

    if (isset($_POST['product_link'])) {
        update_post_meta($post_id, '_product_link', esc_url_raw($_POST['product_link']));
    }
}
add_action('save_post', 'creative_newsletter_save_product_meta');

/**
 * Customizer settings
 */
function creative_newsletter_customize_register($wp_customize) {
    // Hero Section
    $wp_customize->add_section('hero_section', array(
        'title'    => esc_html__('Hero Section', 'creative-newsletter-pro'),
        'priority' => 30,
    ));

    $wp_customize->add_setting('hero_title', array(
        'default'           => esc_html__('Welcome to Creative Newsletter Pro', 'creative-newsletter-pro'),
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('hero_title', array(
        'label'   => esc_html__('Hero Title', 'creative-newsletter-pro'),
        'section' => 'hero_section',
        'type'    => 'text',
    ));

    $wp_customize->add_setting('hero_subtitle', array(
        'default'           => esc_html__('Create amazing newsletters and sell digital products', 'creative-newsletter-pro'),
        'sanitize_callback' => 'sanitize_textarea_field',
    ));

    $wp_customize->add_control('hero_subtitle', array(
        'label'   => esc_html__('Hero Subtitle', 'creative-newsletter-pro'),
        'section' => 'hero_section',
        'type'    => 'textarea',
    ));

    // Social Media Links
    $wp_customize->add_section('social_media', array(
        'title'    => esc_html__('Social Media', 'creative-newsletter-pro'),
        'priority' => 35,
    ));

    $social_networks = array(
        'twitter'   => 'Twitter',
        'facebook'  => 'Facebook',
        'instagram' => 'Instagram',
        'linkedin'  => 'LinkedIn',
        'github'    => 'GitHub',
        'youtube'   => 'YouTube',
    );

    foreach ($social_networks as $network => $label) {
        $wp_customize->add_setting('social_' . $network, array(
            'default'           => '',
            'sanitize_callback' => 'esc_url_raw',
        ));

        $wp_customize->add_control('social_' . $network, array(
            'label'   => $label . ' ' . esc_html__('URL', 'creative-newsletter-pro'),
            'section' => 'social_media',
            'type'    => 'url',
        ));
    }

    // Newsletter Settings
    $wp_customize->add_section('newsletter_settings', array(
        'title'    => esc_html__('Newsletter Settings', 'creative-newsletter-pro'),
        'priority' => 40,
    ));

    $wp_customize->add_setting('newsletter_title', array(
        'default'           => esc_html__('Join Our Newsletter', 'creative-newsletter-pro'),
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('newsletter_title', array(
        'label'   => esc_html__('Newsletter Section Title', 'creative-newsletter-pro'),
        'section' => 'newsletter_settings',
        'type'    => 'text',
    ));

    $wp_customize->add_setting('newsletter_description', array(
        'default'           => esc_html__('Get weekly insights on web development, design, and digital products.', 'creative-newsletter-pro'),
        'sanitize_callback' => 'sanitize_textarea_field',
    ));

    $wp_customize->add_control('newsletter_description', array(
        'label'   => esc_html__('Newsletter Description', 'creative-newsletter-pro'),
        'section' => 'newsletter_settings',
        'type'    => 'textarea',
    ));
}
add_action('customize_register', 'creative_newsletter_customize_register');

/**
 * AJAX handler for newsletter signup
 */
function creative_newsletter_signup_handler() {
    check_ajax_referer('creative_newsletter_nonce', 'nonce');

    $email = sanitize_email($_POST['email']);
    
    if (!is_email($email)) {
        wp_die(json_encode(array('success' => false, 'message' => 'Invalid email address')));
    }

    // Here you would integrate with your email service provider
    // For now, we'll just store it as an option or in a custom table
    
    $subscribers = get_option('creative_newsletter_subscribers', array());
    if (!in_array($email, $subscribers)) {
        $subscribers[] = $email;
        update_option('creative_newsletter_subscribers', $subscribers);
    }

    wp_die(json_encode(array('success' => true, 'message' => 'Thank you for subscribing!')));
}
add_action('wp_ajax_newsletter_signup', 'creative_newsletter_signup_handler');
add_action('wp_ajax_nopriv_newsletter_signup', 'creative_newsletter_signup_handler');

/**
 * Custom excerpt length
 */
function creative_newsletter_excerpt_length($length) {
    return 30;
}
add_filter('excerpt_length', 'creative_newsletter_excerpt_length', 999);

/**
 * Custom excerpt more
 */
function creative_newsletter_excerpt_more($more) {
    return '...';
}
add_filter('excerpt_more', 'creative_newsletter_excerpt_more');

/**
 * Add body classes
 */
function creative_newsletter_body_classes($classes) {
    if (!is_sidebar_active('sidebar-1')) {
        $classes[] = 'no-sidebar';
    }
    
    return $classes;
}
add_filter('body_class', 'creative_newsletter_body_classes');

/**
 * Custom template tags and utility functions
 */

/**
 * Get social media links
 */
function creative_newsletter_get_social_links() {
    $social_networks = array(
        'twitter'   => 'Twitter',
        'facebook'  => 'Facebook',
        'instagram' => 'Instagram',
        'linkedin'  => 'LinkedIn',
        'github'    => 'GitHub',
        'youtube'   => 'YouTube',
    );

    $links = array();
    foreach ($social_networks as $network => $label) {
        $url = get_theme_mod('social_' . $network);
        if ($url) {
            $links[$network] = array(
                'url'   => $url,
                'label' => $label,
            );
        }
    }

    return $links;
}

/**
 * Display social media links
 */
function creative_newsletter_social_links() {
    $social_links = creative_newsletter_get_social_links();
    
    if (empty($social_links)) {
        return;
    }

    echo '<div class="social-links">';
    foreach ($social_links as $network => $data) {
        printf(
            '<a href="%s" class="social-link social-link-%s" target="_blank" rel="noopener noreferrer" aria-label="%s">%s</a>',
            esc_url($data['url']),
            esc_attr($network),
            esc_attr($data['label']),
            esc_html($data['label'])
        );
    }
    echo '</div>';
}

/**
 * Get product price formatted
 */
function creative_newsletter_get_product_price($post_id = null) {
    if (!$post_id) {
        $post_id = get_the_ID();
    }

    $price = get_post_meta($post_id, '_product_price', true);
    $currency = get_post_meta($post_id, '_product_currency', true) ?: '$';

    if ($price) {
        return $currency . number_format((float)$price, 2);
    }

    return '';
}

/**
 * Get product link
 */
function creative_newsletter_get_product_link($post_id = null) {
    if (!$post_id) {
        $post_id = get_the_ID();
    }

    return get_post_meta($post_id, '_product_link', true);
}

/**
 * Custom pagination
 */
function creative_newsletter_pagination() {
    $links = paginate_links(array(
        'type'      => 'array',
        'prev_text' => '&laquo; ' . esc_html__('Previous', 'creative-newsletter-pro'),
        'next_text' => esc_html__('Next', 'creative-newsletter-pro') . ' &raquo;',
    ));

    if ($links) {
        echo '<nav class="pagination-wrapper" aria-label="' . esc_attr__('Posts pagination', 'creative-newsletter-pro') . '">';
        echo '<ul class="pagination">';
        foreach ($links as $link) {
            echo '<li>' . $link . '</li>';
        }
        echo '</ul>';
        echo '</nav>';
    }
}

/**
 * Breadcrumbs function
 */
function creative_newsletter_breadcrumbs() {
    if (is_home() || is_front_page()) {
        return;
    }

    $separator = ' / ';
    $home_title = esc_html__('Home', 'creative-newsletter-pro');

    echo '<nav class="breadcrumbs" aria-label="' . esc_attr__('Breadcrumb navigation', 'creative-newsletter-pro') . '">';
    echo '<a href="' . esc_url(home_url('/')) . '">' . $home_title . '</a>' . $separator;

    if (is_category() || is_single()) {
        the_category($separator);
        if (is_single()) {
            echo $separator;
            the_title();
        }
    } elseif (is_page()) {
        echo get_the_title();
    }

    echo '</nav>';
}