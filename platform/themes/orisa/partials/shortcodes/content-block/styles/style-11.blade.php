{{-- Content Block Style 11 — About-3 "My Process" horizontal scroll process cards (matches sec-2-about in about-3.html) --}}
@php
    $linkArrowSvg = '<svg width="11" height="11" viewBox="0 0 11 11" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"><path d="M0.21967 9.40717C-0.0732232 9.70006 -0.0732232 10.1749 0.21967 10.4678C0.512563 10.7607 0.987437 10.7607 1.28033 10.4678L0.21967 9.40717ZM10.6875 0.75C10.6875 0.335786 10.3517 2.97145e-09 9.9375 1.50485e-07L3.1875 -2.70983e-07C2.77329 -2.70983e-07 2.4375 0.335786 2.4375 0.75C2.4375 1.16421 2.77329 1.5 3.1875 1.5H9.1875V7.5C9.1875 7.91421 9.52329 8.25 9.9375 8.25C10.3517 8.25 10.6875 7.91421 10.6875 7.5L10.6875 0.75ZM0.75 9.9375L1.28033 10.4678L10.4678 1.28033L9.9375 0.75L9.40717 0.21967L0.21967 9.40717L0.75 9.9375Z" fill="currentColor"/></svg>';
    $processIconSvg = '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none" aria-hidden="true"><path d="M9 0C13.9706 0 18 4.02944 18 9C18 13.9706 13.9706 18 9 18C4.02944 18 0 13.9706 0 9C0 4.02944 4.02944 0 9 0ZM8 5V8H5V10H8V13H10V10H13V8H10V5H8Z" fill="currentColor"/></svg>';

    $contactPhone = $shortcode->contact_phone ?: theme_option('footer_phone');
    $contactEmail = $shortcode->contact_email ?: theme_option('footer_email');
    $contactAddress = $shortcode->contact_address ?: theme_option('footer_address');
    $titleTag = \Theme\Orisa\Support\ThemeHelper::safeHeadingTag($shortcode->title_heading_level ?? null, 'h2');
    $titleSizeClass = \Theme\Orisa\Support\ThemeHelper::titleFontSizeClass($shortcode->title_font_size ?? null);
@endphp

<div {!! $shortcode->htmlAttributes() !!} class="shortcode-content-block shortcode-content-block-style-11 sec-2-about pt-120 p-relative bg-neutral-50">
    {{-- 7-column decorative grid background pattern --}}
    <div class="position-absolute w-100 h-100 d-grid top-0 md:grid-cols-7 gap-0 z-0 opacity-10">
        @for ($i = 0; $i < 7; $i++)
            <div class="position-relative h-100 overflow-hidden d-md-block border-dark/01">
                <div class="absolute bottom-0 left-0 right-0 border-white/10"></div>
            </div>
        @endfor
    </div>

    <div class="container p-relative z-1">
        <div class="row pb-50 align-items-end">
            <div class="col-lg-4 col-md-4">
                @if ($shortcode->subtitle)
                    <span class="at-btn common-black bg-transparent mb-10 rounded-0 p-0">
                        <span class="text-uppercase">
                            <span class="text-1">{!! BaseHelper::clean($shortcode->subtitle) !!}</span>
                            <span class="text-2">{!! BaseHelper::clean($shortcode->subtitle) !!}</span>
                        </span>
                        <i>{!! $linkArrowSvg !!}{!! $linkArrowSvg !!}</i>
                    </span>
                @endif
                @if ($shortcode->title)
                    <{{ $titleTag }} class="h3 reveal-text {{ $titleSizeClass }}">{!! BaseHelper::clean($shortcode->title) !!}</{{ $titleTag }}>
                @endif
            </div>
            @if ($shortcode->description)
                <div class="col-xxl-5 col-lg-8 text-lg-end ms-auto">
                    <h3 class="h6 fw-600 fz-font-lg">{!! BaseHelper::clean($shortcode->description) !!}</h3>
                </div>
            @endif
        </div>
    </div>

    <div class="container p-relative z-1">
        @if (! empty($items))
            <div class="row">
                <div class="col-12">
                    <div class="scroll-section process-scroll">
                        <div class="wrapper">
                            @foreach ($items as $index => $item)
                                @php
                                    $step = str_pad((string) ($index + 1), 2, '0', STR_PAD_LEFT);
                                    // Description format: "Duration|Duration label|Description text"
                                    $parts = array_map('trim', explode('|', (string) ($item['description'] ?? '')));
                                    [$duration, $durationLabel, $desc] = [$parts[0] ?? '', $parts[1] ?? '', $parts[2] ?? ''];
                                @endphp
                                <div class="item">
                                    <div class="process-card">
                                        <div class="row g-xxl-5 align-items-center">
                                            @if (! empty($item['image']))
                                                <div class="col-xxl-4 col-lg-5 order-lg-1 order-2">
                                                    <div class="process-card__img-wrap">
                                                        {{ RvMedia::image($item['image'], $item['title'] ?? 'Process step', attributes: ['class' => 'img-cover']) }}
                                                    </div>
                                                </div>
                                            @endif
                                            <div class="col-xxl-8 col-lg-7 order-lg-2 order-1 mb-lg-0 mb-4">
                                                <div class="process-card__content">
                                                    <div class="process-card__header flex-xxl-row flex-column align-items-start">
                                                        <h4 class="h5 process-card__title">{{ $step }}. {{ $item['title'] ?? '' }}</h4>
                                                        @if ($duration || $durationLabel)
                                                            <div class="process-card__meta d-flex align-items-md-center flex-md-row flex-column gap-2">
                                                                <span class="process-card__meta-text">
                                                                    {{ $duration }}
                                                                    @if ($durationLabel)
                                                                        <span class="process-card__meta-label">{{ $durationLabel }}</span>
                                                                    @endif
                                                                </span>
                                                                <span class="process-card__icon rounded-circle">{!! $processIconSvg !!}</span>
                                                            </div>
                                                        @endif
                                                    </div>
                                                    @if ($desc)
                                                        <p class="process-card__desc text-truncate-3 mb-0">{{ $desc }}</p>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        @endif

        @if ($contactPhone || $contactEmail || $contactAddress)
            <div class="row pb-120 pt-60">
                <div class="offset-xxl-4 col-xxl-6 col-12">
                    <div class="d-flex flex-md-row flex-column gap-md-5 gap-3 align-items-md-end justify-content-md-between">
                        @if ($contactPhone || $contactEmail)
                            <div>
                                @if ($contactPhone)
                                    <p class="h6 fw-600 mb-0">
                                        <a href="tel:{{ preg_replace('/[^+0-9]/', '', $contactPhone) }}" class="text-decoration-none">{{ $contactPhone }}</a>
                                    </p>
                                @endif
                                @if ($contactEmail)
                                    <h4 class="mb-0 fw-medium text-decoration-underline">
                                        <a href="mailto:{{ $contactEmail }}">{{ $contactEmail }}</a>
                                    </h4>
                                @endif
                            </div>
                        @endif
                        @if ($contactAddress)
                            <h3 class="h6 fw-600">
                                <span class="fz-font-lg fw-500">{!! BaseHelper::clean(nl2br($contactAddress)) !!}</span>
                            </h3>
                        @endif
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
