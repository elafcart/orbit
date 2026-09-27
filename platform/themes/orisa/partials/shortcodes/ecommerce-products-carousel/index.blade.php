@php
    // A missing attribute arrives as null, but the shortcode compiler can also hand back
    // an empty string for one that was never touched. filter_var('') is false, which would
    // silently flip the on-by-default options off, so treat both as "unset".
    $boolAttribute = function ($value, bool $default): bool {
        return $value === null || $value === '' ? $default : filter_var($value, FILTER_VALIDATE_BOOLEAN);
    };

    $showNav = $boolAttribute($shortcode->show_navigation ?? null, true);
    $showPagination = $boolAttribute($shortcode->show_pagination ?? null, false);
    $autoplay = $boolAttribute($shortcode->autoplay ?? null, true);
    $loop = $boolAttribute($shortcode->loop ?? null, true);
    $autoplayDelay = (int) ($shortcode->autoplay_delay ?: 5000);
    $itemsDesktop = max(1, (int) ($shortcode->items_desktop ?: 4));
    $itemsTablet = max(1, (int) ($shortcode->items_tablet ?: 3));
    $itemsMobile = max(1, (int) ($shortcode->items_mobile ?: 2));
    $spaceBetween = (int) ($shortcode->space_between ?: 24);
@endphp

<section {!! $shortcode->htmlAttributes() !!} class="pt-120 pb-120 ecommerce-products-carousel">
    <div class="container">
        <div class="row align-items-end mb-5 g-3">
            <div class="col-lg-8">
                @if($shortcode->title)
                    <div>
                        @if($shortcode->subtitle)
                            <span class="at-section-subtitle d-inline-block mb-3">{!! BaseHelper::clean($shortcode->subtitle) !!}</span>
                        @endif
                        <h2 class="mb-0">{!! BaseHelper::clean($shortcode->title) !!}</h2>
                    </div>
                @endif
            </div>

            @if($showNav)
                <div class="col-lg-4 d-flex justify-content-lg-end">
                    <div class="swiper-button-wrapper">
                        <button type="button" class="swiper-btn-prev" aria-label="{{ __('Previous') }}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="27" height="27" viewBox="0 0 27 27" fill="none">
                                <path d="M11.3481 7.47314L5.25879 13.2856L11.3481 19.0981" stroke="currentColor" stroke-width="1.66071" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M21.3124 13.2856H5.53564" stroke="currentColor" stroke-width="1.66071" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </button>
                        <button type="button" class="swiper-btn-next" aria-label="{{ __('Next') }}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="27" height="27" viewBox="0 0 27 27" fill="none">
                                <path d="M15.2234 7.47314L21.3126 13.2856L15.2234 19.0981" stroke="currentColor" stroke-width="1.66071" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M5.259 13.2856H21.0358" stroke="currentColor" stroke-width="1.66071" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </button>
                    </div>
                </div>
            @endif
        </div>

        <div class="ecommerce-products-carousel__wrap">
            <div
                class="swiper ecommerce-products-carousel__swiper"
                data-slides-desktop="{{ $itemsDesktop }}"
                data-slides-tablet="{{ $itemsTablet }}"
                data-slides-mobile="{{ $itemsMobile }}"
                data-space-between="{{ $spaceBetween }}"
                data-loop="{{ $loop ? 1 : 0 }}"
                data-autoplay="{{ $autoplay ? 1 : 0 }}"
                data-autoplay-delay="{{ $autoplayDelay }}"
                data-navigation="{{ $showNav ? 1 : 0 }}"
                data-pagination="{{ $showPagination ? 1 : 0 }}"
            >
                <div class="swiper-wrapper">
                    @foreach($products as $product)
                        <div class="swiper-slide h-auto">
                            @include(Theme::getThemeNamespace('views.ecommerce.includes.product-item'))
                        </div>
                    @endforeach
                </div>
            </div>

            @if($showPagination)
                <div class="swiper-pagination position-relative mt-4"></div>
            @endif
        </div>

        @if($shortcode->primary_action_label)
            <div class="text-center mt-5">
                <a href="{{ $shortcode->primary_action_url }}" class="at-btn">
                    <span>
                        <span class="text-1">{{ $shortcode->primary_action_label }}</span>
                        <span class="text-2">{{ $shortcode->primary_action_label }}</span>
                    </span>
                </a>
            </div>
        @endif
    </div>
</section>
