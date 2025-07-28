<?php
/**
 * Template Name: Products Page
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
                                <?php esc_html_e('Premium courses and resources to accelerate your web development journey', 'creative-newsletter-pro'); ?>
                            </p>
                        </header><!-- .entry-header -->

                        <div class="entry-content">
                            <!-- Products Grid -->
                            <section style="margin: 3rem 0;">
                                <?php
                                // Query product posts
                                $products_query = new WP_Query(array(
                                    'post_type' => 'product',
                                    'posts_per_page' => -1,
                                    'post_status' => 'publish'
                                ));

                                if ($products_query->have_posts()) :
                                ?>
                                    <div class="products-grid">
                                        <?php while ($products_query->have_posts()) : ?>
                                            <?php $products_query->the_post(); ?>
                                            
                                            <div class="product-card fade-in">
                                                <?php if (has_post_thumbnail()) : ?>
                                                    <div class="product-image">
                                                        <?php the_post_thumbnail('medium'); ?>
                                                    </div>
                                                <?php else : ?>
                                                    <div class="product-icon">📚</div>
                                                <?php endif; ?>
                                                
                                                <h3><?php the_title(); ?></h3>
                                                <div class="product-excerpt">
                                                    <?php the_excerpt(); ?>
                                                </div>
                                                
                                                <?php $price = creative_newsletter_get_product_price(); ?>
                                                <?php if ($price) : ?>
                                                    <div class="product-price"><?php echo esc_html($price); ?></div>
                                                <?php endif; ?>
                                                
                                                <?php $product_link = creative_newsletter_get_product_link(); ?>
                                                <a href="<?php echo $product_link ? esc_url($product_link) : esc_url(get_permalink()); ?>" 
                                                   class="btn btn-primary" 
                                                   <?php echo $product_link ? 'target="_blank" rel="noopener"' : ''; ?>>
                                                    <?php echo $product_link ? esc_html__('Buy Now', 'creative-newsletter-pro') : esc_html__('Learn More', 'creative-newsletter-pro'); ?>
                                                </a>
                                            </div>
                                            
                                        <?php endwhile; ?>
                                    </div>
                                    
                                    <?php wp_reset_postdata(); ?>
                                    
                                <?php else : ?>
                                    <!-- Sample Products Content -->
                                    <div class="products-grid">
                                        <?php
                                        $sample_products = array(
                                            array(
                                                'title' => 'Web Development Mastery Course',
                                                'description' => 'Complete course covering HTML5, CSS3, JavaScript, and modern frameworks. Learn to build responsive websites from scratch with hands-on projects and real-world examples.',
                                                'price' => '$197',
                                                'icon' => '🎓',
                                                'features' => array(
                                                    '40+ hours of video content',
                                                    '15 hands-on projects',
                                                    'Source code included',
                                                    'Lifetime access',
                                                    'Certificate of completion'
                                                )
                                            ),
                                            array(
                                                'title' => 'JavaScript Complete Guide',
                                                'description' => 'From basics to advanced concepts, master JavaScript programming. Covers ES6+, async programming, DOM manipulation, and modern development patterns.',
                                                'price' => '$297',
                                                'icon' => '⚡',
                                                'features' => array(
                                                    '60+ hours of content',
                                                    '25 practical exercises',
                                                    'Advanced JavaScript concepts',
                                                    'Framework-agnostic approach',
                                                    'Industry best practices'
                                                )
                                            ),
                                            array(
                                                'title' => 'Bootstrap Component Library',
                                                'description' => 'Ready-to-use Bootstrap components and templates for rapid development. Save hours of development time with professionally designed components.',
                                                'price' => '$97',
                                                'icon' => '🔧',
                                                'features' => array(
                                                    '100+ components',
                                                    '10 complete templates',
                                                    'Sass source files',
                                                    'Documentation included',
                                                    'Regular updates'
                                                )
                                            ),
                                            array(
                                                'title' => 'CSS Grid & Flexbox Mastery',
                                                'description' => 'Master modern CSS layout systems. Learn CSS Grid and Flexbox from fundamentals to advanced techniques with practical examples.',
                                                'price' => '$127',
                                                'icon' => '🎨',
                                                'features' => array(
                                                    '20+ hours of training',
                                                    '12 layout projects',
                                                    'Responsive design patterns',
                                                    'Browser compatibility guide',
                                                    'Cheat sheets included'
                                                )
                                            ),
                                            array(
                                                'title' => 'Responsive Design Patterns',
                                                'description' => 'Learn to create websites that work perfectly on all devices. Master responsive design principles and mobile-first development.',
                                                'price' => '$147',
                                                'icon' => '📱',
                                                'features' => array(
                                                    '30+ responsive patterns',
                                                    'Mobile-first approach',
                                                    'Performance optimization',
                                                    'Cross-browser testing',
                                                    'Accessibility guidelines'
                                                )
                                            ),
                                            array(
                                                'title' => 'Web Performance Optimization',
                                                'description' => 'Speed up your websites and improve user experience. Learn optimization techniques, tools, and best practices for fast-loading sites.',
                                                'price' => '$167',
                                                'icon' => '🚀',
                                                'features' => array(
                                                    'Performance auditing tools',
                                                    'Image optimization techniques',
                                                    'Code splitting strategies',
                                                    'CDN implementation',
                                                    'Core Web Vitals optimization'
                                                )
                                            )
                                        );

                                        foreach ($sample_products as $product) :
                                        ?>
                                            <div class="product-card fade-in" style="position: relative;">
                                                <div class="product-icon"><?php echo esc_html($product['icon']); ?></div>
                                                <h3><?php echo esc_html($product['title']); ?></h3>
                                                <div class="product-excerpt">
                                                    <p><?php echo esc_html($product['description']); ?></p>
                                                    
                                                    <div style="margin: 1.5rem 0;">
                                                        <h4 style="font-size: 1rem; margin-bottom: 0.5rem;"><?php esc_html_e('What\'s included:', 'creative-newsletter-pro'); ?></h4>
                                                        <ul style="text-align: left; font-size: 0.875rem; color: #64748b;">
                                                            <?php foreach ($product['features'] as $feature) : ?>
                                                                <li style="margin: 0.25rem 0;">✓ <?php echo esc_html($feature); ?></li>
                                                            <?php endforeach; ?>
                                                        </ul>
                                                    </div>
                                                </div>
                                                
                                                <div class="product-price"><?php echo esc_html($product['price']); ?></div>
                                                
                                                <button class="btn btn-primary" style="position: relative; overflow: hidden;" 
                                                        onclick="this.innerHTML = 'Coming Soon'; this.style.background = '#64748b';">
                                                    <?php esc_html_e('Pre-order Now', 'creative-newsletter-pro'); ?>
                                                </button>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                <?php endif; ?>
                            </section>

                            <!-- Value Proposition -->
                            <section style="background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%); color: white; padding: 3rem; border-radius: 12px; text-align: center; margin: 3rem 0;">
                                <h2 style="color: white; margin-bottom: 1rem;"><?php esc_html_e('Why Choose Our Products?', 'creative-newsletter-pro'); ?></h2>
                                <p style="margin-bottom: 2rem; opacity: 0.9; max-width: 600px; margin-left: auto; margin-right: auto;">
                                    <?php esc_html_e('All our products are created by experienced developers and are designed to help you accelerate your learning and advance your career.', 'creative-newsletter-pro'); ?>
                                </p>
                                
                                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 2rem; margin-top: 2rem;">
                                    <div>
                                        <div style="font-size: 2rem; margin-bottom: 0.5rem;">🎯</div>
                                        <h3 style="color: white; font-size: 1.125rem;"><?php esc_html_e('Practical Focus', 'creative-newsletter-pro'); ?></h3>
                                        <p style="opacity: 0.9; font-size: 0.875rem;"><?php esc_html_e('Real-world projects and examples', 'creative-newsletter-pro'); ?></p>
                                    </div>
                                    
                                    <div>
                                        <div style="font-size: 2rem; margin-bottom: 0.5rem;">📈</div>
                                        <h3 style="color: white; font-size: 1.125rem;"><?php esc_html_e('Career Growth', 'creative-newsletter-pro'); ?></h3>
                                        <p style="opacity: 0.9; font-size: 0.875rem;"><?php esc_html_e('Skills that advance your career', 'creative-newsletter-pro'); ?></p>
                                    </div>
                                    
                                    <div>
                                        <div style="font-size: 2rem; margin-bottom: 0.5rem;">🔄</div>
                                        <h3 style="color: white; font-size: 1.125rem;"><?php esc_html_e('Regular Updates', 'creative-newsletter-pro'); ?></h3>
                                        <p style="opacity: 0.9; font-size: 0.875rem;"><?php esc_html_e('Content updated with latest trends', 'creative-newsletter-pro'); ?></p>
                                    </div>
                                    
                                    <div>
                                        <div style="font-size: 2rem; margin-bottom: 0.5rem;">💬</div>
                                        <h3 style="color: white; font-size: 1.125rem;"><?php esc_html_e('Support Included', 'creative-newsletter-pro'); ?></h3>
                                        <p style="opacity: 0.9; font-size: 0.875rem;"><?php esc_html_e('Get help when you need it', 'creative-newsletter-pro'); ?></p>
                                    </div>
                                </div>
                            </section>

                            <!-- Testimonials Section -->
                            <section style="background: #f8fafc; padding: 3rem; border-radius: 12px; margin: 3rem 0;">
                                <h2 style="text-align: center; margin-bottom: 2rem;"><?php esc_html_e('What Students Say', 'creative-newsletter-pro'); ?></h2>
                                
                                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 2rem;">
                                    <div style="background: white; padding: 2rem; border-radius: 8px; border-left: 4px solid #6366f1;">
                                        <p style="font-style: italic; margin-bottom: 1rem;">
                                            "<?php esc_html_e('Ranvijay\'s courses are incredibly detailed and practical. I went from beginner to landing my first web dev job in just 6 months!', 'creative-newsletter-pro'); ?>"
                                        </p>
                                        <div style="display: flex; align-items: center;">
                                            <div style="width: 40px; height: 40px; background: #6366f1; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; margin-right: 1rem;">
                                                A
                                            </div>
                                            <div>
                                                <strong><?php esc_html_e('Alex Johnson', 'creative-newsletter-pro'); ?></strong><br>
                                                <small style="color: #64748b;"><?php esc_html_e('Junior Developer', 'creative-newsletter-pro'); ?></small>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div style="background: white; padding: 2rem; border-radius: 8px; border-left: 4px solid #8b5cf6;">
                                        <p style="font-style: italic; margin-bottom: 1rem;">
                                            "<?php esc_html_e('The Bootstrap component library saved me weeks of development time. Highly recommend for any developer!', 'creative-newsletter-pro'); ?>"
                                        </p>
                                        <div style="display: flex; align-items: center;">
                                            <div style="width: 40px; height: 40px; background: #8b5cf6; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; margin-right: 1rem;">
                                                S
                                            </div>
                                            <div>
                                                <strong><?php esc_html_e('Sarah Chen', 'creative-newsletter-pro'); ?></strong><br>
                                                <small style="color: #64748b;"><?php esc_html_e('Freelance Designer', 'creative-newsletter-pro'); ?></small>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div style="background: white; padding: 2rem; border-radius: 8px; border-left: 4px solid #3b82f6;">
                                        <p style="font-style: italic; margin-bottom: 1rem;">
                                            "<?php esc_html_e('Clear explanations, great examples, and excellent support. These products are worth every penny!', 'creative-newsletter-pro'); ?>"
                                        </p>
                                        <div style="display: flex; align-items: center;">
                                            <div style="width: 40px; height: 40px; background: #3b82f6; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; margin-right: 1rem;">
                                                M
                                            </div>
                                            <div>
                                                <strong><?php esc_html_e('Mike Rodriguez', 'creative-newsletter-pro'); ?></strong><br>
                                                <small style="color: #64748b;"><?php esc_html_e('Senior Developer', 'creative-newsletter-pro'); ?></small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>

                            <!-- CTA Section -->
                            <section style="text-align: center; margin: 3rem 0;">
                                <h2><?php esc_html_e('Ready to Level Up Your Skills?', 'creative-newsletter-pro'); ?></h2>
                                <p style="margin-bottom: 2rem; color: #64748b;">
                                    <?php esc_html_e('Join thousands of developers who have already transformed their careers with our products.', 'creative-newsletter-pro'); ?>
                                </p>
                                
                                <div style="display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap;">
                                    <a href="#newsletter" class="btn btn-primary">
                                        <?php esc_html_e('Join Newsletter First', 'creative-newsletter-pro'); ?>
                                    </a>
                                    <a href="mailto:hello@ranvijaysingh.com" class="btn btn-secondary">
                                        <?php esc_html_e('Ask Questions', 'creative-newsletter-pro'); ?>
                                    </a>
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