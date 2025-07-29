<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 *
 * @package CreativeNewsletter
 */

get_header();
?>

<div id="primary" class="content-area">
    <main id="main" class="site-main">
        
        <?php if (is_home() && is_front_page()) : ?>
            <!-- Hero Section -->
            <section class="hero-section">
                <div class="container">
                    <div class="hero-content">
                        <h1 class="hero-title">
                            <?php echo esc_html(get_theme_mod('hero_title', __('Welcome to Creative Newsletter', 'creative-newsletter'))); ?>
                        </h1>
                        <p class="hero-subtitle">
                            <?php echo esc_html(get_theme_mod('hero_subtitle', __('A modern WordPress theme for creative professionals', 'creative-newsletter'))); ?>
                        </p>
                        <a href="<?php echo esc_url(get_theme_mod('hero_cta_url', '#newsletter')); ?>" class="hero-cta">
                            <?php echo esc_html(get_theme_mod('hero_cta_text', __('Get Started', 'creative-newsletter'))); ?>
                        </a>
                    </div>
                </div>
            </section>

            <!-- Articles Section -->
            <section class="section" id="articles">
                <div class="container">
                    <h2 class="section-title"><?php esc_html_e('Latest Articles', 'creative-newsletter'); ?></h2>
                    
                    <div class="articles-grid">
                        <?php
                        $featured_posts = new WP_Query(array(
                            'posts_per_page' => 6,
                            'post_status' => 'publish',
                            'meta_query' => array(
                                array(
                                    'key' => '_thumbnail_id',
                                    'compare' => 'EXISTS'
                                )
                            )
                        ));

                        if ($featured_posts->have_posts()) :
                            while ($featured_posts->have_posts()) : $featured_posts->the_post();
                                ?>
                                <article class="article-card">
                                    <?php if (has_post_thumbnail()) : ?>
                                        <div class="article-image" style="background-image: url('<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(), 'creative-newsletter-thumbnail')); ?>');">
                                        </div>
                                    <?php endif; ?>
                                    
                                    <div class="article-content">
                                        <div class="article-meta">
                                            <time datetime="<?php echo esc_attr(get_the_date('c')); ?>">
                                                <?php echo esc_html(get_the_date()); ?>
                                            </time>
                                            <?php if (get_the_category()) : ?>
                                                <span class="article-category">
                                                    <?php echo esc_html(get_the_category()[0]->name); ?>
                                                </span>
                                            <?php endif; ?>
                                        </div>
                                        
                                        <h3 class="article-title">
                                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                        </h3>
                                        
                                        <div class="article-excerpt">
                                            <?php the_excerpt(); ?>
                                        </div>
                                        
                                        <a href="<?php the_permalink(); ?>" class="read-more">
                                            <?php esc_html_e('Read More', 'creative-newsletter'); ?>
                                        </a>
                                    </div>
                                </article>
                                <?php
                            endwhile;
                            wp_reset_postdata();
                        else :
                            ?>
                            <div class="no-posts">
                                <p><?php esc_html_e('No articles found. Create some posts to see them here!', 'creative-newsletter'); ?></p>
                            </div>
                            <?php
                        endif;
                        ?>
                    </div>
                    
                    <div class="text-center mt-3">
                        <a href="<?php echo esc_url(get_permalink(get_option('page_for_posts'))); ?>" class="btn">
                            <?php esc_html_e('View All Articles', 'creative-newsletter'); ?>
                        </a>
                    </div>
                </div>
            </section>

            <!-- Products Section -->
            <?php if (post_type_exists('product')) : ?>
                <section class="section" style="background-color: #f8f9fa;">
                    <div class="container">
                        <h2 class="section-title"><?php esc_html_e('Featured Products', 'creative-newsletter'); ?></h2>
                        
                        <div class="products-grid">
                            <?php
                            $featured_products = new WP_Query(array(
                                'post_type' => 'product',
                                'posts_per_page' => 3,
                                'meta_query' => array(
                                    array(
                                        'key' => '_product_featured',
                                        'value' => '1',
                                        'compare' => '='
                                    )
                                )
                            ));

                            if ($featured_products->have_posts()) :
                                while ($featured_products->have_posts()) : $featured_products->the_post();
                                    $price = get_post_meta(get_the_ID(), '_product_price', true);
                                    $sale_price = get_post_meta(get_the_ID(), '_product_sale_price', true);
                                    $external_link = get_post_meta(get_the_ID(), '_product_external_link', true);
                                    ?>
                                    <div class="product-card">
                                        <?php if (has_post_thumbnail()) : ?>
                                            <div class="product-image" style="background-image: url('<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(), 'creative-newsletter-product')); ?>');">
                                            </div>
                                        <?php endif; ?>
                                        
                                        <div class="product-content">
                                            <h3 class="product-title"><?php the_title(); ?></h3>
                                            
                                            <?php if ($price) : ?>
                                                <div class="product-price">
                                                    <?php if ($sale_price && $sale_price < $price) : ?>
                                                        <span class="sale-price">$<?php echo esc_html($sale_price); ?></span>
                                                        <span class="regular-price" style="text-decoration: line-through; color: #999;">$<?php echo esc_html($price); ?></span>
                                                    <?php else : ?>
                                                        $<?php echo esc_html($price); ?>
                                                    <?php endif; ?>
                                                </div>
                                            <?php endif; ?>
                                            
                                            <div class="product-description">
                                                <?php the_excerpt(); ?>
                                            </div>
                                            
                                            <?php if ($external_link) : ?>
                                                <a href="<?php echo esc_url($external_link); ?>" class="product-btn" target="_blank">
                                                    <?php esc_html_e('View Product', 'creative-newsletter'); ?>
                                                </a>
                                            <?php else : ?>
                                                <a href="<?php the_permalink(); ?>" class="product-btn">
                                                    <?php esc_html_e('Learn More', 'creative-newsletter'); ?>
                                                </a>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <?php
                                endwhile;
                                wp_reset_postdata();
                            else :
                                // Show all products if no featured ones
                                $all_products = new WP_Query(array(
                                    'post_type' => 'product',
                                    'posts_per_page' => 3,
                                ));

                                if ($all_products->have_posts()) :
                                    while ($all_products->have_posts()) : $all_products->the_post();
                                        $price = get_post_meta(get_the_ID(), '_product_price', true);
                                        $external_link = get_post_meta(get_the_ID(), '_product_external_link', true);
                                        ?>
                                        <div class="product-card">
                                            <?php if (has_post_thumbnail()) : ?>
                                                <div class="product-image" style="background-image: url('<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(), 'creative-newsletter-product')); ?>');">
                                                </div>
                                            <?php endif; ?>
                                            
                                            <div class="product-content">
                                                <h3 class="product-title"><?php the_title(); ?></h3>
                                                
                                                <?php if ($price) : ?>
                                                    <div class="product-price">$<?php echo esc_html($price); ?></div>
                                                <?php endif; ?>
                                                
                                                <div class="product-description">
                                                    <?php the_excerpt(); ?>
                                                </div>
                                                
                                                <?php if ($external_link) : ?>
                                                    <a href="<?php echo esc_url($external_link); ?>" class="product-btn" target="_blank">
                                                        <?php esc_html_e('View Product', 'creative-newsletter'); ?>
                                                    </a>
                                                <?php else : ?>
                                                    <a href="<?php the_permalink(); ?>" class="product-btn">
                                                        <?php esc_html_e('Learn More', 'creative-newsletter'); ?>
                                                    </a>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <?php
                                    endwhile;
                                    wp_reset_postdata();
                                else :
                                    ?>
                                    <div class="no-products">
                                        <p><?php esc_html_e('No products found. Create some products to see them here!', 'creative-newsletter'); ?></p>
                                    </div>
                                    <?php
                                endif;
                            endif;
                            ?>
                        </div>
                        
                        <div class="text-center mt-3">
                            <a href="<?php echo esc_url(get_post_type_archive_link('product')); ?>" class="btn">
                                <?php esc_html_e('View All Products', 'creative-newsletter'); ?>
                            </a>
                        </div>
                    </div>
                </section>
            <?php endif; ?>

            <!-- Newsletter Section -->
            <section class="section newsletter-section" id="newsletter">
                <div class="container">
                    <h2 class="section-title">
                        <?php echo esc_html(get_theme_mod('newsletter_title', __('Subscribe to Our Newsletter', 'creative-newsletter'))); ?>
                    </h2>
                    <p class="newsletter-description">
                        <?php echo esc_html(get_theme_mod('newsletter_description', __('Stay updated with our latest articles and products.', 'creative-newsletter'))); ?>
                    </p>
                    
                    <form class="newsletter-form" id="newsletter-form">
                        <input type="email" class="newsletter-input" placeholder="<?php esc_attr_e('Enter your email address', 'creative-newsletter'); ?>" required>
                        <button type="submit" class="newsletter-btn">
                            <?php esc_html_e('Subscribe', 'creative-newsletter'); ?>
                        </button>
                    </form>
                    
                    <div id="newsletter-message" style="margin-top: 1rem; text-align: center;"></div>
                </div>
            </section>

        <?php else : ?>
            <!-- Regular blog listing for non-front page -->
            <div class="container">
                <div class="row">
                    <div class="col" style="flex: 1;">
                        <?php if (have_posts()) : ?>
                            <div class="articles-grid">
                                <?php while (have_posts()) : the_post(); ?>
                                    <article id="post-<?php the_ID(); ?>" <?php post_class('article-card'); ?>>
                                        <?php if (has_post_thumbnail()) : ?>
                                            <div class="article-image" style="background-image: url('<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(), 'creative-newsletter-thumbnail')); ?>');">
                                            </div>
                                        <?php endif; ?>
                                        
                                        <div class="article-content">
                                            <div class="article-meta">
                                                <time datetime="<?php echo esc_attr(get_the_date('c')); ?>">
                                                    <?php echo esc_html(get_the_date()); ?>
                                                </time>
                                                <?php if (get_the_category()) : ?>
                                                    <span class="article-category">
                                                        <?php echo esc_html(get_the_category()[0]->name); ?>
                                                    </span>
                                                <?php endif; ?>
                                            </div>
                                            
                                            <h2 class="article-title">
                                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                            </h2>
                                            
                                            <div class="article-excerpt">
                                                <?php the_excerpt(); ?>
                                            </div>
                                            
                                            <a href="<?php the_permalink(); ?>" class="read-more">
                                                <?php esc_html_e('Read More', 'creative-newsletter'); ?>
                                            </a>
                                        </div>
                                    </article>
                                <?php endwhile; ?>
                            </div>

                            <?php
                            the_posts_navigation(array(
                                'prev_text' => __('Older posts', 'creative-newsletter'),
                                'next_text' => __('Newer posts', 'creative-newsletter'),
                            ));
                            ?>

                        <?php else : ?>
                            <section class="no-results not-found">
                                <header class="page-header">
                                    <h1 class="page-title"><?php esc_html_e('Nothing here', 'creative-newsletter'); ?></h1>
                                </header>

                                <div class="page-content">
                                    <?php if (is_home() && current_user_can('publish_posts')) : ?>
                                        <p><?php
                                        printf(
                                            wp_kses(
                                                __('Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'creative-newsletter'),
                                                array(
                                                    'a' => array(
                                                        'href' => array(),
                                                    ),
                                                )
                                            ),
                                            esc_url(admin_url('post-new.php'))
                                        );
                                        ?></p>
                                    <?php elseif (is_search()) : ?>
                                        <p><?php esc_html_e('Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'creative-newsletter'); ?></p>
                                        <?php get_search_form(); ?>
                                    <?php else : ?>
                                        <p><?php esc_html_e('It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'creative-newsletter'); ?></p>
                                        <?php get_search_form(); ?>
                                    <?php endif; ?>
                                </div>
                            </section>
                        <?php endif; ?>
                    </div>

                    <?php if (is_active_sidebar('sidebar-1')) : ?>
                        <aside class="col" style="flex: 0 0 300px; margin-left: 2rem;">
                            <?php dynamic_sidebar('sidebar-1'); ?>
                        </aside>
                    <?php endif; ?>
                </div>
            </div>
        <?php endif; ?>

    </main><!-- #main -->
</div><!-- #primary -->

<?php get_footer(); ?>