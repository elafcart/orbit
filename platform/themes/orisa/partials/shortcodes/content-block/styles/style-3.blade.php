{{-- Content Block Style 3 — Home4 "How We Work" 4-column process cards with decorative grid bg + quote row (matches sec-3-home-4 in index-4.html) --}}
@php
    $linkArrowSvg = '<svg width="11" height="11" viewBox="0 0 11 11" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M0.21967 9.40717C-0.0732232 9.70006 -0.0732232 10.1749 0.21967 10.4678C0.512563 10.7607 0.987437 10.7607 1.28033 10.4678L0.21967 9.40717ZM10.6875 0.75C10.6875 0.335786 10.3517 2.97145e-09 9.9375 1.50485e-07L3.1875 -2.70983e-07C2.77329 -2.70983e-07 2.4375 0.335786 2.4375 0.75C2.4375 1.16421 2.77329 1.5 3.1875 1.5H9.1875V7.5C9.1875 7.91421 9.52329 8.25 9.9375 8.25C10.3517 8.25 10.6875 7.91421 10.6875 7.5L10.6875 0.75ZM0.75 9.9375L1.28033 10.4678L10.4678 1.28033L9.9375 0.75L9.40717 0.21967L0.21967 9.40717L0.75 9.9375Z" fill="currentColor"/></svg>';
    $rightArrowSvg = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="15" viewBox="0 0 16 15" fill="none"><path d="M0.0001297 8.99993L0 3.00407e-05L2 0L2.0001 6.99993L12.1719 7.00003L8.22224 3.05027L9.63644 1.63606L16.0003 8.00003L9.63644 14.364L8.22224 12.9497L12.1719 9.00003L0.0001297 8.99993Z" fill="currentColor"/></svg>';
    $titleTag = \Theme\Orisa\Support\ThemeHelper::safeHeadingTag($shortcode->title_heading_level ?? null, 'h2');
    $titleSizeClass = \Theme\Orisa\Support\ThemeHelper::titleFontSizeClass($shortcode->title_font_size ?? null);
@endphp

<div {!! $shortcode->htmlAttributes() !!} class="shortcode-content-block shortcode-content-block-style-3 container-2200">
    <div class="sec-3-home-4 pt-130 rounded-5 mx-lg-3 mx-2 fix p-relative bg-neutral-0">
        {{-- 7-column decorative grid background pattern (matches HTML) --}}
        <div class="position-absolute w-100 h-100 d-grid top-0 md:grid-cols-7 gap-0 z-0 opacity-10">
            @for ($i = 0; $i < 7; $i++)
                <div class="position-relative h-100 overflow-hidden d-md-block border-dark/01">
                    <div class="absolute bottom-0 left-0 right-0 border-white/10"></div>
                </div>
            @endfor
        </div>

        <div class="container p-relative z-1">
            {{-- Top: subtitle tag + title + CTA --}}
            <div class="row align-items-end g-4">
                <div class="col-lg-6 col-md-10">
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
                @if ($shortcode->primary_action_label)
                    <div class="col-lg-3 ms-auto d-flex justify-content-lg-end">
                        <div class="at-btn-group at_fade_anim" data-delay=".4" data-fade-from="bottom" data-ease="bounce">
                            <a class="at-btn-circle" href="{{ $shortcode->primary_action_url ?: '#' }}" aria-label="{{ $shortcode->primary_action_label ?: __('Learn more') }}"><span class="visually-hidden">{{ $shortcode->primary_action_label ?: __('Learn more') }}</span>{!! $rightArrowSvg !!}</a>
                            <a class="at-btn z-index-1" href="{{ $shortcode->primary_action_url ?: '#' }}">{{ $shortcode->primary_action_label }}</a>
                            <a class="at-btn-circle" href="{{ $shortcode->primary_action_url ?: '#' }}" aria-label="{{ $shortcode->primary_action_label ?: __('Learn more') }}"><span class="visually-hidden">{{ $shortcode->primary_action_label ?: __('Learn more') }}</span>{!! $rightArrowSvg !!}</a>
                        </div>
                    </div>
                @endif
            </div>

            {{-- 4 process cards with pills + numbers --}}
            @if (! empty($items))
                <div class="row g-4 pt-60">
                    @foreach ($items as $index => $item)
                        @php
                            $step = $index + 1;
                            $pillImage = ! empty($item['image']) ? RvMedia::getImageUrl($item['image']) : null;
                        @endphp
                        <div class="col-lg-3 col-md-6">
                            <div class="card__process-card card-{{ $step }} at_fade_anim" data-delay=".4">
                                <div class="card__process-visual">
                                    <div class="card__process-pill card__process-pill--{{ $step }}" @if ($pillImage) style="background-image: url('{{ $pillImage }}');" @endif></div>
                                    <span class="card__process-num">{{ str_pad((string) $step, 2, '0', STR_PAD_LEFT) }}</span>
                                </div>
                                <div class="card__process-content">
                                    <h4 class="h6 card__process-title">{{ $item['title'] ?? '' }}</h4>
                                    @if (! empty($item['description']))
                                        <p class="card__process-desc">{{ $item['description'] }}</p>
                                    @endif
                                    <div class="card__process-divider"></div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

            {{-- Bottom: image + quote --}}
            @if ($styleImage1 || $shortcode->description)
                <div class="row align-items-center g-md-5 g-4 mt-lg-0 mt-20">
                    @if ($styleImage1)
                        <div class="col-lg-3 order-lg-1 order-2">
                            <div class="at_fade_anim" data-delay=".4" data-fade-from="bottom" data-ease="bounce">
                                {{ RvMedia::image($styleImage1, $shortcode->title ?? 'Process', attributes: []) }}
                            </div>
                        </div>
                    @endif
                    @if ($shortcode->description)
                        <div class="col-lg-4 order-lg-2 order-1">
                            <div class="mb-3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="42" height="48" viewBox="0 0 42 48" fill="none" aria-hidden="true">
                                    <path d="M21 16L14 12V4L21 0L28 4V12L21 16Z" fill="currentColor"/>
                                    <path d="M35 24L28 20V12L35 8L42 12V20L35 24Z" fill="currentColor"/>
                                    <path d="M28 36V28L35 24L42 28V36L35 40L28 36Z" fill="currentColor"/>
                                    <path d="M14 36L21 32L28 36V44L21 48L14 44V36Z" fill="currentColor"/>
                                    <path d="M7 24L14 28V36L7 40L0 36V28L7 24Z" fill="currentColor"/>
                                    <path d="M7 24L14 20V12L7 8L0 12V20L7 24Z" fill="currentColor"/>
                                </svg>
                            </div>
                            <span class="fz-font-3xl neutral-900 reveal-text">&ldquo;{!! BaseHelper::clean($shortcode->description) !!}&rdquo;</span>
                        </div>
                    @endif
                </div>
            @endif
        </div>
    </div>
</div>
