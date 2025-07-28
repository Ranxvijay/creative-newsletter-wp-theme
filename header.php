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
    <header id="masthead" class="site-header">
        <div class="container">
            <div class="header-content">
                <div class="site-branding">
                    <?php
                    if (has_custom_logo()) {
                        the_custom_logo();
                    } else {
                        if (is_front_page() && is_home()) :
                            ?>
                            <h1 class="site-title">
                                <a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
                                    <?php bloginfo('name'); ?>
                                </a>
                            </h1>
                            <?php
                        else :
                            ?>
                            <p class="site-title">
                                <a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
                                    <?php bloginfo('name'); ?>
                                </a>
                            </p>
                            <?php
                        endif;
                    }
                    ?>
                </div><!-- .site-branding -->

                <nav id="site-navigation" class="main-nav">
                    <?php
                    wp_nav_menu(array(
                        'theme_location' => 'primary',
                        'menu_id'        => 'primary-menu',
                        'container'      => false,
                        'fallback_cb'    => false,
                    ));
                    ?>
                </nav><!-- #site-navigation -->

                <button class="mobile-menu-toggle" aria-controls="primary-menu" aria-expanded="false">
                    ☰
                </button>
            </div><!-- .header-content -->
        </div><!-- .container -->
    </header><!-- #masthead -->

    <div id="content" class="site-content">