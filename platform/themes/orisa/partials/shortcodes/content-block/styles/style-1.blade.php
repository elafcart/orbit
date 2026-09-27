@php
    $titleTag = \Theme\Orisa\Support\ThemeHelper::safeHeadingTag($shortcode->title_heading_level ?? null, 'h2');
    $titleSizeClass = \Theme\Orisa\Support\ThemeHelper::titleFontSizeClass($shortcode->title_font_size ?? null);
@endphp
<section {!! $shortcode->htmlAttributes() !!} class="pt-120 pb-120">
    <div class="container">
        <div class="row g-5 align-items-center">
            @if($styleImage1)
                <div class="col-lg-6">
                    <div class="rounded-4 overflow-hidden">
                        {{ RvMedia::image($styleImage1, $shortcode->title, attributes: ['class' => 'w-100']) }}
                    </div>
                </div>
            @endif
            <div @class(['col-lg-6' => $styleImage1, 'col-12' => !$styleImage1])>
                @if($shortcode->subtitle)
                    <span class="at-section-subtitle d-inline-block mb-3">{!! BaseHelper::clean($shortcode->subtitle) !!}</span>
                @endif
                @if($shortcode->title)
                    <{{ $titleTag }} class="mb-4 {{ $titleSizeClass }}">{!! BaseHelper::clean($shortcode->title) !!}</{{ $titleTag }}>
                @endif
                @if($shortcode->description)
                    <p class="fz-font-lg opacity-75 mb-4">{!! BaseHelper::clean($shortcode->description) !!}</p>
                @endif
                @if(!empty($items))
                    <div class="row g-4 mt-2">
                        @foreach($items as $item)
                            <div class="col-md-6">
                                @if(!empty($item['icon']))
                                    <span class="d-block fz-24 mb-3">
                                        <x-core::icon :name="$item['icon']" />
                                    </span>
                                @endif
                                @if(!empty($item['title']))
                                    <h6 class="mb-2">{{ $item['title'] }}</h6>
                                @endif
                                @if(!empty($item['description']))
                                    <p class="opacity-75">{{ $item['description'] }}</p>
                                @endif
                            </div>
                        @endforeach
                    </div>
                @endif
                @if($shortcode->primary_action_label)
                    <a href="{{ $shortcode->primary_action_url }}" class="at-btn mt-4">
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
