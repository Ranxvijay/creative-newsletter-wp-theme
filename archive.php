<?php
/**
 * The template for displaying archive pages
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
                
                <?php if (have_posts()) : ?>
                    <header class="page-header">
                        <?php
                        the_archive_title('<h1 class="page-title">', '</h1>');
                        the_archive_description('<div class="archive-description">', '</div>');
                        ?>
                    </header><!-- .page-header -->

                    <div class="posts-grid">
                        <?php while (have_posts()) : ?>
                            <?php the_post(); ?>
                            
                            <article id="post-<?php the_ID(); ?>" <?php post_class('post-card'); ?>>
                                <?php if (has_post_thumbnail()) : ?>
                                    <div class="post-thumbnail">
                                        <a href="<?php the_permalink(); ?>">
                                            <?php the_post_thumbnail('medium'); ?>
                                        </a>
                                    </div>
                                <?php endif; ?>
                                
                                <div class="post-content">
                                    <header class="entry-header">
                                        <h2 class="entry-title">
                                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                        </h2>
                                        <div class="entry-meta">
                                            <span class="posted-on"><?php echo get_the_date(); ?></span>
                                            <span class="byline"><?php esc_html_e('by', 'creative-newsletter-pro'); ?> <?php the_author(); ?></span>
                                        </div>
                                    </header>
                                    
                                    <div class="entry-summary">
                                        <?php the_excerpt(); ?>
                                    </div>
                                    
                                    <footer class="entry-footer">
                                        <a href="<?php the_permalink(); ?>" class="read-more">
                                            <?php esc_html_e('Read More', 'creative-newsletter-pro'); ?>
                                        </a>
                                    </footer>
                                </div>
                            </article>
                            
                        <?php endwhile; ?>
                    </div>
                    
                    <?php creative_newsletter_pagination(); ?>
                    
                <?php else : ?>
                    <p><?php esc_html_e('No posts found.', 'creative-newsletter-pro'); ?></p>
                <?php endif; ?>
            </main><!-- #main -->
            
            <?php get_sidebar(); ?>
        </div>
    </div>
</div>

<?php
get_footer();