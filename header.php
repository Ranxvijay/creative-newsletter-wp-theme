<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div id="page" class="site">
    <a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e('Skip to content', 'creative-newsletter'); ?></a>

    <header id="masthead" class="site-header">
        <div class="container">
            <div class="header-content">
                <div class="site-branding">
                    <?php if (has_custom_logo()) : ?>
                        <div class="site-logo">
                            <?php the_custom_logo(); ?>
                        </div>
                    <?php endif; ?>
                    
                    <h1 class="site-title">
                        <a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
                            <?php echo creative_newsletter_get_logo(); ?>
                        </a>
                    </h1>
                    
                    <?php
                    $description = get_bloginfo('description', 'display');
                    if ($description || is_customize_preview()) :
                    ?>
                        <p class="site-description sr-only"><?php echo $description; ?></p>
                    <?php endif; ?>
                </div><!-- .site-branding -->

                <nav id="site-navigation" class="main-navigation">
                    <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
                        <span class="sr-only"><?php esc_html_e('Main Menu', 'creative-newsletter'); ?></span>
                        <span class="menu-icon"></span>
                    </button>
                    
                    <?php
                    wp_nav_menu(array(
                        'theme_location' => 'primary',
                        'menu_id'        => 'primary-menu',
                        'container'      => false,
                        'fallback_cb'    => 'creative_newsletter_fallback_menu',
                    ));
                    ?>
                </nav><!-- #site-navigation -->
            </div><!-- .header-content -->
        </div><!-- .container -->
    </header><!-- #masthead -->

    <?php if (is_front_page() && !is_paged()) : ?>
        <section class="hero-section">
            <div class="container">
                <div class="hero-content">
                    <h1 class="hero-title">
                        <?php echo esc_html(get_theme_mod('hero_title', __('Create. Share. Inspire.', 'creative-newsletter'))); ?>
                    </h1>
                    
                    <p class="hero-subtitle">
                        <?php echo esc_html(get_theme_mod('hero_subtitle', __('A minimalist platform for creative minds to share insights, stories, and inspiration.', 'creative-newsletter'))); ?>
                    </p>
                    
                    <a href="<?php echo esc_url(get_theme_mod('hero_cta_link', '#posts')); ?>" class="hero-cta">
                        <?php echo esc_html(get_theme_mod('hero_cta_text', __('Read Latest Posts', 'creative-newsletter'))); ?>
                    </a>
                </div>
            </div>
        </section><!-- .hero-section -->
    <?php endif; ?>

    <div id="content" class="site-content">

<?php
/**
 * Fallback menu for when no menu is assigned
 */
function creative_newsletter_fallback_menu() {
    echo '<ul id="primary-menu">';
    echo '<li><a href="' . esc_url(home_url('/')) . '">' . esc_html__('Home', 'creative-newsletter') . '</a></li>';
    
    if (get_option('page_for_posts')) {
        echo '<li><a href="' . esc_url(get_permalink(get_option('page_for_posts'))) . '">' . esc_html__('Blog', 'creative-newsletter') . '</a></li>';
    }
    
    $pages = get_pages(array('number' => 5));
    foreach ($pages as $page) {
        echo '<li><a href="' . esc_url(get_permalink($page->ID)) . '">' . esc_html($page->post_title) . '</a></li>';
    }
    
    echo '</ul>';
}
?>