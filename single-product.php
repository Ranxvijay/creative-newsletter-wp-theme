<?php
/**
 * The template for displaying single products
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
                    <?php while (have_posts()) : the_post();
                        $price = get_post_meta(get_the_ID(), '_product_price', true);
                        $sale_price = get_post_meta(get_the_ID(), '_product_sale_price', true);
                        $external_link = get_post_meta(get_the_ID(), '_product_external_link', true);
                        $featured = get_post_meta(get_the_ID(), '_product_featured', true);
                        ?>
                        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                            <div class="product-single" style="background: white; border-radius: 15px; overflow: hidden; box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);">
                                
                                <div class="row" style="align-items: center;">
                                    <?php if (has_post_thumbnail()) : ?>
                                        <div class="col" style="flex: 0 0 50%;">
                                            <div class="product-image-large">
                                                <?php the_post_thumbnail('large', array('style' => 'width: 100%; height: auto; border-radius: 15px 0 0 15px;')); ?>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                    
                                    <div class="col" style="flex: 1; padding: 2rem;">
                                        <header class="entry-header">
                                            <?php if ($featured) : ?>
                                                <span class="featured-badge" style="background: #007cba; color: white; padding: 0.5rem 1rem; border-radius: 25px; font-size: 0.8rem; font-weight: 600; margin-bottom: 1rem; display: inline-block;">
                                                    <?php esc_html_e('Featured', 'creative-newsletter'); ?>
                                                </span>
                                            <?php endif; ?>
                                            
                                            <?php the_title('<h1 class="entry-title product-title" style="margin-bottom: 1rem;">', '</h1>'); ?>
                                            
                                            <?php if ($price) : ?>
                                                <div class="product-price" style="font-size: 2rem; font-weight: 700; color: #007cba; margin-bottom: 1.5rem;">
                                                    <?php if ($sale_price && $sale_price < $price) : ?>
                                                        <span class="sale-price">$<?php echo esc_html($sale_price); ?></span>
                                                        <span class="regular-price" style="text-decoration: line-through; color: #999; font-size: 1.5rem; margin-left: 0.5rem;">$<?php echo esc_html($price); ?></span>
                                                        <span class="discount-badge" style="background: #dc3545; color: white; padding: 0.25rem 0.5rem; border-radius: 15px; font-size: 0.8rem; margin-left: 0.5rem;">
                                                            <?php echo round((($price - $sale_price) / $price) * 100); ?>% OFF
                                                        </span>
                                                    <?php else : ?>
                                                        $<?php echo esc_html($price); ?>
                                                    <?php endif; ?>
                                                </div>
                                            <?php endif; ?>
                                        </header><!-- .entry-header -->

                                        <div class="entry-content" style="margin-bottom: 2rem;">
                                            <?php the_content(); ?>
                                        </div><!-- .entry-content -->

                                        <div class="product-actions">
                                            <?php if ($external_link) : ?>
                                                <a href="<?php echo esc_url($external_link); ?>" class="btn" target="_blank" style="padding: 15px 30px; font-size: 1.1rem; margin-right: 1rem;">
                                                    <?php esc_html_e('View Product', 'creative-newsletter'); ?> ↗
                                                </a>
                                            <?php endif; ?>
                                            
                                            <a href="<?php echo esc_url(get_post_type_archive_link('product')); ?>" class="btn btn-secondary">
                                                <?php esc_html_e('View All Products', 'creative-newsletter'); ?>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <?php if (get_the_content() || get_the_excerpt()) : ?>
                                <div class="product-description" style="margin-top: 3rem; background: #f8f9fa; padding: 2rem; border-radius: 15px;">
                                    <h3><?php esc_html_e('Product Details', 'creative-newsletter'); ?></h3>
                                    <div class="entry-content">
                                        <?php
                                        the_content();
                                        
                                        wp_link_pages(array(
                                            'before' => '<div class="page-links">' . esc_html__('Pages:', 'creative-newsletter'),
                                            'after'  => '</div>',
                                        ));
                                        ?>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <footer class="entry-footer" style="margin-top: 2rem; text-center;">
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
                        </article><!-- #post-<?php the_ID(); ?> -->

                        <?php
                        // Related Products
                        $related_products = new WP_Query(array(
                            'post_type' => 'product',
                            'posts_per_page' => 3,
                            'post__not_in' => array(get_the_ID()),
                            'orderby' => 'rand'
                        ));

                        if ($related_products->have_posts()) :
                            ?>
                            <section class="related-products" style="margin-top: 4rem;">
                                <h3 class="section-title text-center"><?php esc_html_e('Related Products', 'creative-newsletter'); ?></h3>
                                
                                <div class="products-grid">
                                    <?php while ($related_products->have_posts()) : $related_products->the_post();
                                        $related_price = get_post_meta(get_the_ID(), '_product_price', true);
                                        $related_external_link = get_post_meta(get_the_ID(), '_product_external_link', true);
                                        ?>
                                        <div class="product-card">
                                            <?php if (has_post_thumbnail()) : ?>
                                                <div class="product-image" style="background-image: url('<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(), 'creative-newsletter-product')); ?>');">
                                                </div>
                                            <?php endif; ?>
                                            
                                            <div class="product-content">
                                                <h4 class="product-title">
                                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                                </h4>
                                                
                                                <?php if ($related_price) : ?>
                                                    <div class="product-price">$<?php echo esc_html($related_price); ?></div>
                                                <?php endif; ?>
                                                
                                                <div class="product-description">
                                                    <?php the_excerpt(); ?>
                                                </div>
                                                
                                                <?php if ($related_external_link) : ?>
                                                    <a href="<?php echo esc_url($related_external_link); ?>" class="product-btn" target="_blank">
                                                        <?php esc_html_e('View Product', 'creative-newsletter'); ?>
                                                    </a>
                                                <?php else : ?>
                                                    <a href="<?php the_permalink(); ?>" class="product-btn">
                                                        <?php esc_html_e('Learn More', 'creative-newsletter'); ?>
                                                    </a>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    <?php endwhile; ?>
                                </div>
                            </section>
                            <?php
                            wp_reset_postdata();
                        endif;

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