{{-- Hero Banner Style 6 — About page hero from about-3.html `sec-1-about` --}}
{{-- Small badge + "About me" h1 + description on the left, CTAs top-right, full-bleed banner image below. --}}
@php
    $arrowSvg = '<svg width="11" height="11" viewBox="0 0 11 11" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"><path d="M0.21967 9.40717C-0.0732232 9.70006 -0.0732232 10.1749 0.21967 10.4678C0.512563 10.7607 0.987437 10.7607 1.28033 10.4678L0.21967 9.40717ZM10.6875 0.75C10.6875 0.335786 10.3517 2.97145e-09 9.9375 1.50485e-07L3.1875 -2.70983e-07C2.77329 -2.70983e-07 2.4375 0.335786 2.4375 0.75C2.4375 1.16421 2.77329 1.5 3.1875 1.5H9.1875V7.5C9.1875 7.91421 9.52329 8.25 9.9375 8.25C10.3517 8.25 10.6875 7.91421 10.6875 7.5L10.6875 0.75ZM0.75 9.9375L1.28033 10.4678L10.4678 1.28033L9.9375 0.75L9.40717 0.21967L0.21967 9.40717L0.75 9.9375Z" fill="currentColor"/></svg>';
    $arrowBtnSvg = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="15" viewBox="0 0 16 15" fill="none" aria-hidden="true"><path d="M0.0001297 8.99993L0 3.00407e-05L2 0L2.0001 6.99993L12.1719 7.00003L8.22224 3.05027L9.63644 1.63606L16.0003 8.00003L9.63644 14.364L8.22224 12.9497L12.1719 9.00003L0.0001297 8.99993Z" fill="currentColor"/></svg>';
    $titleTag = \Theme\Orisa\Support\ThemeHelper::safeHeadingTag($shortcode->title_heading_level ?? null);
    $titleSizeClass = \Theme\Orisa\Support\ThemeHelper::titleFontSizeClass($shortcode->title_font_size ?? null);
@endphp

<div {!! $shortcode->htmlAttributes() !!} class="shortcode-hero-banner shortcode-hero-banner-style-6 sec-1-about pt-150 overflow-hidden">
    <div class="container pb-70">
        <div class="row align-items-end g-4">
            <div class="col-xxl-6 col-lg-7 h-100">
                @if($shortcode->subtitle)
                    <span class="at-btn common-black bg-transparent mb-10 rounded-0 p-0">
                        <span class="text-uppercase">
                            <span class="text-1">{!! BaseHelper::clean($shortcode->subtitle) !!}</span>
                            <span class="text-2">{!! BaseHelper::clean($shortcode->subtitle) !!}</span>
                        </span>
                        <i>{!! $arrowSvg !!}{!! $arrowSvg !!}</i>
                    </span>
                @endif

                @if($shortcode->title)
                    <{{ $titleTag }} class="section-title fw-600 fz-ds-1 lh-1 reveal-text {{ $titleSizeClass }}">{!! BaseHelper::clean($shortcode->title) !!}</{{ $titleTag }}>
                @endif

                @if($shortcode->description)
                    <p class="mb-0 fz-font-lg fw-600 neutral-900">{!! BaseHelper::clean($shortcode->description) !!}</p>
                @endif
            </div>

            @if($shortcode->primary_action_label || $shortcode->secondary_action_label)
                <div class="col-lg-5 ms-auto">
                    <div class="d-flex flex-wrap justify-content-lg-end align-items-center gap-4">
                        @if($shortcode->primary_action_label)
                            <div class="at-btn-group at_fade_anim" data-delay=".4" data-fade-from="bottom" data-ease="bounce">
                                <a class="at-btn-circle" href="{{ $shortcode->primary_action_url ?: '#' }}" aria-label="{{ $shortcode->primary_action_label }}"><span class="visually-hidden">{{ $shortcode->primary_action_label }}</span>{!! $arrowBtnSvg !!}</a>
                                <a class="at-btn z-index-1" href="{{ $shortcode->primary_action_url ?: '#' }}">{{ $shortcode->primary_action_label }}</a>
                                <a class="at-btn-circle" href="{{ $shortcode->primary_action_url ?: '#' }}" aria-label="{{ $shortcode->primary_action_label }}"><span class="visually-hidden">{{ $shortcode->primary_action_label }}</span>{!! $arrowBtnSvg !!}</a>
                            </div>
                        @endif

                        @if($shortcode->secondary_action_label)
                            <a href="{{ $shortcode->secondary_action_url ?: '#' }}" class="at-btn common-black border-bottom-900 text-uppercase bg-transparent rounded-0 p-0 pb-2">
                                <span class="text-uppercase">
                                    <span class="text-1">{{ $shortcode->secondary_action_label }}</span>
                                    <span class="text-2">{{ $shortcode->secondary_action_label }}</span>
                                </span>
                                <i>{!! $arrowSvg !!}{!! $arrowSvg !!}</i>
                            </a>
                        @endif
                    </div>
                </div>
            @endif
        </div>
    </div>

    @if($shortcode->image)
        <div class="at-banner-thumb overflow-hidden scale-up-img">
            {{ RvMedia::image($shortcode->image, $shortcode->title ?? 'About', attributes: [
                'class' => 'img-cover scale-up',
                'data-speed' => '.4',
            ]) }}
        </div>
    @endif
</div>
