<?php
/**
 * The template for displaying archive pages
 *
 * @package Creative_Newsletter
 */

get_header(); ?>

<div id="primary" class="content-area">
    <main id="main" class="site-main">
        <div class="container">
            <?php if (have_posts()) : ?>

                <header class="page-header">
                    <div class="content-wrapper">
                        <?php
                        the_archive_title('<h1 class="page-title">', '</h1>');
                        the_archive_description('<div class="archive-description">', '</div>');
                        ?>
                    </div>
                </header><!-- .page-header -->

                <div class="posts-grid">
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
                            <p><?php esc_html_e('It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'creative-newsletter'); ?></p>
                            <?php get_search_form(); ?>
                        </div>
                    </div>
                </section>

            <?php endif; ?>
        </div><!-- .container -->
    </main><!-- #main -->
</div><!-- #primary -->

<style>
/* Archive page specific styles */
.page-header {
    text-align: center;
    padding: 3rem 0;
    margin-bottom: 3rem;
    border-bottom: 1px solid #1a1a1a;
}

.page-title {
    font-size: 2.5rem;
    font-weight: 700;
    margin-bottom: 1rem;
    color: #ffffff;
}

.archive-description {
    font-size: 1.25rem;
    color: #888888;
    max-width: 600px;
    margin: 0 auto;
    line-height: 1.6;
}

.archive-description p {
    color: inherit;
    margin-bottom: 1rem;
}

.no-results {
    text-align: center;
    padding: 4rem 0;
}

.no-results .page-title {
    font-size: 2rem;
    margin-bottom: 1rem;
}

.no-results .page-content {
    max-width: 600px;
    margin: 0 auto;
}

.no-results .page-content p {
    font-size: 1.125rem;
    color: #aaaaaa;
    margin-bottom: 2rem;
}

/* Pagination styles */
.pagination-wrapper {
    margin-top: 4rem;
    text-align: center;
}

.pagination {
    display: inline-block;
}

.pagination .page-numbers {
    display: inline-block;
    padding: 0.75rem 1rem;
    margin: 0 0.25rem;
    color: #888888;
    text-decoration: none;
    border: 1px solid #1a1a1a;
    border-radius: 6px;
    transition: all 0.2s ease;
}

.pagination .page-numbers:hover,
.pagination .page-numbers.current {
    background-color: #333333;
    color: #ffffff;
    border-color: #333333;
}

.pagination .page-numbers.current {
    background-color: #ffffff;
    color: #0a0a0a;
    border-color: #ffffff;
    font-weight: 600;
}

.pagination .prev,
.pagination .next {
    font-weight: 500;
}

@media (max-width: 768px) {
    .page-header {
        padding: 2rem 0;
    }
    
    .page-title {
        font-size: 2rem;
    }
    
    .archive-description {
        font-size: 1.125rem;
    }
    
    .pagination .page-numbers {
        padding: 0.5rem 0.75rem;
        font-size: 0.9rem;
    }
}
</style>

<?php
get_footer();
?>