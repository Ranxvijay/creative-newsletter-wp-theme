<?php
/**
 * The template for displaying single posts
 *
 * @package Creative_Newsletter
 */

get_header(); ?>

<div id="primary" class="content-area">
    <main id="main" class="site-main">
        <?php while (have_posts()) : the_post(); ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class('single-post'); ?>>
                <header class="single-post-header">
                    <h1 class="single-post-title"><?php the_title(); ?></h1>
                    
                    <div class="single-post-meta">
                        <span class="post-date">
                            <?php echo get_the_date('F j, Y'); ?>
                        </span>
                        
                        <span class="meta-separator">•</span>
                        
                        <span class="reading-time">
                            <?php echo creative_newsletter_reading_time(); ?>
                        </span>
                        
                        <?php if (get_the_author()) : ?>
                            <span class="meta-separator">•</span>
                            <span class="post-author">
                                <?php esc_html_e('By', 'creative-newsletter'); ?> 
                                <a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>">
                                    <?php the_author(); ?>
                                </a>
                            </span>
                        <?php endif; ?>
                        
                        <?php if (has_category()) : ?>
                            <span class="meta-separator">•</span>
                            <span class="post-categories">
                                <?php the_category(', '); ?>
                            </span>
                        <?php endif; ?>
                    </div>
                </header>

                <?php if (has_post_thumbnail()) : ?>
                    <div class="single-post-thumbnail">
                        <?php the_post_thumbnail('full'); ?>
                    </div>
                <?php endif; ?>

                <div class="single-post-content">
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
                </div>

                <footer class="single-post-footer">
                    <?php if (has_tag()) : ?>
                        <div class="post-tags">
                            <h4><?php esc_html_e('Tags:', 'creative-newsletter'); ?></h4>
                            <?php the_tags('<span class="tag-link">', '</span><span class="tag-link">', '</span>'); ?>
                        </div>
                    <?php endif; ?>
                    
                    <?php
                    // Post navigation
                    creative_newsletter_post_navigation();
                    ?>
                </footer>
            </article>

            <?php
            // Author bio
            if (get_the_author_meta('description')) :
            ?>
                <div class="author-bio">
                    <div class="author-avatar">
                        <?php echo get_avatar(get_the_author_meta('ID'), 80); ?>
                    </div>
                    
                    <div class="author-info">
                        <h4 class="author-name">
                            <a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>">
                                <?php the_author(); ?>
                            </a>
                        </h4>
                        
                        <p class="author-description">
                            <?php the_author_meta('description'); ?>
                        </p>
                    </div>
                </div>
            <?php endif; ?>

            <?php
            // Comments
            if (comments_open() || get_comments_number()) :
                comments_template();
            endif;
            ?>

        <?php endwhile; ?>
    </main><!-- #main -->
</div><!-- #primary -->

<style>
/* Additional styles for single post page */
.single-post-thumbnail {
    margin-bottom: 3rem;
    text-align: center;
}

.single-post-thumbnail img {
    width: 100%;
    height: auto;
    border-radius: 12px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
}

.single-post-meta {
    display: flex;
    flex-wrap: wrap;
    gap: 0.5rem;
    align-items: center;
    font-size: 0.9rem;
    color: #888888;
}

.meta-separator {
    color: #555555;
}

.post-author a {
    color: #ffffff;
    text-decoration: none;
    font-weight: 500;
}

.post-author a:hover {
    color: #cccccc;
}

.post-categories a {
    color: #aaaaaa;
    text-decoration: none;
    transition: color 0.2s ease;
}

.post-categories a:hover {
    color: #ffffff;
}

.single-post-footer {
    margin-top: 3rem;
    padding-top: 2rem;
    border-top: 1px solid #1a1a1a;
}

.post-tags {
    margin-bottom: 3rem;
}

.post-tags h4 {
    font-size: 1rem;
    margin-bottom: 1rem;
    color: #ffffff;
}

.tag-link {
    display: inline-block;
    background-color: #1a1a1a;
    color: #cccccc;
    padding: 0.5rem 1rem;
    border-radius: 20px;
    font-size: 0.9rem;
    margin-right: 0.5rem;
    margin-bottom: 0.5rem;
    text-decoration: none;
    transition: all 0.2s ease;
}

.tag-link:hover {
    background-color: #333333;
    color: #ffffff;
}

.post-navigation {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 2rem;
    margin-top: 2rem;
}

.nav-previous,
.nav-next {
    padding: 1.5rem;
    background-color: #111111;
    border-radius: 8px;
    border: 1px solid #1a1a1a;
    transition: all 0.2s ease;
}

.nav-previous:hover,
.nav-next:hover {
    border-color: #333333;
    transform: translateY(-2px);
}

.nav-previous a,
.nav-next a {
    text-decoration: none;
    color: inherit;
}

.nav-subtitle {
    display: block;
    font-size: 0.9rem;
    color: #888888;
    margin-bottom: 0.5rem;
}

.nav-title {
    display: block;
    font-weight: 600;
    color: #ffffff;
}

.author-bio {
    display: flex;
    gap: 1.5rem;
    margin: 3rem auto;
    max-width: 800px;
    padding: 2rem;
    background-color: #111111;
    border-radius: 12px;
    border: 1px solid #1a1a1a;
}

.author-avatar img {
    border-radius: 50%;
}

.author-name {
    margin-bottom: 0.5rem;
}

.author-name a {
    color: #ffffff;
    text-decoration: none;
}

.author-name a:hover {
    color: #cccccc;
}

.author-description {
    color: #aaaaaa;
    line-height: 1.6;
}

@media (max-width: 768px) {
    .single-post-meta {
        flex-direction: column;
        align-items: flex-start;
        gap: 0.25rem;
    }
    
    .meta-separator {
        display: none;
    }
    
    .post-navigation {
        grid-template-columns: 1fr;
    }
    
    .author-bio {
        flex-direction: column;
        text-align: center;
    }
}
</style>

<?php
get_footer();
?>