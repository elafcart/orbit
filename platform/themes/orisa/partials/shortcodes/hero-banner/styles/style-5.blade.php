{{-- Hero Banner Style 5 — personal/portfolio, 3-column layout on gray page bg with 7-col grid pattern --}}
@php
    $arrowBtnSvg = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="15" viewBox="0 0 16 15" fill="none"><path d="M0.0001297 8.99993L0 3.00407e-05L2 0L2.0001 6.99993L12.1719 7.00003L8.22224 3.05027L9.63644 1.63606L16.0003 8.00003L9.63644 14.364L8.22224 12.9497L12.1719 9.00003L0.0001297 8.99993Z" fill="currentColor"/></svg>';
    $titleTag = \Theme\Orisa\Support\ThemeHelper::safeHeadingTag($shortcode->title_heading_level ?? null);
    $titleSizeClass = \Theme\Orisa\Support\ThemeHelper::titleFontSizeClass($shortcode->title_font_size ?? null);
@endphp

<div {!! $shortcode->htmlAttributes() !!}
    class="shortcode-hero-banner shortcode-hero-banner-style-5 container-2200 pt-140 p-relative z-0">

    {{-- 7-column decorative grid background (matches index-5.html) --}}
    <div class="position-absolute w-100 h-100 d-grid top-0 md:grid-cols-7 gap-0 z-n1 opacity-10">
        @for ($i = 0; $i < 7; $i++)
            <div class="position-relative h-100 overflow-hidden d-md-block border-dark/01">
                <div class="absolute bottom-0 left-0 right-0 border-white/10"></div>
            </div>
        @endfor
    </div>

    <div class="sec-1-home-5 mt-30 pb-lg-0 pb-4">
        <div class="container">
        <div class="row align-items-center">

            {{-- Left: availability tag, subtitle, secondary image --}}
            <div class="col-lg-3 mx-lg-auto col-md-6 pb-100 z-index-2">
                @if($shortcode->subtitle)
                    <span class="category-tag mb-20">
                        <span class="dot"></span>
                        {!! BaseHelper::clean($shortcode->subtitle) !!}
                    </span>
                @endif
                @if($shortcode->description)
                    <p class="fz-18 neutral-900 fw-600 mb-40">{!! BaseHelper::clean($shortcode->description) !!}</p>
                @endif
                @if($shortcode->left_image)
                    {{ RvMedia::image($shortcode->left_image, $shortcode->title, attributes: []) }}
                @endif
            </div>

            {{-- Center: hero image with big bg text --}}
            <div class="col-lg-4 mx-lg-auto d-none d-lg-block z-index-1">
                @if($shortcode->image)
                    <div class="p-relative at_fade_anim" data-delay=".5" data-fade-from="bottom" data-ease="bounce">
                        {{ RvMedia::image($shortcode->image, $shortcode->title, attributes: ['class' => 'd-none d-lg-block']) }}
                        @if($shortcode->title)
                            <div class="p-absolute bottom-0 start-50 translate-middle-x z-n1 d-lg-none d-xxl-block">
                                <{{ $titleTag }} class="fz-290 fw-600 text-nowrap lh-1 {{ $titleSizeClass }}">{!! BaseHelper::clean($shortcode->title) !!}</{{ $titleTag }}>
                            </div>
                        @endif
                    </div>
                @endif
            </div>

            {{-- Right: icon, name/title, description, CTA button group --}}
            <div class="col-lg-3 col-md-6 mx-lg-auto z-index-2">
                <div class="icon mb-30">
                    <svg xmlns="http://www.w3.org/2000/svg" width="38" height="38" viewBox="0 0 38 38" fill="none">
                        <path d="M19.3621 35.41C20.3107 28.6345 20.785 25.2468 23.0159 23.0158C25.2469 20.7848 28.6347 20.3105 35.4102 19.362L37.9991 18.9995L35.4102 18.6371C28.6347 17.6885 25.2469 17.2142 23.0159 14.9832C20.785 12.7522 20.3107 9.36449 19.3621 2.58901L18.9996 -4.5973e-05L18.6372 2.58898C17.6886 9.36447 17.2143 12.7522 14.9833 14.9832C12.7524 17.2142 9.36462 17.6885 2.58913 18.637L0 18.9995L2.58912 19.362C9.36461 20.3106 12.7524 20.7848 14.9833 23.0158C17.2143 25.2468 17.6886 28.6345 18.6372 35.41L18.9996 37.9991L19.3621 35.41Z" fill="currentColor"/>
                    </svg>
                </div>

                @if($shortcode->title)
                    <h2 class="h4">{{ __("I'm") }} {!! BaseHelper::clean($shortcode->title) !!}</h2>
                @endif

                @if($shortcode->bio)
                    <p class="fz-18 neutral-900 fw-600">{!! BaseHelper::clean($shortcode->bio) !!}</p>
                @endif

                @if($shortcode->primary_action_label)
                    <div class="at-btn-group at-btn-group-transparent at_fade_anim" data-delay=".5" data-fade-from="bottom" data-ease="bounce">
                        <a class="at-btn-circle" href="{{ $shortcode->primary_action_url }}" aria-label="{{ $shortcode->primary_action_label ?: __('Learn more') }}"><span class="visually-hidden">{{ $shortcode->primary_action_label ?: __('Learn more') }}</span>{!! $arrowBtnSvg !!}</a>
                        <a class="at-btn z-index-1" href="{{ $shortcode->primary_action_url }}">{{ $shortcode->primary_action_label }}</a>
                        <a class="at-btn-circle" href="{{ $shortcode->primary_action_url }}" aria-label="{{ $shortcode->primary_action_label ?: __('Learn more') }}"><span class="visually-hidden">{{ $shortcode->primary_action_label ?: __('Learn more') }}</span>{!! $arrowBtnSvg !!}</a>
                    </div>
                @endif
            </div>

            </div>
        </div>
    </div>
</div>
