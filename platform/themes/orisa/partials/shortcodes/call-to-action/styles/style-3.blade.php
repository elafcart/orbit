{{-- Call to Action Style 3: from index-3.html `home-3-section-8` --}}
{{-- Dark background with optional bg image, title + description on left, image on right, circle-arrow button group --}}
@php
    $arrowBtnSvg = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="15" viewBox="0 0 16 15" fill="none"><path d="M0.0001297 8.99993L0 3.00407e-05L2 0L2.0001 6.99993L12.1719 7.00003L8.22224 3.05027L9.63644 1.63606L16.0003 8.00003L9.63644 14.364L8.22224 12.9497L12.1719 9.00003L0.0001297 8.99993Z" fill="currentColor"/></svg>';
    // Use image_2 here (not background_image) since base compiler auto-paints background_image on wrapper.
    $rightImage = $shortcode->image_2;
    $bgImage = $shortcode->background_image;
    $titleTag = \Theme\Orisa\Support\ThemeHelper::safeHeadingTag($shortcode->title_heading_level ?? null, 'h2');
    $titleSizeClass = \Theme\Orisa\Support\ThemeHelper::titleFontSizeClass($shortcode->title_font_size ?? null);
@endphp

<div {!! $shortcode->htmlAttributes() !!}
    class="home-3-section-8 bg-cover pt-120 pb-120 bg-neutral-900"
    @if($bgImage) data-background="{{ RvMedia::getImageUrl($bgImage) }}" @endif>
    <div class="container">
        <div class="row g-4 align-items-center">
            <div class="col-lg-5 me-auto">
                @if($shortcode->title)
                    <{{ $titleTag }} class="reveal-text mb-0 pe-lg-5 text-white {{ $titleSizeClass }}">{!! BaseHelper::clean($shortcode->title) !!}</{{ $titleTag }}>
                @endif

                @if($shortcode->description)
                    <p class="text-white fz-xl py-4">{!! BaseHelper::clean($shortcode->description) !!}</p>
                @endif

                @if($shortcode->primary_action_label)
                    <div class="at-btn-group at-btn-group-transparent at_fade_anim" data-delay=".4" data-fade-from="bottom" data-ease="bounce">
                        <a class="at-btn-circle" href="{{ $shortcode->primary_action_url ?: '#' }}" aria-label="{{ $shortcode->primary_action_label ?: __('Learn more') }}"><span class="visually-hidden">{{ $shortcode->primary_action_label ?: __('Learn more') }}</span>{!! $arrowBtnSvg !!}</a>
                        <a class="at-btn z-index-1" href="{{ $shortcode->primary_action_url ?: '#' }}">{{ $shortcode->primary_action_label }}</a>
                        <a class="at-btn-circle" href="{{ $shortcode->primary_action_url ?: '#' }}" aria-label="{{ $shortcode->primary_action_label ?: __('Learn more') }}"><span class="visually-hidden">{{ $shortcode->primary_action_label ?: __('Learn more') }}</span>{!! $arrowBtnSvg !!}</a>
                    </div>
                @endif
            </div>

            @if($rightImage)
                <div class="col-lg-5">
                    <div class="p-relative rounded-4 overflow-hidden">
                        {{ RvMedia::image($rightImage, $shortcode->title ?? 'Orisa', attributes: ['class' => 'img-cover']) }}
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
