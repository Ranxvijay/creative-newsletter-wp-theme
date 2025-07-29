<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package Creative_Newsletter
 */

get_header(); ?>

<div id="primary" class="content-area">
    <main id="main" class="site-main">
        <div class="container">
            <section class="error-404 not-found">
                <div class="content-wrapper text-center">
                    <header class="page-header">
                        <h1 class="page-title"><?php esc_html_e('Oops! Page Not Found', 'creative-newsletter'); ?></h1>
                    </header><!-- .page-header -->

                    <div class="page-content">
                        <div class="error-404-content">
                            <div class="error-number">404</div>
                            
                            <p class="error-message">
                                <?php esc_html_e('It looks like nothing was found at this location. Maybe try searching for something else?', 'creative-newsletter'); ?>
                            </p>
                            
                            <?php get_search_form(); ?>
                            
                            <div class="helpful-links">
                                <h3><?php esc_html_e('Here are some helpful links instead:', 'creative-newsletter'); ?></h3>
                                
                                <div class="links-grid">
                                    <a href="<?php echo esc_url(home_url('/')); ?>" class="btn btn-primary">
                                        <?php esc_html_e('Go Home', 'creative-newsletter'); ?>
                                    </a>
                                    
                                    <?php if (get_option('page_for_posts')) : ?>
                                        <a href="<?php echo esc_url(get_permalink(get_option('page_for_posts'))); ?>" class="btn btn-secondary">
                                            <?php esc_html_e('View Blog', 'creative-newsletter'); ?>
                                        </a>
                                    <?php endif; ?>
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
                                <div class="recent-posts-404">
                                    <h3><?php esc_html_e('Recent Posts:', 'creative-newsletter'); ?></h3>
                                    <div class="recent-posts-grid">
                                        <?php foreach ($recent_posts as $post) : ?>
                                            <div class="recent-post-item">
                                                <h4>
                                                    <a href="<?php echo get_permalink($post['ID']); ?>">
                                                        <?php echo esc_html($post['post_title']); ?>
                                                    </a>
                                                </h4>
                                                <p class="post-date">
                                                    <?php echo get_the_date('F j, Y', $post['ID']); ?>
                                                </p>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div><!-- .page-content -->
                </div>
            </section><!-- .error-404 -->
        </div><!-- .container -->
    </main><!-- #main -->
</div><!-- #primary -->

<style>
/* 404 page styles */
.error-404 {
    padding: 4rem 0;
    min-height: 60vh;
    display: flex;
    align-items: center;
}

.error-404-content {
    max-width: 800px;
    margin: 0 auto;
}

.error-number {
    font-size: 8rem;
    font-weight: 900;
    color: #333333;
    line-height: 1;
    margin-bottom: 1rem;
    opacity: 0.3;
}

.error-message {
    font-size: 1.25rem;
    color: #aaaaaa;
    margin-bottom: 2rem;
    max-width: 600px;
    margin-left: auto;
    margin-right: auto;
}

.helpful-links {
    margin: 3rem 0;
}

.helpful-links h3 {
    font-size: 1.5rem;
    margin-bottom: 2rem;
    color: #ffffff;
}

.links-grid {
    display: flex;
    gap: 1rem;
    justify-content: center;
    flex-wrap: wrap;
}

.recent-posts-404 {
    margin-top: 4rem;
    padding-top: 3rem;
    border-top: 1px solid #1a1a1a;
}

.recent-posts-404 h3 {
    font-size: 1.5rem;
    margin-bottom: 2rem;
    color: #ffffff;
}

.recent-posts-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 2rem;
}

.recent-post-item {
    padding: 1.5rem;
    background-color: #111111;
    border-radius: 8px;
    border: 1px solid #1a1a1a;
    transition: all 0.2s ease;
}

.recent-post-item:hover {
    border-color: #333333;
    transform: translateY(-2px);
}

.recent-post-item h4 {
    margin-bottom: 0.5rem;
}

.recent-post-item h4 a {
    color: #ffffff;
    text-decoration: none;
    font-size: 1.125rem;
}

.recent-post-item h4 a:hover {
    color: #cccccc;
}

.recent-post-item .post-date {
    color: #888888;
    font-size: 0.9rem;
    margin: 0;
}

@media (max-width: 768px) {
    .error-number {
        font-size: 6rem;
    }
    
    .error-message {
        font-size: 1.125rem;
    }
    
    .links-grid {
        flex-direction: column;
        align-items: center;
    }
    
    .recent-posts-grid {
        grid-template-columns: 1fr;
    }
    
    .error-404 {
        padding: 2rem 0;
    }
}
</style>

<?php
get_footer();
?>