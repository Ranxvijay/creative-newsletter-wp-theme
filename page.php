<?php
/**
 * The template for displaying all pages
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
                        </header><!-- .entry-header -->

                        <?php if (has_post_thumbnail()) : ?>
                            <div class="post-thumbnail">
                                <?php the_post_thumbnail('large'); ?>
                            </div>
                        <?php endif; ?>

                        <div class="entry-content">
                            <?php
                            the_content();

                            wp_link_pages(array(
                                'before' => '<div class="page-links">' . esc_html__('Pages:', 'creative-newsletter-pro'),
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
                                            /* translators: %s: Name of current post. Only visible to screen readers */
                                            __('Edit <span class="screen-reader-text">"%s"</span>', 'creative-newsletter-pro'),
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
                    ?>

                <?php endwhile; // End of the loop. ?>
            </main><!-- #main -->
            
            <?php get_sidebar(); ?>
        </div>
    </div>
</div>

<?php
get_footer();