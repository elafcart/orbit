{{-- Testimonials Style 7 — Home5 grid with expandable name headers + optional team card (matches home-5-section-7 in index-5.html) --}}
@php
    $linkArrowSvg = '<svg width="11" height="11" viewBox="0 0 11 11" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M0.21967 9.40717C-0.0732232 9.70006 -0.0732232 10.1749 0.21967 10.4678C0.512563 10.7607 0.987437 10.7607 1.28033 10.4678L0.21967 9.40717ZM10.6875 0.75C10.6875 0.335786 10.3517 2.97145e-09 9.9375 1.50485e-07L3.1875 -2.70983e-07C2.77329 -2.70983e-07 2.4375 0.335786 2.4375 0.75C2.4375 1.16421 2.77329 1.5 3.1875 1.5H9.1875V7.5C9.1875 7.91421 9.52329 8.25 9.9375 8.25C10.3517 8.25 10.6875 7.91421 10.6875 7.5L10.6875 0.75ZM0.75 9.9375L1.28033 10.4678L10.4678 1.28033L9.9375 0.75L9.40717 0.21967L0.21967 9.40717L0.75 9.9375Z" fill="currentColor"/></svg>';
    $starSvg = '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="17" viewBox="0 0 18 17" fill="none"><path d="M8.55696 13.6975L12.707 16.2075C13.467 16.6675 14.397 15.9875 14.197 15.1275L13.097 10.4075L16.767 7.2275C17.437 6.6475 17.077 5.5475 16.197 5.4775L11.367 5.0675L9.47696 0.6075C9.13696 -0.2025 7.97696 -0.2025 7.63696 0.6075L5.74696 5.0575L0.916957 5.4675C0.0369575 5.5375 -0.323043 6.6375 0.346957 7.2175L4.01696 10.3975L2.91696 15.1175C2.71696 15.9775 3.64696 16.6575 4.40696 16.1975L8.55696 13.6975Z" fill="currentColor"/></svg>';

    $contactAddress = $shortcode->contact_address ?: '';
    $contactPhone = $shortcode->contact_phone ?: '';
    $contactEmail = $shortcode->contact_email ?: '';
    $teamImage = $shortcode->team_image ?: '';
    $teamCaption = $shortcode->team_caption ?: 'Real-world experience through projects.';
    $titleTag = \Theme\Orisa\Support\ThemeHelper::safeHeadingTag($shortcode->title_heading_level ?? null, 'h2');
    $titleSizeClass = \Theme\Orisa\Support\ThemeHelper::titleFontSizeClass($shortcode->title_font_size ?? null);
@endphp

<section {!! $shortcode->htmlAttributes() !!} class="home-5-section-7 p-relative pt-120 pb-100 bg-neutral-50">
    {{-- Top row: subtitle tag + title + contact info --}}
    <div class="container">
        <div class="row align-items-end g-4">
            <div class="col-xxl-5">
                @if ($shortcode->subtitle)
                    <span class="at-btn common-black text-uppercase bg-transparent mb-10 rounded-0 p-0">
                        <span class="text-uppercase">
                            <span class="text-1">{{ $shortcode->subtitle }}</span>
                            <span class="text-2">{{ $shortcode->subtitle }}</span>
                        </span>
                        <i>{!! $linkArrowSvg !!}{!! $linkArrowSvg !!}</i>
                    </span>
                @endif
                @if ($shortcode->title)
                    <{{ $titleTag }} class="reveal-text mb-0 {{ $titleSizeClass }}">{!! BaseHelper::clean($shortcode->title) !!}</{{ $titleTag }}>
                @endif
            </div>
            @if ($contactAddress || $contactPhone || $contactEmail)
                <div class="col-xxl-5 col-md-8 ms-xxl-auto">
                    <div class="d-flex align-items-center gap-5 justify-content-xxl-end">
                        @if ($contactAddress)
                            <p class="h6 fw-600 mb-0">{!! BaseHelper::clean(nl2br($contactAddress)) !!}</p>
                        @endif
                        @if ($contactPhone || $contactEmail)
                            <div>
                                @if ($contactPhone)
                                    <p class="h6 fw-600 mb-0"><a href="tel:{{ preg_replace('/[^+0-9]/', '', $contactPhone) }}">{{ $contactPhone }}</a></p>
                                @endif
                                @if ($contactEmail)
                                    <p class="h6 fw-600 mb-0"><a href="mailto:{{ $contactEmail }}">{{ $contactEmail }}</a></p>
                                @endif
                            </div>
                        @endif
                    </div>
                </div>
            @endif
        </div>
    </div>

    {{-- Grid: testimonial cards (+ optional team card in last slot) --}}
    <div class="container pt-80">
        <div class="row g-2">
            @foreach ($tabs as $index => $tab)
                @php
                    // Alternating layout: even = header on top, odd = header on bottom
                    $headerOnTop = $index % 2 === 0;
                    $orderClass = match ($index) {
                        0 => 'order-1',
                        1 => 'order-md-2 order-3',
                        2 => 'order-md-3 order-2',
                        default => 'order-md-' . ($index + 1),
                    };
                    $rating = (int) ($tab['rating'] ?? 3);
                @endphp
                <div class="col-xxl-3 col-lg-4 col-md-6 col-12 {{ $orderClass }}">
                    <div class="hover-unborder">
                        @if ($headerOnTop)
                            <div class="bg-neutral-0 rounded-4 px-5 py-3">
                                <h3 class="h6 d-flex justify-content-between align-items-center mb-0">
                                    <span>{{ $tab['name'] ?? '' }}</span>
                                    <span>+</span>
                                </h3>
                            </div>
                            <div class="bg-neutral-0 rounded-4 p-5 mt-2">
                                @include(Theme::getThemeNamespace('partials.shortcodes.testimonials.styles.style-7-body'), compact('tab', 'rating', 'starSvg'))
                            </div>
                        @else
                            <div class="bg-neutral-0 rounded-4 p-5 mb-2">
                                @include(Theme::getThemeNamespace('partials.shortcodes.testimonials.styles.style-7-body'), compact('tab', 'rating', 'starSvg'))
                            </div>
                            <div class="bg-neutral-0 rounded-4 px-5 py-3">
                                <h3 class="h6 d-flex justify-content-between align-items-center mb-0">
                                    <span>{{ $tab['name'] ?? '' }}</span>
                                    <span>+</span>
                                </h3>
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach

            {{-- Optional team / experience card in last slot --}}
            @if ($teamImage)
                <div class="col-xxl-3 col-md-6 order-4 d-lg-none d-xxl-block">
                    <div class="changeless">
                        <div class="team-card">
                            <div class="team-card-image">
                                <div class="anim-zoomin">
                                    {{ RvMedia::image($teamImage, $teamCaption, attributes: ['class' => 'img-cover']) }}
                                </div>
                            </div>
                            <div class="team-card-content">
                                <p class="h6 team-card-position fz-font-3xl fw-400 m-0 neutral-0">{!! BaseHelper::clean($teamCaption) !!}</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</section>
