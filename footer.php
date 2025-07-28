    </div><!-- #content -->

    <footer id="colophon" class="site-footer">
        <div class="container">
            <div class="footer-content">
                <?php for ($i = 1; $i <= 4; $i++) : ?>
                    <?php if (is_active_sidebar('footer-' . $i)) : ?>
                        <div class="footer-section footer-<?php echo $i; ?>">
                            <?php dynamic_sidebar('footer-' . $i); ?>
                        </div>
                    <?php endif; ?>
                <?php endfor; ?>

                <?php if (!is_active_sidebar('footer-1') && !is_active_sidebar('footer-2') && !is_active_sidebar('footer-3') && !is_active_sidebar('footer-4')) : ?>
                    <!-- Default footer content when no widgets are active -->
                    <div class="footer-section">
                        <h3><?php esc_html_e('About Creative Newsletter Pro', 'creative-newsletter-pro'); ?></h3>
                        <p><?php esc_html_e('A modern WordPress theme designed for newsletter creators and digital product sellers.', 'creative-newsletter-pro'); ?></p>
                    </div>

                    <div class="footer-section">
                        <h3><?php esc_html_e('Quick Links', 'creative-newsletter-pro'); ?></h3>
                        <ul>
                            <li><a href="<?php echo esc_url(home_url('/about')); ?>"><?php esc_html_e('About', 'creative-newsletter-pro'); ?></a></li>
                            <li><a href="<?php echo esc_url(home_url('/newsletter')); ?>"><?php esc_html_e('Newsletter', 'creative-newsletter-pro'); ?></a></li>
                            <li><a href="<?php echo esc_url(home_url('/products')); ?>"><?php esc_html_e('Products', 'creative-newsletter-pro'); ?></a></li>
                            <li><a href="<?php echo esc_url(home_url('/contact')); ?>"><?php esc_html_e('Contact', 'creative-newsletter-pro'); ?></a></li>
                        </ul>
                    </div>

                    <div class="footer-section">
                        <h3><?php esc_html_e('Follow Us', 'creative-newsletter-pro'); ?></h3>
                        <?php creative_newsletter_social_links(); ?>
                    </div>

                    <div class="footer-section">
                        <h3><?php esc_html_e('Contact Info', 'creative-newsletter-pro'); ?></h3>
                        <p><?php esc_html_e('Email: hello@ranvijaysingh.com', 'creative-newsletter-pro'); ?></p>
                        <p><?php esc_html_e('Website: ranvijaysingh.com', 'creative-newsletter-pro'); ?></p>
                    </div>
                <?php endif; ?>
            </div><!-- .footer-content -->

            <div class="footer-bottom">
                <p>&copy; <?php echo date('Y'); ?> <a href="<?php echo esc_url(home_url('/')); ?>"><?php bloginfo('name'); ?></a>. 
                <?php esc_html_e('Built with Creative Newsletter Pro theme by', 'creative-newsletter-pro'); ?> 
                <a href="https://ranvijaysingh.com" target="_blank" rel="noopener"><?php esc_html_e('Ranvijay Singh', 'creative-newsletter-pro'); ?></a>.</p>
            </div>
        </div><!-- .container -->
    </footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>