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
                    <?php
                    if (has_custom_logo()) {
                        the_custom_logo();
                    } else {
                        ?>
                        <a href="<?php echo esc_url(home_url('/')); ?>" class="site-logo" rel="home">
                            <?php bloginfo('name'); ?>
                        </a>
                        <?php
                    }
                    ?>
                </div><!-- .site-branding -->

                <nav id="site-navigation" class="main-navigation">
                    <button class="mobile-menu-toggle" aria-controls="primary-menu" aria-expanded="false">
                        <span class="screen-reader-text"><?php esc_html_e('Menu', 'creative-newsletter'); ?></span>
                        &#9776;
                    </button>
                    <?php
                    wp_nav_menu(array(
                        'theme_location' => 'primary',
                        'menu_id'        => 'primary-menu',
                        'container'      => false,
                        'walker'         => new Creative_Newsletter_Walker_Nav_Menu(),
                        'fallback_cb'    => 'creative_newsletter_fallback_menu',
                    ));
                    ?>
                </nav><!-- #site-navigation -->
            </div><!-- .header-content -->
        </div><!-- .container -->
    </header><!-- #masthead -->

    <?php
    /**
     * Fallback menu if no menu is assigned
     */
    function creative_newsletter_fallback_menu() {
        echo '<ul id="primary-menu" class="menu">';
        echo '<li class="menu-item"><a href="' . esc_url(home_url('/')) . '">' . esc_html__('Home', 'creative-newsletter') . '</a></li>';
        
        if (get_option('show_on_front') == 'page') {
            echo '<li class="menu-item"><a href="' . esc_url(get_permalink(get_option('page_for_posts'))) . '">' . esc_html__('Blog', 'creative-newsletter') . '</a></li>';
        }
        
        // Show products if custom post type exists
        if (post_type_exists('product')) {
            echo '<li class="menu-item"><a href="' . esc_url(get_post_type_archive_link('product')) . '">' . esc_html__('Products', 'creative-newsletter') . '</a></li>';
        }
        
        echo '<li class="menu-item"><a href="#newsletter">' . esc_html__('Newsletter', 'creative-newsletter') . '</a></li>';
        echo '</ul>';
    }
    ?>