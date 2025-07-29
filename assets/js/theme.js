/**
 * Creative Newsletter Theme JavaScript
 */

(function() {
    'use strict';

    // Wait for DOM to be ready
    document.addEventListener('DOMContentLoaded', function() {
        
        // Mobile menu toggle
        const menuToggle = document.querySelector('.menu-toggle');
        const navigation = document.querySelector('.main-navigation ul');
        
        if (menuToggle && navigation) {
            menuToggle.addEventListener('click', function() {
                const expanded = this.getAttribute('aria-expanded') === 'true';
                this.setAttribute('aria-expanded', !expanded);
                navigation.classList.toggle('is-open');
                this.classList.toggle('is-active');
            });
        }

        // Smooth scrolling for anchor links
        const anchorLinks = document.querySelectorAll('a[href^="#"]');
        anchorLinks.forEach(function(link) {
            link.addEventListener('click', function(e) {
                const targetId = this.getAttribute('href').substring(1);
                const targetElement = document.getElementById(targetId);
                
                if (targetElement) {
                    e.preventDefault();
                    targetElement.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Newsletter form handling
        const newsletterForm = document.querySelector('.newsletter-form');
        if (newsletterForm) {
            newsletterForm.addEventListener('submit', function(e) {
                e.preventDefault();
                
                const emailInput = this.querySelector('.newsletter-input');
                const submitButton = this.querySelector('.newsletter-submit');
                const email = emailInput.value.trim();
                
                // Basic email validation
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                
                if (!email) {
                    showMessage('Please enter your email address.', 'error');
                    return;
                }
                
                if (!emailRegex.test(email)) {
                    showMessage('Please enter a valid email address.', 'error');
                    return;
                }
                
                // Simulate form submission
                submitButton.textContent = 'Subscribing...';
                submitButton.disabled = true;
                
                setTimeout(function() {
                    showMessage('Thank you for subscribing! Check your email for confirmation.', 'success');
                    emailInput.value = '';
                    submitButton.textContent = 'Subscribe';
                    submitButton.disabled = false;
                }, 1500);
            });
        }

        // Add scroll effect to header
        let lastScroll = 0;
        const header = document.querySelector('.site-header');
        
        if (header) {
            window.addEventListener('scroll', function() {
                const currentScroll = window.pageYOffset;
                
                if (currentScroll > 100) {
                    header.classList.add('scrolled');
                } else {
                    header.classList.remove('scrolled');
                }
                
                // Hide/show header on scroll
                if (currentScroll > lastScroll && currentScroll > 200) {
                    header.classList.add('header-hidden');
                } else {
                    header.classList.remove('header-hidden');
                }
                
                lastScroll = currentScroll;
            });
        }

        // Lazy loading for images
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

            const lazyImages = document.querySelectorAll('img[data-src]');
            lazyImages.forEach(function(img) {
                imageObserver.observe(img);
            });
        }

        // Reading progress indicator
        const article = document.querySelector('.single-post-content');
        if (article) {
            const progressBar = createProgressBar();
            document.body.appendChild(progressBar);
            
            window.addEventListener('scroll', function() {
                updateReadingProgress(article, progressBar);
            });
        }

        // Back to top button
        const backToTop = createBackToTopButton();
        document.body.appendChild(backToTop);
        
        window.addEventListener('scroll', function() {
            if (window.pageYOffset > 300) {
                backToTop.classList.add('visible');
            } else {
                backToTop.classList.remove('visible');
            }
        });

        backToTop.addEventListener('click', function() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    });

    // Helper function to show messages
    function showMessage(message, type) {
        // Remove existing message
        const existingMessage = document.querySelector('.newsletter-message');
        if (existingMessage) {
            existingMessage.remove();
        }

        // Create new message
        const messageDiv = document.createElement('div');
        messageDiv.className = 'newsletter-message ' + type;
        messageDiv.textContent = message;
        
        const newsletterForm = document.querySelector('.newsletter-form');
        if (newsletterForm) {
            newsletterForm.parentNode.insertBefore(messageDiv, newsletterForm.nextSibling);
            
            // Remove message after 5 seconds
            setTimeout(function() {
                if (messageDiv.parentNode) {
                    messageDiv.remove();
                }
            }, 5000);
        }
    }

    // Create reading progress bar
    function createProgressBar() {
        const progressBar = document.createElement('div');
        progressBar.className = 'reading-progress';
        progressBar.innerHTML = '<div class="reading-progress-bar"></div>';
        return progressBar;
    }

    // Update reading progress
    function updateReadingProgress(article, progressBar) {
        const articleRect = article.getBoundingClientRect();
        const articleTop = articleRect.top + window.pageYOffset;
        const articleHeight = articleRect.height;
        const windowHeight = window.innerHeight;
        const scrollTop = window.pageYOffset;
        
        const progress = Math.max(0, Math.min(100, 
            ((scrollTop + windowHeight - articleTop) / articleHeight) * 100
        ));
        
        const progressBarInner = progressBar.querySelector('.reading-progress-bar');
        progressBarInner.style.width = progress + '%';
    }

    // Create back to top button
    function createBackToTopButton() {
        const backToTop = document.createElement('button');
        backToTop.className = 'back-to-top';
        backToTop.innerHTML = '↑';
        backToTop.setAttribute('aria-label', 'Back to top');
        return backToTop;
    }

})();