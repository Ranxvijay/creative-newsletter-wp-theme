<?php
/**
 * The template for displaying all single posts
 *
 * @package Creative_Newsletter_Pro
 */

get_header();
?>

<div class="content-area">
    <div class="container">
        <div class="main-content">
            <main id="main" class="site-main">
                <?php creative_newsletter_breadcrumbs(); ?>
                
                <?php while (have_posts()) : ?>
                    <?php the_post(); ?>

                    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                        <header class="entry-header">
                            <h1 class="entry-title"><?php the_title(); ?></h1>
                            
                            <div class="entry-meta">
                                <span class="posted-on">
                                    <time class="entry-date published" datetime="<?php echo esc_attr(get_the_date('c')); ?>">
                                        <?php echo get_the_date(); ?>
                                    </time>
                                </span>
                                <span class="byline">
                                    <?php esc_html_e('by', 'creative-newsletter-pro'); ?> 
                                    <span class="author vcard">
                                        <a class="url fn n" href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>">
                                            <?php echo get_the_author(); ?>
                                        </a>
                                    </span>
                                </span>
                                <?php if (has_category()) : ?>
                                    <span class="cat-links">
                                        <?php esc_html_e('in', 'creative-newsletter-pro'); ?> <?php the_category(', '); ?>
                                    </span>
                                <?php endif; ?>
                            </div><!-- .entry-meta -->
                        </header><!-- .entry-header -->

                        <?php if (has_post_thumbnail()) : ?>
                            <div class="post-thumbnail">
                                <?php the_post_thumbnail('large'); ?>
                            </div>
                        <?php endif; ?>

                        <div class="entry-content">
                            <?php
                            the_content(sprintf(
                                wp_kses(
                                    /* translators: %s: Name of current post. Only visible to screen readers */
                                    __('Continue reading<span class="screen-reader-text"> "%s"</span>', 'creative-newsletter-pro'),
                                    array(
                                        'span' => array(
                                            'class' => array(),
                                        ),
                                    )
                                ),
                                get_the_title()
                            ));

                            wp_link_pages(array(
                                'before' => '<div class="page-links">' . esc_html__('Pages:', 'creative-newsletter-pro'),
                                'after'  => '</div>',
                            ));
                            ?>
                        </div><!-- .entry-content -->

                        <footer class="entry-footer">
                            <?php if (has_tag()) : ?>
                                <div class="tags-links">
                                    <strong><?php esc_html_e('Tags:', 'creative-newsletter-pro'); ?></strong>
                                    <?php the_tags('', ', '); ?>
                                </div>
                            <?php endif; ?>

                            <div class="post-navigation">
                                <?php
                                the_post_navigation(array(
                                    'prev_text' => '<span class="nav-subtitle">' . esc_html__('Previous:', 'creative-newsletter-pro') . '</span> <span class="nav-title">%title</span>',
                                    'next_text' => '<span class="nav-subtitle">' . esc_html__('Next:', 'creative-newsletter-pro') . '</span> <span class="nav-title">%title</span>',
                                ));
                                ?>
                            </div>
                        </footer><!-- .entry-footer -->
                    </article><!-- #post-<?php the_ID(); ?> -->

                    <?php
                    // If comments are open or we have at least one comment, load up the comment template.
                    if (comments_open() || get_comments_number()) :
                        comments_template();
                    endif;
                    ?>

                <?php endwhile; // End of the loop. ?>
            </main><!-- #main -->
            
            <?php get_sidebar(); ?>
        </div>
    </div>
</div>

<?php
get_footer();