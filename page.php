<?php
/**
 * The template for displaying all pages
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
                            <?php if (has_post_thumbnail()) : ?>
                                <div class="featured-image mb-2">
                                    <?php the_post_thumbnail('creative-newsletter-featured', array('class' => 'img-responsive')); ?>
                                </div>
                            <?php endif; ?>

                            <header class="entry-header">
                                <?php the_title('<h1 class="entry-title">', '</h1>'); ?>
                            </header><!-- .entry-header -->

                            <div class="entry-content">
                                <?php
                                the_content();

                                wp_link_pages(array(
                                    'before' => '<div class="page-links">' . esc_html__('Pages:', 'creative-newsletter'),
                                    'after'  => '</div>',
                                ));
                                ?>
                            </div><!-- .entry-content -->

                            <?php if (get_edit_post_link()) : ?>
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
                            <?php endif; ?>
                        </article><!-- #post-<?php the_ID(); ?> -->

                        <?php
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