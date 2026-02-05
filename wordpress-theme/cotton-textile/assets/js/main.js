/**
 * Cotton Textile Theme JavaScript
 *
 * @package Cotton_Textile
 */

(function($) {
    'use strict';

    // DOM Ready
    $(document).ready(function() {
        initMobileMenu();
        initSmoothScroll();
        initHeaderScroll();
        initContactFormMessages();
    });

    /**
     * Mobile Menu Toggle
     */
    function initMobileMenu() {
        const $toggle = $('#mobile-menu-toggle');
        const $menu = $('#mobile-menu');
        const $body = $('body');

        $toggle.on('click', function() {
            $menu.toggleClass('active');
            $body.toggleClass('menu-open');

            // Animate hamburger
            $(this).toggleClass('active');
        });

        // Close menu when clicking a link
        $menu.find('a').on('click', function() {
            $menu.removeClass('active');
            $body.removeClass('menu-open');
            $toggle.removeClass('active');
        });

        // Close menu on escape key
        $(document).on('keyup', function(e) {
            if (e.key === 'Escape' && $menu.hasClass('active')) {
                $menu.removeClass('active');
                $body.removeClass('menu-open');
                $toggle.removeClass('active');
            }
        });
    }

    /**
     * Smooth Scroll for Anchor Links
     */
    function initSmoothScroll() {
        $('a[href*="#"]:not([href="#"])').on('click', function() {
            if (
                location.pathname.replace(/^\//, '') === this.pathname.replace(/^\//, '') &&
                location.hostname === this.hostname
            ) {
                var $target = $(this.hash);
                $target = $target.length ? $target : $('[name=' + this.hash.slice(1) + ']');

                if ($target.length) {
                    $('html, body').animate({
                        scrollTop: $target.offset().top - 80
                    }, 600);
                    return false;
                }
            }
        });
    }

    /**
     * Header Scroll Effect
     */
    function initHeaderScroll() {
        const $header = $('.site-header');
        let lastScroll = 0;

        $(window).on('scroll', function() {
            const currentScroll = $(this).scrollTop();

            if (currentScroll > 100) {
                $header.addClass('scrolled');
            } else {
                $header.removeClass('scrolled');
            }

            lastScroll = currentScroll;
        });
    }

    /**
     * Contact Form Success/Error Messages
     */
    function initContactFormMessages() {
        const urlParams = new URLSearchParams(window.location.search);
        const contactStatus = urlParams.get('contact');

        if (contactStatus === 'success') {
            showNotification('Thank you! Your message has been sent successfully.', 'success');
            // Remove query string
            window.history.replaceState({}, document.title, window.location.pathname);
        } else if (contactStatus === 'error') {
            showNotification('Sorry, there was an error sending your message. Please try again.', 'error');
            window.history.replaceState({}, document.title, window.location.pathname);
        }
    }

    /**
     * Show Notification
     */
    function showNotification(message, type) {
        const $notification = $('<div/>', {
            class: 'notification notification-' + type,
            html: '<i class="fas fa-' + (type === 'success' ? 'check-circle' : 'exclamation-circle') + '"></i> ' + message
        }).css({
            position: 'fixed',
            top: '100px',
            right: '20px',
            padding: '1rem 1.5rem',
            borderRadius: '0.5rem',
            backgroundColor: type === 'success' ? '#059669' : '#DC2626',
            color: '#fff',
            zIndex: 9999,
            boxShadow: '0 4px 12px rgba(0,0,0,0.15)',
            transform: 'translateX(120%)',
            transition: 'transform 0.3s ease'
        });

        $('body').append($notification);

        setTimeout(function() {
            $notification.css('transform', 'translateX(0)');
        }, 100);

        setTimeout(function() {
            $notification.css('transform', 'translateX(120%)');
            setTimeout(function() {
                $notification.remove();
            }, 300);
        }, 5000);
    }

    /**
     * Lazy Load Images (if needed)
     */
    function initLazyLoad() {
        if ('IntersectionObserver' in window) {
            const lazyImages = document.querySelectorAll('img[data-src]');

            const imageObserver = new IntersectionObserver(function(entries, observer) {
                entries.forEach(function(entry) {
                    if (entry.isIntersecting) {
                        const image = entry.target;
                        image.src = image.dataset.src;
                        image.removeAttribute('data-src');
                        imageObserver.unobserve(image);
                    }
                });
            });

            lazyImages.forEach(function(image) {
                imageObserver.observe(image);
            });
        }
    }

    /**
     * Product Gallery Thumbnail Click
     */
    $(document).on('click', '.product-thumbnail', function() {
        const $this = $(this);
        const imageUrl = $this.data('image');
        const $mainImage = $('#main-image');

        if ($mainImage.length && imageUrl) {
            // Remove active class from all thumbnails
            $('.product-thumbnail').removeClass('active');

            // Add active class to clicked thumbnail
            $this.addClass('active');

            // Fade out, change image, fade in
            $mainImage.fadeOut(200, function() {
                $(this).attr('src', imageUrl).fadeIn(200);
            });
        }
    });

    /**
     * Gallery Lightbox
     */
    $(document).on('click', '.gallery-item', function() {
        const $this = $(this);
        const fullImage = $this.find('img').data('full');
        const $lightbox = $('#lightbox');
        const $lightboxImage = $('#lightbox-image');

        if ($lightbox.length && fullImage) {
            $lightboxImage.attr('src', fullImage);
            $lightbox.addClass('active');
            $('body').css('overflow', 'hidden');
        }
    });

    // Close lightbox
    $(document).on('click', '.lightbox-close, .lightbox', function(e) {
        if (e.target === this) {
            $('#lightbox').removeClass('active');
            $('body').css('overflow', '');
        }
    });

    // Lightbox keyboard navigation
    $(document).on('keyup', function(e) {
        const $lightbox = $('#lightbox');

        if ($lightbox.hasClass('active')) {
            if (e.key === 'Escape') {
                $lightbox.removeClass('active');
                $('body').css('overflow', '');
            } else if (e.key === 'ArrowLeft') {
                $('.lightbox-prev').trigger('click');
            } else if (e.key === 'ArrowRight') {
                $('.lightbox-next').trigger('click');
            }
        }
    });

})(jQuery);
