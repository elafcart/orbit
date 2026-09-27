@php
    $titleTag = \Theme\Orisa\Support\ThemeHelper::safeHeadingTag($shortcode->title_heading_level ?? null, 'h2');
    $titleSizeClass = \Theme\Orisa\Support\ThemeHelper::titleFontSizeClass($shortcode->title_font_size ?? null);
@endphp
<section {!! $shortcode->htmlAttributes() !!} class="pt-120 pb-120 bg-neutral-50 rounded-5 mx-lg-3 mx-2">
    <div class="container">
        @if($shortcode->title)
            <div class="text-center mb-5">
                <{{ $titleTag }}@if($titleSizeClass) class="{{ $titleSizeClass }}"@endif>{!! BaseHelper::clean($shortcode->title) !!}</{{ $titleTag }}>
                @if($shortcode->description)
                    <p class="fz-font-lg opacity-75 col-lg-8 mx-auto">{!! BaseHelper::clean($shortcode->description) !!}</p>
                @endif
            </div>
        @endif
        @if(!empty($items))
            <div class="row g-4">
                @foreach($items as $item)
                    <div class="col-lg-4 col-md-6">
                        <div class="at-feature-card rounded-4 p-4 bg-neutral-0 h-100">
                            @if(!empty($item['image']))
                                <div class="mb-3 rounded-3 overflow-hidden">
                                    {{ RvMedia::image($item['image'], $item['title'] ?? '', attributes: ['class' => 'w-100']) }}
                                </div>
                            @endif
                            @if(!empty($item['title']))
                                <h5 class="mb-2">{{ $item['title'] }}</h5>
                            @endif
                            @if(!empty($item['description']))
                                <p class="opacity-75 mb-0">{{ $item['description'] }}</p>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</section>
