{{-- Pricing Plans Style 3: from pricing.html `home-2-section-12` ~line 504 --}}
{{-- Left label, right title + toggle + 3 pricing cards --}}
@if(!empty($plans))
@php
    $bg = $shortcode->background_images ? RvMedia::getImageUrl($shortcode->background_images) : '';
    $titleTag = \Theme\Orisa\Support\ThemeHelper::safeHeadingTag($shortcode->title_heading_level ?? null, 'h2');
    $titleSizeClass = \Theme\Orisa\Support\ThemeHelper::titleFontSizeClass($shortcode->title_font_size ?? null);
@endphp
<section {!! $shortcode->htmlAttributes() !!} class="container-2200 mt-50">
    <div class="home-2-section-12 rounded-5 overflow-hidden mx-lg-3 mx-2 p-relative pt-100 pb-100"
        @if ($bg) style="background-image: url('{{ $bg }}'); background-size: cover; background-position: center;" @endif>
        <div class="container p-relative z-1">
            <div class="row g-4">
                <div class="col-lg-2 p-relative d-flex flex-column justify-content-between align-items-start">
                    @if ($shortcode->subtitle)
                        <span class="at-btn common-black bg-transparent rounded-0 p-0">
                            <span class="text-uppercase">
                                <span class="text-1">{!! BaseHelper::clean($shortcode->subtitle) !!}</span>
                                <span class="text-2">{!! BaseHelper::clean($shortcode->subtitle) !!}</span>
                            </span>
                            <i>
                                <svg width="11" height="11" viewBox="0 0 11 11" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M0.21967 9.40717C-0.0732232 9.70006 -0.0732232 10.1749 0.21967 10.4678C0.512563 10.7607 0.987437 10.7607 1.28033 10.4678L0.21967 9.40717ZM10.6875 0.75C10.6875 0.335786 10.3517 2.97145e-09 9.9375 1.50485e-07L3.1875 -2.70983e-07C2.77329 -2.70983e-07 2.4375 0.335786 2.4375 0.75C2.4375 1.16421 2.77329 1.5 3.1875 1.5H9.1875V7.5C9.1875 7.91421 9.52329 8.25 9.9375 8.25C10.3517 8.25 10.6875 7.91421 10.6875 7.5L10.6875 0.75ZM0.75 9.9375L1.28033 10.4678L10.4678 1.28033L9.9375 0.75L9.40717 0.21967L0.21967 9.40717L0.75 9.9375Z" fill="currentColor"/></svg>
                                <svg width="11" height="11" viewBox="0 0 11 11" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M0.21967 9.40717C-0.0732232 9.70006 -0.0732232 10.1749 0.21967 10.4678C0.512563 10.7607 0.987437 10.7607 1.28033 10.4678L0.21967 9.40717ZM10.6875 0.75C10.6875 0.335786 10.3517 2.97145e-09 9.9375 1.50485e-07L3.1875 -2.70983e-07C2.77329 -2.70983e-07 2.4375 0.335786 2.4375 0.75C2.4375 1.16421 2.77329 1.5 3.1875 1.5H9.1875V7.5C9.1875 7.91421 9.52329 8.25 9.9375 8.25C10.3517 8.25 10.6875 7.91421 10.6875 7.5L10.6875 0.75ZM0.75 9.9375L1.28033 10.4678L10.4678 1.28033L9.9375 0.75L9.40717 0.21967L0.21967 9.40717L0.75 9.9375Z" fill="currentColor"/></svg>
                            </i>
                        </span>
                    @endif
                </div>

                <div class="col-3xl-8 col-xxl-10 col-lg-10 col-md-12">
                    <div class="row align-items-end mb-60 g-4">
                        <div class="col-lg-8">
                            @if ($shortcode->title)
                                <{{ $titleTag }} class="h3 reveal-text fw-700 mb-0 {{ $titleSizeClass }}">{!! BaseHelper::clean($shortcode->title) !!}</{{ $titleTag }}>
                            @endif
                            @if ($shortcode->description)
                                <p class="fz-font-lg neutral-600 mb-0 mt-3">{!! BaseHelper::clean($shortcode->description) !!}</p>
                            @endif
                        </div>
                        <div class="col-lg-4 ms-lg-auto">
                            <div class="change-price-plan jus mt-6 wow img-custom-anim-top">
                                <span class="price-plan-toggle-label" data-plan="personal">{{ __('Personal') }}</span>
                                <label class="price-plan-toggle">
                                    <input type="checkbox" class="price-plan-toggle__input" id="price-plan-toggle-{{ $shortcode->style ?? 3 }}" aria-label="{{ __('Toggle plan') }}">
                                    <span class="price-plan-toggle__track"></span>
                                    <span class="price-plan-toggle__thumb"></span>
                                </label>
                                <span class="price-plan-toggle-label" data-plan="business">{{ __('Business') }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="row justify-content-center g-4">
                        @foreach ($plans ?? [] as $plan)
                            @php
                                $isFeatured = ($plan['is_featured'] ?? null) === 'yes';
                                $monthly = $plan['monthly_price'] ?? '';
                                $yearly = $plan['yearly_price'] ?? '';
                            @endphp
                            <div class="col-lg-4">
                                <div @class(['home-2-pricing-card bg-neutral-50', 'home-2-pricing-card--popular' => $isFeatured])>
                                    @if ($isFeatured)
                                        <span class="home-2-pricing-card__badge">{{ __('Most popular') }}</span>
                                    @endif
                                    <div class="home-2-pricing-card__body">
                                        <h3 class="h4 home-2-pricing-card__title">{{ $plan['name'] }}</h3>
                                        <div class="home-2-pricing-card__price">
                                            <span class="home-2-pricing-card__price-value pricing-monthly">{{ $monthly }}</span>
                                            <span class="home-2-pricing-card__price-value pricing-yearly d-none">{{ $yearly }}</span>
                                            <span class="home-2-pricing-card__price-period pricing-monthly">{{ __('/monthly') }}</span>
                                            <span class="home-2-pricing-card__price-period pricing-yearly d-none">{{ __('/yearly') }}</span>
                                        </div>
                                        @if (! empty($plan['description']))
                                            <p class="home-2-pricing-card__desc">{{ $plan['description'] }}</p>
                                        @endif
                                        @if (! empty($plan['button_label']))
                                            <a class="at-btn px-5" href="{{ $plan['button_url'] ?? '#' }}">
                                                <span>
                                                    <span class="text-1 text-capitalize">{{ $plan['button_label'] }}</span>
                                                    <span class="text-2 text-capitalize">{{ $plan['button_label'] }}</span>
                                                </span>
                                                <i>
                                                    <svg width="11" height="11" viewBox="0 0 11 11" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M0.21967 9.40717C-0.0732232 9.70006 -0.0732232 10.1749 0.21967 10.4678C0.512563 10.7607 0.987437 10.7607 1.28033 10.4678L0.21967 9.40717ZM10.6875 0.75C10.6875 0.335786 10.3517 2.97145e-09 9.9375 1.50485e-07L3.1875 -2.70983e-07C2.77329 -2.70983e-07 2.4375 0.335786 2.4375 0.75C2.4375 1.16421 2.77329 1.5 3.1875 1.5H9.1875V7.5C9.1875 7.91421 9.52329 8.25 9.9375 8.25C10.3517 8.25 10.6875 7.91421 10.6875 7.5L10.6875 0.75ZM0.75 9.9375L1.28033 10.4678L10.4678 1.28033L9.9375 0.75L9.40717 0.21967L0.21967 9.40717L0.75 9.9375Z" fill="currentColor"/></svg>
                                                    <svg width="11" height="11" viewBox="0 0 11 11" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M0.21967 9.40717C-0.0732232 9.70006 -0.0732232 10.1749 0.21967 10.4678C0.512563 10.7607 0.987437 10.7607 1.28033 10.4678L0.21967 9.40717ZM10.6875 0.75C10.6875 0.335786 10.3517 2.97145e-09 9.9375 1.50485e-07L3.1875 -2.70983e-07C2.77329 -2.70983e-07 2.4375 0.335786 2.4375 0.75C2.4375 1.16421 2.77329 1.5 3.1875 1.5H9.1875V7.5C9.1875 7.91421 9.52329 8.25 9.9375 8.25C10.3517 8.25 10.6875 7.91421 10.6875 7.5L10.6875 0.75ZM0.75 9.9375L1.28033 10.4678L10.4678 1.28033L9.9375 0.75L9.40717 0.21967L0.21967 9.40717L0.75 9.9375Z" fill="currentColor"/></svg>
                                                </i>
                                            </a>
                                        @endif
                                    </div>
                                    @if (! empty($plan['features']))
                                        <ul class="home-2-pricing-card__features">
                                            @foreach (explode("\n", $plan['features']) as $feature)
                                                @php
                                                    $feature = trim($feature);
                                                    // A line starting with "-" marks a feature that is NOT included in this plan.
                                                    $isExcluded = str_starts_with($feature, '-');
                                                    $feature = trim(ltrim($feature, '-'));
                                                @endphp
                                                @if ($feature)
                                                    <li @if ($isExcluded) style="opacity: .45;" @endif>
                                                        <span class="home-2-pricing-card__feature-icon dark-mode-invert">
                                                            @if ($isExcluded)
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                                                                    <path d="M9 0C13.9706 0 18 4.02944 18 9C18 13.9706 13.9706 18 9 18C4.02944 18 0 13.9706 0 9C0 4.02944 4.02944 0 9 0ZM5.88 4.82L4.82 5.88L7.94 9L4.82 12.12L5.88 13.18L9 10.06L12.12 13.18L13.18 12.12L10.06 9L13.18 5.88L12.12 4.82L9 7.94L5.88 4.82Z" fill="currentColor" />
                                                                </svg>
                                                            @else
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                                                                    <path d="M9 0C13.9706 0 18 4.02944 18 9C18 13.9706 13.9706 18 9 18C4.02944 18 0 13.9706 0 9C0 4.02944 4.02944 0 9 0ZM8 5V8H5V10H8V13H10V10H13V8H10V5H8Z" fill="currentColor" />
                                                                </svg>
                                                            @endif
                                                        </span>
                                                        {{ $feature }}
                                                    </li>
                                                @endif
                                            @endforeach
                                        </ul>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>

                    @if ($shortcode->custom_pricing_title || $shortcode->contact_email || $shortcode->contact_phone)
                        <div class="row pt-60">
                            <div class="col-lg-5 offset-lg-4">
                                @if ($shortcode->custom_pricing_title)
                                    <div class="d-flex gap-3">
                                        <div class="icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M10 20C5.286 20 2.929 20 1.464 18.535C0 17.072 0 14.714 0 10C0 5.286 0 2.929 1.464 1.464C2.93 0 5.286 0 10 0C14.714 0 17.071 0 18.535 1.464C20 2.93 20 5.286 20 10C20 14.714 20 17.071 18.535 18.535C17.072 20 14.714 20 10 20ZM10 5.75C9.379 5.75 8.875 6.254 8.875 6.875C8.875 7.07391 8.79598 7.26468 8.65533 7.40533C8.51468 7.54598 8.32391 7.625 8.125 7.625C7.92609 7.625 7.73532 7.54598 7.59467 7.40533C7.45402 7.26468 7.375 7.07391 7.375 6.875C7.37501 6.44494 7.48069 6.02146 7.68274 5.64182C7.88479 5.26218 8.17702 4.93799 8.53374 4.69777C8.89046 4.45754 9.30073 4.30865 9.72849 4.26416C10.1562 4.21968 10.5884 4.28098 10.9869 4.44266C11.3854 4.60435 11.7381 4.86147 12.0139 5.19142C12.2898 5.52137 12.4803 5.91403 12.5688 6.33489C12.6573 6.75575 12.6411 7.19191 12.5215 7.60501C12.4019 8.01811 12.1826 8.3955 11.883 8.704C11.791 8.79867 11.703 8.88767 11.619 8.971C11.4165 9.16504 11.2258 9.37108 11.048 9.588C10.828 9.87 10.75 10.077 10.75 10.25V11C10.75 11.1989 10.671 11.3897 10.5303 11.5303C10.3897 11.671 10.1989 11.75 10 11.75C9.80109 11.75 9.61032 11.671 9.46967 11.5303C9.32902 11.3897 9.25 11.1989 9.25 11V10.25C9.25 9.595 9.555 9.064 9.864 8.667C10.093 8.373 10.38 8.087 10.614 7.853C10.6847 7.783 10.749 7.71833 10.807 7.659C10.9611 7.5004 11.0651 7.2999 11.1059 7.08255C11.1467 6.8652 11.1225 6.64065 11.0364 6.43696C10.9503 6.23326 10.8061 6.05947 10.6217 5.93729C10.4374 5.81511 10.2211 5.74997 10 5.75ZM10 15C10.2652 15 10.5196 14.8946 10.7071 14.7071C10.8946 14.5196 11 14.2652 11 14C11 13.7348 10.8946 13.4804 10.7071 13.2929C10.5196 13.1054 10.2652 13 10 13C9.73478 13 9.48043 13.1054 9.29289 13.2929C9.10536 13.4804 9 13.7348 9 14C9 14.2652 9.10536 14.5196 9.29289 14.7071C9.48043 14.8946 9.73478 15 10 15Z" fill="currentColor" />
                                            </svg>
                                        </div>
                                        <div>
                                            <h4 class="h6 fw-600">{!! BaseHelper::clean($shortcode->custom_pricing_title) !!}</h4>
                                            @if ($shortcode->custom_pricing_description)
                                                <p class="fz-font-lg neutral-700">{!! BaseHelper::clean($shortcode->custom_pricing_description) !!}</p>
                                            @endif
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <div class="col-xxl-2 col-lg-3 ms-lg-auto text-end d-flex flex-column gap-2">
                                @if ($shortcode->primary_action_label)
                                    <a href="{{ $shortcode->primary_action_url ?: '#' }}" class="text-decoration-underline">{{ $shortcode->primary_action_label }}</a>
                                @endif
                                @if ($shortcode->contact_email)
                                    <p class="h6 fw-600 mb-0">
                                        <a href="mailto:{{ $shortcode->contact_email }}">{{ $shortcode->contact_email }}</a>
                                    </p>
                                @endif
                                @if ($shortcode->contact_phone)
                                    <p class="h6 fw-600 mb-0">
                                        <a href="tel:{{ preg_replace('/[^+0-9]/', '', $shortcode->contact_phone) }}">{{ $shortcode->contact_phone }}</a>
                                    </p>
                                @endif
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
@endif

<script>
    (function () {
        function init() {
            document.querySelectorAll('.price-plan-toggle__input').forEach(function (input) {
                if (input.dataset.toggleBound === '1') return;
                input.dataset.toggleBound = '1';

                var section = input.closest('section');
                if (!section) return;

                var sync = function () {
                    var business = input.checked;
                    section.querySelectorAll('.pricing-monthly').forEach(function (el) {
                        el.classList.toggle('d-none', business);
                    });
                    section.querySelectorAll('.pricing-yearly').forEach(function (el) {
                        el.classList.toggle('d-none', !business);
                    });
                };

                input.addEventListener('change', sync);

                // Clicks on the "Personal" / "Business" text spans also flip the toggle
                section.querySelectorAll('.price-plan-toggle-label').forEach(function (label) {
                    label.style.cursor = 'pointer';
                    label.addEventListener('click', function () {
                        var target = label.getAttribute('data-plan') === 'business';
                        if (input.checked !== target) {
                            input.checked = target;
                            input.dispatchEvent(new Event('change', { bubbles: true }));
                        }
                    });
                });

                sync();
            });
        }

        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', init);
        } else {
            init();
        }
    })();
</script>
