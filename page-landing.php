<?php
/**
 * Template Name: Landing Page
 *
 * @package CreativeNewsletter
 */

get_header();
?>

<div id="primary" class="content-area">
    <main id="main" class="site-main">
        <?php while (have_posts()) : the_post(); ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class('landing-page'); ?>>
                
                <!-- Hero Section -->
                <section class="hero-section" style="padding: 120px 0 80px;">
                    <div class="container">
                        <div class="hero-content">
                            <h1 class="hero-title">
                                <?php 
                                $custom_title = get_post_meta(get_the_ID(), '_landing_hero_title', true);
                                echo $custom_title ? esc_html($custom_title) : get_the_title();
                                ?>
                            </h1>
                            <p class="hero-subtitle">
                                <?php 
                                $custom_subtitle = get_post_meta(get_the_ID(), '_landing_hero_subtitle', true);
                                echo $custom_subtitle ? esc_html($custom_subtitle) : get_the_excerpt();
                                ?>
                            </p>
                            
                            <?php 
                            $cta_text = get_post_meta(get_the_ID(), '_landing_cta_text', true);
                            $cta_url = get_post_meta(get_the_ID(), '_landing_cta_url', true);
                            if ($cta_text && $cta_url) :
                                ?>
                                <a href="<?php echo esc_url($cta_url); ?>" class="hero-cta">
                                    <?php echo esc_html($cta_text); ?>
                                </a>
                                <?php
                            endif;
                            ?>
                        </div>
                    </div>
                </section>

                <!-- Content Section -->
                <div class="entry-content">
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

                <!-- Features Section -->
                <?php 
                $features = get_post_meta(get_the_ID(), '_landing_features', true);
                if ($features) :
                    ?>
                    <section class="features-section section" style="background: #f8f9fa;">
                        <div class="container">
                            <h2 class="section-title"><?php esc_html_e('Features', 'creative-newsletter'); ?></h2>
                            <div class="features-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 2rem;">
                                <?php foreach ($features as $feature) : ?>
                                    <div class="feature-card" style="background: white; padding: 2rem; border-radius: 15px; text-align: center; box-shadow: 0 5px 15px rgba(0,0,0,0.1);">
                                        <?php if (!empty($feature['icon'])) : ?>
                                            <div class="feature-icon" style="font-size: 3rem; margin-bottom: 1rem; color: #007cba;">
                                                <?php echo esc_html($feature['icon']); ?>
                                            </div>
                                        <?php endif; ?>
                                        
                                        <h3 class="feature-title"><?php echo esc_html($feature['title']); ?></h3>
                                        <p class="feature-description"><?php echo esc_html($feature['description']); ?></p>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </section>
                    <?php
                endif;
                ?>

                <!-- Testimonials Section -->
                <?php 
                $testimonials = get_post_meta(get_the_ID(), '_landing_testimonials', true);
                if ($testimonials) :
                    ?>
                    <section class="testimonials-section section">
                        <div class="container">
                            <h2 class="section-title"><?php esc_html_e('What People Say', 'creative-newsletter'); ?></h2>
                            <div class="testimonials-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(350px, 1fr)); gap: 2rem;">
                                <?php foreach ($testimonials as $testimonial) : ?>
                                    <div class="testimonial-card" style="background: white; padding: 2rem; border-radius: 15px; box-shadow: 0 5px 15px rgba(0,0,0,0.1); position: relative;">
                                        <div class="testimonial-content" style="font-style: italic; margin-bottom: 1.5rem; color: #555;">
                                            "<?php echo esc_html($testimonial['content']); ?>"
                                        </div>
                                        <div class="testimonial-author" style="display: flex; align-items: center;">
                                            <?php if (!empty($testimonial['avatar'])) : ?>
                                                <img src="<?php echo esc_url($testimonial['avatar']); ?>" 
                                                     alt="<?php echo esc_attr($testimonial['name']); ?>" 
                                                     style="width: 50px; height: 50px; border-radius: 50%; margin-right: 1rem; object-fit: cover;">
                                            <?php endif; ?>
                                            <div>
                                                <div class="author-name" style="font-weight: 600; color: #333;">
                                                    <?php echo esc_html($testimonial['name']); ?>
                                                </div>
                                                <?php if (!empty($testimonial['position'])) : ?>
                                                    <div class="author-position" style="font-size: 0.9rem; color: #666;">
                                                        <?php echo esc_html($testimonial['position']); ?>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </section>
                    <?php
                endif;
                ?>

                <!-- Newsletter Section -->
                <?php if (get_post_meta(get_the_ID(), '_landing_show_newsletter', true)) : ?>
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
                <?php endif; ?>

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

        endwhile; // End of the loop.
        ?>
    </main><!-- #main -->
</div><!-- #primary -->

<?php get_footer(); ?>