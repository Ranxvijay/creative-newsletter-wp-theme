<?php
/**
 * The template for displaying pages
 *
 * @package Creative_Newsletter
 */

get_header(); ?>

<div id="primary" class="content-area">
    <main id="main" class="site-main">
        <?php while (have_posts()) : the_post(); ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class('single-page'); ?>>
                <div class="content-wrapper">
                    <header class="page-header">
                        <h1 class="page-title"><?php the_title(); ?></h1>
                        
                        <?php if (has_excerpt()) : ?>
                            <div class="page-excerpt">
                                <?php the_excerpt(); ?>
                            </div>
                        <?php endif; ?>
                    </header>

                    <?php if (has_post_thumbnail()) : ?>
                        <div class="page-thumbnail">
                            <?php the_post_thumbnail('full'); ?>
                        </div>
                    <?php endif; ?>

                    <div class="page-content">
                        <?php
                        the_content();

                        wp_link_pages(array(
                            'before' => '<div class="page-links">' . esc_html__('Pages:', 'creative-newsletter'),
                            'after'  => '</div>',
                        ));
                        ?>
                    </div>
                </div>
            </article>

            <?php
            // Comments
            if (comments_open() || get_comments_number()) :
                echo '<div class="content-wrapper">';
                comments_template();
                echo '</div>';
            endif;
            ?>

        <?php endwhile; ?>
    </main><!-- #main -->
</div><!-- #primary -->

<style>
/* Page template styles */
.single-page {
    padding: 4rem 0;
}

.page-header {
    text-align: center;
    margin-bottom: 3rem;
    padding-bottom: 2rem;
    border-bottom: 1px solid #1a1a1a;
}

.page-title {
    font-size: 3rem;
    font-weight: 700;
    margin-bottom: 1rem;
    line-height: 1.2;
}

.page-excerpt {
    font-size: 1.25rem;
    color: #888888;
    max-width: 600px;
    margin: 0 auto;
    line-height: 1.6;
}

.page-excerpt p {
    color: inherit;
    margin-bottom: 1rem;
}

.page-thumbnail {
    margin-bottom: 3rem;
    text-align: center;
}

.page-thumbnail img {
    width: 100%;
    height: auto;
    border-radius: 12px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
}

.page-content {
    font-size: 1.125rem;
    line-height: 1.8;
    color: #cccccc;
}

.page-content img {
    width: 100%;
    height: auto;
    border-radius: 8px;
    margin: 2rem 0;
}

.page-content blockquote {
    border-left: 4px solid #333333;
    padding-left: 2rem;
    margin: 2rem 0;
    font-style: italic;
    color: #aaaaaa;
}

.page-content h2,
.page-content h3,
.page-content h4,
.page-content h5,
.page-content h6 {
    color: #ffffff;
    margin-top: 2.5rem;
    margin-bottom: 1rem;
}

.page-content ul,
.page-content ol {
    margin: 1.5rem 0;
    padding-left: 2rem;
}

.page-content li {
    margin-bottom: 0.5rem;
    color: #cccccc;
}

.page-content a {
    color: #ffffff;
    text-decoration: underline;
    text-decoration-color: #333333;
    transition: all 0.2s ease;
}

.page-content a:hover {
    color: #cccccc;
    text-decoration-color: #666666;
}

.page-links {
    margin-top: 2rem;
    padding-top: 2rem;
    border-top: 1px solid #1a1a1a;
    text-align: center;
}

.page-links a {
    display: inline-block;
    padding: 0.5rem 1rem;
    margin: 0 0.25rem;
    background-color: #111111;
    color: #ffffff;
    text-decoration: none;
    border-radius: 4px;
    border: 1px solid #333333;
    transition: all 0.2s ease;
}

.page-links a:hover {
    background-color: #333333;
    border-color: #555555;
}

@media (max-width: 768px) {
    .single-page {
        padding: 2rem 0;
    }
    
    .page-title {
        font-size: 2rem;
    }
    
    .page-excerpt {
        font-size: 1.125rem;
    }
    
    .page-content {
        font-size: 1rem;
    }
}
</style>

<?php
get_footer();
?>