<?php
/**
 * The main template file
 *
 * @package Creative_Newsletter
 */

get_header(); ?>

<div id="primary" class="content-area">
    <main id="main" class="site-main">
        <div class="container">
            <?php if (have_posts()) : ?>
                
                <?php if (is_home() && !is_front_page()) : ?>
                    <header class="page-header">
                        <h1 class="page-title"><?php single_post_title(); ?></h1>
                    </header>
                <?php endif; ?>

                <div class="posts-grid" id="posts">
                    <?php while (have_posts()) : the_post(); ?>
                        <article id="post-<?php the_ID(); ?>" <?php post_class('post-card'); ?>>
                            <?php if (has_post_thumbnail()) : ?>
                                <div class="post-thumbnail">
                                    <a href="<?php the_permalink(); ?>">
                                        <?php the_post_thumbnail('medium_large', array('class' => 'post-thumbnail-img')); ?>
                                    </a>
                                </div>
                            <?php endif; ?>
                            
                            <div class="post-content">
                                <header class="entry-header">
                                    <h2 class="post-title">
                                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                    </h2>
                                </header>

                                <div class="post-excerpt">
                                    <?php 
                                    if (has_excerpt()) {
                                        the_excerpt();
                                    } else {
                                        echo wp_trim_words(get_the_content(), 25, '...');
                                    }
                                    ?>
                                </div>

                                <div class="post-meta">
                                    <span class="post-date">
                                        <?php echo get_the_date(); ?>
                                    </span>
                                    
                                    <span class="reading-time">
                                        <?php echo creative_newsletter_reading_time(); ?>
                                    </span>
                                    
                                    <a href="<?php the_permalink(); ?>" class="read-more">
                                        <?php esc_html_e('Read More', 'creative-newsletter'); ?>
                                    </a>
                                </div>
                            </div>
                        </article>
                    <?php endwhile; ?>
                </div><!-- .posts-grid -->

                <?php creative_newsletter_pagination(); ?>

            <?php else : ?>
                
                <section class="no-results not-found">
                    <div class="content-wrapper">
                        <header class="page-header">
                            <h1 class="page-title"><?php esc_html_e('Nothing here', 'creative-newsletter'); ?></h1>
                        </header>

                        <div class="page-content">
                            <?php if (is_home() && current_user_can('publish_posts')) : ?>
                                
                                <p><?php
                                    printf(
                                        wp_kses(
                                            __('Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'creative-newsletter'),
                                            array(
                                                'a' => array(
                                                    'href' => array(),
                                                ),
                                            )
                                        ),
                                        esc_url(admin_url('post-new.php'))
                                    );
                                ?></p>

                            <?php elseif (is_search()) : ?>

                                <p><?php esc_html_e('Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'creative-newsletter'); ?></p>
                                <?php get_search_form(); ?>

                            <?php else : ?>

                                <p><?php esc_html_e('It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'creative-newsletter'); ?></p>
                                <?php get_search_form(); ?>

                            <?php endif; ?>
                        </div>
                    </div>
                </section>

            <?php endif; ?>
        </div><!-- .container -->
    </main><!-- #main -->
</div><!-- #primary -->

<?php
get_footer();
?>