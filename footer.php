    <footer id="colophon" class="site-footer">
        <div class="container">
            <div class="footer-content">
                <?php if (is_active_sidebar('footer-1')) : ?>
                    <div class="footer-widget-area">
                        <?php dynamic_sidebar('footer-1'); ?>
                    </div>
                <?php else : ?>
                    <div class="footer-widget">
                        <h4><?php bloginfo('name'); ?></h4>
                        <p><?php bloginfo('description'); ?></p>
                        <p><?php esc_html_e('A modern WordPress theme for creative professionals and newsletter publishers.', 'creative-newsletter'); ?></p>
                    </div>
                <?php endif; ?>

                <?php if (is_active_sidebar('footer-2')) : ?>
                    <div class="footer-widget-area">
                        <?php dynamic_sidebar('footer-2'); ?>
                    </div>
                <?php else : ?>
                    <div class="footer-widget">
                        <h4><?php esc_html_e('Quick Links', 'creative-newsletter'); ?></h4>
                        <ul>
                            <li><a href="<?php echo esc_url(home_url('/')); ?>"><?php esc_html_e('Home', 'creative-newsletter'); ?></a></li>
                            <?php if (get_option('show_on_front') == 'page') : ?>
                                <li><a href="<?php echo esc_url(get_permalink(get_option('page_for_posts'))); ?>"><?php esc_html_e('Blog', 'creative-newsletter'); ?></a></li>
                            <?php endif; ?>
                            <?php if (post_type_exists('product')) : ?>
                                <li><a href="<?php echo esc_url(get_post_type_archive_link('product')); ?>"><?php esc_html_e('Products', 'creative-newsletter'); ?></a></li>
                            <?php endif; ?>
                            <li><a href="#newsletter"><?php esc_html_e('Newsletter', 'creative-newsletter'); ?></a></li>
                        </ul>
                    </div>
                <?php endif; ?>

                <?php if (is_active_sidebar('footer-3')) : ?>
                    <div class="footer-widget-area">
                        <?php dynamic_sidebar('footer-3'); ?>
                    </div>
                <?php else : ?>
                    <div class="footer-widget">
                        <h4><?php esc_html_e('Connect', 'creative-newsletter'); ?></h4>
                        <ul>
                            <li><a href="mailto:hello@example.com"><?php esc_html_e('Email Us', 'creative-newsletter'); ?></a></li>
                            <li><a href="#" target="_blank"><?php esc_html_e('Twitter', 'creative-newsletter'); ?></a></li>
                            <li><a href="#" target="_blank"><?php esc_html_e('LinkedIn', 'creative-newsletter'); ?></a></li>
                            <li><a href="#" target="_blank"><?php esc_html_e('GitHub', 'creative-newsletter'); ?></a></li>
                        </ul>
                    </div>
                <?php endif; ?>
            </div><!-- .footer-content -->

            <div class="footer-bottom">
                <p>&copy; <?php echo date('Y'); ?> <a href="<?php echo esc_url(home_url('/')); ?>"><?php bloginfo('name'); ?></a>. <?php esc_html_e('All rights reserved.', 'creative-newsletter'); ?></p>
                
                <?php if (has_nav_menu('footer')) : ?>
                    <nav class="footer-navigation">
                        <?php
                        wp_nav_menu(array(
                            'theme_location' => 'footer',
                            'menu_id'        => 'footer-menu',
                            'container'      => false,
                            'depth'          => 1,
                        ));
                        ?>
                    </nav>
                <?php endif; ?>
            </div><!-- .footer-bottom -->
        </div><!-- .container -->
    </footer><!-- #colophon -->

    <!-- Scroll to Top Button -->
    <a href="#" class="scroll-to-top" id="scroll-to-top">
        <span>↑</span>
    </a>

</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>