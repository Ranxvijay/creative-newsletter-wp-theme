<?php
/**
 * The template for displaying archive pages
 *
 * @package CreativeNewsletter
 */

get_header();
?>

<div id="primary" class="content-area">
    <main id="main" class="site-main">
        <div class="container">
            <header class="page-header text-center mb-3">
                <?php
                the_archive_title('<h1 class="page-title">', '</h1>');
                the_archive_description('<div class="archive-description">', '</div>');
                ?>
            </header><!-- .page-header -->

            <div class="row">
                <div class="col" style="flex: 1;">
                    <?php if (have_posts()) : ?>
                        <?php if (is_post_type_archive('product')) : ?>
                            <!-- Products Archive -->
                            <div class="products-grid">
                                <?php while (have_posts()) : the_post();
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
                                            <h3 class="product-title">
                                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                            </h3>
                                            
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
                                <?php endwhile; ?>
                            </div>
                        <?php else : ?>
                            <!-- Regular Archive (Posts) -->
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
                        <?php endif; ?>

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
                            </header><!-- .page-header -->

                            <div class="page-content">
                                <p><?php esc_html_e('It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'creative-newsletter'); ?></p>
                                <?php get_search_form(); ?>
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