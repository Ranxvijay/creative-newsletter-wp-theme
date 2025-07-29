/**
 * Creative Newsletter Theme JavaScript
 * 
 * @package CreativeNewsletter
 */

(function($) {
    'use strict';

    // DOM Ready
    $(document).ready(function() {
        
        // Initialize all functions
        initMobileMenu();
        initScrollEffects();
        initNewsletterForm();
        initSmoothScrolling();
        initScrollToTop();
        initAnimations();
        
    });

    /**
     * Mobile Menu Toggle
     */
    function initMobileMenu() {
        $('.mobile-menu-toggle').on('click', function(e) {
            e.preventDefault();
            
            var $nav = $('.main-navigation');
            var $button = $(this);
            
            $nav.toggleClass('active');
            
            // Update ARIA attributes
            var expanded = $button.attr('aria-expanded') === 'true' || false;
            $button.attr('aria-expanded', !expanded);
        });

        // Close mobile menu when clicking outside
        $(document).on('click', function(e) {
            if (!$(e.target).closest('.site-header').length) {
                $('.main-navigation').removeClass('active');
                $('.mobile-menu-toggle').attr('aria-expanded', false);
            }
        });

        // Close mobile menu when window is resized to desktop
        $(window).on('resize', function() {
            if ($(window).width() > 768) {
                $('.main-navigation').removeClass('active');
                $('.mobile-menu-toggle').attr('aria-expanded', false);
            }
        });
    }

    /**
     * Scroll Effects
     */
    function initScrollEffects() {
        var $header = $('.site-header');
        var $scrollToTop = $('.scroll-to-top');

        $(window).on('scroll', function() {
            var scrollTop = $(this).scrollTop();

            // Header scroll effect
            if (scrollTop > 100) {
                $header.addClass('scrolled');
            } else {
                $header.removeClass('scrolled');
            }

            // Scroll to top button
            if (scrollTop > 300) {
                $scrollToTop.addClass('visible');
            } else {
                $scrollToTop.removeClass('visible');
            }
        });

        // Parallax effect for hero section
        if ($('.hero-section').length) {
            $(window).on('scroll', function() {
                var scrolled = $(this).scrollTop();
                var parallax = $('.hero-section');
                var speed = 0.5;

                parallax.css('transform', 'translateY(' + (scrolled * speed) + 'px)');
            });
        }
    }

    /**
     * Newsletter Form Handler
     */
    function initNewsletterForm() {
        $('#newsletter-form').on('submit', function(e) {
            e.preventDefault();

            var $form = $(this);
            var $input = $form.find('.newsletter-input');
            var $button = $form.find('.newsletter-btn');
            var $message = $('#newsletter-message');
            var email = $input.val().trim();

            // Validate email
            if (!isValidEmail(email)) {
                showMessage($message, creative_newsletter_ajax.strings.error, 'error');
                return;
            }

            // Show loading state
            $button.prop('disabled', true).text(creative_newsletter_ajax.strings.loading);

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
                    if (response.success) {
                        showMessage($message, response.data, 'success');
                        $input.val(''); // Clear the input
                    } else {
                        showMessage($message, response.data, 'error');
                    }
                },
                error: function() {
                    showMessage($message, creative_newsletter_ajax.strings.error, 'error');
                },
                complete: function() {
                    $button.prop('disabled', false).text('Subscribe');
                }
            });
        });
    }

    /**
     * Smooth Scrolling
     */
    function initSmoothScrolling() {
        $('a[href^="#"]').on('click', function(e) {
            var target = $(this.getAttribute('href'));
            
            if (target.length) {
                e.preventDefault();
                
                $('html, body').animate({
                    scrollTop: target.offset().top - 80 // Account for fixed header
                }, 800, 'easeInOutCubic');
            }
        });

        // Custom easing function
        $.easing.easeInOutCubic = function(x, t, b, c, d) {
            if ((t /= d / 2) < 1) return c / 2 * t * t * t + b;
            return c / 2 * ((t -= 2) * t * t + 2) + b;
        };
    }

    /**
     * Scroll to Top Button
     */
    function initScrollToTop() {
        $('.scroll-to-top').on('click', function(e) {
            e.preventDefault();
            
            $('html, body').animate({
                scrollTop: 0
            }, 800, 'easeInOutCubic');
        });
    }

    /**
     * Initialize Animations
     */
    function initAnimations() {
        // Intersection Observer for fade-in animations
        if ('IntersectionObserver' in window) {
            const observerOptions = {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            };

            const observer = new IntersectionObserver(function(entries) {
                entries.forEach(function(entry) {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('animate-in');
                        observer.unobserve(entry.target);
                    }
                });
            }, observerOptions);

            // Observe elements
            $('.article-card, .product-card, .section-title').each(function(index) {
                var element = this;
                
                // Add animation delay based on index
                $(element).css('animation-delay', (index * 0.1) + 's');
                
                observer.observe(element);
            });
        }

        // Hover effects for cards
        $('.article-card, .product-card').hover(
            function() {
                $(this).addClass('hover-effect');
            },
            function() {
                $(this).removeClass('hover-effect');
            }
        );

        // Button ripple effect
        $('.btn, .product-btn, .newsletter-btn').on('click', function(e) {
            var $button = $(this);
            var $ripple = $('<span class="ripple"></span>');
            
            var buttonPos = $button.offset();
            var buttonWidth = $button.outerWidth();
            var buttonHeight = $button.outerHeight();
            
            var xPos = e.pageX - buttonPos.left;
            var yPos = e.pageY - buttonPos.top;
            
            $ripple.css({
                position: 'absolute',
                top: yPos + 'px',
                left: xPos + 'px',
                width: '0',
                height: '0',
                borderRadius: '50%',
                background: 'rgba(255, 255, 255, 0.5)',
                transform: 'translate(-50%, -50%)',
                animation: 'ripple 0.6s linear',
                pointerEvents: 'none'
            });
            
            $button.css('position', 'relative').append($ripple);
            
            setTimeout(function() {
                $ripple.remove();
            }, 600);
        });
    }

    /**
     * Helper Functions
     */
    function isValidEmail(email) {
        var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email);
    }

    function showMessage($container, message, type) {
        $container.removeClass('success error')
                  .addClass(type)
                  .html('<p>' + message + '</p>')
                  .fadeIn();

        setTimeout(function() {
            $container.fadeOut();
        }, 5000);
    }

    /**
     * Lazy Loading for Images
     */
    function initLazyLoading() {
        if ('IntersectionObserver' in window) {
            const imageObserver = new IntersectionObserver(function(entries, observer) {
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

    /**
     * Performance Optimization
     */
    function debounce(func, wait, immediate) {
        var timeout;
        return function() {
            var context = this, args = arguments;
            var later = function() {
                timeout = null;
                if (!immediate) func.apply(context, args);
            };
            var callNow = immediate && !timeout;
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
            if (callNow) func.apply(context, args);
        };
    }

    // Debounced scroll and resize handlers
    var debouncedScroll = debounce(function() {
        initScrollEffects();
    }, 10);

    var debouncedResize = debounce(function() {
        // Handle responsive adjustments
        if ($(window).width() > 768) {
            $('.main-navigation').removeClass('active');
        }
    }, 250);

    $(window).on('scroll', debouncedScroll);
    $(window).on('resize', debouncedResize);

})(jQuery);

// CSS Animations (to be added via style attribute)
var animationCSS = `
    <style>
        @keyframes ripple {
            to {
                width: 300px;
                height: 300px;
                opacity: 0;
            }
        }
        
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .article-card, .product-card {
            opacity: 0;
            transform: translateY(30px);
            transition: all 0.6s ease;
        }
        
        .article-card.animate-in, .product-card.animate-in {
            opacity: 1;
            transform: translateY(0);
        }
        
        .hover-effect {
            transform: translateY(-5px) !important;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15) !important;
        }
        
        #newsletter-message {
            display: none;
            padding: 1rem;
            border-radius: 5px;
            margin-top: 1rem;
        }
        
        #newsletter-message.success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        
        #newsletter-message.error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        
        .scroll-to-top {
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
        }
        
        .scroll-to-top.visible {
            opacity: 1;
            visibility: visible;
        }
        
        @media (max-width: 768px) {
            .main-navigation {
                display: none;
            }
            
            .main-navigation.active {
                display: block;
            }
        }
    </style>
`;

// Inject animation CSS
document.head.insertAdjacentHTML('beforeend', animationCSS);