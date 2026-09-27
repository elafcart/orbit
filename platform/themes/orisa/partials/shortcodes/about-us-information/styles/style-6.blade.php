{{-- About Us Style 6: from about-2.html `sec-1-about` --}}
{{-- Large brand title + social links + full-width image --}}
@php
    $socialLinks = collect(\Botble\Theme\Supports\ThemeSupport::getSocialLinks())->filter(fn ($item) => $item->getUrl());
    $titleTag = \Theme\Orisa\Support\ThemeHelper::safeHeadingTag($shortcode->title_heading_level ?? null, 'h2');
    $titleSizeClass = \Theme\Orisa\Support\ThemeHelper::titleFontSizeClass($shortcode->title_font_size ?? null);
@endphp

<div {!! $shortcode->htmlAttributes() !!} class="sec-1-about pt-150 border-bottom-100 overflow-hidden">
    <div class="container">
        <div class="row g-4 align-items-end">
            <div class="col-xxl-9 col-lg-8">
                @if($shortcode->title)
                    <{{ $titleTag }} class="section-title d-flex fw-600 lh-1 fz-200 reveal-text mb-0 {{ $titleSizeClass }}">{!! BaseHelper::clean($shortcode->title) !!}</{{ $titleTag }}>
                @endif
            </div>
            @if($socialLinks->isNotEmpty())
                <div class="col-xxl-3 col-lg-4 ms-auto">
                    <ul class="at-social-list list-unstyled d-flex flex-wrap align-items-end gap-md-4 gap-3 pb-4">
                        @foreach($socialLinks as $social)
                            <li>
                                <a href="{{ $social->getUrl() }}" class="at-social__link d-flex align-items-center gap-2" aria-label="{{ $social->getName() }}" target="_blank" rel="noopener">
                                    @if($social->getIcon())
                                        <x-core::icon :name="$social->getIcon()" />
                                    @endif
                                    <span class="fw-500">{{ $social->getName() }}</span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
        @if($shortcode->image)
            <div class="row pt-60">
                <div class="col-12">
                    <div class="rounded-5 overflow-hidden">
                        <div class="img anim-zoomin">
                            {{ RvMedia::image($shortcode->image, $shortcode->title ?? 'Orisa', attributes: ['class' => 'img-cover']) }}
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
