<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package Creative_Newsletter_Pro
 */

get_header();
?>

<div class="content-area">
    <div class="container">
        <div class="main-content">
            <main id="main" class="site-main">
                <section class="error-404 not-found">
                    <header class="page-header">
                        <h1 class="page-title"><?php esc_html_e('Oops! That page can&rsquo;t be found.', 'creative-newsletter-pro'); ?></h1>
                    </header><!-- .page-header -->

                    <div class="page-content">
                        <div class="error-404-content" style="text-align: center; padding: 4rem 0;">
                            <div style="font-size: 8rem; margin-bottom: 2rem;">🔍</div>
                            <h2><?php esc_html_e('Page Not Found', 'creative-newsletter-pro'); ?></h2>
                            <p><?php esc_html_e('It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'creative-newsletter-pro'); ?></p>

                            <div style="max-width: 400px; margin: 2rem auto;">
                                <?php get_search_form(); ?>
                            </div>

                            <div style="margin-top: 3rem;">
                                <h3><?php esc_html_e('Popular Pages', 'creative-newsletter-pro'); ?></h3>
                                <div style="display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap; margin-top: 1rem;">
                                    <a href="<?php echo esc_url(home_url('/')); ?>" class="btn btn-primary">
                                        <?php esc_html_e('Homepage', 'creative-newsletter-pro'); ?>
                                    </a>
                                    <a href="<?php echo esc_url(home_url('/about')); ?>" class="btn btn-secondary">
                                        <?php esc_html_e('About', 'creative-newsletter-pro'); ?>
                                    </a>
                                    <a href="<?php echo esc_url(home_url('/newsletter')); ?>" class="btn btn-secondary">
                                        <?php esc_html_e('Newsletter', 'creative-newsletter-pro'); ?>
                                    </a>
                                    <a href="<?php echo esc_url(home_url('/products')); ?>" class="btn btn-secondary">
                                        <?php esc_html_e('Products', 'creative-newsletter-pro'); ?>
                                    </a>
                                </div>
                            </div>

                            <?php
                            // Show recent posts
                            $recent_posts = wp_get_recent_posts(array(
                                'numberposts' => 3,
                                'post_status' => 'publish'
                            ));

                            if ($recent_posts) :
                            ?>
                                <div style="margin-top: 3rem;">
                                    <h3><?php esc_html_e('Recent Articles', 'creative-newsletter-pro'); ?></h3>
                                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 1rem; margin-top: 1rem;">
                                        <?php foreach ($recent_posts as $post) : ?>
                                            <div class="recent-post-card" style="background: #f8fafc; padding: 1.5rem; border-radius: 8px;">
                                                <h4 style="margin-bottom: 0.5rem;">
                                                    <a href="<?php echo esc_url(get_permalink($post['ID'])); ?>">
                                                        <?php echo esc_html($post['post_title']); ?>
                                                    </a>
                                                </h4>
                                                <p style="color: #64748b; font-size: 0.875rem;">
                                                    <?php echo esc_html(get_the_date('', $post['ID'])); ?>
                                                </p>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div><!-- .page-content -->
                </section><!-- .error-404 -->
            </main><!-- #main -->
        </div>
    </div>
</div>

<?php
get_footer();