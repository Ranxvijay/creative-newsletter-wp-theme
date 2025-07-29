<?php
/**
 * The template for displaying search results pages
 *
 * @package CreativeNewsletter
 */

get_header();
?>

<div id="primary" class="content-area">
    <main id="main" class="site-main">
        <div class="container">
            <header class="page-header text-center mb-3">
                <h1 class="page-title">
                    <?php
                    printf(esc_html__('Search Results for: %s', 'creative-newsletter'), '<span class="search-query">' . get_search_query() . '</span>');
                    ?>
                </h1>
                
                <?php get_search_form(); ?>
            </header><!-- .page-header -->

            <div class="row">
                <div class="col" style="flex: 1;">
                    <?php if (have_posts()) : ?>
                        <div class="search-results-info" style="margin-bottom: 2rem; padding: 1rem; background: #f8f9fa; border-radius: 10px; text-align: center;">
                            <p><?php printf(esc_html__('Found %d results for your search.', 'creative-newsletter'), $wp_query->found_posts); ?></p>
                        </div>

                        <div class="search-results">
                            <?php while (have_posts()) : the_post(); ?>
                                <article id="post-<?php the_ID(); ?>" <?php post_class('search-result-item'); ?> style="display: flex; margin-bottom: 2rem; padding: 1.5rem; background: white; border-radius: 15px; box-shadow: 0 5px 15px rgba(0,0,0,0.1);">
                                    
                                    <?php if (has_post_thumbnail()) : ?>
                                        <div class="search-result-image" style="flex: 0 0 150px; margin-right: 1.5rem;">
                                            <a href="<?php the_permalink(); ?>">
                                                <?php the_post_thumbnail('medium', array('style' => 'width: 100%; height: 120px; object-fit: cover; border-radius: 10px;')); ?>
                                            </a>
                                        </div>
                                    <?php endif; ?>
                                    
                                    <div class="search-result-content" style="flex: 1;">
                                        <div class="search-result-meta" style="margin-bottom: 0.5rem; font-size: 0.9rem; color: #666;">
                                            <span class="post-type">
                                                <?php
                                                $post_type_obj = get_post_type_object(get_post_type());
                                                echo esc_html($post_type_obj->labels->singular_name);
                                                ?>
                                            </span>
                                            
                                            <span class="separator" style="margin: 0 0.5rem;">•</span>
                                            
                                            <time datetime="<?php echo esc_attr(get_the_date('c')); ?>">
                                                <?php echo esc_html(get_the_date()); ?>
                                            </time>
                                            
                                            <?php if (get_post_type() == 'post' && get_the_category()) : ?>
                                                <span class="separator" style="margin: 0 0.5rem;">•</span>
                                                <span class="categories">
                                                    <?php the_category(', '); ?>
                                                </span>
                                            <?php endif; ?>
                                        </div>
                                        
                                        <h2 class="search-result-title" style="margin-bottom: 0.5rem;">
                                            <a href="<?php the_permalink(); ?>" style="color: #333; text-decoration: none;">
                                                <?php the_title(); ?>
                                            </a>
                                        </h2>
                                        
                                        <div class="search-result-excerpt" style="color: #666; line-height: 1.6;">
                                            <?php
                                            $excerpt = get_the_excerpt();
                                            if ($excerpt) {
                                                echo wp_trim_words($excerpt, 30, '...');
                                            } else {
                                                echo wp_trim_words(get_the_content(), 30, '...');
                                            }
                                            ?>
                                        </div>
                                        
                                        <?php if (get_post_type() == 'product') :
                                            $price = get_post_meta(get_the_ID(), '_product_price', true);
                                            if ($price) :
                                                ?>
                                                <div class="product-price" style="margin-top: 0.5rem; font-weight: 600; color: #007cba;">
                                                    $<?php echo esc_html($price); ?>
                                                </div>
                                                <?php
                                            endif;
                                        endif; ?>
                                        
                                        <a href="<?php the_permalink(); ?>" class="read-more" style="display: inline-block; margin-top: 1rem; color: #007cba; text-decoration: none; font-weight: 600;">
                                            <?php esc_html_e('Read More', 'creative-newsletter'); ?> →
                                        </a>
                                    </div>
                                </article>
                            <?php endwhile; ?>
                        </div>

                        <?php
                        the_posts_navigation(array(
                            'prev_text' => __('Older results', 'creative-newsletter'),
                            'next_text' => __('Newer results', 'creative-newsletter'),
                        ));
                        ?>

                    <?php else : ?>
                        <section class="no-results not-found">
                            <header class="page-header">
                                <h2 class="page-title"><?php esc_html_e('Nothing found', 'creative-newsletter'); ?></h2>
                            </header><!-- .page-header -->

                            <div class="page-content" style="text-align: center; padding: 2rem; background: #f8f9fa; border-radius: 15px;">
                                <p style="font-size: 1.1rem; margin-bottom: 2rem;">
                                    <?php esc_html_e('Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'creative-newsletter'); ?>
                                </p>
                                
                                <?php get_search_form(); ?>
                                
                                <div style="margin-top: 2rem;">
                                    <h4><?php esc_html_e('Search suggestions:', 'creative-newsletter'); ?></h4>
                                    <ul style="list-style: none; padding: 0; color: #666;">
                                        <li><?php esc_html_e('Make sure all words are spelled correctly', 'creative-newsletter'); ?></li>
                                        <li><?php esc_html_e('Try different keywords', 'creative-newsletter'); ?></li>
                                        <li><?php esc_html_e('Try more general keywords', 'creative-newsletter'); ?></li>
                                        <li><?php esc_html_e('Try fewer keywords', 'creative-newsletter'); ?></li>
                                    </ul>
                                </div>
                                
                                <div style="margin-top: 2rem;">
                                    <a href="<?php echo esc_url(home_url('/')); ?>" class="btn">
                                        <?php esc_html_e('Back to Homepage', 'creative-newsletter'); ?>
                                    </a>
                                </div>
                            </div><!-- .page-content -->
                        </section><!-- .no-results -->
                    <?php endif; ?>
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