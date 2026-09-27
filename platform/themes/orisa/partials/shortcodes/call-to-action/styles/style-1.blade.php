@php
    $titleTag = \Theme\Orisa\Support\ThemeHelper::safeHeadingTag($shortcode->title_heading_level ?? null, 'h2');
    $titleSizeClass = \Theme\Orisa\Support\ThemeHelper::titleFontSizeClass($shortcode->title_font_size ?? null);
@endphp
<section {!! $shortcode->htmlAttributes() !!} class="at-banner-area pt-120 pb-120 bg-neutral-950 changeless p-relative">
    @if($shortcode->background_image)
        <div class="at-banner-bg bg-cover p-absolute top-0 start-0 w-100 h-100" data-background="{{ RvMedia::getImageUrl($shortcode->background_image) }}"></div>
    @endif
    <div class="container p-relative z-1">
        <div class="row justify-content-center text-center">
            <div class="col-lg-8">
                @if($shortcode->subtitle)
                    <span class="at-section-subtitle text-white d-inline-block mb-3">{!! BaseHelper::clean($shortcode->subtitle) !!}</span>
                @endif
                @if($shortcode->title)
                    <{{ $titleTag }} class="text-white mb-4 {{ $titleSizeClass }}">{!! BaseHelper::clean($shortcode->title) !!}</{{ $titleTag }}>
                @endif
                @if($shortcode->description)
                    <p class="text-white opacity-75 mb-5">{!! BaseHelper::clean($shortcode->description) !!}</p>
                @endif
                @if($shortcode->primary_action_label)
                    <a href="{{ $shortcode->primary_action_url }}" class="at-btn btn-white">
                        <span>
                            <span class="text-1">{{ $shortcode->primary_action_label }}</span>
                            <span class="text-2">{{ $shortcode->primary_action_label }}</span>
                        </span>
                    </a>
                @endif
            </div>
        </div>
    </div>
</section>
