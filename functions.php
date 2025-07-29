<?php
/**
 * Creative Newsletter Theme Functions
 *
 * @package CreativeNewsletter
 * @since 1.0.0
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Theme Setup
 */
function creative_newsletter_setup() {
    // Make theme available for translation
    load_theme_textdomain('creative-newsletter', get_template_directory() . '/languages');
    
    // Add theme support for various features
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('custom-logo');
    add_theme_support('custom-header');
    add_theme_support('custom-background');
    add_theme_support('responsive-embeds');
    add_theme_support('wp-block-styles');
    add_theme_support('align-wide');
    add_theme_support('editor-styles');
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
    ));
    
    // Add custom image sizes
    add_image_size('creative-newsletter-featured', 800, 400, true);
    add_image_size('creative-newsletter-thumbnail', 350, 200, true);
    add_image_size('creative-newsletter-product', 300, 250, true);
    
    // Register navigation menus
    register_nav_menus(array(
        'primary' => __('Primary Menu', 'creative-newsletter'),
        'footer' => __('Footer Menu', 'creative-newsletter'),
    ));
    
    // Add editor styles
    add_editor_style('editor-style.css');
}
add_action('after_setup_theme', 'creative_newsletter_setup');

/**
 * Enqueue Scripts and Styles
 */
function creative_newsletter_scripts() {
    // Enqueue Google Fonts
    wp_enqueue_style('creative-newsletter-fonts', 'https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap', array(), '1.0.0');
    
    // Enqueue main stylesheet
    wp_enqueue_style('creative-newsletter-style', get_stylesheet_uri(), array(), wp_get_theme()->get('Version'));
    
    // Enqueue JavaScript files
    wp_enqueue_script('creative-newsletter-main', get_template_directory_uri() . '/assets/js/main.js', array('jquery'), wp_get_theme()->get('Version'), true);
    
    // Localize script for AJAX
    wp_localize_script('creative-newsletter-main', 'creative_newsletter_ajax', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('creative_newsletter_nonce'),
        'strings' => array(
            'loading' => __('Loading...', 'creative-newsletter'),
            'error' => __('An error occurred. Please try again.', 'creative-newsletter'),
        ),
    ));
    
    // Enqueue comment reply script
    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'creative_newsletter_scripts');

/**
 * Register Widget Areas
 */
function creative_newsletter_widgets_init() {
    register_sidebar(array(
        'name'          => __('Primary Sidebar', 'creative-newsletter'),
        'id'            => 'sidebar-1',
        'description'   => __('Add widgets here to appear in your sidebar.', 'creative-newsletter'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));
    
    register_sidebar(array(
        'name'          => __('Footer Widget Area 1', 'creative-newsletter'),
        'id'            => 'footer-1',
        'description'   => __('Add widgets here to appear in the first footer area.', 'creative-newsletter'),
        'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ));
    
    register_sidebar(array(
        'name'          => __('Footer Widget Area 2', 'creative-newsletter'),
        'id'            => 'footer-2',
        'description'   => __('Add widgets here to appear in the second footer area.', 'creative-newsletter'),
        'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ));
    
    register_sidebar(array(
        'name'          => __('Footer Widget Area 3', 'creative-newsletter'),
        'id'            => 'footer-3',
        'description'   => __('Add widgets here to appear in the third footer area.', 'creative-newsletter'),
        'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ));
}
add_action('widgets_init', 'creative_newsletter_widgets_init');

/**
 * Custom Post Type: Products
 */
function creative_newsletter_register_products_post_type() {
    $labels = array(
        'name'               => __('Products', 'creative-newsletter'),
        'singular_name'      => __('Product', 'creative-newsletter'),
        'menu_name'          => __('Products', 'creative-newsletter'),
        'add_new'            => __('Add New', 'creative-newsletter'),
        'add_new_item'       => __('Add New Product', 'creative-newsletter'),
        'edit_item'          => __('Edit Product', 'creative-newsletter'),
        'new_item'           => __('New Product', 'creative-newsletter'),
        'view_item'          => __('View Product', 'creative-newsletter'),
        'search_items'       => __('Search Products', 'creative-newsletter'),
        'not_found'          => __('No products found', 'creative-newsletter'),
        'not_found_in_trash' => __('No products found in trash', 'creative-newsletter'),
    );
    
    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array('slug' => 'products'),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 20,
        'menu_icon'          => 'dashicons-products',
        'supports'           => array('title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'),
        'show_in_rest'       => true,
    );
    
    register_post_type('product', $args);
}
add_action('init', 'creative_newsletter_register_products_post_type');

/**
 * Add Custom Meta Boxes for Products and Pages
 */
function creative_newsletter_add_meta_boxes() {
    // Product meta boxes
    add_meta_box(
        'product-details',
        __('Product Details', 'creative-newsletter'),
        'creative_newsletter_product_details_callback',
        'product',
        'normal',
        'high'
    );
    
    // Landing page meta boxes
    add_meta_box(
        'landing-page-settings',
        __('Landing Page Settings', 'creative-newsletter'),
        'creative_newsletter_landing_page_callback',
        'page',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'creative_newsletter_add_meta_boxes');

/**
 * Landing Page Meta Box Callback
 */
function creative_newsletter_landing_page_callback($post) {
    // Only show for landing page template
    $template = get_page_template_slug($post->ID);
    if ($template !== 'page-landing.php') {
        echo '<p>' . __('This meta box is only available for the Landing Page template.', 'creative-newsletter') . '</p>';
        return;
    }
    
    wp_nonce_field(basename(__FILE__), 'landing_page_nonce');
    
    $hero_title = get_post_meta($post->ID, '_landing_hero_title', true);
    $hero_subtitle = get_post_meta($post->ID, '_landing_hero_subtitle', true);
    $cta_text = get_post_meta($post->ID, '_landing_cta_text', true);
    $cta_url = get_post_meta($post->ID, '_landing_cta_url', true);
    $show_newsletter = get_post_meta($post->ID, '_landing_show_newsletter', true);
    
    ?>
    <table class="form-table">
        <tr>
            <th><label for="landing_hero_title"><?php _e('Hero Title', 'creative-newsletter'); ?></label></th>
            <td><input type="text" id="landing_hero_title" name="landing_hero_title" value="<?php echo esc_attr($hero_title); ?>" style="width: 100%;" placeholder="<?php esc_attr_e('Custom hero title (optional)', 'creative-newsletter'); ?>" /></td>
        </tr>
        <tr>
            <th><label for="landing_hero_subtitle"><?php _e('Hero Subtitle', 'creative-newsletter'); ?></label></th>
            <td><textarea id="landing_hero_subtitle" name="landing_hero_subtitle" rows="3" style="width: 100%;" placeholder="<?php esc_attr_e('Custom hero subtitle (optional)', 'creative-newsletter'); ?>"><?php echo esc_textarea($hero_subtitle); ?></textarea></td>
        </tr>
        <tr>
            <th><label for="landing_cta_text"><?php _e('CTA Button Text', 'creative-newsletter'); ?></label></th>
            <td><input type="text" id="landing_cta_text" name="landing_cta_text" value="<?php echo esc_attr($cta_text); ?>" placeholder="<?php esc_attr_e('Get Started', 'creative-newsletter'); ?>" /></td>
        </tr>
        <tr>
            <th><label for="landing_cta_url"><?php _e('CTA Button URL', 'creative-newsletter'); ?></label></th>
            <td><input type="url" id="landing_cta_url" name="landing_cta_url" value="<?php echo esc_attr($cta_url); ?>" style="width: 100%;" placeholder="<?php esc_attr_e('https://example.com', 'creative-newsletter'); ?>" /></td>
        </tr>
        <tr>
            <th><label for="landing_show_newsletter"><?php _e('Show Newsletter Section', 'creative-newsletter'); ?></label></th>
            <td><input type="checkbox" id="landing_show_newsletter" name="landing_show_newsletter" value="1" <?php checked($show_newsletter, '1'); ?> /></td>
        </tr>
    </table>
    
    <style>
    .landing-page-meta-box {
        margin-top: 1rem;
        padding: 1rem;
        background: #f9f9f9;
        border-radius: 5px;
    }
    </style>
    
    <script>
    jQuery(document).ready(function($) {
        // Show/hide meta box based on page template
        function toggleLandingPageMeta() {
            var template = $('#page_template').val();
            if (template === 'page-landing.php') {
                $('#landing-page-settings').show();
            } else {
                $('#landing-page-settings').hide();
            }
        }
        
        toggleLandingPageMeta();
        $('#page_template').on('change', toggleLandingPageMeta);
    });
    </script>
    <?php
}
/**
 * Product Details Meta Box Callback
 */
function creative_newsletter_product_details_callback($post) {
    wp_nonce_field(basename(__FILE__), 'product_details_nonce');
    
    $price = get_post_meta($post->ID, '_product_price', true);
    $sale_price = get_post_meta($post->ID, '_product_sale_price', true);
    $external_link = get_post_meta($post->ID, '_product_external_link', true);
    $featured = get_post_meta($post->ID, '_product_featured', true);
    
    ?>
    <table class="form-table">
        <tr>
            <th><label for="product_price"><?php _e('Regular Price', 'creative-newsletter'); ?></label></th>
            <td><input type="text" id="product_price" name="product_price" value="<?php echo esc_attr($price); ?>" /></td>
        </tr>
        <tr>
            <th><label for="product_sale_price"><?php _e('Sale Price', 'creative-newsletter'); ?></label></th>
            <td><input type="text" id="product_sale_price" name="product_sale_price" value="<?php echo esc_attr($sale_price); ?>" /></td>
        </tr>
        <tr>
            <th><label for="product_external_link"><?php _e('External Link', 'creative-newsletter'); ?></label></th>
            <td><input type="url" id="product_external_link" name="product_external_link" value="<?php echo esc_attr($external_link); ?>" style="width: 100%;" /></td>
        </tr>
        <tr>
            <th><label for="product_featured"><?php _e('Featured Product', 'creative-newsletter'); ?></label></th>
            <td><input type="checkbox" id="product_featured" name="product_featured" value="1" <?php checked($featured, '1'); ?> /></td>
        </tr>
    </table>
    <?php
}

/**
 * Save Product and Landing Page Meta Data
 */
function creative_newsletter_save_meta_data($post_id) {
    // Save product meta data
    if (isset($_POST['product_details_nonce']) && wp_verify_nonce($_POST['product_details_nonce'], basename(__FILE__))) {
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return;
        }
        
        if (!current_user_can('edit_post', $post_id)) {
            return;
        }
        
        if (isset($_POST['product_price'])) {
            update_post_meta($post_id, '_product_price', sanitize_text_field($_POST['product_price']));
        }
        
        if (isset($_POST['product_sale_price'])) {
            update_post_meta($post_id, '_product_sale_price', sanitize_text_field($_POST['product_sale_price']));
        }
        
        if (isset($_POST['product_external_link'])) {
            update_post_meta($post_id, '_product_external_link', esc_url_raw($_POST['product_external_link']));
        }
        
        if (isset($_POST['product_featured'])) {
            update_post_meta($post_id, '_product_featured', '1');
        } else {
            delete_post_meta($post_id, '_product_featured');
        }
    }
    
    // Save landing page meta data
    if (isset($_POST['landing_page_nonce']) && wp_verify_nonce($_POST['landing_page_nonce'], basename(__FILE__))) {
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return;
        }
        
        if (!current_user_can('edit_post', $post_id)) {
            return;
        }
        
        if (isset($_POST['landing_hero_title'])) {
            update_post_meta($post_id, '_landing_hero_title', sanitize_text_field($_POST['landing_hero_title']));
        }
        
        if (isset($_POST['landing_hero_subtitle'])) {
            update_post_meta($post_id, '_landing_hero_subtitle', sanitize_textarea_field($_POST['landing_hero_subtitle']));
        }
        
        if (isset($_POST['landing_cta_text'])) {
            update_post_meta($post_id, '_landing_cta_text', sanitize_text_field($_POST['landing_cta_text']));
        }
        
        if (isset($_POST['landing_cta_url'])) {
            update_post_meta($post_id, '_landing_cta_url', esc_url_raw($_POST['landing_cta_url']));
        }
        
        if (isset($_POST['landing_show_newsletter'])) {
            update_post_meta($post_id, '_landing_show_newsletter', '1');
        } else {
            delete_post_meta($post_id, '_landing_show_newsletter');
        }
    }
}
add_action('save_post', 'creative_newsletter_save_meta_data');

/**
 * Newsletter Signup Handler
 */
function creative_newsletter_handle_newsletter_signup() {
    // Verify nonce
    if (!wp_verify_nonce($_POST['nonce'], 'creative_newsletter_nonce')) {
        wp_die(__('Security check failed', 'creative-newsletter'));
    }
    
    $email = sanitize_email($_POST['email']);
    
    if (!is_email($email)) {
        wp_send_json_error(__('Please enter a valid email address.', 'creative-newsletter'));
        return;
    }
    
    // Store newsletter subscription (you can integrate with MailChimp, ConvertKit, etc.)
    $subscribers = get_option('creative_newsletter_subscribers', array());
    
    if (!in_array($email, $subscribers)) {
        $subscribers[] = $email;
        update_option('creative_newsletter_subscribers', $subscribers);
        
        wp_send_json_success(__('Thank you for subscribing to our newsletter!', 'creative-newsletter'));
    } else {
        wp_send_json_error(__('You are already subscribed to our newsletter.', 'creative-newsletter'));
    }
}
add_action('wp_ajax_newsletter_signup', 'creative_newsletter_handle_newsletter_signup');
add_action('wp_ajax_nopriv_newsletter_signup', 'creative_newsletter_handle_newsletter_signup');

/**
 * Customizer Settings
 */
function creative_newsletter_customize_register($wp_customize) {
    // Hero Section
    $wp_customize->add_section('hero_section', array(
        'title'    => __('Hero Section', 'creative-newsletter'),
        'priority' => 30,
    ));
    
    $wp_customize->add_setting('hero_title', array(
        'default'           => __('Welcome to Creative Newsletter', 'creative-newsletter'),
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_control('hero_title', array(
        'label'   => __('Hero Title', 'creative-newsletter'),
        'section' => 'hero_section',
        'type'    => 'text',
    ));
    
    $wp_customize->add_setting('hero_subtitle', array(
        'default'           => __('A modern WordPress theme for creative professionals', 'creative-newsletter'),
        'sanitize_callback' => 'sanitize_textarea_field',
    ));
    
    $wp_customize->add_control('hero_subtitle', array(
        'label'   => __('Hero Subtitle', 'creative-newsletter'),
        'section' => 'hero_section',
        'type'    => 'textarea',
    ));
    
    $wp_customize->add_setting('hero_cta_text', array(
        'default'           => __('Get Started', 'creative-newsletter'),
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_control('hero_cta_text', array(
        'label'   => __('Hero CTA Text', 'creative-newsletter'),
        'section' => 'hero_section',
        'type'    => 'text',
    ));
    
    $wp_customize->add_setting('hero_cta_url', array(
        'default'           => '#newsletter',
        'sanitize_callback' => 'esc_url_raw',
    ));
    
    $wp_customize->add_control('hero_cta_url', array(
        'label'   => __('Hero CTA URL', 'creative-newsletter'),
        'section' => 'hero_section',
        'type'    => 'url',
    ));
    
    // Colors
    $wp_customize->add_setting('primary_color', array(
        'default'           => '#007cba',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'primary_color', array(
        'label'   => __('Primary Color', 'creative-newsletter'),
        'section' => 'colors',
    )));
    
    // Newsletter Section
    $wp_customize->add_section('newsletter_section', array(
        'title'    => __('Newsletter Section', 'creative-newsletter'),
        'priority' => 35,
    ));
    
    $wp_customize->add_setting('newsletter_title', array(
        'default'           => __('Subscribe to Our Newsletter', 'creative-newsletter'),
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_control('newsletter_title', array(
        'label'   => __('Newsletter Title', 'creative-newsletter'),
        'section' => 'newsletter_section',
        'type'    => 'text',
    ));
    
    $wp_customize->add_setting('newsletter_description', array(
        'default'           => __('Stay updated with our latest articles and products.', 'creative-newsletter'),
        'sanitize_callback' => 'sanitize_textarea_field',
    ));
    
    $wp_customize->add_control('newsletter_description', array(
        'label'   => __('Newsletter Description', 'creative-newsletter'),
        'section' => 'newsletter_section',
        'type'    => 'textarea',
    ));
}
add_action('customize_register', 'creative_newsletter_customize_register');

/**
 * Custom Excerpt Length
 */
function creative_newsletter_excerpt_length($length) {
    return 20;
}
add_filter('excerpt_length', 'creative_newsletter_excerpt_length');

/**
 * Custom Excerpt More
 */
function creative_newsletter_excerpt_more($more) {
    return '...';
}
add_filter('excerpt_more', 'creative_newsletter_excerpt_more');

/**
 * Add Custom Body Classes
 */
function creative_newsletter_body_classes($classes) {
    if (is_page_template('page-home.php')) {
        $classes[] = 'home-page';
    }
    
    if (is_post_type_archive('product')) {
        $classes[] = 'products-archive';
    }
    
    return $classes;
}
add_filter('body_class', 'creative_newsletter_body_classes');

/**
 * Custom Walker for Navigation Menu
 */
class Creative_Newsletter_Walker_Nav_Menu extends Walker_Nav_Menu {
    
    function start_lvl(&$output, $depth = 0, $args = null) {
        $indent = str_repeat("\t", $depth);
        $output .= "\n$indent<ul class=\"sub-menu\">\n";
    }
    
    function end_lvl(&$output, $depth = 0, $args = null) {
        $indent = str_repeat("\t", $depth);
        $output .= "$indent</ul>\n";
    }
    
    function start_el(&$output, $item, $depth = 0, $args = null, $id = 0) {
        $indent = ($depth) ? str_repeat("\t", $depth) : '';
        
        $classes = empty($item->classes) ? array() : (array) $item->classes;
        $classes[] = 'menu-item-' . $item->ID;
        
        $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args));
        $class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';
        
        $id = apply_filters('nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args);
        $id = $id ? ' id="' . esc_attr($id) . '"' : '';
        
        $attributes = ! empty($item->attr_title) ? ' title="'  . esc_attr($item->attr_title) .'"' : '';
        $attributes .= ! empty($item->target)     ? ' target="' . esc_attr($item->target     ) .'"' : '';
        $attributes .= ! empty($item->xfn)        ? ' rel="'    . esc_attr($item->xfn        ) .'"' : '';
        $attributes .= ! empty($item->url)        ? ' href="'   . esc_attr($item->url        ) .'"' : '';
        
        $item_output = $args->before ?? '';
        $item_output .= '<a'. $attributes .'>';
        $item_output .= ($args->link_before ?? '') . apply_filters('the_title', $item->title, $item->ID) . ($args->link_after ?? '');
        $item_output .= '</a>';
        $item_output .= $args->after ?? '';
        
        $output .= $indent . '<li' . $id . $class_names .'>' . $item_output;
    }
    
    function end_el(&$output, $item, $depth = 0, $args = null) {
        $output .= "</li>\n";
    }
}

/**
 * Filter for adding custom styles based on customizer options
 */
function creative_newsletter_custom_styles() {
    $primary_color = get_theme_mod('primary_color', '#007cba');
    ?>
    <style type="text/css">
        :root {
            --primary-color: <?php echo esc_html($primary_color); ?>;
        }
        
        a, .hero-cta, .newsletter-btn, .btn, .scroll-to-top {
            color: var(--primary-color);
        }
        
        .main-navigation a::after, .section-title::after {
            background: var(--primary-color);
        }
        
        .product-price {
            color: var(--primary-color);
        }
        
        .btn, .product-btn, .scroll-to-top {
            background: var(--primary-color);
        }
    </style>
    <?php
}
add_action('wp_head', 'creative_newsletter_custom_styles');

/**
 * Add admin menu for newsletter subscribers
 */
function creative_newsletter_admin_menu() {
    add_menu_page(
        __('Newsletter Subscribers', 'creative-newsletter'),
        __('Newsletter', 'creative-newsletter'),
        'manage_options',
        'newsletter-subscribers',
        'creative_newsletter_subscribers_page',
        'dashicons-email-alt',
        30
    );
}
add_action('admin_menu', 'creative_newsletter_admin_menu');

/**
 * Newsletter subscribers admin page
 */
function creative_newsletter_subscribers_page() {
    $subscribers = get_option('creative_newsletter_subscribers', array());
    ?>
    <div class="wrap">
        <h1><?php _e('Newsletter Subscribers', 'creative-newsletter'); ?></h1>
        
        <div class="tablenav top">
            <div class="alignleft actions">
                <p><?php printf(__('Total Subscribers: %d', 'creative-newsletter'), count($subscribers)); ?></p>
            </div>
        </div>
        
        <table class="wp-list-table widefat fixed striped">
            <thead>
                <tr>
                    <th scope="col"><?php _e('Email Address', 'creative-newsletter'); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($subscribers)) : ?>
                    <?php foreach ($subscribers as $email) : ?>
                        <tr>
                            <td><?php echo esc_html($email); ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="1"><?php _e('No subscribers yet.', 'creative-newsletter'); ?></td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <?php
}

/**
 * Security enhancements
 */
function creative_newsletter_security_headers() {
    if (!is_admin()) {
        header('X-Content-Type-Options: nosniff');
        header('X-Frame-Options: SAMEORIGIN');
        header('X-XSS-Protection: 1; mode=block');
    }
}
add_action('send_headers', 'creative_newsletter_security_headers');

/**
 * Optimize performance
 */
function creative_newsletter_optimize_performance() {
    // Remove WordPress version from head
    remove_action('wp_head', 'wp_generator');
    
    // Remove RSD link
    remove_action('wp_head', 'rsd_link');
    
    // Remove Windows Live Writer
    remove_action('wp_head', 'wlwmanifest_link');
    
    // Remove feed links
    remove_action('wp_head', 'feed_links_extra', 3);
    remove_action('wp_head', 'feed_links', 2);
    
    // Remove shortlink
    remove_action('wp_head', 'wp_shortlink_wp_head');
}
add_action('init', 'creative_newsletter_optimize_performance');