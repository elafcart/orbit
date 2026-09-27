{{-- Content Block Style 7 — Home5 "Career Path & Expertise" dark timeline (matches sec-6-home-5 in index-5.html) --}}
@php
    $linkArrowSvg = '<svg width="11" height="11" viewBox="0 0 11 11" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M0.21967 9.40717C-0.0732232 9.70006 -0.0732232 10.1749 0.21967 10.4678C0.512563 10.7607 0.987437 10.7607 1.28033 10.4678L0.21967 9.40717ZM10.6875 0.75C10.6875 0.335786 10.3517 2.97145e-09 9.9375 1.50485e-07L3.1875 -2.70983e-07C2.77329 -2.70983e-07 2.4375 0.335786 2.4375 0.75C2.4375 1.16421 2.77329 1.5 3.1875 1.5H9.1875V7.5C9.1875 7.91421 9.52329 8.25 9.9375 8.25C10.3517 8.25 10.6875 7.91421 10.6875 7.5L10.6875 0.75ZM0.75 9.9375L1.28033 10.4678L10.4678 1.28033L9.9375 0.75L9.40717 0.21967L0.21967 9.40717L0.75 9.9375Z" fill="currentColor"/></svg>';
    $rightArrowSvg = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="15" viewBox="0 0 16 15" fill="none"><path d="M0.0001297 8.99993L0 3.00407e-05L2 0L2.0001 6.99993L12.1719 7.00003L8.22224 3.05027L9.63644 1.63606L16.0003 8.00003L9.63644 14.364L8.22224 12.9497L12.1719 9.00003L0.0001297 8.99993Z" fill="currentColor"/></svg>';

    $featureTag = $shortcode->feature_tag ?: 'ui design';
    $featureTitle = $shortcode->feature_title ?: 'UI/UX & product design for digital platforms';
    $featureDescription = $shortcode->feature_description ?: 'We always provide people a complete solution upon focused of any business';
    $featureLabel = $shortcode->feature_label ?: ($shortcode->title ?: 'Orisa Nova');
    // No placeholder href: an empty Feature URL renders the card without anchors instead of
    // linking to "#", which the browser resolves to the current page (a self-link with no destination).
    $featureUrl = trim((string) $shortcode->feature_url);
    $titleTag = \Theme\Orisa\Support\ThemeHelper::safeHeadingTag($shortcode->title_heading_level ?? null, 'h2');
    $titleSizeClass = \Theme\Orisa\Support\ThemeHelper::titleFontSizeClass($shortcode->title_font_size ?? null);
@endphp

<section {!! $shortcode->htmlAttributes() !!} class="sec-6-home-5 block-journey pt-120 pb-120 bg-neutral-900 changeless">
    <div class="container">
        {{-- Top row: subtitle tag + title + description + CTA --}}
        <div class="row g-4 align-items-end pb-60">
            <div class="col-xxl-7 col-lg-9">
                @if ($shortcode->subtitle)
                    <span class="at-btn common-black bg-transparent mb-10 rounded-0 p-0">
                        <span class="text-uppercase text-white">
                            <span class="text-1">{{ $shortcode->subtitle }}</span>
                            <span class="text-2">{{ $shortcode->subtitle }}</span>
                        </span>
                        <i>{!! $linkArrowSvg !!}{!! $linkArrowSvg !!}</i>
                    </span>
                @endif
                @if ($shortcode->title)
                    <{{ $titleTag }} class="text-white reveal-text {{ $titleSizeClass }}">{!! BaseHelper::clean($shortcode->title) !!}</{{ $titleTag }}>
                @endif
                @if ($shortcode->description)
                    <p class="text-white fz-font-lg m-0">{!! BaseHelper::clean($shortcode->description) !!}</p>
                @endif
            </div>
            @if ($shortcode->primary_action_label)
                <div class="col-lg-3 ms-lg-auto d-flex justify-content-lg-end">
                    <div class="at-btn-group at_fade_anim" data-delay=".4" data-fade-from="bottom" data-ease="bounce">
                        <a class="at-btn-circle bg-neutral-700" href="{{ $shortcode->primary_action_url ?: '#' }}" aria-label="{{ $shortcode->primary_action_label ?: __('Learn more') }}"><span class="visually-hidden">{{ $shortcode->primary_action_label ?: __('Learn more') }}</span>{!! $rightArrowSvg !!}</a>
                        <a class="at-btn z-index-1 bg-neutral-700" href="{{ $shortcode->primary_action_url ?: '#' }}">{{ $shortcode->primary_action_label }}</a>
                        <a class="at-btn-circle bg-neutral-700" href="{{ $shortcode->primary_action_url ?: '#' }}" aria-label="{{ $shortcode->primary_action_label ?: __('Learn more') }}"><span class="visually-hidden">{{ $shortcode->primary_action_label ?: __('Learn more') }}</span>{!! $rightArrowSvg !!}</a>
                    </div>
                </div>
            @endif
        </div>

        {{-- Main row: featured image (left) + journey timeline (right) --}}
        <div class="row g-4">
            @if ($styleImage1)
                <div class="col-xxl-4 col-lg-5">
                    <div class="alt-portfolio-item mb-30 at-hover-item">
                        <{{ $featureUrl ? 'a' : 'div' }}@if($featureUrl) href="{{ $featureUrl }}"@endif class="alt-portfolio-thumb mb-15 p-relative fix d-block">
                            {{ RvMedia::image($styleImage1, $featureTitle, attributes: ['class' => 'w-100 scale-img-from-to', 'data-value-1' => '1.5', 'data-value-2' => '1']) }}
                            <div class="alt-portfolio-btn">
                                <div class="content">
                                    <span class="bg-transparent text-uppercase border px-3 py-1 rounded-pill text-white fz-font-label">{{ $featureTag }}</span>
                                    <h2 class="fw-400 fz-font-3xl text-white mb-0 mt-20">{{ $featureTitle }}</h2>
                                    <p class="text-white fz-font-md mb-0 mt-10 text-truncate-2 des">{{ $featureDescription }}</p>
                                </div>
                            </div>
                        </{{ $featureUrl ? 'a' : 'div' }}>
                        <div class="alt-portfolio-content d-flex justify-content-between align-items-center bg-neutral-700">
                            <h3 class="h5 alt-portfolio-title mb-0">
                                @if($featureUrl)
                                    <a href="{{ $featureUrl }}" class="common-underline text-white">{{ $featureLabel }}</a>
                                @else
                                    <span class="common-underline text-white">{{ $featureLabel }}</span>
                                @endif
                            </h3>
                            <span class="alt-portfolio-plus text-white">
                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="11" viewBox="0 0 12 11" fill="none">
                                    <path d="M4.512 10.8V0H6.984V10.8H4.512ZM0 6.6V4.2H11.52V6.6H0Z" fill="currentColor"/>
                                </svg>
                            </span>
                        </div>
                    </div>
                </div>
            @endif

            @if (! empty($items))
                <div class="col-lg-7 ms-auto pt-80">
                    <ul class="journey-list">
                        @foreach ($items as $item)
                            @php
                                // Description format: "Company|Date range|Description text"
                                $parts = array_map('trim', explode('|', (string) ($item['description'] ?? '')));
                                [$company, $dateRange, $desc] = [$parts[0] ?? '', $parts[1] ?? '', $parts[2] ?? ''];
                            @endphp
                            <li class="journey-list__item scroll-move-up">
                                @if ($dateRange)
                                    <span class="journey-list__date">{{ $dateRange }}</span>
                                @endif
                                <div class="journey-list__body">
                                    <h4 class="h6 journey-list__title neutral-0">
                                        {{ $item['title'] ?? '' }}
                                        @if ($company)
                                            <span class="journey-list__company">[{{ $company }}]</span>
                                        @endif
                                    </h4>
                                    @if ($desc)
                                        <p class="journey-list__desc">{{ $desc }}</p>
                                    @endif
                                </div>
                                {{-- Decorative arrow only. Timeline items carry no URL (the Items repeater has no
                                     URL field), so this must not be an anchor: "#" would resolve to the current
                                     page and add a link with no anchor text to every item. --}}
                                <span class="journey-list__link" aria-hidden="true">{!! $linkArrowSvg !!}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
    </div>
</section>
