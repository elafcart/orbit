// Elafcart Portfolio - Main JS
(function($) {
    'use strict';

    $(document).ready(function() {
        // Initialize AOS
        if (typeof AOS !== 'undefined') {
            AOS.init({
                duration: 800,
                easing: 'ease-out-cubic',
                once: true,
                offset: 100
            });
        }

        // Typed.js for hero
        if ($('#typed-text').length && typeof Typed !== 'undefined') {
            const typedStrings = [
                'Full Stack Developer',
                'UI/UX Designer',
                'Laravel Expert',
                'React Developer'
            ];
            const customText = $('#typed-text').text();
            if (customText && customText !== 'Full Stack Developer') {
                // Use custom text if provided
            } else {
                new Typed('#typed-text', {
                    strings: typedStrings,
                    typeSpeed: 60,
                    backSpeed: 30,
                    backDelay: 2000,
                    loop: true
                });
            }
        }

        // Header scroll
        const header = $('#portfolioHeader');
        $(window).on('scroll', function() {
            if ($(this).scrollTop() > 50) {
                header.addClass('scrolled');
            } else {
                header.removeClass('scrolled');
            }

            // Scroll top button
            if ($(this).scrollTop() > 500) {
                $('#scrollTop').addClass('show');
            } else {
                $('#scrollTop').removeClass('show');
            }

            // Skill bars animation
            $('.skill-progress').each(function() {
                const $this = $(this);
                const width = $this.data('width');
                const offset = $this.offset().top;
                const scrollPos = $(window).scrollTop() + $(window).height();
                if (scrollPos > offset && $this.width() === 0) {
                    $this.css('width', width);
                }
            });
        });

        // Scroll top click
        $('#scrollTop').on('click', function() {
            $('html, body').animate({ scrollTop: 0 }, 600);
        });

        // Smooth scroll for anchor links
        $('a[href^="#"]').on('click', function(e) {
            const target = $(this.getAttribute('href'));
            if (target.length) {
                e.preventDefault();
                $('html, body').animate({
                    scrollTop: target.offset().top - 80
                }, 800);
            }
        });

        // Navbar close on click (mobile)
        $('.navbar-nav .nav-link').on('click', function() {
            if ($(window).width() < 992) {
                $('.navbar-collapse').collapse('hide');
            }
        });

        // Initialize skill bars on load if in viewport
        setTimeout(function() {
            $('.skill-progress').each(function() {
                const $this = $(this);
                if ($this.is(':visible')) {
                    $this.css('width', $this.data('width'));
                }
            });
        }, 500);
    });

})(jQuery);
