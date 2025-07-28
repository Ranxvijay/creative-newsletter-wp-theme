<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 *
 * @package Creative_Newsletter_Pro
 */

get_header();
?>

<?php if (is_home() && is_front_page()) : ?>
    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <div class="hero-content fade-in">
                <h1 class="hero-title">
                    <?php echo esc_html(get_theme_mod('hero_title', 'Welcome to Creative Newsletter Pro')); ?>
                </h1>
                <p class="hero-subtitle">
                    <?php echo esc_html(get_theme_mod('hero_subtitle', 'Create amazing newsletters and sell digital products with this modern WordPress theme')); ?>
                </p>
                <div class="hero-buttons">
                    <a href="#newsletter" class="btn btn-primary"><?php esc_html_e('Join Newsletter', 'creative-newsletter-pro'); ?></a>
                    <a href="#products" class="btn btn-secondary"><?php esc_html_e('View Products', 'creative-newsletter-pro'); ?></a>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="stats-section">
        <div class="container">
            <div class="stats-grid fade-in">
                <div class="stat-item">
                    <span class="stat-number">2,500+</span>
                    <span class="stat-label"><?php esc_html_e('Newsletter Subscribers', 'creative-newsletter-pro'); ?></span>
                </div>
                <div class="stat-item">
                    <span class="stat-number">150+</span>
                    <span class="stat-label"><?php esc_html_e('Articles Published', 'creative-newsletter-pro'); ?></span>
                </div>
                <div class="stat-item">
                    <span class="stat-number">5</span>
                    <span class="stat-label"><?php esc_html_e('Digital Products', 'creative-newsletter-pro'); ?></span>
                </div>
                <div class="stat-item">
                    <span class="stat-number">98%</span>
                    <span class="stat-label"><?php esc_html_e('Satisfaction Rate', 'creative-newsletter-pro'); ?></span>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features-section">
        <div class="container">
            <div class="section-header text-center fade-in">
                <h2><?php esc_html_e('Why Choose Our Platform?', 'creative-newsletter-pro'); ?></h2>
                <p><?php esc_html_e('Everything you need to create, grow, and monetize your newsletter audience.', 'creative-newsletter-pro'); ?></p>
            </div>
            
            <div class="features-grid">
                <div class="feature-item fade-in">
                    <div class="feature-icon">📧</div>
                    <h3><?php esc_html_e('Newsletter Management', 'creative-newsletter-pro'); ?></h3>
                    <p><?php esc_html_e('Create and manage beautiful newsletters with our easy-to-use editor and automation tools.', 'creative-newsletter-pro'); ?></p>
                </div>
                
                <div class="feature-item fade-in">
                    <div class="feature-icon">💰</div>
                    <h3><?php esc_html_e('Digital Products', 'creative-newsletter-pro'); ?></h3>
                    <p><?php esc_html_e('Sell courses, ebooks, and digital downloads directly to your audience with integrated commerce.', 'creative-newsletter-pro'); ?></p>
                </div>
                
                <div class="feature-item fade-in">
                    <div class="feature-icon">📊</div>
                    <h3><?php esc_html_e('Analytics & Insights', 'creative-newsletter-pro'); ?></h3>
                    <p><?php esc_html_e('Track performance, understand your audience, and optimize your content strategy.', 'creative-newsletter-pro'); ?></p>
                </div>
                
                <div class="feature-item fade-in">
                    <div class="feature-icon">🎨</div>
                    <h3><?php esc_html_e('Beautiful Design', 'creative-newsletter-pro'); ?></h3>
                    <p><?php esc_html_e('Modern, responsive design that looks great on all devices and reflects your brand.', 'creative-newsletter-pro'); ?></p>
                </div>
                
                <div class="feature-item fade-in">
                    <div class="feature-icon">⚡</div>
                    <h3><?php esc_html_e('Fast Performance', 'creative-newsletter-pro'); ?></h3>
                    <p><?php esc_html_e('Optimized for speed and SEO to ensure your content reaches the widest audience.', 'creative-newsletter-pro'); ?></p>
                </div>
                
                <div class="feature-item fade-in">
                    <div class="feature-icon">🚀</div>
                    <h3><?php esc_html_e('Growth Tools', 'creative-newsletter-pro'); ?></h3>
                    <p><?php esc_html_e('Built-in tools to help you grow your subscriber base and increase engagement.', 'creative-newsletter-pro'); ?></p>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Articles Section -->
    <section class="articles-section">
        <div class="container">
            <div class="section-header text-center fade-in">
                <h2><?php esc_html_e('Latest Articles', 'creative-newsletter-pro'); ?></h2>
                <p><?php esc_html_e('Insights on web development, design, and building digital products.', 'creative-newsletter-pro'); ?></p>
            </div>
            
            <div class="articles-grid">
                <?php
                // Sample articles data (in a real implementation, this would come from actual posts)
                $sample_articles = array(
                    array(
                        'title' => 'The Ultimate Guide to Newsletter Growth',
                        'excerpt' => 'Learn proven strategies to grow your newsletter from 0 to 10,000 subscribers in just 6 months.',
                        'date' => '2025-01-15',
                        'icon' => '📈'
                    ),
                    array(
                        'title' => 'Building Digital Products That Actually Sell',
                        'excerpt' => 'Discover the secrets to creating digital products that your audience will love and buy.',
                        'date' => '2025-01-10',
                        'icon' => '💼'
                    ),
                    array(
                        'title' => 'Modern Web Development with HTML5 & CSS3',
                        'excerpt' => 'Master the latest web technologies and create stunning, responsive websites.',
                        'date' => '2025-01-05',
                        'icon' => '💻'
                    ),
                    array(
                        'title' => 'JavaScript Best Practices for Beginners',
                        'excerpt' => 'Essential JavaScript concepts and best practices every developer should know.',
                        'date' => '2024-12-28',
                        'icon' => '⚡'
                    ),
                    array(
                        'title' => 'Bootstrap Framework Mastery',
                        'excerpt' => 'Build responsive websites faster with Bootstrap components and utilities.',
                        'date' => '2024-12-20',
                        'icon' => '🎨'
                    ),
                    array(
                        'title' => 'Personal Branding for Developers',
                        'excerpt' => 'Stand out in the tech industry by building a strong personal brand.',
                        'date' => '2024-12-15',
                        'icon' => '🌟'
                    )
                );

                foreach ($sample_articles as $article) :
                ?>
                    <article class="article-card fade-in">
                        <div class="article-image">
                            <?php echo esc_html($article['icon']); ?>
                        </div>
                        <div class="article-content">
                            <h3 class="article-title"><?php echo esc_html($article['title']); ?></h3>
                            <p class="article-excerpt"><?php echo esc_html($article['excerpt']); ?></p>
                            <div class="article-meta">
                                <span class="article-date"><?php echo esc_html(date('M j, Y', strtotime($article['date']))); ?></span>
                            </div>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>
            
            <div class="text-center" style="margin-top: 3rem;">
                <a href="<?php echo esc_url(home_url('/blog')); ?>" class="btn btn-primary">
                    <?php esc_html_e('View All Articles', 'creative-newsletter-pro'); ?>
                </a>
            </div>
        </div>
    </section>

    <!-- Newsletter Signup Section -->
    <section id="newsletter" class="newsletter-section">
        <div class="container">
            <div class="text-center fade-in">
                <h2><?php echo esc_html(get_theme_mod('newsletter_title', 'Join Our Newsletter')); ?></h2>
                <p><?php echo esc_html(get_theme_mod('newsletter_description', 'Get weekly insights on web development, design, and digital products.')); ?></p>
                
                <form class="newsletter-form" id="newsletter-signup-form">
                    <input type="email" name="email" placeholder="<?php esc_attr_e('Enter your email address', 'creative-newsletter-pro'); ?>" required>
                    <button type="submit"><?php esc_html_e('Subscribe', 'creative-newsletter-pro'); ?></button>
                </form>
                
                <div id="newsletter-message" style="margin-top: 1rem;"></div>
            </div>
        </div>
    </section>

    <!-- Products Section -->
    <section id="products" class="products-section">
        <div class="container">
            <div class="section-header text-center fade-in">
                <h2><?php esc_html_e('Digital Products', 'creative-newsletter-pro'); ?></h2>
                <p><?php esc_html_e('Premium courses and resources to accelerate your learning.', 'creative-newsletter-pro'); ?></p>
            </div>
            
            <div class="products-grid">
                <?php
                // Sample products data
                $sample_products = array(
                    array(
                        'title' => 'Web Development Mastery Course',
                        'description' => 'Complete course covering HTML, CSS, JavaScript, and modern frameworks.',
                        'price' => '$197',
                        'icon' => '🎓'
                    ),
                    array(
                        'title' => 'JavaScript Complete Guide',
                        'description' => 'From basics to advanced concepts, master JavaScript programming.',
                        'price' => '$297',
                        'icon' => '📚'
                    ),
                    array(
                        'title' => 'Bootstrap Component Library',
                        'description' => 'Ready-to-use Bootstrap components and templates for rapid development.',
                        'price' => '$97',
                        'icon' => '🔧'
                    )
                );

                foreach ($sample_products as $product) :
                ?>
                    <div class="product-card fade-in">
                        <div class="product-icon"><?php echo esc_html($product['icon']); ?></div>
                        <h3><?php echo esc_html($product['title']); ?></h3>
                        <p><?php echo esc_html($product['description']); ?></p>
                        <div class="product-price"><?php echo esc_html($product['price']); ?></div>
                        <a href="#" class="btn btn-primary"><?php esc_html_e('Learn More', 'creative-newsletter-pro'); ?></a>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section class="about-section">
        <div class="container">
            <div class="about-content fade-in">
                <div class="about-image">
                    👨‍💻
                </div>
                <div class="about-text">
                    <h2><?php esc_html_e('About Ranvijay Singh', 'creative-newsletter-pro'); ?></h2>
                    <p><?php esc_html_e('Web developer from Canada with expertise in HTML, CSS, JavaScript, and Bootstrap. Passionate about creating beautiful, functional websites and sharing knowledge through newsletters and digital products.', 'creative-newsletter-pro'); ?></p>
                    <p><?php esc_html_e('With years of experience in web development, I help creators and entrepreneurs build their online presence and grow their digital businesses.', 'creative-newsletter-pro'); ?></p>
                    <a href="https://ranvijaysingh.com" target="_blank" rel="noopener" class="btn btn-primary">
                        <?php esc_html_e('Visit My Website', 'creative-newsletter-pro'); ?>
                    </a>
                </div>
            </div>
        </div>
    </section>

<?php else : ?>
    <!-- Standard blog listing for non-homepage -->
    <div class="content-area">
        <div class="container">
            <div class="main-content">
                <main id="main" class="site-main">
                    <?php creative_newsletter_breadcrumbs(); ?>
                    
                    <?php if (have_posts()) : ?>
                        <div class="posts-grid">
                            <?php while (have_posts()) : ?>
                                <?php the_post(); ?>
                                <article id="post-<?php the_ID(); ?>" <?php post_class('post-card'); ?>>
                                    <?php if (has_post_thumbnail()) : ?>
                                        <div class="post-thumbnail">
                                            <a href="<?php the_permalink(); ?>">
                                                <?php the_post_thumbnail('medium'); ?>
                                            </a>
                                        </div>
                                    <?php endif; ?>
                                    
                                    <div class="post-content">
                                        <header class="entry-header">
                                            <h2 class="entry-title">
                                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                            </h2>
                                            <div class="entry-meta">
                                                <span class="posted-on"><?php echo get_the_date(); ?></span>
                                                <span class="byline"><?php esc_html_e('by', 'creative-newsletter-pro'); ?> <?php the_author(); ?></span>
                                            </div>
                                        </header>
                                        
                                        <div class="entry-summary">
                                            <?php the_excerpt(); ?>
                                        </div>
                                        
                                        <footer class="entry-footer">
                                            <a href="<?php the_permalink(); ?>" class="read-more">
                                                <?php esc_html_e('Read More', 'creative-newsletter-pro'); ?>
                                            </a>
                                        </footer>
                                    </div>
                                </article>
                            <?php endwhile; ?>
                        </div>
                        
                        <?php creative_newsletter_pagination(); ?>
                        
                    <?php else : ?>
                        <p><?php esc_html_e('No posts found.', 'creative-newsletter-pro'); ?></p>
                    <?php endif; ?>
                </main>
                
                <?php get_sidebar(); ?>
            </div>
        </div>
    </div>
<?php endif; ?>

<?php
get_footer();