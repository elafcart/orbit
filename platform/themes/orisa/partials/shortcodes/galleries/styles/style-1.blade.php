{{-- Galleries Style 1: Masonry grid with lightbox --}}
@php
    $titleTag = \Theme\Orisa\Support\ThemeHelper::safeHeadingTag($shortcode->title_heading_level ?? null, 'h2');
    $titleSizeClass = \Theme\Orisa\Support\ThemeHelper::titleFontSizeClass($shortcode->title_font_size ?? null);
@endphp
<section {!! $shortcode->htmlAttributes() !!}>
    <div class="container">
        @if ($shortcode->title || $shortcode->subtitle)
            <div class="row mb-50">
                <div class="col-12">
                    @if ($shortcode->subtitle)
                        <span class="at-btn common-black bg-transparent mb-10 rounded-0 p-0">
                            <span class="text-uppercase">
                                <span class="text-1">{!! BaseHelper::clean($shortcode->subtitle) !!}</span>
                                <span class="text-2">{!! BaseHelper::clean($shortcode->subtitle) !!}</span>
                            </span>
                        </span>
                    @endif
                    @if ($shortcode->title)
                        <{{ $titleTag }} class="reveal-text mb-0 {{ $titleSizeClass }}">{!! BaseHelper::clean($shortcode->title) !!}</{{ $titleTag }}>
                    @endif
                </div>
            </div>
        @endif

        <div class="row g-4">
            @foreach ($galleries as $gallery)
                <div class="col-lg-4 col-md-6">
                    <div class="at-project-card rounded-4 overflow-hidden">
                        <div class="anim-zoomin">
                            <a href="{{ $gallery->url }}">
                                <img
                                    src="{{ RvMedia::getImageUrl($gallery->image, 'medium', false, RvMedia::getDefaultImage()) }}"
                                    alt="{{ $gallery->name }}"
                                    class="img-cover w-100"
                                >
                            </a>
                        </div>
                        <div class="at-project-card-content p-3">
                            <h5 class="mb-1">
                                <a href="{{ $gallery->url }}" class="common-color">{{ $gallery->name }}</a>
                            </h5>
                            @if ($gallery->description)
                                <p class="fz-font-sm opacity-75 mb-0">{{ Str::limit($gallery->description, 80) }}</p>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
