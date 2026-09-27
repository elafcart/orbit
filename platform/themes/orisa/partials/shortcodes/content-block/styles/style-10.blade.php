{{-- Content Block Style 10 — About-3 "Experience" timeline (non-dark, matches sec-1-about lower half in about-3.html) --}}
@php
    $linkArrowSvg = '<svg width="11" height="11" viewBox="0 0 11 11" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"><path d="M0.21967 9.40717C-0.0732232 9.70006 -0.0732232 10.1749 0.21967 10.4678C0.512563 10.7607 0.987437 10.7607 1.28033 10.4678L0.21967 9.40717ZM10.6875 0.75C10.6875 0.335786 10.3517 2.97145e-09 9.9375 1.50485e-07L3.1875 -2.70983e-07C2.77329 -2.70983e-07 2.4375 0.335786 2.4375 0.75C2.4375 1.16421 2.77329 1.5 3.1875 1.5H9.1875V7.5C9.1875 7.91421 9.52329 8.25 9.9375 8.25C10.3517 8.25 10.6875 7.91421 10.6875 7.5L10.6875 0.75ZM0.75 9.9375L1.28033 10.4678L10.4678 1.28033L9.9375 0.75L9.40717 0.21967L0.21967 9.40717L0.75 9.9375Z" fill="currentColor"/></svg>';
    $titleTag = \Theme\Orisa\Support\ThemeHelper::safeHeadingTag($shortcode->title_heading_level ?? null, 'h2');
    $titleSizeClass = \Theme\Orisa\Support\ThemeHelper::titleFontSizeClass($shortcode->title_font_size ?? null);
@endphp

<div {!! $shortcode->htmlAttributes() !!} class="shortcode-content-block shortcode-content-block-style-10">
    <div class="container pt-100 pb-100">
        <div class="row g-5">
            <div class="col-lg-3">
                @if ($shortcode->subtitle)
                    <span class="at-btn common-black text-uppercase bg-transparent mb-10 rounded-0 p-0">
                        <span class="text-uppercase">
                            <span class="text-1">{!! BaseHelper::clean($shortcode->subtitle) !!}</span>
                            <span class="text-2">{!! BaseHelper::clean($shortcode->subtitle) !!}</span>
                        </span>
                        <i>{!! $linkArrowSvg !!}{!! $linkArrowSvg !!}</i>
                    </span>
                @endif

                @if ($shortcode->title)
                    <{{ $titleTag }} class="h3 mb-0 {{ $titleSizeClass }}">{!! BaseHelper::clean($shortcode->title) !!}</{{ $titleTag }}>
                @endif

                @if ($shortcode->description)
                    <h3 class="h6 fz-font-lg reveal-text">{!! BaseHelper::clean($shortcode->description) !!}</h3>
                @endif
            </div>

            @if (! empty($items))
                <div class="col-lg-8 ms-lg-auto block-journey">
                    <div class="journey-list-wrap">
                        <div class="journey-list-line" aria-hidden="true"></div>
                        <ul class="journey-list">
                            @foreach ($items as $item)
                                @php
                                    // Description format: "Company|Date range|Description text"
                                    $parts = array_map('trim', explode('|', (string) ($item['description'] ?? '')));
                                    [$company, $dateRange, $desc] = [$parts[0] ?? '', $parts[1] ?? '', $parts[2] ?? ''];
                                @endphp
                                <li class="journey-list__item border-bottom-100">
                                    @if ($dateRange)
                                        <span class="journey-list__date neutral-900">{{ $dateRange }}</span>
                                    @endif
                                    <div class="journey-list__body">
                                        <h4 class="h6 journey-list__title neutral-900">
                                            {{ $item['title'] ?? '' }}
                                            @if ($company)
                                                <span class="journey-list__company">[ {{ $company }} ]</span>
                                            @endif
                                        </h4>
                                        @if ($desc)
                                            <p class="journey-list__desc neutral-500">{{ $desc }}</p>
                                        @endif
                                    </div>
                                    <a href="#" class="journey-list__link neutral-900" aria-label="{{ __('View details') }}">{!! $linkArrowSvg !!}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
