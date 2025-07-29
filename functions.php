<?php
/**
 * Creative Newsletter Theme Functions
 * 
 * @package Creative_Newsletter
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Theme setup
 */
function creative_newsletter_setup() {
    // Add theme support for various features
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
    ));
    add_theme_support('custom-logo');
    add_theme_support('responsive-embeds');
    add_theme_support('automatic-feed-links');
    
    // Set content width
    $GLOBALS['content_width'] = 800;
    
    // Register navigation menu
    register_nav_menus(array(
        'primary' => esc_html__('Primary Menu', 'creative-newsletter'),
        'footer' => esc_html__('Footer Menu', 'creative-newsletter'),
    ));
    
    // Add excerpt support for pages
    add_post_type_support('page', 'excerpt');
    
    // Set custom excerpt length
    add_filter('excerpt_length', 'creative_newsletter_excerpt_length');
    
    // Custom excerpt more
    add_filter('excerpt_more', 'creative_newsletter_excerpt_more');
}
add_action('after_setup_theme', 'creative_newsletter_setup');

/**
 * Custom excerpt length
 */
function creative_newsletter_excerpt_length($length) {
    return 25;
}

/**
 * Custom excerpt more
 */
function creative_newsletter_excerpt_more($more) {
    return '...';
}

/**
 * Enqueue scripts and styles
 */
function creative_newsletter_scripts() {
    // Enqueue theme stylesheet
    wp_enqueue_style(
        'creative-newsletter-style',
        get_stylesheet_uri(),
        array(),
        wp_get_theme()->get('Version')
    );
    
    // Enqueue Google Fonts
    wp_enqueue_style(
        'creative-newsletter-fonts',
        'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap',
        array(),
        null
    );
    
    // Enqueue custom JavaScript
    wp_enqueue_script(
        'creative-newsletter-scripts',
        get_template_directory_uri() . '/assets/js/theme.js',
        array(),
        wp_get_theme()->get('Version'),
        true
    );
    
    // Make WordPress handle comment reply script
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
        'name'          => esc_html__('Sidebar', 'creative-newsletter'),
        'id'            => 'sidebar-1',
        'description'   => esc_html__('Add widgets here.', 'creative-newsletter'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));
    
    register_sidebar(array(
        'name'          => esc_html__('Footer', 'creative-newsletter'),
        'id'            => 'footer-1',
        'description'   => esc_html__('Add widgets to the footer.', 'creative-newsletter'),
        'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="footer-widget-title">',
        'after_title'   => '</h4>',
    ));
}
add_action('widgets_init', 'creative_newsletter_widgets_init');

/**
 * Customizer additions
 */
function creative_newsletter_customize_register($wp_customize) {
    // Hero Section
    $wp_customize->add_section('hero_section', array(
        'title'    => __('Hero Section', 'creative-newsletter'),
        'priority' => 30,
    ));
    
    // Hero Title
    $wp_customize->add_setting('hero_title', array(
        'default'           => __('Create. Share. Inspire.', 'creative-newsletter'),
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_control('hero_title', array(
        'label'   => __('Hero Title', 'creative-newsletter'),
        'section' => 'hero_section',
        'type'    => 'text',
    ));
    
    // Hero Subtitle
    $wp_customize->add_setting('hero_subtitle', array(
        'default'           => __('A minimalist platform for creative minds to share insights, stories, and inspiration.', 'creative-newsletter'),
        'sanitize_callback' => 'sanitize_textarea_field',
    ));
    
    $wp_customize->add_control('hero_subtitle', array(
        'label'   => __('Hero Subtitle', 'creative-newsletter'),
        'section' => 'hero_section',
        'type'    => 'textarea',
    ));
    
    // Hero CTA Text
    $wp_customize->add_setting('hero_cta_text', array(
        'default'           => __('Read Latest Posts', 'creative-newsletter'),
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_control('hero_cta_text', array(
        'label'   => __('Hero CTA Text', 'creative-newsletter'),
        'section' => 'hero_section',
        'type'    => 'text',
    ));
    
    // Hero CTA Link
    $wp_customize->add_setting('hero_cta_link', array(
        'default'           => '#posts',
        'sanitize_callback' => 'esc_url_raw',
    ));
    
    $wp_customize->add_control('hero_cta_link', array(
        'label'   => __('Hero CTA Link', 'creative-newsletter'),
        'section' => 'hero_section',
        'type'    => 'url',
    ));
    
    // Newsletter Section
    $wp_customize->add_section('newsletter_section', array(
        'title'    => __('Newsletter Section', 'creative-newsletter'),
        'priority' => 40,
    ));
    
    // Newsletter Title
    $wp_customize->add_setting('newsletter_title', array(
        'default'           => __('Join the Community', 'creative-newsletter'),
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_control('newsletter_title', array(
        'label'   => __('Newsletter Title', 'creative-newsletter'),
        'section' => 'newsletter_section',
        'type'    => 'text',
    ));
    
    // Newsletter Description
    $wp_customize->add_setting('newsletter_description', array(
        'default'           => __('Get weekly insights, stories, and inspiration delivered to your inbox.', 'creative-newsletter'),
        'sanitize_callback' => 'sanitize_textarea_field',
    ));
    
    $wp_customize->add_control('newsletter_description', array(
        'label'   => __('Newsletter Description', 'creative-newsletter'),
        'section' => 'newsletter_section',
        'type'    => 'textarea',
    ));
    
    // Color Scheme Options
    $wp_customize->add_section('color_scheme', array(
        'title'    => __('Color Scheme', 'creative-newsletter'),
        'priority' => 50,
    ));
    
    // Primary Background Color
    $wp_customize->add_setting('primary_bg_color', array(
        'default'           => '#0a0a0a',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'primary_bg_color', array(
        'label'   => __('Primary Background Color', 'creative-newsletter'),
        'section' => 'color_scheme',
    )));
    
    // Secondary Background Color
    $wp_customize->add_setting('secondary_bg_color', array(
        'default'           => '#111111',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'secondary_bg_color', array(
        'label'   => __('Secondary Background Color', 'creative-newsletter'),
        'section' => 'color_scheme',
    )));
    
    // Primary Text Color
    $wp_customize->add_setting('primary_text_color', array(
        'default'           => '#ffffff',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'primary_text_color', array(
        'label'   => __('Primary Text Color', 'creative-newsletter'),
        'section' => 'color_scheme',
    )));
    
    // Secondary Text Color
    $wp_customize->add_setting('secondary_text_color', array(
        'default'           => '#b3b3b3',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'secondary_text_color', array(
        'label'   => __('Secondary Text Color', 'creative-newsletter'),
        'section' => 'color_scheme',
    )));
}
add_action('customize_register', 'creative_newsletter_customize_register');

/**
 * Output custom CSS for customizer options
 */
function creative_newsletter_customizer_css() {
    $primary_bg = get_theme_mod('primary_bg_color', '#0a0a0a');
    $secondary_bg = get_theme_mod('secondary_bg_color', '#111111');
    $primary_text = get_theme_mod('primary_text_color', '#ffffff');
    $secondary_text = get_theme_mod('secondary_text_color', '#b3b3b3');
    
    ?>
    <style type="text/css">
        body {
            background-color: <?php echo esc_attr($primary_bg); ?>;
            color: <?php echo esc_attr($secondary_text); ?>;
        }
        
        .site-header {
            background-color: <?php echo esc_attr($primary_bg); ?>;
        }
        
        .post-card {
            background-color: <?php echo esc_attr($secondary_bg); ?>;
        }
        
        .newsletter-section {
            background-color: <?php echo esc_attr($secondary_bg); ?>;
        }
        
        h1, h2, h3, h4, h5, h6,
        .hero-title,
        .post-title,
        .single-post-title,
        .newsletter-title {
            color: <?php echo esc_attr($primary_text); ?>;
        }
        
        .site-title {
            color: <?php echo esc_attr($primary_text); ?>;
        }
        
        p,
        .post-excerpt,
        .hero-subtitle,
        .newsletter-description {
            color: <?php echo esc_attr($secondary_text); ?>;
        }
    </style>
    <?php
}
add_action('wp_head', 'creative_newsletter_customizer_css');

/**
 * Add custom body classes
 */
function creative_newsletter_body_classes($classes) {
    // Add class for the clean theme
    $classes[] = 'creative-newsletter-theme';
    
    // Add class for front page
    if (is_front_page()) {
        $classes[] = 'has-hero-section';
    }
    
    return $classes;
}
add_filter('body_class', 'creative_newsletter_body_classes');

/**
 * Custom post navigation
 */
function creative_newsletter_post_navigation() {
    $next_post = get_next_post();
    $prev_post = get_previous_post();
    
    if ($next_post || $prev_post) {
        echo '<nav class="post-navigation" role="navigation">';
        echo '<div class="nav-links">';
        
        if ($prev_post) {
            echo '<div class="nav-previous">';
            echo '<a href="' . get_permalink($prev_post) . '">';
            echo '<span class="nav-subtitle">' . esc_html__('Previous Post', 'creative-newsletter') . '</span>';
            echo '<span class="nav-title">' . get_the_title($prev_post) . '</span>';
            echo '</a>';
            echo '</div>';
        }
        
        if ($next_post) {
            echo '<div class="nav-next">';
            echo '<a href="' . get_permalink($next_post) . '">';
            echo '<span class="nav-subtitle">' . esc_html__('Next Post', 'creative-newsletter') . '</span>';
            echo '<span class="nav-title">' . get_the_title($next_post) . '</span>';
            echo '</a>';
            echo '</div>';
        }
        
        echo '</div>';
        echo '</nav>';
    }
}

/**
 * Get custom logo or site title
 */
function creative_newsletter_get_logo() {
    if (has_custom_logo()) {
        $custom_logo_id = get_theme_mod('custom_logo');
        $logo = wp_get_attachment_image_src($custom_logo_id, 'full');
        return '<img src="' . esc_url($logo[0]) . '" alt="' . get_bloginfo('name') . '" class="custom-logo">';
    } else {
        return get_bloginfo('name');
    }
}

/**
 * Add support for selective refresh for widgets
 */
function creative_newsletter_customize_partial_blogname() {
    return get_bloginfo('name', 'display');
}

function creative_newsletter_customize_partial_blogdescription() {
    return get_bloginfo('description', 'display');
}

/**
 * Pagination function
 */
function creative_newsletter_pagination() {
    global $wp_query;
    
    $big = 999999999;
    
    $paginate_links = paginate_links(array(
        'base'      => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
        'format'    => '?paged=%#%',
        'current'   => max(1, get_query_var('paged')),
        'total'     => $wp_query->max_num_pages,
        'prev_text' => esc_html__('&laquo; Previous', 'creative-newsletter'),
        'next_text' => esc_html__('Next &raquo;', 'creative-newsletter'),
    ));
    
    if ($paginate_links) {
        echo '<div class="pagination-wrapper">';
        echo '<nav class="pagination">';
        echo $paginate_links;
        echo '</nav>';
        echo '</div>';
    }
}

/**
 * Security function to get safe URL
 */
function creative_newsletter_get_safe_url($url) {
    return esc_url($url);
}

/**
 * Get reading time estimate
 */
function creative_newsletter_reading_time($post_id = null) {
    if (!$post_id) {
        $post_id = get_the_ID();
    }
    
    $content = get_post_field('post_content', $post_id);
    $word_count = str_word_count(strip_tags($content));
    $reading_time = ceil($word_count / 200);
    
    return $reading_time . ' min read';
}
?>