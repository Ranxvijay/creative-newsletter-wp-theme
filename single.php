<?php
/**
 * The template for displaying all single posts
 *
 * @package CreativeNewsletter
 */

get_header();
?>

<div id="primary" class="content-area">
    <main id="main" class="site-main">
        <div class="container">
            <div class="row">
                <div class="col" style="flex: 1;">
                    <?php while (have_posts()) : the_post(); ?>
                        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                            <header class="entry-header">
                                <?php if (has_post_thumbnail()) : ?>
                                    <div class="featured-image mb-2">
                                        <?php the_post_thumbnail('creative-newsletter-featured', array('class' => 'img-responsive')); ?>
                                    </div>
                                <?php endif; ?>

                                <div class="entry-meta mb-1">
                                    <time class="entry-date published updated" datetime="<?php echo esc_attr(get_the_date('c')); ?>">
                                        <?php echo esc_html(get_the_date()); ?>
                                    </time>

                                    <?php if (get_the_category()) : ?>
                                        <span class="cat-links">
                                            <?php esc_html_e('in', 'creative-newsletter'); ?>
                                            <?php the_category(', '); ?>
                                        </span>
                                    <?php endif; ?>

                                    <?php if (get_the_tags()) : ?>
                                        <span class="tags-links">
                                            <?php the_tags(__('Tagged ', 'creative-newsletter'), ', '); ?>
                                        </span>
                                    <?php endif; ?>

                                    <span class="author vcard">
                                        <?php esc_html_e('by', 'creative-newsletter'); ?>
                                        <a class="url fn n" href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>">
                                            <?php echo esc_html(get_the_author()); ?>
                                        </a>
                                    </span>
                                </div>

                                <?php the_title('<h1 class="entry-title">', '</h1>'); ?>
                            </header><!-- .entry-header -->

                            <div class="entry-content">
                                <?php
                                the_content(sprintf(
                                    wp_kses(
                                        __('Continue reading<span class="screen-reader-text"> "%s"</span>', 'creative-newsletter'),
                                        array(
                                            'span' => array(
                                                'class' => array(),
                                            ),
                                        )
                                    ),
                                    get_the_title()
                                ));

                                wp_link_pages(array(
                                    'before' => '<div class="page-links">' . esc_html__('Pages:', 'creative-newsletter'),
                                    'after'  => '</div>',
                                ));
                                ?>
                            </div><!-- .entry-content -->

                            <footer class="entry-footer">
                                <?php
                                edit_post_link(
                                    sprintf(
                                        wp_kses(
                                            __('Edit <span class="screen-reader-text">"%s"</span>', 'creative-newsletter'),
                                            array(
                                                'span' => array(
                                                    'class' => array(),
                                                ),
                                            )
                                        ),
                                        get_the_title()
                                    ),
                                    '<span class="edit-link">',
                                    '</span>'
                                );
                                ?>
                            </footer><!-- .entry-footer -->
                        </article><!-- #post-<?php the_ID(); ?> -->

                        <?php
                        // Author bio
                        if (get_the_author_meta('description')) :
                            ?>
                            <div class="author-info" style="background: #f8f9fa; padding: 2rem; border-radius: 10px; margin: 2rem 0;">
                                <div class="author-avatar" style="float: left; margin-right: 1rem;">
                                    <?php echo get_avatar(get_the_author_meta('user_email'), 80); ?>
                                </div>
                                <div class="author-description">
                                    <h4><?php printf(__('About %s', 'creative-newsletter'), get_the_author()); ?></h4>
                                    <p><?php the_author_meta('description'); ?></p>
                                </div>
                                <div style="clear: both;"></div>
                            </div>
                            <?php
                        endif;

                        // Navigation between posts
                        the_post_navigation(array(
                            'prev_text' => '<span class="nav-subtitle">' . esc_html__('Previous:', 'creative-newsletter') . '</span> <span class="nav-title">%title</span>',
                            'next_text' => '<span class="nav-subtitle">' . esc_html__('Next:', 'creative-newsletter') . '</span> <span class="nav-title">%title</span>',
                        ));

                        // If comments are open or we have at least one comment, load up the comment template.
                        if (comments_open() || get_comments_number()) :
                            comments_template();
                        endif;

                    endwhile; // End of the loop.
                    ?>
                </div>

                <?php if (is_active_sidebar('sidebar-1')) : ?>
                    <aside class="col" style="flex: 0 0 300px; margin-left: 2rem;">
                        <?php dynamic_sidebar('sidebar-1'); ?>
                    </aside>
                <?php endif; ?>
            </div>
        </div>
    </main><!-- #main -->
</div><!-- #primary -->

<?php get_footer(); ?>