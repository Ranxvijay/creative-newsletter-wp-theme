/**
 * Creative Newsletter Pro - Main JavaScript
 * 
 * @package Creative_Newsletter_Pro
 * @since 1.0.0
 */

(function($) {
    'use strict';

    // Document ready
    $(document).ready(function() {
        initMobileMenu();
        initSmoothScroll();
        initAnimations();
        initNewsletterForm();
        initContactForm();
        initBackToTop();
        initHeaderScroll();
    });

    /**
     * Initialize mobile menu
     */
    function initMobileMenu() {
        $('.mobile-menu-toggle').on('click', function() {
            const $nav = $('.main-nav');
            const $toggle = $(this);
            
            $nav.slideToggle(300);
            $toggle.toggleClass('active');
            
            // Update aria-expanded attribute
            const expanded = $toggle.attr('aria-expanded') === 'true';
            $toggle.attr('aria-expanded', !expanded);
        });

        // Close mobile menu when clicking on a link
        $('.main-nav a').on('click', function() {
            if ($(window).width() <= 768) {
                $('.main-nav').slideUp(300);
                $('.mobile-menu-toggle').removeClass('active').attr('aria-expanded', 'false');
            }
        });

        // Close mobile menu when resizing window
        $(window).on('resize', function() {
            if ($(window).width() > 768) {
                $('.main-nav').removeAttr('style');
                $('.mobile-menu-toggle').removeClass('active').attr('aria-expanded', 'false');
            }
        });
    }

    /**
     * Initialize smooth scrolling
     */
    function initSmoothScroll() {
        $('a[href*="#"]').not('[href="#"]').not('[href="#0"]').click(function(event) {
            if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
                let target = $(this.hash);
                target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
                
                if (target.length) {
                    event.preventDefault();
                    
                    $('html, body').animate({
                        scrollTop: target.offset().top - 80 // Account for fixed header
                    }, 800, 'swing');
                }
            }
        });
    }

    /**
     * Initialize scroll animations
     */
    function initAnimations() {
        // Intersection Observer for fade-in animations
        if ('IntersectionObserver' in window) {
            const observer = new IntersectionObserver(function(entries) {
                entries.forEach(function(entry) {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('visible');
                        observer.unobserve(entry.target);
                    }
                });
            }, {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            });

            // Observe all fade-in elements
            document.querySelectorAll('.fade-in, .slide-in-left, .slide-in-right').forEach(function(el) {
                observer.observe(el);
            });
        } else {
            // Fallback for browsers without Intersection Observer
            $('.fade-in, .slide-in-left, .slide-in-right').addClass('visible');
        }

        // Animate stats on scroll
        animateStats();
    }

    /**
     * Animate statistics numbers
     */
    function animateStats() {
        const $stats = $('.stat-number');
        let animated = false;

        function animateNumber($element) {
            const finalNumber = $element.text().replace(/[^\d]/g, '');
            const duration = 2000;
            const step = finalNumber / (duration / 16);
            let current = 0;

            const timer = setInterval(function() {
                current += step;
                if (current >= finalNumber) {
                    current = finalNumber;
                    clearInterval(timer);
                }
                
                $element.text(formatNumber(Math.floor(current)) + '+');
            }, 16);
        }

        function formatNumber(num) {
            if (num >= 1000) {
                return (num / 1000).toFixed(1) + 'k';
            }
            return num.toString();
        }

        $(window).on('scroll', function() {
            if (!animated && $stats.length) {
                const $firstStat = $stats.first();
                const scrollTop = $(window).scrollTop();
                const elementTop = $firstStat.offset().top;
                const windowHeight = $(window).height();

                if (scrollTop + windowHeight > elementTop + 100) {
                    animated = true;
                    $stats.each(function() {
                        animateNumber($(this));
                    });
                }
            }
        });
    }

    /**
     * Initialize newsletter signup form
     */
    function initNewsletterForm() {
        $('#newsletter-signup-form').on('submit', function(e) {
            e.preventDefault();
            
            const $form = $(this);
            const $button = $form.find('button[type="submit"]');
            const $message = $('#newsletter-message');
            const email = $form.find('input[name="email"]').val();

            // Basic validation
            if (!isValidEmail(email)) {
                showMessage($message, 'Please enter a valid email address.', 'error');
                return;
            }

            // Show loading state
            const originalText = $button.text();
            $button.text('Subscribing...').prop('disabled', true);

            // AJAX request
            $.ajax({
                url: creative_newsletter_ajax.ajax_url,
                type: 'POST',
                data: {
                    action: 'newsletter_signup',
                    email: email,
                    nonce: creative_newsletter_ajax.nonce
                },
                success: function(response) {
                    const data = JSON.parse(response);
                    if (data.success) {
                        showMessage($message, data.message, 'success');
                        $form[0].reset();
                    } else {
                        showMessage($message, data.message, 'error');
                    }
                },
                error: function() {
                    showMessage($message, 'Something went wrong. Please try again.', 'error');
                },
                complete: function() {
                    $button.text(originalText).prop('disabled', false);
                }
            });
        });
    }

    /**
     * Initialize contact form
     */
    function initContactForm() {
        $('#contact-form').on('submit', function(e) {
            e.preventDefault();
            
            const $form = $(this);
            const $button = $form.find('button[type="submit"]');
            const $message = $('#contact-form-message');
            
            // Get form data
            const formData = {
                name: $form.find('[name="name"]').val(),
                email: $form.find('[name="email"]').val(),
                subject: $form.find('[name="subject"]').val(),
                project_type: $form.find('[name="project_type"]').val(),
                message: $form.find('[name="message"]').val()
            };

            // Basic validation
            if (!formData.name || !formData.email || !formData.subject || !formData.message) {
                showMessage($message, 'Please fill in all required fields.', 'error');
                return;
            }

            if (!isValidEmail(formData.email)) {
                showMessage($message, 'Please enter a valid email address.', 'error');
                return;
            }

            // Show loading state
            const originalText = $button.text();
            $button.text('Sending...').prop('disabled', true);

            // Simulate form submission (in a real implementation, this would be an AJAX call)
            setTimeout(function() {
                showMessage($message, 'Thank you for your message! I\'ll get back to you soon.', 'success');
                $form[0].reset();
                $button.text(originalText).prop('disabled', false);
            }, 1500);
        });
    }

    /**
     * Initialize back to top button
     */
    function initBackToTop() {
        // Create back to top button
        const $backToTop = $('<button class="back-to-top" aria-label="Back to top">↑</button>');
        $backToTop.css({
            position: 'fixed',
            bottom: '20px',
            right: '20px',
            width: '50px',
            height: '50px',
            borderRadius: '50%',
            background: 'linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%)',
            color: 'white',
            border: 'none',
            fontSize: '20px',
            cursor: 'pointer',
            display: 'none',
            zIndex: '1000',
            boxShadow: '0 4px 12px rgba(99, 102, 241, 0.3)',
            transition: 'all 0.3s ease'
        });

        $('body').append($backToTop);

        // Show/hide button based on scroll position
        $(window).on('scroll', function() {
            if ($(window).scrollTop() > 500) {
                $backToTop.fadeIn();
            } else {
                $backToTop.fadeOut();
            }
        });

        // Scroll to top when clicked
        $backToTop.on('click', function() {
            $('html, body').animate({ scrollTop: 0 }, 800);
        });

        // Hover effects
        $backToTop.on('mouseenter', function() {
            $(this).css('transform', 'translateY(-3px)');
        }).on('mouseleave', function() {
            $(this).css('transform', 'translateY(0)');
        });
    }

    /**
     * Initialize header scroll effects
     */
    function initHeaderScroll() {
        const $header = $('.site-header');
        let lastScrollTop = 0;

        $(window).on('scroll', function() {
            const scrollTop = $(window).scrollTop();

            // Add/remove scrolled class
            if (scrollTop > 100) {
                $header.addClass('scrolled');
            } else {
                $header.removeClass('scrolled');
            }

            // Hide/show header on scroll (optional)
            if (scrollTop > lastScrollTop && scrollTop > 200) {
                // Scrolling down
                $header.addClass('hidden');
            } else {
                // Scrolling up
                $header.removeClass('hidden');
            }

            lastScrollTop = scrollTop;
        });
    }

    /**
     * Utility function to validate email
     */
    function isValidEmail(email) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email);
    }

    /**
     * Utility function to show messages
     */
    function showMessage($container, message, type) {
        const className = type === 'success' ? 'success-message' : 'error-message';
        const bgColor = type === 'success' ? '#10b981' : '#ef4444';
        
        $container.html(`
            <div class="${className}" style="
                background: ${bgColor}; 
                color: white; 
                padding: 12px 20px; 
                border-radius: 6px; 
                margin-top: 1rem;
                animation: slideInUp 0.3s ease;
            ">
                ${message}
            </div>
        `);

        // Auto-hide after 5 seconds
        setTimeout(function() {
            $container.find(`.${className}`).fadeOut(300, function() {
                $(this).remove();
            });
        }, 5000);
    }

    /**
     * Initialize product interactions
     */
    function initProductInteractions() {
        // Product card hover effects
        $('.product-card').on('mouseenter', function() {
            $(this).css('transform', 'translateY(-10px)');
        }).on('mouseleave', function() {
            $(this).css('transform', 'translateY(0)');
        });

        // Newsletter card hover effects
        $('.newsletter-card').on('mouseenter', function() {
            $(this).css('transform', 'translateY(-5px)');
        }).on('mouseleave', function() {
            $(this).css('transform', 'translateY(0)');
        });

        // Article card hover effects
        $('.article-card').on('mouseenter', function() {
            $(this).css('transform', 'translateY(-5px)');
        }).on('mouseleave', function() {
            $(this).css('transform', 'translateY(0)');
        });
    }

    // Initialize product interactions after DOM is ready
    $(document).ready(function() {
        initProductInteractions();
    });

    /**
     * Lazy loading for images (if needed)
     */
    function initLazyLoading() {
        if ('IntersectionObserver' in window) {
            const imageObserver = new IntersectionObserver(function(entries) {
                entries.forEach(function(entry) {
                    if (entry.isIntersecting) {
                        const img = entry.target;
                        img.src = img.dataset.src;
                        img.classList.remove('lazy');
                        imageObserver.unobserve(img);
                    }
                });
            });

            document.querySelectorAll('img[data-src]').forEach(function(img) {
                imageObserver.observe(img);
            });
        }
    }

    // Call lazy loading initialization
    $(document).ready(function() {
        initLazyLoading();
    });

})(jQuery);