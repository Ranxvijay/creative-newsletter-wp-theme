<?php
/**
 * Template Name: Newsletter Page
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
                            <p style="font-size: 1.25rem; color: #64748b; margin-top: 1rem;">
                                <?php esc_html_e('Weekly insights on web development, design, and digital products', 'creative-newsletter-pro'); ?>
                            </p>
                        </header><!-- .entry-header -->

                        <div class="entry-content">
                            <!-- Newsletter Signup Section -->
                            <section class="newsletter-signup" style="background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%); color: white; padding: 3rem; border-radius: 12px; text-align: center; margin: 2rem 0;">
                                <h2 style="color: white; margin-bottom: 1rem;"><?php esc_html_e('Join 2,500+ Subscribers', 'creative-newsletter-pro'); ?></h2>
                                <p style="margin-bottom: 2rem; opacity: 0.9;">
                                    <?php esc_html_e('Get weekly insights delivered straight to your inbox. No spam, unsubscribe anytime.', 'creative-newsletter-pro'); ?>
                                </p>
                                
                                <form class="newsletter-form" id="newsletter-signup-form" style="max-width: 400px; margin: 0 auto;">
                                    <input type="email" name="email" placeholder="<?php esc_attr_e('Enter your email address', 'creative-newsletter-pro'); ?>" required style="width: 100%; margin-bottom: 1rem;">
                                    <button type="submit" class="btn" style="background: white; color: #6366f1; width: 100%;">
                                        <?php esc_html_e('Subscribe for Free', 'creative-newsletter-pro'); ?>
                                    </button>
                                </form>
                                
                                <div id="newsletter-message" style="margin-top: 1rem;"></div>
                            </section>

                            <!-- Newsletter Archive -->
                            <section style="margin: 3rem 0;">
                                <h2><?php esc_html_e('Recent Newsletters', 'creative-newsletter-pro'); ?></h2>
                                
                                <?php
                                // Query newsletter posts
                                $newsletter_query = new WP_Query(array(
                                    'post_type' => 'newsletter',
                                    'posts_per_page' => 6,
                                    'post_status' => 'publish'
                                ));

                                if ($newsletter_query->have_posts()) :
                                ?>
                                    <div class="newsletter-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(350px, 1fr)); gap: 2rem; margin-top: 2rem;">
                                        <?php while ($newsletter_query->have_posts()) : ?>
                                            <?php $newsletter_query->the_post(); ?>
                                            
                                            <article class="newsletter-card" style="background: white; border-radius: 12px; padding: 2rem; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05); border: 1px solid #e2e8f0;">
                                                <div style="display: flex; align-items: center; margin-bottom: 1rem;">
                                                    <div style="width: 40px; height: 40px; background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; margin-right: 1rem;">
                                                        📧
                                                    </div>
                                                    <div>
                                                        <h3 style="margin: 0; font-size: 1.125rem;">
                                                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                                        </h3>
                                                        <p style="margin: 0; font-size: 0.875rem; color: #64748b;">
                                                            <?php echo get_the_date(); ?>
                                                        </p>
                                                    </div>
                                                </div>
                                                
                                                <div class="newsletter-excerpt">
                                                    <?php the_excerpt(); ?>
                                                </div>
                                                
                                                <a href="<?php the_permalink(); ?>" class="btn btn-secondary" style="margin-top: 1rem;">
                                                    <?php esc_html_e('Read Newsletter', 'creative-newsletter-pro'); ?>
                                                </a>
                                            </article>
                                            
                                        <?php endwhile; ?>
                                    </div>
                                    
                                    <?php wp_reset_postdata(); ?>
                                    
                                <?php else : ?>
                                    <!-- Sample Newsletter Content -->
                                    <div class="newsletter-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(350px, 1fr)); gap: 2rem; margin-top: 2rem;">
                                        <?php
                                        $sample_newsletters = array(
                                            array(
                                                'title' => 'Weekly Dev Insights #15: CSS Grid Mastery',
                                                'date' => '2025-01-15',
                                                'excerpt' => 'This week we dive deep into CSS Grid layout system, exploring advanced techniques for creating complex layouts with ease.',
                                            ),
                                            array(
                                                'title' => 'Weekly Dev Insights #14: JavaScript ES6+ Features',
                                                'date' => '2025-01-08',
                                                'excerpt' => 'Exploring the latest JavaScript features including destructuring, arrow functions, async/await, and modern development patterns.',
                                            ),
                                            array(
                                                'title' => 'Weekly Dev Insights #13: Responsive Design Tips',
                                                'date' => '2025-01-01',
                                                'excerpt' => 'Essential responsive design techniques for creating websites that work perfectly on all devices and screen sizes.',
                                            ),
                                            array(
                                                'title' => 'Weekly Dev Insights #12: Bootstrap 5 Deep Dive',
                                                'date' => '2024-12-25',
                                                'excerpt' => 'Complete guide to Bootstrap 5 new features, utility classes, and how to build professional websites faster.',
                                            ),
                                            array(
                                                'title' => 'Weekly Dev Insights #11: Web Performance Optimization',
                                                'date' => '2024-12-18',
                                                'excerpt' => 'Techniques to improve website loading speed, optimize images, and enhance user experience through performance.',
                                            ),
                                            array(
                                                'title' => 'Weekly Dev Insights #10: Modern CSS Techniques',
                                                'date' => '2024-12-11',
                                                'excerpt' => 'Latest CSS features including custom properties, container queries, and advanced selectors for modern web development.',
                                            ),
                                        );

                                        foreach ($sample_newsletters as $newsletter) :
                                        ?>
                                            <article class="newsletter-card" style="background: white; border-radius: 12px; padding: 2rem; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05); border: 1px solid #e2e8f0;">
                                                <div style="display: flex; align-items: center; margin-bottom: 1rem;">
                                                    <div style="width: 40px; height: 40px; background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; margin-right: 1rem;">
                                                        📧
                                                    </div>
                                                    <div>
                                                        <h3 style="margin: 0; font-size: 1.125rem;">
                                                            <?php echo esc_html($newsletter['title']); ?>
                                                        </h3>
                                                        <p style="margin: 0; font-size: 0.875rem; color: #64748b;">
                                                            <?php echo esc_html(date('M j, Y', strtotime($newsletter['date']))); ?>
                                                        </p>
                                                    </div>
                                                </div>
                                                
                                                <div class="newsletter-excerpt">
                                                    <p><?php echo esc_html($newsletter['excerpt']); ?></p>
                                                </div>
                                                
                                                <button class="btn btn-secondary" style="margin-top: 1rem;" disabled>
                                                    <?php esc_html_e('Available to Subscribers', 'creative-newsletter-pro'); ?>
                                                </button>
                                            </article>
                                        <?php endforeach; ?>
                                    </div>
                                <?php endif; ?>
                            </section>

                            <!-- Benefits Section -->
                            <section style="background: #f8fafc; padding: 3rem; border-radius: 12px; margin: 3rem 0;">
                                <h2 style="text-align: center; margin-bottom: 2rem;"><?php esc_html_e('What You\'ll Get', 'creative-newsletter-pro'); ?></h2>
                                
                                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 2rem;">
                                    <div style="text-align: center;">
                                        <div style="font-size: 3rem; margin-bottom: 1rem;">💡</div>
                                        <h3><?php esc_html_e('Weekly Insights', 'creative-newsletter-pro'); ?></h3>
                                        <p><?php esc_html_e('Practical tips and techniques delivered every week', 'creative-newsletter-pro'); ?></p>
                                    </div>
                                    
                                    <div style="text-align: center;">
                                        <div style="font-size: 3rem; margin-bottom: 1rem;">🚀</div>
                                        <h3><?php esc_html_e('Latest Trends', 'creative-newsletter-pro'); ?></h3>
                                        <p><?php esc_html_e('Stay updated with the newest web development trends', 'creative-newsletter-pro'); ?></p>
                                    </div>
                                    
                                    <div style="text-align: center;">
                                        <div style="font-size: 3rem; margin-bottom: 1rem;">🎯</div>
                                        <h3><?php esc_html_e('Exclusive Content', 'creative-newsletter-pro'); ?></h3>
                                        <p><?php esc_html_e('Subscriber-only resources and tutorials', 'creative-newsletter-pro'); ?></p>
                                    </div>
                                    
                                    <div style="text-align: center;">
                                        <div style="font-size: 3rem; margin-bottom: 1rem;">💼</div>
                                        <h3><?php esc_html_e('Career Advice', 'creative-newsletter-pro'); ?></h3>
                                        <p><?php esc_html_e('Tips for advancing your web development career', 'creative-newsletter-pro'); ?></p>
                                    </div>
                                </div>
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