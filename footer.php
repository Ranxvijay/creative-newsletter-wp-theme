    </div><!-- #content -->

    <?php if (is_front_page() && !is_paged()) : ?>
        <section class="newsletter-section">
            <div class="container">
                <div class="newsletter-content">
                    <h2 class="newsletter-title">
                        <?php echo esc_html(get_theme_mod('newsletter_title', __('Join the Community', 'creative-newsletter'))); ?>
                    </h2>
                    
                    <p class="newsletter-description">
                        <?php echo esc_html(get_theme_mod('newsletter_description', __('Get weekly insights, stories, and inspiration delivered to your inbox.', 'creative-newsletter'))); ?>
                    </p>
                    
                    <form class="newsletter-form" action="#" method="post">
                        <input type="email" class="newsletter-input" placeholder="<?php esc_attr_e('Enter your email address', 'creative-newsletter'); ?>" required>
                        <button type="submit" class="newsletter-submit">
                            <?php esc_html_e('Subscribe', 'creative-newsletter'); ?>
                        </button>
                    </form>
                </div>
            </div>
        </section><!-- .newsletter-section -->
    <?php endif; ?>

    <footer id="colophon" class="site-footer">
        <div class="container">
            <div class="footer-content">
                <?php if (has_nav_menu('footer')) : ?>
                    <nav class="footer-nav" role="navigation">
                        <?php
                        wp_nav_menu(array(
                            'theme_location' => 'footer',
                            'menu_id'        => 'footer-menu',
                            'container'      => false,
                            'depth'          => 1,
                            'fallback_cb'    => 'creative_newsletter_footer_fallback_menu',
                        ));
                        ?>
                    </nav>
                <?php endif; ?>
                
                <?php if (is_active_sidebar('footer-1')) : ?>
                    <div class="footer-widgets">
                        <?php dynamic_sidebar('footer-1'); ?>
                    </div>
                <?php endif; ?>
                
                <div class="site-info">
                    <p>
                        &copy; <?php echo date('Y'); ?> 
                        <a href="<?php echo esc_url(home_url('/')); ?>"><?php bloginfo('name'); ?></a>.
                        <?php esc_html_e('All rights reserved.', 'creative-newsletter'); ?>
                    </p>
                    
                    <p>
                        <?php
                        printf(
                            esc_html__('Powered by %1$s and %2$s', 'creative-newsletter'),
                            '<a href="https://wordpress.org/" target="_blank" rel="noopener">WordPress</a>',
                            '<a href="#" target="_blank" rel="noopener">Creative Newsletter Theme</a>'
                        );
                        ?>
                    </p>
                </div><!-- .site-info -->
            </div><!-- .footer-content -->
        </div><!-- .container -->
    </footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>

<?php
/**
 * Fallback menu for footer when no menu is assigned
 */
function creative_newsletter_footer_fallback_menu() {
    echo '<ul id="footer-menu">';
    echo '<li><a href="' . esc_url(home_url('/')) . '">' . esc_html__('Home', 'creative-newsletter') . '</a></li>';
    echo '<li><a href="' . esc_url(get_privacy_policy_url()) . '">' . esc_html__('Privacy Policy', 'creative-newsletter') . '</a></li>';
    echo '</ul>';
}
?>