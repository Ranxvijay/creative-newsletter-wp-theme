<?php
/**
 * Template Name: About Page
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
                
                <?php while (have_posts()) : ?>
                    <?php the_post(); ?>

                    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                        <header class="entry-header text-center">
                            <h1 class="entry-title"><?php the_title(); ?></h1>
                        </header><!-- .entry-header -->

                        <div class="entry-content">
                            <!-- About Hero Section -->
                            <section class="about-hero" style="padding: 4rem 0; text-align: center;">
                                <div class="about-image" style="width: 200px; height: 200px; border-radius: 50%; background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%); display: flex; align-items: center; justify-content: center; color: white; font-size: 4rem; margin: 0 auto 2rem;">
                                    👨‍💻
                                </div>
                                <h2 style="margin-bottom: 1rem;"><?php esc_html_e('Ranvijay Singh', 'creative-newsletter-pro'); ?></h2>
                                <p style="font-size: 1.25rem; color: #64748b; max-width: 600px; margin: 0 auto;">
                                    <?php esc_html_e('Web Developer from Canada | HTML, CSS, JavaScript & Bootstrap Expert', 'creative-newsletter-pro'); ?>
                                </p>
                            </section>

                            <!-- About Content -->
                            <section style="padding: 2rem 0;">
                                <div class="row">
                                    <div class="col" style="flex: 2;">
                                        <h3><?php esc_html_e('About Me', 'creative-newsletter-pro'); ?></h3>
                                        <p><?php esc_html_e('Hello! I\'m Ranvijay Singh, a passionate web developer based in Canada with a deep love for creating beautiful, functional, and user-friendly websites. With years of experience in front-end development, I specialize in HTML5, CSS3, JavaScript, and the Bootstrap framework.', 'creative-newsletter-pro'); ?></p>
                                        
                                        <p><?php esc_html_e('My journey in web development started with a curiosity about how websites work, and it has evolved into a full-fledged career where I help businesses and individuals establish their online presence. I believe in writing clean, semantic code that not only looks great but also performs exceptionally well across all devices.', 'creative-newsletter-pro'); ?></p>

                                        <p><?php esc_html_e('Through this platform, I share my knowledge and insights about web development, create educational content, and offer digital products that help fellow developers accelerate their learning journey. Whether you\'re a beginner looking to get started or an experienced developer seeking to refine your skills, you\'ll find valuable resources here.', 'creative-newsletter-pro'); ?></p>

                                        <div style="margin: 2rem 0;">
                                            <a href="https://ranvijaysingh.com" target="_blank" rel="noopener" class="btn btn-primary">
                                                <?php esc_html_e('Visit My Website', 'creative-newsletter-pro'); ?>
                                            </a>
                                        </div>
                                    </div>
                                    
                                    <div class="col" style="flex: 1;">
                                        <div style="background: #f8fafc; padding: 2rem; border-radius: 12px;">
                                            <h4><?php esc_html_e('Skills & Expertise', 'creative-newsletter-pro'); ?></h4>
                                            <ul style="list-style: none; padding: 0;">
                                                <li style="margin: 0.5rem 0; padding: 0.5rem; background: white; border-radius: 6px; border-left: 4px solid #6366f1;">
                                                    <strong><?php esc_html_e('HTML5', 'creative-newsletter-pro'); ?></strong><br>
                                                    <?php esc_html_e('Semantic markup and accessibility', 'creative-newsletter-pro'); ?>
                                                </li>
                                                <li style="margin: 0.5rem 0; padding: 0.5rem; background: white; border-radius: 6px; border-left: 4px solid #8b5cf6;">
                                                    <strong><?php esc_html_e('CSS3', 'creative-newsletter-pro'); ?></strong><br>
                                                    <?php esc_html_e('Modern layouts, animations, and responsive design', 'creative-newsletter-pro'); ?>
                                                </li>
                                                <li style="margin: 0.5rem 0; padding: 0.5rem; background: white; border-radius: 6px; border-left: 4px solid #3b82f6;">
                                                    <strong><?php esc_html_e('JavaScript', 'creative-newsletter-pro'); ?></strong><br>
                                                    <?php esc_html_e('ES6+, DOM manipulation, and modern frameworks', 'creative-newsletter-pro'); ?>
                                                </li>
                                                <li style="margin: 0.5rem 0; padding: 0.5rem; background: white; border-radius: 6px; border-left: 4px solid #06b6d4;">
                                                    <strong><?php esc_html_e('Bootstrap', 'creative-newsletter-pro'); ?></strong><br>
                                                    <?php esc_html_e('Rapid prototyping and component development', 'creative-newsletter-pro'); ?>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </section>

                            <!-- Stats Section -->
                            <section style="padding: 3rem 0; background: #f8fafc; margin: 3rem -2rem; border-radius: 12px;">
                                <div style="text-align: center; margin-bottom: 2rem;">
                                    <h3><?php esc_html_e('Experience & Achievements', 'creative-newsletter-pro'); ?></h3>
                                </div>
                                <div class="stats-grid">
                                    <div class="stat-item">
                                        <span class="stat-number">5+</span>
                                        <span class="stat-label"><?php esc_html_e('Years Experience', 'creative-newsletter-pro'); ?></span>
                                    </div>
                                    <div class="stat-item">
                                        <span class="stat-number">100+</span>
                                        <span class="stat-label"><?php esc_html_e('Projects Completed', 'creative-newsletter-pro'); ?></span>
                                    </div>
                                    <div class="stat-item">
                                        <span class="stat-number">2,500+</span>
                                        <span class="stat-label"><?php esc_html_e('Newsletter Subscribers', 'creative-newsletter-pro'); ?></span>
                                    </div>
                                    <div class="stat-item">
                                        <span class="stat-number">150+</span>
                                        <span class="stat-label"><?php esc_html_e('Articles Written', 'creative-newsletter-pro'); ?></span>
                                    </div>
                                </div>
                            </section>

                            <!-- Contact Section -->
                            <section style="padding: 3rem 0; text-align: center;">
                                <h3><?php esc_html_e('Let\'s Connect', 'creative-newsletter-pro'); ?></h3>
                                <p style="margin-bottom: 2rem; color: #64748b;">
                                    <?php esc_html_e('Interested in working together or just want to say hello? I\'d love to hear from you!', 'creative-newsletter-pro'); ?>
                                </p>
                                
                                <div style="display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap;">
                                    <a href="mailto:hello@ranvijaysingh.com" class="btn btn-primary">
                                        <?php esc_html_e('Send Email', 'creative-newsletter-pro'); ?>
                                    </a>
                                    <a href="https://ranvijaysingh.com" target="_blank" rel="noopener" class="btn btn-secondary">
                                        <?php esc_html_e('View Portfolio', 'creative-newsletter-pro'); ?>
                                    </a>
                                </div>

                                <?php creative_newsletter_social_links(); ?>
                            </section>

                            <?php
                            // Display page content if any
                            the_content();

                            wp_link_pages(array(
                                'before' => '<div class="page-links">' . esc_html__('Pages:', 'creative-newsletter-pro'),
                                'after'  => '</div>',
                            ));
                            ?>
                        </div><!-- .entry-content -->
                    </article><!-- #post-<?php the_ID(); ?> -->

                <?php endwhile; // End of the loop. ?>
            </main><!-- #main -->
            
            <?php get_sidebar(); ?>
        </div>
    </div>
</div>

<?php
get_footer();