@php
    $titleTag = \Theme\Orisa\Support\ThemeHelper::safeHeadingTag($shortcode->title_heading_level ?? null, 'h2');
    $titleSizeClass = \Theme\Orisa\Support\ThemeHelper::titleFontSizeClass($shortcode->title_font_size ?? null);
@endphp
<section {!! $shortcode->htmlAttributes() !!} class="pt-120 pb-80">
    <div class="container">
        @if($shortcode->title)
            <div class="text-center mb-5">
                @if($shortcode->subtitle)
                    <span class="at-section-subtitle d-inline-block mb-3">{!! BaseHelper::clean($shortcode->subtitle) !!}</span>
                @endif
                <{{ $titleTag }}@if($titleSizeClass) class="{{ $titleSizeClass }}"@endif>{!! BaseHelper::clean($shortcode->title) !!}</{{ $titleTag }}>
            </div>
        @endif

        <div class="row g-4">
            @foreach($posts as $index => $post)
                @if($index === 0)
                    <div class="col-lg-6">
                        <div class="at-blog-card at-blog-card-featured rounded-4 overflow-hidden h-100">
                            <a href="{{ $post->url }}">
                                {{ RvMedia::image($post->image, $post->name, attributes: ['class' => 'w-100 img-cover', 'style' => 'height: 400px; object-fit: cover;']) }}
                            </a>
                            <div class="p-4">
                                <div class="d-flex gap-3 mb-3">
                                    @if($post->categories->isNotEmpty())
                                        <span class="at-btn-tag fz-font-sm">{{ $post->categories->first()->name }}</span>
                                    @endif
                                    <span class="fz-font-sm opacity-50">{{ Theme::formatDate($post->created_at) }}</span>
                                </div>
                                <h4><a href="{{ $post->url }}">{!! BaseHelper::clean($post->name) !!}</a></h4>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
            <div class="col-lg-6">
                <div class="d-flex flex-column gap-4">
                    @foreach($posts->skip(1) as $post)
                        @include(Theme::getThemeNamespace('partials.blogs.styles.style-2'))
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
