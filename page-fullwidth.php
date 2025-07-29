<?php
/**
 * Template Name: Full Width Page
 *
 * @package CreativeNewsletter
 */

get_header();
?>

<div id="primary" class="content-area">
    <main id="main" class="site-main">
        <?php while (have_posts()) : the_post(); ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class('full-width-page'); ?>>
                <?php if (has_post_thumbnail()) : ?>
                    <div class="hero-image" style="height: 60vh; background-image: linear-gradient(rgba(0,0,0,0.3), rgba(0,0,0,0.3)), url('<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(), 'full')); ?>'); background-size: cover; background-position: center; display: flex; align-items: center; justify-content: center; color: white; text-align: center;">
                        <div class="hero-content">
                            <h1 class="entry-title" style="font-size: 4rem; margin-bottom: 1rem; text-shadow: 2px 2px 4px rgba(0,0,0,0.5);">
                                <?php the_title(); ?>
                            </h1>
                        </div>
                    </div>
                <?php else : ?>
                    <div class="container">
                        <header class="entry-header text-center" style="padding: 4rem 0 2rem;">
                            <h1 class="entry-title"><?php the_title(); ?></h1>
                        </header>
                    </div>
                <?php endif; ?>

                <div class="entry-content" style="padding: 4rem 0;">
                    <div class="container">
                        <?php
                        the_content();

                        wp_link_pages(array(
                            'before' => '<div class="page-links">' . esc_html__('Pages:', 'creative-newsletter'),
                            'after'  => '</div>',
                        ));
                        ?>
                    </div>
                </div><!-- .entry-content -->

                <?php if (get_edit_post_link()) : ?>
                    <footer class="entry-footer">
                        <div class="container text-center">
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
                        </div>
                    </footer><!-- .entry-footer -->
                <?php endif; ?>
            </article><!-- #post-<?php the_ID(); ?> -->

            <?php
            // If comments are open or we have at least one comment, load up the comment template.
            if (comments_open() || get_comments_number()) :
                ?>
                <div class="container">
                    <?php comments_template(); ?>
                </div>
                <?php
            endif;

        endwhile; // End of the loop.
        ?>
    </main><!-- #main -->
</div><!-- #primary -->

<?php get_footer(); ?>