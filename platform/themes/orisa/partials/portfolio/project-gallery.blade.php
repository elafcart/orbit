{{-- Project detail gallery: multi-image slider (arrows + pagination) with a
     lightweight, dependency-free lightbox. $projectImages and $project are passed
     in from views/portfolio/project.blade.php. Swiper is already loaded globally
     in the footer, so the init defers to window "load". --}}
<div class="pt-60 pb-80">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                @if(count($projectImages) > 1)
                    <div class="swiper project-gallery-slider position-relative">
                        <div class="swiper-wrapper">
                            @foreach($projectImages as $img)
                                <div class="swiper-slide">
                                    <a href="{{ RvMedia::getImageUrl($img) }}" class="project-gallery-item d-block" aria-label="{{ __('View image') }}">
                                        {{ RvMedia::image($img, $project->name, attributes: ['class' => 'w-100 rounded-4']) }}
                                    </a>
                                </div>
                            @endforeach
                        </div>
                        <div class="swiper-button-prev project-gallery-prev"></div>
                        <div class="swiper-button-next project-gallery-next"></div>
                        <div class="swiper-pagination project-gallery-pagination"></div>
                    </div>
                @else
                    <a href="{{ RvMedia::getImageUrl($projectImages[0]) }}" class="project-gallery-item d-block" aria-label="{{ __('View image') }}">
                        {{ RvMedia::image($projectImages[0], $project->name, attributes: ['class' => 'w-100 rounded-4']) }}
                    </a>
                @endif
            </div>
        </div>
    </div>
</div>

{{-- Lightbox overlay (shared, single instance) --}}
<div class="project-lightbox" id="projectLightbox" role="dialog" aria-modal="true" aria-hidden="true">
    <button type="button" class="project-lightbox__close" aria-label="{{ __('Close') }}">&times;</button>
    <button type="button" class="project-lightbox__nav project-lightbox__prev" aria-label="{{ __('Previous') }}">&#8249;</button>
    <img src="" alt="{{ $project->name }}" class="project-lightbox__img">
    <button type="button" class="project-lightbox__nav project-lightbox__next" aria-label="{{ __('Next') }}">&#8250;</button>
</div>

<style>
    .project-gallery-slider .swiper-button-prev,
    .project-gallery-slider .swiper-button-next {
        color: #fff;
        background: rgba(0, 0, 0, .45);
        width: 44px;
        height: 44px;
        border-radius: 50%;
    }
    .project-gallery-slider .swiper-button-prev:after,
    .project-gallery-slider .swiper-button-next:after { font-size: 18px; }
    .project-gallery-slider .swiper-pagination { position: static; margin-top: 16px; }
    .project-gallery-item { cursor: zoom-in; }

    .project-lightbox {
        position: fixed;
        inset: 0;
        z-index: 1050;
        display: none;
        align-items: center;
        justify-content: center;
        background: rgba(0, 0, 0, .9);
    }
    .project-lightbox.is-open { display: flex; }
    .project-lightbox__img {
        max-width: 90vw;
        max-height: 85vh;
        border-radius: 8px;
        object-fit: contain;
    }
    .project-lightbox__close {
        position: absolute;
        top: 20px;
        right: 24px;
        font-size: 40px;
        line-height: 1;
        color: #fff;
        background: none;
        border: 0;
        cursor: pointer;
    }
    .project-lightbox__nav {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        font-size: 44px;
        line-height: 1;
        color: #fff;
        background: rgba(0, 0, 0, .4);
        border: 0;
        width: 56px;
        height: 56px;
        border-radius: 50%;
        cursor: pointer;
    }
    .project-lightbox__prev { left: 20px; }
    .project-lightbox__next { right: 20px; }
    @media (max-width: 575px) {
        .project-lightbox__nav { width: 44px; height: 44px; font-size: 32px; }
    }
</style>

<script>
    (function () {
        function init() {
            var slider = document.querySelector('.project-gallery-slider');
            if (slider && typeof Swiper !== 'undefined') {
                new Swiper(slider, {
                    slidesPerView: 1,
                    spaceBetween: 20,
                    loop: slider.querySelectorAll('.swiper-slide').length > 1,
                    navigation: {
                        prevEl: '.project-gallery-prev',
                        nextEl: '.project-gallery-next'
                    },
                    pagination: {
                        el: '.project-gallery-pagination',
                        clickable: true
                    }
                });
            }

            var items = Array.prototype.slice.call(document.querySelectorAll('.project-gallery-item'));
            var box = document.getElementById('projectLightbox');
            if (!items.length || !box) {
                return;
            }

            // ScrollSmoother transforms #smooth-content, which makes it the containing
            // block for any position:fixed descendant. Move the overlay to <body> so it
            // stays anchored to the viewport.
            if (box.parentNode !== document.body) {
                document.body.appendChild(box);
            }

            var imgEl = box.querySelector('.project-lightbox__img');
            var urls = items.map(function (a) { return a.getAttribute('href'); });
            var current = 0;

            function show(index) {
                current = (index + urls.length) % urls.length;
                imgEl.setAttribute('src', urls[current]);
            }

            function lockScroll(locked) {
                document.body.style.overflow = locked ? 'hidden' : '';

                // ScrollSmoother keeps scrolling the page even when body overflow is
                // hidden, so pause it explicitly while the overlay is open.
                if (typeof ScrollSmoother !== 'undefined' && ScrollSmoother.get()) {
                    ScrollSmoother.get().paused(locked);
                }
            }

            function open(index) {
                show(index);
                box.classList.add('is-open');
                box.setAttribute('aria-hidden', 'false');
                lockScroll(true);
            }

            function close() {
                box.classList.remove('is-open');
                box.setAttribute('aria-hidden', 'true');
                lockScroll(false);
            }

            items.forEach(function (a, index) {
                a.addEventListener('click', function (e) {
                    e.preventDefault();
                    open(index);
                });
            });

            box.querySelector('.project-lightbox__close').addEventListener('click', close);
            box.querySelector('.project-lightbox__prev').addEventListener('click', function () { show(current - 1); });
            box.querySelector('.project-lightbox__next').addEventListener('click', function () { show(current + 1); });
            box.addEventListener('click', function (e) {
                if (e.target === box) {
                    close();
                }
            });
            document.addEventListener('keydown', function (e) {
                if (!box.classList.contains('is-open')) {
                    return;
                }
                if (e.key === 'Escape') { e.preventDefault(); close(); }
                if (e.key === 'ArrowLeft') { e.preventDefault(); show(current - 1); }
                if (e.key === 'ArrowRight') { e.preventDefault(); show(current + 1); }
            });
        }

        if (document.readyState === 'complete') {
            init();
        } else {
            window.addEventListener('load', init);
        }
    })();
</script>
