<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package CreativeNewsletter
 */

get_header();
?>

<div id="primary" class="content-area">
    <main id="main" class="site-main">
        <div class="container">
            <section class="error-404 not-found text-center" style="padding: 80px 0;">
                <header class="page-header">
                    <h1 class="page-title" style="font-size: 8rem; color: #ccc; margin-bottom: 1rem;">404</h1>
                    <h2 style="margin-bottom: 2rem;"><?php esc_html_e('Oops! That page can&rsquo;t be found.', 'creative-newsletter'); ?></h2>
                </header><!-- .page-header -->

                <div class="page-content">
                    <p style="font-size: 1.2rem; color: #666; margin-bottom: 2rem;">
                        <?php esc_html_e('It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'creative-newsletter'); ?>
                    </p>

                    <?php get_search_form(); ?>

                    <div style="margin-top: 3rem;">
                        <h3><?php esc_html_e('Try looking in the monthly archives.', 'creative-newsletter'); ?></h3>
                        <?php
                        wp_get_archives(array(
                            'type'    => 'monthly',
                            'limit'   => 12,
                            'format'  => 'custom',
                            'before'  => '<div style="display: inline-block; margin: 0.5rem;"><a href="',
                            'after'   => '</a></div>',
                            'show_post_count' => true,
                        ));
                        ?>
                    </div>

                    <?php
                    // Categories
                    $categories = get_categories(array(
                        'orderby' => 'count',
                        'order'   => 'DESC',
                        'number'  => 10,
                    ));

                    if ($categories) :
                        ?>
                        <div style="margin-top: 3rem;">
                            <h3><?php esc_html_e('Most Used Categories', 'creative-newsletter'); ?></h3>
                            <div>
                                <?php foreach ($categories as $category) : ?>
                                    <a href="<?php echo esc_url(get_category_link($category->term_id)); ?>" 
                                       style="display: inline-block; margin: 0.5rem; padding: 0.5rem 1rem; background: #f8f9fa; border-radius: 25px; text-decoration: none;">
                                        <?php echo esc_html($category->name); ?> (<?php echo esc_html($category->count); ?>)
                                    </a>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <?php
                    endif;

                    // Recent posts
                    $recent_posts = wp_get_recent_posts(array(
                        'numberposts' => 5,
                        'post_status' => 'publish'
                    ));

                    if ($recent_posts) :
                        ?>
                        <div style="margin-top: 3rem;">
                            <h3><?php esc_html_e('Recent Posts', 'creative-newsletter'); ?></h3>
                            <ul style="list-style: none; padding: 0;">
                                <?php foreach ($recent_posts as $post_item) : ?>
                                    <li style="margin-bottom: 0.5rem;">
                                        <a href="<?php echo esc_url(get_permalink($post_item['ID'])); ?>">
                                            <?php echo esc_html($post_item['post_title']); ?>
                                        </a>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                        <?php
                        wp_reset_postdata();
                    endif;
                    ?>

                    <div style="margin-top: 3rem;">
                        <a href="<?php echo esc_url(home_url('/')); ?>" class="btn">
                            <?php esc_html_e('Go to Homepage', 'creative-newsletter'); ?>
                        </a>
                    </div>
                </div><!-- .page-content -->
            </section><!-- .error-404 -->
        </div>
    </main><!-- #main -->
</div><!-- #primary -->

<?php get_footer(); ?>