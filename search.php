<?php
/**
 * The template for displaying search results
 *
 * @package Creative_Newsletter
 */

get_header(); ?>

<div id="primary" class="content-area">
    <main id="main" class="site-main">
        <div class="container">
            <header class="page-header">
                <div class="content-wrapper">
                    <?php if (have_posts()) : ?>
                        <h1 class="page-title">
                            <?php
                            printf(
                                esc_html__('Search Results for: %s', 'creative-newsletter'),
                                '<span class="search-query">' . get_search_query() . '</span>'
                            );
                            ?>
                        </h1>
                        
                        <p class="search-results-count">
                            <?php
                            global $wp_query;
                            printf(
                                _n(
                                    'Found %d result',
                                    'Found %d results',
                                    $wp_query->found_posts,
                                    'creative-newsletter'
                                ),
                                number_format_i18n($wp_query->found_posts)
                            );
                            ?>
                        </p>
                        
                    <?php else : ?>
                        <h1 class="page-title">
                            <?php esc_html_e('Nothing found', 'creative-newsletter'); ?>
                        </h1>
                    <?php endif; ?>
                </div>
            </header><!-- .page-header -->

            <?php if (have_posts()) : ?>
                
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
                        <div class="page-content">
                            <p><?php esc_html_e('Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'creative-newsletter'); ?></p>
                            
                            <?php get_search_form(); ?>
                            
                            <div class="search-suggestions">
                                <h3><?php esc_html_e('Search Suggestions:', 'creative-newsletter'); ?></h3>
                                <ul>
                                    <li><?php esc_html_e('Make sure all words are spelled correctly.', 'creative-newsletter'); ?></li>
                                    <li><?php esc_html_e('Try different keywords.', 'creative-newsletter'); ?></li>
                                    <li><?php esc_html_e('Try more general keywords.', 'creative-newsletter'); ?></li>
                                    <li><?php esc_html_e('Try fewer keywords.', 'creative-newsletter'); ?></li>
                                </ul>
                            </div>
                            
                            <?php
                            // Show recent posts as suggestions
                            $recent_posts = wp_get_recent_posts(array(
                                'numberposts' => 3,
                                'post_status' => 'publish'
                            ));
                            
                            if ($recent_posts) :
                            ?>
                                <div class="recent-posts-suggestions">
                                    <h3><?php esc_html_e('Recent Posts:', 'creative-newsletter'); ?></h3>
                                    <ul>
                                        <?php foreach ($recent_posts as $post) : ?>
                                            <li>
                                                <a href="<?php echo get_permalink($post['ID']); ?>">
                                                    <?php echo esc_html($post['post_title']); ?>
                                                </a>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </section>

            <?php endif; ?>
        </div><!-- .container -->
    </main><!-- #main -->
</div><!-- #primary -->

<style>
/* Search results page styles */
.search-query {
    color: #ffffff;
    font-weight: 600;
}

.search-results-count {
    color: #888888;
    font-size: 1rem;
    margin-top: 0.5rem;
}

.search-suggestions,
.recent-posts-suggestions {
    margin-top: 2rem;
    padding: 2rem;
    background-color: #111111;
    border-radius: 8px;
    border: 1px solid #1a1a1a;
}

.search-suggestions h3,
.recent-posts-suggestions h3 {
    font-size: 1.25rem;
    margin-bottom: 1rem;
    color: #ffffff;
}

.search-suggestions ul,
.recent-posts-suggestions ul {
    list-style: none;
    padding: 0;
    margin: 0;
}

.search-suggestions li,
.recent-posts-suggestions li {
    padding: 0.5rem 0;
    color: #aaaaaa;
    border-bottom: 1px solid #1a1a1a;
}

.search-suggestions li:last-child,
.recent-posts-suggestions li:last-child {
    border-bottom: none;
}

.recent-posts-suggestions a {
    color: #cccccc;
    text-decoration: none;
    transition: color 0.2s ease;
}

.recent-posts-suggestions a:hover {
    color: #ffffff;
}

@media (max-width: 768px) {
    .search-suggestions,
    .recent-posts-suggestions {
        padding: 1.5rem;
        margin-top: 1.5rem;
    }
}
</style>

<?php
get_footer();
?>