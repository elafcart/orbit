// Ecommerce JS for Portfolio Theme
(function($) {
    'use strict';

    $(document).ready(function() {
        // Quantity controls
        $(document).on('click', '.qty-btn', function() {
            const $input = $(this).siblings('.qty-input');
            let qty = parseInt($input.val()) || 1;
            
            if ($(this).hasClass('plus')) {
                qty++;
            } else {
                qty = Math.max(1, qty - 1);
            }
            
            $input.val(qty).trigger('change');
        });

        // Thumbnail click
        $(document).on('click', '.thumb-item', function() {
            const imageUrl = $(this).data('image');
            $('#mainProductImage').attr('src', imageUrl);
            $('.thumb-item').removeClass('active');
            $(this).addClass('active');
        });

        // Wishlist toggle
        $(document).on('click', '[data-bb-toggle="add-to-wishlist"]', function(e) {
            e.preventDefault();
            const $btn = $(this);
            const url = $btn.data('url');
            
            $.ajax({
                url: url,
                type: 'POST',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    if (response.error) {
                        // Show error
                        console.log(response.message);
                    } else {
                        $btn.find('i').removeClass('bi-heart').addClass('bi-heart-fill');
                        $btn.addClass('active');
                    }
                }
            });
        });

        // Filter tabs smooth scroll
        $('.filter-tab').on('click', function(e) {
            // Allow default navigation for filter
        });

        // Product card hover effect enhancement
        $('.ecommerce-product-card').hover(
            function() {
                $(this).find('.product-card-image img').css('transform', 'scale(1.05)');
            },
            function() {
                $(this).find('.product-card-image img').css('transform', 'scale(1)');
            }
        );
    });

})(jQuery);
