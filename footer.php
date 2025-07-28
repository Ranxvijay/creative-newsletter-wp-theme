<footer class="site-footer">
    <div class="container">
        <div class="footer-content">
            <div class="footer-section">
                <h3>About</h3>
                <p>Creative Newsletter Pro - Built by Ranvijay Singh, Web Developer from Canada</p>
            </div>
            <div class="footer-section">
                <h3>Links</h3>
                <ul>
                    <li><a href="<?php echo home_url('/about'); ?>">About</a></li>
                    <li><a href="<?php echo home_url('/newsletter'); ?>">Newsletter</a></li>
                    <li><a href="<?php echo home_url('/products'); ?>">Products</a></li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. Built by Ranvijay Singh.</p>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>