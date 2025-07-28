<?php
/**
 * Template Name: Contact Page
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
                                <?php esc_html_e('Let\'s connect and discuss how we can work together', 'creative-newsletter-pro'); ?>
                            </p>
                        </header><!-- .entry-header -->

                        <div class="entry-content">
                            <!-- Contact Hero -->
                            <section style="text-align: center; padding: 2rem 0;">
                                <div style="font-size: 4rem; margin-bottom: 1rem;">💬</div>
                                <h2><?php esc_html_e('Get In Touch', 'creative-newsletter-pro'); ?></h2>
                                <p style="color: #64748b; max-width: 600px; margin: 0 auto;">
                                    <?php esc_html_e('Whether you have a project in mind, need web development advice, or just want to say hello, I\'d love to hear from you. Let\'s create something amazing together!', 'creative-newsletter-pro'); ?>
                                </p>
                            </section>

                            <!-- Contact Methods -->
                            <section style="margin: 3rem 0;">
                                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 2rem;">
                                    <div style="background: white; padding: 2rem; border-radius: 12px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05); text-align: center; border: 1px solid #e2e8f0;">
                                        <div style="width: 60px; height: 60px; background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1rem; color: white; font-size: 1.5rem;">
                                            📧
                                        </div>
                                        <h3><?php esc_html_e('Email Me', 'creative-newsletter-pro'); ?></h3>
                                        <p style="color: #64748b; margin-bottom: 1rem;">
                                            <?php esc_html_e('For project inquiries and general questions', 'creative-newsletter-pro'); ?>
                                        </p>
                                        <a href="mailto:hello@ranvijaysingh.com" class="btn btn-primary">
                                            <?php esc_html_e('hello@ranvijaysingh.com', 'creative-newsletter-pro'); ?>
                                        </a>
                                    </div>

                                    <div style="background: white; padding: 2rem; border-radius: 12px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05); text-align: center; border: 1px solid #e2e8f0;">
                                        <div style="width: 60px; height: 60px; background: linear-gradient(135deg, #8b5cf6 0%, #6366f1 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1rem; color: white; font-size: 1.5rem;">
                                            🌐
                                        </div>
                                        <h3><?php esc_html_e('Visit My Website', 'creative-newsletter-pro'); ?></h3>
                                        <p style="color: #64748b; margin-bottom: 1rem;">
                                            <?php esc_html_e('Check out my portfolio and other projects', 'creative-newsletter-pro'); ?>
                                        </p>
                                        <a href="https://ranvijaysingh.com" target="_blank" rel="noopener" class="btn btn-secondary">
                                            <?php esc_html_e('ranvijaysingh.com', 'creative-newsletter-pro'); ?>
                                        </a>
                                    </div>

                                    <div style="background: white; padding: 2rem; border-radius: 12px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05); text-align: center; border: 1px solid #e2e8f0;">
                                        <div style="width: 60px; height: 60px; background: linear-gradient(135deg, #3b82f6 0%, #6366f1 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1rem; color: white; font-size: 1.5rem;">
                                            🔗
                                        </div>
                                        <h3><?php esc_html_e('Social Media', 'creative-newsletter-pro'); ?></h3>
                                        <p style="color: #64748b; margin-bottom: 1rem;">
                                            <?php esc_html_e('Connect with me on social platforms', 'creative-newsletter-pro'); ?>
                                        </p>
                                        <div style="margin-top: 1rem;">
                                            <?php creative_newsletter_social_links(); ?>
                                        </div>
                                    </div>
                                </div>
                            </section>

                            <!-- Contact Form -->
                            <section style="background: #f8fafc; padding: 3rem; border-radius: 12px; margin: 3rem 0;">
                                <div style="max-width: 600px; margin: 0 auto;">
                                    <h2 style="text-align: center; margin-bottom: 2rem;"><?php esc_html_e('Send a Message', 'creative-newsletter-pro'); ?></h2>
                                    
                                    <form id="contact-form" style="display: grid; gap: 1.5rem;">
                                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                                            <div>
                                                <label for="contact-name" style="display: block; margin-bottom: 0.5rem; font-weight: 600;">
                                                    <?php esc_html_e('Your Name', 'creative-newsletter-pro'); ?> *
                                                </label>
                                                <input type="text" id="contact-name" name="name" required 
                                                       style="width: 100%; padding: 12px; border: 1px solid #d1d5db; border-radius: 6px; font-size: 1rem;">
                                            </div>
                                            <div>
                                                <label for="contact-email" style="display: block; margin-bottom: 0.5rem; font-weight: 600;">
                                                    <?php esc_html_e('Email Address', 'creative-newsletter-pro'); ?> *
                                                </label>
                                                <input type="email" id="contact-email" name="email" required 
                                                       style="width: 100%; padding: 12px; border: 1px solid #d1d5db; border-radius: 6px; font-size: 1rem;">
                                            </div>
                                        </div>
                                        
                                        <div>
                                            <label for="contact-subject" style="display: block; margin-bottom: 0.5rem; font-weight: 600;">
                                                <?php esc_html_e('Subject', 'creative-newsletter-pro'); ?> *
                                            </label>
                                            <input type="text" id="contact-subject" name="subject" required 
                                                   style="width: 100%; padding: 12px; border: 1px solid #d1d5db; border-radius: 6px; font-size: 1rem;">
                                        </div>
                                        
                                        <div>
                                            <label for="contact-project-type" style="display: block; margin-bottom: 0.5rem; font-weight: 600;">
                                                <?php esc_html_e('Project Type', 'creative-newsletter-pro'); ?>
                                            </label>
                                            <select id="contact-project-type" name="project_type" 
                                                    style="width: 100%; padding: 12px; border: 1px solid #d1d5db; border-radius: 6px; font-size: 1rem;">
                                                <option value=""><?php esc_html_e('Select project type (optional)', 'creative-newsletter-pro'); ?></option>
                                                <option value="website-development"><?php esc_html_e('Website Development', 'creative-newsletter-pro'); ?></option>
                                                <option value="consultation"><?php esc_html_e('Technical Consultation', 'creative-newsletter-pro'); ?></option>
                                                <option value="training"><?php esc_html_e('Training/Mentoring', 'creative-newsletter-pro'); ?></option>
                                                <option value="collaboration"><?php esc_html_e('Collaboration', 'creative-newsletter-pro'); ?></option>
                                                <option value="other"><?php esc_html_e('Other', 'creative-newsletter-pro'); ?></option>
                                            </select>
                                        </div>
                                        
                                        <div>
                                            <label for="contact-message" style="display: block; margin-bottom: 0.5rem; font-weight: 600;">
                                                <?php esc_html_e('Message', 'creative-newsletter-pro'); ?> *
                                            </label>
                                            <textarea id="contact-message" name="message" rows="6" required 
                                                      placeholder="<?php esc_attr_e('Tell me about your project, questions, or how I can help you...', 'creative-newsletter-pro'); ?>"
                                                      style="width: 100%; padding: 12px; border: 1px solid #d1d5db; border-radius: 6px; font-size: 1rem; resize: vertical;"></textarea>
                                        </div>
                                        
                                        <div style="text-align: center;">
                                            <button type="submit" class="btn btn-primary" style="padding: 12px 32px;">
                                                <?php esc_html_e('Send Message', 'creative-newsletter-pro'); ?>
                                            </button>
                                        </div>
                                        
                                        <div id="contact-form-message" style="text-align: center; margin-top: 1rem;"></div>
                                    </form>
                                </div>
                            </section>

                            <!-- FAQ Section -->
                            <section style="margin: 3rem 0;">
                                <h2 style="text-align: center; margin-bottom: 2rem;"><?php esc_html_e('Frequently Asked Questions', 'creative-newsletter-pro'); ?></h2>
                                
                                <div style="max-width: 800px; margin: 0 auto;">
                                    <div style="background: white; border-radius: 12px; border: 1px solid #e2e8f0; overflow: hidden;">
                                        <div style="padding: 1.5rem; border-bottom: 1px solid #e2e8f0;">
                                            <h3 style="margin-bottom: 0.5rem; color: #6366f1;"><?php esc_html_e('What services do you offer?', 'creative-newsletter-pro'); ?></h3>
                                            <p style="margin: 0; color: #64748b;">
                                                <?php esc_html_e('I offer web development services including custom website development, responsive design, HTML/CSS/JavaScript development, Bootstrap integration, and technical consultation.', 'creative-newsletter-pro'); ?>
                                            </p>
                                        </div>
                                        
                                        <div style="padding: 1.5rem; border-bottom: 1px solid #e2e8f0;">
                                            <h3 style="margin-bottom: 0.5rem; color: #6366f1;"><?php esc_html_e('How long does a typical project take?', 'creative-newsletter-pro'); ?></h3>
                                            <p style="margin: 0; color: #64748b;">
                                                <?php esc_html_e('Project timelines vary depending on complexity. Simple websites can take 1-2 weeks, while more complex projects may take 4-8 weeks. I\'ll provide a detailed timeline during our initial consultation.', 'creative-newsletter-pro'); ?>
                                            </p>
                                        </div>
                                        
                                        <div style="padding: 1.5rem; border-bottom: 1px solid #e2e8f0;">
                                            <h3 style="margin-bottom: 0.5rem; color: #6366f1;"><?php esc_html_e('Do you offer ongoing support?', 'creative-newsletter-pro'); ?></h3>
                                            <p style="margin: 0; color: #64748b;">
                                                <?php esc_html_e('Yes! I provide ongoing support and maintenance packages to keep your website running smoothly. This includes updates, bug fixes, and technical support.', 'creative-newsletter-pro'); ?>
                                            </p>
                                        </div>
                                        
                                        <div style="padding: 1.5rem; border-bottom: 1px solid #e2e8f0;">
                                            <h3 style="margin-bottom: 0.5rem; color: #6366f1;"><?php esc_html_e('What\'s your development process?', 'creative-newsletter-pro'); ?></h3>
                                            <p style="margin: 0; color: #64748b;">
                                                <?php esc_html_e('I follow a structured process: 1) Discovery and planning, 2) Design and wireframing, 3) Development and testing, 4) Review and revisions, 5) Launch and optimization. You\'ll be involved throughout the process.', 'creative-newsletter-pro'); ?>
                                            </p>
                                        </div>
                                        
                                        <div style="padding: 1.5rem;">
                                            <h3 style="margin-bottom: 0.5rem; color: #6366f1;"><?php esc_html_e('How much do projects typically cost?', 'creative-newsletter-pro'); ?></h3>
                                            <p style="margin: 0; color: #64748b;">
                                                <?php esc_html_e('Project costs vary based on scope and requirements. I offer competitive rates and will provide a detailed quote after our initial consultation. Contact me to discuss your specific needs.', 'creative-newsletter-pro'); ?>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </section>

                            <!-- Location & Availability -->
                            <section style="background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%); color: white; padding: 3rem; border-radius: 12px; text-align: center; margin: 3rem 0;">
                                <h2 style="color: white; margin-bottom: 1rem;"><?php esc_html_e('Based in Canada', 'creative-newsletter-pro'); ?></h2>
                                <p style="margin-bottom: 2rem; opacity: 0.9;">
                                    <?php esc_html_e('I\'m located in Canada and work with clients worldwide. I\'m available for both local and remote projects across different time zones.', 'creative-newsletter-pro'); ?>
                                </p>
                                
                                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 2rem;">
                                    <div>
                                        <div style="font-size: 2rem; margin-bottom: 0.5rem;">🇨🇦</div>
                                        <h3 style="color: white; font-size: 1.125rem;"><?php esc_html_e('Local Projects', 'creative-newsletter-pro'); ?></h3>
                                        <p style="opacity: 0.9; font-size: 0.875rem;"><?php esc_html_e('Available for on-site meetings in Canada', 'creative-newsletter-pro'); ?></p>
                                    </div>
                                    
                                    <div>
                                        <div style="font-size: 2rem; margin-bottom: 0.5rem;">🌍</div>
                                        <h3 style="color: white; font-size: 1.125rem;"><?php esc_html_e('Remote Work', 'creative-newsletter-pro'); ?></h3>
                                        <p style="opacity: 0.9; font-size: 0.875rem;"><?php esc_html_e('Working with clients worldwide', 'creative-newsletter-pro'); ?></p>
                                    </div>
                                    
                                    <div>
                                        <div style="font-size: 2rem; margin-bottom: 0.5rem;">⏰</div>
                                        <h3 style="color: white; font-size: 1.125rem;"><?php esc_html_e('Flexible Hours', 'creative-newsletter-pro'); ?></h3>
                                        <p style="opacity: 0.9; font-size: 0.875rem;"><?php esc_html_e('Accommodating different time zones', 'creative-newsletter-pro'); ?></p>
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