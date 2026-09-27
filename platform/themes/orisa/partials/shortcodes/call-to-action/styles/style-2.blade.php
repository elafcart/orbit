@php
    $titleTag = \Theme\Orisa\Support\ThemeHelper::safeHeadingTag($shortcode->title_heading_level ?? null, 'h2');
    $titleSizeClass = \Theme\Orisa\Support\ThemeHelper::titleFontSizeClass($shortcode->title_font_size ?? null);
@endphp
<section {!! $shortcode->htmlAttributes() !!} class="pt-80 pb-80">
    <div class="container">
        <div class="row align-items-center justify-content-between">
            <div class="col-lg-7">
                @if($shortcode->title)
                    <{{ $titleTag }} class="mb-3 {{ $titleSizeClass }}">{!! BaseHelper::clean($shortcode->title) !!}</{{ $titleTag }}>
                @endif
                @if($shortcode->description)
                    <p class="opacity-75">{!! BaseHelper::clean($shortcode->description) !!}</p>
                @endif
            </div>
            <div class="col-lg-auto">
                @if($shortcode->primary_action_label)
                    <a href="{{ $shortcode->primary_action_url }}" class="at-btn mt-3 mt-lg-0">
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
