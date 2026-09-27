(function () {
    "use strict";

    function initEcommerceProductsCarousels() {
        if (typeof Swiper === "undefined") {
            return;
        }

        var carousels = document.querySelectorAll(".ecommerce-products-carousel__swiper:not(.swiper-initialized)");

        carousels.forEach(function (el) {
            var wrap = el.closest(".ecommerce-products-carousel");
            var slidesCount = el.querySelectorAll(".swiper-slide").length;

            if (!slidesCount) {
                return;
            }

            var desktop = parseInt(el.getAttribute("data-slides-desktop"), 10) || 4;
            var tablet = parseInt(el.getAttribute("data-slides-tablet"), 10) || 3;
            var mobile = parseInt(el.getAttribute("data-slides-mobile"), 10) || 2;
            var spaceBetween = parseInt(el.getAttribute("data-space-between"), 10) || 24;
            var wantLoop = el.getAttribute("data-loop") === "1";
            // Swiper disables loop mode (arrows go dead, autoplay stalls) unless
            // slidesCount >= slidesPerView + slidesPerGroup. slidesPerGroup is 1 here, and
            // slidesPerView never exceeds the largest per-breakpoint value, so guard on that.
            var maxPerView = Math.max(desktop, tablet, mobile, 1);
            var loop = wantLoop && slidesCount > maxPerView;
            var wantAutoplay = el.getAttribute("data-autoplay") === "1";
            var autoplayDelay = parseInt(el.getAttribute("data-autoplay-delay"), 10) || 5000;
            var wantPagination = el.getAttribute("data-pagination") === "1";
            var wantNavigation = el.getAttribute("data-navigation") === "1";

            var options = {
                slidesPerView: 1,
                spaceBetween: spaceBetween,
                slidesPerGroup: 1,
                loop: loop,
                watchOverflow: true,
                autoplay: wantAutoplay ? { delay: autoplayDelay, disableOnInteraction: false } : false,
                breakpoints: {
                    1400: { slidesPerView: Math.min(desktop, slidesCount) },
                    992: { slidesPerView: Math.min(tablet, slidesCount) },
                    576: { slidesPerView: Math.min(mobile, slidesCount) },
                    0: { slidesPerView: 1 },
                },
                a11y: true,
            };

            if (wantNavigation && wrap) {
                var nextEl = wrap.querySelector(".swiper-btn-next");
                var prevEl = wrap.querySelector(".swiper-btn-prev");

                if (nextEl && prevEl) {
                    options.navigation = { nextEl: nextEl, prevEl: prevEl };
                }
            }

            if (wantPagination && wrap) {
                var paginationEl = wrap.querySelector(".swiper-pagination");

                if (paginationEl) {
                    options.pagination = { el: paginationEl, clickable: true };
                }
            }

            // eslint-disable-next-line no-new
            new Swiper(el, options);
        });
    }

    if (document.readyState === "loading") {
        document.addEventListener("DOMContentLoaded", initEcommerceProductsCarousels);
    } else {
        initEcommerceProductsCarousels();
    }

    // Fallback: if Swiper wasn't ready yet at DOMContentLoaded (e.g. deferred/async
    // loading order differences), try again once everything has finished loading.
    window.addEventListener("load", initEcommerceProductsCarousels);
})();
